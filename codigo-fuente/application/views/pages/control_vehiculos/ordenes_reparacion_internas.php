	<div id="OrdenesReparacionInternasControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_ordenes_reparacion_internas_control_vehiculos" method="post" action="#" 
				  class="form-horizontal" role="form" name="frmBusqueda_ordenes_reparacion_internas_control_vehiculos"
				  onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_ordenes_reparacion_internas_control_vehiculos">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_ordenes_reparacion_internas_control_vehiculos'>
				                    <input class="form-control" id="txtFechaInicialBusq_ordenes_reparacion_internas_control_vehiculos"
				                    		name= "strFechaInicialBusq_ordenes_reparacion_internas_control_vehiculos" 
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
								<label for="txtFechaFinalBusq_ordenes_reparacion_internas_control_vehiculos">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_ordenes_reparacion_internas_control_vehiculos'>
				                    <input class="form-control" id="txtFechaFinalBusq_ordenes_reparacion_internas_control_vehiculos"
				                    		name= "strFechaFinalBusq_ordenes_reparacion_internas_control_vehiculos" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los vehículos activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del vehículo seleccionado-->
								<input id="txtVehiculoIDBusq_ordenes_reparacion_internas_control_vehiculos" 
									   name="intVehiculoIDBusq_ordenes_reparacion_internas_control_vehiculos"  type="hidden" 
									   value="">
								</input>
								<label for="txtVehiculoBusq_ordenes_reparacion_internas_control_vehiculos">Vehículo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtVehiculoBusq_ordenes_reparacion_internas_control_vehiculos" 
										name="strVehiculoBusq_ordenes_reparacion_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese vehículo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_ordenes_reparacion_internas_control_vehiculos">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_ordenes_reparacion_internas_control_vehiculos" 
								 		name="strEstatusBusq_ordenes_reparacion_internas_control_vehiculos" tabindex="1">
								    <option value="TODOS">TODOS</option>
                      				<option value="ACTIVO">ACTIVO</option>
                      				<option value="FINALIZADO">FINALIZADO</option>
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
								<label for="txtBusqueda_ordenes_reparacion_internas_control_vehiculos">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_ordenes_reparacion_internas_control_vehiculos" 
										name="strBusqueda_ordenes_reparacion_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_ordenes_reparacion_internas_control_vehiculos" 
									   name="strImprimirDetalles_ordenes_reparacion_internas_control_vehiculos" type="checkbox"
									   value="" tabindex="1" />
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-6">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_ordenes_reparacion_internas_control_vehiculos"
									onclick="paginacion_ordenes_reparacion_internas_control_vehiculos();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_ordenes_reparacion_internas_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_ordenes_reparacion_internas_control_vehiculos"
									onclick="reporte_ordenes_reparacion_internas_control_vehiculos('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_ordenes_reparacion_internas_control_vehiculos"
									onclick="reporte_ordenes_reparacion_internas_control_vehiculos('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla ordenes de reparación 
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Tipo de servicio"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Vehículo"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Serie"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla servicios
				*/
				td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Servicio"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Horas"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Mecánico"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla salidas de refacciones internas
				*/
				td.movil.c1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.c3:nth-of-type(3):before {content: "Requisición"; font-weight: bold;}
				td.movil.c4:nth-of-type(4):before {content: "Código"; font-weight: bold;}
				td.movil.c5:nth-of-type(5):before {content: "Descripción"; font-weight: bold;}
				td.movil.c6:nth-of-type(6):before {content: "Solicitado"; font-weight: bold;}
				td.movil.c7:nth-of-type(7):before {content: "Surtido"; font-weight: bold;}
				td.movil.c8:nth-of-type(8):before {content: "Devolución"; font-weight: bold;}
				td.movil.c9:nth-of-type(9):before {content: "Cantidad"; font-weight: bold;}
				td.movil.c10:nth-of-type(10):before {content: "Costo Unit."; font-weight: bold;}
				td.movil.c11:nth-of-type(11):before {content: "Total"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla salidas de refacciones internas
				*/
				td.movil.tc1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.tc2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.tc3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.tc4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.tc5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.tc6:nth-of-type(6):before {content: ""; font-weight: bold;}
				td.movil.tc7:nth-of-type(7):before {content: "Surtido"; font-weight: bold;}
				td.movil.tc8:nth-of-type(8):before {content: "Devolución"; font-weight: bold;}
				td.movil.tc9:nth-of-type(9):before {content: "Cantidad"; font-weight: bold;}
				td.movil.tc10:nth-of-type(10):before {content: ""; font-weight: bold;}
				td.movil.tc11:nth-of-type(11):before {content: "Total"; font-weight: bold;}

				/*
				Definir columnas de la tabla trabajos foráneos internos
				*/
				td.movil.d1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.d3:nth-of-type(1):before {content: "Concepto"; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Cantidad"; font-weight: bold;}
				td.movil.d5:nth-of-type(5):before {content: "Costo Unit."; font-weight: bold;}
				td.movil.d6:nth-of-type(6):before {content: "Desc."; font-weight: bold;}
				td.movil.d7:nth-of-type(7):before {content: "Subtotal"; font-weight: bold;}
				td.movil.d8:nth-of-type(8):before {content: "IVA"; font-weight: bold;}
				td.movil.d9:nth-of-type(9):before {content: "IEPS"; font-weight: bold;}
				td.movil.d10:nth-of-type(10):before {content: "Total"; font-weight: bold;}
				td.movil.d11:nth-of-type(11):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla trabajos foráneos internos
				*/
				td.movil.td1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.td2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.td3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.td4:nth-of-type(4):before {content: "Cantidad"; font-weight: bold;}
				td.movil.td5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.td6:nth-of-type(6):before {content: "Desc."; font-weight: bold;}
				td.movil.td7:nth-of-type(7):before {content: "Subtotal"; font-weight: bold;}
				td.movil.td8:nth-of-type(8):before {content: "IVA"; font-weight: bold;}
				td.movil.td9:nth-of-type(9):before {content: "IEPS"; font-weight: bold;}
				td.movil.td10:nth-of-type(10):before {content: "Total"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_ordenes_reparacion_internas_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Tipo de servicio</th>
							<th class="movil">Vehículo</th>
							<th class="movil">Serie</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_ordenes_reparacion_internas_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{servicio_interno_tipo}}</td>
							<td class="movil a4">{{vehiculo}}</td>
							<td class="movil a5">{{serie}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_ordenes_reparacion_internas_control_vehiculos({{orden_reparacion_interna_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_ordenes_reparacion_internas_control_vehiculos({{orden_reparacion_interna_id}},'Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
                            	<!---Finalizar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionFinalizar}}" 
										onclick="cambiar_estatus_ordenes_reparacion_internas_control_vehiculos({{orden_reparacion_interna_id}}, 'FINALIZADO');" title="Finalizar">
									<span class="glyphicon glyphicon-time"></span>
								</button>
								<!---Reactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionReactivar}}"  
										onclick="cambiar_estatus_ordenes_reparacion_internas_control_vehiculos({{orden_reparacion_interna_id}}, 'REACTIVAR', {{poliza_id}}, '{{folio_poliza}}');"  title="Reactivar">
									<span class="fa fa-undo"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_ordenes_reparacion_internas_control_vehiculos({{orden_reparacion_interna_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_ordenes_reparacion_internas_control_vehiculos({{orden_reparacion_interna_id}}, 'gridview')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_ordenes_reparacion_internas_control_vehiculos({{orden_reparacion_interna_id}},'{{estatus}}');" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ordenes_reparacion_internas_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_ordenes_reparacion_internas_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_ordenes_reparacion_internas_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 	

		<!-- Diseño del modal-->
		<div id="OrdenesReparacionInternasControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_ordenes_reparacion_internas_control_vehiculos" class="ModalBodyTitle">
				<h1>Orden de Trabajo Interna</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_ordenes_reparacion_internas_control_vehiculos" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_ordenes_reparacion_internas_control_vehiculos" class="active">
									<a data-toggle="tab" href="#informacion_general_ordenes_reparacion_internas_control_vehiculos">Información General</a>
								</li>
								<!--Tab que contiene la información de la mano de obra-->
								<li id="tabManoObra_ordenes_reparacion_internas_control_vehiculos">
									<a data-toggle="tab" href="#mano_obra_ordenes_reparacion_internas_control_vehiculos">Mano de Obra</a>
								</li>
								<!--Tab que contiene la información de las salidas de refacciones internas-->
								<li id="tabSalidasRefacciones_ordenes_reparacion_internas_control_vehiculos" class="disabled disabledTab">
									<a data-toggle="tab" href="#salidas_refacciones_ordenes_reparacion_internas_control_vehiculos">Refacciones</a>
								</li>
								<!--Tab que contiene la información de los trabajos foráneos-->
								<li id="tabTrabajosForaneos_ordenes_reparacion_internas_control_vehiculos" class="disabled disabledTab">
									<a data-toggle="tab" href="#trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos">Trabajos Foráneos</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmOrdenesReparacionInternasControlVehiculos" method="post" action="#" class="form-horizontal" role="form" name="frmOrdenesReparacionInternasControlVehiculos" 
					  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_ordenes_reparacion_internas_control_vehiculos" class="tab-pane fade in active">
							<div class="row">
								<!--Folio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtOrdenReparacionInternaID_ordenes_reparacion_internas_control_vehiculos" 
												   name="intOrdenReparacionInternaID_ordenes_reparacion_internas_control_vehiculos" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
											<input id="txtPolizaID_ordenes_reparacion_internas_control_vehiculos" 
												   name="intPolizaID_ordenes_reparacion_internas_control_vehiculos" type="hidden" value="" />
											 <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
											<input id="txtFolioPoliza_ordenes_reparacion_internas_control_vehiculos" 
												   name="strFolioPoliza_ordenes_reparacion_internas_control_vehiculos" type="hidden" value="" />
											<label for="txtFolio_ordenes_reparacion_internas_control_vehiculos">Folio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFolio_ordenes_reparacion_internas_control_vehiculos" 
													name="strFolio_ordenes_reparacion_internas_control_vehiculos" type="text" value="" 
													placeholder="Autogenerado" disabled>
											</input>
										</div>
									</div>
								</div>
								<!-- Fecha -->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_ordenes_reparacion_internas_control_vehiculos">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_ordenes_reparacion_internas_control_vehiculos'>
							                    <input class="form-control" 
							                    		id="txtFecha_ordenes_reparacion_internas_control_vehiculos"
							                    		name= "strFecha_ordenes_reparacion_internas_control_vehiculos" 
							                    		type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!-- Fecha de finalización-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFechaFinalizacion_ordenes_reparacion_internas_control_vehiculos">Fecha de finalización</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFechaFinalizacion_ordenes_reparacion_internas_control_vehiculos'>
							                    <input class="form-control" 
							                    		id="txtFechaFinalizacion_ordenes_reparacion_internas_control_vehiculos"
							                    		name= "strFechaFinalizacion_ordenes_reparacion_internas_control_vehiculos" 
							                    		type="text"  value="" disabled />
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Usuario de finalización-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtUsuarioFinalizacion_ordenes_reparacion_internas_control_vehiculos">Usuario de finalización</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtUsuarioFinalizacion_ordenes_reparacion_internas_control_vehiculos" 
													name="strUsuarioFinalizacion_ordenes_reparacion_internas_control_vehiculos" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene los tipos de servicios internos activos-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del  tipo de servicio interno seleccionado-->
											<input id="txtServicioInternoTipoID_ordenes_reparacion_internas_control_vehiculos" 
												   name="intServicioInternoTipoID_ordenes_reparacion_internas_control_vehiculos"  type="hidden" value="">
											</input>
											<label for="txtServicioInternoTipo_ordenes_reparacion_internas_control_vehiculos">Tipo de servicio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtServicioInternoTipo_ordenes_reparacion_internas_control_vehiculos" 
													name="strServicioInternoTipo_ordenes_reparacion_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese tipo de servicio" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene los vehículos activos-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del  vehículo seleccionado-->
											<input id="txtVehiculoID_ordenes_reparacion_internas_control_vehiculos" 
												   name="intVehiculoID_ordenes_reparacion_internas_control_vehiculos"  type="hidden" value="">
											</input>
											<label for="txtVehiculo_ordenes_reparacion_internas_control_vehiculos">Vehículo</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtVehiculo_ordenes_reparacion_internas_control_vehiculos" 
													name="strVehiculo_ordenes_reparacion_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese vehículo" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Kilometraje-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtKilometraje_ordenes_reparacion_internas_control_vehiculos">Kilometraje</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control moneda_ordenes_reparacion_internas_control_vehiculos" id="txtKilometraje_ordenes_reparacion_internas_control_vehiculos" 
													name="intKilometraje_ordenes_reparacion_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese kilometraje" maxlength="11">
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
								<!--Autocomplete que contiene las series de la descripción de maquinaria-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del inventario (correspondiente a la descripción de maquinaria) seleccionado-->
											<input id="txtInventarioMaquinariaDescripcionID_ordenes_reparacion_internas_control_vehiculos" 
												   name="intInventarioMaquinariaDescripcionID_ordenes_reparacion_internas_control_vehiculos"  
												   type="hidden" value="" />
											<label for="txtSerie_ordenes_reparacion_internas_control_vehiculos">Serie</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtSerie_ordenes_reparacion_internas_control_vehiculos" 
													name="strSerie_ordenes_reparacion_internas_control_vehiculos" type="text" value="" 
													tabindex="1" placeholder="Ingrese serie" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Motor-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMotor_ordenes_reparacion_internas_control_vehiculos">Motor</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMotor_ordenes_reparacion_internas_control_vehiculos" 
													name="strMotor_ordenes_reparacion_internas_control_vehiculos" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
								<!--Falla-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFalla_ordenes_reparacion_internas_control_vehiculos">Falla</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFalla_ordenes_reparacion_internas_control_vehiculos" 
													name="strFalla_ordenes_reparacion_internas_control_vehiculos" type="text" value="" 
													tabindex="1" placeholder="Ingrese falla" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Causa-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCausa_ordenes_reparacion_internas_control_vehiculos">Causa</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCausa_ordenes_reparacion_internas_control_vehiculos" 
													name="strCausa_ordenes_reparacion_internas_control_vehiculos" type="text" value="" 
													tabindex="1" placeholder="Ingrese causa" maxlength="250">
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
                       			<!--Solución-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtSolucion_ordenes_reparacion_internas_control_vehiculos">Solución</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtSolucion_ordenes_reparacion_internas_control_vehiculos" 
													name="strSolucion_ordenes_reparacion_internas_control_vehiculos" type="text" value="" 
													tabindex="1" placeholder="Ingrese solución" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Observaciones-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObservaciones_ordenes_reparacion_internas_control_vehiculos">Observaciones</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtObservaciones_ordenes_reparacion_internas_control_vehiculos" 
													name="strObservaciones_ordenes_reparacion_internas_control_vehiculos" type="text" value="" 
													tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
											</input>
										</div>
									</div>
								</div>
                       		</div>
						</div><!--Cierre del contenido del tab - Información General-->
						<!--Tab - Mano de Obra-->
						<div id="mano_obra_ordenes_reparacion_internas_control_vehiculos" class="tab-pane fade">
							<div class="row">
								<!--Autocomplete que contiene los servicios activos-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del servicio interno seleccionado-->
											<input id="txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos" 
												   name="intServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos" 
												   type="hidden" value="">
											</input>
											<label for="txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos">Código</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos"
												   name="strCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos" 
												   type="text" value="" tabindex="1" placeholder="Ingrese código" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Descripción-->
								<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos">Descripción</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos"
												   name="strDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos" 
												   type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Horas-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos">Horas</label>
										</div>
										<div class="col-md-12">
											<input class="form-control moneda_ordenes_reparacion_internas_control_vehiculos" id="txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos"
												   name="intHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos" 
												   type="text" value="" tabindex="1" placeholder="Ingrese horas" maxlength="11">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene los mecánicos internos activos-->
								<div class="col-sm-11 col-md-11 col-lg-11 col-xs-10">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del mecánico interno seleccionado-->
											<input id="txtMecanicoInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos" 
												   name="intMecanicoInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos"  
												   type="hidden" value="">
											</input>
											<label for="txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos">Mecánico</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos" 
													name="strMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese mecánico" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Botón agregar-->
                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                                	<button class="btn btn-primary btn-toolBtns pull-right" 
                                			id="btnAgregar_mano_obra_ordenes_reparacion_internas_control_vehiculos" 
                                			onclick="agregar_renglon_mano_obra_ordenes_reparacion_internas_control_vehiculos();" 
                                	     	title="Agregar" tabindex="1"> 
                                		<span class="glyphicon glyphicon-plus"></span>
                                	</button>
                             	</div>
							</div>
							<div class="form-group row">
								<!--Div que contiene la tabla con los servicios encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_mano_obra_ordenes_reparacion_internas_control_vehiculos">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Código</th>
												<th class="movil">Servicio</th>
												<th class="movil">Horas</th>
												<th class="movil">Mecánico</th>
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
												<strong id="numElementos_mano_obra_ordenes_reparacion_internas_control_vehiculos">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Mano de Obra-->
						<!--Tab - Refacciones-->
						<div id="salidas_refacciones_ordenes_reparacion_internas_control_vehiculos" class="tab-pane fade">
							<div class="form-group row">
								<!--Div que contiene la tabla con las salidas de refacciones encontradas-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Folio</th>
												<th class="movil">Fecha</th>
												<th class="movil">Requisición</th>
												<th class="movil">Código</th>
												<th class="movil">Descripción</th>
												<th class="movil">Solicitado</th>
												<th class="movil">Surtido</th>
												<th class="movil">Dev.</th>
												<th class="movil">Cantidad</th>
												<th class="movil">Costo Unit.</th>
												<th class="movil">Total</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos" type="text/template"> 
										{{#rows}}
											<tr class="movil {{estiloRegistro}}">   
												<td class="movil c1">{{folio}}</td>
												<td class="movil c2">{{fecha}}</td>
												<td class="movil c3">{{folio_requisicion}}</td>
												<td class="movil c4">{{codigo}}</td>
												<td class="movil c5">{{descripcion}}</td>
												<td class="movil c6">{{cantidad_solicitada}}</td>
												<td class="movil c7">{{cantidad_surtida}}</td>
												<td class="movil c8">{{cantidad_devolucion}}</td>
												<td class="movil c9">{{cantidad_facturar}}</td>
												<td class="movil c10">{{costo_unitario}}</td>
												<td class="movil c11">{{total}}</td>
											</tr>
											{{/rows}}
											{{^rows}}
											<tr class="movil"> 
												<td class="movil" colspan="3"> No se encontraron resultados.</td>
											</tr> 
											{{/rows}}
										</script>
										<tfoot class="movil">
											<tr class="movil">
												<td class="movil tc1">
													<strong>Total</strong>
												</td>
												<td class="movil tc2"></td>
												<td class="movil tc3"></td>
												<td class="movil tc4"></td>
												<td class="movil tc5"></td>
												<td class="movil tc6"></td>
												<td  class="movil tc7">
													<strong id="acumCantidadSurtida_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos">0.00</strong>
												</td>
												<td  class="movil tc8">
													<strong id="acumCantidadDevolucion_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos">0.00</strong>
												</td>
												<td  class="movil tc9">
													<strong id="acumCantidadFacturar_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos">0.00</strong>
												</td>
												<td class="movil tc10"></td>
												<td class="movil tc11">
													<strong id="acumTotal_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos">$0.00</strong>
												</td>
											</tr>
										</tfoot>
									</table>
									<br>
									<!--Diseño de la paginación-->
									<div class="row">
										<!--Páginas-->
										<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos"></div>
										<!--Número de registros encontrados-->
										<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Refacciones-->
						<!--Tab - Trabajos Foráneos-->
						<div id="trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos" class="tab-pane fade">
							<div class="form-group row">
								<!--Div que contiene la tabla con los registros de trabajos foraneos encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Folio</th>
												<th class="movil">Fecha</th>
												<th class="movil">Concepto</th>
												<th class="movil">Cantidad</th>
												<th class="movil">Costo Unit.</th>
												<th class="movil">Desc.</th>
												<th class="movil">Subtotal</th>
												<th class="movil">IVA</th>
												<th class="movil">IEPS</th>
												<th class="movil">Total</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos" type="text/template"> 
										{{#rows}}
											<tr class="movil {{estiloRegistro}}">   
												<td class="movil d1">{{folio}}</td>
												<td class="movil d2">{{fecha}}</td>
												<td class="movil d3">{{concepto}}</td>
												<td class="movil d4">{{cantidad}}</td>
												<td class="movil d5">{{costo_unitario}}</td>
												<td class="movil d6">{{descuento_unitario}}</td>
												<td class="movil d7">{{subtotal}}</td>
												<td class="movil d8">{{importe_iva}}</td>
												<td class="movil d9">{{importe_ieps}}</td>
												<td class="movil d10">{{total}}</td>
											</tr>
											{{/rows}}
											{{^rows}}
											<tr class="movil"> 
												<td class="movil" colspan="3"> No se encontraron resultados.</td>
											</tr> 
											{{/rows}}
										</script>
										<tfoot class="movil">
											<tr class="movil">
												<td class="movil td1">
													<strong>Total</strong>
												</td>
												<td class="movil td2"></td>
												<td class="movil td3"></td>
												<td  class="movil td4">
													<strong id="acumCantidad_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos">0.00</strong>
												</td>
												<td class="movil td5"></td>
												<td class="movil td6">
													<strong id="acumDescuento_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos">$0.00</strong>
												</td>
												<td class="movil td7">
													<strong id="acumSubtotal_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos">$0.00</strong>
												</td>
												<td class="movil td8">
													<strong id="acumIva_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos">$0.000000</strong>
												</td>
												<td class="movil td9">
													<strong  id="acumIeps_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos">$0.000000</strong>
												</td>
												<td class="movil td10">
													<strong id="acumTotal_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos">$0.000000</strong>
												</td>
											</tr>
										</tfoot>
									</table>
									<br>
									<!--Diseño de la paginación-->
									<div class="row">
										<!--Páginas-->
										<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos"></div>
										<!--Número de registros encontrados-->
										<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Trabajos Foráneos -->
					</div><!--Cierre del contenedor de tabs-->
					<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_ordenes_reparacion_internas_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_ordenes_reparacion_internas_control_vehiculos"  
									onclick="validar_ordenes_reparacion_internas_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!---Finalizar registro-->
							<button class="btn btn-default" id="btnFinalizar_ordenes_reparacion_internas_control_vehiculos"  
									onclick="cambiar_estatus_ordenes_reparacion_internas_control_vehiculos('','FINALIZADO');"  title="Finalizar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-time"></span>
							</button>
							<!---Reactivar registro-->
							<button class="btn btn-default" id="btnReactivar_ordenes_reparacion_internas_control_vehiculos"  
									onclick="cambiar_estatus_ordenes_reparacion_internas_control_vehiculos('','REACTIVAR', '', '');"  title="Reactivar" tabindex="4" disabled>
								<span class="fa fa-undo"></span>
							</button>		
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_ordenes_reparacion_internas_control_vehiculos"  
									onclick="reporte_registro_ordenes_reparacion_internas_control_vehiculos('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_ordenes_reparacion_internas_control_vehiculos"  
									onclick="cambiar_estatus_ordenes_reparacion_internas_control_vehiculos('','ACTIVO');"  title="Desactivar" tabindex="6" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_ordenes_reparacion_internas_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_ordenes_reparacion_internas_control_vehiculos();" title="Cerrar"  tabindex="8">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#OrdenesReparacionInternasControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros de ordenes de reparación
		var intPaginaOrdenesReparacionInternasControlVehiculos = 0;
		var strUltimaBusquedaOrdenesReparacionInternasControlVehiculos = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
		var strTipoReferenciaOrdenesReparacionInternasControlVehiculos = "ORDEN DE TRABAJO INTERNA";
		//Variables que se utilizan para la paginación de registros de salidas de refacciones internas
		var intPaginaSalidasRefaccionesOrdenesReparacionInternasControlVehiculos = 0;
		var strUltimaBusquedaSalidasRefaccionesOrdenesReparacionInternasControlVehiculos = "";
		//Variables que se utilizan para la paginación de registros de trabajos foráneos internos
		var intPaginaTrabajosForaneosOrdenesReparacionInternasControlVehiculos = 0;
		var strUltimaBusquedaTrabajosForaneosOrdenesReparacionInternasControlVehiculos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objOrdenesReparacionInternasControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_ordenes_reparacion_internas_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/ordenes_reparacion_internas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_ordenes_reparacion_internas_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosOrdenesReparacionInternasControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosOrdenesReparacionInternasControlVehiculos = strPermisosOrdenesReparacionInternasControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosOrdenesReparacionInternasControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosOrdenesReparacionInternasControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_ordenes_reparacion_internas_control_vehiculos').removeAttr('disabled');
							
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosOrdenesReparacionInternasControlVehiculos[i]=='GUARDAR') || (arrPermisosOrdenesReparacionInternasControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_ordenes_reparacion_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesReparacionInternasControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_ordenes_reparacion_internas_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_ordenes_reparacion_internas_control_vehiculos();
						}
						else if(arrPermisosOrdenesReparacionInternasControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_ordenes_reparacion_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesReparacionInternasControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_ordenes_reparacion_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesReparacionInternasControlVehiculos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_ordenes_reparacion_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesReparacionInternasControlVehiculos[i]=='FINALIZAR ORDEN DE REPARACION')//Si el indice es FINALIZAR ORDEN DE REPARACION
						{
							//Habilitar el control (botón finalizar)
							$('#btnFinalizar_ordenes_reparacion_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesReparacionInternasControlVehiculos[i]=='REACTIVAR ORDEN DE REPARACION')//Si el indice es REACTIVAR ORDEN DE REPARACION
						{
							//Habilitar el control (botón reactivar)
							$('#btnReactivar_ordenes_reparacion_internas_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesReparacionInternasControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_ordenes_reparacion_internas_control_vehiculos').removeAttr('disabled');
						}

					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_ordenes_reparacion_internas_control_vehiculos() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaOrdenesReparacionInternasControlVehiculos =($('#txtFechaInicialBusq_ordenes_reparacion_internas_control_vehiculos').val()+$('#txtFechaFinalBusq_ordenes_reparacion_internas_control_vehiculos').val()+$('#txtVehiculoIDBusq_ordenes_reparacion_internas_control_vehiculos').val()+$('#cmbEstatusBusq_ordenes_reparacion_internas_control_vehiculos').val()+$('#txtBusqueda_ordenes_reparacion_internas_control_vehiculos').val());

			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaOrdenesReparacionInternasControlVehiculos != strUltimaBusquedaOrdenesReparacionInternasControlVehiculos)
			{
				intPaginaOrdenesReparacionInternasControlVehiculos = 0;
				strUltimaBusquedaOrdenesReparacionInternasControlVehiculos = strNuevaBusquedaOrdenesReparacionInternasControlVehiculos;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/ordenes_reparacion_internas/get_paginacion',
				    {//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				     dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_reparacion_internas_control_vehiculos').val()),
				     dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_reparacion_internas_control_vehiculos').val()),
				     intVehiculoID: $('#txtVehiculoIDBusq_ordenes_reparacion_internas_control_vehiculos').val(),
				     strEstatus: $('#cmbEstatusBusq_ordenes_reparacion_internas_control_vehiculos').val(),
					 strBusqueda: $('#txtBusqueda_ordenes_reparacion_internas_control_vehiculos').val(),
					 intPagina:intPaginaOrdenesReparacionInternasControlVehiculos,
					 strPermisosAcceso: $('#txtAcciones_ordenes_reparacion_internas_control_vehiculos').val()
					},
					function(data){
						$('#dg_ordenes_reparacion_internas_control_vehiculos tbody').empty();
						var tmpOrdenesReparacionInternasControlVehiculos = Mustache.render($('#plantilla_ordenes_reparacion_internas_control_vehiculos').html(),data);
						$('#dg_ordenes_reparacion_internas_control_vehiculos tbody').html(tmpOrdenesReparacionInternasControlVehiculos);
						$('#pagLinks_ordenes_reparacion_internas_control_vehiculos').html(data.paginacion);
						$('#numElementos_ordenes_reparacion_internas_control_vehiculos').html(data.total_rows);
						intPaginaOrdenesReparacionInternasControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_ordenes_reparacion_internas_control_vehiculos(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'control_vehiculos/ordenes_reparacion_internas/';

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
			if ($('#chbImprimirDetalles_ordenes_reparacion_internas_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_ordenes_reparacion_internas_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_ordenes_reparacion_internas_control_vehiculos').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_reparacion_internas_control_vehiculos').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_reparacion_internas_control_vehiculos').val()),
										'intVehiculoID': $('#txtVehiculoIDBusq_ordenes_reparacion_internas_control_vehiculos').val(),
										'strEstatus': $('#cmbEstatusBusq_ordenes_reparacion_internas_control_vehiculos').val(), 
										'strBusqueda': $('#txtBusqueda_ordenes_reparacion_internas_control_vehiculos').val(),
										'strDetalles': $('#chbImprimirDetalles_ordenes_reparacion_internas_control_vehiculos').val()					
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_ordenes_reparacion_internas_control_vehiculos(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenReparacionInternaID_ordenes_reparacion_internas_control_vehiculos').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'control_vehiculos/ordenes_reparacion_internas/get_reporte_registro',
							'data' : {
										'intOrdenReparacionInternaID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_ordenes_reparacion_internas_control_vehiculos()
		{
			//Incializar formulario
			$('#frmOrdenesReparacionInternasControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_reparacion_internas_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmOrdenesReparacionInternasControlVehiculos').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_ordenes_reparacion_internas_control_vehiculos').val(fechaActual()); 
		    //Agregar clase disabled disabledTab para deshabilitar los siguientes tabs
		    $('#tabSalidasRefacciones_ordenes_reparacion_internas_control_vehiculos').addClass("disabled disabledTab");
		    $('#tabTrabajosForaneos_ordenes_reparacion_internas_control_vehiculos').addClass("disabled disabledTab");
		    //Seleccionar tab que contiene la información general
	  		$('a[href="#informacion_general_ordenes_reparacion_internas_control_vehiculos"]').click();
		    //Eliminar los datos de la tabla servicios
			$('#dg_mano_obra_ordenes_reparacion_internas_control_vehiculos tbody').empty();
			$('#numElementos_mano_obra_ordenes_reparacion_internas_control_vehiculos').html(0);
			//Eliminar los datos de la tabla salidas de refacciones internas
			$('#dg_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos tbody').empty();
			$('#acumCantidadSurtida_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html('0.00');
		    $('#acumCantidadDevolucion_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html('0.00');
		    $('#acumCantidadFacturar_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html('0.00');
			$('#acumTotal_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html('$0.00');
			$('#numElementos_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html(0);
			$('#pagLinks_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html(0);
			//Eliminar los datos de la tabla trabajos foráneos internos
			$('#dg_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos tbody').empty();
			$('#acumCantidad_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html('0.00');
		    $('#acumDescuento_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html('$0.00');
		    $('#acumSubtotal_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html('$0.00');
		    $('#acumIva_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html('$0.000000');
		    $('#acumIeps_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html('$0.000000');
		    $('#acumTotal_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html('$0.000000');
			$('#numElementos_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html(0);
			$('#pagLinks_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html(0);
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_ordenes_reparacion_internas_control_vehiculos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_ordenes_reparacion_internas_control_vehiculos').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_ordenes_reparacion_internas_control_vehiculos').removeClass("estatus-INACTIVO");
			$('#divEncabezadoModal_ordenes_reparacion_internas_control_vehiculos').removeClass("estatus-FINALIZADO");
			//Habilitar todos los elementos del formulario
			$('#frmOrdenesReparacionInternasControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_ordenes_reparacion_internas_control_vehiculos').attr("disabled", "disabled");
			$('#txtFechaFinalizacion_ordenes_reparacion_internas_control_vehiculos').attr("disabled", "disabled");
			$('#txtUsuarioFinalizacion_ordenes_reparacion_internas_control_vehiculos').attr("disabled", "disabled");
			$('#txtMotor_ordenes_reparacion_internas_control_vehiculos').attr("disabled", "disabled");
			//Mostrar los siguiente botones
			$("#btnGuardar_ordenes_reparacion_internas_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnFinalizar_ordenes_reparacion_internas_control_vehiculos").hide();
			$("#btnReactivar_ordenes_reparacion_internas_control_vehiculos").hide();
			$("#btnImprimirRegistro_ordenes_reparacion_internas_control_vehiculos").hide();
			$("#btnDesactivar_ordenes_reparacion_internas_control_vehiculos").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_ordenes_reparacion_internas_control_vehiculos()
		{
			try {

				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_ordenes_reparacion_internas_control_vehiculos('');
				//Cerrar modal
				objOrdenesReparacionInternasControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_reparacion_internas_control_vehiculos').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_ordenes_reparacion_internas_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_reparacion_internas_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmOrdenesReparacionInternasControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_ordenes_reparacion_internas_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strServicioInternoTipo_ordenes_reparacion_internas_control_vehiculos: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de servicio interno
					                                    if($('#txtServicioInternoTipoID_ordenes_reparacion_internas_control_vehiculos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un tipo de servicio existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strVehiculo_ordenes_reparacion_internas_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista la serie
					                                    if(value === '' && $('#txtSerie_ordenes_reparacion_internas_control_vehiculos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una serie o vehículo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strSerie_ordenes_reparacion_internas_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista el id del vehículo
					                                    if(value === '' && $('#txtVehiculoID_ordenes_reparacion_internas_control_vehiculos').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una serie o vehículo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intKilometraje_ordenes_reparacion_internas_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba un kilometraje'}
											}
										},
										strFalla_ordenes_reparacion_internas_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba una falla'}
											}
										},
										strCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										},
					                    strDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_ordenes_reparacion_internas_control_vehiculos = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_ordenes_reparacion_internas_control_vehiculos = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_ordenes_reparacion_internas_control_vehiculos.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_ordenes_reparacion_internas_control_vehiculos.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_ordenes_reparacion_internas_control_vehiculos = $('#frmOrdenesReparacionInternasControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_ordenes_reparacion_internas_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_ordenes_reparacion_internas_control_vehiculos.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_ordenes_reparacion_internas_control_vehiculos();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_ordenes_reparacion_internas_control_vehiculos()
		{
			try
			{
				$('#frmOrdenesReparacionInternasControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_ordenes_reparacion_internas_control_vehiculos()
		{
			//Obtenemos el objeto de la tabla servicios
			var objTabla = document.getElementById('dg_mano_obra_ordenes_reparacion_internas_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrServicioInternoID = [];
			var arrHoras = [];
			var arrMecanicoInternoID = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intHoras = $.reemplazar(objRen.cells[2].innerHTML, ",", "");

				//Asignar valores a los arrays
				arrServicioInternoID.push(objRen.getAttribute('id'));
				arrHoras.push(intHoras);
				arrMecanicoInternoID.push(objRen.cells[5].innerHTML);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/ordenes_reparacion_internas/guardar',
					{ 
						//Datos de la orden de reparación 
						intOrdenReparacionInternaID: $('#txtOrdenReparacionInternaID_ordenes_reparacion_internas_control_vehiculos').val(),
					    //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_ordenes_reparacion_internas_control_vehiculos').val()),
						intServicioInternoTipoID: $('#txtServicioInternoTipoID_ordenes_reparacion_internas_control_vehiculos').val(),
						intVehiculoID: $('#txtVehiculoID_ordenes_reparacion_internas_control_vehiculos').val(),
						strSerie: $('#txtSerie_ordenes_reparacion_internas_control_vehiculos').val(),
						strMotor: $('#txtMotor_ordenes_reparacion_internas_control_vehiculos').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intKilometraje:  $.reemplazar($('#txtKilometraje_ordenes_reparacion_internas_control_vehiculos').val(), ",", ""),
						strFalla: $('#txtFalla_ordenes_reparacion_internas_control_vehiculos').val(),
						strCausa: $('#txtCausa_ordenes_reparacion_internas_control_vehiculos').val(),
						strSolucion: $('#txtSolucion_ordenes_reparacion_internas_control_vehiculos').val(),
						strObservaciones: $('#txtObservaciones_ordenes_reparacion_internas_control_vehiculos').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_ordenes_reparacion_internas_control_vehiculos').val(),
						//Datos de los servicios
						strServicioInternoID: arrServicioInternoID.join('|'),
						strHoras: arrHoras.join('|'),
						strMecanicoInternoID: arrMecanicoInternoID.join('|')
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_ordenes_reparacion_internas_control_vehiculos();            
							//Hacer un llamado a la función para cerrar modal
							cerrar_ordenes_reparacion_internas_control_vehiculos();
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_reparacion_internas_control_vehiculos(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_ordenes_reparacion_internas_control_vehiculos(tipoMensaje, mensaje)
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
		function cambiar_estatus_ordenes_reparacion_internas_control_vehiculos(id, estatus, polizaID = 0, folioPoliza = '')
		{

			
			//Variable que se utiliza para generar póliza en caso de que el tipo de servicio no se facture
			var strGenerarPoliza = 'NO';
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para asignar el id de la póliza
			var intPolizaIDReg = 0;
		    //Variable que se utiliza para asignar el folio de la póliza
			var strFolioPoliza = '';
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Variable que se utiliza para cambiar el título del mensaje
			var strTituloMensaje = '';
			//Variable que se utiliza para cambiar el mensaje
			var strMensaje = '';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenReparacionInternaID_ordenes_reparacion_internas_control_vehiculos').val();
				intPolizaIDReg = $('#txtPolizaID_ordenes_reparacion_internas_control_vehiculos').val();
				strFolioPoliza = $('#txtFolioPoliza_ordenes_reparacion_internas_control_vehiculos').val();

			}
			else
			{
				intID = id;
				intPolizaIDReg = polizaID;
				strFolioPoliza = folioPoliza;
				strTipo = 'gridview';
			}

		    //Si el estatus del registro es ACTIVO, FINALIZADO o REACTIVAR
		    if(estatus != 'INACTIVO')
		    {
		       	//Dependiendo del estatus cambiar el título y mensaje de la alerta
		    	if(estatus == 'ACTIVO')
		    	{
		    		strTituloMensaje = 'Orden de Trabajo Interna';
		    		strMensaje =  '¿Está seguro que desea desactivar el registro?';
		    	}
		    	else if(estatus == 'FINALIZADO')
		    	{
		    		strTituloMensaje = 'Finalizar Orden de Trabajo Interna';
		    		strMensaje =  '¿Está seguro que desea finalizar esta orden de trabajo?';
		    	}
		    	else
		    	{
		    		strTituloMensaje = 'Activar Orden de Trabajo Interna';
		    		strMensaje =  '¿Está seguro que desea activar esta orden de trabajo ';
		    		//Si existe id de la póliza
		    		if(intPolizaIDReg > 0)
		    		{
		    			strMensaje += '; también se cancelara la póliza con folio: '+strFolioPoliza;
		    		}

		    		strMensaje += '?';
		    	}


				//Preguntar al usuario si desea modificar el estatus del registro
				new $.Zebra_Dialog('<strong>'+strMensaje+'</strong>',
				             {'type':     'question',
				              'title':    strTituloMensaje,
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('control_vehiculos/ordenes_reparacion_internas/set_estatus',
				                                     {intOrdenReparacionInternaID: intID,
				                                      strEstatus: estatus,
				                                      intPolizaID: intPolizaIDReg

				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                            //Hacer llamado a la función  para cargar  los registros en el grid
				                                            paginacion_ordenes_reparacion_internas_control_vehiculos();

				                                            //Si se cumple la sentencia
															if(estatus == 'FINALIZADO')
															{
																//Asignar SI para generar póliza del registro
																strGenerarPoliza = 'SI';
																//Hacer un llamado a la función para generar póliza con los datos del registro
																generar_poliza_ordenes_reparacion_internas_control_vehiculos(intID, strTipo);
															}
															else
															{

					                                            //Si el id del registro se obtuvo del modal
																if(strTipo == 'modal')
																{
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_ordenes_reparacion_internas_control_vehiculos();     
																}
															}
				                                        }

				                                        //Si se cumple la sentencia
				                                        if(strGenerarPoliza == 'NO' || data.tipo_mensaje == 'error')
				                                        {
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_ordenes_reparacion_internas_control_vehiculos(data.tipo_mensaje, data.mensaje);
					                                    }
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		   
		}

		//Función para generar póliza con los datos de un registro
		function generar_poliza_ordenes_reparacion_internas_control_vehiculos(id, tipo)
		{

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_ordenes_reparacion_internas_control_vehiculos(tipo);

			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: id,
		      	strTipoReferencia: strTipoReferenciaOrdenesReparacionInternasControlVehiculos, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_ordenes_reparacion_internas_control_vehiculos').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_ordenes_reparacion_internas_control_vehiculos(tipo);
			    //Si existe resultado
				if (data.resultado)
				{
					
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_ordenes_reparacion_internas_control_vehiculos();

					//Si el id del registro se obtuvo del modal
					if(tipo == 'modal')
					{
						//Hacer un llamado a la función para cerrar modal
						cerrar_ordenes_reparacion_internas_control_vehiculos();     
					}

				}

		      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		        mensaje_ordenes_reparacion_internas_control_vehiculos(data.tipo_mensaje, data.mensaje);
				
		     },
		     'json');

		}


		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function mostrar_circulo_carga_ordenes_reparacion_internas_control_vehiculos(tipo)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_ordenes_reparacion_internas_control_vehiculos';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(tipo == 'gridview')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_ordenes_reparacion_internas_control_vehiculos';
			}


			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}


		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function ocultar_circulo_carga_ordenes_reparacion_internas_control_vehiculos(tipo)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_ordenes_reparacion_internas_control_vehiculos';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(tipo == 'gridview')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_ordenes_reparacion_internas_control_vehiculos';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}




		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ordenes_reparacion_internas_control_vehiculos(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/ordenes_reparacion_internas/get_datos',
			       {
			       	intOrdenReparacionInternaID: id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ordenes_reparacion_internas_control_vehiculos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtOrdenReparacionInternaID_ordenes_reparacion_internas_control_vehiculos').val(data.row.orden_reparacion_interna_id);
				            $('#txtFolio_ordenes_reparacion_internas_control_vehiculos').val(data.row.folio);
						    $('#txtFecha_ordenes_reparacion_internas_control_vehiculos').val(data.row.fecha);
						    $('#txtServicioInternoTipoID_ordenes_reparacion_internas_control_vehiculos').val(data.row.servicio_interno_tipo_id);
						    $('#txtServicioInternoTipo_ordenes_reparacion_internas_control_vehiculos').val(data.row.servicio_interno_tipo);
						    $('#txtVehiculoID_ordenes_reparacion_internas_control_vehiculos').val(data.row.vehiculo_id);
						    $('#txtVehiculo_ordenes_reparacion_internas_control_vehiculos').val(data.row.vehiculo);
						    $('#txtInventarioMaquinariaDescripcionID_ordenes_reparacion_internas_control_vehiculos').val(data.row.serie);
						    $('#txtSerie_ordenes_reparacion_internas_control_vehiculos').val(data.row.serie);
						    $('#txtMotor_ordenes_reparacion_internas_control_vehiculos').val(data.row.motor);

						    $('#txtKilometraje_ordenes_reparacion_internas_control_vehiculos').val(data.row.kilometraje);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtKilometraje_ordenes_reparacion_internas_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
						    $('#txtFalla_ordenes_reparacion_internas_control_vehiculos').val(data.row.falla);
						    $('#txtCausa_ordenes_reparacion_internas_control_vehiculos').val(data.row.causa);
						    $('#txtSolucion_ordenes_reparacion_internas_control_vehiculos').val(data.row.solucion);
						    $('#txtObservaciones_ordenes_reparacion_internas_control_vehiculos').val(data.row.observaciones);
						    $('#txtFechaFinalizacion_ordenes_reparacion_internas_control_vehiculos').val(data.row.fecha_finalizacion);
						    $('#txtUsuarioFinalizacion_ordenes_reparacion_internas_control_vehiculos').val(data.row.usuario_finalizacion);
						    $('#txtPolizaID_ordenes_reparacion_internas_control_vehiculos').val(data.row.poliza_id);
						    $('#txtFolioPoliza_ordenes_reparacion_internas_control_vehiculos').val(data.row.folio_poliza);
						    //Quitar clase disabled disabledTab para habilitar los siguientes tabs
						    $('#tabSalidasRefacciones_ordenes_reparacion_internas_control_vehiculos').removeClass("disabled disabledTab");
				            $('#tabTrabajosForaneos_ordenes_reparacion_internas_control_vehiculos').removeClass("disabled disabledTab");
				            //Hacer llamado a la función  para cargar las salidas de refacciones internas en el grid
				            paginacion_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos();
				            //Hacer llamado a la función  para cargar los trabajos foráneos internos en el grid
				            paginacion_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos();
				            //Mostramos los servicios del registro
				            for (var intCon in data.servicios) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_mano_obra_ordenes_reparacion_internas_control_vehiculos').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaCodigo = objRenglon.insertCell(0);
								var objCeldaDescripcion = objRenglon.insertCell(1);
								var objCeldaHoras = objRenglon.insertCell(2);
								var objCeldaMecanico = objRenglon.insertCell(3);
								var objCeldaAcciones = objRenglon.insertCell(4);
								//Columnas ocultas
								var objCeldaMecanicoInternoID = objRenglon.insertCell(5);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.servicios[intCon].servicio_interno_id);
								objCeldaCodigo.setAttribute('class', 'movil b1');
								objCeldaCodigo.innerHTML = data.servicios[intCon].codigo;
								objCeldaDescripcion.setAttribute('class', 'movil b2');
								objCeldaDescripcion.innerHTML = data.servicios[intCon].descripcion;
								objCeldaHoras.setAttribute('class', 'movil b3');
								objCeldaHoras.innerHTML =formatMoney(data.servicios[intCon].horas, 2, '');
								objCeldaMecanico.setAttribute('class', 'movil b4');
								objCeldaMecanico.innerHTML = data.servicios[intCon].mecanico;
								objCeldaAcciones.setAttribute('class', 'td-center movil b5');
								objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_mano_obra_ordenes_reparacion_internas_control_vehiculos(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_mano_obra_ordenes_reparacion_internas_control_vehiculos(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
								objCeldaMecanicoInternoID.setAttribute('class', 'no-mostrar');
								objCeldaMecanicoInternoID.innerHTML = data.servicios[intCon].mecanico_interno_id;
							}

							//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
							var intFilas = $("#dg_mano_obra_ordenes_reparacion_internas_control_vehiculos tr").length - 1;
							$('#numElementos_mano_obra_ordenes_reparacion_internas_control_vehiculos').html(intFilas);

							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_ordenes_reparacion_internas_control_vehiculos').addClass("estatus-"+strEstatus);
							//Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_ordenes_reparacion_internas_control_vehiculos").show();

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar los siguientes botones
								$("#btnFinalizar_ordenes_reparacion_internas_control_vehiculos").show();
				            	$("#btnDesactivar_ordenes_reparacion_internas_control_vehiculos").show();
							}
							else 
							{	
								//Si el tipo de acción corresponde a Ver
								if(tipoAccion == 'Ver')
								{
									//Deshabilitar todos los elementos del formulario
				            		$('#frmOrdenesReparacionInternasControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
				            		//Ocultar los siguientes botones
					           		$("#btnGuardar_ordenes_reparacion_internas_control_vehiculos").hide(); 
								}

								//Si el estatus del registro es FINALIZADO
								if(strEstatus == 'FINALIZADO')
								{
									//Mostrar botón Reactivar
									$("#btnReactivar_ordenes_reparacion_internas_control_vehiculos").show();
								}
							}
			            	
			            	//Abrir modal
				            objOrdenesReparacionInternasControlVehiculos = $('#OrdenesReparacionInternasControlVehiculosBox').bPopup({
														  appendTo: '#OrdenesReparacionInternasControlVehiculosContent', 
							                              contentContainer: 'OrdenesReparacionInternasControlVehiculosM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtServicioInternoTipo_ordenes_reparacion_internas_control_vehiculos').focus();
					        
			       	    }
			       },
			       'json');
		}


		/*******************************************************************************************************************
		Funciones del Tab - Mano de Obra
		*********************************************************************************************************************/
		/*******************************************************************************************************************
		Funciones de la tabla servicios
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_mano_obra_ordenes_reparacion_internas_control_vehiculos()
		{
			//Obtenemos los datos de las cajas de texto
			var intServicioInternoID = $('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val();
			var strCodigo = $('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').val();
			var strDescripcion = $('#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos').val();
			var intHoras = $('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').val();
			var intMecanicoInternoID = $('#txtMecanicoInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val();
			var strMecanicoInterno = $('#txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_mano_obra_ordenes_reparacion_internas_control_vehiculos').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intServicioInternoID == '' || strCodigo == '')
			{
				//Enfocar caja de texto
				$('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
			}
			else if (intServicioInternoID == '' || strDescripcion == '')
			{
				//Enfocar caja de texto
				$('#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
			}
			else if (intHoras == '')
			{
				//Enfocar caja de texto
				$('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
			}
			else if (intMecanicoInternoID == '' || strMecanicoInterno == '')
			{
				//Enfocar caja de texto
				$('#txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
				$('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
			    $('#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
			    $('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
			    $('#txtMecanicoInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
			    $('#txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
			   
				//Revisamos si existe el ID proporcionado, si es así, editamos los datos
				if (objTabla.rows.namedItem(intServicioInternoID))
				{
					objTabla.rows.namedItem(intServicioInternoID).cells[2].innerHTML = intHoras
					objTabla.rows.namedItem(intServicioInternoID).cells[3].innerHTML = strMecanicoInterno;
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCodigo = objRenglon.insertCell(0);
					var objCeldaDescripcion = objRenglon.insertCell(1);
					var objCeldaHoras = objRenglon.insertCell(2);
					var objCeldaMecanico = objRenglon.insertCell(3);
					var objCeldaAcciones = objRenglon.insertCell(4);
					//Columnas ocultas
					var objCeldaMecanicoInternoID = objRenglon.insertCell(5);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intServicioInternoID);
					objCeldaCodigo.setAttribute('class', 'movil b1');
					objCeldaCodigo.innerHTML = strCodigo;
					objCeldaDescripcion.setAttribute('class', 'movil b2');
					objCeldaDescripcion.innerHTML = strDescripcion;
					objCeldaHoras.setAttribute('class', 'movil b3');
					objCeldaHoras.innerHTML = intHoras;
					objCeldaMecanico.setAttribute('class', 'movil b4');
					objCeldaMecanico.innerHTML = strMecanicoInterno;
					objCeldaAcciones.setAttribute('class', 'td-center movil b5');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_mano_obra_ordenes_reparacion_internas_control_vehiculos(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_mano_obra_ordenes_reparacion_internas_control_vehiculos(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaMecanicoInternoID.setAttribute('class', 'no-mostrar');
					objCeldaMecanicoInternoID.innerHTML = intMecanicoInternoID;
				}
				//Enfocar caja de texto
				$('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_mano_obra_ordenes_reparacion_internas_control_vehiculos tr").length - 1;
			$('#numElementos_mano_obra_ordenes_reparacion_internas_control_vehiculos').html(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_mano_obra_ordenes_reparacion_internas_control_vehiculos(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtMecanicoInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[5].innerHTML);
			
			//Enfocar caja de texto
			$('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_mano_obra_ordenes_reparacion_internas_control_vehiculos(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_mano_obra_ordenes_reparacion_internas_control_vehiculos").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_mano_obra_ordenes_reparacion_internas_control_vehiculos tr").length - 1;
			$('#numElementos_mano_obra_ordenes_reparacion_internas_control_vehiculos').html(intFilas);

			//Enfocar caja de texto
			$('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
		}

		/*******************************************************************************************************************
		Funciones del Tab - Refacciones
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtOrdenReparacionInternaID_ordenes_reparacion_internas_control_vehiculos').val() != strUltimaBusquedaSalidasRefaccionesOrdenesReparacionInternasControlVehiculos)
			{
				intPaginaSalidasRefaccionesOrdenesReparacionInternasControlVehiculos = 0;
				strUltimaBusquedaSalidasRefaccionesOrdenesReparacionInternasControlVehiculos = $('#txtOrdenReparacionInternaID_ordenes_reparacion_internas_control_vehiculos').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/movimientos_salidas_refacciones_internas/get_paginacion_detalles',
			{	
				intOrdenReparacionInternaID:$('#txtOrdenReparacionInternaID_ordenes_reparacion_internas_control_vehiculos').val(),
				intPagina:intPaginaSalidasRefaccionesOrdenesReparacionInternasControlVehiculos
			},
			function(data){

				$('#dg_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos tbody').empty();
				var tmpSalidasRefaccionesOrdenesReparacionInternasControlVehiculos = Mustache.render($('#plantilla_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html(), data);
				$('#dg_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos tbody').html(tmpSalidasRefaccionesOrdenesReparacionInternasControlVehiculos);
				$('#pagLinks_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html(data.paginacion);
				$('#numElementos_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html(data.total_rows);
				$('#acumCantidadSurtida_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html(data.acumulado_cantidad_surtidas);
				$('#acumCantidadDevolucion_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html(data.acumulado_cantidad_devolucion);
				$('#acumCantidadFacturar_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html(data.acumulado_cantidad_facturar);
				$('#acumTotal_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').html(data.acumulado_total);
				intPaginaSalidasRefaccionesOrdenesReparacionInternasControlVehiculos = data.pagina;
			},
			'json');
		}

		/*******************************************************************************************************************
		Funciones del Tab - Trabajos Foráneos
		*********************************************************************************************************************/
		//Función para la búsqueda de registros
		function paginacion_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtOrdenReparacionInternaID_ordenes_reparacion_internas_control_vehiculos').val() != strUltimaBusquedaTrabajosForaneosOrdenesReparacionInternasControlVehiculos)
			{
				intPaginaTrabajosForaneosOrdenesReparacionInternasControlVehiculos = 0;
				strUltimaBusquedaTrabajosForaneosOrdenesReparacionInternasControlVehiculos = $('#txtOrdenReparacionInternaID_ordenes_reparacion_internas_control_vehiculos').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/trabajos_foraneos_internos/get_paginacion_detalles',
					{	
						intOrdenReparacionInternaID:$('#txtOrdenReparacionInternaID_ordenes_reparacion_internas_control_vehiculos').val(),
						intPagina:intPaginaTrabajosForaneosOrdenesReparacionInternasControlVehiculos,
						strPermisosAcceso: $('#txtAcciones_ordenes_reparacion_internas_control_vehiculos').val()
					},
					function(data){

						$('#dg_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos tbody').empty();
						var tmpTrabajosForaneosOrdenesReparacionInternasControlVehiculos = Mustache.render($('#plantilla_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html(),data);
						$('#dg_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos tbody').html(tmpTrabajosForaneosOrdenesReparacionInternasControlVehiculos);
						$('#pagLinks_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html(data.paginacion);
						$('#numElementos_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html(data.total_rows);
						$('#acumCantidad_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html(data.acumulado_cantidad);
						$('#acumDescuento_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html(data.acumulado_descuento);
						$('#acumSubtotal_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html(data.acumulado_subtotal);
						$('#acumIva_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html(data.acumulado_iva);
						$('#acumIeps_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html(data.acumulado_ieps);
						$('#acumTotal_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').html(data.acumulado_total);
						intPaginaTrabajosForaneosOrdenesReparacionInternasControlVehiculos = data.pagina;

					},
			'json');
		}

		//Función que se utiliza para descargar el archivo del registro seleccionado
		function descargar_archivo_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos( trabajoForaneoInternoID, proveedorID)
		{

			//Abrir pestaña para realizar descarga del documento
			window.open("control_vehiculos/trabajos_foraneos_internos/descargar_archivo/"+proveedorID+"/"+trabajoForaneoInternoID);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal 
			*********************************************************************************************************************/
			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Información General
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtKilometraje_ordenes_reparacion_internas_control_vehiculos').numeric();
        	//Agregar datepicker para seleccionar fecha
			$('#dteFecha_ordenes_reparacion_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.moneda_ordenes_reparacion_internas_control_vehiculos').blur(function(){
                $('.moneda_ordenes_reparacion_internas_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
            });

        	
        	//Autocomplete para recuperar los datos de un tipo de servicio interno 
	        $('#txtServicioInternoTipo_ordenes_reparacion_internas_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtServicioInternoTipoID_ordenes_reparacion_internas_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/servicios_internos_tipos/autocomplete",
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
	             $('#txtServicioInternoTipoID_ordenes_reparacion_internas_control_vehiculos').val(ui.item.data);

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del tipo de servicio interno cuando pierda el enfoque la caja de texto
	        $('#txtServicioInternoTipo_ordenes_reparacion_internas_control_vehiculos').focusout(function(e){
	            //Si no existe id del tipo de servicio interno
	            if($('#txtServicioInternoTipoID_ordenes_reparacion_internas_control_vehiculos').val() == '' ||
	               $('#txtServicioInternoTipo_ordenes_reparacion_internas_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtServicioInternoTipoID_ordenes_reparacion_internas_control_vehiculos').val('');
	               $('#txtServicioInternoTipo_ordenes_reparacion_internas_control_vehiculos').val('');
	            }

	        });


			//Autocomplete para recuperar los datos de un vehículo 
	        $('#txtVehiculo_ordenes_reparacion_internas_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoID_ordenes_reparacion_internas_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/vehiculos/autocomplete",
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
	              $('#txtVehiculoID_ordenes_reparacion_internas_control_vehiculos').val(ui.item.data);
	              //Limpiar contenido de las siguientes cajas de texto
	              $('#txtInventarioMaquinariaDescripcionID_ordenes_reparacion_internas_control_vehiculos').val('');
	              $('#txtSerie_ordenes_reparacion_internas_control_vehiculos').val('');
	              $('#txtMotor_ordenes_reparacion_internas_control_vehiculos').val('');
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del vehículo cuando pierda el enfoque la caja de texto
	        $('#txtVehiculo_ordenes_reparacion_internas_control_vehiculos').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoID_ordenes_reparacion_internas_control_vehiculos').val() == '' ||
	               $('#txtVehiculo_ordenes_reparacion_internas_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVehiculoID_ordenes_reparacion_internas_control_vehiculos').val('');
	               $('#txtVehiculo_ordenes_reparacion_internas_control_vehiculos').val('');
	            }

	        });

	        
	        //Autocomplete para recuperar los datos de inventario de la descripción de maquinaria
			$('#txtSerie_ordenes_reparacion_internas_control_vehiculos').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtInventarioMaquinariaDescripcionID_ordenes_reparacion_internas_control_vehiculos').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "maquinaria/maquinaria_inventario/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_ordenes_reparacion_internas_control_vehiculos').val(),
							strDescripcion: request.term, 
							strTipo: 'serie',
							strFormulario: 'ordenes_reparacion_internas'
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar datos del registro seleccionado
					$('#txtInventarioMaquinariaDescripcionID_ordenes_reparacion_internas_control_vehiculos').val(ui.item.serie);
					$('#txtMotor_ordenes_reparacion_internas_control_vehiculos').val(ui.item.motor);
					//Elegir serie desde el valor devuelto en el autocomplete
					ui.item.value = ui.item.value.split(" - ")[0];
					//Limpiar contenido de las siguientes cajas de texto
	                $('#txtVehiculoID_ordenes_reparacion_internas_control_vehiculos').val('');
	                $('#txtVehiculo_ordenes_reparacion_internas_control_vehiculos').val('');
					
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

		    //Verificar que exista id del inventario de la descripción de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtSerie_ordenes_reparacion_internas_control_vehiculos').focusout(function(e){
	            //Si no existe id del inventario de la descripción de maquinaria
	            if($('#txtInventarioMaquinariaDescripcionID_ordenes_reparacion_internas_control_vehiculos').val() == '' ||
	               $('#txtSerie_ordenes_reparacion_internas_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtInventarioMaquinariaDescripcionID_ordenes_reparacion_internas_control_vehiculos').val('');
	               $('#txtSerie_ordenes_reparacion_internas_control_vehiculos').val('');
	               $('#txtMotor_ordenes_reparacion_internas_control_vehiculos').val('');
	            }
	        });


	        /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Mano de Obra
        	*********************************************************************************************************************/
         	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').numeric();

        
        	//Autocomplete para recuperar los datos de un servicio
			$('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "control_vehiculos/servicios_internos/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val(ui.item.data);
					//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             	$.post('control_vehiculos/servicios_internos/get_datos',
	                  { 
	                  	strBusqueda:$("#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos").val(data.row.codigo);
	                       $("#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos").val(data.row.descripcion);
	                       $("#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos").val(data.row.horas);
	                       //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					       $('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
					       //Enfocar caja de texto
					       $('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
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

			//Verificar que exista id del servicio interno cuando pierda el enfoque la caja de texto
	        $('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').focusout(function(e){
	            //Si no existe id del servicio interno
	            if($('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '' ||
	               $('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
	               $('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
	               $('#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
	               $('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de un servicio interno
			$('#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "control_vehiculos/servicios_internos/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term,
							strTipo: 'descripcion'
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val(ui.item.data);
					//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             	$.post('servicio/servicios/get_datos',
	                  { 
	                  	strBusqueda:$("#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos").val(data.row.codigo);
	                       $("#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos").val(data.row.descripcion);
	                       $("#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos").val(data.row.horas);
	                       //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					       $('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
					       //Enfocar caja de texto
					       $('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
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

			//Verificar que exista id del servicio interno cuando pierda el enfoque la caja de texto
	        $('#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos').focusout(function(e){
	            //Si no existe id del servicio interno
	            if($('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '' ||
	               $('#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
	               $('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
	               $('#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
	               $('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
	            }

	        });

			//Autocomplete para recuperar los datos de un mecánico interno
	        $('#txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMecanicoInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/mecanicos_internos/autocomplete",
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
	             $('#txtMecanicoInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del mecánico interno cuando pierda el enfoque la caja de texto
	        $('#txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos').focusout(function(e){
	            //Si no existe id del mecánico interno
	            if($('#txtMecanicoInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '' ||
	               $('#txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMecanicoInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
	               $('#txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos').val('');
	            }
	            
	        });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_mano_obra_ordenes_reparacion_internas_control_vehiculos').on('click','button.btn',function(){
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

	        //Validar que exista código del servicio interno cuando se pulse la tecla enter 
			$('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
			   	    //Si no existe código del servicio interno
		            if($('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '' || $('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCodigo_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
			   	    }
		        }
		    });

		    //Validar que exista descripción del servicio interno cuando se pulse la tecla enter 
			$('#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe descripción del servicio interno
		            if($('#txtServicioInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '' || $('#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtDescripcion_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
			   	    }
		        }
		    });

		    //Validar que existan horas del servicio interno cuando se pulse la tecla enter 
			$('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existen horas del servicio interno
		            if($('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtHoras_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
			   	    }
		        }
		    });

		    //Validar que exista mecánico cuando se pulse la tecla enter 
			$('#txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe mecánico
		            if($('#txtMecanicoInternoID_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '' || $('#txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtMecanicoInterno_mano_obra_ordenes_reparacion_internas_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
		    			agregar_renglon_mano_obra_ordenes_reparacion_internas_control_vehiculos();
			   	    }
		        }
		    });

			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Refacciones
        	*********************************************************************************************************************/
        	//Paginación de registros
			$('#pagLinks_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaSalidasRefaccionesOrdenesReparacionInternasControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar las salidas de refacciones internas en el grid
				paginacion_salidas_refacciones_ordenes_reparacion_internas_control_vehiculos();
			});


			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Trabajos Foráneos
        	*********************************************************************************************************************/
        	//Paginación de registros
			$('#pagLinks_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaTrabajosForaneosOrdenesReparacionInternasControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar los trabajos foráneos internos en el grid
				paginacion_trabajos_foraneos_ordenes_reparacion_internas_control_vehiculos();
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_ordenes_reparacion_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_ordenes_reparacion_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY',
			 																		              useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_ordenes_reparacion_internas_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_ordenes_reparacion_internas_control_vehiculos').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_ordenes_reparacion_internas_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_ordenes_reparacion_internas_control_vehiculos').data('DateTimePicker').maxDate(e.date);
			});


			//Autocomplete para recuperar los datos de un vehículo 
	        $('#txtVehiculoBusq_ordenes_reparacion_internas_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoIDBusq_ordenes_reparacion_internas_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/vehiculos/autocomplete",
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
	             $('#txtVehiculoIDBusq_ordenes_reparacion_internas_control_vehiculos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del vehículo cuando pierda el enfoque la caja de texto
	        $('#txtVehiculoBusq_ordenes_reparacion_internas_control_vehiculos').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoIDBusq_ordenes_reparacion_internas_control_vehiculos').val() == '' ||
	               $('#txtVehiculoBusq_ordenes_reparacion_internas_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVehiculoIDBusq_ordenes_reparacion_internas_control_vehiculos').val('');
	               $('#txtVehiculoBusq_ordenes_reparacion_internas_control_vehiculos').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_ordenes_reparacion_internas_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaOrdenesReparacionInternasControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_ordenes_reparacion_internas_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_ordenes_reparacion_internas_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_ordenes_reparacion_internas_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_ordenes_reparacion_internas_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				 objOrdenesReparacionInternasControlVehiculos = $('#OrdenesReparacionInternasControlVehiculosBox').bPopup({
											   appendTo: '#OrdenesReparacionInternasControlVehiculosContent', 
				                               contentContainer: 'OrdenesReparacionInternasControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtServicioInternoTipo_ordenes_reparacion_internas_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_ordenes_reparacion_internas_control_vehiculos').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_ordenes_reparacion_internas_control_vehiculos();
		});
	</script>