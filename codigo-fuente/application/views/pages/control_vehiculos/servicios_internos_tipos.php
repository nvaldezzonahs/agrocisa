	<div id="ServiciosInternosTiposControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_servicios_internos_tipos_control_vehiculos" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_servicios_internos_tipos_control_vehiculos" 
								   name="strBusqueda_servicios_internos_tipos_control_vehiculos"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_servicios_internos_tipos_control_vehiculos"
										onclick="paginacion_servicios_internos_tipos_control_vehiculos();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_servicios_internos_tipos_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_servicios_internos_tipos_control_vehiculos"
									onclick="reporte_servicios_internos_tipos_control_vehiculos();" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_servicios_internos_tipos_control_vehiculos"
									onclick="descargar_xls_servicios_internos_tipos_control_vehiculos();" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
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
				td.movil:nth-of-type(1):before {content: "Descripción"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_servicios_internos_tipos_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Descripción</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_servicios_internos_tipos_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_servicios_internos_tipos_control_vehiculos({{servicio_interno_tipo_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_servicios_internos_tipos_control_vehiculos({{servicio_interno_tipo_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_servicios_internos_tipos_control_vehiculos({{servicio_interno_tipo_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_servicios_internos_tipos_control_vehiculos({{servicio_interno_tipo_id}},'{{estatus}}')"  
										title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="3"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_servicios_internos_tipos_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_servicios_internos_tipos_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="ServiciosInternosTiposControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_servicios_internos_tipos_control_vehiculos"  class="ModalBodyTitle">
			<h1>Tipos de Servicios Internos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmServiciosInternosTiposControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmServiciosInternosTiposControlVehiculos" onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Descripción-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtServicioInternoTipoID_servicios_internos_tipos_control_vehiculos" 
										   name="intServicioInternoTipoID_servicios_internos_tipos_control_vehiculos" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción-->
									<input id="txtDescripcionAnterior_servicios_internos_tipos_control_vehiculos" 
										   name="strDescripcionAnterior_servicios_internos_tipos_control_vehiculos" type="hidden" value="">
									</input>
									<label for="txtDescripcion_servicios_internos_tipos_control_vehiculos">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_servicios_internos_tipos_control_vehiculos" 
											name="strDescripcion_servicios_internos_tipos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese descripción" maxlength="50">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_servicios_internos_tipos_control_vehiculos"  
									onclick="validar_servicios_internos_tipos_control_vehiculos();" title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_servicios_internos_tipos_control_vehiculos"  
									onclick="cambiar_estatus_servicios_internos_tipos_control_vehiculos('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_servicios_internos_tipos_control_vehiculos"  
									onclick="cambiar_estatus_servicios_internos_tipos_control_vehiculos('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_servicios_internos_tipos_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_servicios_internos_tipos_control_vehiculos();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ServiciosInternosTiposControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaServiciosInternosTiposControlVehiculos = 0;
		var strUltimaBusquedaServiciosInternosTiposControlVehiculos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objServiciosInternosTiposControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_servicios_internos_tipos_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/servicios_internos_tipos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_servicios_internos_tipos_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosServiciosInternosTiposControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosServiciosInternosTiposControlVehiculos = strPermisosServiciosInternosTiposControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosServiciosInternosTiposControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosServiciosInternosTiposControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_servicios_internos_tipos_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosServiciosInternosTiposControlVehiculos[i]=='GUARDAR') || (arrPermisosServiciosInternosTiposControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_servicios_internos_tipos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosServiciosInternosTiposControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_servicios_internos_tipos_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_servicios_internos_tipos_control_vehiculos();
						}
						else if(arrPermisosServiciosInternosTiposControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_servicios_internos_tipos_control_vehiculos').removeAttr('disabled');
							$('#btnRestaurar_servicios_internos_tipos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosServiciosInternosTiposControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_servicios_internos_tipos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosServiciosInternosTiposControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_servicios_internos_tipos_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_servicios_internos_tipos_control_vehiculos() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_servicios_internos_tipos_control_vehiculos').val() != strUltimaBusquedaServiciosInternosTiposControlVehiculos)
			{
				intPaginaServiciosInternosTiposControlVehiculos = 0;
				strUltimaBusquedaServiciosInternosTiposControlVehiculos = $('#txtBusqueda_servicios_internos_tipos_control_vehiculos').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/servicios_internos_tipos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_servicios_internos_tipos_control_vehiculos').val(),
						intPagina:intPaginaServiciosInternosTiposControlVehiculos,
						strPermisosAcceso: $('#txtAcciones_servicios_internos_tipos_control_vehiculos').val()
					},
					function(data){
						$('#dg_servicios_internos_tipos_control_vehiculos tbody').empty();
						var tmpServiciosInternosTiposControlVehiculos = Mustache.render($('#plantilla_servicios_internos_tipos_control_vehiculos').html(),data);
						$('#dg_servicios_internos_tipos_control_vehiculos tbody').html(tmpServiciosInternosTiposControlVehiculos);
						$('#pagLinks_servicios_internos_tipos_control_vehiculos').html(data.paginacion);
						$('#numElementos_servicios_internos_tipos_control_vehiculos').html(data.total_rows);
						intPaginaServiciosInternosTiposControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_servicios_internos_tipos_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/servicios_internos_tipos/get_reporte/"+$('#txtBusqueda_servicios_internos_tipos_control_vehiculos').val());
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_servicios_internos_tipos_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("control_vehiculos/servicios_internos_tipos/get_xls/"+$('#txtBusqueda_servicios_internos_tipos_control_vehiculos').val());
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_servicios_internos_tipos_control_vehiculos()
		{
			//Incializar formulario
			$('#frmServiciosInternosTiposControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicios_internos_tipos_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmServiciosInternosTiposControlVehiculos').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_servicios_internos_tipos_control_vehiculos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_servicios_internos_tipos_control_vehiculos').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_servicios_internos_tipos_control_vehiculos').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmServiciosInternosTiposControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_servicios_internos_tipos_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_servicios_internos_tipos_control_vehiculos").hide();
			$("#btnRestaurar_servicios_internos_tipos_control_vehiculos").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_servicios_internos_tipos_control_vehiculos()
		{
			try {
				//Cerrar modal
				objServiciosInternosTiposControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_servicios_internos_tipos_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_servicios_internos_tipos_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicios_internos_tipos_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmServiciosInternosTiposControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_servicios_internos_tipos_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_servicios_internos_tipos_control_vehiculos = $('#frmServiciosInternosTiposControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_servicios_internos_tipos_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_servicios_internos_tipos_control_vehiculos.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_servicios_internos_tipos_control_vehiculos();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_servicios_internos_tipos_control_vehiculos()
		{
			try
			{
				$('#frmServiciosInternosTiposControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_servicios_internos_tipos_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/servicios_internos_tipos/guardar',
					{ 
						intServicioInternoTipoID: $('#txtServicioInternoTipoID_servicios_internos_tipos_control_vehiculos').val(),
						strDescripcion: $('#txtDescripcion_servicios_internos_tipos_control_vehiculos').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_servicios_internos_tipos_control_vehiculos').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_servicios_internos_tipos_control_vehiculos();
							//Hacer un llamado a la función para cerrar modal
							cerrar_servicios_internos_tipos_control_vehiculos();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_servicios_internos_tipos_control_vehiculos(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_servicios_internos_tipos_control_vehiculos(tipoMensaje, mensaje)
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

		// Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_servicios_internos_tipos_control_vehiculos(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtServicioInternoTipoID_servicios_internos_tipos_control_vehiculos').val();

			}
			else
			{
				intID = id;
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
				             {'type':     'question',
				              'title':    'Tipos de Servicios Internos',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('control_vehiculos/servicios_internos_tipos/set_estatus',
				                                     {intServicioInternoTipoID: intID,
				                                      strEstatus: estatus
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                          	//Hacer llamado a la función  para cargar  los registros en el grid
				                                          	paginacion_servicios_internos_tipos_control_vehiculos();

				                                            //Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_servicios_internos_tipos_control_vehiculos();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_servicios_internos_tipos_control_vehiculos(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('control_vehiculos/servicios_internos_tipos/set_estatus',
				     {intServicioInternoTipoID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
					      if (data.resultado)
					      {
					        	//Hacer llamado a la función para cargar  los registros en el grid
					      		paginacion_servicios_internos_tipos_control_vehiculos();

					      	 	//Si el id del registro se obtuvo del modal
								if(id == '')
								{
									//Hacer un llamado a la función para cerrar modal
									cerrar_servicios_internos_tipos_control_vehiculos();     
								}
					      }
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_servicios_internos_tipos_control_vehiculos(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_servicios_internos_tipos_control_vehiculos(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/servicios_internos_tipos/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_servicios_internos_tipos_control_vehiculos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;

				          	//Recuperar valores
				            $('#txtServicioInternoTipoID_servicios_internos_tipos_control_vehiculos').val(data.row.servicio_interno_tipo_id);
				            $('#txtDescripcion_servicios_internos_tipos_control_vehiculos').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_servicios_internos_tipos_control_vehiculos').val(data.row.descripcion);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_servicios_internos_tipos_control_vehiculos').addClass("estatus-"+strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_servicios_internos_tipos_control_vehiculos").show();
							}
							else 
							{	
								//Si el tipo de acción corresponde a Ver
								if(tipoAccion == 'Ver')
								{
									//Deshabilitar todos los elementos del formulario
				            		$('#frmServiciosInternosTiposControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
				            		//Ocultar botón Guardar
					           		$("#btnGuardar_servicios_internos_tipos_control_vehiculos").hide(); 
								}
								
								//Mostrar botón Restaurar
								$("#btnRestaurar_servicios_internos_tipos_control_vehiculos").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objServiciosInternosTiposControlVehiculos = $('#ServiciosInternosTiposControlVehiculosBox').bPopup({
															  appendTo: '#ServiciosInternosTiposControlVehiculosContent', 
								                              contentContainer: 'ServiciosInternosTiposControlVehiculosM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtDescripcion_servicios_internos_tipos_control_vehiculos').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
        	
			//Comprobar la existencia de la descipción en la BD cuando pierda el enfoque la caja de texto
			$('#txtDescripcion_servicios_internos_tipos_control_vehiculos').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtServicioInternoTipoID_servicios_internos_tipos_control_vehiculos').val() == '' && $('#txtDescripcion_servicios_internos_tipos_control_vehiculos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_servicios_internos_tipos_control_vehiculos($('#txtDescripcion_servicios_internos_tipos_control_vehiculos').val(), 'descripcion', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_servicios_internos_tipos_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaServiciosInternosTiposControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_servicios_internos_tipos_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_servicios_internos_tipos_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_servicios_internos_tipos_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_servicios_internos_tipos_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				 objServiciosInternosTiposControlVehiculos = $('#ServiciosInternosTiposControlVehiculosBox').bPopup({
											   appendTo: '#ServiciosInternosTiposControlVehiculosContent', 
				                               contentContainer: 'ServiciosInternosTiposControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_servicios_internos_tipos_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_servicios_internos_tipos_control_vehiculos').focus(); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_servicios_internos_tipos_control_vehiculos();
		});
	</script>