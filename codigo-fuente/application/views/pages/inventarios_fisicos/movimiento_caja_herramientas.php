<div id="MovimientoCajaHerramientasInventariosFisicosContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_movimiento_caja_herramientas_inventarios_fisicos" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_movimiento_caja_herramientas_inventarios_fisicos">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_movimiento_caja_herramientas_inventarios_fisicos'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_movimiento_caja_herramientas_inventarios_fisicos"
			                    		name= "strFechaInicialBusq_movimiento_caja_herramientas_inventarios_fisicos" 
			                    		type="text" 
			                    		value="" 
			                    		tabindex="1" 
			                    		placeholder="Ingrese fecha" 
			                    		maxlength="10"/>
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
							<label for="txtFechaFinalBusq_movimiento_caja_herramientas_inventarios_fisicos">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_movimiento_caja_herramientas_inventarios_fisicos'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_movimiento_caja_herramientas_inventarios_fisicos"
			                    		name= "strFechaFinalBusq_movimiento_caja_herramientas_inventarios_fisicos" 
			                    		type="text" 
			                    		value="" 
			                    		tabindex="1" 
			                    		placeholder="Ingrese fecha" 
			                    		maxlength="10"/>
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
						</div>
					</div>
				</div>
				<!--Mecánico-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtMecanicoBusq_movimiento_caja_herramientas_inventarios_fisicos">Mecánico</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtMecanicoBusqID_movimiento_caja_herramientas_inventarios_fisicos" 
									name="strMecanicoBusqID_movimiento_caja_herramientas_inventarios_fisicos" 
									type="hidden" />
							<input  class="form-control" 
									id="txtMecanicoBusq_movimiento_caja_herramientas_inventarios_fisicos" 
									name="strMecanicoBusq_movimiento_caja_herramientas_inventarios_fisicos" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese mecánico" />
						</div>
					</div>
				</div>
				<!--Botones-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div id="ToolBtns" class="btn-group btn-toolBtns">
						<!-- Buscar registros -->
						<button class="btn btn-primary" id="btnBuscar_movimiento_caja_herramientas_inventarios_fisicos"
								onclick="paginacion_movimiento_caja_herramientas_inventarios_fisicos();" 
								title="Buscar coincidencias" tabindex="1"> 
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<!--Dar de alta un nuevo registro-->
						<button class="btn btn-info" id="btnNuevo_movimiento_caja_herramientas_inventarios_fisicos" 
								title="Nuevo registro" tabindex="1"> 
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>   
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_movimiento_caja_herramientas_inventarios_fisicos"
								onclick="reporte_movimiento_caja_herramientas_inventarios_fisicos();" title="Generar reporte PDF" tabindex="1">
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_movimiento_caja_herramientas_inventarios_fisicos"
								onclick="descargar_xls_movimiento_caja_herramientas_inventarios_fisicos();" title="Descargar archivo XLS" tabindex="1">
							<span class="fa fa-file-excel-o"></span>
						</button>  
					</div>
				</div>
			</div>
			<div class="row">
				<!--Mostrar detalles de los registros en el reporte PDF--> 
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="checkbox">
                    	<label id="label-checkbox">
                        	<input class="form-control" 
                        			id="chbImprimirDetalles_movimiento_caja_herramientas_inventarios_fisicos" 
								   	name="strImprimirDetalles_movimiento_caja_herramientas_inventarios_fisicos" 
								   	type="checkbox"
								   	value="" 
								   	tabindex="1" />
							<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							Imprimir detalles
                    	</label>
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
			td.movil:nth-of-type(3):before {content: "Tipo"; font-weight: bold;}
			td.movil:nth-of-type(4):before {content: "Mecánico"; font-weight: bold;}
			td.movil:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
			td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_movimiento_caja_herramientas_inventarios_fisicos">
				<thead class="movil">
					<tr class="movil">
						<th class="movil">Folio</th>
						<th class="movil">Fecha</th>
						<th class="movil">Tipo</th>
						<th class="movil">Mecánico</th>
						<th class="movil">Estatus</th>
						<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
					</tr>
				</thead>
				<tbody class="movil"></tbody>
				<script id="plantilla_movimiento_caja_herramientas_inventarios_fisicos" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil">{{folio}}</td>
						<td class="movil">{{fecha}}</td>
						<td class="movil">{{movimiento}}</td>
						<td class="movil">{{mecanico}}</td>
						<td class="movil">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_movimiento_caja_herramientas_inventarios_fisicos({{movimiento_herramienta_id}},'Editar')"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_movimiento_caja_herramientas_inventarios_fisicos({{movimiento_herramienta_id}},'Ver')"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_movimiento_caja_herramientas_inventarios_fisicos({{movimiento_herramienta_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_movimiento_caja_herramientas_inventarios_fisicos({{movimiento_herramienta_id}},'{{estatus}}')" title="Desactivar">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
									onclick="cambiar_estatus_movimiento_caja_herramientas_inventarios_fisicos({{movimiento_herramienta_id}},'{{estatus}}')"  title="Restaurar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimiento_caja_herramientas_inventarios_fisicos"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_movimiento_caja_herramientas_inventarios_fisicos">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!-- Diseño del modal-->
	<div id="MovimientoCajaHerramientasInventariosFisicosBox" class="ModalBody">
		<!--Título-->
		<div id="divEncabezadoModal_movimiento_caja_herramientas_inventarios_fisicos"  class="ModalBodyTitle">
		<h1>Movimientos de caja de herramientas</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmMovimientoCajaHerramientasInventariosFisicos" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmMovimientoCajaHerramientasInventariosFisicos"  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!-- Folio -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtMovimientoCajaHerramientasID_movimiento_caja_herramientas_inventarios_fisicos" 
									   name="intMovimientoCajaHerramientas_movimiento_caja_herramientas_inventarios_fisicos" 
									   type="hidden" 
									   value="" />
								<label for="txtFolio_movimiento_caja_herramientas_inventarios_fisicos">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
								        id="txtFolio_movimiento_caja_herramientas_inventarios_fisicos" 
										name="strFolio_movimiento_caja_herramientas_inventarios_fisicos" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Autogenerado" 
										disabled />
							</div>
						</div>
					</div>
					<!-- Fecha -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFecha_movimiento_caja_herramientas_inventarios_fisicos">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_movimiento_caja_herramientas_inventarios_fisicos'>
				                    <input class="form-control" 
				                    		id="txtFecha_movimiento_caja_herramientas_inventarios_fisicos"
				                    		name= "strFecha_movimiento_caja_herramientas_inventarios_fisicos" 
				                    		type="text" 
				                    		value="" 
				                    		tabindex="1" 
				                    		placeholder="Ingrese fecha" 
				                    		maxlength="10"/>
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
								<label for="cmbTipoID_movimiento_caja_herramientas_inventarios_fisicos">Tipo</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" 
										id="cmbTipoID_movimiento_caja_herramientas_inventarios_fisicos" 
								 		name="intTipoID_movimiento_caja_herramientas_inventarios_fisicos" 
								 		tabindex="1">
								 		<option value="1">ASIGNACIÓN</option>	
										<option value="11">ELIMINACIÓN</option>
                 				</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Mecánico -->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del mecánico seleccionado-->
								<input id="txtMecanicoID_movimiento_caja_herramientas_inventarios_fisicos" 
									   name="intMecanicoID_movimiento_caja_herramientas_inventarios_fisicos" 
									   type="hidden" 
									   value="" />
								<label for="txtMecanico_movimiento_caja_herramientas_inventarios_fisicos">Mecánico</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtMecanico_movimiento_caja_herramientas_inventarios_fisicos" 
										name="strMecanico_movimiento_caja_herramientas_inventarios_fisicos" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese mecánico" 
										maxlength="250" />			
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Observaciones -->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtObservaciones_movimiento_caja_herramientas_inventarios_fisicos">Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_movimiento_caja_herramientas_inventarios_fisicos" 
										name="strObservaciones_movimiento_caja_herramientas_inventarios_fisicos" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese observaciones" 
										maxlength="250" />			
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
								<input id="txtNumDetalles_movimiento_caja_herramientas_inventarios_fisicos" 
							   		name="intNumDetalles_movimiento_caja_herramientas_inventarios_fisicos" type="hidden" value="">
								</input>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Detalles del movimiento</h4>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Código-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id de la herramienta seleccionada-->
																<input id="txtHerramientaID_movimiento_caja_herramientas_inventarios_fisicos" 
																	   name="intHerramientaID_movimiento_caja_herramientas_inventarios_fisicos" 
																	   type="hidden" 
																	   value="" />
																<label for="txtCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos" 
																		name="strCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos" 
																		type="text" 
																		value="" 
																		tabindex="1"
																		placeholder="Ingrese código" 
																		maxlength="14" />
															</div>
														</div>
													</div>
													<!--Descripción-->
													<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDescripcion_detalles_movimiento_caja_herramientas_inventarios_fisicos">Descripción</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtDescripcion_detalles_movimiento_caja_herramientas_inventarios_fisicos" 
																		name="strDescripcion_detalles_movimiento_caja_herramientas_inventarios_fisicos" 
																		type="text" 
																		value="" 
																		tabindex="1" 
																		placeholder="Ingrese descripción" 
																		maxlength="250" />
															</div>
														</div>
													</div>
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos">Cantidad</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad" 
																		id="txtCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos" 
																		name="intCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos" 
																		type="text"
																		value="" 
																		tabindex="1" 
																		placeholder="Ingrese cantidad" 
																		maxlength="5" />
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-1">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_movimiento_caja_herramientas_inventarios_fisicos" 
					                                			onclick="agregar_renglon_detalles_movimiento_caja_herramientas_inventarios_fisicos();" 
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
													<table class="table-hover movil" id="dg_detalles_movimiento_caja_herramientas_inventarios_fisicos">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Código</th>
																<th class="movil">Descripción</th>
																<th class="movil">Cantidad</th>
																<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
														<tfoot class="movil">
															<tr class="movil">
																<td class="movil t1">
																	<strong>Total</strong>
																</td>
																<td class="movil"></td>
																<td  class="movil t3">
																	<strong id="acumCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos">0</strong>
																</td>
																<td class="movil"></td>
															</tr>
														</tfoot>
													</table>
													<br>
													<div class="row">
														<!--Número de registros encontrados-->
														<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
															<button class="btn btn-default btn-sm disabled pull-right">
																<strong id="numElementos_detalles_movimiento_caja_herramientas_inventarios_fisicos">0</strong> encontrados
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
				</div>  
				
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Nuevo registro-->
						<button class="btn btn-info" 
								id="btnReset_movimiento_caja_herramientas_inventarios_fisicos"  
								onclick="nuevo_movimiento_caja_herramientas_inventarios_fisicos('Nuevo');"  
								title="Nuevo registro" 
								tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" 
								id="btnGuardar_movimiento_caja_herramientas_inventarios_fisicos"  
								onclick="validar_movimiento_caja_herramientas_inventarios_fisicos();"  
								title="Guardar" 
								tabindex="2">
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_movimiento_caja_herramientas_inventarios_fisicos"  
								onclick="reporte_registro_movimiento_caja_herramientas_inventarios_fisicos('');"  
								title="Imprimir" 
								tabindex="5">
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" 
								id="btnDesactivar_movimiento_caja_herramientas_inventarios_fisicos"  
								onclick="cambiar_estatus_movimiento_caja_herramientas_inventarios_fisicos('','ACTIVO');"  
								title="Desactivar" 
								tabindex="6">
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  
								id="btnCerrar_movimiento_caja_herramientas_inventarios_fisicos"
								type="reset" 
								aria-hidden="true" 
								onclick="cerrar_movimiento_caja_herramientas_inventarios_fisicos();" 
								title="Cerrar"  
								tabindex="3">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div><!--Cierre del modal-->

</div><!--#MovimientoCajaHerramientasInventariosFisicosContent -->


<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variables que se utilizan para la paginación de registros
	var intPaginaMovimientoCajaHerramientasInventariosFisicos = 0;
	var strUltimaBusquedaMovimientoCajaHerramientasInventariosFisicos = "";
	//Variables que se utilizan para la búsqueda de registros
	var intMecanicoIDMovimientoCajaHerramientasInventariosFisicos = "";
	var dteFechaInicialMovimientoCajaHerramientasInventariosFisicos = "";
	var dteFechaFinalMovimientoCajaHerramientasInventariosFisicos = "";
	//Variable que se utiliza para asignar objeto del modal
	var objMovimientoCajaHerramientasInventariosFisicos = null;

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_movimiento_caja_herramientas_inventarios_fisicos()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('inventarios_fisicos/movimiento_caja_herramientas/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_movimiento_caja_herramientas_inventarios_fisicos').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosMovimientoCajaHerramientasInventariosFisicos = data.row;
				//Separar la cadena 
				var arrPermisosMovimientoCajaHerramientasInventariosFisicos = strPermisosMovimientoCajaHerramientasInventariosFisicos.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosMovimientoCajaHerramientasInventariosFisicos.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosMovimientoCajaHerramientasInventariosFisicos[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_movimiento_caja_herramientas_inventarios_fisicos').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosMovimientoCajaHerramientasInventariosFisicos[i]=='GUARDAR') || (arrPermisosMovimientoCajaHerramientasInventariosFisicos[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_movimiento_caja_herramientas_inventarios_fisicos').removeAttr('disabled');
					}
					//Si el indice es VER REGISTRO
					else if(arrPermisosMovimientoCajaHerramientasInventariosFisicos[i]=='VER REGISTRO')
					{
						
					}
					else if(arrPermisosMovimientoCajaHerramientasInventariosFisicos[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_movimiento_caja_herramientas_inventarios_fisicos').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_movimiento_caja_herramientas_inventarios_fisicos();
					}
					else if(arrPermisosMovimientoCajaHerramientasInventariosFisicos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_movimiento_caja_herramientas_inventarios_fisicos').removeAttr('disabled');
						$('#btnRestaurar_movimiento_caja_herramientas_inventarios_fisicos').removeAttr('disabled');
					}
					else if(arrPermisosMovimientoCajaHerramientasInventariosFisicos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_movimiento_caja_herramientas_inventarios_fisicos').removeAttr('disabled');
					}
					else if(arrPermisosMovimientoCajaHerramientasInventariosFisicos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_movimiento_caja_herramientas_inventarios_fisicos').removeAttr('disabled');
					}
					else if(arrPermisosMovimientoCajaHerramientasInventariosFisicos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_movimiento_caja_herramientas_inventarios_fisicos').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_movimiento_caja_herramientas_inventarios_fisicos() 
	{
		//Asignar valores para la búsqueda de registros
		var dteFechaInicialMovimientoCajaHerramientasInventariosFisicos =  $.formatFechaMysql($('#txtFechaInicialBusq_movimiento_caja_herramientas_inventarios_fisicos').val());
		var dteFechaFinalMovimientoCajaHerramientasInventariosFisicos =  $.formatFechaMysql($('#txtFechaFinalBusq_movimiento_caja_herramientas_inventarios_fisicos').val());
		//Si no existe fecha inicial
		if(dteFechaInicialMovimientoCajaHerramientasInventariosFisicos == '')
		{
			dteFechaInicialMovimientoCajaHerramientasInventariosFisicos = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalMovimientoCajaHerramientasInventariosFisicos == '')
		{
			dteFechaFinalMovimientoCajaHerramientasInventariosFisicos =  '0000-00-00';
		}
		//Si no existe id del evento en busqueda
		if( $('#txtMecanicoBusqID_movimiento_caja_herramientas_inventarios_fisicos').val() == '' || 
			$('#txtMecanicoBusq_movimiento_caja_herramientas_inventarios_fisicos').val() == ''
		  )
		{
			intMecanicoIDMovimientoCajaHerramientasInventariosFisicos = 0;
		}
		else{
			intMecanicoIDMovimientoCajaHerramientasInventariosFisicos = $('#txtMecanicoBusqID_movimiento_caja_herramientas_inventarios_fisicos').val();
		}
		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('inventarios_fisicos/movimiento_caja_herramientas/get_paginacion',
				{	dteFechaInicial: dteFechaInicialMovimientoCajaHerramientasInventariosFisicos,
	    			dteFechaFinal: dteFechaFinalMovimientoCajaHerramientasInventariosFisicos,
	    			intMecanicoID: intMecanicoIDMovimientoCajaHerramientasInventariosFisicos,
					intPagina:intPaginaMovimientoCajaHerramientasInventariosFisicos,
					strPermisosAcceso: $('#txtAcciones_movimiento_caja_herramientas_inventarios_fisicos').val()
				},
				function(data){
					$('#dg_movimiento_caja_herramientas_inventarios_fisicos tbody').empty();
					var tmpMovimientoCajaHerramientasInventariosFisicos = Mustache.render($('#plantilla_movimiento_caja_herramientas_inventarios_fisicos').html(),data);
					$('#dg_movimiento_caja_herramientas_inventarios_fisicos tbody').html(tmpMovimientoCajaHerramientasInventariosFisicos);
					$('#pagLinks_movimiento_caja_herramientas_inventarios_fisicos').html(data.paginacion);
					$('#numElementos_movimiento_caja_herramientas_inventarios_fisicos').html(data.total_rows);
					intPaginaMovimientoCajaHerramientasInventariosFisicos = data.pagina;
				},
		'json');
	}

	//Abrir modal cuando se de clic en el botón
	$('#btnNuevo_movimiento_caja_herramientas_inventarios_fisicos').bind('click', function(e) {
		e.preventDefault();
		//Hacer un llamado a la función para limpiar los campos del formulario
		nuevo_movimiento_caja_herramientas_inventarios_fisicos('Nuevo');
		//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
		$('#divEncabezadoModal_movimiento_caja_herramientas_inventarios_fisicos').addClass("estatus-NUEVO");
		//Abrir modal
		 objMovimientoCajaHerramientasInventariosFisicos = $('#MovimientoCajaHerramientasInventariosFisicosBox').bPopup({
									   appendTo: '#MovimientoCajaHerramientasInventariosFisicosContent', 
		                               contentContainer: 'MovimientoCajaHerramientasInventariosFisicosM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});
		
	});

	//Función para cargar el reporte general en PDF
	function reporte_movimiento_caja_herramientas_inventarios_fisicos() 
	{
		
		//Asignar valores para la búsqueda de registros
		var dteFechaInicialMovimientoCajaHerramientasInventariosFisicos =  $.formatFechaMysql($('#txtFechaInicialBusq_movimiento_caja_herramientas_inventarios_fisicos').val());
		var dteFechaFinalMovimientoCajaHerramientasInventariosFisicos =  $.formatFechaMysql($('#txtFechaFinalBusq_movimiento_caja_herramientas_inventarios_fisicos').val());
		//Si no existe fecha inicial
		if(dteFechaInicialMovimientoCajaHerramientasInventariosFisicos == '')
		{
			dteFechaInicialMovimientoCajaHerramientasInventariosFisicos = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalMovimientoCajaHerramientasInventariosFisicos == '')
		{
			dteFechaFinalMovimientoCajaHerramientasInventariosFisicos =  '0000-00-00';
		}
		//Si no existe id del evento en busqueda
		if( $('#txtMecanicoBusqID_movimiento_caja_herramientas_inventarios_fisicos').val() == '' || 
			$('#txtMecanicoBusq_movimiento_caja_herramientas_inventarios_fisicos').val() == ''
		  )
		{
			intMecanicoIDMovimientoCajaHerramientasInventariosFisicos = 0;
		}
		else{
			intMecanicoIDMovimientoCajaHerramientasInventariosFisicos = $('#txtMecanicoBusqID_movimiento_caja_herramientas_inventarios_fisicos').val();
		}

		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_movimiento_caja_herramientas_inventarios_fisicos').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_movimiento_caja_herramientas_inventarios_fisicos').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_movimiento_caja_herramientas_inventarios_fisicos').val('NO');
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("inventarios_fisicos/movimiento_caja_herramientas/get_reporte/"+
					dteFechaInicialMovimientoCajaHerramientasInventariosFisicos+"/"+
					dteFechaFinalMovimientoCajaHerramientasInventariosFisicos+"/"+
					intMecanicoIDMovimientoCajaHerramientasInventariosFisicos+"/"+
					$('#chbImprimirDetalles_movimiento_caja_herramientas_inventarios_fisicos').val());

	}

	//Función para descargar el archivo XLS
	function descargar_xls_movimiento_caja_herramientas_inventarios_fisicos() 
	{
		//Asignar valores para la búsqueda de registros
		var dteFechaInicialMovimientoCajaHerramientasInventariosFisicos =  $.formatFechaMysql($('#txtFechaInicialBusq_movimiento_caja_herramientas_inventarios_fisicos').val());
		var dteFechaFinalMovimientoCajaHerramientasInventariosFisicos =  $.formatFechaMysql($('#txtFechaFinalBusq_movimiento_caja_herramientas_inventarios_fisicos').val());
		//Si no existe fecha inicial
		if(dteFechaInicialMovimientoCajaHerramientasInventariosFisicos == '')
		{
			dteFechaInicialMovimientoCajaHerramientasInventariosFisicos = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalMovimientoCajaHerramientasInventariosFisicos == '')
		{
			dteFechaFinalMovimientoCajaHerramientasInventariosFisicos =  '0000-00-00';
		}
		//Si no existe id del evento en busqueda
		if( $('#txtMecanicoBusqID_movimiento_caja_herramientas_inventarios_fisicos').val() == '' || 
			$('#txtMecanicoBusq_movimiento_caja_herramientas_inventarios_fisicos').val() == ''
		  )
		{
			intMecanicoIDMovimientoCajaHerramientasInventariosFisicos = 0;
		}
		else{
			intMecanicoIDMovimientoCajaHerramientasInventariosFisicos = $('#txtMecanicoBusqID_movimiento_caja_herramientas_inventarios_fisicos').val();
		}

		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_movimiento_caja_herramientas_inventarios_fisicos').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_movimiento_caja_herramientas_inventarios_fisicos').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_movimiento_caja_herramientas_inventarios_fisicos').val('NO');
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("inventarios_fisicos/movimiento_caja_herramientas/get_xls/"+
					dteFechaInicialMovimientoCajaHerramientasInventariosFisicos+"/"+
					dteFechaFinalMovimientoCajaHerramientasInventariosFisicos+"/"+
					intMecanicoIDMovimientoCajaHerramientasInventariosFisicos+"/"+
					$('#chbImprimirDetalles_movimiento_caja_herramientas_inventarios_fisicos').val());
	}
		
	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_movimiento_caja_herramientas_inventarios_fisicos(tipoAccion)
	{
		
		//Incializar formulario
		$('#frmMovimientoCajaHerramientasInventariosFisicos')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_movimiento_caja_herramientas_inventarios_fisicos();
		//Limpiar cajas de texto ocultas
		$('#frmMovimientoCajaHerramientasInventariosFisicos').find('input[type=hidden]').val('');
		//Habilitar todos los elementos del formulario
	    $('#frmMovimientoCajaHerramientasInventariosFisicos').find('input, textarea, select').attr('disabled', false);
		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		inicializar_detalles_movimiento_caja_herramientas_inventarios_fisicos();	

		//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
		$('#divEncabezadoModal_movimiento_caja_herramientas_inventarios_fisicos').removeClass("estatus-NUEVO");
		$('#divEncabezadoModal_movimiento_caja_herramientas_inventarios_fisicos').removeClass("estatus-ACTIVO");
		$('#divEncabezadoModal_movimiento_caja_herramientas_inventarios_fisicos').removeClass("estatus-INACTIVO");
			
		/******************************************************************
		* INICIALIZACIÓN DE ELEMENTOS - ESTADO DEFAULT
		*******************************************************************/	
		//ID Movimiento
		$('#txtMovimientoCajaHerramientasID_movimiento_caja_herramientas_inventarios_fisicos').val('');
		//Folio
		$('#txtFolio_movimiento_caja_herramientas_inventarios_fisicos').val('');
		//Fecha
		$('#txtFecha_movimiento_caja_herramientas_inventarios_fisicos').val(fechaActual()); 
	    //Tipo de movimiento
		//$('#cmbMonedaID_movimiento_caja_herramientas_inventarios_fisicos').attr('disabled', false);
		//Mecánico
		$('#txtMecanicoID_movimiento_caja_herramientas_inventarios_fisicos').val('');
		$('#txtMecanico_movimiento_caja_herramientas_inventarios_fisicos').val('');
		//Observaciones
		$('#txtObservaciones_movimiento_caja_herramientas_inventarios_fisicos').val('');
		
		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo')
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_movimiento_caja_herramientas_inventarios_fisicos').addClass("estatus-NUEVO");
		}
	    
		//Mostrar botón Guardar
		$("#btnGuardar_movimiento_caja_herramientas_inventarios_fisicos").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_movimiento_caja_herramientas_inventarios_fisicos").hide();
		$("#btnDescargarArchivo_movimiento_caja_herramientas_inventarios_fisicos").hide();
		$("#btnDesactivar_movimiento_caja_herramientas_inventarios_fisicos").hide();
		$("#btnRestaurar_movimiento_caja_herramientas_inventarios_fisicos").hide();
		
	}
	
	//Función para inicializar elementos de la tabla detalles
	function inicializar_detalles_movimiento_caja_herramientas_inventarios_fisicos()
	{
		//Eliminar los datos de la tabla detalles del movimiento
		$('#dg_detalles_movimiento_caja_herramientas_inventarios_fisicos tbody').empty();
		$('#acumCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos').html(0);
		$('#numElementos_detalles_movimiento_caja_herramientas_inventarios_fisicos').html(0);
		$('#txtNumDetalles_movimiento_caja_herramientas_inventarios_fisicos').html('');
	}
	
	
	//Función que se utiliza para cerrar el modal
	function cerrar_movimiento_caja_herramientas_inventarios_fisicos()
	{
		try {
			//Cerrar modal
			objMovimientoCajaHerramientasInventariosFisicos.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_movimiento_caja_herramientas_inventarios_fisicos').focus();	
		}
		catch(err) {}
	}

	
	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_movimiento_caja_herramientas_inventarios_fisicos()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_movimiento_caja_herramientas_inventarios_fisicos();
		//Validación del formulario de campos obligatorios
		$('#frmMovimientoCajaHerramientasInventariosFisicos')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_movimiento_caja_herramientas_inventarios_fisicos: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
									    strMecanico_movimiento_caja_herramientas_inventarios_fisicos: {
											validators: {
											    callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la orden de compra
					                                    if( $('#txtMecanicoID_movimiento_caja_herramientas_inventarios_fisicos').val() === '')
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
										strObservaciones_movimiento_caja_herramientas_inventarios_fisicos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intNumDetalles_movimiento_caja_herramientas_inventarios_fisicos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para este movimiento.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strDescripcion_detalles_movimiento_caja_herramientas_inventarios_fisicos: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos: {
										        excluded: true  // Ignorar (no valida el campo)    
										}
										

									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_movimiento_caja_herramientas_inventarios_fisicos = $('#frmMovimientoCajaHerramientasInventariosFisicos').data('bootstrapValidator');
		bootstrapValidator_movimiento_caja_herramientas_inventarios_fisicos.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_movimiento_caja_herramientas_inventarios_fisicos.isValid())
		{	
			//Hacer un llamado a la función para guardar los datos del registro
			guardar_movimiento_caja_herramientas_inventarios_fisicos();				
		}
		else 
			return;
	}

	
	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_movimiento_caja_herramientas_inventarios_fisicos()
	{
		try
		{
			$('#frmMovimientoCajaHerramientasInventariosFisicos').data('bootstrapValidator').resetForm();

		}
		catch(err) {}
	}

	
	//Función para guardar o modificar los datos de un registro
	function guardar_movimiento_caja_herramientas_inventarios_fisicos()
	{
		
		//Obtenemos el objeto de la tabla detalles
		var objTabla = document.getElementById('dg_detalles_movimiento_caja_herramientas_inventarios_fisicos').getElementsByTagName('tbody')[0];

		//Inicializamos las variables que obtendrán los datos de la tabla
		var arrHerramientaID = [];
		var arrCantidades = [];

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Variable que se utilizan para asignar valores del detalle
			var intCantidad = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
			arrHerramientaID.push(objRen.getAttribute('id'));
			arrCantidades.push(intCantidad);
		}

		//Hacer un llamado al método del controlador para guardar los datos del registro
		$.post('inventarios_fisicos/movimiento_caja_herramientas/guardar',
				{ 
					//Datos de la entrada por compra
					intMovimientoCajaHerramientaID: $('#txtMovimientoCajaHerramientasID_movimiento_caja_herramientas_inventarios_fisicos').val(),
					strFolioConsecutivo: $('#txtFolio_movimiento_caja_herramientas_inventarios_fisicos').val(),
					//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					dteFecha: $.formatFechaMysql($('#txtFecha_movimiento_caja_herramientas_inventarios_fisicos').val()),
					intTipoID: $('#cmbTipoID_movimiento_caja_herramientas_inventarios_fisicos').val(),
					intMecanicoID: $('#txtMecanicoID_movimiento_caja_herramientas_inventarios_fisicos').val(),
					strObservaciones: $('#txtObservaciones_movimiento_caja_herramientas_inventarios_fisicos').val(),
					intProcesoMenuID: $('#txtProcesoMenuID_movimiento_caja_herramientas_inventarios_fisicos').val(),
					//Datos de los detalles
					strHerramientaID: arrHerramientaID.join('|'), 
					strCantidades: arrCantidades.join('|')
				},
				function(data) {

					if (data.resultado)
					{	
	                      
	                    //Si no existe id del movimiento, significa que es un nuevo registro   
						if($('#txtMovimientoCajaHerramientasID_movimiento_caja_herramientas_inventarios_fisicos').val() == '')
						{
						  	//Asignar el id del movimiento registrado en la base de datos
                 			$('#txtMovimientoCajaHerramientasID_movimiento_caja_herramientas_inventarios_fisicos').val(data.movimiento_herramienta_id);
                 			//Asignar folio consecutivo
                 			$('#txtFolio_movimiento_caja_herramientas_inventarios_fisicos').val(data.folio);
						} 

		                //Hacer un llamado a la función para cerrar modal
	                    cerrar_movimiento_caja_herramientas_inventarios_fisicos();
	                    //Hacer llamado a la función  para cargar  los registros en el grid
		               	paginacion_movimiento_caja_herramientas_inventarios_fisicos();        
		                	    
					}

					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_movimiento_caja_herramientas_inventarios_fisicos(data.tipo_mensaje, data.mensaje);

				},
		'json');
		
	}

	// Función para cambiar el estatus del registro seleccionado
	function cambiar_estatus_movimiento_caja_herramientas_inventarios_fisicos(id, estatus)
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoCajaHerramientasID_movimiento_caja_herramientas_inventarios_fisicos').val();

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
					              'title':    'Movimiento a caja de herramientas',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('inventarios_fisicos/movimiento_caja_herramientas/set_estatus',
					                                     {
					                                     	intMovimientoCajaHerramientaID: intID,
					                                      	strEstatus: estatus
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                          	//Hacer llamado a la función  para cargar  los registros en el grid
					                                          	paginacion_movimiento_caja_herramientas_inventarios_fisicos();
					                                          	//Si el id del registro se obtuvo del modal
																if(id == '')
																{
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_movimiento_caja_herramientas_inventarios_fisicos();     
																}
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_movimiento_caja_herramientas_inventarios_fisicos(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });
	    }
	    else//Si el estatus del registro es INACTIVO
	    {
			//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
			$.post('inventarios_fisicos/movimiento_caja_herramientas/set_estatus',
			     {
			     	intMovimientoCajaHerramientaID: intID,
			      	strEstatus: estatus
			     },
			     function(data) {
			      if (data.resultado)
			      {
			        //Hacer llamado a la función para cargar  los registros en el grid
			      	paginacion_movimiento_caja_herramientas_inventarios_fisicos();
			      	//Si el id del registro se obtuvo del modal
					if(id == '')
					{
						//Hacer un llamado a la función para cerrar modal
						cerrar_movimiento_caja_herramientas_inventarios_fisicos();     
					}
			      }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_movimiento_caja_herramientas_inventarios_fisicos(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
	    }
	}

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_movimiento_caja_herramientas_inventarios_fisicos(id, tipoAccion)
	{	
		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.post('inventarios_fisicos/movimiento_caja_herramientas/get_datos',
		       {
		       		intMovimientoCajaHerramientaID:id
		       },
		       function(data) {
		        	//Si hay datos del registro
		            if(data.row)
		            {
		            	//Hacer un llamado a la función para limpiar los campos del formulario
						nuevo_movimiento_caja_herramientas_inventarios_fisicos('');
						//Asignar estatus del registro
				        var strEstatus = data.row.estatus;
				        
			            //Recuperar valores
			            $('#txtMovimientoCajaHerramientasID_movimiento_caja_herramientas_inventarios_fisicos').val(data.row.movimiento_herramienta_id);
			            $('#txtFolio_movimiento_caja_herramientas_inventarios_fisicos').val(data.row.folio);
			            $('#txtFecha_movimiento_caja_herramientas_inventarios_fisicos').val(data.row.fecha);
			            $('#cmbTipoID_movimiento_caja_herramientas_inventarios_fisicos').val(data.row.tipo_movimiento);
			            $('#txtMecanicoID_movimiento_caja_herramientas_inventarios_fisicos').val(data.row.mecanico_id);
			            $('#txtMecanico_movimiento_caja_herramientas_inventarios_fisicos').val(data.row.mecanico);
			            $('#txtObservaciones_movimiento_caja_herramientas_inventarios_fisicos').val(data.row.observaciones);

			            if(tipoAccion == 'Ver')
			            {
			            	//Variable que se utiliza para asignar las acciones del grid view
					    	var strAccionesTablaDetalles = "";
			            }
			            else
			            {
			            	//Variable que se utiliza para asignar las acciones del grid view
					    	var strAccionesTablaDetalles = "<button class='btn btn-default btn-xs' title='Editar'" +
														 " onclick='editar_renglon_detalles_movimiento_caja_herramientas_inventarios_fisicos(this)'>" + 
														 "<span class='glyphicon glyphicon-edit'></span></button>" + 
														 "<button class='btn btn-default btn-xs' title='Eliminar'" +
														 " onclick='eliminar_renglon_detalles_movimiento_caja_herramientas_inventarios_fisicos(this)'>" + 
														 "<span class='glyphicon glyphicon-trash'></span></button>" + 
														 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
														 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
														 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
														 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
			            }
			             
			            //Mostramos los detalles del registro
			           	for (var intCon in data.detalles) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_movimiento_caja_herramientas_inventarios_fisicos').getElementsByTagName('tbody')[0];

							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcion = objRenglon.insertCell(1);
							var objCeldaCantidad = objRenglon.insertCell(2);
							var objCeldaAcciones = objRenglon.insertCell(3);

							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].herramienta_id);
							objCeldaCodigo.setAttribute('class', 'movil b1');
							objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
							objCeldaDescripcion.setAttribute('class', 'movil b2');
							objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
							objCeldaCantidad.setAttribute('class', 'movil b3');
							objCeldaCantidad.innerHTML = data.detalles[intCon].cantidad;
							objCeldaAcciones.setAttribute('class', 'td-center movil b4');
							objCeldaAcciones.innerHTML = strAccionesTablaDetalles;
		
			            }

			            //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimiento_caja_herramientas_inventarios_fisicos();
						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_movimiento_caja_herramientas_inventarios_fisicos tr").length - 2;
						$('#numElementos_detalles_movimiento_caja_herramientas_inventarios_fisicos').html(intFilas);
						$('#txtNumDetalles_movimiento_caja_herramientas_inventarios_fisicos').val(intFilas);
			            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
			            $('#divEncabezadoModal_movimiento_caja_herramientas_inventarios_fisicos').addClass("estatus-"+strEstatus);
			            //Mostrar botón Imprimir  
			            $("#btnImprimirRegistro_movimiento_caja_herramientas_inventarios_fisicos").show();
			           	
						//Si el tipo de acción corresponde a Ver
			            if(tipoAccion == 'Ver')
			            {
			            	//Deshabilitar todos los elementos del formulario
			            	$('#frmMovimientoCajaHerramientasInventariosFisicos').find('input, textarea, select').attr('disabled','disabled');
			            	//Ocultar botón Guardar
				            $("#btnGuardar_movimiento_caja_herramientas_inventarios_fisicos").hide();

				            //Si el estatus del registro es INACTIVO
			            	if(strEstatus == 'INACTIVO')
			            	{
			            		//Mostrar botón Restaurar
			            		$("#btnRestaurar_movimiento_caja_herramientas_inventarios_fisicos").show();
			            	}

			            }
			            else
			            {
			            	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
				            {
				            	//Mostrar los siguientes botones  
				            	$("#btnDesactivar_movimiento_caja_herramientas_inventarios_fisicos").show();
				            }
			            }
			            
						//Abrir modal
						 objMovimientoCajaHerramientasInventariosFisicos = $('#MovimientoCajaHerramientasInventariosFisicosBox').bPopup({
													   appendTo: '#MovimientoCajaHerramientasInventariosFisicosContent', 
						                               contentContainer: 'MovimientoCajaHerramientasInventariosFisicosM', 
						                               zIndex: 2, 
						                               modalClose: false, 
						                               modal: true, 
						                               follow: [true,false], 
						                               followEasing : "linear", 
						                               easing: "linear", 
						                               modalColor: ('#F0F0F0')});

			            //Enfocar caja de texto
						$('#txtFecha_movimiento_caja_herramientas_inventarios_fisicos').focus();   

		       	    }
		       },
		       'json');
	}

	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_movimiento_caja_herramientas_inventarios_fisicos(id)
	{	

		//Variable que se utiliza para asignar id de la encuesta
		var intMovimientoCajaHerramientaID = 0;
		
		//Dependiendo del tipo de formulario asignar id
		if(id == '')
			intMovimientoCajaHerramientaID = $('#txtMovimientoCajaHerramientasID_movimiento_caja_herramientas_inventarios_fisicos').val();
		else
			intMovimientoCajaHerramientaID = id;

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("inventarios_fisicos/movimiento_caja_herramientas/get_reporte_registro/" + intMovimientoCajaHerramientaID);
	}

	//Función para mostrar mensaje de éxito o error
	function mensaje_movimiento_caja_herramientas_inventarios_fisicos(tipoMensaje, mensaje)
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
	
	/*******************************************************************************************************************
	Funciones de la tabla detalles
	*********************************************************************************************************************/
	//Función para agregar renglón a la tabla
	function agregar_renglon_detalles_movimiento_caja_herramientas_inventarios_fisicos()
	{
		//Obtenemos los datos de las cajas de texto
		var intMecanicoID = $('#txtMecanicoID_movimiento_caja_herramientas_inventarios_fisicos').val();
		var intHerramienta = $('#txtHerramientaID_movimiento_caja_herramientas_inventarios_fisicos').val();
		var strCodigo = $('#txtCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos').val();
		var strDescripcion = $('#txtDescripcion_detalles_movimiento_caja_herramientas_inventarios_fisicos').val();
		var intCantidad =  parseFloat($.reemplazar($('#txtCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos').val(), ",", ""));
		
		//Obtenemos el objeto de la tabla
		var objTabla = document.getElementById('dg_detalles_movimiento_caja_herramientas_inventarios_fisicos').getElementsByTagName('tbody')[0];
		
		//Validamos que se encuentre seleccionado un mecánico existente
		if(intMecanicoID == '')
		{
			$('#txtMecanico_movimiento_caja_herramientas_inventarios_fisicos').focus();
		}
		//Validamos que se capturaron datos
		else if (intHerramienta == '' || strCodigo == '' || strDescripcion == '')
		{
			//Enfocar caja de texto
			$('#txtCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos').focus();
		}
		else if (intCantidad == '')
		{
			//Enfocar caja de texto
			$('#txtCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos').focus();
		}
		else
		{
			//Si el movimiento es de tipo ELIMINACIÓN		
			if($('#cmbTipoID_movimiento_caja_herramientas_inventarios_fisicos').val() == 11){
				//Verificar cual es la existencia actual para la relación mecánico-herramienta
				$.post('inventarios_fisicos/movimiento_caja_herramientas/get_existencia',
						{ 
							intMecanicoID: intMecanicoID,
							intHerramientaID: intHerramienta
						},
						function(data) {
							if (data.row != null)
							{	                           
				            	console.log('EXISTE UNA RELACIÓN: ' + data.row.cantidad);
				            	if(intCantidad > data.row.cantidad){
				            		new $.Zebra_Dialog('La siguiente herramienta quedará en negativo en el inventario en: ' + (data.row.cantidad - intCantidad), {
				            								'type': 'warning',
														   	'title': 'Advertencia',
														   	'buttons': false,
													       	'modal': false,
													       	'auto_close': 2000
												    	   });
				            	}    
							}
							else
							{
								new $.Zebra_Dialog('La siguiente herramienta quedará en negativo en el inventario en: -' + intCantidad, {
				            								'type': 'warning',
														   	'title': 'Advertencia',
														   	'buttons': false,
													       	'modal': false,
													       	'auto_close': 2000
												    	   });
							}
						},
				'json');
			}
				
			//Limpiamos las cajas de texto
			$('#txtHerramientaID_movimiento_caja_herramientas_inventarios_fisicos').val('');
			$('#txtCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos').val('');
			$('#txtDescripcion_detalles_movimiento_caja_herramientas_inventarios_fisicos').val('');
			$('#txtCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos').val('');

			//Utilizar toUpperCase() para cambiar texto a mayúsculas
			strCodigo = strCodigo.toUpperCase();
			strDescripcion = strDescripcion.toUpperCase();

			//Revisamos si existe la descripción proporcionada, si es así, editamos los datos
			if (objTabla.rows.namedItem(intHerramienta))
			{
				objTabla.rows.namedItem(intHerramienta).cells[0].innerHTML = strCodigo;
				objTabla.rows.namedItem(intHerramienta).cells[1].innerHTML = strDescripcion;
				objTabla.rows.namedItem(intHerramienta).cells[2].innerHTML = formatMoney(intCantidad, 2, '');
			}
			else
			{
				//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaCodigo = objRenglon.insertCell(0);
				var objCeldaDescripcion = objRenglon.insertCell(1);
				var objCeldaCantidad = objRenglon.insertCell(2);
				var objCeldaAcciones = objRenglon.insertCell(3);
				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', intHerramienta);
				objCeldaCodigo.setAttribute('class', 'movil b1');
				objCeldaCodigo.innerHTML = strCodigo;
				objCeldaDescripcion.setAttribute('class', 'movil b2');
				objCeldaDescripcion.innerHTML = strDescripcion;
				objCeldaCantidad.setAttribute('class', 'movil b3');
				objCeldaCantidad.innerHTML = formatMoney(intCantidad, 2, '');
				objCeldaAcciones.setAttribute('class', 'td-center movil b4');
				objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_detalles_movimiento_caja_herramientas_inventarios_fisicos(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
											 " onclick='eliminar_renglon_detalles_movimiento_caja_herramientas_inventarios_fisicos(this)'>" + 
											 "<span class='glyphicon glyphicon-trash'></span></button>" + 
											 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
											 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
			}

			
			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_movimiento_caja_herramientas_inventarios_fisicos();
			
			//Enfocar caja de texto
			$('#txtCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos').focus();	

		}

		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_detalles_movimiento_caja_herramientas_inventarios_fisicos tr").length - 2;
		$('#numElementos_detalles_movimiento_caja_herramientas_inventarios_fisicos').html(intFilas);
		$('#txtNumDetalles_movimiento_caja_herramientas_inventarios_fisicos').val(intFilas);	
	}

	//Función para regresar los datos (al formulario) del renglón seleccionado
	function editar_renglon_detalles_movimiento_caja_herramientas_inventarios_fisicos(objRenglon)
	{
		//Asignar los valores a las cajas de texto
		$('#txtHerramientaID_movimiento_caja_herramientas_inventarios_fisicos').val(objRenglon.parentNode.parentNode.getAttribute('id'));
		$('#txtCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
		$('#txtDescripcion_detalles_movimiento_caja_herramientas_inventarios_fisicos').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
		$('#txtCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos').val(objRenglon.parentNode.parentNode.cells[2].innerHTML)

		//Enfocar caja de texto
		$('#txtCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos').focus();
	}

	//Función para quitar renglón de la tabla
	function eliminar_renglon_detalles_movimiento_caja_herramientas_inventarios_fisicos(objRenglon)
	{
		//Obtener el indice del objeto renglón que se envía
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
		
		//Eliminar el renglón indicado
		document.getElementById("dg_detalles_movimiento_caja_herramientas_inventarios_fisicos").deleteRow(intRenglon);

		//Hacer un llamado a la función para calcular totales de la tabla
		calcular_totales_detalles_movimiento_caja_herramientas_inventarios_fisicos();
		
		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_detalles_movimiento_caja_herramientas_inventarios_fisicos tr").length - 2;
		$('#numElementos_detalles_movimiento_caja_herramientas_inventarios_fisicos').html(intFilas);
		$('#txtNumDetalles_movimiento_caja_herramientas_inventarios_fisicos').val(intFilas);

		//Enfocar caja de texto
		$('#txtCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos').focus();
	}

	//Función para calcular totales de la tabla
	function calcular_totales_detalles_movimiento_caja_herramientas_inventarios_fisicos()
	{
		
		//Obtenemos el objeto de la tabla 
		var objTabla = document.getElementById('dg_detalles_movimiento_caja_herramientas_inventarios_fisicos').getElementsByTagName('tbody')[0];

		//Inicializamos las variables que se utilizan para los acumulados
		var intAcumCantidad = 0;

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Incrementar acumulados
			intAcumCantidad += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
		}

		//Convertir cantidad a formato moneda
		intAcumCantidad = formatMoney(intAcumCantidad, 2, '');

		//Asignar los valores
		$('#acumCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos').html(intAcumCantidad);
	}

	//Al inicializar el componente
	$(document).ready(function() 
	{

        /*******************************************************************************************************************
		Controles correspondientes al MODAL
		*********************************************************************************************************************/
		$('#txtCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos').numeric();

		/*Asignar formatCurrency (formato Cantidad) a la clase para cambiar el formato de la cantidad
         * por ejemplo: 10 será 10.00*/
        $('.cantidad').blur(function(){
            $('.cantidad').formatCurrency({ roundToDecimalPlace: 2 });
        });

        //Agregar datepicker para seleccionar fecha
		$('#dteFecha_movimiento_caja_herramientas_inventarios_fisicos').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFecha_movimiento_caja_herramientas_inventarios_fisicos').datetimepicker({format: 'DD/MM/YYYY',
			 																   useCurrent: false});

		//Autocomplete para recuperar los datos de un mecánico 
        $('#txtMecanico_movimiento_caja_herramientas_inventarios_fisicos').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtMecanicoID_movimiento_caja_herramientas_inventarios_fisicos').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "servicio/mecanicos/autocomplete",
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
             $('#txtMecanicoID_movimiento_caja_herramientas_inventarios_fisicos').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('servicio/mecanicos/get_datos',
                  { 
                  	strBusqueda:$("#txtMecanicoID_movimiento_caja_herramientas_inventarios_fisicos").val(),
                  	strTipo:'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtMecanicoID_movimiento_caja_herramientas_inventarios_fisicos").val(data.row.mecanico_id);
                       $("#txtMecanico_movimiento_caja_herramientas_inventarios_fisicos").val(data.row.empleado);
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

        //Autocomplete para recuperar los datos de una herramienta 
        $('#txtCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtHerramientaID_movimiento_caja_herramientas_inventarios_fisicos').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "inventarios_fisicos/herramientas/autocomplete",
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
             $('#txtHerramientaID_movimiento_caja_herramientas_inventarios_fisicos').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('inventarios_fisicos/herramientas/get_datos',
                  { 
                  	strBusqueda:$("#txtHerramientaID_movimiento_caja_herramientas_inventarios_fisicos").val(),
                  	strTipo:'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtHerramientaID_movimiento_caja_herramientas_inventarios_fisicos").val(data.row.herramienta_id);
                       $("#txtCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos").val(data.row.codigo);
                       $("#txtDescripcion_detalles_movimiento_caja_herramientas_inventarios_fisicos").val(data.row.descripcion);
                       $("#txtCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos").focus();
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

        //Autocomplete para recuperar los datos de una herramienta 
        $('#txtDescripcion_detalles_movimiento_caja_herramientas_inventarios_fisicos').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtHerramientaID_movimiento_caja_herramientas_inventarios_fisicos').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "inventarios_fisicos/herramientas/autocomplete",
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
             $('#txtHerramientaID_movimiento_caja_herramientas_inventarios_fisicos').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('inventarios_fisicos/herramientas/get_datos',
                  { 
                  	strBusqueda:$("#txtHerramientaID_movimiento_caja_herramientas_inventarios_fisicos").val(),
                  	strTipo:'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtHerramientaID_movimiento_caja_herramientas_inventarios_fisicos").val(data.row.herramienta_id);
                       $("#txtCodigo_detalles_movimiento_caja_herramientas_inventarios_fisicos").val(data.row.codigo);
                       $("#txtDescripcion_detalles_movimiento_caja_herramientas_inventarios_fisicos").val(data.row.descripcion);
                       $("#txtCantidad_detalles_movimiento_caja_herramientas_inventarios_fisicos").focus();
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

        //Función para mover renglones arriba y abajo en la tabla
		$('#dg_detalles_movimiento_caja_herramientas_inventarios_fisicos').on('click','button.btn',function(){
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


		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_movimiento_caja_herramientas_inventarios_fisicos').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_movimiento_caja_herramientas_inventarios_fisicos').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_movimiento_caja_herramientas_inventarios_fisicos').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_movimiento_caja_herramientas_inventarios_fisicos').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_movimiento_caja_herramientas_inventarios_fisicos').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_movimiento_caja_herramientas_inventarios_fisicos').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_movimiento_caja_herramientas_inventarios_fisicos').on('click','a',function(event){
			event.preventDefault();
			intPaginaMovimientoCajaHerramientasInventariosFisicos = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_movimiento_caja_herramientas_inventarios_fisicos();
		});

		//Autocomplete para recuperar los datos de un mecánico 
        $('#txtMecanicoBusq_movimiento_caja_herramientas_inventarios_fisicos').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtMecanicoBusqID_movimiento_caja_herramientas_inventarios_fisicos').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "servicio/mecanicos/autocomplete",
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
             $('#txtMecanicoBusqID_movimiento_caja_herramientas_inventarios_fisicos').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('servicio/mecanicos/get_datos',
                  { 
                  	strBusqueda:$("#txtMecanicoBusqID_movimiento_caja_herramientas_inventarios_fisicos").val(),
                  	strTipo:'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtMecanicoBusqID_movimiento_caja_herramientas_inventarios_fisicos").val(data.row.mecanico_id);
                       $("#txtMecanicoBusq_movimiento_caja_herramientas_inventarios_fisicos").val(data.row.empleado);
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


        //
        $('#txtFechaInicialBusq_movimiento_caja_herramientas_inventarios_fisicos').focus();

        //Deshabilitar los siguientes botones (funciones de permisos de acceso)
		$('#btnNuevo_movimiento_caja_herramientas_inventarios_fisicos').attr('disabled','-1');  
		$('#btnImprimir_movimiento_caja_herramientas_inventarios_fisicos').attr('disabled','-1');
		$('#btnDescargarXLS_movimiento_caja_herramientas_inventarios_fisicos').attr('disabled','-1');
		$('#btnBuscar_movimiento_caja_herramientas_inventarios_fisicos').attr('disabled','-1');
		$('#btnGuardar_movimiento_caja_herramientas_inventarios_fisicos').attr('disabled','-1');
		$('#btnImprimirRegistro_movimiento_caja_herramientas_inventarios_fisicos').attr('disabled','-1');
		$('#btnDesactivar_movimiento_caja_herramientas_inventarios_fisicos').attr('disabled','-1');
		$('#btnRestaurar_movimiento_caja_herramientas_inventarios_fisicos').attr('disabled','-1');   
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_movimiento_caja_herramientas_inventarios_fisicos();

	});

</script>