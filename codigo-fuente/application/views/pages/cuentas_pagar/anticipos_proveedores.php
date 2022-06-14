<div id="AnticiposProveedoresCuentasPagarContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_anticipos_proveedores_cuentas_pagar" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_anticipos_proveedores_cuentas_pagar">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_anticipos_proveedores_cuentas_pagar'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_anticipos_proveedores_cuentas_pagar"
			                    		name= "strFechaInicialBusq_anticipos_proveedores_cuentas_pagar" 
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
							<label for="txtFechaFinalBusq_anticipos_proveedores_cuentas_pagar">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_anticipos_proveedores_cuentas_pagar'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_anticipos_proveedores_cuentas_pagar"
			                    		name= "strFechaFinalBusq_anticipos_proveedores_cuentas_pagar" 
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
				<!--Autocomplete que contiene los proveedores activos-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtProveedorBusq_anticipos_proveedores_cuentas_pagar">Proveedor</label>
						</div>
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
							<input  class="form-control" 
									id="txtProveedorIDBusq_anticipos_proveedores_cuentas_pagar" 
									name="intProveedorBusqID_anticipos_proveedores_cuentas_pagar" 
									type="hidden" />
							<input  class="form-control" 
									id="txtProveedorBusq_anticipos_proveedores_cuentas_pagar" 
									name="strProveedorBusq_anticipos_proveedores_cuentas_pagar" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese proveedor" maxlength="250"/>
						</div>
					</div>
				</div>
				<!--Estatus-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="cmbEstatusBusq_anticipos_proveedores_cuentas_pagar">Estatus</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="cmbEstatusBusq_anticipos_proveedores_cuentas_pagar" 
							 		name="strEstatusBusq_anticipos_proveedores_cuentas_pagar" tabindex="1">
							    <option value="TODOS">TODOS</option>
                  				<option value="ACTIVO">ACTIVO</option>
                  				<option value="PARCIALMENTE APLICADO">PARCIALMENTE APLICADO</option>
                  				<option value="APLICADO">APLICADO</option>
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
							<label for="txtBusqueda_anticipos_proveedores_cuentas_pagar">Descripción</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtBusqueda_anticipos_proveedores_cuentas_pagar" 
									name="strBusqueda_anticipos_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Mostrar detalles de los registros en el reporte PDF--> 
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
					<div class="checkbox">
                    	<label id="label-checkbox">
                        	<input class="form-control" 
                        			id="chbImprimirDetalles_anticipos_proveedores_cuentas_pagar" 
								   	name="strImprimirDetalles_anticipos_proveedores_cuentas_pagar" 
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
						<button class="btn btn-primary" id="btnBuscar_anticipos_proveedores_cuentas_pagar"
								onclick="paginacion_anticipos_proveedores_cuentas_pagar();" 
								title="Buscar coincidencias" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<!--Dar de alta un nuevo registro-->
						<button class="btn btn-info" id="btnNuevo_anticipos_proveedores_cuentas_pagar" 
								title="Nuevo registro" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>   
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_anticipos_proveedores_cuentas_pagar"
								onclick="reporte_anticipos_proveedores_cuentas_pagar('PDF');" title="Generar reporte PDF" tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_anticipos_proveedores_cuentas_pagar"
								onclick="reporte_anticipos_proveedores_cuentas_pagar('XLS');" title="Descargar archivo XLS" tabindex="1" disabled>
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
			Definir columnas de la tabla anticipos
			*/
			td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
			td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
			td.movil.a3:nth-of-type(3):before {content: "Proveedor"; font-weight: bold;}
			td.movil.a4:nth-of-type(4):before {content: "Cuenta"; font-weight: bold;}
			td.movil.a5:nth-of-type(5):before {content: "Importe"; font-weight: bold;}
			td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
			td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

			/*
			Definir columnas de la tabla detalles del anticipo
			*/
			td.movil.b1:nth-of-type(1):before {content: "Concepto"; font-weight: bold;}
			td.movil.b2:nth-of-type(2):before {content: "Subtotal"; font-weight: bold;}
			td.movil.b3:nth-of-type(3):before {content: "IVA"; font-weight: bold;}
			td.movil.b4:nth-of-type(4):before {content: "IEPS"; font-weight: bold;}
			td.movil.b5:nth-of-type(5):before {content: "Total"; font-weight: bold;}
			td.movil.b6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

			/*
			Definir columnas de los totales (acumulados) de la tabla detalles del anticipo
			*/
			td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
			td.movil.t2:nth-of-type(2):before {content: "Subtotal"; font-weight: bold;}
			td.movil.t3:nth-of-type(3):before {content: "IVA"; font-weight: bold;}
			td.movil.t4:nth-of-type(4):before {content: "IEPS"; font-weight: bold;}
			td.movil.t5:nth-of-type(5):before {content: "Total"; font-weight: bold;}

		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_anticipos_proveedores_cuentas_pagar">
				<thead class="movil">
					<tr class="movil">
						<th class="movil">Folio</th>
						<th class="movil">Fecha</th>
						<th class="movil">Proveedor</th>
						<th class="movil">Cuenta</th>
						<th class="movil">Importe</th>
						<th class="movil">Estatus</th>
						<th class="movil" id="th-acciones" style="width:20em;">Acciones</th>
					</tr>
				</thead>
				<tbody class="movil"></tbody>
				<script id="plantilla_anticipos_proveedores_cuentas_pagar" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil a1">{{folio}}</td>
						<td class="movil a2">{{fecha}}</td>
						<td class="movil a3">{{proveedor}}</td>
						<td class="movil a4">{{cuenta_bancaria}}</td>
						<td class="movil a5">{{total}}</td>
						<td class="movil a6">{{estatus}}</td>
						<td class="td-center movil a7"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_anticipos_proveedores_cuentas_pagar({{anticipo_proveedor_id}})"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_anticipos_proveedores_cuentas_pagar({{anticipo_proveedor_id}})"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_anticipos_proveedores_cuentas_pagar({{anticipo_proveedor_id}});"  title="Imprimir registro en PDF"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Subir varios archivos-->
							<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
								<span class="btn  btn-default btn-xs fileinput-button ">
							    	<span class="fa fa-upload"></span>
									<input name="archivo_varios_anticipos_proveedores_cuentas_pagar{{anticipo_proveedor_id}}[]" id="archivo_varios_anticipos_proveedores_cuentas_pagar{{anticipo_proveedor_id}}"  type="file" multiple accept="text/xml,application/pdf" 
										   onchange="subir_archivos_grid_anticipos_proveedores_cuentas_pagar({{anticipo_proveedor_id}});">
							  		</input>
							    </span>
							</span>
							<!--Descargar archivo-->
                        	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                        			 onmousedown="descargar_archivos_anticipos_proveedores_cuentas_pagar({{anticipo_proveedor_id}}, '{{folio}}');" title="Descargar archivo">
                        		<span class="glyphicon glyphicon-download-alt"></span>
                        	</button>
                        	<!--Eliminar archivo-->
                        	<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}" 
                        			 onmousedown="eliminar_archivos_anticipos_proveedores_cuentas_pagar({{anticipo_proveedor_id}});" title="Eliminar archivo">
                        		<span class="glyphicon glyphicon-export"></span>
                        	</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_anticipos_proveedores_cuentas_pagar({{anticipo_proveedor_id}},'{{estatus}}')" title="Desactivar">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
									onclick="cambiar_estatus_anticipos_proveedores_cuentas_pagar({{anticipo_proveedor_id}},'{{estatus}}')"  title="Restaurar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_anticipos_proveedores_cuentas_pagar"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_anticipos_proveedores_cuentas_pagar">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!-- Diseño del modal-->
	<div id="AnticiposProveedoresCuentasPagarBox" class="ModalBody">
		<!--Título-->
		<div id="divEncabezadoModal_anticipos_proveedores_cuentas_pagar"  class="ModalBodyTitle">
			<h1>Anticipos a Proveedores</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form 	id="frmAnticiposProveedoresCuentasPagar" method="post" 
					action="#" class="form-horizontal" role="form" 
				  	name="frmAnticiposProveedoresCuentasPagar" onsubmit="return(false)" autocomplete="off">
				<div class="row">
				  	<!-- Folio -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input 	id="txtAnticipoProveedorID_anticipos_proveedores_cuentas_pagar" 
										name="intAnticipoProveedorID_anticipos_proveedores_cuentas_pagar" 
										type="hidden" 
										value="" />
								<label for="txtFolio_anticipos_proveedores_cuentas_pagar">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtFolio_anticipos_proveedores_cuentas_pagar" 
										name="strFolio_anticipos_proveedores_cuentas_pagar" 
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
								<label for="txtFecha_anticipos_proveedores_cuentas_pagar">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_anticipos_proveedores_cuentas_pagar'>
				                    <input class="form-control" 
				                    		id="txtFecha_anticipos_proveedores_cuentas_pagar"
				                    		name= "strFecha_anticipos_proveedores_cuentas_pagar" 
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
					<!--Combobox que contiene las monedas activas-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbMonedaID_anticipos_proveedores_cuentas_pagar">Moneda</label>
							</div>
							<div id="divCmbMsjValidacion" class="col-md-12">
								<select class="form-control" id="cmbMonedaID_anticipos_proveedores_cuentas_pagar" 
								 		name="intMonedaID_anticipos_proveedores_cuentas_pagar" tabindex="1">
                 				</select>
							</div>
						</div>
					</div>
					<!--Tipo de cambio-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtTipoCambio_anticipos_proveedores_cuentas_pagar">Tipo de cambio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control tipo-cambio_anticipos_proveedores_cuentas_pagar" 
										id="txtTipoCambio_anticipos_proveedores_cuentas_pagar" 
										name="intTipoCambio_anticipos_proveedores_cuentas_pagar" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese tipo de cambio" 
										maxlength="11" />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Referencia-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtReferencia_anticipos_proveedores_cuentas_pagar">Folio proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtReferencia_anticipos_proveedores_cuentas_pagar" 
										name="strReferencia_anticipos_proveedores_cuentas_pagar" 
										type="text" value="" tabindex="1" placeholder="Ingrese folio" maxlength="10">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los proveedores activos-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
								<input 	id="txtProveedorID_anticipos_proveedores_cuentas_pagar" 
										name="intProveedorID_anticipos_proveedores_cuentas_pagar" 
										type="hidden" 
										value="" />
								<!-- Caja de texto oculta para recuperar la razón social del proveedor seleccionado-->
								<input 	id="txtRazonSocial_anticipos_proveedores_cuentas_pagar" 
										name="strRazonSocial_anticipos_proveedores_cuentas_pagar" 
										type="hidden" 
										value="" />		
								<label for="txtProveedor_anticipos_proveedores_cuentas_pagar">Proveedor</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtProveedor_anticipos_proveedores_cuentas_pagar" 
										name="strProveedor_anticipos_proveedores_cuentas_pagar" 
										type="text" value="" tabindex="1" 
										placeholder="Ingrese proveedor" maxlength="250" />
							</div>
						</div>
					</div>
					<!--RFC del proveedor-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtRfc_anticipos_proveedores_cuentas_pagar">RFC</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtRfc_anticipos_proveedores_cuentas_pagar" 
										name="strRfc_anticipos_proveedores_cuentas_pagar" 
										type="text" value="" disabled />
							</div>
						</div>
					</div>	
				</div>
				<div class="row">
					<!--Autocomplete que contiene las cuentas bancarias activas-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<input 	id="txtCuentaBancariaID_anticipos_proveedores_cuentas_pagar" 
										name="intCuentaBancariaID_anticipos_proveedores_cuentas_pagar" 
										type="hidden" 
										value="" />
								<label for="txtCuentaBancaria_anticipos_proveedores_cuentas_pagar">Cuenta</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtCuentaBancaria_anticipos_proveedores_cuentas_pagar" 
										name="strCuentaBancaria_anticipos_proveedores_cuentas_pagar" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese cuenta bancaria" 
										maxlength="250" />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Observaciones -->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtObservaciones_anticipos_proveedores_cuentas_pagar">Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_anticipos_proveedores_cuentas_pagar" 
										name="strObservaciones_anticipos_proveedores_cuentas_pagar" 
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
								<!--Div input-group no-mostrar que se utiliza para evitar que el mensaje de validación se muestre en el input-group -->
								<div class='input-group no-mostrar' >
									<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
									<input id="txtNumDetalles_anticipos_proveedores_cuentas_pagar" 
									   name="intNumDetalles_anticipos_proveedores_cuentas_pagar" type="hidden" value="">
									</input>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Detalles del anticipo</h4>
									</div>
									<div class="panel-body">
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<div class="row">
												<!--Concepto-->
												<div  class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
													<div class="form-group">
														<div class="col-md-12">
															<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
															<input id="txtRenglon_detalles_anticipos_proveedores_cuentas_pagar" 
																   name="intRenglon_detalles_anticipos_proveedores_cuentas_pagar" type="hidden" value="">
															</input>
															<label for="txtConcepto_detalles_anticipos_proveedores_cuentas_pagar">Concepto</label>
														</div>
														<div class="col-md-12">
															<input  class="form-control" id="txtConcepto_detalles_anticipos_proveedores_cuentas_pagar" 
																	name="strConcepto_detalles_anticipos_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese concepto" maxlength="250">
															</input>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<!--Subtotal-->
												<div class="col-sm-3 col-md-3 col-lg-3 col-xs-10">
													<div class="form-group">
														<div class="col-md-12">
															<label for="txtSubtotal_detalles_anticipos_proveedores_cuentas_pagar">Subtotal</label>
														</div>
														<div class="col-md-12">
															<div class='input-group'>
																<span class="input-group-addon">$</span>
																<input  class="form-control moneda_anticipos_proveedores_cuentas_pagar" id="txtSubtotal_detalles_anticipos_proveedores_cuentas_pagar" 
																		name="intSubtotal_detalles_anticipos_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese subtotal" maxlength="21">
																</input>
															</div>
														</div>
													</div>
												</div>
												<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
												<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
													<div class="form-group">
														<div class="col-md-12">
															<!-- Caja de texto oculta para asignar el importe del IVA-->
															<input id="txtIva_detalles_anticipos_proveedores_cuentas_pagar" 
																   name="intIva_detalles_anticipos_proveedores_cuentas_pagar" 
																   type="hidden" value="">
															</input>
															<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
															<input id="txtTasaCuotaIva_detalles_anticipos_proveedores_cuentas_pagar" 
																   name="intTasaCuotaIva_detalles_anticipos_proveedores_cuentas_pagar" 
																   type="hidden" value="">
															</input>
															<label for="txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar">IVA %</label>
														</div>
														<div class="col-md-12">
															<input  class="form-control" id="txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar" 
																	name="intPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar" type="text" value="" 
																	tabindex="1" placeholder="Ingrese IVA" maxlength="250">
															</input>
														</div>
													</div>
												</div>
												<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
												<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
													<div class="form-group">
														<div class="col-md-12">
															<!-- Caja de texto oculta para asignar el importe del IEPS-->
															<input id="txtIeps_detalles_anticipos_proveedores_cuentas_pagar" 
																   name="intIeps_detalles_anticipos_proveedores_cuentas_pagar" 
																   type="hidden" value="">
															</input>
															<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
															<input id="txtTasaCuotaIeps_detalles_anticipos_proveedores_cuentas_pagar" 
																   name="intTasaCuotaIeps_detalles_anticipos_proveedores_cuentas_pagar" 
																   type="hidden" value="">
															</input>
															<label for="txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar">IEPS %</label>
														</div>
														<div class="col-md-12">
															<input  class="form-control" id="txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar" 
																	name="intPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar" type="text" value="" 
																	tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
															</input>
														</div>
													</div>
												</div>
												<!--Total-->
												<div class="col-sm-3 col-md-3 col-lg-3 col-xs-10">
													<div class="form-group">
														<div class="col-md-12">
															<label for="txtTotal_detalles_anticipos_proveedores_cuentas_pagar">Total</label>
														</div>
														<div class="col-md-12">
															<div class='input-group'>
																<span class="input-group-addon">$</span>
																<input  class="form-control" id="txtTotal_detalles_anticipos_proveedores_cuentas_pagar" 
																		name="intTotal_detalles_anticipos_proveedores_cuentas_pagar" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
												</div>
												<!--Botón agregar-->
				                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
				                                	<button class="btn btn-primary btn-toolBtns pull-right" 
				                                			id="btnAgregar_detalles_anticipos_proveedores_cuentas_pagar"
				                                			onclick="agregar_renglon_detalles_anticipos_proveedores_cuentas_pagar();" 
				                                	     	title="Agregar" tabindex="1"> 
				                                		<span class="glyphicon glyphicon-plus"></span>
				                                	</button>
				                             	</div>
											</div>
										</div>
										<!--Div que contiene la tabla con los detalles encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<div class="row ">
												<!-- Diseño de la tabla-->
												<table class="table-hover movil" id="dg_detalles_anticipos_proveedores_cuentas_pagar">
													<thead class="movil">
														<tr class="movil">
															<th class="movil">Concepto</th>
															<th class="movil">Subtotal</th>
															<th class="movil">IVA</th>
															<th class="movil">IEPS</th>
															<th class="movil">Total</th>
															<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
														</tr>
													</thead>
													<tbody class="movil"></tbody>
													<tfoot class="movil">
														<!--Totales-->
														<tr class="movil">
															<td class="movil t1">
																<strong>Total</strong>
															</td>
															<td  class="movil t2">
																<strong id="acumSubtotal_detalles_anticipos_proveedores_cuentas_pagar"></strong>
															</td>
															<td  class="movil t3">
																<strong id="acumIva_detalles_anticipos_proveedores_cuentas_pagar"></strong>
															</td>
															<td  class="movil t4">
																<strong id="acumIeps_detalles_anticipos_proveedores_cuentas_pagar"></strong>
															</td>
															<td  class="movil t5">
																<strong id="acumTotal_detalles_anticipos_proveedores_cuentas_pagar"></strong>
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
															<strong id="numElementos_detalles_anticipos_proveedores_cuentas_pagar">0</strong> encontrados
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
						<!--Nuevo registro-->
						<button class="btn btn-info" id="btnReiniciar_anticipos_proveedores_cuentas_pagar"  
								onclick="nuevo_anticipos_proveedores_cuentas_pagar('Nuevo');"  title="Nuevo registro" tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_anticipos_proveedores_cuentas_pagar"  
								onclick="validar_anticipos_proveedores_cuentas_pagar();"  
								title="Guardar" tabindex="3" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_anticipos_proveedores_cuentas_pagar"  
								onclick="reporte_registro_anticipos_proveedores_cuentas_pagar('');"  
								title="Imprimir registro en PDF" tabindex="4" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Subir varios archivos-->
	                    <span  class="fileupload-buttonbar" tabindex="5">
	                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_anticipos_proveedores_cuentas_pagar" disabled>
	                        	<span class="fa fa-upload"></span>
	                        	<input id="archivo_varios_anticipos_proveedores_cuentas_pagar" 
	                        		   name="archivo_varios_anticipos_proveedores_cuentas_pagar[]" type="file" multiple 
	                        		   accept="text/xml,application/pdf" onchange="subir_archivos_modal_anticipos_proveedores_cuentas_pagar('Editar');">
	                        	</input>
	                        </span>
	                    </span>
	                    <!--Descargar archivo-->
	                    <button class="btn btn-default" id="btnDescargarArchivo_anticipos_proveedores_cuentas_pagar"  
								onclick="descargar_archivos_anticipos_proveedores_cuentas_pagar('','');"  title="Descargar archivo" tabindex="6" disabled>
							<span class="glyphicon glyphicon-download-alt"></span>
						</button>
						<!--Eliminar archivo-->
						<button class="btn btn-default" id="btnEliminarArchivo_anticipos_proveedores_cuentas_pagar"  
								onclick="eliminar_archivos_anticipos_proveedores_cuentas_pagar('')"  title="Eliminar archivo" tabindex="7" disabled>
							<span class="glyphicon glyphicon-export"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" id="btnDesactivar_anticipos_proveedores_cuentas_pagar"  
								onclick="cambiar_estatus_anticipos_proveedores_cuentas_pagar('','ACTIVO');"  title="Desactivar" tabindex="8" disabled>
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Restaurar registro-->
						<button class="btn btn-default" id="btnRestaurar_anticipos_proveedores_cuentas_pagar"  
								onclick="cambiar_estatus_anticipos_proveedores_cuentas_pagar('','INACTIVO');"  title="Restaurar" tabindex="9" disabled>
							<span class="fa fa-exchange"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_anticipos_proveedores_cuentas_pagar"
								type="reset" aria-hidden="true" onclick="cerrar_anticipos_proveedores_cuentas_pagar();" 
								title="Cerrar"  tabindex="10">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>							

			</form><!--Cierre del formulario-->
		</div>
	</div>			  

