<div id="EntradasMaquinariaTraspasoMaquinariaContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_entradas_maquinaria_traspaso_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_entradas_maquinaria_traspaso_maquinaria">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_entradas_maquinaria_traspaso_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_entradas_maquinaria_traspaso_maquinaria"
			                    		name= "strFechaInicialBusq_entradas_maquinaria_traspaso_maquinaria" 
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
							<label for="txtFechaFinalBusq_entradas_maquinaria_traspaso_maquinaria">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_entradas_maquinaria_traspaso_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_entradas_maquinaria_traspaso_maquinaria"
			                    		name= "strFechaFinalBusq_entradas_maquinaria_traspaso_maquinaria" 
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
							<label for="txtSucursalSalidaBusq_entradas_maquinaria_traspaso_maquinaria">Sucursal</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtSucursalSalidaIDBusq_entradas_maquinaria_traspaso_maquinaria" 
									name="intSucursalSalidaIDBusq_entradas_maquinaria_traspaso_maquinaria" 
									type="hidden" />
							<input  class="form-control" 
									id="txtSucursalSalidaBusq_entradas_maquinaria_traspaso_maquinaria" 
									name="strSucursalBusq_entradas_maquinaria_traspaso_maquinaria" 
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
							<label for="cmbEstatusBusq_entradas_maquinaria_traspaso_maquinaria">Estatus</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="cmbEstatusBusq_entradas_maquinaria_traspaso_maquinaria" 
							 		name="strEstatusBusq_entradas_maquinaria_traspaso_maquinaria" tabindex="1">
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
							<label for="txtBusqueda_entradas_maquinaria_traspaso_maquinaria">Descripción</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtBusqueda_entradas_maquinaria_traspaso_maquinaria" 
									name="strBusqueda_entradas_maquinaria_traspaso_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Mostrar detalles de los registros en el reporte PDF--> 
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
					<div class="checkbox">
                    	<label id="label-checkbox">
                        	<input class="form-control" 
                        			id="chbImprimirDetalles_entradas_maquinaria_traspaso_maquinaria" 
								   	name="strImprimirDetalles_entradas_maquinaria_traspaso_maquinaria" 
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
						<button class="btn btn-primary" id="btnBuscar_entradas_maquinaria_traspaso_maquinaria"
								onclick="paginacion_entradas_maquinaria_traspaso_maquinaria();" 
								title="Buscar coincidencias" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<!--Dar de alta un nuevo registro-->
						<button class="btn btn-info" id="btnNuevo_entradas_maquinaria_traspaso_maquinaria" 
								title="Nuevo registro" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>   
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_entradas_maquinaria_traspaso_maquinaria"
								onclick="reporte_entradas_maquinaria_traspaso_maquinaria('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_entradas_maquinaria_traspaso_maquinaria"
								onclick="reporte_entradas_maquinaria_traspaso_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
			<table class="table-hover movil" id="dg_entradas_maquinaria_traspaso_maquinaria">
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
				<script id="plantilla_entradas_maquinaria_traspaso_maquinaria" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil">{{folio}}</td>
						<td class="movil">{{fecha}}</td>
						<td class="movil">{{sucursalSalida}}</td>
						<td class="movil">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_entradas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}},'Ver')"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_entradas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Generar póliza-->
							<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
									onclick="generar_poliza_entradas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}}, 'principal')"  title="Generar póliza">
								<span class="glyphicon glyphicon-tags"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_entradas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_entradas_maquinaria_traspaso_maquinaria"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_entradas_maquinaria_traspaso_maquinaria">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->
	<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_entradas_maquinaria_traspaso_maquinaria" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 	

	<!-- Diseño del modal-->
	<div id="EntradasMaquinariaTraspasoMaquinariaBox" class="ModalBody"  tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_entradas_maquinaria_traspaso_maquinaria"  class="ModalBodyTitle">
		<h1>Entradas de maquinaria por traspaso</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmEntradasMaquinariaTraspasoMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmEntradasMaquinariaTraspasoMaquinaria"  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Autocomplete que contiene las salidas de refacciones por traspaso que se encuentran activas-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtMovimientoMaquinariaID_entradas_maquinaria_traspaso_maquinaria" 
									   name="intMovimientoCajaHerramientas_entradas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
							   <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_entradas_maquinaria_traspaso_maquinaria" 
										   name="intPolizaID_entradas_maquinaria_traspaso_maquinaria" type="hidden" value="" />
								    <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
									<input id="txtFolioPoliza_entradas_maquinaria_traspaso_maquinaria" 
										   name="strFolioPoliza_entradas_maquinaria_traspaso_maquinaria" type="hidden" value="" />
								<!-- Caja de texto oculta que se utiliza para recuperar el id del movimiento de salida traspaso seleccionada-->
								<input id="txtReferenciaID_entradas_maquinaria_traspaso_maquinaria" 
									   name="intReferenciaID_entradas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtReferencia_entradas_maquinaria_traspaso_maquinaria">Folio</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtReferencia_entradas_maquinaria_traspaso_maquinaria" 
										name="strReferencia_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese salida" 
										maxlength="250" />			
							</div>
						</div>
					</div>
					<!-- Fecha -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFecha_entradas_maquinaria_traspaso_maquinaria">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_entradas_maquinaria_traspaso_maquinaria'>
				                    <input class="form-control" 
				                    		id="txtFecha_entradas_maquinaria_traspaso_maquinaria"
				                    		name= "strFecha_entradas_maquinaria_traspaso_maquinaria" 
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
					<!-- Sucursal de salida -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar la sucursal_id de la cual proviene la salida por traspaso-->
								<input id="txtSucursalSalidaID_entradas_maquinaria_traspaso_maquinaria" 
									   name="intSucursalSalidaID_entradas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtSucursalSalida_entradas_maquinaria_traspaso_maquinaria">Sucursal</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSucursalSalida_entradas_maquinaria_traspaso_maquinaria" 
										name="strSucursalSalida_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="" disabled />			
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Chofer -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtChofer_entradas_maquinaria_traspaso_maquinaria">Chofer</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtChofer_entradas_maquinaria_traspaso_maquinaria" 
										name="strChofer_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder=""  disabled />			
							</div>
						</div>
					</div>
					<!-- Vehículo -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtVehiculo_entradas_maquinaria_traspaso_maquinaria">Vehículo</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtVehiculo_entradas_maquinaria_traspaso_maquinaria" 
										name="strVehiculo_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="" disabled />			
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Observaciones -->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtObservaciones_entradas_maquinaria_traspaso_maquinaria">Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_entradas_maquinaria_traspaso_maquinaria" 
										name="strObservaciones_entradas_maquinaria_traspaso_maquinaria" 
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
								<input id="txtNumDetalles_entradas_maquinaria_traspaso_maquinaria" 
							   		name="intNumDetalles_entradas_maquinaria_traspaso_maquinaria" type="hidden" value="">
								</input>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Detalles de la entrada</h4>
									</div>
									<div class="panel-body">
										<div class="row">
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_entradas_maquinaria_traspaso_maquinaria">
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
																<strong id="numElementos_detalles_entradas_maquinaria_traspaso_maquinaria">0</strong> encontrados
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
					<div id="divCirculoBarProgreso_entradas_maquinaria_traspaso_maquinaria" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div>
				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Nuevo registro-->
						<button class="btn btn-info" 
								id="btnReset_entradas_maquinaria_traspaso_maquinaria"  
								onclick="nuevo_entradas_maquinaria_traspaso_maquinaria('Nuevo');"  
								title="Nuevo registro" 
								tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" 
								id="btnGuardar_entradas_maquinaria_traspaso_maquinaria"  
								onclick="validar_entradas_maquinaria_traspaso_maquinaria();"  
								title="Guardar" 
								tabindex="3" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_entradas_maquinaria_traspaso_maquinaria"  
								onclick="reporte_registro_entradas_maquinaria_traspaso_maquinaria('');"  
								title="Imprimir" 
								tabindex="4" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" id="btnDesactivar_entradas_maquinaria_traspaso_maquinaria"  
								onclick="cambiar_estatus_entradas_maquinaria_traspaso_maquinaria('', '', '');"  title="Desactivar" tabindex="5" disabled>
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  
								id="btnCerrar_entradas_maquinaria_traspaso_maquinaria"
								type="reset" 
								aria-hidden="true" 
								onclick="cerrar_entradas_maquinaria_traspaso_maquinaria();" 
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
	<div id="AditamentosEntradasMaquinariaTraspasoMaquinariaBox" class="ModalBody" tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModalSecundario_entradas_maquinaria_traspaso_maquinaria" class="ModalBodyTitle">
			<h1>Ver aditamentos</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmAditamentosEntradasMaquinariaTraspasoMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmAditamentosEntradasMaquinariaTraspasoMaquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
				  	<!--Código-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el renglón seleccionado -->	
								<label for="txtCodigoAditamentos_entradas_maquinaria_traspaso_maquinaria">Código</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtCodigoAditamentos_entradas_maquinaria_traspaso_maquinaria" 
										name="strCodigoAditamentos_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtDescripcionAditamentos_entradas_maquinaria_traspaso_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtDescripcionAditamentos_entradas_maquinaria_traspaso_maquinaria" 
										name="strDescripcionAditamentos_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Serie-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtSerieAditamentos_entradas_maquinaria_traspaso_maquinaria">Serie</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSerieAditamentos_entradas_maquinaria_traspaso_maquinaria" 
										name="strSerieAditamentos_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Motor-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtMotorAditamentos_entradas_maquinaria_traspaso_maquinaria">Motor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtMotorAditamentos_entradas_maquinaria_traspaso_maquinaria" 
										name="strMotorAditamentos_entradas_maquinaria_traspaso_maquinaria" 
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
									<table class="table-hover" id="dg_aditamentos_detalles_entradas_maquinaria_traspaso_maquinaria">
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
												<strong id="numElementos_detalles_aditamentos_entradas_maquinaria_traspaso_maquinaria">0</strong> encontrados
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
						<button class="btn  btn-cerrar"  id="btnCerrar_respuestas_entradas_maquinaria_traspaso_maquinaria"
								type="reset" aria-hidden="true" onclick="cerrar_aditamentos_entradas_maquinaria_traspaso_maquinaria();" title="Cerrar">
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

