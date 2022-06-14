<div id="AjustesBancariosCuentasPagarContent">  
	<!--Barra de herramientas-->
	<div class="panel-toolbar">
		<!--Diseño del formulario de Búsquedas-->
		<form class="form-horizontal" id="frmBusqueda_ajustes_bancarios_cuentas_pagar" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
			<div class="row">
				<!--Fecha inicial-->
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<label for="txtFechaInicialBusq_ajustes_bancarios_cuentas_pagar">Fecha inicial</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaInicialBusq_ajustes_bancarios_cuentas_pagar'>
			                    <input class="form-control" 
			                    		id="txtFechaInicialBusq_ajustes_bancarios_cuentas_pagar"
			                    		name= "strFechaInicialBusq_ajustes_bancarios_cuentas_pagar" 
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
							<label for="txtFechaFinalBusq_ajustes_bancarios_cuentas_pagar">Fecha final</label>
						</div>
						<div class="col-md-12">
							<div class='input-group date' id='dteFechaFinalBusq_ajustes_bancarios_cuentas_pagar'>
			                    <input class="form-control" 
			                    		id="txtFechaFinalBusq_ajustes_bancarios_cuentas_pagar"
			                    		name= "strFechaFinalBusq_ajustes_bancarios_cuentas_pagar" 
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
							<label for="txtCuentaBancariaBusq_ajustes_bancarios_cuentas_pagar">Cuenta</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" 
									id="txtCuentaBancariaIDBusq_ajustes_bancarios_cuentas_pagar" 
									name="intCuentaBancariaIDBusq_ajustes_bancarios_cuentas_pagar" 
									type="hidden" />
							<input  class="form-control" 
									id="txtCuentaBancariaBusq_ajustes_bancarios_cuentas_pagar" 
									name="strCuentaBusq_ajustes_bancarios_cuentas_pagar" 
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
							<label for="cmbEstatusBusq_ajustes_bancarios_cuentas_pagar">Estatus</label>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="cmbEstatusBusq_ajustes_bancarios_cuentas_pagar" 
							 		name="strEstatusBusq_ajustes_bancarios_cuentas_pagar" tabindex="1">
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
							<label for="txtBusqueda_ajustes_bancarios_cuentas_pagar">Descripción</label>
						</div>
						<div class="col-md-12">
							<input  class="form-control" id="txtBusqueda_ajustes_bancarios_cuentas_pagar" 
									name="strBusqueda_ajustes_bancarios_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
							</input>
						</div>
					</div>
				</div>
				<!--Mostrar detalles de los registros en el reporte PDF--> 
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
					<div class="checkbox">
                    	<label id="label-checkbox">
                        	<input class="form-control" 
                        			id="chbImprimirDetalles_ajustes_bancarios_cuentas_pagar" 
								   	name="strImprimirDetalles_ajustes_bancarios_cuentas_pagar" 
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
						<button class="btn btn-primary" id="btnBuscar_ajustes_bancarios_cuentas_pagar"
								onclick="paginacion_ajustes_bancarios_cuentas_pagar();" 
								title="Buscar coincidencias" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<!--Dar de alta un nuevo registro-->
						<button class="btn btn-info" id="btnNuevo_ajustes_bancarios_cuentas_pagar" 
								title="Nuevo registro" tabindex="1" disabled> 
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>   
						<!--Generar PDF con el listado de registros-->
						<button class="btn btn-default"  id="btnImprimir_ajustes_bancarios_cuentas_pagar"
								onclick="reporte_ajustes_bancarios_cuentas_pagar();" title="Imprimir reporte general en PDF" tabindex="1" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button> 
						<!--Descargar archivo XLS con el listado de registros-->
						<button class="btn btn-success"  id="btnDescargarXLS_ajustes_bancarios_cuentas_pagar"
								onclick="descargar_xls_ajustes_bancarios_cuentas_pagar();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
			Definir columnas
			*/
			td.movil:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
			td.movil:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
			td.movil:nth-of-type(3):before {content: "Cuenta"; font-weight: bold;}
			td.movil:nth-of-type(4):before {content: "Tipo"; font-weight: bold;}
			td.movil:nth-of-type(5):before {content: "Concepto"; font-weight: bold;}
			td.movil:nth-of-type(6):before {content: "Importe"; font-weight: bold;}
			td.movil:nth-of-type(7):before {content: "Estatus"; font-weight: bold;}
			td.movil:nth-of-type(8):before {content: "Acciones"; font-weight: bold;}
		}
	</style>
	<!--Panel que contiene la tabla con los registros encontrados-->
	<div class="panel-content">
		<div class="container-fluid">
			<!-- Diseño de la tabla-->
			<table class="table-hover movil" id="dg_ajustes_bancarios_cuentas_pagar">
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
				<script id="plantilla_ajustes_bancarios_cuentas_pagar" type="text/template"> 
				{{#rows}}
					<tr class="movil {{estiloRegistro}}">   
						<td class="movil">{{folio}}</td>
						<td class="movil">{{fecha}}</td>
						<td class="movil">{{cuenta_bancaria}}</td>
						<td class="movil">{{tipo}}</td>
						<td class="movil">{{concepto}}</td>
						<td class="movil">{{importe}}</td>
						<td class="movil">{{estatus}}</td>
						<td class="td-center movil"> 
							<!--Editar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
									onclick="editar_ajustes_bancarios_cuentas_pagar({{ajuste_bancario_id}})"  title="Editar">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
							<!--Ver registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
									onclick="editar_ajustes_bancarios_cuentas_pagar({{ajuste_bancario_id}})"  title="Ver">
								<span class="glyphicon glyphicon-eye-open"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
									onclick="reporte_registro_ajustes_bancarios_cuentas_pagar({{ajuste_bancario_id}});"  title="Imprimir registro en PDF"><span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
									onclick="cambiar_estatus_ajustes_bancarios_cuentas_pagar({{ajuste_bancario_id}},'{{estatus}}')" title="Desactivar">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
									onclick="cambiar_estatus_ajustes_bancarios_cuentas_pagar({{ajuste_bancario_id}},'{{estatus}}')"  title="Restaurar">
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
				<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ajustes_bancarios_cuentas_pagar"></div>
				<!--Número de registros encontrados-->
				<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
					<button class="btn btn-default btn-sm disabled pull-right">
						<strong id="numElementos_ajustes_bancarios_cuentas_pagar">0</strong> encontrados
					</button>
				</div>
			</div> <!--Cierre del diseño de la paginación-->
		</div><!--#container-fluid-->
	</div><!--Cierre del contenedor de la tabla-->

	<!-- Diseño del modal-->
	<div id="AjustesBancariosCuentasPagarBox" class="ModalBody">
		<!--Título-->
		<div id="divEncabezadoModal_ajustes_bancarios_cuentas_pagar"  class="ModalBodyTitle">
			<h1>Ajustes Bancarios</h1>
		</div>
		<!--Contenido-->
		<div class="ModalBodyContent">
			<!--Diseño del formulario-->
			<form 	id="frmAjustesBancariosCuentasPagar" 
					method="post" 
					action="#" 
					class="form-horizontal" 
					role="form" 
				  	name="frmAjustesBancariosCuentasPagar"  
				  	onsubmit="return(false)" autocomplete="off">

				<div class="row">
				  	<!-- Folio -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
								<input 	id="txtAjusteBancarioID_ajustes_bancarios_cuentas_pagar" 
										name="intAjusteBancarioID_ajustes_bancarios_cuentas_pagar" 
										type="hidden" 
										value="" />
								<label for="txtFolio_ajustes_bancarios_cuentas_pagar">Folio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtFolio_ajustes_bancarios_cuentas_pagar" 
										name="strFolio_ajustes_bancarios_cuentas_pagar" 
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
								<label for="txtFecha_ajustes_bancarios_cuentas_pagar">Fecha</label>
							</div>
							<div id="divFechaMsjValidacion" class="col-md-12">
								<div class='input-group date' id='dteFecha_ajustes_bancarios_cuentas_pagar'>
				                    <input class="form-control" 
				                    		id="txtFecha_ajustes_bancarios_cuentas_pagar"
				                    		name= "strFecha_ajustes_bancarios_cuentas_pagar" 
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
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbTipo_ajustes_bancarios_cuentas_pagar">Tipo</label>
							</div>
							<div id="divCmbMsjValidacion" class="col-md-12">
								<select  class="form-control" 
										id="cmbTipo_ajustes_bancarios_cuentas_pagar" 
								 		name="strTipo_ajustes_bancarios_cuentas_pagar" 
								 		tabindex="1">
								 	<option value="">Seleccione una opción</option>
								    <option value="INGRESO">INGRESO</option>
                      				<option value="EGRESO">EGRESO</option>
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
								<input 	id="txtCuentaBancariaID_ajustes_bancarios_cuentas_pagar" 
										name="intCuentaBancariaID_ajustes_bancarios_cuentas_pagar" 
										type="hidden" 
										value="" />
								<label for="txtCuentaBancaria_ajustes_bancarios_cuentas_pagar">Cuenta</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtCuentaBancaria_ajustes_bancarios_cuentas_pagar" 
										name="strCuentaBancaria_ajustes_bancarios_cuentas_pagar" 
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
								<!-- Caja de texto oculta para recuperar el id de la moneda de la cuenta bancaria seleccionada-->
								<input id="txtMonedaID_ajustes_bancarios_cuentas_pagar" 
									   name="intMonedaID_ajustes_bancarios_cuentas_pagar" type="hidden" value="">
								</input>
								<label for="txtMoneda_ajustes_bancarios_cuentas_pagar">Moneda</label>
							</div>
							<div class="col-md-12">
                 				<input  class="form-control" 
										id="txtMoneda_ajustes_bancarios_cuentas_pagar" 
										name="strMoneda_ajustes_bancarios_cuentas_pagar" 
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
								<label for="txtSubtotal_ajustes_bancarios_cuentas_pagar">Subtotal</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control moneda_ajustes_bancarios_cuentas_pagar" id="txtSubtotal_ajustes_bancarios_cuentas_pagar" 
											name="intSubtotal_ajustes_bancarios_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese subtotal" maxlength="14">
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
								<input id="txtIva_ajustes_bancarios_cuentas_pagar" 
									   name="intIva_ajustes_bancarios_cuentas_pagar" 
									   type="hidden" value="">
								</input>
								<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
								<input id="txtTasaCuotaIva_ajustes_bancarios_cuentas_pagar" 
									   name="intTasaCuotaIva_ajustes_bancarios_cuentas_pagar" 
									   type="hidden" value="">
								</input>
								<label for="txtPorcentajeIva_ajustes_bancarios_cuentas_pagar">IVA %</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtPorcentajeIva_ajustes_bancarios_cuentas_pagar" 
										name="intPorcentajeIva_ajustes_bancarios_cuentas_pagar" 
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
								<label for="txtTotal_ajustes_bancarios_cuentas_pagar">Total</label>
							</div>
							<div class="col-md-12">
								<div class='input-group'>
									<span class="input-group-addon">$</span>
									<input  class="form-control" id="txtTotal_ajustes_bancarios_cuentas_pagar" 
											name="intTotal_ajustes_bancarios_cuentas_pagar" type="text" value="" disabled>
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
								<label for="txtConcepto_ajustes_bancarios_cuentas_pagar">Concepto</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtConcepto_ajustes_bancarios_cuentas_pagar" 
										name="strConcepto_ajustes_bancarios_cuentas_pagar" 
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
								<label for="txtObservaciones_ajustes_bancarios_cuentas_pagar">Observaciones</label>
							</div>	
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtObservaciones_ajustes_bancarios_cuentas_pagar" 
										name="strObservaciones_ajustes_bancarios_cuentas_pagar" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese observaciones" 
										maxlength="250" />
							</div>
						</div>
					</div>
				</div>

				<!--Botones de acción (barra de tareas)-->
				<div class="btn-group row footerModal">
					<div class="col-md-12">
						<!--Nuevo registro-->
						<button class="btn btn-info" id="btnReiniciar_ajustes_bancarios_cuentas_pagar"  
								onclick="nuevo_ajustes_bancarios_cuentas_pagar('Nuevo');"  title="Nuevo registro" tabindex="2">
							<span class="glyphicon glyphicon-list-alt"></span>
						</button>
						<!--Guardar registro-->
						<button class="btn btn-success" id="btnGuardar_ajustes_bancarios_cuentas_pagar"  
								onclick="validar_ajustes_bancarios_cuentas_pagar();"  title="Guardar" 
								tabindex="3" disabled>
							<span class="fa fa-floppy-o"></span>
						</button>
						<!--Generar PDF con los datos del registro-->
						<button class="btn btn-default" 
								id="btnImprimirRegistro_ajustes_bancarios_cuentas_pagar"  
								onclick="reporte_registro_ajustes_bancarios_cuentas_pagar('');"  
								title="Imprimir registro en PDF" tabindex="4" disabled>
							<span class="glyphicon glyphicon-print"></span>
						</button>
						<!--Desactivar registro-->
						<button class="btn btn-default" id="btnDesactivar_ajustes_bancarios_cuentas_pagar"  
								onclick="cambiar_estatus_ajustes_bancarios_cuentas_pagar('','ACTIVO');"  title="Desactivar" tabindex="5" disabled>
							<span class="glyphicon glyphicon-ban-circle"></span>
						</button>
						<!--Restaurar registro-->
						<button class="btn btn-default" id="btnRestaurar_ajustes_bancarios_cuentas_pagar"  
								onclick="cambiar_estatus_ajustes_bancarios_cuentas_pagar('','INACTIVO');"  title="Restaurar" tabindex="6" disabled>
							<span class="fa fa-exchange"></span>
						</button>
						<!--Cerrar modal-->
						<button class="btn  btn-cerrar"  id="btnCerrar_ajustes_bancarios_cuentas_pagar"
								type="reset" aria-hidden="true" onclick="cerrar_ajustes_bancarios_cuentas_pagar();" 
								title="Cerrar"  tabindex="7">
							<span class="fa fa-times"></span>
						</button>
					</div>
				</div>		
			</form><!--Cierre del formulario-->
		</div><!--Cierre del contenido-->
	</div>	<!--Cierre del modal-->
</div><!--#AjustesBancariosCuentasPagarContent -->

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">

	/*******************************************************************************************************************
	Funciones del formulario principal
	*********************************************************************************************************************/
	//Variables que se utilizan para la paginación de registros
	var intPaginaAjustesBancariosCuentasPagar = 0;
	var strUltimaBusquedaAjustesBancariosCuentasPagar = "";
	//Variables que se utilizan para la búsqueda de registros
	var intAjusteBancarioIDAjustesBancariosCuentasPagar = "";
	var dteFechaInicialAjustesBancariosCuentasPagar = "";
	var dteFechaFinalAjustesBancariosCuentasPagar = "";
	//Variable que se utiliza para asignar objeto del modal
	var objAjustesBancariosCuentasPagar = null;

	//Permisos  de acceso del usuario (Acciones Generales)
	function permisos_ajustes_bancarios_cuentas_pagar()
	{
		//Hacer un llamado al método del controlador para regresar los permisos de acceso
		$.post('cuentas_pagar/ajustes_bancarios/get_permisos_acceso',
		{ 
			strPermisosAcceso: $('#txtAcciones_ajustes_bancarios_cuentas_pagar').val()
		},
		function(data){
			//Si existen permisos de acceso del usuario para este proceso
			if (data.row)
			{
				//Asignar a la variable la cadena concatenada con los permisos de acceso
				//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
				var strPermisosAjustesBancariosCuentasPagar = data.row;
				//Separar la cadena 
				var arrPermisosAjustesBancariosCuentasPagar = strPermisosAjustesBancariosCuentasPagar.split('|');

				//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
				for (var i=0; i < arrPermisosAjustesBancariosCuentasPagar.length; i++)
				{
					//Habilitar Acción si se cuenta con  permiso de acceso
					if(arrPermisosAjustesBancariosCuentasPagar[i]=='NUEVO')//Si el indice es NUEVO
					{
						//Habilitar el control (botón nuevo)
						$('#btnNuevo_ajustes_bancarios_cuentas_pagar').removeAttr('disabled');
					}
					//Si el indice es GUARDAR ó EDITAR (modificar)
					else if((arrPermisosAjustesBancariosCuentasPagar[i]=='GUARDAR') || (arrPermisosAjustesBancariosCuentasPagar[i]=='EDITAR'))
					{
						//Habilitar el control (botón guardar)
						$('#btnGuardar_ajustes_bancarios_cuentas_pagar').removeAttr('disabled');
					}
					else if(arrPermisosAjustesBancariosCuentasPagar[i]=='BUSCAR')//Si el indice es BUSCAR
					{
						//Habilitar el control (botón buscar)
						$('#btnBuscar_ajustes_bancarios_cuentas_pagar').removeAttr('disabled');
						//Hacer llamado a la función  para cargar  los registros en el grid
						paginacion_ajustes_bancarios_cuentas_pagar();
					}
					else if(arrPermisosAjustesBancariosCuentasPagar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
					{
						//Habilitar los siguientes controles
						$('#btnDesactivar_ajustes_bancarios_cuentas_pagar').removeAttr('disabled');
						$('#btnRestaurar_ajustes_bancarios_cuentas_pagar').removeAttr('disabled');
					}
					else if(arrPermisosAjustesBancariosCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimir_ajustes_bancarios_cuentas_pagar').removeAttr('disabled');
					}
					else if(arrPermisosAjustesBancariosCuentasPagar[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
					{
						//Habilitar el control (botón imprimir)
						$('#btnImprimirRegistro_ajustes_bancarios_cuentas_pagar').removeAttr('disabled');
					}
					else if(arrPermisosAjustesBancariosCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
					{
						//Habilitar el control (botón descargar XLS)
						$('#btnDescargarXLS_ajustes_bancarios_cuentas_pagar').removeAttr('disabled');
					}
				}//Cerrar for
			}
		},
		'json');
	}

	//Función para la búsqueda de registros
	function paginacion_ajustes_bancarios_cuentas_pagar() 
	{
		//Concatenar datos para la nueva búsqueda
		var strNuevaBusquedaAjustesBancariosCuentasPagar =($('#txtFechaInicialBusq_ajustes_bancarios_cuentas_pagar').val()+$('#txtFechaFinalBusq_ajustes_bancarios_cuentas_pagar').val()+$('#txtProveedorIDBusq_ajustes_bancarios_cuentas_pagar').val()+$('#cmbEstatusBusq_ajustes_bancarios_cuentas_pagar').val()+$('#txtBusqueda_ajustes_bancarios_cuentas_pagar').val());

		//Verificar si hubo cambios en la búsqueda
		if(strNuevaBusquedaAjustesBancariosCuentasPagar != strUltimaBusquedaAjustesBancariosCuentasPagar)
		{
			intPaginaAjustesBancariosCuentasPagar = 0;
			strUltimaBusquedaAjustesBancariosCuentasPagar = strNuevaBusquedaAjustesBancariosCuentasPagar;
		}
		//Hacer un llamado al método del controlador para regresar listado de registros
		$.post('cuentas_pagar/ajustes_bancarios/get_paginacion',
				{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_ajustes_bancarios_cuentas_pagar').val()),
	    			dteFechaFinal:  $.formatFechaMysql($('#txtFechaFinalBusq_ajustes_bancarios_cuentas_pagar').val()),
	    			intCuentaBancariaID: $('#txtCuentaBancariaIDBusq_ajustes_bancarios_cuentas_pagar').val(),
					strEstatus: $('#cmbEstatusBusq_ajustes_bancarios_cuentas_pagar').val(),
					strBusqueda: $('#txtBusqueda_ajustes_bancarios_cuentas_pagar').val(),
					intPagina:intPaginaAjustesBancariosCuentasPagar,
					strPermisosAcceso: $('#txtAcciones_ajustes_bancarios_cuentas_pagar').val()
				},
				function(data){
					$('#dg_ajustes_bancarios_cuentas_pagar tbody').empty();
					var tmpAjustesBancariosCuentasPagar = Mustache.render($('#plantilla_ajustes_bancarios_cuentas_pagar').html(),data);
					$('#dg_ajustes_bancarios_cuentas_pagar tbody').html(tmpAjustesBancariosCuentasPagar);
					$('#pagLinks_ajustes_bancarios_cuentas_pagar').html(data.paginacion);
					$('#numElementos_ajustes_bancarios_cuentas_pagar').html(data.total_rows);
					intPaginaAjustesBancariosCuentasPagar = data.pagina;
				},
		'json');
	}

	//Función para cargar el reporte general en PDF
	function reporte_ajustes_bancarios_cuentas_pagar() 
	{
		//Asignar valores para la búsqueda de registros
		intCuentaIDAjustesBancariosCuentasPagar =  $('#txtCuentaBancariaIDBusq_ajustes_bancarios_cuentas_pagar').val();
		dteFechaInicialAjustesBancariosCuentasPagar =  $.formatFechaMysql($('#txtFechaInicialBusq_ajustes_bancarios_cuentas_pagar').val());
		dteFechaFinalAjustesBancariosCuentasPagar =  $.formatFechaMysql($('#txtFechaFinalBusq_ajustes_bancarios_cuentas_pagar').val());

		//Si no existe fecha inicial
		if(dteFechaInicialAjustesBancariosCuentasPagar == '')
		{
			dteFechaInicialAjustesBancariosCuentasPagar = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalAjustesBancariosCuentasPagar == '')
		{
			dteFechaFinalAjustesBancariosCuentasPagar =  '0000-00-00';
		}
		
		//Si no existe id del proveedor
		if(intCuentaIDAjustesBancariosCuentasPagar == '')
		{
			intCuentaIDAjustesBancariosCuentasPagar = 0;
		}


		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_ajustes_bancarios_cuentas_pagar').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_ajustes_bancarios_cuentas_pagar').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_ajustes_bancarios_cuentas_pagar').val('NO');
		}

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("cuentas_pagar/ajustes_bancarios/get_reporte/"
					+dteFechaInicialAjustesBancariosCuentasPagar+"/"
					+dteFechaFinalAjustesBancariosCuentasPagar+"/"
					+intCuentaIDAjustesBancariosCuentasPagar+"/"+
				    $('#cmbEstatusBusq_ajustes_bancarios_cuentas_pagar').val()+"/"+
				    $('#chbImprimirDetalles_ajustes_bancarios_cuentas_pagar').val()+"/"+$('#txtBusqueda_ajustes_bancarios_cuentas_pagar').val());
	}


	//Función para imprimir en PDF un registro seleccionado
	function reporte_registro_ajustes_bancarios_cuentas_pagar(id)
	{	

		//Variable que se utiliza para asignar id
		var intAjusteBancarioID = 0;
		
		//Dependiendo del tipo de formulario asignar id
		if(id == '')
			intAjusteBancarioID = $('#txtAjusteBancarioID_ajustes_bancarios_cuentas_pagar').val();
		else
			intAjusteBancarioID = id;

		//Hacer un llamado al método del controlador para generar reporte PDF
		window.open("cuentas_pagar/ajustes_bancarios/get_reporte_registro/" + intAjusteBancarioID);
	}

	//Función para descargar el archivo XLS
	function descargar_xls_ajustes_bancarios_cuentas_pagar() 
	{
		//Asignar valores para la búsqueda de registros
		intCuentaIDAjustesBancariosCuentasPagar =  $('#txtCuentaBancariaIDBusq_ajustes_bancarios_cuentas_pagar').val();
		dteFechaInicialAjustesBancariosCuentasPagar =  $.formatFechaMysql($('#txtFechaInicialBusq_ajustes_bancarios_cuentas_pagar').val());
		dteFechaFinalAjustesBancariosCuentasPagar =  $.formatFechaMysql($('#txtFechaFinalBusq_ajustes_bancarios_cuentas_pagar').val());

		//Si no existe fecha inicial
		if(dteFechaInicialAjustesBancariosCuentasPagar == '')
		{
			dteFechaInicialAjustesBancariosCuentasPagar = '0000-00-00';
		}

		//Si no existe fecha final
		if(dteFechaFinalAjustesBancariosCuentasPagar == '')
		{
			dteFechaFinalAjustesBancariosCuentasPagar =  '0000-00-00';
		}
		
		//Si no existe id del proveedor
		if(intCuentaIDAjustesBancariosCuentasPagar == '')
		{
			intCuentaIDAjustesBancariosCuentasPagar = 0;
		}


		//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
		if ($('#chbImprimirDetalles_ajustes_bancarios_cuentas_pagar').is(':checked')) {
		    //Asignar SI para incluir detalles en el reporte
		    $('#chbImprimirDetalles_ajustes_bancarios_cuentas_pagar').val('SI');
		}
		else
		{ 
		   //Asignar NO para  no incluir detalles en el reporte
		   $('#chbImprimirDetalles_ajustes_bancarios_cuentas_pagar').val('NO');
		}

		//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
     	window.open("cuentas_pagar/ajustes_bancarios/get_xls/"
					+dteFechaInicialAjustesBancariosCuentasPagar+"/"
					+dteFechaFinalAjustesBancariosCuentasPagar+"/"
					+intCuentaIDAjustesBancariosCuentasPagar+"/"+
				   $('#cmbEstatusBusq_ajustes_bancarios_cuentas_pagar').val()+"/"+
				   $('#chbImprimirDetalles_ajustes_bancarios_cuentas_pagar').val()+"/"+$('#txtBusqueda_ajustes_bancarios_cuentas_pagar').val());
	}


	/*******************************************************************************************************************
	Funciones del modal
	*********************************************************************************************************************/
	// Función para limpiar los campos del formulario
	function nuevo_ajustes_bancarios_cuentas_pagar(tipoAccion)
	{
		//Incializar formulario
		$('#frmAjustesBancariosCuentasPagar')[0].reset();
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_ajustes_bancarios_cuentas_pagar();
		//Limpiar cajas de texto ocultas
		$('#frmAjustesBancariosCuentasPagar').find('input[type=hidden]').val('');
		//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
		$('#divEncabezadoModal_ajustes_bancarios_cuentas_pagar').removeClass("estatus-NUEVO");
		$('#divEncabezadoModal_ajustes_bancarios_cuentas_pagar').removeClass("estatus-ACTIVO");
		$('#divEncabezadoModal_ajustes_bancarios_cuentas_pagar').removeClass("estatus-INACTIVO");
		//Si el tipo de acción corresponde a Nuevo
		if(tipoAccion == 'Nuevo')
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_ajustes_bancarios_cuentas_pagar').addClass("estatus-NUEVO");
		}
		//Habilitar todos los elementos del formulario
		$('#frmAjustesBancariosCuentasPagar').find('input, textarea, select').removeAttr('disabled','disabled');
		//Deshabilitar las siguientes cajas de texto
		$('#txtFolio_ajustes_bancarios_cuentas_pagar').attr("disabled", "disabled");
		$('#txtTotal_ajustes_bancarios_cuentas_pagar').attr("disabled", "disabled");
		$('#txtMoneda_ajustes_bancarios_cuentas_pagar').attr("disabled", "disabled");
		//Asignar la fecha actual
		$('#txtFecha_ajustes_bancarios_cuentas_pagar').val(fechaActual()); 
		//Mostrar los siguientes botones
		$("#btnGuardar_ajustes_bancarios_cuentas_pagar").show();
		$("#btnReiniciar_ajustes_bancarios_cuentas_pagar").show();
		//Ocultar los siguientes botones
		$("#btnImprimirRegistro_ajustes_bancarios_cuentas_pagar").hide();
		$("#btnDesactivar_ajustes_bancarios_cuentas_pagar").hide();
		$("#btnRestaurar_ajustes_bancarios_cuentas_pagar").hide();		
	}

	//Función que se utiliza para cerrar el modal
	function cerrar_ajustes_bancarios_cuentas_pagar()
	{
		try {
			//Cerrar modal
			objAjustesBancariosCuentasPagar.close();
			//Enfocar caja de texto 
			$('#txtFechaInicialBusq_ajustes_bancarios_cuentas_pagar').focus();
		}
		catch(err) {}
	}	

	//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
	function validar_ajustes_bancarios_cuentas_pagar()
	{
		//Hacer un llamado a la función para limpiar los mensajes de error 
		limpiar_mensajes_ajustes_bancarios_cuentas_pagar();
		//Validación del formulario de campos obligatorios
		$('#frmAjustesBancariosCuentasPagar')
			.bootstrapValidator({
									excluded: [':disabled'],
								 	container: 'popover',
								 	feedbackIcons: {
								 		valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
								  	},
								  	fields: {
										strFecha_ajustes_bancarios_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strCuentaBancaria_ajustes_bancarios_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtCuentaBancariaID_ajustes_bancarios_cuentas_pagar').val() === '')
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
										strTipo_ajustes_bancarios_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										},
										intSubtotal_ajustes_bancarios_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un importe'}
											}
										},
										intPorcentajeIva_ajustes_bancarios_cuentas_pagar: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IVA
					                                    if($('#txtTasaCuotaIva_ajustes_bancarios_cuentas_pagar').val() === '')
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
										strConcepto_ajustes_bancarios_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un concepto'}
											}
										},
									    strObservaciones_ajustes_bancarios_cuentas_pagar: {
									        excluded: true  // Ignorar (no valida el campo)    
									    }
									}
								});
		//Variable que se utiliza para asignar el objeto bootstrapValidator
		var bootstrapValidator_ajustes_bancarios_cuentas_pagar = $('#frmAjustesBancariosCuentasPagar').data('bootstrapValidator');
		bootstrapValidator_ajustes_bancarios_cuentas_pagar.validate();
		//Si se cumplen las reglas de validación
		if(bootstrapValidator_ajustes_bancarios_cuentas_pagar.isValid())
		{
			guardar_ajustes_bancarios_cuentas_pagar();
		}
		else 
			return;
	}

	//Función para limpiar mensajes de validación del formulario
	function limpiar_mensajes_ajustes_bancarios_cuentas_pagar()
	{
		try
		{
			$('#frmAjustesBancariosCuentasPagar').data('bootstrapValidator').resetForm();
		}
		catch(err) {}
	}

	//Función para guardar o modificar los datos de un registro
	function guardar_ajustes_bancarios_cuentas_pagar()
	{	
		//Hacer un llamado al método del controlador para guardar los datos del registro
		$.post('cuentas_pagar/ajustes_bancarios/guardar',
				{ 
					intAjusteBancarioID: $('#txtAjusteBancarioID_ajustes_bancarios_cuentas_pagar').val(),
					strFolioConsecutivo: $('#txtFolio_ajustes_bancarios_cuentas_pagar').val(),
					//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					dteFecha: $.formatFechaMysql($('#txtFecha_ajustes_bancarios_cuentas_pagar').val()),
					intMonedaID: $('#txtMonedaID_ajustes_bancarios_cuentas_pagar').val(),
					intTipo: $('#cmbTipo_ajustes_bancarios_cuentas_pagar').val(),
					strConcepto: $('#txtConcepto_ajustes_bancarios_cuentas_pagar').val(),
					strObservaciones: $('#txtObservaciones_ajustes_bancarios_cuentas_pagar').val(),
					intCuentaBancariaID: $('#txtCuentaBancariaID_ajustes_bancarios_cuentas_pagar').val(),
					//Hacer un llamado a la función para reemplazar ',' por cadena vacia
					intSubtotal: $.reemplazar($('#txtSubtotal_ajustes_bancarios_cuentas_pagar').val(), ",", ""),
					intTasaCuotaIva: $('#txtTasaCuotaIva_ajustes_bancarios_cuentas_pagar').val(),
					intIva: $('#txtIva_ajustes_bancarios_cuentas_pagar').val(),
					intProcesoMenuID: $('#txtProcesoMenuID_ajustes_bancarios_cuentas_pagar').val()
				},
				function(data) {
					if (data.resultado)
					{	
	                    //Hacer un llamado a la función para cerrar modal e inicializar objeto bootstrapValidator
	                    cerrar_ajustes_bancarios_cuentas_pagar();
	                    //Hacer llamado a la función  para cargar  los registros en el grid
		               	paginacion_ajustes_bancarios_cuentas_pagar();	    
					}

					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_ajustes_bancarios_cuentas_pagar(data.tipo_mensaje, data.mensaje);

				},
		'json');
		
	}


	//Función para mostrar mensaje de éxito o error
	function mensaje_ajustes_bancarios_cuentas_pagar(tipoMensaje, mensaje)
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
		else if(tipoMensaje == 'informacion'){
			//Indicar al usuario el mensaje de advertencia
			new $.Zebra_Dialog(mensaje, 
						  {'type': 'information',
						   'title': 'Información'
			    		  });

		}else
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
	function cambiar_estatus_ajustes_bancarios_cuentas_pagar(id, estatus)
	{
		//Variable que se utiliza para asignar el id del registro
		var intID = 0;
		//Si no existe id, significa que se realizará la modificación desde el modal
		if(id == '')
		{
			intID = $('#txtAjusteBancarioID_ajustes_bancarios_cuentas_pagar').val();

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
					              'title':    'Ajuste Bancario',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('cuentas_pagar/ajustes_bancarios/set_estatus',
					                                     {
					                                     	intAjusteBancarioID: intID,
					                                      	strEstatus: estatus
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                            //Hacer llamado a la función  para cargar  los registros en el grid
					                                            paginacion_ajustes_bancarios_cuentas_pagar();

					                                            //Si el id del registro se obtuvo del modal
															    if(id == '')
															    {
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_ajustes_bancarios_cuentas_pagar();     
															    }
		 
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_ajustes_bancarios_cuentas_pagar(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });
	    }
	    else//Si el estatus del registro es INACTIVO
	    {
			//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
			$.post('cuentas_pagar/ajustes_bancarios/set_estatus',
			     {
			     	intAjusteBancarioID: intID,
			      	strEstatus: estatus
			     },
			     function(data) {
			      if (data.resultado)
			      {
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_ajustes_bancarios_cuentas_pagar();
			      		//Si el id del registro se obtuvo del modal
						if(id == '')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_ajustes_bancarios_cuentas_pagar();     
						}
			      }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_ajustes_bancarios_cuentas_pagar(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
	    }
	   
	}

	//Función para regresar los datos (al formulario) del registro seleccionado
	function editar_ajustes_bancarios_cuentas_pagar(id)
	{	
	   //Hacer un llamado al método del controlador para regresar los datos del registro
	   $.post('cuentas_pagar/ajustes_bancarios/get_datos',
       {
       		intAjusteBancarioID:id
       },
       function(data) {

       		//Si hay datos del registro
		    if(data.row)
		    {
		    	//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_ajustes_bancarios_cuentas_pagar('');
				//Asignar estatus del registro
				var strEstatus = data.row.estatus;

				//Recuperar valores
	            $('#txtAjusteBancarioID_ajustes_bancarios_cuentas_pagar').val(data.row.ajuste_bancario_id);
	            $('#txtFolio_ajustes_bancarios_cuentas_pagar').val(data.row.folio);
	            $('#txtFecha_ajustes_bancarios_cuentas_pagar').val(data.row.fecha);
	            $('#txtMonedaID_ajustes_bancarios_cuentas_pagar').val(data.row.moneda_id);
	            $('#txtMoneda_ajustes_bancarios_cuentas_pagar').val(data.row.moneda);
	            $('#cmbTipo_ajustes_bancarios_cuentas_pagar').val(data.row.tipo);
	            $('#txtConcepto_ajustes_bancarios_cuentas_pagar').val(data.row.concepto);
	            $('#txtObservaciones_ajustes_bancarios_cuentas_pagar').val(data.row.observaciones);
	            $('#txtCuentaBancariaID_ajustes_bancarios_cuentas_pagar').val(data.row.cuenta_bancaria_id);
	            $('#txtCuentaBancaria_ajustes_bancarios_cuentas_pagar').val(data.row.cuenta);
	            $('#txtSubtotal_ajustes_bancarios_cuentas_pagar').val(data.row.subtotal);
	            $('#txtTasaCuotaIva_ajustes_bancarios_cuentas_pagar').val(data.row.tasa_cuota_iva);
	            $('#txtPorcentajeIva_ajustes_bancarios_cuentas_pagar').val(data.row.porcentaje_iva);
	            //Hacer un llamado a la función para calcular el importe total del anticipo
				calcular_total_ajustes_bancarios_cuentas_pagar();
				//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
			    $('#txtSubtotal_ajustes_bancarios_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 2 });
	            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
	            $('#divEncabezadoModal_ajustes_bancarios_cuentas_pagar').addClass("estatus-" + strEstatus);
	            //Mostrar botón Imprimir  
	            $("#btnImprimirRegistro_ajustes_bancarios_cuentas_pagar").show();
	           	
				//Si el estatus del registro es INACTIVO
	            if(strEstatus == 'INACTIVO')
	            {
	            	//Deshabilitar todos los elementos del formulario
	            	$('#frmAjustesBancariosCuentasPagar').find('input, textarea, select').attr('disabled','disabled');
	            	//Ocultar los siguientes botones
		            $("#btnGuardar_ajustes_bancarios_cuentas_pagar").hide();
		            $("#btnReiniciar_ajustes_bancarios_cuentas_pagar").hide();
	            	//Mostrar botón Restaurar
	            	$("#btnRestaurar_ajustes_bancarios_cuentas_pagar").show();

	            }
	            else
	            {
		            //Mostrar los siguientes botones  
		            $("#btnDesactivar_ajustes_bancarios_cuentas_pagar").show();
		          
	            }

	            //Abrir modal
				objAjustesBancariosCuentasPagar = $('#AjustesBancariosCuentasPagarBox').bPopup({
											   appendTo: '#AjustesBancariosCuentasPagarContent', 
				                               contentContainer: 'AjustesBancariosCuentasPagarM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});

	            //Enfocar caja de texto
			    $('#cmbTipo_ajustes_bancarios_cuentas_pagar').focus();
		    }

       });
	}

	//Función que se utiliza para calcular el importe total del ajuste bancario
	function calcular_total_ajustes_bancarios_cuentas_pagar()
	{
		//Variable que se utiliza para asignar el subtotal
		var intSubtotal= 0;
		//Variable que se utiliza para asignar el importe de iva
		var intImporteIva = 0;
		//Variable que se utiliza para asignar el importe total
		var intTotal = 0;

		//Obtenemos los datos de las cajas de texto
		var intPorcentajeIva = $('#txtPorcentajeIva_ajustes_bancarios_cuentas_pagar').val();
		var intPorcentajeIeps = $('#txtPorcentajeIeps_ajustes_bancarios_cuentas_pagar').val();

     	//Verificar que exista importe de subtotal
		if($('#txtSubtotal_ajustes_bancarios_cuentas_pagar').val() != '')
		{ 
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intSubtotal = parseFloat($.reemplazar($("#txtSubtotal_ajustes_bancarios_cuentas_pagar").val(), ",", ""));

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
		intTotal = formatMoney(intTotal, 4, '');
		//Asignar importe total 
		$('#txtTotal_ajustes_bancarios_cuentas_pagar').val(intTotal);
		$('#txtIva_ajustes_bancarios_cuentas_pagar').val(intImporteIva);
	}


	//Controles o Eventos del Modal
	$(document).ready(function() 
	{
		/*******************************************************************************************************************
		Controles correspondientes al modal
		*********************************************************************************************************************/
		//Validar campos decimales (no hay necesidad de poner '.')
		$('#txtPorcentajeIva_ajustes_bancarios_cuentas_pagar').numeric();
		$('#txtSubtotal_ajustes_bancarios_cuentas_pagar').numeric();
    	$('#txtTotal_ajustes_bancarios_cuentas_pagar').numeric();

		//Agregar datepicker para seleccionar fecha
		$('#dteFecha_ajustes_bancarios_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFecha_ajustes_bancarios_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY', useCurrent: false});

		/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        * por ejemplo: 1800 será 1,800.00*/
    	$('.moneda_ajustes_bancarios_cuentas_pagar').blur(function(){
			$('.moneda_ajustes_bancarios_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 2 });
		});

	    //Autocomplete para recuperar los datos de una cuenta bancaria 
        $('#txtCuentaBancaria_ajustes_bancarios_cuentas_pagar').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtCuentaBancariaID_ajustes_bancarios_cuentas_pagar').val('');
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
             $('#txtCuentaBancariaID_ajustes_bancarios_cuentas_pagar').val(ui.item.data);
             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
             $.post('cuentas_pagar/cuentas_bancarias/get_datos',
                  { 
                  	strBusqueda:$('#txtCuentaBancariaID_ajustes_bancarios_cuentas_pagar').val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                        //Asignar datos del registro seleccionado
                        $("#txtMonedaID_ajustes_bancarios_cuentas_pagar").val(data.row.moneda_id);
                        $("#txtMoneda_ajustes_bancarios_cuentas_pagar").val(data.row.moneda);
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
        $('#txtCuentaBancaria_ajustes_bancarios_cuentas_pagar').focusout(function(e){
            //Si no existe id de la cuenta bancaria
            if($('#txtCuentaBancariaID_ajustes_bancarios_cuentas_pagar').val() == '' ||
               $('#txtCuentaBancaria_ajustes_bancarios_cuentas_pagar').val() == '')
            { 
                //Limpiar contenido de las siguientes cajas de texto
                $('#txtCuentaBancariaID_ajustes_bancarios_cuentas_pagar').val('');
                $('#txtCuentaBancaria_ajustes_bancarios_cuentas_pagar').val('');
                $('#txtMonedaID_ajustes_bancarios_cuentas_pagar').val('');
                $('#txtMoneda_ajustes_bancarios_cuentas_pagar').val('');
            }
            
        });


        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
        $('#txtPorcentajeIva_ajustes_bancarios_cuentas_pagar').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro 
               $('#txtTasaCuotaIva_ajustes_bancarios_cuentas_pagar').val('');
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
             $('#txtTasaCuotaIva_ajustes_bancarios_cuentas_pagar').val(ui.item.data);
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
        $('#txtPorcentajeIva_ajustes_bancarios_cuentas_pagar').focusout(function(e){
            //Si no existe id de la tasa o cuota
            if($('#txtTasaCuotaIva_ajustes_bancarios_cuentas_pagar').val() == '' ||
               $('#txtPorcentajeIva_ajustes_bancarios_cuentas_pagar').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtTasaCuotaIva_ajustes_bancarios_cuentas_pagar').val('');
               $('#txtPorcentajeIva_ajustes_bancarios_cuentas_pagar').val('');
            }
            
        });

        //Calcular el importe total del ajuste bancario cuando pierda el enfoque la caja de texto
		$('#txtSubtotal_ajustes_bancarios_cuentas_pagar').focusout(function(e){
			//Hacer un llamado a la función para calcular el importe total del ajuste bancario
			calcular_total_ajustes_bancarios_cuentas_pagar();
		});

		//Calcular el importe total del ajuste bancario cuando pierda el enfoque la caja de texto
		$('#txtPorcentajeIva_ajustes_bancarios_cuentas_pagar').focusout(function(e){
			//Hacer un llamado a la función para calcular el importe total del ajuste bancario
			calcular_total_ajustes_bancarios_cuentas_pagar();
		});

		
		/*******************************************************************************************************************
		Controles correspondientes al formulario principal
		*********************************************************************************************************************/
		//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
		$('#dteFechaInicialBusq_ajustes_bancarios_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
		$('#dteFechaFinalBusq_ajustes_bancarios_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY',
		 																		       useCurrent: false});
		//Deshabilitar los días posteriores a la fecha final
		$('#dteFechaInicialBusq_ajustes_bancarios_cuentas_pagar').on('dp.change', function (e) {
			$('#dteFechaFinalBusq_ajustes_bancarios_cuentas_pagar').data('DateTimePicker').minDate(e.date);
		});

		//Deshabilitar los días anteriores a la fecha inicial
		$('#dteFechaFinalBusq_ajustes_bancarios_cuentas_pagar').on('dp.change', function (e) {
			$('#dteFechaInicialBusq_ajustes_bancarios_cuentas_pagar').data('DateTimePicker').maxDate(e.date);
		});


		//Autocomplete para recuperar los datos de un evento 
        $('#txtCuentaBancariaBusq_ajustes_bancarios_cuentas_pagar').autocomplete({
            source: function( request, response ) {
               //Limpiar caja de texto que hace referencia al id del registro
               $('#txtCuentaBancariaIDBusq_ajustes_bancarios_cuentas_pagar').val('');
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
             	$('#txtCuentaBancariaIDBusq_ajustes_bancarios_cuentas_pagar').val(ui.item.data);
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
        $('#txtCuentaBancariaBusq_ajustes_bancarios_cuentas_pagar').focusout(function(e){
            //Si no existe id de la cuenta bancaria
            if($('#txtCuentaBancariaIDBusq_ajustes_bancarios_cuentas_pagar').val() == '' ||
               $('#txtCuentaBancariaBusq_ajustes_bancarios_cuentas_pagar').val() == '')
            { 
               //Limpiar contenido de las siguientes cajas de texto
               $('#txtCuentaBancariaIDBusq_ajustes_bancarios_cuentas_pagar').val('');
               $('#txtCuentaBancariaBusq_ajustes_bancarios_cuentas_pagar').val('');
            }

        });
        

        //Paginación de registros
		$('#pagLinks_ajustes_bancarios_cuentas_pagar').on('click','a',function(event){
			event.preventDefault();
			intPaginaAjustesBancariosCuentasPagar = $(this).attr('href').replace('/','');
			//Hacer llamado a la función  para cargar  los registros en el grid
			paginacion_ajustes_bancarios_cuentas_pagar();
		});


        //Abrir modal cuando se de clic en el botón
		$('#btnNuevo_ajustes_bancarios_cuentas_pagar').bind('click', function(e) {
			e.preventDefault();
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_ajustes_bancarios_cuentas_pagar('Nuevo');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_ajustes_bancarios_cuentas_pagar').addClass("estatus-NUEVO");
			//Abrir modal
			 objAjustesBancariosCuentasPagar = $('#AjustesBancariosCuentasPagarBox').bPopup({
										   appendTo: '#AjustesBancariosCuentasPagarContent', 
			                               contentContainer: 'AjustesBancariosCuentasPagarM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#cmbTipo_ajustes_bancarios_cuentas_pagar').focus();
		});


		//Enfocar caja de texto
		$('#txtBusqueda_ajustes_bancarios_cuentas_pagar').focus(); 	
		//Hacer un llamado a la función para obtener los permisos de acceso
		permisos_ajustes_bancarios_cuentas_pagar();

	});

</script>				