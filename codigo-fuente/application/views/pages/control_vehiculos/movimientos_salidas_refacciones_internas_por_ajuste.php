
	<div id="MovimientosSalidasRefaccionesInternasPorAjusteControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"
				                    		name= "strFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
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
								<label for="txtFechaFinalBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"
				                    		name= "strFechaFinalBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!-- Buscar registros -->
							<button class="btn btn-primary" id="btnBuscar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"
									onclick="paginacion_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"
									onclick="reporte_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();" title="Generar reporte PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"
									onclick="descargar_xls_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();" title="Descargar archivo XLS" tabindex="1" disabled>
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
	                        			id="chbImprimirDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
									   	name="strImprimirDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
									   	type="checkbox" value="" tabindex="1">
								</input>
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
				/*Definir columnas de la tabla movimientos*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Importe"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*Definir columnas de la tabla detalles del movimiento*/
				td.movil.b1:nth-of-type(1):before {content: "Código - Descripción"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*Definir columnas de los totales (acumulados) de la tabla detalles del movimiento*/
				td.movil.t2:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t4:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.t5:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.t7:nth-of-type(4):before {content: "Subtotal"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Cantidad</th>
							<th class="movil">Importe</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{cantidad}}</td>
							<td class="movil a4">{{importe}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="td-center movil a6"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos({{movimiento_refacciones_internas_id}})"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos({{movimiento_refacciones_internas_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos({{movimiento_refacciones_internas_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos({{movimiento_refacciones_internas_id}})" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="MovimientosSalidasRefaccionesInternasPorAjusteControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"  class="ModalBodyTitle">
			<h1>Salida de Refacciones Internas por Ajuste</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!-- Folio -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
										   name="intMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
										   type="hidden" value="" />
									<label for="txtFolio_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
											name="strFolio_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
											type="text" value="" placeholder="Autogenerado" disabled />
								</div>
							</div>
						</div>
						<!-- Fecha -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos'>
					                    <input class="form-control" 
					                    		id="txtFecha_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"
					                    		name= "strFecha_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
					                    		type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!-- Total de unidades -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTotalUnidades_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">Cantidad total</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control cantidad_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
											id="txtTotalUnidades_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
											name="intTotalUnidades_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
											type="text" value="" tabindex="1" placeholder="Ingrese unidades" maxlength="14" />
								</div>
							</div>	
						</div>
						<!-- Importe total -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteTotal_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">Importe total</label>
								</div>	
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
											id="txtImporteTotal_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
											name="intImporteTotal_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
											type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23" />
									</div>		
								</div>
							</div>	
						</div>
					</div>
					<div class="row">
						<!-- Observaciones -->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">Observaciones</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtObservaciones_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
											name="strObservaciones_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
											type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250" />			
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
									<input id="txtNumDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
										   name="intNumDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la salida de refacciones internas</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene las refacciones internas activas-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la  refacción interna seleccionada-->
																<input id="txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																	   name="intRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																	   type="hidden" value="" />
																<label for="txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		name="strCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		type="text" value="" tabindex="1" 
																		placeholder="Ingrese código" maxlength="250" />
															</div>
														</div>
													</div>
													<!--Autocomplete que contiene las refacciones internas activas-->
													<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">
																	Descripción
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		name="strDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		type="text" value="" tabindex="1" 
																		placeholder="Ingrese descripción" maxlength="250" />
															</div>
														</div>
													</div>
													<!--Unidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtUnidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">Unidad</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtUnidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		name="strUnidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		type="text" 
																		value="" 
																		disabled />
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">	   
																<label for="txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		id="txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		name="intCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		type="number" value="" tabindex="1" min="0" maxlength="14" />
															</div>
														</div>
													</div>
													<!--Precio unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">Precio unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		id="txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		name="intPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		type="text" value="" tabindex="1" maxlength="23" disabled />
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		id="txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		name="intPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		type="text" value="" tabindex="1" maxlength="8" disabled />
															</div>
														</div>
													</div>
													<!--Porcentaje del IVA-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
																<!--
																<input id="txtTasaCuotaIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																	   name="intTasaCuotaIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																	   type="text" value="" />
																-->	   
																<label for="txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">IVA %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		name="intPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" type="text" value="" 
																		tabindex="1" placeholder="Ingrese IVA" maxlength="8" />
															</div>
														</div>
													</div>
													<!--Porcentaje del IEPS-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
																<!--
																<input id="txtTasaCuotaIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																	   name="intTasaCuotaIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																	   type="text" value="" />
																-->
																<label for="txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">IEPS %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
																		name="intPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" type="text" value="" 
																		tabindex="1" placeholder="Ingrese IEPS" maxlength="8" />
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos" 
					                                			onclick="agregar_renglon_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();" 
					                                	     	title="Agregar registro" tabindex="1"> 
					                                		<span class="glyphicon glyphicon-plus"></span>
					                                	</button>
					                             	</div>
												</div>
											</div>
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Código - Descripción</th>
																<th class="movil" style="width:3em;">Unidad</th>
																<th class="movil" style="width:5em;">Cantidad</th>
																<th class="movil" style="width:5em;">P.Unitario</th>
																<th class="movil" style="width:5em;">Desc.</th>
																<th class="movil" style="width:5em;">Subtotal</th>
																<th class="movil" style="width:5em;">IVA</th>
																<th class="movil" style="width:5em;">IEPS</th>
																<th class="movil" style="width:5em;">Total</th>
																<th class="movil" id="th-acciones" style="width:5em;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
														<tfoot class="movil">
															<tr class="movil">
																<td class="movil t1">
																	<strong>Total</strong>
																</td>
																<td class="movil t2"></td>
																<td  class="movil t3">
																	<strong id="acumCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">0.00</strong>
																</td>
																<td class="movil t4"></td>
																<td class="movil t5">
																	<strong id="acumDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">$0.00</strong>
																</td>
																<td class="movil t6">
																	<strong id="acumSubtotal_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">$0.00</strong>
																</td>
																<td class="movil t7">
																	<strong id="acumIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">$0.00</strong>
																</td>
																<td class="movil t8">
																	<strong  id="acumIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">$0.00</strong>
																</td>
																<td class="movil t9">
																	<strong id="acumTotal_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">$0.00</strong>
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
																<strong id="numElementos_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos">0</strong> encontrados
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
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Nuevo registro-->
							<button class="btn btn-info" id="btnReiniciar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"  
									onclick="nuevo_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos('Nuevo');"  title="Nuevo registro" tabindex="2">
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"  
									onclick="validar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();"  title="Guardar" tabindex="3" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"  
									onclick="reporte_registro_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos('');"  
									title="Imprimir" tabindex="4" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"  
									onclick="cambiar_estatus_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos('');"  title="Desactivar" tabindex="5" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();" 
									title="Cerrar"  tabindex="6">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MovimientosSalidasRefaccionesInternasPorAjusteControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = 0;
		var strUltimaBusquedaMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = "";
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = <?php echo MONEDA_BASE ?>;
		//Variables que se utilizan para la búsqueda de registros
		var intProveedorIDMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = "";
		var dteFechaInicialMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = "";
		var dteFechaFinalMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/movimientos_salidas_refacciones_internas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = strPermisosMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos[i]=='GUARDAR') || (arrPermisosMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
						}
						else if(arrPermisosMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos() 
		{
		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos =($('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val()+$('#txtFechaFinalBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val()+$('#txtProveedorIDBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos != strUltimaBusquedaMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos)
			{
				intPaginaMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = 0;
				strUltimaBusquedaMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = strNuevaBusquedaMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/movimientos_salidas_refacciones_internas_por_ajuste/get_paginacion',
					{ //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					  dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val()),
					  dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val()),
					  intPagina: intPaginaMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos,
					  strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val()
					},
					function(data){
						$('#dg_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos tbody').empty();
						var tmpMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = Mustache.render($('#plantilla_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(),data);
						$('#dg_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos tbody').html(tmpMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos);
						$('#pagLinks_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(data.paginacion);
						$('#numElementos_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(data.total_rows);
						intPaginaMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = data.pagina;
					},
			'json');
		}


		//Función para cargar el reporte general en PDF
		function reporte_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos() 
		{
			//Asignar valores para la búsqueda de registros
			dteFechaInicialMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos =  $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val());
			dteFechaFinalMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos =  $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val());

			//Si no existe fecha inicial
			if(dteFechaInicialMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos == '')
			{
				dteFechaInicialMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos == '')
			{
				dteFechaFinalMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos =  '0000-00-00';
			}
		
			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('NO');
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/movimientos_salidas_refacciones_internas_por_ajuste/get_reporte/"+dteFechaInicialMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos+"/"+dteFechaFinalMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos+"/"+$('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val());
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/movimientos_salidas_refacciones_internas_por_ajuste/get_reporte_registro/" + intID);
		}

		//Función para descargar el archivo XLS
		function descargar_xls_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos() 
		{
			//Asignar valores para la búsqueda de registros
			dteFechaInicialMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos =  $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val());
			dteFechaFinalMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos =  $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val());

			//Si no existe fecha inicial
			if(dteFechaInicialMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos == '')
			{
				dteFechaInicialMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos == '')
			{
				dteFechaFinalMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos =  '0000-00-00';
			}
			
			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el archivo
			    $('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el archivo
			   $('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('NO');
			}

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("control_vehiculos/movimientos_salidas_refacciones_internas_por_ajuste/get_xls/"+dteFechaInicialMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos+"/"+dteFechaFinalMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos+"/"+$('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val());
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(tipoAccion)
		{
			//Incializar formulario
			$('#frmMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos').find('input[type=hidden]').val('');
			//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
			$('#txtTipoCambio_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('1.0000');
			//Asignar la fecha actual
			$('#txtFecha_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(fechaActual()); 
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
			  //Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
            $.removerClasesEncabezado('divEncabezadoModal_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos');

			//Si el tipo de acción corresponde a Nuevo
			if(tipoAccion == 'Nuevo')
			{
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').addClass("estatus-NUEVO");
			}
			//Habilitar todos los elementos del formulario
			$('#frmMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').attr("disabled", "disabled");
			//Detallado en el GRID
			$('#txtUnidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').attr('disabled','disabled');

 			//Mostrar los siguientes botones
			$("#btnGuardar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").show();
			$("#btnReiniciar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").hide();
			$("#btnDesactivar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").hide();
		}

		//Función para deshabilitar controles del formulario y así evitar modificar datos correspondientes al XML u orden de compra
		function deshabilitar_controles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(tipoAccion)
		{
			//Dependiendo del tipo de acción habilitar o deshabilitar controles
			//Deshabilitar los siguientes controles
			$('#txtProveedor_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').attr('disabled','disabled');
			$('#btnAgregar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').attr('disabled','disabled');
			$('#txtCodigoDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').attr('disabled','disabled');
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').attr('disabled','disabled');
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').attr('disabled','disabled');
			$('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').attr('disabled','disabled');
			$('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').attr('disabled','disabled');
			$('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').attr('disabled','disabled');
			$('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').attr('disabled','disabled');

			//Limpiar contenido de las siguientes cajas de texto
			$('#txtCodigoDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
			$('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
			$('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
			$('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
			$('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
		}

		//Función para inicializar elementos de la orden de compra
		function inicializar_orden_compra_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtProveedorID_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
            $('#txtProveedor_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
            $('#txFactura_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
		}
																	

		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos()
		{
			//Eliminar los datos de la tabla detalles del movimiento
			$('#dg_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos tbody').empty();
			$('#acumCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html('0.00');
		    $('#acumDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html('$0.00');
		    $('#acumSubtotal_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html('$0.00');
		    $('#acumIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html('$0.00');
		    $('#acumIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html('$0.00');
		    $('#acumTotal_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html('$0.00');
			$('#numElementos_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(0);
			$('#txtNumDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos()
		{
			try {
				//Cerrar modal
				objMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos')
				.bootstrapValidator({	excluded: [':disabled'],
									 	container: 'popover',
									 	feedbackIcons: {
									 		valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
									  	},
									  	fields: {
											strFecha_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
												validators: {
													notEmpty: {message: 'Seleccione una fecha'}
												}
											},
											intTotalUnidades_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
												validators: {
													notEmpty: {message: 'Escriba el total de unidades'}
												}
											},
											intImporteTotal_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
												validators: {
													notEmpty: {message: 'Escriba el importe total'}
												}
											},
											strObservaciones_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
												validators: {
													notEmpty: {message: 'Escriba observaciones para este movimiento'}
												}
											},
											intNumDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que existan detalles
						                                    if(parseInt(value) === 0 || value === '')
						                                    {
						                                    	return {
						                                            valid: false,
						                                            message: 'Agregar al menos un detalle para esta entrada de refacciones internas por ajuste.'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
										    intMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos:{
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    strCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    strDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    strUnidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    }
										    
										}
									});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos = $('#frmMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos.isValid())
			{

				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = $.reemplazar($('#acumTotal_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = $.reemplazar(intAcumTotalDetallesMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos, ",", "");

				var intImporteTotalMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = $.reemplazar($('#txtImporteTotal_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(), ",", "");

				//Verificar que al menos un registro tenga una devolución
				if(intAcumTotalDetallesMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos <= 0)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos('error', 'Al menos debe agregar un detalle para este movimiento, favor de verificar.');
				}
				//Verificar que el total de unidades sea igual a la cantidad de detalles
				else if($('#acumCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html() != $('#txtTotalUnidades_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val())
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos('error', 'El total de unidades no coincide con los detalles, favor de verificar.');
					
				}
				//Verificar que el importe total sea igual al total de detalles
				else if(intAcumTotalDetallesMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos != intImporteTotalMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos('error', 'El importe total no coincide con los detalles, favor de verificar.');
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();	
				}
			}	
			else{
				return;
			} 
				
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos()
		{
			try
			{
				$('#frmMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos()
		{
			
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRefaccionInternaID = [];
			var arrCantidades = [];
			var arrPreciosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrIvasUnitarios = [];
			var arrIepsUnitarios = [];
	
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var intCantidad =  parseFloat( $.reemplazar(objRen.cells[2].innerHTML, ",", "") );
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intPrecioUnitario = parseFloat( $.reemplazar(objRen.cells[3].innerHTML, ",", "") );
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intDescuentoUnitario = parseFloat( $.reemplazar(objRen.cells[4].innerHTML, ",", "") );
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intIvaUnitario = parseFloat( $.reemplazar(objRen.cells[6].innerHTML, ",", "") );
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intIepsUnitario = parseFloat( $.reemplazar(objRen.cells[7].innerHTML, ",", "") );

				//Asignar valores a los arrays
				arrRefaccionInternaID.push(objRen.getAttribute('id'));
				arrCantidades.push(intCantidad);
				arrPreciosUnitarios.push(intPrecioUnitario);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrIvasUnitarios.push(intIvaUnitario);
				arrIepsUnitarios.push(intIepsUnitario);

			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/movimientos_salidas_refacciones_internas_por_ajuste/guardar',
			{ 
				//Datos del movimiento
				intMovimientoRefaccionesInternasID: $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(),
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val()),
				strObservaciones: $('#txtObservaciones_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(),
				intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(),
				//Datos de los detalles
				strRefaccionInternaID: arrRefaccionInternaID.join('|'), 
				strCantidades: arrCantidades.join('|'),
				strPreciosUnitarios: arrPreciosUnitarios.join('|'),
				strDescuentosUnitarios: arrDescuentosUnitarios.join('|'),
				strIvasUnitarios: arrIvasUnitarios.join('|'),
				strIepsUnitarios: arrIepsUnitarios.join('|')
			},
			function(data) {
				if (data.resultado)
				{	

					//Si no existe id del movimiento, significa que es un nuevo registro   
					if($('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '')
					{
						//Asignar el id del movimiento registrado en la base de datos
             			$('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(data.movimiento_refacciones_internas_id);
					}

	                //Hacer un llamado a la función para cerrar modal
	                cerrar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
	                //Hacer llamado a la función  para cargar  los registros en el grid
	               	paginacion_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();        

				}

				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(data.tipo_mensaje, data.mensaje);
			},
			'json');
			
			
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(tipoMensaje, mensaje)
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
		function cambiar_estatus_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(id)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();
			}
			else
			{
				intID = id;
			}

			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Salida de Refacciones Internas por Ajuste',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
			                              $.post('control_vehiculos/movimientos_salidas_refacciones_internas_por_ajuste/set_estatus',
			                                     {
			                                     	intMovimientoRefaccionesInternasID: intID
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                          	//Hacer llamado a la función  para cargar  los registros en el grid
			                                          	paginacion_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
			                                          	//Si el id del registro se obtuvo del modal
														if(id == '')
														{
															//Hacer un llamado a la función para cerrar modal
															cerrar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();     
														}
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(id)
		{	

			//Variable de tipo ARRAY que se utiliza para almacenar los renglones correspondientes a el movimento que esta siendo editado.
			var arrRenglonesMovimiento = [];

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/movimientos_salidas_refacciones_internas_por_ajuste/get_datos',
	       {
	       		intMovimientoRefaccionesInternasID:id
	       },
	       function(data) {
	
	        	//Si hay datos del registro
	            if(data.row)
	            {
					
	            	//Hacer un llamado a la función para limpiar los campos del formulario
					nuevo_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos('');
		          	
		          	//Recuperar valores
		            $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(data.row.movimiento_refacciones_internas_id);
		            $('#txtFolio_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(data.row.folio);
		            $('#txtFecha_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(data.row.fecha);
				    $('#txtObservaciones_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(data.row.observaciones);

				    //Cargar refacciones adherentes a la orden de compra parcial seleccionada
              		if(data.detalles){

              			
              			//Mostramos los detalles del registro
			           	 //Variable que se utiliza para asignar el tipo de cambio
			            var intTipoCambio = parseFloat(1);

			           	//Mostramos los detalles del registro
			           	for (var intCon in data.detalles) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').getElementsByTagName('tbody')[0];

							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigoDescripcion = objRenglon.insertCell(0);
							var objCeldaUnidad = objRenglon.insertCell(1);
							var objCeldaCantidad = objRenglon.insertCell(2);
							var objCeldaPrecioUnitario = objRenglon.insertCell(3);
							var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
							var objCeldaSubtotal = objRenglon.insertCell(5);
							var objCeldaIvaUnitario = objRenglon.insertCell(6);
							var objCeldaIepsUnitario = objRenglon.insertCell(7);
							var objCeldaTotal = objRenglon.insertCell(8);
							var objCeldaAcciones = objRenglon.insertCell(9);
							//Columnas ocultas
							var objCeldaPorcentajeDescuento = objRenglon.insertCell(10);
							var objCeldaPorcentajeIva = objRenglon.insertCell(11);
							var objCeldaPorcentajeIeps = objRenglon.insertCell(12);
						    //var objCeldaTasaCuotaIva = objRenglon.insertCell(13);
							//var objCeldaTasaCuotaIeps = objRenglon.insertCell(14);
							
							//Variables que se utilizan para asignar valores del detalle
							var intSubtotal = parseFloat(data.detalles[intCon].precio_unitario);
							var intCantidad =  parseFloat(data.detalles[intCon].cantidad);
							var intPrecioUnitario = parseFloat(data.detalles[intCon].precio_unitario);
							var intDescuentoUnitario = parseFloat(data.detalles[intCon].descuento_unitario);
							var intIvaRegistro = parseFloat(data.detalles[intCon].iva_unitario);
							var intIepsRegistro = parseFloat(data.detalles[intCon].ieps_unitario);
							var intImporteIva = 0;
							var intImporteIeps = 0;
							var intPorcentajeDescuento = 0;
							var intPorcentajeIva = 0;
							var intPorcentajeIeps = '';
							var intTotal = 0;

							//Convertir peso mexicano a tipo de cambio
							intSubtotal = intSubtotal / intTipoCambio;
							intPrecioUnitario = intPrecioUnitario / intTipoCambio;
							intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
							intIvaRegistro = intIvaRegistro / intTipoCambio;
							intIepsRegistro = intIepsRegistro / intTipoCambio;

							//Si existe importe del descuento
							if(intDescuentoUnitario > 0)
							{
								//intPrecioUnitario = intPrecioUnitario + intDescuentoUnitario;
								//Calcular porcentaje del descuento
								intPorcentajeDescuento = intDescuentoUnitario / intSubtotal;
							}

							//Calcular subtotal
							intSubtotal = intCantidad * intSubtotal;

							intSubtotal = intSubtotal - intDescuentoUnitario;

							//Si existe importe de IVA unitario
							if(intIvaRegistro > 0)
							{
								//Calcular importe de IVA
								intImporteIva =  intIvaRegistro * intCantidad;
								//Calcular porcentaje del descuento
								intPorcentajeIva = intImporteIva / intSubtotal;
							}

							//Si existe importe de IEPS unitario
							if(intIepsRegistro > 0)
							{
								//Calcular importe de IEPS
								intImporteIeps =  intIepsRegistro * intCantidad;
								//Calcular porcentaje del IEPS
								intPorcentajeIeps = intImporteIeps / intSubtotal;
							}


							//Calcular importe total
							intTotal = intSubtotal + intIvaRegistro + intIepsRegistro;

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].refaccion_interna_id);
							objCeldaCodigoDescripcion.setAttribute('class', 'movil b1');
							objCeldaCodigoDescripcion.innerHTML = data.detalles[intCon].codigo + ' - ' + data.detalles[intCon].descripcion;
							objCeldaUnidad.setAttribute('class', 'movil b2');
							objCeldaUnidad.innerHTML = data.detalles[intCon].unidad;
							objCeldaCantidad.setAttribute('class', 'movil b2');
							objCeldaCantidad.innerHTML = formatMoney(intCantidad, 2, '');
							objCeldaPrecioUnitario.setAttribute('class', 'movil b3');
							objCeldaPrecioUnitario.innerHTML = formatMoney(intPrecioUnitario, 6, '');
							objCeldaDescuentoUnitario.setAttribute('class', 'movil b4');
							objCeldaDescuentoUnitario.innerHTML = formatMoney(intDescuentoUnitario, 6, '');
							objCeldaSubtotal.setAttribute('class', 'movil b5');
							objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 6, '');
							objCeldaIvaUnitario.setAttribute('class', 'movil b6');
							objCeldaIvaUnitario.innerHTML = formatMoney(intIvaRegistro, 6, '');
							objCeldaIepsUnitario.setAttribute('class', 'movil b7');
							objCeldaIepsUnitario.innerHTML = formatMoney(intIepsRegistro, 6, '');
							objCeldaTotal.setAttribute('class', 'movil b8');
							objCeldaTotal.innerHTML = formatMoney(intTotal, 6, '');
							objCeldaAcciones.setAttribute('class', 'td-center movil b9');
							
							objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
														 " onclick='editar_renglon_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(this)'>" + 
														 "<span class='glyphicon glyphicon-edit'></span></button>" + 
														 "<button class='btn btn-default btn-xs' title='Eliminar'" +
														 " onclick='eliminar_renglon_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(this)'>" + 
														 "<span class='glyphicon glyphicon-trash'></span></button>" + 
														 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
														 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
														 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
														 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
							
							
							objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
							objCeldaPorcentajeDescuento.innerHTML = formatMoney(intPorcentajeDescuento, 6, '');
							objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
							objCeldaPorcentajeIva.innerHTML =  formatMoney(intPorcentajeIva, 6, '');
							objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
							objCeldaPorcentajeIeps.innerHTML = formatMoney(intPorcentajeIeps, 6, '');
							
							/*
							objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
							objCeldaTasaCuotaIva.innerHTML = data.detalles[intCon].tasa_cuota_iva;
							objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
							objCeldaTasaCuotaIeps.innerHTML = data.detalles[intCon].tasa_cuota_ieps;
							*/	

			            }

			            //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
						
						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos tr").length - 2;
						$('#numElementos_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(intFilas);
						$('#txtNumDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(intFilas);

              		}
					//Dependiendo del estatus cambiar el color del encabezado 
		            $('#divEncabezadoModal_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').addClass("estatus-"+data.row.estatus);
		            //Mostrar botón Imprimir  
		            $("#btnImprimirRegistro_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").show();

					//Si el estatus del registro es INACTIVO
		            if(data.row.estatus == 'INACTIVO')
		            {
		            	//Deshabilitar todos los elementos del formulario
		            	$('#frmMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
		            	//Ocultar los siguientes botones
			            $("#btnGuardar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").hide();
			            $("#btnReiniciar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").hide();
		            }
		            else
		            {
		            	//Mostrar el botón Desactivar
		            	$("#btnDesactivar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").show();
		            }

	            	//Abrir modal
					objMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = $('#MovimientosSalidasRefaccionesInternasPorAjusteControlVehiculosBox').bPopup({
												   appendTo: '#MovimientosSalidasRefaccionesInternasPorAjusteControlVehiculosContent', 
					                               contentContainer: 'MovimientosSalidasRefaccionesInternasPorAjusteControlVehiculosM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
					
	       	    }
	       	    
	       },
	       'json');

		}
	

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos()
		{

			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla ordenes_compra_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asigna el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intRefaccionInternaID = $('#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();
			var strCodigo = $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();
			var strDescripcion = $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();
			var strUnidad = $('#txtUnidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();
			var intCantidad = $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();
			//var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();
			//var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intRefaccionInternaID == '' || strCodigo == '')
			{
				//Enfocar caja de texto
				$('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			}
			else if (intCantidad == '')
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			}
			else if (intPrecioUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			}
			else if (intPorcentajeIva == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			}
			else if(intPorcentajeIeps == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
				$('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
				$('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
				$('#txtUnidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
				$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
			    $('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
			    $('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
			    $('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
			    $('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
			    //$('#txtTasaCuotaIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
			    //$('#txtTasaCuotaIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');

				//Convertir cadena de texto a número decimal
				intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
				intSubtotal =  parseFloat($.reemplazar(intPrecioUnitario, ",", ""));

				intPorcentajeDescuento = parseFloat($.reemplazar(intPorcentajeDescuento, ",", ""));;
				intPorcentajeIva = parseFloat($.reemplazar(intPorcentajeIva, ",", ""));;
				intPorcentajeIeps = parseFloat($.reemplazar(intPorcentajeIeps, ",", ""));;

				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}
				else
				{
					intPorcentajeDescuento = 0;
				}

				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;

				//Si existe porcentaje de IVA
				if(intPorcentajeIva != '')
				{
					//Calcular importe de IVA
					intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
				}

				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps != '')
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
				}

				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

				//Revisamos si existe la descripción proporcionada, si es así, editamos los datos
				if (objTabla.rows.namedItem(intRefaccionInternaID))
				{		
					objTabla.rows.namedItem(intRefaccionInternaID).cells[1].innerHTML = strUnidad;
					objTabla.rows.namedItem(intRefaccionInternaID).cells[2].innerHTML = formatMoney(intCantidad, 2, '');
					objTabla.rows.namedItem(intRefaccionInternaID).cells[3].innerHTML = intPrecioUnitario;
					objTabla.rows.namedItem(intRefaccionInternaID).cells[4].innerHTML =  formatMoney(intDescuentoUnitario, 6, '');
					objTabla.rows.namedItem(intRefaccionInternaID).cells[5].innerHTML =  formatMoney(intSubtotal, 6, '');
					objTabla.rows.namedItem(intRefaccionInternaID).cells[6].innerHTML = formatMoney(intImporteIva, 6, '');
					objTabla.rows.namedItem(intRefaccionInternaID).cells[7].innerHTML = formatMoney(intImporteIeps, 6, '');
					objTabla.rows.namedItem(intRefaccionInternaID).cells[8].innerHTML = formatMoney(intTotal, 6, '');
					objTabla.rows.namedItem(intRefaccionInternaID).cells[10].innerHTML = formatMoney(intPorcentajeDescuento, 6, '');
					objTabla.rows.namedItem(intRefaccionInternaID).cells[11].innerHTML = formatMoney(intPorcentajeIva, 6, '');
					objTabla.rows.namedItem(intRefaccionInternaID).cells[12].innerHTML = formatMoney(intPorcentajeIeps, 6, '');
					//objTabla.rows.namedItem(intRefaccionInternaID).cells[13].innerHTML = intTasaCuotaIva;
					//objTabla.rows.namedItem(intRefaccionInternaID).cells[14].innerHTML = intTasaCuotaIeps;
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCodigoDescripcion = objRenglon.insertCell(0);
					var objCeldaUnidad = objRenglon.insertCell(1);
					var objCeldaCantidad = objRenglon.insertCell(2);
					var objCeldaPrecioUnitario = objRenglon.insertCell(3);
					var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
					var objCeldaSubtotal = objRenglon.insertCell(5);
					var objCeldaIvaUnitario = objRenglon.insertCell(6);
					var objCeldaIepsUnitario = objRenglon.insertCell(7);
					var objCeldaTotal = objRenglon.insertCell(8);
					var objCeldaAcciones = objRenglon.insertCell(9);
					//Columnas ocultas
					var objCeldaPorcentajeDescuento = objRenglon.insertCell(10);
					var objCeldaPorcentajeIva = objRenglon.insertCell(11);
					var objCeldaPorcentajeIeps = objRenglon.insertCell(12);
					//var objCeldaTasaCuotaIva = objRenglon.insertCell(13);
					//var objCeldaTasaCuotaIeps = objRenglon.insertCell(14);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRefaccionInternaID);
					objCeldaCodigoDescripcion.setAttribute('class', 'movil b1');
					objCeldaCodigoDescripcion.innerHTML = strCodigo + '-' + strDescripcion;
					objCeldaUnidad.setAttribute('class', 'movil b2');
					objCeldaUnidad.innerHTML = strUnidad
					objCeldaCantidad.setAttribute('class', 'movil b3');
					objCeldaCantidad.innerHTML = formatMoney(intCantidad, 2, '');
					objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
					objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
					objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
					objCeldaDescuentoUnitario.innerHTML = formatMoney(intDescuentoUnitario, 6, '');
					objCeldaSubtotal.setAttribute('class', 'movil b6');
					objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 6, '');
					objCeldaIvaUnitario.setAttribute('class', 'movil b7');
					objCeldaIvaUnitario.innerHTML = formatMoney(intImporteIva, 6, '');
					objCeldaIepsUnitario.setAttribute('class', 'movil b8');
					objCeldaIepsUnitario.innerHTML = formatMoney(intImporteIeps, 6, '');
					objCeldaTotal.setAttribute('class', 'movil b9');
					objCeldaTotal.innerHTML = formatMoney(intTotal, 6, '');
					objCeldaAcciones.setAttribute('class', 'td-center movil b10');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					
					objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeDescuento.innerHTML = formatMoney(intPorcentajeDescuento, 6, ''); 
					objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIva.innerHTML = formatMoney(intPorcentajeIva, 6, '');
					objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIeps.innerHTML = formatMoney(intPorcentajeIeps, 6, '');
					
					/*
					objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIva.innerHTML = intTasaCuotaIva;
					objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIeps.innerHTML =  intTasaCuotaIeps;
					*/
					
				}

				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
				
				//Enfocar caja de texto
				$('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos tr").length - 2;
			$('#numElementos_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(intFilas);
			$('#txtNumDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(intFilas);

		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			var str = objRenglon.parentNode.parentNode.cells[0].innerHTML;
			var res = str.split("-");
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(res[0]);
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(res[1]);
			$('#txtUnidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			//$('#txtTasaCuotaIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			//$('#txtTasaCuotaIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);

			//Enfocar caja de texto
			$('#txtConcepto_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos tr").length - 2;
			$('#numElementos_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(intFilas);
			$('#txtNumDetalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(intFilas);

			//Enfocar caja de texto
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[8].innerHTML, ",", ""));

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, 6, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 6, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, 6, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, 6, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, 6, '');

			//Asignar los valores
			$('#acumCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(intAcumUnidades);
			$('#acumDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(intAcumDescuento);
			$('#acumSubtotal_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(intAcumSubtotal);
			$('#acumIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(intAcumIva);
			$('#acumIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(intAcumIeps);
			$('#acumTotal_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').html(intAcumTotal);
			
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{

			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTotalUnidades_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').numeric();
			$('#txtImporteTotal_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').numeric();
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').numeric();
			$('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').numeric();
        	$('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').numeric();
        	$('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').numeric();
        	$('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').blur(function(){
				$('.moneda_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').formatCurrency({ roundToDecimalPlace: 6 });
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 18.90 será 18.9000*/
        	$('.tipo-cambio_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').blur(function(){
				$('.tipo-cambio_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').formatCurrency({ roundToDecimalPlace: 4 });
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').blur(function(){
                $('.cantidad_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});


			 //Autocomplete para recuperar los datos de una refacción interna
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "control_vehiculos/refacciones_internas/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term,
							strTipo: 'codigo',
							strTipoMovimiento: 'salida_interna'
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(ui.item.data);
					//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             	$.post('control_vehiculos/refacciones_internas/get_datos',
	                  { 
	                  	strBusqueda:$("#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").val(ui.item.codigo);
	                       $("#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").val(data.row.descripcion);
	                       $("#txtUnidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").val(data.row.unidad);
	                       $("#txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").val(data.row.actual_existencia_interno);
	                       $("#txtActualCosto_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").val(data.row.actual_costo_interno);
	                       //Enfocar caja de texto
	                       $("#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").focus();
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

			 //Verificar que exista id de la refacción interna cuando pierda el enfoque la caja de texto
	        $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focusout(function(e){
	            //Si no existe id de la refacción interna
	            if($('#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '' ||
	               $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtUnidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtActualCosto_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	              
	            }
	        });

	        //Autocomplete para recuperar los datos de una refacción interna
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "control_vehiculos/refacciones_internas/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term,
							strTipo: 'descripcion',
							strTipoMovimiento: 'salida_interna'
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(ui.item.data);
					//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             	$.post('control_vehiculos/refacciones_internas/get_datos',
	                  { 
	                  	strBusqueda:$("#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").val(ui.item.codigo);
	                       $("#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").val(data.row.descripcion);
	                       $("#txtUnidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").val(data.row.unidad);
	                       $("#txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").val(data.row.actual_existencia_interno);
	                       $("#txtActualCosto_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").val(data.row.actual_costo_interno);
	                       //Enfocar caja de texto
	                       $("#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").focus();
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

			//Verificar que exista id de la refacción interna cuando pierda el enfoque la caja de texto
	        $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focusout(function(e){
	            //Si no existe id de la refacción interna
	            if($('#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '' ||
	               $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtUnidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtActualCosto_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	              
	            }

	        });

			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').on('click','button.btn',function(){
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

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#btnAgregar_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
		        }
		    });

		    $("#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos").focusout(function(){

			    var max = parseFloat( $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').attr('max') );
			    var val = parseFloat( $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() );
			    
			    //Si el valor capturado es mayor que el máximo permitido cambiamos el valor proporcionado por el máximo permitido
			    if(val > max){
			    	$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val( formatMoney(max, 2, '') );
			    }

			});

			//Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_tasa_cuota/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strImpuesto: 'IVA'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             	//Asignar id del registro seleccionado
	             	//$('#txtTasaCuotaIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la tasa o cuota del impuesto de IVA cuando pierda el enfoque la caja de texto
	        /*
	        $('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '' ||
	               $('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	            }
	            
	        });
	        */

	         //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_tasa_cuota/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strImpuesto: 'IEPS'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             	//Asignar id del registro seleccionado
	             	//$('#txtTasaCuotaIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la tasa o cuota del impuesto de IEPS cuando pierda el enfoque la caja de texto
	        /*
	        $('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '' ||
	               $('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	               $('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val('');
	            }
	            
	        });
	        */

	        //Validar que exista concepto cuando se pulse la tecla enter 
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe concepto
		            if($('#txtRefaccionInternaID_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '' || $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
		        }
		    });

			//Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {

		         	//Si no existe procentaje de IVA
		            if( $('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtTasaCuotaIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() == '' && 
		         	   $('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').val() != '')
		         	{
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_detalles_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
			   	    }
		        }
		    });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY',
			 																		                            useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').data('DateTimePicker').maxDate(e.date);
			});
			
	        //Paginación de registros
			$('#pagLinks_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos('Nuevo');
				//Abrir modal
				objMovimientosSalidasRefaccionesInternasPorAjusteControlVehiculos = $('#MovimientosSalidasRefaccionesInternasPorAjusteControlVehiculosBox').bPopup({
											   appendTo: '#MovimientosSalidasRefaccionesInternasPorAjusteControlVehiculosContent', 
				                               contentContainer: 'MovimientosSalidasRefaccionesInternasPorAjusteControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#txtOrdenCompra_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_movimientos_salidas_refacciones_internas_por_ajuste_control_vehiculos();
			
		});
	</script>