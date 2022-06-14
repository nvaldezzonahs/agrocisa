	<div id="CuentasPresupuestosContabilidadContent" >
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<!--Diseño del formulario-->
			<form id="frmCuentasPresupuestosContabilidad" method="post" action="#" 
				  class="form-horizontal"  role="form" name="frmCuentasPresupuestosContabilidad"
				  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Autocomplete que contiene las cuentas activas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para indicar la existencia del presupuesto y así poder actualizar los registros-->
								<input id="txtNuevoID_cuentas_presupuestos_contabilidad" 
									   name="strNuevoID_cuentas_presupuestos_contabilidad"  
									   type="hidden" value="">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta seleccionada-->
								<input id="txtCuentaID_cuentas_presupuestos_contabilidad" 
									   name="intCuentaID_cuentas_presupuestos_contabilidad"  
									   type="hidden" value="">
								</input>
								<label for="txtCuenta_cuentas_presupuestos_contabilidad">Cuenta</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtCuenta_cuentas_presupuestos_contabilidad" 
										name="strCuenta_cuentas_presupuestos_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese cuenta" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Año-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtAnio_cuentas_presupuestos_contabilidad">Año</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtAnio_cuentas_presupuestos_contabilidad" 
										name="strAnio_cuentas_presupuestos_contabilidad" type="number" value=""
										tabindex="1" placeholder="Ingrese año" maxlength="4">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Presupuesto por mes-->
                    <h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Presupuesto por mes</h4>
                    <!--Enero-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte01_cuentas_presupuestos_contabilidad">Enero</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_cuentas_presupuestos_contabilidad" id="txtImporte01_cuentas_presupuestos_contabilidad" 
											name="intImporte01_cuentas_presupuestos_contabilidad" type="text" value="" 
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
								<label for="txtImporte02_cuentas_presupuestos_contabilidad">Febrero</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_cuentas_presupuestos_contabilidad" id="txtImporte02_cuentas_presupuestos_contabilidad" 
											name="intImporte02_cuentas_presupuestos_contabilidad" type="text" value="" 
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
								<label for="txtImporte03_cuentas_presupuestos_contabilidad">Marzo</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_cuentas_presupuestos_contabilidad" id="txtImporte03_cuentas_presupuestos_contabilidad" 
											name="intImporte03_cuentas_presupuestos_contabilidad" type="text" value="" 
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
								<label for="txtImporte04_cuentas_presupuestos_contabilidad">Abril</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_cuentas_presupuestos_contabilidad" id="txtImporte04_cuentas_presupuestos_contabilidad" 
											name="intImporte04_cuentas_presupuestos_contabilidad" type="text" value="" 
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
								<label for="txtImporte05_cuentas_presupuestos_contabilidad">Mayo</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_cuentas_presupuestos_contabilidad" id="txtImporte05_cuentas_presupuestos_contabilidad" 
											name="intImporte05_cuentas_presupuestos_contabilidad" type="text" value="" 
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
								<label for="txtImporte06_cuentas_presupuestos_contabilidad">Junio</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_cuentas_presupuestos_contabilidad" id="txtImporte06_cuentas_presupuestos_contabilidad" 
											name="intImporte06_cuentas_presupuestos_contabilidad" type="text" value="" 
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
								<label for="txtImporte07_cuentas_presupuestos_contabilidad">Julio</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_cuentas_presupuestos_contabilidad" id="txtImporte07_cuentas_presupuestos_contabilidad" 
											name="intImporte07_cuentas_presupuestos_contabilidad" type="text" value="" 
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
								<label for="txtImporte08_cuentas_presupuestos_contabilidad">Agosto</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_cuentas_presupuestos_contabilidad" id="txtImporte08_cuentas_presupuestos_contabilidad" 
											name="intImporte08_cuentas_presupuestos_contabilidad" type="text" value="" 
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
								<label for="txtImporte09_cuentas_presupuestos_contabilidad">Septiembre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_cuentas_presupuestos_contabilidad" id="txtImporte09_cuentas_presupuestos_contabilidad" 
											name="intImporte09_cuentas_presupuestos_contabilidad" type="text" value="" 
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
								<label for="txtImporte10_cuentas_presupuestos_contabilidad">Octubre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_cuentas_presupuestos_contabilidad" id="txtImporte10_cuentas_presupuestos_contabilidad" 
											name="intImporte10_cuentas_presupuestos_contabilidad" type="text" value="" 
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
								<label for="txtImporte11_cuentas_presupuestos_contabilidad">Noviembre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_cuentas_presupuestos_contabilidad" id="txtImporte11_cuentas_presupuestos_contabilidad" 
											name="intImporte11_cuentas_presupuestos_contabilidad" type="text" value="" 
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
								<label for="txtImporte12_cuentas_presupuestos_contabilidad">Diciembre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_cuentas_presupuestos_contabilidad" id="txtImporte12_cuentas_presupuestos_contabilidad" 
											name="intImporte12_cuentas_presupuestos_contabilidad" type="text" value="" 
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
						<button class="btn btn-success" id="btnGuardar_cuentas_presupuestos_contabilidad"  
								onclick="validar_cuentas_presupuestos_contabilidad();" title="Guardar" tabindex="2" disabled>
							<span class="fa fa-floppy-o"></span>
						</button> 
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenedor del formulario--> 
	</div><!--#CuentasPresupuestosContabilidadContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_cuentas_presupuestos_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/cuentas_presupuestos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_cuentas_presupuestos_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCuentasPresupuestosContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosCuentasPresupuestosContabilidad = strPermisosCuentasPresupuestosContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCuentasPresupuestosContabilidad.length; i++)
					{
						//Si el indice es GUARDAR ó EDITAR (modificar)
						if((arrPermisosCuentasPresupuestosContabilidad[i]=='GUARDAR') || (arrPermisosCuentasPresupuestosContabilidad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_cuentas_presupuestos_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para limpiar los campos del formulario
		function nuevo_cuentas_presupuestos_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cuentas_presupuestos_contabilidad(); 
			//Limpiar cajas de texto
			$('#txtNuevoID_cuentas_presupuestos_contabilidad').val('');
			$('#txtImporte01_cuentas_presupuestos_contabilidad').val('');
			$('#txtImporte02_cuentas_presupuestos_contabilidad').val('');
			$('#txtImporte03_cuentas_presupuestos_contabilidad').val('');
			$('#txtImporte04_cuentas_presupuestos_contabilidad').val('');
			$('#txtImporte05_cuentas_presupuestos_contabilidad').val('');
			$('#txtImporte06_cuentas_presupuestos_contabilidad').val('');
			$('#txtImporte07_cuentas_presupuestos_contabilidad').val('');
			$('#txtImporte08_cuentas_presupuestos_contabilidad').val('');
			$('#txtImporte09_cuentas_presupuestos_contabilidad').val('');
			$('#txtImporte10_cuentas_presupuestos_contabilidad').val('');
			$('#txtImporte11_cuentas_presupuestos_contabilidad').val('');
			$('#txtImporte12_cuentas_presupuestos_contabilidad').val('');
			
		}
	
		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cuentas_presupuestos_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cuentas_presupuestos_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmCuentasPresupuestosContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strAnio_cuentas_presupuestos_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba un año'},
												stringLength: {
													min: 4,
													message: 'El año debe tener 4 caracteres de longitud'
												}
											}
										},
										strCuenta_cuentas_presupuestos_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cuenta
					                                    if($('#txtCuentaID_cuentas_presupuestos_contabilidad').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una cuenta existente'
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
			var bootstrapValidator_cuentas_presupuestos_contabilidad = $('#frmCuentasPresupuestosContabilidad').data('bootstrapValidator');
			bootstrapValidator_cuentas_presupuestos_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cuentas_presupuestos_contabilidad.isValid())
			{
				//Verificar que exista al menos un importe
				if($('#txtImporte01_cuentas_presupuestos_contabilidad').val() == '' && 
				   $('#txtImporte02_cuentas_presupuestos_contabilidad').val() == '' &&
				   $('#txtImporte03_cuentas_presupuestos_contabilidad').val() == '' &&
				   $('#txtImporte04_cuentas_presupuestos_contabilidad').val() == '' &&
				   $('#txtImporte05_cuentas_presupuestos_contabilidad').val() == '' &&
				   $('#txtImporte06_cuentas_presupuestos_contabilidad').val() == '' &&
				   $('#txtImporte07_cuentas_presupuestos_contabilidad').val() == '' &&
				   $('#txtImporte08_cuentas_presupuestos_contabilidad').val() == '' &&
				   $('#txtImporte09_cuentas_presupuestos_contabilidad').val() == '' &&
				   $('#txtImporte10_cuentas_presupuestos_contabilidad').val() == '' &&
				   $('#txtImporte11_cuentas_presupuestos_contabilidad').val() == '' &&
				   $('#txtImporte12_cuentas_presupuestos_contabilidad').val() == '')
				{
					//Indicar al usuario que debe ingresar al menos un importe
					new $.Zebra_Dialog('Escriba al menos un importe para este presupuesto.', {
							'type': 'error',
							'title': 'Error',
							'buttons': [{caption: 'Aceptar',
										 callback: function () {
										 	//Hacer un llamado a la función para limpiar los mensajes de error 
											limpiar_mensajes_cuentas_presupuestos_contabilidad();
											//Enfocar caja de texto
											$('#txtImporte01_cuentas_presupuestos_contabilidad').focus();
										 }
										}]
						});
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_cuentas_presupuestos_contabilidad();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cuentas_presupuestos_contabilidad()
		{
			try
			{
				$('#frmCuentasPresupuestosContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un presupuesto
		function guardar_cuentas_presupuestos_contabilidad()
		{
			//Hacer un llamado al método del controlador para guardar los datos del presupuesto
			$.post('contabilidad/cuentas_presupuestos/guardar',
					{ 
						strNuevoID: $('#txtNuevoID_cuentas_presupuestos_contabilidad').val(),
						intCuentaID: $('#txtCuentaID_cuentas_presupuestos_contabilidad').val(),
						strAnio: $('#txtAnio_cuentas_presupuestos_contabilidad').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intImporte01: $.reemplazar($('#txtImporte01_cuentas_presupuestos_contabilidad').val(), ",", ""),
						intImporte02: $.reemplazar($('#txtImporte02_cuentas_presupuestos_contabilidad').val(), ",", ""),
						intImporte03: $.reemplazar($('#txtImporte03_cuentas_presupuestos_contabilidad').val(), ",", ""),
						intImporte04: $.reemplazar($('#txtImporte04_cuentas_presupuestos_contabilidad').val(), ",", ""),
						intImporte05: $.reemplazar($('#txtImporte05_cuentas_presupuestos_contabilidad').val(), ",", ""),
						intImporte06: $.reemplazar($('#txtImporte06_cuentas_presupuestos_contabilidad').val(), ",", ""),
						intImporte07: $.reemplazar($('#txtImporte07_cuentas_presupuestos_contabilidad').val(), ",", ""),
						intImporte08: $.reemplazar($('#txtImporte08_cuentas_presupuestos_contabilidad').val(), ",", ""),
						intImporte09: $.reemplazar($('#txtImporte09_cuentas_presupuestos_contabilidad').val(), ",", ""),
						intImporte10: $.reemplazar($('#txtImporte10_cuentas_presupuestos_contabilidad').val(), ",", ""),
						intImporte11: $.reemplazar($('#txtImporte11_cuentas_presupuestos_contabilidad').val(), ",", ""),
						intImporte12: $.reemplazar($('#txtImporte12_cuentas_presupuestos_contabilidad').val(), ",", "")
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cuentas_presupuestos_contabilidad();
							$('#txtCuenta_cuentas_presupuestos_contabilidad').val('');
							$('#txtCuentaID_cuentas_presupuestos_contabilidad').val('');
							//Enfocar caja de texto
							$('#txtCuenta_cuentas_presupuestos_contabilidad').focus();                 
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cuentas_presupuestos_contabilidad(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_cuentas_presupuestos_contabilidad(tipoMensaje, mensaje)
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
		function editar_cuentas_presupuestos_contabilidad()
		{	
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cuentas_presupuestos_contabilidad();
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/cuentas_presupuestos/get_datos',
			       {intCuentaID: $('#txtCuentaID_cuentas_presupuestos_contabilidad').val(),
					strAnio: $('#txtAnio_cuentas_presupuestos_contabilidad').val()
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				          	$('#txtNuevoID_cuentas_presupuestos_contabilidad').val('existe');
				            $('#txtImporte01_cuentas_presupuestos_contabilidad').val(data.row.importe01);
				            $('#txtImporte02_cuentas_presupuestos_contabilidad').val(data.row.importe02);
				            $('#txtImporte03_cuentas_presupuestos_contabilidad').val(data.row.importe03);
				            $('#txtImporte04_cuentas_presupuestos_contabilidad').val(data.row.importe04);
				            $('#txtImporte05_cuentas_presupuestos_contabilidad').val(data.row.importe05);
				            $('#txtImporte06_cuentas_presupuestos_contabilidad').val(data.row.importe06);
				            $('#txtImporte07_cuentas_presupuestos_contabilidad').val(data.row.importe07);
				            $('#txtImporte08_cuentas_presupuestos_contabilidad').val(data.row.importe08);
				            $('#txtImporte09_cuentas_presupuestos_contabilidad').val(data.row.importe09);
				            $('#txtImporte10_cuentas_presupuestos_contabilidad').val(data.row.importe10);
				            $('#txtImporte11_cuentas_presupuestos_contabilidad').val(data.row.importe11);
				            $('#txtImporte12_cuentas_presupuestos_contabilidad').val(data.row.importe12);
			       	    }
			       },
			       'json');
		}


		//Función para verificar la existencia de un registro
		function verificar_cuentas_presupuestos_contabilidad()
		{
			 //Verificar la existencia del presupuesto
			if ($('#txtCuentaID_cuentas_presupuestos_contabilidad').val() != '' &&
				$('#txtAnio_cuentas_presupuestos_contabilidad').val() != '')
			{
				//Hacer un llamado a la función para recuperar los datos del presupuesto que coincide con los id´s 
				editar_cuentas_presupuestos_contabilidad();
			}
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Asignar el año actual
       		$('#txtAnio_cuentas_presupuestos_contabilidad').val(anioActual()); 
       		//Validar campos númericos (solamente valores enteros y positivos)
       		$('#txtAnio_cuentas_presupuestos_contabilidad').numeric({decimal: false, negative: false});
       		//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtImporte01_cuentas_presupuestos_contabilidad').numeric();
        	$('#txtImporte02_cuentas_presupuestos_contabilidad').numeric();
        	$('#txtImporte03_cuentas_presupuestos_contabilidad').numeric();
        	$('#txtImporte04_cuentas_presupuestos_contabilidad').numeric();
        	$('#txtImporte05_cuentas_presupuestos_contabilidad').numeric();
        	$('#txtImporte06_cuentas_presupuestos_contabilidad').numeric();
        	$('#txtImporte07_cuentas_presupuestos_contabilidad').numeric();
        	$('#txtImporte08_cuentas_presupuestos_contabilidad').numeric();
        	$('#txtImporte09_cuentas_presupuestos_contabilidad').numeric();
        	$('#txtImporte10_cuentas_presupuestos_contabilidad').numeric();
        	$('#txtImporte11_cuentas_presupuestos_contabilidad').numeric();
        	$('#txtImporte12_cuentas_presupuestos_contabilidad').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_cuentas_presupuestos_contabilidad').blur(function(){
				$('.moneda_cuentas_presupuestos_contabilidad').formatCurrency({ roundToDecimalPlace: 2 });
			});

			//Comprobar la existencia del presupuesto en la BD cuando cambie el año
			$('#txtAnio_cuentas_presupuestos_contabilidad').change(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_cuentas_presupuestos_contabilidad();
			});


	        //Autocomplete para recuperar los datos de una cuenta
	        $('#txtCuenta_cuentas_presupuestos_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCuentaID_cuentas_presupuestos_contabilidad').val('');
	               //Hacer un llamado a la función para limpiar los campos del formulario
	               nuevo_cuentas_presupuestos_contabilidad();
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
	             //Asignar id del registro seleccionado
	             $('#txtCuentaID_cuentas_presupuestos_contabilidad').val(ui.item.data);
	             //Hacer un llamado a la función para verificar la existencia del registro
				 verificar_cuentas_presupuestos_contabilidad();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la cuenta (o comprobar la existencia del presupuesto en la BD)
	        //cuando pierda el enfoque la caja de texto
	        $('#txtCuenta_cuentas_presupuestos_contabilidad').focusout(function(e){
	        	//Si no existe id de la cuenta
	            if($('#txtCuentaID_cuentas_presupuestos_contabilidad').val() == '' ||
	               $('#txtCuenta_cuentas_presupuestos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtCuentaID_cuentas_presupuestos_contabilidad').val('');
	               $('#txtCuenta_cuentas_presupuestos_contabilidad').val('');
	               //Hacer un llamado a la función para limpiar los campos del formulario
	               nuevo_cuentas_presupuestos_contabilidad();
	            }
	        });

			//Enfocar caja de texto
			$('#txtCuenta_cuentas_presupuestos_contabilidad').focus(); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_cuentas_presupuestos_contabilidad();
		});
	</script>