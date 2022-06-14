
	<div id="MovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"
				                    		name= "strFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
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
								<label for="txtFechaFinalBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"
				                    		name= "strFechaFinalBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
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
								<input id="txtVehiculoIDBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
									   name="intVehiculoIDBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"  
									   type="hidden" value="">
								</input>
								<label for="txtVehiculoBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">Vehículo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtVehiculoBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
										name="strVehiculoBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese vehículo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
								 		name="strEstatusBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" tabindex="1">
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
								<label for="txtBusqueda_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
										name="strBusqueda_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12  btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
									   	name="strImprimirDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
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
							<button class="btn btn-primary" id="btnBuscar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"
									onclick="paginacion_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"
									onclick="reporte_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos('PDF');" title="Generar reporte PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"
									onclick="reporte_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos('XLS');" title="Descargar archivo XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla movimientos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Salida"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Vehículo/Serie"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles del movimiento
				*/
				td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Costo Unit."; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles del movimiento
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Salida</th>
							<th class="movil">Vehículo/Serie</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{folio_salida}}</td>
							<td class="movil a4">{{referencia_orden_reparacion}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="td-center movil a6"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos({{movimiento_refacciones_internas_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos({{movimiento_refacciones_internas_id}}, 'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos({{movimiento_refacciones_internas_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos({{movimiento_refacciones_internas_id}}, 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos({{movimiento_refacciones_internas_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 	

		<!-- Diseño del modal-->
		<div id="MovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"  class="ModalBodyTitle">
			<h1>Entradas por Devolución del Taller</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!-- Folio -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
										   name="intMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
                                    <input id="txtPolizaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
                                           name="intPolizaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" type="hidden" value="" />
                                    <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
                                    <input id="txtFolioPoliza_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
                                           name="strFolioPoliza_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" type="hidden" value="" />
									<label for="txtFolio_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
											name="strFolio_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
											type="text" value="" placeholder="Autogenerado" disabled />
								</div>
							</div>
						</div>
						<!-- Fecha -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos'>
					                    <input class="form-control" 
					                    		id="txtFecha_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"
					                    		name= "strFecha_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
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
						<!--Autocomplete que contiene las entradas de refacciones activas-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la salida de refacciones (por taller) seleccionada-->
									<input id="txtReferenciaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
										   name="intReferenciaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"  
										   type="hidden"  value="">
									</input>
									<label for="txtReferencia_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">Salida</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtReferencia_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
											name="strReferencia_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
											type="text" value="" tabindex="1" placeholder="Ingrese salida" maxlength="250" />
								</div>
							</div>	
						</div>
						<!--Orden de reparación -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtOrdenReparacionInterna_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">No. de orden</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtOrdenReparacionInterna_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
											name="strOrdenReparacionInterna_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
											type="text" value="" disabled />
								</div>
							</div>
						</div>
						<!--Prospecto-->
						<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtReferenciaOrden_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">Vehículo/Serie</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtReferenciaOrden_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
											name="strReferenciaOrden_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
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
									<label for="txtObservaciones_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">Observaciones</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtObservaciones_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
											name="strObservaciones_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
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
									<input id="txtNumDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
										   name="intNumDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la entrada por devolución</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Código-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el renglón de la refacción-->
																<input id="txtRenglon_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																	   name="intRenglon_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar la cantidad de salida de la refacción-->
																<input id="txtCantidadSalida_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																	   name="intCantidadSalida_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar la cantidad devuelta al taller-->
																<input id="txtCantidadDevolucion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																	   name="intCantidadDevolucion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																	   type="hidden" value="">
																</input>
																<label for="txtCodigo_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																		name="strCodigo_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																		type="text" value="" disabled />
															</div>
														</div>
													</div>
													<!--Descripción-->
													<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDescripcion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">
																	Descripción
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtDescripcion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																		name="strDescripcion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																		type="text" value="" disabled/>
															</div>
														</div>
													</div>
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																		id="txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																		name="intCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="14" />
															</div>
														</div>
													</div>
													<!--Precio unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCostoUnitario_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">Costo unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCostoUnitario_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																		name="intCostoUnitario_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
																		type="text" value="" disabled />
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns" 
					                                			id="btnAgregar_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" 
					                                			onclick="agregar_renglon_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();" 
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
													<table class="table-hover movil" id="dg_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Código</th>
																<th class="movil">Descripción</th>
																<th class="movil">Cantidad</th>
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
																	<strong id="acumCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"></strong>
																</td>
																<td class="movil t4"></td>
																<td class="movil t5">
																	<strong id="acumSubtotal_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"></strong>
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
																<strong id="numElementos_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos">0</strong> encontrados
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
					<div id="divCirculoBarProgreso_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"  
									onclick="validar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"  
									onclick="reporte_registro_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos('');"  
									title="Imprimir" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"  
									onclick="cambiar_estatus_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos('', '', '');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = 0;
		var strUltimaBusquedaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
        var strTipoReferenciaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = "MOVIMIENTO DE REFACCIONES INTERNAS";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
        var intNumDecimalesMostrarMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
        //Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
        var intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = <?php echo NUM_DECIMALES_COSTO_UNIT_MOV_REFACCIONES ?>;
		
		//Variable que se utiliza para asignar objeto del modal
		var objMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/movimientos_entradas_refacciones_internas_devolucion_taller/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = strPermisosMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos[i]=='GUARDAR') || (arrPermisosMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
						}
						else if(arrPermisosMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos() 
		{
		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos =($('#txtFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()+$('#txtFechaFinalBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()+$('#txtVehiculoIDBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()+$('#cmbEstatusBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()+$('#txtBusqueda_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos != strUltimaBusquedaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos)
			{
				intPaginaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = 0;
				strUltimaBusquedaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = strNuevaBusquedaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos;
			}
			
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/movimientos_entradas_refacciones_internas_devolucion_taller/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					  dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()),
					  dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()),
					  intVehiculoID: $('#txtVehiculoIDBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(),
					  strEstatus:     $('#cmbEstatusBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(),
					  strBusqueda:    $('#txtBusqueda_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(),
					  intPagina: intPaginaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos,
					  strPermisosAcceso: $('#txtAcciones_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()
					},
					function(data){
						$('#dg_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos tbody').empty();
						var tmpMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = Mustache.render($('#plantilla_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').html(),data);
						$('#dg_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos tbody').html(tmpMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos);
						$('#pagLinks_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').html(data.paginacion);
						$('#numElementos_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').html(data.total_rows);
						intPaginaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = data.pagina;
					},
			'json');
		
		}



		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(strTipo) 
		{
			
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'control_vehiculos/movimientos_entradas_refacciones_internas_devolucion_taller/';

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
			if ($('#chbImprimirDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()),
										'intVehiculoID': $('#txtVehiculoIDBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(), 
										'strEstatus': $('#cmbEstatusBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(), 
										'strBusqueda': $('#txtBusqueda_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(),
										'strDetalles': $('#chbImprimirDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()					
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'control_vehiculos/movimientos_entradas_refacciones_internas_devolucion_taller/get_reporte_registro',
							'data' : {
										'intMovimientoRefaccionesInternasID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para descargar el archivo XLS
		function descargar_xls_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos() 
		{
			//Asignar valores para la búsqueda de registros
			intVehiculoIDMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos =  $('#txtVehiculoIDBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val();
			dteFechaInicialMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos =  $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val());
			dteFechaFinalMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos =  $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val());

			//Si no existe fecha inicial
			if(dteFechaInicialMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos == '')
			{
				dteFechaInicialMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos == '')
			{
				dteFechaFinalMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos =  '0000-00-00';
			}
			
			//Si no existe id del vehículo
			if(intVehiculoIDMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos == '')
			{
				intVehiculoIDMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = 0;
			}
			
			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el archivo
			    $('#chbImprimirDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el archivo
			   $('#chbImprimirDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('NO');
			}

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("control_vehiculos/movimientos_entradas_refacciones_internas_devolucion_taller/get_xls/"+dteFechaInicialMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos+"/"+dteFechaFinalMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos+"/"+intVehiculoIDMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos+"/"+
				$('#cmbEstatusBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()+"/"+
				$('#chbImprimirDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()+"/"+
				$('#txtBusqueda_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val());
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos()
		{
			//Incializar formulario
			$('#frmMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(fechaActual()); 
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
            $.removerClasesEncabezado('divEncabezadoModal_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos');


			//Habilitar todos los elementos del formulario
			$('#frmMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').attr("disabled", "disabled");
			$('#txtOrdenReparacionInterna_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').attr("disabled", "disabled");
			$('#txtReferenciaOrden_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').attr("disabled", "disabled");
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').attr("disabled", "disabled");
			$('#txtDescripcion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').attr("disabled", "disabled");
			$('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').attr("disabled", "disabled");
 			//Mostrar los siguientes botones
			$("#btnGuardar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos").hide();
			$("#btnDesactivar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos").hide();
			//Habilitar botón Agregar
			$('#btnAgregar_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').prop('disabled', false);
		}

		

		//Función para inicializar elementos de la salida de refacciones internas por taller
		function inicializar_salida_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtOrdenReparacionInterna_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
            $('#txtReferenciaOrden_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
           
		}
																	
		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos()
		{
			//Hacer un llamado a la función para inicializar elementos de la refacción
			inicializar_refaccion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
			//Eliminar los datos de la tabla detalles del movimiento
			$('#dg_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos tbody').empty();
			$('#acumCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').html('');
		    $('#acumSubtotal_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').html('');
			$('#numElementos_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').html(0);
			$('#txtNumDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos()
		{
			try {

				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos('');
				//Cerrar modal
				objMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos')
				.bootstrapValidator({	excluded: [':disabled'],
									 	container: 'popover',
									 	feedbackIcons: {
									 		valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
									  	},
									  	fields: {
											strFecha_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos: {
												validators: {
													notEmpty: {message: 'Seleccione una fecha'}
												}
											},
											strReferencia_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la salida de refacciones
						                                    if($('#txtReferenciaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val() === '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba una salida por taller existente'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
											intNumDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que existan detalles
						                                    if(parseFloat(value) === 0 || value === '')
						                                    {
						                                    	return {
						                                            valid: false,
						                                            message: 'Agregar al menos una devolución para esta entrada.'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
										    intCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    }
										}
									});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos = $('#frmMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos.isValid())
			{

				//Hacer un llamado a la función para guardar los datos del registro
				guardar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos()
		{
			try
			{
				$('#frmMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRenglon = [];
			var arrRefaccionID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCodigosLineas = [];
			var arrCantidades = [];
			var arrCostosUnitarios = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad =  $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intCostoUnitario = $.reemplazar(objRen.cells[10].innerHTML, ",", "");

				//Si existe cantidad a devolver
				if(intCantidad > 0)
				{	
					//Asignar valores a los arrays
					arrRenglon.push(objRen.getAttribute('id'));
					arrRefaccionID.push(objRen.cells[8].innerHTML);
					arrCodigos.push(objRen.cells[0].innerHTML);
					arrDescripciones.push(objRen.cells[1].innerHTML);
					arrCodigosLineas.push(objRen.cells[9].innerHTML);
					arrCantidades.push(intCantidad);
					arrCostosUnitarios.push(intCostoUnitario);
				}
				
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/movimientos_entradas_refacciones_internas_devolucion_taller/guardar',
					{ 
						//Datos del movimiento
						intMovimientoRefaccionesInternasID: $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()),
						intReferenciaID: $('#txtReferenciaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(),
						strObservaciones: $('#txtObservaciones_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(),
						//Datos de los detalles
						strRenglon: arrRenglon.join('|'),
						strRefaccionID: arrRefaccionID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strCodigosLineas: arrCodigosLineas.join('|'),
						strCantidades: arrCantidades.join('|'),
						strCostosUnitarios: arrCostosUnitarios.join('|')
					},
					function(data) {
						if (data.resultado)
						{	

							 //Si no existe id del movimiento, significa que es un nuevo registro   
                            if($('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val() == '')
                            {
                                //Asignar el id del movimiento registrado en la base de datos
                                $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(data.movimiento_refacciones_internas_id);
                            }

		                    
		                    //Hacer llamado a la función  para cargar  los registros en el grid
		               		paginacion_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();  

		               		//Hacer un llamado a la función para generar póliza con los datos del registro
                            generar_poliza_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos('', '');
						}

						//Si existe mensaje de error
                        if(data.tipo_mensaje == 'error')
                        {
                            //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                            mensaje_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(data.tipo_mensaje, data.mensaje);
                        }
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(tipoMensaje, mensaje)
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
												$('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').focus();
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
		function cambiar_estatus_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(id, polizaID, folioPoliza)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para asignar el id de la póliza
            var intPolizaID = 0;
            //Variable que se utiliza para asignar el folio de la póliza
            var strFolioPoliza = '';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val();
				intPolizaID = $('#txtPolizaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val();
                strFolioPoliza = $('#txtFolioPoliza_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val();

			}
			else
			{
				intID = id;
				intPolizaID = polizaID;
                strFolioPoliza = folioPoliza;
			}

			//Preguntar al usuario si desea desactivar el registro
			 new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro; también se desactivara la póliza con folio: '+strFolioPoliza+'?</strong>',
			             {'type':     'question',
			              'title':    'Entradas por Devolución del Taller',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
			                              $.post('control_vehiculos/movimientos_entradas_refacciones_internas_devolucion_taller/set_estatus',
			                                     {intMovimientoRefaccionesInternasID: intID,
			                                      intPolizaID: intPolizaID
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                          	//Hacer llamado a la función  para cargar  los registros en el grid
			                                          	paginacion_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();

			                                           	//Si el id del registro se obtuvo del modal
                                                        if(id == '')
                                                        {
                                                            //Hacer un llamado a la función para cerrar modal
                                                            cerrar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();     
                                                        }
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(id, tipoAccion)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/movimientos_entradas_refacciones_internas_devolucion_taller/get_datos',
			       {intMovimientoRefaccionesInternasID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
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
				            $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(data.row.movimiento_refacciones_internas_id);
				            $('#txtFolio_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(data.row.folio);
				            $('#txtFecha_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(data.row.fecha);
				            $('#txtReferenciaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(data.row.referencia_id);
				             $('#txtReferencia_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(data.row.folio_salida);
				            $('#txtOrdenReparacionInterna_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(data.row.folio_orden_reparacion);
						    $('#txtReferenciaOrden_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(strReferenciaOrdenReparacion);
						    $('#txtObservaciones_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(data.row.observaciones);
						    $('#txtPolizaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(intPolizaID);
						    $('#txtFolioPoliza_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(data.row.folio_poliza);
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').addClass("estatus-"+strEstatus);
				         
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos").show();


				            //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos").hide();
					            //Deshabilitar botón Agregar
								$('#btnAgregar_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').prop('disabled', true);


					            //Si existe el id de la póliza
				            	if(strEstatus == 'ACTIVO' && intPolizaID > 0)
				            	{
					            	//Mostrar el botón Desactivar
					            	$("#btnDesactivar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos").show();
					            }


				            }

				            
				            
				            //Hacer llamado a la función  para cargar los detalles del registro en el grid
				            lista_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos('Editar', strEstatus, intPolizaID);


			            	//Abrir modal
							objMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = $('#MovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculosBox').bPopup({
														   appendTo: '#MovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculosContent', 
							                               contentContainer: 'MovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculosM', 
							                               zIndex: 2, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtReferencia_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').focus();
							
			       	    }
			       },
			       'json');
		}

		

		//Función para regresar obtener los datos de una salida de refacciones internas por taller
		function get_datos_salida_taller_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos()
		{

 			  //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
              $.post('control_vehiculos/movimientos_salidas_refacciones_internas/get_datos',
                  { 
                  	intMovimientoRefaccionesInternasID: $("#txtReferenciaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos").val(),
                  },
                  function(data) {
                    if(data.row){

                    	//Variable que se utiliza para asignar la referencia (vehículo/serie) de la orden de reparación interna
				        var strReferenciaOrdenReparacion = '';
                    	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
						inicializar_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
                    	//Recuperar valores
             			$('#txtReferencia_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(data.row.folio);
             			$('#txtOrdenReparacionInterna_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(data.row.folio_orden_reparacion);

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

             		    $('#txtReferenciaOrden_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(strReferenciaOrdenReparacion);
             		    //Hacer llamado a la función  para cargar los detalles del registro en el grid
             		    lista_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos('Nuevo', '', '');
                    }
                }
                 ,
                'json');
		}


		//Función para generar póliza con los datos de un registro
		function generar_poliza_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(id, formulario)
		{	

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val();
			}
			else
			{
				intID = id;
				strTipo = 'gridview';
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(formulario);
			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(formulario);
			    
			    //Si existe resultado
				if (data.resultado)
				{
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();

					//Si el id del registro se obtuvo del modal
					if(strTipo == 'modal')
					{
						//Hacer un llamado a la función para cerrar modal
			            cerrar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
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
			            								cerrar_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
	                                                 }
	                                                }]
	                                  });
				}
				else
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				    mensaje_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(data.tipo_mensaje, data.mensaje);
				}
				
		     },
		     'json');

		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function mostrar_circulo_carga_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}


		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function ocultar_circulo_carga_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
			$('#txtDescripcion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
			$('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
			$('#txtCantidadSalida_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
			$('#txtCantidadDevolucion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
		}

		//Función para la búsqueda de detalles del registro
		function lista_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(tipoAccion, estatus, polizaID) 
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';
		     //Asignar el id de la póliza
			var intPolizaID = parseInt(polizaID);

		    //Si se cumple la sentencia
			if(estatus == '' || (estatus == 'ACTIVO' && intPolizaID == 0))
			{
				strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
									"	onclick='editar_renglon_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(this)'>" + 
									"<span class='glyphicon glyphicon-edit'></span></button>";
			}


			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/movimientos_entradas_refacciones_internas_devolucion_taller/get_datos_detalles',
			       {intMovimientoRefaccionesInternasID: $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(),
			       	intReferenciaID: $('#txtReferenciaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val()
			       },
			       function(data) {

			            //Mostramos los detalles del registro
			            for (var intCon in data.detalles) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').getElementsByTagName('tbody')[0];

							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcion = objRenglon.insertCell(1);
							var objCeldaCantidad = objRenglon.insertCell(2);
							var objCeldaCostoUnitario = objRenglon.insertCell(3);
							var objCeldaSubtotal = objRenglon.insertCell(4);
							var objCeldaAcciones = objRenglon.insertCell(5);
							//Columnas ocultas
							var objCeldaCantidadSalida = objRenglon.insertCell(6);
							var objCeldaCantidadDevolucion = objRenglon.insertCell(7);
							var objRefaccionID = objRenglon.insertCell(8);
							var objCeldaCodigoLinea = objRenglon.insertCell(9);
							var objCeldaCostoUnitarioBD = objRenglon.insertCell(10);

							//Variables que se utilizan para asignar valores del detalle
							var intSubtotal = parseFloat(data.detalles[intCon].costo_unitario);
							var intCantidadEntrada =  parseFloat(data.detalles[intCon].cantidad_entrada);
							var intCantidadSalida =  parseFloat(data.detalles[intCon].cantidad_salida);
							var intCostoUnitario = parseFloat(data.detalles[intCon].costo_unitario);
							var intCantidad = 0;
							
							//Variable que se utiliza para asignar la cantidad que ha sido devuelta
							var intCantidadDevolucion = parseFloat(data.detalles[intCon].cantidad_devolucion);

							//Si el tipo de acción corresponde a Editar
							if(tipoAccion == 'Editar')
							{
								//Asignar valores del detalle correspondiente a la entrada
								intCantidad = intCantidadEntrada;

								//Calcular cantidad devuelta
								intCantidadDevolucion -=  intCantidad;
							}
							else
							{
								//Cambiar la cantidad de salida
								intCantidad = intCantidadSalida;
							}
							

							//Si el tipo de acción corresponde a Nuevo
							if(tipoAccion == 'Nuevo')
							{
								//Inicializar valores para evitar mostrar los datos de la salida
								intSubtotal = 0;
							}
							else
							{
								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;
							}


							//Cambiar cantidad a  formato moneda (a visualizar)
							intCantidadEntrada =  formatMoney(intCantidadEntrada, 2, '');

							var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos, '');

							var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos, '');

							//Cambiar cantidad a  formato moneda (a guardar en la  BD)
                   			var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos, '');

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].renglon);
							objCeldaCodigo.setAttribute('class', 'movil b1');
							objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
							objCeldaDescripcion.setAttribute('class', 'movil b2');
							objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
							objCeldaCantidad.setAttribute('class', 'movil b3');
							objCeldaCantidad.innerHTML = intCantidadEntrada;
							objCeldaCostoUnitario.setAttribute('class', 'movil b4');
							objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
							objCeldaSubtotal.setAttribute('class', 'movil b5');
							objCeldaSubtotal.innerHTML = intSubtotalMostrar;
							objCeldaAcciones.setAttribute('class', 'td-center movil b6');
							objCeldaAcciones.innerHTML = strAccionesTabla;
							objCeldaCantidadSalida.setAttribute('class', 'no-mostrar');
							objCeldaCantidadSalida.innerHTML = intCantidadSalida; 
							objCeldaCantidadDevolucion.setAttribute('class', 'no-mostrar');
							objCeldaCantidadDevolucion.innerHTML = intCantidadDevolucion; 
							objRefaccionID.setAttribute('class', 'no-mostrar');
							objRefaccionID.innerHTML = data.detalles[intCon].refaccion_id; 
							objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
							objCeldaCodigoLinea.innerHTML = data.detalles[intCon].codigo_linea; 
							objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
							objCeldaCostoUnitarioBD.innerHTML = intCostoUnitarioBD; 
							
			            }

			            //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
			            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos tr").length - 2;
						$('#numElementos_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').html(intFilas);
			       },
			       'json');

		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos()
		{
			//Variable que se utiliza para asignar el subtotal (costo unitario en la tabla movimientos_refacciones_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asignar la cantidad a devolver
			var intCantidadDevolver = 0;
			//Variable que se utiliza para asignar el mensaje informativo
			var strMensaje = '';

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val();
			var intCantidad = $('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val();
			var intCostoUnitario = $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val();
			var intCantidadSalida = $('#txtCantidadSalida_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val();
			var intCantidadDevolucion = $('#txtCantidadDevolucion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val();		
			
			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').getElementsByTagName('tbody')[0];

			//Si existe ID del renglón
			if (intRenglon != '' )
			{
				//Validamos que se capturaron datos
				if (intCantidad == '')
				{
					//Enfocar caja de texto
					$('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').focus();
				}
				else
				{
					//Convertir cadena de texto a número decimal
					intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
					intSubtotal =  parseFloat($.reemplazar(intCostoUnitario, ",", ""));
					intCantidadSalida = parseFloat(intCantidadSalida);
					intCantidadDevolucion = parseFloat(intCantidadDevolucion);

					//Calcular la cantidad a devolver
					intCantidadDevolver = intCantidad + intCantidadDevolucion;

					//Verificar que la cantidad sea menor o igual que la salida
					if(intCantidadDevolver <= intCantidadSalida)
					{
						//Hacer un llamado a la función para inicializar elementos de la refacción
						inicializar_refaccion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();

						//Calcular subtotal
						intSubtotal = intCantidad * intSubtotal;

						//Cambiar cantidad a  formato moneda (a visualizar)
                    	intCantidad =  formatMoney(intCantidad, 2, '');

                    	var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos, '');

						//Editar los datos del detalle
					    objTabla.rows.namedItem(intRenglon).cells[2].innerHTML = intCantidad;
					    objTabla.rows.namedItem(intRenglon).cells[4].innerHTML =  intSubtotalMostrar;
					    //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();

						//Enfocar caja de texto
						$('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').focus();
					}
					else
					{
						
						//Calcular la cantidad a devolver
				    	intCantidad = intCantidadSalida - intCantidadDevolucion;

				    	//Si la cantidad de salida es igual a la cantidad devuelta
						if(intCantidadSalida == intCantidadDevolucion)
						{
							//Mensaje que se utiliza para informar al usuario que la refacción ha sido devuelta
							strMensaje = 'La refacción ha sido devuelta.';
						}
						else
						{
							/*Mensaje que se utiliza para informar al usuario que la cantidad a 
							  devolver no debe ser mayor que la cantidad que no ha sido devuelta*/
							strMensaje = 'La cantidad a devolver es mayor que la cantidad que no ha sido devuelta.';
						}

				    	//Cambiar cantidad a formato moneda
			    		intCantidad = formatMoney(intCantidad, 2, '');

				    	//Asignar cantidad a devolver
						$('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(intCantidad);

						//Hacer un llamado a la función para mostrar mensaje de información
					    mensaje_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos('informacion', strMensaje);
					}
					
				}


				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos tr").length - 2;
				$('#numElementos_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').html(intFilas);
		    }
		    else
		    {
		    	//Limpiar caja de texto
		    	$('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
		    }
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtCantidadSalida_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[6].innerHTML);
			$('#txtCantidadDevolucion_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[7].innerHTML);

			//Enfocar caja de texto
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').focus();
		}


		//Función para calcular totales de la tabla
		function calcular_totales_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumSubtotal = 0;
			//Variable que se utiliza para contar el número de refacciones con devolución
		    var intContadorDetalles = 0;
		    //Variable que se utiliza para asignar la cantidad de la refacción
		    var intCantidad = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				//Convertir cadena de texto a número decimal
				intCantidad = parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				//Incrementar acumulados
				intAcumUnidades += intCantidad;
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				
				//Si existe cantidad de la refacción
				if(intCantidad > 0)
				{
					//Incrementar contador por cada detalle
					intContadorDetalles++;
				}

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Convertir cantidad a formato moneda
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos, '');

			//Asignar los valores
			$('#acumCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').html(intAcumUnidades);
			$('#acumSubtotal_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').html(intAcumSubtotal);
			$('#txtNumDetalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(intContadorDetalles);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').numeric();

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').blur(function(){
                $('.cantidad_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
            });

             //Agregar datepicker para seleccionar fecha
			$('#dteFecha_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});


			
	        //Autocomplete para recuperar los datos de una salida de refacciones internas por taller
	        $('#txtReferencia_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtReferenciaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
	               //Hacer un llamado a la función para inicializar elementos de la salida de refacciones internas por taller
	               inicializar_salida_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/movimientos_salidas_refacciones_internas/autocomplete",
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
	              $('#txtReferenciaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos de la salida de refacciones internas por taller
	               get_datos_salida_taller_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
			//Verificar que exista id de la salida cuando pierda el enfoque la caja de texto
	        $('#txtReferencia_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').focusout(function(e){
	            //Si no existe id de la salida
	            if($('#txtReferenciaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val() == '' ||
	               $('#txtReferencia_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtReferenciaID_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
	               $('#txtReferencia_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
	               //Hacer un llamado a la función para inicializar elementos de la salida de refacciones internas por taller
	               inicializar_salida_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
	            }

	        });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar botón Agregar
			   	    	$('#btnAgregar_detalles_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').focus();
			   	    }
		        }
		    });

			
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY',
			 																		                            useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').data('DateTimePicker').maxDate(e.date);
			});

			
			//Autocomplete para recuperar los datos de un vehículo
	        $('#txtVehiculoBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoIDBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
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
	             $('#txtVehiculoIDBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val(ui.item.data);
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
	        $('#txtVehiculoBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoIDBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val() == '' ||
	               $('#txtVehiculoBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVehiculoIDBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
	               $('#txtVehiculoBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').val('');
	            }

	        });

	        //Paginación de registros
			$('#pagLinks_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				objMovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculos = $('#MovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculosBox').bPopup({
											   appendTo: '#MovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculosContent', 
				                               contentContainer: 'MovimientosEntradasRefaccionesInternasDevolucionTallerControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#txtReferencia_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_movimientos_entradas_refacciones_internas_devolucion_taller_control_vehiculos();
		});
	</script>