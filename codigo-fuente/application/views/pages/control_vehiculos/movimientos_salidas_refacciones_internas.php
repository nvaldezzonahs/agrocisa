
	<div id="MovimientosSalidasRefaccionesInternasControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_movimientos_salidas_refacciones_internas_control_vehiculos" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_movimientos_salidas_refacciones_internas_control_vehiculos">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_movimientos_salidas_refacciones_internas_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_movimientos_salidas_refacciones_internas_control_vehiculos"
				                    		name= "strFechaInicialBusq_movimientos_salidas_refacciones_internas_control_vehiculos" 
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
								<label for="txtFechaFinalBusq_movimientos_salidas_refacciones_internas_control_vehiculos">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_movimientos_salidas_refacciones_internas_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_movimientos_salidas_refacciones_internas_control_vehiculos"
				                    		name= "strFechaFinalBusq_movimientos_salidas_refacciones_internas_control_vehiculos" 
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
								<input id="txtVehiculoIDBusq_movimientos_salidas_refacciones_internas_control_vehiculos" 
									   name="intVehiculoIDBusq_movimientos_salidas_refacciones_internas_control_vehiculos"  type="hidden" 
									   value="">
								</input>
								<label for="txtVehiculoBusq_movimientos_salidas_refacciones_internas_control_vehiculos">Vehículo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtVehiculoBusq_movimientos_salidas_refacciones_internas_control_vehiculos" 
										name="strVehiculoBusq_movimientos_salidas_refacciones_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese vehículo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_movimientos_salidas_refacciones_internas_control_vehiculos">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_movimientos_salidas_refacciones_internas_control_vehiculos" 
								 		name="strEstatusBusq_movimientos_salidas_refacciones_internas_control_vehiculos" tabindex="1">
								    <option value="TODOS">TODOS</option>
					  				<option value="ACTIVO">ACTIVO</option>
					  				<option value="INACTIVO">INACTIVO</option>
					  				<option value="GENERAR POLIZA">GENERAR PÓLIZA</option>
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
								<label for="txtBusqueda_movimientos_salidas_refacciones_internas_control_vehiculos">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_movimientos_salidas_refacciones_internas_control_vehiculos" 
										name="strBusqueda_movimientos_salidas_refacciones_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
									   	name="strImprimirDetalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
									   	type="checkbox" value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!-- Buscar registros -->
							<button class="btn btn-primary" id="btnBuscar_movimientos_salidas_refacciones_internas_control_vehiculos"
									onclick="paginacion_movimientos_salidas_refacciones_internas_control_vehiculos();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_movimientos_salidas_refacciones_internas_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_movimientos_salidas_refacciones_internas_control_vehiculos"
									onclick="reporte_movimientos_salidas_refacciones_internas_control_vehiculos('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_movimientos_salidas_refacciones_internas_control_vehiculos"
									onclick="reporte_movimientos_salidas_refacciones_internas_control_vehiculos('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla movimientos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Requisición"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Orden"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Vehículo/Serie"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles del movimiento
				*/
				td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Solicitado"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Surtido"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Costo Unit."; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles del movimiento
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Solicitado"; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: "Surtido"; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.t6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_movimientos_salidas_refacciones_internas_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Requisición</th>
							<th class="movil">Orden</th>
							<th class="movil">Vehículo/Serie</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_movimientos_salidas_refacciones_internas_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{folio_requisicion}}</td>
							<td class="movil a4">{{folio_orden_reparacion}}</td>
							<td class="movil a5">{{referencia_orden_reparacion}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_movimientos_salidas_refacciones_internas_control_vehiculos({{movimiento_refacciones_internas_id}}, 'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_movimientos_salidas_refacciones_internas_control_vehiculos({{movimiento_refacciones_internas_id}}, 'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_movimientos_salidas_refacciones_internas_control_vehiculos({{movimiento_refacciones_internas_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
								</button>
								 <!--Generar póliza-->
                                <button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
                                        onclick="generar_poliza_movimientos_salidas_refacciones_internas_control_vehiculos({{movimiento_refacciones_internas_id}}, 'principal')"  title="Generar póliza">
                                    <span class="glyphicon glyphicon-tags"></span>
                                </button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_movimientos_salidas_refacciones_internas_control_vehiculos({{movimiento_refacciones_internas_id}}, {{referencia_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_salidas_refacciones_internas_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_movimientos_salidas_refacciones_internas_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
        <div id="divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_internas_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
            <div class="loader">Loading...</div>
            <br><br>
            <div align=center><b>Espere un momento por favor.</b></div>
        </div>  

		<!-- Diseño del modal-->
		<div id="MovimientosSalidasRefaccionesInternasControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_movimientos_salidas_refacciones_internas_control_vehiculos"  class="ModalBodyTitle">
			<h1>Salida de Refacciones Internas</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMovimientosSalidasRefaccionesInternasControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMovimientosSalidasRefaccionesInternasControlVehiculos"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!-- Folio -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos" 
										   name="intMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos" 
										   type="hidden" value="" />
								    <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
                                    <input id="txtPolizaID_movimientos_salidas_refacciones_internas_control_vehiculos" 
                                           name="intPolizaID_movimientos_salidas_refacciones_internas_control_vehiculos" type="hidden" value="" />
                                    <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
                                    <input id="txtFolioPoliza_movimientos_salidas_refacciones_internas_control_vehiculos" 
                                           name="strFolioPoliza_movimientos_salidas_refacciones_internas_control_vehiculos" type="hidden" value="" />
									<label for="txtFolio_movimientos_salidas_refacciones_internas_control_vehiculos">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_movimientos_salidas_refacciones_internas_control_vehiculos" 
											name="strFolio_movimientos_salidas_refacciones_internas_control_vehiculos" 
											type="text" value="" placeholder="Autogenerado" disabled />
								</div>
							</div>
						</div>
						<!-- Fecha -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_movimientos_salidas_refacciones_internas_control_vehiculos">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_movimientos_salidas_refacciones_internas_control_vehiculos'>
					                    <input class="form-control" 
					                    		id="txtFecha_movimientos_salidas_refacciones_internas_control_vehiculos"
					                    		name= "strFecha_movimientos_salidas_refacciones_internas_control_vehiculos" 
					                    		type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene las requisiciones de refacciones activas y parcialmente surtidas-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la requisición de refacciones internas seleccionada-->
									<input id="txtRequisicionRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos" 
										   name="intRequisicionRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos"  
										   type="hidden"  value="">
									</input>
									<label for="txtRequisicionRefaccionesInternas_movimientos_salidas_refacciones_internas_control_vehiculos">Requisición</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtRequisicionRefaccionesInternas_movimientos_salidas_refacciones_internas_control_vehiculos" 
											name="strRequisicionRefaccionesInternas_movimientos_salidas_refacciones_internas_control_vehiculos" 
											type="text" value="" tabindex="1" placeholder="Ingrese requisición" maxlength="250" />
								</div>
							</div>	
						</div>
						<!--Orden de reparación -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtOrdenReparacionInterna_movimientos_salidas_refacciones_internas_control_vehiculos">No. de orden</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtOrdenReparacionInterna_movimientos_salidas_refacciones_internas_control_vehiculos" 
											name="strOrdenReparacionInterna_movimientos_salidas_refacciones_internas_control_vehiculos" 
											type="text" value="" disabled />
								</div>
							</div>
						</div>
						<!--Vehiculo-->
						<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtReferenciaOrden_movimientos_salidas_refacciones_internas_control_vehiculos">Vehículo/Serie</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtReferenciaOrden_movimientos_salidas_refacciones_internas_control_vehiculos" 
											name="strReferenciaOrden_movimientos_salidas_refacciones_internas_control_vehiculos" 
											type="text" value="" disabled />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- Observaciones -->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_movimientos_salidas_refacciones_internas_control_vehiculos">Observaciones</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtObservaciones_movimientos_salidas_refacciones_internas_control_vehiculos" 
											name="strObservaciones_movimientos_salidas_refacciones_internas_control_vehiculos" 
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
									<input id="txtNumDetalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
										   name="intNumDetalles_movimientos_salidas_refacciones_internas_control_vehiculos" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la salida de refacciones internas</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Código-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el renglón de la refacción-->
																<input id="txtRenglon_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																	   name="intRenglon_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar la cantidad solicitada de la refacción-->
																<input id="txtCantidadSolicitada_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																	   name="intCantidadSolicitada_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar la cantidad pendiente de la refacción-->
																<input id="txtCantidadPendiente_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																	   name="intCantidadPendiente_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar la existencia actual de la refacción (en el inventario)  seleccionada-->
                                                                <input id="txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
                                                                       name="intActualExistencia_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
                                                                       type="hidden" value="">
																<label for="txtCodigo_detalles_movimientos_salidas_refacciones_internas_control_vehiculos">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																		name="strCodigo_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																		type="text" value="" disabled />
															</div>
														</div>
													</div>
													<!--Descripción-->
													<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDescripcion_detalles_movimientos_salidas_refacciones_internas_control_vehiculos">
																	Descripción
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtDescripcion_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																		name="strDescripcion_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																		type="text" value="" disabled/>
															</div>
														</div>
													</div>
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_movimientos_salidas_refacciones_internas_control_vehiculos" 
																		id="txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																		name="intCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="14" />
															</div>
														</div>
													</div>
													<!--Costo unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_control_vehiculos">Costo unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																		name="intCostoUnitario_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
																		type="text" value="" disabled />
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                               <div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_detalles_movimientos_salidas_refacciones_internas_control_vehiculos" 
					                                			onclick="agregar_renglon_detalles_movimientos_salidas_refacciones_internas_control_vehiculos();" 
					                                	     	title="Agregar" tabindex="1"> 
					                                		<span class="glyphicon glyphicon-plus"></span>
					                                	</button>
					                             	</div>
												</div>
											</div>
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_movimientos_salidas_refacciones_internas_control_vehiculos">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Código</th>
																<th class="movil">Descripción</th>
																<th class="movil">Solicitado</th>
																<th class="movil">Surtido</th>
																<th class="movil">Costo Unit.</th>
																<th class="movil">Subtotal</th>
																<th class="movil" id="th-acciones" style="width:6em;">Acciones</th>
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
																	<strong id="acumSolicitado_detalles_movimientos_salidas_refacciones_internas_control_vehiculos"></strong>
																</td>
																<td class="movil t4">
																	<strong id="acumSurtido_detalles_movimientos_salidas_refacciones_internas_control_vehiculos"></strong>
																</td>
																<td class="movil t5"></td>
																<td class="movil t6">
																	<strong id="acumSubtotal_detalles_movimientos_salidas_refacciones_internas_control_vehiculos"></strong>
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
																<strong id="numElementos_detalles_movimientos_salidas_refacciones_internas_control_vehiculos">0</strong> encontrados
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
					 <!--Circulo de progreso-->
                    <div id="divCirculoBarProgreso_movimientos_salidas_refacciones_internas_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
                        <div class="loader">Loading...</div>
                        <br><br>
                        <div align=center><b>Espere un momento por favor.</b></div>
                    </div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_movimientos_salidas_refacciones_internas_control_vehiculos"  
									onclick="validar_movimientos_salidas_refacciones_internas_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_movimientos_salidas_refacciones_internas_control_vehiculos"  
									onclick="reporte_registro_movimientos_salidas_refacciones_internas_control_vehiculos('');"  
									title="Imprimir" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_movimientos_salidas_refacciones_internas_control_vehiculos"  
									onclick="cambiar_estatus_movimientos_salidas_refacciones_internas_control_vehiculos('', '', '', '');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_movimientos_salidas_refacciones_internas_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_movimientos_salidas_refacciones_internas_control_vehiculos();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MovimientosSalidasRefaccionesInternasControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMovimientosSalidasRefaccionesInternasControlVehiculos = 0;
		var strUltimaBusquedaMovimientosSalidasRefaccionesInternasControlVehiculos = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
        var strTipoReferenciaMovimientosSalidasRefaccionesInternasControlVehiculos = "MOVIMIENTO DE REFACCIONES INTERNAS";

		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
        var intNumDecimalesMostrarMovimientosSalidasRefaccionesInternasControlVehiculos = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
        //Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
        var intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesInternasControlVehiculos = <?php echo NUM_DECIMALES_COSTO_UNIT_MOV_REFACCIONES ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objMovimientosSalidasRefaccionesInternasControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_movimientos_salidas_refacciones_internas_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/movimientos_salidas_refacciones_internas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_internas_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMovimientosSalidasRefaccionesInternasControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosMovimientosSalidasRefaccionesInternasControlVehiculos = strPermisosMovimientosSalidasRefaccionesInternasControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMovimientosSalidasRefaccionesInternasControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMovimientosSalidasRefaccionesInternasControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_movimientos_salidas_refacciones_internas_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMovimientosSalidasRefaccionesInternasControlVehiculos[i]=='GUARDAR') || (arrPermisosMovimientosSalidasRefaccionesInternasControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_movimientos_salidas_refacciones_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesInternasControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_movimientos_salidas_refacciones_internas_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_movimientos_salidas_refacciones_internas_control_vehiculos();
						}
						else if(arrPermisosMovimientosSalidasRefaccionesInternasControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_movimientos_salidas_refacciones_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesInternasControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_movimientos_salidas_refacciones_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesInternasControlVehiculos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_movimientos_salidas_refacciones_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesInternasControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_movimientos_salidas_refacciones_internas_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_movimientos_salidas_refacciones_internas_control_vehiculos() 
		{
		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaMovimientosSalidasRefaccionesInternasControlVehiculos =($('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val()+$('#txtFechaFinalBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val()+$('#txtVehiculoIDBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val()+$('#cmbEstatusBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val()+$('#txtBusqueda_movimientos_salidas_refacciones_internas_control_vehiculos').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaMovimientosSalidasRefaccionesInternasControlVehiculos != strUltimaBusquedaMovimientosSalidasRefaccionesInternasControlVehiculos)
			{
				intPaginaMovimientosSalidasRefaccionesInternasControlVehiculos = 0;
				strUltimaBusquedaMovimientosSalidasRefaccionesInternasControlVehiculos = strNuevaBusquedaMovimientosSalidasRefaccionesInternasControlVehiculos;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/movimientos_salidas_refacciones_internas/get_paginacion',
					{ //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					  dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val()),
					  dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val()),
					  intVehiculoID: $('#txtVehiculoIDBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val(),
					  strEstatus:     $('#cmbEstatusBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val(),
					  strBusqueda:    $('#txtBusqueda_movimientos_salidas_refacciones_internas_control_vehiculos').val(),
					  intPagina: intPaginaMovimientosSalidasRefaccionesInternasControlVehiculos,
					  strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_internas_control_vehiculos').val()
					},
					function(data){
						$('#dg_movimientos_salidas_refacciones_internas_control_vehiculos tbody').empty();
						var tmpMovimientosSalidasRefaccionesInternasControlVehiculos = Mustache.render($('#plantilla_movimientos_salidas_refacciones_internas_control_vehiculos').html(),data);
						$('#dg_movimientos_salidas_refacciones_internas_control_vehiculos tbody').html(tmpMovimientosSalidasRefaccionesInternasControlVehiculos);
						$('#pagLinks_movimientos_salidas_refacciones_internas_control_vehiculos').html(data.paginacion);
						$('#numElementos_movimientos_salidas_refacciones_internas_control_vehiculos').html(data.total_rows);
						intPaginaMovimientosSalidasRefaccionesInternasControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_movimientos_salidas_refacciones_internas_control_vehiculos(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'control_vehiculos/movimientos_salidas_refacciones_internas/';

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

			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_control_vehiculos').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val()),
										'intVehiculoID': $('#txtVehiculoIDBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val(),
										'strEstatus': $('#cmbEstatusBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val(), 
										'strBusqueda': $('#txtBusqueda_movimientos_salidas_refacciones_internas_control_vehiculos').val(),
										'strDetalles': $('#chbImprimirDetalles_movimientos_salidas_refacciones_internas_control_vehiculos').val()		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_movimientos_salidas_refacciones_internas_control_vehiculos(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'control_vehiculos/movimientos_salidas_refacciones_internas/get_reporte_registro',
							'data' : {
										'intMovimientoRefaccionesInternasID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_movimientos_salidas_refacciones_internas_control_vehiculos()
		{
			//Incializar formulario
			$('#frmMovimientosSalidasRefaccionesInternasControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_salidas_refacciones_internas_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmMovimientosSalidasRefaccionesInternasControlVehiculos').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_movimientos_salidas_refacciones_internas_control_vehiculos').val(fechaActual()); 
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_movimientos_salidas_refacciones_internas_control_vehiculos();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
            $.removerClasesEncabezado('divEncabezadoModal_movimientos_salidas_refacciones_internas_control_vehiculos');
			//Habilitar todos los elementos del formulario
			$('#frmMovimientosSalidasRefaccionesInternasControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$("#txtMoneda_movimientos_salidas_refacciones_internas_control_vehiculos").attr('disabled','disabled');
			$("#txtTipoCambio_movimientos_salidas_refacciones_internas_control_vehiculos").attr('disabled','disabled');
			$('#txtFolio_movimientos_salidas_refacciones_internas_control_vehiculos').attr("disabled", "disabled");
			$('#txtOrdenReparacionInterna_movimientos_salidas_refacciones_internas_control_vehiculos').attr("disabled", "disabled");
			$('#txtReferenciaOrden_movimientos_salidas_refacciones_internas_control_vehiculos').attr("disabled", "disabled");
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').attr("disabled", "disabled");
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').attr("disabled", "disabled");
			$('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').attr("disabled", "disabled");
			 //Habilitar botón Agregar
            $('#btnAgregar_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').prop('disabled', false);
 			//Mostrar los siguientes botones
			$("#btnGuardar_movimientos_salidas_refacciones_internas_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_movimientos_salidas_refacciones_internas_control_vehiculos").hide();
			$("#btnDesactivar_movimientos_salidas_refacciones_internas_control_vehiculos").hide();
		}

	
		//Función para inicializar elementos de la requisición de refacciones internas
		function inicializar_requisicion_refacciones_movimientos_salidas_refacciones_internas_control_vehiculos()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtOrdenReparacionInterna_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
            $('#txtReferenciaOrden_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_movimientos_salidas_refacciones_internas_control_vehiculos();
           
		}
																	
		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_movimientos_salidas_refacciones_internas_control_vehiculos()
		{
			//Hacer un llamado a la función para inicializar elementos de la refacción
			inicializar_refaccion_detalles_movimientos_salidas_refacciones_internas_control_vehiculos();
			//Eliminar los datos de la tabla detalles del movimiento
			$('#dg_detalles_movimientos_salidas_refacciones_internas_control_vehiculos tbody').empty();
			$('#acumSolicitado_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').html('');
		    $('#acumSurtido_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').html('');
		    $('#acumSubtotal_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').html('');
		    $('#numElementos_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').html(0);
			$('#txtNumDetalles_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_movimientos_salidas_refacciones_internas_control_vehiculos()
		{
			try {

				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_movimientos_salidas_refacciones_internas_control_vehiculos('');
				//Cerrar modal
				objMovimientosSalidasRefaccionesInternasControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_movimientos_salidas_refacciones_internas_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_salidas_refacciones_internas_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmMovimientosSalidasRefaccionesInternasControlVehiculos')
				.bootstrapValidator({	excluded: [':disabled'],
									 	container: 'popover',
									 	feedbackIcons: {
									 		valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
									  	},
									  	fields: {
											strFecha_movimientos_salidas_refacciones_internas_control_vehiculos: {
												validators: {
													notEmpty: {message: 'Seleccione una fecha'}
												}
											},
											strRequisicionRefaccionesInternas_movimientos_salidas_refacciones_internas_control_vehiculos: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la requisición de refacciones internas
						                                    if($('#txtRequisicionRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val() === '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba una requisición existente'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
											intNumDetalles_movimientos_salidas_refacciones_internas_control_vehiculos: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que existan detalles
						                                    if(parseFloat(value) === 0 || value === '')
						                                    {
						                                    	return {
						                                            valid: false,
						                                            message: 'Agregar al menos una refacción surtida para esta salida.'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
										    intCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    }
										}
									});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_movimientos_salidas_refacciones_internas_control_vehiculos = $('#frmMovimientosSalidasRefaccionesInternasControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_movimientos_salidas_refacciones_internas_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_movimientos_salidas_refacciones_internas_control_vehiculos.isValid())
			{

				//Hacer un llamado a la función para guardar los datos del registro
				guardar_movimientos_salidas_refacciones_internas_control_vehiculos();
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_movimientos_salidas_refacciones_internas_control_vehiculos()
		{
			try
			{
				$('#frmMovimientosSalidasRefaccionesInternasControlVehiculos').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_movimientos_salidas_refacciones_internas_control_vehiculos()
		{
			//Variable que se utiliza para asignar el acumulado de las refacciones surtidas
			var intAcumSurtidoDetallesMovimiento = 0;

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRenglon = [];
			var arrRefaccionID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCodigosLineas = [];
			var arrCantidades = [];
			var arrCostosUnitarios = [];
			var arrBackOrderInternoID = [];
			var arrCantidadesBackOrder = [];
			var arrEstatusBackOrder = [];
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioMovimiento = parseFloat($('#txtTipoCambio_movimientos_salidas_refacciones_internas_control_vehiculos').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidadSolicitada =  parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				var intCantidad =  parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				var intCostoUnitario = $.reemplazar(objRen.cells[11].innerHTML, ",", "");
				var intCantidadBackOrder = parseFloat(objRen.cells[8].innerHTML);
				//Variable que se utiliza para asignar la cantidad surtida
				var intCantidadSurtida = 0;
				//Variable que se utiliza para asignar la cantidad que esta pendiente
				var intCantidadPendiente = 0;
				//Variable que se utiliza para asignar el estatus del pedido pendiente
				var strEstatusPedido = 'ACTIVO';

				//Calcular la cantidad surtida
				intCantidadSurtida = (intCantidadSolicitada - intCantidadBackOrder) + intCantidad;

				//Si existe cantidad a surtir
				if(intCantidad > 0)
				{

					//Calcular la cantidad pendiente por surtir
					intCantidadPendiente = intCantidadBackOrder - intCantidad;


					//Si no existe cantidad pendiente por surtir
					if(intCantidadPendiente == 0)
					{
						//Cambiar el estatus del pedido pendiente
						strEstatusPedido = 'SURTIDO';
					}

					//Asignar valores a los arrays
					arrRenglon.push(objRen.getAttribute('id'));
					arrRefaccionID.push(objRen.cells[9].innerHTML);
					arrCodigos.push(objRen.cells[0].innerHTML);
					arrDescripciones.push(objRen.cells[1].innerHTML);
					arrCodigosLineas.push(objRen.cells[10].innerHTML);
					arrCantidades.push(intCantidad);
					arrCostosUnitarios.push(intCostoUnitario);
					arrBackOrderInternoID.push(objRen.cells[7].innerHTML);
					arrCantidadesBackOrder.push(intCantidadPendiente);
					arrEstatusBackOrder.push(strEstatusPedido);
				}
				
				//Incrementar acunulado de refacciones surtidas
				intAcumSurtidoDetallesMovimiento += intCantidadSurtida;
			}

			//Variable que se utiliza para asignar el estatus de la requisición de refacciones internas
			var strEstatusRequisicionRefaccionesInternas = 'PARCIALMENTE SURTIDO';
			//Variable que se utiliza para asignar el acumulado de las refacciones solicitadas
			var intAcumSolicitadoDetallesMovimiento = parseFloat($.reemplazar($('#acumSolicitado_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').html(), ",", ""));
 
			//Si el acumulado de las refaccione solicitadas es igual al acumulado de las refacciones surtidas
			if(intAcumSolicitadoDetallesMovimiento == intAcumSurtidoDetallesMovimiento)
			{
				//Cambiar el estatus de la requisición de la refacción
				strEstatusRequisicionRefaccionesInternas = 'SURTIDO';
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/movimientos_salidas_refacciones_internas/guardar',
					{ 
						//Datos del movimiento
						intMovimientoRefaccionesInternasID: $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_salidas_refacciones_internas_control_vehiculos').val()),
						intReferenciaID: $('#txtRequisicionRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val(),
						strObservaciones: $('#txtObservaciones_movimientos_salidas_refacciones_internas_control_vehiculos').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_refacciones_internas_control_vehiculos').val(),
						//Datos de la requisición de refacciones internas
						strEstatusRequisicion: strEstatusRequisicionRefaccionesInternas,
						//Datos de los detalles
						strRenglon: arrRenglon.join('|'),
						strRefaccionID: arrRefaccionID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strCodigosLineas: arrCodigosLineas.join('|'),
						strCantidades: arrCantidades.join('|'),
						strCostosUnitarios: arrCostosUnitarios.join('|'),
						//Datos del pedido pendiente
						strBackOrderInternoID: arrBackOrderInternoID.join('|'),
						strCantidadesBackOrder: arrCantidadesBackOrder.join('|'),
						strEstatusBackOrder: arrEstatusBackOrder.join('|')
					},
					function(data) {
						if (data.resultado)
						{	

							 //Si no existe id del movimiento, significa que es un nuevo registro   
                            if($('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val() == '')
                            {
                                //Asignar el id del movimiento registrado en la base de datos
                                $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val(data.movimiento_refacciones_internas_id);
                            }

		                    //Hacer llamado a la función  para cargar  los registros en el grid
		               		paginacion_movimientos_salidas_refacciones_internas_control_vehiculos(); 

		               		//Hacer un llamado a la función para generar póliza con los datos del registro
                            generar_poliza_movimientos_salidas_refacciones_internas_control_vehiculos('', ''); 
						}

						//Si existe mensaje de error
                        if(data.tipo_mensaje == 'error')
                        {
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_movimientos_salidas_refacciones_internas_control_vehiculos(data.tipo_mensaje, data.mensaje);
						}
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_movimientos_salidas_refacciones_internas_control_vehiculos(tipoMensaje, mensaje)
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
			else if(tipoMensaje == 'informacion')
			{ 
				//Indicar al usuario el mensaje de información
				new $.Zebra_Dialog(mensaje, {
								'type': 'information',
								'title': 'Información',
								'buttons': [{caption: 'Aceptar',
											 callback: function () {
												//Enfocar caja de texto
												$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').focus();
											 }
											}]
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
		function cambiar_estatus_movimientos_salidas_refacciones_internas_control_vehiculos(movimientoRefaccionesID, referenciaID, polizaID, folioPoliza)
		{
			//Variable que se utiliza para asignar el id del movimiento
			var intID = 0;
			//Variable que se utiliza para asignar el id de la referencia
			var intRequisicionRefaccionesInternasID = 0;
			//Variable que se utiliza para asignar el id de la póliza
            var intPolizaID = 0;
            //Variable que se utiliza para asignar el folio de la póliza
            var strFolioPoliza = '';

			//Si no existe id del movimiento, significa que se realizará la modificación desde el modal
			if(movimientoRefaccionesID == '')
			{
				intID = $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val();
				intRequisicionRefaccionesInternasID = $('#txtRequisicionRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val();
				intPolizaID = $('#txtPolizaID_movimientos_salidas_refacciones_internas_control_vehiculos').val();
                strFolioPoliza = $('#txtFolioPoliza_movimientos_salidas_refacciones_internas_control_vehiculos').val();
			}
			else
			{
				intID = movimientoRefaccionesID;
				intRequisicionRefaccionesInternasID = referenciaID;
				intPolizaID = polizaID;
                strFolioPoliza = folioPoliza;
			}

			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro; también se desactivara la póliza con folio: '+strFolioPoliza+'?</strong>',
			             {'type':     'question',
			              'title':    'Salida de Refacciones Internas',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
			                              $.post('control_vehiculos/movimientos_salidas_refacciones_internas/set_estatus',
			                                     {intMovimientoRefaccionesInternasID: intID,
			                                      intReferenciaID: intRequisicionRefaccionesInternasID,
			                                      intPolizaID: intPolizaID
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                          //Hacer llamado a la función  para cargar  los registros en el grid
			                                          paginacion_movimientos_salidas_refacciones_internas_control_vehiculos();

			                                           //Si el id del registro se obtuvo del modal
                                                        if(movimientoRefaccionesID == '')
                                                        {
                                                            //Hacer un llamado a la función para cerrar modal
                                                            cerrar_movimientos_salidas_refacciones_internas_control_vehiculos();     
                                                        }
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_movimientos_salidas_refacciones_internas_control_vehiculos(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_movimientos_salidas_refacciones_internas_control_vehiculos(id, tipoAccion)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/movimientos_salidas_refacciones_internas/get_datos',
			       {intMovimientoRefaccionesInternasID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_movimientos_salidas_refacciones_internas_control_vehiculos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				             //Asignar el id de la póliza
                            var intPolizaID = parseInt(data.row.poliza_id); 

				            //Variable que se utiliza para asignar la referencia (vehículo/serie) de  la orden de reparación interna
					        var strReferenciaOrdenReparacion = '';

					        //Si existe id del vehículo
							if(data.row.vehiculo_id > 0)
							{
								//Asignar datos del vehículo
								strReferenciaOrdenReparacion =  data.row.vehiculo;
							}
							else
							{
								//Asignar serie
								strReferenciaOrdenReparacion =  data.row.serie;
							}

				            
				          	//Recuperar valores
				            $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val(data.row.movimiento_refacciones_internas_id);
				            $('#txtFolio_movimientos_salidas_refacciones_internas_control_vehiculos').val(data.row.folio);
				            $('#txtFecha_movimientos_salidas_refacciones_internas_control_vehiculos').val(data.row.fecha);
				            $('#txtRequisicionRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val(data.row.referencia_id);
				            $('#txtRequisicionRefaccionesInternas_movimientos_salidas_refacciones_internas_control_vehiculos').val(data.row.folio_requisicion);
				            $('#txtOrdenReparacionInterna_movimientos_salidas_refacciones_internas_control_vehiculos').val(data.row.folio_orden_reparacion);
						    $('#txtReferenciaOrden_movimientos_salidas_refacciones_internas_control_vehiculos').val(strReferenciaOrdenReparacion);
						    $('#txtObservaciones_movimientos_salidas_refacciones_internas_control_vehiculos').val(data.row.observaciones);
						    $('#txtPolizaID_movimientos_salidas_refacciones_internas_control_vehiculos').val(intPolizaID);
                            $('#txtFolioPoliza_movimientos_salidas_refacciones_internas_control_vehiculos').val(data.row.folio_poliza);
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_movimientos_salidas_refacciones_internas_control_vehiculos').addClass("estatus-"+strEstatus);
				            
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_movimientos_salidas_refacciones_internas_control_vehiculos").show();


				             //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmMovimientosSalidasRefaccionesInternasControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_movimientos_salidas_refacciones_internas_control_vehiculos").hide();
					             //Deshabilitar botón Agregar
								$('#btnAgregar_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').prop('disabled', true);

								//Si existe el id de la póliza
				            	if(strEstatus == 'ACTIVO' && intPolizaID > 0)
				            	{
					            	//Mostrar el botón Desactivar
					            	$("#btnDesactivar_movimientos_salidas_refacciones_internas_control_vehiculos").show();
					            }

				            }


				            //Hacer llamado a la función  para cargar los detalles del registro en el grid
				            lista_detalles_movimientos_salidas_refacciones_internas_control_vehiculos('Editar', strEstatus, intPolizaID);

			            	//Abrir modal
							objMovimientosSalidasRefaccionesInternasControlVehiculos = $('#MovimientosSalidasRefaccionesInternasControlVehiculosBox').bPopup({
														   appendTo: '#MovimientosSalidasRefaccionesInternasControlVehiculosContent', 
							                               contentContainer: 'MovimientosSalidasRefaccionesInternasControlVehiculosM', 
							                               zIndex: 2, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtRequisicionRefaccionesInternas_movimientos_salidas_refacciones_internas_control_vehiculos').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar obtener los datos de una requisición de refacciones internas
		function get_datos_requisicion_refacciones_movimientos_salidas_refacciones_internas_control_vehiculos()
		{
			  //Hacer un llamado al método del controlador para regresar los datos de la requisición de refacciones internas
              $.post('control_vehiculos/requisiciones_refacciones_internas/get_datos',
                  { 
                  	intRequisicionRefaccionesInternasID: $("#txtRequisicionRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos").val(),
                  },
                  function(data) {
                    if(data.row){

                	    //Variable que se utiliza para asignar la referencia (vehículo/serie)
				        var strReferencia = '';
                    	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
						inicializar_detalles_movimientos_salidas_refacciones_internas_control_vehiculos();
                    	//Recuperar valores
             		    $('#txtOrdenReparacionInterna_movimientos_salidas_refacciones_internas_control_vehiculos').val(data.row.folio_orden_reparacion);
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

             		    $('#txtReferenciaOrden_movimientos_salidas_refacciones_internas_control_vehiculos').val(strReferencia);
             		    //Hacer llamado a la función  para cargar los detalles del registro en el grid
             		    lista_detalles_movimientos_salidas_refacciones_internas_control_vehiculos('Nuevo', '', '');
                    }
                }
                 ,
                'json');
		}
		

		//Función para generar póliza con los datos de un registro
        function generar_poliza_movimientos_salidas_refacciones_internas_control_vehiculos(id, formulario)
        {   

            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Variable que se utiliza para saber si el id se obtuvo desde el modal
            var strTipo = 'modal';
            //Si no existe id, significa que se realizará la modificación desde el modal
            if(id == '')
            {
                intID = $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val();
            }
            else
            {
                intID = id;
                strTipo = 'gridview';
            }

            //Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
            mostrar_circulo_carga_movimientos_salidas_refacciones_internas_control_vehiculos(formulario);
            //Hacer un llamado al método del controlador para timbrar los datos del registro
            $.post('contabilidad/generar_polizas/generar_poliza',
             {
                intReferenciaID: intID,
                strTipoReferencia: strTipoReferenciaMovimientosSalidasRefaccionesInternasControlVehiculos, 
                intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_refacciones_internas_control_vehiculos').val()
             },
             function(data) {

                //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
                ocultar_circulo_carga_movimientos_salidas_refacciones_internas_control_vehiculos(formulario);
                
                //Si existe resultado
                if (data.resultado)
                {
                    //Hacer llamado a la función para cargar  los registros en el grid
                    paginacion_movimientos_salidas_refacciones_internas_control_vehiculos();

                    //Si el id del registro se obtuvo del modal
                    if(strTipo == 'modal')
                    {
                        //Hacer un llamado a la función para cerrar modal
                        cerrar_movimientos_salidas_refacciones_internas_control_vehiculos();
                    }

                }


                //Si se cumple la sentencia
				if(strTipo == 'modal' && data.tipo_mensaje == 'error')
				{
					//Indicar al usuario el mensaje de error
	                new $.Zebra_Dialog(data.mensaje, {
	                                    'type': 'error',
	                                    'title': 'Error',
	                                    'buttons': [{caption: 'Aceptar',
	                                                 callback: function () {
	                                                   //Hacer un llamado a la función para cerrar modal
			            								cerrar_movimientos_salidas_refacciones_internas_control_vehiculos();
	                                                 }
	                                                }]
	                                  });
				}
				else
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    	mensaje_movimientos_salidas_refacciones_internas_control_vehiculos(data.tipo_mensaje, data.mensaje);
				}
                
             },
             'json');

        }

        //Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function mostrar_circulo_carga_movimientos_salidas_refacciones_internas_control_vehiculos(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_salidas_refacciones_internas_control_vehiculos';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_internas_control_vehiculos';
            }

            //Remover clase para mostrar div que contiene la barra de carga
            $("#"+strCampoID).removeClass('no-mostrar');
        }


        //Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function ocultar_circulo_carga_movimientos_salidas_refacciones_internas_control_vehiculos(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_salidas_refacciones_internas_control_vehiculos';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_internas_control_vehiculos';
            }

            //Agregar clase para ocultar div que contiene la barra de carga
            $("#"+strCampoID).addClass('no-mostrar');
        }
    



		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_movimientos_salidas_refacciones_internas_control_vehiculos()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
			$('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
			$('#txtCantidadSolicitada_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
			$('#txtCantidadPendiente_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
			$('#txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
		}

		//Función para la búsqueda de detalles del registro
		function lista_detalles_movimientos_salidas_refacciones_internas_control_vehiculos(tipoAccion, estatus, polizaID) 
		{

			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';
		    //Asignar el id de la póliza
			var intPolizaID = parseInt(polizaID); 

		    //Si se cumple la sentencia
			if(estatus == '' || (estatus == 'ACTIVO' && intPolizaID == 0))
			{
				strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
								    "	onclick='editar_renglon_detalles_movimientos_salidas_refacciones_internas_control_vehiculos(this)'>" + 
									"<span class='glyphicon glyphicon-edit'></span></button>";
			}


			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/movimientos_salidas_refacciones_internas/get_datos_detalles',
			       {
			       		intMovimientoRefaccionesInternasID: $('#txtMovimientoRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val(),
			       		intReferenciaID: $('#txtRequisicionRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val()
			       },
			       function(data) {

			       	     //Mostramos los detalles del registro
			            for (var intCon in data.detalles) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').getElementsByTagName('tbody')[0];

							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcion = objRenglon.insertCell(1);
							var objCeldaCantidadSolicitada = objRenglon.insertCell(2);
							var objCeldaCantidadSurtida = objRenglon.insertCell(3);
							var objCeldaCostoUnitario = objRenglon.insertCell(4);
							var objCeldaSubtotal = objRenglon.insertCell(5);
							var objCeldaAcciones = objRenglon.insertCell(6);
							//Columnas ocultas
							var objCeldaBackOrderInternoID = objRenglon.insertCell(7);
							var objCeldaCantidadBackOrder = objRenglon.insertCell(8);
							var objRefaccionID = objRenglon.insertCell(9);
							var objCeldaCodigoLinea = objRenglon.insertCell(10);
							var objCeldaCostoUnitarioBD = objRenglon.insertCell(11);
							var objCeldaActualExistencia = objRenglon.insertCell(12);

							//Variables que se utilizan para asignar valores del detalle
							var intSubtotal = parseFloat(data.detalles[intCon].costo_unitario);
							var intCantidadSolicitada =  parseFloat(data.detalles[intCon].cantidad_solicitada);
							var intCantidad = parseFloat(data.detalles[intCon].cantidad_surtida);
							var intCostoUnitario = parseFloat(data.detalles[intCon].costo_unitario);

							//Variable que se utiliza para asignar el id del pedido pendiente
							var intBackOrderInternoID = data.detalles[intCon].back_order_interno_id;
							//Variable que se utiliza para asignar la cantidad que esta pendiente
							var intCantidadPendiente = parseFloat(data.detalles[intCon].cantidad_pendiente);
							//Variable que se utiliza para asignar la existencia actual
							var intActualExistencia = parseFloat(data.detalles[intCon].actual_existencia);
							
							
							//Si no existe id del back_order (pedido)
							if(intBackOrderInternoID == 0)
							{
								//Si la cantidad solicitada es mayor que la cantidad surtida
								if(intCantidadSolicitada > intCantidad)
								{
									//Asignar cantidad solicitada para indicar que la refacción no esta surtida
									intCantidadPendiente = intCantidadSolicitada;
								}

							}

							//Si el tipo de acción corresponde a Nuevo
							if(tipoAccion == 'Nuevo')
							{
								//Inicializar valores para evitar mostrar los datos de la requisición
								intSubtotal = 0;
							}
							else
							{

								//Calcular cantidad pendiente por surtir
								intCantidadPendiente +=  intCantidad;

								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;
							}

							//Calcular la existencia disponible
                            intActualExistencia = intCantidad + intActualExistencia;

                            //Cambiar cantidad a  formato moneda (a visualizar)
                    	    intCantidadSolicitada =  formatMoney(intCantidadSolicitada, 2, '');
                    	    intCantidad =  formatMoney(intCantidad, 2, '');

                    	   var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosSalidasRefaccionesInternasControlVehiculos, '');

                    	   var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesInternasControlVehiculos, '');

                    	   //Cambiar cantidad a  formato moneda (a guardar en la  BD)
                   			var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesInternasControlVehiculos, '');


							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].renglon);
							objCeldaCodigo.setAttribute('class', 'movil b1');
							objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
							objCeldaDescripcion.setAttribute('class', 'movil b2');
							objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
							objCeldaCantidadSolicitada.setAttribute('class', 'movil b3');
							objCeldaCantidadSolicitada.innerHTML = intCantidadSolicitada;
							objCeldaCantidadSurtida.setAttribute('class', 'movil b4');
							objCeldaCantidadSurtida.innerHTML = intCantidad;
							objCeldaCostoUnitario.setAttribute('class', 'movil b5');
							objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
							objCeldaSubtotal.setAttribute('class', 'movil b6');
							objCeldaSubtotal.innerHTML = intSubtotalMostrar;
							objCeldaAcciones.setAttribute('class', 'td-center movil b7');
							objCeldaAcciones.innerHTML = strAccionesTabla;
							objCeldaBackOrderInternoID.setAttribute('class', 'no-mostrar');
							objCeldaBackOrderInternoID.innerHTML = intBackOrderInternoID; 
							objCeldaCantidadBackOrder.setAttribute('class', 'no-mostrar');
							objCeldaCantidadBackOrder.innerHTML = intCantidadPendiente; 
							objRefaccionID.setAttribute('class', 'no-mostrar');
							objRefaccionID.innerHTML = data.detalles[intCon].refaccion_id; 
							objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
							objCeldaCodigoLinea.innerHTML = data.detalles[intCon].codigo_linea;
							objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
                        	objCeldaCostoUnitarioBD.innerHTML = intCostoUnitarioBD; 
							objCeldaActualExistencia.setAttribute('class', 'no-mostrar');
							objCeldaActualExistencia.innerHTML = intActualExistencia; 
							
			            }

			            //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_salidas_refacciones_internas_control_vehiculos();
			            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_internas_control_vehiculos tr").length - 2;
						$('#numElementos_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').html(intFilas);
			       },
			       'json');

		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_movimientos_salidas_refacciones_internas_control_vehiculos()
		{

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val();
			var intCantidad = $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val();
			var intCostoUnitario = $('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val();
			var intCantidadSolicitada = $('#txtCantidadSolicitada_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val();
			var intCantidadPendiente = $('#txtCantidadPendiente_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val();
			var intActualExistencia = $('#txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val();
			

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').getElementsByTagName('tbody')[0];

			//Si existe ID del renglón
			if (intRenglon != '' )
			{
				//Validamos que se capturaron datos
				if (intCantidad == '')
				{
					//Enfocar caja de texto
					$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').focus();
				}
				else
				{
					//Convertir cadena de texto a número decimal
					intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
					intSubtotal =  parseFloat($.reemplazar(intCostoUnitario, ",", ""));
					intCantidadSolicitada = parseFloat($.reemplazar(intCantidadSolicitada, ",", ""));
					intCantidadPendiente = parseFloat(intCantidadPendiente);
					intActualExistencia = parseFloat(intActualExistencia);

					//Verificar que la cantidad sea menor o igual que la existencia disponible
					if(intCantidad <= intCantidadPendiente && intCantidad <= intActualExistencia)
					{
						//Hacer un llamado a la función para inicializar elementos de la refacción
						inicializar_refaccion_detalles_movimientos_salidas_refacciones_internas_control_vehiculos();
						
						//Calcular subtotal
						intSubtotal = intCantidad * intSubtotal;

						//Cambiar cantidad a  formato moneda (a visualizar)
	                    intCantidad =  formatMoney(intCantidad, 2, '');

	                    var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesInternasControlVehiculos, '');

						//Editar los datos del detalle
					    objTabla.rows.namedItem(intRenglon).cells[3].innerHTML = intCantidad;
					    objTabla.rows.namedItem(intRenglon).cells[5].innerHTML =  intSubtotalMostrar;

					    //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_salidas_refacciones_internas_control_vehiculos();

						//Enfocar caja de texto
						$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').focus();
					}
					else
					{
			    		//Si la existencia disponible en menor que la cantidad a surtir
						if(intActualExistencia < intCantidad)
						{
							//Si la existencia disponible es mayor que la cantidad pendiente
							if(intActualExistencia > intCantidadPendiente)
							{
								//Cambiar la cantidad a surtir
								intCantidad = intCantidadPendiente;
							}
							else
							{
								//Cambiar la cantidad a surtir
								intCantidad = intActualExistencia;
							}


							/*Mensaje que se utiliza para informar al usuario que la cantidad a 
							  surtir no debe ser mayor que la cantidad que se encuentra en el inventario*/
							strMensaje = 'La cantidad a surtir es mayor que la cantidad del inventario.';
						}
						else if(intCantidadPendiente == 0)
						{
							//Mensaje que se utiliza para informar al usuario que la refacción ha sido surtida
							strMensaje = 'La refacción ha sido surtida.';
						}
						else
						{

							//Cambiar la cantidad a surtir
							intCantidad = intCantidadPendiente;

							/*Mensaje que se utiliza para informar al usuario que la cantidad a 
							  surtir no debe ser mayor que la cantidad que ha sido solicitada*/
							strMensaje = 'La cantidad a surtir es mayor que la cantidad que ha sido solicitada.';
						}

						//Cambiar cantidad a formato moneda
                   		intCantidad = formatMoney(intCantidad, 2, '');

				    	//Asignar cantidad a surtir
						$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val(intCantidad);

						//Hacer un llamado a la función para mostrar mensaje de información
					    mensaje_movimientos_salidas_refacciones_internas_control_vehiculos('informacion', strMensaje);
					}
					
				}


				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_internas_control_vehiculos tr").length - 2;
				$('#numElementos_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').html(intFilas);
		    }
		    else
		    {
		    	//Limpiar caja de texto
		    	$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
		    }
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_movimientos_salidas_refacciones_internas_control_vehiculos(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidadSolicitada_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
			$('#txtCantidadPendiente_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[8].innerHTML);
			$('#txtActualExistencia_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			//Enfocar caja de texto
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').focus();
		}


		//Función para calcular totales de la tabla
		function calcular_totales_detalles_movimientos_salidas_refacciones_internas_control_vehiculos()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumSolicitado = 0;
			var intAcumSurtido = 0;
			var intAcumSubtotal = 0;

			//Variable que se utiliza para contar el número de refacciones con salida
		    var intContadorDetalles = 0;
		    //Variable que se utiliza para asignar la cantidad solicitada de la refacción
		    var intCantidadSolicitada = 0;
		    //Variable que se utiliza para asignar la cantidad surtida de la refacción
		    var intCantidadSurtida = 0;
		    //Variable que se utiliza para asignar el subtotal
		    var intSubtotal = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				//Convertir cadena de texto a número decimal
				intCantidadSolicitada = parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				intCantidadSurtida = parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intSubtotal = parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				//Incrementar acumulados
				intAcumSolicitado += intCantidadSolicitada;
				intAcumSurtido += intCantidadSurtida;
				intAcumSubtotal += intSubtotal;
				
				//Si existe cantidad surtida de la refacción
				if(intCantidadSurtida > 0)
				{
					//Incrementar contador por cada detalle
					intContadorDetalles++;
				}

			}

			//Convertir total de unidades a 2 decimales
			intAcumSolicitado = formatMoney(intAcumSolicitado, 2, '');
			intAcumSurtido = formatMoney(intAcumSurtido, 2, '');
			//Convertir cantidad a formato moneda
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesInternasControlVehiculos, '');


			//Asignar los valores
			$('#acumSolicitado_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').html(intAcumSolicitado);
			$('#acumSurtido_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').html(intAcumSurtido);
			$('#acumSubtotal_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').html(intAcumSubtotal);
			$('#txtNumDetalles_movimientos_salidas_refacciones_internas_control_vehiculos').val(intContadorDetalles);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').numeric();

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_movimientos_salidas_refacciones_internas_control_vehiculos').blur(function(){
                $('.cantidad_movimientos_salidas_refacciones_internas_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
            });

            //Agregar datepicker para seleccionar fecha
			$('#dteFecha_movimientos_salidas_refacciones_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			
	        ///Autocomplete para recuperar los datos de una requisición de refacciones internas
	        $('#txtRequisicionRefaccionesInternas_movimientos_salidas_refacciones_internas_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtRequisicionRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
	               //Hacer un llamado a la función para inicializar elementos de la requisición de refacciones internas
	               inicializar_requisicion_refacciones_movimientos_salidas_refacciones_internas_control_vehiculos();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/requisiciones_refacciones_internas/autocomplete",
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
	                $('#txtRequisicionRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val(ui.item.data);
	             	//Hacer un llamado a la función para regresar los datos de la requisición de refacciones internas
	                get_datos_requisicion_refacciones_movimientos_salidas_refacciones_internas_control_vehiculos();

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
			//Verificar que exista id de la requisición de refacciones internas cuando pierda el enfoque la caja de texto
	        $('#txtRequisicionRefaccionesInternas_movimientos_salidas_refacciones_internas_control_vehiculos').focusout(function(e){
	            //Si no existe id de la requisición de refacciones internas
	            if($('#txtRequisicionRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val() == '' ||
	               $('#txtRequisicionRefaccionesInternas_movimientos_salidas_refacciones_internas_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtRequisicionRefaccionesInternasID_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
	               $('#txtRequisicionRefaccionesInternas_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
	               //Hacer un llamado a la función para inicializar elementos de la requisición de refacciones internas
	               inicializar_requisicion_refacciones_movimientos_salidas_refacciones_internas_control_vehiculos();
	            }

	        });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar botón Agregar
			   	    	$('#btnAgregar_detalles_movimientos_salidas_refacciones_internas_control_vehiculos').focus();
			   	    }
		        }
		    });

			
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_movimientos_salidas_refacciones_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_movimientos_salidas_refacciones_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY',
			 																		                            useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_movimientos_salidas_refacciones_internas_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_movimientos_salidas_refacciones_internas_control_vehiculos').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_movimientos_salidas_refacciones_internas_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_movimientos_salidas_refacciones_internas_control_vehiculos').data('DateTimePicker').maxDate(e.date);
			});
			
			//Autocomplete para recuperar los datos de un vehículo
	        $('#txtVehiculoBusq_movimientos_salidas_refacciones_internas_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoIDBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
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
	             $('#txtVehiculoIDBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val(ui.item.data);
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
	        $('#txtVehiculoBusq_movimientos_salidas_refacciones_internas_control_vehiculos').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoIDBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val() == '' ||
	               $('#txtVehiculoBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVehiculoIDBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
	               $('#txtVehiculoBusq_movimientos_salidas_refacciones_internas_control_vehiculos').val('');
	            }

	        });

	        //Paginación de registros
			$('#pagLinks_movimientos_salidas_refacciones_internas_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaMovimientosSalidasRefaccionesInternasControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_movimientos_salidas_refacciones_internas_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_movimientos_salidas_refacciones_internas_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_movimientos_salidas_refacciones_internas_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_movimientos_salidas_refacciones_internas_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				objMovimientosSalidasRefaccionesInternasControlVehiculos = $('#MovimientosSalidasRefaccionesInternasControlVehiculosBox').bPopup({
											   appendTo: '#MovimientosSalidasRefaccionesInternasControlVehiculosContent', 
				                               contentContainer: 'MovimientosSalidasRefaccionesInternasControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#txtRequisicionRefaccionesInternas_movimientos_salidas_refacciones_internas_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_movimientos_salidas_refacciones_internas_control_vehiculos').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_movimientos_salidas_refacciones_internas_control_vehiculos();
		});
	</script>