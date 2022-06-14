<div id="SalidaInsumosEventosMercadotecniaContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_salida_insumos_eventos_mercadotecnia" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_salida_insumos_eventos_mercadotecnia">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_salida_insumos_eventos_mercadotecnia'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_salida_insumos_eventos_mercadotecnia"
			                    		name= "strFechaInicialBusq_salida_insumos_eventos_mercadotecnia" 
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
							<label for="txtFechaFinalBusq_salida_insumos_eventos_mercadotecnia">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_salida_insumos_eventos_mercadotecnia'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_salida_insumos_eventos_mercadotecnia"
			                    		name= "strFechaFinalBusq_salida_insumos_eventos_mercadotecnia" 
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
				<!--Evento-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtEventoBusq_salida_insumos_eventos_mercadotecnia">Evento</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtEventoBusqID_salida_insumos_eventos_mercadotecnia" 
									name="strEventoBusqID_salida_insumos_eventos_mercadotecnia" 
									type="hidden" />
							<input  class="form-control" 
									id="txtEventoBusq_salida_insumos_eventos_mercadotecnia" 
									name="strEventoBusq_salida_insumos_eventos_mercadotecnia" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese evento" />
						</div>
					</div>
				</div>
				<!--Botones-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div id="ToolBtns" class="btn-group btn-toolBtns">
						<!-- Buscar registros -->
						<button class="btn btn-primary" id="btnBuscar_salida_insumos_eventos_mercadotecnia"
								onclick="paginacion_salida_insumos_eventos_mercadotecnia();" 
								title="Buscar coincidencias" tabindex="1"> 
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<!--Dar de alta un nuevo registro-->
						<button class="btn btn-info" id="btnNuevo_salida_insumos_eventos_mercadotecnia" 
								title="Nuevo registro" tabindex="1"> 
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>   
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_salida_insumos_eventos_mercadotecnia"
								onclick="reporte_salida_insumos_eventos_mercadotecnia();" title="Generar reporte PDF" tabindex="1">
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_salida_insumos_eventos_mercadotecnia"
								onclick="descargar_xls_salida_insumos_eventos_mercadotecnia();" title="Descargar archivo XLS" tabindex="1">
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
                        			id="chbImprimirDetalles_salida_insumos_eventos_mercadotecnia" 
								   	name="strImprimirDetalles_salida_insumos_eventos_mercadotecnia" 
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
			td.movil:nth-of-type(3):before {content: "Evento"; font-weight: bold;}
			td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
			td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_salida_insumos_eventos_mercadotecnia">
				<thead class="movil">
					<tr class="movil">
						<th class="movil">Folio</th>
						<th class="movil">Fecha</th>
						<th class="movil">Evento</th>
						<th class="movil">Estatus</th>
						<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
					</tr>
				</thead>
				<tbody class="movil"></tbody>
				<script id="plantilla_salida_insumos_eventos_mercadotecnia" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil">{{folio}}</td>
						<td class="movil">{{fecha}}</td>
						<td class="movil">{{evento}}</td>
						<td class="movil">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_salida_insumos_eventos_mercadotecnia({{movimiento_insumo_id}},'Editar')"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_salida_insumos_eventos_mercadotecnia({{movimiento_insumo_id}},'Ver')"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_salida_insumos_eventos_mercadotecnia({{movimiento_insumo_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_salida_insumos_eventos_mercadotecnia({{movimiento_insumo_id}},'{{estatus}}')" title="Desactivar">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<!--
							<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
									onclick="cambiar_estatus_salida_insumos_eventos_mercadotecnia({{movimiento_insumo_id}},'{{estatus}}')"  title="Restaurar">
								<span class="fa fa-exchange"></span>
							</button>
							-->
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_salida_insumos_eventos_mercadotecnia"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_salida_insumos_eventos_mercadotecnia">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!-- Diseño del modal-->
	<div id="SalidaInsumosEventosMercadotecniaBox" class="ModalBody">
		<!--Título-->
		<div id="divEncabezadoModal_salida_insumos_eventos_mercadotecnia"  class="ModalBodyTitle">
		<h1>Salidas de insumos a evento</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmSalidaInsumosEventosMercadotecnia" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmSalidaInsumosEventosMercadotecnia"  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!-- Folio -->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtSalidaInsumosEventosID_salida_insumos_eventos_mercadotecnia" 
									   name="intSalidaInsumosEventosID_salida_insumos_eventos_mercadotecnia" 
									   type="hidden" 
									   value="" />
								<input id="txtFolioID_salida_insumos_eventos_mercadotecnia" 
									   name="intFolioID_salida_insumos_eventos_mercadotecnia" 
									   type="hidden" 
									   value=""/>
								<label for="txtFolio_salida_insumos_eventos_mercadotecnia">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtFolio_salida_insumos_eventos_mercadotecnia" 
										name="strFolio_salida_insumos_eventos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Autogenerado" 
										disabled />
							</div>
						</div>
					</div>
					<!-- Fecha -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFecha_salida_insumos_eventos_mercadotecnia">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_salida_insumos_eventos_mercadotecnia'>
				                    <input class="form-control" 
				                    		id="txtFecha_salida_insumos_eventos_mercadotecnia"
				                    		name= "strFecha_salida_insumos_eventos_mercadotecnia" 
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
					<!-- Evento -->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtEventoID_salida_insumos_eventos_mercadotecnia" 
										name="intEventoID_salida_insumos_eventos_mercadotecnia" 
										type="hidden" />
								<label for="txtEvento_salida_insumos_eventos_mercadotecnia">
								Evento</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtEvento_salida_insumos_eventos_mercadotecnia" 
										name="strEvento_salida_insumos_eventos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese evento" 
										maxlength="50" />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Localidad -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtLocalidadID_salida_insumos_eventos_mercadotecnia" 
									   name="intLocalidadID_salida_insumos_eventos_mercadotecnia" 
									   type="hidden" 
									   value=""/>
								<label for="txtLocalidad_salida_insumos_eventos_mercadotecnia">Localidad</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtLocalidad_salida_insumos_eventos_mercadotecnia" 
										name="strLocalidad_salida_insumos_eventos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1" 
										disabled />
							</div>
						</div>
					</div>
					<!-- Municipio -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtMunicipioID_salida_insumos_eventos_mercadotecnia" 
									   name="intMunicipioID_salida_insumos_eventos_mercadotecnia" 
									   type="hidden" 
									   value=""/>
								<label for="txtMunicipio_salida_insumos_eventos_mercadotecnia">Municipio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMunicipio_salida_insumos_eventos_mercadotecnia" 
										name="strMunicipio_salida_insumos_eventos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1" 
										disabled />
							</div>
						</div>
					</div>
					<!-- Estado -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtEstadoID_salida_insumos_eventos_mercadotecnia" 
									   name="intEstadoID_salida_insumos_eventos_mercadotecnia" 
									   type="hidden" 
									   value=""/>
								<label for="txtEstado_salida_insumos_eventos_mercadotecnia">Estado</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtEstado_salida_insumos_eventos_mercadotecnia" 
										name="strEstado_salida_insumos_eventos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1"
										disabled />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Sucursal -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtSucursalID_salida_insumos_eventos_mercadotecnia" 
									   name="intSucursalID_salida_insumos_eventos_mercadotecnia" 
									   type="hidden" 
									   value=""/>
								<label for="txtSucursal_salida_insumos_eventos_mercadotecnia">Sucursal</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtSucursal_salida_insumos_eventos_mercadotecnia" 
										name="strSucursal_salida_insumos_eventos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1" />
							</div>
						</div>
					</div>
					<!-- Responsable -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtResponsableID_salida_insumos_eventos_mercadotecnia" 
									   name="intResponsableID_salida_insumos_eventos_mercadotecnia" 
									   type="hidden" 
									   value=""/>
								<label for="txtResponsable_salida_insumos_eventos_mercadotecnia">Responsable</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtResponsable_salida_insumos_eventos_mercadotecnia" 
										name="strResponsable_salida_insumos_eventos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1" />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Observaciones -->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtObservaciones_salida_insumos_eventos_mercadotecnia">Observaciones</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtObservaciones_salida_insumos_eventos_mercadotecnia" 
										name="strObservaciones_salida_insumos_eventos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1" maxlength="250" />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
								<input id="txtNumDetalles_salida_insumos_eventos_mercadotecnia" 
							   		name="intNumDetalles_salida_insumos_eventos_mercadotecnia" type="hidden" value="" />
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Detalles de la salida a evento</h4>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Insumo-->
													<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtInsumoID_detalles_salida_insumos_eventos_mercadotecnia" 
																		name="inttInsumoID_detalles_salida_insumos_eventos_mercadotecnia"
																		type="hidden" />
																<label for="txtInsumo_detalles_salida_insumos_eventos_mercadotecnia">
																	Insumo
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtInsumo_detalles_salida_insumos_eventos_mercadotecnia" 
																		name="strInsumo_detalles_salida_insumos_eventos_mercadotecnia" 
																		type="text" 
																		value="" 
																		tabindex="1" 
																		placeholder="Ingrese insumo" 
																		maxlength="250" />
															</div>
														</div>
													</div>
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_salida_insumos_eventos_mercadotecnia">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad" 
																		id="txtCantidad_detalles_salida_insumos_eventos_mercadotecnia" 
																		name="intCantidad_detalles_salida_insumos_eventos_mercadotecnia" 
																		type="text"
																		value="" 
																		tabindex="1"
																		placeholder="Ingrese cantidad" 
																		maxlength="14" />
															</div>
														</div>
													</div>
													<!--Costo-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCostoUnitario_detalles_salida_insumos_eventos_mercadotecnia">Costo</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_salida_insumos_eventos_mercadotecnia" 
																		id="txtCostoUnitario_detalles_salida_insumos_eventos_mercadotecnia" 
																		name="intCostoUnitario_detalles_salida_insumos_eventos_mercadotecnia" 
																		type="text" 
																		value="" 
																		tabindex="1"
																		disabled />
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-1">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_salida_insumos_eventos_mercadotecnia" 
					                                			onclick="agregar_renglon_detalles_salida_insumos_eventos_mercadotecnia();" 
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
													<table class="table-hover movil" id="dg_detalles_salida_insumos_eventos_mercadotecnia">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Insumo</th>
																<th class="movil">Cantidad</th>
																<th class="movil">Importe</th>
																<th class="movil">Subtotal</th>
																<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
														<tfoot class="movil">
															<tr class="movil">
																<td class="movil t1">
																	<strong>Total</strong>
																</td>
																<td  class="movil t2">
																	<strong id="acumCantidad_detalles_salida_insumos_eventos_mercadotecnia">0</strong>
																</td>
																<td class="movil t3">
																	<strong id="acumImporte_detalles_salida_insumos_eventos_mercadotecnia">$0.00</strong>
																</td>
																<td class="movil t4">
																	<strong id="acumSubtotal_detalles_salida_insumos_eventos_mercadotecnia">$0.00</strong>
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
																<strong id="numElementos_detalles_salida_insumos_eventos_mercadotecnia">0</strong> encontrados
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
						<button class="btn btn-info" id="btnReset_salida_insumos_eventos_mercadotecnia"  
								onclick="nuevo_salida_insumos_eventos_mercadotecnia();"  title="Nuevo registro" tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_salida_insumos_eventos_mercadotecnia"  
								onclick="validar_salida_insumos_eventos_mercadotecnia();"  title="Guardar" tabindex="2">
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_salida_insumos_eventos_mercadotecnia"  
								onclick="reporte_registro_salida_insumos_eventos_mercadotecnia('');"  
								title="Imprimir" tabindex="5">
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" id="btnDesactivar_salida_insumos_eventos_mercadotecnia"  
								onclick="cambiar_estatus_salida_insumos_eventos_mercadotecnia('','ACTIVO');"  title="Desactivar" tabindex="6">
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Restaurar registro-->
						<!--
						<button class="btn btn-default" id="btnRestaurar_movimientos_entradas_insumos_mercadotecnia"  
								onclick="cambiar_estatus_movimientos_entradas_insumos_mercadotecnia('','INACTIVO');"  title="Restaurar" tabindex="7">
							<span class="fa fa-exchange"></span>
						</button>
						--> 
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_salida_insumos_eventos_mercadotecnia"
								type="reset" aria-hidden="true" onclick="cerrar_salida_insumos_eventos_mercadotecnia();" 
								title="Cerrar"  tabindex="3">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>

			</form><!--Cierre del formulario-->	
		</div>
	</div>		

</div><!--#SalidaInsumosEventosMercadotecniaContent -->		

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">
	
	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variables que se utilizan para la paginación de registros
	var intPaginaSalidaInsumosEventosMercadotecnia = 0;
	var strUltimaBusquedaSalidaInsumosEventosMercadotecnia = "";
	//Variables que se utilizan para la búsqueda de registros
	var intEventoIDSalidaInsumosEventosMercadotecnia = "";
	var dteFechaInicialSalidaInsumosEventosMercadotecnia = "";
	var dteFechaFinalSalidaInsumosEventosMercadotecnia = "";
	//Variable que se utiliza para asignar objeto del modal
	var objSalidaInsumosEventosMercadotecnia = null;

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_salida_insumos_eventos_mercadotecnia()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('mercadotecnia/salida_insumos_eventos/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_salida_insumos_eventos_mercadotecnia').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosSalidaInsumosEventosMercadotecnia = data.row;
				//Separar la cadena 
				var arrPermisosSalidaInsumosEventosMercadotecnia = strPermisosSalidaInsumosEventosMercadotecnia.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosSalidaInsumosEventosMercadotecnia.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosSalidaInsumosEventosMercadotecnia[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_salida_insumos_eventos_mercadotecnia').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosSalidaInsumosEventosMercadotecnia[i]=='GUARDAR') || (arrPermisosSalidaInsumosEventosMercadotecnia[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_salida_insumos_eventos_mercadotecnia').removeAttr('disabled');
					}
					else if(arrPermisosSalidaInsumosEventosMercadotecnia[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_salida_insumos_eventos_mercadotecnia').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_salida_insumos_eventos_mercadotecnia();
					}
					else if(arrPermisosSalidaInsumosEventosMercadotecnia[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_salida_insumos_eventos_mercadotecnia').removeAttr('disabled');
						$('#btnRestaurar_salida_insumos_eventos_mercadotecnia').removeAttr('disabled');
					}
					else if(arrPermisosSalidaInsumosEventosMercadotecnia[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_salida_insumos_eventos_mercadotecnia').removeAttr('disabled');
					}
					else if(arrPermisosSalidaInsumosEventosMercadotecnia[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_salida_insumos_eventos_mercadotecnia').removeAttr('disabled');
					}
					else if(arrPermisosSalidaInsumosEventosMercadotecnia[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_salida_insumos_eventos_mercadotecnia').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_salida_insumos_eventos_mercadotecnia() 
	{
		//Asignar valores para la búsqueda de registros
		var dteFechaInicialSalidaInsumosEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicialBusq_salida_insumos_eventos_mercadotecnia').val());
		var dteFechaFinalSalidaInsumosEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinalBusq_salida_insumos_eventos_mercadotecnia').val());
		//var intProveedorIDSalidaInsumosEventosMercadotecnia = $('#txtProveedorBusqID_salida_insumos_eventos_mercadotecnia').val();
		//Si no existe fecha inicial
		if(dteFechaInicialSalidaInsumosEventosMercadotecnia == '')
		{
			dteFechaInicialSalidaInsumosEventosMercadotecnia = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalSalidaInsumosEventosMercadotecnia == '')
		{
			dteFechaFinalSalidaInsumosEventosMercadotecnia =  '0000-00-00';
		}
		//Si no existe id del evento en busqueda
		if( $('#txtEventoBusqID_salida_insumos_eventos_mercadotecnia').val() == '' || 
			$('#txtEventoBusq_salida_insumos_eventos_mercadotecnia').val() == ''
		  )
		{
			intEventoIDSalidaInsumosEventosMercadotecnia = 0;
		}
		else{
			intEventoIDSalidaInsumosEventosMercadotecnia = $('#txtEventoBusqID_salida_insumos_eventos_mercadotecnia').val();
		}
		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('mercadotecnia/salida_insumos_eventos/get_paginacion',
				{	dteFechaInicial: dteFechaInicialSalidaInsumosEventosMercadotecnia,
	    			dteFechaFinal: dteFechaFinalSalidaInsumosEventosMercadotecnia,
	    			intEventoID: intEventoIDSalidaInsumosEventosMercadotecnia,
					intTipoMovimiento: 11,
					intPagina:intPaginaSalidaInsumosEventosMercadotecnia,
					strPermisosAcceso: $('#txtAcciones_salida_insumos_eventos_mercadotecnia').val()
				},
				function(data){
					$('#dg_salida_insumos_eventos_mercadotecnia tbody').empty();
					var tmpSalidaInsumosEventosMercadotecnia = Mustache.render($('#plantilla_salida_insumos_eventos_mercadotecnia').html(),data);
					$('#dg_salida_insumos_eventos_mercadotecnia tbody').html(tmpSalidaInsumosEventosMercadotecnia);
					$('#pagLinks_salida_insumos_eventos_mercadotecnia').html(data.paginacion);
					$('#numElementos_salida_insumos_eventos_mercadotecnia').html(data.total_rows);
					intPaginaSalidaInsumosEventosMercadotecnia = data.pagina;
				},
		'json');
	}

	//Función para cargar el reporte general en PDF
	function reporte_salida_insumos_eventos_mercadotecnia() 
	{
		//Asignar valores para la búsqueda de registros
		intEventoIDSalidaInsumosEventosMercadotecnia =  $('#txtEventoBusqID_salida_insumos_eventos_mercadotecnia').val();
		dteFechaInicialSalidaInsumosEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicialBusq_salida_insumos_eventos_mercadotecnia').val());
		dteFechaFinalSalidaInsumosEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinalBusq_salida_insumos_eventos_mercadotecnia').val());

		//Si no existe fecha inicial
		if(dteFechaInicialSalidaInsumosEventosMercadotecnia == '')
		{
			dteFechaInicialSalidaInsumosEventosMercadotecnia = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalSalidaInsumosEventosMercadotecnia == '')
		{
			dteFechaFinalSalidaInsumosEventosMercadotecnia =  '0000-00-00';
		}
		
		//Si no existe id del proveedor
		if(intEventoIDSalidaInsumosEventosMercadotecnia == '')
		{
			intEventoIDSalidaInsumosEventosMercadotecnia = 0;
		}


		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_salida_insumos_eventos_mercadotecnia').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_salida_insumos_eventos_mercadotecnia').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_salida_insumos_eventos_mercadotecnia').val('NO');
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("mercadotecnia/salida_insumos_eventos/get_reporte/"+dteFechaInicialSalidaInsumosEventosMercadotecnia+"/"
			+dteFechaFinalSalidaInsumosEventosMercadotecnia+"/"
			+intEventoIDSalidaInsumosEventosMercadotecnia+"/"
			+$('#chbImprimirDetalles_salida_insumos_eventos_mercadotecnia').val());
	}

	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_salida_insumos_eventos_mercadotecnia(id)
	{	

		//Variable que se utiliza para asignar id de la encuesta
		var intSalidaInsumosEventosID = 0;
		
		//Dependiendo del tipo de formulario asignar id
		if(id == '')
			intSalidaInsumosEventosID = $('#txtSalidaInsumosEventosID_salida_insumos_eventos_mercadotecnia').val();
		else
			intSalidaInsumosEventosID = id;

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("mercadotecnia/salida_insumos_eventos/get_reporte_registro/" + intSalidaInsumosEventosID);
	}

	//Función para descargar el archivo XLS
	function descargar_xls_salida_insumos_eventos_mercadotecnia() 
	{
		//Asignar valores para la búsqueda de registros
		intEventoIDSalidaInsumosEventosMercadotecnia =  $('#txtEventoBusqID_salida_insumos_eventos_mercadotecnia').val();
		dteFechaInicialSalidaInsumosEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicialBusq_salida_insumos_eventos_mercadotecnia').val());
		dteFechaFinalSalidaInsumosEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinalBusq_salida_insumos_eventos_mercadotecnia').val());

		//Si no existe fecha inicial
		if(dteFechaInicialSalidaInsumosEventosMercadotecnia == '')
		{
			dteFechaInicialSalidaInsumosEventosMercadotecnia = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalSalidaInsumosEventosMercadotecnia == '')
		{
			dteFechaFinalSalidaInsumosEventosMercadotecnia =  '0000-00-00';
		}
		
		//Si no existe id del proveedor
		if(intEventoIDSalidaInsumosEventosMercadotecnia == '')
		{
			intEventoIDSalidaInsumosEventosMercadotecnia = 0;
		}


		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_salida_insumos_eventos_mercadotecnia').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_salida_insumos_eventos_mercadotecnia').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_salida_insumos_eventos_mercadotecnia').val('NO');
		}

		//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
     	window.open("mercadotecnia/salida_insumos_eventos/get_xls/"+dteFechaInicialSalidaInsumosEventosMercadotecnia+"/"
			+dteFechaFinalSalidaInsumosEventosMercadotecnia+"/"
			+intEventoIDSalidaInsumosEventosMercadotecnia+"/"
			+$('#chbImprimirDetalles_salida_insumos_eventos_mercadotecnia').val());
	}

	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_salida_insumos_eventos_mercadotecnia()
	{
		//Incializar formulario
		$('#frmSalidaInsumosEventosMercadotecnia')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_salida_insumos_eventos_mercadotecnia();
		//Limpiar cajas de texto ocultas
		$('#frmSalidaInsumosEventosMercadotecnia').find('input[type=hidden]').val('');
	
		//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
		$('#divEncabezadoModal_salida_insumos_eventos_mercadotecnia').removeClass("estatus-NUEVO");
		$('#divEncabezadoModal_salida_insumos_eventos_mercadotecnia').removeClass("estatus-ACTIVO");
		$('#divEncabezadoModal_salida_insumos_eventos_mercadotecnia').removeClass("estatus-INACTIVO");

		/******************************************************************
		* INICIALIZACIÓN DE ELEMENTOS - ESTADO DEFAULT
		*******************************************************************/	
		//Folio
		$('#txtFolio_salida_insumos_eventos_mercadotecnia').val('');
		//Asignar la fecha actual
		$('#txtFecha_salida_insumos_eventos_mercadotecnia').val(fechaActual()); 
		//Evento
		$('#txtEvento_salida_insumos_eventos_mercadotecnia').val('');
		$('#txtEvento_salida_insumos_eventos_mercadotecnia').attr('disabled', false);

		//Eliminar los datos de la tabla detalles de la salida de insumos a evento
	    //Botón para agregar detalles
	    $('#btnAgregar_salida_insumos_eventos_mercadotecnia').attr('disabled', false);
	    //Datagrid detalles
	    $('#dg_detalles_salida_insumos_eventos_mercadotecnia tbody').empty();
	    $('#acumCantidad_detalles_salida_insumos_eventos_mercadotecnia').html(0);
	    $('#acumSubtotal_detalles_salida_insumos_eventos_mercadotecnia').html('$0.00');
	    $('#acumTotal_detalles_salida_insumos_eventos_mercadotecnia').html('$0.00');
		$('#numElementos_detalles_salida_insumos_eventos_mercadotecnia').html(0);

		//Mostrar botón Guardar
		$("#btnGuardar_salida_insumos_eventos_mercadotecnia").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_salida_insumos_eventos_mercadotecnia").hide();
		$("#btnDesactivar_salida_insumos_eventos_mercadotecnia").hide();
		$("#btnRestaurar_salida_insumos_eventos_mercadotecnia").hide();
			
	}

	//Función para mostrar mensaje de éxito o error
	function mensaje_salida_insumos_eventos_mercadotecnia(tipoMensaje, mensaje)
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

	//Función que se utiliza para cerrar el modal
	function cerrar_salida_insumos_eventos_mercadotecnia()
	{
		try {
			//Cerrar modal
			objSalidaInsumosEventosMercadotecnia.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_salida_insumos_eventos_mercadotecnia').focus();
		}
		catch(err) {}
	}

   
    //Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_salida_insumos_eventos_mercadotecnia()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_salida_insumos_eventos_mercadotecnia();
		//Validación del formulario de campos obligatorios
		$('#frmSalidaInsumosEventosMercadotecnia')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_salida_insumos_eventos_mercadotecnia: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intEventoID_salida_insumos_eventos_mercadotecnia: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtEventoID_salida_insumos_eventos_mercadotecnia').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un evento existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intSucursalID_salida_insumos_eventos_mercadotecnia: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtSucursalID_salida_insumos_eventos_mercadotecnia').val() === '')
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
										intResponsableID_salida_insumos_eventos_mercadotecnia: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtResponsableID_salida_insumos_eventos_mercadotecnia').val() === '')
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
										intNumDetalles_salida_insumos_eventos_mercadotecnia: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta salida de insumos a evento.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
									    strObservaciones_salida_insumos_eventos_mercadotecnia: {
									        excluded: true  // Ignorar (no valida el campo)    
									    },
									    strInsumo_detalles_salida_insumos_eventos_mercadotecnia: {
									        excluded: true  // Ignorar (no valida el campo)    
									    },
									    intCantidad_detalles_salida_insumos_eventos_mercadotecnia: {
									        excluded: true  // Ignorar (no valida el campo)    
									    },
									    intCostoUnitario_detalles_salida_insumos_eventos_mercadotecnia: {
									        excluded: true  // Ignorar (no valida el campo)    
									    }
									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_salida_insumos_eventos_mercadotecnia = $('#frmSalidaInsumosEventosMercadotecnia').data('bootstrapValidator');
		bootstrapValidator_salida_insumos_eventos_mercadotecnia.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_salida_insumos_eventos_mercadotecnia.isValid())
		{

			guardar_salida_insumos_eventos_mercadotecnia();
			
		}
		else 
			return;
	}

    //Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_salida_insumos_eventos_mercadotecnia()
	{
		try
		{
			$('#frmSalidaInsumosEventosMercadotecnia').data('bootstrapValidator').resetForm();

		}
		catch(err) {}
	}

	//Función para guardar o modificar los datos de un registro
	function guardar_salida_insumos_eventos_mercadotecnia()
	{
		
		//Obtenemos el objeto de la tabla detalles
		var objTabla = document.getElementById('dg_detalles_salida_insumos_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

		//Inicializamos las variables que obtendrán los datos de la tabla
		var arrInsumoID = [];
		var arrCantidades = [];
		var arrPreciosUnitarios = [];
		
		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{	
			//Variable que se utilizan para asignar valores del detalle
			var intCantidad = objRen.cells[1].innerHTML;
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			var intPrecioUnitario = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
			
			arrInsumoID.push(objRen.getAttribute('id'));
			arrCantidades.push(intCantidad);
			arrPreciosUnitarios.push(intPrecioUnitario);
		}

	   //Hacer un llamado al método del controlador para regresar los datos del registro
	   $.post('mercadotecnia/salida_insumos_eventos/verificar_salida',
       {
       		intMovimientoInsumoID:$('#txtSalidaInsumosEventosID_salida_insumos_eventos_mercadotecnia').val()
       },
       function(data) {

       		if(data.row != null){
       			
       			//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_salida_insumos_eventos_mercadotecnia('error', 'Este movimiento no puede ser editado. Ya que contiene devoluciones por parte de una entrada de insumos después de evento');
       		}
       		else{
       			
       			//Hacer un llamado al método del controlador para guardar los datos del registro
				$.post('mercadotecnia/salida_insumos_eventos/guardar',
						{ 
							//Datos de la entrada por compra
							intSalidaInsumosEventosID: $('#txtSalidaInsumosEventosID_salida_insumos_eventos_mercadotecnia').val(),
							strFolioConsecutivo: $('#txtFolio_salida_insumos_eventos_mercadotecnia').val(),
							//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
							dteFecha: $.formatFechaMysql($('#txtFecha_salida_insumos_eventos_mercadotecnia').val()),
							intEventoID: $('#txtEventoID_salida_insumos_eventos_mercadotecnia').val(),
							intSucursalID: $('#txtSucursalID_salida_insumos_eventos_mercadotecnia').val(),
							intEmpleadoID: $('#txtResponsableID_salida_insumos_eventos_mercadotecnia').val(),
							strObservaciones: $('#txtObservaciones_salida_insumos_eventos_mercadotecnia').val(),
							intProcesoMenuID: $('#txtProcesoMenuID_salida_insumos_eventos_mercadotecnia').val(),
							//Datos de los detalles
							strInsumoID: arrInsumoID.join('|'), 
							strCantidades: arrCantidades.join('|'),
							strPreciosUnitarios: arrPreciosUnitarios.join('|')
						},
						function(data) {

							if (data.resultado)
							{	
			                    //Hacer un llamado a la función para cerrar modal e inicializar objeto bootstrapValidator
			                    cerrar_salida_insumos_eventos_mercadotecnia();
			                    //Hacer llamado a la función  para cargar  los registros en el grid
				               	paginacion_salida_insumos_eventos_mercadotecnia();   
			                    //Si no existe id de la salida de insumos a evento, significa que es un nuevo registro   
								if($('#txtSalidaInsumosEventosID_salida_insumos_eventos_mercadotecnia').val() == '')
								{
								  	//Asignar el id de la orden de compra registrada en la base de datos
		                 			$('#txtSalidaInsumosEventosID_salida_insumos_eventos_mercadotecnia').val(data.salida_insumos_eventos_id);
		                 			//Asignar folio consecutivo
		                 			$('#txtFolio_salida_insumos_eventos_mercadotecnia').val(data.folio);
								} 	    
							}

							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_salida_insumos_eventos_mercadotecnia(data.tipo_mensaje, data.mensaje);

						},
				'json');

       		}

       },
       'json');

		

	}

	// Función para cambiar el estatus del registro seleccionado
	function cambiar_estatus_salida_insumos_eventos_mercadotecnia(id, estatus)
	{

		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtSalidaInsumosEventosID_salida_insumos_eventos_mercadotecnia').val();

		}
		else
		{
			intID = id;
		}

		//Hacer un llamado al método del controlador para regresar los datos del registro
	    $.post('mercadotecnia/salida_insumos_eventos/verificar_salida',
        {
       		intMovimientoInsumoID:intID
        },
        function(data) {

       		if(data.row != null){
       			
       			//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_salida_insumos_eventos_mercadotecnia('error', 'Este movimiento no puede ser editado. Ya que contiene devoluciones por parte de una entrada de insumos después de evento');
       		}
       		else{

       			//Si el estatus del registro es ACTIVO
			    if(estatus == 'ACTIVO')
			    {
					//Preguntar al usuario si desea desactivar el registro
					new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
							             {'type':     'question',
							              'title':    'Salida de Insumos a evento',
							              'buttons':  ['Aceptar', 'Cancelar'],
							              'onClose':  function(caption) {
							                            if(caption == 'Aceptar')
							                            {
							                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
							                              $.post('mercadotecnia/salida_insumos_eventos/set_estatus',
							                                     {
							                                     	intSalidaInsumosEventosID: intID,
							                                      	strEstatus: estatus
							                                     },
							                                     function(data) {
							                                        if(data.resultado)
							                                        {
							                                            //Hacer llamado a la función  para cargar  los registros en el grid
							                                            paginacion_salida_insumos_eventos_mercadotecnia();
							                                            //Si el id del registro se obtuvo del modal
																		if(id == '')
																		{
																			//Hacer un llamado a la función para cerrar modal
																			cerrar_salida_insumos_eventos_mercadotecnia();     
																		}
							                                        }
							                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							                                        mensaje_salida_insumos_eventos_mercadotecnia(data.tipo_mensaje, data.mensaje);
							                                     },
							                                    'json');
							                            }
							                          }
							              });
			    }
			    else//Si el estatus del registro es INACTIVO
			    {
					//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
					$.post('mercadotecnia/salida_insumos_eventos/set_estatus',
					     {
					     	intSalidaInsumosEventosID: intID,
					      	strEstatus: estatus
					     },
					     function(data) {
					      if (data.resultado)
					      {
					        //Hacer llamado a la función para cargar  los registros en el grid
					      	paginacion_salida_insumos_eventos_mercadotecnia();
					      	//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_salida_insumos_eventos_mercadotecnia();     
							}
					      }
					      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					        mensaje_salida_insumos_eventos_mercadotecnia(data.tipo_mensaje, data.mensaje);
					     },
					     'json');
			    }

       		}
       	},
		'json');	
	    
	}

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_salida_insumos_eventos_mercadotecnia(id, tipoAccion)
	{	
	
	   //Hacer un llamado al método del controlador para regresar los datos del registro
	   $.post('mercadotecnia/salida_insumos_eventos/get_datos',
       {
       		intMovimientoInsumoID:id
       },
       function(data) {
       
        	//Si hay datos del registro
            if(data.row)
            {

            	//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_salida_insumos_eventos_mercadotecnia();
				//Asignar estatus del registro
				var strEstatus = data.row.estatus;
	          	
	            //Recuperar valores
	            $('#txtSalidaInsumosEventosID_salida_insumos_eventos_mercadotecnia').val(data.row.movimiento_insumo_id);
	            $('#txtFolio_salida_insumos_eventos_mercadotecnia').val(data.row.folio);
	            $('#txtFecha_salida_insumos_eventos_mercadotecnia').val(data.row.fecha);
	            $('#txtEventoID_salida_insumos_eventos_mercadotecnia').val(data.row.evento_id);
	            $('#txtEvento_salida_insumos_eventos_mercadotecnia').val(data.row.evento);
	            
	            //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('mercadotecnia/eventos/get_datos',
                  { 
                  	intEventoID:$("#txtEventoID_salida_insumos_eventos_mercadotecnia").val()
                  },
                  function(data2) {
                    if(data2.row){
                       
                       $("#txtLocalidadID_salida_insumos_eventos_mercadotecnia").val(data2.row.localidad_id);

                       $.post('crm/localidades/get_datos',
		                { 
		                  	strBusqueda:$("#txtLocalidadID_salida_insumos_eventos_mercadotecnia").val(),
				       		strTipo: 'id'
		                },
		                function(data3) {
		                    if(data3.row){

		                       $("#txtLocalidad_salida_insumos_eventos_mercadotecnia").val(data3.row.localidad);
		                       $("#txtMunicipioID_salida_insumos_eventos_mercadotecnia").val(data3.row.municipio_id);
		                       $("#txtMunicipio_salida_insumos_eventos_mercadotecnia").val(data3.row.municipio);
		                       $("#txtEstadoID_salida_insumos_eventos_mercadotecnia").val(data3.row.estado_id);
		                       $("#txtEstado_salida_insumos_eventos_mercadotecnia").val(data3.row.estado);
		                       
		                    }
		                }
		                 ,
		                'json');
                    }
                  }
                 ,
                'json');

	            $('#txtSucursalID_salida_insumos_eventos_mercadotecnia').val(data.row.sucursal_id);
	            $('#txtSucursal_salida_insumos_eventos_mercadotecnia').val(data.row.sucursal);
	            $('#txtResponsableID_salida_insumos_eventos_mercadotecnia').val(data.row.empleado_id);
	            $('#txtResponsable_salida_insumos_eventos_mercadotecnia').val(data.row.empleado);
	            $('#txtObservaciones_salida_insumos_eventos_mercadotecnia').val(data.row.observaciones);
	            
	            //Mostramos los detalles del registro
	           	for (var intCon in data.detalles) 
	            {
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_detalles_salida_insumos_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaInsumo = objRenglon.insertCell(0);
					var objCeldaCantidad = objRenglon.insertCell(1);
					var objCeldaImporte = objRenglon.insertCell(2);
					var objCeldaSubtotal = objRenglon.insertCell(3);
					var objCeldaAcciones = objRenglon.insertCell(4);

					//Variables que se utilizan para asignar valores del detalle
					var intInsumo = data.detalles[intCon].insumo_id;
					var strInsumo = data.detalles[intCon].descripcion;
					var intImporte = parseFloat(data.detalles[intCon].precio_unitario);
					var intCantidad =  parseFloat(data.detalles[intCon].cantidad);
					
					var intSubtotal = 0;

					//Calcular subtotal
					intSubtotal = intCantidad * intImporte;
					
					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intInsumo);
					objCeldaInsumo.setAttribute('class', 'movil b1');
					objCeldaInsumo.innerHTML = strInsumo;
					objCeldaCantidad.setAttribute('class', 'movil b2');
					objCeldaCantidad.innerHTML = formatMoney(intCantidad, 2, '');
					objCeldaImporte.setAttribute('class', 'movil b3');
					objCeldaImporte.innerHTML = formatMoney(intImporte, 6, '');
					objCeldaSubtotal.setAttribute('class', 'movil b4');
					objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 6, '');
					objCeldaAcciones.setAttribute('class', 'td-center movil b5');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_salida_insumos_eventos_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_salida_insumos_eventos_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

	            }

	            //Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_salida_insumos_eventos_mercadotecnia();
				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_salida_insumos_eventos_mercadotecnia tr").length - 2;
				$('#numElementos_detalles_salida_insumos_eventos_mercadotecnia').html(intFilas);
				$('#txtNumDetalles_salida_insumos_eventos_mercadotecnia').val(intFilas);
	            
	            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
	            $('#divEncabezadoModal_salida_insumos_eventos_mercadotecnia').addClass("estatus-"+strEstatus);
	            //Mostrar botón Imprimir  
	            $("#btnImprimirRegistro_salida_insumos_eventos_mercadotecnia").show();
	           	
				//Si el tipo de acción corresponde a Ver
	            if(tipoAccion == 'Ver')
	            {
	            	//Deshabilitar todos los elementos del formulario
	            	$('#frmSalidaInsumosEventosMercadotecnia').find('input, textarea, select').attr('disabled','disabled');
	            	//Ocultar botón Guardar
		            $("#btnGuardar_salida_insumos_eventos_mercadotecnia").hide();

		            //Si el estatus del registro es INACTIVO
	            	if(strEstatus == 'INACTIVO')
	            	{
	            		//Mostrar botón Restaurar
	            		$("#btnRestaurar_salida_insumos_eventos_mercadotecnia").show();
	            	}

	            }
	            else
	            {
	            	//Si el estatus del registro es ACTIVO
		            if(strEstatus == 'ACTIVO')
		            {
		            	//Mostrar los siguientes botones  
		            	$("#btnDesactivar_salida_insumos_eventos_mercadotecnia").show();
		            }
	            }
				
				//Abrir modal
				 objSalidaInsumosEventosMercadotecnia = $('#SalidaInsumosEventosMercadotecniaBox').bPopup({
											   appendTo: '#SalidaInsumosEventosMercadotecniaContent', 
				                               contentContainer: 'SalidaInsumosEventosMercadotecniaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

	            //Enfocar caja de texto
				$('#txtFecha_salida_insumos_eventos_mercadotecnia').focus();
		       
		        
       	    }
       },
       'json');
				
	}

	/*******************************************************************************************************************
	Funciones de la tabla detalles
	*********************************************************************************************************************/
	//Función para agregar renglón a la tabla
	function agregar_renglon_detalles_salida_insumos_eventos_mercadotecnia()
	{
		//Variable que se utiliza para asignar el importe (importe en la tabla movimientos_insumos_detalles)
		var intImporte = 0;
		//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla movimientos_insumos_detalles)
		var intSubtotal = 0;
		//Obtenemos los datos de las cajas de texto
		var intInsumo = $('#txtInsumoID_detalles_salida_insumos_eventos_mercadotecnia').val();
		var strInsumo = $('#txtInsumo_detalles_salida_insumos_eventos_mercadotecnia').val();
		var intCantidad = $('#txtCantidad_detalles_salida_insumos_eventos_mercadotecnia').val();
		//Hacer un llamado a la función para reemplazar ',' por cadena vacia
		intImporte = $.reemplazar($('#txtCostoUnitario_detalles_salida_insumos_eventos_mercadotecnia').val(), ",", "");
		
		//Obtenemos el objeto de la tabla
		var objTabla = document.getElementById('dg_detalles_salida_insumos_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

		//Validamos que se capturaron datos
		if (intInsumo == '' || strInsumo == '')
		{
			//Enfocar caja de texto
			$('#txtInsumo_detalles_salida_insumos_eventos_mercadotecnia').focus();
		}
		else if (intCantidad == '')
		{
			//Enfocar caja de texto
			$('#txtCantidad_detalles_salida_insumos_eventos_mercadotecnia').focus();
		}
		else if (intImporte == '')
		{
			//Enfocar caja de texto
			$('#txtInsumo_detalles_salida_insumos_eventos_mercadotecnia').focus();
		}
		else
		{
			//Limpiamos las cajas de texto
			$('#txtInsumo_detalles_salida_insumos_eventos_mercadotecnia').val('');
			$('#txtCantidad_detalles_salida_insumos_eventos_mercadotecnia').val('');
		    $('#txtCostoUnitario_detalles_salida_insumos_eventos_mercadotecnia').val('');
	
			//Utilizar toUpperCase() para cambiar texto a mayúsculas
			strInsumo = strInsumo.toUpperCase();

			//Calcular subtotal
			intSubtotal = intCantidad * intImporte;

			//Revisamos si existe la descripción proporcionada, si es así, editamos los datos
			if (objTabla.rows.namedItem(strInsumo))
			{
				objTabla.rows.namedItem(strInsumo).cells[1].innerHTML = intCantidad;
				objTabla.rows.namedItem(strInsumo).cells[2].innerHTML = formatMoney(intImporte, 6, '');
				objTabla.rows.namedItem(strInsumo).cells[3].innerHTML =  formatMoney(intSubtotal, 6, '');
			}
			else
			{
				//Validamos que exista el insumo en el catalogo de Insumos
				if(intInsumo != ''){

					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaInsumo = objRenglon.insertCell(0);
					var objCeldaCantidad = objRenglon.insertCell(1);
					var objCeldaImporte = objRenglon.insertCell(2);
					var objCeldaSubtotal = objRenglon.insertCell(3);
					var objCeldaAcciones = objRenglon.insertCell(4);
					
					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intInsumo);
					objCeldaInsumo.setAttribute('class', 'movil b1');
					objCeldaInsumo.innerHTML = strInsumo;
					objCeldaCantidad.setAttribute('class', 'movil b2');
					objCeldaCantidad.innerHTML = formatMoney(intCantidad, 2, '');
					objCeldaImporte.setAttribute('class', 'movil b3');
					objCeldaImporte.innerHTML = formatMoney(intImporte, 6, '');
					objCeldaSubtotal.setAttribute('class', 'movil b4');
					objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 6, '');
					objCeldaAcciones.setAttribute('class', 'td-center movil b5');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_salida_insumos_eventos_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_salida_insumos_eventos_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

				}
				else{

					mensaje_salida_insumos_eventos_mercadotecnia('error', 'El insumo no se encuentra registrado en el catálogo');
					
				}

				

			}

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_salida_insumos_eventos_mercadotecnia();
			
			//Enfocar caja de texto
			$('#txtInsumo_detalles_salida_insumos_eventos_mercadotecnia').focus();
		}

		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_detalles_salida_insumos_eventos_mercadotecnia tr").length - 2;
		$('#numElementos_detalles_salida_insumos_eventos_mercadotecnia').html(intFilas);
		$('#txtNumDetalles_salida_insumos_eventos_mercadotecnia').val(intFilas);
	}

	//Función para regresar los datos (al formulario) del renglón seleccionado
	function editar_renglon_detalles_salida_insumos_eventos_mercadotecnia(objRenglon)
	{
		//Asignar los valores a las cajas de texto
		$('#txtInsumoID_detalles_salida_insumos_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[5].innerHTML);
		$('#txtInsumo_detalles_salida_insumos_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
		$('#txtCantidad_detalles_salida_insumos_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
		$('#txtCostoUnitario_detalles_salida_insumos_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
		//Enfocar caja de texto
		$('#txtInsumo_detalles_salida_insumos_eventos_mercadotecnia').focus();
	}

	//Función para quitar renglón de la tabla
	function eliminar_renglon_detalles_salida_insumos_eventos_mercadotecnia(objRenglon)
	{
		//Obtener el indice del objeto renglón que se envía
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
		
		//Eliminar el renglón indicado
		document.getElementById("dg_detalles_salida_insumos_eventos_mercadotecnia").deleteRow(intRenglon);

		//Hacer un llamado a la función para calcular totales de la tabla
		calcular_totales_detalles_salida_insumos_eventos_mercadotecnia();
		
		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_detalles_salida_insumos_eventos_mercadotecnia tr").length - 2;
		$('#numElementos_detalles_salida_insumos_eventos_mercadotecnia').html(intFilas);
		$('#txtNumDetalles_salida_insumos_eventos_mercadotecnia').val(intFilas);

		//Enfocar caja de texto
		$('#txtInsumo_detalles_salida_insumos_eventos_mercadotecnia').focus();
	}


	//Función para calcular totales de la tabla
	function calcular_totales_detalles_salida_insumos_eventos_mercadotecnia()
	{
		//Obtenemos el objeto de la tabla 
		var objTabla = document.getElementById('dg_detalles_salida_insumos_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

		//Inicializamos las variables que se utilizan para los acumulados
		var intAcumCantidad = 0;
		var intAcumImporte = 0;
		var intAcumSubtotal = 0;

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Incrementar acumulados
			intAcumCantidad += parseFloat(objRen.cells[1].innerHTML);
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intAcumImporte += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
			intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));


		}

		//Convertir cantidad a formato moneda
		intAcumCantidad = formatMoney(intAcumCantidad, 2, '');
		intAcumImporte =  '$'+formatMoney(intAcumImporte, 6, '');
		intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 6, '');

		//Asignar los valores
		$('#acumCantidad_detalles_salida_insumos_eventos_mercadotecnia').html(intAcumCantidad);
		$('#acumImporte_detalles_salida_insumos_eventos_mercadotecnia').html(intAcumImporte);
		$('#acumSubtotal_detalles_salida_insumos_eventos_mercadotecnia').html(intAcumSubtotal);
		
	}

	//Función para mover renglones arriba y abajo en la tabla
	$('#dg_detalles_salida_insumos_eventos_mercadotecnia').on('click','button.btn',function(){
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

	//Controles o Eventos del Modal
	$(document).ready(function() 
	{
		/*******************************************************************************************************************
		Controles correspondientes al modal
		*********************************************************************************************************************/
		//Agregar datepicker para seleccionar fecha
		$('#dteFecha_salida_insumos_eventos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFecha_salida_insumos_eventos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY',
		 																   useCurrent: false});

		/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
    	$('.moneda_salida_insumos_eventos_mercadotecnia').blur(function(){
			$('.moneda_salida_insumos_eventos_mercadotecnia').formatCurrency({ roundToDecimalPlace: 6 });
		});


		//Autocomplete para recuperar los datos de un evento 
        $('#txtEvento_salida_insumos_eventos_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtEventoID_salida_insumos_eventos_mercadotecnia').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "mercadotecnia/eventos/autocomplete",
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
             $('#txtEventoID_salida_insumos_eventos_mercadotecnia').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('mercadotecnia/eventos/get_datos',
                  { 
                  	intEventoID:$("#txtEventoID_salida_insumos_eventos_mercadotecnia").val()
                  },
                  function(data) {
                    if(data.row){
                       $("#txtEventoID_salida_insumos_eventos_mercadotecnia").val(data.row.evento_id);
                       $("#txtEvento_salida_insumos_eventos_mercadotecnia").val(data.row.descripcion);
                       $("#txtLocalidadID_salida_insumos_eventos_mercadotecnia").val(data.row.localidad_id);
                       $.post('crm/localidades/get_datos',
		                { 
		                  	strBusqueda:$("#txtLocalidadID_salida_insumos_eventos_mercadotecnia").val(),
				       		strTipo: 'id'
		                },
		                function(data) {
		                    if(data.row){
		                       $("#txtLocalidad_salida_insumos_eventos_mercadotecnia").val(data.row.localidad);
		                       $("#txtMunicipioID_salida_insumos_eventos_mercadotecnia").val(data.row.municipio_id);
		                       $("#txtMunicipio_salida_insumos_eventos_mercadotecnia").val(data.row.municipio);
		                       $("#txtEstadoID_salida_insumos_eventos_mercadotecnia").val(data.row.estado_id);
		                       $("#txtEstado_salida_insumos_eventos_mercadotecnia").val(data.row.estado);
		                       
		                    }
		                }
		                 ,
		                'json');
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

        //Autocomplete para recuperar los datos de una sucursal 
        $('#txtSucursal_salida_insumos_eventos_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtSucursalID_salida_insumos_eventos_mercadotecnia').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "administracion/sucursales/autocomplete",
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
             $('#txtSucursalID_salida_insumos_eventos_mercadotecnia').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('administracion/sucursales/get_datos',
              { 
              	strBusqueda:$("#txtSucursalID_salida_insumos_eventos_mercadotecnia").val(),
	       		strTipo: 'id'
              },
              function(data) {
                if(data.row){
                   $("#txtSucursal_salida_insumos_eventos_mercadotecnia").val(data.row.nombre);  
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

        //Autocomplete para recuperar los datos de un responsable (empleado)
        $('#txtResponsable_salida_insumos_eventos_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtResponsableID_salida_insumos_eventos_mercadotecnia').val('');
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
             $('#txtResponsableID_salida_insumos_eventos_mercadotecnia').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('recursos_humanos/empleados/get_datos',
              { 
              	strBusqueda:$("#txtResponsableID_salida_insumos_eventos_mercadotecnia").val(),
	       		strTipo: 'id'
              },
              function(data) {
                if(data.row){
                   $("#txtResponsable_salida_insumos_eventos_mercadotecnia").val(data.row.apellido_paterno + ' ' + data.row.apellido_materno + ' ' + data.row.nombre);  
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

        //Validar que exista concepto cuando se pulse la tecla enter 
		$('#txtInsumo_detalles_salida_insumos_eventos_mercadotecnia').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	            //Si no existe concepto
	           if($('#txtInsumo_detalles_salida_insumos_eventos_mercadotecnia').val() == '')
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtInsumo_detalles_salida_insumos_eventos_mercadotecnia').focus();
		   	    }
		   	    else
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtCantidad_detalles_salida_insumos_eventos_mercadotecnia').focus();
		   	    }
	        }
	    });

		//Validar que exista cantidad cuando se pulse la tecla enter 
		$('#txtCantidad_detalles_salida_insumos_eventos_mercadotecnia').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	            //Si no existe cantidad
	            if($('#txtCantidad_detalles_salida_insumos_eventos_mercadotecnia').val() == '')
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtCantidad_detalles_salida_insumos_eventos_mercadotecnia').focus();
		   	    }
		   	    else
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtCantidad_detalles_salida_insumos_eventos_mercadotecnia').focus();
		   	    }
	        }
	    });

	        //Autocomplete para recuperar los datos de un insumo en el catálogo
        $('#txtInsumo_detalles_salida_insumos_eventos_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtInsumoID_detalles_salida_insumos_eventos_mercadotecnia').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "mercadotecnia/insumos/autocomplete",
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
             $('#txtInsumoID_detalles_salida_insumos_eventos_mercadotecnia').val(ui.item.insumo_id);
             //Hacer un llamado al método del controlador para regresar el costo del insumo seleccionado
             $.post('mercadotecnia/salida_insumos_eventos/get_costo',
              { 
              	intInsumoID:$("#txtInsumoID_detalles_salida_insumos_eventos_mercadotecnia").val()
              },
              function(data) {
                if(data.row){
                   $("#txtCostoUnitario_detalles_salida_insumos_eventos_mercadotecnia").val(data.row.actual_costo);
                   $("#txtCantidad_detalles_salida_insumos_eventos_mercadotecnia").focus();  
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

		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_salida_insumos_eventos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_salida_insumos_eventos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_salida_insumos_eventos_mercadotecnia').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_salida_insumos_eventos_mercadotecnia').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_salida_insumos_eventos_mercadotecnia').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_salida_insumos_eventos_mercadotecnia').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_salida_insumos_eventos_mercadotecnia').on('click','a',function(event){
			event.preventDefault();
			intPaginaSalidaInsumosEventosMercadotecnia = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_salida_insumos_eventos_mercadotecnia();
		});

		//Autocomplete para recuperar los datos de un evento 
        $('#txtEventoBusq_salida_insumos_eventos_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtEventoBusqID_salida_insumos_eventos_mercadotecnia').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "mercadotecnia/eventos/autocomplete",
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
             $('#txtEventoBusqID_salida_insumos_eventos_mercadotecnia').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('mercadotecnia/eventos/get_datos',
                  { 
                  	intEventoID:$("#txtEventoBusqID_salida_insumos_eventos_mercadotecnia").val()
                  },
                  function(data) {
                    if(data.row){
                       $("#txtEventoBusqID_salida_insumos_eventos_mercadotecnia").val(data.row.evento_id);
                       $("#txtEventoBusq_salida_insumos_eventos_mercadotecnia").val(data.row.descripcion);
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
		$('#btnNuevo_salida_insumos_eventos_mercadotecnia').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_salida_insumos_eventos_mercadotecnia();
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_salida_insumos_eventos_mercadotecnia').addClass("estatus-NUEVO");
			//Abrir modal
			 objSalidaInsumosEventosMercadotecnia = $('#SalidaInsumosEventosMercadotecniaBox').bPopup({
										   appendTo: '#SalidaInsumosEventosMercadotecniaContent', 
			                               contentContainer: 'SalidaInsumosEventosMercadotecniaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});
			
		});


		//Enfocar caja de texto
		$('#txtBusqueda_salida_insumos_eventos_mercadotecnia').focus();
		//Deshabilitar los siguientes botones (funciones de permisos de acceso)
		$('#btnNuevo_salida_insumos_eventos_mercadotecnia').attr('disabled','-1');  
		$('#btnImprimir_salida_insumos_eventos_mercadotecnia').attr('disabled','-1');
		$('#btnDescargarXLS_salida_insumos_eventos_mercadotecnia').attr('disabled','-1');
		$('#btnBuscar_salida_insumos_eventos_mercadotecnia').attr('disabled','-1');
		$('#btnGuardar_salida_insumos_eventos_mercadotecnia').attr('disabled','-1');
		$('#btnImprimirRegistro_salida_insumos_eventos_mercadotecnia').attr('disabled','-1');
		$('#btnDesactivar_salida_insumos_eventos_mercadotecnia').attr('disabled','-1');
		$('#btnRestaurar_salida_insumos_eventos_mercadotecnia').attr('disabled','-1');   	
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_salida_insumos_eventos_mercadotecnia();
	
	});

</script>