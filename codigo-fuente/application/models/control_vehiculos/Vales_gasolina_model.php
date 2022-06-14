<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Vales_gasolina_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objValeGasolina)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
		
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objValeGasolina->strFolio); 

		//Tabla vales_gasolina
		//Asignar datos al array
		$arrDatos = array('folio' => $strFolioConsecutivo, 
						  'fecha' => $objValeGasolina->dteFecha,
						  'proveedor_id' => $objValeGasolina->intProveedorID,
						  'hora' => $objValeGasolina->strHora,
						  'bomba' => $objValeGasolina->strBomba,
						  'factura' => $objValeGasolina->strFactura, 
						  'vehiculo_id' => $objValeGasolina->intVehiculoID, 
						  'kilometraje' => $objValeGasolina->intKilometraje,
						  'empleado_id' => $objValeGasolina->intEmpleadoID,
						  'modulo_id' => $objValeGasolina->intModuloID,
						  'sucursal_id' => $objValeGasolina->intSucursalID,
						  'destino' => $objValeGasolina->strDestino,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objValeGasolina->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('vales_gasolina', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objValeGasolina->intValeGasolinaID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles correspondientes al vale
		$this->guardar_detalles($objValeGasolina);

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
	public function modificar(stdClass $objValeGasolina)
	{
		//Asignar datos al array
		$arrDatos = array('fecha' => $objValeGasolina->dteFecha,
						  'proveedor_id' => $objValeGasolina->intProveedorID,
						  'hora' => $objValeGasolina->strHora,
						  'bomba' => $objValeGasolina->strBomba,
						  'factura' => $objValeGasolina->strFactura, 
						  'vehiculo_id' => $objValeGasolina->intVehiculoID, 
						  'kilometraje' => $objValeGasolina->intKilometraje,
						  'empleado_id' => $objValeGasolina->intEmpleadoID,
						  'modulo_id' => $objValeGasolina->intModuloID,
						  'sucursal_id' => $objValeGasolina->intSucursalID,
						  'destino' => $objValeGasolina->strDestino,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objValeGasolina->intUsuarioID);
		$this->db->where('vale_gasolina_id', $objValeGasolina->intValeGasolinaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('vales_gasolina', $arrDatos);

		//Eliminar los detalles del vale previamente guardados
		$this->db->where('vale_gasolina_id', $objValeGasolina->intValeGasolinaID);
		$this->db->delete('vales_gasolina_detalles');
		
		//Hacer un llamado al método para guardar los detalles correspondientes al vale
		$this->guardar_detalles($objValeGasolina);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intValeGasolinaID, $strEstatus)
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
		$this->db->where('vale_gasolina_id', $intValeGasolinaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('vales_gasolina', $arrDatos);
	}

	//Función que se utiliza para guardar los detalles del vale
	public function guardar_detalles(stdClass $objValeGasolina)
	{
		//Si existen articulos
		if($objValeGasolina->strArticulos !== '')
		{
			//Quitar | de la lista para obtener el artículo, litros e importe
			$arrArticulos = explode("|", $objValeGasolina->strArticulos);
			$arrLitros = explode("|", $objValeGasolina->strLitros);
			$arrSubtotales = explode("|", $objValeGasolina->strSubtotales);
			$arrIvas = explode("|", $objValeGasolina->strIvas);

			//Hacer recorrido para insertar los datos en la tabla vales_gasolina_detalles
			for ($intCon = 0; $intCon < sizeof($arrArticulos); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('vale_gasolina_id' => $objValeGasolina->intValeGasolinaID,
					 			  'renglon' => ($intCon + 1),
								  'articulo' => $arrArticulos[$intCon],
								  'litros' => $arrLitros[$intCon],
								  'subtotal' => $arrSubtotales[$intCon],
								  'iva' => $arrIvas[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('vales_gasolina_detalles', $arrDatos);
			}
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intValeGasolinaID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
					       $intVehiculoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		$this->db->select("VG.vale_gasolina_id, VG.folio, DATE_FORMAT(VG.fecha,'%d/%m/%Y') AS fecha, 
						   	VG.proveedor_id, VG.hora, 
						   	DATE_FORMAT(CONCAT(VG.fecha, ' ', VG.hora), '%h:%i %p') AS hora_format,
						   	VG.bomba, VG.factura, VG.vehiculo_id, 	
						    VG.kilometraje, VG.empleado_id, VG.modulo_id,
						    VG.sucursal_id, VG.destino, VG.estatus,
						    CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca) AS vehiculo,
						    V.placas, CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
						   	CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) AS empleado,
						    S.nombre AS sucursal, M.descripcion AS modulo,
						   	CONVERT(CONCAT(fecha, ' ', hora), DATETIME) AS fecha_hora,
					        VG.kilometraje AS kilometraje_final,
					        CASE 
							    WHEN  VG.sucursal_id > 0 
							       THEN ''
							    ELSE 'SI' 
						    END AS corporativo,
					        CASE 
							 	WHEN 
									(SELECT kilometraje
									FROM vales_gasolina
									WHERE vehiculo_id = VG.vehiculo_id
									AND CONVERT(CONCAT(fecha, ' ', hora), DATETIME) < fecha_hora
									ORDER BY fecha DESC 
									LIMIT 1)
					            IS NULL
							 	THEN (SELECT kilometraje
									  FROM vehiculos
									  WHERE vehiculo_id = VG.vehiculo_id
									  LIMIT 1)	
							 	ELSE (SELECT kilometraje
									  FROM vales_gasolina
									  WHERE vehiculo_id = VG.vehiculo_id
									  AND CONVERT(CONCAT(fecha, ' ', hora), DATETIME) < fecha_hora
									  ORDER BY fecha DESC 
									  LIMIT 1)
							END AS kilometraje_inicial, 
							P.rfc, P.telefono_principal,  
						    P.calle, P.numero_exterior, P.numero_interior, P.colonia,  
						    P.localidad, MP.descripcion AS municipio, EP.descripcion AS estado,
						    CP.codigo_postal,
						   	U.usuario AS usuario_creacion,
						   	DATE_FORMAT(VG.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('vales_gasolina AS VG');
		$this->db->join('vehiculos AS V', 'VG.vehiculo_id = V.vehiculo_id', 'inner');
		$this->db->join('empleados AS E', 'VG.empleado_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'VG.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sucursales AS S', 'VG.sucursal_id = S.sucursal_id', 'left');
		$this->db->join('modulos AS M', 'VG.modulo_id = M.modulo_id', 'left');
		$this->db->join('usuarios AS U', 'U.usuario_id = VG.usuario_creacion', 'inner');
		//Si existe id del vale de gasolina
		if ($intValeGasolinaID !== NULL)
		{   
			$this->db->where('VG.vale_gasolina_id', $intValeGasolinaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
		    //Si existe id del vehículo
		    if($intVehiculoID > 0)
		    {
		   		$this->db->where('VG.vehiculo_id', $intVehiculoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {	   		
		   		$this->db->where("(VG.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);		   
		    
		    } 

			//Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('VG.estatus', $strEstatus);
			}
			$this->db->where("((VG.folio LIKE '%$strBusqueda%') OR
			  				   (CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)  LIKE '%$strBusqueda%') OR
	           				   (CONCAT_WS(' ', V.codigo, ' ', V.modelo, V.marca, V.placas)  LIKE '%$strBusqueda%') OR 
	           				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
				               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

			$this->db->order_by('VG.fecha DESC, VG.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para buscar detalles correspondientes a un vale
	public function buscar_detalles($intValeGasolinaID){
		$this->db->select('vale_gasolina_id, renglon, articulo,
						   litros, subtotal, tasa_cuota_iva, iva');
		$this->db->from('vales_gasolina_detalles');
	 	$this->db->order_by('renglon', 'ASC');
	 	$this->db->where('vale_gasolina_id', $intValeGasolinaID);
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intVehiculoID = NULL, 
						  $strEstatus = NULL, $strBusqueda =  NULL,$intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id del vehículo
	    if($intVehiculoID != NULL)
	    {
	   		$this->db->where('VG.vehiculo_id', $intVehiculoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		
	   		$this->db->where("(VG.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

		//Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('VG.estatus', $strEstatus);
		}
		$this->db->where("((VG.folio LIKE '%$strBusqueda%') OR
		  				   (CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)  LIKE '%$strBusqueda%') OR
           				   (CONCAT_WS(' ', V.codigo, ' ', V.modelo, V.marca, V.placas)  LIKE '%$strBusqueda%') OR 
           				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->from('vales_gasolina AS VG');
		$this->db->join('vehiculos AS V', 'VG.vehiculo_id = V.vehiculo_id', 'inner');
		$this->db->join('empleados AS E', 'VG.empleado_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'VG.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("VG.vale_gasolina_id, VG.folio, DATE_FORMAT(VG.fecha,'%d/%m/%Y') AS fecha,
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
				           CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas) AS vehiculo,
				           VG.estatus, 
				           (SELECT IFNULL(COUNT(OCC.orden_compra_combustible_id), 0)
							FROM ordenes_compra_combustibles AS OCC
							INNER JOIN ordenes_compra_combustibles_detalles AS OCCD ON OCCD.orden_compra_combustible_id = OCC.orden_compra_combustible_id
							WHERE OCCD.vale_gasolina_id = VG.vale_gasolina_id
							AND  (OCC.estatus = 'ACTIVO'  OR 
								  OCC.estatus = 'AUTORIZADO')) AS total_ordenes_compra", FALSE);
		$this->db->from('vales_gasolina AS VG');
		$this->db->join('vehiculos AS V', 'VG.vehiculo_id = V.vehiculo_id', 'inner');
		$this->db->join('empleados AS E', 'VG.empleado_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'VG.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		//Si existe id del vehículo
	    if($intVehiculoID != NULL)
	    {
	   		$this->db->where('VG.vehiculo_id', $intVehiculoID);
	    }

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		
	   		$this->db->where("(VG.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

		//Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('VG.estatus', $strEstatus);
		}
		$this->db->where("((VG.folio LIKE '%$strBusqueda%') OR
		  				   (CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)  LIKE '%$strBusqueda%') OR
           				   (CONCAT_WS(' ', V.codigo, ' ', V.modelo, V.marca, V.placas)  LIKE '%$strBusqueda%') OR 
           				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->order_by('VG.fecha DESC, VG.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["vales"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>