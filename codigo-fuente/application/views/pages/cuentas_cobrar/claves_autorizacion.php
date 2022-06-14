	<div id="GenerarClavesAutorizacionCuentasCobrarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_claves_autorizacion_cuentas_cobrar" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_claves_autorizacion_cuentas_cobrar" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_claves_autorizacion_cuentas_cobrar">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_claves_autorizacion_cuentas_cobrar'>
				                    <input class="form-control" id="txtFechaInicialBusq_claves_autorizacion_cuentas_cobrar"
				                    		name= "strFechaInicialBusq_claves_autorizacion_cuentas_cobrar" 
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
								<label for="txtFechaFinalBusq_claves_autorizacion_cuentas_cobrar">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_claves_autorizacion_cuentas_cobrar'>
				                    <input class="form-control" id="txtFechaFinalBusq_claves_autorizacion_cuentas_cobrar"
				                    		name= "strFechaFinalBusq_claves_autorizacion_cuentas_cobrar" 
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
								<input id="txtProspectoIDBusq_claves_autorizacion_cuentas_cobrar" 
									   name="intProspectoIDBusq_claves_autorizacion_cuentas_cobrar"  type="hidden" 
									   value="">
								</input>
								<label for="txtRazonSocialBusq_claves_autorizacion_cuentas_cobrar">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocialBusq_claves_autorizacion_cuentas_cobrar" 
										name="strRazonSocialBusq_claves_autorizacion_cuentas_cobrar" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese razón social" 
										maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_claves_autorizacion_cuentas_cobrar">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_claves_autorizacion_cuentas_cobrar" 
										name="strBusqueda_claves_autorizacion_cuentas_cobrar" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_claves_autorizacion_cuentas_cobrar"
									onclick="paginacion_claves_autorizacion_cuentas_cobrar();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_claves_autorizacion_cuentas_cobrar" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_claves_autorizacion_cuentas_cobrar"
									onclick="reporte_claves_autorizacion_cuentas_cobrar('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_claves_autorizacion_cuentas_cobrar"
									onclick="reporte_claves_autorizacion_cuentas_cobrar('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla 
				*/
				td.movil.a1:nth-of-type(1):before {content: "Clave"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Generó"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Razón social"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Referencia"; font-weight: bold;}
				
			}

		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_claves_autorizacion_cuentas_cobrar">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Clave</th>
							<th class="movil">Fecha</th>
							<th class="movil">Generó</th>
							<th class="movil">Razón social</th>
							<th class="movil">Referencia</th>
							

						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_claves_autorizacion_cuentas_cobrar" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{clave}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{empleado_genero}}</td>
							<td class="movil a4">{{razon_social}}</td>
							<td class="movil a5">{{folio_referencia}}</td>
							
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="4"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_claves_autorizacion_cuentas_cobrar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_claves_autorizacion_cuentas_cobrar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		
		<!-- Diseño del modal Claves de Autorización-->
		<div id="GenerarClavesAutorizacionCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_claves_autorizacion_cuentas_cobrar"  class="ModalBodyTitle">
			<h1>Claves de autorización</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form 	id="frmGenerarClavesAutorizacionCuentasCobrar" 
						method="post" 
						action="#" 
						class="form-horizontal" 
					  	role="form"  
					  	name="frmGenerarClavesAutorizacionCuentasCobrar"  
					  	onsubmit="return(false)" 
					  	autocomplete="off">
					<div class="row">
						<!--Autocomplete que contiene los clientes activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id del cliente seleccionado-->
									<input id="txtClaveAutorizacionID_claves_autorizacion_cuentas_cobrar" 
										   name="intClaveAutorizacionID_claves_autorizacion_cuentas_cobrar" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta para recuperar el id del cliente seleccionado-->
									<input id="txtProspectoID_claves_autorizacion_cuentas_cobrar" 
										   name="intProspectoID_claves_autorizacion_cuentas_cobrar" 
										   type="hidden" value="" />
									<label for="txtRazonSocial_claves_autorizacion_cuentas_cobrar">
										Razón social
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_claves_autorizacion_cuentas_cobrar" 
											name="strRazonSocial_claves_autorizacion_cuentas_cobrar" type="text" value=""   
											tabindex="1" placeholder="Ingrese razón social" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Saldo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSaldo_claves_autorizacion_cuentas_cobrar">Saldo</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_claves_autorizacion_cuentas_cobrar" id="txtSaldo_claves_autorizacion_cuentas_cobrar" 
												name="intSaldo_claves_autorizacion_cuentas_cobrar" type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
						<!--Saldo vencido-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSaldoVencido_claves_autorizacion_cuentas_cobrar">Saldo vencido</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_claves_autorizacion_cuentas_cobrar" id="txtSaldoVencido_claves_autorizacion_cuentas_cobrar" 
												name="intSaldoVencido_claves_autorizacion_cuentas_cobrar" type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<h4>Maquinaria</h4>
						</div>	
					</div>
					<div class="row">
						<!--Límite de crédito-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMaquinariaCreditoLimite_claves_autorizacion_cuentas_cobrar">Límite de crédito</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_claves_autorizacion_cuentas_cobrar" id="txtMaquinariaCreditoLimite_claves_autorizacion_cuentas_cobrar" 
												name="intMaquinariaCreditoLimite_claves_autorizacion_cuentas_cobrar" type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
						<!--Días de crédito-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMaquinariaCreditoDias_claves_autorizacion_cuentas_cobrar">Días de crédito</label>
								</div>
								<div class="col-md-12">
									<input 	class="form-control" 
											id="txtMaquinariaCreditoDias_claves_autorizacion_cuentas_cobrar"
										   	name="intMaquinariaCreditoDias_claves_autorizacion_cuentas_cobrar" 
										   	type="text" 
										   	value="" 
										   	disabled />
								</div>
							</div>
						</div>
						<!--Saldo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSaldoMaquinaria_claves_autorizacion_cuentas_cobrar">Saldo</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_claves_autorizacion_cuentas_cobrar" id="txtSaldoMaquinaria_claves_autorizacion_cuentas_cobrar" 
												name="intSaldoMaquinaria_claves_autorizacion_cuentas_cobrar" type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
						<!--Saldo vencido-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSaldoVencidoMaquinaria_claves_autorizacion_cuentas_cobrar">Saldo vencido</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_claves_autorizacion_cuentas_cobrar" id="txtSaldoVencidoMaquinaria_claves_autorizacion_cuentas_cobrar" 
												name="intSaldoVencidoMaquinaria_claves_autorizacion_cuentas_cobrar" type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<h4>Refacciones</h4>
						</div>	
					</div>
					<div class="row">
						<!--Límite de crédito-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtRefaccionesCreditoLimite_claves_autorizacion_cuentas_cobrar">Límite de crédito</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_claves_autorizacion_cuentas_cobrar" id="txtRefaccionesCreditoLimite_claves_autorizacion_cuentas_cobrar" 
												name="intRefaccionesCreditoLimite_claves_autorizacion_cuentas_cobrar" type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
						<!--Días de crédito-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtRefaccionesCreditoDias_claves_autorizacion_cuentas_cobrar">Días de crédito</label>
								</div>
								<div class="col-md-12">
									<input 	class="form-control" 
											id="txtRefaccionesCreditoDias_claves_autorizacion_cuentas_cobrar"
										   	name="intRefaccionesCreditoDias_claves_autorizacion_cuentas_cobrar" 
										   	type="text" 
										   	value="" 
										   	disabled />
								</div>
							</div>
						</div>
						<!--Saldo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSaldoRefacciones_claves_autorizacion_cuentas_cobrar">Saldo</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_claves_autorizacion_cuentas_cobrar" id="txtSaldoRefacciones_claves_autorizacion_cuentas_cobrar" 
												name="intSaldoRefacciones_claves_autorizacion_cuentas_cobrar" type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
						<!--Saldo vencido-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSaldoVencidoRefacciones_claves_autorizacion_cuentas_cobrar">Saldo vencido</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_claves_autorizacion_cuentas_cobrar" id="txtSaldoVencidoRefacciones_claves_autorizacion_cuentas_cobrar" 
												name="intSaldoVencidoRefacciones_claves_autorizacion_cuentas_cobrar" type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<h4>Servicio</h4>
						</div>	
					</div>
					<div class="row">
						<!--Límite de crédito-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtServicioCreditoLimite_claves_autorizacion_cuentas_cobrar">Límite de crédito</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_claves_autorizacion_cuentas_cobrar" id="txtServicioCreditoLimite_claves_autorizacion_cuentas_cobrar" 
												name="intServicioCreditoLimite_claves_autorizacion_cuentas_cobrar" type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
						<!--Días de crédito-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtServicioCreditoDias_claves_autorizacion_cuentas_cobrar">Días de crédito</label>
								</div>
								<div class="col-md-12">
									<input 	class="form-control" 
											id="txtServicioCreditoDias_claves_autorizacion_cuentas_cobrar"
										   	name="intServicioCreditoDias_claves_autorizacion_cuentas_cobrar" 
										   	type="text" 
										   	value="" 
										   	disabled />
								</div>
							</div>
						</div>
						<!--Saldo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSaldoServicio_claves_autorizacion_cuentas_cobrar">Saldo</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_claves_autorizacion_cuentas_cobrar" id="txtSaldoServicio_claves_autorizacion_cuentas_cobrar" 
												name="intSaldoServicio_claves_autorizacion_cuentas_cobrar" type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
						<!--Saldo vencido-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSaldoVencidoServicio_claves_autorizacion_cuentas_cobrar">Saldo vencido</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_claves_autorizacion_cuentas_cobrar" id="txtSaldoVencidoServicio_claves_autorizacion_cuentas_cobrar" 
												name="intSaldoVencidoServicio_claves_autorizacion_cuentas_cobrar" type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Fecha inicial-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicial_claves_autorizacion_cuentas_cobrar">Fecha inicial</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaInicial_claves_autorizacion_cuentas_cobrar'>
					                    <input class="form-control" id="txtFechaInicial_claves_autorizacion_cuentas_cobrar"
					                    		name= "strFechaInicial_claves_autorizacion_cuentas_cobrar" 
					                    		type="text" 
					                    		value="" 
					                    		tabindex="1" 
					                    		placeholder="Ingrese fecha" maxlength="10" />
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
									<label for="txtFechaFinal_claves_autorizacion_cuentas_cobrar">Fecha final</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaFinal_claves_autorizacion_cuentas_cobrar'>
					                    <input class="form-control" id="txtFechaFinal_claves_autorizacion_cuentas_cobrar"
					                    		name= "strFechaFinal_claves_autorizacion_cuentas_cobrar" 
					                    		type="text" 
					                    		value="" 
					                    		tabindex="1" 
					                    		placeholder="Ingrese fecha" maxlength="10" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Botón para imprimir Estado de Cuenta-->
                      	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                        	<div class="form-group">
                      			<div class="col-md-12">
                      				<button class="btn btn-default btn-toolBtns" 
		                        			id="btnImprimirEstadoCuenta_claves_autorizacion_cuentas_cobrar"
		                        			onclick="reporte_estado_cuenta_claves_autorizacion_cuentas_cobrar();" 
		                        	     	title="Imprimir estado de cuenta" tabindex="1"> 
		                        			<i class="glyphicon glyphicon-print"></i> Estado de cuenta
		                        	</button>
                      			</div>
                      		</div>		
                     	</div>
                     	<!--Botón para generar clave-->
                      	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                        	<div class="form-group">
                      			<div class="col-md-12">
                      				<button class="btn btn-success btn-toolBtns" 
		                        			id="btnGenerarClave_claves_autorizacion_cuentas_cobrar"
		                        			onclick="generar_clave_autorizacion_cuentas_cobrar();" 
		                        	     	title="Generar clave" tabindex="1"> 
		                        			<i class="fa fa-key"></i>    Generar clave   
		                        	</button>
                      			</div>
                      		</div>	
                     	</div>
                     	<!--Clave generada-->
                     	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                     		<div class="form-group">
								<div class="col-md-12">
									<label for="txtClaveGenerada_claves_autorizacion_cuentas_cobrar">Clave generada</label>
								</div>
								<div class="col-md-12">
									<input 	class="form-control" 
											id="txtClaveGenerada_claves_autorizacion_cuentas_cobrar"
										   	name="strClaveGenerada_claves_autorizacion_cuentas_cobrar" 
										   	type="text" 
										   	value="" minlength="0"  maxlength="0" onclick="desactivar_clave_claves_autorizacion_cuentas_cobrar(event);"/>
								</div>
							</div>
                     	</div>	
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" 
									id="btnGuardar_claves_autorizacion_cuentas_cobrar"  
									onclick="validar_claves_autorizacion_cuentas_cobrar();"  
									title="Guardar" 
									tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  
									id="btnCerrar_claves_autorizacion_cuentas_cobrar"
									type="reset" 
									aria-hidden="true" 
									onclick="cerrar_claves_autorizacion_cuentas_cobrar();" 
									title="Cerrar"  
									tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Ordenes de Compra-->
	</div><!--#GenerarClavesAutorizacionCuentasCobrarContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaGenerarClavesAutorizacionCuentasCobrar = 0;
		var strUltimaBusquedaGenerarClavesAutorizacionCuentasCobrar = "";
		//Variable que se utiliza para asignar objeto del modal
		var objGenerarClavesAutorizacionCuentasCobrar = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_claves_autorizacion_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_cobrar/claves_autorizacion/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_claves_autorizacion_cuentas_cobrar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosGenerarClavesAutorizacionCuentasCobrar = data.row;
					//Separar la cadena 
					var arrPermisosGenerarClavesAutorizacionCuentasCobrar = strPermisosGenerarClavesAutorizacionCuentasCobrar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosGenerarClavesAutorizacionCuentasCobrar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosGenerarClavesAutorizacionCuentasCobrar[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_claves_autorizacion_cuentas_cobrar').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosGenerarClavesAutorizacionCuentasCobrar[i]=='GUARDAR') || (arrPermisosGenerarClavesAutorizacionCuentasCobrar[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_claves_autorizacion_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosGenerarClavesAutorizacionCuentasCobrar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_claves_autorizacion_cuentas_cobrar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_claves_autorizacion_cuentas_cobrar();
						}
						else if(arrPermisosGenerarClavesAutorizacionCuentasCobrar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_claves_autorizacion_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosGenerarClavesAutorizacionCuentasCobrar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_claves_autorizacion_cuentas_cobrar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}


		//Función para la búsqueda de registros
		function paginacion_claves_autorizacion_cuentas_cobrar() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaGenerarClavesAutorizacionCuentasCobrar =($('#txtFechaInicialBusq_claves_autorizacion_cuentas_cobrar').val()+$('#txtFechaFinalBusq_claves_autorizacion_cuentas_cobrar').val()+$('#txtProspectoIDBusq_claves_autorizacion_cuentas_cobrar').val()+$('#txtBusqueda_claves_autorizacion_cuentas_cobrar').val());

			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaGenerarClavesAutorizacionCuentasCobrar != strUltimaBusquedaGenerarClavesAutorizacionCuentasCobrar)
			{
				intPaginaGenerarClavesAutorizacionCuentasCobrar = 0;
				strUltimaBusquedaGenerarClavesAutorizacionCuentasCobrar = strNuevaBusquedaGenerarClavesAutorizacionCuentasCobrar;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/claves_autorizacion/get_paginacion',
					{
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 	dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_claves_autorizacion_cuentas_cobrar').val()),
					 	dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_claves_autorizacion_cuentas_cobrar').val()),
					 	intProspectoID: $('#txtProspectoIDBusq_claves_autorizacion_cuentas_cobrar').val(),
					 	strBusqueda: $('#txtBusqueda_claves_autorizacion_cuentas_cobrar').val(),
					 	intPagina: intPaginaGenerarClavesAutorizacionCuentasCobrar
					},
					function(data){
						$('#dg_claves_autorizacion_cuentas_cobrar tbody').empty();
						var tmpGenerarClavesAutorizacionCuentasCobrar = Mustache.render($('#plantilla_claves_autorizacion_cuentas_cobrar').html(),data);
						$('#dg_claves_autorizacion_cuentas_cobrar tbody').html(tmpGenerarClavesAutorizacionCuentasCobrar);
						$('#pagLinks_claves_autorizacion_cuentas_cobrar').html(data.paginacion);
						$('#numElementos_claves_autorizacion_cuentas_cobrar').html(data.total_rows);
						intPaginaGenerarClavesAutorizacionCuentasCobrar = data.pagina;
					},
			'json');
		}

		
		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_claves_autorizacion_cuentas_cobrar(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_cobrar/claves_autorizacion/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_claves_autorizacion_cuentas_cobrar').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_claves_autorizacion_cuentas_cobrar').val()),
										'intProspectoID': $('#txtProspectoIDBusq_claves_autorizacion_cuentas_cobrar').val(),
										'strBusqueda': $('#txtBusqueda_claves_autorizacion_cuentas_cobrar').val(),

									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		//Función para cargar el reporte estado de cuenta
		function reporte_estado_cuenta_claves_autorizacion_cuentas_cobrar() 
		{				
			 //Agregar lista de sucursales activas
			 var strSucursales = sucursales_activas_claves_autorizacion_cuentas_cobrar();
			 //Asignar lista de modulos (crédito de cliente)
			 var strModulos = 'MAQUINARIA|REFACCIONES|SERVICIO';

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'cuentas_cobrar/rep_estado_cuenta/get_reporte',
							'data' : { 
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicial_claves_autorizacion_cuentas_cobrar').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinal_claves_autorizacion_cuentas_cobrar').val()),
										'intProspectoID': $('#txtProspectoID_claves_autorizacion_cuentas_cobrar').val(),
										'strSucursales': strSucursales, 
										'strModulos': strModulos

									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}

		//Función para obtener las sucursales activas (para la impresión del estado de cuenta)
		function sucursales_activas_claves_autorizacion_cuentas_cobrar()
		{

				//Declaramos el arreglo  que contendrá las sucursales activas
				var chkSucursalesArray = [];
				//Variable que se utiliza para asignar sucursales activas (lista)
				var strSucursales = '';

				//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
	            $.ajax({
					        url: 'administracion/sucursales/get_combo_box',
					        method:'post',
					        dataType: 'json',
					        async: false,
					        data: { },
					        success: function (data) {
					          	if(data.sucursales){
					          	//Variable que se utiliza para contar el número de registros
					          	 var intCont;
					          	  //Hacer recorrido para obtener el id de la sucursal
			                      for (intCont = 0; intCont < data.sucursales.length; intCont++) 
			                      { 
										chkSucursalesArray.push(data.sucursales[intCont].value);

									}
					  			  
			                    }

					        }
					    });


				//Unimos los valores seleccionados con un '|'
				strSucursales = chkSucursalesArray.join('|');
				
				//Regresar lista de sucursales activas
				return strSucursales;

		}
		
		



		/*******************************************************************************************************************
		Funciones del modal 
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_claves_autorizacion_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmGenerarClavesAutorizacionCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_claves_autorizacion_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmGenerarClavesAutorizacionCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_claves_autorizacion_cuentas_cobrar');

			//Mostrar los siguientes botones
			$("#btnGuardar_claves_autorizacion_cuentas_cobrar").show();

			//Deshabilitar botón de impresión estado de cuenta
			habilitar_elementos_estado_cuenta_claves_autorizacion_cuentas_cobrar('');

		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_claves_autorizacion_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objGenerarClavesAutorizacionCuentasCobrar.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_claves_autorizacion_cuentas_cobrar').focus();
				
			}
			catch(err) {}
		}


		//Función para generar la clave de autorización
		function generar_clave_autorizacion_cuentas_cobrar() 
		{
			//Hacer un llamado a la función para obtener clave de autorización aleatoria
			$('#txtClaveGenerada_claves_autorizacion_cuentas_cobrar').val(claveAutorizacion());

		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_claves_autorizacion_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_claves_autorizacion_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmGenerarClavesAutorizacionCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	
										strRazonSocial_claves_autorizacion_cuentas_cobrar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del cliente
					                                    if($('#txtProspectoID_claves_autorizacion_cuentas_cobrar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un cliente existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strClaveGenerada_claves_autorizacion_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Es necesario generar una clave de autorización'}
											}
										},
										strFechaInicial_claves_autorizacion_cuentas_cobrar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaFinal_claves_autorizacion_cuentas_cobrar: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_claves_autorizacion_cuentas_cobrar = $('#frmGenerarClavesAutorizacionCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_claves_autorizacion_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_claves_autorizacion_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_claves_autorizacion_cuentas_cobrar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_claves_autorizacion_cuentas_cobrar()
		{
			try
			{
				$('#frmGenerarClavesAutorizacionCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_claves_autorizacion_cuentas_cobrar()
		{

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_cobrar/claves_autorizacion/guardar',
					{ 
						//Datos de la clave generada
						intClaveAutorizacionID: $('#txtClaveAutorizacionID_claves_autorizacion_cuentas_cobrar').val(),
						intProspectoID: $('#txtProspectoID_claves_autorizacion_cuentas_cobrar').val(),
						strClaveGenerada: $('#txtClaveGenerada_claves_autorizacion_cuentas_cobrar').val()
					},
					function(data) {
						if (data.resultado)
						{

							//Hacer llamado a la función  para cargar  los registros en el grid
	               			paginacion_claves_autorizacion_cuentas_cobrar(); 
							//Hacer un llamado a la función para cerrar modal
	                    	cerrar_claves_autorizacion_cuentas_cobrar();
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_claves_autorizacion_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					},
			'json');
			
			
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_claves_autorizacion_cuentas_cobrar(tipoMensaje, mensaje, campoID)
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
													$('#'+campoID).focus();
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

		//Función para inicializar elementos del cliente
		function inicializar_cliente_claves_autorizacion_cuentas_cobrar()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#txtMaquinariaCreditoLimite_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtMaquinariaCreditoDias_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtSaldoMaquinaria_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtSaldoVencidoMaquinaria_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtRefaccionesCreditoLimite_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtRefaccionesCreditoDias_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtSaldoRefacciones_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtSaldoVencidoRefacciones_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtServicioCreditoLimite_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtServicioCreditoDias_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtSaldoServicio_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtSaldoVencidoServicio_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtSaldo_claves_autorizacion_cuentas_cobrar").val('');
            $("#txtSaldoVencido_claves_autorizacion_cuentas_cobrar").val('');
            //Deshabilitar botón de impresión estado de cuenta
			habilitar_elementos_estado_cuenta_claves_autorizacion_cuentas_cobrar();
		}

	   
	   //Función para habilitar y deshabilitar los campos del detalle cuando cambia prospecto y rango de fechas
		function habilitar_elementos_estado_cuenta_claves_autorizacion_cuentas_cobrar()
		{
			//Deshabilitar o habilitar las siguientes cajas de texto			
			data  = {
						//Son los id de los input que quiere deshabilitar o habilitar
						rows:[
							'#btnImprimirEstadoCuenta_claves_autorizacion_cuentas_cobrar',							
						],
						//Es asignar un attributo disbaled|checked
						attribute: 'disabled',									
					};		


			if($("#txtProspectoID_claves_autorizacion_cuentas_cobrar").val() != '' &&
			    $("#txtFechaInicial_claves_autorizacion_cuentas_cobrar").val() != '' &&
			    $("#txtFechaFinal_claves_autorizacion_cuentas_cobrar").val() != '')
			{
				data.bool= false;	
			}
			else
			{
				data.bool= true;	
			}



			//La function para deshabilitar o abilitar el input porque les estamos mando un true		
			$.habilitar_deshabilitar_campos(data);

		   
		}



		//Función para regresar y obtener los datos de un cliente
		function get_datos_cliente_claves_autorizacion_cuentas_cobrar()
		{
		 	//Hacer un llamado al método del controlador para regresar los datos del cliente
            $.post('caja/pagos/get_saldos_cliente',
                  { 
                  	intProspectoID:$("#txtProspectoID_claves_autorizacion_cuentas_cobrar").val()
                  },
                  function(data) {	                  	
                    if(data.row){
                       //Asignar datos del registro seleccionado
                       //Maquinaria
                       $("#txtMaquinariaCreditoLimite_claves_autorizacion_cuentas_cobrar").val(data.row.maquinaria_credito_limite);
                       $("#txtMaquinariaCreditoDias_claves_autorizacion_cuentas_cobrar").val(data.row.maquinaria_credito_dias);
                       $("#txtSaldoMaquinaria_claves_autorizacion_cuentas_cobrar").val(data.saldo_maquinaria);
                       $("#txtSaldoVencidoMaquinaria_claves_autorizacion_cuentas_cobrar").val(data.saldo_vencido_maquinaria);

                       //Refacciones
                       $("#txtRefaccionesCreditoLimite_claves_autorizacion_cuentas_cobrar").val(data.row.refacciones_credito_limite);
                       $("#txtRefaccionesCreditoDias_claves_autorizacion_cuentas_cobrar").val(data.row.refacciones_credito_dias);
                       $("#txtSaldoRefacciones_claves_autorizacion_cuentas_cobrar").val(data.saldo_refacciones);
                       $("#txtSaldoVencidoRefacciones_claves_autorizacion_cuentas_cobrar").val(data.saldo_vencido_refacciones);

 					   //Servicio
                       $("#txtServicioCreditoLimite_claves_autorizacion_cuentas_cobrar").val(data.row.servicio_credito_limite);
                       $("#txtServicioCreditoDias_claves_autorizacion_cuentas_cobrar").val(data.row.servicio_credito_dias);
                       $("#txtSaldoServicio_claves_autorizacion_cuentas_cobrar").val(data.saldo_servicio);
                       $("#txtSaldoVencidoServicio_claves_autorizacion_cuentas_cobrar").val(data.saldo_vencido_servicio);

                       //Saldo General
                       $("#txtSaldo_claves_autorizacion_cuentas_cobrar").val(data.acumulado_saldo);
                       $("#txtSaldoVencido_claves_autorizacion_cuentas_cobrar").val(data.acumulado_saldo_vencido);

                        //Habilitar botón de impresión estado de cuenta
                        habilitar_elementos_estado_cuenta_claves_autorizacion_cuentas_cobrar();


                    }
                  }
                 ,
                'json');

		}

		//Función para evitar que el usuario introduzca clave (en la caja de texto)
		function desactivar_clave_claves_autorizacion_cuentas_cobrar(evt) 
		{
			//Enfocar botón Guardar
			$('#btnGuardar_claves_autorizacion_cuentas_cobrar').focus();
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/********************************************************************************************************************
			Controles correspondientes al modal Generar Clave de Autorización
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFechaInicial_claves_autorizacion_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_claves_autorizacion_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY'});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_claves_autorizacion_cuentas_cobrar').blur(function(){
				$('.moneda_claves_autorizacion_cuentas_cobrar').formatCurrency({ roundToDecimalPlace: 2 });
			});
			
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicial_claves_autorizacion_cuentas_cobrar').focusout(function(e) {
				
				 //Habilitar botón de impresión estado de cuenta
                habilitar_elementos_estado_cuenta_claves_autorizacion_cuentas_cobrar();

			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_claves_autorizacion_cuentas_cobrar').focusout(function(e) {
				//Habilitar botón de impresión estado de cuenta
				habilitar_elementos_estado_cuenta_claves_autorizacion_cuentas_cobrar();
			});



	        //Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_claves_autorizacion_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_claves_autorizacion_cuentas_cobrar').val('');
	               //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_claves_autorizacion_cuentas_cobrar();
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
	             $('#txtProspectoID_claves_autorizacion_cuentas_cobrar').val(ui.item.data);
	             //Hacer un llamado a la función para regresar los datos del cliente
	           	 get_datos_cliente_claves_autorizacion_cuentas_cobrar();
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
	        $('#txtRazonSocial_claves_autorizacion_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_claves_autorizacion_cuentas_cobrar').val() == '' ||
	               $('#txtRazonSocial_claves_autorizacion_cuentas_cobrar').val() == '')
	            { 
	            	//Limpiar contenido de las siguientes cajas de texto
	            	$('#txtProspectoID_claves_autorizacion_cuentas_cobrar').val('');
	            	$('#txtRazonSocial_claves_autorizacion_cuentas_cobrar').val('');
	                //Hacer un llamado a la función para inicializar elementos del cliente
	                inicializar_cliente_claves_autorizacion_cuentas_cobrar();
	            }
	        });

	   
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_claves_autorizacion_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_claves_autorizacion_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_claves_autorizacion_cuentas_cobrar').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_claves_autorizacion_cuentas_cobrar').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_claves_autorizacion_cuentas_cobrar').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_claves_autorizacion_cuentas_cobrar').data('DateTimePicker').maxDate(e.date);
			});


            //Autocomplete para recuperar los datos de un proveedor 
	        $('#txtRazonSocialBusq_claves_autorizacion_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_claves_autorizacion_cuentas_cobrar').val('');
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
	             $('#txtProspectoIDBusq_claves_autorizacion_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_claves_autorizacion_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProspectoIDBusq_claves_autorizacion_cuentas_cobrar').val() == '' ||
	               $('#txtRazonSocialBusq_claves_autorizacion_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_claves_autorizacion_cuentas_cobrar').val('');
	               $('#txtRazonSocialBusq_claves_autorizacion_cuentas_cobrar').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_claves_autorizacion_cuentas_cobrar').on('click','a',function(event){
				event.preventDefault();
				intPaginaGenerarClavesAutorizacionCuentasCobrar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_claves_autorizacion_cuentas_cobrar();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_claves_autorizacion_cuentas_cobrar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_claves_autorizacion_cuentas_cobrar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_claves_autorizacion_cuentas_cobrar').addClass("estatus-NUEVO");
				//Abrir modal
				 objGenerarClavesAutorizacionCuentasCobrar = $('#GenerarClavesAutorizacionCuentasCobrarBox').bPopup({
												   appendTo: '#GenerarClavesAutorizacionCuentasCobrarContent', 
					                               contentContainer: 'GenerarClavesAutorizacionCuentasCobrarM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtRazonSocial_claves_autorizacion_cuentas_cobrar').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_claves_autorizacion_cuentas_cobrar').focus();

			
			
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_claves_autorizacion_cuentas_cobrar();
		});
	</script>