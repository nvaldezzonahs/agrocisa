<div id="RepAnalisisAuxiliaresContabilidadContent">  
		<!--Diseño del formulario-->
		<form id="frmRepAnalisisAuxiliaresContablidad" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepAnalisisAuxiliaresContablidad" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_analisis_auxiliares_contabilidad"
									onclick="validar_rep_analisis_auxiliares_contabilidad('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_analisis_auxiliares_contabilidad"
									onclick="validar_rep_analisis_auxiliares_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicial_rep_analisis_auxiliares_contabilidad">Fecha inicial</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaInicial_rep_analisis_auxiliares_contabilidad'>
					                    <input class="form-control" 
					                    		id="txtFechaInicial_rep_analisis_auxiliares_contabilidad"
					                    		name= "strFechaInicial_rep_analisis_auxiliares_contabilidad" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" 
					                    		maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>	
							</div>
						</div>
						<!--Fecha final-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaFinal_rep_analisis_auxiliares_contabilidad">Fecha final</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaFinal_rep_analisis_auxiliares_contabilidad'>
					                    <input class="form-control" 
					                    		id="txtFechaFinal_rep_analisis_auxiliares_contabilidad"
					                    		name= "strFechaFinal_rep_analisis_auxiliares_contabilidad" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" 
					                    		maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>	
							</div>
						</div>
						<!--Incluir saldos anteriores-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12  btn-toolBtns">
							<div class="checkbox">
		                    	<label id="label-checkbox">
		                        	<input class="form-control" id="chbIncluirSaldosAnteriores_rep_analisis_auxiliares_contabilidad" 
										   name="strIncluirSaldosAnteriores_rep_analisis_auxiliares_contabilidad" type="checkbox"
										   value="" tabindex="1">
									</input>
									<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
									Incluir saldos anteriores
		                    	</label>
		                  	</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene las cuentas activas-->
				    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    		<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar los datos (primer_nivel, segundo_nivel,tercer_nivel y cuarto_nivel) concatenados de la cuenta seleccionada-->
									<input id="txtCuentaConcatInicial_rep_analisis_auxiliares_contabilidad" 
										   name="strCuentaConcatInicial_rep_analisis_auxiliares_contabilidad"  
										   type="hidden" value="">
									</input>
									<label for="txtCuentaInicial_rep_analisis_auxiliares_contabilidad">Cuenta inicial</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCuentaInicial_rep_analisis_auxiliares_contabilidad" 
											name="strCuentaInicial_rep_analisis_auxiliares_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese cuenta" maxlength="250">
									</input>
								</div>
							</div>
				    	</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene las cuentas activas-->
				    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    		<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar los datos (primer_nivel, segundo_nivel,tercer_nivel y cuarto_nivel) concatenados de la cuenta seleccionada-->
									<input id="txtCuentaConcatFinal_rep_analisis_auxiliares_contabilidad" 
										   name="strCuentaConcatFinal_rep_analisis_auxiliares_contabilidad"  
										   type="hidden" value="">
									</input>
									<label for="txtCuentaFinal_rep_analisis_auxiliares_contabilidad">Cuenta final</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCuentaFinal_rep_analisis_auxiliares_contabilidad" 
											name="strCuentaFinal_rep_analisis_auxiliares_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese cuenta" maxlength="250">
									</input>
								</div>
							</div>
				    	</div>
			    	</div>	
			    	<div class="row">
				    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    		<!--Tipo de reporte -->							
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipoReporte_rep_analisis_auxiliares_contabilidad">Tipo de reporte</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTipoReporte_rep_analisis_auxiliares_contabilidad" 
									 		name="strTipoReporte_rep_analisis_auxiliares_contabilidad" tabindex="1">
                          				<option value="">Seleccione una opción</option>                  
										<option value="TODAS">Todas las cuentas</option>
										<option value="SOLO_MOVIMIENTOS">Sólo con movimientos en el rango de fechas</option>
										<option value="MOVIMIENTOS_SALDOS">Cuentas con movimientos y/o saldo en el rango de fechas</option>
										<option value="SALDO">Sólo cuentas con saldo</option>
                     				</select>
								</div>
							</div>
				    	</div>
				    </div>	
			    </div>
			  			    
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepAnalisisAuxiliaresContabilidadContent -->
		
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_analisis_auxiliares_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/rep_analisis_auxiliares/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_analisis_auxiliares_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepAnalisisAuxiliaresContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosRepAnalisisAuxiliaresContabilidad = strPermisosRepAnalisisAuxiliaresContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepAnalisisAuxiliaresContabilidad.length; i++)
					{	//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepAnalisisAuxiliaresContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_analisis_auxiliares_contabilidad').removeAttr('disabled');
						}				
						else if(arrPermisosRepAnalisisAuxiliaresContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_analisis_auxiliares_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_analisis_auxiliares_contabilidad(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_analisis_auxiliares_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmRepAnalisisAuxiliaresContablidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaInicial_rep_analisis_auxiliares_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaFinal_rep_analisis_auxiliares_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strTipoReporte_rep_analisis_auxiliares_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo de reporte'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_analisis_auxiliares_contabilidad = $('#frmRepAnalisisAuxiliaresContablidad').data('bootstrapValidator');
			bootstrapValidator_rep_analisis_auxiliares_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_analisis_auxiliares_contabilidad.isValid())
			{
				//Hacer un llamado a la función para generar reporte en PDF/XLS
				reporte_rep_analisis_auxiliares_contabilidad(strTipo);
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_analisis_auxiliares_contabilidad()
		{
			try
			{
				$('#frmRepAnalisisAuxiliaresContablidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_analisis_auxiliares_contabilidad(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/rep_analisis_auxiliares/';

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

			//Si el checkbox incluir saldos anteriores se encuentra seleccionado (marcado)
			if ($('#chbIncluirSaldosAnteriores_rep_analisis_auxiliares_contabilidad').is(':checked')) {
			    //Asignar SI para incluir saldos anteriores en el reporte
			    $('#chbIncluirSaldosAnteriores_rep_analisis_auxiliares_contabilidad').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir saldos anteriores en el reporte
			   $('#chbIncluirSaldosAnteriores_rep_analisis_auxiliares_contabilidad').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicial_rep_analisis_auxiliares_contabilidad').val()), 
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_analisis_auxiliares_contabilidad').val()),
										'strCuentaInicial': $('#txtCuentaConcatInicial_rep_analisis_auxiliares_contabilidad').val(), 
										'strCuentaFinal': $('#txtCuentaConcatFinal_rep_analisis_auxiliares_contabilidad').val(), 
										'strTipoReporte': $('#cmbTipoReporte_rep_analisis_auxiliares_contabilidad').val(), 
										'strIncluirSaldosAnteriores': $('#chbIncluirSaldosAnteriores_rep_analisis_auxiliares_contabilidad').val()				
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		

		//Controles o Eventos del Modal
		$(document).ready(function() {
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicial_rep_analisis_auxiliares_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_analisis_auxiliares_contabilidad').datetimepicker({format: 'DD/MM/YYYY',
			 																	     useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_analisis_auxiliares_contabilidad').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_analisis_auxiliares_contabilidad').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_analisis_auxiliares_contabilidad').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_analisis_auxiliares_contabilidad').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de una cuenta
	        $('#txtCuentaInicial_rep_analisis_auxiliares_contabilidad').autocomplete({
	            source: function( request, response ) {
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/catalogo_cuentas/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	       	
	       	//Verificar y concatenar datos de la cuenta cuando pierda el enfoque la caja de texto
	        $('#txtCuentaInicial_rep_analisis_auxiliares_contabilidad').focusout(function(e){
	        	
	            //Hacer un llamado a la función para verificar y concatenar los datos de la cuenta contable
				$.concatenarCtaContable($('#txtCuentaInicial_rep_analisis_auxiliares_contabilidad').val(), 'txtCuentaConcatInicial_rep_analisis_auxiliares_contabilidad');
	        });

	        //Autocomplete para recuperar los datos de una cuenta
	        $('#txtCuentaFinal_rep_analisis_auxiliares_contabilidad').autocomplete({
	            source: function( request, response ) {
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/catalogo_cuentas/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	         //Verificar y concatenar datos de la cuenta cuando pierda el enfoque la caja de texto
	        $('#txtCuentaFinal_rep_analisis_auxiliares_contabilidad').focusout(function(e){
				//Hacer un llamado a la función para verificar y concatenar los datos de la cuenta contable
				$.concatenarCtaContable($('#txtCuentaFinal_rep_analisis_auxiliares_contabilidad').val(), 'txtCuentaConcatFinal_rep_analisis_auxiliares_contabilidad');
	        });

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_analisis_auxiliares_contabilidad();

			//Marcar (Seleccionar) checkbox para incluir saldos anteriores
			$('#chbIncluirSaldosAnteriores_rep_analisis_auxiliares_contabilidad').prop('checked', true);

		});
	</script>
	