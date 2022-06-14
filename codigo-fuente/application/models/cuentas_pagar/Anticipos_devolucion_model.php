<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Anticipos_devolucion_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla anticipos_devolucion
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objAnticipoDevolucion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
		
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objAnticipoDevolucion->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objAnticipoDevolucion->dteFecha.' '.date("H:i:s"); 

		//Tabla anticipos_devolucion
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objAnticipoDevolucion->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha, 
						  'prospecto_id' => $objAnticipoDevolucion->intProspectoID,
						  'razon_social' => $objAnticipoDevolucion->strRazonSocial,
						  'rfc' => $objAnticipoDevolucion->strRfc,
						  'cliente_cuenta_bancaria' => $objAnticipoDevolucion->strClienteCuentaBancaria,
						  'cliente_banco_id' => $objAnticipoDevolucion->intClienteBancoID,
						  'cuenta_bancaria_id' => $objAnticipoDevolucion->intCuentaBancariaID,
						  'motivo' => $objAnticipoDevolucion->strMotivo,
						  'observaciones' => $objAnticipoDevolucion->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objAnticipoDevolucion->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('anticipos_devolucion', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objAnticipoDevolucion->intAnticipoDevolucionID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la devolución
		$this->guardar_detalles($objAnticipoDevolucion);

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
	public function modificar(stdClass $objAnticipoDevolucion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Concatenar hora, minutos y segundos
		$dteFecha = $objAnticipoDevolucion->dteFecha.' '.date("H:i:s"); 

		//Tabla anticipos_devolucion
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha, 
						  'prospecto_id' => $objAnticipoDevolucion->intProspectoID,
						  'razon_social' => $objAnticipoDevolucion->strRazonSocial,
						  'rfc' => $objAnticipoDevolucion->strRfc,
						  'cliente_cuenta_bancaria' => $objAnticipoDevolucion->strClienteCuentaBancaria,
						  'cliente_banco_id' => $objAnticipoDevolucion->intClienteBancoID,
						  'cuenta_bancaria_id' => $objAnticipoDevolucion->intCuentaBancariaID,
						  'motivo' => $objAnticipoDevolucion->strMotivo,
						  'observaciones' => $objAnticipoDevolucion->strObservaciones, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objAnticipoDevolucion->intUsuarioID);
		$this->db->where('anticipo_devolucion_id', $objAnticipoDevolucion->intAnticipoDevolucionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('anticipos_devolucion', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('anticipo_devolucion_id', $objAnticipoDevolucion->intAnticipoDevolucionID);
		$this->db->delete('anticipos_devolucion_detalles');
		//Hacer un llamado al método para guardar los detalles de la devolución
		$this->guardar_detalles($objAnticipoDevolucion);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intAnticipoDevolucionID)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('anticipo_devolucion_id', $intAnticipoDevolucionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('anticipos_devolucion', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intAnticipoDevolucionID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		$this->db->select("AD.anticipo_devolucion_id, AD.folio, DATE_FORMAT(AD.fecha,'%d/%m/%Y') AS fecha, 
						   AD.prospecto_id, AD.razon_social, AD.rfc, 
						   AD.cliente_cuenta_bancaria, AD.cuenta_bancaria_id, AD.cliente_banco_id,
						   AD.motivo, AD.observaciones,  AD.estatus, 
						   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria,
						   CB.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, 
						   M.codigo AS codigo_moneda,
						   CONCAT_WS(' - ', B.codigo, B.descripcion) AS cliente_banco,
						   C.calle, C.numero_exterior, C.numero_interior, C.colonia, 
						   C.localidad, CP.codigo_postal, MC.descripcion AS municipio,  
						   E.descripcion AS estado, PRO.codigo AS CodigoProspecto,
						   UC.usuario AS usuario_creacion,
						   DATE_FORMAT(AD.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('anticipos_devolucion AS AD');
		$this->db->join('cuentas_bancarias AS CB', 'AD.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'AD.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_codigos_postales AS CP', 'C.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'left');
		$this->db->join('sat_estados AS E', 'MC.estado_id = E.estado_id', 'left');
	    $this->db->join('sat_bancos AS B', 'AD.cliente_banco_id = B.banco_id', 'left');
		$this->db->join('usuarios AS UC', 'AD.usuario_creacion = UC.usuario_id', 'left');
		//Si existe id de la devolución 
		if ($intAnticipoDevolucionID != NULL)
		{   
			$this->db->where('AD.anticipo_devolucion_id', $intAnticipoDevolucionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('AD.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('AD.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(AD.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('AD.estatus', $strEstatus);
			}

			$this->db->where("((AD.folio LIKE '%$strBusqueda%') OR
		    			   	   (CONCAT_WS(' - ', AD.rfc, AD.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', AD.rfc, AD.razon_social) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' - ', AD.razon_social, AD.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', AD.razon_social, AD.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
		                       (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))");

			$this->db->order_by('AD.fecha DESC, AD.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						                    $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('anticipos_devolucion AS AD');
		$this->db->join('cuentas_bancarias AS CB', 'AD.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'AD.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
		$this->db->where('AD.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('AD.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(AD.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('AD.estatus', $strEstatus);
		}

		$this->db->where("((AD.folio LIKE '%$strBusqueda%') OR
	    			   	   (CONCAT_WS(' - ', AD.rfc, AD.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', AD.rfc, AD.razon_social) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' - ', AD.razon_social, AD.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', AD.razon_social, AD.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
	                       (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))");

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,
		                   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('AD.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('AD.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(AD.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PP.estatus', $strEstatus);
		}

		$this->db->where("((AD.folio LIKE '%$strBusqueda%') OR
	    			   	   (CONCAT_WS(' - ', AD.rfc, AD.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', AD.rfc, AD.razon_social) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' - ', AD.razon_social, AD.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', AD.razon_social, AD.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
	                       (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))");

		$this->db->from('anticipos_devolucion AS AD');
		$this->db->join('cuentas_bancarias AS CB', 'AD.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'AD.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("AD.anticipo_devolucion_id, AD.folio, 
						   DATE_FORMAT(AD.fecha,'%d/%m/%Y') AS fecha, 
						   AD.rfc, AD.razon_social, AD.estatus, 
						   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria", FALSE);
		$this->db->from('anticipos_devolucion AS AD');
		$this->db->join('cuentas_bancarias AS CB', 'AD.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'AD.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
		$this->db->where('AD.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('AD.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(AD.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('AD.estatus', $strEstatus);
		}

		$this->db->where("((AD.folio LIKE '%$strBusqueda%') OR
	    			   	   (CONCAT_WS(' - ', AD.rfc, AD.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', AD.rfc, AD.razon_social) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' - ', AD.razon_social, AD.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', AD.razon_social, AD.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
	                       (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))");

		$this->db->order_by('AD.fecha DESC, AD.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["devoluciones"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones de la tabla anticipos_devolucion_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la devolución
	public function guardar_detalles(stdClass $objAnticipoDevolucion)
	{
		/*Quitar | de la lista para obtener el referencia, referencia_id, subtotal, iva e ieps
		*/
		$arrReferencias = explode("|", $objAnticipoDevolucion->strReferencias);
		$arrReferenciaID = explode("|", $objAnticipoDevolucion->strReferenciaID);
		$arrSubtotales = explode("|", $objAnticipoDevolucion->strSubtotales);
		$arrTasaCuotaIva = explode("|", $objAnticipoDevolucion->strTasaCuotaIva);
		$arrIvas = explode("|", $objAnticipoDevolucion->strIvas);
		$arrTasaCuotaIeps = explode("|", $objAnticipoDevolucion->strTasaCuotaIeps);
		$arrIeps = explode("|", $objAnticipoDevolucion->strIeps);

		//Hacer recorrido para insertar los datos en la tabla anticipos_devolucion_detalles
		for ($intCon = 0; $intCon < sizeof($arrReferencias); $intCon++) 
		{

			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

			//Separar cadena para obtener la referencia del detalle,  por ejemplo: CARTERA - REFACCIONES será CARTERA
			$arrTipoReferencia = explode(" - ", $arrReferencias[$intCon]);

			//Asignar datos al array
			$arrDatos = array('anticipo_devolucion_id' => $objAnticipoDevolucion->intAnticipoDevolucionID,
							  'renglon' => ($intCon + 1),
							  'referencia' => $arrTipoReferencia[0], 
							  'referencia_id' => $arrReferenciaID[$intCon],
							  'subtotal' => $arrSubtotales[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva' => $arrIvas[$intCon],
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps' => $arrIeps[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('anticipos_devolucion_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intAnticipoDevolucionID)
	{

		$this->db->select('DAD.referencia, DAD.referencia_id, DAD.subtotal, 
						   DAD.tasa_cuota_iva, DAD.iva, DAD.tasa_cuota_ieps, DAD.ieps, 
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps');
		$this->db->from('anticipos_devolucion_detalles AS DAD');
		$this->db->join('sat_tasa_cuota AS TIva', 'DAD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'DAD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('DAD.anticipo_devolucion_id', $intAnticipoDevolucionID);
		$this->db->order_by('DAD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}	
?>