<div id="MovimientosBancariosCuentasPagarContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_movimientos_bancarios_cuentas_pagar" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_movimientos_bancarios_cuentas_pagar">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_movimientos_bancarios_cuentas_pagar'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_movimientos_bancarios_cuentas_pagar"
			                    		name= "strFechaInicialBusq_movimientos_bancarios_cuentas_pagar" 
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
							<label for="txtFechaFinalBusq_movimientos_bancarios_cuentas_pagar">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_movimientos_bancarios_cuentas_pagar'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_movimientos_bancarios_cuentas_pagar"
			                    		name= "strFechaFinalBusq_movimientos_bancarios_cuentas_pagar" 
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
				<!--Cuenta-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtCuentaBancariaBusq_movimientos_bancarios_cuentas_pagar">Cuenta</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtCuentaBancariaIDBusq_movimientos_bancarios_cuentas_pagar" 
									name="intCuentaBancariaIDBusq_movimientos_bancarios_cuentas_pagar" 
									type="hidden" />
							<input  class="form-control" 
									id="txtCuentaBancariaBusq_movimientos_bancarios_cuentas_pagar" 
									name="strCuentaBusq_movimientos_bancarios_cuentas_pagar" 
									type="text" 
									value="" 
									tabindex="1" 
									placeholder="Ingrese cuenta bancaria"  maxlength="250"/>
						</div>
					</div>
				</div>
				<!--Estatus-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="cmbEstatusBusq_movimientos_bancarios_cuentas_pagar">Estatus</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="cmbEstatusBusq_movimientos_bancarios_cuentas_pagar" 
							 		name="strEstatusBusq_movimientos_bancarios_cuentas_pagar" tabindex="1">
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
							<label for="txtBusqueda_movimientos_bancarios_cuentas_pagar">Descripción</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtBusqueda_movimientos_bancarios_cuentas_pagar" 
									name="strBusqueda_movimientos_bancarios_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Mostrar detalles de los registros en el reporte PDF--> 
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
					<div class="checkbox">
                    	<label id="label-checkbox">
                        	<input class="form-control" 
                        			id="chbImprimirDetalles_movimientos_bancarios_cuentas_pagar" 
								   	name="strImprimirDetalles_movimientos_bancarios_cuentas_pagar" 
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
						<button class="btn btn-primary" id="btnBuscar_movimientos_bancarios_cuentas_pagar"
								onclick="paginacion_movimientos_bancarios_cuentas_pagar();" 
								title="Buscar coincidencias" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<!--Dar de alta un nuevo registro-->
						<button class="btn btn-info" id="btnNuevo_movimientos_bancarios_cuentas_pagar" 
								title="Nuevo registro" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>   
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_movimientos_bancarios_cuentas_pagar"
								onclick="reporte_movimientos_bancarios_cuentas_pagar();" title="Imprimir reporte general en PDF" tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_movimientos_bancarios_cuentas_pagar"
								onclick="descargar_xls_movimientos_bancarios_cuentas_pagar();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
			Definir columnas de la tabla movimientos bancarios
			*/
			td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
			td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
			td.movil.a3:nth-of-type(3):before {content: "Cuenta"; font-weight: bold;}
			td.movil.a4:nth-of-type(4):before {content: "Tipo"; font-weight: bold;}
			td.movil.a5:nth-of-type(5):before {content: "Concepto"; font-weight: bold;}
			td.movil.a6:nth-of-type(6):before {content: "Importe"; font-weight: bold;}
			td.movil.a7:nth-of-type(7):before {content: "Estatus"; font-weight: bold;}
			td.movil.a8:nth-of-type(8):before {content: "Acciones"; font-weight: bold;}

			/*
			Definir columnas de la tabla detalles del movimiento bancario
			*/
			td.movil.b1:nth-of-type(1):before {content: "Cuenta"; font-weight: bold;}
			td.movil.b2:nth-of-type(2):before {content: "Importe"; font-weight: bold;}
			td.movil.b3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}

			/*
				Definir columnas de los totales (acumulados) de la tabla detalles del movimiento bancario
			*/
			td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
			td.movil.t2:nth-of-type(2):before {content: "Importe"; font-weight: bold;}


		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_movimientos_bancarios_cuentas_pagar">
				<thead class="movil">
					<tr class="movil">
						<th class="movil">Folio</th>
						<th class="movil">Fecha</th>
						<th class="movil">Cuenta</th>
						<th class="movil">Tipo</th>
						<th class="movil">Concepto</th>
						<th class="movil">Importe</th>
						<th class="movil">Estatus</th>
						<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
					</tr>
				</thead>
				<tbody class="movil"></tbody>
				<script id="plantilla_movimientos_bancarios_cuentas_pagar" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil a1">{{folio}}</td>
						<td class="movil a2">{{fecha}}</td>
						<td class="movil a3">{{cuenta_bancaria}}</td>
						<td class="movil a4">{{tipo}}</td>
						<td class="movil a5">{{concepto}}</td>
						<td class="movil a6">{{importe}}</td>
						<td class="movil a7">{{estatus}}</td>
						<td class="td-center movil a8"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_movimientos_bancarios_cuentas_pagar({{movimiento_bancario_id}})"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_movimientos_bancarios_cuentas_pagar({{movimiento_bancario_id}})"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_movimientos_bancarios_cuentas_pagar({{movimiento_bancario_id}});"  title="Imprimir registro en PDF"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_movimientos_bancarios_cuentas_pagar({{movimiento_bancario_id}},'{{estatus}}')" title="Desactivar">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
									onclick="cambiar_estatus_movimientos_bancarios_cuentas_pagar({{movimiento_bancario_id}},'{{estatus}}')"  title="Restaurar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_movimientos_bancarios_cuentas_pagar"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_movimientos_bancarios_cuentas_pagar">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!-- Diseño del modal-->
	<div id="MovimientosBancariosCuentasPagarBox" class="ModalBody">
		<!--Título-->
		<div id="divEncabezadoModal_movimientos_bancarios_cuentas_pagar"  class="ModalBodyTitle">
			<h1>Movimientos Bancarios</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form 	id="frmMovimientosBancariosCuentasPagar" 
					method="post" 
					action="#" 
					class="form-horizontal" 
					role="form" 
				  	name="frmMovimientosBancariosCuentasPagar"  
				  	onsubmit="return(false)" autocomplete="off">

				<div class="row">
				  	<!-- Folio -->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input 	id="txtMovimientoBancarioID_movimientos_bancarios_cuentas_pagar" 
										name="intMovimientoBancarioID_movimientos_bancarios_cuentas_pagar" 
										type="hidden" 
										value="" />
								<label for="txtFolio_movimientos_bancarios_cuentas_pagar">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtFolio_movimientos_bancarios_cuentas_pagar" 
										name="strFolio_movimientos_bancarios_cuentas_pagar" 
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
								<label for="txtFecha_movimientos_bancarios_cuentas_pagar">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_movimientos_bancarios_cuentas_pagar'>
				                    <input class="form-control" 
				                    		id="txtFecha_movimientos_bancarios_cuentas_pagar"
				                    		name= "strFecha_movimientos_bancarios_cuentas_pagar" 
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
					<!--Tipo-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbTipo_movimientos_bancarios_cuentas_pagar">Tipo</label>
							</div>
							<div id="divCmbMsjValidacion" class="col-md-12">
								<select  class="form-control" 
										id="cmbTipo_movimientos_bancarios_cuentas_pagar" 
								 		name="strTipo_movimientos_bancarios_cuentas_pagar" 
								 		tabindex="1">
								 	<option value="">Seleccione una opción</option>
								    <option value="INGRESO">INGRESO</option>
                      				<option value="EGRESO">EGRESO</option>
                 				</select>
							</div>
						</div>
					</div>
					<!--Combobox que contiene las tipos de movimientos bancarios activos-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbMovimientoBancarioTipoID_movimientos_bancarios_cuentas_pagar">Tipo de movimiento</label>
							</div>
							<div id="divCmbMsjValidacion" class="col-md-12">
								<select class="form-control" id="cmbMovimientoBancarioTipoID_movimientos_bancarios_cuentas_pagar" 
								 		name="intMovimientoBancarioTipoID_movimientos_bancarios_cuentas_pagar" tabindex="1">
                 				</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Autocomplete que contiene las cuentas bancarias activas-->
					<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta bancaria seleccionada-->
								<input 	id="txtCuentaBancariaID_movimientos_bancarios_cuentas_pagar" 
										name="intCuentaBancariaID_movimientos_bancarios_cuentas_pagar" 
										type="hidden" 
										value="" />
								<label for="txtCuentaBancaria_movimientos_bancarios_cuentas_pagar">Cuenta</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtCuentaBancaria_movimientos_bancarios_cuentas_pagar" 
										name="strCuentaBancaria_movimientos_bancarios_cuentas_pagar" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese cuenta bancaria" 
										maxlength="250" />
							</div>
						</div>
					</div>
					<!--Moneda-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtMoneda_movimientos_bancarios_cuentas_pagar">Moneda</label>
							</div>
							<div class="col-md-12">
                 				<input  class="form-control" 
										id="txtMoneda_movimientos_bancarios_cuentas_pagar" 
										name="strMoneda_movimientos_bancarios_cuentas_pagar" 
										type="text" value="" disabled/>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Subtotal-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtSubtotal_movimientos_bancarios_cuentas_pagar">Subtotal</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_movimientos_bancarios_cuentas_pagar" id="txtSubtotal_movimientos_bancarios_cuentas_pagar" 
											name="intSubtotal_movimientos_bancarios_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese subtotal" maxlength="14">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta para asignar el importe del IVA-->
								<input id="txtIva_movimientos_bancarios_cuentas_pagar" 
									   name="intIva_movimientos_bancarios_cuentas_pagar" 
									   type="hidden" value="">
								</input>
								<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
								<input id="txtTasaCuotaIva_movimientos_bancarios_cuentas_pagar" 
									   name="intTasaCuotaIva_movimientos_bancarios_cuentas_pagar" 
									   type="hidden" value="">
								</input>
								<label for="txtPorcentajeIva_movimientos_bancarios_cuentas_pagar">IVA %</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtPorcentajeIva_movimientos_bancarios_cuentas_pagar" 
										name="intPorcentajeIva_movimientos_bancarios_cuentas_pagar" 
										type="text" value="" 
										tabindex="1" 
										placeholder="Ingrese IVA" 
										maxlength="250" />
							</div>
						</div>
					</div>
					<!--Total-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtTotal_movimientos_bancarios_cuentas_pagar">Total</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control" id="txtTotal_movimientos_bancarios_cuentas_pagar" 
											name="intTotal_movimientos_bancarios_cuentas_pagar" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Concepto -->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtConcepto_movimientos_bancarios_cuentas_pagar">Concepto</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtConcepto_movimientos_bancarios_cuentas_pagar" 
										name="strConcepto_movimientos_bancarios_cuentas_pagar" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese concepto" 
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
								<label for="txtObservaciones_movimientos_bancarios_cuentas_pagar">Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_movimientos_bancarios_cuentas_pagar" 
										name="strObservaciones_movimientos_bancarios_cuentas_pagar" 
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
									<input id="txtNumDetalles_movimientos_bancarios_cuentas_pagar" 
									   name="intNumDetalles_movimientos_bancarios_cuentas_pagar" type="hidden" value="">
									</input>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Detalles del movimiento</h4>
									</div>
									<div class="panel-body">
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<div class="row">
												<!--Autocomplete que contiene las cuentas activas-->
												<div  class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
													<div class="form-group">
														<div class="col-md-12">
															<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
															<input id="txtRenglon_detalles_movimientos_bancarios_cuentas_pagar" 
																   name="intRenglon_detalles_movimientos_bancarios_cuentas_pagar" type="hidden" value="">
															</input>
															<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta seleccionada-->
															<input id="txtCuentaID_detalles_movimientos_bancarios_cuentas_pagar" 
																   name="intCuentaID_detalles_movimientos_bancarios_cuentas_pagar"  
																   type="hidden" value="">
															</input>
															<label for="txtCuenta_detalles_movimientos_bancarios_cuentas_pagar">Cuenta</label>
														</div>
														<div class="col-md-12">
															<input  class="form-control" id="txtCuenta_detalles_movimientos_bancarios_cuentas_pagar" 
																	name="strCuenta_detalles_movimientos_bancarios_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese cuenta" maxlength="250">
															</input>
														</div>
													</div>
												</div>
												<!--Importe-->
												<div class="col-sm-3 col-md-3 col-lg-3 col-xs-10">
													<div class="form-group">
														<div class="col-md-12">
															<label for="txtImporte_detalles_movimientos_bancarios_cuentas_pagar">Importe</label>
														</div>
														<div class="col-md-12">
															<div class='input-group'>
																<span class="input-group-addon">$</span>
																<input  class="form-control moneda_detalles_movimientos_bancarios_cuentas_pagar" id="txtImporte_detalles_movimientos_bancarios_cuentas_pagar" 
																		name="intImporte_detalles_movimientos_bancarios_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="21">
																</input>
															</div>
														</div>
													</div>
												</div>
												<!--Botón agregar-->
				                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
				                                	<button class="btn btn-primary btn-toolBtns pull-right" 
				                                			id="btnAgregar_detalles_movimientos_bancarios_cuentas_pagar"
				                                			onclick="agregar_renglon_detalles_movimientos_bancarios_cuentas_pagar();" 
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
												<table class="table-hover movil" id="dg_detalles_movimientos_bancarios_cuentas_pagar">
													<thead class="movil">
														<tr class="movil">
															<th class="movil">Cuenta</th>
															<th class="movil">Importe</th>
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
																<strong id="acumImporte_detalles_movimientos_bancarios_cuentas_pagar"></strong>
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
															<strong id="numElementos_detalles_movimientos_bancarios_cuentas_pagar">0</strong> encontrados
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
						<button class="btn btn-info" id="btnReiniciar_movimientos_bancarios_cuentas_pagar"  
								onclick="nuevo_movimientos_bancarios_cuentas_pagar('Nuevo');"  title="Nuevo registro" tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_movimientos_bancarios_cuentas_pagar"  
								onclick="validar_movimientos_bancarios_cuentas_pagar();"  title="Guardar" 
								tabindex="3" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_movimientos_bancarios_cuentas_pagar"  
								onclick="reporte_registro_movimientos_bancarios_cuentas_pagar('');"  
								title="Imprimir registro en PDF" tabindex="4" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" id="btnDesactivar_movimientos_bancarios_cuentas_pagar"  
								onclick="cambiar_estatus_movimientos_bancarios_cuentas_pagar('','ACTIVO');"  title="Desactivar" tabindex="5" disabled>
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Restaurar registro-->
						<button class="btn btn-default" id="btnRestaurar_movimientos_bancarios_cuentas_pagar"  
								onclick="cambiar_estatus_movimientos_bancarios_cuentas_pagar('','INACTIVO');"  title="Restaurar" tabindex="6" disabled>
							<span class="fa fa-exchange"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_movimientos_bancarios_cuentas_pagar"
								type="reset" aria-hidden="true" onclick="cerrar_movimientos_bancarios_cuentas_pagar();" 
								title="Cerrar"  tabindex="7">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>		
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div>	<!--Cierre del modal-->
</div><!--#MovimientosBancariosCuentasPagarContent -->

