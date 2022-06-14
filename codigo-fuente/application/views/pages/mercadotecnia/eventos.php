	<div id="EventosMercadotecniaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_eventos_mercadotecnia" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_eventos_mercadotecnia" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_eventos_mercadotecnia">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_eventos_mercadotecnia'>
				                    <input class="form-control" id="txtFechaInicialBusq_eventos_mercadotecnia"
				                    		name= "strFechaInicialBusq_eventos_mercadotecnia" 
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
								<label for="txtFechaFinalBusq_eventos_mercadotecnia">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_eventos_mercadotecnia'>
				                    <input class="form-control" id="txtFechaFinalBusq_eventos_mercadotecnia"
				                    		name= "strFechaFinalBusq_eventos_mercadotecnia" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
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
								<label for="txtBusqueda_eventos_mercadotecnia">Evento</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_eventos_mercadotecnia" 
										name="strBusqueda_eventos_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese evento">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_eventos_mercadotecnia"
									onclick="paginacion_eventos_mercadotecnia();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_eventos_mercadotecnia" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_eventos_mercadotecnia"
									onclick="reporte_eventos_mercadotecnia();" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_eventos_mercadotecnia"
									onclick="descargar_xls_eventos_mercadotecnia();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla eventos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Fecha"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Evento"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Localidad"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla asistentes
				*/
				td.movil.b1:nth-of-type(1):before {content: "Prospecto"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Teléfono"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Correo"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Interés"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_eventos_mercadotecnia">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Fecha</th>
							<th class="movil">Evento</th>
							<th class="movil">Localidad</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:15em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_eventos_mercadotecnia" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{fecha}}</td>
							<td class="movil a2">{{descripcion}}</td>
							<td class="movil a3">{{localidad}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_eventos_mercadotecnia({{evento_id}});"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_eventos_mercadotecnia({{evento_id}});" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Asistentes del evento-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="abrir_asistentes_eventos_mercadotecnia({{evento_id}});"  title="Registro de asistentes">
									<span class="fa fa-book"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_eventos_mercadotecnia({{evento_id}});"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Subir archivos-->
								<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
									<span class="btn  btn-default btn-xs fileinput-button ">
								    	<span class="fa fa-upload"></span>
										<input name="archivo_varios{{evento_id}}[]" id="archivo_varios{{evento_id}}"  type="file" multiple accept="text/xml, .doc, .docx, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" 
											   onchange="subir_archivos_grid_eventos_mercadotecnia({{evento_id}});">
								  		</input>
								    </span>
								</span>
								<!--Descargar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_eventos_mercadotecnia({{evento_id}});" title="Descargar archivo">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_eventos_mercadotecnia({{evento_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_eventos_mercadotecnia({{evento_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_eventos_mercadotecnia"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_eventos_mercadotecnia">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Eventos-->
		<div id="EventosMercadotecniaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_eventos_mercadotecnia"  class="ModalBodyTitle">
				<h1>Eventos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_eventos_mercadotecnia" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_eventos_mercadotecnia" class="active">
									<a data-toggle="tab" href="#informacion_general_eventos_mercadotecnia">Información General</a>
								</li>
								<!--Tab que contiene la información del presupuesto-->
								<li id="tabPresupuesto_eventos_mercadotecnia">
									<a data-toggle="tab" href="#presupuesto_eventos_mercadotecnia">Presupuesto</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmEventosMercadotecnia" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmEventosMercadotecnia"  onsubmit="return(false)" 
					  autocomplete="off" enctype="multipart/form-data">
					  <!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_eventos_mercadotecnia" class="tab-pane fade in active">
							<div class="row">	
								<!--Descripción-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtEventoID_eventos_mercadotecnia" 
												   name="intEventoID_eventos_mercadotecnia" type="hidden" value="" />
											<label for="txtDescripcion_eventos_mercadotecnia">Evento</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtDescripcion_eventos_mercadotecnia" 
													name="strDescripcion_eventos_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese evento" maxlength="50" />
										</div>
									</div>
								</div>
								<!--Fecha-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_eventos_mercadotecnia">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_eventos_mercadotecnia'>
							                    <input class="form-control" 
							                    		id="txtFecha_eventos_mercadotecnia"
							                    		name= "strFecha_eventos_mercadotecnia" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Hora-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtHora_eventos_mercadotecnia">Hora</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div 	class="input-group bootstrap-timepicker timepicker" 
													id="dteHora_eventos_mercadotecnia">
									            <input 	id="txtHora_eventos_mercadotecnia"
									            		name= "strHora_eventos_mercadotecnia" 
									            		type="text"
									            		value=""
									            		placeholder="Seleccione una hora" 
									            		class="form-control input-small" />
									            <span class="input-group-addon">
									            	<i class="glyphicon glyphicon-time"></i>
									            </span>
									        </div>
										</div>
									</div>
								</div>	
						    </div>
						    <div class="row">
						    	<!--Responsable-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtResponsable_eventos_mercadotecnia">Responsable</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtResponsable_eventos_mercadotecnia" 
													name="strResponsable_eventos_mercadotecnia" 
													type="text"
													placeholder="Escriba un responsable"  
													value="" tabindex="3"/>
										</div>
									</div>
								</div>
								<!--Marcas participantes-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMarcas_eventos_mercadotecnia">Marcas participantes</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtMarcas_eventos_mercadotecnia" 
													name="strMarcas_eventos_mercadotecnia" 
													type="text" 
													value="" tabindex="4"/>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Objetivos-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObjetivos_eventos_mercadotecnia">Objetivos</label>
										</div>
										<div class="col-md-12">
											<textarea class="form-control"
													  id="txtObjetivos_eventos_mercadotecnia"
													  name="strObjetivos_eventos_mercadotecnia"	 
													  rows="3" tabindex="5" ></textarea>
										</div>
									</div>
								</div>
								<!--Resultados-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtResultados_eventos_mercadotecnia">Resultados</label>
										</div>
										<div class="col-md-12">
											<textarea class="form-control"
													  id="txtResultados_eventos_mercadotecnia"
													  name="strResultados_eventos_mercadotecnia"	 
													  rows="3" tabindex="6" ></textarea>		
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						   		<!--Autocomplete que contiene las localidades activas-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la localidad seleccionada-->
											<input id="txtLocalidadID_eventos_mercadotecnia" 
											       name="intLocalidadID_eventos_mercadotecnia" type="hidden" value="" />
											<label for="txtLocalidad_eventos_mercadotecnia">Localidad</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtLocalidad_eventos_mercadotecnia" 
													name="strLocalidad_eventos_mercadotecnia" type="text" value="" 
													tabindex="7" placeholder="Ingrese localidad" maxlength="250" />
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
		               			<!--Municipio-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMunicipio_eventos_mercadotecnia">Municipio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMunicipio_eventos_mercadotecnia" 
													name="strMunicipio_eventos_mercadotecnia" type="text" 
													value="" disabled />
										</div>
									</div>
								</div>
								<!--Estado-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtEstado_eventos_mercadotecnia">Estado</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtEstado_eventos_mercadotecnia" 
													name="strEstado_eventos_mercadotecnia" type="text" value="" disabled />
										</div>
									</div>
								</div>
								<!--País-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPais_eventos_mercadotecnia">País</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPais_eventos_mercadotecnia" 
													name="strPais_eventos_mercadotecnia" type="text" value="" disabled />
										</div>
									</div>
								</div>
		               		</div>
						</div>
						<!--Tab - Presupuesto-->
						<div id="presupuesto_eventos_mercadotecnia" class="tab-pane fade">
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
											<input id="txtNumDetalles_eventos_mercadotecnia" 
										   		name="intNumDetalles_eventos_mercadotecnia" type="hidden" value="">
											</input>
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">Presupuesto</h4>
												</div>
												<div class="panel-body">
													<div class="row">
														<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
															<div class="row">
																<!--Código-->
																<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																	<div class="form-group">
																		<div class="col-md-12">
																			<label for="txtCantidad_detalles_eventos_mercadotecnia">
																				Cantidad
																			</label>
																		</div>
																		<div class="col-md-12">
																			<input  class="form-control" 
																					id="txtCantidad_detalles_eventos_mercadotecnia" 
																					name="intCantidad_detalles_eventos_mercadotecnia" 
																					type="text"
																					value="" 
																					tabindex="1"
																					placeholder="Ingrese cantidad" 
																					maxlength="14" />
																		</div>
																	</div>
																</div>
																<!--Concepto-->
																<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
																	<div class="form-group">
																		<div class="col-md-12">
																			<label for="txtConcepto_detalles_eventos_mercadotecnia">Concepto</label>
																		</div>
																		<div class="col-md-12">
																			<input  class="form-control" 
																					id="txtConcepto_detalles_eventos_mercadotecnia" 
																					name="strConcepto_detalles_eventos_mercadotecnia" 
																					type="text" 
																					value="" 
																					tabindex="1" 
																					placeholder="Ingrese concepto" 
																					maxlength="250" />
																		</div>
																	</div>
																</div>
																<!--Importe-->
																<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																	<div class="form-group">
																		<div class="col-md-12">
																			<label for="txtImporte_detalles_eventos_mercadotecnia">Importe unitario</label>
																		</div>
																		<div class="col-md-12">
																			<input  class="form-control cantidad" 
																					id="txtImporte_detalles_eventos_mercadotecnia" 
																					name="intImporte_detalles_eventos_mercadotecnia" 
																					type="text" 
																					value="" 
																					tabindex="1" 
																					placeholder="Ingrese importe" 
																					maxlength="5" />
																		</div>
																	</div>
																</div>
																<!--Botón agregar-->
								                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-1">
								                                	<button class="btn btn-primary btn-toolBtns pull-right" 
								                                			id="btnAgregar_eventos_mercadotecnia" 
								                                			onclick="agregar_renglon_detalles_eventos_mercadotecnia();" 
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
																<table class="table-hover movil" id="dg_detalles_eventos_mercadotecnia">
																	<thead class="movil">
																		<tr class="movil">
																			<th class="movil">Cantidad</th>
																			<th class="movil">Concepto</th>
																			<th class="movil">Importe unitario</th>
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
																			<td class="movil"></td>
																			<td class="movil"></td>
																			<td  class="movil t4">
																				<strong id="acumCantidad_detalles_eventos_mercadotecnia">0</strong>
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
																			<strong id="numElementos_detalles_eventos_mercadotecnia">0</strong> encontrados
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
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_eventos_mercadotecnia"  
									onclick="validar_eventos_mercadotecnia();"  title="Guardar" tabindex="8" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Asistentes del evento-->
							<button class="btn btn-default" id="btnAsistentes_eventos_mercadotecnia"  
									onclick="abrir_asistentes_eventos_mercadotecnia('');"  title="Registro de asistentes" tabindex="9">
								<span class="fa fa-book"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_eventos_mercadotecnia"  
									onclick="reporte_registro_eventos_mercadotecnia('');"  title="Imprimir registro en PDF" tabindex="10" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Subir varios archivos-->
		                    <span  class="fileupload-buttonbar" tabindex="11">
		                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_eventos_mercadotecnia">
		                        	<span class="fa fa-upload"></span>
		                        	<input id="archivo_varios_eventos_mercadotecnia" 
		                        		   name="archivo_varios_eventos_mercadotecnia[]" type="file" multiple 
		                        		   accept="text/xml, .doc, .docx, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" onchange="subir_archivos_modal_eventos_mercadotecnia('Editar');">
		                        	</input>
		                        </span>
		                    </span>
		                     <!--Descargar archivo-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_eventos_mercadotecnia"  
									onclick="descargar_archivos_eventos_mercadotecnia('');"  title="Descargar archivo" tabindex="7" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_eventos_mercadotecnia"  
									onclick="cambiar_estatus_eventos_mercadotecnia('','ACTIVO');"  title="Desactivar" tabindex="5" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_eventos_mercadotecnia"  
									onclick="cambiar_estatus_eventos_mercadotecnia('','INACTIVO');"  title="Restaurar" tabindex="6" disabled>
								<span class="fa fa-exchange"></span>
							</button> 
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_eventos_mercadotecnia"
									type="reset" aria-hidden="true" onclick="cerrar_eventos_mercadotecnia();" 
									title="Cerrar"  tabindex="7">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Eventos-->

		<!-- Diseño del modal Registro de Asistentes-->
		<div id="AsistentesEventosMercadotecniaBox" class="ModalBody" tabindex="-1">
			<!--Título-->
			<div id="divEncabezadoModal_asistentes_eventos_mercadotecnia" class="ModalBodyTitle">
				<h1>Registro de Asistentes</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">	
				<!--Diseño del formulario-->
				<form id="frmAsistentesEventosMercadotecnia" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmAsistentesEventosMercadotecnia" onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Evento-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtEventoID_asistentes_eventos_mercadotecnia" 
										   name="intEventoID_asistentes_eventos_mercadotecnia" 
										   type="hidden" value="">
									</input>
									<label for="txtEvento_asistentes_eventos_mercadotecnia">Evento</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEvento_asistentes_eventos_mercadotecnia" 
											name="strEvento_asistentes_eventos_mercadotecnia" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_asistentes_eventos_mercadotecnia">Fecha</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFecha_asistentes_eventos_mercadotecnia'>
					                    <input class="form-control" id="txtFecha_asistentes_eventos_mercadotecnia"
					                    		name= "strFecha_asistentes_eventos_mercadotecnia" 
					                    		type="text" value="" disabled/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
									<input id="txtNumDetalles_asistentes_eventos_mercadotecnia" 
										   name="intNumDetalles_asistentes_eventos_mercadotecnia" 
										   type="hidden" 
										   value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Asistentes</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene los prospectos activos-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id del prospecto seleccionado-->
																<input id="txtProspectoID_asistentes_eventos_mercadotecnia" 
																	   name="intProspectoID_asistentes_eventos_mercadotecnia" 
																	   type="hidden" value="">
																</input>
																<label for="txtProspecto_asistentes_eventos_mercadotecnia">
																	Prospecto
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtProspecto_asistentes_eventos_mercadotecnia" 
																		name="strProspecto_asistentes_eventos_mercadotecnia" type="text" value=""  placeholder="Ingrese prospecto" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Teléfono-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtTelefono_asistentes_eventos_mercadotecnia">
																	Teléfono
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtTelefono_asistentes_eventos_mercadotecnia" 
																		name="strTelefono_asistentes_eventos_mercadotecnia" 
																		type="text" value="" 
																		placeholder="Ingrese teléfono" maxlength="10">
																</input>
															</div>
														</div>
													</div>
													<!--Correo electrónico-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCorreoElectronico_asistentes_eventos_mercadotecnia">Correo electrónico</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtCorreoElectronico_asistentes_eventos_mercadotecnia" 
																		name="strCorreoElectronico_asistentes_eventos_mercadotecnia" type="text" value=""  placeholder="Ingrese correo electrónico" maxlength="50">
																</input>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Autocomplete que contiene las localidades activas-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id de la localidad seleccionada-->
																<input id="txtLocalidadID_asistentes_eventos_mercadotecnia" 
																       name="intLocalidadID_asistentes_eventos_mercadotecnia" type="hidden" value="">
																</input>
																<label for="txtLocalidad_asistentes_eventos_mercadotecnia">Localidad</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtLocalidad_asistentes_eventos_mercadotecnia" 
																		name="strLocalidad_asistentes_eventos_mercadotecnia" type="text" value=""  placeholder="Ingrese localidad" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Municipio-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtMunicipio_asistentes_eventos_mercadotecnia">Municipio</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtMunicipio_asistentes_eventos_mercadotecnia" 
																		name="strMunicipio_asistentes_eventos_mercadotecnia" type="text" 
																		value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Estado-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtEstado_asistentes_eventos_mercadotecnia">Estado</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtEstado_asistentes_eventos_mercadotecnia" 
																		name="strEstado_asistentes_eventos_mercadotecnia" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Interesado-->
													<div class="col-sm-11 col-md-11 col-lg-11 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtInteresado_asistentes_eventos_mercadotecnia">¿En qué está interesado?</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtInteresado_asistentes_eventos_mercadotecnia" 
																		name="strInteresado_asistentes_eventos_mercadotecnia" type="text" value=""  placeholder="Ingrese interés" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_asistentes_eventos_mercadotecnia" 
					                                			onclick="agregar_renglon_asistentes_eventos_mercadotecnia();" 
					                                	     	title="Agregar"> 
					                                		<span class="glyphicon glyphicon-plus"></span>
					                                	</button>
					                             	</div>
												</div>
											</div>
											<!--Div que contiene la tabla con los asistentes encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_asistentes_eventos_mercadotecnia">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Prospecto</th>
																<th class="movil">Teléfono</th>
																<th class="movil">Correo</th>
																<th class="movil">Interés</th>
																<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
													</table>
													<br>
													<div class="row">
														<!--Número de registros encontrados-->
														<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
															<button class="btn btn-default btn-sm disabled pull-right">
																<strong id="numElementos_asistentes_eventos_mercadotecnia">0</strong> encontrados
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
							<button class="btn btn-success" id="btnGuardar_asistentes_eventos_mercadotecnia"  
									onclick="validar_asistentes_eventos_mercadotecnia();"  title="Guardar">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_asistentes_eventos_mercadotecnia"
									type="reset" aria-hidden="true" onclick="cerrar_asistentes_eventos_mercadotecnia();" title="Cerrar">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Registro de Asistentes-->
	</div><!--#EventosMercadotecniaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaEventosMercadotecnia = 0;
		var strUltimaBusquedaEventosMercadotecnia = "";
		//Variables que se utilizan para la búsqueda de registros
		var dteFechaInicialEventosMercadotecnia = "";
		var dteFechaFinalEventosMercadotecnia = "";
		//Variable que se utiliza para asignar objeto del modal Eventos
		var objEventosMercadotecnia = null;
		//Variable que se utiliza para asignar objeto del modal Registro de Asistentes
		var objAsistentesEventosMercadotecnia = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_eventos_mercadotecnia()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('mercadotecnia/eventos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_eventos_mercadotecnia').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosEventosMercadotecnia = data.row;
					//Separar la cadena 
					var arrPermisosEventosMercadotecnia = strPermisosEventosMercadotecnia.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosEventosMercadotecnia.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosEventosMercadotecnia[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_eventos_mercadotecnia').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosEventosMercadotecnia[i]=='GUARDAR') || (arrPermisosEventosMercadotecnia[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_eventos_mercadotecnia').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosEventosMercadotecnia[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_eventos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEventosMercadotecnia[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_eventos_mercadotecnia').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_eventos_mercadotecnia();
						}
						else if(arrPermisosEventosMercadotecnia[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_eventos_mercadotecnia').removeAttr('disabled');
							$('#btnRestaurar_eventos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEventosMercadotecnia[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_eventos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEventosMercadotecnia[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_eventos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEventosMercadotecnia[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_eventos_mercadotecnia').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_eventos_mercadotecnia() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaEventosMercadotecnia =($('#txtFechaInicialBusq_eventos_mercadotecnia').val()+$('#txtFechaFinalBusq_eventos_mercadotecnia').val()+$('#txtBusqueda_eventos_mercadotecnia').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaEventosMercadotecnia != strUltimaBusquedaEventosMercadotecnia)
			{
				intPaginaEventosMercadotecnia = 0;
				strUltimaBusquedaEventosMercadotecnia = strNuevaBusquedaEventosMercadotecnia;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('mercadotecnia/eventos/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_eventos_mercadotecnia').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_eventos_mercadotecnia').val()),
					 strBusqueda: $('#txtBusqueda_eventos_mercadotecnia').val(),
					 intPagina: intPaginaEventosMercadotecnia,
					 strPermisosAcceso: $('#txtAcciones_eventos_mercadotecnia').val()
					},
					function(data){
						$('#dg_eventos_mercadotecnia tbody').empty();
						var tmpEventosMercadotecnia = Mustache.render($('#plantilla_eventos_mercadotecnia').html(),data);
						$('#dg_eventos_mercadotecnia tbody').html(tmpEventosMercadotecnia);
						$('#pagLinks_eventos_mercadotecnia').html(data.paginacion);
						$('#numElementos_eventos_mercadotecnia').html(data.total_rows);
						intPaginaEventosMercadotecnia = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_eventos_mercadotecnia() 
		{
			//Asignar valores para la búsqueda de registros
			dteFechaInicialEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicialBusq_eventos_mercadotecnia').val());
			dteFechaFinalEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinalBusq_eventos_mercadotecnia').val());

			//Si no existe fecha inicial
			if(dteFechaInicialEventosMercadotecnia == '')
			{
				dteFechaInicialEventosMercadotecnia = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalEventosMercadotecnia == '')
			{
				dteFechaFinalEventosMercadotecnia =  '0000-00-00';
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("mercadotecnia/eventos/get_reporte/"+dteFechaInicialEventosMercadotecnia+"/"+dteFechaFinalEventosMercadotecnia+"/"+$('#txtBusqueda_eventos_mercadotecnia').val());
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_eventos_mercadotecnia(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtEventoID_eventos_mercadotecnia').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("mercadotecnia/eventos/get_reporte_registro/"+intID);
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_eventos_mercadotecnia() 
		{
			//Asignar valores para la búsqueda de registros
			dteFechaInicialEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaInicialBusq_eventos_mercadotecnia').val());
			dteFechaFinalEventosMercadotecnia =  $.formatFechaMysql($('#txtFechaFinalBusq_eventos_mercadotecnia').val());

			//Si no existe fecha inicial
			if(dteFechaInicialEventosMercadotecnia == '')
			{
				dteFechaInicialEventosMercadotecnia = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalEventosMercadotecnia == '')
			{
				dteFechaFinalEventosMercadotecnia =  '0000-00-00';
			}

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("mercadotecnia/eventos/get_xls/"+dteFechaInicialEventosMercadotecnia+"/"+dteFechaFinalEventosMercadotecnia+"/"+$('#txtBusqueda_eventos_mercadotecnia').val());
		}
		

		/*******************************************************************************************************************
		Funciones del modal Eventos
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_eventos_mercadotecnia()
		{
			//Incializar formulario
			$('#frmEventosMercadotecnia')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_eventos_mercadotecnia();
			//Limpiar cajas de texto ocultas
			$('#frmEventosMercadotecnia').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_eventos_mercadotecnia').val(fechaActual());
			//Asignar la hora actual
			$('#txtHora_eventos_mercadotecnia').timepicker('setTime', horaActual('no'));
			 
			//$('#txtHora_eventos_mercadotecnia').val('18:03');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_eventos_mercadotecnia').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_eventos_mercadotecnia').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_eventos_mercadotecnia').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmEventosMercadotecnia').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtMunicipio_eventos_mercadotecnia').attr("disabled", "disabled");
			$('#txtEstado_eventos_mercadotecnia').attr("disabled", "disabled");
			$('#txtPais_eventos_mercadotecnia').attr("disabled", "disabled");
			//Mostrar botón Guardar
			$("#btnGuardar_eventos_mercadotecnia").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_eventos_mercadotecnia").hide();
			$("#btnAsistentes_eventos_mercadotecnia").hide();
			$("#btnDesactivar_eventos_mercadotecnia").hide();
			$("#btnRestaurar_eventos_mercadotecnia").hide();
			$("#btnDescargarArchivo_eventos_mercadotecnia").hide();
			
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_eventos_mercadotecnia()
		{
			try {
				//Cerrar modal
				objEventosMercadotecnia.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_eventos_mercadotecnia').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_eventos_mercadotecnia()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_eventos_mercadotecnia();
			//Validación del formulario de campos obligatorios
			$('#frmEventosMercadotecnia')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strDescripcion_eventos_mercadotecnia: {
											validators: {
												notEmpty: {message: 'Escriba un evento'}
											}
										},
									  	strFecha_eventos_mercadotecnia: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strHora_eventos_mercadotecnia: {
											validators: {
												notEmpty: {message: 'Seleccione una hora'}
											}
										},
										strResponsable_eventos_mercadotecnia: {
											validators: {
												notEmpty: {message: 'Escriba un responsable'}
											}
										},
										intCantidad_detalles_eventos_mercadotecnia: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strConcepto_detalles_eventos_mercadotecnia: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intImporte_detalles_eventos_mercadotecnia: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strLocalidad_eventos_mercadotecnia: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la localidad
					                                    if($('#txtLocalidadID_eventos_mercadotecnia').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una localidad existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_eventos_mercadotecnia = $('#frmEventosMercadotecnia').data('bootstrapValidator');
			bootstrapValidator_eventos_mercadotecnia.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_eventos_mercadotecnia.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_eventos_mercadotecnia();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_eventos_mercadotecnia()
		{
			try
			{
				$('#frmEventosMercadotecnia').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_eventos_mercadotecnia()
		{
			//Obtenemos un array con los datos del archivo
    		var arrArchivoEventosMercadotecnia = $("#archivo_varios_eventos_mercadotecnia");
			//Recorrer el grid Presupuesto
			//Obtenemos el objeto de la tabla presupuesto
			var objTabla = document.getElementById('dg_detalles_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrCantidades = [];
			var arrConceptos = [];
			var arrImportes = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
					
				//Asignar valores a los arrays
				arrCantidades.push(objRen.cells[0].innerHTML);
				arrConceptos.push(objRen.cells[1].innerHTML);
				arrImportes.push(objRen.cells[2].innerHTML);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('mercadotecnia/eventos/guardar',
					{ 
						intEventoID: $('#txtEventoID_eventos_mercadotecnia').val(),
						strDescripcion: $('#txtDescripcion_eventos_mercadotecnia').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_eventos_mercadotecnia').val()),
						//Hacer un llamado a la función convertir el formato de la hora a 24 horas y agregar segundos
						dteHora: convertirHora12a24($('#txtHora_eventos_mercadotecnia').val()) + ':00',
						strResponsable: $('#txtResponsable_eventos_mercadotecnia').val(),
						strMarcas: $('#txtMarcas_eventos_mercadotecnia').val(),
						strObjetivos: $('#txtObjetivos_eventos_mercadotecnia').val(),
						strResultados: $('#txtResultados_eventos_mercadotecnia').val(),
						intLocalidadID: $('#txtLocalidadID_eventos_mercadotecnia').val(),
						//Datos del presupuesto
						strCantidades: arrCantidades.join('|'),
						strConceptos: arrConceptos.join('|'),
						strImportes: arrImportes.join('|')
						
					},
					function(data) {
						if (data.resultado)
						{

							//Si no existe id del evento, significa que es un nuevo registro   
							if($('#txtEventoID_eventos_mercadotecnia').val() == '')
							{
							  	//Asignar el id de la orden del Evento
                     			$('#txtEventoID_eventos_mercadotecnia').val(data.evento_id);
                 			}

             				//Si existe archivo seleccionado
             				if(arrArchivoEventosMercadotecnia != undefined )
             				{
             					//Hacer un llamado a la función para subir el archivo
	                    		subir_archivos_modal_eventos_mercadotecnia('Nuevo');
             				}
             				else
             				{
             					//Hacer un llamado a la función para cerrar modal
		                    	cerrar_eventos_mercadotecnia();
								//Hacer llamado a la función  para cargar  los registros en el grid
		               			paginacion_eventos_mercadotecnia();  
             				}

						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_eventos_mercadotecnia(data.tipo_mensaje, data.mensaje);
					},
			'json');
			
		}

		//Función para subir los archivos de un registro desde el modal
		function subir_archivos_modal_eventos_mercadotecnia(tipoAccion)
		{
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDEventosMercadotecnia  = "archivo_varios_eventos_mercadotecnia";
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDEventosMercadotecnia);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDEventosMercadotecnia)[0].files;
			
        	//Si existe id del registro subir los archivos
        	if($('#txtEventoID_eventos_mercadotecnia').val() != '')
        	{
	        	//Crear instancia al objeto del formulario
	        	var formData = new FormData($("#frmEventosMercadotecnia")[0]);
	        	//Hacer un llamado al método del controlador para subir archivos del registro
	            $.ajax({
	                url: 'mercadotecnia/eventos/subir_archivos',
	                type: "POST",
	                data: formData,
	                contentType: false,
	                processData: false,
	                success: function(data)
	                {
	                    //Limpia ruta del archivo cargado
		         		$('#'+strBotonArchivoIDEventosMercadotecnia).val('');
						//Subida finalizada.
						if (data.resultado)
						{
						   //Mostrar botón Descargar Archivo
	                       $('#btnDescargarArchivo_eventos_mercadotecnia').show();
		         		   //Hacer llamado a la función  para cargar  los registros en el grid
			           	   paginacion_eventos_mercadotecnia();  
						}

						//Si la acción corresponde a un nuevo registro
	                    if(tipoAccion == 'Nuevo')
	                    {
	                    	//Si el tipo de mensaje es un éxito
			                if(data.tipo_mensaje == 'éxito')
			                {
				                //Hacer un llamado a la función para cerrar modal
				                cerrar_eventos_mercadotecnia();
			                }
			                else
			                {
			                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				    			mensaje_eventos_mercadotecnia(data.tipo_mensaje, data.mensaje);
			                }
	                    }
	                    else
	                    {
	                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				    		mensaje_eventos_mercadotecnia(data.tipo_mensaje, data.mensaje);
	                    }
	                }
            	});
            }     
			
		}

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_eventos_mercadotecnia(eventoID)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intEventoID = 0;
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(eventoID == '')
			{
				intEventoID = $('#txtEventoID_eventos_mercadotecnia').val();
			}
			else
			{
				intEventoID = eventoID;
			}

			//Abrir pestaña para realizar descarga de los documentos
			window.open("mercadotecnia/eventos/descargar_archivos/"+"/"+intEventoID);
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_eventos_mercadotecnia(tipoMensaje, mensaje)
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
		function cambiar_estatus_eventos_mercadotecnia(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtEventoID_eventos_mercadotecnia').val();

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
						              'title':    'Eventos',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
						                              $.post('mercadotecnia/eventos/set_estatus',
						                                     {intEventoID: intID,
						                                      strEstatus: estatus
						                                     },
						                                     function(data) {
						                                        if(data.resultado)
						                                        {
						                                         	//Hacer llamado a la función  para cargar  los registros en el grid
						                                         	paginacion_eventos_mercadotecnia();

						                                          	//Si el id del registro se obtuvo del modal
																	if(id == '')
																	{
																		//Hacer un llamado a la función para cerrar modal
																		cerrar_eventos_mercadotecnia();     
																	}
						                                        }
						                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						                                        mensaje_eventos_mercadotecnia(data.tipo_mensaje, data.mensaje);
						                                     },
						                                    'json');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('mercadotecnia/eventos/set_estatus',
				     {intEventoID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
					    if (data.resultado)
					    {
					        //Hacer llamado a la función para cargar  los registros en el grid
					      	paginacion_eventos_mercadotecnia();
					      	//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_eventos_mercadotecnia();     
							}
					    }
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_eventos_mercadotecnia(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_eventos_mercadotecnia(id)
		{	//Para limpiar todos los campos 
			nuevo_asistentes_eventos_mercadotecnia();
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('mercadotecnia/eventos/get_datos',
			       {
			       	intEventoID: id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_eventos_mercadotecnia();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Crear variable vacia
				            var strAccionesTablaDetalles = '';
				          	//Recuperar valores
				            $('#txtEventoID_eventos_mercadotecnia').val(data.row.evento_id);
				            $('#txtFecha_eventos_mercadotecnia').val(data.row.fecha);
				            $('#txtHora_eventos_mercadotecnia').timepicker('setTime', data.row.hora);

				            $('#txtResponsable_eventos_mercadotecnia').val(data.row.responsable);
				            $('#txtMarcas_eventos_mercadotecnia').val(data.row.marcas_participantes);
				            $('#txtObjetivos_eventos_mercadotecnia').val(data.row.objetivos);
				            $('#txtResultados_eventos_mercadotecnia').val(data.row.resultados);

						    $('#txtLocalidadID_eventos_mercadotecnia').val(data.row.localidad_id);
						    $('#txtLocalidad_eventos_mercadotecnia').val(data.row.localidad);
						    $('#txtMunicipio_eventos_mercadotecnia').val(data.row.municipio);
						    $('#txtEstado_eventos_mercadotecnia').val(data.row.estado);
						    $('#txtPais_eventos_mercadotecnia').val(data.row.pais);
						    $('#txtDescripcion_eventos_mercadotecnia').val(data.row.descripcion);
						   
						     //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{	
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_eventos_mercadotecnia").show();
				            	//Variable que se utiliza para asignar las acciones del grid view
						    	 strAccionesTablaDetalles = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_eventos_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_eventos_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
			            		$('#frmEventosMercadotecnia').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_eventos_mercadotecnia").hide();
								//Mostrar botón Restaurar
								$("#btnRestaurar_eventos_mercadotecnia").show();
							}

							 if (data.detalles){
							 	//Mostramos los detalles del registro
					           	for (var intCon in data.detalles) 
					            {
					            	//Obtenemos el objeto de la tabla
									var objTabla = document.getElementById('dg_detalles_eventos_mercadotecnia').getElementsByTagName('tbody')[0];
									//Insertamos el renglón con sus celdas en el objeto de la tabla
									var objRenglon = objTabla.insertRow();
									var objCeldaCantidad = objRenglon.insertCell(0);
									var objCeldaConcepto = objRenglon.insertCell(1);
									var objCeldaImporte = objRenglon.insertCell(2);
									var objCeldaTotal = objRenglon.insertCell(3);
									var objCeldaAcciones = objRenglon.insertCell(4);

									//Asignar valores
									objRenglon.setAttribute('class', 'movil');
									objRenglon.setAttribute('id', data.detalles[intCon].concepto);
									objCeldaCantidad.setAttribute('class', 'movil b1');
									objCeldaCantidad.innerHTML = formatMoney(data.detalles[intCon].cantidad, 2, '');
									objCeldaConcepto.setAttribute('class', 'movil b2');
									objCeldaConcepto.innerHTML = data.detalles[intCon].concepto;
									objCeldaImporte.setAttribute('class', 'movil b3');
									objCeldaImporte.innerHTML = formatMoney(data.detalles[intCon].importe_unitario, 2, '');
									objCeldaTotal.setAttribute('class', 'movil b4');
									objCeldaTotal.innerHTML = formatMoney(data.detalles[intCon].cantidad * data.detalles[intCon].importe_unitario, 2, '');
									objCeldaAcciones.setAttribute('class', 'td-center movil b5');
									objCeldaAcciones.innerHTML = strAccionesTablaDetalles;
					            }
					            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
								var intFilas = $("#dg_detalles_eventos_mercadotecnia tr").length - 1;
								$('#numElementos_detalles_eventos_mercadotecnia').html(intFilas);
								$('#txtNumDetalles_eventos_mercadotecnia').val(intFilas);
						    }


				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_eventos_mercadotecnia').addClass("estatus-"+strEstatus);
				            //Mostrar los siguientes botones
							$("#btnImprimirRegistro_eventos_mercadotecnia").show();
							$("#btnAsistentes_eventos_mercadotecnia").show();

							 //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar botón Descargar Archivo
				            	$("#btnDescargarArchivo_eventos_mercadotecnia").show();
				           	}

				           
			            	//Abrir modal
				            objEventosMercadotecnia = $('#EventosMercadotecniaBox').bPopup({
														  appendTo: '#EventosMercadotecniaContent', 
							                              contentContainer: 'EventosMercadotecniaM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});
				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_eventos_mercadotecnia();
				            //Enfocar caja de texto
							$('#txtDescripcion_eventos_mercadotecnia').focus();
					        
			       	    }
			       },
			       'json');
		}

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_eventos_mercadotecnia()
		{
			//Obtenemos los datos de las cajas de texto
			var intCantidad = parseFloat($.reemplazar($('#txtCantidad_detalles_eventos_mercadotecnia').val(), ",", ""));
			var strConcepto = $('#txtConcepto_detalles_eventos_mercadotecnia').val();
			var intImporte = parseFloat($.reemplazar($('#txtImporte_detalles_eventos_mercadotecnia').val(), ",", ""));
			
			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_eventos_mercadotecnia').getElementsByTagName('tbody')[0];
			
			//Validamos que se capturaron datos
			if(isNaN(intCantidad) == true)
			{
				$('#txtCantidad_detalles_eventos_mercadotecnia').focus();
			}
			//Validamos que se capturaron datos
			else if (strConcepto == '')
			{
				//Enfocar caja de texto
				$('#txtConcepto_detalles_eventos_mercadotecnia').focus();
			}
			else if (isNaN(intImporte) == true)
			{
				//Enfocar caja de texto
				$('#txtImporte_detalles_eventos_mercadotecnia').focus();
			}
			else
			{		
				//Limpiamos las cajas de texto
				$('#txtCantidad_detalles_eventos_mercadotecnia').val('');
				$('#txtConcepto_detalles_eventos_mercadotecnia').val('');
				$('#txtImporte_detalles_eventos_mercadotecnia').val('');

				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strConcepto = strConcepto.toUpperCase();

				//Revisamos si existe la descripción proporcionada, si es así, editamos los datos
				if (objTabla.rows.namedItem(strConcepto))
				{
					objTabla.rows.namedItem(strConcepto).cells[0].innerHTML = formatMoney(intCantidad, 2, '');
					objTabla.rows.namedItem(strConcepto).cells[1].innerHTML = strConcepto;
					objTabla.rows.namedItem(strConcepto).cells[2].innerHTML = formatMoney(intImporte, 2, '');
					objTabla.rows.namedItem(strConcepto).cells[3].innerHTML = formatMoney(intCantidad * intImporte, 2, '');
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCantidad = objRenglon.insertCell(0);
					var objCeldaConcepto = objRenglon.insertCell(1);
					var objCeldaImporte = objRenglon.insertCell(2);
					var objCeldaTotal = objRenglon.insertCell(3);
					var objCeldaAcciones = objRenglon.insertCell(4);
					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strConcepto);
					objCeldaCantidad.setAttribute('class', 'movil b1');
					objCeldaCantidad.innerHTML = formatMoney(intCantidad, 2, '');
					objCeldaConcepto.setAttribute('class', 'movil b2');
					objCeldaConcepto.innerHTML = strConcepto;
					objCeldaImporte.setAttribute('class', 'movil b3');
					objCeldaImporte.innerHTML = formatMoney(intImporte, 2, '');
					objCeldaTotal.setAttribute('class', 'movil b4');
					objCeldaTotal.innerHTML = formatMoney(intCantidad * intImporte, 2, '');
					objCeldaAcciones.setAttribute('class', 'td-center movil b5');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_eventos_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_eventos_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				}

				
				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_eventos_mercadotecnia();
				
				//Enfocar caja de texto
				$('#txtCantidad_detalles_eventos_mercadotecnia').focus();	

			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_eventos_mercadotecnia tr").length - 2;
			$('#numElementos_detalles_eventos_mercadotecnia').html(intFilas);
			$('#txtNumDetalles_eventos_mercadotecnia').val(intFilas);	
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_eventos_mercadotecnia(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtCantidad_detalles_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtConcepto_detalles_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtImporte_detalles_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[2].innerHTML)

			//Enfocar caja de texto
			$('#txtCantidad_detalles_eventos_mercadotecnia').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_eventos_mercadotecnia(objRenglon)
		{			
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;			
			if (objRenglon.parentNode.parentNode.id == $('#txtConcepto_detalles_eventos_mercadotecnia').val().toUpperCase()){

				$('#txtCantidad_detalles_eventos_mercadotecnia,#txtConcepto_detalles_eventos_mercadotecnia,#txtImporte_detalles_eventos_mercadotecnia').val('');
			}
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_eventos_mercadotecnia").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_eventos_mercadotecnia();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_eventos_mercadotecnia tr").length - 2;
			$('#numElementos_detalles_eventos_mercadotecnia').html(intFilas);
			$('#txtNumDetalles_movimiento_caja_herramientas_inventarios_fisicos').val(intFilas);

			//Enfocar caja de texto
			$('#txtCantidad_detalles_eventos_mercadotecnia').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_eventos_mercadotecnia()
		{	
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumCantidad = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				intAcumCantidad += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
			}

			//Convertir cantidad a formato moneda
			intAcumCantidad = formatMoney(intAcumCantidad, 2, '');

			//Asignar los valores
			$('#acumCantidad_detalles_eventos_mercadotecnia').html(intAcumCantidad);
		}


		/*******************************************************************************************************************
		Funciones del modal Registro de Asistentes
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_asistentes_eventos_mercadotecnia()
		{
			//Incializar formulario
			$('#frmAsistentesEventosMercadotecnia')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_asistentes_eventos_mercadotecnia();
			//Limpiar cajas de texto ocultas
			$('#frmAsistentesEventosMercadotecnia').find('input[type=hidden]').val('');
			//Eliminar los datos de la tabla asistentes
			$('#dg_asistentes_eventos_mercadotecnia tbody').empty();
			$('#numElementos_asistentes_eventos_mercadotecnia').html(0);
			//Eliminar los datos de la tabla detalles del movimiento
			$('#dg_detalles_eventos_mercadotecnia tbody').empty();
			$('#numElementos_detalles_eventos_mercadotecnia').html(0);
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_asistentes_eventos_mercadotecnia').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_asistentes_eventos_mercadotecnia').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_asistentes_eventos_mercadotecnia').removeClass("estatus-INACTIVO");
			//Mostrar botón Guardar
			$("#btnGuardar_asistentes_eventos_mercadotecnia").show();
		}

		//Función que se utiliza para abrir el modal
		function abrir_asistentes_eventos_mercadotecnia(id)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará el registro de asistentes desde el modal
			if(id == '')
			{
				intID = $('#txtEventoID_eventos_mercadotecnia').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('mercadotecnia/eventos/get_datos',
			       {
			       	intEventoID: intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {	
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_asistentes_eventos_mercadotecnia();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar las acciones del grid view
						    var strAccionesTablaDetalles = '';
				            
			            	//Recuperar valores
			            	$('#txtEventoID_asistentes_eventos_mercadotecnia').val(data.row.evento_id);
			            	$('#txtEvento_asistentes_eventos_mercadotecnia').val(data.row.descripcion+'  LOC. '+data.row.localidad);
			            	$('#txtFecha_asistentes_eventos_mercadotecnia').val(data.row.fecha);

			            	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Si el evento tiene asistentes
				            	if(data.row.total_asistentes > 0)
				            	{
				            		//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
									$('#divEncabezadoModal_asistentes_eventos_mercadotecnia').addClass("estatus-ACTIVO");
				            	}
				            	else
				            	{
				            		//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
								    $('#divEncabezadoModal_asistentes_eventos_mercadotecnia').addClass("estatus-NUEVO");
				            	}

				            	strAccionesTablaDetalles = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_asistentes_eventos_mercadotecnia(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_asistentes_eventos_mercadotecnia(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
							}
							else
							{
								//Dependiendo del estatus cambiar el color del encabezado
								$('#divEncabezadoModal_asistentes_eventos_mercadotecnia').addClass("estatus-"+strEstatus);
								//Ocultar botón Guardar
								$("#btnGuardar_asistentes_eventos_mercadotecnia").hide(); 
							}

							//Mostramos los asistentes del registro
				            for (var intCon in data.asistentes) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_asistentes_eventos_mercadotecnia').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaProspecto = objRenglon.insertCell(0);
								var objCeldaTelefono = objRenglon.insertCell(1);
								var objCeldaCorreoElectronico = objRenglon.insertCell(2);
								var objCeldaInteresado = objRenglon.insertCell(3);
								var objCeldaAcciones = objRenglon.insertCell(4);
								//Columnas ocultas
								var objCeldaLocalidadID = objRenglon.insertCell(5);
								var objCeldaLocalidad = objRenglon.insertCell(6);
								var objCeldaMunicipio = objRenglon.insertCell(7);
								var objCeldaEstado = objRenglon.insertCell(8);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.asistentes[intCon].prospecto_id);
								objCeldaProspecto.setAttribute('class', 'movil b1');
								objCeldaProspecto.innerHTML = data.asistentes[intCon].prospecto;
								objCeldaTelefono.setAttribute('class', 'movil b2');
								objCeldaTelefono.innerHTML =  data.asistentes[intCon].telefono;
								objCeldaCorreoElectronico.setAttribute('class', 'movil b3');
								objCeldaCorreoElectronico.innerHTML = data.asistentes[intCon].correo_electronico;
								objCeldaInteresado.setAttribute('class', 'movil b4');
								objCeldaInteresado.innerHTML = data.asistentes[intCon].interesado;
								objCeldaAcciones.setAttribute('class', 'td-center movil b5');
								objCeldaAcciones.innerHTML = strAccionesTablaDetalles;

								objCeldaLocalidadID.setAttribute('class', 'no-mostrar');
								objCeldaLocalidadID.innerHTML = data.asistentes[intCon].localidad_id;
								objCeldaLocalidad.setAttribute('class', 'no-mostrar');
								objCeldaLocalidad.innerHTML = data.asistentes[intCon].localidad;
								objCeldaMunicipio.setAttribute('class', 'no-mostrar');
								objCeldaMunicipio.innerHTML = data.asistentes[intCon].municipio;
								objCeldaEstado.setAttribute('class', 'no-mostrar');
								objCeldaEstado.innerHTML = data.asistentes[intCon].estado;

				            }

				            //Asignar el número de asistentes 
						    $('#numElementos_asistentes_eventos_mercadotecnia').html(data.row.total_asistentes);

							//Abrir modal
				            objAsistentesEventosMercadotecnia= $('#AsistentesEventosMercadotecniaBox').bPopup({
																  appendTo: '#EventosMercadotecniaContent', 
									                              contentContainer: 'EventosMercadotecniaM', 
									                              zIndex: 2, 
									                              modalClose: false, 
									                              modal: true, 
									                              follow: [true,false], 
									                              followEasing : "linear", 
									                              easing: "linear", 
									                              modalColor: ('#F0F0F0')});
				            //Enfocar caja de texto
							$('#txtProspecto_asistentes_eventos_mercadotecnia').focus();
			            }
			       },
			       'json');
			
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_asistentes_eventos_mercadotecnia()
		{
			try {
				//Cerrar modal
				objAsistentesEventosMercadotecnia.close();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario de asistentes
		function validar_asistentes_eventos_mercadotecnia()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_asistentes_eventos_mercadotecnia();
			//Validación del formulario de campos obligatorios
			$('#frmAsistentesEventosMercadotecnia')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumDetalles_asistentes_eventos_mercadotecnia: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un asistente para este evento.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_eventos_mercadotecnia = $('#frmAsistentesEventosMercadotecnia').data('bootstrapValidator');
			bootstrapValidator_eventos_mercadotecnia.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_eventos_mercadotecnia.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_asistentes_eventos_mercadotecnia();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_asistentes_eventos_mercadotecnia()
		{
			try
			{
				$('#frmAsistentesEventosMercadotecnia').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Método para guardar los datos de un registro
		function guardar_asistentes_eventos_mercadotecnia()
		{	
			//Obtenemos el objeto de la tabla asistentes
			var objTabla = document.getElementById('dg_asistentes_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrProspectoID = [];
			var arrTelefonos = [];
			var arrCorreosElectronicos = [];
			var arrInteresados = [];
			var arrLocalidadID = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				arrProspectoID.push(objRen.getAttribute('id'));
				arrTelefonos.push(objRen.cells[1].innerHTML);
				arrCorreosElectronicos.push(objRen.cells[2].innerHTML);
				arrInteresados.push(objRen.cells[3].innerHTML);
				arrLocalidadID.push(objRen.cells[5].innerHTML);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('mercadotecnia/eventos/guardar_asistentes',
					{ 
						intEventoID: $('#txtEventoID_asistentes_eventos_mercadotecnia').val(),
						strProspectoID: arrProspectoID.join('|'),
						strTelefonos: arrTelefonos.join('|'),
						strCorreosElectronicos: arrCorreosElectronicos.join('|'),
					    strLocalidadID: arrLocalidadID.join('|'),
						strInteresados: arrInteresados.join('|')
					},
					function(data) {
						if (data.resultado)
						{
			                //Hacer un llamado a la función para cerrar modal
			                cerrar_asistentes_eventos_mercadotecnia();         
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_eventos_mercadotecnia(data.tipo_mensaje, data.mensaje);
					},
			'json');
			
		}


		/*******************************************************************************************************************
		Funciones de la tabla asistentes
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_asistentes_eventos_mercadotecnia()
		{
			//Obtenemos los datos de las cajas de texto
			var intProspectoID = $('#txtProspectoID_asistentes_eventos_mercadotecnia').val();
			var strProspecto = $('#txtProspecto_asistentes_eventos_mercadotecnia').val();
			var strTelefono = $('#txtTelefono_asistentes_eventos_mercadotecnia').val();
			var strCorreoElectronico = $('#txtCorreoElectronico_asistentes_eventos_mercadotecnia').val();
			var intLocalidadID = $('#txtLocalidadID_asistentes_eventos_mercadotecnia').val();
			var strLocalidad = $('#txtLocalidad_asistentes_eventos_mercadotecnia').val();
			var strMunicipio = $('#txtMunicipio_asistentes_eventos_mercadotecnia').val();
			var strEstado = $('#txtEstado_asistentes_eventos_mercadotecnia').val();
			var strInteresado = $('#txtInteresado_asistentes_eventos_mercadotecnia').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_asistentes_eventos_mercadotecnia').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intProspectoID == '' || strProspecto == '')
			{
				//Enfocar caja de texto
				$('#txtProspecto_asistentes_eventos_mercadotecnia').focus();
			}
			else if (strTelefono == '' || strTelefono.length != 10)
			{
				//Enfocar caja de texto
				$('#txtTelefono_asistentes_eventos_mercadotecnia').focus();
			}
			else if (intLocalidadID == '' || strLocalidad == '')
			{
				//Enfocar caja de texto
				$('#txtLocalidad_asistentes_eventos_mercadotecnia').focus();
			}
			else if (strInteresado == '')
			{
				//Enfocar caja de texto
				$('#txtInteresado_asistentes_eventos_mercadotecnia').focus();
			}
			//Hacer un llamado a la función para validar la dirección de correo electrónico
			else if (!$.validarCorreoElectronico('txtCorreoElectronico_asistentes_eventos_mercadotecnia'))
			{	
				$('#txtCorreoElectronico_asistentes_eventos_mercadotecnia').focus();
			}
			else
			{

				//Limpiamos las cajas de texto
				$('#txtProspectoID_asistentes_eventos_mercadotecnia').val('');
				$('#txtProspecto_asistentes_eventos_mercadotecnia').val('');
				$('#txtTelefono_asistentes_eventos_mercadotecnia').val('');
				$('#txtCorreoElectronico_asistentes_eventos_mercadotecnia').val('');
				$('#txtLocalidadID_asistentes_eventos_mercadotecnia').val('');
				$('#txtLocalidad_asistentes_eventos_mercadotecnia').val('');
				$('#txtMunicipio_asistentes_eventos_mercadotecnia').val('');
				$('#txtEstado_asistentes_eventos_mercadotecnia').val('');
				$('#txtInteresado_asistentes_eventos_mercadotecnia').val('');

				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strInteresado = strInteresado.toUpperCase();
				//Utilizar toLowerCase() para cambiar texto a minúsculas
				strCorreoElectronico = strCorreoElectronico.toLowerCase();

				//Revisamos si existe el ID proporcionado, si es así, editamos el precio
				if (objTabla.rows.namedItem(intProspectoID))
				{
					objTabla.rows.namedItem(intProspectoID).cells[1].innerHTML = strTelefono;
					objTabla.rows.namedItem(intProspectoID).cells[2].innerHTML = strCorreoElectronico;
					objTabla.rows.namedItem(intProspectoID).cells[3].innerHTML = strInteresado;
					objTabla.rows.namedItem(intProspectoID).cells[5].innerHTML = intLocalidadID;
					objTabla.rows.namedItem(intProspectoID).cells[6].innerHTML = strLocalidad;
					objTabla.rows.namedItem(intProspectoID).cells[7].innerHTML = strMunicipio;
					objTabla.rows.namedItem(intProspectoID).cells[8].innerHTML = strEstado;
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaProspecto = objRenglon.insertCell(0);
					var objCeldaTelefono = objRenglon.insertCell(1);
					var objCeldaCorreoElectronico = objRenglon.insertCell(2);
					var objCeldaInteresado = objRenglon.insertCell(3);
					var objCeldaAcciones = objRenglon.insertCell(4);
					//Columnas ocultas
					var objCeldaLocalidadID = objRenglon.insertCell(5);
					var objCeldaLocalidad = objRenglon.insertCell(6);
					var objCeldaMunicipio = objRenglon.insertCell(7);
					var objCeldaEstado = objRenglon.insertCell(8);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intProspectoID);
					objCeldaProspecto.setAttribute('class', 'movil b1');
					objCeldaProspecto.innerHTML = strProspecto;
					objCeldaTelefono.setAttribute('class', 'movil b2');
					objCeldaTelefono.innerHTML = strTelefono;
					objCeldaCorreoElectronico.setAttribute('class', 'movil b3');
					objCeldaCorreoElectronico.innerHTML = strCorreoElectronico;
					objCeldaInteresado.setAttribute('class', 'movil b4');
					objCeldaInteresado.innerHTML = strInteresado;
					objCeldaAcciones.setAttribute('class', 'td-center movil b5');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_asistentes_eventos_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_asistentes_eventos_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

					objCeldaLocalidadID.setAttribute('class', 'no-mostrar');
					objCeldaLocalidadID.innerHTML = intLocalidadID;
					objCeldaLocalidad.setAttribute('class', 'no-mostrar');
					objCeldaLocalidad.innerHTML = strLocalidad;
					objCeldaMunicipio.setAttribute('class', 'no-mostrar');
					objCeldaMunicipio.innerHTML = strMunicipio;
					objCeldaEstado.setAttribute('class', 'no-mostrar');
					objCeldaEstado.innerHTML = strEstado;
				}
				//Enfocar caja de texto
				$('#txtProspecto_asistentes_eventos_mercadotecnia').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_asistentes_eventos_mercadotecnia tr").length - 1;
			$('#numElementos_asistentes_eventos_mercadotecnia').html(intFilas);
			$('#txtNumDetalles_asistentes_eventos_mercadotecnia').val(intFilas);

		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_asistentes_eventos_mercadotecnia(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtProspectoID_asistentes_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtProspecto_asistentes_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtTelefono_asistentes_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCorreoElectronico_asistentes_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtInteresado_asistentes_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtLocalidadID_asistentes_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[5].innerHTML);
			$('#txtLocalidad_asistentes_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[6].innerHTML);
			$('#txtMunicipio_asistentes_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[7].innerHTML);
			$('#txtEstado_asistentes_eventos_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[8].innerHTML);
			
			//Enfocar caja de texto
			$('#txtProspecto_asistentes_eventos_mercadotecnia').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_asistentes_eventos_mercadotecnia(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_asistentes_eventos_mercadotecnia").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_asistentes_eventos_mercadotecnia tr").length - 1;
			$('#numElementos_asistentes_eventos_mercadotecnia').html(intFilas);
			$('#txtNumDetalles_asistentes_eventos_mercadotecnia').val(intFilas);

			//Enfocar caja de texto
			$('#txtProspecto_asistentes_eventos_mercadotecnia').focus();
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Eventos
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_eventos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
			//Agregar timepicker para seleccionar una hora
			$('#txtHora_eventos_mercadotecnia').timepicker({minuteStep: 1});
			$('#txtHora_eventos_mercadotecnia').timepicker('setTime', '12:45 AM');

			//Autocomplete para recuperar los datos de una localidad 
	        $('#txtLocalidad_eventos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtLocalidadID_eventos_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/localidades/autocomplete",
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
	             $('#txtLocalidadID_eventos_mercadotecnia').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/localidades/get_datos',
	                  { 
	                  	strBusqueda:$("#txtLocalidadID_eventos_mercadotecnia").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtLocalidad_eventos_mercadotecnia").val(data.row.localidad);
	                       $("#txtMunicipio_eventos_mercadotecnia").val(data.row.municipio);
	                       $("#txtEstado_eventos_mercadotecnia").val(data.row.estado);
	                       $("#txtPais_eventos_mercadotecnia").val(data.row.pais);
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
	        
	        //Verificar que exista id de la localidad cuando pierda el enfoque la caja de texto
	        $('#txtLocalidad_eventos_mercadotecnia').focusout(function(e){
	            //Si no existe id de la localidad
	            if($('#txtLocalidadID_eventos_mercadotecnia').val() == '' ||
	               $('#txtLocalidad_eventos_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtLocalidadID_eventos_mercadotecnia').val('');
	               $('#txtLocalidad_eventos_mercadotecnia').val('');
	               $('#txtMunicipio_eventos_mercadotecnia').val('');
	               $('#txtEstado_eventos_mercadotecnia').val('');
	               $('#txtPais_eventos_mercadotecnia').val('');
	            }

	        });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_eventos_mercadotecnia').on('click','button.btn',function(){
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
			Controles correspondientes al modal Registro de Asistentes
			*********************************************************************************************************************/
			//Validar campos númericos (solamente valores enteros y positivos)
            $('#txtTelefono_asistentes_eventos_mercadotecnia').numeric({decimal: false, negative: false});

			//Autocomplete para recuperar los datos de un prospecto 
	        $('#txtProspecto_asistentes_eventos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtProspectoID_asistentes_eventos_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/prospectos/autocomplete",
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
	             $('#txtProspectoID_asistentes_eventos_mercadotecnia').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/prospectos/get_datos',
	                  { 
	                  	intProspectoID:$("#txtProspectoID_asistentes_eventos_mercadotecnia").val()
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTelefono_asistentes_eventos_mercadotecnia").val(data.row.telefono_principal);
	                       $("#txtCorreoElectronico_asistentes_eventos_mercadotecnia").val(data.row.correo_electronico);
	                       $("#txtLocalidadID_asistentes_eventos_mercadotecnia").val(data.row.localidad_id);
	                       $("#txtLocalidad_asistentes_eventos_mercadotecnia").val(data.row.localidad);
	                       $("#txtMunicipio_asistentes_eventos_mercadotecnia").val(data.row.municipio);
	                       $("#txtEstado_asistentes_eventos_mercadotecnia").val(data.row.estado);
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

	        //Verificar que exista id del prospecto cuando pierda el enfoque la caja de texto
	        $('#txtProspecto_asistentes_eventos_mercadotecnia').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoID_asistentes_eventos_mercadotecnia').val() == '' ||
	               $('#txtProspecto_asistentes_eventos_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_asistentes_eventos_mercadotecnia').val('');
	               $('#txtProspecto_asistentes_eventos_mercadotecnia').val('');
	               $('#txtTelefono_asistentes_eventos_mercadotecnia').val('');
	               $('#txtLocalidadID_asistentes_eventos_mercadotecnia').val('');
	               $('#txtLocalidad_asistentes_eventos_mercadotecnia').val('');
	               $('#txtMunicipio_asistentes_eventos_mercadotecnia').val('');
	               $('#txtEstado_asistentes_eventos_mercadotecnia').val('');
	            }

	        });

			//Autocomplete para recuperar los datos de una localidad 
	        $('#txtLocalidad_asistentes_eventos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtLocalidadID_asistentes_eventos_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/localidades/autocomplete",
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
	             $('#txtLocalidadID_asistentes_eventos_mercadotecnia').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/localidades/get_datos',
	                  { 
	                  	strBusqueda:$("#txtLocalidadID_asistentes_eventos_mercadotecnia").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtLocalidad_asistentes_eventos_mercadotecnia").val(data.row.localidad);
	                       $("#txtMunicipio_asistentes_eventos_mercadotecnia").val(data.row.municipio);
	                       $("#txtEstado_asistentes_eventos_mercadotecnia").val(data.row.estado);
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
	        
	        //Verificar que exista id de la localidad cuando pierda el enfoque la caja de texto
	        $('#txtLocalidad_asistentes_eventos_mercadotecnia').focusout(function(e){
	            //Si no existe id de la localidad
	            if($('#txtLocalidadID_asistentes_eventos_mercadotecnia').val() == '' ||
	               $('#txtLocalidad_asistentes_eventos_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtLocalidadID_asistentes_eventos_mercadotecnia').val('');
	               $('#txtLocalidad_asistentes_eventos_mercadotecnia').val('');
	               $('#txtMunicipio_asistentes_eventos_mercadotecnia').val('');
	               $('#txtEstado_asistentes_eventos_mercadotecnia').val('');
	            }
	            
	        });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_asistentes_eventos_mercadotecnia').on('click','button.btn',function(){
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
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_eventos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_eventos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_eventos_mercadotecnia').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_eventos_mercadotecnia').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_eventos_mercadotecnia').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_eventos_mercadotecnia').data('DateTimePicker').maxDate(e.date);
			});

			//Paginación de registros
			$('#pagLinks_eventos_mercadotecnia').on('click','a',function(event){
				event.preventDefault();
				intPaginaEventosMercadotecnia = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_eventos_mercadotecnia();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_eventos_mercadotecnia').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_asistentes_eventos_mercadotecnia();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_eventos_mercadotecnia();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_eventos_mercadotecnia').addClass("estatus-NUEVO");
				//Abrir modal
				 objEventosMercadotecnia = $('#EventosMercadotecniaBox').bPopup({
											   appendTo: '#EventosMercadotecniaContent', 
				                               contentContainer: 'EventosMercadotecniaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_eventos_mercadotecnia').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_eventos_mercadotecnia').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_eventos_mercadotecnia();
		});
	</script>