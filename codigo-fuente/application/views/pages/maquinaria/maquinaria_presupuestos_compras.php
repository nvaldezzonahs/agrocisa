	<div id="MaquinariaPresupuestosComprasMaquinariaContent" >
		<!--Panel que contiene formulario-->
		<div class="panel-modal-sin-barra">
			<!--Diseño del formulario-->
			<form id="frmMaquinariaPresupuestosComprasMaquinaria" method="post" action="#" 
				  class="form-horizontal"  role="form" name="frmMaquinariaPresupuestosComprasMaquinaria"
				  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Autocomplete que contiene las descripciones de maquinaria activas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para indicar la existencia del presupuesto y así poder actualizar los registros-->
								<input id="txtNuevoID_maquinaria_presupuestos_compras_maquinaria" 
									   name="strNuevoID_maquinaria_presupuestos_compras_maquinaria"  
									   type="hidden" value="">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la descripción de maquinaria seleccionada-->
								<input id="txtMaquinariaDescripcionID_maquinaria_presupuestos_compras_maquinaria" 
									   name="intMaquinariaDescripcionID_maquinaria_presupuestos_compras_maquinaria"  
									   type="hidden" value="">
								</input>
								<label for="txtMaquinariaDescripcion_maquinaria_presupuestos_compras_maquinaria">Descripción corta</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMaquinariaDescripcion_maquinaria_presupuestos_compras_maquinaria" 
										name="strMaquinariaDescripcion_maquinaria_presupuestos_compras_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Año-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtAnio_maquinaria_presupuestos_compras_maquinaria">Año</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtAnio_maquinaria_presupuestos_compras_maquinaria" 
										name="strAnio_maquinaria_presupuestos_compras_maquinaria" type="number" value=""
										tabindex="1" placeholder="Ingrese año" maxlength="4">
								</input>
							</div>
						</div>
					</div>
			    </div>
			      <div class="row">
			    	<!--Ventas por mes-->
                    <h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Compras por mes</h4>
                    <!--Enero-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Enero</span>
						    <!--Importe-->
						    <input  id="txtImporte01_maquinaria_presupuestos_compras_maquinaria"
						    		name="intImporte01_maquinaria_presupuestos_compras_maquinaria" 
						    		class="form-control moneda_maquinaria_presupuestos_compras_maquinaria"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="15" />
						    <!--Cantidad-->
						    <input  id="txtCantidad01_maquinaria_presupuestos_compras_maquinaria"
						    		name="intCantidad01_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control"  
									type="text" value="" tabindex="1" placeholder="Cantidad" maxlength="3" />
						</div>
					</div>
					<!--Febrero-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Febrero</span>
						    <!--Importe-->
						    <input  id="txtImporte02_maquinaria_presupuestos_compras_maquinaria"
						    		name="intImporte02_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control moneda_maquinaria_presupuestos_compras_maquinaria"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="15" />
						    <!--Cantidad-->
						    <input  id="txtCantidad02_maquinaria_presupuestos_compras_maquinaria"
						    		name="intCantidad02_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control"  
									type="text" value="" tabindex="1" placeholder="Cantidad" maxlength="3" />
						</div>
					</div>
					<!--Marzo-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Marzo</span>
						     <!--Importe-->
						    <input  id="txtImporte03_maquinaria_presupuestos_compras_maquinaria"
						    		name="intImporte03_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control moneda_maquinaria_presupuestos_compras_maquinaria"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="15" />
						     <!--Cantidad-->
						    <input  id="txtCantidad03_maquinaria_presupuestos_compras_maquinaria"
						    		name="intCantidad03_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control"  
									type="text" value="" tabindex="1" placeholder="Cantidad" maxlength="3" />
						</div>
					</div>
					<!--Abril-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Abril</span>
						    <!--Importe-->
						    <input  id="txtImporte04_maquinaria_presupuestos_compras_maquinaria"
						    		name="intImporte04_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control moneda_maquinaria_presupuestos_compras_maquinaria"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="15" />
						    <!--Cantidad-->
						    <input  id="txtCantidad04_maquinaria_presupuestos_compras_maquinaria"
						    		name="intCantidad04_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control"  
									type="text" value="" tabindex="1" placeholder="Cantidad" maxlength="3" />
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
						    <input  id="txtImporte05_maquinaria_presupuestos_compras_maquinaria"
						    		name="intImporte05_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control moneda_maquinaria_presupuestos_compras_maquinaria"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="15" />
						     <!--Cantidad-->
						    <input  id="txtCantidad05_maquinaria_presupuestos_compras_maquinaria"
						    		name="intCantidad05_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control"  
									type="text" value="" tabindex="1" placeholder="Cantidad" maxlength="3" />
						</div>
					</div>
					<!--Junio-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Junio</span>
						    <!--Importe-->
						    <input  id="txtImporte06_maquinaria_presupuestos_compras_maquinaria"
						    		name="intImporte06_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control moneda_maquinaria_presupuestos_compras_maquinaria"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="15" />
						    <!--Cantidad-->
						    <input  id="txtCantidad06_maquinaria_presupuestos_compras_maquinaria"
						    		name="intCantidad06_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control"  
									type="text" value="" tabindex="1" placeholder="Cantidad" maxlength="3" />
						</div>
					</div>
					<!--Julio-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Julio</span>
						   <!--Importe-->
						    <input  id="txtImporte07_maquinaria_presupuestos_compras_maquinaria"
						    		name="intImporte07_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control moneda_maquinaria_presupuestos_compras_maquinaria"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="15" />
						    <!--Cantidad-->
						    <input  id="txtCantidad07_maquinaria_presupuestos_compras_maquinaria"
						    		name="intCantidad07_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control"  
									type="text" value="" tabindex="1" placeholder="Cantidad" maxlength="3" />
						</div>
					</div>
					<!--Agosto-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Agosto</span>
						    <!--Importe-->
						    <input  id="txtImporte08_maquinaria_presupuestos_compras_maquinaria"
						    		name="intImporte08_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control moneda_maquinaria_presupuestos_compras_maquinaria"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="15" />
						    <!--Cantidad-->
						    <input  id="txtCantidad08_maquinaria_presupuestos_compras_maquinaria"
						    		name="intCantidad08_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control"  
									type="text" value="" tabindex="1" placeholder="Cantidad" maxlength="3" />
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
						    <input  id="txtImporte09_maquinaria_presupuestos_compras_maquinaria"
						    		name="intImporte09_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control moneda_maquinaria_presupuestos_compras_maquinaria"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="15" />
						    <!--Cantidad-->
						    <input  id="txtCantidad09_maquinaria_presupuestos_compras_maquinaria"
						    		name="intCantidad09_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control"  
									type="text" value="" tabindex="1" placeholder="Cantidad" maxlength="3" />
						</div>
					</div>
					<!--Octubre-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Octubre</span>
						    <!--Importe-->
						    <input  id="txtImporte10_maquinaria_presupuestos_compras_maquinaria"
						    		name="intImporte10_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control moneda_maquinaria_presupuestos_compras_maquinaria"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="15" />
						    <!--Cantidad-->
						    <input  id="txtCantidad10_maquinaria_presupuestos_compras_maquinaria"
						    		name="intCantidad10_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control"  
									type="text" value="" tabindex="1" placeholder="Cantidad" maxlength="3" />
						</div>
					</div>
					<!--Noviembre-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Noviembre</span>
						    <!--Importe-->
						    <input  id="txtImporte11_maquinaria_presupuestos_compras_maquinaria"
						    		name="intImporte11_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control moneda_maquinaria_presupuestos_compras_maquinaria"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="15" />
						    <!--Cantidad-->
						    <input  id="txtCantidad11_maquinaria_presupuestos_compras_maquinaria"
						    		name="intCantidad11_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control"  
									type="text" value="" tabindex="1" placeholder="Cantidad" maxlength="3" />
						</div>
					</div>
					<!--Diciembre-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                    	<div class="input-group">
						    <span class="input-group-addon ventas_mes_importe">Diciembre</span>
						    <!--Importe-->
						    <input  id="txtImporte12_maquinaria_presupuestos_compras_maquinaria"
						    		name="intImporte12_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control moneda_maquinaria_presupuestos_compras_maquinaria"  
									type="text" value="" tabindex="1" placeholder="Importe" maxlength="15" />
						    <!--Cantidad-->
						    <input  id="txtCantidad12_maquinaria_presupuestos_compras_maquinaria"
						    		name="intCantidad12_maquinaria_presupuestos_compras_maquinaria"
						    		class="form-control"  
									type="text" value="" tabindex="1" placeholder="Cantidad" maxlength="3" />
						</div>
					</div>
			   	</div>
			   	<br>
			    <!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_maquinaria_presupuestos_compras_maquinaria"  
								onclick="validar_maquinaria_presupuestos_compras_maquinaria();" title="Guardar" tabindex="2" disabled>
							<span class="fa fa-floppy-o"></span>
						</button> 
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenedor del formulario--> 
	</div><!--#MaquinariaPresupuestosComprasMaquinariaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_maquinaria_presupuestos_compras_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/maquinaria_presupuestos_compras/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_maquinaria_presupuestos_compras_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMaquinariaPresupuestosComprasMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosMaquinariaPresupuestosComprasMaquinaria = strPermisosMaquinariaPresupuestosComprasMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMaquinariaPresupuestosComprasMaquinaria.length; i++)
					{
						//Si el indice es GUARDAR ó EDITAR (modificar)
						if((arrPermisosMaquinariaPresupuestosComprasMaquinaria[i]=='GUARDAR') || (arrPermisosMaquinariaPresupuestosComprasMaquinaria[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_maquinaria_presupuestos_compras_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para limpiar los campos del formulario
		function nuevo_maquinaria_presupuestos_compras_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_maquinaria_presupuestos_compras_maquinaria(); 
			//Limpiar cajas de texto
			$('#txtNuevoID_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtCantidad01_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtImporte01_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtCantidad02_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtImporte02_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtCantidad03_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtImporte03_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtCantidad04_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtImporte04_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtCantidad05_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtImporte05_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtCantidad06_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtImporte06_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtCantidad07_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtImporte07_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtCantidad08_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtImporte08_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtCantidad09_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtImporte09_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtCantidad10_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtImporte10_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtCantidad11_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtImporte11_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtCantidad12_maquinaria_presupuestos_compras_maquinaria').val('');
			$('#txtImporte12_maquinaria_presupuestos_compras_maquinaria').val('');
			
		}
	
		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_maquinaria_presupuestos_compras_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_maquinaria_presupuestos_compras_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmMaquinariaPresupuestosComprasMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strAnio_maquinaria_presupuestos_compras_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba un año'},
												stringLength: {
													min: 4,
													message: 'El año debe tener 4 caracteres de longitud'
												}
											}
										},
										strMaquinariaDescripcion_maquinaria_presupuestos_compras_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la descripción de maquinaria
					                                    if($('#txtMaquinariaDescripcionID_maquinaria_presupuestos_compras_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una descripción existente'
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
			var bootstrapValidator_maquinaria_presupuestos_compras_maquinaria = $('#frmMaquinariaPresupuestosComprasMaquinaria').data('bootstrapValidator');
			bootstrapValidator_maquinaria_presupuestos_compras_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_maquinaria_presupuestos_compras_maquinaria.isValid())
			{
				//Verificar que exista al menos un importe
				if($('#txtCantidad01_maquinaria_presupuestos_compras_maquinaria').val() == '' &&
				   $('#txtImporte01_maquinaria_presupuestos_compras_maquinaria').val() == '' && 
				   $('#txtCantidad02_maquinaria_presupuestos_compras_maquinaria').val() == '' &&
				   $('#txtImporte02_maquinaria_presupuestos_compras_maquinaria').val() == '' && 
				   $('#txtCantidad03_maquinaria_presupuestos_compras_maquinaria').val() == '' &&
				   $('#txtImporte03_maquinaria_presupuestos_compras_maquinaria').val() == '' && 
				   $('#txtCantidad04_maquinaria_presupuestos_compras_maquinaria').val() == '' &&
				   $('#txtImporte04_maquinaria_presupuestos_compras_maquinaria').val() == '' && 
				   $('#txtCantidad05_maquinaria_presupuestos_compras_maquinaria').val() == '' &&
				   $('#txtImporte05_maquinaria_presupuestos_compras_maquinaria').val() == '' && 
				   $('#txtCantidad06_maquinaria_presupuestos_compras_maquinaria').val() == '' &&
				   $('#txtImporte06_maquinaria_presupuestos_compras_maquinaria').val() == '' && 
				   $('#txtCantidad07_maquinaria_presupuestos_compras_maquinaria').val() == '' &&
				   $('#txtImporte07_maquinaria_presupuestos_compras_maquinaria').val() == '' && 
				   $('#txtCantidad08_maquinaria_presupuestos_compras_maquinaria').val() == '' &&
				   $('#txtImporte08_maquinaria_presupuestos_compras_maquinaria').val() == '' && 
				   $('#txtCantidad09_maquinaria_presupuestos_compras_maquinaria').val() == '' &&
				   $('#txtImporte09_maquinaria_presupuestos_compras_maquinaria').val() == '' && 
				   $('#txtCantidad10_maquinaria_presupuestos_compras_maquinaria').val() == '' &&
				   $('#txtImporte10_maquinaria_presupuestos_compras_maquinaria').val() == '' && 
				   $('#txtCantidad11_maquinaria_presupuestos_compras_maquinaria').val() == '' &&
				   $('#txtImporte11_maquinaria_presupuestos_compras_maquinaria').val() == '' && 
				   $('#txtCantidad12_maquinaria_presupuestos_compras_maquinaria').val() == '' &&
				   $('#txtImporte12_maquinaria_presupuestos_compras_maquinaria').val() == '')
				{
					//Indicar al usuario que debe ingresar al menos un importe
					new $.Zebra_Dialog('Escriba al menos un importe para este presupuesto.', {
										'type': 'error',
										'title': 'Error',
										'buttons': [{caption: 'Aceptar',
													 callback: function () {
													 	//Hacer un llamado a la función para limpiar los mensajes de error 
														limpiar_mensajes_maquinaria_presupuestos_compras_maquinaria();
														//Enfocar caja de texto
														$('#txtImporte01_maquinaria_presupuestos_compras_maquinaria').focus();
													 }
													}]
									});
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_maquinaria_presupuestos_compras_maquinaria();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_maquinaria_presupuestos_compras_maquinaria()
		{
			try
			{
				$('#frmMaquinariaPresupuestosComprasMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un presupuesto
		function guardar_maquinaria_presupuestos_compras_maquinaria()
		{
			//Hacer un llamado al método del controlador para guardar los datos del presupuesto
			$.post('maquinaria/maquinaria_presupuestos_compras/guardar',
					{ 
						strNuevoID: $('#txtNuevoID_maquinaria_presupuestos_compras_maquinaria').val(),
						intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_maquinaria_presupuestos_compras_maquinaria').val(),
						strAnio: $('#txtAnio_maquinaria_presupuestos_compras_maquinaria').val(),
						intCantidad01: $('#txtCantidad01_maquinaria_presupuestos_compras_maquinaria').val(),
						intImporte01:  $.reemplazar($('#txtImporte01_maquinaria_presupuestos_compras_maquinaria').val(), ",", ""),
						intCantidad02: $('#txtCantidad02_maquinaria_presupuestos_compras_maquinaria').val(),
						intImporte02:  $.reemplazar($('#txtImporte02_maquinaria_presupuestos_compras_maquinaria').val(), ",", ""),
						intCantidad03: $('#txtCantidad03_maquinaria_presupuestos_compras_maquinaria').val(),
						intImporte03:  $.reemplazar($('#txtImporte03_maquinaria_presupuestos_compras_maquinaria').val(), ",", ""),
						intCantidad04: $('#txtCantidad04_maquinaria_presupuestos_compras_maquinaria').val(),
						intImporte04:  $.reemplazar($('#txtImporte04_maquinaria_presupuestos_compras_maquinaria').val(), ",", ""),
						intCantidad05: $('#txtCantidad05_maquinaria_presupuestos_compras_maquinaria').val(),
						intImporte05:  $.reemplazar($('#txtImporte05_maquinaria_presupuestos_compras_maquinaria').val(), ",", ""),
						intCantidad06: $('#txtCantidad06_maquinaria_presupuestos_compras_maquinaria').val(),
						intImporte06:  $.reemplazar($('#txtImporte06_maquinaria_presupuestos_compras_maquinaria').val(), ",", ""),
						intCantidad07: $('#txtCantidad07_maquinaria_presupuestos_compras_maquinaria').val(),
						intImporte07:  $.reemplazar($('#txtImporte07_maquinaria_presupuestos_compras_maquinaria').val(), ",", ""),
						intCantidad08: $('#txtCantidad08_maquinaria_presupuestos_compras_maquinaria').val(),
						intImporte08:  $.reemplazar($('#txtImporte08_maquinaria_presupuestos_compras_maquinaria').val(), ",", ""),
						intCantidad09: $('#txtCantidad09_maquinaria_presupuestos_compras_maquinaria').val(),
						intImporte09:  $.reemplazar($('#txtImporte09_maquinaria_presupuestos_compras_maquinaria').val(), ",", ""),
						intCantidad10: $('#txtCantidad10_maquinaria_presupuestos_compras_maquinaria').val(),
						intImporte10:  $.reemplazar($('#txtImporte10_maquinaria_presupuestos_compras_maquinaria').val(), ",", ""),
						intCantidad11: $('#txtCantidad11_maquinaria_presupuestos_compras_maquinaria').val(),
						intImporte11:  $.reemplazar($('#txtImporte11_maquinaria_presupuestos_compras_maquinaria').val(), ",", ""),
						intCantidad12: $('#txtCantidad12_maquinaria_presupuestos_compras_maquinaria').val(),
						intImporte12:  $.reemplazar($('#txtImporte12_maquinaria_presupuestos_compras_maquinaria').val(), ",", "")
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_maquinaria_presupuestos_compras_maquinaria();
							$('#txtMaquinariaDescripcion_maquinaria_presupuestos_compras_maquinaria').val('');
							$('#txtMaquinariaDescripcionID_maquinaria_presupuestos_compras_maquinaria').val('');
							//Enfocar caja de texto
							$('#txtMaquinariaDescripcion_maquinaria_presupuestos_compras_maquinaria').focus();                 
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_maquinaria_presupuestos_compras_maquinaria(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_maquinaria_presupuestos_compras_maquinaria(tipoMensaje, mensaje)
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
		function editar_maquinaria_presupuestos_compras_maquinaria()
		{	
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_maquinaria_presupuestos_compras_maquinaria();
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/maquinaria_presupuestos_compras/get_datos',
			       {
			       		intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_maquinaria_presupuestos_compras_maquinaria').val(),
						strAnio: $('#txtAnio_maquinaria_presupuestos_compras_maquinaria').val()
			       },
			       function(data) {

			       		//Recuperar valores
			          	$('#txtNuevoID_maquinaria_presupuestos_compras_maquinaria').val(data.tipo_registro);


			        	//Si hay datos de las cantidades
			            if(data.row_cantidades)
			            {
				            $('#txtCantidad01_maquinaria_presupuestos_compras_maquinaria').val(data.row_cantidades.cantidad01);
				            $('#txtCantidad02_maquinaria_presupuestos_compras_maquinaria').val(data.row_cantidades.cantidad02);
				            $('#txtCantidad03_maquinaria_presupuestos_compras_maquinaria').val(data.row_cantidades.cantidad03);
				            $('#txtCantidad04_maquinaria_presupuestos_compras_maquinaria').val(data.row_cantidades.cantidad04);
				            $('#txtCantidad05_maquinaria_presupuestos_compras_maquinaria').val(data.row_cantidades.cantidad05);
				            $('#txtCantidad06_maquinaria_presupuestos_compras_maquinaria').val(data.row_cantidades.cantidad06);
				            $('#txtCantidad07_maquinaria_presupuestos_compras_maquinaria').val(data.row_cantidades.cantidad07);
				            $('#txtCantidad08_maquinaria_presupuestos_compras_maquinaria').val(data.row_cantidades.cantidad08);
				            $('#txtCantidad09_maquinaria_presupuestos_compras_maquinaria').val(data.row_cantidades.cantidad09);
				            $('#txtCantidad10_maquinaria_presupuestos_compras_maquinaria').val(data.row_cantidades.cantidad10);
				            $('#txtCantidad11_maquinaria_presupuestos_compras_maquinaria').val(data.row_cantidades.cantidad11);
				            $('#txtCantidad12_maquinaria_presupuestos_compras_maquinaria').val(data.row_cantidades.cantidad12);
			       	    }


			       	    //Si hay datos de los importes
			            if(data.row_importes)
			            {
				            $('#txtImporte01_maquinaria_presupuestos_compras_maquinaria').val(data.row_importes.importe01);
				            $('#txtImporte02_maquinaria_presupuestos_compras_maquinaria').val(data.row_importes.importe02);
				            $('#txtImporte03_maquinaria_presupuestos_compras_maquinaria').val(data.row_importes.importe03);
				            $('#txtImporte04_maquinaria_presupuestos_compras_maquinaria').val(data.row_importes.importe04);
				            $('#txtImporte05_maquinaria_presupuestos_compras_maquinaria').val(data.row_importes.importe05);
				            $('#txtImporte06_maquinaria_presupuestos_compras_maquinaria').val(data.row_importes.importe06);
				            $('#txtImporte07_maquinaria_presupuestos_compras_maquinaria').val(data.row_importes.importe07);
				            $('#txtImporte08_maquinaria_presupuestos_compras_maquinaria').val(data.row_importes.importe08);
				            $('#txtImporte09_maquinaria_presupuestos_compras_maquinaria').val(data.row_importes.importe09);
				            $('#txtImporte10_maquinaria_presupuestos_compras_maquinaria').val(data.row_importes.importe10);
				            $('#txtImporte11_maquinaria_presupuestos_compras_maquinaria').val(data.row_importes.importe11);
				            $('#txtImporte12_maquinaria_presupuestos_compras_maquinaria').val(data.row_importes.importe12);
			       	    }
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_maquinaria_presupuestos_compras_maquinaria()
		{
			//Verificar la existencia del presupuesto
			if ($('#txtMaquinariaDescripcionID_maquinaria_presupuestos_compras_maquinaria').val() != '' &&
			    $('#txtAnio_maquinaria_presupuestos_compras_maquinaria').val() != '')
			{
				//Hacer un llamado a la función para recuperar los datos del presupuesto que coincide con los id´s 
				editar_maquinaria_presupuestos_compras_maquinaria();
			}
			else
			{
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_maquinaria_presupuestos_compras_maquinaria();  
			}
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Asignar el año actual
       		$('#txtAnio_maquinaria_presupuestos_compras_maquinaria').val(anioActual()); 
       		//Validar campos númericos (solamente valores enteros y positivos)
       		$('#txtAnio_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});

       		$('#txtCantidad01_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});
        	$('#txtCantidad02_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});
        	$('#txtCantidad03_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});
        	$('#txtCantidad04_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});
        	$('#txtCantidad05_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});
        	$('#txtCantidad06_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});
        	$('#txtCantidad07_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});
        	$('#txtCantidad08_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});
        	$('#txtCantidad09_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});
        	$('#txtCantidad10_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});
        	$('#txtCantidad11_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});
        	$('#txtCantidad12_maquinaria_presupuestos_compras_maquinaria').numeric({decimal: false, negative: false});


       		//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtImporte01_maquinaria_presupuestos_compras_maquinaria').numeric();
        	$('#txtImporte02_maquinaria_presupuestos_compras_maquinaria').numeric();
        	$('#txtImporte03_maquinaria_presupuestos_compras_maquinaria').numeric();
        	$('#txtImporte04_maquinaria_presupuestos_compras_maquinaria').numeric();
        	$('#txtImporte05_maquinaria_presupuestos_compras_maquinaria').numeric();
        	$('#txtImporte06_maquinaria_presupuestos_compras_maquinaria').numeric();
        	$('#txtImporte07_maquinaria_presupuestos_compras_maquinaria').numeric();
        	$('#txtImporte08_maquinaria_presupuestos_compras_maquinaria').numeric();
        	$('#txtImporte09_maquinaria_presupuestos_compras_maquinaria').numeric();
        	$('#txtImporte10_maquinaria_presupuestos_compras_maquinaria').numeric();
        	$('#txtImporte11_maquinaria_presupuestos_compras_maquinaria').numeric();
        	$('#txtImporte12_maquinaria_presupuestos_compras_maquinaria').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_maquinaria_presupuestos_compras_maquinaria').blur(function(){
				$('.moneda_maquinaria_presupuestos_compras_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
			});

			//Comprobar la existencia del presupuesto en la BD cuando cambie el año
			$('#txtAnio_maquinaria_presupuestos_compras_maquinaria').change(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_maquinaria_presupuestos_compras_maquinaria();
			});


	        //Autocomplete para recuperar los datos de una descripción de maquinaria 
	        $('#txtMaquinariaDescripcion_maquinaria_presupuestos_compras_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMaquinariaDescripcionID_maquinaria_presupuestos_compras_maquinaria').val('');
	               //Hacer un llamado a la función para limpiar los campos del formulario
	               nuevo_maquinaria_presupuestos_compras_maquinaria();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "maquinaria/maquinaria_descripciones/autocomplete",
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
	             $('#txtMaquinariaDescripcionID_maquinaria_presupuestos_compras_maquinaria').val(ui.item.data);
	             //Hacer un llamado a la función para verificar la existencia del registro
				 verificar_existencia_maquinaria_presupuestos_compras_maquinaria();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la descripción de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMaquinariaDescripcion_maquinaria_presupuestos_compras_maquinaria').focusout(function(e){
	        	//Si no existe id de la descripción de maquinaria
	            if($('#txtMaquinariaDescripcionID_maquinaria_presupuestos_compras_maquinaria').val() == '' ||
	               $('#txtMaquinariaDescripcion_maquinaria_presupuestos_compras_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaDescripcionID_maquinaria_presupuestos_compras_maquinaria').val('');
	               $('#txtMaquinariaDescripcion_maquinaria_presupuestos_compras_maquinaria').val('');
	               //Hacer un llamado a la función para limpiar los campos del formulario
	               nuevo_maquinaria_presupuestos_compras_maquinaria();
	            }

	        });

			//Enfocar caja de texto
			$('#txtMaquinariaDescripcion_maquinaria_presupuestos_compras_maquinaria').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_maquinaria_presupuestos_compras_maquinaria();
		});
	</script>