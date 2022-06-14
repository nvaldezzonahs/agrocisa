<div id="MovimientosEntradasMaquinariaTraspasoMaquinariaContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_movimientos_entradas_maquinaria_traspaso_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_movimientos_entradas_maquinaria_traspaso_maquinaria">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_movimientos_entradas_maquinaria_traspaso_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_movimientos_entradas_maquinaria_traspaso_maquinaria"
			                    		name= "strFechaInicialBusq_movimientos_entradas_maquinaria_traspaso_maquinaria" 
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
							<label for="txtFechaFinalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria"
			                    		name= "strFechaFinalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria" 
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
				<!--Sucursal-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtSucursalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria">Sucursal</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtSucursalIDBusq_movimientos_entradas_maquinaria_traspaso_maquinaria" 
									name="strSucursalIDBusq_movimientos_entradas_maquinaria_traspaso_maquinaria" 
									type="hidden" />
							<input  class="form-control" 
									id="txtSucursalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria" 
									name="strSucursalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese sucursal" />
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="cmbEstatusBusq_movimientos_entradas_maquinaria_traspaso_maquinaria">Estatus</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="cmbEstatusBusq_movimientos_entradas_maquinaria_traspaso_maquinaria" 
							 		name="strEstatusBusq_movimientos_entradas_maquinaria_traspaso_maquinaria" tabindex="1">
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
							<label for="txtBusqueda_movimientos_entradas_maquinaria_traspaso_maquinaria">Descripción</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtBusqueda_movimientos_entradas_maquinaria_traspaso_maquinaria" 
									name="strBusqueda_movimientos_entradas_maquinaria_traspaso_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Mostrar detalles de los registros en el reporte PDF--> 
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
					<div class="checkbox">
                    	<label id="label-checkbox">
                        	<input class="form-control" 
                        			id="chbImprimirDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria" 
								   	name="strImprimirDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria" 
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
						<button class="btn btn-primary" id="btnBuscar_movimientos_entradas_maquinaria_traspaso_maquinaria"
								onclick="paginacion_movimientos_entradas_maquinaria_traspaso_maquinaria();" 
								title="Buscar coincidencias" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<!--Dar de alta un nuevo registro-->
						<button class="btn btn-info" id="btnNuevo_movimientos_entradas_maquinaria_traspaso_maquinaria" 
								title="Nuevo registro" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>   
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_movimientos_entradas_maquinaria_traspaso_maquinaria"
								onclick="reporte_movimientos_entradas_maquinaria_traspaso_maquinaria();" title="Generar reporte PDF" tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_movimientos_entradas_maquinaria_traspaso_maquinaria"
								onclick="descargar_xls_movimientos_entradas_maquinaria_traspaso_maquinaria();" title="Descargar archivo XLS" tabindex="1" disabled>
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
			td.movil:nth-of-type(3):before {content: "Sucursal"; font-weight: bold;}
			td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
			td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_movimientos_entradas_maquinaria_traspaso_maquinaria">
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
				<script id="plantilla_movimientos_entradas_maquinaria_traspaso_maquinaria" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil">{{folio}}</td>
						<td class="movil">{{fecha}}</td>
						<td class="movil">{{sucursalSalida}}</td>
						<td class="movil">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_movimientos_entradas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}},'Editar')"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_movimientos_entradas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}},'Ver')"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_movimientos_entradas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_movimientos_entradas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}},'{{estatus}}')" title="Desactivar">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
									onclick="cambiar_estatus_movimientos_entradas_maquinaria_traspaso_maquinaria({{movimiento_maquinaria_id}},'{{estatus}}')"  title="Restaurar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_entradas_maquinaria_traspaso_maquinaria"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_movimientos_entradas_maquinaria_traspaso_maquinaria">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!-- Diseño del modal-->
	<div id="MovimientosEntradasMaquinariaTraspasoMaquinariaBox" class="ModalBody"  tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModal_movimientos_entradas_maquinaria_traspaso_maquinaria"  class="ModalBodyTitle">
		<h1>Entradas por traspaso</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmMovimientosEntradasMaquinariaTraspasoMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmMovimientosEntradasMaquinariaTraspasoMaquinaria"  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!-- Folio -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input id="txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_traspaso_maquinaria" 
									   name="intMovimientoCajaHerramientas_movimientos_entradas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtFolio_movimientos_entradas_maquinaria_traspaso_maquinaria">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
								        id="txtFolio_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										name="strFolio_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="" 
										disabled />
							</div>
						</div>
					</div>
					<!-- Fecha -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFecha_movimientos_entradas_maquinaria_traspaso_maquinaria">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_movimientos_entradas_maquinaria_traspaso_maquinaria'>
				                    <input class="form-control" 
				                    		id="txtFecha_movimientos_entradas_maquinaria_traspaso_maquinaria"
				                    		name= "strFecha_movimientos_entradas_maquinaria_traspaso_maquinaria" 
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
					<!-- Folio de salida -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del movimiento de salida traspaso seleccionada-->
								<input id="txtFolioSalidaID_movimientos_entradas_maquinaria_traspaso_maquinaria" 
									   name="intFolioSalidaID_movimientos_entradas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtFolioSalida_movimientos_entradas_maquinaria_traspaso_maquinaria">Folio de salida</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtFolioSalida_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										name="strFolioSalida_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese folio de salida" 
										maxlength="250" />			
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Sucursal de salida -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar la sucursal_id de la cual proviene la salida por traspaso-->
								<input id="txtSucursalSalidaID_movimientos_entradas_maquinaria_traspaso_maquinaria" 
									   name="intSucursalSalidaID_movimientos_entradas_maquinaria_traspaso_maquinaria" 
									   type="hidden" 
									   value="" />
								<label for="txtSucursalSalida_movimientos_entradas_maquinaria_traspaso_maquinaria">Sucursal de salida</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSucursalSalida_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										name="strSucursalSalida_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese sucursal" 
										maxlength="250" disabled />			
							</div>
						</div>
					</div>
					<!-- Observaciones -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtObservaciones_movimientos_entradas_maquinaria_traspaso_maquinaria">Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										name="strObservaciones_movimientos_entradas_maquinaria_traspaso_maquinaria" 
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
					<!-- Chofer -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtChofer_movimientos_entradas_maquinaria_traspaso_maquinaria">Chofer</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtChofer_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										name="strChofer_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese chofer" 
										maxlength="100" disabled />			
							</div>
						</div>
					</div>
					<!-- Vehículo -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtVehiculo_movimientos_entradas_maquinaria_traspaso_maquinaria">Vehículo</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtVehiculo_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										name="strVehiculo_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese vehículo" 
										maxlength="100" disabled />			
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
								<input id="txtNumDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria" 
							   		name="intNumDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria" type="hidden" value="">
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
													<table class="table-hover movil" id="dg_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria">
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
																<strong id="numElementos_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria">0</strong> encontrados
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
								id="btnReset_movimientos_entradas_maquinaria_traspaso_maquinaria"  
								onclick="nuevo_movimientos_entradas_maquinaria_traspaso_maquinaria('Nuevo');"  
								title="Nuevo registro" 
								tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" 
								id="btnGuardar_movimientos_entradas_maquinaria_traspaso_maquinaria"  
								onclick="validar_movimientos_entradas_maquinaria_traspaso_maquinaria();"  
								title="Guardar" 
								tabindex="2" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_movimientos_entradas_maquinaria_traspaso_maquinaria"  
								onclick="reporte_registro_movimientos_entradas_maquinaria_traspaso_maquinaria('');"  
								title="Imprimir" 
								tabindex="5" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" id="btnDesactivar_movimientos_entradas_maquinaria_traspaso_maquinaria"  
								onclick="cambiar_estatus_movimientos_entradas_maquinaria_traspaso_maquinaria('','ACTIVO');"  title="Desactivar" tabindex="8" disabled>
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Restaurar registro-->
						<button class="btn btn-default" id="btnRestaurar_movimientos_entradas_maquinaria_traspaso_maquinaria"  
								onclick="cambiar_estatus_movimientos_entradas_maquinaria_traspaso_maquinaria('','INACTIVO');"  title="Restaurar" tabindex="9" disabled>
							<span class="fa fa-exchange"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  
								id="btnCerrar_movimientos_entradas_maquinaria_traspaso_maquinaria"
								type="reset" 
								aria-hidden="true" 
								onclick="cerrar_movimientos_entradas_maquinaria_traspaso_maquinaria();" 
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
	<div id="AditamentosMovimientosEntradasMaquinariaTraspasoMaquinariaBox" class="ModalBody" tabindex="-1">
		<!--Título-->
		<div id="divEncabezadoModalSecundario_movimientos_entradas_maquinaria_traspaso_maquinaria" class="ModalBodyTitle">
			<h1>Ver aditamentos</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form id="frmAditamentosMovimientosEntradasMaquinariaTraspasoMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
				  name="frmAditamentosMovimientosEntradasMaquinariaTraspasoMaquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
				  	<!--Código-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el renglón seleccionado -->	
								<label for="txtCodigoAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria">Código</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtCodigoAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										name="strCodigoAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtDescripcionAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtDescripcionAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										name="strDescripcionAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Serie-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtSerieAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria">Serie</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtSerieAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										name="strSerieAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										type="text" 
										disabled />
							</div>
						</div>
					</div>
					<!--Motor-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">	
								<label for="txtMotorAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria">Motor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtMotorAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria" 
										name="strMotorAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria" 
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
									<table class="table-hover" id="dg_aditamentos_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria">
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
												<strong id="numElementos_detalles_aditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria">0</strong> encontrados
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
						<button class="btn  btn-cerrar"  id="btnCerrar_respuestas_movimientos_entradas_maquinaria_traspaso_maquinaria"
								type="reset" aria-hidden="true" onclick="cerrar_aditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria();" title="Cerrar">
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

