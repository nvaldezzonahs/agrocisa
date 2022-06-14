
	<div id="TrabajosForaneosInternosControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_trabajos_foraneos_internos_control_vehiculos" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_trabajos_foraneos_internos_control_vehiculos">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_trabajos_foraneos_internos_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_trabajos_foraneos_internos_control_vehiculos"
				                    		name= "strFechaInicialBusq_trabajos_foraneos_internos_control_vehiculos" 
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
								<label for="txtFechaFinalBusq_trabajos_foraneos_internos_control_vehiculos">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_trabajos_foraneos_internos_control_vehiculos'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_trabajos_foraneos_internos_control_vehiculos"
				                    		name= "strFechaFinalBusq_trabajos_foraneos_internos_control_vehiculos" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los proveedores activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
								<input id="txtProveedorIDBusq_trabajos_foraneos_internos_control_vehiculos" 
									   name="intProveedorIDBusq_trabajos_foraneos_internos_control_vehiculos"  
									   type="hidden" value="">
								</input>
								<label for="txtProveedorBusq_trabajos_foraneos_internos_control_vehiculos">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProveedorBusq_trabajos_foraneos_internos_control_vehiculos" 
										name="strProveedorBusq_trabajos_foraneos_internos_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_trabajos_foraneos_internos_control_vehiculos">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_trabajos_foraneos_internos_control_vehiculos" 
								 		name="strEstatusBusq_trabajos_foraneos_internos_control_vehiculos" tabindex="1">
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
								<label for="txtBusqueda_trabajos_foraneos_internos_control_vehiculos">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_trabajos_foraneos_internos_control_vehiculos" 
										name="strBusqueda_trabajos_foraneos_internos_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_trabajos_foraneos_internos_control_vehiculos" 
									   	name="strImprimirDetalles_trabajos_foraneos_internos_control_vehiculos" 
									   	type="checkbox" value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!-- Buscar registros -->
							<button class="btn btn-primary" id="btnBuscar_trabajos_foraneos_internos_control_vehiculos"
									onclick="paginacion_trabajos_foraneos_internos_control_vehiculos();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_trabajos_foraneos_internos_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_trabajos_foraneos_internos_control_vehiculos"
									onclick="reporte_trabajos_foraneos_internos_control_vehiculos('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_trabajos_foraneos_internos_control_vehiculos"
									onclick="reporte_trabajos_foraneos_internos_control_vehiculos('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla trabajos foráneos internos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Proveedor"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "No. de orden"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Orden de compra"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles del trabajo foráneo interno
				*/
				td.movil.b1:nth-of-type(1):before {content: "Concepto"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Costo Unit."; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles del trabajo foráneo interno
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.t6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.t7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.t8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_trabajos_foraneos_internos_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Proveedor</th>
							<th class="movil">No. de orden</th>
							<th class="movil">Orden de compra</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_trabajos_foraneos_internos_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{proveedor}}</td>
							<td class="movil a4">{{folio_orden_reparacion}}</td>
							<td class="movil a5">{{folio_orden_compra}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_trabajos_foraneos_internos_control_vehiculos({{trabajo_foraneo_interno_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_trabajos_foraneos_internos_control_vehiculos({{trabajo_foraneo_interno_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_trabajos_foraneos_internos_control_vehiculos({{trabajo_foraneo_interno_id}});"  title="Imprimir registro en PDF"><span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_trabajos_foraneos_internos_control_vehiculos({{trabajo_foraneo_interno_id}}, 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_trabajos_foraneos_internos_control_vehiculos({{trabajo_foraneo_interno_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_trabajos_foraneos_internos_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_trabajos_foraneos_internos_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		 <!--Circulo de progreso-->
        <div id="divCirculoBarProgresoPrincipal_trabajos_foraneos_internos_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
            <div class="loader">Loading...</div>
            <br><br>
            <div align=center><b>Espere un momento por favor.</b></div>
        </div>  

		<!-- Diseño del modal-->
		<div id="TrabajosForaneosInternosControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_trabajos_foraneos_internos_control_vehiculos"  class="ModalBodyTitle">
			<h1>Trabajos Foráneos para Servicios Internos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmTrabajosForaneosInternosControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmTrabajosForaneosInternosControlVehiculos"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!-- Folio -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtTrabajoForaneoInternoID_trabajos_foraneos_internos_control_vehiculos" 
										   name="intTrabajoForaneoInternoID_trabajos_foraneos_internos_control_vehiculos" 
										   type="hidden" value="" />
								     <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_trabajos_foraneos_internos_control_vehiculos" 
										   name="intPolizaID_trabajos_foraneos_internos_control_vehiculos" type="hidden" value="" />
								     <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
									<input id="txtFolioPoliza_trabajos_foraneos_internos_control_vehiculos" 
										   name="strFolioPoliza_trabajos_foraneos_internos_control_vehiculos" type="hidden" value="" />
									<label for="txtFolio_trabajos_foraneos_internos_control_vehiculos">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_trabajos_foraneos_internos_control_vehiculos" 
											name="strFolio_trabajos_foraneos_internos_control_vehiculos" 
											type="text" value="" placeholder="Autogenerado" disabled />
								</div>
							</div>
						</div>
						<!-- Fecha -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_trabajos_foraneos_internos_control_vehiculos">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_trabajos_foraneos_internos_control_vehiculos'>
					                    <input class="form-control" 
					                    		id="txtFecha_trabajos_foraneos_internos_control_vehiculos"
					                    		name= "strFecha_trabajos_foraneos_internos_control_vehiculos" 
					                    		type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Moneda-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la moneda-->
									<input id="txtMonedaID_trabajos_foraneos_internos_control_vehiculos" 
										   name="intMonedaID_trabajos_foraneos_internos_control_vehiculos"  
										   type="hidden"  value="">
									</input>
									<label for="txtMoneda_trabajos_foraneos_internos_control_vehiculos">Moneda</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMoneda_trabajos_foraneos_internos_control_vehiculos" 
											name="strMoneda_trabajos_foraneos_internos_control_vehiculos" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_trabajos_foraneos_internos_control_vehiculos">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTipoCambio_trabajos_foraneos_internos_control_vehiculos" 
											name="intTipoCambio_trabajos_foraneos_internos_control_vehiculos" 
											type="text" value="" disabled/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene las ordenes de reparación activas-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de reparación seleccionada-->
									<input id="txtOrdenReparacionInternaID_trabajos_foraneos_internos_control_vehiculos" 
										   name="intOrdenReparacionInternaID_trabajos_foraneos_internos_control_vehiculos"  type="hidden" 
										   value="">
									</input>
									<label for="txtOrdenReparacionInterna_trabajos_foraneos_internos_control_vehiculos">No. de orden</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtOrdenReparacionInterna_trabajos_foraneos_internos_control_vehiculos" 
											name="strOrdenReparacionInterna_trabajos_foraneos_internos_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese orden" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Referencia-->
						<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtReferencia_trabajos_foraneos_internos_control_vehiculos">Vehículo/Serie</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtReferencia_trabajos_foraneos_internos_control_vehiculos" 
											name="strReferencia_trabajos_foraneos_internos_control_vehiculos" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
					</div>	
					<div class="row">
						<!--Autocomplete que contiene las ordenes de compra autorizadas-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de compra seleccionada-->
									<input id="txtOrdenCompraID_trabajos_foraneos_internos_control_vehiculos" 
										   name="intOrdenCompraID_trabajos_foraneos_internos_control_vehiculos"  
										   type="hidden"  value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del régimen fiscal-->
									<input id="txtRegimenFiscalID_trabajos_foraneos_internos_control_vehiculos" 
										   name="intRegimenFiscalID_trabajos_foraneos_internos_control_vehiculos"  type="hidden" 
										   value="">
									</input>
									<label for="txtOrdenCompra_trabajos_foraneos_internos_control_vehiculos">Orden de compra</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtOrdenCompra_trabajos_foraneos_internos_control_vehiculos" 
											name="strOrdenCompra_trabajos_foraneos_internos_control_vehiculos" 
											type="text" value="" tabindex="1" placeholder="Ingrese orden" maxlength="250" />
								</div>
							</div>	
						</div>
						<!--Proveedor-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtProveedor_trabajos_foraneos_internos_control_vehiculos">Proveedor</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtProveedor_trabajos_foraneos_internos_control_vehiculos" 
											name="strProveedor_trabajos_foraneos_internos_control_vehiculos" 
											type="text" value=""/>
								</div>
							</div>
						</div>
						<!-- Factura -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFactura_trabajos_foraneos_internos_control_vehiculos">Factura</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtFactura_trabajos_foraneos_internos_control_vehiculos" 
											name="strFactura_trabajos_foraneos_internos_control_vehiculos" 
											type="text" value="" tabindex="1" placeholder="Ingrese factura" maxlength="10" />
								</div>
							</div>	
						</div>
						<!--Total de unidades-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTotalUnidades_trabajos_foraneos_internos_control_vehiculos">Total de unidades</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control cantidad_trabajos_foraneos_internos_control_vehiculos" id="txtTotalUnidades_trabajos_foraneos_internos_control_vehiculos" 
											name="intTotalUnidades_trabajos_foraneos_internos_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese total de unidades" maxlength="21">
									</input>
								</div>
							</div>
						</div>
						<!--Total-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteTotal_trabajos_foraneos_internos_control_vehiculos">Importe total</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_trabajos_foraneos_internos_control_vehiculos" id="txtImporteTotal_trabajos_foraneos_internos_control_vehiculos" 
												name="intImporteTotal_trabajos_foraneos_internos_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23">
										</input>
										
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
									<label for="txtObservaciones_trabajos_foraneos_internos_control_vehiculos">Observaciones</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtObservaciones_trabajos_foraneos_internos_control_vehiculos" 
											name="strObservaciones_trabajos_foraneos_internos_control_vehiculos" 
											type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250" />			
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
									<input id="txtNumDetalles_trabajos_foraneos_internos_control_vehiculos" 
										   name="intNumDetalles_trabajos_foraneos_internos_control_vehiculos" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles del trabajo foráneo</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Concepto-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el renglón del registro-->
																<input id="txtRenglon_detalles_trabajos_foraneos_internos_control_vehiculos" 
																	   name="intRenglon_detalles_trabajos_foraneos_internos_control_vehiculos" 
																	   type="hidden" value="">
																</input>

																<label for="txtConcepto_detalles_trabajos_foraneos_internos_control_vehiculos">
																	Concepto
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtConcepto_detalles_trabajos_foraneos_internos_control_vehiculos" 
																		name="strConcepto_detalles_trabajos_foraneos_internos_control_vehiculos" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_trabajos_foraneos_internos_control_vehiculos" 
																		id="txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos" 
																		name="intCantidad_detalles_trabajos_foraneos_internos_control_vehiculos" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="14" />
															</div>
														</div>
													</div>
													<!--Costo unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCostoUnitario_detalles_trabajos_foraneos_internos_control_vehiculos">Costo unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCostoUnitario_detalles_trabajos_foraneos_internos_control_vehiculos" 
																		name="intCostoUnitario_detalles_trabajos_foraneos_internos_control_vehiculos" 
																		type="text" value="" disabled/>
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el descuento unitario-->
																<input id="txtDescuentoUnitario_detalles_trabajos_foraneos_internos_control_vehiculos" 
																	   name="intDescuentoUnitario_detalles_trabajos_foraneos_internos_control_vehiculos"  
																	   type="hidden" value="">
															    </input>
																<label for="txtPorcentajeDescuento_detalles_trabajos_foraneos_internos_control_vehiculos">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeDescuento_detalles_trabajos_foraneos_internos_control_vehiculos" 
																		name="intPorcentajeDescuento_detalles_trabajos_foraneos_internos_control_vehiculos" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IVA-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeIva_detalles_trabajos_foraneos_internos_control_vehiculos">IVA %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtPorcentajeIva_detalles_trabajos_foraneos_internos_control_vehiculos" 
																		name="intPorcentajeIva_detalles_trabajos_foraneos_internos_control_vehiculos" 
																		type="text" value="" disabled/>
															</div>
														</div>
													</div>
													<!--Porcentaje del IEPS-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
															 	<!-- Caja de texto oculta para recuperar el tipo de la tasa o cuota del impuesto de IEPS-->	
																<input id="txtTipoTasaCuotaIeps_detalles_trabajos_foraneos_internos_control_vehiculos" 
																	   name="strTipoTasaCuotaIeps_detalles_trabajos_foraneos_internos_control_vehiculos" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el factor de la tasa o cuota del impuesto de IEPS-->
																<input id="txtFactorTasaCuotaIeps_detalles_trabajos_foraneos_internos_control_vehiculos" 
																	   name="strFactorTasaCuotaIeps_detalles_trabajos_foraneos_internos_control_vehiculos" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el IEPS unitario-->
																<input id="txtIepsUnitario_detalles_trabajos_foraneos_internos_control_vehiculos" 
																	   name="intIepsUnitario_detalles_trabajos_foraneos_internos_control_vehiculos" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIeps_detalles_trabajos_foraneos_internos_control_vehiculos">IEPS %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtPorcentajeIeps_detalles_trabajos_foraneos_internos_control_vehiculos" 
																		name="intPorcentajeIeps_detalles_trabajos_foraneos_internos_control_vehiculos" 
																		type="text" value=""  disabled/>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_detalles_trabajos_foraneos_internos_control_vehiculos"
					                                			onclick="agregar_renglon_detalles_trabajos_foraneos_internos_control_vehiculos();" 
					                                	     	title="Agregar" tabindex="1"> 
					                                		<span class="glyphicon glyphicon-plus"></span>
					                                	</button>
					                             	</div>
												</div>
											</div>
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_trabajos_foraneos_internos_control_vehiculos">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Concepto</th>
																<th class="movil">Cantidad</th>
																<th class="movil">Costo Unit.</th>
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
																	<strong id="acumCantidad_detalles_trabajos_foraneos_internos_control_vehiculos"></strong>
																</td>
																<td class="movil t3"></td>
																<td class="movil t4">
																	<strong id="acumDescuento_detalles_trabajos_foraneos_internos_control_vehiculos"></strong>
																</td>
																<td class="movil t5">
																	<strong id="acumSubtotal_detalles_trabajos_foraneos_internos_control_vehiculos"></strong>
																</td>
																<td class="movil t6">
																	<strong id="acumIva_detalles_trabajos_foraneos_internos_control_vehiculos"></strong>
																</td>
																<td class="movil t7">
																	<strong  id="acumIeps_detalles_trabajos_foraneos_internos_control_vehiculos"></strong>
																</td>
																<td class="movil t8">
																	<strong id="acumTotal_detalles_trabajos_foraneos_internos_control_vehiculos"></strong>
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
																<strong id="numElementos_detalles_trabajos_foraneos_internos_control_vehiculos">0</strong> encontrados
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--Retención de ISR (proveedor)-->
							<div id="divRetencionIsr_trabajos_foraneos_internos_control_vehiculos"  class="col-sm-6 col-md-6 col-lg-6 col-xs-12 pull-right no-mostrar">
									<div class="form-group">
											<!--Porcentaje de ISR-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<input id="txtPorcentajeRetencionID_trabajos_foraneos_internos_control_vehiculos" name="intPorcentajeRetencionID_trabajos_foraneos_internos_control_vehiculos" type="hidden" value="">
														</input>
														<label for="txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos">Retención de ISR %</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control" id="txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos" 
																name="intPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos" type="text" value="" 
																tabindex="1" placeholder="Ingrese retención de ISR" maxlength="250">
														</input>
													</div>
												</div>
											</div>
											<!--Importe retenido-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<label for="txtImporteRetenido_trabajos_foraneos_internos_control_vehiculos">Importe de ISR</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control moneda_trabajos_foraneos_internos_control_vehiculos" id="txtImporteRetenido_trabajos_foraneos_internos_control_vehiculos" 
																name="intImporteRetenido_trabajos_foraneos_internos_control_vehiculos" type="text" value="" 
																tabindex="1"  placeholder="Ingrese importe" maxlength="18">
														</input>
													</div>
											</div>
										</div>
									</div>
							</div><!--Fin del div Retención de ISR (proveedor)--->
						</div>
					</div> 
					<!--Circulo de progreso-->
                    <div id="divCirculoBarProgreso_trabajos_foraneos_internos_control_vehiculos" class="load-container load5 circulo_bar no-mostrar">
                        <div class="loader">Loading...</div>
                        <br><br>
                        <div align=center><b>Espere un momento por favor.</b></div>
                    </div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_trabajos_foraneos_internos_control_vehiculos"  
									onclick="validar_trabajos_foraneos_internos_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_trabajos_foraneos_internos_control_vehiculos"  
									onclick="reporte_registro_trabajos_foraneos_internos_control_vehiculos('');"  
									title="Imprimir" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_trabajos_foraneos_internos_control_vehiculos"  
									onclick="cambiar_estatus_trabajos_foraneos_internos_control_vehiculos('', '', '');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_trabajos_foraneos_internos_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_trabajos_foraneos_internos_control_vehiculos();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#TrabajosForaneosInternosControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaTrabajosForaneosInternosControlVehiculos = 0;
		var strUltimaBusquedaTrabajosForaneosInternosControlVehiculos = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
		var strTipoReferenciaTrabajosForaneosInternosControlVehiculos = "TRABAJO FORANEO INTERNO";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
		var intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos = <?php echo NUM_DECIMALES_MOSTRAR_SERVICIO ?>;
		//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
		var intNumDecimalesCantidadBDTrabajosForaneosInternosControlVehiculos = <?php echo NUM_DECIMALES_CANTIDAD_TF_SERVICIO ?>;
		var intNumDecimalesCostoUnitBDTrabajosForaneosInternosControlVehiculos = <?php echo NUM_DECIMALES_COSTO_UNIT_TF_SERVICIO ?>;
		var intNumDecimalesDescUnitBDTrabajosForaneosInternosControlVehiculos = <?php echo NUM_DECIMALES_DESCUENTO_UNIT_TF_SERVICIO ?>;
		var intNumDecimalesIvaUnitBDTrabajosForaneosInternosControlVehiculos = <?php echo NUM_DECIMALES_IVA_UNIT_TF_SERVICIO ?>;
		var intNumDecimalesIepsUnitBDTrabajosForaneosInternosControlVehiculos = <?php echo NUM_DECIMALES_IEPS_UNIT_TF_SERVICIO ?>;
		var intNumDecimalesPrecioUnitBDTrabajosForaneosInternosControlVehiculos = <?php echo NUM_DECIMALES_PRECIO_UNIT_TF_SERVICIO ?>;
		//Variable que se utiliza para asignar el id del porcentaje de retención ISR base
		var intPorcentajeRetencionBaseIDTrabajosForaneosInternosControlVehiculos = <?php echo PORCENTAJE_ISR_BASE ?>;
		//Variable que se utiliza para asignar el id del régimen fiscal: Régimen Simplificado de Confianza
		var intRegimenFiscalIDResicoTrabajosForaneosInternosControlVehiculos = <?php echo REGIMEN_FISCAL_RESICO ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objTrabajosForaneosInternosControlVehiculos = null;

		
		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_trabajos_foraneos_internos_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/trabajos_foraneos_internos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_trabajos_foraneos_internos_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosTrabajosForaneosInternosControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosTrabajosForaneosInternosControlVehiculos = strPermisosTrabajosForaneosInternosControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosTrabajosForaneosInternosControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosTrabajosForaneosInternosControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_trabajos_foraneos_internos_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosTrabajosForaneosInternosControlVehiculos[i]=='GUARDAR') || (arrPermisosTrabajosForaneosInternosControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_trabajos_foraneos_internos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosTrabajosForaneosInternosControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_trabajos_foraneos_internos_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_trabajos_foraneos_internos_control_vehiculos();
						}
						else if(arrPermisosTrabajosForaneosInternosControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_trabajos_foraneos_internos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosTrabajosForaneosInternosControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_trabajos_foraneos_internos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosTrabajosForaneosInternosControlVehiculos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_trabajos_foraneos_internos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosTrabajosForaneosInternosControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_trabajos_foraneos_internos_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_trabajos_foraneos_internos_control_vehiculos() 
		{
		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaTrabajosForaneosInternosControlVehiculos =($('#txtFechaInicialBusq_trabajos_foraneos_internos_control_vehiculos').val()+$('#txtFechaFinalBusq_trabajos_foraneos_internos_control_vehiculos').val()+$('#txtProveedorIDBusq_trabajos_foraneos_internos_control_vehiculos').val()+$('#cmbEstatusBusq_trabajos_foraneos_internos_control_vehiculos').val()+$('#txtBusqueda_trabajos_foraneos_internos_control_vehiculos').val());

			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaTrabajosForaneosInternosControlVehiculos != strUltimaBusquedaTrabajosForaneosInternosControlVehiculos)
			{
				intPaginaTrabajosForaneosInternosControlVehiculos = 0;
				strUltimaBusquedaTrabajosForaneosInternosControlVehiculos = strNuevaBusquedaTrabajosForaneosInternosControlVehiculos;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/trabajos_foraneos_internos/get_paginacion',
					{ //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					  dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_trabajos_foraneos_internos_control_vehiculos').val()),
					  dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_trabajos_foraneos_internos_control_vehiculos').val()),
					  intProveedorID: $('#txtProveedorIDBusq_trabajos_foraneos_internos_control_vehiculos').val(),
					  strEstatus: $('#cmbEstatusBusq_trabajos_foraneos_internos_control_vehiculos').val(),
					  strBusqueda: $('#txtBusqueda_trabajos_foraneos_internos_control_vehiculos').val(),
					  intPagina: intPaginaTrabajosForaneosInternosControlVehiculos,
					  strPermisosAcceso: $('#txtAcciones_trabajos_foraneos_internos_control_vehiculos').val()
					},
					function(data){
						$('#dg_trabajos_foraneos_internos_control_vehiculos tbody').empty();
						var tmpTrabajosForaneosInternosControlVehiculos = Mustache.render($('#plantilla_trabajos_foraneos_internos_control_vehiculos').html(),data);
						$('#dg_trabajos_foraneos_internos_control_vehiculos tbody').html(tmpTrabajosForaneosInternosControlVehiculos);
						$('#pagLinks_trabajos_foraneos_internos_control_vehiculos').html(data.paginacion);
						$('#numElementos_trabajos_foraneos_internos_control_vehiculos').html(data.total_rows);
						intPaginaTrabajosForaneosInternosControlVehiculos = data.pagina;
					},
			'json');
		}

		//Regresar el porcentaje de retención ISR base
		function cargar_porcentaje_isr_base_trabajos_foraneos_internos_control_vehiculos()
		{

				$.ajax({
	                 //Hacer un llamado al método del controlador para regresar los datos del registro
	                 url: "contabilidad/porcentaje_retencion_isr/get_datos",
	                 type: "post",
	                 dataType: "json",
	                 async: false,
	                 data: {
	                   strBusqueda: intPorcentajeRetencionBaseIDTrabajosForaneosInternosControlVehiculos,
	                   strTipo: 'id'
	                 },
	                 success: function( data ) {
	                   if(data.row){
								
								//Recuperar valores
								$('#txtPorcentajeRetencionID_trabajos_foraneos_internos_control_vehiculos').val(data.row.porcentaje_retencion_id);
								$('#txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos').val(data.row.porcentaje);
					        }

	                    }
	               });
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_trabajos_foraneos_internos_control_vehiculos(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'control_vehiculos/trabajos_foraneos_internos/';

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
			if ($('#chbImprimirDetalles_trabajos_foraneos_internos_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_trabajos_foraneos_internos_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_trabajos_foraneos_internos_control_vehiculos').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_trabajos_foraneos_internos_control_vehiculos').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_trabajos_foraneos_internos_control_vehiculos').val()),
										'intProveedorID': $('#txtProveedorIDBusq_trabajos_foraneos_internos_control_vehiculos').val(),
										'strEstatus': $('#cmbEstatusBusq_trabajos_foraneos_internos_control_vehiculos').val(), 
										'strBusqueda': $('#txtBusqueda_trabajos_foraneos_internos_control_vehiculos').val(),
										'strDetalles': $('#chbImprimirDetalles_trabajos_foraneos_internos_control_vehiculos').val()				
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_trabajos_foraneos_internos_control_vehiculos(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtTrabajoForaneoInternoID_trabajos_foraneos_internos_control_vehiculos').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
            objReporte = {'url': 'control_vehiculos/trabajos_foraneos_internos/get_reporte_registro',
                            'data' : {
                                        'intTrabajoForaneoInternoID': intID
                                     }
                           };

            //Hacer un llamado a la función para imprimir el reporte
            $.imprimirReporte(objReporte);
		}

		
		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_trabajos_foraneos_internos_control_vehiculos()
		{
			//Incializar formulario
			$('#frmTrabajosForaneosInternosControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_trabajos_foraneos_internos_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmTrabajosForaneosInternosControlVehiculos').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_trabajos_foraneos_internos_control_vehiculos').val(fechaActual()); 
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_trabajos_foraneos_internos_control_vehiculos();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_trabajos_foraneos_internos_control_vehiculos');
			//Habilitar todos los elementos del formulario
			$('#frmTrabajosForaneosInternosControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			
			//Deshabilitar las siguientes cajas de texto			
			var arrCajasTexto  = {
									//Son los id de los input que se van a deshabilitar
									rows: [	'#txtFolio_trabajos_foraneos_internos_control_vehiculos',
											'#txtMoneda_trabajos_foraneos_internos_control_vehiculos',	
											'#txtTipoCambio_trabajos_foraneos_internos_control_vehiculos',	
											'#txtReferencia_trabajos_foraneos_internos_control_vehiculos',
											'#txtProveedor_trabajos_foraneos_internos_control_vehiculos',
											'#txtConcepto_detalles_trabajos_foraneos_internos_control_vehiculos',
											'#txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos',
											'#txtCostoUnitario_detalles_trabajos_foraneos_internos_control_vehiculos',
											'#txtPorcentajeDescuento_detalles_trabajos_foraneos_internos_control_vehiculos',
											'#txtPorcentajeIva_detalles_trabajos_foraneos_internos_control_vehiculos',
											'#txtPorcentajeIeps_detalles_trabajos_foraneos_internos_control_vehiculos'
										],
									//Es asignar un attributo disbaled|checked
									attribute: 'disabled',
									//Bool es para deshabilitar
									bool: true
								};
			//Hacer un llamado a la función para deshabilitar cajas de texto		
			$.habilitar_deshabilitar_campos(arrCajasTexto);
 			//Mostrar los siguientes botones
			$("#btnGuardar_trabajos_foraneos_internos_control_vehiculos").show();
			//Habilitar botón Agregar
			$('#btnAgregar_detalles_trabajos_foraneos_internos_control_vehiculos').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_trabajos_foraneos_internos_control_vehiculos").hide();
			$("#btnDesactivar_trabajos_foraneos_internos_control_vehiculos").hide();

			//Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_trabajos_foraneos_internos_control_vehiculos();
		}

		
		//Función para inicializar elementos de la orden de compra
		function inicializar_orden_compra_trabajos_foraneos_internos_control_vehiculos()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtMonedaID_trabajos_foraneos_internos_control_vehiculos').val('');
			$('#txtMoneda_trabajos_foraneos_internos_control_vehiculos').val('');
			$('#txtTipoCambio_trabajos_foraneos_internos_control_vehiculos').val('');
            $('#txtProveedor_trabajos_foraneos_internos_control_vehiculos').val('');
            $('#txtFactura_trabajos_foraneos_internos_control_vehiculos').val('');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_trabajos_foraneos_internos_control_vehiculos();

		    //Limpiar contenido de las siguientes cajas de texto
            $('#txtRegimenFiscalID_trabajos_foraneos_internos_control_vehiculos').val('');
            $('#txtPorcentajeRetencionID_trabajos_foraneos_internos_control_vehiculos').val('');
            $('#txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos').val('');
            $('#txtImporteRetenido_trabajos_foraneos_internos_control_vehiculos').val('');

            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
	        mostrar_retencion_isr_trabajos_foraneos_internos_control_vehiculos();
		}
																	

		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_trabajos_foraneos_internos_control_vehiculos()
		{
			//Hacer un llamado a la función para inicializar elementos del concepto (detalle)
			inicializar_concepto_detalles_trabajos_foraneos_internos_control_vehiculos();

			//Eliminar los datos de la tabla detalles del trabajo foráneo interno
			$('#dg_detalles_trabajos_foraneos_internos_control_vehiculos tbody').empty();
			$('#acumCantidad_detalles_trabajos_foraneos_internos_control_vehiculos').html('');
		    $('#acumDescuento_detalles_trabajos_foraneos_internos_control_vehiculos').html('');
		    $('#acumSubtotal_detalles_trabajos_foraneos_internos_control_vehiculos').html('');
		    $('#acumIva_detalles_trabajos_foraneos_internos_control_vehiculos').html('');
		    $('#acumIeps_detalles_trabajos_foraneos_internos_control_vehiculos').html('');
		    $('#acumTotal_detalles_trabajos_foraneos_internos_control_vehiculos').html('');
			$('#numElementos_detalles_trabajos_foraneos_internos_control_vehiculos').html(0);
			$('#txtNumDetalles_trabajos_foraneos_internos_control_vehiculos').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_trabajos_foraneos_internos_control_vehiculos()
		{
			try {

				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_trabajos_foraneos_internos_control_vehiculos('');
				//Cerrar modal
				objTrabajosForaneosInternosControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_trabajos_foraneos_internos_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_trabajos_foraneos_internos_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_trabajos_foraneos_internos_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmTrabajosForaneosInternosControlVehiculos')
				.bootstrapValidator({	excluded: [':disabled'],
									 	container: 'popover',
									 	feedbackIcons: {
									 		valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
									  	},
									  	fields: {
											strFecha_trabajos_foraneos_internos_control_vehiculos: {
												validators: {
													notEmpty: {message: 'Seleccione una fecha'}
												}
											},
											strOrdenReparacionInterna_trabajos_foraneos_internos_control_vehiculos: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la orden de reparación interna
						                                    if($('#txtOrdenReparacionInternaID_trabajos_foraneos_internos_control_vehiculos').val() === '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba una orden de trabajo existente'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
											strOrdenCompra_trabajos_foraneos_internos_control_vehiculos: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la orden de compra
						                                    if($('#txtOrdenCompraID_trabajos_foraneos_internos_control_vehiculos').val() === '')
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
											intPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
							                                    //Verificar que exista el id del porcentaje de retención ISR
							                                    if(parseInt($('#txtRegimenFiscalID_trabajos_foraneos_internos_control_vehiculos').val()) === intRegimenFiscalIDResicoTrabajosForaneosInternosControlVehiculos)
							                                    {
							                                    	if(value === '')
							                                    	{
							                                    		return {
							                                           	 valid: false,
							                                            	message: 'Escriba una retención de ISR existente'
							                                        	};
							                                    	}
								                                      		
							                                    }
						                                    	return true;
						                                    }
						                                }
						                            }
											},
											intImporteRetenido_trabajos_foraneos_internos_control_vehiculos: {
												excluded: false,  // No ignorar (permite validar campo deshabilitado)
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
							                                    //Verificar que exista el id del porcentaje de retención ISR
							                                    if(parseInt($('#txtRegimenFiscalID_trabajos_foraneos_internos_control_vehiculos').val()) === intRegimenFiscalIDResicoTrabajosForaneosInternosControlVehiculos)
							                                    {
							                                    	if(value === '')
							                                    	{
							                                    		return {
							                                           	 valid: false,
							                                            	message: 'Escriba un importe'
							                                        	};
							                                    	}
								                                      		
							                                    }
						                                    	return true;
						                                    }
						                                }
						                            }
											},
											strFactura_trabajos_foraneos_internos_control_vehiculos: {
												validators: {
													notEmpty: {message: 'Escriba una factura'}
												}
											},
											intTotalUnidades_trabajos_foraneos_internos_control_vehiculos: {
												validators: {
													notEmpty: {message: 'Escriba el total de unidades'}
												}
											},
											intImporteTotal_trabajos_foraneos_internos_control_vehiculos: {
												validators: {
													notEmpty: {message: 'Escriba el importe total'}
												}
											},
											intNumDetalles_trabajos_foraneos_internos_control_vehiculos: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que existan detalles
						                                    if(parseInt(value) === 0 || value === '')
						                                    {
						                                    	return {
						                                            valid: false,
						                                            message: 'Agregar al menos un detalle para este trabajo foráneo.'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
										    strConcepto_detalles_trabajos_foraneos_internos_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intCantidad_detalles_trabajos_foraneos_internos_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intCostoUnitario_detalles_trabajos_foraneos_internos_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intPorcentajeDescuento_detalles_trabajos_foraneos_internos_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)   
										    },
										    intPorcentajeIva_detalles_trabajos_foraneos_internos_control_vehiculos: {
										        excluded: true  // Ignorar (no valida el campo)   
										    },
										    intPorcentajeIeps_detalles_trabajos_foraneos_internos_control_vehiculos: 
										    {
										        excluded: true  // Ignorar (no valida el campo)   
										    }
										}
									});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_trabajos_foraneos_internos_control_vehiculos = $('#frmTrabajosForaneosInternosControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_trabajos_foraneos_internos_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_trabajos_foraneos_internos_control_vehiculos.isValid())
			{

				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesTrabajosForaneosInternosControlVehiculos = $.reemplazar($('#acumTotal_detalles_trabajos_foraneos_internos_control_vehiculos').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesTrabajosForaneosInternosControlVehiculos = $.reemplazar(intAcumTotalDetallesTrabajosForaneosInternosControlVehiculos, ",", "");

				var intImporteTotalTrabajosForaneosInternosControlVehiculos = $.reemplazar($('#txtImporteTotal_trabajos_foraneos_internos_control_vehiculos').val(), ",", "");


				//Verificar que el total de unidades sea igual a la cantidad de detalles
				if($('#acumCantidad_detalles_trabajos_foraneos_internos_control_vehiculos').html() != $('#txtTotalUnidades_trabajos_foraneos_internos_control_vehiculos').val())
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_trabajos_foraneos_internos_control_vehiculos('error', 'El total de unidades no coincide con los detalles, favor de verificar.');
					
				}
				//Verificar que el importe total sea igual al total de detalles
				else if(intAcumTotalDetallesTrabajosForaneosInternosControlVehiculos != intImporteTotalTrabajosForaneosInternosControlVehiculos)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_trabajos_foraneos_internos_control_vehiculos('error', 'El importe total no coincide con los detalles, favor de verificar.');
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_trabajos_foraneos_internos_control_vehiculos();
				}
			
			}
			else 
				return;
		}


		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_trabajos_foraneos_internos_control_vehiculos()
		{
			try
			{
				$('#frmTrabajosForaneosInternosControlVehiculos').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_trabajos_foraneos_internos_control_vehiculos()
		{
			
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_trabajos_foraneos_internos_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrConceptos = [];
			var arrCantidades = [];
			var arrCostosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrTasaCuotaIva = [];
			var arrIvasUnitarios = [];
			var arrTasaCuotaIeps = [];
			var arrIepsUnitarios = [];

			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioTrabajo = parseFloat($('#txtTipoCambio_trabajos_foraneos_internos_control_vehiculos').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad =  $.reemplazar(objRen.cells[1].innerHTML, ",", "");
				var intCostoUnitario = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[16].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[17].innerHTML, ",", "");

				//Calcular iva unitario
				intIvaUnitario =  intIvaUnitario / intCantidad;
				//Calcular ieps unitario
				intIepsUnitario = intIepsUnitario / intCantidad;

				//Convertir importes a peso mexicano
				intCostoUnitario = intCostoUnitario * intTipoCambioTrabajo;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioTrabajo;
				intIvaUnitario = intIvaUnitario * intTipoCambioTrabajo;
				intIepsUnitario = intIepsUnitario * intTipoCambioTrabajo;

				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{	
					//Restar descuento al costo unitario
					intCostoUnitario = intCostoUnitario - intDescuentoUnitario;
				}

				//Redondear cantidad a decimales
				intIvaUnitario = intIvaUnitario.toFixed(intNumDecimalesIvaUnitBDTrabajosForaneosInternosControlVehiculos);
				intIvaUnitario = parseFloat(intIvaUnitario);

				//Redondear cantidad a decimales
				intIepsUnitario = intIepsUnitario.toFixed(intNumDecimalesIepsUnitBDTrabajosForaneosInternosControlVehiculos);
				intIepsUnitario = parseFloat(intIepsUnitario);

				//Asignar valores a los arrays
				arrConceptos.push(objRen.cells[0].innerHTML);
				arrCantidades.push(intCantidad);
				arrCostosUnitarios.push(intCostoUnitario);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrTasaCuotaIva.push(objRen.cells[12].innerHTML);
				arrIvasUnitarios.push(intIvaUnitario);
				arrTasaCuotaIeps.push(objRen.cells[13].innerHTML);
				arrIepsUnitarios.push(intIepsUnitario);
			}


			//Variable que se utiliza para asignar el importe retenido de ISR (proveedor)
			var intRetencionIsrProv =  parseFloat($.reemplazar($('#txtImporteRetenido_trabajos_foraneos_internos_control_vehiculos').val(), ",", ""));

			//Si existe retención de ISR (proveedor)
			if(intRetencionIsrProv > 0)
			{
				//Convertir importes a peso mexicano
				intRetencionIsrProv = intRetencionIsrProv * intTipoCambioTrabajo;
				//Redondear cantidad a decimales
				intRetencionIsrProv = intRetencionIsrProv.toFixed(intNumDecimalesIvaUnitBDTrabajosForaneosInternosControlVehiculos);
				intRetencionIsrProv = parseFloat(intRetencionIsrProv);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/trabajos_foraneos_internos/guardar',
					{ 
						//Datos del trabajo foráneo interno
						intTrabajoForaneoInternoID: $('#txtTrabajoForaneoInternoID_trabajos_foraneos_internos_control_vehiculos').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_trabajos_foraneos_internos_control_vehiculos').val()),
						intMonedaID: $('#txtMonedaID_trabajos_foraneos_internos_control_vehiculos').val(),
						intTipoCambio: intTipoCambioTrabajo,
						strFactura: $('#txtFactura_trabajos_foraneos_internos_control_vehiculos').val(),
						intOrdenCompraID: $('#txtOrdenCompraID_trabajos_foraneos_internos_control_vehiculos').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_trabajos_foraneos_internos_control_vehiculos').val(),
						intPorcentajeRetencionID: $('#txtPorcentajeRetencionID_trabajos_foraneos_internos_control_vehiculos').val(),
						intImporteRetenido: intRetencionIsrProv,
						intOrdenReparacionInternaID: $('#txtOrdenReparacionInternaID_trabajos_foraneos_internos_control_vehiculos').val(),
						strObservaciones: $('#txtObservaciones_trabajos_foraneos_internos_control_vehiculos').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_trabajos_foraneos_internos_control_vehiculos').val(),
						//Datos de los detalles
						strConceptos: arrConceptos.join('|'), 
						strCantidades: arrCantidades.join('|'),
						strCostosUnitarios: arrCostosUnitarios.join('|'),
						strDescuentosUnitarios: arrDescuentosUnitarios.join('|'),
						strTasaCuotaIva: arrTasaCuotaIva.join('|'),
						strIvasUnitarios: arrIvasUnitarios.join('|'),
						strTasaCuotaIeps: arrTasaCuotaIeps.join('|'),
						strIepsUnitarios: arrIepsUnitarios.join('|')
					},
					function(data) {
						if (data.resultado)
						{	
			               //Si no existe id del trabajo foráneo, significa que es un nuevo registro   
							if($('#txtTrabajoForaneoInternoID_trabajos_foraneos_internos_control_vehiculos').val() == '')
							{
							  	//Asignar el id del trabajo foráneo registrado en la base de datos
                     			$('#txtTrabajoForaneoInternoID_trabajos_foraneos_internos_control_vehiculos').val(data.trabajo_foraneo_interno_id);
                 			}

			                //Hacer llamado a la función  para cargar  los registros en el grid
			               	paginacion_trabajos_foraneos_internos_control_vehiculos();

			               	//Hacer un llamado a la función para generar póliza con los datos del registro
							generar_poliza_trabajos_foraneos_internos_control_vehiculos('', '');
						}

						//Si existe mensaje de error
						if(data.tipo_mensaje == 'error')
						{
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_trabajos_foraneos_internos_control_vehiculos(data.tipo_mensaje, data.mensaje);
					    }
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_trabajos_foraneos_internos_control_vehiculos(tipoMensaje, mensaje)
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
		function cambiar_estatus_trabajos_foraneos_internos_control_vehiculos(id, polizaID, folioPoliza)
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
				intID = $('#txtTrabajoForaneoInternoID_trabajos_foraneos_internos_control_vehiculos').val();
				intPolizaID = $('#txtPolizaID_trabajos_foraneos_internos_control_vehiculos').val();
				strFolioPoliza = $('#txtFolioPoliza_trabajos_foraneos_internos_control_vehiculos').val();

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
			              'title':    'Trabajos Foráneos para Servicios Internos',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
			                              $.post('control_vehiculos/trabajos_foraneos_internos/set_estatus',
			                                     {intTrabajoForaneoInternoID: intID, 
			                                      intPolizaID: intPolizaID
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                          //Hacer llamado a la función  para cargar  los registros en el grid
			                                          paginacion_trabajos_foraneos_internos_control_vehiculos();

			                                          	//Si el id del registro se obtuvo del modal
														if(id == '')
														{
															//Hacer un llamado a la función para cerrar modal
															cerrar_trabajos_foraneos_internos_control_vehiculos();     
														}
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_trabajos_foraneos_internos_control_vehiculos(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_trabajos_foraneos_internos_control_vehiculos(id, tipoAccion)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/trabajos_foraneos_internos/get_datos',
			       {intTrabajoForaneoInternoID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_trabajos_foraneos_internos_control_vehiculos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar el id de la póliza
				            var intPolizaID = parseInt(data.row.poliza_id); 
				            //Variable que se utiliza para asignar la referencia (vehículo/serie)
					        var strReferencia = '';


					        //Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);

				            //Variable que se utiliza para asignar el importe retenido de ISR (proveedor)
				            var intRetencionIsrProv = parseFloat(data.row.importe_retenido);

				           //Si existe retención de ISR (proveedor)
				           if(intRetencionIsrProv > 0)
				           {
				           		//Convertir peso mexicano a tipo de cambio
								intRetencionIsrProv = intRetencionIsrProv / intTipoCambio;

				           }


					        //Si existe id del vehículo
							if(data.row.vehiculo_id > 0)
							{
								//Asignar datos del vehículo
								strReferencia =  data.row.vehiculo;
							}
							else
							{
								//Asignar serie
								strReferencia =  data.row.serie;
							}

				          	//Recuperar valores
				            $('#txtTrabajoForaneoInternoID_trabajos_foraneos_internos_control_vehiculos').val(data.row.trabajo_foraneo_interno_id);
				            $('#txtFolio_trabajos_foraneos_internos_control_vehiculos').val(data.row.folio);
				            $('#txtFecha_trabajos_foraneos_internos_control_vehiculos').val(data.row.fecha);
				            $('#txtMonedaID_trabajos_foraneos_internos_control_vehiculos').val(data.row.moneda_id);
				            $('#txtMoneda_trabajos_foraneos_internos_control_vehiculos').val(data.row.moneda);
				            $('#txtTipoCambio_trabajos_foraneos_internos_control_vehiculos').val(data.row.tipo_cambio);
				            $('#txtFactura_trabajos_foraneos_internos_control_vehiculos').val(data.row.factura);
				            $('#txtOrdenCompraID_trabajos_foraneos_internos_control_vehiculos').val(data.row.orden_compra_id);
				            $('#txtOrdenCompra_trabajos_foraneos_internos_control_vehiculos').val(data.row.folio_orden_compra);
				            $('#txtRegimenFiscalID_trabajos_foraneos_internos_control_vehiculos').val(data.row.regimen_fiscal_id);
						    $('#txtPorcentajeRetencionID_trabajos_foraneos_internos_control_vehiculos').val(data.row.porcentaje_retencion_id);
						    $('#txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos').val(data.row.porcentaje_isr);
						    $('#txtImporteRetenido_trabajos_foraneos_internos_control_vehiculos').val(intRetencionIsrProv);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporteRetenido_trabajos_foraneos_internos_control_vehiculos').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos });
						    $('#txtProveedor_trabajos_foraneos_internos_control_vehiculos').val(data.row.proveedor);
				            $('#txtOrdenReparacionInternaID_trabajos_foraneos_internos_control_vehiculos').val(data.row.orden_reparacion_interna_id);
						    $('#txtOrdenReparacionInterna_trabajos_foraneos_internos_control_vehiculos').val(data.row.folio_orden_reparacion);
						    $('#txtReferencia_trabajos_foraneos_internos_control_vehiculos').val(strReferencia);
						    $('#txtObservaciones_trabajos_foraneos_internos_control_vehiculos').val(data.row.observaciones);
						    $('#txtPolizaID_trabajos_foraneos_internos_control_vehiculos').val(intPolizaID);
						    $('#txtFolioPoliza_trabajos_foraneos_internos_control_vehiculos').val(data.row.folio_poliza);
						    //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_trabajos_foraneos_internos_control_vehiculos').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_trabajos_foraneos_internos_control_vehiculos").show();


				            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	    				 mostrar_retencion_isr_trabajos_foraneos_internos_control_vehiculos();

				            //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmTrabajosForaneosInternosControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
				            	//Deshabilitar botón Agregar
								$('#btnAgregar_detalles_trabajos_foraneos_internos_control_vehiculos').prop('disabled', true);
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_trabajos_foraneos_internos_control_vehiculos").hide();

					            //Si existe el id de la póliza
				            	if(strEstatus == 'ACTIVO' && intPolizaID > 0)
				            	{
				            		//Mostrar el botón Desactivar
				            		$("#btnDesactivar_trabajos_foraneos_internos_control_vehiculos").show();
				            	}
				            }
				            else
				            {
				            	
				            	//Habilitar las siguientes cajas de texto
				            	$("#txtProductoServicio_detalles_trabajos_foraneos_internos_control_vehiculos").removeAttr('disabled');
				            	$("#txtUnidad_detalles_trabajos_foraneos_internos_control_vehiculos").removeAttr('disabled');
				            	$("#txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos").removeAttr('disabled');
				            	$("#txtPorcentajeGanancia_detalles_trabajos_foraneos_internos_control_vehiculos").removeAttr('disabled');
				            }

							//Mostramos los detalles del registro
			                if(data.detalles)
			                {
		         		   		//Hacer llamado a la función  para cargar los detalles del registro en el grid
	             		    	lista_detalles_trabajos_foraneos_internos_control_vehiculos(tipoAccion, strEstatus, data.detalles);
	             			} 
							
			            	//Abrir modal
							objTrabajosForaneosInternosControlVehiculos = $('#TrabajosForaneosInternosControlVehiculosBox').bPopup({
														   appendTo: '#TrabajosForaneosInternosControlVehiculosContent', 
							                               contentContainer: 'TrabajosForaneosInternosControlVehiculosM', 
							                               zIndex: 2, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});

					    	//Enfocar caja de texto
							$('#txtOrdenReparacionInterna_trabajos_foraneos_internos_control_vehiculos').focus();
			       	    }
			       },
			       'json');
		}


		//Función para regresar obtener los datos de una orden de compra
		function get_datos_orden_compra_trabajos_foraneos_internos_control_vehiculos()
		{
			  //Hacer un llamado al método del controlador para regresar los datos de la orden de compra
	          $.post('cuentas_pagar/ordenes_compra/get_datos',
	          { 
	          		intOrdenCompraID: $("#txtOrdenCompraID_trabajos_foraneos_internos_control_vehiculos").val()
	          },
	              function(data) {
	                if(data.row){

	                	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
						inicializar_detalles_trabajos_foraneos_internos_control_vehiculos();
	                	//Recuperar valores
	         			$('#txtOrdenCompra_trabajos_foraneos_internos_control_vehiculos').val(data.row.folio);
	         			$('#txtMonedaID_trabajos_foraneos_internos_control_vehiculos').val(data.row.moneda_id);
	         			$('#txtMoneda_trabajos_foraneos_internos_control_vehiculos').val(data.row.moneda);
			            $('#txtTipoCambio_trabajos_foraneos_internos_control_vehiculos').val(data.row.tipo_cambio);
			            $('#txtFactura_trabajos_foraneos_internos_control_vehiculos').val(data.row.factura);
	         		    $('#txtProveedor_trabajos_foraneos_internos_control_vehiculos').val(data.row.proveedor);
	         		    $('#txtPorcentajeRetencionID_trabajos_foraneos_internos_control_vehiculos').val(data.row.porcentaje_retencion_id);
						$('#txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos').val(data.row.porcentaje_isr);
						  	
						//Variable que se utiliza para asignar el tipo de cambio
		            	var intTipoCambio = parseFloat(data.row.tipo_cambio);
             		  
             		    //Variable que se utiliza para asignar el id del régimen fiscal de la orden de compra
             		    var intRegimenFiscalIDOC = data.row.regimen_fiscal_id;
             		     //Variable que se utiliza para asignar el id del régimen fiscal del proveedor
             		    var intRegimenFiscalIDProv = data.row.regimenFiscalIDProv;

             		     //Variable que se utiliza para asignar el importe retenido de ISR (proveedor)
			            var intRetencionIsrProv = parseFloat(data.row.importe_retenido);

             		    //Si no existe el id del régimen fiscal de la orden de compra
             		    if(intRegimenFiscalIDOC == '')
             		    {
             		      //Asignar el id del régimen fiscal del proveedor (tabla proveedores)
             		      $('#txtRegimenFiscalID_trabajos_foraneos_internos_control_vehiculos').val(intRegimenFiscalIDProv);

             		       //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
   	    				   mostrar_retencion_isr_trabajos_foraneos_internos_control_vehiculos('cargar_isr');
   	    				  
             		    }
             		    else
             		    {
             		    	//Asignar el id del régimen fiscal de la orden de compra (tabla ordenes_compra_refacciones)
             		    	$('#txtRegimenFiscalID_trabajos_foraneos_internos_control_vehiculos').val(intRegimenFiscalIDOC);

             		    	//Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
   	    				    mostrar_retencion_isr_trabajos_foraneos_internos_control_vehiculos();
             		    }


	         		    //Cargar refacciones adherentes a la orden de compra seleccionada
		                if(data.detalles)
		                {
	         		   		//Hacer llamado a la función  para cargar los detalles del registro en el grid
             		    	lista_detalles_trabajos_foraneos_internos_control_vehiculos('Nuevo', '', data.detalles);
             			}


             			//Si existe retención de ISR (proveedor)
			           if(intRetencionIsrProv > 0)
			           {
			           		//Convertir peso mexicano a tipo de cambio
							intRetencionIsrProv = intRetencionIsrProv / intTipoCambio;

						    $('#txtImporteRetenido_trabajos_foraneos_internos_control_vehiculos').val(intRetencionIsrProv);
             		        //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
				            $('#txtImporteRetenido_trabajos_foraneos_internos_control_vehiculos').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos });

			           }

	                }
	            }
	             ,
	            'json');

		}


		//Función para mostrar u ocultar div que contiene el campo de retención de ISR (proveedor)
		function mostrar_retencion_isr_trabajos_foraneos_internos_control_vehiculos(strTipo)
		{
			//Si se cumple la sentencia
			if(strTipo == 'cargar_isr')
			{

				//Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
	       	     if(parseInt( $('#txtRegimenFiscalID_trabajos_foraneos_internos_control_vehiculos').val()) == intRegimenFiscalIDResicoTrabajosForaneosInternosControlVehiculos)
	       	     {
	       	     	//Hacer un llamado a la función para cargar el porcentaje de retención ISR base
	       			cargar_porcentaje_isr_base_trabajos_foraneos_internos_control_vehiculos();
	       	     }

			}

			//Si el gasto tiene retención de ISR
            if(parseInt($('#txtRegimenFiscalID_trabajos_foraneos_internos_control_vehiculos').val()) == intRegimenFiscalIDResicoTrabajosForaneosInternosControlVehiculos)
            {
            	//Quitar clase no-mostrar para mostrar div que contiene la retención de ISR (proveedor)
			  	$('#divRetencionIsr_trabajos_foraneos_internos_control_vehiculos').removeClass("no-mostrar");

            }
            else
            {
            	//Agregar clase no-mostrar para ocultar div que contiene la retención de ISR (proveedor)
			    $('#divRetencionIsr_trabajos_foraneos_internos_control_vehiculos').addClass("no-mostrar");
            }

		}


		//Función para habilitar y deshabilitar los campos del detalle cuando cambia la orden de compra
		function habilitar_elementos_orden_compra_detalles_trabajos_foraneos_internos_control_vehiculos(campo){
			//Deshabilitar o habilitar las siguientes cajas de texto			
			var arrCajasTexto  = {
						//Son los id de los input que se van a habilitar o deshabilitar
						rows:['#txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos'
							  ],
						//Es asignar un attributo disbaled|checked
						attribute: 'disabled',									
					};						
			($(campo).val() && $('#txtOrdenCompra_trabajos_foraneos_internos_control_vehiculos').val())? arrCajasTexto.bool = false: arrCajasTexto.bool= true;								
			//Hacer un llamado a la función para habilitar o deshabilitar cajas de texto				
			$.habilitar_deshabilitar_campos(arrCajasTexto);
		}


		//Función para generar póliza con los datos de un registro
		function generar_poliza_trabajos_foraneos_internos_control_vehiculos(id, formulario)
		{	

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtTrabajoForaneoInternoID_trabajos_foraneos_internos_control_vehiculos').val();
			}
			else
			{
				intID = id;
				strTipo = 'gridview';
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_trabajos_foraneos_internos_control_vehiculos(formulario);
			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaTrabajosForaneosInternosControlVehiculos, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_trabajos_foraneos_internos_control_vehiculos').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_trabajos_foraneos_internos_control_vehiculos(formulario);
			
			    //Si existe resultado
				if (data.resultado)
				{
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_trabajos_foraneos_internos_control_vehiculos();

					//Si el id del registro se obtuvo del modal
					if(strTipo == 'modal')
					{
						//Hacer un llamado a la función para cerrar modal
			            cerrar_trabajos_foraneos_internos_control_vehiculos();
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
			            								cerrar_trabajos_foraneos_internos_control_vehiculos();
	                                                 }
	                                                }]
	                                  });
				}
				else
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    	mensaje_trabajos_foraneos_internos_control_vehiculos(data.tipo_mensaje, data.mensaje);
				}
			  
				
		     },
		     'json');

		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function mostrar_circulo_carga_trabajos_foraneos_internos_control_vehiculos(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_trabajos_foraneos_internos_control_vehiculos';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_trabajos_foraneos_internos_control_vehiculos';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}


		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function ocultar_circulo_carga_trabajos_foraneos_internos_control_vehiculos(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_trabajos_foraneos_internos_control_vehiculos';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_trabajos_foraneos_internos_control_vehiculos';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos del concepto (detalle)
		function inicializar_concepto_detalles_trabajos_foraneos_internos_control_vehiculos()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_detalles_trabajos_foraneos_internos_control_vehiculos').val('');
			$('#txtConcepto_detalles_trabajos_foraneos_internos_control_vehiculos').val('');
			$('#txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos').val('');
		    $('#txtCostoUnitario_detalles_trabajos_foraneos_internos_control_vehiculos').val('');
		    $('#txtDescuentoUnitario_trabajos_foraneos_internos_control_vehiculos').val('');
		    $('#txtPorcentajeDescuento_detalles_trabajos_foraneos_internos_control_vehiculos').val('');
		    $('#txtPorcentajeIva_detalles_trabajos_foraneos_internos_control_vehiculos').val('');
		    $('#txtPorcentajeIeps_detalles_trabajos_foraneos_internos_control_vehiculos').val('');
		    $('#txtIepsUnitario_detalles_trabajos_foraneos_internos_control_vehiculos').val('');
		    $('#txtTipoTasaCuotaIeps_detalles_trabajos_foraneos_internos_control_vehiculos').val('');
			$('#txtFactorTasaCuotaIeps_detalles_trabajos_foraneos_internos_control_vehiculos').val('');
		}

		//Función para la búsqueda de detalles del registro
		function lista_detalles_trabajos_foraneos_internos_control_vehiculos(tipoAccion, estatus, objDetalles) 
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Si se cumple la sentencia
			if(estatus == '' || (estatus == 'ACTIVO' && tipoAccion == 'Editar'))
			{
				strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
								    "	onclick='editar_renglon_detalles_trabajos_foraneos_internos_control_vehiculos(this)'>" + 
									"<span class='glyphicon glyphicon-edit'></span></button>";
			}

		
	       		//Variable que se utiliza para asignar el tipo de cambio
	            var intTipoCambio = parseFloat($('#txtTipoCambio_trabajos_foraneos_internos_control_vehiculos').val());

	            //Mostramos los detalles del registro
	            for (var intCon in objDetalles) 
	            {
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_detalles_trabajos_foraneos_internos_control_vehiculos').getElementsByTagName('tbody')[0];

					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaConcepto = objRenglon.insertCell(0);
					var objCeldaCantidad = objRenglon.insertCell(1);
					var objCeldaCostoUnitario = objRenglon.insertCell(2);
					var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
					var objCeldaSubtotal = objRenglon.insertCell(4);
					var objCeldaIva = objRenglon.insertCell(5);
					var objCeldaIeps = objRenglon.insertCell(6);
					var objCeldaTotal = objRenglon.insertCell(7);
					var objCeldaAcciones = objRenglon.insertCell(8);
					//Columnas ocultas
					var objCeldaPorcentajeDescuento = objRenglon.insertCell(9);
					var objCeldaPorcentajeIva = objRenglon.insertCell(10);
					var objCeldaPorcentajeIeps = objRenglon.insertCell(11);
					var objCeldaTasaCuotaIva = objRenglon.insertCell(12);
					var objCeldaTasaCuotaIeps = objRenglon.insertCell(13);
					var objCeldaCostoUnitarioBD = objRenglon.insertCell(14);
					var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(15);
					var objCeldaIvaBD = objRenglon.insertCell(16);
					var objCeldaIepsBD = objRenglon.insertCell(17);
					var objCeldaIepsUnitario = objRenglon.insertCell(18);
					var objCeldaTipoTasaCuotaIeps = objRenglon.insertCell(19);
					var objCeldaFactorTasaCuotaIeps = objRenglon.insertCell(20);

					//Variables que se utilizan para asignar valores del detalle
					var intCantidad = parseFloat(objDetalles[intCon].cantidad);
					var intCostoUnitario = parseFloat(objDetalles[intCon].costo_unitario);
					var intDescuentoUnitario = parseFloat(objDetalles[intCon].descuento_unitario);
					var intIvaUnitario = parseFloat(objDetalles[intCon].iva_unitario);
					var intTasaCuotaIeps = objDetalles[intCon].tasa_cuota_ieps;
					var intIepsUnitario = parseFloat(objDetalles[intCon].ieps_unitario);
					var intImporteIva = 0;
					var intImporteIeps = 0;
					var intImporteIepsBD = 0;
					var intPorcentajeDescuento = 0;
					var intPorcentajeIeps = '';
					var strTipoTasaCuotaIeps = objDetalles[intCon].tipo_ieps;
					var strFactorTasaCuotaIeps = objDetalles[intCon].factor_ieps;
					var intPorcentajeGanancia = '';
					var intSubtotal = 0;
					var intTotal = 0;
					
					//Si el tipo de acción corresponde a Nuevo
					if(tipoAccion == 'Nuevo')
					{
						//Asignar precio unitario del detalle de la orden de compra
						intCostoUnitario =  parseFloat(objDetalles[intCon].precio_unitario);
					}


					//Asignar costo unitario
					intSubtotal = intCostoUnitario;

					//Convertir peso mexicano a tipo de cambio
					intSubtotal = intSubtotal / intTipoCambio;
					intCostoUnitario = intCostoUnitario / intTipoCambio;
					intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
					intIvaUnitario = intIvaUnitario / intTipoCambio;
					intIepsUnitario = intIepsUnitario / intTipoCambio;

					//Si existe importe del descuento
					if(intDescuentoUnitario > 0)
					{
						//Incrementar costo unitario
						intCostoUnitario = intCostoUnitario + intDescuentoUnitario;
						//Calcular porcentaje del descuento
						intPorcentajeDescuento = (intDescuentoUnitario / intCostoUnitario) * 100;
					}

					//Calcular subtotal
					intSubtotal = intCantidad * intSubtotal;

					//Calcular importe de IVA
					intImporteIva =  intIvaUnitario * intCantidad;

					//Si existe importe Tasa cuota del impuesto de IEPS
					if(intTasaCuotaIeps > 0)
					{
						intPorcentajeIeps = objDetalles[intCon].porcentaje_ieps;
						//Calcular importe de IEPS
						intImporteIeps =  intIepsUnitario * intCantidad;
						//Asignar importe de IEPS
					   	intImporteIepsBD =  intImporteIeps;	
						
						//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
						if(strTipoTasaCuotaIeps == 'RANGO' && strFactorTasaCuotaIeps == 'Cuota')
						{
							//Incrementar al subtotal el  importe de IEPS
							intSubtotal += intImporteIeps;
							//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
							intImporteIeps = 0;
						}
						
					}

					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;

	                //Cambiar cantidad a  formato moneda (a visualizar)
	        	    intCantidad =  formatMoney(intCantidad, intNumDecimalesCantidadBDTrabajosForaneosInternosControlVehiculos, '');

	        	    var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDTrabajosForaneosInternosControlVehiculos, '');

	        	    var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDTrabajosForaneosInternosControlVehiculos, '');

	        	    var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');

	        	    var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');
						
					var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');
						
					var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');
						
					intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDTrabajosForaneosInternosControlVehiculos, '');

	        	    //Cambiar cantidad a  formato moneda (a guardar en la  BD)
	        	    var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDTrabajosForaneosInternosControlVehiculos, '');

	       			var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDTrabajosForaneosInternosControlVehiculos, '');
						
					var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDTrabajosForaneosInternosControlVehiculos, '');
						
					intImporteIepsBD  =  formatMoney(intImporteIepsBD, intNumDecimalesIepsUnitBDTrabajosForaneosInternosControlVehiculos, '');

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id',objDetalles[intCon].renglon);
					objCeldaConcepto.setAttribute('class', 'movil b1');
					objCeldaConcepto.innerHTML = objDetalles[intCon].concepto;
					objCeldaCantidad.setAttribute('class', 'movil b2');
					objCeldaCantidad.innerHTML = intCantidad;
					objCeldaCostoUnitario.setAttribute('class', 'movil b3');
					objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
					objCeldaDescuentoUnitario.setAttribute('class', 'movil b4');
					objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitarioMostrar;
					objCeldaSubtotal.setAttribute('class', 'movil b5');
					objCeldaSubtotal.innerHTML = intSubtotalMostrar;
					objCeldaIva.setAttribute('class', 'movil b6');
					objCeldaIva.innerHTML = intImporteIvaMostrar;
					objCeldaIeps.setAttribute('class', 'movil b7');
					objCeldaIeps.innerHTML = intImporteIepsMostrar;
					objCeldaTotal.setAttribute('class', 'movil b8');
					objCeldaTotal.innerHTML = intTotalMostrar;
					objCeldaAcciones.setAttribute('class', 'td-center movil b9');
					objCeldaAcciones.innerHTML = strAccionesTabla;
					objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento;
					objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
				    objCeldaPorcentajeIva.innerHTML =  objDetalles[intCon].porcentaje_iva;
					objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
					//Columnas ocultas que se utilizan para guardar información en la BD
					objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIva.innerHTML = objDetalles[intCon].tasa_cuota_iva;
					objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIeps.innerHTML = intTasaCuotaIeps;
					objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaCostoUnitarioBD.innerHTML =  intCostoUnitarioBD;
					objCeldaDescuentoUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaDescuentoUnitarioBD.innerHTML =  intDescuentoUnitarioBD;
					objCeldaIvaBD.setAttribute('class', 'no-mostrar');
					objCeldaIvaBD.innerHTML =  intImporteIvaBD;
					objCeldaIepsBD.setAttribute('class', 'no-mostrar');
					objCeldaIepsBD.innerHTML =  intImporteIepsBD;
					objCeldaIepsUnitario.setAttribute('class', 'no-mostrar');
					objCeldaIepsUnitario.innerHTML =  intIepsUnitario;
					objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTipoTasaCuotaIeps.innerHTML =  strTipoTasaCuotaIeps;
					objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaFactorTasaCuotaIeps.innerHTML = strFactorTasaCuotaIeps;
					
	            }

	            //Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_trabajos_foraneos_internos_control_vehiculos();
	            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_trabajos_foraneos_internos_control_vehiculos tr").length - 2;
				$('#numElementos_detalles_trabajos_foraneos_internos_control_vehiculos').html(intFilas);
				$('#txtNumDetalles_trabajos_foraneos_internos_control_vehiculos').val(intFilas);

		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_trabajos_foraneos_internos_control_vehiculos()
		{
			//Variable que se utiliza para asignar el subtotal (costo unitario en la tabla movimientos_refacciones_internas_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asigna el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			var intImporteIepsBD  = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_detalles_trabajos_foraneos_internos_control_vehiculos').val();
			var intCantidad =  $('#txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos').val();
			var intCostoUnitario =  $('#txtCostoUnitario_detalles_trabajos_foraneos_internos_control_vehiculos').val();
			var intDescuentoUnitario = $('#txtDescuentoUnitario_detalles_trabajos_foraneos_internos_control_vehiculos').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_trabajos_foraneos_internos_control_vehiculos').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_trabajos_foraneos_internos_control_vehiculos').val();
			var intPorcentajeGanancia = $('#txtPorcentajeGanancia_detalles_trabajos_foraneos_internos_control_vehiculos').val();
			var strTipoTasaCuotaIeps = $('#txtTipoTasaCuotaIeps_detalles_trabajos_foraneos_internos_control_vehiculos').val();
		    var strFactorTasaCuotaIeps = $('#txtFactorTasaCuotaIeps_detalles_trabajos_foraneos_internos_control_vehiculos').val();
			var intIepsUnitario = $('#txtIepsUnitario_detalles_trabajos_foraneos_internos_control_vehiculos').val();
			
			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_trabajos_foraneos_internos_control_vehiculos').getElementsByTagName('tbody')[0];

			//Si existe ID del renglón
			if (intRenglon != '' )
			{
				//Validamos que se capturaron datos
				if (intCantidad == '')
				{
					//Enfocar caja de texto
					$('#txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos').focus();
				}
				else
				{
					//Hacer un llamado a la función para inicializar elementos del detalle
		            inicializar_concepto_detalles_trabajos_foraneos_internos_control_vehiculos();

		            //Convertir cadena de texto a número decimal
					intCostoUnitario = parseFloat($.reemplazar(intCostoUnitario, ",", ""));
					intDescuentoUnitario = parseFloat($.reemplazar(intDescuentoUnitario, ",", ""));
					intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
					intSubtotal = intCostoUnitario;

					//Si existe descuento unitario
					if(intDescuentoUnitario > 0)
					{
						//Decrementar descuento unitario
						intSubtotal = intSubtotal - intDescuentoUnitario;
					}

					//Calcular subtotal
					intSubtotal = intCantidad * intSubtotal;
					//Redondear cantidad a decimales
					intSubtotal = intSubtotal.toFixed(intNumDecimalesPrecioUnitBDTrabajosForaneosInternosControlVehiculos);
					intSubtotal = parseFloat(intSubtotal);
					
					//Calcular importe de IVA
					intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);

					//Redondear cantidad a dos decimales
				    intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaUnitBDTrabajosForaneosInternosControlVehiculos);
				    intImporteIva = parseFloat(intImporteIva);

					//Si existe porcentaje de IEPS
					if(intPorcentajeIeps != '')
					{
						//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
						if(strTipoTasaCuotaIeps == 'RANGO' && strFactorTasaCuotaIeps == 'Cuota')
						{
							//Asignar importe de IEPS unitario
						    intIepsUnitario = parseFloat($.reemplazar(intIepsUnitario, ",", ""));
						    //Calcular importe de IEPS
							intImporteIeps = parseFloat(intCantidad * intIepsUnitario);

							//Redondear cantidad a  decimales
							intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDTrabajosForaneosInternosControlVehiculos);
					   	 	intImporteIeps = parseFloat(intImporteIeps);

					   	 	//Asignar importe de IEPS
					   		intImporteIepsBD =  intImporteIeps;

							//Incrementar al subtotal el  importe de IEPS
							intSubtotal += intImporteIeps;
					   	 	//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
					   	 	intImporteIeps = 0;
					   	 
						}
						else
						{
							//Calcular importe de IEPS
							intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
							//Redondear cantidad a  decimales
							intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDTrabajosForaneosInternosControlVehiculos);
					   	 	intImporteIeps = parseFloat(intImporteIeps);
					   	 	//Asignar importe de IEPS
					   		intImporteIepsBD =  intImporteIeps;
						}
					}
					

					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;

					//Cambiar cantidad a  formato moneda (a visualizar)
					intCantidad =  formatMoney(intCantidad, intNumDecimalesCantidadBDTrabajosForaneosInternosControlVehiculos, '');
					
					var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');
					
					var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');
					
					var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');
					
					var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');
					
					intPorcentajeGanancia  = formatMoney(intPorcentajeGanancia, intNumDecimalesDescUnitBDTrabajosForaneosInternosControlVehiculos, '');

					//Cambiar cantidad a  formato moneda (a guardar en la  BD)
					var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDTrabajosForaneosInternosControlVehiculos, '');
					
					intImporteIepsBD  =  formatMoney(intImporteIepsBD, intNumDecimalesIepsUnitBDTrabajosForaneosInternosControlVehiculos, '');


					//Editar los datos del detalle
					objTabla.rows.namedItem(intRenglon).cells[1].innerHTML = intCantidad;
					objTabla.rows.namedItem(intRenglon).cells[4].innerHTML =  intSubtotalMostrar;
					objTabla.rows.namedItem(intRenglon).cells[5].innerHTML = intImporteIvaMostrar;
					objTabla.rows.namedItem(intRenglon).cells[6].innerHTML = intImporteIepsMostrar;
					objTabla.rows.namedItem(intRenglon).cells[7].innerHTML = intTotalMostrar;
					objTabla.rows.namedItem(intRenglon).cells[16].innerHTML = intImporteIvaBD;
					objTabla.rows.namedItem(intRenglon).cells[17].innerHTML = intImporteIepsBD;
					
					
					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_detalles_trabajos_foraneos_internos_control_vehiculos();
					
				}
			}
			else
			{
				
		    	//Hacer un llamado a la función para inicializar elementos del detalle
		        inicializar_concepto_detalles_trabajos_foraneos_internos_control_vehiculos();

		    	//Enfocar caja de texto
		    	$('#txtProductoServicio_detalles_trabajos_foraneos_internos_control_vehiculos').focus();

			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_trabajos_foraneos_internos_control_vehiculos tr").length - 2;
			$('#numElementos_detalles_trabajos_foraneos_internos_control_vehiculos').html(intFilas);
			$('#txtNumDetalles_trabajos_foraneos_internos_control_vehiculos').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_trabajos_foraneos_internos_control_vehiculos(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalles_trabajos_foraneos_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtConcepto_detalles_trabajos_foraneos_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCostoUnitario_detalles_trabajos_foraneos_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtDescuentoUnitario_detalles_trabajos_foraneos_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtPorcentajeDescuento_detalles_trabajos_foraneos_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[9].innerHTML);
			$('#txtPorcentajeIva_detalles_trabajos_foraneos_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIeps_detalles_trabajos_foraneos_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtIepsUnitario_detalles_trabajos_foraneos_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[18].innerHTML);
			$('#txtTipoTasaCuotaIeps_detalles_trabajos_foraneos_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[19].innerHTML);
			$('#txtFactorTasaCuotaIeps_detalles_trabajos_foraneos_internos_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[20].innerHTML);

			//Enfocar caja de texto
			$('#txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos').focus();
		}



		//Función para calcular totales de la tabla
		function calcular_totales_detalles_trabajos_foraneos_internos_control_vehiculos()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_trabajos_foraneos_internos_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Variable que se utiliza para asignar el acumulado anterior del subtotal (en caso de que existan cambios calcular retención de ISR (proveedor) de lo contrario conservar el importe de retención (puede darse el caso de que el usuario modifique dicho importe))
			var intAcumSubtotalAnterior = $('#acumSubtotal_detalles_trabajos_foraneos_internos_control_vehiculos').html();

			//Variable que se utiliza para contar el número de registros
			var intContReg = 0;


			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));

				//Incrementar contador por cada registro recorridp
				intContReg++;

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, intNumDecimalesCantidadBDTrabajosForaneosInternosControlVehiculos, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, intNumDecimalesDescUnitBDTrabajosForaneosInternosControlVehiculos, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');

			//Asignar los valores
			$('#acumCantidad_detalles_trabajos_foraneos_internos_control_vehiculos').html(intAcumUnidades);
			$('#acumDescuento_detalles_trabajos_foraneos_internos_control_vehiculos').html(intAcumDescuento);
			$('#acumSubtotal_detalles_trabajos_foraneos_internos_control_vehiculos').html(intAcumSubtotal);
			$('#acumIva_detalles_trabajos_foraneos_internos_control_vehiculos').html(intAcumIva);
			$('#acumIeps_detalles_trabajos_foraneos_internos_control_vehiculos').html(intAcumIeps);
			$('#acumTotal_detalles_trabajos_foraneos_internos_control_vehiculos').html(intAcumTotal);


			//Si no existe id del trabajo foráneo, significa que es un nuevo registro
			if($('#txtTrabajoForaneoInternoID_trabajos_foraneos_internos_control_vehiculos').val() == '' && intContReg == 1)
			{
				//Asignar el contador para calcular el isr del único detalle
				intAcumSubtotalAnterior = intContReg;


			}

			//Si hubo cambios en el acumulado del subtotal
			if(intAcumSubtotalAnterior != intAcumSubtotal && intAcumSubtotalAnterior != '')
			{
				//Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_trabajos_foraneos_internos_control_vehiculos();
			}
		}


		//Función que se utiliza para calcular la retención de ISR (proveedor)
		function calcular_isr_trabajos_foraneos_internos_control_vehiculos()
		{
			
			 //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt($('#txtRegimenFiscalID_trabajos_foraneos_internos_control_vehiculos').val()) == intRegimenFiscalIDResicoTrabajosForaneosInternosControlVehiculos)
       	     {
       	     	//Variable que se utiliza para asignar el importe retenido
       	     	var intImporteRetenido = 0;
       	     	//Variable que se utiliza para asignar el acumulado del subtotal
				var intAcumSubtotal = 0;

       	     	//Hacer un llamado a la función para reemplazar '$' y  ','  por cadena vacia
				intAcumSubtotal =  $.reemplazar($('#acumSubtotal_detalles_trabajos_foraneos_internos_control_vehiculos').html(), "$", "");
				intAcumSubtotal =  $.reemplazar(intAcumSubtotal, ",", "");

				//Si existe porcentaje de ISR (proveedor)
				if($('#txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos').val() != '' && intAcumSubtotal > 0 )
				{
					//Variable que se utiliza para asignar el porcentaje de retención ISR
					var intPorcentajeRetencionIsr = parseFloat($('#txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos').val());

					//Calcular retención de ISR 
					intImporteRetenido = parseFloat(intAcumSubtotal * intPorcentajeRetencionIsr);
					//Redondear cantidad a decimales
					intImporteRetenido = intImporteRetenido.toFixed(intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos);
					intImporteRetenido = parseFloat(intImporteRetenido);
				}

				//Convertir cantidad a formato moneda
				intImporteRetenido = formatMoney(intImporteRetenido, intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos, '');

				//Asignar importe retenido 
				$('#txtImporteRetenido_trabajos_foraneos_internos_control_vehiculos').val(intImporteRetenido);

       	     }
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTotalUnidades_trabajos_foraneos_internos_control_vehiculos').numeric();
			$('#txtImporteTotal_trabajos_foraneos_internos_control_vehiculos').numeric();
			$('#txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos').numeric();
			$('#txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos').numeric();
        	$('#txtImporteRetenido_trabajos_foraneos_internos_control_vehiculos').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_trabajos_foraneos_internos_control_vehiculos').blur(function(){
				$('.moneda_trabajos_foraneos_internos_control_vehiculos').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarTrabajosForaneosInternosControlVehiculos });
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_trabajos_foraneos_internos_control_vehiculos').blur(function(){
                $('.cantidad_trabajos_foraneos_internos_control_vehiculos').formatCurrency({ roundToDecimalPlace: intNumDecimalesCantidadBDTrabajosForaneosInternosControlVehiculos });
            });


			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_trabajos_foraneos_internos_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});

	        //Autocomplete para recuperar los datos de una orden de reparación interna 
	        $('#txtOrdenReparacionInterna_trabajos_foraneos_internos_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtOrdenReparacionInternaID_trabajos_foraneos_internos_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/ordenes_reparacion_internas/autocomplete",
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
	              //Asignar valores del registro seleccionado
	              $('#txtOrdenReparacionInternaID_trabajos_foraneos_internos_control_vehiculos').val(ui.item.data);
	              $('#txtReferencia_trabajos_foraneos_internos_control_vehiculos').val(ui.item.referencia);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la orden de reparación interna cuando pierda el enfoque la caja de texto
	        $('#txtOrdenReparacionInterna_trabajos_foraneos_internos_control_vehiculos').focusout(function(e){
	            //Si no existe id de la orden de reparación interna
	            if($('#txtOrdenReparacionInternaID_trabajos_foraneos_internos_control_vehiculos').val() == '' ||
	               $('#txtOrdenReparacionInterna_trabajos_foraneos_internos_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtOrdenReparacionInternaID_trabajos_foraneos_internos_control_vehiculos').val('');
	               $('#txtOrdenReparacionInterna_trabajos_foraneos_internos_control_vehiculos').val('');
	               $('#txtReferencia_trabajos_foraneos_internos_control_vehiculos').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una orden de compra 
	        $('#txtOrdenCompra_trabajos_foraneos_internos_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtOrdenCompraID_trabajos_foraneos_internos_control_vehiculos').val('');
	               //Hacer un llamado a la función para inicializar elementos de la orden de compra
	               inicializar_orden_compra_trabajos_foraneos_internos_control_vehiculos();
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
	              $('#txtOrdenCompraID_trabajos_foraneos_internos_control_vehiculos').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos de la orden de compra
	               get_datos_orden_compra_trabajos_foraneos_internos_control_vehiculos();

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
			//Verificar que exista id de la orden de compra cuando pierda el enfoque la caja de texto
	        $('#txtOrdenCompra_trabajos_foraneos_internos_control_vehiculos').focusout(function(e){
	            //Si no existe id de la orden de compra
	            if($('#txtOrdenCompraID_trabajos_foraneos_internos_control_vehiculos').val() == '' ||
	               $('#txtOrdenCompra_trabajos_foraneos_internos_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtOrdenCompraID_trabajos_foraneos_internos_control_vehiculos').val('');
	               $('#txtOrdenCompra_trabajos_foraneos_internos_control_vehiculos').val('');
	               //Hacer un llamado a la función para inicializar elementos de la orden de compra
	               inicializar_orden_compra_trabajos_foraneos_internos_control_vehiculos();
	            }

            	//Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al detalle de la orden de compra
				habilitar_elementos_orden_compra_detalles_trabajos_foraneos_internos_control_vehiculos('#txtOrdenCompra_trabajos_foraneos_internos_control_vehiculos');
	        });


	        //Autocomplete para recuperar los datos de un porcentaje de retención ISR 
	        $('#txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtPorcentajeRetencionID_trabajos_foraneos_internos_control_vehiculos').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/porcentaje_retencion_isr/autocomplete",
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
	             $('#txtPorcentajeRetencionID_trabajos_foraneos_internos_control_vehiculos').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del porcentaje de retención ISR cuando pierda el enfoque la caja de texto
	        $('#txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtPorcentajeRetencionID_trabajos_foraneos_internos_control_vehiculos').val() == '' ||
	               $('#txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtPorcentajeRetencionID_trabajos_foraneos_internos_control_vehiculos').val('');
	               $('#txtPorcentajeIsr_trabajos_foraneos_internos_control_vehiculos').val('');
	            }

	           //Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_trabajos_foraneos_internos_control_vehiculos();
	            
	        });


			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_trabajos_foraneos_internos_control_vehiculos').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_detalles_trabajos_foraneos_internos_control_vehiculos();
			   	    }
		        }
		    });

			
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_trabajos_foraneos_internos_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_trabajos_foraneos_internos_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY',
			 																		                            useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_trabajos_foraneos_internos_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_trabajos_foraneos_internos_control_vehiculos').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_trabajos_foraneos_internos_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_trabajos_foraneos_internos_control_vehiculos').data('DateTimePicker').maxDate(e.date);
			});
			
			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedorBusq_trabajos_foraneos_internos_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorIDBusq_trabajos_foraneos_internos_control_vehiculos').val('');
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
	             $('#txtProveedorIDBusq_trabajos_foraneos_internos_control_vehiculos').val(ui.item.data);
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
	        $('#txtProveedorBusq_trabajos_foraneos_internos_control_vehiculos').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorIDBusq_trabajos_foraneos_internos_control_vehiculos').val() == '' ||
	               $('#txtProveedorBusq_trabajos_foraneos_internos_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorIDBusq_trabajos_foraneos_internos_control_vehiculos').val('');
	               $('#txtProveedorBusq_trabajos_foraneos_internos_control_vehiculos').val('');
	            }

	        });

	        //Paginación de registros
			$('#pagLinks_trabajos_foraneos_internos_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaTrabajosForaneosInternosControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_trabajos_foraneos_internos_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_trabajos_foraneos_internos_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_trabajos_foraneos_internos_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_trabajos_foraneos_internos_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				objTrabajosForaneosInternosControlVehiculos = $('#TrabajosForaneosInternosControlVehiculosBox').bPopup({
											   appendTo: '#TrabajosForaneosInternosControlVehiculosContent', 
				                               contentContainer: 'TrabajosForaneosInternosControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#txtOrdenReparacionInterna_trabajos_foraneos_internos_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_trabajos_foraneos_internos_control_vehiculos').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_trabajos_foraneos_internos_control_vehiculos();
		});
	</script>