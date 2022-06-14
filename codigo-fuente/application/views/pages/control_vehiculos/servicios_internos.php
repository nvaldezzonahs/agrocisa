	<div id="ServiciosInternosControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_servicios_internos_control_vehiculos" action="#" method="post" 
				  tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_servicios_internos_control_vehiculos" 
								   name="strBusqueda_servicios_internos_control_vehiculos"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_servicios_internos_control_vehiculos"
										onclick="paginacion_servicios_internos_control_vehiculos();" 
										title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_servicios_internos_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_servicios_internos_control_vehiculos"
									onclick="reporte_servicios_internos_control_vehiculos();" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_servicios_internos_control_vehiculos"
									onclick="descargar_xls_servicios_internos_control_vehiculos();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_servicios_internos_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Descripción</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_servicios_internos_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{codigo}}</td>
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_servicios_internos_control_vehiculos({{servicio_interno_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_servicios_internos_control_vehiculos({{servicio_interno_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_servicios_internos_control_vehiculos({{servicio_interno_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_servicios_internos_control_vehiculos({{servicio_interno_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_servicios_internos_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_servicios_internos_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="ServiciosInternosControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_servicios_internos_control_vehiculos"  class="ModalBodyTitle">
			<h1>Servicios</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmServiciosInternosControlVehiculos" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmServiciosInternosControlVehiculos"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
					    <!--Código-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtServicioInternoID_servicios_internos_control_vehiculos" name="intServicioInternoID_servicios_internos_control_vehiculos"  
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el código anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código-->
									<input id="txtCodigoAnterior_servicios_internos_control_vehiculos" 
										   name="strCodigoAnterior_servicios_internos_control_vehiculos" 
											type="hidden" value="" />
									<label for="txtCodigo_servicios_internos_control_vehiculos">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_servicios_internos_control_vehiculos" 
											name="strCodigo_servicios_internos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese código" maxlength="10" />
								</div>
							</div>
						</div>
						<!--Descripción-->
						<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcion_servicios_internos_control_vehiculos">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_servicios_internos_control_vehiculos" 
											name="strDescripcion_servicios_internos_control_vehiculos" type="text" value=""
											tabindex="1" placeholder="Ingrese descripción" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Horas-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHoras_servicios_internos_control_vehiculos">Tiempo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtHoras_servicios_internos_control_vehiculos" 
											name="intHoras_servicios_internos_control_vehiculos" type="text" 
											value="" tabindex="1" placeholder="Ingrese tiempo" maxlength="12" />
								</div>
							</div>
						</div>
				    </div>

				    <!-- Sección del detallado -->
				    <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
									<input id="txtNumDetalles_detalles_servicios_internos_control_vehiculos" 
								   		name="intNumDetalles_servicios_internos_control_vehiculos" type="hidden" value="" />
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles del servicio</h4>
										</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
													<div class="row">
														<!--Refaccion-->
														<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
															<div class="form-group">
																<div class="col-md-12">
																	<input  class="form-control" 
																			id="txtRefaccionID_detalles_servicios_internos_control_vehiculos" 
																			name="intRefaccionID_detalles_servicios_internos_control_vehiculos"
																			type="hidden" />
																	<label for="txtRefaccion_detalles_servicios_internos_control_vehiculos">
																		Refacción
																	</label>
																</div>
																<div class="col-md-12">
																	<input  class="form-control" 
																			id="txtRefaccion_detalles_servicios_internos_control_vehiculos" 
																			name="strRefaccion_detalles_servicios_internos_control_vehiculos" 
																			type="text"
																			placeholder="Ingrese refacción" 
																			value="" 
																			tabindex="1"  
																			maxlength="250" disabled />
																</div>
															</div>
														</div>
														<!--Cantidad-->
														<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
															<div class="form-group">
																<div class="col-md-12">
																	<label for="txtCantidad_detalles_servicios_internos_control_vehiculos">Cantidad</label>
																</div>
																<div class="col-md-12">
																	<input  class="form-control moneda_servicios_internos_control_vehiculos" 
																			id="txtCantidad_detalles_servicios_internos_control_vehiculos" 
																			name="intCantidad_detalles_servicios_internos_control_vehiculos" 
																			type="text"
																			placeholder="Ingrese cantidad" 
																			value="" 
																			tabindex="1" 
																			maxlength="5" 
																			disabled />
																</div>
															</div>
														</div>
														<!--Botón agregar-->
						                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-1">
						                                	<button class="btn btn-primary btn-toolBtns pull-right" 
						                                			id="btnAgregar_servicios_internos_control_vehiculos" 
						                                			onclick="agregar_renglon_detalles_servicios_internos_control_vehiculos();" 
						                                	     	title="Agregar" tabindex="1"> 
						                                		<span class="glyphicon glyphicon-plus"></span>
						                                	</button>
						                             	</div>
													</div>
												</div>
											</div>

											<div class="row">
												<!--Div que contiene la tabla con los detalles encontrados-->
												<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
													<div class="row">
														<!-- Diseño de la tabla-->
														<table class="table-hover movil" id="dg_detalles_servicios_internos_control_vehiculos">
															<thead class="movil">
																<tr class="movil">
																	<th class="movil">Refacción</th>
																	<th class="movil">Cantidad</th>
																	<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
																</tr>
															</thead>
															<tbody class="movil"></tbody>
															<tfoot class="movil"></tfoot>
														</table>
														<br>
														<div class="row">
															<!--Número de registros encontrados-->
															<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																<button class="btn btn-default btn-sm disabled pull-right">
																	<strong id="numElementos_detalles_servicios_internos_control_vehiculos">0</strong> encontrados
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- Termina sección del Detallado -->

					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" 
									id="btnGuardar_servicios_internos_control_vehiculos"  
									onclick="validar_servicios_internos_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_servicios_internos_control_vehiculos"  
									onclick="cambiar_estatus_servicios_internos_control_vehiculos('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_servicios_internos_control_vehiculos"  
									onclick="cambiar_estatus_servicios_internos_control_vehiculos('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_servicios_internos_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_servicios_internos_control_vehiculos();" title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ServiciosInternosControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaServiciosInternosControlVehiculos = 0;
		var strUltimaBusquedaServiciosInternosControlVehiculos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objServiciosInternosControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_servicios_internos_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/servicios_internos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_servicios_internos_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosServiciosInternosControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosServiciosInternosControlVehiculos = strPermisosServiciosInternosControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosServiciosInternosControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosServiciosInternosControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_servicios_internos_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosServiciosInternosControlVehiculos[i]=='GUARDAR') || (arrPermisosServiciosInternosControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_servicios_internos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosServiciosInternosControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_servicios_internos_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_servicios_internos_control_vehiculos();
						}
						else if(arrPermisosServiciosInternosControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_servicios_internos_control_vehiculos').removeAttr('disabled');
							$('#btnRestaurar_servicios_internos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosServiciosInternosControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_servicios_internos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosServiciosInternosControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_servicios_internos_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_servicios_internos_control_vehiculos() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_servicios_internos_control_vehiculos').val() != strUltimaBusquedaServiciosInternosControlVehiculos)
			{
				intPaginaServiciosInternosControlVehiculos = 0;
				strUltimaBusquedaServiciosInternosControlVehiculos = $('#txtBusqueda_servicios_internos_control_vehiculos').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/servicios_internos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_servicios_internos_control_vehiculos').val(),
						intPagina:intPaginaServiciosInternosControlVehiculos,
						strPermisosAcceso: $('#txtAcciones_servicios_internos_control_vehiculos').val()
					},
					function(data){
						$('#dg_servicios_internos_control_vehiculos tbody').empty();
						var tmpServiciosInternosControlVehiculos = Mustache.render($('#plantilla_servicios_internos_control_vehiculos').html(),data);
						$('#dg_servicios_internos_control_vehiculos tbody').html(tmpServiciosInternosControlVehiculos);
						$('#pagLinks_servicios_internos_control_vehiculos').html(data.paginacion);
						$('#numElementos_servicios_internos_control_vehiculos').html(data.total_rows);
						intPaginaServiciosInternosControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_servicios_internos_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/servicios_internos/get_reporte/"+$('#txtBusqueda_servicios_internos_control_vehiculos').val());
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_servicios_internos_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("control_vehiculos/servicios_internos/get_xls/"+$('#txtBusqueda_servicios_internos_control_vehiculos').val());
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_servicios_internos_control_vehiculos()
		{
			//Incializar formulario
			$('#frmServiciosInternosControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicios_internos_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmServiciosInternosControlVehiculos').find('input[type=hidden]').val('');

			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_servicios_internos_control_vehiculos();	

			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_servicios_internos_control_vehiculos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_servicios_internos_control_vehiculos').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_servicios_internos_control_vehiculos').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmServiciosInternosControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtProductoServicio_servicios_internos_control_vehiculos').attr("disabled", "disabled");
			$('#txtUnidad_servicios_internos_control_vehiculos').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_servicios_internos_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_servicios_internos_control_vehiculos").hide();
			$("#btnRestaurar_servicios_internos_control_vehiculos").hide();
		}

		//Función para inicializar elementos de la tabla detalles del servicio
		function inicializar_detalles_servicios_internos_control_vehiculos()
		{
			//Eliminar los datos de la tabla detalles del movimiento
			$('#dg_detalles_servicios_internos_control_vehiculos tbody').empty();
			$('#numElementos_detalles_servicios_internos_control_vehiculos').html(0);
			$('#txtNumDetalles_detalles_servicios_internos_control_vehiculos').html('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_servicios_internos_control_vehiculos()
		{
			try {
				//Cerrar modal
				objServiciosInternosControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_servicios_internos_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_servicios_internos_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicios_internos_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmServiciosInternosControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo_servicios_internos_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba el código para este servicio'}
											}
										},
										strDescripcion_servicios_internos_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										intHoras_servicios_internos_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba número de horas'}
											}
										},
										intRefaccionID_detalles_servicios_internos_control_vehiculos: {
									        excluded: true  // Ignorar (no valida el campo)    
									    },
										strRefaccion_detalles_servicios_internos_control_vehiculos: {
									        excluded: true  // Ignorar (no valida el campo)    
									    },
									    intCantidad_detalles_servicios_internos_control_vehiculos: {
									        excluded: true  // Ignorar (no valida el campo)    
									    }

									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_servicios_internos_control_vehiculos = $('#frmServiciosInternosControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_servicios_internos_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_servicios_internos_control_vehiculos.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_servicios_internos_control_vehiculos();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_servicios_internos_control_vehiculos()
		{
			try
			{
				$('#frmServiciosInternosControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_servicios_internos_control_vehiculos()
		{
			
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_servicios_internos_control_vehiculos').getElementsByTagName('tbody')[0];
			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRefaccionesID = [];
			var arrCantidades = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variable que se utilizan para asignar valores del detalle
				var intCantidad = objRen.cells[1].innerHTML;
				
				arrRefaccionesID.push(objRen.getAttribute('id'));
				arrCantidades.push(intCantidad);
				
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/servicios_internos/guardar',
					{ 
						intServicioInternoID: $('#txtServicioInternoID_servicios_internos_control_vehiculos').val(),
						strCodigo: $('#txtCodigo_servicios_internos_control_vehiculos').val(),
						strCodigoAnterior: $('#txtCodigoAnterior_servicios_internos_control_vehiculos').val(),
			            strDescripcion: $('#txtDescripcion_servicios_internos_control_vehiculos').val(),
			            intHoras: $('#txtHoras_servicios_internos_control_vehiculos').val(),
			            //Datos de los detalles
						strRefaccionesID: arrRefaccionesID.join('|'), 
						strCantidades: arrCantidades.join('|')
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_servicios_internos_control_vehiculos();
							//Hacer un llamado a la función para cerrar modal
							cerrar_servicios_internos_control_vehiculos();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_servicios_internos_control_vehiculos(data.tipo_mensaje, data.mensaje);
					},
			'json');
			
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_servicios_internos_control_vehiculos(tipoMensaje, mensaje)
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
		function cambiar_estatus_servicios_internos_control_vehiculos(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtServicioInternoID_servicios_internos_control_vehiculos').val();

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
				              'title':    'Servicios',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('control_vehiculos/servicios_internos/set_estatus',
				                                     {
				                                     	intServicioInternoID: intID,
				                                      	strEstatus: estatus
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                        	//Hacer llamado a la función  para cargar  los registros en el grid
				                                          	paginacion_servicios_internos_control_vehiculos();

				                                          	//Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_servicios_internos_control_vehiculos();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_servicios_internos_control_vehiculos(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('control_vehiculos/servicios_internos/set_estatus',
				     {
				     	intServicioInternoID: intID,
				      	strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_servicios_internos_control_vehiculos();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_servicios_internos_control_vehiculos();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_servicios_internos_control_vehiculos(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_servicios_internos_control_vehiculos(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/servicios_internos/get_datos',
			       {
			       		strBusqueda:busqueda,
			       		strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_servicios_internos_control_vehiculos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Crear variable vacia
				            var strAccionesTablaDetalles = '';
				          	//Recuperar valores
				            $('#txtServicioInternoID_servicios_internos_control_vehiculos').val(data.row.servicio_interno_id);
				            $('#txtCodigo_servicios_internos_control_vehiculos').val(data.row.codigo);
				            $('#txtCodigoAnterior_servicios_internos_control_vehiculos').val(data.row.codigo);
				            $('#txtDescripcion_servicios_internos_control_vehiculos').val(data.row.descripcion);
			                $('#txtHoras_servicios_internos_control_vehiculos').val(data.row.horas);
			                

			                //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_servicios_internos_control_vehiculos').addClass("estatus-"+strEstatus);				           	
				           	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_servicios_internos_control_vehiculos").show();
				            	 //Variable que se utiliza para asignar las acciones del grid view
						    	 strAccionesTablaDetalles = 	 "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_detalles_servicios_internos_control_vehiculos(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_detalles_servicios_internos_control_vehiculos(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
							}
							else 
							{	
								//Si el tipo de acción corresponde a Ver
								if(tipoAccion == 'Ver')
								{
									//Deshabilitar todos los elementos del formulario
				            		$('#frmServiciosInternosControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
				            		//Ocultar botón Guardar
					           		$("#btnGuardar_servicios_internos_control_vehiculos").hide(); 
								}
								 
								
								//Mostrar botón Restaurar
								$("#btnRestaurar_servicios_internos_control_vehiculos").show();
							}

			              

				           	//Si existen detalles
			                if(data.detalles)
			                {

			                	//Mostramos los detalles del registro
					           	for (var intCon in data.detalles) 
					            {
					            	//Obtenemos el objeto de la tabla
									var objTabla = document.getElementById('dg_detalles_servicios_internos_control_vehiculos').getElementsByTagName('tbody')[0];

									//Insertamos el renglón con sus celdas en el objeto de la tabla
									var objRenglon = objTabla.insertRow();
									var objCeldaRefaccion = objRenglon.insertCell(0);
									var objCeldaCantidad = objRenglon.insertCell(1);
									var objCeldaAcciones = objRenglon.insertCell(2);

									//Variables que se utilizan para asignar valores del detalle
									var intCantidad =  parseFloat(data.detalles[intCon].cantidad);

									//Asignar valores
									objRenglon.setAttribute('class', 'movil');
									objRenglon.setAttribute('id', data.detalles[intCon].refaccion_id);
									objCeldaRefaccion.innerHTML = data.detalles[intCon].refaccion;
									objCeldaRefaccion.setAttribute('class', 'movil b1');
									objCeldaCantidad.innerHTML = intCantidad;
									objCeldaCantidad.setAttribute('class', 'movil b2');
									objCeldaAcciones.innerHTML = strAccionesTablaDetalles;
									objCeldaAcciones.setAttribute('class', 'td-center movil b3');
					            }

					            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
								var intFilas = $("#dg_detalles_servicios_internos_control_vehiculos tr").length - 1;
								$('#numElementos_detalles_servicios_internos_control_vehiculos').html(intFilas);
								$('#txtNumDetalles_detalles_servicios_internos_control_vehiculos').val(intFilas);

			                }

				            
				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objServiciosInternosControlVehiculos = $('#ServiciosInternosControlVehiculosBox').bPopup({
															  appendTo: '#ServiciosInternosControlVehiculosContent', 
								                              contentContainer: 'ServiciosInternosControlVehiculosM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCodigo_servicios_internos_control_vehiculos').focus();
					        }
			       	    }
			       },
			       'json');
		}

		/*******************************************************************************************************************
		Funciones del modal correspondientes a los detalles del mismo
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_servicios_internos_control_vehiculos()
		{
			//Obtenemos los datos de las cajas de texto
			var intRefaccionID = $('#txtRefaccionID_detalles_servicios_internos_control_vehiculos').val();
			var strRefaccion = $('#txtRefaccion_detalles_servicios_internos_control_vehiculos').val();
			var intCantidad = $('#txtCantidad_detalles_servicios_internos_control_vehiculos').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_servicios_internos_control_vehiculos').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if(intRefaccionID == '' || strRefaccion == '')
			{
				//Enfocar caja de texto
				$('#txtRefaccion_detalles_servicios_internos_control_vehiculos').focus();
			}
			else if(intCantidad == '')
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_servicios_internos_control_vehiculos').focus();
			}
			else
			{
				
				//Limpiamos las cajas de texto
				$('#txtRefaccionID_detalles_servicios_internos_control_vehiculos').val('');
				$('#txtRefaccion_detalles_servicios_internos_control_vehiculos').val('');
				$('#txtCantidad_detalles_servicios_internos_control_vehiculos').val('');

				//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
				if (!objTabla.rows.namedItem(intRefaccionID))
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaRefaccion = objRenglon.insertCell(0);
					var objCeldaCantidad = objRenglon.insertCell(1);
					var objCeldaAcciones = objRenglon.insertCell(2);

					objRenglon.setAttribute('id', intRefaccionID);
					objCeldaRefaccion.setAttribute('class', 'movil c1');
					objCeldaRefaccion.innerHTML = strRefaccion;
					objCeldaCantidad.setAttribute('class', 'movil c2');
					objCeldaCantidad.innerHTML = intCantidad;
					objCeldaAcciones.setAttribute('class', 'td-center movil c3');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalles_servicios_internos_control_vehiculos(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_detalles_servicios_internos_control_vehiculos(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				
				}
				else{

					objTabla.rows.namedItem(intRefaccionID).cells[0].innerHTML = strRefaccion;
					objTabla.rows.namedItem(intRefaccionID).cells[1].innerHTML = intCantidad;
					
				}
				//Enfocar caja de texto
				$('#txtRefaccion_detalles_servicios_internos_control_vehiculos').focus();
				
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_detalles_servicios_internos_control_vehiculos tr").length - 1;
			$('#numElementos_detalles_servicios_internos_control_vehiculos').html(intFilas);
			$('#txtNumDetalles_detalles_servicios_internos_control_vehiculos').val(intFilas);
		}

		
		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_servicios_internos_control_vehiculos(objRenglon)
		{			
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			if (objRenglon.parentNode.parentNode.id == $('#txtRefaccionID_detalles_servicios_internos_control_vehiculos').val()){

				$('#txtRefaccionID_detalles_servicios_internos_control_vehiculos, #txtRefaccion_detalles_servicios_internos_control_vehiculos, #txtCantidad_detalles_servicios_internos_control_vehiculos').val('');
			}
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_servicios_internos_control_vehiculos").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_detalles_servicios_internos_control_vehiculos tr").length - 1;
			$('#numElementos_detalles_servicios_internos_control_vehiculos').html(intFilas);

			//Enfocar caja de texto
			$('#txtRefaccion_detalles_servicios_internos_control_vehiculos').focus();
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_servicios_internos_control_vehiculos(objRenglon)
		{	
			//Asignar los valores a las cajas de texto
			$('#txtRefaccionID_detalles_servicios_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtRefaccion_detalles_servicios_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtCantidad_detalles_servicios_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			//Enfocar caja de texto
			$('#txtRefaccion_detalles_servicios_internos_control_vehiculos').focus();
		}
		


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
	        //Validar campos decimales (no hay necesidad de poner '.')
	        $('#txtHoras_servicios_internos_control_vehiculos').numeric();
	        $('#txtCantidad_detalles_servicios_internos_control_vehiculos').numeric();
        	
			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo_servicios_internos_control_vehiculos').focusout(function(e){
				//Si no existe id, verificar la existencia del código
				if ($('#txtServicioInternoID_servicios_internos_control_vehiculos').val() == '' && $('#txtCodigo_servicios_internos_control_vehiculos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código 
					editar_servicios_internos_control_vehiculos($('#txtCodigo_servicios_internos_control_vehiculos').val(), 'codigo', 'Nuevo');
				}
			});


			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_servicios_internos_control_vehiculos').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Pasar al renglón de arriba
	            	row.prev().before(row);
	            }
				
	        });

			//Autocomplete para obtener una refacción
	        $('#txtRefaccion_detalles_servicios_internos_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtRefaccionID_detalles_servicios_internos_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/refacciones/autocomplete",
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
	             $('#txtRefaccionID_detalles_servicios_internos_control_vehiculos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id de la refacción cuando pierda el enfoque la caja de texto
            $('#txtRefaccion_detalles_servicios_internos_control_vehiculos').focusout(function(e){
                //Si no existe id de la refacción
                if($('#txtRefaccionID_detalles_servicios_internos_control_vehiculos').val() == '' ||
                   $('#txtRefaccion_detalles_servicios_internos_control_vehiculos').val() == '')
                { 
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtRefaccionID_detalles_servicios_internos_control_vehiculos').val('');
                   $('#txtRefaccion_detalles_servicios_internos_control_vehiculos').val('');
                }

            });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_servicios_internos_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaServiciosInternosControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_servicios_internos_control_vehiculos();
			});

		
			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_servicios_internos_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_servicios_internos_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_servicios_internos_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				 objServiciosInternosControlVehiculos = $('#ServiciosInternosControlVehiculosBox').bPopup({
											   appendTo: '#ServiciosInternosControlVehiculosContent', 
				                               contentContainer: 'ServiciosInternosControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_servicios_internos_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_servicios_internos_control_vehiculos').focus();   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_servicios_internos_control_vehiculos();
		});
	</script>