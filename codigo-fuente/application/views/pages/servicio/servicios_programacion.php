	<div id="ServiciosProgramacionServicioContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_servicios_programacion_servicio" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_servicios_programacion_servicio" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_servicios_programacion_servicio">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_servicios_programacion_servicio'>
				                    <input class="form-control" id="txtFechaInicialBusq_servicios_programacion_servicio"
				                    		name= "strFechaInicialBusq_servicios_programacion_servicio" 
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
								<label for="txtFechaFinalBusq_servicios_programacion_servicio">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_servicios_programacion_servicio'>
				                    <input class="form-control" id="txtFechaFinalBusq_servicios_programacion_servicio"
				                    		name= "strFechaFinalBusq_servicios_programacion_servicio" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los clientes activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
								<input id="txtProspectoIDBusq_servicios_programacion_servicio" 
									   name="intProspectoIDBusq_servicios_programacion_servicio"  type="hidden" 
									   value="">
								</input>
								<label for="txtProspectoBusq_servicios_programacion_servicio">Cliente</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProspectoBusq_servicios_programacion_servicio" 
										name="strClienteBusq_servicios_programacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese cliente" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_servicios_programacion_servicio">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_servicios_programacion_servicio" 
								 		name="strEstatusBusq_servicios_programacion_servicio" tabindex="1">
								    <option value="TODOS">TODOS</option>
					  				<option value="ACTIVO">ACTIVO</option>
					  				<option value="REALIZADO">REALIZADO</option>                  				
					  				<option value="INACTIVO">INACTIVO</option>
									</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Autocomplete que contiene los mecánicos activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del mecánico seleccionado-->
								<input id="txtMecanicoIDBusq_servicios_programacion_servicio" 
									   name="intMecanicoIDBusq_servicios_programacion_servicio"  type="hidden" 
									   value="">
								</input>
								<label for="txtMecanicoBusq_servicios_programacion_servicio">Mecánico</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMecanicoBusq_servicios_programacion_servicio" 
										name="strMecanicoBusq_servicios_programacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese mecánico" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_servicios_programacion_servicio">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_servicios_programacion_servicio" 
										name="strBusqueda_servicios_programacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div  id="ToolBtns"  class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_servicios_programacion_servicio"
									onclick="paginacion_servicios_programacion_servicio();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_servicios_programacion_servicio" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_servicios_programacion_servicio"
									onclick="reporte_servicios_programacion_servicio('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_servicios_programacion_servicio"
									onclick="reporte_servicios_programacion_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Cliente"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "No. de orden"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Mecánico"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_servicios_programacion_servicio">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Cliente</th>
							<th class="movil">No. de orden</th>
							<th class="movil">Mecánico</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_servicios_programacion_servicio" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">
							<td class="movil">{{folio}}</td>
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{cliente}}</td>
							<td class="movil">{{folio_orden_reparacion}}</td>
							<td class="movil">{{mecanico}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_servicios_programacion_servicio({{servicio_programacion_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_servicios_programacion_servicio({{servicio_programacion_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_servicios_programacion_servicio({{servicio_programacion_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_servicios_programacion_servicio({{servicio_programacion_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_servicios_programacion_servicio"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_servicios_programacion_servicio">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="ServiciosProgramacionServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_servicios_programacion_servicio"  class="ModalBodyTitle">
			<h1>Programación de Servicios</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmServiciosProgramacionServicio" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmServiciosProgramacionServicio"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtServicioProgramacionID_servicios_programacion_servicio" 
										   name="intServicioProgramacionID_servicios_programacion_servicio" type="hidden" value="">
									</input>
									<label for="txtFolio_servicios_programacion_servicio">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_servicios_programacion_servicio" 
											name="strFolio_servicios_programacion_servicio" type="text" value="" 
											placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									
									<!-- Caja de texto oculta que se utiliza para recuperar la fecha anterior y así evitar duplicidad en caso de que exista otro registro con el mismo mecánico en la fecha-->
									<input id="txtFechaAnterior_servicios_programacion_servicio" name="strFechaAnterior_servicios_programacion_servicio" type="hidden" value="">
									</input>
									<label for="txtFecha_servicios_programacion_servicio">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_servicios_programacion_servicio'>
					                    <input class="form-control" id="txtFecha_servicios_programacion_servicio"
					                    		name= "strFecha_servicios_programacion_servicio" 
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
									<label for="txtHora_servicios_programacion_servicio">Hora</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div 	class="input-group bootstrap-timepicker timepicker" 
											id="dteHora_servicios_programacion_servicio">
							            <input 	id="txtHora_servicios_programacion_servicio"
							            		name= "strHora_servicios_programacion_servicio" 
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
						<!--Tipo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipo_servicios_programacion_servicio">Tipo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTipo_servicios_programacion_servicio" 
									 		name="strTipo_servicios_programacion_servicio" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="NORMAL">NORMAL</option>
                          				<option value="PRIORIDAD">PRIORIDAD</option>
                          				<option value="URGENTE">URGENTE</option>
                     				</select>
								</div>
							</div>
						</div>
						
					</div>
					<div class="row">
						<!--Autocomplete que contiene los clientes activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
									<input id="txtProspectoID_servicios_programacion_servicio" 
										   name="intProspectoID_servicios_programacion_servicio" type="hidden" value="">
									</input>
									<label for="txtProspecto_servicios_programacion_servicio">Cliente</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProspecto_servicios_programacion_servicio" 
											name="strProspecto_servicios_programacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese cliente" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Teléfono-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTelefono_servicios_programacion_servicio">Teléfono</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTelefono_servicios_programacion_servicio" 
											name="strTelefono_servicios_programacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese teléfono" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las ordenes de reparación activas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de reparación seleccionada-->
									<input id="txtOrdenReparacionID_servicios_programacion_servicio" 
										   name="intOrdenReparacionID_servicios_programacion_servicio"  type="hidden" 
										   value="">
									</input>
									<label for="txtOrdenReparacion_servicios_programacion_servicio">No. de orden</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtOrdenReparacion_servicios_programacion_servicio" 
											name="strOrdenReparacion_servicios_programacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese orden" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Ubicación-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbUbicacion_servicios_programacion_servicio">Ubicación</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbUbicacion_servicios_programacion_servicio" 
									 		name="strUbicacion_servicios_programacion_servicio" tabindex="1">
									    <option value="">Seleccione una opción</option>
	                      				<option value="PISO">PISO</option>
	                      				<option value="CAMPO">CAMPO</option>
	                      				<option value="CLIENTE">CLIENTE</option>
	                 				</select>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los mecánicos activos-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del mecánico seleccionado-->
									<input id="txtMecanicoID_servicios_programacion_servicio" 
										   name="intMecanicoID_servicios_programacion_servicio" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el mecánico anterior y así evitar duplicidad en caso de que exista otro registro con el mismo mecánico en la fecha-->
									<input id="txtMecanicoIDAnterior_servicios_programacion_servicio" 
										   name="intMecanicoIDAnterior_servicios_programacion_servicio" type="hidden" value="">
									<label for="txtMecanico_servicios_programacion_servicio">Mecánico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMecanico_servicios_programacion_servicio" 
											name="strMecanico_servicios_programacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese mecánico" maxlength="250">
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
									<label for="txtActividad_servicios_programacion_servicio">Actividad</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtActividad_servicios_programacion_servicio" 
											name="strActividad_servicios_programacion_servicio" type="text" value="" tabindex="1" placeholder="Ingrese actividad" maxlength="250">
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
									<label for="txtObservaciones_servicios_programacion_servicio">Observaciones</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtObservaciones_servicios_programacion_servicio" 
											   name="strObservaciones_servicios_programacion_servicio" rows="3" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_servicios_programacion_servicio"  
									onclick="validar_servicios_programacion_servicio();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_servicios_programacion_servicio"  
									onclick="cambiar_estatus_servicios_programacion_servicio('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_servicios_programacion_servicio"  
									onclick="cambiar_estatus_servicios_programacion_servicio('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_servicios_programacion_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_servicios_programacion_servicio();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ServiciosProgramacionServicioContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaServiciosProgramacionServicio = 0;
		var strUltimaBusquedaServiciosProgramacionServicio = "";
		//Variable que se utiliza para asignar objeto del modal
		var objServiciosProgramacionServicio = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_servicios_programacion_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/servicios_programacion/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_servicios_programacion_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosServiciosProgramacionServicio = data.row;
					//Separar la cadena 
					var arrPermisosServiciosProgramacionServicio = strPermisosServiciosProgramacionServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosServiciosProgramacionServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosServiciosProgramacionServicio[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_servicios_programacion_servicio').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosServiciosProgramacionServicio[i]=='GUARDAR') || (arrPermisosServiciosProgramacionServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_servicios_programacion_servicio').removeAttr('disabled');
						}
						else if(arrPermisosServiciosProgramacionServicio[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_servicios_programacion_servicio').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_servicios_programacion_servicio();
						}
						else if(arrPermisosServiciosProgramacionServicio[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_servicios_programacion_servicio').removeAttr('disabled');
							$('#btnRestaurar_servicios_programacion_servicio').removeAttr('disabled');
						}
						else if(arrPermisosServiciosProgramacionServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_servicios_programacion_servicio').removeAttr('disabled');
						}
						else if(arrPermisosServiciosProgramacionServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_servicios_programacion_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_servicios_programacion_servicio() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaServiciosProgramacionServicio =($('#txtFechaInicialBusq_servicios_programacion_servicio').val()+$('#txtFechaFinalBusq_servicios_programacion_servicio').val()+$('#txtProspectoIDBusq_servicios_programacion_servicio').val()+$('#cmbEstatusBusq_servicios_programacion_servicio').val()+$('#txtBusqueda_servicios_programacion_servicio').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaServiciosProgramacionServicio != strUltimaBusquedaServiciosProgramacionServicio)
			{
				intPaginaServiciosProgramacionServicio = 0;
				strUltimaBusquedaServiciosProgramacionServicio = strNuevaBusquedaServiciosProgramacionServicio;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/servicios_programacion/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_servicios_programacion_servicio').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_servicios_programacion_servicio').val()),
						intProspectoID: $('#txtProspectoIDBusq_servicios_programacion_servicio').val(),
						intMecanicoID: $('#txtMecanicoIDBusq_servicios_programacion_servicio').val(),
						strEstatus:     $('#cmbEstatusBusq_servicios_programacion_servicio').val(),
						strBusqueda:    $('#txtBusqueda_servicios_programacion_servicio').val(),
						intPagina:intPaginaServiciosProgramacionServicio,
						strPermisosAcceso: $('#txtAcciones_servicios_programacion_servicio').val()
					},
					function(data){
						$('#dg_servicios_programacion_servicio tbody').empty();
						var tmpServiciosProgramacionServicio = Mustache.render($('#plantilla_servicios_programacion_servicio').html(),data);
						$('#dg_servicios_programacion_servicio tbody').html(tmpServiciosProgramacionServicio);
						$('#pagLinks_servicios_programacion_servicio').html(data.paginacion);
						$('#numElementos_servicios_programacion_servicio').html(data.total_rows);
						intPaginaServiciosProgramacionServicio = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_servicios_programacion_servicio(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/servicios_programacion/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_servicios_programacion_servicio').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_servicios_programacion_servicio').val()),
										'intProspectoID': $('#txtProspectoIDBusq_servicios_programacion_servicio').val(),
										'intMecanicoID': $('#txtMecanicoIDBusq_servicios_programacion_servicio').val(),
										'strEstatus': $('#cmbEstatusBusq_servicios_programacion_servicio').val(),
										'strBusqueda': $('#txtBusqueda_servicios_programacion_servicio').val()
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
			
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_servicios_programacion_servicio()
		{
			//Incializar formulario
			$('#frmServiciosProgramacionServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicios_programacion_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmServiciosProgramacionServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_servicios_programacion_servicio');
			//Habilitar todos los elementos del formulario
			$('#frmServiciosProgramacionServicio').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_servicios_programacion_servicio').val(fechaActual());
			//Asignar la hora actual
			$('#txtHora_servicios_programacion_servicio').timepicker('setTime', horaActual('no'));
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_servicios_programacion_servicio').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_servicios_programacion_servicio").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_servicios_programacion_servicio").hide();
			$("#btnRestaurar_servicios_programacion_servicio").hide();
		}

		//Función para inicializar elementos del prospecto
		function inicializar_prospecto_servicios_programacion_servicio()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtTelefono_servicios_programacion_servicio').val('');
			$('#txtOrdenReparacion_servicios_programacion_servicio').val('');
			$('#txtOrdenReparacionID_servicios_programacion_servicio').val('');
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_servicios_programacion_servicio()
		{
			try {
				//Cerrar modal
				objServiciosProgramacionServicio.close();
				//Enfocar caja de texto 
				$('#txtProspectoBusq_servicios_programacion_servicio').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_servicios_programacion_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_servicios_programacion_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmServiciosProgramacionServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_servicios_programacion_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strHora_servicios_programacion_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una hora'}
											}
										},
										strTipo_servicios_programacion_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										},
										strUbicacion_servicios_programacion_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una ubicación'}
											}
										},
										strProspecto_servicios_programacion_servicio: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del cliente
					                                    if($('#txtProspectoID_servicios_programacion_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un cliente existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strTelefono_servicios_programacion_servicio: {
											validators: {
												notEmpty: {message: 'Escriba un número telefónico'},
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strOrdenReparacion_servicios_programacion_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la orden de reparación
					                                    if(value !== '' && $('#txtOrdenReparacionID_servicios_programacion_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una orden de trabajo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strMecanico_servicios_programacion_servicio: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del mecánico
					                                    if($('#txtMecanicoID_servicios_programacion_servicio').val() === '')
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
										strActividad_servicios_programacion_servicio: {
											validators: {
												notEmpty: {message: 'Escriba una actividad'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_servicios_programacion_servicio = $('#frmServiciosProgramacionServicio').data('bootstrapValidator');
			bootstrapValidator_servicios_programacion_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_servicios_programacion_servicio.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_servicios_programacion_servicio();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_servicios_programacion_servicio()
		{
			try
			{
				$('#frmServiciosProgramacionServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_servicios_programacion_servicio()
		{
			//Asignar datos de la fecha y hora
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaServicioProg = $.formatFechaMysql($('#txtFecha_servicios_programacion_servicio').val());
			//Hacer un llamado a la función para convertir hora a formato 24
			var strHoraServicioProg = convertirHora12a24($('#txtHora_servicios_programacion_servicio').val());

			//Concatenar los datos de la fecha y hora
			dteFechaServicioProg += ' '+strHoraServicioProg;
			
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('servicio/servicios_programacion/guardar',
					{ 
						intServicioProgramacionID: $('#txtServicioProgramacionID_servicios_programacion_servicio').val(),
						dteFecha: dteFechaServicioProg,
						dteFechaAnterior: $('#txtFechaAnterior_servicios_programacion_servicio').val(),
						strTipo: $('#cmbTipo_servicios_programacion_servicio').val(),
						strUbicacion: $('#cmbUbicacion_servicios_programacion_servicio').val(),
						intProspectoID: $('#txtProspectoID_servicios_programacion_servicio').val(),
						strTelefono: $('#txtTelefono_servicios_programacion_servicio').val(),
						intMecanicoID: $('#txtMecanicoID_servicios_programacion_servicio').val(),
						intMecanicoIDAnterior: $('#txtMecanicoIDAnterior_servicios_programacion_servicio').val(),
						strActividad: $('#txtActividad_servicios_programacion_servicio').val(),
						strObservaciones: $('#txtObservaciones_servicios_programacion_servicio').val(),
						intOrdenReparacionID: $('#txtOrdenReparacionID_servicios_programacion_servicio').val(), 
						intProcesoMenuID: $('#txtProcesoMenuID_servicios_programacion_servicio').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_servicios_programacion_servicio();
							//Hacer un llamado a la función para cerrar modal
							cerrar_servicios_programacion_servicio();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_servicios_programacion_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_servicios_programacion_servicio(tipoMensaje, mensaje)
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
		function cambiar_estatus_servicios_programacion_servicio(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtServicioProgramacionID_servicios_programacion_servicio').val();

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
				              'title':    'Programación de Servicios',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_servicios_programacion_servicio(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_servicios_programacion_servicio(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_servicios_programacion_servicio(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('servicio/servicios_programacion/set_estatus',
			      {intServicioProgramacionID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_servicios_programacion_servicio();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_servicios_programacion_servicio();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_servicios_programacion_servicio(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_servicios_programacion_servicio(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/servicios_programacion/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_servicios_programacion_servicio();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar datos de la fecha y hora
							//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
							var dteFechaAnterior = $.formatFechaMysql(data.row.fecha);
							//Hacer un llamado a la función para convertir hora a formato 24
							var strHoraAnterior = convertirHora12a24(data.row.hora);

							//Concatenar los datos de la fecha y hora
							dteFechaAnterior += ' '+strHoraAnterior;

				          	//Recuperar valores
				            $('#txtServicioProgramacionID_servicios_programacion_servicio').val(data.row.servicio_programacion_id);
				            $('#txtFolio_servicios_programacion_servicio').val(data.row.folio);
				            $('#txtFecha_servicios_programacion_servicio').val(data.row.fecha);
				            $('#txtHora_servicios_programacion_servicio').timepicker('setTime', data.row.hora);
				            $('#txtFechaAnterior_servicios_programacion_servicio').val(dteFechaAnterior);
				            $('#cmbTipo_servicios_programacion_servicio').val(data.row.tipo);
				            $('#cmbUbicacion_servicios_programacion_servicio').val(data.row.ubicacion);
				            $('#txtProspectoID_servicios_programacion_servicio').val(data.row.prospecto_id);
				            $('#txtProspecto_servicios_programacion_servicio').val(data.row.cliente);
				            $('#txtTelefono_servicios_programacion_servicio').val(data.row.telefono);
				            $('#txtMecanicoID_servicios_programacion_servicio').val(data.row.mecanico_id);
				            $('#txtMecanicoIDAnterior_servicios_programacion_servicio').val(data.row.mecanico_id);
				            $('#txtMecanico_servicios_programacion_servicio').val(data.row.mecanico);
				            $('#txtActividad_servicios_programacion_servicio').val(data.row.actividad);
				            $('#txtObservaciones_servicios_programacion_servicio').val(data.row.observaciones);
				            $('#txtOrdenReparacionID_servicios_programacion_servicio').val(data.row.orden_reparacion_id);
				             $('#txtOrdenReparacion_servicios_programacion_servicio').val(data.row.folio_orden_reparacion);
				            //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_servicios_programacion_servicio').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_servicios_programacion_servicio").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmServiciosProgramacionServicio').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_servicios_programacion_servicio").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_servicios_programacion_servicio").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objServiciosProgramacionServicio = $('#ServiciosProgramacionServicioBox').bPopup({
															  appendTo: '#ServiciosProgramacionServicioContent', 
								                              contentContainer: 'ServiciosProgramacionServicioM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#cmbTipo_servicios_programacion_servicio').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_servicios_programacion_servicio()
		{
			//Si no existe id, verificar la existencia del mecánico
			if ($('#txtServicioProgramacionID_servicios_programacion_servicio').val() == '' 
				&& $('#txtFecha_servicios_programacion_servicio').val() != '' &&
				$('#txtHora_servicios_programacion_servicio').val() != '' && $('#txtMecanicoID_servicios_programacion_servicio').val() != '')
			{
				//Asignar datos de la fecha y hora
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFechaServicioProg = $.formatFechaMysql($('#txtFecha_servicios_programacion_servicio').val());
				//Hacer un llamado a la función para convertir hora a formato 24
				var strHoraServicioProg = convertirHora12a24($('#txtHora_servicios_programacion_servicio').val());

				//Concatenar los datos de la fecha y hora
				dteFechaServicioProg += ' '+strHoraServicioProg;

				//Concatenar criterios de búsqueda (para poder verificar la existencia del mecánico en la fecha)
				var strCriteriosBusqServiciosProgramacionServicio = dteFechaServicioProg+'|'+$('#txtMecanicoID_servicios_programacion_servicio').val();
				//Hacer un llamado a la función para recuperar los datos del registro que coincide con el mecánico 
				editar_servicios_programacion_servicio(strCriteriosBusqServiciosProgramacionServicio, 'mecanico', 'Nuevo');
			}
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos númericos (solamente valores enteros y positivos)
			$('#txtTelefono_servicios_programacion_servicio').numeric({decimal: false, negative: false});
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_servicios_programacion_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			//Agregar timepicker para seleccionar una hora
			$('#txtHora_servicios_programacion_servicio').timepicker({minuteStep: 1});

			//Comprobar la existencia del servicio en la BD cuando cambie la fecha
			$('#dteFecha_servicios_programacion_servicio').on('dp.change', function (e) {
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_servicios_programacion_servicio();
			});


			//Comprobar la existencia del servicio en la BD cuando pierda el enfoque la caja de texto
			$('#txtHora_servicios_programacion_servicio').focusout(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_servicios_programacion_servicio();
			});


			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtProspecto_servicios_programacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_servicios_programacion_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos del prospecto
	               inicializar_prospecto_servicios_programacion_servicio();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/clientes/autocomplete",
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
	             //Asignar valores del registro seleccionado
	             $('#txtProspectoID_servicios_programacion_servicio').val(ui.item.data);
	             $('#txtTelefono_servicios_programacion_servicio').val(ui.item.telefono);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del cliente cuando pierda el enfoque la caja de texto
	        $('#txtProspecto_servicios_programacion_servicio').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_servicios_programacion_servicio').val() == '' ||
	               $('#txtProspecto_servicios_programacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_servicios_programacion_servicio').val('');
	               $('#txtProspecto_servicios_programacion_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos del prospecto
	               inicializar_prospecto_servicios_programacion_servicio();
	            }

	        });

	         //Autocomplete para recuperar los datos de una orden de reparación 
	        $('#txtOrdenReparacion_servicios_programacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtOrdenReparacionID_servicios_programacion_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/ordenes_reparacion/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strEstatus: 'ACTIVO',
	                   intProspectoID: $('#txtProspectoID_servicios_programacion_servicio').val() 

	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	              //Asignar valores del registro seleccionado
	              $('#txtOrdenReparacionID_servicios_programacion_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la orden de reparación interna cuando pierda el enfoque la caja de texto
	        $('#txtOrdenReparacion_servicios_programacion_servicio').focusout(function(e){
	            //Si no existe id de la orden de reparación interna
	            if($('#txtOrdenReparacionID_servicios_programacion_servicio').val() == '' ||
	               $('#txtOrdenReparacion_servicios_programacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtOrdenReparacionID_servicios_programacion_servicio').val('');
	               $('#txtOrdenReparacion_servicios_programacion_servicio').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un mecánico 
	        $('#txtMecanico_servicios_programacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMecanicoID_servicios_programacion_servicio').val('');
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
	             $('#txtMecanicoID_servicios_programacion_servicio').val(ui.item.data);
				 //Hacer un llamado a la función para verificar la existencia del registro
	             verificar_existencia_servicios_programacion_servicio();
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
	        $('#txtMecanico_servicios_programacion_servicio').focusout(function(e){
	            //Si no existe id del mecánico
	            if($('#txtMecanicoID_servicios_programacion_servicio').val() == '' || 
	               $('#txtMecanico_servicios_programacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMecanicoID_servicios_programacion_servicio').val('');
	               $('#txtMecanico_servicios_programacion_servicio').val('');
	            }

	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_servicios_programacion_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_servicios_programacion_servicio').datetimepicker({format: 'DD/MM/YYYY',
			 																		useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_servicios_programacion_servicio').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_servicios_programacion_servicio').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_servicios_programacion_servicio').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_servicios_programacion_servicio').data('DateTimePicker').maxDate(e.date);
			});

			//Asignar la fecha actual
			$('#txtFechaInicialBusq_servicios_programacion_servicio').val(fechaActual()); 
			$('#txtFechaFinalBusq_servicios_programacion_servicio').val(fechaActual()); 
			
			//Autocomplete para recuperar los datos de un mecánico 
	        $('#txtMecanicoBusq_servicios_programacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMecanicoIDBusq_servicios_programacion_servicio').val('');
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
	             $('#txtMecanicoIDBusq_servicios_programacion_servicio').val(ui.item.data);
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
	        $('#txtMecanicoBusq_servicios_programacion_servicio').focusout(function(e){
	            //Si no existe id del mecánico
	            if($('#txtMecanicoIDBusq_servicios_programacion_servicio').val() == '' ||
	               $('#txtMecanicoBusq_servicios_programacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMecanicoIDBusq_servicios_programacion_servicio').val('');
	               $('#txtMecanicoBusq_servicios_programacion_servicio').val('');
	            }

	        });

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtProspectoBusq_servicios_programacion_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_servicios_programacion_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/clientes/autocomplete",
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
	             $('#txtProspectoIDBusq_servicios_programacion_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del cliente cuando pierda el enfoque la caja de texto
	        $('#txtProspectoBusq_servicios_programacion_servicio').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_servicios_programacion_servicio').val() == '' ||
	               $('#txtProspectoBusq_servicios_programacion_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_servicios_programacion_servicio').val('');
	               $('#txtProspectoBusq_servicios_programacion_servicio').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_servicios_programacion_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaServiciosProgramacionServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_servicios_programacion_servicio();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_servicios_programacion_servicio').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_servicios_programacion_servicio();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_servicios_programacion_servicio').addClass("estatus-NUEVO");
				//Abrir modal
				 objServiciosProgramacionServicio = $('#ServiciosProgramacionServicioBox').bPopup({
											   appendTo: '#ServiciosProgramacionServicioContent', 
				                               contentContainer: 'ServiciosProgramacionServicioM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbTipo_servicios_programacion_servicio').focus();
			});

			//Enfocar caja de texto
			$('#txtProspectoBusq_servicios_programacion_servicio').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_servicios_programacion_servicio();
		});
	</script>