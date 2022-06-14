	<div id="CajasValesCajaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_cajas_vales_caja" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_cajas_vales_caja" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_cajas_vales_caja">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_cajas_vales_caja'>
				                    <input class="form-control" id="txtFechaInicialBusq_cajas_vales_caja"
				                    		name= "strFechaInicialBusq_cajas_vales_caja" 
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
								<label for="txtFechaFinalBusq_cajas_vales_caja">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_cajas_vales_caja'>
				                    <input class="form-control" id="txtFechaFinalBusq_cajas_vales_caja"
				                    		name= "strFechaFinalBusq_cajas_vales_caja" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene las sucursales activas-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal seleccionada-->
								<input id="txtSucursalGastoIDBusq_cajas_vales_caja" 
									   name="intSucursalGastoIDBusq_cajas_vales_caja"  type="hidden" 
									   value="">
								</input>
								<label for="txtSucursalGastoBusq_cajas_vales_caja">Sucursal</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtSucursalGastoBusq_cajas_vales_caja" 
										name="strSucursalGastoBusq_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese sucursal" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_cajas_vales_caja">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_cajas_vales_caja" 
								 		name="strEstatusBusq_cajas_vales_caja" tabindex="1">
								    <option value="TODOS">TODOS</option>
	                  				<option value="ACTIVO">ACTIVO</option>
	                  				<option value="AUTORIZADO">AUTORIZADO</option>
	                  				<option value="RECHAZADO">RECHAZADO</option>
	                  				<option value="CERRADO">CERRADO</option>
	                  				<option value="INACTIVO">INACTIVO</option>
                 				</select>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	
			    	<!--Autocomplete que contiene los empleados y proveedores activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado/proveedor seleccionado-->
								<input id="txtReferenciaIDBusq_cajas_vales_caja" 
									   name="intReferenciaIDBusq_cajas_vales_caja"  type="hidden" 
									   value="">
								</input>
								<!-- Caja de texto oculta que se utiliza para recuperar el tipo de referencia correspondiente al id seleccionado-->
								<input id="txtTipoReferenciaBusq_cajas_vales_caja" 
									   name="strTipoReferenciaBusq_cajas_vales_caja"  type="hidden" 
									   value="">
								</input>
								<label for="txtReferenciaBusq_cajas_vales_caja">Empleado/Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtReferenciaBusq_cajas_vales_caja" 
										name="strReferenciaBusq_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese empleado o proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Descripción-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_cajas_vales_caja">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_cajas_vales_caja" 
										name="strBusqueda_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_cajas_vales_caja"
									onclick="paginacion_cajas_vales_caja();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_cajas_vales_caja" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_cajas_vales_caja"
									onclick="reporte_cajas_vales_caja();" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_cajas_vales_caja"
									onclick="descargar_xls_cajas_vales_caja();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla vales de caja
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Referencia"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Importe"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles del vale de caja
				*/
				td.movil.b1:nth-of-type(1):before {content: "Tipo"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Factura"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Gasto"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Concepto"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Importe"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Acciones"; font-weight: bold;}


				/*
				Definir columnas de los totales (acumulados) de la tabla detalles del vale de caja
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "Importe"; font-weight: bold;}
				td.movil.t6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.t7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.t8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_cajas_vales_caja">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Referencia</th>
							<th class="movil">Importe</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:13em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_cajas_vales_caja" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{referencia}}</td>
							<td class="movil a4">{{importe}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="td-center movil a6"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_cajas_vales_caja({{caja_vale_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_cajas_vales_caja({{caja_vale_id}}, 'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!---Autorizar o rechazar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionAutorizar}}"  
										onclick="abrir_autorizar_cajas_vales_caja({{caja_vale_id}},'{{folio}}', 'Autorizar');"  title="Autorizar o Rechazar">
									<span class="fa fa-check-square-o"></span>
								</button>
								<!---Finalizar (cerrar) registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionFinalizar}}"  
										onclick="cambiar_estatus_cajas_vales_caja({{caja_vale_id}}, 'CERRADO');"  title="Finalizar">
									<span class="glyphicon glyphicon-tasks"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_cajas_vales_caja({{caja_vale_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Descargar archivos-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_cajas_vales_caja({{caja_vale_id}}, '{{folio}}');" title="Descargar archivos">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_cajas_vales_caja({{caja_vale_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_cajas_vales_caja({{caja_vale_id}},'{{estatus}}')"  title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="6"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_cajas_vales_caja"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_cajas_vales_caja">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Autorizar Vale de Caja Chica -->
		<div id="AutorizarCajasValesCajaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_autorizar_cajas_vales_caja" class="ModalBodyTitle confirmacion-modal-title"">
			<h1 id="tituloModal_autorizar_cajas_vales_caja"></h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAutorizarCajasValesCaja" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmAutorizarCajasValesCaja"  onsubmit="return(false)" autocomplete="off">
			    	<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReferenciaID_autorizar_cajas_vales_caja" 
										   name="intReferenciaID_autorizar_cajas_vales_caja" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el tipo de acción (guardar o autorizar) a realizar --> 
									<input type="hidden" id="txtTipoAccion_autorizar_cajas_vales_caja" 
										   name="strTipoAccion_autorizar_cajas_vales_caja" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el folio del registro seleccionado--> 
									<input type="hidden" id="txtFolio_autorizar_cajas_vales_caja" 
										   name="strFolio_autorizar_cajas_vales_caja" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Vales de Caja Chica-->
									<input id="txtModalCajasVales_autorizar_cajas_vales_caja" 
										   name="strModalCajasVales_autorizar_cajas_vales_caja" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para asignar a los usuarios que se les enviará 
									     el mensaje--> 
									<input type="hidden" id="txtUsuarios_autorizar_cajas_vales_caja" 
										   name="strUsuarios_autorizar_cajas_vales_caja" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Enviar notificación a:</h4>
										</div>
										<div class="panel-body">
											<div id="treeUsuarios_autorizar_cajas_vales_caja" class="md-list-item-text"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="divEstatus_autorizar_cajas_vales_caja" class="row no-mostrar">
						<!--Estatus-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbEstatus_autorizar_cajas_vales_caja">Estatus</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbEstatus_autorizar_cajas_vales_caja" 
									 		name="strEstatus_autorizar_cajas_vales_caja" tabindex="1">
									    <option value="">Seleccione una opción</option>
									    <option value="AUTORIZADO">AUTORIZADO</option>
		                                <option value="RECHAZADO">RECHAZADO</option>
                     				</select>
								</div>
							</div>
						</div>
					</div>
			    	<div class="row">
				    	<!--Mensaje-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMensaje_autorizar_cajas_vales_caja">Mensaje</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtMensaje_autorizar_cajas_vales_caja" 
											   name="strMensaje_autorizar_cajas_vales_caja" rows="5" value="" tabindex="1" placeholder="Ingrese mensaje" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Autorizar o rechazar registro-->
							<button class="btn btn-success" id="btnGuardar_autorizar_cajas_vales_caja"  
									onclick="validar_autorizar_cajas_vales_caja();"  title="Enviar" tabindex="1">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_autorizar_cajas_vales_caja"
									type="reset" aria-hidden="true" onclick="cerrar_autorizar_cajas_vales_caja();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Autorizar Vale de Caja Chica -->

		<!-- Diseño del modal Vales de Caja Chica-->
		<div id="CajasValesCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_cajas_vales_caja"  class="ModalBodyTitle">
			<h1>Vales de Caja Chica</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_cajas_vales_caja" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_cajas_vales_caja" class="active">
									<a data-toggle="tab" href="#informacion_general_cajas_vales_caja">Información General</a>
								</li>
								<!--Tab que contiene la información de los detalles-->
								<li id="tabComprobacion_cajas_vales_caja" class="disabled disabledTab">
									<a data-toggle="tab" href="#comprobacion_cajas_vales_caja">Comprobación</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmCajasValesCaja" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmCajasValesCaja"  onsubmit="return(false)" autocomplete="off"  
					  enctype="multipart/form-data">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_cajas_vales_caja" class="tab-pane fade in active">
							<div class="row">
								<!--Folio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtCajaValeID_cajas_vales_caja" 
												   name="intCajaValeID_cajas_vales_caja" type="hidden" value="">
											</input>
											<label for="txtFolio_cajas_vales_caja">Folio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFolio_cajas_vales_caja" 
													name="strFolio_cajas_vales_caja" type="text" 
													value="" placeholder="Autogenerado" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Fecha-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_cajas_vales_caja">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_cajas_vales_caja'>
							                    <input class="form-control" id="txtFecha_cajas_vales_caja"
							                    		name= "strFecha_cajas_vales_caja" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Tipo de vale-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbTipoVale_cajas_vales_caja">Tipo de vale</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbTipoVale_cajas_vales_caja" 
											 		name="strTipoVale_cajas_vales_caja" tabindex="1">
											 	<option value="">Seleccione una opción</option>
		                          				<option value="FONDO DE CAJA">FONDO DE CAJA</option>
		                          				<option value="TRANSFERENCIA ELECTRONICA">TRANSFERENCIA ELECTRONICA</option>
		                     				</select>
										</div>
									</div>
								</div>
						    </div>
						    <!--Div que contiene el campo de la cuenta bancaria-->
						    <div id="divCuentaBancaria_cajas_vales_caja" class="row no-mostrar">
						    	<!--Autocomplete que contiene las cuentas bancarias activas-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta bancaria seleccionada-->
											<input id="txtCuentaBancariaID_cajas_vales_caja" 
												   name="intCuentaBancariaID_cajas_vales_caja"  type="hidden" 
												   value="">
											</input>
											<label for="txtCuentaBancaria_cajas_vales_caja">Cuenta</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCuentaBancaria_cajas_vales_caja" 
													name="strCuentaBancaria_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese cuenta bancaria" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						        <!--Autocomplete que contiene los empleados y proveedores activos-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado/proveedor seleccionado-->
											<input id="txtReferenciaID_cajas_vales_caja" 
												   name="intReferenciaID_cajas_vales_caja"  type="hidden" 
												   value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el tipo de referencia correspondiente al id seleccionado-->
											<input id="txtTipoReferencia_cajas_vales_caja" 
												   name="strTipoReferencia_cajas_vales_caja"  type="hidden" 
												   value="">
											</input>
											<label for="txtReferencia_cajas_vales_caja">Empleado/Proveedor</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtReferencia_cajas_vales_caja" 
													name="strReferencia_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese empleado o proveedor" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Autocomplete que contiene las sucursales activas-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal seleccionada-->
											<input id="txtSucursalGastoID_cajas_vales_caja" 
											       name="intSucursalGastoID_cajas_vales_caja" type="hidden" value="">
											</input>
											<label for="txtSucursalGasto_cajas_vales_caja">Sucursal</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtSucursalGasto_cajas_vales_caja" 
													name="strSucursalGasto_cajas_vales_caja" type="text" value="" 
													tabindex="1" placeholder="Ingrese sucursal" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los departamentos activos-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del departamento seleccionado-->
											<input id="txtDepartamentoID_cajas_vales_caja" 
											       name="intDepartamentoID_cajas_vales_caja" type="hidden" value="">
											</input>
											<label for="txtDepartamento_cajas_vales_caja">Departamento</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtDepartamento_cajas_vales_caja" 
													name="strDepartamento_cajas_vales_caja" type="text" value="" 
													tabindex="1" placeholder="Ingrese departamento" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
								<!--Concepto-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtConcepto_cajas_vales_caja">Concepto</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtConcepto_cajas_vales_caja" 
													name="strConcepto_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese concepto" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Importe-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtImporte_cajas_vales_caja">Importe</label>
										</div>
										<div class="col-md-12">
											<div class='input-group'>
												<span class="input-group-addon">$</span>
												<input  class="form-control moneda_cajas_vales_caja" id="txtImporte_cajas_vales_caja" 
														name="intImporte_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="12">
												</input>
											</div>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Observaciones-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObservaciones_cajas_vales_caja">Observaciones</label>
										</div>
										<div class="col-md-12">
											<textarea  class="form-control" id="txtObservaciones_cajas_vales_caja" 
													   name="strObservaciones_cajas_vales_caja" rows="3" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250"></textarea>
										</div>
									</div>
								</div>
						    </div>
					    </div><!--Cierre del contenido del tab - Información General-->
					    <!--Tab - Comprobación-->
						<div id="comprobacion_cajas_vales_caja" class="tab-pane fade">
							<div class="row">
								<!--Tipo-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
											<input id="txtRenglon_detalles_cajas_vales_caja" 
												   name="intRenglon_detalles_cajas_vales_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para asignar el id del objeto (input) tipo file-->
											<input id="txtIDCampoArchivo_detalles_cajas_vales_caja" 
												   name="strIDCampoArchivo_detalles_cajas_vales_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para para asignar el id del área (spam) del objeto (input) tipo file-->
											<input id="txtIDCampoArea_detalles_cajas_vales_caja" 
												   name="strIDCampoArea_detalles_cajas_vales_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para la descripción de los archivos de un registro existente-->
											<input id="txtArchivoExistente_detalles_cajas_vales_caja" 
												   name="strArchivoExistente_detalles_cajas_vales_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón anterior-->
											<input id="txtRenglonAnterior_detalles_cajas_vales_caja" 
												   name="intRenglonAnterior_detalles_cajas_vales_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para asignar el tipo de registro 
												 (Nuevo/Existente en la base de datos) de esta manera se identificara el renglón-->
											<input id="txtTipoRenglon_detalles_cajas_vales_caja" 
												   name="strTipoRenglon_detalles_cajas_vales_caja" type="hidden" value="">
											</input>
											<label for="cmbTipo_detalles_cajas_vales_caja">Tipo de vale</label>
										</div>
										<div class="col-md-12">
											<select class="form-control" id="cmbTipo_detalles_cajas_vales_caja" 
											 		name="strTipo_detalles_cajas_vales_caja" tabindex="1">
											 	<option value="">Seleccione una opción</option>
		                          				<option value="FISCAL">FISCAL</option>
		                          				<option value="NO FISCAL">NO FISCAL</option>
		                          				<option value="DEVOLUCION">DEVOLUCIÓN</option>
		                     				</select>
										</div>
									</div>
								</div>
								<!--Fecha-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_detalles_cajas_vales_caja">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_detalles_cajas_vales_caja'>
							                    <input class="form-control" id="txtFecha_detalles_cajas_vales_caja"
							                    		name= "strFecha_detalles_cajas_vales_caja" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>	
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtConcepto_detalles_cajas_vales_caja">Concepto</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtConcepto_detalles_cajas_vales_caja"
												   name="strConcepto_detalles_cajas_vales_caja" 
												   type="text" value="" tabindex="1" placeholder="Ingrese concepto" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
							<!--Div que contiene los campos del tipo de gasto fiscal-->
							<div id="DivProveedor_detalles_cajas_vales_caja">
								<div class="row">
								    <!--Autocomplete que contiene las ordenes de compra (de refacciones, maquinaria, generales y especiales) autorizadas-->
									<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">							
												<!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de compra seleccionada-->
												<input id="txtOrdenCompraID_detalles_cajas_vales_caja" 
													   name="intOrdenCompraID_detalles_cajas_vales_caja"  type="hidden" 
													   value="">
												</input>
											    <!-- Caja de texto oculta para recuperar el tipo de referencia (general/especial/maquinaria/refacciones) seleccionada-->
												<input id="txtTipoOrdenCompra_detalles_cajas_vales_caja" 
													   name="strTipoOrdenCompra_detalles_cajas_vales_caja"  type="hidden" 
													   value="">
												</input>
												<label for="txtOrdenCompra_detalles_cajas_vales_caja">Orden de compra</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" id="txtOrdenCompra_detalles_cajas_vales_caja" 
														name="strOrdenCompra_detalles_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese orden de compra" maxlength="250">
												</input>
											</div>
										</div>
									</div>
									<!--Autocomplete que contiene los empleados y proveedores activos-->
									<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">							
												<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
												<input id="txtProveedorID_detalles_cajas_vales_caja" 
													   name="intProveedorID_detalles_cajas_vales_caja"  type="hidden" 
													   value="">
												</input>
												<label for="txtProveedor_detalles_cajas_vales_caja">Proveedor</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" id="txtProveedor_detalles_cajas_vales_caja" 
														name="strProveedor_detalles_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese empleado o proveedor" maxlength="250">
												</input>
											</div>
										</div>
									</div>
								</div>
								<!--Div que contiene los campos del gasto y parque vehicular-->
								<div id="DivParqueVehicular_detalles_cajas_vales_caja">
									<div class="row">
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<div class="row">
												<!--Parque vehicular-->
												<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
													<div class="form-group">
														<div class="col-md-12">
															<label for="cmbParqueVehicular_detalles_cajas_vales_caja">Parque vehicular</label>
														</div>
														<div id="divCmbMsjValidacion" class="col-md-12">
															<select class="form-control" id="cmbParqueVehicular_detalles_cajas_vales_caja" 
															 		name="strParqueVehicular_detalles_cajas_vales_caja" tabindex="1">
																<option value="">Seleccione una opción</option>
																<option value="SI">SI</option>
																<option value="NO">NO</option>
						                     				</select>
														</div>
													</div>
												</div>
												<!--Autocomplete que contiene los vehículos activos-->
												<div id="divVehiculo_detalles_cajas_vales_caja" class="col-sm-9 col-md-9 col-lg-9 col-xs-12 no-mostrar">
													<div class="form-group">
														<div class="col-md-12">
															<!-- Caja de texto oculta que se utiliza para recuperar el id del  vehículo seleccionado-->
															<input id="txtVehiculoID_detalles_cajas_vales_caja" 
																   name="intVehiculoID_detalles_cajas_vales_caja"  type="hidden" value="">
															</input>
															<label for="txtVehiculo_detalles_cajas_vales_caja">Vehículo</label>
														</div>
														<div class="col-md-12">
															<input  class="form-control" id="txtVehiculo_detalles_cajas_vales_caja" 
																	name="strVehiculo_detalles_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese vehículo" maxlength="250">
															</input>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<!--Tipo de gasto-->
										<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
											<div class="form-group">
												<div class="col-md-12">
													<label for="cmbTipoGasto_detalles_cajas_vales_caja">Tipo de gasto</label>
												</div>
												<div id="divCmbMsjValidacion" class="col-md-12">
													<select class="form-control" id="cmbTipoGasto_detalles_cajas_vales_caja" 
													 		name="strTipoGasto_detalles_cajas_vales_caja" tabindex="1">
														<option value="">Seleccione una opción</option>
														<option value="GASTOS DE VENTA">GASTOS DE VENTA</option>
														<option value="GASTOS DE ADMINISTRACION">GASTOS DE ADMINISTRACION</option>
														<option value="GASTOS CORPORATIVOS">GASTOS CORPORATIVOS</option>
				                     				</select>
												</div>
											</div>
										</div>
										<!--Combobox que contiene las sucursales activas-->
										<div id="divCmbSucursalID_detalles_cajas_vales_caja" class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
											<div class="form-group">
												<div class="col-md-12">
													<label for="cmbSucursalID_detalles_cajas_vales_caja">Sucursal</label>
												</div>
												<div id="divCmbMsjValidacion" class="col-md-12">
													<select class="form-control" id="cmbSucursalID_detalles_cajas_vales_caja" 
													 		name="intSucursalID_detalles_cajas_vales_caja" tabindex="1">
				                     				</select>
												</div>
											</div>
										</div>
										<!--Combobox que contiene los módulos activos-->
										<div id="divCmbModuloID_detalles_cajas_vales_caja" class="col-sm-3 col-md-3 col-lg-3 col-xs-12 no-mostrar">
											<div class="form-group">
												<div class="col-md-12">
													<label for="cmbModuloID_detalles_cajas_vales_caja">Departamento</label>
												</div>
												<div id="divCmbMsjValidacion" class="col-md-12">
													<select class="form-control" id="cmbModuloID_detalles_cajas_vales_caja" 
													 		name="intModuloID_detalles_cajas_vales_caja" tabindex="1">
				                     				</select>
												</div>
											</div>
										</div>
										<!--Combobox que contiene los tipos de gastos activos (correspondientes al tipo)-->
										<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
											<div class="form-group">
												<div class="col-md-12">
													<label for="cmbGastoTipoID_detalles_cajas_vales_caja">Gasto</label>
												</div>
												<div id="divCmbMsjValidacion" class="col-md-12">
													<select class="form-control" id="cmbGastoTipoID_detalles_cajas_vales_caja" 
													 		name="strGastoTipoID_detalles_cajas_vales_caja" tabindex="1">
				                     				</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Factura-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFactura_detalles_cajas_vales_caja">Factura</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFactura_detalles_cajas_vales_caja" 
													name="strFactura_detalles_cajas_vales_caja" type="text" value="" 
													tabindex="1" placeholder="Ingrese factura" maxlength="10">
											</input>
										</div>
									</div>
								</div>
								<!--Importe-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtSubtotal_detalles_cajas_vales_caja">Importe</label>
										</div>
										<div class="col-md-12">
											<div class='input-group'>
												<span class="input-group-addon">$</span>
												<input  class="form-control moneda_detalles_cajas_vales_caja" id="txtSubtotal_detalles_cajas_vales_caja" 
														name="intSubtotal_detalles_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="21">
												</input>
											</div>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
						    	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						    		<div class="form-group">
										<div class="col-md-12">					
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIva_detalles_cajas_vales_caja" 
												   name="intTasaCuotaIva_detalles_cajas_vales_caja" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el importe de IVA de la orden de compra seleccionada-->
											<input id="txtIvaOrdenCompra_detalles_cajas_vales_caja" 
												   name="intIva_detalles_cajas_vales_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIva_detalles_cajas_vales_caja">IVA %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIva_detalles_cajas_vales_caja" 
													name="intPorcentajeIva_detalles_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese IVA" maxlength="250">
											</input>
										</div>
									</div>
						    	</div>
						    	<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
						    	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						    		<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIeps_detalles_cajas_vales_caja" 
												   name="intTasaCuotaIeps_detalles_cajas_vales_caja" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el importe de IEPS de la orden de compra seleccionada-->
											<input id="txtIepsOrdenCompra_detalles_cajas_vales_caja" 
												   name="intIeps_detalles_cajas_vales_caja" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el importe total (saldo) de la orden de compra seleccionada-->
											<input id="txtTotalOrdenCompra_detalles_cajas_vales_caja" 
												   name="intTotal_detalles_cajas_vales_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIeps_detalles_cajas_vales_caja">IEPS %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIeps_detalles_cajas_vales_caja" 
													name="intPorcentajeIeps_detalles_cajas_vales_caja" type="text" value="" tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
											</input>
										</div>
									</div>
						    	</div>
								<!--Botones-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="btn-group pull-right btn-toolBtns">
										<!--Agregar detalle en la tabla-->
										<button class="btn btn-primary" 
		                                			id="btnAgregar_detalles_cajas_vales_caja" 
		                                			onclick="agregar_renglon_detalles_cajas_vales_caja();" 
		                                	     	title="Agregar" tabindex="1"> 
		                                		<span class="glyphicon glyphicon-plus"></span>
		                                </button>
					                    <!--Subir varios archivos-->
				                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_cajas_vales_caja">
				                        	<span class="fa fa-upload"></span>
				                        	<span id='archivos_area_detalles_cajas_vales_caja'>
					                        	<input id="archivo_varios_detalles_cajas_vales_caja" 
					                        		   name="archivo_varios_detalles_cajas_vales_caja[]" type="file" multiple 
					                        		   accept="text/xml,application/pdf" onchange="verificar_extension_archivos_cajas_vales_caja(this);">
					                        	</input>
					                        </span>
				                        </span>
					                     <!--Descargar archivo-->
					                    <button class="btn btn-default" id="btnDescargarArchivo_detalles_cajas_vales_caja"  
												onclick="descargar_archivos_detalles_cajas_vales_caja('');"  title="Descargar archivo" tabindex="1">
											<span class="glyphicon glyphicon-download-alt"></span>
										</button>
										<!--Eliminar archivo-->
										<button class="btn btn-default" id="btnEliminarArchivo_detalles_cajas_vales_caja"  
												onclick="eliminar_archivo_detalles_cajas_vales_caja('', '')"  title="Eliminar archivo" tabindex="1">
											<span class="glyphicon glyphicon-export"></span>
										</button>
									</div>
								</div>
							</div>
							<br>
							<div class="form-group row">
								<!--Div que contiene la tabla con los detalles encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_detalles_cajas_vales_caja">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Tipo</th>
												<th class="movil">Factura</th>
												<th class="movil">Gasto</th>
												<th class="movil">Concepto</th>
												<th class="movil">Importe</th>
												<th class="movil">IVA</th>
												<th class="movil">IEPS</th>
												<th class="movil">Total</th>
												<th class="movil" id="th-acciones" style="width:17em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<tfoot class="movil">
											<tr class="movil">
												<td class="movil t1">
													<strong>Total</strong>
												</td>
												<td class="movil t2"></td>
												<td class="movil t3"></td>
												<td class="movil t4"></td>
												<td class="movil t5">
													<strong id="acumSubtotal_detalles_cajas_vales_caja"></strong>
												</td>
												<td class="movil t6">
													<strong id="acumIva_detalles_cajas_vales_caja"></strong>
												</td>
												<td class="movil t7">
													<strong  id="acumIeps_detalles_cajas_vales_caja"></strong>
												</td>
												<td class="movil t8">
													<strong id="acumTotal_detalles_cajas_vales_caja"></strong>
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
												<strong id="numElementos_detalles_cajas_vales_caja">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Comprobación-->
				    </div><!--Cierre del contenedor de tabs-->
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_cajas_vales_caja"  
									onclick="validar_cajas_vales_caja();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Guardar detalles del registro-->
							<button class="btn btn-success" id="btnGuardarDetalles_cajas_vales_caja"  
									onclick="guardar_detalles_cajas_vales_caja();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!---Autorizar o rechazar registro-->
							<button class="btn btn-default" id="btnAutorizar_cajas_vales_caja"  
									onclick="abrir_autorizar_cajas_vales_caja('','','Autorizar');"  title="Autorizar o Rechazar" tabindex="3" disabled>
								<span class="fa fa-check-square-o"></span>
							</button>
							<!--Finalizar (cerrar) registro-->
							<button class="btn btn-default" id="btnFinalizar_cajas_vales_caja"  
									onclick="cambiar_estatus_cajas_vales_caja('','CERRADO');"  title="Finalizar" tabindex="4">
								<span class="glyphicon glyphicon-tasks"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_cajas_vales_caja"  
									onclick="reporte_registro_cajas_vales_caja('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivos-->
		                    <button class="btn btn-default" id="btnDescargarArchivos_cajas_vales_caja"  
									onclick="descargar_archivos_cajas_vales_caja('', '');"  title="Descargar archivos" tabindex="6" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_cajas_vales_caja"  
									onclick="cambiar_estatus_cajas_vales_caja('','ACTIVO');"  title="Desactivar" tabindex="7" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_cajas_vales_caja"  
									onclick="cambiar_estatus_cajas_vales_caja('','INACTIVO');"  title="Restaurar" tabindex="8" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cajas_vales_caja"
									type="reset" aria-hidden="true" onclick="cerrar_cajas_vales_caja();" 
									title="Cerrar"  tabindex="9">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Vales de Caja Chica-->
	</div><!--#CajasValesCajaContent -->

	<!-- /.Plantilla para cargar las sucursales en el combobox-->  
	<script id="sucursales_detalles_cajas_vales_caja" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#sucursales}}
		<option value="{{value}}">{{nombre}}</option>
		{{/sucursales}} 
	</script>
	<!-- /.Plantilla para cargar los módulos en el combobox-->  
	<script id="modulos_detalles_cajas_vales_caja" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#modulos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/modulos}} 
	</script>
	<!-- /.Plantilla para cargar los tipos de gastos en el combobox-->  
	<script id="gastos_tipos_detalles_cajas_vales_caja" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#gastos_tipos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/gastos_tipos}} 
	</script>

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaCajasValesCaja = 0;
		var strUltimaBusquedaCajasValesCaja = "";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
		var intNumDecimalesMostrarCajasValesCaja = <?php echo NUM_DECIMALES_MOSTRAR_CUENTAS_PAGAR ?>;
		//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
		var intNumDecimalesPrecioUnitBDCajasValesCaja = <?php echo NUM_DECIMALES_PRECIO_UNIT_OC_CUENTAS_PAGAR ?>;
		var intNumDecimalesIvaUnitBDCajasValesCaja = <?php echo NUM_DECIMALES_IVA_UNIT_OC_CUENTAS_PAGAR ?>;
		var intNumDecimalesIepsUnitBDCajasValesCaja = <?php echo NUM_DECIMALES_IEPS_UNIT_OC_CUENTAS_PAGAR ?>;
		//Variable que se utiliza para asignar la descripción de la cuenta 602
		var strCuenta602CajasValesCaja = <?php echo DESCRIPCION_CUENTA_602 ?>;
		//Variable que se utiliza para asignar la descripción de la cuenta 603
		var strCuenta603CajasValesCaja = <?php echo DESCRIPCION_CUENTA_603 ?>;
		//Variables que se utilizan para la búsqueda de registros
		var strTipoReferenciaCajasValesCaja = "";
		var intReferenciaIDCajasValesCaja = "";
		var intSucursalGastoIDCajasValesCaja = "";
		var dteFechaInicialCajasValesCaja = "";
		var dteFechaFinalCajasValesCaja = "";
		//Variable que se utiliza para asignar objeto del modal Autorizar Vale de Caja Chica
		var objAutorizarCajasValesCaja = null;
		//Variable que se utiliza para asignar objeto del modal Vales de Caja Chica
		var objCajasValesCaja = null;

		/*******************************************************************************************************************
		Funciones del objeto Detalles del vale de caja
		*********************************************************************************************************************/
		// Constructor del objeto detalles
		var objDetallesValeCajasValesCaja;
		function DetallesValeCajasValesCaja(detalles)
		{
			this.arrDetalles = detalles;
		}

		//Función para obtener todos los detalles del vale de caja
		DetallesValeCajasValesCaja.prototype.getDetalles = function() {
		    return this.arrDetalles;
		}

		//Función para agregar una detalle al objeto 
		DetallesValeCajasValesCaja.prototype.setDetalle = function (detalle){
			this.arrDetalles.push(detalle);
		}

		//Función para obtener un detalle del objeto
		DetallesValeCajasValesCaja.prototype.getDetalle = function(index) {
		    return this.arrDetalles[index];
		}

		//Función para modificar un detalle del objeto
		DetallesValeCajasValesCaja.prototype.modificarDetalle = function (index, detalle){
			this.arrDetalles[index] = detalle;
		}

		//Función para eliminar un detalle del objeto
		DetallesValeCajasValesCaja.prototype.eliminarDetalle = function (index){
			if(index != -1) 
			{
				this.arrDetalles.splice(index, 1);
			}
		}

		//Función para cambiar las posiciones de los detalles en el objeto
		DetallesValeCajasValesCaja.prototype.swap = function(index_A, index_B) {
		    var input = this.arrDetalles;
		 
		    var temp = input[index_A];
		    input[index_A] = input[index_B];
		    input[index_B] = temp;
		}

		/*******************************************************************************************************************
		Funciones del objeto Detalle del vale de caja
		*********************************************************************************************************************/
		//Constructor del objeto detalle
		var objDetalleValeCajasValesCaja;
		function DetalleValeCajasValesCaja(tipo, fecha, fecha_format, tipoOrdenCompra, ordenCompraID, ordenCompra, 
										   proveedorID, proveedor, factura, concepto, subtotal, 
										   tasaCuotaIva, iva, tasaCuotaIeps, ieps, porcentajeIva,
										   porcentajeIeps, total, archivoExistente, IDCampoArchivo, 
										   renglonAnterior, tipoRenglon, IDCampoArea, sucursalID, 
										   moduloID, gastoTipoID, gastoTipo, tipoGasto, 
										   vehiculoID, vehiculo, parqueVehicular)
		{
		    this.strTipo = tipo;
		    this.dteFecha = fecha;
		    this.dteFechaFormat = fecha_format;
		    this.strTipoOrdenCompra = tipoOrdenCompra;
		    this.intOrdenCompraID = ordenCompraID;
		    this.strOrdenCompra = ordenCompra;
		    this.intProveedorID = proveedorID;
		    this.strProveedor = proveedor;
		    this.strFactura = factura;
		    this.strConcepto = concepto;
		    this.intSubtotal = subtotal;
		    this.intTasaCuotaIva = tasaCuotaIva;
		    this.intIva = iva;
		    this.intTasaCuotaIeps = tasaCuotaIeps;
		    this.intIeps = ieps;
		    this.intPorcentajeIva = porcentajeIva;
		    this.intPorcentajeIeps = porcentajeIeps;
		    this.intTotal = total;
		    this.strArchivoExistente = archivoExistente;
		    this.strIDCampoArchivo = IDCampoArchivo;
		    this.intRenglonAnterior = renglonAnterior;
		    this.strTipoRenglon = tipoRenglon;
		    this.strIDCampoArea = IDCampoArea;
		    this.intSucursalID = sucursalID;
		    this.intModuloID = moduloID;
		    this.intGastoTipoID = gastoTipoID;
		    this.strGastoTipo = gastoTipo;
		    this.strTipoGasto = tipoGasto;
		    this.intVehiculoID = vehiculoID;
		    this.strVehiculo = vehiculo;
		    this.strParqueVehicular = parqueVehicular;
		}

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_cajas_vales_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/cajas_vales/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_cajas_vales_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCajasValesCaja = data.row;
					//Separar la cadena 
					var arrPermisosCajasValesCaja = strPermisosCajasValesCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCajasValesCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCajasValesCaja[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_cajas_vales_caja').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosCajasValesCaja[i]=='GUARDAR') || (arrPermisosCajasValesCaja[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_cajas_vales_caja').removeAttr('disabled');
							$('#btnGuardarDetalles_cajas_vales_caja').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosCajasValesCaja[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivos_cajas_vales_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasValesCaja[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_cajas_vales_caja').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_cajas_vales_caja();
						}
						else if(arrPermisosCajasValesCaja[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_cajas_vales_caja').removeAttr('disabled');
							$('#btnRestaurar_cajas_vales_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasValesCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_cajas_vales_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasValesCaja[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_cajas_vales_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasValesCaja[i]=='AUTORIZAR')//Si el indice es AUTORIZAR
						{
							//Habilitar el control (botón autorizar)
							$('#btnAutorizar_cajas_vales_caja').removeAttr('disabled');
						}
						else if(arrPermisosCajasValesCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_cajas_vales_caja').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_cajas_vales_caja() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaCajasValesCaja =($('#txtFechaInicialBusq_cajas_vales_caja').val()+$('#txtFechaFinalBusq_cajas_vales_caja').val()+$('#txtTipoReferenciaBusq_cajas_vales_caja').val()+$('#txtReferenciaIDBusq_cajas_vales_caja').val()+$('#txtSucursalGastoIDBusq_cajas_vales_caja').val()+$('#cmbEstatusBusq_cajas_vales_caja').val()+$('#txtBusqueda_cajas_vales_caja').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaCajasValesCaja != strUltimaBusquedaCajasValesCaja)
			{
				intPaginaCajasValesCaja = 0;
				strUltimaBusquedaCajasValesCaja = strNuevaBusquedaCajasValesCaja;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/cajas_vales/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_cajas_vales_caja').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_cajas_vales_caja').val()),
						strTipoReferencia: $('#txtTipoReferenciaBusq_cajas_vales_caja').val(),
						intReferenciaID: $('#txtReferenciaIDBusq_cajas_vales_caja').val(),
						intSucursalGastoID: $('#txtSucursalGastoIDBusq_cajas_vales_caja').val(),
						strEstatus: $('#cmbEstatusBusq_cajas_vales_caja').val(),
					 	strBusqueda: $('#txtBusqueda_cajas_vales_caja').val(),
						intPagina:intPaginaCajasValesCaja,
						strPermisosAcceso: $('#txtAcciones_cajas_vales_caja').val()
					},
					function(data){
						$('#dg_cajas_vales_caja tbody').empty();
						var tmpCajasValesCaja = Mustache.render($('#plantilla_cajas_vales_caja').html(),data);
						$('#dg_cajas_vales_caja tbody').html(tmpCajasValesCaja);
						$('#pagLinks_cajas_vales_caja').html(data.paginacion);
						$('#numElementos_cajas_vales_caja').html(data.total_rows);
						intPaginaCajasValesCaja = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_cajas_vales_caja() 
		{
			//Asignar valores para la búsqueda de registros
			strTipoReferenciaCajasValesCaja =  $('#txtTipoReferenciaBusq_cajas_vales_caja').val();
			intReferenciaIDCajasValesCaja =  $('#txtReferenciaIDBusq_cajas_vales_caja').val();
			intSucursalGastoIDCajasValesCaja =  $('#txtSucursalGastoIDBusq_cajas_vales_caja').val();
			dteFechaInicialCajasValesCaja =  $.formatFechaMysql($('#txtFechaInicialBusq_cajas_vales_caja').val());
			dteFechaFinalCajasValesCaja =  $.formatFechaMysql($('#txtFechaFinalBusq_cajas_vales_caja').val());

			//Si no existe fecha inicial
			if(dteFechaInicialCajasValesCaja == '')
			{
				dteFechaInicialCajasValesCaja = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalCajasValesCaja == '')
			{
				dteFechaFinalCajasValesCaja =  '0000-00-00';
			}

			//Si no existe tipo de referencia
			if(strTipoReferenciaCajasValesCaja == '')
			{
				strTipoReferenciaCajasValesCaja = 'TODOS';
			}

			//Si no existe id de la referencia
			if(intReferenciaIDCajasValesCaja == '')
			{
				intReferenciaIDCajasValesCaja = 0;
			}

			//Si no existe id de la sucursal
			if(intSucursalGastoIDCajasValesCaja == '')
			{
				intSucursalGastoIDCajasValesCaja = 0;
			}


			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("caja/cajas_vales/get_reporte/"+dteFechaInicialCajasValesCaja+"/"+dteFechaFinalCajasValesCaja+"/"+strTipoReferenciaCajasValesCaja+"/"+intReferenciaIDCajasValesCaja+"/"+intSucursalGastoIDCajasValesCaja+"/"+$('#cmbEstatusBusq_cajas_vales_caja').val()+"/"+$('#txtBusqueda_cajas_vales_caja').val());
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_cajas_vales_caja(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtCajaValeID_cajas_vales_caja').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("caja/cajas_vales/get_reporte_registro/"+intID);
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_cajas_vales_caja() 
		{
			//Asignar valores para la búsqueda de registros
			strTipoReferenciaCajasValesCaja =  $('#txtTipoReferenciaBusq_cajas_vales_caja').val();
			intReferenciaIDCajasValesCaja =  $('#txtReferenciaIDBusq_cajas_vales_caja').val();
			intSucursalGastoIDCajasValesCaja =  $('#txtSucursalGastoIDBusq_cajas_vales_caja').val();
			dteFechaInicialCajasValesCaja =  $.formatFechaMysql($('#txtFechaInicialBusq_cajas_vales_caja').val());
			dteFechaFinalCajasValesCaja =  $.formatFechaMysql($('#txtFechaFinalBusq_cajas_vales_caja').val());

			//Si no existe fecha inicial
			if(dteFechaInicialCajasValesCaja == '')
			{
				dteFechaInicialCajasValesCaja = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalCajasValesCaja == '')
			{
				dteFechaFinalCajasValesCaja =  '0000-00-00';
			}

			//Si no existe tipo de referencia
			if(strTipoReferenciaCajasValesCaja == '')
			{
				strTipoReferenciaCajasValesCaja = 'TODOS';
			}

			//Si no existe id de la referencia
			if(intReferenciaIDCajasValesCaja == '')
			{
				intReferenciaIDCajasValesCaja = 0;
			}

			//Si no existe id de la sucursal
			if(intSucursalGastoIDCajasValesCaja == '')
			{
				intSucursalGastoIDCajasValesCaja = 0;
			}

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("caja/cajas_vales/get_xls/"+dteFechaInicialCajasValesCaja+"/"+dteFechaFinalCajasValesCaja+"/"+strTipoReferenciaCajasValesCaja+"/"+intReferenciaIDCajasValesCaja+"/"+intSucursalGastoIDCajasValesCaja+"/"+$('#cmbEstatusBusq_cajas_vales_caja').val()+"/"+$('#txtBusqueda_cajas_vales_caja').val());
		}


		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_cajas_vales_caja(cajaValeID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intCajaValeID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(cajaValeID == '')
			{
				intCajaValeID = $('#txtCajaValeID_cajas_vales_caja').val();
				strFolio = $('#txtFolio_cajas_vales_caja').val();
			}
			else
			{
				intCajaValeID = cajaValeID;
				strFolio = folio;
			}

			//Abrir pestaña para realizar descarga de los documentos
			window.open("caja/cajas_vales/descargar_archivos/"+intCajaValeID+"/"+strFolio);
		}
	
		//Regresar sucursales activas para cargarlas en el combobox
		function cargar_sucursales_detalles_cajas_vales_caja()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box', {},
				function(data)
				{
					$('#cmbSucursalID_detalles_cajas_vales_caja').empty();
					var temp = Mustache.render($('#sucursales_detalles_cajas_vales_caja').html(), data);
					$('#cmbSucursalID_detalles_cajas_vales_caja').html(temp);
				},
				'json');
		}


		//Regresar módulos activos para cargarlos en el combobox
		function cargar_modulos_detalles_cajas_vales_caja()
		{
			//Hacer un llamado al método del controlador para regresar los módulos que se encuentran activos 
			$.post('crm/modulos/get_combo_box', {},
				function(data)
				{
					$('#cmbModuloID_detalles_cajas_vales_caja').empty();
					var temp = Mustache.render($('#modulos_detalles_cajas_vales_caja').html(), data);
					$('#cmbModuloID_detalles_cajas_vales_caja').html(temp);
				},
				'json');
		}

		//Regresar gastos activos para cargarlos en el combobox
		function cargar_gastos_detalles_cajas_vales_caja(intGastoTipoID = 0)
		{	
			//Asignar el tipo de gasto
			var strTipo = $('#cmbTipoGasto_detalles_cajas_vales_caja').val();
			//Asignar el parque vehicular
			var strParqueVehicular = $('#cmbParqueVehicular_detalles_cajas_vales_caja').val();

			//Hacer un llamado al método del controlador para regresar los gastos que se encuentran activos 
			$.post('cuentas_pagar/gastos_tipos/get_combo_box/'+strTipo+'/'+strParqueVehicular+'/orden_compra', {},
				function(data)
				{
					$('#cmbGastoTipoID_detalles_cajas_vales_caja').empty();
					var temp = Mustache.render($('#gastos_tipos_detalles_cajas_vales_caja').html(), data);
					$('#cmbGastoTipoID_detalles_cajas_vales_caja').html(temp);

					//Si existe id del tipo de gasto
					if(intGastoTipoID > 0)
					{
						//Asignar el id del tipo de gasto
						$('#cmbGastoTipoID_detalles_cajas_vales_caja').val(intGastoTipoID);
					}
				},
				'json');
		}

	

	
		/*******************************************************************************************************************
		Funciones del modal Autorizar Vale de Caja Chica
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_autorizar_cajas_vales_caja()
		{
			//Incializar formulario
			$('#frmAutorizarCajasValesCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_cajas_vales_caja();
			//Limpiar cajas de texto ocultas
			$('#frmAutorizarCajasValesCaja').find('input[type=hidden]').val('');
			//Agregar clase no-mostrar para ocultar div que contiene el estatus
			$('#divEstatus_autorizar_cajas_vales_caja').addClass("no-mostrar");
		    $('#divEncabezadoModal_autorizar_cajas_vales_caja').addClass("estatus-ACTIVO");
		}

		//Función que se utiliza para abrir el modal
		function abrir_autorizar_cajas_vales_caja(id, folio, tipoAccion)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_autorizar_cajas_vales_caja();
			
			//Variables que se utilizan para asignar los datos del registro
			var intReferenciaID = 0;
			var strFolio = '';

			//Si no existe id, significa que se aplicará autorización (o rechazo) desde el modal
			if(id == '')
			{
				intReferenciaID = $('#txtCajaValeID_cajas_vales_caja').val();
				strFolio =  $('#txtFolio_cajas_vales_caja').val();
				$('#txtModalCajasVales_autorizar_cajas_vales_caja').val('SI');
			}
			else
			{
				intReferenciaID = id;
				strFolio = folio;
				$('#txtModalCajasVales_autorizar_cajas_vales_caja').val('NO');
			}

			//Asignar datos del registro seleccionado
			$('#txtReferenciaID_autorizar_cajas_vales_caja').val(intReferenciaID);
			$('#txtTipoAccion_autorizar_cajas_vales_caja').val(tipoAccion);
			$('#txtFolio_autorizar_cajas_vales_caja').val(strFolio);

			//Si el tipo de acción corresponde a Guardar
			if(tipoAccion == 'Guardar')
			{
				//Cambiar título del modal
				$('#tituloModal_autorizar_cajas_vales_caja').text('Notificar Vale de Caja Chica');
				$('#txtMensaje_autorizar_cajas_vales_caja').val('Favor de autorizar el vale de caja '+ strFolio);
				//Cargar el treeview
				get_treeview_usuarios_autorizar_cajas_vales_caja('');
				
				
			}
			else
			{
				//Quitar clase no-mostrar para mostrar div que contiene el estatus
				$('#divEstatus_autorizar_cajas_vales_caja').removeClass("no-mostrar");
				//Cambiar título del modal
				$('#tituloModal_autorizar_cajas_vales_caja').text('Autorizar Vale de Caja Chica');
				//Cargar el treeview
				get_treeview_usuarios_autorizar_cajas_vales_caja(intReferenciaID);
			}


			//Abrir modal
			objAutorizarCajasValesCaja = $('#AutorizarCajasValesCajaBox').bPopup({
										   appendTo: '#CajasValesCajaContent', 
								           contentContainer: 'CajasValesCajaM', 
								           zIndex: 2, 
								           modalClose: false, 
								           modal: true, 
								           follow: [true,false], 
								           followEasing : "linear", 
								           easing: "linear", 
								           modalColor: ('#F0F0F0')});
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_autorizar_cajas_vales_caja()
		{
			try {
				//Cerrar modal
				objAutorizarCajasValesCaja.close();
				//Eliminar datos del treeview
				$("#treeUsuarios_autorizar_cajas_vales_caja").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_cajas_vales_caja').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_autorizar_cajas_vales_caja()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosAutorizarCajasValesCaja = [];

			//Recorremos el treeview
			$("#treeUsuarios_autorizar_cajas_vales_caja").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosAutorizarCajasValesCaja.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtUsuarios_autorizar_cajas_vales_caja").val(arrSeleccionadosAutorizarCajasValesCaja.join('|'));
			
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_cajas_vales_caja();
			//Validación del formulario de campos obligatorios
			$('#frmAutorizarCajasValesCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_autorizar_cajas_vales_caja: {
											validators: {
												notEmpty: {message: 'Escriba un mensaje'}
											}
										},
										strUsuarios_autorizar_cajas_vales_caja: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un usuario para este mensaje.'}
											}
										},
										strEstatus_autorizar_cajas_vales_caja: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista estatus seleccionado cuando el tipo de acción sea Autorizar
					                                    if($('#txtTipoAccion_autorizar_cajas_vales_caja').val() === 'Autorizar' && $('#cmbEstatus_autorizar_cajas_vales_caja').val() == '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Seleccione un estatus'
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
			var bootstrapValidator_autorizar_cajas_vales_caja = $('#frmAutorizarCajasValesCaja').data('bootstrapValidator');
			bootstrapValidator_autorizar_cajas_vales_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_autorizar_cajas_vales_caja.isValid())
			{
				//Hacer un llamado a la función para guardar la solicitud de autorización
				guardar_autorizar_cajas_vales_caja();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_autorizar_cajas_vales_caja()
		{
			try
			{
				$('#frmAutorizarCajasValesCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar la autorización (o el rechazo) de un registro
		function guardar_autorizar_cajas_vales_caja()
		{
			//Hacer un llamado al método del controlador para enviar la autorización (o el rechazo) de un registro 
			$.post('caja/cajas_vales/set_enviar_autorizacion',
			     {intCajaValeID: $('#txtReferenciaID_autorizar_cajas_vales_caja').val(),
			      strUsuarios: $('#txtUsuarios_autorizar_cajas_vales_caja').val(), 
			      strMensaje:  $('#txtMensaje_autorizar_cajas_vales_caja').val(),
			      strEstatus:  $('#cmbEstatus_autorizar_cajas_vales_caja').val(),
			      strTipoAccion:  $('#txtTipoAccion_autorizar_cajas_vales_caja').val()
			     },
			     function(data) {
			        if(data.resultado)
			        {
			          	//Hacer llamado a la función  para cargar  los registros en el grid
			          	paginacion_cajas_vales_caja();
			          	//Hacer un llamado a la función para cerrar modal
					  	cerrar_autorizar_cajas_vales_caja();

					  	//Si el id de la referencia (para la autorización) se recuperó del modal Vales de Caja Chica
					  	if($('#txtModalCajasVales_autorizar_cajas_vales_caja').val() == 'SI')
					  	{
					  		//Hacer un llamado a la función para cerrar modal Vales de Caja Chica
					 	 	cerrar_cajas_vales_caja();
					  	}   
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_cajas_vales_caja(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		/*Función que se utiliza para definir tree view de usuarios con acceso a la función Autorizar del proceso
		 *Vales de Caja Chica (módulo Caja)*/
		function get_treeview_usuarios_autorizar_cajas_vales_caja(id)
		{
			$('#treeUsuarios_autorizar_cajas_vales_caja').fancytree({
				source: {
					url: "seguridad/usuarios/get_treeview/AUTORIZAR_VALES_CAJA_CHICA_CAJA/VALES DE CAJA CHICA/"+id,
					cache: false
				},
				checkbox: true,
				selectMode: 3
			});
		}

		
		/*******************************************************************************************************************
		Funciones del modal Vales de Caja Chica
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_cajas_vales_caja()
		{
			//Incializar formulario
			$('#frmCajasValesCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cajas_vales_caja();
			//Limpiar cajas de texto ocultas
			$('#frmCajasValesCaja').find('input[type=hidden]').val('');
			//Seleccionar tab que contiene la información general
		  	$('a[href="#informacion_general_cajas_vales_caja"]').click();
		  	//Agregar clase disabled disabledTab para deshabilitar el siguiente tab
		    $('#tabComprobacion_cajas_vales_caja').addClass("disabled disabledTab");
			//Asignar la fecha actual
			$('#txtFecha_cajas_vales_caja').val(fechaActual()); 
			$('#txtFecha_detalles_cajas_vales_caja').val(fechaActual()); 
			//Eliminar los datos de la tabla detalles del vale de caja
		    $('#dg_detalles_cajas_vales_caja tbody').empty();
		    $('#acumSubtotal_detalles_cajas_vales_caja').html('');
		    $('#acumIva_detalles_cajas_vales_caja').html('');
		    $('#acumIeps_detalles_cajas_vales_caja').html('');
		    $('#acumTotal_detalles_cajas_vales_caja').html('');
			$('#numElementos_detalles_cajas_vales_caja').html(0);
			//Limpiar contenido de los siguientes combobox
		    $('#cmbTipoGasto_detalles_cajas_vales_caja').val('');
		    $('#cmbGastoTipoID_detalles_cajas_vales_caja').empty();
		    //Hacer un llamado a la función para mostrar u ocultar sucursal y/o módulo
	        mostrar_cmb_detalles_cajas_vales_caja();
	        //Hacer un llamado a la función para mostrar u ocultar vehículo
	        mostrar_vehiculo_detalles_cajas_vales_caja();
			//Ocultar Div que contiene los campos del proveedor
	       	$('#DivProveedor_detalles_cajas_vales_caja').hide();
	       	//Ocultar Div que contiene los campos del gasto y parque vehicular
	       	$('#DivParqueVehicular_detalles_cajas_vales_caja').hide();
	       	//Crear instancia del objeto Detalles del vale de caja
			objDetallesValeCajasValesCaja = new DetallesValeCajasValesCaja([]);
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_cajas_vales_caja').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_cajas_vales_caja').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_cajas_vales_caja').removeClass("estatus-INACTIVO");
			$('#divEncabezadoModal_cajas_vales_caja').removeClass("estatus-AUTORIZADO");
			$('#divEncabezadoModal_cajas_vales_caja').removeClass("estatus-RECHAZADO");
			$('#divEncabezadoModal_cajas_vales_caja').removeClass("estatus-CERRADO");
			//Asignar NO para indicar que no se ha abierto el modal Autorizar Vale de Caja Chica Chica
			$('#txtModalCajasVales_autorizar_cajas_vales_caja').val('NO');
			//Habilitar todos los elementos del formulario
			$('#frmCajasValesCaja').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar caja de texto
			$('#txtFolio_cajas_vales_caja').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_cajas_vales_caja").show();
			//Ocultar los siguientes botones
			$("#btnAutorizar_cajas_vales_caja").hide();
			$("#btnFinalizar_cajas_vales_caja").hide();
			$("#btnDescargarArchivo_detalles_cajas_vales_caja").hide();
			$("#btnEliminarArchivo_detalles_cajas_vales_caja").hide();
			$("#btnImprimirRegistro_cajas_vales_caja").hide();
			$("#btnDescargarArchivos_cajas_vales_caja").hide();
			$("#btnDesactivar_cajas_vales_caja").hide();
			$("#btnRestaurar_cajas_vales_caja").hide();
			$("#btnGuardarDetalles_cajas_vales_caja").hide();
			//Agregar clase no-mostrar para ocultar la cuenta bancaria
	   		$('#divCuentaBancaria_cajas_vales_caja').addClass("no-mostrar");
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_cajas_vales_caja()
		{
			try {
				
				//Cerrar modal 
				objCajasValesCaja.close();
				//Si el id de la referencia (para la autorización) se recuperó del modal Vales de Caja Chica
				if($('#txtModalCajasVales_autorizar_cajas_vales_caja').val() == 'SI')
				{
					//Hacer un llamado a la función para cerrar modal Autorizar Vale de Caja Chica
					cerrar_autorizar_cajas_vales_caja();
				}
			
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_cajas_vales_caja').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cajas_vales_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cajas_vales_caja();
			//Validación del formulario de campos obligatorios
			$('#frmCajasValesCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_cajas_vales_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strCuentaBancaria_cajas_vales_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cuenta bancaria
					                                    if($('#cmbTipoVale_cajas_vales_caja').val() === 'TRANSFERENCIA ELECTRONICA' &&
					                                       $('#txtCuentaBancariaID_cajas_vales_caja').val() === '')
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
										strReferencia_cajas_vales_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado o proveedor
					                                    if($('#txtReferenciaID_cajas_vales_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un empleado o proveedor existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strSucursalGasto_cajas_vales_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la sucursal
					                                    if(value != '' && $('#txtSucursalGastoID_cajas_vales_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una sucursal existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strDepartamento_cajas_vales_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del departamento
					                                    if(value != '' && $('#txtDepartamentoID_cajas_vales_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un departamento existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},										
										strTipoVale_cajas_vales_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cuenta bancaria
					                                    if($('#cmbTipoVale_cajas_vales_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Seleccione un tipo de vale'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strConcepto_cajas_vales_caja: {
											validators: {
												notEmpty: {message: 'Escriba un concepto'}
											}
										},
										intImporte_cajas_vales_caja: {
											validators: {
												notEmpty: {message: 'Escriba un importe'}
											}
										},
					                    strFactura_detalles_cajas_vales_caja: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intSubtotal_detalles_cajas_vales_caja: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_detalles_cajas_vales_caja: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIeps_detalles_cajas_vales_caja: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strProveedor_detalles_cajas_vales_caja: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strConcepto_detalles_cajas_vales_caja: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_cajas_vales_caja = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_cajas_vales_caja = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_cajas_vales_caja.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_cajas_vales_caja.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cajas_vales_caja = $('#frmCajasValesCaja').data('bootstrapValidator');
			bootstrapValidator_cajas_vales_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cajas_vales_caja.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_cajas_vales_caja();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cajas_vales_caja()
		{
			try
			{
				$('#frmCajasValesCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para verificar que la caja de la sucursal se encuentre abierta
		function get_apertura_caja_cajas_vales_caja()
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
							mensaje_cajas_vales_caja('error', data.mensaje);
			       	    }
			       	    else
			       	    {	
		       	    		//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cajas_vales_caja();
							//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
							$('#divEncabezadoModal_cajas_vales_caja').addClass("estatus-NUEVO");
							//Abrir modal
							objCajasValesCaja = $('#CajasValesCajaBox').bPopup({
												   appendTo: '#CajasValesCajaContent', 
					                               contentContainer: 'CajasValesCajaM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtReferencia_cajas_vales_caja').focus();
			       	    }
			       },
			       'json');
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_cajas_vales_caja()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('caja/cajas_vales/guardar',
					{ 
						intCajaValeID: $('#txtCajaValeID_cajas_vales_caja').val(),
						strFolioConsecutivo: $('#txtFolio_cajas_vales_caja').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_cajas_vales_caja').val()),
						strTipoVale: $('#cmbTipoVale_cajas_vales_caja').val(),
						intCuentaBancariaID: $('#txtCuentaBancariaID_cajas_vales_caja').val(),
						strTipoReferencia: $('#txtTipoReferencia_cajas_vales_caja').val(),
						intReferenciaID: $('#txtReferenciaID_cajas_vales_caja').val(),
						intSucursalGasto: $('#txtSucursalGastoID_cajas_vales_caja').val(),
						intDepartamentoID: $('#txtDepartamentoID_cajas_vales_caja').val(),
						strConcepto: $('#txtConcepto_cajas_vales_caja').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intImporte: $.reemplazar($("#txtImporte_cajas_vales_caja").val(), ",", ""),
						strObservaciones: $('#txtObservaciones_cajas_vales_caja').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_cajas_vales_caja').val()
						
					},
					function(data) {
						if (data.resultado)
						{
							//Si no existe id del vale de caja, significa que es un nuevo registro   
							if($('#txtCajaValeID_cajas_vales_caja').val() == '')
							{
							  	//Asignar el id ddel vale de caja registrado en la base de datos
                     			$('#txtCajaValeID_cajas_vales_caja').val(data.caja_vale_id);
                     			//Asignar folio consecutivo
                 				$('#txtFolio_cajas_vales_caja').val(data.folio);
                 			}
                 			
         					//Hacer un llamado a la función para cerrar modal
	                    	cerrar_cajas_vales_caja();
	                    	//Hacer un llamado a la función para abrir modal de autorización
							abrir_autorizar_cajas_vales_caja($('#txtCajaValeID_cajas_vales_caja').val(), $('#txtFolio_cajas_vales_caja').val(), 'Guardar');

							//Hacer llamado a la función  para cargar  los registros en el grid
	               			paginacion_cajas_vales_caja();  
             				
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cajas_vales_caja(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_cajas_vales_caja(tipoMensaje, mensaje)
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
												$('#txtOrdenCompra_detalles_cajas_vales_caja').focus();
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
		function cambiar_estatus_cajas_vales_caja(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCajaValeID_cajas_vales_caja').val();

			}
			else
			{
				intID = id;
			}

		  	//Si el estatus del registro es ACTIVO o CERRADO
		    if(estatus == 'ACTIVO' || estatus == 'CERRADO' ) 
		    {
		    	//Variable que se utiliza para asignar el mensaje de acción
		    	var strMensaje = '¿Está seguro que desea desactivar el registro?';

		    	//Si el estatus del registro es CERRADO
		    	if(estatus == 'CERRADO')
		    	{
		    		strMensaje = '¿Está seguro que desea finalizar (cerrar) el registro?';
		    	}

				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>'+strMensaje+'</strong>',
				             {'type':     'question',
				              'title':    'Vales de Caja Chica',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus del registro dependiendo de la acción
				                              $.post('caja/cajas_vales/set_estatus',
				                                     {intCajaValeID: intID,
				                                      strEstatus: estatus
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                            //Hacer llamado a la función  para cargar  los registros en el grid
				                                            paginacion_cajas_vales_caja();

				                                            //Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_cajas_vales_caja();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_cajas_vales_caja(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('caja/cajas_vales/set_estatus',
				     {intCajaValeID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
					        //Hacer llamado a la función para cargar  los registros en el grid
					      	paginacion_cajas_vales_caja();

					      	//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_cajas_vales_caja();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_cajas_vales_caja(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

	
		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_cajas_vales_caja(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('caja/cajas_vales/get_datos',
			       {intCajaValeID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cajas_vales_caja();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				          	//Recuperar valores
				          	$('#txtCajaValeID_cajas_vales_caja').val(data.row.caja_vale_id);
				          	$('#txtFolio_cajas_vales_caja').val(data.row.folio);
				          	$('#txtFecha_cajas_vales_caja').val(data.row.fecha);
				          	$('#cmbTipoVale_cajas_vales_caja').val(data.row.tipo_vale);
				          	$('#txtCuentaBancariaID_cajas_vales_caja').val(data.row.cuenta_bancaria_id);
				          	$('#txtCuentaBancaria_cajas_vales_caja').val(data.row.cuenta_bancaria);
				          	$('#txtTipoReferencia_cajas_vales_caja').val(data.row.tipo_referencia);
						    $('#txtReferenciaID_cajas_vales_caja').val(data.row.referencia_id);
						    $('#txtReferencia_cajas_vales_caja').val(data.row.referencia);
						    $('#txtSucursalGastoID_cajas_vales_caja').val(data.row.sucursal_gasto);
						    $('#txtSucursalGasto_cajas_vales_caja').val(data.row.sucursal);
						    $('#txtDepartamentoID_cajas_vales_caja').val(data.row.departamento_id);
						    $('#txtDepartamento_cajas_vales_caja').val(data.row.departamento);
						    $('#txtConcepto_cajas_vales_caja').val(data.row.concepto);
						    $('#txtImporte_cajas_vales_caja').val(data.row.importe);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporte_cajas_vales_caja').formatCurrency({ roundToDecimalPlace: 2 });
					        $('#txtObservaciones_cajas_vales_caja').val(data.row.observaciones);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_cajas_vales_caja').addClass("estatus-"+strEstatus);
				            //Mostrar los siguientes botones
				            $("#btnImprimirRegistro_cajas_vales_caja").show();
				            //Variable que se utiliza para asignar el total de detalles que tiene el registro
				            var intTotalDetalles = data.row.total_detalles;

				            //Si existen archivos del registro
				           	if(data.total_archivos > 0)
				           	{
				           		//Mostrar botón Descargar Archivos
				            	$("#btnDescargarArchivos_cajas_vales_caja").show();
				           	}
				            
				           	//Si el tipo de vale es TRANSFERENCIA ELECTRONICA
				            if(data.row.tipo_vale == 'TRANSFERENCIA ELECTRONICA')
				            {

				            	//Quitar clase no-mostrar para mostrar la cuenta bancaria
   								$('#divCuentaBancaria_cajas_vales_caja').removeClass("no-mostrar");
				            }

				            //Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmCajasValesCaja').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					           	$("#btnGuardar_cajas_vales_caja").hide();

					           	//Si existen detalles del registro o el estatus del registro es AUTORIZADO
					            if(intTotalDetalles > 0 || strEstatus == 'AUTORIZADO')
					           	{
					           		//Quitar clase disabled disabledTab para habilitar el siguiente tab
							    	$('#tabComprobacion_cajas_vales_caja').removeClass("disabled disabledTab");
					           	}				            	  

					            //Si no existe id del corte de caja
					            if(data.row.caja_corte_id == 0)
					            {
					            	//Si el estatus del registro es INACTIVO
				            		if(strEstatus == 'INACTIVO')
				            		{
				            			//Mostrar botón Restaurar
										$("#btnRestaurar_cajas_vales_caja").show();
										
				            		}
				            		else 
				            		{	
				            			//Si el estatus del registro es AUTORIZADO
				            			if(strEstatus == 'AUTORIZADO')
				            			{
				            				//Habilitar las siguientes elementos del formulario
					            			$('#cmbTipo_detalles_cajas_vales_caja').removeAttr('disabled');
					            			$('#txtFecha_detalles_cajas_vales_caja').removeAttr('disabled');
					            			$('#txtSubtotal_detalles_cajas_vales_caja').removeAttr('disabled');
					            			$('#txtConcepto_detalles_cajas_vales_caja').removeAttr('disabled');
					            			$('#archivo_varios_detalles_cajas_vales_caja').removeAttr('disabled');
					            			//Mostrar botón Guardar
					            			$("#btnGuardarDetalles_cajas_vales_caja").show();
					            			//Si existen detalles del registro
					            			if(intTotalDetalles > 0 )
					            			{
					            				//Mostrar botón Finalizar
					            				$("#btnFinalizar_cajas_vales_caja").show();
					            			}
				            			}
										
				            		}
					            }

				            }
				            else
				            {
				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
					            {
					            	//Mostrar los siguientes botones  
					            	$("#btnDesactivar_cajas_vales_caja").show();
					            	$("#btnAutorizar_cajas_vales_caja").show();
					            }
				            }


				            //Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	
								//Variable que se utiliza para asignar el renglón del detalle
								var intRenglon = data.detalles[intCon].renglon;
								//Variable que se utiliza para asignar el tipo de renglón
								var strTipoRenglon = '"Existente"';
							   //Variables que se utiliza para asignar el id del objeto (input) tipo file
								var strIDCampoArchivo = 'archivo_varios_detalles_cajas_vales_caja_'+intRenglon;
								//Variables que se utiliza para asignar el id del área (spam) del objeto (input) tipo file
								var strIDCampoArea = 'archivos_area_detalles_cajas_vales_caja_'+intRenglon;
								//Variable que se utiliza para asignar las acciones del archivo
								var strAccionesArchivo = '';
								var strNombreArchivo = data.detalles[intCon].archivos;

								//Si existe archivo del detalle
								if(strNombreArchivo != '')
								{
									//Descargar archivo(s)
									strAccionesArchivo += "<button class='btn btn-default btn-xs' title='Descargar archivo'" +
															 " onclick='descargar_archivos_detalles_cajas_vales_caja("+intRenglon+")'>" + 
															 "<span class='glyphicon glyphicon-download-alt'></span></button>";

									//Eliminar archivo(s)
									strAccionesArchivo += "<button class='btn btn-default btn-xs' title='Eliminar archivo'" +
															 " onclick='eliminar_archivo_detalles_cajas_vales_caja("+intRenglon+","+strTipoRenglon+")'>" + 
															 "<span class='glyphicon glyphicon-export'></span></button>";
								}

								

								//Crear instancia del objeto Detalle del vale de caja
								objDetalleValeCajasValesCaja = new  DetalleValeCajasValesCaja('', '', '', '', '', '', 
																							  '', '', '', '', '', '', '', 
																							  '', '', '', '', '', 
																			  				  '', '', '', '', '', '', '',
																			  				  '', '', '', '', '', '');


								

							    //Variables que se utilizan para asignar valores del detalle
								var intSubtotal = parseFloat(data.detalles[intCon].subtotal);
								var intImporteIva = parseFloat(data.detalles[intCon].iva);
								var intImporteIeps = parseFloat(data.detalles[intCon].ieps);
								//Variable que se utiliza para asignar el importe total
								var intTotal = 0;

								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;

								

							    //Asignar valores al objeto
							    objDetalleValeCajasValesCaja.strTipo = data.detalles[intCon].tipo;
							    objDetalleValeCajasValesCaja.dteFecha = data.detalles[intCon].fecha;
							    objDetalleValeCajasValesCaja.dteFechaFormat = data.detalles[intCon].fecha_format;
							    objDetalleValeCajasValesCaja.strTipoOrdenCompra = data.detalles[intCon].tipo_orden_compra;
							    objDetalleValeCajasValesCaja.intOrdenCompraID = data.detalles[intCon].orden_compra_id;
							    objDetalleValeCajasValesCaja.strOrdenCompra = data.detalles[intCon].folio_orden_compra;
								objDetalleValeCajasValesCaja.intProveedorID = data.detalles[intCon].proveedor_id;
								objDetalleValeCajasValesCaja.strProveedor = data.detalles[intCon].proveedor;
								objDetalleValeCajasValesCaja.strFactura =  data.detalles[intCon].factura;
								objDetalleValeCajasValesCaja.strConcepto = data.detalles[intCon].concepto;
								objDetalleValeCajasValesCaja.intSubtotal = intSubtotal;
								objDetalleValeCajasValesCaja.intTasaCuotaIva = data.detalles[intCon].tasa_cuota_iva;
								objDetalleValeCajasValesCaja.intIva =  intImporteIva;
								objDetalleValeCajasValesCaja.intTasaCuotaIeps = data.detalles[intCon].tasa_cuota_ieps;
								objDetalleValeCajasValesCaja.intIeps = intImporteIeps;
								objDetalleValeCajasValesCaja.intPorcentajeIva = data.detalles[intCon].porcentaje_iva;
								objDetalleValeCajasValesCaja.intPorcentajeIeps =  data.detalles[intCon].porcentaje_ieps;
								objDetalleValeCajasValesCaja.intTotal =  intTotal;
								//Asignar valores (del archivo) al objeto
								objDetalleValeCajasValesCaja.strArchivoExistente = strNombreArchivo;
								objDetalleValeCajasValesCaja.strIDCampoArchivo = strIDCampoArchivo;
								objDetalleValeCajasValesCaja.intRenglonAnterior = intRenglon;
								objDetalleValeCajasValesCaja.strTipoRenglon =  'Existente'; 
								objDetalleValeCajasValesCaja.strIDCampoArea =  strIDCampoArea;
								objDetalleValeCajasValesCaja.intSucursalID = data.detalles[intCon].sucursal_id;
								objDetalleValeCajasValesCaja.intModuloID = data.detalles[intCon].modulo_id;
								objDetalleValeCajasValesCaja.intGastoTipoID = data.detalles[intCon].gasto_tipo_id;
								objDetalleValeCajasValesCaja.strGastoTipo =  data.detalles[intCon].gasto;
								objDetalleValeCajasValesCaja.strTipoGasto = data.detalles[intCon].tipo_gasto;
								objDetalleValeCajasValesCaja.intVehiculoID = data.detalles[intCon].vehiculo_id;
								objDetalleValeCajasValesCaja.strVehiculo = data.detalles[intCon].vehiculo;
								objDetalleValeCajasValesCaja.strParqueVehicular = data.detalles[intCon].parque_vehicular;
								//Agregar datos del detalle del vale de caja
								objDetallesValeCajasValesCaja.setDetalle(objDetalleValeCajasValesCaja);

								//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_cajas_vales_caja').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaTipo = objRenglon.insertCell(0);
								var objCeldaFactura = objRenglon.insertCell(1);
								var objCeldaGastoTipo = objRenglon.insertCell(2);
								var objCeldaConcepto = objRenglon.insertCell(3);					
								var objCeldaSubtotal = objRenglon.insertCell(4);
								var objCeldaIva = objRenglon.insertCell(5);
								var objCeldaIeps = objRenglon.insertCell(6);
								var objCeldaTotal = objRenglon.insertCell(7);
								var objCeldaAcciones = objRenglon.insertCell(8);
								//Columnas ocultas
								var objCeldaPorcentajeIva = objRenglon.insertCell(9);
								var objCeldaPorcentajeIeps = objRenglon.insertCell(10);
								var objCeldaTasaCuotaIva = objRenglon.insertCell(11);
								var objCeldaTasaCuotaIeps = objRenglon.insertCell(12);
								var objCeldaProveedorID = objRenglon.insertCell(13);
								var objCeldaProveedor = objRenglon.insertCell(14);
								var objCeldaArchivoExistente = objRenglon.insertCell(15);
								var objCeldaIDCampoArchivo = objRenglon.insertCell(16);
								//Columna que se utiliza para asignar el renglon de un detalle existente de esta manera 
								//se renombrara la carpeta que contiene los archivos
								var objCeldaRenglonAnterior = objRenglon.insertCell(17);
								var objCeldaTipoRenglon = objRenglon.insertCell(18);
								var objCeldaTipoOrdenCompra = objRenglon.insertCell(19);
								var objCeldaOrdenCompraID = objRenglon.insertCell(20);
								var objCeldaOrdenCompra = objRenglon.insertCell(21);
								var objCeldaTipoGasto = objRenglon.insertCell(22);
								var objCeldaSucursalID = objRenglon.insertCell(23);
								var objCeldaModuloID = objRenglon.insertCell(24);
								var objCeldaGastoTipoID = objRenglon.insertCell(25);
								var objCeldaVehiculoID = objRenglon.insertCell(26);
								var objCeldaVehiculo = objRenglon.insertCell(27);
								var objCeldaParqueVehicular = objRenglon.insertCell(28);
								var objCeldaFecha = objRenglon.insertCell(29);
								var objCeldaFechaFormat = objRenglon.insertCell(30);


								//Cambiar cantidad a  formato moneda (a visualizar)
								intSubtotal = formatMoney(intSubtotal, intNumDecimalesPrecioUnitBDCajasValesCaja, '');
								intImporteIva = formatMoney(intImporteIva, intNumDecimalesIvaUnitBDCajasValesCaja, '');
								intImporteIeps = formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDCajasValesCaja, '');
								intTotal = formatMoney(intTotal, intNumDecimalesMostrarCajasValesCaja, '');


								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', intRenglon);
								objCeldaTipo.setAttribute('class', 'movil b1');
								objCeldaTipo.innerHTML = objDetalleValeCajasValesCaja.strTipo;
								objCeldaFactura.setAttribute('class', 'movil b2');
								objCeldaFactura.innerHTML = objDetalleValeCajasValesCaja.strFactura;
								objCeldaGastoTipo.setAttribute('class', 'movil b3');
								objCeldaGastoTipo.innerHTML = objDetalleValeCajasValesCaja.strGastoTipo;
								objCeldaConcepto.setAttribute('class', 'movil b4');
								objCeldaConcepto.innerHTML =  objDetalleValeCajasValesCaja.strConcepto;
								objCeldaSubtotal.setAttribute('class', 'movil b5');
								objCeldaSubtotal.innerHTML = intSubtotal;
								objCeldaIva.setAttribute('class', 'movil b6');
								objCeldaIva.innerHTML = intImporteIva;
								objCeldaIeps.setAttribute('class', 'movil b7');
								objCeldaIeps.innerHTML = intImporteIeps;
								objCeldaTotal.setAttribute('class', 'movil b8');
								objCeldaTotal.innerHTML = intTotal;
								objCeldaAcciones.setAttribute('class', 'td-center movil b9');
								//Si el estatus del registro es AUTORIZADO
		            			if(strEstatus == 'AUTORIZADO')
								{
									objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
																 " onclick='editar_renglon_detalles_cajas_vales_caja(this)'>" + 
																 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 	"<span   class='fileupload-buttonbar'>"+
															 	"<span class='btn  btn-default btn-xs fileinput-button '>"+
															 	"<span class='fa fa-upload'></span>"+
																"<span id='"+strIDCampoArea+"'>"+
																"<input name='"+strIDCampoArchivo+"[]' id='"+strIDCampoArchivo+"'"+
															 	"type='file' multiple accept='text/xml,application/pdf'"+
															 	"onchange='verificar_extension_archivos_cajas_vales_caja(this);'>"+
																"</input></span></span></span>"+
																strAccionesArchivo+
															 	"<button class='btn btn-default btn-xs' title='Eliminar'" +
															 	" onclick='verificar_renglon_eliminar_detalles_cajas_vales_caja(this)'>" + 
																 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 	"<button class='btn btn-default btn-xs up' title='Subir'>" + 
																"<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
																"<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 	"<span class='glyphicon glyphicon-arrow-down'></span></button>";
								}
								else
								{
									objCeldaAcciones.innerHTML = "";
								}


								objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIva.innerHTML = objDetalleValeCajasValesCaja.intPorcentajeIva; 
								objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIeps.innerHTML = objDetalleValeCajasValesCaja.intPorcentajeIeps;
								objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIva.innerHTML = objDetalleValeCajasValesCaja.intTasaCuotaIva;
								objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIeps.innerHTML =  objDetalleValeCajasValesCaja.intTasaCuotaIeps;
								objCeldaProveedorID.setAttribute('class', 'no-mostrar');
								objCeldaProveedorID.innerHTML =  objDetalleValeCajasValesCaja.intProveedorID;
								objCeldaProveedor.setAttribute('class', 'no-mostrar');
								objCeldaProveedor.innerHTML =  objDetalleValeCajasValesCaja.strProveedor;
								objCeldaArchivoExistente.setAttribute('class', 'no-mostrar');
								objCeldaArchivoExistente.innerHTML = objDetalleValeCajasValesCaja.strArchivoExistente;
								objCeldaIDCampoArchivo.setAttribute('class', 'no-mostrar');
								objCeldaIDCampoArchivo.innerHTML = objDetalleValeCajasValesCaja.strIDCampoArchivo; 
								objCeldaRenglonAnterior.setAttribute('class', 'no-mostrar');
								objCeldaRenglonAnterior.innerHTML = objDetalleValeCajasValesCaja.intRenglonAnterior; 
								objCeldaTipoRenglon.setAttribute('class', 'no-mostrar');
								objCeldaTipoRenglon.innerHTML = objDetalleValeCajasValesCaja.strTipoRenglon;
								objCeldaTipoOrdenCompra.setAttribute('class', 'no-mostrar');
								objCeldaTipoOrdenCompra.innerHTML = objDetalleValeCajasValesCaja.strTipoOrdenCompra; 
								objCeldaOrdenCompraID.setAttribute('class', 'no-mostrar');
								objCeldaOrdenCompraID.innerHTML = objDetalleValeCajasValesCaja.intOrdenCompraID; 
								objCeldaOrdenCompra.setAttribute('class', 'no-mostrar');
								objCeldaOrdenCompra.innerHTML = objDetalleValeCajasValesCaja.strOrdenCompra;
								objCeldaTipoGasto.setAttribute('class', 'no-mostrar');
								objCeldaTipoGasto.innerHTML = objDetalleValeCajasValesCaja.strTipoGasto;
								objCeldaSucursalID.setAttribute('class', 'no-mostrar');
								objCeldaSucursalID.innerHTML = objDetalleValeCajasValesCaja.intSucursalID;
								objCeldaModuloID.setAttribute('class', 'no-mostrar');
								objCeldaModuloID.innerHTML = objDetalleValeCajasValesCaja.intModuloID;
								objCeldaGastoTipoID.setAttribute('class', 'no-mostrar');
								objCeldaGastoTipoID.innerHTML = objDetalleValeCajasValesCaja.intGastoTipoID;
								objCeldaVehiculoID.setAttribute('class', 'no-mostrar');
								objCeldaVehiculoID.innerHTML = objDetalleValeCajasValesCaja.intVehiculoID;
								objCeldaVehiculo.setAttribute('class', 'no-mostrar');
								objCeldaVehiculo.innerHTML = objDetalleValeCajasValesCaja.strVehiculo;
								objCeldaParqueVehicular.setAttribute('class', 'no-mostrar');
								objCeldaParqueVehicular.innerHTML = objDetalleValeCajasValesCaja.strParqueVehicular;
								objCeldaFecha.setAttribute('class', 'no-mostrar');
								objCeldaFecha.innerHTML = objDetalleValeCajasValesCaja.dteFecha;
								objCeldaFechaFormat.setAttribute('class', 'no-mostrar');
								objCeldaFechaFormat.innerHTML = objDetalleValeCajasValesCaja.dteFechaFormat;
				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_cajas_vales_caja();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_cajas_vales_caja tr").length - 2;
							$('#numElementos_detalles_cajas_vales_caja').html(intFilas);


			            	//Abrir modal
				            objCajasValesCaja = $('#CajasValesCajaBox').bPopup({
														  appendTo: '#CajasValesCajaContent', 
							                              contentContainer: 'CajasValesCajaM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});
				            //Enfocar caja de texto
							$('#txtReferencia_cajas_vales_caja').focus();
			       	    }
			       },
			       'json');
		}
		//Función para verificar la extensión de los archivos seleccionados de un objeto tipo file
		function verificar_extension_archivos_cajas_vales_caja(campoID)
		{			

			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDCajasValesCaja = $(campoID).attr("id");
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDCajasValesCaja);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDCajasValesCaja)[0].files;
			//Variable que se utiliza para asignar la extensión del primer archivo seleccionado
			var strExtensionAnterior = '';
			//Variable que se utiliza para asignar el mensaje de error
			var strMensajeError = '';
			//Variable que se utiliza para asignar el tipo de renglón
			var strTipoRenglon = '';
			//Variable que se utiliza para asignar el renglón del detalle
			var intRenglonID = 0;

			//Si no existe concepto del detalle
			if($('#txtConcepto_detalles_cajas_vales_caja').val() == '')
			{
				//Limpiar las siguientes cajas de texto para evitar subir archivos en el renglón que fue mostrado anteriormente
				$('#txtTipoRenglon_detalles_cajas_vales_caja').val('');
				$('#txtRenglonAnterior_detalles_cajas_vales_caja').val('');

			}

			//Si no existe tipo de renglón, significa que se subira el archivo desde el modal en caso de que exista el renglón en la BD
			if(strBotonArchivoIDCajasValesCaja == 'archivo_varios_detalles_cajas_vales_caja')
			{

				strTipoRenglon = $('#txtTipoRenglon_detalles_cajas_vales_caja').val();
				intRenglonID = $('#txtRenglonAnterior_detalles_cajas_vales_caja').val();
			}
			else
			{
				 //Asignar id del botón tipo file
				 var strBotonCampoID = strBotonArchivoIDCajasValesCaja;
				 //Reemplazar id del botón por cadena vacia para obtener el renglón de la tabla
				 intRenglonID = strBotonCampoID.replace("archivo_varios_detalles_cajas_vales_caja_", "");
				 //Seleccionar el renglón de la tabla para recuperar el nombre del archivo
				 var selectedRow = document.getElementById("dg_detalles_cajas_vales_caja").rows[intRenglonID].cells;
				 //Asignar el tipo de renglón
				 strTipoRenglon = selectedRow[18].innerHTML;
			}
			

			//Crear instancia al objeto del formulario
	        var formData = new FormData($("#frmCajasValesCaja")[0]);
	     	//Agregar campos al objeto del formulario
			formData.append("intCajaValeID_detalles_cajas_vales_caja", $("#txtCajaValeID_cajas_vales_caja").val());
			formData.append("intRenglon_detalles_cajas_vales_caja", intRenglonID);

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
					formData.append("archivo_varios_detalles_cajas_vales_caja[]", document.getElementById(strBotonArchivoIDCajasValesCaja).files[intCont]);
				 	
				}
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Limpia ruta del archivo cargado
		        $('#'+strBotonArchivoIDCajasValesCaja).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_cajas_vales_caja('error', strMensajeError);
	        }
	        else
	        {
	        	//Si el renglón existe en la BD
	        	if(strTipoRenglon == 'Existente')
		        {
		        	//Hacer un llamado al método del controlador para subir archivos del registro
		            $.ajax({
		                url: 'caja/cajas_vales/subir_archivos',
		                type: "POST",
		                data: formData,
		                contentType: false,
		                processData: false,
		                success: function(data)
		                {
		                	//Limpia ruta del archivo cargado
		         			$('#'+strBotonArchivoIDCajasValesCaja).val('');
		         			//Subida finalizada
							if (data.resultado)
							{	
								//Si el renglón del registro se obtuvo del modal
								if(strBotonArchivoIDCajasValesCaja == 'archivo_varios_detalles_cajas_vales_caja')
								{
									//Mostrar los siguientes botones
									$('#btnDescargarArchivo_detalles_cajas_vales_caja').show();
									$('#btnEliminarArchivo_detalles_cajas_vales_caja').show();
								}

								//Si existen archivos del vale de caja
								if(data.total_archivos > 0)
								{
									//Mostrar botón Descargar Archivos
					            	$("#btnDescargarArchivos_cajas_vales_caja").show();
								}

								//Hacer un llamado a la función para agregar las acciones (subir y eliminar) del archivo
								//en la columna de acciones (grid view)
								agregar_acciones_archivo_detalles_cajas_vales_caja(intRenglonID, 'subir_archivo');
							}

							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		    				mensaje_cajas_vales_caja(data.tipo_mensaje, data.mensaje);
		                   
		                }
	            	});
			    	
		        }
	        }
	       
		}

	    //Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_detalles_cajas_vales_caja(renglon)
		{
			//Variable que se utiliza para asignar el renglón del registro
			var intRenglonID = 0;

			//Si no existe renglón, significa que se realizará la descarga desde el modal
			if(renglon == '')
			{

				intRenglonID = $('#txtRenglonAnterior_detalles_cajas_vales_caja').val();

			}
			else
			{
				intRenglonID = renglon;
			}


			//Abrir pestaña para realizar descarga de los documentos
			window.open("caja/cajas_vales/descargar_archivos_detalle/"+"/"+$('#txtCajaValeID_cajas_vales_caja').val()+"/"+intRenglonID);
		}


		//Función que se utiliza para eliminar el archivo del registro seleccionado
		function eliminar_archivo_detalles_cajas_vales_caja(renglon, tipoRenglon)
		{
			//Variable que se utiliza para asignar el tipo de renglón
			var strTipoRenglon = '';
			//Variable que se utiliza para asignar el renglón del detalle
			var intRenglonID = 0;

			//Si no existe renglón, significa que se eliminara el archivo desde el modal
			if(renglon == '')
			{
				intRenglonID = $('#txtRenglonAnterior_detalles_cajas_vales_caja').val();
				strTipoRenglon = $('#txtTipoRenglon_detalles_cajas_vales_caja').val();

			}
			else
			{
				intRenglonID = renglon;
				strTipoRenglon = tipoRenglon;
			}

			//Hacer un llamado al método del controlador para eliminar carpeta que contiene los archivos del registro
			$.post('caja/cajas_vales/eliminar_carpeta_detalle',
			     {intCajaValeID: $('#txtCajaValeID_cajas_vales_caja').val(),
			      intRenglon: intRenglonID
			     },
			     function(data) {
			       
			        //Si el renglón existe en la BD
			        if(strTipoRenglon == 'Existente')
			        {
			        	//Archivo eliminado
						if (data.resultado)
						{	
							//Si el renglón del registro se obtuvo del modal
							if(renglon == '')
							{
								//Ocultar los siguientes botones
								$('#btnDescargarArchivo_detalles_cajas_vales_caja').hide();
								$('#btnEliminarArchivo_detalles_cajas_vales_caja').hide();
							}

					
							//Si no existen archivos del vale de caja
							if(data.total_archivos == 0)
							{
								//Ocultar botón Descargar Archivos
				            	$("#btnDescargarArchivos_cajas_vales_caja").hide();
							}

							//Hacer un llamado a la función para quitar las acciones (subir y eliminar) del archivo
							//en la columna de acciones  (grid view)
							agregar_acciones_archivo_detalles_cajas_vales_caja(intRenglonID, 'eliminar_archivo');
						}

			       	 	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        	mensaje_cajas_vales_caja(data.tipo_mensaje, data.mensaje);
			        }
			        else if(data.tipo_mensaje == 'error')
			        {
			        	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			       		 mensaje_cajas_vales_caja(data.tipo_mensaje, data.mensaje);
			        }
			       
			     },
			    'json');
		}


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la orden de compra (general/especial/maquinaria/refacciones)
		function  inicializar_orden_compra_detalles_cajas_vales_caja()
		{
			//Array que contiene las cajas que se van habilitar o deshabilitar
			arrCajasTextos  = {
				//Son los id de los input que se van a deshabilitar
				rows: ['#txtProveedor_detalles_cajas_vales_caja',
					   '#txtSubtotal_detalles_cajas_vales_caja',
					   '#txtPorcentajeIva_detalles_cajas_vales_caja',
					   '#txtPorcentajeIeps_detalles_cajas_vales_caja'],
				//Es asignar un attributo disbaled|checked
				attribute: 'disabled'					
			};

			//Si existe el id de la orden de compra
			if($('#txtOrdenCompraID_detalles_cajas_vales_caja').val() != '')
			{

				//Bool es para deshabilitar        		
				arrCajasTextos.bool =  true;
			}
			else
			{
				//Bool es para habilitar        		
				arrCajasTextos.bool =  false;
			}

			//Hacer un llamado a la función para  habilitar o deshabilitar cajas de texto	
			$.habilitar_deshabilitar_campos(arrCajasTextos);
		}


		//Función que se utiliza para limpiar los elementos de la orden de compra
		function limpiar_elementos_orden_compra_detalles_cajas_vales_caja(tipo)
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtTipoOrdenCompra_detalles_cajas_vales_caja').val(''); 
			$('#txtProveedorID_detalles_cajas_vales_caja').val(''); 
			$('#txtProveedor_detalles_cajas_vales_caja').val(''); 
			$('#txtFactura_detalles_cajas_vales_caja').val(''); 
			$('#txtTasaCuotaIva_detalles_cajas_vales_caja').val(''); 
			$('#txtPorcentajeIva_detalles_cajas_vales_caja').val(''); 
			$('#txtIvaOrdenCompra_detalles_cajas_vales_caja').val(''); 
			$('#txtTasaCuotaIeps_detalles_cajas_vales_caja').val(''); 
			$('#txtPorcentajeIeps_detalles_cajas_vales_caja').val(''); 
			$('#txtIepsOrdenCompra_detalles_cajas_vales_caja').val(''); 
			$('#txtTotalOrdenCompra_detalles_cajas_vales_caja').val(''); 
			//Mostrar Div que contiene los campos del gasto y parque vehicular
	        $('#DivParqueVehicular_detalles_cajas_vales_caja').show();

			//Si se cumple la sentencia, significa que se van a limpiar los datos cuando selecciona otro registro del autocomplete ordenes de compra
			if(tipo == 'autocomplete')
			{
			  $('#txtSubtotal_detalles_cajas_vales_caja').val('');
			}
		}


		//Función que se utiliza para limpiar los elementos del tipo de gasto
		function limpiar_elementos_tipo_gasto_detalles_cajas_vales_caja()
		{
			
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtVehiculoID_detalles_cajas_vales_caja').val('');
		    $('#txtVehiculo_detalles_cajas_vales_caja').val('');	
		    //Limpiar contenido de los siguientes combobox
		    $('#cmbParqueVehicular_detalles_cajas_vales_caja').val('');
		    //Hacer un llamado a la función para inicializar elementos del vehículo
		    inicializar_vehiculo_detalles_cajas_vales_caja();
		    //Hacer un llamado a la función para mostrar u ocultar sucursal y/ módulo
      		mostrar_cmb_detalles_cajas_vales_caja();
      		//Hacer un llamado a la función para mostrar u ocultar vehículo
      		mostrar_vehiculo_detalles_cajas_vales_caja();
		}


		//Función para regresar y obtener los datos de un vehículo
		function get_datos_vehiculo_detalles_cajas_vales_caja()
		{
		 	//Hacer un llamado al método del controlador para regresar los datos del vehículo
            $.post('control_vehiculos/vehiculos/get_datos',
                  { 
                  	strBusqueda: $("#txtVehiculoID_detalles_cajas_vales_caja").val(),
	       			strTipo: 'id'
                  },
                  function(data) {	                  	
                    if(data.row){
                       
                        //Variable que se utiliza para asignar el id de la sucursal
						var intSucursalID = data.row.sucursal_id;
						//Variable que se utiliza para asignar el id del módulo
						var intModuloID = data.row.modulo_id;

                        //Si existe id de la sucursal
					    if(intSucursalID > 0)
					    {
					    	$("#cmbSucursalID_detalles_cajas_vales_caja").val(data.row.sucursal_id);
					    	$("#cmbTipoGasto_detalles_cajas_vales_caja").val(strCuenta602CajasValesCaja);
					    }
					    else //Corporativo
					    {
					    	$("#cmbTipoGasto_detalles_cajas_vales_caja").val('GASTOS CORPORATIVOS');
					    	
					    }

					    //Hacer un llamado a la función para mostrar u ocultar sucursal y/o módulo
	          			mostrar_cmb_detalles_cajas_vales_caja(intSucursalID, intModuloID);

					    //Hacer un llamado a la función para cargar gastos en el combobox
						cargar_gastos_detalles_cajas_vales_caja();
                      
                    }
                  }
                 ,
                'json');

		}

		//Función para inicializar elementos del vehículo
		function inicializar_vehiculo_detalles_cajas_vales_caja()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#cmbSucursalID_detalles_cajas_vales_caja").val('');
            $("#cmbTipoGasto_detalles_cajas_vales_caja").val('');
            $("#cmbModuloID_detalles_cajas_vales_caja").val('');
            $('#cmbGastoTipoID_detalles_cajas_vales_caja').empty();
		}

		//Función para mostrar u ocultar div que contiene el combobox de la sucursal (módulo)
		function mostrar_cmb_detalles_cajas_vales_caja(intSucursalID = null, intModuloID = null)
		{
			//Asignar el texto del combobox
			var strTipo = $('select[name="strTipoGasto_detalles_cajas_vales_caja"] option:selected').text();

			//Dependiendo  del tipo de gasto mostar u ocultar div´s que contienen combobox
            if(strTipo == 'GASTOS CORPORATIVOS')
            {
            	//Agregar clase no-mostrar para ocultar div que contiene el combobox del módulo
			  	$('#divCmbModuloID_detalles_cajas_vales_caja').addClass("no-mostrar");
			  	//Agregar clase no-mostrar para ocultar div que contiene el combobox de la sucursal
			  	$('#divCmbSucursalID_detalles_cajas_vales_caja').addClass("no-mostrar");
            }
            else if(strTipo == strCuenta602CajasValesCaja)//Cuenta 602
            {
                //Quitar clase no-mostrar para mostrar div que contiene el combobox del módulo
            	$('#divCmbModuloID_detalles_cajas_vales_caja').removeClass("no-mostrar");
			  	//Quitar clase no-mostrar para mostrar div que contiene el combobox de la sucursal
			  	$('#divCmbSucursalID_detalles_cajas_vales_caja').removeClass("no-mostrar");

            }
            else //Cuenta 603
            {
            	//Quitar clase no-mostrar para mostrar div que contiene el combobox de la sucursal
			  	$('#divCmbSucursalID_detalles_cajas_vales_caja').removeClass("no-mostrar");
            	//Agregar clase no-mostrar para ocultar div que contiene el combobox del módulo
            	$('#divCmbModuloID_detalles_cajas_vales_caja').addClass("no-mostrar");
            }

            //Asignar el id de la sucursal
		    $('#cmbSucursalID_detalles_cajas_vales_caja').val(intSucursalID);
		     //Asignar el id del módulo
		    $('#cmbModuloID_detalles_cajas_vales_caja').val(intModuloID);

		}

		//Función para mostrar u ocultar div que contiene los campos del vehículo
		function mostrar_vehiculo_detalles_cajas_vales_caja()
		{
			//Si el tipo de gasto cuenta con parque vehicular
			if($('#cmbParqueVehicular_detalles_cajas_vales_caja').val() == 'SI')
			{
				//Quitar clase no-mostrar para mostrar div que contiene los campos del vehículo
	   			$('#divVehiculo_detalles_cajas_vales_caja').removeClass("no-mostrar");
	   			//Enfocar caja de texto
		   	    $('#txtVehiculo_detalles_cajas_vales_caja').focus();
				
			}
			else
			{
				//Agregar clase no-mostrar para ocultar div que contiene los campos del vehículo
	   			$('#divVehiculo_detalles_cajas_vales_caja').addClass("no-mostrar");
	   			//Enfocar combobox
		   	    $('#cmbTipoGasto_detalles_cajas_vales_caja').focus();
		   	    //Limpiar contenido de las siguientes cajas de texto
		   	    $('#txtVehiculo_detalles_cajas_vales_caja').val('');
		   	    $('#txtVehiculoID_detalles_cajas_vales_caja').val('');

			}

		}


		//Función para inicializar elementos del gasto
		function inicializar_tipo_gasto_detalles_cajas_vales_caja()
		{

			//Deshabilitar las siguientes cajas de texto
			$('#txtFactura_detalles_cajas_vales_caja').attr("disabled", "disabled");
			$('#txtPorcentajeIva_detalles_cajas_vales_caja').attr("disabled", "disabled");
			$('#txtPorcentajeIeps_detalles_cajas_vales_caja').attr("disabled", "disabled");
			//Habilitar la siguiente caja de texto
			$('#txtOrdenCompra_detalles_cajas_vales_caja').removeAttr('disabled');
			$('#txtVehiculo_detalles_cajas_vales_caja').removeAttr('disabled');
			//Habilitar los siguientes combobox
			$('#cmbParqueVehicular_detalles_cajas_vales_caja').removeAttr('disabled');
			$('#cmbTipoGasto_detalles_cajas_vales_caja').removeAttr('disabled');
			$('#cmbSucursalID_detalles_cajas_vales_caja').removeAttr('disabled');
			$('#cmbModuloID_detalles_cajas_vales_caja').removeAttr('disabled');
			$('#cmbGastoTipoID_detalles_cajas_vales_caja').removeAttr('disabled');

			//Si el tipo de gasto es FISCAL							
        	if($('#cmbTipo_detalles_cajas_vales_caja').val() == 'FISCAL')
        	{
        		//Mostrar Div que contiene los campos del proveedor
				$('#DivProveedor_detalles_cajas_vales_caja').show();
				//Mostrar Div que contiene los campos del gasto y parque vehicular
				$('#DivParqueVehicular_detalles_cajas_vales_caja').show();

				//Habilitar caja de texto
				$('#txtFactura_detalles_cajas_vales_caja').removeAttr("disabled");

				//Si existe id de la orden de compra
				if($('#txtOrdenCompraID_detalles_cajas_vales_caja').val() != '')
				{
					//Deshabilitar las siguientes cajas de texto
					$('#txtSubtotal_detalles_cajas_vales_caja').attr("disabled", "disabled");
					$('#txtProveedor_detalles_cajas_vales_caja').attr("disabled", "disabled");

					//Ocultar Div que contiene los campos del gasto y parque vehicular
					$('#DivParqueVehicular_detalles_cajas_vales_caja').hide();
					//Hacer un llamado a la función para limpiar elementos del tipo de gasto
					limpiar_elementos_tipo_gasto_detalles_cajas_vales_caja();


				}
				else
				{
					//Habilitar cajas de texto
				    $('#txtSubtotal_detalles_cajas_vales_caja').removeAttr('disabled');
				    $('#txtProveedor_detalles_cajas_vales_caja').removeAttr("disabled");
				    $('#txtPorcentajeIva_detalles_cajas_vales_caja').removeAttr("disabled");
				    $('#txtPorcentajeIeps_detalles_cajas_vales_caja').removeAttr("disabled");
					
				}

        	}
        	else
        	{
        		//Ocultar Div que contiene los campos del proveedor
        		$('#DivProveedor_detalles_cajas_vales_caja').hide();
        		//Ocultar Div que contiene los campos del gasto y parque vehicular
        		$('#DivParqueVehicular_detalles_cajas_vales_caja').hide();
        		//Habilitar caja de texto
				$('#txtSubtotal_detalles_cajas_vales_caja').removeAttr('disabled');
        		
				//Limpiar contenido de las siguientes cajas de texto
				$('#txtOrdenCompraID_detalles_cajas_vales_caja').val(''); 
				$('#txtOrdenCompra_detalles_cajas_vales_caja').val(''); 
				//Hacer un llamado a la función para limpiar elementos de la orden de compra
				limpiar_elementos_orden_compra_detalles_cajas_vales_caja();
				//Hacer un llamado a la función para limpiar elementos del tipo de gasto
				limpiar_elementos_tipo_gasto_detalles_cajas_vales_caja();
        	}

		
		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_cajas_vales_caja()
		{
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;
			//Variable que se utiliza para asignar la descripción del gasto en caso de que el vale sea Fiscal
			var strGastoTipo = $('select[name="strGastoTipoID_detalles_cajas_vales_caja"] option:selected').text();

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_detalles_cajas_vales_caja').val();
			var strTipo = $('#cmbTipo_detalles_cajas_vales_caja').val();
			var dteFechaFormat = $('#txtFecha_detalles_cajas_vales_caja').val();
			var strConcepto = $('#txtConcepto_detalles_cajas_vales_caja').val();
			var intSubtotal =  $('#txtSubtotal_detalles_cajas_vales_caja').val();
			var strTipoOrdenCompra = $('#txtTipoOrdenCompra_detalles_cajas_vales_caja').val();
			var intOrdenCompraID = $('#txtOrdenCompraID_detalles_cajas_vales_caja').val();
			var strOrdenCompra = $('#txtOrdenCompra_detalles_cajas_vales_caja').val();
			var intProveedorID = $('#txtProveedorID_detalles_cajas_vales_caja').val();
			var strProveedor = $('#txtProveedor_detalles_cajas_vales_caja').val();
			var strFactura = $('#txtFactura_detalles_cajas_vales_caja').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_cajas_vales_caja').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_cajas_vales_caja').val();
			var intImporteIvaOrden = $('#txtIvaOrdenCompra_detalles_cajas_vales_caja').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_cajas_vales_caja').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_cajas_vales_caja').val();
			var intImporteIepsOrden = $('#txtIepsOrdenCompra_detalles_cajas_vales_caja').val();
			var intTotalOrden = $('#txtTotalOrdenCompra_detalles_cajas_vales_caja').val();
			var strArchivoExistente = $('#txtArchivoExistente_detalles_cajas_vales_caja').val();
			var strIDCampoArchivo = $('#txtIDCampoArchivo_detalles_cajas_vales_caja').val();
			var intRenglonAnterior = $('#txtRenglonAnterior_detalles_cajas_vales_caja').val();
			var strTipoRenglon = $('#txtTipoRenglon_detalles_cajas_vales_caja').val();
			var strIDCampoArea = $('#txtIDCampoArea_detalles_cajas_vales_caja').val();
			var strTipoGasto = $('#cmbTipoGasto_detalles_cajas_vales_caja').val();
			var intSucursalID = $('#cmbSucursalID_detalles_cajas_vales_caja').val();
			var intModuloID = $('#cmbModuloID_detalles_cajas_vales_caja').val();
			var intGastoTipoID = $('#cmbGastoTipoID_detalles_cajas_vales_caja').val();
			var strParqueVehicular = $('#cmbParqueVehicular_detalles_cajas_vales_caja').val();
			var intVehiculoID = $('#txtVehiculoID_detalles_cajas_vales_caja').val();
			var strVehiculo = $('#txtVehiculo_detalles_cajas_vales_caja').val();
			
			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_cajas_vales_caja').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (strTipo == '')
			{
				//Enfocar combobox
				$('#cmbTipo_detalles_cajas_vales_caja').focus();
			}
			else if (dteFechaFormat == '')
			{
				//Enfocar caja de texto
				$('#txtFecha_detalles_cajas_vales_caja').focus();
			}
			else if (strConcepto == '')
			{
				//Enfocar caja de texto
				$('#txtConcepto_detalles_cajas_vales_caja').focus();
			}
			else if(strTipo == 'FISCAL' && (intProveedorID == '' || strProveedor == ''))
			{
				//Enfocar caja de texto
				$('#txtProveedor_detalles_cajas_vales_caja').focus();

			}
			else if(strTipo == 'FISCAL' && strParqueVehicular == 'SI' && intVehiculoID == '')
			{
				//Enfocar caja de texto
				$('#txtVehiculo_detalles_cajas_vales_caja').focus();

			}
			else if (strTipo == 'FISCAL' && strTipoGasto == strCuenta602CajasValesCaja && intSucursalID == '')
			{
				//Enfocar combobox
				$('#cmbSucursalID_detalles_cajas_vales_caja').focus();
			}
			else if (strTipo == 'FISCAL' && strTipoGasto == strCuenta602CajasValesCaja && intModuloID == '')
			{
				//Enfocar combobox
				$('#cmbModuloID_detalles_cajas_vales_caja').focus();
			}
			else if (strTipo == 'FISCAL' && strTipoGasto == strCuenta603CajasValesCaja && intSucursalID == '')
			{
				//Enfocar combobox
				$('#cmbSucursalID_detalles_cajas_vales_caja').focus();
			}
			else if(strTipo == 'FISCAL' &&  strFactura == '')
			{
				//Enfocar caja de texto
				$('#txtFactura_detalles_cajas_vales_caja').focus();
			}
			else if (intSubtotal == '')
			{
				//Enfocar caja de texto
				$('#txtSubtotal_detalles_cajas_vales_caja').focus();
			}
			else if(strTipo == 'FISCAL' &&  intPorcentajeIva == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIva_detalles_cajas_vales_caja').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#cmbTipo_detalles_cajas_vales_caja').val('');
				$('#txtFecha_detalles_cajas_vales_caja').val(fechaActual());
				$('#txtOrdenCompraID_detalles_cajas_vales_caja').val('');
			    $('#txtOrdenCompra_detalles_cajas_vales_caja').val('');
			    //Hacer un llamado a la función para limpiar elementos de la orden de compra
			    limpiar_elementos_orden_compra_detalles_cajas_vales_caja();
			    //Hacer un llamado a la función para limpiar elementos del tipo de gasto
				limpiar_elementos_tipo_gasto_detalles_cajas_vales_caja();
			    $('#txtConcepto_detalles_cajas_vales_caja').val('');
			    $('#txtSubtotal_detalles_cajas_vales_caja').val('');
			    $('#txtRenglon_detalles_cajas_vales_caja').val('');
			    $('#txtRenglonAnterior_detalles_cajas_vales_caja').val('');
			    $('#txtTipoRenglon_detalles_cajas_vales_caja').val('');
			    $('#txtArchivoExistente_detalles_cajas_vales_caja').val('');
			    $('#txtIDCampoArchivo_detalles_cajas_vales_caja').val('');
			    $('#txtIDCampoArea_detalles_cajas_vales_caja').val('');
			    //Ocultar los siguientes botones
		    	$('#btnDescargarArchivo_detalles_cajas_vales_caja').hide();
		    	$('#btnEliminarArchivo_detalles_cajas_vales_caja').hide();
		    	//Ocultar Div que contiene los campos del proveedor
				$('#DivProveedor_detalles_cajas_vales_caja').hide();	

				//Si el tipo de vale no es Fiscal
				if(strTipo != 'FISCAL')
				{
					//Asignar descripción del gasto
					strGastoTipo = '';
				}

				//Crear instancia del objeto Detalle del vale de caja
				objDetalleValeCajasValesCaja = new  DetalleValeCajasValesCaja('', '', '', '', '', '', '', '', '', 
																			  '', '', '', '', '', '', '', '', '', 
																			  '', '', '', '', '', '', '', '', '', 
																			  '', '', '', '');

				


		        //Utilizar toUpperCase() para cambiar texto a mayúsculas
				strConcepto = strConcepto.toUpperCase();
				strFactura = strFactura.toUpperCase();

				//Convertir cadena de texto a número decimal
				intSubtotal = parseFloat($.reemplazar(intSubtotal, ",", ""));
				
				//Si existe id de la orden de compra
				if(intOrdenCompraID != '')
				{

					//Asignar valores de la orden de compra
					intImporteIva = parseFloat(intImporteIvaOrden);
					intImporteIeps = parseFloat(intImporteIepsOrden);
					intTotal = parseFloat(intTotalOrden);

				}
				else
				{
					//Redondear cantidad a decimales
					intSubtotal = intSubtotal.toFixed(intNumDecimalesPrecioUnitBDCajasValesCaja);
					intSubtotal = parseFloat(intSubtotal);

					//Si existe porcentaje de IVA
					if(intPorcentajeIva != '')
					{
						//Calcular importe de IVA
						intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);

						//Redondear cantidad a dos decimales
					    intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaUnitBDCajasValesCaja);
					    intImporteIva = parseFloat(intImporteIva);
					}
					

					//Si existe porcentaje de IEPS
					if(intPorcentajeIeps != '')
					{
						//Calcular importe de IEPS
						intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
						//Redondear cantidad a dos decimales
				   	 	intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDCajasValesCaja);
				   	 	intImporteIeps = parseFloat(intImporteIeps);
				   	}
						
				   	//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;

				}
				
				
				//Asignar valores al objeto
				objDetalleValeCajasValesCaja.strTipo = strTipo;
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				objDetalleValeCajasValesCaja.dteFecha = $.formatFechaMysql(dteFechaFormat);
				objDetalleValeCajasValesCaja.dteFechaFormat = dteFechaFormat;
				objDetalleValeCajasValesCaja.strTipoOrdenCompra = strTipoOrdenCompra;
				objDetalleValeCajasValesCaja.intOrdenCompraID = intOrdenCompraID;
				objDetalleValeCajasValesCaja.strOrdenCompra = strOrdenCompra;
				objDetalleValeCajasValesCaja.intProveedorID = intProveedorID;
				objDetalleValeCajasValesCaja.strProveedor = strProveedor;
				objDetalleValeCajasValesCaja.strFactura = strFactura;
				objDetalleValeCajasValesCaja.strConcepto = strConcepto;
				objDetalleValeCajasValesCaja.intSubtotal = intSubtotal;
				objDetalleValeCajasValesCaja.intTasaCuotaIva = intTasaCuotaIva;
				objDetalleValeCajasValesCaja.intIva = intImporteIva;
				objDetalleValeCajasValesCaja.intTasaCuotaIeps = intTasaCuotaIeps;
				objDetalleValeCajasValesCaja.intIeps = intImporteIeps;
				objDetalleValeCajasValesCaja.intPorcentajeIva = intPorcentajeIva;
				objDetalleValeCajasValesCaja.intPorcentajeIeps = intPorcentajeIeps;
				objDetalleValeCajasValesCaja.intTotal =  intTotal;
				objDetalleValeCajasValesCaja.intSucursalID = intSucursalID;
				objDetalleValeCajasValesCaja.intModuloID = intModuloID;
				objDetalleValeCajasValesCaja.intGastoTipoID = intGastoTipoID;
				objDetalleValeCajasValesCaja.strGastoTipo = strGastoTipo;
				objDetalleValeCajasValesCaja.strTipoGasto = strTipoGasto;
				objDetalleValeCajasValesCaja.intVehiculoID = intVehiculoID;
				objDetalleValeCajasValesCaja.strVehiculo = strVehiculo;
				objDetalleValeCajasValesCaja.strParqueVehicular = strParqueVehicular;

				//Cambiar cantidad a  formato moneda (a visualizar)
				intSubtotal = formatMoney(intSubtotal, intNumDecimalesPrecioUnitBDCajasValesCaja, '');
				intImporteIva = formatMoney(intImporteIva, intNumDecimalesIvaUnitBDCajasValesCaja, '');
				intImporteIeps = formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDCajasValesCaja, '');
				intTotal = formatMoney(intTotal, intNumDecimalesMostrarCajasValesCaja, '');

				//Revisamos si existe el renglón, si es así, editamos los datos del detalle
				if (intRenglon)
				{

					//Asignar valores (del archivo) al objeto
					objDetalleValeCajasValesCaja.strArchivoExistente = strArchivoExistente;
					objDetalleValeCajasValesCaja.strIDCampoArchivo = strIDCampoArchivo;
					objDetalleValeCajasValesCaja.intRenglonAnterior = intRenglonAnterior;
					objDetalleValeCajasValesCaja.strTipoRenglon = strTipoRenglon; 
					objDetalleValeCajasValesCaja.strIDCampoArea =  strIDCampoArea; 

					///Modificar los datos del detalle corespondiente al indice
	        		objDetallesValeCajasValesCaja.modificarDetalle(intRenglon, objDetalleValeCajasValesCaja);

	        		//Incrementar renglón para obtener la posición del detalle en la tabla
					intRenglon++;
					//Seleccionar el renglón de la tabla para actualizar los datos del detalle
					var selectedRow = document.getElementById("dg_detalles_cajas_vales_caja").rows[intRenglon].cells;

					selectedRow[0].innerHTML = objDetalleValeCajasValesCaja.strTipo;
					selectedRow[1].innerHTML = objDetalleValeCajasValesCaja.strFactura;
					selectedRow[2].innerHTML = objDetalleValeCajasValesCaja.strGastoTipo;
					selectedRow[3].innerHTML = objDetalleValeCajasValesCaja.strConcepto;
					selectedRow[4].innerHTML = intSubtotal;
					selectedRow[5].innerHTML = intImporteIva;
					selectedRow[6].innerHTML =  intImporteIeps;
					selectedRow[7].innerHTML = intTotal;
					selectedRow[9].innerHTML =  objDetalleValeCajasValesCaja.intPorcentajeIva;
					selectedRow[10].innerHTML =  objDetalleValeCajasValesCaja.intPorcentajeIeps;
					selectedRow[11].innerHTML = objDetalleValeCajasValesCaja.intTasaCuotaIva;
					selectedRow[12].innerHTML = objDetalleValeCajasValesCaja.intTasaCuotaIeps;
					selectedRow[13].innerHTML = objDetalleValeCajasValesCaja.intProveedorID;
					selectedRow[14].innerHTML = objDetalleValeCajasValesCaja.strProveedor;
					selectedRow[16].innerHTML = objDetalleValeCajasValesCaja.strIDCampoArchivo; 
					selectedRow[17].innerHTML = objDetalleValeCajasValesCaja.intRenglonAnterior; 
					selectedRow[19].innerHTML = objDetalleValeCajasValesCaja.strTipoOrdenCompra; 
					selectedRow[20].innerHTML = objDetalleValeCajasValesCaja.intOrdenCompraID; 
					selectedRow[21].innerHTML = objDetalleValeCajasValesCaja.strOrdenCompra; 
					selectedRow[22].innerHTML = objDetalleValeCajasValesCaja.strTipoGasto;
					selectedRow[23].innerHTML = objDetalleValeCajasValesCaja.intSucursalID;
					selectedRow[24].innerHTML = objDetalleValeCajasValesCaja.intModuloID;
					selectedRow[25].innerHTML = objDetalleValeCajasValesCaja.intGastoTipoID;
					selectedRow[26].innerHTML = objDetalleValeCajasValesCaja.intVehiculoID;
					selectedRow[27].innerHTML = objDetalleValeCajasValesCaja.strVehiculo;
					selectedRow[28].innerHTML = objDetalleValeCajasValesCaja.strParqueVehicular;
					selectedRow[29].innerHTML = objDetalleValeCajasValesCaja.dteFecha;
					selectedRow[30].innerHTML = objDetalleValeCajasValesCaja.dteFechaFormat;
				}
				else
				{
					//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
					intRenglon = $("#dg_detalles_cajas_vales_caja tr").length - 2;
					//Incrementar 1 para el siguiente renglón
					intRenglon++;
					//Variable que se utiliza para asignar el id del objeto (input) tipo file
				    strIDCampoArchivo = 'archivo_varios_detalles_cajas_vales_caja_'
				    //Variable que se utiliza para asignar el id del área (spam) del objeto (input) tipo file
			        strIDCampoArea = 'archivos_area_detalles_cajas_vales_caja_';

			        //Agregar renglón de la fila
					strIDCampoArchivo += intRenglon;
					strIDCampoArea += intRenglon;

					//Asignar valores (del archivo) al objeto
					objDetalleValeCajasValesCaja.strArchivoExistente = '';
					objDetalleValeCajasValesCaja.strIDCampoArchivo = strIDCampoArchivo;
					objDetalleValeCajasValesCaja.intRenglonAnterior = 0;
					objDetalleValeCajasValesCaja.strTipoRenglon =  'Nuevo'; 
					objDetalleValeCajasValesCaja.strIDCampoArea =  strIDCampoArea;
					//Agregar datos del detalle del vale de caja
           			objDetallesValeCajasValesCaja.setDetalle(objDetalleValeCajasValesCaja);

           			//Variable que se utiliza para asignar el tipo de renglón
					var strTipoRenglon = '"Nuevo"';


					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaTipo = objRenglon.insertCell(0);
					var objCeldaFactura = objRenglon.insertCell(1);
					var objCeldaGastoTipo = objRenglon.insertCell(2);
					var objCeldaConcepto = objRenglon.insertCell(3);					
					var objCeldaSubtotal = objRenglon.insertCell(4);
					var objCeldaIva = objRenglon.insertCell(5);
					var objCeldaIeps = objRenglon.insertCell(6);
					var objCeldaTotal = objRenglon.insertCell(7);
					var objCeldaAcciones = objRenglon.insertCell(8);
					//Columnas ocultas
					var objCeldaPorcentajeIva = objRenglon.insertCell(9);
					var objCeldaPorcentajeIeps = objRenglon.insertCell(10);
					var objCeldaTasaCuotaIva = objRenglon.insertCell(11);
					var objCeldaTasaCuotaIeps = objRenglon.insertCell(12);
					var objCeldaProveedorID = objRenglon.insertCell(13);
					var objCeldaProveedor = objRenglon.insertCell(14);
					var objCeldaArchivoExistente = objRenglon.insertCell(15);
					var objCeldaIDCampoArchivo = objRenglon.insertCell(16);
					//Columna que se utiliza para asignar el renglon de un detalle existente de esta manera 
					//se renombrara la carpeta que contiene los archivos
					var objCeldaRenglonAnterior = objRenglon.insertCell(17);
					var objCeldaTipoRenglon = objRenglon.insertCell(18);
					var objCeldaTipoOrdenCompra = objRenglon.insertCell(19);
					var objCeldaOrdenCompraID = objRenglon.insertCell(20);
					var objCeldaOrdenCompra = objRenglon.insertCell(21);
					var objCeldaTipoGasto = objRenglon.insertCell(22);
					var objCeldaSucursalID = objRenglon.insertCell(23);
					var objCeldaModuloID = objRenglon.insertCell(24);
					var objCeldaGastoTipoID = objRenglon.insertCell(25);
					var objCeldaVehiculoID = objRenglon.insertCell(26);
					var objCeldaVehiculo = objRenglon.insertCell(27);
					var objCeldaParqueVehicular = objRenglon.insertCell(28);
					var objCeldaFecha = objRenglon.insertCell(29);
					var objCeldaFechaFormat = objRenglon.insertCell(30);
					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRenglon);
					objCeldaTipo.setAttribute('class', 'movil b1');
					objCeldaTipo.innerHTML = objDetalleValeCajasValesCaja.strTipo;
					objCeldaFactura.setAttribute('class', 'movil b2');
					objCeldaFactura.innerHTML = objDetalleValeCajasValesCaja.strFactura;
					objCeldaGastoTipo.setAttribute('class', 'movil b3');
					objCeldaGastoTipo.innerHTML = objDetalleValeCajasValesCaja.strGastoTipo;
					objCeldaConcepto.setAttribute('class', 'movil b4');
					objCeldaConcepto.innerHTML = objDetalleValeCajasValesCaja.strConcepto;;
					objCeldaSubtotal.setAttribute('class', 'movil b5');
					objCeldaSubtotal.innerHTML = intSubtotal;
					objCeldaIva.setAttribute('class', 'movil b6');
					objCeldaIva.innerHTML = intImporteIva;
					objCeldaIeps.setAttribute('class', 'movil b7');
					objCeldaIeps.innerHTML = intImporteIeps;
					objCeldaTotal.setAttribute('class', 'movil b8');
					objCeldaTotal.innerHTML = intTotal;
					objCeldaAcciones.setAttribute('class', 'td-center movil b9');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_cajas_vales_caja(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<span   class='fileupload-buttonbar'>"+
												 "<span class='btn  btn-default btn-xs fileinput-button '>"+
												 "<span class='fa fa-upload'></span>"+
												"<span id='"+strIDCampoArea+"'>"+
												"<input name='"+strIDCampoArchivo+"[]' id='"+strIDCampoArchivo+"'"+
												 "type='file' multiple accept='text/xml,application/pdf'"+
												 "onchange='verificar_extension_archivos_cajas_vales_caja(this);'>"+
												"</input></span></span></span>"+
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='verificar_renglon_eliminar_detalles_cajas_vales_caja(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIva.innerHTML = objDetalleValeCajasValesCaja.intPorcentajeIva; 
					objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIeps.innerHTML = objDetalleValeCajasValesCaja.intPorcentajeIeps;
					objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIva.innerHTML = objDetalleValeCajasValesCaja.intTasaCuotaIva;
					objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIeps.innerHTML =  objDetalleValeCajasValesCaja.intTasaCuotaIeps;
					objCeldaProveedorID.setAttribute('class', 'no-mostrar');
					objCeldaProveedorID.innerHTML =  objDetalleValeCajasValesCaja.intProveedorID;
					objCeldaProveedor.setAttribute('class', 'no-mostrar');
					objCeldaProveedor.innerHTML =  objDetalleValeCajasValesCaja.strProveedor;
					objCeldaArchivoExistente.setAttribute('class', 'no-mostrar');
					objCeldaArchivoExistente.innerHTML = objDetalleValeCajasValesCaja.strArchivoExistente;
					objCeldaIDCampoArchivo.setAttribute('class', 'no-mostrar');
					objCeldaIDCampoArchivo.innerHTML = objDetalleValeCajasValesCaja.strIDCampoArchivo; 
					objCeldaRenglonAnterior.setAttribute('class', 'no-mostrar');
					objCeldaRenglonAnterior.innerHTML = objDetalleValeCajasValesCaja.intRenglonAnterior; 
					objCeldaTipoRenglon.setAttribute('class', 'no-mostrar');
					objCeldaTipoRenglon.innerHTML = objDetalleValeCajasValesCaja.strTipoRenglon; 
					objCeldaTipoOrdenCompra.setAttribute('class', 'no-mostrar');
					objCeldaTipoOrdenCompra.innerHTML = objDetalleValeCajasValesCaja.strTipoOrdenCompra; 
					objCeldaOrdenCompraID.setAttribute('class', 'no-mostrar');
					objCeldaOrdenCompraID.innerHTML = objDetalleValeCajasValesCaja.intOrdenCompraID; 
					objCeldaOrdenCompra.setAttribute('class', 'no-mostrar');
					objCeldaOrdenCompra.innerHTML = objDetalleValeCajasValesCaja.strOrdenCompra;
					objCeldaTipoGasto.setAttribute('class', 'no-mostrar');
					objCeldaTipoGasto.innerHTML = objDetalleValeCajasValesCaja.strTipoGasto;
					objCeldaSucursalID.setAttribute('class', 'no-mostrar');
					objCeldaSucursalID.innerHTML = objDetalleValeCajasValesCaja.intSucursalID;
					objCeldaModuloID.setAttribute('class', 'no-mostrar');
					objCeldaModuloID.innerHTML = objDetalleValeCajasValesCaja.intModuloID;
					objCeldaGastoTipoID.setAttribute('class', 'no-mostrar');
					objCeldaGastoTipoID.innerHTML = objDetalleValeCajasValesCaja.intGastoTipoID;
					objCeldaVehiculoID.setAttribute('class', 'no-mostrar');
					objCeldaVehiculoID.innerHTML = objDetalleValeCajasValesCaja.intVehiculoID;
					objCeldaVehiculo.setAttribute('class', 'no-mostrar');
					objCeldaVehiculo.innerHTML = objDetalleValeCajasValesCaja.strVehiculo;
					objCeldaParqueVehicular.setAttribute('class', 'no-mostrar');
					objCeldaParqueVehicular.innerHTML = objDetalleValeCajasValesCaja.strParqueVehicular;
					objCeldaFecha.setAttribute('class', 'no-mostrar');
					objCeldaFecha.innerHTML = objDetalleValeCajasValesCaja.dteFecha;
					objCeldaFechaFormat.setAttribute('class', 'no-mostrar');
					objCeldaFechaFormat.innerHTML = objDetalleValeCajasValesCaja.dteFechaFormat;

				}

				//Clonar contenido del campo file (archivos seleccionados del comprobante)
			    var clone = $('#archivo_varios_detalles_cajas_vales_caja').clone();
		   		clone.attr('id', strIDCampoArchivo);
			    $('#'+strIDCampoArea).html(clone);
			    //Limpia ruta del archivo cargado
		        $('#archivo_varios_detalles_cajas_vales_caja').val('');
		       
				//Hacer un llamado a la función para calcular importe total de la tabla
				calcular_totales_detalles_cajas_vales_caja();
				//Enfocar combobox
				$('#cmbTipo_detalles_cajas_vales_caja').focus();
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_cajas_vales_caja tr").length - 2;
			$('#numElementos_detalles_cajas_vales_caja').html(intFilas);
		}


		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_cajas_vales_caja(objRenglon)
		{
			//Variable que se utiliza para asignar el indice del renglón
			var intRenglon = parseInt(objRenglon.parentNode.parentNode.rowIndex);
			//Seleccionar el renglón de la tabla para recuperar el nombre del archivo y el tipo de renglón
			var selectedRow = document.getElementById("dg_detalles_cajas_vales_caja").rows[intRenglon].cells;
		    //Decrementar indice para obtener la posición del detalle en el arreglo
		    intRenglon -=  1;
		    //Crear instancia del objeto Detalle del vale de caja
        	objDetalleValeCajasValesCaja = new DetalleValeCajasValesCaja();
        	//Asignar datos del detalle corespondiente al indice
        	objDetalleValeCajasValesCaja = objDetallesValeCajasValesCaja.getDetalle(intRenglon);
        	//Variables que se utiliza para asignar el id del objeto (input) tipo file
        	var strIDCampoArchivo = objDetalleValeCajasValesCaja.strIDCampoArchivo;
        	var strNombreArchivo = selectedRow[15].innerHTML;
        	var strTipoRenglon = selectedRow[18].innerHTML;

        	//Variable que se utiliza para asignar el id de la sucursal
			var intSucursalID = objDetalleValeCajasValesCaja.intSucursalID;
			//Variable que se utiliza para asignar el id del módulo
			var intModuloID = objDetalleValeCajasValesCaja.intModuloID;
			//Variable que se utiliza para asignar el id del tipo de gasto
			var intGastoTipoID = objDetalleValeCajasValesCaja.intGastoTipoID;

        	//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalles_cajas_vales_caja').val(intRenglon);
			$('#cmbTipo_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.strTipo);
			$('#txtFecha_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.dteFechaFormat);
			$('#txtTipoOrdenCompra_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.strTipoOrdenCompra);
			$('#txtOrdenCompraID_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.intOrdenCompraID);
			$('#txtOrdenCompra_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.strOrdenCompra);
			$('#txtProveedorID_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.intProveedorID);
			$('#txtProveedor_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.strProveedor);
			$('#txtFactura_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.strFactura);
			$('#txtConcepto_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.strConcepto);
			$('#txtSubtotal_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.intSubtotal);
			//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
		    $('#txtSubtotal_detalles_cajas_vales_caja').formatCurrency({ roundToDecimalPlace: intNumDecimalesPrecioUnitBDCajasValesCaja });
		    $('#txtTasaCuotaIva_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.intTasaCuotaIva);
		    $('#txtTasaCuotaIeps_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.intTasaCuotaIeps);
		    $('#txtPorcentajeIva_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.intPorcentajeIva);
		    $('#txtPorcentajeIeps_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.intPorcentajeIeps);
		    $('#txtIvaOrdenCompra_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.intIva);
			$('#txtIepsOrdenCompra_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.intIeps);
			$('#txtTotalOrdenCompra_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.intTotal);
			$('#txtArchivoExistente_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.strArchivoExistente);
			$('#txtIDCampoArchivo_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.strIDCampoArchivo);
			$('#txtRenglonAnterior_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.intRenglonAnterior);
			$('#txtTipoRenglon_detalles_cajas_vales_caja').val(strTipoRenglon);
			$('#txtIDCampoArea_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.strIDCampoArea);
			
			//Hacer un llamado a la función para inicializar elementos del tipo de gasto	        	
	      	inicializar_tipo_gasto_detalles_cajas_vales_caja();

	      	//Si no existe id de la orden de compra
			if($('#txtOrdenCompraID_detalles_cajas_vales_caja').val()  == '')
			{
				//Asignar datos del gasto y parque vehicular
		      	$('#txtVehiculoID_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.intVehiculoID);
				$('#txtVehiculo_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.strVehiculo);
				$('#cmbParqueVehicular_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.strParqueVehicular);
		      	//Asignar el tipo de gasto
		        $('#cmbTipoGasto_detalles_cajas_vales_caja').val(objDetalleValeCajasValesCaja.strTipoGasto);
		        //Hacer un llamado a la función para cargar gastos en el combobox
				cargar_gastos_detalles_cajas_vales_caja(intGastoTipoID);

		        //Hacer un llamado a la función para mostrar u ocultar vehículo
		        mostrar_vehiculo_detalles_cajas_vales_caja();
		        
		        //Hacer un llamado a la función para mostrar u ocultar módulo
		        mostrar_cmb_detalles_cajas_vales_caja(intSucursalID, intModuloID);
		    }


			//Clonar contenido del campo file (archivos seleccionados del comprobante)
		    var clone = $('#'+strIDCampoArchivo).clone();
	   		clone.attr('id', 'archivo_varios_detalles_cajas_vales_caja');
		    $('#archivos_area_detalles_cajas_vales_caja').html(clone);

		    //Si existe archivo del detalle
		    if(strNombreArchivo != '' && strTipoRenglon == 'Existente')
		    {
		    	//Mostrar los siguientes botones
		    	$('#btnDescargarArchivo_detalles_cajas_vales_caja').show();
		    	$('#btnEliminarArchivo_detalles_cajas_vales_caja').show();
		    }
		    else
		    {
		    	//Ocultar los siguientes botones
		    	$('#btnDescargarArchivo_detalles_cajas_vales_caja').hide();
		    	$('#btnEliminarArchivo_detalles_cajas_vales_caja').hide();
		    }

		    //Enfocar combobox
			$('#cmbTipo_detalles_cajas_vales_caja').focus();
		}

	
		//Función para verificar si el renglón contiene archivos antes de eliminarlo de la tabla
		function verificar_renglon_eliminar_detalles_cajas_vales_caja(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			//Variables que se utilizan para asignar valores del detalle
			var strNombreArchivo = objRenglon.parentNode.parentNode.cells[15].innerHTML;
			var intRenglonAnterior = objRenglon.parentNode.parentNode.cells[17].innerHTML;
			var strTipoRenglon = objRenglon.parentNode.parentNode.cells[18].innerHTML;

			//Si existe archivo del detalle
			if(strNombreArchivo != '')
			{
				//Preguntar al usuario si desea eliminar los archivos del registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea eliminar los archivos del registro?</strong>',
				             {'type':     'question',
				              'title':    'Vales de Caja Chica',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                            	//Hacer un llamado a la función para quitar el renglón de la tabla
												eliminar_renglon_detalles_cajas_vales_caja(intRenglon);
				                              	//Hacer un llamado a la función para eliminar carpeta que contiene los archivos del registro
												eliminar_archivo_detalles_cajas_vales_caja(intRenglonAnterior, strTipoRenglon);
				                            }
				                          }
				              });
				
			}
			else
			{
				//Hacer un llamado a la función para quitar el renglón de la tabla
				eliminar_renglon_detalles_cajas_vales_caja(intRenglon);

			}
		}

	    //Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_cajas_vales_caja(renglon)
		{
			//Eliminar del objeto el detalle seleccionado
			objDetallesValeCajasValesCaja.eliminarDetalle(renglon - 1);

			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_cajas_vales_caja").deleteRow(renglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_cajas_vales_caja();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_cajas_vales_caja tr").length - 2;
			$('#numElementos_detalles_cajas_vales_caja').html(intFilas);
			//Enfocar combobox
			$('#cmbTipo_detalles_cajas_vales_caja').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_cajas_vales_caja()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_cajas_vales_caja').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));
			}

			//Convertir cantidad a formato moneda
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesPrecioUnitBDCajasValesCaja, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, intNumDecimalesIvaUnitBDCajasValesCaja, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, intNumDecimalesIepsUnitBDCajasValesCaja, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, intNumDecimalesMostrarCajasValesCaja, '');

			//Asignar los valores
			$('#acumSubtotal_detalles_cajas_vales_caja').html(intAcumSubtotal);
			$('#acumIva_detalles_cajas_vales_caja').html(intAcumIva);
			$('#acumIeps_detalles_cajas_vales_caja').html(intAcumIeps);
			$('#acumTotal_detalles_cajas_vales_caja').html(intAcumTotal);
		}

		//Función para agregar o quitar las acciones (subir y eliminar) del archivo en la columna de acciones  (grid view)
		function agregar_acciones_archivo_detalles_cajas_vales_caja(renglon, tipoAccion)
		{
			//Variable que se utiliza para asignar el tipo de renglón
			var strTipoRenglon = '"Existente"';
			//Variables que se utiliza para asignar el id del objeto (input) tipo file
			var strIDCampoArchivo = 'archivo_varios_detalles_cajas_vales_caja_'+renglon;
			//Variables que se utiliza para asignar el id del área (spam) del objeto (input) tipo file
			var strIDCampoArea = 'archivos_area_detalles_cajas_vales_caja_'+renglon;
			//Variable que se utiliza para asignar las acciones del renglon
			var strAccionesArchivo = '';

			//Si el tipo de acción corresponde a subir_archivo (agregar acciones)
			if(tipoAccion == 'subir_archivo')
			{
				//Descargar archivo(s)
				strAccionesArchivo += "<button class='btn btn-default btn-xs' title='Descargar archivo'" +
										 " onclick='descargar_archivos_detalles_cajas_vales_caja("+renglon+")'>" + 
										 "<span class='glyphicon glyphicon-download-alt'></span></button>";

				//Eliminar archivo(s)
				strAccionesArchivo += "<button class='btn btn-default btn-xs' title='Eliminar archivo'" +
										 " onclick='eliminar_archivo_detalles_cajas_vales_caja("+renglon+","+strTipoRenglon+")'>" + 
										 "<span class='glyphicon glyphicon-export'></span></button>";

				
			}


			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTablaDetalles =  "<button class='btn btn-default btn-xs' title='Editar'" +
											" onclick='editar_renglon_detalles_cajas_vales_caja(this)'>" + 
											"<span class='glyphicon glyphicon-edit'></span></button>" + 
											"<span   class='fileupload-buttonbar'>"+
											"<span class='btn  btn-default btn-xs fileinput-button '>"+
											"<span class='fa fa-upload'></span>"+
											"<span id='"+strIDCampoArea+"'>"+
											"<input name='"+strIDCampoArchivo+"[]' id='"+strIDCampoArchivo+"'"+
											"type='file' multiple accept='text/xml,application/pdf'"+
											"onchange='verificar_extension_archivos_cajas_vales_caja(this);'>"+
											"</input></span></span></span>"+
											strAccionesArchivo+
											"<button class='btn btn-default btn-xs' title='Eliminar'" +
											" onclick='verificar_renglon_eliminar_detalles_cajas_vales_caja(this)'>" + 
											"<span class='glyphicon glyphicon-trash'></span></button>" + 
											"<button class='btn btn-default btn-xs up' title='Subir'>" + 
											"<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											"<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											"<span class='glyphicon glyphicon-arrow-down'></span></button>";


			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_cajas_vales_caja').getElementsByTagName('tbody')[0];
			
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
			    //Variables que se utilizan para asignar valores del detalle
				var intRenglonAnterior = objRen.cells[17].innerHTML;

				//Si se cumple la sentencia
				if(intRenglonAnterior == renglon)
				{

					//Si el tipo de acción corresponde a subir_archivo 
					if(tipoAccion == 'subir_archivo')
					{
						//Modificar nombre de archivo para indicar al usuario que el renglón contiene archivos
						objTabla.rows.namedItem(renglon).cells[15].innerHTML = 'nuevo_archivo';
					}
					else
					{
						//Modificar nombre de archivo para indicar al usuario que el renglón no contiene archivos
						objTabla.rows.namedItem(renglon).cells[15].innerHTML = '';
					}

					//Modificar acciones del registro
					objTabla.rows.namedItem(renglon).cells[8].innerHTML = strAccionesTablaDetalles;
				}

			}

		}


		//Función para buscar orden de compra en la tabla detalles (de esta manera evitamos duplicidad de datos)
		function buscar_orden_compra_tabla_detalles_cajas_vales_caja(ordenCompraID, tipoOrden, tasaCuotaIva, tasaCuotaIeps)
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_cajas_vales_caja').getElementsByTagName('tbody')[0];

			//Variable que se utiliza para agregar orden de compra en la tabla detalles
			var strAgregarOrden = 'SI';

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
			    //Variables que se utilizan para asignar valores del detalle
			    var intTasaCuotaIva = objRen.cells[11].innerHTML;
			    var intTasaCuotaIeps = objRen.cells[12].innerHTML;;
			    var strTipoOrdenCompra = objRen.cells[19].innerHTML;
			    var intOrdenCompraID = objRen.cells[20].innerHTML;		

			    //Si se cumple la sentencia (existe orden de compra en la tabla detalles)
				if(intOrdenCompraID == ordenCompraID && strTipoOrdenCompra == tipoOrden && 
				   intTasaCuotaIva == tasaCuotaIva && intTasaCuotaIeps == tasaCuotaIeps)
				{
   					//Asignar NO para evitar agregar la orden de compra en la tabla detalles
					strAgregarOrden = 'NO';
				}

			}

			//Regresar acción de la orden de compra (esto nos ayudara a enviar mensaje informativo al usuario / a cargar datos de la orden de compra en la tabla detalles)
			return strAgregarOrden;
			
		}

		//Función para guardar los detalles del registro
		function guardar_detalles_cajas_vales_caja()
		{
			
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_cajas_vales_caja').getElementsByTagName('tbody')[0];
			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRenglonesActuales = [];
			var arrRenglonesAnteriores = [];
			//Variable que se utiliza para concatenar la lista con los archivos de los detalles
			var strListaArchivos = '';
			//Variable que se utiliza par asignar el id del renglón del detalle
			var intRenglonID = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				
				//Incrementar renglón por cada detalle recorrido
				intRenglonID++;
				//Asignar id del objeto tipo file
				var strBotonArchivoID = objRen.cells[16].innerHTML;
				//Asignar valor del objeto tipo file
				var fileUpload = $("#"+strBotonArchivoID);
				//Obtenemos un array con los datos de los archivos
				var files = $("#"+strBotonArchivoID)[0].files;

				//Si el el número de archivos seleccionados es mayor que cero
		        if(parseInt(fileUpload.get(0).files.length) > 0)
		        {	
		        	//Concatenar datos y agregarlos a la lista de archivos
		        	strListaArchivos += intRenglonID+'&'+strBotonArchivoID+'|';
	          	}

				//Asignar valores a los arrays
				arrRenglonesActuales.push(intRenglonID);
				arrRenglonesAnteriores.push(objRen.cells[17].innerHTML);
			}

			//Quitar último elemento de la cadena
			strListaArchivos = strListaArchivos.slice(0, -1);

			//Hacer un llamado a la función JSON para guardar los detalles del vale de caja
			var jsonDetalles = JSON.stringify(objDetallesValeCajasValesCaja); 

			//Hacer un llamado al método del controlador para guardar los detalles del registro
			$.post('caja/cajas_vales/guardar_detalles',
					{ 
						intCajaValeID: $('#txtCajaValeID_cajas_vales_caja').val(),
						//Datos de los renglones
						strRenglonesActuales: arrRenglonesActuales.join('|'),
						strRenglonesAnteriores: arrRenglonesAnteriores.join('|'),
						//Datos de los detalles
						arrDetalles: jsonDetalles
					},
					function(data) {
						if (data.resultado)
						{
                 			//Si existen archivos seleccionados
             				if(strListaArchivos != '')
             				{
             					//Hacer un llamado a la función para subir los archivos
	                    		subir_archivos_detalles_cajas_vales_caja(strListaArchivos);
             				}
             				else
             				{
             					//Hacer un llamado a la función para cerrar modal
		                    	cerrar_cajas_vales_caja();
								//Hacer llamado a la función  para cargar  los registros en el grid
		               			paginacion_cajas_vales_caja();  
             				}
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cajas_vales_caja(data.tipo_mensaje, data.mensaje);
					},
			'json');

			
		}


		//Función para subir archivos de los detalles
		function subir_archivos_detalles_cajas_vales_caja(strListaArchivos)
		{
			
			//Separar la cadena para obtener el ID del objeto tipo file
		    var arrListaArchivos = strListaArchivos.split('|');

		    //Variable que se utiliza para asignar el mensaje de error
		    var strMensajeError = '';

		    //Hacer recorrido para subir archivos de los detalles
	        for (var intCont = 0; intCont < arrListaArchivos.length; intCont++) 
	        {
	        	//Asignar datos del archivo del detalle (renglón&ID del objeto tipo file)
	            var strDatos = arrListaArchivos[intCont];
	            var arrDatos = strDatos.split('&');

	            //Crear instancia al objeto del formulario
	       		var formData = new FormData($("#frmCajasValesCaja")[0]);
	            //Agregar campos al objeto del formulario
			    formData.append("intRenglon_detalles_cajas_vales_caja", arrDatos[0]);
			    formData.append("intCajaValeID_detalles_cajas_vales_caja", $("#txtCajaValeID_cajas_vales_caja").val());

	            //Variable que se utiliza para asignar archivos
				var strBotonArchivoIDGrid  = arrDatos[1];
				//Asignar valor del objeto tipo file
				var fileUpload = $("#"+strBotonArchivoIDGrid);
				//Obtenemos un array con los datos de los archivos
				var files = $("#"+strBotonArchivoIDGrid)[0].files;
				//Hacer recorrido para verificar que la extensión de los  archivos seleccionados sea diferente
	        	for (var intContArc = 0; intContArc < parseInt(fileUpload.get(0).files.length); intContArc++)
				{
					//Agregar campo tipo file al objeto del formulario
			    	formData.append("archivo_varios_detalles_cajas_vales_caja[]", document.getElementById(strBotonArchivoIDGrid).files[intContArc]);
				}

			    //Hacer un llamado al método del controlador para subir archivos del registro
	            $.ajax({
	                url: 'caja/cajas_vales/subir_archivos',
	                type: "POST",
	                data: formData,
	                contentType: false,
	                processData: false,
	                success: function(data)
	                {
	                	if (data.resultado)
						{
							//Si existe mensaje de error
							if(data.tipo_mensaje == 'error')
							{
								//Concatenar mensaje
								strMensajeError += ' '+data.mensaje;
							}

		                }
	                   
	                }
            	});
	            
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_cajas_vales_caja('error', strMensajeError);
	        }
	        else
	        {	
	        	//Hacer un llamado a la función para cerrar modal
				cerrar_cajas_vales_caja();
				//Hacer llamado a la función  para cargar  los registros en el grid
       			paginacion_cajas_vales_caja();  
	        }
	       
		}


	  
		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Autorizar Vale de Caja Chica
			*********************************************************************************************************************/
			//Modificar el mensaje cuando cambie la opción del combobox
	        $('#cmbEstatus_autorizar_cajas_vales_caja').change(function(e){   
	        	//Variables que se utilizan para el mensaje informativo
	        	var strEstatus = $('#cmbEstatus_autorizar_cajas_vales_caja').val();
	        	var strMensaje = '';
	        	var strFolio = $('#txtFolio_autorizar_cajas_vales_caja').val();
	        	
	        	//Si existe estatus seleccionado
	        	if(strEstatus != '')
	        	{
	        		strMensaje += 'Se ';
	        		
	        		//Dependiendo del estatus modificar mensaje
	              	if($('#cmbEstatus_autorizar_cajas_vales_caja').val() === 'AUTORIZADO')
	             	{
	             		strMensaje += 'autorizó ';
	             	}
	             	else
	             	{
	             		strMensaje += 'rechazó ';
	             	}

	             	//Agregar folio en el mensaje
	             	strMensaje += ' el vale de caja '+strFolio;
	        	}
	           

             	//Asignar mensaje informativo
             	$('#txtMensaje_autorizar_cajas_vales_caja').val(strMensaje);
				
	        });

			/*******************************************************************************************************************
			Controles correspondientes al modal Vales de Caja Chica
			*********************************************************************************************************************/
			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Información General
        	*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_cajas_vales_caja').datetimepicker({format: 'DD/MM/YYYY'});
			//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtImporte_cajas_vales_caja').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1900 será 1,800.00*/
        	$('.moneda_cajas_vales_caja').blur(function(){
				$('.moneda_cajas_vales_caja').formatCurrency({ roundToDecimalPlace: 2 });
			});

			 /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.moneda_detalles_cajas_vales_caja').blur(function(){
                $('.moneda_detalles_cajas_vales_caja').formatCurrency({ roundToDecimalPlace: intNumDecimalesPrecioUnitBDCajasValesCaja });
            });


			//Mostrar u ocultar div que contiene la cuenta bancaria
	        $('#cmbTipoVale_cajas_vales_caja').change(function(e){   
	            //Dependiendo del tipo de vale mostrar u ocultar cuenta bancaria
              	if($('#cmbTipoVale_cajas_vales_caja').val() === 'TRANSFERENCIA ELECTRONICA')
             	{
					//Quitar clase no-mostrar para mostrar la cuenta bancaria
	   				$('#divCuentaBancaria_cajas_vales_caja').removeClass("no-mostrar");
             	}
             	else
             	{
             		//Agregar clase no-mostrar para ocultar la cuenta bancaria
	   				$('#divCuentaBancaria_cajas_vales_caja').addClass("no-mostrar");
             		//Limpiar contenido de las siguientes cajas de texto
             		$('#txtCuentaBancariaID_cajas_vales_caja').val(''); 
					$('#txtCuentaBancaria_cajas_vales_caja').val(''); 
             	}
	        });

	        //Autocomplete para recuperar los datos de una cuenta bancaria 
	        $('#txtCuentaBancaria_cajas_vales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCuentaBancariaID_cajas_vales_caja').val('');
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
	              $('#txtCuentaBancariaID_cajas_vales_caja').val(ui.item.data);
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
	        $('#txtCuentaBancaria_cajas_vales_caja').focusout(function(e){
	            //Si no existe id de la cuenta bancaria
	            if($('#txtCuentaBancariaID_cajas_vales_caja').val() == '' ||
	               $('#txtCuentaBancaria_cajas_vales_caja').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	               	$('#txtCuentaBancariaID_cajas_vales_caja').val('');
	              	$('#txtCuentaBancaria_cajas_vales_caja').val('');
	            }

	        });

        	//Autocomplete para recuperar los datos de un empleado o proveedor
        	$('#txtReferencia_cajas_vales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtReferenciaID_cajas_vales_caja').val('');
	               $('#txtTipoReferencia_cajas_vales_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "caja/cajas_vales/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'referencias'
	                 },
	                 success: function( data ) {
	                   
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar valores del registro seleccionado
	             $('#txtReferenciaID_cajas_vales_caja').val(ui.item.data);
	             $('#txtTipoReferencia_cajas_vales_caja').val(ui.item.tipo_referencia);
	             //Si el tipo de referencia es EMPLEADO
	             if(ui.item.tipo_referencia == 'EMPLEADO')
	             {
	             	 //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
		             $.post('recursos_humanos/empleados/get_datos',
		                  { 
		                  	strBusqueda:$("#txtReferenciaID_cajas_vales_caja").val(),
				       		strTipo: 'id'
		                  },
		                  function(data) {
		                    if(data.row){
		                       $("#txtSucursalGastoID_cajas_vales_caja").val(data.row.sucursal_id);
		                       $("#txtSucursalGasto_cajas_vales_caja").val(data.row.sucursal);
		                       $("#txtDepartamentoID_cajas_vales_caja").val(data.row.departamento_id);
		                       $("#txtDepartamento_cajas_vales_caja").val(data.row.departamento);
		                    }
		                  }
		                 ,
		                'json');
	             }
	             else
	             {
	             	//Limpiar contenido de las siguientes cajas de texto
	             	$('#txtSucursalGastoID_cajas_vales_caja').val('');
		            $('#txtSucursalGasto_cajas_vales_caja').val('');
		            $('#txtDepartamentoID_cajas_vales_caja').val('');
		            $('#txtDepartamento_cajas_vales_caja').val('');
	             }
	            
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id de la referencia (empleado o proveedor) cuando pierda el enfoque la caja de texto
	        $('#txtReferencia_cajas_vales_caja').focusout(function(e){
	            //Si no existe id de la referencia
	            if($('#txtReferenciaID_cajas_vales_caja').val() == '' ||
	               $('#txtReferencia_cajas_vales_caja').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtReferenciaID_cajas_vales_caja').val('');
	                $('#txtReferencia_cajas_vales_caja').val('');
	                $('#txtTipoReferencia_cajas_vales_caja').val('');
	                $('#txtSucursalGastoID_cajas_vales_caja').val('');
		            $('#txtSucursalGasto_cajas_vales_caja').val('');
		            $('#txtDepartamentoID_cajas_vales_caja').val('');
		            $('#txtDepartamento_cajas_vales_caja').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una sucursal
	        $('#txtSucursalGasto_cajas_vales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSucursalGastoID_cajas_vales_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "administracion/sucursales/autocomplete",
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
	             $('#txtSucursalGastoID_cajas_vales_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la sucursal cuando pierda el enfoque la caja de texto
	        $('#txtSucursalGasto_cajas_vales_caja').focusout(function(e){
	            //Si no existe id de la sucursal
	            if($('#txtSucursalGastoID_cajas_vales_caja').val() == '' ||
	               $('#txtSucursalGasto_cajas_vales_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSucursalGastoID_cajas_vales_caja').val('');
	               $('#txtSucursalGasto_cajas_vales_caja').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un departamento
	        $('#txtDepartamento_cajas_vales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtDepartamentoID_cajas_vales_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/departamentos/autocomplete",
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
	             $('#txtDepartamentoID_cajas_vales_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del departamento cuando pierda el enfoque la caja de texto
	        $('#txtDepartamento_cajas_vales_caja').focusout(function(e){
	            //Si no existe id del departamento
	            if($('#txtDepartamentoID_cajas_vales_caja').val() == '' ||
	               $('#txtDepartamento_cajas_vales_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtDepartamentoID_cajas_vales_caja').val('');
	               $('#txtDepartamento_cajas_vales_caja').val('');
	            }
	            
	        });


	        /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Comprobación
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtSubtotal_detalles_cajas_vales_caja').numeric();
        	$('#txtPorcentajeIva_detalles_cajas_vales_caja').numeric();
        	$('#txtPorcentajeIeps_detalles_cajas_vales_caja').numeric();

        	//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFecha_detalles_cajas_vales_caja').datetimepicker({format: 'DD/MM/YYYY'});

	        //Función para mover renglones arriba y abajo en la tabla
	        $('#dg_detalles_cajas_vales_caja').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Verifica que no sea el último elemento del grid
	            	if( row.next().index() != -1 )
	            	{ 
	            		objDetallesValeCajasValesCaja.swap(row.index(), row.next().index() );
	            	}	

	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Verifica que no sea el primer elemento del grid
	            	if( row.prev().index() != -1 )
	            	{ 
	            		objDetallesValeCajasValesCaja.swap(row.prev().index(), row.index() );
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
	        $('#txtPorcentajeIva_detalles_cajas_vales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_detalles_cajas_vales_caja').val('');
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
	             $('#txtTasaCuotaIva_detalles_cajas_vales_caja').val(ui.item.data);
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
	        $('#txtPorcentajeIva_detalles_cajas_vales_caja').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_detalles_cajas_vales_caja').val() == '' ||
	               $('#txtPorcentajeIva_detalles_cajas_vales_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_detalles_cajas_vales_caja').val('');
	               $('#txtPorcentajeIva_detalles_cajas_vales_caja').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_detalles_cajas_vales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_detalles_cajas_vales_caja').val('');
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
	             $('#txtTasaCuotaIeps_detalles_cajas_vales_caja').val(ui.item.data);
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
	        $('#txtPorcentajeIeps_detalles_cajas_vales_caja').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_detalles_cajas_vales_caja').val() == '' ||
	               $('#txtPorcentajeIeps_detalles_cajas_vales_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_detalles_cajas_vales_caja').val('');
	               $('#txtPorcentajeIeps_detalles_cajas_vales_caja').val('');
	            }
	            
	        });


	        //Autocomplete para recuperar los datos de una orden de compra 
	        $('#txtOrdenCompra_detalles_cajas_vales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtOrdenCompraID_detalles_cajas_vales_caja').val('');
	                //Hacer un llamado a la función para limpiar elementos de la orden de compra
		       	   limpiar_elementos_orden_compra_detalles_cajas_vales_caja('autocomplete');
	               //Hacer un llamado a la función para inicializar elementos de la orden de compra
	               inicializar_orden_compra_detalles_cajas_vales_caja();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/ordenes_compra/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'tasas'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {

	                //Separar datos del valor devuelto en el autocomplete (devuelve un arreglo)
                    var arrDatos = ui.item.value.split(" - ");

                    //Ocultar Div que contiene los campos del gasto y parque vehicular
	       			$('#DivParqueVehicular_detalles_cajas_vales_caja').hide();
	       			//Hacer un llamado a la función para limpiar elementos del tipo de gasto
					limpiar_elementos_tipo_gasto_detalles_cajas_vales_caja();

                    //Asignar valor de la orden de compra seleccionada (autocomplete)
	                var strOrdenCompra = ui.item.value;
                    //Variable que se utiliza para asignar el id de la orden de compra
	                var intOrdenCompraID = ui.item.data;
	                //Variable que se utiliza para asignar la referencia de la orden de compra
	                var strTipoOrdenCompra = arrDatos[1];
	                //Variable que se utiliza para asignar el id de la tasa o cuota del impuesto de IVA
	                var intTasaCuotaIva = ui.item.tasa_cuota_iva;
	                //Variable que se utiliza para asignar el id de la tasa o cuota del impuesto de IEPS
	                var intTasaCuotaIeps = ui.item.tasa_cuota_ieps;

	                //Hacer un llamado a la función para obtener acción de la orden de compra (buscar orden de compra en la tabla detalles, en caso de que exista enviar mensaje informativo al usuario) 
	                var strAgregarOrden  = buscar_orden_compra_tabla_detalles_cajas_vales_caja(intOrdenCompraID, strTipoOrdenCompra, intTasaCuotaIva, intTasaCuotaIeps);
 
	                //Si se cumple la sentencia, significa que la orden de compra no existe en la tabla detalles
	                if(strAgregarOrden == 'SI')
	                {             	
	                   //Asignar folio y tipo de referencia
	                   ui.item.value = arrDatos[0]+' - '+strTipoOrdenCompra;
		               //Asignar valores del registro seleccionado
		               $('#txtOrdenCompraID_detalles_cajas_vales_caja').val(intOrdenCompraID);
		               //Recuperar valores
		               $('#txtTipoOrdenCompra_detalles_cajas_vales_caja').val(strTipoOrdenCompra);
		               $('#txtProveedorID_detalles_cajas_vales_caja').val(ui.item.proveedor_id);
		               $('#txtProveedor_detalles_cajas_vales_caja').val(ui.item.proveedor);
		               $('#txtFactura_detalles_cajas_vales_caja').val(ui.item.factura);
		               $('#txtSubtotal_detalles_cajas_vales_caja').val(ui.item.subtotal);
		               $('#txtTasaCuotaIva_detalles_cajas_vales_caja').val(ui.item.tasa_cuota_iva);
		               $('#txtPorcentajeIva_detalles_cajas_vales_caja').val(ui.item.porcentaje_iva);
		               $('#txtIvaOrdenCompra_detalles_cajas_vales_caja').val(ui.item.iva);
		               $('#txtTasaCuotaIeps_detalles_cajas_vales_caja').val(ui.item.tasa_cuota_ieps);
					   $('#txtPorcentajeIeps_detalles_cajas_vales_caja').val(ui.item.porcentaje_ieps);
					   $('#txtIepsOrdenCompra_detalles_cajas_vales_caja').val(ui.item.ieps);
					   $('#txtTotalOrdenCompra_detalles_cajas_vales_caja').val(ui.item.total);
		               //Hacer un llamado a la función para inicializar elementos de la orden de compra
		               inicializar_orden_compra_detalles_cajas_vales_caja();
	                }
	                else
	                {
	                	//Limpiar contenido del value (autocomplete)
	                	ui.item.value = '';

	                	/*Mensaje que se utiliza para informar al usuario que la orden de compra ya existe en la tabla detalles*/
						var strMensaje = 'La orden de compra: <br>';
						strMensaje +=  '<b>'+strOrdenCompra+'</b> ya existe en la tabla, favor de verificar.';
						//Hacer un llamado a la función para mostrar mensaje de información
					    mensaje_cajas_vales_caja('informacion', strMensaje);
	                }
                   
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
	        $('#txtOrdenCompra_detalles_cajas_vales_caja').focusout(function(e){
	            //Si no existe id de la orden de compra
	            if($('#txtOrdenCompraID_detalles_cajas_vales_caja').val() == '' ||
	               $('#txtOrdenCompra_detalles_cajas_vales_caja').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	               	$('#txtOrdenCompraID_detalles_cajas_vales_caja').val('');
	              	$('#txtOrdenCompra_detalles_cajas_vales_caja').val('');
	              	//Hacer un llamado a la función para limpiar elementos de la orden de compra
		       	    limpiar_elementos_orden_compra_detalles_cajas_vales_caja('autocomplete');
		       	    //Hacer un llamado a la función para inicializar elementos de la orden de compra
	              	inicializar_orden_compra_detalles_cajas_vales_caja();
	              	//Enfocar caja de texto
	              	$('#txtProveedor_detalles_cajas_vales_caja').focus();
	            }

	        });


	        //Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedor_detalles_cajas_vales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorID_detalles_cajas_vales_caja').val('');
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
	              $('#txtProveedorID_detalles_cajas_vales_caja').val(ui.item.data);
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
	        $('#txtProveedor_detalles_cajas_vales_caja').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_detalles_cajas_vales_caja').val() == '' ||
	               $('#txtProveedor_detalles_cajas_vales_caja').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	               	$('#txtProveedorID_detalles_cajas_vales_caja').val('');
	              	$('#txtProveedor_detalles_cajas_vales_caja').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un vehículo 
	        $('#txtVehiculo_detalles_cajas_vales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoID_detalles_cajas_vales_caja').val('');
	               //Hacer un llamado a la función para inicializar elementos del vehículo
	               inicializar_vehiculo_detalles_cajas_vales_caja();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/vehiculos/autocomplete",
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
	              $('#txtVehiculoID_detalles_cajas_vales_caja').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos del vehículo
	           	  get_datos_vehiculo_detalles_cajas_vales_caja();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del vehículo cuando pierda el enfoque la caja de texto
	        $('#txtVehiculo_detalles_cajas_vales_caja').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoID_detalles_cajas_vales_caja').val() == '' ||
	               $('#txtVehiculo_detalles_cajas_vales_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVehiculoID_detalles_cajas_vales_caja').val('');
	               $('#txtVehiculo_detalles_cajas_vales_caja').val('');
	               //Hacer un llamado a la función para inicializar elementos del vehículo
	               inicializar_vehiculo_detalles_cajas_vales_caja();
	            }

	        });

	        //Habilitar o deshabilitar factura cuando cambie la opción del combobox
	        $('#cmbTipo_detalles_cajas_vales_caja').change(function(){
	       		//Hacer un llamado a la función para inicializar elementos del tipo de gasto	        	
	        	inicializar_tipo_gasto_detalles_cajas_vales_caja();

	        	//Si existe tipo de gasto
		        if($('#cmbTipo_detalles_cajas_vales_caja').val() !== '')
		        {
		        	 //Enfocar caja de texto
					 $('#txtFecha_detalles_cajas_vales_caja').focus();
		        }

	        });


	        //Mostrar u ocultar div que contiene los campos del vehículo cuando se modifique la selección del combo
			$('#cmbParqueVehicular_detalles_cajas_vales_caja').change(function(e){

				//Si no existe parque vehicular
				if($('#cmbParqueVehicular_detalles_cajas_vales_caja').val() == '')
				{
					//Limpiar contenido del combobox
					$('#cmbGastoTipoID_detalles_cajas_vales_caja').empty();
				}
				else
				{
					//Si existe tipo de gasto
					if($('#cmbTipoGasto_detalles_cajas_vales_caja').val() != '')
					{

						//Hacer un llamado a la función para cargar gastos en el combobox
						cargar_gastos_detalles_cajas_vales_caja();

					}

				}


				//Hacer un llamado a la función para mostrar u ocultar vehículo
	       	    mostrar_vehiculo_detalles_cajas_vales_caja();

			});


			//Cargar tipos de gastos cuando se modifique la selección del combo
			$('#cmbTipoGasto_detalles_cajas_vales_caja').change(function(e){
				
				//Asignar el texto del combobox
				var strTipo = $('select[name="strTipoGasto_detalles_cajas_vales_caja"] option:selected').text();

				//Si no existe tipo de gasto
				if($('#cmbTipoGasto_detalles_cajas_vales_caja').val() == '')
				{
					//Limpiar contenido de los siguientes combobox
					$('#cmbSucursalID_detalles_cajas_vales_caja').val('');
					$('#cmbModuloID_detalles_cajas_vales_caja').val('');
					$('#cmbGastoTipoID_detalles_cajas_vales_caja').empty();

				}
				else
				{

					//Limpiar contenido de los siguientes combobox
					$('#cmbSucursalID_detalles_cajas_vales_caja').val('');
					$('#cmbModuloID_detalles_cajas_vales_caja').val('');
					//Hacer un llamado a la función para cargar gastos en el combobox
					cargar_gastos_detalles_cajas_vales_caja();

					//Si el tipo de gasto  corresponde a la cuenta 602 o 603
            		if(strTipo == strCuenta602CajasValesCaja || strTipo == strCuenta603CajasValesCaja)
            		{
            			//Enfocar combobox
				    	$('#cmbSucursalID_detalles_cajas_vales_caja').focus();
            		}
            		else
            		{
            			//Enfocar combobox
				    	$('#cmbGastoTipoID_detalles_cajas_vales_caja').focus();
            		}

				}


		       //Hacer un llamado a la función para mostrar u ocultar sucursal y/o módulo
	           mostrar_cmb_detalles_cajas_vales_caja();
				
				
			});

			//Enfocar módulo ó tipo de gasto cuando se modifique la selección del combo
			$('#cmbSucursalID_detalles_cajas_vales_caja').change(function(e){
				
				//Asignar el texto del combobox
				var strTipo = $('select[name="strTipoGasto_detalles_cajas_vales_caja"] option:selected').text();

				//Si el tipo de gasto  corresponde a la cuenta 602
	            if(strTipo == strCuenta602CajasValesCaja)
		        {
					//Enfocar comobox
					$('#cmbModuloID_detalles_cajas_vales_caja').focus();
				}
				else
				{
					//Enfocar comobox
					$('#cmbGastoTipoID_detalles_cajas_vales_caja').focus();

				}
				
			
			});

			//Enfocar tipo de gasto cuando se modifique la selección del combo
			$('#cmbModuloID_detalles_cajas_vales_caja').change(function(e){
				
				//Enfocar comobox
				$('#cmbGastoTipoID_detalles_cajas_vales_caja').focus();
			});

			
			//Enfocar concepto cuando se modifique la selección del combo
			$('#cmbGastoTipoID_detalles_cajas_vales_caja').change(function(e){
				//Si no existe id del tipo de gasto
				if($('#cmbGastoTipoID_detalles_cajas_vales_caja').val() == '')
				{
					//Enfocar comobox
					$('#cmbGastoTipoID_detalles_cajas_vales_caja').focus();
				}
				else
				{
					//Si existe el id de la orden de compra
		   	    	if($('#txtOrdenCompraID_detalles_cajas_vales_caja').val() != '')
		   	    	{
		   	    		//Hacer un llamado a la función para agregar renglón a la tabla
	   	    			agregar_renglon_detalles_cajas_vales_caja();
		   	    	}
		   	    	else
		   	    	{
		   	    		
		   	    		//Enfocar caja de texto
				    	$('#txtFactura_detalles_cajas_vales_caja').focus();
		   	    	}
					
				}


			});


			//Validar que exista fecha cuando se pulse la tecla enter 
			$('#txtFecha_detalles_cajas_vales_caja').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe fecha
		            if( $('#txtFecha_detalles_cajas_vales_caja').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtFecha_detalles_cajas_vales_caja').focus();
			   	    }
			   	    else
			   	    {

						//Enfocar caja de texto
						$('#txtConcepto_detalles_cajas_vales_caja').focus();
			   	   	  	
			   	    }
		        }
		    });

		    //Validar que exista concepto cuando se pulse la tecla enter 
			$('#txtConcepto_detalles_cajas_vales_caja').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe concepto
		            if( $('#txtConcepto_detalles_cajas_vales_caja').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtConcepto_detalles_cajas_vales_caja').focus();
			   	    }
			   	    else
			   	    {

			   	    	//Dependiendo del tipo de gasto habilitar o deshabilitar factura
		              	if($('#cmbTipo_detalles_cajas_vales_caja').val() === 'FISCAL')
		             	{
		             		//Enfocar caja de texto
						    $('#txtOrdenCompra_detalles_cajas_vales_caja').focus();
						}
						else
						{
						 	//Enfocar caja de texto
						    $('#txtSubtotal_detalles_cajas_vales_caja').focus();
						}
			   	   	  	
			   	    }
		        }
		    });


		    //Validar que exista id de la orden de compra cuando se pulse la tecla enter 
			$('#txtOrdenCompra_detalles_cajas_vales_caja').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si existe id de la orden de compra
		            if($('#txtOrdenCompraID_detalles_cajas_vales_caja').val() != '')
			   	    {
		   	    		//Enfocar caja de texto
					    $('#txtFactura_detalles_cajas_vales_caja').focus();
			   	    }
			   	    else
			   	    {

					 	//Enfocar caja de texto
					    $('#txtProveedor_detalles_cajas_vales_caja').focus();
			   	   	  	
			   	    }
		        }
		    });


			//Verificar que exista id del proveedor cuando se pulse la tecla enter 
	        $('#txtProveedor_detalles_cajas_vales_caja').on('keypress', function (e) {
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_detalles_cajas_vales_caja').val() == '' ||
	               $('#txtProveedor_detalles_cajas_vales_caja').val() == '')
	            { 
	                //Enfocar caja de texto
					$('#txtProveedor_detalles_cajas_vales_caja').focus();
	            }
	            else
	            {
	            	
	            	//Enfocar combobox
					$('#cmbParqueVehicular_detalles_cajas_vales_caja').focus();
	            	
	            }

	        });

	         //Validar que exista parque vehicular cuando se pulse la tecla enter 
			$("#cmbParqueVehicular_detalles_cajas_vales_caja").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe parque vehicular
		            if($('#cmbParqueVehicular_detalles_cajas_vales_caja').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbParqueVehicular_detalles_cajas_vales_caja').focus();
			   	    }
			   	    else
			   	    {	
			   	    	//Si tiene parque vehicular
			   	    	if($('#cmbParqueVehicular_detalles_cajas_vales_caja').val() == 'SI')
			   	    	{
			   	    		//Enfocar caja de texto
					    	$('#txtVehiculo_detalles_cajas_vales_caja').focus();
			   	    	}
			   	    	else
			   	    	{
			   	    		//Enfocar combobox
			   	    		$('#cmbTipoGasto_detalles_cajas_vales_caja').focus();
			   	    	}
			   	    	
			   	    }
		        
		        }  
		    });

		    //Validar que exista vehículo cuando se pulse la tecla enter 
			$('#txtVehiculo_detalles_cajas_vales_caja').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id del vehículo
		         	if($('#txtVehiculoID_detalles_cajas_vales_caja').val() == '' && 
		         	   $('#txtVehiculo_detalles_cajas_vales_caja').val() != '')
		         	{
		         	
		         		//Enfocar caja de texto
					    $('#txtVehiculo_detalles_cajas_vales_caja').focus();
		         	}
		         	else
		         	{
		         		//Enfocar combobox
					    $('#cmbTipoGasto_detalles_cajas_vales_caja').focus();

		         	}
		        }
		    });


	        //Validar que exista tipo de gasto cuando se pulse la tecla enter 
			$("#cmbTipoGasto_detalles_cajas_vales_caja").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Asignar el texto del combobox
					var strTipo = $('select[name="strTipoGasto_detalles_cajas_vales_caja"] option:selected').text();

		        	//Si no existe tipo de gasto
		            if($('#cmbTipoGasto_detalles_cajas_vales_caja').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbTipoGasto_detalles_cajas_vales_caja').focus();
			   	    }
			   	    else
			   	    {

			   	    	//Si el tipo de gasto  corresponde a la cuenta 602 o 603
	            		if(strTipo == strCuenta602CajasValesCaja || strTipo == strCuenta603CajasValesCaja)
	            		{
	            			//Enfocar combobox
					    	$('#cmbSucursalID_detalles_cajas_vales_caja').focus();
	            		}
	            		else
	            		{
	            			//Enfocar combobox
					    	$('#cmbGastoTipoID_detalles_cajas_vales_caja').focus();
	            		}
			   	    
			   	    }
		        
		        }  
		    });


		    //Validar que exista sucursal cuando se pulse la tecla enter 
			$("#cmbSucursalID_detalles_cajas_vales_caja").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe sucursal
		            if($('#cmbSucursalID_detalles_cajas_vales_caja').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbSucursalID_detalles_cajas_vales_caja').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbModuloID_detalles_cajas_vales_caja').focus();
			   	    }
		        
		        }  
		    });


		    //Validar que exista módulo cuando se pulse la tecla enter 
			$("#cmbModuloID_detalles_cajas_vales_caja").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe módulo
		            if($('#cmbModuloID_detalles_cajas_vales_caja').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbModuloID_detalles_cajas_vales_caja').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbGastoTipoID_detalles_cajas_vales_caja').focus();
			   	    }
		        
		        }  
		    });


		    //Validar que exista gasto cuando se pulse la tecla enter 
			$("#cmbGastoTipoID_detalles_cajas_vales_caja").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe id del tipo de gasto
		            if($('#cmbGastoTipoID_detalles_cajas_vales_caja').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbGastoTipoID_detalles_cajas_vales_caja').focus();
			   	    }
			   	    else
			   	    {
			   	    	
			   	    	//Enfocar caja de texto
					    $('#txtFactura_detalles_cajas_vales_caja').focus();
			   	    	
			   	    }
		        
		        }  
		    });


	        //Validar que exista factura cuando se pulse la tecla enter 
			$('#txtFactura_detalles_cajas_vales_caja').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe factura
		            if($('#txtFactura_detalles_cajas_vales_caja').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtFactura_detalles_cajas_vales_caja').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Si existe id de la orden de compra
		            	if($('#txtOrdenCompraID_detalles_cajas_vales_caja').val() != '')
			   	    	{
			   	    		//Hacer un llamado a la función para agregar renglón a la tabla
		   	    			agregar_renglon_detalles_cajas_vales_caja();
			   	    	}
			   	    	else
			   	    	{
			   	    		//Enfocar caja de texto
					   		 $('#txtSubtotal_detalles_cajas_vales_caja').focus();
			   	    	}
			   	   		
			   	    }
		        }
		    });

		    //Validar que exista importe cuando se pulse la tecla enter 
			$('#txtSubtotal_detalles_cajas_vales_caja').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe importe 
		            if($('#txtSubtotal_detalles_cajas_vales_caja').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtSubtotal_detalles_cajas_vales_caja').focus();
			   	    }
			   	    else
			   	    {
					    //Si el tipo de gasto es FISCAL
		              	if($('#cmbTipo_detalles_cajas_vales_caja').val() === 'FISCAL')
		             	{
		             		//Enfocar caja de texto
						    $('#txtPorcentajeIva_detalles_cajas_vales_caja').focus();
						}
						else
						{
						 	//Hacer un llamado a la función para agregar renglón a la tabla
		   	    			agregar_renglon_detalles_cajas_vales_caja();
						}

			   	    }
		        }
		    });

		    //Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_detalles_cajas_vales_caja').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje de IVA
		            if( $('#txtPorcentajeIva_detalles_cajas_vales_caja').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_cajas_vales_caja').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIeps_detalles_cajas_vales_caja').focus();
			   	    }
		        }
		    });

		    //Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_detalles_cajas_vales_caja').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtTasaCuotaIeps_detalles_cajas_vales_caja').val() == '' && 
		         	   $('#txtPorcentajeIeps_detalles_cajas_vales_caja').val() != '')
		         	{
		         	
		         		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_detalles_cajas_vales_caja').focus();
		         	}
		         	else
		         	{
		         		//Hacer un llamado a la función para agregar renglón a la tabla
		   	    	    agregar_renglon_detalles_cajas_vales_caja();
		         	}
		        }
		    });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_cajas_vales_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_cajas_vales_caja').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_cajas_vales_caja').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_cajas_vales_caja').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_cajas_vales_caja').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_cajas_vales_caja').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un empleado o proveedor
	        $('#txtReferenciaBusq_cajas_vales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtReferenciaIDBusq_cajas_vales_caja').val('');
	               $('#txtTipoReferenciaBusq_cajas_vales_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "caja/cajas_vales/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'referencias'
	                 },
	                 success: function( data ) {
	                   
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar valores del registro seleccionado
	             $('#txtReferenciaIDBusq_cajas_vales_caja').val(ui.item.data);
	             $('#txtTipoReferenciaBusq_cajas_vales_caja').val(ui.item.tipo_referencia);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la referencia (empleado o proveedor) cuando pierda el enfoque la caja de texto
	        $('#txtReferenciaBusq_cajas_vales_caja').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtReferenciaIDBusq_cajas_vales_caja').val() == '' ||
	               $('#txtReferenciaBusq_cajas_vales_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtReferenciaIDBusq_cajas_vales_caja').val('');
	               $('#txtReferenciaBusq_cajas_vales_caja').val('');
	               $('#txtTipoReferenciaBusq_cajas_vales_caja').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una sucursal
	        $('#txtSucursalGastoBusq_cajas_vales_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSucursalGastoIDBusq_cajas_vales_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "administracion/sucursales/autocomplete",
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
	             $('#txtSucursalGastoIDBusq_cajas_vales_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la sucursal cuando pierda el enfoque la caja de texto
	        $('#txtSucursalGastoBusq_cajas_vales_caja').focusout(function(e){
	            //Si no existe id de la sucursal
	            if($('#txtSucursalGastoIDBusq_cajas_vales_caja').val() == '' ||
	               $('#txtSucursalGastoBusq_cajas_vales_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSucursalGastoIDBusq_cajas_vales_caja').val('');
	               $('#txtSucursalGastoBusq_cajas_vales_caja').val('');
	            }
	            
	        });

			//Paginación de registros
			$('#pagLinks_cajas_vales_caja').on('click','a',function(event){
				event.preventDefault();
				intPaginaCajasValesCaja = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_cajas_vales_caja();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_cajas_vales_caja').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para verificar que la caja se encuentre abierta
				get_apertura_caja_cajas_vales_caja();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_cajas_vales_caja').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_cajas_vales_caja();	
			//Hacer un llamado a la función para cargar sucursales en el combobox del modal
            cargar_sucursales_detalles_cajas_vales_caja();
            //Hacer un llamado a la función para cargar módulos en el combobox del modal
            cargar_modulos_detalles_cajas_vales_caja();

		});
	</script>