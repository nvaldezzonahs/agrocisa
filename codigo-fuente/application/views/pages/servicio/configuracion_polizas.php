		<div id="ConfiguracionPolizasServicioContent">
		<!--Panel que contiene formulario-->
    	<div class="panel-modal-sin-barra">
    		<!--Estilo que se utiliza para mostrar los nombres de las columnas de la tabla en el dispositivo móvil -->
			<style>
				@media (max-width: 480px) 
				{
				    /*
					Definir columnas de la tabla cuentas de IEPS
					*/
					td.movil.a1:nth-of-type(1):before {content: "IEPS"; font-weight: bold;}
					td.movil.a2:nth-of-type(2):before {content: "Cuenta"; font-weight: bold;}
					td.movil.a3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}

					/*
					Definir columnas de la tabla cuentas de monedas
					*/
					td.movil.b1:nth-of-type(1):before {content: "Moneda"; font-weight: bold;}
					td.movil.b2:nth-of-type(2):before {content: "Cuenta"; font-weight: bold;}
					td.movil.b3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}

					/*
					Definir columnas de la tabla cuentas de departamentos
					*/
					td.movil.c1:nth-of-type(1):before {content: "Módulo"; font-weight: bold;}
					td.movil.c2:nth-of-type(2):before {content: "Referencia"; font-weight: bold;}
					td.movil.c3:nth-of-type(3):before {content: "Cuenta"; font-weight: bold;}
					td.movil.c4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

					/*
					Definir columnas de la tabla procesos
					*/
					td.movil.d1:nth-of-type(1):before {content: "Módulo"; font-weight: bold;}
					td.movil.d2:nth-of-type(2):before {content: "Referencia"; font-weight: bold;}
					td.movil.d3:nth-of-type(3):before {content: "Proceso"; font-weight: bold;}
					td.movil.d4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

					/*
					Definir columnas de la tabla módulos
					*/
					td.movil.e1:nth-of-type(1):before {content: "Módulo"; font-weight: bold;}
					td.movil.e2:nth-of-type(2):before {content: "Referencia"; font-weight: bold;}
					td.movil.e3:nth-of-type(3):before {content: "Cuenta"; font-weight: bold;}
					td.movil.e4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

					/*
					Definir columnas de la tabla cuentas bancarias
					*/
					td.movil.f1:nth-of-type(1):before {content: "Cuenta bancaria"; font-weight: bold;}
					td.movil.f2:nth-of-type(2):before {content: "Referencia"; font-weight: bold;}
					td.movil.f3:nth-of-type(3):before {content: "Cuenta"; font-weight: bold;}
					td.movil.f4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
					
				}
			</style>
    		<!--Tabs-->
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					<div class="form-group">
						<ul class="nav nav-tabs  nav-justified" id="tabs_configuracion_polizas_servicio" role="tablist">
							<!--Tab que contiene la información de las cuentas de IEPS-->
							<li id="tabCtasIeps_configuracion_polizas_servicio" class="active">
								<a data-toggle="tab" href="#ctas_ieps_configuracion_polizas_servicio">IEPS</a>
							</li>
							<!--Tab que contiene la información de las cuentas de monedas-->
							<li id="tabCtasMonedas_configuracion_polizas_servicio">
								<a data-toggle="tab" href="#ctas_monedas_configuracion_polizas_servicio">Monedas</a>
							</li>
							<!--Tab que contiene la información de las cuentas de líneas de maquinaria-->
							<li id="tabCtasMaquinariaLineas_configuracion_polizas_servicio">
								<a data-toggle="tab" href="#ctas_departamentos_configuracion_polizas_servicio">Departamentos</a>
							</li>
							<!--Tab que contiene la información de los procesos-->
							<li id="tabProcesos_configuracion_polizas_servicio">
								<a data-toggle="tab" href="#procesos_configuracion_polizas_servicio">Procesos</a>
							</li>
							<!--Tab que contiene la información de las cuentas de módulos-->
							<li id="tabCtasModulos_configuracion_polizas_servicio">
								<a data-toggle="tab" href="#ctas_modulos_configuracion_polizas_servicio">Módulos</a>
							</li>
							<!--Tab que contiene la información de las cuentas de cuentas bancarias-->
							<li id="tabCtasCtasBancarias_configuracion_polizas_servicio">
								<a data-toggle="tab" href="#ctas_ctas_bancarias_configuracion_polizas_servicio">Cuentas bancarias</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!--Diseño del formulario-->
			<form id="frmConfiguracionPolizasServicio" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmConfiguracionPolizasServicio" onsubmit="return(false)" autocomplete="off">
				<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
				<div class="tab-content">
					<!--Tab - Cuentas de IEPS-->
					<div id="ctas_ieps_configuracion_polizas_servicio" class="tab-pane fade in active">
						<div class="row">
							<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
							<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
										<input id="txtConfiguracionID_ctas_ieps_configuracion_polizas_servicio" name="intConfiguracionID_ctas_ieps_configuracion_polizas_servicio"  
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
										<input id="txtTasaCuotaID_ctas_ieps_configuracion_polizas_servicio" 
											   name="intTasaCuotaID_ctas_ieps_configuracion_polizas_servicio" 
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta que se utiliza para recuperar la tasa anterior y así evitar duplicidad en caso de que exista otro registro con la misma tasa-->
										<input id="txtTasaCuotaIDAnterior_ctas_ieps_configuracion_polizas_servicio" name="intTasaCuotaIDAnterior_ctas_ieps_configuracion_polizas_servicio"  
											   type="hidden" value="">
										</input>
										<label for="txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio">IEPS %</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio" 
												name="intPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio" type="text" value="" 
												tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
										</input>
									</div>
								</div>
							</div>
							<!--Cuenta-->
							<div class="col-sm-5 col-md-5 col-lg-5 col-xs-10">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtCuenta_ctas_ieps_configuracion_polizas_servicio">Cuenta</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtCuenta_ctas_ieps_configuracion_polizas_servicio" 
												name="strCuenta_ctas_ieps_configuracion_polizas_servicio" type="text" value="" tabindex="1" placeholder="Ingrese cuenta" maxlength="5">
										</input>
									</div>
								</div>
							</div>
							<!--Botón agregar-->
                          	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                            	<button class="btn btn-primary btn-toolBtns pull-right" 
                            			id="btnAgregar_ctas_ieps_configuracion_polizas_servicio" 
                            			onclick="guardar_ctas_ieps_configuracion_polizas_servicio();" 
                            	     	title="Agregar" tabindex="1" disabled> 
                            		<span class="glyphicon glyphicon-plus"></span>
                            	</button>
                         	</div>
						</div>
						<div class="form-group row">
							<!--Div que contiene la tabla con los registros encontrados-->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<!-- Diseño de la tabla-->
								<table class="table-hover movil" id="dg_ctas_ieps_configuracion_polizas_servicio">
									<thead class="movil">
										<tr class="movil">
											<th class="movil">IEPS</th>
											<th class="movil">Cuenta</th>
											<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
										</tr>
									</thead>
									<tbody class="movil"></tbody>
									<script id="plantilla_ctas_ieps_configuracion_polizas_servicio" type="text/template"> 
									{{#rows}}
										<tr class="movil {{estiloRegistro}}">   
											<td class="movil a1">{{porcentaje_ieps}}</td>
											<td class="movil a2">{{cuenta}}</td>
											<td class="td-center movil a3"> 
												<!--Editar registro-->
												<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
														onclick="editar_ctas_ieps_configuracion_polizas_servicio({{configuracion_id}}, 'id')"  
														title="Editar">
													<span class="glyphicon glyphicon-edit"></span>
												</button>
												<!--Eliminar registro-->
				                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminar}}" 
				                            			 onclick="eliminar_ctas_ieps_configuracion_polizas_servicio({{configuracion_id}});" title="Eliminar">
				                            		<span class="glyphicon glyphicon-trash"></span>
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
									<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ctas_ieps_configuracion_polizas_servicio"></div>
									<!--Número de registros encontrados-->
									<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
										<button class="btn btn-default btn-sm disabled pull-right">
											<strong id="numElementos_ctas_ieps_configuracion_polizas_servicio">0</strong> encontrados
										</button>
									</div>
								</div>
							</div>
						</div>
				    </div><!--Cierre Tab - Cuentas de IEPS-->
			    	<!--Tab - Cuentas de monedas -->
                   	<div id="ctas_monedas_configuracion_polizas_servicio" class="tab-pane fade">
                   		<div class="row">
							<!--Combobox que contiene las monedas activas-->
							<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
										<input id="txtConfiguracionID_ctas_monedas_configuracion_polizas_servicio" name="intConfiguracionID_ctas_monedas_configuracion_polizas_servicio"  
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta que se utiliza para recuperar la moneda anterior y así evitar duplicidad en caso de que exista otro registro con la misma moneda-->
										<input id="txtMonedaIDAnterior_ctas_monedas_configuracion_polizas_servicio" 
											   name="intMonedaIDAnterior_ctas_monedas_configuracion_polizas_servicio" type="hidden" value="">
										</input>
										<label for="cmbMonedaID_ctas_monedas_configuracion_polizas_servicio">Moneda</label>
									</div>
									<div id="divCmbMsjValidacion" class="col-md-12">
										<select class="form-control" id="cmbMonedaID_ctas_monedas_configuracion_polizas_servicio" 
										 		name="intMonedaID_ctas_monedas_configuracion_polizas_servicio" tabindex="1">
	                     				</select>
									</div>
								</div>
							</div>
							<!--Cuenta-->
							<div class="col-sm-5 col-md-5 col-lg-5 col-xs-10">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtCuenta_ctas_monedas_configuracion_polizas_servicio">Cuenta</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtCuenta_ctas_monedas_configuracion_polizas_servicio" 
												name="strCuenta_ctas_monedas_configuracion_polizas_servicio" type="text" value="" 
												tabindex="1" placeholder="Ingrese cuenta" maxlength="5">
										</input>
									</div>
								</div>
							</div>
							<!--Botón agregar-->
                          	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                            	<button class="btn btn-primary btn-toolBtns pull-right" 
                            			id="btnAgregar_ctas_monedas_configuracion_polizas_servicio"
                            			onclick="guardar_ctas_monedas_configuracion_polizas_servicio();" 
                            	     	title="Agregar" tabindex="1" disabled> 
                            		<span class="glyphicon glyphicon-plus"></span>
                            	</button>
                         	</div>
					    </div>
					   <div class="form-group row">
							<!--Div que contiene la tabla con los registros encontrados-->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<!-- Diseño de la tabla-->
								<table class="table-hover movil" id="dg_ctas_monedas_configuracion_polizas_servicio">
									<thead class="movil">
										<tr class="movil">
											<th class="movil">Moneda</th>
											<th class="movil">Cuenta</th>
											<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
										</tr>
									</thead>
									<tbody class="movil"></tbody>
									<script id="plantilla_ctas_monedas_configuracion_polizas_servicio" type="text/template"> 
									{{#rows}}
										<tr class="movil {{estiloRegistro}}">   
											<td class="movil b1">{{moneda}}</td>
											<td class="movil b2">{{cuenta}}</td>
											<td class="td-center movil b3"> 
												<!--Editar registro-->
												<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
														onclick="editar_ctas_monedas_configuracion_polizas_servicio({{configuracion_id}}, 'id')"  
														title="Editar">
													<span class="glyphicon glyphicon-edit"></span>
												</button>
												<!--Eliminar registro-->
				                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminar}}" 
				                            			 onclick="eliminar_ctas_monedas_configuracion_polizas_servicio({{configuracion_id}});" title="Eliminar">
				                            		<span class="glyphicon glyphicon-trash"></span>
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
									<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ctas_monedas_configuracion_polizas_servicio"></div>
									<!--Número de registros encontrados-->
									<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
										<button class="btn btn-default btn-sm disabled pull-right">
											<strong id="numElementos_ctas_monedas_configuracion_polizas_servicio">0</strong> encontrados
										</button>
									</div>
								</div>
							</div>
						</div>
                    </div><!--Cierre Tab - Cuentas de monedas-->
                    <!--Tab - Cuentas de departamentos -->
                   	<div id="ctas_departamentos_configuracion_polizas_servicio" class="tab-pane fade">
                    	<div class="row">
                    		<!--Tipo de referencia-->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
										<input id="txtConfiguracionID_ctas_departamentos_configuracion_polizas_servicio" name="intConfiguracionID_ctas_departamentos_configuracion_polizas_servicio"  
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta que se utiliza para recuperar el tipo de referencia anterior y así evitar duplicidad en caso de que exista otro registro con la misma referencia en el módulo-->
										<input id="txtTipoReferenciaAnterior_ctas_departamentos_configuracion_polizas_servicio" 
											   name="strTipoReferenciaAnterior_ctas_departamentos_configuracion_polizas_servicio" 
											   type="hidden" value="">
										</input>
										<label for="cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio">Módulo</label>
									</div>
									<div id="divCmbMsjValidacion" class="col-md-12">
										<select class="form-control" id="cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio" 
										 		name="strTipoReferencia_ctas_departamentos_configuracion_polizas_servicio" tabindex="1">
										 	<option value="">Seleccione una opción</option>
	                          				<option value="MAQUINARIA">MAQUINARIA</option>
	                          				<option value="REFACCIONES">REFACCIONES</option>
	                          				<option value="VEHICULOS">VEHÍCULOS</option>
	                          				<option value="CUENTAS POR COBRAR">CUENTAS POR COBRAR</option>
	                     				</select>
									</div>
								</div>
							</div>
							<!--Combobox que contiene las referencias-->
							<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id de la referencia anterior y así evitar duplicidad en caso de que exista otro registro con la misma referencia en el módulo-->
										<input id="txtReferenciaIDAnterior_ctas_departamentos_configuracion_polizas_servicio" 
											   name="intReferenciaIDAnterior_ctas_departamentos_configuracion_polizas_servicio" 
											   type="hidden" value="">
										<label for="cmbReferenciaID_ctas_departamentos_configuracion_polizas_servicio">Referencia</label>
									</div>
									<div id="divCmbMsjValidacion" class="col-md-12">
										<select class="form-control" id="cmbReferenciaID_ctas_departamentos_configuracion_polizas_servicio" 
										 		name="intReferenciaID_ctas_departamentos_configuracion_polizas_servicio" tabindex="1">
	                     				</select>
									</div>
								</div>
							</div>
							<!--Cuenta-->
							<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtCuenta_ctas_departamentos_configuracion_polizas_servicio">Cuenta</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtCuenta_ctas_departamentos_configuracion_polizas_servicio" 
												name="strCuenta_ctas_departamentos_configuracion_polizas_servicio" type="text" value="" 
												tabindex="1" placeholder="Ingrese cuenta" maxlength="250">
										</input>
									</div>
								</div>
							</div>
							<!--Botón agregar-->
                          	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            	<button class="btn btn-primary pull-right" 
                            			id="btnAgregar_ctas_departamentos_configuracion_polizas_servicio"
                            			onclick="guardar_ctas_departamentos_configuracion_polizas_servicio();" 
                            	     	title="Agregar" tabindex="1" disabled> 
                            		<span class="glyphicon glyphicon-plus"></span>
                            	</button>
                         	</div>
					    </div>
					    <br>
					   <div class="form-group row">
							<!--Div que contiene la tabla con los registros encontrados-->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<!-- Diseño de la tabla-->
								<table class="table-hover movil" id="dg_ctas_departamentos_configuracion_polizas_servicio">
									<thead class="movil">
										<tr class="movil">
											<th class="movil">Módulo</th>
											<th class="movil">Referencia</th>
											<th class="movil">Cuenta</th>
											<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
										</tr>
									</thead>
									<tbody class="movil"></tbody>
									<script id="plantilla_ctas_departamentos_configuracion_polizas_servicio" type="text/template"> 
									{{#rows}}
										<tr class="movil {{estiloRegistro}}">   
											<td class="movil c1">{{tipo_referencia}}</td>
											<td class="movil c2">{{referencia}}</td>
											<td class="movil c3">{{cuenta}}</td>
											<td class="td-center movil c4"> 
												<!--Editar registro-->
												<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
														onclick="editar_ctas_departamentos_configuracion_polizas_servicio({{configuracion_id}}, 'id')"  
														title="Editar">
													<span class="glyphicon glyphicon-edit"></span>
												</button>
												<!--Eliminar registro-->
				                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminar}}" 
				                            			 onclick="eliminar_ctas_departamentos_configuracion_polizas_servicio({{configuracion_id}});" title="Eliminar">
				                            		<span class="glyphicon glyphicon-trash"></span>
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
									<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ctas_departamentos_configuracion_polizas_servicio"></div>
									<!--Número de registros encontrados-->
									<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
										<button class="btn btn-default btn-sm disabled pull-right">
											<strong id="numElementos_ctas_departamentos_configuracion_polizas_servicio">0</strong> encontrados
										</button>
									</div>
								</div>
							</div>
						</div>
                    </div><!--Cierre Tab  Cuentas de departamentos-->
                    <!--Tab - Procesos -->
                   	<div id="procesos_configuracion_polizas_servicio" class="tab-pane fade">
                   		<div class="row">
                   			<!--Tipo de referencia-->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
										<input id="txtConfiguracionID_procesos_configuracion_polizas_servicio" name="intConfiguracionID_procesos_configuracion_polizas_servicio"  
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta que se utiliza para recuperar el tipo de referencia anterior y así evitar duplicidad en caso de que exista otro registro con la misma referencia en el módulo-->
										<input id="txtTipoReferenciaAnterior_procesos_configuracion_polizas_servicio" 
											   name="strTipoReferenciaAnterior_procesos_configuracion_polizas_servicio" 
											   type="hidden" value="">
										</input>
										<label for="cmbTipoReferencia_procesos_configuracion_polizas_servicio">Módulo</label>
									</div>
									<div id="divCmbMsjValidacion" class="col-md-12">
										<select class="form-control" id="cmbTipoReferencia_procesos_configuracion_polizas_servicio" 
										 		name="strTipoReferencia_procesos_configuracion_polizas_servicio" tabindex="1">
										 	<option value="">Seleccione una opción</option>
	                          				<option value="SERVICIO">SERVICIO</option>
	                          				<option value="MAQUINARIA">MAQUINARIA</option>
	                          				<option value="REFACCIONES">REFACCIONES</option>
	                          				<option value="CONTROL DE VEHICULOS">CONTROL DE VEHICULOS</option>
	                     				</select>
									</div>
								</div>
							</div>
							<!--Combobox que contiene las referencias-->
							<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id de la referencia anterior y así evitar duplicidad en caso de que exista otro registro con la misma referencia en el módulo-->
										<input id="txtReferenciaIDAnterior_procesos_configuracion_polizas_servicio" 
											   name="intReferenciaIDAnterior_procesos_configuracion_polizas_servicio" 
											   type="hidden" value="">
										<label for="cmbReferenciaID_procesos_configuracion_polizas_servicio">Referencia</label>
									</div>
									<div id="divCmbMsjValidacion" class="col-md-12">
										<select class="form-control" id="cmbReferenciaID_procesos_configuracion_polizas_servicio" 
										 		name="intReferenciaID_procesos_configuracion_polizas_servicio" tabindex="1">
	                     				</select>
									</div>
								</div>
							</div>
							<!--Proceso-->
							<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtProceso_procesos_configuracion_polizas_servicio">Proceso</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtProceso_procesos_configuracion_polizas_servicio" 
												name="strProceso_procesos_configuracion_polizas_servicio" type="text" value="" 
												tabindex="1" placeholder="Ingrese proceso" maxlength="250">
										</input>
									</div>
								</div>
							</div>
							<!--Botón agregar-->
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            	<button class="btn btn-primary pull-right" 
                            			id="btnAgregar_procesos_configuracion_polizas_servicio"
                            			onclick="guardar_procesos_configuracion_polizas_servicio();" 
                            	     	title="Agregar" tabindex="1" disabled> 
                            		<span class="glyphicon glyphicon-plus"></span>
                            	</button>
                         	</div>
					    </div>
					    <br>
					   <div class="form-group row">
							<!--Div que contiene la tabla con los servicios encontrados-->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<!-- Diseño de la tabla-->
								<table class="table-hover movil" id="dg_procesos_configuracion_polizas_servicio">
									<thead class="movil">
										<tr class="movil">
											<th class="movil">Módulo</th>
											<th class="movil">Referencia</th>
											<th class="movil">Proceso</th>
											<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
										</tr>
									</thead>
									<tbody class="movil"></tbody>
									<script id="plantilla_procesos_configuracion_polizas_servicio" type="text/template"> 
									{{#rows}}
										<tr class="movil {{estiloRegistro}}">   
											<td class="movil d1">{{tipo_referencia}}</td>
											<td class="movil d2">{{referencia}}</td>
											<td class="movil d3">{{proceso}}</td>
											<td class="td-center movil d4"> 
												<!--Editar registro-->
												<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
														onclick="editar_procesos_configuracion_polizas_servicio({{configuracion_id}}, 'id')"  
														title="Editar">
													<span class="glyphicon glyphicon-edit"></span>
												</button>
												<!--Eliminar registro-->
				                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminar}}" 
				                            			 onclick="eliminar_procesos_configuracion_polizas_servicio({{configuracion_id}});" title="Eliminar">
				                            		<span class="glyphicon glyphicon-trash"></span>
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
									<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_procesos_configuracion_polizas_servicio"></div>
									<!--Número de registros encontrados-->
									<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
										<button class="btn btn-default btn-sm disabled pull-right">
											<strong id="numElementos_procesos_configuracion_polizas_servicio">0</strong> encontrados
										</button>
									</div>
								</div>
							</div>
						</div>
                    </div><!--Cierre Tab - Procesos-->
                    <!--Tab - Cuentas de modulos -->
                   	<div id="ctas_modulos_configuracion_polizas_servicio" class="tab-pane fade">
                   		<div class="row">
							<!--Combobox que contiene los modulos activos-->
							<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
										<input id="txtConfiguracionID_ctas_modulos_configuracion_polizas_servicio" name="intConfiguracionID_ctas_modulos_configuracion_polizas_servicio"  
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta que se utiliza para recuperar el módulo anterior y así evitar duplicidad en caso de que exista otro registro con el mismo módulo-->
										<input id="txtModuloIDAnterior_ctas_modulos_configuracion_polizas_servicio" 
											   name="intModuloIDAnterior_ctas_modulos_configuracion_polizas_servicio" type="hidden" value="">
										</input>
										<label for="cmbModuloID_ctas_modulos_configuracion_polizas_servicio">Módulo</label>
									</div>
									<div id="divCmbMsjValidacion" class="col-md-12">
										<select class="form-control" id="cmbModuloID_ctas_modulos_configuracion_polizas_servicio" 
										 		name="intModuloID_ctas_modulos_configuracion_polizas_servicio" tabindex="1">
	                     				</select>
									</div>
								</div>
							</div>
							<!--Tipo de referencia-->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el tipo de referencia anterior y así evitar duplicidad en caso de que exista otro registro con la misma referencia en el módulo-->
										<input id="txtTipoReferenciaAnterior_ctas_modulos_configuracion_polizas_servicio" 
											   name="strTipoReferenciaAnterior_ctas_modulos_configuracion_polizas_servicio" 
											   type="hidden" value="">
										</input>
										<label for="cmbTipoReferencia_ctas_modulos_configuracion_polizas_servicio">Referencia</label>
									</div>
									<div id="divCmbMsjValidacion" class="col-md-12">
										<select class="form-control" id="cmbTipoReferencia_ctas_modulos_configuracion_polizas_servicio" 
										 		name="strTipoReferencia_ctas_modulos_configuracion_polizas_servicio" tabindex="1">
										 	<option value="">Seleccione una opción</option>
	                          				<option value="GENERAL">GENERAL</option>
	                          				<option value="DESCUENTOS">DESCUENTOS</option>
	                          				<option value="CLIENTE TASA16">CLIENTE TASA 16%</option>
	                          				<option value="CLIENTE TASA0">CLIENTE TASA 0%</option>
	                     				</select>
									</div>
								</div>
							</div>
							<!--Cuenta-->
							<div class="col-sm-4 col-md-4 col-lg-4 col-xs-10">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtCuenta_ctas_modulos_configuracion_polizas_servicio">Cuenta</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtCuenta_ctas_modulos_configuracion_polizas_servicio" 
												name="strCuenta_ctas_modulos_configuracion_polizas_servicio" type="text" value="" 
												tabindex="1" placeholder="Ingrese cuenta" maxlength="5">
										</input>
									</div>
								</div>
							</div>
							<!--Botón agregar-->
                          	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                            	<button class="btn btn-primary btn-toolBtns pull-right" 
                            			id="btnAgregar_ctas_modulos_configuracion_polizas_servicio"
                            			onclick="guardar_ctas_modulos_configuracion_polizas_servicio();" 
                            	     	title="Agregar" tabindex="1" disabled> 
                            		<span class="glyphicon glyphicon-plus"></span>
                            	</button>
                         	</div>
					    </div>
					   <div class="form-group row">
							<!--Div que contiene la tabla con los registros encontrados-->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<!-- Diseño de la tabla-->
								<table class="table-hover movil" id="dg_ctas_modulos_configuracion_polizas_servicio">
									<thead class="movil">
										<tr class="movil">
											<th class="movil">Módulo</th>
											<th class="movil">Referencia</th>
											<th class="movil">Cuenta</th>
											<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
										</tr>
									</thead>
									<tbody class="movil"></tbody>
									<script id="plantilla_ctas_modulos_configuracion_polizas_servicio" type="text/template"> 
									{{#rows}}
										<tr class="movil {{estiloRegistro}}">   
											<td class="movil e1">{{modulo}}</td>
											<td class="movil e2">{{referencia}}</td>
											<td class="movil e3">{{cuenta}}</td>
											<td class="td-center movil e4"> 
												<!--Editar registro-->
												<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
														onclick="editar_ctas_modulos_configuracion_polizas_servicio({{configuracion_id}}, 'id')"  
														title="Editar">
													<span class="glyphicon glyphicon-edit"></span>
												</button>
												<!--Eliminar registro-->
				                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminar}}" 
				                            			 onclick="eliminar_ctas_modulos_configuracion_polizas_servicio({{configuracion_id}});" title="Eliminar">
				                            		<span class="glyphicon glyphicon-trash"></span>
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
									<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ctas_modulos_configuracion_polizas_servicio"></div>
									<!--Número de registros encontrados-->
									<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
										<button class="btn btn-default btn-sm disabled pull-right">
											<strong id="numElementos_ctas_modulos_configuracion_polizas_servicio">0</strong> encontrados
										</button>
									</div>
								</div>
							</div>
						</div>
                    </div><!--Cierre Tab - Cuentas de modulos-->
                     <!--Tab - Cuentas de cuentas bancarias -->
                   	<div id="ctas_ctas_bancarias_configuracion_polizas_servicio" class="tab-pane fade">
                   		<div class="row">
							<!--Autocomplete que contiene las cuentas bancarias activas-->
							<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
										<input id="txtConfiguracionID_ctas_ctas_bancarias_configuracion_polizas_servicio" name="intConfiguracionID_ctas_ctas_bancarias_configuracion_polizas_servicio"  
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta bancaria seleccionada-->
										<input 	id="txtCuentaBancariaID_ctas_ctas_bancarias_configuracion_polizas_servicio" 
												name="intCuentaBancariaID_ctas_ctas_bancarias_configuracion_polizas_servicio" 
												type="hidden" 
												value="" />
										<!-- Caja de texto oculta que se utiliza para recuperar la cuanta bancaria anterior y así evitar duplicidad en caso de que exista otro registro con la misma cuanta bancaria-->
										<input id="txtCuentaBancariaIDAnterior_ctas_ctas_bancarias_configuracion_polizas_servicio" 
											   name="intCuentaBancariaIDAnterior_ctas_ctas_bancarias_configuracion_polizas_servicio" type="hidden" value=""/>
										<label for="txtCuentaBancaria_ctas_ctas_bancarias_configuracion_polizas_servicio">Cuenta bancaria</label>
									</div>	
									<div class="col-md-12">
										<input  class="form-control" 
												id="txtCuentaBancaria_ctas_ctas_bancarias_configuracion_polizas_servicio" 
												name="strCuentaBancaria_ctas_ctas_bancarias_configuracion_polizas_servicio" 
												type="text" 
												value="" 
												tabindex="1" 
												placeholder="Ingrese cuenta bancaria" 
												maxlength="250" />
									</div>
								</div>
							</div>
							<!--Tipo de referencia-->
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta que se utiliza para recuperar el tipo de referencia anterior y así evitar duplicidad en caso de que exista otro registro con la misma referencia en el cuanta bancaria-->
										<input id="txtTipoReferenciaAnterior_ctas_ctas_bancarias_configuracion_polizas_servicio" 
											   name="strTipoReferenciaAnterior_ctas_ctas_bancarias_configuracion_polizas_servicio" 
											   type="hidden" value="">
										</input>
										<label for="cmbTipoReferencia_ctas_ctas_bancarias_configuracion_polizas_servicio">Referencia</label>
									</div>
									<div id="divCmbMsjValidacion" class="col-md-12">
										<select class="form-control" id="cmbTipoReferencia_ctas_ctas_bancarias_configuracion_polizas_servicio" 
										 		name="strTipoReferencia_ctas_ctas_bancarias_configuracion_polizas_servicio" tabindex="1">
										 	<option value="">Seleccione una opción</option>
	                          				<option value="BANCO">BANCO</option>
	                          				<option value="USD">USD</option>
	                     				</select>
									</div>
								</div>
							</div>
							<!--Cuenta-->
							<div class="col-sm-4 col-md-4 col-lg-4 col-xs-10">
								<div class="form-group">
									<div class="col-md-12">
										<label for="txtCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio">Cuenta</label>
									</div>
									<div class="col-md-12">
										<input  class="form-control" id="txtCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio" 
												name="strCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio" type="text" value="" 
												tabindex="1" placeholder="Ingrese cuenta" maxlength="5">
										</input>
									</div>
								</div>
							</div>
							<!--Botón agregar-->
                          	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                            	<button class="btn btn-primary btn-toolBtns pull-right" 
                            			id="btnAgregar_ctas_ctas_bancarias_configuracion_polizas_servicio"
                            			onclick="guardar_ctas_ctas_bancarias_configuracion_polizas_servicio();" 
                            	     	title="Agregar" tabindex="1" disabled> 
                            		<span class="glyphicon glyphicon-plus"></span>
                            	</button>
                         	</div>
					    </div>
					   <div class="form-group row">
							<!--Div que contiene la tabla con los registros encontrados-->
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<!-- Diseño de la tabla-->
								<table class="table-hover movil" id="dg_ctas_ctas_bancarias_configuracion_polizas_servicio">
									<thead class="movil">
										<tr class="movil">
											<th class="movil">Cuenta bancaria</th>
											<th class="movil">Referencia</th>
											<th class="movil">Cuenta</th>
											<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
										</tr>
									</thead>
									<tbody class="movil"></tbody>
									<script id="plantilla_ctas_ctas_bancarias_configuracion_polizas_servicio" type="text/template"> 
									{{#rows}}
										<tr class="movil {{estiloRegistro}}">   
											<td class="movil f1">{{cuenta_bancaria}}</td>
											<td class="movil f2">{{tipo_referencia}}</td>
											<td class="movil f3">{{cuenta}}</td>
											<td class="td-center movil f4"> 
												<!--Editar registro-->
												<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
														onclick="editar_ctas_ctas_bancarias_configuracion_polizas_servicio({{configuracion_id}}, 'id')"  
														title="Editar">
													<span class="glyphicon glyphicon-edit"></span>
												</button>
												<!--Eliminar registro-->
				                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminar}}" 
				                            			 onclick="eliminar_ctas_ctas_bancarias_configuracion_polizas_servicio({{configuracion_id}});" title="Eliminar">
				                            		<span class="glyphicon glyphicon-trash"></span>
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
									<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ctas_ctas_bancarias_configuracion_polizas_servicio"></div>
									<!--Número de registros encontrados-->
									<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
										<button class="btn btn-default btn-sm disabled pull-right">
											<strong id="numElementos_ctas_ctas_bancarias_configuracion_polizas_servicio">0</strong> encontrados
										</button>
									</div>
								</div>
							</div>
						</div>
                    </div><!--Cierre Tab - Cuentas de cuentas bancarias-->
			    </div><!--Cierre del contenedor de tabs-->
			    <!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Generar PDF con los datos del registro-->
                    	<button class="btn btn-default" type="button" id="btnImprimir_configuracion_polizas_servicio" 
                    			onclick="reporte_configuracion_polizas_servicio('PDF');" title="Imprimir reporte general en PDF" tabindex="3" disabled>
                    		<span class="glyphicon glyphicon-print"></span>
                    	</button>
                    	<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-default"  id="btnDescargarXLS_configuracion_polizas_servicio"
								onclick="reporte_configuracion_polizas_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
							<span class="fa fa-file-excel-o"></span>
						</button>  
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenedor del formulario--> 
	</div><!--#ConfiguracionPolizasServicioContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_configuracion_polizas_servicio" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>

	<script id="referencias_configuracion_polizas_servicio" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#referencias}}
		<option value="{{value}}">{{nombre}}</option>
		{{/referencias}} 
	</script>

	<!-- /.Plantilla para cargar los módulos en el combobox-->  
	<script id="modulos_configuracion_polizas_servicio" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#modulos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/modulos}} 
	</script>

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros de IEPS
		var intPaginaCtasIepsConfiguracionPolizasServicio = 0;
		//Variables que se utilizan para la paginación de registros de monedas
		var intPaginaCtasMonedasConfiguracionPolizasServicio = 0;
		//Variables que se utilizan para la paginación de registros de departamentos
		var intPaginaCtasDeptoConfiguracionPolizasServicio = 0;
		//Variables que se utilizan para la paginación de registros de procesos
		var intPaginaProcesosConfiguracionPolizasServicio = 0;
		//Variables que se utilizan para la paginación de registros de módulos
		var intPaginaCtasModulosConfiguracionPolizasServicio = 0;
		//Variables que se utilizan para la paginación de registros de cuentas bancarias
		var intPaginaCtasCtasBancariasConfiguracionPolizasServicio = 0;

		//Variables que se utilizan para la paginación de registros de procesos
		var strTablaCtasIepsConfiguracionPolizasServicio = 'configuracion_ieps';
	    var strTablaCtasMonedasConfiguracionPolizasServicio = 'configuracion_monedas';
	    var strTablaCtasDeptoConfiguracionPolizasServicio = 'configuracion_departamentos';
	    var strTablaProcesosConfiguracionPolizasServicio = 'configuracion_procesos';
	    var strTablaCtasModulosConfiguracionPolizasServicio = 'configuracion_modulos';
	    var strTablaCtasCtasBancariasConfiguracionPolizasServicio = 'configuracion_cuentas_bancarias';



		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_configuracion_polizas_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/configuracion_polizas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_configuracion_polizas_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosConfiguracionPolizasServicio = data.row;
					//Separar la cadena 
					var arrPermisosConfiguracionPolizasServicio = strPermisosConfiguracionPolizasServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosConfiguracionPolizasServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if((arrPermisosConfiguracionPolizasServicio[i]=='GUARDAR') || (arrPermisosConfiguracionPolizasServicio[i]=='EDITAR'))
						{
							//Hacer llamado a la función  para cargar las cuentas de IEPS en el grid
							paginacion_ctas_ieps_configuracion_polizas_servicio();
							//Hacer llamado a la función  para cargar las cuentas de monedas en el grid
							paginacion_ctas_monedas_configuracion_polizas_servicio();
							//Hacer llamado a la función  para cargar las cuentas de departamentos en el grid
							paginacion_ctas_departamentos_configuracion_polizas_servicio();
							//Hacer llamado a la función  para cargar los procesos en el grid
							paginacion_procesos_configuracion_polizas_servicio();
							//Hacer llamado a la función  para cargar las cuentas de módulos en el grid
							paginacion_ctas_modulos_configuracion_polizas_servicio();
							//Hacer llamado a la función  para cargar las cuentas de cuentas bancarias en el grid
							paginacion_ctas_ctas_bancarias_configuracion_polizas_servicio();

							//Habilitar el control (botón guardar)
							$('#btnAgregar_ctas_ieps_configuracion_polizas_servicio').removeAttr('disabled');
							$('#btnAgregar_ctas_monedas_configuracion_polizas_servicio').removeAttr('disabled');

							$('#btnAgregar_ctas_departamentos_configuracion_polizas_servicio').removeAttr('disabled');
							$('#btnAgregar_procesos_configuracion_polizas_servicio').removeAttr('disabled');
							$('#btnAgregar_ctas_modulos_configuracion_polizas_servicio').removeAttr('disabled');
							$('#btnAgregar_ctas_ctas_bancarias_configuracion_polizas_servicio').removeAttr('disabled');
						}
						else if(arrPermisosConfiguracionPolizasServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_configuracion_polizas_servicio').removeAttr('disabled');
						}
						else if(arrPermisosConfiguracionPolizasServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_configuracion_polizas_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_configuracion_polizas_servicio(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/configuracion_polizas/';

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

			//Hacer un llamado al método del controlador para generar el reporte
         	window.open(strUrl);
		}


		//Función para mostrar mensaje de éxito o error
		function mensaje_configuracion_polizas_servicio(tipoMensaje, mensaje)
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
		Funciones del Tab - Cuentas de IEPS
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_ctas_ieps_configuracion_polizas_servicio() 
		{
			
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/configuracion_polizas/get_paginacion',
			{	
				intPagina:intPaginaCtasIepsConfiguracionPolizasServicio,
				strPermisosAcceso: $('#txtAcciones_configuracion_polizas_servicio').val(), 
				strTabla: strTablaCtasIepsConfiguracionPolizasServicio
			},
				function(data){
					$('#dg_ctas_ieps_configuracion_polizas_servicio tbody').empty();
					var tmpCtasIepsConfiguracionPolizasServicio = Mustache.render($('#plantilla_ctas_ieps_configuracion_polizas_servicio').html(),data);
					$('#dg_ctas_ieps_configuracion_polizas_servicio tbody').html(tmpCtasIepsConfiguracionPolizasServicio);
					$('#pagLinks_ctas_ieps_configuracion_polizas_servicio').html(data.paginacion);
					$('#numElementos_ctas_ieps_configuracion_polizas_servicio').html(data.total_rows);
					intPaginaCtasIepsConfiguracionPolizasServicio = data.pagina;
				},
			'json');
		}


		//Función para limpiar los campos del formulario
		function nuevo_ctas_ieps_configuracion_polizas_servicio()
		{
			//Limpiamos las cajas de texto
		    $('#txtConfiguracionID_ctas_ieps_configuracion_polizas_servicio').val('');
		    $('#txtTasaCuotaID_ctas_ieps_configuracion_polizas_servicio').val('');
		    $('#txtTasaCuotaIDAnterior_ctas_ieps_configuracion_polizas_servicio').val('');
		    $('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').val('');
		    $('#txtCuenta_ctas_ieps_configuracion_polizas_servicio').val('');
		    //Enfocar caja de texto
			$('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').focus();
		}


		//Función para guardar o modificar los datos de una configuración de IEPS
		function guardar_ctas_ieps_configuracion_polizas_servicio()
		{
			//Obtenemos los datos de las cajas de texto
			var intTasaCuotaIDConf = $('#txtTasaCuotaID_ctas_ieps_configuracion_polizas_servicio').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').val();
			var strCuentaConf = $('#txtCuenta_ctas_ieps_configuracion_polizas_servicio').val();
			//Validamos que se capturaron datos
			if (intTasaCuotaIDConf == '' || intPorcentajeIeps == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').focus();
			}
			else if(strCuentaConf == '')
			{
				//Enfocar caja de texto
				$('#txtCuenta_ctas_ieps_configuracion_polizas_servicio').focus();
			}
			else
			{
				//Hacer un llamado al método del controlador para guardar los datos del registro
				$.post('servicio/configuracion_polizas/guardar_configuracion_ieps',
						{ 
							intConfiguracionID: $('#txtConfiguracionID_ctas_ieps_configuracion_polizas_servicio').val(),
							intTasaCuotaID: intTasaCuotaIDConf,
							intTasaCuotaIDAnterior: $('#txtTasaCuotaIDAnterior_ctas_ieps_configuracion_polizas_servicio').val(),
							strCuenta: strCuentaConf
						},
						function(data) {
							if (data.resultado)
							{
								//Hacer un llamado a la función para limpiar los campos del formulario
								nuevo_ctas_ieps_configuracion_polizas_servicio(); 
								//Hacer llamado a la función  para cargar las cuentas de IEPS en el grid
								paginacion_ctas_ieps_configuracion_polizas_servicio();               
							}

							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				           	mensaje_configuracion_polizas_servicio(data.tipo_mensaje, data.mensaje);
							
							
						},
				'json');
			}
		}	

		//Función para eliminar los datos del registro seleccionado
		function eliminar_ctas_ieps_configuracion_polizas_servicio(id)
		{

			//Preguntar al usuario si desea eliminar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea eliminar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Configuraciones para Pólizas',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para eliminar los datos del registro
			                              $.post('servicio/configuracion_polizas/eliminar',
			                                     {intConfiguracionID: id, 
			                                      strTabla: strTablaCtasIepsConfiguracionPolizasServicio
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                        	//Hacer un llamado a la función para limpiar los campos del formulario
														nuevo_ctas_ieps_configuracion_polizas_servicio(); 
				                                        //Hacer llamado a la función  para cargar  los registros en el grid
				                                        paginacion_ctas_ieps_configuracion_polizas_servicio();
			                                        }

			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_configuracion_polizas_servicio(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });
		}
		

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ctas_ieps_configuracion_polizas_servicio(busqueda, tipoBusqueda)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/configuracion_polizas/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda, 
			       	strTabla: strTablaCtasIepsConfiguracionPolizasServicio
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ctas_ieps_configuracion_polizas_servicio();
						   
				          	//Recuperar valores
				            $('#txtConfiguracionID_ctas_ieps_configuracion_polizas_servicio').val(data.row.configuracion_id);
				            $('#txtTasaCuotaID_ctas_ieps_configuracion_polizas_servicio').val(data.row.tasa_cuota_id);
				            $('#txtTasaCuotaIDAnterior_ctas_ieps_configuracion_polizas_servicio').val(data.row.tasa_cuota_id);
				            $('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').val(data.row.porcentaje_ieps);
				            $('#txtCuenta_ctas_ieps_configuracion_polizas_servicio').val(data.row.cuenta);
				          

			       	    }
			       	    else
			       	    {
			       	    	//Limpiar contenido de las siguientes cajas de texto
			       	    	$('#txtConfiguracionID_ctas_ieps_configuracion_polizas_servicio').val('');
			       	    	$('#txtTasaCuotaIDAnterior_ctas_ieps_configuracion_polizas_servicio').val('');
			       	    	$('#txtCuenta_ctas_ieps_configuracion_polizas_servicio').val('');

			       	    }

			       	    
			       	    //Enfocar caja de texto
						$('#txtCuenta_ctas_ieps_configuracion_polizas_servicio').focus();
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_ctas_ieps_configuracion_polizas_servicio()
		{
			//Si no existe id, verificar la existencia de la tasa de IEPS
			if ($('#txtTasaCuotaID_ctas_ieps_configuracion_polizas_servicio').val() != '')
			{
				
				//Hacer un llamado a la función para recuperar los datos del registro que coincide con la tasa de IEPS 
				editar_ctas_ieps_configuracion_polizas_servicio($('#txtTasaCuotaID_ctas_ieps_configuracion_polizas_servicio').val(), 'tasa');
			}
		}


		/*******************************************************************************************************************
		Funciones del Tab - Cuentas de monedas
		*********************************************************************************************************************/
		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_ctas_monedas_configuracion_polizas_servicio()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_ctas_monedas_configuracion_polizas_servicio').empty();
					var temp = Mustache.render($('#monedas_configuracion_polizas_servicio').html(), data);
					$('#cmbMonedaID_ctas_monedas_configuracion_polizas_servicio').html(temp);
				},
				'json');
		}

		//Función para la búsqueda de registros
		function paginacion_ctas_monedas_configuracion_polizas_servicio() 
		{
			
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/configuracion_polizas/get_paginacion',
			{	
				intPagina:intPaginaCtasMonedasConfiguracionPolizasServicio,
				strPermisosAcceso: $('#txtAcciones_configuracion_polizas_servicio').val(), 
				strTabla: strTablaCtasMonedasConfiguracionPolizasServicio
			},
				function(data){
					$('#dg_ctas_monedas_configuracion_polizas_servicio tbody').empty();
					var tmpCtasMonedasConfiguracionPolizasServicio = Mustache.render($('#plantilla_ctas_monedas_configuracion_polizas_servicio').html(),data);
					$('#dg_ctas_monedas_configuracion_polizas_servicio tbody').html(tmpCtasMonedasConfiguracionPolizasServicio);
					$('#pagLinks_ctas_monedas_configuracion_polizas_servicio').html(data.paginacion);
					$('#numElementos_ctas_monedas_configuracion_polizas_servicio').html(data.total_rows);
					intPaginaCtasMonedasConfiguracionPolizasServicio = data.pagina;
				},
			'json');
		}


		//Función para limpiar los campos del formulario
		function nuevo_ctas_monedas_configuracion_polizas_servicio()
		{
			//Limpiamos las cajas de texto
		    $('#txtConfiguracionID_ctas_monedas_configuracion_polizas_servicio').val('');
		    $('#cmbMonedaID_ctas_monedas_configuracion_polizas_servicio').val('');
		    $('#txtMonedaIDAnterior_ctas_monedas_configuracion_polizas_servicio').val('');
		    $('#txtCuenta_ctas_monedas_configuracion_polizas_servicio').val('');
		    //Enfocar combobox
			$('#cmbMonedaID_ctas_monedas_configuracion_polizas_servicio').focus();
		}


		//Función para guardar o modificar los datos de una configuración de IEPS
		function guardar_ctas_monedas_configuracion_polizas_servicio()
		{
			//Obtenemos los datos de las cajas de texto
			var intMonedaIDConf = $('#cmbMonedaID_ctas_monedas_configuracion_polizas_servicio').val();
			var strCuentaConf = $('#txtCuenta_ctas_monedas_configuracion_polizas_servicio').val();

			//Validamos que se capturaron datos
			if (intMonedaIDConf == '')
			{
				//Enfocar combobox
				$('#cmbMonedaID_ctas_monedas_configuracion_polizas_servicio').focus();
			}
			else if(strCuentaConf == '')
			{
				//Enfocar caja de texto
				$('#txtCuenta_ctas_monedas_configuracion_polizas_servicio').focus();
			}
			else
			{
				//Hacer un llamado al método del controlador para guardar los datos del registro
				$.post('servicio/configuracion_polizas/guardar_configuracion_monedas',
						{ 
							intConfiguracionID: $('#txtConfiguracionID_ctas_monedas_configuracion_polizas_servicio').val(),
							intMonedaID: intMonedaIDConf,
							intMonedaIDAnterior: $('#txtMonedaIDAnterior_ctas_monedas_configuracion_polizas_servicio').val(),
							strCuenta: strCuentaConf
						},
						function(data) {
							if (data.resultado)
							{
								//Hacer un llamado a la función para limpiar los campos del formulario
								nuevo_ctas_monedas_configuracion_polizas_servicio(); 
								//Hacer llamado a la función  para cargar las cuentas de monedas en el grid
								paginacion_ctas_monedas_configuracion_polizas_servicio();               
							}

							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				           	mensaje_configuracion_polizas_servicio(data.tipo_mensaje, data.mensaje);
							
							
						},
				'json');
			}
		}	

		//Función para eliminar los datos del registro seleccionado
		function eliminar_ctas_monedas_configuracion_polizas_servicio(id)
		{

			//Preguntar al usuario si desea eliminar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea eliminar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Configuraciones para Pólizas',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para eliminar los datos del registro
			                              $.post('servicio/configuracion_polizas/eliminar',
			                                     {intConfiguracionID: id,
			                                      strTabla: strTablaCtasMonedasConfiguracionPolizasServicio
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                        	//Hacer un llamado a la función para limpiar los campos del formulario
														nuevo_ctas_monedas_configuracion_polizas_servicio();
				                                        //Hacer llamado a la función  para cargar  los registros en el grid
				                                        paginacion_ctas_monedas_configuracion_polizas_servicio();
			                                        }

			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_configuracion_polizas_servicio(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });
		}
		

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ctas_monedas_configuracion_polizas_servicio(busqueda, tipoBusqueda)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/configuracion_polizas/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda, 
			       	strTabla: strTablaCtasMonedasConfiguracionPolizasServicio
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ctas_monedas_configuracion_polizas_servicio();
				          	//Recuperar valores
				            $('#txtConfiguracionID_ctas_monedas_configuracion_polizas_servicio').val(data.row.configuracion_id);
				            $('#cmbMonedaID_ctas_monedas_configuracion_polizas_servicio').val(data.row.moneda_id);
				            $('#txtMonedaIDAnterior_ctas_monedas_configuracion_polizas_servicio').val(data.row.moneda_id);
				            $('#txtCuenta_ctas_monedas_configuracion_polizas_servicio').val(data.row.cuenta);
				            //Enfocar combobox
							$('#cmbMonedaID_ctas_monedas_configuracion_polizas_servicio').focus();

			       	    }
			       	    else
			       	    {
			       	    	//Limpiar contenido de las siguientes cajas de texto
			       	    	$('#txtConfiguracionID_ctas_monedas_configuracion_polizas_servicio').val('');
			       	    	$('#txtMonedaIDAnterior_ctas_monedas_configuracion_polizas_servicio').val('');
				            $('#txtCuenta_ctas_monedas_configuracion_polizas_servicio').val('');

			       	    }
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_ctas_monedas_configuracion_polizas_servicio()
		{
			//Si no existe id, verificar la existencia de la moneda
			if ($('#cmbMonedaID_ctas_monedas_configuracion_polizas_servicio').val() != '')
			{

				//Hacer un llamado a la función para recuperar los datos del registro que coincide con la moneda
				editar_ctas_monedas_configuracion_polizas_servicio($('#cmbMonedaID_ctas_monedas_configuracion_polizas_servicio').val(), 'moneda');
			}
		}


		/*******************************************************************************************************************
		Funciones del Tab - Cuentas de departamentos
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_ctas_departamentos_configuracion_polizas_servicio() 
		{
			
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/configuracion_polizas/get_paginacion',
			{	
				intPagina:intPaginaCtasDeptoConfiguracionPolizasServicio,
				strPermisosAcceso: $('#txtAcciones_configuracion_polizas_servicio').val(), 
				strTabla: strTablaCtasDeptoConfiguracionPolizasServicio
			},
				function(data){
					$('#dg_ctas_departamentos_configuracion_polizas_servicio tbody').empty();
					var tmpCtasDepartamentosConfiguracionPolizasServicio = Mustache.render($('#plantilla_ctas_departamentos_configuracion_polizas_servicio').html(),data);
					$('#dg_ctas_departamentos_configuracion_polizas_servicio tbody').html(tmpCtasDepartamentosConfiguracionPolizasServicio);
					$('#pagLinks_ctas_departamentos_configuracion_polizas_servicio').html(data.paginacion);
					$('#numElementos_ctas_departamentos_configuracion_polizas_servicio').html(data.total_rows);
					intPaginaCtasDeptoConfiguracionPolizasServicio = data.pagina;
				},
			'json');
		}


		//Función para limpiar los campos del formulario
		function nuevo_ctas_departamentos_configuracion_polizas_servicio()
		{
			//Limpiamos las cajas de texto
		    $('#cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio').val('');
		    //Hacer un llamado a la función para inicializar elementos de la referencia
		    inicializar_referencia_ctas_departamentos_configuracion_polizas_servicio();
		    //Enfocar combobox
			$('#cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio').focus();
		}

		//Función para inicializar elementos de la referencia
		function inicializar_referencia_ctas_departamentos_configuracion_polizas_servicio()
		{
			//Limpiamos las cajas de texto
			$('#txtConfiguracionID_ctas_departamentos_configuracion_polizas_servicio').val('');
		    $('#cmbReferenciaID_ctas_departamentos_configuracion_polizas_servicio').val('');
		    $('#txtReferenciaIDAnterior_ctas_departamentos_configuracion_polizas_servicio').val('');
		    $('#txtTipoReferenciaAnterior_ctas_departamentos_configuracion_polizas_servicio').val('');
		    $('#txtCuenta_ctas_departamentos_configuracion_polizas_servicio').val('');
		}


		//Función para guardar o modificar los datos de una configuración de IEPS
		function guardar_ctas_departamentos_configuracion_polizas_servicio()
		{
			//Obtenemos los datos de las cajas de texto
			var intReferenciaIDConf = $('#cmbReferenciaID_ctas_departamentos_configuracion_polizas_servicio').val();
			var strCuentaConf = $('#txtCuenta_ctas_departamentos_configuracion_polizas_servicio').val();
			var strTipoReferencia = $('#cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio').val();
			
			//Validamos que se capturaron datos
			if (strTipoReferencia == '')
			{
				//Enfocar combobox
				$('#cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio').focus();
			}
			else if (intReferenciaIDConf == '')
			{
				//Enfocar combobox
				$('#cmbReferenciaID_ctas_departamentos_configuracion_polizas_servicio').focus();
			}
			else if(strCuentaConf == '')
			{
				//Enfocar caja de texto
				$('#txtCuenta_ctas_departamentos_configuracion_polizas_servicio').focus();
			}
			else
			{
				//Hacer un llamado al método del controlador para guardar los datos del registro
				$.post('servicio/configuracion_polizas/guardar_configuracion_departamentos',
						{ 
							intConfiguracionID: $('#txtConfiguracionID_ctas_departamentos_configuracion_polizas_servicio').val(),
							intReferenciaID: intReferenciaIDConf,
							intReferenciaIDAnterior: $('#txtReferenciaIDAnterior_ctas_departamentos_configuracion_polizas_servicio').val(),
							strTipoReferencia: $('#cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio').val(),
							strTipoReferenciaAnterior: $('#txtTipoReferenciaAnterior_ctas_departamentos_configuracion_polizas_servicio').val(),
							strCuenta: strCuentaConf, 
							strTabla: strTablaCtasDeptoConfiguracionPolizasServicio
						},
						function(data) {
							if (data.resultado)
							{
								//Hacer un llamado a la función para limpiar los campos del formulario
								nuevo_ctas_departamentos_configuracion_polizas_servicio(); 
								//Hacer llamado a la función  para cargar las cuentas de departamentos en el grid
								paginacion_ctas_departamentos_configuracion_polizas_servicio();               
							}

							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				           	mensaje_configuracion_polizas_servicio(data.tipo_mensaje, data.mensaje);
							
							
						},
				'json');
			}
		}	

		//Función para eliminar los datos del registro seleccionado
		function eliminar_ctas_departamentos_configuracion_polizas_servicio(id)
		{

			//Preguntar al usuario si desea eliminar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea eliminar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Configuraciones para Pólizas',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para eliminar los datos del registro
			                              $.post('servicio/configuracion_polizas/eliminar',
			                                     {intConfiguracionID: id,
			                                     strTabla: strTablaCtasDeptoConfiguracionPolizasServicio
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                        	//Hacer un llamado a la función para limpiar los campos del formulario
														nuevo_ctas_departamentos_configuracion_polizas_servicio();
				                                        //Hacer llamado a la función  para cargar  los registros en el grid
				                                        paginacion_ctas_departamentos_configuracion_polizas_servicio();
			                                        }

			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_configuracion_polizas_servicio(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });
		}
		

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ctas_departamentos_configuracion_polizas_servicio(busqueda, tipoBusqueda)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/configuracion_polizas/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda, 
			       	strTabla: strTablaCtasDeptoConfiguracionPolizasServicio
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ctas_departamentos_configuracion_polizas_servicio();
							
				          	//Recuperar valores
				            $('#txtConfiguracionID_ctas_departamentos_configuracion_polizas_servicio').val(data.row.configuracion_id);
				           
				            $('#cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio').val(data.row.tipo_referencia);
				            $('#txtTipoReferenciaAnterior_ctas_departamentos_configuracion_polizas_servicio').val(data.row.tipo_referencia);
				            $('#txtCuenta_ctas_departamentos_configuracion_polizas_servicio').val(data.row.cuenta);

				            //Hacer un llamado a la función para cargar referencias en el combobox del modal
			   				cargar_referencias_ctas_departamentos_configuracion_polizas_servicio();

			   				 $('#cmbReferenciaID_ctas_departamentos_configuracion_polizas_servicio').val(data.row.referencia_id);
			   				 $('#txtReferenciaIDAnterior_ctas_departamentos_configuracion_polizas_servicio').val(data.row.referencia_id);
			       	    }
			       	    else
			       	    {
			       	    	//Limpiar contenido de las siguientes cajas de texto
			       	    	 $('#txtConfiguracionID_ctas_departamentos_configuracion_polizas_servicio').val('');
			       	    	$('#txtReferenciaIDAnterior_ctas_departamentos_configuracion_polizas_servicio').val('');
			       	    	$('#txtTipoReferenciaAnterior_ctas_departamentos_configuracion_polizas_servicio').val('');
			       	    	$('#txtCuenta_ctas_departamentos_configuracion_polizas_servicio').val('');
			       	    }

			       	    //Enfocar caja de texto
						$('#txtCuenta_ctas_departamentos_configuracion_polizas_servicio').focus();
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_ctas_departamentos_configuracion_polizas_servicio()
		{
			//Si no existe id, verificar la existencia de la moneda
			if ($('#cmbReferenciaID_ctas_departamentos_configuracion_polizas_servicio').val() != '' && $('#cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio').val() != '')
			{

				//Concatenar criterios de búsqueda (para poder verificar la existencia de la referencia)
				var strCriteriosCtasDepartamentosConfiguracionPolizasServicio = $('#cmbReferenciaID_ctas_departamentos_configuracion_polizas_servicio').val()+'|'+$('#cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio').val();

				//Hacer un llamado a la función para recuperar los datos del registro que coincide con los criterios de búsqueda  
				editar_ctas_departamentos_configuracion_polizas_servicio(strCriteriosCtasDepartamentosConfiguracionPolizasServicio, 'referencia');
			}


			//Si no existe tipo de referencia
			if($('#cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio').val() == '')
			{
				//Enfocar combobox
				$('#cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio').focus();
			}
			else
			{
				//Enfocar caja de texto
				$('#txtCuenta_ctas_departamentos_configuracion_polizas_servicio').focus();
			}

		}

		//Regresar referencias para cargarlas en el combobox
		function cargar_referencias_ctas_departamentos_configuracion_polizas_servicio()
		{
			//Hacer un llamado al método del controlador para regresar las referencias
            $.ajax({
				        url: 'servicio/configuracion_polizas/get_combo_box',
				        method:'post',
				        dataType: 'json',
				        async: false,
				        data: {
				        	strTipo: 'departamentos',
						     strTipoReferencia: $('#cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio').val()
				        },
				        success: function (data) {
				          	$('#cmbReferenciaID_ctas_departamentos_configuracion_polizas_servicio').empty();
							var temp = Mustache.render($('#referencias_configuracion_polizas_servicio').html(), data);
							$('#cmbReferenciaID_ctas_departamentos_configuracion_polizas_servicio').html(temp);
				        }
				    });

		}



		/*******************************************************************************************************************
		Funciones del Tab - Procesos
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_procesos_configuracion_polizas_servicio() 
		{
			
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/configuracion_polizas/get_paginacion',
			{	
				intPagina:intPaginaProcesosConfiguracionPolizasServicio,
				strPermisosAcceso: $('#txtAcciones_configuracion_polizas_servicio').val(), 
				strTabla: strTablaProcesosConfiguracionPolizasServicio
			},
				function(data){
					$('#dg_procesos_configuracion_polizas_servicio tbody').empty();
					var tmpProcesosConfiguracionPolizasServicio = Mustache.render($('#plantilla_procesos_configuracion_polizas_servicio').html(),data);
					$('#dg_procesos_configuracion_polizas_servicio tbody').html(tmpProcesosConfiguracionPolizasServicio);
					$('#pagLinks_procesos_configuracion_polizas_servicio').html(data.paginacion);
					$('#numElementos_procesos_configuracion_polizas_servicio').html(data.total_rows);
					intPaginaProcesosConfiguracionPolizasServicio = data.pagina;
				},
			'json');
		}


		//Función para limpiar los campos del formulario
		function nuevo_procesos_configuracion_polizas_servicio()
		{
			//Limpiamos las cajas de texto
		    $('#cmbTipoReferencia_procesos_configuracion_polizas_servicio').val('');
		     //Hacer un llamado a la función para inicializar elementos de la referencia
		    inicializar_referencia_procesos_configuracion_polizas_servicio();
		    //Enfocar combobox
			$('#cmbTipoReferencia_procesos_configuracion_polizas_servicio').focus();
		}

		//Función para inicializar elementos de la referencia
		function inicializar_referencia_procesos_configuracion_polizas_servicio()
		{
			//Limpiamos las cajas de texto
		    $('#txtConfiguracionID_procesos_configuracion_polizas_servicio').val('');
		    $('#cmbReferenciaID_procesos_configuracion_polizas_servicio').val('');
		    $('#txtReferenciaIDAnterior_procesos_configuracion_polizas_servicio').val('');
		    $('#txtTipoReferenciaAnterior_procesos_configuracion_polizas_servicio').val('');
		    $('#txtProceso_procesos_configuracion_polizas_servicio').val('');
		}


		//Función para guardar o modificar los datos de una configuración de IEPS
		function guardar_procesos_configuracion_polizas_servicio()
		{
			//Obtenemos los datos de las cajas de texto
			var intReferenciaIDConf = $('#cmbReferenciaID_procesos_configuracion_polizas_servicio').val();
			var strProcesoConf = $('#txtProceso_procesos_configuracion_polizas_servicio').val();
			var strTipoReferencia = $('#cmbTipoReferencia_procesos_configuracion_polizas_servicio').val();
			
			//Validamos que se capturaron datos
			if (strTipoReferencia == '')
			{
				//Enfocar combobox
				$('#cmbTipoReferencia_procesos_configuracion_polizas_servicio').focus();
			}
			else if (intReferenciaIDConf == '')
			{
				//Enfocar combobox
				$('#cmbReferenciaID_procesos_configuracion_polizas_servicio').focus();
			}
			else if(strProcesoConf == '')
			{
				//Enfocar caja de texto
				$('#txtProceso_procesos_configuracion_polizas_servicio').focus();
			}
			else
			{
				//Hacer un llamado al método del controlador para guardar los datos del registro
				$.post('servicio/configuracion_polizas/guardar_configuracion_procesos',
						{ 
							intConfiguracionID: $('#txtConfiguracionID_procesos_configuracion_polizas_servicio').val(),
							intReferenciaID: intReferenciaIDConf,
							intReferenciaIDAnterior: $('#txtReferenciaIDAnterior_procesos_configuracion_polizas_servicio').val(),
							strTipoReferencia: $('#cmbTipoReferencia_procesos_configuracion_polizas_servicio').val(),
							strTipoReferenciaAnterior: $('#txtTipoReferenciaAnterior_procesos_configuracion_polizas_servicio').val(),
							strProceso: strProcesoConf, 
							strTabla: strTablaProcesosConfiguracionPolizasServicio
						},
						function(data) {
							if (data.resultado)
							{
								//Hacer un llamado a la función para limpiar los campos del formulario
								nuevo_procesos_configuracion_polizas_servicio(); 
								//Hacer llamado a la función  para cargar los procesos en el grid
								paginacion_procesos_configuracion_polizas_servicio();               
							}

							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				           	mensaje_configuracion_polizas_servicio(data.tipo_mensaje, data.mensaje);
							
							
						},
				'json');
			}
		}	

		//Función para eliminar los datos del registro seleccionado
		function eliminar_procesos_configuracion_polizas_servicio(id)
		{

			//Preguntar al usuario si desea eliminar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea eliminar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Configuraciones para Pólizas',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para eliminar los datos del registro
			                              $.post('servicio/configuracion_polizas/eliminar',
			                                     {intConfiguracionID: id, 
			                                      strTabla: strTablaProcesosConfiguracionPolizasServicio
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                        	//Hacer un llamado a la función para limpiar los campos del formulario
														nuevo_procesos_configuracion_polizas_servicio();
				                                        //Hacer llamado a la función  para cargar  los registros en el grid
				                                        paginacion_procesos_configuracion_polizas_servicio();
			                                        }

			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_configuracion_polizas_servicio(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });
		}
		

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_procesos_configuracion_polizas_servicio(busqueda, tipoBusqueda)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/configuracion_polizas/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda, 
			       	strTabla: strTablaProcesosConfiguracionPolizasServicio
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_procesos_configuracion_polizas_servicio();
						   
				          	//Recuperar valores
				            $('#txtConfiguracionID_procesos_configuracion_polizas_servicio').val(data.row.configuracion_id);
				            $('#cmbTipoReferencia_procesos_configuracion_polizas_servicio').val(data.row.tipo_referencia);
				            $('#txtTipoReferenciaAnterior_procesos_configuracion_polizas_servicio').val(data.row.tipo_referencia);
				            $('#txtProceso_procesos_configuracion_polizas_servicio').val(data.row.proceso);

				            //Hacer un llamado a la función para cargar referencias en el combobox del modal
			   				cargar_referencias_procesos_configuracion_polizas_servicio();

			   				$('#cmbReferenciaID_procesos_configuracion_polizas_servicio').val(data.row.referencia_id);
				            $('#txtReferenciaIDAnterior_procesos_configuracion_polizas_servicio').val(data.row.referencia_id);
			       	    }
			       	    else
			       	    {
			       	    	//Limpiar contenido de las siguientes cajas de texto
			       	    	$('#txtConfiguracionID_procesos_configuracion_polizas_servicio').val('');
			       	    	$('#txtReferenciaIDAnterior_procesos_configuracion_polizas_servicio').val('');
			       	    	$('#txtTipoReferenciaAnterior_procesos_configuracion_polizas_servicio').val('');
			       	    	$('#txtProceso_procesos_configuracion_polizas_servicio').val('');
			       	    }

			       	   //Enfocar combobox
					   $('#txtProceso_procesos_configuracion_polizas_servicio').focus();
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_procesos_configuracion_polizas_servicio()
		{
			//Si no existe id, verificar la existencia de la moneda
			if ($('#cmbReferenciaID_procesos_configuracion_polizas_servicio').val() != '' && $('#cmbTipoReferencia_procesos_configuracion_polizas_servicio').val() != '')
			{

				//Concatenar criterios de búsqueda (para poder verificar la existencia de la referencia)
				var strCriteriosProcesosConfiguracionPolizasServicio = $('#cmbReferenciaID_procesos_configuracion_polizas_servicio').val()+'|'+$('#cmbTipoReferencia_procesos_configuracion_polizas_servicio').val();

				//Hacer un llamado a la función para recuperar los datos del registro que coincide con los criterios de búsqueda  
				editar_procesos_configuracion_polizas_servicio(strCriteriosProcesosConfiguracionPolizasServicio, 'referencia');
			}


			//Si no existe tipo de referencia
			if($('#cmbTipoReferencia_procesos_configuracion_polizas_servicio').val() == '')
			{
				//Enfocar combobox
				$('#cmbTipoReferencia_procesos_configuracion_polizas_servicio').focus();
			}
			else
			{
				//Enfocar caja de texto
				$('#txtProceso_procesos_configuracion_polizas_servicio').focus();
			}


		}

		//Regresar referencias para cargarlas en el combobox
		function cargar_referencias_procesos_configuracion_polizas_servicio()
		{

			//Hacer un llamado al método del controlador para regresar las referencias
            $.ajax({
				        url: 'servicio/configuracion_polizas/get_combo_box',
				        method:'post',
				        dataType: 'json',
				        async: false,
				        data: {
				        	strTipo: 'procesos',
						     strTipoReferencia: $('#cmbTipoReferencia_procesos_configuracion_polizas_servicio').val()
				        },
				        success: function (data) {
				          	$('#cmbReferenciaID_procesos_configuracion_polizas_servicio').empty();
							var temp = Mustache.render($('#referencias_configuracion_polizas_servicio').html(), data);
							$('#cmbReferenciaID_procesos_configuracion_polizas_servicio').html(temp);
				        }
				    });
		}


		/*******************************************************************************************************************
		Funciones del Tab - Cuentas de módulos
		*********************************************************************************************************************/
		//Regresar módulos activas para cargarlas en el combobox
		function cargar_modulos_ctas_modulos_configuracion_polizas_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los módulos que se encuentran activos 
			$.post('crm/modulos/get_combo_box', {},
				function(data)
				{
					$('#cmbModuloID_ctas_modulos_configuracion_polizas_servicio').empty();
					var temp = Mustache.render($('#modulos_configuracion_polizas_servicio').html(), data);
					$('#cmbModuloID_ctas_modulos_configuracion_polizas_servicio').html(temp);
				},
				'json');
		}

		//Función para la búsqueda de registros
		function paginacion_ctas_modulos_configuracion_polizas_servicio() 
		{
			
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/configuracion_polizas/get_paginacion',
			{	
				intPagina:intPaginaCtasModulosConfiguracionPolizasServicio,
				strPermisosAcceso: $('#txtAcciones_configuracion_polizas_servicio').val(), 
				strTabla: strTablaCtasModulosConfiguracionPolizasServicio
			},
				function(data){
					$('#dg_ctas_modulos_configuracion_polizas_servicio tbody').empty();
					var tmpCtasModulosConfiguracionPolizasServicio = Mustache.render($('#plantilla_ctas_modulos_configuracion_polizas_servicio').html(),data);
					$('#dg_ctas_modulos_configuracion_polizas_servicio tbody').html(tmpCtasModulosConfiguracionPolizasServicio);
					$('#pagLinks_ctas_modulos_configuracion_polizas_servicio').html(data.paginacion);
					$('#numElementos_ctas_modulos_configuracion_polizas_servicio').html(data.total_rows);
					intPaginaCtasModulosConfiguracionPolizasServicio = data.pagina;
				},
			'json');
		}


		//Función para limpiar los campos del formulario
		function nuevo_ctas_modulos_configuracion_polizas_servicio()
		{
			//Limpiamos las cajas de texto
		    $('#txtConfiguracionID_ctas_modulos_configuracion_polizas_servicio').val('');
		    $('#cmbModuloID_ctas_modulos_configuracion_polizas_servicio').val('');
		    $('#txtModuloIDAnterior_ctas_modulos_configuracion_polizas_servicio').val('');
		    $('#cmbTipoReferencia_ctas_modulos_configuracion_polizas_servicio').val('');
		    $('#txtTipoReferenciaAnterior_ctas_modulos_configuracion_polizas_servicio').val('');
		    $('#txtCuenta_ctas_modulos_configuracion_polizas_servicio').val('');
		    //Enfocar combobox
			$('#cmbModuloID_ctas_modulos_configuracion_polizas_servicio').focus();
		}


		//Función para guardar o modificar los datos de una configuración de IEPS
		function guardar_ctas_modulos_configuracion_polizas_servicio()
		{
			//Obtenemos los datos de las cajas de texto
			var intModuloIDConf = $('#cmbModuloID_ctas_modulos_configuracion_polizas_servicio').val();
			var strCuentaConf = $('#txtCuenta_ctas_modulos_configuracion_polizas_servicio').val();
			var strTipoReferenciaConf = $('#cmbTipoReferencia_ctas_modulos_configuracion_polizas_servicio').val();


			//Validamos que se capturaron datos
			if (intModuloIDConf == '')
			{
				//Enfocar combobox
				$('#cmbModuloID_ctas_modulos_configuracion_polizas_servicio').focus();
			}
			else if(strTipoReferenciaConf == '')
			{
				//Enfocar combobox
				$('#cmbTipoReferencia_ctas_modulos_configuracion_polizas_servicio').focus();
			}
			else if(strCuentaConf == '')
			{
				//Enfocar caja de texto
				$('#txtCuenta_ctas_modulos_configuracion_polizas_servicio').focus();
			}
			else
			{
				//Hacer un llamado al método del controlador para guardar los datos del registro
				$.post('servicio/configuracion_polizas/guardar_configuracion_modulos',
						{ 
							intConfiguracionID: $('#txtConfiguracionID_ctas_modulos_configuracion_polizas_servicio').val(),
							intModuloID: intModuloIDConf,
							intModuloIDAnterior: $('#txtModuloIDAnterior_ctas_modulos_configuracion_polizas_servicio').val(),
							strTipoReferencia: strTipoReferenciaConf,
							strTipoReferenciaAnterior: $('#txtTipoReferenciaAnterior_ctas_modulos_configuracion_polizas_servicio').val(),
							strCuenta: strCuentaConf

						},
						function(data) {
							if (data.resultado)
							{
								//Hacer un llamado a la función para limpiar los campos del formulario
								nuevo_ctas_modulos_configuracion_polizas_servicio(); 
								//Hacer llamado a la función  para cargar las cuentas de módulos en el grid
								paginacion_ctas_modulos_configuracion_polizas_servicio();               
							}

							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				           	mensaje_configuracion_polizas_servicio(data.tipo_mensaje, data.mensaje);
							
							
						},
				'json');
			}
		}	

		//Función para eliminar los datos del registro seleccionado
		function eliminar_ctas_modulos_configuracion_polizas_servicio(id)
		{

			//Preguntar al usuario si desea eliminar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea eliminar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Configuraciones para Pólizas',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para eliminar los datos del registro
			                              $.post('servicio/configuracion_polizas/eliminar',
			                                     {intConfiguracionID: id,
			                                      strTabla: strTablaCtasModulosConfiguracionPolizasServicio
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                        	//Hacer un llamado a la función para limpiar los campos del formulario
														nuevo_ctas_modulos_configuracion_polizas_servicio();
				                                        //Hacer llamado a la función  para cargar  los registros en el grid
				                                        paginacion_ctas_modulos_configuracion_polizas_servicio();
			                                        }

			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_configuracion_polizas_servicio(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });
		}
		

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ctas_modulos_configuracion_polizas_servicio(busqueda, tipoBusqueda, tipoReferencia)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/configuracion_polizas/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda, 
			       	strTabla: strTablaCtasModulosConfiguracionPolizasServicio, 
			       	strTipoReferencia: tipoReferencia
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ctas_modulos_configuracion_polizas_servicio();
						   
				          	//Recuperar valores
				            $('#txtConfiguracionID_ctas_modulos_configuracion_polizas_servicio').val(data.row.configuracion_id);
				            $('#cmbModuloID_ctas_modulos_configuracion_polizas_servicio').val(data.row.modulo_id);
				            $('#txtModuloIDAnterior_ctas_modulos_configuracion_polizas_servicio').val(data.row.modulo_id);
				            $('#cmbTipoReferencia_ctas_modulos_configuracion_polizas_servicio').val(data.row.tipo_referencia);
				            $('#txtTipoReferenciaAnterior_ctas_modulos_configuracion_polizas_servicio').val(data.row.tipo_referencia);
				            $('#txtCuenta_ctas_modulos_configuracion_polizas_servicio').val(data.row.cuenta);
				           

			       	    }
			       	    else
			       	    {
			       	    	//Limpiar contenido de las siguientes cajas de texto
			       	    	$('#txtConfiguracionID_ctas_modulos_configuracion_polizas_servicio').val('');
			       	    	$('#txtModuloIDAnterior_ctas_modulos_configuracion_polizas_servicio').val('');
			       	    	$('#txtCuenta_ctas_modulos_configuracion_polizas_servicio').val('');
			       	    }

			       	    //Enfocar caja de texto
						$('#txtCuenta_ctas_modulos_configuracion_polizas_servicio').focus();

			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_ctas_modulos_configuracion_polizas_servicio()
		{
			//Si no existe id, verificar la existencia del módulo
			if ($('#cmbModuloID_ctas_modulos_configuracion_polizas_servicio').val() !== '' && $('#cmbTipoReferencia_ctas_modulos_configuracion_polizas_servicio').val() !== '')
			{

				//Hacer un llamado a la función para recuperar los datos del registro que coincide con el módulo
				editar_ctas_modulos_configuracion_polizas_servicio($('#cmbModuloID_ctas_modulos_configuracion_polizas_servicio').val(), 'modulo', $('#cmbTipoReferencia_ctas_modulos_configuracion_polizas_servicio').val());
			}

			//Si no existe tipo de referencia
			if($('#cmbTipoReferencia_ctas_modulos_configuracion_polizas_servicio').val() == '')
			{
				//Enfocar combobox
				$('#cmbTipoReferencia_ctas_modulos_configuracion_polizas_servicio').focus();
			}
			else
			{
				//Enfocar caja de texto
				$('#txtCuenta_ctas_modulos_configuracion_polizas_servicio').focus();
			}
		}



		/*******************************************************************************************************************
		Funciones del Tab - Cuentas de cuentas bancarias
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_ctas_ctas_bancarias_configuracion_polizas_servicio() 
		{

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/configuracion_polizas/get_paginacion',
			{	
				intPagina:intPaginaCtasCtasBancariasConfiguracionPolizasServicio,
				strPermisosAcceso: $('#txtAcciones_configuracion_polizas_servicio').val(), 
				strTabla: strTablaCtasCtasBancariasConfiguracionPolizasServicio
			},
				function(data){
					$('#dg_ctas_ctas_bancarias_configuracion_polizas_servicio tbody').empty();
					var tmpCtasCtasBancariasConfiguracionPolizasServicio = Mustache.render($('#plantilla_ctas_ctas_bancarias_configuracion_polizas_servicio').html(),data);
					$('#dg_ctas_ctas_bancarias_configuracion_polizas_servicio tbody').html(tmpCtasCtasBancariasConfiguracionPolizasServicio);
					$('#pagLinks_ctas_ctas_bancarias_configuracion_polizas_servicio').html(data.paginacion);
					$('#numElementos_ctas_ctas_bancarias_configuracion_polizas_servicio').html(data.total_rows);
					intPaginaCtasCtasBancariasConfiguracionPolizasServicio = data.pagina;
				},
			'json');
		}


		//Función para limpiar los campos del formulario
		function nuevo_ctas_ctas_bancarias_configuracion_polizas_servicio()
		{
			//Limpiamos las cajas de texto
		    $('#txtConfiguracionID_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
		    $('#txtCuentaBancariaID_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
		    $('#txtCuentaBancaria_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
		    $('#txtCuentaBancariaIDAnterior_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
		    $('#cmbTipoReferencia_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
		    $('#txtTipoReferenciaAnterior_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
		    $('#txtCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
		    //Enfocar caja de texto
			$('#txtCuentaBancaria_ctas_ctas_bancarias_configuracion_polizas_servicio').focus();
		}


		//Función para guardar o modificar los datos de una configuración de IEPS
		function guardar_ctas_ctas_bancarias_configuracion_polizas_servicio()
		{
			//Obtenemos los datos de las cajas de texto
			var intCuentaBancariaIDConf = $('#txtCuentaBancariaID_ctas_ctas_bancarias_configuracion_polizas_servicio').val();
			var strCuentaConf = $('#txtCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio').val();
			var strTipoReferenciaConf = $('#cmbTipoReferencia_ctas_ctas_bancarias_configuracion_polizas_servicio').val();

			//Validamos que se capturaron datos
			if (intCuentaBancariaIDConf == '')
			{
				//Enfocar caja de texto
				$('#txtCuentaBancaria_ctas_ctas_bancarias_configuracion_polizas_servicio').focus();
			}
			else if(strTipoReferenciaConf == '')
			{
				//Enfocar combobox
				$('#cmbTipoReferencia_ctas_ctas_bancarias_configuracion_polizas_servicio').focus();
			}
			else if(strCuentaConf == '')
			{
				//Enfocar caja de texto
				$('#txtCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio').focus();
			}
			else
			{
				//Hacer un llamado al método del controlador para guardar los datos del registro
				$.post('servicio/configuracion_polizas/guardar_configuracion_cuentas_bancarias',
						{ 
							intConfiguracionID: $('#txtConfiguracionID_ctas_ctas_bancarias_configuracion_polizas_servicio').val(),
							intCuentaBancariaID: intCuentaBancariaIDConf,
							intCuentaBancariaIDAnterior: $('#txtCuentaBancariaIDAnterior_ctas_ctas_bancarias_configuracion_polizas_servicio').val(),
							strTipoReferencia: strTipoReferenciaConf,
							strTipoReferenciaAnterior: $('#txtTipoReferenciaAnterior_ctas_ctas_bancarias_configuracion_polizas_servicio').val(),
							strCuenta: strCuentaConf

						},
						function(data) {
							if (data.resultado)
							{
								//Hacer un llamado a la función para limpiar los campos del formulario
								nuevo_ctas_ctas_bancarias_configuracion_polizas_servicio(); 
								//Hacer llamado a la función  para cargar las cuentas de cuentas bancarias en el grid
								paginacion_ctas_ctas_bancarias_configuracion_polizas_servicio();               
							}

							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				           	mensaje_configuracion_polizas_servicio(data.tipo_mensaje, data.mensaje);
							
							
						},
				'json');
			}
		}	

		//Función para eliminar los datos del registro seleccionado
		function eliminar_ctas_ctas_bancarias_configuracion_polizas_servicio(id)
		{

			//Preguntar al usuario si desea eliminar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea eliminar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Configuraciones para Pólizas',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para eliminar los datos del registro
			                              $.post('servicio/configuracion_polizas/eliminar',
			                                     {intConfiguracionID: id,
			                                      strTabla: strTablaCtasCtasBancariasConfiguracionPolizasServicio
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                        	//Hacer un llamado a la función para limpiar los campos del formulario
														nuevo_ctas_ctas_bancarias_configuracion_polizas_servicio();
				                                        //Hacer llamado a la función  para cargar  los registros en el grid
				                                        paginacion_ctas_ctas_bancarias_configuracion_polizas_servicio();
			                                        }

			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_configuracion_polizas_servicio(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });
		}
		

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ctas_ctas_bancarias_configuracion_polizas_servicio(busqueda, tipoBusqueda, tipoReferencia)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/configuracion_polizas/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda, 
			       	strTabla: strTablaCtasCtasBancariasConfiguracionPolizasServicio, 
			       	strTipoReferencia: tipoReferencia
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ctas_ctas_bancarias_configuracion_polizas_servicio();
						   
				          	//Recuperar valores
				            $('#txtConfiguracionID_ctas_ctas_bancarias_configuracion_polizas_servicio').val(data.row.configuracion_id);
				            $('#txtCuentaBancariaID_ctas_ctas_bancarias_configuracion_polizas_servicio').val(data.row.cuenta_bancaria_id);
				            $('#txtCuentaBancariaIDAnterior_ctas_ctas_bancarias_configuracion_polizas_servicio').val(data.row.cuenta_bancaria_id);
				            $('#txtCuentaBancaria_ctas_ctas_bancarias_configuracion_polizas_servicio').val(data.row.cuenta_bancaria);
				            $('#cmbTipoReferencia_ctas_ctas_bancarias_configuracion_polizas_servicio').val(data.row.tipo_referencia);
				            $('#txtTipoReferenciaAnterior_ctas_ctas_bancarias_configuracion_polizas_servicio').val(data.row.tipo_referencia);
				            $('#txtCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio').val(data.row.cuenta);
				           

			       	    }
			       	    else
			       	    {
			       	    	//Limpiar contenido de las siguientes cajas de texto
			       	    	$('#txtConfiguracionID_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
			       	    	$('#txtCuentaBancariaIDAnterior_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
			       	    	$('#txtCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
			       	    }

			       	    //Enfocar caja de texto
						$('#txtCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio').focus();

			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_ctas_ctas_bancarias_configuracion_polizas_servicio()
		{


			//Si no existe id, verificar la existencia de la cuenta bancaria
			if ($('#txtCuentaBancariaID_ctas_ctas_bancarias_configuracion_polizas_servicio').val() !== '' && $('#cmbTipoReferencia_ctas_ctas_bancarias_configuracion_polizas_servicio').val() !== '')
			{


				//Hacer un llamado a la función para recuperar los datos del registro que coincide con la cuenta bancaria
				editar_ctas_ctas_bancarias_configuracion_polizas_servicio($('#txtCuentaBancariaID_ctas_ctas_bancarias_configuracion_polizas_servicio').val(), 'cuenta bancaria', $('#cmbTipoReferencia_ctas_ctas_bancarias_configuracion_polizas_servicio').val());
				
			}

			//Si no existe tipo de referencia
			if($('#cmbTipoReferencia_ctas_ctas_bancarias_configuracion_polizas_servicio').val() == '')
			{
				//Enfocar combobox
				$('#cmbTipoReferencia_ctas_ctas_bancarias_configuracion_polizas_servicio').focus();
			}
			else
			{
				//Enfocar caja de texto
				$('#txtCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio').focus();
			}
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al formulario
			*********************************************************************************************************************/
			//Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });



			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Cuentas de IEPS
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').numeric();


			//Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaID_ctas_ieps_configuracion_polizas_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_tasa_cuota/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strImpuesto: 'IEPS'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtTasaCuotaID_ctas_ieps_configuracion_polizas_servicio').val(ui.item.data);
	             //Hacer un llamado a la función para verificar la existencia del registro
	             verificar_existencia_ctas_ieps_configuracion_polizas_servicio();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la tasa o cuota del impuesto de IEPS cuando pierda el enfoque la caja de texto
	        $('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaID_ctas_ieps_configuracion_polizas_servicio').val() == '' ||
	               $('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaID_ctas_ieps_configuracion_polizas_servicio').val('');
	               $('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').val('');
	            }
	            
	        });


	        //Validar que exista  porcentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
			   	    //Si no existe porcentaje de IEPS
		            if($('#txtTasaCuotaID_ctas_ieps_configuracion_polizas_servicio').val() == '' || $('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_ctas_ieps_configuracion_polizas_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtCuenta_ctas_ieps_configuracion_polizas_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista cuenta cuando se pulse la tecla enter 
			$('#txtCuenta_ctas_ieps_configuracion_polizas_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe cuenta
		            if($('#txtCuenta_ctas_ieps_configuracion_polizas_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCuenta_ctas_ieps_configuracion_polizas_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para guardar los datos de la cuenta de IEPS
			   	    	guardar_ctas_ieps_configuracion_polizas_servicio();
			   	    }
		        }
		    });

			//Paginación de registros
			$('#pagLinks_ctas_ieps_configuracion_polizas_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaCtasIepsConfiguracionPolizasServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar las cuentas de IEPS en el grid
				paginacion_ctas_ieps_configuracion_polizas_servicio();
			});



			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Cuentas de monedas
        	*********************************************************************************************************************/
		    //Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_ctas_monedas_configuracion_polizas_servicio();

	        //Enfocar cuenta cuando cambie la opción del combobox
	        $('#cmbMonedaID_ctas_monedas_configuracion_polizas_servicio').change(function(){
	       		
	        	//Si existe id de la moneda
		        if($('#cmbMonedaID_ctas_monedas_configuracion_polizas_servicio').val() !== '')
		        {

		        	//Hacer un llamado a la función para verificar la existencia del registro
	             	verificar_existencia_ctas_monedas_configuracion_polizas_servicio();

		        	//Enfocar caja de texto
					$('#txtCuenta_ctas_monedas_configuracion_polizas_servicio').focus();
		        }

	        });   

	       
	        //Validar que exista cuenta cuando se pulse la tecla enter 
			$('#txtCuenta_ctas_monedas_configuracion_polizas_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe cuenta
		            if($('#txtCuenta_ctas_monedas_configuracion_polizas_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCuenta_ctas_monedas_configuracion_polizas_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para guardar los datos de la cuenta de IEPS
			   	    	guardar_ctas_monedas_configuracion_polizas_servicio();
			   	    }
		        }
		    });

			//Paginación de registros
			$('#pagLinks_ctas_monedas_configuracion_polizas_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaCtasMonedasConfiguracionPolizasServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar las cuentas de monedas en el grid
				paginacion_ctas_monedas_configuracion_polizas_servicio();
			});



            /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Cuentas de departamentos
        	*********************************************************************************************************************/
        	//Hacer un llamado a la función para cargar referencias en el combobox del modal
            cargar_referencias_ctas_departamentos_configuracion_polizas_servicio();

	        //Limpiar campos de la referencia cuando cambie la opción del combobox
	        $('#cmbTipoReferencia_ctas_departamentos_configuracion_polizas_servicio').change(function(e){   
	        	//Hacer un llamado a la función para inicializar elementos de la referencia
			    inicializar_referencia_ctas_departamentos_configuracion_polizas_servicio();
			    //Hacer un llamado a la función para cargar referencias en el combobox del modal
			    cargar_referencias_ctas_departamentos_configuracion_polizas_servicio();

	        });

	        //Enfocar cuenta cuando cambie la opción del combobox
	        $('#cmbReferenciaID_ctas_departamentos_configuracion_polizas_servicio').change(function(){
	       		
	        	
	        	//Hacer un llamado a la función para verificar la existencia del registro
             	verificar_existencia_ctas_departamentos_configuracion_polizas_servicio();
             	

	        }); 


		    //Validar que exista cuenta cuando se pulse la tecla enter 
			$('#txtCuenta_ctas_departamentos_configuracion_polizas_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe cuenta
		            if($('#txtCuenta_ctas_departamentos_configuracion_polizas_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCuenta_ctas_departamentos_configuracion_polizas_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para guardar los datos de la cuenta del departamento
			   	    	guardar_ctas_departamentos_configuracion_polizas_servicio();
			   	    }
		        }
		    });

			//Paginación de registros
			$('#pagLinks_ctas_departamentos_configuracion_polizas_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaCtasDeptoConfiguracionPolizasServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar las cuentas de departamentos en el grid
				paginacion_ctas_departamentos_configuracion_polizas_servicio();
			});



        	/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Procesos
        	*********************************************************************************************************************/
        	//Hacer un llamado a la función para cargar referencias en el combobox del modal
            cargar_referencias_procesos_configuracion_polizas_servicio();

	        //Limpiar campos de la referencia cuando cambie la opción del combobox
	        $('#cmbTipoReferencia_procesos_configuracion_polizas_servicio').change(function(e){   
	        	 //Hacer un llamado a la función para inicializar elementos de la referencia
			    inicializar_referencia_procesos_configuracion_polizas_servicio();
			    //Hacer un llamado a la función para cargar referencias en el combobox del modal
			    cargar_referencias_procesos_configuracion_polizas_servicio();

	        });


	        //Enfocar cuenta cuando cambie la opción del combobox
	        $('#cmbReferenciaID_procesos_configuracion_polizas_servicio').change(function(){
	        	
	        	//Hacer un llamado a la función para verificar la existencia del registro
             	verificar_existencia_procesos_configuracion_polizas_servicio();

	        }); 

		    //Validar que exista proceso cuando se pulse la tecla enter 
			$('#txtProceso_procesos_configuracion_polizas_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe proceso
		            if($('#txtProceso_procesos_configuracion_polizas_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtProceso_procesos_configuracion_polizas_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para guardar los datos del proceso
			   	    	guardar_procesos_configuracion_polizas_servicio();
			   	    }
		        }
		    });

			//Paginación de registros
			$('#pagLinks_procesos_configuracion_polizas_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaProcesosConfiguracionPolizasServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar las cuentas de departamentos en el grid
				paginacion_procesos_configuracion_polizas_servicio();
			});



			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Cuentas de módulos
        	*********************************************************************************************************************/
		    //Hacer un llamado a la función para cargar módulos en el combobox del modal
            cargar_modulos_ctas_modulos_configuracion_polizas_servicio();

	        //Enfocar cuenta cuando cambie la opción del combobox
	        $('#cmbModuloID_ctas_modulos_configuracion_polizas_servicio').change(function(){

	        	//Hacer un llamado a la función para verificar la existencia del registro
             	verificar_existencia_ctas_modulos_configuracion_polizas_servicio();

	        });   


	        //Enfocar cuenta cuando cambie la opción del combobox
	        $('#cmbTipoReferencia_ctas_modulos_configuracion_polizas_servicio').change(function(){
	       		
	        	
		        //Hacer un llamado a la función para verificar la existencia del registro
	             verificar_existencia_ctas_modulos_configuracion_polizas_servicio();

	        });   

	       
	        //Validar que exista cuenta cuando se pulse la tecla enter 
			$('#txtCuenta_ctas_modulos_configuracion_polizas_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe cuenta
		            if($('#txtCuenta_ctas_modulos_configuracion_polizas_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCuenta_ctas_modulos_configuracion_polizas_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para guardar los datos de la cuenta
			   	    	guardar_ctas_modulos_configuracion_polizas_servicio();
			   	    }
		        }
		    });

			//Paginación de registros
			$('#pagLinks_ctas_modulos_configuracion_polizas_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaCtasModulosConfiguracionPolizasServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar las cuentas de módulos en el grid
				paginacion_ctas_modulos_configuracion_polizas_servicio();
			});


			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Cuentas de cuentas bancarias
        	*********************************************************************************************************************/
        	 //Autocomplete para recuperar los datos de una cuenta bancaria 
	        $('#txtCuentaBancaria_ctas_ctas_bancarias_configuracion_polizas_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCuentaBancariaID_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/cuentas_bancarias/autocomplete",
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
	             $('#txtCuentaBancariaID_ctas_ctas_bancarias_configuracion_polizas_servicio').val(ui.item.data);
	        	 //Hacer un llamado a la función para verificar la existencia del registro
             	  verificar_existencia_ctas_ctas_bancarias_configuracion_polizas_servicio();

	            
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	      	//Verificar que exista id de la cuenta bancaria cuando pierda el enfoque la caja de texto
	        $('#txtCuentaBancaria_ctas_ctas_bancarias_configuracion_polizas_servicio').focusout(function(e){
	            //Si no existe id de la cuenta bancaria
	            if($('#txtCuentaBancariaID_ctas_ctas_bancarias_configuracion_polizas_servicio').val() == '' ||
	               $('#txtCuentaBancaria_ctas_ctas_bancarias_configuracion_polizas_servicio').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtCuentaBancariaID_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
	                $('#txtCuentaBancaria_ctas_ctas_bancarias_configuracion_polizas_servicio').val('');
	            }
	            
	        });

			
			//Enfocar cuenta cuando cambie la opción del combobox
	        $('#cmbTipoReferencia_ctas_ctas_bancarias_configuracion_polizas_servicio').change(function(){
	       		
	        
		        //Hacer un llamado a la función para verificar la existencia del registro
	            verificar_existencia_ctas_ctas_bancarias_configuracion_polizas_servicio();

	        });   

	       
	        //Validar que exista cuenta cuando se pulse la tecla enter 
			$('#txtCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe cuenta
		            if($('#txtCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCuenta_ctas_ctas_bancarias_configuracion_polizas_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para guardar los datos de la cuenta
			   	    	guardar_ctas_ctas_bancarias_configuracion_polizas_servicio();
			   	    }
		        }
		    });

			//Paginación de registros
			$('#pagLinks_ctas_ctas_bancarias_configuracion_polizas_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaCtasCtasBancariasConfiguracionPolizasServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar las cuentas de módulos en el grid
				paginacion_ctas_ctas_bancarias_configuracion_polizas_servicio();
			});
				

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_configuracion_polizas_servicio();


		});
	</script>