<div id="RepAnalisisMayoresContabilidadContent">  
		<!--Diseño del formulario-->
		<form id="frmRepAnalisisMayoresContablidad" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepAnalisisMayoresContablidad" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_analisis_mayores_contabilidad"
									onclick="validar_rep_analisis_mayores_contabilidad('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_analisis_mayores_contabilidad"
									onclick="validar_rep_analisis_mayores_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
									<label for="txtFechaInicial_rep_analisis_mayores_contabilidad">Fecha inicial</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaInicial_rep_analisis_mayores_contabilidad'>
					                    <input class="form-control" 
					                    		id="txtFechaInicial_rep_analisis_mayores_contabilidad"
					                    		name= "strFechaInicial_rep_analisis_mayores_contabilidad" 
					                    		type="text"  value=""  tabindex="1"  placeholder="Ingrese fecha" 
					                    		maxlength="10"/>
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
									<label for="txtFechaFinal_rep_analisis_mayores_contabilidad">Fecha final</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaFinal_rep_analisis_mayores_contabilidad'>
					                    <input class="form-control" 
					                    		id="txtFechaFinal_rep_analisis_mayores_contabilidad"
					                    		name= "strFechaFinal_rep_analisis_mayores_contabilidad" 
					                    		type="text"  value=""  tabindex="1"  placeholder="Ingrese fecha" 
					                    		maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>	
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene las cuentas activas-->
				    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    		<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar los datos (primer_nivel, segundo_nivel, tercer_nivel y cuarto_nivel) concatenados de la cuenta seleccionada-->
									<input id="txtCuentaConcatInicial_rep_analisis_mayores_contabilidad" 
										   name="strCuentaConcatInicial_rep_analisis_mayores_contabilidad"  
										   type="hidden" value="">
									</input>
									<label for="txtCuentaInicial_rep_analisis_mayores_contabilidad">Cuenta inicial</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtCuentaInicial_rep_analisis_mayores_contabilidad" name="strCuentaInicial_rep_analisis_mayores_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese cuenta" maxlength="250">
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
									<!-- Caja de texto oculta que se utiliza para recuperar los datos (primer_nivel, segundo_nivel, tercer_nivel y cuarto_nivel) concatenados de la cuenta seleccionada-->
									<input id="txtCuentaConcatFinal_rep_analisis_mayores_contabilidad" 
										   name="strCuentaConcatFinal_rep_analisis_mayores_contabilidad"  
										   type="hidden" value="">
									</input>
									<label for="txtCuentaFinal_rep_analisis_mayores_contabilidad">Cuenta final</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtCuentaFinal_rep_analisis_mayores_contabilidad" name="strCuentaFinal_rep_analisis_mayores_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese cuenta" maxlength="250">
									</input>
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
		function permisos_rep_analisis_mayores_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/rep_analisis_mayores/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_analisis_mayores_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepAnalisisMayoresContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosRepAnalisisMayoresContabilidad = strPermisosRepAnalisisMayoresContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepAnalisisMayoresContabilidad.length; i++)
					{	//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepAnalisisMayoresContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_analisis_mayores_contabilidad').removeAttr('disabled');
						}				
						else if(arrPermisosRepAnalisisMayoresContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_analisis_mayores_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_analisis_mayores_contabilidad(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_analisis_mayores_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmRepAnalisisMayoresContablidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaInicial_rep_analisis_mayores_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaFinal_rep_analisis_mayores_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_analisis_mayores_contabilidad = $('#frmRepAnalisisMayoresContablidad').data('bootstrapValidator');
			bootstrapValidator_rep_analisis_mayores_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_analisis_mayores_contabilidad.isValid())
			{
				
			 	//Hacer un llamado a la función para generar reporte en PDF/XLS
			 	reporte_rep_analisis_mayores_contabilidad(strTipo);
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_analisis_mayores_contabilidad()
		{
			try
			{
				$('#frmRepAnalisisMayoresContablidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_rep_analisis_mayores_contabilidad(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/rep_analisis_mayores/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicial_rep_analisis_mayores_contabilidad').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_rep_analisis_mayores_contabilidad').val()),
										'strCuentaInicial': $('#txtCuentaConcatInicial_rep_analisis_mayores_contabilidad').val(),
										'strCuentaFinal': $('#txtCuentaConcatFinal_rep_analisis_mayores_contabilidad').val()
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
			$('#dteFechaInicial_rep_analisis_mayores_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_analisis_mayores_contabilidad').datetimepicker({format: 'DD/MM/YYYY',
			 																	     useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_analisis_mayores_contabilidad').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_analisis_mayores_contabilidad').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_analisis_mayores_contabilidad').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_analisis_mayores_contabilidad').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de una cuenta
	        $('#txtCuentaInicial_rep_analisis_mayores_contabilidad').autocomplete({
	            source: function( request, response ) {
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/catalogo_cuentas/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'cuentas_mayor'
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
	        $('#txtCuentaInicial_rep_analisis_mayores_contabilidad').focusout(function(e){
	        	
	            //Hacer un llamado a la función para verificar y concatenar los datos de la cuenta contable
				$.concatenarCtaContable($('#txtCuentaInicial_rep_analisis_mayores_contabilidad').val(), 'txtCuentaConcatInicial_rep_analisis_mayores_contabilidad');
	        });

	        //Autocomplete para recuperar los datos de una cuenta
	        $('#txtCuentaFinal_rep_analisis_mayores_contabilidad').autocomplete({
	            source: function( request, response ) {
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/catalogo_cuentas/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strTipo: 'cuentas_mayor'
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
	        $('#txtCuentaFinal_rep_analisis_mayores_contabilidad').focusout(function(e){
				//Hacer un llamado a la función para verificar y concatenar los datos de la cuenta contable
				$.concatenarCtaContable($('#txtCuentaFinal_rep_analisis_mayores_contabilidad').val(), 'txtCuentaConcatFinal_rep_analisis_mayores_contabilidad');
	        });

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_analisis_mayores_contabilidad();

		});
	</script>
	