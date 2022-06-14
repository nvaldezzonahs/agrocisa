	<div id="ProspectosVisitasCRMContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_prospectos_visitas_crm" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_prospectos_visitas_crm" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_prospectos_visitas_crm">Fecha inicial</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_prospectos_visitas_crm'>
				                    <input class="form-control" id="txtFechaInicialBusq_prospectos_visitas_crm"
				                    		name= "strFechaInicialBusq_prospectos_visitas_crm" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Hora inicial-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtHoraInicialBusq_prospectos_visitas_crm">Hora</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class="input-group bootstrap-timepicker timepicker" id="dteHoraInicialBusq_prospectos_visitas_crm">
						            <input 	id="txtHoraInicialBusq_prospectos_visitas_crm"
						            		name= "strHoraInicialBusq_prospectos_visitas_crm" 
						            		type="text" value=""  tabindex="1"  
						            		placeholder="Ingrese hora" class="form-control input-small" />
						            <span class="input-group-addon">
						            	<i class="glyphicon glyphicon-time"></i>
						            </span>
						        </div>
							</div>
						</div>
					</div>
					<!--Fecha final-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaFinalBusq_prospectos_visitas_crm">Fecha final</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_prospectos_visitas_crm'>
				                    <input class="form-control" id="txtFechaFinalBusq_prospectos_visitas_crm"
				                    		name= "strFechaFinalBusq_prospectos_visitas_crm" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Hora final-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtHoraFinalBusq_prospectos_visitas_crm">Hora</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class="input-group bootstrap-timepicker timepicker" id="dteHoraFinalBusq_prospectos_visitas_crm">
						            <input 	id="txtHoraFinalBusq_prospectos_visitas_crm"
						            		name= "strHoraFinalBusq_prospectos_visitas_crm" 
						            		type="text" value=""  tabindex="1"
						            		placeholder="Ingrese hora" class="form-control input-small" />
						            <span class="input-group-addon">
						            	<i class="glyphicon glyphicon-time"></i>
						            </span>
						        </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los módulos activos-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
								<input id="txtModuloIDBusq_prospectos_visitas_crm" 
									   name="intModuloIDBusq_prospectos_visitas_crm"  type="hidden" 
									   value="" />
								<label for="txtModuloBusq_prospectos_visitas_crm">Módulo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtModuloBusq_prospectos_visitas_crm" 
										name="strModuloBusq_prospectos_visitas_crm" type="text" value="" tabindex="1" placeholder="Ingrese módulo" maxlength="250" />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Autocomplete que contiene los prospectos activos-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta para recuperar el id del prospecto seleccionado-->
								<input id="txtProspectoIDBusq_prospectos_visitas_crm" 
									   name="intProspectoIDBusq_prospectos_visitas_crm"  type="hidden" 
									   value="" />
								<label for="txtProspectoBusq_prospectos_visitas_crm">Prospecto</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProspectoBusq_prospectos_visitas_crm" 
										name="strProspectoBusq_prospectos_visitas_crm" type="text" value="" tabindex="1" placeholder="Ingrese prospecto" maxlength="250" />
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los vendedores activos-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta para recuperar el id del vendedor seleccionado-->
								<input id="txtVendedorIDBusq_prospectos_visitas_crm" 
									   name="intVendedorIDBusq_prospectos_visitas_crm"  type="hidden" 
									   value="" />
								<label for="txtVendedorBusq_prospectos_visitas_crm">Vendedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtVendedorBusq_prospectos_visitas_crm" 
										name="strVendedorBusq_prospectos_visitas_crm" type="text" value="" tabindex="1" placeholder="Ingrese vendedor" maxlength="250" />
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_prospectos_visitas_crm"
									onclick="validar_paginacion_prospectos_visitas_crm();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_prospectos_visitas_crm" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_prospectos_visitas_crm"
									onclick="reporte_prospectos_visitas_crm('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_prospectos_visitas_crm"
									onclick="reporte_prospectos_visitas_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas
				*/
				td.movil:nth-of-type(1):before {content: "Prospecto"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Próxima"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Módulo"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Comentario"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_prospectos_visitas_crm">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Prospecto</th>
							<th class="movil">Fecha</th>
							<th class="movil">Próxima</th>
							<th class="movil">Módulo</th>
							<th class="movil">Comentario</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_prospectos_visitas_crm" type="text/template"> 
					{{#rows}}
						<tr class="movil">
							<td class="movil">{{prospecto}}</td>
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{proxima_visita}}</td>
							<td class="movil">{{modulo}}</td>
							<td class="movil">{{comentario}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_prospectos_visitas_crm({{prospecto_visita_id}})"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Seguimiento del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionSeguimiento}}"  
										onclick="seguimiento_prospectos_visitas_crm({{prospecto_visita_id}})"  
										title="Seguimiento">
									<span class="glyphicon glyphicon-share"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_prospectos_visitas_crm({{prospecto_visita_id}}, {{prospecto_id}});"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Reprogramación del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionCancelar}}" 
										onclick="abrir_reprogramacion_prospectos_visitas_crm({{prospecto_visita_id}})" 
										title="Reprogramar">
									<span class="glyphicon glyphicon-time"></span>
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_prospectos_visitas_crm"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_prospectos_visitas_crm">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Visitas-->
		<div id="ProspectosVisitasCRMBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_prospectos_visitas_crm"  class="ModalBodyTitle">
			<h1>Visitas al Prospecto</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmProspectosVisitasCRM" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmProspectosVisitasCRM"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
						<!--Autocomplete que contiene los prospectos activos-->
						<div id="divProspecto_prospectos_visitas_crm" class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtProspectoVisitaID_prospectos_visitas_crm" 
										   name="intProspectoVisitaID_prospectos_visitas_crm" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la visita de referencia-->
									<input id="txtProspectoVisitaReferencia_prospectos_visitas_crm" 
										   name="intProspectoVisitaReferencia_prospectos_visitas_crm" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el id del prospecto seleccionado-->
									<input id="txtProspectoID_prospectos_visitas_crm" 
										   name="intProspectoID_prospectos_visitas_crm" 
										   type="hidden" value="">
									</input>
									<label for="txtProspecto_prospectos_visitas_crm">
										Prospecto
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProspecto_prospectos_visitas_crm" 
											name="strProspecto_prospectos_visitas_crm" type="text" value=""  tabindex="1" placeholder="Ingrese prospecto" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Fecha de creación-->
						<div id="divFechaCreacion_prospectos_visitas_crm" class="col-sm-3 col-md-3 col-lg-3 col-xs-12 no-mostrar">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaCreacion_prospectos_visitas_crm">
										Fecha de captura
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFechaCreacion_prospectos_visitas_crm" 
											name="strFechaCreacion_prospectos_visitas_crm" type="text" value="">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_prospectos_visitas_crm">Fecha de la visita</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_prospectos_visitas_crm'>
					                    <input class="form-control" id="txtFecha_prospectos_visitas_crm"
					                    		name= "strFecha_prospectos_visitas_crm" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Hora original (próxima visita)-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHora_prospectos_visitas_crm">Hora</label>
								</div>
								<div  id="divFechaMsjValidacion"   class="col-md-12">
									<div class="input-group bootstrap-timepicker timepicker" id="dteHora_prospectos_visitas_crm">
							            <input 	id="txtHora_prospectos_visitas_crm"
							            		name= "strHora_prospectos_visitas_crm" 
							            		type="text" 
							            		class="form-control input-small" 
							            		tabindex="1" placeholder="Ingrese hora" 
							            		disabled />
							            <span class="input-group-addon">
							            	<i class="glyphicon glyphicon-time"></i>
							            </span>
							        </div>
								</div>
							</div>
						</div>
						<!--Fecha de la próxima visita-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaProximaVisita_prospectos_visitas_crm">Próxima visita</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaProximaVisita_prospectos_visitas_crm'>
					                    <input class="form-control" id="txtFechaProximaVisita_prospectos_visitas_crm"
					                    		name= "strFechaProximaVisita_prospectos_visitas_crm" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Hora original (próxima visita)-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHoraProximaVisita_prospectos_visitas_crm">Hora</label>
								</div>
								<div  id="divFechaMsjValidacion"  class="col-md-12">
									<div class="input-group bootstrap-timepicker timepicker" id="dteHoraProximaVisita_prospectos_visitas_crm">
							            <input 	id="txtHoraProximaVisita_prospectos_visitas_crm"
							            		name= "strHoraProximaVisita_prospectos_visitas_crm" 
							            		type="text" 
							            		class="form-control input-small"
							            		tabindex="1" placeholder="Ingrese hora" 
							            		disabled />
							            <span class="input-group-addon">
							            	<i class="glyphicon glyphicon-time"></i>
							            </span>
							        </div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene los módulos activos-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
									<input id="txtModuloID_prospectos_visitas_crm" 
										   name="intModuloID_prospectos_visitas_crm"  type="hidden" 
										   value="" />
									<label for="txtModulo_prospectos_visitas_crm">Módulo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtModulo_prospectos_visitas_crm" 
											name="strModulo_prospectos_visitas_crm" type="text" value="" 
											tabindex="1" placeholder="Ingrese módulo" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las estrategias activas-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id de la estrategia seleccionada-->
									<input id="txtEstrategiaID_prospectos_visitas_crm" 
										   name="intEstrategiaID_prospectos_visitas_crm" 
										   type="hidden" value="">
									</input>
									<label for="txtEstrategia_prospectos_visitas_crm">
										Estrategia
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEstrategia_prospectos_visitas_crm" 
											name="strEstrategia_prospectos_visitas_crm" type="text" value=""   tabindex="1" placeholder="Ingrese estrategia" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Autocomplete que contiene los motivos de visitas activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del motivo de visita seleccionado-->
									<input id="txtMotivoVisitaID_prospectos_visitas_crm" 
									       name="intMotivoVisitaID_prospectos_visitas_crm" type="hidden" value="">
									</input>
									<label for="txtMotivoVisita_prospectos_visitas_crm">Motivo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMotivoVisita_prospectos_visitas_crm" 
												name="strMotivoVisita_prospectos_visitas_crm" type="text" value="" 
												tabindex="1" placeholder="Ingrese motivo" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las descripciones de maquinaria activas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la descripción de maquinaria seleccionada-->
									<input id="txtMaquinariaDescripcionID_prospectos_visitas_crm" 
										   name="intMaquinariaDescripcionID_prospectos_visitas_crm"  
										   type="hidden" value="">
									</input>
									<label for="txtMaquinariaDescripcion_prospectos_visitas_crm">Descripción de maquinaria</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMaquinariaDescripcion_prospectos_visitas_crm" 
											name="strMaquinariaDescripcion_prospectos_visitas_crm" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Madurez-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbMadurez_prospectos_visitas_crm">Madurez</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMadurez_prospectos_visitas_crm" 
									 		name="strMadurez_prospectos_visitas_crm" tabindex="1">
									 	<option value="">Seleccione una opción</option>
                          				<option value="1">1</option>
                          				<option value="2">2</option>
                          				<option value="3">3</option>
                          				<option value="4">4</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Probabilidad de compra-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaProbabilidadCompra_prospectos_visitas_crm">Probabilidad de compra</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaProbabilidadCompra_prospectos_visitas_crm'>
					                    <input class="form-control" id="txtFechaProbabilidadCompra_prospectos_visitas_crm"
					                    		name= "strFechaProbabilidadCompra_prospectos_visitas_crm" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Condiciones de pago-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCondicionesPago_prospectos_visitas_crm">Condiciones de pago</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbCondicionesPago_prospectos_visitas_crm" 
									 		name="strCondicionesPago_prospectos_visitas_crm" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="CONTADO">CONTADO</option>
                          				<option value="CREDITO">CREDITO</option>
                     				</select>
								</div>
							</div>
						</div>
				    	<!--Plazo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbPlazo_prospectos_visitas_crm">Plazo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbPlazo_prospectos_visitas_crm" 
									 		name="strPlazo_prospectos_visitas_crm" tabindex="1">
									 	<option value="">Seleccione una opción</option>
                          				<option value="0-30 DIAS">0-30 DIAS</option>
                          				<option value="31-60 DIAS">31-60 DIAS</option>
                          				<option value="61-90 DIAS">61-90 DIAS</option>
                          				<option value="91-180 DIAS">91-180 DIAS</option>
                          				<option value="181-360 DIAS">181-360 DIAS</option>
                          				<option value="2 AÑOS">2 AÑOS</option>
                          				<option value="3 AÑOS">3 AÑOS</option>
                          				<option value="4 AÑOS">4 AÑOS</option>
                          				<option value="5 AÑOS">5 AÑOS</option>
                     				</select>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Comentarios-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtComentario_prospectos_visitas_crm">Comentarios</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtComentario_prospectos_visitas_crm" 
											   name="strComentario_prospectos_visitas_crm" rows="3" value="" tabindex="1" placeholder="Ingrese comentarios" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_prospectos_visitas_crm"  
									onclick="validar_prospectos_visitas_crm();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Seguimiento del registro-->
							<button class="btn btn-default" id="btnSeguimiento_prospectos_visitas_crm"  
									onclick="seguimiento_prospectos_visitas_crm('');"  title="Seguimiento" tabindex="3">
								<span class="glyphicon glyphicon-share"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_prospectos_visitas_crm"  
									onclick="reporte_registro_prospectos_visitas_crm('', '');"  title="Imprimir registro en PDF" tabindex="4" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Reprogramación del registro-->
							<button class="btn btn-default" id="btnReprogramacion_prospectos_visitas_crm"  
									onclick="abrir_reprogramacion_prospectos_visitas_crm('');"  title="Reprogramar" tabindex="5" disabled>
								<span class="glyphicon glyphicon-time"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_prospectos_visitas_crm"
									type="reset" aria-hidden="true" onclick="cerrar_prospectos_visitas_crm();" 
									title="Cerrar"  tabindex="6">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Visitas-->

		<!-- Diseño del modal Reprogramación de Visita-->
		<div id="ReprogramacionProspectosVisitasCRMBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_reprogramacion_prospectos_visitas_crm" class="ModalBodyTitle confirmacion-modal-title">
			<h1>Reprogramación de Visita</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmReprogramacionProspectosVisitasCRM" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmReprogramacionProspectosVisitasCRM"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">	
			 			<!--Fecha original (próxima visita)-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtProspectoVisitaID_reprogramacion_prospectos_visitas_crm" 
										   name="intProspectoVisitaID_reprogramacion_prospectos_visitas_crm" type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Visitas-->
									<input id="txtModalVisitas_reprogramacion_prospectos_visitas_crm" 
										   name="strModalVisitas_reprogramacion_prospectos_visitas_crm" 
										   type="hidden" value="" />
									<label for="txtFechaOriginal_reprogramacion_prospectos_visitas_crm">Próxima visita</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaOriginal_reprogramacion_prospectos_visitas_crm'>
					                    <input class="form-control" id="txtFechaOriginal_reprogramacion_prospectos_visitas_crm"
					                    		name= "strFechaOriginal_reprogramacion_prospectos_visitas_crm" 
					                    		type="text" value="" disabled/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Hora original (próxima visita)-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHoraOriginal_reprogramacion_prospectos_visitas_crm">Hora</label>
								</div>
								<div class="col-md-12">
									<div class="input-group bootstrap-timepicker timepicker" id="dteHoraOriginal_reprogramacion_prospectos_visitas_crm">
							            <input 	id="txtHoraOriginal_reprogramacion_prospectos_visitas_crm"
							            		name= "strHoraOriginal_reprogramacion_prospectos_visitas_crm" 
							            		type="text" 
							            		class="form-control input-small" 
							            		disabled />
							            <span class="input-group-addon">
							            	<i class="glyphicon glyphicon-time"></i>
							            </span>
							        </div>
								</div>
							</div>
						</div>	
					</div>
					<div class="row">
						<!--Fecha reprogramada-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaReprogramada_reprogramacion_prospectos_visitas_crm">Fecha de reprogramación</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaReprogramada_reprogramacion_prospectos_visitas_crm'>
					                    <input class="form-control" id="txtFechaReprogramada_reprogramacion_prospectos_visitas_crm"
					                    		name= "strFechaReprogramada_reprogramacion_prospectos_visitas_crm" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Hora reprogramada-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHoraReprogramada_reprogramacion_prospectos_visitas_crm">Hora</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class="input-group bootstrap-timepicker timepicker" id="dteHoraReprogramada_reprogramacion_prospectos_visitas_crm">
							            <input 	id="txtHoraReprogramada_reprogramacion_prospectos_visitas_crm"
							            		name= "strHoraReprogramada_reprogramacion_prospectos_visitas_crm" 
							            		type="text" value="" tabindex="1" placeholder="Ingrese hora" class="form-control input-small" />
							            <span class="input-group-addon">
							            	<i class="glyphicon glyphicon-time"></i>
							            </span>
							        </div>
								</div>
							</div>
						</div>
					</div>
			 		<div class="row">
			 			<!--Motivo-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMotivoVisita_reprogramacion_prospectos_visitas_crm">Motivo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMotivoVisita_reprogramacion_prospectos_visitas_crm" 
											name="strMotivoVisita_reprogramacion_prospectos_visitas_crm" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<div class="row">
				    	<!--Comentarios-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtComentario_reprogramacion_prospectos_visitas_crm">Comentarios</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtComentario_reprogramacion_prospectos_visitas_crm" 
											   name="strComentario_reprogramacion_prospectos_visitas_crm" rows="4" value="" 
											   tabindex="1" placeholder="Ingrese comentarios" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_reprogramacion_prospectos_visitas_crm"  
									onclick="validar_reprogramacion_prospectos_visitas_crm();"  title="Guardar" tabindex="1">
								<span class="fa fa-floppy-o"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_reprogramacion_prospectos_visitas_crm"
									type="reset" aria-hidden="true" onclick="cerrar_reprogramacion_prospectos_visitas_crm();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Reprogramación de Visita-->
	</div><!--#ProspectosVisitasCRMContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaProspectosVisitasCRM = 0;
		var strUltimaBusquedaProspectosVisitasCRM = "";
		//Variable que se utiliza para asignar objeto del modal Visitas
		var objProspectosVisitasCRM = null;
		//Variable que se utiliza para asignar objeto del modal Reprogramación de Visita
		var objReprogramacionProspectosVisitasCRM = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_prospectos_visitas_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/prospectos_visitas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_prospectos_visitas_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosProspectosVisitasCRM = data.row;
					//Separar la cadena 
					var arrPermisosProspectosVisitasCRM = strPermisosProspectosVisitasCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosProspectosVisitasCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosProspectosVisitasCRM[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_prospectos_visitas_crm').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosProspectosVisitasCRM[i]=='GUARDAR') || (arrPermisosProspectosVisitasCRM[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_prospectos_visitas_crm').removeAttr('disabled');
						}
						else if(arrPermisosProspectosVisitasCRM[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_prospectos_visitas_crm').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_prospectos_visitas_crm();
						}
						else if(arrPermisosProspectosVisitasCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_prospectos_visitas_crm').removeAttr('disabled');
						}
						else if(arrPermisosProspectosVisitasCRM[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_prospectos_visitas_crm').removeAttr('disabled');
						}
						else if(arrPermisosProspectosVisitasCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_prospectos_visitas_crm').removeAttr('disabled');
						}
						else if(arrPermisosProspectosVisitasCRM[i]=='CANCELAR')
						{
							//Habilitar el control (botón reprogramación)
							$('#btnReprogramacion_prospectos_visitas_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}



		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_paginacion_prospectos_visitas_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_paginacion_prospectos_visitas_crm();

			//Validación del formulario de campos obligatorios
			$('#frmBusqueda_prospectos_visitas_crm')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFechaInicialBusq_prospectos_visitas_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista fecha inicial
					                                    if($('#txtHoraInicialBusq_prospectos_visitas_crm').val() !== '' && value === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Seleccione una fecha'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
									  	strHoraInicialBusq_prospectos_visitas_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista hora inicial
					                                    if($('#txtFechaInicialBusq_prospectos_visitas_crm').val() !== '' && value === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Seleccione una hora'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFechaFinalBusq_prospectos_visitas_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista fecha final
					                                    if($('#txtHoraFinalBusq_prospectos_visitas_crm').val() !== '' && value === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Seleccione una fecha'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strHoraFinalBusq_prospectos_visitas_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista hora final
					                                    if($('#txtFechaFinalBusq_prospectos_visitas_crm').val() !== '' && value === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Seleccione una hora'
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
			var bootstrapValidator_paginacion_prospectos_visitas_crm = $('#frmBusqueda_prospectos_visitas_crm').data('bootstrapValidator');
			bootstrapValidator_paginacion_prospectos_visitas_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_paginacion_prospectos_visitas_crm.isValid())
			{
				//Hacer llamado a la función  para cargar los registros en el grid
				paginacion_prospectos_visitas_crm();
			}
			else 
				return;
		}


		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_paginacion_prospectos_visitas_crm()
		{
			try
			{
				$('#frmBusqueda_prospectos_visitas_crm').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para la búsqueda de registros
		function paginacion_prospectos_visitas_crm() 
		{

			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaProspectosVisitasCRM =($('#txtFechaInicialBusq_prospectos_visitas_crm').val()+
   												       $('#txtHoraInicialBusq_prospectos_visitas_crm').val()+
   													   $('#txtFechaFinalBusq_prospectos_visitas_crm').val()+
   													   $('#txtHoraFinalBusq_prospectos_visitas_crm').val()+
   													   $('#txtModuloIDBusq_prospectos_visitas_crm').val()+
   													   $('#txtProspectoIDBusq_prospectos_visitas_crm').val()+
   													   $('#txtVendedorIDBusq_prospectos_visitas_crm').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaProspectosVisitasCRM != strUltimaBusquedaProspectosVisitasCRM)
			{
				intPaginaProspectosVisitasCRM = 0;
				strUltimaBusquedaProspectosVisitasCRM = strNuevaBusquedaProspectosVisitasCRM;
			}

		
			//Asignar valores para la búsqueda de registros
			var dteFechaInicialBusq = $.formatFechaMysql($('#txtFechaInicialBusq_prospectos_visitas_crm').val());
			var dteFechaFinalBusq =$.formatFechaMysql($('#txtFechaFinalBusq_prospectos_visitas_crm').val());

			//Hacer un llamado a la función para convertir hora a formato 24
			var strHoraInicialBusq = convertirHora12a24($('#txtHoraInicialBusq_prospectos_visitas_crm').val());
			var strHoraFinalBusq = convertirHora12a24($('#txtHoraFinalBusq_prospectos_visitas_crm').val());


			//Si existe fecha y hora inicial
			if(dteFechaInicialBusq != '' && strHoraInicialBusq != '')
			{
				//Concatenar los datos de la fecha y hora
				dteFechaInicialBusq += ' '+strHoraInicialBusq;
			}

			//Si existe fecha y hora final
			if(dteFechaFinalBusq != '' && strHoraFinalBusq != '')
			{
				//Concatenar los datos de la fecha y hora
				dteFechaFinalBusq += ' '+strHoraFinalBusq;
				
			}


			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('crm/prospectos_visitas/get_paginacion',
					{
						intProspectoID: $('#txtProspectoIDBusq_prospectos_visitas_crm').val(),
					 	dteFechaInicial: dteFechaInicialBusq,
					 	dteFechaFinal: dteFechaFinalBusq,
					 	intModuloID: $('#txtModuloIDBusq_prospectos_visitas_crm').val(),
					 	intVendedorID: $('#txtVendedorIDBusq_prospectos_visitas_crm').val(),
					 	intPagina: intPaginaProspectosVisitasCRM,
					 	strPermisosAcceso: $('#txtAcciones_prospectos_visitas_crm').val()
					},
					function(data){
						$('#dg_prospectos_visitas_crm tbody').empty();
						var tmpProspectosVisitasCRM = Mustache.render($('#plantilla_prospectos_visitas_crm').html(),data);
						$('#dg_prospectos_visitas_crm tbody').html(tmpProspectosVisitasCRM);
						$('#pagLinks_prospectos_visitas_crm').html(data.paginacion);
						$('#numElementos_prospectos_visitas_crm').html(data.total_rows);
						intPaginaProspectosVisitasCRM = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_prospectos_visitas_crm(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/prospectos_visitas/';

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


			//Asignar valores para la búsqueda de registros
			var dteFechaInicialBusq = $.formatFechaMysql($('#txtFechaInicialBusq_prospectos_visitas_crm').val());
			var dteFechaFinalBusq =$.formatFechaMysql($('#txtFechaFinalBusq_prospectos_visitas_crm').val());

			//Hacer un llamado a la función para convertir hora a formato 24
			var strHoraInicialBusq = convertirHora12a24($('#txtHoraInicialBusq_prospectos_visitas_crm').val());
			var strHoraFinalBusq = convertirHora12a24($('#txtHoraFinalBusq_prospectos_visitas_crm').val());

			//Si existe fecha y hora inicial
			if(dteFechaInicialBusq != '' && strHoraInicialBusq != '')
			{
				//Concatenar los datos de la fecha y hora
				dteFechaInicialBusq += ' '+strHoraInicialBusq;
			}

			//Si existe fecha y hora final
			if(dteFechaFinalBusq != '' && strHoraFinalBusq != '')
			{
				//Concatenar los datos de la fecha y hora
				dteFechaFinalBusq += ' '+strHoraFinalBusq;
				
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'intProspectoID': $('#txtProspectoIDBusq_prospectos_visitas_crm').val(),
										'dteFechaInicial': dteFechaInicialBusq,
										'strHoraInicial': $('#txtHoraInicialBusq_prospectos_visitas_crm').val(),
										'dteFechaFinal': dteFechaFinalBusq,
										'strHoraFinal': $('#txtHoraFinalBusq_prospectos_visitas_crm').val(),
										'intModuloID': $('#txtModuloIDBusq_prospectos_visitas_crm').val(),
										'intVendedorID': $('#txtVendedorIDBusq_prospectos_visitas_crm').val()
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_prospectos_visitas_crm(prospectoVisitaID, prospectoID) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intProspectoVisitaID = 0;
			var intProspectoID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(prospectoVisitaID == '')
			{
				intProspectoVisitaID = $('#txtProspectoVisitaID_prospectos_visitas_crm').val();
				intProspectoID = $('#txtProspectoID_prospectos_visitas_crm').val();
			}
			else
			{
				intProspectoVisitaID = prospectoVisitaID;
				intProspectoID = prospectoID;
			}
			
			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'crm/prospectos_visitas/get_reporte_registro',
							'data' : {
										'intProspectoVisitaID': intProspectoVisitaID,
										'intProspectoID': intProspectoID
									 }
						   };


			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

	
		/*******************************************************************************************************************
		Funciones del modal Visitas
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_prospectos_visitas_crm(tipoAccion)
		{
			//Incializar formulario
			$('#frmProspectosVisitasCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_prospectos_visitas_crm();
			//Limpiar cajas de texto ocultas
			$('#frmProspectosVisitasCRM').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_prospectos_visitas_crm');
			//Habilitar todos los elementos del formulario
			$('#frmProspectosVisitasCRM').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_prospectos_visitas_crm').val(fechaActual());
			//Inicializar datetimepicker
			$('#dteFechaProbabilidadCompra_prospectos_visitas_crm').data("DateTimePicker").date(fechaActual());
			$('#txtFechaProbabilidadCompra_prospectos_visitas_crm').val('');
			$('#dteFechaProximaVisita_prospectos_visitas_crm').data("DateTimePicker").date(fechaActual());
			$('#txtFechaProximaVisita_prospectos_visitas_crm').val('');
			//Asignar la hora actual
			$('#txtHora_prospectos_visitas_crm').val(horaActualSinSegundos());  
			//Inicializar timepicker
			$('#txtHoraProximaVisita_prospectos_visitas_crm').timepicker('setTime', '12:00 PM');
			$('#txtHoraProximaVisita_prospectos_visitas_crm').val('');
			//Asignar NO para indicar que no se ha abierto el modal Reprogramación de Visita
			$('#txtModalVisitas_reprogramacion_prospectos_visitas_crm').val('NO');
			//Ocultar los siguientes botones
			$("#btnSeguimiento_prospectos_visitas_crm").hide();
			$("#btnImprimirRegistro_prospectos_visitas_crm").hide();
			$("#btnReprogramacion_prospectos_visitas_crm").hide();
			//Deshabilitar las siguientes cajas de texto
			$('#txtFechaCreacion_prospectos_visitas_crm').prop('disabled', true);
			

			//$('#txtFecha_prospectos_visitas_crm').prop('disabled', true);

			//Hacer un llamado a la función para cambiar el tamaño del campo prospecto
			cambiar_tamano_campos_prospectos_visitas_crm(tipoAccion);
		}


		//Función para cambiar el tamaño del campo prospecto
		function cambiar_tamano_campos_prospectos_visitas_crm(tipoAccion)
		{
			//Variable que se utiliza para cambiar el tamaño del campo a 12 posiciones
			var strClassMD12 = "col-sm-12 col-md-12 col-lg-12 col-xs-12";
			//Variable que se utiliza para cambiar el tamaño del campo a 9 posiciones
			var strClassMD9 = "col-sm-9 col-md-9 col-lg-9 col-xs-12";

			//Si el tipo de acción corresponde a Nuevo
			if(tipoAccion == 'Nuevo')
			{
				//Quitar clase para cambiar el tamaño del campo a 9 posiciones
				$('#divProspecto_prospectos_visitas_crm').removeClass(strClassMD9);
				//Agregar clase para cambiar el tamaño del campo a 12 posiciones
			    $('#divProspecto_prospectos_visitas_crm').addClass(strClassMD12);
			    //Agregar clase para ocultar div fecha de captura (creación)
				$('#divFechaCreacion_prospectos_visitas_crm').addClass('no-mostrar');
			}
			else
			{
				//Quitar clase para cambiar el tamaño del campo a 12 posiciones
				$('#divProspecto_prospectos_visitas_crm').removeClass(strClassMD12);
				//Agregar clase para cambiar el tamaño del campo a 9 posiciones
			    $('#divProspecto_prospectos_visitas_crm').addClass(strClassMD9);
			    //Quitar clase para mostrar div fecha de captura (creación)
			    $('#divFechaCreacion_prospectos_visitas_crm').removeClass('no-mostrar');
			}
		}

		//Función para inicializar elementos del módulo
		function inicializar_modulo_prospectos_visitas_crm()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtEstrategiaID_prospectos_visitas_crm').val('');
			$('#txtEstrategia_prospectos_visitas_crm').val('');
		}

		//Función para inicializar elementos del módulo (formulario de búsqueda)
		function inicializar_modulo_busq_prospectos_visitas_crm()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtVendedorIDBusq_prospectos_visitas_crm').val('');
			$('#txtVendedorBusq_prospectos_visitas_crm').val('');
		}

		//Función que se utiliza para abrir el modal
		function abrir_prospectos_visitas_crm()
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_prospectos_visitas_crm').addClass("estatus-NUEVO");
			//Abrir modal
            objProspectosVisitasCRM = $('#ProspectosVisitasCRMBox').bPopup({
										  appendTo: '#ProspectosVisitasCRMContent', 
			                              contentContainer: 'ProspectosVisitasCRMM', 
			                              zIndex: 2, 
			                              modalClose: false, 
			                              modal: true, 
			                              follow: [true,false], 
			                              followEasing : "linear", 
			                              easing: "linear", 
			                              modalColor: ('#F0F0F0')});
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_prospectos_visitas_crm()
		{
			try {
				//Cerrar modal
				objProspectosVisitasCRM.close();
				//Si el id de la referencia (para la reprogramación) se recuperó del modal Visitas 
				if($('#txtModalVisitas_reprogramacion_prospectos_visitas_crm').val() == 'SI')
				{
					//Hacer un llamado a la función para cerrar modal Reprogramación de Visita
					cerrar_reprogramacion_prospectos_visitas_crm();
				}
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_prospectos_visitas_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_prospectos_visitas_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_prospectos_visitas_crm();
			//Validación del formulario de campos obligatorios
			$('#frmProspectosVisitasCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strProspecto_prospectos_visitas_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del prospecto
					                                    if($('#txtProspectoID_prospectos_visitas_crm').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un prospecto existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strModulo_prospectos_visitas_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del módulo
					                                    if($('#txtModuloID_prospectos_visitas_crm').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un módulo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strEstrategia_prospectos_visitas_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la estrategia
					                                    if($('#txtEstrategiaID_prospectos_visitas_crm').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una estrategia existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strMaquinariaDescripcion_prospectos_visitas_crm: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la descripción de maquinaria
					                                    if(value !== '' && $('#txtMaquinariaDescripcionID_prospectos_visitas_crm').val() === '') 
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una descripción existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFecha_prospectos_visitas_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strHora_prospectos_visitas_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una hora'}
											}
										},
										strComentario_prospectos_visitas_crm: {
											validators: {
												notEmpty: {message: 'Escriba un comentario'}
											}
										},
										strMotivoVisita_prospectos_visitas_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del motivo de la visita
					                                    if($('#txtMotivoVisitaID_prospectos_visitas_crm').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un motivo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCondicionesPago_prospectos_visitas_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una condición de pago'}
											}
										},
										strMadurez_prospectos_visitas_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una madurez'}
											}
										},
										strPlazo_prospectos_visitas_crm: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                  	//Verificar si la condición de pago es crédito
				                                      	if($('#cmbCondicionesPago_prospectos_visitas_crm').val() === 'CREDITO')
				                                     	{
			                                      			//Si no existe plazo
						                                    if(value == '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Seleccione un plazo'
						                                        };
						                                    }
					                                    } 
					                                    return true;
					                                  }
					                            }
											}
										},
										strFechaProximaVisita_prospectos_visitas_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strHoraProximaVisita_prospectos_visitas_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una hora'}
											}
										}
									 }
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_prospectos_visitas_crm = $('#frmProspectosVisitasCRM').data('bootstrapValidator');
			bootstrapValidator_prospectos_visitas_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_prospectos_visitas_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_prospectos_visitas_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_prospectos_visitas_crm()
		{
			try
			{
				$('#frmProspectosVisitasCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_prospectos_visitas_crm()
		{
			//Asignar datos de la fecha y hora
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaVisita = $.formatFechaMysql($('#txtFecha_prospectos_visitas_crm').val());
			var dteFechaProximaVisita = $.formatFechaMysql($('#txtFechaProximaVisita_prospectos_visitas_crm').val());
			var dteFechaProbabilidadCompra = $.formatFechaMysql($('#txtFechaProbabilidadCompra_prospectos_visitas_crm').val());

			//Hacer un llamado a la función para convertir hora a formato 24
			var strHoraVisita = convertirHora12a24($('#txtHora_prospectos_visitas_crm').val());
			var strHoraProximaVisita = convertirHora12a24($('#txtHoraProximaVisita_prospectos_visitas_crm').val());

			//Concatenar los datos de la fecha y hora
			dteFechaVisita += ' '+strHoraVisita;
			dteFechaProximaVisita += ' '+strHoraProximaVisita;


			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/prospectos_visitas/guardar',
					{ 
						intProspectoVisitaID: $('#txtProspectoVisitaID_prospectos_visitas_crm').val(),
						intProspectoVisitaReferencia: $('#txtProspectoVisitaReferencia_prospectos_visitas_crm').val(),
						intProspectoID: $('#txtProspectoID_prospectos_visitas_crm').val(),
						intModuloID: $('#txtModuloID_prospectos_visitas_crm').val(),
						intEstrategiaID: $('#txtEstrategiaID_prospectos_visitas_crm').val(),
						intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_prospectos_visitas_crm').val(),
						dteFecha:dteFechaVisita,
						strComentario: $('#txtComentario_prospectos_visitas_crm').val(),
						intMotivoVisitaID: $('#txtMotivoVisitaID_prospectos_visitas_crm').val(),
						strMadurez: $('#cmbMadurez_prospectos_visitas_crm').val(),
						dteProbabilidadCompra: dteFechaProbabilidadCompra,
						strCondicionesPago: $('#cmbCondicionesPago_prospectos_visitas_crm').val(),
						strPlazo: $('#cmbPlazo_prospectos_visitas_crm').val(),
						dteProximaVisita: dteFechaProximaVisita
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_prospectos_visitas_crm();
							//Hacer un llamado a la función para cerrar modal
							cerrar_prospectos_visitas_crm();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_prospectos_visitas_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_prospectos_visitas_crm(tipoMensaje, mensaje)
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


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_prospectos_visitas_crm(id)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/prospectos_visitas/get_datos',
			       {intProspectoVisitaID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_prospectos_visitas_crm('Editar');
				          	//Recuperar valores
				            $('#txtProspectoVisitaID_prospectos_visitas_crm').val(data.row.prospecto_visita_id);
				            $('#txtProspectoVisitaReferencia_prospectos_visitas_crm').val(data.row.prospecto_visita_referencia);
				          
				            //Hacer un llamado a la función para asignar los datos de la visita
				            get_datos_visita_prospectos_visitas_crm(data);

				            $('#txtFechaProximaVisita_prospectos_visitas_crm').val(data.row.fecha_proxima_visita);
				            $('#txtHoraProximaVisita_prospectos_visitas_crm').timepicker('setTime', data.row.hora_proxima_visita);

				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_prospectos_visitas_crm').addClass("estatus-ACTIVO");
							//Mostrar los siguientes botones
				            $("#btnImprimirRegistro_prospectos_visitas_crm").show();
			            	$("#btnSeguimiento_prospectos_visitas_crm").show();
			            	$("#btnReprogramacion_prospectos_visitas_crm").show();

					        //Abrir modal
				            objProspectosVisitasCRM = $('#ProspectosVisitasCRMBox').bPopup({
														  appendTo: '#ProspectosVisitasCRMContent', 
							                              contentContainer: 'ProspectosVisitasCRMM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtProspecto_prospectos_visitas_crm').focus();
			       	    }
			       },
			       'json');
			
		}

		//Función para dar seguimiento a la visita seleccionada
		function seguimiento_prospectos_visitas_crm(id)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará el seguimiento de la visita desde el modal
			if(id == '')
			{
				intID = $('#txtProspectoVisitaID_prospectos_visitas_crm').val();

			}
			else
			{
				intID = id;
			}
			
		    	
		    //Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/prospectos_visitas/get_datos',
			       {
			       		intProspectoVisitaID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_prospectos_visitas_crm();
				          	//Recuperar valores
				            $('#txtProspectoVisitaReferencia_prospectos_visitas_crm').val(intID);
				            //Hacer un llamado a la función para asignar los datos de la visita
				            get_datos_visita_prospectos_visitas_crm(data);
				            //Deshabilitar caja de texto
							$('#txtProspecto_prospectos_visitas_crm').attr("disabled", "disabled");
				           	//Hacer un llamado a la función para abrir el modal de visitas
				           	abrir_prospectos_visitas_crm();
				           	//Enfocar caja de texto
						    $('#txtFechaProximaVisita_prospectos_visitas_crm').focus();
			       	    }
			       },
			       'json');
		}

		
		//Función para asignar los datos de una visita
		function get_datos_visita_prospectos_visitas_crm(data)
		{

			//Asignar datos del registro seleccionado
            $('#txtProspectoID_prospectos_visitas_crm').val(data.row.prospecto_id);
            $('#txtProspecto_prospectos_visitas_crm').val(data.row.prospecto);
            $('#txtModuloID_prospectos_visitas_crm').val(data.row.modulo_id);
            $('#txtModulo_prospectos_visitas_crm').val(data.row.modulo);
            $('#txtEstrategiaID_prospectos_visitas_crm').val(data.row.estrategia_id);
            $('#txtEstrategia_prospectos_visitas_crm').val(data.row.estrategia);
            $('#txtMaquinariaDescripcionID_prospectos_visitas_crm').val(data.row.maquinaria_descripcion_id);
            $('#txtMaquinariaDescripcion_prospectos_visitas_crm').val(data.row.maquinaria_descripcion);
            $('#txtFechaCreacion_prospectos_visitas_crm').val(data.row.fecha_creacion);
            $('#txtFecha_prospectos_visitas_crm').val(data.row.fecha_visita);
            $('#txtHora_prospectos_visitas_crm').timepicker('setTime', data.row.hora_visita);
            $('#txtComentario_prospectos_visitas_crm').val(data.row.comentario);
            $('#txtMotivoVisitaID_prospectos_visitas_crm').val(data.row.motivo_visita_id);
            $('#txtMotivoVisita_prospectos_visitas_crm').val(data.row.motivo_visita);
            $('#cmbMadurez_prospectos_visitas_crm').val(data.row.madurez);
            $('#txtFechaProbabilidadCompra_prospectos_visitas_crm').val(data.row.probabilidad_compra);
            $('#cmbCondicionesPago_prospectos_visitas_crm').val(data.row.condiciones_pago);
            $('#cmbPlazo_prospectos_visitas_crm').val(data.row.plazo);
		} 


		/*******************************************************************************************************************
		Funciones del modal Reprogramación de Visita
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_reprogramacion_prospectos_visitas_crm()
		{
			//Incializar formulario
			$('#frmReprogramacionProspectosVisitasCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_reprogramacion_prospectos_visitas_crm();
			//Limpiar cajas de texto ocultas
			$('#frmReprogramacionProspectosVisitasCRM').find('input[type=hidden]').val('');
			//Dependiendo del estatus cambiar el color del encabezado 
	        $('#divEncabezadoModal_reprogramacion_prospectos_visitas_crm').addClass("estatus-ACTIVO");
	        //Inicializar datetimepicker
	        $('#dteFechaReprogramada_reprogramacion_prospectos_visitas_crm').data("DateTimePicker").date(fechaActual());
			$('#txtFechaReprogramada_reprogramacion_prospectos_visitas_crm').val('');
	        //Inicializar timepicker
			$('#txtHoraReprogramada_reprogramacion_prospectos_visitas_crm').timepicker('setTime', '12:00 PM');
			$('#txtHoraReprogramada_reprogramacion_prospectos_visitas_crm').val('');
		}

		//Función que se utiliza para abrir el modal
		function abrir_reprogramacion_prospectos_visitas_crm(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
		    nuevo_reprogramacion_prospectos_visitas_crm();

			//Variable que se utiliza para asignar id de la visita
			var intID = 0;
			//Si no existe id, significa que se reprogramara la visita desde el modal
			if(id == '')
			{
				intID = $('#txtProspectoVisitaID_prospectos_visitas_crm').val();
				$('#txtModalVisitas_reprogramacion_prospectos_visitas_crm').val('SI');
			}
			else
			{
				intID = id;
				$('#txtModalVisitas_reprogramacion_prospectos_visitas_crm').val('NO');
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/prospectos_visitas/get_datos',
			       {intProspectoVisitaID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	
				          	//Recuperar valores
				            $('#txtProspectoVisitaID_reprogramacion_prospectos_visitas_crm').val(data.row.prospecto_visita_id);
				            $('#txtFechaOriginal_reprogramacion_prospectos_visitas_crm').val(data.row.fecha_proxima_visita);
				            $('#txtHoraOriginal_reprogramacion_prospectos_visitas_crm').val(data.row.hora_proxima_visita);
				            $('#txtMotivoVisita_reprogramacion_prospectos_visitas_crm').val(data.row.motivo_visita);
				            
					        //Abrir modal
				            objReprogramacionProspectosVisitasCRM = $('#ReprogramacionProspectosVisitasCRMBox').bPopup({
																	  appendTo: '#ProspectosVisitasCRMContent', 
										                              contentContainer: 'ProspectosVisitasCRMM', 
										                              zIndex: 2, 
										                              modalClose: false, 
										                              modal: true, 
										                              follow: [true,false], 
										                              followEasing : "linear", 
										                              easing: "linear", 
										                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtFechaReprogramada_reprogramacion_prospectos_visitas_crm').focus();
			       	    }
			       },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_reprogramacion_prospectos_visitas_crm()
		{
			try {
				//Cerrar modal
				objReprogramacionProspectosVisitasCRM.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_prospectos_visitas_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_reprogramacion_prospectos_visitas_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_reprogramacion_prospectos_visitas_crm();
			//Validación del formulario de campos obligatorios
			$('#frmReprogramacionProspectosVisitasCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaReprogramada_reprogramacion_prospectos_visitas_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strHoraReprogramada_reprogramacion_prospectos_visitas_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una hora'}
											}
										},
										strComentario_reprogramacion_prospectos_visitas_crm: {
											validators: {
												notEmpty: {message: 'Escriba un comentario'}
											}
										}
									 }
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_reprogramacion_prospectos_visitas_crm = $('#frmReprogramacionProspectosVisitasCRM').data('bootstrapValidator');
			bootstrapValidator_reprogramacion_prospectos_visitas_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_reprogramacion_prospectos_visitas_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_reprogramacion_prospectos_visitas_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_reprogramacion_prospectos_visitas_crm()
		{
			try
			{
				$('#frmReprogramacionProspectosVisitasCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar los datos de un registro
		function guardar_reprogramacion_prospectos_visitas_crm()
		{

			//Asignar datos de la fecha y hora
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaOriginalVisita = $.formatFechaMysql($('#txtFechaOriginal_reprogramacion_prospectos_visitas_crm').val());
			var dteFechaReprogramadaVisita = $.formatFechaMysql($('#txtFechaReprogramada_reprogramacion_prospectos_visitas_crm').val());
			
			//Hacer un llamado a la función para convertir hora a formato 24
			var strHoraOriginal = convertirHora12a24($('#txtHoraOriginal_reprogramacion_prospectos_visitas_crm').val());
			var strHoraReprogramada = convertirHora12a24($('#txtHoraReprogramada_reprogramacion_prospectos_visitas_crm').val());

			//Concatenar los datos de la fecha y hora
			dteFechaOriginalVisita += ' '+strHoraOriginal;
			dteFechaReprogramadaVisita += ' '+strHoraReprogramada;

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/prospectos_visitas/guardar_reprogramacion_visitas',
					{ 
						intProspectoVisitaID: $('#txtProspectoVisitaID_reprogramacion_prospectos_visitas_crm').val(),
						dteFechaOriginal: dteFechaOriginalVisita,
						dteFechaReprogramada: dteFechaReprogramadaVisita,
						strComentario: $('#txtComentario_reprogramacion_prospectos_visitas_crm').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid 
							paginacion_prospectos_visitas_crm();
							//Hacer un llamado a la función para cerrar modal
							cerrar_reprogramacion_prospectos_visitas_crm();

							//Si el id de la referencia (para la reprogramación) se recuperó del modal Visitas 
						  	if($('#txtModalVisitas_reprogramacion_prospectos_visitas_crm').val() == 'SI')
						  	{
						  		//Hacer un llamado a la función para cerrar modal Visitas
						 	 	cerrar_prospectos_visitas_crm();
						  	}               
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_prospectos_visitas_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Visitas
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_prospectos_visitas_crm').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaProximaVisita_prospectos_visitas_crm').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaProbabilidadCompra_prospectos_visitas_crm').datetimepicker({format: 'DD/MM/YYYY'});

			//Comparar las fechas de la visita cuando cambie la fecha
			$('#dteFecha_prospectos_visitas_crm').on('dp.change', function (e) {
				//Hacer un llamado a la función para comparar dos fechas
				$('#txtFechaProximaVisita_prospectos_visitas_crm').val($.compararFechas('txtFecha_prospectos_visitas_crm', 'txtFechaProximaVisita_prospectos_visitas_crm'));

			});

			//Comparar las fechas de la visita cuando cambie la fecha
			$('#dteFechaProximaVisita_prospectos_visitas_crm').on('dp.change', function (e) {
				//Hacer un llamado a la función para comparar dos fechas
				$('#txtFechaProximaVisita_prospectos_visitas_crm').val($.compararFechas('txtFecha_prospectos_visitas_crm', 'txtFechaProximaVisita_prospectos_visitas_crm'));
			});

			//Agregar timepicker para seleccionar una hora
			$('#txtHora_prospectos_visitas_crm').timepicker({minuteStep: 1});
			$('#txtHora_prospectos_visitas_crm').timepicker('setTime', '12:00 PM');

			//Agregar timepicker para seleccionar una hora para la próxima visita
			$('#txtHoraProximaVisita_prospectos_visitas_crm').timepicker({minuteStep: 1});
			$('#txtHoraProximaVisita_prospectos_visitas_crm').timepicker('setTime', '12:00 PM');

			//Autocomplete para recuperar los datos de un prospecto 
	        $('#txtProspecto_prospectos_visitas_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_prospectos_visitas_crm').val('');
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
	             $('#txtProspectoID_prospectos_visitas_crm').val(ui.item.data);
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
	        $('#txtProspecto_prospectos_visitas_crm').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoID_prospectos_visitas_crm').val() == '' ||
	               $('#txtProspecto_prospectos_visitas_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_prospectos_visitas_crm').val('');
	               $('#txtProspecto_prospectos_visitas_crm').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un módulo 
	        $('#txtModulo_prospectos_visitas_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloID_prospectos_visitas_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del módulo
	               inicializar_modulo_prospectos_visitas_crm();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/modulos/autocomplete",
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
	             $('#txtModuloID_prospectos_visitas_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del módulo cuando pierda el enfoque la caja de texto
	        $('#txtModulo_prospectos_visitas_crm').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloID_prospectos_visitas_crm').val() == '' ||
	               $('#txtModulo_prospectos_visitas_crm').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtModuloID_prospectos_visitas_crm').val('');
	                $('#txtModulo_prospectos_visitas_crm').val('');
	                //Hacer un llamado a la función para inicializar elementos del módulo
	                inicializar_modulo_prospectos_visitas_crm();
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una estrategia
	        $('#txtEstrategia_prospectos_visitas_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEstrategiaID_prospectos_visitas_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/estrategias/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: $('#txtModuloID_prospectos_visitas_crm').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtEstrategiaID_prospectos_visitas_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la estrategia cuando pierda el enfoque la caja de texto
	        $('#txtEstrategia_prospectos_visitas_crm').focusout(function(e){
	            //Si no existe id de la estrategia
	            if($('#txtEstrategiaID_prospectos_visitas_crm').val() == '' ||
	               $('#txtEstrategia_prospectos_visitas_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEstrategiaID_prospectos_visitas_crm').val('');
	               $('#txtEstrategia_prospectos_visitas_crm').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un motivo de visita 
	        $('#txtMotivoVisita_prospectos_visitas_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMotivoVisitaID_prospectos_visitas_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/motivos_visitas/autocomplete",
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
	             $('#txtMotivoVisitaID_prospectos_visitas_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del motivo de visita cuando pierda el enfoque la caja de texto
	        $('#txtMotivoVisita_prospectos_visitas_crm').focusout(function(e){
	            //Si no existe id del motivo de visita
	            if($('#txtMotivoVisitaID_prospectos_visitas_crm').val() == '' ||
	               $('#txtMotivoVisita_prospectos_visitas_crm').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtMotivoVisitaID_prospectos_visitas_crm').val('');
	                $('#txtMotivoVisita_prospectos_visitas_crm').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una descripción de maquinaria 
	        $('#txtMaquinariaDescripcion_prospectos_visitas_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMaquinariaDescripcionID_prospectos_visitas_crm').val('');
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
	             //Asignar id del registro seleccionado
	             $('#txtMaquinariaDescripcionID_prospectos_visitas_crm').val(ui.item.data);
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
	        $('#txtMaquinariaDescripcion_prospectos_visitas_crm').focusout(function(e){
	        	//Si no existe id de la descripción de maquinaria
	            if($('#txtMaquinariaDescripcionID_prospectos_visitas_crm').val() == '' ||
	               $('#txtMaquinariaDescripcion_prospectos_visitas_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaDescripcionID_prospectos_visitas_crm').val('');
	               $('#txtMaquinariaDescripcion_prospectos_visitas_crm').val('');
	            }

	        });


	        //Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });


			/*******************************************************************************************************************
			Controles correspondientes al modal Reprogramación de Visita
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFechaReprogramada_reprogramacion_prospectos_visitas_crm').datetimepicker({format: 'DD/MM/YYYY'});
			//Agregar timepicker para seleccionar una hora para la próxima visita
			$('#txtHoraReprogramada_reprogramacion_prospectos_visitas_crm').timepicker({minuteStep: 1});
			$('#txtHoraReprogramada_reprogramacion_prospectos_visitas_crm').timepicker('setTime', '12:00 PM');

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_prospectos_visitas_crm').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_prospectos_visitas_crm').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_prospectos_visitas_crm').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_prospectos_visitas_crm').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_prospectos_visitas_crm').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_prospectos_visitas_crm').data('DateTimePicker').maxDate(e.date);
			});

			//Agregar timepicker para seleccionar una hora
			$('#txtHoraInicialBusq_prospectos_visitas_crm').timepicker({minuteStep: 1});
			$('#txtHoraInicialBusq_prospectos_visitas_crm').timepicker('setTime', '');

			$('#txtHoraFinalBusq_prospectos_visitas_crm').timepicker({minuteStep: 1});
			$('#txtHoraFinalBusq_prospectos_visitas_crm').timepicker('setTime', '');

			//Autocomplete para recuperar los datos de un módulo 
	        $('#txtModuloBusq_prospectos_visitas_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloIDBusq_prospectos_visitas_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del módulo
	               inicializar_modulo_busq_prospectos_visitas_crm();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/modulos/autocomplete",
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
	             $('#txtModuloIDBusq_prospectos_visitas_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del módulo cuando pierda el enfoque la caja de texto
	        $('#txtModuloBusq_prospectos_visitas_crm').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloIDBusq_prospectos_visitas_crm').val() == '' ||
	               $('#txtModuloBusq_prospectos_visitas_crm').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtModuloIDBusq_prospectos_visitas_crm').val('');
	                $('#txtModuloBusq_prospectos_visitas_crm').val('');
	                 //Hacer un llamado a la función para inicializar elementos del módulo
	                inicializar_modulo_busq_prospectos_visitas_crm();
	            }
	            
	        });
            
            //Autocomplete para recuperar los datos de un prospecto 
	        $('#txtProspectoBusq_prospectos_visitas_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_prospectos_visitas_crm').val('');
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
	             $('#txtProspectoIDBusq_prospectos_visitas_crm').val(ui.item.data);
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
	        $('#txtProspectoBusq_prospectos_visitas_crm').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoIDBusq_prospectos_visitas_crm').val() == '' ||
	               $('#txtProspectoBusq_prospectos_visitas_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_prospectos_visitas_crm').val('');
	               $('#txtProspectoBusq_prospectos_visitas_crm').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedorBusq_prospectos_visitas_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorIDBusq_prospectos_visitas_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID:  $('#txtModuloIDBusq_prospectos_visitas_crm').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	               //Asignar id del registro seleccionado
	               $('#txtVendedorIDBusq_prospectos_visitas_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del vendedor cuando pierda el enfoque la caja de texto
	        $('#txtVendedorBusq_prospectos_visitas_crm').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorIDBusq_prospectos_visitas_crm').val() == '' ||
	               $('#txtVendedorBusq_prospectos_visitas_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorIDBusq_prospectos_visitas_crm').val('');
	               $('#txtVendedorBusq_prospectos_visitas_crm').val('');
	            }
	            
	        });

			//Paginación de registros
			$('#pagLinks_prospectos_visitas_crm').on('click','a',function(event){
				event.preventDefault();
				intPaginaProspectosVisitasCRM = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_prospectos_visitas_crm();
			});

			//Abrir modal Visitas cuando se de clic en el botón
			$('#btnNuevo_prospectos_visitas_crm').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_prospectos_visitas_crm('Nuevo');
				//Hacer un llamado a la función para abrir el modal de visitas
				abrir_prospectos_visitas_crm();
				//Enfocar caja de texto
				$('#txtProspecto_prospectos_visitas_crm').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_prospectos_visitas_crm').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_prospectos_visitas_crm();
		});
	</script>