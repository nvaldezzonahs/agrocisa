	<div id="ServiciosInternosProgramacionInventariosFisicosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_servicios_internos_programacion_inventarios_fisicos" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_servicios_internos_programacion_inventarios_fisicos" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_servicios_internos_programacion_inventarios_fisicos">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_servicios_internos_programacion_inventarios_fisicos'>
				                    <input class="form-control" id="txtFechaInicialBusq_servicios_internos_programacion_inventarios_fisicos"
				                    		name= "strFechaInicialBusq_servicios_internos_programacion_inventarios_fisicos" 
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
								<label for="txtFechaFinalBusq_servicios_internos_programacion_inventarios_fisicos">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_servicios_internos_programacion_inventarios_fisicos'>
				                    <input class="form-control" id="txtFechaFinalBusq_servicios_internos_programacion_inventarios_fisicos"
				                    		name= "strFechaFinalBusq_servicios_internos_programacion_inventarios_fisicos" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los vehículos activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del vehículo seleccionado-->
								<input id="txtVehiculoIDBusq_servicios_internos_programacion_inventarios_fisicos" 
									   name="intVehiculoIDBusq_servicios_internos_programacion_inventarios_fisicos"  type="hidden" 
									   value="">
								</input>
								<label for="txtVehiculoBusq_servicios_internos_programacion_inventarios_fisicos">Vehículo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtVehiculoBusq_servicios_internos_programacion_inventarios_fisicos" 
										name="strVehiculoBusq_servicios_internos_programacion_inventarios_fisicos" type="text" value="" tabindex="1" placeholder="Ingrese vehículo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los mecánicos activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del mecánico seleccionado-->
								<input id="txtMecanicoIDBusq_servicios_internos_programacion_inventarios_fisicos" 
									   name="intMecanicoIDBusq_servicios_internos_programacion_inventarios_fisicos"  type="hidden" 
									   value="">
								</input>
								<label for="txtMecanicoBusq_servicios_internos_programacion_inventarios_fisicos">Mecánico</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMecanicoBusq_servicios_internos_programacion_inventarios_fisicos" 
										name="strMecanicoBusq_servicios_internos_programacion_inventarios_fisicos" type="text" value="" tabindex="1" placeholder="Ingrese mecánico" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div  id="ToolBtns"  class="btn-group">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_servicios_internos_programacion_inventarios_fisicos"
									onclick="paginacion_servicios_internos_programacion_inventarios_fisicos();" 
									title="Buscar coincidencias" tabindex="1"> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_servicios_internos_programacion_inventarios_fisicos" 
									title="Nuevo registro" tabindex="1"> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_servicios_internos_programacion_inventarios_fisicos"
									onclick="reporte_servicios_internos_programacion_inventarios_fisicos();" 
									title="Imprimir reporte general en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_servicios_internos_programacion_inventarios_fisicos"
									onclick="descargar_xls_servicios_internos_programacion_inventarios_fisicos();" title="Descargar reporte general en XLS" tabindex="1">
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
				td.movil:nth-of-type(2):before {content: "Hora"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Vehículo"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Mecánico"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_servicios_internos_programacion_inventarios_fisicos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Fecha</th>
							<th class="movil">Hora</th>
							<th class="movil">Vehículo</th>
							<th class="movil">Mecánico</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_servicios_internos_programacion_inventarios_fisicos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{hora}}</td>
							<td class="movil">{{vehiculo}}</td>
							<td class="movil">{{mecanico}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_servicios_internos_programacion_inventarios_fisicos({{servicio_interno_programacion_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_servicios_internos_programacion_inventarios_fisicos({{servicio_interno_programacion_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_servicios_internos_programacion_inventarios_fisicos({{servicio_interno_programacion_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_servicios_internos_programacion_inventarios_fisicos({{servicio_interno_programacion_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_servicios_internos_programacion_inventarios_fisicos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_servicios_internos_programacion_inventarios_fisicos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="ServiciosInternosProgramacionInventariosFisicosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_servicios_internos_programacion_inventarios_fisicos"  class="ModalBodyTitle">
			<h1>Programación de Servicios Internos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmServiciosInternosProgramacionInventariosFisicos" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmServiciosInternosProgramacionInventariosFisicos"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtServicioInternoProgramacionID_servicios_internos_programacion_inventarios_fisicos" 
										   name="intServicioInternoProgramacionID_servicios_internos_programacion_inventarios_fisicos" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la fecha anterior y así evitar duplicidad en caso de que exista otro registro con el mismo mecánico en la fecha-->
									<input id="txtFechaAnterior_servicios_internos_programacion_inventarios_fisicos" name="strFechaAnterior_servicios_internos_programacion_inventarios_fisicos" type="hidden" value="">
									</input>
									<label for="txtFecha_servicios_internos_programacion_inventarios_fisicos">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_servicios_internos_programacion_inventarios_fisicos'>
					                    <input class="form-control" id="txtFecha_servicios_internos_programacion_inventarios_fisicos"
					                    		name= "strFecha_servicios_internos_programacion_inventarios_fisicos" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Hora-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHora_servicios_internos_programacion_inventarios_fisicos">Hora</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div 	class="input-group bootstrap-timepicker timepicker" 
											id="dteHora_servicios_internos_programacion_inventarios_fisicos">
							            <input 	id="txtHora_servicios_internos_programacion_inventarios_fisicos"
							            		name= "strHora_servicios_internos_programacion_inventarios_fisicos" 
							            		type="text"
							            		value=""
							            		placeholder="Seleccione una hora" 
							            		class="form-control input-small" />
							            <span class="input-group-addon">
							            	<i class="glyphicon glyphicon-time"></i>
							            </span>
							        </div>
								</div>
							</div>
						</div>	
					</div>
					<div class="row">
						<!--Autocomplete que contiene los vehículos activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del vehículo seleccionado-->
									<input id="txtVehiculoID_servicios_internos_programacion_inventarios_fisicos" 
										   name="intVehiculoID_servicios_internos_programacion_inventarios_fisicos" type="hidden" value="">
									</input>
									<label for="txtVehiculo_servicios_internos_programacion_inventarios_fisicos">Vehículo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtVehiculo_servicios_internos_programacion_inventarios_fisicos" 
											name="strVehiculo_servicios_internos_programacion_inventarios_fisicos" type="text" value="" tabindex="1" placeholder="Ingrese vehículo" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene los mecánicos activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del mecánico seleccionado-->
									<input id="txtMecanicoID_servicios_internos_programacion_inventarios_fisicos" 
										   name="intMecanicoID_servicios_internos_programacion_inventarios_fisicos" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el mecánico anterior y así evitar duplicidad en caso de que exista otro registro con el mismo mecánico en la fecha-->
									<input id="txtMecanicoIDAnterior_servicios_internos_programacion_inventarios_fisicos" 
										   name="intMecanicoIDAnterior_servicios_internos_programacion_inventarios_fisicos" type="hidden" value="">
									<label for="txtMecanico_servicios_internos_programacion_inventarios_fisicos">Mecánico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMecanico_servicios_internos_programacion_inventarios_fisicos" 
											name="strMecanico_servicios_internos_programacion_inventarios_fisicos" type="text" value="" tabindex="1" placeholder="Ingrese mecánico" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Actividad-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtActividad_servicios_internos_programacion_inventarios_fisicos">Actividad</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtActividad_servicios_internos_programacion_inventarios_fisicos" 
											name="strActividad_servicios_internos_programacion_inventarios_fisicos" type="text" value="" tabindex="1" placeholder="Ingrese actividad" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					 <div class="row">
				    	<!--Observaciones-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_servicios_internos_programacion_inventarios_fisicos">Observaciones</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtObservaciones_servicios_internos_programacion_inventarios_fisicos" 
											   name="strObservaciones_servicios_internos_programacion_inventarios_fisicos" rows="3" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_servicios_internos_programacion_inventarios_fisicos"  
									onclick="validar_servicios_internos_programacion_inventarios_fisicos();"  title="Guardar" tabindex="2">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_servicios_internos_programacion_inventarios_fisicos"  
									onclick="cambiar_estatus_servicios_internos_programacion_inventarios_fisicos('','ACTIVO');"  title="Desactivar" tabindex="3">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_servicios_internos_programacion_inventarios_fisicos"  
									onclick="cambiar_estatus_servicios_internos_programacion_inventarios_fisicos('','INACTIVO');"  title="Restaurar" tabindex="4">
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_servicios_internos_programacion_inventarios_fisicos"
									type="reset" aria-hidden="true" onclick="cerrar_servicios_internos_programacion_inventarios_fisicos();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ServiciosInternosProgramacionInventariosFisicosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaServiciosInternosProgramacionInventariosFisicos = 0;
		var strUltimaBusquedaServiciosInternosProgramacionInventariosFisicos = "";
		//Variables que se utilizan para la búsqueda de registros
		var intVehiculoIDServiciosInternosProgramacionInventariosFisicos = "";
		var intMecanicoIDServiciosInternosProgramacionInventariosFisicos = "";
		var dteFechaInicialServiciosInternosProgramacionInventariosFisicos = "";
		var dteFechaFinalServiciosInternosProgramacionInventariosFisicos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objServiciosInternosProgramacionInventariosFisicos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_servicios_internos_programacion_inventarios_fisicos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('inventarios_fisicos/servicios_internos_programacion/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_servicios_internos_programacion_inventarios_fisicos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosServiciosInternosProgramacionInventariosFisicos = data.row;
					//Separar la cadena 
					var arrPermisosServiciosInternosProgramacionInventariosFisicos = strPermisosServiciosInternosProgramacionInventariosFisicos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosServiciosInternosProgramacionInventariosFisicos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosServiciosInternosProgramacionInventariosFisicos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_servicios_internos_programacion_inventarios_fisicos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosServiciosInternosProgramacionInventariosFisicos[i]=='GUARDAR') || (arrPermisosServiciosInternosProgramacionInventariosFisicos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_servicios_internos_programacion_inventarios_fisicos').removeAttr('disabled');
						}
						else if(arrPermisosServiciosInternosProgramacionInventariosFisicos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_servicios_internos_programacion_inventarios_fisicos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_servicios_internos_programacion_inventarios_fisicos();
						}
						else if(arrPermisosServiciosInternosProgramacionInventariosFisicos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_servicios_internos_programacion_inventarios_fisicos').removeAttr('disabled');
							$('#btnRestaurar_servicios_internos_programacion_inventarios_fisicos').removeAttr('disabled');
						}
						else if(arrPermisosServiciosInternosProgramacionInventariosFisicos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_servicios_internos_programacion_inventarios_fisicos').removeAttr('disabled');
						}
						else if(arrPermisosServiciosInternosProgramacionInventariosFisicos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_servicios_internos_programacion_inventarios_fisicos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_servicios_internos_programacion_inventarios_fisicos() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaServiciosInternosProgramacionInventariosFisicos =($('#txtFechaInicialBusq_servicios_internos_programacion_inventarios_fisicos').val()+$('#txtFechaFinalBusq_servicios_internos_programacion_inventarios_fisicos').val()+$('#txtVehiculoIDBusq_servicios_internos_programacion_inventarios_fisicos').val()+$('#txtMecanicoIDBusq_servicios_internos_programacion_inventarios_fisicos').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaServiciosInternosProgramacionInventariosFisicos != strUltimaBusquedaServiciosInternosProgramacionInventariosFisicos)
			{
				intPaginaServiciosInternosProgramacionInventariosFisicos = 0;
				strUltimaBusquedaServiciosInternosProgramacionInventariosFisicos = strNuevaBusquedaServiciosInternosProgramacionInventariosFisicos;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('inventarios_fisicos/servicios_internos_programacion/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_servicios_internos_programacion_inventarios_fisicos').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_servicios_internos_programacion_inventarios_fisicos').val()),
						intVehiculoID: $('#txtVehiculoIDBusq_servicios_internos_programacion_inventarios_fisicos').val(),
						intMecanicoID: $('#txtMecanicoIDBusq_servicios_internos_programacion_inventarios_fisicos').val(),
						intPagina:intPaginaServiciosInternosProgramacionInventariosFisicos,
						strPermisosAcceso: $('#txtAcciones_servicios_internos_programacion_inventarios_fisicos').val()
					},
					function(data){
						$('#dg_servicios_internos_programacion_inventarios_fisicos tbody').empty();
						var tmpServiciosInternosProgramacionInventariosFisicos = Mustache.render($('#plantilla_servicios_internos_programacion_inventarios_fisicos').html(),data);
						$('#dg_servicios_internos_programacion_inventarios_fisicos tbody').html(tmpServiciosInternosProgramacionInventariosFisicos);
						$('#pagLinks_servicios_internos_programacion_inventarios_fisicos').html(data.paginacion);
						$('#numElementos_servicios_internos_programacion_inventarios_fisicos').html(data.total_rows);
						intPaginaServiciosInternosProgramacionInventariosFisicos = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_servicios_internos_programacion_inventarios_fisicos() 
		{
			//Asignar valores para la búsqueda de registros
			intVehiculoIDServiciosInternosProgramacionInventariosFisicos =  $('#txtVehiculoIDBusq_servicios_internos_programacion_inventarios_fisicos').val();
			intMecanicoIDServiciosInternosProgramacionInventariosFisicos =  $('#txtMecanicoIDBusq_servicios_internos_programacion_inventarios_fisicos').val();
			dteFechaInicialServiciosInternosProgramacionInventariosFisicos =  $.formatFechaMysql($('#txtFechaInicialBusq_servicios_internos_programacion_inventarios_fisicos').val());
			dteFechaFinalServiciosInternosProgramacionInventariosFisicos =  $.formatFechaMysql($('#txtFechaFinalBusq_servicios_internos_programacion_inventarios_fisicos').val());

			//Si no existe fecha inicial
			if(dteFechaInicialServiciosInternosProgramacionInventariosFisicos == '')
			{
				dteFechaInicialServiciosInternosProgramacionInventariosFisicos = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalServiciosInternosProgramacionInventariosFisicos == '')
			{
				dteFechaFinalServiciosInternosProgramacionInventariosFisicos =  '0000-00-00';
			}

			//Si no existe id del vehículo
			if(intVehiculoIDServiciosInternosProgramacionInventariosFisicos == '')
			{
				intVehiculoIDServiciosInternosProgramacionInventariosFisicos = 0;
			}

			//Si no existe id del mecánico
			if(intMecanicoIDServiciosInternosProgramacionInventariosFisicos == '')
			{
				intMecanicoIDServiciosInternosProgramacionInventariosFisicos = 0;
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("inventarios_fisicos/servicios_internos_programacion/get_reporte/"+dteFechaInicialServiciosInternosProgramacionInventariosFisicos+"/"+dteFechaFinalServiciosInternosProgramacionInventariosFisicos+"/"+intVehiculoIDServiciosInternosProgramacionInventariosFisicos+"/"+intMecanicoIDServiciosInternosProgramacionInventariosFisicos);
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_servicios_internos_programacion_inventarios_fisicos() 
		{
			//Asignar valores para la búsqueda de registros
			intVehiculoIDServiciosInternosProgramacionInventariosFisicos =  $('#txtVehiculoIDBusq_servicios_internos_programacion_inventarios_fisicos').val();
			intMecanicoIDServiciosInternosProgramacionInventariosFisicos =  $('#txtMecanicoIDBusq_servicios_internos_programacion_inventarios_fisicos').val();
			dteFechaInicialServiciosInternosProgramacionInventariosFisicos =  $.formatFechaMysql($('#txtFechaInicialBusq_servicios_internos_programacion_inventarios_fisicos').val());
			dteFechaFinalServiciosInternosProgramacionInventariosFisicos =  $.formatFechaMysql($('#txtFechaFinalBusq_servicios_internos_programacion_inventarios_fisicos').val());

			//Si no existe fecha inicial
			if(dteFechaInicialServiciosInternosProgramacionInventariosFisicos == '')
			{
				dteFechaInicialServiciosInternosProgramacionInventariosFisicos = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalServiciosInternosProgramacionInventariosFisicos == '')
			{
				dteFechaFinalServiciosInternosProgramacionInventariosFisicos =  '0000-00-00';
			}

			//Si no existe id del vehículo
			if(intVehiculoIDServiciosInternosProgramacionInventariosFisicos == '')
			{
				intVehiculoIDServiciosInternosProgramacionInventariosFisicos = 0;
			}

			//Si no existe id del mecánico
			if(intMecanicoIDServiciosInternosProgramacionInventariosFisicos == '')
			{
				intMecanicoIDServiciosInternosProgramacionInventariosFisicos = 0;
			}

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
			window.open("inventarios_fisicos/servicios_internos_programacion/get_xls/"+dteFechaInicialServiciosInternosProgramacionInventariosFisicos+"/"+dteFechaFinalServiciosInternosProgramacionInventariosFisicos+"/"+intVehiculoIDServiciosInternosProgramacionInventariosFisicos+"/"+intMecanicoIDServiciosInternosProgramacionInventariosFisicos);
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_servicios_internos_programacion_inventarios_fisicos()
		{
			//Incializar formulario
			$('#frmServiciosInternosProgramacionInventariosFisicos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicios_internos_programacion_inventarios_fisicos();
			//Limpiar cajas de texto ocultas
			$('#frmServiciosInternosProgramacionInventariosFisicos').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_servicios_internos_programacion_inventarios_fisicos').val(fechaActual());
			//Asignar la hora actual
			$('#txtHora_servicios_internos_programacion_inventarios_fisicos').timepicker('setTime', horaActual('no'));
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_servicios_internos_programacion_inventarios_fisicos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_servicios_internos_programacion_inventarios_fisicos').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_servicios_internos_programacion_inventarios_fisicos').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmServiciosInternosProgramacionInventariosFisicos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
		    $("#btnGuardar_servicios_internos_programacion_inventarios_fisicos").show();
		    //Ocultar los siguientes botones
			$("#btnDesactivar_servicios_internos_programacion_inventarios_fisicos").hide();
			$("#btnRestaurar_servicios_internos_programacion_inventarios_fisicos").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_servicios_internos_programacion_inventarios_fisicos()
		{
			try {
				//Cerrar modal
				objServiciosInternosProgramacionInventariosFisicos.close();
				//Enfocar caja de texto 
				$('#txtVehiculoBusq_servicios_internos_programacion_inventarios_fisicos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_servicios_internos_programacion_inventarios_fisicos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicios_internos_programacion_inventarios_fisicos();
			//Validación del formulario de campos obligatorios
			$('#frmServiciosInternosProgramacionInventariosFisicos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_servicios_internos_programacion_inventarios_fisicos: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strHora_servicios_internos_programacion_inventarios_fisicos: {
											validators: {
												notEmpty: {message: 'Seleccione una hora'}
											}
										},
										strVehiculo_servicios_internos_programacion_inventarios_fisicos: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vehículo
					                                    if($('#txtVehiculoID_servicios_internos_programacion_inventarios_fisicos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un vehículo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strMecanico_servicios_internos_programacion_inventarios_fisicos: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del mecánico
					                                    if($('#txtMecanicoID_servicios_internos_programacion_inventarios_fisicos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un mecánico existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strActividad_servicios_internos_programacion_inventarios_fisicos: {
											validators: {
												notEmpty: {message: 'Escriba una actividad'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_servicios_internos_programacion_inventarios_fisicos = $('#frmServiciosInternosProgramacionInventariosFisicos').data('bootstrapValidator');
			bootstrapValidator_servicios_internos_programacion_inventarios_fisicos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_servicios_internos_programacion_inventarios_fisicos.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_servicios_internos_programacion_inventarios_fisicos();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_servicios_internos_programacion_inventarios_fisicos()
		{
			try
			{
				$('#frmServiciosInternosProgramacionInventariosFisicos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_servicios_internos_programacion_inventarios_fisicos()
		{
			//Concatenar fecha y hora
			var dteFechaServiciosInternosProgramacionInventariosFisicos = $.formatFechaMysql($('#txtFecha_servicios_internos_programacion_inventarios_fisicos').val())+' '+convertirHora12a24($('#txtHora_servicios_internos_programacion_inventarios_fisicos').val());

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('inventarios_fisicos/servicios_internos_programacion/guardar',
					{ 
						intServicioInternoProgramacionID: $('#txtServicioInternoProgramacionID_servicios_internos_programacion_inventarios_fisicos').val(),
						dteFecha: dteFechaServiciosInternosProgramacionInventariosFisicos,
						dteFechaAnterior: $('#txtFechaAnterior_servicios_internos_programacion_inventarios_fisicos').val(),
						intVehiculoID: $('#txtVehiculoID_servicios_internos_programacion_inventarios_fisicos').val(),
						intMecanicoID: $('#txtMecanicoID_servicios_internos_programacion_inventarios_fisicos').val(),
						intMecanicoIDAnterior: $('#txtMecanicoIDAnterior_servicios_internos_programacion_inventarios_fisicos').val(),
						strActividad: $('#txtActividad_servicios_internos_programacion_inventarios_fisicos').val(),
						strObservaciones: $('#txtObservaciones_servicios_internos_programacion_inventarios_fisicos').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_servicios_internos_programacion_inventarios_fisicos();
							//Hacer un llamado a la función para cerrar modal
							cerrar_servicios_internos_programacion_inventarios_fisicos();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_servicios_internos_programacion_inventarios_fisicos(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_servicios_internos_programacion_inventarios_fisicos(tipoMensaje, mensaje)
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
		function cambiar_estatus_servicios_internos_programacion_inventarios_fisicos(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtServicioInternoProgramacionID_servicios_internos_programacion_inventarios_fisicos').val();

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
						              'title':    'Programación de Servicios Internos',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
						                              $.post('inventarios_fisicos/servicios_internos_programacion/set_estatus',
						                                     {intServicioInternoProgramacionID: intID,
						                                      strEstatus: estatus
						                                     },
						                                     function(data) {
						                                        if(data.resultado)
						                                        {
						                                         	 //Hacer llamado a la función  para cargar  los registros en el grid
						                                          	paginacion_servicios_internos_programacion_inventarios_fisicos();

						                                          	//Si el id del registro se obtuvo del modal
																	if(id == '')
																	{
																		//Hacer un llamado a la función para cerrar modal
																		cerrar_servicios_internos_programacion_inventarios_fisicos();     
																	}
						                                        }
						                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						                                        mensaje_servicios_internos_programacion_inventarios_fisicos(data.tipo_mensaje, data.mensaje);
						                                     },
						                                    'json');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('inventarios_fisicos/servicios_internos_programacion/set_estatus',
				     {intServicioInternoProgramacionID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_servicios_internos_programacion_inventarios_fisicos();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_servicios_internos_programacion_inventarios_fisicos();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_servicios_internos_programacion_inventarios_fisicos(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_servicios_internos_programacion_inventarios_fisicos(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('inventarios_fisicos/servicios_internos_programacion/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_servicios_internos_programacion_inventarios_fisicos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtServicioInternoProgramacionID_servicios_internos_programacion_inventarios_fisicos').val(data.row.servicio_interno_programacion_id);
				            $('#txtFecha_servicios_internos_programacion_inventarios_fisicos').val(data.row.fecha);
				            $('#txtHora_servicios_internos_programacion_inventarios_fisicos').timepicker('setTime', data.row.hora);
				            $('#txtFechaAnterior_servicios_internos_programacion_inventarios_fisicos').val($.formatFechaMysql(data.row.fecha)+' '+data.row.hora);
				             $('#txtVehiculoID_servicios_internos_programacion_inventarios_fisicos').val(data.row.vehiculo_id);
				            $('#txtVehiculo_servicios_internos_programacion_inventarios_fisicos').val(data.row.vehiculo);
				            $('#txtMecanicoID_servicios_internos_programacion_inventarios_fisicos').val(data.row.mecanico_id);
				            $('#txtMecanicoIDAnterior_servicios_internos_programacion_inventarios_fisicos').val(data.row.mecanico_id);
				            $('#txtMecanico_servicios_internos_programacion_inventarios_fisicos').val(data.row.mecanico);
				            $('#txtActividad_servicios_internos_programacion_inventarios_fisicos').val(data.row.actividad);
				            $('#txtObservaciones_servicios_internos_programacion_inventarios_fisicos').val(data.row.observaciones);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_servicios_internos_programacion_inventarios_fisicos').addClass("estatus-"+strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_servicios_internos_programacion_inventarios_fisicos").show();
							}
							else 
							{	
								//Si el tipo de acción corresponde a Ver
								if(tipoAccion == 'Ver')
								{
									//Deshabilitar todos los elementos del formulario
				            		$('#frmServiciosInternosProgramacionInventariosFisicos').find('input, textarea, select').attr('disabled','disabled');
				            		//Ocultar botón Guardar
					           		$("#btnGuardar_servicios_internos_programacion_inventarios_fisicos").hide(); 
								}
								
								//Mostrar botón Restaurar
								$("#btnRestaurar_servicios_internos_programacion_inventarios_fisicos").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objServiciosInternosProgramacionInventariosFisicos = $('#ServiciosInternosProgramacionInventariosFisicosBox').bPopup({
															  appendTo: '#ServiciosInternosProgramacionInventariosFisicosContent', 
								                              contentContainer: 'ServiciosInternosProgramacionInventariosFisicosM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtHora_servicios_internos_programacion_inventarios_fisicos').focus();
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
			$('#dteFecha_servicios_internos_programacion_inventarios_fisicos').datetimepicker({format: 'DD/MM/YYYY'});
		    //Agregar timepicker para seleccionar una hora
			$('#txtHora_servicios_internos_programacion_inventarios_fisicos').timepicker({minuteStep: 1});

			//Comprobar la existencia del mecánico en la BD cuando pierda el enfoque la caja de texto
			$('#txtMecanico_servicios_internos_programacion_inventarios_fisicos').focusout(function(e){
				//Si no existe id, verificar la existencia del mecánico
				if ($('#txtServicioInternoProgramacionID_servicios_internos_programacion_inventarios_fisicos').val() == '' && $('#txtMecanicoID_servicios_internos_programacion_inventarios_fisicos').val() != '')
				{
					//Concatenar fecha y hora
					var dteFechaServiciosInternosProgramacionInventariosFisicos = $.formatFechaMysql($('#txtFecha_servicios_internos_programacion_inventarios_fisicos').val())+' '+convertirHora12a24($('#txtHora_servicios_internos_programacion_inventarios_fisicos').val());

					//Concatenar criterios de búsqueda (para poder verificar la existencia del mecánico en la fecha)
					var strCriteriosBusqServiciosInternosProgramacionInventariosFisicos = dteFechaServiciosInternosProgramacionInventariosFisicos+'|'+$('#txtMecanicoID_servicios_internos_programacion_inventarios_fisicos').val();

					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el mecánico 
					editar_servicios_internos_programacion_inventarios_fisicos(strCriteriosBusqServiciosInternosProgramacionInventariosFisicos, 'mecanico', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de un vehículo 
	        $('#txtVehiculo_servicios_internos_programacion_inventarios_fisicos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoID_servicios_internos_programacion_inventarios_fisicos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/vehiculos/autocomplete",
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
	             $('#txtVehiculoID_servicios_internos_programacion_inventarios_fisicos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del vehículo cuando pierda el enfoque la caja de texto
	        $('#txtVehiculo_servicios_internos_programacion_inventarios_fisicos').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoID_servicios_internos_programacion_inventarios_fisicos').val() == '' ||
	               $('#txtVehiculo_servicios_internos_programacion_inventarios_fisicos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVehiculoID_servicios_internos_programacion_inventarios_fisicos').val('');
	               $('#txtVehiculo_servicios_internos_programacion_inventarios_fisicos').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un mecánico 
	        $('#txtMecanico_servicios_internos_programacion_inventarios_fisicos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMecanicoID_servicios_internos_programacion_inventarios_fisicos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/mecanicos/autocomplete",
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
	             $('#txtMecanicoID_servicios_internos_programacion_inventarios_fisicos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id del mecánico cuando pierda el enfoque la caja de texto
	        $('#txtMecanico_servicios_internos_programacion_inventarios_fisicos').focusout(function(e){
	            //Si no existe id del mecánico
	            if($('#txtMecanicoID_servicios_internos_programacion_inventarios_fisicos').val() == '' ||
	               $('#txtMecanico_servicios_internos_programacion_inventarios_fisicos').val() == '' )
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMecanicoID_servicios_internos_programacion_inventarios_fisicos').val('');
	               $('#txtMecanico_servicios_internos_programacion_inventarios_fisicos').val('');
	            }

	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_servicios_internos_programacion_inventarios_fisicos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_servicios_internos_programacion_inventarios_fisicos').datetimepicker({format: 'DD/MM/YYYY',
			 																		useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_servicios_internos_programacion_inventarios_fisicos').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_servicios_internos_programacion_inventarios_fisicos').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_servicios_internos_programacion_inventarios_fisicos').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_servicios_internos_programacion_inventarios_fisicos').data('DateTimePicker').maxDate(e.date);
			});
			
			//Asignar la fecha actual
			$('#txtFechaInicialBusq_servicios_internos_programacion_inventarios_fisicos').val(fechaActual()); 
			$('#txtFechaFinalBusq_servicios_internos_programacion_inventarios_fisicos').val(fechaActual()); 


			//Autocomplete para recuperar los datos de un mecánico 
	        $('#txtMecanicoBusq_servicios_internos_programacion_inventarios_fisicos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMecanicoIDBusq_servicios_internos_programacion_inventarios_fisicos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/mecanicos/autocomplete",
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
	             $('#txtMecanicoIDBusq_servicios_internos_programacion_inventarios_fisicos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id del mecánico cuando pierda el enfoque la caja de texto
	        $('#txtMecanicoBusq_servicios_internos_programacion_inventarios_fisicos').focusout(function(e){
	            //Si no existe id del mecánico
	            if($('#txtMecanicoIDBusq_servicios_internos_programacion_inventarios_fisicos').val() == '' ||
	               $('#txtMecanicoBusq_servicios_internos_programacion_inventarios_fisicos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMecanicoIDBusq_servicios_internos_programacion_inventarios_fisicos').val('');
	               $('#txtMecanicoBusq_servicios_internos_programacion_inventarios_fisicos').val('');
	            }

	        });

			//Autocomplete para recuperar los datos de un vehículo 
	        $('#txtVehiculoBusq_servicios_internos_programacion_inventarios_fisicos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoIDBusq_servicios_internos_programacion_inventarios_fisicos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/vehiculos/autocomplete",
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
	             $('#txtVehiculoIDBusq_servicios_internos_programacion_inventarios_fisicos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del vehículo cuando pierda el enfoque la caja de texto
	        $('#txtVehiculoBusq_servicios_internos_programacion_inventarios_fisicos').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoIDBusq_servicios_internos_programacion_inventarios_fisicos').val() == '' ||
	               $('#txtVehiculoBusq_servicios_internos_programacion_inventarios_fisicos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVehiculoIDBusq_servicios_internos_programacion_inventarios_fisicos').val('');
	               $('#txtVehiculoBusq_servicios_internos_programacion_inventarios_fisicos').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_servicios_internos_programacion_inventarios_fisicos').on('click','a',function(event){
				event.preventDefault();
				intPaginaServiciosInternosProgramacionInventariosFisicos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_servicios_internos_programacion_inventarios_fisicos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_servicios_internos_programacion_inventarios_fisicos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_servicios_internos_programacion_inventarios_fisicos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_servicios_internos_programacion_inventarios_fisicos').addClass("estatus-NUEVO");
				//Abrir modal
				 objServiciosInternosProgramacionInventariosFisicos = $('#ServiciosInternosProgramacionInventariosFisicosBox').bPopup({
											   appendTo: '#ServiciosInternosProgramacionInventariosFisicosContent', 
				                               contentContainer: 'ServiciosInternosProgramacionInventariosFisicosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtHora_servicios_internos_programacion_inventarios_fisicos').focus();
			});

			//Enfocar caja de texto
			$('#txtVehiculoBusq_servicios_internos_programacion_inventarios_fisicos').focus();

			//Deshabilitar los siguientes botones (funciones de permisos de acceso)
			$('#btnNuevo_servicios_internos_programacion_inventarios_fisicos').attr('disabled','-1');  
			$('#btnImprimir_servicios_internos_programacion_inventarios_fisicos').attr('disabled','-1');
			$('#btnDescargarXLS_servicios_internos_programacion_inventarios_fisicos').attr('disabled','-1');
			$('#btnBuscar_servicios_internos_programacion_inventarios_fisicos').attr('disabled','-1');
			$('#btnGuardar_servicios_internos_programacion_inventarios_fisicos').attr('disabled','-1');
			$('#btnDesactivar_servicios_internos_programacion_inventarios_fisicos').attr('disabled','-1');
			$('#btnRestaurar_servicios_internos_programacion_inventarios_fisicos').attr('disabled','-1');   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_servicios_internos_programacion_inventarios_fisicos();
		});
	</script>