	<div id="RefaccionesPresupuestosComprasRefaccionesContent" >
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<!--Diseño del formulario-->
			<form id="frmRefaccionesPresupuestosComprasRefacciones" method="post" action="#" 
				  class="form-horizontal"  role="form" name="frmRefaccionesPresupuestosComprasRefacciones"
				  onsubmit="return(false)" autocomplete="off">
			    <div class="row">
			    	<!--Autocomplete que contiene las líneas de refacciones activas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para indicar la existencia del presupuesto y así poder actualizar los registros-->
								<input id="txtNuevoID_refacciones_presupuestos_compras_refacciones" 
									   name="strNuevoID_refacciones_presupuestos_compras_refacciones"  
									   type="hidden" value="">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la línea de refacciones seleccionada-->
								<input id="txtRefaccionesLineaID_refacciones_presupuestos_compras_refacciones" 
									   name="intRefaccionesLineaID_refacciones_presupuestos_compras_refacciones"  
									   type="hidden" value="">
								</input>
								<label for="txtRefaccionesLinea_refacciones_presupuestos_compras_refacciones">Línea</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRefaccionesLinea_refacciones_presupuestos_compras_refacciones" 
										name="strRefaccionesLinea_refacciones_presupuestos_compras_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese línea" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Año-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtAnio_refacciones_presupuestos_compras_refacciones">Año</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtAnio_refacciones_presupuestos_compras_refacciones" 
										name="strAnio_refacciones_presupuestos_compras_refacciones" type="number" value=""
										tabindex="1" placeholder="Ingrese año" maxlength="4">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Compras por mes-->
                    <h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Compras por mes</h4>
                    <!--Enero-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte01_refacciones_presupuestos_compras_refacciones">Enero</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_refacciones_presupuestos_compras_refacciones" id="txtImporte01_refacciones_presupuestos_compras_refacciones" 
											name="intImporte01_refacciones_presupuestos_compras_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese importe" maxlength="22">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Febrero-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte02_refacciones_presupuestos_compras_refacciones">Febrero</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_refacciones_presupuestos_compras_refacciones" id="txtImporte02_refacciones_presupuestos_compras_refacciones" 
											name="intImporte02_refacciones_presupuestos_compras_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese importe" maxlength="22">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Marzo-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte03_refacciones_presupuestos_compras_refacciones">Marzo</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_refacciones_presupuestos_compras_refacciones" id="txtImporte03_refacciones_presupuestos_compras_refacciones" 
											name="intImporte03_refacciones_presupuestos_compras_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese importe" maxlength="22">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Abril-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte04_refacciones_presupuestos_compras_refacciones">Abril</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_refacciones_presupuestos_compras_refacciones" id="txtImporte04_refacciones_presupuestos_compras_refacciones" 
											name="intImporte04_refacciones_presupuestos_compras_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese importe" maxlength="22">
									</input>
								</div>
							</div>
						</div>
					</div>
			   	</div>
			   	<div class="row">
                    <!--Mayo-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte05_refacciones_presupuestos_compras_refacciones">Mayo</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_refacciones_presupuestos_compras_refacciones" id="txtImporte05_refacciones_presupuestos_compras_refacciones" 
											name="intImporte05_refacciones_presupuestos_compras_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese importe" maxlength="22">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Junio-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte06_refacciones_presupuestos_compras_refacciones">Junio</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_refacciones_presupuestos_compras_refacciones" id="txtImporte06_refacciones_presupuestos_compras_refacciones" 
											name="intImporte06_refacciones_presupuestos_compras_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese importe" maxlength="22">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Julio-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte07_refacciones_presupuestos_compras_refacciones">Julio</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_refacciones_presupuestos_compras_refacciones" id="txtImporte07_refacciones_presupuestos_compras_refacciones" 
											name="intImporte07_refacciones_presupuestos_compras_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese importe" maxlength="22">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Agosto-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte08_refacciones_presupuestos_compras_refacciones">Agosto</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_refacciones_presupuestos_compras_refacciones" id="txtImporte08_refacciones_presupuestos_compras_refacciones" 
											name="intImporte08_refacciones_presupuestos_compras_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese importe" maxlength="22">
									</input>
								</div>
							</div>
						</div>
					</div>
			   	</div>
			   	<div class="row">
                    <!--Septiembre-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte09_refacciones_presupuestos_compras_refacciones">Septiembre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_refacciones_presupuestos_compras_refacciones" id="txtImporte09_refacciones_presupuestos_compras_refacciones" 
											name="intImporte09_refacciones_presupuestos_compras_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese importe" maxlength="22">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Octubre-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte10_refacciones_presupuestos_compras_refacciones">Octubre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_refacciones_presupuestos_compras_refacciones" id="txtImporte10_refacciones_presupuestos_compras_refacciones" 
											name="intImporte10_refacciones_presupuestos_compras_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese importe" maxlength="22">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Noviembre-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte11_refacciones_presupuestos_compras_refacciones">Noviembre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_refacciones_presupuestos_compras_refacciones" id="txtImporte11_refacciones_presupuestos_compras_refacciones" 
											name="intImporte11_refacciones_presupuestos_compras_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese importe" maxlength="22">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Diciembre-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte12_refacciones_presupuestos_compras_refacciones">Diciembre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_refacciones_presupuestos_compras_refacciones" id="txtImporte12_refacciones_presupuestos_compras_refacciones" 
											name="intImporte12_refacciones_presupuestos_compras_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese importe" maxlength="22">
									</input>
								</div>
							</div>
						</div>
					</div>
			   	</div>
			    <!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_refacciones_presupuestos_compras_refacciones"  
								onclick="validar_refacciones_presupuestos_compras_refacciones();" title="Guardar" tabindex="2" disabled>
							<span class="fa fa-floppy-o"></span>
						</button> 
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenedor del formulario--> 
	</div><!--#RefaccionesPresupuestosComprasRefaccionesContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_refacciones_presupuestos_compras_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/refacciones_presupuestos_compras/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_refacciones_presupuestos_compras_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRefaccionesPresupuestosComprasRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosRefaccionesPresupuestosComprasRefacciones = strPermisosRefaccionesPresupuestosComprasRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRefaccionesPresupuestosComprasRefacciones.length; i++)
					{
						//Si el indice es GUARDAR ó EDITAR (modificar)
						if((arrPermisosRefaccionesPresupuestosComprasRefacciones[i]=='GUARDAR') || (arrPermisosRefaccionesPresupuestosComprasRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_refacciones_presupuestos_compras_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para limpiar los campos del formulario
		function nuevo_refacciones_presupuestos_compras_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_presupuestos_compras_refacciones();
			//Limpiar cajas de texto
			$('#txtNuevoID_refacciones_presupuestos_compras_refacciones').val('');
			$('#txtImporte01_refacciones_presupuestos_compras_refacciones').val('');
			$('#txtImporte02_refacciones_presupuestos_compras_refacciones').val('');
			$('#txtImporte03_refacciones_presupuestos_compras_refacciones').val('');
			$('#txtImporte04_refacciones_presupuestos_compras_refacciones').val('');
			$('#txtImporte05_refacciones_presupuestos_compras_refacciones').val('');
			$('#txtImporte06_refacciones_presupuestos_compras_refacciones').val('');
			$('#txtImporte07_refacciones_presupuestos_compras_refacciones').val('');
			$('#txtImporte08_refacciones_presupuestos_compras_refacciones').val('');
			$('#txtImporte09_refacciones_presupuestos_compras_refacciones').val('');
			$('#txtImporte10_refacciones_presupuestos_compras_refacciones').val('');
			$('#txtImporte11_refacciones_presupuestos_compras_refacciones').val('');
			$('#txtImporte12_refacciones_presupuestos_compras_refacciones').val('');
		}
	
		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_refacciones_presupuestos_compras_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_presupuestos_compras_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmRefaccionesPresupuestosComprasRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strAnio_refacciones_presupuestos_compras_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba un año'},
												stringLength: {
													min: 4,
													message: 'El año debe tener 4 caracteres de longitud'
												}
											}
										},
										strRefaccionesLinea_refacciones_presupuestos_compras_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la línea de refacciones
					                                    if($('#txtRefaccionesLineaID_refacciones_presupuestos_compras_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una línea existente'
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
			var bootstrapValidator_refacciones_presupuestos_compras_refacciones = $('#frmRefaccionesPresupuestosComprasRefacciones').data('bootstrapValidator');
			bootstrapValidator_refacciones_presupuestos_compras_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_refacciones_presupuestos_compras_refacciones.isValid())
			{
				//Verificar que exista al menos un importe
				if($('#txtImporte01_refacciones_presupuestos_compras_refacciones').val() == '' && 
				   $('#txtImporte02_refacciones_presupuestos_compras_refacciones').val() == '' &&
				   $('#txtImporte03_refacciones_presupuestos_compras_refacciones').val() == '' &&
				   $('#txtImporte04_refacciones_presupuestos_compras_refacciones').val() == '' &&
				   $('#txtImporte05_refacciones_presupuestos_compras_refacciones').val() == '' &&
				   $('#txtImporte06_refacciones_presupuestos_compras_refacciones').val() == '' &&
				   $('#txtImporte07_refacciones_presupuestos_compras_refacciones').val() == '' &&
				   $('#txtImporte08_refacciones_presupuestos_compras_refacciones').val() == '' &&
				   $('#txtImporte09_refacciones_presupuestos_compras_refacciones').val() == '' &&
				   $('#txtImporte10_refacciones_presupuestos_compras_refacciones').val() == '' &&
				   $('#txtImporte11_refacciones_presupuestos_compras_refacciones').val() == '' &&
				   $('#txtImporte12_refacciones_presupuestos_compras_refacciones').val() == '')
				{
					//Indicar al usuario que debe ingresar al menos una importe
					new $.Zebra_Dialog('Escriba al menos un importe para este presupuesto.', {
										'type': 'error',
										'title': 'Error',
										'buttons': [{caption: 'Aceptar',
													 callback: function () {
													 	//Hacer un llamado a la función para limpiar los mensajes de error 
														limpiar_mensajes_refacciones_presupuestos_compras_refacciones();
														//Enfocar caja de texto
														$('#txtImporte01_refacciones_presupuestos_compras_refacciones').focus();
													 }
													}]
									});
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_refacciones_presupuestos_compras_refacciones();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_refacciones_presupuestos_compras_refacciones()
		{
			try
			{
				$('#frmRefaccionesPresupuestosComprasRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un presupuesto
		function guardar_refacciones_presupuestos_compras_refacciones()
		{
			//Hacer un llamado al método del controlador para guardar los datos del presupuesto
			$.post('refacciones/refacciones_presupuestos_compras/guardar',
					{ 
						strNuevoID: $('#txtNuevoID_refacciones_presupuestos_compras_refacciones').val(),
						intRefaccionesLineaID: $('#txtRefaccionesLineaID_refacciones_presupuestos_compras_refacciones').val(),
						strAnio: $('#txtAnio_refacciones_presupuestos_compras_refacciones').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intImporte01: $.reemplazar($('#txtImporte01_refacciones_presupuestos_compras_refacciones').val(), ",", ""),
						intImporte02: $.reemplazar($('#txtImporte02_refacciones_presupuestos_compras_refacciones').val(), ",", ""),
						intImporte03: $.reemplazar($('#txtImporte03_refacciones_presupuestos_compras_refacciones').val(), ",", ""),
						intImporte04: $.reemplazar($('#txtImporte04_refacciones_presupuestos_compras_refacciones').val(), ",", ""),
						intImporte05: $.reemplazar($('#txtImporte05_refacciones_presupuestos_compras_refacciones').val(), ",", ""),
						intImporte06: $.reemplazar($('#txtImporte06_refacciones_presupuestos_compras_refacciones').val(), ",", ""),
						intImporte07: $.reemplazar($('#txtImporte07_refacciones_presupuestos_compras_refacciones').val(), ",", ""),
						intImporte08: $.reemplazar($('#txtImporte08_refacciones_presupuestos_compras_refacciones').val(), ",", ""),
						intImporte09: $.reemplazar($('#txtImporte09_refacciones_presupuestos_compras_refacciones').val(), ",", ""),
						intImporte10: $.reemplazar($('#txtImporte10_refacciones_presupuestos_compras_refacciones').val(), ",", ""),
						intImporte11: $.reemplazar($('#txtImporte11_refacciones_presupuestos_compras_refacciones').val(), ",", ""),
						intImporte12: $.reemplazar($('#txtImporte12_refacciones_presupuestos_compras_refacciones').val(), ",", "")
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_refacciones_presupuestos_compras_refacciones();  
							$('#txtRefaccionesLinea_refacciones_presupuestos_compras_refacciones').val('');
							$('#txtRefaccionesLineaID_refacciones_presupuestos_compras_refacciones').val('');
							//Enfocar caja de texto
							$('#txtRefaccionesLinea_refacciones_presupuestos_compras_refacciones').focus();                
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_refacciones_presupuestos_compras_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_refacciones_presupuestos_compras_refacciones(tipoMensaje, mensaje)
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
		function editar_refacciones_presupuestos_compras_refacciones()
		{	
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_refacciones_presupuestos_compras_refacciones();
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/refacciones_presupuestos_compras/get_datos',
			       {intRefaccionesLineaID: $('#txtRefaccionesLineaID_refacciones_presupuestos_compras_refacciones').val(),
					strAnio: $('#txtAnio_refacciones_presupuestos_compras_refacciones').val()
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				          	$('#txtNuevoID_refacciones_presupuestos_compras_refacciones').val('existe');
				            $('#txtImporte01_refacciones_presupuestos_compras_refacciones').val(data.row.importe01);
				            $('#txtImporte02_refacciones_presupuestos_compras_refacciones').val(data.row.importe02);
				            $('#txtImporte03_refacciones_presupuestos_compras_refacciones').val(data.row.importe03);
				            $('#txtImporte04_refacciones_presupuestos_compras_refacciones').val(data.row.importe04);
				            $('#txtImporte05_refacciones_presupuestos_compras_refacciones').val(data.row.importe05);
				            $('#txtImporte06_refacciones_presupuestos_compras_refacciones').val(data.row.importe06);
				            $('#txtImporte07_refacciones_presupuestos_compras_refacciones').val(data.row.importe07);
				            $('#txtImporte08_refacciones_presupuestos_compras_refacciones').val(data.row.importe08);
				            $('#txtImporte09_refacciones_presupuestos_compras_refacciones').val(data.row.importe09);
				            $('#txtImporte10_refacciones_presupuestos_compras_refacciones').val(data.row.importe10);
				            $('#txtImporte11_refacciones_presupuestos_compras_refacciones').val(data.row.importe11);
				            $('#txtImporte12_refacciones_presupuestos_compras_refacciones').val(data.row.importe12);
			       	    }
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_refacciones_presupuestos_compras_refacciones()
		{
			//Verificar la existencia del presupuesto
			if ($('#txtRefaccionesLineaID_refacciones_presupuestos_compras_refacciones').val() != '' &&
					$('#txtAnio_refacciones_presupuestos_compras_refacciones').val() != '')
			{
				//Hacer un llamado a la función para recuperar los datos del presupuesto que coincide con los id´s 
				editar_refacciones_presupuestos_compras_refacciones();
			}
			else
			{
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_refacciones_presupuestos_compras_refacciones();  
			}
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Asignar el año actual
       		$('#txtAnio_refacciones_presupuestos_compras_refacciones').val(anioActual()); 
       		//Validar campos númericos (solamente valores enteros y positivos)
       		$('#txtAnio_refacciones_presupuestos_compras_refacciones').numeric({decimal: false, negative: false});
       		//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtImporte01_refacciones_presupuestos_compras_refacciones').numeric();
        	$('#txtImporte02_refacciones_presupuestos_compras_refacciones').numeric();
        	$('#txtImporte03_refacciones_presupuestos_compras_refacciones').numeric();
        	$('#txtImporte04_refacciones_presupuestos_compras_refacciones').numeric();
        	$('#txtImporte05_refacciones_presupuestos_compras_refacciones').numeric();
        	$('#txtImporte06_refacciones_presupuestos_compras_refacciones').numeric();
        	$('#txtImporte07_refacciones_presupuestos_compras_refacciones').numeric();
        	$('#txtImporte08_refacciones_presupuestos_compras_refacciones').numeric();
        	$('#txtImporte09_refacciones_presupuestos_compras_refacciones').numeric();
        	$('#txtImporte10_refacciones_presupuestos_compras_refacciones').numeric();
        	$('#txtImporte11_refacciones_presupuestos_compras_refacciones').numeric();
        	$('#txtImporte12_refacciones_presupuestos_compras_refacciones').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_refacciones_presupuestos_compras_refacciones').blur(function(){
				$('.moneda_refacciones_presupuestos_compras_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
			});

			//Comprobar la existencia del presupuesto en la BD cuando cambie el año
			$('#txtAnio_refacciones_presupuestos_compras_refacciones').change(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_refacciones_presupuestos_compras_refacciones();
			});

			
	        //Autocomplete para recuperar los datos de una línea de refacciones 
	        $('#txtRefaccionesLinea_refacciones_presupuestos_compras_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtRefaccionesLineaID_refacciones_presupuestos_compras_refacciones').val('');
	               //Hacer un llamado a la función para limpiar los campos del formulario
	               nuevo_refacciones_presupuestos_compras_refacciones();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/refacciones_lineas/autocomplete",
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
	             $('#txtRefaccionesLineaID_refacciones_presupuestos_compras_refacciones').val(ui.item.data);
	             //Hacer un llamado a la función para verificar la existencia del registro
				  verificar_refacciones_presupuestos_compras_refacciones();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la línea de refacciones cuando pierda el enfoque la caja de texto
	        $('#txtRefaccionesLinea_refacciones_presupuestos_compras_refacciones').focusout(function(e){
	            //Si no existe id de la línea de refacciones
	            if($('#txtRefaccionesLineaID_refacciones_presupuestos_compras_refacciones').val() == '' ||
	               $('#txtRefaccionesLinea_refacciones_presupuestos_compras_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtRefaccionesLineaID_refacciones_presupuestos_compras_refacciones').val('');
	               $('#txtRefaccionesLinea_refacciones_presupuestos_compras_refacciones').val('');
	               //Hacer un llamado a la función para limpiar los campos del formulario
	               nuevo_refacciones_presupuestos_compras_refacciones();
	            }
	            
	        });

			//Enfocar caja de texto
			$('#txtRefaccionesLinea_refacciones_presupuestos_compras_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_refacciones_presupuestos_compras_refacciones();
		});
	</script>