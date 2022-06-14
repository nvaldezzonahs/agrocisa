	<div id="ServicioPresupuestosVentasServicioContent" >
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<!--Diseño del formulario-->
			<form id="frmServicioPresupuestosVentasServicio" method="post" action="#" 
				  class="form-horizontal"  role="form" name="frmServicioPresupuestosVentasServicio"
				  onsubmit="return(false)" autocomplete="off">
			    <div class="row">
			    	<!--Tipo-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para indicar la existencia del presupuesto y así poder actualizar los registros-->
								<input id="txtNuevoID_servicio_presupuestos_ventas_servicio" 
									   name="strNuevoID_servicio_presupuestos_ventas_servicio"  
									   type="hidden" value="">
								<label for="cmbTipo_servicio_presupuestos_ventas_servicio">Tipo</label>
							</div>
							<div id="divCmbMsjValidacion" class="col-md-12">
								<select class="form-control" id="cmbTipo_servicio_presupuestos_ventas_servicio" 
								 		name="strTipo_servicio_presupuestos_ventas_servicio" tabindex="1">
								 	<option value="">Seleccione una opción</option>
                      				<option value="Refacciones">REFACCIONES</option>
                      				<option value="Trabajos Foraneos">TRABAJOS FORÁNEOS</option>
                      				<option value="Kilometraje">KILOMETRAJE</option>
                      				<option value="Otros">OTROS</option>
                 				</select>
							</div>
						</div>
					</div>
					<!--Año-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtAnio_servicio_presupuestos_ventas_servicio">Año</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtAnio_servicio_presupuestos_ventas_servicio" 
										name="strAnio_servicio_presupuestos_ventas_servicio" type="number" value=""
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
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtImporte01_servicio_presupuestos_ventas_servicio">Enero</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_servicio_presupuestos_ventas_servicio" id="txtImporte01_servicio_presupuestos_ventas_servicio" 
											name="intImporte01_servicio_presupuestos_ventas_servicio" type="text" value="" 
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
								<label for="txtImporte02_servicio_presupuestos_ventas_servicio">Febrero</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_servicio_presupuestos_ventas_servicio" id="txtImporte02_servicio_presupuestos_ventas_servicio" 
											name="intImporte02_servicio_presupuestos_ventas_servicio" type="text" value="" 
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
								<label for="txtImporte03_servicio_presupuestos_ventas_servicio">Marzo</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_servicio_presupuestos_ventas_servicio" id="txtImporte03_servicio_presupuestos_ventas_servicio" 
											name="intImporte03_servicio_presupuestos_ventas_servicio" type="text" value="" 
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
								<label for="txtImporte04_servicio_presupuestos_ventas_servicio">Abril</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_servicio_presupuestos_ventas_servicio" id="txtImporte04_servicio_presupuestos_ventas_servicio" 
											name="intImporte04_servicio_presupuestos_ventas_servicio" type="text" value="" 
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
								<label for="txtImporte05_servicio_presupuestos_ventas_servicio">Mayo</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_servicio_presupuestos_ventas_servicio" id="txtImporte05_servicio_presupuestos_ventas_servicio" 
											name="intImporte05_servicio_presupuestos_ventas_servicio" type="text" value="" 
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
								<label for="txtImporte06_servicio_presupuestos_ventas_servicio">Junio</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_servicio_presupuestos_ventas_servicio" id="txtImporte06_servicio_presupuestos_ventas_servicio" 
											name="intImporte06_servicio_presupuestos_ventas_servicio" type="text" value="" 
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
								<label for="txtImporte07_servicio_presupuestos_ventas_servicio">Julio</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_servicio_presupuestos_ventas_servicio" id="txtImporte07_servicio_presupuestos_ventas_servicio" 
											name="intImporte07_servicio_presupuestos_ventas_servicio" type="text" value="" 
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
								<label for="txtImporte08_servicio_presupuestos_ventas_servicio">Agosto</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_servicio_presupuestos_ventas_servicio" id="txtImporte08_servicio_presupuestos_ventas_servicio" 
											name="intImporte08_servicio_presupuestos_ventas_servicio" type="text" value="" 
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
								<label for="txtImporte09_servicio_presupuestos_ventas_servicio">Septiembre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_servicio_presupuestos_ventas_servicio" id="txtImporte09_servicio_presupuestos_ventas_servicio" 
											name="intImporte09_servicio_presupuestos_ventas_servicio" type="text" value="" 
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
								<label for="txtImporte10_servicio_presupuestos_ventas_servicio">Octubre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_servicio_presupuestos_ventas_servicio" id="txtImporte10_servicio_presupuestos_ventas_servicio" 
											name="intImporte10_servicio_presupuestos_ventas_servicio" type="text" value="" 
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
								<label for="txtImporte11_servicio_presupuestos_ventas_servicio">Noviembre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_servicio_presupuestos_ventas_servicio" id="txtImporte11_servicio_presupuestos_ventas_servicio" 
											name="intImporte11_servicio_presupuestos_ventas_servicio" type="text" value="" 
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
								<label for="txtImporte12_servicio_presupuestos_ventas_servicio">Diciembre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_servicio_presupuestos_ventas_servicio" id="txtImporte12_servicio_presupuestos_ventas_servicio" 
											name="intImporte12_servicio_presupuestos_ventas_servicio" type="text" value="" 
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
						<button class="btn btn-success" id="btnGuardar_servicio_presupuestos_ventas_servicio"  
								onclick="validar_servicio_presupuestos_ventas_servicio();" title="Guardar" tabindex="2">
							<span class="fa fa-floppy-o"></span>
						</button> 
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenedor del formulario--> 
	</div><!--#ServicioPresupuestosVentasServicioContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_servicio_presupuestos_ventas_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/servicio_presupuestos_ventas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_servicio_presupuestos_ventas_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosServicioPresupuestosVentasServicio = data.row;
					//Separar la cadena 
					var arrPermisosServicioPresupuestosVentasServicio = strPermisosServicioPresupuestosVentasServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosServicioPresupuestosVentasServicio.length; i++)
					{
						//Si el indice es GUARDAR ó EDITAR (modificar)
						if((arrPermisosServicioPresupuestosVentasServicio[i]=='GUARDAR') || (arrPermisosServicioPresupuestosVentasServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_servicio_presupuestos_ventas_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para limpiar los campos del formulario
		function nuevo_servicio_presupuestos_ventas_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicio_presupuestos_ventas_servicio();
			//Limpiar cajas de texto
			$('#txtNuevoID_servicio_presupuestos_ventas_servicio').val('');
			$('#txtImporte01_servicio_presupuestos_ventas_servicio').val('');
			$('#txtImporte02_servicio_presupuestos_ventas_servicio').val('');
			$('#txtImporte03_servicio_presupuestos_ventas_servicio').val('');
			$('#txtImporte04_servicio_presupuestos_ventas_servicio').val('');
			$('#txtImporte05_servicio_presupuestos_ventas_servicio').val('');
			$('#txtImporte06_servicio_presupuestos_ventas_servicio').val('');
			$('#txtImporte07_servicio_presupuestos_ventas_servicio').val('');
			$('#txtImporte08_servicio_presupuestos_ventas_servicio').val('');
			$('#txtImporte09_servicio_presupuestos_ventas_servicio').val('');
			$('#txtImporte10_servicio_presupuestos_ventas_servicio').val('');
			$('#txtImporte11_servicio_presupuestos_ventas_servicio').val('');
			$('#txtImporte12_servicio_presupuestos_ventas_servicio').val('');
		}
	
		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_servicio_presupuestos_ventas_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicio_presupuestos_ventas_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmServicioPresupuestosVentasServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strAnio_servicio_presupuestos_ventas_servicio: {
											validators: {
												notEmpty: {message: 'Escriba un año'},
												stringLength: {
													min: 4,
													message: 'El año debe tener 4 caracteres de longitud'
												}
											}
										},
										strTipo_servicio_presupuestos_ventas_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_servicio_presupuestos_ventas_servicio = $('#frmServicioPresupuestosVentasServicio').data('bootstrapValidator');
			bootstrapValidator_servicio_presupuestos_ventas_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_servicio_presupuestos_ventas_servicio.isValid())
			{
				//Verificar que exista al menos un importe
				if($('#txtImporte01_servicio_presupuestos_ventas_servicio').val() == '' && 
				   $('#txtImporte02_servicio_presupuestos_ventas_servicio').val() == '' &&
				   $('#txtImporte03_servicio_presupuestos_ventas_servicio').val() == '' &&
				   $('#txtImporte04_servicio_presupuestos_ventas_servicio').val() == '' &&
				   $('#txtImporte05_servicio_presupuestos_ventas_servicio').val() == '' &&
				   $('#txtImporte06_servicio_presupuestos_ventas_servicio').val() == '' &&
				   $('#txtImporte07_servicio_presupuestos_ventas_servicio').val() == '' &&
				   $('#txtImporte08_servicio_presupuestos_ventas_servicio').val() == '' &&
				   $('#txtImporte09_servicio_presupuestos_ventas_servicio').val() == '' &&
				   $('#txtImporte10_servicio_presupuestos_ventas_servicio').val() == '' &&
				   $('#txtImporte11_servicio_presupuestos_ventas_servicio').val() == '' &&
				   $('#txtImporte12_servicio_presupuestos_ventas_servicio').val() == '')
				{
					//Indicar al usuario que debe ingresar al menos una importe
					new $.Zebra_Dialog('Escriba al menos un importe para este presupuesto.', {
							'type': 'error',
							'title': 'Error',
							'buttons': [{caption: 'Aceptar',
										 callback: function () {
										 	//Hacer un llamado a la función para limpiar los mensajes de error 
											limpiar_mensajes_servicio_presupuestos_ventas_servicio();
											//Enfocar caja de texto
											$('#txtImporte01_servicio_presupuestos_ventas_servicio').focus();
										 }
										}]
						});
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_servicio_presupuestos_ventas_servicio();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_servicio_presupuestos_ventas_servicio()
		{
			try
			{
				$('#frmServicioPresupuestosVentasServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un presupuesto
		function guardar_servicio_presupuestos_ventas_servicio()
		{
			//Hacer un llamado al método del controlador para guardar los datos del presupuesto
			$.post('servicio/servicio_presupuestos_ventas/guardar',
					{ 
						strNuevoID: $('#txtNuevoID_servicio_presupuestos_ventas_servicio').val(),
						strTipo: $('#cmbTipo_servicio_presupuestos_ventas_servicio').val(),
						strAnio: $('#txtAnio_servicio_presupuestos_ventas_servicio').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intImporte01: $.reemplazar($('#txtImporte01_servicio_presupuestos_ventas_servicio').val(), ",", ""),
						intImporte02: $.reemplazar($('#txtImporte02_servicio_presupuestos_ventas_servicio').val(), ",", ""),
						intImporte03: $.reemplazar($('#txtImporte03_servicio_presupuestos_ventas_servicio').val(), ",", ""),
						intImporte04: $.reemplazar($('#txtImporte04_servicio_presupuestos_ventas_servicio').val(), ",", ""),
						intImporte05: $.reemplazar($('#txtImporte05_servicio_presupuestos_ventas_servicio').val(), ",", ""),
						intImporte06: $.reemplazar($('#txtImporte06_servicio_presupuestos_ventas_servicio').val(), ",", ""),
						intImporte07: $.reemplazar($('#txtImporte07_servicio_presupuestos_ventas_servicio').val(), ",", ""),
						intImporte08: $.reemplazar($('#txtImporte08_servicio_presupuestos_ventas_servicio').val(), ",", ""),
						intImporte09: $.reemplazar($('#txtImporte09_servicio_presupuestos_ventas_servicio').val(), ",", ""),
						intImporte10: $.reemplazar($('#txtImporte10_servicio_presupuestos_ventas_servicio').val(), ",", ""),
						intImporte11: $.reemplazar($('#txtImporte11_servicio_presupuestos_ventas_servicio').val(), ",", ""),
						intImporte12: $.reemplazar($('#txtImporte12_servicio_presupuestos_ventas_servicio').val(), ",", "")
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_servicio_presupuestos_ventas_servicio();  
							//Limpiar combobox
							$('#cmbTipo_servicio_presupuestos_ventas_servicio').val('');
							//Enfocar combobox
							$('#cmbTipo_servicio_presupuestos_ventas_servicio').focus();                
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_servicio_presupuestos_ventas_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_servicio_presupuestos_ventas_servicio(tipoMensaje, mensaje)
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
		function editar_servicio_presupuestos_ventas_servicio()
		{	
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_servicio_presupuestos_ventas_servicio();
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/servicio_presupuestos_ventas/get_datos',
			       {strTipo: $('#cmbTipo_servicio_presupuestos_ventas_servicio').val(),
					strAnio: $('#txtAnio_servicio_presupuestos_ventas_servicio').val()
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				          	$('#txtNuevoID_servicio_presupuestos_ventas_servicio').val('existe');
				            $('#txtImporte01_servicio_presupuestos_ventas_servicio').val(data.row.importe01);
				            $('#txtImporte02_servicio_presupuestos_ventas_servicio').val(data.row.importe02);
				            $('#txtImporte03_servicio_presupuestos_ventas_servicio').val(data.row.importe03);
				            $('#txtImporte04_servicio_presupuestos_ventas_servicio').val(data.row.importe04);
				            $('#txtImporte05_servicio_presupuestos_ventas_servicio').val(data.row.importe05);
				            $('#txtImporte06_servicio_presupuestos_ventas_servicio').val(data.row.importe06);
				            $('#txtImporte07_servicio_presupuestos_ventas_servicio').val(data.row.importe07);
				            $('#txtImporte08_servicio_presupuestos_ventas_servicio').val(data.row.importe08);
				            $('#txtImporte09_servicio_presupuestos_ventas_servicio').val(data.row.importe09);
				            $('#txtImporte10_servicio_presupuestos_ventas_servicio').val(data.row.importe10);
				            $('#txtImporte11_servicio_presupuestos_ventas_servicio').val(data.row.importe11);
				            $('#txtImporte12_servicio_presupuestos_ventas_servicio').val(data.row.importe12);
			       	    }
			       },
			       'json');
		}


		//Función para verificar la existencia de un registro
		function verificar_servicio_presupuestos_ventas_servicio()
		{
			//Verificar la existencia del presupuesto
			if ($('#cmbTipo_servicio_presupuestos_ventas_servicio').val() != '' &&
				$('#txtAnio_servicio_presupuestos_ventas_servicio').val() != '')
			{
				//Hacer un llamado a la función para recuperar los datos del presupuesto que coincide con los id´s 
				editar_servicio_presupuestos_ventas_servicio();
			}
			else
			{
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_servicio_presupuestos_ventas_servicio();  
			}
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Asignar el año actual
       		$('#txtAnio_servicio_presupuestos_ventas_servicio').val(anioActual()); 
       		//Validar campos númericos (solamente valores enteros y positivos)
       		$('#txtAnio_servicio_presupuestos_ventas_servicio').numeric({decimal: false, negative: false});
       		//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtImporte01_servicio_presupuestos_ventas_servicio').numeric();
        	$('#txtImporte02_servicio_presupuestos_ventas_servicio').numeric();
        	$('#txtImporte03_servicio_presupuestos_ventas_servicio').numeric();
        	$('#txtImporte04_servicio_presupuestos_ventas_servicio').numeric();
        	$('#txtImporte05_servicio_presupuestos_ventas_servicio').numeric();
        	$('#txtImporte06_servicio_presupuestos_ventas_servicio').numeric();
        	$('#txtImporte07_servicio_presupuestos_ventas_servicio').numeric();
        	$('#txtImporte08_servicio_presupuestos_ventas_servicio').numeric();
        	$('#txtImporte09_servicio_presupuestos_ventas_servicio').numeric();
        	$('#txtImporte10_servicio_presupuestos_ventas_servicio').numeric();
        	$('#txtImporte11_servicio_presupuestos_ventas_servicio').numeric();
        	$('#txtImporte12_servicio_presupuestos_ventas_servicio').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_servicio_presupuestos_ventas_servicio').blur(function(){
				$('.moneda_servicio_presupuestos_ventas_servicio').formatCurrency({ roundToDecimalPlace: 2 });
			});

			//Comprobar la existencia del presupuesto en la BD cuando cambie el año
			$('#txtAnio_servicio_presupuestos_ventas_servicio').change(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_servicio_presupuestos_ventas_servicio();
			});

			//Comprobar la existencia del presupuesto en la BD cuando cambie el tipo
			$('#cmbTipo_servicio_presupuestos_ventas_servicio').change(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_servicio_presupuestos_ventas_servicio();
			});
			
	       
			//Enfocar combobox
			$('#cmbTipo_servicio_presupuestos_ventas_servicio').focus();

			//Deshabilitar el siguiente botón (funciones de permisos de acceso)
			$('#btnGuardar_servicio_presupuestos_ventas_servicio').attr('disabled','-1');   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_servicio_presupuestos_ventas_servicio();
		});
	</script>