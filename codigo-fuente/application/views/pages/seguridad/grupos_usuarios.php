	<div id="GruposUsuariosSeguridadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_grupos_usuarios_seguridad" action="#" method="post" tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_grupos_usuarios_seguridad" 
								   name="strBusqueda_grupos_usuarios_seguridad" 
								   type="text" value="" tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_grupos_usuarios_seguridad"
										onclick="paginacion_grupos_usuarios_seguridad();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_grupos_usuarios_seguridad" title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_grupos_usuarios_seguridad"
									onclick="reporte_grupos_usuarios_seguridad('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_grupos_usuarios_seguridad"
									onclick="reporte_grupos_usuarios_seguridad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Grupo"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_grupos_usuarios_seguridad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Grupo</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_grupos_usuarios_seguridad" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_grupos_usuarios_seguridad({{grupo_usuario_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_grupos_usuarios_seguridad({{grupo_usuario_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_grupos_usuarios_seguridad({{grupo_usuario_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_grupos_usuarios_seguridad({{grupo_usuario_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_grupos_usuarios_seguridad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_grupos_usuarios_seguridad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal -->
		<div id="GruposUsuariosSeguridadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_grupos_usuarios_seguridad" class="ModalBodyTitle">
				<h1>Grupos de Usuarios</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmGruposUsuariosSeguridad" method="post" action="#" class="form-horizontal" role="form" name="frmGruposUsuariosSeguridad" 
					  onsubmit="return(false)" autocomplete="off">
					<!--Descripción-->
					<div class="row">
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado --> 
									<input id="txtGrupoUsuarioID_grupos_usuarios_seguridad" name="intGrupoUsuarioID_grupos_usuarios_seguridad" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para guardar la descripción anterior en caso de ser edición --> 
									<input id="txtDescripcionAnterior_grupos_usuarios_seguridad" name="strDescripcionAnterior_grupos_usuarios_seguridad" 
										   type="hidden" value="">
									</input>
									<label for="txtDescripcion_grupos_usuarios_seguridad">Descripción</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtDescripcion_grupos_usuarios_seguridad" 
										   name="strDescripcion_grupos_usuarios_seguridad" 
										   type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Botón seleccionar accesos-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbPermisosAcceso_grupos_usuarios_seguridad">
										Agregar o quitar permisos
									</label>
								</div>
								<div class="col-md-12">
									<label for="chbPermisosAcceso_grupos_usuarios_seguridad" class="btn btn-info">
										Seleccionar todos
										<input type="checkbox" id="chbPermisosAcceso_grupos_usuarios_seguridad" 
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
					<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta para asignar los permisos de acceso del grupo de usuarios--> 
									<input id="txtPermisosAcceso_grupos_usuarios_seguridad" 
										   name="strPermisosAcceso_grupos_usuarios_seguridad" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Permisos de acceso</h4>
										</div>
										<div class="panel-body">
											<div id="treePermisos_grupos_usuarios_seguridad" class="md-list-item-text"></div>
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
							<button class="btn btn-success" id="btnGuardar_grupos_usuarios_seguridad"  
									onclick="validar_grupos_usuarios_seguridad();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_grupos_usuarios_seguridad"  
									onclick="cambiar_estatus_grupos_usuarios_seguridad('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_grupos_usuarios_seguridad"  
									onclick="cambiar_estatus_grupos_usuarios_seguridad('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_grupos_usuarios_seguridad"
									type="reset" aria-hidden="true" onclick="cerrar_grupos_usuarios_seguridad();" title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#GruposUsuariosSeguridadContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaGruposUsuariosSeguridad = 0;
		var strUltimaBusquedaGruposUsuariosSeguridad = "";
		//Variable que se utiliza para asignar objeto del modal
		var objGruposUsuariosSeguridad = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_grupos_usuarios_seguridad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('seguridad/grupos_usuarios/get_permisos_acceso',
			{
				strPermisosAcceso: $('#txtAcciones_grupos_usuarios_seguridad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosGruposUsuariosSeguridad = data.row;
					//Separar la cadena 
					var arrPermisosGruposUsuariosSeguridad = strPermisosGruposUsuariosSeguridad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosGruposUsuariosSeguridad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosGruposUsuariosSeguridad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_grupos_usuarios_seguridad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosGruposUsuariosSeguridad[i]=='GUARDAR') || (arrPermisosGruposUsuariosSeguridad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_grupos_usuarios_seguridad').removeAttr('disabled');
						}
						else if(arrPermisosGruposUsuariosSeguridad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_grupos_usuarios_seguridad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_grupos_usuarios_seguridad();
						}
						else if(arrPermisosGruposUsuariosSeguridad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_grupos_usuarios_seguridad').removeAttr('disabled');
							$('#btnRestaurar_grupos_usuarios_seguridad').removeAttr('disabled');
						}
						else if(arrPermisosGruposUsuariosSeguridad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_grupos_usuarios_seguridad').removeAttr('disabled');
						}
						else if(arrPermisosGruposUsuariosSeguridad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_grupos_usuarios_seguridad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_grupos_usuarios_seguridad() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_grupos_usuarios_seguridad').val() != strUltimaBusquedaGruposUsuariosSeguridad)
			{
				intPaginaGruposUsuariosSeguridad = 0;
				strUltimaBusquedaGruposUsuariosSeguridad = $('#txtBusqueda_grupos_usuarios_seguridad').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('seguridad/grupos_usuarios/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_grupos_usuarios_seguridad').val(),
						intPagina:intPaginaGruposUsuariosSeguridad,
						strPermisosAcceso: $('#txtAcciones_grupos_usuarios_seguridad').val()
					},
					function(data){
						$('#dg_grupos_usuarios_seguridad tbody').empty();
						var tmpGruposUsuariosSeguridad = Mustache.render($('#plantilla_grupos_usuarios_seguridad').html(), data);
						$('#dg_grupos_usuarios_seguridad tbody').html(tmpGruposUsuariosSeguridad);
						$('#pagLinks_grupos_usuarios_seguridad').html(data.paginacion);
						$('#numElementos_grupos_usuarios_seguridad').html(data.total_rows);
						intPaginaGruposUsuariosSeguridad = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_grupos_usuarios_seguridad(strTipo)
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'seguridad/grupos_usuarios/';

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
										'strBusqueda': $('#txtBusqueda_grupos_usuarios_seguridad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_grupos_usuarios_seguridad()
		{
			//Incializar formulario
			$('#frmGruposUsuariosSeguridad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_grupos_usuarios_seguridad();
			//Limpiar cajas de texto ocultas
			$('#frmGruposUsuariosSeguridad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_grupos_usuarios_seguridad');
			//Habilitar todos los elementos del formulario
			$('#frmGruposUsuariosSeguridad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_grupos_usuarios_seguridad").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_grupos_usuarios_seguridad").hide();
			$("#btnRestaurar_grupos_usuarios_seguridad").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_grupos_usuarios_seguridad()
		{
			try {
				//Cerrar modal
				objGruposUsuariosSeguridad.close();
				//Eliminar datos del treeview
				$("#treePermisos_grupos_usuarios_seguridad").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtBusqueda_grupos_usuarios_seguridad').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_grupos_usuarios_seguridad()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionados = [];

			//Recorremos el treeview
			$("#treePermisos_grupos_usuarios_seguridad").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionados.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtPermisosAcceso_grupos_usuarios_seguridad").val(arrSeleccionados.join('|'));

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_grupos_usuarios_seguridad();
			//Validación del formulario de campos obligatorios
			$('#frmGruposUsuariosSeguridad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {  
										strDescripcion_grupos_usuarios_seguridad: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										strPermisosAcceso_grupos_usuarios_seguridad: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un permiso de acceso para este grupo.'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_grupos_usuarios_seguridad = $('#frmGruposUsuariosSeguridad').data('bootstrapValidator');
			bootstrapValidator_grupos_usuarios_seguridad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_grupos_usuarios_seguridad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_grupos_usuarios_seguridad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_grupos_usuarios_seguridad()
		{
			try
			{
				$('#frmGruposUsuariosSeguridad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para registrar (o actualizar) los datos de un folio
		function guardar_grupos_usuarios_seguridad()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('seguridad/grupos_usuarios/guardar',
					{
						intGrupoUsuarioID: $('#txtGrupoUsuarioID_grupos_usuarios_seguridad').val(),
						strDescripcion: $('#txtDescripcion_grupos_usuarios_seguridad').val(),
						strDescripcionAnterior:$('#txtDescripcionAnterior_grupos_usuarios_seguridad').val(),
						strPermisosAcceso:$('#txtPermisosAcceso_grupos_usuarios_seguridad').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_grupos_usuarios_seguridad();
							//Hacer un llamado a la función para cerrar modal
							cerrar_grupos_usuarios_seguridad();
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_grupos_usuarios_seguridad(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_grupos_usuarios_seguridad(tipoMensaje, mensaje)
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
		function cambiar_estatus_grupos_usuarios_seguridad(id, estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtGrupoUsuarioID_grupos_usuarios_seguridad').val();

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
						              'title': 'Grupos de Usuarios',
						              'buttons': ['Aceptar', 'Cancelar'],
						              'onClose': function(caption) {
						                            if(caption == 'Aceptar')
						                            {

						                            	//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_grupos_usuarios_seguridad(intID, strTipo, 'INACTIVO');
														
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_grupos_usuarios_seguridad(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_grupos_usuarios_seguridad(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('seguridad/grupos_usuarios/set_estatus',
			      {intGrupoUsuarioID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_grupos_usuarios_seguridad();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_grupos_usuarios_seguridad();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_grupos_usuarios_seguridad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos al modal del registro seleccionado
		function editar_grupos_usuarios_seguridad(busqueda, tipoBusqueda, tipoAccion)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('seguridad/grupos_usuarios/get_datos', 
				   {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_grupos_usuarios_seguridad();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
							//Recuperar valores
							$('#txtGrupoUsuarioID_grupos_usuarios_seguridad').val(data.row.grupo_usuario_id);
							$('#txtDescripcion_grupos_usuarios_seguridad').val(data.row.descripcion);
							$('#txtDescripcionAnterior_grupos_usuarios_seguridad').val(data.row.descripcion);
							$('#txtPermisosAcceso_grupos_usuarios_seguridad').val(data.row.permisos);
							//Si el tipo de acción corresponde a Nuevo
						    if(tipoAccion == 'Nuevo')
						    {
						    	//Eliminar datos del treeview
								$("#treePermisos_grupos_usuarios_seguridad").fancytree("destroy");
						    }
							//Cargar el treeview
							get_treeview_procesos_grupos_usuarios_seguridad();
				            //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_grupos_usuarios_seguridad').addClass("estatus-" + strEstatus);
				             //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_grupos_usuarios_seguridad").show();
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
			            		$('#frmGruposUsuariosSeguridad').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_grupos_usuarios_seguridad").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_grupos_usuarios_seguridad").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
								//Abrir modal
								objGruposUsuariosSeguridad = $('#GruposUsuariosSeguridadBox').bPopup({appendTo: '#GruposUsuariosSeguridadContent', 
																						  contentContainer: 'GruposUsuariosSeguridadM', 
																						  zIndex: 2, 
																						  modalClose: false, 
																						  modal: true, 
																						  follow: [true,false], 
																						  followEasing : "linear", 
																						  easing: "linear", 
																						  modalColor: ('#F0F0F0')});
								//Enfocar caja de texto
								$('#txtDescripcion_grupos_usuarios_seguridad').focus();
							}
			       	    }
			       },
			       'json');
		}

		//Función que se utiliza para definir tree view de procesos y subprocesos
		function get_treeview_procesos_grupos_usuarios_seguridad()
		{
			$('#treePermisos_grupos_usuarios_seguridad').fancytree({
				source: {
					url: "seguridad/procesos/get_treeview/Grupo/" + $('#txtGrupoUsuarioID_grupos_usuarios_seguridad').val(),
					cache: false
				},
				checkbox: true,
				selectMode: 3
			});
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Comprobar la existencia de la descripción en la BD cuando pierda el enfoque la caja de texto
			$('#txtDescripcion_grupos_usuarios_seguridad').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtGrupoUsuarioID_grupos_usuarios_seguridad').val() == '' && $('#txtDescripcion_grupos_usuarios_seguridad').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_grupos_usuarios_seguridad($('#txtDescripcion_grupos_usuarios_seguridad').val(), 'descripcion', 'Nuevo');
				}
			});

			//Seleccionar o deseleccionar todos los nodos del tree view (árbol) cuando se de clic en el checkbox
			$('#chbPermisosAcceso_grupos_usuarios_seguridad').click(function(event) {
				//Si el checkbox se encuentra seleccionado
				if( $('#chbPermisosAcceso_grupos_usuarios_seguridad').is(':checked') ) {
					$("#treePermisos_grupos_usuarios_seguridad").fancytree("getTree").visit(function(node){
						node.setSelected(true);
					});
				}
				else
				{
					$("#treePermisos_grupos_usuarios_seguridad").fancytree("getTree").visit(function(node){
						node.setSelected(false);
					});
				}
			});
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_grupos_usuarios_seguridad').on('click', 'a', function(event){
				event.preventDefault();
				intPaginaGruposUsuariosSeguridad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_grupos_usuarios_seguridad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_grupos_usuarios_seguridad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_grupos_usuarios_seguridad();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_grupos_usuarios_seguridad').addClass("estatus-NUEVO");
				//Cargar el treeview
				get_treeview_procesos_grupos_usuarios_seguridad();
				//Abrir modal
				objGruposUsuariosSeguridad= $('#GruposUsuariosSeguridadBox').bPopup({appendTo: '#GruposUsuariosSeguridadContent', 
																		 contentContainer: 'GruposUsuariosSeguridadM', 
																		 zIndex: 2, 
																		 modalClose: false, 
																		 modal: true, 
																		 follow: [true,false], 
																		 followEasing : "linear", 
																		 easing: "linear", 
																		 modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_grupos_usuarios_seguridad').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_grupos_usuarios_seguridad').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_grupos_usuarios_seguridad();
		});
	</script>