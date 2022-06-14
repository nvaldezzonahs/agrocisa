
	<div id="MovimientosSalidasRefaccionesTraspasoRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_movimientos_salidas_refacciones_traspaso_refacciones" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_movimientos_salidas_refacciones_traspaso_refacciones">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_movimientos_salidas_refacciones_traspaso_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_movimientos_salidas_refacciones_traspaso_refacciones"
				                    		name= "strFechaInicialBusq_movimientos_salidas_refacciones_traspaso_refacciones" 
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
								<label for="txtFechaFinalBusq_movimientos_salidas_refacciones_traspaso_refacciones">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_movimientos_salidas_refacciones_traspaso_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_movimientos_salidas_refacciones_traspaso_refacciones"
				                    		name= "strFechaFinalBusq_movimientos_salidas_refacciones_traspaso_refacciones" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					 <!--Autocomplete que contiene las sucursales activas (sin incluir la sucursal que se encuentra logeada en el sistema)-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal seleccionada-->
								<input id="txtSucursalSolicitudIDBusq_movimientos_salidas_refacciones_traspaso_refacciones" 
									   name="intSucursalSolicitudIDBusq_movimientos_salidas_refacciones_traspaso_refacciones"  
									   type="hidden" value="">
								</input>
								<label for="txtSucursalSolicitudBusq_movimientos_salidas_refacciones_traspaso_refacciones">Sucursal</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtSucursalSolicitudBusq_movimientos_salidas_refacciones_traspaso_refacciones" 
										name="strSucursalSolicitudBusq_movimientos_salidas_refacciones_traspaso_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese sucursal" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_movimientos_salidas_refacciones_traspaso_refacciones">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_movimientos_salidas_refacciones_traspaso_refacciones" 
								 		name="strEstatusBusq_movimientos_salidas_refacciones_traspaso_refacciones" tabindex="1">
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
								<label for="txtBusqueda_movimientos_salidas_refacciones_traspaso_refacciones">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_movimientos_salidas_refacciones_traspaso_refacciones" 
										name="strBusqueda_movimientos_salidas_refacciones_traspaso_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_movimientos_salidas_refacciones_traspaso_refacciones" 
									   	name="strImprimirDetalles_movimientos_salidas_refacciones_traspaso_refacciones" 
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
							<button class="btn btn-primary" id="btnBuscar_movimientos_salidas_refacciones_traspaso_refacciones"
									onclick="paginacion_movimientos_salidas_refacciones_traspaso_refacciones();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_movimientos_salidas_refacciones_traspaso_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_movimientos_salidas_refacciones_traspaso_refacciones"
									onclick="reporte_movimientos_salidas_refacciones_traspaso_refacciones('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_movimientos_salidas_refacciones_traspaso_refacciones"
									onclick="reporte_movimientos_salidas_refacciones_traspaso_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil.a3:nth-of-type(3):before {content: "Solicitud"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Sucursal"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

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
				<table class="table-hover movil" id="dg_movimientos_salidas_refacciones_traspaso_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Solicitud</th>
							<th class="movil">Sucursal</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_movimientos_salidas_refacciones_traspaso_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{folio_solicitud}}</td>
							<td class="movil a4">{{sucursal_solicitud}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="td-center movil a6"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_movimientos_salidas_refacciones_traspaso_refacciones({{movimiento_refacciones_id}})"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_movimientos_salidas_refacciones_traspaso_refacciones({{movimiento_refacciones_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_movimientos_salidas_refacciones_traspaso_refacciones({{movimiento_refacciones_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_movimientos_salidas_refacciones_traspaso_refacciones({{movimiento_refacciones_id}}, {{referencia_id}})" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_salidas_refacciones_traspaso_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_movimientos_salidas_refacciones_traspaso_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="MovimientosSalidasRefaccionesTraspasoRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_movimientos_salidas_refacciones_traspaso_refacciones"  class="ModalBodyTitle">
			<h1>Salidas por Traspaso</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMovimientosSalidasRefaccionesTraspasoRefacciones" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMovimientosSalidasRefaccionesTraspasoRefacciones"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!-- Folio -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMovimientoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones" 
										   name="intMovimientoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones" 
										   type="hidden" value="" />
									<label for="txtFolio_movimientos_salidas_refacciones_traspaso_refacciones">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_movimientos_salidas_refacciones_traspaso_refacciones" 
											name="strFolio_movimientos_salidas_refacciones_traspaso_refacciones" 
											type="text" value="" placeholder="Autogenerado" disabled />
								</div>
							</div>
						</div>
						<!-- Fecha -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_movimientos_salidas_refacciones_traspaso_refacciones">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_movimientos_salidas_refacciones_traspaso_refacciones'>
					                    <input class="form-control" 
					                    		id="txtFecha_movimientos_salidas_refacciones_traspaso_refacciones"
					                    		name= "strFecha_movimientos_salidas_refacciones_traspaso_refacciones" 
					                    		type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las solicitudes de refacciones por traspaso activas y parcialmente surtidas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la solicitud de refacciones por traspaso seleccionada-->
									<input id="txtSolicitudTraspasoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones" 
										   name="intSolicitudTraspasoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones"  
										   type="hidden"  value="">
									</input>
									<label for="txtSolicitudTraspasoRefacciones_movimientos_salidas_refacciones_traspaso_refacciones">Solicitud</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtSolicitudTraspasoRefacciones_movimientos_salidas_refacciones_traspaso_refacciones" 
											name="strSolicitudTraspasoRefacciones_movimientos_salidas_refacciones_traspaso_refacciones" 
											type="text" value="" tabindex="1" placeholder="Ingrese solicitud" maxlength="250" />
								</div>
							</div>	
						</div>
						<!--Sucursal -->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSucursalSolicitud_movimientos_salidas_refacciones_traspaso_refacciones">Sucursal</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtSucursalSolicitud_movimientos_salidas_refacciones_traspaso_refacciones" 
											name="strSucursalSolicitud_movimientos_salidas_refacciones_traspaso_refacciones" 
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
									<label for="txtObservaciones_movimientos_salidas_refacciones_traspaso_refacciones">Observaciones</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtObservaciones_movimientos_salidas_refacciones_traspaso_refacciones" 
											name="strObservaciones_movimientos_salidas_refacciones_traspaso_refacciones" 
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
									<input id="txtNumDetalles_movimientos_salidas_refacciones_traspaso_refacciones" 
										   name="intNumDetalles_movimientos_salidas_refacciones_traspaso_refacciones" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la salida por traspaso</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Código-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el renglón de la refacción-->
																<input id="txtRenglon_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																	   name="intRenglon_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar la cantidad solicitada de la refacción-->
																<input id="txtCantidadSolicitada_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																	   name="intCantidadSolicitada_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar la cantidad pendiente de la refacción-->
																<input id="txtCantidadPendiente_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																	   name="intCantidadPendiente_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar la existencia disponible de la refacción (en el inventario)  seleccionada-->
                                                                <input id="txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
                                                                       name="intDisponibleExistencia_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
                                                                       type="hidden" value="">
																<label for="txtCodigo_detalles_movimientos_salidas_refacciones_traspaso_refacciones">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																		name="strCodigo_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																		type="text" value="" disabled />
															</div>
														</div>
													</div>
													<!--Descripción-->
													<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDescripcion_detalles_movimientos_salidas_refacciones_traspaso_refacciones">
																	Descripción
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtDescripcion_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																		name="strDescripcion_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																		type="text" value="" disabled/>
															</div>
														</div>
													</div>
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_movimientos_salidas_refacciones_traspaso_refacciones" 
																		id="txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																		name="intCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="14" />
															</div>
														</div>
													</div>
													<!--Costo unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCostoUnitario_detalles_movimientos_salidas_refacciones_traspaso_refacciones">Costo unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCostoUnitario_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																		name="intCostoUnitario_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
																		type="text" value="" disabled />
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns" 
					                                			id="btnAgregar_detalles_movimientos_salidas_refacciones_traspaso_refacciones" 
					                                			onclick="agregar_renglon_detalles_movimientos_salidas_refacciones_traspaso_refacciones();" 
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
													<table class="table-hover movil" id="dg_detalles_movimientos_salidas_refacciones_traspaso_refacciones">
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
																	<strong id="acumSolicitado_detalles_movimientos_salidas_refacciones_traspaso_refacciones"></strong>
																</td>
																<td class="movil t4">
																	<strong id="acumSurtido_detalles_movimientos_salidas_refacciones_traspaso_refacciones"></strong>
																</td>
																<td class="movil t5"></td>
																<td class="movil t6">
																	<strong id="acumSubtotal_detalles_movimientos_salidas_refacciones_traspaso_refacciones"></strong>
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
																<strong id="numElementos_detalles_movimientos_salidas_refacciones_traspaso_refacciones">0</strong> encontrados
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
							<button class="btn btn-success" id="btnGuardar_movimientos_salidas_refacciones_traspaso_refacciones"  
									onclick="validar_movimientos_salidas_refacciones_traspaso_refacciones();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_movimientos_salidas_refacciones_traspaso_refacciones"  
									onclick="reporte_registro_movimientos_salidas_refacciones_traspaso_refacciones('');"  
									title="Imprimir" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_movimientos_salidas_refacciones_traspaso_refacciones"  
									onclick="cambiar_estatus_movimientos_salidas_refacciones_traspaso_refacciones('', '');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_movimientos_salidas_refacciones_traspaso_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_movimientos_salidas_refacciones_traspaso_refacciones();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MovimientosSalidasRefaccionesTraspasoRefaccionesContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMovimientosSalidasRefaccionesTraspasoRefacciones = 0;
		var strUltimaBusquedaMovimientosSalidasRefaccionesTraspasoRefacciones = "";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
        var intNumDecimalesMostrarMovimientosSalidasRefaccionesTraspasoRefacciones = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
        //Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
        var intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesTraspasoRefacciones = <?php echo NUM_DECIMALES_COSTO_UNIT_MOV_REFACCIONES ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objMovimientosSalidasRefaccionesTraspasoRefacciones = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_movimientos_salidas_refacciones_traspaso_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/movimientos_salidas_refacciones_traspaso/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_traspaso_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMovimientosSalidasRefaccionesTraspasoRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosMovimientosSalidasRefaccionesTraspasoRefacciones = strPermisosMovimientosSalidasRefaccionesTraspasoRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMovimientosSalidasRefaccionesTraspasoRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMovimientosSalidasRefaccionesTraspasoRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_movimientos_salidas_refacciones_traspaso_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMovimientosSalidasRefaccionesTraspasoRefacciones[i]=='GUARDAR') || (arrPermisosMovimientosSalidasRefaccionesTraspasoRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_movimientos_salidas_refacciones_traspaso_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesTraspasoRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_movimientos_salidas_refacciones_traspaso_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_movimientos_salidas_refacciones_traspaso_refacciones();
						}
						else if(arrPermisosMovimientosSalidasRefaccionesTraspasoRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_movimientos_salidas_refacciones_traspaso_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesTraspasoRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_movimientos_salidas_refacciones_traspaso_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesTraspasoRefacciones[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_movimientos_salidas_refacciones_traspaso_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesTraspasoRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_movimientos_salidas_refacciones_traspaso_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_movimientos_salidas_refacciones_traspaso_refacciones() 
		{
		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaMovimientosSalidasRefaccionesTraspasoRefacciones =($('#txtFechaInicialBusq_movimientos_salidas_refacciones_traspaso_refacciones').val()+$('#txtFechaFinalBusq_movimientos_salidas_refacciones_traspaso_refacciones').val()+$('#txtSucursalSolicitudIDBusq_movimientos_salidas_refacciones_traspaso_refacciones').val()+$('#cmbEstatusBusq_movimientos_salidas_refacciones_traspaso_refacciones').val()+$('#txtBusqueda_movimientos_salidas_refacciones_traspaso_refacciones').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaMovimientosSalidasRefaccionesTraspasoRefacciones != strUltimaBusquedaMovimientosSalidasRefaccionesTraspasoRefacciones)
			{
				intPaginaMovimientosSalidasRefaccionesTraspasoRefacciones = 0;
				strUltimaBusquedaMovimientosSalidasRefaccionesTraspasoRefacciones = strNuevaBusquedaMovimientosSalidasRefaccionesTraspasoRefacciones;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/movimientos_salidas_refacciones_traspaso/get_paginacion',
					{ //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					  dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_traspaso_refacciones').val()),
					  dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_traspaso_refacciones').val()),
					  intSucursalSolicitudID: $('#txtSucursalSolicitudIDBusq_movimientos_salidas_refacciones_traspaso_refacciones').val(),
					  strEstatus:     $('#cmbEstatusBusq_movimientos_salidas_refacciones_traspaso_refacciones').val(),
					  strBusqueda:    $('#txtBusqueda_movimientos_salidas_refacciones_traspaso_refacciones').val(),
					  intPagina: intPaginaMovimientosSalidasRefaccionesTraspasoRefacciones,
					  strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_traspaso_refacciones').val()
					},
					function(data){
						$('#dg_movimientos_salidas_refacciones_traspaso_refacciones tbody').empty();
						var tmpMovimientosSalidasRefaccionesTraspasoRefacciones = Mustache.render($('#plantilla_movimientos_salidas_refacciones_traspaso_refacciones').html(),data);
						$('#dg_movimientos_salidas_refacciones_traspaso_refacciones tbody').html(tmpMovimientosSalidasRefaccionesTraspasoRefacciones);
						$('#pagLinks_movimientos_salidas_refacciones_traspaso_refacciones').html(data.paginacion);
						$('#numElementos_movimientos_salidas_refacciones_traspaso_refacciones').html(data.total_rows);
						intPaginaMovimientosSalidasRefaccionesTraspasoRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_movimientos_salidas_refacciones_traspaso_refacciones(strTipo) 
		{
			
			//Variable que se utiliza para asignar URL (ruta del controlador)
            var strUrl = 'refacciones/movimientos_salidas_refacciones_traspaso/';

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
			if ($('#chbImprimirDetalles_movimientos_salidas_refacciones_traspaso_refacciones').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_movimientos_salidas_refacciones_traspaso_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_movimientos_salidas_refacciones_traspaso_refacciones').val('NO');
			}

            //Definir encapsulamiento de datos que son necesarios para generar el reporte
            objReporte = {'url': strUrl,
                            'data' : {
                                        'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_traspaso_refacciones').val()),
                                        'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_traspaso_refacciones').val()),
                                        'intSucursalSolicitudID': $('#txtSucursalSolicitudIDBusq_movimientos_salidas_refacciones_traspaso_refacciones').val(),
                                        'strEstatus': $('#cmbEstatusBusq_movimientos_salidas_refacciones_traspaso_refacciones').val(), 
                                        'strBusqueda': $('#txtBusqueda_movimientos_salidas_refacciones_traspaso_refacciones').val(),
                                        'strDetalles': $('#chbImprimirDetalles_movimientos_salidas_refacciones_traspaso_refacciones').val()       
                                     }
                           };


            //Hacer un llamado a la función para imprimir/descargar el reporte
            $.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_movimientos_salidas_refacciones_traspaso_refacciones(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val();
			}
			else
			{
				intID = id;
			}

			 //Definir encapsulamiento de datos que son necesarios para generar el reporte
            objReporte = {'url': 'refacciones/movimientos_salidas_refacciones_traspaso/get_reporte_registro',
                            'data' : {
                                        'intMovimientoRefaccionesID': intID
                                     }
                           };

            //Hacer un llamado a la función para imprimir el reporte
            $.imprimirReporte(objReporte);

		}

		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_movimientos_salidas_refacciones_traspaso_refacciones()
		{
			//Incializar formulario
			$('#frmMovimientosSalidasRefaccionesTraspasoRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_salidas_refacciones_traspaso_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmMovimientosSalidasRefaccionesTraspasoRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
            $.removerClasesEncabezado('divEncabezadoModal_movimientos_salidas_refacciones_traspaso_refacciones');
			
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_movimientos_salidas_refacciones_traspaso_refacciones();
			
			//Habilitar todos los elementos del formulario
			$('#frmMovimientosSalidasRefaccionesTraspasoRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_movimientos_salidas_refacciones_traspaso_refacciones').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_movimientos_salidas_refacciones_traspaso_refacciones').attr("disabled", "disabled");
			$('#txtSucursalSolicitud_movimientos_salidas_refacciones_traspaso_refacciones').attr("disabled", "disabled");
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_traspaso_refacciones').attr("disabled", "disabled");
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_traspaso_refacciones').attr("disabled", "disabled");
			$('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_traspaso_refacciones').attr("disabled", "disabled");
 			//Mostrar los siguientes botones
			$("#btnGuardar_movimientos_salidas_refacciones_traspaso_refacciones").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_movimientos_salidas_refacciones_traspaso_refacciones").hide();
			$("#btnDesactivar_movimientos_salidas_refacciones_traspaso_refacciones").hide();
		}

	
		//Función para inicializar elementos de la solicitud de refacciones por traspaso
		function inicializar_solicitud_movimientos_salidas_refacciones_traspaso_refacciones()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtSucursalSolicitud_movimientos_salidas_refacciones_traspaso_refacciones').val('');

            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_movimientos_salidas_refacciones_traspaso_refacciones();
           
		}
																	
		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_movimientos_salidas_refacciones_traspaso_refacciones()
		{
			//Hacer un llamado a la función para inicializar elementos de la refacción
			inicializar_refaccion_detalles_movimientos_salidas_refacciones_traspaso_refacciones();
			//Eliminar los datos de la tabla detalles del movimiento
			$('#dg_detalles_movimientos_salidas_refacciones_traspaso_refacciones tbody').empty();
			$('#acumSolicitado_detalles_movimientos_salidas_refacciones_traspaso_refacciones').html('');
		    $('#acumSurtido_detalles_movimientos_salidas_refacciones_traspaso_refacciones').html('');
		    $('#acumSubtotal_detalles_movimientos_salidas_refacciones_traspaso_refacciones').html('');
		    $('#numElementos_detalles_movimientos_salidas_refacciones_traspaso_refacciones').html(0);
			$('#txtNumDetalles_movimientos_salidas_refacciones_traspaso_refacciones').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_movimientos_salidas_refacciones_traspaso_refacciones()
		{
			try {
				//Cerrar modal
				objMovimientosSalidasRefaccionesTraspasoRefacciones.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_movimientos_salidas_refacciones_traspaso_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_movimientos_salidas_refacciones_traspaso_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_salidas_refacciones_traspaso_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmMovimientosSalidasRefaccionesTraspasoRefacciones')
				.bootstrapValidator({	excluded: [':disabled'],
									 	container: 'popover',
									 	feedbackIcons: {
									 		valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
									  	},
									  	fields: {
											strFecha_movimientos_salidas_refacciones_traspaso_refacciones: {
												validators: {
													notEmpty: {message: 'Seleccione una fecha'}
												}
											},
											strSolicitudTraspasoRefacciones_movimientos_salidas_refacciones_traspaso_refacciones: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la solicitud de refacciones por traspaso
						                                    if($('#txtSolicitudTraspasoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val() === '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba una solicitud de traspaso existente'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
											intNumDetalles_movimientos_salidas_refacciones_traspaso_refacciones: {
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
										    intCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones: {
										        excluded: true  // Ignorar (no valida el campo)    
										    }
										}
									});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_movimientos_salidas_refacciones_traspaso_refacciones = $('#frmMovimientosSalidasRefaccionesTraspasoRefacciones').data('bootstrapValidator');
			bootstrapValidator_movimientos_salidas_refacciones_traspaso_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_movimientos_salidas_refacciones_traspaso_refacciones.isValid())
			{

				//Hacer un llamado a la función para guardar los datos del registro
				guardar_movimientos_salidas_refacciones_traspaso_refacciones();
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_movimientos_salidas_refacciones_traspaso_refacciones()
		{
			try
			{
				$('#frmMovimientosSalidasRefaccionesTraspasoRefacciones').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_movimientos_salidas_refacciones_traspaso_refacciones()
		{
			//Variable que se utiliza para asignar el acumulado de las refacciones surtidas
			var intAcumSurtidoDetallesMovimiento = 0;

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_traspaso_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRenglon = [];
			var arrRefaccionID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCodigosLineas = [];
			var arrCantidades = [];
			var arrCostosUnitarios = [];
			var arrBackOrderTraspasoID = [];
			var arrCantidadesBackOrder = [];
			var arrEstatusBackOrder = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidadSolicitada =  parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				var intCantidad =  parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				var intCostoUnitario = parseFloat($.reemplazar(objRen.cells[12].innerHTML, ",", ""));
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
					arrBackOrderTraspasoID.push(objRen.cells[7].innerHTML);
					arrCantidadesBackOrder.push(intCantidadPendiente);
					arrEstatusBackOrder.push(strEstatusPedido);
				}
				
				//Incrementar acunulado de refacciones surtidas
				intAcumSurtidoDetallesMovimiento += intCantidadSurtida;
			}

			//Variable que se utiliza para asignar el estatus de la solicitud de refacciones por traspaso
			var strEstatusSolicitudTraspasoRefacciones = 'PARCIALMENTE SURTIDO';
			//Variable que se utiliza para asignar el acumulado de las refacciones solicitadas
			var intAcumSolicitadoDetallesMovimiento = parseFloat($.reemplazar($('#acumSolicitado_detalles_movimientos_salidas_refacciones_traspaso_refacciones').html(), ",", ""));
 
			//Si el acumulado de las refaccione solicitadas es igual al acumulado de las refacciones surtidas
			if(intAcumSolicitadoDetallesMovimiento == intAcumSurtidoDetallesMovimiento)
			{
				//Cambiar el estatus de la requisición de la refacción
				strEstatusSolicitudTraspasoRefacciones = 'SURTIDO';
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/movimientos_salidas_refacciones_traspaso/guardar',
					{ 
						//Datos del movimiento
						intMovimientoRefaccionesID: $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_salidas_refacciones_traspaso_refacciones').val()),
						intReferenciaID: $('#txtSolicitudTraspasoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val(),
						strObservaciones: $('#txtObservaciones_movimientos_salidas_refacciones_traspaso_refacciones').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_refacciones_traspaso_refacciones').val(),
						//Datos de la solicitud de refacciones por traspaso
						strEstatusSolicitudTraspaso: strEstatusSolicitudTraspasoRefacciones,
						//Datos de los detalles
						strRenglon: arrRenglon.join('|'),
						strRefaccionID: arrRefaccionID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strCodigosLineas: arrCodigosLineas.join('|'),
						strCantidades: arrCantidades.join('|'),
						strCostosUnitarios: arrCostosUnitarios.join('|'),
						//Datos del pedido pendiente
						strBackOrderTraspasoID: arrBackOrderTraspasoID.join('|'),
						strCantidadesBackOrder: arrCantidadesBackOrder.join('|'),
						strEstatusBackOrder: arrEstatusBackOrder.join('|')
					},
					function(data) {
						if (data.resultado)
						{	
		                    //Hacer un llamado a la función para cerrar modal
		                    cerrar_movimientos_salidas_refacciones_traspaso_refacciones();
		                    //Hacer llamado a la función  para cargar  los registros en el grid
		               		paginacion_movimientos_salidas_refacciones_traspaso_refacciones();  
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_movimientos_salidas_refacciones_traspaso_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_movimientos_salidas_refacciones_traspaso_refacciones(tipoMensaje, mensaje)
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
													$('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').focus();
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
		function cambiar_estatus_movimientos_salidas_refacciones_traspaso_refacciones(movimientoRefaccionesID, referenciaID)
		{
			//Variable que se utiliza para asignar el id del movimiento
			var intID = 0;
			//Variable que se utiliza para asignar el id de la referencia
			var intSolicitudTraspasoRefaccionesID = 0;

			//Si no existe id del movimiento, significa que se realizará la modificación desde el modal
			if(movimientoRefaccionesID == '')
			{
				intID = $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val();
				intSolicitudTraspasoRefaccionesID = $('#txtSolicitudTraspasoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val();
			}
			else
			{
				intID = movimientoRefaccionesID;
				intSolicitudTraspasoRefaccionesID = referenciaID;
			}

			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
					             {'type':     'question',
					              'title':    'Salidas por Traspaso',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('refacciones/movimientos_salidas_refacciones_traspaso/set_estatus',
					                                     {intMovimientoRefaccionesID: intID,
					                                      intReferenciaID: intSolicitudTraspasoRefaccionesID
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                          //Hacer llamado a la función  para cargar  los registros en el grid
					                                          paginacion_movimientos_salidas_refacciones_traspaso_refacciones();

					                                           //Si el id del registro se obtuvo del modal
		                                                        if(movimientoRefaccionesID == '')
		                                                        {
		                                                            //Hacer un llamado a la función para cerrar modal
		                                                            cerrar_movimientos_salidas_refacciones_traspaso_refacciones();     
		                                                        }
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_movimientos_salidas_refacciones_traspaso_refacciones(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_movimientos_salidas_refacciones_traspaso_refacciones(id)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/movimientos_salidas_refacciones_traspaso/get_datos',
			       {intMovimientoRefaccionesID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_movimientos_salidas_refacciones_traspaso_refacciones();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val(data.row.movimiento_refacciones_id);
				            $('#txtFolio_movimientos_salidas_refacciones_traspaso_refacciones').val(data.row.folio);
				            $('#txtFecha_movimientos_salidas_refacciones_traspaso_refacciones').val(data.row.fecha);
				            $('#txtSolicitudTraspasoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val(data.row.referencia_id);
				            $('#txtSolicitudTraspasoRefacciones_movimientos_salidas_refacciones_traspaso_refacciones').val(data.row.folio_solicitud);
				            $('#txtSucursalSolicitud_movimientos_salidas_refacciones_traspaso_refacciones').val(data.row.sucursal_solicitud);
						    $('#txtObservaciones_movimientos_salidas_refacciones_traspaso_refacciones').val(data.row.observaciones);
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_movimientos_salidas_refacciones_traspaso_refacciones').addClass("estatus-"+strEstatus);
				            //Hacer llamado a la función  para cargar los detalles del registro en el grid
				            lista_detalles_movimientos_salidas_refacciones_traspaso_refacciones('Editar', strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_movimientos_salidas_refacciones_traspaso_refacciones").show();

							//Si el estatus del registro es INACTIVO o cuenta con entradas por traspaso 
				            if(strEstatus == 'INACTIVO' || data.row.total_entradas_traspaso > 0)
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmMovimientosSalidasRefaccionesTraspasoRefacciones').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_movimientos_salidas_refacciones_traspaso_refacciones").hide();
				            }
				            else
				            {
				            	//Mostrar el botón Desactivar
				            	$("#btnDesactivar_movimientos_salidas_refacciones_traspaso_refacciones").show();
				            }

			            	//Abrir modal
							objMovimientosSalidasRefaccionesTraspasoRefacciones = $('#MovimientosSalidasRefaccionesTraspasoRefaccionesBox').bPopup({
														   appendTo: '#MovimientosSalidasRefaccionesTraspasoRefaccionesContent', 
							                               contentContainer: 'MovimientosSalidasRefaccionesTraspasoRefaccionesM', 
							                               zIndex: 2, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtSolicitudTraspasoRefacciones_movimientos_salidas_refacciones_traspaso_refacciones').focus();
			       	    }
			       },
			       'json');
		}

		

		//Función para regresar obtener los datos de una solicitud de traspaso
		function get_datos_solicitud_traspaso_movimientos_salidas_refacciones_traspaso_refacciones()
		{
			  //Hacer un llamado al método del controlador para regresar los datos de la solicitud de traspaso
              $.post('refacciones/solicitudes_traspasos_refacciones/get_datos',
                  { 
                  	intSolicitudTraspasoRefaccionesID: $("#txtSolicitudTraspasoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones").val(),
                  },
                  function(data) {
                    if(data.row){
                    	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
						inicializar_detalles_movimientos_salidas_refacciones_traspaso_refacciones();
                    	//Recuperar valores
             		    $('#txtSolicitudTraspasoRefacciones_movimientos_salidas_refacciones_traspaso_refacciones').val(data.row.folio);
             		    $('#txtSucursalSolicitud_movimientos_salidas_refacciones_traspaso_refacciones').val(data.row.sucursal_solicitud);
             		    //Hacer llamado a la función  para cargar los detalles del registro en el grid
             		    lista_detalles_movimientos_salidas_refacciones_traspaso_refacciones('Nuevo', '');
                    }
                }
                 ,
                'json');


		}

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_movimientos_salidas_refacciones_traspaso_refacciones()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val('');
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val('');
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val('');
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val('');
			$('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val('');
			$('#txtCantidadSolicitada_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val('');
			$('#txtCantidadPendiente_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val('');
			$('#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val('');
            
		}

		//Función para la búsqueda de detalles del registro
		function lista_detalles_movimientos_salidas_refacciones_traspaso_refacciones(tipoAccion, estatus) 
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Si se cumple la sentencia
			if(estatus == '' || estatus == 'ACTIVO')
			{
				strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
								   "	onclick='editar_renglon_detalles_movimientos_salidas_refacciones_traspaso_refacciones(this)'>" + 
								   "<span class='glyphicon glyphicon-edit'></span></button>";
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/movimientos_salidas_refacciones_traspaso/get_datos_detalles',
			       {intMovimientoRefaccionesID: $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val(),
			       	intReferenciaID: $('#txtSolicitudTraspasoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val()
			       },
			       function(data) {

			            //Mostramos los detalles del registro
			            for (var intCon in data.detalles) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_traspaso_refacciones').getElementsByTagName('tbody')[0];

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
							var objCeldaBackOrderID = objRenglon.insertCell(7);
							var objCeldaCantidadBackOrder = objRenglon.insertCell(8);
							var objRefaccionID = objRenglon.insertCell(9);
							var objCeldaCodigoLinea = objRenglon.insertCell(10);
							var objCeldaDisponibleExistencia = objRenglon.insertCell(11);
							var objCeldaCostoUnitarioBD = objRenglon.insertCell(12);


							//Variables que se utilizan para asignar valores del detalle
							var intSubtotal = 0;
							var intCantidadSolicitada =  parseFloat(data.detalles[intCon].cantidad_solicitada);
							var intCantidad = parseFloat(data.detalles[intCon].cantidad_surtida);
							var intCostoUnitario = parseFloat(data.detalles[intCon].actual_costo);
							
							//Variable que se utiliza para asignar el id del pedido pendiente
							var intBackOrderTraspasoID = data.detalles[intCon].back_order_traspaso_id;
							//Variable que se utiliza para asignar la cantidad que esta pendiente
							var intCantidadPendiente = parseFloat(data.detalles[intCon].cantidad_pendiente);
							//Variable que se utiliza para asignar la existencia disponible
							var intDisponibleExistencia = parseFloat(data.detalles[intCon].disponible_existencia);


							//Si no existe id del back_order (pedido)
							if(intBackOrderTraspasoID == 0)
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
								intSubtotal = intCantidad * intCostoUnitario;
							}

							//Calcular la existencia disponible
                            intDisponibleExistencia = intCantidad + intDisponibleExistencia;

                            //Cambiar cantidad a  formato moneda (a visualizar)
                    	    intCantidadSolicitada =  formatMoney(intCantidadSolicitada, 2, '');
                    	    intCantidad =  formatMoney(intCantidad, 2, '');

                    	    var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosSalidasRefaccionesTraspasoRefacciones, '');

                    	    var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesTraspasoRefacciones, '');

                    	      //Cambiar cantidad a  formato moneda (a guardar en la  BD)
                   			 var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesTraspasoRefacciones, '');


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
							objCeldaBackOrderID.setAttribute('class', 'no-mostrar');
							objCeldaBackOrderID.innerHTML = intBackOrderTraspasoID; 
							objCeldaCantidadBackOrder.setAttribute('class', 'no-mostrar');
							objCeldaCantidadBackOrder.innerHTML = intCantidadPendiente; 
							objRefaccionID.setAttribute('class', 'no-mostrar');
							objRefaccionID.innerHTML = data.detalles[intCon].refaccion_id; 
							objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
							objCeldaCodigoLinea.innerHTML = data.detalles[intCon].codigo_linea; 
							objCeldaDisponibleExistencia.setAttribute('class', 'no-mostrar');
							objCeldaDisponibleExistencia.innerHTML = intDisponibleExistencia; 
							objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
                        	objCeldaCostoUnitarioBD.innerHTML = intCostoUnitarioBD;
							
			            }

			            //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_salidas_refacciones_traspaso_refacciones();
			            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_traspaso_refacciones tr").length - 2;
						$('#numElementos_detalles_movimientos_salidas_refacciones_traspaso_refacciones').html(intFilas);
			       },
			       'json');

		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_movimientos_salidas_refacciones_traspaso_refacciones()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla movimientos_refacciones_detalles)
			var intSubtotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val();
			var intCantidad = $('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val();
			var intCostoUnitario = $('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val();
			var intCantidadSolicitada = $('#txtCantidadSolicitada_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val();
			var intCantidadPendiente = $('#txtCantidadPendiente_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val();
			var intDisponibleExistencia = $('#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val()
			

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_traspaso_refacciones').getElementsByTagName('tbody')[0];

			//Si existe ID del renglón
			if (intRenglon != '' )
			{
				//Validamos que se capturaron datos
				if (intCantidad == '')
				{
					//Enfocar caja de texto
					$('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').focus();
				}
				else
				{
					//Convertir cadena de texto a número decimal
					intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
					intSubtotal =  parseFloat($.reemplazar(intCostoUnitario, ",", ""));
					intCantidadSolicitada = parseFloat($.reemplazar(intCantidadSolicitada, ",", ""));
					intCantidadPendiente = parseFloat(intCantidadPendiente);
					intDisponibleExistencia = parseFloat(intDisponibleExistencia);

					//Verificar que la cantidad sea menor o igual que la existencia disponible
					if(intCantidad <= intCantidadPendiente && intCantidad <= intDisponibleExistencia)
					{
						//Hacer un llamado a la función para inicializar elementos de la refacción
						inicializar_refaccion_detalles_movimientos_salidas_refacciones_traspaso_refacciones();
						
						//Calcular subtotal
						intSubtotal = intCantidad * intSubtotal;

						//Cambiar cantidad a  formato moneda (a visualizar)
	                    intCantidad =  formatMoney(intCantidad, 2, '');

	                    var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesTraspasoRefacciones, '');

						//Editar los datos del detalle
					    objTabla.rows.namedItem(intRenglon).cells[3].innerHTML = intCantidad;
					    objTabla.rows.namedItem(intRenglon).cells[5].innerHTML = intSubtotalMostrar;

					    //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_salidas_refacciones_traspaso_refacciones();

						//Enfocar caja de texto
						$('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').focus();
					}
					else
					{
			    		//Si la existencia disponible es menor que la cantidad a surtir
						if(intDisponibleExistencia < intCantidad)
						{
							//Si la existencia disponible es mayor que la cantidad pendiente
							if(intDisponibleExistencia > intCantidadPendiente)
							{
								//Cambiar la cantidad a surtir
								intCantidad = intCantidadPendiente;
							}
							else
							{
								//Cambiar la cantidad a surtir
								intCantidad = intDisponibleExistencia;
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
						$('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val(intCantidad);

						//Hacer un llamado a la función para mostrar mensaje de información
					    mensaje_movimientos_salidas_refacciones_traspaso_refacciones('informacion', strMensaje);
					}
					
				}


				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_traspaso_refacciones tr").length - 2;
				$('#numElementos_detalles_movimientos_salidas_refacciones_traspaso_refacciones').html(intFilas);
		    }
		    else
		    {
		    	//Limpiar caja de texto
		    	$('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val('');
		    }
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_movimientos_salidas_refacciones_traspaso_refacciones(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidadSolicitada_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
			$('#txtCantidadPendiente_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val(objRenglon.parentNode.parentNode.cells[8].innerHTML);
			$('#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			//Enfocar caja de texto
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').focus();
		}


		//Función para calcular totales de la tabla
		function calcular_totales_detalles_movimientos_salidas_refacciones_traspaso_refacciones()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_traspaso_refacciones').getElementsByTagName('tbody')[0];

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

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				//Convertir cadena de texto a número decimal
				intCantidadSolicitada = parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				intCantidadSurtida = parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				//Incrementar acumulados
				intAcumSolicitado += intCantidadSolicitada;
				intAcumSurtido += intCantidadSurtida;
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				
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
            intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesTraspasoRefacciones, '');

			//Asignar los valores
			$('#acumSolicitado_detalles_movimientos_salidas_refacciones_traspaso_refacciones').html(intAcumSolicitado);
			$('#acumSurtido_detalles_movimientos_salidas_refacciones_traspaso_refacciones').html(intAcumSurtido);
			$('#acumSubtotal_detalles_movimientos_salidas_refacciones_traspaso_refacciones').html(intAcumSubtotal);
			$('#txtNumDetalles_movimientos_salidas_refacciones_traspaso_refacciones').val(intContadorDetalles);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').numeric();

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_movimientos_salidas_refacciones_traspaso_refacciones').blur(function(){
                $('.cantidad_movimientos_salidas_refacciones_traspaso_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
            });

            //Agregar datepicker para seleccionar fecha
			$('#dteFecha_movimientos_salidas_refacciones_traspaso_refacciones').datetimepicker({format: 'DD/MM/YYYY'});

			
	        //Autocomplete para recuperar los datos de una solicitud de refacciones por traspaso
	        $('#txtSolicitudTraspasoRefacciones_movimientos_salidas_refacciones_traspaso_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSolicitudTraspasoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la solicitud de refacciones por traspaso
	               inicializar_solicitud_movimientos_salidas_refacciones_traspaso_refacciones();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/solicitudes_traspasos_refacciones/autocomplete",
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
	              $('#txtSolicitudTraspasoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val(ui.item.data);
	            	//Hacer un llamado a la función para regresar los datos de la solicitud de traspaso
	                get_datos_solicitud_traspaso_movimientos_salidas_refacciones_traspaso_refacciones();

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
			//Verificar que exista id de la solicitud por traspaso cuando pierda el enfoque la caja de texto
	        $('#txtSolicitudTraspasoRefacciones_movimientos_salidas_refacciones_traspaso_refacciones').focusout(function(e){
	            //Si no existe id de la entrada
	            if($('#txtSolicitudTraspasoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val() == '' ||
	               $('#txtSolicitudTraspasoRefacciones_movimientos_salidas_refacciones_traspaso_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSolicitudTraspasoRefaccionesID_movimientos_salidas_refacciones_traspaso_refacciones').val('');
	               $('#txtSolicitudTraspasoRefacciones_movimientos_salidas_refacciones_traspaso_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la solicitud de refacciones por traspaso
	               inicializar_solicitud_movimientos_salidas_refacciones_traspaso_refacciones();
	            }

	        });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_salidas_refacciones_traspaso_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar botón Agregar
			   	    	$('#btnAgregar_detalles_movimientos_salidas_refacciones_traspaso_refacciones').focus();
			   	    }
		        }
		    });

			
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_movimientos_salidas_refacciones_traspaso_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_movimientos_salidas_refacciones_traspaso_refacciones').datetimepicker({format: 'DD/MM/YYYY',
			 																		                            useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_movimientos_salidas_refacciones_traspaso_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_movimientos_salidas_refacciones_traspaso_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_movimientos_salidas_refacciones_traspaso_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_movimientos_salidas_refacciones_traspaso_refacciones').data('DateTimePicker').maxDate(e.date);
			});
			
			//Autocomplete para recuperar los datos de una sucursal (sin incluir la sucursal que se encuentra logeada en el sistema)
	        $('#txtSucursalSolicitudBusq_movimientos_salidas_refacciones_traspaso_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSucursalSolicitudIDBusq_movimientos_salidas_refacciones_traspaso_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "administracion/sucursales/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   //No incluir a la surcursal que se encuentra logeada en el sistema
                       strTipo: 'no incluir'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtSucursalSolicitudIDBusq_movimientos_salidas_refacciones_traspaso_refacciones').val(ui.item.data);
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
	        $('#txtSucursalSolicitudBusq_movimientos_salidas_refacciones_traspaso_refacciones').focusout(function(e){
	            //Si no existe id de la sucursal
	            if($('#txtSucursalSolicitudIDBusq_movimientos_salidas_refacciones_traspaso_refacciones').val() == '' ||
	               $('#txtSucursalSolicitudBusq_movimientos_salidas_refacciones_traspaso_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSucursalSolicitudIDBusq_movimientos_salidas_refacciones_traspaso_refacciones').val('');
	               $('#txtSucursalSolicitudBusq_movimientos_salidas_refacciones_traspaso_refacciones').val('');
	            }

	        });

	        //Paginación de registros
			$('#pagLinks_movimientos_salidas_refacciones_traspaso_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaMovimientosSalidasRefaccionesTraspasoRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_movimientos_salidas_refacciones_traspaso_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_movimientos_salidas_refacciones_traspaso_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_movimientos_salidas_refacciones_traspaso_refacciones();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_movimientos_salidas_refacciones_traspaso_refacciones').addClass("estatus-NUEVO");
				//Abrir modal
				objMovimientosSalidasRefaccionesTraspasoRefacciones = $('#MovimientosSalidasRefaccionesTraspasoRefaccionesBox').bPopup({
											   appendTo: '#MovimientosSalidasRefaccionesTraspasoRefaccionesContent', 
				                               contentContainer: 'MovimientosSalidasRefaccionesTraspasoRefaccionesM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#txtSolicitudTraspasoRefacciones_movimientos_salidas_refacciones_traspaso_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_movimientos_salidas_refacciones_traspaso_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_movimientos_salidas_refacciones_traspaso_refacciones();
		});
	</script>