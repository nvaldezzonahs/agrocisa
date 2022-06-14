<div id="EntradasMaquinariaCompraMaquinariaContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_entradas_maquinaria_compra_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_entradas_maquinaria_compra_maquinaria">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_entradas_maquinaria_compra_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_entradas_maquinaria_compra_maquinaria"
			                    		name= "strFechaInicialBusq_entradas_maquinaria_compra_maquinaria" 
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
							<label for="txtFechaFinalBusq_entradas_maquinaria_compra_maquinaria">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_entradas_maquinaria_compra_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_entradas_maquinaria_compra_maquinaria"
			                    		name= "strFechaFinalBusq_entradas_maquinaria_compra_maquinaria" 
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
				<!--Proveedor-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtProveedorBusq_entradas_maquinaria_compra_maquinaria">Proveedor</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtProveedorIDBusq_entradas_maquinaria_compra_maquinaria" 
									name="strProveedorIDBusq_entradas_maquinaria_compra_maquinaria" 
									type="hidden" />
							<input  class="form-control" 
									id="txtProveedorBusq_entradas_maquinaria_compra_maquinaria" 
									name="strProveedorBusq_entradas_maquinaria_compra_maquinaria" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese proveedor" />
						</div>
					</div>
				</div>

				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="cmbEstatusBusq_entradas_maquinaria_compra_maquinaria">Estatus</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="cmbEstatusBusq_entradas_maquinaria_compra_maquinaria" 
							 		name="strEstatusBusq_entradas_maquinaria_compra_maquinaria" tabindex="1">
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
								<label for="txtBusqueda_entradas_maquinaria_compra_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_entradas_maquinaria_compra_maquinaria" 
										name="strBusqueda_entradas_maquinaria_compra_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_entradas_maquinaria_compra_maquinaria" 
									   	name="strImprimirDetalles_entradas_maquinaria_compra_maquinaria" 
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
							<button class="btn btn-primary" id="btnBuscar_entradas_maquinaria_compra_maquinaria"
									onclick="paginacion_entradas_maquinaria_compra_maquinaria();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_entradas_maquinaria_compra_maquinaria" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_entradas_maquinaria_compra_maquinaria"
									onclick="reporte_entradas_maquinaria_compra_maquinaria();" title="Generar reporte PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_entradas_maquinaria_compra_maquinaria"
									onclick="descargar_xls_entradas_maquinaria_compra_maquinaria();" title="Descargar archivo XLS" tabindex="1" disabled>
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
			td.movil:nth-of-type(3):before {content: "Orden de compra"; font-weight: bold;}
			td.movil:nth-of-type(4):before {content: "Proveedor"; font-weight: bold;}
			td.movil:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
			td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_entradas_maquinaria_compra_maquinaria">
				<thead class="movil">
					<tr class="movil">
						<th class="movil">Folio</th>
						<th class="movil">Fecha</th>
						<th class="movil">Orden de compra</th>
						<th class="movil">Proveedor</th>
						<th class="movil">Estatus</th>
						<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
					</tr>
				</thead>
				<tbody class="movil"></tbody>
				<script id="plantilla_entradas_maquinaria_compra_maquinaria" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil">{{folio}}</td>
						<td class="movil">{{fecha}}</td>
						<td class="movil">{{folio_orden_compra}}</td>
						<td class="movil">{{proveedor}}</td>
						<td class="movil">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_entradas_maquinaria_compra_maquinaria({{movimiento_maquinaria_id}},'Editar')"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_entradas_maquinaria_compra_maquinaria({{movimiento_maquinaria_id}},'Ver')"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_entradas_maquinaria_compra_maquinaria({{movimiento_maquinaria_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_entradas_maquinaria_compra_maquinaria({{movimiento_maquinaria_id}},'{{estatus}}')" title="Desactivar">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
									onclick="cambiar_estatus_entradas_maquinaria_compra_maquinaria({{movimiento_maquinaria_id}},'{{estatus}}')"  title="Restaurar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_entradas_maquinaria_compra_maquinaria"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_entradas_maquinaria_compra_maquinaria">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!-- Diseño del modal-->
	<div id="EntradasMaquinariaCompraMaquinariaBox" class="ModalBody"  tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_entradas_maquinaria_compra_maquinaria"  class="ModalBodyTitle">
		<h1>Entrada de maquinaria por compra</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmEntradasMaquinariaCompraMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmEntradasMaquinariaCompraMaquinaria"  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!-- Folio -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtMovimientoMaquinariaID_entradas_maquinaria_compra_maquinaria" 
									   name="intMovimientoCajaHerramientas_entradas_maquinaria_compra_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtFolio_entradas_maquinaria_compra_maquinaria">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
								        id="txtFolio_entradas_maquinaria_compra_maquinaria" 
										name="strFolio_entradas_maquinaria_compra_maquinaria" 
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
								<label for="txtFecha_entradas_maquinaria_compra_maquinaria">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_entradas_maquinaria_compra_maquinaria'>
				                    <input class="form-control" 
				                    		id="txtFecha_entradas_maquinaria_compra_maquinaria"
				                    		name= "strFecha_entradas_maquinaria_compra_maquinaria" 
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
					  <!--Autocomplete que contiene las ordenes de compra autorizadas-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de compra seleccionada-->
								<input id="txtOrdenCompraID_entradas_maquinaria_compra_maquinaria" 
									   name="intOrdenCompraID_entradas_maquinaria_compra_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtOrdenCompra_entradas_maquinaria_compra_maquinaria">Orden de compra</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtOrdenCompra_entradas_maquinaria_compra_maquinaria" 
										name="strOrdenCompra_entradas_maquinaria_compra_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese orden de compra" 
										maxlength="250" />			
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Proveedor -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
								<input id="txtProveedorID_entradas_maquinaria_compra_maquinaria" 
									   name="intProveedorID_entradas_maquinaria_compra_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtProveedor_entradas_maquinaria_compra_maquinaria">Proveedor</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtProveedor_entradas_maquinaria_compra_maquinaria" 
										name="strProveedor_entradas_maquinaria_compra_maquinaria" 
										type="text" 
										value="" disabled />			
							</div>
						</div>
					</div>
					<!-- Observaciones -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtObservaciones_entradas_maquinaria_compra_maquinaria">Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_entradas_maquinaria_compra_maquinaria" 
										name="strObservaciones_entradas_maquinaria_compra_maquinaria" 
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
					<!-- Chofer -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del chofer seleccionado-->
								<input id="txtChoferID_entradas_maquinaria_compra_maquinaria" 
									   name="intChoferID_entradas_maquinaria_compra_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtChofer_entradas_maquinaria_compra_maquinaria">Chofer</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtChofer_entradas_maquinaria_compra_maquinaria" 
										name="strChofer_entradas_maquinaria_compra_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese chofer" 
										maxlength="100" />			
							</div>
						</div>
					</div>
					<!-- Vehículo -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del Vehiculo seleccionado-->
								<input id="txtVehiculoID_entradas_maquinaria_compra_maquinaria" 
									   name="intVehiculoID_entradas_maquinaria_compra_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtVehiculo_entradas_maquinaria_compra_maquinaria">Vehículo</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtVehiculo_entradas_maquinaria_compra_maquinaria" 
										name="strVehiculo_entradas_maquinaria_compra_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese vehículo" 
										maxlength="100" />			
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
								<input id="txtNumDetalles_entradas_maquinaria_compra_maquinaria" 
							   		name="intNumDetalles_entradas_maquinaria_compra_maquinaria" type="hidden" value="">
								</input>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Detalles de la entrada</h4>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Código-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el renglón seleccionado -->
																<input id="txtRenglon_detalles_entradas_maquinaria_compra_maquinaria" 
																	   name="intRenglon_detalles_entradas_maquinaria_compra_maquinaria" 
																	   type="hidden" 
																	   value="" />	   
																<label for="txtCodigo_detalles_entradas_maquinaria_compra_maquinaria">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_detalles_entradas_maquinaria_compra_maquinaria" 
																		name="strCodigo_detalles_entradas_maquinaria_compra_maquinaria" 
																		type="text" 
																		value="" 
																		tabindex="1"
																		placeholder="Ingrese código" 
																		maxlength="30" />
															</div>
														</div>
													</div>
													<!--Descripción-->
													<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDescripcion_detalles_entradas_maquinaria_compra_maquinaria">Descripción</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtDescripcion_detalles_entradas_maquinaria_compra_maquinaria" 
																		name="strDescripcion_detalles_entradas_maquinaria_compra_maquinaria" 
																		type="text" 
																		value="" 
																		tabindex="1" 
																		placeholder="Ingrese descripción" 
																		maxlength="50" />
															</div>
														</div>
													</div>
													<!--Consignación-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbConsignacion_detalles_entradas_maquinaria_compra_maquinaria">Consignación</label>
															</div>
															<div class="col-md-12">
																<select class="form-control" id="cmbConsignacion_detalles_entradas_maquinaria_compra_maquinaria" 
																 		name="strConsignacion_detalles_entradas_maquinaria_compra_maquinaria" tabindex="1">
																    <option value="SI">SI</option>
									                                <option value="NO">NO</option>
							                     				</select>
															</div>
														</div>
													</div>
												</div>
											</div>	
										</div>
										<div class="row">
											<!--Serie-->
											<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<label for="txtSerie_detalles_entradas_maquinaria_compra_maquinaria">Serie</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control cantidad" 
																id="txtSerie_detalles_entradas_maquinaria_compra_maquinaria" 
																name="strSerie_detalles_entradas_maquinaria_compra_maquinaria" 
																type="text" 
																value="" 
																tabindex="1" 
																placeholder="Ingrese serie" 
																maxlength="50" />
													</div>
												</div>
											</div>
											<!--Motor-->
											<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<label for="txtMotor_detalles_entradas_maquinaria_compra_maquinaria">Motor</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control cantidad" 
																id="txtMotor_detalles_entradas_maquinaria_compra_maquinaria" 
																name="strMotor_detalles_entradas_maquinaria_compra_maquinaria" 
																type="text" 
																value="" 
																tabindex="1" 
																placeholder="Ingrese motor" 
																maxlength="50" />
													</div>
												</div>
											</div>	
											<!--Pedimiento-->
											<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<label for="txtPedimiento_detalles_entradas_maquinaria_compra_maquinaria">Pedimiento</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control cantidad" 
																id="txtPedimiento_detalles_entradas_maquinaria_compra_maquinaria" 
																name="strPedimiento_detalles_entradas_maquinaria_compra_maquinaria" 
																type="text" 
																value="" 
																tabindex="1" 
																placeholder="21 caracteres obligatorios" 
																maxlength="21" />
													</div>
												</div>
											</div>
											<!--Botones de acción (GRID)-->
											<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
												<div id="ToolBtns" class="btn-group btn-toolBtns">
													<!-- Agregar renglón -->
													<button class="btn btn-primary" 
															id="btnAgregar_entradas_maquinaria_compra_maquinaria"
															onclick="agregar_renglon_detalles_entradas_maquinaria_compra_maquinaria();" 
															title="Agregar" tabindex="1"> 
														<span class="glyphicon glyphicon-plus"></span>
													</button>
													<!-- Agregar aditamentos a un renglón -->
													<button class="btn btn-info"  
															id="btnAditamentos_entradas_maquinaria_compra_maquinaria" 
															title="Aditamentos" 
															tabindex="1">
														<span class="glyphicon glyphicon-cog"></span>
													</button>  
												</div>
											</div>
										</div>
										<div class="row">
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_entradas_maquinaria_compra_maquinaria">
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
														<tfoot class="movil">
														</tfoot>
													</table>
													<br>
													<div class="row">
														<!--Número de registros encontrados-->
														<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
															<button class="btn btn-default btn-sm disabled pull-right">
																<strong id="numElementos_detalles_entradas_maquinaria_compra_maquinaria">0</strong> encontrados
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
						<button class="btn btn-info" 
								id="btnReiniciar_entradas_maquinaria_compra_maquinaria"  
								onclick="nuevo_entradas_maquinaria_compra_maquinaria('Nuevo');"  
								title="Nuevo registro" 
								tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" 
								id="btnGuardar_entradas_maquinaria_compra_maquinaria"  
								onclick="validar_entradas_maquinaria_compra_maquinaria();"  
								title="Guardar" 
								tabindex="2" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_entradas_maquinaria_compra_maquinaria"  
								onclick="reporte_registro_entradas_maquinaria_compra_maquinaria('');"  
								title="Imprimir" 
								tabindex="5" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" 
								id="btnDesactivar_entradas_maquinaria_compra_maquinaria"  
								onclick="cambiar_estatus_entradas_maquinaria_compra_maquinaria('','ACTIVO');"  
								title="Desactivar" 
								tabindex="6" disabled>
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Restaurar registro-->
						<button class="btn btn-default" id="btnRestaurar_entradas_maquinaria_compra_maquinaria"  
								onclick="cambiar_estatus_entradas_maquinaria_compra_maquinaria('','INACTIVO');"  title="Restaurar" tabindex="9" disabled>
							<span class="fa fa-exchange"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  
								id="btnCerrar_entradas_maquinaria_compra_maquinaria"
								type="reset" 
								aria-hidden="true" 
								onclick="cerrar_entradas_maquinaria_compra_maquinaria();" 
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
	<div id="AditamentosEntradasMaquinariaCompraMaquinariaBox" class="ModalBody" tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModalSecundario_entradas_maquinaria_compra_maquinaria" class="ModalBodyTitle">
			<h1>Captura de aditamentos</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmAditamentosEntradasMaquinariaCompraMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmAditamentosEntradasMaquinariaCompraMaquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
				  	<!--Código-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el renglón seleccionado -->	
								<label for="txtCodigoAditamentos_entradas_maquinaria_compra_maquinaria">Código</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtCodigoAditamentos_entradas_maquinaria_compra_maquinaria" 
										name="strCodigoAditamentos_entradas_maquinaria_compra_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtDescripcionAditamentos_entradas_maquinaria_compra_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtDescripcionAditamentos_entradas_maquinaria_compra_maquinaria" 
										name="strDescripcionAditamentos_entradas_maquinaria_compra_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Serie-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtSerieAditamentos_entradas_maquinaria_compra_maquinaria">Serie</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSerieAditamentos_entradas_maquinaria_compra_maquinaria" 
										name="strSerieAditamentos_entradas_maquinaria_compra_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Motor-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtMotorAditamentos_entradas_maquinaria_compra_maquinaria">Motor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtMotorAditamentos_entradas_maquinaria_compra_maquinaria" 
										name="strMotorAditamentos_entradas_maquinaria_compra_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<input id="txtRenglonAditamentosID_entradas_maquinaria_compra_maquinaria" 
									   name="strRenglonAditamentosID_entradas_maquinaria_compra_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtCantidadAditamentos_entradas_maquinaria_compra_maquinaria">
									Cantidad
								</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
									id="txtCantidadAditamentos_entradas_maquinaria_compra_maquinaria" 
									name="txtCantidadAditamentos_entradas_maquinaria_compra_maquinaria" 
									type="text" value="" 
									placeholder="Ingrese cantidad" />
							</div>	
						</div>
					</div>
					<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtDescAditamentos_entradas_maquinaria_compra_maquinaria">
									Descripción
								</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
									id="txtDescAditamentos_entradas_maquinaria_compra_maquinaria" 
									name="strDescAditamentos_entradas_maquinaria_compra_maquinaria" 
									type="text" value="" 
									placeholder="Ingrese descripción" />
							</div>
						</div>
					</div>
					<!--Botón para Agregar Pregunta-->
					<div class="col-sm-1 col-md-1 col-lg-1 col-xs-12">
						<div class="pull-right">
							<button class="btn btn-primary btn-toolBtns" 
									id="btnAgregarAditamentos_entradas_maquinaria_compra_maquinaria" 
									onclick="agregar_renglon_aditamentos_detalles_entradas_maquinaria_compra_maquinaria();" 
									title="Agregar aditamento">
								<span class="glyphicon glyphicon-plus"></span>
							</button>
						</div>	
					</div>
				</div>
				<!--Cierre row-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<!-- Diseño de la tabla-->
									<table class="table-hover" id="dg_aditamentos_detalles_entradas_maquinaria_compra_maquinaria">
										<thead>
											<tr>
												<th>Cantidad</th>
												<th>Descripción</th>
												<th style="width:10em; text-align: center;">Acciones</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
									<br>
									<div class="row">
										<!--Número de registros encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_detalles_aditamentos_entradas_maquinaria_compra_maquinaria">0</strong> encontrados
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
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_respuestas_entradas_maquinaria_compra_maquinaria"  
								onclick="guardar_aditamentos_detalles_entradas_maquinaria_compra_maquinaria();"  title="Guardar">
							<span class="fa fa-floppy-o"></span>
						</button>  
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_respuestas_entradas_maquinaria_compra_maquinaria"
								type="reset" aria-hidden="true" onclick="cerrar_aditamentos_entradas_maquinaria_compra_maquinaria();" title="Cerrar">
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

</div><!--#EntradasMaquinariaCompraMaquinariaContent -->


<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variable que se utiliza para asignar el id del movimiento de maquinaria por compra
	var intMovimientoIDEntradasMaquinariaCompraMaquinaria = <?php echo ENTRADA_MAQUINARIA_COMPRA ?>;
	//Variables que se utilizan para la paginación de registros
	var intPaginaEntradasMaquinariaCompraMaquinaria = 0;
	var strUltimaBusquedaEntradasMaquinariaCompraMaquinaria = "";
	//Variables que se utilizan para la búsqueda de registros
	var intProveedorIDEntradasMaquinariaCompraMaquinaria = "";
	var dteFechaInicialEntradasMaquinariaCompraMaquinaria = "";
	var dteFechaFinalEntradasMaquinariaCompraMaquinaria = "";
	//Variable que se utiliza para asignar objeto del modal
	var objEntradasMaquinariaCompraMaquinaria = null;
	//Variable que se utiliza para asignar objeto del modal secundario
	var objAditamentosEntradasMaquinariaCompraMaquinaria = null;

	/*******************************************************************************************************************
	Funciones del objeto Entrada
	*********************************************************************************************************************/
	// Constructor de Entrada
	var objEntrada;
	function Entrada(id, sucursalID, tipoMovimiento, folio, fecha, monedaID, tipoCambio, referenciaID, proveedorID, 
					  observaciones, choferID, vehiculoID, maquinarias)
	{
	    this.intMovimientoMaquinariaID = id;
	    this.intSucursalID = sucursalID;
	    this.strTipoMovimiento = tipoMovimiento;
	    this.strFolio = folio;
	    this.strFecha = fecha;
	    this.intMonedaID = monedaID;
	    this.numTipoCambio = tipoCambio;
	    this.intReferenciaID = referenciaID;
	    this.intProveedorID = proveedorID;
	    this.intChoferID = choferID;
	    this.intVehiculoID = vehiculoID;
	    this.strObservaciones = observaciones;
	    this.arrMaquinarias = maquinarias;
	}
	// --------------------- MÉTODOS PARA EL OBJETO ENTRADA ------------------------------------------------------------
	Entrada.prototype.setID = function(id) { this.intMovimientoMaquinariaID = id; }
	Entrada.prototype.getID = function() { return this.intMovimientoMaquinariaID; }
	Entrada.prototype.setSucursalID = function(sucursalID) { this.intSucursalID = sucursalID; }
	Entrada.prototype.getSucursalID = function() { return this.intSucursalID; }
	Entrada.prototype.setTipoMovimiento = function(tipoMovimiento) { this.strTipoMovimiento = tipoMovimiento; }
	Entrada.prototype.getTipoMovimiento = function() { return this.strTipoMovimiento; }
	Entrada.prototype.setFolio = function(folio) { this.strFolio = folio; }
	Entrada.prototype.getFolio = function() { return this.strFolio; }
	Entrada.prototype.setFecha = function(fecha) { this.strFecha = fecha; }
	Entrada.prototype.getFecha = function() { return this.strFecha; }
	Entrada.prototype.setMonedaID = function(monedaID) { this.intMonedaID = monedaID; }
	Entrada.prototype.getMonedaID = function() { return this.intMonedaID; }
	Entrada.prototype.setTipoCambio = function(tipoCambio) { this.numTipoCambio = tipoCambio; }
	Entrada.prototype.getTipoCambio = function() { return this.numTipoCambio; }
	Entrada.prototype.setReferenciaID = function(referenciaID) { this.intReferenciaID = referenciaID; }
	Entrada.prototype.getReferenciaID = function() { return this.intReferenciaID; }
	Entrada.prototype.setProveedorID = function(proveedorID) { this.intProveedorID = proveedorID; }
	Entrada.prototype.getProveedorID = function() { return this.intProveedorID; }
	Entrada.prototype.setChoferID = function(choferID) { this.intChoferID = choferID; }
	Entrada.prototype.getChoferID = function() { return this.intChoferID; }
	Entrada.prototype.setVehiculoID = function(vehiculoID) { this.intVehiculoID = vehiculoID; }
	Entrada.prototype.getVehiculoID = function() { return this.intVehiculoID; }
	Entrada.prototype.setObservaciones = function(observaciones) { this.strObservaciones = observaciones; }
	Entrada.prototype.getObservaciones = function() { return this.strObservaciones; }
	// -------------------- FUNCIONES ASOCIADAS AL ATRIBUTO MAQUINARIAS ---------------------------------------------------
	//Función para agregar todas las maquinarias al objeto Entrada
	Entrada.prototype.setMaquinarias = function(maquinarias) { this.arrMaquinarias = maquinarias; }
	//Función para obtener todas las maquinarias del objeto Entrada
	Entrada.prototype.getMaquinarias = function() { return this.arrMaquinarias; }
	//Función para agregar una maquinaria al objeto Entrada
	Entrada.prototype.setMaquinaria = function (maquinaria){ this.arrMaquinarias.push(maquinaria); }
	//Función para obtener una maquinaria del objeto Entrada
	Entrada.prototype.getMaquinaria = function(index) { return this.arrMaquinarias[index]; }
	//Función para modificar un objeto maquinaria del objeto Entrada
	Entrada.prototype.updateMaquinaria = function (index, maquinaria){ this.arrMaquinarias[index] = maquinaria; }
	//Función para eliminar una maquinaria del objeto Entrada
	Entrada.prototype.deleteMaquinaria = function (index){
		if(index != -1) {
			this.arrMaquinarias.splice(index, 1);
		}
	}
	//Función para cambiar las posiciones de las preguntas en el Objeto Encuesta
	Entrada.prototype.swap = function(index_A, index_B) {
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
	function Maquinaria(id, renglon, maquinariaDescripcionID, codigo, descripcionCorta, descripcion, serie, motor, consignacion, pedimento, aditamentos)
	{
	    this.intMovimientoMaquinariaID = id;
	    this.intRenglon = renglon;
	    this.strMaquinariaDescripcionID = maquinariaDescripcionID;
	    this.strCodigo = codigo;
	    this.strDescripcionCorta = descripcionCorta;
	    this.strDescripcion = descripcion;
	    this.strSerie = serie;
	    this.strMotor = motor;
	    this.strConsignacion = consignacion;
	    this.strPedimento = pedimento;
	    this.arrAditamentos = aditamentos;
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
	Maquinaria.prototype.setConsignacion = function(consignacion) { this.strConsignacion = consignacion; }
	Maquinaria.prototype.getConsignacion = function() { return this.strConsignacion; }
	Maquinaria.prototype.setPedimento = function(pedimento) { this.strPedimento = pedimento; }
	Maquinaria.prototype.getPedimento = function() { return this.strPedimento; }
	// -------------------- FUNCIONES ASOCIADAS AL ATRIBUTO ADITAMENTOS ---------------------------------------------------
	//Función para agregar todos los aditamentos al objeto Maquinaria
	Maquinaria.prototype.setAditamentos = function(aditamentos) { this.arrAditamentos = aditamentos; }
	//Función para obtener todas los aditamentos del objeto Maquinaria
	Maquinaria.prototype.getAditamentos = function() { return this.arrAditamentos; }
	//Función para agregar una aditamento al objeto Maquinaria
	Maquinaria.prototype.setAditamento = function (aditamento){ this.arrAditamentos.push(aditamento); }
	//Función para obtener un aditamento del objeto Maquinaria
	Maquinaria.prototype.getAditamento = function(index) { return this.arrAditamentos[index]; }
	//Función para modificar un objeto aditamento del objeto Maquinaria
	Maquinaria.prototype.updateAditamento = function (index, aditamento){ this.arrAditamentos[index] = aditamento; }
	//Función para eliminar una maquinaria del objeto Entrada
	Maquinaria.prototype.deleteAditamento = function (index){
		if(index != -1) {
			this.arrAditamentos.splice(index, 1);
		}
	}
	//Función para cambiar las posiciones de los aditamentos en el Objeto Maquinaria
	Maquinaria.prototype.swap = function(index_A, index_B) {
	    var input = this.arrAditamentos;
	 
	    var temp = input[index_A];
	    input[index_A] = input[index_B];
	    input[index_B] = temp;
	}


	/*******************************************************************************************************************
	Funciones del objeto Aditamento
	*********************************************************************************************************************/
	// Constructor de Aditamento
	var objAditamento;
	function Aditamento(serie, renglon, cantidad, descripcion)
	{
	    this.strSerie = serie;
	    this.intRenglon = renglon;
	    this.intCantidad = cantidad;
	    this.strDescripcion = descripcion;
	}
	// --------------------- MÉTODOS PARA EL OBJETO MAQUINARIA ------------------------------------------------------------
	Aditamento.prototype.setSerie = function(serie) { this.strSerie = serie; }
	Aditamento.prototype.getID = function() { return this.strSerie; }
	Aditamento.prototype.setRenglon = function(renglon) { this.intRenglon = renglon; }
	Aditamento.prototype.getRenglon = function() { return this.intRenglon; }
	Aditamento.prototype.setCantidad = function(cantidad) { this.intCantidad = cantidad; }
	Aditamento.prototype.getCantidad = function() { return this.intCantidad; }
	Aditamento.prototype.setDescripcion = function(descripcion) { this.strDescripcion = descripcion; }
	Aditamento.prototype.getDescripcion = function() { return this.strDescripcion; }

	//Función para crear un nuevo objeto de tipo Encuesta
	function nuevo_objeto_entrada(){

		// Crear un Objeto de tipo Entrada
		objEntrada = new Entrada(null, null, '', '', '', null, null, null, null, '', null, null, []);

	}

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_entradas_maquinaria_compra_maquinaria()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('maquinaria/entradas_maquinaria_compra/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_entradas_maquinaria_compra_maquinaria').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosEntradasMaquinariaCompraMaquinaria = data.row;
				//Separar la cadena 
				var arrPermisosEntradasMaquinariaCompraMaquinaria = strPermisosEntradasMaquinariaCompraMaquinaria.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosEntradasMaquinariaCompraMaquinaria.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosEntradasMaquinariaCompraMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_entradas_maquinaria_compra_maquinaria').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosEntradasMaquinariaCompraMaquinaria[i]=='GUARDAR') || (arrPermisosEntradasMaquinariaCompraMaquinaria[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_entradas_maquinaria_compra_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosEntradasMaquinariaCompraMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_entradas_maquinaria_compra_maquinaria').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_entradas_maquinaria_compra_maquinaria();
					}
					else if(arrPermisosEntradasMaquinariaCompraMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_entradas_maquinaria_compra_maquinaria').removeAttr('disabled');
						$('#btnRestaurar_entradas_maquinaria_compra_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosEntradasMaquinariaCompraMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_entradas_maquinaria_compra_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosEntradasMaquinariaCompraMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_entradas_maquinaria_compra_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosEntradasMaquinariaCompraMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_entradas_maquinaria_compra_maquinaria').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_entradas_maquinaria_compra_maquinaria() 
	{
		//Concatenar datos para la nueva búsqueda
   		var strNuevaBusquedaEntradasMaquinariaCompraMaquinaria =($('#txtFechaInicialBusq_entradas_maquinaria_compra_maquinaria').val()+$('#txtFechaFinalBusq_entradas_maquinaria_compra_maquinaria').val()+$('#txtProveedorIDBusq_entradas_maquinaria_compra_maquinaria').val()+$('#cmbEstatusBusq_entradas_maquinaria_compra_maquinaria').val()+$('#txtBusqueda_entradas_maquinaria_compra_maquinaria').val());
   		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaEntradasMaquinariaCompraMaquinaria != strUltimaBusquedaEntradasMaquinariaCompraMaquinaria)
		{
			intPaginaEntradasMaquinariaCompraMaquinaria = 0;
			strUltimaBusquedaEntradasMaquinariaCompraMaquinaria = strNuevaBusquedaEntradasMaquinariaCompraMaquinaria;
		}
		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('maquinaria/entradas_maquinaria_compra/get_paginacion',
				{	
					//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_entradas_maquinaria_compra_maquinaria').val()),
	    			dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_entradas_maquinaria_compra_maquinaria').val()),
	    			intProveedorID: $('#txtProveedorIDBusq_entradas_maquinaria_compra_maquinaria').val(),
	    			strEstatus:     $('#cmbEstatusBusq_entradas_maquinaria_compra_maquinaria').val(),
	    			strBusqueda:    $('#txtBusqueda_entradas_maquinaria_compra_maquinaria').val(),
					intPagina:intPaginaEntradasMaquinariaCompraMaquinaria,
					strPermisosAcceso: $('#txtAcciones_entradas_maquinaria_compra_maquinaria').val()
				},
				function(data){
					$('#dg_entradas_maquinaria_compra_maquinaria tbody').empty();
					var tmpEntradasMaquinariaCompraMaquinaria = Mustache.render($('#plantilla_entradas_maquinaria_compra_maquinaria').html(),data);
					$('#dg_entradas_maquinaria_compra_maquinaria tbody').html(tmpEntradasMaquinariaCompraMaquinaria);
					$('#pagLinks_entradas_maquinaria_compra_maquinaria').html(data.paginacion);
					$('#numElementos_entradas_maquinaria_compra_maquinaria').html(data.total_rows);
					intPaginaEntradasMaquinariaCompraMaquinaria = data.pagina;
				},
		'json');
	}

	//Función para cargar el reporte general en PDF
	function reporte_entradas_maquinaria_compra_maquinaria() 
	{	
		//Asignar valores para la búsqueda de registros
		intProveedorIDEntradasMaquinariaCompraMaquinaria =  $('#txtProveedorIDBusq_entradas_maquinaria_compra_maquinaria').val();
		dteFechaInicialEntradasMaquinariaCompraMaquinaria =  $.formatFechaMysql($('#txtFechaInicialBusq_entradas_maquinaria_compra_maquinaria').val());
		dteFechaFinalEntradasMaquinariaCompraMaquinaria =  $.formatFechaMysql($('#txtFechaFinalBusq_entradas_maquinaria_compra_maquinaria').val());
		
		//Si no existe fecha inicial
		if(dteFechaInicialEntradasMaquinariaCompraMaquinaria == '')
		{
			dteFechaInicialEntradasMaquinariaCompraMaquinaria = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalEntradasMaquinariaCompraMaquinaria == '')
		{
			dteFechaFinalEntradasMaquinariaCompraMaquinaria =  '0000-00-00';
		}
		
		//Si no existe id del proveedor
		if(intProveedorIDEntradasMaquinariaCompraMaquinaria == '')
		{
			intProveedorIDEntradasMaquinariaCompraMaquinaria = 0;
		}

		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_entradas_maquinaria_compra_maquinaria').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_entradas_maquinaria_compra_maquinaria').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_entradas_maquinaria_compra_maquinaria').val('NO');
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("maquinaria/entradas_maquinaria_compra/get_reporte/"+
					dteFechaInicialEntradasMaquinariaCompraMaquinaria+"/"+
					dteFechaFinalEntradasMaquinariaCompraMaquinaria+"/"+
					intProveedorIDEntradasMaquinariaCompraMaquinaria+"/"+
					$('#cmbEstatusBusq_entradas_maquinaria_compra_maquinaria').val()+"/"+
					$('#chbImprimirDetalles_entradas_maquinaria_compra_maquinaria').val()+"/"+
					$('#txtBusqueda_entradas_maquinaria_compra_maquinaria').val());

	}

	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_entradas_maquinaria_compra_maquinaria(id)
	{	
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la impresión desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_entradas_maquinaria_compra_maquinaria').val();
		}
		else
		{
			intID = id;
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("maquinaria/entradas_maquinaria_compra/get_reporte_registro/" + intID);
	}

	//Función para descargar el archivo XLS
	function descargar_xls_entradas_maquinaria_compra_maquinaria() 
	{
		//Asignar valores para la búsqueda de registros
		intProveedorIDEntradasMaquinariaCompraMaquinaria =  $('#txtProveedorIDBusq_entradas_maquinaria_compra_maquinaria').val();
		dteFechaInicialEntradasMaquinariaCompraMaquinaria =  $.formatFechaMysql($('#txtFechaInicialBusq_entradas_maquinaria_compra_maquinaria').val());
		dteFechaFinalEntradasMaquinariaCompraMaquinaria =  $.formatFechaMysql($('#txtFechaFinalBusq_entradas_maquinaria_compra_maquinaria').val());
		
		//Si no existe fecha inicial
		if(dteFechaInicialEntradasMaquinariaCompraMaquinaria == '')
		{
			dteFechaInicialEntradasMaquinariaCompraMaquinaria = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalEntradasMaquinariaCompraMaquinaria == '')
		{
			dteFechaFinalEntradasMaquinariaCompraMaquinaria =  '0000-00-00';
		}
		
		//Si no existe id del proveedor
		if(intProveedorIDEntradasMaquinariaCompraMaquinaria == '')
		{
			intProveedorIDEntradasMaquinariaCompraMaquinaria = 0;
		}

		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_entradas_maquinaria_compra_maquinaria').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_entradas_maquinaria_compra_maquinaria').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_entradas_maquinaria_compra_maquinaria').val('NO');
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("maquinaria/entradas_maquinaria_compra/get_xls/"+
					dteFechaInicialEntradasMaquinariaCompraMaquinaria+"/"+
					dteFechaFinalEntradasMaquinariaCompraMaquinaria+"/"+
					intProveedorIDEntradasMaquinariaCompraMaquinaria+"/"+
					$('#cmbEstatusBusq_entradas_maquinaria_compra_maquinaria').val()+"/"+
					$('#chbImprimirDetalles_entradas_maquinaria_compra_maquinaria').val()+"/"+
					$('#txtBusqueda_entradas_maquinaria_compra_maquinaria').val());
	}

	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_entradas_maquinaria_compra_maquinaria(tipoAccion)
	{		
		//Incializar formulario
		$('#frmEntradasMaquinariaCompraMaquinaria')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_entradas_maquinaria_compra_maquinaria();
		//Limpiar cajas de texto ocultas
		$('#frmEntradasMaquinariaCompraMaquinaria').find('input[type=hidden]').val('');
		//Asignar la fecha actual
        $('#txtFecha_entradas_maquinaria_compra_maquinaria').val(fechaActual()); 
		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		inicializar_detalles_entradas_maquinaria_compra_maquinaria();	
		//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
		$('#divEncabezadoModal_entradas_maquinaria_compra_maquinaria').removeClass("estatus-NUEVO");
		$('#divEncabezadoModal_entradas_maquinaria_compra_maquinaria').removeClass("estatus-ACTIVO");
		$('#divEncabezadoModal_entradas_maquinaria_compra_maquinaria').removeClass("estatus-INACTIVO");
		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo' || tipoAccion == 'Editar')
		{
			//Habilitar todos los elementos del formulario
			$('#frmEntradasMaquinariaCompraMaquinaria').find('input, textarea, select').attr('disabled', false);

			if(tipoAccion == 'Nuevo'){
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_entradas_maquinaria_compra_maquinaria').addClass("estatus-NUEVO");
			}

		}
	    
	    nuevo_objeto_entrada();

	    //Deshabilitar las siguientes cajas de texto
        $('#txtFolio_entradas_maquinaria_compra_maquinaria').attr("disabled", "disabled");
        $('#txtProveedor_entradas_maquinaria_compra_maquinaria').attr("disabled", "disabled");
		//Mostrar botón Guardar
		$("#btnGuardar_entradas_maquinaria_compra_maquinaria").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_entradas_maquinaria_compra_maquinaria").hide();
		$("#btnDescargarArchivo_entradas_maquinaria_compra_maquinaria").hide();
		$("#btnDesactivar_entradas_maquinaria_compra_maquinaria").hide();
		$("#btnRestaurar_entradas_maquinaria_compra_maquinaria").hide();
		
	}
	
	//Función para inicializar elementos de la tabla detalles
	function inicializar_detalles_entradas_maquinaria_compra_maquinaria()
	{
		//Eliminar los datos de la tabla detalles del movimiento
		$('#dg_detalles_entradas_maquinaria_compra_maquinaria tbody').empty();
		$('#acumCantidad_detalles_entradas_maquinaria_compra_maquinaria').html(0);
		$('#numElementos_detalles_entradas_maquinaria_compra_maquinaria').html(0);
		$('#txtNumDetalles_entradas_maquinaria_compra_maquinaria').html('');
	}
	
	
	//Función que se utiliza para cerrar el modal
	function cerrar_entradas_maquinaria_compra_maquinaria()
	{
		try {
			//Cerrar modal
			objEntradasMaquinariaCompraMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_entradas_maquinaria_compra_maquinaria').focus();	
		}
		catch(err) {}
	}

	
	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_entradas_maquinaria_compra_maquinaria()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_entradas_maquinaria_compra_maquinaria();
		//Validación del formulario de campos obligatorios
		$('#frmEntradasMaquinariaCompraMaquinaria')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_entradas_maquinaria_compra_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
									    strOrdenCompra_entradas_maquinaria_compra_maquinaria: {
											validators: {
											    callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la orden de compra
					                                    if( $('#txtOrdenCompraID_entradas_maquinaria_compra_maquinaria').val() === '')
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
										intNumDetalles_entradas_maquinaria_compra_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para este movimiento.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCodigo_detalles_entradas_maquinaria_compra_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strDescripcion_detalles_entradas_maquinaria_compra_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intCantidad_detalles_entradas_maquinaria_compra_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strSerie_detalles_entradas_maquinaria_compra_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strMotor_detalles_entradas_maquinaria_compra_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strPedimiento_detalles_entradas_maquinaria_compra_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										}

									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_entradas_maquinaria_compra_maquinaria = $('#frmEntradasMaquinariaCompraMaquinaria').data('bootstrapValidator');
		bootstrapValidator_entradas_maquinaria_compra_maquinaria.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_entradas_maquinaria_compra_maquinaria.isValid())
		{	
			//Hacer un llamado a la función para validar que los componentes cuenten con serie
			validar_componentes_entradas_maquinaria_compra_maquinaria();				
		}
		else 
			return;
	}

	//Función que se utiliza para validar que los componentes cuenten con serie
	function validar_componentes_entradas_maquinaria_compra_maquinaria()
	{
		//Obtenemos el objeto de la tabla componentes
		var objTabla = document.getElementById('dg_detalles_entradas_maquinaria_compra_maquinaria').getElementsByTagName('tbody')[0];

		//Array que se utiliza para agregar los componentes incorrectos
		var arrDetallesIncorrectos = [];

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Variables que se utilizan para asignar valores del detalle
			var strCodigo = objRen.cells[0].innerHTML;
			var strDescripcion = objRen.cells[1].innerHTML;
			var strSerie = objRen.cells[2].innerHTML;
			//Concatenar los datos del componente
			var strComponente = strCodigo+' - '+strDescripcion;

			//Si la serie es igual a cadena vacia
			if(strSerie == '')
			{
				//Agregar refacción en el array, de esta manera, el usuario identificara los componentes incorrectos
				arrDetallesIncorrectos.push(strComponente);
			}
		}

		//Si existen componentes incorrectos
		if(arrDetallesIncorrectos.length > 0)
		{
			//Mensaje que se utiliza para informar al usuario la lista de componentes incorrectos
			var strMensaje = 'La ENTRADA POR COMPRA no puede guardarse. Los siguientes <b>componentes</b> no tienen serie:<br>';

			//Hacer recorrido para obtener componentes incorrectos
			for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
			{
				//Agregar refacción en el mensaje
        		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
			}

			//Hacer un llamado a la función para mostrar mensaje de error
			mensaje_entradas_maquinaria_compra_maquinaria('error', strMensaje);
		}
		else
		{
			//Hacer un llamado a la función para guardar los datos del registro
			guardar_entradas_maquinaria_compra_maquinaria();
		}

	}
	
	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_entradas_maquinaria_compra_maquinaria()
	{
		try
		{
			$('#frmEntradasMaquinariaCompraMaquinaria').data('bootstrapValidator').resetForm();

		}
		catch(err) {}
	}

	
	//Función para guardar o modificar los datos de un registro
	function guardar_entradas_maquinaria_compra_maquinaria()
	{	
		//Obtenemos el objeto de la tabla detalles
		objEntrada.setTipoMovimiento(intMovimientoIDEntradasMaquinariaCompraMaquinaria);
		objEntrada.setFecha( $.formatFechaMysql($('#txtFecha_entradas_maquinaria_compra_maquinaria').val()) );
		objEntrada.setObservaciones( $('#txtObservaciones_entradas_maquinaria_compra_maquinaria').val() );

		//Convenrtir al formato JSON todo lo generado en el objeto de la vista
		var jsonEntrada = JSON.stringify(objEntrada); 

		//Hacer un llamado al método del controlador para guardar los datos del registro
		$.post('maquinaria/entradas_maquinaria_compra/guardar',
		{ 
			//Datos de la entrada por compra
			strFolioConsecutivo: $('#txtFolio_entradas_maquinaria_compra_maquinaria').val(),
			entradaCompra: jsonEntrada,
			intProcesoMenuID: $('#txtProcesoMenuID_entradas_maquinaria_compra_maquinaria').val()
		},
				function(data) {

					if (data.resultado)
					{	    
	                    //Si no existe id del movimiento, significa que es un nuevo registro   
						if($('#txtMovimientoMaquinariaID_entradas_maquinaria_compra_maquinaria').val() == '')
						{
						  	//Asignar el id del movimiento registrado en la base de datos
                 			$('#txtMovimientoMaquinariaID_entradas_maquinaria_compra_maquinaria').val(data.movimiento_maquinaria_id);
                 			//Asignar folio consecutivo
                 			$('#txtFolio_entradas_maquinaria_compra_maquinaria').val(data.folio);
						} 
		                //Hacer un llamado a la función para cerrar modal
	                    cerrar_entradas_maquinaria_compra_maquinaria();
	                    //Hacer llamado a la función  para cargar  los registros en el grid
		               	paginacion_entradas_maquinaria_compra_maquinaria();        
		                	    
					}

					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_entradas_maquinaria_compra_maquinaria(data.tipo_mensaje, data.mensaje);

				},
		'json');
		
	}

	// Función para cambiar el estatus del registro seleccionado
	function cambiar_estatus_entradas_maquinaria_compra_maquinaria(id, estatus)
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_entradas_maquinaria_compra_maquinaria').val();
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
					              'title':    'Movimiento de entradas de maquinaria',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('maquinaria/entradas_maquinaria_compra/set_estatus',
					                                     {
					                                     	intMovimientoMaquinariaID: intID,
					                                      	strEstatus: estatus
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                            //Hacer llamado a la función  para cargar  los registros en el grid
					                                            paginacion_entradas_maquinaria_compra_maquinaria();
					                                            //Si el id del registro se obtuvo del modal
																if(id == '')
																{
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_entradas_maquinaria_compra_maquinaria();     
																}
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_entradas_maquinaria_compra_maquinaria(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }

					                          }

					              });
	    }
	    else//Si el estatus del registro es INACTIVO
	    {
			//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
			$.post('maquinaria/entradas_maquinaria_compra/set_estatus',
			     {
			     	intMovimientoMaquinariaID: intID,
			      	strEstatus: estatus
			     },
			     function(data) {
			      if (data.resultado)
			      {
			        //Hacer llamado a la función para cargar  los registros en el grid
			      	paginacion_entradas_maquinaria_compra_maquinaria();
			      	//Si el id del registro se obtuvo del modal
					if(id == '')
					{
						//Hacer un llamado a la función para cerrar modal
						cerrar_entradas_maquinaria_compra_maquinaria();     
					}
			      }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_entradas_maquinaria_compra_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
	    }
	}

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_entradas_maquinaria_compra_maquinaria(id, tipoAccion)
	{	
		//Hacer un llamado a la función para limpiar los campos del formulario
		nuevo_entradas_maquinaria_compra_maquinaria(tipoAccion);

		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.post('maquinaria/entradas_maquinaria_compra/get_datos',
        {
       		intMovimientoMaquinariaID:id
        },
		       function(data) {
		        	//Si hay datos del registro 
		            if(data.row)
		            {  
		            	
						//Asignar estatus del registro
				        var strEstatus = data.row.estatus;
			          	
			          	//Recuperar valores para la Vista
			            $('#txtMovimientoMaquinariaID_entradas_maquinaria_compra_maquinaria').val(data.row.movimiento_maquinaria_id);
			            $('#txtFolio_entradas_maquinaria_compra_maquinaria').val(data.row.folio);
			            $('#txtFecha_entradas_maquinaria_compra_maquinaria').val(data.row.fecha);
			            $('#txtOrdenCompraID_entradas_maquinaria_compra_maquinaria').val(data.row.referencia_id);
			            $('#txtOrdenCompra_entradas_maquinaria_compra_maquinaria').val(data.row.folio_orden_compra);
						$('#txtProveedorID_entradas_maquinaria_compra_maquinaria').val(data.row.proveedor_id);
						$('#txtProveedor_entradas_maquinaria_compra_maquinaria').val(data.row.proveedor);
						$('#txtChoferID_entradas_maquinaria_compra_maquinaria').val(data.row.chofer_id);
						$('#txtChofer_entradas_maquinaria_compra_maquinaria').val(data.row.chofer);
						$('#txtVehiculoID_entradas_maquinaria_compra_maquinaria').val(data.row.vehiculo_id);
						$('#txtVehiculo_entradas_maquinaria_compra_maquinaria').val(data.row.vehiculo);
						$('#txtObservaciones_entradas_maquinaria_compra_maquinaria').val(data.row.observaciones);

						//Asignar valores al objeto que maneja los valores de la Vista
						objEntrada.setID(data.row.movimiento_maquinaria_id);
						objEntrada.setFolio(data.row.folio);
						objEntrada.setFecha(data.row.fecha);
						objEntrada.setSucursalID(data.row.sucursal_id);
						objEntrada.setMonedaID(data.row.moneda_id);
                    	objEntrada.setTipoCambio(data.row.tipo_cambio);
						objEntrada.setReferenciaID(data.row.referencia_id);
						objEntrada.setProveedorID(data.row.proveedor_id);
						objEntrada.setChoferID(data.row.chofer_id);
						objEntrada.setVehiculoID(data.row.vehiculo_id);
						objEntrada.setObservaciones(data.row.observaciones);		            

						//Es necesario comprobar si ninguna de las maquinarias asociadas a este movimiento de entrada por compra presenta un estatus distinto a ACTIVO
						//Array que se utiliza para agregar los componentes incorrectos
						var arrDetallesIncorrectos = [];
						for (var intCon in data.detalles) 
						{
							//Variables que se utilizan para asignar valores del detalle
							var strCodigo = data.detalles[intCon].codigo;
							var strDescripcion = data.detalles[intCon].descripcion_corta;
							var strSerie = data.detalles[intCon].serie;
							var strEstatusMaq = data.detalles[intCon].estatus;

							//Concatenar los datos del componente
							var strComponente = strCodigo+' - '+strDescripcion+' - '+strSerie;
							//Si la serie es igual a cadena vacia
							if(strEstatusMaq != 'ACTIVO')
							{
								//Agregar refacción en el array, de esta manera, el usuario identificara los componentes incorrectos
								arrDetallesIncorrectos.push(strComponente);
							}
						}

						//Si existen componentes incorrectos
						if(arrDetallesIncorrectos.length > 0)
						{
							//Mensaje que se utiliza para informar al usuario la lista de componentes incorrectos
							var strMensaje = 'La ENTRADA POR COMPRA no puede editarse. Ya que las siguientes <b>maquinarias</b> presentan movimientos en el Inventario:<br>';
							//Hacer recorrido para obtener componentes incorrectos
							for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
							{
								//Agregar refacción en el mensaje
				        		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
							}
							//Deshabilitamos los componentes principales de la ENTRADA POR COMPRA
							//Deshabilitar todos los elementos del formulario
			            	$('#frmEntradasMaquinariaCompraMaquinaria').find('input, textarea, select').attr('disabled','disabled');
			            	//Ocultar los siguientes botones
			            	$("#btnReiniciar_entradas_maquinaria_compra_maquinaria").hide();
				            $("#btnGuardar_entradas_maquinaria_compra_maquinaria").hide();
							//Hacer un llamado a la función para mostrar mensaje de error
							mensaje_entradas_maquinaria_compra_maquinaria('error', strMensaje);
						}
						else
						{
							//Cargamos los detalles al Grid
						}

			           	//Mostramos los detalles del registro
			           	for (var intCon in data.detalles) 
			            {	
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_entradas_maquinaria_compra_maquinaria').getElementsByTagName('tbody')[0];
							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcionCorta = objRenglon.insertCell(1);
							var objCeldaSerie = objRenglon.insertCell(2);
							var objCeldaMotor = objRenglon.insertCell(3);
							var objCeldaAcciones = objRenglon.insertCell(4);
							var objCeldaDescripcion = objRenglon.insertCell(5);
							var objCeldaPedimento = objRenglon.insertCell(6);
							var objCeldaConsignacion = objRenglon.insertCell(7);
							var objCeldaMaquinariaID = objRenglon.insertCell(8);

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].renglon);
							objCeldaCodigo.setAttribute('class', 'movil b1');
							objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
							objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
							objCeldaDescripcionCorta.innerHTML = data.detalles[intCon].descripcion_corta;
							objCeldaSerie.setAttribute('class', 'movil b3');
							objCeldaSerie.innerHTML = data.detalles[intCon].serie;
							objCeldaMotor.setAttribute('class', 'movil b4');
							objCeldaMotor.innerHTML = data.detalles[intCon].motor;
							objCeldaAcciones.setAttribute('class', 'td-center movil b5');
							objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
														 " onclick='editar_renglon_detalles_entradas_maquinaria_compra_maquinaria(this)'>" + 
														 "<span class='glyphicon glyphicon-edit'></span></button>" + 
														 "<button class='btn btn-default btn-xs' title='Aditamentos'" +
														 " onclick='aditamentos_renglon_detalles_entradas_maquinaria_compra_maquinaria(this)'>" +
														 "<span class='glyphicon glyphicon-cog'></span></button>" + 
														 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
														 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
														 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
														 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
							objCeldaDescripcion.setAttribute('class', 'no-mostrar');
							objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
							objCeldaPedimento.setAttribute('class', 'no-mostrar');
							objCeldaPedimento.innerHTML = data.detalles[intCon].numero_pedimento;
							objCeldaConsignacion.setAttribute('class', 'no-mostrar');
							objCeldaConsignacion.innerHTML = data.detalles[intCon].consignacion;
							objCeldaMaquinariaID.setAttribute('class', 'no-mostrar');
							objCeldaMaquinariaID.innerHTML = data.detalles[intCon].maquinaria_descripcion_id;

							
							var arrAditamentos = [];
							
							if(data.detalles[intCon].aditamentos){

								var i = 0;
								for (var intAdi in data.detalles[intCon].aditamentos) 
			            		{

									objAditamento = new Aditamento(
																	data.detalles[intCon].serie, 
																	i, 
																	data.detalles[intCon].aditamentos[intAdi].cantidad, 
																	data.detalles[intCon].aditamentos[intAdi].descripcion
																   );
						        	arrAditamentos.push(objAditamento);

			            		}

			            		i++;
							}
							

							//Creamos objetos de tipo Maquinaria para cada elemento en la vista
							objMaquinaria = new Maquinaria(
															data.detalles[intCon].movimiento_maquinaria_id, 
														  	data.detalles[intCon].renglon, 
														  	data.detalles[intCon].maquinaria_descripcion_id, 
														  	data.detalles[intCon].codigo, 
														  	data.detalles[intCon].descripcion_corta, 
														  	data.detalles[intCon].descripcion, 
														  	data.detalles[intCon].serie, 
														  	data.detalles[intCon].motor, 
														  	data.detalles[intCon].consignacion, 
														  	data.detalles[intCon].numero_pedimento, 
														  	arrAditamentos
														  );

							//Agregar cada objeto de tipo Maquinaria al objeto Entrada
							objEntrada.setMaquinaria(objMaquinaria);
	
			            }

						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_entradas_maquinaria_compra_maquinaria tr").length - 1;
						$('#numElementos_detalles_entradas_maquinaria_compra_maquinaria').html(intFilas);
						$('#txtNumDetalles_entradas_maquinaria_compra_maquinaria').val(intFilas);
						//Dependiendo del estatus cambiar el color del encabezado 
			            $('#divEncabezadoModal_entradas_maquinaria_compra_maquinaria').addClass("estatus-"+strEstatus);
			            //Mostrar botón Imprimir  
			            $("#btnImprimirRegistro_entradas_maquinaria_compra_maquinaria").show();
   	
						//Si el tipo de acción corresponde a Ver
			            if(tipoAccion == 'Ver')
			            {
			            	//Deshabilitar todos los elementos del formulario
			            	$('#frmEntradasMaquinariaCompraMaquinaria').find('input, textarea, select').attr('disabled','disabled');
			            	//Ocultar los siguientes botones
				            $("#btnGuardar_entradas_maquinaria_compra_maquinaria").hide();

				            //Si el estatus del registro es INACTIVO
			            	if(strEstatus == 'INACTIVO')
			            	{
			            		//Mostrar botón Restaurar
			            		$("#btnRestaurar_entradas_maquinaria_compra_maquinaria").show();
			            	}

			            }
			            else
			            {
			            	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
				            {
				            	//Mostrar los siguientes botones  
				            	$("#btnDesactivar_entradas_maquinaria_compra_maquinaria").show();
				            }
			            }
						
		            	//Abrir modal
			            objEntradasMaquinariaCompraMaquinaria = $('#EntradasMaquinariaCompraMaquinariaBox').bPopup({
													  appendTo: '#EntradasMaquinariaCompraMaquinariaContent', 
						                              contentContainer: 'EntradasMaquinariaCompraMaquinariaM', 
						                              zIndex: 2, 
						                              modalClose: false, 
						                              modal: true, 
						                              follow: [true,false], 
						                              followEasing : "linear", 
						                              easing: "linear", 
						                              modalColor: ('#F0F0F0')});

			            //Enfocar caja de texto
						$('#txtOrdenCompra_entradas_maquinaria_compra_maquinaria').focus();
		       	    }
		       	    
		       },
		       'json');		

	}

	
	//Función para mostrar mensaje de éxito o error
	function mensaje_entradas_maquinaria_compra_maquinaria(tipoMensaje, mensaje)
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
	
	/*******************************************************************************************************************
	Funciones de la tabla detalles
	*********************************************************************************************************************/
	//Función para agregar renglón a la tabla
	function agregar_renglon_detalles_entradas_maquinaria_compra_maquinaria()
	{
		var intRenglon = $('#txtRenglon_detalles_entradas_maquinaria_compra_maquinaria').val();
		var strConsignacion = $('#cmbConsignacion_detalles_entradas_maquinaria_compra_maquinaria').val();
		var strSerie = $('#txtSerie_detalles_entradas_maquinaria_compra_maquinaria').val();
		var strMotor = $('#txtMotor_detalles_entradas_maquinaria_compra_maquinaria').val();
		var strPedimento = $('#txtPedimiento_detalles_entradas_maquinaria_compra_maquinaria').val();

		if(strSerie == ''){
			$('#txtSerie_detalles_entradas_maquinaria_compra_maquinaria').focus();
		}
		else if( strPedimento != '' && strPedimento.length < 21 ){
			$('#txtPedimiento_detalles_entradas_maquinaria_compra_maquinaria').focus();
		}
		else{

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_entradas_maquinaria_compra_maquinaria').getElementsByTagName('tbody')[0];
			
			//Revisamos si existe la descripción proporcionada, si es así, editamos los datos
			if (objTabla.rows.namedItem(intRenglon))
			{
				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strSerie = strSerie.toUpperCase();
				strMotor = strMotor.toUpperCase();
				strPedimento = strPedimento.toUpperCase();

				objTabla.rows.namedItem(intRenglon).cells[2].innerHTML = strSerie;
				objTabla.rows.namedItem(intRenglon).cells[3].innerHTML = strMotor;
				objTabla.rows.namedItem(intRenglon).cells[6].innerHTML = strPedimento;
				objTabla.rows.namedItem(intRenglon).cells[7].innerHTML = strConsignacion;

				//Editar objeto maquinaria en la vista
				//Editamos el valor del renglon ya que los indices de los arrays empiezan en 0
				var ren = intRenglon - 1;
				var objMaquinaria = new Maquinaria();
				objMaquinaria = objEntrada.getMaquinaria(ren);
				objMaquinaria.setSerie(strSerie);
				objMaquinaria.setMotor(strMotor);
				objMaquinaria.setPedimento(strPedimento);
				objMaquinaria.setConsignacion(strConsignacion);

				//Actualizar objEntrada<-objMaquinaria
				objEntrada.updateMaquinaria(ren, objMaquinaria);	
			}

			//Limpiar cajas de texto despues de agregar o modificar la información de un registro
			$('#txtCodigo_detalles_entradas_maquinaria_compra_maquinaria').val('');
			$('#txtDescripcion_detalles_entradas_maquinaria_compra_maquinaria').val('');
			$("#cmbConsignacion_detalles_entradas_maquinaria_compra_maquinaria").prop("selectedIndex", 0);
			$('#txtSerie_detalles_entradas_maquinaria_compra_maquinaria').val('');
			$('#txtMotor_detalles_entradas_maquinaria_compra_maquinaria').val('');
			$('#txtPedimiento_detalles_entradas_maquinaria_compra_maquinaria').val('');

		}

	}

	//Función para regresar los datos (al formulario) del renglón seleccionado
	function editar_renglon_detalles_entradas_maquinaria_compra_maquinaria(objRenglon)
	{
		//Asignar los valores a las cajas de texto
		$('#txtRenglon_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.getAttribute('id'));
		$('#txtCodigo_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
		$('#txtDescripcion_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);

		$('#txtSerie_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
		$('#txtMotor_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
		$('#txtPedimiento_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[6].innerHTML);
	
		if( objRenglon.parentNode.parentNode.cells[7].innerHTML != ''){ 
			$('#cmbConsignacion_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[7].innerHTML);
		}
		
		//Enfocar caja de texto
		$('#txtSerie_detalles_entradas_maquinaria_compra_maquinaria').focus();
	}

	//Función para agregar Aditamentos del renglón seleccionado
	function aditamentos_renglon_detalles_entradas_maquinaria_compra_maquinaria(objRenglon){

		//Asignar los valores a las cajas de texto
		$('#txtRenglon_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.getAttribute('id'));
		$('#txtCodigo_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
		$('#txtDescripcion_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);

		$('#txtSerie_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
		$('#txtMotor_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
		$('#txtPedimiento_detalles_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[6].innerHTML);

		nuevo_aditamentos_entradas_maquinaria_compra_maquinaria('grid');

	}

	//Función para quitar renglón de la tabla
	function eliminar_renglon_detalles_entradas_maquinaria_compra_maquinaria(objRenglon)
	{	
		//Obtener el indice del objeto renglón que se envía
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
		//Eliminar el renglón indicado
		document.getElementById("dg_detalles_entradas_maquinaria_compra_maquinaria").deleteRow(intRenglon);
	
		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_detalles_entradas_maquinaria_compra_maquinaria tr").length - 1;
		$('#numElementos_detalles_entradas_maquinaria_compra_maquinaria').html(intFilas);
		$('#txtNumDetalles_entradas_maquinaria_compra_maquinaria').val(intFilas);

		//Enfocar caja de texto
		$('#txtCodigo_detalles_entradas_maquinaria_compra_maquinaria').focus();

	}

	
	/*******************************************************************************************************************
	Funciones del modal secundario
	*********************************************************************************************************************/
	//Agregar aditamentos a una maquinaria
	function nuevo_aditamentos_entradas_maquinaria_compra_maquinaria(tipo){

		inicializar_aditamentos_detalles_entradas_maquinaria_compra_maquinaria();
		if($('#txtRenglon_detalles_entradas_maquinaria_compra_maquinaria').val() != '' || tipo == 'grid'){

			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModalSecundario_entradas_maquinaria_compra_maquinaria').addClass("estatus-NUEVO");
			//Abrir modal secundario
			 objAditamentosEntradasMaquinariaCompraMaquinaria = $('#AditamentosEntradasMaquinariaCompraMaquinariaBox').bPopup({
										   appendTo: '#EntradasMaquinariaCompraMaquinariaContent', 
			                               contentContainer: 'AditamentosEntradasMaquinariaCompraMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});
			
			//Asignar los valores que vienen del modal primario
			$('#txtCodigoAditamentos_entradas_maquinaria_compra_maquinaria').val($('#txtCodigo_detalles_entradas_maquinaria_compra_maquinaria').val()); 
			$('#txtDescripcionAditamentos_entradas_maquinaria_compra_maquinaria').val($('#txtDescripcion_detalles_entradas_maquinaria_compra_maquinaria').val());
			$('#txtSerieAditamentos_entradas_maquinaria_compra_maquinaria').val($('#txtSerie_detalles_entradas_maquinaria_compra_maquinaria').val());
			$('#txtMotorAditamentos_entradas_maquinaria_compra_maquinaria').val($('#txtMotor_detalles_entradas_maquinaria_compra_maquinaria').val());

			//Cargar aditamentos en caso de que el grid Aditamentos ya contenga información previamente guardada
			var renglonMaquinaria = $('#txtRenglon_detalles_entradas_maquinaria_compra_maquinaria').val();

			//Obtenemos el objeto Maquinaria que deseamos afectar
			//Editar objeto maquinaria en la vista
			var index = parseInt(renglonMaquinaria) - 1;
			var objMaquinaria = new Maquinaria();
			objMaquinaria = objEntrada.getMaquinaria(index); 

            var numAditamentos = objMaquinaria.getAditamentos().length;

			//Si existen Aditamentos previamente guardados
			if(numAditamentos > 0){

				//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_aditamentos_detalles_entradas_maquinaria_compra_maquinaria').getElementsByTagName('tbody')[0];

				for(i=0; i<numAditamentos; i++){

					var objAux = objMaquinaria.getAditamento(i);
					//Obtener valores
					var intRenglon = objAux.getRenglon();
					var intCantidad = objAux.getCantidad();
					var strDescripcion = objAux.getDescripcion();

					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCantidad = objRenglon.insertCell(0);
					var objCeldaDescripcion = objRenglon.insertCell(1);
					var objCeldaAcciones = objRenglon.insertCell(2);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRenglon); 
					objCeldaCantidad.setAttribute('class', 'movil b1');
					objCeldaCantidad.innerHTML = intCantidad;
					objCeldaDescripcion.setAttribute('class', 'movil b2');
					objCeldaDescripcion.innerHTML = strDescripcion;
					objCeldaAcciones.setAttribute('class', 'td-center movil b3');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_aditamentos_detalles_entradas_maquinaria_compra_maquinaria(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_aditamentos_detalles_entradas_maquinaria_compra_maquinaria(this)'>" +
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>"; 
				}	

			}

		}
		else
		{
			$('#txtCodigo_detalles_entradas_maquinaria_compra_maquinaria').focus();
		}

	}

	//Función para guardar los aditamentos de una Maquinaria
	function guardar_aditamentos_detalles_entradas_maquinaria_compra_maquinaria(){

		var renglonMaquinaria = $('#txtRenglon_detalles_entradas_maquinaria_compra_maquinaria').val();
		var strSerie = $('#txtSerieAditamentos_entradas_maquinaria_compra_maquinaria').val();
		var index = parseInt(renglonMaquinaria) - 1;
		//Obtenemos el objeto Maquinaria que deseamos afectar
		//Editar objeto maquinaria en la vista
		var objMaquinaria = new Maquinaria();
		objMaquinaria = objEntrada.getMaquinaria(index);

		//Limpiamos todo el array de aditamentos para insertar de nuevo los elementos
		objMaquinaria.arrAditamentos = [];

		//Obtenemos el objeto de la tabla detalles
		var objTabla = document.getElementById('dg_aditamentos_detalles_entradas_maquinaria_compra_maquinaria').getElementsByTagName('tbody')[0];

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Obtener cantidades y descripciones de cada aditamento
			var intCantidad = objRen.cells[0].innerHTML;
			var strDescripcion = objRen.cells[1].innerHTML;

			//Inserta en la vista el objeto objEntrada<-objMaquinaria<-objAditamento	
			//Variable para crea el ojeto Aditamento
        	objAditamento = new Aditamento(strSerie, intRen, intCantidad, strDescripcion);
        	objMaquinaria.setAditamento(objAditamento);
		}
		
		cerrar_aditamentos_entradas_maquinaria_compra_maquinaria();

	}

	//Función que se utiliza para cerrar el modal secundario
	function cerrar_aditamentos_entradas_maquinaria_compra_maquinaria()
	{
		try {
			//Cerrar modal
			objAditamentosEntradasMaquinariaCompraMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtCodigo_detalles_entradas_maquinaria_compra_maquinaria').focus();	
		}
		catch(err) {}
	}

	/*******************************************************************************************************************
	Funciones de la tabla aditamentos
	*********************************************************************************************************************/
	//Función para agregar renglón a la tabla aditamentos
	function agregar_renglon_aditamentos_detalles_entradas_maquinaria_compra_maquinaria()
	{
		var intRenglonAditamentoID = $('#txtRenglonAditamentosID_entradas_maquinaria_compra_maquinaria').val();
		var strSerie = $('#txtSerieAditamentos_entradas_maquinaria_compra_maquinaria').val();
		var intCantidad = $('#txtCantidadAditamentos_entradas_maquinaria_compra_maquinaria').val();
		var strDescripcion = $('#txtDescAditamentos_entradas_maquinaria_compra_maquinaria').val();
		
		//Utilizar toUpperCase() para cambiar texto a mayúsculas
		strDescripcion = strDescripcion.toUpperCase();

		//Obtenemos el objeto de la tabla
		var objTabla = document.getElementById('dg_aditamentos_detalles_entradas_maquinaria_compra_maquinaria').getElementsByTagName('tbody')[0];

		//Asignamos el número de renglon correspondiente (iniciamos en 0 por cuestión de Indice)
		var intRenglon = $("#dg_aditamentos_detalles_entradas_maquinaria_compra_maquinaria tr").length - 1; 

        //Revisamos si existe la descripción proporcionada, si es así, editamos los datos
		if (objTabla.rows.namedItem(intRenglonAditamentoID))
		{
			objTabla.rows.namedItem(intRenglonAditamentoID).cells[0].innerHTML = intCantidad;
			objTabla.rows.namedItem(intRenglonAditamentoID).cells[1].innerHTML = strDescripcion;

		}
		else{ //Insertamos un nuevo renglón

				//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaCantidad = objRenglon.insertCell(0);
				var objCeldaDescripcion = objRenglon.insertCell(1);
				var objCeldaAcciones = objRenglon.insertCell(2);

				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', intRenglon); 
				objCeldaCantidad.setAttribute('class', 'movil b1');
				objCeldaCantidad.innerHTML = intCantidad;
				objCeldaDescripcion.setAttribute('class', 'movil b2');
				objCeldaDescripcion.innerHTML = strDescripcion;
				objCeldaAcciones.setAttribute('class', 'td-center movil b3');
				objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_aditamentos_detalles_entradas_maquinaria_compra_maquinaria(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
											 " onclick='eliminar_renglon_aditamentos_detalles_entradas_maquinaria_compra_maquinaria(this)'>" +
											 "<span class='glyphicon glyphicon-trash'></span></button>" + 
											 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
											 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											 "<span class='glyphicon glyphicon-arrow-down'></span></button>"; 

		}

		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_aditamentos_detalles_entradas_maquinaria_compra_maquinaria tr").length - 1;
		$('#numElementos_detalles_aditamentos_entradas_maquinaria_compra_maquinaria').html(intFilas);

		//Limpiar cajas de texto despues de agregar o modificar la información de un registro
		$('#txtRenglonAditamentosID_entradas_maquinaria_compra_maquinaria').val('');
		$('#txtCantidadAditamentos_entradas_maquinaria_compra_maquinaria').val('');
		$('#txtDescAditamentos_entradas_maquinaria_compra_maquinaria').val('');

	}

	//Función para regresar los datos (al formulario) del renglón seleccionado
	function editar_renglon_aditamentos_detalles_entradas_maquinaria_compra_maquinaria(objRenglon)
	{
		//Asignar los valores a las cajas de texto
		$('#txtRenglonAditamentosID_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.getAttribute('id'));
		$('#txtCantidadAditamentos_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
		$('#txtDescAditamentos_entradas_maquinaria_compra_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
		
		//Enfocar caja de texto
		$('#txtCantidadAditamentos_entradas_maquinaria_compra_maquinaria').focus();
	}

	//Función para quitar renglón de la tabla
	function eliminar_renglon_aditamentos_detalles_entradas_maquinaria_compra_maquinaria(objRenglon)
	{
		
		//Obtener el indice del objeto renglón que se envía
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
		//Eliminar el renglón indicado
		document.getElementById("dg_aditamentos_detalles_entradas_maquinaria_compra_maquinaria").deleteRow(intRenglon);
	
		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_aditamentos_detalles_entradas_maquinaria_compra_maquinaria tr").length - 1;
		$('#numElementos_detalles_aditamentos_entradas_maquinaria_compra_maquinaria').html(intFilas);

		//Enfocar caja de texto
		$('#txtCantidadAditamentos_entradas_maquinaria_compra_maquinaria').focus();

	}

	//Función para inicializar elementos de la tabla detalles
	function inicializar_aditamentos_detalles_entradas_maquinaria_compra_maquinaria()
	{
		//Eliminar los datos de la tabla
		$('#dg_aditamentos_detalles_entradas_maquinaria_compra_maquinaria tbody').empty();
		$('#numElementos_detalles_aditamentos_entradas_maquinaria_compra_maquinaria').html(0);
	}


	//Al inicializar el componente
	$(document).ready(function() 
	{

		/*******************************************************************************************************************
		Controles correspondientes al MODAL SECUNDARIO
		*********************************************************************************************************************/
		//Función para mover renglones arriba y abajo en la tabla
		$('#dg_aditamentos_detalles_entradas_maquinaria_compra_maquinaria').on('click','button.btn',function(){
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

        /*******************************************************************************************************************
		Controles correspondientes al MODAL
		*********************************************************************************************************************/
        //Agregar datepicker para seleccionar fecha
		$('#dteFecha_entradas_maquinaria_compra_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFecha_entradas_maquinaria_compra_maquinaria').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

        //Autocomplete para recuperar los datos de una orden de compra 
        $('#txtOrdenCompra_entradas_maquinaria_compra_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtOrdenCompraID_entradas_maquinaria_compra_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "maquinaria/ordenes_compra_maquinaria/autocomplete",
                 type: "post",
                 dataType: "json",
                 data: {
                   strDescripcion: request.term,
                   strEstatus: 'AUTORIZADO'
                 },
                 success: function( data ) {
                   response( data );
                 }
               });
           },
           select: function( event, ui ) {
           	  //Asignar id del registro seleccionado
           	  $('#txtOrdenCompraID_entradas_maquinaria_compra_maquinaria').val(ui.item.data); 
             
              //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
              $.post('maquinaria/ordenes_compra_maquinaria/get_datos',
                  { 
                  	intOrdenCompraMaquinariaID: $("#txtOrdenCompraID_entradas_maquinaria_compra_maquinaria").val(), 
                  	strFormulario: 'entradas_maquinaria_compra'
                  },
                  function(data) {
                    if(data.row){ 

                    	$("#txtOrdenCompra_entradas_maquinaria_compra_maquinaria").val(data.row.folio);
                    	$("#txtProveedorID_entradas_maquinaria_compra_maquinaria").val(data.row.proveedor_id);
                    	$("#txtProveedor_entradas_maquinaria_compra_maquinaria").val(data.row.proveedor);

                    	//Modificamos los valores del objeEntrada(vista)
                    	objEntrada.setReferenciaID(data.row.orden_compra_maquinaria_id);
                    	objEntrada.setProveedorID(data.row.proveedor_id);
                    	objEntrada.setMonedaID(data.row.moneda_id);
                    	objEntrada.setTipoCambio(data.row.tipo_cambio);

                    	//Eliminar los datos de la tabla detalles del movimiento previo a cargar los detalles
						$('#dg_detalles_entradas_maquinaria_compra_maquinaria tbody').empty();

                    	//Cargar insumos adherentes a la orden de compra seleccionada
		                if(data.detalles){

		                	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_entradas_maquinaria_compra_maquinaria').getElementsByTagName('tbody')[0];

							//Variable para llevar el registro de cuantos renglones han sido insertados
							var renglon = 1;
				           	for (var intCon in data.detalles) 
				            {

				            	//Se inserta en la tabla el número de renglones correspondientes a una maquinaria acorde a la cantidad del detalle del movimiento
				            	for(var i=0; i<data.detalles[intCon].cantidad; i++){	

				            		//Insertamos el renglón con sus celdas en el objeto de la tabla
									var objRenglon = objTabla.insertRow();
									var objCeldaCodigo = objRenglon.insertCell(0);
									var objCeldaDescripcionCorta = objRenglon.insertCell(1);
									var objCeldaSerie = objRenglon.insertCell(2);
									var objCeldaMotor = objRenglon.insertCell(3);
									var objCeldaAcciones = objRenglon.insertCell(4);
									var objCeldaDescripcion = objRenglon.insertCell(5);
									var objCeldaPedimento = objRenglon.insertCell(6);
									var objCeldaConsignacion = objRenglon.insertCell(7);
									var objCeldaMaquinariaID = objRenglon.insertCell(8);

									//Asignar valores
									objRenglon.setAttribute('class', 'movil');
									objRenglon.setAttribute('id', renglon);
									objCeldaCodigo.setAttribute('class', 'movil b1');
									objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
									objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
									objCeldaDescripcionCorta.innerHTML = data.detalles[intCon].descripcion_corta;
									objCeldaSerie.setAttribute('class', 'movil b3');
									objCeldaSerie.innerHTML = '';
									objCeldaMotor.setAttribute('class', 'movil b4');
									objCeldaMotor.innerHTML = '';
									objCeldaAcciones.setAttribute('class', 'td-center movil b5');
									objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
																 " onclick='editar_renglon_detalles_entradas_maquinaria_compra_maquinaria(this)'>" + 
																 "<span class='glyphicon glyphicon-edit'></span></button>" + 
																 "<button class='btn btn-default btn-xs' title='Aditamentos'" +
																 " onclick='aditamentos_renglon_detalles_entradas_maquinaria_compra_maquinaria(this)'>" +
																 "<span class='glyphicon glyphicon-cog'></span></button>" + 
																 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
																 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
																 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
																 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
									objCeldaDescripcion.setAttribute('class', 'no-mostrar');
									objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
									objCeldaPedimento.setAttribute('class', 'no-mostrar');
									objCeldaPedimento.innerHTML = '';
									objCeldaConsignacion.setAttribute('class', 'no-mostrar');
									objCeldaConsignacion.innerHTML = '';
									objCeldaMaquinariaID.setAttribute('class', 'no-mostrar');
									objCeldaMaquinariaID.innerHTML = data.detalles[intCon].maquinaria_descripcion_id;

									//Creamos objetos de tipo Maquinaria para cada elemento en la vista
									objMaquinaria = new Maquinaria(null, 
																  renglon, 
																  data.detalles[intCon].maquinaria_descripcion_id, 
																  data.detalles[intCon].codigo, 
																  data.detalles[intCon].descripcion_corta, 
																  data.detalles[intCon].descripcion, 
																  '', 
																  '', 
																  '', 
																  '', 
																  []
																  );

									//Agregar cada objeto de tipo Maquinaria al objeto Entrada
									objEntrada.setMaquinaria(objMaquinaria);

									renglon++;
				            	}								 

							}

		                }

		                //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_entradas_maquinaria_compra_maquinaria tr").length - 1;
						$('#numElementos_detalles_entradas_maquinaria_compra_maquinaria').html(intFilas);
						$('#txtNumDetalles_entradas_maquinaria_compra_maquinaria').val(intFilas);
                    
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

        //Autocomplete para recuperar los datos de un chofer
        $('#txtChofer_entradas_maquinaria_compra_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtChoferID_entradas_maquinaria_compra_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "maquinaria/choferes/autocomplete",
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
             $('#txtChoferID_entradas_maquinaria_compra_maquinaria').val(ui.item.data); 
             objEntrada.setChoferID(ui.item.data); 
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });

        //Verificar que exista id del chofer cuando pierda el enfoque la caja de texto
        $('#txtChofer_entradas_maquinaria_compra_maquinaria').focusout(function(e){
            //Si no existe id del chofer
            if($('#txtChoferID_entradas_maquinaria_compra_maquinaria').val() == '' ||
               $('#txtChofer_entradas_maquinaria_compra_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtChoferID_entradas_maquinaria_compra_maquinaria').val('');
               $('#txtChofer_entradas_maquinaria_compra_maquinaria').val('');
               objEntrada.setChoferID(''); 
            }

        });


        //Autocomplete para recuperar los datos de un vehículo
        $('#txtVehiculo_entradas_maquinaria_compra_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtVehiculoID_entradas_maquinaria_compra_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "control_vehiculos/vehiculos/autocomplete",
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
             $('#txtVehiculoID_entradas_maquinaria_compra_maquinaria').val(ui.item.data); 
             objEntrada.setVehiculoID(ui.item.data); 
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
        $('#txtVehiculo_entradas_maquinaria_compra_maquinaria').focusout(function(e){
            //Si no existe id del vehículo
            if($('#txtVehiculoID_entradas_maquinaria_compra_maquinaria').val() == '' ||
               $('#txtVehiculo_entradas_maquinaria_compra_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtVehiculoID_entradas_maquinaria_compra_maquinaria').val('');
               $('#txtVehiculo_entradas_maquinaria_compra_maquinaria').val('');
               objEntrada.setVehiculoID(''); 
            }

        });


        //Función para mover renglones arriba y abajo en la tabla
		$('#dg_detalles_entradas_maquinaria_compra_maquinaria').on('click','button.btn',function(){
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

	    //Abrir modal cuando se de clic en el botón
		$('#btnAditamentos_entradas_maquinaria_compra_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			if($('#txtCodigo_detalles_entradas_maquinaria_compra_maquinaria').val() != ''){
				nuevo_aditamentos_entradas_maquinaria_compra_maquinaria('');
			}
			
			
		});


		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_entradas_maquinaria_compra_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_entradas_maquinaria_compra_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_entradas_maquinaria_compra_maquinaria').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_entradas_maquinaria_compra_maquinaria').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_entradas_maquinaria_compra_maquinaria').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_entradas_maquinaria_compra_maquinaria').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_entradas_maquinaria_compra_maquinaria').on('click','a',function(event){
			event.preventDefault();
			intPaginaEntradasMaquinariaCompraMaquinaria = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_entradas_maquinaria_compra_maquinaria();
		});

		//Autocomplete para recuperar los datos de un proveedor 
        $('#txtProveedorBusq_entradas_maquinaria_compra_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtProveedorIDBusq_entradas_maquinaria_compra_maquinaria').val('');
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
             $('#txtProveedorIDBusq_entradas_maquinaria_compra_maquinaria').val(ui.item.data);
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
        $('#txtProveedorBusq_entradas_maquinaria_compra_maquinaria').focusout(function(e){
            //Si no existe id del proveedor
            if($('#txtProveedorIDBusq_entradas_maquinaria_compra_maquinaria').val() == '' ||
               $('#txtProveedorBusq_entradas_maquinaria_compra_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtProveedorIDBusq_entradas_maquinaria_compra_maquinaria').val('');
               $('#txtProveedorBusq_entradas_maquinaria_compra_maquinaria').val('');
            }

        });

        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_entradas_maquinaria_compra_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_entradas_maquinaria_compra_maquinaria('Nuevo');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_entradas_maquinaria_compra_maquinaria').addClass("estatus-NUEVO");
			//Abrir modal
			 objEntradasMaquinariaCompraMaquinaria = $('#EntradasMaquinariaCompraMaquinariaBox').bPopup({
										   appendTo: '#EntradasMaquinariaCompraMaquinariaContent', 
			                               contentContainer: 'EntradasMaquinariaCompraMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#txtOrdenCompra_entradas_maquinaria_compra_maquinaria').focus();

		});

        //Enfocar caja de texto
        $('#txtFechaInicialBusq_entradas_maquinaria_compra_maquinaria').focus();
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_entradas_maquinaria_compra_maquinaria();

	});

</script>