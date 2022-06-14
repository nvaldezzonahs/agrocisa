	<div id="CambioIvaRefaccionesContent">  
		<!--Diseño del formulario-->
		<form id="frmCambioIvaRefacciones" method="post" action="#" class="form-horizontal" role="form" 
			  name="frmCambioIvaRefacciones" onsubmit="return(false)" autocomplete="off">
			<!--Panel que contiene formulario-->
			<div class="panel-modal-sin-barra">
				<div class="row">
					<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
								<input id="txtTasaCuotaIva_cambio_iva_refacciones" 
									   name="intTasaCuotaIva_cambio_iva_refacciones" 
									   type="hidden" value="">
								</input>
								<label for="txtPorcentajeIva_cambio_iva_refacciones">IVA %</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtPorcentajeIva_cambio_iva_refacciones" 
										name="intPorcentajeIva_cambio_iva_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese IVA" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    </div>
			    <!--Circulo de progreso-->
				<div id="divCirculoBarProgreso_cambio_iva_refacciones" class="load-container load5 circulo_bar no-mostrar">
					<div class="loader">Loading...</div>
					<br><br>
					<div align=center><b>Espere un momento por favor.</b></div>
				</div>
			    <!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_cambio_iva_refacciones"  
								onclick="validar_cambio_iva_refacciones();"  title="Guardar" tabindex="2" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
					</div>
				</div>
			</div><!--Cierre del contenedor del formulario--> 
		</form><!--Cierre del formulario-->
	</div><!--#CambioIvaRefaccionesContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_cambio_iva_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/cambio_iva/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_cambio_iva_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCambioIvaRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosCambioIvaRefacciones = strPermisosCambioIvaRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCambioIvaRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCambioIvaRefacciones[i]=='EDITAR')//Si el indice es EDITAR (modificar)
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_cambio_iva_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		// Función para limpiar los campos del formulario
		function nuevo_cambio_iva_refacciones()
		{
			//Incializar formulario
			$('#frmCambioIvaRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cambio_iva_refacciones();
			//Enfocar caja de texto
			$('#txtPorcentajeIva_cambio_iva_refacciones').focus();
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cambio_iva_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cambio_iva_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmCambioIvaRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intPorcentajeIva_cambio_iva_refacciones: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IVA
					                                    if($('#txtTasaCuotaIva_cambio_iva_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una tasa o cuota de IVA existente'
					                                        };
					                                    }

					                                    return true;
					                                  }
					                            }
											}
										},
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cambio_iva_refacciones = $('#frmCambioIvaRefacciones').data('bootstrapValidator');
			bootstrapValidator_cambio_iva_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cambio_iva_refacciones.isValid())
			{
				
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea modificar el porcentaje de IVA para todas las refacciones?</strong>',
						             {'type':     'question',
						              'title':    'Cambio de IVA',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                             	//Hacer un llamado a la función para modificar el IVA de las refacciones
														modificar_cambio_iva_refacciones();

						                            }
						                          }
						              });
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cambio_iva_refacciones()
		{
			try
			{
				$('#frmCambioIvaRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para modificar el IVA de las refacciones
		function modificar_cambio_iva_refacciones()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cambio_iva_refacciones();

			//Hacer un llamado al método del controlador para modificar el IVA de las refacciones
			$.post('refacciones/cambio_iva/modificar',
					{ 
						intTasaCuotaIva: $('#txtTasaCuotaIva_cambio_iva_refacciones').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cambio_iva_refacciones();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_cambio_iva_refacciones();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cambio_iva_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_cambio_iva_refacciones(tipoMensaje, mensaje)
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

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_cambio_iva_refacciones()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cambio_iva_refacciones").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_cambio_iva_refacciones()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cambio_iva_refacciones").addClass('no-mostrar');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{

			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtPorcentajeIva_cambio_iva_refacciones').numeric();

			//Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_cambio_iva_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_cambio_iva_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_tasa_cuota/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strImpuesto: 'IVA'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtTasaCuotaIva_cambio_iva_refacciones').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la tasa o cuota del impuesto de IVA cuando pierda el enfoque la caja de texto
	        $('#txtPorcentajeIva_cambio_iva_refacciones').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_cambio_iva_refacciones').val() == '' ||
	               $('#txtPorcentajeIva_cambio_iva_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_cambio_iva_refacciones').val('');
	               $('#txtPorcentajeIva_cambio_iva_refacciones').val('');
	            }
	            
	        });

			//Enfocar caja de texto
			$('#txtPorcentajeIva_cambio_iva_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_cambio_iva_refacciones();
		});
	</script>