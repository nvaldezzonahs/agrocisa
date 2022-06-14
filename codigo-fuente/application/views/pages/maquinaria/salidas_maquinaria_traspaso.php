<div id="SalidasMaquinariaTraspasoMaquinariaContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_salidas_maquinaria_traspaso_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_salidas_maquinaria_traspaso_maquinaria">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_salidas_maquinaria_traspaso_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_salidas_maquinaria_traspaso_maquinaria"
			                    		name= "strFechaInicialBusq_salidas_maquinaria_traspaso_maquinaria" 
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
							<label for="txtFechaFinalBusq_salidas_maquinaria_traspaso_maquinaria">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_salidas_maquinaria_traspaso_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_salidas_maquinaria_traspaso_maquinaria"
			                    		name= "strFechaFinalBusq_salidas_maquinaria_traspaso_maquinaria" 
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
				<!--Sucursal-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtSucursalDestinoBusq_salidas_maquinaria_traspaso_maquinaria">Sucursal</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtSucursalDestinoIDBusq_salidas_maquinaria_traspaso_maquinaria" 
									name="strSucursalDestinoIDBusq_salidas_maquinaria_traspaso_maquinaria" 
									type="hidden" />
							<input  class="form-control" 
									id="txtSucursalDestinoBusq_salidas_maquinaria_traspaso_maquinaria" 
									name="strSucursalDestinoBusq_salidas_maquinaria_traspaso_maquinaria" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese sucursal" />
						</div>
					</div>
				</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_salidas_maquinaria_traspaso_maquinaria">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_salidas_maquinaria_traspaso_maquinaria" 
								 		name="strEstatusBusq_salidas_maquinaria_traspaso_maquinaria" tabindex="1">
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
								<label for="txtBusqueda_salidas_maquinaria_traspaso_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_salidas_maquinaria_traspaso_maquinaria" 
										name="strBusqueda_salidas_maquinaria_traspaso_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_salidas_maquinaria_traspaso_maquinaria" 
									   	name="strImprimirDetalles_salidas_maquinaria_traspaso_maquinaria" 
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
							<button class="btn btn-primary" id="btnBuscar_salidas_maquinaria_traspaso_maquinaria"
									onclick="paginacion_salidas_maquinaria_traspaso_maquinaria();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_salidas_maquinaria_traspaso_maquinaria" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_salidas_maquinaria_traspaso_maquinaria"
									onclick="reporte_salidas_maquinaria_traspaso_maquinaria('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_salidas_maquinaria_traspaso_maquinaria"
									onclick="reporte_salidas_maquinaria_traspaso_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
			td.movil.a3:nth-of-type(3):before {content: "Sucursal"; font-weight: bold;}
			td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
			td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

			/*
			Definir columnas de la tabla detalles del movimiento
			*/
			td.movil.b1:nth-of-type(1):before {content: "Serie"; font-weight: bold;}
			td.movil.b2:nth-of-type(2):before {content: "Motor"; font-weight: bold;}
			td.movil.b3:nth-of-type(3):before {content: "Código"; font-weight: bold;}
			td.movil.b4:nth-of-type(4):before {content: "Descripción"; font-weight: bold;}
			td.movil.b5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

			/*
			Definir columnas de la tabla aditamentos
			*/
			td.movil.c1:nth-of-type(1):before {content: "Cantidad"; font-weight: bold;}
			td.movil.c2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}

		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_salidas_maquinaria_traspaso_maquinaria">
				<thead class="movil">
					<tr class="movil">
						<th class="movil">Folio</th>
						<th class="movil">Fecha</th>
						<th class="movil">Sucursal</th>
						<th class="movil">Estatus</th>
						<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
					</tr>
				</thead>
				<tbody class="movil"></tbody>
				<script id="plantilla_salidas_maquinaria_traspaso_maquinaria" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil">{{folio}}</td>
						<td class="movil">{{fecha}}</td>
						<td class="movil">{{sucursalDestino}}</td>
						<td class="movil">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="verificar_entrada_salidas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}},'Editar')"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_salidas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}},'Ver')"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_salidas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_salidas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}})" title="Desactivar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_salidas_maquinaria_traspaso_maquinaria"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_salidas_maquinaria_traspaso_maquinaria">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!-- Diseño del modal-->
	<div id="SalidasMaquinariaTraspasoMaquinariaBox" class="ModalBody"  tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_salidas_maquinaria_traspaso_maquinaria"  class="ModalBodyTitle">
		<h1>Salida de Maquinaria por Traspaso</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmSalidasMaquinariaTraspasoMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmSalidasMaquinariaTraspasoMaquinaria"  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!-- Folio -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtMovimientoMaquinariaID_salidas_maquinaria_traspaso_maquinaria" 
									   name="intMovimientoCajaHerramientas_salidas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtFolio_salidas_maquinaria_traspaso_maquinaria">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
								        id="txtFolio_salidas_maquinaria_traspaso_maquinaria" 
										name="strFolio_salidas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Autogenerado" 
										disabled />
							</div>
						</div>
					</div>
					<!-- Fecha -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFecha_salidas_maquinaria_traspaso_maquinaria">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_salidas_maquinaria_traspaso_maquinaria'>
				                    <input class="form-control" 
				                    		id="txtFecha_salidas_maquinaria_traspaso_maquinaria"
				                    		name= "strFecha_salidas_maquinaria_traspaso_maquinaria" 
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
					<!-- Sucursal destino -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de compra seleccionada-->
								<input id="txtSucursalDestinoID_salidas_maquinaria_traspaso_maquinaria" 
									   name="intSucursalDestinoID_salidas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtSucursalDestino_salidas_maquinaria_traspaso_maquinaria">Sucursal destino</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSucursalDestino_salidas_maquinaria_traspaso_maquinaria" 
										name="strSucursalDestino_salidas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese sucursal" 
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
								<input id="txtChoferID_salidas_maquinaria_traspaso_maquinaria" 
									   name="intChoferID_salidas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtChofer_salidas_maquinaria_traspaso_maquinaria">Chofer</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtChofer_salidas_maquinaria_traspaso_maquinaria" 
										name="strChofer_salidas_maquinaria_traspaso_maquinaria" 
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
								<input id="txtVehiculoID_salidas_maquinaria_traspaso_maquinaria" 
									   name="intVehiculoID_salidas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtVehiculo_salidas_maquinaria_traspaso_maquinaria">Vehículo</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtVehiculo_salidas_maquinaria_traspaso_maquinaria" 
										name="strVehiculo_salidas_maquinaria_traspaso_maquinaria" 
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
					<!-- Observaciones -->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtObservaciones_salidas_maquinaria_traspaso_maquinaria">Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_salidas_maquinaria_traspaso_maquinaria" 
										name="strObservaciones_salidas_maquinaria_traspaso_maquinaria" 
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
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
								<input id="txtNumDetalles_salidas_maquinaria_traspaso_maquinaria" 
							   		name="intNumDetalles_salidas_maquinaria_traspaso_maquinaria" type="hidden" value="">
								</input>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Detalles de la salida</h4>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Serie-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<input id="txtMaquinariaDescripcionID_detalles_salidas_maquinaria_traspaso_maquinaria" 
																   name="intMaquinariaDescripcionID_detalles_salidas_maquinaria_traspaso_maquinaria" 
																   type="hidden" 
																   value="" />
																<label for="txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria">Serie</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad" 
																		id="txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria" 
																		name="strSerie_detalles_salidas_maquinaria_traspaso_maquinaria" 
																		type="text" 
																		value="" 
																		tabindex="1" 
																		placeholder="Ingrese serie" 
																		maxlength="50" />
															</div>
														</div>
													</div>
													<!--Motor-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria">Motor</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad" 
																		id="txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria" 
																		name="strMotor_detalles_salidas_maquinaria_traspaso_maquinaria" 
																		type="text" 
																		value="" 
																		tabindex="1" 
																		placeholder="Ingrese motor" 
																		maxlength="50" />
															</div>
														</div>
													</div>
													<!--Código-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el renglón seleccionado -->
																<input id="txtRenglon_detalles_salidas_maquinaria_traspaso_maquinaria" 
																	   name="intRenglon_detalles_salidas_maquinaria_traspaso_maquinaria" 
																	   type="hidden" 
																	   value="" />	   
																<label for="txtCodigo_detalles_salidas_maquinaria_traspaso_maquinaria">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_detalles_salidas_maquinaria_traspaso_maquinaria" 
																		name="strCodigo_detalles_salidas_maquinaria_traspaso_maquinaria" 
																		type="text" 
																		value="" 
																		tabindex="1"
																		placeholder="" 
																		disabled />
															</div>
														</div>
													</div>
												</div>
											</div>	
										</div>
										<div class="row">
												<!--Descripción-->
												<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
													<div class="form-group">
														<div class="col-md-12">
															<input id="txtDescripcion_detalles_salidas_maquinaria_traspaso_maquinaria" 
																   name="strDescripcion_detalles_salidas_maquinaria_traspaso_maquinaria" 
																   type="hidden" 
																   value="" />
															<input id="txtNumeroPedimento_detalles_salidas_maquinaria_traspaso_maquinaria" 
																   name="strNumeroPedimento_detalles_salidas_maquinaria_traspaso_maquinaria" 
																   type="hidden" 
																   value="" />
															<input id="txtConsignacion_detalles_salidas_maquinaria_traspaso_maquinaria" 
																   name="strConsignacion_detalles_salidas_maquinaria_traspaso_maquinaria" 
																   type="hidden" 
																   value="" />	   	   
															<label for="txtDescripcionCorta_detalles_salidas_maquinaria_traspaso_maquinaria">Descripción</label>
														</div>
														<div class="col-md-12">
															<input  class="form-control" 
																	id="txtDescripcionCorta_detalles_salidas_maquinaria_traspaso_maquinaria" 
																	name="strDescripcionCorta_detalles_salidas_maquinaria_traspaso_maquinaria" 
																	type="text" 
																	value="" 
																	tabindex="1" 
																	placeholder="" 
																	disabled />
														</div>
													</div>
												</div>
												<!--Botones de acción (GRID)-->
												<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
													<div id="ToolBtns" class="btn-group btn-toolBtns">
														<!-- Agregar renglón -->
														<button class="btn btn-primary" 
																id="btnAgregar_salidas_maquinaria_traspaso_maquinaria"
																onclick="agregar_renglon_detalles_salidas_maquinaria_traspaso_maquinaria();" 
																title="Agregar" tabindex="1"> 
															<span class="glyphicon glyphicon-plus"></span>
														</button>
														<!-- Agregar aditamentos a un renglón -->
														<button class="btn btn-info"  
																id="btnAditamentos_salidas_maquinaria_traspaso_maquinaria" 
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
													<table class="table-hover movil" id="dg_detalles_salidas_maquinaria_traspaso_maquinaria">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Serie</th>
																<th class="movil">Motor</th>
																<th class="movil">Código</th>
																<th class="movil">Descripción</th>
																<th class="movil" id="th-acciones" style="width:15em;">Acciones</th>
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
																<strong id="numElementos_detalles_salidas_maquinaria_traspaso_maquinaria">0</strong> encontrados
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
								id="btnReset_salidas_maquinaria_traspaso_maquinaria"  
								onclick="nuevo_salidas_maquinaria_traspaso_maquinaria('Nuevo');"  
								title="Nuevo registro" 
								tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" 
								id="btnGuardar_salidas_maquinaria_traspaso_maquinaria"  
								onclick="validar_salidas_maquinaria_traspaso_maquinaria();"  
								title="Guardar" 
								tabindex="2" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_salidas_maquinaria_traspaso_maquinaria"  
								onclick="reporte_registro_salidas_maquinaria_traspaso_maquinaria('');"  
								title="Imprimir" 
								tabindex="5" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" id="btnDesactivar_salidas_maquinaria_traspaso_maquinaria"  
								onclick="cambiar_estatus_salidas_maquinaria_traspaso_maquinaria('');"  title="Desactivar" tabindex="8" disabled>
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  
								id="btnCerrar_salidas_maquinaria_traspaso_maquinaria"
								type="reset" 
								aria-hidden="true" 
								onclick="cerrar_salidas_maquinaria_traspaso_maquinaria();" 
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
	<div id="AditamentosSalidasMaquinariaTraspasoMaquinariaBox" class="ModalBody" tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModalSecundario_salidas_maquinaria_traspaso_maquinaria" class="ModalBodyTitle">
			<h1>Ver aditamentos</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmAditamentosSalidasMaquinariaTraspasoMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmAditamentosSalidasMaquinariaTraspasoMaquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
				  	<!--Código-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el renglón seleccionado -->	
								<label for="txtCodigoAditamentos_salidas_maquinaria_traspaso_maquinaria">Código</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtCodigoAditamentos_salidas_maquinaria_traspaso_maquinaria" 
										name="strCodigoAditamentos_salidas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtDescripcionAditamentos_salidas_maquinaria_traspaso_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtDescripcionAditamentos_salidas_maquinaria_traspaso_maquinaria" 
										name="strDescripcionAditamentos_salidas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Serie-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtSerieAditamentos_salidas_maquinaria_traspaso_maquinaria">Serie</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSerieAditamentos_salidas_maquinaria_traspaso_maquinaria" 
										name="strSerieAditamentos_salidas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Motor-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtMotorAditamentos_salidas_maquinaria_traspaso_maquinaria">Motor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtMotorAditamentos_salidas_maquinaria_traspaso_maquinaria" 
										name="strMotorAditamentos_salidas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<!-- Diseño de la tabla-->
									<table class="table-hover" id="dg_aditamentos_detalles_salidas_maquinaria_traspaso_maquinaria">
										<thead>
											<tr>
												<th>Cantidad</th>
												<th>Descripción</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
									<br>
									<div class="row">
										<!--Número de registros encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_detalles_aditamentos_salidas_maquinaria_traspaso_maquinaria">0</strong> encontrados
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
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_respuestas_salidas_maquinaria_traspaso_maquinaria"
								type="reset" aria-hidden="true" onclick="cerrar_aditamentos_salidas_maquinaria_traspaso_maquinaria();" title="Cerrar">
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

