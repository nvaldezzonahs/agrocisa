<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo_cuentas_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objCuenta)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Asignar datos al array
		$arrDatos = array('cuenta_padre_id' => $objCuenta->intCuentaPadreID, 
						  'sat_cuenta_id' => $objCuenta->intSatCuentaID, 
						  'primer_nivel' => $objCuenta->strPrimerNivel,
						  'segundo_nivel' => $objCuenta->strSegundoNivel,
						  'tercer_nivel' => $objCuenta->strTercerNivel,
						  'cuarto_nivel' => $objCuenta->strCuartoNivel,
						  'descripcion' => $objCuenta->strDescripcion,
						  'naturaleza' => $objCuenta->strNaturaleza,
						  'tipo_cuenta' => $objCuenta->strTipoCuenta,
						  'acepta_movimientos' => $objCuenta->strAceptaMovimientos,
						  'movimientos_bancarios' => $objCuenta->strMovimientosBancarios,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objCuenta->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('catalogo_cuentas', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objCuenta->intCuentaID = $this->db->insert_id();

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objCuenta->intCuentaID;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objCuenta)
	{
		//Asignar datos al array
		$arrDatos = array('cuenta_padre_id' => $objCuenta->intCuentaPadreID, 
						  'sat_cuenta_id' => $objCuenta->intSatCuentaID, 
						  'primer_nivel' => $objCuenta->strPrimerNivel,
						  'segundo_nivel' => $objCuenta->strSegundoNivel,
						  'tercer_nivel' => $objCuenta->strTercerNivel,
						  'cuarto_nivel' => $objCuenta->strCuartoNivel,
						  'descripcion' => $objCuenta->strDescripcion,
						  'naturaleza' => $objCuenta->strNaturaleza,
						  'tipo_cuenta' => $objCuenta->strTipoCuenta,
						  'acepta_movimientos' => $objCuenta->strAceptaMovimientos,
						  'movimientos_bancarios' => $objCuenta->strMovimientosBancarios,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objCuenta->intUsuarioID);
		$this->db->where('cuenta_id', $objCuenta->intCuentaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('catalogo_cuentas', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intCuentaID, $strEstatus)
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
		$this->db->where('cuenta_id', $intCuentaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('catalogo_cuentas', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCuentaID = NULL, $strCriteriosBusq = NULL, $strBusqueda = NULL, 
						   $strTipo = NULL, $strNivel = NULL, $strCuentaNivel = NULL, $strEstatus = NULL)
	{

		//Constante para identificar la cuenta de gastos de venta
        $strCuentaGastosVenta = CUENTA_GASTOS_VENTA;
        //Constante para identificar la cuenta de gastos de administración
        $strCuentaGastosAdmon = CUENTA_GASTOS_ADMINISTRACION;
        //Constante para identificar la cuenta de gastos financieros
        $strCuentaGastosFinancieros = CUENTA_GASTOS_FINANCIEROS;

		//Si el tipo corresponde al combobox, significa que los datos se van a cargar en un combobox
		if($strTipo == 'combobox')
		{
		
			$this->db->select("CONCAT(cuenta_id,'|',primer_nivel,'-',segundo_nivel, '-', tercer_nivel, '-', cuarto_nivel)
								AS value, descripcion AS nombre", FALSE);
			$this->db->from('catalogo_cuentas');
			$this->db->where('estatus', 'ACTIVO');

			//Si existe cuenta del nivel
			if($strCuentaNivel !== NULL)
			{
				//Quitar '|'  de la cadena (cuentaID|cuenta) para obtener los criterios de búsqueda
	            list($intCuentaID, $strCuenta) = explode("|", $strCuentaNivel); 
	            //Quitar '-'  de la cadena (primer_nivel-segundo_nivel-tercer_nivel-cuarto_nivel) para obtener los criterios de búsqueda
	            list($strPrimerNivel, $strSegundoNivel, $strTercerNivel, $strCuartoNivel) = explode("-", $strCuenta); 

	            //Si se cumple la sentencia
				if($strPrimerNivel == $strCuentaGastosFinancieros && $strSegundoNivel <> '00')
				{
					//Cambiar el nivel para recuperar cuentas
					$strNivel = 'NIVEL 3';
				}
			}

			//Dependiendo del nivel seleccionar la información
			if($strNivel == 'NIVEL 1')
			{
				$this->db->where("(primer_nivel = $strCuentaGastosVenta OR primer_nivel = $strCuentaGastosAdmon OR primer_nivel = $strCuentaGastosFinancieros)");
				$this->db->where('segundo_nivel', '00');
				$this->db->where('tercer_nivel', '00');
				$this->db->where('cuarto_nivel', '00000');
				$this->db->order_by('primer_nivel', 'ASC');
			}
			else if ($strNivel == 'NIVEL 2')
			{
				$this->db->where('primer_nivel', $strPrimerNivel);
				$this->db->where('segundo_nivel <>', '00');
				$this->db->where('tercer_nivel', '00');
				$this->db->where('cuarto_nivel', '00000');
				$this->db->order_by('segundo_nivel', 'ASC');
			}
			else if ($strNivel == 'NIVEL 3')
			{
				$this->db->where('primer_nivel', $strPrimerNivel);
				$this->db->where('segundo_nivel', $strSegundoNivel);
				$this->db->where('tercer_nivel <>', '00');
				$this->db->where('cuarto_nivel', '00000');
				$this->db->order_by('tercer_nivel', 'ASC');
			}
			else //Nivel 4
			{
				$this->db->where('primer_nivel', $strPrimerNivel);
				$this->db->where('segundo_nivel', $strSegundoNivel);
				$this->db->where('tercer_nivel', $strTercerNivel);
				$this->db->where('cuarto_nivel <>', '00000');
				$this->db->order_by('cuarto_nivel', 'ASC');
			}
			
			return $this->db->get()->result();
		}
		else
		{
			$this->db->select("CC.cuenta_id, CC.cuenta_padre_id, CC.sat_cuenta_id, 
							   CC.primer_nivel, CC.segundo_nivel, 
						  	   CC.tercer_nivel, CC.cuarto_nivel, CC.descripcion, CC.naturaleza,  CC.tipo_cuenta,
							   CC.acepta_movimientos, CC.movimientos_bancarios, CC.estatus,
							   CONCAT_WS(' ', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel) AS cuenta,
							   CONCAT_WS(' - ', SCC.codigo, SCC.descripcion) AS sat_cuenta,
							   CASE 
								    WHEN   CC.cuenta_padre_id > 0 
								    THEN  CONCAT_WS(' ', CCP.primer_nivel, CCP.segundo_nivel, CCP.tercer_nivel, CCP.cuarto_nivel, '-', CCP.descripcion)
									ELSE ''
							   END AS cuenta_padre, CCP.descripcion AS descripcion_cuenta_padre", FALSE);
			$this->db->from('catalogo_cuentas CC');
			$this->db->join('sat_catalogo_cuentas AS SCC', 'CC.sat_cuenta_id = SCC.sat_cuenta_id', 'inner');
			$this->db->join('catalogo_cuentas AS CCP', 'CC.cuenta_padre_id = CCP.cuenta_id', 'left');
			//Si existe id de la cuenta
			if ($intCuentaID !== NULL)
			{   
				$this->db->where('CC.cuenta_id', $intCuentaID);
				$this->db->limit(1);
				return $this->db->get()->row();
			}
			else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
			{
				//Quitar '|'  de la cadena (primer_nivel|segundo_nivel|tercer_nivel|cuarto_nivel) para obtener los criterios de búsqueda
	            list($strPrimerNivel, $strSegundoNivel, $strTercerNivel, $strCuartoNivel) = explode("|", $strCriteriosBusq); 
				$this->db->where('CC.primer_nivel', $strPrimerNivel);
				$this->db->where('CC.segundo_nivel', $strSegundoNivel);
				$this->db->where('CC.tercer_nivel', $strTercerNivel);
				$this->db->where('CC.cuarto_nivel', $strCuartoNivel);
				//Si existe estatus
				if($strEstatus !== NULL)
				{
				 	$this->db->where('CC.estatus', $strEstatus);
				}

				$this->db->limit(1);
				return $this->db->get()->row();
			}
			else if ($strNivel !== NULL)//Si existe nivel
			{

				//Dependiendo del nivel seleccionar la información
				if($strNivel == 'NIVEL 1')//Cuenta mayor
				{
					$this->db->where('CC.segundo_nivel', '00');
					$this->db->where('CC.tercer_nivel', '00');
					$this->db->where('CC.cuarto_nivel', '00000');
				}
				else if($strNivel == 'NIVEL 2')
				{
					$this->db->where('CC.segundo_nivel <>', '00');
					$this->db->where('CC.tercer_nivel', '00');
					$this->db->where('CC.cuarto_nivel', '00000');
				}
				else if($strNivel == 'NIVEL 3')
				{
					$this->db->where('CC.tercer_nivel <>', '00');
					$this->db->where('CC.cuarto_nivel', '00000');
				}
				else //Nivel 4
				{

					$this->db->where('CC.cuarto_nivel <>', '00000');
				}

				$this->db->order_by('CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel');
				return $this->db->get()->result();
			}
			else 
			{
				$this->db->like('CC.descripcion', $strBusqueda);
	        	$this->db->or_like('CC.estatus', $strBusqueda);
			    $this->db->or_like("CONCAT_WS('-', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel)", $strBusqueda);
		        $this->db->or_like("CONCAT_WS('', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel)", $strBusqueda);
		        $this->db->or_like("CONCAT_WS(' ', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel)", $strBusqueda);
		        $this->db->or_like("CONCAT_WS(' - ', SCC.codigo, SCC.descripcion)", $strBusqueda);
       			$this->db->or_like("CONCAT_WS(' ', CCP.primer_nivel, CCP.segundo_nivel, CCP.tercer_nivel, CCP.cuarto_nivel, '-', CCP.descripcion)", $strBusqueda);
		        $this->db->or_like('SCC.codigo', $strBusqueda);
		        $this->db->or_like('SCC.descripcion', $strBusqueda);
				$this->db->order_by('CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel');
				return $this->db->get()->result();
			}

		}
		
	}


	/*Método para regresar el saldo de las cuentas contables
     *(se utiliza en los reportes de auxiliares contables)*/
	public function buscar_saldos_cuentas($dteFechaInicial, $dteFechaFinal, $strCuentaInicial, 
										  $strCuentaFinal)
	{

		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		$strRestricciones = '';
		
		//Si existe cuenta contable
		if($strCuentaInicial != NULL OR $strCuentaFinal != NULL)
		{
			$strRestricciones .= "WHERE ";

			//Si existe cuenta final
			if($strCuentaFinal != NULL)
			{
				$strRestricciones .= "CONCAT(CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel) >= '$strCuentaInicial'";
				$strRestricciones .= " AND CONCAT(CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel) <= '$strCuentaFinal'";

			}
			else
			{
				$strRestricciones .= "CONCAT(CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel) LIKE '%$strCuentaInicial%'";
			}

		}
		
		
		//Variable que se utiliza para formar la  consulta
		$queryCuentas = "SELECT CC.cuenta_id, CC.descripcion, CC.naturaleza,
							    CONCAT_WS(' ', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel) AS cuenta,
							     CCP.descripcion AS descripcion_cuenta_padre, 
       						   CONCAT_WS(' ', CPN1.primer_nivel, CPN1.segundo_nivel, CPN1.tercer_nivel, CPN1.cuarto_nivel) AS cuenta_primer_nivel,
	   						   CPN1.descripcion AS descripcion_cuenta_primer_nivel,
	   						   CONCAT_WS(' ', CPN2.primer_nivel, CPN2.segundo_nivel, CPN2.tercer_nivel, CPN2.cuarto_nivel) AS cuenta_segundo_nivel,
       						   CPN2.descripcion AS descripcion_cuenta_segundo_nivel,
	   						   CONCAT_WS(' ', CCP.primer_nivel, CCP.segundo_nivel, CCP.tercer_nivel, CCP.cuarto_nivel) AS cuenta_tercer_nivel, 
	   						   IFNULL(CargosSdoInicial.Total, 0) AS cargos_saldo_inicial, 
	   						   IFNULL(AbonosSdoInicial.Total, 0) AS abonos_saldo_inicial, 
	   						   IFNULL(CargosSdoActual.Total, 0) AS cargos_saldo_actual,
	   						   IFNULL(AbonosSdoActual.Total, 0) AS abonos_saldo_actual 
						 FROM catalogo_cuentas AS CC
						 LEFT JOIN catalogo_cuentas AS CCP ON CC.cuenta_padre_id = CCP.cuenta_id
						 LEFT JOIN catalogo_cuentas AS CPN2 ON CCP.cuenta_padre_id = CPN2.cuenta_id
						 LEFT JOIN catalogo_cuentas AS CPN1 ON CPN2.cuenta_padre_id = CPN1.cuenta_id
						 LEFT JOIN (SELECT PD.cuenta_id AS referenciaID,
						 				   SUM(PD.importe) AS Total
						 			FROM  polizas AS P
						 		    INNER JOIN polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
						 		    WHERE PD.naturaleza = 'CARGO'
						 		    AND  P.fecha < '$dteFechaInicial'
						 		    AND P.estatus = 'ACTIVO'
						 		    GROUP BY  PD.cuenta_id) AS CargosSdoInicial ON CargosSdoInicial.referenciaID = CC.cuenta_id
						 LEFT JOIN (SELECT PD.cuenta_id AS referenciaID,
						 				   SUM(PD.importe) AS Total
						 			FROM  polizas AS P
						 		    INNER JOIN polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
						 		    WHERE PD.naturaleza = 'ABONO'
						 		    AND  P.fecha < '$dteFechaInicial'
						 		    AND P.estatus = 'ACTIVO'
						 		    GROUP BY  PD.cuenta_id) AS AbonosSdoInicial ON AbonosSdoInicial.referenciaID = CC.cuenta_id
						LEFT JOIN (SELECT PD.cuenta_id AS referenciaID,
						 				   SUM(PD.importe) AS Total
						 			FROM  polizas AS P
						 		    INNER JOIN polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
						 		    WHERE PD.naturaleza = 'CARGO'
						 		    AND  P.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
						 		    AND P.estatus = 'ACTIVO'
						 		    GROUP BY  PD.cuenta_id) AS CargosSdoActual ON CargosSdoActual.referenciaID = CC.cuenta_id
						LEFT JOIN (SELECT PD.cuenta_id AS referenciaID,
						 				   SUM(PD.importe) AS Total
						 			FROM  polizas AS P
						 		    INNER JOIN polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
						 		    WHERE PD.naturaleza = 'ABONO'
						 		    AND  P.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
						 		    AND P.estatus = 'ACTIVO'
						 		    GROUP BY  PD.cuenta_id) AS AbonosSdoActual ON AbonosSdoActual.referenciaID = CC.cuenta_id
						 $strRestricciones
						 ORDER BY CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel";

	
		$strSQL = $this->db->query($queryCuentas);
		return $strSQL->result();
		
	}

   	
   	 /*Método para regresar los saldos de una cuenta contable
     *(se utiliza en el reporte balanza de comprobación)*/
    public function buscar_saldos_cuenta_balanza_comp($dteFechaInicial, $dteFechaFinal, $arrCta)
	{
		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		$strRestricciones = '';

		//Variable para asignar el id de la cuenta
	    $intCuentaID = $arrCta->cuenta_id;
		//Variable para asignar la cuenta del primer nivel
	    $strPrimerNivel = $arrCta->primer_nivel;
	    //Variable para asignar la cuenta del segundo nivel
	    $strSegundoNivel = $arrCta->segundo_nivel;
	    //Variable para asignar la cuenta del tercer nivel
	    $strTercerNivel = $arrCta->tercer_nivel;
	   

		//Variable que se utiliza para agregar los saldos de la cuenta
		$querySaldosCta = "SELECT IFNULL((SELECT SUM(PD.importe)
										  FROM  polizas AS P
										  INNER JOIN  polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
										  WHERE PD.cuenta_id = CC.cuenta_id
										  AND PD.naturaleza = 'CARGO'
										  AND  P.fecha < '$dteFechaInicial'
										  AND P.estatus = 'ACTIVO'),0) AS cargos_saldo_inicial,";

		$querySaldosCta .= "IFNULL((SELECT SUM(PD.importe) 
									FROM  polizas AS P
								    INNER JOIN  polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
									WHERE PD.cuenta_id = CC.cuenta_id
									AND PD.naturaleza = 'ABONO'
									AND  P.fecha < '$dteFechaInicial'
									AND P.estatus = 'ACTIVO'),0) AS abonos_saldo_inicial,";

		$querySaldosCta .= "IFNULL((SELECT SUM(PD.importe) 
									    FROM  polizas AS P
									    INNER JOIN  polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
									    WHERE PD.cuenta_id = CC.cuenta_id
									    AND PD.naturaleza = 'CARGO'
									    AND P.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
									    AND P.estatus = 'ACTIVO'),0) AS cargos_saldo_actual,";

		$querySaldosCta .= "IFNULL((SELECT SUM(PD.importe) 
								   FROM  polizas AS P
								   INNER JOIN  polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
								   WHERE PD.cuenta_id = CC.cuenta_id
								   AND PD.naturaleza = 'ABONO'
								   AND P.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
								   AND P.estatus = 'ACTIVO'),0) AS abonos_saldo_actual";
	    $querySaldosCta .= " FROM catalogo_cuentas AS CC ";

	    //Formar consulta
		$queryCuenta = $querySaldosCta;
		$queryCuenta .= " WHERE CC.primer_nivel = '$strPrimerNivel' ";

		//Si se cumple la sentencia
		if (($strSegundoNivel != "00") OR ($arrCta->acepta_movimientos == "SI"))
		{
			
			$queryCuenta .= " AND CC.segundo_nivel = '$strSegundoNivel' ";
			
		}

		//Si existe cuenta del tercer nivel
		if($strTercerNivel != "00")
		{	
			//Si la cuenta no acepta movimientos
			if($arrCta->acepta_movimientos == "NO")
			{	
				//Formar consulta
				$queryCuenta = $querySaldosCta;
				$queryCuenta .= " WHERE CC.cuenta_padre_id = $intCuentaID ";

			}
			else
			{
				$queryCuenta .= " AND  CC.tercer_nivel = '$strTercerNivel' ";
			}

		}


		$strSQL = $this->db->query($queryCuenta);
		return $strSQL->result();
	}

   /*Método para regresar el acumulado de los saldos de las cuentas contables
     *(se utiliza en el reporte resumen de auxiliares contables)*/
    public function buscar_saldos_cuentas_resumen($dteFechaInicial, $dteFechaFinal, $strCuentaInicial, 
										  	 	   $strCuentaFinal, $strFormulario = NULL)
	{
		//Arreglo para el resultado
	    $arrDatos = array();

		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		$strRestricciones = '';

		//Si el formulario (proceso) corresponde al reporte análisis de mayores
		if($strFormulario == 'ANALISIS MAYORES')
		{
			$strRestricciones .= "WHERE ";
			$strRestricciones .= "segundo_nivel = '00'";
			$strRestricciones .= " AND tercer_nivel = '00'";
			$strRestricciones .= " AND cuarto_nivel = '00000'";
		}
		
		//Si existe cuenta contable
		if($strCuentaInicial != NULL OR $strCuentaFinal != NULL)
		{
			//Si no existen restricciones asignar condición WHERE
			$strRestricciones .= (($strRestricciones !== '') ? 
									" AND " : "WHERE ");

			//Si existe cuenta final
			if($strCuentaFinal != NULL)
			{
				$strRestricciones .= "CONCAT(primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel) >= '$strCuentaInicial'";
				$strRestricciones .= " AND CONCAT(primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel) <= '$strCuentaFinal'";

			}
			else
			{
				$strRestricciones .= "CONCAT(primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel) LIKE '%$strCuentaInicial%'";
			}

		}

		
		//Seleccionar todas las cuentas que coincidan con los criterios de búsqueda
		$queryCuentas = "SELECT cuenta_id, descripcion, naturaleza, 
							    CONCAT_WS(' ', primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel) AS cuenta, descripcion, primer_nivel, segundo_nivel, 
							    tercer_nivel, cuarto_nivel
					      FROM catalogo_cuentas
						  $strRestricciones
						  ORDER BY primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel";
		$objCuentas = $this->db->query($queryCuentas);

		//Hacer recorrido para obtener los datos de la cuenta
		foreach ($objCuentas->result() as $arrCta)
		{
			//Variable para asignar la cuenta del primer nivel
			$strPrimerNivel = $arrCta->primer_nivel;
			//Variable para asignar la cuenta del segundo nivel
			$strSegundoNivel = $arrCta->segundo_nivel;
			//Variable para asignar la cuenta del tercer nivel
			$strTercerNivel = $arrCta->tercer_nivel;
			//Variable para asignar la cuenta del cuarto nivel
			$strCuartoNivel = $arrCta->cuarto_nivel;

			//Variable que se utiliza para asignar el acumulado de los cargos (saldo inicial)
			$intAcumCargosSdoInicial = 0;
			//Variable que se utiliza para asignar el acumulado de los abonos (saldo inicial)
			$intAcumAbonosSdoInicial = 0;
			//Variable que se utiliza para asignar el acumulado de los cargos (saldo actual)
			$intAcumCargosSdoActual = 0;
			//Variable que se utiliza para asignar el acumulado de los abonos (saldo actual)
			$intAcumAbonosSdoActual = 0;

			
			//Variable que se utiliza para agregar los saldos de la cuenta
			$querySaldosCta = "SELECT IFNULL((SELECT SUM(PD.importe)
											  FROM  polizas AS P
											  INNER JOIN  polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
											  WHERE PD.cuenta_id = CC.cuenta_id
											  AND PD.naturaleza = 'CARGO'
											  AND  P.fecha < '$dteFechaInicial'
											  AND P.estatus = 'ACTIVO'),0) AS cargos_saldo_inicial,";

			$querySaldosCta .= "IFNULL((SELECT SUM(PD.importe) AS abonos
									    FROM  polizas AS P
									    INNER JOIN  polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
									    WHERE PD.cuenta_id = CC.cuenta_id
									    AND PD.naturaleza = 'ABONO'
									    AND  P.fecha < '$dteFechaInicial'
									    AND P.estatus = 'ACTIVO'),0) AS abonos_saldo_inicial,";


			$querySaldosCta .= "IFNULL((SELECT SUM(PD.importe) AS cargos
									    FROM  polizas AS P
									    INNER JOIN  polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
									    WHERE PD.cuenta_id = CC.cuenta_id
									    AND PD.naturaleza = 'CARGO'
									    AND P.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
									    AND P.estatus = 'ACTIVO'),0) AS cargos_saldo_actual,";

			$querySaldosCta .= "IFNULL((SELECT SUM(PD.importe) AS abonos
									   FROM  polizas AS P
									   INNER JOIN  polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
									   WHERE PD.cuenta_id = CC.cuenta_id
									   AND PD.naturaleza = 'ABONO'
									   AND P.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
									   AND P.estatus = 'ACTIVO'),0) AS abonos_saldo_actual";

			$querySaldosCta .= " FROM catalogo_cuentas AS CC ";
			$querySaldosCta .= " WHERE CC.primer_nivel = '$strPrimerNivel' ";

			//Si existe cuenta del segundo nivel
			if($strSegundoNivel != "00")
			{
				$querySaldosCta .= " AND CC.segundo_nivel = '$strSegundoNivel' ";
			}

			//Si existe cuenta del tercer nivel
			if($strTercerNivel != "00")
			{
				$querySaldosCta .= " AND CC.tercer_nivel = '$strTercerNivel' ";
			}

			//Si existe cuenta del cuarto nivel
			if($strCuartoNivel != "00000")
			{
				$querySaldosCta .= " AND CC. cuarto_nivel = '$strCuartoNivel' ";
			}

			//Realizar búsqueda de datos (saldos de la cuenta)
			$objSaldosCta =  $this->db->query($querySaldosCta);


			//Hacer recorrido para obtener los saldos de la cuenta
			foreach ($objSaldosCta->result() as $arrSdo)
			{
				//Incrementar acumulados
				$intAcumCargosSdoInicial += $arrSdo->cargos_saldo_inicial;
				$intAcumAbonosSdoInicial += $arrSdo->abonos_saldo_inicial;
				$intAcumCargosSdoActual += $arrSdo->cargos_saldo_actual;
				$intAcumAbonosSdoActual += $arrSdo->abonos_saldo_actual;

			}//Cierre de foreach (saldos)

			//Crear un objeto vacio, stdClass es el objeto por default de PHP
			$objCuenta = new stdClass();

			//Agregar datos al objeto
			$objCuenta->cuenta = $arrCta->cuenta;
			$objCuenta->descripcion = $arrCta->descripcion;
			$objCuenta->naturaleza = $arrCta->naturaleza;
			$objCuenta->cargos_saldo_inicial = $intAcumCargosSdoInicial;
			$objCuenta->abonos_saldo_inicial = $intAcumAbonosSdoInicial;
			$objCuenta->cargos_saldo_actual = $intAcumCargosSdoActual;
			$objCuenta->abonos_saldo_actual = $intAcumAbonosSdoActual;

			//Agregar objeto al array
			$arrDatos[] = $objCuenta;


		}//Cierre de foreach (cuentas)

		//Regresar array con los saldos de las cuentas
	    return  $arrDatos;
	}


	/*Método para regresar los costos (cargos y abonos)  de una cuenta contable
     *(se utiliza al momento de generar una póliza)*/
	public function buscar_costos_cuenta($intCuentaID, $dteFecha)
	{
		$strSQL = $this->db->query("SELECT CC.cuenta_id, 
								       IFNULL((SELECT SUM(PD.importe) AS importe 
								               FROM   polizas P INNER JOIN polizas_detalles PD ON PD.poliza_id = P.poliza_id 
								               WHERE  P.fecha <= '$dteFecha' 
								               AND    P.estatus = 'ACTIVO' 
								               AND    PD.cuenta_id = CC.cuenta_id 
								               AND    PD.naturaleza = 'CARGO'), 0) AS Cargos, 
								        IFNULL((SELECT SUM(PD.importe) AS importe 
								                FROM   polizas P INNER JOIN polizas_detalles PD ON PD.poliza_id = P.poliza_id 
								                WHERE  P.fecha <= '$dteFecha' 
								                AND    P.estatus = 'ACTIVO' 
								                AND    PD.cuenta_id = CC.cuenta_id 
								                AND    PD.naturaleza = 'ABONO'), 0) AS Abonos 
									FROM   catalogo_cuentas CC 
									WHERE  CC.cuenta_id = $intCuentaID");

		return $strSQL->result();
	}
	


	/*Método para regresar los movimientos (pólizas) de las cuentas contables
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte de análisis de auxiliares contables)*/
	public function buscar_movimientos_analisis_auxiliares($intCuentaID, $dteFechaInicial, $dteFechaFinal)
	{
		$strSQL = $this->db->query("SELECT P.folio, DATE_FORMAT(P.fecha,'%d/%m/%Y') AS fecha,
										   P.tipo, P.concepto, PD.importe, PD.naturaleza, 
										   PD.referencia, P.estatus
									FROM polizas AS P
									INNER JOIN polizas_detalles AS PD ON P.poliza_id = PD.poliza_id
									WHERE PD.cuenta_id = $intCuentaID
									AND (P.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									ORDER BY P.fecha, P.folio, PD.renglon");
		return $strSQL->result();

	}

	/*Método para regresar las cuentas contables que si/no tienen cuenta SAT
     *(se utiliza en la generación del archivo XML de cuentas contables)*/
	public function buscar_cuentas_cuentaSat($strTipoReporte, $strAnio = NULL, $intMes = NULL,
											 $strCuentaSat = NULL)
	{
		//Dependiendo del tipo de reporte realizar búsqueda de información
		if($strTipoReporte == "TODAS")
		{

			//Si se cumple la sentencia
			if($strCuentaSat == "NO")
			{
				//Sólo cuentas contables sin cuenta SAT
				$queryReferencia = "SELECT DISTINCT CC.cuenta_id, 
										   CONCAT_WS(' ', primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel,'-',descripcion) AS cuenta
									FROM   catalogo_cuentas AS CC 
									WHERE  CC.estatus = 'ACTIVO'
									AND    CC.sat_cuenta_id  =  0 
									ORDER BY CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel";
			}
			else
			{
				//Sólo cuentas contables con cuenta SAT
				$queryReferencia = "SELECT DISTINCT CC.cuenta_id, CC.primer_nivel, 
										  CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel, 
						    			  CC.descripcion, CC.naturaleza, 
										  CC02.primer_nivel AS PrimerNivelPadre, 
										  CC02.segundo_nivel AS SegundoNivelPadre, 
										  CC02.tercer_nivel AS TercerNivelPadre, 
										  CC02.cuarto_nivel AS CuartoNivelPadre, 
										  CCS.codigo AS codigo_agrupador 
									FROM   (catalogo_cuentas AS CC LEFT JOIN catalogo_cuentas AS CC02 
									      ON CC.cuenta_padre_id = CC02.cuenta_id) INNER JOIN sat_catalogo_cuentas AS CCS 
									      ON CC.sat_cuenta_id = CCS.sat_cuenta_id 
									WHERE  CC.estatus = 'ACTIVO' 
									ORDER BY CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel,CC.cuarto_nivel";
			}
		}
		else //Periodo
		{
			//Si se cumple la sentencia
			if($strCuentaSat == "NO")
			{
				//Cuentas contables de las pólizas sin cuenta SAT
				$queryReferencia = "SELECT DISTINCT CC.cuenta_id, 
										   CONCAT_WS(' ', primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel,'-',descripcion) AS cuenta
									FROM   (polizas P INNER JOIN polizas_detalles PD ON P.poliza_id = PD.poliza_id) 
				        		    INNER JOIN catalogo_cuentas CC ON PD.cuenta_id = CC.cuenta_id 
									WHERE  P.estatus = 'ACTIVO'
									AND    YEAR(P.fecha) = '$strAnio' 
									AND    MONTH(P.fecha) = '$intMes' 
									AND   CC.sat_cuenta_id  =  0 
									ORDER BY CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel";
			}
			else
			{
				//Cuentas contables de las pólizas con cuenta SAT
				$queryReferencia = "SELECT DISTINCT CC.cuenta_id, CC.primer_nivel, CC.segundo_nivel, 
										  CC.tercer_nivel, CC.cuarto_nivel,  
							  			  CC.descripcion, CC.naturaleza,
										  CC02.primer_nivel AS PrimerNivelPadre, 
										  CC02.segundo_nivel AS SegundoNivelPadre, 
										  CC02.tercer_nivel AS TercerNivelPadre, 
										  CC02.cuarto_nivel AS CuartoNivelPadre, 
										  CCS.codigo AS codigo_agrupador 
									FROM   (((polizas P INNER JOIN polizas_detalles PD ON P.poliza_id = PD.poliza_id)
									         INNER JOIN catalogo_cuentas CC ON PD.cuenta_id = CC.cuenta_id)
									         LEFT JOIN catalogo_cuentas CC02 ON CC.cuenta_padre_id = CC02.cuenta_id)
									         INNER JOIN sat_catalogo_cuentas CCS ON CC.sat_cuenta_id = CCS.sat_cuenta_id
									WHERE  P.estatus = 'ACTIVO'
									AND    YEAR(P.fecha) = '$strAnio' 
									AND    MONTH(P.fecha) = '$intMes'
									ORDER BY CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel";
			}

		}


		//Ejecutar consulta
		$strSQL = $this->db->query($queryReferencia);
		return $strSQL->result();
	}

	/*Método para regresar las cuentas contables para la balanza de comprobación
     *(se utiliza en la generación del archivo XML de la balanza de comprobación)*/
	public function buscar_cuentas_balanza()
	{
		$strSQL = $this->db->query("SELECT cuenta_id, cuenta_padre_id, sat_cuenta_id, 
										   primer_nivel, segundo_nivel, 
	      								   tercer_nivel, cuarto_nivel, descripcion, 
	      								   naturaleza, acepta_movimientos, estatus 
									FROM   catalogo_cuentas 
									WHERE  tercer_nivel = _latin1'00'
									ORDER BY  primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel");

		return $strSQL->result();
	}


	/*Método para regresar el acumulado de los saldos de la cuenta contable
      *(se utiliza en la generación del archivo XML de la balanza de comprobación)*/
    public function buscar_saldos_cuenta_balanza($strAnio, $strMes, $strPrimerNivel, $strSegundoNivel, 
    											  $strAceptaMovimientos)
	{

		//Concatenar datos para la fecha
		$dteFecha = $strAnio.'-'.$strMes.'-01';

		//Formar consulta
		$querySaldosCta = " SELECT (SELECT SUM(PD.importe) AS importe 
					        FROM   polizas P, polizas_detalles PD 
							WHERE  P.fecha < '$dteFecha'
							AND    P.estatus = 'ACTIVO' 
					        AND    PD.naturaleza = _latin1'CARGO' 
					        AND    PD.cuenta_id = CC.cuenta_id 
					        AND    PD.poliza_id = P.poliza_id) AS DebeAnterior, 
					       (SELECT SUM(PD.importe) AS importe 
					        FROM   polizas P, polizas_detalles PD 
							WHERE  P.fecha < '$dteFecha' 
					        AND    P.estatus = 'ACTIVO'
					        AND    PD.naturaleza = _latin1'ABONO'  
					        AND    PD.cuenta_id = CC.cuenta_id 
					        AND    PD.poliza_id = P.poliza_id) AS HaberAnterior, 
					       (SELECT SUM(PD.importe) AS importe 
					        FROM   polizas P, polizas_detalles PD 
							WHERE  MONTH(P.fecha) ='$strMes'
							AND    YEAR(P.fecha) = '$strAnio'
					        AND    P.estatus = 'ACTIVO'
					        AND    PD.naturaleza = _latin1'CARGO' 
					        AND    PD.cuenta_id = CC.cuenta_id 
					        AND    PD.poliza_id = P.poliza_id) AS Debe, 
					       (SELECT SUM(PD.importe) AS importe 
					        FROM   polizas P, polizas_detalles PD 
							WHERE  MONTH(P.fecha) ='$strMes'
							AND    YEAR(P.fecha) = '$strAnio'
					        AND    P.estatus = 'ACTIVO'
					        AND    PD.naturaleza = _latin1'ABONO'  
					        AND    PD.cuenta_id = CC.cuenta_id 
					        AND    PD.poliza_id = P.poliza_id) AS Haber 
					FROM   catalogo_cuentas AS CC 
					WHERE  CC.primer_nivel = '$strPrimerNivel'";

		    //Si se cumple la sentencia
			if (($strSegundoNivel != "00") OR ($strAceptaMovimientos == "SI"))
			{
				$querySaldosCta .= " AND CC.segundo_nivel = '$strSegundoNivel' ";
			}

		//Ejecutar consulta
		$strSQL = $this->db->query($querySaldosCta);
		return $strSQL->result();
	}
	

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('CC.descripcion', $strBusqueda);
        $this->db->or_like('CC.estatus', $strBusqueda);
	    $this->db->or_like("CONCAT_WS('-', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel)", $strBusqueda);
        $this->db->or_like("CONCAT_WS('', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' - ', SCC.codigo, SCC.descripcion)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', CCP.primer_nivel, CCP.segundo_nivel, CCP.tercer_nivel, CCP.cuarto_nivel, '-', CCP.descripcion)", $strBusqueda);
        $this->db->or_like('SCC.codigo', $strBusqueda);
        $this->db->or_like('SCC.descripcion', $strBusqueda);
		$this->db->from('catalogo_cuentas CC');
		$this->db->join('sat_catalogo_cuentas AS SCC', 'CC.sat_cuenta_id = SCC.sat_cuenta_id', 'inner');
		$this->db->join('catalogo_cuentas AS CCP', 'CC.cuenta_padre_id = CCP.cuenta_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CC.cuenta_id, 
						   CONCAT_WS(' ', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel) AS cuenta,
						   CC.descripcion, CC.naturaleza, CC.estatus, 
						   CONCAT_WS(' - ', SCC.codigo, SCC.descripcion) AS sat_cuenta,
						   CASE 
							    WHEN   CC.cuenta_padre_id > 0 
							    THEN  CONCAT_WS(' ', CCP.primer_nivel, CCP.segundo_nivel, CCP.tercer_nivel, CCP.cuarto_nivel, '-', CCP.descripcion)
								ELSE ''
						   END AS cuenta_padre", FALSE);
		$this->db->from('catalogo_cuentas CC');
		$this->db->join('sat_catalogo_cuentas AS SCC', 'CC.sat_cuenta_id = SCC.sat_cuenta_id', 'inner');
		$this->db->join('catalogo_cuentas AS CCP', 'CC.cuenta_padre_id = CCP.cuenta_id', 'left');
		$this->db->like('CC.descripcion', $strBusqueda);
        $this->db->or_like('CC.estatus', $strBusqueda);
	    $this->db->or_like("CONCAT_WS('-', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel)", $strBusqueda);
        $this->db->or_like("CONCAT_WS('', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' - ', SCC.codigo, SCC.descripcion)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', CCP.primer_nivel, CCP.segundo_nivel, CCP.tercer_nivel, CCP.cuarto_nivel, '-', CCP.descripcion)", $strBusqueda);
        $this->db->or_like('SCC.codigo', $strBusqueda);
        $this->db->or_like('SCC.descripcion', $strBusqueda);
		$this->db->order_by('CC.primer_nivel','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["cuentas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strTipo, $strPrimerNivel, $intCuentaID)
	{
		$this->db->select(" cuenta_id, 
							CONCAT_WS(' ', primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel,'-',descripcion) AS cuenta", FALSE);
        $this->db->from('catalogo_cuentas');
   	    $this->db->where('estatus','ACTIVO');
   	  	//Si el Autocomplete es por cuenta padre
   	  	if($strTipo == 'cuenta_padre')
   	  	{
   	  		$this->db->where('primer_nivel', $strPrimerNivel);
   	  		//Si existe id de la cuenta hijo
   	  		if($intCuentaID > 0)
   	  		{	
   	  			//No considerar el id de la cuenta hijo
   	  			$this->db->where('cuenta_id <>', $intCuentaID);
   	  		}
   	  	}
   	  	else if($strTipo == 'movimientos_bancarios')//Si el Autocomplete es por movimientos bancarios
   	  	{
   	  		$this->db->where('movimientos_bancarios', 'SI');
   	  	}
   	  	//Si el Autocomplete es por cuentas de mayor (son las que tienen puros 0 del segundo nivel en adelante)
   	  	else if($strTipo == 'cuentas_mayor')
   	  	{
   	  		$this->db->where('segundo_nivel', '00');
   	  		$this->db->where('tercer_nivel', '00');
   	  		$this->db->where('cuarto_nivel', '00000');
   	  	}
   	  	else if($strTipo == 'polizas')//Si el Autocomplete se utiliza en el proceso de pólizas
   	  	{
   	  		$this->db->where('acepta_movimientos', 'SI');
   	  	}

   	    $this->db->where("(descripcion LIKE '%$strDescripcion%' OR
			               ((CONCAT_WS('-', primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel) LIKE '%$strDescripcion%') OR
			                (CONCAT_WS('', primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel) LIKE '%$strDescripcion%') OR 
			            	(CONCAT_WS(' ', primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel) LIKE '%$strDescripcion%')))");
		$this->db->order_by('primer_nivel', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>