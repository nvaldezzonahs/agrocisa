	<div id="UsuariosSeguridadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_usuarios_seguridad" action="#" method="post" tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_usuarios_seguridad" 
								   name="strBusqueda_usuarios_seguridad" 
								   type="text" value="" tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_usuarios_seguridad"
										onclick="paginacion_usuarios_seguridad();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_usuarios_seguridad" title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_usuarios_seguridad"
									onclick="reporte_usuarios_seguridad('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_usuarios_seguridad"
									onclick="reporte_usuarios_seguridad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Usuario"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Correo electrónico"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Empleado"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Sucursales"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_usuarios_seguridad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Usuario</th>
							<th class="movil">Correo electrónico</th>
							<th class="movil">Empleado</th>
							<th class="movil">Sucursales</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_usuarios_seguridad" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">
							<td class="movil">{{usuario}}</td>
							<td class="movil">{{correo_electronico}}</td>
							<td class="movil">{{empleado}}</td>
							<td class="movil">{{sucursales}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_usuarios_seguridad({{usuario_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_usuarios_seguridad({{usuario_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_usuarios_seguridad({{usuario_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_usuarios_seguridad({{usuario_id}},'{{estatus}}')" title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_usuarios_seguridad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_usuarios_seguridad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal -->
		<div id="UsuariosSeguridadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_usuarios_seguridad" class="ModalBodyTitle">
				<h1>Usuarios</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmUsuariosSeguridad" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmUsuariosSeguridad" onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Usuario-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado --> 
									<input id="txtUsuarioID_usuarios_seguridad" name="intUsuarioID_usuarios_seguridad" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para guardar el usuario anterior en caso de ser edición -->
									<input id="txtUsuarioAnterior_usuarios_seguridad" name="strUsuarioAnterior_usuarios_seguridad" 
										   type="hidden" value="">
									</input>
									<label for="txtUsuario_usuarios_seguridad">Usuario</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtUsuario_usuarios_seguridad" name="strUsuario_usuarios_seguridad" 
										   type="text" value="" tabindex="1" placeholder="Ingrese usuario" maxlength="30">
									</input>
								</div>
							</div>
						</div>
						<!--Correo electrónico-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCorreoElectronico_usuarios_seguridad">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtCorreoElectronico_usuarios_seguridad" 
										   name="strCorreoElectronico_usuarios_seguridad" type="text" value="" 
										   tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Contraseña-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtContrasena_usuarios_seguridad">Contraseña</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtContrasena_usuarios_seguridad" 
										   name="strContrasena_usuarios_seguridad" type="password" value="" 
										   tabindex="1" placeholder="Ingrese contraseña" maxlength="12">
									</input>
								</div>
							</div>
						</div>
						<!--Confirmar contraseña-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtConfirmarContrasena_usuarios_seguridad">Confirmar contraseña</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtConfirmarContrasena_usuarios_seguridad" 
										   name="strConfirmarContrasena_usuarios_seguridad" type="password" value="" 
										   tabindex="1" placeholder="Confirme contraseña" maxlength="12">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Empleado-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado --> 
									<input id="txtEmpleadoID_usuarios_seguridad" name="intEmpleadoID_usuarios_seguridad" 
										   type="hidden" value="">
									</input>
									<label for="txtEmpleado_usuarios_seguridad">Empleado</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtEmpleado_usuarios_seguridad" 
										   name="strEmpleado_usuarios_seguridad" 
										   type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Permisos de acceso</h4>
										</div>
										<div class="panel-body">
											<!--Columna izquierda-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="row">
													<!--Sucursal-->
													<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbSucursal_usuarios_seguridad">Sucursal de acceso</label>
															</div>
															<div class="col-md-12">
																<select class="form-control" id="cmbSucursal_usuarios_seguridad" 
																		name="intSucursalID_usuarios_seguridad" tabindex="1">
																</select>
															</div>
														</div>
													</div>
													<!--Botón seleccionar accesos-->
													<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="chbPermisosAcceso_usuarios_seguridad">
																	Agregar o quitar permisos
																</label>
															</div>
															<div class="col-md-12">
																<label for="chbPermisosAcceso_usuarios_seguridad" class="btn btn-info">
																	Seleccionar todos
																	<input type="checkbox" id="chbPermisosAcceso_usuarios_seguridad" 
																		   class="badgebox" tabindex="1">
																	</input>
																	<span title="Seleccionar o deseleccionar todos los permisos de acceso"
																		  class="badge">
																		&check;
																	</span>
																</label>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Treeview grupos de usuarios-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para asignar los grupos seleccionados --> 
																<input  id="txtGrupos_usuarios_seguridad" 
																	   name="strGrupos_usuarios_seguridad" type="hidden" value="">
																</input>
																<label for="treeGrupos_usuarios_seguridad">Grupos de usuarios</label>
															</div>
															<div class="col-md-12">
																<div id="treeGrupos_usuarios_seguridad" class="md-list-item-text"></div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Actualizar permisos del grupo-->
													<div class="col-sm-10 col-md-10 col-lg-10 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="btnActualizarPermisos_usuarios_seguridad">
																	Asignar permisos de los grupos seleccionados
																</label>
															</div>
														</div>
													</div>
													<!--Botón actualizar permisos-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
														<div class="form-group">
															<div class="col-md-12">
																<button id="btnActualizarPermisos_usuarios_seguridad" 
																		class="btn btn-update" tabindex="1" title="Actualizar permisos"
																		onclick="actualizar_permisos_usuarios_seguridad();">
																	<span class="glyphicon glyphicon-refresh"></span>
																</button> 
															</div>
														</div>
													</div>
												</div>
											</div>
											<!--Columna derecha-->
											<!--TreeView de permisos-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<!-- Caja de texto oculta para asignar los permisos de acceso del usuario --> 
														<input  id="txtPermisosAcceso_usuarios_seguridad" 
															   name="strPermisosAcceso_usuarios_seguridad" type="hidden" value="">
														</input>
														<label for="treePermisos_usuarios_seguridad">Permisos del usuario</label>
													</div>
													<div class="col-md-12">
														<div id="treePermisos_usuarios_seguridad" class="md-list-item-text"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_usuarios_seguridad"  
									onclick="validar_usuarios_seguridad();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_usuarios_seguridad"  
									onclick="cambiar_estatus_usuarios_seguridad('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_usuarios_seguridad"  
									onclick="cambiar_estatus_usuarios_seguridad('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_usuarios_seguridad"
									type="reset" aria-hidden="true" onclick="cerrar_usuarios_seguridad();" title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#UsuariosSeguridadContent -->

	<!--Plantilla para cargar las sucursales en el combobox-->
	<script id="sucursales_usuarios_seguridad" type="text/template">
		<option value="0">Seleccione una sucursal</option>
		{{#sucursales}}
		<option value="{{value}}">{{nombre}}</option>
		{{/sucursales}} 
	</script>

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaUsuariosSeguridad = 0;
		var strUltimaBusquedaUsuariosSeguridad = "";
		//Variable que se utiliza para asignar objeto del modal
		var objUsuariosSeguridad = null;

		//Permisos de acceso del usuario (Acciones Generales)
		function permisos_usuarios_seguridad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('seguridad/usuarios/get_permisos_acceso',
			{
				strPermisosAcceso: $('#txtAcciones_usuarios_seguridad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosUsuariosSeguridad = data.row;
					//Separar la cadena 
					var arrPermisosUsuariosSeguridad = strPermisosUsuariosSeguridad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosUsuariosSeguridad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosUsuariosSeguridad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_usuarios_seguridad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosUsuariosSeguridad[i]=='GUARDAR') || (arrPermisosUsuariosSeguridad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_usuarios_seguridad').removeAttr('disabled');
						}
						else if(arrPermisosUsuariosSeguridad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_usuarios_seguridad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_usuarios_seguridad();
						}
						else if(arrPermisosUsuariosSeguridad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_usuarios_seguridad').removeAttr('disabled');
							$('#btnRestaurar_usuarios_seguridad').removeAttr('disabled');
						}
						else if(arrPermisosUsuariosSeguridad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_usuarios_seguridad').removeAttr('disabled');
						}
						else if(arrPermisosUsuariosSeguridad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_usuarios_seguridad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_usuarios_seguridad() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_usuarios_seguridad').val() != strUltimaBusquedaUsuariosSeguridad)
			{
				intPaginaUsuariosSeguridad = 0;
				strUltimaBusquedaUsuariosSeguridad = $('#txtBusqueda_usuarios_seguridad').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('seguridad/usuarios/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_usuarios_seguridad').val(),
						intPagina:intPaginaUsuariosSeguridad,
						strPermisosAcceso: $('#txtAcciones_usuarios_seguridad').val()
					},
					function(data){
						$('#dg_usuarios_seguridad tbody').empty();
						var tmpUsuariosSeguridad = Mustache.render($('#plantilla_usuarios_seguridad').html(), data);
						$('#dg_usuarios_seguridad tbody').html(tmpUsuariosSeguridad);
						$('#pagLinks_usuarios_seguridad').html(data.paginacion);
						$('#numElementos_usuarios_seguridad').html(data.total_rows);
						intPaginaUsuariosSeguridad = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_usuarios_seguridad(strTipo)
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'seguridad/usuarios/';

			//Si el tipo de reporte es PDF
			if(strTipo == 'PDF')
			{
				//Concatenar nombre de la función que genera el reporte PDF
				strUrl += 'get_reporte';
			}
			else
			{
				//Concatenar nombre de la función que genera el archivo XLS
				strUrl += 'get_xls';
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'strBusqueda': $('#txtBusqueda_usuarios_seguridad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_usuarios_seguridad()
		{
			//Incializar formulario
			$('#frmUsuariosSeguridad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_usuarios_seguridad();
			//Limpiar cajas de texto ocultas
			$('#frmUsuariosSeguridad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_usuarios_seguridad');
			//Habilitar todos los elementos del formulario
			$('#frmUsuariosSeguridad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Habilitar botón Actualizar permisos
			$("#btnActualizarPermisos_usuarios_seguridad").removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_usuarios_seguridad").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_usuarios_seguridad").hide();
			$("#btnRestaurar_usuarios_seguridad").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_usuarios_seguridad()
		{
			try {
				//Cerrar modal
				objUsuariosSeguridad.close();
				//Eliminar datos del treeview grupos
				$("#treeGrupos_usuarios_seguridad").fancytree("destroy");
				//Eliminar datos del treeview permisos
				$("#treePermisos_usuarios_seguridad").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtBusqueda_usuarios_seguridad').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_usuarios_seguridad()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionados = [];

			//Recorremos el treeview
			$("#treePermisos_usuarios_seguridad").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionados.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtPermisosAcceso_usuarios_seguridad").val(arrSeleccionados.join('|'));

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_usuarios_seguridad();
			//Validación del formulario de campos obligatorios
			$('#frmUsuariosSeguridad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {  
										strUsuario_usuarios_seguridad: {
											validators: {
												notEmpty: {
													message: 'Escriba un nombre de usuario'
												},
												stringLength: {
													min: 6,
													max: 30,
													message: 'El nombre de usuario debe tener entre 6 y 30 caracteres de logitud'
												},
												regexp: { 
													regexp: /^[a-zA-Z0-9._]+$/,
													message: 'El nombre de usuario sólo puede tener letras, números, punto y guion bajo'
												}
											}
										},
										strContrasena_usuarios_seguridad: {
											validators: {
												stringLength: {
													min: 8,
													max: 12,
													message: 'La contraseña debe tener entre 8 y 12 caracteres de logitud'
												},
												identical: {
													field: 'strConfirmarContrasena_usuarios_seguridad',
													message: 'La contraseña y su confirmación no son iguales'
												}
											}
										},
										strConfirmarContrasena_usuarios_seguridad: {
											validators: {
												identical: {
													field: 'strContrasena_usuarios_seguridad',
													message: 'La contraseña y su confirmación no son iguales'
												}
											}
										},
										strCorreoElectronico_usuarios_seguridad: {
											validators: {
												notEmpty: {
													message: 'Escriba un correo electrónico'
												},
												regexp: {
													regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
													message: 'Escriba una dirección de correo electrónico válida'
												}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_usuarios_seguridad = $('#frmUsuariosSeguridad').data('bootstrapValidator');
			bootstrapValidator_usuarios_seguridad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_usuarios_seguridad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_usuarios_seguridad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_usuarios_seguridad()
		{
			try
			{
				$('#frmUsuariosSeguridad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para registrar (o actualizar) los datos de un folio
		function guardar_usuarios_seguridad()
		{
			//Bandera para validar si el registro se puede guardar o no
			var bolValidacion_usuarios_seguridad = true;
			//Si no existe id del usuario (usuario nuevo) y no se le asignó contraseña, se desactiva la bandera
			if (($('#txtUsuarioID_usuarios_seguridad').val() == '') && ($('#txtContrasena_usuarios_seguridad').val() == ''))
			{
				mensaje_usuarios_seguridad('error', 'Proporcione una contraseña para el usuario');
				bolValidacion_usuarios_seguridad = false;
			}

			//Si se cumplen las reglas de validación, se envía a guardar el registro
			if (bolValidacion_usuarios_seguridad)
			{
				//Hacer un llamado al método del controlador para guardar los datos del registro
				$.post('seguridad/usuarios/guardar',
						{
							intUsuarioID: $('#txtUsuarioID_usuarios_seguridad').val(),
							intEmpleadoID: $('#txtEmpleadoID_usuarios_seguridad').val(),
							strUsuario: $('#txtUsuario_usuarios_seguridad').val(),
							strUsuarioAnterior: $('#txtUsuarioAnterior_usuarios_seguridad').val(), 
							strContrasena: $('#txtContrasena_usuarios_seguridad').val(), 
							strCorreoElectronico: $('#txtCorreoElectronico_usuarios_seguridad').val(), 
							intSucursalID: $('#cmbSucursal_usuarios_seguridad').val(),
							strPermisosAcceso: $('#txtPermisosAcceso_usuarios_seguridad').val()
						},
						function(data) {
							if (data.resultado)
							{
								//Hacer llamado a la función  para cargar los registros en el grid
								paginacion_usuarios_seguridad();
								//Hacer un llamado a la función para cerrar modal
								cerrar_usuarios_seguridad();
							}
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_usuarios_seguridad(data.tipo_mensaje, data.mensaje);
						},
				'json');
			}
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_usuarios_seguridad(tipoMensaje, mensaje)
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
		function cambiar_estatus_usuarios_seguridad(id, estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtUsuarioID_usuarios_seguridad').val();

			}
			else
			{
				intID = id;
				strTipo = 'gridview';
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
						             {'type': 'question',
						              'title': 'Usuarios',
						              'buttons': ['Aceptar', 'Cancelar'],
						              'onClose': function(caption) {
						                            if(caption == 'Aceptar')
						                            {

						                            	//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_usuarios_seguridad(intID, strTipo, 'INACTIVO');
														
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO/SUSPENDIDO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_usuarios_seguridad(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_usuarios_seguridad(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('seguridad/usuarios/set_estatus',
			      {intUsuarioID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_usuarios_seguridad();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_usuarios_seguridad();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_usuarios_seguridad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos al modal del registro seleccionado
		function editar_usuarios_seguridad(busqueda, tipoBusqueda, tipoAccion)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('seguridad/usuarios/get_datos', 
				   {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
				   },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_usuarios_seguridad();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
							//Recuperar valores
							$('#txtUsuarioID_usuarios_seguridad').val(data.row.usuario_id);
							$('#txtUsuario_usuarios_seguridad').val(data.row.usuario);
							$('#txtUsuarioAnterior_usuarios_seguridad').val(data.row.usuario);
							$('#txtEmpleadoID_usuarios_seguridad').val(data.row.empleado_id);
							$('#txtEmpleado_usuarios_seguridad').val(data.row.empleado);
							$('#txtCorreoElectronico_usuarios_seguridad').val(data.row.correo_electronico);
							$('#txtPermisosAcceso_usuarios_seguridad').val('');
				            //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_usuarios_seguridad').addClass("estatus-" + strEstatus);
				            //Cargar los treeview
							get_treeview_grupos_usuarios_seguridad();
							get_treeview_procesos_usuarios_seguridad();

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_usuarios_seguridad").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmUsuariosSeguridad').find('input, textarea, select').attr('disabled','disabled');
			            		//Deshabilitar botón Actualizar permisos
			            		$("#btnActualizarPermisos_usuarios_seguridad").attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_usuarios_seguridad").hide();
								//Mostrar botón Restaurar
								$("#btnRestaurar_usuarios_seguridad").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
								//Abrir modal
								objUsuariosSeguridad = $('#UsuariosSeguridadBox').bPopup({appendTo: '#UsuariosSeguridadContent', 
																						  contentContainer: 'UsuariosSeguridadM', 
																						  zIndex: 2, 
																						  modalClose: false, 
																						  modal: true, 
																						  follow: [true,false], 
																						  followEasing : "linear", 
																						  easing: "linear", 
																						  modalColor: ('#F0F0F0')});
								//Enfocar caja de texto
								$('#txtUsuario_usuarios_seguridad').focus();
						    }
			       	    }
			       },
			       'json');
		}

		//Función que se utiliza para definir tree view de procesos y subprocesos
		function get_treeview_procesos_usuarios_seguridad()
		{
			$('#treePermisos_usuarios_seguridad').fancytree({
				source: {
					url: "seguridad/procesos/get_treeview/Usuario/" + 
						 $('#txtUsuarioID_usuarios_seguridad').val() + "/" + 
						 $('#cmbSucursal_usuarios_seguridad').val(),
					cache: false
				},
				checkbox: true,
				selectMode: 3
			});
		}

		//Función que se utiliza para definir tree view de grupos de usuarios
		function get_treeview_grupos_usuarios_seguridad()
		{
			$('#treeGrupos_usuarios_seguridad').fancytree({
				source: {
					url: "seguridad/grupos_usuarios/get_treeview/",
					cache: false
				},
				checkbox: true,
				selectMode: 3
			});
		}

		//Regresar sucursales activas para cargarlas en el combobox
		function cargar_sucursales_usuarios_seguridad()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box', {},
				function(data)
				{
					$('#cmbSucursal_usuarios_seguridad').empty();
					var temp = Mustache.render($('#sucursales_usuarios_seguridad').html(), data);
					$('#cmbSucursal_usuarios_seguridad').html(temp);
				},
				'json');
		}

		//Función que se utiliza para asignar los permisos de los grupos seleccionados
		function actualizar_permisos_usuarios_seguridad()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionados = [];
			//Inicializar arreglo con los permisos de los grupos seleccionados
			var arrPermisosGrupos = [];
			//Inicializar string para los permisos de los grupos seleccionados
			var strPermisosGrupos = '';

			//Recorremos el treeview de grupos
			$("#treeGrupos_usuarios_seguridad").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado
				if (node.selected){
					if (strPermisosGrupos != ''){
						strPermisosGrupos = strPermisosGrupos + '|';
					}
					strPermisosGrupos = strPermisosGrupos + node.data.permisos;
				}
			});

			//Separar los permisos de los grupos seleccionados y asignarlos al array
			arrPermisosGrupos = strPermisosGrupos.split('|');

			//Recorremos el treeview de permisos
			$("#treePermisos_usuarios_seguridad").fancytree("getTree").visit(function(node){
				//Si el nodo está dentro de los nodos del grupo, se selecciona, si no, se deselecciona
				node.setSelected(arrPermisosGrupos.includes(node.key));
			});
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Comprobar la existencia del nombre de usuario en la BD cuando pierda el enfoque la caja de texto
			$('#txtUsuario_usuarios_seguridad').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtUsuarioID_usuarios_seguridad').val() == '' && $('#txtUsuario_usuarios_seguridad').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el nombre de usuario 
					editar_usuarios_seguridad($('#txtUsuario_usuarios_seguridad').val(), 'usuario', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de un empleado
			$('#txtEmpleado_usuarios_seguridad').autocomplete({
				source: function( request, response ) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtEmpleadoID_usuarios_seguridad').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "recursos_humanos/empleados/autocomplete",
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
					$('#txtEmpleadoID_usuarios_seguridad').val(ui.item.data);
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

			//Verificar que exista id del empleado cuando pierda el enfoque la caja de texto
	        $('#txtEmpleado_usuarios_seguridad').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoID_usuarios_seguridad').val() == '' ||
	               $('#txtEmpleado_usuarios_seguridad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEmpleadoID_usuarios_seguridad').val('');
	               $('#txtEmpleado_usuarios_seguridad').val('');
	            }
	            
	        });

	        //Cargar los permisos de la sucursal cuando cambie la opción del combobox
			$('#cmbSucursal_usuarios_seguridad').change(function(e){
				//Eliminar datos del treeview permisos
				$("#treePermisos_usuarios_seguridad").fancytree("destroy");	
				//Desmarcar checkbox de permisos de acceso
				$("#chbPermisosAcceso_usuarios_seguridad").prop("checked", false); 
				//Actualizar tree view de procesos
				get_treeview_procesos_usuarios_seguridad();
			});

			//Seleccionar o deseleccionar todos los nodos del tree view (árbol) cuando se de clic en el checkbox
			$('#chbPermisosAcceso_usuarios_seguridad').click(function(event) {
				//Si el checkbox se encuentra seleccionado
				if( $('#chbPermisosAcceso_usuarios_seguridad').is(':checked') ) {
					$("#treePermisos_usuarios_seguridad").fancytree("getTree").visit(function(node){
						node.setSelected(true);
					});
				}
				else
				{
					$("#treePermisos_usuarios_seguridad").fancytree("getTree").visit(function(node){
						node.setSelected(false);
					});
				}
			});
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_usuarios_seguridad').on('click', 'a', function(event){
				event.preventDefault();
				intPaginaUsuariosSeguridad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_usuarios_seguridad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_usuarios_seguridad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_usuarios_seguridad();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_usuarios_seguridad').addClass("estatus-NUEVO");
				//Cargar los treeview
				get_treeview_grupos_usuarios_seguridad();
				get_treeview_procesos_usuarios_seguridad();
				//Abrir modal
				objUsuariosSeguridad= $('#UsuariosSeguridadBox').bPopup({appendTo: '#UsuariosSeguridadContent', 
																		 contentContainer: 'UsuariosSeguridadM', 
																		 zIndex: 2, 
																		 modalClose: false, 
																		 modal: true, 
																		 follow: [true,false], 
																		 followEasing : "linear", 
																		 easing: "linear", 
																		 modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtUsuario_usuarios_seguridad').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_usuarios_seguridad').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_usuarios_seguridad();
			//Cargar sucursales activas en el combo del modal
			cargar_sucursales_usuarios_seguridad();
		});
	</script>