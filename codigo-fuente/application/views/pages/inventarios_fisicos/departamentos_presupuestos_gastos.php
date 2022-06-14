	<div id="DepartamentosPresupuestosGastosInventariosFisicosContent" >
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<!--Diseño del formulario-->
			<form id="frmDepartamentosPresupuestosGastosInventariosFisicos" method="post" action="#" 
				  class="form-horizontal"  role="form" name="frmDepartamentosPresupuestosGastosInventariosFisicos"
				  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Autocomplete que contiene los sucursales activos-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">

								<!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal seleccionada-->
								<input id="txtSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos" 
								       name="intSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos" type="hidden" value="">
								</input>
								<label for="txtSucursal_departamentos_presupuestos_gastos_inventarios_fisicos">Sucursal</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtSucursal_departamentos_presupuestos_gastos_inventarios_fisicos" 
										name="strSucursal_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
										tabindex="1" placeholder="Ingrese sucursal" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los departamentos activos-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para indicar la existencia del presupuesto y así poder actualizar los registros-->
								<input id="txtNuevoID_departamentos_presupuestos_gastos_inventarios_fisicos" 
									   name="strNuevoID_departamentos_presupuestos_gastos_inventarios_fisicos"  
									   type="hidden" value="">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del departamento seleccionado-->
								<input id="txtDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos" 
									   name="intDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos"  
									   type="hidden" value="">
								</input>
								<label for="txtDepartamento_departamentos_presupuestos_gastos_inventarios_fisicos">Departamento</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtDepartamento_departamentos_presupuestos_gastos_inventarios_fisicos" 
										name="strDepartamento_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" tabindex="1" placeholder="Ingrese departamento" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Año-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtAnio_departamentos_presupuestos_gastos_inventarios_fisicos">Año</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtAnio_departamentos_presupuestos_gastos_inventarios_fisicos" 
										name="strAnio_departamentos_presupuestos_gastos_inventarios_fisicos" type="number" value=""
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
								<label for="txtImporte01_departamentos_presupuestos_gastos_inventarios_fisicos">Enero</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_departamentos_presupuestos_gastos_inventarios_fisicos" id="txtImporte01_departamentos_presupuestos_gastos_inventarios_fisicos" 
											name="intImporte01_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
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
								<label for="txtImporte02_departamentos_presupuestos_gastos_inventarios_fisicos">Febrero</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_departamentos_presupuestos_gastos_inventarios_fisicos" id="txtImporte02_departamentos_presupuestos_gastos_inventarios_fisicos" 
											name="intImporte02_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
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
								<label for="txtImporte03_departamentos_presupuestos_gastos_inventarios_fisicos">Marzo</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_departamentos_presupuestos_gastos_inventarios_fisicos" id="txtImporte03_departamentos_presupuestos_gastos_inventarios_fisicos" 
											name="intImporte03_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
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
								<label for="txtImporte04_departamentos_presupuestos_gastos_inventarios_fisicos">Abril</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_departamentos_presupuestos_gastos_inventarios_fisicos" id="txtImporte04_departamentos_presupuestos_gastos_inventarios_fisicos" 
											name="intImporte04_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
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
								<label for="txtImporte05_departamentos_presupuestos_gastos_inventarios_fisicos">Mayo</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_departamentos_presupuestos_gastos_inventarios_fisicos" id="txtImporte05_departamentos_presupuestos_gastos_inventarios_fisicos" 
											name="intImporte05_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
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
								<label for="txtImporte06_departamentos_presupuestos_gastos_inventarios_fisicos">Junio</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_departamentos_presupuestos_gastos_inventarios_fisicos" id="txtImporte06_departamentos_presupuestos_gastos_inventarios_fisicos" 
											name="intImporte06_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
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
								<label for="txtImporte07_departamentos_presupuestos_gastos_inventarios_fisicos">Julio</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_departamentos_presupuestos_gastos_inventarios_fisicos" id="txtImporte07_departamentos_presupuestos_gastos_inventarios_fisicos" 
											name="intImporte07_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
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
								<label for="txtImporte08_departamentos_presupuestos_gastos_inventarios_fisicos">Agosto</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_departamentos_presupuestos_gastos_inventarios_fisicos" id="txtImporte08_departamentos_presupuestos_gastos_inventarios_fisicos" 
											name="intImporte08_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
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
								<label for="txtImporte09_departamentos_presupuestos_gastos_inventarios_fisicos">Septiembre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_departamentos_presupuestos_gastos_inventarios_fisicos" id="txtImporte09_departamentos_presupuestos_gastos_inventarios_fisicos" 
											name="intImporte09_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
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
								<label for="txtImporte10_departamentos_presupuestos_gastos_inventarios_fisicos">Octubre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_departamentos_presupuestos_gastos_inventarios_fisicos" id="txtImporte10_departamentos_presupuestos_gastos_inventarios_fisicos" 
											name="intImporte10_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
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
								<label for="txtImporte11_departamentos_presupuestos_gastos_inventarios_fisicos">Noviembre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_departamentos_presupuestos_gastos_inventarios_fisicos" id="txtImporte11_departamentos_presupuestos_gastos_inventarios_fisicos" 
											name="intImporte11_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
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
								<label for="txtImporte12_departamentos_presupuestos_gastos_inventarios_fisicos">Diciembre</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_departamentos_presupuestos_gastos_inventarios_fisicos" id="txtImporte12_departamentos_presupuestos_gastos_inventarios_fisicos" 
											name="intImporte12_departamentos_presupuestos_gastos_inventarios_fisicos" type="text" value="" 
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
						<button class="btn btn-success" id="btnGuardar_departamentos_presupuestos_gastos_inventarios_fisicos"  
								onclick="validar_departamentos_presupuestos_gastos_inventarios_fisicos();" title="Guardar" tabindex="2">
							<span class="fa fa-floppy-o"></span>
						</button> 
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenedor del formulario--> 
	</div><!--#DepartamentosPresupuestosGastosInventariosFisicosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_departamentos_presupuestos_gastos_inventarios_fisicos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('inventarios_fisicos/departamentos_presupuestos_gastos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_departamentos_presupuestos_gastos_inventarios_fisicos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosDepartamentosPresupuestosGastosInventariosFisicos = data.row;
					//Separar la cadena 
					var arrPermisosDepartamentosPresupuestosGastosInventariosFisicos = strPermisosDepartamentosPresupuestosGastosInventariosFisicos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosDepartamentosPresupuestosGastosInventariosFisicos.length; i++)
					{
						//Si el indice es GUARDAR ó EDITAR (modificar)
						if((arrPermisosDepartamentosPresupuestosGastosInventariosFisicos[i]=='GUARDAR') || (arrPermisosDepartamentosPresupuestosGastosInventariosFisicos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_departamentos_presupuestos_gastos_inventarios_fisicos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para limpiar los campos del formulario
		function nuevo_departamentos_presupuestos_gastos_inventarios_fisicos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_departamentos_presupuestos_gastos_inventarios_fisicos(); 
			//Limpiar cajas de texto
			$('#txtNuevoID_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			$('#txtImporte01_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			$('#txtImporte02_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			$('#txtImporte03_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			$('#txtImporte04_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			$('#txtImporte05_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			$('#txtImporte06_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			$('#txtImporte07_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			$('#txtImporte08_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			$('#txtImporte09_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			$('#txtImporte10_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			$('#txtImporte11_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			$('#txtImporte12_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
			
		}
	
		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_departamentos_presupuestos_gastos_inventarios_fisicos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_departamentos_presupuestos_gastos_inventarios_fisicos();
			//Validación del formulario de campos obligatorios
			$('#frmDepartamentosPresupuestosGastosInventariosFisicos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strAnio_departamentos_presupuestos_gastos_inventarios_fisicos: {
											validators: {
												notEmpty: {message: 'Escriba un año'},
												stringLength: {
													min: 4,
													message: 'El año debe tener 4 caracteres de longitud'
												}
											}
										},
										strDepartamento_departamentos_presupuestos_gastos_inventarios_fisicos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del departamento
					                                    if($('#txtDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un departamento existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strSucursal_departamentos_presupuestos_gastos_inventarios_fisicos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del departamento
					                                    if($('#txtSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un sucursal existente'
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
			var bootstrapValidator_departamentos_presupuestos_gastos_inventarios_fisicos = $('#frmDepartamentosPresupuestosGastosInventariosFisicos').data('bootstrapValidator');
			bootstrapValidator_departamentos_presupuestos_gastos_inventarios_fisicos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_departamentos_presupuestos_gastos_inventarios_fisicos.isValid())
			{
				//Verificar que exista al menos un importe
				if($('#txtImporte01_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' && 
				   $('#txtImporte02_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' &&
				   $('#txtImporte03_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' &&
				   $('#txtImporte04_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' &&
				   $('#txtImporte05_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' &&
				   $('#txtImporte06_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' &&
				   $('#txtImporte07_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' &&
				   $('#txtImporte08_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' &&
				   $('#txtImporte09_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' &&
				   $('#txtImporte10_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' &&
				   $('#txtImporte11_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' &&
				   $('#txtImporte12_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '')
				{
					//Indicar al usuario que debe ingresar al menos un importe
					new $.Zebra_Dialog('Escriba al menos un importe para este presupuesto.', {
										'type': 'error',
										'title': 'Error',
										'buttons': [{caption: 'Aceptar',
													 callback: function () {
													 	//Hacer un llamado a la función para limpiar los mensajes de error 
														limpiar_mensajes_departamentos_presupuestos_gastos_inventarios_fisicos();
														//Enfocar caja de texto
														$('#txtImporte01_departamentos_presupuestos_gastos_inventarios_fisicos').focus();
													 }
													}]
									});
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_departamentos_presupuestos_gastos_inventarios_fisicos();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_departamentos_presupuestos_gastos_inventarios_fisicos()
		{
			try
			{
				$('#frmDepartamentosPresupuestosGastosInventariosFisicos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un presupuesto
		function guardar_departamentos_presupuestos_gastos_inventarios_fisicos()
		{
			//Hacer un llamado al método del controlador para guardar los datos del presupuesto
			$.post('inventarios_fisicos/departamentos_presupuestos_gastos/guardar',
					{ 
						strNuevoID: $('#txtNuevoID_departamentos_presupuestos_gastos_inventarios_fisicos').val(),
						intSucursalID: $('#txtSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos').val(),
						intDepartamentoID: $('#txtDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos').val(),
						strAnio: $('#txtAnio_departamentos_presupuestos_gastos_inventarios_fisicos').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intImporte01: $.reemplazar($('#txtImporte01_departamentos_presupuestos_gastos_inventarios_fisicos').val(), ",", ""),
						intImporte02: $.reemplazar($('#txtImporte02_departamentos_presupuestos_gastos_inventarios_fisicos').val(), ",", ""),
						intImporte03: $.reemplazar($('#txtImporte03_departamentos_presupuestos_gastos_inventarios_fisicos').val(), ",", ""),
						intImporte04: $.reemplazar($('#txtImporte04_departamentos_presupuestos_gastos_inventarios_fisicos').val(), ",", ""),
						intImporte05: $.reemplazar($('#txtImporte05_departamentos_presupuestos_gastos_inventarios_fisicos').val(), ",", ""),
						intImporte06: $.reemplazar($('#txtImporte06_departamentos_presupuestos_gastos_inventarios_fisicos').val(), ",", ""),
						intImporte07: $.reemplazar($('#txtImporte07_departamentos_presupuestos_gastos_inventarios_fisicos').val(), ",", ""),
						intImporte08: $.reemplazar($('#txtImporte08_departamentos_presupuestos_gastos_inventarios_fisicos').val(), ",", ""),
						intImporte09: $.reemplazar($('#txtImporte09_departamentos_presupuestos_gastos_inventarios_fisicos').val(), ",", ""),
						intImporte10: $.reemplazar($('#txtImporte10_departamentos_presupuestos_gastos_inventarios_fisicos').val(), ",", ""),
						intImporte11: $.reemplazar($('#txtImporte11_departamentos_presupuestos_gastos_inventarios_fisicos').val(), ",", ""),
						intImporte12: $.reemplazar($('#txtImporte12_departamentos_presupuestos_gastos_inventarios_fisicos').val(), ",", "")
					},
					function(data) {
						if (data.resultado)
						{
						
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_departamentos_presupuestos_gastos_inventarios_fisicos();
							$('#txtSucursal_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
							$('#txtSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
							$('#txtDepartamento_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
							$('#txtDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
							//Enfocar caja de texto
							$('#txtSucursal_departamentos_presupuestos_gastos_inventarios_fisicos').focus();                 
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_departamentos_presupuestos_gastos_inventarios_fisicos(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_departamentos_presupuestos_gastos_inventarios_fisicos(tipoMensaje, mensaje)
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
		function editar_departamentos_presupuestos_gastos_inventarios_fisicos()
		{	
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_departamentos_presupuestos_gastos_inventarios_fisicos();
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('inventarios_fisicos/departamentos_presupuestos_gastos/get_datos',
			       {
			       	intScurasalID: $('#txtSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos').val(),
			       	intDepartamentoID: $('#txtDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos').val(),
					strAnio: $('#txtAnio_departamentos_presupuestos_gastos_inventarios_fisicos').val()
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				          	$('#txtNuevoID_departamentos_presupuestos_gastos_inventarios_fisicos').val('existe');
				            $('#txtImporte01_departamentos_presupuestos_gastos_inventarios_fisicos').val(data.row.importe01);
				            $('#txtImporte02_departamentos_presupuestos_gastos_inventarios_fisicos').val(data.row.importe02);
				            $('#txtImporte03_departamentos_presupuestos_gastos_inventarios_fisicos').val(data.row.importe03);
				            $('#txtImporte04_departamentos_presupuestos_gastos_inventarios_fisicos').val(data.row.importe04);
				            $('#txtImporte05_departamentos_presupuestos_gastos_inventarios_fisicos').val(data.row.importe05);
				            $('#txtImporte06_departamentos_presupuestos_gastos_inventarios_fisicos').val(data.row.importe06);
				            $('#txtImporte07_departamentos_presupuestos_gastos_inventarios_fisicos').val(data.row.importe07);
				            $('#txtImporte08_departamentos_presupuestos_gastos_inventarios_fisicos').val(data.row.importe08);
				            $('#txtImporte09_departamentos_presupuestos_gastos_inventarios_fisicos').val(data.row.importe09);
				            $('#txtImporte10_departamentos_presupuestos_gastos_inventarios_fisicos').val(data.row.importe10);
				            $('#txtImporte11_departamentos_presupuestos_gastos_inventarios_fisicos').val(data.row.importe11);
				            $('#txtImporte12_departamentos_presupuestos_gastos_inventarios_fisicos').val(data.row.importe12);
			       	    }
			       },
			       'json');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Asignar el año actual
       		$('#txtAnio_departamentos_presupuestos_gastos_inventarios_fisicos').val(anioActual()); 
       		//Validar campos númericos (solamente valores enteros y positivos)
       		$('#txtAnio_departamentos_presupuestos_gastos_inventarios_fisicos').numeric({decimal: false, negative: false});
       		//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtImporte01_departamentos_presupuestos_gastos_inventarios_fisicos').numeric();
        	$('#txtImporte02_departamentos_presupuestos_gastos_inventarios_fisicos').numeric();
        	$('#txtImporte03_departamentos_presupuestos_gastos_inventarios_fisicos').numeric();
        	$('#txtImporte04_departamentos_presupuestos_gastos_inventarios_fisicos').numeric();
        	$('#txtImporte05_departamentos_presupuestos_gastos_inventarios_fisicos').numeric();
        	$('#txtImporte06_departamentos_presupuestos_gastos_inventarios_fisicos').numeric();
        	$('#txtImporte07_departamentos_presupuestos_gastos_inventarios_fisicos').numeric();
        	$('#txtImporte08_departamentos_presupuestos_gastos_inventarios_fisicos').numeric();
        	$('#txtImporte09_departamentos_presupuestos_gastos_inventarios_fisicos').numeric();
        	$('#txtImporte10_departamentos_presupuestos_gastos_inventarios_fisicos').numeric();
        	$('#txtImporte11_departamentos_presupuestos_gastos_inventarios_fisicos').numeric();
        	$('#txtImporte12_departamentos_presupuestos_gastos_inventarios_fisicos').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_departamentos_presupuestos_gastos_inventarios_fisicos').blur(function(){
				$('.moneda_departamentos_presupuestos_gastos_inventarios_fisicos').formatCurrency({ roundToDecimalPlace: 6 });
			});

			//Comprobar la existencia del presupuesto en la BD cuando cambie el año
			$('#txtAnio_departamentos_presupuestos_gastos_inventarios_fisicos').change(function(e){
				//Verificar la existencia del presupuesto
				if ($('#txtSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos').val() != '' && $('#txtDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos').val() != '' &&
					$('#txtAnio_departamentos_presupuestos_gastos_inventarios_fisicos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del presupuesto que coincide con los id´s 
					editar_departamentos_presupuestos_gastos_inventarios_fisicos();
				}
			});


			//Comprobar la existencia del presupuesto en la BD cuando pierda el enfoque la caja de texto
			$('#txtSucursal_departamentos_presupuestos_gastos_inventarios_fisicos').focusout(function(e){
				//Verificar la existencia del presupuesto
				if ($('#txtSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos').val() != '' && $('#txtDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos').val() != '' &&
					$('#txtAnio_departamentos_presupuestos_gastos_inventarios_fisicos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del presupuesto que coincide con los id´s 
					editar_departamentos_presupuestos_gastos_inventarios_fisicos();
				}
			});

			//Comprobar la existencia del presupuesto en la BD cuando pierda el enfoque la caja de texto
			$('#txtDepartamento_departamentos_presupuestos_gastos_inventarios_fisicos').focusout(function(e){
				//Verificar la existencia del presupuesto
				if ($('#txtSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos').val() != '' &&  $('#txtDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos').val() != '' &&
					$('#txtAnio_departamentos_presupuestos_gastos_inventarios_fisicos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del presupuesto que coincide con los id´s 
					editar_departamentos_presupuestos_gastos_inventarios_fisicos();
				}
			});
			//Autocomplete para recuperar los datos de una sucursal
	        $('#txtSucursal_departamentos_presupuestos_gastos_inventarios_fisicos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "administracion/sucursales/autocomplete",
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
	             $('#txtSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la sucursal cuando pierda el enfoque la caja de texto
	        $('#txtSucursal_departamentos_presupuestos_gastos_inventarios_fisicos').focusout(function(e){
	            //Si no existe id de la sucursal
	            if($('#txtSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' ||
	               $('#txtSucursal_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSucursalID_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
	               $('#txtSucursal_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un departamento
	        $('#txtDepartamento_departamentos_presupuestos_gastos_inventarios_fisicos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
	               //Hacer un llamado a la función para limpiar los campos del formulario
	               nuevo_departamentos_presupuestos_gastos_inventarios_fisicos();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/departamentos/autocomplete",
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
	             $('#txtDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id del departamento cuando pierda el enfoque la caja de texto
	        $('#txtDepartamento_departamentos_presupuestos_gastos_inventarios_fisicos').focusout(function(e){
	        	//Si no existe id del departamento
	            if($('#txtDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '' ||
	               $('#txtDepartamento_departamentos_presupuestos_gastos_inventarios_fisicos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtDepartamentoID_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
	               $('#txtDepartamento_departamentos_presupuestos_gastos_inventarios_fisicos').val('');
	            }
	            
	        });

			//Enfocar caja de texto
			$('#txtSucursal_departamentos_presupuestos_gastos_inventarios_fisicos').focus();

			//Deshabilitar el siguiente botón (funciones de permisos de acceso)
			$('#btnGuardar_departamentos_presupuestos_gastos_inventarios_fisicos').attr('disabled','-1');   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_departamentos_presupuestos_gastos_inventarios_fisicos();
		});
	</script>