</div><!--#MovimientosEntradasMaquinariaTraspasoMaquinariaContent -->


<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variable que se utiliza para asignar el id del movimiento de ENTRADA DE MAQUINARIA POR TRASPASO
	var intMovimientoIDEntradaMaquinariaTraspasoMaquinaria = <?php echo ENTRADA_MAQUINARIA_TRASPASO ?>;
	//Variables que se utilizan para la paginación de registros
	var intPaginaMovimientosEntradasMaquinariaTraspasoMaquinaria = 0;
	var strUltimaBusquedaMovimientosEntradasMaquinariaTraspasoMaquinaria = "";
	//Variables que se utilizan para la búsqueda de registros
	var intMecanicoIDMovimientosEntradasMaquinariaTraspasoMaquinaria = "";
	var dteFechaInicialMovimientosEntradasMaquinariaTraspasoMaquinaria = "";
	var dteFechaFinalMovimientosEntradasMaquinariaTraspasoMaquinaria = "";
	//Variable que se utiliza para asignar objeto del modal
	var objMovimientosEntradasMaquinariaTraspasoMaquinaria = null;
	//Variable que se utiliza para asignar objeto del modal secundario
	var objAditamentosMovimientosEntradasMaquinariaTraspasoMaquinaria = null;

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
	function Maquinaria(id, renglon, maquinariaDescripcionID, codigo, descripcionCorta, descripcion, serie, motor, numeroPedimento, consignacion)
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
	function permisos_movimientos_entradas_maquinaria_traspaso_maquinaria()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('maquinaria/movimientos_entradas_maquinaria_traspaso/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_movimientos_entradas_maquinaria_traspaso_maquinaria').val()
		},
		function(data){
			
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria = data.row;
				//Separar la cadena 
				var arrPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria = strPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_movimientos_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria[i]=='GUARDAR') || (arrPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_movimientos_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					//Si el indice es VER REGISTRO
					else if(arrPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria[i]=='VER REGISTRO')
					{
						
					}
					else if(arrPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_movimientos_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_movimientos_entradas_maquinaria_traspaso_maquinaria();
					}
					else if(arrPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_movimientos_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
						$('#btnRestaurar_movimientos_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_movimientos_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_movimientos_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosEntradasMaquinariaTraspasoMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_movimientos_entradas_maquinaria_traspaso_maquinaria').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_movimientos_entradas_maquinaria_traspaso_maquinaria() 
	{
		//Asignar valores para la búsqueda de registros
		var dteFechaInicialMovimientosEntradasMaquinariaTraspasoMaquinaria =  $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val());
		var dteFechaFinalMovimientosEntradasMaquinariaTraspasoMaquinaria =  $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val());
		//Si no existe fecha inicial
		if(dteFechaInicialMovimientosEntradasMaquinariaTraspasoMaquinaria == '')
		{
			dteFechaInicialMovimientosEntradasMaquinariaTraspasoMaquinaria = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalMovimientosEntradasMaquinariaTraspasoMaquinaria == '')
		{
			dteFechaFinalMovimientosEntradasMaquinariaTraspasoMaquinaria =  '0000-00-00';
		}
		//Si no existe id de la sucursal en busqueda
		if( $('#txtSucursalIDBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val() == '' )
		{
			intSucursalIDMovimientosEntradasMaquinariaTraspasoMaquinaria = 0;
		}
		else
		{
			intSucursalIDMovimientosEntradasMaquinariaTraspasoMaquinaria = $('#txtSucursalIDBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val();
		}

		//Concatenar datos para la nueva búsqueda
		var strNuevaBusquedaMovimientosEntradasMaquinariaTraspasoMaquinaria =(dteFechaInicialMovimientosEntradasMaquinariaTraspasoMaquinaria+dteFechaFinalMovimientosEntradasMaquinariaTraspasoMaquinaria+intSucursalIDMovimientosEntradasMaquinariaTraspasoMaquinaria+$('#cmbEstatusBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val()+$('#txtBusqueda_movimientos_entradas_maquinaria_traspaso_maquinaria').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaMovimientosEntradasMaquinariaTraspasoMaquinaria != strUltimaBusquedaMovimientosEntradasMaquinariaTraspasoMaquinaria)
			{
				intPaginaMovimientosEntradasMaquinariaTraspasoMaquinaria = 0;
				strUltimaBusquedaMovimientosEntradasMaquinariaTraspasoMaquinaria = strNuevaBusquedaMovimientosEntradasMaquinariaTraspasoMaquinaria;
			}
		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaMovimientosEntradasMaquinariaTraspasoMaquinaria != strUltimaBusquedaMovimientosEntradasMaquinariaTraspasoMaquinaria)
		{
			intPaginaMovimientosEntradasMaquinariaTraspasoMaquinaria = 0;
			strUltimaBusquedaMovimientosEntradasMaquinariaTraspasoMaquinaria = strNuevaBusquedaMovimientosEntradasMaquinariaTraspasoMaquinaria;
		}
	

		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('maquinaria/movimientos_entradas_maquinaria_traspaso/get_paginacion',
				{	
					dteFechaInicial: dteFechaInicialMovimientosEntradasMaquinariaTraspasoMaquinaria,
	    			dteFechaFinal: dteFechaFinalMovimientosEntradasMaquinariaTraspasoMaquinaria,
	    			intSucursalID: intSucursalIDMovimientosEntradasMaquinariaTraspasoMaquinaria,
	    			strEstatus: $('#cmbEstatusBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val(),
	    			strBusqueda: $('#txtBusqueda_movimientos_entradas_maquinaria_traspaso_maquinaria').val(),
					intPagina:intPaginaMovimientosEntradasMaquinariaTraspasoMaquinaria,
					strPermisosAcceso: $('#txtAcciones_movimientos_entradas_maquinaria_traspaso_maquinaria').val()
				},
				function(data){
					$('#dg_movimientos_entradas_maquinaria_traspaso_maquinaria tbody').empty();
					var tmpMovimientosEntradasMaquinariaTraspasoMaquinaria = Mustache.render($('#plantilla_movimientos_entradas_maquinaria_traspaso_maquinaria').html(),data);
					$('#dg_movimientos_entradas_maquinaria_traspaso_maquinaria tbody').html(tmpMovimientosEntradasMaquinariaTraspasoMaquinaria);
					$('#pagLinks_movimientos_entradas_maquinaria_traspaso_maquinaria').html(data.paginacion);
					$('#numElementos_movimientos_entradas_maquinaria_traspaso_maquinaria').html(data.total_rows);
					intPaginaMovimientosEntradasMaquinariaTraspasoMaquinaria = data.pagina;
				},
		'json');
	}

	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_movimientos_entradas_maquinaria_traspaso_maquinaria(tipoAccion)
	{	
		//Incializar formulario
		$('#frmMovimientosEntradasMaquinariaTraspasoMaquinaria')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_movimientos_entradas_maquinaria_traspaso_maquinaria();
		//Limpiar cajas de texto ocultas
		$('#frmMovimientosEntradasMaquinariaTraspasoMaquinaria').find('input[type=hidden]').val('');
		//Habilitar todos los elementos del formulario
	    //$('#frmMovimientosEntradasMaquinariaTraspasoMaquinaria').find('input, textarea, select').attr('disabled', false);
		//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		inicializar_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria();	

		//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
		$('#divEncabezadoModal_movimientos_entradas_maquinaria_traspaso_maquinaria').removeClass("estatus-NUEVO");
		$('#divEncabezadoModal_movimientos_entradas_maquinaria_traspaso_maquinaria').removeClass("estatus-ACTIVO");
		$('#divEncabezadoModal_movimientos_entradas_maquinaria_traspaso_maquinaria').removeClass("estatus-INACTIVO");
			
		/******************************************************************
		* INICIALIZACIÓN DE ELEMENTOS - ESTADO DEFAULT
		*******************************************************************/	
		//ID Movimiento
		$('#txtMovimientoCajaHerramientasID_movimientos_entradas_maquinaria_traspaso_maquinaria').val('');
		//Folio
		$('#txtFolio_movimientos_entradas_maquinaria_traspaso_maquinaria').val('');
		//Fecha
		$('#txtFecha_movimientos_entradas_maquinaria_traspaso_maquinaria').val(fechaActual()); 
	    //Tipo de movimiento
		//$('#cmbMonedaID_movimientos_entradas_maquinaria_traspaso_maquinaria').attr('disabled', false);
		//Mecánico
		$('#txtMecanicoID_movimientos_entradas_maquinaria_traspaso_maquinaria').val('');
		$('#txtMecanico_movimientos_entradas_maquinaria_traspaso_maquinaria').val('');
		//Observaciones
		$('#txtObservaciones_movimientos_entradas_maquinaria_traspaso_maquinaria').val('');
		
		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo')
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_movimientos_entradas_maquinaria_traspaso_maquinaria').addClass("estatus-NUEVO");
		}
	    
	    nuevo_objeto_entrada();

		//Mostrar botón Guardar
		$("#btnGuardar_movimientos_entradas_maquinaria_traspaso_maquinaria").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_movimientos_entradas_maquinaria_traspaso_maquinaria").hide();
		$("#btnDescargarArchivo_movimientos_entradas_maquinaria_traspaso_maquinaria").hide();
		$("#btnDesactivar_movimientos_entradas_maquinaria_traspaso_maquinaria").hide();
		$("#btnRestaurar_movimientos_entradas_maquinaria_traspaso_maquinaria").hide();
		
	}

	//Función para crear un nuevo objeto de tipo Entrada por traspaso
	function nuevo_objeto_entrada(){
		// Crear un Objeto de tipo Entrada por traspaso
		objEntrada = new Entrada(null, null, '', '', '', '', null, null, null, []);
	}
	
	//Función para inicializar elementos de la tabla detalles
	function inicializar_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria()
	{
		//Eliminar los datos de la tabla detalles del movimiento
		$('#dg_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria tbody').empty();
		$('#acumCantidad_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').html(0);
		$('#numElementos_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').html(0);
		$('#txtNumDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria').html('');
	}
	
	
	//Función que se utiliza para cerrar el modal
	function cerrar_movimientos_entradas_maquinaria_traspaso_maquinaria()
	{
		try {
			//Cerrar modal
			objMovimientosEntradasMaquinariaTraspasoMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').focus();	
		}
		catch(err) {}
	}

	
	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_movimientos_entradas_maquinaria_traspaso_maquinaria()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_movimientos_entradas_maquinaria_traspaso_maquinaria();
		//Validación del formulario de campos obligatorios
		$('#frmMovimientosEntradasMaquinariaTraspasoMaquinaria')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_movimientos_entradas_maquinaria_traspaso_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
									    strSucursalDestino_movimientos_entradas_maquinaria_traspaso_maquinaria: {
											validators: {
											    callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la orden de compra
					                                    if( $('#txtSucursalDestinoID_movimientos_entradas_maquinaria_traspaso_maquinaria').val() === '')
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
										strObservaciones_movimientos_entradas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										intNumDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria: {
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
										strChofer_movimientos_entradas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strVehiculo_movimientos_entradas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strSerie_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strMotor_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strCodigo_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										},
										strDescripcion_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria: {
										        excluded: true  // Ignorar (no valida el campo)    
										}

									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_movimientos_entradas_maquinaria_traspaso_maquinaria = $('#frmMovimientosEntradasMaquinariaTraspasoMaquinaria').data('bootstrapValidator');
		bootstrapValidator_movimientos_entradas_maquinaria_traspaso_maquinaria.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_movimientos_entradas_maquinaria_traspaso_maquinaria.isValid())
		{	
			//Hacer un llamado a la función para guardar los datos del registro
			guardar_movimientos_entradas_maquinaria_traspaso_maquinaria();				
		}
		else 
			return;
	}

	
	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_movimientos_entradas_maquinaria_traspaso_maquinaria()
	{
		try
		{
			$('#frmMovimientosEntradasMaquinariaTraspasoMaquinaria').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	
	//Función para guardar o modificar los datos de un registro
	function guardar_movimientos_entradas_maquinaria_traspaso_maquinaria()
	{		
		//Convenrtir al formato JSON todo lo generado en el objeto de la vista
		objEntrada.setTipoMovimiento( intMovimientoIDEntradaMaquinariaTraspasoMaquinaria );            	
        objEntrada.setFecha( $.formatFechaMysql( $('#txtFecha_movimientos_entradas_maquinaria_traspaso_maquinaria').val() ) );
		objEntrada.setObservaciones( $('#txtObservaciones_movimientos_entradas_maquinaria_traspaso_maquinaria').val() );
		var jsonEntrada = JSON.stringify(objEntrada); 

		//Hacer un llamado al método del controlador para guardar los datos del registro	
		$.post('maquinaria/movimientos_entradas_maquinaria_traspaso/guardar',
				{ 
					//Datos de la entrada por compra
					strFolio: $('#txtFolio_movimientos_entradas_maquinaria_traspaso_maquinaria').val(),
					entradaTraspaso: jsonEntrada,
					intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_maquinaria_traspaso_maquinaria').val()
				},
				function(data) {

					if (data.resultado)
					{	    
	                    //Si no existe id del movimiento, significa que es un nuevo registro   
						if($('#txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_traspaso_maquinaria').val() == '')
						{
						  	//Asignar el id del movimiento registrado en la base de datos
                 			$('#txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.movimiento_maquinaria_id);
                 			//Asignar folio consecutivo
                 			$('#txtFolio_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.folio);
						} 

		                //Hacer un llamado a la función para cerrar modal
	                    cerrar_movimientos_entradas_maquinaria_traspaso_maquinaria();
	                    //Hacer llamado a la función  para cargar  los registros en el grid
		               	paginacion_movimientos_entradas_maquinaria_traspaso_maquinaria();          	    
					}

					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_movimientos_entradas_maquinaria_traspaso_maquinaria(data.tipo_mensaje, data.mensaje);

				},
		'json');	
		
	}

	// Función para cambiar el estatus del registro seleccionado
	function cambiar_estatus_movimientos_entradas_maquinaria_traspaso_maquinaria(id, estatus)
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_traspaso_maquinaria').val();
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
					              'title':    'Movimiento de entrada por traspaso',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('maquinaria/movimientos_entradas_maquinaria_traspaso/set_estatus',
					                                     {
					                                     	intMovimientoMaquinariaID: intID,
					                                      	strEstatus: estatus
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                          	//Hacer llamado a la función  para cargar  los registros en el grid
					                                          	paginacion_movimientos_entradas_maquinaria_traspaso_maquinaria();
					                                          	//Si el id del registro se obtuvo del modal
																if(id == '')
																{
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_movimientos_entradas_maquinaria_traspaso_maquinaria();     
																}
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_movimientos_entradas_maquinaria_traspaso_maquinaria(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });
	    }
	    else//Si el estatus del registro es INACTIVO
	    {
			//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
			$.post('maquinaria/movimientos_entradas_maquinaria_traspaso/set_estatus',
			     {
			     	intMovimientoMaquinariaID: intID,
			      	strEstatus: estatus
			     },
			     function(data) {
			      if (data.resultado)
			      {
			        //Hacer llamado a la función para cargar  los registros en el grid
			      	paginacion_movimientos_entradas_maquinaria_traspaso_maquinaria();
			      	//Si el id del registro se obtuvo del modal
					if(id == '')
					{
						//Hacer un llamado a la función para cerrar modal
						cerrar_movimientos_entradas_maquinaria_traspaso_maquinaria();     
					}
			      }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_movimientos_entradas_maquinaria_traspaso_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
	    }
	}

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_movimientos_entradas_maquinaria_traspaso_maquinaria(id, tipoAccion)
	{	
		//Hacer un llamado al método del controlador para regresar los datos del registro
		$.post('maquinaria/movimientos_entradas_maquinaria_traspaso/get_datos',
		       {
		       		intMovimientoMaquinariaID:id
		       },
		       function(data) {
		        	//Si hay datos del registro 
		            if(data.row)
		            {  
		            	//Hacer un llamado a la función para limpiar los campos del formulario
						nuevo_movimientos_entradas_maquinaria_traspaso_maquinaria();
						//Asignar estatus del registro
				        var strEstatus = data.row.estatus;
			          	
			          	//Recuperar valores para la Vista
			            $('#txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.movimiento_maquinaria_id);
			            $('#txtFolio_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.folio);
			            $('#txtFecha_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.fecha);
			            $('#txtFolioSalidaID_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.referencia_id);
			            $('#txtFolioSalida_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.folioSalida);

			            $('#txtSucursalSalidaID_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.sucursalSalidaID);
			            $('#txtSucursalSalida_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.sucursalSalida);
			            
						$('#txtChofer_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.chofer);
						$('#txtVehiculo_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.vehiculo);
						$('#txtObservaciones_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.observaciones);

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
							var objTabla = document.getElementById('dg_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];
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
														 " onclick='ver_aditamentos_renglon_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria(this)'>" +
														 "<span class='glyphicon glyphicon-cog'></span></button>";
							objCeldaDescripcion.setAttribute('class', 'no-mostrar');
							objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
							objCeldaPedimento.setAttribute('class', 'no-mostrar');
							objCeldaPedimento.innerHTML = data.detalles[intCon].numero_pedimento;
							objCeldaConsignacion.setAttribute('class', 'no-mostrar');
							objCeldaConsignacion.innerHTML = data.detalles[intCon].consignacion;
							objCeldaMaquinariaID.setAttribute('class', 'no-mostrar');
							objCeldaMaquinariaID.innerHTML = data.detalles[intCon].maquinaria_descripcion_id;

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
														  data.detalles[intCon].consignacion
														  );

							//Agregar cada objeto de tipo Maquinaria al objeto Entrada
							objEntrada.setMaquinaria(objMaquinaria);
							
			            }

						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria tr").length - 1;
						$('#numElementos_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').html(intFilas);
						$('#txtNumDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val(intFilas);
						
						
						//Dependiendo del estatus cambiar el color del encabezado 
			            $('#divEncabezadoModal_movimientos_entradas_maquinaria_traspaso_maquinaria').addClass("estatus-"+ strEstatus);
			            //Mostrar botón Imprimir  
			            $("#btnImprimirRegistro_movimientos_entradas_maquinaria_traspaso_maquinaria").show();
   	
						//Si el tipo de acción corresponde a Ver
			            if(tipoAccion == 'Ver')
			            {
			            	//Deshabilitar todos los elementos del formulario
			            	$('#frmMovimientosEntradasMaquinariaTraspasoMaquinaria').find('input, textarea, select').attr('disabled','disabled');
			            	//Ocultar los siguientes botones
				            $("#btnGuardar_movimientos_entradas_maquinaria_traspaso_maquinaria").hide();

				            //Si el estatus del registro es INACTIVO
			            	if(strEstatus == 'INACTIVO')
			            	{
			            		//Mostrar botón Restaurar
			            		$("#btnRestaurar_movimientos_entradas_maquinaria_traspaso_maquinaria").show();
			            	}

			            }
			            else
			            {
			            	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
				            {
				            	//Mostrar los siguientes botones  
				            	$("#btnDesactivar_movimientos_entradas_maquinaria_traspaso_maquinaria").show();
				            }
			            }
						
		            	//Abrir modal
			            objMovimientosEntradasMaquinariaTraspasoMaquinaria = $('#MovimientosEntradasMaquinariaTraspasoMaquinariaBox').bPopup({
										   appendTo: '#MovimientosEntradasMaquinariaTraspasoMaquinariaContent', 
			                               contentContainer: 'MovimientosEntradasMaquinariaTraspasoMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});

			            //Enfocar caja de texto
						$('#txtFecha_movimientos_entradas_maquinaria_traspaso_maquinaria').focus();

		       	    }
		       	    
		       },
		       'json');

	}

	//Función para agregar Aditamentos del renglón seleccionado
	function ver_aditamentos_renglon_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria(objRenglon){

		//Asignar los valores a las cajas de texto
		$('#txtSerie_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
		$('#txtMotor_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
		$('#txtCodigo_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
		$('#txtDescripcionCorta_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);

		nuevo_aditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria('grid');

	}

	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_movimientos_entradas_maquinaria_traspaso_maquinaria(id)
	{	
		//Variable que se utiliza para asignar id de la encuesta
		var intMovimientoMaquinariaID = 0;
		
		//Dependiendo del tipo de formulario asignar id
		if(id == '')
			intMovimientoMaquinariaID = $('#txtMovimientoMaquinariaID_movimientos_entradas_maquinaria_traspaso_maquinaria').val();
		else
			intMovimientoMaquinariaID = id;

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("maquinaria/movimientos_entradas_maquinaria_traspaso/get_reporte_registro/" + intMovimientoMaquinariaID);
	}

	//Función para mostrar mensaje de éxito o error
	function mensaje_movimientos_entradas_maquinaria_traspaso_maquinaria(tipoMensaje, mensaje)
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
	function ver_aditamentos_renglon_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria(objRenglon){

		//Asignar los valores a las cajas de texto
		var serie = objRenglon.parentNode.parentNode.cells[0].innerHTML;
		var motor = objRenglon.parentNode.parentNode.cells[1].innerHTML;
		var codigo = objRenglon.parentNode.parentNode.cells[2].innerHTML;
		var descripcionCorta = objRenglon.parentNode.parentNode.cells[3].innerHTML;

		nuevo_aditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria(serie, motor, codigo, descripcionCorta);

	}

	//Función para cargar el reporte general en PDF
	function reporte_movimientos_entradas_maquinaria_traspaso_maquinaria() 
	{	
		//Asignar valores para la búsqueda de registros
		var intSucursalIDSalidasMaquinariaTraspasoMaquinaria = $('#txtSucursalIDBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val();
		var dteFechaInicialSalidasMaquinariaTraspasoMaquinaria =  $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val());
		var dteFechaFinalSalidasMaquinariaTraspasoMaquinaria =  $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val());
		//Si no existe fecha inicial
		if(dteFechaInicialSalidasMaquinariaTraspasoMaquinaria == '')
		{
			dteFechaInicialSalidasMaquinariaTraspasoMaquinaria = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalSalidasMaquinariaTraspasoMaquinaria == '')
		{
			dteFechaFinalSalidasMaquinariaTraspasoMaquinaria =  '0000-00-00';
		}
		//Si no existe id del evento en busqueda
		if(intSucursalIDSalidasMaquinariaTraspasoMaquinaria == '' || 
			$('#txtSucursalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val() == ''
		  )
		{
			intSucursalIDSalidasMaquinariaTraspasoMaquinaria = 0;
		}


		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val('NO');
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("maquinaria/movimientos_entradas_maquinaria_traspaso/get_reporte/"+
					dteFechaInicialSalidasMaquinariaTraspasoMaquinaria+"/"+
					dteFechaFinalSalidasMaquinariaTraspasoMaquinaria+"/"+
					intSucursalIDSalidasMaquinariaTraspasoMaquinaria+"/"+
					$('#cmbEstatusBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val()+"/"+
					$('#chbImprimirDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val()+"/"+
					$('#txtBusqueda_movimientos_entradas_maquinaria_traspaso_maquinaria').val());

	}

	//Función para descargar el archivo XLS
	function descargar_xls_movimientos_entradas_maquinaria_traspaso_maquinaria() 
	{
		//Asignar valores para la búsqueda de registros
		var dteFechaInicialSalidasMaquinariaTraspasoMaquinaria =  $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val());
		var dteFechaFinalSalidasMaquinariaTraspasoMaquinaria =  $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val());
		//Si no existe fecha inicial
		if(dteFechaInicialSalidasMaquinariaTraspasoMaquinaria == '')
		{
			dteFechaInicialSalidasMaquinariaTraspasoMaquinaria = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalSalidasMaquinariaTraspasoMaquinaria == '')
		{
			dteFechaFinalSalidasMaquinariaTraspasoMaquinaria =  '0000-00-00';
		}
		//Si no existe id del evento en busqueda
		if( $('#txtSucursalIDBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val() == '' || 
			$('#txtSucursalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val() == ''
		  )
		{
			intSucursalIDSalidasMaquinariaTraspasoMaquinaria = 0;
		}
		else{
			intSucursalIDSalidasMaquinariaTraspasoMaquinaria = $('#txtSucursalIDBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val();
		}

		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val('NO');
		}


		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("maquinaria/movimientos_entradas_maquinaria_traspaso/get_xls/"+
					dteFechaInicialSalidasMaquinariaTraspasoMaquinaria+"/"+
					dteFechaFinalSalidasMaquinariaTraspasoMaquinaria+"/"+
					intSucursalIDSalidasMaquinariaTraspasoMaquinaria+"/"+
					$('#cmbEstatusBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val()+"/"+
					$('#chbImprimirDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val()+"/"+
					$('#txtBusqueda_movimientos_entradas_maquinaria_traspaso_maquinaria').val());
	}

	/*******************************************************************************************************************
	Funciones del modal secundario
	*********************************************************************************************************************/
	//Agregar aditamentos a una maquinaria
	function nuevo_aditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria(serie, motor, codigo, descripcionCorta){

		inicializar_aditamentos_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria();

		//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
		$('#divEncabezadoModalSecundario_movimientos_entradas_maquinaria_traspaso_maquinaria').addClass("estatus-NUEVO");
		//Abrir modal secundario
		 objAditamentosMovimientosEntradasMaquinariaTraspasoMaquinaria = $('#AditamentosMovimientosEntradasMaquinariaTraspasoMaquinariaBox').bPopup({
									   appendTo: '#MovimientosEntradasMaquinariaTraspasoMaquinariaContent', 
		                               contentContainer: 'AditamentosMovimientosEntradasMaquinariaTraspasoMaquinariaM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});
		
		//Asignar los valores que vienen del modal primario
		$('#txtCodigoAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria').val( codigo ); 
		$('#txtDescripcionAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria').val( descripcionCorta );
		$('#txtSerieAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria').val( serie );
		$('#txtMotorAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria').val( motor );

		//Consultar si la serie contiene aditamentos 
		//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
          $.post('maquinaria/salidas_maquinaria_traspaso/get_aditamentos',
              { 
              	strSerie: $("#txtSerieAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria").val()
              },
              function(data) {
              	//Si se econtró información
                if(data){

                	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_aditamentos_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];

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

			        var intFilas = $("#dg_aditamentos_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria tr").length - 1;
					$('#numElementos_detalles_aditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria').html(intFilas);
                }
            }
             ,
            'json');


	}

	//Función que se utiliza para cerrar el modal secundario
	function cerrar_aditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria()
	{
		try {
			//Cerrar modal
			objAditamentosMovimientosEntradasMaquinariaTraspasoMaquinaria.close();
			//Enfocar caja de texto 
			$('#txtCodigo_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').focus();	
		}
		catch(err) {}
	}

	//Función para inicializar elementos de la tabla detalles
	function inicializar_aditamentos_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria()
	{
		//Eliminar los datos de la tabla
		$('#dg_aditamentos_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria tbody').empty();
		$('#numElementos_detalles_aditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria').html(0);
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
		$('#dteFecha_movimientos_entradas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFecha_movimientos_entradas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

        //Autocomplete para recuperar los datos de un folio de salida por traspaso generado 
        $('#txtFolioSalida_movimientos_entradas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtFolioSalidaID_movimientos_entradas_maquinaria_traspaso_maquinaria').val('');
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
           	  $('#txtFolioSalidaID_movimientos_entradas_maquinaria_traspaso_maquinaria').val(ui.item.movimiento_maquinaria_id); 
             
              //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
              $.post('maquinaria/salidas_maquinaria_traspaso/get_datos',
                  { 
                  	intMovimientoMaquinariaID: $("#txtFolioSalidaID_movimientos_entradas_maquinaria_traspaso_maquinaria").val()
                  },
                  function(data) {

                    if(data.row){

                    	//Objeto encapsulado
                    	objEntrada.setReferenciaID(ui.item.movimiento_maquinaria_id);
                    	objEntrada.setChoferID(data.row.chofer_id);
                    	objEntrada.setVehiculoID(data.row.vehiculo_id);
                    	objEntrada.setSucursalSalidaID(data.row.sucursalSalidaID);
						//Agregar maquinarias del GRID
						//Limpiamos todo el array de maquinarias para insertar de nuevo los elementos
						objEntrada.arrMaquinarias = [];

						//Obtenemos el objeto de la tabla detalles
						var objTabla = document.getElementById('dg_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];

						$('#txtFolio_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.folio);
                    	$('#txtFolioSalida_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.folio);
                    	$('#txtFecha_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.fecha);
                    	$('#txtSucursalSalida_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.sucursalSalida);
                    	$('#txtSucursalSalidaID_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.sucursalSalidaID);
                    	$('#txtChofer_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.chofer);
                    	$('#txtVehiculo_movimientos_entradas_maquinaria_traspaso_maquinaria').val(data.row.vehiculo);
                    	//Cargar detalles
                    	//Si se econtró información
	                    if(data.detalles){

	                    	$('#dg_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria tbody').empty();

	                    	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').getElementsByTagName('tbody')[0];
	                    	for (var intCon in data.detalles) 
					        {
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaSerie = objRenglon.insertCell(0);
								var objCeldaMotor = objRenglon.insertCell(1);
								var objCeldaCodigo = objRenglon.insertCell(2);
								var objCeldaDescripcionCorta = objRenglon.insertCell(3);
								var objCeldaAcciones = objRenglon.insertCell(4);

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
															 " onclick='ver_aditamentos_renglon_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria(this)'>" +
															 "<span class='glyphicon glyphicon-cog'></span></button>" 
															 ; 

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
					        										data.detalles[intCon].consignacion
					        										);
					        	objEntrada.setMaquinaria(objMaquinaria);

					        }

					        var intFilas = $("#dg_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria tr").length - 1;
							$('#numElementos_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').html(intFilas);
							$('#txtNumDetalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val(intFilas);

	                    }

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
		$('#btnAditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			if($('#txtSerie_detalles_movimientos_entradas_maquinaria_traspaso_maquinaria').val() != ''){
				nuevo_aditamentos_movimientos_entradas_maquinaria_traspaso_maquinaria('');
			}
				
		});

		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_movimientos_entradas_maquinaria_traspaso_maquinaria').on('click','a',function(event){
			event.preventDefault();
			intPaginaMovimientosEntradasMaquinariaTraspasoMaquinaria = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_movimientos_entradas_maquinaria_traspaso_maquinaria();
		});

		//Autocomplete para recuperar los datos de un proveedor 
        $('#txtSucursalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtSucursalIDBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val('');
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
             $('#txtSucursalIDBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val(ui.item.data);
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
        $('#txtSucursalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').focusout(function(e){
            //Si no existe id del proveedor
            if($('#txtSucursalIDBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val() == '' ||
               $('#txtSucursalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtSucursalIDBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val('');
               $('#txtSucursalBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').val('');
            }
        });

        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_movimientos_entradas_maquinaria_traspaso_maquinaria').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_movimientos_entradas_maquinaria_traspaso_maquinaria('Nuevo');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_movimientos_entradas_maquinaria_traspaso_maquinaria').addClass("estatus-NUEVO");
			//Abrir modal
			 objMovimientosEntradasMaquinariaTraspasoMaquinaria = $('#MovimientosEntradasMaquinariaTraspasoMaquinariaBox').bPopup({
										   appendTo: '#MovimientosEntradasMaquinariaTraspasoMaquinariaContent', 
			                               contentContainer: 'MovimientosEntradasMaquinariaTraspasoMaquinariaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});		
		});

        //
        $('#txtFechaInicialBusq_movimientos_entradas_maquinaria_traspaso_maquinaria').focus();

  
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_movimientos_entradas_maquinaria_traspaso_maquinaria();

	});

</script>