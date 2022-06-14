	<div id="ChoferesActividadesRegistroMaquinariaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_choferes_actividades_registro_maquinaria" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_choferes_actividades_registro_maquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_choferes_actividades_registro_maquinaria">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_choferes_actividades_registro_maquinaria'>
				                    <input class="form-control" id="txtFechaInicialBusq_choferes_actividades_registro_maquinaria"
				                    		name= "strFechaInicialBusq_choferes_actividades_registro_maquinaria" 
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
								<label for="txtFechaFinalBusq_choferes_actividades_registro_maquinaria">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_choferes_actividades_registro_maquinaria'>
				                    <input class="form-control" id="txtFechaFinalBusq_choferes_actividades_registro_maquinaria"
				                    		name= "strFechaFinalBusq_choferes_actividades_registro_maquinaria" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los choferes activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del chofer seleccionado-->
								<input id="txtChoferIDBusq_choferes_actividades_registro_maquinaria" 
									   name="intChoferIDBusq_choferes_actividades_registro_maquinaria"  type="hidden" 
									   value="">
								</input>
								<label for="txtChoferBusq_choferes_actividades_registro_maquinaria">Chofer</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtChoferBusq_choferes_actividades_registro_maquinaria" 
										name="strChoferBusq_choferes_actividades_registro_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese chofer" maxlength="250">
								</input>
							</div>
						</div>
					</div>
				    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_choferes_actividades_registro_maquinaria">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_choferes_actividades_registro_maquinaria" 
								 		name="strEstatusBusq_choferes_actividades_registro_maquinaria" tabindex="1">
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
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_choferes_actividades_registro_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_choferes_actividades_registro_maquinaria" 
										name="strBusqueda_choferes_actividades_registro_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-sm-offset-3 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_choferes_actividades_registro_maquinaria"
									onclick="paginacion_choferes_actividades_registro_maquinaria();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_choferes_actividades_registro_maquinaria" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_choferes_actividades_registro_maquinaria"
									onclick="reporte_choferes_actividades_registro_maquinaria('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_choferes_actividades_registro_maquinaria"
									onclick="reporte_choferes_actividades_registro_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(3):before {content: "Chofer"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Cliente"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_choferes_actividades_registro_maquinaria">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Chofer</th>
							<th class="movil">Cliente</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_choferes_actividades_registro_maquinaria" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{folio}}</td>
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{chofer}}</td>
							<td class="movil">{{cliente}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_choferes_actividades_registro_maquinaria({{chofer_actividad_registro_id}})"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_choferes_actividades_registro_maquinaria({{chofer_actividad_registro_id}});" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_choferes_actividades_registro_maquinaria({{chofer_actividad_registro_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_choferes_actividades_registro_maquinaria({{chofer_actividad_registro_id}},'{{estatus}}')"  title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="6"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_choferes_actividades_registro_maquinaria"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_choferes_actividades_registro_maquinaria">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="ChoferesActividadesRegistroMaquinariaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_choferes_actividades_registro_maquinaria"  class="ModalBodyTitle">
			<h1>Registro de Actividades de los Choferes</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmChoferesActividadesRegistroMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmChoferesActividadesRegistroMaquinaria"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtChoferActividadRegistroID_choferes_actividades_registro_maquinaria" 
										   name="intChoferActividadRegistroID_choferes_actividades_registro_maquinaria" type="hidden" value="">
									</input>
									<label for="txtFolio_choferes_actividades_registro_maquinaria">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_choferes_actividades_registro_maquinaria" 
											name="strFolio_choferes_actividades_registro_maquinaria" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_choferes_actividades_registro_maquinaria">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_choferes_actividades_registro_maquinaria'>
					                    <input class="form-control" id="txtFecha_choferes_actividades_registro_maquinaria"
					                    		name= "strFecha_choferes_actividades_registro_maquinaria" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Cargar a-->
                  		<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                  			<!--Div que contiene los campos de cargar a-->
                            <div class="form-group row">
                                <!--Etiqueta del encabezado-->
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                    <label for="txtDepartamento_choferes_actividades_registro_maquinaria">Cargar a</label>
                                </div>
                                <!--Autocomplete que contiene los departamentos activos-->
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                                	<!-- Caja de texto oculta que se utiliza para recuperar el id del departamento seleccionado-->
									<input id="txtDepartamentoID_choferes_actividades_registro_maquinaria" 
										   name="intDepartamentoID_choferes_actividades_registro_maquinaria"  type="hidden" 
										   value="">
									</input>
                                    <input  class="form-control" id="txtDepartamento_choferes_actividades_registro_maquinaria" 
											name="strDepartamento_choferes_actividades_registro_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese departamento" maxlength="250">
									</input>
                                </div>
                                <!--Autocomplete que contiene las sucursales activas-->
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                                	<!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal seleccionada-->
									<input id="txtSucursalID_choferes_actividades_registro_maquinaria" 
									       name="intSucursalID_choferes_actividades_registro_maquinaria" type="hidden" value="">
									</input>
                                    <input  class="form-control" id="txtSucursal_choferes_actividades_registro_maquinaria" 
											name="strSucursal_choferes_actividades_registro_maquinaria" type="text" value="" 
											tabindex="1" placeholder="Ingrese sucursal" maxlength="250">
									</input>
                                </div>
                            </div>
                  		</div>
                  	</div>
				    <div class="row">
				    	<!--Autocomplete que contiene los choferes activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del chofer seleccionado-->
									<input id="txtChoferID_choferes_actividades_registro_maquinaria" 
										   name="intChoferID_choferes_actividades_registro_maquinaria"  type="hidden" value="">
									</input>
									<label for="txtChofer_choferes_actividades_registro_maquinaria">Chofer</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtChofer_choferes_actividades_registro_maquinaria" 
											name="strChofer_choferes_actividades_registro_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese chofer" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los clientes activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
									<input id="txtProspectoID_choferes_actividades_registro_maquinaria" 
										   name="intProspectoID_choferes_actividades_registro_maquinaria"  type="hidden" value="">
									</input>
									<label for="txtCliente_choferes_actividades_registro_maquinaria">Cliente</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCliente_choferes_actividades_registro_maquinaria" 
											name="strCliente_choferes_actividades_registro_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese cliente" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Autocomplete que contiene las actividades de los choferes activas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la actividad seleccionada-->
									<input id="txtChoferActividadID_choferes_actividades_registro_maquinaria" 
										   name="intChoferActividadID_choferes_actividades_registro_maquinaria"  type="hidden" value="">
									</input>
									<label for="txtChoferActividad_choferes_actividades_registro_maquinaria">Actividad</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtChoferActividad_choferes_actividades_registro_maquinaria" 
											name="strChoferActividad_choferes_actividades_registro_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese actividad" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Comisión-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtComision_choferes_actividades_registro_maquinaria">Comisión</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_choferes_actividades_registro_maquinaria" id="txtComision_choferes_actividades_registro_maquinaria" 
												name="intComision_choferes_actividades_registro_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese comisión" maxlength="12">
										</input>
										
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Equipo-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtEquipo_choferes_actividades_registro_maquinaria">Equipo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEquipo_choferes_actividades_registro_maquinaria" 
											name="strEquipo_choferes_actividades_registro_maquinaria" type="text" 
											value="" tabindex="1" placeholder="Ingrese equipo" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Serie-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSerie_choferes_actividades_registro_maquinaria">Serie</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSerie_choferes_actividades_registro_maquinaria" 
											name="strSerie_choferes_actividades_registro_maquinaria" type="text" 
											value="" tabindex="1" placeholder="Ingrese serie" maxlength="30">
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
									<label for="txtComentario_choferes_actividades_registro_maquinaria">Comentario</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtComentario_choferes_actividades_registro_maquinaria" 
											   name="strComentario_choferes_actividades_registro_maquinaria" rows="3" value="" tabindex="1" placeholder="Ingrese comentario" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_choferes_actividades_registro_maquinaria"  
									onclick="validar_choferes_actividades_registro_maquinaria();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_choferes_actividades_registro_maquinaria"  
									onclick="cambiar_estatus_choferes_actividades_registro_maquinaria('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_choferes_actividades_registro_maquinaria"  
									onclick="cambiar_estatus_choferes_actividades_registro_maquinaria('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_choferes_actividades_registro_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_choferes_actividades_registro_maquinaria();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ChoferesActividadesRegistroMaquinariaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaChoferesActividadesRegistroMaquinaria = 0;
		var strUltimaBusquedaChoferesActividadesRegistroMaquinaria = "";
		//Variable que se utiliza para asignar objeto del modal
		var objChoferesActividadesRegistroMaquinaria = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_choferes_actividades_registro_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/choferes_actividades_registro/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_choferes_actividades_registro_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosChoferesActividadesRegistroMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosChoferesActividadesRegistroMaquinaria = strPermisosChoferesActividadesRegistroMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosChoferesActividadesRegistroMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosChoferesActividadesRegistroMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_choferes_actividades_registro_maquinaria').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosChoferesActividadesRegistroMaquinaria[i]=='GUARDAR') || (arrPermisosChoferesActividadesRegistroMaquinaria[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_choferes_actividades_registro_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosChoferesActividadesRegistroMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_choferes_actividades_registro_maquinaria').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_choferes_actividades_registro_maquinaria();
						}
						else if(arrPermisosChoferesActividadesRegistroMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_choferes_actividades_registro_maquinaria').removeAttr('disabled');
							$('#btnRestaurar_choferes_actividades_registro_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosChoferesActividadesRegistroMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_choferes_actividades_registro_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosChoferesActividadesRegistroMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_choferes_actividades_registro_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_choferes_actividades_registro_maquinaria() 
		{

			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaChoferesActividadesRegistroMaquinaria =($('#txtFechaInicialBusq_choferes_actividades_registro_maquinaria').val()+$('#txtFechaFinalBusq_choferes_actividades_registro_maquinaria').val()+$('#txtChoferIDBusq_choferes_actividades_registro_maquinaria').val()+$('#cmbEstatusBusq_choferes_actividades_registro_maquinaria').val()+$('#txtBusqueda_choferes_actividades_registro_maquinaria').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaChoferesActividadesRegistroMaquinaria != strUltimaBusquedaChoferesActividadesRegistroMaquinaria)
			{
				intPaginaChoferesActividadesRegistroMaquinaria = 0;
				strUltimaBusquedaChoferesActividadesRegistroMaquinaria = strNuevaBusquedaChoferesActividadesRegistroMaquinaria;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('maquinaria/choferes_actividades_registro/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_choferes_actividades_registro_maquinaria').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_choferes_actividades_registro_maquinaria').val()),
						intChoferID: $('#txtChoferIDBusq_choferes_actividades_registro_maquinaria').val(),
						strEstatus:     $('#cmbEstatusBusq_choferes_actividades_registro_maquinaria').val(),
    					strBusqueda:    $('#txtBusqueda_choferes_actividades_registro_maquinaria').val(),
						intPagina:intPaginaChoferesActividadesRegistroMaquinaria,
						strPermisosAcceso: $('#txtAcciones_choferes_actividades_registro_maquinaria').val()
					},
					function(data){
						$('#dg_choferes_actividades_registro_maquinaria tbody').empty();
						var tmpChoferesActividadesRegistroMaquinaria = Mustache.render($('#plantilla_choferes_actividades_registro_maquinaria').html(),data);
						$('#dg_choferes_actividades_registro_maquinaria tbody').html(tmpChoferesActividadesRegistroMaquinaria);
						$('#pagLinks_choferes_actividades_registro_maquinaria').html(data.paginacion);
						$('#numElementos_choferes_actividades_registro_maquinaria').html(data.total_rows);
						intPaginaChoferesActividadesRegistroMaquinaria = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_choferes_actividades_registro_maquinaria(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/choferes_actividades_registro/';


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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_choferes_actividades_registro_maquinaria').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_choferes_actividades_registro_maquinaria').val()),
										'intChoferID': $('#txtChoferIDBusq_choferes_actividades_registro_maquinaria').val(),
										'strEstatus': $('#cmbEstatusBusq_choferes_actividades_registro_maquinaria').val(), 
										'strBusqueda': $('#txtBusqueda_choferes_actividades_registro_maquinaria').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		
		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_choferes_actividades_registro_maquinaria()
		{
			//Incializar formulario
			$('#frmChoferesActividadesRegistroMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_choferes_actividades_registro_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmChoferesActividadesRegistroMaquinaria').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_choferes_actividades_registro_maquinaria');
			//Habilitar todos los elementos del formulario
			$('#frmChoferesActividadesRegistroMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_choferes_actividades_registro_maquinaria').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_choferes_actividades_registro_maquinaria').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_choferes_actividades_registro_maquinaria").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_choferes_actividades_registro_maquinaria").hide();
			$("#btnRestaurar_choferes_actividades_registro_maquinaria").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_choferes_actividades_registro_maquinaria()
		{
			try {
				//Cerrar modal
				objChoferesActividadesRegistroMaquinaria.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_choferes_actividades_registro_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_choferes_actividades_registro_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_choferes_actividades_registro_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmChoferesActividadesRegistroMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_choferes_actividades_registro_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strDepartamento_choferes_actividades_registro_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del departamento
					                                    if($('#txtDepartamentoID_choferes_actividades_registro_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un departamento existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strSucursal_choferes_actividades_registro_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la sucursal
					                                    if($('#txtSucursalID_choferes_actividades_registro_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una sucursal existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strChofer_choferes_actividades_registro_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del chofer
					                                    if($('#txtChoferID_choferes_actividades_registro_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un chofer existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCliente_choferes_actividades_registro_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del cliente
					                                    if(value !== '' && $('#txtProspectoID_choferes_actividades_registro_maquinaria').val() === '')
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
										strChoferActividad_choferes_actividades_registro_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la actividad de choferes
					                                    if($('#txtChoferActividadID_choferes_actividades_registro_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una actividad existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intComision_choferes_actividades_registro_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba una comisión'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_choferes_actividades_registro_maquinaria = $('#frmChoferesActividadesRegistroMaquinaria').data('bootstrapValidator');
			bootstrapValidator_choferes_actividades_registro_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_choferes_actividades_registro_maquinaria.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_choferes_actividades_registro_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_choferes_actividades_registro_maquinaria()
		{
			try
			{
				$('#frmChoferesActividadesRegistroMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_choferes_actividades_registro_maquinaria()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('maquinaria/choferes_actividades_registro/guardar',
					{ 
						intChoferActividadRegistroID: $('#txtChoferActividadRegistroID_choferes_actividades_registro_maquinaria').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_choferes_actividades_registro_maquinaria').val()),
						intChoferID: $('#txtChoferID_choferes_actividades_registro_maquinaria').val(),
						intSucursalID: $('#txtSucursalID_choferes_actividades_registro_maquinaria').val(),
						intDepartamentoID: $('#txtSucursalID_choferes_actividades_registro_maquinaria').val(),
						intProspectoID: $('#txtProspectoID_choferes_actividades_registro_maquinaria').val(),
						intChoferActividadID: $('#txtChoferActividadID_choferes_actividades_registro_maquinaria').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intComision: $.reemplazar($('#txtComision_choferes_actividades_registro_maquinaria').val(), ",", ""),
						strEquipo: $('#txtEquipo_choferes_actividades_registro_maquinaria').val(),
						strSerie: $('#txtSerie_choferes_actividades_registro_maquinaria').val(),
						strComentario: $('#txtComentario_choferes_actividades_registro_maquinaria').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_choferes_actividades_registro_maquinaria').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_choferes_actividades_registro_maquinaria();
							//Hacer un llamado a la función para cerrar modal
							cerrar_choferes_actividades_registro_maquinaria();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_choferes_actividades_registro_maquinaria(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_choferes_actividades_registro_maquinaria(tipoMensaje, mensaje)
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
		function cambiar_estatus_choferes_actividades_registro_maquinaria(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtChoferActividadRegistroID_choferes_actividades_registro_maquinaria').val();

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
						              'title':    'Registro de Actividades de los Choferes',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado a la función para modificar el estatus del registro
													  set_estatus_choferes_actividades_registro_maquinaria(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_choferes_actividades_registro_maquinaria(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_choferes_actividades_registro_maquinaria(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('maquinaria/choferes_actividades_registro/set_estatus',
			      {intChoferActividadRegistroID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_choferes_actividades_registro_maquinaria();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_choferes_actividades_registro_maquinaria();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_choferes_actividades_registro_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_choferes_actividades_registro_maquinaria(id)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/choferes_actividades_registro/get_datos',
			       {intChoferActividadRegistroID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_choferes_actividades_registro_maquinaria();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				          	$('#txtChoferActividadRegistroID_choferes_actividades_registro_maquinaria').val(data.row.chofer_actividad_registro_id);
				          	$('#txtFolio_choferes_actividades_registro_maquinaria').val(data.row.folio);
				          	$('#txtFecha_choferes_actividades_registro_maquinaria').val(data.row.fecha);
						    $('#txtChoferID_choferes_actividades_registro_maquinaria').val(data.row.chofer_id);
						    $('#txtChofer_choferes_actividades_registro_maquinaria').val(data.row.chofer);
						    $('#txtSucursalID_choferes_actividades_registro_maquinaria').val(data.row.sucursal_id);
						    $('#txtSucursal_choferes_actividades_registro_maquinaria').val(data.row.sucursal);
						    $('#txtDepartamentoID_choferes_actividades_registro_maquinaria').val(data.row.departamento_id);
						    $('#txtDepartamento_choferes_actividades_registro_maquinaria').val(data.row.departamento);
						    $('#txtProspectoID_choferes_actividades_registro_maquinaria').val(data.row.prospecto_id);
						    $('#txtCliente_choferes_actividades_registro_maquinaria').val(data.row.cliente);
						    $('#txtChoferActividadID_choferes_actividades_registro_maquinaria').val(data.row.chofer_actividad_id);
						    $('#txtChoferActividad_choferes_actividades_registro_maquinaria').val(data.row.chofer_actividad);
						    $('#txtComision_choferes_actividades_registro_maquinaria').val(data.row.comision);
						     //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtComision_choferes_actividades_registro_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
						    $('#txtEquipo_choferes_actividades_registro_maquinaria').val(data.row.equipo);
						    $('#txtSerie_choferes_actividades_registro_maquinaria').val(data.row.serie);
					        $('#txtComentario_choferes_actividades_registro_maquinaria').val(data.row.comentario);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_choferes_actividades_registro_maquinaria').addClass("estatus-"+strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_choferes_actividades_registro_maquinaria").show();
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
				            	$('#frmChoferesActividadesRegistroMaquinaria').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					           	$("#btnGuardar_choferes_actividades_registro_maquinaria").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_choferes_actividades_registro_maquinaria").show();
							}

			            	//Abrir modal
				            objChoferesActividadesRegistroMaquinaria = $('#ChoferesActividadesRegistroMaquinariaBox').bPopup({
														  appendTo: '#ChoferesActividadesRegistroMaquinariaContent', 
							                              contentContainer: 'ChoferesActividadesRegistroMaquinariaM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtDepartamento_choferes_actividades_registro_maquinaria').focus();
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
			$('#dteFecha_choferes_actividades_registro_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
			//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtComision_choferes_actividades_registro_maquinaria').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_choferes_actividades_registro_maquinaria').blur(function(){
				$('.moneda_choferes_actividades_registro_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
			});

	        //Autocomplete para recuperar los datos de un departamento
	        $('#txtDepartamento_choferes_actividades_registro_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtDepartamentoID_choferes_actividades_registro_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/departamentos/autocomplete",
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
	             $('#txtDepartamentoID_choferes_actividades_registro_maquinaria').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del departamento cuando pierda el enfoque la caja de texto
	        $('#txtDepartamento_choferes_actividades_registro_maquinaria').focusout(function(e){
	            //Si no existe id del departamento
	            if($('#txtDepartamentoID_choferes_actividades_registro_maquinaria').val() == '' ||
	               $('#txtDepartamento_choferes_actividades_registro_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtDepartamentoID_choferes_actividades_registro_maquinaria').val('');
	               $('#txtDepartamento_choferes_actividades_registro_maquinaria').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una sucursal
	        $('#txtSucursal_choferes_actividades_registro_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSucursalID_choferes_actividades_registro_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "administracion/sucursales/autocomplete",
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
	             $('#txtSucursalID_choferes_actividades_registro_maquinaria').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la sucursal cuando pierda el enfoque la caja de texto
	        $('#txtSucursal_choferes_actividades_registro_maquinaria').focusout(function(e){
	            //Si no existe id de la sucursal
	            if($('#txtSucursalID_choferes_actividades_registro_maquinaria').val() == '' ||
	               $('#txtSucursal_choferes_actividades_registro_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSucursalID_choferes_actividades_registro_maquinaria').val('');
	               $('#txtSucursal_choferes_actividades_registro_maquinaria').val('');
	            }

	        });
	        
        	//Autocomplete para recuperar los datos de un chofer 
	        $('#txtChofer_choferes_actividades_registro_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtChoferID_choferes_actividades_registro_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "maquinaria/choferes/autocomplete",
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
	             $('#txtChoferID_choferes_actividades_registro_maquinaria').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del chofer cuando pierda el enfoque la caja de texto
	        $('#txtChofer_choferes_actividades_registro_maquinaria').focusout(function(e){
	            //Si no existe id del chofer
	            if($('#txtChoferID_choferes_actividades_registro_maquinaria').val() == '' ||
	               $('#txtChofer_choferes_actividades_registro_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtChoferID_choferes_actividades_registro_maquinaria').val('');
	               $('#txtChofer_choferes_actividades_registro_maquinaria').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un cliente 
	        $('#txtCliente_choferes_actividades_registro_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_choferes_actividades_registro_maquinaria').val('');
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
	             $('#txtProspectoID_choferes_actividades_registro_maquinaria').val(ui.item.data);
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
	        $('#txtCliente_choferes_actividades_registro_maquinaria').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_choferes_actividades_registro_maquinaria').val() == '' ||
	               $('#txtCliente_choferes_actividades_registro_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_choferes_actividades_registro_maquinaria').val('');
	               $('#txtCliente_choferes_actividades_registro_maquinaria').val('');
	            }

	        });

			//Autocomplete para recuperar los datos de una actividad de choferes
	        $('#txtChoferActividad_choferes_actividades_registro_maquinaria').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtChoferActividadID_choferes_actividades_registro_maquinaria').val('');
	                 $('#txtComision_choferes_actividades_registro_maquinaria').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "maquinaria/choferes_actividades/autocomplete",
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
	               $('#txtChoferActividadID_choferes_actividades_registro_maquinaria').val(ui.item.data);
	               $('#txtComision_choferes_actividades_registro_maquinaria').val(ui.item.comision);
	               //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
				   $('#txtComision_choferes_actividades_registro_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });

	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la actividad de choferes cuando pierda el enfoque la caja de texto
	        $('#txtChoferActividad_choferes_actividades_registro_maquinaria').focusout(function(e){
	            //Si no existe id de la actividad de choferes
	            if($('#txtChoferActividadID_choferes_actividades_registro_maquinaria').val() == '' ||
	               $('#txtChoferActividad_choferes_actividades_registro_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtChoferActividadID_choferes_actividades_registro_maquinaria').val('');
	               $('#txtChoferActividad_choferes_actividades_registro_maquinaria').val('');
	               $('#txtComision_choferes_actividades_registro_maquinaria').val('');
	            }

	        });

			

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_choferes_actividades_registro_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_choferes_actividades_registro_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_choferes_actividades_registro_maquinaria').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_choferes_actividades_registro_maquinaria').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_choferes_actividades_registro_maquinaria').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_choferes_actividades_registro_maquinaria').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un chofer 
	        $('#txtChoferBusq_choferes_actividades_registro_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtChoferIDBusq_choferes_actividades_registro_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "maquinaria/choferes/autocomplete",
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
	             $('#txtChoferIDBusq_choferes_actividades_registro_maquinaria').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del chofer cuando pierda el enfoque la caja de texto
	        $('#txtChoferBusq_choferes_actividades_registro_maquinaria').focusout(function(e){
	            //Si no existe id del chofer
	            if($('#txtChoferIDBusq_choferes_actividades_registro_maquinaria').val() == '' ||
	               $('#txtChoferBusq_choferes_actividades_registro_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtChoferIDBusq_choferes_actividades_registro_maquinaria').val('');
	               $('#txtChoferBusq_choferes_actividades_registro_maquinaria').val('');
	            }

	        });


			//Paginación de registros
			$('#pagLinks_choferes_actividades_registro_maquinaria').on('click','a',function(event){
				event.preventDefault();
				intPaginaChoferesActividadesRegistroMaquinaria = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_choferes_actividades_registro_maquinaria();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_choferes_actividades_registro_maquinaria').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_choferes_actividades_registro_maquinaria();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_choferes_actividades_registro_maquinaria').addClass("estatus-NUEVO");
				//Abrir modal
				 objChoferesActividadesRegistroMaquinaria = $('#ChoferesActividadesRegistroMaquinariaBox').bPopup({
											   appendTo: '#ChoferesActividadesRegistroMaquinariaContent', 
				                               contentContainer: 'ChoferesActividadesRegistroMaquinariaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDepartamento_choferes_actividades_registro_maquinaria').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_choferes_actividades_registro_maquinaria').focus();


			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_choferes_actividades_registro_maquinaria();
		});
	</script>