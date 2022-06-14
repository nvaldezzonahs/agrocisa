	<div id="RepPolizasPeriodoContabilidadContent">  
		<!--Diseño del formulario-->
		<form id="frmRepPolizasPeriodoContabilidad" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepPolizasPeriodoContabilidad" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_polizas_periodo_contabilidad"
									onclick="validar_rep_polizas_periodo_contabilidad('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_polizas_periodo_contabilidad"
									onclick="validar_rep_polizas_periodo_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</div><!--Cierre de barra de herramientas-->
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicial_rep_polizas_periodo_contabilidad">Fecha inicial</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_polizas_periodo_contabilidad'>
				                    <input class="form-control" id="txtFechaInicial_rep_polizas_periodo_contabilidad"
				                    		name= "strFechaInicial_rep_polizas_periodo_contabilidad" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Fecha final-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaFinal_rep_polizas_periodo_contabilidad">Fecha final</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_polizas_periodo_contabilidad'>
				                    <input class="form-control" id="txtFechaFinal_rep_polizas_periodo_contabilidad"
				                    		name= "strFechaFinal_rep_polizas_periodo_contabilidad" 
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
			    	<!--Tipo-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbTipo_rep_polizas_periodo_contabilidad">Tipo de póliza</label>
							</div>
							<div id="divCmbMsjValidacion" class="col-md-12">
								<select class="form-control" id="cmbTipo_rep_polizas_periodo_contabilidad" 
								 		name="strTipo_rep_polizas_periodo_contabilidad" tabindex="1">
                      				<option value="">Seleccione una opción</option>
                      				<option value="DIARIO">DIARIO</option>
                      				<option value="INGRESO">INGRESO</option>
                      				<option value="EGRESO">EGRESO</option>
                 				</select>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Lista de sucursales activas a las que tiene acceso el usuario-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label>Sucursales:</label>
							</div>
							<div class="col-md-12" id="chkSucursales_rep_polizas_periodo_contabilidad"></div>
						</div>	
					</div>
					<!--Lista de modulos-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label>Módulos:</label>
							</div>
							<div class="col-md-12">
								<!--Maaquinaria-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloMaquinaria_rep_polizas_periodo_contabilidad" 
									name="chkModulos_rep_polizas_periodo_contabilidad[]" 
									value="MAQUINARIA" checked>
									<label class="form-check-label" for="MAQUINARIA">MAQUINARIA</label>
								</div>
								<!--Refacciones-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloRefacciones_rep_polizas_periodo_contabilidad"
									name="chkModulos_rep_polizas_periodo_contabilidad[]" 
									value="REFACCIONES" checked>
									<label class="form-check-label" for="REFACCIONES">REFACCIONES</label>
								</div>
								<!--Servicio-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloServicio_rep_polizas_periodo_contabilidad" 
									name="chkModulos_rep_polizas_periodo_contabilidad[]"
									value="SERVICIO" checked>
									<label class="form-check-label" for="SERVICIO">SERVICIO</label>
								</div>
								<!--Contabilidad-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloContabilidad_rep_polizas_periodo_contabilidad" 
									name="chkModulos_rep_polizas_periodo_contabilidad[]" 
									value="CONTABILIDAD" checked>
									<label class="form-check-label" for="CONTABILIDAD">CONTABILIDAD</label>
								</div>
								<!--Caja-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloCaja_rep_polizas_periodo_contabilidad" 
									name="chkModulos_rep_polizas_periodo_contabilidad[]" 
									value="CAJA" checked>
									<label class="form-check-label" for="CAJA">CAJA</label>
								</div>
								<!--Cuentas por cobrar-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloCuentasCobrar_rep_polizas_periodo_contabilidad" 
									name="chkModulos_rep_polizas_periodo_contabilidad[]" 
									value="CUENTAS POR COBRAR" checked>
									<label class="form-check-label" for="CUENTAS POR COBRAR">CUENTAS POR COBRAR</label>
								</div>
								<!--Cuentas por pagar-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloCuentasPagar_rep_polizas_periodo_contabilidad" 
									name="chkModulos_rep_polizas_periodo_contabilidad[]" 
									value="CUENTAS POR PAGAR" checked>
									<label class="form-check-label" for="CUENTAS POR PAGAR">CUENTAS POR PAGAR</label>
								</div>
								<!--Control de vehículos-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloControlVehiculos_rep_polizas_periodo_contabilidad" 
									name="chkModulos_rep_polizas_periodo_contabilidad[]" 
									value="CONTROL DE VEHICULOS" checked>
									<label class="form-check-label" for="CONTROL DE VEHICULOS">CONTROL DE VEHICULOS</label>
								</div>
								<!--Auditoría-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloAuditoria_rep_polizas_periodo_contabilidad" 
									name="chkModulos_rep_polizas_periodo_contabilidad[]" 
									value="AUDITORIA" checked>
									<label class="form-check-label" for="AUDITORIA">AUDITORIA</label>
								</div>
								<!--Mercadotecnia-->
								<div class="form-check form-check-inline">
									<input class="form-check" type="checkbox" id="chkModuloMercadotecnia_rep_polizas_periodo_contabilidad" 
									name="chkModulos_rep_polizas_periodo_contabilidad[]" 
									value="MERCADOTECNIA" checked>
									<label class="form-check-label" for="MERCADOTECNIA">MERCADOTECNIA</label>
								</div>
							</div>	
						</div>	
					</div>	
				</div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepPolizasPeriodoContabilidadContent -->

	<!-- /.Plantilla para cargar las sucursales-->  
	<script id="sucursales_rep_polizas_periodo_contabilidad" type="text/template">
		{{#sucursales}}
		<div class="form-check form-check-inline">
		  <input class="form-check-input-chk" type="checkbox" id="chkSucursal{{value}}_rep_polizas_periodo_contabilidad" 
		  		 name="chkSucursales_rep_polizas_periodo_contabilidad[]" value="{{value}}" checked>
		  <label class="form-check-label" for="{{value}}">{{nombre}}</label>
		</div>
		{{/sucursales}} 
	</script>
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_polizas_periodo_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/rep_polizas_periodo/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_polizas_periodo_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepPolizasPeriodoContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosRepPolizasPeriodoContabilidad = strPermisosRepPolizasPeriodoContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepPolizasPeriodoContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepPolizasPeriodoContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_polizas_periodo_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosRepPolizasPeriodoContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_polizas_periodo_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_polizas_periodo_contabilidad(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_polizas_periodo_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmRepPolizasPeriodoContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaInicial_rep_polizas_periodo_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaFinal_rep_polizas_periodo_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_polizas_periodo_contabilidad = $('#frmRepPolizasPeriodoContabilidad').data('bootstrapValidator');
			bootstrapValidator_rep_polizas_periodo_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_polizas_periodo_contabilidad.isValid())
			{
				//Arreglo para obtener sucursales seleccionadas
				var chkSucursalesArray = [];
				chkSucursalesArray = sucursales_seleccionadas_rep_polizas_periodo_contabilidad();

				//Arreglo para obtener módulos seleccionados
				var chkModulosArray = [];
				chkModulosArray = modulos_seleccionados_rep_polizas_periodo_contabilidad();

				//Verificamos que al menos se encuentre una sucursal y un modulo seleccionado
				if(chkSucursalesArray.length > 0 && chkModulosArray.length > 0)
				{
					//Array que se utiliza para agregar sucursales
					var arrSucursales = chkSucursalesArray.join('|');
					//Array que se utiliza para agregar módulos
					var arrModulos = chkModulosArray.join('|');

					//Hacer un llamado a la función para generar reporte en PDF/XLS
					reporte_rep_polizas_periodo_contabilidad(strTipo, arrSucursales, arrModulos);
					
					
				}
				else
				{
					//Indicar al usuario el mensaje de error
					new $.Zebra_Dialog('Es necesario seleccionar al menos una sucursal y un módulo.',
									   {'type': 'error', 
									   'title': 'Error'});
				}

			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_polizas_periodo_contabilidad()
		{
			try
			{
				$('#frmRepPolizasPeriodoContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_polizas_periodo_contabilidad(strTipo, arrSucursales, arrModulos) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/rep_polizas_periodo/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicial_rep_polizas_periodo_contabilidad').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_polizas_periodo_contabilidad').val()),
										'strTipoPoliza': $('#cmbTipo_rep_polizas_periodo_contabilidad').val(), 
										'strSucursales': arrSucursales,
										'strModulos': arrModulos					
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

		//Función para cargar las sucursales a las que el usuario loggeado tiene acceso
		function cargar_sucursales_rep_polizas_periodo_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box/home', {},
				function(data)
				{
					$('#chkSucursales_rep_polizas_periodo_contabilidad').empty();
					var temp = Mustache.render($('#sucursales_rep_polizas_periodo_contabilidad').html(), data)
					$('#chkSucursales_rep_polizas_periodo_contabilidad').html(temp);
				},
				'json');
		}


		//Función para obtener las sucursales seleccionadas
		function sucursales_seleccionadas_rep_polizas_periodo_contabilidad(){

			//Declaramos el arreglo  que contendrá las sucursales seleccionadas
			var chkSucursalesArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkSucursales_rep_polizas_periodo_contabilidad[]"]:checked').each(function() {
				chkSucursalesArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkSucursalesArray.join('|');
			
			//Regresar array con las sucursales seleccionadas
			return chkSucursalesArray;

		}


		//Función para obtener los módulos seleccionados
		function modulos_seleccionados_rep_polizas_periodo_contabilidad(){

			//Declaramos el arreglo que contendrá los módulos seleccionados
			var chkModulosArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkModulos_rep_polizas_periodo_contabilidad[]"]:checked').each(function() {
				chkModulosArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkModulosArray.join('|');

			//Regresar array con los módulos seleccionados
			return chkModulosArray;
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{	
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicial_rep_polizas_periodo_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_polizas_periodo_contabilidad').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_polizas_periodo_contabilidad').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_polizas_periodo_contabilidad').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_polizas_periodo_contabilidad').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_polizas_periodo_contabilidad').data('DateTimePicker').maxDate(e.date);
			});


			//Enfocar caja de texto
			$('#txtFechaInicial_rep_polizas_periodo_contabilidad').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_polizas_periodo_contabilidad();
			//Hacer un llamado a la función para cargar sucursales y armar los checklist
  			cargar_sucursales_rep_polizas_periodo_contabilidad();

		});
	</script>