
	<div id="MovimientosEntradasRefaccionesInternasTraspasoControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"
				                    		name= "strFechaInicialBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
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
								<label for="txtFechaFinalBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"
				                    		name= "strFechaFinalBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
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
								<label for="txtBusqueda_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
										name="strBusqueda_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
								 		name="strEstatusBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" tabindex="1">
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
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
									   	name="strImprimirDetalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
									   	type="checkbox" value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
						<div id="ToolBtns" class="btn-group">
							<!-- Buscar registros -->
							<button class="btn btn-primary" id="btnBuscar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"
									onclick="paginacion_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"
									onclick="reporte_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"
									onclick="reporte_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil.b3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Costo Unit."; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles del movimiento
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{estatus}}</td>
							<td class="td-center movil a4"> 
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos({{movimiento_refacciones_internas_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos({{movimiento_refacciones_internas_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos({{movimiento_refacciones_internas_id}}, 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos({{movimiento_refacciones_internas_id}}, {{referencia_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 	

		<!-- Diseño del modal-->
		<div id="MovimientosEntradasRefaccionesInternasTraspasoControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"  class="ModalBodyTitle">
			<h1>Entradas por traspaso</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Autocomplete que contiene las salidas de refacciones por traspaso que se encuentran activas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
										   name="intMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
                                    <input id="txtPolizaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
                                           name="intPolizaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" type="hidden" value="" />
                                    <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
                                    <input id="txtFolioPoliza_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
                                           name="strFolioPoliza_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la salida de refacciones por traspaso vehicular seleccionada-->
									<input id="txtReferenciaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
										   name="intReferenciaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"  
										   type="hidden"  value="">
									</input>
									<label for="txtReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos">Folio</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
											name="strReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
											type="text" value="" tabindex="1" placeholder="Ingrese salida" maxlength="250" />
								</div>
							</div>	
						</div>
						<!-- Fecha -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos'>
					                    <input class="form-control" 
					                    		id="txtFecha_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"
					                    		name= "strFecha_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
					                    		type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
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
									<label for="txtObservaciones_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos">Observaciones</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtObservaciones_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
											name="strObservaciones_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" 
											type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250" />			
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la entrada por traspaso</h4>
										</div>
										<div class="panel-body">
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Código</th>
																<th class="movil">Descripción</th>
																<th class="movil">Cantidad</th>
																<th class="movil">Costo Unit.</th>
																<th class="movil">Subtotal</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
														<tfoot class="movil">
															<tr class="movil">
																<td class="movil t1">
																	<strong>Total</strong>
																</td>
																<td class="movil t2"></td>
																<td  class="movil t3">
																	<strong id="acumCantidad_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"></strong>
																</td>
																<td class="movil t4"></td>
																<td class="movil t5">
																	<strong id="acumSubtotal_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"></strong>
																</td>
															</tr>
														</tfoot>
													</table>
													<br>
													<div class="row">
														<!--Número de registros encontrados-->
														<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
															<button class="btn btn-default btn-sm disabled pull-right">
																<strong id="numElementos_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos">0</strong> encontrados
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
					<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"  
									onclick="validar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"  
									onclick="reporte_registro_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos('');"  
									title="Imprimir" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"  
									onclick="cambiar_estatus_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos('', '', '', '', '');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MovimientosEntradasRefaccionesInternasTraspasoControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = 0;
		var strUltimaBusquedaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
        var strTipoReferenciaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = "MOVIMIENTO DE REFACCIONES INTERNAS";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
        var intNumDecimalesMostrarMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
        //Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
        var intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = <?php echo NUM_DECIMALES_COSTO_UNIT_MOV_REFACCIONES ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/movimientos_entradas_refacciones_internas_traspaso/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = strPermisosMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos[i]=='GUARDAR') || (arrPermisosMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
						}
						else if(arrPermisosMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos() 
		{
		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos =($('#txtFechaInicialBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()+$('#txtFechaFinalBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()+$('#cmbEstatusBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()+$('#txtBusqueda_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos != strUltimaBusquedaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos)
			{
				intPaginaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = 0;
				strUltimaBusquedaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = strNuevaBusquedaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/movimientos_entradas_refacciones_internas_traspaso/get_paginacion',
					{ //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					  dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()),
					  dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()),
					  strEstatus: $('#cmbEstatusBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(),
					  strBusqueda:$('#txtBusqueda_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(),
					  intPagina: intPaginaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos,
					  strPermisosAcceso: $('#txtAcciones_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()
					},
					function(data){
						$('#dg_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos tbody').empty();
						var tmpMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = Mustache.render($('#plantilla_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').html(),data);
						$('#dg_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos tbody').html(tmpMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos);
						$('#pagLinks_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').html(data.paginacion);
						$('#numElementos_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').html(data.total_rows);
						intPaginaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(strTipo) 
		{


			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'control_vehiculos/movimientos_entradas_refacciones_internas_traspaso/';

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
			if ($('#chbImprimirDetalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()),
										'strEstatus': $('#cmbEstatusBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(), 
										'strBusqueda': $('#txtBusqueda_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(),
										'strDetalles': $('#chbImprimirDetalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()					
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'control_vehiculos/movimientos_entradas_refacciones_internas_traspaso/get_reporte_registro',
							'data' : {
										'intMovimientoRefaccionesInternasID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos()
		{
			//Incializar formulario
			$('#frmMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(fechaActual()); 
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
            $.removerClasesEncabezado('divEncabezadoModal_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos');
			//Habilitar todos los elementos del formulario
			$('#frmMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtSucursalSalida_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').attr("disabled", "disabled");
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').attr("disabled", "disabled");
			$('#txtDescripcion_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').attr("disabled", "disabled");
			$('#txtPrecioUnitario_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').attr("disabled", "disabled");
 			//Mostrar los siguientes botones
			$("#btnGuardar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos").hide();
			$("#btnDesactivar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos").hide();
		}

	
		//Función para inicializar elementos de la salida de refacciones por traspaso vehicular
		function inicializar_salida_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos()
		{
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
		}
																	
		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos()
		{
			//Eliminar los datos de la tabla detalles del movimiento
			$('#dg_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos tbody').empty();
			$('#acumCantidad_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').html('');
		    $('#acumSubtotal_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').html('');
		    $('#numElementos_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').html(0);
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos()
		{
			try {
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos('');
				//Cerrar modal
				objMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos')
				.bootstrapValidator({	excluded: [':disabled'],
									 	container: 'popover',
									 	feedbackIcons: {
									 		valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
									  	},
									  	fields: {
											strFecha_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos: {
												validators: {
													notEmpty: {message: 'Seleccione una fecha'}
												}
											},
											strReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la salida de refacciones por traspaso vehicular
						                                    if($('#txtReferenciaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val() === '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba una salida por traspaso existente'
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
			var bootstrapValidator_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos = $('#frmMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos.isValid())
			{

				//Hacer un llamado a la función para guardar los datos del registro
				guardar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos()
		{
			try
			{
				$('#frmMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos()
		{

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRenglon = [];
			var arrRefaccionID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCodigosLineas = [];
			var arrCantidades = [];
			var arrCostosUnitarios = [];
			var arrLocalizaciones = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad =  parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				var intCostoUnitario = parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));
				//Asignar valores a los arrays
				arrRenglon.push(objRen.getAttribute('id'));
				arrRefaccionID.push(objRen.cells[5].innerHTML);
				arrCodigos.push(objRen.cells[0].innerHTML);
				arrDescripciones.push(objRen.cells[1].innerHTML);
				arrCodigosLineas.push(objRen.cells[6].innerHTML);
				arrCantidades.push(intCantidad);
				arrCostosUnitarios.push(intCostoUnitario);
				arrLocalizaciones.push(objRen.cells[8].innerHTML);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/movimientos_entradas_refacciones_internas_traspaso/guardar',
					{ 
						//Datos del movimiento
						intMovimientoRefaccionesInternasID: $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(),
						strFolio: $('#txtReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()),
						intReferenciaID: $('#txtReferenciaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(),
						strObservaciones: $('#txtObservaciones_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(),
						//Datos de los detalles
						strRenglon: arrRenglon.join('|'),
						strRefaccionID: arrRefaccionID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strCodigosLineas: arrCodigosLineas.join('|'),
						strCantidades: arrCantidades.join('|'),
						strCostosUnitarios: arrCostosUnitarios.join('|'),
						strLocalizaciones: arrLocalizaciones.join('|')
					},
					function(data) {
						if (data.resultado)
						{	

							 //Si no existe id del movimiento, significa que es un nuevo registro   
                            if($('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val() == '')
                            {
                                //Asignar el id del movimiento registrado en la base de datos
                                $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(data.movimiento_refacciones_internas_id);
                            }

                            //Hacer llamado a la función  para cargar  los registros en el grid
		               		paginacion_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();


		                   //Hacer un llamado a la función para generar póliza con los datos del registro
                            generar_poliza_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos('', '');
		                     
						}

						//Si existe mensaje de error
                        if(data.tipo_mensaje == 'error')
                        {
                            //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                            mensaje_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(data.tipo_mensaje, data.mensaje);
                        }
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(tipoMensaje, mensaje)
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
		function cambiar_estatus_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(movimientoRefaccionesID, referenciaID, polizaID, folioPoliza)
		{
			//Variable que se utiliza para asignar el id del movimiento
			var intID = 0;
			//Variable que se utiliza para asignar el id de la referencia
			var intMovimientoSalidaTraspasoID = 0;
			//Variable que se utiliza para asignar el id de la póliza
            var intPolizaID = 0;
            //Variable que se utiliza para asignar el folio de la póliza
            var strFolioPoliza = '';

			//Si no existe id, significa que se realizará la modificación desde el modal
			if(movimientoRefaccionesID == '')
			{
				intID = $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val();
				intMovimientoSalidaTraspasoID = $('#txtReferenciaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val();
				intPolizaID = $('#txtPolizaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val();
                strFolioPoliza = $('#txtFolioPoliza_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val();
			}
			else
			{
				intID = movimientoRefaccionesID;
				intMovimientoSalidaTraspasoID = referenciaID;
				intPolizaID = polizaID;
                strFolioPoliza = folioPoliza;
			}

			//Preguntar al usuario si desea desactivar el registro
			 new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro; también se desactivara la póliza con folio: '+strFolioPoliza+'?</strong>',
			             {'type':     'question',
			              'title':    'Entradas por Traspaso',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
			                              $.post('control_vehiculos/movimientos_entradas_refacciones_internas_traspaso/set_estatus',
			                                     {intMovimientoRefaccionesInternasID: intID,
			                                      intReferenciaID: intMovimientoSalidaTraspasoID, 
			                                       intPolizaID: intPolizaID
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                          	//Hacer llamado a la función  para cargar  los registros en el grid
			                                          	paginacion_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
			                                          	
			                                          	//Si el id del registro se obtuvo del modal
														if(movimientoRefaccionesID == '')
														{
															//Hacer un llamado a la función para cerrar modal
															cerrar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();     
														}
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(id)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/movimientos_entradas_refacciones_internas_traspaso/get_datos',
			       {intMovimientoRefaccionesInternasID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar el id de la póliza
                            var intPolizaID = parseInt(data.row.poliza_id); 
				            
				          	//Recuperar valores
				            $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(data.row.movimiento_refacciones_internas_id);
				            $('#txtFecha_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(data.row.fecha);
				            $('#txtReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(data.row.folio);
				            $('#txtReferenciaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(data.row.referencia_id);
						    $('#txtObservaciones_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(data.row.observaciones);
						    $('#txtPolizaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(intPolizaID);
                            $('#txtFolioPoliza_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(data.row.folio_poliza);
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').addClass("estatus-"+strEstatus);
				            //Hacer llamado a la función  para cargar los detalles del registro en el grid
				            lista_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos").show();
				            //Deshabilitar todos los elementos del formulario
			            	$('#frmMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
			            	//Ocultar los siguientes botones
				            $("#btnGuardar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos").hide();

							//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO' && intPolizaID > 0)
				            {
				            	//Mostrar el botón Desactivar
				            	$("#btnDesactivar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos").show();
				            }

			            	//Abrir modal
							objMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = $('#MovimientosEntradasRefaccionesInternasTraspasoControlVehiculosBox').bPopup({
														   appendTo: '#MovimientosEntradasRefaccionesInternasTraspasoControlVehiculosContent', 
							                               contentContainer: 'MovimientosEntradasRefaccionesInternasTraspasoControlVehiculosM', 
							                               zIndex: 2, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').focus();
			       	    }
			       },
			       'json');
		}


		//Función para generar póliza con los datos de un registro
        function generar_poliza_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(id, formulario)
        {   

            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Variable que se utiliza para saber si el id se obtuvo desde el modal
            var strTipo = 'modal';
            //Si no existe id, significa que se realizará la modificación desde el modal
            if(id == '')
            {
                intID = $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val();
            }
            else
            {
                intID = id;
                strTipo = 'gridview';
            }

            //Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
            mostrar_circulo_carga_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(formulario);
            //Hacer un llamado al método del controlador para timbrar los datos del registro
            $.post('contabilidad/generar_polizas/generar_poliza',
             {
                intReferenciaID: intID,
                strTipoReferencia: strTipoReferenciaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos, 
                intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()
             },
             function(data) {

                //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
                ocultar_circulo_carga_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(formulario);
                
                //Si existe resultado
                if (data.resultado)
                {
                    //Hacer llamado a la función para cargar  los registros en el grid
                    paginacion_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();

                    //Si el id del registro se obtuvo del modal
                    if(strTipo == 'modal')
                    {
                        //Hacer un llamado a la función para cerrar modal
                        cerrar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
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
                                                        cerrar_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
                                                     }
                                                    }]
                                      });
                }
                else
                {

                    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                    mensaje_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(data.tipo_mensaje, data.mensaje);
                }
                
             },
             'json');

        }


        //Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function mostrar_circulo_carga_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(formulario)
        {


            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos';



            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos';
            }

            //Remover clase para mostrar div que contiene la barra de carga
            $("#"+strCampoID).removeClass('no-mostrar');
        }


        //Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function ocultar_circulo_carga_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos';
            }

            //Agregar clase para ocultar div que contiene la barra de carga
            $("#"+strCampoID).addClass('no-mostrar');
        }
    

		

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para la búsqueda de detalles del registro
		function lista_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/movimientos_entradas_refacciones_internas_traspaso/get_datos_detalles',
			       {intMovimientoRefaccionesInternasID: $('#txtMovimientoRefaccionesInternasID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(),
			        intReferenciaID: $('#txtReferenciaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val()
			       },
			       function(data) {

			            //Mostramos los detalles del registro
			            for (var intCon in data.detalles) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').getElementsByTagName('tbody')[0];

							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcion = objRenglon.insertCell(1);
							var objCeldaCantidad = objRenglon.insertCell(2);
							var objCeldaCostoUnitario = objRenglon.insertCell(3);
							var objCeldaSubtotal = objRenglon.insertCell(4);
							//Columnas ocultas
							var objRefaccionID = objRenglon.insertCell(5);
							var objCeldaCodigoLinea = objRenglon.insertCell(6);
							var objCeldaCostoUnitarioBD = objRenglon.insertCell(7);
							var objCeldaLocalizacion = objRenglon.insertCell(8);

							//Variables que se utilizan para asignar valores del detalle
							var intSubtotal = 0;
							var intCantidad =  parseFloat(data.detalles[intCon].cantidad);
							var intCostoUnitario = parseFloat(data.detalles[intCon].costo_unitario);

							//Calcular subtotal
							intSubtotal = intCantidad * intCostoUnitario;

							//Cambiar cantidad a  formato moneda (a visualizar)
                    	    intCantidad =  formatMoney(intCantidad, 2, '');

                    	    var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos, '');

                    	    var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos, '');

                    	    //Cambiar cantidad a  formato moneda (a guardar en la  BD)
                   			var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos, '');


							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].renglon);
							objCeldaCodigo.setAttribute('class', 'movil b1');
							objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
							objCeldaDescripcion.setAttribute('class', 'movil b2');
							objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
							objCeldaCantidad.setAttribute('class', 'movil b3');
							objCeldaCantidad.innerHTML = intCantidad;
							objCeldaCostoUnitario.setAttribute('class', 'movil b4');
							objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
							objCeldaSubtotal.setAttribute('class', 'movil b5');
							objCeldaSubtotal.innerHTML = intSubtotalMostrar;
							objRefaccionID.setAttribute('class', 'no-mostrar');
							objRefaccionID.innerHTML = data.detalles[intCon].refaccion_id; 
							objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
							objCeldaCodigoLinea.innerHTML = data.detalles[intCon].codigo_linea; 
							objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
							objCeldaCostoUnitarioBD.innerHTML = intCostoUnitarioBD; 
							objCeldaLocalizacion.setAttribute('class', 'no-mostrar');
							objCeldaLocalizacion.innerHTML = data.detalles[intCon].localizacion; 
			            }

			            //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
			            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos tr").length - 2;
						$('#numElementos_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').html(intFilas);
			       },
			       'json');

		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumSubtotal = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Convertir cantidad a formato moneda
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos, '');

			//Asignar los valores
			$('#acumCantidad_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').html(intAcumUnidades);
			$('#acumSubtotal_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').html(intAcumSubtotal);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});

			//Autocomplete para recuperar los datos de una salida de refacciones por traspaso
	        $('#txtReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtReferenciaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val('');
	               //Hacer un llamado a la función para inicializar elementos de la salida de refacciones por traspaso vehicular
	               inicializar_salida_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/movimientos_salidas_refacciones_traspaso_vehicular/autocomplete",
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
	              $('#txtReferenciaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(ui.item.data);
	              //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	              $.post('refacciones/movimientos_salidas_refacciones_traspaso_vehicular/get_datos',
	                  { 
	                  	intMovimientoRefaccionesID: $("#txtReferenciaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos").val()
	                  },
	                  function(data) {
	                    if(data.row){
	                    	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
							inicializar_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
	                    	//Recuperar valores
	             		    $('#txtReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val(data.row.folio);
	             		    //Hacer llamado a la función  para cargar los detalles del registro en el grid
	             		    lista_detalles_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
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
	        
			//Verificar que exista id de la entrada cuando pierda el enfoque la caja de texto
	        $('#txtReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').focusout(function(e){
	            //Si no existe id de la entrada
	            if($('#txtReferenciaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val() == '' ||
	               $('#txtReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtReferenciaID_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val('');
	               $('#txtReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').val('');
	               //Hacer un llamado a la función para inicializar elementos de la salida de refacciones por traspaso vehicular
	               inicializar_salida_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
	            }

	        });

			
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY',
			 																		                            useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').data('DateTimePicker').maxDate(e.date);
			});
			

	        //Paginación de registros
			$('#pagLinks_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				objMovimientosEntradasRefaccionesInternasTraspasoControlVehiculos = $('#MovimientosEntradasRefaccionesInternasTraspasoControlVehiculosBox').bPopup({
											   appendTo: '#MovimientosEntradasRefaccionesInternasTraspasoControlVehiculosContent', 
				                               contentContainer: 'MovimientosEntradasRefaccionesInternasTraspasoControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#txtReferencia_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_movimientos_entradas_refacciones_internas_traspaso_control_vehiculos();
		});
	</script>