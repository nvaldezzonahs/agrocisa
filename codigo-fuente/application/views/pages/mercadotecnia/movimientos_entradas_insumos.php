
	<div id="MovimientosInsumosMercadotecniaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_movimientos_entradas_insumos_mercadotecnia" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_movimientos_entradas_insumos_mercadotecnia">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_movimientos_entradas_insumos_mercadotecnia'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_movimientos_entradas_insumos_mercadotecnia"
				                    		name= "strFechaInicialBusq_movimientos_entradas_insumos_mercadotecnia" 
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
								<label for="txtFechaFinalBusq_movimientos_entradas_insumos_mercadotecnia">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_movimientos_entradas_insumos_mercadotecnia'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_movimientos_entradas_insumos_mercadotecnia"
				                    		name= "strFechaFinalBusq_movimientos_entradas_insumos_mercadotecnia" 
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
								<label for="txtProveedorBusq_movimientos_entradas_insumos_mercadotecnia">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtProveedorBusqID_movimientos_entradas_insumos_mercadotecnia" 
										name="strProveedorBusqID_movimientos_entradas_insumos_mercadotecnia" 
										type="hidden">
								<input  class="form-control" 
										id="txtProveedorBusq_movimientos_entradas_insumos_mercadotecnia" 
										name="strProveedorBusq_movimientos_entradas_insumos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese Proveedor">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!-- Buscar registros -->
							<button class="btn btn-primary" id="btnBuscar_movimientos_entradas_insumos_mercadotecnia"
									onclick="paginacion_movimientos_entradas_insumos_mercadotecnia();" 
									title="Buscar coincidencias" tabindex="1"> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_movimientos_entradas_insumos_mercadotecnia" 
									title="Nuevo registro" tabindex="1"> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_movimientos_entradas_insumos_mercadotecnia"
									onclick="reporte_movimientos_entradas_insumos_mercadotecnia();" title="Generar reporte PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_movimientos_entradas_insumos_mercadotecnia"
									onclick="descargar_xls_movimientos_entradas_insumos_mercadotecnia();" title="Descargar archivo XLS" tabindex="1">
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
	                        			id="chbImprimirDetalles_movimientos_entradas_insumos_mercadotecnia" 
									   	name="strImprimirDetalles_movimientos_entradas_insumos_mercadotecnia" 
									   	type="checkbox"
									   	value="" 
									   	tabindex="1">
								</input>
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
				td.movil:nth-of-type(3):before {content: "Proveedor"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_movimientos_entradas_insumos_mercadotecnia">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Proveedor</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_movimientos_entradas_insumos_mercadotecnia" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{folio}}</td>
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{proveedor}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_movimientos_entradas_insumos_mercadotecnia({{movimiento_insumo_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_movimientos_entradas_insumos_mercadotecnia({{movimiento_insumo_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_entradas_insumos_mercadotecnia({{movimiento_insumo_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Descargar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivo_movimientos_entradas_insumos_mercadotecnia({{movimiento_insumo_id}}, {{proveedor_id}});" title="Descargar archivo">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_movimientos_entradas_insumos_mercadotecnia({{movimiento_insumo_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<!--
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_movimientos_entradas_insumos_mercadotecnia({{movimiento_insumo_id}},'{{estatus}}')"  title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
								-->
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_entradas_insumos_mercadotecnia"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_movimientos_entradas_insumos_mercadotecnia">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="MovimientosInsumosMercadotecniaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_movimientos_entradas_insumos_mercadotecnia"  class="ModalBodyTitle">
			<h1>Entradas de Insumos por Compra</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMovimientosInsumosMercadotecnia" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMovimientosInsumosMercadotecnia"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!-- Folio -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtEntradaInsumoID_movimientos_entradas_insumos_mercadotecnia" 
										   name="intEntradaInsumoID_movimientos_entradas_insumos_mercadotecnia" 
										   type="hidden" 
										   value="" />
									<input id="txtFolioID_movimientos_entradas_insumos_mercadotecnia" 
										   name="intFolioID_movimientos_entradas_insumos_mercadotecnia" 
										   type="hidden" 
										   value=""/>
									<label for="txtFolio_movimientos_entradas_insumos_mercadotecnia">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_movimientos_entradas_insumos_mercadotecnia" 
											name="strFolio_movimientos_entradas_insumos_mercadotecnia" 
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
									<label for="txtFecha_movimientos_entradas_insumos_mercadotecnia">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_movimientos_entradas_insumos_mercadotecnia'>
					                    <input class="form-control" 
					                    		id="txtFecha_movimientos_entradas_insumos_mercadotecnia"
					                    		name= "strFecha_movimientos_entradas_insumos_mercadotecnia" 
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
						<!-- Moneda -->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbMonedaID_movimientos_entradas_insumos_mercadotecnia">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbMonedaID_movimientos_entradas_insumos_mercadotecnia" 
									 		name="intMonedaID_movimientos_entradas_insumos_mercadotecnia" 
									 		tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_movimientos_entradas_insumos_mercadotecnia">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_movimientos_entradas_insumos_mercadotecnia" 
											id="txtTipoCambio_movimientos_entradas_insumos_mercadotecnia" 
											name="intTipoCambio_movimientos_entradas_insumos_mercadotecnia" 
											type="text" 
											value="" 
											tabindex="1" 
											placeholder="Ingrese tipo de cambio"
											maxlength="11"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- Orden de compra -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtOrdenCompraID_movimientos_entradas_insumos_mercadotecnia" 
											name="intOrdenCompraID_movimientos_entradas_insumos_mercadotecnia" 
											type="hidden" />
									<label for="txtOrdenCompra_movimientos_entradas_insumos_mercadotecnia">Orden de compra</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtOrdenCompra_movimientos_entradas_insumos_mercadotecnia" 
											name="strOrdenCompra_movimientos_entradas_insumos_mercadotecnia" 
											type="text" 
											value="" 
											tabindex="1" 
											placeholder="Ingrese orden" 
											maxlength="10" />
								</div>
							</div>	
						</div>
						<!-- Proveedor -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtProveedorID_movimientos_entradas_insumos_mercadotecnia" 
											name="intProveedorID_movimientos_entradas_insumos_mercadotecnia" 
											type="hidden" />
									<label for="txtProveedor_movimientos_entradas_insumos_mercadotecnia">Proveedor</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtProveedor_movimientos_entradas_insumos_mercadotecnia" 
											name="strProveedor_movimientos_entradas_insumos_mercadotecnia" 
											type="text" 
											value="" 
											tabindex="1" 
											placeholder="Ingrese proveedor" 
											maxlength="50" />
								</div>
							</div>
						</div>
						<!-- Factura -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFactura_movimientos_entradas_insumos_mercadotecnia">Factura</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtFactura_movimientos_entradas_insumos_mercadotecnia" 
											name="strFactura_movimientos_entradas_insumos_mercadotecnia" 
											type="text" 
											value="" 
											tabindex="1" 
											placeholder="Ingrese factura" 
											maxlength="50" />
								</div>
							</div>	
						</div>
						<!-- Total de unidades -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTotalUnidades_movimientos_entradas_insumos_mercadotecnia">Total de unidades</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control cantidad_movimientos_entradas_insumos_mercadotecnia" 
											id="txtTotalUnidades_movimientos_entradas_insumos_mercadotecnia" 
											name="intTotalUnidades_movimientos_entradas_insumos_mercadotecnia" 
											type="text" 
											value="" 
											tabindex="1" 
											placeholder="Ingrese unidades" 
											maxlength="50" />
								</div>
							</div>	
						</div>
						<!-- Importe total -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteTotal_movimientos_entradas_insumos_mercadotecnia">Importe total</label>
								</div>	
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_movimientos_entradas_insumos_mercadotecnia" 
											id="txtImporteTotal_movimientos_entradas_insumos_mercadotecnia" 
											name="intImporteTotal_movimientos_entradas_insumos_mercadotecnia" 
											type="text" 
											value="" 
											tabindex="1" 
											placeholder="Ingrese importe" 
											maxlength="23" />
									</div>		
								</div>
							</div>	
						</div>
					</div>
					<div class="row">
						<!-- Observaciones -->
						<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_movimientos_entradas_insumos_mercadotecnia">Observaciones</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtObservaciones_movimientos_entradas_insumos_mercadotecnia" 
											name="strObservaciones_movimientos_entradas_insumos_mercadotecnia" 
											type="text" 
											value="" 
											tabindex="1" 
											placeholder="Ingrese observaciones" 
											maxlength="250" />			
								</div>
							</div>
						</div>
						<!-- Cargar XML / Botón agregar-->
                      	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
                      		<div class="form-group">
                      			<div class="col-md-12">
                      				<input type="file" 
                      						id="fileXML_movimientos_entradas_insumos_mercadotecnia"
                      						name="fileXML_movimientos_entradas_insumos_mercadotecnia" 
                      						style="display:none"
                      						accept="text/xml" 
                      						onchange="cargar_xml_modal_movimientos_entradas_insumos_mercadotecnia(this.files)">
                      				<input  id="txtXML_movimientos_entradas_insumos_mercadotecnia" 
											name="strXML_movimientos_entradas_insumos_mercadotecnia" 
											type="text" style="display: none" />		
                      				<button id="btnXML_movimientos_entradas_insumos_mercadotecnia" 
                      						class="btn btn-default btn-toolBtns pull-right" 
                      						type="button" 
                      						onclick="cargar_xml_movimientos_entradas_insumos_mercadotecnia();">Cargar XML</button>
                      			</div>	
							</div>
                     	</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
									<input id="txtNumDetalles_movimientos_entradas_insumos_mercadotecnia" 
								   		name="intNumDetalles_movimientos_entradas_insumos_mercadotecnia" type="hidden" value="">

									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la entrada por compra</h4>
										</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
													<div class="row">
														<!--Insumo-->
														<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
															<div class="form-group">
																<div class="col-md-12">
																	<input  class="form-control" 
																			id="txtInsumoID_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			name="inttInsumoID_detalles_movimientos_entradas_insumos_mercadotecnia"
																			type="hidden" />
																	<label for="txtInsumo_detalles_movimientos_entradas_insumos_mercadotecniar">
																		Insumo
																	</label>
																</div>
																<div class="col-md-12">
																	<input  class="form-control" 
																			id="txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			name="strInsumo_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			type="text" 
																			value="" 
																			tabindex="1" 
																			placeholder="Ingrese insumo" 
																			maxlength="250" />
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<!--Cantidad-->
														<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
															<div class="form-group">
																<div class="col-md-12">
																	<label for="txtCantidad_detalles_movimientos_entradas_insumos_mercadotecnia">
																		Cantidad
																	</label>
																</div>
																<div class="col-md-12">
																	<input  class="form-control cantidad_movimientos_entradas_insumos_mercadotecnia" 
																			id="txtCantidad_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			name="intCantidad_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			type="text"
																			value="" 
																			tabindex="1"
																			placeholder="Ingrese cantidad" 
																			maxlength="14" />
																</div>
															</div>
														</div>
														<!--Precio unitario-->
														<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
															<div class="form-group">
																<div class="col-md-12">
																	<label for="txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia">Precio unitario</label>
																</div>
																<div class="col-md-12">
																	<input  class="form-control moneda_movimientos_entradas_insumos_mercadotecnia" 
																			id="txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			name="intPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			type="text" 
																			value="" 
																			tabindex="1" 
																			placeholder="Ingrese precio unitario" 
																			maxlength="23" />
																</div>
															</div>
														</div>
														<!--Porcentaje del descuento-->
														<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
															<div class="form-group">
																<div class="col-md-12">
																	<label for="txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia">Descuento %</label>
																</div>
																<div class="col-md-12">
																	<input  class="form-control cantidad_movimientos_entradas_insumos_mercadotecnia" 
																			id="txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			name="intPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			type="text" 
																			value="" 
																			tabindex="1" 
																			placeholder="Ingrese descuento" 
																			maxlength="8" />
																</div>
															</div>
														</div>
														<!--Porcentaje del IVA-->
														<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
															<div class="form-group">
																<div class="col-md-12">
																	<label for="txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia">IVA %</label>
																</div>
																<div class="col-md-12">
																	<input  class="form-control cantidad_movimientos_entradas_insumos_mercadotecnia" 
																			id="txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			name="intPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			type="text" 
																			value="" 
																			tabindex="1" 
																			placeholder="Ingrese IVA" 
																			maxlength="8" />
																</div>
															</div>
														</div>
														<!--Porcentaje del IEPS-->
														<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
															<div class="form-group">
																<div class="col-md-12">
																	<label for="txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia">IEPS %</label>
																</div>
																<div class="col-md-12">
																	<input  class="form-control cantidad_movimientos_entradas_insumos_mercadotecnia" 
																			id="txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			name="intPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia" 
																			type="text" value="" 
																			tabindex="1" 
																			placeholder="Ingrese IEPS" 
																			maxlength="8" />
																</div>
															</div>
														</div>
														<!--Botón agregar-->
						                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
						                                	<button class="btn btn-primary btn-toolBtns pull-right" 
						                                			id="btnAgregar_movimientos_entradas_insumos_mercadotecnia" 
						                                			onclick="agregar_renglon_detalles_movimientos_entradas_insumos_mercadotecnia();" 
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
														<table class="table-hover movil" id="dg_detalles_movimientos_entradas_insumos_mercadotecnia">
															<thead class="movil">
																<tr class="movil">
																	<th class="movil">Insumo</th>
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
																	<td  class="movil t2">
																		<strong id="acumCantidad_detalles_movimientos_entradas_insumos_mercadotecnia">0</strong>
																	</td>
																	<td class="movil t3" colspan="1"></td>
																	<td class="movil t4">
																		<strong id="acumDescuento_detalles_movimientos_entradas_insumos_mercadotecnia">$0.00</strong>
																	</td>
																	<td class="movil t5">
																		<strong id="acumSubtotal_detalles_movimientos_entradas_insumos_mercadotecnia">$0.00</strong>
																	</td>
																	<td class="movil t6">
																		<strong id="acumIva_detalles_movimientos_entradas_insumos_mercadotecnia">$0.00</strong>
																	</td>
																	<td class="movil t7">
																		<strong  id="acumIeps_detalles_movimientos_entradas_insumos_mercadotecnia">$0.00</strong>
																	</td>
																	<td class="movil t8">
																		<strong id="acumTotal_detalles_movimientos_entradas_insumos_mercadotecnia">$0.00</strong>
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
																	<strong id="numElementos_detalles_movimientos_entradas_insumos_mercadotecnia">0</strong> encontrados
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
							<button class="btn btn-info" id="btnReset_movimientos_entradas_insumos_mercadotecnia"  
									onclick="nuevo_movimientos_entradas_insumos_mercadotecnia('Nuevo');"  title="Nuevo registro" tabindex="2">
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_movimientos_entradas_insumos_mercadotecnia"  
									onclick="validar_movimientos_entradas_insumos_mercadotecnia();"  title="Guardar" tabindex="2">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_movimientos_entradas_insumos_mercadotecnia"  
									onclick="reporte_registro_entradas_insumos_mercadotecnia('');"  
									title="Imprimir" tabindex="5">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_movimientos_entradas_insumos_mercadotecnia"  
									onclick="descargar_archivo_movimientos_entradas_insumos_mercadotecnia('','');"  title="Descargar archivo" tabindex="5">
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_movimientos_entradas_insumos_mercadotecnia"  
									onclick="cambiar_estatus_movimientos_entradas_insumos_mercadotecnia('','ACTIVO');"  title="Desactivar" tabindex="6">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_movimientos_entradas_insumos_mercadotecnia"
									type="reset" aria-hidden="true" onclick="cerrar_movimientos_entradas_insumos_mercadotecnia();" 
									title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MovimientosInsumosMercadotecniaContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_movimientos_entradas_insumos_mercadotecnia" type="text/template">
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
		var intPaginaMovimientosInsumosMercadotecnia = 0;
		var strUltimaBusquedaMovimientosInsumosMercadotecnia = "";
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDMovimientosInsumosMercadotecnia = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseMovimientosInsumosMercadotecnia = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoMovimientosInsumosMercadotecnia = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variables que se utilizan para la búsqueda de registros
		var intProveedorIDMovimientosInsumosMercadotecnia = "";
		var dteFechaInicialMovimientosInsumosMercadotecnia = "";
		var dteFechaFinalMovimientosInsumosMercadotecnia = "";
		//Variable que se utiliza para asignar objeto del modal
		var objMovimientosInsumosMercadotecnia = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_movimientos_entradas_insumos_mercadotecnia()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('mercadotecnia/movimientos_entradas_insumos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_movimientos_entradas_insumos_mercadotecnia').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMovimientosInsumosMercadotecnia = data.row;
					//Separar la cadena 
					var arrPermisosMovimientosInsumosMercadotecnia = strPermisosMovimientosInsumosMercadotecnia.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMovimientosInsumosMercadotecnia.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMovimientosInsumosMercadotecnia[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_movimientos_entradas_insumos_mercadotecnia').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMovimientosInsumosMercadotecnia[i]=='GUARDAR') || (arrPermisosMovimientosInsumosMercadotecnia[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_movimientos_entradas_insumos_mercadotecnia').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosMovimientosInsumosMercadotecnia[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_movimientos_entradas_insumos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosInsumosMercadotecnia[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_movimientos_entradas_insumos_mercadotecnia').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_movimientos_entradas_insumos_mercadotecnia();
						}
						else if(arrPermisosMovimientosInsumosMercadotecnia[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_movimientos_entradas_insumos_mercadotecnia').removeAttr('disabled');
							$('#btnRestaurar_movimientos_entradas_insumos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosInsumosMercadotecnia[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_movimientos_entradas_insumos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosInsumosMercadotecnia[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_movimientos_entradas_insumos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosInsumosMercadotecnia[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_movimientos_entradas_insumos_mercadotecnia').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_movimientos_entradas_insumos_mercadotecnia() 
		{
			//Asignar valores para la búsqueda de registros
			var dteFechaInicialMovEntradasInsumosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_insumos_mercadotecnia').val());
			var dteFechaFinalMovEntradasInsumosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_insumos_mercadotecnia').val());
			//var intProveedorIDMovEntradasInsumosMercadotecnia = $('#txtProveedorBusqID_movimientos_entradas_insumos_mercadotecnia').val();
			//Si no existe fecha inicial
			if(dteFechaInicialMovEntradasInsumosMercadotecnia == '')
			{
				dteFechaInicialMovEntradasInsumosMercadotecnia = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalMovEntradasInsumosMercadotecnia == '')
			{
				dteFechaFinalMovEntradasInsumosMercadotecnia =  '0000-00-00';
			}
			//Si no existe id del proveedor en busqueda
			if( $('#txtProveedorBusqID_movimientos_entradas_insumos_mercadotecnia').val() == '' || 
				$('#txtProveedorBusq_movimientos_entradas_insumos_mercadotecnia').val() == ''
			  )
			{
				intProveedorIDMovEntradasInsumosMercadotecnia = 0;
			}
			else{
				intProveedorIDMovEntradasInsumosMercadotecnia = $('#txtProveedorBusqID_movimientos_entradas_insumos_mercadotecnia').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('mercadotecnia/movimientos_entradas_insumos/get_paginacion',
					{	dteFechaInicial: dteFechaInicialMovEntradasInsumosMercadotecnia,
		    			dteFechaFinal: dteFechaFinalMovEntradasInsumosMercadotecnia,
		    			intProveedorID: intProveedorIDMovEntradasInsumosMercadotecnia,
						intTipoMovimiento: 1,
						intPagina:intPaginaMovimientosInsumosMercadotecnia,
						strPermisosAcceso: $('#txtAcciones_movimientos_entradas_insumos_mercadotecnia').val()
					},
					function(data){

						$('#dg_movimientos_entradas_insumos_mercadotecnia tbody').empty();
						var tmpMovimientosInsumosMercadotecnia = Mustache.render($('#plantilla_movimientos_entradas_insumos_mercadotecnia').html(),data);
						$('#dg_movimientos_entradas_insumos_mercadotecnia tbody').html(tmpMovimientosInsumosMercadotecnia);
						$('#pagLinks_movimientos_entradas_insumos_mercadotecnia').html(data.paginacion);
						$('#numElementos_movimientos_entradas_insumos_mercadotecnia').html(data.total_rows);
						intPaginaMovimientosInsumosMercadotecnia = data.pagina;
					},
			'json');
		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_movimientos_entradas_insumos_mercadotecnia()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').empty();
					var temp = Mustache.render($('#monedas_movimientos_entradas_insumos_mercadotecnia').html(), data);
					$('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').html(temp);
				},
				'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_movimientos_entradas_insumos_mercadotecnia() 
		{
			//Asignar valores para la búsqueda de registros
			intProveedorIDMovimientosInsumosMercadotecnia =  $('#txtProveedorBusqID_movimientos_entradas_insumos_mercadotecnia').val();
			dteFechaInicialMovimientosInsumosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_insumos_mercadotecnia').val());
			dteFechaFinalMovimientosInsumosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_insumos_mercadotecnia').val());

			//Si no existe fecha inicial
			if(dteFechaInicialMovimientosInsumosMercadotecnia == '')
			{
				dteFechaInicialMovimientosInsumosMercadotecnia = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalMovimientosInsumosMercadotecnia == '')
			{
				dteFechaFinalMovimientosInsumosMercadotecnia =  '0000-00-00';
			}
			
			//Si no existe id del proveedor
			if(intProveedorIDMovimientosInsumosMercadotecnia == '')
			{
				intProveedorIDMovimientosInsumosMercadotecnia = 0;
			}


			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_movimientos_entradas_insumos_mercadotecnia').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_movimientos_entradas_insumos_mercadotecnia').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_movimientos_entradas_insumos_mercadotecnia').val('NO');
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("mercadotecnia/movimientos_entradas_insumos/get_reporte/"+dteFechaInicialMovimientosInsumosMercadotecnia+"/"+dteFechaFinalMovimientosInsumosMercadotecnia+"/"+intProveedorIDMovimientosInsumosMercadotecnia+"/"+$('#chbImprimirDetalles_movimientos_entradas_insumos_mercadotecnia').val());
		}

		//Función para descargar el archivo XLS
		function descargar_xls_movimientos_entradas_insumos_mercadotecnia() 
		{
			//Asignar valores para la búsqueda de registros
			intProveedorIDMovimientosInsumosMercadotecnia =  $('#txtProveedorIDBusq_movimientos_entradas_insumos_mercadotecnia').val();
			dteFechaInicialMovimientosInsumosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_insumos_mercadotecnia').val());
			dteFechaFinalMovimientosInsumosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_insumos_mercadotecnia').val());

			//Si no existe fecha inicial
			if(dteFechaInicialMovimientosInsumosMercadotecnia == '')
			{
				dteFechaInicialMovimientosInsumosMercadotecnia = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalMovimientosInsumosMercadotecnia == '')
			{
				dteFechaFinalMovimientosInsumosMercadotecnia =  '0000-00-00';
			}
			
			//Si no existe id del proveedor
			if(intProveedorIDMovimientosInsumosMercadotecnia == '')
			{
				intProveedorIDMovimientosInsumosMercadotecnia = 0;
			}

			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_movimientos_entradas_insumos_mercadotecnia').is(':checked')) {
			    //Asignar SI para incluir detalles en el archivo
			    $('#chbImprimirDetalles_movimientos_entradas_insumos_mercadotecnia').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el archivo
			   $('#chbImprimirDetalles_movimientos_entradas_insumos_mercadotecnia').val('NO');
			}

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("mercadotecnia/movimientos_entradas_insumos/get_xls/"+dteFechaInicialMovimientosInsumosMercadotecnia+"/"+dteFechaFinalMovimientosInsumosMercadotecnia+"/"+intProveedorIDMovimientosInsumosMercadotecnia+"/"+$('#chbImprimirDetalles_movimientos_entradas_insumos_mercadotecnia').val());
		}

		//Función que se utiliza para descargar el archivo del registro seleccionado
		function descargar_archivo_movimientos_entradas_insumos_mercadotecnia(movimientoInsumosID, proveedorID)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intMovimientoInsumosID = 0;
			var intProveedorID = 0;
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(movimientoInsumosID == '')
			{
				intMovimientoInsumosID = $('#txtEntradaInsumoID_movimientos_entradas_insumos_mercadotecnia').val();
				intProveedorID = $('#txtProveedorID_movimientos_entradas_insumos_mercadotecnia').val();
			}
			else
			{
				intMovimientoInsumosID = movimientoInsumosID;
				intProveedorID = proveedorID;
			}

			//Abrir pestaña para realizar descarga del documento
			window.open("mercadotecnia/movimientos_entradas_insumos/descargar_archivo/"+intProveedorID+"/"+intMovimientoInsumosID);
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_movimientos_entradas_insumos_mercadotecnia(tipoAccion)
		{
			//Incializar formulario
			$('#frmMovimientosInsumosMercadotecnia')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_entradas_insumos_mercadotecnia();
			//Limpiar cajas de texto ocultas
			$('#frmMovimientosInsumosMercadotecnia').find('input[type=hidden]').val('');
			
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_movimientos_entradas_insumos_mercadotecnia();	

			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_movimientos_entradas_insumos_mercadotecnia').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_movimientos_entradas_insumos_mercadotecnia').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_movimientos_entradas_insumos_mercadotecnia').removeClass("estatus-INACTIVO");
 			/******************************************************************
			* INICIALIZACIÓN DE ELEMENTOS - ESTADO DEFAULT
 			*******************************************************************/
			//Asignar la fecha actual
			$('#txtFecha_movimientos_entradas_insumos_mercadotecnia').val(fechaActual()); 
			//Si el tipo de acción corresponde a Nuevo
			if(tipoAccion == 'Nuevo')
			{
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_movimientos_entradas_insumos_mercadotecnia').addClass("estatus-NUEVO");
			}

			//Habilitar todos los elementos del formulario
			$('#frmMovimientosInsumosMercadotecnia').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_movimientos_entradas_insumos_mercadotecnia').attr("disabled", "disabled");
		    //Botón para agregar detalles
		    $('#btnAgregar_movimientos_entradas_insumos_mercadotecnia').attr('disabled', false);
			//Mostrar botón Guardar
			$("#btnGuardar_movimientos_entradas_insumos_mercadotecnia").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_movimientos_entradas_insumos_mercadotecnia").hide();
			$("#btnDescargarArchivo_movimientos_entradas_insumos_mercadotecnia").hide();
			$("#btnDesactivar_movimientos_entradas_insumos_mercadotecnia").hide();
			$("#btnRestaurar_movimientos_entradas_insumos_mercadotecnia").hide();

		}

		//Función para deshabilitar controles del formulario y así evitar modificar datos correspondientes al XML u orden de compra
		function deshabilitar_controles_movimientos_entradas_insumos_mercadotecnia()
		{
			//Deshabilitar los siguientes controles
			$('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
			$('#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
			$('#txtOrdenCompra_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
			$('#txtProveedor_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
			$('#txtFactura_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
			$('#btnAgregar_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
			
			$('#txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
			$('#txtCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
			$('#txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
			$('#txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
			$('#txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
			$('#txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
		}

		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_movimientos_entradas_insumos_mercadotecnia()
		{
			//Eliminar los datos de la tabla detalles del movimiento
			$('#dg_detalles_movimientos_entradas_insumos_mercadotecnia tbody').empty();
			$('#acumCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').html(0);
		    $('#acumDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').html('$0.00');
		    $('#acumSubtotal_detalles_movimientos_entradas_insumos_mercadotecnia').html('$0.00');
		    $('#acumIva_detalles_movimientos_entradas_insumos_mercadotecnia').html('$0.00');
		    $('#acumIeps_detalles_movimientos_entradas_insumos_mercadotecnia').html('$0.00');
		    $('#acumTotal_detalles_movimientos_entradas_insumos_mercadotecnia').html('$0.00');
			$('#numElementos_detalles_movimientos_entradas_insumos_mercadotecnia').html(0);
			$('#txtNumDetalles_movimientos_entradas_insumos_mercadotecnia').html('');
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_movimientos_entradas_insumos_mercadotecnia()
		{
			try {
				//Cerrar modal
				objMovimientosInsumosMercadotecnia.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_movimientos_entradas_insumos_mercadotecnia').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_movimientos_entradas_insumos_mercadotecnia()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_entradas_insumos_mercadotecnia();
			//Validación del formulario de campos obligatorios
			$('#frmMovimientosInsumosMercadotecnia')
				.bootstrapValidator({
										excluded: [':disabled'],
									 	container: 'popover',
									 	feedbackIcons: {
									 		valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
									  	},
									  	fields: {
											strFecha_movimientos_entradas_insumos_mercadotecnia: {
												validators: {
													notEmpty: {message: 'Seleccione una fecha'}
												}
											},
											intMonedaID_movimientos_entradas_insumos_mercadotecnia: {
												validators: {
													notEmpty: {message: 'Seleccione una moneda'}
												}
											},
											intTipoCambio_movimientos_entradas_insumos_mercadotecnia: {
												excluded: false,  // No ignorar (permite validar campo deshabilitado)
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
							                                    //Verificar que exista el tipo de cambio cuando la moneda
							                                    //sea diferente del peso mexicano
							                                    if(parseInt($('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').val()) !== intMonedaBaseIDMovimientosInsumosMercadotecnia)
							                                    {
							                                    	if(value === '')
							                                    	{
							                                    		return {
							                                           	 valid: false,
							                                            	message: 'Escriba el tipo de cambio'
							                                        	};
							                                    	}
							                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
							                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoMovimientosInsumosMercadotecniaa)
							                                    	{
							                                    		return {
							                                              valid: false,
							                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoMovimientosInsumosMercadotecniaa
							                                          	};
							                                    	}
								                                      		
							                                    }
						                                    	return true;
						                                    }
						                                }
						                            }
											},
										    strOrdenCompra_movimientos_entradas_insumos_mercadotecnia: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la orden de compra
						                                    if( value !== '' &&  $('#txtOrdenCompraID_movimientos_entradas_insumos_mercadotecnia').val() === '')
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
											strProveedor_movimientos_entradas_insumos_mercadotecnia: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id del proveedor
						                                    if($('#txtProveedorID_movimientos_entradas_insumos_mercadotecnia').val() === '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba un proveedor existente'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
											strFactura_movimientos_entradas_insumos_mercadotecnia: {
												validators: {
													notEmpty: {message: 'Escriba una factura'}
												}
											},
											intTotalUnidades_movimientos_entradas_insumos_mercadotecnia: {
												validators: {
													notEmpty: {message: 'Escriba el total de unidades'}
												}
											},
											intImporteTotal_movimientos_entradas_insumos_mercadotecnia: {
												validators: {
													notEmpty: {message: 'Escriba el importe total'}
												}
											},
											intNumDetalles_movimientos_entradas_insumos_mercadotecnia: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id del código postal
						                                    if(parseInt(value) === 0 || value === '')
						                                    {
						                                    	return {
						                                            valid: false,
						                                            message: 'Agregar al menos un detalle para esta entrada de insumos por compra.'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
										    strObservaciones_movimientos_entradas_insumos_mercadotecnia: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    strInsumo_detalles_movimientos_entradas_insumos_mercadotecnia: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intCantidad_detalles_movimientos_entradas_insumos_mercadotecnia: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia: {
										        excluded: true  // Ignorar (no valida el campo)   
										    },
										    intPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia: {
										        excluded: true  // Ignorar (no valida el campo)    
										    }
										}
									});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_movimientos_entradas_insumos_mercadotecnia = $('#frmMovimientosInsumosMercadotecnia').data('bootstrapValidator');
			bootstrapValidator_movimientos_entradas_insumos_mercadotecnia.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_movimientos_entradas_insumos_mercadotecnia.isValid())
			{
				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesMovimientosInsumosMercadotecnia = $.reemplazar($('#acumTotal_detalles_movimientos_entradas_insumos_mercadotecnia').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesMovimientosInsumosMercadotecnia = $.reemplazar(intAcumTotalDetallesMovimientosInsumosMercadotecnia, ",", "");

				var intImporteTotalMovimientosInsumosMercadotecnia = $.reemplazar($('#txtImporteTotal_movimientos_entradas_insumos_mercadotecnia').val(), ",", "");
 
				//Verificar que el total de unidades sea igual a la cantidad de detalles
				if($('#acumCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').html() != $('#txtTotalUnidades_movimientos_entradas_insumos_mercadotecnia').val())
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_movimientos_entradas_insumos_mercadotecnia('error', 'El total de unidades no coincide con los detalles, favor de verificar.');
					
				}
				//Verificar que el importe total sea igual al total de detalles
				else if(intAcumTotalDetallesMovimientosInsumosMercadotecnia != intImporteTotalMovimientosInsumosMercadotecnia)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_movimientos_entradas_insumos_mercadotecnia('error', 'El importe total no coincide con los detalles, favor de verificar.');
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_movimientos_entradas_insumos_mercadotecnia();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_movimientos_entradas_insumos_mercadotecnia()
		{
			try
			{
				$('#frmMovimientosInsumosMercadotecnia').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_movimientos_entradas_insumos_mercadotecnia()
		{
			
			//Obtenemos un array con los datos del archivo
    		var arrArchivoMovimientosEntradasInsumosMercadotecnia = $("#fileXML_movimientos_entradas_insumos_mercadotecnia")[0].files[0];

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_insumos_mercadotecnia').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrInsumoID = [];
			var arrCantidades = [];
			var arrPreciosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrIvasUnitarios = [];
			var arrIepsUnitarios = [];
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioMovimiento = parseFloat($('#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variable que se utilizan para asignar valores del detalle
				var intCantidad = objRen.cells[1].innerHTML;
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intPrecioUnitario = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[5].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[6].innerHTML, ",", "");
				intIvaUnitario =  intIvaUnitario / intCantidad;
				intIepsUnitario = intIepsUnitario / intCantidad;

				//Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioMovimiento;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioMovimiento;
				intIvaUnitario = intIvaUnitario * intTipoCambioMovimiento;
				intIepsUnitario = intIepsUnitario * intTipoCambioMovimiento;

				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{	
					//Restar descuento al precio unitario
					intPrecioUnitario = intPrecioUnitario - intDescuentoUnitario;
				}

				arrInsumoID.push(objRen.getAttribute('id'));
				arrCantidades.push(intCantidad);
				arrPreciosUnitarios.push(intPrecioUnitario);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrIvasUnitarios.push(intIvaUnitario);
				arrIepsUnitarios.push(intIepsUnitario );
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('mercadotecnia/movimientos_entradas_insumos/guardar',
					{ 
						//Datos de la entrada por compra
						intEntradaCompraID: $('#txtEntradaInsumoID_movimientos_entradas_insumos_mercadotecnia').val(),
						strFolioConsecutivo: $('#txtFolio_movimientos_entradas_insumos_mercadotecnia').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_entradas_insumos_mercadotecnia').val()),
						intMonedaID: $('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').val(),
						intTipoCambio: intTipoCambioMovimiento,
						intOrdenCompraID: $('#txtOrdenCompraID_movimientos_entradas_insumos_mercadotecnia').val(),
						intProveedorID: $('#txtProveedorID_movimientos_entradas_insumos_mercadotecnia').val(),
						strFactura: $('#txtFactura_movimientos_entradas_insumos_mercadotecnia').val(),
						strObservaciones: $('#txtObservaciones_movimientos_entradas_insumos_mercadotecnia').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_insumos_mercadotecnia').val(),
						//Datos de los detalles
						strInsumoID: arrInsumoID.join('|'), 
						strCantidades: arrCantidades.join('|'),
						strPreciosUnitarios: arrPreciosUnitarios.join('|'),
						strDescuentosUnitarios: arrDescuentosUnitarios.join('|'),
						strIvasUnitarios: arrIvasUnitarios.join('|'),
						strIepsUnitarios: arrIepsUnitarios.join('|')
					},
					function(data) {

						if (data.resultado)
						{	
		                      
		                    //Si no existe id de la orden de compra, significa que es un nuevo registro   
							if($('#txtEntradaInsumoID_movimientos_entradas_insumos_mercadotecnia').val() == '')
							{
							  	//Asignar el id de la orden de compra registrada en la base de datos
                     			$('#txtEntradaInsumoID_movimientos_entradas_insumos_mercadotecnia').val(data.entrada_compra_id);
                     			//Asignar folio consecutivo
                     			$('#txtFolio_movimientos_entradas_insumos_mercadotecnia').val(data.folio);
							} 

							//Si existe archivo seleccionado
			                if(arrArchivoMovimientosEntradasInsumosMercadotecnia != undefined )
			                {
			                    //Hacer un llamado a la función para subir el archivo
			                    subir_archivo_modal_movimientos_entradas_insumos_mercadotecnia();
			                }
			                else
			                {
			                    //Hacer un llamado a la función para cerrar modal
		                    	cerrar_movimientos_entradas_insumos_mercadotecnia();
		                    	//Hacer llamado a la función  para cargar  los registros en el grid
			               		paginacion_movimientos_entradas_insumos_mercadotecnia();        
			                }	    
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_movimientos_entradas_insumos_mercadotecnia(data.tipo_mensaje, data.mensaje);

					},
			'json');
	
		}

		

		//Función para imprimir en PDF un registro seleccionado
		function reporte_registro_entradas_insumos_mercadotecnia(id)
		{	

			//Variable que se utiliza para asignar id de la encuesta
			var intEntradaCompraID = 0;
			
			//Dependiendo del tipo de formulario asignar id
			if(id == '')
				intEntradaCompraID = $('#txtEntradaInsumoID_movimientos_entradas_insumos_mercadotecnia').val();
			else
				intEntradaCompraID = id;

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("mercadotecnia/movimientos_entradas_insumos/get_reporte_registro/" + intEntradaCompraID);
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_movimientos_entradas_insumos_mercadotecnia(tipoMensaje, mensaje)
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
		function cambiar_estatus_movimientos_entradas_insumos_mercadotecnia(id, estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtEntradaInsumoID_movimientos_entradas_insumos_mercadotecnia').val();

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
						              'title':    'Entradas de Insumos por compra',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
						                              $.post('mercadotecnia/movimientos_entradas_insumos/set_estatus',
						                                     {intMovimientoInsumoID: intID,
						                                      strEstatus: estatus
						                                     },
						                                     function(data) {
						                                        if(data.resultado)
						                                        {
						                                            //Hacer llamado a la función  para cargar  los registros en el grid
						                                            paginacion_movimientos_entradas_insumos_mercadotecnia();
						                                            //Si el id del registro se obtuvo del modal
																	if(id == '')
																	{
																		//Hacer un llamado a la función para cerrar modal
																		cerrar_movimientos_entradas_insumos_mercadotecnia();     
																	}
						                                        }
						                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						                                        mensaje_movimientos_entradas_insumos_mercadotecnia(data.tipo_mensaje, data.mensaje);
						                                     },
						                                    'json');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('mercadotecnia/movimientos_entradas_insumos/set_estatus',
				     {intMovimientoInsumoID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				        if (data.resultado)
				        {
					        //Hacer llamado a la función para cargar  los registros en el grid
					      	paginacion_movimientos_entradas_insumos_mercadotecnia();
					      	//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_movimientos_entradas_insumos_mercadotecnia();     
							}
				        }
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_movimientos_entradas_insumos_mercadotecnia(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_movimientos_entradas_insumos_mercadotecnia(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('mercadotecnia/movimientos_entradas_insumos/get_datos',
			       {
			       		intMovimientoInsumoID:id
			       },
			       function(data) {
			       
			        	//Si hay datos del registro
			            if(data.row)
			            {

			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_movimientos_entradas_insumos_mercadotecnia('');
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	
				            //Recuperar valores
				            $('#txtEntradaInsumoID_movimientos_entradas_insumos_mercadotecnia').val(data.row.movimiento_insumo_id);
				            $('#txtFolio_movimientos_entradas_insumos_mercadotecnia').val(data.row.folio);
				            $('#txtFecha_movimientos_entradas_insumos_mercadotecnia').val(data.row.fecha);
				            $('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').val(data.row.moneda_id);
				            //Deshabilitar el control Moneda, debido a que en el editar no pueden agregarse o modificar conceptos con otro tipo de moneda o tipo de cambio
				            $('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
				            $('#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia').attr('disabled','disabled');
				            $('#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia').val(data.row.tipo_cambio);
				            $('#txtOrdenCompraID_movimientos_entradas_insumos_mercadotecnia').val(data.row.orden_compra_id);
				            $('#txtOrdenCompra_movimientos_entradas_insumos_mercadotecnia').val(data.row.ordenCompraFolio);
				            $('#txtProveedorID_movimientos_entradas_insumos_mercadotecnia').val(data.row.proveedor_id);
				            $('#txtProveedor_movimientos_entradas_insumos_mercadotecnia').val(data.row.proveedor);
				            $('#txtFactura_movimientos_entradas_insumos_mercadotecnia').val(data.row.factura);
				            $('#txtObservaciones_movimientos_entradas_insumos_mercadotecnia').val(data.row.observaciones);
				            
				            //Variable que se utiliza para asignar las acciones del grid view
						    var strAccionesTablaDetalles = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_detalles_movimientos_entradas_insumos_mercadotecnia(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_detalles_movimientos_entradas_insumos_mercadotecnia(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

						    //Si existe id de la orden de compra
						    if(data.row.orden_compra_id > 0)
						    {
						    	//Limpiar acciones del grid view
				           		strAccionesTablaDetalles = '';
				           		//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes a la orden de compra
								deshabilitar_controles_movimientos_entradas_insumos_mercadotecnia('cargar_orden_compra');
						    }

				            //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{	
				           		//Limpiar acciones del grid view
				           		strAccionesTablaDetalles = '';
				           		//Mostrar botón Descargar Archivo
				            	$("#btnDescargarArchivo_movimientos_entradas_insumos_mercadotecnia").show();
				            	//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes al XML
								deshabilitar_controles_movimientos_entradas_insumos_mercadotecnia('cargar_xml');
				           	}

				            //Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);

				            //Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_movimientos_entradas_insumos_mercadotecnia').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaConcepto = objRenglon.insertCell(0);
								var objCeldaCantidad = objRenglon.insertCell(1);
								var objCeldaPrecioUnitario = objRenglon.insertCell(2);
								var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
								var objCeldaSubtotal = objRenglon.insertCell(4);
								var objCeldaIvaUnitario = objRenglon.insertCell(5);
								var objCeldaIepsUnitario = objRenglon.insertCell(6);
								var objCeldaTotal = objRenglon.insertCell(7);
								var objCeldaAcciones = objRenglon.insertCell(8);
								//Columnas ocultas
								var objCeldaPorcentajeDescuento = objRenglon.insertCell(9);
								var objCeldaPorcentajeIva = objRenglon.insertCell(10);
								var objCeldaPorcentajeIeps = objRenglon.insertCell(11);
								var objCeldaInsumoID = objRenglon.insertCell(12);

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
								var intPorcentajeIva = 0;
								var intPorcentajeIeps = 0;
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
									intSubtotal = intPrecioUnitario - intDescuentoUnitario;
									//Calcular porcentaje del descuento
									intPorcentajeDescuento = (intDescuentoUnitario / intPrecioUnitario) * 100;
								}
								
								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;

								//Si existe importe de IVA unitario
								if(intIvaUnitario > 0)
								{
									//Calcular importe de IVA
									intImporteIva =  intIvaUnitario * intCantidad;
									//Calcular porcentaje del IVA
									intPorcentajeIva = (intImporteIva / intSubtotal) * 100;
								}

								//Si existe importe de IEPS unitario
								if(intIepsUnitario > 0)
								{
									//Calcular importe de IEPS
									intImporteIeps =  intIepsUnitario * intCantidad;
									//Calcular porcentaje del IEPS
									intPorcentajeIeps = (intImporteIeps / intSubtotal) * 100;
								}


								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].descripcion);
								objCeldaConcepto.innerHTML = data.detalles[intCon].descripcion;
								objCeldaConcepto.setAttribute('class', 'movil b1');
								objCeldaCantidad.innerHTML = intCantidad;
								objCeldaCantidad.setAttribute('class', 'movil b2');
								objCeldaPrecioUnitario.innerHTML = formatMoney(intPrecioUnitario, 6, '');
								objCeldaPrecioUnitario.setAttribute('class', 'movil b3');
								objCeldaDescuentoUnitario.innerHTML = formatMoney(intDescuentoUnitario, 6, '');
								objCeldaDescuentoUnitario.setAttribute('class', 'movil b4');
								objCeldaSubtotal.setAttribute('class', 'movil b5');
								objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 6, '');
								objCeldaIvaUnitario.innerHTML = formatMoney(intImporteIva, 6, '');
								objCeldaIvaUnitario.setAttribute('class', 'movil b6');
								objCeldaIepsUnitario.innerHTML = formatMoney(intImporteIeps, 6, '');
								objCeldaIepsUnitario.setAttribute('class', 'movil b7');
								objCeldaTotal.innerHTML = formatMoney(intTotal, 6, '');
								objCeldaTotal.setAttribute('class', 'movil b8');
								objCeldaAcciones.setAttribute('class', 'td-center movil b9');
								objCeldaAcciones.innerHTML = strAccionesTablaDetalles;
								objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeDescuento.innerHTML = formatMoney(intPorcentajeDescuento, 2, '');
								objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIva.innerHTML = formatMoney(intPorcentajeIva, 2, '');
								objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIeps.innerHTML = formatMoney(intPorcentajeIeps, 2, '');
								objCeldaInsumoID.innerHTML = data.detalles[intCon].insumo_id;
								objCeldaInsumoID.setAttribute('class', 'no-mostrar');
				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_movimientos_entradas_insumos_mercadotecnia();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_movimientos_entradas_insumos_mercadotecnia tr").length - 2;
							$('#numElementos_detalles_movimientos_entradas_insumos_mercadotecnia').html(intFilas);
							$('#txtNumDetalles_movimientos_entradas_insumos_mercadotecnia').val(intFilas);
				            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
				            $('#divEncabezadoModal_movimientos_entradas_insumos_mercadotecnia').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_movimientos_entradas_insumos_mercadotecnia").show();
				           	
							//Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmMovimientosInsumosMercadotecnia').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					            $("#btnGuardar_movimientos_entradas_insumos_mercadotecnia").hide();

					            //Si el estatus del registro es INACTIVO
				            	if(strEstatus == 'INACTIVO')
				            	{
				            		//Mostrar botón Restaurar
				            		$("#btnRestaurar_movimientos_entradas_insumos_mercadotecnia").show();
				            	}

				            }
				            else
				            {
				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
					            {
					            	//Mostrar los siguientes botones  
					            	$("#btnDesactivar_movimientos_entradas_insumos_mercadotecnia").show();
					            }
				            }

							//Abrir modal
							 objMovimientosInsumosMercadotecnia = $('#MovimientosInsumosMercadotecniaBox').bPopup({
														   appendTo: '#MovimientosInsumosMercadotecniaContent', 
							                               contentContainer: 'MovimientosInsumosMercadotecniaM', 
							                               zIndex: 2, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtOrdenCompra_movimientos_entradas_insumos_mercadotecnia').focus();
					        
			       	    }
			       },
			       'json');
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_movimientos_entradas_insumos_mercadotecnia()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').val()) !== intMonedaBaseIDMovimientosInsumosMercadotecnia)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_movimientos_entradas_insumos_mercadotecnia').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia").val(data.row.tipo_cambio_sat);
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}

		//Función para subir archivo de un registro desde el modal
		function subir_archivo_modal_movimientos_entradas_insumos_mercadotecnia()
		{	

			//Si existe id del registro subir el archivo
        	if($('#txtEntradaInsumoID_movimientos_entradas_insumos_mercadotecnia').val() != '')
        	{
				//Variable que se utiliza para asignar archivo
				var strBotonArchivoIDMovimientosEntradasInsumosMercadotecnia = "fileXML_movimientos_entradas_insumos_mercadotecnia";

				//Hacer un llamado al método del controlador para subir archivo del registro
				$('#'+strBotonArchivoIDMovimientosEntradasInsumosMercadotecnia).upload('mercadotecnia/movimientos_entradas_insumos/subir_archivo',
						{ intMovimientoInsumosID:$('#txtEntradaInsumoID_movimientos_entradas_insumos_mercadotecnia').val(),
		                  intProveedorID:$('#txtProveedorID_movimientos_entradas_insumos_mercadotecnia').val(),
		                  strBotonArchivoID: strBotonArchivoIDMovimientosEntradasInsumosMercadotecnia
						},
						function(data) {

							//Limpia ruta del archivo cargado
			         		$('#'+strBotonArchivoIDMovimientosEntradasInsumosMercadotecnia).val('');
							//Subida finalizada.
							if (data.resultado)
							{
								//Hacer llamado a la función  para cargar  los registros en el grid
				            	paginacion_movimientos_entradas_insumos_mercadotecnia();  
							}

	                    	//Si el tipo de mensaje es un éxito
			                if(data.tipo_mensaje == 'éxito')
			                {
				                //Hacer un llamado a la función para cerrar modal
				                cerrar_movimientos_entradas_insumos_mercadotecnia();
			                }
			                else
			                {
			                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				    			mensaje_movimientos_entradas_insumos_mercadotecnia(data.tipo_mensaje, data.mensaje);
			                }

						});
			}
					
		}


		function cargar_xml_movimientos_entradas_insumos_mercadotecnia() {

		  	var el = document.getElementById("fileXML_movimientos_entradas_insumos_mercadotecnia");
		  	if (el) {
		    	el.click();
		  	}
		
		}

		//Función para agregar elementos del XML al Modal
		function cargar_xml_modal_movimientos_entradas_insumos_mercadotecnia(files) {

		  	var file = files[0];
			var reader = new FileReader();

			reader.onload = function() {
			   	
			   	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
				inicializar_detalles_movimientos_entradas_insumos_mercadotecnia();

  				var xml = $.parseXML(reader.result);
  				var xml_json = $.xmlToJson(xml);

				var moneda = xml_json['cfdi:Comprobante']['@attributes']['Moneda'];
				var tipo_cambio = xml_json['cfdi:Comprobante']['@attributes']['TipoCambio'];
				var serie = xml_json['cfdi:Comprobante']['@attributes']['Serie'];
				var folio = xml_json['cfdi:Comprobante']['@attributes']['Folio'];
				var proveedor = xml_json['cfdi:Comprobante']['cfdi:Emisor']['@attributes']['Rfc'];
				var receptor = xml_json['cfdi:Comprobante']['cfdi:Receptor']['@attributes']['Rfc'];
				var conceptos = xml_json['cfdi:Comprobante']['cfdi:Conceptos'];  

  				//Buscar el moneda_id correspondiente a la moneda de la factura
				$.post('contabilidad/sat_monedas/get_datos',
				{
					strBusqueda:moneda,
			       	strTipo: "codigo"
				},
				     function(data) {	
					      if (data.row)
					      {
					      	//Asignar id de la moneda
					      	$('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').val(data.row.moneda_id);
							
					      	//Buscar el proveedor_id correspondiente al RFC que se obtiene del XML Emisor
							$.post('cuentas_pagar/proveedores/get_datos',
							{
								strRfc:proveedor
							},
							     function(data) {
								      if (data.row)
								      {
								      	//Asignar datos del proveedor
								      	$('#txtProveedorID_movimientos_entradas_insumos_mercadotecnia').val(data.row[0].proveedor_id);
								      	$('#txtProveedor_movimientos_entradas_insumos_mercadotecnia').val(data.row[0].codigo + ' - ' + data.row[0].nombre_comercial);

								      	//Buscar si el RFC de la factura coincide con el RFC de la sucursal
										$.post('mercadotecnia/movimientos_entradas_insumos/get_sucursal_rfc',
										{
											
										},
										     function(data) { 
												  if (data.row)
											      {
											      	//Si no existe RFC
											      	if(data.row.rfc != receptor){

											      		//Hacer un llamado a la función para mostrar mensaje de error
											      		mensaje_movimientos_entradas_insumos_mercadotecnia('error', 'La ENTRADA POR COMPRA no puede agregarse. El <b>RFC del receptor</b> proporcionado en el archivo XML no coincide con el RFC de la empresa.');
											      	
											      	}
											      	else{

											      		//Array que se utiliza para agregar los códigos no encontrados en el catálogo de insumos
											      		var arrNoEncontrados = [];

											      		//Variable que se utiliza para asignar el número de conceptos que contiene el nodo Concepto
											      		var intNumConceptos = conceptos['cfdi:Concepto'].length;

											      		//Si el número de conceptos es indefinido, significa que el nodo solo contiene un concepto
											      		if(intNumConceptos == undefined)
											      		{	
											      			/*Asignar 1 para evitar errores al momento de verificar la existencia 
											      			 del código en el catálogo de insumos*/
											      			intNumConceptos = 1;
											      		}

														for (var i = 0; i<conceptos['cfdi:Concepto'].length; i++) 
														{ 


														   //Variable que se utiliza para asignar el código de la refacción que se buscara en la tabla refacciones_internas
															var strDescripcion = '';

															//Si solo existe un concepto 
															if(intNumConceptos == 1)
															{
																strDescripcion =  conceptos['cfdi:Concepto']['@attributes']['Descripcion'];
																
															}
															else
															{
																strDescripcion = conceptos['cfdi:Concepto'][i]['@attributes']['Descripcion'];
															}

															//Hacer un llamado al método del controlador para regresar los datos del registro que coincide con el código	
														   $.ajax({
														        url: 'mercadotecnia/insumos/get_datos',
														        method:'post',
														        dataType: 'json',
														        async: false,
														        data: {
														        	strTipo: 'descripcion',
														            strBusqueda: strDescripcion
														        },
														        success: function (resp) {
														          	//Si no se encuentra la descripción del insumo 
														        	if(resp.row == null){
														        		//Agregar código en el array, de esta manera, el usuario identificara las descripciones de insumos no encontrados
														        		arrNoEncontrados.push(strDescripcion);
														        	}

														        }
														    })
														    
														}

														//Si existen descripciones de insumos no encontradas en el catálogo de insumos
														if(arrNoEncontrados.length > 0){

															//Mensaje que se utiliza para informar al usuario la lista de insumos no encontrados
															var strMensaje = 'La ENTRADA POR COMPRA no puede agregarse. Los siguientes <b>conceptos</b> no se encuentran agregados en el catálogo de insumos:<br>';

															for(var i=0; i<arrNoEncontrados.length; i++)
											            		strMensaje = strMensaje + arrNoEncontrados[i] + '<br/>';

											            	mensaje_movimientos_entradas_insumos_mercadotecnia('error', strMensaje);

														}
														else{

															//Agregar conceptos al dgDetalles
															var objTabla = document.getElementById('dg_detalles_movimientos_entradas_insumos_mercadotecnia').getElementsByTagName('tbody')[0];

															//Cargar conceptos de la factura al dg_detalles
															for(var i=0; i<intNumConceptos; i++)
															{

																//Variable
																var intNumImpuestos = 0;
																//Variables que se utilizan para asignar los datos del detalle
																var intInsumoID = 0;
																var strInsumo = '';
																var intCantidad = 0;
																var intPrecioUnitario = 0;
																var intDescuentoUnitario = 0;
																var intSubtotal = 0;
																var intImporteIva = 0;
																var intImporteIeps = 0;
																var intTotal = 0;

																//Si solo existe un concepto 
																if(intNumConceptos == 1)
																{
																	strInsumo =  conceptos['cfdi:Concepto']['@attributes']['Descripcion'];
																	intCantidad = parseFloat(conceptos['cfdi:Concepto']['@attributes']['Cantidad']);
																	intPrecioUnitario =  parseFloat(conceptos['cfdi:Concepto']['@attributes']['ValorUnitario']);
																	intDescuentoUnitario = parseFloat(conceptos['cfdi:Concepto']['@attributes']['Descuento']);

																	intNumImpuestos = conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'].length;
																	
																}
																else
																{
																	strInsumo = conceptos['cfdi:Concepto'][i]['@attributes']['Descripcion'];
																	intCantidad = parseFloat(conceptos['cfdi:Concepto'][i]['@attributes']['Cantidad']);
																	intPrecioUnitario =  parseFloat(conceptos['cfdi:Concepto'][i]['@attributes']['ValorUnitario']);
																	intDescuentoUnitario = parseFloat(conceptos['cfdi:Concepto'][i]['@attributes']['Descuento']);

																	intNumImpuestos = conceptos['cfdi:Concepto'][i]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'].length;
																}

																//Si el número de impuestos es indefinido, significa que el nodo solo contiene un impuesto 
													      		if(intNumImpuestos == undefined)
													      		{	
													      			//Asignar 1 para recuperar valor del impuesto
													      			intNumImpuestos = 1;
													      		}

																//Hacer un llamado al método del controlador para regresar los datos del registro que coincide con el código
															    $.ajax({
															        url: 'mercadotecnia/insumos/get_datos',
															        method:'post',
															        dataType: 'json',
															        async: false,
															        data: {
															        	strTipo: 'descripcion',
															            strBusqueda: strInsumo
															        },
															        success: function (data) {
															          	//Si hay datos del registro
															        	if(data.row)
															        	{	
															        		intInsumoID = data.row.insumo_id;
															        	}

															        }
															    });

															    //Asignar precio unitario
															    intSubtotal = intPrecioUnitario;

																//Si existe importe del descuento
																if(intDescuentoUnitario > 0)
																{
																	intSubtotal = intSubtotal - intDescuentoUnitario;
																}

																//Calcular subtotal
																intSubtotal = (intCantidad * intSubtotal);

																//Recorrer impuestos trasladados para un concepto
																for(var intConSec = 0; intConSec < intNumImpuestos; intConSec ++)
																{

																	var strImpuesto = '';
																	var intImporte = 0;

																	//Si solo existe un concepto 
																	if(intNumConceptos == 1)
																	{
																		//Si solo existe un impuesto 
																		if(intNumImpuestos == 1)
																		{
																			strImpuesto = parseFloat(conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['Impuesto']);
																			intImporte = parseFloat(conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['Importe']);
																		}
																		else
																		{
																			strImpuesto = parseFloat(conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['Impuesto']);
																			intImporte = parseFloat(conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['Importe']);

																		}
																		
																	}
																	else
																	{
																		//Si solo existe un impuesto 
																		if(intNumImpuestos == 1)
																		{
																			strImpuesto = parseFloat(conceptos['cfdi:Concepto'][i]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['Impuesto']);
																			intImporte = parseFloat(conceptos['cfdi:Concepto'][i]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['Importe']);
																		}
																		else
																		{
																			strImpuesto = parseFloat(conceptos['cfdi:Concepto'][i]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['Impuesto']);
																			intImporte = parseFloat(conceptos['cfdi:Concepto'][i]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['Importe']);
																		}
																		
																	}

																	
																	//Si el código del impuesto corresponde al IVA
																	if(strImpuesto == '002')
																	{
																		//Incrementar importe de IVA
																		intImporteIva += intImporte;
																	}
																	//Si el código del impuesto corresponde al IEPS
																	else if( strImpuesto == '003')
																	{
																		//Incrementar importe de IEPS
																		intImporteIeps += intImporte;
																	}

																}

																//Calcular importe total
																intTotal = intSubtotal + intImporteIva + intImporteIeps;

																//Insertamos el renglón con sus celdas en el objeto de la tabla
																var objRenglon = objTabla.insertRow();
																var objCeldaInsumo = objRenglon.insertCell(0);
																var objCeldaCantidad = objRenglon.insertCell(1);
																var objCeldaPrecioUnitario = objRenglon.insertCell(2);
																var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
																var objCeldaSubtotal = objRenglon.insertCell(4);
																var objCeldaIvaUnitario = objRenglon.insertCell(5);
																var objCeldaIepsUnitario = objRenglon.insertCell(6);
																var objCeldaTotal = objRenglon.insertCell(7);
																var objCeldaAcciones = objRenglon.insertCell(8);

																//Asignar valores
																objRenglon.setAttribute('class', 'movil');
																objRenglon.setAttribute('id', intInsumoID);
																objCeldaInsumo.setAttribute('class', 'movil b1');
																objCeldaInsumo.innerHTML = strInsumo;
																objCeldaCantidad.setAttribute('class', 'movil b2');
																objCeldaCantidad.innerHTML = intCantidad;
																objCeldaPrecioUnitario.setAttribute('class', 'movil b3');
																objCeldaPrecioUnitario.innerHTML = formatMoney(intPrecioUnitario, 6, '');
																objCeldaDescuentoUnitario.setAttribute('class', 'movil b4');
																objCeldaDescuentoUnitario.innerHTML = formatMoney(intDescuentoUnitario, 6, '');
																objCeldaSubtotal.setAttribute('class', 'movil b5');
																objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 6, '');
																objCeldaIvaUnitario.setAttribute('class', 'movil b6');
																objCeldaIvaUnitario.innerHTML = formatMoney(intImporteIva, 6, '');
																objCeldaIepsUnitario.setAttribute('class', 'movil b7');
																objCeldaIepsUnitario.innerHTML = formatMoney(intImporteIeps, 6, '');
																objCeldaTotal.setAttribute('class', 'movil b8');
																objCeldaTotal.innerHTML = formatMoney(intTotal, 6, '')						 
																
															}//Fin del Ciclo For

															calcular_totales_detalles_movimientos_entradas_insumos_mercadotecnia();	

															var intFilas = $("#dg_detalles_movimientos_entradas_insumos_mercadotecnia tr").length - 2;
															$('#numElementos_detalles_movimientos_entradas_insumos_mercadotecnia').html(intFilas);
															$('#txtNumDetalles_movimientos_entradas_insumos_mercadotecnia').val(intFilas);	

														}

											      	}
											      }
											      else{

											      		mensaje_movimientos_entradas_insumos_mercadotecnia('error', 'La ENTRADA POR COMPRA no puede agregarse. El <b>RFC del receptor</b> proporcionado en el archivo XML no coincide con el RFC de la empresa.');
											      }	 
										     },
									    'json');



								      }
								      else{
								      		
								      		mensaje_movimientos_entradas_insumos_mercadotecnia('error', 'La ENTRADA POR COMPRA no puede agregarse. El <b>proveedor</b> proporcionado en el archivo XML no se encuentra agregado en el catálogo de proveedores.');
								      }	
							     },
						    'json');	
					      	
					      }
					      else{

					      	mensaje_movimientos_entradas_insumos_mercadotecnia('error', 'La ENTRADA POR COMPRA no puede agregarse. La <b>moneda</b> proporcionada en el archivo XML no se encuentra agregada en el catálogo SAT moneda.');

					      }
				     
				     },
			    'json');
				
				//Formato del tipo de cambio a 4 decimales
				$('#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia').val(Number(tipo_cambio).toFixed(4));
				
				//Factura: Concatenación de la SERIE y FOLIO de los datos del XML timbrado
				$('#txtFactura_movimientos_entradas_insumos_mercadotecnia').val(serie+folio);

				//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes al XML
				deshabilitar_controles_movimientos_entradas_insumos_mercadotecnia();

			};

			reader.readAsText(file);

		}

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_movimientos_entradas_insumos_mercadotecnia()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla ordenes_compra_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asigna el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intInsumo = $('#txtInsumoID_detalles_movimientos_entradas_insumos_mercadotecnia').val();
			var strInsumo = $('#txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia').val();
			var intCantidad = $('#txtCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia').val();
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intSubtotal = $.reemplazar($('#txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia').val(), ",", "");
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_insumos_mercadotecnia').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intInsumo == '' || strInsumo == '')
			{
				//Enfocar caja de texto
				$('#txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			}
			else if (intCantidad == '')
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			}
			else if (intPrecioUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			}
			else if (intPorcentajeIva == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeIva, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			}
			else if (intPorcentajeIeps == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeIeps, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia').val('');
				$('#txtCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').val('');
			    $('#txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia').val('');
			    $('#txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').val('');
			    $('#txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia').val('');
			    $('#txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia').val('');

				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strInsumo = strInsumo.toUpperCase();

				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}
				else
				{
					intPorcentajeDescuento = 0;
				}

				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;

				//Si existe porcentaje de IVA
				if(intPorcentajeIva > 0)
				{
					//Calcular importe de IVA
					intImporteIva = parseFloat(intSubtotal * intPorcentajeIva) / 100;
				}
				else
				{
					intPorcentajeIva = 0;
				}

				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps > 0)
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps) / 100;
				}
				else
				{
					intPorcentajeIeps = 0;
				}

				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

				//Revisamos si existe la descripción proporcionada, si es así, editamos los datos
				if (objTabla.rows.namedItem(strInsumo))
				{
					objTabla.rows.namedItem(strInsumo).cells[1].innerHTML = intCantidad;
					objTabla.rows.namedItem(strInsumo).cells[2].innerHTML = intPrecioUnitario;
					objTabla.rows.namedItem(strInsumo).cells[3].innerHTML =  formatMoney(intDescuentoUnitario, 6, '');
					objTabla.rows.namedItem(strInsumo).cells[4].innerHTML =  formatMoney(intSubtotal, 6, '');
					objTabla.rows.namedItem(strInsumo).cells[5].innerHTML = formatMoney(intImporteIva, 6, '');
					objTabla.rows.namedItem(strInsumo).cells[6].innerHTML = formatMoney(intImporteIeps, 6, '');
					objTabla.rows.namedItem(strInsumo).cells[7].innerHTML = formatMoney(intTotal, 6, '');
					objTabla.rows.namedItem(strInsumo).cells[9].innerHTML = formatMoney(intPorcentajeDescuento, 2, '');
					objTabla.rows.namedItem(strInsumo).cells[10].innerHTML = formatMoney(intPorcentajeIva, 2, '');
					objTabla.rows.namedItem(strInsumo).cells[11].innerHTML = formatMoney(intPorcentajeIeps, 2, '');
				}
				else
				{
					//Validamos que exista el insumo en el catalogo de Insumos
					if(intInsumo != ''){

						//Insertamos el renglón con sus celdas en el objeto de la tabla
						var objRenglon = objTabla.insertRow();
						var objCeldaInsumo = objRenglon.insertCell(0);
						var objCeldaCantidad = objRenglon.insertCell(1);
						var objCeldaPrecioUnitario = objRenglon.insertCell(2);
						var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
						var objCeldaSubtotal = objRenglon.insertCell(4);
						var objCeldaIvaUnitario = objRenglon.insertCell(5);
						var objCeldaIepsUnitario = objRenglon.insertCell(6);
						var objCeldaTotal = objRenglon.insertCell(7);
						var objCeldaAcciones = objRenglon.insertCell(8);
						//Columnas ocultas
						var objCeldaPorcentajeDescuento = objRenglon.insertCell(9);
						var objCeldaPorcentajeIva = objRenglon.insertCell(10);
						var objCeldaPorcentajeIeps = objRenglon.insertCell(11);
						var objCeldaInsumoID = objRenglon.insertCell(12);

						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', strInsumo);
						objCeldaInsumo.setAttribute('class', 'movil b1');
						objCeldaInsumo.innerHTML = strInsumo;
						objCeldaCantidad.setAttribute('class', 'movil b2');
						objCeldaCantidad.innerHTML = intCantidad;
						objCeldaPrecioUnitario.setAttribute('class', 'movil b3');
						objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
						objCeldaDescuentoUnitario.setAttribute('class', 'movil b4');
						objCeldaDescuentoUnitario.innerHTML = formatMoney(intDescuentoUnitario, 6, '');
						objCeldaSubtotal.setAttribute('class', 'movil b5');
						objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 6, '');
						objCeldaIvaUnitario.setAttribute('class', 'movil b6');
						objCeldaIvaUnitario.innerHTML = formatMoney(intImporteIva, 6, '');
						objCeldaIepsUnitario.setAttribute('class', 'movil b7');
						objCeldaIepsUnitario.innerHTML = formatMoney(intImporteIeps, 6, '');
						objCeldaTotal.setAttribute('class', 'movil b8');
						objCeldaTotal.innerHTML = formatMoney(intTotal, 6, '');
						objCeldaAcciones.setAttribute('class', 'td-center movil b9');
						objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalles_movimientos_entradas_insumos_mercadotecnia(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_detalles_movimientos_entradas_insumos_mercadotecnia(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
						objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeDescuento.innerHTML = formatMoney(intPorcentajeDescuento, 2, ''); 
						objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeIva.innerHTML = formatMoney(intPorcentajeIva, 2, ''); 
						objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeIeps.innerHTML = formatMoney(intPorcentajeIeps, 2, '');
						objCeldaInsumoID.innerHTML = intInsumo;
						objCeldaInsumoID.setAttribute('class', 'no-mostrar');

					}
					else{

						mensaje_movimientos_entradas_insumos_mercadotecnia('error', 'El insumo no se encuentra registrado en el catálogo');
						
					}

					

				}

				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_movimientos_entradas_insumos_mercadotecnia();
				
				//Enfocar caja de texto
				$('#txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_movimientos_entradas_insumos_mercadotecnia tr").length - 2;
			$('#numElementos_detalles_movimientos_entradas_insumos_mercadotecnia').html(intFilas);
			$('#txtNumDetalles_movimientos_entradas_insumos_mercadotecnia').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_movimientos_entradas_insumos_mercadotecnia(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtInsumoID_detalles_movimientos_entradas_insumos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[9].innerHTML);
			$('#txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);

			//Enfocar caja de texto
			$('#txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_movimientos_entradas_insumos_mercadotecnia(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_movimientos_entradas_insumos_mercadotecnia").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_movimientos_entradas_insumos_mercadotecnia();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_movimientos_entradas_insumos_mercadotecnia tr").length - 2;
			$('#numElementos_detalles_movimientos_entradas_insumos_mercadotecnia').html(intFilas);
			$('#txtNumDetalles_movimientos_entradas_insumos_mercadotecnia').val(intFilas);

			//Enfocar caja de texto
			$('#txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_movimientos_entradas_insumos_mercadotecnia()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_insumos_mercadotecnia').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumCantidad = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				intAcumCantidad += parseFloat(objRen.cells[1].innerHTML);
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));

			}

			//Convertir cantidad a formato moneda
			intAcumCantidad = formatMoney(intAcumCantidad, 2, '');
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, 6, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 6, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, 6, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, 6, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, 6, '');

			//Asignar los valores
			$('#acumCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').html(intAcumCantidad);
			$('#acumDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').html(intAcumDescuento);
			$('#acumSubtotal_detalles_movimientos_entradas_insumos_mercadotecnia').html(intAcumSubtotal);
			$('#acumIva_detalles_movimientos_entradas_insumos_mercadotecnia').html(intAcumIva);
			$('#acumIeps_detalles_movimientos_entradas_insumos_mercadotecnia').html(intAcumIeps);
			$('#acumTotal_detalles_movimientos_entradas_insumos_mercadotecnia').html(intAcumTotal);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia').numeric();
			$('#txtTotalUnidades_movimientos_entradas_insumos_mercadotecnia').numeric();
			$('#txtImporteTotal_movimientos_entradas_insumos_mercadotecnia').numeric();
			$('#txtCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').numeric();
			$('#txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia').numeric();
        	$('#txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').numeric();
        	$('#txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia').numeric();
        	$('#txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_movimientos_entradas_insumos_mercadotecnia').blur(function(){
				$('.moneda_movimientos_entradas_insumos_mercadotecnia').formatCurrency({ roundToDecimalPlace: 6 });
			});

			/*Asignar formatCurrency (formato Tipo de Cambio) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 18.90 será 18.9000*/
        	$('.tipo-cambio_movimientos_entradas_insumos_mercadotecnia').blur(function(){
				$('.tipo-cambio_movimientos_entradas_insumos_mercadotecnia').formatCurrency({ roundToDecimalPlace: 4 });
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_movimientos_entradas_insumos_mercadotecnia').blur(function(){
                $('.cantidad_movimientos_entradas_insumos_mercadotecnia').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_movimientos_entradas_insumos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFecha_movimientos_entradas_insumos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY',
			 																   useCurrent: false});

			//Regresar el tipo de cambio de la moneda cuando cambie la fecha
			$('#dteFecha_movimientos_entradas_insumos_mercadotecnia').on('dp.change', function (e) {
				//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_movimientos_entradas_insumos_mercadotecnia();
			});

	        //Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').val()) === intMonedaBaseIDMovimientosInsumosMercadotecnia)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia').val(intTipoCambioMonedaBaseMovimientosInsumosMercadotecnia);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia').formatCurrency({ roundToDecimalPlace: 4 });
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia').val('');
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_movimientos_entradas_insumos_mercadotecnia();
             	}
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoMovimientosInsumosMercadotecnia)
	        	{
	        		$('#txtTipoCambio_movimientos_entradas_insumos_mercadotecnia').val(intTipoCambioMaximoMovimientosInsumosMercadotecnia);
	        	}

		    });

			//Comprobar la existencia de la descripción en la BD cuando pierda el enfoque la caja de texto
			$('#txtDescripcion_movimientos_entradas_insumos_mercadotecnia').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtMovimientoInsumoID_movimientos_entradas_insumos_mercadotecnia').val() == '' && $('#txtDescripcion_movimientos_entradas_insumos_mercadotecnia').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_movimientos_entradas_insumos_mercadotecnia($('#txtDescripcion_movimientos_entradas_insumos_mercadotecnia').val(), 'descripcion', 'Nuevo');
				}
			});

			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_movimientos_entradas_insumos_mercadotecnia').on('click','button.btn',function(){
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

	        //Validar que exista concepto cuando se pulse la tecla enter 
			$('#txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe concepto
		           if($('#txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			   	    }
		        }
		    });

			//Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPrecioUnitario_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia').on('keypress', function (e) {
		        if(e.which === 13 )
		        {

		         	//Si no existe procentaje de IVA
		            if( $('#txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje de IEPS
		            if($('#txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_detalles_movimientos_entradas_insumos_mercadotecnia').focus();
			   	    }
		        }
		    });

			

	        //Autocomplete para recuperar los datos de una orden de compra 
	        $('#txtOrdenCompra_movimientos_entradas_insumos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtOrdenCompraID_movimientos_entradas_insumos_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/ordenes_compra/autocomplete",
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
	           	  $('#txtOrdenCompraID_movimientos_entradas_insumos_mercadotecnia').val(ui.item.data); 
	             
	              //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	              $.post('cuentas_pagar/ordenes_compra/get_datos',
	                  { 
	                  	intOrdenCompraID: $("#txtOrdenCompraID_movimientos_entradas_insumos_mercadotecnia").val()
	                  },
	                  function(data) {
	                    if(data.row){ 
	             			$('#txtOrdenCompra_movimientos_entradas_insumos_mercadotecnia').val(data.row.folio);
	             		    $('#txtProveedorID_movimientos_entradas_insumos_mercadotecnia').val(data.row.proveedor_id);
	             		    $('#txtProveedor_movimientos_entradas_insumos_mercadotecnia').val(data.row.proveedor);
	             		   	//Deshabilitamos el campo Proveedor (no se puede seleccionar un Proveedor si fué seleccionada una orden de compra)
	             		   	$('#txtProveedor_movimientos_entradas_insumos_mercadotecnia').prop('disabled', true);
	             		   	//Deshabilitar el botón para agregar más Insumos a una orden de compra
	             		   	$('#btnAgregar_movimientos_entradas_insumos_mercadotecnia').prop('disabled', true);  

	             		    //Cargar insumos adherentes a la orden de compra seleccionada
		                    if(data.detalles){

		                    	//Arreglo para guardar el número de conceptos pertenecientes a la orden de compra que no fueron encontrados en el catalogo de insumos
		                    	var arrNoEncontrados = [];
		                    	for (var intCon in data.detalles) 
					            {
					            	if(data.detalles[intCon].insumo_id == null)
					            		arrNoEncontrados.push(data.detalles[intCon].concepto);
					            }

					            //Si todos los conceptos fueron encontrados llenamos el dg de detalles
					            if(arrNoEncontrados.length == 0){

					            	//Mostramos los detalles del registro
						           	for (var intCon in data.detalles) 
						            {
						            	//Obtenemos el objeto de la tabla
										var objTabla = document.getElementById('dg_detalles_movimientos_entradas_insumos_mercadotecnia').getElementsByTagName('tbody')[0];

										//Insertamos el renglón con sus celdas en el objeto de la tabla
										var objRenglon = objTabla.insertRow();
										var objCeldaConcepto = objRenglon.insertCell(0);
										var objCeldaCantidad = objRenglon.insertCell(1);
										var objCeldaPrecioUnitario = objRenglon.insertCell(2);
										var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
										var objCeldaSubtotal = objRenglon.insertCell(4);
										var objCeldaIvaUnitario = objRenglon.insertCell(5);
										var objCeldaIepsUnitario = objRenglon.insertCell(6);
										var objCeldaTotal = objRenglon.insertCell(7);
										var objCeldaAcciones = objRenglon.insertCell(8);
										//Columnas ocultas
										var objCeldaPorcentajeDescuento = objRenglon.insertCell(9);
										var objCeldaPorcentajeIva = objRenglon.insertCell(10);
										var objCeldaPorcentajeIeps = objRenglon.insertCell(11);
										var objCeldaInsumoID = objRenglon.insertCell(12);

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
										var intPorcentajeIva = 0;
										var intPorcentajeIeps = 0;
										var intTotal = 0;
										var intInsumoID = data.detalles[intCon].insumo_id;


										//Si existe importe del descuento
										if(intDescuentoUnitario > 0)
										{
											intPrecioUnitario = intPrecioUnitario + intDescuentoUnitario;
											intSubtotal = intPrecioUnitario - intDescuentoUnitario;
											//Calcular porcentaje del descuento
											intPorcentajeDescuento = (intDescuentoUnitario / intPrecioUnitario) * 100;
										}
										
										//Calcular subtotal
										intSubtotal = intCantidad * intSubtotal;

										//Si existe importe de IVA unitario
										if(intIvaUnitario > 0)
										{
											//Calcular importe de IVA
											intImporteIva =  intIvaUnitario * intCantidad;
											//Calcular porcentaje del IVA
											intPorcentajeIva = (intImporteIva / intSubtotal) * 100;
										}

										//Si existe importe de IEPS unitario
										if(intIepsUnitario > 0)
										{
											//Calcular importe de IEPS
											intImporteIeps =  intIepsUnitario * intCantidad;
											//Calcular porcentaje del IEPS
											intPorcentajeIeps = (intImporteIeps / intSubtotal) * 100;
										}

										//Calcular importe total
										intTotal = intSubtotal + intImporteIva + intImporteIeps;

										//Asignar valores
										objRenglon.setAttribute('class', 'movil');
										objRenglon.setAttribute('id', data.detalles[intCon].insumo_id);
										objCeldaConcepto.innerHTML = data.detalles[intCon].concepto;
										objCeldaConcepto.setAttribute('class', 'movil b1');
										objCeldaCantidad.innerHTML = intCantidad;
										objCeldaCantidad.setAttribute('class', 'movil b2');
										objCeldaPrecioUnitario.innerHTML = formatMoney(intPrecioUnitario, 6, '');
										objCeldaPrecioUnitario.setAttribute('class', 'movil b3');
										objCeldaDescuentoUnitario.innerHTML = formatMoney(intDescuentoUnitario, 6, '');
										objCeldaDescuentoUnitario.setAttribute('class', 'movil b4');
										objCeldaSubtotal.setAttribute('class', 'movil b5');
										objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 6, '');
										objCeldaIvaUnitario.innerHTML = formatMoney(intImporteIva, 6, '');
										objCeldaIvaUnitario.setAttribute('class', 'movil b6');
										objCeldaIepsUnitario.innerHTML = formatMoney(intImporteIeps, 6, '');
										objCeldaIepsUnitario.setAttribute('class', 'movil b7');
										objCeldaTotal.innerHTML = formatMoney(intTotal, 6, '');
										objCeldaTotal.setAttribute('class', 'movil b8');
										
										objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
										objCeldaPorcentajeDescuento.innerHTML = formatMoney(intPorcentajeDescuento, 2, '');
										objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
										objCeldaPorcentajeIva.innerHTML = formatMoney(intPorcentajeIva, 2, '');
										objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
										objCeldaPorcentajeIeps.innerHTML = formatMoney(intPorcentajeIeps, 2, '');
										objCeldaInsumoID.innerHTML = intInsumoID;
										objCeldaInsumoID.setAttribute('class', 'no-mostrar');

						            }

						            //Hacer un llamado a la función para calcular totales de la tabla
									calcular_totales_detalles_movimientos_entradas_insumos_mercadotecnia();

									var intFilas = $("#dg_detalles_movimientos_entradas_insumos_mercadotecnia tr").length - 2;
									$('#numElementos_detalles_movimientos_entradas_insumos_mercadotecnia').html(intFilas);
									$('#txtNumDetalles_movimientos_entradas_insumos_mercadotecnia').val(intFilas);	

					            }
					            else{
					            	
					            	var mensaje = 'No es posible generar esta ENTRADA POR COMPRA. Los siguientes conceptos de la orden de compra no se encuentran agregados en el catálogo de insumos: <br/>';

					            	for(var i=0; i<arrNoEncontrados.length; i++)
					            		mensaje = mensaje + arrNoEncontrados[i] + '<br/>';

					            	mensaje_movimientos_entradas_insumos_mercadotecnia('error', mensaje);

					            }
   
					        }

					        deshabilitar_controles_movimientos_entradas_insumos_mercadotecnia();

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

			//Funcion para verificar si existe una orden de compra seleccionada
			$('#txtOrdenCompra_movimientos_entradas_insumos_mercadotecnia').focusout(function() {
    			
    			if( $('#txtOrdenCompraID_movimientos_entradas_insumos_mercadotecnia').val() == '' ||
	               $('#txtOrdenCompra_movimientos_entradas_insumos_mercadotecnia').val() == '' ){
    				
    				$('#txtOrdenCompraID_movimientos_entradas_insumos_mercadotecnia').val('');
    				//Habilitamos el botón para agregar insumos a una entrada
    				$('#btnAgregar_movimientos_entradas_insumos_mercadotecnia').prop('disabled', false);
    				//Habilitamos el textinput de Proveedores
    				$('#txtProveedor_movimientos_entradas_insumos_mercadotecnia').prop('disabled', false);
    				$('#txtProveedorID_movimientos_entradas_insumos_mercadotecnia').val('');
    				$('#txtProveedor_movimientos_entradas_insumos_mercadotecnia').val('');
    				$('#txtProveedor_movimientos_entradas_insumos_mercadotecnia').focus();
    				//Eliminar los datos de la tabla detalles de la orden de compra
		    		$('#dg_detalles_movimientos_entradas_insumos_mercadotecnia tbody').empty();
		    		$('#acumCantidad_detalles_movimientos_entradas_insumos_mercadotecnia').html(0);
				    $('#acumDescuento_detalles_movimientos_entradas_insumos_mercadotecnia').html('$0.00');
				    $('#acumSubtotal_detalles_movimientos_entradas_insumos_mercadotecnia').html('$0.00');
				    $('#acumIva_detalles_movimientos_entradas_insumos_mercadotecnia').html('$0.00');
				    $('#acumIeps_detalles_movimientos_entradas_insumos_mercadotecnia').html('$0.00');
				    $('#acumTotal_detalles_movimientos_entradas_insumos_mercadotecnia').html('$0.00');
					$('#numElementos_detalles_movimientos_entradas_insumos_mercadotecnia').html(0);

    			}
  			});

	        //Autocomplete para recuperar los datos de un proveedor
	        $('#txtProveedor_movimientos_entradas_insumos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtProveedorID_movimientos_entradas_insumos_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/proveedores/autocomplete",
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
	             $('#txtProveedorID_movimientos_entradas_insumos_mercadotecnia').val(ui.item.data);
	             
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Autocomplete para recuperar los datos de un insumo en el catálogo
	        $('#txtInsumo_detalles_movimientos_entradas_insumos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtInsumoID_detalles_movimientos_entradas_insumos_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "mercadotecnia/insumos/autocomplete",
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
	             $('#txtInsumoID_detalles_movimientos_entradas_insumos_mercadotecnia').val(ui.item.insumo_id);
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
			$('#dteFechaInicialBusq_movimientos_entradas_insumos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_movimientos_entradas_insumos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_movimientos_entradas_insumos_mercadotecnia').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_movimientos_entradas_insumos_mercadotecnia').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_movimientos_entradas_insumos_mercadotecnia').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_movimientos_entradas_insumos_mercadotecnia').data('DateTimePicker').maxDate(e.date);
			});

			//Paginación de registros
			$('#pagLinks_movimientos_entradas_insumos_mercadotecnia').on('click','a',function(event){
				event.preventDefault();
				intPaginaMovimientosInsumosMercadotecnia = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_movimientos_entradas_insumos_mercadotecnia();
			});

			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedorBusq_movimientos_entradas_insumos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtProveedorBusqID_movimientos_entradas_insumos_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/proveedores/autocomplete",
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
	             $('#txtProveedorBusqID_movimientos_entradas_insumos_mercadotecnia').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('cuentas_pagar/proveedores/get_datos',
	                  { 
	                  	intProveedorID:$("#txtProveedorBusqID_movimientos_entradas_insumos_mercadotecnia").val()
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtProveedorIDBusq_movimientos_entradas_insumos_mercadotecnia").val(data.row.proveedor_id);
	                       $("#txtProveedorBusq_movimientos_entradas_insumos_mercadotecnia").val(data.row.nombre_comercial);
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
			$('#btnNuevo_movimientos_entradas_insumos_mercadotecnia').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_movimientos_entradas_insumos_mercadotecnia('Nuevo');
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_movimientos_entradas_insumos_mercadotecnia').addClass("estatus-NUEVO");
				//Abrir modal
				 objMovimientosInsumosMercadotecnia = $('#MovimientosInsumosMercadotecniaBox').bPopup({
											   appendTo: '#MovimientosInsumosMercadotecniaContent', 
				                               contentContainer: 'MovimientosInsumosMercadotecniaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#cmbMonedaID_movimientos_entradas_insumos_mercadotecnia').focus();
				
			});

			//Enfocar caja de texto
			$('#txtBusqueda_movimientos_entradas_insumos_mercadotecnia').focus();

			//Deshabilitar los siguientes botones (funciones de permisos de acceso)
			$('#btnNuevo_movimientos_entradas_insumos_mercadotecnia').attr('disabled','-1');  
			$('#btnImprimir_movimientos_entradas_insumos_mercadotecnia').attr('disabled','-1');
			$('#btnDescargarXLS_movimientos_entradas_insumos_mercadotecnia').attr('disabled','-1');
			$('#btnBuscar_movimientos_entradas_insumos_mercadotecnia').attr('disabled','-1');
			$('#btnGuardar_movimientos_entradas_insumos_mercadotecnia').attr('disabled','-1');
			$('#btnImprimirRegistro_movimientos_entradas_insumos_mercadotecnia').attr('disabled','-1');
			$('#btnDescargarArchivo_movimientos_entradas_insumos_mercadotecnia').attr('disabled','-1');
			$('#btnDesactivar_movimientos_entradas_insumos_mercadotecnia').attr('disabled','-1');
			$('#btnRestaurar_movimientos_entradas_insumos_mercadotecnia').attr('disabled','-1');   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_movimientos_entradas_insumos_mercadotecnia();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_movimientos_entradas_insumos_mercadotecnia();
		});
	</script>