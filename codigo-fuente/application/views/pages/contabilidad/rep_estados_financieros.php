<div id="RepEstadosFinancierosContabilidadContent">  
		<!--Diseño del formulario-->
		<form id="frmRepEstadosFinancierosContabilidad" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepEstadosFinancierosContabilidad" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_estados_financieros_contabilidad"
									onclick="validar_rep_estados_financieros_contabilidad('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_estados_financieros_contabilidad"
									onclick="validar_rep_estados_financieros_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
				<div class="row">
					<!--Fecha de corte-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaCorte_rep_estados_financieros_contabilidad">Fecha de corte</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaCorte_rep_estados_financieros_contabilidad'>
				                    <input class="form-control" id="txtFechaCorte_rep_estados_financieros_contabilidad"
				                    		name= "strFechaCorte_rep_estados_financieros_contabilidad" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
				</div>
				 <div class="row">
					<!--Lista de reportes-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label>Tipo de reporte:</label>
							</div>
							<div class="col-md-12">
								<!--Balance general-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkBalanceGral_rep_estados_financieros_contabilidad" 
									name="chkTipoReporte_rep_estados_financieros_contabilidad[]" 
									value="BALANCE_GRAL" checked>
									<label class="form-check-label" for="MAQUINARIA">Balance general</label>
								</div>
								<!--Estado de resultados global general-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkResultadosGlobalGral_rep_estados_financieros_contabilidad" 
									name="chkTipoReporte_rep_estados_financieros_contabilidad[]"
									value="RESULTADOS_GLOBAL_GRAL" checked>
									<label class="form-check-label" for="REFACCIONES">Estado de resultados global general</label>
								</div>
							</div>	
						</div>	
					</div>	
				</div>
			  			    
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepCarteraVencimientoCuentasPagarContent -->
	<!-- /.Plantilla para cargar las sucursales-->  
	
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
	/*******************************************************************************************************************
	Funciones del formulario
	*********************************************************************************************************************/
	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_rep_estados_financieros_contabilidad()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('contabilidad/rep_estados_financieros/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_rep_estados_financieros_contabilidad').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosRepEstadosFinancierosContabilidad = data.row;
				//Separar la cadena 
				var arrPermisosRepEstadosFinancierosContabilidad = strPermisosRepEstadosFinancierosContabilidad.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosRepEstadosFinancierosContabilidad.length; i++)
				{					
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosRepEstadosFinancierosContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_rep_estados_financieros_contabilidad').removeAttr('disabled');
					}
					else if(arrPermisosRepEstadosFinancierosContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_rep_estados_financieros_contabilidad').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_rep_estados_financieros_contabilidad(strTipo)
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_rep_estados_financieros_contabilidad();
		//Validación del formulario de campos obligatorios
		$('#frmRepEstadosFinancierosContabilidad')
			.bootstrapValidator({excluded: [':disabled'],
								 container: 'popover',
								 feedbackIcons: {
								 	valid: 'glyphicon glyphicon-ok',
									invalid: 'glyphicon glyphicon-remove',
									validating: 'glyphicon glyphicon-refresh'
								  },
								  fields: {
									strFechaCorte_rep_estados_financieros_contabilidad: {
										validators: {
											notEmpty: {message: 'Seleccione una fecha'}
										}
									}
								}
			});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_rep_estados_financieros_contabilidad = $('#frmRepEstadosFinancierosContabilidad').data('bootstrapValidator');
		bootstrapValidator_rep_estados_financieros_contabilidad.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_rep_estados_financieros_contabilidad.isValid())
		{
			
			//Arreglo para obtener tipos de reportes seleccionados
			var chkTiposReporteArray = [];
			chkTiposReporteArray = tipos_reportes_seleccionados_rep_estados_financieros_contabilidad();

			//Verificamos que al menos se encuentre un tipo de reporte seleccionado
			if(chkTiposReporteArray.length > 0)
			{
				//Array que se utiliza para agregar tipos de reportes
				var arrTiposReporte = chkTiposReporteArray.join('|');

				//Hacer un llamado a la función para generar reporte en PDF/XLS
				reporte_rep_estados_financieros_contabilidad(strTipo, arrTiposReporte);
				
			}
			else
			{
				//Indicar al usuario el mensaje de error
				new $.Zebra_Dialog('Es necesario seleccionar al menos un tipo de reporte.',
								   {'type': 'error', 
								   'title': 'Error'});
			}

		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_rep_estados_financieros_contabilidad()
	{
		try
		{
			$('#frmRepEstadosFinancierosContabilidad').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}


	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_rep_estados_financieros_contabilidad(strTipo, arrTiposReporte) 
	{
		//Variable que se utiliza para asignar URL (ruta del controlador)
		var strUrl = 'contabilidad/rep_estados_financieros/';

		//Si el tipo de reporte es PDF
		if(strTipo == 'PDF')
		{
			//Concatenar nombre de la función que genera el reporte PDF
			strUrl += 'get_reporte';
		}
		else
		{
			//Concatenar nombre de la función que genera el archivo XLS
			strUrl += 'get_xls';
		}

		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url': strUrl,
						'data' : { 
									'dteFechaCorte': $.formatFechaMysql($('#txtFechaCorte_rep_estados_financieros_contabilidad').val()),
									'strTiposReporte': arrTiposReporte

								 }
					   };


		//Hacer un llamado a la función para imprimir/descargar el reporte
		$.imprimirReporte(objReporte);

	}

	//Función para obtener los tipos de reportes seleccionados
	function tipos_reportes_seleccionados_rep_estados_financieros_contabilidad(){

		//Declaramos el arreglo que contendrá los tipos de reportes seleccionados
		var chkTiposReporteArray = [];
		
		//Buscamos todos los checkboxes seleccionados
		$('[name="chkTipoReporte_rep_estados_financieros_contabilidad[]"]:checked').each(function() {
			chkTiposReporteArray.push($(this).val());
		});
		
		//Unimos los valores seleccionados con un '|'
		chkTiposReporteArray.join('|');

		//Regresar array con los tipos de reportes seleccionados
		return chkTiposReporteArray;
	}

	//Controles o Eventos del Modal
	$(document).ready(function() {
		/*******************************************************************************************************************
		Controles correspondientes al formulario
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaCorte_rep_estados_financieros_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});
		
		//Asignar la fecha actual
   		$('#txtFechaCorte_rep_estados_financieros_contabilidad').val(fechaActual()); 
   		
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_rep_estados_financieros_contabilidad();
		

	});
</script>
	