<!-- /.Plantilla para cargar los tipos de movimientos bancarios en el combobox-->  
<script id="movimientos_bancarios_tipos_movimientos_bancarios_cuentas_pagar" type="text/template">
	<option value="">Seleccione una opción</option>
	{{#movimientos_bancarios_tipos}}
	<option value="{{value}}">{{nombre}}</option>
	{{/movimientos_bancarios_tipos}} 
</script>

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variables que se utilizan para la paginación de registros
	var intPaginaMovimientosBancariosCuentasPagar = 0;
	var strUltimaBusquedaMovimientosBancariosCuentasPagar = "";
	//Variables que se utilizan para la búsqueda de registros
	var intMovimientoBancarioIDMovimientosBancariosCuentasPagar = "";
	var dteFechaInicialMovimientosBancariosCuentasPagar = "";
	var dteFechaFinalMovimientosBancariosCuentasPagar = "";
	//Variable que se utiliza para asignar objeto del modal
	var objMovimientosBancariosCuentasPagar = null;
    
	/*******************************************************************************************************************
	Funciones del objeto Detalles del movimiento bancario
	*********************************************************************************************************************/
	// Constructor del objeto detalles
	var objDetallesMovimientoMovimientosBancariosCuentasPagar;
	function DetallesMovimientoMovimientosBancariosCuentasPagar(detalles)
	{
		this.arrDetalles = detalles;
	}

	//Función para obtener todos los detalles del movimiento bancario
	DetallesMovimientoMovimientosBancariosCuentasPagar.prototype.getDetalles = function() {
	    return this.arrDetalles;
	}

	//Función para agregar una detalle al objeto 
	DetallesMovimientoMovimientosBancariosCuentasPagar.prototype.setDetalle = function (detalle){
		this.arrDetalles.push(detalle);
	}

	//Función para obtener un detalle del objeto
	DetallesMovimientoMovimientosBancariosCuentasPagar.prototype.getDetalle = function(index) {
	    return this.arrDetalles[index];
	}

	//Función para modificar un detalle del objeto
	DetallesMovimientoMovimientosBancariosCuentasPagar.prototype.modificarDetalle = function (index, detalle){
		this.arrDetalles[index] = detalle;
	}

	//Función para eliminar un detalle del objeto
	DetallesMovimientoMovimientosBancariosCuentasPagar.prototype.eliminarDetalle = function (index){
		if(index != -1) 
		{
			this.arrDetalles.splice(index, 1);
		}
	}

	//Función para cambiar las posiciones de los detalles en el objeto
	DetallesMovimientoMovimientosBancariosCuentasPagar.prototype.swap = function(index_A, index_B) {
	    var input = this.arrDetalles;
	 
	    var temp = input[index_A];
	    input[index_A] = input[index_B];
	    input[index_B] = temp;
	}

	/*******************************************************************************************************************
	Funciones del objeto Detalle del movimiento bancario
	*********************************************************************************************************************/
	//Constructor del objeto detalle
	var objDetalleMovimientoMovimientosBancariosCuentasPagar;
	function DetalleMovimientoMovimientosBancariosCuentasPagar(cuentaID, cuenta, importe)
	{
	    this.intCuentaID = cuentaID;
	    this.strCuenta = cuenta;
	    this.intImporte = importe;
	}
	

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_movimientos_bancarios_cuentas_pagar()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('cuentas_pagar/movimientos_bancarios/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_movimientos_bancarios_cuentas_pagar').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosMovimientosBancariosCuentasPagar = data.row;
				//Separar la cadena 
				var arrPermisosMovimientosBancariosCuentasPagar = strPermisosMovimientosBancariosCuentasPagar.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosMovimientosBancariosCuentasPagar.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosMovimientosBancariosCuentasPagar[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_movimientos_bancarios_cuentas_pagar').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosMovimientosBancariosCuentasPagar[i]=='GUARDAR') || (arrPermisosMovimientosBancariosCuentasPagar[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_movimientos_bancarios_cuentas_pagar').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosBancariosCuentasPagar[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_movimientos_bancarios_cuentas_pagar').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_movimientos_bancarios_cuentas_pagar();
					}
					else if(arrPermisosMovimientosBancariosCuentasPagar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_movimientos_bancarios_cuentas_pagar').removeAttr('disabled');
						$('#btnRestaurar_movimientos_bancarios_cuentas_pagar').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosBancariosCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_movimientos_bancarios_cuentas_pagar').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosBancariosCuentasPagar[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_movimientos_bancarios_cuentas_pagar').removeAttr('disabled');
					}
					else if(arrPermisosMovimientosBancariosCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_movimientos_bancarios_cuentas_pagar').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_movimientos_bancarios_cuentas_pagar() 
	{
		//Concatenar datos para la nueva búsqueda
		var strNuevaBusquedaMovimientosBancariosCuentasPagar =($('#txtFechaInicialBusq_movimientos_bancarios_cuentas_pagar').val()+$('#txtFechaFinalBusq_movimientos_bancarios_cuentas_pagar').val()+$('#txtProveedorIDBusq_movimientos_bancarios_cuentas_pagar').val()+$('#cmbEstatusBusq_movimientos_bancarios_cuentas_pagar').val()+$('#txtBusqueda_movimientos_bancarios_cuentas_pagar').val());

		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaMovimientosBancariosCuentasPagar != strUltimaBusquedaMovimientosBancariosCuentasPagar)
		{
			intPaginaMovimientosBancariosCuentasPagar = 0;
			strUltimaBusquedaMovimientosBancariosCuentasPagar = strNuevaBusquedaMovimientosBancariosCuentasPagar;
		}
		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('cuentas_pagar/movimientos_bancarios/get_paginacion',
				{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_bancarios_cuentas_pagar').val()),
	    			dteFechaFinal:  $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_bancarios_cuentas_pagar').val()),
	    			intCuentaBancariaID: $('#txtCuentaBancariaIDBusq_movimientos_bancarios_cuentas_pagar').val(),
					strEstatus: $('#cmbEstatusBusq_movimientos_bancarios_cuentas_pagar').val(),
					strBusqueda: $('#txtBusqueda_movimientos_bancarios_cuentas_pagar').val(),
					intPagina:intPaginaMovimientosBancariosCuentasPagar,
					strPermisosAcceso: $('#txtAcciones_movimientos_bancarios_cuentas_pagar').val()
				},
				function(data){
					$('#dg_movimientos_bancarios_cuentas_pagar tbody').empty();
					var tmpMovimientosBancariosCuentasPagar = Mustache.render($('#plantilla_movimientos_bancarios_cuentas_pagar').html(),data);
					$('#dg_movimientos_bancarios_cuentas_pagar tbody').html(tmpMovimientosBancariosCuentasPagar);
					$('#pagLinks_movimientos_bancarios_cuentas_pagar').html(data.paginacion);
					$('#numElementos_movimientos_bancarios_cuentas_pagar').html(data.total_rows);
					intPaginaMovimientosBancariosCuentasPagar = data.pagina;
				},
		'json');
	}

	//Función para cargar el reporte general en PDF
	function reporte_movimientos_bancarios_cuentas_pagar() 
	{
		//Asignar valores para la búsqueda de registros
		intCuentaIDMovimientosBancariosCuentasPagar =  $('#txtCuentaBancariaIDBusq_movimientos_bancarios_cuentas_pagar').val();
		dteFechaInicialMovimientosBancariosCuentasPagar =  $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_bancarios_cuentas_pagar').val());
		dteFechaFinalMovimientosBancariosCuentasPagar =  $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_bancarios_cuentas_pagar').val());

		//Si no existe fecha inicial
		if(dteFechaInicialMovimientosBancariosCuentasPagar == '')
		{
			dteFechaInicialMovimientosBancariosCuentasPagar = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalMovimientosBancariosCuentasPagar == '')
		{
			dteFechaFinalMovimientosBancariosCuentasPagar =  '0000-00-00';
		}
		
		//Si no existe id del proveedor
		if(intCuentaIDMovimientosBancariosCuentasPagar == '')
		{
			intCuentaIDMovimientosBancariosCuentasPagar = 0;
		}


		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_movimientos_bancarios_cuentas_pagar').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_movimientos_bancarios_cuentas_pagar').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_movimientos_bancarios_cuentas_pagar').val('NO');
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("cuentas_pagar/movimientos_bancarios/get_reporte/"
					+dteFechaInicialMovimientosBancariosCuentasPagar+"/"
					+dteFechaFinalMovimientosBancariosCuentasPagar+"/"
					+intCuentaIDMovimientosBancariosCuentasPagar+"/"+
				    $('#cmbEstatusBusq_movimientos_bancarios_cuentas_pagar').val()+"/"+
				    $('#chbImprimirDetalles_movimientos_bancarios_cuentas_pagar').val()+"/"+$('#txtBusqueda_movimientos_bancarios_cuentas_pagar').val());
	}


	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_movimientos_bancarios_cuentas_pagar(id)
	{	

		//Variable que se utiliza para asignar id
		var intMovimientoBancarioID = 0;
		
		//Dependiendo del tipo de formulario asignar id
		if(id == '')
			intMovimientoBancarioID = $('#txtMovimientoBancarioID_movimientos_bancarios_cuentas_pagar').val();
		else
			intMovimientoBancarioID = id;

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("cuentas_pagar/movimientos_bancarios/get_reporte_registro/" + intMovimientoBancarioID);
	}

	//Función para descargar el archivo XLS
	function descargar_xls_movimientos_bancarios_cuentas_pagar() 
	{
		//Asignar valores para la búsqueda de registros
		intCuentaIDMovimientosBancariosCuentasPagar =  $('#txtCuentaBancariaIDBusq_movimientos_bancarios_cuentas_pagar').val();
		dteFechaInicialMovimientosBancariosCuentasPagar =  $.formatFechaMysql($('#txtFechaInicialBusq_movimientos_bancarios_cuentas_pagar').val());
		dteFechaFinalMovimientosBancariosCuentasPagar =  $.formatFechaMysql($('#txtFechaFinalBusq_movimientos_bancarios_cuentas_pagar').val());

		//Si no existe fecha inicial
		if(dteFechaInicialMovimientosBancariosCuentasPagar == '')
		{
			dteFechaInicialMovimientosBancariosCuentasPagar = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalMovimientosBancariosCuentasPagar == '')
		{
			dteFechaFinalMovimientosBancariosCuentasPagar =  '0000-00-00';
		}
		
		//Si no existe id del proveedor
		if(intCuentaIDMovimientosBancariosCuentasPagar == '')
		{
			intCuentaIDMovimientosBancariosCuentasPagar = 0;
		}


		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_movimientos_bancarios_cuentas_pagar').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_movimientos_bancarios_cuentas_pagar').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_movimientos_bancarios_cuentas_pagar').val('NO');
		}

		//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
     	window.open("cuentas_pagar/movimientos_bancarios/get_xls/"
					+dteFechaInicialMovimientosBancariosCuentasPagar+"/"
					+dteFechaFinalMovimientosBancariosCuentasPagar+"/"
					+intCuentaIDMovimientosBancariosCuentasPagar+"/"+
				   $('#cmbEstatusBusq_movimientos_bancarios_cuentas_pagar').val()+"/"+
				   $('#chbImprimirDetalles_movimientos_bancarios_cuentas_pagar').val()+"/"+$('#txtBusqueda_movimientos_bancarios_cuentas_pagar').val());
	}

	//Regresar tipos de movimientos bancarios activos para cargarlas en el combobox
	function cargar_movimientos_bancarios_tipos_movimientos_bancarios_cuentas_pagar()
	{
		//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
		$.post('cuentas_pagar/movimientos_bancarios_tipos/get_combo_box', {},
			function(data)
			{
				$('#cmbMovimientoBancarioTipoID_movimientos_bancarios_cuentas_pagar').empty();
				var temp = Mustache.render($('#movimientos_bancarios_tipos_movimientos_bancarios_cuentas_pagar').html(), data);
				$('#cmbMovimientoBancarioTipoID_movimientos_bancarios_cuentas_pagar').html(temp);
			},
			'json');
	}



	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_movimientos_bancarios_cuentas_pagar(tipoAccion)
	{
		//Incializar formulario
		$('#frmMovimientosBancariosCuentasPagar')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_movimientos_bancarios_cuentas_pagar();
		//Limpiar cajas de texto ocultas
		$('#frmMovimientosBancariosCuentasPagar').find('input[type=hidden]').val('');
		//Eliminar los datos de la tabla detalles del movimiento bancario
	    $('#dg_detalles_movimientos_bancarios_cuentas_pagar tbody').empty();
	    $('#acumImporte_detalles_movimientos_bancarios_cuentas_pagar').html('');
		$('#numElementos_detalles_movimientos_bancarios_cuentas_pagar').html(0);
		//Crear instancia del objeto Detalles del movimiento bancario
		objDetallesMovimientoMovimientosBancariosCuentasPagar = new DetallesMovimientoMovimientosBancariosCuentasPagar([]);
		//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
		$('#divEncabezadoModal_movimientos_bancarios_cuentas_pagar').removeClass("estatus-NUEVO");
		$('#divEncabezadoModal_movimientos_bancarios_cuentas_pagar').removeClass("estatus-ACTIVO");
		$('#divEncabezadoModal_movimientos_bancarios_cuentas_pagar').removeClass("estatus-INACTIVO");
		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo')
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_movimientos_bancarios_cuentas_pagar').addClass("estatus-NUEVO");
		}
		//Habilitar todos los elementos del formulario
		$('#frmMovimientosBancariosCuentasPagar').find('input, textarea, select').removeAttr('disabled','disabled');
		//Deshabilitar las siguientes cajas de texto
		$('#txtFolio_movimientos_bancarios_cuentas_pagar').attr("disabled", "disabled");
		$('#txtTotal_movimientos_bancarios_cuentas_pagar').attr("disabled", "disabled");
		$('#txtMoneda_movimientos_bancarios_cuentas_pagar').attr("disabled", "disabled");
		//Asignar la fecha actual
		$('#txtFecha_movimientos_bancarios_cuentas_pagar').val(fechaActual()); 
		//Mostrar los siguientes botones
		$("#btnGuardar_movimientos_bancarios_cuentas_pagar").show();
		$("#btnReiniciar_movimientos_bancarios_cuentas_pagar").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_movimientos_bancarios_cuentas_pagar").hide();
		$("#btnDesactivar_movimientos_bancarios_cuentas_pagar").hide();
		$("#btnRestaurar_movimientos_bancarios_cuentas_pagar").hide();		
	}

	//Función que se utiliza para cerrar el modal
	function cerrar_movimientos_bancarios_cuentas_pagar()
	{
		try {
			//Cerrar modal
			objMovimientosBancariosCuentasPagar.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_movimientos_bancarios_cuentas_pagar').focus();
		}
		catch(err) {}
	}	

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_movimientos_bancarios_cuentas_pagar()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_movimientos_bancarios_cuentas_pagar();
		//Validación del formulario de campos obligatorios
		$('#frmMovimientosBancariosCuentasPagar')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_movimientos_bancarios_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strCuentaBancaria_movimientos_bancarios_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtCuentaBancariaID_movimientos_bancarios_cuentas_pagar').val() === '')
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
										strTipo_movimientos_bancarios_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										},
										intMovimientoBancarioTipoID_movimientos_bancarios_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo de movimiento bancario'}
											}
										},
										intSubtotal_movimientos_bancarios_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un importe'}
											}
										},
										intPorcentajeIva_movimientos_bancarios_cuentas_pagar: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IVA
					                                    if($('#txtTasaCuotaIva_movimientos_bancarios_cuentas_pagar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una tasa o cuota de IVA existente'
					                                        };
					                                    }

					                                    return true;
					                                  }
					                            }
											}
										},
										strConcepto_movimientos_bancarios_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un concepto'}
											}
										},
									    strObservaciones_movimientos_bancarios_cuentas_pagar: {
									        excluded: true  // Ignorar (no valida el campo)    
									    },
									    intNumDetalles_movimientos_bancarios_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para este movimiento bancario.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
									    strCuenta_detalles_movimientos_bancarios_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intImporte_detalles_movimientos_bancarios_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_movimientos_bancarios_cuentas_pagar = $('#frmMovimientosBancariosCuentasPagar').data('bootstrapValidator');
		bootstrapValidator_movimientos_bancarios_cuentas_pagar.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_movimientos_bancarios_cuentas_pagar.isValid())
		{
			//Hacer un llamado a la función para reemplazar '$' por cadena vacia
			var intAcumImporteDetallesMovimientosBancariosCuentasPagar = $.reemplazar($('#acumImporte_detalles_movimientos_bancarios_cuentas_pagar').html(), "$", "");
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intAcumImporteDetallesMovimientosBancariosCuentasPagar = $.reemplazar(intAcumImporteDetallesMovimientosBancariosCuentasPagar, ",", "");

			var intImporteTotalMovimientosBancariosCuentasPagar = $.reemplazar($('#txtTotal_movimientos_bancarios_cuentas_pagar').val(), ",", "");

			//Convertir cadena de texto a número decimal
			intAcumImporteDetallesMovimientosBancariosCuentasPagar = parseFloat(intAcumImporteDetallesMovimientosBancariosCuentasPagar);

			intImporteTotalMovimientosBancariosCuentasPagar = parseFloat(intImporteTotalMovimientosBancariosCuentasPagar);

			//Verificar que el importe total sea igual al total de detalles
			if(intAcumImporteDetallesMovimientosBancariosCuentasPagar !=intImporteTotalMovimientosBancariosCuentasPagar)
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_movimientos_bancarios_cuentas_pagar('error', 'El importe total no coincide con los detalles, favor de verificar.');
			}
			else
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_movimientos_bancarios_cuentas_pagar();
			}

		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_movimientos_bancarios_cuentas_pagar()
	{
		try
		{
			$('#frmMovimientosBancariosCuentasPagar').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	//Función para guardar o modificar los datos de un registro
	function guardar_movimientos_bancarios_cuentas_pagar()
	{	

		//Hacer un llamado a la función JSON para guardar los detalles del movimiento bancario
		var jsonDetalles = JSON.stringify(objDetallesMovimientoMovimientosBancariosCuentasPagar); 

		//Hacer un llamado al método del controlador para guardar los datos del registro
		$.post('cuentas_pagar/movimientos_bancarios/guardar',
				{ 
					intMovimientoBancarioID: $('#txtMovimientoBancarioID_movimientos_bancarios_cuentas_pagar').val(),
					//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					dteFecha: $.formatFechaMysql($('#txtFecha_movimientos_bancarios_cuentas_pagar').val()),
					strTipo: $('#cmbTipo_movimientos_bancarios_cuentas_pagar').val(),
					intMovimientoBancarioTipoID: $('#cmbMovimientoBancarioTipoID_movimientos_bancarios_cuentas_pagar').val(),
					intCuentaBancariaID: $('#txtCuentaBancariaID_movimientos_bancarios_cuentas_pagar').val(),
					//Hacer un llamado a la función para reemplazar ',' por cadena vacia
					intSubtotal: $.reemplazar($('#txtSubtotal_movimientos_bancarios_cuentas_pagar').val(), ",", ""),
					intTasaCuotaIva: $('#txtTasaCuotaIva_movimientos_bancarios_cuentas_pagar').val(),
					intIva: $('#txtIva_movimientos_bancarios_cuentas_pagar').val(),
					strConcepto: $('#txtConcepto_movimientos_bancarios_cuentas_pagar').val(),
					strObservaciones: $('#txtObservaciones_movimientos_bancarios_cuentas_pagar').val(),
					intProcesoMenuID: $('#txtProcesoMenuID_movimientos_bancarios_cuentas_pagar').val(),
					//Datos de los detalles
					arrDetalles: jsonDetalles
				},
				function(data) {
					if (data.resultado)
					{	
	                    //Hacer un llamado a la función para cerrar modal e inicializar objeto bootstrapValidator
	                    cerrar_movimientos_bancarios_cuentas_pagar();
	                    //Hacer llamado a la función  para cargar  los registros en el grid
		               	paginacion_movimientos_bancarios_cuentas_pagar();	    
					}

					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_movimientos_bancarios_cuentas_pagar(data.tipo_mensaje, data.mensaje);

				},
		'json');
		
	}


	//Función para mostrar mensaje de éxito o error
	function mensaje_movimientos_bancarios_cuentas_pagar(tipoMensaje, mensaje)
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
	function cambiar_estatus_movimientos_bancarios_cuentas_pagar(id, estatus)
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtMovimientoBancarioID_movimientos_bancarios_cuentas_pagar').val();

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
					              'title':    'Movimientos Bancarios',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('cuentas_pagar/movimientos_bancarios/set_estatus',
					                                     {
					                                     	intMovimientoBancarioID: intID,
					                                      	strEstatus: estatus
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                            //Hacer llamado a la función  para cargar  los registros en el grid
					                                            paginacion_movimientos_bancarios_cuentas_pagar();

					                                            //Si el id del registro se obtuvo del modal
															    if(id == '')
															    {
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_movimientos_bancarios_cuentas_pagar();     
															    }
		 
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_movimientos_bancarios_cuentas_pagar(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });
	    }
	    else//Si el estatus del registro es INACTIVO
	    {
			//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
			$.post('cuentas_pagar/movimientos_bancarios/set_estatus',
			     {
			     	intMovimientoBancarioID: intID,
			      	strEstatus: estatus
			     },
			     function(data) {
			      if (data.resultado)
			      {
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_movimientos_bancarios_cuentas_pagar();
			      		//Si el id del registro se obtuvo del modal
						if(id == '')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_movimientos_bancarios_cuentas_pagar();     
						}
			      }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_movimientos_bancarios_cuentas_pagar(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
	    }
	   
	}

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_movimientos_bancarios_cuentas_pagar(id)
	{	
	   //Hacer un llamado al método del controlador para regresar los datos del registro
	   $.post('cuentas_pagar/movimientos_bancarios/get_datos',
       {
       		intMovimientoBancarioID:id
       },
       function(data) {

       		//Si hay datos del registro
		    if(data.row)
		    {
		    	//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_movimientos_bancarios_cuentas_pagar('');
				//Asignar estatus del registro
				var strEstatus = data.row.estatus;
				//Variable que se utiliza para asignar las acciones del grid view
				var strAccionesTabla = '';

				//Recuperar valores
	            $('#txtMovimientoBancarioID_movimientos_bancarios_cuentas_pagar').val(data.row.movimiento_bancario_id);
	            $('#txtFolio_movimientos_bancarios_cuentas_pagar').val(data.row.folio);
	            $('#txtFecha_movimientos_bancarios_cuentas_pagar').val(data.row.fecha);
	            $('#cmbTipo_movimientos_bancarios_cuentas_pagar').val(data.row.tipo);
	            $('#cmbMovimientoBancarioTipoID_movimientos_bancarios_cuentas_pagar').val(data.row.movimiento_bancario_tipo_id);
	            $('#txtCuentaBancariaID_movimientos_bancarios_cuentas_pagar').val(data.row.cuenta_bancaria_id);
	            $('#txtCuentaBancaria_movimientos_bancarios_cuentas_pagar').val(data.row.cuenta_bancaria);
	            $('#txtMoneda_movimientos_bancarios_cuentas_pagar').val(data.row.moneda);
	            $('#txtSubtotal_movimientos_bancarios_cuentas_pagar').val(data.row.subtotal);
	            $('#txtTasaCuotaIva_movimientos_bancarios_cuentas_pagar').val(data.row.tasa_cuota_iva);
	            $('#txtPorcentajeIva_movimientos_bancarios_cuentas_pagar').val(data.row.porcentaje_iva);
	            //Hacer un llamado a la función para calcular el importe total del anticipo
				calcular_total_movimientos_bancarios_cuentas_pagar();
				//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
			    $('#txtSubtotal_movimientos_bancarios_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 2 });
	            $('#txtConcepto_movimientos_bancarios_cuentas_pagar').val(data.row.concepto);
	            $('#txtObservaciones_movimientos_bancarios_cuentas_pagar').val(data.row.observaciones);    
	            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
	            $('#divEncabezadoModal_movimientos_bancarios_cuentas_pagar').addClass("estatus-" + strEstatus);
	            //Mostrar botón Imprimir  
	            $("#btnImprimirRegistro_movimientos_bancarios_cuentas_pagar").show();
	           	
				//Si el estatus del registro es INACTIVO
	            if(strEstatus == 'INACTIVO')
	            {
	            	//Deshabilitar todos los elementos del formulario
	            	$('#frmMovimientosBancariosCuentasPagar').find('input, textarea, select').attr('disabled','disabled');
	            	//Ocultar los siguientes botones
		            $("#btnGuardar_movimientos_bancarios_cuentas_pagar").hide();
		            $("#btnReiniciar_movimientos_bancarios_cuentas_pagar").hide();
	            	//Mostrar botón Restaurar
	            	$("#btnRestaurar_movimientos_bancarios_cuentas_pagar").show();

	            }
	            else
	            {
	            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
									   " onclick='editar_renglon_detalles_movimientos_bancarios_cuentas_pagar(this)'>" + 
									   "<span class='glyphicon glyphicon-edit'></span></button>" + 
									   "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_detalles_movimientos_bancarios_cuentas_pagar(this)'>" + 
									   "<span class='glyphicon glyphicon-trash'></span></button>" + 
									   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
									   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
									   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
									   "<span class='glyphicon glyphicon-arrow-down'></span></button>";

		            //Mostrar los siguientes botones  
		            $("#btnDesactivar_movimientos_bancarios_cuentas_pagar").show();
		          
	            }


	            //Mostramos los detalles del registro
	           	for (var intCon in data.detalles) 
	            {
	            	//Variable que se utiliza para asignar el renglón del detalle
				    var intRenglon = data.detalles[intCon].renglon;
				    //Variable que se utiliza para concatenar los datos de la cuenta
					var strCuenta = data.detalles[intCon].cuenta+' - '+data.detalles[intCon].cuenta_descripcion;
					//Variable que se utiliza para asignar el importe
					var intImporte = data.detalles[intCon].importe;

				    //Crear instancia del objeto Detalle del movimiento bancario
					objDetalleMovimientoMovimientosBancariosCuentasPagar = new DetalleMovimientoMovimientosBancariosCuentasPagar(null, '', '');

					//Asignar valores al objeto
					objDetalleMovimientoMovimientosBancariosCuentasPagar.intCuentaID = data.detalles[intCon].cuenta_id;
					objDetalleMovimientoMovimientosBancariosCuentasPagar.strCuenta =  strCuenta;
					objDetalleMovimientoMovimientosBancariosCuentasPagar.intImporte = intImporte;
					//Agregar datos del detalle del movimiento bancario
				    objDetallesMovimientoMovimientosBancariosCuentasPagar.setDetalle(objDetalleMovimientoMovimientosBancariosCuentasPagar);

				    //Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_detalles_movimientos_bancarios_cuentas_pagar').getElementsByTagName('tbody')[0];
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCuenta = objRenglon.insertCell(0);
					var objCeldaImporte = objRenglon.insertCell(1);
					var objCeldaAcciones = objRenglon.insertCell(2);
					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRenglon);
					objCeldaCuenta.setAttribute('class', 'movil b1');
					objCeldaCuenta.innerHTML = objDetalleMovimientoMovimientosBancariosCuentasPagar.strCuenta;
					objCeldaImporte.setAttribute('class', 'movil b2');
					objCeldaImporte.innerHTML =  formatMoney(intImporte, 5, '');
					objCeldaAcciones.setAttribute('class', 'td-center movil b3');
					objCeldaAcciones.innerHTML = strAccionesTabla;
	            }

	            //Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_movimientos_bancarios_cuentas_pagar();
				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $("#dg_detalles_movimientos_bancarios_cuentas_pagar tr").length - 2;
				$('#numElementos_detalles_movimientos_bancarios_cuentas_pagar').html(intFilas);
				$('#txtNumDetalles_movimientos_bancarios_cuentas_pagar').val(intFilas);


	            //Abrir modal
				objMovimientosBancariosCuentasPagar = $('#MovimientosBancariosCuentasPagarBox').bPopup({
											   appendTo: '#MovimientosBancariosCuentasPagarContent', 
				                               contentContainer: 'MovimientosBancariosCuentasPagarM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

	            //Enfocar caja de texto
			    $('#cmbTipo_movimientos_bancarios_cuentas_pagar').focus();
		    }

       });
	}

	//Función que se utiliza para calcular el importe total del ajuste bancario
	function calcular_total_movimientos_bancarios_cuentas_pagar()
	{
		//Variable que se utiliza para asignar el subtotal
		var intSubtotal= 0;
		//Variable que se utiliza para asignar el importe de iva
		var intImporteIva = 0;
		//Variable que se utiliza para asignar el importe total
		var intTotal = 0;

		//Obtenemos los datos de las cajas de texto
		var intPorcentajeIva = $('#txtPorcentajeIva_movimientos_bancarios_cuentas_pagar').val();
		var intPorcentajeIeps = $('#txtPorcentajeIeps_movimientos_bancarios_cuentas_pagar').val();

     	//Verificar que exista importe de subtotal
		if($('#txtSubtotal_movimientos_bancarios_cuentas_pagar').val() != '')
		{ 
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intSubtotal = parseFloat($.reemplazar($("#txtSubtotal_movimientos_bancarios_cuentas_pagar").val(), ",", ""));

			//Si existe porcentaje de IVA
			if(intPorcentajeIva != '')
			{
				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
			}
		}

		//Calcular importe total
		intTotal = (intSubtotal + intImporteIva);

		//Cambiar cantidad a formato moneda
		intTotal = formatMoney(intTotal, 2, '');
		//Asignar importe total 
		$('#txtTotal_movimientos_bancarios_cuentas_pagar').val(intTotal);
		$('#txtIva_movimientos_bancarios_cuentas_pagar').val(intImporteIva);
	}


	/*******************************************************************************************************************
	Funciones de la tabla detalles
	*********************************************************************************************************************/
	//Función para agregar renglón a la tabla
	function agregar_renglon_detalles_movimientos_bancarios_cuentas_pagar()
	{

		//Obtenemos los datos de las cajas de texto
		var intRenglon = $('#txtRenglon_detalles_movimientos_bancarios_cuentas_pagar').val();
		var intCuentaID = $('#txtCuentaID_detalles_movimientos_bancarios_cuentas_pagar').val();
		var strCuenta = $('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').val();
		var intImporte = $('#txtImporte_detalles_movimientos_bancarios_cuentas_pagar').val();

		//Obtenemos el objeto de la tabla
		var objTabla = document.getElementById('dg_detalles_movimientos_bancarios_cuentas_pagar').getElementsByTagName('tbody')[0];

		//Validamos que se capturaron datos
		if (intCuentaID == '' || strCuenta == '')
		{
			//Enfocar caja de texto
			$('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').focus();
		}
		else if (intImporte == '')
		{
			//Enfocar caja de texto
			$('#txtImporte_detalles_movimientos_bancarios_cuentas_pagar').focus();
		}
		else
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_detalles_movimientos_bancarios_cuentas_pagar').val('');
			$('#txtCuentaID_detalles_movimientos_bancarios_cuentas_pagar').val('');
			$('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').val('');
			$('#txtImporte_detalles_movimientos_bancarios_cuentas_pagar').val('');

		    //Crear instancia del objeto Detalle del movimiento bancario
			objDetalleMovimientoMovimientosBancariosCuentasPagar = new DetalleMovimientoMovimientosBancariosCuentasPagar(null, '', 
																														 '');

			//Convertir cadena de texto a número decimal
			intImporte = parseFloat($.reemplazar(intImporte, ",", ""));

			//Asignar valores al objeto
			objDetalleMovimientoMovimientosBancariosCuentasPagar.intCuentaID = intCuentaID;
			objDetalleMovimientoMovimientosBancariosCuentasPagar.strCuenta = strCuenta;
			objDetalleMovimientoMovimientosBancariosCuentasPagar.intImporte = intImporte;

			//Convertir cantidad a formato moneda
			intImporte = formatMoney(intImporte, 5, '');
				
			//Revisamos si existe el renglón, si es así, editamos los datos del detalle
			if (intRenglon)
			{
				//Modificar los datos del detalle corespondiente al indice
	        	objDetallesMovimientoMovimientosBancariosCuentasPagar.modificarDetalle(intRenglon, objDetalleMovimientoMovimientosBancariosCuentasPagar);

	        	//Incrementar renglón para obtener la posición del detalle en la tabla
				intRenglon++;
				
				//Seleccionar el renglón de la tabla para actualizar los datos del detalle
				var selectedRow = document.getElementById("dg_detalles_movimientos_bancarios_cuentas_pagar").rows[intRenglon].cells;
				selectedRow[0].innerHTML = objDetalleMovimientoMovimientosBancariosCuentasPagar.strCuenta;
				selectedRow[1].innerHTML = intImporte;
			}
			else
			{

				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				intRenglon = $("#dg_detalles_movimientos_bancarios_cuentas_pagar tr").length - 2;
				//Incrementar 1 para el siguiente renglón
				intRenglon++;
					
				//Agregar datos del detalle del movimiento bancario
           		objDetallesMovimientoMovimientosBancariosCuentasPagar.setDetalle(objDetalleMovimientoMovimientosBancariosCuentasPagar);

				//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaCuenta = objRenglon.insertCell(0);
				var objCeldaImporte = objRenglon.insertCell(1);
				var objCeldaAcciones = objRenglon.insertCell(2);
				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', intRenglon);
				objCeldaCuenta.setAttribute('class', 'movil b1');
				objCeldaCuenta.innerHTML = objDetalleMovimientoMovimientosBancariosCuentasPagar.strCuenta;
				objCeldaImporte.setAttribute('class', 'movil b2');
				objCeldaImporte.innerHTML =  intImporte;
				objCeldaAcciones.setAttribute('class', 'td-center movil b10');
				objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalles_movimientos_bancarios_cuentas_pagar(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_detalles_movimientos_bancarios_cuentas_pagar(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

			}

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_movimientos_bancarios_cuentas_pagar();
			//Enfocar caja de texto
			$('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').focus();
		}
				                                   		

		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_detalles_movimientos_bancarios_cuentas_pagar tr").length - 2;
		$('#numElementos_detalles_movimientos_bancarios_cuentas_pagar').html(intFilas);
		$('#txtNumDetalles_movimientos_bancarios_cuentas_pagar').val(intFilas);
				                                    
	}	


	//Función para regresar los datos (al formulario) del renglón seleccionado
	function editar_renglon_detalles_movimientos_bancarios_cuentas_pagar(objRenglon)
	{
		//Decrementar indice para obtener la posición del detalle en el arreglo
		var intRenglon =  parseInt(objRenglon.parentNode.parentNode.rowIndex) - 1;

		//Crear instancia del objeto Detalle del movimiento bancario
        objDetalleMovimientoMovimientosBancariosCuentasPagar = new DetalleMovimientoMovimientosBancariosCuentasPagar();

        //Asignar datos del detalle corespondiente al indice
        objDetalleMovimientoMovimientosBancariosCuentasPagar = objDetallesMovimientoMovimientosBancariosCuentasPagar.getDetalle(intRenglon);

        //Asignar los valores a las cajas de texto
	    $('#txtRenglon_detalles_movimientos_bancarios_cuentas_pagar').val(intRenglon);
	    $('#txtCuentaID_detalles_movimientos_bancarios_cuentas_pagar').val(objDetalleMovimientoMovimientosBancariosCuentasPagar.intCuentaID);
		$('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').val(objDetalleMovimientoMovimientosBancariosCuentasPagar.strCuenta);
		$('#txtImporte_detalles_movimientos_bancarios_cuentas_pagar').val(objDetalleMovimientoMovimientosBancariosCuentasPagar.intImporte);
		//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
		$('#txtImporte_detalles_movimientos_bancarios_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 5 });

		//Enfocar caja de texto
		$('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').focus();	
	}

	//Función para quitar renglón de la tabla
	function eliminar_renglon_detalles_movimientos_bancarios_cuentas_pagar(objRenglon)
	{
		//Obtener el indice del objeto renglón que se envía
		var intRenglon = objRenglon.parentNode.parentNode.rowIndex;

		//Eliminar del objeto el detalle seleccionado
		objDetallesMovimientoMovimientosBancariosCuentasPagar.eliminarDetalle(intRenglon - 1);

		//Eliminar el renglón indicado
		document.getElementById("dg_detalles_movimientos_bancarios_cuentas_pagar").deleteRow(intRenglon);

		//Hacer un llamado a la función para calcular totales de la tabla
		calcular_totales_detalles_movimientos_bancarios_cuentas_pagar();
		
		//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
		var intFilas = $("#dg_detalles_movimientos_bancarios_cuentas_pagar tr").length - 2;
		$('#numElementos_detalles_movimientos_bancarios_cuentas_pagar').html(intFilas);
		$('#txtNumDetalles_movimientos_bancarios_cuentas_pagar').val(intFilas);

		//Enfocar combobox
		$('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').focus();
	}

	//Función para calcular totales de la tabla
	function calcular_totales_detalles_movimientos_bancarios_cuentas_pagar()
	{
		//Obtenemos el objeto de la tabla 
		var objTabla = document.getElementById('dg_detalles_movimientos_bancarios_cuentas_pagar').getElementsByTagName('tbody')[0];

		//Inicializamos las variables que se utilizan para los acumulados
		var intAcumImporte = 0;

		//Recorrer los renglones de la tabla para obtener los valores
		for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
		{
			//Incrementar acumulados
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intAcumImporte += parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
		}

		//Convertir cantidad a formato moneda
		intAcumImporte =  '$'+formatMoney(intAcumImporte, 5, '');

		//Asignar los valores
		$('#acumImporte_detalles_movimientos_bancarios_cuentas_pagar').html(intAcumImporte);
	}


	//Controles o Eventos del Modal
	$(document).ready(function() 
	{
		/*******************************************************************************************************************
		Controles correspondientes al modal
		*********************************************************************************************************************/
		//Validar campos decimales (no hay necesidad de poner '.')
		$('#txtPorcentajeIva_movimientos_bancarios_cuentas_pagar').numeric();
		$('#txtSubtotal_movimientos_bancarios_cuentas_pagar').numeric();
    	$('#txtTotal_movimientos_bancarios_cuentas_pagar').numeric();
    	$('#txtImporte_detalles_movimientos_bancarios_cuentas_pagar').numeric();

		//Agregar datepicker para seleccionar fecha
		$('#dteFecha_movimientos_bancarios_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFecha_movimientos_bancarios_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

		/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        * por ejemplo: 1800 será 1,800.00*/
    	$('.moneda_movimientos_bancarios_cuentas_pagar').blur(function(){
			$('.moneda_movimientos_bancarios_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 2 });
		});

		$('.moneda_detalles_movimientos_bancarios_cuentas_pagar').blur(function(){
			$('.moneda_detalles_movimientos_bancarios_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 5 });
		});

	    //Autocomplete para recuperar los datos de una cuenta bancaria 
        $('#txtCuentaBancaria_movimientos_bancarios_cuentas_pagar').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtCuentaBancariaID_movimientos_bancarios_cuentas_pagar').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "cuentas_pagar/cuentas_bancarias/autocomplete",
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
             $('#txtCuentaBancariaID_movimientos_bancarios_cuentas_pagar').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('cuentas_pagar/cuentas_bancarias/get_datos',
                  { 
                  	strBusqueda:$('#txtCuentaBancariaID_movimientos_bancarios_cuentas_pagar').val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                        //Asignar datos del registro seleccionado
                        $("#txtMovimientoBancarioTipoID_movimientos_bancarios_cuentas_pagar").val(data.row.moneda_id);
                        $("#txtMoneda_movimientos_bancarios_cuentas_pagar").val(data.row.moneda);
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
        
      	//Verificar que exista id de la cuenta bancaria cuando pierda el enfoque la caja de texto
        $('#txtCuentaBancaria_movimientos_bancarios_cuentas_pagar').focusout(function(e){
            //Si no existe id de la cuenta bancaria
            if($('#txtCuentaBancariaID_movimientos_bancarios_cuentas_pagar').val() == '' ||
               $('#txtCuentaBancaria_movimientos_bancarios_cuentas_pagar').val() == '')
            { 
                //Limpiar contenido de las siguientes cajas de texto
                $('#txtCuentaBancariaID_movimientos_bancarios_cuentas_pagar').val('');
                $('#txtCuentaBancaria_movimientos_bancarios_cuentas_pagar').val('');
                $('#txtMovimientoBancarioTipoID_movimientos_bancarios_cuentas_pagar').val('');
                $('#txtMoneda_movimientos_bancarios_cuentas_pagar').val('');
            }
            
        });


        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
        $('#txtPorcentajeIva_movimientos_bancarios_cuentas_pagar').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtTasaCuotaIva_movimientos_bancarios_cuentas_pagar').val('');
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
             $('#txtTasaCuotaIva_movimientos_bancarios_cuentas_pagar').val(ui.item.data);
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
        $('#txtPorcentajeIva_movimientos_bancarios_cuentas_pagar').focusout(function(e){
            //Si no existe id de la tasa o cuota
            if($('#txtTasaCuotaIva_movimientos_bancarios_cuentas_pagar').val() == '' ||
               $('#txtPorcentajeIva_movimientos_bancarios_cuentas_pagar').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtTasaCuotaIva_movimientos_bancarios_cuentas_pagar').val('');
               $('#txtPorcentajeIva_movimientos_bancarios_cuentas_pagar').val('');
            }
            
        });

        //Calcular el importe total del ajuste bancario cuando pierda el enfoque la caja de texto
		$('#txtSubtotal_movimientos_bancarios_cuentas_pagar').focusout(function(e){
			//Hacer un llamado a la función para calcular el importe total del ajuste bancario
			calcular_total_movimientos_bancarios_cuentas_pagar();
		});

		//Calcular el importe total del ajuste bancario cuando pierda el enfoque la caja de texto
		$('#txtPorcentajeIva_movimientos_bancarios_cuentas_pagar').focusout(function(e){
			//Hacer un llamado a la función para calcular el importe total del ajuste bancario
			calcular_total_movimientos_bancarios_cuentas_pagar();
		});


		 //Función para mover renglones arriba y abajo en la tabla
		$('#dg_detalles_movimientos_bancarios_cuentas_pagar').on('click','button.btn',function(){
			//Asignar renglón mas cercano
            var row = $(this).closest('tr');
            //Bajar renglón
            if ($(this).hasClass('btn-default btn-xs down'))
            {
            	//Verifica que no sea el último elemento del grid
            	if( row.next().index() != -1 )
            	{ 
            		objDetallesMovimientoMovimientosBancariosCuentasPagar.swap(row.index(), row.next().index() );
            	}	

            	//Pasar al siguiente renglón
            	row.next().after(row);
            }
            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
            {
            	//Verifica que no sea el primer elemento del grid
            	if( row.prev().index() != -1 )
            	{ 
            		objDetallesMovimientoMovimientosBancariosCuentasPagar.swap(row.prev().index(), row.index() );
            	}
            	//Pasar al renglón de arriba
            	row.prev().before(row);
            }
			
        });

		//Autocomplete para recuperar los datos de una cuenta
        $('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtCuentaID_detalles_movimientos_bancarios_cuentas_pagar').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "contabilidad/catalogo_cuentas/autocomplete",
                 type: "post",
                 dataType: "json",
                 data: {
                   strDescripcion: request.term, 
                   strTipo: 'movimientos_bancarios'
                 },
                 success: function( data ) {
                   response( data );
                 }
               });
           },
           select: function( event, ui ) {
             //Asignar id del registro seleccionado
             $('#txtCuentaID_detalles_movimientos_bancarios_cuentas_pagar').val(ui.item.data);
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
        $('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').focusout(function(e){
        	//Si no existe id de la cuenta
            if($('#txtCuentaID_detalles_movimientos_bancarios_cuentas_pagar').val() == '' ||
               $('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtCuentaID_detalles_movimientos_bancarios_cuentas_pagar').val('');
               $('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').val('');
            }
            
        });

        //Validar que exista cuenta cuando se pulse la tecla enter 
		$('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	         	//Si no existe cuenta
	            if($('#txtCuentaID_detalles_movimientos_bancarios_cuentas_pagar').val() == '' || $('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').val() == '')
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtCuenta_detalles_movimientos_bancarios_cuentas_pagar').focus();
		   	    }
		   	    else
		   	    {
		   	    	//Enfocar caja de texto
				    $('#txtImporte_detalles_movimientos_bancarios_cuentas_pagar').focus();
		   	    }
	        }
	    });


		//Validar que exista importe cuando se pulse la tecla enter 
		$('#txtImporte_detalles_movimientos_bancarios_cuentas_pagar').on('keypress', function (e) {
	        if(e.which === 13 )
	        {
	            //Si no existe importe
	           if($('#txtImporte_detalles_movimientos_bancarios_cuentas_pagar').val() == '')
		   	    {
		   	   		//Enfocar caja de texto
				    $('#txtImporte_detalles_movimientos_bancarios_cuentas_pagar').focus();
		   	    }
		   	    else
		   	    {
		   	   		//Hacer un llamado a la función para agregar renglón a la tabla
	    			agregar_renglon_detalles_movimientos_bancarios_cuentas_pagar();
		   	    }
	        }
	    });

		
		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_movimientos_bancarios_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_movimientos_bancarios_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_movimientos_bancarios_cuentas_pagar').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_movimientos_bancarios_cuentas_pagar').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_movimientos_bancarios_cuentas_pagar').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_movimientos_bancarios_cuentas_pagar').data('DateTimePicker').maxDate(e.date);
		});


		//Autocomplete para recuperar los datos de un evento 
        $('#txtCuentaBancariaBusq_movimientos_bancarios_cuentas_pagar').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtCuentaBancariaIDBusq_movimientos_bancarios_cuentas_pagar').val('');
               $.ajax({
                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                 url: "cuentas_pagar/cuentas_bancarias/autocomplete",
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
             	$('#txtCuentaBancariaIDBusq_movimientos_bancarios_cuentas_pagar').val(ui.item.data);
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
        $('#txtCuentaBancariaBusq_movimientos_bancarios_cuentas_pagar').focusout(function(e){
            //Si no existe id de la cuenta bancaria
            if($('#txtCuentaBancariaIDBusq_movimientos_bancarios_cuentas_pagar').val() == '' ||
               $('#txtCuentaBancariaBusq_movimientos_bancarios_cuentas_pagar').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtCuentaBancariaIDBusq_movimientos_bancarios_cuentas_pagar').val('');
               $('#txtCuentaBancariaBusq_movimientos_bancarios_cuentas_pagar').val('');
            }

        });
        

        //Paginación de registros
		$('#pagLinks_movimientos_bancarios_cuentas_pagar').on('click','a',function(event){
			event.preventDefault();
			intPaginaMovimientosBancariosCuentasPagar = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_movimientos_bancarios_cuentas_pagar();
		});


        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_movimientos_bancarios_cuentas_pagar').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_movimientos_bancarios_cuentas_pagar('Nuevo');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_movimientos_bancarios_cuentas_pagar').addClass("estatus-NUEVO");
			//Abrir modal
			 objMovimientosBancariosCuentasPagar = $('#MovimientosBancariosCuentasPagarBox').bPopup({
										   appendTo: '#MovimientosBancariosCuentasPagarContent', 
			                               contentContainer: 'MovimientosBancariosCuentasPagarM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#cmbTipo_movimientos_bancarios_cuentas_pagar').focus();
		});


		//Enfocar caja de texto
		$('#txtBusqueda_movimientos_bancarios_cuentas_pagar').focus(); 	
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_movimientos_bancarios_cuentas_pagar();
		//Hacer un llamado a la función para cargar tipos de movimientos bancarios en el combobox del modal
        cargar_movimientos_bancarios_tipos_movimientos_bancarios_cuentas_pagar();

	});

</script>				