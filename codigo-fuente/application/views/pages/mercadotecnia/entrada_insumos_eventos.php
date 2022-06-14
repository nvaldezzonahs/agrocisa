<div id="EntradaInsumosEventosMercadotecniaContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_entrada_insumos_eventos_mercadotecnia" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_entrada_insumos_eventos_mercadotecnia">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_entrada_insumos_eventos_mercadotecnia'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_entrada_insumos_eventos_mercadotecnia"
			                    		name= "strFechaInicialBusq_entrada_insumos_eventos_mercadotecnia" 
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
							<label for="txtFechaFinalBusq_entrada_insumos_eventos_mercadotecnia">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_entrada_insumos_eventos_mercadotecnia'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_entrada_insumos_eventos_mercadotecnia"
			                    		name= "strFechaFinalBusq_entrada_insumos_eventos_mercadotecnia" 
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
				<!--Evento-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtEventoBusq_entrada_insumos_eventos_mercadotecnia">Evento</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtEventoBusqID_entrada_insumos_eventos_mercadotecnia" 
									name="strEventoBusqID_entrada_insumos_eventos_mercadotecnia" 
									type="hidden" />
							<input  class="form-control" 
									id="txtEventoBusq_entrada_insumos_eventos_mercadotecnia" 
									name="strEventoBusq_entrada_insumos_eventos_mercadotecnia" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese evento" />
						</div>
					</div>
				</div>
				<!--Botones-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div id="ToolBtns" class="btn-group btn-toolBtns">
						<!-- Buscar registros -->
						<button class="btn btn-primary" id="btnBuscar_entrada_insumos_eventos_mercadotecnia"
								onclick="paginacion_entrada_insumos_eventos_mercadotecnia();" 
								title="Buscar coincidencias" tabindex="1"> 
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<!--Dar de alta un nuevo registro-->
						<button class="btn btn-info" id="btnNuevo_entrada_insumos_eventos_mercadotecnia" 
								title="Nuevo registro" tabindex="1"> 
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>   
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_entrada_insumos_eventos_mercadotecnia"
								onclick="reporte_entrada_insumos_eventos_mercadotecnia();" title="Generar reporte PDF" tabindex="1">
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_entrada_insumos_eventos_mercadotecnia"
								onclick="descargar_xls_entrada_insumos_eventos_mercadotecnia();" title="Descargar archivo XLS" tabindex="1">
							<span class="fa fa-file-excel-o"></span>
						</button>  
					</div>
				</div>
			</div>
			<div class="row">
				<!--Mostrar detalles de los registros en el reporte PDF--> 
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="checkbox">
                    	<label id="label-checkbox">
                        	<input class="form-control" 
                        			id="chbImprimirDetalles_entrada_insumos_eventos_mercadotecnia" 
								   	name="strImprimirDetalles_entrada_insumos_eventos_mercadotecnia" 
								   	type="checkbox"
								   	value="" 
								   	tabindex="1" />
							<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							Imprimir detalles
                    	</label>
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
			Definir columnas
			*/
			td.movil:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
			td.movil:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
			td.movil:nth-of-type(3):before {content: "Salida"; font-weight: bold;}
			td.movil:nth-of-type(4):before {content: "Evento"; font-weight: bold;}
			td.movil:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
			td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_entrada_insumos_eventos_mercadotecnia">
				<thead class="movil">
					<tr class="movil">
						<th class="movil">Folio</th>
						<th class="movil">Fecha</th>
						<th class="movil">Salida</th>
						<th class="movil">Evento</th>
						<th class="movil">Estatus</th>
						<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
					</tr>
				</thead>
				<tbody class="movil"></tbody>
				<script id="plantilla_entrada_insumos_eventos_mercadotecnia" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil">{{folio}}</td>
						<td class="movil">{{fecha}}</td>
						<td class="movil">{{folioSalida}}</td>
						<td class="movil">{{evento}}</td>
						<td class="movil">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_entrada_insumos_eventos_mercadotecnia({{movimiento_insumo_id}},'Editar')"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_entrada_insumos_eventos_mercadotecnia({{movimiento_insumo_id}},'Ver')"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_entrada_insumos_eventos_mercadotecnia({{movimiento_insumo_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_entrada_insumos_eventos_mercadotecnia({{movimiento_insumo_id}},'{{estatus}}')" title="Desactivar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_entrada_insumos_eventos_mercadotecnia"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_entrada_insumos_eventos_mercadotecnia">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!-- Diseño del modal-->
	<div id="EntradaInsumosEventosMercadotecniaBox" class="ModalBody">
		<!--Título-->
		<div id="divEncabezadoModal_entrada_insumos_eventos_mercadotecnia"  class="ModalBodyTitle">
			<h1>Entrada de insumos después de evento</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form 	id="frmEntradaInsumosEventosMercadotecnia" 
					method="post" 
					action="#" 
					class="form-horizontal" 
					role="form" 
				  	name="frmEntradaInsumosEventosMercadotecnia"  
				  	onsubmit="return(false)" autocomplete="off">

				<div class="row">
				  	<!-- Folio -->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input 	id="txtEntradaInsumosEventosID_entrada_insumos_eventos_mercadotecnia" 
										name="intEntradaInsumosEventosID_entrada_insumos_eventos_mercadotecnia" 
										type="hidden" 
										value="" />
								<label for="txtFolio_entrada_insumos_eventos_mercadotecnia">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtFolio_entrada_insumos_eventos_mercadotecnia" 
										name="strFolio_entrada_insumos_eventos_mercadotecnia" 
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
								<label for="txtFecha_entrada_insumos_eventos_mercadotecnia">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_entrada_insumos_eventos_mercadotecnia'>
				                    <input class="form-control" 
				                    		id="txtFecha_entrada_insumos_eventos_mercadotecnia"
				                    		name= "strFecha_entrada_insumos_eventos_mercadotecnia" 
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
					<!-- Salida -->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<input 	id="txtSalidaID_entrada_insumos_eventos_mercadotecnia" 
										name="intSalidaID_entrada_insumos_eventos_mercadotecnia" 
										type="hidden" 
										value=""/>
								<label for="txtSalida_entrada_insumos_eventos_mercadotecnia">Salida</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSalida_entrada_insumos_eventos_mercadotecnia" 
										name="strSalida_entrada_insumos_eventos_mercadotecnia" 
										type="text" 
										value=""
										maxlength="10" 
										tabindex="1"
										placeholder="Ingrese salida" />
							</div>
						</div>
					</div>
					<!-- Evento -->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtEventoID_entrada_insumos_eventos_mercadotecnia" 
										name="intEventoID_entrada_insumos_eventos_mercadotecnia" 
										type="hidden" />
								<label for="txtEvento_entrada_insumos_eventos_mercadotecnia">
								Evento</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtEvento_entrada_insumos_eventos_mercadotecnia" 
										name="strEvento_entrada_insumos_eventos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1"
										maxlength="50" 
										disabled="false" />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Observaciones -->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtObservaciones_entrada_insumos_eventos_mercadotecnia">
								Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_entrada_insumos_eventos_mercadotecnia" 
										name="strObservaciones_entrada_insumos_eventos_mercadotecnia" 
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
								<input id="txtNumDetalles_entrada_insumos_eventos_mercadotecnia" 
							   		name="intNumDetalles_entrada_insumos_eventos_mercadotecnia" type="hidden" value="" />
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Detalles de la entrada de insumos</h4>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Insumo-->
													<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtInsumoID_detalles_entrada_insumos_eventos_mercadotecnia" 
																		name="inttInsumoID_detalles_entrada_insumos_eventos_mercadotecnia"
																		type="hidden" />
																<label for="txtInsumo_detalles_entrada_insumos_eventos_mercadotecnia">
																	Insumo
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtInsumo_detalles_entrada_insumos_eventos_mercadotecnia" 
																		name="strInsumo_detalles_entrada_insumos_eventos_mercadotecnia" 
																		type="text" 
																		value="" 
																		tabindex="1"  
																		maxlength="250" disabled />
															</div>
														</div>
													</div>
													<!--Salida-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtSalida_detalles_entrada_insumos_eventos_mercadotecnia">
																	Salida
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad" 
																		id="txtSalida_detalles_entrada_insumos_eventos_mercadotecnia" 
																		name="intSalida_detalles_entrada_insumos_eventos_mercadotecnia" 
																		type="text" 
																		value="" 
																		tabindex="1" 
																		maxlength="14" disabled />
															</div>
														</div>
													</div>
													<!--Entrada-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtEntrada_detalles_entrada_insumos_eventos_mercadotecnia">
																	Entrada
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad" 
																		id="txtEntrada_detalles_entrada_insumos_eventos_mercadotecnia" 
																		name="intEntrada_detalles_entrada_insumos_eventos_mercadotecnia" 
																		type="text" 
																		value="" 
																		tabindex="1"
																		placeholder="Ingrese entrada" 
																		maxlength="14" />
															</div>
														</div>
													</div>
													<!--Costo-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCostoUnitario_detalles_entrada_insumos_eventos_mercadotecnia">Costo unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_entrada_insumos_eventos_mercadotecnia" 
																		id="txtCostoUnitario_detalles_entrada_insumos_eventos_mercadotecnia" 
																		name="intCostoUnitario_detalles_entrada_insumos_eventos_mercadotecnia" 
																		type="text" 
																		value="" 
																		tabindex="1"
																		disabled />
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-1">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_entrada_insumos_eventos_mercadotecnia" 
					                                			onclick="agregar_renglon_detalles_entrada_insumos_eventos_mercadotecnia();" 
					                                	     	title="Agregar" tabindex="1"> 
					                                		<span class="glyphicon glyphicon-plus"></span>
					                                	</button>
					                             	</div>
												</div>
											</div>
										</div>

										<div class="row">
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_entrada_insumos_eventos_mercadotecnia">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Insumo</th>
																<th class="movil">Salida</th>
																<th class="movil">Entrada</th>
																<th class="movil">Importe</th>
																<th class="movil">Subtotal</th>
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
																	<strong id="acumSalida_detalles_entrada_insumos_eventos_mercadotecnia">0.00</strong>
																</td>
																<td  class="movil t2">
																	<strong id="acumEntrada_detalles_entrada_insumos_eventos_mercadotecnia">0.00</strong>
																</td>
																<td class="movil t3">
																	<strong id="acumImporte_detalles_entrada_insumos_eventos_mercadotecnia">$0.00</strong>
																</td>
																<td class="movil t4">
																	<strong id="acumSubtotal_detalles_entrada_insumos_eventos_mercadotecnia">$0.00</strong>
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
																<strong id="numElementos_detalles_entrada_insumos_eventos_mercadotecnia">0</strong> encontrados
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
						<button class="btn btn-info" id="btnReset_entrada_insumos_eventos_mercadotecnia"  
								onclick="nuevo_entrada_insumos_eventos_mercadotecnia();"  title="Nuevo registro" tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_entrada_insumos_eventos_mercadotecnia"  
								onclick="validar_entrada_insumos_eventos_mercadotecnia();"  title="Guardar" tabindex="2">
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_entrada_insumos_eventos_mercadotecnia"  
								onclick="reporte_registro_entrada_insumos_eventos_mercadotecnia('');"  
								title="Imprimir" tabindex="5">
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" id="btnDesactivar_entrada_insumos_eventos_mercadotecnia"  
								onclick="cambiar_estatus_entrada_insumos_eventos_mercadotecnia('','ACTIVO');"  title="Desactivar" tabindex="6">
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_entrada_insumos_eventos_mercadotecnia"
								type="reset" aria-hidden="true" onclick="cerrar_entrada_insumos_eventos_mercadotecnia();" 
								title="Cerrar"  tabindex="3">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>							

			</form><!--Cierre del formulario-->
		</div>
	</div>			  

</div><!--#EntradaInsumosEventosMercadotecniaContent -->

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variables que se utilizan para la paginación de registros
	var intPaginaEntradaInsumosEventosMercadotecnia = 0;
	var strUltimaBusquedaEntradaInsumosEventosMercadotecnia = "";
	//Variables que se utilizan para la búsqueda de registros
	var intEventoIDEntradaInsumosEventosMercadotecnia = "";
	var dteFechaInicialEntradaInsumosEventosMercadotecnia = "";
	var dteFechaFinalEntradaInsumosEventosMercadotecnia = "";
	//Variable que se utiliza para asignar objeto del modal
	var objEntradaInsumosEventosMercadotecnia = null;

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_entrada_insumos_eventos_mercadotecnia()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('mercadotecnia/entrada_insumos_eventos/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_entrada_insumos_eventos_mercadotecnia').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosEntradaInsumosEventosMercadotecnia = data.row;
				//Separar la cadena 
				var arrPermisosEntradaInsumosEventosMercadotecnia = strPermisosEntradaInsumosEventosMercadotecnia.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosEntradaInsumosEventosMercadotecnia.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosEntradaInsumosEventosMercadotecnia[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_entrada_insumos_eventos_mercadotecnia').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosEntradaInsumosEventosMercadotecnia[i]=='GUARDAR') || (arrPermisosEntradaInsumosEventosMercadotecnia[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_entrada_insumos_eventos_mercadotecnia').removeAttr('disabled');
					}
					else if(arrPermisosEntradaInsumosEventosMercadotecnia[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_entrada_insumos_eventos_mercadotecnia').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_entrada_insumos_eventos_mercadotecnia();
					}
					else if(arrPermisosEntradaInsumosEventosMercadotecnia[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_entrada_insumos_eventos_mercadotecnia').removeAttr('disabled');
						$('#btnRestaurar_entrada_insumos_eventos_mercadotecnia').removeAttr('disabled');
					}
					else if(arrPermisosEntradaInsumosEventosMercadotecnia[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_entrada_insumos_eventos_mercadotecnia').removeAttr('disabled');
					}
					else if(arrPermisosEntradaInsumosEventosMercadotecnia[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_entrada_insumos_eventos_mercadotecnia').removeAttr('disabled');
					}
					else if(arrPermisosEntradaInsumosEventosMercadotecnia[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_entrada_insumos_eventos_mercadotecnia').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_entrada_insumos_eventos_mercadotecnia() 
	{
		//Asignar valores para la búsqueda de registros
		var dteFechaInicialEntradaInsumosEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicialBusq_entrada_insumos_eventos_mercadotecnia').val());
		var dteFechaFinalEntradaInsumosEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinalBusq_entrada_insumos_eventos_mercadotecnia').val());
		//var intProveedorIDEntradaInsumosEventosMercadotecnia = $('#txtProveedorBusqID_entrada_insumos_eventos_mercadotecnia').val();
		//Si no existe fecha inicial
		if(dteFechaInicialEntradaInsumosEventosMercadotecnia == '')
		{
			dteFechaInicialEntradaInsumosEventosMercadotecnia = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalEntradaInsumosEventosMercadotecnia == '')
		{
			dteFechaFinalEntradaInsumosEventosMercadotecnia =  '0000-00-00';
		}
		//Si no existe id del evento en busqueda
		if( $('#txtEventoBusqID_entrada_insumos_eventos_mercadotecnia').val() == '' || 
			$('#txtEventoBusq_entrada_insumos_eventos_mercadotecnia').val() == ''
		  )
		{
			intEventoIDEntradaInsumosEventosMercadotecnia = 0;
		}
		else{
			intEventoIDEntradaInsumosEventosMercadotecnia = $('#txtEventoBusqID_entrada_insumos_eventos_mercadotecnia').val();
		}
		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('mercadotecnia/entrada_insumos_eventos/get_paginacion',
				{	dteFechaInicial: dteFechaInicialEntradaInsumosEventosMercadotecnia,
	    			dteFechaFinal: dteFechaFinalEntradaInsumosEventosMercadotecnia,
	    			intEventoID: intEventoIDEntradaInsumosEventosMercadotecnia,
					intTipoMovimiento: 2,
					intPagina:intPaginaEntradaInsumosEventosMercadotecnia,
					strPermisosAcceso: $('#txtAcciones_entrada_insumos_eventos_mercadotecnia').val()
				},
				function(data){
					$('#dg_entrada_insumos_eventos_mercadotecnia tbody').empty();
					var tmpEntradaInsumosEventosMercadotecnia = Mustache.render($('#plantilla_entrada_insumos_eventos_mercadotecnia').html(),data);
					$('#dg_entrada_insumos_eventos_mercadotecnia tbody').html(tmpEntradaInsumosEventosMercadotecnia);
					$('#pagLinks_entrada_insumos_eventos_mercadotecnia').html(data.paginacion);
					$('#numElementos_entrada_insumos_eventos_mercadotecnia').html(data.total_rows);
					intPaginaEntradaInsumosEventosMercadotecnia = data.pagina;
				},
		'json');
	}

	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_entrada_insumos_eventos_mercadotecnia()
	{
		//Incializar formulario
		$('#frmEntradaInsumosEventosMercadotecnia')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_entrada_insumos_eventos_mercadotecnia();
		//Limpiar cajas de texto ocultas
		$('#frmEntradaInsumosEventosMercadotecnia').find('input[type=hidden]').val('');
	
		//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
		$('#divEncabezadoModal_entrada_insumos_eventos_mercadotecnia').removeClass("estatus-NUEVO");
		$('#divEncabezadoModal_entrada_insumos_eventos_mercadotecnia').removeClass("estatus-ACTIVO");
		$('#divEncabezadoModal_entrada_insumos_eventos_mercadotecnia').removeClass("estatus-INACTIVO");

		/******************************************************************
		* INICIALIZACIÓN DE ELEMENTOS - ESTADO DEFAULT
		*******************************************************************/	
		//Folio
		$('#txtFolio_entrada_insumos_eventos_mercadotecnia').val('');
		//Asignar la fecha actual
		$('#txtFecha_entrada_insumos_eventos_mercadotecnia').val(fechaActual()); 
		//Eliminar los datos de la tabla detalles de la salida de insumos a evento
	    //Botón para agregar detalles
	    $('#btnAgregar_entrada_insumos_eventos_mercadotecnia').attr('disabled', false);
	    //Datagrid detalles
	    $('#dg_detalles_entrada_insumos_eventos_mercadotecnia tbody').empty();
	    $('#acumSalida_detalles_entrada_insumos_eventos_mercadotecnia').html('0.00');
	    $('#acumEntrada_detalles_entrada_insumos_eventos_mercadotecnia').html('0.00');
	    $('#acumImporte_detalles_entrada_insumos_eventos_mercadotecnia').html('$0.00');
	    $('#acumSubtotal_detalles_entrada_insumos_eventos_mercadotecnia').html('$0.00');
		$('#numElementos_detalles_entrada_insumos_eventos_mercadotecnia').html(0);

		//Mostrar botón Guardar
		$("#btnGuardar_entrada_insumos_eventos_mercadotecnia").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_entrada_insumos_eventos_mercadotecnia").hide();
		$("#btnDesactivar_entrada_insumos_eventos_mercadotecnia").hide();
		$("#btnRestaurar_entrada_insumos_eventos_mercadotecnia").hide();		
	}

	//Función que se utiliza para cerrar el modal
	function cerrar_entrada_insumos_eventos_mercadotecnia()
	{
		try {
			//Cerrar modal
			objEntradaInsumosEventosMercadotecnia.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_entrada_insumos_eventos_mercadotecnia').focus();
		}
		catch(err) {}
	}

	//Función para agregar renglón a la tabla
	function agregar_renglon_detalles_entrada_insumos_eventos_mercadotecnia()
	{
		var strInsumo = $('#txtInsumo_detalles_entrada_insumos_eventos_mercadotecnia').val();
		var intSalida = $('#txtSalida_detalles_entrada_insumos_eventos_mercadotecnia').val();
		var intEntrada = $('#txtEntrada_detalles_entrada_insumos_eventos_mercadotecnia').val();
		var intCosto = $('#txtCostoUnitario_detalles_entrada_insumos_eventos_mercadotecnia').val();

		//Obtenemos el objeto de la tabla
		var objTabla = document.getElementById('dg_detalles_entrada_insumos_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

		strInsumo = strInsumo.toUpperCase();
		if (strInsumo == '' || intEntrada == '')
		{
			//Enfocar caja de texto
			$('#txtEntrada_detalles_entrada_insumos_eventos_mercadotecnia').focus();
		}	
		else if(objTabla.rows.namedItem(strInsumo)){
		
			if(intEntrada > intSalida){
				$('#txtEntrada_detalles_entrada_insumos_eventos_mercadotecnia').focus();
				mensaje_entrada_insumos_eventos_mercadotecnia('error', 'La entrada de insumo no puede superar la salida');
			}
			else{
				objTabla.rows.namedItem(strInsumo).cells[2].innerHTML = formatMoney(intEntrada, 2, '');
				objTabla.rows.namedItem(strInsumo).cells[4].innerHTML = formatMoney(intEntrada * intCosto, 6, '');
				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_entrada_insumos_eventos_mercadotecnia();
			}
		}
		
	}

	//Función para regresar los datos (al formulario) del renglón seleccionado
	function editar_renglon_detalles_entrada_insumos_eventos_mercadotecnia(objRenglon)
	{
		//Asignar los valores a las cajas de texto
		$('#txtInsumoID_detalles_entrada_insumos_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[5].innerHTML);
		$('#txtInsumo_detalles_entrada_insumos_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
		$('#txtSalida_detalles_entrada_insumos_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
		$('#txtEntrada_detalles_entrada_insumos_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
		$('#txtCostoUnitario_detalles_entrada_insumos_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
		//Enfocar caja de texto
		$('#txtEntrada_detalles_entrada_insumos_eventos_mercadotecnia').focus();
	}

	//Función para calcular totales de la tabla
	function calcular_totales_detalles_entrada_insumos_eventos_mercadotecnia()
	{
		//Obtenemos el objeto de la tabla 
		var objTabla = document.getElementById('dg_detalles_entrada_insumos_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

		//Inicializamos las variables que se utilizan para los acumulados
		var intAcumSalida = 0;
		var intAcumEntrada = 0;
		var intAcumImporte = 0;
		var intAcumSubtotal = 0;

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Incrementar acumulados
			intAcumSalida += parseFloat(objRen.cells[1].innerHTML);
			intAcumEntrada += parseFloat(objRen.cells[2].innerHTML);
			intAcumImporte += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
			intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
		}

		//Convertir cantidad a formato moneda
		intAcumSalida = formatMoney(intAcumSalida, 2, '');
		intAcumEntrada = formatMoney(intAcumEntrada, 2, '');
		intAcumImporte =  '$'+formatMoney(intAcumImporte, 6, '');
		intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 6, '');

		//Asignar los valores
		$('#acumSalida_detalles_entrada_insumos_eventos_mercadotecnia').html(intAcumSalida);
		$('#acumEntrada_detalles_entrada_insumos_eventos_mercadotecnia').html(intAcumEntrada);
		$('#acumImporte_detalles_entrada_insumos_eventos_mercadotecnia').html(intAcumImporte);
		$('#acumSubtotal_detalles_entrada_insumos_eventos_mercadotecnia').html(intAcumSubtotal);
		
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_entrada_insumos_eventos_mercadotecnia()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_entrada_insumos_eventos_mercadotecnia();
		//Validación del formulario de campos obligatorios
		$('#frmEntradaInsumosEventosMercadotecnia')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_entrada_insumos_eventos_mercadotecnia: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intSalidaID_entrada_insumos_eventos_mercadotecnia: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtSalidaID_entrada_insumos_eventos_mercadotecnia').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un movimiento de salida existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strEvento_entrada_insumos_eventos_mercadotecnia:{
											excluded: true, // Ignorar (no valida el campo)
										},
									    strObservaciones_entrada_insumos_eventos_mercadotecnia: {
									        excluded: true  // Ignorar (no valida el campo)    
									    },
									    strInsumo_detalles_entrada_insumos_eventos_mercadotecnia: {
									        excluded: true  // Ignorar (no valida el campo)    
									    },
									    intSalida_detalles_entrada_insumos_eventos_mercadotecnia: {
									        excluded: true  // Ignorar (no valida el campo)    
									    },
									    intEntrada_detalles_entrada_insumos_eventos_mercadotecnia: {
									        excluded: true  // Ignorar (no valida el campo)    
									    },
									    intCostoUnitario_detalles_entrada_insumos_eventos_mercadotecnia: {
									        excluded: true  // Ignorar (no valida el campo)    
									    }
									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_entrada_insumos_eventos_mercadotecnia = $('#frmEntradaInsumosEventosMercadotecnia').data('bootstrapValidator');
		bootstrapValidator_entrada_insumos_eventos_mercadotecnia.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_entrada_insumos_eventos_mercadotecnia.isValid())
		{

			guardar_entrada_insumos_eventos_mercadotecnia();
			
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_entrada_insumos_eventos_mercadotecnia()
	{
		try
		{
			$('#frmEntradaInsumosEventosMercadotecnia').data('bootstrapValidator').resetForm();

		}
		catch(err) {}
	}

	//Función para guardar o modificar los datos de un registro
	function guardar_entrada_insumos_eventos_mercadotecnia()
	{
		
		//Obtenemos el objeto de la tabla detalles
		var objTabla = document.getElementById('dg_detalles_entrada_insumos_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

		//Inicializamos las variables que obtendrán los datos de la tabla
		var arrInsumoID = [];
		var arrCantidades = [];
		var arrPreciosUnitarios = [];
		
		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{

			//Variable que se utilizan para asignar valores del detalle
			var intCantidad = objRen.cells[2].innerHTML;
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			var intPrecioUnitario = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
			
			arrInsumoID.push(objRen.getAttribute('id'));
			arrCantidades.push(intCantidad);
			arrPreciosUnitarios.push(intPrecioUnitario);
		}

		
		//Hacer un llamado al método del controlador para guardar los datos del registro
		$.post('mercadotecnia/entrada_insumos_eventos/guardar',
				{ 
					//Datos de la entrada por compra
					intEntradaInsumosEventosID: $('#txtEntradaInsumosEventosID_entrada_insumos_eventos_mercadotecnia').val(),
					strFolioConsecutivo: $('#txtFolio_entrada_insumos_eventos_mercadotecnia').val(),
					//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					dteFecha: $.formatFechaMysql($('#txtFecha_entrada_insumos_eventos_mercadotecnia').val()),
					intMovimientoInsumoReferenciaID: $('#txtSalidaID_entrada_insumos_eventos_mercadotecnia').val(),
					strObservaciones: $('#txtObservaciones_entrada_insumos_eventos_mercadotecnia').val(),
					intProcesoMenuID: $('#txtProcesoMenuID_entrada_insumos_eventos_mercadotecnia').val(),
					//Datos de los detalles
					strInsumoID: arrInsumoID.join('|'), 
					strCantidades: arrCantidades.join('|'),
					strPreciosUnitarios: arrPreciosUnitarios.join('|')
				},
				function(data) {

					if (data.resultado)
					{	
	                    //Hacer un llamado a la función para cerrar modal e inicializar objeto bootstrapValidator
	                    cerrar_entrada_insumos_eventos_mercadotecnia();
	                    //Hacer llamado a la función  para cargar  los registros en el grid
		               	paginacion_entrada_insumos_eventos_mercadotecnia();   
	                    //Si no existe id de la salida de insumos a evento, significa que es un nuevo registro   
						if($('#txtEntradaInsumosEventosID_entrada_insumos_eventos_mercadotecnia').val() == '')
						{
						  	//Asignar el id del movimiento registrado en la base de datos
                 			$('#txtEntradaInsumosEventosID_entrada_insumos_eventos_mercadotecnia').val(data.entrada_insumos_eventos_id);
                 			//Asignar folio consecutivo
                 			$('#txtFolio_entrada_insumos_eventos_mercadotecnia').val(data.folio);
						} 	    
					}

					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_entrada_insumos_eventos_mercadotecnia(data.tipo_mensaje, data.mensaje);

				},
		'json');
		

	}

	// Función para cambiar el estatus del registro seleccionado
	function cambiar_estatus_entrada_insumos_eventos_mercadotecnia(id, estatus)
	{

		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtEntradaInsumosEventosID_entrada_insumos_eventos_mercadotecnia').val();

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
					              'title':    'Entrada de Insumos después de evento',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('mercadotecnia/entrada_insumos_eventos/set_estatus',
					                                     {
					                                     	intEntradaInsumosEventosID: intID,
					                                      	strEstatus: estatus
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                            //Hacer llamado a la función  para cargar  los registros en el grid
					                                            paginacion_entrada_insumos_eventos_mercadotecnia();
					                                            //Si el id del registro se obtuvo del modal
																if(id == '')
																{
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_entrada_insumos_eventos_mercadotecnia();     
																}
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_entrada_insumos_eventos_mercadotecnia(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });
	    }
	    else//Si el estatus del registro es INACTIVO
	    {
			//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
			$.post('mercadotecnia/entrada_insumos_eventos/set_estatus',
			     {
			     	intEntradaInsumosEventosID: intID,
			      	strEstatus: estatus
			     },
			     function(data) {
			      if (data.resultado)
			      {
			        //Hacer llamado a la función para cargar  los registros en el grid
			      	paginacion_entrada_insumos_eventos_mercadotecnia();
			      	//Si el id del registro se obtuvo del modal
					if(id == '')
					{
						//Hacer un llamado a la función para cerrar modal
						cerrar_entrada_insumos_eventos_mercadotecnia();     
					}
			      }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_entrada_insumos_eventos_mercadotecnia(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
	    }
	   
	}


	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_entrada_insumos_eventos_mercadotecnia(id, tipoAccion)
	{	
	   //Hacer un llamado al método del controlador para regresar los datos del registro
	   $.post('mercadotecnia/entrada_insumos_eventos/get_datos',
       {
       		intMovimientoInsumoID:id
       },
       function(data) {

       		//Si hay datos del registro
		    if(data.row)
		    {
		    	//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_entrada_insumos_eventos_mercadotecnia();
				//Asignar estatus del registro
				var strEstatus = data.row.estatus;
	          	
	            
				//Recuperar valores
	            $('#txtEntradaInsumosEventosID_entrada_insumos_eventos_mercadotecnia').val(data.row.movimiento_insumo_id);
	            $('#txtFolio_entrada_insumos_eventos_mercadotecnia').val(data.row.folio);
	            $('#txtFecha_entrada_insumos_eventos_mercadotecnia').val(data.row.fecha);
	            $('#txtObservaciones_entrada_insumos_eventos_mercadotecnia').val(data.row.observaciones);
	            
	            //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('mercadotecnia/entrada_insumos_eventos/get_salida_evento',
                  { 
                  	intSalidaInsumoID: data.row.movimiento_insumo_referencia_id
                  },
                  function(data2) {
                    if(data2.row){
                       
                       $("#txtSalidaID_entrada_insumos_eventos_mercadotecnia").val(data2.row.movimiento_insumo_id);
                       $("#txtSalida_entrada_insumos_eventos_mercadotecnia").val(data2.row.folio);
                       $("#txtEventoID_entrada_insumos_eventos_mercadotecnia").val(data2.row.evento_id);
                       $("#txtEvento_entrada_insumos_eventos_mercadotecnia").val(data2.row.evento);
                       
                    }
                  }
                 ,
                'json');
	            
	            //Cargar los detalles correspondientes al movimiento
                if(data.detalles){

                	for (var intCon in data.detalles) 
		            {
		            	//Obtenemos el objeto de la tabla
						var objTabla = document.getElementById('dg_detalles_entrada_insumos_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

						//Insertamos el renglón con sus celdas en el objeto de la tabla
						var objRenglon = objTabla.insertRow();
						var objCeldaInsumo = objRenglon.insertCell(0);
						var objCeldaSalida = objRenglon.insertCell(1);
						var objCeldaEntrada = objRenglon.insertCell(2);
						var objCeldaImporte = objRenglon.insertCell(3);
						var objCeldaSubtotal = objRenglon.insertCell(4);
						var objCeldaAcciones = objRenglon.insertCell(5);

						//Variables que se utilizan para asignar valores del detalle
						var intInsumo = data.detalles[intCon].insumo_id;
						var strInsumo = data.detalles[intCon].descripcion;
						var intImporte = parseFloat(data.detalles[intCon].precio_unitario);
						var intEntrada =  parseFloat(data.detalles[intCon].entrada);
						var intSalida =  parseFloat(data.detalles[intCon].salida);
						
						var intSubtotal = 0;

						//Calcular subtotal
						intSubtotal = intEntrada * intImporte;
						
						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', intInsumo);
						objCeldaInsumo.setAttribute('class', 'movil b1');
						objCeldaInsumo.innerHTML = strInsumo;
						objCeldaSalida.setAttribute('class', 'movil b2');
						objCeldaSalida.innerHTML = formatMoney(intSalida, 2, '');
						objCeldaEntrada.setAttribute('class', 'movil b2');
						objCeldaEntrada.innerHTML = formatMoney(intEntrada, 2, '');;
						objCeldaImporte.setAttribute('class', 'movil b3');
						objCeldaImporte.innerHTML = formatMoney(intImporte, 6, '');
						objCeldaSubtotal.setAttribute('class', 'movil b4');
						objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 6, '');
						objCeldaAcciones.setAttribute('class', 'td-center movil b5');
						objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalles_entrada_insumos_eventos_mercadotecnia(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>";

		            }

		            //Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_detalles_entrada_insumos_eventos_mercadotecnia();
					//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
					var intFilas = $("#dg_detalles_entrada_insumos_eventos_mercadotecnia tr").length - 2;
					$('#numElementos_detalles_entrada_insumos_eventos_mercadotecnia').html(intFilas);
					$('#txtNumDetalles_entrada_insumos_eventos_mercadotecnia').val(intFilas);

                }
	            
	            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
	            $('#divEncabezadoModal_entrada_insumos_eventos_mercadotecnia').addClass("estatus-"+strEstatus);
	            //Mostrar botón Imprimir  
	            $("#btnImprimirRegistro_entrada_insumos_eventos_mercadotecnia").show();
	           	
				//Si el tipo de acción corresponde a Ver
	            if(tipoAccion == 'Ver')
	            {
	            	//Deshabilitar todos los elementos del formulario
	            	$('#frmEntradaInsumosEventosMercadotecnia').find('input, textarea, select').attr('disabled','disabled');
	            	//Ocultar botón Guardar
		            $("#btnGuardar_entrada_insumos_eventos_mercadotecnia").hide();

		            //Si el estatus del registro es INACTIVO
	            	if(strEstatus == 'INACTIVO')
	            	{
	            		//Mostrar botón Restaurar
	            		$("#btnRestaurar_entrada_insumos_eventos_mercadotecnia").show();
	            	}

	            }
	            else
	            {
	            	//Si el estatus del registro es ACTIVO
		            if(strEstatus == 'ACTIVO')
		            {
		            	//Mostrar los siguientes botones  
		            	$("#btnDesactivar_entrada_insumos_eventos_mercadotecnia").show();
		            }
	            }
	            
	            
	            //Abrir modal
				objEntradaInsumosEventosMercadotecnia = $('#EntradaInsumosEventosMercadotecniaBox').bPopup({
											   appendTo: '#EntradaInsumosEventosMercadotecniaContent', 
				                               contentContainer: 'EntradaInsumosEventosMercadotecniaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

	            //Enfocar caja de texto
				$('#txtFecha_entrada_insumos_eventos_mercadotecnia').focus();

		    }

       });
	}

	//Función para cargar el reporte general en PDF
	function reporte_entrada_insumos_eventos_mercadotecnia() 
	{
		//Asignar valores para la búsqueda de registros
		intEventoIDEntradaInsumosEventosMercadotecnia =  $('#txtEventoBusqID_entrada_insumos_eventos_mercadotecnia').val();
		dteFechaInicialEntradaInsumosEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicialBusq_entrada_insumos_eventos_mercadotecnia').val());
		dteFechaFinalEntradaInsumosEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinalBusq_entrada_insumos_eventos_mercadotecnia').val());

		//Si no existe fecha inicial
		if(dteFechaInicialEntradaInsumosEventosMercadotecnia == '')
		{
			dteFechaInicialEntradaInsumosEventosMercadotecnia = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalEntradaInsumosEventosMercadotecnia == '')
		{
			dteFechaFinalEntradaInsumosEventosMercadotecnia =  '0000-00-00';
		}
		
		//Si no existe id del proveedor
		if(intEventoIDEntradaInsumosEventosMercadotecnia == '')
		{
			intEventoIDEntradaInsumosEventosMercadotecnia = 0;
		}


		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_entrada_insumos_eventos_mercadotecnia').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_entrada_insumos_eventos_mercadotecnia').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_entrada_insumos_eventos_mercadotecnia').val('NO');
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("mercadotecnia/entrada_insumos_eventos/get_reporte/"+dteFechaInicialEntradaInsumosEventosMercadotecnia+"/"
			+dteFechaFinalEntradaInsumosEventosMercadotecnia+"/"
			+intEventoIDEntradaInsumosEventosMercadotecnia+"/"
			+$('#chbImprimirDetalles_entrada_insumos_eventos_mercadotecnia').val());
	}

	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_entrada_insumos_eventos_mercadotecnia(id)
	{	

		//Variable que se utiliza para asignar id
		var intEntradaInsumosEventosID = 0;
		
		//Dependiendo del tipo de formulario asignar id
		if(id == '')
			intEntradaInsumosEventosID = $('#txtEntradaInsumosEventosID_entrada_insumos_eventos_mercadotecnia').val();
		else
			intEntradaInsumosEventosID = id;

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("mercadotecnia/entrada_insumos_eventos/get_reporte_registro/" + intEntradaInsumosEventosID);
	}

	//Función para descargar el archivo XLS
	function descargar_xls_entrada_insumos_eventos_mercadotecnia() 
	{
		//Asignar valores para la búsqueda de registros
		intEventoIDEntradaInsumosEventosMercadotecnia =  $('#txtEventoBusqID_entrada_insumos_eventos_mercadotecnia').val();
		dteFechaInicialEntradaInsumosEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicialBusq_entrada_insumos_eventos_mercadotecnia').val());
		dteFechaFinalEntradaInsumosEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinalBusq_entrada_insumos_eventos_mercadotecnia').val());

		//Si no existe fecha inicial
		if(dteFechaInicialEntradaInsumosEventosMercadotecnia == '')
		{
			dteFechaInicialEntradaInsumosEventosMercadotecnia = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalEntradaInsumosEventosMercadotecnia == '')
		{
			dteFechaFinalEntradaInsumosEventosMercadotecnia =  '0000-00-00';
		}
		
		//Si no existe id del proveedor
		if(intEventoIDEntradaInsumosEventosMercadotecnia == '')
		{
			intEventoIDEntradaInsumosEventosMercadotecnia = 0;
		}


		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_entrada_insumos_eventos_mercadotecnia').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_entrada_insumos_eventos_mercadotecnia').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_entrada_insumos_eventos_mercadotecnia').val('NO');
		}

		//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
     	window.open("mercadotecnia/entrada_insumos_eventos/get_xls/"+dteFechaInicialEntradaInsumosEventosMercadotecnia+"/"
			+dteFechaFinalEntradaInsumosEventosMercadotecnia+"/"
			+intEventoIDEntradaInsumosEventosMercadotecnia+"/"
			+$('#chbImprimirDetalles_entrada_insumos_eventos_mercadotecnia').val());
	}

	//Función para mostrar mensaje de éxito o error
	function mensaje_entrada_insumos_eventos_mercadotecnia(tipoMensaje, mensaje)
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
		else if(tipoMensaje == 'informacion'){
			//Indicar al usuario el mensaje de advertencia
			new $.Zebra_Dialog(mensaje, 
							  {'type': 'information',
							   'title': 'Información'
				    		  });

		}else
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

	//Controles o Eventos del Modal
	$(document).ready(function() 
	{

		/*******************************************************************************************************************
		Controles correspondientes al modal
		*********************************************************************************************************************/
		//Agregar datepicker para seleccionar fecha
		$('#dteFecha_entrada_insumos_eventos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFecha_entrada_insumos_eventos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY',
		 																   useCurrent: false});

		/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
    	 * por ejemplo: 1800 será 1,800.00*/
    	$('.moneda_entrada_insumos_eventos_mercadotecnia').blur(function(){
			$('.moneda_entrada_insumos_eventos_mercadotecnia').formatCurrency({ roundToDecimalPlace: 6 });
		});
			
		//Autocomplete para recuperar los datos de un responsable (empleado)
        $('#txtSalida_entrada_insumos_eventos_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtSalidaID_entrada_insumos_eventos_mercadotecnia').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "mercadotecnia/entrada_insumos_eventos/autocomplete",
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

           		  $('#txtSalidaID_entrada_insumos_eventos_mercadotecnia').val(ui.item.data);	
           		  //Obtener SalidaInsumos y Evento
           		  $.post('mercadotecnia/entrada_insumos_eventos/get_salida_evento',
	              { 
	              	intSalidaInsumoID:$("#txtSalidaID_entrada_insumos_eventos_mercadotecnia").val()
	              },
	              function(data) {

			            $('#txtSalida_entrada_insumos_eventos_mercadotecnia').val(data.row.folio); 
			            $('#txtEventoID_entrada_insumos_eventos_mercadotecnia').val(data.row.evento_id);
			            $('#txtEvento_entrada_insumos_eventos_mercadotecnia').val(data.row.evento); 

	              }, 'json');


	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('mercadotecnia/entrada_insumos_eventos/verificar_salida',
	              { 
	              	intMovimientoInsumoID:$("#txtSalidaID_entrada_insumos_eventos_mercadotecnia").val()
	              },
	              function(data) {

	              	console.log(data);
	              	//Limpiar detalles del GRID en caso de que ya se encuentre cargada una salida
	               //Datagrid detalles
				   $('#dg_detalles_entrada_insumos_eventos_mercadotecnia tbody').empty();
				   $('#acumSalida_detalles_entrada_insumos_eventos_mercadotecnia').html('0.00');
				   $('#acumEntrada_detalles_entrada_insumos_eventos_mercadotecnia').html('0.00');
				   $('#acumImporte_detalles_entrada_insumos_eventos_mercadotecnia').html('$0.00');
				   $('#acumSubtotal_detalles_entrada_insumos_eventos_mercadotecnia').html('$0.00');
				   $('#numElementos_detalles_entrada_insumos_eventos_mercadotecnia').html(0);	

	               
	              	//Verificar si el movimiento de salida a evento ya fue utilizado
	              	if(data.id != null){
	              		
	              		console.log('El movimiento de salida ya fue utilizado' + data.id.movimiento_insumo_id);
	              		//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_entrada_insumos_eventos_mercadotecnia('informacion', 'La salida de insumos a evento seleccionada ya forma parte de un movimiento previamente registrado. A continuación se cargará para que pueda editarlo.');
						
	              		$.post('mercadotecnia/entrada_insumos_eventos/get_datos',
			            { 
			              	intMovimientoInsumoID: data.id.movimiento_insumo_id
			            },
			            	function(data) {
			            		
			            		console.log(data);

			            		if(data.row){
	  							   
	  							   //Cargar detalles del movimiento (Modo Edición)
	  							   $('#txtEntradaInsumosEventosID_entrada_insumos_eventos_mercadotecnia').val(data.row.movimiento_insumo_id);
	  							   $('#txtFolio_entrada_insumos_eventos_mercadotecnia').val(data.row.folio);
	  							   $('#txtFecha_entrada_insumos_eventos_mercadotecnia').val(data.row.fecha);
	  							   $('#txtObservaciones_entrada_insumos_eventos_mercadotecnia').val(data.row.observaciones);
				                   //Cargar los detalles correspondientes al movimiento
					                if(data.detalles){
					                	for (var intCon in data.detalles) 
							            {
							            	//Obtenemos el objeto de la tabla
											var objTabla = document.getElementById('dg_detalles_entrada_insumos_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

											//Insertamos el renglón con sus celdas en el objeto de la tabla
											var objRenglon = objTabla.insertRow();
											var objCeldaInsumo = objRenglon.insertCell(0);
											var objCeldaSalida = objRenglon.insertCell(1);
											var objCeldaEntrada = objRenglon.insertCell(2);
											var objCeldaImporte = objRenglon.insertCell(3);
											var objCeldaSubtotal = objRenglon.insertCell(4);
											var objCeldaAcciones = objRenglon.insertCell(5);

											//Variables que se utilizan para asignar valores del detalle
											var intInsumo = data.detalles[intCon].insumo_id;
											var strInsumo = data.detalles[intCon].descripcion;
											var intImporte = parseFloat(data.detalles[intCon].precio_unitario);
											var intEntrada =  parseFloat(data.detalles[intCon].entrada);
											var intSalida =  parseFloat(data.detalles[intCon].salida);
											
											var intSubtotal = 0;

											//Calcular subtotal
											intSubtotal = intEntrada * intImporte;
											
											//Asignar valores
											objRenglon.setAttribute('class', 'movil');
											objRenglon.setAttribute('id', intInsumo);
											objCeldaInsumo.setAttribute('class', 'movil b1');
											objCeldaInsumo.innerHTML = strInsumo;
											objCeldaSalida.setAttribute('class', 'movil b2');
											objCeldaSalida.innerHTML = formatMoney(intSalida, 2, '');
											objCeldaEntrada.setAttribute('class', 'movil b2');
											objCeldaEntrada.innerHTML = formatMoney(intEntrada, 2, '');;
											objCeldaImporte.setAttribute('class', 'movil b3');
											objCeldaImporte.innerHTML = formatMoney(intImporte, 6, '');
											objCeldaSubtotal.setAttribute('class', 'movil b4');
											objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 6, '');
											objCeldaAcciones.setAttribute('class', 'td-center movil b5');
											objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
																		 " onclick='editar_renglon_detalles_entrada_insumos_eventos_mercadotecnia(this)'>" + 
																		 "<span class='glyphicon glyphicon-edit'></span></button>";

							            }

							            //Hacer un llamado a la función para calcular totales de la tabla
										calcular_totales_detalles_entrada_insumos_eventos_mercadotecnia();
										//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
										var intFilas = $("#dg_detalles_entrada_insumos_eventos_mercadotecnia tr").length - 2;
										$('#numElementos_detalles_entrada_insumos_eventos_mercadotecnia').html(intFilas);
										$('#txtNumDetalles_entrada_insumos_eventos_mercadotecnia').val(intFilas);

					                }
					                

				                }

			            	}
			             ,
			            'json');
              	}
              	else{
              		
              		console.log('El movimiento de salida no ha sido utilizado');
              		$.post('mercadotecnia/salida_insumos_eventos/get_datos',
		            { 
		              	intMovimientoInsumoID:$("#txtSalidaID_entrada_insumos_eventos_mercadotecnia").val()
		            },
		            	function(data) {
		              	 	
		              	 	console.log(data);

		              	 	if(data.row){

			                   //Cargar los detalles correspondientes al movimiento
				                if(data.detalles){
				                	for (var intCon in data.detalles) 
						            {
						            	//Obtenemos el objeto de la tabla
										var objTabla = document.getElementById('dg_detalles_entrada_insumos_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

										//Insertamos el renglón con sus celdas en el objeto de la tabla
										var objRenglon = objTabla.insertRow();
										var objCeldaInsumo = objRenglon.insertCell(0);
										var objCeldaSalida = objRenglon.insertCell(1);
										var objCeldaEntrada = objRenglon.insertCell(2);
										var objCeldaImporte = objRenglon.insertCell(3);
										var objCeldaSubtotal = objRenglon.insertCell(4);
										var objCeldaAcciones = objRenglon.insertCell(5);

										//Variables que se utilizan para asignar valores del detalle
										var intInsumo = data.detalles[intCon].insumo_id;
										var strInsumo = data.detalles[intCon].descripcion;
										var intImporte = parseFloat(data.detalles[intCon].precio_unitario);
										var intCantidad =  parseFloat(data.detalles[intCon].cantidad);
										var intSalida = 0;
										
										var intSubtotal = 0;

										//Calcular subtotal
										intSubtotal = intSalida * intImporte;
										
										//Asignar valores
										objRenglon.setAttribute('class', 'movil');
										objRenglon.setAttribute('id', intInsumo);
										objCeldaInsumo.setAttribute('class', 'movil b1');
										objCeldaInsumo.innerHTML = strInsumo;
										objCeldaSalida.setAttribute('class', 'movil b2');
										objCeldaSalida.innerHTML = formatMoney(intCantidad, 2, '');
										objCeldaEntrada.setAttribute('class', 'movil b2');
										objCeldaEntrada.innerHTML = formatMoney(0, 2, '');;
										objCeldaImporte.setAttribute('class', 'movil b3');
										objCeldaImporte.innerHTML = formatMoney(intImporte, 6, '');
										objCeldaSubtotal.setAttribute('class', 'movil b4');
										objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 6, '');
										objCeldaAcciones.setAttribute('class', 'td-center movil b5');
										objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
																	 " onclick='editar_renglon_detalles_entrada_insumos_eventos_mercadotecnia(this)'>" + 
																	 "<span class='glyphicon glyphicon-edit'></span></button>";

						            }

						            //Hacer un llamado a la función para calcular totales de la tabla
									calcular_totales_detalles_entrada_insumos_eventos_mercadotecnia();
									//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
									var intFilas = $("#dg_detalles_entrada_insumos_eventos_mercadotecnia tr").length - 2;
									$('#numElementos_detalles_entrada_insumos_eventos_mercadotecnia').html(intFilas);
									$('#txtNumDetalles_entrada_insumos_eventos_mercadotecnia').val(intFilas);

				                }   

			                }
			           
		              	}
		             ,
		            'json');

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


		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_entrada_insumos_eventos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_entrada_insumos_eventos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_entrada_insumos_eventos_mercadotecnia').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_entrada_insumos_eventos_mercadotecnia').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_entrada_insumos_eventos_mercadotecnia').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_entrada_insumos_eventos_mercadotecnia').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_entrada_insumos_eventos_mercadotecnia').on('click','a',function(event){
			event.preventDefault();
			intPaginaEntradaInsumosEventosMercadotecnia = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_entrada_insumos_eventos_mercadotecnia();
		});

		//Autocomplete para recuperar los datos de un evento 
        $('#txtEventoBusq_entrada_insumos_eventos_mercadotecnia').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtEventoBusqID_entrada_insumos_eventos_mercadotecnia').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "mercadotecnia/eventos/autocomplete",
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
             $('#txtEventoBusqID_entrada_insumos_eventos_mercadotecnia').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('mercadotecnia/eventos/get_datos',
                  { 
                  	intEventoID:$("#txtEventoBusqID_entrada_insumos_eventos_mercadotecnia").val()
                  },
                  function(data) {
                    if(data.row){
                       $("#txtEventoBusqID_entrada_insumos_eventos_mercadotecnia").val(data.row.evento_id);
                       $("#txtEventoBusq_entrada_insumos_eventos_mercadotecnia").val(data.row.descripcion);
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

        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_entrada_insumos_eventos_mercadotecnia').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_entrada_insumos_eventos_mercadotecnia();
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_entrada_insumos_eventos_mercadotecnia').addClass("estatus-NUEVO");
			//Abrir modal
			 objEntradaInsumosEventosMercadotecnia = $('#EntradaInsumosEventosMercadotecniaBox').bPopup({
										   appendTo: '#EntradaInsumosEventosMercadotecniaContent', 
			                               contentContainer: 'EntradaInsumosEventosMercadotecniaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});
			
		});


		//Enfocar caja de texto
		$('#txtBusqueda_entrada_insumos_eventos_mercadotecnia').focus();
		//Deshabilitar los siguientes botones (funciones de permisos de acceso)
		$('#btnNuevo_entrada_insumos_eventos_mercadotecnia').attr('disabled','-1');  
		$('#btnImprimir_entrada_insumos_eventos_mercadotecnia').attr('disabled','-1');
		$('#btnDescargarXLS_entrada_insumos_eventos_mercadotecnia').attr('disabled','-1');
		$('#btnBuscar_entrada_insumos_eventos_mercadotecnia').attr('disabled','-1');
		$('#btnGuardar_entrada_insumos_eventos_mercadotecnia').attr('disabled','-1');
		$('#btnImprimirRegistro_entrada_insumos_eventos_mercadotecnia').attr('disabled','-1');
		$('#btnDesactivar_entrada_insumos_eventos_mercadotecnia').attr('disabled','-1');
		$('#btnRestaurar_entrada_insumos_eventos_mercadotecnia').attr('disabled','-1');   	
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_entrada_insumos_eventos_mercadotecnia();

	});

</script>				