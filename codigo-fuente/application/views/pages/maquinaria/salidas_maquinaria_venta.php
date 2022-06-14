<div id="SalidasMaquinariaVentaMaquinariaContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_salidas_maquinaria_venta_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_salidas_maquinaria_venta_maquinaria">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_salidas_maquinaria_venta_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_salidas_maquinaria_venta_maquinaria"
			                    		name= "strFechaInicialBusq_salidas_maquinaria_venta_maquinaria" 
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
							<label for="txtFechaFinalBusq_salidas_maquinaria_venta_maquinaria">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_salidas_maquinaria_venta_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_salidas_maquinaria_venta_maquinaria"
			                    		name= "strFechaFinalBusq_salidas_maquinaria_venta_maquinaria" 
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
				<!--Cliente-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtClienteBusq_salidas_maquinaria_venta_maquinaria">Cliente</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtClienteIDBusq_salidas_maquinaria_venta_maquinaria" 
									name="intClienteIDBusq_salidas_maquinaria_venta_maquinaria" 
									type="hidden" />
							<input  class="form-control" 
									id="txtClienteBusq_salidas_maquinaria_venta_maquinaria" 
									name="strClienteBusq_salidas_maquinaria_venta_maquinaria" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese cliente" />
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="cmbEstatusBusq_salidas_maquinaria_venta_maquinaria">Estatus</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="cmbEstatusBusq_salidas_maquinaria_venta_maquinaria" 
							 		name="strEstatusBusq_salidas_maquinaria_venta_maquinaria" tabindex="1">
							    <option value="TODOS">TODOS</option>
                  				<option value="ACTIVO">ACTIVO</option>
                  				<option value="TIMBRAR">TIMBRAR</option>                  				
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
								<label for="txtBusqueda_salidas_maquinaria_venta_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_salidas_maquinaria_venta_maquinaria" 
										name="strBusqueda_salidas_maquinaria_venta_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
				<!--Mostrar detalles de los registros en el reporte PDF--> 
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
					<div class="checkbox">
                    	<label id="label-checkbox">
                        	<input class="form-control" 
                        			id="chbImprimirDetalles_salidas_maquinaria_venta_maquinaria" 
								   	name="strImprimirDetalles_salidas_maquinaria_venta_maquinaria" 
								   	type="checkbox"
								   	value="" 
								   	tabindex="1" />
							<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							Imprimir detalles
                    	</label>
                  	</div>
				</div>
				<!--Botones-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div id="ToolBtns" class="btn-group btn-toolBtns">
						<!-- Buscar registros -->
						<button class="btn btn-primary" id="btnBuscar_salidas_maquinaria_venta_maquinaria"
								onclick="paginacion_salidas_maquinaria_venta_maquinaria();" 
								title="Buscar coincidencias" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<!--Dar de alta un nuevo registro-->
						<button class="btn btn-info" id="btnNuevo_salidas_maquinaria_venta_maquinaria" 
								title="Nuevo registro" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>   
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_salidas_maquinaria_venta_maquinaria"
								onclick="reporte_salidas_maquinaria_venta_maquinaria();" title="Generar reporte PDF" tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_salidas_maquinaria_venta_maquinaria"
								onclick="descargar_xls_salidas_maquinaria_venta_maquinaria();" title="Descargar archivo XLS" tabindex="1" disabled>
							<span class="fa fa-file-excel-o"></span>
						</button>  
					</div>
				</div>
			</div>
			<div class="row">

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
			td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
			td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_salidas_maquinaria_venta_maquinaria">
				<thead class="movil">
					<tr class="movil">
						<th class="movil">Folio</th>
						<th class="movil">Fecha</th>
						<th class="movil">Factura</th>
						<th class="movil">Cliente</th>
						<th class="movil">Estatus</th>
						<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
					</tr>
				</thead>
				<tbody class="movil"></tbody>
				<script id="plantilla_salidas_maquinaria_venta_maquinaria" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil">{{folio}}</td>
						<td class="movil">{{fecha}}</td>
						<td class="movil">{{factura}}</td>
						<td class="movil">{{cliente}}</td>
						<td class="movil">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_salidas_maquinaria_venta_maquinaria({{movimiento_maquinaria_id}},'Editar')"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_salidas_maquinaria_venta_maquinaria({{movimiento_maquinaria_id}},'Ver')"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_salidas_maquinaria_venta_maquinaria({{movimiento_maquinaria_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_salidas_maquinaria_venta_maquinaria({{movimiento_maquinaria_id}},'{{estatus}}')" title="Desactivar">
								<span class="glyphicon glyphicon-ban-circle"></span>
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_salidas_maquinaria_venta_maquinaria"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_salidas_maquinaria_venta_maquinaria">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!-- Diseño del modal-->
	<div id="SalidasMaquinariaVentaMaquinariaBox" class="ModalBody"  tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_salidas_maquinaria_venta_maquinaria"  class="ModalBodyTitle">
			<h1>Salida de Maquinaria por Venta</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmSalidasMaquinariaVentaMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmSalidasMaquinariaVentaMaquinaria"  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!-- Folio -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtMovimientoMaquinariaID_salidas_maquinaria_venta_maquinaria" 
									   name="intMovimientoCajaHerramientas_salidas_maquinaria_venta_maquinaria" 
									   type="hidden" 
									   value="" />
								<!-- Caja de texto oculta que se utiliza para recuperar el id del folio de entrada por compra seleccionado-->   
								<label for="txtFolio_salidas_maquinaria_venta_maquinaria">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
								        id="txtFolio_salidas_maquinaria_venta_maquinaria" 
										name="strFolio_salidas_maquinaria_venta_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese folio" 
										disabled />
							</div>
						</div>
					</div>
					<!-- Fecha -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFecha_salidas_maquinaria_venta_maquinaria">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_salidas_maquinaria_venta_maquinaria'>
				                    <input class="form-control" 
				                    		id="txtFecha_salidas_maquinaria_venta_maquinaria"
				                    		name= "strFecha_salidas_maquinaria_venta_maquinaria" 
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
					<!-- Factura -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el ID del Proveedor de la orden de compra -->
								<input id="txtFacturaID_salidas_maquinaria_venta_maquinaria" 
									   name="intFacturaID_salidas_maquinaria_venta_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtFactura_salidas_maquinaria_venta_maquinaria">Factura</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtFactura_salidas_maquinaria_venta_maquinaria" 
										name="strFactura_salidas_maquinaria_venta_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese factura" 
										maxlength="250" />			
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Cliente -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtCliente_salidas_maquinaria_venta_maquinaria">Cliente</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtCliente_salidas_maquinaria_venta_maquinaria" 
										name="strCliente_salidas_maquinaria_venta_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese cliente" 
										maxlength="250" 
										disabled />			
							</div>
						</div>
					</div>
					<!-- Observaciones -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtObservaciones_salidas_maquinaria_venta_maquinaria">Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_salidas_maquinaria_venta_maquinaria" 
										name="strObservaciones_salidas_maquinaria_venta_maquinaria" 
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
								</input>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Detalles de la salida</h4>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<!--Tabs-->
												<div class="row">
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="form-group">
															<ul class="nav nav-tabs  nav-justified" id="tabs_salidas_maquinaria_venta_maquinaria" role="tablist">
																<!--Tab que contiene la información general-->
																<li id="tabInformacionGeneral_salidas_maquinaria_venta_maquinaria" class="active">
																	<a data-toggle="tab" href="#informacion_general_salidas_maquinaria_venta_maquinaria">Información General</a>
																</li>
																<!--Tab que contiene los componentes-->
																<li id="tabComponentes_salidas_maquinaria_venta_maquinaria">
																	<a data-toggle="tab" href="#componentes_salidas_maquinaria_venta_maquinaria">Componentes</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
												<div class="tab-content">
													<!--Tab - Información General-->
													<div id="informacion_general_salidas_maquinaria_venta_maquinaria" class="tab-pane fade in active">
														<div class="row">
															<!--Autocomplete que contiene las series de la descripción de maquinaria-->
															<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<!-- Caja de texto oculta que se utiliza para recuperar el id del inventario (correspondiente a la descripción de maquinaria) seleccionado-->
																		<input id="txtInventarioMaquinariaDescripcionID_salidas_maquinaria_venta_maquinaria" 
																			   name="intInventarioMaquinariaDescripcionID_salidas_maquinaria_venta_maquinaria"  
																			   type="hidden" value="" />
																		<label for="txtSerie_salidas_maquinaria_venta_maquinaria">
																			Serie
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" 
																				id="txtSerie_salidas_maquinaria_venta_maquinaria" 
																				name="strSerie_salidas_maquinaria_venta_maquinaria" 
																				type="text" value="" tabindex="1" 
																				placeholder="Ingrese serie" maxlength="50" disabled />
																	</div>
																</div>
															</div>
															<!--Autocomplete que contiene los motores de la descripción de maquinaria-->
															<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtMotor_salidas_maquinaria_venta_maquinaria">
																			Motor
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" 
																				id="txtMotor_salidas_maquinaria_venta_maquinaria" 
																				name="strMotor_salidas_maquinaria_venta_maquinaria" 
																				type="text" value="" tabindex="1" 
																				placeholder="Ingrese motor" maxlength="50" disabled />
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<!--Autocomplete que contiene las descripciones de maquinaria activas-->
															<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtCodigo_salidas_maquinaria_venta_maquinaria">
																			Código
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" 
																				id="txtCodigo_salidas_maquinaria_venta_maquinaria" 
																				name="strCodigo_salidas_maquinaria_venta_maquinaria" 
																				type="text" value="" tabindex="1" 
																				placeholder="Ingrese código" maxlength="250" disabled />
																	</div>
																</div>
															</div>
															<!--Autocomplete que contiene las descripciones de maquinaria activas-->
															<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtDescripcionCorta_salidas_maquinaria_venta_maquinaria">Descripción corta</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtDescripcionCorta_salidas_maquinaria_venta_maquinaria" 
																				name="strDescripcionCorta_salidas_maquinaria_venta_maquinaria" type="text"  value="" tabindex="1" 
																				placeholder="Ingrese descripción" maxlength="250" disabled />
																		<input id="txtDescripcion_salidas_maquinaria_venta_maquinaria" 
																			   name="strDescripcion_salidas_maquinaria_venta_maquinaria"  
																			   type="hidden" value="" />		
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--Tab - Componentes-->
													<div id="componentes_salidas_maquinaria_venta_maquinaria" class="tab-pane fade">
														<!--Div que contiene la tabla con los componentes agregados-->
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																<!-- Diseño de la tabla-->
																<table class="table-hover movil" id="dg_detalles_salidas_maquinaria_venta_maquinaria">
																	<thead class="movil">
																		<tr class="movil">
																			<th class="movil">Código</th>
																			<th class="movil">Descripción</th>
																			<th class="movil">Serie</th>
																			<th class="movil">Motor</th>
																			<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
																		</tr>
																	</thead>
																	<tbody class="movil"></tbody>
																</table>
																<br>
																<div class="row">
																	<!--Número de registros encontrados-->
																	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																		<button class="btn btn-default btn-sm disabled pull-right">
																			<strong id="numElementos_componentes_salidas_maquinaria_venta_maquinaria">0</strong> encontrados
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
						</div>	
					</div>	
				</div>  
				
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Nuevo registro-->
						<button class="btn btn-info" 
								id="btnReset_salidas_maquinaria_venta_maquinaria"  
								onclick="nuevo_salidas_maquinaria_venta_maquinaria('Nuevo');"  
								title="Nuevo registro" 
								tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" 
								id="btnGuardar_salidas_maquinaria_venta_maquinaria"  
								onclick="validar_salidas_maquinaria_venta_maquinaria();"  
								title="Guardar" 
								tabindex="2" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_salidas_maquinaria_venta_maquinaria"  
								onclick="reporte_registro_salidas_maquinaria_venta_maquinaria('');"  
								title="Imprimir" 
								tabindex="5" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" 
								id="btnDesactivar_salidas_maquinaria_venta_maquinaria"  
								onclick="cambiar_estatus_salidas_maquinaria_venta_maquinaria('','ACTIVO');"  
								title="Desactivar" 
								tabindex="6">
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  
								id="btnCerrar_salidas_maquinaria_venta_maquinaria"
								type="reset" 
								aria-hidden="true" 
								onclick="cerrar_salidas_maquinaria_venta_maquinaria();" 
								title="Cerrar"  
								tabindex="3">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div><!--Cierre del modal-->

	<!--Diseño del modal secundario-->
	<div id="AditamentosSalidasMaquinariaVentaMaquinariaBox" class="ModalBody" tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModalSecundario_salidas_maquinaria_venta_maquinaria" class="ModalBodyTitle">
			<h1>Ver aditamentos</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmAditamentosSalidasMaquinariaVentaMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmAditamentosSalidasMaquinariaVentaMaquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
				  	<!--Código-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el renglón seleccionado -->	
								<label for="txtCodigoAditamentos_salidas_maquinaria_venta_maquinaria">Código</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtCodigoAditamentos_salidas_maquinaria_venta_maquinaria" 
										name="strCodigoAditamentos_salidas_maquinaria_venta_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtDescripcionAditamentos_salidas_maquinaria_venta_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtDescripcionAditamentos_salidas_maquinaria_venta_maquinaria" 
										name="strDescripcionAditamentos_salidas_maquinaria_venta_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Serie-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtSerieAditamentos_salidas_maquinaria_venta_maquinaria">Serie</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSerieAditamentos_salidas_maquinaria_venta_maquinaria" 
										name="strSerieAditamentos_salidas_maquinaria_venta_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Motor-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtMotorAditamentos_salidas_maquinaria_venta_maquinaria">Motor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtMotorAditamentos_salidas_maquinaria_venta_maquinaria" 
										name="strMotorAditamentos_salidas_maquinaria_venta_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<!-- Diseño de la tabla-->
									<table class="table-hover" id="dg_aditamentos_detalles_salidas_maquinaria_venta_maquinaria">
										<thead>
											<tr>
												<th>Cantidad</th>
												<th>Descripción</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
									<br>
									<div class="row">
										<!--Número de registros encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_detalles_aditamentos_salidas_maquinaria_venta_maquinaria">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>		
							</div>
						</div>		
					</div>
				</div>
				<!--Cierre row-->		
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_respuestas_salidas_maquinaria_venta_maquinaria"
								type="reset" aria-hidden="true" onclick="cerrar_aditamentos_salidas_maquinaria_venta_maquinaria();" title="Cerrar">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>
				<!--Cierre Botones de acción (barra de tareas)-->	
			</form>
			<!--Cierre del formulario-->	  
		</div>
		<!--Cierre del Contenido-->
	</div>
	<!--Cierre del modal secundario-->

</div><!--#SalidasMaquinariaVentaMaquinariaContent -->


<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variable que se utiliza para asignar el id del movimiento de SALIDA DE MAQUINARIA POR VENTA
	var intMovimientoIDSalidaMaquinariaVentaMaquinaria = <?php echo SALIDA_MAQUINARIA_VENTA ?>;

	//Variables que se utilizan para la paginación de registros
	var intPaginaSalidasMaquinariaVentaMaquinaria = 0;
	var strUltimaBusquedaSalidasMaquinariaVentaMaquinaria = "";
	//Variables que se utilizan para la búsqueda de registros
	var intMecanicoIDSalidasMaquinariaVentaMaquinaria = "";
	var dteFechaInicialSalidasMaquinariaVentaMaquinaria = "";
	var dteFechaFinalSalidasMaquinariaVentaMaquinaria = "";
	//Variable que se utiliza para asignar objeto del modal
	var objSalidasMaquinariaVentaMaquinaria = null;
	//Variable que se utiliza para asignar objeto del modal secundario
	var objAditamentosSalidasMaquinariaVentaMaquinaria = null;

	/*******************************************************************************************************************
	Funciones del objeto Salida por traspaso
	*********************************************************************************************************************/
	// Constructor de Salida
	var objSalida;
	function Salida(id, referenciaID, tipoMovimiento, folio, fecha, observaciones, maquinarias)
	{
	    this.intMovimientoMaquinariaID = id;
	    this.intReferenciaID = referenciaID;
	    this.strTipoMovimiento = tipoMovimiento;
	    this.strFolio = folio;
	    this.strFecha = fecha;
	    this.strObservaciones = observaciones;
	    this.arrMaquinarias = maquinarias;
	}
	// --------------------- MÉTODOS PARA EL OBJETO ENTRADA ------------------------------------------------------------
	Salida.prototype.setID = function(id) { this.intMovimientoMaquinariaID = id; }
	Salida.prototype.getID = function() { return this.intMovimientoMaquinariaID; }
	Salida.prototype.setReferenciaID = function(referenciaID) { this.intReferenciaID = referenciaID; }
	Salida.prototype.getReferenciaID = function() { return this.intReferenciaID; }
	Salida.prototype.setTipoMovimiento = function(tipoMovimiento) { this.strTipoMovimiento = tipoMovimiento; }
	Salida.prototype.getTipoMovimiento = function() { return this.strTipoMovimiento; }
	Salida.prototype.setFolio = function(folio) { this.strFolio = folio; }
	Salida.prototype.getFolio = function() { return this.strFolio; }
	Salida.prototype.setFecha = function(fecha) { this.strFecha = fecha; }
	Salida.prototype.getFecha = function() { return this.strFecha; }
	Salida.prototype.setObservaciones = function(observaciones) { this.strObservaciones = observaciones; }
	Salida.prototype.getObservaciones = function() { return this.strObservaciones; }
	// -------------------- FUNCIONES ASOCIADAS AL ATRIBUTO MAQUINARIAS ---------------------------------------------------
	//Función para agregar todas las maquinarias al objeto Entrada
	Salida.prototype.setMaquinarias = function(maquinarias) { this.arrMaquinarias = maquinarias; }
	//Función para obtener todas las maquinarias del objeto Entrada
	Salida.prototype.getMaquinarias = function() { return this.arrMaquinarias; }
	//Función para agregar una maquinaria al objeto Entrada
	Salida.prototype.setMaquinaria = function (maquinaria){ this.arrMaquinarias.push(maquinaria); }
	//Función para obtener una maquinaria del objeto Entrada
	Salida.prototype.getMaquinaria = function(index) { return this.arrMaquinarias[index]; }
	//Función para modificar un objeto maquinaria del objeto Entrada
	Salida.prototype.updateMaquinaria = function (index, maquinaria){ this.arrMaquinarias[index] = maquinaria; }
	//Función para eliminar una maquinaria del objeto Entrada
	Salida.prototype.deleteMaquinaria = function (index){
		if(index != -1) {
			this.arrMaquinarias.splice(index, 1);
		}
	}
	//Función para cambiar las posiciones de las preguntas en el Objeto Encuesta
	Salida.prototype.swap = function(index_A, index_B) {
	    var input = this.arrMaquinarias;
	 
	    var temp = input[index_A];
	    input[index_A] = input[index_B];
	    input[index_B] = temp;
	}


	/*******************************************************************************************************************
	Funciones del objeto Maquinaria
	*********************************************************************************************************************/
	// Constructor de Maquinaria
	var objMaquinaria;
	function Maquinaria(id, renglon, maquinariaDescripcionID, codigo, descripcionCorta, descripcion, serie, motor)
	{
	    this.intMovimientoMaquinariaID = id;
	    this.intRenglon = renglon;
	    this.strMaquinariaDescripcionID = maquinariaDescripcionID;
	    this.strCodigo = codigo;
	    this.strDescripcionCorta = descripcionCorta;
	    this.strDescripcion = descripcion;
	    this.strSerie = serie;
	    this.strMotor = motor;
	}
	// --------------------- MÉTODOS PARA EL OBJETO MAQUINARIA ------------------------------------------------------------
	Maquinaria.prototype.setID = function(id) { this.intMovimientoMaquinariaID = id; }
	Maquinaria.prototype.getID = function() { return this.intMovimientoMaquinariaID; }
	Maquinaria.prototype.setRenglon = function(renglon) { this.intRenglon = renglon; }
	Maquinaria.prototype.getRenglon = function() { return this.intRenglon; }
	Maquinaria.prototype.setMaquinariaDescripcion = function(maquinariaDescripcion) { this.strMaquinariaDescripcion = maquinariaDescripcion; }
	Maquinaria.prototype.getMaquinariaDescripcion = function() { return this.strMaquinariaDescripcion; }
	Maquinaria.prototype.setCodigo = function(codigo) { this.strCodigo = codigo; }
	Maquinaria.prototype.getCodigo = function() { return this.strCodigo; }
	Maquinaria.prototype.setDescripcionCorta = function(descripcionCorta) { this.strDescripcionCorta = descripcionCorta; }
	Maquinaria.prototype.getDescripcionCorta = function() { return this.strDescripcionCorta; }
	Maquinaria.prototype.setDescripcion = function(descripcion) { this.strDescripcion = descripcion; }
	Maquinaria.prototype.getDescripcion = function() { return this.strDescripcion; }
	Maquinaria.prototype.setSerie = function(serie) { this.strSerie = serie; }
	Maquinaria.prototype.getSerie = function() { return this.strSerie; }
	Maquinaria.prototype.setMotor = function(motor) { this.strMotor = motor; }
	Maquinaria.prototype.getMotor = function() { return this.strMotor; }

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_salidas_maquinaria_venta_maquinaria()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('maquinaria/salidas_maquinaria_venta/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_salidas_maquinaria_venta_maquinaria').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosSalidasMaquinariaVentaMaquinaria = data.row;
				//Separar la cadena 
				var arrPermisosSalidasMaquinariaVentaMaquinaria = strPermisosSalidasMaquinariaVentaMaquinaria.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosSalidasMaquinariaVentaMaquinaria.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosSalidasMaquinariaVentaMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_salidas_maquinaria_venta_maquinaria').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosSalidasMaquinariaVentaMaquinaria[i]=='GUARDAR') || (arrPermisosSalidasMaquinariaVentaMaquinaria[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_salidas_maquinaria_venta_maquinaria').removeAttr('disabled');
					}
					//Si el indice es VER REGISTRO
					else if(arrPermisosSalidasMaquinariaVentaMaquinaria[i]=='VER REGISTRO')
					{
						
					}
					else if(arrPermisosSalidasMaquinariaVentaMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_salidas_maquinaria_venta_maquinaria').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_salidas_maquinaria_venta_maquinaria();
					}
					else if(arrPermisosSalidasMaquinariaVentaMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_salidas_maquinaria_venta_maquinaria').removeAttr('disabled');
						
					}
					else if(arrPermisosSalidasMaquinariaVentaMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_salidas_maquinaria_venta_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosSalidasMaquinariaVentaMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_salidas_maquinaria_venta_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosSalidasMaquinariaVentaMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_salidas_maquinaria_venta_maquinaria').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_salidas_maquinaria_venta_maquinaria() 
	{

		//Asignar valores para la búsqueda de registros
		var intClienteIDBusq_salidas_maquinaria_venta_maquinaria = $('#txtClienteIDBusq_salidas_maquinaria_venta_maquinaria').val();
		var dteFechaInicialSalidasMaquinariaVentaMaquinaria =  $.formatFechaMysql($('#txtFechaInicialBusq_salidas_maquinaria_venta_maquinaria').val());
		var dteFechaFinalSalidasMaquinariaVentaMaquinaria =  $.formatFechaMysql($('#txtFechaFinalBusq_salidas_maquinaria_venta_maquinaria').val());
		//Si no existe fecha inicial
		if(dteFechaInicialSalidasMaquinariaVentaMaquinaria == '')
		{
			dteFechaInicialSalidasMaquinariaVentaMaquinaria = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalSalidasMaquinariaVentaMaquinaria == '')
		{
			dteFechaFinalSalidasMaquinariaVentaMaquinaria =  '0000-00-00';
		}
		//Si no existe id del cliente en busqueda
		if( intClienteIDBusq_salidas_maquinaria_venta_maquinaria == '' )
		{
			intClienteIDBusq_salidas_maquinaria_venta_maquinaria = 0;
		}

		//Concatenar datos para la nueva búsqueda
   		var strNuevaBusquedaSalidasMaquinariaVentaMaquinaria =($('#txtFechaInicialBusq_salidas_maquinaria_venta_maquinaria').val()+$('#txtFechaFinalBusq_salidas_maquinaria_venta_maquinaria').val()+$('#txtClienteIDBusq_salidas_maquinaria_venta_maquinaria').val()+$('#cmbEstatusBusq_salidas_maquinaria_venta_maquinaria').val()+$('#txtBusqueda_salidas_maquinaria_venta_maquinaria').val());
   		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaSalidasMaquinariaVentaMaquinaria != strUltimaBusquedaSalidasMaquinariaVentaMaquinaria)
		{
			intPaginaSalidasMaquinariaVentaMaquinaria = 0;
			strUltimaBusquedaSalidasMaquinariaVentaMaquinaria = strNuevaBusquedaSalidasMaquinariaVentaMaquinaria;
		}

		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('maquinaria/salidas_maquinaria_venta/get_paginacion',
				{	dteFechaInicial: dteFechaInicialSalidasMaquinariaVentaMaquinaria,
	    			dteFechaFinal: dteFechaFinalSalidasMaquinariaVentaMaquinaria,
	    			intProveedorID: intClienteIDBusq_salidas_maquinaria_venta_maquinaria,
	    			strEstatus:     $('#cmbEstatusBusq_salidas_maquinaria_venta_maquinaria').val(),
	    			strBusqueda:    $('#txtBusqueda_salidas_maquinaria_venta_maquinaria').val(),
					intPagina:intPaginaSalidasMaquinariaVentaMaquinaria,
					strPermisosAcceso: $('#txtAcciones_salidas_maquinaria_venta_maquinaria').val()
				},
				function(data){
					$('#dg_salidas_maquinaria_venta_maquinaria tbody').empty();
					var tmpSalidasMaquinariaVentaMaquinaria = Mustache.render($('#plantilla_salidas_maquinaria_venta_maquinaria').html(),data);
					$('#dg_salidas_maquinaria_venta_maquinaria tbody').html(tmpSalidasMaquinariaVentaMaquinaria);
					$('#pagLinks_salidas_maquinaria_venta_maquinaria').html(data.paginacion);
					$('#numElementos_salidas_maquinaria_venta_maquinaria').html(data.total_rows);
					intPaginaSalidasMaquinariaVentaMaquinaria = data.pagina;
				},
		'json');
	}

	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_salidas_maquinaria_venta_maquinaria(tipoAccion)
	{
		
		//Incializar formulario
		$('#frmSalidasMaquinariaVentaMaquinaria')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_salidas_maquinaria_venta_maquinaria();
		//Limpiar cajas de texto ocultas
		$('#frmSalidasMaquinariaVentaMaquinaria').find('input[type=hidden]').val('');
		//Seleccionar tab que contiene la información general
	  	$('a[href="#informacion_general_salidas_maquinaria_venta_maquinaria"]').click();
		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		inicializar_detalles_salidas_maquinaria_venta_maquinaria();	

		//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
		$('#divEncabezadoModal_salidas_maquinaria_venta_maquinaria').removeClass("estatus-NUEVO");
		$('#divEncabezadoModal_salidas_maquinaria_venta_maquinaria').removeClass("estatus-ACTIVO");
		$('#divEncabezadoModal_salidas_maquinaria_venta_maquinaria').removeClass("estatus-INACTIVO");
			
		/******************************************************************
		* INICIALIZACIÓN DE ELEMENTOS - ESTADO DEFAULT
		*******************************************************************/	
		//Folio
		$('#txtFolio_salidas_maquinaria_venta_maquinaria').val('');
		//Fecha
		$('#txtFecha_salidas_maquinaria_venta_maquinaria').val(fechaActual()); 
		//Observaciones
		$('#txtObservaciones_salidas_maquinaria_venta_maquinaria').val('');
		
		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo')
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_salidas_maquinaria_venta_maquinaria').addClass("estatus-NUEVO");
		}
	    
		//Habilitar los siguientes componentes
		$('#txtFecha_salidas_maquinaria_venta_maquinaria').removeAttr('disabled','disabled');
		$('#txtFactura_salidas_maquinaria_venta_maquinaria').removeAttr('disabled','disabled');
		$('#txtObservaciones_salidas_maquinaria_venta_maquinaria').removeAttr('disabled','disabled');

	    nuevo_objeto_salida();

		//Mostrar botón Guardar
		$("#btnGuardar_salidas_maquinaria_venta_maquinaria").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_salidas_maquinaria_venta_maquinaria").hide();
		$("#btnDescargarArchivo_salidas_maquinaria_venta_maquinaria").hide();
		$("#btnDesactivar_salidas_maquinaria_venta_maquinaria").hide();
		
		
	}

	//Función para crear un nuevo objeto de tipo Encuesta
	function nuevo_objeto_salida(){
		// Crear un Objeto de tipo Salida por traspaso
		objSalida = new Salida(null, null, null, '', '', '', null, null, []);
	}
	
	//Función para inicializar elementos de la tabla detalles
	function inicializar_detalles_salidas_maquinaria_venta_maquinaria()
	{
		//Eliminar los datos de la tabla detalles del movimiento
		$('#dg_detalles_salidas_maquinaria_venta_maquinaria tbody').empty();
		$('#acumCantidad_detalles_salidas_maquinaria_venta_maquinaria').html(0);
		$('#numElementos_detalles_salidas_maquinaria_venta_maquinaria').html(0);
		$('#txtNumDetalles_salidas_maquinaria_venta_maquinaria').html('');
	}
	
	
	//Función que se utiliza para cerrar el modal
	function cerrar_salidas_maquinaria_venta_maquinaria()
	{
		try {
			//Cerrar modal
			objSalidasMaquinariaVentaMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_salidas_maquinaria_venta_maquinaria').focus();	
		}
		catch(err) {}
	}

	
	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_salidas_maquinaria_venta_maquinaria()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_salidas_maquinaria_venta_maquinaria();
		//Validación del formulario de campos obligatorios
		$('#frmSalidasMaquinariaVentaMaquinaria')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
								  		strFactura_salidas_maquinaria_venta_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la orden de compra
					                                    if( $('#txtFacturaID_salidas_maquinaria_venta_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una factura existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFecha_salidas_maquinaria_venta_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strSerie_salidas_maquinaria_venta_maquinaria: {
											excluded: true
										},
										strMotor_salidas_maquinaria_venta_maquinaria: {
											excluded: true
										}
									
									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_salidas_maquinaria_venta_maquinaria = $('#frmSalidasMaquinariaVentaMaquinaria').data('bootstrapValidator');
		bootstrapValidator_salidas_maquinaria_venta_maquinaria.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_salidas_maquinaria_venta_maquinaria.isValid())
		{	
			//Hacer un llamado a la función para guardar los datos del registro
			guardar_salidas_maquinaria_venta_maquinaria();				
		}
		else 
			return;
	}

	
	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_salidas_maquinaria_venta_maquinaria()
	{
		try
		{
			$('#frmSalidasMaquinariaVentaMaquinaria').data('bootstrapValidator').resetForm();

		}
		catch(err) {}
	}

	
	//Función para guardar o modificar los datos de un registro
	function guardar_salidas_maquinaria_venta_maquinaria()
	{
		//Obtenemos el objeto de la tabla detalles
		objSalida.setID( $('#txtMovimientoMaquinariaID_salidas_maquinaria_venta_maquinaria').val() );
		objSalida.setReferenciaID( $('#txtFacturaID_salidas_maquinaria_venta_maquinaria').val() );
		objSalida.setTipoMovimiento( intMovimientoIDSalidaMaquinariaVentaMaquinaria );
		objSalida.setFolio( $('#txtFolio_salidas_maquinaria_venta_maquinaria').val() );
		objSalida.setFecha( $.formatFechaMysql($('#txtFecha_salidas_maquinaria_venta_maquinaria').val()) );
		objSalida.setObservaciones( $('#txtObservaciones_salidas_maquinaria_venta_maquinaria').val() );

		//Agregar maquinarias del GRID
		//Limpiamos todo el array de maquinarias para insertar de nuevo los elementos
		objSalida.arrMaquinarias = [];

		//Obtenemos el objeto de la tabla detalles
		var objTabla = document.getElementById('dg_detalles_salidas_maquinaria_venta_maquinaria').getElementsByTagName('tbody')[0];

		//Verificamos si la maquinairia es de tipo sencilla o compuesta
		//Si la maquinaria contiene componentes (MAQUINARIA COMPUESTA)

		if(objTabla.rows.length > 0){
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Obtener cantidades y descripciones de cada aditamento
				var strCodigo = objRen.cells[0].innerHTML;
				var strDescripcionCorta = objRen.cells[1].innerHTML;
				var strSerie = objRen.cells[2].innerHTML;
				var strMotor = objRen.cells[3].innerHTML;
				var intMaquinariaDescripcionID = objRen.cells[5].innerHTML;

				var strDescripcion = strDescripcionCorta;

				//Variable para crea el ojeto Maquinaria
				var objMaquinaria = new Maquinaria(null, intRen, intMaquinariaDescripcionID, strCodigo, strDescripcionCorta, strDescripcion, strSerie, strMotor);
				//Inserta en la vista el objeto objSalida<-objMaquinaria
				objSalida.setMaquinaria(objMaquinaria); 	
			}
		}
		else{
			
			//Obtener cantidades y descripciones de cada aditamento
			var strSerie = $('#txtSerie_salidas_maquinaria_venta_maquinaria').val();
			var strMotor = $('#txtMotor_salidas_maquinaria_venta_maquinaria').val();
			var strCodigo = $('#txtCodigo_salidas_maquinaria_venta_maquinaria').val();
			var strDescripcionCorta = $('#txtDescripcionCorta_salidas_maquinaria_venta_maquinaria').val();
			var strDescripcion = $('#txtDescripcion_salidas_maquinaria_venta_maquinaria').val();
			var intMaquinariaDescripcionID = $('#txtInventarioMaquinariaDescripcionID_salidas_maquinaria_venta_maquinaria').val();

			//Variable para crea el ojeto Maquinaria
			var objMaquinaria = new Maquinaria(null, 0, intMaquinariaDescripcionID, strCodigo, strDescripcionCorta, strDescripcion, strSerie, strMotor);
			
			//Inserta en la vista el objeto objSalida<-objMaquinaria
			objSalida.setMaquinaria(objMaquinaria); 
		}
		
		//Convenrtir al formato JSON todo lo generado en el objeto de la vista
		var jsonSalida = JSON.stringify(objSalida); 

		//Hacer un llamado al método del controlador para guardar los datos del registro		
		$.post('maquinaria/salidas_maquinaria_venta/guardar',
		{ 
			//Datos de la entrada por compra
			strFolioConsecutivo: $('#txtFolio_salidas_maquinaria_venta_maquinaria').val(),
			salidaVenta: jsonSalida,
			intProcesoMenuID: $('#txtProcesoMenuID_salidas_maquinaria_venta_maquinaria').val()
		},
		function(data) {

			if (data.resultado)
			{	    
                //Si no existe id del movimiento, significa que es un nuevo registro   
				if($('#txtMovimientoMaquinariaID_salidas_maquinaria_venta_maquinaria').val() == '')
				{
				  	//Asignar el id del movimiento registrado en la base de datos
         			$('#txtMovimientoMaquinariaID_salidas_maquinaria_venta_maquinaria').val(data.movimiento_maquinaria_id);
         			//Asignar folio consecutivo
         			$('#txtFolio_salidas_maquinaria_venta_maquinaria').val(data.folio);
				} 
                //Hacer un llamado a la función para cerrar modal
                cerrar_salidas_maquinaria_venta_maquinaria();
                //Hacer llamado a la función  para cargar  los registros en el grid
               	paginacion_salidas_maquinaria_venta_maquinaria();               	    
			}
			//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			mensaje_salidas_maquinaria_venta_maquinaria(data.tipo_mensaje, data.mensaje);
		},
		'json');
		
	}

	// Función para cambiar el estatus del registro seleccionado
	function cambiar_estatus_salidas_maquinaria_venta_maquinaria(id, estatus)
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_salidas_maquinaria_venta_maquinaria').val();
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
					              'title':    'Salida de Maquinaria por Venta',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('maquinaria/salidas_maquinaria_venta/set_estatus',
					                                     {
					                                     	intMovimientoMaquinariaID: intID
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                            //Hacer llamado a la función  para cargar  los registros en el grid
					                                            paginacion_salidas_maquinaria_venta_maquinaria();
					                                            //Si el id del registro se obtuvo del modal
																if(id == '')
																{
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_salidas_maquinaria_venta_maquinaria();     
																}
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_salidas_maquinaria_venta_maquinaria(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                        }
					              });

	    }

	}

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_salidas_maquinaria_venta_maquinaria(id, tipoAccion)
	{	
	   //Hacer un llamado al método del controlador para regresar los datos del registro
	   $.post('maquinaria/salidas_maquinaria_venta/get_datos',
       {
       		intMovimientoMaquinariaID:id
       },
       function(data) {

        	//Si hay datos del registro 
            if(data.row)
            {  
            	//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_salidas_maquinaria_venta_maquinaria();
				//Asignar estatus del registro
				var strEstatus = data.row.estatus;
	          	
	          	//Recuperar valores para la Vista
	            $('#txtMovimientoMaquinariaID_salidas_maquinaria_venta_maquinaria').val(data.row.movimiento_maquinaria_id);
	            $('#txtFolio_salidas_maquinaria_venta_maquinaria').val(data.row.folio);
	            $('#txtFecha_salidas_maquinaria_venta_maquinaria').val(data.row.fecha);
	            $('#txtFacturaID_salidas_maquinaria_venta_maquinaria').val(data.row.referencia_id);
	            $('#txtFactura_salidas_maquinaria_venta_maquinaria').val(data.row.factura);
	            $('#txtCliente_salidas_maquinaria_venta_maquinaria').val(data.row.cliente);
				$('#txtObservaciones_salidas_maquinaria_venta_maquinaria').val(data.row.observaciones);

				//Asignar valores al objeto que maneja los valores de la Vista
				objSalida.setID(data.row.movimiento_maquinaria_id);
				objSalida.setFolio(data.row.folio);
				objSalida.setReferenciaID(data.row.referencia_id);
				objSalida.setObservaciones(data.row.observaciones);	            

				//Mostramos los detalles correspondientes a la maquinaria
                $.post('maquinaria/facturas_maquinaria/get_datos',
                { 
                  	intFacturaMaquinariaID: data.row.referencia_id
                },
                  function(data) { 

                    //Cargar datos del registro
                    if(data.row){
                    	$('#txtCliente_salidas_maquinaria_venta_maquinaria').val(data.row.razon_social);
                    	$('#txtInventarioMaquinariaDescripcionID_salidas_maquinaria_venta_maquinaria').val(data.row.maquinaria_descripcion_id);
                    	$('#txtSerie_salidas_maquinaria_venta_maquinaria').val(data.row.serie);
                    	$('#txtMotor_salidas_maquinaria_venta_maquinaria').val(data.row.motor);
                    	$('#txtCodigo_salidas_maquinaria_venta_maquinaria').val(data.row.codigo);
                    	$('#txtDescripcionCorta_salidas_maquinaria_venta_maquinaria').val(data.row.descripcion_corta);
                    	$('#txtDescripcion_salidas_maquinaria_venta_maquinaria').val(data.row.descripcion);	
                    }
       
                    //Si la maquinaria es de tipo Compuesta
		       	    if(data.detalles)
		       	    {
		       	    	//Variable que se utiliza para asignar las acciones del grid view
				        var strAccionesTabla = '';

                    	//Mostramos los componentes que componen la maquinaria(En caso de que aplique)
						for (var intCon in data.detalles) 
			            {	
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_salidas_maquinaria_venta_maquinaria').getElementsByTagName('tbody')[0];
							
							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcionCorta = objRenglon.insertCell(1);
							var objCeldaSerie = objRenglon.insertCell(2);
							var objCeldaMotor = objRenglon.insertCell(3);
							var objCeldaAcciones = objRenglon.insertCell(4);
							var objCeldaMaquinariaDescripcionID = objRenglon.insertCell(5);

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].componente_codigo); 
							objCeldaCodigo.setAttribute('class', 'movil b1');
							objCeldaCodigo.innerHTML = data.detalles[intCon].componente_codigo;
							objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
							objCeldaDescripcionCorta.innerHTML = data.detalles[intCon].componente_descripcion_corta;
							objCeldaSerie.setAttribute('class', 'movil b3');
							objCeldaSerie.innerHTML = data.detalles[intCon].componente_serie;
							objCeldaMotor.setAttribute('class', 'movil b4');
							objCeldaMotor.innerHTML = data.detalles[intCon].componente_motor;
							objCeldaAcciones.setAttribute('class', 'td-center movil b5');
							objCeldaAcciones.innerHTML = strAccionesTabla;
							objCeldaMaquinariaDescripcionID.setAttribute('class', 'no-mostrar');
							objCeldaMaquinariaDescripcionID.innerHTML = data.detalles[intCon].componente_maquinaria_descripcion_id;
			            }

			            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_salidas_maquinaria_venta_maquinaria tr").length - 1;
						$('#numElementos_componentes_salidas_maquinaria_venta_maquinaria').html(intFilas);
		       	    }

                }
                 ,
                'json');
	            
				//Dependiendo del estatus cambiar el color del encabezado 
	            $('#divEncabezadoModal_salidas_maquinaria_venta_maquinaria').addClass("estatus-"+ strEstatus);
	            //Mostrar botón Imprimir  
	            $("#btnImprimirRegistro_salidas_maquinaria_venta_maquinaria").show();

				//Si el tipo de acción corresponde a Ver
	            if(tipoAccion == 'Ver')
	            {
	            	//Deshabilitar todos los elementos del formulario
	            	$('#frmSalidasMaquinariaVentaMaquinaria').find('input, textarea, select').attr('disabled','disabled');
	            	//Ocultar los siguientes botones
	            	$("#btnReset_salidas_maquinaria_venta_maquinaria").hide();
		            $("#btnGuardar_salidas_maquinaria_venta_maquinaria").hide();
	            }
	            else
	            {
	            	//Si el estatus del registro es ACTIVO
		            if(strEstatus == 'ACTIVO')
		            {
		            	//Mostrar los siguientes botones
		            	$("#btnReset_salidas_maquinaria_venta_maquinaria").show();  
		            	$("#btnDesactivar_salidas_maquinaria_venta_maquinaria").show();
		            }
	            }

		 		//Abrir modal
		 		objSalidasMaquinariaVentaMaquinaria = $('#SalidasMaquinariaVentaMaquinariaBox').bPopup({
									   appendTo: '#SalidasMaquinariaVentaMaquinariaContent', 
		                               contentContainer: 'SalidasMaquinariaVentaMaquinariaM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});

	            //Enfocar caja de texto
				$('#txtFecha_salidas_maquinaria_venta_maquinaria').focus();	
       	    }   	    
       },
       'json');
	}

	//Función para cargar el reporte general en PDF
	function reporte_salidas_maquinaria_venta_maquinaria() 
	{
		//Asignar valores para la búsqueda de registros
		intProspectoIDFacturasMaquinariaMaquinaria =  $('#txtClienteIDBusq_salidas_maquinaria_venta_maquinaria').val();
		dteFechaInicialFacturasMaquinariaMaquinaria =  $.formatFechaMysql($('#txtFechaInicialBusq_salidas_maquinaria_venta_maquinaria').val());
		dteFechaFinalFacturasMaquinariaMaquinaria =  $.formatFechaMysql($('#txtFechaFinalBusq_salidas_maquinaria_venta_maquinaria').val());



		//Si no existe fecha inicial
		if(dteFechaInicialFacturasMaquinariaMaquinaria == '')
		{
			dteFechaInicialFacturasMaquinariaMaquinaria = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalFacturasMaquinariaMaquinaria == '')
		{
			dteFechaFinalFacturasMaquinariaMaquinaria =  '0000-00-00';
		}
		
		//Si no existe id del prospecto
		if(intProspectoIDFacturasMaquinariaMaquinaria == '')
		{
			intProspectoIDFacturasMaquinariaMaquinaria = 0;
		}

		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_salidas_maquinaria_venta_maquinaria').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_salidas_maquinaria_venta_maquinaria').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_salidas_maquinaria_venta_maquinaria').val('NO');
		}
		
		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("maquinaria/salidas_maquinaria_venta/get_reporte/"+
					dteFechaInicialFacturasMaquinariaMaquinaria+
					"/"+dteFechaFinalFacturasMaquinariaMaquinaria+
					"/"+intProspectoIDFacturasMaquinariaMaquinaria+
					"/"+$('#cmbEstatusBusq_salidas_maquinaria_venta_maquinaria').val()+
					"/"+$('#chbImprimirDetalles_salidas_maquinaria_venta_maquinaria').val()+
					"/"+$('#txtBusqueda_salidas_maquinaria_venta_maquinaria').val());
	}

	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_salidas_maquinaria_venta_maquinaria(id)
	{	
		//Variable que se utiliza para asignar id del registro
		var intMovimientoMaquinariaID = 0;
		
		//Dependiendo del tipo de formulario asignar id
		if(id == '')
			intMovimientoMaquinariaID = $('#txtMovimientoMaquinariaID_salidas_maquinaria_venta_maquinaria').val();
		else
			intMovimientoMaquinariaID = id;

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("maquinaria/salidas_maquinaria_venta/get_reporte_registro/" + intMovimientoMaquinariaID);
	}

	//Función para mostrar mensaje de éxito o error
	function mensaje_salidas_maquinaria_venta_maquinaria(tipoMensaje, mensaje)
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
	

	//Función para agregar Aditamentos del renglón seleccionado
	function ver_aditamentos_renglon_detalles_salidas_maquinaria_venta_maquinaria(objRenglon){

		var serie = objRenglon.parentNode.parentNode.cells[0].innerHTML; 
		var motor = objRenglon.parentNode.parentNode.cells[1].innerHTML; 
		var codigo = objRenglon.parentNode.parentNode.cells[2].innerHTML; 
		var descripcionCorta = objRenglon.parentNode.parentNode.cells[3].innerHTML;

		nuevo_aditamentos_salidas_maquinaria_venta_maquinaria(serie, motor, codigo, descripcionCorta);

	}

	//Función para descargar el archivo XLS
	function descargar_xls_salidas_maquinaria_venta_maquinaria() 
	{
		//Asignar valores para la búsqueda de registros
		var dteFechaInicialSalidasMaquinariaValidacionMaquinaria =  $.formatFechaMysql($('#txtFechaInicialBusq_salidas_maquinaria_venta_maquinaria').val());
		var dteFechaFinalSalidasMaquinariaValidacionMaquinaria =  $.formatFechaMysql($('#txtFechaFinalBusq_salidas_maquinaria_venta_maquinaria').val());
		//Si no existe fecha inicial
		if(dteFechaInicialSalidasMaquinariaValidacionMaquinaria == '')
		{
			dteFechaInicialSalidasMaquinariaValidacionMaquinaria = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalSalidasMaquinariaValidacionMaquinaria == '')
		{
			dteFechaFinalSalidasMaquinariaValidacionMaquinaria =  '0000-00-00';
		}
		//Si no existe id del cliente en busqueda
		if( $('#txtClienteIDBusq_salidas_maquinaria_venta_maquinaria').val() == '' || 
			$('#txtClienteBusq_salidas_maquinaria_venta_maquinaria').val() == ''
		  )
		{
			intClienteIDSalidasMaquinariaVentaMaquinaria = 0;
		}
		else{
			intClienteIDSalidasMaquinariaVentaMaquinaria = $('#txtClienteIDBusq_salidas_maquinaria_venta_maquinaria').val();
		}

		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_salidas_maquinaria_venta_maquinaria').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_salidas_maquinaria_venta_maquinaria').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_salidas_maquinaria_venta_maquinaria').val('NO');
		}		
		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("maquinaria/salidas_maquinaria_venta/get_xls/"+
					dteFechaInicialSalidasMaquinariaValidacionMaquinaria+"/"+
					dteFechaFinalSalidasMaquinariaValidacionMaquinaria+"/"+
					intClienteIDSalidasMaquinariaVentaMaquinaria+"/"+
					$('#cmbEstatusBusq_salidas_maquinaria_venta_maquinaria').val()+"/"+
					$('#chbImprimirDetalles_salidas_maquinaria_venta_maquinaria').val()+"/"+
					$('#txtBusqueda_salidas_maquinaria_venta_maquinaria').val());
	}

	/*******************************************************************************************************************
	Funciones del modal secundario
	*********************************************************************************************************************/
	//Agregar aditamentos a una maquinaria
	function nuevo_aditamentos_salidas_maquinaria_venta_maquinaria(serie, motor, codigo, descripcionCorta){

		inicializar_aditamentos_detalles_salidas_maquinaria_venta_maquinaria();
		
		//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
		$('#divEncabezadoModalSecundario_salidas_maquinaria_venta_maquinaria').addClass("estatus-NUEVO");
		//Abrir modal secundario
		 objAditamentosSalidasMaquinariaVentaMaquinaria = $('#AditamentosSalidasMaquinariaVentaMaquinariaBox').bPopup({
									   appendTo: '#SalidasMaquinariaVentaMaquinariaContent', 
		                               contentContainer: 'AditamentosSalidasMaquinariaVentaMaquinariaM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});
		
		//Asignar los valores que vienen del modal primario
		$('#txtCodigoAditamentos_salidas_maquinaria_venta_maquinaria').val( codigo ); 
		$('#txtDescripcionAditamentos_salidas_maquinaria_venta_maquinaria').val( descripcionCorta );
		$('#txtSerieAditamentos_salidas_maquinaria_venta_maquinaria').val( serie );
		$('#txtMotorAditamentos_salidas_maquinaria_venta_maquinaria').val( motor );

		//Consultar si la serie contiene aditamentos 
		//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
          $.post('maquinaria/salidas_maquinaria_proveedor/get_aditamentos',
              { 
              	strSerie: $("#txtSerieAditamentos_salidas_maquinaria_venta_maquinaria").val()
              },
              function(data) {

              	//Si se econtró información
                if(data){

                	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_aditamentos_detalles_salidas_maquinaria_venta_maquinaria').getElementsByTagName('tbody')[0];

                	for (var intCon in data) 
			        {
			        	//Insertamos el renglón con sus celdas en el objeto de la tabla
						var objRenglon = objTabla.insertRow();
						var objCeldaCantidad = objRenglon.insertCell(0);
						var objCeldaDescripcion = objRenglon.insertCell(1);
						
						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', data[intCon].renglon);
						objCeldaCantidad.setAttribute('class', 'movil b1');
						objCeldaCantidad.innerHTML = data[intCon].cantidad;
						objCeldaDescripcion.setAttribute('class', 'movil b2');
						objCeldaDescripcion.innerHTML = data[intCon].descripcion;
			        }

			        var intFilas = $("#dg_aditamentos_detalles_salidas_maquinaria_venta_maquinaria tr").length - 1;
					$('#numElementos_detalles_aditamentos_salidas_maquinaria_venta_maquinaria').html(intFilas);

                }
            }
             ,
            'json');

	}

	//Función que se utiliza para cerrar el modal secundario
	function cerrar_aditamentos_salidas_maquinaria_venta_maquinaria()
	{
		try {
			//Cerrar modal
			objAditamentosSalidasMaquinariaVentaMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtCodigo_detalles_salidas_maquinaria_venta_maquinaria').focus();	
		}
		catch(err) {}
	}

	//Función para inicializar elementos de la tabla detalles
	function inicializar_aditamentos_detalles_salidas_maquinaria_venta_maquinaria()
	{
		//Eliminar los datos de la tabla
		$('#dg_aditamentos_detalles_salidas_maquinaria_venta_maquinaria tbody').empty();
		$('#numElementos_detalles_aditamentos_salidas_maquinaria_venta_maquinaria').html(0);
	}


	//Al inicializar el componente
	$(document).ready(function() 
	{
		/********************************************************************************************************************
		Controles correspondientes al MODAL SECUNDARIO
		*********************************************************************************************************************/
        /********************************************************************************************************************
		Controles correspondientes al MODAL
		*********************************************************************************************************************/
        //Agregar datepicker para seleccionar fecha
		$('#dteFecha_salidas_maquinaria_venta_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFecha_salidas_maquinaria_venta_maquinaria').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

        //Autocomplete para recuperar los datos de una factura de maquinaria
        $('#txtFactura_salidas_maquinaria_venta_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtFacturaID_salidas_maquinaria_venta_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "maquinaria/facturas_maquinaria/autocomplete",
                 type: "post",
                 dataType: "json",
                 data: {
                   strDescripcion: request.term,
                   strTipo: ''
                 },
                 success: function( data ) {
                   response( data );
                 }
               });
           },
           select: function( event, ui ) {

           		//Limpiar los detalles del Grid para cargar la información correspondiente a la orden de compra
				$('#dg_detalles_salidas_maquinaria_venta_maquinaria tbody').empty();

           	    //Asignar id del registro seleccionado
           	    $('#txtFacturaID_salidas_maquinaria_venta_maquinaria').val(ui.item.data);
           	    $('#txtFactura_salidas_maquinaria_venta_maquinaria').val(ui.item.value); 

               
                //Cargar detalles del movimiento de entrada por compra de maquinaria para seleccionar que se desea devolver
                $.post('maquinaria/facturas_maquinaria/get_datos',
                { 
                  	intFacturaMaquinariaID: $('#txtFacturaID_salidas_maquinaria_venta_maquinaria').val()
                },
                  function(data) { 

                    //Cargar datos del registro
                    if(data.row){
                    	$('#txtCliente_salidas_maquinaria_venta_maquinaria').val(data.row.razon_social);
                    	$('#txtInventarioMaquinariaDescripcionID_salidas_maquinaria_venta_maquinaria').val(data.row.maquinaria_descripcion_id);
                    	$('#txtSerie_salidas_maquinaria_venta_maquinaria').val(data.row.serie);
                    	$('#txtMotor_salidas_maquinaria_venta_maquinaria').val(data.row.motor);
                    	$('#txtCodigo_salidas_maquinaria_venta_maquinaria').val(data.row.codigo);
                    	$('#txtDescripcionCorta_salidas_maquinaria_venta_maquinaria').val(data.row.descripcion_corta);
                    	$('#txtDescripcion_salidas_maquinaria_venta_maquinaria').val(data.row.descripcion);	
                    }

	                //Si la maquinaria es de tipo Compuesta
		       	    if(data.detalles)
		       	    {
		       	    	//Variable que se utiliza para asignar las acciones del grid view
				        var strAccionesTabla = '';

                    	//Mostramos los componentes que componen la maquinaria(En caso de que aplique)
						for (var intCon in data.detalles) 
			            {	
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_salidas_maquinaria_venta_maquinaria').getElementsByTagName('tbody')[0];
							
							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcionCorta = objRenglon.insertCell(1);
							var objCeldaSerie = objRenglon.insertCell(2);
							var objCeldaMotor = objRenglon.insertCell(3);
							var objCeldaAcciones = objRenglon.insertCell(4);
							var objCeldaMaquinariaDescripcionID = objRenglon.insertCell(5);

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].componente_codigo); 
							objCeldaCodigo.setAttribute('class', 'movil b1');
							objCeldaCodigo.innerHTML = data.detalles[intCon].componente_codigo;
							objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
							objCeldaDescripcionCorta.innerHTML = data.detalles[intCon].componente_descripcion_corta;
							objCeldaSerie.setAttribute('class', 'movil b3');
							objCeldaSerie.innerHTML = data.detalles[intCon].componente_serie;
							objCeldaMotor.setAttribute('class', 'movil b4');
							objCeldaMotor.innerHTML = data.detalles[intCon].componente_motor;
							objCeldaAcciones.setAttribute('class', 'td-center movil b5');
							objCeldaAcciones.innerHTML = strAccionesTabla;
							objCeldaMaquinariaDescripcionID.setAttribute('class', 'no-mostrar');
							objCeldaMaquinariaDescripcionID.innerHTML = data.detalles[intCon].componente_maquinaria_descripcion_id;
			            }

			            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_salidas_maquinaria_venta_maquinaria tr").length - 1;
						$('#numElementos_componentes_salidas_maquinaria_venta_maquinaria').html(intFilas);
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

	    //Abrir modal cuando se de clic en el botón
		$('#btnAditamentos_salidas_maquinaria_venta_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			if($('#txtSerie_detalles_salidas_maquinaria_venta_maquinaria').val() != ''){
				nuevo_aditamentos_salidas_maquinaria_venta_maquinaria('');
			}
				
		});

		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_salidas_maquinaria_venta_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_salidas_maquinaria_venta_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_salidas_maquinaria_venta_maquinaria').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_salidas_maquinaria_venta_maquinaria').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_salidas_maquinaria_venta_maquinaria').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_salidas_maquinaria_venta_maquinaria').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_salidas_maquinaria_venta_maquinaria').on('click','a',function(event){
			event.preventDefault();
			intPaginaSalidasMaquinariaVentaMaquinaria = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_salidas_maquinaria_venta_maquinaria();
		});

		//Autocomplete para recuperar los datos de un cliente 
        $('#txtClienteBusq_salidas_maquinaria_venta_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtClienteIDBusq_salidas_maquinaria_venta_maquinaria').val('');
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
           	  $('#txtClienteIDBusq_salidas_maquinaria_venta_maquinaria').val(ui.item.data); 
              //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
              $.post('cuentas_cobrar/clientes/get_datos',
                  { 
                  	intProspectoID: $("#txtClienteIDBusq_salidas_maquinaria_venta_maquinaria").val(),
                  	strTipo: 'id'
                  },
                  function(data) { 
                    if(data.row){ 
                    	$("#txtClienteIDBusq_salidas_maquinaria_venta_maquinaria").val(data.row.prospecto_id);
                    	$("#txtClienteBusq_salidas_maquinaria_venta_maquinaria").val(data.row.nombre_comercial);
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

        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_salidas_maquinaria_venta_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_salidas_maquinaria_venta_maquinaria('Nuevo');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_salidas_maquinaria_venta_maquinaria').addClass("estatus-NUEVO");
			//Abrir modal
			 objSalidasMaquinariaVentaMaquinaria = $('#SalidasMaquinariaVentaMaquinariaBox').bPopup({
										   appendTo: '#SalidasMaquinariaVentaMaquinariaContent', 
			                               contentContainer: 'SalidasMaquinariaVentaMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});
			
		});

        //
        $('#txtFechaInicialBusq_salidas_maquinaria_venta_maquinaria').focus();

  
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_salidas_maquinaria_venta_maquinaria();

	});

</script>