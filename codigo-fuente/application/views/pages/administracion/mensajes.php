	<div id="MensajesAdministracionContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_mensajes_administracion" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_mensajes_administracion" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicial_mensajes_administracion">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicial_mensajes_administracion'>
				                    <input class="form-control" id="txtFechaInicial_mensajes_administracion"
				                    		name= "strFechaInicial_mensajes_administracion" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Fecha final-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaFinal_mensajes_administracion">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinal_mensajes_administracion'>
				                    <input class="form-control" id="txtFechaFinal_mensajes_administracion"
				                    		name= "strFechaFinal_mensajes_administracion" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Buscar registros-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_mensajes_administracion">Descripción</label>
							</div>
							<div class="col-md-12">
								<div class="input-group">
									<input class="form-control" id="txtBusqueda_mensajes_administracion" 
										   name="strBusqueda_mensajes_administracion"  type="text" value="" 
										   tabindex="1" placeholder="Ingrese descripción" >
									</input>
									<span class="input-group-btn">
										<button class="btn btn-primary" id="btnBuscar_mensajes_administracion"
												onclick="paginacion_mensajes_administracion();" title="Buscar coincidencias" tabindex="1"> 
											<span class="glyphicon glyphicon-search"></span>
										</button>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre de barra de herramientas-->
		<!--Estilo que se utiliza para mostrar los nombres de las columnas de la tabla en el dispositivo móvil -->
		<style>
			@media (max-width: 480px) 
			{
			    /*
				Definir columnas
				*/
				td.movil:nth-of-type(1):before {content: "Fecha"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "De"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Mensaje"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<div class="row">
					<!--Cambiar el estatus a visto de todos los mensajes--> 
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbCambiarEstatus_mensajes_administracion" 
									   name="strCambiar_mensajes_administracion" type="checkbox"
									   value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Marcar como leído
	                    	</label>
	                  	</div>
					</div>
				</div>
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_mensajes_administracion">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Fecha</th>
							<th class="movil">De</th>
							<th class="movil">Mensaje</th>
							<th class="movil" style="width:1em;"></th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
						<script id="plantilla_mensajes_administracion" type="text/template"> 
						{{#rows}}
							<tr class="movil" title="{{tipoMensaje}}" data-mensaje_id="{{mensaje_id}}" 
								data-referencia_id="{{referencia_id}}" data-proceso="{{proceso}}">
								<td class="movil">{{fecha}}</td>
								<td class="movil">{{usuario_creacion}}</td>
								<td class="movil">{{mensaje}}</td>
								<td class="movil">
									<span class="tick">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076">
											<path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="{{colorIcono}}"/>
										</svg>
									</span>
								</td>
							</tr>
							{{/rows}}
							{{^rows}}
							<tr class="movil"> 
								<td class="movil" colspan="3">No se encontraron resultados.</td>
							</tr> 
							{{/rows}}
						</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_mensajes_administracion"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_mensajes_administracion">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="MensajesAdministracionBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_mensajes_administracion"  class="ModalBodyTitle">
			<h1>Mensajes</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMensajesAdministracion" method="post" action="#" class="form-horizontal" role="form" name="frmMensajesAdministracion" 
					  onsubmit="return(false)" autocomplete="off">
					<!--Mensajes enviados y recibidos-->
					<div class="conversacion">
						<!-- Caja de texto oculta que se utiliza para recuperar los id del registro seleccionado-->
						<input id="txtMensajeID_mensajes_administracion" 
							   name="intMensajeID_mensajes_administracion" type="hidden" value="">
						</input>
						<!-- Caja de texto oculta que se utiliza para asignar id de la referencia seleccionada-->
						<input id="txtReferenciaID_mensajes_administracion" 
							   name="strReferenciaID_mensajes_administracion" type="hidden" value="">
						</input>
						<!-- Caja de texto oculta que se utiliza para asignar el proceso de la referencia seleccionada-->
						<input id="txtProceso_mensajes_administracion" 
							   name="strProceso_mensajes_administracion" type="hidden" value="">
						</input>
						<!-- Caja de texto oculta que se utiliza para recuperar el total de mensajes-->
						<input id="txtNumeroMensajesNuevos_mensajes_administracion" 
							   name="intTotalMensajesNuevos_mensajes_administracion" type="hidden" value="">
						</input>
						<div id="divConversacion_mensajes_administracion" class="conversacion-container">
						</div>
					</div>
					<br>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar" id="btnCerrar_mensajes_administracion" type="reset" aria-hidden="true" 
									onclick="cerrar_mensajes_administracion();" title="Cerrar" tabindex="2">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MensajesAdministracionContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros 
		var intPaginaMensajesAdministracion = 0;
		var strUltimaBusquedaMensajesAdministracion = "";
		//Variable que se utiliza para asignar objeto del modal
		var objMensajesAdministracion = null;

		//Función para la búsqueda de registros
		function paginacion_mensajes_administracion() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaMensajesAdministracion =($('#txtBusqueda_mensajes_administracion').val()+$('#txtFechaInicial_mensajes_administracion').val()+$('#txtFechaFinal_mensajes_administracion').val());

			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaMensajesAdministracion != strUltimaBusquedaMensajesAdministracion)
			{
				intPaginaMensajesAdministracion = 0;
				strUltimaBusquedaMensajesAdministracion = strNuevaBusquedaMensajesAdministracion;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('administracion/mensajes/get_paginacion',
					{	
						strBusqueda: $('#txtBusqueda_mensajes_administracion').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicial_mensajes_administracion').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinal_mensajes_administracion').val()),
						intPagina:intPaginaMensajesAdministracion
					},
					function(data){
						$('#dg_mensajes_administracion tbody').empty();
						var tmpMensajesAdministracion = Mustache.render($('#plantilla_mensajes_administracion').html(),data);
						$('#dg_mensajes_administracion tbody').html(tmpMensajesAdministracion);
						$('#pagLinks_mensajes_administracion').html(data.paginacion);
						$('#numElementos_mensajes_administracion').html(data.total_rows);
						intPaginaMensajesAdministracion = data.pagina;
					},
			'json');
		}

		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_mensajes_administracion()
		{
			//Incializar formulario
			$('#frmMensajesAdministracion')[0].reset();
			//Limpiar cajas de texto ocultas
			$('#frmMensajesAdministracion').find('input[type=hidden]').val('');
			//Limpiar div de conversación (mensajeria)
			$("#divConversacion_mensajes_administracion").empty();
			//Quitar clases del div para poder tomar el color correspondiente al número de mensajes nuevos
			$('#divEncabezadoModal_mensajes_administracion').removeClass("mensaje-NUEVO");
			$('#divEncabezadoModal_mensajes_administracion').removeClass("mensaje-VISTO");
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_mensajes_administracion()
		{
			//Cerrar modal
			objMensajesAdministracion.close();

			//Si hay mensajes nuevos para el usuario logeado en el sistema
			if($('#txtNumeroMensajesNuevos_mensajes_administracion').val() > 0)
			{

				//Hacer un llamado a la función para cambiar el estatus de los registros
				cambiar_estatus_mensajes_administracion($('#txtReferenciaID_mensajes_administracion').val(), $('#txtProceso_mensajes_administracion').val());
			}
		}

		
		//Función para mostrar mensaje de éxito o error
		function mensaje_mensajes_administracion(tipoMensaje, mensaje)
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
		}
		
		//Función para cambiar el estatus de los registros que coinciden con el criterio de búsqueda
		function cambiar_estatus_mensajes_administracion(referenciaID, proceso)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus a VISTO
			$.post('administracion/mensajes/set_estatus',
			     {intReferenciaID: referenciaID,
			      strProceso: proceso
			     },
			     function(data) {
			        if(data.resultado)
			        {
			        	//Si existe id de la referencia
				        if(referenciaID != '')
				        {
							//Enfocar caja de texto 
							$('#txtFechaInicial_mensajes_administracion').focus();
				        }
				        else
				        {

				        	//Desmarcar (Deseleccionar) checkbox cambiar estatus
				            $('#chbCambiarEstatus_mensajes_administracion').prop("checked", false);
				        }

				        //Hacer llamado a la función  para cargar los registros en el grid
				        paginacion_mensajes_administracion();
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_mensajes_administracion(data.tipo_mensaje, data.mensaje);
			     },
			    'json');       
		}

		//Función que se utiliza para crear mensaje de conversación
		function nuevo_mensaje_conversacion_mensajes_administracion(fecha, estatus, usuarioCreacion, 
															        empleadoCreacion, usuarioEnvioMesaje, mensaje, mensajeID) 
		{
		    //Variable que se utiliza para crear elemento DOM
			var elementMensajesAdministracion = document.createElement('div');
			//Variable que se utiliza para cambiar el color del icono del mensaje
			var strColorIconoMensajesAdministracion = "";
			//Variable que se utiliza para cambiar el color del nombre de usuario
			var strColorTituloMensajesAdministracion = "";
			
			//Dependiendo del usuario de creación cambiar la clase del mensaje
			if(usuarioEnvioMesaje == 'SI')
			{	
				elementMensajesAdministracion.classList.add('mensaje', 'enviado');
			}
			else
			{
				elementMensajesAdministracion.classList.add('mensaje', 'recibido');
			}

			//Dependiendo del estatus cambiar el color del icono del mensaje
			if(estatus == 'NUEVO')
			{
				strColorIconoMensajesAdministracion = "#92a58c";//Color gris
			}
			else
			{
				strColorIconoMensajesAdministracion = "#4fc3f7";//Color azul
			}

			//Si el usuario tiene empleado
			if(empleadoCreacion != '')
			{
				empleadoCreacion = ' - ' +empleadoCreacion;
			}

			//Si el id corresponde al mensaje seleccionado
			if(mensajeID == $('#txtMensajeID_mensajes_administracion').val())
			{	//Agregar clase para cambiar el color del nombre de usuario
				strColorTituloMensajesAdministracion = 'class=text-info';
			}

			elementMensajesAdministracion.innerHTML = '<strong '+strColorTituloMensajesAdministracion+'>'+
														usuarioCreacion+empleadoCreacion+'</strong>'+
														'<br>'+mensaje+
														'<span class="metadata">' +
															'<span class="time">' + fecha + '</span>' +
															'<span class="tick">'+
																'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076">'+
																	'<path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="'+strColorIconoMensajesAdministracion+'"/>'+
																'</svg>'+
															'</span>'+
														'</span>';

			return elementMensajesAdministracion;
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFechaInicial_mensajes_administracion').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_mensajes_administracion').datetimepicker({format: 'DD/MM/YYYY'});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_mensajes_administracion').on('dp.change', function (e) {
				$('#dteFechaFinal_mensajes_administracion').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_mensajes_administracion').on('dp.change', function (e) {
				$('#dteFechaInicial_mensajes_administracion').data('DateTimePicker').maxDate(e.date);
			});

			//Seleccionar o deseleccionar todos los nodos del tree view (árbol) cuando se de clic en el checkbox
			$('#chbCambiarEstatus_mensajes_administracion').click(function(event) {
				//Si el checkbox se encuentra seleccionado
				if( $('#chbCambiarEstatus_mensajes_administracion').is(':checked')) 
				{
					//Hacer un llamado a la función para modificar el estatus de los nuevos mensajes 
					//para el usuario logeado en el sistema
					cambiar_estatus_mensajes_administracion('','');
				}
			});

			//Abrir modal con los mensajes de la referencia cuando se de clic en el tr
			$('#dg_mensajes_administracion tbody').on('click','tr td', function(evt){
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_mensajes_administracion();
				//Variables que se utilizan para recuperar valores del renglón
				var targetMensajesAdministracion;
			    targetMensajesAdministracion = $(event.target);
			  
			    //Asignar el número de mensajes nuevos para el usuario logeado en el sistema
       		    var intNumMsjNuevosMensajesAdministracion = $('#txtNumeroMensajesNuevos_mensajes_administracion').val(); 

		    	//Asignar valores
		    	$('#txtMensajeID_mensajes_administracion').val(targetMensajesAdministracion.parent().data('mensaje_id'));
			    $('#txtReferenciaID_mensajes_administracion').val(targetMensajesAdministracion.parent().data('referencia_id'));
			     $('#txtProceso_mensajes_administracion').val(targetMensajesAdministracion.parent().data('proceso'));
			    //Div donde se agregaran los mensajes
				var conversacionMensajesAdministracion = document.querySelector('.conversacion-container');
				//Hacer un llamado al método del controlador para regresar los datos de los registros
				$.post('administracion/mensajes/get_datos',
				       {intReferenciaID: $('#txtReferenciaID_mensajes_administracion').val(),
				       	strProceso: $('#txtProceso_mensajes_administracion').val()
				       },
				       function(data) {
				      		//Hacer un recorrido para obtener datos de los registros
				        	for (var i = 0; i < data.row.length; i++) 
				        	{
				        		//Hacer un llamado a la función para crear mensaje de conversación
				        		var strMensajeMensajesAdministracion = nuevo_mensaje_conversacion_mensajes_administracion(data.row[i].fecha, data.row[i].estatus, data.row[i].usuario_creacion, data.row[i].empleado_creacion, data.row[i].usuario_envio_mesaje, data.row[i].mensaje, data.row[i].mensaje_id);
				        		//Agregar mensaje al div conversación
				        		conversacionMensajesAdministracion.appendChild(strMensajeMensajesAdministracion);
				        		//Si el estatus del registro es NUEVO
				        		if(data.row[i].estatus == 'NUEVO')
				        		{
				        			//Si el usuario que envió el mensaje no corresponde al usuario logeado en el sistema
				        			if(data.row[i].usuario_envio_mesaje != 'SI')
									{
										//Si no existen nuevos mensajes para el usuario
										if(intNumMsjNuevosMensajesAdministracion == '')
					        			{
					        				//Asignar valor de 1
											intNumMsjNuevosMensajesAdministracion = 1;
					        			}
					        			else
					        			{
					        				//Incrementar uno
					        				intNumMsjNuevosMensajesAdministracion++;
					        			}
									}
				        		}
				        	}

				        	//Asignar número de mensajes nuevos para el usuario logeado en el sistema
				        	$('#txtNumeroMensajesNuevos_mensajes_administracion').val(intNumMsjNuevosMensajesAdministracion);

				        	//Si hay mensajes nuevos
				        	if(intNumMsjNuevosMensajesAdministracion > 0)
				        	{
				        		//Cambiar color del encabezado para indicar al usuario que existen mensajes
							    $('#divEncabezadoModal_mensajes_administracion').addClass("mensaje-NUEVO");
				        	}
				        	else
				        	{
				        		//Cambiar color del encabezado para indicar al usuario que no existen mensajes
				        		$('#divEncabezadoModal_mensajes_administracion').addClass("mensaje-VISTO");
				        	}
				        	
				       },
				       'json');

				//Abrir modal
	            objMensajesAdministracion = $('#MensajesAdministracionBox').bPopup({
											appendTo: '#MensajesAdministracionContent', 
			                           		contentContainer: 'MensajesAdministracionM', 
			                            	zIndex: 2, 
			                            	modalClose: false, 
			                            	modal: true, 
			                            	follow: [true,false], 
			                            	followEasing : "linear", 
			                            	easing: "linear", 
			                            	modalColor: ('#F0F0F0')});
			   
			});

			//Paginación de registros
			$('#pagLinks_mensajes_administracion').on('click','a',function(event){
				event.preventDefault();
				intPaginaMensajesAdministracion = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_mensajes_administracion();
			});

			//Enfocar caja de texto
			$('#txtFechaInicial_mensajes_administracion').focus();
			//Hacer llamado a la función  para cargar  los registros en el grid
		    paginacion_mensajes_administracion();
		});
	</script>