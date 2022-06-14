	<div id="VehiculosControlVehiculosContent">  
		<!--Barra de vehiculos-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_vehiculos_control_vehiculos" action="#" method="post" 
				  tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_vehiculos_control_vehiculos" 
								   name="strBusqueda_vehiculos_control_vehiculos"  type="text" value="" tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_vehiculos_control_vehiculos"
										onclick="paginacion_vehiculos_control_vehiculos();" 
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
							<button class="btn btn-info" id="btnNuevo_vehiculos_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_vehiculos_control_vehiculos"
									onclick="reporte_vehiculos_control_vehiculos();" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_vehiculos_control_vehiculos"
									onclick="descargar_xls_vehiculos_control_vehiculos();" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button> 
						</div>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre de barra de vehiculos-->
		<!--Estilo que se utiliza para mostrar los nombres de las columnas de la tabla en el dispositivo móvil -->
		<style>
			@media (max-width: 480px) 
			{
			    /*
				Definir columnas
				*/
				td.movil:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Modelo"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_vehiculos_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Modelo</th>
							<th class="movil">Marca</th>
							<th class="movil">Placas</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_vehiculos_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil">{{codigo}}</td>
							<td class="movil">{{modelo}}</td>
							<td class="movil">{{marca}}</td>
							<td class="movil">{{placas}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_vehiculos_control_vehiculos({{vehiculo_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_vehiculos_control_vehiculos({{vehiculo_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_vehiculos_control_vehiculos({{vehiculo_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_vehiculos_control_vehiculos({{vehiculo_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_vehiculos_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_vehiculos_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="VehiculosControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_vehiculos_control_vehiculos"  class="ModalBodyTitle">
			<h1>Vehículos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmVehiculosControlVehiculos" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmVehiculosControlVehiculos"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
					    <!--Código-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtVehiculoID_vehiculos_control_vehiculos" 
										   name="intVehiculoID_vehiculos_control_vehiculos"  
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el código anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código-->
									<input id="txtCodigoAnterior_vehiculos_control_vehiculos" 
										   name="strCodigoAnterior_vehiculos_control_vehiculos" 
										   type="hidden" value="" />
									<label for="txtCodigo_vehiculos_control_vehiculos">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_vehiculos_control_vehiculos" 
											name="strCodigo_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese código" maxlength="5" />
								</div>
							</div>
						</div>
						<!--Modelo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtModelo_vehiculos_control_vehiculos">Modelo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtModelo_vehiculos_control_vehiculos" 
											name="strModelo_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese modelo" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Marca-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMarca_vehiculos_control_vehiculos">Marca</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMarca_vehiculos_control_vehiculos" 
											name="strMarca_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese marca" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Año-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtAnio_vehiculos_control_vehiculos">Año</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtAnio_vehiculos_control_vehiculos" 
											name="strAnio_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese año" maxlength="4" />
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Placas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPlacas_vehiculos_control_vehiculos">Placas</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPlacas_vehiculos_control_vehiculos" 
											name="strPlacas_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese placas" maxlength="10" />
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los estados activos-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del estado seleccionado-->
									<input id="txtEstadoID_vehiculos_control_vehiculos" 
										   name="intEstadoID_vehiculos_control_vehiculos"  
										   type="hidden" 
										   value="" />
									<label for="txtEstado_vehiculos_control_vehiculos">Estado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEstado_vehiculos_control_vehiculos" 
											name="strEstado_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese estado" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Placas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSerie_vehiculos_control_vehiculos">Serie</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSerie_vehiculos_control_vehiculos" 
											name="strSerie_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese serie" maxlength="30" />
								</div>
							</div>
						</div>
						<!--Costo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCosto_vehiculos_control_vehiculos">Costo</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_vehiculos_control_vehiculos" 
												id="txtCosto_vehiculos_control_vehiculos" 
												name="strCosto_vehiculos_control_vehiculos" 
												type="text" 
												value="" 
												tabindex="1" 
												placeholder="Ingrese costo" 
												maxlength="23" />
									</div>		
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Aseguradora-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtAseguradora_vehiculos_control_vehiculos">Aseguradora</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtAseguradora_vehiculos_control_vehiculos" 
											name="strAseguradora_vehiculos_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese aseguradora" maxlength="50" />
								</div>
							</div>
						</div>
						<!--Póliza-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPoliza_vehiculos_control_vehiculos">Póliza</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPoliza_vehiculos_control_vehiculos" 
											name="strPoliza_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese póliza" maxlength="20" />
								</div>
							</div>
						</div>
						<!--Costo de la Póliza-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCostoPoliza_vehiculos_control_vehiculos">Costo de póliza</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_vehiculos_control_vehiculos" 
											id="txtCostoPoliza_vehiculos_control_vehiculos" 
											name="strCostoPoliza_vehiculos_control_vehiculos" 
											type="text" 
											value="" 
											tabindex="1" 
											placeholder="Ingrese costo póliza" 
											maxlength="23" />
									</div>	
								</div>
							</div>
						</div>
						<!--Fecha de renovación-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaRenovacion_vehiculos_control_vehiculos">Renovación</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaRenovacion_vehiculos_control_vehiculos'>
					                    <input class="form-control" id="txtFechaRenovacion_vehiculos_control_vehiculos"
					                    		name= "strFechaRenovacion_vehiculos_control_vehiculos" type="text" 
					                    		value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Autocomplete que contiene los empleados activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
									<input id="txtResponsableID_vehiculos_control_vehiculos" 
										   name="intResponsableID_vehiculos_control_vehiculos"  
										   type="hidden" 
										   value="" />
									<label for="txtResponsable_vehiculos_control_vehiculos">Responsable</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtResponsable_vehiculos_control_vehiculos" 
											name="strResponsable_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese responsable" maxlength="250" />
								</div>
							</div>
						</div>
					</div>
				    <div class="row">
						<!--Autocomplete que contiene los departamentos activos-->
						<div  class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del departamento seleccionado-->
									<input id="txtDepartamentoID_vehiculos_control_vehiculos" 
										   name="intDepartamentoID_vehiculos_control_vehiculos"  
										   type="hidden" 
										   value="" />
									<label for="txtDepartamento_vehiculos_control_vehiculos">Departamento</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDepartamento_vehiculos_control_vehiculos" 
											name="strDepartamento_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese departamento" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Corporativo (tipo de empleado que no pertenece a una sucursal)--> 
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12 btn-toolBtns">
							<div class="checkbox">
		                    	<label id="label-checkbox">
		                        	<input class="form-control" id="chbCorporativo_vehiculos_control_vehiculos" 
										   name="strCorporativo_vehiculos_control_vehiculos" type="checkbox"
										   value="" tabindex="1">
									</input>
									<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
									Corporativo
		                    	</label>
		                  	</div>
						</div>
						<!--Combobox que contiene los módulos activos-->
						<div  class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbModuloID_vehiculos_control_vehiculos">Módulo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbModuloID_vehiculos_control_vehiculos" 
									 		name="intModuloID_vehiculos_control_vehiculos" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las sucursales activas-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal seleccionada-->
									<input id="txtSucursalID_vehiculos_control_vehiculos" 
										   name="intSucursalID_vehiculos_control_vehiculos"  
										   type="hidden" 
										   value="" />
									<label for="txtSucursal_vehiculos_control_vehiculos">Sucursal</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSucursal_vehiculos_control_vehiculos" 
											name="strSucursal_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese sucursal" maxlength="250" />
								</div>
							</div>
						</div>
				    </div>
				    <div class="row"> 	
						<!--Licencia-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtLicencia_vehiculos_control_vehiculos">Licencia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtLicencia_vehiculos_control_vehiculos" 
											name="strLicencia_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" disabled />
								</div>
							</div>
						</div>
						<!--Tipo de Licencia-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoLicencia_vehiculos_control_vehiculos">Tipo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTipoLicencia_vehiculos_control_vehiculos" 
											name="strTipoLicencia_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" disabled />
								</div>
							</div>
						</div>
						<!--Vigencia de Licencia-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtVigenciaLicencia_vehiculos_control_vehiculos">Vigencia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtVigenciaLicencia_vehiculos_control_vehiculos" 
											name="strVigenciaLicencia_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" disabled />
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Kilometraje-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtKilometraje_vehiculos_control_vehiculos">Kilometraje</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control moneda_vehiculos_control_vehiculos" 
									id="txtKilometraje_vehiculos_control_vehiculos" 
											name="strKilometraje_vehiculos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese kilometraje" maxlength="23" />
								</div>
							</div>
						</div>
						<!--Verificación fiscal--> 
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-6">
							<div class="form-group">
								<div class="col-md-12">
									<label for="chbVerificacionFederal_vehiculos_control_vehiculos"></label>
								</div>
								<div class="col-md-12">
									<div class="checkbox">
				                    	<label id="label-checkbox">
				                        	<input class="form-control" id="chbVerificacionFederal_vehiculos_control_vehiculos" 
												   name="strVerificacionFederal_vehiculos_control_vehiculos" type="checkbox"
												   value="" tabindex="1" />
											<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											Verificación federal
				                    	</label>
				                  	</div>
								</div>
							</div>
						</div>
					</div>	
					<div class="row">
						<!--Observaciones-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_vehiculos_control_vehiculos">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_vehiculos_control_vehiculos" 
											name="strObservaciones_vehiculos_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250" />
								</div>
							</div>
						</div>
					</div>	
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_vehiculos_control_vehiculos"  
									onclick="validar_vehiculos_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_vehiculos_control_vehiculos"  
									onclick="cambiar_estatus_vehiculos_control_vehiculos('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_vehiculos_control_vehiculos"  
									onclick="cambiar_estatus_vehiculos_control_vehiculos('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_vehiculos_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_vehiculos_control_vehiculos();" title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#VehiculosControlVehiculosContent -->


	<!-- /.Plantilla para cargar los módulos en el combobox-->  
	<script id="modulos_vehiculos_control_vehiculos" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#modulos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/modulos}} 
	</script>
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaVehiculosControlVehiculos = 0;
		var strUltimaBusquedaVehiculosControlVehiculos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objVehiculosControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_vehiculos_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/vehiculos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_vehiculos_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosVehiculosControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosVehiculosControlVehiculos = strPermisosVehiculosControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosVehiculosControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosVehiculosControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_vehiculos_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosVehiculosControlVehiculos[i]=='GUARDAR') || (arrPermisosVehiculosControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_vehiculos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosVehiculosControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_vehiculos_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_vehiculos_control_vehiculos();
						}
						else if(arrPermisosVehiculosControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_vehiculos_control_vehiculos').removeAttr('disabled');
							$('#btnRestaurar_vehiculos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosVehiculosControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_vehiculos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosVehiculosControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_vehiculos_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_vehiculos_control_vehiculos() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_vehiculos_control_vehiculos').val() != strUltimaBusquedaVehiculosControlVehiculos)
			{
				intPaginaVehiculosControlVehiculos = 0;
				strUltimaBusquedaVehiculosControlVehiculos = $('#txtBusqueda_vehiculos_control_vehiculos').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/vehiculos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_vehiculos_control_vehiculos').val(),
						intPagina:intPaginaVehiculosControlVehiculos,
						strPermisosAcceso: $('#txtAcciones_vehiculos_control_vehiculos').val()
					},
					function(data){
						$('#dg_vehiculos_control_vehiculos tbody').empty();
						var tmpVehiculosControlVehiculos = Mustache.render($('#plantilla_vehiculos_control_vehiculos').html(),data);
						$('#dg_vehiculos_control_vehiculos tbody').html(tmpVehiculosControlVehiculos);
						$('#pagLinks_vehiculos_control_vehiculos').html(data.paginacion);
						$('#numElementos_vehiculos_control_vehiculos').html(data.total_rows);
						intPaginaVehiculosControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_vehiculos_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/vehiculos/get_reporte/"+$('#txtBusqueda_vehiculos_control_vehiculos').val());
		}
		
		//Función para descargar el reporte general en XLS
		function descargar_xls_vehiculos_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("control_vehiculos/vehiculos/get_xls/"+$('#txtBusqueda_vehiculos_control_vehiculos').val());
		}

		
		//Regresar módulos activos para cargarlos en el combobox
		function cargar_modulos_vehiculos_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los módulos que se encuentran activos 
			$.post('crm/modulos/get_combo_box', {},
				function(data)
				{
					$('#cmbModuloID_vehiculos_control_vehiculos').empty();
					var temp = Mustache.render($('#modulos_vehiculos_control_vehiculos').html(), data);
					$('#cmbModuloID_vehiculos_control_vehiculos').html(temp);
				},
				'json');
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_vehiculos_control_vehiculos()
		{
			//Incializar formulario
			$('#frmVehiculosControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_vehiculos_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmVehiculosControlVehiculos').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_vehiculos_control_vehiculos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_vehiculos_control_vehiculos').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_vehiculos_control_vehiculos').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmVehiculosControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_vehiculos_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_vehiculos_control_vehiculos").hide();
			$("#btnRestaurar_vehiculos_control_vehiculos").hide();
			//Deshabilitar los siguientes componentes
			$('#txtLicencia_vehiculos_control_vehiculos').attr('disabled','-1');
			$('#txtTipoLicencia_vehiculos_control_vehiculos').attr('disabled','-1');
			$('#txtVigenciaLicencia_vehiculos_control_vehiculos').attr('disabled','-1'); 
		}

		//Función para inicializar elementos del empleado (responsable)
		function inicializar_empleado_vehiculos_control_vehiculos()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtDepartamentoID_vehiculos_control_vehiculos').val('');
            $('#txtDepartamento_vehiculos_control_vehiculos').val('');
            $('#txtSucursalID_vehiculos_control_vehiculos').val('');
            $('#txtSucursal_vehiculos_control_vehiculos').val('');
            $('#txtLicencia_vehiculos_control_vehiculos').val('');
            $('#txtTipoLicencia_vehiculos_control_vehiculos').val('');
            $('#txtVigenciaLicencia_vehiculos_control_vehiculos').val('');
        	//Habilitar los siguientes elementos del formulario
			$("#txtSucursal_vehiculos_control_vehiculos").removeAttr('disabled');
			$("#cmbModuloID_vehiculos_control_vehiculos").removeAttr('disabled');
            //Desmarcar (Deseleccionar) checkbox para indicar que el empleado pertenece a una sucursal
        	$('#chbCorporativo_vehiculos_control_vehiculos').prop("checked", false);
		}
					
		//Función que se utiliza para cerrar el modal
		function cerrar_vehiculos_control_vehiculos()
		{
			try {
				//Cerrar modal
				objVehiculosControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_vehiculos_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_vehiculos_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_vehiculos_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmVehiculosControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo_vehiculos_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba el código para este vehículo'}
											}
										},
										strModelo_vehiculos_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba un modelo'}
											}
										},
										strMarca_vehiculos_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba una marca'}
											}
										},
										strAnio_vehiculos_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba un año'},
												stringLength: {
													min: 4,
													message: 'El año debe tener 4 caracteres de longitud'
												}
											}
										},
										strPlacas_vehiculos_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba las placas'}
											}
										},
										strEstado_vehiculos_control_vehiculos: {
											validators: {
												callback: {
				                                    callback: function(value, validator, $field) {
				                                    	//Verificar que exista id del estado
				                                    	if($('#txtEstadoID_vehiculos_control_vehiculos').val() === '')
				                                    	{
			                                      			return {
				                                            	valid: false,
				                                                message: 'Escriba un estado existente'
				                                            };
				                                    	}
				                                    	return true;
				                                    }
					                            }
											}
										},
										strResponsable_vehiculos_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtResponsableID_vehiculos_control_vehiculos').val() === '')
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
										intModuloID_vehiculos_control_vehiculos: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                	//Verificar que exista id del módulo cuando el empleado no sea corporativo
					                                    if(!$('#chbCorporativo_vehiculos_control_vehiculos').is(':checked') && $('#cmbModuloID_vehiculos_control_vehiculos').val() === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccione un módulo'
					                                        };
					                                    }
														return true;
					                                }
					                            }
											}
										},
										strDepartamento_vehiculos_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del departamento
					                                    if($('#txtDepartamentoID_vehiculos_control_vehiculos').val() === '')
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
										strSucursal_vehiculos_control_vehiculos: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la sucursal cuando el empleado no sea corporativo
					                                    if(!$('#chbCorporativo_vehiculos_control_vehiculos').is(':checked') && $('#txtSucursalID_vehiculos_control_vehiculos').val() === '')
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
										strAseguradora_vehiculos_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba una aseguradora'}
											}
										},
										strPoliza_vehiculos_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba una póliza'}
											}
										},
										strKilometraje_vehiculos_control_vehiculos: {
										       validators: {
												notEmpty: {message: 'Escriba el kilometraje del vehículo'}
											}    
										}

									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_vehiculos_control_vehiculos = $('#frmVehiculosControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_vehiculos_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_vehiculos_control_vehiculos.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_vehiculos_control_vehiculos();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_vehiculos_control_vehiculos()
		{
			try
			{
				$('#frmVehiculosControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_vehiculos_control_vehiculos()
		{		

			//Si el checkbox verificación federal se encuentra seleccionado
			if ($('#chbVerificacionFederal_vehiculos_control_vehiculos').is(':checked')) {
			    //Asignar SI 
			    $('#chbVerificacionFederal_vehiculos_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO
			   $('#chbVerificacionFederal_vehiculos_control_vehiculos').val('NO');
			}
			
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/vehiculos/guardar',
			{ 
				intVehiculoID: $('#txtVehiculoID_vehiculos_control_vehiculos').val(),
				strCodigo: $('#txtCodigo_vehiculos_control_vehiculos').val(),
				strCodigoAnterior: $('#txtCodigoAnterior_vehiculos_control_vehiculos').val(),
				strModelo: $('#txtModelo_vehiculos_control_vehiculos').val(),
				strMarca: $('#txtMarca_vehiculos_control_vehiculos').val(),
				strAnio: $('#txtAnio_vehiculos_control_vehiculos').val(),
				strSerie: $('#txtSerie_vehiculos_control_vehiculos').val(),
				strPlacas: $('#txtPlacas_vehiculos_control_vehiculos').val(),
				intEstadoID: $('#txtEstadoID_vehiculos_control_vehiculos').val(),
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intCosto: $.reemplazar($('#txtCosto_vehiculos_control_vehiculos').val(), ",", ""),
				intKilometraje: $.reemplazar($('#txtKilometraje_vehiculos_control_vehiculos').val(), ",", ""),
				intResponsableID: $('#txtResponsableID_vehiculos_control_vehiculos').val(),
				intModuloID: $('#cmbModuloID_vehiculos_control_vehiculos').val(),
				intDepartamentoID: $('#txtDepartamentoID_vehiculos_control_vehiculos').val(),
				intSucursalID: $('#txtSucursalID_vehiculos_control_vehiculos').val(),
				strAseguradora: $('#txtAseguradora_vehiculos_control_vehiculos').val(),
				strPoliza: $('#txtPoliza_vehiculos_control_vehiculos').val(),
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				dteFechaRenovacion: $.formatFechaMysql($('#txtFechaRenovacion_vehiculos_control_vehiculos').val()),
				intCostoPoliza: $.reemplazar($('#txtCostoPoliza_vehiculos_control_vehiculos').val(), ",", ""),
				strVerificacionFederal: $('#chbVerificacionFederal_vehiculos_control_vehiculos').val(),
				strObservaciones: $('#txtObservaciones_vehiculos_control_vehiculos').val()
				
			},
			function(data) {
				if (data.resultado)
				{
					//Hacer llamado a la función  para cargar los registros en el grid
					paginacion_vehiculos_control_vehiculos();
					//Hacer un llamado a la función para cerrar modal
					cerrar_vehiculos_control_vehiculos();                  
				}
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_vehiculos_control_vehiculos(data.tipo_mensaje, data.mensaje);
			},
			'json');
			
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_vehiculos_control_vehiculos(tipoMensaje, mensaje)
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
		function cambiar_estatus_vehiculos_control_vehiculos(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtVehiculoID_vehiculos_control_vehiculos').val();

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
				              'title':    'Vehículos',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('control_vehiculos/vehiculos/set_estatus',
				                                     {intVehiculoID: intID,
				                                      strEstatus: estatus
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                          	//Hacer llamado a la función  para cargar  los registros en el grid
				                                         	paginacion_vehiculos_control_vehiculos();
				                                          	
				                                          	//Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_vehiculos_control_vehiculos();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_vehiculos_control_vehiculos(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('control_vehiculos/vehiculos/set_estatus',
				     {intVehiculoID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_vehiculos_control_vehiculos();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_vehiculos_control_vehiculos();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_vehiculos_control_vehiculos(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_vehiculos_control_vehiculos(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/vehiculos/get_datos',
	       {
	       		strBusqueda: busqueda,
	       		strTipo: tipoBusqueda
	       },
	       function(data) {
	        	//Si hay datos del registro
	            if(data.row)
	            {
	            	//Hacer un llamado a la función para limpiar los campos del formulario
					nuevo_vehiculos_control_vehiculos();
					//Asignar estatus del registro
				    var strEstatus = data.row.estatus;

		          	//Recuperar valores
		            $('#txtVehiculoID_vehiculos_control_vehiculos').val(data.row.vehiculo_id);
		            $('#txtCodigo_vehiculos_control_vehiculos').val(data.row.codigo);
		            $('#txtCodigoAnterior_vehiculos_control_vehiculos').val(data.row.codigo);
		            $('#txtModelo_vehiculos_control_vehiculos').val(data.row.modelo);
		            $('#txtMarca_vehiculos_control_vehiculos').val(data.row.marca);
		            $('#txtAnio_vehiculos_control_vehiculos').val(data.row.anio);
		            $('#txtSerie_vehiculos_control_vehiculos').val(data.row.serie);
		            $('#txtPlacas_vehiculos_control_vehiculos').val(data.row.placas);
		            $('#txtEstadoID_vehiculos_control_vehiculos').val(data.row.estado_id);
		            $('#txtEstado_vehiculos_control_vehiculos').val(data.row.estado);
		            $('#txtCosto_vehiculos_control_vehiculos').val(data.row.costo);
		            $('#txtKilometraje_vehiculos_control_vehiculos').val( data.row.kilometraje );
		            $('#txtResponsableID_vehiculos_control_vehiculos').val(data.row.responsable_id);
		            $('#txtResponsable_vehiculos_control_vehiculos').val(data.row.responsable);
		            $('#txtLicencia_vehiculos_control_vehiculos').val(data.row.licencia_manejo);
		            $('#txtTipoLicencia_vehiculos_control_vehiculos').val(data.row.licencia_tipo);
		            $('#txtVigenciaLicencia_vehiculos_control_vehiculos').val(data.row.licencia_vigencia);
		            $('#txtDepartamentoID_vehiculos_control_vehiculos').val(data.row.departamento_id);
		            $('#txtDepartamento_vehiculos_control_vehiculos').val(data.row.departamento);

		            //Si existe id de la sucursal
				    if(data.row.sucursal_id > 0)
				    {
				    	$('#txtSucursalID_vehiculos_control_vehiculos').val(data.row.sucursal_id);
				    	$('#txtSucursal_vehiculos_control_vehiculos').val(data.row.sucursal);
				    	$('#cmbModuloID_vehiculos_control_vehiculos').val(data.row.modulo_id);
				    }
				    else
				    {
				    	//Marcar (Seleccionar) checkbox para indicar que el empleado no pertenece a una sucursal
   					    $('#chbCorporativo_vehiculos_control_vehiculos').prop("checked", true);
				    	//Deshabilitar los siguientes elementos del formulario
						$("#txtSucursal_vehiculos_control_vehiculos").attr('disabled','disabled');
						$("#cmbModuloID_vehiculos_control_vehiculos").attr('disabled','disabled');
				    }
		            $('#txtAseguradora_vehiculos_control_vehiculos').val(data.row.aseguradora);
		            $('#txtPoliza_vehiculos_control_vehiculos').val(data.row.poliza);
		            $('#txtFechaRenovacion_vehiculos_control_vehiculos').val(data.row.fecha_renovacion);
		            $('#txtCostoPoliza_vehiculos_control_vehiculos').val(data.row.costo_poliza);
		            //Si el vehículo tiene verificación federal
		           	if(data.row.verificacion_federal == 'SI')
		           	{
		           		//Marcar (Seleccionar) checkbox para indicar que el vehículo cuenta con verificación federal
		            	$('#chbVerificacionFederal_vehiculos_control_vehiculos').prop('checked', true);
		            }

		            $('#txtObservaciones_vehiculos_control_vehiculos').val(data.row.observaciones);
		            
		            //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
		            $('#txtCosto_vehiculos_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
		            $('#txtKilometraje_vehiculos_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
		            $('#txtCostoPoliza_vehiculos_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
		           
		            //Dependiendo del estatus cambiar el color del encabezado 
		            $('#divEncabezadoModal_vehiculos_control_vehiculos').addClass("estatus-"+strEstatus);

		            //Si el estatus del registro es ACTIVO
		            if(strEstatus == 'ACTIVO')
					{
						//Mostrar botón Desactivar
		            	$("#btnDesactivar_vehiculos_control_vehiculos").show();
					}
					else 
					{	
						//Si el tipo de acción corresponde a Ver
						if(tipoAccion == 'Ver')
						{
							//Deshabilitar todos los elementos del formulario
		            		$('#frmVehiculosControlVehiculos').find('input, textarea, select, checkbox').attr('disabled','disabled');
		            		//Ocultar botón Guardar
			           		$("#btnGuardar_vehiculos_control_vehiculos").hide(); 
						}
						
						//Mostrar botón Restaurar
						$("#btnRestaurar_vehiculos_control_vehiculos").show();
					}

		            //Si el tipo de acción es diferente de Nuevo
		            if(tipoAccion != 'Nuevo')
		            {
		            	//Abrir modal
			            objVehiculosControlVehiculos = $('#VehiculosControlVehiculosBox').bPopup({
													  appendTo: '#VehiculosControlVehiculosContent', 
						                              contentContainer: 'VehiculosControlVehiculosM', 
						                              zIndex: 2, 
						                              modalClose: false, 
						                              modal: true, 
						                              follow: [true,false], 
						                              followEasing : "linear", 
						                              easing: "linear", 
						                              modalColor: ('#F0F0F0')});

			            //Enfocar caja de texto
						$('#txtCodigo_vehiculos_control_vehiculos').focus();
			        }
	       	    }
	       },
	       'json');
		}

		//Función para regresar obtener los datos de un empleado (responsable)
		function get_datos_empleado_vehiculos_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los datos del empleado
             $.post('recursos_humanos/empleados/get_datos',
              { 
              	strBusqueda:$("#txtResponsableID_vehiculos_control_vehiculos").val(),
	       		strTipo: 'id'
              },
              function(data) {

                if(data.row){
                   $("#txtResponsable_vehiculos_control_vehiculos").val(data.row.apellido_paterno + ' ' + data.row.apellido_materno + ' ' + data.row.nombre); 
                   $("#txtDepartamentoID_vehiculos_control_vehiculos").val(data.row.departamento_id);
                   $("#txtDepartamento_vehiculos_control_vehiculos").val(data.row.departamento);
                   $("#txtLicencia_vehiculos_control_vehiculos").val(data.row.licencia_manejo);
                   $("#txtTipoLicencia_vehiculos_control_vehiculos").val(data.row.licencia_tipo);
                   $("#txtVigenciaLicencia_vehiculos_control_vehiculos").val(data.row.licencia_vigencia);

				    //Si existe id de la sucursal
				    if(data.row.sucursal_id > 0)
				    {
				    	$('#txtSucursalID_vehiculos_control_vehiculos').val(data.row.sucursal_id);
				    	$('#txtSucursal_vehiculos_control_vehiculos').val(data.row.sucursal);
				    }
				    else
				    {
				    	//Marcar (Seleccionar) checkbox para indicar que el empleado no pertenece a una sucursal
   					    $('#chbCorporativo_vehiculos_control_vehiculos').prop("checked", true);
				    	//Deshabilitar los siguientes elementos del formulario
						$("#txtSucursal_vehiculos_control_vehiculos").attr('disabled','disabled');
						$("#cmbModuloID_vehiculos_control_vehiculos").attr('disabled','disabled');
				    }
                }

              }
             ,
            'json');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFechaRenovacion_vehiculos_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtCosto_vehiculos_control_vehiculos').numeric();
			$('#txtCostoPoliza_vehiculos_control_vehiculos').numeric();
			$('#txtKilometraje_vehiculos_control_vehiculos').numeric();
			//Validar campos númericos (solamente valores enteros y positivos)
			$('#txtCodigo_vehiculos_control_vehiculos').numeric({decimal: false, negative: false});
       		$('#txtAnio_vehiculos_control_vehiculos').numeric({decimal: false, negative: false});

       		/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_vehiculos_control_vehiculos').blur(function(){
				$('.moneda_vehiculos_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
			});

       		//Autocomplete para recuperar los datos de un empleado (responsable)
	        $('#txtResponsable_vehiculos_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtResponsableID_vehiculos_control_vehiculos').val('');
	               //Hacer un llamado a la función para inicializar elementos del empleado
	               inicializar_empleado_vehiculos_control_vehiculos();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/empleados/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strEstatus: 'ACTIVO'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtResponsableID_vehiculos_control_vehiculos').val(ui.item.data);
	             //Hacer un llamado a la función para regresar los datos del empleado
	             get_datos_empleado_vehiculos_control_vehiculos();
	            
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
	        $('#txtResponsable_vehiculos_control_vehiculos').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtResponsableID_vehiculos_control_vehiculos').val() == '' || 
	               $('#txtResponsable_vehiculos_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtResponsableID_vehiculos_control_vehiculos').val('');
	               $('#txtResponsable_vehiculos_control_vehiculos').val('');
	               //Hacer un llamado a la función para inicializar elementos del empleado
	               inicializar_empleado_vehiculos_control_vehiculos();
	            }
	        });

	        //Autocomplete para recuperar los datos de un estado 
	        $('#txtEstado_vehiculos_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtEstadoID_vehiculos_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_estados/autocomplete",
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
	             $('#txtEstadoID_vehiculos_control_vehiculos').val(ui.item.data);
	             //Elegir código y descripción del estado desde el valor devuelto en el autocomplete
                 ui.item.value = ui.item.value.split(" , ")[0];
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        

	        //Verificar que exista id del estado cuando pierda el enfoque la caja de texto
	        $('#txtEstado_vehiculos_control_vehiculos').focusout(function(e){
	            //Si no existe id del estado
	            if($('#txtEstadoID_vehiculos_control_vehiculos').val() == '' || 
	               $('#txtEstado_vehiculos_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEstadoID_vehiculos_control_vehiculos').val('');
	               $('#txtEstado_vehiculos_control_vehiculos').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de un departamento
	        $('#txtDepartamento_vehiculos_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtDepartamentoID_vehiculos_control_vehiculos').val('');
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
	             $('#txtDepartamentoID_vehiculos_control_vehiculos').val(ui.item.data);
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
	        $('#txtDepartamento_vehiculos_control_vehiculos').focusout(function(e){
	            //Si no existe id del departamento
	            if($('#txtDepartamentoID_vehiculos_control_vehiculos').val() == '' ||
	               $('#txtDepartamento_vehiculos_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtDepartamentoID_vehiculos_control_vehiculos').val('');
	               $('#txtDepartamento_vehiculos_control_vehiculos').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una sucursal
	        $('#txtSucursal_vehiculos_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSucursalID_vehiculos_control_vehiculos').val('');
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
	             $('#txtSucursalID_vehiculos_control_vehiculos').val(ui.item.data);
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
	        $('#txtSucursal_vehiculos_control_vehiculos').focusout(function(e){
	            //Si no existe id de la sucursal
	            if($('#txtSucursalID_vehiculos_control_vehiculos').val() == '' ||
	               $('#txtSucursal_vehiculos_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSucursalID_vehiculos_control_vehiculos').val('');
	               $('#txtSucursal_vehiculos_control_vehiculos').val('');
	            }

	        });

			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo_vehiculos_control_vehiculos').focusout(function(e){
				//Si no existe id, verificar la existencia del código
				if ($('#txtVehiculoID_vehiculos_control_vehiculos').val() == '' && $('#txtCodigo_vehiculos_control_vehiculos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código 
					editar_vehiculos_control_vehiculos($('#txtCodigo_vehiculos_control_vehiculos').val(), 'codigo', 'Nuevo');
				}
			});


        	//Habilitar o deshabilitar sucursal, cuando se de click en el checkbox
		    $("#chbCorporativo_vehiculos_control_vehiculos").click(function() { 
		     	//Si el checkbox corporativo se encuentra seleccionado (marcado)
				if ($('#chbCorporativo_vehiculos_control_vehiculos').is(':checked')) 
		        {
		            //Deshabilitar los siguientes elementos del formulario
					$("#txtSucursal_vehiculos_control_vehiculos").attr('disabled','disabled');
					$("#cmbModuloID_vehiculos_control_vehiculos").attr('disabled','disabled');
					//Limpiar contenido de las siguientes cajas de texto
		            $('#txtSucursalID_vehiculos_control_vehiculos').val('');
		            $('#txtSucursal_vehiculos_control_vehiculos').val('');
		            //Limpiar contenido del combobox
		            $('#cmbModuloID_vehiculos_control_vehiculos').val('');

		        }
		        else
		        {
		          	//Habilitar los siguientes elementos del formulario
					$("#txtSucursal_vehiculos_control_vehiculos").removeAttr('disabled');
					$("#cmbModuloID_vehiculos_control_vehiculos").removeAttr('disabled');
		        }
		    
		    }); 


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_vehiculos_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaVehiculosControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_vehiculos_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_vehiculos_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_vehiculos_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_vehiculos_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				 objVehiculosControlVehiculos = $('#VehiculosControlVehiculosBox').bPopup({
											   appendTo: '#VehiculosControlVehiculosContent', 
				                               contentContainer: 'VehiculosControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_vehiculos_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_vehiculos_control_vehiculos').focus();      
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_vehiculos_control_vehiculos();
			//Hacer un llamado a la función para cargar módulos en el combobox del modal
            cargar_modulos_vehiculos_control_vehiculos();
		});
	</script>