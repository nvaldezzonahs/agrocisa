	<div id="RequisicionesRefaccionesServicioContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_requisiciones_refacciones_servicio" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_requisiciones_refacciones_servicio" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_requisiciones_refacciones_servicio">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_requisiciones_refacciones_servicio'>
				                    <input class="form-control" id="txtFechaInicialBusq_requisiciones_refacciones_servicio"
				                    		name= "strFechaInicialBusq_requisiciones_refacciones_servicio" 
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
								<label for="txtFechaFinalBusq_requisiciones_refacciones_servicio">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_requisiciones_refacciones_servicio'>
				                    <input class="form-control" id="txtFechaFinalBusq_requisiciones_refacciones_servicio"
				                    		name= "strFechaFinalBusq_requisiciones_refacciones_servicio" 
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
								<input id="txtProspectoIDBusq_requisiciones_refacciones_servicio" 
									   name="intProspectoIDBusq_requisiciones_refacciones_servicio"  type="hidden" 
									   value="">
								</input>
								<label for="txtProspectoBusq_requisiciones_refacciones_servicio">Cliente</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProspectoBusq_requisiciones_refacciones_servicio" 
										name="strProspectoBusq_requisiciones_refacciones_servicio" type="text" value="" tabindex="1" placeholder="Ingrese cliente" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_requisiciones_refacciones_servicio">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_requisiciones_refacciones_servicio" 
								 		name="strEstatusBusq_requisiciones_refacciones_servicio" tabindex="1">
								    <option value="TODOS">TODOS</option>
					  				<option value="ACTIVO">ACTIVO</option>
					  				<option value="SURTIDO">SURTIDO</option>
					  				<option value="PARCIALMENTE SURTIDO">PARCIALMENTE SURTIDO</option>					 
					  				<option value="FACTURADO">FACTURADO</option>	
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
							<label for="txtBusqueda_requisiciones_refacciones_servicio">Descripción</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtBusqueda_requisiciones_refacciones_servicio" 
									name="strBusqueda_requisiciones_refacciones_servicio" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
							</input>
						</div>
					</div>
				</div>

					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_requisiciones_refacciones_servicio" 
									   name="strImprimirDetalles_requisiciones_refacciones_servicio" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_requisiciones_refacciones_servicio"
									onclick="paginacion_requisiciones_refacciones_servicio();" 
									title="Buscar coincidencias" tabindex="1"> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_requisiciones_refacciones_servicio" 
									title="Nuevo registro" tabindex="1"> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_requisiciones_refacciones_servicio"
									onclick="reporte_requisiciones_refacciones_servicio('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_requisiciones_refacciones_servicio"
									onclick="reporte_requisiciones_refacciones_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1">
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
				td.movil.a4:nth-of-type(4):before {content: "Cliente"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles de la requisición
				*/
				td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Desc."; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Total"; font-weight: bold;}
				td.movil.b10:nth-of-type(10):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles de la requisición
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "Desc."; font-weight: bold;}
				td.movil.t6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.t7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.t8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.t9:nth-of-type(9):before {content: "Total"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_requisiciones_refacciones_servicio">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Orden</th>
							<th class="movil">Cliente</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_requisiciones_refacciones_servicio" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{folio_orden_reparacion}}</td>
							<td class="movil a4">{{prospecto}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="td-center movil a6"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_requisiciones_refacciones_servicio({{requisicion_refacciones_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_requisiciones_refacciones_servicio({{requisicion_refacciones_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_requisiciones_refacciones_servicio({{requisicion_refacciones_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_requisiciones_refacciones_servicio({{requisicion_refacciones_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_requisiciones_refacciones_servicio({{requisicion_refacciones_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_requisiciones_refacciones_servicio"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_requisiciones_refacciones_servicio">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="RequisicionesRefaccionesServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_requisiciones_refacciones_servicio"  class="ModalBodyTitle">
			<h1>Requisición de Refacciones</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRequisicionesRefaccionesServicio" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmRequisicionesRefaccionesServicio" onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtRequisicionRefaccionesID_requisiciones_refacciones_servicio" 
										   name="intRequisicionRefaccionesID_requisiciones_refacciones_servicio" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro-->
									<input id="txtEstatus_requisiciones_refacciones_servicio" 
										   name="strEstatus_requisiciones_refacciones_servicio"  type="hidden" 
										   value="">
									</input>
									<label for="txtFolio_requisiciones_refacciones_servicio">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_requisiciones_refacciones_servicio" 
											name="strFolio_requisiciones_refacciones_servicio" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_requisiciones_refacciones_servicio">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_requisiciones_refacciones_servicio'>
					                    <input class="form-control" id="txtFecha_requisiciones_refacciones_servicio"
					                    		name= "strFecha_requisiciones_refacciones_servicio" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Combobox que contiene las monedas activas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbMonedaID_requisiciones_refacciones_servicio">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_requisiciones_refacciones_servicio" 
									 		name="intMonedaID_requisiciones_refacciones_servicio" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_requisiciones_refacciones_servicio">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_requisiciones_refacciones_servicio" id="txtTipoCambio_requisiciones_refacciones_servicio" 
											name="intTipoCambio_requisiciones_refacciones_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene las ordenes de reparación activas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de reparación seleccionada-->
									<input id="txtOrdenReparacionID_requisiciones_refacciones_servicio" 
										   name="intOrdenReparacionID_requisiciones_refacciones_servicio"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la lista de precios correspondiente al cliente de la orden de reparación seleccionada-->
									<input id="txtServicioListaPrecioID_requisiciones_refacciones_servicio" 
										   name="intServicioListaPrecioID_requisiciones_refacciones_servicio"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus de la orden de reparación (en caso de que no se encuentre facturado permitir modificar precios de las refacciones)-->
									<input id="txtEstatusOrdenReparacion_requisiciones_refacciones_servicio" 
										   name="strEstatusOrdenReparacion_requisiciones_refacciones_servicio"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el tipo de reparación-->
									<input id="txtTipoReparacion_requisiciones_refacciones_servicio" 
										   name="strTipoReparacion_requisiciones_refacciones_servicio"  type="hidden" 
										   value="">
									</input>
									<label for="txtOrdenReparacion_requisiciones_refacciones_servicio">No. de orden</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtOrdenReparacion_requisiciones_refacciones_servicio" 
											name="strOrdenReparacion_requisiciones_refacciones_servicio" type="text" value="" tabindex="1" placeholder="Ingrese orden" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Cliente-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtProspecto_requisiciones_refacciones_servicio">Cliente</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProspecto_requisiciones_refacciones_servicio" 
											name="strProspecto_requisiciones_refacciones_servicio" type="text" value="" disabled>
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
									<label for="txtObservaciones_requisiciones_refacciones_servicio">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_requisiciones_refacciones_servicio" 
											name="strObservaciones_requisiciones_refacciones_servicio" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
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
									<input id="txtNumDetalles_requisiciones_refacciones_servicio" 
										   name="intNumDetalles_requisiciones_refacciones_servicio" type="hidden" value="">
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
																<input id="txtRefaccionID_detalles_requisiciones_refacciones_servicio" 
																	   name="intRefaccionID_detalles_requisiciones_refacciones_servicio"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta que se utiliza para recuperar el código de la refacción seleccionada-->
																<input id="txtCodigo_detalles_requisiciones_refacciones_servicio" 
																	   name="strCodigo_detalles_requisiciones_refacciones_servicio"  
																	   type="hidden" value="">
															    </input>
															     <!-- Caja de texto oculta que se utiliza para recuperar la descripción de la refacción seleccionada-->
																<input id="txtDescripcion_detalles_requisiciones_refacciones_servicio" 
																	   name="strDescripcion_detalles_requisiciones_refacciones_servicio"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta que se utiliza para recuperar el código de la línea de la refacción seleccionada-->
																<input id="txtCodigoLinea_detalles_requisiciones_refacciones_servicio" 
																	   name="strCodigoLinea_detalles_requisiciones_refacciones_servicio"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta que se utiliza para recuperar el precio de la refacción seleccionada-->
																<input id="txtPrecioRefaccion_detalles_requisiciones_refacciones_servicio" 
																	   name="intPrecioRefaccion_detalles_requisiciones_refacciones_servicio"  
																	   type="hidden" value="">
															    </input>

															     <!-- Caja de texto oculta que se utiliza para recuperar el precio de la refacción seleccionada-->
																<input id="txtTipoCambioRefaccion_detalles_requisiciones_refacciones_servicio" 
																	   name="intTipoCambioRefaccion_detalles_requisiciones_refacciones_servicio"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta para recuperar el costo actual de la refacción (en el inventario)  seleccionada-->
																<input id="txtActualCosto_detalles_requisiciones_refacciones_servicio" 
																	   name="intActualCosto_detalles_requisiciones_refacciones_servicio" 
																	   type="hidden" value="">
															    </input>
																<label for="txtRefaccion_detalles_requisiciones_refacciones_servicio">
																	Refacción
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtRefaccion_detalles_requisiciones_refacciones_servicio" 
																		name="strRefaccion_detalles_requisiciones_refacciones_servicio" type="text" value="" 
																		tabindex="1" placeholder="Ingrese refacción" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Moneda-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtMoneda_detalles_requisiciones_refacciones_servicio">Moneda</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtMoneda_detalles_requisiciones_refacciones_servicio" 
																		name="strMoneda_detalles_requisiciones_refacciones_servicio" type="text" value="" 
																		disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Tipo de cambio-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtTipoCambio_detalles_requisiciones_refacciones_servicio">Tipo de cambio</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control tipo-cambio_requisiciones_refacciones_servicio" id="txtTipoCambio_detalles_requisiciones_refacciones_servicio" 
																		name="intTipoCambio_detalles_requisiciones_refacciones_servicio" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_requisiciones_refacciones_servicio">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_requisiciones_refacciones_servicio" 
																		id="txtCantidad_detalles_requisiciones_refacciones_servicio" 
																		name="intCantidad_detalles_requisiciones_refacciones_servicio" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="14">
																</input>
															</div>
														</div>
													</div>
													<!--Precio unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPrecioUnitario_detalles_requisiciones_refacciones_servicio">Precio unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_requisiciones_refacciones_servicio" id="txtPrecioUnitario_detalles_requisiciones_refacciones_servicio" 
																		name="intPrecioUnitario_detalles_requisiciones_refacciones_servicio" type="text" value="" tabindex="1" placeholder="Ingrese precio unitario" maxlength="23">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_requisiciones_refacciones_servicio" id="txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio" 
																		name="intPorcentajeDescuento_detalles_requisiciones_refacciones_servicio" type="text" value="0.00" 
																		tabindex="1" placeholder="Ingrese descuento" maxlength="8">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IVA-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota de la refacción seleccionada-->
																<input id="txtTasaCuotaIva_detalles_requisiciones_refacciones_servicio" 
																	   name="intTasaCuotaIva_detalles_requisiciones_refacciones_servicio" 
																	   type="hidden" value="">
															    </input>
																<label for="txtPorcentajeIva_detalles_requisiciones_refacciones_servicio">IVA %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIva_detalles_requisiciones_refacciones_servicio" 
																		name="intPorcentajeIva_detalles_requisiciones_refacciones_servicio" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IEPS-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota de la refacción seleccionada-->
																<input id="txtTasaCuotaIeps_detalles_requisiciones_refacciones_servicio" 
																	   name="intTasaCuotaIeps_detalles_requisiciones_refacciones_servicio" 
																	   type="hidden" value="">
															    </input>
																<label for="txtPorcentajeIeps_detalles_requisiciones_refacciones_servicio">IEPS %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIeps_detalles_requisiciones_refacciones_servicio" 
																		name="intPorcentajeIeps_detalles_requisiciones_refacciones_servicio" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_detalles_requisiciones_refacciones_servicio"
					                                			onclick="agregar_renglon_detalles_requisiciones_refacciones_servicio();" 
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
													<table class="table-hover movil" id="dg_detalles_requisiciones_refacciones_servicio">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Código</th>
																<th class="movil">Descripción</th>
																<th class="movil">Cantidad</th>
																<th class="movil">Precio Unit.</th>
																<th class="movil">Desc.</th>
																<th class="movil">Subtotal</th>
																<th class="movil">IVA</th>
																<th class="movil">IEPS</th>
																<th class="movil">Total</th>
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
																	<strong id="acumCantidad_detalles_requisiciones_refacciones_servicio"></strong>
																</td>
																<td class="movil t4"></td>
																<td class="movil t5">
																	<strong id="acumDescuento_detalles_requisiciones_refacciones_servicio"></strong>
																</td>
																<td class="movil t6">
																	<strong id="acumSubtotal_detalles_requisiciones_refacciones_servicio"></strong>
																</td>
																<td class="movil t7">
																	<strong id="acumIva_detalles_requisiciones_refacciones_servicio"></strong>
																</td>
																<td class="movil t8">
																	<strong  id="acumIeps_detalles_requisiciones_refacciones_servicio"></strong>
																</td>
																<td class="movil t9">
																	<strong id="acumTotal_detalles_requisiciones_refacciones_servicio"></strong>
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
																<strong id="numElementos_detalles_requisiciones_refacciones_servicio">0</strong> encontrados
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
							<button class="btn btn-success" id="btnGuardar_requisiciones_refacciones_servicio"  
									onclick="validar_requisiciones_refacciones_servicio();"  title="Guardar" tabindex="2">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_requisiciones_refacciones_servicio"  
									onclick="reporte_registro_requisiciones_refacciones_servicio('');"  title="Imprimir registro en PDF" tabindex="3">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_requisiciones_refacciones_servicio"  
									onclick="cambiar_estatus_requisiciones_refacciones_servicio('','ACTIVO');"  title="Desactivar" tabindex="4">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_requisiciones_refacciones_servicio"  
									onclick="cambiar_estatus_requisiciones_refacciones_servicio('','INACTIVO');"  title="Restaurar" tabindex="5">
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_requisiciones_refacciones_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_requisiciones_refacciones_servicio();" 
									title="Cerrar"  tabindex="6">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#RequisicionesRefaccionesServicioContent -->

	<!-- /.Plantilla para cargar las monedas de la requisición en el combobox-->  
	<script id="monedas_requisiciones_refacciones_servicio" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaRequisicionesRefaccionesServicio = 0;
		var strUltimaBusquedaRequisicionesRefaccionesServicio = "";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
		var intNumDecimalesMostrarRequisicionesRefaccionesServicio = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
		//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
		var intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio = <?php echo NUM_DECIMALES_PRECIO_UNIT_REQ_REFACCIONES ?>;
		var intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio = <?php echo NUM_DECIMALES_DESCUENTO_UNIT_REQ_REFACCIONES ?>;
		var intNumDecimalesIvaUnitBDRequisicionesRefaccionesServicio = <?php echo NUM_DECIMALES_IVA_UNIT_REQ_REFACCIONES ?>;
		var intNumDecimalesIepsUnitBDRequisicionesRefaccionesServicio = <?php echo NUM_DECIMALES_IEPS_UNIT_REQ_REFACCIONES ?>;
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDRequisicionesRefaccionesServicio = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseRequisicionesRefaccionesServicio = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoRequisicionesRefaccionesServicio = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objRequisicionesRefaccionesServicio = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_requisiciones_refacciones_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/requisiciones_refacciones/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_requisiciones_refacciones_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRequisicionesRefaccionesServicio = data.row;
					//Separar la cadena 
					var arrPermisosRequisicionesRefaccionesServicio = strPermisosRequisicionesRefaccionesServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRequisicionesRefaccionesServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRequisicionesRefaccionesServicio[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_requisiciones_refacciones_servicio').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosRequisicionesRefaccionesServicio[i]=='GUARDAR') || (arrPermisosRequisicionesRefaccionesServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_requisiciones_refacciones_servicio').removeAttr('disabled');
						}
						else if(arrPermisosRequisicionesRefaccionesServicio[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_requisiciones_refacciones_servicio').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_requisiciones_refacciones_servicio();
						}
						else if(arrPermisosRequisicionesRefaccionesServicio[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_requisiciones_refacciones_servicio').removeAttr('disabled');
							$('#btnRestaurar_requisiciones_refacciones_servicio').removeAttr('disabled');
						}
						else if(arrPermisosRequisicionesRefaccionesServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_requisiciones_refacciones_servicio').removeAttr('disabled');
						}
						else if(arrPermisosRequisicionesRefaccionesServicio[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_requisiciones_refacciones_servicio').removeAttr('disabled');
						}
						else if(arrPermisosRequisicionesRefaccionesServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_requisiciones_refacciones_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_requisiciones_refacciones_servicio() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaRequisicionesRefaccionesServicio =($('#txtFechaInicialBusq_requisiciones_refacciones_servicio').val()+$('#txtFechaFinalBusq_requisiciones_refacciones_servicio').val()+$('#txtProspectoIDBusq_requisiciones_refacciones_servicio').val()+$('#cmbEstatusBusq_requisiciones_refacciones_servicio').val()+$('#txtBusqueda_requisiciones_refacciones_servicio').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaRequisicionesRefaccionesServicio != strUltimaBusquedaRequisicionesRefaccionesServicio)
			{
				intPaginaRequisicionesRefaccionesServicio = 0;
				strUltimaBusquedaRequisicionesRefaccionesServicio = strNuevaBusquedaRequisicionesRefaccionesServicio;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/requisiciones_refacciones/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_requisiciones_refacciones_servicio').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_requisiciones_refacciones_servicio').val()),
					 intProspectoID: $('#txtProspectoIDBusq_requisiciones_refacciones_servicio').val(),
					 strEstatus:     $('#cmbEstatusBusq_requisiciones_refacciones_servicio').val(),
					strBusqueda:    $('#txtBusqueda_requisiciones_refacciones_servicio').val(),
					 intPagina: intPaginaRequisicionesRefaccionesServicio,
					 strPermisosAcceso: $('#txtAcciones_requisiciones_refacciones_servicio').val()
					},
					function(data){
						$('#dg_requisiciones_refacciones_servicio tbody').empty();
						var tmpRequisicionesRefaccionesServicio = Mustache.render($('#plantilla_requisiciones_refacciones_servicio').html(),data);
						$('#dg_requisiciones_refacciones_servicio tbody').html(tmpRequisicionesRefaccionesServicio);
						$('#pagLinks_requisiciones_refacciones_servicio').html(data.paginacion);
						$('#numElementos_requisiciones_refacciones_servicio').html(data.total_rows);
						intPaginaRequisicionesRefaccionesServicio = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_requisiciones_refacciones_servicio(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/requisiciones_refacciones/';

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
			if ($('#chbImprimirDetalles_requisiciones_refacciones_servicio').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_requisiciones_refacciones_servicio').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_requisiciones_refacciones_servicio').val('NO');
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_requisiciones_refacciones_servicio').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_requisiciones_refacciones_servicio').val()),
										'intProspectoID': $('#txtProspectoIDBusq_requisiciones_refacciones_servicio').val(),
										'strEstatus': $('#cmbEstatusBusq_requisiciones_refacciones_servicio').val(), 
										'strBusqueda': $('#txtBusqueda_requisiciones_refacciones_servicio').val(),
										'strDetalles': $('#chbImprimirDetalles_requisiciones_refacciones_servicio').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_requisiciones_refacciones_servicio(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtRequisicionRefaccionesID_requisiciones_refacciones_servicio').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'servicio/requisiciones_refacciones/get_reporte_registro',
							'data' : {
										'intRequisicionRefaccionesID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}


		//Regresar monedas activas para cargarlas en el combobox de la requisición
		function cargar_monedas_requisiciones_refacciones_servicio()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_requisiciones_refacciones_servicio').empty();
					var temp = Mustache.render($('#monedas_requisiciones_refacciones_servicio').html(), data);
					$('#cmbMonedaID_requisiciones_refacciones_servicio').html(temp);
				},
				'json');
		}
	
		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_requisiciones_refacciones_servicio()
		{
			//Incializar formulario
			$('#frmRequisicionesRefaccionesServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_requisiciones_refacciones_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmRequisicionesRefaccionesServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_requisiciones_refacciones_servicio');
			//Eliminar los datos de la tabla detalles de la requisición
		    $('#dg_detalles_requisiciones_refacciones_servicio tbody').empty();
		    $('#acumCantidad_detalles_requisiciones_refacciones_servicio').html('');
		    $('#acumDescuento_detalles_requisiciones_refacciones_servicio').html('');
		    $('#acumSubtotal_detalles_requisiciones_refacciones_servicio').html('');
		    $('#acumIva_detalles_requisiciones_refacciones_servicio').html('');
		    $('#acumIeps_detalles_requisiciones_refacciones_servicio').html('');
		    $('#acumTotal_detalles_requisiciones_refacciones_servicio').html('');
			$('#numElementos_detalles_requisiciones_refacciones_servicio').html(0);
			//Habilitar todos los elementos del formulario
			$('#frmRequisicionesRefaccionesServicio').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_requisiciones_refacciones_servicio').val(fechaActual()); 
		
			//Deshabilitar las siguientes cajas de texto			
			var arrCajasTexto  = {
									//Son los id de los input que se van a deshabilitar
									rows: [	'#txtFolio_requisiciones_refacciones_servicio',
											'#txtProspecto_requisiciones_refacciones_servicio',	
											'#txtRefaccion_detalles_requisiciones_refacciones_servicio',	
											'#txtMoneda_detalles_requisiciones_refacciones_servicio',
											'#txtTipoCambio_detalles_requisiciones_refacciones_servicio',
											'#txtCantidad_detalles_requisiciones_refacciones_servicio',
											'#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio',
											'#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio',
											'#txtPorcentajeIva_detalles_requisiciones_refacciones_servicio',
											'#txtPorcentajeIeps_detalles_requisiciones_refacciones_servicio'
										],
									//Es asignar un attributo disbaled|checked
									attribute: 'disabled',
									//Bool es para deshabilitar
									bool: true
								};
			//Hacer un llamado a la función para deshabilitar cajas de texto		
			$.habilitar_deshabilitar_campos(arrCajasTexto);
			//Mostrar los siguientes botones
			$("#btnGuardar_requisiciones_refacciones_servicio").show();
			//Habilitar botón Agregar
			$('#btnAgregar_detalles_requisiciones_refacciones_servicio').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_requisiciones_refacciones_servicio").hide();
			$("#btnDesactivar_requisiciones_refacciones_servicio").hide();
			$("#btnRestaurar_requisiciones_refacciones_servicio").hide();
		}
		

	    //Función para inicializar elementos de la orden de reparación
		function inicializar_orden_reparacion_requisiciones_refacciones_servicio()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtProspecto_requisiciones_refacciones_servicio').val('');
            $('#txtServicioListaPrecioID_requisiciones_refacciones_servicio').val('');
            $('#txtTipoReparacion_requisiciones_refacciones_servicio').val('');
            
            //Hacer un llamado a la función para habilitar/deshabilitar el precio unitario de la refacción
		    habilitar_precio_unitario_detalles_requisiciones_refacciones_servicio();
		}


		//Función que se utiliza para cerrar el modal
		function cerrar_requisiciones_refacciones_servicio()
		{
			try {
				//Cerrar modal
				objRequisicionesRefaccionesServicio.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_requisiciones_refacciones_servicio').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_requisiciones_refacciones_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_requisiciones_refacciones_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmRequisicionesRefaccionesServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_requisiciones_refacciones_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intMonedaID_requisiciones_refacciones_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_requisiciones_refacciones_servicio: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_requisiciones_refacciones_servicio').val()) !== intMonedaBaseIDRequisicionesRefaccionesServicio)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoRequisicionesRefaccionesServicio)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoRequisicionesRefaccionesServicio
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strOrdenReparacion_requisiciones_refacciones_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la orden de reparación interna
					                                    if($('#txtOrdenReparacionID_requisiciones_refacciones_servicio').val() === '')
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
										intNumDetalles_requisiciones_refacciones_servicio: {
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
										strRefaccion_detalles_requisiciones_refacciones_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intTipoCambio_detalles_requisiciones_refacciones_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_detalles_requisiciones_refacciones_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_detalles_requisiciones_refacciones_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_detalles_requisiciones_refacciones_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_detalles_requisiciones_refacciones_servicio: {
											excluded: true  //Ignorar (no valida el campo)
										},
										intPorcentajeIeps_detalles_requisiciones_refacciones_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intTasaCuotaIva_detalles_requisiciones_refacciones_servicio: {
											excluded: true  //Ignorar (no valida el campo)
										},
										intTasaCuotaIeps_detalles_requisiciones_refacciones_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_requisiciones_refacciones_servicio = $('#frmRequisicionesRefaccionesServicio').data('bootstrapValidator');
			bootstrapValidator_requisiciones_refacciones_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_requisiciones_refacciones_servicio.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_requisiciones_refacciones_servicio();
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_requisiciones_refacciones_servicio()
		{
			try
			{
				$('#frmRequisicionesRefaccionesServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_requisiciones_refacciones_servicio()
		{
			
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_requisiciones_refacciones_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRenglon = [];
			var arrRefaccionID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCodigosLineas = [];
			var arrCantidades = [];
			var arrPreciosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrTasaCuotaIva = [];
			var arrIvasUnitarios = [];
			var arrTasaCuotaIeps = [];
			var arrIepsUnitarios = [];
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioRequisicion = parseFloat($('#txtTipoCambio_requisiciones_refacciones_servicio').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var intCantidad = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intPrecioUnitario = $.reemplazar(objRen.cells[19].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[20].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[21].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[22].innerHTML, ",", "");
				
				var intTasaIvaUnitario = objRen.cells[16].innerHTML;
				var intTasaIepsUnitario = objRen.cells[17].innerHTML;

				//Calcular iva unitario
				intIvaUnitario =  intIvaUnitario / intCantidad;
				//Calcular ieps unitario
				intIepsUnitario = intIepsUnitario / intCantidad;

				//Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioRequisicion;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioRequisicion;
				intIvaUnitario = intIvaUnitario * intTipoCambioRequisicion;
				intIepsUnitario = intIepsUnitario * intTipoCambioRequisicion;

				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{	
					//Restar descuento al precio unitario
					intPrecioUnitario = intPrecioUnitario - intDescuentoUnitario;
				}

				//Redondear cantidad a decimales
				intIvaUnitario = intIvaUnitario.toFixed(intNumDecimalesIvaUnitBDRequisicionesRefaccionesServicio);
				intIvaUnitario = parseFloat(intIvaUnitario);
				
				//Redondear cantidad a decimales
				intIepsUnitario = intIepsUnitario.toFixed(intNumDecimalesIepsUnitBDRequisicionesRefaccionesServicio);
				intIepsUnitario = parseFloat(intIepsUnitario);

				//Asignar valores a los arrays
				arrRenglon.push(objRen.cells[23].innerHTML)
				arrRefaccionID.push(objRen.getAttribute('id'));
				arrCodigos.push(objRen.cells[0].innerHTML);
				arrDescripciones.push(objRen.cells[1].innerHTML);
				arrCantidades.push(intCantidad);
				arrPreciosUnitarios.push(intPrecioUnitario);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrTasaCuotaIva.push(intTasaIvaUnitario);
				arrIvasUnitarios.push(intIvaUnitario);
				arrTasaCuotaIeps.push(intTasaIepsUnitario );
				arrIepsUnitarios.push(intIepsUnitario);
				arrCodigosLineas.push(objRen.cells[18].innerHTML);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('servicio/requisiciones_refacciones/guardar',
					{ 
						//Datos de la requisición
						intRequisicionRefaccionesID: $('#txtRequisicionRefaccionesID_requisiciones_refacciones_servicio').val(),
						strFolioConsecutivo: $('#txtFolio_requisiciones_refacciones_servicio').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_requisiciones_refacciones_servicio').val()),
						intOrdenReparacionID: $('#txtOrdenReparacionID_requisiciones_refacciones_servicio').val(),
						strEstatusOrdenReparacion: $('#txtEstatusOrdenReparacion_requisiciones_refacciones_servicio').val(),
						intMonedaID: $('#cmbMonedaID_requisiciones_refacciones_servicio').val(),
						intTipoCambio: intTipoCambioRequisicion,
						strObservaciones: $('#txtObservaciones_requisiciones_refacciones_servicio').val(),
						strEstatus: $('#txtEstatus_requisiciones_refacciones_servicio').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_requisiciones_refacciones_servicio').val(),
						//Datos de los detalles
						strRenglon: arrRenglon.join('|'),
						strRefaccionID: arrRefaccionID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strCodigosLineas: arrCodigosLineas.join('|'),
						strCantidades: arrCantidades.join('|'),
						strPreciosUnitarios: arrPreciosUnitarios.join('|'),
						strDescuentosUnitarios: arrDescuentosUnitarios.join('|'),
						strTasaCuotaIva: arrTasaCuotaIva.join('|'),
						strIvasUnitarios: arrIvasUnitarios.join('|'),
						strTasaCuotaIeps: arrTasaCuotaIeps.join('|'),
						strIepsUnitarios: arrIepsUnitarios.join('|')
					},
					function(data) {
						if (data.resultado)
						{
         					//Hacer un llamado a la función para cerrar modal
	                    	cerrar_requisiciones_refacciones_servicio();
							//Hacer llamado a la función  para cargar  los registros en el grid
	               			paginacion_requisiciones_refacciones_servicio();  
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_requisiciones_refacciones_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_requisiciones_refacciones_servicio(tipoMensaje, mensaje)
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
			else if(tipoMensaje == 'informacion_refacciones')
            { 
                //Indicar al usuario el mensaje de información
                new $.Zebra_Dialog(mensaje, {
	                                'type': 'information',
	                                'title': 'Información',
	                                'buttons': [{caption: 'Aceptar',
	                                             callback: function () {
	                                             	
	                                             		//Enfocar caja de texto
														$('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').focus();
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
		function cambiar_estatus_requisiciones_refacciones_servicio(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtRequisicionRefaccionesID_requisiciones_refacciones_servicio').val();

			}
			else
			{
				intID = id;
				strTipo = 'gridview';
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

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_requisiciones_refacciones_servicio(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_requisiciones_refacciones_servicio(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_requisiciones_refacciones_servicio(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('servicio/requisiciones_refacciones/set_estatus',
			      {intRequisicionRefaccionesID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_requisiciones_refacciones_servicio();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_requisiciones_refacciones_servicio();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_requisiciones_refacciones_servicio(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_requisiciones_refacciones_servicio(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/requisiciones_refacciones/get_datos',
			       {
			       		intRequisicionRefaccionesID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_requisiciones_refacciones_servicio();
							//Asignar estatus y reemplazar cadena vacia por '_'
				            var strEstatus = data.row.estatus;
							
							 //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';

				          	//Recuperar valores
				            $('#txtRequisicionRefaccionesID_requisiciones_refacciones_servicio').val(data.row.requisicion_refacciones_id);
				            $('#txtFolio_requisiciones_refacciones_servicio').val(data.row.folio);
				            $('#txtFecha_requisiciones_refacciones_servicio').val(data.row.fecha);
				            $('#txtOrdenReparacionID_requisiciones_refacciones_servicio').val(data.row.orden_reparacion_id);
				            $('#txtOrdenReparacion_requisiciones_refacciones_servicio').val(data.row.folio_orden_reparacion);
				            $('#txtEstatusOrdenReparacion_requisiciones_refacciones_servicio').val(data.row.estatus_orden_reparacion);
				            $('#txtProspecto_requisiciones_refacciones_servicio').val(data.row.prospecto);
				            $('#txtServicioListaPrecioID_requisiciones_refacciones_servicio').val(data.row.servicio_lista_precio_id);
				            $('#txtTipoReparacion_requisiciones_refacciones_servicio').val(data.row.tipo_reparacion);
				            $('#cmbMonedaID_requisiciones_refacciones_servicio').val(data.row.moneda_id);
				            $('#txtTipoCambio_requisiciones_refacciones_servicio').val(data.row.tipo_cambio);
						    $('#txtObservaciones_requisiciones_refacciones_servicio').val(data.row.observaciones);
						    $('#txtEstatus_requisiciones_refacciones_servicio').val(strEstatus);

				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_requisiciones_refacciones_servicio").show();

							//Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmRequisicionesRefaccionesServicio').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_requisiciones_refacciones_servicio").hide();

					            //Si el estatus del registro es INACTIVO
				            	if(strEstatus == 'INACTIVO')
				            	{
				            		//Mostrar botón Restaurar
				            		$("#btnRestaurar_requisiciones_refacciones_servicio").show();
				            		//Deshabilitar botón Agregar
			            			$('#btnAgregar_detalles_requisiciones_refacciones_servicio').prop('disabled', true);
				            	}

				            }
				            else
				            {
							    //Si el estatus del registro es ACTIVO
							    if(strEstatus == 'ACTIVO')
							    {

							    	strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalles_requisiciones_refacciones_servicio(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_detalles_requisiciones_refacciones_servicio(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

							    	//Mostrar botón Desactivar
				            		$("#btnDesactivar_requisiciones_refacciones_servicio").show();

							    	//Si el id de la moneda no corresponde al peso mexicano
								    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDRequisicionesRefaccionesServicio)
								    {
										//Habilitar caja de texto
										$('#txtTipoCambio_requisiciones_refacciones_servicio').removeAttr('disabled');
								    }
								    else
								    {
								    	//Deshabilitar las siguientes cajas de texto
										$("#txtTipoCambio_requisiciones_refacciones_servicio").attr('disabled','disabled');
								    }

							    	//Habilitar las siguientes cajas de texto
									$("#txtRefaccion_detalles_requisiciones_refacciones_servicio").removeAttr('disabled');
									$("#txtCantidad_detalles_requisiciones_refacciones_servicio").removeAttr('disabled');
									$("#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio").removeAttr('disabled');

							    }
							    else
							    {
							    	//Si el tipo de reparación es Garantía
							    	if($("#txtTipoReparacion_requisiciones_refacciones_servicio").val() == 'GARANTIA')
							    	{
							    		strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
													 	" onclick='editar_renglon_detalles_requisiciones_refacciones_servicio(this)'>" + 
													 	"<span class='glyphicon glyphicon-edit'></span></button>";
							    	}
							    	else
							    	{
							    		//Deshabilitar botón Agregar
			            				$('#btnAgregar_detalles_requisiciones_refacciones_servicio').prop('disabled', true);
							    	}


							    	//Deshabilitar todos los elementos del formulario
				            		$('#frmRequisicionesRefaccionesServicio').find('input, textarea, select').attr('disabled','disabled');
							    }

							    //Hacer un llamado a la función para habilitar/deshabilitar el precio unitario de la refacción
							   habilitar_precio_unitario_detalles_requisiciones_refacciones_servicio();
							    
				            }

				            //Reemplazar cadena vacia por '_'
				            strEstatus = strEstatus.replace(" ", "_");
						    //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_requisiciones_refacciones_servicio').addClass("estatus-"+strEstatus);

				            //Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);

				           	//Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_requisiciones_refacciones_servicio').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaCodigo = objRenglon.insertCell(0);
								var objCeldaDescripcion = objRenglon.insertCell(1);
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
								var objCeldaMoneda = objRenglon.insertCell(13);
								var objCeldaTipoCambio = objRenglon.insertCell(14);
								var objCeldaPrecioRefaccion = objRenglon.insertCell(15);
								var objCeldaTasaCuotaIva = objRenglon.insertCell(16);
								var objCeldaTasaCuotaIeps = objRenglon.insertCell(17);
								var objCeldaCodigoLinea = objRenglon.insertCell(18);
								var objCeldaPrecioUnitarioBD = objRenglon.insertCell(19);
								var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(20);
								var objCeldaIvaUnitarioBD = objRenglon.insertCell(21);
								var objCeldaIepsUnitarioBD = objRenglon.insertCell(22);
								var objCeldaRenglon = objRenglon.insertCell(23);
								var objCeldaCostoActual = objRenglon.insertCell(24);

								//Variables que se utilizan para asignar valores del detalle
								var intSubtotal = parseFloat(data.detalles[intCon].precio_unitario);
								var intCantidad =  parseFloat(data.detalles[intCon].cantidad);
								var intPrecioUnitario = parseFloat(data.detalles[intCon].precio_unitario);
								var intDescuentoUnitario = parseFloat(data.detalles[intCon].descuento_unitario);
								var intIvaUnitario = parseFloat(data.detalles[intCon].iva_unitario);
								var intIepsUnitario = parseFloat(data.detalles[intCon].ieps_unitario);
								var intImporteIva = 0;
								var intImporteIeps = 0;
								var intPorcentajeDescuento = 0;
								var intPorcentajeIeps = '';
								var intTotal = 0;


								//Convertir peso mexicano a tipo de cambio
								intSubtotal = intSubtotal / intTipoCambio;
								intPrecioUnitario = intPrecioUnitario / intTipoCambio;
								intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
								intIvaUnitario = intIvaUnitario / intTipoCambio;
								intIepsUnitario = intIepsUnitario / intTipoCambio;

								//Si existe importe del descuento
								if(intDescuentoUnitario > 0)
								{
									intPrecioUnitario = intPrecioUnitario + intDescuentoUnitario;
									//Calcular porcentaje del descuento
									intPorcentajeDescuento = (intDescuentoUnitario / intPrecioUnitario) * 100;
								}
								
								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;
								
								//Calcular importe de IVA
								intImporteIva =  intIvaUnitario * intCantidad;
								
								//Si existe importe de IEPS unitario
								if(intIepsUnitario > 0)
								{
									//Calcular importe de IEPS
									intImporteIeps =  intIepsUnitario * intCantidad;
									intPorcentajeIeps = data.detalles[intCon].porcentaje_ieps;
								}

								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;

								//Cambiar cantidad a  formato moneda (a visualizar)
								intCantidad =  formatMoney(intCantidad, 2, '');
								var intPrecioUnitarioMostrar =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio, '');
								
								var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio, '');
								
								var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio, '');
								
								var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarRequisicionesRefaccionesServicio, '');
								
								var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarRequisicionesRefaccionesServicio, '');
								
								var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarRequisicionesRefaccionesServicio, '');
								
								intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio, '');

								//Cambiar cantidad a  formato moneda (a guardar en la  BD)
								var intPrecioUnitarioBD =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio, '');
								
								var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio, '');
								
								var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDRequisicionesRefaccionesServicio, '');
								
								var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDRequisicionesRefaccionesServicio, '');


								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].refaccion_id);
								objCeldaCodigo.setAttribute('class', 'movil b1');
								objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
								objCeldaDescripcion.setAttribute('class', 'movil b2');
								objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
								objCeldaCantidad.setAttribute('class', 'movil b3');
								objCeldaCantidad.innerHTML = intCantidad;
								objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
								objCeldaPrecioUnitario.innerHTML = intPrecioUnitarioMostrar;
								objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
								objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitarioMostrar;
								objCeldaSubtotal.setAttribute('class', 'movil b6');
								objCeldaSubtotal.innerHTML = intSubtotalMostrar;
								objCeldaIvaUnitario.setAttribute('class', 'movil b7');
								objCeldaIvaUnitario.innerHTML = intImporteIvaMostrar;
								objCeldaIepsUnitario.setAttribute('class', 'movil b8');
								objCeldaIepsUnitario.innerHTML = intImporteIepsMostrar;
								objCeldaTotal.setAttribute('class', 'movil b9');
								objCeldaTotal.innerHTML = intTotalMostrar;
								objCeldaAcciones.setAttribute('class', 'td-center movil b10');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento;
								objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIva.innerHTML =  data.detalles[intCon].porcentaje_iva;
								objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps
								objCeldaMoneda.setAttribute('class', 'no-mostrar');
								objCeldaMoneda.innerHTML = data.row.codigo_moneda;
								objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
								objCeldaTipoCambio.innerHTML = data.row.tipo_cambio;
								objCeldaPrecioRefaccion.setAttribute('class', 'no-mostrar');
								objCeldaPrecioRefaccion.innerHTML = intPrecioUnitario;
								objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIva.innerHTML = data.detalles[intCon].tasa_cuota_iva;;
								objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIeps.innerHTML = data.detalles[intCon].tasa_cuota_ieps;
								objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
								objCeldaCodigoLinea.innerHTML =  data.detalles[intCon].codigo_linea;
								objCeldaPrecioUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaPrecioUnitarioBD.innerHTML =  intPrecioUnitarioBD;
								objCeldaDescuentoUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaDescuentoUnitarioBD.innerHTML =  intDescuentoUnitarioBD;
								objCeldaIvaUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaIvaUnitarioBD.innerHTML =  intImporteIvaBD;
								objCeldaIepsUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaIepsUnitarioBD.innerHTML =  intImporteIepsBD;
								objCeldaRenglon.setAttribute('class', 'no-mostrar');
								objCeldaRenglon.innerHTML =  data.detalles[intCon].renglon;
								objCeldaCostoActual.setAttribute('class', 'no-mostrar');
								objCeldaCostoActual.innerHTML = data.detalles[intCon].actual_costo;
				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_requisiciones_refacciones_servicio();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_requisiciones_refacciones_servicio tr").length - 2;
							$('#numElementos_detalles_requisiciones_refacciones_servicio').html(intFilas);
							$('#txtNumDetalles_requisiciones_refacciones_servicio').val(intFilas);

						

			            	//Abrir modal
				            objRequisicionesRefaccionesServicio = $('#RequisicionesRefaccionesServicioBox').bPopup({
														  appendTo: '#RequisicionesRefaccionesServicioContent', 
							                              contentContainer: 'RequisicionesRefaccionesServicioM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#cmbMonedaID_requisiciones_refacciones_servicio').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_requisiciones_refacciones_servicio()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_requisiciones_refacciones_servicio').val()) !== intMonedaBaseIDRequisicionesRefaccionesServicio)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_requisiciones_refacciones_servicio").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_requisiciones_refacciones_servicio').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_requisiciones_refacciones_servicio').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_requisiciones_refacciones_servicio").val(data.row.tipo_cambio_venta);
	                       //Hacer un llamado a la función para recalcular los importes
			  			   recalcular_importes_detalles_requisiciones_refacciones_servicio();
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}

		

		//Función para habilitar y deshabilitar los campos del detalle cuando cambia el tipo de cambio
		function habilitar_elementos_tipo_cambios_detalles_requisiciones_refacciones_servicio(campo){

			//Hacer un llamado a la función para habilitar/deshabilitar el precio unitario de la refacción
			habilitar_precio_unitario_detalles_requisiciones_refacciones_servicio();

			//Deshabilitar o habilitar las siguientes cajas de texto			
			var arrCajasTexto  = {
						//Son los id de los input que se van a habilitar o deshabilitar
						rows:['#txtRefaccion_detalles_requisiciones_refacciones_servicio',
							  '#txtCantidad_detalles_requisiciones_refacciones_servicio',
							  '#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio'
							  ],
						//Es asignar un attributo disbaled|checked
						attribute: 'disabled',									
					};						
			($(campo).val() && $('#txtTipoCambio_requisiciones_refacciones_servicio').val())? arrCajasTexto.bool = false: arrCajasTexto.bool= true;								
			//Hacer un llamado a la función para habilitar o deshabilitar cajas de texto				
			$.habilitar_deshabilitar_campos(arrCajasTexto);
		}



		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_requisiciones_refacciones_servicio()
		{
			//Limpiamos las cajas de texto
			$('#txtRefaccionID_detalles_requisiciones_refacciones_servicio').val('');
			$('#txtRefaccion_detalles_requisiciones_refacciones_servicio').val('');
			$('#txtCodigo_detalles_requisiciones_refacciones_servicio').val('');
			$('#txtDescripcion_detalles_requisiciones_refacciones_servicio').val('');
			$('#txtCodigoLinea_detalles_requisiciones_refacciones_servicio').val('');
			$('#txtCantidad_detalles_requisiciones_refacciones_servicio').val('');
			$('#txtPrecioRefaccion_detalles_requisiciones_refacciones_servicio').val('');
		    $('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').val('');
		    $('#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio').val('0.00');
		    $('#txtPorcentajeIva_detalles_requisiciones_refacciones_servicio').val('');
		    $('#txtPorcentajeIeps_detalles_requisiciones_refacciones_servicio').val('');
		    $('#txtTasaCuotaIva_detalles_requisiciones_refacciones_servicio').val('');
		    $('#txtTasaCuotaIeps_detalles_requisiciones_refacciones_servicio').val('');
		    $('#txtMoneda_detalles_requisiciones_refacciones_servicio').val('');
            $('#txtTipoCambio_detalles_requisiciones_refacciones_servicio').val('');
            $('#txtActualCosto_detalles_requisiciones_refacciones_servicio').val('');
		}


		//Función para habilitar y deshabilitar el precio unitario de la refacción dependiendo del tipo de reparación
		function habilitar_precio_unitario_detalles_requisiciones_refacciones_servicio()
		{
			//Dependiendo del tipo de reparación habilitar/deshabilitar precio unitario de la refacción
			if($('#txtTipoReparacion_requisiciones_refacciones_servicio').val() == 'GARANTIA'
				&& $('#cmbMonedaID_requisiciones_refacciones_servicio').val() != '' && 
				   $('#txtTipoCambio_requisiciones_refacciones_servicio').val() != '')
			{
			    //Habilitar precio unitario de la refacción
	            $("#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio").removeAttr('disabled');
			}
			else
			{
				//Deshabilitar precio unitario de la refacción
	            $('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').attr("disabled", "disabled");
			}
		}

		//Función para regresar obtener los datos de una refacción
		function get_datos_refaccion_detalles_requisiciones_refacciones_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los datos de la refacción
	        $.post('refacciones/refacciones/get_datos',
	              { 
	              	strBusqueda:$("#txtRefaccionID_detalles_requisiciones_refacciones_servicio").val(),
		       		strTipo: 'id',
		       		intRefaccionesListaPrecioID: $("#txtServicioListaPrecioID_requisiciones_refacciones_servicio").val(),
		       		//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día 
		       		dteFechaTipoCambio: $.formatFechaMysql($('#txtFecha_requisiciones_refacciones_servicio').val())
	              },
	              function(data) {
	                if(data.row){
	               	    $("#txtDescripcion_detalles_requisiciones_refacciones_servicio").val(data.row.descripcion);
	                    $("#txtCodigoLinea_detalles_requisiciones_refacciones_servicio").val(data.row.codigo_linea);
	                    $("#txtTasaCuotaIva_detalles_requisiciones_refacciones_servicio").val(data.row.tasa_cuota_iva);
	                    $("#txtPorcentajeIva_detalles_requisiciones_refacciones_servicio").val(data.row.porcentaje_iva);
	                    $("#txtTasaCuotaIeps_detalles_requisiciones_refacciones_servicio").val(data.row.tasa_cuota_ieps);
	                    $("#txtPorcentajeIeps_detalles_requisiciones_refacciones_servicio").val(data.row.porcentaje_ieps);
	                    $("#txtMoneda_detalles_requisiciones_refacciones_servicio").val(data.row.codigo_moneda);
	                    $("#txtTipoCambio_detalles_requisiciones_refacciones_servicio").val(data.row.tipo_cambio_venta);
	                    $("#txtPrecioRefaccion_detalles_requisiciones_refacciones_servicio").val(data.row.precio);
	                    $("#txtTipoCambioRefaccion_detalles_requisiciones_refacciones_servicio").val(data.row.tipo_cambio_venta);
	                    $("#txtActualCosto_detalles_requisiciones_refacciones_servicio").val(data.row.actual_costo);
	                    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
						$('#txtTipoCambio_detalles_requisiciones_refacciones_servicio').formatCurrency({ roundToDecimalPlace: 4 });
	                    //Si el id de la moneda no corresponde al peso mexicano
					    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDRequisicionesRefaccionesServicio)
					    {
							//Habilitar caja de texto
							$("#txtTipoCambio_detalles_requisiciones_refacciones_servicio").removeAttr('disabled');
					    }
					    else
					    {
					    	//Deshabilitar caja de texto
							$("#txtTipoCambio_detalles_requisiciones_refacciones_servicio").attr('disabled','disabled');
					    }

					    //Hacer un llamado a la función para calcular el precio unitario
					  	calcular_precio_unitario_detalles_requisiciones_refacciones_servicio();
	               	
	                   //Enfocar caja de texto
	              	   $("#txtCantidad_detalles_requisiciones_refacciones_servicio").focus();
	                }
	              }
	             ,
	            'json');
		}


		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_requisiciones_refacciones_servicio()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla ordenes_compra_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asignar el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

		    //Variable que se utiliza para asignar el tipo de cambio de la requisición
		    var intTipoCambioRequisicion = parseFloat($('#txtTipoCambio_requisiciones_refacciones_servicio').val());
		    //Variable que se utiliza para asignar el tipo de cambio de la requisición
		    var intMonedaIDRequisicion =  parseFloat($('#cmbMonedaID_requisiciones_refacciones_servicio').val());
			//Obtenemos los datos de las cajas de texto
			var intRefaccionID = $('#txtRefaccionID_detalles_requisiciones_refacciones_servicio').val();
			var strRefaccion = $('#txtRefaccion_detalles_requisiciones_refacciones_servicio').val();
			var strCodigo = $('#txtCodigo_detalles_requisiciones_refacciones_servicio').val();
			var strDescripcion = $('#txtDescripcion_detalles_requisiciones_refacciones_servicio').val();
			var strCodigoLinea = $('#txtCodigoLinea_detalles_requisiciones_refacciones_servicio').val();
			var strMoneda = $('#txtMoneda_detalles_requisiciones_refacciones_servicio').val();
			var intTipoCambio = $('#txtTipoCambio_detalles_requisiciones_refacciones_servicio').val();
			var intPrecioRefaccion = $('#txtPrecioRefaccion_detalles_requisiciones_refacciones_servicio').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').val();
			var intCantidad = $('#txtCantidad_detalles_requisiciones_refacciones_servicio').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_requisiciones_refacciones_servicio').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_requisiciones_refacciones_servicio').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_requisiciones_refacciones_servicio').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_requisiciones_refacciones_servicio').val();
			var intActualCosto = $('#txtActualCosto_detalles_requisiciones_refacciones_servicio').val();


			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_requisiciones_refacciones_servicio').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intRefaccionID == '' || strRefaccion == '')
			{
				//Enfocar caja de texto
				$('#txtRefaccion_detalles_requisiciones_refacciones_servicio').focus();
			}
			else if (intTipoCambio == '')
			{
				//Enfocar caja de texto
				$('#txtTipoCambio_detalles_requisiciones_refacciones_servicio').focus();
			}
			else if (parseFloat($.reemplazar(intTipoCambio, ",", "")) > 99.9999)
			{
				//Limpiar caja de texto
				$('#txtTipoCambio_detalles_requisiciones_refacciones_servicio').val('');
				//Enfocar caja de texto
				$('#txtTipoCambio_detalles_requisiciones_refacciones_servicio').focus();
			}
			else if (intCantidad == '')
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_requisiciones_refacciones_servicio').focus();
			}
			else if (intPrecioUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio').focus();
			}
			else
			{
	           

				//Convertir cadena de texto a número decimal
				intPrecioUnitario = parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
				intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
				intSubtotal =  intPrecioUnitario;
				//Asignar el costo actual de la refacción convertido al tipo de cambio
				var intActualCostoConv = parseFloat(intActualCosto); 

			    //Si la moneda de la requisición no corresponde a peso mexicano
		        if(intMonedaIDRequisicion !== intMonedaBaseIDRequisicionesRefaccionesServicio)
		        {
		       		//Convertir peso mexicano a tipo de cambio
		       		intActualCostoConv = intActualCostoConv / intTipoCambioRequisicion;
		       		//Redondear cantidad a decimales
					intActualCostoConv = intActualCostoConv.toFixed(4);
					intActualCostoConv = parseFloat(intActualCostoConv);
		        }


				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;

					//Redondear cantidad a decimales
					intDescuentoUnitario = intDescuentoUnitario.toFixed(intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio);

					//Decrementar descuento unitario
					intSubtotal = intSubtotal - intDescuentoUnitario;
					//Redondear cantidad a decimales
					intSubtotal = intSubtotal.toFixed(intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio);
					intSubtotal = parseFloat(intSubtotal);

				}
				
				//Si el precio es mayor al costo actual
				if((intActualCostoConv < intSubtotal) && (intSubtotal > 0))
				{
					 //Hacer un llamado a la función para inicializar elementos de la refacción
	            	inicializar_refaccion_detalles_requisiciones_refacciones_servicio();

	            	//Calcular subtotal
					intSubtotal = intCantidad * intSubtotal;

					//Redondear cantidad a decimales
					intSubtotal = intSubtotal.toFixed(intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio);
					intSubtotal = parseFloat(intSubtotal);


					//Calcular importe de IVA
					intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
					//Redondear cantidad a dos decimales
				    intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaUnitBDRequisicionesRefaccionesServicio);
				    intImporteIva = parseFloat(intImporteIva);
					

					//Si existe porcentaje de IEPS
					if(intPorcentajeIeps != '')
					{
						//Calcular importe de IEPS
						intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
						//Redondear cantidad a dos decimales
				   	 	intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDRequisicionesRefaccionesServicio);
				   	 	intImporteIeps = parseFloat(intImporteIeps);
					}
					
					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;

					//Cambiar cantidad a  formato moneda (a visualizar)
					intCantidad =  formatMoney(intCantidad, 2, '');
					var intPrecioUnitarioMostrar =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio, '');
					
					var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio, '');
					
					var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio, '');
					
					var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarRequisicionesRefaccionesServicio, '');
					
					var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarRequisicionesRefaccionesServicio, '');
					
					var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarRequisicionesRefaccionesServicio, '');
					
					intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio, '');

					//Cambiar cantidad a  formato moneda (a guardar en la  BD)
					var intPrecioUnitarioBD =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio, '');
					
					var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio, '');
					
					var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDRequisicionesRefaccionesServicio, '');
					
					var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDRequisicionesRefaccionesServicio, '');

					//Revisamos si existe el ID proporcionado, si es así, editamos los datos
					if (objTabla.rows.namedItem(intRefaccionID))
					{

						objTabla.rows.namedItem(intRefaccionID).cells[0].innerHTML = strCodigo;
						objTabla.rows.namedItem(intRefaccionID).cells[1].innerHTML = strDescripcion;
						objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = intCantidad;
						objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML = intPrecioUnitarioMostrar;
						objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML = intDescuentoUnitarioMostrar;
						objTabla.rows.namedItem(intRefaccionID).cells[5].innerHTML = intSubtotalMostrar;
						objTabla.rows.namedItem(intRefaccionID).cells[6].innerHTML = intImporteIvaMostrar;
						objTabla.rows.namedItem(intRefaccionID).cells[7].innerHTML = intImporteIepsMostrar;
						objTabla.rows.namedItem(intRefaccionID).cells[8].innerHTML = intTotalMostrar;
						objTabla.rows.namedItem(intRefaccionID).cells[10].innerHTML = intPorcentajeDescuento;
						objTabla.rows.namedItem(intRefaccionID).cells[11].innerHTML = intPorcentajeIva;
						objTabla.rows.namedItem(intRefaccionID).cells[12].innerHTML = intPorcentajeIeps;
						objTabla.rows.namedItem(intRefaccionID).cells[13].innerHTML = strMoneda;
						objTabla.rows.namedItem(intRefaccionID).cells[14].innerHTML = intTipoCambio;
						objTabla.rows.namedItem(intRefaccionID).cells[15].innerHTML = intPrecioRefaccion;
						objTabla.rows.namedItem(intRefaccionID).cells[16].innerHTML = intTasaCuotaIva;
						objTabla.rows.namedItem(intRefaccionID).cells[17].innerHTML = intTasaCuotaIeps;
						objTabla.rows.namedItem(intRefaccionID).cells[18].innerHTML = strCodigoLinea;
						objTabla.rows.namedItem(intRefaccionID).cells[19].innerHTML = intPrecioUnitarioBD;
						objTabla.rows.namedItem(intRefaccionID).cells[20].innerHTML = intDescuentoUnitarioBD;
						objTabla.rows.namedItem(intRefaccionID).cells[21].innerHTML = intImporteIvaBD;
						objTabla.rows.namedItem(intRefaccionID).cells[22].innerHTML = intImporteIepsBD;
						objTabla.rows.namedItem(intRefaccionID).cells[24].innerHTML = intActualCosto;
						
					}
					else
					{
						//Insertamos el renglón con sus celdas en el objeto de la tabla
						var objRenglon = objTabla.insertRow();
						var objCeldaCodigo = objRenglon.insertCell(0);
						var objCeldaDescripcion = objRenglon.insertCell(1);
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
						var objCeldaMoneda = objRenglon.insertCell(13);
						var objCeldaTipoCambio = objRenglon.insertCell(14);
						var objCeldaPrecioRefaccion = objRenglon.insertCell(15);
						var objCeldaTasaCuotaIva = objRenglon.insertCell(16);
						var objCeldaTasaCuotaIeps = objRenglon.insertCell(17);
						var objCeldaCodigoLinea = objRenglon.insertCell(18);
						var objCeldaPrecioUnitarioBD = objRenglon.insertCell(19);
						var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(20);
						var objCeldaIvaUnitarioBD = objRenglon.insertCell(21);
						var objCeldaIepsUnitarioBD = objRenglon.insertCell(22);
						var objCeldaRenglon = objRenglon.insertCell(23);
						var objCeldaCostoActual = objRenglon.insertCell(24);

						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', intRefaccionID);
						objCeldaCodigo.setAttribute('class', 'movil b1');
						objCeldaCodigo.innerHTML = strCodigo;
						objCeldaDescripcion.setAttribute('class', 'movil b2');
						objCeldaDescripcion.innerHTML = strDescripcion;
						objCeldaCantidad.setAttribute('class', 'movil b3');
						objCeldaCantidad.innerHTML = intCantidad;
						objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
						objCeldaPrecioUnitario.innerHTML = intPrecioUnitarioMostrar;
						objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
						objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitarioMostrar;
						objCeldaSubtotal.setAttribute('class', 'movil b6');
						objCeldaSubtotal.innerHTML = intSubtotalMostrar;
						objCeldaIvaUnitario.setAttribute('class', 'movil b7');
						objCeldaIvaUnitario.innerHTML = intImporteIvaMostrar;
						objCeldaIepsUnitario.setAttribute('class', 'movil b8');
						objCeldaIepsUnitario.innerHTML = intImporteIepsMostrar;
						objCeldaTotal.setAttribute('class', 'movil b9');
						objCeldaTotal.innerHTML = intTotalMostrar;
						objCeldaAcciones.setAttribute('class', 'td-center movil b10');
						objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalles_requisiciones_refacciones_servicio(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_detalles_requisiciones_refacciones_servicio(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
						objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento; 
						objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeIva.innerHTML = intPorcentajeIva; 
						objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
						objCeldaMoneda.setAttribute('class', 'no-mostrar');
						objCeldaMoneda.innerHTML = strMoneda;
						objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
						objCeldaTipoCambio.innerHTML = intTipoCambio;
						objCeldaPrecioRefaccion.setAttribute('class', 'no-mostrar');
						objCeldaPrecioRefaccion.innerHTML = intPrecioRefaccion;
						objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
						objCeldaTasaCuotaIva.innerHTML = intTasaCuotaIva;
						objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
						objCeldaTasaCuotaIeps.innerHTML = intTasaCuotaIeps;
						objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
						objCeldaCodigoLinea.innerHTML =  strCodigoLinea;
						objCeldaPrecioUnitarioBD.setAttribute('class', 'no-mostrar');
						objCeldaPrecioUnitarioBD.innerHTML =  intPrecioUnitarioBD;
						objCeldaDescuentoUnitarioBD.setAttribute('class', 'no-mostrar');
						objCeldaDescuentoUnitarioBD.innerHTML =  intDescuentoUnitarioBD;
						objCeldaIvaUnitarioBD.setAttribute('class', 'no-mostrar');
						objCeldaIvaUnitarioBD.innerHTML =  intImporteIvaBD;
						objCeldaIepsUnitarioBD.setAttribute('class', 'no-mostrar');
						objCeldaIepsUnitarioBD.innerHTML =  intImporteIepsBD;
						objCeldaRenglon.setAttribute('class', 'no-mostrar');
						objCeldaRenglon.innerHTML =  0;
						objCeldaCostoActual.setAttribute('class', 'no-mostrar');
						objCeldaCostoActual.innerHTML =  intActualCosto;

					}

					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_detalles_requisiciones_refacciones_servicio();
					//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
					var intFilas = $("#dg_detalles_requisiciones_refacciones_servicio tr").length - 2;
					$('#numElementos_detalles_requisiciones_refacciones_servicio').html(intFilas);
					$('#txtNumDetalles_requisiciones_refacciones_servicio').val(intFilas);
					
					//Enfocar caja de texto
					$('#txtCodigo_detalles_requisiciones_refacciones_servicio').focus();
				}
				else
				{
					//Variable que se utiliza para asignar el mensaje informativo
	                var strMensaje = 'No es posible agregar la refacción porque ';

	                //Si el precio es menor o igual a cero
	                if(intSubtotal <= 0)
	                {
	                	//Concatenar mensaje de validación
	                	strMensaje += 'no tiene un precio establecido.';

	                	//Hacer un llamado a la función para mostrar mensaje de información
	                	mensaje_requisiciones_refacciones_servicio('informacion_refacciones', strMensaje);
	                }
	                else
	                {
	                	//Cambiar cantidad a formato moneda
		                intActualCostoConv = formatMoney(intActualCostoConv, 4, '');

		                //Concatenar mensaje de validación
		                strMensaje += 'el precio unitario (menos el descuento) no puede ser menor al costo actual: ';
		                strMensaje += intActualCostoConv;

		                //Limpiar contenido de la caja de text
		                $('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').val('');
	                	//Hacer un llamado a la función para mostrar mensaje de información
                   		 mensaje_requisiciones_refacciones_servicio('informacion_refacciones', strMensaje);		
	                }

				}
				
			}
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_requisiciones_refacciones_servicio(objRenglon)
		{
			//Variable que se utiliza para asignar el código de la refacción
			var strCodigo = objRenglon.parentNode.parentNode.cells[0].innerHTML;
			//Variable que se utiliza para asignar la descripción de la refacción
			var strDescripcion = objRenglon.parentNode.parentNode.cells[1].innerHTML;
			//Variable que se utiliza para concatenar los datos de la refacción 
			var strRefaccion = strCodigo+' - '+strDescripcion;

			//Asignar los valores a las cajas de texto
			$('#txtRefaccionID_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtRefaccion_detalles_requisiciones_refacciones_servicio').val(strRefaccion);
			$('#txtCodigo_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidad_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIva_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtPorcentajeIeps_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtMoneda_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtTipoCambio_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);
			$('#txtPrecioRefaccion_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[15].innerHTML);

			$('#txtTasaCuotaIva_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[16].innerHTML);
			$('#txtTasaCuotaIeps_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[17].innerHTML);

			$('#txtCodigoLinea_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[18].innerHTML);
			$('#txtActualCosto_detalles_requisiciones_refacciones_servicio').val(objRenglon.parentNode.parentNode.cells[24].innerHTML);

			//Dependiendo del estatus de la requisición enfocar caja de texto
			if($('#txtTipoReparacion_requisiciones_refacciones_servicio').val() == 'GARANTIA' &&
			   $('#txtEstatus_requisiciones_refacciones_servicio').val() != 'ACTIVO')
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').focus();
			}
			else
			{
				//Enfocar caja de texto
				$('#txtCodigo_detalles_requisiciones_refacciones_servicio').focus();
			}
			
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_requisiciones_refacciones_servicio(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_requisiciones_refacciones_servicio").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_requisiciones_refacciones_servicio();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_requisiciones_refacciones_servicio tr").length - 2;
			$('#numElementos_detalles_requisiciones_refacciones_servicio').html(intFilas);
			$('#txtNumDetalles_requisiciones_refacciones_servicio').val(intFilas);

			//Enfocar caja de texto
			$('#txtCodigo_detalles_requisiciones_refacciones_servicio').focus();
		}

		//Función para recalcular los importes de los detalles de la tabla 
		function recalcular_importes_detalles_requisiciones_refacciones_servicio()
		{
			//Variable que se utiliza para asignar el tipo de cambio de la requisición
			var intTipoCambioRequisicion = parseFloat($('#txtTipoCambio_requisiciones_refacciones_servicio').val());
			//Variable que se utiliza para asignar la moneda de la requisición
			var intMonedaIDRequisicion =  parseFloat($('#cmbMonedaID_requisiciones_refacciones_servicio').val());

			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_requisiciones_refacciones_servicio').getElementsByTagName('tbody')[0];

			//Verificamos que al menos exista un detalle agregado en el GRID de detalles
			if(objTabla.rows.length > 0){


				//Recorrer los renglones de la tabla para obtener los valores
				for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
				{
					//Variables que se utilizan para asignar valores del detalle
					var intSubtotal = 0;
					var intPrecioUnitario = 0;
					var intRefaccionID =  objRen.getAttribute('id');
					var intCantidad =  parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
					var intPorcentajeDescuento = parseFloat(objRen.cells[10].innerHTML);
					var intPorcentajeIva = parseFloat(objRen.cells[11].innerHTML);
					var intPorcentajeIeps = objRen.cells[12].innerHTML;
					var intTipoCambioRefaccion = parseFloat(objRen.cells[14].innerHTML);
					var intPrecioRefaccion = parseFloat(objRen.cells[15].innerHTML);
					//Variable que se utiliza para asignar el descuento unitario
					var intDescuentoUnitario = 0;
					//Variable que se utiliza para asignar el importe de iva
					var intImporteIva = 0;
					//Variable que se utiliza para asignar el importe de ieps
					var intImporteIeps = 0;
					//Variable que se utiliza para asignar el importe total
					var intTotal = 0;

					//Si existe precio de la refacción
				    if(intPrecioRefaccion > 0 && intTipoCambioRefaccion > 0)
				    {
			   	  	    //Convertir importe a peso mexicano
				      	intPrecioUnitario = intPrecioRefaccion * intTipoCambioRefaccion;

				       	//Si la moneda de la requisición no corresponde a peso mexicano
				        if(intMonedaIDRequisicion !== intMonedaBaseIDRequisicionesRefaccionesServicio )
				        {
				       		//Convertir peso mexicano a tipo de cambio
				       		intPrecioUnitario = intPrecioUnitario / intTipoCambioRequisicion;
				        }
				    }

				    //Asignar el precio unitario
				    intSubtotal = intPrecioUnitario;

					//Si existe porcentaje de descuento
					if(intPorcentajeDescuento > 0)
					{
						intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;
						//Redondear cantidad a decimales
						intDescuentoUnitario = intDescuentoUnitario.toFixed(intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio);

						//Decrementar descuento unitario
						intSubtotal = intSubtotal - intDescuentoUnitario;
						
					}
					

					//Calcular subtotal
					intSubtotal = intCantidad * intSubtotal;
					
					//Redondear cantidad a decimales
					intSubtotal = intSubtotal.toFixed(intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio);
					intSubtotal = parseFloat(intSubtotal);


					//Calcular importe de IVA
					intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
					
					//Redondear cantidad a dos decimales
				    intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaUnitBDRequisicionesRefaccionesServicio);
				    intImporteIva = parseFloat(intImporteIva);
					
					
					//Si existe porcentaje de IEPS
					if(intPorcentajeIeps != '')
					{
						//Calcular importe de IEPS
						intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
						//Redondear cantidad a dos decimales
				   	 	intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDRequisicionesRefaccionesServicio);
				   	 	intImporteIeps = parseFloat(intImporteIeps);
					}
					
					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;
					

				//Cambiar cantidad a  formato moneda (a visualizar)
				intCantidad =  formatMoney(intCantidad, 2, '');
				var intPrecioUnitarioMostrar =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio, '');
				
				var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio, '');
				
				var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio, '');
				
				var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarRequisicionesRefaccionesServicio, '');
				
				var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarRequisicionesRefaccionesServicio, '');
				
				var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarRequisicionesRefaccionesServicio, '');
				
				intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio, '');

				//Cambiar cantidad a  formato moneda (a guardar en la  BD)
				var intPrecioUnitarioBD =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio, '');
				
				var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio, '');
				
				var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDRequisicionesRefaccionesServicio, '');
				
				var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDRequisicionesRefaccionesServicio, '');

					//Revisamos si existe el ID proporcionado, si es así, editamos los datos
					objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML =  intCantidad;
					objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML =  intPrecioUnitarioMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML =  intDescuentoUnitarioMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[5].innerHTML =  intSubtotalMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[6].innerHTML =  intImporteIvaMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[7].innerHTML =  intImporteIepsMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[8].innerHTML =  intTotalMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[19].innerHTML = intPrecioUnitarioBD;
					objTabla.rows.namedItem(intRefaccionID).cells[20].innerHTML = intDescuentoUnitarioBD;
					objTabla.rows.namedItem(intRefaccionID).cells[21].innerHTML = intImporteIvaBD;
					objTabla.rows.namedItem(intRefaccionID).cells[22].innerHTML = intImporteIepsBD;
				}

				//Hacer un llamado a la función para calcular totales de la tabla
			    calcular_totales_detalles_requisiciones_refacciones_servicio();
			}
	
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_requisiciones_refacciones_servicio()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_requisiciones_refacciones_servicio').getElementsByTagName('tbody')[0];

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
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, intNumDecimalesDescUnitBDRequisicionesRefaccionesServicio, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesPrecioUnitBDRequisicionesRefaccionesServicio, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, intNumDecimalesMostrarRequisicionesRefaccionesServicio, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, intNumDecimalesMostrarRequisicionesRefaccionesServicio, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, intNumDecimalesMostrarRequisicionesRefaccionesServicio, '');

			//Asignar los valores
			$('#acumCantidad_detalles_requisiciones_refacciones_servicio').html(intAcumUnidades);
			$('#acumDescuento_detalles_requisiciones_refacciones_servicio').html(intAcumDescuento);
			$('#acumSubtotal_detalles_requisiciones_refacciones_servicio').html(intAcumSubtotal);
			$('#acumIva_detalles_requisiciones_refacciones_servicio').html(intAcumIva);
			$('#acumIeps_detalles_requisiciones_refacciones_servicio').html(intAcumIeps);
			$('#acumTotal_detalles_requisiciones_refacciones_servicio').html(intAcumTotal);
		}

		//Función para calcular el precio unitario del detalle
		function calcular_precio_unitario_detalles_requisiciones_refacciones_servicio()
		{
		   //Variable que se utiliza para asignar el tipo de cambio de la requisición
		   var intTipoCambioRequisicion = parseFloat($("#txtTipoCambio_requisiciones_refacciones_servicio").val());
		   //Variable que se utiliza para asignar la moneda de la refacción
		   var intMonedaIDRequisicion =  parseFloat($("#cmbMonedaID_requisiciones_refacciones_servicio").val());
		   //Variable que se utiliza para asignar el tipo de cambio de la refacción
		   var intTipoCambioRefaccion = parseFloat($.reemplazar($("#txtTipoCambio_detalles_requisiciones_refacciones_servicio").val(), ",", ""));
		   //Variable que se utiliza para asignar el precio de la refacción
		   var intPrecioRefaccion = parseFloat($.reemplazar($("#txtPrecioRefaccion_detalles_requisiciones_refacciones_servicio").val(), ",", ""));

		   //Variable que se utiliza para asignar el precio unitario
		   var intPrecioUnitario = 0;

		   //Si existe precio de la refacción
		   if(intPrecioRefaccion > 0 && intTipoCambioRefaccion > 0)
		   {
	   	  	    //Convertir importe a peso mexicano
		      	intPrecioUnitario = intPrecioRefaccion * intTipoCambioRefaccion;

		       	//Si la moneda de la requisición no corresponde a peso mexicano
		        if(intMonedaIDRequisicion !== intMonedaBaseIDRequisicionesRefaccionesServicio)
		        {
		       		//Convertir peso mexicano a tipo de cambio
		       		intPrecioUnitario = intPrecioRefaccion / intTipoCambioRequisicion;
		        }
		   }
		 	
		   //Cambiar el precio unitario del detalle
		   $("#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio").val(intPrecioUnitario);
       	    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
           $('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').formatCurrency({ roundToDecimalPlace: 2 });
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_requisiciones_refacciones_servicio').numeric();
			$('#txtTipoCambio_detalles_requisiciones_refacciones_servicio').numeric();
			$('#txtCantidad_detalles_requisiciones_refacciones_servicio').numeric();
			$('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').numeric();
        	$('#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_requisiciones_refacciones_servicio').blur(function(){
                $('.tipo-cambio_requisiciones_refacciones_servicio').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_requisiciones_refacciones_servicio').blur(function(){
                $('.cantidad_requisiciones_refacciones_servicio').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_requisiciones_refacciones_servicio').datetimepicker({format: 'DD/MM/YYYY'});

			//Regresar el tipo de cambio de la moneda cuando cambie la fecha
			$('#dteFecha_requisiciones_refacciones_servicio').on('dp.change', function (e) {
				//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_requisiciones_refacciones_servicio();
			});


			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_requisiciones_refacciones_servicio').change(function(e){  
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
	          	if(parseInt($('#cmbMonedaID_requisiciones_refacciones_servicio').val()) === intMonedaBaseIDRequisicionesRefaccionesServicio)
	         	{
	         		//Deshabilitar caja de texto
					$("#txtTipoCambio_requisiciones_refacciones_servicio").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_requisiciones_refacciones_servicio').val(intTipoCambioMonedaBaseRequisicionesRefaccionesServicio);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_requisiciones_refacciones_servicio').formatCurrency({ roundToDecimalPlace: 4 });
					//Hacer un llamado a la función para recalcular los importes
			  		recalcular_importes_detalles_requisiciones_refacciones_servicio();
			  		//Hacer un llamado a la función para calcular el precio unitario
			  		calcular_precio_unitario_detalles_requisiciones_refacciones_servicio();

	         	}
	         	else
	         	{
	         		//Habilitar caja de texto
					$("#txtTipoCambio_requisiciones_refacciones_servicio").removeAttr('disabled');
	         		//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_requisiciones_refacciones_servicio').val('');  
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_requisiciones_refacciones_servicio();

	         	}

	         	//Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
				habilitar_elementos_tipo_cambios_detalles_requisiciones_refacciones_servicio('#cmbMonedaID_requisiciones_refacciones_servicio');

				
	        });
			
			//Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_requisiciones_refacciones_servicio').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_requisiciones_refacciones_servicio').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoRequisicionesRefaccionesServicio)
	        	{
	        		$('#txtTipoCambio_requisiciones_refacciones_servicio').val(intTipoCambioMaximoRequisicionesRefaccionesServicio);
	        	}

	        	//Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
				habilitar_elementos_tipo_cambios_detalles_requisiciones_refacciones_servicio('#txtTipoCambio_requisiciones_refacciones_servicio');

				//Hacer un llamado a la función para recalcular los importes
			  	recalcular_importes_detalles_requisiciones_refacciones_servicio();
				//Hacer un llamado a la función para calcular el precio unitario
			  	calcular_precio_unitario_detalles_requisiciones_refacciones_servicio();

		    });

		     //Calcular el precio unitario cuando cambie el contenido de la caja de texto
	        $('#txtTipoCambio_requisiciones_refacciones_servicio').change(function() {
			  	 //Hacer un llamado a la función para recalcular los importes
			  	 recalcular_importes_detalles_requisiciones_refacciones_servicio();
			  	 //Hacer un llamado a la función para calcular el precio unitario
			  	 calcular_precio_unitario_detalles_requisiciones_refacciones_servicio();
			});

	        //Autocomplete para recuperar los datos de una orden de reparación interna 
	        $('#txtOrdenReparacion_requisiciones_refacciones_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtOrdenReparacionID_requisiciones_refacciones_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos de la orden de reparación
	               inicializar_orden_reparacion_requisiciones_refacciones_servicio();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/ordenes_reparacion/autocomplete",
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
	              //Asignar valores del registro seleccionado
	              $('#txtOrdenReparacionID_requisiciones_refacciones_servicio').val(ui.item.data);
	              $('#txtProspecto_requisiciones_refacciones_servicio').val(ui.item.prospecto);
	              $('#txtServicioListaPrecioID_requisiciones_refacciones_servicio').val(ui.item.servicio_lista_precio_id);
	              $('#txtTipoReparacion_requisiciones_refacciones_servicio').val(ui.item.tipo_reparacion);
	              //Hacer un llamado a la función para habilitar/deshabilitar el precio unitario de la refacción
				  habilitar_precio_unitario_detalles_requisiciones_refacciones_servicio();
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
	        $('#txtOrdenReparacion_requisiciones_refacciones_servicio').focusout(function(e){
	            //Si no existe id de la orden de reparación interna
	            if($('#txtOrdenReparacionID_requisiciones_refacciones_servicio').val() == '' ||
	               $('#txtOrdenReparacion_requisiciones_refacciones_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtOrdenReparacionID_requisiciones_refacciones_servicio').val('');
	               $('#txtOrdenReparacion_requisiciones_refacciones_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos de la orden de reparación
	               inicializar_orden_reparacion_requisiciones_refacciones_servicio();
	            }

	        });
	     

	        //Autocomplete para recuperar los datos de una refacción
	        $('#txtRefaccion_detalles_requisiciones_refacciones_servicio').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtRefaccionID_detalles_requisiciones_refacciones_servicio').val('');
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
	                $('#txtRefaccionID_detalles_requisiciones_refacciones_servicio').val(ui.item.data);
	                //Hacer un llamado a la función para regresar los datos de la refacción
	               	get_datos_refaccion_detalles_requisiciones_refacciones_servicio();
	               	//Asignar el código de la refacción
	               	$('#txtCodigo_detalles_requisiciones_refacciones_servicio').val(ui.item.value.split(" - ")[0]);
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
	        $('#txtRefaccion_detalles_requisiciones_refacciones_servicio').focusout(function(e){
	            //Si no existe id de la refacción
	            if($('#txtRefaccionID_detalles_requisiciones_refacciones_servicio').val() == '' ||
	               $('#txtRefaccion_detalles_requisiciones_refacciones_servicio').val() == '')
	            { 
	               	//Hacer un llamado a la función para inicializar elementos de la refacción
	              	inicializar_refaccion_detalles_requisiciones_refacciones_servicio();
	            }

	        });

			//Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_detalles_requisiciones_refacciones_servicio').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_detalles_requisiciones_refacciones_servicio').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoRequisicionesRefaccionesServicio)
	        	{
	        		$('#txtTipoCambio_detalles_requisiciones_refacciones_servicio').val(intTipoCambioMaximoRequisicionesRefaccionesServicio);
	        	}

	        	//Hacer un llamado a la función para calcular el precio unitario
	            calcular_precio_unitario_detalles_requisiciones_refacciones_servicio();

		    });

	      	
	      	//Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });


	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_requisiciones_refacciones_servicio').on('click','button.btn',function(){
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
			$('#txtRefaccion_detalles_requisiciones_refacciones_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
			   	    //Si no existe refacción
		            if($('#txtRefaccionID_detalles_requisiciones_refacciones_servicio').val() == '' || $('#txtRefaccion_detalles_requisiciones_refacciones_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtRefaccion_detalles_requisiciones_refacciones_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtCantidad_detalles_requisiciones_refacciones_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_requisiciones_refacciones_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_requisiciones_refacciones_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_requisiciones_refacciones_servicio').focus();
			   	    }
			   	    else
			   	    {	
			   	    	//Dependiendo del tipo de reparación enfocar caja de texto
			   	    	if($('#txtTipoReparacion_requisiciones_refacciones_servicio').val() == 'GARANTIA')
			   	    	{
			   	    		//Enfocar caja de texto
					    	$('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').focus();
			   	    	}
			   	    	else
			   	    	{
			   	    		//Enfocar caja de texto
					  		$('#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio').focus();
			   	    	}	
			   	   		
			   	    }
		        }
		    });

			//Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPrecioUnitario_detalles_requisiciones_refacciones_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_requisiciones_refacciones_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_detalles_requisiciones_refacciones_servicio();
			   	    }
		        }
		    });

			

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_requisiciones_refacciones_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_requisiciones_refacciones_servicio').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_requisiciones_refacciones_servicio').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_requisiciones_refacciones_servicio').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_requisiciones_refacciones_servicio').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_requisiciones_refacciones_servicio').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un prospecto o cliente 
	        $('#txtProspectoBusq_requisiciones_refacciones_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_requisiciones_refacciones_servicio').val('');
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
	             $('#txtProspectoIDBusq_requisiciones_refacciones_servicio').val(ui.item.data);
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
	        $('#txtProspectoBusq_requisiciones_refacciones_servicio').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoIDBusq_requisiciones_refacciones_servicio').val() == '' ||
	               $('#txtProspectoBusq_requisiciones_refacciones_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_requisiciones_refacciones_servicio').val('');
	               $('#txtProspectoBusq_requisiciones_refacciones_servicio').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_requisiciones_refacciones_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaRequisicionesRefaccionesServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_requisiciones_refacciones_servicio();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_requisiciones_refacciones_servicio').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_requisiciones_refacciones_servicio();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_requisiciones_refacciones_servicio').addClass("estatus-NUEVO");
				//Abrir modal
				 objRequisicionesRefaccionesServicio = $('#RequisicionesRefaccionesServicioBox').bPopup({
												   appendTo: '#RequisicionesRefaccionesServicioContent', 
					                               contentContainer: 'RequisicionesRefaccionesServicioM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_requisiciones_refacciones_servicio').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_requisiciones_refacciones_servicio').focus();

			//Deshabilitar los siguientes botones (funciones de permisos de acceso)
			$('#btnNuevo_requisiciones_refacciones_servicio').attr('disabled','-1');  
			$('#btnImprimir_requisiciones_refacciones_servicio').attr('disabled','-1');
			$('#btnDescargarXLS_requisiciones_refacciones_servicio').attr('disabled','-1');
			$('#btnBuscar_requisiciones_refacciones_servicio').attr('disabled','-1');
			$('#btnGuardar_requisiciones_refacciones_servicio').attr('disabled','-1');
			$('#btnImprimirRegistro_requisiciones_refacciones_servicio').attr('disabled','-1');
			$('#btnDesactivar_requisiciones_refacciones_servicio').attr('disabled','-1');
			$('#btnRestaurar_requisiciones_refacciones_servicio').attr('disabled','-1'); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_requisiciones_refacciones_servicio();
			//Hacer un llamado a la función para cargar monedas en el combobox (requisición) del modal
            cargar_monedas_requisiciones_refacciones_servicio();
		});
	</script>