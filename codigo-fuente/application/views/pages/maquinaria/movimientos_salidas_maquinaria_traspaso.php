<div id="MovimientosSalidasMaquinariaTraspasoMaquinariaContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_movimientos_salidas_maquinaria_traspaso_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_movimientos_salidas_maquinaria_traspaso_maquinaria">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_movimientos_salidas_maquinaria_traspaso_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_movimientos_salidas_maquinaria_traspaso_maquinaria"
			                    		name= "strFechaInicialBusq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
							<label for="txtFechaFinalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria"
			                    		name= "strFechaFinalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
				<!--Autocomplete que contiene las sucursales activas (sin incluir la sucursal que se encuentra logeada en el sistema)-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtSucursalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria">Sucursal</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtSucursalIDBusq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									name="strSucursalIDBusq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									type="hidden" />
							<input  class="form-control" 
									id="txtSucursalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									name="strSucursalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese sucursal" maxlength="250">
						</div>
					</div>
				</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_movimientos_salidas_maquinaria_traspaso_maquinaria">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
								 		name="strEstatusBusq_movimientos_salidas_maquinaria_traspaso_maquinaria" tabindex="1">
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
								<label for="txtBusqueda_movimientos_salidas_maquinaria_traspaso_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										name="strBusqueda_movimientos_salidas_maquinaria_traspaso_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									   	name="strImprimirDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
							<button class="btn btn-primary" id="btnBuscar_movimientos_salidas_maquinaria_traspaso_maquinaria"
									onclick="paginacion_movimientos_salidas_maquinaria_traspaso_maquinaria();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_movimientos_salidas_maquinaria_traspaso_maquinaria"
									onclick="reporte_movimientos_salidas_maquinaria_traspaso_maquinaria('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_movimientos_salidas_maquinaria_traspaso_maquinaria"
									onclick="reporte_movimientos_salidas_maquinaria_traspaso_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
			td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
			td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
			td.movil.b3:nth-of-type(3):before {content: "Solicitado"; font-weight: bold;}
			td.movil.b4:nth-of-type(4):before {content: "Surtido"; font-weight: bold;}
			td.movil.b5:nth-of-type(5):before {content: "Costo Unit."; font-weight: bold;}
			td.movil.b6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
			td.movil.b7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}
		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_movimientos_salidas_maquinaria_traspaso_maquinaria">
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
				<script id="plantilla_movimientos_salidas_maquinaria_traspaso_maquinaria" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil">{{folio}}</td>
						<td class="movil">{{fecha}}</td>
						<td class="movil">{{sucursalSalida}}</td>
						<td class="movil">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="verificar_entrada_movimientos_salidas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}},'Editar')"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_movimientos_salidas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}},'Ver')"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_movimientos_salidas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_movimientos_salidas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}},'{{estatus}}')" title="Desactivar">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
									onclick="cambiar_estatus_movimientos_salidas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}},'{{estatus}}')"  title="Restaurar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_salidas_maquinaria_traspaso_maquinaria"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_movimientos_salidas_maquinaria_traspaso_maquinaria">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!-- Diseño del modal-->
	<div id="MovimientosSalidasMaquinariaTraspasoMaquinariaBox" class="ModalBody"  tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_movimientos_salidas_maquinaria_traspaso_maquinaria"  class="ModalBodyTitle">
		<h1>Salidas por Traspaso</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmMovimientosSalidasMaquinariaTraspasoMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmMovimientosSalidasMaquinariaTraspasoMaquinaria"  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!-- Folio -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtMovimientoMaquinariaID_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									   name="intMovimientoCajaHerramientas_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtFolio_movimientos_salidas_maquinaria_traspaso_maquinaria">Folio</label>
								 <!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
								<input id="txtEstatus_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									   name="strEstatus_movimientos_salidas_maquinaria_traspaso_maquinaria" type="hidden" value="">
								</input>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
								        id="txtFolio_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										name="strFolio_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
								<label for="txtFecha_movimientos_salidas_maquinaria_traspaso_maquinaria">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_movimientos_salidas_maquinaria_traspaso_maquinaria'>
				                    <input class="form-control" 
				                    		id="txtFecha_movimientos_salidas_maquinaria_traspaso_maquinaria"
				                    		name= "strFecha_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
					  <!--Autocomplete que contiene las sucursales activas (sin incluir la sucursal que se encuentra logeada en el sistema)-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								 <!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal seleccionada-->
								<input id="txtSucursalDestinoID_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									   name="intSucursalDestinoID_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtSucursalDestino_movimientos_salidas_maquinaria_traspaso_maquinaria">Sucursal</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSucursalDestino_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										name="strSucursalDestino_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
					<!--Autocomplete que contiene los choferes activos-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del chofer seleccionado-->
								<input id="txtChoferID_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									   name="intChoferID_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtChofer_movimientos_salidas_maquinaria_traspaso_maquinaria">Chofer</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtChofer_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										name="strChofer_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese chofer" 
										maxlength="100" />			
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los vehículos activos-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del Vehiculo seleccionado-->
								<input id="txtVehiculoID_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									   name="intVehiculoID_movimientos_salidas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtVehiculo_movimientos_salidas_maquinaria_traspaso_maquinaria">Vehículo</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtVehiculo_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										name="strVehiculo_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese vehículo" 
										maxlength="250" />			
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Observaciones -->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtObservaciones_movimientos_salidas_maquinaria_traspaso_maquinaria">Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										name="strObservaciones_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
								<input id="txtNumDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
							   		name="intNumDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria" type="hidden" value="">
								</input>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Detalles de la salida por traspaso</h4>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Serie-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<input id="txtMaquinariaDescripcionID_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
																   name="intMaquinariaDescripcionID_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
																   type="hidden" 
																   value="" />
																<label for="txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria">Serie</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad" 
																		id="txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
																		name="strSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
																<label for="txtMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria">Motor</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad" 
																		id="txtMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
																		name="strMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
																<input id="txtRenglon_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
																	   name="intRenglon_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
																	   type="hidden" 
																	   value="" />	   
																<label for="txtCodigo_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
																		name="strCodigo_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
														<input id="txtDescripcion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
															   name="strDescripcion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
															   type="hidden" 
															   value="" />
														<input id="txtNumeroPedimento_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
															   name="strNumeroPedimento_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
															   type="hidden" 
															   value="" />
														<input id="txtConsignacion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
															   name="strConsignacion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
															   type="hidden" 
															   value="" />	   	   
														<label for="txtDescripcionCorta_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria">Descripción</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control" 
																id="txtDescripcionCorta_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
																name="strDescripcionCorta_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
															id="btnAgregar_movimientos_salidas_maquinaria_traspaso_maquinaria"
															onclick="agregar_renglon_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria();" 
															title="Agregar" tabindex="1"> 
														<span class="glyphicon glyphicon-plus"></span>
													</button>
													<!-- Agregar aditamentos a un renglón -->
													<button class="btn btn-info"  
															id="btnVerAditamentos_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
													<table class="table-hover movil" id="dg_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria">
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
																<strong id="numElementos_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria">0</strong> encontrados
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
								id="btnReset_movimientos_salidas_maquinaria_traspaso_maquinaria"  
								onclick="nuevo_movimientos_salidas_maquinaria_traspaso_maquinaria('Nuevo');"  
								title="Nuevo registro" 
								tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" 
								id="btnGuardar_movimientos_salidas_maquinaria_traspaso_maquinaria"  
								onclick="validar_movimientos_salidas_maquinaria_traspaso_maquinaria();"  
								title="Guardar" 
								tabindex="2" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_movimientos_salidas_maquinaria_traspaso_maquinaria"  
								onclick="reporte_registro_movimientos_salidas_maquinaria_traspaso_maquinaria('');"  
								title="Imprimir" 
								tabindex="5" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" id="btnDesactivar_movimientos_salidas_maquinaria_traspaso_maquinaria"  
								onclick="cambiar_estatus_movimientos_salidas_maquinaria_traspaso_maquinaria('','ACTIVO');"  title="Desactivar" tabindex="8" disabled>
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Restaurar registro-->
						<button class="btn btn-default" id="btnRestaurar_movimientos_salidas_maquinaria_traspaso_maquinaria"  
								onclick="cambiar_estatus_movimientos_salidas_maquinaria_traspaso_maquinaria('','INACTIVO');"  title="Restaurar" tabindex="9" disabled>
							<span class="fa fa-exchange"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  
								id="btnCerrar_movimientos_salidas_maquinaria_traspaso_maquinaria"
								type="reset" 
								aria-hidden="true" 
								onclick="cerrar_movimientos_salidas_maquinaria_traspaso_maquinaria();" 
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
	<div id="AditamentosMovimientosSalidasMaquinariaTraspasoMaquinariaBox" class="ModalBody" tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria" class="ModalBodyTitle">
			<h1>Ver aditamentos</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmAditamentosMovimientosSalidasMaquinariaTraspasoMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmAditamentosMovimientosSalidasMaquinariaTraspasoMaquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
				  	<!--Código-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el renglón seleccionado -->	
								<label for="txtCodigoMaq_movimientos_salidas_maquinaria_traspaso_maquinaria">Código</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtCodigoMaq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										name="strCodigoMaq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtDescripcionMaq_movimientos_salidas_maquinaria_traspaso_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtDescripcionMaq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										name="strDescripcionMaq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Serie-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtSerieMaq_movimientos_salidas_maquinaria_traspaso_maquinaria">Serie</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSerieMaq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										name="strSerieMaq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Motor-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtMotorMaq_movimientos_salidas_maquinaria_traspaso_maquinaria">Motor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtMotorMaq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
										name="strMotorMaq_movimientos_salidas_maquinaria_traspaso_maquinaria" 
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
									<table class="table-hover" id="dg_aditamentos_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria">
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
												<strong id="numElementos_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria">0</strong> encontrados
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
						<button class="btn  btn-cerrar"  id="btnCerrar_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria"
								type="reset" aria-hidden="true" onclick="cerrar_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria();" title="Cerrar">
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

