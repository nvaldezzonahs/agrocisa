	<div id="EmpleadosIncidenciasRecursosHumanosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_empleados_incidencias_recursos_humanos" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_empleados_incidencias_recursos_humanos" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_empleados_incidencias_recursos_humanos">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_empleados_incidencias_recursos_humanos'>
				                    <input class="form-control" id="txtFechaInicialBusq_empleados_incidencias_recursos_humanos"
				                    		name= "strFechaInicialBusq_empleados_incidencias_recursos_humanos" 
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
								<label for="txtFechaFinalBusq_empleados_incidencias_recursos_humanos">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_empleados_incidencias_recursos_humanos'>
				                    <input class="form-control" id="txtFechaFinalBusq_empleados_incidencias_recursos_humanos"
				                    		name= "strFechaFinalBusq_empleados_incidencias_recursos_humanos" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los empleados activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
								<input id="txtEmpleadoIDBusq_empleados_incidencias_recursos_humanos" 
									   name="intEmpleadoIDBusq_empleados_incidencias_recursos_humanos"  type="hidden" 
									   value="">
								</input>
								<label for="txtEmpleadoBusq_empleados_incidencias_recursos_humanos">Empleado</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtEmpleadoBusq_empleados_incidencias_recursos_humanos" 
										name="strEmpleadoBusq_empleados_incidencias_recursos_humanos" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_empleados_incidencias_recursos_humanos">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_empleados_incidencias_recursos_humanos" 
								 		name="strEstatusBusq_empleados_incidencias_recursos_humanos" tabindex="1">
								    <option value="TODOS">TODOS</option>
	                  				<option value="ACTIVO">ACTIVO</option>
	                  				<option value="INACTIVO">INACTIVO</option>
	             				</select>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Descripción-->
					<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_empleados_incidencias_recursos_humanos">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_empleados_incidencias_recursos_humanos" 
										name="strBusqueda_empleados_incidencias_recursos_humanos" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
			    	<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_empleados_incidencias_recursos_humanos"
									onclick="paginacion_empleados_incidencias_recursos_humanos();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_empleados_incidencias_recursos_humanos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_empleados_incidencias_recursos_humanos"
									onclick="reporte_empleados_incidencias_recursos_humanos('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_empleados_incidencias_recursos_humanos"
									onclick="reporte_empleados_incidencias_recursos_humanos('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Fecha"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Empleado"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_empleados_incidencias_recursos_humanos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Fecha</th>
							<th class="movil">Empleado</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:13em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_empleados_incidencias_recursos_humanos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{empleado}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_empleados_incidencias_recursos_humanos({{incidencia_id}},'id','Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_empleados_incidencias_recursos_humanos({{incidencia_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Subir archivo-->
								<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
									<span class="btn  btn-default btn-xs fileinput-button ">
								    	<span class="fa fa-upload"></span>
										<input type="file" name="archivo_empleados_incidencias_recursos_humanos{{incidencia_id}}" id="archivo_empleados_incidencias_recursos_humanos{{incidencia_id}}"  
											   onchange="subir_archivo_grid_empleados_incidencias_recursos_humanos({{incidencia_id}},{{empleado_id}});">
								  		</input>
								    </span>
								</span>
                            	<!--Descargar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivo_empleados_incidencias_recursos_humanos({{incidencia_id}}, {{empleado_id}});" title="Descargar archivo">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
                            	<!--Eliminar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}" 
                            			 onmousedown="eliminar_archivo_empleados_incidencias_recursos_humanos({{incidencia_id}}, {{empleado_id}});" title="Eliminar archivo">
                            		<span class="glyphicon glyphicon-export"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_empleados_incidencias_recursos_humanos({{incidencia_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_empleados_incidencias_recursos_humanos({{incidencia_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_empleados_incidencias_recursos_humanos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_empleados_incidencias_recursos_humanos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="EmpleadosIncidenciasRecursosHumanosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_empleados_incidencias_recursos_humanos"  class="ModalBodyTitle">
			<h1>Incidencias</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEmpleadosIncidenciasRecursosHumanos" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmEmpleadosIncidenciasRecursosHumanos"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtIncidenciaID_empleados_incidencias_recursos_humanos" 
										   name="intIncidenciaID_empleados_incidencias_recursos_humanos" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la fecha anterior y así evitar duplicidad en caso de que exista otro registro con el mismo empleado en la fecha-->
									<input id="txtFechaAnterior_empleados_incidencias_recursos_humanos" 
										   name="strFechaAnterior_empleados_incidencias_recursos_humanos" type="hidden" value="">
									</input>
									<label for="txtFecha_empleados_incidencias_recursos_humanos">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_empleados_incidencias_recursos_humanos'>
					                    <input class="form-control" id="txtFecha_empleados_incidencias_recursos_humanos"
					                    		name= "strFecha_empleados_incidencias_recursos_humanos" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los empleados activos-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
									<input id="txtEmpleadoID_empleados_incidencias_recursos_humanos" 
										   name="intEmpleadoID_empleados_incidencias_recursos_humanos"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el empleado anterior y así evitar duplicidad en caso de que exista otro registro con el mismo empleado en la fecha-->
									<input id="txtEmpleadoIDAnterior_empleados_incidencias_recursos_humanos" 
											name="strEmpleadoIDAnterior_empleados_incidencias_recursos_humanos" type="hidden" value="">
									</input>
									<label for="txtEmpleado_empleados_incidencias_recursos_humanos">Empleado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEmpleado_empleados_incidencias_recursos_humanos" 
											name="strEmpleado_empleados_incidencias_recursos_humanos" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Comentario-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtComentario_empleados_incidencias_recursos_humanos">Comentario</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtComentario_empleados_incidencias_recursos_humanos" 
											   name="strComentario_empleados_incidencias_recursos_humanos" rows="3" value="" tabindex="1" placeholder="Ingrese comentario" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_empleados_incidencias_recursos_humanos"  
									onclick="validar_empleados_incidencias_recursos_humanos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Subir archivo-->
		                    <span  class="fileupload-buttonbar" tabindex="3">
		                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_empleados_incidencias_recursos_humanos" disabled>
		                        	<span class="fa fa-upload"></span>
		                        	<input id="archivo_empleados_incidencias_recursos_humanos" 
		                        		   name="archivo_empleados_incidencias_recursos_humanos" type="file"  
		                        		   onchange="subir_archivo_modal_empleados_incidencias_recursos_humanos('Editar');">
		                        	</input>
		                        </span>
		                    </span>
		                    <!--Descargar archivo-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_empleados_incidencias_recursos_humanos"  
									onclick="descargar_archivo_empleados_incidencias_recursos_humanos('', '');"  title="Descargar archivo" tabindex="4" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Eliminar archivo-->
							<button class="btn btn-default" id="btnEliminarArchivo_empleados_incidencias_recursos_humanos"  
									onclick="eliminar_archivo_empleados_incidencias_recursos_humanos('', '')"  title="Eliminar archivo" tabindex="5" disabled>
								<span class="glyphicon glyphicon-export"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_empleados_incidencias_recursos_humanos"  
									onclick="cambiar_estatus_empleados_incidencias_recursos_humanos('','ACTIVO');"  title="Desactivar" tabindex="6" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_empleados_incidencias_recursos_humanos"  
									onclick="cambiar_estatus_empleados_incidencias_recursos_humanos('','INACTIVO');"  title="Restaurar" tabindex="7" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_empleados_incidencias_recursos_humanos"
									type="reset" aria-hidden="true" onclick="cerrar_empleados_incidencias_recursos_humanos();" 
									title="Cerrar"  tabindex="8">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#EmpleadosIncidenciasRecursosHumanosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaEmpleadosIncidenciasRecursosHumanos = 0;
		var strUltimaBusquedaEmpleadosIncidenciasRecursosHumanos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objEmpleadosIncidenciasRecursosHumanos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_empleados_incidencias_recursos_humanos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('recursos_humanos/empleados_incidencias/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_empleados_incidencias_recursos_humanos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosEmpleadosIncidenciasRecursosHumanos = data.row;
					//Separar la cadena 
					var arrPermisosEmpleadosIncidenciasRecursosHumanos = strPermisosEmpleadosIncidenciasRecursosHumanos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosEmpleadosIncidenciasRecursosHumanos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosEmpleadosIncidenciasRecursosHumanos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_empleados_incidencias_recursos_humanos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosEmpleadosIncidenciasRecursosHumanos[i]=='GUARDAR') || (arrPermisosEmpleadosIncidenciasRecursosHumanos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_empleados_incidencias_recursos_humanos').removeAttr('disabled');
						}
						//Si el indice es ADJUNTAR
						else if(arrPermisosEmpleadosIncidenciasRecursosHumanos[i]=='ADJUNTAR')
						{
							//Habilitar el control (botón adjuntar)
							$('#btnAdjuntar_empleados_incidencias_recursos_humanos').removeAttr('disabled');
							//Habilitar el control (botón eliminar archivo)
							$('#btnEliminarArchivo_empleados_incidencias_recursos_humanos').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosEmpleadosIncidenciasRecursosHumanos[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_empleados_incidencias_recursos_humanos').removeAttr('disabled');
						}
						else if(arrPermisosEmpleadosIncidenciasRecursosHumanos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_empleados_incidencias_recursos_humanos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_empleados_incidencias_recursos_humanos();
						}
						else if(arrPermisosEmpleadosIncidenciasRecursosHumanos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_empleados_incidencias_recursos_humanos').removeAttr('disabled');
							$('#btnRestaurar_empleados_incidencias_recursos_humanos').removeAttr('disabled');
						}
						else if(arrPermisosEmpleadosIncidenciasRecursosHumanos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_empleados_incidencias_recursos_humanos').removeAttr('disabled');
						}
						else if(arrPermisosEmpleadosIncidenciasRecursosHumanos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_empleados_incidencias_recursos_humanos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_empleados_incidencias_recursos_humanos() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaEmpleadosIncidenciasRecursosHumanos =($('#txtFechaInicialBusq_empleados_incidencias_recursos_humanos').val()+$('#txtFechaFinalBusq_empleados_incidencias_recursos_humanos').val()+$('#txtEmpleadoIDBusq_empleados_incidencias_recursos_humanos').val()+$('#cmbEstatusBusq_empleados_incidencias_recursos_humanos').val()+$('#txtBusqueda_empleados_incidencias_recursos_humanos').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaEmpleadosIncidenciasRecursosHumanos != strUltimaBusquedaEmpleadosIncidenciasRecursosHumanos)
			{
				intPaginaEmpleadosIncidenciasRecursosHumanos = 0;
				strUltimaBusquedaEmpleadosIncidenciasRecursosHumanos = strNuevaBusquedaEmpleadosIncidenciasRecursosHumanos;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('recursos_humanos/empleados_incidencias/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_empleados_incidencias_recursos_humanos').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_empleados_incidencias_recursos_humanos').val()),
					 intEmpleadoID: $('#txtEmpleadoIDBusq_empleados_incidencias_recursos_humanos').val(),
					 strEstatus: $('#cmbEstatusBusq_empleados_incidencias_recursos_humanos').val(),
					 strBusqueda: $('#txtBusqueda_empleados_incidencias_recursos_humanos').val(),
					 intPagina: intPaginaEmpleadosIncidenciasRecursosHumanos,
					 strPermisosAcceso: $('#txtAcciones_empleados_incidencias_recursos_humanos').val()
					},
					function(data){
						$('#dg_empleados_incidencias_recursos_humanos tbody').empty();
						var tmpEmpleadosIncidenciasRecursosHumanos = Mustache.render($('#plantilla_empleados_incidencias_recursos_humanos').html(),data);
						$('#dg_empleados_incidencias_recursos_humanos tbody').html(tmpEmpleadosIncidenciasRecursosHumanos);
						$('#pagLinks_empleados_incidencias_recursos_humanos').html(data.paginacion);
						$('#numElementos_empleados_incidencias_recursos_humanos').html(data.total_rows);
						intPaginaEmpleadosIncidenciasRecursosHumanos = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_empleados_incidencias_recursos_humanos(strTipo) 
		{	
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'recursos_humanos/empleados_incidencias/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_empleados_incidencias_recursos_humanos').val()),
										'dteFechaFinal':$.formatFechaMysql($('#txtFechaFinalBusq_empleados_incidencias_recursos_humanos').val()),
										'intEmpleadoID': $('#txtEmpleadoIDBusq_empleados_incidencias_recursos_humanos').val(),
										'strEstatus': $('#cmbEstatusBusq_empleados_incidencias_recursos_humanos').val(),
										'strBusqueda': $('#txtBusqueda_empleados_incidencias_recursos_humanos').val()
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
			
		}

		
		//Función para subir archivo (o imagen) de un registro desde el grid view
		function subir_archivo_grid_empleados_incidencias_recursos_humanos(incidenciaID, empleadoID)
		{
			//Variable que se utiliza para asignar archivo
			var strBotonArchivoIDGridEmpleadosIncidenciasRecursosHumanos="archivo_empleados_incidencias_recursos_humanos"+incidenciaID;
			//Obtenemos un array con los datos del archivo
	        var file = $("#"+strBotonArchivoIDGridEmpleadosIncidenciasRecursosHumanos)[0].files[0];
	        //Variable que se utiliza para asignar la extensión del archivo seleccionado
   			var fileExtension = "";
	        //Obtenemos el nombre del archivo
	        var fileName = file.name;
	        //Obtenemos la extensión del archivo
	        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
	        //Obtenemos el tamaño del archivo
	        var fileSize = file.size;
	        //Obtenemos el tipo de archivo image/png ejemplo
	        var fileType = file.type;

	        //Comprobar extensión del archivo
	        $.post('cuentas_cobrar/clientes/comprobar_extension_archivo',
				     {strExtension: fileExtension
				     },
				     function(data) {
					    //Si el tipo de mensaje es un error
						if(data.tipo_mensaje == 'error')
						{
							//Limpia ruta del archivo cargado
			  				$('#'+strBotonArchivoIDGridEmpleadosIncidenciasRecursosHumanos).val('');
						   	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_empleados_incidencias_recursos_humanos('error', data.mensaje);
						}
						else
						{	
							//Hacer un llamado al método del controlador para subir archivo del registro
							$('#'+strBotonArchivoIDGridEmpleadosIncidenciasRecursosHumanos).upload('recursos_humanos/empleados_incidencias/subir_archivo',
									{ intIncidenciaID:incidenciaID,
						      		  intEmpleadoID:empleadoID,
						      		  strBotonArchivoID: strBotonArchivoIDGridEmpleadosIncidenciasRecursosHumanos
									},
									function(data) {
										//Limpia ruta del archivo cargado
						         		$('#'+strBotonArchivoIDGridEmpleadosIncidenciasRecursosHumanos).val('');
										//Subida finalizada.
										if (data.resultado)
										{
						         			//Hacer llamado a la función  para cargar  los registros en el grid
						          	        paginacion_empleados_incidencias_recursos_humanos();
										}
										//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
										mensaje_empleados_incidencias_recursos_humanos(data.tipo_mensaje, data.mensaje);
									});
						}
				     },
				     'json');
		}

		//Función que se utiliza para descargar el archivo (o imagen) del registro seleccionado
		function descargar_archivo_empleados_incidencias_recursos_humanos(incidenciaID, empleadoID)
		{
			//Variable que se utiliza para asignar el id del registro
			var intIncidenciaID = 0;
			var intEmpleadoID = 0;

			//Si no existe id, significa que se descargara el archivo desde el modal
			if(incidenciaID == '')
			{
				intIncidenciaID = $('#txtIncidenciaID_empleados_incidencias_recursos_humanos').val();
				intEmpleadoID = $('#txtEmpleadoID_empleados_incidencias_recursos_humanos').val();
			}
			else
			{
				intIncidenciaID = incidenciaID;
				intEmpleadoID = empleadoID;
			}
		
			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'recursos_humanos/empleados_incidencias/descargar_archivo',
							'data' : {
										'intEmpleadoID': intEmpleadoID,
										'intIncidenciaID': intIncidenciaID				
									 }
						   };

			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);
		}

		//Función que se utiliza para eliminar el archivo del registro seleccionado
		function eliminar_archivo_empleados_incidencias_recursos_humanos(incidenciaID, empleadoID)
		{
			//Variable que se utiliza para asignar el id del registro
			var intIncidenciaRegID = 0;
			var intEmpleadoRegID = 0;

			//Si no existe id, significa que se eliminara el archivo desde el modal
			if(incidenciaID == '')
			{
				intIncidenciaRegID = $('#txtIncidenciaID_empleados_incidencias_recursos_humanos').val();
				intEmpleadoRegID = $('#txtEmpleadoID_empleados_incidencias_recursos_humanos').val();
			}
			else
			{
				intIncidenciaRegID = incidenciaID;
				intEmpleadoRegID = empleadoID;
			}

			//Hacer un llamado al método del controlador para eliminar el archivo del registro
			$.post('recursos_humanos/empleados_incidencias/eliminar_archivo',
			     {intEmpleadoID: intEmpleadoRegID,
			      intIncidenciaID: intIncidenciaRegID
			     },
			     function(data) {
			     	if(data.resultado)
			        {
			         	//Hacer llamado a la función  para cargar  los registros en el grid
		          	    paginacion_empleados_incidencias_recursos_humanos();
		          	    //Si el id del registro se obtuvo del modal
						if(incidenciaID == '')
						{
							//Ocultar los siguientes botones
							$('#btnDescargarArchivo_empleados_incidencias_recursos_humanos').hide();
							$('#btnEliminarArchivo_empleados_incidencias_recursos_humanos').hide();    
						}
			        }
		        	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		       		mensaje_empleados_incidencias_recursos_humanos(data.tipo_mensaje, data.mensaje);
			       
			     },
			    'json');
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_empleados_incidencias_recursos_humanos()
		{
			//Incializar formulario
			$('#frmEmpleadosIncidenciasRecursosHumanos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_empleados_incidencias_recursos_humanos();
			//Limpiar cajas de texto ocultas
			$('#frmEmpleadosIncidenciasRecursosHumanos').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_empleados_incidencias_recursos_humanos');
			//Habilitar todos los elementos del formulario
			$('#frmEmpleadosIncidenciasRecursosHumanos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_empleados_incidencias_recursos_humanos').val(fechaActual()); 
			//Mostrar los siguientes botones
			$("#btnGuardar_empleados_incidencias_recursos_humanos").show();
			$("#btnAdjuntar_empleados_incidencias_recursos_humanos").show();
			//Ocultar los siguientes botones
			$("#btnDescargarArchivo_empleados_incidencias_recursos_humanos").hide();
			$("#btnEliminarArchivo_empleados_incidencias_recursos_humanos").hide();
			$("#btnDesactivar_empleados_incidencias_recursos_humanos").hide();
			$("#btnRestaurar_empleados_incidencias_recursos_humanos").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_empleados_incidencias_recursos_humanos()
		{
			try {
				//Cerrar modal
				objEmpleadosIncidenciasRecursosHumanos.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_empleados_incidencias_recursos_humanos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_empleados_incidencias_recursos_humanos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_empleados_incidencias_recursos_humanos();
			//Validación del formulario de campos obligatorios
			$('#frmEmpleadosIncidenciasRecursosHumanos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_empleados_incidencias_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strEmpleado_empleados_incidencias_recursos_humanos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtEmpleadoID_empleados_incidencias_recursos_humanos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un empleado existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strComentario_empleados_incidencias_recursos_humanos: {
											validators: {
												notEmpty: {message: 'Escriba un comentario'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_empleados_incidencias_recursos_humanos = $('#frmEmpleadosIncidenciasRecursosHumanos').data('bootstrapValidator');
			bootstrapValidator_empleados_incidencias_recursos_humanos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_empleados_incidencias_recursos_humanos.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_empleados_incidencias_recursos_humanos();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_empleados_incidencias_recursos_humanos()
		{
			try
			{
				$('#frmEmpleadosIncidenciasRecursosHumanos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_empleados_incidencias_recursos_humanos()
		{
		    //Obtenemos un array con los datos del archivo
    		var arrArchivoEmpleadosIncidenciasRecursosHumanos = $("#archivo_empleados_incidencias_recursos_humanos")[0].files[0];

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('recursos_humanos/empleados_incidencias/guardar',
					{ 
						intIncidenciaID: $('#txtIncidenciaID_empleados_incidencias_recursos_humanos').val(),
						intEmpleadoID: $('#txtEmpleadoID_empleados_incidencias_recursos_humanos').val(),
						intEmpleadoIDAnterior: $('#txtEmpleadoIDAnterior_empleados_incidencias_recursos_humanos').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_empleados_incidencias_recursos_humanos').val()),
						dteFechaAnterior: $.formatFechaMysql($('#txtFechaAnterior_empleados_incidencias_recursos_humanos').val()),
						strComentario: $('#txtComentario_empleados_incidencias_recursos_humanos').val()
					},
					function(data) {
						if (data.resultado)
						{

							//Si existe archivo seleccionado y no existe id de la incidencia, significa que es un nuevo registro
			                if(arrArchivoEmpleadosIncidenciasRecursosHumanos != undefined && $('#txtIncidenciaID_empleados_incidencias_recursos_humanos').val() == '')
			                {
			                	//Asignar el id de la incidencia registrada en la base de datos
                     			$('#txtIncidenciaID_empleados_incidencias_recursos_humanos').val(data.incidencia_id);
			                    //Hacer un llamado a la función para subir el archivo
			                    subir_archivo_modal_empleados_incidencias_recursos_humanos('Nuevo');
			                }
			                else
			                {
			                    //Hacer un llamado a la función para cerrar modal
			                    cerrar_empleados_incidencias_recursos_humanos();      
			                }

			                //Hacer llamado a la función  para cargar  los registros en el grid
			               	paginacion_empleados_incidencias_recursos_humanos();   
			                      
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_empleados_incidencias_recursos_humanos(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_empleados_incidencias_recursos_humanos(tipoMensaje, mensaje)
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
		function cambiar_estatus_empleados_incidencias_recursos_humanos(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtIncidenciaID_empleados_incidencias_recursos_humanos').val();

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
						             {'type':     'question',
						              'title':    'Incidencias',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                            	//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_empleados_incidencias_recursos_humanos(intID, strTipo, 'INACTIVO');
														
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_empleados_incidencias_recursos_humanos(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_empleados_incidencias_recursos_humanos(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('recursos_humanos/empleados_incidencias/set_estatus',
			      {intIncidenciaID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_empleados_incidencias_recursos_humanos();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_empleados_incidencias_recursos_humanos();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_empleados_incidencias_recursos_humanos(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_empleados_incidencias_recursos_humanos(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('recursos_humanos/empleados_incidencias/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_empleados_incidencias_recursos_humanos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtIncidenciaID_empleados_incidencias_recursos_humanos').val(data.row.incidencia_id);
				            $('#txtEmpleadoID_empleados_incidencias_recursos_humanos').val(data.row.empleado_id);
						    $('#txtEmpleadoIDAnterior_empleados_incidencias_recursos_humanos').val(data.row.empleado_id);
						    $('#txtEmpleado_empleados_incidencias_recursos_humanos').val(data.row.empleado);
						    $('#txtFecha_empleados_incidencias_recursos_humanos').val(data.row.fecha);
						    $('#txtFechaAnterior_empleados_incidencias_recursos_humanos').val(data.row.fecha);
						    $('#txtComentario_empleados_incidencias_recursos_humanos').val(data.row.comentario);
				            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
				            $('#divEncabezadoModal_empleados_incidencias_recursos_humanos').addClass("estatus-"+strEstatus);
				        
				           	//Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar los siguientes botones
				            	$("#btnDescargarArchivo_empleados_incidencias_recursos_humanos").show();
				            	
				            	//Si el estatus del registro es ACTIVO
				            	if(strEstatus == 'ACTIVO')
				            	{
				            		$('#btnEliminarArchivo_empleados_incidencias_recursos_humanos').show();
				            	}
				           	}

				           	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_empleados_incidencias_recursos_humanos").show();

							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
			            		$('#frmEmpleadosIncidenciasRecursosHumanos').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_empleados_incidencias_recursos_humanos").hide(); 
								
								//Mostrar botón Restaurar
								$("#btnRestaurar_empleados_incidencias_recursos_humanos").show();
								//Ocultar botón Adjuntar
								$("#btnAdjuntar_empleados_incidencias_recursos_humanos").hide();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objEmpleadosIncidenciasRecursosHumanos = $('#EmpleadosIncidenciasRecursosHumanosBox').bPopup({
															  appendTo: '#EmpleadosIncidenciasRecursosHumanosContent', 
								                              contentContainer: 'EmpleadosIncidenciasRecursosHumanosM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtEmpleado_empleados_incidencias_recursos_humanos').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_empleados_incidencias_recursos_humanos()
		{
			//Si no existe id, verificar la existencia del empleado
			if ($('#txtIncidenciaID_empleados_incidencias_recursos_humanos').val() == '' && $('#txtEmpleadoID_empleados_incidencias_recursos_humanos').val() != '')
			{
					
				//Concatenar criterios de búsqueda (para poder verificar la existencia del empleado en la fecha)
				var strCriteriosBusqEmpleadosIncidenciasRecursosHumanos = $.formatFechaMysql($('#txtFecha_empleados_incidencias_recursos_humanos').val())+'|'+$('#txtEmpleadoID_empleados_incidencias_recursos_humanos').val();
				//Hacer un llamado a la función para recuperar los datos del registro que coincide con los criterios de búsqueda   
				editar_empleados_incidencias_recursos_humanos(strCriteriosBusqEmpleadosIncidenciasRecursosHumanos, 'empleado', 'Nuevo');
			}
		}


		//Función para subir archivo (o imagen) de un registro desde el modal
		function subir_archivo_modal_empleados_incidencias_recursos_humanos(tipoAccion)
		{
			//Variable que se utiliza para asignar archivo
			var strBotonArchivoIDEmpleadosIncidenciasRecursosHumanos = "archivo_empleados_incidencias_recursos_humanos";

			//Obtenemos un array con los datos del archivo
	        var file = $("#"+strBotonArchivoIDEmpleadosIncidenciasRecursosHumanos)[0].files[0];
	        //Variable que se utiliza para asignar la extensión del archivo seleccionado
   			var fileExtension = "";
	        //Obtenemos el nombre del archivo
	        var fileName = file.name;
	        //Obtenemos la extensión del archivo
	        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
	        //Obtenemos el tamaño del archivo
	        var fileSize = file.size;
	        //Obtenemos el tipo de archivo image/png ejemplo
	        var fileType = file.type;

	        //Comprobar extensión del archivo
	        $.post('cuentas_cobrar/clientes/comprobar_extension_archivo',
				     {strExtension: fileExtension
				     },
				     function(data) {
					    //Si el tipo de mensaje es un error
						if(data.tipo_mensaje == 'error')
						{
							//Limpia ruta del archivo cargado
			  				$('#'+strBotonArchivoIDEmpleadosIncidenciasRecursosHumanos).val('');
						   	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_empleados_incidencias_recursos_humanos('error', data.mensaje);
						}
						else
						{	
							//Si existe id del registro subir el archivo
				        	if($('#txtIncidenciaID_empleados_incidencias_recursos_humanos').val() != '')
				        	{
								//Hacer un llamado al método del controlador para subir archivo del registro
								$('#'+strBotonArchivoIDEmpleadosIncidenciasRecursosHumanos).upload('recursos_humanos/empleados_incidencias/subir_archivo',
										{ intIncidenciaID:$('#txtIncidenciaID_empleados_incidencias_recursos_humanos').val(),
						                  intEmpleadoID:$('#txtEmpleadoID_empleados_incidencias_recursos_humanos').val(),
						                  strBotonArchivoID: strBotonArchivoIDEmpleadosIncidenciasRecursosHumanos
										},
										function(data) {

											//Limpia ruta del archivo cargado
							         		$('#'+strBotonArchivoIDEmpleadosIncidenciasRecursosHumanos).val('');
											//Subida finalizada.
											if (data.resultado)
											{
												//Mostrar los siguientes botones
				            				    $("#btnDescargarArchivo_empleados_incidencias_recursos_humanos").show();
				            				    $("#btnEliminarArchivo_empleados_incidencias_recursos_humanos").show();
												//Hacer llamado a la función  para cargar  los registros en el grid
								            	paginacion_empleados_incidencias_recursos_humanos();  
											}

											//Si la acción corresponde a un nuevo registro
						                    if(tipoAccion == 'Nuevo')
						                    {
						                    	//Si el tipo de mensaje es un éxito
								                if(data.tipo_mensaje == 'éxito')
								                {
									                //Hacer un llamado a la función para cerrar modal
									                cerrar_empleados_incidencias_recursos_humanos();
								                }
								                else
								                {
								                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
									    			mensaje_empleados_incidencias_recursos_humanos(data.tipo_mensaje, data.mensaje);
								                }
						                    }
						                    else
						                    {
						                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
									    		mensaje_empleados_incidencias_recursos_humanos(data.tipo_mensaje, data.mensaje);
						                    }

										});
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
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_empleados_incidencias_recursos_humanos').datetimepicker({format: 'DD/MM/YYYY'});

			//Comprobar la existencia del empleado en la BD cuando cambie la fecha
			$('#dteFecha_empleados_incidencias_recursos_humanos').on('dp.change', function (e) {
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_empleados_incidencias_recursos_humanos();
			});

			//Comprobar la existencia del empleado en la BD cuando pierda el enfoque la caja de texto
			$('#txtEmpleado_empleados_incidencias_recursos_humanos').focusout(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_empleados_incidencias_recursos_humanos();
			});

			//Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleado_empleados_incidencias_recursos_humanos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEmpleadoID_empleados_incidencias_recursos_humanos').val('');
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
	             $('#txtEmpleadoID_empleados_incidencias_recursos_humanos').val(ui.item.data);
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
	        $('#txtEmpleado_empleados_incidencias_recursos_humanos').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoID_empleados_incidencias_recursos_humanos').val() == '' ||
	               $('#txtEmpleado_empleados_incidencias_recursos_humanos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEmpleadoID_empleados_incidencias_recursos_humanos').val('');
	               $('#txtEmpleado_empleados_incidencias_recursos_humanos').val('');
	            }

	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_empleados_incidencias_recursos_humanos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_empleados_incidencias_recursos_humanos').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_empleados_incidencias_recursos_humanos').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_empleados_incidencias_recursos_humanos').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_empleados_incidencias_recursos_humanos').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_empleados_incidencias_recursos_humanos').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleadoBusq_empleados_incidencias_recursos_humanos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEmpleadoIDBusq_empleados_incidencias_recursos_humanos').val('');
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
	             $('#txtEmpleadoIDBusq_empleados_incidencias_recursos_humanos').val(ui.item.data);
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
	        $('#txtEmpleadoBusq_empleados_incidencias_recursos_humanos').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoIDBusq_empleados_incidencias_recursos_humanos').val() == '' ||
	               $('#txtEmpleadoBusq_empleados_incidencias_recursos_humanos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEmpleadoIDBusq_empleados_incidencias_recursos_humanos').val('');
	               $('#txtEmpleadoBusq_empleados_incidencias_recursos_humanos').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_empleados_incidencias_recursos_humanos').on('click','a',function(event){
				event.preventDefault();
				intPaginaEmpleadosIncidenciasRecursosHumanos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_empleados_incidencias_recursos_humanos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_empleados_incidencias_recursos_humanos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_empleados_incidencias_recursos_humanos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_empleados_incidencias_recursos_humanos').addClass("estatus-NUEVO");
				//Abrir modal
				 objEmpleadosIncidenciasRecursosHumanos = $('#EmpleadosIncidenciasRecursosHumanosBox').bPopup({
											   appendTo: '#EmpleadosIncidenciasRecursosHumanosContent', 
				                               contentContainer: 'EmpleadosIncidenciasRecursosHumanosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtEmpleado_empleados_incidencias_recursos_humanos').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_empleados_incidencias_recursos_humanos').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_empleados_incidencias_recursos_humanos();
		});
	</script>