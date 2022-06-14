	<div id="VerificacionesControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_verificaciones_control_vehiculos" method="post" action="#" 
				  class="form-horizontal" role="form" name="frmBusqueda_verificaciones_control_vehiculos"
				  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_verificaciones_control_vehiculos">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_verificaciones_control_vehiculos'>
				                    <input class="form-control" id="txtFechaInicialBusq_verificaciones_control_vehiculos"
				                    		name= "strFechaInicialBusq_verificaciones_control_vehiculos" 
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
								<label for="txtFechaFinalBusq_verificaciones_control_vehiculos">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_verificaciones_control_vehiculos'>
				                    <input class="form-control" id="txtFechaFinalBusq_verificaciones_control_vehiculos"
				                    		name= "strFechaFinalBusq_verificaciones_control_vehiculos" 
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
								<input id="txtVehiculoIDBusq_verificaciones_control_vehiculos" 
									   name="intVehiculoIDBusq_verificaciones_control_vehiculos"  type="hidden" 
									   value="">
								</input>
								<label for="txtVehiculoBusq_verificaciones_control_vehiculos">Vehículo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtVehiculoBusq_verificaciones_control_vehiculos" 
										name="strVehiculoBusq_verificaciones_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese vehículo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_verificaciones_control_vehiculos">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_verificaciones_control_vehiculos" 
								 		name="strEstatusBusq_verificaciones_control_vehiculos" tabindex="1">
								    <option value="TODOS">TODOS</option>
                      				<option value="ACTIVO">ACTIVO</option>
                      				<option value="INACTIVO">INACTIVO</option>
                 				</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_verificaciones_control_vehiculos" 
									   name="strImprimirDetalles_verificaciones_control_vehiculos" type="checkbox"
									   value="" tabindex="1" />
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
						<div id="ToolBtns" class="btn-group">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_verificaciones_control_vehiculos"
									onclick="paginacion_verificaciones_control_vehiculos();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_verificaciones_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_verificaciones_control_vehiculos"
									onclick="reporte_verificaciones_control_vehiculos();" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_verificaciones_control_vehiculos"
									onclick="descargar_xls_verificaciones_control_vehiculos();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla ordenes de reparación 
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Vehículo"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Fecha verificación"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Semestre"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_verificaciones_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Vehículo</th>
							<th class="movil">Fecha verificación</th>
							<th class="movil">Tipo</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_verificaciones_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{vehiculo}}</td>
							<td class="movil a3">{{fecha_verificacion}}</td>
							<td class="movil a3">{{tipo}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_verificaciones_control_vehiculos({{verificacion_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_verificaciones_control_vehiculos({{verificacion_id}},'Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_verificaciones_control_vehiculos({{verificacion_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_verificaciones_control_vehiculos({{verificacion_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_verificaciones_control_vehiculos({{verificacion_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_verificaciones_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_verificaciones_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="VerificacionesControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_verificaciones_control_vehiculos" class="ModalBodyTitle">
				<h1>Verificación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmVerificacionesControlVehiculos" method="post" action="#" class="form-horizontal" role="form" name="frmVerificacionesControlVehiculos" 
					  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtVerificacionID_verificaciones_control_vehiculos" 
										   name="intVerificacionID_verificaciones_control_vehiculos" 
										   type="hidden" value="" />
									<label for="txtFolio_verificaciones_control_vehiculos">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_verificaciones_control_vehiculos" 
											name="strFolio_verificaciones_control_vehiculos" type="text" value="" 
											placeholder="Autogenerado" disabled />
								</div>
							</div>
						</div>
						<!-- Fecha -->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_verificaciones_control_vehiculos">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_verificaciones_control_vehiculos'>
					                    <input class="form-control" 
					                    		id="txtFecha_verificaciones_control_vehiculos"
					                    		name= "strFecha_verificaciones_control_vehiculos" 
					                    		type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!-- Tipo -->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipo_verificaciones_control_vehiculos">Tipo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTipo_verificaciones_control_vehiculos" 
									 		name="strTipo_verificaciones_control_vehiculos" tabindex="1">
									    <option value="">Seleccione una opción</option>
									    <option value="VEHICULAR">VEHICULAR</option>
		                                <option value="EMISIONES CONTAMINANTES">EMISIONES CONTAMINANTES</option>
		                                <option value="FISICO MECANICA">FÍSICO MECÁNICA</option>
                     				</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene los vehículos activos-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del  vehículo seleccionado-->
									<input id="txtVehiculoID_verificaciones_control_vehiculos" 
										   name="intVehiculoID_verificaciones_control_vehiculos"  
										   type="hidden" value="" />
									<label for="txtVehiculo_verificaciones_control_vehiculos">Vehículo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtVehiculo_verificaciones_control_vehiculos" 
											name="strVehiculo_verificaciones_control_vehiculos" 
											type="text" 
											value="" tabindex="1" 
											placeholder="Ingrese vehículo" 
											maxlength="250" />
								</div>
							</div>
						</div>
						<!--Año-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtAnio_verificaciones_control_vehiculos">Año</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtAnio_verificaciones_control_vehiculos" 
											name="intAnio_verificaciones_control_vehiculos" 
											type="text" 
											value="" 
											disabled />
								</div>
							</div>
						</div>
						<!--Placas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPlacas_verificaciones_control_vehiculos">Placas</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtPlacas_verificaciones_control_vehiculos" 
											name="strPlacas_verificaciones_control_vehiculos" 
											type="text" 
											value="" 
											disabled />
								</div>
							</div>
						</div>
						<!--Folio de verificación-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFolioVerificacion_verificaciones_control_vehiculos">Folio de verificación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtFolioVerificacion_verificaciones_control_vehiculos" 
											name="strFolioVerificacion_verificaciones_control_vehiculos" 
											type="text" value="" 
											placeholder="Ingrese folio" />
								</div>
							</div>
						</div>
               		</div>
					<div class="row">
						<!-- Fecha de verificación -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaVerificacion_verificaciones_control_vehiculos">Fecha de verificación</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaVerificacion_verificaciones_control_vehiculos'>
					                    <input class="form-control" 
					                    		id="txtFechaVerificacion_verificaciones_control_vehiculos"
					                    		name= "strFechaVerificacion_verificaciones_control_vehiculos" 
					                    		type="text"  
					                    		value="" tabindex="1" 
					                    		placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!-- Semestre -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbSemestre_verificaciones_control_vehiculos">Semestre</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbSemestre_verificaciones_control_vehiculos" 
									 		name="strSemestre_verificaciones_control_vehiculos" tabindex="1">
									    <option value="">Seleccione una opción</option>
									    <option value="NO APLICA">NO APLICA</option>
		                                <option value="PRIMERO">PRIMERO</option>
		                                <option value="SEGUNDO">SEGUNDO</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Autorización-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtAutorizacion_verificaciones_control_vehiculos">Autorización</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtAutorizacion_verificaciones_control_vehiculos" 
											name="strAutorizacion_verificaciones_control_vehiculos" 
											type="text" value="" 
											placeholder="" />
								</div>
							</div>
						</div>
						<!--Costo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCosto_verificaciones_control_vehiculos">Costo</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_verificaciones_control_vehiculos" 
												id="txtCosto_verificaciones_control_vehiculos" 
												name="intCosto_verificaciones_control_vehiculos" 
												type="text" value="" tabindex="1" 
												placeholder="Ingrese costo" maxlength="11" />
									</div>
								</div>
							</div>
						</div>
					</div>
               		<div class="row">
						<!--Centro de verificación-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCentroVerificacion_verificaciones_control_vehiculos">Centro de verificación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCentroVerificacion_verificaciones_control_vehiculos" 
											name="strCentroVerificacion_verificaciones_control_vehiculos" 
											type="text" 
											value="" 
											tabindex="1" placeholder="" 
											maxlength="250" />
								</div>
							</div>
						</div>
						<!--Resultado-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtResultado_verificaciones_control_vehiculos">Resultado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtResultado_verificaciones_control_vehiculos" 
											name="strResultado_verificaciones_control_vehiculos" 
											type="text" 
											value="" 
											tabindex="1" 
											placeholder="" 
											maxlength="250" />
								</div>
							</div>
						</div>
               		</div>
               		<div class="row">
						<!--Observaciones-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_verificaciones_control_vehiculos">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_verificaciones_control_vehiculos" 
											name="strObservaciones_verificaciones_control_vehiculos" 
											type="text" value="" tabindex="1" 
											placeholder="Ingrese observaciones" maxlength="250" />
								</div>
							</div>
						</div>
               		</div>	
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_verificaciones_control_vehiculos"  
									onclick="validar_verificaciones_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>		
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_verificaciones_control_vehiculos"  
									onclick="reporte_registro_verificaciones_control_vehiculos('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_verificaciones_control_vehiculos"  
									onclick="cambiar_estatus_verificaciones_control_vehiculos('', 'ACTIVO');"  title="Desactivar" tabindex="6" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_verificaciones_control_vehiculos"  
									onclick="cambiar_estatus_verificaciones_control_vehiculos('', 'INACTIVO');"  title="Restaurar" tabindex="7" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_verificaciones_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_verificaciones_control_vehiculos();" title="Cerrar"  tabindex="8">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#VerificacionesControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros de ordenes de reparación
		var intPaginaVerificacionesControlVehiculos = 0;
		var strUltimaBusquedaVerificacionesControlVehiculos = "";
		//Variables que se utilizan para la paginación de registros de salidas de refacciones internas
		var intPaginaSalidasRefaccionesVerificacionesControlVehiculos = 0;
		var strUltimaBusquedaSalidasRefaccionesVerificacionesControlVehiculos = "";
		//Variables que se utilizan para la paginación de registros de trabajos foráneos internos
		var intPaginaTrabajosForaneosVerificacionesControlVehiculos = 0;
		var strUltimaBusquedaTrabajosForaneosVerificacionesControlVehiculos = "";
		//Variables que se utilizan para la búsqueda de registros
		var intVehiculoIDVerificacionesControlVehiculos = "";
		var dteFechaInicialVerificacionesControlVehiculos = "";
		var dteFechaFinalVerificacionesControlVehiculos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objVerificacionesControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_verificaciones_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/verificaciones/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_verificaciones_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosVerificacionesControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosVerificacionesControlVehiculos = strPermisosVerificacionesControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosVerificacionesControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosVerificacionesControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_verificaciones_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosVerificacionesControlVehiculos[i]=='GUARDAR') || (arrPermisosVerificacionesControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_verificaciones_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosVerificacionesControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_verificaciones_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_verificaciones_control_vehiculos();
						}
						else if(arrPermisosVerificacionesControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_verificaciones_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosVerificacionesControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_verificaciones_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosVerificacionesControlVehiculos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_verificaciones_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosVerificacionesControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_verificaciones_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_verificaciones_control_vehiculos() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaVerificacionesControlVehiculos =($('#txtFechaInicialBusq_verificaciones_control_vehiculos').val()+$('#txtFechaFinalBusq_verificaciones_control_vehiculos').val()+$('#txtVehiculoIDBusq_verificaciones_control_vehiculos').val()+$('#cmbEstatusBusq_verificaciones_control_vehiculos').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaVerificacionesControlVehiculos != strUltimaBusquedaVerificacionesControlVehiculos)
			{
				intPaginaVerificacionesControlVehiculos = 0;
				strUltimaBusquedaVerificacionesControlVehiculos = strNuevaBusquedaVerificacionesControlVehiculos;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/verificaciones/get_paginacion',
				    {//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				     dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_verificaciones_control_vehiculos').val()),
				     dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_verificaciones_control_vehiculos').val()),
				     intVehiculoID: $('#txtVehiculoIDBusq_verificaciones_control_vehiculos').val(),
				     strEstatus: $('#cmbEstatusBusq_verificaciones_control_vehiculos').val(),
					 intPagina:intPaginaVerificacionesControlVehiculos,
					 strPermisosAcceso: $('#txtAcciones_verificaciones_control_vehiculos').val()
					},
					function(data){
						$('#dg_verificaciones_control_vehiculos tbody').empty();
						var tmpVerificacionesControlVehiculos = Mustache.render($('#plantilla_verificaciones_control_vehiculos').html(),data);
						$('#dg_verificaciones_control_vehiculos tbody').html(tmpVerificacionesControlVehiculos);
						$('#pagLinks_verificaciones_control_vehiculos').html(data.paginacion);
						$('#numElementos_verificaciones_control_vehiculos').html(data.total_rows);
						intPaginaVerificacionesControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_verificaciones_control_vehiculos() 
		{
			//Asignar valores para la búsqueda de registros
			intVehiculoIDVerificacionesControlVehiculos =  $('#txtVehiculoIDBusq_verificaciones_control_vehiculos').val();
			dteFechaInicialVerificacionesControlVehiculos =  $.formatFechaMysql($('#txtFechaInicialBusq_verificaciones_control_vehiculos').val());
			dteFechaFinalVerificacionesControlVehiculos =  $.formatFechaMysql($('#txtFechaFinalBusq_verificaciones_control_vehiculos').val());

			//Si no existe fecha inicial
			if(dteFechaInicialVerificacionesControlVehiculos == '')
			{
				dteFechaInicialVerificacionesControlVehiculos = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalVerificacionesControlVehiculos == '')
			{
				dteFechaFinalVerificacionesControlVehiculos =  '0000-00-00';
			}
			
			//Si no existe id del vehículo
			if(intVehiculoIDVerificacionesControlVehiculos == '')
			{
				intVehiculoIDVerificacionesControlVehiculos = 0;
			}

			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_verificaciones_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_verificaciones_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_verificaciones_control_vehiculos').val('NO');
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/verificaciones/get_reporte/"+dteFechaInicialVerificacionesControlVehiculos+"/"+dteFechaFinalVerificacionesControlVehiculos+"/"+intVehiculoIDVerificacionesControlVehiculos+"/"+$('#cmbEstatusBusq_verificaciones_control_vehiculos').val()+"/"+$('#chbImprimirDetalles_verificaciones_control_vehiculos').val());
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_verificaciones_control_vehiculos(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtVerificacionID_verificaciones_control_vehiculos').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/verificaciones/get_reporte_registro/" + intID);
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_verificaciones_control_vehiculos() 
		{
			//Asignar valores para la búsqueda de registros
			intVehiculoIDVerificacionesControlVehiculos =  $('#txtVehiculoIDBusq_verificaciones_control_vehiculos').val();
			dteFechaInicialVerificacionesControlVehiculos =  $.formatFechaMysql($('#txtFechaInicialBusq_verificaciones_control_vehiculos').val());
			dteFechaFinalVerificacionesControlVehiculos =  $.formatFechaMysql($('#txtFechaFinalBusq_verificaciones_control_vehiculos').val());

			//Si no existe fecha inicial
			if(dteFechaInicialVerificacionesControlVehiculos == '')
			{
				dteFechaInicialVerificacionesControlVehiculos = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalVerificacionesControlVehiculos == '')
			{
				dteFechaFinalVerificacionesControlVehiculos =  '0000-00-00';
			}
			
			//Si no existe id del vehículo
			if(intVehiculoIDVerificacionesControlVehiculos == '')
			{
				intVehiculoIDVerificacionesControlVehiculos = 0;
			}

			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_verificaciones_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_verificaciones_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_verificaciones_control_vehiculos').val('NO');
			}
			
         	//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
			window.open("control_vehiculos/verificaciones/get_xls/"+dteFechaInicialVerificacionesControlVehiculos+"/"+dteFechaFinalVerificacionesControlVehiculos+"/"+intVehiculoIDVerificacionesControlVehiculos+"/"+$('#cmbEstatusBusq_verificaciones_control_vehiculos').val()+"/"+$('#chbImprimirDetalles_verificaciones_control_vehiculos').val());
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_verificaciones_control_vehiculos()
		{
			//Incializar formulario
			$('#frmVerificacionesControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_verificaciones_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmVerificacionesControlVehiculos').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_verificaciones_control_vehiculos').val(fechaActual()); 
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_verificaciones_control_vehiculos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_verificaciones_control_vehiculos').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_verificaciones_control_vehiculos').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmVerificacionesControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_verificaciones_control_vehiculos').attr("disabled", "disabled");
			$('#txtAnio_verificaciones_control_vehiculos').attr("disabled", "disabled");
			$('#txtPlacas_verificaciones_control_vehiculos').attr("disabled", "disabled");
			//Mostrar los siguiente botones
			$("#btnGuardar_verificaciones_control_vehiculos").show();
			$("#btnImprimirRegistro_verificaciones_control_vehiculos").hide();
			$("#btnDesactivar_verificaciones_control_vehiculos").hide();
			$("#btnRestaurar_verificaciones_control_vehiculos").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_verificaciones_control_vehiculos()
		{
			try {

				//Cerrar modal
				objVerificacionesControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_verificaciones_control_vehiculos').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_verificaciones_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_verificaciones_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmVerificacionesControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_verificaciones_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strTipo_verificaciones_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo de verificación'}
											}
										},
										strVehiculo_verificaciones_control_vehiculos: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vehículo
					                                    if($('#txtVehiculoID_verificaciones_control_vehiculos').val() === '')
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
										intAnio_verificaciones_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strPlacas_verificaciones_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione un vehículo existente'}
											}
										},
										strFolioVerificacion_verificaciones_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba un folio de verificación'}
											}
										},
										strFechaVerificacion_verificaciones_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strSemestre_verificaciones_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione una opción'}
											}
										},
										strAutorizacion_verificaciones_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba una autorización'}
											}
										},
										intCosto_verificaciones_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										},
					                    strCentroVerificacion_verificaciones_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba un Centro de Verificación'}
											}
										},
										strResultado_verificaciones_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba un resultado'}
											}
										},
										strObservaciones_verificaciones_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba observaciones para la verificación'}
											}
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_verificaciones_control_vehiculos = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_verificaciones_control_vehiculos = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_verificaciones_control_vehiculos.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_verificaciones_control_vehiculos.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_verificaciones_control_vehiculos = $('#frmVerificacionesControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_verificaciones_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_verificaciones_control_vehiculos.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_verificaciones_control_vehiculos();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_verificaciones_control_vehiculos()
		{
			try
			{
				$('#frmVerificacionesControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_verificaciones_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/verificaciones/guardar',
			{ 
				//Datos de la verificación
				intVerificacionID: $('#txtVerificacionID_verificaciones_control_vehiculos').val(),
			    //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				dteFecha: $.formatFechaMysql($('#txtFecha_verificaciones_control_vehiculos').val()),
				strTipo: $('#cmbTipo_verificaciones_control_vehiculos').val(),
				intVehiculoID: $('#txtVehiculoID_verificaciones_control_vehiculos').val(),
				strAnio: $('#txtAnio_verificaciones_control_vehiculos').val(),
				strPlacas: $('#txtPlacas_verificaciones_control_vehiculos').val(),
				strFolioVerificacion: $('#txtFolioVerificacion_verificaciones_control_vehiculos').val(),
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				dteFechaVerificacion: $.formatFechaMysql($('#txtFechaVerificacion_verificaciones_control_vehiculos').val()),
				strSemestre: $('#cmbSemestre_verificaciones_control_vehiculos').val(),
				strCentroVerificacion: $('#txtCentroVerificacion_verificaciones_control_vehiculos').val(),
				strResultado: $('#txtResultado_verificaciones_control_vehiculos').val(),
				strAutorizacion: $('#txtAutorizacion_verificaciones_control_vehiculos').val(),
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intCosto:  $.reemplazar($('#txtCosto_verificaciones_control_vehiculos').val(), ",", ""),
				strObservaciones: $('#txtObservaciones_verificaciones_control_vehiculos').val(),
				intProcesoMenuID: $('#txtProcesoMenuID_verificaciones_control_vehiculos').val()
			},
			function(data) {
				if (data.resultado)
				{
					//Hacer llamado a la función  para cargar los registros en el grid
					paginacion_verificaciones_control_vehiculos();            
					//Hacer un llamado a la función para cerrar modal
					cerrar_verificaciones_control_vehiculos();
				}
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_verificaciones_control_vehiculos(data.tipo_mensaje, data.mensaje);
			},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_verificaciones_control_vehiculos(tipoMensaje, mensaje)
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
		function cambiar_estatus_verificaciones_control_vehiculos(id, estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para cambiar el título del mensaje
			var strTituloMensaje = '';
			//Variable que se utiliza para cambiar el mensaje
			var strMensaje = '';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtVerificacionID_verificaciones_control_vehiculos').val();

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
				              'title':    'Verificaciones',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('control_vehiculos/verificaciones/set_estatus',
				                                     {
				                                     	intVerificacionID: intID,
				                                      	strEstatus: estatus
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                          	//Hacer llamado a la función  para cargar  los registros en el grid
				                                         	paginacion_verificaciones_control_vehiculos();
				                                          	
				                                          	//Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_verificaciones_control_vehiculos();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_verificaciones_control_vehiculos(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('control_vehiculos/verificaciones/set_estatus',
				     {
				     	intVerificacionID: intID,
				        strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_verificaciones_control_vehiculos();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_verificaciones_control_vehiculos();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_verificaciones_control_vehiculos(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		   
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_verificaciones_control_vehiculos(id, tipoAccion)
		{	
		   //Hacer un llamado al método del controlador para regresar los datos del registro
		   $.post('control_vehiculos/verificaciones/get_datos',
	       {
	       		strBusqueda: id,
	       		strTipo: 'id'
	       },
	       function(data) {
	        	//Si hay datos del registro
	            if(data.row)
	            {

	            	//Hacer un llamado a la función para limpiar los campos del formulario
					nuevo_verificaciones_control_vehiculos();
					//Asignar estatus del registro
				    var strEstatus = data.row.estatus;

		          	//Recuperar valores
		            $('#txtVerificacionID_verificaciones_control_vehiculos').val(data.row.verificacion_id);
		            $('#txtFolio_verificaciones_control_vehiculos').val(data.row.folio);
				    $('#txtFecha_verificaciones_control_vehiculos').val(data.row.fecha);
				    $('#cmbTipo_verificaciones_control_vehiculos').val(data.row.tipo);
				    $('#txtVehiculoID_verificaciones_control_vehiculos').val(data.row.vehiculo_id);
				    $('#txtVehiculo_verificaciones_control_vehiculos').val(data.row.vehiculo);
				    $('#txtAnio_verificaciones_control_vehiculos').val(data.row.anio);
				    $('#txtPlacas_verificaciones_control_vehiculos').val(data.row.placas);
				    $('#txtFolioVerificacion_verificaciones_control_vehiculos').val(data.row.folio_verificacion);
				    $('#txtFechaVerificacion_verificaciones_control_vehiculos').val(data.row.fecha_verificacion);
				    $('#cmbSemestre_verificaciones_control_vehiculos').val(data.row.semestre);
				    $('#txtAutorizacion_verificaciones_control_vehiculos').val(data.row.autorizacion);
				    $('#txtCosto_verificaciones_control_vehiculos').val(data.row.costo);
				    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
			        $('#txtCosto_verificaciones_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
				    $('#txtCentroVerificacion_verificaciones_control_vehiculos').val(data.row.centro_verificacion);
				    $('#txtResultado_verificaciones_control_vehiculos').val(data.row.resultado);
				    $('#txtObservaciones_verificaciones_control_vehiculos').val(data.row.observaciones);
					//Dependiendo del estatus cambiar el color del encabezado 
		            $('#divEncabezadoModal_verificaciones_control_vehiculos').addClass("estatus-"+strEstatus);
					//Mostrar botón Imprimir  
		            $("#btnImprimirRegistro_verificaciones_control_vehiculos").show();

		            //Si el estatus del registro es ACTIVO
		            if(strEstatus == 'ACTIVO')
					{
						//Mostrar los siguientes botones
		            	$("#btnDesactivar_verificaciones_control_vehiculos").show();
					}
					else 
					{	
						//Si el tipo de acción corresponde a Ver
						if(tipoAccion == 'Ver')
						{
							//Deshabilitar todos los elementos del formulario
		            		$('#frmVerificacionesControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
		            		//Mostrar los siguientes botones
		            		$("#btnRestaurar_verificaciones_control_vehiculos").show();
		            		//Ocultar los siguientes botones
			           		$("#btnGuardar_verificaciones_control_vehiculos").hide(); 
						}
					}
	            	
	            	//Abrir modal
		            objVerificacionesControlVehiculos = $('#VerificacionesControlVehiculosBox').bPopup({
												  appendTo: '#VerificacionesControlVehiculosContent', 
					                              contentContainer: 'VerificacionesControlVehiculosM', 
					                              zIndex: 2, 
					                              modalClose: false, 
					                              modal: true, 
					                              follow: [true,false], 
					                              followEasing : "linear", 
					                              easing: "linear", 
					                              modalColor: ('#F0F0F0')});

		            //Enfocar caja de texto
					$('#txtVehiculo_verificaciones_control_vehiculos').focus();
			        
	       	    }
	       },
	       'json');
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{	
        	//Validar campos decimales (no hay necesidad de poner '.')
        	//Agregar datepicker para seleccionar fecha
			$('#dteFecha_verificaciones_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaVerificacion_verificaciones_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.moneda_verificaciones_control_vehiculos').blur(function(){
                $('.moneda_verificaciones_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
            });

        	
			//Autocomplete para recuperar los datos de un vehículo 
	        $('#txtVehiculo_verificaciones_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoID_verificaciones_control_vehiculos').val('');
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
				$('#txtVehiculoID_verificaciones_control_vehiculos').val(ui.item.data);
				
				//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             	$.post('control_vehiculos/vehiculos/get_datos',
                  { 
                  	strBusqueda:$("#txtVehiculoID_verificaciones_control_vehiculos").val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtVehiculo_verificaciones_control_vehiculos").val(data.row.codigo + ' - ' + data.row.modelo + ' ' + data.row.marca);
                       $("#txtAnio_verificaciones_control_vehiculos").val(data.row.anio);
                       $("#txtPlacas_verificaciones_control_vehiculos").val(data.row.placas);
                       //Enfocar caja de texto
				       $('#txtVehiculo_verificaciones_control_vehiculos').focus();
                    }
                  }
                 ,
                'json');

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
	        $('#txtVehiculo_verificaciones_control_vehiculos').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoID_verificaciones_control_vehiculos').val() == '' ||
	               $('#txtVehiculo_verificaciones_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVehiculoID_verificaciones_control_vehiculos').val('');
	               $('#txtVehiculo_verificaciones_control_vehiculos').val('');
	            }

	        });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_verificaciones_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_verificaciones_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY',
			 																		              useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_verificaciones_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_verificaciones_control_vehiculos').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_verificaciones_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_verificaciones_control_vehiculos').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un vehículo 
	        $('#txtVehiculoBusq_verificaciones_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoIDBusq_verificaciones_control_vehiculos').val('');
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
	             $('#txtVehiculoIDBusq_verificaciones_control_vehiculos').val(ui.item.data);
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
	        $('#txtVehiculoBusq_verificaciones_control_vehiculos').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoIDBusq_verificaciones_control_vehiculos').val() == '' ||
	               $('#txtVehiculoBusq_verificaciones_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVehiculoIDBusq_verificaciones_control_vehiculos').val('');
	               $('#txtVehiculoBusq_verificaciones_control_vehiculos').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_verificaciones_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaVerificacionesControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_verificaciones_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_verificaciones_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_verificaciones_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_verificaciones_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				 objVerificacionesControlVehiculos = $('#VerificacionesControlVehiculosBox').bPopup({
											   appendTo: '#VerificacionesControlVehiculosContent', 
				                               contentContainer: 'VerificacionesControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtVehiculo_verificaciones_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_verificaciones_control_vehiculos').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_verificaciones_control_vehiculos();
		});
	</script>