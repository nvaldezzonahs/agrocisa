
	<div id="MovimientosSalidasRefaccionesDevolucionProveedorRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"
				                    		name= "strFechaInicialBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
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
								<label for="txtFechaFinalBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"
				                    		name= "strFechaFinalBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
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
								<input id="txtProveedorIDBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
									   name="intProveedorIDBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"  
									   type="hidden" value="">
								</input>
								<label for="txtProveedorBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProveedorBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
										name="strProveedorBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
								 		name="strEstatusBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" tabindex="1">
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
								<label for="txtBusqueda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
										name="strBusqueda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12  btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
									   	name="strImprimirDetalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
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
							<button class="btn btn-primary" id="btnBuscar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"
									onclick="paginacion_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"
									onclick="reporte_movimientos_salidas_refacciones_devolucion_proveedor_refacciones('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"
									onclick="reporte_movimientos_salidas_refacciones_devolucion_proveedor_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button>  
						</div>
					</div>
				</div>
				<div class="row">

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
				td.movil.a3:nth-of-type(3):before {content: "Entrada"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Proveedor"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles del movimiento
				*/
				td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Costo Unit."; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Desc."; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Total"; font-weight: bold;}
				td.movil.b10:nth-of-type(10):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles del movimiento
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "Desc."; font-weight: bold;}
				td.movil.t6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.t7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.t8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.t9:nth-of-type(9):before {content: "Total"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Entrada</th>
							<th class="movil">Proveedor</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{folio_entrada}}</td>
							<td class="movil a4">{{proveedor}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="td-center movil a6"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones({{movimiento_refacciones_id}}, 'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones({{movimiento_refacciones_id}}, 'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_movimientos_salidas_refacciones_devolucion_proveedor_refacciones({{movimiento_refacciones_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
                                <button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
                                        onclick="generar_poliza_movimientos_salidas_refacciones_devolucion_proveedor_refacciones({{movimiento_refacciones_id}}, 'principal')"  title="Generar póliza">
                                    <span class="glyphicon glyphicon-tags"></span>
                                </button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_movimientos_salidas_refacciones_devolucion_proveedor_refacciones({{movimiento_refacciones_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		 <!--Circulo de progreso-->
        <div id="divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" class="load-container load5 circulo_bar no-mostrar">
            <div class="loader">Loading...</div>
            <br><br>
            <div align=center><b>Espere un momento por favor.</b></div>
        </div>  

		<!-- Diseño del modal-->
		<div id="MovimientosSalidasRefaccionesDevolucionProveedorRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"  class="ModalBodyTitle">
			<h1>Salidas por Devolución al Proveedor</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMovimientosSalidasRefaccionesDevolucionProveedorRefacciones" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMovimientosSalidasRefaccionesDevolucionProveedorRefacciones"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!-- Folio -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMovimientoRefaccionesID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
										   name="intMovimientoRefaccionesID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
										   type="hidden" value="" />
								    <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
                                    <input id="txtPolizaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
                                           name="intPolizaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" type="hidden" value="" />
                                    <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
                                    <input id="txtFolioPoliza_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
                                           name="strFolioPoliza_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" type="hidden" value="" />
									<label for="txtFolio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
											name="strFolio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
											type="text" value="" placeholder="Autogenerado" disabled />
								</div>
							</div>
						</div>
						<!-- Fecha -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_movimientos_salidas_refacciones_devolucion_proveedor_refacciones'>
					                    <input class="form-control" 
					                    		id="txtFecha_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"
					                    		name= "strFecha_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
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
									<input id="txtMonedaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
										   name="intMonedaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"  
										   type="hidden"  value="">
									<label for="txtMoneda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Moneda</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMoneda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
											name="strMoneda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTipoCambio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
											name="intTipoCambio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
											type="text" value="" disabled/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene las entradas de refacciones activas-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la entrada de refacciones seleccionada-->
									<input id="txtReferenciaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
										   name="intReferenciaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"  
										   type="hidden"  value="">
									</input>
									<label for="txtReferencia_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Entrada</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtReferencia_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
											name="strReferencia_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
											type="text" value="" tabindex="1" placeholder="Ingrese entrada" maxlength="250" />
								</div>
							</div>	
						</div>
						<!--Proveedor-->
						<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtProveedor_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Proveedor</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtProveedor_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
											name="strProveedor_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
											type="text" value="" disabled />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- Observaciones -->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Observaciones</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtObservaciones_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
											name="strObservaciones_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
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
									<input id="txtNumDetalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
										   name="intNumDetalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la salida por devolución</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Código-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el renglón de la refacción-->
																<input id="txtRenglon_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																	   name="intRenglon_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar la cantidad de entrada de la refacción-->
																<input id="txtCantidadEntrada_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																	   name="intCantidadEntrada_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar la cantidad devuelta al proveedor-->
																<input id="txtCantidadDevolucion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																	   name="intCantidadDevolucion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar el porcentaje del descuento-->
																<input id="txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																	   name="intPorcentajeDescuento_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar el porcentaje del IVA-->
																<input id="txtPorcentajeIva_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																	   name="intPorcentajeIva_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar el porcentaje del IEPS-->
																<input id="txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																	   name="intPorcentajeIeps_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar la existencia disponible  de la refacción (en el inventario)  seleccionada-->
                                                                <input id="txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
                                                                       name="intDisponibleExistencia_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
                                                                       type="hidden" value="">
                                                                </input>
																<label for="txtCodigo_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																		name="strCodigo_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																		type="text" value="" disabled />
															</div>
														</div>
													</div>
													<!--Descripción-->
													<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDescripcion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">
																	Descripción
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtDescripcion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																		name="strDescripcion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																		type="text" value="" disabled/>
															</div>
														</div>
													</div>
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																		id="txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																		name="intCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="14" />
															</div>
														</div>
													</div>
													<!--Costo unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCostoUnitario_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">Costo unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCostoUnitario_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																		name="intCostoUnitario_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
																		type="text" value="" disabled />
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns" 
					                                			id="btnAgregar_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" 
					                                			onclick="agregar_renglon_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();" 
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
													<table class="table-hover movil" id="dg_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Código</th>
																<th class="movil">Descripción</th>
																<th class="movil">Cantidad</th>
																<th class="movil">Costo Unit.</th>
																<th class="movil">Desc.</th>
																<th class="movil">Subtotal</th>
																<th class="movil">IVA</th>
																<th class="movil">IEPS</th>
																<th class="movil">Total</th>
																<th class="movil" id="th-acciones" style="width:6em;">Acciones</th>
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
																	<strong id="acumCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"></strong>
																</td>
																<td class="movil t4"></td>
																<td class="movil t5">
																	<strong id="acumDescuento_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"></strong>
																</td>
																<td class="movil t6">
																	<strong id="acumSubtotal_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"></strong>
																</td>
																<td class="movil t7">
																	<strong id="acumIva_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"></strong>
																</td>
																<td class="movil t8">
																	<strong  id="acumIeps_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"></strong>
																</td>
																<td class="movil t9">
																	<strong id="acumTotal_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"></strong>
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
																<strong id="numElementos_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones">0</strong> encontrados
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
                    <div id="divCirculoBarProgreso_movimientos_salidas_refacciones_devolucion_proveedor_refacciones" class="load-container load5 circulo_bar no-mostrar">
                        <div class="loader">Loading...</div>
                        <br><br>
                        <div align=center><b>Espere un momento por favor.</b></div>
                    </div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"  
									onclick="validar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"  
									onclick="reporte_registro_movimientos_salidas_refacciones_devolucion_proveedor_refacciones('');"  
									title="Imprimir" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"  
									onclick="cambiar_estatus_movimientos_salidas_refacciones_devolucion_proveedor_refacciones('','','');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MovimientosSalidasRefaccionesDevolucionProveedorRefaccionesContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = 0;
		var strUltimaBusquedaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = "";
		 /*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
        var strTipoReferenciaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = "MOVIMIENTO DE REFACCIONES";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
		var intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
		//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
		var intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = <?php echo NUM_DECIMALES_COSTO_UNIT_MOV_REFACCIONES ?>;
		var intNumDecimalesDescUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = <?php echo NUM_DECIMALES_DESCUENTO_UNIT_MOV_REFACCIONES ?>;
		var intNumDecimalesIvaUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = <?php echo NUM_DECIMALES_IVA_UNIT_MOV_REFACCIONES ?>;
		var intNumDecimalesIepsUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = <?php echo NUM_DECIMALES_IEPS_UNIT_MOV_REFACCIONES ?>;

		//Variable que se utiliza para asignar objeto del modal
		var objMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_movimientos_salidas_refacciones_devolucion_proveedor_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/movimientos_salidas_refacciones_devolucion_proveedor/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = strPermisosMovimientosSalidasRefaccionesDevolucionProveedorRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMovimientosSalidasRefaccionesDevolucionProveedorRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMovimientosSalidasRefaccionesDevolucionProveedorRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMovimientosSalidasRefaccionesDevolucionProveedorRefacciones[i]=='GUARDAR') || (arrPermisosMovimientosSalidasRefaccionesDevolucionProveedorRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesDevolucionProveedorRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
						}
						else if(arrPermisosMovimientosSalidasRefaccionesDevolucionProveedorRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesDevolucionProveedorRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesDevolucionProveedorRefacciones[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosSalidasRefaccionesDevolucionProveedorRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_movimientos_salidas_refacciones_devolucion_proveedor_refacciones() 
		{
		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones =($('#txtFechaInicialBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()+$('#txtFechaFinalBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()+$('#txtProveedorIDBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()+$('#cmbEstatusBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()+$('#txtBusqueda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones != strUltimaBusquedaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones)
			{
				intPaginaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = 0;
				strUltimaBusquedaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = strNuevaBusquedaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/movimientos_salidas_refacciones_devolucion_proveedor/get_paginacion',
					{ //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					  dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()),
					  dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()),
					  intProveedorID: $('#txtProveedorIDBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(),
					  strEstatus:     $('#cmbEstatusBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(),
					  strBusqueda:    $('#txtBusqueda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(),
					  intPagina: intPaginaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones,
					  strPermisosAcceso: $('#txtAcciones_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()
					},
					function(data){
						$('#dg_movimientos_salidas_refacciones_devolucion_proveedor_refacciones tbody').empty();
						var tmpMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = Mustache.render($('#plantilla_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html(),data);
						$('#dg_movimientos_salidas_refacciones_devolucion_proveedor_refacciones tbody').html(tmpMovimientosSalidasRefaccionesDevolucionProveedorRefacciones);
						$('#pagLinks_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html(data.paginacion);
						$('#numElementos_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html(data.total_rows);
						intPaginaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(strTipo) 
		{	
			//Variable que se utiliza para asignar URL (ruta del controlador)
            var strUrl = 'refacciones/movimientos_salidas_refacciones_devolucion_proveedor/';

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
			if ($('#chbImprimirDetalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('NO');
			}

            //Definir encapsulamiento de datos que son necesarios para generar el reporte
            objReporte = {'url': strUrl,
                            'data' : {
                                        'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()),
                                        'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()),
                                        'intProveedorID': $('#txtProveedorIDBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(),
                                        'strEstatus': $('#cmbEstatusBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(), 
                                        'strBusqueda': $('#txtBusqueda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(),
                                        'strDetalles': $('#chbImprimirDetalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()       
                                     }
                           };


            //Hacer un llamado a la función para imprimir/descargar el reporte
            $.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
            objReporte = {'url': 'refacciones/movimientos_salidas_refacciones_devolucion_proveedor/get_reporte_registro',
                            'data' : {
                                        'intMovimientoRefaccionesID': intID
                                     }
                           };

            //Hacer un llamado a la función para imprimir el reporte
            $.imprimirReporte(objReporte);
		}

		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_movimientos_salidas_refacciones_devolucion_proveedor_refacciones()
		{
			//Incializar formulario
			$('#frmMovimientosSalidasRefaccionesDevolucionProveedorRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmMovimientosSalidasRefaccionesDevolucionProveedorRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
            $.removerClasesEncabezado('divEncabezadoModal_movimientos_salidas_refacciones_devolucion_proveedor_refacciones');

			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
			
			//Habilitar todos los elementos del formulario
			$('#frmMovimientosSalidasRefaccionesDevolucionProveedorRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$("#txtMoneda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones").attr('disabled','disabled');
			$("#txtTipoCambio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones").attr('disabled','disabled');
			$('#txtFolio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').attr("disabled", "disabled");
			$('#txtProveedor_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').attr("disabled", "disabled");
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').attr("disabled", "disabled");
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').attr("disabled", "disabled");
			$('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').attr("disabled", "disabled");
			//Habilitar botón Agregar
            $('#btnAgregar_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').prop('disabled', false);
 			//Mostrar los siguientes botones
			$("#btnGuardar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_movimientos_salidas_refacciones_devolucion_proveedor_refacciones").hide();
			$("#btnDesactivar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones").hide();
		}

		

		//Función para inicializar elementos de la entrada de refacciones
		function inicializar_entrada_movimientos_salidas_refacciones_devolucion_proveedor_refacciones()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtMonedaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
			$('#txtMoneda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
            $('#txtTipoCambio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
            $('#txtProveedor_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
           
		}
																	
		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones()
		{
			//Hacer un llamado a la función para inicializar elementos de la refacción
			inicializar_refaccion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();

			//Eliminar los datos de la tabla detalles del movimiento
			$('#dg_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones tbody').empty();
			$('#acumCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html('');
		    $('#acumDescuento_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html('');
		    $('#acumSubtotal_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html('');
		    $('#acumIva_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html('');
		    $('#acumIeps_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html('');
		    $('#acumTotal_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html('');
			$('#numElementos_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html(0);
			$('#txtNumDetalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones()
		{
			try {
				
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_movimientos_salidas_refacciones_devolucion_proveedor_refacciones('');
				//Cerrar modal
				objMovimientosSalidasRefaccionesDevolucionProveedorRefacciones.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmMovimientosSalidasRefaccionesDevolucionProveedorRefacciones')
				.bootstrapValidator({	excluded: [':disabled'],
									 	container: 'popover',
									 	feedbackIcons: {
									 		valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
									  	},
									  	fields: {
											strFecha_movimientos_salidas_refacciones_devolucion_proveedor_refacciones: {
												validators: {
													notEmpty: {message: 'Seleccione una fecha'}
												}
											},
											strReferencia_movimientos_salidas_refacciones_devolucion_proveedor_refacciones: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la entrada de refacciones
						                                    if($('#txtReferenciaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val() === '')
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
											intNumDetalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que existan detalles
						                                    if(parseFloat(value) === 0 || value === '')
						                                    {
						                                    	return {
						                                            valid: false,
						                                            message: 'Agregar al menos una devolución para esta salida.'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
										    intCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones: {
										        excluded: true  // Ignorar (no valida el campo)    
										    }
										}
									});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_movimientos_salidas_refacciones_devolucion_proveedor_refacciones = $('#frmMovimientosSalidasRefaccionesDevolucionProveedorRefacciones').data('bootstrapValidator');
			bootstrapValidator_movimientos_salidas_refacciones_devolucion_proveedor_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_movimientos_salidas_refacciones_devolucion_proveedor_refacciones.isValid())
			{

				//Hacer un llamado a la función para guardar los datos del registro
				guardar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_movimientos_salidas_refacciones_devolucion_proveedor_refacciones()
		{
			try
			{
				$('#frmMovimientosSalidasRefaccionesDevolucionProveedorRefacciones').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRenglon = [];
			var arrRefaccionID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCodigosLineas = [];
			var arrCantidades = [];
			var arrCostosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrTasaCuotaIva = [];
			var arrIvasUnitarios = [];
			var arrTasaCuotaIeps = [];
			var arrIepsUnitarios = [];
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioMovimiento = parseFloat($('#txtTipoCambio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad =  $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intCostoUnitario = $.reemplazar(objRen.cells[16].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[17].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[18].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[19].innerHTML, ",", "");

				//Si existe cantidad a devolver
				if(intCantidad > 0)
				{
					//Calcular iva unitario
					intIvaUnitario =  intIvaUnitario / intCantidad;
					//Calcular ieps unitario
					intIepsUnitario = intIepsUnitario / intCantidad;

					//Convertir importes a peso mexicano
					intCostoUnitario = intCostoUnitario * intTipoCambioMovimiento;
					intDescuentoUnitario = intDescuentoUnitario * intTipoCambioMovimiento;
					intIvaUnitario = intIvaUnitario * intTipoCambioMovimiento;
					intIepsUnitario = intIepsUnitario * intTipoCambioMovimiento;

					//Si existe importe del descuento
					if(intDescuentoUnitario > 0)
					{	
						//Restar descuento al costo unitario
						intCostoUnitario = intCostoUnitario - intDescuentoUnitario;
					}

					//Redondear cantidad a decimales
					intIvaUnitario = intIvaUnitario.toFixed(intNumDecimalesIvaUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones);
					intIvaUnitario = parseFloat(intIvaUnitario);
					
					//Redondear cantidad a decimales
					intIepsUnitario = intIepsUnitario.toFixed(intNumDecimalesIepsUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones);
					intIepsUnitario = parseFloat(intIepsUnitario);

					//Asignar valores a los arrays
					arrRenglon.push(objRen.getAttribute('id'));
					arrRefaccionID.push(objRen.cells[12].innerHTML);
					arrCodigos.push(objRen.cells[0].innerHTML);
					arrDescripciones.push(objRen.cells[1].innerHTML);
					arrCodigosLineas.push(objRen.cells[13].innerHTML);
					arrCantidades.push(intCantidad);
					arrCostosUnitarios.push(intCostoUnitario);
					arrDescuentosUnitarios.push(intDescuentoUnitario);
					arrTasaCuotaIva.push(objRen.cells[14].innerHTML);
					arrIvasUnitarios.push(intIvaUnitario);
					arrTasaCuotaIeps.push(objRen.cells[15].innerHTML);
					arrIepsUnitarios.push(intIepsUnitario );
				}
				
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/movimientos_salidas_refacciones_devolucion_proveedor/guardar',
					{ 
						//Datos del movimiento
						intMovimientoRefaccionesID: $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()),
						intMonedaID: $('#txtMonedaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(),
						intTipoCambio:  intTipoCambioMovimiento,
						intReferenciaID: $('#txtReferenciaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(),
						strObservaciones: $('#txtObservaciones_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(),
						//Datos de los detalles
						strRenglon: arrRenglon.join('|'),
						strRefaccionID: arrRefaccionID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strCodigosLineas: arrCodigosLineas.join('|'),
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

							//Si no existe id del movimiento, significa que es un nuevo registro   
                            if($('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val() == '')
                            {
                                //Asignar el id del movimiento registrado en la base de datos
                                $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.movimiento_refacciones_id);
                            }

		                    //Hacer llamado a la función  para cargar  los registros en el grid
		               		paginacion_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(); 

		               		//Hacer un llamado a la función para generar póliza con los datos del registro
                            generar_poliza_movimientos_salidas_refacciones_devolucion_proveedor_refacciones('', '');
						}

						//Si existe mensaje de error
                        if(data.tipo_mensaje == 'error')
                        {
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(data.tipo_mensaje, data.mensaje);
						}
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(tipoMensaje, mensaje)
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
			else if(tipoMensaje == 'informacion')
			{ 
				//Indicar al usuario el mensaje de información
				new $.Zebra_Dialog(mensaje, {
									'type': 'information',
									'title': 'Información',
									'buttons': [{caption: 'Aceptar',
												 callback: function () {
													//Enfocar caja de texto
													$('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').focus();
												 }
												}]
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
		function cambiar_estatus_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(id, polizaID, folioPoliza)
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
				intID = $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
				intPolizaID = $('#txtPolizaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
                strFolioPoliza = $('#txtFolioPoliza_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();

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
					              'title':    'Salidas por Devolución al Proveedor',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('refacciones/movimientos_salidas_refacciones_devolucion_proveedor/set_estatus',
					                                     {intMovimientoRefaccionesID: intID,
					                                      intPolizaID: intPolizaID
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                          	//Hacer llamado a la función  para cargar  los registros en el grid
					                                          	paginacion_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();

					                                           	//Si el id del registro se obtuvo del modal
		                                                        if(id == '')
		                                                        {
		                                                            //Hacer un llamado a la función para cerrar modal
		                                                            cerrar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();     
		                                                        }
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(id, tipoAccion)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/movimientos_salidas_refacciones_devolucion_proveedor/get_datos',
			       {intMovimientoRefaccionesID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
							 //Asignar el id de la póliza
                            var intPolizaID = parseInt(data.row.poliza_id);
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.movimiento_refacciones_id);
				            $('#txtFolio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.folio);
				            $('#txtFecha_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.fecha);
				            $('#txtMonedaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.moneda_id);
				            $('#txtMoneda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.moneda);
				            $('#txtTipoCambio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.tipo_cambio);
				            $('#txtReferenciaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.referencia_id);
				             $('#txtReferencia_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.folio_entrada);
						    $('#txtProveedor_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.proveedor);
						    $('#txtObservaciones_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.observaciones);
						    $('#txtPolizaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(intPolizaID);
                            $('#txtFolioPoliza_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.folio_poliza);

							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').addClass("estatus-"+strEstatus);
				            //Hacer llamado a la función  para cargar los detalles del registro en el grid
				            lista_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones('Editar', strEstatus, intPolizaID);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_movimientos_salidas_refacciones_devolucion_proveedor_refacciones").show();


				            //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
                            if(tipoAccion == 'Ver')
                            {

                            	//Deshabilitar todos los elementos del formulario
				            	$('#frmMovimientosSalidasRefaccionesDevolucionProveedorRefacciones').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones").hide();
					             //Deshabilitar botón Agregar
                                $('#btnAgregar_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').prop('disabled', true);

                                //Si existe el id de la póliza
                                if(strEstatus == 'ACTIVO' && intPolizaID > 0)
                                {
                                    //Mostrar el botón Desactivar
                                    $("#btnDesactivar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones").show();
                                }
                            }

			            	//Abrir modal
							objMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = $('#MovimientosSalidasRefaccionesDevolucionProveedorRefaccionesBox').bPopup({
														   appendTo: '#MovimientosSalidasRefaccionesDevolucionProveedorRefaccionesContent', 
							                               contentContainer: 'MovimientosSalidasRefaccionesDevolucionProveedorRefaccionesM', 
							                               zIndex: 2, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtReferencia_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').focus();
							
			       	    }
			       },
			       'json');
		}


		//Función para generar póliza con los datos de un registro
        function generar_poliza_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(id, formulario)
        {   

            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Variable que se utiliza para saber si el id se obtuvo desde el modal
            var strTipo = 'modal';
            //Si no existe id, significa que se realizará la modificación desde el modal
            if(id == '')
            {
                intID = $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
            }
            else
            {
                intID = id;
                strTipo = 'gridview';
            }

            //Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
            mostrar_circulo_carga_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(formulario);
            //Hacer un llamado al método del controlador para timbrar los datos del registro
            $.post('contabilidad/generar_polizas/generar_poliza',
             {
                intReferenciaID: intID,
                strTipoReferencia: strTipoReferenciaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, 
                intProcesoMenuID: $('#txtProcesoMenuID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()
             },
             function(data) {

                //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
                ocultar_circulo_carga_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(formulario);
                
                //Si existe resultado
                if (data.resultado)
                {
                    //Hacer llamado a la función para cargar  los registros en el grid
                    paginacion_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();

                    //Si el id del registro se obtuvo del modal
                    if(strTipo == 'modal')
                    {
                        //Hacer un llamado a la función para cerrar modal
                        cerrar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
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
			            								cerrar_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
	                                                 }
	                                                }]
	                                  });
				}
				else
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    	mensaje_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(data.tipo_mensaje, data.mensaje);
				}

                
             },
             'json');

        }

         //Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function mostrar_circulo_carga_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_salidas_refacciones_devolucion_proveedor_refacciones';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_devolucion_proveedor_refacciones';
            }

            //Remover clase para mostrar div que contiene la barra de carga
            $("#"+strCampoID).removeClass('no-mostrar');
        }


        //Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
        //al momento de generar la póliza de un registro
        function ocultar_circulo_carga_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(formulario)
        {
            //Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
            var strCampoID = 'divCirculoBarProgreso_movimientos_salidas_refacciones_devolucion_proveedor_refacciones';

            //Si el Div a mostrar se encuentra en el formulario principal
            if(formulario == 'principal')
            {
                strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_salidas_refacciones_devolucion_proveedor_refacciones';
            }

            //Agregar clase para ocultar div que contiene la barra de carga
            $("#"+strCampoID).addClass('no-mostrar');
        }



		//Función para regresar obtener los datos de una entrada de refacciones
		function get_datos_entrada_movimientos_salidas_refacciones_devolucion_proveedor_refacciones()
		{
			  //Hacer un llamado al método del controlador para regresar los datos del movimiento
	          $.post('refacciones/movimientos_entradas_refacciones_compra/get_datos',
	              { 
	              	intMovimientoRefaccionesID: $("#txtReferenciaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones").val(),
	              },
	              function(data) {
	                if(data.row){
	                	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
						inicializar_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
	                	//Recuperar valores
	         			$('#txtReferencia_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.folio);
	         			$('#txtMonedaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.moneda_id);
	         			$('#txtMoneda_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.moneda);
	         		    $('#txtTipoCambio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.tipo_cambio);
	         		    $('#txtProveedor_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(data.row.proveedor);
	         		    //Hacer llamado a la función  para cargar los detalles del registro en el grid
	         		    lista_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones('Nuevo','','');
	                }
	            }
	             ,
	            'json');	
		}
		

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
			$('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
			$('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
		    $('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
		    $('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
			$('#txtCantidadEntrada_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
			$('#txtCantidadDevolucion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
			$('#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
		}

		//Función para la búsqueda de detalles del registro
		function lista_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(tipoAccion, estatus, polizaID) 
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';
		    //Asignar el id de la póliza
			var intPolizaID = parseInt(polizaID); 

		    //Si se cumple la sentencia
			if(estatus == '' || (estatus == 'ACTIVO' && intPolizaID == 0))
			{
				strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
								 	"	onclick='editar_renglon_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(this)'>" + 
								 	"<span class='glyphicon glyphicon-edit'></span></button>";
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/movimientos_salidas_refacciones_devolucion_proveedor/get_datos_detalles',
			       {intMovimientoRefaccionesID: $('#txtMovimientoRefaccionesID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(),
			       	intReferenciaID: $('#txtReferenciaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val()
			       },
			       function(data) {

			       		//Variable que se utiliza para asignar el tipo de cambio
			            var intTipoCambio = parseFloat($('#txtTipoCambio_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val());

			            //Mostramos los detalles del registro
			            for (var intCon in data.detalles) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').getElementsByTagName('tbody')[0];

							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcion = objRenglon.insertCell(1);
							var objCeldaCantidad = objRenglon.insertCell(2);
							var objCeldaCostoUnitario = objRenglon.insertCell(3);
							var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
							var objCeldaSubtotal = objRenglon.insertCell(5);
							var objCeldaIvaUnitario = objRenglon.insertCell(6);
							var objCeldaIepsUnitario = objRenglon.insertCell(7);
							var objCeldaTotal = objRenglon.insertCell(8);
							var objCeldaAcciones = objRenglon.insertCell(9);
							//Columnas ocultas
							var objCeldaCantidadEntrada = objRenglon.insertCell(10);
							var objCeldaCantidadDevolucion = objRenglon.insertCell(11);
							var objRefaccionID = objRenglon.insertCell(12);
							var objCeldaCodigoLinea = objRenglon.insertCell(13);
							var objCeldaTasaCuotaIva = objRenglon.insertCell(14);
							var objCeldaTasaCuotaIeps = objRenglon.insertCell(15);
							var objCeldaCostoUnitarioBD = objRenglon.insertCell(16);
							var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(17);
							var objCeldaIvaUnitarioBD = objRenglon.insertCell(18);
							var objCeldaIepsUnitarioBD = objRenglon.insertCell(19);
							var objCeldaPorcentajeDescuento = objRenglon.insertCell(20);
							var objCeldaPorcentajeIva = objRenglon.insertCell(21);
							var objCeldaPorcentajeIeps = objRenglon.insertCell(22);
							var objCeldaDisponibleExistencia = objRenglon.insertCell(23);
						

							//Variables que se utilizan para asignar valores del detalle
							var intSubtotal = parseFloat(data.detalles[intCon].costo_unitario);
							var intCantidadSalida =  parseFloat(data.detalles[intCon].cantidad_salida);
							var intCantidadEntrada =  parseFloat(data.detalles[intCon].cantidad_entrada);
							var intCostoUnitario = parseFloat(data.detalles[intCon].costo_unitario);
							var intCantidad = 0;
							var intDescuentoUnitario = 0;
							var intIvaUnitario = 0;
							var intIepsUnitario = 0;
							var intImporteIva = 0;
							var intImporteIeps = 0;
							var intPorcentajeDescuento = 0;
							var intPorcentajeIeps =  '';
							var intTotal = 0;
							//Variable que se utiliza para asignar la cantidad que ha sido devuelta
							var intCantidadDevolucion = parseFloat(data.detalles[intCon].cantidad_devolucion);
							//Variable que se utiliza para asignar la existencia disponible 
							var intDisponibleExistencia = parseFloat(data.detalles[intCon].disponible_existencia);

							//Si el tipo de acción corresponde a Editar
							if(tipoAccion == 'Editar')
							{
								//Asignar valores del detalle correspondiente a la salida
								intDescuentoUnitario = parseFloat(data.detalles[intCon].descuento_unitario_salida);
								intIvaUnitario = parseFloat(data.detalles[intCon].iva_unitario_salida);
								intIepsUnitario = parseFloat(data.detalles[intCon].ieps_unitario_salida);
								intCantidad = intCantidadSalida;

								//Calcular cantidad devuelta
								intCantidadDevolucion -=  intCantidad;
							}
							else
							{
								//Asignar valores del detalle correspondiente a la entrada
								intDescuentoUnitario = parseFloat(data.detalles[intCon].descuento_unitario_entrada);
								intIvaUnitario = parseFloat(data.detalles[intCon].iva_unitario_entrada);
								intIepsUnitario = parseFloat(data.detalles[intCon].ieps_unitario_entrada);

								//Verificar que la cantidad de entrada sea menor o igual que la existencia disponible 
								if(intCantidadEntrada <= intDisponibleExistencia)
								{
									//Cambiar la cantidad de entrada
									intCantidad = intCantidadEntrada;
								}
								
							}


							//Calcular la existencia disponible 
                            intDisponibleExistencia = intCantidad + intDisponibleExistencia;
							

							//Convertir peso mexicano a tipo de cambio
							intSubtotal = intSubtotal / intTipoCambio;
							intCostoUnitario = intCostoUnitario / intTipoCambio;
							intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
							intIvaUnitario = intIvaUnitario / intTipoCambio;
							intIepsUnitario = intIepsUnitario / intTipoCambio;

							//Si existe importe del descuento
							if(intDescuentoUnitario > 0)
							{
								intCostoUnitario = intCostoUnitario + intDescuentoUnitario;
								//Calcular porcentaje del descuento
								intPorcentajeDescuento = (intDescuentoUnitario / intCostoUnitario) * 100;
							}

							//Si el tipo de acción corresponde a Nuevo
							if(tipoAccion == 'Nuevo')
							{
								//Inicializar valores para evitar mostrar los datos de la entrada
								intSubtotal = 0;
								intImporteIva = 0;
								intImporteIeps = 0;
								intTotal = 0;
							}
							else
							{
								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;

								//Si existe importe de IVA unitario
								if(intIvaUnitario > 0)
								{
									//Calcular importe de IVA
									intImporteIva =  intIvaUnitario * intCantidad;
								}

								//Si existe importe de IEPS unitario
								if(intIepsUnitario > 0)
								{
									//Calcular importe de IEPS
									intImporteIeps =  intIepsUnitario * intCantidad;
									intPorcentajeIeps = data.detalles[intCon].porcentaje_ieps;
								}

								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;
							}

							//Cambiar cantidad a  formato moneda (a visualizar)
							intCantidadSalida =  formatMoney(intCantidadSalida, 2, '');

							var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

							var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

							var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

							var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

							var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

							var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');


							intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

							//Cambiar cantidad a  formato moneda (a guardar en la  BD)
							var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');
								
							var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');
								
							var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');
								
							var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');


							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].renglon);
							objCeldaCodigo.setAttribute('class', 'movil b1');
							objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
							objCeldaDescripcion.setAttribute('class', 'movil b2');
							objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
							objCeldaCantidad.setAttribute('class', 'movil b3');
							objCeldaCantidad.innerHTML = intCantidadSalida;
							objCeldaCostoUnitario.setAttribute('class', 'movil b4');
							objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
							objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
							objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitarioMostrar;
							objCeldaSubtotal.setAttribute('class', 'movil b6');
							objCeldaSubtotal.innerHTML = intSubtotalMostrar;
							objCeldaIvaUnitario.setAttribute('class', 'movil b7');
							objCeldaIvaUnitario.innerHTML = intImporteIvaMostrar;
							objCeldaIepsUnitario.setAttribute('class', 'movil b8');
							objCeldaIepsUnitario.innerHTML = intImporteIepsMostrar;
							objCeldaTotal.setAttribute('class', 'movil b9');
							objCeldaTotal.innerHTML = intTotalMostrar;
							objCeldaAcciones.setAttribute('class', 'td-center movil b10');
							objCeldaAcciones.innerHTML = strAccionesTabla;
							objCeldaCantidadEntrada.setAttribute('class', 'no-mostrar');
							objCeldaCantidadEntrada.innerHTML = intCantidadEntrada; 
							objCeldaCantidadDevolucion.setAttribute('class', 'no-mostrar');
							objCeldaCantidadDevolucion.innerHTML = intCantidadDevolucion; 
							objRefaccionID.setAttribute('class', 'no-mostrar');
							objRefaccionID.innerHTML = data.detalles[intCon].refaccion_id; 
							objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
							objCeldaCodigoLinea.innerHTML = data.detalles[intCon].codigo_linea; 
							objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
							objCeldaTasaCuotaIva.innerHTML = data.detalles[intCon].tasa_cuota_iva; 
							objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
							objCeldaTasaCuotaIeps.innerHTML =  data.detalles[intCon].tasa_cuota_ieps;
							objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
							objCeldaCostoUnitarioBD.innerHTML =  intCostoUnitarioBD;
							objCeldaDescuentoUnitarioBD.setAttribute('class', 'no-mostrar');
							objCeldaDescuentoUnitarioBD.innerHTML =  intDescuentoUnitarioBD;
							objCeldaIvaUnitarioBD.setAttribute('class', 'no-mostrar');
							objCeldaIvaUnitarioBD.innerHTML =  intImporteIvaBD;
							objCeldaIepsUnitarioBD.setAttribute('class', 'no-mostrar');
							objCeldaIepsUnitarioBD.innerHTML =  intImporteIepsBD;
							objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
							objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento;
							objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
							objCeldaPorcentajeIva.innerHTML = data.detalles[intCon].porcentaje_iva;
							objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
							objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
							objCeldaDisponibleExistencia.setAttribute('class', 'no-mostrar');
							objCeldaDisponibleExistencia.innerHTML = intDisponibleExistencia; 
							
			            }

			            //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
			            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones tr").length - 2;
						$('#numElementos_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html(intFilas);
			       },
			       'json');

		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones()
		{
			//Variable que se utiliza para asignar el subtotal (costo unitario en la tabla movimientos_refacciones_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asigna el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar la cantidad a devolver
			var intCantidadDevolver = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;
			//Variable que se utiliza para asignar el mensaje informativo
			var strMensaje = '';

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
			var intCantidad = $('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
			var intCostoUnitario = $('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
			
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
			var intCantidadEntrada = $('#txtCantidadEntrada_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
			var intCantidadDevolucion = $('#txtCantidadDevolucion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
			var intDisponibleExistencia = $('#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val();
			
			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').getElementsByTagName('tbody')[0];

			//Si existe ID del renglón
			if (intRenglon != '' )
			{
				//Validamos que se capturaron datos
				if (intCantidad == '')
				{
					//Enfocar caja de texto
					$('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').focus();
				}
				else
				{
					//Convertir cadena de texto a número decimal
					intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
					intSubtotal =  parseFloat($.reemplazar(intCostoUnitario, ",", ""));
					intCantidadEntrada = parseFloat(intCantidadEntrada);
					intCantidadDevolucion = parseFloat(intCantidadDevolucion);
					intDisponibleExistencia = parseFloat(intDisponibleExistencia);

					//Calcular la cantidad a devolver
					intCantidadDevolver = intCantidad + intCantidadDevolucion;

					//Verificar que la cantidad sea menor o igual que la existencia disponible 
					if(intCantidadDevolver <= intCantidadEntrada && intCantidad <= intDisponibleExistencia)
					{
						//Hacer un llamado a la función para inicializar elementos de la refacción
						inicializar_refaccion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
					

						//Si existe porcentaje de descuento
						if(intPorcentajeDescuento > 0)
						{
							//Calcular descuento unitario
							intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;

							//Redondear cantidad a decimales
							intDescuentoUnitario = intDescuentoUnitario.toFixed(intNumDecimalesDescUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones);

							//Decrementar descuento unitario
							intSubtotal = intSubtotal - intDescuentoUnitario;
						}


						//Calcular subtotal
						intSubtotal = intCantidad * intSubtotal;

						//Redondear cantidad a decimales
						intSubtotal = intSubtotal.toFixed(intNumDecimalesCostoUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones);
						intSubtotal = parseFloat(intSubtotal);

						//Calcular importe de IVA
						intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);

						//Redondear cantidad a dos decimales
					    intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones);
					    intImporteIva = parseFloat(intImporteIva);


						//Si existe porcentaje de IEPS
						if(intPorcentajeIeps != '')
						{
							//Calcular importe de IEPS
							intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);

							//Redondear cantidad a dos decimales
			   	 			intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones);
			   	 			intImporteIeps = parseFloat(intImporteIeps);
						}

						//Calcular importe total
						intTotal = parseFloat(intSubtotal + intImporteIva + intImporteIeps);

						//Cambiar cantidad a  formato moneda (a visualizar)
					    intCantidad =  formatMoney(intCantidad, 2, '');

					    var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

					    var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

					    var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

					    var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

					    var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

					    intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

					    //Cambiar cantidad a  formato moneda (a guardar en la  BD)
						var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');
						
						var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');
						
						var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');


						//Editar los datos del detalle
					    objTabla.rows.namedItem(intRenglon).cells[2].innerHTML = intCantidad;
					    objTabla.rows.namedItem(intRenglon).cells[4].innerHTML =  intDescuentoUnitarioMostrar;
					    objTabla.rows.namedItem(intRenglon).cells[5].innerHTML =  intSubtotalMostrar;
					    objTabla.rows.namedItem(intRenglon).cells[6].innerHTML = intImporteIvaMostrar;
						objTabla.rows.namedItem(intRenglon).cells[7].innerHTML = intImporteIepsMostrar;
						objTabla.rows.namedItem(intRenglon).cells[8].innerHTML = intTotalMostrar;
						objTabla.rows.namedItem(intRenglon).cells[17].innerHTML = intDescuentoUnitarioBD;
						objTabla.rows.namedItem(intRenglon).cells[18].innerHTML = intImporteIvaBD;
						objTabla.rows.namedItem(intRenglon).cells[19].innerHTML = intImporteIepsBD;
						objTabla.rows.namedItem(intRenglon).cells[20].innerHTML = intPorcentajeDescuento;
						
					    //Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();

						//Enfocar caja de texto
						$('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').focus();
					}
					else
					{
						
						//Calcular la cantidad a devolver
				    	intCantidad = intCantidadEntrada - intCantidadDevolucion;

				    	//Si la existencia disponible  en menor que la cantidad a devolver
						if(intDisponibleExistencia < intCantidad)
						{
							//Cambiar la cantidad a devolver
							intCantidad = intDisponibleExistencia;

							/*Mensaje que se utiliza para informar al usuario que la cantidad a 
							  devolver no debe ser mayor que la cantidad que se encuentra en el inventario*/
							strMensaje = 'La cantidad a devolver es mayor que la cantidad del inventario.';
						}
						else if(intCantidadEntrada == intCantidadDevolucion)
						{
							//Mensaje que se utiliza para informar al usuario que la refacción ha sido devuelta
							strMensaje = 'La refacción ha sido devuelta.';
						}
						else
						{
							/*Mensaje que se utiliza para informar al usuario que la cantidad a 
							  devolver no debe ser mayor que la cantidad que no ha sido devuelta*/
							strMensaje = 'La cantidad a devolver es mayor que la cantidad que no ha sido devuelta.';
						}

				    	//Cambiar cantidad a formato moneda
			    		intCantidad = formatMoney(intCantidad, 2, '');

				    	//Asignar cantidad a devolver
						$('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(intCantidad);

						//Hacer un llamado a la función para mostrar mensaje de información
					    mensaje_movimientos_salidas_refacciones_devolucion_proveedor_refacciones('informacion', strMensaje);
					}
					
				}


				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones tr").length - 2;
				$('#numElementos_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html(intFilas);
		    }
		    else
		    {
		    	//Limpiar caja de texto
		    	$('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
		    }
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtCodigo_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtCostoUnitario_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtCantidadEntrada_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtCantidadDevolucion_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtPorcentajeDescuento_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(objRenglon.parentNode.parentNode.cells[20].innerHTML);
			$('#txtPorcentajeIva_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(objRenglon.parentNode.parentNode.cells[21].innerHTML);
			$('#txtPorcentajeIeps_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(objRenglon.parentNode.parentNode.cells[22].innerHTML);
			$('#txtDisponibleExistencia_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(objRenglon.parentNode.parentNode.cells[23].innerHTML);
			//Enfocar caja de texto
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').focus();
		}


		//Función para calcular totales de la tabla
		function calcular_totales_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;
			//Variable que se utiliza para contar el número de refacciones con devolución
		    var intContadorDetalles = 0;
		    //Variable que se utiliza para asignar la cantidad de la refacción
		    var intCantidad = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				//Convertir cadena de texto a número decimal
				intCantidad = parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				//Incrementar acumulados
				intAcumUnidades += intCantidad;
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[8].innerHTML, ",", ""));

				//Si existe cantidad de la refacción
				if(intCantidad > 0)
				{
					//Incrementar contador por cada detalle
					intContadorDetalles++;
				}

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, intNumDecimalesDescUnitBDMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, intNumDecimalesMostrarMovimientosSalidasRefaccionesDevolucionProveedorRefacciones, '');

			//Asignar los valores
			$('#acumCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html(intAcumUnidades);
			$('#acumDescuento_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html(intAcumDescuento);
			$('#acumSubtotal_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html(intAcumSubtotal);
			$('#acumIva_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html(intAcumIva);
			$('#acumIeps_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html(intAcumIeps);
			$('#acumTotal_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').html(intAcumTotal);
			$('#txtNumDetalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(intContadorDetalles);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').numeric();

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').blur(function(){
                $('.cantidad_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
            });

            //Agregar datepicker para seleccionar fecha
			$('#dteFecha_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').datetimepicker({format: 'DD/MM/YYYY'});

			
	        //Autocomplete para recuperar los datos de una entrada de refacciones
	        $('#txtReferencia_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtReferenciaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la entrada de refacciones
	               inicializar_entrada_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/movimientos_entradas_refacciones_compra/autocomplete",
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
	               $('#txtReferenciaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(ui.item.data);
	                //Hacer un llamado a la función para regresar los datos de la entrada de refacciones
	                get_datos_entrada_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();

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
	        $('#txtReferencia_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').focusout(function(e){
	            //Si no existe id de la entrada
	            if($('#txtReferenciaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val() == '' ||
	               $('#txtReferencia_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtReferenciaID_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
	               $('#txtReferencia_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
	            }

	        });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar botón Agregar
			   	    	$('#btnAgregar_detalles_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').focus();
			   	    }
		        }
		    });

			
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').datetimepicker({format: 'DD/MM/YYYY',
			 																		                            useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').data('DateTimePicker').maxDate(e.date);
			});
			
			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedorBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorIDBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
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
	             $('#txtProveedorIDBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val(ui.item.data);
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
	        $('#txtProveedorBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorIDBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val() == '' ||
	               $('#txtProveedorBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorIDBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
	               $('#txtProveedorBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').val('');
	            }

	        });

	        //Paginación de registros
			$('#pagLinks_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').addClass("estatus-NUEVO");
				//Abrir modal
				objMovimientosSalidasRefaccionesDevolucionProveedorRefacciones = $('#MovimientosSalidasRefaccionesDevolucionProveedorRefaccionesBox').bPopup({
											   appendTo: '#MovimientosSalidasRefaccionesDevolucionProveedorRefaccionesContent', 
				                               contentContainer: 'MovimientosSalidasRefaccionesDevolucionProveedorRefaccionesM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#txtReferencia_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_movimientos_salidas_refacciones_devolucion_proveedor_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_movimientos_salidas_refacciones_devolucion_proveedor_refacciones();
		});
	</script>