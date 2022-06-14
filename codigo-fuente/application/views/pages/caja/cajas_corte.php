	<div id="CajasCorteCajaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_cajas_corte_caja" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_cajas_corte_caja" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_cajas_corte_caja">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_cajas_corte_caja'>
				                    <input class="form-control" id="txtFechaInicialBusq_cajas_corte_caja"
				                    		name= "strFechaInicialBusq_cajas_corte_caja" 
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
								<label for="txtFechaFinalBusq_cajas_corte_caja">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_cajas_corte_caja'>
				                    <input class="form-control" id="txtFechaFinalBusq_cajas_corte_caja"
				                    		name= "strFechaFinalBusq_cajas_corte_caja" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los usuarios activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del usuario seleccionado-->
								<input id="txtUsuarioIDBusq_cajas_corte_caja" 
									   name="intUsuarioIDBusq_cajas_corte_caja"  type="hidden" 
									   value="">
								</input>
								<label for="txtUsuarioBusq_cajas_corte_caja">Usuario</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtUsuarioBusq_cajas_corte_caja" 
										name="strUsuarioBusq_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese usuario" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Tipo-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbTipoBusq_cajas_corte_caja">Tipo</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbTipoBusq_cajas_corte_caja" 
								 		name="strTipoBusq_cajas_corte_caja" tabindex="1">
								 	<option value="">Seleccione un tipo</option>
                      				<option value="ARQUEO">ARQUEO</option>
                      				<option value="CIERRE">CIERRE</option>
                 				</select>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_cajas_corte_caja"
									onclick="paginacion_cajas_corte_caja();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_cajas_corte_caja" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_cajas_corte_caja"
									onclick="reporte_cajas_corte_caja('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_cajas_corte_caja"
									onclick="reporte_cajas_corte_caja('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Fecha"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Usuario"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Tipo"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_cajas_corte_caja">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Fecha</th>
							<th class="movil">Usuario</th>
							<th class="movil">Tipo</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_cajas_corte_caja" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{usuario}}</td>
							<td class="movil">{{tipo}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_cajas_corte_caja({{caja_corte_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
							    <!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_cajas_corte_caja({{caja_corte_id}},'Ver')" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
                            	<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_cajas_corte_caja({{caja_corte_id}},'{{tipo}}')"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_cajas_corte_caja({{caja_corte_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_cajas_corte_caja({{caja_corte_id}},'{{estatus}}')"  
										title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_cajas_corte_caja"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_cajas_corte_caja">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="CajasCorteCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_cajas_corte_caja"  class="ModalBodyTitle">
			<h1>Cierre de Caja</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCajasCorteCaja" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmCajasCorteCaja"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtCajaCorteID_cajas_corte_caja" 
										   name="intCajaCorteID_cajas_corte_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la caja de apertura de la sucursal-->
									<input id="txtCajaAperturaID_cajas_corte_caja" 
										   name="intCajaAperturaID_cajas_corte_caja" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el importe teórico de la sucursal-->
									<input id="txtImporteTeorico_cajas_corte_caja" 
										   name="intImporteTeorico_cajas_corte_caja" type="hidden" value="">
									</input>
									<label for="txtFecha_cajas_corte_caja">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_cajas_corte_caja'>
					                    <input class="form-control" id="txtFecha_cajas_corte_caja"
					                    		name= "strFecha_cajas_corte_caja" 
					                    		type="text" value=""  tabindex="1" 
					                    		placeholder="Ingrese fecha" maxlength="10" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Hora-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHora_cajas_corte_caja">Hora</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class="input-group bootstrap-timepicker timepicker" id="dteHora_cajas_corte_caja">
							            <input 	id="txtHora_cajas_corte_caja"
							            		name= "strHora_cajas_corte_caja" 
							            		type="text" value=""  tabindex="1" placeholder="Ingrese hora" class="form-control input-small" />
							            <span class="input-group-addon">
							            	<i class="glyphicon glyphicon-time"></i>
							            </span>
							        </div>
								</div>
							</div>
						</div>
						<!--Usuario-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuario_cajas_corte_caja">Usuario</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuario_cajas_corte_caja" 
											name="strUsuario_cajas_corte_caja" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Tipo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipo_cajas_corte_caja">Tipo</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" id="cmbTipo_cajas_corte_caja" 
									 		name="strTipo_cajas_corte_caja" tabindex="1">
                          				<option value="ARQUEO">ARQUEO</option>
                          				<option value="CIERRE">CIERRE</option>
                     				</select>
								</div>
							</div>
						</div>
				    	<!--Billetes de 1000-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMil_cajas_corte_caja">Billetes de $1,000.00</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMil_cajas_corte_caja" 
											name="intMil_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Billetes de 500-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtQuinientos_cajas_corte_caja">Billetes de $500.00</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtQuinientos_cajas_corte_caja" 
											name="intQuinientos_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Billetes de 200-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDoscientos_cajas_corte_caja">Billetes de $200.00</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDoscientos_cajas_corte_caja" 
											name="intDoscientos_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Billetes de 100-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCien_cajas_corte_caja">Billetes de $100.00</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCien_cajas_corte_caja" 
											name="intCien_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    
						<!--Billetes de 50-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCincuenta_cajas_corte_caja">Billetes de $50.00</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCincuenta_cajas_corte_caja" 
											name="intCincuenta_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
				    	<!--Billetes de 20-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtVeinte_cajas_corte_caja">Billetes de $20.00</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtVeinte_cajas_corte_caja" 
											name="intVeinte_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Monedas de diez-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDiez_cajas_corte_caja">Monedas de $10.00</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDiez_cajas_corte_caja" 
											name="intDiez_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Monedas de cinco-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCinco_cajas_corte_caja">Monedas de $5.00</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCinco_cajas_corte_caja" 
											name="intCinco_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Monedas de dos-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDos_cajas_corte_caja">Monedas de $2.00</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDos_cajas_corte_caja" 
											name="intDos_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Monedas de uno-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUno_cajas_corte_caja">Monedas de $1.00</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUno_cajas_corte_caja" 
											name="intUno_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Monedas de cincuenta centavos-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCincuentaCentavos_cajas_corte_caja">Monedas de 50 c.</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCincuentaCentavos_cajas_corte_caja" 
											name="intCincuentaCentavos_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Monedas de veinte centavos-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtVeinteCentavos_cajas_corte_caja">Monedas de 20 c.</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtVeinteCentavos_cajas_corte_caja" 
											name="intVeinteCentavos_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Monedas de diez centavos-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDiezCentavos_cajas_corte_caja">Monedas de 10 c.</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDiezCentavos_cajas_corte_caja" 
											name="intDiezCentavos_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
						<!--Monedas de cinco centavos-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDiezCentavos_cajas_corte_caja">Monedas de 5 c.</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCincoCentavos_cajas_corte_caja" 
											name="intCincoCentavos_cajas_corte_caja" type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="3">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_cajas_corte_caja"  
									onclick="validar_cajas_corte_caja();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_cajas_corte_caja"  
									onclick="reporte_registro_cajas_corte_caja('');"  title="Imprimir registro en PDF" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_cajas_corte_caja"  
									onclick="cambiar_estatus_cajas_corte_caja('','ACTIVO');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_cajas_corte_caja"  
									onclick="cambiar_estatus_cajas_corte_caja('','INACTIVO');"  title="Restaurar" tabindex="5" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cajas_corte_caja"
									type="reset" aria-hidden="true" onclick="cerrar_cajas_corte_caja();" 
									title="Cerrar"  tabindex="6">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#CajasCorteCajaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variable que se utiliza para asignar hora actual
		var strHoraActualCajasCorteCaja;
		//Variables que se utilizan para la paginación de registros
		var intPaginaCajasCorteCaja = 0;
		var strUltimaBusquedaCajasCorteCaja = "";
		//Variable que se utiliza para asignar objeto del modal
		var objCajasCorteCaja = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_cajas_corte_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/cajas_corte/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_cajas_corte_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCajasCorteCaja = data.row;
					//Separar la cadena 
					var arrPermisosCajasCorteCaja = strPermisosCajasCorteCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCajasCorteCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCajasCorteCaja[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_cajas_corte_caja').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosCajasCorteCaja[i]=='GUARDAR') || (arrPermisosCajasCorteCaja[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_cajas_corte_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasCorteCaja[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_cajas_corte_caja').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_cajas_corte_caja();
						}
						else if(arrPermisosCajasCorteCaja[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_cajas_corte_caja').removeAttr('disabled');
							$('#btnRestaurar_cajas_corte_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasCorteCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_cajas_corte_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasCorteCaja[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_cajas_corte_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasCorteCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_cajas_corte_caja').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_cajas_corte_caja() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaCajasCorteCaja =($('#txtFechaInicialBusq_cajas_corte_caja').val()+$('#txtFechaFinalBusq_cajas_corte_caja').val()+$('#txtUsuarioIDBusq_cajas_corte_caja').val()+$('#cmbTipoBusq_cajas_corte_caja').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaCajasCorteCaja != strUltimaBusquedaCajasCorteCaja)
			{
				intPaginaCajasCorteCaja = 0;
				strUltimaBusquedaCajasCorteCaja = strNuevaBusquedaCajasCorteCaja;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/cajas_corte/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_cajas_corte_caja').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_cajas_corte_caja').val()),
						intUsuarioID: $('#txtUsuarioIDBusq_cajas_corte_caja').val(),
						strTipo: $('#cmbTipoBusq_cajas_corte_caja').val(),
						intPagina:intPaginaCajasCorteCaja,
						strPermisosAcceso: $('#txtAcciones_cajas_corte_caja').val()
					},
					function(data){
						$('#dg_cajas_corte_caja tbody').empty();
						var tmpCajasCorteCaja = Mustache.render($('#plantilla_cajas_corte_caja').html(),data);
						$('#dg_cajas_corte_caja tbody').html(tmpCajasCorteCaja);
						$('#pagLinks_cajas_corte_caja').html(data.paginacion);
						$('#numElementos_cajas_corte_caja').html(data.total_rows);
						intPaginaCajasCorteCaja = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_cajas_corte_caja(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'caja/cajas_corte/';

			//Si el tipo de reporte es PDF
			if(strTipo == 'PDF')
			{
				//Concatenar nombre de la función que genera el reporte PDF
				strUrl += 'get_reporte';
			}
			else
			{
				//Concatenar nombre de la función que genera el archivo XLS
				strUrl += "get_xls";
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_cajas_corte_caja').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_cajas_corte_caja').val()),
										'intUsuarioID': $('#txtUsuarioIDBusq_cajas_corte_caja').val(),
										'strTipo': $('#cmbTipoBusq_cajas_corte_caja').val() 
									 }
						   };

			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_cajas_corte_caja(id, tipo) 
		{
			//Variables que se utilizan para asignar los datos del registro
			var intCajaCorteIDCajasCorteCaja = 0;
			var strTipoCajasCorteCaja = '';
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intCajaCorteIDCajasCorteCaja = $('#txtCajaCorteID_cajas_corte_caja').val();
				strTipoCajasCorteCaja =  $('#cmbTipo_cajas_corte_caja').val(); 
			}
			else
			{
				intCajaCorteIDCajasCorteCaja = id;
				strTipoCajasCorteCaja = tipo; 
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'caja/cajas_corte/get_reporte_registro',
							'data' : {
										'intCajaCorteID': intCajaCorteIDCajasCorteCaja, 
										'strTipo': strTipoCajasCorteCaja, 

									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);

		}

		
		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_cajas_corte_caja()
		{
			//Recuperar valores del usuario logeado en el sistema
			var strUsuarioCajasCorteCaja = '<?php echo $this->session->userdata('usuario') ?>';
			var strEmpleadoCajasCorteCaja = '<?php echo $this->session->userdata('empleado') ?>';
			//Si existe nombre del empleado
			if(strEmpleadoCajasCorteCaja != '')
			{   
				strUsuarioCajasCorteCaja = strUsuarioCajasCorteCaja+' - '+strEmpleadoCajasCorteCaja;
			}
			//Incializar formulario
			$('#frmCajasCorteCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cajas_corte_caja();
			//Limpiar cajas de texto ocultas
			$('#frmCajasCorteCaja').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cajas_corte_caja');
			//Habilitar todos los elementos del formulario
			$('#frmCajasCorteCaja').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar cajas de texto
			//$('#txtFecha_cajas_corte_caja').attr("disabled", "disabled");
			//$('#txtHora_cajas_corte_caja').attr("disabled", "disabled");
			$('#txtUsuario_cajas_corte_caja').attr("disabled", "disabled");
			//Asignar la fecha actual
			$('#txtFecha_cajas_corte_caja').val(fechaActual()); 
			$('#txtUsuario_cajas_corte_caja').val(strUsuarioCajasCorteCaja);
			//Mostrar botón Guardar
			$("#btnGuardar_cajas_corte_caja").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_cajas_corte_caja").hide();
			$("#btnRestaurar_cajas_corte_caja").hide();
			$("#btnImprimirRegistro_cajas_corte_caja").hide();
			
		}
		

		//Función que se utiliza para cerrar el modal
		function cerrar_cajas_corte_caja()
		{
			try {
				//Hacer un llamado a la función para detener temporizador de hora actual
				get_hora_actual_cajas_corte_caja('Detener');
				//Cerrar modal
				objCajasCorteCaja.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_cajas_corte_caja').focus();
			}
			catch(err) {}
		}


		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cajas_corte_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cajas_corte_caja();
			//Validación del formulario de campos obligatorios
			$('#frmCajasCorteCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_cajas_corte_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strHora_cajas_corte_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una hora'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cajas_corte_caja = $('#frmCajasCorteCaja').data('bootstrapValidator');
			bootstrapValidator_cajas_corte_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cajas_corte_caja.isValid())
			{
				//Verificar que exista al menos una cantidad
				if($('#txtMil_cajas_corte_caja').val() == '' && 
				   $('#txtQuinientos_cajas_corte_caja').val() == '' &&
				   $('#txtDoscientos_cajas_corte_caja').val() == '' &&
				   $('#txtCien_cajas_corte_caja').val() == '' &&
				   $('#txtCincuenta_cajas_corte_caja').val() == '' &&
				   $('#txtVeinte_cajas_corte_caja').val() == '' &&
				   $('#txtDiez_cajas_corte_caja').val() == '' &&
				   $('#txtCinco_cajas_corte_caja').val() == '' &&
				   $('#txtDos_cajas_corte_caja').val() == '' &&
				   $('#txtUno_cajas_corte_caja').val() == '' &&
				   $('#txtCincuentaCentavos_cajas_corte_caja').val() == '' &&
				   $('#txtVeinteCentavos_cajas_corte_caja').val() == '' &&
				   $('#txtDiezCentavos_cajas_corte_caja').val() == ''  &&
				   $('#txtCincoCentavos_cajas_corte_caja').val() == '')
				{
					//Indicar al usuario que debe ingresar al menos una cantidad de billetes o monedas
					new $.Zebra_Dialog('Escriba al menos una cantidad para este corte.', {
							'type': 'error',
							'title': 'Error',
							'buttons': [{caption: 'Aceptar',
										 callback: function () {
											//Enfocar caja de texto
											$('#txtMil_cajas_corte_caja').focus();
										 }
										}]
						});
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_cajas_corte_caja();
				}
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cajas_corte_caja()
		{
			try
			{
				$('#frmCajasCorteCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}


		//Función para verificar que la caja de la sucursal no se encuentre abierta
		function get_apertura_caja_cajas_corte_caja()
		{
			//Hacer un llamado al método del controlador para verificar existencia de caja abierta
			$.post('caja/cajas_apertura/get_existencia',
			       {strFormulario: ''
			       },
			       function(data) {
			        	//Si no hay caja abierta
			            if(data.mensaje)
			            {
			            	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_cajas_corte_caja('error', data.mensaje);
			       	    }
			       	    else
			       	    {	

			       	    	//Variables que se utilizan para el cálculo del importe teórico
			       	    	var intImporteTeorico = 0;
			       	    	//Importe de apertura
			       	    	var intImporteApertura = parseFloat(data.row.importe_apertura);
			       	    	intImporteApertura += parseFloat(data.row.importe_interno);
			       	    	intImporteApertura += parseFloat(data.row.saldo);
			       	    	//Importe de vales de caja
			       	    	var intImporteVales = parseFloat(data.row.importe_cajas_vales);
			       	    	//Importe de devolución 
			       	    	var intImporteDevolucion = parseFloat(data.row.importe_cajas_vales_devoluciones);
			       	    	//Importe de pagos 
			       	    	var intImportePagos = parseFloat(data.row.importe_cajas_pagos);
			       	    	//Importe de ingresos 
			       	    	var intImporteIngresos = parseFloat(data.row.importe_cajas_ingresos);
			       	    	
			       	    	//Calcular importe teórico
			       	        intImporteTeorico = (intImporteApertura - intImporteVales) + intImporteDevolucion + intImportePagos + intImporteIngresos;

			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cajas_corte_caja();
							//Hacer un llamado a la función para iniciar temporizador de hora actual
							get_hora_actual_cajas_corte_caja('Iniciar');
							//Recuperar valores
							$('#txtCajaAperturaID_cajas_corte_caja').val(data.row.caja_apertura_id);
							//Asignar importe teórico
							$('#txtImporteTeorico_cajas_corte_caja').val(intImporteTeorico);
							//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
							$('#divEncabezadoModal_cajas_corte_caja').addClass("estatus-NUEVO");
							
							//Abrir modal
							 objCajasCorteCaja = $('#CajasCorteCajaBox').bPopup({
													   appendTo: '#CajasCorteCajaContent', 
						                               contentContainer: 'CajasCorteCajaM', 
						                               zIndex: 2, 
						                               modalClose: false, 
						                               modal: true, 
						                               follow: [true,false], 
						                               followEasing : "linear", 
						                               easing: "linear", 
						                               modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtMil_cajas_corte_caja').focus();
				            
			       	    }
			       },
			       'json');
		}

		//Función para iniciar o detener temporizador de hora actual
		function get_hora_actual_cajas_corte_caja(tipoAccion)
		{
			//Si el tipo de acción corrresponde a Iniciar
			if(tipoAccion == 'Iniciar')
			{
				//Asignar hora actual
				$('#txtHora_cajas_corte_caja').val(horaActual());
				$('#txtHora_cajas_corte_caja').timepicker('setTime', horaActual());
				//Asignar temporizador para cambiar hora actual (hora:minutos:segundos)
				//strHoraActualCajasCorteCaja =  setTimeout(function(){ get_hora_actual_cajas_corte_caja(tipoAccion)}, 1000);
			}
			else
			{
				//Borrar temporizador establecido con el método setTimeout()
				clearTimeout(strHoraActualCajasCorteCaja);
			}
	     }

		//Función para guardar o modificar los datos de un registro
		function guardar_cajas_corte_caja()
		{
			
			//Asignar datos de la fecha y hora
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaCierre = $.formatFechaMysql($('#txtFecha_cajas_corte_caja').val());
			//Hacer un llamado a la función para convertir hora a formato 24
			var strHora = convertirHora12a24($('#txtHora_cajas_corte_caja').val());

			//Concatenar los datos de la fecha y hora
			dteFechaCierre += ' '+strHora;

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('caja/cajas_corte/guardar',
					{ 
						intCajaCorteID: $('#txtCajaCorteID_cajas_corte_caja').val(),
						intCajaAperturaID: $('#txtCajaAperturaID_cajas_corte_caja').val(),
						dteFecha: dteFechaCierre,
						strTipo: $('#cmbTipo_cajas_corte_caja').val(),
						intImporteTeorico: $('#txtImporteTeorico_cajas_corte_caja').val(),
						intMil: $('#txtMil_cajas_corte_caja').val(),
						intQuinientos: $('#txtQuinientos_cajas_corte_caja').val(),
						intDoscientos: $('#txtDoscientos_cajas_corte_caja').val(),
						intCien: $('#txtCien_cajas_corte_caja').val(),
						intCincuenta: $('#txtCincuenta_cajas_corte_caja').val(),
						intVeinte: $('#txtVeinte_cajas_corte_caja').val(),
						intDiez: $('#txtDiez_cajas_corte_caja').val(),
						intCinco: $('#txtCinco_cajas_corte_caja').val(),
						intDos: $('#txtDos_cajas_corte_caja').val(),
						intUno: $('#txtUno_cajas_corte_caja').val(),
						intCincuentaCentavos: $('#txtCincuentaCentavos_cajas_corte_caja').val(),
						intVeinteCentavos: $('#txtVeinteCentavos_cajas_corte_caja').val(),
						intDiezCentavos: $('#txtDiezCentavos_cajas_corte_caja').val(),
						intCincoCentavos: $('#txtCincoCentavos_cajas_corte_caja').val(),
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_cajas_corte_caja();
							//Hacer un llamado a la función para cerrar modal
							cerrar_cajas_corte_caja();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cajas_corte_caja(data.tipo_mensaje, data.mensaje);
					},
			'json');
			
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_cajas_corte_caja(tipoMensaje, mensaje)
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
		function cambiar_estatus_cajas_corte_caja(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';

			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCajaCorteID_cajas_corte_caja').val();

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
				              'title':    'Cierre de Caja',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_cajas_corte_caja(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_cajas_corte_caja(intID, strTipo, 'ACTIVO');
		    }
		}



		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_cajas_corte_caja(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('caja/cajas_corte/set_estatus',
			      {intCajaCorteID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_cajas_corte_caja();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cajas_corte_caja();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_cajas_corte_caja(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_cajas_corte_caja(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('caja/cajas_corte/get_datos',
			       {intCajaCorteID: id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cajas_corte_caja();
						    //Asignar estatus del registro
				            var strEstatus = data.row.estatus;

							//Recuperar valores
				            $('#txtCajaCorteID_cajas_corte_caja').val(data.row.caja_corte_id);
				            $('#txtCajaAperturaID_cajas_corte_caja').val(data.row.caja_apertura_id);
				            $('#txtFecha_cajas_corte_caja').val(data.row.fecha);
				            $('#txtHora_cajas_corte_caja').val(data.row.hora);
				            $('#txtUsuario_cajas_corte_caja').val(data.row.usuario);
				            $('#cmbTipo_cajas_corte_caja').val(data.row.tipo);
				            $('#txtMil_cajas_corte_caja').val(data.row.mil);
				            $('#txtQuinientos_cajas_corte_caja').val(data.row.quinientos);
				            $('#txtDoscientos_cajas_corte_caja').val(data.row.doscientos);
				            $('#txtCien_cajas_corte_caja').val(data.row.cien);
				            $('#txtCincuenta_cajas_corte_caja').val(data.row.cincuenta);
				            $('#txtVeinte_cajas_corte_caja').val(data.row.veinte);
				            $('#txtDiez_cajas_corte_caja').val(data.row.diez);
				            $('#txtCinco_cajas_corte_caja').val(data.row.cinco);
				            $('#txtDos_cajas_corte_caja').val(data.row.dos);
				            $('#txtUno_cajas_corte_caja').val(data.row.uno);
				            $('#txtCincuentaCentavos_cajas_corte_caja').val(data.row.cincuenta_centavos);
				            $('#txtVeinteCentavos_cajas_corte_caja').val(data.row.veinte_centavos);
				            $('#txtDiezCentavos_cajas_corte_caja').val(data.row.diez_centavos);
				            $('#txtCincoCentavos_cajas_corte_caja').val(data.row.cinco_centavos);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_cajas_corte_caja').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_cajas_corte_caja").show();

				            //Si el tipo de corte de caja corresponde a un ARQUEO
		   					if(data.row.tipo== 'ARQUEO' && data.row.estatus_caja_apertura == 'ABIERTA')
		   					{
		   						//Si el estatus del registro es ACTIVO
								if(strEstatus == 'ACTIVO')
								{
									//Mostrar botón Desactivar
				            		$("#btnDesactivar_cajas_corte_caja").show();
								}
								else
								{
									//Mostrar botón Restaurar
									$("#btnRestaurar_cajas_corte_caja").show();
								}

		   					}

				            //Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmCajasCorteCaja').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					            $("#btnGuardar_cajas_corte_caja").hide();
				            }
				            else
				            {
				            	//Hacer un llamado al método del controlador para verificar existencia de caja abierta
								$.post('caja/cajas_apertura/get_existencia',
								       {strFormulario: ''
								       },
								       function(data) {
								       		//Si hay datos del registro
								            if(data.row)
								            {
								            	//Hacer un llamado a la función para iniciar temporizador de hora actual
								       	    	get_hora_actual_cajas_corte_caja('Iniciar');
								       	    	//Calcular importe teórico
								       	    	var intImporteTeoricoCajasCorteCaja = parseFloat(data.row.importe_apertura - data.row.importe_cajas_vales) + parseFloat(data.row.importe_cajas_vales_devoluciones) + parseFloat(data.row.importe_cajas_ingresos);
												//Asignar importe teórico
												$('#txtImporteTeorico_cajas_corte_caja').val(intImporteTeoricoCajasCorteCaja);
								            }
								       },
								       'json');
				            }
				      
			            	//Abrir modal
				            objCajasCorteCaja = $('#CajasCorteCajaBox').bPopup({
														  appendTo: '#CajasCorteCajaContent', 
							                              contentContainer: 'CajasCorteCajaM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtMil_cajas_corte_caja').focus();
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
			$('#txtMil_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtQuinientos_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtDoscientos_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtCien_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtCincuenta_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtVeinte_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtDiez_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtCinco_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtDos_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtUno_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtCincuentaCentavos_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtVeinteCentavos_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtDiezCentavos_cajas_corte_caja').numeric({decimal: false, negative: false});
			$('#txtCincoCentavos_cajas_corte_caja').numeric({decimal: false, negative: false});

			
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_cajas_corte_caja').datetimepicker({format: 'DD/MM/YYYY'});

			//Agregar timepicker para seleccionar una hora
			$('#txtHora_cajas_corte_caja').timepicker({format: 'HH:mm:ss',
														  minuteStep: 1,
														  showSeconds: true,
														  secondStep: 1});

			$('#txtHora_cajas_corte_caja').timepicker('setTime', '');


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_cajas_corte_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_cajas_corte_caja').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_cajas_corte_caja').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_cajas_corte_caja').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_cajas_corte_caja').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_cajas_corte_caja').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un usuario 
	        $('#txtUsuarioBusq_cajas_corte_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtUsuarioIDBusq_cajas_corte_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "seguridad/usuarios/autocomplete",
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
	             $('#txtUsuarioIDBusq_cajas_corte_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del usuario cuando pierda el enfoque la caja de texto
	        $('#txtUsuarioBusq_cajas_corte_caja').focusout(function(e){
	            //Si no existe id del usuario
	            if($('#txtUsuarioIDBusq_cajas_corte_caja').val() == '' ||  
	               $('#txtUsuarioBusq_cajas_corte_caja').val() == '' )
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUsuarioIDBusq_cajas_corte_caja').val('');
	               $('#txtUsuarioBusq_cajas_corte_caja').val('');
	            }
	            
	        });

			//Paginación de registros
			$('#pagLinks_cajas_corte_caja').on('click','a',function(event){
				event.preventDefault();
				intPaginaCajasCorteCaja = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_cajas_corte_caja();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_cajas_corte_caja').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para verificar que la caja no se encuentre abierta
				get_apertura_caja_cajas_corte_caja();
				
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_cajas_corte_caja').focus();   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_cajas_corte_caja();
		});
	</script>