</div><!--#SalidasMaquinariaTraspasoMaquinariaContent -->


<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variable que se utiliza para asignar el id del movimiento de SALIDA DE MAQUINARIA POR TRASPASO
	var intMovimientoIDSalidaMaquinariaTraspasoMaquinaria = <?php echo SALIDA_MAQUINARIA_TRASPASO ?>;

	//Variables que se utilizan para la paginación de registros
	var intPaginaSalidasMaquinariaTraspasoMaquinaria = 0;
	var strUltimaBusquedaSalidasMaquinariaTraspasoMaquinaria = "";
	
	//Variable que se utiliza para asignar objeto del modal
	var objSalidasMaquinariaTraspasoMaquinaria = null;
	//Variable que se utiliza para asignar objeto del modal secundario
	var objAditamentosSalidasMaquinariaTraspasoMaquinaria = null;

	/*******************************************************************************************************************
	Funciones del objeto Salida por traspaso
	*********************************************************************************************************************/
	// Constructor de Salida
	var objSalida;
	function Salida(id, referenciaID, tipoMovimiento, folio, fecha, observaciones, choferID, vehiculoID, maquinarias)
	{
	    this.intMovimientoMaquinariaID = id;
	    this.intReferenciaID = referenciaID;
	    this.strTipoMovimiento = tipoMovimiento;
	    this.strFolio = folio;
	    this.strFecha = fecha;
	    this.intChoferID = choferID;
	    this.intVehiculoID = vehiculoID;
	    this.strObservaciones = observaciones;
	    this.arrMaquinarias = maquinarias;
	}
	// --------------------- MÉTODOS PARA EL OBJETO ENTRADA ------------------------------------------------------------
	Salida.prototype.setID = function(id) { this.intMovimientoMaquinariaID = id; }
	Salida.prototype.getID = function() { return this.intMovimientoMaquinariaID; }
	Salida.prototype.setReferenciaID = function(referenciaID) { this.intReferenciaID = referenciaID; }
	Salida.prototype.getReferenciaID = function() { return this.intReferenciaID; }
	Salida.prototype.setTipoMovimiento = function(tipoMovimiento) { this.strTipoMovimiento = tipoMovimiento; }
	Salida.prototype.getTipoMovimiento = function() { return this.strTipoMovimiento; }
	Salida.prototype.setFolio = function(folio) { this.strFolio = folio; }
	Salida.prototype.getFolio = function() { return this.strFolio; }
	Salida.prototype.setFecha = function(fecha) { this.strFecha = fecha; }
	Salida.prototype.getFecha = function() { return this.strFecha; }
	Salida.prototype.setChoferID = function(choferID) { this.intChoferID = choferID; }
	Salida.prototype.getChoferID = function() { return this.intChoferID; }
	Salida.prototype.setVehiculoID = function(vehiculoID) { this.intVehiculoID = vehiculoID; }
	Salida.prototype.getVehiculoID = function() { return this.intVehiculoID; }
	Salida.prototype.setObservaciones = function(observaciones) { this.strObservaciones = observaciones; }
	Salida.prototype.getObservaciones = function() { return this.strObservaciones; }
	// -------------------- FUNCIONES ASOCIADAS AL ATRIBUTO MAQUINARIAS ---------------------------------------------------
	//Función para agregar todas las maquinarias al objeto Entrada
	Salida.prototype.setMaquinarias = function(maquinarias) { this.arrMaquinarias = maquinarias; }
	//Función para obtener todas las maquinarias del objeto Entrada
	Salida.prototype.getMaquinarias = function() { return this.arrMaquinarias; }
	//Función para agregar una maquinaria al objeto Entrada
	Salida.prototype.setMaquinaria = function (maquinaria){ this.arrMaquinarias.push(maquinaria); }
	//Función para obtener una maquinaria del objeto Entrada
	Salida.prototype.getMaquinaria = function(index) { return this.arrMaquinarias[index]; }
	//Función para modificar un objeto maquinaria del objeto Entrada
	Salida.prototype.updateMaquinaria = function (index, maquinaria){ this.arrMaquinarias[index] = maquinaria; }
	//Función para eliminar una maquinaria del objeto Entrada
	Salida.prototype.deleteMaquinaria = function (index){
		if(index != -1) {
			this.arrMaquinarias.splice(index, 1);
		}
	}
	//Función para cambiar las posiciones de las preguntas en el Objeto Encuesta
	Salida.prototype.swap = function(index_A, index_B) {
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
	function Maquinaria(id, renglon, maquinariaDescripcionID, codigo, descripcionCorta, descripcion, serie, motor, numeroPedimento)
	{
	    this.intMovimientoMaquinariaID = id;
	    this.intRenglon = renglon;
	    this.strMaquinariaDescripcionID = maquinariaDescripcionID;
	    this.strCodigo = codigo;
	    this.strDescripcionCorta = descripcionCorta;
	    this.strDescripcion = descripcion;
	    this.strSerie = serie;
	    this.strMotor = motor;
	    this.strNumeroPedimento = numeroPedimento;
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
	Maquinaria.prototype.setNumeroPedimento = function(numeroPedimento) { this.strNumeroPedimento = motor; }
	Maquinaria.prototype.getNumeroPedimento = function() { return this.strNumeroPedimento; }

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_salidas_maquinaria_traspaso_maquinaria()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('maquinaria/salidas_maquinaria_traspaso/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_salidas_maquinaria_traspaso_maquinaria').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosSalidasMaquinariaTraspasoMaquinaria = data.row;
				//Separar la cadena 
				var arrPermisosSalidasMaquinariaTraspasoMaquinaria = strPermisosSalidasMaquinariaTraspasoMaquinaria.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosSalidasMaquinariaTraspasoMaquinaria.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosSalidasMaquinariaTraspasoMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosSalidasMaquinariaTraspasoMaquinaria[i]=='GUARDAR') || (arrPermisosSalidasMaquinariaTraspasoMaquinaria[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					//Si el indice es VER REGISTRO
					else if(arrPermisosSalidasMaquinariaTraspasoMaquinaria[i]=='VER REGISTRO')
					{
						
					}
					else if(arrPermisosSalidasMaquinariaTraspasoMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_salidas_maquinaria_traspaso_maquinaria();
					}
					else if(arrPermisosSalidasMaquinariaTraspasoMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosSalidasMaquinariaTraspasoMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosSalidasMaquinariaTraspasoMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosSalidasMaquinariaTraspasoMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}


	//Función para la búsqueda de registros
	function paginacion_salidas_maquinaria_traspaso_maquinaria() 
	{
		//Concatenar datos para la nueva búsqueda
   		var strNuevaBusquedaSalidasMaquinariaTraspasoMaquinaria =($('#txtFechaInicialBusq_salidas_maquinaria_traspaso_maquinaria').val()+$('#txtFechaFinalBusq_salidas_maquinaria_traspaso_maquinaria').val()+$('#txtSucursalSalidaIDBusq_salidas_maquinaria_traspaso_maquinaria').val()+$('#cmbEstatusBusq_salidas_maquinaria_traspaso_maquinaria').val()+$('#txtBusqueda_salidas_maquinaria_traspaso_maquinaria').val());

		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaSalidasMaquinariaTraspasoMaquinaria != strUltimaBusquedaSalidasMaquinariaTraspasoMaquinaria)
		{
			intPaginaSalidasMaquinariaTraspasoMaquinariaa = 0;
			strUltimaBusquedaSalidasMaquinariaTraspasoMaquinaria = strNuevaBusquedaSalidasMaquinariaTraspasoMaquinaria;
		}
	

		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('maquinaria/salidas_maquinaria_traspaso/get_paginacion',
				{	
					dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_salidas_maquinaria_traspaso_maquinaria').val()),
	    			dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_salidas_maquinaria_traspaso_maquinaria').val()),
	    			intSucursalDestinoID: $('#txtSucursalDestinoIDBusq_salidas_maquinaria_traspaso_maquinaria').val(),
	    			strEstatus: $('#cmbEstatusBusq_salidas_maquinaria_traspaso_maquinaria').val(),
	    			strBusqueda: $('#txtBusqueda_salidas_maquinaria_traspaso_maquinaria').val(),
					intPagina:intPaginaSalidasMaquinariaTraspasoMaquinaria,
					strPermisosAcceso: $('#txtAcciones_salidas_maquinaria_traspaso_maquinaria').val()
				},
				function(data){
					$('#dg_salidas_maquinaria_traspaso_maquinaria tbody').empty();
					var tmpSalidasMaquinariaTraspasoMaquinaria = Mustache.render($('#plantilla_salidas_maquinaria_traspaso_maquinaria').html(),data);
					$('#dg_salidas_maquinaria_traspaso_maquinaria tbody').html(tmpSalidasMaquinariaTraspasoMaquinaria);
					$('#pagLinks_salidas_maquinaria_traspaso_maquinaria').html(data.paginacion);
					$('#numElementos_salidas_maquinaria_traspaso_maquinaria').html(data.total_rows);
					intPaginaSalidasMaquinariaTraspasoMaquinaria = data.pagina;
				},
		'json');
	}

	

	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_salidas_maquinaria_traspaso_maquinaria(strTipo) 
	{

		//Variable que se utiliza para asignar URL (ruta del controlador)
		var strUrl = 'maquinaria/salidas_maquinaria_traspaso/';

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
		if ($('#chbImprimirDetalles_salidas_maquinaria_traspaso_maquinaria').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_salidas_maquinaria_traspaso_maquinaria').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_salidas_maquinaria_traspaso_maquinaria').val('NO');
		}


		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url': strUrl,
						'data' : {
									'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_salidas_maquinaria_traspaso_maquinaria').val()),
									'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_salidas_maquinaria_traspaso_maquinaria').val()),
									'intSucursalDestinoID': $('#txtSucursalDestinoIDBusq_salidas_maquinaria_traspaso_maquinaria').val(),
									'strEstatus': $('#cmbEstatusBusq_salidas_maquinaria_traspaso_maquinaria').val(), 
									'strBusqueda': $('#txtBusqueda_salidas_maquinaria_traspaso_maquinaria').val(),
									'strDetalles': $('#chbImprimirDetalles_salidas_maquinaria_traspaso_maquinaria').val()				
								 }
					   };


		//Hacer un llamado a la función para imprimir/descargar el reporte
		$.imprimirReporte(objReporte);
		
	}
	
	//Función para cargar el reporte de un registro en PDF
	function reporte_registro_salidas_maquinaria_traspaso_maquinaria(id) 
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la impresión desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_salidas_maquinaria_traspaso_maquinaria').val();
		}
		else
		{
			intID = id;
		}


		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url': 'maquinaria/salidas_maquinaria_traspaso/get_reporte_registro',
						'data' : {
									'intMovimientoMaquinariaID': intID
								 }
					   };

		//Hacer un llamado a la función para imprimir el reporte
		$.imprimirReporte(objReporte);

	}




	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_salidas_maquinaria_traspaso_maquinaria(tipoAccion)
	{
		
		//Incializar formulario
		$('#frmSalidasMaquinariaTraspasoMaquinaria')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_salidas_maquinaria_traspaso_maquinaria();
		//Limpiar cajas de texto ocultas
		$('#frmSalidasMaquinariaTraspasoMaquinaria').find('input[type=hidden]').val('');
		//Habilitar todos los elementos del formulario
	    $('#frmSalidasMaquinariaTraspasoMaquinaria').find('input, textarea, select').attr('disabled', false);
		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		inicializar_detalles_salidas_maquinaria_traspaso_maquinaria();	

		//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
		$('#divEncabezadoModal_salidas_maquinaria_traspaso_maquinaria').removeClass("estatus-NUEVO");
		$('#divEncabezadoModal_salidas_maquinaria_traspaso_maquinaria').removeClass("estatus-ACTIVO");
		$('#divEncabezadoModal_salidas_maquinaria_traspaso_maquinaria').removeClass("estatus-INACTIVO");
			
		/******************************************************************
		* INICIALIZACIÓN DE ELEMENTOS - ESTADO DEFAULT
		*******************************************************************/	
		//Folio
		$('#txtFolio_salidas_maquinaria_traspaso_maquinaria').val('');
		//Fecha
		$('#txtFecha_salidas_maquinaria_traspaso_maquinaria').val(fechaActual()); 
	    //Tipo de movimiento
		//$('#cmbMonedaID_salidas_maquinaria_traspaso_maquinaria').attr('disabled', false);
		//Mecánico
		$('#txtMecanicoID_salidas_maquinaria_traspaso_maquinaria').val('');
		$('#txtMecanico_salidas_maquinaria_traspaso_maquinaria').val('');
		//Observaciones
		$('#txtObservaciones_salidas_maquinaria_traspaso_maquinaria').val('');

		//Deshabilitar las siguientes cajas de texto
	    $('#txtFolio_salidas_maquinaria_traspaso_maquinaria').attr("disabled", "disabled");
	    $('#txtCodigo_detalles_salidas_maquinaria_traspaso_maquinaria').attr("disabled", "disabled");
	    $('#txtDescripcionCorta_detalles_salidas_maquinaria_traspaso_maquinaria').attr("disabled", "disabled");
		
		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo')
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_salidas_maquinaria_traspaso_maquinaria').addClass("estatus-NUEVO");
		}
	    
	    nuevo_objeto_salida();

		//Mostrar botón Guardar
		$("#btnGuardar_salidas_maquinaria_traspaso_maquinaria").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_salidas_maquinaria_traspaso_maquinaria").hide();
		$("#btnDescargarArchivo_salidas_maquinaria_traspaso_maquinaria").hide();
		$("#btnDesactivar_salidas_maquinaria_traspaso_maquinaria").hide();
		
	}

	//Función para crear un nuevo objeto de tipo Encuesta
	function nuevo_objeto_salida(){
		// Crear un Objeto de tipo Salida por traspaso
		objSalida = new Salida(null, null, null, '', '', '', null, null, []);
	}
	
	//Función para inicializar elementos de la tabla detalles
	function inicializar_detalles_salidas_maquinaria_traspaso_maquinaria()
	{
		//Eliminar los datos de la tabla detalles del movimiento
		$('#dg_detalles_salidas_maquinaria_traspaso_maquinaria tbody').empty();
		$('#acumCantidad_detalles_salidas_maquinaria_traspaso_maquinaria').html(0);
		$('#numElementos_detalles_salidas_maquinaria_traspaso_maquinaria').html(0);
		$('#txtNumDetalles_salidas_maquinaria_traspaso_maquinaria').html('');
	}
	
	
	//Función que se utiliza para cerrar el modal
	function cerrar_salidas_maquinaria_traspaso_maquinaria()
	{
		try {
			//Cerrar modal Aditamentos
			cerrar_aditamentos_salidas_maquinaria_traspaso_maquinaria();
			//Cerrar modal
			objSalidasMaquinariaTraspasoMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_salidas_maquinaria_traspaso_maquinaria').focus();	
		}
		catch(err) {}
	}

	
	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_salidas_maquinaria_traspaso_maquinaria()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_salidas_maquinaria_traspaso_maquinaria();
		//Validación del formulario de campos obligatorios
		$('#frmSalidasMaquinariaTraspasoMaquinaria')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_salidas_maquinaria_traspaso_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
									    strSucursalDestino_salidas_maquinaria_traspaso_maquinaria: {
											validators: {
											    callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la orden de compra
					                                    if( $('#txtSucursalDestinoID_salidas_maquinaria_traspaso_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un sucursal existente'
					                                        };
					                                    }
					                                    return true;
					                                }
						                        }
											}
										},
										
										intNumDetalles_salidas_maquinaria_traspaso_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta salida.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strObservaciones_salidas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strChofer_salidas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strVehiculo_salidas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strSerie_detalles_salidas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strMotor_detalles_salidas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strCodigo_detalles_salidas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strDescripcion_detalles_salidas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										}

									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_salidas_maquinaria_traspaso_maquinaria = $('#frmSalidasMaquinariaTraspasoMaquinaria').data('bootstrapValidator');
		bootstrapValidator_salidas_maquinaria_traspaso_maquinaria.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_salidas_maquinaria_traspaso_maquinaria.isValid())
		{	
			//Hacer un llamado a la función para guardar los datos del registro
			guardar_salidas_maquinaria_traspaso_maquinaria();				
		}
		else 
			return;
	}

	
	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_salidas_maquinaria_traspaso_maquinaria()
	{
		try
		{
			$('#frmSalidasMaquinariaTraspasoMaquinaria').data('bootstrapValidator').resetForm();

		}
		catch(err) {}
	}

	
	//Función para guardar o modificar los datos de un registro
	function guardar_salidas_maquinaria_traspaso_maquinaria()
	{	
		//Obtenemos el objeto de la tabla detalles
		objSalida.setID( $('#txtMovimientoMaquinariaID_salidas_maquinaria_traspaso_maquinaria').val() );
		objSalida.setReferenciaID( $('#txtSucursalDestinoID_salidas_maquinaria_traspaso_maquinaria').val() );
		objSalida.setTipoMovimiento( intMovimientoIDSalidaMaquinariaTraspasoMaquinaria );
		objSalida.setFolio( $('#txtFolio_salidas_maquinaria_traspaso_maquinaria').val() );
		objSalida.setFecha( $.formatFechaMysql($('#txtFecha_salidas_maquinaria_traspaso_maquinaria').val()) );
		objSalida.setChoferID( $('#txtChoferID_salidas_maquinaria_traspaso_maquinaria').val() );
		objSalida.setVehiculoID( $('#txtVehiculoID_salidas_maquinaria_traspaso_maquinaria').val() );
		objSalida.setObservaciones( $('#txtObservaciones_salidas_maquinaria_traspaso_maquinaria').val() );

		//Agregar maquinarias del GRID
		//Limpiamos todo el array de maquinarias para insertar de nuevo los elementos
		objSalida.arrMaquinarias = [];

		//Obtenemos el objeto de la tabla detalles
		var objTabla = document.getElementById('dg_detalles_salidas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Obtener cantidades y descripciones de cada aditamento
			var intMaquinariaDescripcionID = objRen.cells[8].innerHTML;
			var strCodigo = objRen.cells[2].innerHTML;
			var strDescripcionCorta = objRen.cells[3].innerHTML;
			var strDescripcion = objRen.cells[5].innerHTML;
			var strSerie = objRen.cells[0].innerHTML;
			var strMotor = objRen.cells[1].innerHTML;
			var strNumeroPedimento = objRen.cells[6].innerHTML;

			//Inserta en la vista el objeto objSalida<-objMaquinaria
			//Variable para crea el ojeto Maquinaria
        	var objMaquinaria = new Maquinaria(null, intRen+1, intMaquinariaDescripcionID, strCodigo, strDescripcionCorta, strDescripcion, strSerie, strMotor, strNumeroPedimento);
        	objSalida.setMaquinaria(objMaquinaria);
		}

		//Convenrtir al formato JSON todo lo generado en el objeto de la vista
		var jsonSalida = JSON.stringify(objSalida); 
		
		//Hacer un llamado al método del controlador para guardar los datos del registro	
		$.post('maquinaria/salidas_maquinaria_traspaso/guardar',
		{ 
			//Datos de la entrada por compra
			strFolioConsecutivo: $('#txtFolio_salidas_maquinaria_traspaso_maquinaria').val(),
			salidaTraspaso: jsonSalida,
			intProcesoMenuID: $('#txtProcesoMenuID_salidas_maquinaria_traspaso_maquinaria').val()
		},
		function(data) {

			if (data.resultado)
			{	    
                //Si no existe id del movimiento, significa que es un nuevo registro   
				if($('#txtMovimientoMaquinariaID_salidas_maquinaria_traspaso_maquinaria').val() == '')
				{
				  	//Asignar el id del movimiento registrado en la base de datos
         			$('#txtMovimientoMaquinariaID_salidas_maquinaria_traspaso_maquinaria').val(data.movimiento_maquinaria_id);
         			//Asignar folio consecutivo
         			$('#txtFolio_salidas_maquinaria_traspaso_maquinaria').val(data.folio);
				} 
                //Hacer un llamado a la función para cerrar modal
                cerrar_salidas_maquinaria_traspaso_maquinaria();
                //Hacer llamado a la función  para cargar  los registros en el grid
               	paginacion_salidas_maquinaria_traspaso_maquinaria();         	    
			}
			//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			mensaje_salidas_maquinaria_traspaso_maquinaria(data.tipo_mensaje, data.mensaje);
		},
		'json');
			
	}

	// Función para cambiar el estatus del registro seleccionado
	function cambiar_estatus_salidas_maquinaria_traspaso_maquinaria(id)
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_salidas_maquinaria_traspaso_maquinaria').val();

		}
		else
		{
			intID = id;
		}

	   
		//Preguntar al usuario si desea desactivar el registro
		new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
		             {'type':     'question',
		              'title':    'Salida de Maquinaria por Traspaso',
		              'buttons':  ['Aceptar', 'Cancelar'],
		              'onClose':  function(caption) {
		                            if(caption == 'Aceptar')
		                            {
		                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
		                              $.post('maquinaria/salidas_maquinaria_traspaso/set_estatus',
		                                     {
		                                     	intMovimientoMaquinariaID: intID
		                                     },
		                                     function(data) {
		                                        if(data.resultado)
		                                        {
		                                          	//Hacer llamado a la función  para cargar  los registros en el grid
		                                          	paginacion_salidas_maquinaria_traspaso_maquinaria();
		                                          	//Si el id del registro se obtuvo del modal
													if(id == '')
													{
														//Hacer un llamado a la función para cerrar modal
														cerrar_salidas_maquinaria_traspaso_maquinaria();     
													}
		                                        }
		                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		                                        mensaje_salidas_maquinaria_traspaso_maquinaria(data.tipo_mensaje, data.mensaje);
		                                     },
		                                    'json');
		                            }
		                          }
		              });
	   
	}

	//Método para verificar si el movimiento de salida por traspaso ya presenta una entrada por traspaso
	function verificar_entrada_salidas_maquinaria_traspaso_maquinaria(id, tipoAccion){

		//Hacer un llamado al método del controlador para regresar los datos del registro
	   $.post('maquinaria/salidas_maquinaria_traspaso/verificar_entrada',
       {
       		intMovimientoMaquinariaID:id
       },
       function(data) {

        	//Si hay datos del registro 
            if(data.row)
            {  
            	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    mensaje_salidas_maquinaria_traspaso_maquinaria('error', 'No es posible editar este movimiento. Ya que presenta una entrada por traspaso ACTIVA en otra sucursal');
            	editar_salidas_maquinaria_traspaso_maquinaria(id, 'Ver');
            }
            else{
            	editar_salidas_maquinaria_traspaso_maquinaria(id, 'Editar');
            }
        },
       'json');    

	}

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_salidas_maquinaria_traspaso_maquinaria(id, tipoAccion)
	{	
	   //Hacer un llamado al método del controlador para regresar los datos del registro
	   $.post('maquinaria/salidas_maquinaria_traspaso/get_datos',
       {
       		intMovimientoMaquinariaID:id
       },
       function(data) {

        	//Si hay datos del registro 
            if(data.row)
            {  
            	//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_salidas_maquinaria_traspaso_maquinaria();
				//Asignar estatus del registro
				var strEstatus = data.row.estatus;
	          	//Recuperar valores para la Vista
	            $('#txtMovimientoMaquinariaID_salidas_maquinaria_traspaso_maquinaria').val(data.row.movimiento_maquinaria_id);
	            $('#txtFolio_salidas_maquinaria_traspaso_maquinaria').val(data.row.folio);
	            $('#txtFecha_salidas_maquinaria_traspaso_maquinaria').val(data.row.fecha);
	            $('#txtSucursalDestinoID_salidas_maquinaria_traspaso_maquinaria').val(data.row.sucursalDestinoID);
	            $('#txtSucursalDestino_salidas_maquinaria_traspaso_maquinaria').val(data.row.sucursalDestino);
				$('#txtChoferID_salidas_maquinaria_traspaso_maquinaria').val(data.row.chofer_id);
				$('#txtChofer_salidas_maquinaria_traspaso_maquinaria').val(data.row.chofer);
				$('#txtVehiculoID_salidas_maquinaria_traspaso_maquinaria').val(data.row.vehiculo_id);
				$('#txtVehiculo_salidas_maquinaria_traspaso_maquinaria').val(data.row.vehiculo);
				$('#txtObservaciones_salidas_maquinaria_traspaso_maquinaria').val(data.row.observaciones);

				//Variable que se utiliza para asignar las acciones de la tabla
				var strAccionesTabla = "";
				//Si el tipo de acción corresponde a Ver
	            if(tipoAccion == 'Ver')
	            {
	            	//Deshabilitar todos los elementos del formulario
	            	$('#frmSalidasMaquinariaTraspasoMaquinaria').find('input, textarea, select').attr('disabled','disabled');
	            	//Ocultar los siguientes botones
		            $("#btnGuardar_salidas_maquinaria_traspaso_maquinaria").hide();

		            strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Aditamentos'" +
												 " onclick='ver_aditamentos_renglon_detalles_salidas_maquinaria_traspaso_maquinaria(this)'>" +
												 "<span class='glyphicon glyphicon-cog'></span></button>";

		          
	            }
	            else
	            {
	            	
	            	//Mostrar los siguientes botones  
	            	$("#btnDesactivar_salidas_maquinaria_traspaso_maquinaria").show();

	            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_detalles_salidas_maquinaria_traspaso_maquinaria(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Aditamentos'" +
											 " onclick='ver_aditamentos_renglon_detalles_salidas_maquinaria_traspaso_maquinaria(this)'>" +
											 "<span class='glyphicon glyphicon-cog'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_detalles_salidas_maquinaria_traspaso_maquinaria(this)'>" + 
									   "<span class='glyphicon glyphicon-trash'></span></button>" + 
											 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
											 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
	            }

	
	           	//Mostramos los detalles del registro
	           	for (var intCon in data.detalles) 
	            {	
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_detalles_salidas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					
					var objCeldaSerie = objRenglon.insertCell(0);
					var objCeldaMotor = objRenglon.insertCell(1);
					var objCeldaCodigo = objRenglon.insertCell(2);
					var objCeldaDescripcionCorta = objRenglon.insertCell(3);
					var objCeldaAcciones = objRenglon.insertCell(4);
					var objCeldaDescripcion = objRenglon.insertCell(5);
					var objCeldaPedimento = objRenglon.insertCell(6);
					var objCeldaConsignacion = objRenglon.insertCell(7);
					var objCeldaMaquinariaID = objRenglon.insertCell(8);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', data.detalles[intCon].serie);
					objCeldaCodigo.setAttribute('class', 'movil b1');
					objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
					objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
					objCeldaDescripcionCorta.innerHTML = data.detalles[intCon].descripcion_corta;
					objCeldaSerie.setAttribute('class', 'movil b3');
					objCeldaSerie.innerHTML = data.detalles[intCon].serie;
					objCeldaMotor.setAttribute('class', 'movil b4');
					objCeldaMotor.innerHTML = data.detalles[intCon].motor;
					objCeldaAcciones.setAttribute('class', 'td-center movil b5');
					objCeldaAcciones.innerHTML = strAccionesTabla;
					objCeldaDescripcion.setAttribute('class', 'no-mostrar');
					objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
					objCeldaPedimento.setAttribute('class', 'no-mostrar');
					objCeldaPedimento.innerHTML = data.detalles[intCon].numero_pedimento;
					objCeldaConsignacion.setAttribute('class', 'no-mostrar');
					objCeldaConsignacion.innerHTML = data.detalles[intCon].consignacion;
					objCeldaMaquinariaID.setAttribute('class', 'no-mostrar');
					objCeldaMaquinariaID.innerHTML = data.detalles[intCon].maquinaria_descripcion_id;

					//Creamos objetos de tipo Maquinaria para cada elemento en la vista
					objMaquinaria = new Maquinaria(data.detalles[intCon].movimiento_maquinaria_id, 
												  data.detalles[intCon].renglon, 
												  data.detalles[intCon].maquinaria_descripcion_id, 
												  data.detalles[intCon].codigo, 
												  data.detalles[intCon].descripcion_corta, 
												  data.detalles[intCon].descripcion, 
												  data.detalles[intCon].serie, 
												  data.detalles[intCon].motor, 
												  data.detalles[intCon].consignacion, 
												  data.detalles[intCon].numero_pedimento
												  );

					//Agregar cada objeto de tipo Maquinaria al objeto Entrada
					objSalida.setMaquinaria(objMaquinaria);	
	            }

				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_salidas_maquinaria_traspaso_maquinaria tr").length - 1;
				$('#numElementos_detalles_salidas_maquinaria_traspaso_maquinaria').html(intFilas);
				$('#txtNumDetalles_salidas_maquinaria_traspaso_maquinaria').val(intFilas);
				
				//Dependiendo del estatus cambiar el color del encabezado 
	            $('#divEncabezadoModal_salidas_maquinaria_traspaso_maquinaria').addClass("estatus-"+ strEstatus);
	            //Mostrar botón Imprimir  
	            $("#btnImprimirRegistro_salidas_maquinaria_traspaso_maquinaria").show();

				
				
	            //Abrir modal
			 	objSalidasMaquinariaTraspasoMaquinaria = $('#SalidasMaquinariaTraspasoMaquinariaBox').bPopup({
										   appendTo: '#SalidasMaquinariaTraspasoMaquinariaContent', 
			                               contentContainer: 'SalidasMaquinariaTraspasoMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});

	            //Enfocar caja de texto
				$('#txtFecha_salidas_maquinaria_traspaso_maquinaria').focus();
       	    }
       	    
       },
       'json');
	}

	
	//Función para mostrar mensaje de éxito o error
	function mensaje_salidas_maquinaria_traspaso_maquinaria(tipoMensaje, mensaje)
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
	//Función para inicializar elementos del detalle
	function inicializar_detalle_salidas_maquinaria_traspaso_maquinaria() 
	{
		//Limpiar las siguientes cajas de texto
		$('#txtCodigo_detalles_salidas_maquinaria_traspaso_maquinaria').val('');
		$('#txtDescripcionCorta_detalles_salidas_maquinaria_traspaso_maquinaria').val('');
		$('#txtDescripcion_detalles_salidas_maquinaria_traspaso_maquinaria').val('');
		$('#txtNumeroPedimento_detalles_salidas_maquinaria_traspaso_maquinaria').val('');
		$('#txtConsignacion_detalles_salidas_maquinaria_traspaso_maquinaria').val('');
	}

	//Función para agregar renglón a la tabla
	function agregar_renglon_detalles_salidas_maquinaria_traspaso_maquinaria()
	{
		var intMaquinariaDescripcionID = $('#txtMaquinariaDescripcionID_detalles_salidas_maquinaria_traspaso_maquinaria').val();
		var strSerie = $('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').val();
		var strMotor = $('#txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria').val();
		var strCodigo = $('#txtCodigo_detalles_salidas_maquinaria_traspaso_maquinaria').val();
		var strDescripcionCorta = $('#txtDescripcionCorta_detalles_salidas_maquinaria_traspaso_maquinaria').val();
		var strDescripcion = $('#txtDescripcion_detalles_salidas_maquinaria_traspaso_maquinaria').val();
		var strNumeroPedimento = $('#txtNumeroPedimento_detalles_salidas_maquinaria_traspaso_maquinaria').val();
		var strConsignacion = $('#txtConsignacion_detalles_salidas_maquinaria_traspaso_maquinaria').val();

		//Obtenemos el objeto de la tabla
		var objTabla = document.getElementById('dg_detalles_salidas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];	
		
		//Revisamos si existe la descripción proporcionada, si es así, editamos los datos
		if (objTabla.rows.namedItem(strSerie) || strSerie == '')
		{
			$('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').val('');
			$('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').focus();
		}
		else
		{
			

			//Limpiar componentes
			$('#txtMaquinariaDescripcionID_detalles_salidas_maquinaria_traspaso_maquinaria').val('');
			$('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').val('');
			$('#txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria').val('');
			//Hacer un llamado a la función para inicializar elementos del detalle
			inicializar_detalle_salidas_maquinaria_traspaso_maquinaria();
			

			//Revisamos si  no existe el ID proporcionado agregar renglón
			if (!objTabla.rows.namedItem(strSerie))
			{
				//Asignamos el número de renglon correspondiente (iniciamos en 0 por cuestión de Indice)
				var renglon = $("#dg_detalles_salidas_maquinaria_traspaso_maquinaria tr").length - 1;


				//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objCeldaSerie = objRenglon.insertCell(0);
				var objCeldaMotor = objRenglon.insertCell(1);
				var objCeldaCodigo = objRenglon.insertCell(2);
				var objCeldaDescripcionCorta = objRenglon.insertCell(3);
				var objCeldaAcciones = objRenglon.insertCell(4);
				var objCeldaDescripcion = objRenglon.insertCell(5);
				var objCeldaPedimento = objRenglon.insertCell(6);
				var objCeldaConsignacion = objRenglon.insertCell(7);
				var objCeldaMaquinariaID = objRenglon.insertCell(8);

				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', strSerie);
				objCeldaCodigo.setAttribute('class', 'movil b1');
				objCeldaCodigo.innerHTML = strCodigo;
				objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
				objCeldaDescripcionCorta.innerHTML = strDescripcionCorta;
				objCeldaSerie.setAttribute('class', 'movil b3');
				objCeldaSerie.innerHTML = strSerie;
				objCeldaMotor.setAttribute('class', 'movil b4');
				objCeldaMotor.innerHTML = strMotor;
				objCeldaAcciones.setAttribute('class', 'td-center movil b5');
				objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_detalles_salidas_maquinaria_traspaso_maquinaria(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Aditamentos'" +
											 " onclick='ver_aditamentos_renglon_detalles_salidas_maquinaria_traspaso_maquinaria(this)'>" +
											 "<span class='glyphicon glyphicon-cog'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_detalles_salidas_maquinaria_traspaso_maquinaria(this)'>" + 
									   "<span class='glyphicon glyphicon-trash'></span></button>" + 
											 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
											 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				objCeldaDescripcion.setAttribute('class', 'no-mostrar');
				objCeldaDescripcion.innerHTML = strDescripcion;
				objCeldaPedimento.setAttribute('class', 'no-mostrar');
				objCeldaPedimento.innerHTML = strNumeroPedimento;
				objCeldaConsignacion.setAttribute('class', 'no-mostrar');
				objCeldaConsignacion.innerHTML = strConsignacion;
				objCeldaMaquinariaID.setAttribute('class', 'no-mostrar');
				objCeldaMaquinariaID.innerHTML = intMaquinariaDescripcionID;

			}
			

			

			
		}

		var intFilas = $("#dg_detalles_salidas_maquinaria_traspaso_maquinaria tr").length - 1;
		$('#numElementos_detalles_salidas_maquinaria_traspaso_maquinaria').html(intFilas);
		$('#txtNumDetalles_salidas_maquinaria_traspaso_maquinaria').val(intFilas);

		
	}

	//Función para agregar Aditamentos del renglón seleccionado
	function editar_renglon_detalles_salidas_maquinaria_traspaso_maquinaria(objRenglon){

		//Asignar los valores a las cajas de texto
		$('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
		$('#txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
		$('#txtCodigo_detalles_salidas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
		$('#txtDescripcionCorta_detalles_salidas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
	}

	//Función para agregar Aditamentos del renglón seleccionado
	function ver_aditamentos_renglon_detalles_salidas_maquinaria_traspaso_maquinaria(objRenglon){

		//Asignar los valores que vienen del modal primario
		$('#txtCodigoAditamentos_salidas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[2].innerHTML); 
		$('#txtDescripcionAditamentos_salidas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
		$('#txtSerieAditamentos_salidas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
		$('#txtMotorAditamentos_salidas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);


		nuevo_aditamentos_salidas_maquinaria_traspaso_maquinaria('grid');

	}

	//Función para quitar renglón de la tabla
	function eliminar_renglon_detalles_salidas_maquinaria_traspaso_maquinaria(objRenglon)
	{	
		//Obtener el indice del objeto renglón que se envía
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
		//Eliminar el renglón indicado
		document.getElementById("dg_detalles_salidas_maquinaria_traspaso_maquinaria").deleteRow(intRenglon);
	
		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que  al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_detalles_salidas_maquinaria_traspaso_maquinaria tr").length - 1;
		$('#numElementos_detalles_salidas_maquinaria_traspaso_maquinaria').html(intFilas);
		$('#txtNumDetalles_salidas_maquinaria_traspaso_maquinaria').val(intFilas);

		//Enfocar caja de texto
		$('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').focus();

	}


	/*******************************************************************************************************************
	Funciones del modal secundario
	*********************************************************************************************************************/
	//Agregar aditamentos a una maquinaria
	function nuevo_aditamentos_salidas_maquinaria_traspaso_maquinaria(tipo){

		inicializar_aditamentos_detalles_salidas_maquinaria_traspaso_maquinaria();

		if($('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').val() != '')
		{
			$('#txtCodigoAditamentos_salidas_maquinaria_traspaso_maquinaria').val($('#txtCodigo_detalles_salidas_maquinaria_traspaso_maquinaria').val());
			$('#txtDescripcionAditamentos_salidas_maquinaria_traspaso_maquinaria').val($('#txtDescripcionCorta_detalles_salidas_maquinaria_traspaso_maquinaria').val());
			$('#txtSerieAditamentos_salidas_maquinaria_traspaso_maquinaria').val($('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').val());
			$('#txtMotorAditamentos_salidas_maquinaria_traspaso_maquinaria').val($('#txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria').val());

		}

		if($('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').val() != '' || tipo == 'grid'){

			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModalSecundario_salidas_maquinaria_traspaso_maquinaria').addClass("estatus-NUEVO");
			//Abrir modal secundario
			 objAditamentosSalidasMaquinariaTraspasoMaquinaria = $('#AditamentosSalidasMaquinariaTraspasoMaquinariaBox').bPopup({
										   appendTo: '#SalidasMaquinariaTraspasoMaquinariaContent', 
			                               contentContainer: 'AditamentosSalidasMaquinariaTraspasoMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});
			
			

			//Consultar si la serie contiene aditamentos 
			//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
              $.post('maquinaria/salidas_maquinaria_traspaso/get_aditamentos',
                  { 
                  	strSerie: $("#txtSerieAditamentos_salidas_maquinaria_traspaso_maquinaria").val()
                  },
                  function(data) {

                  	//Si se econtró información
                    if(data){

                    	//Obtenemos el objeto de la tabla
						var objTabla = document.getElementById('dg_aditamentos_detalles_salidas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];

                    	for (var intCon in data) 
				        {
				        	//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCantidad = objRenglon.insertCell(0);
							var objCeldaDescripcion = objRenglon.insertCell(1);
							
							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data[intCon].renglon);
							objCeldaCantidad.setAttribute('class', 'movil c1');
							objCeldaCantidad.innerHTML = data[intCon].cantidad;
							objCeldaDescripcion.setAttribute('class', 'movil c2');
							objCeldaDescripcion.innerHTML = data[intCon].descripcion;
				        }

				        var intFilas = $("#dg_aditamentos_detalles_salidas_maquinaria_traspaso_maquinaria tr").length - 1;
						$('#numElementos_detalles_aditamentos_salidas_maquinaria_traspaso_maquinaria').html(intFilas);

                    }
                }
                 ,
                'json');

		}
		else
		{
			$('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').focus();
		}

	}

	//Función que se utiliza para cerrar el modal secundario
	function cerrar_aditamentos_salidas_maquinaria_traspaso_maquinaria()
	{
		try {
			//Cerrar modal
			objAditamentosSalidasMaquinariaTraspasoMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtCodigo_detalles_salidas_maquinaria_traspaso_maquinaria').focus();	
		}
		catch(err) {}
	}

	//Función para inicializar elementos de la tabla detalles
	function inicializar_aditamentos_detalles_salidas_maquinaria_traspaso_maquinaria()
	{
		//Eliminar los datos de la tabla
		$('#dg_aditamentos_detalles_salidas_maquinaria_traspaso_maquinaria tbody').empty();
		$('#numElementos_detalles_aditamentos_salidas_maquinaria_traspaso_maquinaria').html(0);
	}


	//Al inicializar el componente
	$(document).ready(function() 
	{

		/*******************************************************************************************************************
		Controles correspondientes al MODAL SECUNDARIO
		*********************************************************************************************************************/
		

        /*******************************************************************************************************************
		Controles correspondientes al MODAL
		*********************************************************************************************************************/
        //Agregar datepicker para seleccionar fecha
		$('#dteFecha_salidas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});


 			//Autocomplete para recuperar los datos de una sucursal diferente a la logeada 
            $('#txtSucursalDestino_salidas_maquinaria_traspaso_maquinaria').autocomplete({
                source: function( request, response ) {
                   //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtSucursalDestinoID_salidas_maquinaria_traspaso_maquinaria').val('');
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
                 //Asignar valores del registro seleccionado
                 $('#txtSucursalDestinoID_salidas_maquinaria_traspaso_maquinaria').val(ui.item.data);

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
            $('#txtSucursalDestino_salidas_maquinaria_traspaso_maquinaria').focusout(function(e){
                //Si no existe id de la sucursal de salida
                if($('#txtSucursalDestinoID_salidas_maquinaria_traspaso_maquinaria').val() == '' ||
                   $('#txtSucursalDestino_salidas_maquinaria_traspaso_maquinaria').val() == '')
                { 
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtSucursalDestinoID_salidas_maquinaria_traspaso_maquinaria').val('');
                   $('#txtSucursalDestino_salidas_maquinaria_traspaso_maquinaria').val('');
                }

            });
           

        

        //Autocomplete para recuperar los datos de un chofer
        $('#txtChofer_salidas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtChoferID_salidas_maquinaria_traspaso_maquinaria').val('');
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
             $('#txtChoferID_salidas_maquinaria_traspaso_maquinaria').val(ui.item.data); 
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
        $('#txtChofer_salidas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id del chofer
            if($('#txtChoferID_salidas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtChofer_salidas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtChoferID_salidas_maquinaria_traspaso_maquinaria').val('');
               $('#txtChofer_salidas_maquinaria_traspaso_maquinaria').val('');
            }

        });

        //Autocomplete para recuperar los datos de un vehículo
        $('#txtVehiculo_salidas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtVehiculoID_salidas_maquinaria_traspaso_maquinaria').val('');
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
             $('#txtVehiculoID_salidas_maquinaria_traspaso_maquinaria').val(ui.item.data); 
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
        $('#txtVehiculo_salidas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id del vehículo
            if($('#txtVehiculoID_salidas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtVehiculo_salidas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtVehiculoID_salidas_maquinaria_traspaso_maquinaria').val('');
               $('#txtVehiculo_salidas_maquinaria_traspaso_maquinaria').val('');
            }

        });

        //Autocomplete para recuperar los datos de una serie correspondiente a maquinaria_inventario
        $('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
               $('#txtMaquinariaDescripcionID_detalles_salidas_maquinaria_traspaso_maquinaria').val('');	
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "maquinaria/maquinaria_inventario/autocomplete",
                 type: "post",
                 dataType: "json",
                 data: {
                   	intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val(),
					strDescripcion: request.term, 
					strTipo: 'serie'
                 },
                 success: function( data ) {
                   response( data );
                 }
               });
           },
           select: function( event, ui ) {

           		//Asignar datos del registro seleccionado
				//Elegir serie desde el valor devuelto en el autocomplete
				ui.item.value = ui.item.value.split(" - ")[0];

             	//Asignar id del registro seleccionado
             	$('#txtMaquinariaDescripcionID_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.maquinaria_descripcion_id); 
             	$('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.serie); 
             	$('#txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.motor);
             	$('#txtCodigo_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.codigo);
             	$('#txtDescripcionCorta_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.descripcion_corta);
             	$('#txtDescripcion_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.descripcion);
             	$('#txtNumeroPedimento_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.numero_pedimento);
             	$('#txtConsignacion_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.consignacion);

           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });

	    //Verificar que exista id del inventario de la descripción de maquinaria cuando pierda el enfoque la caja de texto
        $('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id del inventario de la descripción de maquinaria
            if($('#txtMaquinariaDescripcionID_detalles_salidas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtMaquinariaDescripcionID_detalles_salidas_maquinaria_traspaso_maquinaria').val('');
               $('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').val('');
               $('#txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria').val('');
               //Hacer un llamado a la función para inicializar elementos del detalle
				inicializar_detalle_salidas_maquinaria_traspaso_maquinaria();
			

            }
        });

        //Autocomplete para recuperar los datos de inventario de la descripción de maquinaria
		$('#txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria').autocomplete({
			source: function(request, response) {
				
				$.ajax({
					//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
					url: "maquinaria/maquinaria_inventario/autocomplete",
					type: "post",
					dataType: "json",
					data: {
						intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val(),
						strDescripcion: request.term,
						strTipo: 'motor'
					},
					success: function( data ) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				//Asignar id del registro seleccionado
	             $('#txtMaquinariaDescripcionID_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.maquinaria_descripcion_id); 
	             $('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.serie); 
	             $('#txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.motor);
	             $('#txtCodigo_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.codigo);
	             $('#txtDescripcionCorta_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.descripcion_corta);
	             $('#txtDescripcion_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.descripcion);
	             $('#txtNumeroPedimento_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.numero_pedimento);
             	 $('#txtConsignacion_detalles_salidas_maquinaria_traspaso_maquinaria').val(ui.item.consignacion);
				//Elegir motor desde el valor devuelto en el autocomplete
				ui.item.value = ui.item.value.split(" - ")[1];
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			},
			minLength: 1
		});


		//Verificar que exista id del inventario de la descripción de maquinaria cuando pierda el enfoque la caja de texto
        $('#txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id del inventario de la descripción de maquinaria
            if($('#txtMaquinariaDescripcionID_detalles_salidas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtMotor_detalles_salidas_maquinaria_traspaso_maquinaria').val('');

            }
        });

        //Función para mover renglones arriba y abajo en la tabla
		$('#dg_detalles_salidas_maquinaria_traspaso_maquinaria').on('click','button.btn',function(){
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
		$('#btnAditamentos_salidas_maquinaria_traspaso_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			if($('#txtSerie_detalles_salidas_maquinaria_traspaso_maquinaria').val() != ''){
				nuevo_aditamentos_salidas_maquinaria_traspaso_maquinaria('');
			}
				
		});


		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_salidas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_salidas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_salidas_maquinaria_traspaso_maquinaria').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_salidas_maquinaria_traspaso_maquinaria').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_salidas_maquinaria_traspaso_maquinaria').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_salidas_maquinaria_traspaso_maquinaria').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_salidas_maquinaria_traspaso_maquinaria').on('click','a',function(event){
			event.preventDefault();
			intPaginaSalidasMaquinariaTraspasoMaquinaria = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_salidas_maquinaria_traspaso_maquinaria();
		});

		//Autocomplete para recuperar los datos de un proveedor 
        $('#txtSucursalDestinoBusq_salidas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtSucursalDestinoIDBusq_salidas_maquinaria_traspaso_maquinaria').val('');
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
             $('#txtSucursalDestinoIDBusq_salidas_maquinaria_traspaso_maquinaria').val(ui.item.data);
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
        $('#txtSucursalDestinoBusq_salidas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id del proveedor
            if($('#txtSucursalDestinoIDBusq_salidas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtSucursalDestinoBusq_salidas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtSucursalDestinoIDBusq_salidas_maquinaria_traspaso_maquinaria').val('');
               $('#txtSucursalDestinoBusq_salidas_maquinaria_traspaso_maquinaria').val('');
            }

        });

        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_salidas_maquinaria_traspaso_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_salidas_maquinaria_traspaso_maquinaria('Nuevo');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_salidas_maquinaria_traspaso_maquinaria').addClass("estatus-NUEVO");
			//Abrir modal
			 objSalidasMaquinariaTraspasoMaquinaria = $('#SalidasMaquinariaTraspasoMaquinariaBox').bPopup({
										   appendTo: '#SalidasMaquinariaTraspasoMaquinariaContent', 
			                               contentContainer: 'SalidasMaquinariaTraspasoMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});

			 //Enfocar caja de texto
             $('#txtSucursalDestino_salidas_maquinaria_traspaso_maquinaria').focus();
			
		});

       //Enfocar caja de texto
        $('#txtFechaInicialBusq_salidas_maquinaria_traspaso_maquinaria').focus();


		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_salidas_maquinaria_traspaso_maquinaria();

	});

</script>