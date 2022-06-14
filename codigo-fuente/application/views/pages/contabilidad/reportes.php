	<div id="ReportesContabilidadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_reportes_contabilidad" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_reportes_contabilidad" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_reportes_contabilidad" 
								   name="strBusqueda_reportes_contabilidad"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_reportes_contabilidad"
										onclick="paginacion_reportes_contabilidad();" 
										title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_reportes_contabilidad" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_reportes_contabilidad"
									onclick="reporte_reportes_contabilidad('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_reportes_contabilidad"
									onclick="reporte_reportes_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla reportes
				*/
				td.movil.a1:nth-of-type(1):before {content: "Título"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Estatus"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}

				 /*
				Definir columnas de la tabla detalles
				*/
				td.movil.b1:nth-of-type(1):before {content: "Agrupador"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Concepto"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Orden"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla cuentas
				*/
				td.movil.c1:nth-of-type(1):before {content: "Cuenta"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_reportes_contabilidad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Título</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_reportes_contabilidad" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{titulo}}</td>
							<td class="movil a2">{{estatus}}</td>
							<td class="td-center movil a3"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_reportes_contabilidad({{reporte_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_reportes_contabilidad({{reporte_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_reportes_contabilidad({{reporte_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_reportes_contabilidad({{reporte_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_reportes_contabilidad({{reporte_id}},'{{estatus}}')"  
										title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="5"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_reportes_contabilidad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_reportes_contabilidad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		
		<!-- Diseño del modal Reportes-->
		<div id="ReportesContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_reportes_contabilidad"  class="ModalBodyTitle">
			<h1>Reportes</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmReportesContabilidad" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmReportesContabilidad"  onsubmit="return(false)" autocomplete="off">
				    <div class="row">
				    	<!--Título-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReporteID_reportes_contabilidad" 
										   name="intReporteID_reportes_contabilidad" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
									<input id="txtEstatus_reportes_contabilidad" 
										   name="strEstatus_reportes_contabilidad" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el título anterior y así evitar duplicidad en caso de que exista otro registro con el mismo título-->
									<input id="txtTituloAnterior_reportes_contabilidad" 
										   name="strTituloAnterior_reportes_contabilidad" type="hidden" value="">
									</input>
									<label for="txtTitulo_reportes_contabilidad">Título</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTitulo_reportes_contabilidad" 
											name="strTitulo_reportes_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese título" maxlength="100">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
									<input id="txtNumDetalles_reportes_contabilidad" 
										   name="intNumDetalles_reportes_contabilidad" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles del reporte</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Botón agregar-->
					                              	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
					                                	<button class="btn btn-primary pull-right" 
					                                			id="btnAgregar_reportes_contabilidad"
					                                			onclick="abrir_detalle_reportes_contabilidad();" 
					                                	     	title="Agregar" tabindex="1"> 
					                                		<span class="glyphicon glyphicon-plus"></span>
					                                	</button>
					                             	</div>
												</div>
												<br>
											</div>
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row ">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_reportes_contabilidad">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Agrupador</th>
																<th class="movil">Concepto</th>
																<th class="movil">Orden</th>
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
																<strong id="numElementos_detalles_reportes_contabilidad">0</strong> encontrados
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
							<button class="btn btn-success" id="btnGuardar_reportes_contabilidad"  
									onclick="validar_reportes_contabilidad();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_reportes_contabilidad"  
									onclick="reporte_registro_reportes_contabilidad('');"  title="Imprimir registro en PDF" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_reportes_contabilidad"  
									onclick="cambiar_estatus_reportes_contabilidad('', 'ACTIVO');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_reportes_contabilidad"  
									onclick="cambiar_estatus_reportes_contabilidad('','INACTIVO');"  title="Restaurar" tabindex="5" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_reportes_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_reportes_contabilidad();" 
									title="Cerrar"  tabindex="6">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Reportes-->

		<!-- Diseño del modal Detalle del Reporte-->
		<div id="DetalleReportesContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_detalle_reportes_contabilidad" class="ModalBodyTitle">
			<h1>Reportes</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_detalle_reportes_contabilidad" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_detalle_reportes_contabilidad" class="active">
									<a data-toggle="tab" href="#informacion_general_detalle_reportes_contabilidad">Información General</a>
								</li>
								<!--Tab que contiene la información de las cuentas contables-->
								<li id="tabCuentas_detalle_reportes_contabilidad">
									<a data-toggle="tab" href="#cuentas_detalle_reportes_contabilidad">Cuentas Contables</a>
								</li>
								<!--Tab que contiene la información de los títulos-->
								<li id="tabTitulos_detalle_reportes_contabilidad">
									<a data-toggle="tab" href="#titulos_detalle_reportes_contabilidad">Títulos</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmDetalleReportesContabilidad" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmDetalleReportesContabilidad"  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_detalle_reportes_contabilidad" class="tab-pane fade in active">
							<div class="row">
								<!--Número de operación-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el renglón del registro seleccionado-->
											<input class="form-control" id="txtRenglon_detalle_reportes_contabilidad"
												   name="intRenglon_detalle_reportes_contabilidad" type="hidden">
										    </input>
										    
											<label for="txtConceptoPadre_detalle_reportes_contabilidad">
												Agrupador
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtConceptoPadre_detalle_reportes_contabilidad" 
													name="strConceptoPadre_detalle_reportes_contabilidad" type="text" value=""  
													tabindex="1" placeholder="Ingrese concepto agrupador" maxlength="100">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Concepto-->
								<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtConcepto_detalle_reportes_contabilidad">
												Concepto
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtConcepto_detalle_reportes_contabilidad" 
													name="strConcepto_detalle_reportes_contabilidad" type="text" value=""  
													tabindex="1" placeholder="Ingrese concepto" maxlength="100">
											</input>
										</div>
									</div>
								</div>
								<!--Orden-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtOrden_detalle_reportes_contabilidad">Orden</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtOrden_detalle_reportes_contabilidad" name="intOrden_detalle_reportes_contabilidad" 
												   type="text" value="" tabindex="1" placeholder="Ingrese orden" maxlength ="3">
											</input>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Información General-->
						<!--Tab - Cuentas Contables-->
						<div id="cuentas_detalle_reportes_contabilidad" class="tab-pane fade">
							<div class="row">
								<!--Autocomplete que contiene las cuentas activas-->
								<div class="col-sm-11 col-md-11 col-lg-11 col-xs-10">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta seleccionada-->
											<input id="txtCuentaID_ctas_detalle_reportes_contabilidad" 
												   name="intCuentaID_ctas_detalle_reportes_contabilidad"  
												   type="hidden" value="">
											</input>
											<label for="txtCuenta_ctas_detalle_reportes_contabilidad">
												Cuenta
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCuenta_ctas_detalle_reportes_contabilidad" 
													name="strCuenta_ctas_detalle_reportes_contabilidad" type="text" value="" 
													placeholder="Ingrese cuenta" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Botón agregar-->
	                          	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
	                            	<button class="btn btn-primary btn-toolBtns pull-right" 
	                            			id="btnAgregar_ctas_detalle_reportes_contabilidad"
	                            			onclick="agregar_renglon_ctas_detalle_reportes_contabilidad();" 
	                            	     	title="Agregar" tabindex="1"> 
	                            		<span class="glyphicon glyphicon-plus"></span>
	                            	</button>
	                         	</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para asignar el número de registros de la tabla facturas relacionadas--> 
											<input id="txtNumCtas_detalle_reportes_contabilidad" 
												   name="intNumCtas_detalle_reportes_contabilidad" type="hidden" value="">
											</input>
											<!--Div que contiene la tabla con las cuentas contables-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row ">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_ctas_detalle_reportes_contabilidad">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Cuenta</th>
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
																<strong id="numElementos_ctas_detalle_reportes_contabilidad">0</strong> encontrados
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Cuentas Contables-->
						<!--Tab - Títulos-->
						<div id="titulos_detalle_reportes_contabilidad" class="tab-pane fade">
							<div class="row">
								<!--Título principal-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTituloPrincipal_detalle_reportes_contabilidad">
												Título principal
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTituloPrincipal_detalle_reportes_contabilidad" 
													name="strTituloPrincipal_detalle_reportes_contabilidad" type="text" value=""  
													tabindex="1" placeholder="Ingrese título principal" maxlength="100">
											</input>
										</div>
									</div>
								</div>
							</div>
								<div class="row">
								<!--Título secundario-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTituloSecundario_detalle_reportes_contabilidad">
												Título secundario
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTituloSecundario_detalle_reportes_contabilidad" 
													name="strTituloSecundario_detalle_reportes_contabilidad" type="text" value=""  
													tabindex="1" placeholder="Ingrese título secundario" maxlength="100">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Título secundario-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTituloTotal_detalle_reportes_contabilidad">
												Título del total
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTituloTotal_detalle_reportes_contabilidad" 
													name="strTituloTotal_detalle_reportes_contabilidad" type="text" value=""  
													tabindex="1" placeholder="Ingrese título para el total" maxlength="100">
											</input>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Títulos-->
					</div><!--Cierre del contenedor de tabs-->
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_detalle_reportes_contabilidad"  
									onclick="validar_detalle_reportes_contabilidad();"  title="Guardar" tabindex="1">
								<span class="fa fa-floppy-o"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_detalle_reportes_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_detalle_reportes_contabilidad();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Detalle del Reporte-->

		
	</div><!--#ReportesContabilidadContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaReportesContabilidad = 0;
		var strUltimaBusquedaReportesContabilidad = "";
		
		//Variable que se utiliza para asignar objeto del modal Reportes
		var objReportesContabilidad = null;
		//Variable que se utiliza para asignar objeto del modal Detalles del reporte
		var objDetalleReportesContabilidad = null;
	

		/*******************************************************************************************************************
		Funciones del objeto Detalles del reporte
		*********************************************************************************************************************/
		// Constructor del objeto detalles
		var objDetallesReporteReportesContabilidad;
		function DetallesReporteReportesContabilidad(detalles)
		{
			this.arrDetalles = detalles;
		}

		//Función para obtener todos los Detalles del reporte
		DetallesReporteReportesContabilidad.prototype.getDetalles = function() {
		    return this.arrDetalles;
		}

		//Función para agregar una detalle al objeto 
		DetallesReporteReportesContabilidad.prototype.setDetalle = function (detalle){
			this.arrDetalles.push(detalle);
		}

		//Función para obtener un detalle del objeto
		DetallesReporteReportesContabilidad.prototype.getDetalle = function(index) {
		    return this.arrDetalles[index];
		}

		//Función para modificar un detalle del objeto
		DetallesReporteReportesContabilidad.prototype.modificarDetalle = function (index, detalle){
			this.arrDetalles[index] = detalle;
		}

		//Función para eliminar un detalle del objeto
		DetallesReporteReportesContabilidad.prototype.eliminarDetalle = function (index){
			if(index != -1) 
			{
				this.arrDetalles.splice(index, 1);
			}
		}

		//Función para cambiar las posiciones de los detalles en el objeto
		DetallesReporteReportesContabilidad.prototype.swap = function(index_A, index_B) {
		    var input = this.arrDetalles;
		 
		    var temp = input[index_A];
		    input[index_A] = input[index_B];
		    input[index_B] = temp;
		}

		/*******************************************************************************************************************
		Funciones del objeto Detalle del Reporte
		*********************************************************************************************************************/
		//Constructor del objeto detalle
		var objDetalleReporteReportesContabilidad;
		function DetalleReportesContabilidad(conceptoPadre, concepto, orden, tituloPrincipal, tituloSecundario, tituloTotal, cuentasContables)
		{
		    this.strConceptoPadre = conceptoPadre;
		    this.strConcepto = concepto;
		    this.intOrden = orden;
		    this.strTituloPrincipal = tituloPrincipal;
		    this.strTituloSecundario = tituloSecundario;
		     this.strTituloTotal = tituloTotal;
		    this.arrCuentasContables = cuentasContables;
		}

		//Función para agregar todos las cuentas contables del detalle
		DetalleReportesContabilidad.prototype.setCuentas = function(fras) {
	    	
	    	this.arrCuentas = fras;
		}

		//Función para eliminar todos las cuentas contables del detalle
		DetalleReportesContabilidad.prototype.eliminarCuentas = function() {
			
			this.arrCuentas = 0;
		}

		//Función para obtener una cuenta contable del objeto 
		DetalleReportesContabilidad.prototype.getCuenta = function(index) {
		    return this.arrCuentas[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto Cuenta contable  del detalle
		*********************************************************************************************************************/
		// Constructor del objeto Cuenta contable
		var objCuentaReportesContabilidad;
		function CuentaReportesContabilidad(cuentaID, cuenta)
		{
		    this.intCuentaID = cuentaID;
		    this.strCuenta = cuenta;
		}


		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_reportes_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/reportes/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_reportes_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosReportesContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosReportesContabilidad = strPermisosReportesContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosReportesContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosReportesContabilidad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_reportes_contabilidad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosReportesContabilidad[i]=='GUARDAR') || (arrPermisosReportesContabilidad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_reportes_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosReportesContabilidad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_reportes_contabilidad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_reportes_contabilidad();
						}
						else if(arrPermisosReportesContabilidad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_reportes_contabilidad').removeAttr('disabled');
							$('#btnRestaurar_reportes_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosReportesContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_reportes_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosReportesContabilidad[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_reportes_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosReportesContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_reportes_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_reportes_contabilidad() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaReportesContabilidad = ($('#txtBusqueda_reportes_contabilidad').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaReportesContabilidad != strUltimaBusquedaReportesContabilidad)
			{
				intPaginaReportesContabilidad = 0;
				strUltimaBusquedaReportesContabilidad = strNuevaBusquedaReportesContabilidad;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('contabilidad/reportes/get_paginacion',
					{	

						strBusqueda: $('#txtBusqueda_reportes_contabilidad').val(),
						intPagina:intPaginaReportesContabilidad,
						strPermisosAcceso: $('#txtAcciones_reportes_contabilidad').val()
					},
					function(data){
						$('#dg_reportes_contabilidad tbody').empty();
						var tmpReportesContabilidad = Mustache.render($('#plantilla_reportes_contabilidad').html(),data);
						$('#dg_reportes_contabilidad tbody').html(tmpReportesContabilidad);
						$('#pagLinks_reportes_contabilidad').html(data.paginacion);
						$('#numElementos_reportes_contabilidad').html(data.total_rows);
						intPaginaReportesContabilidad = data.pagina;
					},
			'json');
		}

	

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_reportes_contabilidad(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/reportes/';

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


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'strBusqueda': $('#txtBusqueda_reportes_contabilidad').val()		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_reportes_contabilidad (id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtReporteID_reportes_contabilidad').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'contabilidad/reportes/get_reporte_registro',
							'data' : {
										'intReporteID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);

		}
		

		/*******************************************************************************************************************
		Funciones del modal Reportes
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_reportes_contabilidad()
		{
			//Incializar formulario
			$('#frmReportesContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_reportes_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmReportesContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_reportes_contabilidad');
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_reportes_contabilidad();
			//Habilitar todos los elementos del formulario
			$('#frmReportesContabilidad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar los siguientes botones
			$("#btnGuardar_reportes_contabilidad").show();
			$("#btnAgregar_reportes_contabilidad").show(); 
			//Habilitar botón Agregar cuenta
            $('#btnAgregar_ctas_detalle_reportes_contabilidad').removeAttr('disabled');
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_reportes_contabilidad").hide();
			$("#btnDesactivar_reportes_contabilidad").hide();
			$("#btnRestaurar_reportes_contabilidad").hide();
		}
		
		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_reportes_contabilidad() 
		{
			//Eliminar los datos de la tabla Detalles del reporte
		    $('#dg_detalles_reportes_contabilidad tbody').empty();
			$('#numElementos_detalles_reportes_contabilidad').html(0);
			//Crear instancia del objeto Detalles del reporte
			objDetallesReporteReportesContabilidad = new DetallesReporteReportesContabilidad([]);
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_reportes_contabilidad()
		{
			try {
                
				//Hacer un llamado a la función para cerrar modal Detalle del Reporte
				cerrar_detalle_reportes_contabilidad();
				//Cerrar modal
				objReportesContabilidad.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_reportes_contabilidad').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_reportes_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_reportes_contabilidad();

			//Validación del formulario de campos obligatorios
			$('#frmReportesContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strTitulo_reportes_contabilidad: {
											validators: {
												notEmpty: {message: 'Escriba un título'}
											}
										},
										intNumDetalles_reportes_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para este reporte.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_reportes_contabilidad = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_reportes_contabilidad = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_reportes_contabilidad.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_reportes_contabilidad.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_reportes_contabilidad = $('#frmReportesContabilidad').data('bootstrapValidator');
			bootstrapValidator_reportes_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_reportes_contabilidad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_reportes_contabilidad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_reportes_contabilidad()
		{
			try
			{
				$('#frmReportesContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_reportes_contabilidad()
		{
			
			
			//Hacer un llamado a la función JSON para guardar los Detalles del reporte
			var jsonDetalles = JSON.stringify(objDetallesReporteReportesContabilidad); 

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('contabilidad/reportes/guardar',
					{ 
						//Datos del Reporte
						intReporteID: $('#txtReporteID_reportes_contabilidad').val(),
						strTitulo: $('#txtTitulo_reportes_contabilidad').val(),
						strTituloAnterior: $('#txtTituloAnterior_reportes_contabilidad').val(),
						//Datos de los detalles
						arrDetalles: jsonDetalles
					},
					function(data) {
						if (data.resultado)
						{
                 			//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_reportes_contabilidad();
							//Hacer un llamado a la función para cerrar modal
							cerrar_reportes_contabilidad();   
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_reportes_contabilidad(data.tipo_mensaje, data.mensaje);
						
					},
			'json');
		}

		///Función para mostrar mensaje de éxito o error
		function mensaje_reportes_contabilidad(tipoMensaje, mensaje)
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
		function cambiar_estatus_reportes_contabilidad(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtReporteID_reportes_contabilidad').val();

			}
			else
			{
				intID = id;
				strTipo = 'gridview';
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
				             {'type':     'question',
				              'title':    'Reportes',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_reportes_contabilidad(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_reportes_contabilidad(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_reportes_contabilidad(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('contabilidad/reportes/set_estatus',
			      {intReporteID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_reportes_contabilidad();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_reportes_contabilidad();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_reportes_contabilidad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_reportes_contabilidad(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/reportes/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_reportes_contabilidad();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;

				          	//Recuperar valores
				          	$('#txtReporteID_reportes_contabilidad').val(data.row.reporte_id);
				          	$('#txtTitulo_reportes_contabilidad').val(data.row.titulo);
				          	$('#txtTituloAnterior_reportes_contabilidad').val(data.row.titulo);
				          	
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_reportes_contabilidad').addClass("estatus-"+strEstatus);
				            $('#txtEstatus_reportes_contabilidad').val(strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_reportes_contabilidad").show();
				          
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';

				            //Si el estatus del registro es TIMBRAR
				            if(strEstatus == 'ACTIVO')
							{

								
								strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalle_reportes_contabilidad(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_detalle_reportes_contabilidad(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	//Mostrar botón Desactivar
				            	$("#btnDesactivar_reportes_contabilidad").show();
				            	
							}
							else 
							{

								//Deshabilitar todos los elementos del formulario
				            	$('#frmReportesContabilidad').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_reportes_contabilidad").hide(); 
					            $("#btnAgregar_reportes_contabilidad").hide(); 
					            //Deshabilitar botón Agregar cuenta
                  				 $('#btnAgregar_ctas_detalle_reportes_contabilidad').attr('disabled','-1');
					            //Mostrar botón Restaurar
								$("#btnRestaurar_reportes_contabilidad").show();

								strAccionesTabla = "<button class='btn btn-default btn-xs' title='Ver'" +
													 " onclick='editar_renglon_detalle_reportes_contabilidad(this)'>" + 
													 "<span class='glyphicon glyphicon-eye-open'></span></button>";
							}


				            //Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Crear instancia del objeto Detalle del Reporte
								objDetalleReporteReportesContabilidad = new DetalleReportesContabilidad('', '', '','', '', '', []);

								//Asignar valores
								objDetalleReporteReportesContabilidad.strConceptoPadre = data.detalles[intCon].concepto_padre;
							    objDetalleReporteReportesContabilidad.strConcepto = data.detalles[intCon].concepto;
							    objDetalleReporteReportesContabilidad.intOrden = data.detalles[intCon].orden;
							    objDetalleReporteReportesContabilidad.strTituloPrincipal = data.detalles[intCon].titulo_principal;
							    objDetalleReporteReportesContabilidad.strTituloSecundario = data.detalles[intCon].titulo_secundario;
							    objDetalleReporteReportesContabilidad.strTituloTotal = data.detalles[intCon].titulo_total;
							    //Array que se utiliza para agregar las cuentas contables del registro
								var arrCuentasReg = [];

								
					            //Mostramos las cuentas contables del registro
					            for (var intConDR in  data.detalles[intCon].arrCuentas) 
					            {
					            	

					            	//Crear instancia del objeto Cuenta contable
									objCuentaReportesContabilidad = new CuentaReportesContabilidad(null, '');

									//Asignar valores 
									objCuentaReportesContabilidad.intCuentaID = data.detalles[intCon].arrCuentas[intConDR].cuenta_id;
									objCuentaReportesContabilidad.strCuenta = data.detalles[intCon].arrCuentas[intConDR].cuenta;
									
									//Agregar objeto en el array
									arrCuentasReg.push(objCuentaReportesContabilidad);

					            }

					            //Agregar array con las cuentas contables del Reporte
            					objDetalleReporteReportesContabilidad.setCuentas(arrCuentasReg);
            					//Agregar datos del detalle del Reporte
           						objDetallesReporteReportesContabilidad.setDetalle(objDetalleReporteReportesContabilidad);

           						//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_reportes_contabilidad').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaConceptoPadre = objRenglon.insertCell(0);
								var objCeldaConcepto = objRenglon.insertCell(1);
								var objCeldaOrden = objRenglon.insertCell(2);
								var objCeldaAcciones = objRenglon.insertCell(3);

								
								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', intCon);
								objCeldaConceptoPadre.setAttribute('class', 'movil b1');
								objCeldaConceptoPadre.innerHTML = objDetalleReporteReportesContabilidad.strConceptoPadre;
							    objCeldaConcepto.setAttribute('class', 'movil b2');
								objCeldaConcepto.innerHTML = objDetalleReporteReportesContabilidad.strConcepto;
								objCeldaOrden.setAttribute('class', 'movil b3');
								objCeldaOrden.innerHTML = objDetalleReporteReportesContabilidad.intOrden;
								objCeldaAcciones.setAttribute('class', 'td-center movil b4');
								objCeldaAcciones.innerHTML = strAccionesTabla; 

				            }

				            //Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
							var intFilas = $("#dg_detalles_reportes_contabilidad tr").length - 1;
							$('#numElementos_detalles_reportes_contabilidad').html(intFilas);
							$('#txtNumDetalles_reportes_contabilidad').val(intFilas);

							//Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objReportesContabilidad = $('#ReportesContabilidadBox').bPopup({
													  appendTo: '#ReportesContabilidadContent', 
						                              contentContainer: 'ReportesContabilidadM', 
						                              zIndex: 2, 
						                              modalClose: false, 
						                              modal: true, 
						                              follow: [true,false], 
						                              followEasing : "linear", 
						                              easing: "linear", 
						                              modalColor: ('#F0F0F0')});
					        }

				             //Enfocar caja de texto
							$('#txtTitulo_reportes_contabilidad').focus();
			       	    }
			       },
			       'json');
		}

		


		/*******************************************************************************************************************
		Funciones del modal Detalle del Reporte
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_detalle_reportes_contabilidad()
		{
			//Incializar formulario
			$('#frmDetalleReportesContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_detalle_reportes_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmDetalleReportesContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_detalle_reportes_contabilidad');
			//Seleccionar tab que contiene la información general
		  	$('a[href="#informacion_general_detalle_reportes_contabilidad"]').click();
			//Eliminar los datos de la tabla facturas relacionadas
		    $('#dg_ctas_detalle_reportes_contabilidad tbody').empty();
			$('#numElementos_ctas_detalle_reportes_contabilidad').html(0);
			
			//Habilitar todos los elementos del formulario
			$('#frmDetalleReportesContabilidad').find('input, textarea, select').removeAttr('disabled','disabled');

			//Mostrar los siguientes botones
		    $('#btnGuardar_detalle_reportes_contabilidad').show();
		}

		//Función que se utiliza para abrir el modal
		function abrir_detalle_reportes_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_detalle_reportes_contabilidad();

		    //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_detalle_reportes_contabilidad').addClass("estatus-NUEVO");
			
			//Abrir modal
			objDetalleReportesContabilidad = $('#DetalleReportesContabilidadBox').bPopup({
								   appendTo: '#ReportesContabilidadContent', 
		                           contentContainer: 'ReportesContabilidadM', 
		                           zIndex: 2, 
		                           modalClose: false, 
		                           modal: true, 
		                           follow: [true,false], 
		                           followEasing : "linear", 
		                           easing: "linear", 
		                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#txtConceptoPadre_detalle_reportes_contabilidad').focus();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_detalle_reportes_contabilidad()
		{
			try {

				//Cerrar modal
				objDetalleReportesContabilidad.close();
				
			}
			catch(err) {}
		}

		
		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_detalle_reportes_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_detalle_reportes_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmDetalleReportesContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strConceptoPadre_detalle_reportes_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
					                    strConcepto_detalle_reportes_contabilidad: {
				                        	validators: {
												notEmpty: {message: 'Escriba un hora'}
											}
					                    },
					                    intOrden_detalle_reportes_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intNumCtas_detalle_reportes_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan facturas relacionadas
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos una cuenta para este detalle.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_detalle_reportes_contabilidad = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_detalle_reportes_contabilidad = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_detalle_reportes_contabilidad.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_detalle_reportes_contabilidad.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_detalle_reportes_contabilidad = $('#frmDetalleReportesContabilidad').data('bootstrapValidator');
			bootstrapValidator_detalle_reportes_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_detalle_reportes_contabilidad.isValid())
			{
				
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_detalle_reportes_contabilidad();
				
				
			}
			else 
				return;

		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_detalle_reportes_contabilidad()
		{
			try
			{
				$('#frmDetalleReportesContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar el detalle del reporte
		function guardar_detalle_reportes_contabilidad()
		{
			//Asignar el renglón del detalle seleccionado
			var intRenglon = $('#txtRenglon_detalle_reportes_contabilidad').val();

			//Crear instancia del objeto Detalle del Reporte
			objDetalleReporteReportesContabilidad = new DetalleReportesContabilidad('', '',  '', '', '', '', []);

			//Asignar valores al objeto
			objDetalleReporteReportesContabilidad.strConceptoPadre = $('#txtConceptoPadre_detalle_reportes_contabilidad').val();
		    objDetalleReporteReportesContabilidad.strConcepto = $('#txtConcepto_detalle_reportes_contabilidad').val();
		    objDetalleReporteReportesContabilidad.intOrden = $('#txtOrden_detalle_reportes_contabilidad').val();
		    objDetalleReporteReportesContabilidad.strTituloPrincipal = $('#txtTituloPrincipal_detalle_reportes_contabilidad').val();
		    objDetalleReporteReportesContabilidad.strTituloSecundario = $('#txtTituloSecundario_detalle_reportes_contabilidad').val();
		     objDetalleReporteReportesContabilidad.strTituloTotal = $('#txtTituloTotal_detalle_reportes_contabilidad').val();
		    

		    //Eliminar las cuentas contables del Reporte
			objDetalleReporteReportesContabilidad.eliminarCuentas(intRenglon);

			//Obtenemos el objeto de la tabla
			var objTablaCtas = document.getElementById('dg_ctas_detalle_reportes_contabilidad').getElementsByTagName('tbody')[0];

			//Array que se utiliza para agregar las cuentas contables del registro
			var arrCuentasReg = [];


			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRenCta = 0, objRenCta; objRenCta = objTablaCtas.rows[intRenCta]; intRenCta++) 
			{
				//Crear instancia del objeto Cuenta contable
				objCuentaReportesContabilidad = new CuentaReportesContabilidad(null, '');

				//Asignar valores 
				objCuentaReportesContabilidad.intCuentaID = objRenCta.getAttribute('id');
				objCuentaReportesContabilidad.strCuenta = objRenCta.cells[0].innerHTML;

				
				//Agregar objeto en el array
				arrCuentasReg.push(objCuentaReportesContabilidad);
			}

			//Agregar array con las cuentas contables del Reporte
            objDetalleReporteReportesContabilidad.setCuentas(arrCuentasReg);

		   
			//Revisamos si existe el renglón, si es así, editamos los datos del detalle
			if (intRenglon)
			{
			    //Modificar los datos del detalle corespondiente al indice
        		objDetallesReporteReportesContabilidad.modificarDetalle(intRenglon, objDetalleReporteReportesContabilidad);

        		//Incrementar renglón para obtener la posición del detalle en la tabla
				intRenglon++;
				//Seleccionar el renglón de la tabla para actualizar los datos del detalle
				var selectedRow = document.getElementById("dg_detalles_reportes_contabilidad").rows[intRenglon].cells;
				selectedRow[0].innerHTML = objDetalleReporteReportesContabilidad.strConceptoPadre;
				selectedRow[1].innerHTML = objDetalleReporteReportesContabilidad.strConcepto;
				selectedRow[2].innerHTML = objDetalleReporteReportesContabilidad.intOrden;
			}
			else
			{
				//Agregar datos del detalle del Reporte
           		objDetallesReporteReportesContabilidad.setDetalle(objDetalleReporteReportesContabilidad);

				//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_detalles_reportes_contabilidad').getElementsByTagName('tbody')[0];
           		//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaConceptoPadre = objRenglon.insertCell(0);
				var objCeldaConcepto = objRenglon.insertCell(1);
				var objCeldaOrden = objRenglon.insertCell(2);
				var objCeldaAcciones = objRenglon.insertCell(3);

				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', intRenglon);
				objCeldaConceptoPadre.setAttribute('class', 'movil d1');
				objCeldaConceptoPadre.innerHTML = objDetalleReporteReportesContabilidad.strConceptoPadre;
			    objCeldaConcepto.setAttribute('class', 'movil d2');
				objCeldaConcepto.innerHTML = objDetalleReporteReportesContabilidad.strConcepto;
				objCeldaOrden.setAttribute('class', 'movil d3');
				objCeldaOrden.innerHTML = objDetalleReporteReportesContabilidad.intOrden;
				objCeldaAcciones.setAttribute('class', 'td-center movil d4');
				objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_detalle_reportes_contabilidad(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
											 " onclick='eliminar_renglon_detalle_reportes_contabilidad(this)'>" + 
											 "<span class='glyphicon glyphicon-trash'></span></button>" + 
											 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
											 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_detalles_reportes_contabilidad tr").length - 1;
			$('#numElementos_detalles_reportes_contabilidad').html(intFilas);
			$('#txtNumDetalles_reportes_contabilidad').val(intFilas);

            //Hacer un llamado a la función para cerrar modal
			cerrar_detalle_reportes_contabilidad();
		}

		//Función para editar un renglón de la tabla
		function editar_renglon_detalle_reportes_contabilidad(objRenglon)
		{
			
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_detalle_reportes_contabilidad();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_reportes_contabilidad').val();

			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}


			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_detalle_reportes_contabilidad').addClass("estatus-"+strEstatus);

		    //Decrementar indice para obtener la posición del detalle en el arreglo
		    var intRenglon = objRenglon.parentNode.parentNode.rowIndex - 1;
			//Crear instancia del objeto Detalle del Reporte
        	objDetalleReporteReportesContabilidad = new DetalleReportesContabilidad();
        	//Asignar datos del detalle corespondiente al indice
        	objDetalleReporteReportesContabilidad = objDetallesReporteReportesContabilidad.getDetalle(intRenglon);

        	//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalle_reportes_contabilidad').val(intRenglon);
			$('#txtConceptoPadre_detalle_reportes_contabilidad').val(objDetalleReporteReportesContabilidad.strConceptoPadre);
		    $('#txtConcepto_detalle_reportes_contabilidad').val(objDetalleReporteReportesContabilidad.strConcepto);
		    $('#txtOrden_detalle_reportes_contabilidad').val(objDetalleReporteReportesContabilidad.intOrden);
		    $('#txtTituloPrincipal_detalle_reportes_contabilidad').val(objDetalleReporteReportesContabilidad.strTituloPrincipal);
		    $('#txtTituloSecundario_detalle_reportes_contabilidad').val(objDetalleReporteReportesContabilidad.strTituloSecundario);
		     $('#txtTituloTotal_detalle_reportes_contabilidad').val(objDetalleReporteReportesContabilidad.strTituloTotal);



		    //Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Hacer recorrido para obtener las cuentas contables del Reporte
		    for(var intCon=0; intCon < objDetalleReporteReportesContabilidad.arrCuentas.length; intCon++)
		    {
		    	//Crear instancia del objeto Cuenta contable
            	objCuentaReportesContabilidad = new CuentaReportesContabilidad();
            	//Asignar datos de la Cuenta contable corespondiente al indice
            	objCuentaReportesContabilidad = objDetalleReporteReportesContabilidad.getCuenta(intCon);

            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_ctas_detalle_reportes_contabilidad').getElementsByTagName('tbody')[0];

				//Variable que se utiliza para asignar el id del detalle
				var strDetalleID =  objCuentaReportesContabilidad.intCuentaID;

				//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaCuenta = objRenglon.insertCell(0);
				var objCeldaAcciones = objRenglon.insertCell(1);

				

				//Si se cumple la sentencia
				if(strEstatus == 'NUEVO' || strEstatus == 'ACTIVO')
				{
					
					 strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_ctas_detalle_reportes_contabilidad(this)'>" + 
									   "<span class='glyphicon glyphicon-trash'></span></button>" + 
									   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
									   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
									   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
									   "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					
				   
				}

				
				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', objCuentaReportesContabilidad.intCuentaID);
				objCeldaCuenta.setAttribute('class', 'movil c1');
				objCeldaCuenta.innerHTML = objCuentaReportesContabilidad.strCuenta;
				objCeldaAcciones.setAttribute('class', 'td-center movil c2');
				objCeldaAcciones.innerHTML = strAccionesTabla;

		    }

	     	//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla)
			var intFilas = $("#dg_ctas_detalle_reportes_contabilidad tr").length - 1;
			$('#numElementos_ctas_detalle_reportes_contabilidad').html(intFilas);
			$('#txtNumCtas_detalle_reportes_contabilidad').val(intFilas);
		
			//Abrir modal
			objDetalleReportesContabilidad = $('#DetalleReportesContabilidadBox').bPopup({
								   appendTo: '#ReportesContabilidadContent', 
		                           contentContainer: 'ReportesContabilidadM', 
		                           zIndex: 2, 
		                           modalClose: false, 
		                           modal: true, 
		                           follow: [true,false], 
		                           followEasing : "linear", 
		                           easing: "linear", 
		                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#txtConceptoPadre_detalle_reportes_contabilidad').focus();
			
		}

		//Función para eliminar un renglón de la tabla
		function eliminar_renglon_detalle_reportes_contabilidad(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			//Eliminar del objeto el detalle seleccionado
			objDetallesReporteReportesContabilidad.eliminarDetalle(intRenglon - 1);
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_reportes_contabilidad").deleteRow(intRenglon);
			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_detalles_reportes_contabilidad tr").length - 1;
			$('#numElementos_detalles_reportes_contabilidad').html(intFilas);
			$('#txtNumDetalles_reportes_contabilidad').val(intFilas);
		}

		
		/*******************************************************************************************************************
		Funciones del modal Cuentas contables del Detalle
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_ctas_detalle_reportes_contabilidad()
		{

			//Obtenemos los datos de las cajas de texto
			var intCuentaID = $('#txtCuentaID_ctas_detalle_reportes_contabilidad').val();
			var strCuenta = $('#txtCuenta_ctas_detalle_reportes_contabilidad').val();
			

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_ctas_detalle_reportes_contabilidad').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intCuentaID == '')
			{
				//Enfocar caja de texto
				$('#txtCuenta_ctas_detalle_reportes_contabilidad').focus();
			}
			else
			{

					//Limpiamos las cajas de texto
					$('#txtCuentaID_ctas_detalle_reportes_contabilidad').val('');
					$('#txtCuenta_ctas_detalle_reportes_contabilidad').val('');

					//Revisamos si no existe el ID proporcionado, si es así, agregamos los datos
					if (!objTabla.rows.namedItem(intCuentaID))
					{
						//Insertamos el renglón con sus celdas en el objeto de la tabla
						var objRenglon = objTabla.insertRow();
						var objCeldaCuenta = objRenglon.insertCell(0);
						var objCeldaAcciones = objRenglon.insertCell(1);

						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', intCuentaID);
						objCeldaCuenta.setAttribute('class', 'movil c1');
						objCeldaCuenta.innerHTML = strCuenta;
						objCeldaAcciones.setAttribute('class', 'td-center movil c2');
						objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Eliminar'" +
													   " onclick='eliminar_renglon_ctas_detalle_reportes_contabilidad(this)'>" + 
													   "<span class='glyphicon glyphicon-trash'></span></button>" + 
													   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													   "<span class='glyphicon glyphicon-arrow-down'></span></button>";

					}
			}


			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_ctas_detalle_reportes_contabilidad tr").length - 1;
			$('#numElementos_ctas_detalle_reportes_contabilidad').html(intFilas);
			$('#txtNumCtas_detalle_reportes_contabilidad').val(intFilas);
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_ctas_detalle_reportes_contabilidad(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_ctas_detalle_reportes_contabilidad").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_ctas_detalle_reportes_contabilidad tr").length - 1;
			$('#numElementos_ctas_detalle_reportes_contabilidad').html(intFilas);
			$('#txtNumCtas_detalle_reportes_contabilidad').val(intFilas);
		}



		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			
			/*******************************************************************************************************************
			Controles correspondientes al modal Reportes
			*********************************************************************************************************************/
			//Comprobar la existencia del título en la BD cuando pierda el enfoque la caja de texto
			$('#txtTitulo_reportes_contabilidad').focusout(function(e){
				//Si no existe id, verificar la existencia del título
				if ($('#txtReporteID_reportes_contabilidad').val() == '' && $('#txtTitulo_reportes_contabilidad').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el titulo
					editar_reportes_contabilidad($('#txtTitulo_reportes_contabilidad').val(), 'titulo', 'Nuevo');
				}
			});


	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_reportes_contabilidad').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Verifica que no sea el último elemento del grid
	            	if( row.next().index() != -1 )
	            	{ 
	            		objDetallesReporteReportesContabilidad.swap(row.index(), row.next().index() );
	            	}	

	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Verifica que no sea el primer elemento del grid
	            	if( row.prev().index() != -1 )
	            	{ 
	            		objDetallesReporteReportesContabilidad.swap(row.prev().index(), row.index() );
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
		    

	        /*******************************************************************************************************************
        	Controles correspondientes al modal Cuentas Contables del Reporte
        	*********************************************************************************************************************/
        	//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtOrden_detalle_reportes_contabilidad').numeric({decimal: false, negative: false});
        	
	      	
	      	//Autocomplete para recuperar los datos del agrupador (concepto padre)
	        $('#txtConceptoPadre_detalle_reportes_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtConceptoPadreID_detalle_reportes_contabilidad').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/reportes/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intReporteID:  $('#txtReporteID_reportes_contabilidad').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtConceptoPadreID_detalle_reportes_contabilidad').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        



	      	//Autocomplete para recuperar los datos de una cuenta
	        $('#txtCuenta_ctas_detalle_reportes_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCuentaID_ctas_detalle_reportes_contabilidad').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/catalogo_cuentas/autocomplete",
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
	             $('#txtCuentaID_ctas_detalle_reportes_contabilidad').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la cuenta cuando pierda el enfoque la caja de texto
	        $('#txtCuenta_ctas_detalle_reportes_contabilidad').focusout(function(e){
	        	//Si no existe id de la cuenta
	            if($('#txtCuentaID_ctas_detalle_reportes_contabilidad').val() == '' ||
	               $('#txtCuenta_ctas_detalle_reportes_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtCuentaID_ctas_detalle_reportes_contabilidad').val('');
	               $('#txtCuenta_ctas_detalle_reportes_contabilidad').val('');
	            }
	            
	        });


	       	//Función para mover renglones arriba y abajo en la tabla
			$('#dg_ctas_detalle_reportes_contabilidad').on('click','button.btn',function(){
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
			//Paginación de registros
			$('#pagLinks_reportes_contabilidad').on('click','a',function(event){
				event.preventDefault();
				intPaginaReportesContabilidad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_reportes_contabilidad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_reportes_contabilidad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_reportes_contabilidad();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_reportes_contabilidad').addClass("estatus-NUEVO");
				//Abrir modal
				objReportesContabilidad = $('#ReportesContabilidadBox').bPopup({
									   appendTo: '#ReportesContabilidadContent', 
		                               contentContainer: 'ReportesContabilidadM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtTitulo_reportes_contabilidad').focus();
				
			});

			//Enfocar caja de texto
			$('#txtBusqueda_reportes_contabilidad').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_reportes_contabilidad();
		});
	</script>