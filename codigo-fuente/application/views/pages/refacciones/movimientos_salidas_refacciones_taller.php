
	<div id="MovimientosSalidasRefaccionesTallerRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_movimientos_salidas_refacciones_taller_refacciones" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_movimientos_salidas_refacciones_taller_refacciones">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_movimientos_salidas_refacciones_taller_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_movimientos_salidas_refacciones_taller_refacciones"
				                    		name= "strFechaInicialBusq_movimientos_salidas_refacciones_taller_refacciones" 
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
								<label for="txtFechaFinalBusq_movimientos_salidas_refacciones_taller_refacciones">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_movimientos_salidas_refacciones_taller_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_movimientos_salidas_refacciones_taller_refacciones"
				                    		name= "strFechaFinalBusq_movimientos_salidas_refacciones_taller_refacciones" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los prospectos y clientes activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del prospecto/cliente seleccionado-->
								<input id="txtProspectoIDBusq_movimientos_salidas_refacciones_taller_refacciones" 
									   name="intProspectoIDBusq_movimientos_salidas_refacciones_taller_refacciones"  
									   type="hidden" value="">
								</input>
								<label for="txtProspectoBusq_movimientos_salidas_refacciones_taller_refacciones">Cliente</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProspectoBusq_movimientos_salidas_refacciones_taller_refacciones" 
										name="strProspectoBusq_movimientos_salidas_refacciones_taller_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese cliente" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!-- Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_movimientos_salidas_refacciones_taller_refacciones">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_movimientos_salidas_refacciones_taller_refacciones" 
								 		name="strEstatusBusq_movimientos_salidas_refacciones_taller_refacciones" tabindex="1">
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
								<label for="txtBusqueda_movimientos_salidas_refacciones_taller_refacciones">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_movimientos_salidas_refacciones_taller_refacciones" 
										name="strBusqueda_movimientos_salidas_refacciones_taller_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_movimientos_salidas_refacciones_taller_refacciones" 
									   	name="strImprimirDetalles_movimientos_salidas_refacciones_taller_refacciones" 
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
							<button class="btn btn-primary" id="btnBuscar_movimientos_salidas_refacciones_taller_refacciones"
									onclick="paginacion_movimientos_salidas_refacciones_taller_refacciones();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_movimientos_salidas_refacciones_taller_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_movimientos_salidas_refacciones_taller_refacciones"
									onclick="reporte_movimientos_salidas_refacciones_taller_refacciones('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_movimientos_salidas_refacciones_taller_refacciones"
									onclick="reporte_movimientos_salidas_refacciones_taller_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil.a3:nth-of-type(3):before {content: "Requisición"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Orden"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Cliente"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles del movimiento
				*/
				td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Solicitado"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Surtido"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Precio Unit."; font-weight: bold;}
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
				<table class="table-hover movil" id="dg_movimientos_salidas_refacciones_taller_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Requisición</th>
							<th class="movil">Orden</th>
							<th class="movil">Cliente</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_movimientos_salidas_refacciones_taller_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{folio_requisicion}}</td>
							<td class="movil a4">{{folio_orden_reparacion}}</td>
							<td class="movil a5">{{prospecto}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_movimientos_salidas_refacciones_taller_refacciones({{movimiento_refacciones_id}}, 'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_movimientos_salidas_refacciones_taller_refacciones({{movimiento_refacciones_id}}, 'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_movimientos_salidas_refacciones_taller_refacciones({{movimiento_refacciones_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
								</button>
								 <!--Generar póliza-->
                                <button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
                                        onclick="generar_poliza_movimientos_salidas_refacciones_taller_refacciones({{movimiento_refacciones_id}}, 'principal')"  title="Generar póliza">
                                    <span class="glyphicon glyphicon-tags"></span>
                                </button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_movimientos_salidas_refacciones_taller_refacciones({{movimiento_refacciones_id}}, {{referencia_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_salidas_refacciones_taller_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_movimientos_salidas_refacciones_taller_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
        <div id="divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_taller_refacciones" class="load-container load5 circulo_bar no-mostrar">
            <div class="loader">Loading...</div>
            <br><br>
            <div align=center><b>Espere un momento por favor.</b></div>
        </div>  


		<!-- Diseño del modal-->
		<div id="MovimientosSalidasRefaccionesTallerRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_movimientos_salidas_refacciones_taller_refacciones"  class="ModalBodyTitle">
			<h1>Salidas por Taller</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMovimientosSalidasRefaccionesTallerRefacciones" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMovimientosSalidasRefaccionesTallerRefacciones"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!-- Folio -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMovimientoRefaccionesID_movimientos_salidas_refacciones_taller_refacciones" 
										   name="intMovimientoRefaccionesID_movimientos_salidas_refacciones_taller_refacciones" 
										   type="hidden" value="" />
								    <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
                                    <input id="txtPolizaID_movimientos_salidas_refacciones_taller_refacciones" 
                                           name="intPolizaID_movimientos_salidas_refacciones_taller_refacciones" type="hidden" value="" />
                                    <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
                                    <input id="txtFolioPoliza_movimientos_salidas_refacciones_taller_refacciones" 
                                           name="strFolioPoliza_movimientos_salidas_refacciones_taller_refacciones" type="hidden" value="" />
									<label for="txtFolio_movimientos_salidas_refacciones_taller_refacciones">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_movimientos_salidas_refacciones_taller_refacciones" 
											name="strFolio_movimientos_salidas_refacciones_taller_refacciones" 
											type="text" value="" placeholder="Autogenerado" disabled />
								</div>
							</div>
						</div>
						<!-- Fecha -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_movimientos_salidas_refacciones_taller_refacciones">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_movimientos_salidas_refacciones_taller_refacciones'>
					                    <input class="form-control" 
					                    		id="txtFecha_movimientos_salidas_refacciones_taller_refacciones"
					                    		name= "strFecha_movimientos_salidas_refacciones_taller_refacciones" 
					                    		type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Moneda-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la moneda-->
									<input id="txtMonedaID_movimientos_salidas_refacciones_taller_refacciones" 
										   name="intMonedaID_movimientos_salidas_refacciones_taller_refacciones"  
										   type="hidden"  value="">
									<label for="txtMoneda_movimientos_salidas_refacciones_taller_refacciones">Moneda</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMoneda_movimientos_salidas_refacciones_taller_refacciones" 
											name="strMoneda_movimientos_salidas_refacciones_taller_refacciones" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_movimientos_salidas_refacciones_taller_refacciones">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTipoCambio_movimientos_salidas_refacciones_taller_refacciones" 
											name="intTipoCambio_movimientos_salidas_refacciones_taller_refacciones" 
											type="text" value="" disabled/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene las requisiciones de refacciones activas y parcialmente surtidas-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la requisición de refacciones seleccionada-->
									<input id="txtRequisicionRefaccionesID_movimientos_salidas_refacciones_taller_refacciones" 
										   name="intRequisicionRefaccionesID_movimientos_salidas_refacciones_taller_refacciones"  
										   type="hidden"  value="">
									</input>
									<label for="txtRequisicionRefacciones_movimientos_salidas_refacciones_taller_refacciones">Requisición</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtRequisicionRefacciones_movimientos_salidas_refacciones_taller_refacciones" 
											name="strRequisicionRefacciones_movimientos_salidas_refacciones_taller_refacciones" 
											type="text" value="" tabindex="1" placeholder="Ingrese requisición" maxlength="250" />
								</div>
							</div>	
						</div>
						<!--Orden de reparación -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtOrdenReparacion_movimientos_salidas_refacciones_taller_refacciones">No. de orden</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtOrdenReparacion_movimientos_salidas_refacciones_taller_refacciones" 
											name="strOrdenReparacion_movimientos_salidas_refacciones_taller_refacciones" 
											type="text" value="" disabled />
								</div>
							</div>
						</div>
						<!--Prospecto-->
						<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtProspecto_movimientos_salidas_refacciones_taller_refacciones">Cliente</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtProspecto_movimientos_salidas_refacciones_taller_refacciones" 
											name="strProspecto_movimientos_salidas_refacciones_taller_refacciones" 
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
									<label for="txtObservaciones_movimientos_salidas_refacciones_taller_refacciones">Observaciones</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtObservaciones_movimientos_salidas_refacciones_taller_refacciones" 
											name="strObservaciones_movimientos_salidas_refacciones_taller_refacciones" 
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
									<input id="txtNumDetalles_movimientos_salidas_refacciones_taller_refacciones" 
										   name="intNumDetalles_movimientos_salidas_refacciones_taller_refacciones" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la salida por taller</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Código-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el renglón de la refacción-->
																<input id="txtRenglon_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																	   name="intRenglon_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar la cantidad solicitada de la refacción-->
																<input id="txtCantidadSolicitada_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																	   name="intCantidadSolicitada_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar la cantidad pendiente de la refacción-->
																<input id="txtCantidadPendiente_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																	   name="intCantidadPendiente_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar la existencia disponible de la refacción (en el inventario)  seleccionada-->
                                                                <input id="txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_taller_refacciones" 
                                                                       name="intDisponibleExistencia_detalles_movimientos_salidas_refacciones_taller_refacciones" 
                                                                       type="hidden" value="">
																<label for="txtCodigo_detalles_movimientos_salidas_refacciones_taller_refacciones">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																		name="strCodigo_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																		type="text" value="" disabled />
															</div>
														</div>
													</div>
													<!--Descripción-->
													<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDescripcion_detalles_movimientos_salidas_refacciones_taller_refacciones">
																	Descripción
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtDescripcion_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																		name="strDescripcion_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																		type="text" value="" disabled/>
															</div>
														</div>
													</div>
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_movimientos_salidas_refacciones_taller_refacciones" 
																		id="txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																		name="intCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="14" />
															</div>
														</div>
													</div>
													<!--Precio unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPrecioUnitario_detalles_movimientos_salidas_refacciones_taller_refacciones">Precio unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtPrecioUnitario_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																		name="intPrecioUnitario_detalles_movimientos_salidas_refacciones_taller_refacciones" 
																		type="text" value="" disabled />
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns" 
					                                			id="btnAgregar_detalles_movimientos_salidas_refacciones_taller_refacciones" 
					                                			onclick="agregar_renglon_detalles_movimientos_salidas_refacciones_taller_refacciones();" 
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
													<table class="table-hover movil" id="dg_detalles_movimientos_salidas_refacciones_taller_refacciones">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Código</th>
																<th class="movil">Descripción</th>
																<th class="movil">Solicitado</th>
																<th class="movil">Surtido</th>
																<th class="movil">Precio Unit.</th>
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
																	<strong id="acumSolicitado_detalles_movimientos_salidas_refacciones_taller_refacciones"></strong>
																</td>
																<td class="movil t4">
																	<strong id="acumSurtido_detalles_movimientos_salidas_refacciones_taller_refacciones"></strong>
																</td>
																<td class="movil t5"></td>
																<td class="movil t6">
																	<strong id="acumSubtotal_detalles_movimientos_salidas_refacciones_taller_refacciones"></strong>
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
																<strong id="numElementos_detalles_movimientos_salidas_refacciones_taller_refacciones">0</strong> encontrados
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
                    <div id="divCirculoBarProgreso_movimientos_salidas_refacciones_taller_refacciones" class="load-container load5 circulo_bar no-mostrar">
                        <div class="loader">Loading...</div>
                        <br><br>
                        <div align=center><b>Espere un momento por favor.</b></div>
                    </div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_movimientos_salidas_refacciones_taller_refacciones"  
									onclick="validar_movimientos_salidas_refacciones_taller_refacciones();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_movimientos_salidas_refacciones_taller_refacciones"  
									onclick="reporte_registro_movimientos_salidas_refacciones_taller_refacciones('');"  
									title="Imprimir" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_movimientos_salidas_refacciones_taller_refacciones"  
									onclick="cambiar_estatus_movimientos_salidas_refacciones_taller_refacciones('', '','','');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_movimientos_salidas_refacciones_taller_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_movimientos_salidas_refacciones_taller_refacciones();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MovimientosSalidasRefaccionesTallerRefaccionesContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMovimientosSalidasRefaccionesTallerRefacciones = 0;
		var strUltimaBusquedaMovimientosSalidasRefaccionesTallerRefacciones = "";
		 /*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
        var strTipoReferenciaMovimientosSalidasRefaccionesTallerRefacciones = "MOVIMIENTO DE REFACCIONES";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
        var intNumDecimalesMostrarMovimientosSalidasRefaccionesTallerRefacciones = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
        //Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
        var intNumDecimalesPrecioUnitBDMovimientosSalidasRefaccionesTallerRefacciones = <?php echo NUM_DECIMALES_PRECIO_UNIT_MOV_REFACCIONES ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objMovimientosSalidasRefaccionesTallerRefacciones = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_movimientos_salidas_refacciones_taller_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/movimientos_salidas_refacciones_taller/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_taller_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMovimientosSalidasRefaccionesTallerRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosMovimientosSalidasRefaccionesTallerRefacciones = strPermisosMovimientosSalidasRefaccionesTallerRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMovimientosSalidasRefaccionesTallerRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMovimientosSalidasRefaccionesTallerRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_movimientos_salidas_refacciones_taller_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMovimientosSalidasRefaccionesTallerRefacciones[i]=='GUARDAR') || (arrPermisosMovimientosSalidasRefaccionesTallerRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_movimientos_salidas_refacciones_taller_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesTallerRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_movimientos_salidas_refacciones_taller_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_movimientos_salidas_refacciones_taller_refacciones();
						}
						else if(arrPermisosMovimientosSalidasRefaccionesTallerRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_movimientos_salidas_refacciones_taller_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesTallerRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_movimientos_salidas_refacciones_taller_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesTallerRefacciones[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_movimientos_salidas_refacciones_taller_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesTallerRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_movimientos_salidas_refacciones_taller_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_movimientos_salidas_refacciones_taller_refacciones() 
		{
		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaMovimientosSalidasRefaccionesTallerRefacciones =($('#txtFechaInicialBusq_movimientos_salidas_refacciones_taller_refacciones').val()+$('#txtFechaFinalBusq_movimientos_salidas_refacciones_taller_refacciones').val()+$('#txtProspectoIDBusq_movimientos_salidas_refacciones_taller_refacciones').val()+$('#cmbEstatusBusq_movimientos_salidas_refacciones_taller_refacciones').val()+$('#txtBusqueda_movimientos_salidas_refacciones_taller_refacciones').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaMovimientosSalidasRefaccionesTallerRefacciones != strUltimaBusquedaMovimientosSalidasRefaccionesTallerRefacciones)
			{
				intPaginaMovimientosSalidasRefaccionesTallerRefacciones = 0;
				strUltimaBusquedaMovimientosSalidasRefaccionesTallerRefacciones = strNuevaBusquedaMovimientosSalidasRefaccionesTallerRefacciones;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/movimientos_salidas_refacciones_taller/get_paginacion',
					{ //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					  dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_taller_refacciones').val()),
					  dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_taller_refacciones').val()),
					  intProspectoID: $('#txtProspectoIDBusq_movimientos_salidas_refacciones_taller_refacciones').val(),
					  strEstatus:     $('#cmbEstatusBusq_movimientos_salidas_refacciones_taller_refacciones').val(),
					  strBusqueda:    $('#txtBusqueda_movimientos_salidas_refacciones_taller_refacciones').val(),
					  intPagina: intPaginaMovimientosSalidasRefaccionesTallerRefacciones,
					  strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_taller_refacciones').val()
					},
					function(data){
						$('#dg_movimientos_salidas_refacciones_taller_refacciones tbody').empty();
						var tmpMovimientosSalidasRefaccionesTallerRefacciones = Mustache.render($('#plantilla_movimientos_salidas_refacciones_taller_refacciones').html(),data);
						$('#dg_movimientos_salidas_refacciones_taller_refacciones tbody').html(tmpMovimientosSalidasRefaccionesTallerRefacciones);
						$('#pagLinks_movimientos_salidas_refacciones_taller_refacciones').html(data.paginacion);
						$('#numElementos_movimientos_salidas_refacciones_taller_refacciones').html(data.total_rows);
						intPaginaMovimientosSalidasRefaccionesTallerRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_movimientos_salidas_refacciones_taller_refacciones(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/movimientos_salidas_refacciones_taller/';

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
			if ($('#chbImprimirDetalles_movimientos_salidas_refacciones_taller_refacciones').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_movimientos_salidas_refacciones_taller_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_movimientos_salidas_refacciones_taller_refacciones').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_taller_refacciones').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_taller_refacciones').val()),
										'intProspectoID': $('#txtProspectoIDBusq_movimientos_salidas_refacciones_taller_refacciones').val(),
										'strEstatus': $('#cmbEstatusBusq_movimientos_salidas_refacciones_taller_refacciones').val(), 
										'strBusqueda': $('#txtBusqueda_movimientos_salidas_refacciones_taller_refacciones').val(),
										'strDetalles': $('#chbImprimirDetalles_movimientos_salidas_refacciones_taller_refacciones').val()		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_movimientos_salidas_refacciones_taller_refacciones(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'refacciones/movimientos_salidas_refacciones_taller/get_reporte_registro',
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
		function nuevo_movimientos_salidas_refacciones_taller_refacciones()
		{
			//Incializar formulario
			$('#frmMovimientosSalidasRefaccionesTallerRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_salidas_refacciones_taller_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmMovimientosSalidasRefaccionesTallerRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
            $.removerClasesEncabezado('divEncabezadoModal_movimientos_salidas_refacciones_taller_refacciones');
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_movimientos_salidas_refacciones_taller_refacciones();
			//Habilitar todos los elementos del formulario
			$('#frmMovimientosSalidasRefaccionesTallerRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_movimientos_salidas_refacciones_taller_refacciones').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$("#txtMoneda_movimientos_salidas_refacciones_taller_refacciones").attr('disabled','disabled');
			$("#txtTipoCambio_movimientos_salidas_refacciones_taller_refacciones").attr('disabled','disabled');
			$('#txtFolio_movimientos_salidas_refacciones_taller_refacciones').attr("disabled", "disabled");
			$('#txtOrdenReparacion_movimientos_salidas_refacciones_taller_refacciones').attr("disabled", "disabled");
			$('#txtProspecto_movimientos_salidas_refacciones_taller_refacciones').attr("disabled", "disabled");
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_taller_refacciones').attr("disabled", "disabled");
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_taller_refacciones').attr("disabled", "disabled");
			$('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_taller_refacciones').attr("disabled", "disabled");
			 //Habilitar botón Agregar
            $('#btnAgregar_detalles_movimientos_salidas_refacciones_taller_refacciones').prop('disabled', false);
 			//Mostrar los siguientes botones
			$("#btnGuardar_movimientos_salidas_refacciones_taller_refacciones").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_movimientos_salidas_refacciones_taller_refacciones").hide();
			$("#btnDesactivar_movimientos_salidas_refacciones_taller_refacciones").hide();
		}

	
		//Función para inicializar elementos de la requisición de refacciones
		function inicializar_requisicion_refacciones_movimientos_salidas_refacciones_taller_refacciones()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtMonedaID_movimientos_salidas_refacciones_taller_refacciones').val('');
			$('#txtMoneda_movimientos_salidas_refacciones_taller_refacciones').val('');
            $('#txtTipoCambio_movimientos_salidas_refacciones_taller_refacciones').val('');
            $('#txtOrdenReparacion_movimientos_salidas_refacciones_taller_refacciones').val('');
            $('#txtProspecto_movimientos_salidas_refacciones_taller_refacciones').val('');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_movimientos_salidas_refacciones_taller_refacciones();
           
		}
																	
		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_movimientos_salidas_refacciones_taller_refacciones()
		{
			//Hacer un llamado a la función para inicializar elementos de la refacción
			inicializar_refaccion_detalles_movimientos_salidas_refacciones_taller_refacciones();
			//Eliminar los datos de la tabla detalles del movimiento
			$('#dg_detalles_movimientos_salidas_refacciones_taller_refacciones tbody').empty();
			$('#acumSolicitado_detalles_movimientos_salidas_refacciones_taller_refacciones').html('');
		    $('#acumSurtido_detalles_movimientos_salidas_refacciones_taller_refacciones').html('');
		    $('#acumSubtotal_detalles_movimientos_salidas_refacciones_taller_refacciones').html('');
		    $('#numElementos_detalles_movimientos_salidas_refacciones_taller_refacciones').html(0);
			$('#txtNumDetalles_movimientos_salidas_refacciones_taller_refacciones').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_movimientos_salidas_refacciones_taller_refacciones()
		{
			try {
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_movimientos_salidas_refacciones_taller_refacciones('');
				//Cerrar modal
				objMovimientosSalidasRefaccionesTallerRefacciones.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_movimientos_salidas_refacciones_taller_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_movimientos_salidas_refacciones_taller_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_salidas_refacciones_taller_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmMovimientosSalidasRefaccionesTallerRefacciones')
				.bootstrapValidator({	excluded: [':disabled'],
									 	container: 'popover',
									 	feedbackIcons: {
									 		valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
									  	},
									  	fields: {
											strFecha_movimientos_salidas_refacciones_taller_refacciones: {
												validators: {
													notEmpty: {message: 'Seleccione una fecha'}
												}
											},
											strRequisicionRefacciones_movimientos_salidas_refacciones_taller_refacciones: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la requisición de refacciones
						                                    if($('#txtRequisicionRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val() === '')
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
											intNumDetalles_movimientos_salidas_refacciones_taller_refacciones: {
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
										    intCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones: {
										        excluded: true  // Ignorar (no valida el campo)    
										    }
										}
									});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_movimientos_salidas_refacciones_taller_refacciones = $('#frmMovimientosSalidasRefaccionesTallerRefacciones').data('bootstrapValidator');
			bootstrapValidator_movimientos_salidas_refacciones_taller_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_movimientos_salidas_refacciones_taller_refacciones.isValid())
			{

				//Hacer un llamado a la función para guardar los datos del registro
				guardar_movimientos_salidas_refacciones_taller_refacciones();
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_movimientos_salidas_refacciones_taller_refacciones()
		{
			try
			{
				$('#frmMovimientosSalidasRefaccionesTallerRefacciones').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_movimientos_salidas_refacciones_taller_refacciones()
		{
			//Variable que se utiliza para asignar el acumulado de las refacciones surtidas
			var intAcumSurtidoDetallesMovimiento = 0;

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_taller_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRenglon = [];
			var arrRefaccionID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCodigosLineas = [];
			var arrCantidades = [];
			var arrPreciosUnitarios = [];
			var arrCostosUnitarios = [];
			var arrBackOrderID = [];
			var arrCantidadesBackOrder = [];
			var arrEstatusBackOrder = [];
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioMovimiento = parseFloat($('#txtTipoCambio_movimientos_salidas_refacciones_taller_refacciones').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidadSolicitada =  parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				var intCantidad =  parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				var intPrecioUnitario = parseFloat($.reemplazar(objRen.cells[11].innerHTML, ",", ""));
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
					//Convertir importes a peso mexicano
					intPrecioUnitario = intPrecioUnitario * intTipoCambioMovimiento;

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
					arrPreciosUnitarios.push(intPrecioUnitario);
					arrCostosUnitarios.push(objRen.cells[12].innerHTML);
					arrBackOrderID.push(objRen.cells[7].innerHTML);
					arrCantidadesBackOrder.push(intCantidadPendiente);
					arrEstatusBackOrder.push(strEstatusPedido);
				}
				
				//Incrementar acunulado de refacciones surtidas
				intAcumSurtidoDetallesMovimiento += intCantidadSurtida;
			}

			//Variable que se utiliza para asignar el estatus de la requisición de refacciones
			var strEstatusRequisicionRefacciones = 'PARCIALMENTE SURTIDO';
			//Variable que se utiliza para asignar el acumulado de las refacciones solicitadas
			var intAcumSolicitadoDetallesMovimiento = parseFloat($.reemplazar($('#acumSolicitado_detalles_movimientos_salidas_refacciones_taller_refacciones').html(), ",", ""));
 
			//Si el acumulado de las refaccione solicitadas es igual al acumulado de las refacciones surtidas
			if(intAcumSolicitadoDetallesMovimiento == intAcumSurtidoDetallesMovimiento)
			{
				//Cambiar el estatus de la requisición de la refacción
				strEstatusRequisicionRefacciones = 'SURTIDO';
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/movimientos_salidas_refacciones_taller/guardar',
					{ 
						//Datos del movimiento
						intMovimientoRefaccionesID: $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_salidas_refacciones_taller_refacciones').val()),
						intMonedaID: $('#txtMonedaID_movimientos_salidas_refacciones_taller_refacciones').val(),
						intTipoCambio:  intTipoCambioMovimiento,
						intReferenciaID: $('#txtRequisicionRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val(),
						strObservaciones: $('#txtObservaciones_movimientos_salidas_refacciones_taller_refacciones').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_refacciones_taller_refacciones').val(),
						//Datos de la requisición de refacciones
						strEstatusRequisicion: strEstatusRequisicionRefacciones,
						//Datos de los detalles
						strRenglon: arrRenglon.join('|'),
						strRefaccionID: arrRefaccionID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strCodigosLineas: arrCodigosLineas.join('|'),
						strCantidades: arrCantidades.join('|'),
						strPreciosUnitarios: arrPreciosUnitarios.join('|'),
						strCostosUnitarios: arrCostosUnitarios.join('|'),
						//Datos del pedido pendiente
						strBackOrderID: arrBackOrderID.join('|'),
						strCantidadesBackOrder: arrCantidadesBackOrder.join('|'),
						strEstatusBackOrder: arrEstatusBackOrder.join('|')
					},
					function(data) {
						if (data.resultado)
						{	
		                   
		                    //Si no existe id del movimiento, significa que es un nuevo registro   
                            if($('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val() == '')
                            {
                                //Asignar el id del movimiento registrado en la base de datos
                                $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val(data.movimiento_refacciones_id);
                            }

		                    //Hacer llamado a la función  para cargar  los registros en el grid
		               		paginacion_movimientos_salidas_refacciones_taller_refacciones();
		               		
		               		//Hacer un llamado a la función para generar póliza con los datos del registro
                            generar_poliza_movimientos_salidas_refacciones_taller_refacciones('', '');
						}

						
						//Si existe mensaje de error
                        if(data.tipo_mensaje == 'error')
                        {
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_movimientos_salidas_refacciones_taller_refacciones(data.tipo_mensaje, data.mensaje);
						}
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_movimientos_salidas_refacciones_taller_refacciones(tipoMensaje, mensaje)
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
													$('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').focus();
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
		function cambiar_estatus_movimientos_salidas_refacciones_taller_refacciones(movimientoRefaccionesID, referenciaID, 
			polizaID, folioPoliza)
		{
			//Variable que se utiliza para asignar el id del movimiento
			var intID = 0;
			//Variable que se utiliza para asignar el id de la referencia
			var intRequisicionRefaccionesID = 0;
			//Variable que se utiliza para asignar el id de la póliza
            var intPolizaID = 0;
            //Variable que se utiliza para asignar el folio de la póliza
            var strFolioPoliza = '';


			//Si no existe id del movimiento, significa que se realizará la modificación desde el modal
			if(movimientoRefaccionesID == '')
			{
				intID = $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val();
				intRequisicionRefaccionesID = $('#txtRequisicionRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val();
				intPolizaID = $('#txtPolizaID_movimientos_salidas_refacciones_taller_refacciones').val();
                strFolioPoliza = $('#txtFolioPoliza_movimientos_salidas_refacciones_taller_refacciones').val();
			}
			else
			{
				intID = movimientoRefaccionesID;
				intRequisicionRefaccionesID = referenciaID;
				intPolizaID = polizaID;
                strFolioPoliza = folioPoliza;
			}

			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro; también se desactivara la póliza con folio: '+strFolioPoliza+'?</strong>',
					             {'type':     'question',
					              'title':    'Salidas por Taller',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('refacciones/movimientos_salidas_refacciones_taller/set_estatus',
					                                     {intMovimientoRefaccionesID: intID,
					                                      intReferenciaID: intRequisicionRefaccionesID,
					                                      intPolizaID: intPolizaID
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                          //Hacer llamado a la función  para cargar  los registros en el grid
					                                          paginacion_movimientos_salidas_refacciones_taller_refacciones();

					                                           //Si el id del registro se obtuvo del modal
		                                                        if(movimientoRefaccionesID == '')
		                                                        {
		                                                            //Hacer un llamado a la función para cerrar modal
		                                                            cerrar_movimientos_salidas_refacciones_taller_refacciones();     
		                                                        }
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_movimientos_salidas_refacciones_taller_refacciones(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_movimientos_salidas_refacciones_taller_refacciones(id, tipoAccion)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/movimientos_salidas_refacciones_taller/get_datos',
			       {intMovimientoRefaccionesID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_movimientos_salidas_refacciones_taller_refacciones();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar el id de la póliza
                            var intPolizaID = parseInt(data.row.poliza_id); 
				            
				          	//Recuperar valores
				            $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val(data.row.movimiento_refacciones_id);
				            $('#txtFolio_movimientos_salidas_refacciones_taller_refacciones').val(data.row.folio);
				            $('#txtFecha_movimientos_salidas_refacciones_taller_refacciones').val(data.row.fecha);
				            $('#txtMonedaID_movimientos_salidas_refacciones_taller_refacciones').val(data.row.moneda_id);
				            $('#txtMoneda_movimientos_salidas_refacciones_taller_refacciones').val(data.row.moneda);
				            $('#txtTipoCambio_movimientos_salidas_refacciones_taller_refacciones').val(data.row.tipo_cambio)
				            $('#txtRequisicionRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val(data.row.referencia_id);
				            $('#txtRequisicionRefacciones_movimientos_salidas_refacciones_taller_refacciones').val(data.row.folio_requisicion);
				            $('#txtOrdenReparacion_movimientos_salidas_refacciones_taller_refacciones').val(data.row.folio_orden_reparacion);
						    $('#txtProspecto_movimientos_salidas_refacciones_taller_refacciones').val(data.row.prospecto);
						    $('#txtObservaciones_movimientos_salidas_refacciones_taller_refacciones').val(data.row.observaciones);
						    $('#txtPolizaID_movimientos_salidas_refacciones_taller_refacciones').val(intPolizaID);
                            $('#txtFolioPoliza_movimientos_salidas_refacciones_taller_refacciones').val(data.row.folio_poliza);
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_movimientos_salidas_refacciones_taller_refacciones').addClass("estatus-"+strEstatus);
				          
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_movimientos_salidas_refacciones_taller_refacciones").show();

							 //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmMovimientosSalidasRefaccionesTallerRefacciones').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_movimientos_salidas_refacciones_taller_refacciones").hide();
					             //Deshabilitar botón Agregar
								$('#btnAgregar_detalles_movimientos_salidas_refacciones_taller_refacciones').prop('disabled', true);

								//Si existe el id de la póliza
				            	if(strEstatus == 'ACTIVO' && intPolizaID > 0)
				            	{
					            	//Mostrar el botón Desactivar
					            	$("#btnDesactivar_movimientos_salidas_refacciones_taller_refacciones").show();
					            }

				            }


				            //Hacer llamado a la función  para cargar los detalles del registro en el grid
				            lista_detalles_movimientos_salidas_refacciones_taller_refacciones('Editar', strEstatus, intPolizaID);

			            	//Abrir modal
							objMovimientosSalidasRefaccionesTallerRefacciones = $('#MovimientosSalidasRefaccionesTallerRefaccionesBox').bPopup({
														   appendTo: '#MovimientosSalidasRefaccionesTallerRefaccionesContent', 
							                               contentContainer: 'MovimientosSalidasRefaccionesTallerRefaccionesM', 
							                               zIndex: 2, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtRequisicionRefacciones_movimientos_salidas_refacciones_taller_refacciones').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar obtener los datos de una requisición de refacciones
		function get_datos_requisicion_refacciones_movimientos_salidas_refacciones_taller_refacciones()
		{
			  //Hacer un llamado al método del controlador para regresar los datos de la requisición de refacciones
              $.post('servicio/requisiciones_refacciones/get_datos',
                  { 
                  	intRequisicionRefaccionesID: $("#txtRequisicionRefaccionesID_movimientos_salidas_refacciones_taller_refacciones").val(),
                  },
                  function(data) {
                    if(data.row){
                    	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
						inicializar_detalles_movimientos_salidas_refacciones_taller_refacciones();
                    	//Recuperar valores
             			$('#txtMonedaID_movimientos_salidas_refacciones_taller_refacciones').val(data.row.moneda_id);
             			$('#txtMoneda_movimientos_salidas_refacciones_taller_refacciones').val(data.row.moneda);
             		    $('#txtTipoCambio_movimientos_salidas_refacciones_taller_refacciones').val(data.row.tipo_cambio);
             		    $('#txtOrdenReparacion_movimientos_salidas_refacciones_taller_refacciones').val(data.row.folio_orden_reparacion);
             		    $('#txtProspecto_movimientos_salidas_refacciones_taller_refacciones').val(data.row.prospecto);
             		    //Hacer llamado a la función  para cargar los detalles del registro en el grid
             		    lista_detalles_movimientos_salidas_refacciones_taller_refacciones('Nuevo', '', '');
                    }
                }
                 ,
                'json');
		}


		//Función para generar póliza con los datos de un registro
        function generar_poliza_movimientos_salidas_refacciones_taller_refacciones(id, formulario)
        {   

            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Variable que se utiliza para saber si el id se obtuvo desde el modal
            var strTipo = 'modal';
            //Si no existe id, significa que se realizará la modificación desde el modal
            if(id == '')
            {
                intID = $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val();
            }
            else
            {
                intID = id;
                strTipo = 'gridview';
            }

            //Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
            mostrar_circulo_carga_movimientos_salidas_refacciones_taller_refacciones(formulario);
            //Hacer un llamado al método del controlador para timbrar los datos del registro
            $.post('contabilidad/generar_polizas/generar_poliza',
             {
                intReferenciaID: intID,
                strTipoReferencia: strTipoReferenciaMovimientosSalidasRefaccionesTallerRefacciones, 
                intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_refacciones_taller_refacciones').val()
             },
             function(data) {

                //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
                ocultar_circulo_carga_movimientos_salidas_refacciones_taller_refacciones(formulario);
                
                //Si existe resultado
                if (data.resultado)
                {
                    //Hacer llamado a la función para cargar  los registros en el grid
                    paginacion_movimientos_salidas_refacciones_taller_refacciones();

                    //Si el id del registro se obtuvo del modal
                    if(strTipo == 'modal')
                    {
                        //Hacer un llamado a la función para cerrar modal
                        cerrar_movimientos_salidas_refacciones_taller_refacciones();
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
			            								cerrar_movimientos_salidas_refacciones_taller_refacciones();
	                                                 }
	                                                }]
	                                  });
				}
				else
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    	mensaje_movimientos_salidas_refacciones_taller_refacciones(data.tipo_mensaje, data.mensaje);
				}
                
             },
             'json');

        }

        //Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function mostrar_circulo_carga_movimientos_salidas_refacciones_taller_refacciones(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_salidas_refacciones_taller_refacciones';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_taller_refacciones';
            }

            //Remover clase para mostrar div que contiene la barra de carga
            $("#"+strCampoID).removeClass('no-mostrar');
        }


        //Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function ocultar_circulo_carga_movimientos_salidas_refacciones_taller_refacciones(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_salidas_refacciones_taller_refacciones';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_taller_refacciones';
            }

            //Agregar clase para ocultar div que contiene la barra de carga
            $("#"+strCampoID).addClass('no-mostrar');
        }
    


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_movimientos_salidas_refacciones_taller_refacciones()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_detalles_movimientos_salidas_refacciones_taller_refacciones').val('');
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_taller_refacciones').val('');
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_taller_refacciones').val('');
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').val('');
			$('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_taller_refacciones').val('');
			$('#txtCantidadSolicitada_detalles_movimientos_salidas_refacciones_taller_refacciones').val('');
			$('#txtCantidadPendiente_detalles_movimientos_salidas_refacciones_taller_refacciones').val('');
			$('#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_taller_refacciones').val('');
		}

		//Función para la búsqueda de detalles del registro
		function lista_detalles_movimientos_salidas_refacciones_taller_refacciones(tipoAccion, estatus, polizaID) 
		{

			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';
		     //Asignar el id de la póliza
			var intPolizaID = parseInt(polizaID); 

		    //Si se cumple la sentencia
			if(estatus == '' || (estatus == 'ACTIVO' && intPolizaID == 0))
			{
				strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
								    "	onclick='editar_renglon_detalles_movimientos_salidas_refacciones_taller_refacciones(this)'>" + 
									"<span class='glyphicon glyphicon-edit'></span></button>";
			}


			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/movimientos_salidas_refacciones_taller/get_datos_detalles',
			       {
			       		intMovimientoRefaccionesID: $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val(),
			       		intReferenciaID: $('#txtRequisicionRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val()
			       },
			       function(data) {

			       		//Variable que se utiliza para asignar el tipo de cambio
			            var intTipoCambio = parseFloat($('#txtTipoCambio_movimientos_salidas_refacciones_taller_refacciones').val());

			            //Mostramos los detalles del registro
			            for (var intCon in data.detalles) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_taller_refacciones').getElementsByTagName('tbody')[0];

							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcion = objRenglon.insertCell(1);
							var objCeldaCantidadSolicitada = objRenglon.insertCell(2);
							var objCeldaCantidadSurtida = objRenglon.insertCell(3);
							var objCeldaPrecioUnitario = objRenglon.insertCell(4);
							var objCeldaSubtotal = objRenglon.insertCell(5);
							var objCeldaAcciones = objRenglon.insertCell(6);
							//Columnas ocultas
							var objCeldaBackOrderID = objRenglon.insertCell(7);
							var objCeldaCantidadBackOrder = objRenglon.insertCell(8);
							var objRefaccionID = objRenglon.insertCell(9);
							var objCeldaCodigoLinea = objRenglon.insertCell(10);
							var objCeldaPrecioUnitarioBD = objRenglon.insertCell(11);
							var objCeldaCostoActual = objRenglon.insertCell(12);
							var objCeldaDisponibleExistencia = objRenglon.insertCell(13);

							//Variables que se utilizan para asignar valores del detalle
							var intSubtotal = parseFloat(data.detalles[intCon].precio_unitario);
							var intCantidadSolicitada =  parseFloat(data.detalles[intCon].cantidad_solicitada);
							var intCantidad = parseFloat(data.detalles[intCon].cantidad_surtida);
							var intPrecioUnitario = parseFloat(data.detalles[intCon].precio_unitario);
							
							//Variable que se utiliza para asignar el id del pedido pendiente
							var intBackOrderID = data.detalles[intCon].back_order_id;
							//Variable que se utiliza para asignar la cantidad que esta pendiente
							var intCantidadPendiente = parseFloat(data.detalles[intCon].cantidad_pendiente);
							//Variable que se utiliza para asignar la existencia disponible
							var intDisponibleExistencia = parseFloat(data.detalles[intCon].disponible_existencia);
							//Convertir peso mexicano a tipo de cambio
							intPrecioUnitario = intPrecioUnitario / intTipoCambio;
							
							//Si no existe id del back_order (pedido)
							if(intBackOrderID == 0)
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

								//Convertir peso mexicano a tipo de cambio
								intSubtotal = intSubtotal / intTipoCambio;
								

								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;
							}

							//Calcular la existencia disponible
                            intDisponibleExistencia = intCantidad + intDisponibleExistencia;

                            //Cambiar cantidad a  formato moneda (a visualizar)
                    	    intCantidadSolicitada =  formatMoney(intCantidadSolicitada, 2, '');
                    	    
                    	    intCantidad =  formatMoney(intCantidad, 2, '');

                    	    var intPrecioUnitarioMostrar =  formatMoney(intPrecioUnitario, intNumDecimalesMostrarMovimientosSalidasRefaccionesTallerRefacciones, '');

                    	    var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesTallerRefacciones, '');


                    	    //Cambiar cantidad a  formato moneda (a guardar en la  BD)
                   			var intPrecioUnitarioBD =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDMovimientosSalidasRefaccionesTallerRefacciones, '');


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
							objCeldaPrecioUnitario.setAttribute('class', 'movil b5');
							objCeldaPrecioUnitario.innerHTML = intPrecioUnitarioMostrar;
							objCeldaSubtotal.setAttribute('class', 'movil b6');
							objCeldaSubtotal.innerHTML = intSubtotalMostrar;
							objCeldaAcciones.setAttribute('class', 'td-center movil b7');
							objCeldaAcciones.innerHTML = strAccionesTabla;
							objCeldaBackOrderID.setAttribute('class', 'no-mostrar');
							objCeldaBackOrderID.innerHTML = intBackOrderID; 
							objCeldaCantidadBackOrder.setAttribute('class', 'no-mostrar');
							objCeldaCantidadBackOrder.innerHTML = intCantidadPendiente; 
							objRefaccionID.setAttribute('class', 'no-mostrar');
							objRefaccionID.innerHTML = data.detalles[intCon].refaccion_id; 
							objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
							objCeldaCodigoLinea.innerHTML = data.detalles[intCon].codigo_linea;
							objCeldaPrecioUnitarioBD.setAttribute('class', 'no-mostrar');
                        	objCeldaPrecioUnitarioBD.innerHTML = intPrecioUnitarioBD; 
							objCeldaCostoActual.setAttribute('class', 'no-mostrar');
							objCeldaCostoActual.innerHTML =  data.detalles[intCon].actual_costo;
							objCeldaDisponibleExistencia.setAttribute('class', 'no-mostrar');
							objCeldaDisponibleExistencia.innerHTML = intDisponibleExistencia; 
							
			            }

			            //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_salidas_refacciones_taller_refacciones();
			            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_taller_refacciones tr").length - 2;
						$('#numElementos_detalles_movimientos_salidas_refacciones_taller_refacciones').html(intFilas);
			       },
			       'json');

		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_movimientos_salidas_refacciones_taller_refacciones()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla movimientos_refacciones_detalles)
			var intSubtotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_detalles_movimientos_salidas_refacciones_taller_refacciones').val();
			var intCantidad = $('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_taller_refacciones').val();
			var intCantidadSolicitada = $('#txtCantidadSolicitada_detalles_movimientos_salidas_refacciones_taller_refacciones').val();
			var intCantidadPendiente = $('#txtCantidadPendiente_detalles_movimientos_salidas_refacciones_taller_refacciones').val();
			var intDisponibleExistencia = $('#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_taller_refacciones').val()
			

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_taller_refacciones').getElementsByTagName('tbody')[0];

			//Si existe ID del renglón
			if (intRenglon != '' )
			{
				//Validamos que se capturaron datos
				if (intCantidad == '')
				{
					//Enfocar caja de texto
					$('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').focus();
				}
				else
				{
					//Convertir cadena de texto a número decimal
					intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
					intSubtotal =  parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
					intCantidadSolicitada = parseFloat($.reemplazar(intCantidadSolicitada, ",", ""));
					intCantidadPendiente = parseFloat(intCantidadPendiente);
					intDisponibleExistencia = parseFloat(intDisponibleExistencia);

					//Verificar que la cantidad sea menor o igual que la existencia disponible
					if(intCantidad <= intCantidadPendiente && intCantidad <= intDisponibleExistencia)
					{
						//Hacer un llamado a la función para inicializar elementos de la refacción
						inicializar_refaccion_detalles_movimientos_salidas_refacciones_taller_refacciones();
				
						//Calcular subtotal
						intSubtotal = intCantidad * intSubtotal;

						//Cambiar cantidad a  formato moneda (a visualizar)
	                    intCantidad =  formatMoney(intCantidad, 2, '');

	                    var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesTallerRefacciones, '');

						//Editar los datos del detalle
					    objTabla.rows.namedItem(intRenglon).cells[3].innerHTML = intCantidad;
					    objTabla.rows.namedItem(intRenglon).cells[5].innerHTML =  intSubtotalMostrar;

					    //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_salidas_refacciones_taller_refacciones();

						//Enfocar caja de texto
						$('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').focus();
					}
					else
					{
			    		//Si la existencia disponible en menor que la cantidad a surtir
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
						$('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').val(intCantidad);

						//Hacer un llamado a la función para mostrar mensaje de información
					    mensaje_movimientos_salidas_refacciones_taller_refacciones('informacion', strMensaje);
					}
					
				}


				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_taller_refacciones tr").length - 2;
				$('#numElementos_detalles_movimientos_salidas_refacciones_taller_refacciones').html(intFilas);
		    }
		    else
		    {
		    	//Limpiar caja de texto
		    	$('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').val('');
		    }
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_movimientos_salidas_refacciones_taller_refacciones(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalles_movimientos_salidas_refacciones_taller_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_taller_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_taller_refacciones').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidadSolicitada_detalles_movimientos_salidas_refacciones_taller_refacciones').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtPrecioUnitario_detalles_movimientos_salidas_refacciones_taller_refacciones').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
			$('#txtCantidadPendiente_detalles_movimientos_salidas_refacciones_taller_refacciones').val(objRenglon.parentNode.parentNode.cells[8].innerHTML);
			$('#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_taller_refacciones').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			//Enfocar caja de texto
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').focus();
		}


		//Función para calcular totales de la tabla
		function calcular_totales_detalles_movimientos_salidas_refacciones_taller_refacciones()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_taller_refacciones').getElementsByTagName('tbody')[0];

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
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesTallerRefacciones, '');

			//Asignar los valores
			$('#acumSolicitado_detalles_movimientos_salidas_refacciones_taller_refacciones').html(intAcumSolicitado);
			$('#acumSurtido_detalles_movimientos_salidas_refacciones_taller_refacciones').html(intAcumSurtido);
			$('#acumSubtotal_detalles_movimientos_salidas_refacciones_taller_refacciones').html(intAcumSubtotal);
			$('#txtNumDetalles_movimientos_salidas_refacciones_taller_refacciones').val(intContadorDetalles);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').numeric();

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_movimientos_salidas_refacciones_taller_refacciones').blur(function(){
                $('.cantidad_movimientos_salidas_refacciones_taller_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
            });

            //Agregar datepicker para seleccionar fecha
			$('#dteFecha_movimientos_salidas_refacciones_taller_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			
	        //Autocomplete para recuperar los datos de una requisición de refacciones
	        $('#txtRequisicionRefacciones_movimientos_salidas_refacciones_taller_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtRequisicionRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la requisición de refacciones
	               inicializar_requisicion_refacciones_movimientos_salidas_refacciones_taller_refacciones();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/requisiciones_refacciones/autocomplete",
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
	                $('#txtRequisicionRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val(ui.item.data);
	             	//Hacer un llamado a la función para regresar los datos de la requisición de refacciones
	                get_datos_requisicion_refacciones_movimientos_salidas_refacciones_taller_refacciones();

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
			//Verificar que exista id de la entrada cuando pierda el enfoque la caja de texto
	        $('#txtRequisicionRefacciones_movimientos_salidas_refacciones_taller_refacciones').focusout(function(e){
	            //Si no existe id de la entrada
	            if($('#txtRequisicionRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val() == '' ||
	               $('#txtRequisicionRefacciones_movimientos_salidas_refacciones_taller_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtRequisicionRefaccionesID_movimientos_salidas_refacciones_taller_refacciones').val('');
	               $('#txtRequisicionRefacciones_movimientos_salidas_refacciones_taller_refacciones').val('');
	            }

	        });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_salidas_refacciones_taller_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar botón Agregar
			   	    	$('#btnAgregar_detalles_movimientos_salidas_refacciones_taller_refacciones').focus();
			   	    }
		        }
		    });

			
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_movimientos_salidas_refacciones_taller_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_movimientos_salidas_refacciones_taller_refacciones').datetimepicker({format: 'DD/MM/YYYY',
			 																		                            useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_movimientos_salidas_refacciones_taller_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_movimientos_salidas_refacciones_taller_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_movimientos_salidas_refacciones_taller_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_movimientos_salidas_refacciones_taller_refacciones').data('DateTimePicker').maxDate(e.date);
			});
			
			//Autocomplete para recuperar los datos de un prospecto o cliente
	        $('#txtProspectoBusq_movimientos_salidas_refacciones_taller_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_movimientos_salidas_refacciones_taller_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/prospectos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'referencias'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtProspectoIDBusq_movimientos_salidas_refacciones_taller_refacciones').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del prospecto cuando pierda el enfoque la caja de texto
	        $('#txtProspectoBusq_movimientos_salidas_refacciones_taller_refacciones').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoIDBusq_movimientos_salidas_refacciones_taller_refacciones').val() == '' ||
	               $('#txtProspectoBusq_movimientos_salidas_refacciones_taller_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_movimientos_salidas_refacciones_taller_refacciones').val('');
	               $('#txtProspectoBusq_movimientos_salidas_refacciones_taller_refacciones').val('');
	            }

	        });

	        //Paginación de registros
			$('#pagLinks_movimientos_salidas_refacciones_taller_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaMovimientosSalidasRefaccionesTallerRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_movimientos_salidas_refacciones_taller_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_movimientos_salidas_refacciones_taller_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_movimientos_salidas_refacciones_taller_refacciones();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_movimientos_salidas_refacciones_taller_refacciones').addClass("estatus-NUEVO");
				//Abrir modal
				objMovimientosSalidasRefaccionesTallerRefacciones = $('#MovimientosSalidasRefaccionesTallerRefaccionesBox').bPopup({
											   appendTo: '#MovimientosSalidasRefaccionesTallerRefaccionesContent', 
				                               contentContainer: 'MovimientosSalidasRefaccionesTallerRefaccionesM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#txtRequisicionRefacciones_movimientos_salidas_refacciones_taller_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_movimientos_salidas_refacciones_taller_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_movimientos_salidas_refacciones_taller_refacciones();
		});
	</script>