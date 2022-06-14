	<div id="RequisicionesRefaccionesInternasControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_requisiciones_refacciones_internas_control_vehiculos" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_requisiciones_refacciones_internas_control_vehiculos" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos'>
				                    <input class="form-control" id="txtFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos"
				                    		name= "strFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos" 
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
								<label for="txtFechaFinalBusq_requisiciones_refacciones_internas_control_vehiculos">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_requisiciones_refacciones_internas_control_vehiculos'>
				                    <input class="form-control" id="txtFechaFinalBusq_requisiciones_refacciones_internas_control_vehiculos"
				                    		name= "strFechaFinalBusq_requisiciones_refacciones_internas_control_vehiculos" 
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
								<input id="txtVehiculoIDBusq_requisiciones_refacciones_internas_control_vehiculos" 
									   name="intVehiculoIDBusq_requisiciones_refacciones_internas_control_vehiculos"  type="hidden" 
									   value="">
								</input>
								<label for="txtVehiculoBusq_requisiciones_refacciones_internas_control_vehiculos">Vehículo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtVehiculoBusq_requisiciones_refacciones_internas_control_vehiculos" 
										name="strVehiculoBusq_requisiciones_refacciones_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese vehículo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_requisiciones_refacciones_internas_control_vehiculos">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_requisiciones_refacciones_internas_control_vehiculos" 
								 		name="strEstatusBusq_requisiciones_refacciones_internas_control_vehiculos" tabindex="1">
								    <option value="TODOS">TODOS</option>
					  				<option value="ACTIVO">ACTIVO</option>
					  				<option value="SURTIDO">SURTIDO</option>
					  				<option value="PARCIALMENTE SURTIDO">PARCIALMENTE SURTIDO</option>		
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
								<label for="txtBusqueda_requisiciones_refacciones_internas_control_vehiculos">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_requisiciones_refacciones_internas_control_vehiculos" 
										name="strBusqueda_requisiciones_refacciones_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_requisiciones_refacciones_internas_control_vehiculos" 
									   name="strImprimirDetalles_requisiciones_refacciones_internas_control_vehiculos" type="checkbox"
									   value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_requisiciones_refacciones_internas_control_vehiculos"
									onclick="paginacion_requisiciones_refacciones_internas_control_vehiculos();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_requisiciones_refacciones_internas_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_requisiciones_refacciones_internas_control_vehiculos"
									onclick="reporte_requisiciones_refacciones_internas_control_vehiculos();" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_requisiciones_refacciones_internas_control_vehiculos"
									onclick="descargar_xls_requisiciones_refacciones_internas_control_vehiculos();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla requisiciones
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Orden"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Vehículo"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Serie"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles de la requisición
				*/
				td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles de la requisición
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_requisiciones_refacciones_internas_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Orden</th>
							<th class="movil">Vehículo</th>
							<th class="movil">Serie</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_requisiciones_refacciones_internas_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{folio_orden_reparacion}}</td>
							<td class="movil a4">{{vehiculo}}</td>
							<td class="movil a5">{{serie}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_requisiciones_refacciones_internas_control_vehiculos({{requisicion_refacciones_internas_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_requisiciones_refacciones_internas_control_vehiculos({{requisicion_refacciones_internas_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_requisiciones_refacciones_internas_control_vehiculos({{requisicion_refacciones_internas_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_requisiciones_refacciones_internas_control_vehiculos({{requisicion_refacciones_internas_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_requisiciones_refacciones_internas_control_vehiculos({{requisicion_refacciones_internas_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_requisiciones_refacciones_internas_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_requisiciones_refacciones_internas_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="RequisicionesRefaccionesInternasControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_requisiciones_refacciones_internas_control_vehiculos"  class="ModalBodyTitle">
			<h1>Requisición de Refacciones</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRequisicionesRefaccionesInternasControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmRequisicionesRefaccionesInternasControlVehiculos" onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtRequisicionRefaccionesInternasID_requisiciones_refacciones_internas_control_vehiculos" 
										   name="intRequisicionRefaccionesInternasID_requisiciones_refacciones_internas_control_vehiculos" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro-->
									<input id="txtEstatus_requisiciones_refacciones_internas_control_vehiculos" 
										   name="strEstatus_requisiciones_refacciones_internas_control_vehiculos"  type="hidden" 
										   value="">
									</input>
									<label for="txtFolio_requisiciones_refacciones_internas_control_vehiculos">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_requisiciones_refacciones_internas_control_vehiculos" 
											name="strFolio_requisiciones_refacciones_internas_control_vehiculos" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_requisiciones_refacciones_internas_control_vehiculos">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_requisiciones_refacciones_internas_control_vehiculos'>
					                    <input class="form-control" id="txtFecha_requisiciones_refacciones_internas_control_vehiculos"
					                    		name= "strFecha_requisiciones_refacciones_internas_control_vehiculos" 
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
						<!--Autocomplete que contiene las ordenes de reparación internas activas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de reparación interna seleccionada-->
									<input id="txtOrdenReparacionInternaID_requisiciones_refacciones_internas_control_vehiculos" 
										   name="intOrdenReparacionInternaID_requisiciones_refacciones_internas_control_vehiculos"  type="hidden" 
										   value="">
									</input>
									<label for="txtOrdenReparacionInterna_requisiciones_refacciones_internas_control_vehiculos">No. de orden</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtOrdenReparacionInterna_requisiciones_refacciones_internas_control_vehiculos" 
											name="strOrdenReparacionInterna_requisiciones_refacciones_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese orden" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Referencia-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtReferencia_requisiciones_refacciones_internas_control_vehiculos">Vehículo/Serie</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtReferencia_requisiciones_refacciones_internas_control_vehiculos" 
											name="strReferencia_requisiciones_refacciones_internas_control_vehiculos" type="text" value="" disabled>
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
									<label for="txtObservaciones_requisiciones_refacciones_internas_control_vehiculos">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_requisiciones_refacciones_internas_control_vehiculos" 
											name="strObservaciones_requisiciones_refacciones_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
									<input id="txtNumDetalles_requisiciones_refacciones_internas_control_vehiculos" 
										   name="intNumDetalles_requisiciones_refacciones_internas_control_vehiculos" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la requisición</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene las refacciones activas-->
													<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id de la refacción seleccionada-->
																<input id="txtRefaccionID_detalles_requisiciones_refacciones_internas_control_vehiculos" 
																	   name="intRefaccionID_detalles_requisiciones_refacciones_internas_control_vehiculos"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta que se utiliza para recuperar el código de la refacción seleccionada-->
																<input id="txtCodigo_detalles_requisiciones_refacciones_internas_control_vehiculos" 
																	   name="strCodigo_detalles_requisiciones_refacciones_internas_control_vehiculos"  
																	   type="hidden" value="">
															    </input>
															     <!-- Caja de texto oculta que se utiliza para recuperar la descripción de la refacción seleccionada-->
																<input id="txtDescripcion_detalles_requisiciones_refacciones_internas_control_vehiculos" 
																	   name="strDescripcion_detalles_requisiciones_refacciones_internas_control_vehiculos"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta que se utiliza para recuperar el código de la línea de la refacción seleccionada-->
																<input id="txtCodigoLinea_detalles_requisiciones_refacciones_internas_control_vehiculos" 
																	   name="strCodigoLinea_detalles_requisiciones_refacciones_internas_control_vehiculos"  
																	   type="hidden" value="">
															    </input>
																<label for="txtRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos">
																	Refacción
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos" 
																		name="strRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos" type="text" value="" 
																		tabindex="1" placeholder="Ingrese refacción" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_requisiciones_refacciones_internas_control_vehiculos" 
																		id="txtCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos" 
																		name="intCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="14">
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_detalles_requisiciones_refacciones_internas_control_vehiculos"
					                                			onclick="agregar_renglon_detalles_requisiciones_refacciones_internas_control_vehiculos();" 
					                                	     	title="Agregar" tabindex="1"> 
					                                		<span class="glyphicon glyphicon-plus"></span>
					                                	</button>
					                             	</div>
												</div>
											</div>
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row ">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_requisiciones_refacciones_internas_control_vehiculos">
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
																<td class="movil t2">
																<td  class="movil t3">
																	<strong id="acumCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos"></strong>
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
																<strong id="numElementos_detalles_requisiciones_refacciones_internas_control_vehiculos">0</strong> encontrados
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
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_requisiciones_refacciones_internas_control_vehiculos"  
									onclick="validar_requisiciones_refacciones_internas_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_requisiciones_refacciones_internas_control_vehiculos"  
									onclick="reporte_registro_requisiciones_refacciones_internas_control_vehiculos('');"  title="Imprimir registro en PDF" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_requisiciones_refacciones_internas_control_vehiculos"  
									onclick="cambiar_estatus_requisiciones_refacciones_internas_control_vehiculos('','ACTIVO');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_requisiciones_refacciones_internas_control_vehiculos"  
									onclick="cambiar_estatus_requisiciones_refacciones_internas_control_vehiculos('','INACTIVO');"  title="Restaurar" tabindex="5" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_requisiciones_refacciones_internas_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_requisiciones_refacciones_internas_control_vehiculos();" 
									title="Cerrar"  tabindex="6">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#RequisicionesRefaccionesInternasControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaRequisicionesRefaccionesInternasControlVehiculos = 0;
		var strUltimaBusquedaRequisicionesRefaccionesInternasControlVehiculos = "";
		//Variables que se utilizan para la búsqueda de registros
		var intVehiculoIDRequisicionesRefaccionesInternasControlVehiculos = "";
		var dteFechaInicialRequisicionesRefaccionesInternasControlVehiculos = "";
		var dteFechaFinalRequisicionesRefaccionesInternasControlVehiculos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objRequisicionesRefaccionesInternasControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_requisiciones_refacciones_internas_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/requisiciones_refacciones_internas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_requisiciones_refacciones_internas_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRequisicionesRefaccionesInternasControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosRequisicionesRefaccionesInternasControlVehiculos = strPermisosRequisicionesRefaccionesInternasControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRequisicionesRefaccionesInternasControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRequisicionesRefaccionesInternasControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_requisiciones_refacciones_internas_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosRequisicionesRefaccionesInternasControlVehiculos[i]=='GUARDAR') || (arrPermisosRequisicionesRefaccionesInternasControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_requisiciones_refacciones_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosRequisicionesRefaccionesInternasControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_requisiciones_refacciones_internas_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_requisiciones_refacciones_internas_control_vehiculos();
						}
						else if(arrPermisosRequisicionesRefaccionesInternasControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_requisiciones_refacciones_internas_control_vehiculos').removeAttr('disabled');
							$('#btnRestaurar_requisiciones_refacciones_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosRequisicionesRefaccionesInternasControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_requisiciones_refacciones_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosRequisicionesRefaccionesInternasControlVehiculos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_requisiciones_refacciones_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosRequisicionesRefaccionesInternasControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_requisiciones_refacciones_internas_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_requisiciones_refacciones_internas_control_vehiculos() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaRequisicionesRefaccionesInternasControlVehiculos =($('#txtFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos').val()+$('#txtFechaFinalBusq_requisiciones_refacciones_internas_control_vehiculos').val()+$('#txtVehiculoIDBusq_requisiciones_refacciones_internas_control_vehiculos').val()+$('#cmbEstatusBusq_requisiciones_refacciones_internas_control_vehiculos').val()+$('#txtBusqueda_requisiciones_refacciones_internas_control_vehiculos').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaRequisicionesRefaccionesInternasControlVehiculos != strUltimaBusquedaRequisicionesRefaccionesInternasControlVehiculos)
			{
				intPaginaRequisicionesRefaccionesInternasControlVehiculos = 0;
				strUltimaBusquedaRequisicionesRefaccionesInternasControlVehiculos = strNuevaBusquedaRequisicionesRefaccionesInternasControlVehiculos;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/requisiciones_refacciones_internas/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_requisiciones_refacciones_internas_control_vehiculos').val()),
					 intVehiculoID: $('#txtVehiculoIDBusq_requisiciones_refacciones_internas_control_vehiculos').val(),
					 strEstatus:     $('#cmbEstatusBusq_requisiciones_refacciones_internas_control_vehiculos').val(),
					strBusqueda:    $('#txtBusqueda_requisiciones_refacciones_internas_control_vehiculos').val(),
					 intPagina: intPaginaRequisicionesRefaccionesInternasControlVehiculos,
					 strPermisosAcceso: $('#txtAcciones_requisiciones_refacciones_internas_control_vehiculos').val()
					},
					function(data){
						$('#dg_requisiciones_refacciones_internas_control_vehiculos tbody').empty();
						var tmpRequisicionesRefaccionesInternasControlVehiculos = Mustache.render($('#plantilla_requisiciones_refacciones_internas_control_vehiculos').html(),data);
						$('#dg_requisiciones_refacciones_internas_control_vehiculos tbody').html(tmpRequisicionesRefaccionesInternasControlVehiculos);
						$('#pagLinks_requisiciones_refacciones_internas_control_vehiculos').html(data.paginacion);
						$('#numElementos_requisiciones_refacciones_internas_control_vehiculos').html(data.total_rows);
						intPaginaRequisicionesRefaccionesInternasControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_requisiciones_refacciones_internas_control_vehiculos() 
		{
			//Asignar valores para la búsqueda de registros
			intVehiculoIDRequisicionesRefaccionesInternasControlVehiculos =  $('#txtVehiculoIDBusq_requisiciones_refacciones_internas_control_vehiculos').val();
			dteFechaInicialRequisicionesRefaccionesInternasControlVehiculos =  $.formatFechaMysql($('#txtFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos').val());
			dteFechaFinalRequisicionesRefaccionesInternasControlVehiculos =  $.formatFechaMysql($('#txtFechaFinalBusq_requisiciones_refacciones_internas_control_vehiculos').val());

			//Si no existe fecha inicial
			if(dteFechaInicialRequisicionesRefaccionesInternasControlVehiculos == '')
			{
				dteFechaInicialRequisicionesRefaccionesInternasControlVehiculos = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalRequisicionesRefaccionesInternasControlVehiculos == '')
			{
				dteFechaFinalRequisicionesRefaccionesInternasControlVehiculos =  '0000-00-00';
			}
			
			//Si no existe id del vehículo
			if(intVehiculoIDRequisicionesRefaccionesInternasControlVehiculos == '')
			{
				intVehiculoIDRequisicionesRefaccionesInternasControlVehiculos = 0;
			}

			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_requisiciones_refacciones_internas_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_requisiciones_refacciones_internas_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_requisiciones_refacciones_internas_control_vehiculos').val('NO');
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/requisiciones_refacciones_internas/get_reporte/"+dteFechaInicialRequisicionesRefaccionesInternasControlVehiculos+"/"+dteFechaFinalRequisicionesRefaccionesInternasControlVehiculos+"/"+intVehiculoIDRequisicionesRefaccionesInternasControlVehiculos+"/"+
				$('#cmbEstatusBusq_requisiciones_refacciones_internas_control_vehiculos').val()+"/"+
				$('#chbImprimirDetalles_requisiciones_refacciones_internas_control_vehiculos').val()+"/"+
				$('#txtBusqueda_requisiciones_refacciones_internas_control_vehiculos').val());
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_requisiciones_refacciones_internas_control_vehiculos(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtRequisicionRefaccionesInternasID_requisiciones_refacciones_internas_control_vehiculos').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/requisiciones_refacciones_internas/get_reporte_registro/"+intID);
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_requisiciones_refacciones_internas_control_vehiculos() 
		{
			//Asignar valores para la búsqueda de registros
			intVehiculoIDRequisicionesRefaccionesInternasControlVehiculos =  $('#txtVehiculoIDBusq_requisiciones_refacciones_internas_control_vehiculos').val();
			dteFechaInicialRequisicionesRefaccionesInternasControlVehiculos =  $.formatFechaMysql($('#txtFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos').val());
			dteFechaFinalRequisicionesRefaccionesInternasControlVehiculos =  $.formatFechaMysql($('#txtFechaFinalBusq_requisiciones_refacciones_internas_control_vehiculos').val());

			//Si no existe fecha inicial
			if(dteFechaInicialRequisicionesRefaccionesInternasControlVehiculos == '')
			{
				dteFechaInicialRequisicionesRefaccionesInternasControlVehiculos = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalRequisicionesRefaccionesInternasControlVehiculos == '')
			{
				dteFechaFinalRequisicionesRefaccionesInternasControlVehiculos =  '0000-00-00';
			}
			
			//Si no existe id del vehículo
			if(intVehiculoIDRequisicionesRefaccionesInternasControlVehiculos == '')
			{
				intVehiculoIDRequisicionesRefaccionesInternasControlVehiculos = 0;
			}

			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_requisiciones_refacciones_internas_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el archivo
			    $('#chbImprimirDetalles_requisiciones_refacciones_internas_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el archivo
			   $('#chbImprimirDetalles_requisiciones_refacciones_internas_control_vehiculos').val('NO');
			}

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("control_vehiculos/requisiciones_refacciones_internas/get_xls/"+dteFechaInicialRequisicionesRefaccionesInternasControlVehiculos+"/"+dteFechaFinalRequisicionesRefaccionesInternasControlVehiculos+"/"+intVehiculoIDRequisicionesRefaccionesInternasControlVehiculos+"/"+
				$('#cmbEstatusBusq_requisiciones_refacciones_internas_control_vehiculos').val()+"/"+
				$('#chbImprimirDetalles_requisiciones_refacciones_internas_control_vehiculos').val()+"/"+
				$('#txtBusqueda_requisiciones_refacciones_internas_control_vehiculos').val());
		}
		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_requisiciones_refacciones_internas_control_vehiculos()
		{
			//Incializar formulario
			$('#frmRequisicionesRefaccionesInternasControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_requisiciones_refacciones_internas_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmRequisicionesRefaccionesInternasControlVehiculos').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_requisiciones_refacciones_internas_control_vehiculos').val(fechaActual()); 
		    //Eliminar los datos de la tabla detalles de la requisición
		    $('#dg_detalles_requisiciones_refacciones_internas_control_vehiculos tbody').empty();
		    $('#acumCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos').html('');
			$('#numElementos_detalles_requisiciones_refacciones_internas_control_vehiculos').html(0);
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_requisiciones_refacciones_internas_control_vehiculos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_requisiciones_refacciones_internas_control_vehiculos').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_requisiciones_refacciones_internas_control_vehiculos').removeClass("estatus-INACTIVO");
			$('#divEncabezadoModal_requisiciones_refacciones_internas_control_vehiculos').removeClass("estatus-PARCIALMENTE_SURTIDO")
			$('#divEncabezadoModal_requisiciones_refacciones_internas_control_vehiculos').removeClass("estatus-SURTIDO");
			//Habilitar todos los elementos del formulario
			$('#frmRequisicionesRefaccionesInternasControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
	
			//Deshabilitar caja de texto
			$('#txtFolio_requisiciones_refacciones_internas_control_vehiculos').attr("disabled", "disabled");
			$('#txtReferencia_requisiciones_refacciones_internas_control_vehiculos').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_requisiciones_refacciones_internas_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_requisiciones_refacciones_internas_control_vehiculos").hide();
			$("#btnDesactivar_requisiciones_refacciones_internas_control_vehiculos").hide();
			$("#btnRestaurar_requisiciones_refacciones_internas_control_vehiculos").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_requisiciones_refacciones_internas_control_vehiculos()
		{
			try {
				//Cerrar modal
				objRequisicionesRefaccionesInternasControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_requisiciones_refacciones_internas_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_requisiciones_refacciones_internas_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmRequisicionesRefaccionesInternasControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_requisiciones_refacciones_internas_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strOrdenReparacionInterna_requisiciones_refacciones_internas_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la orden de reparación interna
					                                    if($('#txtOrdenReparacionInternaID_requisiciones_refacciones_internas_control_vehiculos').val() === '')
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
										intNumDetalles_requisiciones_refacciones_internas_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta requisición de refacciones.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_requisiciones_refacciones_internas_control_vehiculos = $('#frmRequisicionesRefaccionesInternasControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_requisiciones_refacciones_internas_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_requisiciones_refacciones_internas_control_vehiculos.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_requisiciones_refacciones_internas_control_vehiculos();
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_requisiciones_refacciones_internas_control_vehiculos()
		{
			try
			{
				$('#frmRequisicionesRefaccionesInternasControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_requisiciones_refacciones_internas_control_vehiculos()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_requisiciones_refacciones_internas_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRefaccionID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCodigosLineas = [];
			var arrCantidades = [];
		
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				
				//Asignar valores a los arrays
				arrRefaccionID.push(objRen.getAttribute('id'));
				arrCodigos.push(objRen.cells[0].innerHTML);
				arrDescripciones.push(objRen.cells[1].innerHTML);
				arrCantidades.push(intCantidad);
				arrCodigosLineas.push(objRen.cells[4].innerHTML);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/requisiciones_refacciones_internas/guardar',
					{ 
						//Datos de la requisición
						intRequisicionRefaccionesInternasID: $('#txtRequisicionRefaccionesInternasID_requisiciones_refacciones_internas_control_vehiculos').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_requisiciones_refacciones_internas_control_vehiculos').val()),
						intOrdenReparacionInternaID: $('#txtOrdenReparacionInternaID_requisiciones_refacciones_internas_control_vehiculos').val(),
						strObservaciones: $('#txtObservaciones_requisiciones_refacciones_internas_control_vehiculos').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_requisiciones_refacciones_internas_control_vehiculos').val(),
						//Datos de los detalles
						strRefaccionID: arrRefaccionID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strCodigosLineas: arrCodigosLineas.join('|'),
						strCantidades: arrCantidades.join('|')
					},
					function(data) {
						if (data.resultado)
						{
         					//Hacer un llamado a la función para cerrar modal
	                    	cerrar_requisiciones_refacciones_internas_control_vehiculos();
							//Hacer llamado a la función  para cargar  los registros en el grid
	               			paginacion_requisiciones_refacciones_internas_control_vehiculos();  
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_requisiciones_refacciones_internas_control_vehiculos(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_requisiciones_refacciones_internas_control_vehiculos(tipoMensaje, mensaje)
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
		function cambiar_estatus_requisiciones_refacciones_internas_control_vehiculos(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtRequisicionRefaccionesInternasID_requisiciones_refacciones_internas_control_vehiculos').val();

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
				              'title':    'Requisición de Refacciones',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('control_vehiculos/requisiciones_refacciones_internas/set_estatus',
				                                     {intRequisicionRefaccionesInternasID: intID,
				                                      strEstatus: estatus
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                          	//Hacer llamado a la función  para cargar  los registros en el grid
				                                          	paginacion_requisiciones_refacciones_internas_control_vehiculos();

				                                          	//Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_requisiciones_refacciones_internas_control_vehiculos();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_requisiciones_refacciones_internas_control_vehiculos(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('control_vehiculos/requisiciones_refacciones_internas/set_estatus',
				     {intRequisicionRefaccionesInternasID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función para cargar  los registros en el grid
							paginacion_requisiciones_refacciones_internas_control_vehiculos();

							//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_requisiciones_refacciones_internas_control_vehiculos();     
							}
						}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_requisiciones_refacciones_internas_control_vehiculos(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_requisiciones_refacciones_internas_control_vehiculos(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/requisiciones_refacciones_internas/get_datos',
			       {
			       		intRequisicionRefaccionesInternasID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_requisiciones_refacciones_internas_control_vehiculos();
							//Asignar estatus y reemplazar cadena vacia por '_'
				            var strEstatus = data.row.estatus;
							//Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				            //Variable que se utiliza para asignar la referencia (vehículo/serie)
					        var strReferencia = '';

					        //Si existe id del vehículo
							if(data.row.vehiculo_id > 0)
							{
								//Asignar datos del vehículo
								strReferencia =  data.row.vehiculo;
							}
							else
							{
								//Asignar serie
								strReferencia =  data.row.serie;
							}

				          	//Recuperar valores
				            $('#txtRequisicionRefaccionesInternasID_requisiciones_refacciones_internas_control_vehiculos').val(data.row.requisicion_refacciones_internas_id);
				            $('#txtFolio_requisiciones_refacciones_internas_control_vehiculos').val(data.row.folio);
				            $('#txtFecha_requisiciones_refacciones_internas_control_vehiculos').val(data.row.fecha);
				            $('#txtOrdenReparacionInternaID_requisiciones_refacciones_internas_control_vehiculos').val(data.row.orden_reparacion_interna_id);
				            $('#txtOrdenReparacionInterna_requisiciones_refacciones_internas_control_vehiculos').val(data.row.folio_orden_reparacion);
				            $('#txtReferencia_requisiciones_refacciones_internas_control_vehiculos').val(strReferencia);
						    $('#txtObservaciones_requisiciones_refacciones_internas_control_vehiculos').val(data.row.observaciones);
						    $('#txtEstatus_requisiciones_refacciones_internas_control_vehiculos').val(strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_requisiciones_refacciones_internas_control_vehiculos").show();

							//Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmRequisicionesRefaccionesInternasControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_requisiciones_refacciones_internas_control_vehiculos").hide();

					            //Si el estatus del registro es INACTIVO
				            	if(strEstatus == 'INACTIVO')
				            	{
				            		//Mostrar botón Restaurar
				            		$("#btnRestaurar_requisiciones_refacciones_internas_control_vehiculos").show();
				            	}

				            }
				            else
				            {
							    //Si el estatus del registro es ACTIVO
							    if(strEstatus == 'ACTIVO')
							    {

							    	strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalles_requisiciones_refacciones_internas_control_vehiculos(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_detalles_requisiciones_refacciones_internas_control_vehiculos(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

							    	//Mostrar botón Desactivar
				            		$("#btnDesactivar_requisiciones_refacciones_internas_control_vehiculos").show();
							    }
							    else
							    {
							    	strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
													 	" onclick='editar_renglon_detalles_requisiciones_refacciones_internas_control_vehiculos(this)'>" + 
													 	"<span class='glyphicon glyphicon-edit'></span></button>";

							    	//Deshabilitar todos los elementos del formulario
				            		$('#frmRequisicionesRefaccionesInternasControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
							    }

				            }

				            //Reemplazar cadena vacia por '_'
				            strEstatus = strEstatus.replace(" ", "_");
						    //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_requisiciones_refacciones_internas_control_vehiculos').addClass("estatus-"+strEstatus);

				           	//Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_requisiciones_refacciones_internas_control_vehiculos').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaCodigo = objRenglon.insertCell(0);
								var objCeldaDescripcion = objRenglon.insertCell(1);
								var objCeldaCantidad = objRenglon.insertCell(2);
								var objCeldaAcciones = objRenglon.insertCell(3);
								//Columnas ocultas
								var objCeldaCodigoLinea = objRenglon.insertCell(4);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].refaccion_id);
								objCeldaCodigo.setAttribute('class', 'movil b1');
								objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
								objCeldaDescripcion.setAttribute('class', 'movil b2');
								objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
								objCeldaCantidad.setAttribute('class', 'movil b3');
								objCeldaCantidad.innerHTML = formatMoney(data.detalles[intCon].cantidad, 2, '');
								objCeldaAcciones.setAttribute('class', 'td-center movil b4');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
								objCeldaCodigoLinea.innerHTML =  data.detalles[intCon].codigo_linea;
				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_requisiciones_refacciones_internas_control_vehiculos();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_requisiciones_refacciones_internas_control_vehiculos tr").length - 2;
							$('#numElementos_detalles_requisiciones_refacciones_internas_control_vehiculos').html(intFilas);
							$('#txtNumDetalles_requisiciones_refacciones_internas_control_vehiculos').val(intFilas);

			            	//Abrir modal
				            objRequisicionesRefaccionesInternasControlVehiculos = $('#RequisicionesRefaccionesInternasControlVehiculosBox').bPopup({
														  appendTo: '#RequisicionesRefaccionesInternasControlVehiculosContent', 
							                              contentContainer: 'RequisicionesRefaccionesInternasControlVehiculosM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtOrdenReparacionInterna_requisiciones_refacciones_internas_control_vehiculos').focus();
			       	    }
			       },
			       'json');
		}

		

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_requisiciones_refacciones_internas_control_vehiculos()
		{
			//Limpiamos las cajas de texto
			$('#txtRefaccionID_detalles_requisiciones_refacciones_internas_control_vehiculos').val('');
			$('#txtRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos').val('');
			$('#txtCodigo_detalles_requisiciones_refacciones_internas_control_vehiculos').val('');
			$('#txtDescripcion_detalles_requisiciones_refacciones_internas_control_vehiculos').val('');
			$('#txtCodigoLinea_detalles_requisiciones_refacciones_internas_control_vehiculos').val('');
			$('#txtCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos').val('');
		}

		//Función para regresar obtener los datos de una refacción
		function get_datos_refaccion_detalles_requisiciones_refacciones_internas_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los datos de la refacción
	        $.post('refacciones/refacciones/get_datos',
	              { 
	              	strBusqueda:$("#txtRefaccionID_detalles_requisiciones_refacciones_internas_control_vehiculos").val(),
		       		strTipo: 'id'
	              },
	              function(data) {
	                if(data.row){
	               	    $("#txtDescripcion_detalles_requisiciones_refacciones_internas_control_vehiculos").val(data.row.descripcion);
	                    $("#txtCodigoLinea_detalles_requisiciones_refacciones_internas_control_vehiculos").val(data.row.codigo_linea);
	                    //Enfocar caja de texto
	              	    $("#txtCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos").focus();
	                }
	              }
	             ,
	            'json');
		}


		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_requisiciones_refacciones_internas_control_vehiculos()
		{
			//Obtenemos los datos de las cajas de texto
			var intRefaccionID = $('#txtRefaccionID_detalles_requisiciones_refacciones_internas_control_vehiculos').val();
			var strRefaccion = $('#txtRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos').val();
			var strCodigo = $('#txtCodigo_detalles_requisiciones_refacciones_internas_control_vehiculos').val();
			var strDescripcion = $('#txtDescripcion_detalles_requisiciones_refacciones_internas_control_vehiculos').val();
			var strCodigoLinea = $('#txtCodigoLinea_detalles_requisiciones_refacciones_internas_control_vehiculos').val();
			var intCantidad = $('#txtCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos').val();
		
			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_requisiciones_refacciones_internas_control_vehiculos').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intRefaccionID == '' || strRefaccion == '')
			{
				//Enfocar caja de texto
				$('#txtRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos').focus();
			}
			else if (intCantidad == '')
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos').focus();
			}
			else
			{
	            //Hacer un llamado a la función para inicializar elementos de la refacción
	            inicializar_refaccion_detalles_requisiciones_refacciones_internas_control_vehiculos();

	            //Cambiar cantidad a  formato moneda (a visualizar)
				intCantidad =  formatMoney(intCantidad, 2, '');

			

				//Revisamos si existe el ID proporcionado, si es así, editamos los datos
				if (objTabla.rows.namedItem(intRefaccionID))
				{
					objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = intCantidad;
					objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML = strCodigoLinea;
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCodigo = objRenglon.insertCell(0);
					var objCeldaDescripcion = objRenglon.insertCell(1);
					var objCeldaCantidad = objRenglon.insertCell(2);
					var objCeldaAcciones = objRenglon.insertCell(3);
					//Columnas ocultas
					var objCeldaCodigoLinea = objRenglon.insertCell(4);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRefaccionID);
					objCeldaCodigo.setAttribute('class', 'movil b1');
					objCeldaCodigo.innerHTML = strCodigo;
					objCeldaDescripcion.setAttribute('class', 'movil b2');
					objCeldaDescripcion.innerHTML = strDescripcion;
					objCeldaCantidad.setAttribute('class', 'movil b3');
					objCeldaCantidad.innerHTML = intCantidad;
					objCeldaAcciones.setAttribute('class', 'td-center movil b4');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_requisiciones_refacciones_internas_control_vehiculos(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_requisiciones_refacciones_internas_control_vehiculos(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
					objCeldaCodigoLinea.innerHTML =  strCodigoLinea;
				}

				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_requisiciones_refacciones_internas_control_vehiculos();
				
				//Enfocar caja de texto
				$('#txtCodigo_detalles_requisiciones_refacciones_internas_control_vehiculos').focus();
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_requisiciones_refacciones_internas_control_vehiculos tr").length - 2;
			$('#numElementos_detalles_requisiciones_refacciones_internas_control_vehiculos').html(intFilas);
			$('#txtNumDetalles_requisiciones_refacciones_internas_control_vehiculos').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_requisiciones_refacciones_internas_control_vehiculos(objRenglon)
		{
			//Variable que se utiliza para asignar el código de la refacción
			var strCodigo = objRenglon.parentNode.parentNode.cells[0].innerHTML;
			//Variable que se utiliza para asignar la descripción de la refacción
			var strDescripcion = objRenglon.parentNode.parentNode.cells[1].innerHTML;
			//Variable que se utiliza para concatenar los datos de la refacción 
			var strRefaccion = strCodigo+' - '+strDescripcion;

			//Asignar los valores a las cajas de texto
			$('#txtRefaccionID_detalles_requisiciones_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos').val(strRefaccion);
			$('#txtCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtCodigoLinea_detalles_requisiciones_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
			//Enfocar caja de texto
			$('#txtCodigo_detalles_requisiciones_refacciones_internas_control_vehiculos').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_requisiciones_refacciones_internas_control_vehiculos(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_requisiciones_refacciones_internas_control_vehiculos").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_requisiciones_refacciones_internas_control_vehiculos();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_requisiciones_refacciones_internas_control_vehiculos tr").length - 2;
			$('#numElementos_detalles_requisiciones_refacciones_internas_control_vehiculos').html(intFilas);
			$('#txtNumDetalles_requisiciones_refacciones_internas_control_vehiculos').val(intFilas);

			//Enfocar caja de texto
			$('#txtCodigo_detalles_requisiciones_refacciones_internas_control_vehiculos').focus();
		}

		
		//Función para calcular totales de la tabla
		function calcular_totales_detalles_requisiciones_refacciones_internas_control_vehiculos()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_requisiciones_refacciones_internas_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				
			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Asignar los valores
			$('#acumCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos').html(intAcumUnidades);
		}

	
		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos').numeric();

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_requisiciones_refacciones_internas_control_vehiculos').blur(function(){
                $('.cantidad_requisiciones_refacciones_internas_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_requisiciones_refacciones_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});

	        //Autocomplete para recuperar los datos de una orden de reparación interna 
	        $('#txtOrdenReparacionInterna_requisiciones_refacciones_internas_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtOrdenReparacionInternaID_requisiciones_refacciones_internas_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/ordenes_reparacion_internas/autocomplete",
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
	              $('#txtOrdenReparacionInternaID_requisiciones_refacciones_internas_control_vehiculos').val(ui.item.data);
	              $('#txtReferencia_requisiciones_refacciones_internas_control_vehiculos').val(ui.item.referencia);
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
	        $('#txtOrdenReparacionInterna_requisiciones_refacciones_internas_control_vehiculos').focusout(function(e){
	            //Si no existe id de la orden de reparación interna
	            if($('#txtOrdenReparacionInternaID_requisiciones_refacciones_internas_control_vehiculos').val() == '' ||
	               $('#txtOrdenReparacionInterna_requisiciones_refacciones_internas_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtOrdenReparacionInternaID_requisiciones_refacciones_internas_control_vehiculos').val('');
	               $('#txtOrdenReparacionInterna_requisiciones_refacciones_internas_control_vehiculos').val('');
	               $('#txtReferencia_requisiciones_refacciones_internas_control_vehiculos').val('');
	            }

	        });
	     

	        //Autocomplete para recuperar los datos de una refacción
	        $('#txtRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtRefaccionID_detalles_requisiciones_refacciones_internas_control_vehiculos').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones/autocomplete",
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
	                $('#txtRefaccionID_detalles_requisiciones_refacciones_internas_control_vehiculos').val(ui.item.data);
	                //Hacer un llamado a la función para regresar los datos de la refacción
	               	get_datos_refaccion_detalles_requisiciones_refacciones_internas_control_vehiculos();
	               	//Asignar el código de la refacción
	               	$('#txtCodigo_detalles_requisiciones_refacciones_internas_control_vehiculos').val(ui.item.value.split(" - ")[0]);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la refacción cuando pierda el enfoque la caja de texto
	        $('#txtRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos').focusout(function(e){
	            //Si no existe id de la refacción
	            if($('#txtRefaccionID_detalles_requisiciones_refacciones_internas_control_vehiculos').val() == '' ||
	               $('#txtRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos').val() == '')
	            { 
	               	//Hacer un llamado a la función para inicializar elementos de la refacción
	              	inicializar_refaccion_detalles_requisiciones_refacciones_internas_control_vehiculos();
	            }

	        });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_requisiciones_refacciones_internas_control_vehiculos').on('click','button.btn',function(){
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

	        //Validar que exista refacción cuando se pulse la tecla enter 
			$('#txtRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
			   	    //Si no existe refacción
		            if($('#txtRefaccionID_detalles_requisiciones_refacciones_internas_control_vehiculos').val() == '' || $('#txtRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtRefaccion_detalles_requisiciones_refacciones_internas_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_requisiciones_refacciones_internas_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_detalles_requisiciones_refacciones_internas_control_vehiculos();
			   	    }
		        }
		    });

		
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_requisiciones_refacciones_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_requisiciones_refacciones_internas_control_vehiculos').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_requisiciones_refacciones_internas_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un vehículo 
	        $('#txtVehiculoBusq_requisiciones_refacciones_internas_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoIDBusq_requisiciones_refacciones_internas_control_vehiculos').val('');
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
	             $('#txtVehiculoIDBusq_requisiciones_refacciones_internas_control_vehiculos').val(ui.item.data);
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
	        $('#txtVehiculoBusq_requisiciones_refacciones_internas_control_vehiculos').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoIDBusq_requisiciones_refacciones_internas_control_vehiculos').val() == '' ||
	               $('#txtVehiculoBusq_requisiciones_refacciones_internas_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVehiculoIDBusq_requisiciones_refacciones_internas_control_vehiculos').val('');
	               $('#txtVehiculoBusq_requisiciones_refacciones_internas_control_vehiculos').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_requisiciones_refacciones_internas_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaRequisicionesRefaccionesInternasControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_requisiciones_refacciones_internas_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_requisiciones_refacciones_internas_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_requisiciones_refacciones_internas_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_requisiciones_refacciones_internas_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				 objRequisicionesRefaccionesInternasControlVehiculos = $('#RequisicionesRefaccionesInternasControlVehiculosBox').bPopup({
												   appendTo: '#RequisicionesRefaccionesInternasControlVehiculosContent', 
					                               contentContainer: 'RequisicionesRefaccionesInternasControlVehiculosM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtOrdenReparacionInterna_requisiciones_refacciones_internas_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_requisiciones_refacciones_internas_control_vehiculos').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_requisiciones_refacciones_internas_control_vehiculos();

		});
	</script>