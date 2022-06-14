	<div id="ServicioPresupuestosManoObraServicioContent" >
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<!--Diseño del formulario-->
			<form id="frmServicioPresupuestosManoObraServicio" method="post" action="#" 
				  class="form-horizontal"  role="form" name="frmServicioPresupuestosManoObraServicio"
				  onsubmit="return(false)" autocomplete="off">
			    <div class="row">
					<!--Autocomplete que contiene los mecánicos activos-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para indicar la existencia del presupuesto y así poder actualizar los registros-->
								<input id="txtNuevoID_servicio_presupuestos_mano_obra_servicio" 
									   name="strNuevoID_servicio_presupuestos_mano_obra_servicio"  
									   type="hidden" value="">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del mecánico seleccionado-->
								<input id="txtMecanicoID_servicio_presupuestos_mano_obra_servicio" 
									   name="intMecanicoID_servicio_presupuestos_mano_obra_servicio"  
									   type="hidden" value="">
								</input>
								<label for="txtMecanico_servicio_presupuestos_mano_obra_servicio">Mecánico</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMecanico_servicio_presupuestos_mano_obra_servicio" 
										name="strMecanico_servicio_presupuestos_mano_obra_servicio" type="text" value="" tabindex="1" placeholder="Ingrese mecánico" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Año-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtAnio_servicio_presupuestos_mano_obra_servicio">Año</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtAnio_servicio_presupuestos_mano_obra_servicio" 
										name="strAnio_servicio_presupuestos_mano_obra_servicio" type="number" value=""
										tabindex="1" placeholder="Ingrese año" maxlength="4">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Ventas por mes-->
                    <h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Ventas por mes</h4>
                    <!--Enero-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Enero</span>
						    <!--Importe-->
						    <input  id="txtImporte01_servicio_presupuestos_mano_obra_servicio"
						    		name="intImporte01_servicio_presupuestos_mano_obra_servicio" 
						    		class="form-control moneda_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="22" />
						    <!--Horas-->
						    <input  id="txtHoras01_servicio_presupuestos_mano_obra_servicio"
						    		name="intHoras01_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control cantidad_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Horas" maxlength="22" />
						</div>
					</div>
					<!--Febrero-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Febrero</span>
						    <!--Importe-->
						    <input  id="txtImporte02_servicio_presupuestos_mano_obra_servicio"
						    		name="intImporte02_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control moneda_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="22" />
						    <!--Horas-->
						    <input  id="txtHoras02_servicio_presupuestos_mano_obra_servicio"
						    		name="intHoras02_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control cantidad_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Horas" maxlength="22" />
						</div>
					</div>
					<!--Marzo-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Marzo</span>
						     <!--Importe-->
						    <input  id="txtImporte03_servicio_presupuestos_mano_obra_servicio"
						    		name="intImporte03_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control moneda_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="22" />
						     <!--Horas-->
						    <input  id="txtHoras03_servicio_presupuestos_mano_obra_servicio"
						    		name="intHoras03_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control cantidad_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Horas" maxlength="22" />
						</div>
					</div>
					<!--Abril-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Abril</span>
						    <!--Importe-->
						    <input  id="txtImporte04_servicio_presupuestos_mano_obra_servicio"
						    		name="intImporte04_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control moneda_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="22" />
						    <!--Horas-->
						    <input  id="txtHoras04_servicio_presupuestos_mano_obra_servicio"
						    		name="intHoras04_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control cantidad_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Horas" maxlength="22" />
						</div>
					</div>
			   	</div>
			   	<br>
			   	<div class="row">
                    <!--Mayo-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Mayo</span>
						    <!--Importe-->
						    <input  id="txtImporte05_servicio_presupuestos_mano_obra_servicio"
						    		name="intImporte05_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control moneda_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="22" />
						     <!--Horas-->
						    <input  id="txtHoras05_servicio_presupuestos_mano_obra_servicio"
						    		name="intHoras05_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control cantidad_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Horas" maxlength="22" />
						</div>
					</div>
					<!--Junio-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Junio</span>
						    <!--Importe-->
						    <input  id="txtImporte06_servicio_presupuestos_mano_obra_servicio"
						    		name="intImporte06_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control moneda_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="22" />
						    <!--Horas-->
						    <input  id="txtHoras06_servicio_presupuestos_mano_obra_servicio"
						    		name="intHoras06_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control cantidad_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Horas" maxlength="22" />
						</div>
					</div>
					<!--Julio-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Julio</span>
						   <!--Importe-->
						    <input  id="txtImporte07_servicio_presupuestos_mano_obra_servicio"
						    		name="intImporte07_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control moneda_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="22" />
						    <!--Horas-->
						    <input  id="txtHoras07_servicio_presupuestos_mano_obra_servicio"
						    		name="intHoras07_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control cantidad_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Horas" maxlength="22" />
						</div>
					</div>
					<!--Agosto-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Agosto</span>
						    <!--Importe-->
						    <input  id="txtImporte08_servicio_presupuestos_mano_obra_servicio"
						    		name="intImporte08_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control moneda_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="22" />
						    <!--Horas-->
						    <input  id="txtHoras08_servicio_presupuestos_mano_obra_servicio"
						    		name="intHoras08_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control cantidad_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Horas" maxlength="22" />
						</div>
					</div>
			   	</div>
			   	<br>
			   	<div class="row">
                    <!--Septiembre-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Septiembre</span>
						    <!--Importe-->
						    <input  id="txtImporte09_servicio_presupuestos_mano_obra_servicio"
						    		name="intImporte09_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control moneda_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="22" />
						    <!--Horas-->
						    <input  id="txtHoras09_servicio_presupuestos_mano_obra_servicio"
						    		name="intHoras09_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control cantidad_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Horas" maxlength="22" />
						</div>
					</div>
					<!--Octubre-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Octubre</span>
						    <!--Importe-->
						    <input  id="txtImporte10_servicio_presupuestos_mano_obra_servicio"
						    		name="intImporte10_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control moneda_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="22" />
						    <!--Horas-->
						    <input  id="txtHoras10_servicio_presupuestos_mano_obra_servicio"
						    		name="intHoras10_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control cantidad_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Horas" maxlength="22" />
						</div>
					</div>
					<!--Noviembre-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Noviembre</span>
						    <!--Importe-->
						    <input  id="txtImporte11_servicio_presupuestos_mano_obra_servicio"
						    		name="intImporte11_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control moneda_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="22" />
						    <!--Horas-->
						    <input  id="txtHoras11_servicio_presupuestos_mano_obra_servicio"
						    		name="intHoras11_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control cantidad_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Horas" maxlength="22" />
						</div>
					</div>
					<!--Diciembre-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Diciembre</span>
						    <!--Importe-->
						    <input  id="txtImporte12_servicio_presupuestos_mano_obra_servicio"
						    		name="intImporte12_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control moneda_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="22" />
						    <!--Horas-->
						    <input  id="txtHoras12_servicio_presupuestos_mano_obra_servicio"
						    		name="intHoras12_servicio_presupuestos_mano_obra_servicio"
						    		class="form-control cantidad_servicio_presupuestos_mano_obra_servicio"  
									type="text" value="" tabindex="1" placeholder="Horas" maxlength="22" />
						</div>
					</div>
			   	</div>
			   	<br> 
			    <!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_servicio_presupuestos_mano_obra_servicio"  
								onclick="validar_servicio_presupuestos_mano_obra_servicio();" title="Guardar" tabindex="2">
							<span class="fa fa-floppy-o"></span>
						</button> 
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenedor del formulario--> 
	</div><!--#ServicioPresupuestosManoObraServicioContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_servicio_presupuestos_mano_obra_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/servicio_presupuestos_mano_obra/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_servicio_presupuestos_mano_obra_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosServicioPresupuestosManoObraServicio = data.row;
					//Separar la cadena 
					var arrPermisosServicioPresupuestosManoObraServicio = strPermisosServicioPresupuestosManoObraServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosServicioPresupuestosManoObraServicio.length; i++)
					{
						//Si el indice es GUARDAR ó EDITAR (modificar)
						if((arrPermisosServicioPresupuestosManoObraServicio[i]=='GUARDAR') || (arrPermisosServicioPresupuestosManoObraServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_servicio_presupuestos_mano_obra_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para limpiar los campos del formulario
		function nuevo_servicio_presupuestos_mano_obra_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicio_presupuestos_mano_obra_servicio();
			//Limpiar cajas de texto
			$('#txtNuevoID_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtImporte01_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtHoras01_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtImporte02_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtHoras02_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtImporte03_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtHoras03_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtImporte04_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtHoras04_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtImporte05_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtHoras05_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtImporte06_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtHoras06_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtImporte07_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtHoras07_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtImporte08_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtHoras08_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtImporte09_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtHoras09_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtImporte10_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtHoras10_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtImporte11_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtHoras11_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtImporte12_servicio_presupuestos_mano_obra_servicio').val('');
			$('#txtHoras12_servicio_presupuestos_mano_obra_servicio').val('');
		}
	
		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_servicio_presupuestos_mano_obra_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicio_presupuestos_mano_obra_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmServicioPresupuestosManoObraServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strMecanico_servicio_presupuestos_mano_obra_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del mecánico
					                                    if($('#txtMecanicoID_servicio_presupuestos_mano_obra_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un mecánico existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strAnio_servicio_presupuestos_mano_obra_servicio: {
											validators: {
												notEmpty: {message: 'Escriba un año'},
												stringLength: {
													min: 4,
													message: 'El año debe tener 4 caracteres de longitud'
												}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_servicio_presupuestos_mano_obra_servicio = $('#frmServicioPresupuestosManoObraServicio').data('bootstrapValidator');
			bootstrapValidator_servicio_presupuestos_mano_obra_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_servicio_presupuestos_mano_obra_servicio.isValid())
			{
				//Verificar que exista al menos un importe
				if($('#txtImporte01_servicio_presupuestos_mano_obra_servicio').val() == '' && $('#txtHoras01_servicio_presupuestos_mano_obra_servicio').val() == '' &&
				   $('#txtImporte02_servicio_presupuestos_mano_obra_servicio').val() == '' && $('#txtHoras02_servicio_presupuestos_mano_obra_servicio').val() == '' &&
				   $('#txtImporte03_servicio_presupuestos_mano_obra_servicio').val() == '' && $('#txtHoras03_servicio_presupuestos_mano_obra_servicio').val() == '' &&
				   $('#txtImporte04_servicio_presupuestos_mano_obra_servicio').val() == '' && $('#txtHoras04_servicio_presupuestos_mano_obra_servicio').val() == '' &&
				   $('#txtImporte05_servicio_presupuestos_mano_obra_servicio').val() == '' && $('#txtHoras05_servicio_presupuestos_mano_obra_servicio').val() == '' &&
				   $('#txtImporte06_servicio_presupuestos_mano_obra_servicio').val() == '' && $('#txtHoras06_servicio_presupuestos_mano_obra_servicio').val() == '' &&
				   $('#txtImporte07_servicio_presupuestos_mano_obra_servicio').val() == '' && $('#txtHoras07_servicio_presupuestos_mano_obra_servicio').val() == '' &&
				   $('#txtImporte08_servicio_presupuestos_mano_obra_servicio').val() == '' && $('#txtHoras08_servicio_presupuestos_mano_obra_servicio').val() == '' &&
				   $('#txtImporte09_servicio_presupuestos_mano_obra_servicio').val() == '' && $('#txtHoras09_servicio_presupuestos_mano_obra_servicio').val() == '' &&
				   $('#txtImporte10_servicio_presupuestos_mano_obra_servicio').val() == '' && $('#txtHoras10_servicio_presupuestos_mano_obra_servicio').val() == '' &&
				   $('#txtImporte11_servicio_presupuestos_mano_obra_servicio').val() == '' && $('#txtHoras11_servicio_presupuestos_mano_obra_servicio').val() == '' &&
				   $('#txtImporte12_servicio_presupuestos_mano_obra_servicio').val() == '' && $('#txtHoras12_servicio_presupuestos_mano_obra_servicio').val() == '' )
				{
					//Indicar al usuario que debe ingresar al menos una importe
					new $.Zebra_Dialog('Escriba al menos un importe para este presupuesto.', {
							'type': 'error',
							'title': 'Error',
							'buttons': [{caption: 'Aceptar',
										 callback: function () {
										 	//Hacer un llamado a la función para limpiar los mensajes de error 
											limpiar_mensajes_servicio_presupuestos_mano_obra_servicio();
											//Enfocar caja de texto
											$('#txtImporte01_servicio_presupuestos_mano_obra_servicio').focus();
										 }
										}]
						});
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_servicio_presupuestos_mano_obra_servicio();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_servicio_presupuestos_mano_obra_servicio()
		{
			try
			{
				$('#frmServicioPresupuestosManoObraServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un presupuesto
		function guardar_servicio_presupuestos_mano_obra_servicio()
		{
			//Hacer un llamado al método del controlador para guardar los datos del presupuesto
			$.post('servicio/servicio_presupuestos_mano_obra/guardar',
			{ 
				strNuevoID: $('#txtNuevoID_servicio_presupuestos_mano_obra_servicio').val(),
				intMecanicoID: $('#txtMecanicoID_servicio_presupuestos_mano_obra_servicio').val(),
				strAnio: $('#txtAnio_servicio_presupuestos_mano_obra_servicio').val(),
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intImporte01: $.reemplazar($('#txtImporte01_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intHoras01: $.reemplazar($('#txtHoras01_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intImporte02: $.reemplazar($('#txtImporte02_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intHoras02: $.reemplazar($('#txtHoras02_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intImporte03: $.reemplazar($('#txtImporte03_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intHoras03: $.reemplazar($('#txtHoras03_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intImporte04: $.reemplazar($('#txtImporte04_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intHoras04: $.reemplazar($('#txtHoras04_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intImporte05: $.reemplazar($('#txtImporte05_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intHoras05: $.reemplazar($('#txtHoras05_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intImporte06: $.reemplazar($('#txtImporte06_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intHoras06: $.reemplazar($('#txtHoras06_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intImporte07: $.reemplazar($('#txtImporte07_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intHoras07: $.reemplazar($('#txtHoras07_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intImporte08: $.reemplazar($('#txtImporte08_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intHoras08: $.reemplazar($('#txtHoras08_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intImporte09: $.reemplazar($('#txtImporte09_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intHoras09: $.reemplazar($('#txtHoras09_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intImporte10: $.reemplazar($('#txtImporte10_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intHoras10: $.reemplazar($('#txtHoras10_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intImporte11: $.reemplazar($('#txtImporte11_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intHoras11: $.reemplazar($('#txtHoras11_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intImporte12: $.reemplazar($('#txtImporte12_servicio_presupuestos_mano_obra_servicio').val(), ",", ""),
				intHoras12: $.reemplazar($('#txtHoras12_servicio_presupuestos_mano_obra_servicio').val(), ",", "")
			},
			function(data) {
				if (data.resultado)
				{
					//Hacer un llamado a la función para limpiar los campos del formulario
					nuevo_servicio_presupuestos_mano_obra_servicio();
					$('#txtMecanico_servicio_presupuestos_mano_obra_servicio').val('');
					$('#txtMecanicoID_servicio_presupuestos_mano_obra_servicio').val('');
					//Enfocar caja de texto
					$('#txtMecanico_servicio_presupuestos_mano_obra_servicio').focus();
				}
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_servicio_presupuestos_mano_obra_servicio(data.tipo_mensaje, data.mensaje);
			},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_servicio_presupuestos_mano_obra_servicio(tipoMensaje, mensaje)
		{
			//Si el tipo de mensaje es error 
			if(tipoMensaje == 'error')
			{ 
				//Indicar al usuario el mensaje de error
				new $.Zebra_Dialog(mensaje, 
							  {'type': 'error',
							   'title': 'Error'
				    		  });
			}
			else
			{
			    //Indicar al usuario el mensaje de éxito
				new $.Zebra_Dialog(mensaje, 
							  {'type': 'confirmation',
							   'title': 'Éxito',
							   'buttons': false,
						       'modal': false,
						       'auto_close': 2000
					    	  });
			}
		}

		//Función para regresar los datos (al formulario) del presupuesto seleccionado
		function editar_servicio_presupuestos_mano_obra_servicio()
		{	
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_servicio_presupuestos_mano_obra_servicio();
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/servicio_presupuestos_mano_obra/get_datos',
			       {
			       		intMecanicoID: $('#txtMecanicoID_servicio_presupuestos_mano_obra_servicio').val(),
						strAnio: $('#txtAnio_servicio_presupuestos_mano_obra_servicio').val()
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row_importes)
			            {
				          	//Recuperar valores
				          	$('#txtNuevoID_servicio_presupuestos_mano_obra_servicio').val('existe');
				            $('#txtImporte01_servicio_presupuestos_mano_obra_servicio').val(data.row_importes.importe01);
				            $('#txtImporte02_servicio_presupuestos_mano_obra_servicio').val(data.row_importes.importe02);
				            $('#txtImporte03_servicio_presupuestos_mano_obra_servicio').val(data.row_importes.importe03);
				            $('#txtImporte04_servicio_presupuestos_mano_obra_servicio').val(data.row_importes.importe04);
				            $('#txtImporte05_servicio_presupuestos_mano_obra_servicio').val(data.row_importes.importe05);
				            $('#txtImporte06_servicio_presupuestos_mano_obra_servicio').val(data.row_importes.importe06);
				            $('#txtImporte07_servicio_presupuestos_mano_obra_servicio').val(data.row_importes.importe07);
				            $('#txtImporte08_servicio_presupuestos_mano_obra_servicio').val(data.row_importes.importe08);
				            $('#txtImporte09_servicio_presupuestos_mano_obra_servicio').val(data.row_importes.importe09);
				            $('#txtImporte10_servicio_presupuestos_mano_obra_servicio').val(data.row_importes.importe10);
				            $('#txtImporte11_servicio_presupuestos_mano_obra_servicio').val(data.row_importes.importe11);
				            $('#txtImporte12_servicio_presupuestos_mano_obra_servicio').val(data.row_importes.importe12);
			       	    }
			       	    if(data.row_horas)
			            {
				            $('#txtHoras01_servicio_presupuestos_mano_obra_servicio').val(data.row_horas.horas01);
				            $('#txtHoras02_servicio_presupuestos_mano_obra_servicio').val(data.row_horas.horas02);
				            $('#txtHoras03_servicio_presupuestos_mano_obra_servicio').val(data.row_horas.horas03);
				            $('#txtHoras04_servicio_presupuestos_mano_obra_servicio').val(data.row_horas.horas04);
				            $('#txtHoras05_servicio_presupuestos_mano_obra_servicio').val(data.row_horas.horas05);
				            $('#txtHoras06_servicio_presupuestos_mano_obra_servicio').val(data.row_horas.horas06);
				            $('#txtHoras07_servicio_presupuestos_mano_obra_servicio').val(data.row_horas.horas07);
				            $('#txtHoras08_servicio_presupuestos_mano_obra_servicio').val(data.row_horas.horas08);
				            $('#txtHoras09_servicio_presupuestos_mano_obra_servicio').val(data.row_horas.horas09);
				            $('#txtHoras10_servicio_presupuestos_mano_obra_servicio').val(data.row_horas.horas10);
				            $('#txtHoras11_servicio_presupuestos_mano_obra_servicio').val(data.row_horas.horas11);
				            $('#txtHoras12_servicio_presupuestos_mano_obra_servicio').val(data.row_horas.horas12);
			       	    }
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_servicio_presupuestos_mano_obra_servicio()
		{
			//Verificar la existencia del presupuesto
			if ($('#txtMecanicoID_servicio_presupuestos_mano_obra_servicio').val() != '' &&
				$('#txtAnio_servicio_presupuestos_mano_obra_servicio').val() != '')
			{
				//Hacer un llamado a la función para recuperar los datos del presupuesto que coincide con los id´s 
				editar_servicio_presupuestos_mano_obra_servicio();
			}
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Asignar el año actual
       		$('#txtAnio_servicio_presupuestos_mano_obra_servicio').val(anioActual()); 
       		//Validar campos númericos (solamente valores enteros y positivos)
       		$('#txtAnio_servicio_presupuestos_mano_obra_servicio').numeric({decimal: false, negative: false});
       		//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtImporte01_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtHoras01_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtImporte02_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtHoras02_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtImporte03_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtHoras03_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtImporte04_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtHoras04_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtImporte05_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtHoras05_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtImporte06_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtHoras06_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtImporte07_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtHoras07_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtImporte08_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtHoras08_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtImporte09_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtHoras09_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtImporte10_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtHoras10_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtImporte11_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtHoras11_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtImporte12_servicio_presupuestos_mano_obra_servicio').numeric();
        	$('#txtHoras12_servicio_presupuestos_mano_obra_servicio').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_servicio_presupuestos_mano_obra_servicio').blur(function(){
				$('.moneda_servicio_presupuestos_mano_obra_servicio').formatCurrency({ roundToDecimalPlace: 2 });
			});

			$('.cantidad_servicio_presupuestos_mano_obra_servicio').blur(function(){
				$('.cantidad_servicio_presupuestos_mano_obra_servicio').formatCurrency({ roundToDecimalPlace: 2 });
			});

        	

			//Comprobar la existencia del presupuesto en la BD cuando cambie el año
			$('#txtAnio_servicio_presupuestos_mano_obra_servicio').change(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_servicio_presupuestos_mano_obra_servicio();
			});
			
			//Autocomplete para recuperar los datos de un mecánico 
	        $('#txtMecanico_servicio_presupuestos_mano_obra_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMecanicoID_servicio_presupuestos_mano_obra_servicio').val('');
	               //Hacer un llamado a la función para limpiar los campos del formulario
	               nuevo_servicio_presupuestos_mano_obra_servicio();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/mecanicos/autocomplete",
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
	             $('#txtMecanicoID_servicio_presupuestos_mano_obra_servicio').val(ui.item.data);
	             //Hacer un llamado a la función para verificar la existencia del registro
	             verificar_servicio_presupuestos_mano_obra_servicio();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del mecánico cuando pierda el enfoque la caja de texto
	        $('#txtMecanico_servicio_presupuestos_mano_obra_servicio').focusout(function(e){
	            //Si no existe id del mecánico
	            if($('#txtMecanicoID_servicio_presupuestos_mano_obra_servicio').val() == '' ||
	               $('#txtMecanico_servicio_presupuestos_mano_obra_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMecanicoID_servicio_presupuestos_mano_obra_servicio').val('');
	               $('#txtMecanico_servicio_presupuestos_mano_obra_servicio').val('');
	              //Hacer un llamado a la función para limpiar los campos del formulario
	               nuevo_servicio_presupuestos_mano_obra_servicio();
	            }
	            
	        });

			//Enfocar caja de texto
			$('#txtMecanico_servicio_presupuestos_mano_obra_servicio').focus();

			//Deshabilitar el siguiente botón (funciones de permisos de acceso)
			$('#btnGuardar_servicio_presupuestos_mano_obra_servicio').attr('disabled','-1');   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_servicio_presupuestos_mano_obra_servicio();
		});
	</script>