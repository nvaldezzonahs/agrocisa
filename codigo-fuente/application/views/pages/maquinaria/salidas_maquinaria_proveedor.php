<div id="SalidasMaquinariaProveedorMaquinariaContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_salidas_maquinaria_proveedor_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_salidas_maquinaria_proveedor_maquinaria">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_salidas_maquinaria_proveedor_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_salidas_maquinaria_proveedor_maquinaria"
			                    		name= "strFechaInicialBusq_salidas_maquinaria_proveedor_maquinaria" 
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
							<label for="txtFechaFinalBusq_salidas_maquinaria_proveedor_maquinaria">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_salidas_maquinaria_proveedor_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_salidas_maquinaria_proveedor_maquinaria"
			                    		name= "strFechaFinalBusq_salidas_maquinaria_proveedor_maquinaria" 
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
							<label for="txtProveedorBusq_salidas_maquinaria_proveedor_maquinaria">Proveedor</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtProveedorIDBusq_salidas_maquinaria_proveedor_maquinaria" 
									name="intProveedorIDBusq_salidas_maquinaria_proveedor_maquinaria" 
									type="hidden" />
							<input  class="form-control" 
									id="txtProveedorBusq_salidas_maquinaria_proveedor_maquinaria" 
									name="strProveedorBusq_salidas_maquinaria_proveedor_maquinaria" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese proveedor" />
						</div>
					</div>
				</div>
				<!--Estatus-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="cmbEstatusBusq_salidas_maquinaria_proveedor_maquinaria">Estatus</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="cmbEstatusBusq_salidas_maquinaria_proveedor_maquinaria" 
							 		name="strEstatusBusq_salidas_maquinaria_proveedor_maquinaria" tabindex="1">
							    <option value="TODOS">TODOS</option>
								<option value="ACTIVO">ACTIVO</option>
								<option value="INACTIVO">INACTIVO</option>
								<option value="GENERAR POLIZA">GENERAR PÓLIZA</option>
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
							<label for="txtBusqueda_salidas_maquinaria_proveedor_maquinaria">Descripción</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtBusqueda_salidas_maquinaria_proveedor_maquinaria" 
									name="strBusqueda_salidas_maquinaria_proveedor_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
							</input>
						</div>
					</div>
				</div>

				<!--Mostrar detalles de los registros en el reporte PDF--> 
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
					<div class="checkbox">
                    	<label id="label-checkbox">
                        	<input class="form-control" 
                        			id="chbImprimirDetalles_salidas_maquinaria_proveedor_maquinaria" 
								   	name="strImprimirDetalles_salidas_maquinaria_proveedor_maquinaria" 
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
						<button class="btn btn-primary" id="btnBuscar_salidas_maquinaria_proveedor_maquinaria"
								onclick="paginacion_salidas_maquinaria_proveedor_maquinaria();" 
								title="Buscar coincidencias" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<!--Dar de alta un nuevo registro-->
						<button class="btn btn-info" id="btnNuevo_salidas_maquinaria_proveedor_maquinaria" 
								title="Nuevo registro" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>   
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_salidas_maquinaria_proveedor_maquinaria"
								onclick="reporte_salidas_maquinaria_proveedor_maquinaria('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_salidas_maquinaria_proveedor_maquinaria"
								onclick="reporte_salidas_maquinaria_proveedor_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
			td.movil:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
			td.movil:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
			td.movil:nth-of-type(3):before {content: "Cliente"; font-weight: bold;}
			td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
			td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_salidas_maquinaria_proveedor_maquinaria">
				<thead class="movil">
					<tr class="movil">
						<th class="movil">Folio</th>
						<th class="movil">Fecha</th>
						<th class="movil">Proveedor</th>
						<th class="movil">Estatus</th>
						<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
					</tr>
				</thead>
				<tbody class="movil"></tbody>
				<script id="plantilla_salidas_maquinaria_proveedor_maquinaria" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil">{{folio}}</td>
						<td class="movil">{{fecha}}</td>
						<td class="movil">{{proveedor}}</td>
						<td class="movil">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_salidas_maquinaria_proveedor_maquinaria({{movimiento_maquinaria_id}},'Editar')"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_salidas_maquinaria_proveedor_maquinaria({{movimiento_maquinaria_id}},'Ver')"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_salidas_maquinaria_proveedor_maquinaria({{movimiento_maquinaria_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Generar póliza-->
                            <button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
                                    onclick="generar_poliza_salidas_maquinaria_proveedor_maquinaria({{movimiento_maquinaria_id}}, 'principal')"  title="Generar póliza">
                                <span class="glyphicon glyphicon-tags"></span>
                            </button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_salidas_maquinaria_proveedor_maquinaria({{movimiento_maquinaria_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_salidas_maquinaria_proveedor_maquinaria"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_salidas_maquinaria_proveedor_maquinaria">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->
	 <!--Circulo de progreso-->
    <div id="divCirculoBarProgresoPrincipal_salidas_maquinaria_proveedor_maquinaria" class="load-container load5 circulo_bar no-mostrar">
        <div class="loader">Loading...</div>
        <br><br>
        <div align=center><b>Espere un momento por favor.</b></div>
    </div>  

	<!-- Diseño del modal-->
	<div id="SalidasMaquinariaProveedorMaquinariaBox" class="ModalBody"  tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_salidas_maquinaria_proveedor_maquinaria"  class="ModalBodyTitle">
		<h1>Salida de Maquinaria por Devolución a Proveedor</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmSalidasMaquinariaProveedorMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmSalidasMaquinariaProveedorMaquinaria"  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!-- Folio -->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtMovimientoMaquinariaID_salidas_maquinaria_proveedor_maquinaria" 
									   name="intMovimientoCajaHerramientas_salidas_maquinaria_proveedor_maquinaria" 
									   type="hidden" 
									   value="" />
								<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
                                <input id="txtPolizaID_salidas_maquinaria_proveedor_maquinaria" 
                                       name="intPolizaID_salidas_maquinaria_proveedor_maquinaria" type="hidden" value="" />
                                <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
                                <input id="txtFolioPoliza_salidas_maquinaria_proveedor_maquinaria" 
                                       name="strFolioPoliza_salidas_maquinaria_proveedor_maquinaria" type="hidden" value="" />

								<!-- Caja de texto oculta que se utiliza para recuperar el id del folio de entrada por compra seleccionado-->   
								<label for="txtFolio_salidas_maquinaria_proveedor_maquinaria">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
								        id="txtFolio_salidas_maquinaria_proveedor_maquinaria" 
										name="strFolio_salidas_maquinaria_proveedor_maquinaria" 
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
								<label for="txtFecha_salidas_maquinaria_proveedor_maquinaria">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_salidas_maquinaria_proveedor_maquinaria'>
				                    <input class="form-control" 
				                    		id="txtFecha_salidas_maquinaria_proveedor_maquinaria"
				                    		name= "strFecha_salidas_maquinaria_proveedor_maquinaria" 
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
					<!-- Folio -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del folio de entrada por compra seleccionado-->
								<input id="txtFolioEntradaID_salidas_maquinaria_proveedor_maquinaria" 
									   name="intFolioID_salidas_maquinaria_proveedor_maquinaria" 
									   type="hidden" 
									   value="" />	   
								<label for="txtFolioEntrada_salidas_maquinaria_proveedor_maquinaria">Entrada </label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
								        id="txtFolioEntrada_salidas_maquinaria_proveedor_maquinaria" 
										name="strFolioEntrada_salidas_maquinaria_proveedor_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese entrada" />
							</div>
						</div>
					</div>
					<!-- Proveedor -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el ID del Proveedor de la orden de compra -->
								<input id="txtProveedorID_salidas_maquinaria_proveedor_maquinaria" 
									   name="intProveedorID_salidas_maquinaria_proveedor_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtProveedor_salidas_maquinaria_proveedor_maquinaria">Proveedor</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtProveedor_salidas_maquinaria_proveedor_maquinaria" 
										name="strProveedor_salidas_maquinaria_proveedor_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" disabled/>			
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Observaciones -->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtObservaciones_salidas_maquinaria_proveedor_maquinaria">Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_salidas_maquinaria_proveedor_maquinaria" 
										name="strObservaciones_salidas_maquinaria_proveedor_maquinaria" 
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
								<input 	id="txtNumDetalles_salidas_maquinaria_proveedor_maquinaria" 
							   			name="intNumDetalles_salidas_maquinaria_proveedor_maquinaria" 
							   			type="hidden" 
							   			value="">
								</input>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Detalles de la salida</h4>
									</div>
									<div class="panel-body">
										<div class="row">
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_salidas_maquinaria_proveedor_maquinaria">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Serie</th>
																<th class="movil">Motor</th>
																<th class="movil">Código</th>
																<th class="movil">Descripción</th>
																<th class="movil" id="th-devolver" style="width:8em;">Devolver</th>
																<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
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
																<strong id="numElementos_detalles_salidas_maquinaria_proveedor_maquinaria">0</strong> encontrados
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
                <div id="divCirculoBarProgreso_salidas_maquinaria_proveedor_maquinaria" class="load-container load5 circulo_bar no-mostrar">
                    <div class="loader">Loading...</div>
                    <br><br>
                    <div align=center><b>Espere un momento por favor.</b></div>
                </div>
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Nuevo registro-->
						<button class="btn btn-info" 
								id="btnReiniciar_salidas_maquinaria_proveedor_maquinaria"  
								onclick="nuevo_salidas_maquinaria_proveedor_maquinaria('Nuevo');"  
								title="Nuevo registro" 
								tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" 
								id="btnGuardar_salidas_maquinaria_proveedor_maquinaria"  
								onclick="validar_salidas_maquinaria_proveedor_maquinaria();"  
								title="Guardar" 
								tabindex="3" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_salidas_maquinaria_proveedor_maquinaria"  
								onclick="reporte_registro_salidas_maquinaria_proveedor_maquinaria('');"  
								title="Imprimir" 
								tabindex="4" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" id="btnDesactivar_salidas_maquinaria_proveedor_maquinaria"  
								onclick="cambiar_estatus_salidas_maquinaria_proveedor_maquinaria('', '', '');"  title="Desactivar" tabindex="5" disabled>
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  
								id="btnCerrar_salidas_maquinaria_proveedor_maquinaria"
								type="reset" 
								aria-hidden="true" 
								onclick="cerrar_salidas_maquinaria_proveedor_maquinaria();" 
								title="Cerrar"  
								tabindex="6">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div><!--Cierre del modal-->

	<!--Diseño del modal secundario-->
	<div id="AditamentosSalidasMaquinariaProveedorMaquinariaBox" class="ModalBody" tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModalSecundario_salidas_maquinaria_proveedor_maquinaria" class="ModalBodyTitle">
			<h1>Ver aditamentos</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmAditamentosSalidasMaquinariaProveedorMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmAditamentosSalidasMaquinariaProveedorMaquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
				  	<!--Código-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el renglón seleccionado -->	
								<label for="txtCodigoAditamentos_salidas_maquinaria_proveedor_maquinaria">Código</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtCodigoAditamentos_salidas_maquinaria_proveedor_maquinaria" 
										name="strCodigoAditamentos_salidas_maquinaria_proveedor_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtDescripcionAditamentos_salidas_maquinaria_proveedor_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtDescripcionAditamentos_salidas_maquinaria_proveedor_maquinaria" 
										name="strDescripcionAditamentos_salidas_maquinaria_proveedor_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Serie-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtSerieAditamentos_salidas_maquinaria_proveedor_maquinaria">Serie</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSerieAditamentos_salidas_maquinaria_proveedor_maquinaria" 
										name="strSerieAditamentos_salidas_maquinaria_proveedor_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Motor-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtMotorAditamentos_salidas_maquinaria_proveedor_maquinaria">Motor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtMotorAditamentos_salidas_maquinaria_proveedor_maquinaria" 
										name="strMotorAditamentos_salidas_maquinaria_proveedor_maquinaria" 
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
									<table class="table-hover" id="dg_aditamentos_detalles_salidas_maquinaria_proveedor_maquinaria">
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
												<strong id="numElementos_detalles_aditamentos_salidas_maquinaria_proveedor_maquinaria">0</strong> encontrados
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
						<button class="btn  btn-cerrar"  id="btnCerrar_respuestas_salidas_maquinaria_proveedor_maquinaria"
								type="reset" aria-hidden="true" onclick="cerrar_aditamentos_salidas_maquinaria_proveedor_maquinaria();" title="Cerrar">
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

</div><!--#SalidasMaquinariaProveedorMaquinariaContent -->


<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variable que se utiliza para asignar el id del movimiento de SALIDA MAQUINARIA POR DEVOLUCION A PROVEEDOR
	var intMovimientoIDSalidaMaquinariaDevolucionProveedorMaquinaria = <?php echo SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR ?>;
	 /*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
     var strTipoReferenciaSalidaMaquinariaDevolucionProveedorMaquinaria = "MOVIMIENTO DE MAQUINARIA";
	//Variables que se utilizan para la paginación de registros
	var intPaginaSalidasMaquinariaProveedorMaquinaria = 0;
	var strUltimaBusquedaSalidasMaquinariaProveedorMaquinaria = "";
	//Variables que se utilizan para la búsqueda de registros
	var intMecanicoIDSalidasMaquinariaProveedorMaquinaria = "";
	var dteFechaInicialSalidasMaquinariaProveedorMaquinaria = "";
	var dteFechaFinalSalidasMaquinariaProveedorMaquinaria = "";
	//Variable que se utiliza para asignar objeto del modal
	var objSalidasMaquinariaProveedorMaquinaria = null;
	//Variable que se utiliza para asignar objeto del modal secundario
	var objAditamentosSalidasMaquinariaProveedorMaquinaria = null;

	/*******************************************************************************************************************
	Funciones del objeto Salida por traspaso
	*********************************************************************************************************************/
	// Constructor de Salida
	var objSalida;
	function Salida(id, referenciaID, tipoMovimiento, folio, fecha, observaciones, maquinarias)
	{
	    this.intMovimientoMaquinariaID = id;
	    this.intReferenciaID = referenciaID;
	    this.strTipoMovimiento = tipoMovimiento;
	    this.strFolio = folio;
	    this.strFecha = fecha;
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
	function Maquinaria(id, renglon, maquinariaDescripcionID, codigo, descripcionCorta, descripcion, serie, motor)
	{
	    this.intMovimientoMaquinariaID = id;
	    this.intRenglon = renglon;
	    this.strMaquinariaDescripcionID = maquinariaDescripcionID;
	    this.strCodigo = codigo;
	    this.strDescripcionCorta = descripcionCorta;
	    this.strDescripcion = descripcion;
	    this.strSerie = serie;
	    this.strMotor = motor;
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

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_salidas_maquinaria_proveedor_maquinaria()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('maquinaria/salidas_maquinaria_proveedor/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_salidas_maquinaria_proveedor_maquinaria').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosSalidasMaquinariaProveedorMaquinaria = data.row;
				//Separar la cadena 
				var arrPermisosSalidasMaquinariaProveedorMaquinaria = strPermisosSalidasMaquinariaProveedorMaquinaria.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosSalidasMaquinariaProveedorMaquinaria.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosSalidasMaquinariaProveedorMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_salidas_maquinaria_proveedor_maquinaria').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosSalidasMaquinariaProveedorMaquinaria[i]=='GUARDAR') || (arrPermisosSalidasMaquinariaProveedorMaquinaria[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_salidas_maquinaria_proveedor_maquinaria').removeAttr('disabled');
					}
					//Si el indice es VER REGISTRO
					else if(arrPermisosSalidasMaquinariaProveedorMaquinaria[i]=='VER REGISTRO')
					{
						
					}
					else if(arrPermisosSalidasMaquinariaProveedorMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_salidas_maquinaria_proveedor_maquinaria').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_salidas_maquinaria_proveedor_maquinaria();
					}
					else if(arrPermisosSalidasMaquinariaProveedorMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_salidas_maquinaria_proveedor_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosSalidasMaquinariaProveedorMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_salidas_maquinaria_proveedor_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosSalidasMaquinariaProveedorMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_salidas_maquinaria_proveedor_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosSalidasMaquinariaProveedorMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_salidas_maquinaria_proveedor_maquinaria').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}



	//Función para la búsqueda de registros
	function paginacion_salidas_maquinaria_proveedor_maquinaria() 
	{
	   //Concatenar datos para la nueva búsqueda
			var strNuevaBusquedaSalidasMaquinariaProveedorMaquinaria =($('#txtFechaInicialBusq_salidas_maquinaria_proveedor_maquinaria').val()+$('#txtFechaFinalBusq_salidas_maquinaria_proveedor_maquinaria').val()+$('#txtProveedorIDBusq_salidas_maquinaria_proveedor_maquinaria').val()+$('#cmbEstatusBusq_salidas_maquinaria_proveedor_maquinaria').val()+$('#txtBusqueda_salidas_maquinaria_proveedor_maquinaria').val());
		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaSalidasMaquinariaProveedorMaquinaria != strUltimaBusquedaSalidasMaquinariaProveedorMaquinaria)
		{
			intPaginaSalidasMaquinariaProveedorMaquinaria = 0;
			strUltimaBusquedaSalidasMaquinariaProveedorMaquinaria = strNuevaBusquedaSalidasMaquinariaProveedorMaquinaria;
		}

		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('maquinaria/salidas_maquinaria_proveedor/get_paginacion',
				{ //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				  dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_salidas_maquinaria_proveedor_maquinaria').val()),
				  dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_salidas_maquinaria_proveedor_maquinaria').val()),
				  intProveedorID: $('#txtProveedorIDBusq_salidas_maquinaria_proveedor_maquinaria').val(),
				  strEstatus:     $('#cmbEstatusBusq_salidas_maquinaria_proveedor_maquinaria').val(),
				  strBusqueda:    $('#txtBusqueda_salidas_maquinaria_proveedor_maquinaria').val(),
				  intPagina: intPaginaSalidasMaquinariaProveedorMaquinaria,
				  strPermisosAcceso: $('#txtAcciones_salidas_maquinaria_proveedor_maquinaria').val()
				},
				function(data){
					$('#dg_salidas_maquinaria_proveedor_maquinaria tbody').empty();
					var tmpSalidasMaquinariaProveedorMaquinaria = Mustache.render($('#plantilla_salidas_maquinaria_proveedor_maquinaria').html(),data);
					$('#dg_salidas_maquinaria_proveedor_maquinaria tbody').html(tmpSalidasMaquinariaProveedorMaquinaria);
					$('#pagLinks_salidas_maquinaria_proveedor_maquinaria').html(data.paginacion);
					$('#numElementos_salidas_maquinaria_proveedor_maquinaria').html(data.total_rows);
					intPaginaSalidasMaquinariaProveedorMaquinaria = data.pagina;
				},
		'json');
	}

	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_salidas_maquinaria_proveedor_maquinaria(tipoAccion)
	{		
		//Incializar formulario
		$('#frmSalidasMaquinariaProveedorMaquinaria')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_salidas_maquinaria_proveedor_maquinaria();
		//Limpiar cajas de texto ocultas
		$('#frmSalidasMaquinariaProveedorMaquinaria').find('input[type=hidden]').val('');
		//Habilitar todos los elementos del formulario
	    $('#frmSalidasMaquinariaProveedorMaquinaria').find('input, textarea, select').attr('disabled', false);
		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		inicializar_detalles_salidas_maquinaria_proveedor_maquinaria();	

		//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
        $.removerClasesEncabezado('divEncabezadoModal_salidas_maquinaria_proveedor_maquinaria');
			
		/******************************************************************
		* INICIALIZACIÓN DE ELEMENTOS - ESTADO DEFAULT
		*******************************************************************/	
		//ID Movimiento
		$('#txtMovimientoCajaHerramientasID_salidas_maquinaria_proveedor_maquinaria').val('');
		//Folio
		$('#txtFolio_salidas_maquinaria_proveedor_maquinaria').val('');
		//Fecha
		$('#txtFecha_salidas_maquinaria_proveedor_maquinaria').val(fechaActual()); 
	    //Tipo de movimiento
		//$('#cmbMonedaID_salidas_maquinaria_proveedor_maquinaria').attr('disabled', false);
		//Mecánico
		$('#txtMecanicoID_salidas_maquinaria_proveedor_maquinaria').val('');
		$('#txtMecanico_salidas_maquinaria_proveedor_maquinaria').val('');
		//Observaciones
		$('#txtObservaciones_salidas_maquinaria_proveedor_maquinaria').val('');
		
		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo')
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_salidas_maquinaria_proveedor_maquinaria').addClass("estatus-NUEVO");
		}
	    
	    nuevo_objeto_salida();

	    //Deshabilitar las siguientes cajas de texto
	    $('#txtFolio_salidas_maquinaria_proveedor_maquinaria').attr("disabled", "disabled");
		$('#txtProveedor_salidas_maquinaria_proveedor_maquinaria').attr("disabled", "disabled");

		//Mostrar botón Guardar
		$("#btnGuardar_salidas_maquinaria_proveedor_maquinaria").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_salidas_maquinaria_proveedor_maquinaria").hide();
		$("#btnDescargarArchivo_salidas_maquinaria_proveedor_maquinaria").hide();
		$("#btnDesactivar_salidas_maquinaria_proveedor_maquinaria").hide();
		
	}

	//Función para crear un nuevo objeto de tipo Encuesta
	function nuevo_objeto_salida(){
		// Crear un Objeto de tipo Salida por traspaso
		objSalida = new Salida(null, null, null, '', '', '', null, null, []);
	}
	
	//Función para inicializar elementos de la tabla detalles
	function inicializar_detalles_salidas_maquinaria_proveedor_maquinaria()
	{
		//Eliminar los datos de la tabla detalles del movimiento
		$('#dg_detalles_salidas_maquinaria_proveedor_maquinaria tbody').empty();
		$('#acumCantidad_detalles_salidas_maquinaria_proveedor_maquinaria').html(0);
		$('#numElementos_detalles_salidas_maquinaria_proveedor_maquinaria').html(0);
		$('#txtNumDetalles_salidas_maquinaria_proveedor_maquinaria').html('');
	}
	
	
	//Función que se utiliza para cerrar el modal
	function cerrar_salidas_maquinaria_proveedor_maquinaria()
	{
		try {

			//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       	ocultar_circulo_carga_salidas_maquinaria_proveedor_maquinaria('');
			//Cerrar modal
			objSalidasMaquinariaProveedorMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_salidas_maquinaria_proveedor_maquinaria').focus();	
		}
		catch(err) {}
	}

	
	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_salidas_maquinaria_proveedor_maquinaria()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_salidas_maquinaria_proveedor_maquinaria();
		//Validación del formulario de campos obligatorios
		$('#frmSalidasMaquinariaProveedorMaquinaria')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
								  		strFolioEntrada_salidas_maquinaria_proveedor_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la orden de compra
					                                    if( value !== '' &&  $('#txtFolioEntradaID_salidas_maquinaria_proveedor_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una entrada por compra existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFecha_salidas_maquinaria_proveedor_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strObservaciones_salidas_maquinaria_proveedor_maquinaria: {
										     validators: {
												notEmpty: {message: 'Escriba observaciones para este movimiento'}
											}   
										},
										intNumDetalles_salidas_maquinaria_proveedor_maquinaria: {
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
										}
									
									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_salidas_maquinaria_proveedor_maquinaria = $('#frmSalidasMaquinariaProveedorMaquinaria').data('bootstrapValidator');
		bootstrapValidator_salidas_maquinaria_proveedor_maquinaria.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_salidas_maquinaria_proveedor_maquinaria.isValid())
		{	
			//Hacer un llamado a la función para guardar los datos del registro
			guardar_salidas_maquinaria_proveedor_maquinaria();				
		}
		else 
			return;
	}

	
	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_salidas_maquinaria_proveedor_maquinaria()
	{
		try
		{
			$('#frmSalidasMaquinariaProveedorMaquinaria').data('bootstrapValidator').resetForm();

		}
		catch(err) {}
	}

	
	//Función para guardar o modificar los datos de un registro
	function guardar_salidas_maquinaria_proveedor_maquinaria()
	{
		//Obtenemos el objeto de la tabla detalles
		objSalida.setID( $('#txtMovimientoMaquinariaID_salidas_maquinaria_proveedor_maquinaria').val() );
		objSalida.setReferenciaID( $('#txtFolioEntradaID_salidas_maquinaria_proveedor_maquinaria').val() );
		objSalida.setTipoMovimiento( intMovimientoIDSalidaMaquinariaDevolucionProveedorMaquinaria );
		objSalida.setFolio( $('#txtFolio_salidas_maquinaria_proveedor_maquinaria').val() );
		objSalida.setFecha( $.formatFechaMysql($('#txtFecha_salidas_maquinaria_proveedor_maquinaria').val()) );
		objSalida.setObservaciones( $('#txtObservaciones_salidas_maquinaria_proveedor_maquinaria').val() );

		//Agregar maquinarias del GRID
		//Limpiamos todo el array de maquinarias para insertar de nuevo los elementos
		objSalida.arrMaquinarias = [];

		//Obtenemos el objeto de la tabla detalles
		var objTabla = document.getElementById('dg_detalles_salidas_maquinaria_proveedor_maquinaria').getElementsByTagName('tbody')[0];

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Obtener cantidades y descripciones de cada aditamento
			var strSerie = objRen.cells[0].innerHTML;
			var strMotor = objRen.cells[1].innerHTML;
			var strCodigo = objRen.cells[2].innerHTML;
			var strDescripcionCorta = objRen.cells[3].innerHTML;
			var strDescripcion = objRen.cells[6].innerHTML;
			var intMaquinariaDescripcionID = objRen.cells[7].innerHTML;

			//Variable para crea el ojeto Maquinaria
			var objMaquinaria = new Maquinaria(null, intRen, intMaquinariaDescripcionID, strCodigo, strDescripcionCorta, strDescripcion, strSerie, strMotor);
			//Si el renglón será devuelto debido a que el Checbox para devolución esta seleccionado
			if( objRen.cells[4].childNodes[0].checked == true ){
				//Inserta en la vista el objeto objSalida<-objMaquinaria
				objSalida.setMaquinaria(objMaquinaria);
			}		
		}

		//Convenrtir al formato JSON todo lo generado en el objeto de la vista
		var jsonSalida = JSON.stringify(objSalida); 

		//Hacer un llamado al método del controlador para guardar los datos del registro	
		$.post('maquinaria/salidas_maquinaria_proveedor/guardar',
				{ 
					//Datos de la entrada por compra
					strFolioConsecutivo: $('#txtFolio_salidas_maquinaria_proveedor_maquinaria').val(),
					salidaProveedor: jsonSalida,
					intProcesoMenuID: $('#txtProcesoMenuID_salidas_maquinaria_proveedor_maquinaria').val()
				},
				function(data) {

					if (data.resultado)
					{	    
	                    //Si no existe id del movimiento, significa que es un nuevo registro   
						if($('#txtMovimientoMaquinariaID_salidas_maquinaria_proveedor_maquinaria').val() == '')
						{
						  	//Asignar el id del movimiento registrado en la base de datos
                 			$('#txtMovimientoMaquinariaID_salidas_maquinaria_proveedor_maquinaria').val(data.movimiento_maquinaria_id);


						} 


		               
	                    //Hacer llamado a la función  para cargar  los registros en el grid
		               	paginacion_salidas_maquinaria_proveedor_maquinaria();    

	               		//Hacer un llamado a la función para generar póliza con los datos del registro
                        generar_poliza_salidas_maquinaria_proveedor_maquinaria('', '');           	    
					}

					//Si existe mensaje de error
                    if(data.tipo_mensaje == 'error')
                    {
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_salidas_maquinaria_proveedor_maquinaria(data.tipo_mensaje, data.mensaje);
					}
				},
		'json');
		
		
	}

	// Función para cambiar el estatus del registro seleccionado
	function cambiar_estatus_salidas_maquinaria_proveedor_maquinaria(id, polizaID, folioPoliza)
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Variable que se utiliza para asignar el id de la póliza
        var intPolizaID = 0;
        //Variable que se utiliza para asignar el folio de la póliza
        var strFolioPoliza = '';

		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_salidas_maquinaria_proveedor_maquinaria').val();
			intPolizaID = $('#txtPolizaID_salidas_maquinaria_proveedor_maquinaria').val();
            strFolioPoliza = $('#txtFolioPoliza_salidas_maquinaria_proveedor_maquinaria').val();
		}
		else
		{
			intID = id;
			intPolizaID = polizaID;
            strFolioPoliza = folioPoliza;
		}

	//Preguntar al usuario si desea desactivar el registro
	new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro; también se desactivara la póliza con folio: '+strFolioPoliza+'?</strong>',
             {'type':     'question',
              'title':    'Salida de Maquinaria por Devolución a Proveedor',
              'buttons':  ['Aceptar', 'Cancelar'],
              'onClose':  function(caption) {
                            if(caption == 'Aceptar')
                            {
                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
                              $.post('maquinaria/salidas_maquinaria_proveedor/set_estatus',
                                     {
                                     	intMovimientoMaquinariaID: intID,
                                        intPolizaID: intPolizaID
                                     },
                                     function(data) {
                                        if(data.resultado)
                                        {
                                          	//Hacer llamado a la función  para cargar  los registros en el grid
                                          	paginacion_salidas_maquinaria_proveedor_maquinaria();
                                          	//Si el id del registro se obtuvo del modal
											if(id == '')
											{
												//Hacer un llamado a la función para cerrar modal
												cerrar_salidas_maquinaria_proveedor_maquinaria();     
											}
                                        }
                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                                        mensaje_salidas_maquinaria_proveedor_maquinaria(data.tipo_mensaje, data.mensaje);
                                     },
                                    'json');
                            }
                          }
              });
	    
	}

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_salidas_maquinaria_proveedor_maquinaria(id, tipoAccion)
	{	
		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.post('maquinaria/salidas_maquinaria_proveedor/get_datos',
	       {
	       		intMovimientoMaquinariaID:id
	       },
	       function(data) {

	       		console.log(data);

	        	//Si hay datos del registro 
	            if(data.row)
	            {  
	            	//Hacer un llamado a la función para limpiar los campos del formulario
					nuevo_salidas_maquinaria_proveedor_maquinaria();
					//Asignar el id de la póliza
                    var intPolizaID = parseInt(data.row.poliza_id);
				    //Asignar estatus del registro
				    var strEstatus = data.row.estatus;
		          	
		          	//Recuperar valores para la Vista
		            $('#txtMovimientoMaquinariaID_salidas_maquinaria_proveedor_maquinaria').val(data.row.movimiento_maquinaria_id);
		            $('#txtFolio_salidas_maquinaria_proveedor_maquinaria').val(data.row.folio);
		            $('#txtFecha_salidas_maquinaria_proveedor_maquinaria').val(data.row.fecha);
		            $('#txtFolioEntradaID_salidas_maquinaria_proveedor_maquinaria').val(data.row.referencia_id);
		            $('#txtFolioEntrada_salidas_maquinaria_proveedor_maquinaria').val(data.row.folioEntrada);
		            $('#txtProveedorID_salidas_maquinaria_proveedor_maquinaria').val(data.row.proveedor_id);
					$('#txtProveedor_salidas_maquinaria_proveedor_maquinaria').val(data.row.proveedor);
					$('#txtObservaciones_salidas_maquinaria_proveedor_maquinaria').val(data.row.observaciones);
				
				 	$('#txtPolizaID_salidas_maquinaria_proveedor_maquinaria').val(intPolizaID);
                    $('#txtFolioPoliza_salidas_maquinaria_proveedor_maquinaria').val(data.row.folio_poliza);


					//Asignar valores al objeto que maneja los valores de la Vista
					objSalida.setID(data.row.movimiento_maquinaria_id);
					objSalida.setFolio(data.row.folio);
					objSalida.setReferenciaID(data.row.referencia_id);
					objSalida.setObservaciones(data.row.observaciones);	            

		           	//Mostramos los detalles del registro
		           	for (var intCon in data.detalles) 
		            {	
		            	//Obtenemos el objeto de la tabla
						var objTabla = document.getElementById('dg_detalles_salidas_maquinaria_proveedor_maquinaria').getElementsByTagName('tbody')[0];
						
						//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaSerie = objRenglon.insertCell(0);
							var objCeldaMotor = objRenglon.insertCell(1);
							var objCeldaCodigo = objRenglon.insertCell(2);
							var objCeldaDescripcionCorta = objRenglon.insertCell(3);						
							var objCeldaDevolver = objRenglon.insertCell(4);
							var objCeldaAcciones = objRenglon.insertCell(5);
							var objCeldaDescripcion = objRenglon.insertCell(6);
							var objCeldaMaquinariaID = objRenglon.insertCell(7);

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].maquinaria_descripcion_id);
							objCeldaSerie.setAttribute('class', 'movil b3');
							objCeldaSerie.innerHTML = data.detalles[intCon].serie;
							objCeldaMotor.setAttribute('class', 'movil b4');
							objCeldaMotor.innerHTML = data.detalles[intCon].motor;
							objCeldaCodigo.setAttribute('class', 'movil b1');
							objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
							objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
							objCeldaDescripcionCorta.innerHTML = data.detalles[intCon].descripcion_corta;
							objCeldaDevolver.setAttribute('class', 'td-center movil b5');
							objCeldaDevolver.innerHTML = "<input type='checkbox' class='form-check-input' checked>";
							objCeldaAcciones.setAttribute('class', 'td-center movil b6');
							objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Aditamentos'" +
														 " onclick='ver_aditamentos_renglon_detalles_salidas_maquinaria_proveedor_maquinaria(this)'>" +
														 "<span class='glyphicon glyphicon-cog'></span></button>";
							objCeldaDescripcion.setAttribute('class', 'no-mostrar');
							objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
							objCeldaMaquinariaID.setAttribute('class', 'no-mostrar');
							objCeldaMaquinariaID.innerHTML = data.detalles[intCon].maquinaria_descripcion_id;	
						
		            }

					//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
					var intFilas = $("#dg_detalles_salidas_maquinaria_proveedor_maquinaria tr").length - 1;
					$('#numElementos_detalles_salidas_maquinaria_proveedor_maquinaria').html(intFilas);
					$('#txtNumDetalles_salidas_maquinaria_proveedor_maquinaria').val(intFilas);
					
					//Dependiendo del estatus cambiar el color del encabezado 
		            $('#divEncabezadoModal_salidas_maquinaria_proveedor_maquinaria').addClass("estatus-"+ strEstatus);
		            //Mostrar botón Imprimir  
		            $("#btnImprimirRegistro_salidas_maquinaria_proveedor_maquinaria").show();
					
					//Si el tipo de acción corresponde a Ver
		            if(tipoAccion == 'Ver')
		            {
		            	//Deshabilitar todos los elementos del formulario
		            	$('#frmSalidasMaquinariaProveedorMaquinaria').find('input, textarea, select').attr('disabled','disabled');
		            	//Ocultar los siguientes botones
			            $("#btnGuardar_salidas_maquinaria_proveedor_maquinaria").hide();

			           //Si existe el id de la póliza
                        if(strEstatus == 'ACTIVO' && intPolizaID > 0)
                        {
                            //Mostrar el botón Desactivar
                            $("#btnDesactivar_salidas_maquinaria_proveedor_maquinaria").show();
                        }
		            }


			 		//Abrir modal
			 		objSalidasMaquinariaProveedorMaquinaria = $('#SalidasMaquinariaProveedorMaquinariaBox').bPopup({
										   appendTo: '#SalidasMaquinariaProveedorMaquinariaContent', 
			                               contentContainer: 'SalidasMaquinariaProveedorMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});

		            //Enfocar caja de texto
					$('#txtFolioEntrada_salidas_maquinaria_proveedor_maquinaria').focus();
					
	       	    }
	       	    
	       	    
	       },
	       'json');

	}


		//Función para generar póliza con los datos de un registro
        function generar_poliza_salidas_maquinaria_proveedor_maquinaria(id, formulario)
        {   

            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Variable que se utiliza para saber si el id se obtuvo desde el modal
            var strTipo = 'modal';
            //Si no existe id, significa que se realizará la modificación desde el modal
            if(id == '')
            {
                intID = $('#txtMovimientoMaquinariaID_salidas_maquinaria_proveedor_maquinaria').val();
            }
            else
            {
                intID = id;
                strTipo = 'gridview';
            }

            //Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
            mostrar_circulo_carga_salidas_maquinaria_proveedor_maquinaria(formulario);
            //Hacer un llamado al método del controlador para timbrar los datos del registro
            $.post('contabilidad/generar_polizas/generar_poliza',
             {
                intReferenciaID: intID,
                strTipoReferencia: strTipoReferenciaSalidaMaquinariaDevolucionProveedorMaquinaria, 
                intProcesoMenuID: $('#txtProcesoMenuID_salidas_maquinaria_proveedor_maquinaria').val()
             },
             function(data) {

                //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
                ocultar_circulo_carga_salidas_maquinaria_proveedor_maquinaria(formulario);
                
                //Si existe resultado
                if (data.resultado)
                {
                    //Hacer llamado a la función para cargar  los registros en el grid
                    paginacion_salidas_maquinaria_proveedor_maquinaria();

                    //Si el id del registro se obtuvo del modal
                    if(strTipo == 'modal')
                    {
                        //Hacer un llamado a la función para cerrar modal
                        cerrar_salidas_maquinaria_proveedor_maquinaria();
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
			            								cerrar_salidas_maquinaria_proveedor_maquinaria();
	                                                 }
	                                                }]
	                                  });
				}
				else
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    	mensaje_salidas_maquinaria_proveedor_maquinaria(data.tipo_mensaje, data.mensaje);
				}

                
             },
             'json');

        }

         //Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function mostrar_circulo_carga_salidas_maquinaria_proveedor_maquinaria(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_salidas_maquinaria_proveedor_maquinaria';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_salidas_maquinaria_proveedor_maquinaria';
            }

            //Remover clase para mostrar div que contiene la barra de carga
            $("#"+strCampoID).removeClass('no-mostrar');
        }


        //Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function ocultar_circulo_carga_salidas_maquinaria_proveedor_maquinaria(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_salidas_maquinaria_proveedor_maquinaria';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_salidas_maquinaria_proveedor_maquinaria';
            }

            //Agregar clase para ocultar div que contiene la barra de carga
            $("#"+strCampoID).addClass('no-mostrar');
        }




    //Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_salidas_maquinaria_proveedor_maquinaria(strTipo) 
	{	
		//Variable que se utiliza para asignar URL (ruta del controlador)
        var strUrl = 'maquinaria/salidas_maquinaria_proveedor/';

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
		if ($('#chbImprimirDetalles_salidas_maquinaria_proveedor_maquinaria').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_salidas_maquinaria_proveedor_maquinaria').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_salidas_maquinaria_proveedor_maquinaria').val('NO');
		}

        //Definir encapsulamiento de datos que son necesarios para generar el reporte
        objReporte = {'url': strUrl,
                        'data' : {
                                    'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_salidas_maquinaria_proveedor_maquinaria').val()),
                                    'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_salidas_maquinaria_proveedor_maquinaria').val()),
                                    'intProveedorID': $('#txtProveedorIDBusq_salidas_maquinaria_proveedor_maquinaria').val(),
                                    'strEstatus': $('#cmbEstatusBusq_salidas_maquinaria_proveedor_maquinaria').val(), 
                                    'strBusqueda': $('#txtBusqueda_salidas_maquinaria_proveedor_maquinaria').val(),
                                    'strDetalles': $('#chbImprimirDetalles_salidas_maquinaria_proveedor_maquinaria').val()       
                                 }
                       };


        //Hacer un llamado a la función para imprimir/descargar el reporte
        $.imprimirReporte(objReporte);
	}
		
	//Función para cargar el reporte de un registro en PDF
	function reporte_registro_salidas_maquinaria_proveedor_maquinaria(id) 
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la impresión desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_salidas_maquinaria_proveedor_maquinaria').val();
		}
		else
		{
			intID = id;
		}


		//Definir encapsulamiento de datos que son necesarios para generar el reporte
        objReporte = {'url': 'maquinaria/salidas_maquinaria_proveedor/get_reporte_registro',
                        'data' : {
                                    'intMovimientoMaquinariaID': intID
                                 }
                       };

        //Hacer un llamado a la función para imprimir el reporte
        $.imprimirReporte(objReporte);
	}

	//Función para mostrar mensaje de éxito o error
	function mensaje_salidas_maquinaria_proveedor_maquinaria(tipoMensaje, mensaje)
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
	

	//Función para agregar Aditamentos del renglón seleccionado
	function ver_aditamentos_renglon_detalles_salidas_maquinaria_proveedor_maquinaria(objRenglon){

		var serie = objRenglon.parentNode.parentNode.cells[0].innerHTML; 
		var motor = objRenglon.parentNode.parentNode.cells[1].innerHTML; 
		var codigo = objRenglon.parentNode.parentNode.cells[2].innerHTML; 
		var descripcionCorta = objRenglon.parentNode.parentNode.cells[3].innerHTML;

		nuevo_aditamentos_salidas_maquinaria_proveedor_maquinaria(serie, motor, codigo, descripcionCorta);

	}


	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_movimientos_salidas_maquinaria_proveedor_maquinaria(strTipo) 
	{	
		//Variable que se utiliza para asignar URL (ruta del controlador)
        var strUrl = 'maquinaria/salidas_maquinaria_proveedor/';

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
		if ($('#chbImprimirDetalles_movimientos_salidas_maquinaria_proveedor_maquinaria').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_movimientos_salidas_maquinaria_proveedor_maquinaria').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_movimientos_salidas_maquinaria_proveedor_maquinaria').val('NO');
		}

        //Definir encapsulamiento de datos que son necesarios para generar el reporte
        objReporte = {'url': strUrl,
                        'data' : {
                                    'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_maquinaria_proveedor_maquinaria').val()),
                                    'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_maquinaria_proveedor_maquinaria').val()),
                                    'intProveedorID': $('#txtProveedorIDBusq_movimientos_salidas_maquinaria_proveedor_maquinaria').val(),
                                    'strEstatus': $('#cmbEstatusBusq_movimientos_salidas_maquinaria_proveedor_maquinaria').val(), 
                                    'strBusqueda': $('#txtBusqueda_movimientos_salidas_maquinaria_proveedor_maquinaria').val(),
                                    'strDetalles': $('#chbImprimirDetalles_movimientos_salidas_maquinaria_proveedor_maquinaria').val()       
                                 }
                       };


        //Hacer un llamado a la función para imprimir/descargar el reporte
        $.imprimirReporte(objReporte);
	}

	
	/*******************************************************************************************************************
	Funciones del modal secundario
	*********************************************************************************************************************/
	//Agregar aditamentos a una maquinaria
	function nuevo_aditamentos_salidas_maquinaria_proveedor_maquinaria(serie, motor, codigo, descripcionCorta){

		inicializar_aditamentos_detalles_salidas_maquinaria_proveedor_maquinaria();
		
		//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
		$('#divEncabezadoModalSecundario_salidas_maquinaria_proveedor_maquinaria').addClass("estatus-NUEVO");
		//Abrir modal secundario
		 objAditamentosSalidasMaquinariaProveedorMaquinaria = $('#AditamentosSalidasMaquinariaProveedorMaquinariaBox').bPopup({
									   appendTo: '#SalidasMaquinariaProveedorMaquinariaContent', 
		                               contentContainer: 'AditamentosSalidasMaquinariaProveedorMaquinariaM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});
		
		//Asignar los valores que vienen del modal primario
		$('#txtCodigoAditamentos_salidas_maquinaria_proveedor_maquinaria').val( codigo ); 
		$('#txtDescripcionAditamentos_salidas_maquinaria_proveedor_maquinaria').val( descripcionCorta );
		$('#txtSerieAditamentos_salidas_maquinaria_proveedor_maquinaria').val( serie );
		$('#txtMotorAditamentos_salidas_maquinaria_proveedor_maquinaria').val( motor );

		//Consultar si la serie contiene aditamentos 
		//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
          $.post('maquinaria/salidas_maquinaria_proveedor/get_aditamentos',
              { 
              	strSerie: $("#txtSerieAditamentos_salidas_maquinaria_proveedor_maquinaria").val()
              },
              function(data) {

              	//Si se econtró información
                if(data){

                	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_aditamentos_detalles_salidas_maquinaria_proveedor_maquinaria').getElementsByTagName('tbody')[0];

                	for (var intCon in data) 
			        {
			        	//Insertamos el renglón con sus celdas en el objeto de la tabla
						var objRenglon = objTabla.insertRow();
						var objCeldaCantidad = objRenglon.insertCell(0);
						var objCeldaDescripcion = objRenglon.insertCell(1);
						
						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', data[intCon].renglon);
						objCeldaCantidad.setAttribute('class', 'movil b1');
						objCeldaCantidad.innerHTML = data[intCon].cantidad;
						objCeldaDescripcion.setAttribute('class', 'movil b2');
						objCeldaDescripcion.innerHTML = data[intCon].descripcion;
			        }

			        var intFilas = $("#dg_aditamentos_detalles_salidas_maquinaria_proveedor_maquinaria tr").length - 1;
					$('#numElementos_detalles_aditamentos_salidas_maquinaria_proveedor_maquinaria').html(intFilas);

                }
            }
             ,
            'json');

	}

	//Función que se utiliza para cerrar el modal secundario
	function cerrar_aditamentos_salidas_maquinaria_proveedor_maquinaria()
	{
		try {
			//Cerrar modal
			objAditamentosSalidasMaquinariaProveedorMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtCodigo_detalles_salidas_maquinaria_proveedor_maquinaria').focus();	
		}
		catch(err) {}
	}

	//Función para inicializar elementos de la tabla detalles
	function inicializar_aditamentos_detalles_salidas_maquinaria_proveedor_maquinaria()
	{
		//Eliminar los datos de la tabla
		$('#dg_aditamentos_detalles_salidas_maquinaria_proveedor_maquinaria tbody').empty();
		$('#numElementos_detalles_aditamentos_salidas_maquinaria_proveedor_maquinaria').html(0);
	}


	//Al inicializar el componente
	$(document).ready(function() 
	{
		/********************************************************************************************************************
		Controles correspondientes al MODAL SECUNDARIO
		*********************************************************************************************************************/
        /********************************************************************************************************************
		Controles correspondientes al MODAL
		*********************************************************************************************************************/
        //Agregar datepicker para seleccionar fecha
		$('#dteFecha_salidas_maquinaria_proveedor_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFecha_salidas_maquinaria_proveedor_maquinaria').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

        //Autocomplete para recuperar los datos de una orden de compra seleccionada
        $('#txtFolioEntrada_salidas_maquinaria_proveedor_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtFolioEntradaID_salidas_maquinaria_proveedor_maquinaria').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "maquinaria/movimientos_entradas_maquinaria_compra/autocomplete",
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

           		//Limpiar los detalles del Grid para cargar la información correspondiente a la orden de compra
				$('#dg_detalles_salidas_maquinaria_proveedor_maquinaria tbody').empty();

           	    //Asignar id del registro seleccionado
           	    $('#txtFolioEntradaID_salidas_maquinaria_proveedor_maquinaria').val(ui.item.movimiento_maquinaria_id);
           	    $('#txtFolioEntrada_salidas_maquinaria_proveedor_maquinaria').val(ui.item.value); 
                //Cargar detalles del movimiento de entrada por compra de maquinaria para seleccionar que se desea devolver
                $.post('maquinaria/movimientos_entradas_maquinaria_compra/get_datos',
                { 
                  	intMovimientoMaquinariaID: $('#txtFolioEntradaID_salidas_maquinaria_proveedor_maquinaria').val()
                },
                  function(data) { 
                  	//Si hay datos del registro
			        if(data.row)
			        {
	                    //Cargar datos del registro
	                    $('#txtProveedor_salidas_maquinaria_proveedor_maquinaria').val(data.row.proveedor);
	                    

	                    //Cargar detalles del registro
		                if(data.detalles){

		                	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_salidas_maquinaria_proveedor_maquinaria').getElementsByTagName('tbody')[0];
							//Variable para llevar el registro de cuantos renglones han sido insertados
							
				           	for (var intCon in data.detalles) 
				            {	
				            	//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaSerie = objRenglon.insertCell(0);
								var objCeldaMotor = objRenglon.insertCell(1);
								var objCeldaCodigo = objRenglon.insertCell(2);
								var objCeldaDescripcionCorta = objRenglon.insertCell(3);						
								var objCeldaDevolver = objRenglon.insertCell(4);
								var objCeldaAcciones = objRenglon.insertCell(5);
								var objCeldaDescripcion = objRenglon.insertCell(6);
								var objCeldaMaquinariaID = objRenglon.insertCell(7);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].maquinaria_descripcion_id);
								objCeldaSerie.setAttribute('class', 'movil b3');
								objCeldaSerie.innerHTML = data.detalles[intCon].serie;
								objCeldaMotor.setAttribute('class', 'movil b4');
								objCeldaMotor.innerHTML = data.detalles[intCon].motor;
								objCeldaCodigo.setAttribute('class', 'movil b1');
								objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
								objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
								objCeldaDescripcionCorta.innerHTML = data.detalles[intCon].descripcion_corta;
								objCeldaDevolver.setAttribute('class', 'td-center movil b5');
								objCeldaDevolver.innerHTML = "<input type='checkbox' class='form-check-input' >";
								objCeldaAcciones.setAttribute('class', 'td-center movil b6');
								objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Aditamentos'" +
															 " onclick='ver_aditamentos_renglon_detalles_salidas_maquinaria_proveedor_maquinaria(this)'>" +
															 "<span class='glyphicon glyphicon-cog'></span></button>";
								objCeldaDescripcion.setAttribute('class', 'no-mostrar');
								objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
								objCeldaMaquinariaID.setAttribute('class', 'no-mostrar');
								objCeldaMaquinariaID.innerHTML = data.detalles[intCon].maquinaria_descripcion_id;							 

							}

		                }

		                //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_salidas_maquinaria_proveedor_maquinaria tr").length - 1;
						$('#numElementos_detalles_salidas_maquinaria_proveedor_maquinaria').html(intFilas);
						$('#txtNumDetalles_salidas_maquinaria_proveedor_maquinaria').val(intFilas);
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
		$('#btnAditamentos_salidas_maquinaria_proveedor_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			if($('#txtSerie_detalles_salidas_maquinaria_proveedor_maquinaria').val() != ''){
				nuevo_aditamentos_salidas_maquinaria_proveedor_maquinaria('');
			}
				
		});


		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_salidas_maquinaria_proveedor_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_salidas_maquinaria_proveedor_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_salidas_maquinaria_proveedor_maquinaria').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_salidas_maquinaria_proveedor_maquinaria').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_salidas_maquinaria_proveedor_maquinaria').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_salidas_maquinaria_proveedor_maquinaria').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_salidas_maquinaria_proveedor_maquinaria').on('click','a',function(event){
			event.preventDefault();
			intPaginaSalidasMaquinariaProveedorMaquinaria = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_salidas_maquinaria_proveedor_maquinaria();
		});

		//Autocomplete para recuperar los datos de un cliente 
        $('#txtProveedorBusq_salidas_maquinaria_proveedor_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtProveedorIDBusq_salidas_maquinaria_proveedor_maquinaria').val('');
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
           	  $('#txtProveedorIDBusq_salidas_maquinaria_proveedor_maquinaria').val(ui.item.data); 
              //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
              $.post('cuentas_pagar/proveedores/get_datos',
                  { 
                  	intProveedorID: $("#txtProveedorIDBusq_salidas_maquinaria_proveedor_maquinaria").val(),
                  	strRfc: ''
                  },
                  function(data) { 
                    if(data.row){ 
                    	$("#txtProveedorIDBusq_salidas_maquinaria_proveedor_maquinaria").val(data.row.proveedor_id);
                    	$("#txtProveedorBusq_salidas_maquinaria_proveedor_maquinaria").val(data.row.nombre_comercial);
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
		$('#btnNuevo_salidas_maquinaria_proveedor_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_salidas_maquinaria_proveedor_maquinaria('Nuevo');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_salidas_maquinaria_proveedor_maquinaria').addClass("estatus-NUEVO");
			//Abrir modal
			objSalidasMaquinariaProveedorMaquinaria = $('#SalidasMaquinariaProveedorMaquinariaBox').bPopup({
										   appendTo: '#SalidasMaquinariaProveedorMaquinariaContent', 
			                               contentContainer: 'SalidasMaquinariaProveedorMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});

			//Enfocar caja de texto
			$('#txtFolioEntrada_salidas_maquinaria_proveedor_maquinaria').focus();
			
		});

        //Enfocar caja de texto
        $('#txtFechaInicialBusq_salidas_maquinaria_proveedor_maquinaria').focus();

 
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_salidas_maquinaria_proveedor_maquinaria();

	});

</script>