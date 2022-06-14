<div id="MovimientosEntradasMaquinariaAjusteMaquinariaContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_movimientos_entradas_maquinaria_ajuste_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_movimientos_entradas_maquinaria_ajuste_maquinaria">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_movimientos_entradas_maquinaria_ajuste_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_movimientos_entradas_maquinaria_ajuste_maquinaria"
			                    		name= "strFechaInicialBusq_movimientos_entradas_maquinaria_ajuste_maquinaria" 
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
							<label for="txtFechaFinalBusq_movimientos_entradas_maquinaria_ajuste_maquinaria">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_movimientos_entradas_maquinaria_ajuste_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_movimientos_entradas_maquinaria_ajuste_maquinaria"
			                    		name= "strFechaFinalBusq_movimientos_entradas_maquinaria_ajuste_maquinaria" 
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
				<!--Descripción-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtBusqueda_movimientos_entradas_maquinaria_ajuste_maquinaria">Descripción</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtBusqueda_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									name="strBusqueda_movimientos_entradas_maquinaria_ajuste_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Estatus-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="cmbEstatusBusq_movimientos_entradas_maquinaria_ajuste_maquinaria">Estatus</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="cmbEstatusBusq_movimientos_entradas_maquinaria_ajuste_maquinaria" 
							 		name="strEstatusBusq_movimientos_entradas_maquinaria_ajuste_maquinaria" tabindex="1">
							    <option value="TODOS">TODOS</option>
                  				<option value="ACTIVO">ACTIVO</option>               				
                  				<option value="INACTIVO">INACTIVO</option>
             				</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									   	name="strImprimirDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									   	type="checkbox"
									   	value="" 
									   	tabindex="1" />
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
						<div id="ToolBtns" class="btn-group pull-right">
							<!-- Buscar registros -->
							<button class="btn btn-primary" id="btnBuscar_movimientos_entradas_maquinaria_ajuste_maquinaria"
									onclick="paginacion_movimientos_entradas_maquinaria_ajuste_maquinaria();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_movimientos_entradas_maquinaria_ajuste_maquinaria"
									onclick="reporte_movimientos_entradas_maquinaria_ajuste_maquinaria('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_movimientos_entradas_maquinaria_ajuste_maquinaria"
									onclick="reporte_movimientos_entradas_maquinaria_ajuste_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
			td.movil.a3:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
			td.movil.a4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

			/*
			Definir columnas de la tabla detalles del movimiento
			*/
			td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
			td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
			td.movil.b3:nth-of-type(3):before {content: "Serie"; font-weight: bold;}
			td.movil.b4:nth-of-type(4):before {content: "Motor"; font-weight: bold;}
			td.movil.b5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

			/*
			Definir columnas de la tabla aditamentos
			*/
			td.movil.c1:nth-of-type(1):before {content: "Cantidad"; font-weight: bold;}
			td.movil.c2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
			td.movil.c3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}

		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_movimientos_entradas_maquinaria_ajuste_maquinaria">
				<thead class="movil">
					<tr class="movil">
						<th class="movil">Folio</th>
						<th class="movil">Fecha</th>
						<th class="movil">Estatus</th>
						<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
					</tr>
				</thead>
				<tbody class="movil"></tbody>
				<script id="plantilla_movimientos_entradas_maquinaria_ajuste_maquinaria" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil a1">{{folio}}</td>
						<td class="movil a2">{{fecha}}</td>
						<td class="movil a3">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_movimientos_entradas_maquinaria_ajuste_maquinaria({{movimiento_maquinaria_id}},'Editar')"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_movimientos_entradas_maquinaria_ajuste_maquinaria({{movimiento_maquinaria_id}},'Ver')"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_movimientos_entradas_maquinaria_ajuste_maquinaria({{movimiento_maquinaria_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Generar póliza-->
							<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
									onclick="generar_poliza_movimientos_entradas_maquinaria_ajuste_maquinaria({{movimiento_maquinaria_id}}, 'principal')"  title="Generar póliza">
								<span class="glyphicon glyphicon-tags"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_movimientos_entradas_maquinaria_ajuste_maquinaria({{movimiento_maquinaria_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_entradas_maquinaria_ajuste_maquinaria"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_movimientos_entradas_maquinaria_ajuste_maquinaria">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->
	<!--Circulo de progreso-->
	<div id="divCirculoBarProgresoPrincipal_movimientos_entradas_maquinaria_ajuste_maquinaria" class="load-container load5 circulo_bar no-mostrar">
		<div class="loader">Loading...</div>
		<br><br>
		<div align=center><b>Espere un momento por favor.</b></div>
	</div> 	

	<!-- Diseño del modal Entradas de maquinaria por Ajuste-->
	<div id="MovimientosEntradasMaquinariaAjusteMaquinariaBox" class="ModalBody"  tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_movimientos_entradas_maquinaria_ajuste_maquinaria"  class="ModalBodyTitle">
		<h1>Entradas de Maquinaria por Ajuste</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmMovimientosEntradasMaquinariaAjusteMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmMovimientosEntradasMaquinariaAjusteMaquinaria"  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!-- Folio -->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									   name="intMovimientoCajaHerramientas_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									   type="hidden" 
									   value="" />
							     <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
								<input id="txtPolizaID_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									   name="intPolizaID_movimientos_entradas_maquinaria_ajuste_maquinaria" type="hidden" value="" />
							    <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
								<input id="txtFolioPoliza_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									   name="strFolioPoliza_movimientos_entradas_maquinaria_ajuste_maquinaria" type="hidden" value="" />
							    <!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
								<input id="txtEstatus_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									   name="strEstatus_movimientos_entradas_maquinaria_ajuste_maquinaria" type="hidden" value="">
								</input>
								 <!-- Caja de texto oculta que se utiliza para recuperar el tipo de acción a realizar (Editar/Ver registro)-->
								<input id="txtTipoAccion_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									   name="strTipoAccion_movimientos_entradas_maquinaria_ajuste_maquinaria" type="hidden" value="">
								</input>
								<label for="txtFolio_movimientos_entradas_maquinaria_ajuste_maquinaria">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
								        id="txtFolio_movimientos_entradas_maquinaria_ajuste_maquinaria" 
										name="strFolio_movimientos_entradas_maquinaria_ajuste_maquinaria" 
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
								<label for="txtFecha_movimientos_entradas_maquinaria_ajuste_maquinaria">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_movimientos_entradas_maquinaria_ajuste_maquinaria'>
				                    <input class="form-control" 
				                    		id="txtFecha_movimientos_entradas_maquinaria_ajuste_maquinaria"
				                    		name= "strFecha_movimientos_entradas_maquinaria_ajuste_maquinaria" 
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
				</div>
				<div class="row">
					<!-- Observaciones -->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtObservaciones_movimientos_entradas_maquinaria_ajuste_maquinaria">Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_movimientos_entradas_maquinaria_ajuste_maquinaria" 
										name="strObservaciones_movimientos_entradas_maquinaria_ajuste_maquinaria" 
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
								<input id="txtNumDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
							   		name="intNumDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria" type="hidden" value="">
								</input>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Detalles de la entrada de maquinaria</h4>
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
																<input id="txtRenglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																	   name="intRenglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																	   type="hidden" 
																	   value="" />	
																<!-- Caja de texto oculta que se utiliza para recuperar el id de la descripción de maquinaria -->
																<input id="txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																	   name="intMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																	   type="hidden" 
																	   value="" />	
																<!-- Caja de texto oculta que se utiliza para recuperar la serie anterior y evitar duplicidad de datos en el inventario -->
																<input id="txtSerieAnterior_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																	   name="strSerieAnterior_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																	   type="hidden" 
																	   value="" />	
																<!-- Caja de texto oculta que se utiliza para recuperar la descripción de maquinaria -->
																<input id="txtDescripcion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																	   name="strDescripcion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																	   type="hidden" 
																	   value="" />	      
																<label for="txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																		name="strCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																		type="text" 
																		value="" 
																		tabindex="1" placeholder="Ingrese código" />
															</div>
														</div>
													</div>
													<!--Descripción-->
													<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria">Descripción</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																		name="strDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																		type="text" 
																		value="" 
																		tabindex="1" placeholder="Ingrese descripción"/>
															</div>
														</div>
													</div>
													<!--Consignación-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbConsignacion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria">Consignación</label>
															</div>
															<div class="col-md-12">
																<select class="form-control" id="cmbConsignacion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																 		name="strConsignacion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" tabindex="1">
																 	<option value="">Seleccione una opción</option>
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
														<label for="txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria">Serie</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control cantidad" 
																id="txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																name="strSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
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
														<label for="txtMotor_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria">Motor</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control cantidad" 
																id="txtMotor_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																name="strMotor_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
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
														<label for="txtNumeroPedimiento_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria">Pedimiento</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control cantidad" 
																id="txtNumeroPedimiento_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																name="strNumeroPedimiento_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																type="text" 
																value="" 
																tabindex="1" 
																placeholder="21 caracteres obligatorios" 
																maxlength="21" />
													</div>
												</div>
											</div>	
											<!--Costo-->
											<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<label for="txtCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria">Costo</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control moneda_movimientos_entradas_maquinaria_ajuste_maquinaria" id="txtCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" 
																name="intCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese costo" maxlength="23">
														</input>
													</div>
												</div>
											</div>	
										</div>
										<div class="row">
											<!--Botones de acción (Grid View)-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div id="ToolBtns" class="btn-group">
													<!-- Agregar detalle (renglón) -->
													<button class="btn btn-primary" 
															id="btnAgregar_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria"
															onclick="agregar_renglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria();" 
															title="Agregar" tabindex="1"> 
														<span class="glyphicon glyphicon-plus"></span>
													</button>
													<!-- Agregar aditamentos a un detalle (renglón) -->
													<button class="btn btn-info"  
															id="btnVerAditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
															title="Aditamentos" 
															tabindex="1">
														<span class="glyphicon glyphicon-cog"></span>
													</button>  
												</div>
											</div>
										</div>
										<br>
										<div class="row">
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria">
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
																<strong id="numElementos_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria">0</strong> encontrados
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
				<!--Circulo de progreso-->
				<div id="divCirculoBarProgreso_movimientos_entradas_maquinaria_ajuste_maquinaria" class="load-container load5 circulo_bar no-mostrar">
					<div class="loader">Loading...</div>
					<br><br>
					<div align=center><b>Espere un momento por favor.</b></div>
				</div> 
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Nuevo registro-->
						<button class="btn btn-info" 
								id="btnReiniciar_movimientos_entradas_maquinaria_ajuste_maquinaria"  
								onclick="nuevo_movimientos_entradas_maquinaria_ajuste_maquinaria('Nuevo');"  
								title="Nuevo registro" 
								tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" 
								id="btnGuardar_movimientos_entradas_maquinaria_ajuste_maquinaria"  
								onclick="validar_movimientos_entradas_maquinaria_ajuste_maquinaria();"  
								title="Guardar" 
								tabindex="3" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_movimientos_entradas_maquinaria_ajuste_maquinaria"  
								onclick="reporte_registro_movimientos_entradas_maquinaria_ajuste_maquinaria('');"  
								title="Imprimir" 
								tabindex="4" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" 
								id="btnDesactivar_movimientos_entradas_maquinaria_ajuste_maquinaria"  
								onclick="cambiar_estatus_movimientos_entradas_maquinaria_ajuste_maquinaria('', '', '');"  
								title="Desactivar" 
								tabindex="5" disabled>
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  
								id="btnCerrar_movimientos_entradas_maquinaria_ajuste_maquinaria"
								type="reset" 
								aria-hidden="true" 
								onclick="cerrar_movimientos_entradas_maquinaria_ajuste_maquinaria();" 
								title="Cerrar"  
								tabindex="6">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div><!--Cierre del modal Entradas de maquinaria por Ajuste-->

	<!--Diseño del modal Aditamentos-->
	<div id="AditamentosMovimientosEntradasMaquinariaAjusteMaquinariaBox" class="ModalBody" tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" class="ModalBodyTitle">
			<h1>Captura de aditamentos</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmAditamentosMovimientosEntradasMaquinariaAjusteMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmAditamentosMovimientosEntradasMaquinariaAjusteMaquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
				  	<!--Código-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtCodigoMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria">Código</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtCodigoMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
										name="strCodigoMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtDescripcionMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtDescripcionMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
										name="strDescripcionMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Serie-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtSerieMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria">Serie</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSerieMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
										name="strSerieMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Motor-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtMotorMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria">Motor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtMotorMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
										name="strMotorMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Cantidad-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta para recuperar el renglón del registro seleccionado-->
								<input id="txtRenglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									   name="intRenglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria">
									Cantidad
								</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
									id="txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									name="intCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									type="text" value="" 
									tabindex="1"
									placeholder="Ingrese cantidad" maxlength="3" />
							</div>	
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-8 col-md-8 col-lg-8 col-xs-10">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtDescripcion_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria">
									Descripción
								</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
									id="txtDescripcion_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									name="strDesc_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									type="text" value="" tabindex="1"
									placeholder="Ingrese descripción" />
							</div>
						</div>
					</div>
					<!--Botón para agregar aditamento-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
						<div>
							<button class="btn btn-primary btn-toolBtns" 
									id="btnAgregar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria" 
									onclick="agregar_renglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria();" 
									title="Agregar aditamento" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<!-- Diseño de la tabla-->
									<table class="table-hover" id="dg_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria">
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
												<strong id="numElementos_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria">0</strong> encontrados
											</button>
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
						<button class="btn btn-success" id="btnGuardar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria"  
								onclick="guardar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria();"  title="Guardar" tabindex="1">
							<span class="fa fa-floppy-o"></span>
						</button>  
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria"
								type="reset" aria-hidden="true" onclick="cerrar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria();" title="Cerrar" tabindex="1">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div><!--Cierre Botones de acción (barra de tareas)-->	
			</form><!--Cierre del formulario-->	  
		</div><!--Cierre del Contenido-->
	</div><!--Cierre del modal Aditamentos-->

</div><!--#MovimientosEntradasMaquinariaAjusteMaquinariaContent -->


<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variables que se utilizan para la paginación de registros
	var intPaginaMovimientosEntradasMaquinariaAjusteMaquinaria = 0;
	var strUltimaBusquedaMovimientosEntradasMaquinariaAjusteMaquinaria = "";
	/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
   var strTipoReferenciaMovimientosEntradasMaquinariaAjusteMaquinaria = "MOVIMIENTO DE MAQUINARIA";
	//Variable que se utiliza para asignar objeto del modal Entradas de maquinaria por Ajuste
	var objMovimientosEntradasMaquinariaAjusteMaquinaria = null;
	//Variable que se utiliza para asignar objeto del modal Aditamentos
	var objAditamentosMovimientosEntradasMaquinariaAjusteMaquinaria = null;

	/*******************************************************************************************************************
	Funciones del objeto Detalles de la entrada de maquinaria
	*********************************************************************************************************************/
	// Constructor del objeto detalles
	var objDetallesEntradaMaquinariaAjuste;
	function DetallesEntradaMaquinariaAjuste(detalles)
	{
	    this.arrDetalles = detalles;
	}

	//Función para agregar una detalle al objeto 
	DetallesEntradaMaquinariaAjuste.prototype.setDetalle = function (detalle)
	{ 
		this.arrDetalles.push(detalle); 
	}

	//Función para obtener un detalle del objeto
	DetallesEntradaMaquinariaAjuste.prototype.getDetalle = function(index) 
	{ 
		return this.arrDetalles[index]; 
	}

	//Función para modificar un detalle del objeto
	DetallesEntradaMaquinariaAjuste.prototype.modificarDetalle = function (index, detalle)
	{ 
		this.arrDetalles[index] = detalle; 
	}

	//Función para eliminar un detalle del objeto
	DetallesEntradaMaquinariaAjuste.prototype.eliminarDetalle = function (index){
		if(index != -1) 
		{
			this.arrDetalles.splice(index, 1);
		}
	}

	//Función para cambiar las posiciones de los detalles en el objeto
	DetallesEntradaMaquinariaAjuste.prototype.swap = function(index_A, index_B) {
	    var input = this.arrDetalles;
	 
	    var temp = input[index_A];
	    input[index_A] = input[index_B];
	    input[index_B] = temp;
	}


	/*******************************************************************************************************************
	Funciones del objeto Detalle de la entrada de maquinaria
	*********************************************************************************************************************/
	//Constructor del objeto detalle
    var objDetalleEntradaMaquinariaAjuste;

    function DetalleEntradaMaquinariaAjuste(maquinariaDescripcionID, codigo, descripcionCorta, descripcion, serie, motor, consignacion, numeroPedimento, costo, aditamentos)
	{
		this.intMaquinariaDescripcionID = maquinariaDescripcionID;
		this.strCodigo = codigo;
	    this.strDescripcionCorta = descripcionCorta;
	    this.strDescripcion = descripcion;
	    this.strSerie = serie;
	    this.strMotor = motor;
	    this.strConsignacion = consignacion;
	    this.strNumeroPedimento = numeroPedimento;
	    this.intCosto = costo;
	    this.arrAditamentos = aditamentos;

	}

	//Funciones que se utilizan para editar datos del objeto detalle
	DetalleEntradaMaquinariaAjuste.prototype.setSerie = function(serie) {
		this.strSerie = serie; 
	}

	DetalleEntradaMaquinariaAjuste.prototype.setMotor = function(motor) {
		 this.strMotor = motor; 
	}

	DetalleEntradaMaquinariaAjuste.prototype.setConsignacion = function(consignacion) { 
		this.strConsignacion = consignacion; 
	}

	DetalleEntradaMaquinariaAjuste.prototype.setNumeroPedimento = function(numeroPedimento) { 
		this.strNumeroPedimento = numeroPedimento; 
	}

	DetalleEntradaMaquinariaAjuste.prototype.setCosto = function(costo) { 
		this.intCosto = costo; 
	}

	//Función para agregar todos los aditamentos del detalle
	DetalleEntradaMaquinariaAjuste.prototype.setAditamentos = function(aditamentos) {
    	
    	this.arrAditamentos = aditamentos;
	}

	//Función para eliminar todos los aditamentos  del detalle
	DetalleEntradaMaquinariaAjuste.prototype.eliminarAditamentos = function() {
		
		this.arrAditamentos = 0;
	}

	//Función para obtener un detalle aditamento  del objeto 
	DetalleEntradaMaquinariaAjuste.prototype.getAditamento = function(index) {
	    return this.arrAditamentos[index];
	}

	/*******************************************************************************************************************
	Funciones del objeto Aditamento
	*********************************************************************************************************************/
	// Constructor del objeto Aditamento
	var objAditamentoEntradaMaquinariaCompra;
	function AditamentoEntradaMaquinariaCompra(cantidad, descripcion)
	{
	    this.intCantidad = cantidad;
	    this.strDescripcion = descripcion;
	}
	
	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('maquinaria/movimientos_entradas_maquinaria_ajuste/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_movimientos_entradas_maquinaria_ajuste_maquinaria').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosMovimientosEntradasMaquinariaAjusteMaquinaria = data.row;
				//Separar la cadena 
				var arrPermisosMovimientosEntradasMaquinariaAjusteMaquinaria = strPermisosMovimientosEntradasMaquinariaAjusteMaquinaria.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosMovimientosEntradasMaquinariaAjusteMaquinaria.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosMovimientosEntradasMaquinariaAjusteMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_movimientos_entradas_maquinaria_ajuste_maquinaria').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosMovimientosEntradasMaquinariaAjusteMaquinaria[i]=='GUARDAR') || (arrPermisosMovimientosEntradasMaquinariaAjusteMaquinaria[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_movimientos_entradas_maquinaria_ajuste_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosEntradasMaquinariaAjusteMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_movimientos_entradas_maquinaria_ajuste_maquinaria').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_movimientos_entradas_maquinaria_ajuste_maquinaria();
					}
					else if(arrPermisosMovimientosEntradasMaquinariaAjusteMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_movimientos_entradas_maquinaria_ajuste_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosEntradasMaquinariaAjusteMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_movimientos_entradas_maquinaria_ajuste_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosEntradasMaquinariaAjusteMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_movimientos_entradas_maquinaria_ajuste_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosEntradasMaquinariaAjusteMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_movimientos_entradas_maquinaria_ajuste_maquinaria').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_movimientos_entradas_maquinaria_ajuste_maquinaria() 
	{
		//Concatenar datos para la nueva búsqueda
   		var strNuevaBusquedaMovimientosEntradasMaquinariaAjusteMaquinaria =($('#txtFechaInicialBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').val()+$('#txtFechaFinalBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').val()+$('#txtProveedorIDBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').val()+$('#cmbEstatusBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').val()+$('#txtBusqueda_movimientos_entradas_maquinaria_ajuste_maquinaria').val());
   		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaMovimientosEntradasMaquinariaAjusteMaquinaria != strUltimaBusquedaMovimientosEntradasMaquinariaAjusteMaquinaria)
		{
			intPaginaMovimientosEntradasMaquinariaAjusteMaquinaria = 0;
			strUltimaBusquedaMovimientosEntradasMaquinariaAjusteMaquinaria = strNuevaBusquedaMovimientosEntradasMaquinariaAjusteMaquinaria;
		}
		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('maquinaria/movimientos_entradas_maquinaria_ajuste/get_paginacion',
				{	
					//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').val()),
	    			dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').val()),
	    			intProveedorID: $('#txtProveedorIDBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').val(),
	    			strEstatus:     $('#cmbEstatusBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').val(),
	    			strBusqueda:    $('#txtBusqueda_movimientos_entradas_maquinaria_ajuste_maquinaria').val(),
					intPagina:intPaginaMovimientosEntradasMaquinariaAjusteMaquinaria,
					strPermisosAcceso: $('#txtAcciones_movimientos_entradas_maquinaria_ajuste_maquinaria').val()
				},
				function(data){
					$('#dg_movimientos_entradas_maquinaria_ajuste_maquinaria tbody').empty();
					var tmpMovimientosEntradasMaquinariaAjusteMaquinaria = Mustache.render($('#plantilla_movimientos_entradas_maquinaria_ajuste_maquinaria').html(),data);
					$('#dg_movimientos_entradas_maquinaria_ajuste_maquinaria tbody').html(tmpMovimientosEntradasMaquinariaAjusteMaquinaria);
					$('#pagLinks_movimientos_entradas_maquinaria_ajuste_maquinaria').html(data.paginacion);
					$('#numElementos_movimientos_entradas_maquinaria_ajuste_maquinaria').html(data.total_rows);
					intPaginaMovimientosEntradasMaquinariaAjusteMaquinaria = data.pagina;
				},
		'json');
	}

	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_movimientos_entradas_maquinaria_ajuste_maquinaria(strTipo) 
	{	
		//Variable que se utiliza para asignar URL (ruta del controlador)
		var strUrl = 'maquinaria/movimientos_entradas_maquinaria_ajuste/';

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
		if ($('#chbImprimirDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('NO');
		}

		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url': strUrl,
						'data' : {
									'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').val()),
									'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').val()),
									'intProveedorID': $('#txtProveedorIDBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').val(),
									'strEstatus': $('#cmbEstatusBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').val(), 
									'strBusqueda': $('#txtBusqueda_movimientos_entradas_maquinaria_ajuste_maquinaria').val(),
									'strDetalles': $('#chbImprimirDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val()			
								 }
					   };


		//Hacer un llamado a la función para imprimir/descargar el reporte
		$.imprimirReporte(objReporte);
	}

	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_movimientos_entradas_maquinaria_ajuste_maquinaria(id)
	{	
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la impresión desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		}
		else
		{
			intID = id;
		}

		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url': 'maquinaria/movimientos_entradas_maquinaria_ajuste/get_reporte_registro',
						'data' : {
									'intMovimientoMaquinariaID': intID
								 }
					   };

		//Hacer un llamado a la función para imprimir el reporte
		$.imprimirReporte(objReporte);
	}

	

	/*******************************************************************************************************************
	Funciones del modal Entradas de maquinaria por Ajuste
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_movimientos_entradas_maquinaria_ajuste_maquinaria(tipoAccion)
	{		
		//Incializar formulario
		$('#frmMovimientosEntradasMaquinariaAjusteMaquinaria')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_movimientos_entradas_maquinaria_ajuste_maquinaria();
		//Limpiar cajas de texto ocultas
		$('#frmMovimientosEntradasMaquinariaAjusteMaquinaria').find('input[type=hidden]').val('');
		//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
		$.removerClasesEncabezado('divEncabezadoModal_movimientos_entradas_maquinaria_ajuste_maquinaria');
		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		inicializar_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria();	
		
		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo')
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_movimientos_entradas_maquinaria_ajuste_maquinaria').addClass("estatus-NUEVO");

		}

		//Habilitar todos los elementos del formulario
		$('#frmMovimientosEntradasMaquinariaAjusteMaquinaria').find('input, textarea, select').attr('disabled', false);

		//Asignar la fecha actual
        $('#txtFecha_movimientos_entradas_maquinaria_ajuste_maquinaria').val(fechaActual()); 

	    //Deshabilitar las siguientes cajas de texto
        $('#txtFolio_movimientos_entradas_maquinaria_ajuste_maquinaria').attr("disabled", "disabled");
		//Mostrar los siguientes botones
		$("#btnGuardar_movimientos_entradas_maquinaria_ajuste_maquinaria").show();
		$("#btnReiniciar_movimientos_entradas_maquinaria_ajuste_maquinaria").show();
		//Habilitar los siguientes botones 
		$('#btnAgregar_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').prop('disabled', false);
		$('#btnVerAditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').prop('disabled', false);


		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_movimientos_entradas_maquinaria_ajuste_maquinaria").hide();
		$("#btnDesactivar_movimientos_entradas_maquinaria_ajuste_maquinaria").hide();
		
	}
	

	

	//Función para inicializar elementos de la tabla detalles
	function inicializar_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		//Hacer un llamado a la función para inicializar elementos del detalle
		inicializar_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria();

		//Eliminar los datos de la tabla detalles del movimiento
		$('#dg_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria tbody').empty();
		$('#acumCantidad_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').html(0);
		$('#numElementos_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').html(0);
		$('#txtNumDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria').html('');
		//Crear instancia del objeto Detalles de la entrada de maquinaria
	    objDetallesEntradaMaquinariaAjuste = new DetallesEntradaMaquinariaAjuste([]);
	}

	//Función que se utiliza para cerrar el modal
	function cerrar_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		try {


			//Hacer un llamado a la función para cerrar modal Aditamentos
			cerrar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria();
			//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       	ocultar_circulo_carga_movimientos_entradas_maquinaria_ajuste_maquinaria('');
			//Cerrar modal
			objMovimientosEntradasMaquinariaAjusteMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();	
		}
		catch(err) {}
	}

	
	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_movimientos_entradas_maquinaria_ajuste_maquinaria();
		//Validación del formulario de campos obligatorios
		$('#frmMovimientosEntradasMaquinariaAjusteMaquinaria')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_movimientos_entradas_maquinaria_ajuste_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intNumDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta entrada de maquinaria.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strMotor_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strNumeroPedimiento_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										}

									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_movimientos_entradas_maquinaria_ajuste_maquinaria = $('#frmMovimientosEntradasMaquinariaAjusteMaquinaria').data('bootstrapValidator');
		bootstrapValidator_movimientos_entradas_maquinaria_ajuste_maquinaria.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_movimientos_entradas_maquinaria_ajuste_maquinaria.isValid())
		{	
			//Hacer un llamado a la función para guardar los datos del registro
			guardar_movimientos_entradas_maquinaria_ajuste_maquinaria();			
		}
		else 
			return;
	}

	
	
	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		try
		{
			$('#frmMovimientosEntradasMaquinariaAjusteMaquinaria').data('bootstrapValidator').resetForm();

		}
		catch(err) {}
	}

	
	//Función para guardar o modificar los datos de un registro
	function guardar_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{	
		//Hacer un llamado a la función JSON para guardar los detalles del movimiento
		var jsonDetalles = JSON.stringify(objDetallesEntradaMaquinariaAjuste); 

		//Hacer un llamado al método del controlador para guardar los datos del registro
		$.post('maquinaria/movimientos_entradas_maquinaria_ajuste/guardar',
		{ 
			//Datos del movimiento
			intMovimientoMaquinariaID: $('#txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_ajuste_maquinaria').val(),
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_entradas_maquinaria_ajuste_maquinaria').val()),
			strObservaciones: $('#txtObservaciones_movimientos_entradas_maquinaria_ajuste_maquinaria').val(),
			intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_maquinaria_ajuste_maquinaria').val(),
			//Datos de los detalles
			arrDetalles: jsonDetalles
		},
				function(data) {

					if (data.resultado)
					{	    
	                    //Si no existe id del movimiento, significa que es un nuevo registro   
						if($('#txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '')
						{
						  	//Asignar el id del movimiento registrado en la base de datos
                 			$('#txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_ajuste_maquinaria').val(data.movimiento_maquinaria_id);
                 			
						} 

						//Hacer llamado a la función  para cargar  los registros en el grid
		            	paginacion_movimientos_entradas_maquinaria_ajuste_maquinaria();
		            	
		            	//Hacer un llamado a la función para cerrar modal
						cerrar_movimientos_entradas_maquinaria_ajuste_maquinaria();  
                		
                		//Hacer un llamado a la función para generar póliza con los datos del registro
						//generar_poliza_movimientos_entradas_maquinaria_ajuste_maquinaria('', '');
	    
					}

					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_movimientos_entradas_maquinaria_ajuste_maquinaria(data.tipo_mensaje, data.mensaje);

					//Si existe mensaje de error
					/*if(data.tipo_mensaje == 'error')
					{
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_movimientos_entradas_maquinaria_ajuste_maquinaria(data.tipo_mensaje, data.mensaje);
					}*/

				},
		'json');
		
	}

	//Función para mostrar mensaje de éxito o error
	function mensaje_movimientos_entradas_maquinaria_ajuste_maquinaria(tipoMensaje, mensaje, campoID)
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
											$('#'+campoID).focus();
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
	function cambiar_estatus_movimientos_entradas_maquinaria_ajuste_maquinaria(id, polizaID, folioPoliza)
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Variable que se utiliza para asignar el id de la póliza
		var intPolizaID = 0;
	    //Variable que se utiliza para asignar el folio de la póliza
		var strFolioPoliza = '';
		//Variable que se utiliza para asignar el mensaje informativo
		var strMensaje = '¿Está seguro que desea desactivar el registro';

		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_ajuste_maquinaria').val();

			intPolizaID = $('#txtPolizaID_movimientos_entradas_maquinaria_ajuste_maquinaria').val();

			strFolioPoliza = $('#txtFolioPoliza_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		}
		else
		{
			intID = id;
			intPolizaID = polizaID;
			strFolioPoliza = folioPoliza;
		}

		//Si existe id de la póliza
		if(intPolizaID > 0)
		{
			strMensaje += '; también se desactivara la póliza con folio: '+strFolioPoliza;
		}
		
		strMensaje += '?';
	   
		//Preguntar al usuario si desea desactivar el registro
		new $.Zebra_Dialog('<strong>'+strMensaje+'</strong>',
				             {'type':     'question',
				              'title':    'Entradas de Maquinaria por Ajuste',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('maquinaria/movimientos_entradas_maquinaria_ajuste/set_estatus',
				                                     {
				                                     	intMovimientoMaquinariaID: intID,
				                                      	intPolizaID: intPolizaID
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                            //Hacer llamado a la función  para cargar  los registros en el grid
				                                            paginacion_movimientos_entradas_maquinaria_ajuste_maquinaria();
				                                            //Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_movimientos_entradas_maquinaria_ajuste_maquinaria();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_movimientos_entradas_maquinaria_ajuste_maquinaria(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }

				                          }

				              });
	   
	}

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_movimientos_entradas_maquinaria_ajuste_maquinaria(id, tipoAccion)
	{	
		

		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.post('maquinaria/movimientos_entradas_maquinaria_ajuste/get_datos',
        {
       		intMovimientoMaquinariaID:id
        },
		       function(data) {
		        	//Si hay datos del registro 
		            if(data.row)
		            {  
		            	
		            	//Hacer un llamado a la función para limpiar los campos del formulario
						nuevo_movimientos_entradas_maquinaria_ajuste_maquinaria('');

						//Asignar estatus del registro
				        var strEstatus = data.row.estatus;
				        //Asignar el id de la póliza
				        var intPolizaID = parseInt(data.row.poliza_id); 
				        //Variable que se utiliza para asignar las acciones del grid view
				        var strAccionesTabla = "";     
			          	
			          	//Recuperar valores para la Vista
			            $('#txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_ajuste_maquinaria').val(data.row.movimiento_maquinaria_id);
			            $('#txtFolio_movimientos_entradas_maquinaria_ajuste_maquinaria').val(data.row.folio);
			            $('#txtFecha_movimientos_entradas_maquinaria_ajuste_maquinaria').val(data.row.fecha);
			            $('#txtOrdenCompraMaquinariaID_movimientos_entradas_maquinaria_ajuste_maquinaria').val(data.row.referencia_id);
			            $('#txtOrdenCompraMaquinaria_movimientos_entradas_maquinaria_ajuste_maquinaria').val(data.row.folio_orden_compra);
			             $('#txtMonedaID_movimientos_entradas_maquinaria_ajuste_maquinaria').val(data.row.moneda_id);
			            $('#txtTipoCambio_movimientos_entradas_maquinaria_ajuste_maquinaria').val(data.row.tipo_cambio);
						$('#txtObservaciones_movimientos_entradas_maquinaria_ajuste_maquinaria').val(data.row.observaciones);
					    $('#txtPolizaID_movimientos_entradas_maquinaria_ajuste_maquinaria').val(intPolizaID);
						$('#txtFolioPoliza_movimientos_entradas_maquinaria_ajuste_maquinaria').val(data.row.folio_poliza);

						//Dependiendo del estatus cambiar el color del encabezado 
			            $('#divEncabezadoModal_movimientos_entradas_maquinaria_ajuste_maquinaria').addClass("estatus-"+strEstatus);
			            $('#txtEstatus_movimientos_entradas_maquinaria_ajuste_maquinaria').val(strEstatus);

			            //Mostrar botón Imprimir  
			            $("#btnImprimirRegistro_movimientos_entradas_maquinaria_ajuste_maquinaria").show();

			            
						//Es necesario comprobar si la serie de esta maquinaria cuenta con otros movimientos
						//Array que se utiliza para agregar las series incorrectas
						var arrDetallesIncorrectos = [];
						//Recorrer los detalles para obtener los valores
						for (var intCon in data.detalles) 
						{
							//Variables que se utilizan para asignar valores del detalle
							var strCodigo = data.detalles[intCon].codigo;
							var strDescripcion = data.detalles[intCon].descripcion_corta;
							var strSerie = data.detalles[intCon].serie;
							var intTotalOtrosMov = parseInt(data.detalles[intCon].otros_movimientos);

							//Concatenar los datos de la maquinaria
							var strMaquinaria = strCodigo+'  '+strDescripcion+'<br>  serie: '+strSerie;

							//Si la serie es igual a cadena vacia
							if(intTotalOtrosMov > 0)
							{
								//Agregar maquinaria en el array, de esta manera, el usuario identificara las series incorrectas
								arrDetallesIncorrectos.push(strMaquinaria);
							}

						}//Cierre del for Detalles

						//Si existen series incorrectas
						if(arrDetallesIncorrectos.length > 0)
						{
							//Mensaje que se utiliza para informar al usuario la lista de componentes incorrectos
							var strMensaje = 'La ENTRADA POR AJUSTE no puede editarse ya que las siguientes <b>maquinarias</b> presentan movimientos en el inventario:<br>';
							//Hacer recorrido para obtener series incorrectas
							for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
							{
								//Agregar maquinaria en el mensaje
				        		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
							}

							//Cambiar el tipo de acción para evitar edición del registro
							tipoAccion = 'Ver';

							//Hacer un llamado a la función para mostrar mensaje de error
							mensaje_movimientos_entradas_maquinaria_ajuste_maquinaria('error', strMensaje);
						}


						//Asignar el tipo de acción que se realizará (Editar/Ver registro) de esta manera se bloquearan las acciones del formulario Capturar Aditamentos
						$('#txtTipoAccion_movimientos_entradas_maquinaria_ajuste_maquinaria').val(tipoAccion);

						//Si el tipo de acción corresponde a Ver
			            if(tipoAccion == 'Ver')
			            {
							//Deshabilitar todos los elementos del formulario
			            	$('#frmMovimientosEntradasMaquinariaAjusteMaquinaria').find('input, textarea, select').attr('disabled','disabled');
			            	//Ocultar los siguientes botones
			            	$("#btnReiniciar_movimientos_entradas_maquinaria_ajuste_maquinaria").hide();
				            $("#btnGuardar_movimientos_entradas_maquinaria_ajuste_maquinaria").hide();

				            //Deshabilitar los siguientes botones
							$('#btnAgregar_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').prop('disabled', true);
							
							$('#btnVerAditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').prop('disabled', true);

							strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Aditamentos'" +
											  " onclick='abrir_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(this)'>" +
											 "<span class='glyphicon glyphicon-cog'></span></button>" ;


							//Si existe el id de la póliza
			            	/*if(strEstatus == 'ACTIVO' && intPolizaID > 0)
			            	{
				            	//Mostrar el botón Desactivar
				            	$("#btnDesactivar_movimientos_entradas_maquinaria_ajuste_maquinaria").show();
				            }*/


			            }
			            else
			            {

			            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
											   " onclick='editar_renglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria(this)'>" + 
											  "<span class='glyphicon glyphicon-edit'></span></button>" + 
											  "<button class='btn btn-default btn-xs' title='Aditamentos'" +
											  " onclick='abrir_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(this)'>" +
											 "<span class='glyphicon glyphicon-cog'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
											 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
											 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											 "<span class='glyphicon glyphicon-arrow-down'></span></button>";


							//Mostrar el botón Desactivar
				            $("#btnDesactivar_movimientos_entradas_maquinaria_ajuste_maquinaria").show();

			            }

						
			           	//Mostramos los detalles del registro
			           	for (var intCon in data.detalles) 
			            {	

			            	//Crear instancia del objeto Detalle de la entrada de maquinaria
							objDetalleEntradaMaquinariaAjuste = new DetalleEntradaMaquinariaAjuste(null, '', '', '', '', '', '', '', '', []);

							//Asignar valores al objeto
							objDetalleEntradaMaquinariaAjuste.intMaquinariaDescripcionID = data.detalles[intCon].maquinaria_descripcion_id;
							objDetalleEntradaMaquinariaAjuste.strCodigo = data.detalles[intCon].codigo;
							objDetalleEntradaMaquinariaAjuste.strDescripcionCorta = data.detalles[intCon].descripcion_corta;
							objDetalleEntradaMaquinariaAjuste.strDescripcion = data.detalles[intCon].descripcion;
							objDetalleEntradaMaquinariaAjuste.strSerie = data.detalles[intCon].serie;
							objDetalleEntradaMaquinariaAjuste.strMotor = data.detalles[intCon].motor;
							objDetalleEntradaMaquinariaAjuste.strConsignacion = data.detalles[intCon].consignacion;
							objDetalleEntradaMaquinariaAjuste.strNumeroPedimento = data.detalles[intCon].numero_pedimento;
							objDetalleEntradaMaquinariaAjuste.intCosto = data.detalles[intCon].costo;

							//Array que se utiliza para agregar los aditamentos del registro
							var arrAditamentos = [];

							//Obtenemos los aditamentos del registro
				            for (var intConAdit in  data.detalles[intCon].arrAditamentos) 
				            {
				            	
								//Crear instancia del objeto Aditamento
								objAditamentoEntradaMaquinariaCompra = new AditamentoEntradaMaquinariaCompra(null, '');

								//Asignar valores al objeto
								objAditamentoEntradaMaquinariaCompra.intCantidad = data.detalles[intCon].arrAditamentos[intConAdit].cantidad;
								objAditamentoEntradaMaquinariaCompra.strDescripcion = data.detalles[intCon].arrAditamentos[intConAdit].descripcion;

								//Agregar objeto en el array
								arrAditamentos.push(objAditamentoEntradaMaquinariaCompra);

				            }//Cierre del for Aditamentos

				            //Agregar array con los aditamentos del detalle (maquinaria)
            				objDetalleEntradaMaquinariaAjuste.setAditamentos(arrAditamentos);

							//Agregar datos del detalle de la entrada de maquinaria
           					objDetallesEntradaMaquinariaAjuste.setDetalle(objDetalleEntradaMaquinariaAjuste);


			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').getElementsByTagName('tbody')[0];
							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcionCorta = objRenglon.insertCell(1);
							var objCeldaSerie = objRenglon.insertCell(2);
							var objCeldaMotor = objRenglon.insertCell(3);
							var objCeldaAcciones = objRenglon.insertCell(4);
							var objCeldaDescripcion = objRenglon.insertCell(5);
							var objCeldaNumeroPedimento = objRenglon.insertCell(6);
							var objCeldaConsignacion = objRenglon.insertCell(7);
							var objCeldaCosto = objRenglon.insertCell(8);

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', objDetalleEntradaMaquinariaAjuste.intMaquinariaDescripcionID);
							objCeldaCodigo.setAttribute('class', 'movil b1');
							objCeldaCodigo.innerHTML = objDetalleEntradaMaquinariaAjuste.strCodigo;
							objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
							objCeldaDescripcionCorta.innerHTML = objDetalleEntradaMaquinariaAjuste.strDescripcionCorta;
							objCeldaSerie.setAttribute('class', 'movil b3');
							objCeldaSerie.innerHTML = objDetalleEntradaMaquinariaAjuste.strSerie;
							objCeldaMotor.setAttribute('class', 'movil b4');
							objCeldaMotor.innerHTML = objDetalleEntradaMaquinariaAjuste.strMotor;
							objCeldaAcciones.setAttribute('class', 'td-center movil b5');
							objCeldaAcciones.setAttribute("style", 'width:15em;');
							objCeldaAcciones.innerHTML = strAccionesTabla;
							objCeldaDescripcion.setAttribute('class', 'no-mostrar');
							objCeldaDescripcion.innerHTML = objDetalleEntradaMaquinariaAjuste.strDescripcion;
							objCeldaNumeroPedimento.setAttribute('class', 'no-mostrar');
							objCeldaNumeroPedimento.innerHTML = objDetalleEntradaMaquinariaAjuste.strNumeroPedimento;
							objCeldaConsignacion.setAttribute('class', 'no-mostrar');
							objCeldaConsignacion.innerHTML = objDetalleEntradaMaquinariaAjuste.strConsignacion;
							objCeldaCosto.setAttribute('class', 'no-mostrar');
							objCeldaCosto.innerHTML = objDetalleEntradaMaquinariaAjuste.intCosto;
	
			            }//Cierre del for Detalles


						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria tr").length - 1;
						$('#numElementos_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').html(intFilas);
						$('#txtNumDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(intFilas);
						
		            	//Abrir modal
			            objMovimientosEntradasMaquinariaAjusteMaquinaria = $('#MovimientosEntradasMaquinariaAjusteMaquinariaBox').bPopup({
													  appendTo: '#MovimientosEntradasMaquinariaAjusteMaquinariaContent', 
						                              contentContainer: 'MovimientosEntradasMaquinariaAjusteMaquinariaM', 
						                              zIndex: 2, 
						                              modalClose: false, 
						                              modal: true, 
						                              follow: [true,false], 
						                              followEasing : "linear", 
						                              easing: "linear", 
						                              modalColor: ('#F0F0F0')});

			            //Enfocar caja de texto
						$('#txtChofer_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		       	    }
		       	    
		       },
		       'json');		

	}


	//Función para generar póliza con los datos de un registro
	function generar_poliza_movimientos_entradas_maquinaria_ajuste_maquinaria(id, formulario)
	{	

		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Variable que se utiliza para saber si el id se obtuvo desde el modal
		var strTipo = 'modal';
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		}
		else
		{
			intID = id;
			strTipo = 'gridview';
		}

		//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
		mostrar_circulo_carga_movimientos_entradas_maquinaria_ajuste_maquinaria(formulario);
		//Hacer un llamado al método del controlador para timbrar los datos del registro
		$.post('contabilidad/generar_polizas/generar_poliza',
	     {
	     	intReferenciaID: intID,
	      	strTipoReferencia: strTipoReferenciaMovimientosEntradasMaquinariaAjusteMaquinaria, 
	      	intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_maquinaria_ajuste_maquinaria').val()
	     },
	     function(data) {

	     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		    ocultar_circulo_carga_movimientos_entradas_maquinaria_ajuste_maquinaria(formulario);
		    
		    //Si existe resultado
			if (data.resultado)
			{
				//Hacer llamado a la función para cargar  los registros en el grid
				paginacion_movimientos_entradas_maquinaria_ajuste_maquinaria();

				//Si el id del registro se obtuvo del modal
				if(strTipo == 'modal')
				{
					//Hacer un llamado a la función para cerrar modal
		            cerrar_movimientos_entradas_maquinaria_ajuste_maquinaria();
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
		            								cerrar_movimientos_entradas_maquinaria_ajuste_maquinaria();
                                                 }
                                                }]
                                  });
			}
			else
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		    	mensaje_movimientos_entradas_maquinaria_ajuste_maquinaria(data.tipo_mensaje, data.mensaje);
			}
			
	     },
	     'json');

	}



	//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
	//al momento de generar la póliza de un registro
	function mostrar_circulo_carga_movimientos_entradas_maquinaria_ajuste_maquinaria(formulario)
	{
		//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
		var strCampoID = 'divCirculoBarProgreso_movimientos_entradas_maquinaria_ajuste_maquinaria';

		//Si el Div a mostrar se encuentra en el formulario principal
		if(formulario == 'principal')
		{
			strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_entradas_maquinaria_ajuste_maquinaria';
		}

		//Remover clase para mostrar div que contiene la barra de carga
		$("#"+strCampoID).removeClass('no-mostrar');
	}


	//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
	//al momento de generar la póliza de un registro
	function ocultar_circulo_carga_movimientos_entradas_maquinaria_ajuste_maquinaria(formulario)
	{
		//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
		var strCampoID = 'divCirculoBarProgreso_movimientos_entradas_maquinaria_ajuste_maquinaria';

		//Si el Div a mostrar se encuentra en el formulario principal
		if(formulario == 'principal')
		{
			strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_entradas_maquinaria_ajuste_maquinaria';
		}

		//Agregar clase para ocultar div que contiene la barra de carga
		$("#"+strCampoID).addClass('no-mostrar');
	}
	
	
	
	/*******************************************************************************************************************
	Funciones de la tabla detalles
	*********************************************************************************************************************/
	//Función para inicializar elementos de la maquinaria
	function inicializar_descripcion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		//Limpiar contenido de las siguientes cajas de texto
		$('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtDescripcion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtRenglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
	}


	//Función para agregar renglón a la tabla
	function agregar_renglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		//Obtenemos los datos de las cajas de texto
		var intMaquinariaDescripcionID = $('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var strCodigo = $('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var strDescripcionCorta = $('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var strDescripcion = $('#txtDescripcion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var intRenglon = $('#txtRenglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var strConsignacion = $('#cmbConsignacion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var strSerie = $('#txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var strSerieAnterior = $('#txtSerieAnterior_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var strMotor = $('#txtMotor_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var strNumeroPedimento = $('#txtNumeroPedimiento_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var intCosto = $('#txtCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		//Variable que se utiliza para agregar serie en la tabla detalles
		var strAgregarSerie = 'SI';

		
		//Validamos que se capturaron datos
		if (intMaquinariaDescripcionID == '' || strCodigo == '')
		{
			//Enfocar caja de texto
			$('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		}
		else if (strDescripcionCorta == '')
		{
			//Enfocar caja de texto
			$('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		}
		else if (strConsignacion == '' )
		{
			//Enfocar combobox
			$('#cmbConsignacion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		}
		else if(strSerie == '')
		{
			//Enfocar caja de texto
			$('#txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		}
		else if(strNumeroPedimento != '' && strNumeroPedimento.length < 21 )
		{
			//Enfocar caja de texto
			$('#txtNumeroPedimiento_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		}
		else if (intCosto == '' || intCosto <= 0)
		{
			//Enfocar caja de texto
			$('#txtCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		}
		else
		{

			
			//Si hubo cambios en la serie (verificar existencia de la serie en el inventario para evitar duplicidad de datos)
			if(strSerie != strSerieAnterior)
			{
				//Hacer un llamado al método del controlador para regresar la serie de maquinaria (de esta manera evitaremos errores al momento de guardar datos en el inventario)
	             $.ajax('maquinaria/maquinaria_inventario/get_datos',
	             		{
				        "type" : "post",
				        "data": {
				        		  intMaquinariaDescripcionID: intMaquinariaDescripcionID,
			       				  strSerie: strSerie
				                 },
				        success: function(data){
				            	//Si los datos se recuperaron correctamente
				             	if(data.row)
				             	{
								   //Asignar NO para evitar duplicar serie en la tabla detalles
								   strAgregarSerie = 'NO';
			                    }
				          },
				        "async": false,
				      });
			}
			

			//Si se cumple la sentencia
			if(strAgregarSerie == 'SI')
			{
				//Hacer un llamado a la función para inicializar elementos del detalle
				inicializar_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria();

				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strSerie = strSerie.toUpperCase();
				strMotor = strMotor.toUpperCase();
				strNumeroPedimento = strNumeroPedimento.toUpperCase();
				//Convertir cadena de texto a número decimal
				intCosto = parseFloat($.reemplazar(intCosto, ",", ""));

				//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').getElementsByTagName('tbody')[0];

				//Revisamos si existe el renglón, si es así, editamos los datos del detalle
				if (objTabla.rows.namedItem(intMaquinariaDescripcionID))
				{
					//Decrementar indice para obtener la posición del detalle en el arreglo
					intRenglon = objTabla.rows.namedItem(intMaquinariaDescripcionID).rowIndex - 1;

					//Crear instancia del objeto Detalle de la entrada de maquinaria
					objDetalleEntradaMaquinariaAjuste = new DetalleEntradaMaquinariaAjuste();

					//Asignar datos del detalle corespondiente al indice
	        		objDetalleEntradaMaquinariaAjuste = objDetallesEntradaMaquinariaAjuste.getDetalle(intRenglon);

	        		//Modificar los siguientes valores del detalle
	        		objDetalleEntradaMaquinariaAjuste.setSerie(strSerie);
					objDetalleEntradaMaquinariaAjuste.setMotor(strMotor);
					objDetalleEntradaMaquinariaAjuste.setNumeroPedimento(strNumeroPedimento);
					objDetalleEntradaMaquinariaAjuste.setConsignacion(strConsignacion);
					objDetalleEntradaMaquinariaAjuste.setCosto(intCosto);

					//Modificar los datos del detalle corespondiente al indice
	        		objDetallesEntradaMaquinariaAjuste.modificarDetalle(intRenglon, objDetalleEntradaMaquinariaAjuste);

	        		//Incrementar renglón para obtener la posición del detalle en la tabla
					intRenglon++;

					//Seleccionar el renglón de la tabla para actualizar los datos del detalle
					var selectedRow = document.getElementById("dg_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria").rows[intRenglon].cells;
					selectedRow[2].innerHTML = strSerie;
					selectedRow[3].innerHTML = strMotor;
					selectedRow[6].innerHTML = strNumeroPedimento;
					selectedRow[7].innerHTML = strConsignacion;
					selectedRow[8].innerHTML = intCosto;
				}
				else
				{

					//Crear instancia del objeto Detalle de la entrada de maquinaria
					objDetalleEntradaMaquinariaAjuste = new DetalleEntradaMaquinariaAjuste(null, '', '', '', '', '', '', '', '', []);
					//Asignar valores al objeto
					objDetalleEntradaMaquinariaAjuste.intMaquinariaDescripcionID = intMaquinariaDescripcionID;
					objDetalleEntradaMaquinariaAjuste.strCodigo = strCodigo;
					objDetalleEntradaMaquinariaAjuste.strDescripcionCorta = strDescripcionCorta;
					objDetalleEntradaMaquinariaAjuste.strDescripcion = strDescripcion;
					objDetalleEntradaMaquinariaAjuste.strSerie = strSerie;
					objDetalleEntradaMaquinariaAjuste.strMotor = strMotor;
					objDetalleEntradaMaquinariaAjuste.strConsignacion = strConsignacion;
					objDetalleEntradaMaquinariaAjuste.strNumeroPedimento = strNumeroPedimento;
					objDetalleEntradaMaquinariaAjuste.intCosto = intCosto;
					//Agregar datos del detalle de la entrada de maquinaria
           			objDetallesEntradaMaquinariaAjuste.setDetalle(objDetalleEntradaMaquinariaAjuste);
           			

           			//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCodigo = objRenglon.insertCell(0);
					var objCeldaDescripcionCorta = objRenglon.insertCell(1);
					var objCeldaSerie = objRenglon.insertCell(2);
					var objCeldaMotor = objRenglon.insertCell(3);
					var objCeldaAcciones = objRenglon.insertCell(4);
					var objCeldaDescripcion = objRenglon.insertCell(5);
					var objCeldaNumeroPedimento = objRenglon.insertCell(6);
					var objCeldaConsignacion = objRenglon.insertCell(7);
					var objCeldaCosto = objRenglon.insertCell(8);

           			//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', objDetalleEntradaMaquinariaAjuste.intMaquinariaDescripcionID);
					objCeldaCodigo.setAttribute('class', 'movil b1');
					objCeldaCodigo.innerHTML = objDetalleEntradaMaquinariaAjuste.strCodigo;
					objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
					objCeldaDescripcionCorta.innerHTML = objDetalleEntradaMaquinariaAjuste.strDescripcionCorta;
					objCeldaSerie.setAttribute('class', 'movil b3');
					objCeldaSerie.innerHTML = objDetalleEntradaMaquinariaAjuste.strSerie;
					objCeldaMotor.setAttribute('class', 'movil b4');
					objCeldaMotor.innerHTML = objDetalleEntradaMaquinariaAjuste.strMotor;
					objCeldaAcciones.setAttribute('class', 'td-center movil b5');
					objCeldaAcciones.setAttribute("style", 'width:15em;');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Aditamentos'" +
												 " onclick='abrir_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(this)'>" +
												 "<span class='glyphicon glyphicon-cog'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaDescripcion.setAttribute('class', 'no-mostrar');
					objCeldaDescripcion.innerHTML = objDetalleEntradaMaquinariaAjuste.strDescripcion;
					objCeldaNumeroPedimento.setAttribute('class', 'no-mostrar');
					objCeldaNumeroPedimento.innerHTML = objDetalleEntradaMaquinariaAjuste.strNumeroPedimento;
					objCeldaConsignacion.setAttribute('class', 'no-mostrar');
					objCeldaConsignacion.innerHTML = objDetalleEntradaMaquinariaAjuste.strConsignacion;
					objCeldaCosto.setAttribute('class', 'no-mostrar');
					objCeldaCosto.innerHTML = objDetalleEntradaMaquinariaAjuste.intCosto;

				}

			    //Enfocar caja de texto
				$('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
			}
			else
			{
				/*Mensaje que se utiliza para informar al usuario que no es posible ingresar serie en la tabla detalles*/
				var strMensaje = 'La serie de esta maquinaria ya existe en el inventario.';

				//Limpiar contenido de la caja de texto
                $('#txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
                
				//Hacer un llamado a la función para mostrar mensaje de información
				mensaje_movimientos_entradas_maquinaria_ajuste_maquinaria('informacion', strMensaje, 'txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria');

			}
			

			
			
		}

		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria tr").length - 1;
		$('#numElementos_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').html(intFilas);
		$('#txtNumDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(intFilas);
		

	}

	//Función para inicializar elementos del detalle
	function inicializar_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria() 
	{
		//Limpiar las siguientes cajas de texto
		$('#txtRenglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtDescripcion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#cmbConsignacion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtSerieAnterior_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtMotor_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtNumeroPedimiento_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
		$('#txtCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
	}

	//Función para regresar los datos (al formulario) del renglón seleccionado
	function editar_renglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria(objRenglon)
	{
		//Decrementar indice para obtener la posición del detalle en el arreglo
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex - 1;

		//Crear instancia del objeto Detalle de la entrada de maquinaria
        objDetalleEntradaMaquinariaAjuste = new DetalleEntradaMaquinariaAjuste();
        //Asignar datos del detalle corespondiente al indice
        objDetalleEntradaMaquinariaAjuste = objDetallesEntradaMaquinariaAjuste.getDetalle(intRenglon);

		//Asignar los valores a las cajas de texto
		$('#txtRenglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(intRenglon);
		$('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objDetalleEntradaMaquinariaAjuste.intMaquinariaDescripcionID);
		$('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objDetalleEntradaMaquinariaAjuste.strCodigo);
		$('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objDetalleEntradaMaquinariaAjuste.strDescripcionCorta);
		$('#txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objDetalleEntradaMaquinariaAjuste.strSerie);
		$('#txtSerieAnterior_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objDetalleEntradaMaquinariaAjuste.strSerie);
		$('#txtMotor_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objDetalleEntradaMaquinariaAjuste.strMotor);
		$('#txtNumeroPedimiento_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objDetalleEntradaMaquinariaAjuste.strNumeroPedimento);

		$('#cmbConsignacion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objDetalleEntradaMaquinariaAjuste.strConsignacion);
		
		//Cambiar cantidad a  formato moneda (a visualizar)
		var intCosto =  formatMoney(objDetalleEntradaMaquinariaAjuste.intCosto, 2, '');

		$('#txtCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(intCosto);

		//Enfocar combobox
		$('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
	}


	//Función para eliminar un renglón de la tabla
	function eliminar_renglon_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(objRenglon)
	{
		//Obtener el indice del objeto renglón que se envía
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
		//Eliminar del objeto el detalle seleccionado
		objDetallesEntradaMaquinariaAjuste.eliminarDetalle(intRenglon - 1);
		//Eliminar el renglón indicado
		document.getElementById("dg_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria").deleteRow(intRenglon);
		//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
		var intFilas = $("#dg_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria tr").length - 1;
		$('#numElementos_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').html(intFilas);
		$('#txtNumDetalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(intFilas);
	}

	//Función para buscar existencia de la serie en la tabla
	function buscar_serie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		//Obtenemos el objeto de la tabla 
		var objTabla = document.getElementById('dg_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').getElementsByTagName('tbody')[0];

		//Variable que se utiliza para asignar serie
		var strSerieBusq = $('#txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var intMaqDescripcionIDBusq = $('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		
		
		//Variable que se utiliza para agregar serie en la tabla detalles
		var strAgregarSerie = 'SI';

		//Si se cumple la sentencia
		if(strSerieBusq != '')
		{
			//Utilizar toUpperCase() para cambiar texto a mayúsculas
			strSerieBusq = strSerieBusq.toUpperCase();

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar los datos del detalle
				var strSerieDet = objRen.cells[2].innerHTML;
				var intMaqDescripcionIDDet = objRen.getAttribute("id");
				
				//Si la serie ya se encuentra en la tabla
				if(strSerieBusq == strSerieDet && intMaqDescripcionIDBusq != intMaqDescripcionIDDet) 
				{
					//Asignar NO para evitar duplicar serie
					strAgregarSerie = 'NO';
				}
			}


			//Si la serie se encuentra en la tabla detalles
			if(strAgregarSerie == 'NO')
			{
				/*Mensaje que se utiliza para informar al usuario que no es posible ingresar serie en la tabla detalles*/
				var strMensaje = 'La serie: <b>'+strSerieBusq+'</b> ya se encuentra en la tabla, favor de verificar.';

				//Limpiar contenido de las siguientes cajas de texto
				$('#txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');

				//Hacer un llamado a la función para mostrar mensaje de información
				mensaje_movimientos_entradas_maquinaria_ajuste_maquinaria('informacion', strMensaje, 'txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria');
			}
		}
	}


	
	/*******************************************************************************************************************
	Funciones del modal Aditamentos
	*********************************************************************************************************************/
	//Función para agregar Aditamentos del renglón seleccionado
	function abrir_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(objRenglon)
	{
		
		//Decrementar indice para obtener la posición del detalle en el arreglo
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex - 1;

		//Asignar los valores a las cajas de texto
		$('#txtRenglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(intRenglon);

		//Hacer un llamado a la función para limpiar los campos del formulario
		nuevo_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria();
	}

	//Agregar aditamentos a una maquinaria (detalle)
	function nuevo_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
		$.removerClasesEncabezado('divEncabezadoModal_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria');
		
		//Hacer un llamado a la función para inicializar elementos del aditamento
		inicializar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria();

		//Variable que se utiliza para asignar las acciones del grid view
		var strAccionesTabla = '';

		//Variable que se utiliza para asignar el estatus del registros
		var strEstatus =  $('#txtEstatus_movimientos_entradas_maquinaria_ajuste_maquinaria').val();

		//Si no existe estatus, significa que es un nuevo registro
		if(strEstatus == '')
		{
			strEstatus = 'NUEVO';
		}

		//Dependiendo del estatus cambiar el color del encabezado 
		$('#divEncabezadoModal_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').addClass("estatus-"+strEstatus);

		//Si el tipo de acción es Ver
		if($('#txtTipoAccion_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == 'Ver')
		{
			//Ocultar botón Guardar 
	    	$('#btnGuardar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').hide();
	    	//Deshabilitar todos los elementos del formulario
			$('#frmAditamentosMovimientosEntradasMaquinariaAjusteMaquinaria').find('input, textarea, select').attr('disabled','disabled');

			//Deshabilitar botón Agregar
			$('#btnAgregar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').prop('disabled', true);
		}
		else
		{
			strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
										 " onclick='editar_renglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(this)'>" + 
										 "<span class='glyphicon glyphicon-edit'></span></button>" + 
										 "<button class='btn btn-default btn-xs' title='Eliminar'" +
										 " onclick='eliminar_renglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(this)'>" +
										 "<span class='glyphicon glyphicon-trash'></span></button>" + 
										 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
										 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
										 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
										 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

			//Mostrar botón Guardar 
			$('#btnGuardar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').show();
			//Habilitar las siguientes cajas de texto
			$("#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria").removeAttr('disabled');
			$("#txtDescripcion_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria").removeAttr('disabled');

			//Habilitar botón Agregar
			$('#btnAgregar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').prop('disabled', false);
		}

		//Abrir modal secundario
		objAditamentosMovimientosEntradasMaquinariaAjusteMaquinaria = $('#AditamentosMovimientosEntradasMaquinariaAjusteMaquinariaBox').bPopup({
									   appendTo: '#MovimientosEntradasMaquinariaAjusteMaquinariaContent', 
		                               contentContainer: 'AditamentosMovimientosEntradasMaquinariaAjusteMaquinariaM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});
		
		

		//Obtenemos el id del renglón (detalle) seleccionado
		var intRenglon = $('#txtRenglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();

		//Crear instancia del objeto Detalle de la entrada de maquinaria
        objDetalleEntradaMaquinariaAjuste = new DetalleEntradaMaquinariaAjuste();
        //Asignar datos del detalle corespondiente al indice
        objDetalleEntradaMaquinariaAjuste = objDetallesEntradaMaquinariaAjuste.getDetalle(intRenglon);

        //Asignar los valores que vienen del modal primario
		$('#txtCodigoMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objDetalleEntradaMaquinariaAjuste.strCodigo); 
		$('#txtDescripcionMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objDetalleEntradaMaquinariaAjuste.strDescripcionCorta);
		$('#txtSerieMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objDetalleEntradaMaquinariaAjuste.strSerie);
		$('#txtMotorMaq_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objDetalleEntradaMaquinariaAjuste.strMotor);

		//Hacer recorrido para obtener los aditamentos de la maquinaria (detalle)
	    for(var intCon=0; intCon < objDetalleEntradaMaquinariaAjuste.arrAditamentos.length; intCon++)
	    {
	    	//Crear instancia del objeto Aditamento
            objAditamentoEntradaMaquinariaCompra = new AditamentoEntradaMaquinariaCompra();
            //Asignar datos del aditamento corespondiente al indice
            objAditamentoEntradaMaquinariaCompra = objDetalleEntradaMaquinariaAjuste.getAditamento(intCon);

            //Obtenemos el objeto de la tabla aditamentos
			var objTabla = document.getElementById('dg_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').getElementsByTagName('tbody')[0];

			//Insertamos el renglón con sus celdas en el objeto de la tabla
			var objRenglon = objTabla.insertRow();
			var objCeldaCantidad = objRenglon.insertCell(0);
			var objCeldaDescripcion = objRenglon.insertCell(1);
			var objCeldaAcciones = objRenglon.insertCell(2);

			//Asignar valores
			objRenglon.setAttribute('class', 'movil');
			objRenglon.setAttribute('id', intCon); 
			objCeldaCantidad.setAttribute('class', 'movil c1');
			objCeldaCantidad.innerHTML = objAditamentoEntradaMaquinariaCompra.intCantidad;
			objCeldaDescripcion.setAttribute('class', 'movil c2');
			objCeldaDescripcion.innerHTML = objAditamentoEntradaMaquinariaCompra.strDescripcion;;
			objCeldaAcciones.setAttribute('class', 'td-center movil c3');
			objCeldaAcciones.innerHTML = strAccionesTabla;

	    }//Cierre del for Aditamentos


	    //Asignar el número de filas de la tabla (se quita la primera fila por que corresponde al encabezado de la tabla)
		var intFilas = $("#dg_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria tr").length - 1;
		$('#numElementos_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').html(intFilas);

		//Enfocar caja de texto
		$('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
	}

	//Función para guardar los aditamentos de una Maquinaria (detalle)
	function guardar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		//Obtenemos el id del renglón del detalle (maquinaria) seleccionado
		var intRenglonMaq = $('#txtRenglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();

		//Crear instancia del objeto Detalle de la entrada de maquinaria
        objDetalleEntradaMaquinariaAjuste = new DetalleEntradaMaquinariaAjuste();
         //Asignar datos del detalle corespondiente al indice
        objDetalleEntradaMaquinariaAjuste = objDetallesEntradaMaquinariaAjuste.getDetalle(intRenglonMaq);
        //Eliminar los aditamentos del detalle
		objDetalleEntradaMaquinariaAjuste.eliminarAditamentos(intRenglonMaq);

		//Obtenemos el objeto de la tabla aditamentos
		var objTabla = document.getElementById('dg_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').getElementsByTagName('tbody')[0];

		//Array que se utiliza para agregar los aditamentos del registro
		var arrAditamentos = [];

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{

			//Crear instancia del objeto Aditamento
			objAditamentoEntradaMaquinariaCompra = new AditamentoEntradaMaquinariaCompra(null, '');

			//Asignar valores al objeto
			objAditamentoEntradaMaquinariaCompra.intCantidad = objRen.cells[0].innerHTML;
			objAditamentoEntradaMaquinariaCompra.strDescripcion = objRen.cells[1].innerHTML;
			//Agregar objeto en el array
			arrAditamentos.push(objAditamentoEntradaMaquinariaCompra);

		}//Cierre del for Aditamentos

		//Agregar array con los aditamentos del detalle (maquinaria)
        objDetalleEntradaMaquinariaAjuste.setAditamentos(arrAditamentos);

        //Hacer un llamado a la función para cerrar modal
		cerrar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria();
	}

	//Función que se utiliza para cerrar el modal secundario
	function cerrar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		try {
			//Cerrar modal
			objAditamentosMovimientosEntradasMaquinariaAjusteMaquinaria.close();
		}
		catch(err) {}
	}


	/*******************************************************************************************************************
	Funciones de la tabla aditamentos
	*********************************************************************************************************************/
	//Función para agregar renglón a la tabla aditamentos
	function agregar_renglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		//Obtenemos los datos de las cajas de texto
		var intRenglon = $('#txtRenglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var intCantidad = $('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val();
		var strDescripcion = $('#txtDescripcion_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val();

		//Validamos que se capturaron datos
		if (intCantidad == '' || intCantidad == '0')
		{;
			//Enfocar caja de texto
			$('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
			$('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		}
		else if( strDescripcion == '')
		{
			//Enfocar caja de texto
			$('#txtDescripcion_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		}
		else
		{

			//Limpiamos las cajas de texto
			$('#txtRenglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
			$('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
			$('#txtDescripcion_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');

			//Utilizar toUpperCase() para cambiar texto a mayúsculas
			strDescripcion = strDescripcion.toUpperCase();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').getElementsByTagName('tbody')[0];

	        //Revisamos si existe renglón, si es así, editamos los datos
			if (objTabla.rows.namedItem(intRenglon))
			{
				objTabla.rows.namedItem(intRenglon).cells[0].innerHTML = intCantidad;
				objTabla.rows.namedItem(intRenglon).cells[1].innerHTML = strDescripcion;

			}
			else //Insertamos un nuevo renglón
			{ 		

				//Asignamos el número de renglon correspondiente (iniciamos en 0 por cuestión de Indice)
				intRenglon = $("#dg_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria tr").length - 1;
				//Incrementar 1 para el siguiente renglón
				intRenglon++; 

				//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaCantidad = objRenglon.insertCell(0);
				var objCeldaDescripcion = objRenglon.insertCell(1);
				var objCeldaAcciones = objRenglon.insertCell(2);

				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', intRenglon); 
				objCeldaCantidad.setAttribute('class', 'movil c1');
				objCeldaCantidad.innerHTML = intCantidad;
				objCeldaDescripcion.setAttribute('class', 'movil c2');
				objCeldaDescripcion.innerHTML = strDescripcion;
				objCeldaAcciones.setAttribute('class', 'td-center movil c3');
				objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
											 " onclick='eliminar_renglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(this)'>" +
											 "<span class='glyphicon glyphicon-trash'></span></button>" + 
											 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
											 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											 "<span class='glyphicon glyphicon-arrow-down'></span></button>"; 

			}


			//Enfocar caja de texto
			$('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		}

		//Asignar el número de filas de la tabla (se quita la primera fila por que corresponde al encabezado de la tabla)
		var intFilas = $("#dg_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria tr").length - 1;
		$('#numElementos_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').html(intFilas);
	}

	//Función para regresar los datos (al formulario) del renglón seleccionado
	function editar_renglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(objRenglon)
	{
		//Asignar los valores a las cajas de texto
		$('#txtRenglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objRenglon.parentNode.parentNode.getAttribute('id'));
		$('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
		$('#txtDescripcion_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
		//Enfocar caja de texto
		$('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
	}

	//Función para quitar renglón de la tabla
	function eliminar_renglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria(objRenglon)
	{
		//Obtener el indice del objeto renglón que se envía
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
		//Eliminar el renglón indicado
		document.getElementById("dg_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria").deleteRow(intRenglon);
	
		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria tr").length - 1;
		$('#numElementos_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').html(intFilas);

		//Enfocar caja de texto
		$('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();

	}

	//Función para inicializar elementos de la tabla detalles
	function inicializar_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria()
	{
		//Eliminar los datos de la tabla
		$('#dg_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria tbody').empty();
		$('#numElementos_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').html(0);
	}


	//Al inicializar el componente
	$(document).ready(function() 
	{

        /*******************************************************************************************************************
		Controles correspondientes al modal Entradas de maquinaria por Ajuste
		*********************************************************************************************************************/
        //Agregar datepicker para seleccionar fecha
		$('#dteFecha_movimientos_entradas_maquinaria_ajuste_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});

		//Validar campos decimales (no hay necesidad de poner '.')
		$('#txtCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').numeric();

		/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
    	 * por ejemplo: 1800 será 1,800.00*/
    	$('.moneda_movimientos_entradas_maquinaria_ajuste_maquinaria').blur(function(){
			$('.moneda_movimientos_entradas_maquinaria_ajuste_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
		});
        
         //Autocomplete para recuperar los datos de una descripción de maquinaria 
        $('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
	           $('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "maquinaria/maquinaria_descripciones/autocomplete",
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

           	   //Separar datos del registro seleccionado
           		var arrValor = ui.item.value.split(" - ");

				//Elegir código desde el valor devuelto en el autocomplete
				ui.item.value = arrValor[0];

				//Asignar datos del registro seleccionado
             	//Asignar id del registro seleccionado
             	$('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(ui.item.data); 
             	$('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(arrValor[1]);
             	$('#txtDescripcion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(ui.item.descripcion);
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });

        //Verificar que exista id de la descripción de maquinaria cuando pierda el enfoque la caja de texto
        $('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focusout(function(e){
             //Si no existe id de la descripción de maquinaria
             if($('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '' || 
             	$('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '' )
            { 	
             
              //Hacer un llamado a la función para inicializar elementos de la maquinaria
	          inicializar_descripcion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria();

            }
        });

        //Autocomplete para recuperar los datos de una descripción de maquinaria 
		$('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').autocomplete({
			source: function(request, response) {
               //Limpiar caja de texto que hace referencia al id del registro 
	           $('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val('');
				$.ajax({
					//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
					url: "maquinaria/maquinaria_descripciones/autocomplete",
					type: "post",
					dataType: "json",
					data: {
						strDescripcion: request.term
					},
					success: function( data ) {
						response(data);
					}
				});
			},
			select: function(event, ui) {

           	   //Separar datos del registro seleccionado
           		var arrValor = ui.item.value.split(" - ");
           		//Elegir descripción desde el valor devuelto en el autocomplete
				ui.item.value = arrValor[1];

				//Asignar datos del registro seleccionado
				//Asignar id del registro seleccionado
	             $('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(ui.item.data); 
	             $('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(arrValor[0]);
	             $('#txtDescripcion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val(ui.item.descripcion);
				
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			},
			minLength: 1
		});


		//Verificar que exista id de la descripción de maquinaria cuando pierda el enfoque la caja de texto
        $('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focusout(function(e){
             //Si no existe id de la descripción de maquinaria
            if($('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '' ||
               $('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '')
            { 
              //Hacer un llamado a la función para inicializar elementos de la maquinaria
	          inicializar_descripcion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria();
            }
        });


        //Función para mover renglones arriba y abajo en la tabla
	    $('#dg_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').on('click','button.btn',function(){
			//Asignar renglón mas cercano
            var row = $(this).closest('tr');
            //Bajar renglón
            if ($(this).hasClass('btn-default btn-xs down'))
            {
            	//Verifica que no sea el último elemento del grid
            	if( row.next().index() != -1 )
            	{ 
            		objDetallesEntradaMaquinariaAjuste.swap(row.index(), row.next().index() );
            	}	

            	//Pasar al siguiente renglón
            	row.next().after(row);
            }
            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
            {
            	//Verifica que no sea el primer elemento del grid
            	if( row.prev().index() != -1 )
            	{ 
            		objDetallesEntradaMaquinariaAjuste.swap(row.prev().index(), row.index() );
            	}
            	//Pasar al renglón de arriba
            	row.prev().before(row);
            }
			
        });


	    //Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
        $("form").keypress(function(e) {
	        if (e.which == 13) {
	            return false;
	        }
	    });



        //Validar que exista código cuando se pulse la tecla enter 
		$('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	            //Si no existe concepto
	            if($('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '' || $('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '')
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		   	    }
		   	    else
		   	    {
		   	   		//Enfocar caja de texto
				    $('#cmbConsignacion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		   	    }
	        }
	    });

	    //Validar que exista descripción cuando se pulse la tecla enter 
		$('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	            //Si no existe concepto
	            if($('#txtMaquinariaDescripcionID_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '' || $('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '')
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		   	    }
		   	    else
		   	    {
		   	   		//Enfocar caja de texto
				    $('#cmbConsignacion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		   	    }
	        }
	    });



	    //Validar que exista consignación cuando cambie la opción del combobox
        $('#cmbConsignacion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').change(function(){
       		
        	//Si existe consignación
	        if($('#cmbConsignacion_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val() !== '')
	        {
	        	 //Enfocar caja de texto
				 $('#txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
	        }

        });


        //Validar que exista serie cuando se pulse la tecla enter 
		$('#txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	            //Si no existe serie
	            if($('#txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '')
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		   	    }
		   	    else
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtMotor_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		   	    }
	        }
	    });

	    //Comprobar la existencia de la serie en la tabla detalles cuando pierda el enfoque la caja de texto
		$('#txtSerie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focusout(function(e){
			
			//Hacer un llamado a la función para realizar búsqueda de la serie en la tabla detalles
			buscar_serie_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria();
		});


		//Enfocar número de pedimento cuando se pulse la tecla enter 
		$('#txtMotor_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	            //Enfocar caja de texto
				$('#txtNumeroPedimiento_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		   	    
	        }
	    });

	    //Validar longitud del número de pedimento  cuando se pulse la tecla enter 
		$('#txtNumeroPedimiento_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	        	//Asignar número de pedimento 
	        	var strNumeroPedimento = $('#txtNumeroPedimiento_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val();

	            //Si se cumple la sentencia
				if(strNumeroPedimento != '' && strNumeroPedimento.length < 21)
				{
					//Enfocar caja de texto
					$('#txtNumeroPedimiento_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
				}
				else
				{
					//Enfocar caja de texto
					$('#txtCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
				}
		   	    
	        }
	    });


	    //Validar que exista costo cuando se pulse la tecla enter 
		$('#txtCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	         	//Si no existe costo
	            if($('#txtCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '')
		   	    {
		   	   		//Enfocar caja de texto
					$('#txtCosto_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		   	    }
		   	    else
		   	    {
		   	   	  //Hacer un llamado a la función para agregar renglón a la tabla
	   	    		agregar_renglon_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria();
		   	    }
	        }
	    });


	    //Abrir modal cuando se de clic en el botón
		$('#btnVerAditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Si existe detalle seleccionado
			if($('#txtCodigo_detalles_movimientos_entradas_maquinaria_ajuste_maquinaria').val() != '')
			{
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria();
			}

		});


		/*******************************************************************************************************************
		Controles correspondientes al modal Aditamentos
		*********************************************************************************************************************/
		//Validar campos númericos (solamente valores enteros y positivos)
       	$('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').numeric({decimal: false, negative: false});

		//Función para mover renglones arriba y abajo en la tabla
		$('#dg_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').on('click','button.btn',function(){
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


	    //Validar que exista cantidad cuando se pulse la tecla enter 
		$('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	            //Si no existe cantidad
	            if($('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '')
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtCantidad_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		   	    }
		   	    else
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtDescripcion_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		   	    }
	        }
	    });


	    //Validar que exista descripción del descuento cuando se pulse la tecla enter 
		$('#txtDescripcion_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	         	//Si no existe descripción
	            if($('#txtDescripcion_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').val() == '')
		   	    {
		   	   		//Enfocar caja de texto
					$('#txtDescripcion_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		   	    }
		   	    else
		   	    {
		   	   		//Hacer un llamado a la función para agregar renglón a la tabla
		   	    	agregar_renglon_aditamentos_detalle_movimientos_entradas_maquinaria_ajuste_maquinaria();
		   	    }
	        }
	    });



		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_movimientos_entradas_maquinaria_ajuste_maquinaria').on('click','a',function(event){
			event.preventDefault();
			intPaginaMovimientosEntradasMaquinariaAjusteMaquinaria = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_movimientos_entradas_maquinaria_ajuste_maquinaria();
		});

		

        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_movimientos_entradas_maquinaria_ajuste_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_movimientos_entradas_maquinaria_ajuste_maquinaria('Nuevo');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_movimientos_entradas_maquinaria_ajuste_maquinaria').addClass("estatus-NUEVO");
			//Abrir modal
			 objMovimientosEntradasMaquinariaAjusteMaquinaria = $('#MovimientosEntradasMaquinariaAjusteMaquinariaBox').bPopup({
										   appendTo: '#MovimientosEntradasMaquinariaAjusteMaquinariaContent', 
			                               contentContainer: 'MovimientosEntradasMaquinariaAjusteMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#txtOrdenCompraMaquinaria_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();

		});

        //Enfocar caja de texto
        $('#txtFechaInicialBusq_movimientos_entradas_maquinaria_ajuste_maquinaria').focus();
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_movimientos_entradas_maquinaria_ajuste_maquinaria();

	});

</script>