</div><!--#AnticiposProveedoresCuentasPagarContent -->

<!-- /.Plantilla para cargar las monedas en el combobox-->  
<script id="monedas_anticipos_proveedores_cuentas_pagar" type="text/template">
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
	var intPaginaAnticiposProveedoresCuentasPagar = 0;
	var strUltimaBusquedaAnticiposProveedoresCuentasPagar = "";
	//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
	var intNumDecimalesMostrarAnticiposProveedoresCuentasPagar = <?php echo NUM_DECIMALES_MOSTRAR_CUENTAS_PAGAR ?>;
	//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
	var intNumDecimalesSubtotalBDAnticiposProveedoresCuentasPagar = <?php echo NUM_DECIMALES_SUBTOTAL_AP_CUENTAS_PAGAR ?>;
	var intNumDecimalesIvaBDAnticiposProveedoresCuentasPagar = <?php echo NUM_DECIMALES_IVA_AP_CUENTAS_PAGAR ?>;
	var intNumDecimalesIepsBDAnticiposProveedoresCuentasPagar = <?php echo NUM_DECIMALES_IEPS_AP_CUENTAS_PAGAR ?>;
	//Variable que se utiliza para asignar el id de la moneda base
	var intMonedaBaseIDAnticiposProveedoresCuentasPagar = <?php echo MONEDA_BASE ?>;
	//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
	var intTipoCambioMonedaBaseAnticiposProveedoresCuentasPagar = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
	//Variable que se utiliza para asignar el valor máximo del tipo de cambio
	var intTipoCambioMaximoAnticiposProveedoresCuentasPagar = <?php echo TIPO_CAMBIO_MAXIMO ?>;
	//Variable que se utiliza para asignar objeto del modal
	var objAnticiposProveedoresCuentasPagar = null;


	/*******************************************************************************************************************
	Funciones del objeto Detalles del anticipo
	*********************************************************************************************************************/
	// Constructor del objeto detalles
	var objDetallesAnticipoAnticiposProveedoresCuentasPagar;
	function DetallesAnticipoAnticiposProveedoresCuentasPagar(detalles)
	{
		this.arrDetalles = detalles;
	}

	//Función para obtener todos los detalles del anticipo
	DetallesAnticipoAnticiposProveedoresCuentasPagar.prototype.getDetalles = function() {
	    return this.arrDetalles;
	}

	//Función para agregar una detalle al objeto 
	DetallesAnticipoAnticiposProveedoresCuentasPagar.prototype.setDetalle = function (detalle){
		this.arrDetalles.push(detalle);
	}

	//Función para obtener un detalle del objeto
	DetallesAnticipoAnticiposProveedoresCuentasPagar.prototype.getDetalle = function(index) {
	    return this.arrDetalles[index];
	}

	//Función para modificar un detalle del objeto
	DetallesAnticipoAnticiposProveedoresCuentasPagar.prototype.modificarDetalle = function (index, detalle){
		this.arrDetalles[index] = detalle;
	}

	//Función para eliminar un detalle del objeto
	DetallesAnticipoAnticiposProveedoresCuentasPagar.prototype.eliminarDetalle = function (index){
		if(index != -1) 
		{
			this.arrDetalles.splice(index, 1);
		}
	}

	//Función para cambiar las posiciones de los detalles en el objeto
	DetallesAnticipoAnticiposProveedoresCuentasPagar.prototype.swap = function(index_A, index_B) {
	    var input = this.arrDetalles;
	 
	    var temp = input[index_A];
	    input[index_A] = input[index_B];
	    input[index_B] = temp;
	}

	/*******************************************************************************************************************
	Funciones del objeto Detalle del anticipo
	*********************************************************************************************************************/
	//Constructor del objeto detalle
	var objDetalleAnticipoAnticiposProveedoresCuentasPagar;
	function DetalleAnticipoAnticiposProveedoresCuentasPagar(concepto, subtotal, tasaCuotaIva, importeIva, 
															 porcentajeIva, tasaCuotaIeps, importeIeps, 
															 porcentajeIeps, total)
	{
	    this.strConcepto = concepto;
	    this.intSubtotal = subtotal;
	    this.intTasaCuotaIva = tasaCuotaIva;
	    this.intImporteIva = importeIva;
	    this.intPorcentajeIva = porcentajeIva;
	    this.intTasaCuotaIeps = tasaCuotaIeps;
	    this.intImporteIeps = importeIeps;
	    this.intPorcentajeIeps = porcentajeIeps;
	    this.intTotal = total;
	}
	

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_anticipos_proveedores_cuentas_pagar()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('cuentas_pagar/anticipos_proveedores/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_anticipos_proveedores_cuentas_pagar').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosAnticiposProveedoresCuentasPagar = data.row;
				//Separar la cadena 
				var arrPermisosAnticiposProveedoresCuentasPagar = strPermisosAnticiposProveedoresCuentasPagar.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosAnticiposProveedoresCuentasPagar.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosAnticiposProveedoresCuentasPagar[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_anticipos_proveedores_cuentas_pagar').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosAnticiposProveedoresCuentasPagar[i]=='GUARDAR') || (arrPermisosAnticiposProveedoresCuentasPagar[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_anticipos_proveedores_cuentas_pagar').removeAttr('disabled');
					}
					//Si el indice es ADJUNTAR
					else if(arrPermisosAnticiposProveedoresCuentasPagar[i]=='ADJUNTAR')
					{
						//Habilitar el control (botón Adjuntar)
						$('#btnAdjuntar_anticipos_proveedores_cuentas_pagar').removeAttr('disabled');
						//Habilitar el control (botón eliminar archivo)
						$('#btnEliminarArchivo_anticipos_proveedores_cuentas_pagar').removeAttr('disabled');
					}
					//Si el indice es VER REGISTRO
					else if(arrPermisosAnticiposProveedoresCuentasPagar[i]=='VER REGISTRO')
					{
						//Habilitar el control (botón descargar archivo)
						$('#btnDescargarArchivo_anticipos_proveedores_cuentas_pagar').removeAttr('disabled');
					}
					else if(arrPermisosAnticiposProveedoresCuentasPagar[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_anticipos_proveedores_cuentas_pagar').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_anticipos_proveedores_cuentas_pagar();
					}
					else if(arrPermisosAnticiposProveedoresCuentasPagar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_anticipos_proveedores_cuentas_pagar').removeAttr('disabled');
						$('#btnRestaurar_anticipos_proveedores_cuentas_pagar').removeAttr('disabled');
					}
					else if(arrPermisosAnticiposProveedoresCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_anticipos_proveedores_cuentas_pagar').removeAttr('disabled');
					}
					else if(arrPermisosAnticiposProveedoresCuentasPagar[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_anticipos_proveedores_cuentas_pagar').removeAttr('disabled');
					}
					else if(arrPermisosAnticiposProveedoresCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_anticipos_proveedores_cuentas_pagar').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_anticipos_proveedores_cuentas_pagar() 
	{
		//Concatenar datos para la nueva búsqueda
		var strNuevaBusquedaAnticiposProveedoresCuentasPagar =($('#txtFechaInicialBusq_anticipos_proveedores_cuentas_pagar').val()+$('#txtFechaFinalBusq_anticipos_proveedores_cuentas_pagar').val()+$('#txtProveedorIDBusq_anticipos_proveedores_cuentas_pagar').val()+$('#cmbEstatusBusq_anticipos_proveedores_cuentas_pagar').val()+$('#txtBusqueda_anticipos_proveedores_cuentas_pagar').val());

		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaAnticiposProveedoresCuentasPagar != strUltimaBusquedaAnticiposProveedoresCuentasPagar)
		{
			intPaginaAnticiposProveedoresCuentasPagar = 0;
			strUltimaBusquedaAnticiposProveedoresCuentasPagar = strNuevaBusquedaAnticiposProveedoresCuentasPagar;
		}
		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('cuentas_pagar/anticipos_proveedores/get_paginacion',
				{	
					//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_anticipos_proveedores_cuentas_pagar').val()),
					dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_anticipos_proveedores_cuentas_pagar').val()),
	    			intProveedorID: $('#txtProveedorIDBusq_anticipos_proveedores_cuentas_pagar').val(),
	    			strEstatus: $('#cmbEstatusBusq_anticipos_proveedores_cuentas_pagar').val(),
					strBusqueda: $('#txtBusqueda_anticipos_proveedores_cuentas_pagar').val(),
					intPagina:intPaginaAnticiposProveedoresCuentasPagar,
					strPermisosAcceso: $('#txtAcciones_anticipos_proveedores_cuentas_pagar').val()
				},
				function(data){
					$('#dg_anticipos_proveedores_cuentas_pagar tbody').empty();
					var tmpAnticiposProveedoresCuentasPagar = Mustache.render($('#plantilla_anticipos_proveedores_cuentas_pagar').html(),data);
					$('#dg_anticipos_proveedores_cuentas_pagar tbody').html(tmpAnticiposProveedoresCuentasPagar);
					$('#pagLinks_anticipos_proveedores_cuentas_pagar').html(data.paginacion);
					$('#numElementos_anticipos_proveedores_cuentas_pagar').html(data.total_rows);
					intPaginaAnticiposProveedoresCuentasPagar = data.pagina;
				},
		'json');
	}


	//Función para cargar/descargar el reporte general en PDF/XLS
	function reporte_anticipos_proveedores_cuentas_pagar(strTipo) 
	{
		//Variable que se utiliza para asignar URL (ruta del controlador)
		var strUrl = 'cuentas_pagar/anticipos_proveedores/';

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
		if ($('#chbImprimirDetalles_anticipos_proveedores_cuentas_pagar').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_anticipos_proveedores_cuentas_pagar').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_anticipos_proveedores_cuentas_pagar').val('NO');
		}

		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url': strUrl,
						'data' : {
									'dteFechaInicial':  $.formatFechaMysql($('#txtFechaInicialBusq_anticipos_proveedores_cuentas_pagar').val()),
									'dteFechaFinal':  $.formatFechaMysql($('#txtFechaFinalBusq_anticipos_proveedores_cuentas_pagar').val()),
									'intProveedorID': $('#txtProveedorIDBusq_anticipos_proveedores_cuentas_pagar').val(),
									'strEstatus': $('#cmbEstatusBusq_anticipos_proveedores_cuentas_pagar').val(), 
									'strBusqueda': $('#txtBusqueda_anticipos_proveedores_cuentas_pagar').val(),
									'strDetalles': $('#chbImprimirDetalles_anticipos_proveedores_cuentas_pagar').val()						
								 }
					   };


		//Hacer un llamado a la función para imprimir/descargar el reporte
		$.imprimirReporte(objReporte);

	}

	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_anticipos_proveedores_cuentas_pagar(id)
	{	
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la impresión desde el modal
		if(id == '')
		{
			intID = $('#txtAnticipoProveedorID_anticipos_proveedores_cuentas_pagar').val();
		}
		else
		{
			intID = id;
		}

		//Definir encapsulamiento de datos que son necesarios para generar el reporte
		objReporte = {'url': 'cuentas_pagar/anticipos_proveedores/get_reporte_registro',
						'data' : {
									'intAnticipoProveedorID': intID
								 }
					   };

		//Hacer un llamado a la función para imprimir el reporte
		$.imprimirReporte(objReporte);

	}

	
	//Función para subir archivos de un registro desde el grid view
	function subir_archivos_grid_anticipos_proveedores_cuentas_pagar(anticipoProveedorID)
	{
		//Crear instancia al objeto del formulario
        var formData = new FormData($("#frmAnticiposProveedoresCuentasPagar")[0]);
		//Agregar campos al objeto del formulario
		formData.append("intAnticipoProveedorID_anticipos_proveedores_cuentas_pagar", anticipoProveedorID);
		//Variable que se utiliza para asignar archivos
		var strBotonArchivoIDGridAnticiposProveedoresCuentasPagar  = "archivo_varios_anticipos_proveedores_cuentas_pagar"+anticipoProveedorID;
		//Asignar valor del objeto tipo file
		var fileUpload = $("#"+strBotonArchivoIDGridAnticiposProveedoresCuentasPagar);
		//Obtenemos un array con los datos de los archivos
		var files = $("#"+strBotonArchivoIDGridAnticiposProveedoresCuentasPagar)[0].files;
		//Variable que se utiliza para asignar la extensión del primer archivo seleccionado
		var strExtensionAnterior = '';
		//Variable que se utiliza para asignar el mensaje de error
		var strMensajeError = '';
        //Si el el número de archivos seleccionados es mayor que dos
        if(parseInt(fileUpload.get(0).files.length) > 2)
        {
           //Mensaje que se utiliza para informar al usuario que solo es posible subir dos archivos
           strMensajeError = 'Solamente puede subir dos archivos: un XML y un PDF.';
        }
        else
        {
        	//Hacer recorrido para verificar que la extensión de los  archivos seleccionados sea diferente
        	for (var intCont = 0; intCont < parseInt(fileUpload.get(0).files.length); intCont++)
			{
			    //Obtenemos el nombre del archivo
				var fileName = files[intCont].name;
				//Obtenemos la extensión del archivo
				var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);

				//Si existe un archivo anterior
				if(strExtensionAnterior !== '')
				{
					//Verificar si la extensión del archivo es la misma
					if(strExtensionAnterior == fileExtension)
					{
						//Mensaje que se utiliza para informar al usuario que los archivos son de la misma extensión
						strMensajeError = 'No es posible subir los archivos con la misma extensión,  favor de seleccionar un XML y un PDF.';
					}

				}

				//Asignar extensión del primer archivo
				strExtensionAnterior = fileExtension;

				//Agregar campo tipo file al objeto del formulario
				formData.append("archivo_varios_anticipos_proveedores_cuentas_pagar[]", document.getElementById(strBotonArchivoIDGridAnticiposProveedoresCuentasPagar).files[intCont]);
			 	
			}
        }

        //Si existe mensaje de error
        if(strMensajeError != '')
        {
        	//Limpia ruta del archivo cargado
	        $('#'+strBotonArchivoIDGridAnticiposProveedoresCuentasPagar).val('');
        	//Hacer un llamado a la función para mostrar mensaje de error
			mensaje_anticipos_proveedores_cuentas_pagar('error', strMensajeError);
        }
        else
        {
        	//Hacer un llamado al método del controlador para subir archivos del registro
            $.ajax({
                url: 'cuentas_pagar/anticipos_proveedores/subir_archivos',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data)
                {
                    //Limpia ruta del archivo cargado
	         		$('#'+strBotonArchivoIDGridAnticiposProveedoresCuentasPagar).val('');
					//Subida finalizada.
					if (data.resultado)
					{
	         		   //Hacer llamado a la función  para cargar  los registros en el grid
		           	   paginacion_anticipos_proveedores_cuentas_pagar();  
					}
                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		    		mensaje_anticipos_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
                }
        	});

        }

	}

	//Función que se utiliza para descargar los archivos del registro seleccionado
	function descargar_archivos_anticipos_proveedores_cuentas_pagar(anticipoProveedorID, folio)
	{
		//Variables que se utilizan para asignar los valores del registro
		var intAnticipoProveedorID = 0;
		var strFolio = '';
		//Si no existe id, significa que se descargara el archivo desde el modal
		if(anticipoProveedorID == '')
		{
			intAnticipoProveedorID = $('#txtAnticipoProveedorID_anticipos_proveedores_cuentas_pagar').val();
			strFolio = $('#txtFolio_anticipos_proveedores_cuentas_pagar').val();
		}
		else
		{
			intAnticipoProveedorID = anticipoProveedorID;
			strFolio = folio;
		}

		//Definir encapsulamiento de datos que son necesarios para descargar el archivo
		objArchivo = {'url': 'cuentas_pagar/anticipos_proveedores/descargar_archivos',
						'data' : {
									'intAnticipoProveedorID': intAnticipoProveedorID,
									'strFolio': strFolio				
								 }
					   };


		//Hacer un llamado a la función para descarga del archivo
		$.imprimirReporte(objArchivo);
	}

	//Función que se utiliza para eliminar los archivos del registro seleccionado
	function eliminar_archivos_anticipos_proveedores_cuentas_pagar(id)
	{

		//Variables que se utilizan para asignar los valores del registro
		var intID = 0;

		//Si no existe id, significa que se eliminara el archivo desde el modal
		if(id == '')
		{
			intID = $('#txtAnticipoProveedorID_anticipos_proveedores_cuentas_pagar').val();

		}
		else
		{
			intID = id;
		}

		//Hacer un llamado al método del controlador para eliminar carpeta que contiene los archivos del registro
		$.post('cuentas_pagar/anticipos_proveedores/eliminar_carpeta_registro',
		     {intAnticipoProveedorID: intID
		     },
		     function(data) {
		       
		        if(data.resultado)
		        {
		         	//Hacer llamado a la función  para cargar  los registros en el grid
	          	    paginacion_anticipos_proveedores_cuentas_pagar();
	          	    //Si el id del registro se obtuvo del modal
					if(id == '')
					{
						//Ocultar los siguientes botones
						$('#btnDescargarArchivo_anticipos_proveedores_cuentas_pagar').hide();
						$('#btnEliminarArchivo_anticipos_proveedores_cuentas_pagar').hide();    
					}
		        }
	        	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
	       		mensaje_anticipos_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
		       
		     },
		    'json');
	}


	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	//Regresar monedas activas para cargarlas en el combobox
	function cargar_monedas_anticipos_proveedores_cuentas_pagar()
	{
		//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
		$.post('contabilidad/sat_monedas/get_combo_box', {},
			function(data)
			{
				$('#cmbMonedaID_anticipos_proveedores_cuentas_pagar').empty();
				var temp = Mustache.render($('#monedas_anticipos_proveedores_cuentas_pagar').html(), data);
				$('#cmbMonedaID_anticipos_proveedores_cuentas_pagar').html(temp);
			},
			'json');
	}

	// Función para limpiar los campos del formulario
	function nuevo_anticipos_proveedores_cuentas_pagar(tipoAccion)
	{
		//Incializar formulario
		$('#frmAnticiposProveedoresCuentasPagar')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_anticipos_proveedores_cuentas_pagar();
		//Limpiar cajas de texto ocultas
		$('#frmAnticiposProveedoresCuentasPagar').find('input[type=hidden]').val('');
		//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
		$.removerClasesEncabezado('divEncabezadoModal_anticipos_proveedores_cuentas_pagar');
		//Eliminar los datos de la tabla detalles del anticipo
	    $('#dg_detalles_anticipos_proveedores_cuentas_pagar tbody').empty();
	    $('#acumSubtotal_detalles_anticipos_proveedores_cuentas_pagar').html('');
		$('#acumIva_detalles_anticipos_proveedores_cuentas_pagar').html('');
		$('#acumIeps_detalles_anticipos_proveedores_cuentas_pagar').html('');
		$('#acumTotal_detalles_anticipos_proveedores_cuentas_pagar').html('');
		$('#numElementos_detalles_anticipos_proveedores_cuentas_pagar').html(0);
		//Crear instancia del objeto Detalles del anticipo
		objDetallesAnticipoAnticiposProveedoresCuentasPagar = new DetallesAnticipoAnticiposProveedoresCuentasPagar([]);

		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo')
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_anticipos_proveedores_cuentas_pagar').addClass("estatus-NUEVO");
		}
		//Habilitar todos los elementos del formulario
		$('#frmAnticiposProveedoresCuentasPagar').find('input, textarea, select').removeAttr('disabled','disabled');
		//Asignar la fecha actual
		$('#txtFecha_anticipos_proveedores_cuentas_pagar').val(fechaActual()); 
		//Deshabilitar las siguientes cajas de texto
		$('#txtFolio_anticipos_proveedores_cuentas_pagar').attr("disabled", "disabled");
		$('#txtRfc_anticipos_proveedores_cuentas_pagar').attr("disabled", "disabled");
		$('#txtTotal_detalles_anticipos_proveedores_cuentas_pagar').attr("disabled", "disabled");
		//Mostrar los siguientes botones
		$("#btnGuardar_anticipos_proveedores_cuentas_pagar").show();
		$("#btnAdjuntar_anticipos_proveedores_cuentas_pagar").show();
		$("#btnReiniciar_anticipos_proveedores_cuentas_pagar").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_anticipos_proveedores_cuentas_pagar").hide();
		$("#btnDescargarArchivo_anticipos_proveedores_cuentas_pagar").hide();
		$("#btnEliminarArchivo_anticipos_proveedores_cuentas_pagar").hide();
		$("#btnDesactivar_anticipos_proveedores_cuentas_pagar").hide();
		$("#btnRestaurar_anticipos_proveedores_cuentas_pagar").hide();		
	}

	//Función que se utiliza para cerrar el modal
	function cerrar_anticipos_proveedores_cuentas_pagar()
	{
		try {
			//Cerrar modal
			objAnticiposProveedoresCuentasPagar.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_anticipos_proveedores_cuentas_pagar').focus();
		}
		catch(err) {}
	}

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_anticipos_proveedores_cuentas_pagar()
	{

		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_anticipos_proveedores_cuentas_pagar();
		//Validación del formulario de campos obligatorios
		$('#frmAnticiposProveedoresCuentasPagar')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_anticipos_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intMonedaID_anticipos_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_anticipos_proveedores_cuentas_pagar: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_anticipos_proveedores_cuentas_pagar').val()) !== intMonedaBaseIDAnticiposProveedoresCuentasPagar)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoAnticiposProveedoresCuentasPagar)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoAnticiposProveedoresCuentasPagar
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strReferencia_anticipos_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un folio'}
											}
										},
										strProveedor_anticipos_proveedores_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtProveedorID_anticipos_proveedores_cuentas_pagar').val() === '')
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
										strRfc_anticipos_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'El proveedor debe contener un RFC'}
											}
										},
										strCuentaBancaria_anticipos_proveedores_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cuenta bancaria
					                                    if($('#txtCuentaBancariaID_anticipos_proveedores_cuentas_pagar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una cuenta bancaria existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intNumDetalles_anticipos_proveedores_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para este anticipo.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strConcepto_detalles_anticipos_proveedores_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intSubtotal_detalles_anticipos_proveedores_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar: {
											excluded: true  //Ignorar (no valida el campo)
										},
										intPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar: {
											excluded: true  //Ignorar (no valida el campo)
										}
									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_anticipos_proveedores_cuentas_pagar = $('#frmAnticiposProveedoresCuentasPagar').data('bootstrapValidator');
		bootstrapValidator_anticipos_proveedores_cuentas_pagar.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_anticipos_proveedores_cuentas_pagar.isValid())
		{
			guardar_anticipos_proveedores_cuentas_pagar();
		}
		else{
			return;
		} 
			
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_anticipos_proveedores_cuentas_pagar()
	{
		try
		{
			$('#frmAnticiposProveedoresCuentasPagar').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	//Función para guardar o modificar los datos de un registro
	function guardar_anticipos_proveedores_cuentas_pagar()
	{	
		//Obtenemos un array con los datos del archivo
    	var arrArchivoAnticiposProveedoresCuentasPagar = $("#archivo_varios_anticipos_proveedores_cuentas_pagar");


    	//Obtenemos el objeto de la tabla detalles
		var objTabla = document.getElementById('dg_detalles_anticipos_proveedores_cuentas_pagar').getElementsByTagName('tbody')[0];


		//Inicializamos las variables que obtendrán los datos de la tabla
		var arrConceptos = [];
		var arrSubtotales = [];
		var arrTasaCuotaIva = [];
		var arrIvas = [];
		var arrTasaCuotaIeps = [];
		var arrIeps = [];
		

		//Variable que se utiliza para asignar el tipo de cambio
		var intTipoCambioAnticipo = parseFloat($('#txtTipoCambio_anticipos_proveedores_cuentas_pagar').val());
		
		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Variables que se utilizan para asignar valores del detalle
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			var intSubtotal = $.reemplazar(objRen.cells[1].innerHTML, ",", "");
			var intImporteIva = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
			var intImporteIeps = $.reemplazar(objRen.cells[3].innerHTML, ",", "");

			//Convertir importes a peso mexicano
			intSubtotal = intSubtotal * intTipoCambioAnticipo;
			intImporteIva = intImporteIva * intTipoCambioAnticipo;
			intImporteIeps = intImporteIeps * intTipoCambioAnticipo;

			//Redondear cantidad a decimales
			intSubtotal = intSubtotal.toFixed(intNumDecimalesSubtotalBDAnticiposProveedoresCuentasPagar);
			intSubtotal = parseFloat(intSubtotal);

			intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaBDAnticiposProveedoresCuentasPagar);
			intImporteIva = parseFloat(intImporteIva);
			
			intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsBDAnticiposProveedoresCuentasPagar);
			intImporteIeps = parseFloat(intImporteIeps);

			//Asignar valores a los arrays
			arrConceptos.push(objRen.cells[0].innerHTML);
			arrSubtotales.push(intSubtotal);
			arrTasaCuotaIva.push(objRen.cells[8].innerHTML);
			arrIvas.push(intImporteIva);
			arrTasaCuotaIeps.push(objRen.cells[9].innerHTML);
			arrIeps.push(intImporteIeps);
		}


		//Hacer un llamado al método del controlador para guardar los datos del registro
		$.post('cuentas_pagar/anticipos_proveedores/guardar',
				{ 
					
					//Datos del anticipo
					intAnticipoProveedorID: $('#txtAnticipoProveedorID_anticipos_proveedores_cuentas_pagar').val(),
					//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					dteFecha: $.formatFechaMysql($('#txtFecha_anticipos_proveedores_cuentas_pagar').val()),
					intMonedaID: $('#cmbMonedaID_anticipos_proveedores_cuentas_pagar').val(),
					intTipoCambio: intTipoCambioAnticipo,
					strReferencia: $('#txtReferencia_anticipos_proveedores_cuentas_pagar').val(),
					intProveedorID: $('#txtProveedorID_anticipos_proveedores_cuentas_pagar').val(),
					strRazonSocial: $('#txtRazonSocial_anticipos_proveedores_cuentas_pagar').val(),
					strRfc: $('#txtRfc_anticipos_proveedores_cuentas_pagar').val(),
					intCuentaBancariaID: $('#txtCuentaBancariaID_anticipos_proveedores_cuentas_pagar').val(),
					strObservaciones: $('#txtObservaciones_anticipos_proveedores_cuentas_pagar').val(),
					intProcesoMenuID: $('#txtProcesoMenuID_anticipos_proveedores_cuentas_pagar').val(),
					//Datos de los detalles
					strConceptos: arrConceptos.join('|'),
					strSubtotales: arrSubtotales.join('|'),
					strTasaCuotaIva: arrTasaCuotaIva.join('|'),
					strIvas: arrIvas.join('|'),
					strTasaCuotaIeps: arrTasaCuotaIeps.join('|'),
					strIeps: arrIeps.join('|')
				},
				function(data) {
					if (data.resultado)
					{	

						//Si no existe id del anticipo, significa que es un nuevo registro   
						if($('#txtAnticipoProveedorID_anticipos_proveedores_cuentas_pagar').val() == '')
						{
						  	//Asignar el id del anticipo registrado en la base de datos
                 			$('#txtAnticipoProveedorID_anticipos_proveedores_cuentas_pagar').val(data.anticipo_proveedor_id);
             			}

             			//Si existen archivos seleccionados
         				if(arrArchivoAnticiposProveedoresCuentasPagar != undefined )
         				{
         					//Hacer un llamado a la función para subir el archivo
                    		subir_archivos_modal_anticipos_proveedores_cuentas_pagar('Nuevo');
         				}
             			else
             			{	
	                    	//Hacer un llamado a la función para cerrar modal e inicializar objeto bootstrapValidator
	                    	cerrar_anticipos_proveedores_cuentas_pagar();
	                    	//Hacer llamado a la función  para cargar  los registros en el grid
		               		paginacion_anticipos_proveedores_cuentas_pagar();
		                }
					}

					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_anticipos_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);

				},
		'json');
		

	}


	//Función para mostrar mensaje de éxito o error
	function mensaje_anticipos_proveedores_cuentas_pagar(tipoMensaje, mensaje)
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
	function cambiar_estatus_anticipos_proveedores_cuentas_pagar(id, estatus)
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Variable que se utiliza para saber si el id se obtuvo desde el modal
		var strTipo = 'modal';
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtAnticipoProveedorID_anticipos_proveedores_cuentas_pagar').val();

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
					              'title':    'Anticipos a Proveedores',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado a la función para modificar el estatus del registro
												  set_estatus_anticipos_proveedores_cuentas_pagar(intID, strTipo, 'INACTIVO');

					                            }
					                          }
					              });
	    }
	    else//Si el estatus del registro es INACTIVO
	    {

	    	//Hacer un llamado a la función para modificar el estatus del registro
			set_estatus_anticipos_proveedores_cuentas_pagar(intID, strTipo, 'ACTIVO');
	    }
	   
	}


	//Función que se utiliza para cambiar administrativamente el estatus de un registro
	function set_estatus_anticipos_proveedores_cuentas_pagar(id, tipo, estatus)
	{
		//Hacer un llamado al método del controlador para cambiar el estatus del registro
		$.post('cuentas_pagar/anticipos_proveedores/set_estatus',
		      {intAnticipoProveedorID: id,
		       strEstatus: estatus
		      },
		     function(data) {
		      	if (data.resultado)
		      	{
		        	//Hacer llamado a la función para cargar  los registros en el grid
		      		paginacion_anticipos_proveedores_cuentas_pagar();

		      		//Si el id del registro se obtuvo del modal
					if(tipo == 'modal')
					{
						//Hacer un llamado a la función para cerrar modal
						cerrar_anticipos_proveedores_cuentas_pagar();     
					}
		     	 }
		      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		        mensaje_anticipos_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
		     },
		     'json');

	}


	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_anticipos_proveedores_cuentas_pagar(id)
	{	
	   //Hacer un llamado al método del controlador para regresar los datos del registro
	   $.post('cuentas_pagar/anticipos_proveedores/get_datos',
       {
       		intAnticipoProveedorID:id
       },
       function(data) {

       		//Si hay datos del registro
		    if(data.row)
		    {
		    	//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_anticipos_proveedores_cuentas_pagar('');
				//Asignar estatus y reemplazar cadena vacia por '_'
				var strEstatus = data.row.estatus;
				strEstatus = strEstatus.replace(" ", "_");
				//Variable que se utiliza para asignar las acciones del grid view
				var strAccionesTabla = '';

				//Recuperar valores
	            $('#txtAnticipoProveedorID_anticipos_proveedores_cuentas_pagar').val(data.row.anticipo_proveedor_id);
	            $('#txtFolio_anticipos_proveedores_cuentas_pagar').val(data.row.folio);
	            $('#txtFecha_anticipos_proveedores_cuentas_pagar').val(data.row.fecha);
	            $('#cmbMonedaID_anticipos_proveedores_cuentas_pagar').val(data.row.moneda_id);
	            $('#txtTipoCambio_anticipos_proveedores_cuentas_pagar').val(data.row.tipo_cambio);
	            $('#txtReferencia_anticipos_proveedores_cuentas_pagar').val(data.row.referencia);
	            $('#txtProveedorID_anticipos_proveedores_cuentas_pagar').val(data.row.proveedor_id);
	            $('#txtProveedor_anticipos_proveedores_cuentas_pagar').val(data.row.proveedor);
	            $('#txtRazonSocial_anticipos_proveedores_cuentas_pagar').val(data.row.razon_social);
	            $('#txtRfc_anticipos_proveedores_cuentas_pagar').val(data.row.rfc);
	            $('#txtCuentaBancariaID_anticipos_proveedores_cuentas_pagar').val(data.row.cuenta_bancaria_id);
	            $('#txtCuentaBancaria_anticipos_proveedores_cuentas_pagar').val(data.row.cuenta_bancaria);
	            $('#txtObservaciones_anticipos_proveedores_cuentas_pagar').val(data.row.observaciones);
	           
	            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
	            $('#divEncabezadoModal_anticipos_proveedores_cuentas_pagar').addClass("estatus-" + strEstatus);
	            //Mostrar botón Imprimir  
	            $("#btnImprimirRegistro_anticipos_proveedores_cuentas_pagar").show();
	            //Ocultar botón Adjuntar archivo
				$("#btnAdjuntar_anticipos_proveedores_cuentas_pagar").hide();
	           	
				//Si existe archivo del registro
	           	if(data.archivo != '')
	           	{
	           		//Mostrar los siguientes botones
	            	$("#btnDescargarArchivo_anticipos_proveedores_cuentas_pagar").show();
	            	//Si el estatus del registro es ACTIVO
	            	if(strEstatus == 'ACTIVO')
		            {
	            		$('#btnEliminarArchivo_anticipos_proveedores_cuentas_pagar').show();
	            	}
	           	}

	           	//Si el estatus del registro es ACTIVO
	            if(strEstatus == 'ACTIVO')
	            {
	            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
									   " onclick='editar_renglon_detalles_anticipos_proveedores_cuentas_pagar(this)'>" + 
									   "<span class='glyphicon glyphicon-edit'></span></button>" + 
									   "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_detalles_anticipos_proveedores_cuentas_pagar(this)'>" + 
									   "<span class='glyphicon glyphicon-trash'></span></button>" + 
									   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
									   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
									   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
									   "<span class='glyphicon glyphicon-arrow-down'></span></button>";

	            	//Mostrar los siguientes botones  
	            	$("#btnDesactivar_anticipos_proveedores_cuentas_pagar").show();
	            	$("#btnAdjuntar_anticipos_proveedores_cuentas_pagar").show();

	            	//Si el id de la moneda no corresponde al peso mexicano
				    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDAnticiposProveedoresCuentasPagar)
				    {
						//Habilitar caja de texto
						$("#txtTipoCambio_anticipos_proveedores_cuentas_pagar").removeAttr('disabled');
				    }
				    else
				    {
				    	//Deshabilitar las siguientes cajas de texto
						$("#txtTipoCambio_anticipos_proveedores_cuentas_pagar").attr('disabled','disabled');
				    }
	            }
	            else
	            {
	            	//Si el estatus del registro es INACTIVO
		            if(strEstatus == 'INACTIVO')
		            {
	            		//Mostrar botón Restaurar
	            		$("#btnRestaurar_anticipos_proveedores_cuentas_pagar").show();
		            }

		            //Deshabilitar todos los elementos del formulario
	            	$('#frmAnticiposProveedoresCuentasPagar').find('input, textarea, select').attr('disabled','disabled');
	            	//Ocultar los siguientes botones
		            $("#btnGuardar_anticipos_proveedores_cuentas_pagar").hide();
		            $("#btnReiniciar_anticipos_proveedores_cuentas_pagar").hide();
	            }

	            //Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat(data.row.tipo_cambio);

	            //Mostramos los detalles del registro
	           	for (var intCon in data.detalles) 
	            {

	            	//Variable que se utiliza para asignar el renglón del detalle
				    var intRenglon = data.detalles[intCon].renglon;
					//Variables que se utilizan para asignar valores del detalle
				    var intSubtotal = parseFloat(data.detalles[intCon].subtotal);
				    var intImporteIva = parseFloat(data.detalles[intCon].iva);
				    var intImporteIeps = parseFloat(data.detalles[intCon].ieps);
				    var intTotal = 0;
				    var intPorcentajeIeps = '';

				    //Convertir peso mexicano a tipo de cambio
					intSubtotal = intSubtotal / intTipoCambio;
					intImporteIva = intImporteIva / intTipoCambio;
					intImporteIeps = intImporteIeps / intTipoCambio;

					//Si existe importe de IEPS
					if(intImporteIeps > 0)
					{	
						//Asignar porcentaje de IEPS
						intPorcentajeIeps = data.detalles[intCon].porcentaje_ieps;
					}

					//Redondear cantidad a decimales
					intSubtotal = intSubtotal.toFixed(intNumDecimalesSubtotalBDAnticiposProveedoresCuentasPagar);
					intSubtotal = parseFloat(intSubtotal);

					intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaBDAnticiposProveedoresCuentasPagar);
					intImporteIva = parseFloat(intImporteIva);
					
					intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsBDAnticiposProveedoresCuentasPagar);
					intImporteIeps = parseFloat(intImporteIeps);

					//Calcular importe total
				    intTotal = intSubtotal + intImporteIva + intImporteIeps;

				    //Cambiar cantidad a formato moneda
				    intSubtotal =  formatMoney(intSubtotal, intNumDecimalesSubtotalBDAnticiposProveedoresCuentasPagar, '');
				    intImporteIva  =  formatMoney(intImporteIva, intNumDecimalesIvaBDAnticiposProveedoresCuentasPagar, '');
					intImporteIeps  =  formatMoney(intImporteIeps, intNumDecimalesIepsBDAnticiposProveedoresCuentasPagar, '');
					intTotal  =  formatMoney(intTotal, intNumDecimalesMostrarAnticiposProveedoresCuentasPagar, '');
				

					//Crear instancia del objeto Detalle del anticipo
					objDetalleAnticipoAnticiposProveedoresCuentasPagar = new DetalleAnticipoAnticiposProveedoresCuentasPagar('', '', '', '', '', '', '', 
															 			  '', '');

					//Asignar valores al objeto
					objDetalleAnticipoAnticiposProveedoresCuentasPagar.strConcepto = data.detalles[intCon].concepto;
					objDetalleAnticipoAnticiposProveedoresCuentasPagar.intSubtotal = intSubtotal;
					objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTasaCuotaIva = data.detalles[intCon].tasa_cuota_iva;
					objDetalleAnticipoAnticiposProveedoresCuentasPagar.intImporteIva = intImporteIva;
					objDetalleAnticipoAnticiposProveedoresCuentasPagar.intPorcentajeIva = data.detalles[intCon].porcentaje_iva;
					objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTasaCuotaIeps = data.detalles[intCon].tasa_cuota_ieps;
					objDetalleAnticipoAnticiposProveedoresCuentasPagar.intImporteIeps = intImporteIeps;
					objDetalleAnticipoAnticiposProveedoresCuentasPagar.intPorcentajeIeps = intPorcentajeIeps;
					objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTotal = intTotal;

					//Agregar datos del detalle del anticipo
				    objDetallesAnticipoAnticiposProveedoresCuentasPagar.setDetalle(objDetalleAnticipoAnticiposProveedoresCuentasPagar);

				    //Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_detalles_anticipos_proveedores_cuentas_pagar').getElementsByTagName('tbody')[0];
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaConcepto = objRenglon.insertCell(0);
					var objCeldaSubtotal = objRenglon.insertCell(1);
					var objCeldaIva = objRenglon.insertCell(2);
					var objCeldaIeps = objRenglon.insertCell(3);
					var objCeldaTotal = objRenglon.insertCell(4);
					var objCeldaAcciones = objRenglon.insertCell(5);
					//Columnas ocultas
					var objCeldaPorcentajeIva = objRenglon.insertCell(6);
					var objCeldaPorcentajeIeps = objRenglon.insertCell(7);
					var objCeldaTasaCuotaIva = objRenglon.insertCell(8);
					var objCeldaTasaCuotaIeps = objRenglon.insertCell(9);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRenglon);
					objCeldaConcepto.setAttribute('class', 'movil b1');
					objCeldaConcepto.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.strConcepto;
					objCeldaSubtotal.setAttribute('class', 'movil b2');
					objCeldaSubtotal.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intSubtotal;
					objCeldaIva.setAttribute('class', 'movil b3');
					objCeldaIva.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intImporteIva;
					objCeldaIeps.setAttribute('class', 'movil b4');
					objCeldaIeps.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intImporteIeps;
					objCeldaTotal.setAttribute('class', 'movil b5');
					objCeldaTotal.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTotal;
					objCeldaAcciones.setAttribute('class', 'td-center movil b6');
					objCeldaAcciones.innerHTML = strAccionesTabla;
					objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIva.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intPorcentajeIva; 
					objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIeps.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intPorcentajeIeps;
					objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIva.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTasaCuotaIva;
					objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIeps.innerHTML =  objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTasaCuotaIeps;

	            }

	            //Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_anticipos_proveedores_cuentas_pagar();
				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_anticipos_proveedores_cuentas_pagar tr").length - 2;
				$('#numElementos_detalles_anticipos_proveedores_cuentas_pagar').html(intFilas);
				$('#txtNumDetalles_anticipos_proveedores_cuentas_pagar').val(intFilas);

	            //Abrir modal
				objAnticiposProveedoresCuentasPagar = $('#AnticiposProveedoresCuentasPagarBox').bPopup({
											   appendTo: '#AnticiposProveedoresCuentasPagarContent', 
				                               contentContainer: 'AnticiposProveedoresCuentasPagarM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

	           //Enfocar caja de texto
			   $('#cmbMonedaID_anticipos_proveedores_cuentas_pagar').focus();
		    }

       });
	}

	//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
	function get_tipo_cambio_anticipos_proveedores_cuentas_pagar()
	{	
		//Si la moneda no corresponde a peso mexicano
		if(parseInt($('#cmbMonedaID_anticipos_proveedores_cuentas_pagar').val()) !== intMonedaBaseIDAnticiposProveedoresCuentasPagar)
     	{
     		//Limpiar contenido de la caja de texto
     		$("#txtTipoCambio_anticipos_proveedores_cuentas_pagar").val('');

			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFecha = $.formatFechaMysql($('#txtFecha_anticipos_proveedores_cuentas_pagar').val());

			//Concatenar criterios de búsqueda para regresar el tipo de cambio
			var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_anticipos_proveedores_cuentas_pagar').val();
			
        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
            $.post('caja/tipos_cambio/get_datos',
                  { 
                  	strBusqueda:  strCriteriosBusq,
		       		strTipo: 'fecha'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtTipoCambio_anticipos_proveedores_cuentas_pagar").val(data.row.tipo_cambio_sat);
                    }
                  }
                 ,
                'json');
		}
		
	}


	//Función para subir los archivos de un registro desde el modal
	function subir_archivos_modal_anticipos_proveedores_cuentas_pagar(tipoAccion)
	{
		//Variable que se utiliza para asignar archivos
		var strBotonArchivoIDAnticiposProveedoresCuentasPagar  = "archivo_varios_anticipos_proveedores_cuentas_pagar";
		//Asignar valor del objeto tipo file
		var fileUpload = $("#"+strBotonArchivoIDAnticiposProveedoresCuentasPagar);
		//Obtenemos un array con los datos de los archivos
		var files = $("#"+strBotonArchivoIDAnticiposProveedoresCuentasPagar)[0].files;
		//Variable que se utiliza para asignar la extensión del primer archivo seleccionado
		var strExtensionAnterior = '';
		//Variable que se utiliza para asignar el mensaje de error
		var strMensajeError = '';

        //Si el el número de archivos seleccionados es mayor que dos
        if(parseInt(fileUpload.get(0).files.length) > 2)
        {
           //Mensaje que se utiliza para informar al usuario que solo es posible subir dos archivos
           strMensajeError = 'Solamente puede subir dos archivos: un XML y un PDF.';
        }
        else
        {
        	//Hacer recorrido para verificar que la extensión de los  archivos seleccionados sea diferente
        	for (var intCont = 0; intCont < parseInt(fileUpload.get(0).files.length); intCont++)
			{
			    //Obtenemos el nombre del archivo
				var fileName = files[intCont].name;
				//Obtenemos la extensión del archivo
				var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);

				//Si existe un archivo anterior
				if(strExtensionAnterior !== '')
				{
					//Verificar si la extensión del archivo es la misma
					if(strExtensionAnterior == fileExtension)
					{
						//Mensaje que se utiliza para informar al usuario que los archivos son de la misma extensión
						strMensajeError = 'No es posible subir los archivos con la misma extensión,  favor de seleccionar un XML y un PDF.';
					}
					
				}

				//Asignar extensión del primer archivo
				strExtensionAnterior = fileExtension;
			 	
			}
        }

        //Si existe mensaje de error
        if(strMensajeError != '')
        {
        	//Limpia ruta del archivo cargado
		    $('#'+strBotonArchivoIDAnticiposProveedoresCuentasPagar).val('');
        	//Hacer un llamado a la función para mostrar mensaje de error
			mensaje_anticipos_proveedores_cuentas_pagar('error', strMensajeError);
        }
        else
        {
        	//Si existe id del registro subir los archivos
        	if($('#txtAnticipoProveedorID_anticipos_proveedores_cuentas_pagar').val() != '')
        	{
	        	//Crear instancia al objeto del formulario
	        	var formData = new FormData($("#frmAnticiposProveedoresCuentasPagar")[0]);
	        	//Hacer un llamado al método del controlador para subir archivos del registro
	            $.ajax({
	                url: 'cuentas_pagar/anticipos_proveedores/subir_archivos',
	                type: "POST",
	                data: formData,
	                contentType: false,
	                processData: false,
	                success: function(data)
	                {
	                    //Limpia ruta del archivo cargado
		         		$('#'+strBotonArchivoIDAnticiposProveedoresCuentasPagar).val('');
						//Subida finalizada.
						if (data.resultado)
						{
						   //Mostrar los siguientes botones
	                       $('#btnDescargarArchivo_anticipos_proveedores_cuentas_pagar').show();
	                       $("#btnEliminarArchivo_anticipos_proveedores_cuentas_pagar").show();
		         		   //Hacer llamado a la función  para cargar  los registros en el grid
			           	   paginacion_anticipos_proveedores_cuentas_pagar();  
						}

						//Si la acción corresponde a un nuevo registro
	                    if(tipoAccion == 'Nuevo')
	                    {
	                    	//Si el tipo de mensaje es un éxito
			                if(data.tipo_mensaje == 'éxito')
			                {
				                //Hacer un llamado a la función para cerrar modal
				                cerrar_anticipos_proveedores_cuentas_pagar();
			                }
			                else
			                {
			                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				    			mensaje_anticipos_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
			                }
	                    }
	                    else
	                    {

	                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				    		mensaje_anticipos_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
	                    }
	                }
            	});
            }
        }
		
	}


	/*******************************************************************************************************************
	Funciones de la tabla detalles
	*********************************************************************************************************************/
	//Función para agregar renglón a la tabla
	function agregar_renglon_detalles_anticipos_proveedores_cuentas_pagar()
	{
		//Obtenemos los datos de las cajas de texto
		var intRenglon = $('#txtRenglon_detalles_anticipos_proveedores_cuentas_pagar').val();
		var strConcepto = $('#txtConcepto_detalles_anticipos_proveedores_cuentas_pagar').val();
		var intSubtotal = $('#txtSubtotal_detalles_anticipos_proveedores_cuentas_pagar').val();
		var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_anticipos_proveedores_cuentas_pagar').val();
		var intImporteIva = $('#txtIva_detalles_anticipos_proveedores_cuentas_pagar').val();
		var intPorcentajeIva = $('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').val();
		var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_anticipos_proveedores_cuentas_pagar').val();
		var intImporteIeps = $('#txtIeps_detalles_anticipos_proveedores_cuentas_pagar').val();
		var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').val();
		var intTotal = $('#txtTotal_detalles_anticipos_proveedores_cuentas_pagar').val();

		//Obtenemos el objeto de la tabla
		var objTabla = document.getElementById('dg_detalles_anticipos_proveedores_cuentas_pagar').getElementsByTagName('tbody')[0];

		//Validamos que se capturaron datos
		if (strConcepto == '')
		{
			//Enfocar caja de texto
			$('#txtConcepto_detalles_anticipos_proveedores_cuentas_pagar').focus();
		}
		else if (intSubtotal == '')
		{
			//Enfocar caja de texto
			$('#txtSubtotal_detalles_anticipos_proveedores_cuentas_pagar').focus();
		}
		else if (intPorcentajeIva == '')
		{
			//Enfocar caja de texto
			$('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').focus();
		}
		else if(intTasaCuotaIeps == '' && intPorcentajeIeps != '')
		{
			//Limpiar caja de texto
			$('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').val('');
			//Enfocar caja de texto
			$('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').focus();
		}
		else
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_detalles_anticipos_proveedores_cuentas_pagar').val('');
			$('#txtConcepto_detalles_anticipos_proveedores_cuentas_pagar').val('');
			$('#txtSubtotal_detalles_anticipos_proveedores_cuentas_pagar').val('');
			$('#txtTasaCuotaIva_detalles_anticipos_proveedores_cuentas_pagar').val('');
			$('#txtIva_detalles_anticipos_proveedores_cuentas_pagar').val('');
			$('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').val('');
			$('#txtTasaCuotaIeps_detalles_anticipos_proveedores_cuentas_pagar').val('');
			$('#txtIeps_detalles_anticipos_proveedores_cuentas_pagar').val('');
			$('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').val('');
			$('#txtTotal_detalles_anticipos_proveedores_cuentas_pagar').val('');
			

			//Crear instancia del objeto Detalle del anticipo
			objDetalleAnticipoAnticiposProveedoresCuentasPagar = new DetalleAnticipoAnticiposProveedoresCuentasPagar('', '', '',
																													 '', '', '', 
																													 '', '', '');

			
			//Utilizar toUpperCase() para cambiar texto a mayúsculas
			strConcepto = strConcepto.toUpperCase();

		  	//Asignar valores al objeto
			objDetalleAnticipoAnticiposProveedoresCuentasPagar.strConcepto = strConcepto;
			objDetalleAnticipoAnticiposProveedoresCuentasPagar.intSubtotal = intSubtotal;
			objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTasaCuotaIva = intTasaCuotaIva;
			objDetalleAnticipoAnticiposProveedoresCuentasPagar.intImporteIva = intImporteIva;
			objDetalleAnticipoAnticiposProveedoresCuentasPagar.intPorcentajeIva = intPorcentajeIva;
			objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTasaCuotaIeps = intTasaCuotaIeps;
			objDetalleAnticipoAnticiposProveedoresCuentasPagar.intImporteIeps = intImporteIeps;
			objDetalleAnticipoAnticiposProveedoresCuentasPagar.intPorcentajeIeps = intPorcentajeIeps;
			objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTotal = intTotal;

			//Revisamos si existe el renglón, si es así, editamos los datos del detalle
			if (intRenglon)
			{
				//Modificar los datos del detalle corespondiente al indice
	        	objDetallesAnticipoAnticiposProveedoresCuentasPagar.modificarDetalle(intRenglon, objDetalleAnticipoAnticiposProveedoresCuentasPagar);

	        	//Incrementar renglón para obtener la posición del detalle en la tabla
				intRenglon++;
				
				//Seleccionar el renglón de la tabla para actualizar los datos del detalle
				var selectedRow = document.getElementById("dg_detalles_anticipos_proveedores_cuentas_pagar").rows[intRenglon].cells;
				selectedRow[0].innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.strConcepto;
				selectedRow[1].innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intSubtotal
				selectedRow[2].innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intImporteIva;
				selectedRow[3].innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intImporteIeps;
				selectedRow[4].innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTotal;
			}
			else
			{
				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				intRenglon = $("#dg_detalles_anticipos_proveedores_cuentas_pagar tr").length - 2;
				//Incrementar 1 para el siguiente renglón
				intRenglon++;

				//Agregar datos del detalle del anticipo
           		objDetallesAnticipoAnticiposProveedoresCuentasPagar.setDetalle(objDetalleAnticipoAnticiposProveedoresCuentasPagar);

           		//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaConcepto = objRenglon.insertCell(0);
				var objCeldaSubtotal = objRenglon.insertCell(1);
				var objCeldaIva = objRenglon.insertCell(2);
				var objCeldaIeps = objRenglon.insertCell(3);
				var objCeldaTotal = objRenglon.insertCell(4);
				var objCeldaAcciones = objRenglon.insertCell(5);
				//Columnas ocultas
				var objCeldaPorcentajeIva = objRenglon.insertCell(6);
				var objCeldaPorcentajeIeps = objRenglon.insertCell(7);
				var objCeldaTasaCuotaIva = objRenglon.insertCell(8);
				var objCeldaTasaCuotaIeps = objRenglon.insertCell(9);


				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', intRenglon);
				objCeldaConcepto.setAttribute('class', 'movil b1');
				objCeldaConcepto.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.strConcepto;
				objCeldaSubtotal.setAttribute('class', 'movil b2');
				objCeldaSubtotal.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intSubtotal;
				objCeldaIva.setAttribute('class', 'movil b3');
				objCeldaIva.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intImporteIva;
				objCeldaIeps.setAttribute('class', 'movil b4');
				objCeldaIeps.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intImporteIeps;
				objCeldaTotal.setAttribute('class', 'movil b5');
				objCeldaTotal.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTotal;
				objCeldaAcciones.setAttribute('class', 'td-center movil b6');
				objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_detalles_anticipos_proveedores_cuentas_pagar(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
											 " onclick='eliminar_renglon_detalles_anticipos_proveedores_cuentas_pagar(this)'>" + 
											 "<span class='glyphicon glyphicon-trash'></span></button>" + 
											 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
											 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
			    objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
				objCeldaPorcentajeIva.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intPorcentajeIva; 
				objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
				objCeldaPorcentajeIeps.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intPorcentajeIeps;
				objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
				objCeldaTasaCuotaIva.innerHTML = objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTasaCuotaIva;
				objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
				objCeldaTasaCuotaIeps.innerHTML =  objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTasaCuotaIeps;

			}

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_anticipos_proveedores_cuentas_pagar();
			//Enfocar caja de texto
			$('#txtConcepto_detalles_anticipos_proveedores_cuentas_pagar').focus();

		}

		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_detalles_anticipos_proveedores_cuentas_pagar tr").length - 2;
		$('#numElementos_detalles_anticipos_proveedores_cuentas_pagar').html(intFilas);
		$('#txtNumDetalles_anticipos_proveedores_cuentas_pagar').val(intFilas);
	}

	//Función para regresar los datos (al formulario) del renglón seleccionado
	function editar_renglon_detalles_anticipos_proveedores_cuentas_pagar(objRenglon)
	{
		//Decrementar indice para obtener la posición del detalle en el arreglo
		var intRenglon =  parseInt(objRenglon.parentNode.parentNode.rowIndex) - 1;

		//Crear instancia del objeto Detalle del anticipo
        objDetalleAnticipoAnticiposProveedoresCuentasPagar = new DetalleAnticipoAnticiposProveedoresCuentasPagar();

        //Asignar datos del detalle corespondiente al indice
        objDetalleAnticipoAnticiposProveedoresCuentasPagar = objDetallesAnticipoAnticiposProveedoresCuentasPagar.getDetalle(intRenglon);

        //Asignar los valores a las cajas de texto
	    $('#txtRenglon_detalles_anticipos_proveedores_cuentas_pagar').val(intRenglon);
	    $('#txtConcepto_detalles_anticipos_proveedores_cuentas_pagar').val(objDetalleAnticipoAnticiposProveedoresCuentasPagar.strConcepto);
		$('#txtSubtotal_detalles_anticipos_proveedores_cuentas_pagar').val(objDetalleAnticipoAnticiposProveedoresCuentasPagar.intSubtotal);
		$('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').val(objDetalleAnticipoAnticiposProveedoresCuentasPagar.intPorcentajeIva);
		$('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').val(objDetalleAnticipoAnticiposProveedoresCuentasPagar.intPorcentajeIeps);
		$('#txtTasaCuotaIva_detalles_anticipos_proveedores_cuentas_pagar').val(objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTasaCuotaIva);
		$('#txtTasaCuotaIeps_detalles_anticipos_proveedores_cuentas_pagar').val(objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTasaCuotaIeps);
		$('#txtIva_detalles_anticipos_proveedores_cuentas_pagar').val(objDetalleAnticipoAnticiposProveedoresCuentasPagar.intImporteIva);
		$('#txtIeps_detalles_anticipos_proveedores_cuentas_pagar').val(objDetalleAnticipoAnticiposProveedoresCuentasPagar.intImporteIeps);
		$('#txtTotal_detalles_anticipos_proveedores_cuentas_pagar').val(objDetalleAnticipoAnticiposProveedoresCuentasPagar.intTotal);
		
		//Enfocar caja de texto
		$('#txtConcepto_detalles_anticipos_proveedores_cuentas_pagar').focus();	
	}

	//Función para quitar renglón de la tabla
	function eliminar_renglon_detalles_anticipos_proveedores_cuentas_pagar(objRenglon)
	{
		//Obtener el indice del objeto renglón que se envía
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex;

		//Eliminar del objeto el detalle seleccionado
		objDetallesAnticipoAnticiposProveedoresCuentasPagar.eliminarDetalle(intRenglon - 1);

		//Eliminar el renglón indicado
		document.getElementById("dg_detalles_anticipos_proveedores_cuentas_pagar").deleteRow(intRenglon);

		//Hacer un llamado a la función para calcular totales de la tabla
		calcular_totales_detalles_anticipos_proveedores_cuentas_pagar();
		
		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_detalles_anticipos_proveedores_cuentas_pagar tr").length - 2;
		$('#numElementos_detalles_anticipos_proveedores_cuentas_pagar').html(intFilas);
		$('#txtNumDetalles_anticipos_proveedores_cuentas_pagar').val(intFilas);

		//Enfocar combobox
		$('#txtConcepto_detalles_anticipos_proveedores_cuentas_pagar').focus();
	}


	//Función para calcular totales de la tabla
	function calcular_totales_detalles_anticipos_proveedores_cuentas_pagar()
	{
		//Obtenemos el objeto de la tabla 
		var objTabla = document.getElementById('dg_detalles_anticipos_proveedores_cuentas_pagar').getElementsByTagName('tbody')[0];

		//Inicializamos las variables que se utilizan para los acumulados
		var intAcumSubtotal = 0;
		var intAcumIva = 0;
		var intAcumIeps = 0;
		var intAcumTotal = 0;

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Incrementar acumulados
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
			intAcumIva += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
			intAcumIeps += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
			intAcumTotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
		}

		//Convertir cantidad a formato moneda
		intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesSubtotalBDAnticiposProveedoresCuentasPagar, '');
		intAcumIva =  '$'+formatMoney(intAcumIva, intNumDecimalesIvaBDAnticiposProveedoresCuentasPagar, '');
		intAcumIeps =  '$'+formatMoney(intAcumIeps, intNumDecimalesIepsBDAnticiposProveedoresCuentasPagar, '');
		intAcumTotal =  '$'+formatMoney(intAcumTotal, intNumDecimalesMostrarAnticiposProveedoresCuentasPagar, '');


		//Asignar los valores
		$('#acumSubtotal_detalles_anticipos_proveedores_cuentas_pagar').html(intAcumSubtotal);
		$('#acumIva_detalles_anticipos_proveedores_cuentas_pagar').html(intAcumIva);
		$('#acumIeps_detalles_anticipos_proveedores_cuentas_pagar').html(intAcumIeps);
		$('#acumTotal_detalles_anticipos_proveedores_cuentas_pagar').html(intAcumTotal);
	}


	//Función que se utiliza para calcular el importe total de un detalle
	function calcular_total_detalles_anticipos_proveedores_cuentas_pagar()
	{
		//Variable que se utiliza para asignar el subtotal
		var intSubtotal= 0;
		//Variable que se utiliza para asignar el importe de iva
		var intImporteIva = 0;
		//Variable que se utiliza para asignar el importe de ieps
		var intImporteIeps = 0;
		//Variable que se utiliza para asignar el importe total
		var intTotal = 0;

		//Obtenemos los datos de las cajas de texto
		var intPorcentajeIva = $('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').val();
		var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').val();


     	//Verificar que exista importe de subtotal
		if($('#txtSubtotal_detalles_anticipos_proveedores_cuentas_pagar').val() != '')
		{ 
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intSubtotal = parseFloat($.reemplazar($("#txtSubtotal_detalles_anticipos_proveedores_cuentas_pagar").val(), ",", ""));

			
			//Si existe porcentaje de IVA
			if(intPorcentajeIva != '')
			{
				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
				//Redondear cantidad a decimales
			   	intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaBDAnticiposProveedoresCuentasPagar);
			   	intImporteIva = parseFloat(intImporteIva);
		   }


			//Si existe porcentaje de IEPS
			if(intPorcentajeIeps != '')
			{
				//Calcular importe de IEPS
				intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
				//Redondear cantidad a decimales
			   	intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsBDAnticiposProveedoresCuentasPagar);
			   	intImporteIeps = parseFloat(intImporteIeps);
			}
		}

		//Calcular importe total
		intTotal = (intSubtotal + intImporteIva + intImporteIeps);

		//Cambiar cantidad a formato moneda
		intTotal  =  formatMoney(intTotal, intNumDecimalesMostrarAnticiposProveedoresCuentasPagar, '');
		intImporteIva  =  formatMoney(intImporteIva, intNumDecimalesIvaBDAnticiposProveedoresCuentasPagar, '');
		intImporteIeps  =  formatMoney(intImporteIeps, intNumDecimalesIepsBDAnticiposProveedoresCuentasPagar, '');

		//Asignar importe total 
		$('#txtTotal_detalles_anticipos_proveedores_cuentas_pagar').val(intTotal);
		$('#txtIva_detalles_anticipos_proveedores_cuentas_pagar').val(intImporteIva);
		$('#txtIeps_detalles_anticipos_proveedores_cuentas_pagar').val(intImporteIeps);
	}


	//Controles o Eventos del Modal
	$(document).ready(function() 
	{
		/*******************************************************************************************************************
		Controles correspondientes al modal
		*********************************************************************************************************************/
		//Validar campos decimales (no hay necesidad de poner '.')
		$('#txtTipoCambio_anticipos_proveedores_cuentas_pagar').numeric();
		$('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').numeric();
		$('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').numeric();
    	$('#txtSubtotal_detalles_anticipos_proveedores_cuentas_pagar').numeric();

		/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        * por ejemplo: 18.90 será 18.9000*/
        $('.tipo-cambio_anticipos_proveedores_cuentas_pagar').blur(function(){
            $('.tipo-cambio_anticipos_proveedores_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 4 });
        });

		/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
    	 * por ejemplo: 1800 será 1,800.00*/
    	$('.moneda_anticipos_proveedores_cuentas_pagar').blur(function(){
			$('.moneda_anticipos_proveedores_cuentas_pagar').formatCurrency({ roundToDecimalPlace: intNumDecimalesSubtotalBDAnticiposProveedoresCuentasPagar });
		});

    	//Agregar datepicker para seleccionar fecha
		$('#dteFecha_anticipos_proveedores_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
		
    	//Regresar el tipo de cambio de la moneda cuando cambie la fecha
		$('#dteFecha_anticipos_proveedores_cuentas_pagar').on('dp.change', function (e) {
			//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
			get_tipo_cambio_anticipos_proveedores_cuentas_pagar();
		});

		//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
        $('#cmbMonedaID_anticipos_proveedores_cuentas_pagar').change(function(e){   
            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
          	if(parseInt($('#cmbMonedaID_anticipos_proveedores_cuentas_pagar').val()) === intMonedaBaseIDAnticiposProveedoresCuentasPagar)
         	{
         		//Deshabilitar caja de texto
				$("#txtTipoCambio_anticipos_proveedores_cuentas_pagar").attr('disabled','disabled');
				//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
				$('#txtTipoCambio_anticipos_proveedores_cuentas_pagar').val(intTipoCambioMonedaBaseAnticiposProveedoresCuentasPagar);
				//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
				$('#txtTipoCambio_anticipos_proveedores_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 4 });
         	}
         	else
         	{
         		//Habilitar caja de texto
				$("#txtTipoCambio_anticipos_proveedores_cuentas_pagar").removeAttr('disabled');
				//Limpiar contenido de la caja de texto
				$('#txtTipoCambio_anticipos_proveedores_cuentas_pagar').val(''); 
				//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_anticipos_proveedores_cuentas_pagar();
         	}

         	//Limpiar contenido de las siguientes cajas de texto
            $('#txtCuentaBancariaID_anticipos_proveedores_cuentas_pagar').val('');
	        $('#txtCuentaBancaria_anticipos_proveedores_cuentas_pagar').val('');
        });

        //Verificar importe cuando pierda el enfoque la caja de texto
		$('#txtTipoCambio_anticipos_proveedores_cuentas_pagar').focusout(function(e){

			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_anticipos_proveedores_cuentas_pagar').val(), ",", ""));

			//Si el tipo de cambio es mayor que el valor máximo permitido
			if(intTipoCambio > intTipoCambioMaximoAnticiposProveedoresCuentasPagar)
			{
				$('#txtTipoCambio_anticipos_proveedores_cuentas_pagar').val(intTipoCambioMaximoAnticiposProveedoresCuentasPagar);
			}

		});

        //Autocomplete para recuperar los datos de un proveedor 
        $('#txtProveedor_anticipos_proveedores_cuentas_pagar').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtProveedorID_anticipos_proveedores_cuentas_pagar').val('');
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
             //Asignar valores del registro seleccionado
             $('#txtProveedorID_anticipos_proveedores_cuentas_pagar').val(ui.item.data);
             $('#txtRfc_anticipos_proveedores_cuentas_pagar').val(ui.item.rfc);
             $('#txtRazonSocial_anticipos_proveedores_cuentas_pagar').val(ui.item.razon_social);
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
        $('#txtProveedor_anticipos_proveedores_cuentas_pagar').focusout(function(e){
            //Si no existe id del proveedor
            if($('#txtProveedorID_anticipos_proveedores_cuentas_pagar').val() == '' ||
               $('#txtProveedor_anticipos_proveedores_cuentas_pagar').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtProveedorID_anticipos_proveedores_cuentas_pagar').val('');
               $('#txtProveedor_anticipos_proveedores_cuentas_pagar').val('');
               $("#txtRfc_anticipos_proveedores_cuentas_pagar").val('');
               $("#txtRazonSocial_anticipos_proveedores_cuentas_pagar").val('');
            }
        });
			
		//Autocomplete para recuperar los datos de una cuenta bancaria 
		$('#txtCuentaBancaria_anticipos_proveedores_cuentas_pagar').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtCuentaBancariaID_anticipos_proveedores_cuentas_pagar').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "cuentas_pagar/cuentas_bancarias/autocomplete",
                 type: "post",
                 dataType: "json",
                 data: {
                   strDescripcion: request.term,
                   intMonedaID: $('#cmbMonedaID_anticipos_proveedores_cuentas_pagar').val()

                 },
                 success: function( data ) {
                   response( data );
                 }
               });
           },
           select: function( event, ui ) {
             //Asignar id del registro seleccionado
             $('#txtCuentaBancariaID_anticipos_proveedores_cuentas_pagar').val(ui.item.data);
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });

	    //Verificar que exista id de la cuenta bancaria cuando pierda el enfoque la caja de texto
        $('#txtCuentaBancaria_anticipos_proveedores_cuentas_pagar').focusout(function(e){
            //Si no existe id de la cuenta bancaria
            if($('#txtCuentaBancariaID_anticipos_proveedores_cuentas_pagar').val() == '' ||
               $('#txtCuentaBancaria_anticipos_proveedores_cuentas_pagar').val() == '')
            { 
                //Limpiar contenido de las siguientes cajas de texto
               	$('#txtCuentaBancariaID_anticipos_proveedores_cuentas_pagar').val('');
              	$('#txtCuentaBancaria_anticipos_proveedores_cuentas_pagar').val('');
            }

        });



		//Función para mover renglones arriba y abajo en la tabla
		$('#dg_detalles_anticipos_proveedores_cuentas_pagar').on('click','button.btn',function(){
			//Asignar renglón mas cercano
            var row = $(this).closest('tr');
            //Bajar renglón
            if ($(this).hasClass('btn-default btn-xs down'))
            {
            	//Verifica que no sea el último elemento del grid
            	if( row.next().index() != -1 )
            	{ 
            		objDetallesAnticipoAnticiposProveedoresCuentasPagar.swap(row.index(), row.next().index() );
            	}	

            	//Pasar al siguiente renglón
            	row.next().after(row);
            }
            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
            {
            	//Verifica que no sea el primer elemento del grid
            	if( row.prev().index() != -1 )
            	{ 
            		objDetallesAnticipoAnticiposProveedoresCuentasPagar.swap(row.prev().index(), row.index() );
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


        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
        $('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtTasaCuotaIva_detalles_anticipos_proveedores_cuentas_pagar').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "contabilidad/sat_tasa_cuota/autocomplete",
                 type: "post",
                 dataType: "json",
                 data: {
                   strDescripcion: request.term, 
                   strImpuesto: 'IVA'
                 },
                 success: function( data ) {
                   response( data );
                 }
               });
           },
           select: function( event, ui ) {
             //Asignar id del registro seleccionado
             $('#txtTasaCuotaIva_detalles_anticipos_proveedores_cuentas_pagar').val(ui.item.data);
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });
        
        //Verificar que exista id de la tasa o cuota del impuesto de IVA cuando pierda el enfoque la caja de texto
        $('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').focusout(function(e){
            //Si no existe id de la tasa o cuota
            if($('#txtTasaCuotaIva_detalles_anticipos_proveedores_cuentas_pagar').val() == '' ||
               $('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtTasaCuotaIva_detalles_anticipos_proveedores_cuentas_pagar').val('');
               $('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').val('');
            }

            //Hacer un llamado a la función para calcular el importe total 
			calcular_total_detalles_anticipos_proveedores_cuentas_pagar();
            
        });

        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
        $('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtTasaCuotaIeps_detalles_anticipos_proveedores_cuentas_pagar').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "contabilidad/sat_tasa_cuota/autocomplete",
                 type: "post",
                 dataType: "json",
                 data: {
                   strDescripcion: request.term, 
                   strImpuesto: 'IEPS'
                 },
                 success: function( data ) {
                   response( data );
                 }
               });
           },
           select: function( event, ui ) {
             //Asignar id del registro seleccionado
             $('#txtTasaCuotaIeps_detalles_anticipos_proveedores_cuentas_pagar').val(ui.item.data);
           },
           open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
             },
             close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
             },
           minLength: 1
        });
        
        //Verificar que exista id de la tasa o cuota del impuesto de IEPS cuando pierda el enfoque la caja de texto
        $('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').focusout(function(e){
            //Si no existe id de la tasa o cuota
            if($('#txtTasaCuotaIeps_detalles_anticipos_proveedores_cuentas_pagar').val() == '' ||
               $('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtTasaCuotaIeps_detalles_anticipos_proveedores_cuentas_pagar').val('');
               $('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').val('');
            }
            
            //Hacer un llamado a la función para calcular el importe total
			calcular_total_detalles_anticipos_proveedores_cuentas_pagar();
        });

        //Calcular el importe total del detalle cuando pierda el enfoque la caja de texto
		$('#txtSubtotal_detalles_anticipos_proveedores_cuentas_pagar').focusout(function(e){
			//Hacer un llamado a la función para calcular el importe total
			calcular_total_detalles_anticipos_proveedores_cuentas_pagar();
		});


		//Validar que exista concepto cuando se pulse la tecla enter 
		$('#txtConcepto_detalles_anticipos_proveedores_cuentas_pagar').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	            //Si no existe concepto
	           if($('#txtConcepto_detalles_anticipos_proveedores_cuentas_pagar').val() == '')
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtConcepto_detalles_anticipos_proveedores_cuentas_pagar').focus();
		   	    }
		   	    else
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtSubtotal_detalles_anticipos_proveedores_cuentas_pagar').focus();
		   	    }
	        }
	    });


	    //Validar que exista procentaje de IVA cuando se pulse la tecla enter 
		$('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	         	//Si no existe procentaje de IVA
	            if( $('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').val() == '')
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtPorcentajeIva_detalles_anticipos_proveedores_cuentas_pagar').focus();
		   	    }
		   	    else
		   	    {
		   	   	   //Enfocar caja de texto
				   $('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').focus();
		   	    }
	        }
	    });


		//Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
		$('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
	         	if($('#txtTasaCuotaIeps_detalles_anticipos_proveedores_cuentas_pagar').val() == '' && 
	         	   $('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').val() != '')
	         	{
	         	
	         		//Enfocar caja de texto
				    $('#txtPorcentajeIeps_detalles_anticipos_proveedores_cuentas_pagar').focus();
	         	}
	         	else
	         	{
	         		
    				//Hacer un llamado a la función para agregar renglón a la tabla
    				agregar_renglon_detalles_anticipos_proveedores_cuentas_pagar();	
	         	}
	        }
	    });
		


		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_anticipos_proveedores_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_anticipos_proveedores_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_anticipos_proveedores_cuentas_pagar').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_anticipos_proveedores_cuentas_pagar').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_anticipos_proveedores_cuentas_pagar').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_anticipos_proveedores_cuentas_pagar').data('DateTimePicker').maxDate(e.date);
		});

		//Paginación de registros
		$('#pagLinks_anticipos_proveedores_cuentas_pagar').on('click','a',function(event){
			event.preventDefault();
			intPaginaAnticiposProveedoresCuentasPagar = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_anticipos_proveedores_cuentas_pagar();
		});

		//Autocomplete para recuperar los datos de un evento 
        $('#txtProveedorBusq_anticipos_proveedores_cuentas_pagar').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtProveedorIDBusq_anticipos_proveedores_cuentas_pagar').val('');
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
             	$('#txtProveedorIDBusq_anticipos_proveedores_cuentas_pagar').val(ui.item.data);
             	$('#txtProveedorBusq_anticipos_proveedores_cuentas_pagar').val(ui.item.value);
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
        $('#txtProveedorBusq_anticipos_proveedores_cuentas_pagar').focusout(function(e){
            //Si no existe id del proveedor
            if($('#txtProveedorIDBusq_anticipos_proveedores_cuentas_pagar').val() == '' ||
            	$('#txtProveedorBusq_anticipos_proveedores_cuentas_pagar').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtProveedorIDBusq_anticipos_proveedores_cuentas_pagar').val('');
               $('#txtProveedorBusq_anticipos_proveedores_cuentas_pagar').val('');
            }
            
        });

        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_anticipos_proveedores_cuentas_pagar').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_anticipos_proveedores_cuentas_pagar('Nuevo');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_anticipos_proveedores_cuentas_pagar').addClass("estatus-NUEVO");
			//Abrir modal
			 objAnticiposProveedoresCuentasPagar = $('#AnticiposProveedoresCuentasPagarBox').bPopup({
										   appendTo: '#AnticiposProveedoresCuentasPagarContent', 
			                               contentContainer: 'AnticiposProveedoresCuentasPagarM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#cmbMonedaID_anticipos_proveedores_cuentas_pagar').focus();
			
		});


		//Enfocar caja de texto
		$('#txtBusqueda_anticipos_proveedores_cuentas_pagar').focus();  	
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_anticipos_proveedores_cuentas_pagar();
		//Hacer un llamado a la función para cargar monedas en el combobox del modal
  		cargar_monedas_anticipos_proveedores_cuentas_pagar();

	});

</script>				