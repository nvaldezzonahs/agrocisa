	<div id="RepEstadoCuentaCajaContent">  
		<!--Diseño del formulario-->
		<form id="frmRepEstadoCuentaCaja" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmRepEstadoCuentaCaja" onsubmit="return(false)" autocomplete="off">
			<!--Barra de herramientas-->
			<div class="panel-toolbar">
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_rep_estado_cuenta_caja"
									onclick="validar_rep_estado_cuenta_caja('PDF');" title="Imprimir reporte general en PDF" 
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_rep_estado_cuenta_caja"
									onclick="validar_rep_estado_cuenta_caja('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
								<label for="txtFechaInicial_rep_estado_cuenta_caja">Fecha inicial</label>
							</div>
							<div  id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_rep_estado_cuenta_caja'>
				                    <input class="form-control" id="txtFechaInicial_rep_estado_cuenta_caja"
				                    		name= "strFechaInicial_rep_estado_cuenta_caja" 
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
								<label for="txtFechaFinal_rep_estado_cuenta_caja">Fecha final</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_rep_estado_cuenta_caja'>
				                    <input class="form-control" id="txtFechaFinal_rep_estado_cuenta_caja"
				                    		name= "strFechaFinal_rep_estado_cuenta_caja" 
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
					<!--Autocomplete que contiene los empleados activos-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
								<input id="txtEmpleadoID_rep_estado_cuenta_caja" name="intEmpleadoID_rep_estado_cuenta_caja"  
									   type="hidden" value="">
								</input>
								<label for="txtEmpleado_rep_estado_cuenta_caja">Empleado</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtEmpleado_rep_estado_cuenta_caja" 
										name="strEmpleado_rep_estado_cuenta_caja" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#RepEstadoCuentaCajaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Variables que se utilizan para la búsqueda de registros
		var intEmpleadoIDRepEstadoCuentaCaja = "";
		var dteFechaInicialRepEstadoCuentaCaja = "";
		var dteFechaFinalRepEstadoCuentaCaja = "";

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_rep_estado_cuenta_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/rep_estado_cuenta/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_rep_estado_cuenta_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRepEstadoCuentaCaja = data.row;
					//Separar la cadena 
					var arrPermisosRepEstadoCuentaCaja = strPermisosRepEstadoCuentaCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRepEstadoCuentaCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRepEstadoCuentaCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_rep_estado_cuenta_caja').removeAttr('disabled');
						}
						else if(arrPermisosRepEstadoCuentaCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_rep_estado_cuenta_caja').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rep_estado_cuenta_caja(strTipo)
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rep_estado_cuenta_caja();
			//Validación del formulario de campos obligatorios
			$('#frmRepEstadoCuentaCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaInicial_rep_estado_cuenta_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaFinal_rep_estado_cuenta_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strEmpleado_rep_estado_cuenta_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtEmpleadoID_rep_estado_cuenta_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un empleado existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rep_estado_cuenta_caja = $('#frmRepEstadoCuentaCaja').data('bootstrapValidator');
			bootstrapValidator_rep_estado_cuenta_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rep_estado_cuenta_caja.isValid())
			{
				//Si el tipo de reporte es PDF
				if(strTipo == 'PDF')
				{
				 	//Hacer un llamado a la función para generar reporte en PDF
				 	reporte_rep_estado_cuenta_caja();
				}
				else
				{ 
				 	//Hacer un llamado a la función para generar  y descargar el archivo XLS
				 	descargar_xls_rep_estado_cuenta_caja()
				}
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rep_estado_cuenta_caja()
		{
			try
			{
				$('#frmRepEstadoCuentaCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar el reporte general en PDF
		function reporte_rep_estado_cuenta_caja() 
		{
			//Asignar valores para la búsqueda de registros
			intEmpleadoIDRepEstadoCuentaCaja =  $('#txtEmpleadoID_rep_estado_cuenta_caja').val();
			dteFechaInicialRepEstadoCuentaCaja =  $.formatFechaMysql($('#txtFechaInicial_rep_estado_cuenta_caja').val());
			dteFechaFinalRepEstadoCuentaCaja =  $.formatFechaMysql($('#txtFechaFinal_rep_estado_cuenta_caja').val());

			//Hacer un llamado al método del controlador para generar reporte PDF
         	window.open("caja/rep_estado_cuenta/get_reporte/"+dteFechaInicialRepEstadoCuentaCaja+"/"+dteFechaFinalRepEstadoCuentaCaja+"/"+intEmpleadoIDRepEstadoCuentaCaja);
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_rep_estado_cuenta_caja() 
		{
			//Asignar valores para la búsqueda de registros
			intEmpleadoIDRepEstadoCuentaCaja =  $('#txtEmpleadoID_rep_estado_cuenta_caja').val();
			dteFechaInicialRepEstadoCuentaCaja =  $.formatFechaMysql($('#txtFechaInicial_rep_estado_cuenta_caja').val());
			dteFechaFinalRepEstadoCuentaCaja =  $.formatFechaMysql($('#txtFechaFinal_rep_estado_cuenta_caja').val());

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("caja/rep_estado_cuenta/get_xls/"+dteFechaInicialRepEstadoCuentaCaja+"/"+dteFechaFinalRepEstadoCuentaCaja+"/"+intEmpleadoIDRepEstadoCuentaCaja);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{	
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicial_rep_estado_cuenta_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_rep_estado_cuenta_caja').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_rep_estado_cuenta_caja').on('dp.change', function (e) {
				$('#dteFechaFinal_rep_estado_cuenta_caja').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_rep_estado_cuenta_caja').on('dp.change', function (e) {
				$('#dteFechaInicial_rep_estado_cuenta_caja').data('DateTimePicker').maxDate(e.date);
			});

			
			//Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleado_rep_estado_cuenta_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEmpleadoID_rep_estado_cuenta_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/empleados/autocomplete",
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
	             //Asignar id del registro seleccionado
	             $('#txtEmpleadoID_rep_estado_cuenta_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del empleado cuando pierda el enfoque la caja de texto
	        $('#txtEmpleado_rep_estado_cuenta_caja').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoID_rep_estado_cuenta_caja').val() == '' ||
	               $('#txtEmpleado_rep_estado_cuenta_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEmpleadoID_rep_estado_cuenta_caja').val('');
	               $('#txtEmpleado_rep_estado_cuenta_caja').val('');
	            }
	            
	        });
			
			//Enfocar caja de texto
			$('#txtFechaInicial_rep_estado_cuenta_caja').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_rep_estado_cuenta_caja();
		});
	</script>