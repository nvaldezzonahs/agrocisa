	<div id="AnticiposNoFiscalesCajaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_anticipos_no_fiscales_caja" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_anticipos_no_fiscales_caja" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_anticipos_no_fiscales_caja">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_anticipos_no_fiscales_caja'>
				                    <input class="form-control" id="txtFechaInicialBusq_anticipos_no_fiscales_caja"
				                    		name= "strFechaInicialBusq_anticipos_no_fiscales_caja" 
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
								<label for="txtFechaFinalBusq_anticipos_no_fiscales_caja">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_anticipos_no_fiscales_caja'>
				                    <input class="form-control" id="txtFechaFinalBusq_anticipos_no_fiscales_caja"
				                    		name= "strFechaFinalBusq_anticipos_no_fiscales_caja" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los clientes activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
								<input id="txtProspectoIDBusq_anticipos_no_fiscales_caja" 
									   name="intProspectoIDBusq_anticipos_no_fiscales_caja"  type="hidden" 
									   value="">
								</input>
								<label for="txtRazonSocialBusq_anticipos_no_fiscales_caja">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocialBusq_anticipos_no_fiscales_caja" 
										name="strRazonSocialBusq_anticipos_no_fiscales_caja" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_anticipos_no_fiscales_caja">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_anticipos_no_fiscales_caja" 
								 		name="strEstatusBusq_anticipos_no_fiscales_caja" tabindex="1">
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
					<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_anticipos_no_fiscales_caja">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_anticipos_no_fiscales_caja" 
										name="strBusqueda_anticipos_no_fiscales_caja" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_anticipos_no_fiscales_caja"
									onclick="paginacion_anticipos_no_fiscales_caja();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_anticipos_no_fiscales_caja" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_anticipos_no_fiscales_caja"
									onclick="reporte_anticipos_no_fiscales_caja('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_anticipos_no_fiscales_caja"
									onclick="reporte_anticipos_no_fiscales_caja('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla anticipos no fiscales
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Razón social"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "RFC"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Concepto"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Importe"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Estatus"; font-weight: bold;}
				td.movil.a8:nth-of-type(8):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_anticipos_no_fiscales_caja">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Razón social</th>
							<th class="movil">RFC</th>
							<th class="movil">Concepto</th>
							<th class="movil">Importe</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_anticipos_no_fiscales_caja" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{razon_social}}</td>
							<td class="movil a4">{{rfc}}</td>
							<td class="movil a5">{{concepto}}</td>
							<td class="movil a6">{{total}}</td>
							<td class="movil a7">{{estatus}}</td>
							<td class="td-center movil a8"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_anticipos_no_fiscales_caja({{anticipo_no_fiscal_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_anticipos_no_fiscales_caja({{anticipo_no_fiscal_id}}, 'Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_anticipos_no_fiscales_caja({{anticipo_no_fiscal_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_anticipos_no_fiscales_caja({{anticipo_no_fiscal_id}}, 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_anticipos_no_fiscales_caja({{anticipo_no_fiscal_id}}, {{poliza_id}},  '{{folio_poliza}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="7"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_anticipos_no_fiscales_caja"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_anticipos_no_fiscales_caja">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_anticipos_no_fiscales_caja" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 	

		<!-- Diseño del modal Anticipos No Fiscales-->
		<div id="AnticiposNoFiscalesCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_anticipos_no_fiscales_caja"  class="ModalBodyTitle">
			<h1>Recibo Interno de Anticipo</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAnticiposNoFiscalesCaja" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmAnticiposNoFiscalesCaja"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtAnticipoNoFiscalID_anticipos_no_fiscales_caja" 
										   name="intAnticipoNoFiscalID_anticipos_no_fiscales_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
									<input id="txtEstatus_anticipos_no_fiscales_caja" 
										   name="strEstatus_anticipos_no_fiscales_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_anticipos_no_fiscales_caja" 
										   name="intPolizaID_anticipos_no_fiscales_caja" type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
                                    <input id="txtFolioPoliza_anticipos_no_fiscales_caja" 
                                           name="strFolioPoliza_anticipos_no_fiscales_caja" type="hidden" value="" />
									<label for="txtFolio_anticipos_no_fiscales_caja">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_anticipos_no_fiscales_caja" 
											name="strFolio_anticipos_no_fiscales_caja" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_anticipos_no_fiscales_caja">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_anticipos_no_fiscales_caja'>
					                    <input class="form-control" id="txtFecha_anticipos_no_fiscales_caja"
					                    		name= "strFecha_anticipos_no_fiscales_caja" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
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
									<label for="cmbMonedaID_anticipos_no_fiscales_caja">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbMonedaID_anticipos_no_fiscales_caja" 
									 		name="intMonedaID_anticipos_no_fiscales_caja" 
									 		tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_anticipos_no_fiscales_caja">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_anticipos_no_fiscales_caja" 
											id="txtTipoCambio_anticipos_no_fiscales_caja" 
											name="intTipoCambio_anticipos_no_fiscales_caja" 
											type="text" value="" tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11"/>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene los clientes activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
									<input id="txtProspectoID_anticipos_no_fiscales_caja" 
										   name="intProspectoID_anticipos_no_fiscales_caja"  type="hidden" value="">
									</input>						
									<!-- Caja de texto oculta para recuperar la calle del cliente seleccionado-->
									<input id="txtCalle_anticipos_no_fiscales_caja" 
										   name="strCalle_anticipos_no_fiscales_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el número exterior del cliente seleccionado-->
									<input id="txtNumeroExterior_anticipos_no_fiscales_caja" 
										   name="strNumeroExterior_anticipos_no_fiscales_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el número interior del cliente seleccionado-->
									<input id="txtNumeroInterior_anticipos_no_fiscales_caja" 
										   name="strNumeroInterior_anticipos_no_fiscales_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el código postal del cliente seleccionado-->
									<input id="txtCodigoPostal_anticipos_no_fiscales_caja" 
										   name="strCodigoPostal_anticipos_no_fiscales_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar la colonia del cliente seleccionado-->
									<input id="txtColonia_anticipos_no_fiscales_caja" 
										   name="strColonia_anticipos_no_fiscales_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar la localidad del cliente seleccionado-->
									<input id="txtLocalidad_anticipos_no_fiscales_caja" 
										   name="strLocalidad_anticipos_no_fiscales_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el municipio del cliente seleccionado-->
									<input id="txtMunicipio_anticipos_no_fiscales_caja" 
										   name="strMunicipio_anticipos_no_fiscales_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el estado del cliente seleccionado-->
									<input id="txtEstado_anticipos_no_fiscales_caja" 
										   name="strEstado_anticipos_no_fiscales_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el país del cliente seleccionado-->
									<input id="txtPais_anticipos_no_fiscales_caja" 
										   name="strPais_anticipos_no_fiscales_caja" type="hidden" value="">
									</input>
									<label for="txtRazonSocial_anticipos_no_fiscales_caja">Razón social</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_anticipos_no_fiscales_caja" 
											name="strRazonSocial_anticipos_no_fiscales_caja" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--RFC-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtRfc_anticipos_no_fiscales_caja">RFC</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtRfc_anticipos_no_fiscales_caja"
										   name="strRfc_anticipos_no_fiscales_caja" 
										   type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
					</div>							
				    <div class="row">
						<!--Autocomplete que contiene las formas de pago activas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id de la forma de pago seleccionada-->
									<input id="txtFormaPagoID_anticipos_no_fiscales_caja" 
										   name="intFormaPagoID_anticipos_no_fiscales_caja" 
										   type="hidden" value="">
									</input>
									<label for="txtFormaPago_anticipos_no_fiscales_caja">
										Forma de pago
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFormaPago_anticipos_no_fiscales_caja" 
											name="strFormaPago_anticipos_no_fiscales_caja" type="text" value=""  
											tabindex="1" placeholder="Ingrese forma de pago" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Combobox que contiene las cuentas bancarias activas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCuentaBancariaID_anticipos_no_fiscales_caja">Cuenta bancaria</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbCuentaBancariaID_anticipos_no_fiscales_caja" 
									 		name="intCuentaBancariaID_anticipos_no_fiscales_caja" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
					</div>
				    <div class="row">
				    	<!--Observaciones-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_anticipos_no_fiscales_caja">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_anticipos_no_fiscales_caja" 
											name="strObservaciones_anticipos_no_fiscales_caja" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Combobox que contiene los módulos (con tasas de IVA) activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para asignar el id del módulo seleccionado-->
									<input id="txtModuloID_anticipos_no_fiscales_caja" 
										   name="intModuloID_anticipos_no_fiscales_caja"  type="hidden" 
										   value="">
									</input>
									<label for="cmbModuloID_anticipos_no_fiscales_caja">Anticipo de cliente para</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbModuloID_anticipos_no_fiscales_caja" 
									 		name="strModuloID_anticipos_no_fiscales_caja" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
					</div>
				    <div class="row">
				    	<!--Concepto-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtConcepto_anticipos_no_fiscales_caja">Concepto</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtConcepto_anticipos_no_fiscales_caja" 
											name="strConcepto_anticipos_no_fiscales_caja" type="text" value="" tabindex="1" 
											placeholder="Ingrese concepto" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Subtotal-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSubtotal_anticipos_no_fiscales_caja">Subtotal</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_anticipos_no_fiscales_caja" id="txtSubtotal_anticipos_no_fiscales_caja" 
												name="intSubtotal_anticipos_no_fiscales_caja" type="text" value="" tabindex="1" placeholder="Ingrese subtotal" maxlength="14">
										</input>
									</div>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para asignar el importe del IVA-->
									<input id="txtIva_anticipos_no_fiscales_caja" 
										   name="intIva_anticipos_no_fiscales_caja" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
									<input id="txtTasaCuotaIva_anticipos_no_fiscales_caja" 
										   name="intTasaCuotaIva_anticipos_no_fiscales_caja" 
										   type="hidden" value="">
									</input>
									<label for="txtPorcentajeIva_anticipos_no_fiscales_caja">IVA %</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPorcentajeIva_anticipos_no_fiscales_caja" 
											name="intPorcentajeIva_anticipos_no_fiscales_caja" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 no-mostrar">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para asignar el importe del IEPS-->
									<input id="txtIeps_anticipos_no_fiscales_caja" 
										   name="intIeps_anticipos_no_fiscales_caja" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
									<input id="txtTasaCuotaIeps_anticipos_no_fiscales_caja" 
										   name="intTasaCuotaIeps_anticipos_no_fiscales_caja" 
										   type="hidden" value="">
									</input>
									<label for="txtPorcentajeIeps_anticipos_no_fiscales_caja">IEPS %</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPorcentajeIeps_anticipos_no_fiscales_caja" 
											name="intPorcentajeIeps_anticipos_no_fiscales_caja" type="text" value="" tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Total-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTotal_anticipos_no_fiscales_caja">Total</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control" id="txtTotal_anticipos_no_fiscales_caja" 
												name="intTotal_anticipos_no_fiscales_caja" type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_anticipos_no_fiscales_caja" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 
                  	<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_anticipos_no_fiscales_caja"  
									onclick="validar_anticipos_no_fiscales_caja();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_anticipos_no_fiscales_caja"  
									onclick="reporte_registro_anticipos_no_fiscales_caja('');"  title="Imprimir registro en PDF" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_anticipos_no_fiscales_caja"  
									onclick="cambiar_estatus_anticipos_no_fiscales_caja('','','');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_anticipos_no_fiscales_caja"
									type="reset" aria-hidden="true" onclick="cerrar_anticipos_no_fiscales_caja();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Anticipos-->
	</div><!--#AnticiposNoFiscalesCajaContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_anticipos_no_fiscales_caja" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>

    <!-- /.Plantilla para cargar las cuentas bancarias en el combobox-->  
	<script id="cuentas_bancarias_anticipos_no_fiscales_caja" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#cuentas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/cuentas}} 
	</script>

	<!-- /.Plantilla para cargar los módulos en el combobox-->  
	<script id="modulos_anticipos_no_fiscales_caja" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#modulos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/modulos}} 
	</script>

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaAnticiposNoFiscalesCaja = 0;
		var strUltimaBusquedaAnticiposNoFiscalesCaja = "";
		/*Variable que se utiliza para asignar el tipo de referencia para generar póliza*/
		var strTipoReferenciaAnticiposNoFiscalesCaja = "RECIBO INTERNO ANTICIPO";
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDAnticiposNoFiscalesCaja = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseAnticiposNoFiscalesCaja = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoAnticiposNoFiscalesCaja = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar el id del método de pago base
		var intMetodoPagoBaseIDAnticiposNoFiscalesCaja = <?php echo METODO_PAGO_BASE ?>;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarAnticiposNoFiscalesCaja = null;
		//Variable que se utiliza para asignar objeto del modal Anticipos
		var objAnticiposNoFiscalesCaja = null;


		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_anticipos_no_fiscales_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/anticipos_no_fiscales/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_anticipos_no_fiscales_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosAnticiposNoFiscalesCaja = data.row;
					//Separar la cadena 
					var arrPermisosAnticiposNoFiscalesCaja = strPermisosAnticiposNoFiscalesCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosAnticiposNoFiscalesCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosAnticiposNoFiscalesCaja[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_anticipos_no_fiscales_caja').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosAnticiposNoFiscalesCaja[i]=='GUARDAR') || (arrPermisosAnticiposNoFiscalesCaja[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_anticipos_no_fiscales_caja').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposNoFiscalesCaja[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_anticipos_no_fiscales_caja').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_anticipos_no_fiscales_caja();
						}
						else if(arrPermisosAnticiposNoFiscalesCaja[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_anticipos_no_fiscales_caja').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposNoFiscalesCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_anticipos_no_fiscales_caja').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposNoFiscalesCaja[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_anticipos_no_fiscales_caja').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposNoFiscalesCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_anticipos_no_fiscales_caja').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_anticipos_no_fiscales_caja() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaAnticiposNoFiscalesCaja = ($('#txtFechaInicialBusq_anticipos_no_fiscales_caja').val()+$('#txtFechaFinalBusq_anticipos_no_fiscales_caja').val()+$('#txtProspectoIDBusq_anticipos_no_fiscales_caja').val()+$('#cmbEstatusBusq_anticipos_no_fiscales_caja').val()+$('#txtBusqueda_anticipos_no_fiscales_caja').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaAnticiposNoFiscalesCaja != strUltimaBusquedaAnticiposNoFiscalesCaja)
			{
				intPaginaAnticiposNoFiscalesCaja = 0;
				strUltimaBusquedaAnticiposNoFiscalesCaja = strNuevaBusquedaAnticiposNoFiscalesCaja;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/anticipos_no_fiscales/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_anticipos_no_fiscales_caja').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_anticipos_no_fiscales_caja').val()),
						intProspectoID: $('#txtProspectoIDBusq_anticipos_no_fiscales_caja').val(),
						strEstatus: $('#cmbEstatusBusq_anticipos_no_fiscales_caja').val(),
						strBusqueda: $('#txtBusqueda_anticipos_no_fiscales_caja').val(),
						intPagina:intPaginaAnticiposNoFiscalesCaja,
						strPermisosAcceso: $('#txtAcciones_anticipos_no_fiscales_caja').val()
					},
					function(data){
						$('#dg_anticipos_no_fiscales_caja tbody').empty();
						var tmpAnticiposNoFiscalesCaja = Mustache.render($('#plantilla_anticipos_no_fiscales_caja').html(),data);
						$('#dg_anticipos_no_fiscales_caja tbody').html(tmpAnticiposNoFiscalesCaja);
						$('#pagLinks_anticipos_no_fiscales_caja').html(data.paginacion);
						$('#numElementos_anticipos_no_fiscales_caja').html(data.total_rows);
						intPaginaAnticiposNoFiscalesCaja = data.pagina;
					},
			'json');
		}


		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_anticipos_no_fiscales_caja()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_anticipos_no_fiscales_caja').empty();
					var temp = Mustache.render($('#monedas_anticipos_no_fiscales_caja').html(), data);
					$('#cmbMonedaID_anticipos_no_fiscales_caja').html(temp);
				},
				'json');
		}

		//Regresar cuentas bancarias activas para cargarlas en el combobox
		function cargar_cuentas_bancarias_anticipos_no_fiscales_caja(intCuentaBancariaID = 0)
		{
			//Variable que se utiliza para asignar el id de la moneda
			intMonedaID = $('#cmbMonedaID_anticipos_no_fiscales_caja').val();

			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('cuentas_pagar/cuentas_bancarias/get_combo_box/'+intMonedaID, {},
				function(data)
				{
					$('#cmbCuentaBancariaID_anticipos_no_fiscales_caja').empty();
					var temp = Mustache.render($('#cuentas_bancarias_anticipos_no_fiscales_caja').html(), data);
					$('#cmbCuentaBancariaID_anticipos_no_fiscales_caja').html(temp);

					//Si existe id de la cuenta bancaria
					if(intCuentaBancariaID > 0)
					{
						//Asignar el id de la cuenta bancaria
						$('#cmbCuentaBancariaID_anticipos_no_fiscales_caja').val(intCuentaBancariaID);
					}

				},
				'json');
		}

		//Regresar módulos activos para cargarlos en el combobox
		function cargar_modulos_anticipos_no_fiscales_caja()
		{
			//Hacer un llamado al método del controlador para regresar los módulos que se encuentran activas 
			$.post('crm/modulos/get_combo_box/anticipos_no_fiscales', {},
				function(data)
				{
					$('#cmbModuloID_anticipos_no_fiscales_caja').empty();
					var temp = Mustache.render($('#modulos_anticipos_no_fiscales_caja').html(), data);
					$('#cmbModuloID_anticipos_no_fiscales_caja').html(temp);
				},
				'json');
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_anticipos_no_fiscales_caja(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'caja/anticipos_no_fiscales/';

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


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_anticipos_no_fiscales_caja').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_anticipos_no_fiscales_caja').val()),
										'intProspectoID': $('#txtProspectoIDBusq_anticipos_no_fiscales_caja').val(),
										'strEstatus': $('#cmbEstatusBusq_anticipos_no_fiscales_caja').val(), 
										'strBusqueda': $('#txtBusqueda_anticipos_no_fiscales_caja').val()		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_anticipos_no_fiscales_caja(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtAnticipoNoFiscalID_anticipos_no_fiscales_caja').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'caja/anticipos_no_fiscales/get_reporte_registro',
							'data' : {
										'intAnticipoNoFiscalID': intID			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		
	

		/*******************************************************************************************************************
		Funciones del modal Anticipos
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_anticipos_no_fiscales_caja()
		{
			//Incializar formulario
			$('#frmAnticiposNoFiscalesCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_anticipos_no_fiscales_caja();
			//Limpiar cajas de texto ocultas
			$('#frmAnticiposNoFiscalesCaja').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_anticipos_no_fiscales_caja');
			//Habilitar todos los elementos del formulario
			$('#frmAnticiposNoFiscalesCaja').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_anticipos_no_fiscales_caja').val(fechaActual());
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_anticipos_no_fiscales_caja').attr("disabled", "disabled");
			$('#txtRfc_anticipos_no_fiscales_caja').attr("disabled", "disabled");
			$('#txtTotal_anticipos_no_fiscales_caja').attr("disabled", "disabled");
			$('#txtPorcentajeIva_anticipos_no_fiscales_caja').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_anticipos_no_fiscales_caja").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_anticipos_no_fiscales_caja").hide();
			$("#btnDesactivar_anticipos_no_fiscales_caja").hide();
		   
		}

		//Función para inicializar elementos del cliente
		function inicializar_cliente_anticipos_no_fiscales_caja()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#txtRfc_anticipos_no_fiscales_caja").val('');
            $("#txtCalle_anticipos_no_fiscales_caja").val('');
            $("#txtNumeroExterior_anticipos_no_fiscales_caja").val('');
            $("#txtNumeroInterior_anticipos_no_fiscales_caja").val('');
            $("#txtCodigoPostal_anticipos_no_fiscales_caja").val('');
            $("#txtColonia_anticipos_no_fiscales_caja").val('');
            $("#txtLocalidad_anticipos_no_fiscales_caja").val('');
            $("#txtMunicipio_anticipos_no_fiscales_caja").val('');
            $("#txtEstado_anticipos_no_fiscales_caja").val('');
            $("#txtPais_anticipos_no_fiscales_caja").val('');
		}

		
		//Función que se utiliza para cerrar el modal
		function cerrar_anticipos_no_fiscales_caja()
		{
			try {

				//Cerrar modal 
				objAnticiposNoFiscalesCaja.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_anticipos_no_fiscales_caja();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_anticipos_no_fiscales_caja').focus();
				
			}
			catch(err) {}
		}

		
		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_anticipos_no_fiscales_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_anticipos_no_fiscales_caja();
			//Validación del formulario de campos obligatorios
			$('#frmAnticiposNoFiscalesCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_anticipos_no_fiscales_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intMonedaID_anticipos_no_fiscales_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_anticipos_no_fiscales_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_anticipos_no_fiscales_caja').val()) !== intMonedaBaseIDAnticiposNoFiscalesCaja)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoAnticiposNoFiscalesCaja)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoAnticiposNoFiscalesCaja
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strRazonSocial_anticipos_no_fiscales_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del cliente
					                                    if($('#txtProspectoID_anticipos_no_fiscales_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una razón social existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFormaPago_anticipos_no_fiscales_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la forma de pago
					                                    if($('#txtFormaPagoID_anticipos_no_fiscales_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una forma de pago existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strModuloID_anticipos_no_fiscales_caja: {
											validators: {
												notEmpty: {message: 'Seleccione un módulo'}
											}
										},
										intCuentaBancariaID_anticipos_no_fiscales_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una cuenta bancaria'}
											}
										},
										strConcepto_anticipos_no_fiscales_caja: {
											validators: {
												notEmpty: {message: 'Escriba un concepto'}
											}
										},
										intSubtotal_anticipos_no_fiscales_caja: {
											validators: {
												notEmpty: {message: 'Escriba un importe'}
											}
										},
										intPorcentajeIva_anticipos_no_fiscales_caja: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IVA
					                                    if($('#txtTasaCuotaIva_anticipos_no_fiscales_caja').val() === '')
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
										intPorcentajeIeps_anticipos_no_fiscales_caja: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IEPS
					                                    if(value != '' && $('#txtTasaCuotaIeps_anticipos_no_fiscales_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una tasa o cuota de IEPS existente'
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
			var bootstrapValidator_anticipos_no_fiscales_caja = $('#frmAnticiposNoFiscalesCaja').data('bootstrapValidator');
			bootstrapValidator_anticipos_no_fiscales_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_anticipos_no_fiscales_caja.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_anticipos_no_fiscales_caja();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_anticipos_no_fiscales_caja()
		{
			try
			{
				$('#frmAnticiposNoFiscalesCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_anticipos_no_fiscales_caja()
		{
		   	//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioAnticipo = parseFloat($('#txtTipoCambio_anticipos_no_fiscales_caja').val());
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			var intSubtotalAnticipo = $.reemplazar($('#txtSubtotal_anticipos_no_fiscales_caja').val(), ",", "");
			var intImporteIva = $('#txtIva_anticipos_no_fiscales_caja').val();
			var intImporteIeps = $('#txtIeps_anticipos_no_fiscales_caja').val();
			
			//Convertir importes a peso mexicano
			intSubtotalAnticipo = intSubtotalAnticipo * intTipoCambioAnticipo;
			intImporteIva = intImporteIva * intTipoCambioAnticipo;
			intImporteIeps = intImporteIeps * intTipoCambioAnticipo;

		
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('caja/anticipos_no_fiscales/guardar',
					{ 
						//Datos del anticipo
						intAnticipoNoFiscalID: $('#txtAnticipoNoFiscalID_anticipos_no_fiscales_caja').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_anticipos_no_fiscales_caja').val()),
						intMonedaID: $('#cmbMonedaID_anticipos_no_fiscales_caja').val(),
						intTipoCambio: intTipoCambioAnticipo,
						intProspectoID: $('#txtProspectoID_anticipos_no_fiscales_caja').val(),
						strRazonSocial: $('#txtRazonSocial_anticipos_no_fiscales_caja').val(),
						strRfc: $('#txtRfc_anticipos_no_fiscales_caja').val(),
						strCalle: $('#txtCalle_anticipos_no_fiscales_caja').val(),
						strNumeroExterior: $('#txtNumeroExterior_anticipos_no_fiscales_caja').val(),
						strNumeroInterior: $('#txtNumeroInterior_anticipos_no_fiscales_caja').val(),
						strCodigoPostal: $('#txtCodigoPostal_anticipos_no_fiscales_caja').val(),
						strColonia: $('#txtColonia_anticipos_no_fiscales_caja').val(),
						strLocalidad: $('#txtLocalidad_anticipos_no_fiscales_caja').val(),
						strMunicipio: $('#txtMunicipio_anticipos_no_fiscales_caja').val(),
						strEstado: $('#txtEstado_anticipos_no_fiscales_caja').val(),
						strPais: $('#txtPais_anticipos_no_fiscales_caja').val(),
						intModuloID: $('#txtModuloID_anticipos_no_fiscales_caja').val(),
						strConcepto: $('#txtConcepto_anticipos_no_fiscales_caja').val(),
						intSubtotal: intSubtotalAnticipo,
						intTasaCuotaIva: $('#txtTasaCuotaIva_anticipos_no_fiscales_caja').val(),
						intIva: intImporteIva,
						intTasaCuotaIeps: $('#txtTasaCuotaIeps_anticipos_no_fiscales_caja').val(),
						intIeps: intImporteIeps,
						intFormaPagoID: $('#txtFormaPagoID_anticipos_no_fiscales_caja').val(),
						intCuentaBancariaID: $('#cmbCuentaBancariaID_anticipos_no_fiscales_caja').val(),
						strObservaciones: $('#txtObservaciones_anticipos_no_fiscales_caja').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_anticipos_no_fiscales_caja').val()
					},
					function(data) {						
						if (data.resultado)
						{
							
							//Si no existe id del anticipo, significa que es un nuevo registro   
                            if($('#txtAnticipoNoFiscalID_anticipos_no_fiscales_caja').val() == '')
                            {
                                //Asignar el id del anticipo registrado en la base de datos
                                $('#txtAnticipoNoFiscalID_anticipos_no_fiscales_caja').val(data.anticipo_no_fiscal_id);
                            }

							//Hacer llamado a la función para cargar  los registros en el grid
							paginacion_anticipos_no_fiscales_caja();
						
							//Hacer un llamado a la función para generar póliza con los datos del registro
                            generar_poliza_anticipos_no_fiscales_caja('', '');
						}


						//Si existe mensaje de error
                        if(data.tipo_mensaje == 'error')
                        {
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_anticipos_no_fiscales_caja(data.tipo_mensaje, data.mensaje);
						}
					
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_anticipos_no_fiscales_caja(tipoMensaje, mensaje)
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

		
		//Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_anticipos_no_fiscales_caja(id, polizaID, folioPoliza)
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
				intID = $('#txtAnticipoNoFiscalID_anticipos_no_fiscales_caja').val();
				intPolizaID = $('#txtPolizaID_anticipos_no_fiscales_caja').val();
				strFolioPoliza = $('#txtFolioPoliza_anticipos_no_fiscales_caja').val();

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
			              'title':    'Recibo Interno de Anticipo',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              	//Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('caja/anticipos_no_fiscales/set_estatus',
				                                     {intAnticipoNoFiscalID: intID,
				                                      intPolizaID: intPolizaID
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                          	//Hacer llamado a la función  para cargar  los registros en el grid
				                                          	paginacion_anticipos_no_fiscales_caja();

				                                           	//Si el id del registro se obtuvo del modal
	                                                        if(id == '')
	                                                        {
	                                                            //Hacer un llamado a la función para cerrar modal
	                                                            cerrar_anticipos_no_fiscales_caja();     
	                                                        }
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_anticipos_no_fiscales_caja(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
			                            }
			                          }
			              });
		    
		}

		
		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_anticipos_no_fiscales_caja(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('caja/anticipos_no_fiscales/get_datos',
			       {intAnticipoNoFiscalID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_anticipos_no_fiscales_caja();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar el id del módulo
				            var intModuloID = data.row.modulo_id;
				            //Variable que se utiliza para asignar el id de la tasa del impuesto de IVA
				            var intTasaCuotaIva = data.row.tasa_cuota_iva;
				            //Variable que se utiliza para asignar el porcentaje del impuesto de IVA
				            var intPorcentajeIva = data.row.porcentaje_iva;

						    //Concatenar valores para formar el id (value) del módulo (combobox)
	       				    var strModuloID = intModuloID+'|'+intTasaCuotaIva+'|'+intPorcentajeIva;

						    //Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);
				            var intSubtotal = parseFloat(data.row.subtotal);

				            //Convertir peso mexicano a tipo de cambio
							intSubtotal = intSubtotal / intTipoCambio;
							
						    //Asignar el id de la póliza
                            var intPolizaID = parseInt(data.row.poliza_id);

				          	//Recuperar valores
				          	$('#txtAnticipoNoFiscalID_anticipos_no_fiscales_caja').val(data.row.anticipo_no_fiscal_id);
				          	$('#txtFolio_anticipos_no_fiscales_caja').val(data.row.folio);
				          	$('#txtFecha_anticipos_no_fiscales_caja').val(data.row.fecha);
				          	$('#cmbMonedaID_anticipos_no_fiscales_caja').val(data.row.moneda_id);
				          	$('#txtTipoCambio_anticipos_no_fiscales_caja').val(data.row.tipo_cambio);
						    $('#txtProspectoID_anticipos_no_fiscales_caja').val(data.row.prospecto_id);
						    $('#txtRazonSocial_anticipos_no_fiscales_caja').val(data.row.razon_social);
						    $('#txtRfc_anticipos_no_fiscales_caja').val(data.row.rfc);
						    $('#txtCalle_anticipos_no_fiscales_caja').val(data.row.calle);
						    $('#txtNumeroExterior_anticipos_no_fiscales_caja').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_anticipos_no_fiscales_caja').val(data.row.numero_interior);
						    $('#txtCodigoPostal_anticipos_no_fiscales_caja').val(data.row.codigo_postal);
						    $('#txtColonia_anticipos_no_fiscales_caja').val(data.row.colonia);
						    $('#txtLocalidad_anticipos_no_fiscales_caja').val(data.row.localidad);
						    $('#txtMunicipio_anticipos_no_fiscales_caja').val(data.row.municipio);
						    $('#txtEstado_anticipos_no_fiscales_caja').val(data.row.estado);
						    $('#txtPais_anticipos_no_fiscales_caja').val(data.row.pais);
						    $('#txtModuloID_anticipos_no_fiscales_caja').val(intModuloID);
						    $('#cmbModuloID_anticipos_no_fiscales_caja').val(strModuloID);
						    $('#txtConcepto_anticipos_no_fiscales_caja').val(data.row.concepto);
						    $('#txtSubtotal_anticipos_no_fiscales_caja').val(intSubtotal);
						    $('#txtTasaCuotaIva_anticipos_no_fiscales_caja').val(intTasaCuotaIva);
						    $('#txtPorcentajeIva_anticipos_no_fiscales_caja').val(intPorcentajeIva);
						    $('#txtTasaCuotaIeps_anticipos_no_fiscales_caja').val(data.row.tasa_cuota_ieps);
						    $('#txtPorcentajeIeps_anticipos_no_fiscales_caja').val(data.row.porcentaje_ieps);
						    //Hacer un llamado a la función para calcular el importe total del anticipo
							calcular_total_anticipos_no_fiscales_caja();
							//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtSubtotal_anticipos_no_fiscales_caja').formatCurrency({ roundToDecimalPlace: 2 });
						    $('#txtFormaPagoID_anticipos_no_fiscales_caja').val(data.row.forma_pago_id);
						    $('#txtFormaPago_anticipos_no_fiscales_caja').val(data.row.forma_pago);
						    //Hacer un llamado a la función para cargar cuentas bancarias en el combobox
							cargar_cuentas_bancarias_anticipos_no_fiscales_caja(data.row.cuenta_bancaria_id);
					        $('#txtObservaciones_anticipos_no_fiscales_caja').val(data.row.observaciones);
					        $('#txtPolizaID_anticipos_no_fiscales_caja').val(intPolizaID);
						    $('#txtFolioPoliza_anticipos_no_fiscales_caja').val(data.row.folio_poliza);
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_anticipos_no_fiscales_caja').addClass("estatus-"+strEstatus);
				            $('#txtEstatus_anticipos_no_fiscales_caja').val(strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_anticipos_no_fiscales_caja").show();
				           	
				            

				            //Si el tipo de acción corresponde a Ver (o estatus INACTIVO)
                            if(tipoAccion == 'Ver')
                            {

                            	 //Deshabilitar todos los elementos del formulario
				            	$('#frmAnticiposNoFiscalesCaja').find('input, textarea, select').attr('disabled','disabled');

					            //Ocultar botón Guardar
								$("#btnGuardar_anticipos_no_fiscales_caja").hide();


                                //Si existe el id de la póliza
                                if(strEstatus == 'ACTIVO' && intPolizaID > 0)
                                {
                                    //Mostrar el botón Desactivar
                                    $("#btnDesactivar_anticipos_no_fiscales_caja").show();
                                }

                            }
                            else
                            {
                            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDAnticiposNoFiscalesCaja)
							    {
									//Habilitar caja de texto
									$("#txtTipoCambio_anticipos_no_fiscales_caja").removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar caja de texto
									$("#txtTipoCambio_anticipos_no_fiscales_caja").attr('disabled','disabled');
							    }
                            }

			            	//Abrir modal
				            objAnticiposNoFiscalesCaja = $('#AnticiposNoFiscalesCajaBox').bPopup({
												  appendTo: '#AnticiposNoFiscalesCajaContent', 
					                              contentContainer: 'AnticiposNoFiscalesCajaM', 
					                              zIndex: 2, 
					                              modalClose: false, 
					                              modal: true, 
					                              follow: [true,false], 
					                              followEasing : "linear", 
					                              easing: "linear", 
					                              modalColor: ('#F0F0F0')});
					        
				             //Enfocar caja de texto
							$('#cmbMonedaID_anticipos_no_fiscales_caja').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar y obtener los datos de un cliente
		function get_datos_cliente_anticipos_no_fiscales_caja()
		{
		 	//Hacer un llamado al método del controlador para regresar los datos del cliente
            $.post('cuentas_cobrar/clientes/get_datos',
                  { 
                  	intProspectoID:$("#txtProspectoID_anticipos_no_fiscales_caja").val()
                  },
                  function(data) {	                  	
                    if(data.row){
                       //Asignar datos del registro seleccionado
                       $("#txtRfc_anticipos_no_fiscales_caja").val(data.row.rfc);
                       $("#txtCalle_anticipos_no_fiscales_caja").val(data.row.calle);
                       $("#txtNumeroExterior_anticipos_no_fiscales_caja").val(data.row.numero_exterior);
                       $("#txtNumeroInterior_anticipos_no_fiscales_caja").val(data.row.numero_interior);
                       $("#txtCodigoPostal_anticipos_no_fiscales_caja").val(data.row.codigo_postal);
                       $("#txtColonia_anticipos_no_fiscales_caja").val(data.row.colonia);
                       $("#txtLocalidad_anticipos_no_fiscales_caja").val(data.row.localidad);
                       $("#txtMunicipio_anticipos_no_fiscales_caja").val(data.row.municipio);
                       $("#txtEstado_anticipos_no_fiscales_caja").val(data.row.estado_rep);
                       $("#txtPais_anticipos_no_fiscales_caja").val(data.row.pais_rep);
                    }
                  }
                 ,
                'json');

		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_anticipos_no_fiscales_caja()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_anticipos_no_fiscales_caja').val()) !== intMonedaBaseIDAnticiposNoFiscalesCaja)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_anticipos_no_fiscales_caja").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_anticipos_no_fiscales_caja').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_anticipos_no_fiscales_caja').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_anticipos_no_fiscales_caja").val(data.row.tipo_cambio_sat);
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}

		//Función que se utiliza para calcular el importe total del anticipo
		function calcular_total_anticipos_no_fiscales_caja()
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
			var intPorcentajeIva = $('#txtPorcentajeIva_anticipos_no_fiscales_caja').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_anticipos_no_fiscales_caja').val();


         	//Verificar que exista importe de subtotal
			if($('#txtSubtotal_anticipos_no_fiscales_caja').val() != '')
			{ 
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intSubtotal = parseFloat($.reemplazar($("#txtSubtotal_anticipos_no_fiscales_caja").val(), ",", ""));

				//Si existe porcentaje de IVA
				if(intPorcentajeIva != '')
				{
					//Calcular importe de IVA
					intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
				}

				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps != '')
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
				}
			}

			//Calcular importe total
			intTotal = (intSubtotal + intImporteIva + intImporteIeps);

			//Cambiar cantidad a formato moneda
			intTotal = formatMoney(intTotal, 2, '');
			//Asignar importe total 
			$('#txtTotal_anticipos_no_fiscales_caja').val(intTotal);
			$('#txtIva_anticipos_no_fiscales_caja').val(intImporteIva);
			$('#txtIeps_anticipos_no_fiscales_caja').val(intImporteIeps);
		}

		//Función para generar póliza con los datos de un registro
		function generar_poliza_anticipos_no_fiscales_caja(id, formulario)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
            var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtAnticipoNoFiscalID_anticipos_no_fiscales_caja').val();
			}
			else
			{
				intID = id;
				strTipo = 'gridview';
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_anticipos_no_fiscales_caja(formulario);
			//Hacer un llamado al método del controlador para generar póliza del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaAnticiposNoFiscalesCaja, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_anticipos_no_fiscales_caja').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	            ocultar_circulo_carga_anticipos_no_fiscales_caja(formulario);

		     	//Si existe resultado
				if (data.resultado)
				{
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_anticipos_no_fiscales_caja();
					
					//Si el id del registro se obtuvo del modal
					if(strTipo == 'modal')
					{
						//Hacer un llamado a la función para cerrar modal
						cerrar_anticipos_no_fiscales_caja();     
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
			            								cerrar_anticipos_no_fiscales_caja();
	                                                 }
	                                                }]
	                                  });
				}
				else
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    	mensaje_anticipos_no_fiscales_caja(data.tipo_mensaje, data.mensaje);
				}

		     },
		     'json');
		}


		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de generar póliza
		function mostrar_circulo_carga_anticipos_no_fiscales_caja(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_anticipos_no_fiscales_caja';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_anticipos_no_fiscales_caja';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de generar póliza
		function ocultar_circulo_carga_anticipos_no_fiscales_caja(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_anticipos_no_fiscales_caja';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_anticipos_no_fiscales_caja';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}


	
		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Anticipos
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_anticipos_no_fiscales_caja').datetimepicker({format: 'DD/MM/YYYY'});
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_anticipos_no_fiscales_caja').numeric();
			$('#txtPorcentajeIva_anticipos_no_fiscales_caja').numeric();
			$('#txtPorcentajeIeps_anticipos_no_fiscales_caja').numeric();
        	$('#txtSubtotal_anticipos_no_fiscales_caja').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_anticipos_no_fiscales_caja').blur(function(){
				$('.moneda_anticipos_no_fiscales_caja').formatCurrency({ roundToDecimalPlace: 2 });
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_anticipos_no_fiscales_caja').blur(function(){
                $('.tipo-cambio_anticipos_no_fiscales_caja').formatCurrency({ roundToDecimalPlace: 4 });
            });
        	

        	//Regresar el tipo de cambio de la moneda cuando cambie la fecha
			$('#dteFecha_anticipos_no_fiscales_caja').on('dp.change', function (e) {
				//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_anticipos_no_fiscales_caja();
			});


        	//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_anticipos_no_fiscales_caja').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_anticipos_no_fiscales_caja').val()) === intMonedaBaseIDAnticiposNoFiscalesCaja)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_anticipos_no_fiscales_caja").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_anticipos_no_fiscales_caja').val(intTipoCambioMonedaBaseAnticiposNoFiscalesCaja);
				    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_anticipos_no_fiscales_caja').formatCurrency({ roundToDecimalPlace: 4 }); 
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_anticipos_no_fiscales_caja").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_anticipos_no_fiscales_caja').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_anticipos_no_fiscales_caja();
             	}

             	//Hacer un llamado a la función para cargar cuentas bancarias en el combobox del modal
            	cargar_cuentas_bancarias_anticipos_no_fiscales_caja();
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_anticipos_no_fiscales_caja').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_anticipos_no_fiscales_caja').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoAnticiposNoFiscalesCaja)
	        	{
	        		$('#txtTipoCambio_anticipos_no_fiscales_caja').val(intTipoCambioMaximoAnticiposNoFiscalesCaja);
	        	}

		    });

        	//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_anticipos_no_fiscales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_anticipos_no_fiscales_caja').val('');
	               //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_anticipos_no_fiscales_caja();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/clientes/autocomplete",
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
	             $('#txtProspectoID_anticipos_no_fiscales_caja').val(ui.item.data);
	             //Hacer un llamado a la función para regresar los datos del cliente
	           	 get_datos_cliente_anticipos_no_fiscales_caja();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del cliente cuando pierda el enfoque la caja de texto
	        $('#txtRazonSocial_anticipos_no_fiscales_caja').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_anticipos_no_fiscales_caja').val() == '' ||
	               $('#txtRazonSocial_anticipos_no_fiscales_caja').val() == '')
	            { 
	            	//Limpiar contenido de las siguientes cajas de texto
	            	$('#txtProspectoID_anticipos_no_fiscales_caja').val('');
	            	$('#txtRazonSocial_anticipos_no_fiscales_caja').val('');
	                //Hacer un llamado a la función para inicializar elementos del cliente
	                inicializar_cliente_anticipos_no_fiscales_caja();
	            }
	        });

	        //Autocomplete para recuperar los datos de una forma de pago
	        $('#txtFormaPago_anticipos_no_fiscales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtFormaPagoID_anticipos_no_fiscales_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_forma_pago/autocomplete",
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
	             $('#txtFormaPagoID_anticipos_no_fiscales_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la forma de pago cuando pierda el enfoque la caja de texto
	        $('#txtFormaPago_anticipos_no_fiscales_caja').focusout(function(e){
	            //Si no existe id de la forma de pago
	            if($('#txtFormaPagoID_anticipos_no_fiscales_caja').val() == '' ||
	               $('#txtFormaPago_anticipos_no_fiscales_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtFormaPagoID_anticipos_no_fiscales_caja').val('');
	               $('#txtFormaPago_anticipos_no_fiscales_caja').val('');
	            }
	            
	        });


        	//Obtener valores del módulo cuando cambie la opción del combobox
	        $('#cmbModuloID_anticipos_no_fiscales_caja').change(function(e){   
	          
	        	//Si existe id del módulo
	        	if($('#cmbModuloID_anticipos_no_fiscales_caja').val() != '')
	        	{
	        		//Asignar el id del módulo (cadena concatanada con el id del módulo y su tasa de IVA)
					var strModuloID = $('#cmbModuloID_anticipos_no_fiscales_caja').val();
					//Separar la cadena para obtener datos del módulo y su tasa de IVA
					var arrModuloID = strModuloID.split('|');
					//Asignar el id del modulo
					$('#txtModuloID_anticipos_no_fiscales_caja').val(arrModuloID[0]);
					$('#txtTasaCuotaIva_anticipos_no_fiscales_caja').val(arrModuloID[1]);
					$('#txtPorcentajeIva_anticipos_no_fiscales_caja').val(arrModuloID[2]);

					//Hacer un llamado a la función para calcular el importe total del anticipo
					calcular_total_anticipos_no_fiscales_caja();

	        	}
	        	else
	        	{
	        		//Limpiar contenido de las siguientes cajas de texto
	        		$('#txtModuloID_anticipos_no_fiscales_caja').val('');
	        		$('#txtTasaCuotaIva_anticipos_no_fiscales_caja').val('');
	        		$('#txtPorcentajeIva_anticipos_no_fiscales_caja').val('');
	        	}
	           
	        });


	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_anticipos_no_fiscales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_anticipos_no_fiscales_caja').val('');
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
	             $('#txtTasaCuotaIeps_anticipos_no_fiscales_caja').val(ui.item.data);
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
	        $('#txtPorcentajeIeps_anticipos_no_fiscales_caja').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_anticipos_no_fiscales_caja').val() == '' ||
	               $('#txtPorcentajeIeps_anticipos_no_fiscales_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_anticipos_no_fiscales_caja').val('');
	               $('#txtPorcentajeIeps_anticipos_no_fiscales_caja').val('');
	            }

	            //Hacer un llamado a la función para calcular el importe total del anticipo
				calcular_total_anticipos_no_fiscales_caja();
	            
	        });

	        //Calcular el importe total del anticipo cuando pierda el enfoque la caja de texto
			$('#txtSubtotal_anticipos_no_fiscales_caja').focusout(function(e){
				//Hacer un llamado a la función para calcular el importe total del anticipo
				calcular_total_anticipos_no_fiscales_caja();
			});
			

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_anticipos_no_fiscales_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_anticipos_no_fiscales_caja').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_anticipos_no_fiscales_caja').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_anticipos_no_fiscales_caja').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_anticipos_no_fiscales_caja').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_anticipos_no_fiscales_caja').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_anticipos_no_fiscales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_anticipos_no_fiscales_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/clientes/autocomplete",
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
	             $('#txtProspectoIDBusq_anticipos_no_fiscales_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del cliente cuando pierda el enfoque la caja de texto
	        $('#txtRazonSocialBusq_anticipos_no_fiscales_caja').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_anticipos_no_fiscales_caja').val() == '' ||
	            	$('#txtRazonSocialBusq_anticipos_no_fiscales_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_anticipos_no_fiscales_caja').val('');
	               $('#txtRazonSocialBusq_anticipos_no_fiscales_caja').val('');
	            }
	            
	        });

			//Paginación de registros
			$('#pagLinks_anticipos_no_fiscales_caja').on('click','a',function(event){
				event.preventDefault();
				intPaginaAnticiposNoFiscalesCaja = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_anticipos_no_fiscales_caja();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_anticipos_no_fiscales_caja').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_anticipos_no_fiscales_caja();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_anticipos_no_fiscales_caja').addClass("estatus-NUEVO");
				//Abrir modal
				objAnticiposNoFiscalesCaja = $('#AnticiposNoFiscalesCajaBox').bPopup({
									   appendTo: '#AnticiposNoFiscalesCajaContent', 
		                               contentContainer: 'AnticiposNoFiscalesCajaM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_anticipos_no_fiscales_caja').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_anticipos_no_fiscales_caja').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_anticipos_no_fiscales_caja();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_anticipos_no_fiscales_caja();
            //Hacer un llamado a la función para cargar módulos en el combobox del modal
            cargar_modulos_anticipos_no_fiscales_caja();
		});
	</script>