</div><!--#MovimientosSalidasMaquinariaTraspasoMaquinariaContent -->


<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variables que se utilizan para la paginación de registros
	var intPaginaMovimientosSalidasMaquinariaTraspasoMaquinaria = 0;
	var strUltimaBusquedaMovimientosSalidasMaquinariaTraspasoMaquinaria = "";
	//Variables que se utilizan para la búsqueda de registros
	var intMecanicoIDMovimientosSalidasMaquinariaTraspasoMaquinaria = "";
	var dteFechaInicialMovimientosSalidasMaquinariaTraspasoMaquinaria = "";
	var dteFechaFinalMovimientosSalidasMaquinariaTraspasoMaquinaria = "";
	//Variable que se utiliza para asignar objeto del modal
	var objMovimientosSalidasMaquinariaTraspasoMaquinaria = null;
	//Variable que se utiliza para asignar objeto del modal secundario
	var objAditamentosMovimientosSalidasMaquinariaTraspasoMaquinaria = null;

	
	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_movimientos_salidas_maquinaria_traspaso_maquinaria()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('maquinaria/movimientos_salidas_maquinaria_traspaso/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_movimientos_salidas_maquinaria_traspaso_maquinaria').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria = data.row;
				//Separar la cadena 
				var arrPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria = strPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_movimientos_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria[i]=='GUARDAR') || (arrPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_movimientos_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					//Si el indice es VER REGISTRO
					else if(arrPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria[i]=='VER REGISTRO')
					{
						
					}
					else if(arrPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_movimientos_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_movimientos_salidas_maquinaria_traspaso_maquinaria();
					}
					else if(arrPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_movimientos_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
						$('#btnRestaurar_movimientos_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_movimientos_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_movimientos_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosSalidasMaquinariaTraspasoMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_movimientos_salidas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_movimientos_salidas_maquinaria_traspaso_maquinaria() 
	{
		

		
	   	//Concatenar datos para la nueva búsqueda
		var strNuevaBusquedaMovimientosSalidasMaquinariaTraspasoMaquinaria =($('#txtFechaInicialBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val()+$('#txtFechaFinalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val()+$('#txtSucursalIDBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val()+$('#cmbEstatusBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val()+$('#txtBusqueda_movimientos_salidas_maquinaria_traspaso_maquinaria').val());

		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaMovimientosSalidasMaquinariaTraspasoMaquinaria != strUltimaBusquedaMovimientosSalidasMaquinariaTraspasoMaquinaria)
		{
			intPaginaMovimientosSalidasMaquinariaTraspasoMaquinaria = 0;
			strUltimaBusquedaMovimientosSalidasMaquinariaTraspasoMaquinaria = strNuevaBusquedaMovimientosSalidasMaquinariaTraspasoMaquinaria;
		}

		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('maquinaria/movimientos_salidas_maquinaria_traspaso/get_paginacion',
				{	dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val()),
	    			dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val()),
	    			intSucursalID: $('#txtSucursalIDBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val(),
	    			strEstatus: $('#cmbEstatusBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val(),
					strBusqueda: $('#txtBusqueda_movimientos_salidas_maquinaria_traspaso_maquinaria').val(),
					intPagina:intPaginaMovimientosSalidasMaquinariaTraspasoMaquinaria,
					strPermisosAcceso: $('#txtAcciones_movimientos_salidas_maquinaria_traspaso_maquinaria').val()
				},
				function(data){
					$('#dg_movimientos_salidas_maquinaria_traspaso_maquinaria tbody').empty();
					var tmpMovimientosSalidasMaquinariaTraspasoMaquinaria = Mustache.render($('#plantilla_movimientos_salidas_maquinaria_traspaso_maquinaria').html(),data);
					$('#dg_movimientos_salidas_maquinaria_traspaso_maquinaria tbody').html(tmpMovimientosSalidasMaquinariaTraspasoMaquinaria);
					$('#pagLinks_movimientos_salidas_maquinaria_traspaso_maquinaria').html(data.paginacion);
					$('#numElementos_movimientos_salidas_maquinaria_traspaso_maquinaria').html(data.total_rows);
					intPaginaMovimientosSalidasMaquinariaTraspasoMaquinaria = data.pagina;
				},
		'json');
	}

	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_movimientos_salidas_maquinaria_traspaso_maquinaria(strTipo) 
	{	
		 //Variable que se utiliza para asignar URL (ruta del controlador)
	        var strUrl = 'maquinaria/movimientos_salidas_maquinaria_traspaso/';

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
			if ($('#chbImprimirDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val('NO');
			}

	        //Definir encapsulamiento de datos que son necesarios para generar el reporte
	        objReporte = {'url': strUrl,
	                        'data' : {
	                                   'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val()),
	                                    'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val()),
	                                    'intSucursalDestinoID': $('#txtSucursalIDBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val(),
	                                    'strEstatus': $('#cmbEstatusBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val(), 
	                                    'strBusqueda': $('#txtBusqueda_movimientos_salidas_maquinaria_traspaso_maquinaria').val(),
	                                    'strDetalles': $('#chbImprimirDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val()       
	                                 }
	                       };


	        //Hacer un llamado a la función para imprimir/descargar el reporte
	        $.imprimirReporte(objReporte);

	}

	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_movimientos_salidas_maquinaria_traspaso_maquinaria(id)
	{	

		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la impresión desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_movimientos_salidas_maquinaria_traspaso_maquinaria').val();
		}
		else
		{
			intID = id;
		}

		 //Definir encapsulamiento de datos que son necesarios para generar el reporte
        objReporte = {'url': 'maquinaria/movimientos_salidas_maquinaria_traspaso/get_reporte_registro',
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
	function nuevo_movimientos_salidas_maquinaria_traspaso_maquinaria(tipoAccion)
	{
		
		//Incializar formulario
		$('#frmMovimientosSalidasMaquinariaTraspasoMaquinaria')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_movimientos_salidas_maquinaria_traspaso_maquinaria();
		//Limpiar cajas de texto ocultas
		$('#frmMovimientosSalidasMaquinariaTraspasoMaquinaria').find('input[type=hidden]').val('');

		//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
         $.removerClasesEncabezado('divEncabezadoModal_movimientos_salidas_maquinaria_traspaso_maquinaria');

		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		inicializar_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria();	

		//Habilitar todos los elementos del formulario
		$('#frmMovimientosSalidasMaquinariaTraspasoMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');

		//Asignar la fecha actual
		$('#txtFecha_movimientos_salidas_maquinaria_traspaso_maquinaria').val(fechaActual()); 
		//Deshabilitar las siguientes cajas de texto
		$('#txtFolio_movimientos_salidas_maquinaria_traspaso_maquinaria').attr("disabled", "disabled");
		$('#txtCodigo_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').attr("disabled", "disabled");
		$('#txtDescripcionCorta_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').attr("disabled", "disabled");
		

		//Mostrar los siguientes botones
		$("#btnGuardar_movimientos_salidas_maquinaria_traspaso_maquinaria").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_movimientos_salidas_maquinaria_traspaso_maquinaria").hide();
		$("#btnDesactivar_movimientos_salidas_maquinaria_traspaso_maquinaria").hide();
		$("#btnRestaurar_movimientos_salidas_maquinaria_traspaso_maquinaria").hide();
		
	}


	//Función para inicializar elementos de la tabla detalles
	function inicializar_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria()
	{
		//Eliminar los datos de la tabla detalles del movimiento
		$('#dg_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria tbody').empty();
		$('#numElementos_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').html(0);
		$('#txtNumDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria').html('');
	}
	
	
	//Función que se utiliza para cerrar el modal
	function cerrar_movimientos_salidas_maquinaria_traspaso_maquinaria()
	{
		try {

			//Hacer un llamado a la función para cerrar modal Aditamentos
			cerrar_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria();
			//Cerrar modal
			objMovimientosSalidasMaquinariaTraspasoMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').focus();	
		}
		catch(err) {}
	}

	
	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_movimientos_salidas_maquinaria_traspaso_maquinaria()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_movimientos_salidas_maquinaria_traspaso_maquinaria();
		//Validación del formulario de campos obligatorios
		$('#frmMovimientosSalidasMaquinariaTraspasoMaquinaria')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_movimientos_salidas_maquinaria_traspaso_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
									    strSucursalDestino_movimientos_salidas_maquinaria_traspaso_maquinaria: {
											validators: {
											    callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la sucursal
					                                    if( $('#txtSucursalDestinoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val() === '')
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
										strChofer_movimientos_salidas_maquinaria_traspaso_maquinaria: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del chofer
					                                    if(value != '' && $('#txtChoferID_movimientos_salidas_maquinaria_traspaso_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un chofer existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strVehiculo_movimientos_salidas_maquinaria_traspaso_maquinaria: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vehículo
					                                    if(value != '' && $('#txtVehiculoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un vehículo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strObservaciones_movimientos_salidas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intNumDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta salida por traspaso.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strCodigo_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strDescripcion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										}

									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_movimientos_salidas_maquinaria_traspaso_maquinaria = $('#frmMovimientosSalidasMaquinariaTraspasoMaquinaria').data('bootstrapValidator');
		bootstrapValidator_movimientos_salidas_maquinaria_traspaso_maquinaria.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_movimientos_salidas_maquinaria_traspaso_maquinaria.isValid())
		{	
			//Hacer un llamado a la función para guardar los datos del registro
			guardar_movimientos_salidas_maquinaria_traspaso_maquinaria();				
		}
		else 
			return;
	}

	
	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_movimientos_salidas_maquinaria_traspaso_maquinaria()
	{
		try
		{
			$('#frmMovimientosSalidasMaquinariaTraspasoMaquinaria').data('bootstrapValidator').resetForm();

		}
		catch(err) {}
	}

	
	//Función para guardar o modificar los datos de un registro
	function guardar_movimientos_salidas_maquinaria_traspaso_maquinaria()
	{	

		//Obtenemos el objeto de la tabla detalles
		var objTabla = document.getElementById('dg_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];

		//Inicializamos las variables que obtendrán los datos de la tabla
		var arrMaquinariaDescripcionID = [];
		var arrCodigos = [];
		var arrDescripcionesCortas = [];
	    var arrDescripciones = [];
	    var arrSeries = [];
	    var arrMotores = [];
	    var arrNumerosPedimento = [];

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Asignar valores a los arrays
			arrMaquinariaDescripcionID.push(objRen.cells[8].innerHTML);
			arrCodigos.push(objRen.cells[2].innerHTML);
			arrDescripcionesCortas.push(objRen.cells[3].innerHTML);
			arrDescripciones.push(objRen.cells[5].innerHTML);
			arrSeries.push(objRen.cells[0].innerHTML);
			arrMotores.push(objRen.cells[1].innerHTML);
			arrNumerosPedimento.push(objRen.cells[6].innerHTML);
		}

		//Hacer un llamado al método del controlador para guardar los datos del registro	
		$.post('maquinaria/movimientos_salidas_maquinaria_traspaso/guardar',
		{ 
			//Datos del movimiento
			intMovimientoMaquinariaID: $('#txtMovimientoMaquinariaID_movimientos_salidas_maquinaria_traspaso_maquinaria').val(),
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_salidas_maquinaria_traspaso_maquinaria').val()),
			intReferenciaID: $('#txtSucursalDestinoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val(),
			intChoferID: $('#txtChoferID_movimientos_salidas_maquinaria_traspaso_maquinaria').val(),
			intVehiculoID: $('#txtVehiculoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val(),
			strObservaciones: $('#txtObservaciones_movimientos_salidas_maquinaria_traspaso_maquinaria').val(),
			intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_maquinaria_traspaso_maquinaria').val(),

			//Datos de los detalles
			strMaquinariaDescripcionID: arrMaquinariaDescripcionID.join('|'),
			strCodigos: arrCodigos.join('|'),
			strDescripcionesCortas: arrDescripcionesCortas.join('|'),
			strDescripciones: arrDescripciones.join('|'),
			strSeries: arrSeries.join('|'),
			strMotores: arrMotores.join('|'),
			strNumerosPedimento: arrNumerosPedimento.join('|')

		},
		function(data) {

			if (data.resultado)
			{	    
                
                //Hacer un llamado a la función para cerrar modal
                cerrar_movimientos_salidas_maquinaria_traspaso_maquinaria();
                //Hacer llamado a la función  para cargar  los registros en el grid
               	paginacion_movimientos_salidas_maquinaria_traspaso_maquinaria();         	    
			}

			//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			mensaje_movimientos_salidas_maquinaria_traspaso_maquinaria(data.tipo_mensaje, data.mensaje);
		},
		'json');
			
	}

	//Función para mostrar mensaje de éxito o error
	function mensaje_movimientos_salidas_maquinaria_traspaso_maquinaria(tipoMensaje, mensaje)
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
	function cambiar_estatus_movimientos_salidas_maquinaria_traspaso_maquinaria(id, estatus)
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoCajaHerramientasID_movimientos_salidas_maquinaria_traspaso_maquinaria').val();

		}
		else
		{
			intID = id;
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
		                              $.post('maquinaria/movimientos_salidas_maquinaria_traspaso/set_estatus',
		                                     {
		                                     	intMovimientoMaquinariaID: intID,
		                                      	strEstatus: estatus
		                                     },
		                                     function(data) {
		                                        if(data.resultado)
		                                        {
		                                          	//Hacer llamado a la función  para cargar  los registros en el grid
		                                          	paginacion_movimientos_salidas_maquinaria_traspaso_maquinaria();
		                                          	//Si el id del registro se obtuvo del modal
													if(id == '')
													{
														//Hacer un llamado a la función para cerrar modal
														cerrar_movimientos_salidas_maquinaria_traspaso_maquinaria();     
													}
		                                        }
		                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		                                        mensaje_movimientos_salidas_maquinaria_traspaso_maquinaria(data.tipo_mensaje, data.mensaje);
		                                     },
		                                    'json');
		                            }
		                          }
		              });
	    
	}

	//Método para verificar si el movimiento de salida por traspaso ya presenta una entrada por traspaso
	function verificar_entrada_movimientos_salidas_maquinaria_traspaso_maquinaria(id, tipoAccion){

		//Hacer un llamado al método del controlador para regresar los datos del registro
	   $.post('maquinaria/movimientos_salidas_maquinaria_traspaso/verificar_entrada',
       {
       		intMovimientoMaquinariaID:id
       },
       function(data) {

        	//Si hay datos del registro 
            if(data.row)
            {  
            	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    mensaje_movimientos_salidas_maquinaria_traspaso_maquinaria('error', 'No es posible editar este movimiento. Ya que presenta una entrada por traspaso ACTIVA en otra sucursal');
            	editar_movimientos_salidas_maquinaria_traspaso_maquinaria(id, 'Ver');
            }
            else{
            	editar_movimientos_salidas_maquinaria_traspaso_maquinaria(id, 'Editar');
            }
        },
       'json');    

	}

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_movimientos_salidas_maquinaria_traspaso_maquinaria(id, tipoAccion)
	{	
	   //Hacer un llamado al método del controlador para regresar los datos del registro
	   $.post('maquinaria/movimientos_salidas_maquinaria_traspaso/get_datos',
       {
       		intMovimientoMaquinariaID:id
       },
       function(data) {

        	//Si hay datos del registro 
            if(data.row)
            {  
            	//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_movimientos_salidas_maquinaria_traspaso_maquinaria();
				//Asignar estatus del registro
				var strEstatus = data.row.estatus;
	          	//Recuperar valores para la Vista
	            $('#txtMovimientoMaquinariaID_movimientos_salidas_maquinaria_traspaso_maquinaria').val(data.row.movimiento_maquinaria_id);
	            $('#txtFolio_movimientos_salidas_maquinaria_traspaso_maquinaria').val(data.row.folio);
	            $('#txtFecha_movimientos_salidas_maquinaria_traspaso_maquinaria').val(data.row.fecha);
	            $('#txtSucursalDestinoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val(data.row.sucursalDestinoID);
	            $('#txtSucursalDestino_movimientos_salidas_maquinaria_traspaso_maquinaria').val(data.row.sucursalDestino);
				$('#txtChoferID_movimientos_salidas_maquinaria_traspaso_maquinaria').val(data.row.chofer_id);
				$('#txtChofer_movimientos_salidas_maquinaria_traspaso_maquinaria').val(data.row.chofer);
				$('#txtVehiculoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val(data.row.vehiculo_id);
				$('#txtVehiculo_movimientos_salidas_maquinaria_traspaso_maquinaria').val(data.row.vehiculo);
				$('#txtObservaciones_movimientos_salidas_maquinaria_traspaso_maquinaria').val(data.row.observaciones);
	
	           	//Mostramos los detalles del registro
	           	for (var intCon in data.detalles) 
	            {	
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];
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
												 " onclick='editar_renglon_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Aditamentos'" +
												 " onclick='ver_aditamentos_renglon_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria(this)'>" +
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

	            }

				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria tr").length - 1;
				$('#numElementos_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').html(intFilas);
				$('#txtNumDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(intFilas);
				
				//Dependiendo del estatus cambiar el color del encabezado 
	            $('#divEncabezadoModal_movimientos_salidas_maquinaria_traspaso_maquinaria').addClass("estatus-"+ strEstatus);
	            //Mostrar botón Imprimir  
	            $("#btnImprimirRegistro_movimientos_salidas_maquinaria_traspaso_maquinaria").show();

				//Si el tipo de acción corresponde a Ver
	            if(tipoAccion == 'Ver')
	            {
	            	//Deshabilitar todos los elementos del formulario
	            	$('#frmMovimientosSalidasMaquinariaTraspasoMaquinaria').find('input, textarea, select').attr('disabled','disabled');
	            	//Ocultar los siguientes botones
		            $("#btnGuardar_movimientos_salidas_maquinaria_traspaso_maquinaria").hide();

		            //Si el estatus del registro es INACTIVO
	            	if(strEstatus == 'INACTIVO')
	            	{
	            		//Mostrar botón Restaurar
	            		$("#btnRestaurar_movimientos_salidas_maquinaria_traspaso_maquinaria").show();
	            	}
	            }
	            else
	            {
	            	//Deshabilitar todos los elementos del formulario
	            	$('#frmMovimientosSalidasMaquinariaTraspasoMaquinaria').find('input, textarea, select').attr('disabled', false);
	            	$('#txtFolio_movimientos_salidas_maquinaria_traspaso_maquinaria').attr('disabled','disabled');
	            	$('#txtCodigo_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').attr('disabled','disabled');
	            	$('#txtDescripcionCorta_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').attr('disabled','disabled');

	            	//Si el estatus del registro es ACTIVO
		            if(strEstatus == 'ACTIVO')
		            {
		            	//Mostrar los siguientes botones  
		            	$("#btnDesactivar_movimientos_salidas_maquinaria_traspaso_maquinaria").show();
		            }
	            }
				
	            //Abrir modal
			 	objMovimientosSalidasMaquinariaTraspasoMaquinaria = $('#MovimientosSalidasMaquinariaTraspasoMaquinariaBox').bPopup({
										   appendTo: '#MovimientosSalidasMaquinariaTraspasoMaquinariaContent', 
			                               contentContainer: 'MovimientosSalidasMaquinariaTraspasoMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});

	            //Enfocar caja de texto
				$('#txtFecha_movimientos_salidas_maquinaria_traspaso_maquinaria').focus();
       	    }
       	    
       },
       'json');
	}

	
	
	

	/*******************************************************************************************************************
	Funciones de la tabla detalles
	*********************************************************************************************************************/
	//Función para inicializar elementos de la maquinaria
	function inicializar_maquinaria_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria()
	{
		
		//Limpiar contenido de las siguientes cajas de texto
        $('#txtMaquinariaDescripcionID_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
        $('#txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
        $('#txtMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
       	$('#txtCodigo_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
     	$('#txtDescripcionCorta_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
     	$('#txtDescripcion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
     	$('#txtNumeroPedimento_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
     	$('#txtConsignacion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
	}


	//Función para agregar renglón a la tabla
	function agregar_renglon_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria()
	{
		//Obtenemos los datos de las cajas de texto
		var intMaquinariaDescripcionID = $('#txtMaquinariaDescripcionID_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val();
		var strSerie = $('#txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val();
		var strMotor = $('#txtMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val();
		var strCodigo = $('#txtCodigo_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val();
		var strDescripcionCorta = $('#txtDescripcionCorta_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val();
		var strDescripcion = $('#txtDescripcion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val();
		var strNumeroPedimento = $('#txtNumeroPedimento_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val();
		var strConsignacion = $('#txtConsignacion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val();

		
		//Si existe id de la maquinaria
		if(intMaquinariaDescripcionID != '')
		{

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];	

			

			//Revisamos si existe la serie proporcionada, si no es así, agregamos los datos
			if (objTabla.rows.namedItem(strSerie))
			{
				
				//Enfocar caja de texto
				$('#txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').focus();
				
			}
			else
			{
				
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
											 " onclick='editar_renglon_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Aditamentos'" +
											 " onclick='ver_aditamentos_renglon_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria(this)'>" +
											 "<span class='glyphicon glyphicon-cog'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
											   " onclick='eliminar_renglon_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria(this)'>" + 
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

			//Hacer un llamado a la función para inicializar elementos de la maquinaria
			inicializar_maquinaria_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria();
		}

		//Asignar el número de filas de la tabla (se quita la primer fila porque corresponde al encabezado de la tabla)
		var intFilas = $("#dg_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria tr").length - 1;
		$('#numElementos_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').html(intFilas);
		$('#txtNumDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(intFilas);
		
		
	}

	//Función para agregar Aditamentos del renglón seleccionado
	function editar_renglon_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria(objRenglon){

		//Asignar los valores a las cajas de texto
		$('#txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
		$('#txtMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
		$('#txtCodigo_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
		$('#txtDescripcionCorta_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
	}

	//Función para agregar Aditamentos del renglón seleccionado
	function ver_aditamentos_renglon_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria(objRenglon){

		//Hacer un llamado a la función para ver los aditamentos de la maquinaria
		ver_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria('grid', objRenglon);

	}

	//Función para quitar renglón de la tabla
	function eliminar_renglon_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria(objRenglon)
	{	
		//Obtener el indice del objeto renglón que se envía
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
		//Eliminar el renglón indicado
		document.getElementById("dg_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria").deleteRow(intRenglon);
	
		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria tr").length - 1;
		$('#numElementos_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').html(intFilas);
		$('#txtNumDetalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(intFilas);

		//Enfocar caja de texto
		$('#txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').focus();

	}


	/*******************************************************************************************************************
	Funciones del modal Aditamentos
	*********************************************************************************************************************/
	//Ver aditamentos de una maquinaria
	function ver_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria(tipo, objRenglon)
	{
		//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
		$.removerClasesEncabezado('divEncabezadoModal_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria');

		//Hacer un llamado a la función para inicializar elementos del aditamento
		inicializar_aditamentos_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria();

		//Variable que se utiliza para asignar el estatus del registros
		var strEstatus =  $('#txtEstatus_movimientos_salidas_maquinaria_traspaso_maquinaria').val();

		//Si no existe estatus, significa que es un nuevo registro
		if(strEstatus == '')
		{
			strEstatus = 'NUEVO';
		}

		//Dependiendo del estatus cambiar el color del encabezado 
		$('#divEncabezadoModal_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria').addClass("estatus-"+strEstatus);

		//Si se cumple la sentencia
		if($('#txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val() != '' || tipo == 'grid')
		{

			
			//Abrir modal secundario
			 objAditamentosMovimientosSalidasMaquinariaTraspasoMaquinaria = $('#AditamentosMovimientosSalidasMaquinariaTraspasoMaquinariaBox').bPopup({
										   appendTo: '#MovimientosSalidasMaquinariaTraspasoMaquinariaContent', 
			                               contentContainer: 'AditamentosMovimientosSalidasMaquinariaTraspasoMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});


			//Variables que se utilizan para asignar los datos del detalle
			var strCodigo = '';
			var strDescripcion = '';
			var strSerie = '';
			var strMotor = '';

			//Si el tipo corresponde al grid, significa que los datos se obtuvieron del renglón de la tabla
			if(tipo == 'grid')
			{
				strSerie = objRenglon.parentNode.parentNode.cells[0].innerHTML;
				strMotor = objRenglon.parentNode.parentNode.cells[1].innerHTML;
				strCodigo = objRenglon.parentNode.parentNode.cells[2].innerHTML;
				strDescripcion = objRenglon.parentNode.parentNode.cells[3].innerHTML;
				
			}
			else
			{
				strSerie = $('#txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val();
				strMotor = $('#txtMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val();
				strCodigo = $('#txtCodigo_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val();
				strDescripcion = $('#txtDescripcionCorta_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val();
			}

			//Asignar los valores que vienen del modal primario
			$('#txtCodigoMaq_movimientos_salidas_maquinaria_traspaso_maquinaria').val(strCodigo); 
			$('#txtDescripcionMaq_movimientos_salidas_maquinaria_traspaso_maquinaria').val(strDescripcion);
			$('#txtSerieMaq_movimientos_salidas_maquinaria_traspaso_maquinaria').val(strSerie);
			$('#txtMotorMaq_movimientos_salidas_maquinaria_traspaso_maquinaria').val(strMotor);

			//Consultar si la serie contiene aditamentos 
			//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
              $.post('maquinaria/maquinaria_inventario/get_aditamentos',
                  { 
                  	strSerie: $("#txtSerieMaq_movimientos_salidas_maquinaria_traspaso_maquinaria").val()
                  },
                  function(data) {

                  	//Si se econtró información
                    if(data)
                    {

                    	//Obtenemos el objeto de la tabla
						var objTabla = document.getElementById('dg_aditamentos_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];

						//Hacer recorrido para obtener los aditamentos de la maquinaria (detalle)
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

				        //Asignar el número de filas de la tabla (se quita la primera fila por que corresponde al encabezado de la tabla)
				        var intFilas = $("#dg_aditamentos_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria tr").length - 1;
						$('#numElementos_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria').html(intFilas);

                    }
                }
                 ,
                'json');

		}
		

	}

	//Función que se utiliza para cerrar el modal secundario
	function cerrar_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria()
	{
		try {

			//Cerrar modal
			objAditamentosMovimientosSalidasMaquinariaTraspasoMaquinaria.close();
				
		}
		catch(err) {}
	}

	//Función para inicializar elementos de la tabla detalles
	function inicializar_aditamentos_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria()
	{
		//Eliminar los datos de la tabla
		$('#dg_aditamentos_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria tbody').empty();
		$('#numElementos_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria').html(0);
	}


	//Al inicializar el componente
	$(document).ready(function() 
	{

        /*******************************************************************************************************************
        Controles correspondientes al modal
        *********************************************************************************************************************/
        //Agregar datepicker para seleccionar fecha
		$('#dteFecha_movimientos_salidas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFecha_movimientos_salidas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

        //Autocomplete para recuperar los datos de una sucursal diferente a la logeada 
        $('#txtSucursalDestino_movimientos_salidas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtSucursalDestinoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "administracion/sucursales/destino_autocomplete",
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
           	  $('#txtSucursalDestinoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.data);
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
        $('#txtSucursalDestino_movimientos_salidas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id de la sucursal de salida
            if($('#txtSucursalDestinoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtSucursalDestino_movimientos_salidas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtSucursalDestinoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
               $('#txtSucursalDestino_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
            }

        });

        //Autocomplete para recuperar los datos de un chofer
        $('#txtChofer_movimientos_salidas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtChoferID_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "maquinaria/choferes/autocomplete",
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
             $('#txtChoferID_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.data); 
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
        $('#txtChofer_movimientos_salidas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id del chofer
            if($('#txtChoferID_movimientos_salidas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtChofer_movimientos_salidas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtChoferID_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
               $('#txtChofer_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
            }

        });

        //Autocomplete para recuperar los datos de un vehículo
        $('#txtVehiculo_movimientos_salidas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtVehiculoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
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
             $('#txtVehiculoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.data); 
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
        $('#txtVehiculo_movimientos_salidas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id del vehículo
            if($('#txtVehiculoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtVehiculo_movimientos_salidas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtVehiculoID_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
               $('#txtVehiculo_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
            }

        });



        //Autocomplete para recuperar los datos de una serie correspondiente a maquinaria_inventario
        $('#txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
                //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtMaquinariaDescripcionID_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');	
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "maquinaria/maquinaria_inventario/autocomplete",
                 type: "post",
                 dataType: "json",
                 data: {
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

             	//Asignar datos del registro seleccionado
	         	$('#txtMaquinariaDescripcionID_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.maquinaria_descripcion_id); 
	         	$('#txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.serie); 
	         	$('#txtMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.motor);
	         	$('#txtCodigo_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.codigo);
	         	$('#txtDescripcionCorta_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.descripcion_corta);
	         	$('#txtDescripcion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.descripcion);
	         	$('#txtNumeroPedimento_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.numero_pedimento);
	         	$('#txtConsignacion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.consignacion);
             

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
        $('#txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').focusout(function(e){
            
             //Si no existe id del inventario de la descripción de maquinaria
            if($('#txtMaquinariaDescripcionID_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val() == '')
            {  
            	//Hacer un llamado a la función para inicializar elementos de la maquinaria
	             inicializar_maquinaria_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria();
            }
        });

        //Autocomplete para recuperar los datos de inventario de la descripción de maquinaria
		$('#txtMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').autocomplete({
			source: function(request, response) {
				
				$.ajax({
					//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
					url: "maquinaria/maquinaria_inventario/autocomplete",
					type: "post",
					dataType: "json",
					data: {
						intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(),
						strDescripcion: request.term,
						strTipo: 'motor'
					},
					success: function( data ) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				
				//Asignar datos del registro seleccionado
	         	$('#txtMaquinariaDescripcionID_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.maquinaria_descripcion_id); 
	         	$('#txtSerie_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.serie); 
	         	$('#txtMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.motor);
	         	$('#txtCodigo_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.codigo);
	         	$('#txtDescripcionCorta_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.descripcion_corta);
	         	$('#txtDescripcion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.descripcion);
	         	$('#txtNumeroPedimento_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.numero_pedimento);
	         	$('#txtConsignacion_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.consignacion);

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
        $('#txtMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id del inventario de la descripción de maquinaria
            if($('#txtMaquinariaDescripcionID_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
	           $('#txtMotor_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
            }
        });

        //Función para mover renglones arriba y abajo en la tabla
		$('#dg_detalles_movimientos_salidas_maquinaria_traspaso_maquinaria').on('click','button.btn',function(){
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
		$('#btnVerAditamentos_movimientos_salidas_maquinaria_traspaso_maquinaria').bind('click', function(e) {
			e.preventDefault();
		
			//Hacer un llamado a la función para ver los aditamentos de la maquinaria
			ver_aditamentos_detalle_movimientos_salidas_maquinaria_traspaso_maquinaria('');
		});


		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_movimientos_salidas_maquinaria_traspaso_maquinaria').on('click','a',function(event){
			event.preventDefault();
			intPaginaMovimientosSalidasMaquinariaTraspasoMaquinaria = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_movimientos_salidas_maquinaria_traspaso_maquinaria();
		});

		//Autocomplete para recuperar los datos de un proveedor 
        $('#txtSucursalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtSucursalIDBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "administracion/sucursales/autocomplete",
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
             $('#txtSucursalIDBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val(ui.item.data);
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
        $('#txtSucursalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id del proveedor
            if($('#txtSucursalIDBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtSucursalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtSucursalIDBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
               $('#txtSucursalBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').val('');
            }

        });

        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_movimientos_salidas_maquinaria_traspaso_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_movimientos_salidas_maquinaria_traspaso_maquinaria('Nuevo');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_movimientos_salidas_maquinaria_traspaso_maquinaria').addClass("estatus-NUEVO");
			//Abrir modal
			 objMovimientosSalidasMaquinariaTraspasoMaquinaria = $('#MovimientosSalidasMaquinariaTraspasoMaquinariaBox').bPopup({
										   appendTo: '#MovimientosSalidasMaquinariaTraspasoMaquinariaContent', 
			                               contentContainer: 'MovimientosSalidasMaquinariaTraspasoMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});
			
		});

        //
        $('#txtFechaInicialBusq_movimientos_salidas_maquinaria_traspaso_maquinaria').focus();


		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_movimientos_salidas_maquinaria_traspaso_maquinaria();

	});

</script>