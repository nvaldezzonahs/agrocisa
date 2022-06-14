
	<div id="MovimientosEntradasRefaccionesCompraRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_movimientos_entradas_refacciones_compra_refacciones" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_movimientos_entradas_refacciones_compra_refacciones">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_movimientos_entradas_refacciones_compra_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_movimientos_entradas_refacciones_compra_refacciones"
				                    		name= "strFechaInicialBusq_movimientos_entradas_refacciones_compra_refacciones" 
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
								<label for="txtFechaFinalBusq_movimientos_entradas_refacciones_compra_refacciones">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_movimientos_entradas_refacciones_compra_refacciones'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_movimientos_entradas_refacciones_compra_refacciones"
				                    		name= "strFechaFinalBusq_movimientos_entradas_refacciones_compra_refacciones" 
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
								<input id="txtProveedorIDBusq_movimientos_entradas_refacciones_compra_refacciones" 
									   name="intProveedorIDBusq_movimientos_entradas_refacciones_compra_refacciones"  
									   type="hidden" value="">
								</input>
								<label for="txtProveedorBusq_movimientos_entradas_refacciones_compra_refacciones">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProveedorBusq_movimientos_entradas_refacciones_compra_refacciones" 
										name="strProveedorBusq_movimientos_entradas_refacciones_compra_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_movimientos_entradas_refacciones_compra_refacciones">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_movimientos_entradas_refacciones_compra_refacciones" 
								 		name="strEstatusBusq_movimientos_entradas_refacciones_compra_refacciones" tabindex="1">
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
								<label for="txtBusqueda_movimientos_entradas_refacciones_compra_refacciones">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_movimientos_entradas_refacciones_compra_refacciones" 
										name="strBusqueda_movimientos_entradas_refacciones_compra_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" 
	                        			id="chbImprimirDetalles_movimientos_entradas_refacciones_compra_refacciones" 
									   	name="strImprimirDetalles_movimientos_entradas_refacciones_compra_refacciones" 
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
							<button class="btn btn-primary" id="btnBuscar_movimientos_entradas_refacciones_compra_refacciones"
									onclick="paginacion_movimientos_entradas_refacciones_compra_refacciones();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_movimientos_entradas_refacciones_compra_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_movimientos_entradas_refacciones_compra_refacciones"
									onclick="reporte_movimientos_entradas_refacciones_compra_refacciones('PDF');" title="Generar reporte PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_movimientos_entradas_refacciones_compra_refacciones"
									onclick="reporte_movimientos_entradas_refacciones_compra_refacciones('XLS');" title="Descargar archivo XLS" tabindex="1" disabled>
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
				td.movil.a3:nth-of-type(3):before {content: "Proveedor"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

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
				<table class="table-hover movil" id="dg_movimientos_entradas_refacciones_compra_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Proveedor</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_movimientos_entradas_refacciones_compra_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{proveedor}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_movimientos_entradas_refacciones_compra_refacciones({{movimiento_refacciones_id}}, 'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_movimientos_entradas_refacciones_compra_refacciones({{movimiento_refacciones_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_movimientos_entradas_refacciones_compra_refacciones({{movimiento_refacciones_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_movimientos_entradas_refacciones_compra_refacciones({{movimiento_refacciones_id}}, 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Descargar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivo_movimientos_entradas_refacciones_compra_refacciones({{movimiento_refacciones_id}}, {{proveedor_id}});" title="Descargar archivo">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_movimientos_entradas_refacciones_compra_refacciones({{movimiento_refacciones_id}}, {{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_entradas_refacciones_compra_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_movimientos_entradas_refacciones_compra_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_compra_refacciones" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 	

		<!-- Diseño del modal-->
		<div id="MovimientosEntradasRefaccionesCompraRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_movimientos_entradas_refacciones_compra_refacciones"  class="ModalBodyTitle">
			<h1>Entradas por Compra</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMovimientosEntradasRefaccionesCompraRefacciones" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMovimientosEntradasRefaccionesCompraRefacciones"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!-- Folio -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones" 
										   name="intMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones" 
										   type="hidden" value="" />
								    <!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_movimientos_entradas_refacciones_compra_refacciones" 
										   name="intPolizaID_movimientos_entradas_refacciones_compra_refacciones" type="hidden" value="" />
								    <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
									<input id="txtFolioPoliza_movimientos_entradas_refacciones_compra_refacciones" 
										   name="strFolioPoliza_movimientos_entradas_refacciones_compra_refacciones" type="hidden" value="" />
									<label for="txtFolio_movimientos_entradas_refacciones_compra_refacciones">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_movimientos_entradas_refacciones_compra_refacciones" 
											name="strFolio_movimientos_entradas_refacciones_compra_refacciones" 
											type="text" value="" placeholder="Autogenerado" disabled />
								</div>
							</div>
						</div>
						<!-- Fecha -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_movimientos_entradas_refacciones_compra_refacciones">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_movimientos_entradas_refacciones_compra_refacciones'>
					                    <input class="form-control" 
					                    		id="txtFecha_movimientos_entradas_refacciones_compra_refacciones"
					                    		name= "strFecha_movimientos_entradas_refacciones_compra_refacciones" 
					                    		type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Combobox que contiene las monedas activas-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones" 
									 		name="intMonedaID_movimientos_entradas_refacciones_compra_refacciones" 
									 		tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_movimientos_entradas_refacciones_compra_refacciones" 
											id="txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones" 
											name="intTipoCambio_movimientos_entradas_refacciones_compra_refacciones" 
											type="text" value="" tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene las ordenes de compra de refacciones autorizadas-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de compra de refacciones seleccionada-->
									<input id="txtOrdenCompraRefaccionesID_movimientos_entradas_refacciones_compra_refacciones" 
										   name="intOrdenCompraRefaccionesID_movimientos_entradas_refacciones_compra_refacciones"  
										   type="hidden"  value="">
									</input>
									<label for="txtOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones">Orden de compra</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones" 
											name="strOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones" 
											type="text" value="" tabindex="1" placeholder="Ingrese orden" maxlength="250" />
								</div>
							</div>	
						</div>
						<!--Autocomplete que contiene los proveedores activos-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
									<input id="txtProveedorID_movimientos_entradas_refacciones_compra_refacciones" 
										   name="intProveedorID_movimientos_entradas_refacciones_compra_refacciones"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del régimen fiscal-->
									<input id="txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones" 
										   name="intRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones"  type="hidden" 
										   value="">
									</input>
									<label for="txtProveedor_movimientos_entradas_refacciones_compra_refacciones">Proveedor</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtProveedor_movimientos_entradas_refacciones_compra_refacciones" 
											name="strProveedor_movimientos_entradas_refacciones_compra_refacciones" 
											type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250" />
								</div>
							</div>
						</div>
						<!-- Factura -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFactura_movimientos_entradas_refacciones_compra_refacciones">Factura</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtFactura_movimientos_entradas_refacciones_compra_refacciones" 
											name="strFactura_movimientos_entradas_refacciones_compra_refacciones" 
											type="text" value="" tabindex="1" placeholder="Ingrese factura" maxlength="10" />
								</div>
							</div>	
						</div>
						<!-- Remisión -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtRemision_movimientos_entradas_refacciones_compra_refacciones">Remisión</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtRemision_movimientos_entradas_refacciones_compra_refacciones" 
											name="strRemision_movimientos_entradas_refacciones_compra_refacciones" 
											type="text" value="" tabindex="1" placeholder="Ingrese remisión" maxlength="10" />
								</div>
							</div>	
						</div>
						<!--Tipo de entrada-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipoEntrada_movimientos_entradas_refacciones_compra_refacciones">Tipo de entrada</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbTipoEntrada_movimientos_entradas_refacciones_compra_refacciones" 
											name="strTipoEntrada_movimientos_entradas_refacciones_compra_refacciones">
										<option value="">Seleccione una opción</option>
										<option value="PROVEEDORES ALTERNOS">PROVEEDORES ALTERNOS</option>	
										<option value="EMERGENCIA">EMERGENCIA</option>
	                  					<option value="COMPLEMENTO">COMPLEMENTO</option>
	                  					<option value="PROGRAMADO">PROGRAMADO</option>
	                  					<option value="ENTREGA DIRECTA">ENTREGA DIRECTA</option>
	                  					<option value="OTROS NEGOCIOS">OTROS NEGOCIOS</option>
	                  					<option value="OTROS">OTROS</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- Total de unidades -->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTotalUnidades_movimientos_entradas_refacciones_compra_refacciones">Total de unidades</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control cantidad_movimientos_entradas_refacciones_compra_refacciones" 
											id="txtTotalUnidades_movimientos_entradas_refacciones_compra_refacciones" 
											name="intTotalUnidades_movimientos_entradas_refacciones_compra_refacciones" 
											type="text" value="" tabindex="1" placeholder="Ingrese unidades" maxlength="14" />
								</div>
							</div>	
						</div>
						<!-- Importe total -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteTotal_movimientos_entradas_refacciones_compra_refacciones">Importe total</label>
								</div>	
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_movimientos_entradas_refacciones_compra_refacciones" 
											id="txtImporteTotal_movimientos_entradas_refacciones_compra_refacciones" 
											name="intImporteTotal_movimientos_entradas_refacciones_compra_refacciones" 
											type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23" />
									</div>		
								</div>
							</div>	
						</div>
						<!-- Observaciones -->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_movimientos_entradas_refacciones_compra_refacciones">Observaciones</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtObservaciones_movimientos_entradas_refacciones_compra_refacciones" 
											name="strObservaciones_movimientos_entradas_refacciones_compra_refacciones" 
											type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250" />			
								</div>
							</div>
						</div>
						<!-- Cargar XML / Botón agregar-->
                      	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                      		<div class="form-group">
                      			<div class="col-md-12">
                      				<input type="file" 
                      						id="archivo_movimientos_entradas_refacciones_compra_refacciones" 
                      						name="archivo_movimientos_entradas_refacciones_compra_refacciones"
                      						style="display:none;"
                      						accept="text/xml" 
                      						onchange="cargar_xml_modal_movimientos_entradas_refacciones_compra_refacciones(this.files)">
                      				<input  id="txtXML_movimientos_entradas_refacciones_compra_refacciones" 
											name="strXML_movimientos_entradas_refacciones_compra_refacciones" 
											type="text" style="display: none" />		
                      				<button id="btnAdjuntarXML_movimientos_entradas_refacciones_compra_refacciones" 
                      						class="btn btn-default btn-toolBtns pull-right" 
                      						type="button" 
                      						onclick="cargar_xml_movimientos_entradas_refacciones_compra_refacciones();">Cargar XML</button>
                      			</div>	
							</div>
                     	</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
									<input id="txtNumDetalles_movimientos_entradas_refacciones_compra_refacciones" 
										   name="intNumDetalles_movimientos_entradas_refacciones_compra_refacciones" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la entrada de refacciones</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene las refacciones activas-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la  refacción seleccionada-->
																<input id="txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																	   name="intRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el código de la línea de refacción de la refacción seleccionada-->
																<input id="txtCodigoLinea_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																	   name="strCodigoLinea_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																	   type="hidden" value="">
																</input>
																 <!-- Caja de texto oculta para recuperar el costo actual de la refacción (en el inventario)  seleccionada-->
																<input id="txtActualCosto_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																	   name="intActualCosto_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																	   type="hidden" value="">
																</input>
																<label for="txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		name="strCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		type="text" value="" tabindex="1" 
																		placeholder="Ingrese código" maxlength="250" />
															</div>
														</div>
													</div>
													<!--Autocomplete que contiene las refacciones activas-->
													<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones">
																	Descripción
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		name="strDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		type="text" value="" tabindex="1" 
																		placeholder="Ingrese descripción" maxlength="250" />
															</div>
														</div>
													</div>
													<!--Localización-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones">
																	Localización
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		name="strLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		type="text" value="" tabindex="1" 
																		placeholder="Ingrese localización" maxlength="10" />
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_movimientos_entradas_refacciones_compra_refacciones" 
																		id="txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		name="intCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="14" />
															</div>
														</div>
													</div>
													<!--Costo unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones">Costo unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_movimientos_entradas_refacciones_compra_refacciones" 
																		id="txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		name="intCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		type="text" value="" tabindex="1" 
																		placeholder="Ingrese costo unitario" 
																		maxlength="23" />
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_movimientos_entradas_refacciones_compra_refacciones" 
																		id="txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		name="intPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		type="text" value="" tabindex="1" 
																		placeholder="Ingrese descuento" maxlength="8" />
															</div>
														</div>
													</div>
													<!--Porcentaje del IVA-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota de la refacción seleccionada-->
																<input id="txtTasaCuotaIva_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																	   name="intTasaCuotaIva_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIva_detalles_movimientos_entradas_refacciones_compra_refacciones">IVA %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtPorcentajeIva_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		name="intPorcentajeIva_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IEPS-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota de la refacción seleccionada-->
																<input id="txtTasaCuotaIeps_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																	   name="intTasaCuotaIeps_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIeps_detalles_movimientos_entradas_refacciones_compra_refacciones">IEPS %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtPorcentajeIeps_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		name="intPorcentajeIeps_detalles_movimientos_entradas_refacciones_compra_refacciones" 
																		type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_detalles_movimientos_entradas_refacciones_compra_refacciones" 
					                                			onclick="agregar_renglon_detalles_movimientos_entradas_refacciones_compra_refacciones();" 
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
													<table class="table-hover movil" id="dg_detalles_movimientos_entradas_refacciones_compra_refacciones">
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
																<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
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
																	<strong id="acumCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones"></strong>
																</td>
																<td class="movil t4"></td>
																<td class="movil t5">
																	<strong id="acumDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones"></strong>
																</td>
																<td class="movil t6">
																	<strong id="acumSubtotal_detalles_movimientos_entradas_refacciones_compra_refacciones"></strong>
																</td>
																<td class="movil t7">
																	<strong id="acumIva_detalles_movimientos_entradas_refacciones_compra_refacciones"></strong>
																</td>
																<td class="movil t8">
																	<strong  id="acumIeps_detalles_movimientos_entradas_refacciones_compra_refacciones"></strong>
																</td>
																<td class="movil t9">
																	<strong id="acumTotal_detalles_movimientos_entradas_refacciones_compra_refacciones"></strong>
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
																<strong id="numElementos_detalles_movimientos_entradas_refacciones_compra_refacciones">0</strong> encontrados
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
							<div id="divRetencionIsr_movimientos_entradas_refacciones_compra_refacciones"  class="col-sm-6 col-md-6 col-lg-6 col-xs-12 pull-right no-mostrar">
									<div class="form-group">
											<!--Porcentaje de ISR-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<input id="txtPorcentajeRetencionID_movimientos_entradas_refacciones_compra_refacciones" name="intPorcentajeRetencionID_movimientos_entradas_refacciones_compra_refacciones" type="hidden" value="">
														</input>
														<label for="txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones">Retención de ISR %</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control" id="txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones" 
																name="intPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones" type="text" value="" 
																tabindex="1" placeholder="Ingrese retención de ISR" maxlength="250">
														</input>
													</div>
												</div>
											</div>
											<!--Importe retenido-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<label for="txtImporteRetenido_movimientos_entradas_refacciones_compra_refacciones">Importe de ISR</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control moneda_movimientos_entradas_refacciones_compra_refacciones" id="txtImporteRetenido_movimientos_entradas_refacciones_compra_refacciones" 
																name="intImporteRetenido_movimientos_entradas_refacciones_compra_refacciones" type="text" value="" 
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
					<div id="divCirculoBarProgreso_movimientos_entradas_refacciones_compra_refacciones" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Nuevo registro-->
							<button class="btn btn-info" id="btnReiniciar_movimientos_entradas_refacciones_compra_refacciones"  
									onclick="nuevo_movimientos_entradas_refacciones_compra_refacciones('Nuevo');"  title="Nuevo registro" tabindex="2">
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_movimientos_entradas_refacciones_compra_refacciones"  
									onclick="validar_movimientos_entradas_refacciones_compra_refacciones();"  title="Guardar" tabindex="3" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" 
									id="btnImprimirRegistro_movimientos_entradas_refacciones_compra_refacciones"  
									onclick="reporte_registro_movimientos_entradas_refacciones_compra_refacciones('');"  
									title="Imprimir" tabindex="4" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_movimientos_entradas_refacciones_compra_refacciones"  
									onclick="descargar_archivo_movimientos_entradas_refacciones_compra_refacciones('','');"  title="Descargar archivo" tabindex="5" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_movimientos_entradas_refacciones_compra_refacciones"  
									onclick="cambiar_estatus_movimientos_entradas_refacciones_compra_refacciones('', '', '');"  title="Desactivar" tabindex="6" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_movimientos_entradas_refacciones_compra_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_movimientos_entradas_refacciones_compra_refacciones();" 
									title="Cerrar"  tabindex="7">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MovimientosEntradasRefaccionesCompraRefaccionesContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_movimientos_entradas_refacciones_compra_refacciones" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMovimientosEntradasRefaccionesCompraRefacciones = 0;
		var strUltimaBusquedaMovimientosEntradasRefaccionesCompraRefacciones = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar al momento de generar póliza)*/
		var strTipoReferenciaMovimientosEntradasRefaccionesCompraRefacciones = "MOVIMIENTO DE REFACCIONES";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
		var intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
		//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
		var intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesCompraRefacciones = <?php echo NUM_DECIMALES_COSTO_UNIT_MOV_REFACCIONES ?>;
		var intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones = <?php echo NUM_DECIMALES_DESCUENTO_UNIT_MOV_REFACCIONES ?>;
		var intNumDecimalesIvaUnitBDMovimientosEntradasRefaccionesCompraRefacciones = <?php echo NUM_DECIMALES_IVA_UNIT_MOV_REFACCIONES ?>;
		var intNumDecimalesIepsUnitBDMovimientosEntradasRefaccionesCompraRefacciones = <?php echo NUM_DECIMALES_IEPS_UNIT_MOV_REFACCIONES ?>;
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDMovimientosEntradasRefaccionesCompraRefacciones = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseMovimientosEntradasRefaccionesCompraRefacciones = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoMovimientosEntradasRefaccionesCompraRefacciones = <?php echo TIPO_CAMBIO_MAXIMO ?>;

		//Variable que se utiliza para asignar el id del porcentaje de retención ISR base
		var intPorcentajeRetencionBaseIDMovimientosEntradasRefaccionesCompraRefacciones = <?php echo PORCENTAJE_ISR_BASE ?>;
		//Variable que se utiliza para asignar el id del régimen fiscal: Régimen Simplificado de Confianza
		var intRegimenFiscalIDResicoMovimientosEntradasRefaccionesCompraRefacciones = <?php echo REGIMEN_FISCAL_RESICO ?>;


		//Variable que se utiliza para asignar objeto del modal
		var objMovimientosEntradasRefaccionesCompraRefacciones = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_movimientos_entradas_refacciones_compra_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/movimientos_entradas_refacciones_compra/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_movimientos_entradas_refacciones_compra_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMovimientosEntradasRefaccionesCompraRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosMovimientosEntradasRefaccionesCompraRefacciones = strPermisosMovimientosEntradasRefaccionesCompraRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMovimientosEntradasRefaccionesCompraRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMovimientosEntradasRefaccionesCompraRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMovimientosEntradasRefaccionesCompraRefacciones[i]=='GUARDAR') || (arrPermisosMovimientosEntradasRefaccionesCompraRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosMovimientosEntradasRefaccionesCompraRefacciones[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesCompraRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_movimientos_entradas_refacciones_compra_refacciones();
						}
						else if(arrPermisosMovimientosEntradasRefaccionesCompraRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesCompraRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesCompraRefacciones[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosMovimientosEntradasRefaccionesCompraRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_movimientos_entradas_refacciones_compra_refacciones() 
		{
		
		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaMovimientosEntradasRefaccionesCompraRefacciones =($('#txtFechaInicialBusq_movimientos_entradas_refacciones_compra_refacciones').val()+$('#txtFechaFinalBusq_movimientos_entradas_refacciones_compra_refacciones').val()+$('#txtProveedorIDBusq_movimientos_entradas_refacciones_compra_refacciones').val()+
				$('#cmbEstatusBusq_movimientos_entradas_refacciones_compra_refacciones').val()+"/"+
				$('#chbImprimirDetalles_movimientos_entradas_refacciones_compra_refacciones').val()+"/"+
				$('#txtBusqueda_movimientos_entradas_refacciones_compra_refacciones').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaMovimientosEntradasRefaccionesCompraRefacciones != strUltimaBusquedaMovimientosEntradasRefaccionesCompraRefacciones)
			{
				intPaginaMovimientosEntradasRefaccionesCompraRefacciones = 0;
				strUltimaBusquedaMovimientosEntradasRefaccionesCompraRefacciones = strNuevaBusquedaMovimientosEntradasRefaccionesCompraRefacciones;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/movimientos_entradas_refacciones_compra/get_paginacion',
					{ //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					  dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_refacciones_compra_refacciones').val()),
					  dteFechaFinal:   $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_refacciones_compra_refacciones').val()),
					  intProveedorID: $('#txtProveedorIDBusq_movimientos_entradas_refacciones_compra_refacciones').val(),
					  strEstatus:     $('#cmbEstatusBusq_movimientos_entradas_refacciones_compra_refacciones').val(),
					  strBusqueda:    $('#txtBusqueda_movimientos_entradas_refacciones_compra_refacciones').val(),
					  intPagina: intPaginaMovimientosEntradasRefaccionesCompraRefacciones,
					  strPermisosAcceso: $('#txtAcciones_movimientos_entradas_refacciones_compra_refacciones').val()
					},
					function(data){
						$('#dg_movimientos_entradas_refacciones_compra_refacciones tbody').empty();
						var tmpMovimientosEntradasRefaccionesCompraRefacciones = Mustache.render($('#plantilla_movimientos_entradas_refacciones_compra_refacciones').html(),data);
						$('#dg_movimientos_entradas_refacciones_compra_refacciones tbody').html(tmpMovimientosEntradasRefaccionesCompraRefacciones);
						$('#pagLinks_movimientos_entradas_refacciones_compra_refacciones').html(data.paginacion);
						$('#numElementos_movimientos_entradas_refacciones_compra_refacciones').html(data.total_rows);
						intPaginaMovimientosEntradasRefaccionesCompraRefacciones = data.pagina;
					},
			'json');
		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_movimientos_entradas_refacciones_compra_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').empty();
					var temp = Mustache.render($('#monedas_movimientos_entradas_refacciones_compra_refacciones').html(), data);
					$('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').html(temp);
				},
				'json');
		}

		//Regresar el porcentaje de retención ISR base
		function cargar_porcentaje_isr_base_movimientos_entradas_refacciones_compra_refacciones()
		{

				$.ajax({
	                 //Hacer un llamado al método del controlador para regresar los datos del registro
	                 url: "contabilidad/porcentaje_retencion_isr/get_datos",
	                 type: "post",
	                 dataType: "json",
	                 async: false,
	                 data: {
	                   strBusqueda: intPorcentajeRetencionBaseIDMovimientosEntradasRefaccionesCompraRefacciones,
	                   strTipo: 'id'
	                 },
	                 success: function( data ) {
	                   if(data.row){
								
								//Recuperar valores
								$('#txtPorcentajeRetencionID_movimientos_entradas_refacciones_compra_refacciones').val(data.row.porcentaje_retencion_id);
								$('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').val(data.row.porcentaje);
					        }

	                    }
	               });
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_movimientos_entradas_refacciones_compra_refacciones(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/movimientos_entradas_refacciones_compra/';

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
			if ($('#chbImprimirDetalles_movimientos_entradas_refacciones_compra_refacciones').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_movimientos_entradas_refacciones_compra_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_movimientos_entradas_refacciones_compra_refacciones').val('NO');
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_entradas_refacciones_compra_refacciones').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_entradas_refacciones_compra_refacciones').val()),
										'intProveedorID': $('#txtProveedorIDBusq_movimientos_entradas_refacciones_compra_refacciones').val(),
										'strEstatus': $('#cmbEstatusBusq_movimientos_entradas_refacciones_compra_refacciones').val(), 
										'strBusqueda': $('#txtBusqueda_movimientos_entradas_refacciones_compra_refacciones').val(),
										'strDetalles': $('#chbImprimirDetalles_movimientos_entradas_refacciones_compra_refacciones').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
			
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_movimientos_entradas_refacciones_compra_refacciones(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'refacciones/movimientos_entradas_refacciones_compra/get_reporte_registro',
							'data' : {
										'intMovimientoRefaccionesID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		

		//Función que se utiliza para descargar el archivo del registro seleccionado
		function descargar_archivo_movimientos_entradas_refacciones_compra_refacciones(movimientoRefaccionesInternasID, proveedorID)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intMovimientoRefaccionesID = 0;
			var intProveedorID = 0;
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(movimientoRefaccionesInternasID == '')
			{
				intMovimientoRefaccionesID = $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val();
				intProveedorID = $('#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones').val();
			}
			else
			{
				intMovimientoRefaccionesID = movimientoRefaccionesInternasID;
				intProveedorID = proveedorID;
			}


			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'refacciones/movimientos_entradas_refacciones_compra/descargar_archivo',
							'data' : {
										'intProveedorID': intProveedorID,
										'intMovimientoRefaccionesID': intMovimientoRefaccionesID				
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_movimientos_entradas_refacciones_compra_refacciones(tipoAccion)
		{
			//Incializar formulario
			$('#frmMovimientosEntradasRefaccionesCompraRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_entradas_refacciones_compra_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmMovimientosEntradasRefaccionesCompraRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_movimientos_entradas_refacciones_compra_refacciones');

			
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_movimientos_entradas_refacciones_compra_refacciones();
			
		
			//Si el tipo de acción corresponde a Nuevo
			if(tipoAccion == 'Nuevo')
			{
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_movimientos_entradas_refacciones_compra_refacciones').addClass("estatus-NUEVO");
			}
			//Habilitar todos los elementos del formulario
			$('#frmMovimientosEntradasRefaccionesCompraRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_movimientos_entradas_refacciones_compra_refacciones').val(fechaActual()); 
			//Habilitar botón Agregar
			$('#btnAgregar_detalles_movimientos_entradas_refacciones_compra_refacciones').prop('disabled', false);
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_movimientos_entradas_refacciones_compra_refacciones').attr("disabled", "disabled");
			$('#txtPorcentajeIva_detalles_movimientos_entradas_refacciones_compra_refacciones').attr("disabled", "disabled");
			$('#txtPorcentajeIeps_detalles_movimientos_entradas_refacciones_compra_refacciones').attr("disabled", "disabled");
 			//Mostrar los siguientes botones
			$("#btnGuardar_movimientos_entradas_refacciones_compra_refacciones").show();
			$("#btnReiniciar_movimientos_entradas_refacciones_compra_refacciones").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_movimientos_entradas_refacciones_compra_refacciones").hide();
			$("#btnDescargarArchivo_movimientos_entradas_refacciones_compra_refacciones").hide();
			$("#btnDesactivar_movimientos_entradas_refacciones_compra_refacciones").hide();

			//Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_movimientos_entradas_refacciones_compra_refacciones();
		}


		//Función para inicializar elementos del proveedor
		function inicializar_proveedor_movimientos_entradas_refacciones_compra_refacciones()
		{
		
            //Hacer un llamado a la función para inicializar elementos de la  retención de ISR (proveedor)
	        inicializar_retencion_isr_movimientos_entradas_refacciones_compra_refacciones();
            
		}

		//Función para inicializar elementos de la retención de ISR (proveedor)
		function inicializar_retencion_isr_movimientos_entradas_refacciones_compra_refacciones()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones').val('');
            $('#txtPorcentajeRetencionID_movimientos_entradas_refacciones_compra_refacciones').val('');
            $('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').val('');
            $('#txtImporteRetenido_movimientos_entradas_refacciones_compra_refacciones').val('');

            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
	        mostrar_retencion_isr_movimientos_entradas_refacciones_compra_refacciones();
            
		}

		//Función para deshabilitar controles del formulario y así evitar modificar datos correspondientes al XML u orden de compra
		function deshabilitar_controles_movimientos_entradas_refacciones_compra_refacciones(tipoAccion)
		{
			//Dependiendo del tipo de acción habilitar o deshabilitar controles
			if(tipoAccion == 'cargar_xml')
			{
				//Limpiar contenido de las siguientes cajas de texto
				$('#txtOrdenCompraRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val('');
				$('#txtOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones').val('');
				//Deshabilitar los siguientes controles
				$('#txtOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
				$('#txtFactura_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
				$('#txtRemision_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
			}
			else
			{
				//Habilitar los siguientes controles
				$('#txtOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
				$('#txtFactura_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
			}
			
			//Deshabilitar los siguientes controles
			$('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
			$('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
			$('#txtProveedor_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
			$('#btnAgregar_detalles_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
			$('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
			$('#txtLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
			$('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
			$('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
			$('#txtPorcentajeIva_detalles_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');
			$('#txtPorcentajeIeps_detalles_movimientos_entradas_refacciones_compra_refacciones').attr('disabled','disabled');

			//Limpiar contenido de las siguientes cajas de texto
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
			$('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
			$('#txtLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
			$('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
			$('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
			$('#txtPorcentajeIva_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
			$('#txtPorcentajeIeps_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');

		}

		//Función para inicializar elementos de la orden de compra
		function inicializar_orden_compra_movimientos_entradas_refacciones_compra_refacciones()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones').val('');
            $('#txtProveedor_movimientos_entradas_refacciones_compra_refacciones').val('');
            $('#txFactura_movimientos_entradas_refacciones_compra_refacciones').val('');
            $('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').val('');
            //Asignar el tipo de cambio correspondiente a la moneda peso mexicano
			$('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').val('');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_movimientos_entradas_refacciones_compra_refacciones();
            //Habilitar los siguientes controles
		    $('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
		    $('#txtProveedor_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
		    $('#btnAgregar_detalles_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
		    $('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
		    $('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
		    $('#txtLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
		    $('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
		    $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
		    $('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');

		     //Hacer un llamado a la función para inicializar elementos de la  retención de ISR (proveedor)
	        inicializar_retencion_isr_movimientos_entradas_refacciones_compra_refacciones();
		   
		}
																	
		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_movimientos_entradas_refacciones_compra_refacciones()
		{
			//Eliminar los datos de la tabla detalles del movimiento
			$('#dg_detalles_movimientos_entradas_refacciones_compra_refacciones tbody').empty();
			$('#acumCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').html('');
		    $('#acumDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').html('');
		    $('#acumSubtotal_detalles_movimientos_entradas_refacciones_compra_refacciones').html('');
		    $('#acumIva_detalles_movimientos_entradas_refacciones_compra_refacciones').html('');
		    $('#acumIeps_detalles_movimientos_entradas_refacciones_compra_refacciones').html('');
		    $('#acumTotal_detalles_movimientos_entradas_refacciones_compra_refacciones').html('');
			$('#numElementos_detalles_movimientos_entradas_refacciones_compra_refacciones').html(0);
			$('#txtNumDetalles_movimientos_entradas_refacciones_compra_refacciones').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_movimientos_entradas_refacciones_compra_refacciones()
		{
			try {
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_movimientos_entradas_refacciones_compra_refacciones('');
				//Cerrar modal
				objMovimientosEntradasRefaccionesCompraRefacciones.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_movimientos_entradas_refacciones_compra_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_movimientos_entradas_refacciones_compra_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_movimientos_entradas_refacciones_compra_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmMovimientosEntradasRefaccionesCompraRefacciones')
				.bootstrapValidator({	excluded: [':disabled'],
									 	container: 'popover',
									 	feedbackIcons: {
									 		valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
									  	},
									  	fields: {
											strFecha_movimientos_entradas_refacciones_compra_refacciones: {
												validators: {
													notEmpty: {message: 'Seleccione una fecha'}
												}
											},
											intMonedaID_movimientos_entradas_refacciones_compra_refacciones: {
												validators: {
													notEmpty: {message: 'Seleccione una moneda'}
												}
											},
											intTipoCambio_movimientos_entradas_refacciones_compra_refacciones: {
												excluded: false,  // No ignorar (permite validar campo deshabilitado)
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
							                                    //Verificar que exista el tipo de cambio cuando la moneda
							                                    //sea diferente del peso mexicano
							                                    if(parseInt($('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').val()) !== intMonedaBaseIDMovimientosEntradasRefaccionesCompraRefacciones)
							                                    {
							                                    	if(value === '')
							                                    	{
							                                    		return {
							                                           	 valid: false,
							                                            	message: 'Escriba el tipo de cambio'
							                                        	};
							                                    	}
							                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
							                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoMovimientosEntradasRefaccionesCompraRefacciones)
							                                    	{
							                                    		return {
							                                              valid: false,
							                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoMovimientosEntradasRefaccionesCompraRefacciones
							                                          	};
							                                    	}
								                                      		
							                                    }
						                                    	return true;
						                                    }
						                                }
						                            }
											},
											strOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la orden de compra
						                                    if( value !== '' &&  $('#txtOrdenCompraRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val() === '')
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
											strProveedor_movimientos_entradas_refacciones_compra_refacciones: {
												excluded: false,  // No ignorar (permite validar campo deshabilitado)
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id del proveedor
						                                    if($('#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones').val() === '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba un proveedor existente'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
											intPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
							                                    //Verificar que exista el id del porcentaje de retención ISR
							                                    if(parseInt($('#txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones').val()) === intRegimenFiscalIDResicoMovimientosEntradasRefaccionesCompraRefacciones)
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
											intImporteRetenido_movimientos_entradas_refacciones_compra_refacciones: {
												excluded: false,  // No ignorar (permite validar campo deshabilitado)
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
							                                    //Verificar que exista el id del porcentaje de retención ISR
							                                    if(parseInt($('#txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones').val()) === intRegimenFiscalIDResicoMovimientosEntradasRefaccionesCompraRefacciones)
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
											strFactura_movimientos_entradas_refacciones_compra_refacciones: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista al menos la factura
						                                    if(value === '' && $('#txtRemision_movimientos_entradas_refacciones_compra_refacciones').val() === '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba una factura'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
											strRemision_movimientos_entradas_refacciones_compra_refacciones: {
												excluded: false,  // No ignorar (permite validar campo deshabilitado)
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista al menos la remision
						                                    if(value === '' && $('#txtFactura_movimientos_entradas_refacciones_compra_refacciones').val() === '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba una remisión'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
											strTipoEntrada_movimientos_entradas_refacciones_compra_refacciones: {
												validators: {
													notEmpty: {message: 'Seleccione un tipo de entrada'}
												}
											},
											intTotalUnidades_movimientos_entradas_refacciones_compra_refacciones: {
												validators: {
													notEmpty: {message: 'Escriba el total de unidades'}
												}
											},
											intImporteTotal_movimientos_entradas_refacciones_compra_refacciones: {
												validators: {
													notEmpty: {message: 'Escriba el importe total'}
												}
											},
											intNumDetalles_movimientos_entradas_refacciones_compra_refacciones: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que existan detalles
						                                    if(parseInt(value) === 0 || value === '')
						                                    {
						                                    	return {
						                                            valid: false,
						                                            message: 'Agregar al menos un detalle para esta entrada de refacciones.'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
										    strCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    strDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones:{
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones: {
										        excluded: true  // Ignorar (no valida el campo)   
										    },
										    intPorcentajeIva_detalles_movimientos_entradas_refacciones_compra_refacciones: {
										        excluded: true  // Ignorar (no valida el campo)    
										    },
										    intPorcentajeIeps_detalles_movimientos_entradas_refacciones_compra_refacciones: {
										        excluded: true  // Ignorar (no valida el campo)    
										    }
										}
									});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_movimientos_entradas_refacciones_compra_refacciones = $('#frmMovimientosEntradasRefaccionesCompraRefacciones').data('bootstrapValidator');
			bootstrapValidator_movimientos_entradas_refacciones_compra_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_movimientos_entradas_refacciones_compra_refacciones.isValid())
			{
				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesMovimientosEntradasRefaccionesCompraRefacciones = $.reemplazar($('#acumTotal_detalles_movimientos_entradas_refacciones_compra_refacciones').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesMovimientosEntradasRefaccionesCompraRefacciones = $.reemplazar(intAcumTotalDetallesMovimientosEntradasRefaccionesCompraRefacciones, ",", "");

				var intImporteTotalMovimientosEntradasRefaccionesCompraRefacciones = $.reemplazar($('#txtImporteTotal_movimientos_entradas_refacciones_compra_refacciones').val(), ",", "");
 
				//Verificar que el total de unidades sea igual a la cantidad de detalles
				if($('#acumCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').html() != $('#txtTotalUnidades_movimientos_entradas_refacciones_compra_refacciones').val())
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_movimientos_entradas_refacciones_compra_refacciones('error', 'El total de unidades no coincide con los detalles, favor de verificar.');
					
				}
				//Verificar que el importe total sea igual al total de detalles
				else if(intAcumTotalDetallesMovimientosEntradasRefaccionesCompraRefacciones != intImporteTotalMovimientosEntradasRefaccionesCompraRefacciones)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_movimientos_entradas_refacciones_compra_refacciones('error', 'El importe total no coincide con los detalles, favor de verificar.');
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_movimientos_entradas_refacciones_compra_refacciones();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_movimientos_entradas_refacciones_compra_refacciones()
		{
			try
			{
				$('#frmMovimientosEntradasRefaccionesCompraRefacciones').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_movimientos_entradas_refacciones_compra_refacciones()
		{
			//Obtenemos un array con los datos del archivo
    		var arrArchivoMovimientosEntradasRefaccionesCompraRefacciones = $("#archivo_movimientos_entradas_refacciones_compra_refacciones")[0].files[0];

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_compra_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
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
			var arrLocalizaciones = [];
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioMovimiento = parseFloat($('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad =  $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intCostoUnitario = $.reemplazar(objRen.cells[14].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[15].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[16].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[17].innerHTML, ",", "");

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
				intIvaUnitario = intIvaUnitario.toFixed(intNumDecimalesIvaUnitBDMovimientosEntradasRefaccionesCompraRefacciones);
				intIvaUnitario = parseFloat(intIvaUnitario);
				
				//Redondear cantidad a decimales
				intIepsUnitario = intIepsUnitario.toFixed(intNumDecimalesIepsUnitBDMovimientosEntradasRefaccionesCompraRefacciones);
				intIepsUnitario = parseFloat(intIepsUnitario);


				//Asignar valores a los arrays
				arrRefaccionID.push(objRen.getAttribute('id'));
				arrCodigos.push(objRen.cells[0].innerHTML);
				arrDescripciones.push(objRen.cells[1].innerHTML);
				arrCodigosLineas.push(objRen.cells[10].innerHTML);
				arrLocalizaciones.push(objRen.cells[11].innerHTML);
				arrCantidades.push(intCantidad);
				arrCostosUnitarios.push(intCostoUnitario);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrTasaCuotaIva.push(objRen.cells[12].innerHTML);
				arrIvasUnitarios.push(intIvaUnitario);
				arrTasaCuotaIeps.push(objRen.cells[13].innerHTML);
				arrIepsUnitarios.push(intIepsUnitario);
			}


			//Variable que se utiliza para asignar el importe retenido de ISR (proveedor)
			var intRetencionIsrProv =  parseFloat($.reemplazar($('#txtImporteRetenido_movimientos_entradas_refacciones_compra_refacciones').val(), ",", ""));

			//Si existe retención de ISR (proveedor)
			if(intRetencionIsrProv > 0)
			{
				//Convertir importes a peso mexicano
				intRetencionIsrProv = intRetencionIsrProv * intTipoCambioMovimiento;
				//Redondear cantidad a decimales
				intRetencionIsrProv = intRetencionIsrProv.toFixed(intNumDecimalesIvaUnitBDMovimientosEntradasRefaccionesCompraRefacciones);
				intRetencionIsrProv = parseFloat(intRetencionIsrProv);
			}



			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/movimientos_entradas_refacciones_compra/guardar',
					{ 
						//Datos del movimiento
						intMovimientoRefaccionesID: $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_entradas_refacciones_compra_refacciones').val()),
						intMonedaID: $('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').val(),
						intTipoCambio:  intTipoCambioMovimiento,
						intReferenciaID: $('#txtOrdenCompraRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val(),
						intProveedorID: $('#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones').val(),
						intPorcentajeRetencionID: $('#txtPorcentajeRetencionID_movimientos_entradas_refacciones_compra_refacciones').val(),
						intImporteRetenido: intRetencionIsrProv,
						strFactura: $('#txtFactura_movimientos_entradas_refacciones_compra_refacciones').val(),
						strRemision: $('#txtRemision_movimientos_entradas_refacciones_compra_refacciones').val(),
						strTipoEntrada: $('#cmbTipoEntrada_movimientos_entradas_refacciones_compra_refacciones').val(),
						strObservaciones: $('#txtObservaciones_movimientos_entradas_refacciones_compra_refacciones').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_refacciones_compra_refacciones').val(),
						//Datos del inventario
						strLocalizaciones: arrLocalizaciones.join('|'),
						//Datos de los detalles
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
							if($('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val() == '')
							{
								//Asignar el id del movimiento registrado en la base de datos
                     			$('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val(data.movimiento_refacciones_id);
							}

							//Si existe archivo seleccionado
			                if(arrArchivoMovimientosEntradasRefaccionesCompraRefacciones != undefined )
			                {
			                    //Hacer un llamado a la función para subir el archivo
			                    subir_archivo_modal_movimientos_entradas_refacciones_compra_refacciones();
			                }
			                else
			                {

			                	//Hacer llamado a la función  para cargar  los registros en el grid
				            	paginacion_movimientos_entradas_refacciones_compra_refacciones();
		                		
		                		//Hacer un llamado a la función para generar póliza con los datos del registro
								generar_poliza_movimientos_entradas_refacciones_compra_refacciones('', '');
			                       
			                }

		                    
						}

						//Si existe mensaje de error
						if(data.tipo_mensaje == 'error')
						{
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_movimientos_entradas_refacciones_compra_refacciones(data.tipo_mensaje, data.mensaje);
						}
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_movimientos_entradas_refacciones_compra_refacciones(tipoMensaje, mensaje)
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
		function cambiar_estatus_movimientos_entradas_refacciones_compra_refacciones(id, polizaID, folioPoliza)
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
				intID = $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val();
				intPolizaID = $('#txtPolizaID_movimientos_entradas_refacciones_compra_refacciones').val();
				strFolioPoliza = $('#txtFolioPoliza_movimientos_entradas_refacciones_compra_refacciones').val();

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
					              'title':    'Entradas por Compra',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('refacciones/movimientos_entradas_refacciones_compra/set_estatus',
					                                     {intMovimientoRefaccionesID: intID, 
					                                      intPolizaID: intPolizaID
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                          	//Hacer llamado a la función  para cargar  los registros en el grid
					                                          	paginacion_movimientos_entradas_refacciones_compra_refacciones();
					                                          	
					                                          	//Si el id del registro se obtuvo del modal
																if(id == '')
																{
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_movimientos_entradas_refacciones_compra_refacciones();     
																}
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_movimientos_entradas_refacciones_compra_refacciones(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_movimientos_entradas_refacciones_compra_refacciones(id, tipoAccion)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/movimientos_entradas_refacciones_compra/get_datos',
			       {intMovimientoRefaccionesID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_movimientos_entradas_refacciones_compra_refacciones('');
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar el id de la póliza
				            var intPolizaID = parseInt(data.row.poliza_id); 
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
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

				          
				          	//Recuperar valores
				            $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val(data.row.movimiento_refacciones_id);
				            $('#txtFolio_movimientos_entradas_refacciones_compra_refacciones').val(data.row.folio);
				            $('#txtFecha_movimientos_entradas_refacciones_compra_refacciones').val(data.row.fecha);
				            $('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').val(data.row.moneda_id);
				            $('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').val(data.row.tipo_cambio);
				            $('#txtOrdenCompraRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val(data.row.orden_compra_refacciones_id);
				            $('#txtOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones').val(data.row.folio_orden_compra);
				            $('#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones').val(data.row.proveedor_id);
						    $('#txtProveedor_movimientos_entradas_refacciones_compra_refacciones').val(data.row.proveedor);
						    $('#txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones').val(data.row.regimen_fiscal_id);
						    $('#txtPorcentajeRetencionID_movimientos_entradas_refacciones_compra_refacciones').val(data.row.porcentaje_retencion_id);
						    $('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').val(data.row.porcentaje_isr);
						    $('#txtImporteRetenido_movimientos_entradas_refacciones_compra_refacciones').val(intRetencionIsrProv);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporteRetenido_movimientos_entradas_refacciones_compra_refacciones').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones });
						    $('#txtFactura_movimientos_entradas_refacciones_compra_refacciones').val(data.row.factura);
						    $('#txtRemision_movimientos_entradas_refacciones_compra_refacciones').val(data.row.remision);
						    $('#cmbTipoEntrada_movimientos_entradas_refacciones_compra_refacciones').val(data.row.tipo_entrada);
						    $('#txtObservaciones_movimientos_entradas_refacciones_compra_refacciones').val(data.row.observaciones);
						    $('#txtPolizaID_movimientos_entradas_refacciones_compra_refacciones').val(intPolizaID);
						    $('#txtFolioPoliza_movimientos_entradas_refacciones_compra_refacciones').val(data.row.folio_poliza);


						    //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	    				 mostrar_retencion_isr_movimientos_entradas_refacciones_compra_refacciones();


						    //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmMovimientosEntradasRefaccionesCompraRefacciones').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_movimientos_entradas_refacciones_compra_refacciones").hide();
					            $("#btnReiniciar_movimientos_entradas_refacciones_compra_refacciones").hide();
					            //Deshabilitar botón Agregar
								$('#btnAgregar_detalles_movimientos_entradas_refacciones_compra_refacciones').prop('disabled', true);


								//Si existe el id de la póliza
				            	if(strEstatus == 'ACTIVO' && intPolizaID > 0)
				            	{
					            	//Mostrar el botón Desactivar
					            	$("#btnDesactivar_movimientos_entradas_refacciones_compra_refacciones").show();
					            }

				            }
				            else
				            {

				            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
												   " onclick='editar_renglon_detalles_movimientos_entradas_refacciones_compra_refacciones(this)'>" + 
												   "<span class='glyphicon glyphicon-edit'></span></button>" + 
												   "<button class='btn btn-default btn-xs' title='Eliminar'" +
												   " onclick='eliminar_renglon_detalles_movimientos_entradas_refacciones_compra_refacciones(this)'>" + 
												   "<span class='glyphicon glyphicon-trash'></span></button>" + 
												   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDMovimientosEntradasRefaccionesCompraRefacciones)
							    {
									//Habilitar caja de texto
									$("#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones").removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar las siguientes cajas de texto
									$("#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones").attr('disabled','disabled');
							    }

							    
				            }


						    //Si existe id de la orden de compra
						    if(data.row.orden_compra_refacciones_id > 0)
						    {
						    	//Limpiar acciones del grid view
				           		strAccionesTabla = '';
				           		//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes a la orden de compra
								deshabilitar_controles_movimientos_entradas_refacciones_compra_refacciones('cargar_orden_compra');
						    }

						    //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{	
				           		//Limpiar acciones del grid view
				           		strAccionesTabla = '';
				           		//Mostrar botón Descargar Archivo
				            	$("#btnDescargarArchivo_movimientos_entradas_refacciones_compra_refacciones").show();
				            	//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes al XML
								deshabilitar_controles_movimientos_entradas_refacciones_compra_refacciones('cargar_xml');
				           	}

				           	//Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_compra_refacciones').getElementsByTagName('tbody')[0];

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
								var objCeldaCodigoLinea = objRenglon.insertCell(10);
								var objCeldaLocalizacion = objRenglon.insertCell(11);
								var objCeldaTasaCuotaIva = objRenglon.insertCell(12);
								var objCeldaTasaCuotaIeps = objRenglon.insertCell(13);
								var objCeldaCostoUnitarioBD = objRenglon.insertCell(14);
								var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(15);
								var objCeldaIvaUnitarioBD = objRenglon.insertCell(16);
								var objCeldaIepsUnitarioBD = objRenglon.insertCell(17);
								var objCeldaActualCosto = objRenglon.insertCell(18);
								var objCeldaPorcentajeDescuento = objRenglon.insertCell(19);
								var objCeldaPorcentajeIva = objRenglon.insertCell(20);
								var objCeldaPorcentajeIeps = objRenglon.insertCell(21);

								//Variables que se utilizan para asignar valores del detalle
								var intSubtotal = parseFloat(data.detalles[intCon].costo_unitario);
								var intCantidad =  parseFloat(data.detalles[intCon].cantidad);
								var intCostoUnitario = parseFloat(data.detalles[intCon].costo_unitario);
								var intDescuentoUnitario = parseFloat(data.detalles[intCon].descuento_unitario);
								var intIvaUnitario = parseFloat(data.detalles[intCon].iva_unitario);
								var intIepsUnitario = parseFloat(data.detalles[intCon].ieps_unitario);
								var intActualCosto = parseFloat(data.detalles[intCon].actual_costo);
								var intImporteIva = 0;
								var intImporteIeps = 0;
								var intPorcentajeDescuento = 0;
								var intPorcentajeIeps = '';
								var intTotal = 0;
								//Variable que se utiliza para asignar  el color de fondo del registro
								var strEstiloRegistro = '';

								//Si el costo unitario es mayor que el costo actual de la refacción en el inventario
								if(intCostoUnitario > intActualCosto)
								{
									//Asignar clase para cambiar el color de fondo
									strEstiloRegistro = 'registro-INACTIVO';
								}

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
								
								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;
								
								//Calcular importe de IVA
								intImporteIva =  intIvaUnitario * intCantidad;

								//Si existe importe de IEPS unitario
								if(intIepsUnitario > 0)
								{
									//Calcular importe de IEPS
									intImporteIeps =  intIepsUnitario * intCantidad;
									intPorcentajeIeps =  data.detalles[intCon].porcentaje_ieps;
								}

								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;

								//Cambiar cantidad a  formato moneda (a visualizar)
								intCantidad =  formatMoney(intCantidad, 2, '');
								var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
								
								var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
								
								var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
								
								var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
								
								var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
								
								var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
								
								intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');

								//Cambiar cantidad a  formato moneda (a guardar en la  BD)
								var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
								
								var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
								
								var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
								
								var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].refaccion_id);
								objCeldaCodigo.setAttribute('class', 'movil b1 '+strEstiloRegistro);
								objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
								objCeldaDescripcion.setAttribute('class', 'movil b2 '+strEstiloRegistro);
								objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
								objCeldaCantidad.setAttribute('class', 'movil b3 '+strEstiloRegistro);
								objCeldaCantidad.innerHTML = intCantidad;
								objCeldaCostoUnitario.setAttribute('class', 'movil b4 '+strEstiloRegistro);
								objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
								objCeldaDescuentoUnitario.setAttribute('class', 'movil b5 '+strEstiloRegistro);
								objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitarioMostrar;
								objCeldaSubtotal.setAttribute('class', 'movil b6 '+strEstiloRegistro);
								objCeldaSubtotal.innerHTML = intSubtotalMostrar;
								objCeldaIvaUnitario.setAttribute('class', 'movil b7 '+strEstiloRegistro);
								objCeldaIvaUnitario.innerHTML = intImporteIvaMostrar;
								objCeldaIepsUnitario.setAttribute('class', 'movil b8 '+strEstiloRegistro);
								objCeldaIepsUnitario.innerHTML = intImporteIepsMostrar;
								objCeldaTotal.setAttribute('class', 'movil b9 '+strEstiloRegistro);
								objCeldaTotal.innerHTML =  intTotalMostrar;
								objCeldaAcciones.setAttribute('class', 'td-center movil b10 '+strEstiloRegistro);
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
								objCeldaCodigoLinea.innerHTML = data.detalles[intCon].codigo_linea;
								objCeldaLocalizacion.setAttribute('class', 'no-mostrar');
								objCeldaLocalizacion.innerHTML =  data.detalles[intCon].localizacion;
								objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIva.innerHTML = data.detalles[intCon].tasa_cuota_iva;
								objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIeps.innerHTML = data.detalles[intCon].tasa_cuota_ieps;
								objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaCostoUnitarioBD.innerHTML =  intCostoUnitarioBD;
								objCeldaDescuentoUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaDescuentoUnitarioBD.innerHTML =  intDescuentoUnitarioBD;
								objCeldaIvaUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaIvaUnitarioBD.innerHTML =  intImporteIvaBD;
								objCeldaIepsUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaIepsUnitarioBD.innerHTML =  intImporteIepsBD;
								objCeldaActualCosto.setAttribute('class', 'no-mostrar');
								objCeldaActualCosto.innerHTML =  intActualCosto; 
								objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento;
								objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIva.innerHTML =  data.detalles[intCon].porcentaje_iva;
								objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_movimientos_entradas_refacciones_compra_refacciones();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_compra_refacciones tr").length - 2;
							$('#numElementos_detalles_movimientos_entradas_refacciones_compra_refacciones').html(intFilas);
							$('#txtNumDetalles_movimientos_entradas_refacciones_compra_refacciones').val(intFilas);
							
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_movimientos_entradas_refacciones_compra_refacciones').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_movimientos_entradas_refacciones_compra_refacciones").show();

			            	//Abrir modal
							objMovimientosEntradasRefaccionesCompraRefacciones = $('#MovimientosEntradasRefaccionesCompraRefaccionesBox').bPopup({
														   appendTo: '#MovimientosEntradasRefaccionesCompraRefaccionesContent', 
							                               contentContainer: 'MovimientosEntradasRefaccionesCompraRefaccionesM', 
							                               zIndex: 2, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});

							 //Si existe id de la orden de compra o el archivo XML
						    if((data.row.orden_compra_id > 0) || (data.archivo != ''))
						    {
						    	//Enfocar caja de texto
								$('#txtTotalUnidades_movimientos_entradas_refacciones_compra_refacciones').focus();
						    }
						    else
						    {
						    	//Enfocar caja de texto
								$('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').focus();
						    }
							
			       	    }
			       },
			       'json');
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_movimientos_entradas_refacciones_compra_refacciones()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').val()) !== intMonedaBaseIDMovimientosEntradasRefaccionesCompraRefacciones)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_movimientos_entradas_refacciones_compra_refacciones').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones").val(data.row.tipo_cambio_sat);
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}

		//Función para subir archivo de un registro desde el modal
		function subir_archivo_modal_movimientos_entradas_refacciones_compra_refacciones()
		{
			//Si existe id del registro subir el archivo
        	if($('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val() != '')
        	{
				//Variable que se utiliza para asignar archivo
				var strBotonArchivoIDMovimientosEntradasRefaccionesCompraRefacciones = "archivo_movimientos_entradas_refacciones_compra_refacciones";
				
				//Hacer un llamado al método del controlador para subir archivo del registro
				$('#'+strBotonArchivoIDMovimientosEntradasRefaccionesCompraRefacciones).upload('refacciones/movimientos_entradas_refacciones_compra/subir_archivo',
						{ intMovimientoRefaccionesID:$('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val(),
		                  intProveedorID:$('#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones').val(),
		                  strBotonArchivoID: strBotonArchivoIDMovimientosEntradasRefaccionesCompraRefacciones
						},
						function(data) {

							//Limpia ruta del archivo cargado
			         		$('#'+strBotonArchivoIDMovimientosEntradasRefaccionesCompraRefacciones).val('');
							//Subida finalizada.
							if (data.resultado)
							{
								//Hacer llamado a la función  para cargar  los registros en el grid
				            	paginacion_movimientos_entradas_refacciones_compra_refacciones();  
							}

	                    	//Si el tipo de mensaje es un éxito
			                if(data.tipo_mensaje == 'éxito')
			                {
			                	//Hacer un llamado a la función para generar póliza con los datos del registro
								generar_poliza_movimientos_entradas_refacciones_compra_refacciones('', '');

			                }
			                else
			                {
			                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				    			mensaje_movimientos_entradas_refacciones_compra_refacciones(data.tipo_mensaje, data.mensaje);
			                }

						});
			}
					
		}


		//Función para asignar los datos de un proveedor
		function get_datos_proveedor_movimientos_entradas_refacciones_compra_refacciones(ui)
		{
		 	//Asignar valores del registro seleccionado
             $('#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones').val(ui.item.data);
             $('#txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones').val(ui.item.regimen_fiscal_id);

       	     
       	     //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_movimientos_entradas_refacciones_compra_refacciones('cargar_isr');

		}


		//Función para mostrar u ocultar div que contiene el campo de retención de ISR (proveedor)
		function mostrar_retencion_isr_movimientos_entradas_refacciones_compra_refacciones(strTipo)
		{
			//Si se cumple la sentencia
			if(strTipo == 'cargar_isr')
			{

				//Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
	       	     if(parseInt( $('#txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones').val()) == intRegimenFiscalIDResicoMovimientosEntradasRefaccionesCompraRefacciones)
	       	     {
	       	     	//Hacer un llamado a la función para cargar el porcentaje de retención ISR base
	       			cargar_porcentaje_isr_base_movimientos_entradas_refacciones_compra_refacciones();
	       	     }

			}

			//Si el gasto tiene retención de ISR
            if(parseInt($('#txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones').val()) == intRegimenFiscalIDResicoMovimientosEntradasRefaccionesCompraRefacciones)
            {
            	//Quitar clase no-mostrar para mostrar div que contiene la retención de ISR (proveedor)
			  	$('#divRetencionIsr_movimientos_entradas_refacciones_compra_refacciones').removeClass("no-mostrar");

			  	//Si se cumple la sentencia, significa que la orden de compra selaccionada ya cuenta con régimen fiscal RESICO
			  	if(strTipo == 'deshabilitar')
				{
					//Deshabilitar las siguientes cajas de texto
					$('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').attr("disabled", "disabled");
           		    $('#txtImporteRetenido_movimientos_entradas_refacciones_compra_refacciones').attr("disabled", "disabled");
				}
				else
				{
					//Habilitar las siguientes cajas de texto
					$('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').removeAttr("disabled", "disabled");
           		    $('#txtImporteRetenido_movimientos_entradas_refacciones_compra_refacciones').removeAttr("disabled", "disabled");
				}

            }
            else
            {
            	//Agregar clase no-mostrar para ocultar div que contiene la retención de ISR (proveedor)
			    $('#divRetencionIsr_movimientos_entradas_refacciones_compra_refacciones').addClass("no-mostrar");
            }

		}


		//Función para generar póliza con los datos de un registro
		function generar_poliza_movimientos_entradas_refacciones_compra_refacciones(id, formulario)
		{	

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val();
			}
			else
			{
				intID = id;
				strTipo = 'gridview';
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_movimientos_entradas_refacciones_compra_refacciones(formulario);
			//Hacer un llamado al método del controlador para generar póliza del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaMovimientosEntradasRefaccionesCompraRefacciones, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_movimientos_entradas_refacciones_compra_refacciones').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_movimientos_entradas_refacciones_compra_refacciones(formulario);
			    
			    //Si existe resultado
				if (data.resultado)
				{
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_movimientos_entradas_refacciones_compra_refacciones();

					//Si el id del registro se obtuvo del modal
					if(strTipo == 'modal')
					{
						//Hacer un llamado a la función para cerrar modal
			            cerrar_movimientos_entradas_refacciones_compra_refacciones();
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
			            								cerrar_movimientos_entradas_refacciones_compra_refacciones();
	                                                 }
	                                                }]
	                                  });
				}
				else
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    	mensaje_movimientos_entradas_refacciones_compra_refacciones(data.tipo_mensaje, data.mensaje);
				}
				
		     },
		     'json');

		}


		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function mostrar_circulo_carga_movimientos_entradas_refacciones_compra_refacciones(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_movimientos_entradas_refacciones_compra_refacciones';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_compra_refacciones';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}


		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de generar la póliza de un registro
		function ocultar_circulo_carga_movimientos_entradas_refacciones_compra_refacciones(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_movimientos_entradas_refacciones_compra_refacciones';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_movimientos_entradas_refacciones_compra_refacciones';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}
	

		//Función para cargar archivo XML
		function cargar_xml_movimientos_entradas_refacciones_compra_refacciones() 
		{
			//Asignar elemento 
		  	var el = document.getElementById("archivo_movimientos_entradas_refacciones_compra_refacciones");
		  	if (el) 
		  	{
		    	el.click();
		  	}
		
		}

		//Función para agregar elementos del XML al modal
		function cargar_xml_modal_movimientos_entradas_refacciones_compra_refacciones(files) 
		{

		  	var file = files[0];
			var reader = new FileReader();
			//Leer archivo XML
			reader.onload = function() {
				//Hacer un llamado a la función para inicializar elementos de la tabla detalles
				inicializar_detalles_movimientos_entradas_refacciones_compra_refacciones();

  				var xml = $.parseXML(reader.result);
  				var xml_json = $.xmlToJson(xml);

				var moneda = xml_json['cfdi:Comprobante']['@attributes']['Moneda'];
				var tipo_cambio = xml_json['cfdi:Comprobante']['@attributes']['TipoCambio'];
				var serie = xml_json['cfdi:Comprobante']['@attributes']['Serie'];
				var folio = xml_json['cfdi:Comprobante']['@attributes']['Folio'];
				var proveedor = xml_json['cfdi:Comprobante']['cfdi:Emisor']['@attributes']['Rfc'];
				var receptor = xml_json['cfdi:Comprobante']['cfdi:Receptor']['@attributes']['Rfc'];
				var conceptos = xml_json['cfdi:Comprobante']['cfdi:Conceptos'];  

				//Variables que se utilizan para asignar los datos del proveedor
				var intProveedorID = 0;
				var strProveedor = '';
				var intRegimenFiscalID = 0;
				


				//Si el tipo de cambio es indefinido
				if(tipo_cambio == undefined)
				{
					//Asignar cadena vacia 
					tipo_cambio = '';
				}

				//Si la serie indefinido
				if(serie == undefined)
				{
					//Asignar cadena vacia 
					serie = '';
				}

				//Variable que se utiliza para concatenar los datos de la factura
				var strFactura = serie+folio;
				//Variable que se utiliza para cargar los datos del archivo XML
				//en caso de que no exista en otra entrada por compra
				var strExisteXML = 'NO';

				//Hacer un llamado al método del controlador para regresar los datos  proveedor correspondiente al RFC que se obtiene del XML Emisor
			    $.ajax({
			        url: 'cuentas_pagar/proveedores/get_datos',
			        method:'post',
			        dataType: 'json',
			        async: false,
			        data: {
			        	strRfc: proveedor
			        },
			        success: function (data) {
			          	//Si no se encuentra código 
			        	if(data.row)
			        	{
			        		//Asignar datos del proveedor
					      	intProveedorID = data.row[0].proveedor_id;
					      	strProveedor = data.row[0].codigo + ' - ' + data.row[0].razon_social;
					      	intRegimenFiscalID = data.row[0].regimen_fiscal_id;

			        	}
			        	

			        }
			    });

			    ///Hacer un llamado al método del controlador para verificar existencia de entradas por compra con la información del XML (evitar duplicidad de XML)
			    $.ajax({
			        url: 'refacciones/movimientos_entradas_refacciones_compra/get_existenciaXML',
			        method:'post',
			        dataType: 'json',
			        async: false,
			        data: {
			        	intProveedorID: intProveedorID, 
			        	strFactura: strFactura
			        },
			        success: function (data) {
			          	//Si no se encuentra código 
			            if(data.mensaje)
			        	{
			        		//Asignar SI para indicar que existen entradas con la misma factura y proveedor (relacionar XML)
			        		strExisteXML = 'SI'

			        		//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_movimientos_entradas_refacciones_compra_refacciones('error', data.mensaje);

							//Incializar formulario para permitir cargar nuevamente un archivo XML
							$('#frmMovimientosEntradasRefaccionesCompraRefacciones')[0].reset();
			        	}
			        	

			        }
			    });


		    //Si no existen entradas con la información del XML
            if(strExisteXML == 'NO')
            {

				//Factura: Concatenación de la serie y folio de los datos del XML timbrado
				$('#txtFactura_movimientos_entradas_refacciones_compra_refacciones').val(strFactura);

  				//Buscar el moneda_id correspondiente a la moneda de la factura
				$.post('contabilidad/sat_monedas/get_datos',
				{
					strBusqueda:moneda,
			       	strTipo: "codigo"
				},
				     function(data) {	
					      if (data.row)
					      {


					      	//Asignar id de la moneda
					      	$('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').val(data.row.moneda_id);

					      	//Asignar el id de la moneda
					      	var intMonedaID = parseInt(data.row.moneda_id);

					      	//Si la moneda corresponde a peso mexicano y no existe el tipo de cambio
					      	if(tipo_cambio == '' && 
					      		intMonedaID == intMonedaBaseIDMovimientosEntradasRefaccionesCompraRefacciones)
					      	{
					      		//Asignar tipo de cambio que le corresponde al peso mexicano
					      		tipo_cambio = intTipoCambioMonedaBaseMovimientosEntradasRefaccionesCompraRefacciones;
			

					      	}

							//Asignar tipo de cambio
							$('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').val(tipo_cambio);

									
							//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
							$('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
							
					      	  //Si existe el id del proveedor
						      if (intProveedorID > 0)
						      {
						      	
								      	//Asignar datos del proveedor
								      	$('#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones').val(intProveedorID);
								      	$('#txtProveedor_movimientos_entradas_refacciones_compra_refacciones').val(strProveedor);
								      	$('#txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones').val(intRegimenFiscalID);

								      	//Buscar si el RFC de la factura coincide con el RFC de la sucursal
										$.post('mercadotecnia/movimientos_entradas_insumos/get_sucursal_rfc',
										{
											
										},
										     function(data) { 
												  if (data.row)
											      {
											      	//Si no existe rfc
											      	if(data.row.rfc != receptor)
											      	{
											      		//Hacer un llamado a la función para mostrar mensaje de error
											      		mensaje_movimientos_entradas_refacciones_compra_refacciones('error', 'La ENTRADA POR COMPRA no puede agregarse. El <b>RFC del receptor</b> proporcionado en el archivo XML no coincide con el RFC de la empresa.');
											      	
											      	}
											      	else
											      	{
											      		//Variable que se utiliza para asignar el mensaje de error
														var strMensajeError = '';
											      		//Array que se utiliza para agregar los códigos no encontrados en el catálogo de refacciones
											      		var arrRefaccionesNoEncontradas = [];
											      		//Array que se utiliza para agregar las tasas o cuotas no encontradas en el catálogo de tasas o cuotas
											      		var arrTasaOCuotaNoEncontradas = [];
											      		//Array que se utiliza para agregar las tasas o cuotas que no coinciden con la refacción
											      		var arrTasaOCuotaNoCoinciden = [];

											      		//Variable que se utiliza para asignar el número de conceptos que contiene el nodo Concepto
											      		var intNumConceptos = conceptos['cfdi:Concepto'].length;
											      		//Variable que se utiliza para asignar el número de impuestos
													    var intNumImpuestos = 0;

													     
											      		//Si el número de conceptos es indefinido, significa que el nodo solo contiene un concepto
											      		if(intNumConceptos == undefined)
											      		{	
											      			/*Asignar 1 para evitar errores al momento de verificar la existencia 
											      			 del código en el catálogo de refacciones*/
											      			intNumConceptos = 1;
											      		}

											      		//Hacer recorrido en el nodo para verificar la existencia del código en el catálogo de refacciones
														for (var intCont = 0; intCont < intNumConceptos; intCont++) 
														{  
															//Variable que se utiliza para asignar el código de la refacción que se buscara en la tabla refacciones
															var strCodigo = '';
															//Variable que se utiliza para asignar el porcentaje de IVA de la refacción
															var intPorcentajeIva = '';
															//Variable que se utiliza para asignar el porcentaje de IEPS de la refacción
															var intPorcentajeIeps = '';

															
															//Si solo existe un concepto 
															if(intNumConceptos == 1)
															{
																strCodigo =  conceptos['cfdi:Concepto']['@attributes']['NoIdentificacion'];

																intNumImpuestos = conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'].length;
																
															}
															else
															{
																strCodigo = conceptos['cfdi:Concepto'][intCont]['@attributes']['NoIdentificacion'];

																intNumImpuestos = conceptos['cfdi:Concepto'][intCont]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'].length;
															}

															//Hacer un llamado al método del controlador para regresar los datos del registro que coincide con el código
														    $.ajax({
														        url: 'refacciones/refacciones/get_datos',
														        method:'post',
														        dataType: 'json',
														        async: false,
														        data: {
														        	strTipo: 'codigo',
														            strBusqueda: strCodigo
														        },
														        success: function (data) {
														          	//Si no se encuentra código 
														        	if(data.row == null)
														        	{
														        		//Agregar código en el array, de esta manera, el usuario identificara los códigos no encontrados
														        		arrRefaccionesNoEncontradas.push(strCodigo);
														        	}
														        	else //Si el código se encuentra en el catálogo de refacciones
														        	{
														        		intPorcentajeIva =  data.row.porcentaje_iva;
														        		intPorcentajeIeps = data.row.porcentaje_ieps;

														        	}

														        }
														    });


															//Si el número de impuestos es indefinido, significa que el nodo solo contiene un impuesto 
												      		if(intNumImpuestos == undefined)
												      		{	
												      			//Asignar 1 para recuperar valor del impuesto
												      			intNumImpuestos = 1;
												      		}

												      		//Recorrer impuestos trasladados para un concepto
															for(var intConSec = 0; intConSec < intNumImpuestos; intConSec ++)
															{
																//Variables que se utilizan para asignar los datos del impuesto
																var strImpuesto = '';
																var intTasaOCuota =  0;
																var strTipoFactor =  '';

																//Si solo existe un concepto 
																if(intNumConceptos == 1)
																{
																	//Si solo existe un impuesto 
																	if(intNumImpuestos == 1)
																	{
																		strImpuesto = conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['Impuesto'];

																		intTasaOCuota = conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['TasaOCuota'];

																		strTipoFactor = conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['TipoFactor'];
																	}
																	else
																	{
																		strImpuesto = conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['Impuesto'];

																		intTasaOCuota = conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['TasaOCuota'];

																		strTipoFactor = conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['TipoFactor'];

																	}
																	
																}
																else
																{
																	//Si solo existe un impuesto 
																	if(intNumImpuestos == 1)
																	{
																		strImpuesto = conceptos['cfdi:Concepto'][intCont]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['Impuesto'];

																		intTasaOCuota = conceptos['cfdi:Concepto'][intCont]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['TasaOCuota'];

																		strTipoFactor = conceptos['cfdi:Concepto'][intCont]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['TipoFactor'];
																	}
																	else
																	{
																		strImpuesto = conceptos['cfdi:Concepto'][intCont]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['Impuesto'];

																		intTasaOCuota = conceptos['cfdi:Concepto'][intCont]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['TasaOCuota'];

																		strTipoFactor = conceptos['cfdi:Concepto'][intCont]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['TipoFactor'];
																	}
																	
																}
																

																//Concatenar criterios de búsqueda (para poder verificar la existencia de la tasa o cuota del impuesto)
																var strCriteriosBusqSatTasaCuota = strImpuesto+'|'+strTipoFactor+'|'+intTasaOCuota;

																//Si el código del impuesto corresponde al IVA
																if(strImpuesto == '002')
																{
																	
																	//Concatenar datos de la tasa o cuota
																	strImpuesto += ' - IVA';
													        		
																	//Si el porcentaje de IVA no coincide con la TasaOCuota
																	if(intPorcentajeIva !== '' && intPorcentajeIva !== intTasaOCuota)
																	{
																		//Variable que se utiliza para asignar el mensaje de no coincidencias
																		var strPorcentajeIvaNoCoincide = strCodigo +' IVA %: '+ intPorcentajeIva+' capturado no coincide  con la TasaOCuota: '+intTasaOCuota;

																		//Agregar refacciones que no coinciden con el porcentaje de IVA en el array, de esta manera, el usuario identificara las refacciones  que tienen diferente valor_maximo
															        	arrTasaOCuotaNoCoinciden.push(strPorcentajeIvaNoCoincide);
																	}	
																}
																//Si el código del impuesto corresponde al IEPS
																else if(strImpuesto == '003')
																{
																	//Concatenar datos de la tasa o cuota
																	strImpuesto += ' - IEPS';

													        		//Variable que se utiliza para asignar el mensaje de no coincidencias
																	var strPorcentajeIepsNoCoincide = strCodigo +' IEPS %: '+intPorcentajeIeps+' capturado no coincide  con la TasaOCuota: '+intTasaOCuota;

																	//Agregar refacciones que no coinciden con el porcentaje de IEPS en el array, de esta manera, el usuario identificara las refacciones  que tienen diferente valor_maximo
															        arrTasaOCuotaNoCoinciden.push(strPorcentajeIepsNoCoincide);
																}

																//Hacer un llamado al método del controlador para regresar los datos del registro que coincide con la tasa o cue
															    $.ajax({
															        url: 'contabilidad/sat_tasa_cuota/get_datos',
															        method:'post',
															        dataType: 'json',
															        async: false,
															        data: {
															        	strTipo: 'tasa_cuota_impuesto',
															            strBusqueda: strCriteriosBusqSatTasaCuota
															        },
															        success: function (data) {
															          	//Si no se encuentra tasa o cuota 
															        	if(data.row == null)
															        	{
															        		//Concatenar datos de la tasa o cuota
															        		strImpuesto += '  TasaOCuota: '+intTasaOCuota;
													        				strImpuesto += '  Factor: '+strTipoFactor;

															        		//Agregar tasa o cuota en el array, de esta manera, el usuario identificara las tasas o cuotas no encontradas
															        		arrTasaOCuotaNoEncontradas.push(strImpuesto);
															        	}

															        }
															    });

															}//Cierre de verificación de impuestos

														}//Cierre de verificación de códigos y tasaOcuotas


														/*Si existen códigos no encontrados en el catálogo de Refacciones
														  o si existen tasas o cuotas no encontradas en el catálogo Tasa o Cuota*/
														if(arrRefaccionesNoEncontradas.length > 0 || 
														   arrTasaOCuotaNoEncontradas.length > 0 ||
														   arrTasaOCuotaNoCoinciden > 0)
														{

															//Mensaje que se utiliza para informar al usuario la lista de códigos no encontrados
															strMensajeError = 'La ENTRADA POR COMPRA no puede agregarse.<br>';

															//Si existen códigos no encontrados en el catálogo de refacciones
															if(arrRefaccionesNoEncontradas.length > 0)
															{
																//Mensaje que se utiliza para informar al usuario la lista de códigos no encontrados
																strMensajeError += 'Los siguientes <b>códigos</b> no se encuentran agregados en el catálogo de Refacciones:<br>';

																//Hacer recorrido para obtener códigos inexistentes en el catálogo de refacciones
																for(var intCont = 0; intCont < arrRefaccionesNoEncontradas.length; intCont++)
																{
																	//Agregar código en el mensaje
												            		strMensajeError += arrRefaccionesNoEncontradas[intCont] + '<br/>';
																}
																
															}

															//Si existen tasas o cuotas no encontrados en el catálogo de Tasa o Cuota
															if(arrTasaOCuotaNoEncontradas.length > 0)
															{
																//Mensaje que se utiliza para informar al usuario la lista de tasas o cuotas no encontradas
																strMensajeError += 'Las siguientes <b>tasas</b> no se encuentran agregadas en el catálogo de Tasa o Cuota:<br>';

																//Hacer recorrido para obtener códigos inexistentes en el catálogo de refacciones
																for(var intCont = 0; intCont < arrTasaOCuotaNoEncontradas.length; intCont++)
																{
																	//Agregar tasa o cuota en el mensaje
												            		strMensajeError += arrTasaOCuotaNoEncontradas[intCont] + '<br/>';
																}
																
															}

															//Si existen refacciones donde el porcentaje de IVA y porcentaje de IEPS no coincidan con las del archivo XML
															if(arrTasaOCuotaNoCoinciden.length > 0)
															{
																//Mensaje que se utiliza para informar al usuario la lista de tasas o cuotas no encontradas
																strMensajeError += 'Los siguientes <b>conceptos</b> no coincienden en su porcentaje: <br>';

																//Hacer recorrido para obtener códigos inexistentes en el catálogo de refacciones
																for(var intCont = 0; intCont < arrTasaOCuotaNoCoinciden.length; intCont++)
																{
																	//Agregar refacciones sin coincidencias en el mensaje
												            		strMensajeError += arrTasaOCuotaNoCoinciden[intCont] + '<br/>';
																}
																
															}

														}//Cierre de códigos y tasaOcuotas no encontrados

														//Si existe mensaje de error
														if(strMensajeError != '')
														{
															//Hacer un llamado a la función para mostrar mensaje de error
											            	mensaje_movimientos_entradas_refacciones_compra_refacciones('error', strMensajeError);
														}
														else
														{

															//Agregar conceptos en la tabla detalles
															var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_compra_refacciones').getElementsByTagName('tbody')[0];

															//Hacer recorrido en el nodo para agregar datos en la tabla detalles
															for(var intCont = 0; intCont < intNumConceptos; intCont++)
															{
																//Variables que se utilizan para asignar los datos del detalle
																var intRefaccionID = 0;
																var strCodigo = '';
																var strDescripcion = '';
																var strCodigoLinea = '';
																var intTasaCuotaIva = '';
																var intTasaCuotaIeps = '';
																var intCantidad = 0;
																var intCostoUnitario = 0;
																var intDescuentoUnitario = 0;
																var intSubtotal = 0;
																var intImporte = 0;
																var intImporteIva = 0;
																var intImporteIeps = 0;
																var intTotal = 0;
																var strLocalizacion = '';
																var intActualCosto = 0;
																var intPorcentajeDescuento = 0;
																var intPorcentajeIva = 0;
																var intPorcentajeIeps = '';


																//Variable que se utiliza para asignar  el color de fondo del registro
															    var strEstiloRegistro = '';

																//Si solo existe un concepto 
																if(intNumConceptos == 1)
																{
																	strCodigo =  conceptos['cfdi:Concepto']['@attributes']['NoIdentificacion'];

																	intCantidad = parseFloat(conceptos['cfdi:Concepto']['@attributes']['Cantidad']);
																	intCostoUnitario =  parseFloat(conceptos['cfdi:Concepto']['@attributes']['ValorUnitario']);
																	intDescuentoUnitario = parseFloat(conceptos['cfdi:Concepto']['@attributes']['Descuento']);
																	
																	intImporte = parseFloat(conceptos['cfdi:Concepto']['@attributes']['Importe']);
																}
																else
																{
																	strCodigo = conceptos['cfdi:Concepto'][intCont]['@attributes']['NoIdentificacion'];
																	intCantidad = parseFloat(conceptos['cfdi:Concepto'][intCont]['@attributes']['Cantidad']);
																	intCostoUnitario =  parseFloat(conceptos['cfdi:Concepto'][intCont]['@attributes']['ValorUnitario']);
																	intDescuentoUnitario = parseFloat(conceptos['cfdi:Concepto'][intCont]['@attributes']['Descuento']);
																	intImporte = parseFloat(conceptos['cfdi:Concepto'][intCont]['@attributes']['Importe']);

																}

																
																//Hacer un llamado al método del controlador para regresar los datos del registro que coincide con el código
															    $.ajax({
															        url: 'refacciones/refacciones/get_datos',
															        method:'post',
															        dataType: 'json',
															        async: false,
															        data: {
															        	strTipo: 'codigo',
															            strBusqueda: strCodigo
															        },
															        success: function (data) {
															          	//Si hay datos del registro
															        	if(data.row)
															        	{	
															        		intRefaccionID = data.row.refaccion_id;
															        		strCodigo  = data.row.codigo_01;
															        		strDescripcion  = data.row.descripcion;
															        		strCodigoLinea  = data.row.codigo_linea;
															        		intTasaCuotaIva =  data.row.tasa_cuota_iva;
															        		intTasaCuotaIeps =  data.row.tasa_cuota_ieps;
															        		strLocalizacion = data.row.localizacion;
															        		intActualCosto = parseFloat(data.row.actual_costo);
															        		intPorcentajeIva =  data.row.porcentaje_iva;
															        		intPorcentajeIeps =  data.row.porcentaje_ieps;
															        	}

															        }
															    });
															    
															    //Asignar costo unitario
															    intSubtotal = intCostoUnitario;

																//Si existe importe del descuento
																if(intDescuentoUnitario > 0)
																{
																	
																	//Calcular el descuento unitario
																	intDescuentoUnitario = intDescuentoUnitario / intCantidad;

																	//Redondear cantidad a decimales
																	intDescuentoUnitario = intDescuentoUnitario.toFixed(intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones);

																	//Calcular porcentaje del descuento
																	intPorcentajeDescuento = (intDescuentoUnitario / intCostoUnitario) * 100;

																	//Decrementar descuento unitario
																	intSubtotal = intSubtotal - intDescuentoUnitario;


																}

																//Si el costo unitario es mayor que el costo actual de la refacción en el inventario
																if(intActualCosto > 0  && intSubtotal > intActualCosto)
																{
																	//Asignar clase para cambiar el color de fondo
																	strEstiloRegistro = 'registro-INACTIVO';
																}

																//Calcular subtotal
																intSubtotal = (intCantidad * intSubtotal);
																
																//Recorrer impuestos trasladados para un concepto
																for(var intConSec = 0; intConSec < intNumImpuestos; intConSec ++)
																{
																	//Variables que se utilizan para asignar los datos del impuesto
																	var strImpuesto = '';
																	var intImporte = 0;

																	//Si solo existe un concepto 
																	if(intNumConceptos == 1)
																	{
																		//Si solo existe un impuesto 
																		if(intNumImpuestos == 1)
																		{
																			strImpuesto = parseFloat(conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['Impuesto']);
																			intImporte = parseFloat(conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['Importe']);
																		}
																		else
																		{
																			strImpuesto = parseFloat(conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['Impuesto']);
																			intImporte = parseFloat(conceptos['cfdi:Concepto']['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['Importe']);

																		}
																		
																	}
																	else
																	{
																		//Si solo existe un impuesto 
																		if(intNumImpuestos == 1)
																		{
																			strImpuesto = conceptos['cfdi:Concepto'][intCont]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['Impuesto'];
																			intImporte = parseFloat(conceptos['cfdi:Concepto'][intCont]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado']['@attributes']['Importe']);
																		}
																		else
																		{
																			strImpuesto = conceptos['cfdi:Concepto'][intCont]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['Impuesto'];
																			intImporte = parseFloat(conceptos['cfdi:Concepto'][intCont]['cfdi:Impuestos']['cfdi:Traslados']['cfdi:Traslado'][intConSec]['@attributes']['Importe']);
																		}
																		
																	}
																	
																	//Si el código del impuesto corresponde al IVA
																	if(strImpuesto == '002')
																	{
																		//Incrementar importe de IVA
																		intImporteIva += intImporte;
																	}
																	//Si el código del impuesto corresponde al IEPS
																	else if( strImpuesto == '003')
																	{
																		//Incrementar importe de IEPS
																		intImporteIeps += intImporte;
																	}

																}//Cierre de verificación de impuestos

																//Calcular importe total
																intTotal = intSubtotal + intImporteIva + intImporteIeps;

																//Si no existe importe de IEPS
																if(intImporteIeps == 0)
																{
																	intPorcentajeIeps = '';
																}

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
																var objCeldaCodigoLinea = objRenglon.insertCell(10);
																var objCeldaLocalizacion = objRenglon.insertCell(11);
																var objCeldaTasaCuotaIva = objRenglon.insertCell(12);
																var objCeldaTasaCuotaIeps = objRenglon.insertCell(13);
																var objCeldaCostoUnitarioBD = objRenglon.insertCell(14);
																var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(15);
																var objCeldaIvaUnitarioBD = objRenglon.insertCell(16);
																var objCeldaIepsUnitarioBD = objRenglon.insertCell(17);
																var objCeldaActualCosto = objRenglon.insertCell(18);
																var objCeldaPorcentajeDescuento = objRenglon.insertCell(19);
																var objCeldaPorcentajeIva = objRenglon.insertCell(20);
																var objCeldaPorcentajeIeps = objRenglon.insertCell(21);


																//Cambiar cantidad a  formato moneda (a visualizar)
																intCantidad =  formatMoney(intCantidad, 2, '');
																
																var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
																
																var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
																
																var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
																
																var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
																
																var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
																
																var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
																
																intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');


																//Cambiar cantidad a  formato moneda (a guardar en la  BD)
																var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
																
																var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
																
																var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
																
																var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');

																//Asignar valores
																objRenglon.setAttribute('class', 'movil');
																objRenglon.setAttribute('id', intRefaccionID);
																objCeldaCodigo.setAttribute('class', 'movil b1 '+strEstiloRegistro);
																objCeldaCodigo.innerHTML = strCodigo;
																objCeldaDescripcion.setAttribute('class', 'movil b2 '+strEstiloRegistro);
																objCeldaDescripcion.innerHTML = strDescripcion;
																objCeldaCantidad.setAttribute('class', 'movil b3 '+strEstiloRegistro);
																objCeldaCantidad.innerHTML = intCantidad;
																objCeldaCostoUnitario.setAttribute('class', 'movil b4 '+strEstiloRegistro);
																objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
																objCeldaDescuentoUnitario.setAttribute('class', 'movil b5 '+strEstiloRegistro);
																objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitarioMostrar;
																objCeldaSubtotal.setAttribute('class', 'movil b6 '+strEstiloRegistro);
																objCeldaSubtotal.innerHTML = intSubtotalMostrar;
																objCeldaIvaUnitario.setAttribute('class', 'movil b7 '+strEstiloRegistro);
																objCeldaIvaUnitario.innerHTML = intImporteIvaMostrar;
																objCeldaIepsUnitario.setAttribute('class', 'movil b8 '+strEstiloRegistro);
																objCeldaIepsUnitario.innerHTML = intImporteIepsMostrar;
																objCeldaTotal.setAttribute('class', 'movil b9 '+strEstiloRegistro);
																objCeldaTotal.innerHTML = intTotalMostrar;
																

																objCeldaAcciones.setAttribute('class', 'td-center movil b10 '+strEstiloRegistro);
																objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
																							 " onclick='editar_renglon_detalles_movimientos_entradas_refacciones_compra_refacciones(this)'>" + 
																							 "<span class='glyphicon glyphicon-edit'></span></button>" + 
																							 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
																							 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
																							 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
																							 "<span class='glyphicon glyphicon-arrow-down'></span></button>";


																objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
																objCeldaCodigoLinea.innerHTML = strCodigoLinea; 
																objCeldaLocalizacion.setAttribute('class', 'no-mostrar');
																objCeldaLocalizacion.innerHTML = strLocalizacion; 
																objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
																objCeldaTasaCuotaIva.innerHTML =  intTasaCuotaIva;
																objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
																objCeldaTasaCuotaIeps.innerHTML =  intTasaCuotaIeps;
																objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
																objCeldaCostoUnitarioBD.innerHTML =  intCostoUnitarioBD;
																objCeldaDescuentoUnitarioBD.setAttribute('class', 'no-mostrar');
																objCeldaDescuentoUnitarioBD.innerHTML =  intDescuentoUnitarioBD;
																objCeldaIvaUnitarioBD.setAttribute('class', 'no-mostrar');
																objCeldaIvaUnitarioBD.innerHTML =  intImporteIvaBD;
																objCeldaIepsUnitarioBD.setAttribute('class', 'no-mostrar');
																objCeldaIepsUnitarioBD.innerHTML =  intImporteIepsBD;
																objCeldaActualCosto.setAttribute('class', 'no-mostrar');
																objCeldaActualCosto.innerHTML = intActualCosto;
																objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
																objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento; 
																objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
																objCeldaPorcentajeIva.innerHTML = intPorcentajeIva; 
																objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
																objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;


															}//Fin del Ciclo For


															//Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	    											 	mostrar_retencion_isr_movimientos_entradas_refacciones_compra_refacciones('cargar_isr');

															//Hacer un llamado a la función para calcular totales de la tabla
															calcular_totales_detalles_movimientos_entradas_refacciones_compra_refacciones();

															//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
															var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_compra_refacciones tr").length - 2;
															$('#numElementos_detalles_movimientos_entradas_refacciones_compra_refacciones').html(intFilas);
															$('#txtNumDetalles_movimientos_entradas_refacciones_compra_refacciones').val(intFilas);

														}

											      	}
											      }
											      else
											      {
											      	    //Hacer un llamado a la función para mostrar mensaje de error
											      		mensaje_movimientos_entradas_refacciones_compra_refacciones('error', 'La ENTRADA POR COMPRA no puede agregarse. El <b>RFC del receptor</b> proporcionado en el archivo XML no coincide con el RFC de la empresa.');
											      }	 
										     },
									    'json');

										

								  }
								  else
								  {	
								  		//Hacer un llamado a la función para mostrar mensaje de error
								  		mensaje_movimientos_entradas_refacciones_compra_refacciones('error', 'La ENTRADA POR COMPRA no puede agregarse. El <b>proveedor</b> proporcionado en el archivo XML no se encuentra agregado en el catálogo de proveedores.');
								  }		

					      }
					      else
					      {
					      		//Hacer un llamado a la función para mostrar mensaje de error
					      		mensaje_movimientos_entradas_refacciones_compra_refacciones('error', 'La ENTRADA POR COMPRA no puede agregarse. La <b>moneda</b> proporcionada en el archivo XML no se encuentra agregada en el catálogo SAT moneda.');
					      }
				     
				     },
			    'json');
				
				//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes al XML
				//deshabilitar_controles_movimientos_entradas_refacciones_compra_refacciones('cargar_xml');

			  }//Cierre de verificación de entradas con la misma factura y proveedor del archivo XML

			};

			reader.readAsText(file);

		}

		//Función para regresar obtener los datos de una orden de compra
		function get_datos_orden_compra_movimientos_entradas_refacciones_compra_refacciones()
		{
			 

				$.ajax({
	                 //Hacer un llamado al método del controlador para regresar los datos de la orden de compra
	                 url: "refacciones/ordenes_compra_refacciones/get_datos",
	                 type: "post",
	                 dataType: "json",
	                 async: false,
	                 data: {
	                   intOrdenCompraRefaccionesID: $("#txtOrdenCompraRefaccionesID_movimientos_entradas_refacciones_compra_refacciones").val()
	                 },
	                 success: function( data ) {
	                   if(data.row){
	                    	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
							inicializar_detalles_movimientos_entradas_refacciones_compra_refacciones();
							//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes a la orden de compra
							deshabilitar_controles_movimientos_entradas_refacciones_compra_refacciones('cargar_orden_compra');

							//Recuperar valores
	             			$('#txtOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones').val(data.row.folio);
	             			$('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').val(data.row.moneda_id);
				            $('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').val(data.row.tipo_cambio);
				            $('#txtFactura_movimientos_entradas_refacciones_compra_refacciones').val(data.row.factura);
	             		    $('#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones').val(data.row.proveedor_id);
	             		    $('#txtProveedor_movimientos_entradas_refacciones_compra_refacciones').val(data.row.proveedor);
	             		    $('#txtPorcentajeRetencionID_movimientos_entradas_refacciones_compra_refacciones').val(data.row.porcentaje_retencion_id);
						    $('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').val(data.row.porcentaje_isr);
						  	
						  	
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
	             		      $('#txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones').val(intRegimenFiscalIDProv);

	             		       //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	    				   mostrar_retencion_isr_movimientos_entradas_refacciones_compra_refacciones('cargar_isr');
       	    				  
	             		    }
	             		    else
	             		    {
	             		    	//Asignar el id del régimen fiscal de la orden de compra (tabla ordenes_compra_refacciones)
	             		    	$('#txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones').val(intRegimenFiscalIDOC);

	             		    	//Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	    				    mostrar_retencion_isr_movimientos_entradas_refacciones_compra_refacciones('deshabilitar');
	             		    }

             		     

	             		    //Cargar refacciones adherentes a la orden de compra seleccionada
		                    if(data.detalles)
		                    {
				            	

				            	//Mostramos los detalles del registro
					           	for (var intCon in data.detalles) 
					            {
					            	//Obtenemos el objeto de la tabla
									var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_compra_refacciones').getElementsByTagName('tbody')[0];

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
									var objCeldaCodigoLinea = objRenglon.insertCell(10);
									var objCeldaLocalizacion = objRenglon.insertCell(11);
									var objCeldaTasaCuotaIva = objRenglon.insertCell(12);
									var objCeldaTasaCuotaIeps = objRenglon.insertCell(13);
									var objCeldaCostoUnitarioBD = objRenglon.insertCell(14);
									var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(15);
									var objCeldaIvaUnitarioBD = objRenglon.insertCell(16);
									var objCeldaIepsUnitarioBD = objRenglon.insertCell(17);

									//Variables que se utilizan para asignar valores del detalle
									var intSubtotal = parseFloat(data.detalles[intCon].precio_unitario);
									var intCantidad =  parseFloat(data.detalles[intCon].cantidad);
									var intCostoUnitario = parseFloat(data.detalles[intCon].precio_unitario);
									var intDescuentoUnitario = parseFloat(data.detalles[intCon].descuento_unitario);
									var intIvaUnitario = parseFloat(data.detalles[intCon].iva_unitario);
									var intIepsUnitario = parseFloat(data.detalles[intCon].ieps_unitario);
									var intActualCosto = parseFloat(data.detalles[intCon].actual_costo);
									var intImporteIva = 0;
									var intImporteIeps = 0;
									var intTotal = 0;
									//Variable que se utiliza para asignar  el color de fondo del registro
									var strEstiloRegistro = '';

									//Si el costo unitario es mayor que el costo actual de la refacción en el inventario
									if(intActualCosto > 0  && intCostoUnitario > intActualCosto)
									{
										//Asignar clase para cambiar el color de fondo
										strEstiloRegistro = 'registro-INACTIVO';
									}

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
									}

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
									}

									//Calcular importe total
									intTotal = intSubtotal + intImporteIva + intImporteIeps;


									//Cambiar cantidad a  formato moneda (a visualizar)
									intCantidad =  formatMoney(intCantidad, 2, '');
									
									var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
									
									var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
									
									var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
									
									var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
									
									var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
									
									var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
									

									//Cambiar cantidad a  formato moneda (a guardar en la  BD)
									var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');

									var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');

									var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');

									var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');


									//Asignar valores
									objRenglon.setAttribute('class', 'movil');
									objRenglon.setAttribute('id', data.detalles[intCon].refaccion_id);
									objCeldaCodigo.setAttribute('class', 'movil b1 '+strEstiloRegistro);
									objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
									objCeldaDescripcion.setAttribute('class', 'movil b2 '+strEstiloRegistro);
									objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
									objCeldaCantidad.setAttribute('class', 'movil b3 '+strEstiloRegistro);
									objCeldaCantidad.innerHTML = intCantidad;
									objCeldaCostoUnitario.setAttribute('class', 'movil b4 '+strEstiloRegistro);
									objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
									objCeldaDescuentoUnitario.setAttribute('class', 'movil b5 '+strEstiloRegistro);
									objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitarioMostrar;
									objCeldaSubtotal.setAttribute('class', 'movil b6 '+strEstiloRegistro);
									objCeldaSubtotal.innerHTML = intSubtotalMostrar;
									objCeldaIvaUnitario.setAttribute('class', 'movil b7 '+strEstiloRegistro);
									objCeldaIvaUnitario.innerHTML = intImporteIvaMostrar;
									objCeldaIepsUnitario.setAttribute('class', 'movil b8 '+strEstiloRegistro);
									objCeldaIepsUnitario.innerHTML = intImporteIepsMostrar;
									objCeldaTotal.setAttribute('class', 'movil b9 '+strEstiloRegistro);
									objCeldaTotal.innerHTML = intTotalMostrar;
									objCeldaAcciones.setAttribute('class', 'td-center movil b10 '+strEstiloRegistro);
									objCeldaAcciones.innerHTML = "";
									objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
									objCeldaCodigoLinea.innerHTML = data.detalles[intCon].codigo_linea; 
									objCeldaLocalizacion.setAttribute('class', 'no-mostrar');
									objCeldaLocalizacion.innerHTML =  data.detalles[intCon].localizacion;
									objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
									objCeldaTasaCuotaIva.innerHTML =  data.detalles[intCon].tasa_cuota_iva;
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
					            }

					            //Hacer un llamado a la función para calcular totales de la tabla
								calcular_totales_detalles_movimientos_entradas_refacciones_compra_refacciones();
								//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
								var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_compra_refacciones tr").length - 2;
								$('#numElementos_detalles_movimientos_entradas_refacciones_compra_refacciones').html(intFilas);
								$('#txtNumDetalles_movimientos_entradas_refacciones_compra_refacciones').val(intFilas);
					            
					        }


					        //Si existe retención de ISR (proveedor)
				           if(intRetencionIsrProv > 0)
				           {
				           		//Convertir peso mexicano a tipo de cambio
								intRetencionIsrProv = intRetencionIsrProv / intTipoCambio;

								$('#txtImporteRetenido_movimientos_entradas_refacciones_compra_refacciones').val(intRetencionIsrProv);
	             		        //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					       		 $('#txtImporteRetenido_movimientos_entradas_refacciones_compra_refacciones').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones });

				           }

	             		    


	                    }
	                 }
	               });
		}

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_movimientos_entradas_refacciones_compra_refacciones()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
            $('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
            $('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
            $('#txtCodigoLinea_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
            $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
            $("#txtTasaCuotaIva_detalles_movimientos_entradas_refacciones_compra_refacciones").val('');
            $("#txtPorcentajeIva_detalles_movimientos_entradas_refacciones_compra_refacciones").val('');
            $("#txtTasaCuotaIeps_detalles_movimientos_entradas_refacciones_compra_refacciones").val('');
            $("#txtPorcentajeIeps_detalles_movimientos_entradas_refacciones_compra_refacciones").val('');
            $('#txtLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
            $('#txtActualCosto_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
            
		}

		//Función para regresar obtener los datos de una refacción
		function get_datos_refaccion_detalles_movimientos_entradas_refacciones_compra_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los datos de la refacción
            $.post('refacciones/refacciones/get_datos',
                  { 
                  	strBusqueda:$("#txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones").val(),
		       		strTipo: 'id',
		       		intProveedorID: $("#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones").val()
                  },
                  function(data) {
                    if(data.row){
                   	   $("#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones").val(data.row.descripcion);
                   	   $("#txtCodigoLinea_detalles_movimientos_entradas_refacciones_compra_refacciones").val(data.row.codigo_linea);
                   	   $("#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones").val(data.row.ultimo_costo_proveedor);
                   	    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					    $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones });
                   	   $("#txtTasaCuotaIva_detalles_movimientos_entradas_refacciones_compra_refacciones").val(data.row.tasa_cuota_iva);
                       $("#txtPorcentajeIva_detalles_movimientos_entradas_refacciones_compra_refacciones").val(data.row.porcentaje_iva);
                       $("#txtTasaCuotaIeps_detalles_movimientos_entradas_refacciones_compra_refacciones").val(data.row.tasa_cuota_ieps);
                       $("#txtPorcentajeIeps_detalles_movimientos_entradas_refacciones_compra_refacciones").val(data.row.porcentaje_ieps);
                       $("#txtLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones").val(data.row.localizacion);
		               $("#txtActualCosto_detalles_movimientos_entradas_refacciones_compra_refacciones").val(data.row.actual_costo);
                       //Enfocar caja de texto
                  	   $("#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones").focus();
                    }
                  }
                 ,
                'json');
		}


		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_movimientos_entradas_refacciones_compra_refacciones()
		{
			//Variable que se utiliza para asignar el subtotal (costo unitario en la tabla movimientos_refacciones_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asigna el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intRefaccionID = $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			var strCodigo = $('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			var strDescripcion = $('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			var strCodigoLinea = $('#txtCodigoLinea_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			var intCantidad = $('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			var intCostoUnitario = $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			var strLocalizacion = $('#txtLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			var intActualCosto = $('#txtActualCosto_detalles_movimientos_entradas_refacciones_compra_refacciones').val();
			//Variable que se utiliza para asignar  el color de fondo del registro
			var strEstiloRegistro = '';

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_compra_refacciones').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intRefaccionID == '' || strCodigo == '')
			{
				//Enfocar caja de texto
				$('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			}
			else if (intRefaccionID == '' || strDescripcion == '')
			{
				//Enfocar caja de texto
				$('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			}
			else if (intCantidad == '')
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			}
			else if (intCostoUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
				$('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
				//Hacer un llamado a la función para inicializar elementos de la refacción
				inicializar_refaccion_detalles_movimientos_entradas_refacciones_compra_refacciones();
			   	
			    //Utilizar toUpperCase() para cambiar texto a mayúsculas
				strLocalizacion = strLocalizacion.toUpperCase();

			    //Convertir cadena de texto a número decimal
			    intCostoUnitario =  parseFloat($.reemplazar(intCostoUnitario, ",", ""));
				intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
				intSubtotal =  intCostoUnitario;
				intActualCosto =  parseFloat(intActualCosto);


				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					//Calcular descuento unitario
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;

					//Redondear cantidad a decimales
					intDescuentoUnitario = intDescuentoUnitario.toFixed(intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones);

					//Decrementar descuento unitario
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}
				
				//Si el costo unitario es mayor que el costo actual de la refacción en el inventario
				if(intActualCosto > 0  && intSubtotal > intActualCosto)
				{
					//Asignar clase para cambiar el color de fondo
					strEstiloRegistro = 'registro-INACTIVO';
				}

				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;

				//Redondear cantidad a decimales
				intSubtotal = intSubtotal.toFixed(intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesCompraRefacciones);
				intSubtotal = parseFloat(intSubtotal);

				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);

				//Redondear cantidad a dos decimales
			    intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaUnitBDMovimientosEntradasRefaccionesCompraRefacciones);
			    intImporteIva = parseFloat(intImporteIva);


				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps != '')
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
					//Redondear cantidad a dos decimales
			   	 	intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDMovimientosEntradasRefaccionesCompraRefacciones);
			   	 	intImporteIeps = parseFloat(intImporteIeps);
				}

				
				//Calcular importe total
				intTotal = parseFloat(intSubtotal + intImporteIva + intImporteIeps);

				//Cambiar cantidad a  formato moneda (a visualizar)
				intCantidad =  formatMoney(intCantidad, 2, '');
				
				var intCostoUnitarioMostrar =  formatMoney(intCostoUnitario, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
				
				var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
				
				var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');

				
				var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
				
				var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
				
				var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
				
				intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');

				//Cambiar cantidad a  formato moneda (a guardar en la  BD)
				var intCostoUnitarioBD =  formatMoney(intCostoUnitario, intNumDecimalesCostoUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
				
				var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
				
				var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
				
				var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');

			    //Revisamos si existe el ID proporcionado, si es así, editamos los datos
				if (objTabla.rows.namedItem(intRefaccionID))
				{
					//Agregar o quitar el color de fondo
					objTabla.rows.namedItem(intRefaccionID).cells[0].setAttribute('class', 'movil b1 '+strEstiloRegistro);
					objTabla.rows.namedItem(intRefaccionID).cells[1].setAttribute('class', 'movil b2 '+strEstiloRegistro);
					objTabla.rows.namedItem(intRefaccionID).cells[2].setAttribute('class', 'movil b3 '+strEstiloRegistro);
					objTabla.rows.namedItem(intRefaccionID).cells[3].setAttribute('class', 'movil b4 '+strEstiloRegistro);
					objTabla.rows.namedItem(intRefaccionID).cells[4].setAttribute('class', 'movil b5 '+strEstiloRegistro);
					objTabla.rows.namedItem(intRefaccionID).cells[5].setAttribute('class', 'movil b6 '+strEstiloRegistro);
					objTabla.rows.namedItem(intRefaccionID).cells[6].setAttribute('class', 'movil b7 '+strEstiloRegistro);
					objTabla.rows.namedItem(intRefaccionID).cells[7].setAttribute('class', 'movil b8 '+strEstiloRegistro);
					objTabla.rows.namedItem(intRefaccionID).cells[8].setAttribute('class', 'movil b9 '+strEstiloRegistro);
					objTabla.rows.namedItem(intRefaccionID).cells[9].setAttribute('class', 'td-center movil b10 '+strEstiloRegistro);

					//Asignar valores
					objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = intCantidad;
					objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML = intCostoUnitarioMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML = intDescuentoUnitarioMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[5].innerHTML =  intSubtotalMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[6].innerHTML = intImporteIvaMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[7].innerHTML = intImporteIepsMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[8].innerHTML = intTotalMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[10].innerHTML = strCodigoLinea;
					objTabla.rows.namedItem(intRefaccionID).cells[11].innerHTML = strLocalizacion;
					objTabla.rows.namedItem(intRefaccionID).cells[12].innerHTML = intTasaCuotaIva;
					objTabla.rows.namedItem(intRefaccionID).cells[13].innerHTML = intTasaCuotaIeps;
					objTabla.rows.namedItem(intRefaccionID).cells[14].innerHTML = intCostoUnitarioBD;
					objTabla.rows.namedItem(intRefaccionID).cells[15].innerHTML = intDescuentoUnitarioBD;
					objTabla.rows.namedItem(intRefaccionID).cells[16].innerHTML = intImporteIvaBD;
					objTabla.rows.namedItem(intRefaccionID).cells[17].innerHTML = intImporteIepsBD;
					objTabla.rows.namedItem(intRefaccionID).cells[18].innerHTML = intActualCosto;
					objTabla.rows.namedItem(intRefaccionID).cells[19].innerHTML = intPorcentajeDescuento;
					objTabla.rows.namedItem(intRefaccionID).cells[20].innerHTML = intPorcentajeIva;
					objTabla.rows.namedItem(intRefaccionID).cells[21].innerHTML = intPorcentajeIeps;
					

					

				}
				else
				{

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
					var objCeldaCodigoLinea = objRenglon.insertCell(10);
					var objCeldaLocalizacion = objRenglon.insertCell(11);
					var objCeldaTasaCuotaIva = objRenglon.insertCell(12);
					var objCeldaTasaCuotaIeps = objRenglon.insertCell(13);
					var objCeldaCostoUnitarioBD = objRenglon.insertCell(14);
					var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(15);
					var objCeldaIvaUnitarioBD = objRenglon.insertCell(16);
					var objCeldaIepsUnitarioBD = objRenglon.insertCell(17);
					var objCeldaActualCosto = objRenglon.insertCell(18);
					var objCeldaPorcentajeDescuento = objRenglon.insertCell(19);
					var objCeldaPorcentajeIva = objRenglon.insertCell(20);
					var objCeldaPorcentajeIeps = objRenglon.insertCell(21);
					
					
					
					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRefaccionID);
					objCeldaCodigo.setAttribute('class', 'movil b1 '+strEstiloRegistro);
					objCeldaCodigo.innerHTML = strCodigo;
					objCeldaDescripcion.setAttribute('class', 'movil b2 '+strEstiloRegistro);
					objCeldaDescripcion.innerHTML = strDescripcion;
					objCeldaCantidad.setAttribute('class', 'movil b3 '+strEstiloRegistro);
					objCeldaCantidad.innerHTML = intCantidad;
					objCeldaCostoUnitario.setAttribute('class', 'movil b4 '+strEstiloRegistro);
					objCeldaCostoUnitario.innerHTML = intCostoUnitarioMostrar;
					objCeldaDescuentoUnitario.setAttribute('class', 'movil b5 '+strEstiloRegistro);
					objCeldaDescuentoUnitario.innerHTML =intDescuentoUnitarioMostrar;
					objCeldaSubtotal.setAttribute('class', 'movil b6 '+strEstiloRegistro);
					objCeldaSubtotal.innerHTML = intSubtotalMostrar;
					objCeldaIvaUnitario.setAttribute('class', 'movil b7 '+strEstiloRegistro);
					objCeldaIvaUnitario.innerHTML = intImporteIvaMostrar;
					objCeldaIepsUnitario.setAttribute('class', 'movil b8 '+strEstiloRegistro);
					objCeldaIepsUnitario.innerHTML = intImporteIepsMostrar;
					objCeldaTotal.setAttribute('class', 'movil b9 '+strEstiloRegistro);
					objCeldaTotal.innerHTML = intTotalMostrar;
					objCeldaAcciones.setAttribute('class', 'td-center movil b10 '+strEstiloRegistro);
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_movimientos_entradas_refacciones_compra_refacciones(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_movimientos_entradas_refacciones_compra_refacciones(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
					objCeldaCodigoLinea.innerHTML = strCodigoLinea; 
					objCeldaLocalizacion.setAttribute('class', 'no-mostrar');
					objCeldaLocalizacion.innerHTML = strLocalizacion;
					objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIva.innerHTML = intTasaCuotaIva;
					objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIeps.innerHTML =  intTasaCuotaIeps;
					objCeldaCostoUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaCostoUnitarioBD.innerHTML =  intCostoUnitarioBD;
					objCeldaDescuentoUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaDescuentoUnitarioBD.innerHTML =  intDescuentoUnitarioBD;
					objCeldaIvaUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaIvaUnitarioBD.innerHTML =  intImporteIvaBD;
					objCeldaIepsUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaIepsUnitarioBD.innerHTML =  intImporteIepsBD;
					objCeldaActualCosto.setAttribute('class', 'no-mostrar');
					objCeldaActualCosto.innerHTML = intActualCosto;
					objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento; 
					objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIva.innerHTML = intPorcentajeIva; 
					objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
					
					
				}

				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_movimientos_entradas_refacciones_compra_refacciones();
				
				//Enfocar caja de texto
				$('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_compra_refacciones tr").length - 2;
			$('#numElementos_detalles_movimientos_entradas_refacciones_compra_refacciones').html(intFilas);
			$('#txtNumDetalles_movimientos_entradas_refacciones_compra_refacciones').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_movimientos_entradas_refacciones_compra_refacciones(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtCodigoLinea_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtTasaCuotaIva_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtTasaCuotaIeps_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtActualCosto_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.cells[18].innerHTML);
			$('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.cells[19].innerHTML);
			$('#txtPorcentajeIva_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.cells[20].innerHTML);
			$('#txtPorcentajeIeps_detalles_movimientos_entradas_refacciones_compra_refacciones').val(objRenglon.parentNode.parentNode.cells[21].innerHTML);
		

			//Enfocar caja de texto
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_movimientos_entradas_refacciones_compra_refacciones(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_movimientos_entradas_refacciones_compra_refacciones").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_movimientos_entradas_refacciones_compra_refacciones();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_movimientos_entradas_refacciones_compra_refacciones tr").length - 2;
			$('#numElementos_detalles_movimientos_entradas_refacciones_compra_refacciones').html(intFilas);
			$('#txtNumDetalles_movimientos_entradas_refacciones_compra_refacciones').val(intFilas);

			//Enfocar caja de texto
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_movimientos_entradas_refacciones_compra_refacciones()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_movimientos_entradas_refacciones_compra_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Variable que se utiliza para asignar el acumulado anterior del subtotal (en caso de que existan cambios calcular retención de ISR (proveedor) de lo contrario conservar el importe de retención (puede darse el caso de que el usuario modifique dicho importe))
			var intAcumSubtotalAnterior = $('#acumSubtotal_detalles_movimientos_entradas_refacciones_compra_refacciones').html();

			//Variable que se utiliza para contar el número de registros
			var intContReg = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[8].innerHTML, ",", ""));

				//Incrementar contador por cada registro recorridp
				intContReg++;

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, intNumDecimalesDescUnitBDMovimientosEntradasRefaccionesCompraRefacciones, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');

			//Asignar los valores
			$('#acumCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').html(intAcumUnidades);
			$('#acumDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').html(intAcumDescuento);
			$('#acumSubtotal_detalles_movimientos_entradas_refacciones_compra_refacciones').html(intAcumSubtotal);
			$('#acumIva_detalles_movimientos_entradas_refacciones_compra_refacciones').html(intAcumIva);
			$('#acumIeps_detalles_movimientos_entradas_refacciones_compra_refacciones').html(intAcumIeps);
			$('#acumTotal_detalles_movimientos_entradas_refacciones_compra_refacciones').html(intAcumTotal);

			//Si no existe id del movimiento, significa que es un nuevo registro
			if($('#txtMovimientoRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val() == '' && intContReg == 1)
			{
				//Asignar el contador para calcular el isr del único detalle
				intAcumSubtotalAnterior = intContReg;


			}

			//Si hubo cambios en el acumulado del subtotal
			if(intAcumSubtotalAnterior != intAcumSubtotal && intAcumSubtotalAnterior != '')
			{
				//Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_movimientos_entradas_refacciones_compra_refacciones();
			}
		}


		//Función que se utiliza para calcular la retención de ISR (proveedor)
		function calcular_isr_movimientos_entradas_refacciones_compra_refacciones()
		{
			
			 //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt($('#txtRegimenFiscalID_movimientos_entradas_refacciones_compra_refacciones').val()) == intRegimenFiscalIDResicoMovimientosEntradasRefaccionesCompraRefacciones)
       	     {
       	     	//Variable que se utiliza para asignar el importe retenido
       	     	var intImporteRetenido = 0;
       	     	//Variable que se utiliza para asignar el acumulado del subtotal
				var intAcumSubtotal = 0;

       	     	//Hacer un llamado a la función para reemplazar '$' y  ','  por cadena vacia
				intAcumSubtotal =  $.reemplazar($('#acumSubtotal_detalles_movimientos_entradas_refacciones_compra_refacciones').html(), "$", "");
				intAcumSubtotal =  $.reemplazar(intAcumSubtotal, ",", "");

				//Si existe porcentaje de ISR (proveedor)
				if($('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').val() != '' && intAcumSubtotal > 0 )
				{
					//Variable que se utiliza para asignar el porcentaje de retención ISR
					var intPorcentajeRetencionIsr = parseFloat($('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').val());

					//Calcular retención de ISR 
					intImporteRetenido = parseFloat(intAcumSubtotal * intPorcentajeRetencionIsr);
					//Redondear cantidad a decimales
					intImporteRetenido = intImporteRetenido.toFixed(intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones);
					intImporteRetenido = parseFloat(intImporteRetenido);
				}

				//Convertir cantidad a formato moneda
				intImporteRetenido = formatMoney(intImporteRetenido, intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones, '');

				//Asignar importe retenido 
				$('#txtImporteRetenido_movimientos_entradas_refacciones_compra_refacciones').val(intImporteRetenido);

       	     }
		}



		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').numeric();
			$('#txtTotalUnidades_movimientos_entradas_refacciones_compra_refacciones').numeric();
			$('#txtImporteTotal_movimientos_entradas_refacciones_compra_refacciones').numeric();
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').numeric();
			$('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').numeric();
        	$('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').numeric();
        	$('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').numeric();
        	$('#txtImporteRetenido_movimientos_entradas_refacciones_compra_refacciones').numeric();
        	
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_movimientos_entradas_refacciones_compra_refacciones').blur(function(){
				$('.moneda_movimientos_entradas_refacciones_compra_refacciones').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarMovimientosEntradasRefaccionesCompraRefacciones });
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 18.90 será 18.9000*/
        	$('.tipo-cambio_movimientos_entradas_refacciones_compra_refacciones').blur(function(){
				$('.tipo-cambio_movimientos_entradas_refacciones_compra_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_movimientos_entradas_refacciones_compra_refacciones').blur(function(){
                $('.cantidad_movimientos_entradas_refacciones_compra_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_movimientos_entradas_refacciones_compra_refacciones').datetimepicker({format: 'DD/MM/YYYY'});

			//Regresar el tipo de cambio de la moneda cuando cambie la fecha
			$('#dteFecha_movimientos_entradas_refacciones_compra_refacciones').on('dp.change', function (e) {
				//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_movimientos_entradas_refacciones_compra_refacciones();
			});


	        //Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').val()) === intMonedaBaseIDMovimientosEntradasRefaccionesCompraRefacciones)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').val(intTipoCambioMonedaBaseMovimientosEntradasRefaccionesCompraRefacciones);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
					
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').val('');
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_movimientos_entradas_refacciones_compra_refacciones();
             	}

	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoMovimientosEntradasRefaccionesCompraRefacciones)
	        	{
	        		$('#txtTipoCambio_movimientos_entradas_refacciones_compra_refacciones').val(intTipoCambioMaximoMovimientosEntradasRefaccionesCompraRefacciones);
	        	}

		    });

	        //Autocomplete para recuperar los datos de una orden de compra de refacciones
	        $('#txtOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtOrdenCompraRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la orden de compra de refacciones
	               inicializar_orden_compra_movimientos_entradas_refacciones_compra_refacciones();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/ordenes_compra_refacciones/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strFormulario: 'entradas_refacciones_compra'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	              //Asignar id del registro seleccionado
	              $('#txtOrdenCompraRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val(ui.item.data);
	              //Elegir serie desde el valor devuelto en el autocomplete
				  ui.item.value = ui.item.value.split(" - ")[0];
	              //Hacer un llamado a la función para regresar los datos de la orden de compra
	              get_datos_orden_compra_movimientos_entradas_refacciones_compra_refacciones();
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
	        $('#txtOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones').focusout(function(e){
	            //Si no existe id de la orden de compra
	            if($('#txtOrdenCompraRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val() == '' ||
	               $('#txtOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtOrdenCompraRefaccionesID_movimientos_entradas_refacciones_compra_refacciones').val('');
	               $('#txtOrdenCompraRefacciones_movimientos_entradas_refacciones_compra_refacciones').val('');
	            }

	        });


	        //Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedor_movimientos_entradas_refacciones_compra_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones').val('');
	                //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_movimientos_entradas_refacciones_compra_refacciones();
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
	             //Hacer un llamado a la función para asignar los datos del proveedor 
	       	     get_datos_proveedor_movimientos_entradas_refacciones_compra_refacciones(ui);

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
	        $('#txtProveedor_movimientos_entradas_refacciones_compra_refacciones').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones').val() == '' ||
	               $('#txtProveedor_movimientos_entradas_refacciones_compra_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorID_movimientos_entradas_refacciones_compra_refacciones').val('');
	               $('#txtProveedor_movimientos_entradas_refacciones_compra_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_movimientos_entradas_refacciones_compra_refacciones();
	            }

	        });


	        //Autocomplete para recuperar los datos de un porcentaje de retención ISR 
	        $('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtPorcentajeRetencionID_movimientos_entradas_refacciones_compra_refacciones').val('');
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
	             $('#txtPorcentajeRetencionID_movimientos_entradas_refacciones_compra_refacciones').val(ui.item.data);
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
	        $('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtPorcentajeRetencionID_movimientos_entradas_refacciones_compra_refacciones').val() == '' ||
	               $('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtPorcentajeRetencionID_movimientos_entradas_refacciones_compra_refacciones').val('');
	               $('#txtPorcentajeIsr_movimientos_entradas_refacciones_compra_refacciones').val('');
	            }

	           //Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_movimientos_entradas_refacciones_compra_refacciones();
	            
	        });

	        //Habilitar o deshabilitar remisión cuando pierda el enfoque la caja de texto
	        $('#txtFactura_movimientos_entradas_refacciones_compra_refacciones').focusout(function(e){
	            //Si existe la factura
	            if($('#txtFactura_movimientos_entradas_refacciones_compra_refacciones').val() != '')
	            { 
	               //Limpiar caja de texto
	               $("#txtRemision_movimientos_entradas_refacciones_compra_refacciones").val('');
	               //Deshabilitar caja de texto
				   $("#txtRemision_movimientos_entradas_refacciones_compra_refacciones").attr('disabled','disabled');
	            }
	            else
	            {
	            	//Habilitar caja de texto
	            	$('#txtRemision_movimientos_entradas_refacciones_compra_refacciones').removeAttr('disabled');
	            }

	        });
 			
 			//Autocomplete para recuperar los datos de una refacción
	        $('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones/autocomplete",
	                   type: "post",
	                   dataType: "json",
	                   data: {
	                     strDescripcion: request.term,
	                     strTipo: 'codigo'
	                   },
	                   success: function( data ) {
	                     response( data );
	                   }
	                 });
	             },
	             select: function( event, ui ) {
	                //Asignar id del registro seleccionado
	                $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones').val(ui.item.data);
	               	//Hacer un llamado a la función para regresar los datos de la refacción
	               	get_datos_refaccion_detalles_movimientos_entradas_refacciones_compra_refacciones();
	                //Elegir código desde el valor devuelto en el autocomplete
					ui.item.value = ui.item.value.split(" - ")[0];
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la refacción cuando pierda el enfoque la caja de texto
	        $('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').focusout(function(e){
	            //Si no existe id de la refacción
	            if($('#txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones').val() == '' ||
	               $('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').val() == '')
	            { 
	               	//Hacer un llamado a la función para inicializar elementos de la refacción
	              	inicializar_refaccion_detalles_movimientos_entradas_refacciones_compra_refacciones();
	               
	            }

	        });

	        //Autocomplete para recuperar los datos de una refacción
	        $('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones/autocomplete",
	                   type: "post",
	                   dataType: "json",
	                   data: {
	                     strDescripcion: request.term,
	                     strTipo: 'descripcion'
	                   },
	                   success: function( data ) {
	                     response( data );
	                   }
	                 });
	             },
	             select: function( event, ui ) {
	                //Asignar id del registro seleccionado
	                $('#txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones').val(ui.item.data);
	                //Elegir código desde el valor devuelto en el autocomplete
					var strCodigo = ui.item.value.split(" - ")[0];
					$('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').val(strCodigo);
	                //Hacer un llamado a la función para regresar los datos de la refacción
	               	get_datos_refaccion_detalles_movimientos_entradas_refacciones_compra_refacciones();
	               
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la refacción cuando pierda el enfoque la caja de texto
	        $('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').focusout(function(e){
	            //Si no existe id de la refacción
	            if($('#txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones').val() == '' ||
	               $('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').val() == '')
	            { 
	             	//Hacer un llamado a la función para inicializar elementos de la refacción
	              	inicializar_refaccion_detalles_movimientos_entradas_refacciones_compra_refacciones();
	            }

	        });


			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_movimientos_entradas_refacciones_compra_refacciones').on('click','button.btn',function(){
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

	        //Validar que exista código de la refacción cuando se pulse la tecla enter 
			$('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
			   	    //Si no existe código de la refacción
		            if($('#txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones').val() == '' || $('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCodigo_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			   	    }
		        }
		    });

		    //Validar que exista descripción de la refacción cuando se pulse la tecla enter 
			$('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe descripción de la refacción
		            if($('#txtRefaccionID_detalles_movimientos_entradas_refacciones_compra_refacciones').val() == '' || $('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtDescripcion_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			   	    }
		        }
		    });

		     //Validar que exista localización cuando se pulse la tecla enter 
			$('#txtLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe localización de la refacción en el inventario
		            if($('#txtLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtLocalizacion_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			   	    }
		        }
		    });

			//Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtCostoUnitario_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_movimientos_entradas_refacciones_compra_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_detalles_movimientos_entradas_refacciones_compra_refacciones();
			   	    }
		        }
		    });

			

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_movimientos_entradas_refacciones_compra_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_movimientos_entradas_refacciones_compra_refacciones').datetimepicker({format: 'DD/MM/YYYY',
			 																		                            useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_movimientos_entradas_refacciones_compra_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_movimientos_entradas_refacciones_compra_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_movimientos_entradas_refacciones_compra_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_movimientos_entradas_refacciones_compra_refacciones').data('DateTimePicker').maxDate(e.date);
			});
			
			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedorBusq_movimientos_entradas_refacciones_compra_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorIDBusq_movimientos_entradas_refacciones_compra_refacciones').val('');
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
	             $('#txtProveedorIDBusq_movimientos_entradas_refacciones_compra_refacciones').val(ui.item.data);
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
	        $('#txtProveedorBusq_movimientos_entradas_refacciones_compra_refacciones').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorIDBusq_movimientos_entradas_refacciones_compra_refacciones').val() == '' ||
	               $('#txtProveedorBusq_movimientos_entradas_refacciones_compra_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorIDBusq_movimientos_entradas_refacciones_compra_refacciones').val('');
	               $('#txtProveedorBusq_movimientos_entradas_refacciones_compra_refacciones').val('');
	            }

	        });

	        //Paginación de registros
			$('#pagLinks_movimientos_entradas_refacciones_compra_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaMovimientosEntradasRefaccionesCompraRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_movimientos_entradas_refacciones_compra_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_movimientos_entradas_refacciones_compra_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_movimientos_entradas_refacciones_compra_refacciones('Nuevo');
				//Abrir modal
				objMovimientosEntradasRefaccionesCompraRefacciones = $('#MovimientosEntradasRefaccionesCompraRefaccionesBox').bPopup({
											   appendTo: '#MovimientosEntradasRefaccionesCompraRefaccionesContent', 
				                               contentContainer: 'MovimientosEntradasRefaccionesCompraRefaccionesM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#cmbMonedaID_movimientos_entradas_refacciones_compra_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_movimientos_entradas_refacciones_compra_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_movimientos_entradas_refacciones_compra_refacciones();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_movimientos_entradas_refacciones_compra_refacciones();
		});
	</script>