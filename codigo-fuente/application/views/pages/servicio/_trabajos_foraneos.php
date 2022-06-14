
	<div id="TrabajosForaneosServicioContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_trabajos_foraneos_servicio" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_trabajos_foraneos_servicio">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_trabajos_foraneos_servicio'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_trabajos_foraneos_servicio"
				                    		name= "strFechaInicialBusq_trabajos_foraneos_servicio" 
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
								<label for="txtFechaFinalBusq_trabajos_foraneos_servicio">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_trabajos_foraneos_servicio'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_trabajos_foraneos_servicio"
				                    		name= "strFechaFinalBusq_trabajos_foraneos_servicio" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los proveedores activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
								<input id="txtProveedorIDBusq_trabajos_foraneos_servicio" 
									   name="intProveedorIDBusq_trabajos_foraneos_servicio"  
									   type="hidden" value="">
								</input>
								<label for="txtProveedorBusq_trabajos_foraneos_servicio">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProveedorBusq_trabajos_foraneos_servicio" 
										name="strProveedorBusq_trabajos_foraneos_servicio" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_trabajos_foraneos_servicio">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_trabajos_foraneos_servicio" 
								 		name="strEstatusBusq_trabajos_foraneos_servicio" tabindex="1">
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
								<label for="txtBusqueda_trabajos_foraneos_servicio">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_trabajos_foraneos_servicio" 
										name="strBusqueda_trabajos_foraneos_servicio" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_trabajos_foraneos_servicio" 
									   	name="strImprimirDetalles_trabajos_foraneos_servicio" 
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
							<button class="btn btn-primary" id="btnBuscar_trabajos_foraneos_servicio"
									onclick="paginacion_trabajos_foraneos_servicio();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_trabajos_foraneos_servicio" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_trabajos_foraneos_servicio"
									onclick="reporte_trabajos_foraneos_servicio('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_trabajos_foraneos_servicio"
									onclick="reporte_trabajos_foraneos_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla trabajos foráneos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Proveedor"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "No. de orden"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Orden de compra"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles del trabajo foráneo
				*/
				td.movil.b1:nth-of-type(1):before {content: "Concepto"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Costo Unit."; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles del trabajo foráneo
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.t6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.t7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.t8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_trabajos_foraneos_servicio">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Proveedor</th>
							<th class="movil">No. de orden</th>
							<th class="movil">Orden de compra</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_trabajos_foraneos_servicio" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{proveedor}}</td>
							<td class="movil a4">{{folio_orden_reparacion}}</td>
							<td class="movil a5">{{folio_orden_compra}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_trabajos_foraneos_servicio({{trabajo_foraneo_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_trabajos_foraneos_servicio({{trabajo_foraneo_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_trabajos_foraneos_servicio({{trabajo_foraneo_id}});"  title="Imprimir registro en PDF"><span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_trabajos_foraneos_servicio({{trabajo_foraneo_id}}, 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_trabajos_foraneos_servicio({{trabajo_foraneo_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_trabajos_foraneos_servicio"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_trabajos_foraneos_servicio">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_trabajos_foraneos_servicio" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 	

		<!-- Diseño del modal-->
		<div id="TrabajosForaneosServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_trabajos_foraneos_servicio"  class="ModalBodyTitle">
			<h1>Trabajos Foráneos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmTrabajosForaneosServicio" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmTrabajosForaneosServicio"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!-- Folio -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtTrabajoForaneoID_trabajos_foraneos_servicio" 
										   name="intTrabajoForaneoID_trabajos_foraneos_servicio" 
										   type="hidden" value="" />
								    <!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
								    <input id="txtEstatus_trabajos_foraneos_servicio" 
											name="strEstatus_trabajos_foraneos_servicio" type="hidden" value="" />
								    <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_trabajos_foraneos_servicio" 
										   name="intPolizaID_trabajos_foraneos_servicio" type="hidden" value="" />
								     <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
									<input id="txtFolioPoliza_trabajos_foraneos_servicio" 
										   name="strFolioPoliza_trabajos_foraneos_servicio" type="hidden" value="" />
									<label for="txtFolio_trabajos_foraneos_servicio">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_trabajos_foraneos_servicio" 
											name="strFolio_trabajos_foraneos_servicio" 
											type="text" value="" placeholder="Autogenerado" disabled />
								</div>
							</div>
						</div>
						<!-- Fecha -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_trabajos_foraneos_servicio">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_trabajos_foraneos_servicio'>
					                    <input class="form-control" 
					                    		id="txtFecha_trabajos_foraneos_servicio"
					                    		name= "strFecha_trabajos_foraneos_servicio" 
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
									<input id="txtMonedaID_trabajos_foraneos_servicio" 
										   name="intMonedaID_trabajos_foraneos_servicio"  
										   type="hidden"  value="">
									</input>
									<label for="txtMoneda_trabajos_foraneos_servicio">Moneda</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMoneda_trabajos_foraneos_servicio" 
											name="strMoneda_trabajos_foraneos_servicio" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_trabajos_foraneos_servicio">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTipoCambio_trabajos_foraneos_servicio" 
											name="intTipoCambio_trabajos_foraneos_servicio" 
											type="text" value="" disabled/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene las ordenes de reparación activas-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de reparación seleccionada-->
									<input id="txtOrdenReparacionID_trabajos_foraneos_servicio" 
										   name="intOrdenReparacionID_trabajos_foraneos_servicio"  type="hidden" 
										   value="">
									</input>
									<label for="txtOrdenReparacion_trabajos_foraneos_servicio">No. de orden</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtOrdenReparacion_trabajos_foraneos_servicio" 
											name="strOrdenReparacion_trabajos_foraneos_servicio" type="text" value="" tabindex="1" placeholder="Ingrese orden" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Cliente-->
						<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtProspecto_trabajos_foraneos_servicio">Cliente</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProspecto_trabajos_foraneos_servicio" 
											name="strProspecto_trabajos_foraneos_servicio" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
					</div>	
					<div class="row">
						<!--Autocomplete que contiene las ordenes de compra autorizadas-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de compra seleccionada-->
									<input id="txtOrdenCompraID_trabajos_foraneos_servicio" 
										   name="intOrdenCompraID_trabajos_foraneos_servicio"  
										   type="hidden"  value="">
									</input>
									<label for="txtOrdenCompra_trabajos_foraneos_servicio">Orden de compra</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtOrdenCompra_trabajos_foraneos_servicio" 
											name="strOrdenCompra_trabajos_foraneos_servicio" 
											type="text" value="" tabindex="1" placeholder="Ingrese orden" maxlength="250" />
								</div>
							</div>	
						</div>
						<!--Proveedor-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtProveedor_trabajos_foraneos_servicio">Proveedor</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtProveedor_trabajos_foraneos_servicio" 
											name="strProveedor_trabajos_foraneos_servicio" 
											type="text" value=""/>
								</div>
							</div>
						</div>
						<!-- Factura -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFactura_trabajos_foraneos_servicio">Factura</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtFactura_trabajos_foraneos_servicio" 
											name="strFactura_trabajos_foraneos_servicio" 
											type="text" value="" tabindex="1" placeholder="Ingrese factura" maxlength="10" />
								</div>
							</div>	
						</div>
						<!--Total de unidades-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTotalUnidades_trabajos_foraneos_servicio">Total de unidades</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control cantidad_trabajos_foraneos_servicio" id="txtTotalUnidades_trabajos_foraneos_servicio" 
											name="intTotalUnidades_trabajos_foraneos_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese total de unidades" maxlength="21">
									</input>
								</div>
							</div>
						</div>
						<!--Total-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteTotal_trabajos_foraneos_servicio">Importe total</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_trabajos_foraneos_servicio" id="txtImporteTotal_trabajos_foraneos_servicio" 
												name="intImporteTotal_trabajos_foraneos_servicio" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23">
										</input>
										
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
									<label for="txtObservaciones_trabajos_foraneos_servicio">Observaciones</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtObservaciones_trabajos_foraneos_servicio" 
											name="strObservaciones_trabajos_foraneos_servicio" 
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
									<input id="txtNumDetalles_trabajos_foraneos_servicio" 
										   name="intNumDetalles_trabajos_foraneos_servicio" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles del trabajo foráneo</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Concepto-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el renglón del registro-->
																<input id="txtRenglon_detalles_trabajos_foraneos_servicio" 
																	   name="intRenglon_detalles_trabajos_foraneos_servicio" 
																	   type="hidden" value="">
																</input>

																<label for="txtConcepto_detalles_trabajos_foraneos_servicio">
																	Concepto
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtConcepto_detalles_trabajos_foraneos_servicio" 
																		name="strConcepto_detalles_trabajos_foraneos_servicio" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
											    	<!--Autocomplete que contiene los productos y servicios activos-->
													<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id del producto/servicio seleccionado-->
																<input id="txtProductoServicioID_detalles_trabajos_foraneos_servicio" 
																	   name="intProductoServicioID_detalles_trabajos_foraneos_servicio"  
																	   type="hidden" value="">
															    </input>
																<label for="txtProductoServicio_detalles_trabajos_foraneos_servicio">Código SAT</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtProductoServicio_detalles_trabajos_foraneos_servicio" 
																		name="strProductoServicio_detalles_trabajos_foraneos_servicio" type="text" 
																		value="" tabindex="1" placeholder="Ingrese código SAT" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Autocomplete que contiene las unidades activas-->
													<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id de la unidad seleccionada-->
																<input id="txtUnidadID_detalles_trabajos_foraneos_servicio" 
																	   name="intUnidadID_detalles_trabajos_foraneos_servicio"  
																	   type="hidden" value="">
															    </input>
																<label for="txtUnidad_detalles_trabajos_foraneos_servicio">Unidad SAT</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtUnidad_detalles_trabajos_foraneos_servicio" 
																		name="strUnidad_detalles_trabajos_foraneos_servicio" type="text" 
																		value="" tabindex="1" placeholder="Ingrese unidad SAT" maxlength="250">
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
																<label for="txtCantidad_detalles_trabajos_foraneos_servicio">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_trabajos_foraneos_servicio" 
																		id="txtCantidad_detalles_trabajos_foraneos_servicio" 
																		name="intCantidad_detalles_trabajos_foraneos_servicio" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="14" />
															</div>
														</div>
													</div>
													<!--Costo unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCostoUnitario_detalles_trabajos_foraneos_servicio">Costo unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCostoUnitario_detalles_trabajos_foraneos_servicio" 
																		name="intCostoUnitario_detalles_trabajos_foraneos_servicio" 
																		type="text" value="" disabled/>
															</div>
														</div>
													</div>
													 <!--Costo real-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCostoUnitarioReal_detalles_trabajos_foraneos_servicio">Costo - Desc.</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCostoUnitarioReal_detalles_trabajos_foraneos_servicio" 
																		name="intCostoUnitarioReal_detalles_trabajos_foraneos_servicio" 
																		type="text" value="" disabled />
															</div>
														</div>
													</div>
												   <!--Porcentaje de ganancia-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el descuento unitario-->
																<input id="txtDescuentoUnitario_detalles_trabajos_foraneos_servicio" 
																	   name="intDescuentoUnitario_detalles_trabajos_foraneos_servicio"  
																	   type="hidden" value="">
															    </input>
																<!-- Caja de texto oculta que se utiliza para recuperar el porcentaje del impuesto de IVA-->
																<input id="txtPorcentajeIva_detalles_trabajos_foraneos_servicio" 
																	   name="intPorcentajeIva_detalles_trabajos_foraneos_servicio"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta para recuperar el IVA unitario-->
																<input id="txtIvaUnitario_detalles_trabajos_foraneos_servicio" 
																	   name="intIvaUnitario_detalles_trabajos_foraneos_servicio" 
																	   type="hidden" value="">
																</input>
															   	<!-- Caja de texto oculta que se utiliza para recuperar el porcentaje del impuesto de IEPS-->
																<input id="txtPorcentajeIeps_detalles_trabajos_foraneos_servicio" 
																	   name="intPorcentajeIeps_detalles_trabajos_foraneos_servicio"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta para recuperar el tipo de la tasa o cuota del impuesto de IEPS-->
																<input id="txtTipoTasaCuotaIeps_detalles_trabajos_foraneos_servicio" 
																	   name="strTipoTasaCuotaIeps_detalles_trabajos_foraneos_servicio" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el factor de la tasa o cuota del impuesto de IEPS-->
																<input id="txtFactorTasaCuotaIeps_detalles_trabajos_foraneos_servicio" 
																	   name="strFactorTasaCuotaIeps_detalles_trabajos_foraneos_servicio" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el IEPS unitario-->
																<input id="txtIepsUnitario_detalles_trabajos_foraneos_servicio" 
																	   name="intIepsUnitario_detalles_trabajos_foraneos_servicio" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio">
																	Ganancia %
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control porcentaje_trabajos_foraneos_servicio" 
																		id="txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio" 
																		name="intPorcentajeGanancia_detalles_trabajos_foraneos_servicio" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese ganancia" maxlength="14" />
															</div>
														</div>
													</div>
													<!--Precio unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPrecioUnitario_detalles_trabajos_foraneos_servicio">Precio unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtPrecioUnitario_detalles_trabajos_foraneos_servicio" 
																		name="intPrecioUnitario_detalles_trabajos_foraneos_servicio" 
																		type="text" value="" disabled />
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_detalles_trabajos_foraneos_servicio"
					                                			onclick="agregar_renglon_detalles_trabajos_foraneos_servicio();" 
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
													<table class="table-hover movil" id="dg_detalles_trabajos_foraneos_servicio">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Concepto</th>
																<th class="movil">Cantidad</th>
																<th class="movil">Costo Unit.</th>
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
																<td  class="movil t2">
																	<strong id="acumCantidad_detalles_trabajos_foraneos_servicio"></strong>
																</td>
																<td class="movil t3"></td>
																<td class="movil t4">
																	<strong id="acumDescuento_detalles_trabajos_foraneos_servicio"></strong>
																</td>
																<td class="movil t5">
																	<strong id="acumSubtotal_detalles_trabajos_foraneos_servicio"></strong>
																</td>
																<td class="movil t6">
																	<strong id="acumIva_detalles_trabajos_foraneos_servicio"></strong>
																</td>
																<td class="movil t7">
																	<strong  id="acumIeps_detalles_trabajos_foraneos_servicio"></strong>
																</td>
																<td class="movil t8">
																	<strong id="acumTotal_detalles_trabajos_foraneos_servicio"></strong>
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
																<strong id="numElementos_detalles_trabajos_foraneos_servicio">0</strong> encontrados
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
					<div id="divCirculoBarProgreso_trabajos_foraneos_servicio" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_trabajos_foraneos_servicio"  
									onclick="validar_trabajos_foraneos_servicio();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_trabajos_foraneos_servicio"  
									onclick="reporte_registro_trabajos_foraneos_servicio('');"  
									title="Imprimir" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_trabajos_foraneos_servicio"  
									onclick="cambiar_estatus_trabajos_foraneos_servicio('', '', '');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_trabajos_foraneos_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_trabajos_foraneos_servicio();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#TrabajosForaneosServicioContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaTrabajosForaneosServicio = 0;
		var strUltimaBusquedaTrabajosForaneosServicio = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
		var strTipoReferenciaTrabajosForaneosServicio = "TRABAJO FORANEO";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
		var intNumDecimalesMostrarTrabajosForaneosServicio = <?php echo NUM_DECIMALES_MOSTRAR_SERVICIO ?>;
		//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
		var intNumDecimalesCantidadBDTrabajosForaneosServicio = <?php echo NUM_DECIMALES_CANTIDAD_TF_SERVICIO ?>;
		var intNumDecimalesCostoUnitBDTrabajosForaneosServicio = <?php echo NUM_DECIMALES_COSTO_UNIT_TF_SERVICIO ?>;
		var intNumDecimalesDescUnitBDTrabajosForaneosServicio = <?php echo NUM_DECIMALES_DESCUENTO_UNIT_TF_SERVICIO ?>;
		var intNumDecimalesIvaUnitBDTrabajosForaneosServicio = <?php echo NUM_DECIMALES_IVA_UNIT_TF_SERVICIO ?>;
		var intNumDecimalesIepsUnitBDTrabajosForaneosServicio = <?php echo NUM_DECIMALES_IEPS_UNIT_TF_SERVICIO ?>;
		var intNumDecimalesPrecioUnitBDTrabajosForaneosServicio = <?php echo NUM_DECIMALES_PRECIO_UNIT_TF_SERVICIO ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objTrabajosForaneosServicio = null;

		
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_trabajos_foraneos_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/trabajos_foraneos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_trabajos_foraneos_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosTrabajosForaneosServicio = data.row;
					//Separar la cadena 
					var arrPermisosTrabajosForaneosServicio = strPermisosTrabajosForaneosServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosTrabajosForaneosServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosTrabajosForaneosServicio[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_trabajos_foraneos_servicio').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosTrabajosForaneosServicio[i]=='GUARDAR') || (arrPermisosTrabajosForaneosServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_trabajos_foraneos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosTrabajosForaneosServicio[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_trabajos_foraneos_servicio').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_trabajos_foraneos_servicio();
						}
						else if(arrPermisosTrabajosForaneosServicio[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_trabajos_foraneos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosTrabajosForaneosServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_trabajos_foraneos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosTrabajosForaneosServicio[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_trabajos_foraneos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosTrabajosForaneosServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_trabajos_foraneos_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_trabajos_foraneos_servicio() 
		{
		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaTrabajosForaneosServicio =($('#txtFechaInicialBusq_trabajos_foraneos_servicio').val()+$('#txtFechaFinalBusq_trabajos_foraneos_servicio').val()+$('#txtProveedorIDBusq_trabajos_foraneos_servicio').val()+$('#cmbEstatusBusq_trabajos_foraneos_servicio').val()+$('#txtBusqueda_trabajos_foraneos_servicio').val());

			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaTrabajosForaneosServicio != strUltimaBusquedaTrabajosForaneosServicio)
			{
				intPaginaTrabajosForaneosServicio = 0;
				strUltimaBusquedaTrabajosForaneosServicio = strNuevaBusquedaTrabajosForaneosServicio;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/trabajos_foraneos/get_paginacion',
					{ //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					  dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_trabajos_foraneos_servicio').val()),
					  dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_trabajos_foraneos_servicio').val()),
					  intProveedorID: $('#txtProveedorIDBusq_trabajos_foraneos_servicio').val(),
					  strEstatus: $('#cmbEstatusBusq_trabajos_foraneos_servicio').val(),
					  strBusqueda: $('#txtBusqueda_trabajos_foraneos_servicio').val(),
					  intPagina: intPaginaTrabajosForaneosServicio,
					  strPermisosAcceso: $('#txtAcciones_trabajos_foraneos_servicio').val()
					},
					function(data){
						$('#dg_trabajos_foraneos_servicio tbody').empty();
						var tmpTrabajosForaneosServicio = Mustache.render($('#plantilla_trabajos_foraneos_servicio').html(),data);
						$('#dg_trabajos_foraneos_servicio tbody').html(tmpTrabajosForaneosServicio);
						$('#pagLinks_trabajos_foraneos_servicio').html(data.paginacion);
						$('#numElementos_trabajos_foraneos_servicio').html(data.total_rows);
						intPaginaTrabajosForaneosServicio = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_trabajos_foraneos_servicio(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/trabajos_foraneos/';

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
			if ($('#chbImprimirDetalles_trabajos_foraneos_servicio').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_trabajos_foraneos_servicio').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_trabajos_foraneos_servicio').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_trabajos_foraneos_servicio').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_trabajos_foraneos_servicio').val()),
										'intProveedorID': $('#txtProveedorIDBusq_trabajos_foraneos_servicio').val(),
										'strEstatus': $('#cmbEstatusBusq_trabajos_foraneos_servicio').val(), 
										'strBusqueda': $('#txtBusqueda_trabajos_foraneos_servicio').val(),
										'strDetalles': $('#chbImprimirDetalles_trabajos_foraneos_servicio').val()				
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_trabajos_foraneos_servicio(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtTrabajoForaneoID_trabajos_foraneos_servicio').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'servicio/trabajos_foraneos/get_reporte_registro',
							'data' : {
										'intTrabajoForaneoID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_trabajos_foraneos_servicio()
		{
			//Incializar formulario
			$('#frmTrabajosForaneosServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_trabajos_foraneos_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmTrabajosForaneosServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_trabajos_foraneos_servicio();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_trabajos_foraneos_servicio');
			//Habilitar todos los elementos del formulario
			$('#frmTrabajosForaneosServicio').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_trabajos_foraneos_servicio').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto			
			var arrCajasTexto  = {
									//Son los id de los input que se van a deshabilitar
									rows: [	'#txtFolio_trabajos_foraneos_servicio',
											'#txtMoneda_trabajos_foraneos_servicio',	
											'#txtTipoCambio_trabajos_foraneos_servicio',	
											'#txtProspecto_trabajos_foraneos_servicio',
											'#txtProveedor_trabajos_foraneos_servicio',
											'#txtConcepto_detalles_trabajos_foraneos_servicio',
											'#txtProductoServicio_detalles_trabajos_foraneos_servicio',
											'#txtUnidad_detalles_trabajos_foraneos_servicio',
											'#txtCantidad_detalles_trabajos_foraneos_servicio',
											'#txtCostoUnitario_detalles_trabajos_foraneos_servicio',
											'#txtCostoUnitarioReal_detalles_trabajos_foraneos_servicio',
											'#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio',
											'#txtPrecioUnitario_detalles_trabajos_foraneos_servicio'
										],
									//Es asignar un attributo disbaled|checked
									attribute: 'disabled',
									//Bool es para deshabilitar
									bool: true
								};
			//Hacer un llamado a la función para deshabilitar cajas de texto		
			$.habilitar_deshabilitar_campos(arrCajasTexto);
 			//Mostrar los siguientes botones
			$("#btnGuardar_trabajos_foraneos_servicio").show();
			//Habilitar botón Agregar
			$('#btnAgregar_detalles_trabajos_foraneos_servicio').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_trabajos_foraneos_servicio").hide();
			$("#btnDesactivar_trabajos_foraneos_servicio").hide();
		}

		
		//Función para inicializar elementos de la orden de compra
		function inicializar_orden_compra_trabajos_foraneos_servicio()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtMonedaID_trabajos_foraneos_servicio').val('');
			$('#txtMoneda_trabajos_foraneos_servicio').val('');
			$('#txtTipoCambio_trabajos_foraneos_servicio').val('');
            $('#txtProveedor_trabajos_foraneos_servicio').val('');
            $('#txtFactura_trabajos_foraneos_servicio').val('');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_trabajos_foraneos_servicio();
		}
																	

		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_trabajos_foraneos_servicio()
		{
			//Hacer un llamado a la función para inicializar elementos del concepto (detalle)
			inicializar_concepto_detalles_trabajos_foraneos_servicio();

			//Eliminar los datos de la tabla detalles del trabajo foráneo
			$('#dg_detalles_trabajos_foraneos_servicio tbody').empty();
			$('#acumCantidad_detalles_trabajos_foraneos_servicio').html('');
		    $('#acumDescuento_detalles_trabajos_foraneos_servicio').html('');
		    $('#acumSubtotal_detalles_trabajos_foraneos_servicio').html('');
		    $('#acumIva_detalles_trabajos_foraneos_servicio').html('');
		    $('#acumIeps_detalles_trabajos_foraneos_servicio').html('');
		    $('#acumTotal_detalles_trabajos_foraneos_servicio').html('');
			$('#numElementos_detalles_trabajos_foraneos_servicio').html(0);
			$('#txtNumDetalles_trabajos_foraneos_servicio').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_trabajos_foraneos_servicio()
		{
			try {
				//Cerrar modal
				objTrabajosForaneosServicio.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_trabajos_foraneos_servicio').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_trabajos_foraneos_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_trabajos_foraneos_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmTrabajosForaneosServicio')
				.bootstrapValidator({	excluded: [':disabled'],
									 	container: 'popover',
									 	feedbackIcons: {
									 		valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
									  	},
									  	fields: {
											strFecha_trabajos_foraneos_servicio: {
												validators: {
													notEmpty: {message: 'Seleccione una fecha'}
												}
											},
											strOrdenReparacion_trabajos_foraneos_servicio: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la orden de reparación interna
						                                    if($('#txtOrdenReparacionID_trabajos_foraneos_servicio').val() === '')
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
											strOrdenCompra_trabajos_foraneos_servicio: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la orden de compra
						                                    if($('#txtOrdenCompraID_trabajos_foraneos_servicio').val() === '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba una orden de compra existente'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
											strFactura_trabajos_foraneos_servicio: {
												validators: {
													notEmpty: {message: 'Escriba una factura'}
												}
											},
											intTotalUnidades_trabajos_foraneos_servicio: {
												validators: {
													notEmpty: {message: 'Escriba el total de unidades'}
												}
											},
											intImporteTotal_trabajos_foraneos_servicio: {
												validators: {
													notEmpty: {message: 'Escriba el importe total'}
												}
											},
											intNumDetalles_trabajos_foraneos_servicio: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que existan detalles
						                                    if(parseInt(value) === 0 || value === '')
						                                    {
						                                    	return {
						                                            valid: false,
						                                            message: 'Agregar al menos un detalle para este trabajo foráneo.'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
										    strConcepto_detalles_trabajos_foraneos_servicio: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    strProductoServicio_detalles_trabajos_foraneos_servicio:{
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    strUnidad_detalles_trabajos_foraneos_servicio:{
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intCantidad_detalles_trabajos_foraneos_servicio: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intCostoUnitario_detalles_trabajos_foraneos_servicio: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intPrecioUnitario_detalles_trabajos_foraneos_servicio: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intPorcentajeGanancia_detalles_trabajos_foraneos_servicio: {
										        excluded: true  // Ignorar (no valida el campo)   
										    },
										    intPorcentajeDescuento_detalles_trabajos_foraneos_servicio: {
										        excluded: true  // Ignorar (no valida el campo)   
										    }
										}
									});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_trabajos_foraneos_servicio = $('#frmTrabajosForaneosServicio').data('bootstrapValidator');
			bootstrapValidator_trabajos_foraneos_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_trabajos_foraneos_servicio.isValid())
			{

				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesTrabajosForaneosServicio = $.reemplazar($('#acumTotal_detalles_trabajos_foraneos_servicio').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesTrabajosForaneosServicio = $.reemplazar(intAcumTotalDetallesTrabajosForaneosServicio, ",", "");

				var intImporteTotalTrabajosForaneosServicio = $.reemplazar($('#txtImporteTotal_trabajos_foraneos_servicio').val(), ",", "");


				//Verificar que el total de unidades sea igual a la cantidad de detalles
				if($('#acumCantidad_detalles_trabajos_foraneos_servicio').html() != $('#txtTotalUnidades_trabajos_foraneos_servicio').val())
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_trabajos_foraneos_servicio('error', 'El total de unidades no coincide con los detalles, favor de verificar.');
					
				}
				//Verificar que el importe total sea igual al total de detalles
				else if(intAcumTotalDetallesTrabajosForaneosServicio != intImporteTotalTrabajosForaneosServicio)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_trabajos_foraneos_servicio('error', 'El importe total no coincide con los detalles, favor de verificar.');
				}
				else
				{
					/*Hacer un llamado a la función para validar que los detalles cuenten con ID del producto/servicio y  
					  ID de la unidad SAT*/
					validar_detalles_trabajos_foraneos_servicios();
				}
			
			}
			else 
				return;
		}

		//Función que se utiliza para validar que los detalles cuenten con ID del producto/servicio y ID de la unidad SAT
		function validar_detalles_trabajos_foraneos_servicios()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_trabajos_foraneos_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrConceptos = [];
			var arrProductoServicioID = [];
			var arrUnidadID = [];
			var arrCantidades = [];
			var arrCostosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrTasaCuotaIva = [];
			var arrIvasUnitarios = [];
			var arrTasaCuotaIeps = [];
			var arrIepsUnitarios = [];
			var arrPreciosUnitarios = [];
			
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioTrabajo = parseFloat($('#txtTipoCambio_trabajos_foraneos_servicio').val());

			//Array que se utiliza para agregar los conceptos que no tienen: precio unitario, ID del producto/servicio o ID de la unidad SAT
			var arrDatosFaltantes = [];
			//Mensaje que se utiliza para informar al usuario la lista de conceptos sin precio unitario, sin ID del producto/servicio y/o sin ID de la unidad SAT
			var strMensaje = '';
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var strConcepto = objRen.cells[0].innerHTML;
				var intProductoServicioID = objRen.cells[14].innerHTML;
				var intUnidadID =  objRen.cells[16].innerHTML;

				//Si no existe id del producto/servicio SAT o id de la unidad SAT
				if(intProductoServicioID == '' || intUnidadID == '')
				{
					//Agregar concepto en el array, de esta manera, el usuario identificara los conceptos sin ID del producto/servicio y sin ID de la unidad SAT
					arrDatosFaltantes.push(strConcepto);
				}
				else
				{
					//Hacer un llamado a la función para reemplazar ',' por cadena vacia
					var intCantidad =  $.reemplazar(objRen.cells[1].innerHTML, ",", "");
					var intCostoUnitario = $.reemplazar(objRen.cells[25].innerHTML, ",", "");
					var intDescuentoUnitario = $.reemplazar(objRen.cells[21].innerHTML, ",", "");
					var intIvaUnitario = $.reemplazar(objRen.cells[22].innerHTML, ",", "");
					var intIepsUnitario = $.reemplazar(objRen.cells[23].innerHTML, ",", "");
					var intPrecioUnitario = $.reemplazar(objRen.cells[24].innerHTML, ",", "");

					//Calcular iva unitario
					intIvaUnitario =  intIvaUnitario / intCantidad;
					//Calcular ieps unitario
					intIepsUnitario = intIepsUnitario / intCantidad;

					//Convertir importes a peso mexicano
					intCostoUnitario = intCostoUnitario * intTipoCambioTrabajo;
					intDescuentoUnitario = intDescuentoUnitario * intTipoCambioTrabajo;
					intIvaUnitario = intIvaUnitario * intTipoCambioTrabajo;
					intIepsUnitario = intIepsUnitario * intTipoCambioTrabajo;
					intPrecioUnitario = intPrecioUnitario * intTipoCambioTrabajo;

					//Redondear cantidad a decimales
					intIvaUnitario = intIvaUnitario.toFixed(intNumDecimalesIvaUnitBDTrabajosForaneosServicio);
					intIvaUnitario = parseFloat(intIvaUnitario);

					//Redondear cantidad a decimales
					intIepsUnitario = intIepsUnitario.toFixed(intNumDecimalesIepsUnitBDTrabajosForaneosServicio);
					intIepsUnitario = parseFloat(intIepsUnitario);

					//Asignar valores a los arrays
					arrConceptos.push(strConcepto);
					arrProductoServicioID.push(intProductoServicioID);
					arrUnidadID.push(intUnidadID);
					arrCantidades.push(intCantidad);
					arrCostosUnitarios.push(intCostoUnitario);
					arrDescuentosUnitarios.push(intDescuentoUnitario);
					arrTasaCuotaIva.push(objRen.cells[18].innerHTML);
					arrIvasUnitarios.push(intIvaUnitario);
					arrTasaCuotaIeps.push(objRen.cells[19].innerHTML);
					arrIepsUnitarios.push(intIepsUnitario );
					arrPreciosUnitarios.push(intPrecioUnitario);
				}
			}

			
			//Si existen conceptos sin ID del producto/servicio SAT y ID de la unidad SAT
			if(arrDatosFaltantes.length > 0)
			{		
		    	
		    	//Mensaje que se utiliza para informar al usuario la lista de conceptos sin precio unitario, sin ID del producto/servicio SAT y sin unidad SAT
		    	strMensaje = strMensaje + 'Los siguientes <b>conceptos</b> no cuentan con código SAT ni unidad SAT:<br>';

		    	//Hacer recorrido para obtener conceptos sin precio unitario y/o sin ID del producto/servicio SAT
				for(var intCont = 0; intCont < arrDatosFaltantes.length; intCont++)
				{
					//Agregar concepto en el mensaje
            		strMensaje = strMensaje + arrDatosFaltantes[intCont] + '<br/>';
				}

				//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_trabajos_foraneos_servicio('error', strMensaje);
			}
			else
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_trabajos_foraneos_servicio(arrConceptos, arrProductoServicioID, arrUnidadID, arrCantidades,
												   arrCostosUnitarios, arrDescuentosUnitarios, arrTasaCuotaIva,
												   arrIvasUnitarios, arrTasaCuotaIeps, arrIepsUnitarios, 
												   arrPreciosUnitarios);
			}
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_trabajos_foraneos_servicio()
		{
			try
			{
				$('#frmTrabajosForaneosServicio').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_trabajos_foraneos_servicio(arrConceptos, arrProductoServicioID, arrUnidadID, arrCantidades,
												    arrCostosUnitarios, arrDescuentosUnitarios, arrTasaCuotaIva,
												    arrIvasUnitarios, arrTasaCuotaIeps, arrIepsUnitarios, 
												    arrPreciosUnitarios)
		{
			
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('servicio/trabajos_foraneos/guardar',
					{ 
						//Datos del trabajo foráneo
						intTrabajoForaneoID: $('#txtTrabajoForaneoID_trabajos_foraneos_servicio').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_trabajos_foraneos_servicio').val()),
						intMonedaID: $('#txtMonedaID_trabajos_foraneos_servicio').val(),
						intTipoCambio: $('#txtTipoCambio_trabajos_foraneos_servicio').val(),
						strFactura: $('#txtFactura_trabajos_foraneos_servicio').val(),
						intOrdenCompraID: $('#txtOrdenCompraID_trabajos_foraneos_servicio').val(),
						intOrdenReparacionID: $('#txtOrdenReparacionID_trabajos_foraneos_servicio').val(),
						strObservaciones: $('#txtObservaciones_trabajos_foraneos_servicio').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_trabajos_foraneos_servicio').val(),
						//Datos de los detalles
						strConceptos: arrConceptos.join('|'), 
						strProductoServicioID: arrProductoServicioID.join('|'), 
						strUnidadID: arrUnidadID.join('|'), 
						strCantidades: arrCantidades.join('|'),
						strCostosUnitarios: arrCostosUnitarios.join('|'),
						strDescuentosUnitarios: arrDescuentosUnitarios.join('|'),
						strTasaCuotaIva: arrTasaCuotaIva.join('|'),
						strIvasUnitarios: arrIvasUnitarios.join('|'),
						strTasaCuotaIeps: arrTasaCuotaIeps.join('|'),
						strIepsUnitarios: arrIepsUnitarios.join('|'),
						strPreciosUnitarios: arrPreciosUnitarios.join('|')
					},
					function(data) {
						if (data.resultado)
						{	

							//Si no existe id del trabajo foráneo, significa que es un nuevo registro   
							if($('#txtTrabajoForaneoID_trabajos_foraneos_servicio').val() == '')
							{
							  	//Asignar el id del trabajo foráneo registrado en la base de datos
                     			$('#txtTrabajoForaneoID_trabajos_foraneos_servicio').val(data.trabajo_foraneo_id);
                 			}

			              	//Hacer llamado a la función para cargar  los registros en el grid
							paginacion_trabajos_foraneos_servicio();
							
							//Hacer un llamado a la función para generar póliza con los datos del registro
							generar_poliza_trabajos_foraneos_servicio('', '');

						}

						//Si existe mensaje de error
						if(data.tipo_mensaje == 'error')
						{
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_trabajos_foraneos_servicio(data.tipo_mensaje, data.mensaje);
					    }

					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_trabajos_foraneos_servicio(tipoMensaje, mensaje)
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
		function cambiar_estatus_trabajos_foraneos_servicio(id, polizaID, folioPoliza)
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
				intID = $('#txtTrabajoForaneoID_trabajos_foraneos_servicio').val();
				intPolizaID = $('#txtPolizaID_trabajos_foraneos_servicio').val();
				strFolioPoliza = $('#txtFolioPoliza_trabajos_foraneos_servicio').val();

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
			              'title':    'Trabajos Foráneos',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
			                              $.post('servicio/trabajos_foraneos/set_estatus',
			                                     {intTrabajoForaneoID: intID, 
			                                      intPolizaID: intPolizaID
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                          //Hacer llamado a la función  para cargar  los registros en el grid
			                                          paginacion_trabajos_foraneos_servicio();

			                                          	//Si el id del registro se obtuvo del modal
														if(id == '')
														{
															//Hacer un llamado a la función para cerrar modal
															cerrar_trabajos_foraneos_servicio();     
														}
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_trabajos_foraneos_servicio(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_trabajos_foraneos_servicio(id, tipoAccion)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/trabajos_foraneos/get_datos',
			       {intTrabajoForaneoID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_trabajos_foraneos_servicio();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				             //Asignar el id de la póliza
				            var intPolizaID = parseInt(data.row.poliza_id); 

				          	//Recuperar valores
				            $('#txtTrabajoForaneoID_trabajos_foraneos_servicio').val(data.row.trabajo_foraneo_id);
				            $('#txtFolio_trabajos_foraneos_servicio').val(data.row.folio);
				            $('#txtFecha_trabajos_foraneos_servicio').val(data.row.fecha);
				            $('#txtMonedaID_trabajos_foraneos_servicio').val(data.row.moneda_id);
				            $('#txtMoneda_trabajos_foraneos_servicio').val(data.row.moneda);
				            $('#txtTipoCambio_trabajos_foraneos_servicio').val(data.row.tipo_cambio);
				            $('#txtFactura_trabajos_foraneos_servicio').val(data.row.factura);
				            $('#txtOrdenCompraID_trabajos_foraneos_servicio').val(data.row.orden_compra_id);
				            $('#txtOrdenCompra_trabajos_foraneos_servicio').val(data.row.folio_orden_compra);
						    $('#txtProveedor_trabajos_foraneos_servicio').val(data.row.proveedor);
				            $('#txtOrdenReparacionID_trabajos_foraneos_servicio').val(data.row.orden_reparacion_id);
						    $('#txtOrdenReparacion_trabajos_foraneos_servicio').val(data.row.folio_orden_reparacion);
						    $('#txtProspecto_trabajos_foraneos_servicio').val(data.row.prospecto);
						    $('#txtObservaciones_trabajos_foraneos_servicio').val(data.row.observaciones);
						    $('#txtPolizaID_trabajos_foraneos_servicio').val(intPolizaID);
						    $('#txtFolioPoliza_trabajos_foraneos_servicio').val(data.row.folio_poliza);
						    $('#txtEstatus_trabajos_foraneos_servicio').val(strEstatus);

						    //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_trabajos_foraneos_servicio').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_trabajos_foraneos_servicio").show();

				            //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmTrabajosForaneosServicio').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_trabajos_foraneos_servicio").hide();
					            //Deshabilitar botón Agregar
								$('#btnAgregar_detalles_trabajos_foraneos_servicio').prop('disabled', true);

								//Si existe el id de la póliza
				            	if(strEstatus == 'ACTIVO' && intPolizaID > 0)
				            	{
				            		//Mostrar el botón Desactivar
				            		$("#btnDesactivar_trabajos_foraneos_servicio").show();
				            	}
				            }
				            else
				            {
				            	//Habilitar las siguientes cajas de texto
				            	$("#txtProductoServicio_detalles_trabajos_foraneos_servicio").removeAttr('disabled');
				            	$("#txtUnidad_detalles_trabajos_foraneos_servicio").removeAttr('disabled');
				            	$("#txtCantidad_detalles_trabajos_foraneos_servicio").removeAttr('disabled');
				            	$("#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio").removeAttr('disabled');
				            }

							//Mostramos los detalles del registro
			                if(data.detalles)
			                {
		         		   		//Hacer llamado a la función  para cargar los detalles del registro en el grid
	             		    	lista_detalles_trabajos_foraneos_servicio(tipoAccion, strEstatus, data.detalles);
	             			} 
							
			            	//Abrir modal
							objTrabajosForaneosServicio = $('#TrabajosForaneosServicioBox').bPopup({
														   appendTo: '#TrabajosForaneosServicioContent', 
							                               contentContainer: 'TrabajosForaneosServicioM', 
							                               zIndex: 2, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});

					    	//Enfocar caja de texto
							$('#txtOrdenReparacion_trabajos_foraneos_servicio').focus();
			       	    }
			       },
			       'json');
		}


		//Función para regresar obtener los datos de una orden de compra
		function get_datos_orden_compra_trabajos_foraneos_servicio()
		{
			  //Hacer un llamado al método del controlador para regresar los datos de la orden de compra
	          $.post('servicio/ordenes_compra_servicio/get_datos',
	          { 
	          		intOrdenCompraServicioID: $("#txtOrdenCompraID_trabajos_foraneos_servicio").val()
	          },
	              function(data) {
	                if(data.row){

	                	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
						inicializar_detalles_trabajos_foraneos_servicio();
	                	//Recuperar valores
	         			$('#txtOrdenCompra_trabajos_foraneos_servicio').val(data.row.folio);
	         			$('#txtMonedaID_trabajos_foraneos_servicio').val(data.row.moneda_id);
	         			$('#txtMoneda_trabajos_foraneos_servicio').val(data.row.moneda);
			            $('#txtTipoCambio_trabajos_foraneos_servicio').val(data.row.tipo_cambio);
			            $('#txtFactura_trabajos_foraneos_servicio').val(data.row.factura);
	         		    $('#txtProveedor_trabajos_foraneos_servicio').val(data.row.proveedor);

	         		    //Cargar refacciones adherentes a la orden de compra seleccionada
		                if(data.detalles)
		                {
	         		   		//Hacer llamado a la función  para cargar los detalles del registro en el grid
             		    	lista_detalles_trabajos_foraneos_servicio('Nuevo', '', data.detalles);
             			}
	                }
	            }
	             ,
	            'json');

		}

		//Función para habilitar y deshabilitar los campos del detalle cuando cambia la orden de compra
		function habilitar_elementos_orden_compra_detalles_trabajos_foraneos_servicio(campo){
			//Deshabilitar o habilitar las siguientes cajas de texto			
			var arrCajasTexto  = {
						//Son los id de los input que se van a habilitar o deshabilitar
						rows:['#txtProductoServicio_detalles_trabajos_foraneos_servicio',
							  '#txtUnidad_detalles_trabajos_foraneos_servicio',
							  '#txtCantidad_detalles_trabajos_foraneos_servicio',
							  '#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio'
							  ],
						//Es asignar un attributo disbaled|checked
						attribute: 'disabled',									
					};						
			($(campo).val() && $('#txtOrdenCompra_trabajos_foraneos_servicio').val())? arrCajasTexto.bool = false: arrCajasTexto.bool= true;								
			//Hacer un llamado a la función para habilitar o deshabilitar cajas de texto				
			$.habilitar_deshabilitar_campos(arrCajasTexto);
		}


		//Función para generar póliza con los datos de un registro
		function generar_poliza_trabajos_foraneos_servicio(id, formulario)
		{	

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtTrabajoForaneoID_trabajos_foraneos_servicio').val();
			}
			else
			{
				intID = id;
				strTipo = 'gridview';
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_trabajos_foraneos_servicio(formulario);
			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaTrabajosForaneosServicio, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_trabajos_foraneos_servicio').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_trabajos_foraneos_servicio(formulario);
			
			    //Si existe resultado
				if (data.resultado)
				{
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_trabajos_foraneos_servicio();

					//Si el id del registro se obtuvo del modal
					if(strTipo == 'modal')
					{
						//Hacer un llamado a la función para cerrar modal
			            cerrar_trabajos_foraneos_servicio();
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
			            								cerrar_trabajos_foraneos_servicio();
	                                                 }
	                                                }]
	                                  });
				}
				else
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    	mensaje_trabajos_foraneos_servicio(data.tipo_mensaje, data.mensaje);
				}
			  
				
		     },
		     'json');

		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function mostrar_circulo_carga_trabajos_foraneos_servicio(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_trabajos_foraneos_servicio';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_trabajos_foraneos_servicio';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}


		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function ocultar_circulo_carga_trabajos_foraneos_servicio(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_trabajos_foraneos_servicio';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_trabajos_foraneos_servicio';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}
	


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos del concepto (detalle)
		function inicializar_concepto_detalles_trabajos_foraneos_servicio()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_detalles_trabajos_foraneos_servicio').val('');
			$('#txtConcepto_detalles_trabajos_foraneos_servicio').val('');
			$('#txtProductoServicioID_detalles_trabajos_foraneos_servicio').val('');
		    $('#txtProductoServicio_detalles_trabajos_foraneos_servicio').val('');
		    $('#txtUnidadID_detalles_trabajos_foraneos_servicio').val('');
		    $('#txtUnidad_detalles_trabajos_foraneos_servicio').val('');
			$('#txtCantidad_detalles_trabajos_foraneos_servicio').val('');
		    $('#txtCostoUnitario_detalles_trabajos_foraneos_servicio').val('');
		    $('#txtCostoUnitarioReal_detalles_trabajos_foraneos_servicio').val('');
		    $('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').val('');
		    $('#txtPrecioUnitario_detalles_trabajos_foraneos_servicio').val('');
		    $('#txtDescuentoUnitario_detalles_trabajos_foraneos_servicio').val('');
		    $('#txtIepsUnitario_detalles_trabajos_foraneos_servicio').val('');
		    $('#txtTipoTasaCuotaIeps_detalles_trabajos_foraneos_servicio').val('');
			$('#txtFactorTasaCuotaIeps_detalles_trabajos_foraneos_servicio').val('');
			$('#txtIvaUnitario_detalles_trabajos_foraneos_servicio').val('');
		}

		//Función para la búsqueda de detalles del registro
		function lista_detalles_trabajos_foraneos_servicio(tipoAccion, estatus, objDetalles) 
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Si se cumple la sentencia
			if(estatus == '' || (estatus == 'ACTIVO' && tipoAccion == 'Editar'))
			{
				strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
								    "	onclick='editar_renglon_detalles_trabajos_foraneos_servicio(this)'>" + 
									"<span class='glyphicon glyphicon-edit'></span></button>";
			}

		
	       		//Variable que se utiliza para asignar el tipo de cambio
	            var intTipoCambio = parseFloat($('#txtTipoCambio_trabajos_foraneos_servicio').val());

	            //Mostramos los detalles del registro
	            for (var intCon in objDetalles) 
	            {
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_detalles_trabajos_foraneos_servicio').getElementsByTagName('tbody')[0];

					//Variable que se utiliza para asignar  el color de fondo del registro 
					var strEstiloRegistro = '';
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaConcepto = objRenglon.insertCell(0);
					var objCeldaCantidad = objRenglon.insertCell(1);
					var objCeldaCostoUnitario = objRenglon.insertCell(2);
					var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
					var objCeldaSubtotal = objRenglon.insertCell(4);
					var objCeldaIva = objRenglon.insertCell(5);
					var objCeldaIeps = objRenglon.insertCell(6);
					var objCeldaTotal = objRenglon.insertCell(7);
					var objCeldaAcciones = objRenglon.insertCell(8);
					//Columnas ocultas
					var objCeldaPorcentajeDescuento = objRenglon.insertCell(9);
					var objCeldaPorcentajeIva = objRenglon.insertCell(10);
					var objCeldaPorcentajeIeps = objRenglon.insertCell(11);
					var objCeldaPorcentajeGanancia = objRenglon.insertCell(12);
					var objCeldaPrecioUnitario = objRenglon.insertCell(13);
					var objCeldaProductoServicioID = objRenglon.insertCell(14);
					var objCeldaProductoServicio = objRenglon.insertCell(15);
					var objCeldaUnidadID = objRenglon.insertCell(16);
					var objCeldaUnidad = objRenglon.insertCell(17);
					var objCeldaTasaCuotaIva = objRenglon.insertCell(18);
					var objCeldaTasaCuotaIeps = objRenglon.insertCell(19);
					var objCeldaCostoUnitarioBD = objRenglon.insertCell(20);
					var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(21);
					var objCeldaIvaBD = objRenglon.insertCell(22);
					var objCeldaIepsBD = objRenglon.insertCell(23);
					var objCeldaPrecioUnitarioBD = objRenglon.insertCell(24);
					var objCeldaCostoUnitarioReal = objRenglon.insertCell(25);
					var objCeldaIepsUnitario = objRenglon.insertCell(26);
					var objCeldaTipoTasaCuotaIeps = objRenglon.insertCell(27);
					var objCeldaFactorTasaCuotaIeps = objRenglon.insertCell(28);
					var objCeldaIvaUnitario = objRenglon.insertCell(29);

					//Variables que se utilizan para asignar valores del detalle
					var intProductoServicioID = '';
					var strProductoServicio =   '';
					var intUnidadID = '';
					var strUnidad = '';
					var intCantidad = parseFloat(objDetalles[intCon].cantidad);
					var intCostoUnitario = parseFloat(objDetalles[intCon].costo_unitario);
					var intCostoUnitarioReal = intCostoUnitario;
					var intDescuentoUnitario = parseFloat(objDetalles[intCon].descuento_unitario);
					var intIvaUnitario = parseFloat(objDetalles[intCon].iva_unitario);
					var intTasaCuotaIeps = objDetalles[intCon].tasa_cuota_ieps;
					var intIepsUnitario = parseFloat(objDetalles[intCon].ieps_unitario);
					var intPrecioUnitario = parseFloat(objDetalles[intCon].precio_unitario);
					var intImporteIva = 0;
					var intImporteIeps = 0;
					var intImporteIepsBD = 0;
					var intPorcentajeDescuento = 0;
					var intPorcentajeIeps = '';
					var strTipoTasaCuotaIeps = objDetalles[intCon].tipo_ieps;
					var strFactorTasaCuotaIeps = objDetalles[intCon].factor_ieps;
					var intPorcentajeGanancia = '';
					var intSubtotal = 0;
					var intTotal = 0;
					
					//Si el tipo de acción corresponde a Nuevo
					if(tipoAccion == 'Nuevo')
					{
						//Cambiar fondo del registro para indicarle al usuario que hacen falta datos por capturar
						strEstiloRegistro = 'registro-INACTIVO';

						//Asignar precio unitario del detalle de la orden de compra
						intCostoUnitario = intPrecioUnitario;
						intCostoUnitarioReal = intCostoUnitario;

					}
					else
					{
						//Asignar valores del detalle del trabajo foráneo
						intProductoServicioID = objDetalles[intCon].producto_servicio_id;
						strProductoServicio =   objDetalles[intCon].producto_servicio;
						intUnidadID = objDetalles[intCon].unidad_id;
						strUnidad = objDetalles[intCon].unidad;
						intPrecioUnitario = parseFloat(objDetalles[intCon].precio_unitario);
						//Calcular porcentaje de ganancia
						intPorcentajeGananciaFijo = (intPrecioUnitario / intCostoUnitarioReal);
						//Redondear cantidad a dos decimales
						intPorcentajeGananciaFijo = intPorcentajeGananciaFijo.toFixed(2);

						/*Convertir decimal a cadena de texto (separar cadena para obtener porcentaje de ganancia 
						ejemplo: 1.5 donde el 5 es el porcentaje de ganancia)*/
						intPorcentajeGanancia = String(intPorcentajeGananciaFijo).split(".")[1];

						//Cambiar cantidad a  formato moneda (a visualizar)
						intPorcentajeGanancia  = formatMoney(intPorcentajeGanancia, intNumDecimalesDescUnitBDTrabajosForaneosServicio, '');
					}

					//Asignar costo unitario
					intSubtotal = intCostoUnitario;

					//Convertir peso mexicano a tipo de cambio
					intSubtotal = intSubtotal / intTipoCambio;
					intCostoUnitario = intCostoUnitario / intTipoCambio;
					intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
					intIvaUnitario = intIvaUnitario / intTipoCambio;
					intIepsUnitario = intIepsUnitario / intTipoCambio;
					intPrecioUnitario = intPrecioUnitario / intTipoCambio;
					intCostoUnitarioReal = intCostoUnitarioReal / intTipoCambio;

					//Si existe importe del descuento
					if(intDescuentoUnitario > 0)
					{
						//Incrementar costo unitario
						intCostoUnitario = intCostoUnitario + intDescuentoUnitario;
						//Calcular porcentaje del descuento
						intPorcentajeDescuento = (intDescuentoUnitario / intCostoUnitario) * 100;
					}

					//Calcular subtotal
					intSubtotal = intCantidad * intSubtotal;

					//Calcular importe de IVA
					intImporteIva =  intIvaUnitario * intCantidad;

					//Si existe importe Tasa cuota del impuesto de IEPS
					if(intTasaCuotaIeps > 0)
					{
						intPorcentajeIeps = objDetalles[intCon].porcentaje_ieps;
						//Calcular importe de IEPS
						intImporteIeps =  intIepsUnitario * intCantidad;
						//Asignar importe de IEPS
					   	intImporteIepsBD =  intImporteIeps;	
						
						//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
						if(strTipoTasaCuotaIeps == 'RANGO' && strFactorTasaCuotaIeps == 'Cuota')
						{
							//Incrementar al subtotal el  importe de IEPS
							intSubtotal += intImporteIeps;
							//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
							intImporteIeps = 0;
						}
						
					}

					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;

	                //Cambiar cantidad a  formato moneda (a visualizar)
	        	    intCantidad =  formatMoney(intCantidad, intNumDecimalesCantidadBDTrabajosForaneosServicio, '');

	        	    var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDTrabajosForaneosServicio, '');

	        	     var intCostoUnitarioRealMostrar =  formatMoney(intCostoUnitarioReal, intNumDecimalesCostoUnitBDTrabajosForaneosServicio, '');

	        	    var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDTrabajosForaneosServicio, '');

	        	     var intPrecioUnitarioMostrar =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDTrabajosForaneosServicio, '');

	        	    var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarTrabajosForaneosServicio, '');

	        	    var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarTrabajosForaneosServicio, '');
						
					var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarTrabajosForaneosServicio, '');
						
					var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarTrabajosForaneosServicio, '');
						
					intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDTrabajosForaneosServicio, '');

	        	    //Cambiar cantidad a  formato moneda (a guardar en la  BD)
	        	    var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDTrabajosForaneosServicio, '');

	        	    var intPrecioUnitarioBD =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDTrabajosForaneosServicio, '');

	       			var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDTrabajosForaneosServicio, '');
						
					var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDTrabajosForaneosServicio, '');
						
					intImporteIepsBD  =  formatMoney(intImporteIepsBD, intNumDecimalesIepsUnitBDTrabajosForaneosServicio, '');

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id',objDetalles[intCon].renglon);
					objCeldaConcepto.setAttribute('class', 'movil b1 '+strEstiloRegistro);
					objCeldaConcepto.innerHTML = objDetalles[intCon].concepto;
					objCeldaCantidad.setAttribute('class', 'movil b2 '+strEstiloRegistro);
					objCeldaCantidad.innerHTML = intCantidad;
					objCeldaCostoUnitario.setAttribute('class', 'movil b3 '+strEstiloRegistro);
					objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
					objCeldaDescuentoUnitario.setAttribute('class', 'movil b4 '+strEstiloRegistro);
					objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitarioMostrar;
					objCeldaSubtotal.setAttribute('class', 'movil b5 '+strEstiloRegistro);
					objCeldaSubtotal.innerHTML = intSubtotalMostrar;
					objCeldaIva.setAttribute('class', 'movil b6 '+strEstiloRegistro);
					objCeldaIva.innerHTML = intImporteIvaMostrar;
					objCeldaIeps.setAttribute('class', 'movil b7 '+strEstiloRegistro);
					objCeldaIeps.innerHTML = intImporteIepsMostrar;
					objCeldaTotal.setAttribute('class', 'movil b8 '+strEstiloRegistro);
					objCeldaTotal.innerHTML = intTotalMostrar;
					objCeldaAcciones.setAttribute('class', 'td-center movil b9 '+strEstiloRegistro);
					objCeldaAcciones.innerHTML = strAccionesTabla;
					objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento;
					objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
				    objCeldaPorcentajeIva.innerHTML =  objDetalles[intCon].porcentaje_iva;
					objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
					objCeldaPorcentajeGanancia.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeGanancia.innerHTML = intPorcentajeGanancia;
					objCeldaPrecioUnitario.setAttribute('class', 'no-mostrar');
					objCeldaPrecioUnitario.innerHTML =  intPrecioUnitarioMostrar;
					//Columnas ocultas que se utilizan para guardar información en la BD
					objCeldaProductoServicioID.setAttribute('class', 'no-mostrar');
					objCeldaProductoServicioID.innerHTML = intProductoServicioID;
					objCeldaProductoServicio.setAttribute('class', 'no-mostrar');
					objCeldaProductoServicio.innerHTML = strProductoServicio;
					objCeldaUnidadID.setAttribute('class', 'no-mostrar');
					objCeldaUnidadID.innerHTML = intUnidadID;
					objCeldaUnidad.setAttribute('class', 'no-mostrar');
					objCeldaUnidad.innerHTML = strUnidad;
					objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIva.innerHTML = objDetalles[intCon].tasa_cuota_iva;
					objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIeps.innerHTML = intTasaCuotaIeps;
					objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaCostoUnitarioBD.innerHTML =  intCostoUnitarioBD;
					objCeldaDescuentoUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaDescuentoUnitarioBD.innerHTML =  intDescuentoUnitarioBD;
					objCeldaIvaBD.setAttribute('class', 'no-mostrar');
					objCeldaIvaBD.innerHTML =  intImporteIvaBD;
					objCeldaIepsBD.setAttribute('class', 'no-mostrar');
					objCeldaIepsBD.innerHTML =  intImporteIepsBD;
					objCeldaPrecioUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaPrecioUnitarioBD.innerHTML =  intPrecioUnitarioBD;
					objCeldaCostoUnitarioReal.setAttribute('class', 'no-mostrar');
					objCeldaCostoUnitarioReal.innerHTML =  intCostoUnitarioRealMostrar;
					objCeldaIepsUnitario.setAttribute('class', 'no-mostrar');
					objCeldaIepsUnitario.innerHTML =  intIepsUnitario;
					objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTipoTasaCuotaIeps.innerHTML =  strTipoTasaCuotaIeps;
					objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaFactorTasaCuotaIeps.innerHTML = strFactorTasaCuotaIeps;
					objCeldaIvaUnitario.setAttribute('class', 'no-mostrar');
					objCeldaIvaUnitario.innerHTML = intIvaUnitario;
					
	            }

	            //Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_trabajos_foraneos_servicio();
	            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_trabajos_foraneos_servicio tr").length - 2;
				$('#numElementos_detalles_trabajos_foraneos_servicio').html(intFilas);
				$('#txtNumDetalles_trabajos_foraneos_servicio').val(intFilas);

		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_trabajos_foraneos_servicio()
		{
			//Variable que se utiliza para asignar el subtotal (costo unitario en la tabla movimientos_refacciones_internas_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asigna el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			var intImporteIepsBD  = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_detalles_trabajos_foraneos_servicio').val();
			var intProductoServicioID = $('#txtProductoServicioID_detalles_trabajos_foraneos_servicio').val();
			var strProductoServicio = $('#txtProductoServicio_detalles_trabajos_foraneos_servicio').val();
			var intUnidadID = $('#txtUnidadID_detalles_trabajos_foraneos_servicio').val();
			var strUnidad = $('#txtUnidad_detalles_trabajos_foraneos_servicio').val();
			var intCantidad =  $('#txtCantidad_detalles_trabajos_foraneos_servicio').val();
			var intCostoUnitario =  $('#txtCostoUnitario_detalles_trabajos_foraneos_servicio').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_trabajos_foraneos_servicio').val();
			var intDescuentoUnitario = $('#txtDescuentoUnitario_detalles_trabajos_foraneos_servicio').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_trabajos_foraneos_servicio').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_trabajos_foraneos_servicio').val();
			var intPorcentajeGanancia = $('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').val();
			var strTipoTasaCuotaIeps = $('#txtTipoTasaCuotaIeps_detalles_trabajos_foraneos_servicio').val();
		    var strFactorTasaCuotaIeps = $('#txtFactorTasaCuotaIeps_detalles_trabajos_foraneos_servicio').val();
			var intIepsUnitario = $('#txtIepsUnitario_detalles_trabajos_foraneos_servicio').val();
			var intIvaUnitario = $('#txtIvaUnitario_detalles_trabajos_foraneos_servicio').val();
			
			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_trabajos_foraneos_servicio').getElementsByTagName('tbody')[0];

			//Si existe ID del renglón
			if (intRenglon != '' )
			{
				//Validamos que se capturaron datos
				if ((intProductoServicioID == '' || strProductoServicio == '') && intCantidad != '' )
				{
					//Enfocar caja de texto
					$('#txtProductoServicio_detalles_trabajos_foraneos_servicio').focus();
				}
				else if ((intUnidadID == '' || strUnidad == '' ) && intCantidad != '')
				{
					//Enfocar caja de texto
					$('#txtUnidad_detalles_trabajos_foraneos_servicio').focus();
				}
				else if (intCantidad == '')
				{
					//Enfocar caja de texto
					$('#txtCantidad_detalles_trabajos_foraneos_servicio').focus();
				}
				else if (intPorcentajeGanancia == '')
				{
					//Enfocar caja de texto
					$('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').focus();
				}
				else if (parseFloat($.reemplazar(intPorcentajeGanancia, ",", "")) > 100)
				{
					//Limpiar caja de texto
					$('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').val('');
					//Enfocar caja de texto
					$('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').focus();
				}
				else
				{
					//Hacer un llamado a la función para inicializar elementos del detalle
		            inicializar_concepto_detalles_trabajos_foraneos_servicio();

		            //Convertir cadena de texto a número decimal
					intCostoUnitario = parseFloat($.reemplazar(intCostoUnitario, ",", ""));
					intPrecioUnitario = parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
					intDescuentoUnitario = parseFloat($.reemplazar(intDescuentoUnitario, ",", ""));
					intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
					intSubtotal = intCostoUnitario;
					intIvaUnitario = parseFloat($.reemplazar(intIvaUnitario, ",", ""));

					//Si existe descuento unitario
					if(intDescuentoUnitario > 0)
					{
						//Decrementar descuento unitario
						intSubtotal = intSubtotal - intDescuentoUnitario;
					}

					//Calcular subtotal
					intSubtotal = intCantidad * intSubtotal;
					//Redondear cantidad a decimales
					intSubtotal = intSubtotal.toFixed(intNumDecimalesPrecioUnitBDTrabajosForaneosServicio);
					intSubtotal = parseFloat(intSubtotal);
					
					//Calcular importe de IVA
					intImporteIva =  intIvaUnitario * intCantidad;

					//Redondear cantidad a dos decimales
				    intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaUnitBDTrabajosForaneosServicio);
				    intImporteIva = parseFloat(intImporteIva);

					//Si existe porcentaje de IEPS
					if(intPorcentajeIeps != '')
					{
						//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
						if(strTipoTasaCuotaIeps == 'RANGO' && strFactorTasaCuotaIeps == 'Cuota')
						{
							//Asignar importe de IEPS unitario
						    intIepsUnitario = parseFloat($.reemplazar(intIepsUnitario, ",", ""));
						    //Calcular importe de IEPS
							intImporteIeps = parseFloat(intCantidad * intIepsUnitario);

							//Redondear cantidad a  decimales
							intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDTrabajosForaneosServicio);
					   	 	intImporteIeps = parseFloat(intImporteIeps);

					   	 	//Asignar importe de IEPS
					   		intImporteIepsBD =  intImporteIeps;

							//Incrementar al subtotal el  importe de IEPS
							intSubtotal += intImporteIeps;
					   	 	//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
					   	 	intImporteIeps = 0;
					   	 
						}
						else
						{
							//Calcular importe de IEPS
							intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
							//Redondear cantidad a  decimales
							intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDTrabajosForaneosServicio);
					   	 	intImporteIeps = parseFloat(intImporteIeps);
					   	 	//Asignar importe de IEPS
					   		intImporteIepsBD =  intImporteIeps;
						}
					}
					

					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;

					//Cambiar cantidad a  formato moneda (a visualizar)
					intCantidad =  formatMoney(intCantidad, intNumDecimalesCantidadBDTrabajosForaneosServicio, '');

					var intPrecioUnitarioMostrar =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDTrabajosForaneosServicio, '');
					
					var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarTrabajosForaneosServicio, '');
					
					var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarTrabajosForaneosServicio, '');
					
					var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarTrabajosForaneosServicio, '');
					
					var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarTrabajosForaneosServicio, '');
					
					intPorcentajeGanancia  = formatMoney(intPorcentajeGanancia, intNumDecimalesDescUnitBDTrabajosForaneosServicio, '');

					//Cambiar cantidad a  formato moneda (a guardar en la  BD)
					var intPrecioUnitarioBD =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDTrabajosForaneosServicio, '');

					var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDTrabajosForaneosServicio, '');
					
					intImporteIepsBD  =  formatMoney(intImporteIepsBD, intNumDecimalesIepsUnitBDTrabajosForaneosServicio, '');

				 
					//Quitar el color de fondo
					objTabla.rows.namedItem(intRenglon).cells[0].setAttribute('class', 'movil b1');
					objTabla.rows.namedItem(intRenglon).cells[1].setAttribute('class', 'movil b2');
					objTabla.rows.namedItem(intRenglon).cells[2].setAttribute('class', 'movil b3');
					objTabla.rows.namedItem(intRenglon).cells[3].setAttribute('class', 'movil b4');
					objTabla.rows.namedItem(intRenglon).cells[4].setAttribute('class', 'movil b5');
					objTabla.rows.namedItem(intRenglon).cells[5].setAttribute('class', 'movil b6');
					objTabla.rows.namedItem(intRenglon).cells[6].setAttribute('class', 'movil b7');
					objTabla.rows.namedItem(intRenglon).cells[7].setAttribute('class', 'movil b8');
					objTabla.rows.namedItem(intRenglon).cells[8].setAttribute('class', 'td-center movil b9');


					//Editar los datos del detalle
					objTabla.rows.namedItem(intRenglon).cells[1].innerHTML = intCantidad;
					objTabla.rows.namedItem(intRenglon).cells[4].innerHTML =  intSubtotalMostrar;
					objTabla.rows.namedItem(intRenglon).cells[5].innerHTML = intImporteIvaMostrar;
					objTabla.rows.namedItem(intRenglon).cells[6].innerHTML = intImporteIepsMostrar;
					objTabla.rows.namedItem(intRenglon).cells[7].innerHTML = intTotalMostrar;
					objTabla.rows.namedItem(intRenglon).cells[12].innerHTML = intPorcentajeGanancia;
					objTabla.rows.namedItem(intRenglon).cells[13].innerHTML = intPrecioUnitarioMostrar;
					objTabla.rows.namedItem(intRenglon).cells[14].innerHTML = intProductoServicioID;
					objTabla.rows.namedItem(intRenglon).cells[15].innerHTML = strProductoServicio;
					objTabla.rows.namedItem(intRenglon).cells[16].innerHTML = intUnidadID;
					objTabla.rows.namedItem(intRenglon).cells[17].innerHTML = strUnidad;
					objTabla.rows.namedItem(intRenglon).cells[22].innerHTML = intImporteIvaBD;
					objTabla.rows.namedItem(intRenglon).cells[23].innerHTML = intImporteIepsBD;
					objTabla.rows.namedItem(intRenglon).cells[24].innerHTML = intPrecioUnitarioBD;
					
					
					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_detalles_trabajos_foraneos_servicio();
					
				}
			}
			else
			{
				
		    	//Hacer un llamado a la función para inicializar elementos del detalle
		        inicializar_concepto_detalles_trabajos_foraneos_servicio();

		    	//Enfocar caja de texto
		    	$('#txtProductoServicio_detalles_trabajos_foraneos_servicio').focus();

			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_trabajos_foraneos_servicio tr").length - 2;
			$('#numElementos_detalles_trabajos_foraneos_servicio').html(intFilas);
			$('#txtNumDetalles_trabajos_foraneos_servicio').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_trabajos_foraneos_servicio(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtConcepto_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtCantidad_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCostoUnitario_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtDescuentoUnitario_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtPorcentajeIva_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIeps_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtPrecioUnitario_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtProductoServicioID_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);
			$('#txtProductoServicio_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[15].innerHTML);
			$('#txtUnidadID_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[16].innerHTML);
			$('#txtUnidad_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[17].innerHTML);
			$('#txtCostoUnitarioReal_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[25].innerHTML);
			$('#txtIepsUnitario_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[26].innerHTML);
			$('#txtTipoTasaCuotaIeps_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[27].innerHTML);
			$('#txtFactorTasaCuotaIeps_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[28].innerHTML);
			$('#txtIvaUnitario_detalles_trabajos_foraneos_servicio').val(objRenglon.parentNode.parentNode.cells[29].innerHTML);


			//Enfocar caja de texto
			$('#txtProductoServicio_detalles_trabajos_foraneos_servicio').focus();
		}


		//Función que se utiliza para calcular el precio unitario con porcentaje de ganancia
		function calcular_precio_unitario_detalles_trabajos_foraneos_servicio()
		{

			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			var intPrecioUnitario = parseFloat($.reemplazar($('#txtPrecioUnitario_detalles_trabajos_foraneos_servicio').val(), ",", ""));
	         var intCostoUnitarioReal = parseFloat($.reemplazar($('#txtCostoUnitarioReal_detalles_trabajos_foraneos_servicio').val(), ",", ""));
            var intPorcentajeGanancia =  $.reemplazar($('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').val(), ",", "");

            //Si existe porcentaje de ganancia
            if(intPorcentajeGanancia != '' && parseFloat(intPorcentajeGanancia) < 100)
            { 
            	
            	//Aplicar porcentaje de ganancia
				//intPrecioUnitario = intCostoUnitarioReal / ((100 - intPorcentajeGanancia) /100);
				//Concatenar valor fijo 1.
				intPorcentajeGanancia = '1.'+intPorcentajeGanancia;
			    //Convertir cadena de texto a decimal
				intPorcentajeGanancia = parseFloat(intPorcentajeGanancia);
				//Aplicar porcentaje de ganancia
				intPrecioUnitario = intCostoUnitarioReal * intPorcentajeGanancia;

				//Convertir cantidad a formato moneda
				intPrecioUnitario =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDTrabajosForaneosServicio, '');
				 
				//Asignar precio unitario con porcentaje de ganancia
				$('#txtPrecioUnitario_detalles_trabajos_foraneos_servicio').val(intPrecioUnitario);
            }
            else
            {
            	//Limpiar caja de texto
            	$('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').val('');
            }
		}


		//Función para calcular totales de la tabla
		function calcular_totales_detalles_trabajos_foraneos_servicio()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_trabajos_foraneos_servicio').getElementsByTagName('tbody')[0];

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
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, intNumDecimalesCantidadBDTrabajosForaneosServicio, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, intNumDecimalesDescUnitBDTrabajosForaneosServicio, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarTrabajosForaneosServicio, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, intNumDecimalesMostrarTrabajosForaneosServicio, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, intNumDecimalesMostrarTrabajosForaneosServicio, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, intNumDecimalesMostrarTrabajosForaneosServicio, '');

			//Asignar los valores
			$('#acumCantidad_detalles_trabajos_foraneos_servicio').html(intAcumUnidades);
			$('#acumDescuento_detalles_trabajos_foraneos_servicio').html(intAcumDescuento);
			$('#acumSubtotal_detalles_trabajos_foraneos_servicio').html(intAcumSubtotal);
			$('#acumIva_detalles_trabajos_foraneos_servicio').html(intAcumIva);
			$('#acumIeps_detalles_trabajos_foraneos_servicio').html(intAcumIeps);
			$('#acumTotal_detalles_trabajos_foraneos_servicio').html(intAcumTotal);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTotalUnidades_trabajos_foraneos_servicio').numeric();
			$('#txtImporteTotal_trabajos_foraneos_servicio').numeric();
			$('#txtCantidad_detalles_trabajos_foraneos_servicio').numeric();
        	$('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_trabajos_foraneos_servicio').blur(function(){
				$('.moneda_trabajos_foraneos_servicio').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarTrabajosForaneosServicio });
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_trabajos_foraneos_servicio').blur(function(){
                $('.cantidad_trabajos_foraneos_servicio').formatCurrency({ roundToDecimalPlace: intNumDecimalesCantidadBDTrabajosForaneosServicio });
            });

              /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.porcentaje_trabajos_foraneos_servicio').blur(function(){
                $('.porcentaje_trabajos_foraneos_servicio').formatCurrency({ roundToDecimalPlace: intNumDecimalesDescUnitBDTrabajosForaneosServicio });
            });


			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_trabajos_foraneos_servicio').datetimepicker({format: 'DD/MM/YYYY'});

	        //Autocomplete para recuperar los datos de una orden de reparación interna 
	        $('#txtOrdenReparacion_trabajos_foraneos_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtOrdenReparacionID_trabajos_foraneos_servicio').val('');
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
	              $('#txtOrdenReparacionID_trabajos_foraneos_servicio').val(ui.item.data);
	              $('#txtProspecto_trabajos_foraneos_servicio').val(ui.item.prospecto);
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
	        $('#txtOrdenReparacion_trabajos_foraneos_servicio').focusout(function(e){
	            //Si no existe id de la orden de reparación interna
	            if($('#txtOrdenReparacionID_trabajos_foraneos_servicio').val() == '' ||
	               $('#txtOrdenReparacion_trabajos_foraneos_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtOrdenReparacionID_trabajos_foraneos_servicio').val('');
	               $('#txtOrdenReparacion_trabajos_foraneos_servicio').val('');
	               $('#txtProspecto_trabajos_foraneos_servicio').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una orden de compra 
	        $('#txtOrdenCompra_trabajos_foraneos_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtOrdenCompraID_trabajos_foraneos_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos de la orden de compra
	               inicializar_orden_compra_trabajos_foraneos_servicio();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/ordenes_compra_servicio/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intOrdenReparacionID:  $('#txtOrdenReparacionID_trabajos_foraneos_servicio').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	              //Asignar id del registro seleccionado
	              $('#txtOrdenCompraID_trabajos_foraneos_servicio').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos de la orden de compra
	               get_datos_orden_compra_trabajos_foraneos_servicio();

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
			//Verificar que exista id de la orden de compra cuando pierda el enfoque la caja de texto
	        $('#txtOrdenCompra_trabajos_foraneos_servicio').focusout(function(e){
	            //Si no existe id de la orden de compra
	            if($('#txtOrdenCompraID_trabajos_foraneos_servicio').val() == '' ||
	               $('#txtOrdenCompra_trabajos_foraneos_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtOrdenCompraID_trabajos_foraneos_servicio').val('');
	               $('#txtOrdenCompra_trabajos_foraneos_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos de la orden de compra
	               inicializar_orden_compra_trabajos_foraneos_servicio();
	            }

            	//Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al detalle de la orden de compra
				habilitar_elementos_orden_compra_detalles_trabajos_foraneos_servicio('#txtOrdenCompra_trabajos_foraneos_servicio');
	        });

	        //Autocomplete para recuperar los datos de un producto o servicio
	        $('#txtProductoServicio_detalles_trabajos_foraneos_servicio').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtProductoServicioID_detalles_trabajos_foraneos_servicio').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_productos_servicios/autocomplete",
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
	               $('#txtProductoServicioID_detalles_trabajos_foraneos_servicio').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id del producto cuando pierda el enfoque la caja de texto
	        $('#txtProductoServicio_detalles_trabajos_foraneos_servicio').focusout(function(e){
	            //Si no existe id del producto
	            if($('#txtProductoServicioID_detalles_trabajos_foraneos_servicio').val() == '' ||
	               $('#txtProductoServicio_detalles_trabajos_foraneos_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProductoServicioID_detalles_trabajos_foraneos_servicio').val('');
	               $('#txtProductoServicio_detalles_trabajos_foraneos_servicio').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una unidad
	        $('#txtUnidad_detalles_trabajos_foraneos_servicio').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtUnidadID_detalles_trabajos_foraneos_servicio').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_unidades/autocomplete",
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
	               $('#txtUnidadID_detalles_trabajos_foraneos_servicio').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la unidad cuando pierda el enfoque la caja de texto
	        $('#txtUnidad_detalles_trabajos_foraneos_servicio').focusout(function(e){
	            //Si no existe id de la unidad
	            if($('#txtUnidadID_detalles_trabajos_foraneos_servicio').val() == '' ||
	               $('#txtUnidad_detalles_trabajos_foraneos_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUnidadID_detalles_trabajos_foraneos_servicio').val('');
	               $('#txtUnidad_detalles_trabajos_foraneos_servicio').val('');
	            }
	            
	        });

			//Validar que exista producto o servicio SAT cuando se pulse la tecla enter 
			$('#txtProductoServicio_detalles_trabajos_foraneos_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe producto o servicio SAT
		            if($('#txtProductoServicioID_detalles_trabajos_foraneos_servicio').val() == '' || $('#txtProductoServicio_detalles_trabajos_foraneos_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtProductoServicio_detalles_trabajos_foraneos_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtUnidad_detalles_trabajos_foraneos_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista unidad SAT cuando se pulse la tecla enter 
			$('#txtUnidad_detalles_trabajos_foraneos_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe unidad SAT
		            if($('#txtUnidadID_detalles_trabajos_foraneos_servicio').val() == '' || $('#txtUnidad_detalles_trabajos_foraneos_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtUnidad_detalles_trabajos_foraneos_servicio').focus();
			   	    }
			   	    else
			   	    {
						//Enfocar caja de texto
					    $('#txtCantidad_detalles_trabajos_foraneos_servicio').focus();
					  
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_trabajos_foraneos_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_trabajos_foraneos_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_trabajos_foraneos_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').focus();
			   	    }
		        }
		    });

	
		    //Bloque de código para modificar el precio unitario del registro
	        $('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').focusout(function(e){
	            
	            //Hacer un llamado a la función para calcular el precio unitario con porcentaje de ganancia
	            calcular_precio_unitario_detalles_trabajos_foraneos_servicio();

	        });

		    //Validar que exista porcentaje de ganancia cuando se pulse la tecla enter 
			$('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeGanancia_detalles_trabajos_foraneos_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para calcular el precio unitario con porcentaje de ganancia
	           			calcular_precio_unitario_detalles_trabajos_foraneos_servicio();

						//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_detalles_trabajos_foraneos_servicio();
			   	    }
		        }
		    });

			
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_trabajos_foraneos_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_trabajos_foraneos_servicio').datetimepicker({format: 'DD/MM/YYYY',
			 																		                            useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_trabajos_foraneos_servicio').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_trabajos_foraneos_servicio').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_trabajos_foraneos_servicio').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_trabajos_foraneos_servicio').data('DateTimePicker').maxDate(e.date);
			});
			
			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedorBusq_trabajos_foraneos_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorIDBusq_trabajos_foraneos_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/proveedores/autocomplete",
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
	             $('#txtProveedorIDBusq_trabajos_foraneos_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del proveedor cuando pierda el enfoque la caja de texto
	        $('#txtProveedorBusq_trabajos_foraneos_servicio').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorIDBusq_trabajos_foraneos_servicio').val() == '' ||
	               $('#txtProveedorBusq_trabajos_foraneos_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorIDBusq_trabajos_foraneos_servicio').val('');
	               $('#txtProveedorBusq_trabajos_foraneos_servicio').val('');
	            }

	        });

	        //Paginación de registros
			$('#pagLinks_trabajos_foraneos_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaTrabajosForaneosServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_trabajos_foraneos_servicio();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_trabajos_foraneos_servicio').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_trabajos_foraneos_servicio();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_trabajos_foraneos_servicio').addClass("estatus-NUEVO");
				//Abrir modal
				objTrabajosForaneosServicio = $('#TrabajosForaneosServicioBox').bPopup({
											   appendTo: '#TrabajosForaneosServicioContent', 
				                               contentContainer: 'TrabajosForaneosServicioM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#txtOrdenReparacion_trabajos_foraneos_servicio').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_trabajos_foraneos_servicio').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_trabajos_foraneos_servicio();
		});
	</script>