	<div id="TraspasoAnioInventarioInternoControlVehiculosContent">  
		<!--Diseño del formulario-->
		<form id="frmTraspasoAnioInventarioInternoControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmTraspasoAnioInventarioInternoControlVehiculos" onsubmit="return(false)" autocomplete="off">
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
				<div class="row">
					<!--último año del inventario-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtAnioInventario_traspaso_anio_inventario_interno_control_vehiculos">Año del inventario</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtAnioInventario_traspaso_anio_inventario_interno_control_vehiculos" name="strAnioInventario_traspaso_anio_inventario_interno_control_vehiculos" type="number" value="" placeholder="Ingrese año"  maxlength="4"></input>
							</div>
						</div>
					</div>
					<!--Año del traspaso-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtAnioTraspaso_traspaso_anio_inventario_interno_control_vehiculos">Año del traspaso</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtAnioTraspaso_traspaso_anio_inventario_interno_control_vehiculos" name="strtAnioTraspaso_traspaso_anio_inventario_interno_control_vehiculos" type="number" value="" disabled></input>
							</div>
						</div>
					</div>
					 <!--Botones de acción (barra de tareas)-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 btn-toolBtns">
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_traspaso_anio_inventario_interno_control_vehiculos"  
								onclick="validar_traspaso_anio_inventario_interno_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
					</div>
			    </div>
			    <br><br><br><br>
			    <!--Circulo de progreso-->
				<div id="divCirculoBarProgreso_traspaso_anio_inventario_interno_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
					<div class="loader">Loading...</div>
					<br><br>
					<div align=center><b>Espere un momento por favor.</b></div>
				</div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#TraspasoAnioInventarioInternoControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_traspaso_anio_inventario_interno_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/traspaso_anio_inventario_interno/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_traspaso_anio_inventario_interno_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosTraspasoAnioInventarioInternoControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosTraspasoAnioInventarioInternoControlVehiculos = strPermisosTraspasoAnioInventarioInternoControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosTraspasoAnioInventarioInternoControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosTraspasoAnioInventarioInternoControlVehiculos[i]=='GUARDAR')//Si el indice es GUARDAR
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_traspaso_anio_inventario_interno_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		// Función para limpiar los campos del formulario
		function nuevo_traspaso_anio_inventario_interno_control_vehiculos()
		{
			//Incializar formulario
			$('#frmTraspasoAnioInventarioInternoControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_traspaso_anio_inventario_interno_control_vehiculos();
			//Asignar el último año del inventario de refacciones correspondiente a la sucursal seleccionada (logeada)
       		anio_inventario_traspaso_anio_inventario_interno_control_vehiculos(); 
       		//Enfocar caja de texto
       		$("#txtAnioInventario_traspaso_anio_inventario_interno_control_vehiculos").focus();

		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_traspaso_anio_inventario_interno_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_traspaso_anio_inventario_interno_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmTraspasoAnioInventarioInternoControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strAnioInventario_traspaso_anio_inventario_interno_control_vehiculos: {
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
			var bootstrapValidator_traspaso_anio_inventario_interno_control_vehiculos = $('#frmTraspasoAnioInventarioInternoControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_traspaso_anio_inventario_interno_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_traspaso_anio_inventario_interno_control_vehiculos.isValid())
			{

				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea guardar el traspaso?</strong>',
						             {'type':     'question',
						              'title':    'Traspaso de año del inventario',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                             	//Hacer un llamado a la función para buscar diferencias de refacciones en el inventario
						                             	//y notificar al usuario (si no existen diferencias guardar el traspaso)
														get_diferencias_refacciones_traspaso_anio_inventario_interno_control_vehiculos();

						                            }
						                          }
						              });
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_traspaso_anio_inventario_interno_control_vehiculos()
		{
			try
			{
				$('#frmTraspasoAnioInventarioInternoControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}


		//Función para guardar el traspaso de inventario de refacciones
		function guardar_traspaso_anio_inventario_interno_control_vehiculos()
		{
			
			//Hacer un llamado al método del controlador para modificar el IVA de las refacciones
			$.post('control_vehiculos/traspaso_anio_inventario_interno/guardar',
					{ 
						strAnioInventario: $('#txtAnioInventario_traspaso_anio_inventario_interno_control_vehiculos').val(),
						strAnioTraspaso: $('#txtAnioTraspaso_traspaso_anio_inventario_interno_control_vehiculos').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_traspaso_anio_inventario_interno_control_vehiculos();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_traspaso_anio_inventario_interno_control_vehiculos();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_traspaso_anio_inventario_interno_control_vehiculos(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_traspaso_anio_inventario_interno_control_vehiculos(tipoMensaje, mensaje)
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
			else if(tipoMensaje == 'error_refacciones')
            { 
                //Indicar al usuario el mensaje de información
                new $.Zebra_Dialog(mensaje, {
	                                'type': 'error',
	                                'title': 'Error',
	                                'width': 650
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

		//Función para regresar el último año del inventario de la sucursal seleccionada (logeada)
		function anio_inventario_traspaso_anio_inventario_interno_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar el último año del inventario
            $.ajax({
				        url: 'control_vehiculos/traspaso_anio_inventario_interno/get_ultimo_anio',
				        method:'post',
				        dataType: 'json',
				        async: false,
				        data: {
				        },
				        success: function (data) {
				          	if(data.row){

				          		//Recuperar valores
		                       $("#txtAnioInventario_traspaso_anio_inventario_interno_control_vehiculos").val(data.row.anio);

		                       //Hacer un llamado a la función para incrementar año (asignar año del traspaso)
							    get_anio_traspaso_traspaso_anio_inventario_interno_control_vehiculos();
				  			  
		                    }

				        }
				    });

		}


		//Función para regresar el año de traspaso (incrementar año de inventario)
		function get_anio_traspaso_traspaso_anio_inventario_interno_control_vehiculos()
		{
			//Sumar 1 al año del inventario
			var intAnio = parseInt($("#txtAnioInventario_traspaso_anio_inventario_interno_control_vehiculos").val()) + 1;
			
			//Asignar año del traspaso
			$("#txtAnioTraspaso_traspaso_anio_inventario_interno_control_vehiculos").val(intAnio);
		}



		//Función para regresar las refacciones con diferencias en el inventario y notificar al usuario (si no existen diferencias guardar el traspaso)
		function get_diferencias_refacciones_traspaso_anio_inventario_interno_control_vehiculos()
		{

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_traspaso_anio_inventario_interno_control_vehiculos();

			//Hacer un llamado al método del controlador para buscar diferencia en la refacciones del inventario
			$.post( 'control_vehiculos/traspaso_anio_inventario_interno/get_diferencia_refacciones',
					{ 
						strAnioInventario: $("#txtAnioInventario_traspaso_anio_inventario_interno_control_vehiculos").val(), 
						strAnioTraspaso: $("#txtAnioTraspaso_traspaso_anio_inventario_interno_control_vehiculos").val()
					},
					function(data) {
						if (data.mensaje)
						{

							//Hacer un llamado a la función para limpiar los campos del formulario
						 	mensaje_traspaso_anio_inventario_interno_control_vehiculos('error_refacciones', data.mensaje);
							
							 //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
							 ocultar_circulo_carga_traspaso_anio_inventario_interno_control_vehiculos();
						}
						else
						{
							//Hacer un llamado a la función para guardar los datos del registro
							guardar_traspaso_anio_inventario_interno_control_vehiculos();
						}

					},
			'json');


		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de guardar el traspaso de inventario
		function mostrar_circulo_carga_traspaso_anio_inventario_interno_control_vehiculos()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_traspaso_anio_inventario_interno_control_vehiculos").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de guardar el traspaso de inventario
		function ocultar_circulo_carga_traspaso_anio_inventario_interno_control_vehiculos()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_traspaso_anio_inventario_interno_control_vehiculos").addClass('no-mostrar');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{

			//Asignar el último año del inventario de refacciones correspondiente a la sucursal seleccionada (logeada)
       		anio_inventario_traspaso_anio_inventario_interno_control_vehiculos(); 

       		//Incrementar año del inventario (asignar año del traspaso)
			$('#txtAnioInventario_traspaso_anio_inventario_interno_control_vehiculos').change(function(e){
				 //Hacer un llamado a la función para incrementar año (asignar año del traspaso)
				 get_anio_traspaso_traspaso_anio_inventario_interno_control_vehiculos();
			});


       		//Enfocar caja de texto
       		$("#txtAnioInventario_traspaso_anio_inventario_interno_control_vehiculos").focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_traspaso_anio_inventario_interno_control_vehiculos();
		});
	</script>