</div><!--#EntradasMaquinariaTraspasoMaquinariaContent -->


<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variable que se utiliza para asignar el id del movimiento de ENTRADA DE MAQUINARIA POR TRASPASO
	var intMovimientoIDEntradaMaquinariaTraspasoMaquinaria = <?php echo ENTRADA_MAQUINARIA_TRASPASO ?>;
	//Variables que se utilizan para la paginación de registros
	var intPaginaEntradasMaquinariaTraspasoMaquinaria = 0;
	var strUltimaBusquedaEntradasMaquinariaTraspasoMaquinaria = "";
	/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
   var strTipoReferenciaEntradaMaquinariaTraspasoMaquinaria = "MOVIMIENTO DE MAQUINARIA";
	//Variable que se utiliza para asignar objeto del modal
	var objEntradasMaquinariaTraspasoMaquinaria = null;
	//Variable que se utiliza para asignar objeto del modal secundario
	var objAditamentosEntradasMaquinariaTraspasoMaquinaria = null;

	/*******************************************************************************************************************
	Funciones del objeto Entrada por traspaso
	*********************************************************************************************************************/
	// Constructor de Entrada
	var objEntrada;
	function Entrada(id, referenciaID, tipoMovimiento, folio, fecha, observaciones, choferID, vehiculoID, sucursal_salida_id, maquinarias)
	{
	    this.intMovimientoMaquinariaID = id;
	    this.intReferenciaID = referenciaID;
	    this.strTipoMovimiento = tipoMovimiento;
	    this.strFolio = folio;
	    this.strFecha = fecha;
	    this.strObservaciones = observaciones;
	    this.intChoferID = choferID;
	    this.intVehiculoID = vehiculoID;
	    this.intSucursalSalidaID = sucursal_salida_id;

	    this.arrMaquinarias = maquinarias;
	}
	// --------------------- MÉTODOS PARA EL OBJETO ENTRADA ------------------------------------------------------------
	Entrada.prototype.setID = function(id) { this.intMovimientoMaquinariaID = id; }
	Entrada.prototype.getID = function() { return this.intMovimientoMaquinariaID; }
	Entrada.prototype.setReferenciaID = function(referenciaID) { this.intReferenciaID = referenciaID; }
	Entrada.prototype.getReferenciaID = function() { return this.intReferenciaID; }
	Entrada.prototype.setTipoMovimiento = function(tipoMovimiento) { this.strTipoMovimiento = tipoMovimiento; }
	Entrada.prototype.getTipoMovimiento = function() { return this.strTipoMovimiento; }
	Entrada.prototype.setFolio = function(folio) { this.strFolio = folio; }
	Entrada.prototype.getFolio = function() { return this.strFolio; }
	Entrada.prototype.setFecha = function(fecha) { this.strFecha = fecha; }
	Entrada.prototype.getFecha = function() { return this.strFecha; }
	Entrada.prototype.setChoferID = function(choferID) { this.intChoferID = choferID; }
	Entrada.prototype.getChoferID = function() { return this.intChoferID; }
	Entrada.prototype.setVehiculoID = function(vehiculoID) { this.intVehiculoID = vehiculoID; }
	Entrada.prototype.getVehiculoID = function() { return this.intVehiculoID; }
	Entrada.prototype.setObservaciones = function(observaciones) { this.strObservaciones = observaciones; }
	Entrada.prototype.getObservaciones = function() { return this.strObservaciones; }
	Entrada.prototype.setSucursalSalidaID = function(sucursal_salida_id) { this.intSucursalSalidaID = sucursal_salida_id; }
	Entrada.prototype.getSucursalSalidaID = function() { return this.intSucursalSalidaID; }
	// -------------------- FUNCIONES ASOCIADAS AL ATRIBUTO MAQUINARIAS ---------------------------------------------------
	//Función para agregar todas las maquinarias al objeto Entrada
	Entrada.prototype.setMaquinarias = function(maquinarias) { this.arrMaquinarias = maquinarias; }
	//Función para obtener todas las maquinarias del objeto Entrada
	Entrada.prototype.getMaquinarias = function() { return this.arrMaquinarias; }
	//Función para agregar una maquinaria al objeto Entrada
	Entrada.prototype.setMaquinaria = function (maquinaria){ this.arrMaquinarias.push(maquinaria); }
	//Función para obtener una maquinaria del objeto Entrada
	Entrada.prototype.getMaquinaria = function(index) { return this.arrMaquinarias[index]; }
	//Función para modificar un objeto maquinaria del objeto Entrada
	Entrada.prototype.updateMaquinaria = function (index, maquinaria){ this.arrMaquinarias[index] = maquinaria; }
	//Función para eliminar una maquinaria del objeto Entrada
	Entrada.prototype.deleteMaquinaria = function (index){
		if(index != -1) {
			this.arrMaquinarias.splice(index, 1);
		}
	}
	//Función para cambiar las posiciones de las preguntas en el Objeto Encuesta
	Entrada.prototype.swap = function(index_A, index_B) {
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
	function Maquinaria(id, renglon, maquinariaDescripcionID, codigo, descripcionCorta, descripcion, serie, motor, numeroPedimento, consignacion, codigoInterno, costo)
	{
	    this.intMovimientoMaquinariaID = id;
	    this.intRenglon = renglon;
	    this.strMaquinariaDescripcionID = maquinariaDescripcionID;
	    this.strCodigo = codigo;
	    this.strDescripcionCorta = descripcionCorta;
	    this.strDescripcion = descripcion;
	    this.strSerie = serie;
	    this.strMotor = motor;
	    this.numPedimento = numeroPedimento;
	    this.strConsignacion = consignacion;
	    this.strCodigoInterno = codigoInterno;
	    this.intCosto = costo;
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
	Maquinaria.prototype.setNumeroPedimento = function(motor) { this.numPedimento = numeroPedimento; }
	Maquinaria.prototype.getNumeroPedimento = function() { return this.numPedimento; }
	Maquinaria.prototype.setConsignacion = function(motor) { this.strConsignacion = consignacion; }
	Maquinaria.prototype.getConsignacion = function() { return this.strConsignacion; }

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_entradas_maquinaria_traspaso_maquinaria()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('maquinaria/entradas_maquinaria_traspaso/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_entradas_maquinaria_traspaso_maquinaria').val()
		},
		function(data){
			
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosEntradasMaquinariaTraspasoMaquinaria = data.row;
				//Separar la cadena 
				var arrPermisosEntradasMaquinariaTraspasoMaquinaria = strPermisosEntradasMaquinariaTraspasoMaquinaria.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosEntradasMaquinariaTraspasoMaquinaria.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosEntradasMaquinariaTraspasoMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosEntradasMaquinariaTraspasoMaquinaria[i]=='GUARDAR') || (arrPermisosEntradasMaquinariaTraspasoMaquinaria[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					//Si el indice es VER REGISTRO
					else if(arrPermisosEntradasMaquinariaTraspasoMaquinaria[i]=='VER REGISTRO')
					{
						
					}
					else if(arrPermisosEntradasMaquinariaTraspasoMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_entradas_maquinaria_traspaso_maquinaria();
					}
					else if(arrPermisosEntradasMaquinariaTraspasoMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
						$('#btnRestaurar_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosEntradasMaquinariaTraspasoMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosEntradasMaquinariaTraspasoMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosEntradasMaquinariaTraspasoMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_entradas_maquinaria_traspaso_maquinaria() 
	{
		//Concatenar datos para la nueva búsqueda
   		var strNuevaBusquedaEntradasMaquinariaTraspasoMaquinaria =($('#txtFechaInicialBusq_entradas_maquinaria_traspaso_maquinaria').val()+$('#txtFechaFinalBusq_entradas_maquinaria_traspaso_maquinaria').val()+$('#txtSucursalSalidaIDBusq_entradas_maquinaria_traspaso_maquinaria').val()+$('#cmbEstatusBusq_entradas_maquinaria_traspaso_maquinaria').val()+$('#txtBusqueda_entradas_maquinaria_traspaso_maquinaria').val());

		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaEntradasMaquinariaTraspasoMaquinaria != strUltimaBusquedaEntradasMaquinariaTraspasoMaquinaria)
		{
			intPaginaEntradasMaquinariaTraspasoMaquinariaa = 0;
			strUltimaBusquedaEntradasMaquinariaTraspasoMaquinaria = strNuevaBusquedaEntradasMaquinariaTraspasoMaquinaria;
		}
	

		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('maquinaria/entradas_maquinaria_traspaso/get_paginacion',
				{	
					dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_entradas_maquinaria_traspaso_maquinaria').val()),
	    			dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_entradas_maquinaria_traspaso_maquinaria').val()),
	    			intSucursalSalidaID: $('#txtSucursalSalidaIDBusq_entradas_maquinaria_traspaso_maquinaria').val(),
	    			strEstatus: $('#cmbEstatusBusq_entradas_maquinaria_traspaso_maquinaria').val(),
	    			strBusqueda: $('#txtBusqueda_entradas_maquinaria_traspaso_maquinaria').val(),
					intPagina:intPaginaEntradasMaquinariaTraspasoMaquinaria,
					strPermisosAcceso: $('#txtAcciones_entradas_maquinaria_traspaso_maquinaria').val()
				},
				function(data){
					$('#dg_entradas_maquinaria_traspaso_maquinaria tbody').empty();
					var tmpEntradasMaquinariaTraspasoMaquinaria = Mustache.render($('#plantilla_entradas_maquinaria_traspaso_maquinaria').html(),data);
					$('#dg_entradas_maquinaria_traspaso_maquinaria tbody').html(tmpEntradasMaquinariaTraspasoMaquinaria);
					$('#pagLinks_entradas_maquinaria_traspaso_maquinaria').html(data.paginacion);
					$('#numElementos_entradas_maquinaria_traspaso_maquinaria').html(data.total_rows);
					intPaginaEntradasMaquinariaTraspasoMaquinaria = data.pagina;
				},
		'json');
	}



	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_entradas_maquinaria_traspaso_maquinaria(tipoAccion)
	{	
		//Incializar formulario
		$('#frmEntradasMaquinariaTraspasoMaquinaria')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_entradas_maquinaria_traspaso_maquinaria();
		//Limpiar cajas de texto ocultas
		$('#frmEntradasMaquinariaTraspasoMaquinaria').find('input[type=hidden]').val('');
		//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
		$.removerClasesEncabezado('divEncabezadoModal_entradas_maquinaria_traspaso_maquinaria');
		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		inicializar_detalles_entradas_maquinaria_traspaso_maquinaria();	
		//Habilitar todos los elementos del formulario
	    $('#frmEntradasMaquinariaTraspasoMaquinaria').find('input, textarea, select').attr('disabled', false);
		//Asignar la fecha actual
		$('#txtFecha_entradas_maquinaria_traspaso_maquinaria').val(fechaActual()); 
	    
		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo')
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_entradas_maquinaria_traspaso_maquinaria').addClass("estatus-NUEVO");
		}
	    
	    //Inicializar objeto que se utiliza para guardar los datos del movimiento
	    nuevo_objeto_entrada();

	    //Deshabilitar las siguientes cajas de texto
	    $('#txtSucursalSalida_entradas_maquinaria_traspaso_maquinaria').attr("disabled", "disabled");
	    $('#txtChofer_entradas_maquinaria_traspaso_maquinaria').attr("disabled", "disabled");
	    $('#txtVehiculo_entradas_maquinaria_traspaso_maquinaria').attr("disabled", "disabled");
	    

		//Mostrar botón Guardar
		$("#btnGuardar_entradas_maquinaria_traspaso_maquinaria").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_entradas_maquinaria_traspaso_maquinaria").hide();
		$("#btnDescargarArchivo_entradas_maquinaria_traspaso_maquinaria").hide();
		$("#btnDesactivar_entradas_maquinaria_traspaso_maquinaria").hide();
		$("#btnRestaurar_entradas_maquinaria_traspaso_maquinaria").hide();
		
	}

	//Función para inicializar elementos de la salida de maquinaria por traspaso
	function inicializar_salida_entradas_maquinaria_traspaso_maquinaria()
	{
		//Limpiar contenido de las siguientes cajas de texto
		$('#txtSucursalSalidaID_entradas_maquinaria_traspaso_maquinaria').val('');
	    $('#txtSucursalSalida_entradas_maquinaria_traspaso_maquinaria').val('');
	    $('#txtChofer_entradas_maquinaria_traspaso_maquinaria').val('');
	    $('#txtVehiculo_entradas_maquinaria_traspaso_maquinaria').val('');
	    //Hacer un llamado a la función para inicializar elementos de la tabla detalles
	    inicializar_detalles_entradas_maquinaria_traspaso_maquinaria();
	}

	//Función para crear un nuevo objeto de tipo Entrada por traspaso
	function nuevo_objeto_entrada(){
		// Crear un Objeto de tipo Entrada por traspaso
		objEntrada = new Entrada(null, null, '', '', '', '', null, null, null, []);
	}
	
	//Función para inicializar elementos de la tabla detalles
	function inicializar_detalles_entradas_maquinaria_traspaso_maquinaria()
	{
		//Eliminar los datos de la tabla detalles del movimiento
		$('#dg_detalles_entradas_maquinaria_traspaso_maquinaria tbody').empty();
		$('#numElementos_detalles_entradas_maquinaria_traspaso_maquinaria').html(0);
		$('#txtNumDetalles_entradas_maquinaria_traspaso_maquinaria').html('');
	}
	
	
	//Función que se utiliza para cerrar el modal
	function cerrar_entradas_maquinaria_traspaso_maquinaria()
	{
		try {

			//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       	ocultar_circulo_carga_entradas_maquinaria_traspaso_maquinaria('');
	       	//Cerrar modal Aditamentos
	       	cerrar_aditamentos_entradas_maquinaria_traspaso_maquinaria();
			//Cerrar modal
			objEntradasMaquinariaTraspasoMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_entradas_maquinaria_traspaso_maquinaria').focus();	
		}
		catch(err) {}
	}

	
	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_entradas_maquinaria_traspaso_maquinaria()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_entradas_maquinaria_traspaso_maquinaria();
		//Validación del formulario de campos obligatorios
		$('#frmEntradasMaquinariaTraspasoMaquinaria')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_entradas_maquinaria_traspaso_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intNumDetalles_entradas_maquinaria_traspaso_maquinaria: {
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
										},
										strChofer_entradas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strVehiculo_entradas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strObservaciones_entradas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										}

									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_entradas_maquinaria_traspaso_maquinaria = $('#frmEntradasMaquinariaTraspasoMaquinaria').data('bootstrapValidator');
		bootstrapValidator_entradas_maquinaria_traspaso_maquinaria.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_entradas_maquinaria_traspaso_maquinaria.isValid())
		{	
			//Hacer un llamado a la función para guardar los datos del registro
			guardar_entradas_maquinaria_traspaso_maquinaria();				
		}
		else 
			return;
	}

	
	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_entradas_maquinaria_traspaso_maquinaria()
	{
		try
		{
			$('#frmEntradasMaquinariaTraspasoMaquinaria').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	
	//Función para guardar o modificar los datos de un registro
	function guardar_entradas_maquinaria_traspaso_maquinaria()
	{		
		//Convenrtir al formato JSON todo lo generado en el objeto de la vista
		objEntrada.setTipoMovimiento( intMovimientoIDEntradaMaquinariaTraspasoMaquinaria );            	
        objEntrada.setFecha( $.formatFechaMysql( $('#txtFecha_entradas_maquinaria_traspaso_maquinaria').val() ) );
		objEntrada.setObservaciones( $('#txtObservaciones_entradas_maquinaria_traspaso_maquinaria').val() );
		var jsonEntrada = JSON.stringify(objEntrada); 

		//Hacer un llamado al método del controlador para guardar los datos del registro	
		$.post('maquinaria/entradas_maquinaria_traspaso/guardar',
				{ 
					//Datos de la entrada por compra
					strFolio: $('#txtReferencia_entradas_maquinaria_traspaso_maquinaria').val(),
					entradaTraspaso: jsonEntrada
				},
				function(data) {

					if (data.resultado)
					{	    
	                    //Si no existe id del movimiento, significa que es un nuevo registro   
						if($('#txtMovimientoMaquinariaID_entradas_maquinaria_traspaso_maquinaria').val() == '')
						{
						  	//Asignar el id del movimiento registrado en la base de datos
                 			$('#txtMovimientoMaquinariaID_entradas_maquinaria_traspaso_maquinaria').val(data.movimiento_maquinaria_id);
                 			
						} 

		               
	                    //Hacer llamado a la función  para cargar  los registros en el grid
		               	paginacion_entradas_maquinaria_traspaso_maquinaria();     

		               	//Hacer un llamado a la función para generar póliza con los datos del registro
						generar_poliza_entradas_maquinaria_traspaso_maquinaria('', '');       	    
					}

					//Si existe mensaje de error
					if(data.tipo_mensaje == 'error')
					{
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_entradas_maquinaria_traspaso_maquinaria(data.tipo_mensaje, data.mensaje);
					}

				},
		'json');	
		
	}

	// Función para cambiar el estatus del registro seleccionado
	function cambiar_estatus_entradas_maquinaria_traspaso_maquinaria(id, polizaID, folioPoliza)
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
			intID = $('#txtMovimientoMaquinariaID_entradas_maquinaria_traspaso_maquinaria').val();
			intPolizaID = $('#txtPolizaID_entradas_maquinaria_traspaso_maquinaria').val();
			strFolioPoliza = $('#txtFolioPoliza_entradas_maquinaria_traspaso_maquinaria').val();

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
				              'title':     'Entradas por Traspaso',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('maquinaria/entradas_maquinaria_traspaso/set_estatus',
				                                     {
				                                     	intMovimientoMaquinariaID: intID,
				                                      	 intPolizaID: intPolizaID
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                          	//Hacer llamado a la función  para cargar  los registros en el grid
				                                          	paginacion_entradas_maquinaria_traspaso_maquinaria();
				                                          	//Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_entradas_maquinaria_traspaso_maquinaria();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_entradas_maquinaria_traspaso_maquinaria(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
	    
	}

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_entradas_maquinaria_traspaso_maquinaria(id, tipoAccion)
	{	
		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.post('maquinaria/entradas_maquinaria_traspaso/get_datos',
		       {
		       		intMovimientoMaquinariaID:id
		       },
		       function(data) {
		        	//Si hay datos del registro 
		            if(data.row)
		            {  
		            	//Hacer un llamado a la función para limpiar los campos del formulario
						nuevo_entradas_maquinaria_traspaso_maquinaria();
						//Asignar estatus del registro
				        var strEstatus = data.row.estatus;
				        //Asignar el id de la póliza
				        var intPolizaID = parseInt(data.row.poliza_id); 
			          	
			          	//Recuperar valores para la Vista
			            $('#txtMovimientoMaquinariaID_entradas_maquinaria_traspaso_maquinaria').val(data.row.movimiento_maquinaria_id);
			            $('#txtFecha_entradas_maquinaria_traspaso_maquinaria').val(data.row.fecha);
			            $('#txtReferenciaID_entradas_maquinaria_traspaso_maquinaria').val(data.row.referencia_id);
			            $('#txtReferencia_entradas_maquinaria_traspaso_maquinaria').val(data.row.folio);

			            $('#txtSucursalSalidaID_entradas_maquinaria_traspaso_maquinaria').val(data.row.sucursalSalidaID);
			            $('#txtSucursalSalida_entradas_maquinaria_traspaso_maquinaria').val(data.row.sucursalSalida);
			            
						$('#txtChofer_entradas_maquinaria_traspaso_maquinaria').val(data.row.chofer);
						$('#txtVehiculo_entradas_maquinaria_traspaso_maquinaria').val(data.row.vehiculo);
						$('#txtObservaciones_entradas_maquinaria_traspaso_maquinaria').val(data.row.observaciones);
						$('#txtPolizaID_entradas_maquinaria_traspaso_maquinaria').val(intPolizaID);
						$('#txtFolioPoliza_entradas_maquinaria_traspaso_maquinaria').val(data.row.folio_poliza);

						//Asignar valores al objeto que maneja los valores de la Vista
						objEntrada.setID(data.row.movimiento_maquinaria_id);
						objEntrada.setFolio(data.row.folio);
						objEntrada.setReferenciaID(data.row.referencia_id);
						objEntrada.setChoferID(data.row.chofer_id);
						objEntrada.setVehiculoID(data.row.vehiculo_id);
						objEntrada.setSucursalSalidaID(data.row.sucursalSalidaID);			            

			           	//Mostramos los detalles del registro
			           	for (var intCon in data.detalles) 
			            {	
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_entradas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];
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
							//Columnas ocultas
							var objCeldaCodigoInterno = objRenglon.insertCell(9);
							var objCeldaCosto = objRenglon.insertCell(10);

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
							objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Aditamentos'" +
														 " onclick='ver_aditamentos_renglon_detalles_entradas_maquinaria_traspaso_maquinaria(this)'>" +
														 "<span class='glyphicon glyphicon-cog'></span></button>";
							objCeldaDescripcion.setAttribute('class', 'no-mostrar');
							objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
							objCeldaPedimento.setAttribute('class', 'no-mostrar');
							objCeldaPedimento.innerHTML = data.detalles[intCon].numero_pedimento;
							objCeldaConsignacion.setAttribute('class', 'no-mostrar');
							objCeldaConsignacion.innerHTML = data.detalles[intCon].consignacion;
							objCeldaMaquinariaID.setAttribute('class', 'no-mostrar');
							objCeldaMaquinariaID.innerHTML = data.detalles[intCon].maquinaria_descripcion_id;
							objCeldaCodigoInterno.setAttribute('class', 'no-mostrar');
							objCeldaCodigoInterno.innerHTML = data.detalles[intCon].codigo_interno;
							objCeldaCosto.setAttribute('class', 'no-mostrar');
							objCeldaCosto.innerHTML = data.detalles[intCon].costo;

							//Creamos objetos de tipo Maquinaria para cada elemento en la vista
							objMaquinaria = new Maquinaria(data.detalles[intCon].movimiento_maquinaria_id, 
														  parseInt(data.detalles[intCon].renglon) - 1, 
														  data.detalles[intCon].maquinaria_descripcion_id, 
														  data.detalles[intCon].codigo, 
														  data.detalles[intCon].descripcion_corta, 
														  data.detalles[intCon].descripcion, 
														  data.detalles[intCon].serie, 
														  data.detalles[intCon].motor, 
														  data.detalles[intCon].numero_pedimento, 
														  data.detalles[intCon].consignacion,
														  data.detalles[intCon].codigo_interno, 
														  data.detalles[intCon].costo
														  );

							//Agregar cada objeto de tipo Maquinaria al objeto Entrada
							objEntrada.setMaquinaria(objMaquinaria);
							
			            }

						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_entradas_maquinaria_traspaso_maquinaria tr").length - 1;
						$('#numElementos_detalles_entradas_maquinaria_traspaso_maquinaria').html(intFilas);
						$('#txtNumDetalles_entradas_maquinaria_traspaso_maquinaria').val(intFilas);
						
						
						//Dependiendo del estatus cambiar el color del encabezado 
			            $('#divEncabezadoModal_entradas_maquinaria_traspaso_maquinaria').addClass("estatus-"+ strEstatus);
			            //Mostrar botón Imprimir  
			            $("#btnImprimirRegistro_entradas_maquinaria_traspaso_maquinaria").show();
   						
			            //Deshabilitar todos los elementos del formulario
		            	$('#frmEntradasMaquinariaTraspasoMaquinaria').find('input, textarea, select').attr('disabled','disabled');
		            	//Ocultar los siguientes botones
			            $("#btnGuardar_entradas_maquinaria_traspaso_maquinaria").hide();


   						//Si existe el id de la póliza
			            if(strEstatus == 'ACTIVO' && intPolizaID > 0)
			            {
			            	//Mostrar el botón Desactivar
			            	$("#btnDesactivar_entradas_maquinaria_traspaso_maquinaria").show();
			            }

		            	//Abrir modal
			            objEntradasMaquinariaTraspasoMaquinaria = $('#EntradasMaquinariaTraspasoMaquinariaBox').bPopup({
										   appendTo: '#EntradasMaquinariaTraspasoMaquinariaContent', 
			                               contentContainer: 'EntradasMaquinariaTraspasoMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});

			            //Enfocar caja de texto
						$('#txtReferencia_entradas_maquinaria_traspaso_maquinaria').focus();

		       	    }
		       	    
		       },
		       'json');

	}
	
	//Función para regresar y obtener los datos de un traspaso (salida de maquinaria)
	function get_datos_salida_entradas_maquinaria_traspaso_maquinaria()
	{	
		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		inicializar_detalles_entradas_maquinaria_traspaso_maquinaria();

	 //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
      $.post('maquinaria/salidas_maquinaria_traspaso/get_datos',
          { 
          	intMovimientoMaquinariaID: $("#txtReferenciaID_entradas_maquinaria_traspaso_maquinaria").val()
          },
          function(data) {

            if(data.row){

            	//Objeto encapsulado
            	objEntrada.setReferenciaID(data.row.movimiento_maquinaria_id);
            	objEntrada.setChoferID(data.row.chofer_id);
            	objEntrada.setVehiculoID(data.row.vehiculo_id);
            	objEntrada.setSucursalSalidaID(data.row.sucursalSalidaID);
				//Agregar maquinarias del GRID
				//Limpiamos todo el array de maquinarias para insertar de nuevo los elementos
				objEntrada.arrMaquinarias = [];

				//Obtenemos el objeto de la tabla detalles
				var objTabla = document.getElementById('dg_detalles_entradas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];

            	$('#txtReferencia_entradas_maquinaria_traspaso_maquinaria').val(data.row.folio);
            	$('#txtFecha_entradas_maquinaria_traspaso_maquinaria').val(data.row.fecha);
            	$('#txtSucursalSalida_entradas_maquinaria_traspaso_maquinaria').val(data.row.sucursalSalida);
            	$('#txtSucursalSalidaID_entradas_maquinaria_traspaso_maquinaria').val(data.row.sucursalSalidaID);
            	$('#txtChofer_entradas_maquinaria_traspaso_maquinaria').val(data.row.chofer);
            	$('#txtVehiculo_entradas_maquinaria_traspaso_maquinaria').val(data.row.vehiculo);
            	//Cargar detalles
            	//Si se econtró información
                if(data.detalles){

                	$('#dg_detalles_entradas_maquinaria_traspaso_maquinaria tbody').empty();

                	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_detalles_entradas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];
                	for (var intCon in data.detalles) 
			        {
						//Insertamos el renglón con sus celdas en el objeto de la tabla
						var objRenglon = objTabla.insertRow();
						var objCeldaSerie = objRenglon.insertCell(0);
						var objCeldaMotor = objRenglon.insertCell(1);
						var objCeldaCodigo = objRenglon.insertCell(2);
						var objCeldaDescripcionCorta = objRenglon.insertCell(3);
						var objCeldaAcciones = objRenglon.insertCell(4);
						//Columnas ocultas
						var objCeldaCodigoInterno = objRenglon.insertCell(5);
						var objCeldaCosto = objRenglon.insertCell(6);

						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', data.detalles[intCon].serie); 
						objCeldaSerie.setAttribute('class', 'movil b1');
						objCeldaSerie.innerHTML = data.detalles[intCon].serie;
						objCeldaMotor.setAttribute('class', 'movil b2');
						objCeldaMotor.innerHTML = data.detalles[intCon].motor;
						objCeldaCodigo.setAttribute('class', 'movil b3');
						objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
						objCeldaDescripcionCorta.setAttribute('class', 'movil b4');
						objCeldaDescripcionCorta.innerHTML = data.detalles[intCon].descripcion_corta;
						objCeldaAcciones.setAttribute('class', 'td-center movil b5');
						objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Ver Aditamentos'" +
													 " onclick='ver_aditamentos_renglon_detalles_entradas_maquinaria_traspaso_maquinaria(this)'>" +
													 "<span class='glyphicon glyphicon-cog'></span></button>" 
													 ; 
						objCeldaCodigoInterno.setAttribute('class', 'no-mostrar');
						objCeldaCodigoInterno.innerHTML = data.detalles[intCon].codigo_interno;
						objCeldaCosto.setAttribute('class', 'no-mostrar');
						objCeldaCosto.innerHTML = data.detalles[intCon].costo;

						//Inserta en la vista el objeto objSalida<-objMaquinaria
						//Variable para crea el ojeto Maquinaria
			        	var objMaquinaria = new Maquinaria(null, 
			        										intCon, 
			        										data.detalles[intCon].maquinaria_descripcion_id, 
			        										data.detalles[intCon].codigo, 
			        										data.detalles[intCon].descripcion_corta, 
			        										data.detalles[intCon].descripcion, 
			        										data.detalles[intCon].serie, 
			        										data.detalles[intCon].motor,
			        										data.detalles[intCon].numero_pedimento,
			        										data.detalles[intCon].consignacion,
			        										data.detalles[intCon].codigo_interno,
			        										data.detalles[intCon].costo
			        										);
			        	objEntrada.setMaquinaria(objMaquinaria);


			        }

			        var intFilas = $("#dg_detalles_entradas_maquinaria_traspaso_maquinaria tr").length - 1;
					$('#numElementos_detalles_entradas_maquinaria_traspaso_maquinaria').html(intFilas);
					$('#txtNumDetalles_entradas_maquinaria_traspaso_maquinaria').val(intFilas);

                }

            }

        }
         ,
        'json');
	}


		//Función para generar póliza con los datos de un registro
		function generar_poliza_entradas_maquinaria_traspaso_maquinaria(id, formulario)
		{	

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoMaquinariaID_entradas_maquinaria_traspaso_maquinaria').val();
			}
			else
			{
				intID = id;
				strTipo = 'gridview';
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_entradas_maquinaria_traspaso_maquinaria(formulario);
			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaEntradaMaquinariaTraspasoMaquinaria, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_entradas_maquinaria_traspaso_maquinaria').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_entradas_maquinaria_traspaso_maquinaria(formulario);
			    
			    //Si existe resultado
				if (data.resultado)
				{
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_entradas_maquinaria_traspaso_maquinaria();

					//Si el id del registro se obtuvo del modal
					if(strTipo == 'modal')
					{
						//Hacer un llamado a la función para cerrar modal
			            cerrar_entradas_maquinaria_traspaso_maquinaria();
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
			            								cerrar_entradas_maquinaria_traspaso_maquinaria();
	                                                 }
	                                                }]
	                                  });
				}
				else
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    	mensaje_entradas_maquinaria_traspaso_maquinaria(data.tipo_mensaje, data.mensaje);
				}
				
		     },
		     'json');

		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function mostrar_circulo_carga_entradas_maquinaria_traspaso_maquinaria(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_entradas_maquinaria_traspaso_maquinaria';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_entradas_maquinaria_traspaso_maquinaria';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}


		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function ocultar_circulo_carga_entradas_maquinaria_traspaso_maquinaria(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_entradas_maquinaria_traspaso_maquinaria';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_entradas_maquinaria_traspaso_maquinaria';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}

	//Función para agregar Aditamentos del renglón seleccionado
	function ver_aditamentos_renglon_detalles_entradas_maquinaria_traspaso_maquinaria(objRenglon){

		//Asignar los valores a las cajas de texto
		$('#txtSerie_detalles_entradas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
		$('#txtMotor_detalles_entradas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
		$('#txtCodigo_detalles_entradas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
		$('#txtDescripcionCorta_detalles_entradas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);

		nuevo_aditamentos_entradas_maquinaria_traspaso_maquinaria('grid');

	}


	//Función para mostrar mensaje de éxito o error
	function mensaje_entradas_maquinaria_traspaso_maquinaria(tipoMensaje, mensaje)
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
	function ver_aditamentos_renglon_detalles_entradas_maquinaria_traspaso_maquinaria(objRenglon){

		//Asignar los valores a las cajas de texto
		var serie = objRenglon.parentNode.parentNode.cells[0].innerHTML;
		var motor = objRenglon.parentNode.parentNode.cells[1].innerHTML;
		var codigo = objRenglon.parentNode.parentNode.cells[2].innerHTML;
		var descripcionCorta = objRenglon.parentNode.parentNode.cells[3].innerHTML;

		nuevo_aditamentos_entradas_maquinaria_traspaso_maquinaria(serie, motor, codigo, descripcionCorta);

	}


	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_entradas_maquinaria_traspaso_maquinaria(strTipo) 
	{

		//Variable que se utiliza para asignar URL (ruta del controlador)
		var strUrl = 'maquinaria/entradas_maquinaria_traspaso/';

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
		if ($('#chbImprimirDetalles_entradas_maquinaria_traspaso_maquinaria').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_entradas_maquinaria_traspaso_maquinaria').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_entradas_maquinaria_traspaso_maquinaria').val('NO');
		}


		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url': strUrl,
						'data' : {
									'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_entradas_maquinaria_traspaso_maquinaria').val()),
									'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_entradas_maquinaria_traspaso_maquinaria').val()),
									'intSucursalSalidaID': $('#txtSucursalSalidaIDBusq_entradas_maquinaria_traspaso_maquinaria').val(),
									'strEstatus': $('#cmbEstatusBusq_entradas_maquinaria_traspaso_maquinaria').val(), 
									'strBusqueda': $('#txtBusqueda_entradas_maquinaria_traspaso_maquinaria').val(),
									'strDetalles': $('#chbImprimirDetalles_entradas_maquinaria_traspaso_maquinaria').val()				
								 }
					   };


		//Hacer un llamado a la función para imprimir/descargar el reporte
		$.imprimirReporte(objReporte);
		
	}
	
	//Función para cargar el reporte de un registro en PDF
	function reporte_registro_entradas_maquinaria_traspaso_maquinaria(id) 
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la impresión desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_entradas_maquinaria_traspaso_maquinaria').val();
		}
		else
		{
			intID = id;
		}


		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url': 'maquinaria/entradas_maquinaria_traspaso/get_reporte_registro',
						'data' : {
									'intMovimientoMaquinariaID': intID
								 }
					   };

		//Hacer un llamado a la función para imprimir el reporte
		$.imprimirReporte(objReporte);

	}





	/*******************************************************************************************************************
	Funciones del modal secundario
	*********************************************************************************************************************/
	//Agregar aditamentos a una maquinaria
	function nuevo_aditamentos_entradas_maquinaria_traspaso_maquinaria(serie, motor, codigo, descripcionCorta){

		inicializar_aditamentos_detalles_entradas_maquinaria_traspaso_maquinaria();

		//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
		$('#divEncabezadoModalSecundario_entradas_maquinaria_traspaso_maquinaria').addClass("estatus-NUEVO");
		//Abrir modal secundario
		 objAditamentosEntradasMaquinariaTraspasoMaquinaria = $('#AditamentosEntradasMaquinariaTraspasoMaquinariaBox').bPopup({
									   appendTo: '#EntradasMaquinariaTraspasoMaquinariaContent', 
		                               contentContainer: 'AditamentosEntradasMaquinariaTraspasoMaquinariaM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});
		
		//Asignar los valores que vienen del modal primario
		$('#txtCodigoAditamentos_entradas_maquinaria_traspaso_maquinaria').val( codigo ); 
		$('#txtDescripcionAditamentos_entradas_maquinaria_traspaso_maquinaria').val( descripcionCorta );
		$('#txtSerieAditamentos_entradas_maquinaria_traspaso_maquinaria').val( serie );
		$('#txtMotorAditamentos_entradas_maquinaria_traspaso_maquinaria').val( motor );

		//Consultar si la serie contiene aditamentos 
		//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
          $.post('maquinaria/salidas_maquinaria_traspaso/get_aditamentos',
              { 
              	strSerie: $("#txtSerieAditamentos_entradas_maquinaria_traspaso_maquinaria").val()
              },
              function(data) {
              	//Si se econtró información
                if(data){

                	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_aditamentos_detalles_entradas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];

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

			        var intFilas = $("#dg_aditamentos_detalles_entradas_maquinaria_traspaso_maquinaria tr").length - 1;
					$('#numElementos_detalles_aditamentos_entradas_maquinaria_traspaso_maquinaria').html(intFilas);
                }
            }
             ,
            'json');


	}

	//Función que se utiliza para cerrar el modal secundario
	function cerrar_aditamentos_entradas_maquinaria_traspaso_maquinaria()
	{
		try {
			//Cerrar modal
			objAditamentosEntradasMaquinariaTraspasoMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtCodigo_detalles_entradas_maquinaria_traspaso_maquinaria').focus();	
		}
		catch(err) {}
	}

	//Función para inicializar elementos de la tabla detalles
	function inicializar_aditamentos_detalles_entradas_maquinaria_traspaso_maquinaria()
	{
		//Eliminar los datos de la tabla
		$('#dg_aditamentos_detalles_entradas_maquinaria_traspaso_maquinaria tbody').empty();
		$('#numElementos_detalles_aditamentos_entradas_maquinaria_traspaso_maquinaria').html(0);
	}


	//Al inicializar el componente
	$(document).ready(function() 
	{

		/********************************************************************************************************************
		Controles correspondientes al MODAL SECUNDARIO
		*********************************************************************************************************************/
		

        /*******************************************************************************************************************
		Controles correspondientes al MODAL
		*********************************************************************************************************************/
        //Agregar datepicker para seleccionar fecha
		$('#dteFecha_entradas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});

        //Autocomplete para recuperar los datos de una salida de maquinaria por traspaso
        $('#txtReferencia_entradas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtReferenciaID_entradas_maquinaria_traspaso_maquinaria').val('');
               //Hacer un llamado a la función para inicializar elementos de la salida de maquinaria por traspaso
               inicializar_salida_entradas_maquinaria_traspaso_maquinaria();
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "maquinaria/salidas_maquinaria_traspaso/autocomplete",
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
           	  $('#txtReferenciaID_entradas_maquinaria_traspaso_maquinaria').val(ui.item.movimiento_maquinaria_id);

           	  //Hacer un llamado a la función para regresar los datos del traspaso (salida de maquinaria)
           	  get_datos_salida_entradas_maquinaria_traspaso_maquinaria();
             
             
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });


        //Verificar que exista id de la entrada cuando pierda el enfoque la caja de texto
        $('#txtReferencia_entradas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id de la salida de maquinaria
            if($('#txtReferenciaID_entradas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtReferencia_entradas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtReferenciaID_entradas_maquinaria_traspaso_maquinaria').val('');
               $('#txtReferencia_entradas_maquinaria_traspaso_maquinaria').val('');

               //Hacer un llamado a la función para inicializar elementos de la salida de maquinaria por traspaso
               inicializar_salida_entradas_maquinaria_traspaso_maquinaria();
            }

        });

	    //Abrir modal cuando se de clic en el botón
		$('#btnAditamentos_entradas_maquinaria_traspaso_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			if($('#txtSerie_detalles_entradas_maquinaria_traspaso_maquinaria').val() != ''){
				nuevo_aditamentos_entradas_maquinaria_traspaso_maquinaria('');
			}
				
		});

		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_entradas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_entradas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_entradas_maquinaria_traspaso_maquinaria').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_entradas_maquinaria_traspaso_maquinaria').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_entradas_maquinaria_traspaso_maquinaria').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_entradas_maquinaria_traspaso_maquinaria').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_entradas_maquinaria_traspaso_maquinaria').on('click','a',function(event){
			event.preventDefault();
			intPaginaEntradasMaquinariaTraspasoMaquinaria = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_entradas_maquinaria_traspaso_maquinaria();
		});

		//Autocomplete para recuperar los datos de una sucursal (sin incluir la sucursal que se encuentra logeada en el sistema)
        $('#txtSucursalSalidaBusq_entradas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtSucursalSalidaIDBusq_entradas_maquinaria_traspaso_maquinaria').val('');
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
             $('#txtSucursalSalidaIDBusq_entradas_maquinaria_traspaso_maquinaria').val(ui.item.data);
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
        $('#txtSucursalSalidaBusq_entradas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id del proveedor
            if($('#txtSucursalSalidaIDBusq_entradas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtSucursalSalidaBusq_entradas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtSucursalSalidaIDBusq_entradas_maquinaria_traspaso_maquinaria').val('');
               $('#txtSucursalSalidaBusq_entradas_maquinaria_traspaso_maquinaria').val('');
            }
        });

        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_entradas_maquinaria_traspaso_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_entradas_maquinaria_traspaso_maquinaria('Nuevo');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_entradas_maquinaria_traspaso_maquinaria').addClass("estatus-NUEVO");
			//Abrir modal
			 objEntradasMaquinariaTraspasoMaquinaria = $('#EntradasMaquinariaTraspasoMaquinariaBox').bPopup({
										   appendTo: '#EntradasMaquinariaTraspasoMaquinariaContent', 
			                               contentContainer: 'EntradasMaquinariaTraspasoMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});		

			 //Enfocar caja de texto
		     $('#txtReferencia_entradas_maquinaria_traspaso_maquinaria').focus();
		});

        //Enfocar caja de texto
        $('#txtFechaInicialBusq_entradas_maquinaria_traspaso_maquinaria').focus();
  
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_entradas_maquinaria_traspaso_maquinaria();

	});

</script>