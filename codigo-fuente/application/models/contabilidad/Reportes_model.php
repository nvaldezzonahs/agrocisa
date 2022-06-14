<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo d

class Reportes_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla reportes
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objReporte)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 

		//Tabla reportes
		//Asignar datos al array
		$arrDatos = array('titulo' => $objReporte->strTitulo,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objReporte->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('reportes', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objReporte->intReporteID = $this->db->insert_id();


		//Hacer un llamado al método para guardar los detalles del reporte
		$this->guardar_detalles($objReporte);
		

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objReporte)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();

        //Tabla reportes
		//Asignar datos al array
		$arrDatos = array('titulo' => $objReporte->strTitulo,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objReporte->intUsuarioID);
		$this->db->where('reporte_id', $objReporte->intReporteID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('reportes', $arrDatos);

		//Eliminar las cuentas contables de los detalles guardados
		$this->db->where('reporte_id', $objReporte->intReporteID);
		$this->db->delete('reportes_detalles_cuentas');


		//Eliminar los detalles guardados
		$this->db->where('reporte_id', $objReporte->intReporteID);
		$this->db->delete('reportes_detalles');

		
		//Hacer un llamado al método para guardar los detalles del reporte
		$this->guardar_detalles($objReporte);
		
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	
	//Método para modificar el estatus de un registro
	public function set_estatus($intReporteID, $strEstatus)
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
		$this->db->where('reporte_id', $intReporteID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('reportes', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intReporteID = NULL, $strTitulo = NULL, $strBusqueda = NULL)
	{

		$this->db->select('reporte_id, titulo, estatus');
		$this->db->from('reportes');
		
		//Si existe id del reporte
		if ($intReporteID !== NULL)
		{   
			$this->db->where('reporte_id', $intReporteID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strTitulo !== NULL)//Si existe título
		{
			$this->db->where('titulo', $strTitulo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{

			$this->db->like('titulo', $strBusqueda);
	    	$this->db->or_like('estatus', $strBusqueda);
			$this->db->order_by('titulo', 'ASC');
			return $this->db->get()->result();
		}
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_agrupadores($strTitulo)
	{

		$this->db->select("DISTINCT RD.reporte_id, RD.concepto_padre, RD.titulo_total", FALSE);
	    $this->db->from('reportes_detalles AS RD');
	    $this->db->join('reportes AS R', 'RD.reporte_id = R.reporte_id', 'inner');
	    $this->db->where('R.titulo', $strTitulo);
	    $this->db->group_by('RD.concepto_padre');
	    $this->db->order_by('RD.renglon', 'ASC');
		return $this->db->get()->result();
	}

		//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_detalles_agrupador($intReporteID, $strConceptoPadre)
	{

		$this->db->select("RD.concepto, RD.titulo_principal, RD.titulo_secundario,
							(SELECT GROUP_CONCAT(CONCAT_WS('-', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel) ORDER BY RDC.renglon ASC SEPARATOR '|')
								FROM   reportes_detalles_cuentas AS RDC
                                INNER JOIN catalogo_cuentas AS CC ON RDC.cuenta_id = CC.cuenta_id
								WHERE  RDC.reporte_id = RD.reporte_id
                                AND RDC.renglon_detalles = RD.renglon) AS cuentas", FALSE);
	    $this->db->from('reportes_detalles AS RD');
	    $this->db->join('reportes AS R', 'RD.reporte_id = R.reporte_id', 'inner');
	    $this->db->where('RD.reporte_id', $intReporteID);
	    $this->db->where('RD.concepto_padre', $strConceptoPadre);
	    $this->db->order_by('RD.orden', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda =  NULL, $intNumRows, $intPos)
	{

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('titulo', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->from('reportes');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('reporte_id, titulo, estatus');
		$this->db->from('reportes');
		$this->db->like('titulo', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->order_by('titulo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["reportes"] =$this->db->get()->result();
		return $arrResultado;
	}


	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $intReporteID)
	{
		$this->db->select("DISTINCT RD.concepto_padre ", FALSE);
        $this->db->from('reportes_detalles AS RD');
	    $this->db->join('reportes AS R', 'RD.reporte_id = R.reporte_id', 'inner');
	    //Si existe id del reporte
	    if($intReporteID > 0)
	    {
 		  $this->db->where('R.reporte_id', $intReporteID);
	    }
	    $this->db->where('R.estatus', 'ACTIVO');
        //$this->db->where("(RD.concepto_padre  NOT LIKE '%|%')"); 
        $this->db->where("(RD.concepto_padre LIKE '%$strDescripcion%')");    
        $this->db->order_by("RD.concepto_padre",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
	
	/*******************************************************************************************************************
	Funciones de la tabla reportes_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del reporte
	public function guardar_detalles(stdClass $objReporte)
	{
		
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los detalles del reporte
		foreach ($objReporte->arrDetalles as $arrDets)
		{
			//Hacer recorrido para obtener los datos del detalle
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;
				//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
				//Asignar datos al array
				$arrDatos = array('reporte_id' => $objReporte->intReporteID,
								  'renglon' => $intRenglon,
								  'concepto_padre' => $arrDet->strConceptoPadre,
								  'concepto' => $arrDet->strConcepto,
								  'orden' => $arrDet->intOrden,
								  'titulo_principal' => $arrDet->strTituloPrincipal,
								  'titulo_secundario' => $arrDet->strTituloSecundario, 
								  'titulo_total' => $arrDet->strTituloTotal);
				//Guardar los datos del registro
				$this->db->insert('reportes_detalles', $arrDatos);

				//Hacer un llamado al método para guardar las cuentas del detalle
				$this->guardar_cuentas($objReporte->intReporteID, $intRenglon, 
													 $arrDet->arrCuentas);

			}
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intReporteID)
	{
		$this->db->select('renglon, concepto_padre, concepto, orden, titulo_principal, titulo_secundario, 
						  titulo_total');
		$this->db->from('reportes_detalles');
		$this->db->where('reporte_id', $intReporteID);
		$this->db->order_by('renglon, concepto_padre, orden ', 'ASC');
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla reportes_detalles_cuentas
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los pagos relacionados del detalle
	public function guardar_cuentas($intReporteID, $intRenglonDetalle, $arrCuentas)
	{
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener las cuentas del detalle
		foreach ($arrCuentas as $arrDet)
		{
			//Incrementar renglón consecutivo
			$intRenglon++;

			//Asignar datos al array
			$arrDatos = array('reporte_id' => $intReporteID,
							  'renglon_detalles' => $intRenglonDetalle,
							  'renglon' => $intRenglon,
							  'cuenta_id' => $arrDet->intCuentaID);
			//Guardar los datos del registro
			$this->db->insert('reportes_detalles_cuentas', $arrDatos);

		}
	}

    //Método para regresar las cuentas de un registro
	public function buscar_cuentas($intReporteID, $intRenglonDetalle)
	{
		$this->db->select(" RDC.renglon, 
							RDC.cuenta_id, 
							CONCAT_WS(' ', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel,'-',CC.descripcion) AS cuenta", FALSE);
		$this->db->from('reportes_detalles_cuentas AS RDC');
		$this->db->join('catalogo_cuentas AS CC', 'RDC.cuenta_id = CC.cuenta_id', 'inner');
		$this->db->where('RDC.reporte_id', $intReporteID);
		$this->db->where('RDC.renglon_detalles', $intRenglonDetalle);
		$this->db->order_by('RDC.renglon', 'ASC');
		return $this->db->get()->result();
	}

}
?>