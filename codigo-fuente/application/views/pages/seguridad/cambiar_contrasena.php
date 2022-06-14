	<div id="CambiarContrasenaContent">
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<!--Diseño del formulario-->
			<form id="frmCambiarContrasena" method="post" action="#" class="form-horizontal" role="form" name="frmCambiarContrasena" 
				  onsubmit="return(false)" autocomplete="off">
				<div class="form-group">
					<!--Usuario-->
					<div class="col-md-12">
						<label for="txtUsuario_cambiar_contrasena">Usuario</label>
					</div>
					<div class="col-md-12">
						<input class="form-control" id="txtUsuario_cambiar_contrasena" name="strUsuario_cambiar_contrasena" 
							   type="text" value="<?php echo $this->session->userdata('usuario') ?>" disabled >
						</input>
					</div>
				</div>
				<div class="form-group">
					<!--Contraseña actual-->
					<div class="col-md-12">
						<label for="txtContrasenaActual_cambiar_contrasena">Contraseña actual</label>
					</div>
					<div class="col-md-12">
						<input class="form-control" id="txtContrasenaActual_cambiar_contrasena" name="strContrasenaActual_cambiar_contrasena" 
							   type="password" value="" tabindex="1" placeholder="Ingrese contraseña actual" maxlength ="12">
						</input>
					</div>
				</div>
				<div class="form-group">
					<!--Contraseña-->
					<div class="col-md-12">
						<label for="txtContrasena_cambiar_contrasena">Contraseña nueva</label>
					</div>
					<div class="col-md-12">
						<input class="form-control" id="txtContrasena_cambiar_contrasena" name="strContrasena_cambiar_contrasena" type="password" 
							   value="" tabindex="1" placeholder="Ingrese nueva contraseña" maxlength ="12">
						</input>
					</div>
				</div>
				<div class="form-group">
					<!--Confirmar contraseña-->
					<div class="col-md-12">
						<label for="txtConfirmarContrasena_cambiar_contrasena">Confirmar contraseña nueva</label>
					</div>
					<div class="col-md-12">
						<input class="form-control" id="txtConfirmarContrasena_cambiar_contrasena" name="strConfirmarContrasena_cambiar_contrasena" 
							   type="password" value="" tabindex="1" placeholder="Ingrese confirmación de nueva contraseña" maxlength ="12">
						</input>
					</div>
				</div>
				<!--Botones de acción (barra de tareas)-->
				<div class="form-group">
					<div class="col-md-12">
						<!--Guardar registro-->
						<button id="btnGuardar_cambiar_contrasena" class="btn btn-success pull-right" tabindex="2"
								onclick="validar_cambiar_contrasena();" title="Guardar">
							<span class="fa fa-floppy-o"></span>
						</button> 
					</div>
				</div>
			</form>
		</div><!-- Cierre del contenedor del formulario--> 
	</div><!-- /#CambiarContrasenaContent -->

	<script type="text/javascript">
		//Función para limpiar los campos del formulario
		function nuevo_cambiar_contrasena()
		{
			//Incializar formulario
			$('#frmCambiarContrasena')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cambiar_contrasena();
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cambiar_contrasena()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cambiar_contrasena();
			//Validación del formulario (campos obligatorios)
			$("#frmCambiarContrasena")
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
										valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									 },
									 fields: {  
										strContrasenaActual_cambiar_contrasena: {
											validators: {
												notEmpty: {message: 'Escriba una contraseña'}
											}
										},
										strContrasena_cambiar_contrasena: {
											validators: {
												notEmpty: {message: 'Escriba una contraseña'},
												stringLength: {
													min: 8,
													max: 12,
													message: 'La contraseña debe tener entre 8 y 12 caracteres de longitud'
												},
												identical: {
													field: 'strConfirmarContrasena_cambiar_contrasena',
													message: 'La contraseña y su confirmación no son iguales'
												}
											}
										},
										strConfirmarContrasena_cambiar_contrasena: {
											validators: {
												notEmpty: {message: 'Escriba una confirmación de contraseña'},
												stringLength: {
													min: 8,
													max: 12,
													message: 'La confirmación de contraseña debe tener entre 8 y 12 caracteres de longitud'
												},
												identical: {
													field: 'strContrasena_cambiar_contrasena',
													message: 'La contraseña y su confirmación no son iguales'
												}
											}
										}
									}
				});

			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cambiar_contrasena = $('#frmCambiarContrasena').data('bootstrapValidator');
			bootstrapValidator_cambiar_contrasena.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cambiar_contrasena.isValid())
			{
				//Hacer un llamado a la función para modificar la contraseña del usuario
				guardar_cambiar_contrasena();
			}
			else 
				return;
		}


		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cambiar_contrasena()
		{
			try
			{
				$('#frmCambiarContrasena').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para modificar la contraseña del usuario que se encuentra logeado en el sistema
		function guardar_cambiar_contrasena()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('seguridad/cambiar_contrasena/guardar',
					{ 
						strContrasenaActual: $('#txtContrasenaActual_cambiar_contrasena').val(),
						strContrasena: $('#txtContrasena_cambiar_contrasena').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cambiar_contrasena();                
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cambiar_contrasena(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_cambiar_contrasena(tipoMensaje, mensaje)
		{
			//Si el tipo de mensaje es un error
			if(tipoMensaje == 'error')
			{ 
				//Indicar al usuario el mensaje de éxito
				new $.Zebra_Dialog(mensaje, {
									'type': 'error',
									'title': 'Error',
									'buttons': [{caption: 'Aceptar',
												 callback: function () {
												 	//Hacer un llamado a la función para limpiar los mensajes de error 
													limpiar_mensajes_cambiar_contrasena();
													//Limpiar contenido de la caja de texto
													$('#txtContrasenaActual_cambiar_contrasena').val('');
													//Enfocar caja de texto
													$('#txtContrasenaActual_cambiar_contrasena').focus();
												 }
												}]
							    });
			}
			else
			{
			    //Indicar al usuario el mensaje de error
				new $.Zebra_Dialog(mensaje, {
									'type': 'confirmation',
									'title': 'Éxito',
							        'buttons': false,
						            'modal': false,
						            'auto_close': 2000
					    		});

				
			}
		}
		//Controles o Eventos del formulario
		$(document).ready(function()
		{
			//Enfocar caja de texto
			$('#txtContrasenaActual_cambiar_contrasena').focus();
		});
	</script>