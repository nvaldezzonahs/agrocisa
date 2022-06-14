
	<div id="AmpliarPlazosCreditoCuentasCobrarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form-horizontal" id="frmBusqueda_ampliar_plazos_credito_cuentas_cobrar" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_ampliar_plazos_credito_cuentas_cobrar">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_ampliar_plazos_credito_cuentas_cobrar'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_ampliar_plazos_credito_cuentas_cobrar"
				                    		name= "strFechaInicialBusq_ampliar_plazos_credito_cuentas_cobrar" 
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
								<label for="txtFechaFinalBusq_ampliar_plazos_credito_cuentas_cobrar">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_ampliar_plazos_credito_cuentas_cobrar'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_ampliar_plazos_credito_cuentas_cobrar"
				                    		name= "strFechaFinalBusq_ampliar_plazos_credito_cuentas_cobrar" 
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
								<input id="txtProspectoIDBusq_ampliar_plazos_credito_cuentas_cobrar" 
									   name="intProspectoIDBusq_ampliar_plazos_credito_cuentas_cobrar"  type="hidden" 
									   value="">
								</input>
								<label for="txtRazonSocialBusq_ampliar_plazos_credito_cuentas_cobrar">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocialBusq_ampliar_plazos_credito_cuentas_cobrar" 
										name="strRazonSocialBusq_ampliar_plazos_credito_cuentas_cobrar" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Tipo de referencia-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbTipoReferenciaBusq_ampliar_plazos_credito_cuentas_cobrar">Tipo</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbTipoReferenciaBusq_ampliar_plazos_credito_cuentas_cobrar" 
								 		name="strTipoReferenciaBusq_ampliar_plazos_credito_cuentas_cobrar" tabindex="1">
								    <option value="TODOS">TODOS</option>
                      				<option value="MAQUINARIA">MAQUINARIA</option>
                      				<option value="REFACCIONES">REFACCIONES</option>
                      				<option value="SERVICIO">SERVICIO</option>
                      				<option value="CARTERA">CARTERA</option>
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
								<label for="txtBusqueda_ampliar_plazos_credito_cuentas_cobrar">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_ampliar_plazos_credito_cuentas_cobrar" 
										name="strBusqueda_ampliar_plazos_credito_cuentas_cobrar" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!-- Buscar registros -->
							<button class="btn btn-primary" id="btnBuscar_ampliar_plazos_credito_cuentas_cobrar"
									onclick="paginacion_ampliar_plazos_credito_cuentas_cobrar();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_ampliar_plazos_credito_cuentas_cobrar" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_ampliar_plazos_credito_cuentas_cobrar"
									onclick="reporte_ampliar_plazos_credito_cuentas_cobrar('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_ampliar_plazos_credito_cuentas_cobrar"
									onclick="reporte_ampliar_plazos_credito_cuentas_cobrar('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Tipo"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Razón social"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Vencimiento"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Nuevo VCTO."; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Autoriza"; font-weight: bold;}
				td.movil:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_ampliar_plazos_credito_cuentas_cobrar">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Tipo</th>
							<th class="movil">Razón social</th>
							<th class="movil">Vencimiento</th>
							<th class="movil">Nuevo VCTO.</th>
							<th class="movil">Autoriza</th>
							<th class="movil" id="th-acciones" style="width:4em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_ampliar_plazos_credito_cuentas_cobrar" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{folio}}</td>
							<td class="movil">{{tipo_referencia}}</td>
							<td class="movil">{{razon_social}}</td>
							<td class="movil">{{vencimiento}}</td>
							<td class="movil">{{nuevo_vencimiento}}</td>
							<td class="movil">{{empleado_autorizacion}}</td>
							<td class="td-center movil"> 
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="ver_ampliar_plazos_credito_cuentas_cobrar({{ampliar_plazo_credito_id}}, '{{tipo_referencia}}', {{referencia_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ampliar_plazos_credito_cuentas_cobrar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_ampliar_plazos_credito_cuentas_cobrar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="AmpliarPlazosCreditoCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_ampliar_plazos_credito_cuentas_cobrar"  class="ModalBodyTitle">
			<h1>Ampliar Plazo de Crédito</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAmpliarPlazosCreditoCuentasCobrar" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmAmpliarPlazosCreditoCuentasCobrar"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Autocomplete que contiene las facturas (maquinaria/servicio/refacciones) activas-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la factura /pedido de maquinaria seleccionada-->
									<input id="txtReferenciaID_ampliar_plazos_credito_cuentas_cobrar" 
										   name="intReferenciaID_ampliar_plazos_credito_cuentas_cobrar"  
										   type="hidden"  value="">
									</input>
									<label for="txtReferencia_ampliar_plazos_credito_cuentas_cobrar">Folio</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtReferencia_ampliar_plazos_credito_cuentas_cobrar" 
											name="strReferencia_ampliar_plazos_credito_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese factura" maxlength="250">
									</input>
								</div>
							</div>	
						</div>
						<!--Tipo de referencia-->
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="txtTipoReferencia_ampliar_plazos_credito_cuentas_cobrar">Tipo</label>
                                </div>  
                                <div class="col-md-12">
                                    <input  class="form-control" 
                                            id="txtTipoReferencia_ampliar_plazos_credito_cuentas_cobrar" 
                                            name="strTipoReferencia_ampliar_plazos_credito_cuentas_cobrar" 
                                            type="text" value="" disabled>
                                    </input>
                                </div>
                            </div>
                        </div>
						<!--Fecha-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_ampliar_plazos_credito_cuentas_cobrar">Fecha</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtFecha_ampliar_plazos_credito_cuentas_cobrar" 
											name="strFecha_ampliar_plazos_credito_cuentas_cobrar" 
											type="text" value="" disabled>
								    </input>
								</div>
							</div>	
						</div>
						<!--Fecha de Vencimiento-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaVencimiento_ampliar_plazos_credito_cuentas_cobrar">Vencimiento</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtFechaVencimiento_ampliar_plazos_credito_cuentas_cobrar" 
											name="strFechaVencimiento_ampliar_plazos_credito_cuentas_cobrar" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>	
						</div>
						<!--Moneda-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMoneda_ampliar_plazos_credito_cuentas_cobrar">Moneda</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMoneda_ampliar_plazos_credito_cuentas_cobrar" 
											name="strMoneda_ampliar_plazos_credito_cuentas_cobrar" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_ampliar_plazos_credito_cuentas_cobrar">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTipoCambio_ampliar_plazos_credito_cuentas_cobrar" 
											name="intTipoCambio_ampliar_plazos_credito_cuentas_cobrar" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Razón social del cliente-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtRazonSocial_ampliar_plazos_credito_cuentas_cobrar">Razón social</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtRazonSocial_ampliar_plazos_credito_cuentas_cobrar" 
											name="strCliente_ampliar_plazos_credito_cuentas_cobrar" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Importe-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporte_ampliar_plazos_credito_cuentas_cobrar">Importe</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control" id="txtImporte_ampliar_plazos_credito_cuentas_cobrar" 
												name="intImporte_ampliar_plazos_credito_cuentas_cobrar" type="text" value="" disabled>
										</input>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				    <!--Div que contiene los campos del tipo de pago (forma de pago del pedido de maquinaria)-->
					<div id="DivTipoPago_ampliar_plazos_credito_cuentas_cobrar">
						<div class="row">
							<!--Autocomplete que contiene los documentos de pago activos-->
							<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta para recuperar el id del documento de pago seleccionado-->
										<input id="txtNuevoDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar" 
											   name="intNuevoDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar" 
											   type="hidden" value="">
									    </input>
										<label for="txtNuevoDocumentoPago_ampliar_plazos_credito_cuentas_cobrar">Nuevo tipo de pago</label>
									</div>
									<div class="col-md-12">
										<input 	class="form-control" 
												id="txtNuevoDocumentoPago_ampliar_plazos_credito_cuentas_cobrar"
											   	name="strNuevoDocumentoPago_ampliar_plazos_credito_cuentas_cobrar" 
											   	type="text" value="" tabindex="1" 
											   	placeholder="Ingrese tipo de pago" maxlength="250">
									   </input>
									</div>
								</div>
							</div>
							<!--Tipo de pago anterior-->
							<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
								<div class="form-group">
									<div class="col-md-12">
										<!-- Caja de texto oculta para ocultar el renglón de la forma de pago (pedido de maquinaria) que será modificada-->
										<input id="txtRenglon_ampliar_plazos_credito_cuentas_cobrar" 
											   name="intRenglon_ampliar_plazos_credito_cuentas_cobrar" 
											   type="hidden" value="">
										</input>
										<!-- Caja de texto oculta para recuperar el id del tipo de pago de la forma de pago (pedido de maquinaria) que será modificada-->
										<input id="txtDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar" 
											   name="intDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar" 
											   type="hidden" value="">
									    </input>
										<label for="txtDocumentoPago_ampliar_plazos_credito_cuentas_cobrar">Tipo de pago</label>
									</div>	
									<div class="col-md-12">
										<input  class="form-control" 
												id="txtDocumentoPago_ampliar_plazos_credito_cuentas_cobrar" 
												name="strDocumentoPago_ampliar_plazos_credito_cuentas_cobrar" 
												type="text" value="" disabled>
										</input>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Días-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDias_ampliar_plazos_credito_cuentas_cobrar">Días</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtDias_ampliar_plazos_credito_cuentas_cobrar" 
											name="intDias_ampliar_plazos_credito_cuentas_cobrar" 
											type="text" value="" tabindex="1" placeholder="Ingrese días" maxlength="11">
									</input>
								</div>
							</div>	
						</div>
						<!--Nueva fecha de vencimiento-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaNuevoVencimiento_ampliar_plazos_credito_cuentas_cobrar">Nuevo vencimiento</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtFechaNuevoVencimiento_ampliar_plazos_credito_cuentas_cobrar" 
											name="strFechaNuevoVencimiento_ampliar_plazos_credito_cuentas_cobrar" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>	
						</div>
                        <!--Empleado que autoriza-->
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="txtEmpleadoAutorizacion_ampliar_plazos_credito_cuentas_cobrar">Autoriza</label>
                                </div>  
                                <div class="col-md-12">
                                    <input  class="form-control" 
                                            id="txtEmpleadoAutorizacion_ampliar_plazos_credito_cuentas_cobrar" 
                                            name="strEmpleadoAutorizacion_ampliar_plazos_credito_cuentas_cobrar" 
                                            type="text" value="" disabled>
                                    </input>
                                </div>
                            </div>
                        </div>
                    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_ampliar_plazos_credito_cuentas_cobrar"  
									onclick="validar_ampliar_plazos_credito_cuentas_cobrar();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_ampliar_plazos_credito_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_ampliar_plazos_credito_cuentas_cobrar();" 
									title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#AmpliarPlazosCreditoCuentasCobrarContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaAmpliarPlazosCreditoCuentasCobrar = 0;
		var strUltimaBusquedaAmpliarPlazosCreditoCuentasCobrar = "";
		//Variables que se utilizan para la búsqueda de registros
		var intProspectoIDAmpliarPlazosCreditoCuentasCobrar = "";
		var dteFechaInicialAmpliarPlazosCreditoCuentasCobrar = "";
		var dteFechaFinalAmpliarPlazosCreditoCuentasCobrar = "";
		//Variable que se utiliza para asignar objeto del modal
		var objAmpliarPlazosCreditoCuentasCobrar = null;
		//Array que contiene los id´s de las cajas de texto que se utilizan para calcular la fecha de vencimiento
		var arrFechaVencimientoAmpliarPlazosCreditoCuentasCobrar  = {fecha: '#txtFechaVencimiento_ampliar_plazos_credito_cuentas_cobrar',
																 tipo: 'VENCIMIENTO',
																 diasCredito: 	'#txtDias_ampliar_plazos_credito_cuentas_cobrar',
																 fechaVencimiento: 	'#txtFechaNuevoVencimiento_ampliar_plazos_credito_cuentas_cobrar'
																};

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_ampliar_plazos_credito_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_cobrar/ampliar_plazos_credito/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_ampliar_plazos_credito_cuentas_cobrar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosAmpliarPlazosCreditoCuentasCobrar = data.row;
					//Separar la cadena 
					var arrPermisosAmpliarPlazosCreditoCuentasCobrar = strPermisosAmpliarPlazosCreditoCuentasCobrar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosAmpliarPlazosCreditoCuentasCobrar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosAmpliarPlazosCreditoCuentasCobrar[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_ampliar_plazos_credito_cuentas_cobrar').removeAttr('disabled');
						}
						//Si el indice es GUARDAR
						else if(arrPermisosAmpliarPlazosCreditoCuentasCobrar[i]=='GUARDAR')
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_ampliar_plazos_credito_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosAmpliarPlazosCreditoCuentasCobrar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_ampliar_plazos_credito_cuentas_cobrar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_ampliar_plazos_credito_cuentas_cobrar();
						}
						else if(arrPermisosAmpliarPlazosCreditoCuentasCobrar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_ampliar_plazos_credito_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosAmpliarPlazosCreditoCuentasCobrar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_ampliar_plazos_credito_cuentas_cobrar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_ampliar_plazos_credito_cuentas_cobrar() 
		{
		   //Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaAmpliarPlazosCreditoCuentasCobrar =($('#txtFechaInicialBusq_ampliar_plazos_credito_cuentas_cobrar').val()+$('#txtFechaFinalBusq_ampliar_plazos_credito_cuentas_cobrar').val()+$('#txtProspectoIDBusq_ampliar_plazos_credito_cuentas_cobrar').val()+$('#cmbTipoReferenciaBusq_ampliar_plazos_credito_cuentas_cobrar').val()+$('#txtBusqueda_ampliar_plazos_credito_cuentas_cobrar').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaAmpliarPlazosCreditoCuentasCobrar != strUltimaBusquedaAmpliarPlazosCreditoCuentasCobrar)
			{
				intPaginaAmpliarPlazosCreditoCuentasCobrar = 0;
				strUltimaBusquedaAmpliarPlazosCreditoCuentasCobrar = strNuevaBusquedaAmpliarPlazosCreditoCuentasCobrar;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/ampliar_plazos_credito/get_paginacion',
					{ //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					  dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_ampliar_plazos_credito_cuentas_cobrar').val()),
					  dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_ampliar_plazos_credito_cuentas_cobrar').val()),
					  intProspectoID: $('#txtProspectoIDBusq_ampliar_plazos_credito_cuentas_cobrar').val(),
					  strTipoReferencia: $('#cmbTipoReferenciaBusq_ampliar_plazos_credito_cuentas_cobrar').val(),
					  strBusqueda: $('#txtBusqueda_ampliar_plazos_credito_cuentas_cobrar').val(),
					  intPagina: intPaginaAmpliarPlazosCreditoCuentasCobrar,
					  strPermisosAcceso: $('#txtAcciones_ampliar_plazos_credito_cuentas_cobrar').val()
					},
					function(data){
						$('#dg_ampliar_plazos_credito_cuentas_cobrar tbody').empty();
						var tmpAmpliarPlazosCreditoCuentasCobrar = Mustache.render($('#plantilla_ampliar_plazos_credito_cuentas_cobrar').html(),data);
						$('#dg_ampliar_plazos_credito_cuentas_cobrar tbody').html(tmpAmpliarPlazosCreditoCuentasCobrar);
						$('#pagLinks_ampliar_plazos_credito_cuentas_cobrar').html(data.paginacion);
						$('#numElementos_ampliar_plazos_credito_cuentas_cobrar').html(data.total_rows);
						intPaginaAmpliarPlazosCreditoCuentasCobrar = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_ampliar_plazos_credito_cuentas_cobrar(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_cobrar/ampliar_plazos_credito/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_ampliar_plazos_credito_cuentas_cobrar').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_ampliar_plazos_credito_cuentas_cobrar').val()),
										'intProspectoID':  $('#txtProspectoIDBusq_ampliar_plazos_credito_cuentas_cobrar').val(),
										'strTipoReferencia': $('#cmbTipoReferenciaBusq_ampliar_plazos_credito_cuentas_cobrar').val(),
										'strBusqueda': $('#txtBusqueda_ampliar_plazos_credito_cuentas_cobrar').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_ampliar_plazos_credito_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmAmpliarPlazosCreditoCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ampliar_plazos_credito_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmAmpliarPlazosCreditoCuentasCobrar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_ampliar_plazos_credito_cuentas_cobrar');
			//Ocultar Div que contiene los campos del tipo de gato (forma de pago del pedido de maquinaria)
	       	$('#DivTipoPago_ampliar_plazos_credito_cuentas_cobrar').hide();
			//Habilitar las siguientes cajas de texto
		    $('#txtReferencia_ampliar_plazos_credito_cuentas_cobrar').removeAttr('disabled');
		    $('#txtNuevoDocumentoPago_ampliar_plazos_credito_cuentas_cobrar').removeAttr('disabled');
		    $('#txtDias_ampliar_plazos_credito_cuentas_cobrar').removeAttr('disabled');
 			//Mostrar los siguientes botones
			$("#btnGuardar_ampliar_plazos_credito_cuentas_cobrar").show();
		}
		

	    //Función para inicializar elementos de la factura (referencia)
		function inicializar_referencia_ampliar_plazos_credito_cuentas_cobrar()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtTipoReferencia_ampliar_plazos_credito_cuentas_cobrar').val('');
			$('#txtFecha_ampliar_plazos_credito_cuentas_cobrar').val('');
			$('#txtFechaVencimiento_ampliar_plazos_credito_cuentas_cobrar').val('');
			$('#txtMoneda_ampliar_plazos_credito_cuentas_cobrar').val('');
			$('#txtTipoCambio_ampliar_plazos_credito_cuentas_cobrar').val('');
            $('#txtRazonSocial_ampliar_plazos_credito_cuentas_cobrar').val('');
            $('#txtImporte_ampliar_plazos_credito_cuentas_cobrar').val('');
            $('#txtRenglon_ampliar_plazos_credito_cuentas_cobrar').val('');
            $('#txtDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val('');
            $('#txtDocumentoPago_ampliar_plazos_credito_cuentas_cobrar').val('');
            $('#txtNuevoDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val('');
            $('#txtNuevoDocumentoPago_ampliar_plazos_credito_cuentas_cobrar').val('');
            $('#txtFechaNuevoVencimiento_ampliar_plazos_credito_cuentas_cobrar').val('');
            //Hacer un llamado a la función para inicializar elementos del tipo de pago	(forma de pago del pedido de maquinaria)
            inicializar_tipo_gasto_ampliar_plazos_credito_cuentas_cobrar();
		}


		//Función para inicializar elementos del tipo de pago (forma de pago del pedido de maquinaria)
		function inicializar_tipo_gasto_ampliar_plazos_credito_cuentas_cobrar()
		{
			//Si existe id de la forma de pago del pedido de maquinaria
			if(parseInt($('#txtDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val()) > 0)
	        {
	          		//Mostrar Div que contiene los campos del tipo de pago (forma de pago del pedido de maquinaria)
					$('#DivTipoPago_ampliar_plazos_credito_cuentas_cobrar').show();
	        }
	        else
	        {
	          		//Ocultar Div que contiene los campos del tipo de pago (forma de pago del pedido de maquinaria)
					$('#DivTipoPago_ampliar_plazos_credito_cuentas_cobrar').hide();
	        }
		}

	
		//Función que se utiliza para cerrar el modal
		function cerrar_ampliar_plazos_credito_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objAmpliarPlazosCreditoCuentasCobrar.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ampliar_plazos_credito_cuentas_cobrar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_ampliar_plazos_credito_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ampliar_plazos_credito_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmAmpliarPlazosCreditoCuentasCobrar')
				.bootstrapValidator({	excluded: [':disabled'],
									 	container: 'popover',
									 	feedbackIcons: {
									 		valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
									  	},
									  	fields: {
											intDias_ampliar_plazos_credito_cuentas_cobrar: {
												validators: {
													notEmpty: {message: 'Escriba número de días'}
												}
											},
											strReferencia_ampliar_plazos_credito_cuentas_cobrar: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id de la factura
						                                    if($('#txtReferenciaID_ampliar_plazos_credito_cuentas_cobrar').val() === '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba una factura existente'
						                                        };
						                                    }
						                                    return true;
						                                }
						                            }
												}
											},
											strNuevoDocumentoPago_ampliar_plazos_credito_cuentas_cobrar: {
												validators: {
											    	callback: {
						                                callback: function(value, validator, $field) {
						                                    //Verificar que exista id del documento (tipo) de pago
						                                    if(parseInt($('#txtRenglon_ampliar_plazos_credito_cuentas_cobrar').val()) > 0 && $('#txtNuevoDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val() === '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Escriba un tipo de pago existente'
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
			var bootstrapValidator_ampliar_plazos_credito_cuentas_cobrar = $('#frmAmpliarPlazosCreditoCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_ampliar_plazos_credito_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_ampliar_plazos_credito_cuentas_cobrar.isValid())
			{

				//Hacer un llamado a la función para guardar los datos del registro
				guardar_ampliar_plazos_credito_cuentas_cobrar();
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_ampliar_plazos_credito_cuentas_cobrar()
		{
			try
			{
				$('#frmAmpliarPlazosCreditoCuentasCobrar').data('bootstrapValidator').resetForm();

			}
			catch(err) {}
		}

		//Función para guardar los datos de un registro
		function guardar_ampliar_plazos_credito_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_cobrar/ampliar_plazos_credito/guardar',
					{ 
						strTipoReferencia: $('#txtTipoReferencia_ampliar_plazos_credito_cuentas_cobrar').val(),
						intReferenciaID: $('#txtReferenciaID_ampliar_plazos_credito_cuentas_cobrar').val(),
						intRenglon: $('#txtRenglon_ampliar_plazos_credito_cuentas_cobrar').val(),
						intDocumentoPagoID: $('#txtDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteVencimiento: $.formatFechaMysql($('#txtFechaVencimiento_ampliar_plazos_credito_cuentas_cobrar').val()),
						intDias: $('#txtDias_ampliar_plazos_credito_cuentas_cobrar').val(),
						dteNuevoVencimiento: $.formatFechaMysql($('#txtFechaNuevoVencimiento_ampliar_plazos_credito_cuentas_cobrar').val()), 
						intNuevoDocumentoPagoID: $('#txtNuevoDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val()
					},
					function(data) {
						if (data.resultado)
						{	
							//Hacer llamado a la función  para cargar  los registros en el grid
		               		paginacion_ampliar_plazos_credito_cuentas_cobrar();  
		                    //Hacer un llamado a la función para cerrar modal
		                    cerrar_ampliar_plazos_credito_cuentas_cobrar();
		                    
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ampliar_plazos_credito_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_ampliar_plazos_credito_cuentas_cobrar(tipoMensaje, mensaje)
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

		//Función para regresar los datos (al formulario) del registro seleccionado
		function ver_ampliar_plazos_credito_cuentas_cobrar(id, tipoReferencia, referenciaID)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_cobrar/ampliar_plazos_credito/get_datos',
			       {intAmpliarPlazoCreditoID: id,
			       	strTipoReferencia: tipoReferencia,
			       	intReferenciaID: referenciaID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ampliar_plazos_credito_cuentas_cobrar();
				          	//Recuperar valores
				          	$('#txtTipoReferencia_ampliar_plazos_credito_cuentas_cobrar').val(data.row.tipo_referencia);
				            $('#txtReferenciaID_ampliar_plazos_credito_cuentas_cobrar').val(data.row.referencia_id);
				            $('#txtRenglon_ampliar_plazos_credito_cuentas_cobrar').val(data.row.renglon);
				            $('#txtDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val(data.row.documento_pago_id);
				             $('#txtDocumentoPago_ampliar_plazos_credito_cuentas_cobrar').val(data.row.documento_pago);
				            $('#txtDias_ampliar_plazos_credito_cuentas_cobrar').val(data.row.dias);
				            $('#txtEmpleadoAutorizacion_ampliar_plazos_credito_cuentas_cobrar').val(data.row.empleado_autorizacion)
				            $('#txtFechaVencimiento_ampliar_plazos_credito_cuentas_cobrar').val(data.row.vencimiento);
				             $('#txtFechaNuevoVencimiento_ampliar_plazos_credito_cuentas_cobrar').val(data.row.nuevo_vencimiento);

				            //Hacer un llamado a la función para inicializar elementos del tipo de pago	(forma de pago del pedido de maquinaria)
							inicializar_tipo_gasto_ampliar_plazos_credito_cuentas_cobrar();

				            //Si existen datos de la factura
				            if(data.factura)
				            {
					            $('#txtReferencia_ampliar_plazos_credito_cuentas_cobrar').val(data.factura.folio);
					            $('#txtFecha_ampliar_plazos_credito_cuentas_cobrar').val(data.factura.fecha);
					            $('#txtMoneda_ampliar_plazos_credito_cuentas_cobrar').val(data.factura.codigo_moneda);
					            $('#txtTipoCambio_ampliar_plazos_credito_cuentas_cobrar').val(data.factura.tipo_cambio);
					            $('#txtRazonSocial_ampliar_plazos_credito_cuentas_cobrar').val(data.factura.razon_social);
					            $('#txtImporte_ampliar_plazos_credito_cuentas_cobrar').val(data.factura.importe);
					            //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
						        $('#txtImporte_ampliar_plazos_credito_cuentas_cobrar').formatCurrency({ roundToDecimalPlace: 2 });

					        }//Cierre de verificación de la factura
				            
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_ampliar_plazos_credito_cuentas_cobrar').addClass("estatus-ACTIVO");
			            	//Deshabilitar las siguientes cajas de texto
			            	$("#txtReferencia_ampliar_plazos_credito_cuentas_cobrar").attr('disabled','disabled');
			            	$('#txtNuevoDocumentoPago_ampliar_plazos_credito_cuentas_cobrar').attr("disabled", "disabled");
							$('#txtDias_ampliar_plazos_credito_cuentas_cobrar').attr("disabled", "disabled");
			            	//Ocultar los siguientes botones
				            $("#btnGuardar_ampliar_plazos_credito_cuentas_cobrar").hide();

			            	//Abrir modal
							objAmpliarPlazosCreditoCuentasCobrar = $('#AmpliarPlazosCreditoCuentasCobrarBox').bPopup({
														   appendTo: '#AmpliarPlazosCreditoCuentasCobrarContent', 
							                               contentContainer: 'AmpliarPlazosCreditoCuentasCobrarM', 
							                               zIndex: 2, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtReferencia_ampliar_plazos_credito_cuentas_cobrar').focus();
							
			       	    }
			       },
			       'json');
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos númericos (solamente valores enteros y positivos)
			$('#txtDias_ampliar_plazos_credito_cuentas_cobrar').numeric({decimal: false, negative: false});

			//Autocomplete para recuperar los datos de una factura (maquinaria/refacciones/servicio)
	        $('#txtReferencia_ampliar_plazos_credito_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtReferenciaID_ampliar_plazos_credito_cuentas_cobrar').val('');
	               //Hacer un llamado a la función para inicializar elementos de la factura
	               inicializar_referencia_ampliar_plazos_credito_cuentas_cobrar();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/ampliar_plazos_credito/autocomplete",
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
	              $('#txtReferenciaID_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.data);
	              $('#txtTipoReferencia_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.tipo_referencia);
	              $('#txtFecha_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.fecha);
	              $('#txtFechaVencimiento_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.vencimiento);
	              $('#txtMoneda_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.codigo_moneda);
	              $('#txtTipoCambio_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.tipo_cambio);
	              $('#txtRazonSocial_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.razon_social);
	              $('#txtImporte_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.importe);
	              $('#txtRenglon_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.renglon);
	              $('#txtDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.documento_pago_id);
	              $('#txtDocumentoPago_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.documento_pago);
	              $('#txtNuevoDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.documento_pago_id);
	              $('#txtNuevoDocumentoPago_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.documento_pago);

	              //Hacer un llamado a la función para inicializar elementos del tipo de pago (forma de pago del pedido de maquinaria)
	              inicializar_tipo_gasto_ampliar_plazos_credito_cuentas_cobrar();

	              //Hacer un llamado a la función para calcular fecha de vencimiento
			 	  $.calcularFechaVencimiento(arrFechaVencimientoAmpliarPlazosCreditoCuentasCobrar);

	              //Elegir folio desde el valor devuelto en el autocomplete
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
	        
	        //Verificar que exista id de la factura cuando pierda el enfoque la caja de texto
	        $('#txtReferencia_ampliar_plazos_credito_cuentas_cobrar').focusout(function(e){
	            //Si no existe id de la factura
	            if($('#txtReferenciaID_ampliar_plazos_credito_cuentas_cobrar').val() == '' ||
	               $('#txtReferencia_ampliar_plazos_credito_cuentas_cobrar').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtReferenciaID_ampliar_plazos_credito_cuentas_cobrar').val('');
	                $('#txtReferencia_ampliar_plazos_credito_cuentas_cobrar').val('');
	               //Hacer un llamado a la función para inicializar elementos de la factura
	               inicializar_referencia_ampliar_plazos_credito_cuentas_cobrar();
	            }

	        });


	        //Autocomplete para recuperar los datos de un documento de pago 
	        $('#txtNuevoDocumentoPago_ampliar_plazos_credito_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtNuevoDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/documentos_pagos/autocomplete",
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
	             $('#txtNuevoDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de una forma de pago cuando pierda el enfoque la caja de texto
	        $('#txtNuevoDocumentoPago_ampliar_plazos_credito_cuentas_cobrar').focusout(function(e){
	            //Si no existe id de la forma de pago
	            if($('#txtNuevoDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val() == '' ||
	               $('#txtNuevoDocumentoPago_ampliar_plazos_credito_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtNuevoDocumentoPagoID_ampliar_plazos_credito_cuentas_cobrar').val('');
	               $('#txtNuevoDocumentoPago_ampliar_plazos_credito_cuentas_cobrar').val('');
	            }
	            
	        });

	        //Calcular fecha del nuevo vencimiento cuando pierda el enfoque la caja de texto
	        $('#txtDias_ampliar_plazos_credito_cuentas_cobrar').focusout(function(e){

	            //Hacer un llamado a la función para calcular fecha de vencimiento
			 	$.calcularFechaVencimiento(arrFechaVencimientoAmpliarPlazosCreditoCuentasCobrar);
	        });
			
			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_ampliar_plazos_credito_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_ampliar_plazos_credito_cuentas_cobrar').datetimepicker({format: 'DD/MM/YYYY',
			 																		                            useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_ampliar_plazos_credito_cuentas_cobrar').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_ampliar_plazos_credito_cuentas_cobrar').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_ampliar_plazos_credito_cuentas_cobrar').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_ampliar_plazos_credito_cuentas_cobrar').data('DateTimePicker').maxDate(e.date);
			});
			
			//Autocomplete para recuperar los datos de un cliente
	        $('#txtRazonSocialBusq_ampliar_plazos_credito_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_ampliar_plazos_credito_cuentas_cobrar').val('');
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
	             $('#txtProspectoIDBusq_ampliar_plazos_credito_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_ampliar_plazos_credito_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_ampliar_plazos_credito_cuentas_cobrar').val() == '' ||
	               $('#txtRazonSocialBusq_ampliar_plazos_credito_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_ampliar_plazos_credito_cuentas_cobrar').val('');
	               $('#txtRazonSocialBusq_ampliar_plazos_credito_cuentas_cobrar').val('');
	            }

	        });

	        //Paginación de registros
			$('#pagLinks_ampliar_plazos_credito_cuentas_cobrar').on('click','a',function(event){
				event.preventDefault();
				intPaginaAmpliarPlazosCreditoCuentasCobrar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_ampliar_plazos_credito_cuentas_cobrar();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_ampliar_plazos_credito_cuentas_cobrar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_ampliar_plazos_credito_cuentas_cobrar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_ampliar_plazos_credito_cuentas_cobrar').addClass("estatus-NUEVO");
				//Abrir modal
				objAmpliarPlazosCreditoCuentasCobrar = $('#AmpliarPlazosCreditoCuentasCobrarBox').bPopup({
											   appendTo: '#AmpliarPlazosCreditoCuentasCobrarContent', 
				                               contentContainer: 'AmpliarPlazosCreditoCuentasCobrarM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

				//Enfocar caja de texto
				$('#txtReferencia_ampliar_plazos_credito_cuentas_cobrar').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_ampliar_plazos_credito_cuentas_cobrar').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_ampliar_plazos_credito_cuentas_cobrar();
		});
	</script>