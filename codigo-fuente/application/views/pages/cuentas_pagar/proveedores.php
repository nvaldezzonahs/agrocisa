	<div id="ProveedoresCuentasPagarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">

			<!--Diseño del formulario-->
			<form id="frmBusqueda_proveedores_cuentas_pagar" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_proveedores_cuentas_pagar" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Descripción-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_proveedores_cuentas_pagar">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_proveedores_cuentas_pagar" 
										name="strBusqueda_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_proveedores_cuentas_pagar">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_proveedores_cuentas_pagar" 
								 		name="strEstatusBusq_proveedores_cuentas_pagar" tabindex="1">
								    <option value="TODOS">TODOS</option>
                      				<option value="VALIDACION">VALIDACION</option>
                      				<option value="ACTIVO">ACTIVO</option>
                      				<option value="INACTIVO">INACTIVO</option>
                 				</select>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_proveedores_cuentas_pagar"
									onclick="paginacion_proveedores_cuentas_pagar();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_proveedores_cuentas_pagar" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_proveedores_cuentas_pagar"
									onclick="reporte_proveedores_cuentas_pagar('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_proveedores_cuentas_pagar"
									onclick="reporte_proveedores_cuentas_pagar('XLS');" 
									title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla proveedores
				*/
				td.movil.a1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Nombre comercial"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Tipo"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Contacto"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Domicilio"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla cuentas bancarias
				*/
				td.movil.b1:nth-of-type(1):before {content: "Cuenta"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "CLABE"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Moneda"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Banco"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_proveedores_cuentas_pagar">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Nombre comercial</th>
							<th class="movil">Tipo</th>
							<th class="movil">Contacto</th>
							<th class="movil">Domicilio</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_proveedores_cuentas_pagar" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil a1">{{codigo}}</td>
							<td class="movil a2">{{nombre_comercial}}</td>
							<td class="movil a3">{{tipo_proveedor}}</td>
							<td class="movil a4">{{contacto_nombre}}</td>
							<td class="movil a5">{{domicilio}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_proveedores_cuentas_pagar({{proveedor_id}})"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_proveedores_cuentas_pagar({{proveedor_id}});" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
                            	<!---Autorizar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionAutorizar}}"  
										onclick="abrir_autorizar_proveedores_cuentas_pagar({{proveedor_id}},'{{codigo}}', 'Autorizar');"  title="Autorizar">
									<span class="fa fa-check-square-o"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_proveedores_cuentas_pagar({{proveedor_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_proveedores_cuentas_pagar({{proveedor_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_proveedores_cuentas_pagar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_proveedores_cuentas_pagar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Autorizar Proveedor-->
		<div id="AutorizarProveedoresCuentasPagarBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_autorizar_proveedores_cuentas_pagar" class="ModalBodyTitle confirmacion-modal-title"">
			<h1 id="tituloModal_autorizar_proveedores_cuentas_pagar"></h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAutorizarProveedoresCuentasPagar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmAutorizarProveedoresCuentasPagar"  onsubmit="return(false)" autocomplete="off">
			    	<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReferenciaID_autorizar_proveedores_cuentas_pagar" 
										   name="intReferenciaID_autorizar_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el nuevo estatus del registro --> 
									<input type="hidden" id="txtEstatus_autorizar_proveedores_cuentas_pagar" 
										   name="strEstatus_autorizar_proveedores_cuentas_pagar" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el tipo de acción (guardar o autorizar) a realizar --> 
									<input type="hidden" id="txtTipoAccion_autorizar_proveedores_cuentas_pagar" 
										   name="strTipoAccion_autorizar_proveedores_cuentas_pagar" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Proveedores-->
									<input id="txtModalProveedores_autorizar_proveedores_cuentas_pagar" 
										   name="strModalProveedores_autorizar_proveedores_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para asignar a los usuarios que se les enviará 
									     el mensaje--> 
									<input type="hidden" id="txtUsuarios_autorizar_proveedores_cuentas_pagar" 
										   name="strUsuarios_autorizar_proveedores_cuentas_pagar" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Enviar notificación a:</h4>
										</div>
										<div class="panel-body">
											<div id="treeUsuarios_autorizar_proveedores_cuentas_pagar" class="md-list-item-text"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			    	<div class="row">
				    	<!--Mensaje-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMensaje_autorizar_proveedores_cuentas_pagar">Mensaje</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtMensaje_autorizar_proveedores_cuentas_pagar" 
											   name="strMensaje_autorizar_proveedores_cuentas_pagar" rows="5" value="" tabindex="1" placeholder="Ingrese mensaje" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Autorizar o rechazar registro-->
							<button class="btn btn-success" id="btnGuardar_autorizar_proveedores_cuentas_pagar"  
									onclick="validar_autorizar_proveedores_cuentas_pagar();"  title="Enviar" tabindex="1">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_autorizar_proveedores_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_autorizar_proveedores_cuentas_pagar();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Autorizar Proveedor-->

		<!-- Diseño del modal Proveedores-->
		<div id="ProveedoresCuentasPagarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_proveedores_cuentas_pagar"  class="ModalBodyTitle">
			<h1>Proveedores</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_proveedores_cuentas_pagar" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionproveedores_cuentas_pagar" class="active">
									<a data-toggle="tab" href="#informacion_proveedores_cuentas_pagar">Información General</a>
								</li>
								<!--Tab que contiene los datos crediticios-->
								<li id="tabDatosCrediticios_proveedores_cuentas_pagar">
									<a data-toggle="tab" href="#datos_crediticios_proveedores_cuentas_pagar">Datos Crediticios</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmProveedoresCuentasPagar" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmProveedoresCuentasPagar" onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_proveedores_cuentas_pagar" class="tab-pane fade in active">
							<div class="row">
								<!--Código-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtProveedorID_proveedores_cuentas_pagar" 
												   name="intProveedorID_proveedores_cuentas_pagar" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
											<input id="txtEstatus_proveedores_cuentas_pagar" 
												   name="strEstatus_proveedores_cuentas_pagar" type="hidden" value="">
											</input>
											<label for="txtCodigo_proveedores_cuentas_pagar">Código</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigo_proveedores_cuentas_pagar" 
													name="strCodigo_proveedores_cuentas_pagar" type="text" value="" 
													placeholder="Autogenerado" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Razón social-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRazonSocial_proveedores_cuentas_pagar">Razón social</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRazonSocial_proveedores_cuentas_pagar" 
													name="strRazonSocial_proveedores_cuentas_pagar" type="text" value="" 
													tabindex="1" placeholder="Ingrese razón social" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--RFC-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el rfc anterior, en caso de que exista otro registro con el mismo rfc se le preguntara al usuario si desea realizar el nuevo registro-->
											<input id="txtRfcAnterior_proveedores_cuentas_pagar" 
												   name="strRfcAnterior_proveedores_cuentas_pagar" type="hidden" value="">
											</input>
											<label for="txtRfc_proveedores_cuentas_pagar">RFC</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRfc_proveedores_cuentas_pagar" 
													name="strRfc_proveedores_cuentas_pagar" type="text" value="" 
													tabindex="1" placeholder="Ingrese RFC" maxlength="13">
											</input>
										</div>
									</div>
								</div>
								<!--Nombre comercial-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNombreComercial_proveedores_cuentas_pagar">Nombre comercial</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNombreComercial_proveedores_cuentas_pagar" 
													name="strNombreComercial_proveedores_cuentas_pagar" type="text" value="" 
													tabindex="1" placeholder="Ingrese nombre comercial" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Autocomplete que contiene los regímenes fiscales activos-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRegimenFiscal_proveedores_cuentas_pagar">Régimen fiscal</label>
										</div>
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del régimen fiscal seleccionado-->
											<input id="txtRegimenFiscalID_proveedores_cuentas_pagar" 
												   name="intRegimenFiscalID_proveedores_cuentas_pagar"  
												   type="hidden" value="">
										    </input>
											<input  class="form-control" id="txtRegimenFiscal_proveedores_cuentas_pagar" 
													name="strRegimenFiscal_proveedores_cuentas_pagar" type="text" 
													value="" tabindex="1" placeholder="Ingrese régimen fiscal" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
								<!--Tipo de proveedor-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbTipoProveedor_proveedores_cuentas_pagar">Tipo</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbTipoProveedor_proveedores_cuentas_pagar" 
											 		name="strTipoProveedor_proveedores_cuentas_pagar" tabindex="1">
											 	<option value="">Seleccione una opción</option>
		                          				<option value="NACIONAL">NACIONAL</option>
		                          				<option value="EXTRANJERO">EXTRANJERO</option>
		                     				</select>
										</div>
									</div>
		                  		</div>
						    	<!--Teléfono principal-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTelefonoPrincipal_proveedores_cuentas_pagar">Teléfono principal</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTelefonoPrincipal_proveedores_cuentas_pagar" 
													name="strTelefonoPrincipal_proveedores_cuentas_pagar" type="text" value="" 
													tabindex="1" placeholder="Ingrese teléfono" maxlength="10">
											</input>
										</div>
									</div>
								</div>
								<!--Teléfono secundario-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTelefonoSecundario_proveedores_cuentas_pagar">Teléfono secundario</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTelefonoSecundario_proveedores_cuentas_pagar" 
													name="strTelefonoSecundario_proveedores_cuentas_pagar" type="text" value="" 
													tabindex="1" placeholder="Ingrese teléfono" maxlength="10">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Correo electrónico-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCorreoElectronico_proveedores_cuentas_pagar">Correo electrónico</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCorreoElectronico_proveedores_cuentas_pagar" 
													name="strCorreoElectronico_proveedores_cuentas_pagar" type="text" value="" 
													tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Domicilio-->
		                        <h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Domicilio</h4>
		                        <!--Calle-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCalle_proveedores_cuentas_pagar">Calle</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCalle_proveedores_cuentas_pagar" 
													name="strCalle_proveedores_cuentas_pagar" type="text" value="" 
													tabindex="1" placeholder="Ingrese calle" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Número exterior-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNumeroExterior_proveedores_cuentas_pagar">Número exterior</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNumeroExterior_proveedores_cuentas_pagar" 
													name="strNumeroExterior_proveedores_cuentas_pagar" type="text" value="" 
													tabindex="1" placeholder="Ingrese número" maxlength="10">
											</input>
										</div>
									</div>
								</div>
								<!--Número interior-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNumeroInterior_proveedores_cuentas_pagar">Número interior</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNumeroInterior_proveedores_cuentas_pagar" 
													name="strNumeroInterior_proveedores_cuentas_pagar" type="text" value="" 
													tabindex="1" placeholder="Ingrese número" maxlength="10">
											</input>
										</div>
									</div>
								</div>
							    <!--Autocomplete que contiene los códigos postales activos-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del código postal seleccionado-->
											<input id="txtCodigoPostalID_proveedores_cuentas_pagar" 
											       name="intCodigoPostalID_proveedores_cuentas_pagar" type="hidden" value="">
											</input>
											<label for="txtCodigoPostal_proveedores_cuentas_pagar">Código postal</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigoPostal_proveedores_cuentas_pagar" 
													name="strCodigoPostal_proveedores_cuentas_pagar" type="text" value="" 
													tabindex="1" placeholder="Ingrese código postal" maxlength="5">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
								<!--Colonia-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtColonia_proveedores_cuentas_pagar">Colonia</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtColonia_proveedores_cuentas_pagar" 
													name="strColonia_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese colonia" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las localidades activas-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtLocalidad_proveedores_cuentas_pagar">Localidad</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtLocalidad_proveedores_cuentas_pagar" 
													name="strLocalidad_proveedores_cuentas_pagar" type="text" value="" 
													tabindex="1" placeholder="Ingrese localidad" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Referencia-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtReferencia_proveedores_cuentas_pagar">Referencia</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtReferencia_proveedores_cuentas_pagar" 
													name="strReferencia_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese referencia" maxlength="50">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Municipio-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del municipio correspondiente al código postal seleccionado-->
											<input id="txtMunicipioID_proveedores_cuentas_pagar" 
												   name="intMunicipioID_proveedores_cuentas_pagar" type="hidden" value="">
											</input>
											<label for="txtMunicipio_proveedores_cuentas_pagar">Municipio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMunicipio_proveedores_cuentas_pagar" 
													name="strMunicipio_proveedores_cuentas_pagar" type="text"  placeholder="Ingrese localidad" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    	<!--Estado-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtEstado_proveedores_cuentas_pagar">Estado</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtEstado_proveedores_cuentas_pagar" 
													name="strEstado_proveedores_cuentas_pagar" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
						    	<!--País-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPais_proveedores_cuentas_pagar">País</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPais_proveedores_cuentas_pagar" 
													name="strPais_proveedores_cuentas_pagar" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
						    	<!--Datos de contacto-->
		                        <h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Datos de contacto</h4>
		                        <!--Nombre-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoNombre_proveedores_cuentas_pagar">Nombre</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtContactoNombre_proveedores_cuentas_pagar" 
													name="strContactoNombre_proveedores_cuentas_pagar" type="text" value="" 
													tabindex="1" placeholder="Ingrese nombre" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Teléfono de oficina-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoTelefono_proveedores_cuentas_pagar">Teléfono de oficina</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtContactoTelefono_proveedores_cuentas_pagar" 
													name="strContactoTelefono_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese teléfono" maxlength="10">
											</input>
										</div>
									</div>
								</div>
		                    </div>
						    <div class="row">
						    	<!--Extensión-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoExtension_proveedores_cuentas_pagar">Extensión</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtContactoExtension_proveedores_cuentas_pagar" 
													name="strContactoExtension_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese extensión" maxlength="5">
											</input>
										</div>
									</div>
								</div>
								<!--Celular-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoCelular_proveedores_cuentas_pagar">Celular</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtContactoCelular_proveedores_cuentas_pagar" 
													name="strContactoCelular_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese celular" maxlength="10">
											</input>
										</div>
									</div>
								</div>
								<!--Correo electrónico-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoCorreoElectronico_proveedores_cuentas_pagar">Correo electrónico</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtContactoCorreoElectronico_proveedores_cuentas_pagar" 
													name="strContactoCorreoElectronico_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
											</input>
										</div>
									</div>
								</div>
						    </div>
		                </div><!--Cierre del contenido del tab - Información General-->
		                <!--Tab - Datos Crediticios-->
						<div id="datos_crediticios_proveedores_cuentas_pagar" class="tab-pane fade">
							<div class="row">
		                        <!--Días-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtDiasCredito_proveedores_cuentas_pagar">Días</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtDiasCredito_proveedores_cuentas_pagar" 
													name="intDiasCredito_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese días" maxlength="3">
											</input>
										</div>
									</div>
								</div>
								<!--Límite-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtLimiteCredito_proveedores_cuentas_pagar">Límite</label>
										</div>
										<div class="col-md-12">
											<div class='input-group'>
												<span class="input-group-addon">$</span>
												<input  class="form-control moneda_proveedores_cuentas_pagar" id="txtLimiteCredito_proveedores_cuentas_pagar" 
														name="intLimiteCredito_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese límite" maxlength="16">
												</input>
												
											</div>
										</div>
									</div>
								</div>
		                    </div>
		                    <div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
											<input id="txtNumCuentasBancarias_proveedores_cuentas_pagar" 
												   name="intNumCuentasBancarias_proveedores_cuentas_pagar" type="hidden" value="">
											</input>
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">Cuentas bancarias</h4>
												</div>
												<div class="panel-body">
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!--Dar de alta un nuevo registro-->
															<button class="btn btn-info pull-right" id="btnNuevo_cuenta_bancaria_proveedores_cuentas_pagar" 
															onclick="abrir_cuenta_bancaria_proveedores_cuentas_pagar();" 
															title="Nuevo registro" tabindex="1"> 
																<span class="glyphicon glyphicon-list-alt"></span>
															</button>  
														</div>
														<br>
													</div>
													<!--Div que contiene la tabla con las cuentas bancarias encontradas-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row ">
															<!-- Diseño de la tabla-->
															<table class="table-hover movil" id="dg_cuentas_bancarias_proveedores_cuentas_pagar">
																<thead class="movil">
																	<tr class="movil">
																		<th class="movil">Cuenta</th>
																		<th class="movil">CLABE</th>
																		<th class="movil">Moneda</th>
																		<th class="movil">Banco</th>
																		<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
																	</tr>
																</thead>
																<tbody class="movil"></tbody>
															</table>
															<br>
															<div class="row">
																<!--Número de registros encontrados-->
																<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																	<button class="btn btn-default btn-sm disabled pull-right">
																		<strong id="numElementos_cuentas_bancarias_proveedores_cuentas_pagar">0</strong> encontrados
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
					    </div><!--Cierre del contenido del tab - Datos Crediticios-->
					</div><!--Cierre del contenedor de tabs-->
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_proveedores_cuentas_pagar"  
									onclick="validar_proveedores_cuentas_pagar();" title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!---Autorizar registro-->
							<button class="btn btn-default" id="btnAutorizar_proveedores_cuentas_pagar"  
									onclick="abrir_autorizar_proveedores_cuentas_pagar('','','Autorizar');"  title="Autorizar" tabindex="3" disabled>
								<span class="fa fa-check-square-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_proveedores_cuentas_pagar"  
									onclick="cambiar_estatus_proveedores_cuentas_pagar('','ACTIVO');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_proveedores_cuentas_pagar"  
									onclick="cambiar_estatus_proveedores_cuentas_pagar('','INACTIVO');"  title="Restaurar" tabindex="5" disabled>
								<span class="fa fa-exchange"></span>
							</button> 
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_proveedores_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_proveedores_cuentas_pagar();" 
									title="Cerrar"  tabindex="6">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Proveedores-->

		<!-- Diseño del modal Cuentas Bancarias-->
		<div id="CuentasBancariasProveedoresCuentasPagarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_cuenta_bancaria_proveedores_cuentas_pagar" class="ModalBodyTitle">
			<h1>Cuentas Bancarias</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCuentaBancariaProveedoresCuentasPagar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmCuentaBancariaProveedoresCuentasPagar"  onsubmit="return(false)" autocomplete="off">
				    <div class="row">
					    <!--Cuenta-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el renglón del registro seleccionado-->
									<input class="form-control" id="txtRenglon_cuenta_bancaria_proveedores_cuentas_pagar"
										   name="intRenglon_cuenta_bancaria_proveedores_cuentas_pagar" type="hidden">
									<label for="txtCuenta_cuenta_bancaria_proveedores_cuentas_pagar">Cuenta</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCuenta_cuenta_bancaria_proveedores_cuentas_pagar" 
											name="strCuenta_cuenta_bancaria_proveedores_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese cuenta" maxlength="20">
									</input>
								</div>
							</div>
						</div>
						<!--Clabe-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtClabe_cuenta_bancaria_proveedores_cuentas_pagar">CLABE</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtClabe_cuenta_bancaria_proveedores_cuentas_pagar" 
											name="strClabe_cuenta_bancaria_proveedores_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese CLABE" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Combobox que contiene las monedas activas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbMonedaID_cuenta_bancaria_proveedores_cuentas_pagar">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_cuenta_bancaria_proveedores_cuentas_pagar" 
									 		name="intMonedaID_cuenta_bancaria_proveedores_cuentas_pagar" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene los bancos activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del banco seleccionado-->
									<input id="txtBancoID_cuenta_bancaria_proveedores_cuentas_pagar" 
										   name="intBancoID_cuenta_bancaria_proveedores_cuentas_pagar"  
										   type="hidden" value="">
									</input>
									<label for="txtBanco_cuenta_bancaria_proveedores_cuentas_pagar">Banco</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtBanco_cuenta_bancaria_proveedores_cuentas_pagar" 
											name="strBanco_cuenta_bancaria_proveedores_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese banco" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_cuenta_bancaria_proveedores_cuentas_pagar"  
									onclick="validar_cuenta_bancaria_proveedores_cuentas_pagar();"  title="Guardar" tabindex="1">
								<span class="fa fa-floppy-o"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cuenta_bancaria_proveedores_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_cuenta_bancaria_proveedores_cuentas_pagar();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cuentas Bancarias-->
	</div><!--#ProveedoresCuentasPagarContent -->

	
	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_cuenta_bancaria_proveedores_cuentas_pagar" type="text/template">
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
		var intPaginaProveedoresCuentasPagar = 0;
		var strUltimaBusquedaProveedoresCuentasPagar = "";
		//Variable que se utiliza para asignar objeto del modal Proveedores
		var objProveedoresCuentasPagar = null;
		//Variable que se utiliza para asignar objeto del modal Cuentas Bancarias
		var objCuentaBancariaProveedoresCuentasPagar = null;

		/*******************************************************************************************************************
		Funciones del objeto Cuentas bancarias del proveedor
		*********************************************************************************************************************/
		// Constructor del objeto cuentas bancarias
		var objCuentasBancariasProveedoresCuentasPagar;
		function CuentasBancariasProveedoresCuentasPagar(cuentasBancarias)
		{
			this.arrCuentasBancarias = cuentasBancarias;
		}

		//Función para obtener todas las cuentas bancarias del proveedor
		CuentasBancariasProveedoresCuentasPagar.prototype.getCuentasBancarias = function() {
		    return this.arrCuentasBancarias;
		}

		//Función para agregar una cuenta bancaria al objeto 
		CuentasBancariasProveedoresCuentasPagar.prototype.setCuentaBancaria = function (cuentaBancaria){
			this.arrCuentasBancarias.push(cuentaBancaria);
		}

		//Función para obtener una cuenta bancaria del objeto
		CuentasBancariasProveedoresCuentasPagar.prototype.getCuentaBancaria = function(index) {
		    return this.arrCuentasBancarias[index];
		}

		//Función para modificar una cuenta bancaria del objeto
		CuentasBancariasProveedoresCuentasPagar.prototype.modificarCuentaBancaria = function (index, cuentaBancaria){
			this.arrCuentasBancarias[index] = cuentaBancaria;
		}

		//Función para eliminar una cuenta bancaria del objeto
		CuentasBancariasProveedoresCuentasPagar.prototype.eliminarCuentaBancaria = function (index){
			if(index != -1) 
			{
				this.arrCuentasBancarias.splice(index, 1);
			}
		}

		//Función para cambiar las posiciones de las cuentas bancarias en el objeto
		CuentasBancariasProveedoresCuentasPagar.prototype.swap = function(index_A, index_B) {
		    var input = this.arrCuentasBancarias;
		 
		    var temp = input[index_A];
		    input[index_A] = input[index_B];
		    input[index_B] = temp;
		}

		/*******************************************************************************************************************
		Funciones del objeto Cuenta bancaria del proveedor
		*********************************************************************************************************************/
		//Constructor del objeto cuenta bancaria
		var objCuentaBancariaProvProveedoresCuentasPagar;
		function CuentaBancariaProvProveedoresCuentasPagar(bancoID, banco, cuenta, clabe, monedaID)
		{
		    this.intBancoID = bancoID;
		    this.strBanco = banco;
		    this.strCuenta = cuenta;
		    this.strClabe = clabe;
		    this.intMonedaID = monedaID;
		}

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_proveedores_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_pagar/proveedores/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_proveedores_cuentas_pagar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosProveedoresCuentasPagar = data.row;
					//Separar la cadena 
					var arrPermisosProveedoresCuentasPagar = strPermisosProveedoresCuentasPagar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosProveedoresCuentasPagar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosProveedoresCuentasPagar[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_proveedores_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosProveedoresCuentasPagar[i]=='GUARDAR') || (arrPermisosProveedoresCuentasPagar[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_proveedores_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosProveedoresCuentasPagar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_proveedores_cuentas_pagar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_proveedores_cuentas_pagar();
						}
						else if(arrPermisosProveedoresCuentasPagar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_proveedores_cuentas_pagar').removeAttr('disabled');
							$('#btnRestaurar_proveedores_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosProveedoresCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_proveedores_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosProveedoresCuentasPagar[i]=='AUTORIZAR')//Si el indice es AUTORIZAR
						{
							//Habilitar el control (botón autorizar)
							$('#btnAutorizar_proveedores_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosProveedoresCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_proveedores_cuentas_pagar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_proveedores_cuentas_pagar() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaProveedoresCuentasPagar =($('#txtBusqueda_proveedores_cuentas_pagar').val()+$('#cmbEstatusBusq_proveedores_cuentas_pagar').val());

			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaProveedoresCuentasPagar != strUltimaBusquedaProveedoresCuentasPagar)
			{
				intPaginaProveedoresCuentasPagar = 0;
				strUltimaBusquedaProveedoresCuentasPagar = strNuevaBusquedaProveedoresCuentasPagar;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_pagar/proveedores/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_proveedores_cuentas_pagar').val(),
					 	strEstatus: $('#cmbEstatusBusq_proveedores_cuentas_pagar').val(),
						intPagina:intPaginaProveedoresCuentasPagar,
						strPermisosAcceso: $('#txtAcciones_proveedores_cuentas_pagar').val()
					},
					function(data){
						$('#dg_proveedores_cuentas_pagar tbody').empty();
						var tmpProveedoresCuentasPagar = Mustache.render($('#plantilla_proveedores_cuentas_pagar').html(),data);
						$('#dg_proveedores_cuentas_pagar tbody').html(tmpProveedoresCuentasPagar);
						$('#pagLinks_proveedores_cuentas_pagar').html(data.paginacion);
						$('#numElementos_proveedores_cuentas_pagar').html(data.total_rows);
						intPaginaProveedoresCuentasPagar = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_proveedores_cuentas_pagar(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_pagar/proveedores/';

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
									    'strEstatus': $('#cmbEstatusBusq_proveedores_cuentas_pagar').val(),
										'strBusqueda': $('#txtBusqueda_proveedores_cuentas_pagar').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_cuenta_bancaria_proveedores_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_cuenta_bancaria_proveedores_cuentas_pagar').empty();
					var temp = Mustache.render($('#monedas_cuenta_bancaria_proveedores_cuentas_pagar').html(), data);
					$('#cmbMonedaID_cuenta_bancaria_proveedores_cuentas_pagar').html(temp);
				},
				'json');
		}

		/*******************************************************************************************************************
		Funciones del modal Autorizar Proveedor
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_autorizar_proveedores_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmAutorizarProveedoresCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_proveedores_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmAutorizarProveedoresCuentasPagar').find('input[type=hidden]').val('');
		    $('#divEncabezadoModal_autorizar_proveedores_cuentas_pagar').addClass("estatus-VALIDACION");
		}

		//Función que se utiliza para abrir el modal
		function abrir_autorizar_proveedores_cuentas_pagar(id, codigo, tipoAccion)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_autorizar_proveedores_cuentas_pagar();
			
			//Variables que se utilizan para asignar los datos del registro
			var intReferenciaID = 0;
			var strCodigo = '';

			//Si no existe id, significa que se aplicará autorización desde el modal
			if(id == '')
			{
				intReferenciaID = $('#txtProveedorID_proveedores_cuentas_pagar').val();
				strCodigo =  $('#txtCodigo_proveedores_cuentas_pagar').val();
				$('#txtModalProveedores_autorizar_proveedores_cuentas_pagar').val('SI');
			}
			else
			{
				intReferenciaID = id;
				strCodigo = codigo;
				$('#txtModalProveedores_autorizar_proveedores_cuentas_pagar').val('NO');
			}

			//Asignar datos del registro seleccionado
			$('#txtReferenciaID_autorizar_proveedores_cuentas_pagar').val(intReferenciaID);
			$('#txtTipoAccion_autorizar_proveedores_cuentas_pagar').val(tipoAccion);

			//Si el tipo de acción corresponde a Guardar
			if(tipoAccion == 'Guardar')
			{
				//Cambiar título del modal
				$('#tituloModal_autorizar_proveedores_cuentas_pagar').text('Notificar Proveedor');
				$('#txtMensaje_autorizar_proveedores_cuentas_pagar').val('Favor de autorizar al proveedor '+ strCodigo);
				//Cargar el treeview
				get_treeview_usuarios_autorizar_proveedores_cuentas_pagar('');
			}
			else
			{
				//Cambiar título del modal
				$('#tituloModal_autorizar_proveedores_cuentas_pagar').text('Autorizar Proveedor');
				$('#txtMensaje_autorizar_proveedores_cuentas_pagar').val('Se autorizó al proveedor '+ strCodigo);
				//Asignar el nuevo estatus del registro
				$('#txtEstatus_autorizar_proveedores_cuentas_pagar').val('ACTIVO');
				//Cargar el treeview
				get_treeview_usuarios_autorizar_proveedores_cuentas_pagar(intReferenciaID);
			}

			//Abrir modal
			objAutorizarProveedoresCuentasPagar = $('#AutorizarProveedoresCuentasPagarBox').bPopup({
													   appendTo: '#ProveedoresCuentasPagarContent', 
							                           contentContainer: 'ProveedoresCuentasPagarM', 
							                           zIndex: 2, 
							                           modalClose: false, 
							                           modal: true, 
							                           follow: [true,false], 
							                           followEasing : "linear", 
							                           easing: "linear", 
							                           modalColor: ('#F0F0F0')});
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_autorizar_proveedores_cuentas_pagar()
		{
			try {
				//Cerrar modal
				objAutorizarProveedoresCuentasPagar.close();
				//Eliminar datos del treeview
				$("#treeUsuarios_autorizar_proveedores_cuentas_pagar").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_proveedores_cuentas_pagar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_autorizar_proveedores_cuentas_pagar()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosAutorizarProveedoresCuentasPagar = [];

			//Recorremos el treeview
			$("#treeUsuarios_autorizar_proveedores_cuentas_pagar").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosAutorizarProveedoresCuentasPagar.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtUsuarios_autorizar_proveedores_cuentas_pagar").val(arrSeleccionadosAutorizarProveedoresCuentasPagar.join('|'));
			
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_proveedores_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmAutorizarProveedoresCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_autorizar_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un mensaje'}
											}
										},
										strUsuarios_autorizar_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un usuario para este mensaje.'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_autorizar_proveedores_cuentas_pagar = $('#frmAutorizarProveedoresCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_autorizar_proveedores_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_autorizar_proveedores_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para guardar la solicitud de autorización
				guardar_autorizar_proveedores_cuentas_pagar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_autorizar_proveedores_cuentas_pagar()
		{
			try
			{
				$('#frmAutorizarProveedoresCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar la autorización (o el rechazo) de un registro
		function guardar_autorizar_proveedores_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para enviar la autorización de un registro 
			$.post('cuentas_pagar/proveedores/set_enviar_autorizacion',
			     {intProveedorID: $('#txtReferenciaID_autorizar_proveedores_cuentas_pagar').val(),
			      strUsuarios: $('#txtUsuarios_autorizar_proveedores_cuentas_pagar').val(), 
			      strMensaje:  $('#txtMensaje_autorizar_proveedores_cuentas_pagar').val(),
			      strEstatus:  $('#txtEstatus_autorizar_proveedores_cuentas_pagar').val(),
			      strTipoAccion:  $('#txtTipoAccion_autorizar_proveedores_cuentas_pagar').val()
			     },
			     function(data) {
			        if(data.resultado)
			        {
			          	//Hacer llamado a la función  para cargar  los registros en el grid
			          	paginacion_proveedores_cuentas_pagar();
			          	//Hacer un llamado a la función para cerrar modal
					  	cerrar_autorizar_proveedores_cuentas_pagar();

					  	//Si el id de la referencia (para la autorización) se recuperó del modal Proveedores 
					  	if($('#txtModalProveedores_autorizar_proveedores_cuentas_pagar').val() == 'SI')
					  	{
					  		//Hacer un llamado a la función para cerrar modal Proveedores
					 	 	cerrar_proveedores_cuentas_pagar();
					  	}   
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		/*Función que se utiliza para definir tree view de usuarios con acceso a la función Autorizar del proceso
		 *Proveedores (módulo Cuentas por Pagar)*/
		function get_treeview_usuarios_autorizar_proveedores_cuentas_pagar(id)
		{
			$('#treeUsuarios_autorizar_proveedores_cuentas_pagar').fancytree({
				source: {
					url: "seguridad/usuarios/get_treeview/AUTORIZAR_PROVEEDORES/PROVEEDORES/"+id,
					cache: false
				},
				checkbox: true,
				selectMode: 3
			});
		}

		/*******************************************************************************************************************
		Funciones del modal Proveedores
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_proveedores_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmProveedoresCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedores_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmProveedoresCuentasPagar').find('input[type=hidden]').val('');
			//Seleccionar tab que contiene la información general
		  	$('a[href="#informacion_proveedores_cuentas_pagar"]').click();
		  	//Eliminar los datos de la tabla detalles del pago
		    $('#dg_cuentas_bancarias_proveedores_cuentas_pagar tbody').empty();
			$('#numElementos_cuentas_bancarias_proveedores_cuentas_pagar').html(0);
			//Crear instancia del objeto Cuentas bancarias del proveedor
			objCuentasBancariasProveedoresCuentasPagar = new CuentasBancariasProveedoresCuentasPagar([]);
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_proveedores_cuentas_pagar').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_proveedores_cuentas_pagar').removeClass("estatus-VALIDACION");
			$('#divEncabezadoModal_proveedores_cuentas_pagar').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_proveedores_cuentas_pagar').removeClass("estatus-INACTIVO");
			//Asignar NO para indicar que no se ha abierto el modal Autorizar Proveedor
			$('#txtModalProveedores_autorizar_proveedores_cuentas_pagar').val('NO');
			//Habilitar todos los elementos del formulario
			$('#frmProveedoresCuentasPagar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtCodigo_proveedores_cuentas_pagar').attr("disabled", "disabled");			
			$('#txtEstado_proveedores_cuentas_pagar').attr("disabled", "disabled");
			$('#txtPais_proveedores_cuentas_pagar').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_proveedores_cuentas_pagar").show();
			$("#btnNuevo_cuenta_bancaria_proveedores_cuentas_pagar").show(); 
			//Ocultar los siguientes botones
			$("#btnAutorizar_proveedores_cuentas_pagar").hide();
			$("#btnDesactivar_proveedores_cuentas_pagar").hide();
			$("#btnRestaurar_proveedores_cuentas_pagar").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_proveedores_cuentas_pagar()
		{
			try {
				
				//Cerrar modal
				objProveedoresCuentasPagar.close();
				//Si el id de la referencia (para la autorización) se recuperó del modal Proveedores
				if($('#txtModalProveedores_autorizar_proveedores_cuentas_pagar').val() == 'SI')
				{
					//Hacer un llamado a la función para cerrar modal Autorizar Proveedor
					cerrar_autorizar_proveedores_cuentas_pagar();
				}
				//Enfocar caja de texto 
				$('#txtBusqueda_proveedores_cuentas_pagar').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_proveedores_cuentas_pagar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedores_cuentas_pagar();

			//Validación del formulario de campos obligatorios			
			$('#frmProveedoresCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strRazonSocial_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba una razón social'}
											}
										},
										strRfc_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un RFC'}
											}
										},
										strRegimenFiscal_proveedores_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del municipio
					                                    if(value !== '' && $('#txtRegimenFiscalID_proveedores_cuentas_pagar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un régimen fiscal existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strTipoProveedor_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										},
										strTelefonoPrincipal_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un número telefónico'},
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strTelefonoSecundario_proveedores_cuentas_pagar: {
											validators: {
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strCalle_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba una calle'}
											}
										},
										strNumeroExterior_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un número exterior'}
											}
										},
										strCodigoPostal_proveedores_cuentas_pagar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if($('#txtCodigoPostalID_proveedores_cuentas_pagar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un código postal existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strColonia_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba una colonia'}
											}
										},
										strLocalidad_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba una localidad'}
											}
										},
										strMunicipio_proveedores_cuentas_pagar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la localidad
					                                    if($('#txtMunicipioID_proveedores_cuentas_pagar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una municipio existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCorreoElectronico_proveedores_cuentas_pagar: {
				                        	validators: {
				                        	   notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strContactoNombre_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un nombre'}
											}
										},
					                    strContactoTelefono_proveedores_cuentas_pagar: {
											validators: {
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strContactoCelular_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un número telefónico'},
												stringLength: {
													min: 10,
													message: 'El número de celular debe tener 10 caracteres de longitud'
												}
											}
										},
										strContactoCorreoElectronico_proveedores_cuentas_pagar: {
				                        	validators: {
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    }
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_proveedores_cuentas_pagar = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_proveedores_cuentas_pagar = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_proveedores_cuentas_pagar.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_proveedores_cuentas_pagar.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_proveedores_cuentas_pagar = $('#frmProveedoresCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_proveedores_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_proveedores_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para verificar la existencia del RFC
				get_existencia_proveedores_cuentas_pagar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_proveedores_cuentas_pagar()
		{
			try
			{
				$('#frmProveedoresCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para verificar la existencia del RFC antes de guardar o modificar los datos de un registro
		function get_existencia_proveedores_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para verificar existencia del RFC
			$.post('cuentas_pagar/proveedores/get_existencia',
			       {intProveedorID: $('#txtProveedorID_proveedores_cuentas_pagar').val(),
			       	strRfc: $('#txtRfc_proveedores_cuentas_pagar').val(),
			       	strRfcAnterior: $('#txtRfcAnterior_proveedores_cuentas_pagar').val()
			       },
			       function(data) {
			        	//Si hay registros con el mismo RFC
			            if(data.mensaje)
			            {
			            	//Preguntar al usuario si desea guardar un nuevo registro con el RFC
							new $.Zebra_Dialog('<strong>'+data.mensaje+'</strong>',
									             {'type':     'question',
									              'title':    'Proveedores',
									              'buttons':  ['Aceptar', 'Cancelar'],
									              'onClose':  function(caption) {
									                            if(caption == 'Aceptar')
									                            {
									                            	//Hacer un llamado a la función para guardar los datos del registro
									                            	guardar_proveedores_cuentas_pagar();
									                            }
									                          }
									              });
			       	    }
			       	    else
			       	    {	
			       	    	//Hacer un llamado a la función para guardar los datos del registro
			       	    	guardar_proveedores_cuentas_pagar();
			       	    }
			       },
			       'json');

		}

		//Función para guardar o modificar los datos de un registro
		function guardar_proveedores_cuentas_pagar()
		{
			//Hacer un llamado a la función JSON para guardar las cuentas bancarias del proveedor
			var jsonCuentasBancarias = JSON.stringify(objCuentasBancariasProveedoresCuentasPagar); 

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_pagar/proveedores/guardar',
					{ 
						intProveedorID: $('#txtProveedorID_proveedores_cuentas_pagar').val(),
						strCodigo: $('#txtCodigo_proveedores_cuentas_pagar').val(),
						strRazonSocial: $('#txtRazonSocial_proveedores_cuentas_pagar').val(),
						strRfc: $('#txtRfc_proveedores_cuentas_pagar').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_proveedores_cuentas_pagar').val(),
						strNombreComercial: $('#txtNombreComercial_proveedores_cuentas_pagar').val(),
						strTipoProveedor: $('#cmbTipoProveedor_proveedores_cuentas_pagar').val(),
						strTelefonoPrincipal: $('#txtTelefonoPrincipal_proveedores_cuentas_pagar').val(),
						strTelefonoSecundario: $('#txtTelefonoSecundario_proveedores_cuentas_pagar').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_proveedores_cuentas_pagar').val(),
						strCalle: $('#txtCalle_proveedores_cuentas_pagar').val(),
						strNumeroExterior: $('#txtNumeroExterior_proveedores_cuentas_pagar').val(),
						strNumeroInterior: $('#txtNumeroInteriorproveedores_cuentas_pagar').val(),
						strColonia: $('#txtColonia_proveedores_cuentas_pagar').val(),
						strReferencia: $('#txtReferencia_proveedores_cuentas_pagar').val(),
						intCodigoPostalID: $('#txtCodigoPostalID_proveedores_cuentas_pagar').val(),
						strLocalidad: $('#txtLocalidad_proveedores_cuentas_pagar').val(),
						intMunicipioID: $('#txtMunicipioID_proveedores_cuentas_pagar').val(),
						strContactoNombre: $('#txtContactoNombre_proveedores_cuentas_pagar').val(),
						strContactoTelefono: $('#txtContactoTelefono_proveedores_cuentas_pagar').val(),
						strContactoExtension: $('#txtContactoExtension_proveedores_cuentas_pagar').val(),
						strContactoCelular: $('#txtContactoCelular_proveedores_cuentas_pagar').val(),
						strContactoCorreoElectronico: $('#txtContactoCorreoElectronico_proveedores_cuentas_pagar').val(),
						intDiasCredito: $('#txtDiasCredito_proveedores_cuentas_pagar').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intLimiteCredito: $.reemplazar($('#txtLimiteCredito_proveedores_cuentas_pagar').val(), ",", ""), 
						//Datos de las cuentas bancarias
						arrCuentasBancarias: jsonCuentasBancarias
					},
					function(data) {
						if (data.resultado)
						{
                 			//Hacer un llamado a la función para cerrar modal
							cerrar_proveedores_cuentas_pagar(); 

							//Si no existe id del proveedor, significa que es un nuevo registro   
							if($('#txtProveedorID_proveedores_cuentas_pagar').val() == '')
							{
							  	//Asignar el id del proveedor registrado en la base de datos
                     			$('#txtProveedorID_proveedores_cuentas_pagar').val(data.proveedor_id);
                     			//Asignar código consecutivo
                 				$('#txtCodigo_proveedores_cuentas_pagar').val(data.codigo);
                 			}

                 			//Si es un nuevo registro o el estatus del registro es VALIDACION
                 			if($('#txtEstatus_proveedores_cuentas_pagar').val() == '' || 
                 			   $('#txtEstatus_proveedores_cuentas_pagar').val() == 'VALIDACION')
                 			{

                 				//Hacer un llamado a la función para abrir modal de autorización
								abrir_autorizar_proveedores_cuentas_pagar($('#txtProveedorID_proveedores_cuentas_pagar').val(), $('#txtCodigo_proveedores_cuentas_pagar').val(), 'Guardar');
                 			}

							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_proveedores_cuentas_pagar();
							              
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_proveedores_cuentas_pagar(tipoMensaje, mensaje)
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
		function cambiar_estatus_proveedores_cuentas_pagar(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtProveedorID_proveedores_cuentas_pagar').val();

			}
			else
			{
				intID = id;
			}

		    //Si el estatus del registro es ACTIVO o VALIDACION
		    if(estatus == 'ACTIVO' || estatus == 'VALIDACION')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
						             {'type':     'question',
						              'title':    'Proveedores',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
						                              $.post('cuentas_pagar/proveedores/set_estatus',
						                                     {intProveedorID: intID,
						                                      strEstatus: estatus
						                                     },
						                                     function(data) {
						                                        if(data.resultado)
						                                        {
						                                          	//Hacer llamado a la función  para cargar  los registros en el grid
						                                          	paginacion_proveedores_cuentas_pagar();

						                                          	//Si el id del registro se obtuvo del modal
																	if(id == '')
																	{
																		//Hacer un llamado a la función para cerrar modal
																		cerrar_proveedores_cuentas_pagar();     
																	}
						                                        }
						                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						                                        mensaje_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
						                                     },
						                                    'json');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('cuentas_pagar/proveedores/set_estatus',
				     {intProveedorID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				     	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_proveedores_cuentas_pagar();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_proveedores_cuentas_pagar();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_proveedores_cuentas_pagar(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_proveedores_cuentas_pagar(id)
		{	
			
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_pagar/proveedores/get_datos',
			       {intProveedorID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_proveedores_cuentas_pagar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';

				          	//Recuperar valores
				            $('#txtProveedorID_proveedores_cuentas_pagar').val(data.row.proveedor_id);
				            $('#txtCodigo_proveedores_cuentas_pagar').val(data.row.codigo);
				            $('#txtRazonSocial_proveedores_cuentas_pagar').val(data.row.razon_social);
						    $('#txtRfc_proveedores_cuentas_pagar').val(data.row.rfc);
						    $('#txtRfcAnterior_proveedores_cuentas_pagar').val(data.row.rfc);
						    $('#txtRegimenFiscalID_proveedores_cuentas_pagar').val(data.row.regimen_fiscal_id);
				            $('#txtRegimenFiscal_proveedores_cuentas_pagar').val(data.row.regimen_fiscal);
						    $('#txtNombreComercial_proveedores_cuentas_pagar').val(data.row.nombre_comercial);
						    $('#cmbTipoProveedor_proveedores_cuentas_pagar').val(data.row.tipo_proveedor);
						    $('#txtTelefonoPrincipal_proveedores_cuentas_pagar').val(data.row.telefono_principal);
						    $('#txtTelefonoSecundario_proveedores_cuentas_pagar').val(data.row.telefono_secundario);
						    $('#txtCorreoElectronico_proveedores_cuentas_pagar').val(data.row.correo_electronico);
						    $('#txtCalle_proveedores_cuentas_pagar').val(data.row.calle);
						    $('#txtNumeroExterior_proveedores_cuentas_pagar').val(data.row.numero_exterior);
						    $('#txtNumeroInteriorproveedores_cuentas_pagar').val(data.row.numero_interior);
						    $('#txtColonia_proveedores_cuentas_pagar').val(data.row.colonia);
						    $('#txtReferencia_proveedores_cuentas_pagar').val(data.row.referencia);
						    $('#txtCodigoPostalID_proveedores_cuentas_pagar').val(data.row.codigo_postal_id);
						    $('#txtCodigoPostal_proveedores_cuentas_pagar').val(data.row.codigo_postal);
						    $('#txtLocalidad_proveedores_cuentas_pagar').val(data.row.localidad);
						    $('#txtMunicipioID_proveedores_cuentas_pagar').val(data.row.municipio_id);
						    $('#txtMunicipio_proveedores_cuentas_pagar').val(data.row.municipio);
						    $('#txtEstado_proveedores_cuentas_pagar').val(data.row.estado);
						    $('#txtPais_proveedores_cuentas_pagar').val(data.row.pais);
						    $('#txtContactoNombre_proveedores_cuentas_pagar').val(data.row.contacto_nombre);
						    $('#txtContactoTelefono_proveedores_cuentas_pagar').val(data.row.contacto_telefono);
						    $('#txtContactoExtension_proveedores_cuentas_pagar').val(data.row.contacto_extension);
						    $('#txtContactoCelular_proveedores_cuentas_pagar').val(data.row.contacto_celular);
						    $('#txtContactoCorreoElectronico_proveedores_cuentas_pagar').val(data.row.contacto_correo_electronico);
					        $('#txtDiasCredito_proveedores_cuentas_pagar').val(data.row.dias_credito);
						    $('#txtLimiteCredito_proveedores_cuentas_pagar').val(data.row.limite_credito);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtLimiteCredito_proveedores_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 2 });
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_proveedores_cuentas_pagar').addClass("estatus-"+strEstatus);
				            $('#txtEstatus_proveedores_cuentas_pagar').val(strEstatus);
				            
				            //Si el estatus del registro es INACTIVO
				            if(strEstatus == 'INACTIVO')
							{
								//Deshabilitar todos los elementos del formulario
			            		$('#frmProveedoresCuentasPagar').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar los siguientes botones
				           		$("#btnGuardar_proveedores_cuentas_pagar").hide(); 
				           		$("#btnNuevo_cuenta_bancaria_proveedores_cuentas_pagar").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_proveedores_cuentas_pagar").show();
								
								strAccionesTabla = "<button class='btn btn-default btn-xs' title='Ver'" +
													 " onclick='editar_renglon_cuenta_bancaria_proveedores_cuentas_pagar(this)'>" + 
													 "<span class='glyphicon glyphicon-eye-open'></span></button>";
							}
							else 
							{	

								strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_cuenta_bancaria_proveedores_cuentas_pagar(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_cuenta_bancaria_proveedores_cuentas_pagar(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

								//Mostrar botón Desactivar
				            	$("#btnDesactivar_proveedores_cuentas_pagar").show();

				                //Si el estatus del registro es VALIDACION
				            	if(strEstatus == 'VALIDACION')
				            	{
				            		//Mostrar botón Autorizar
				            		$("#btnAutorizar_proveedores_cuentas_pagar").show();
				            	}
				            	
							}

							//Mostramos las cuentas bancarias del registro
				           	for (var intCon in data.cuentas_bancarias) 
				            {
				            	//Crear instancia del objeto Cuenta bancaria del proveedor
								objCuentaBancariaProvProveedoresCuentasPagar = new CuentaBancariaProvProveedoresCuentasPagar('', '', '', '', '');

								//Asignar valores
								objCuentaBancariaProvProveedoresCuentasPagar.intBancoID = data.cuentas_bancarias[intCon].banco_id;
								objCuentaBancariaProvProveedoresCuentasPagar.strBanco = data.cuentas_bancarias[intCon].banco;
								objCuentaBancariaProvProveedoresCuentasPagar.strCuenta = data.cuentas_bancarias[intCon].cuenta;
								objCuentaBancariaProvProveedoresCuentasPagar.strClabe = data.cuentas_bancarias[intCon].clabe;
								objCuentaBancariaProvProveedoresCuentasPagar.intMonedaID = data.cuentas_bancarias[intCon].moneda_id;
								objCuentaBancariaProvProveedoresCuentasPagar.strMoneda = data.cuentas_bancarias[intCon].moneda;
								//Agregar datos de la cuenta bancaria del proveedor
           						objCuentasBancariasProveedoresCuentasPagar.setCuentaBancaria(objCuentaBancariaProvProveedoresCuentasPagar);

				            	//Obtenemos el objeto de la tabla
				            	var objTabla = document.getElementById('dg_cuentas_bancarias_proveedores_cuentas_pagar').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaCuenta = objRenglon.insertCell(0);
								var objCeldaClabe = objRenglon.insertCell(1);
								var objCeldaMoneda = objRenglon.insertCell(2);
								var objCeldaBanco = objRenglon.insertCell(3);
								var objCeldaAcciones = objRenglon.insertCell(4);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', objCuentaBancariaProvProveedoresCuentasPagar.strCuenta);
								objCeldaCuenta.setAttribute('class', 'movil b1');
								objCeldaCuenta.innerHTML = objCuentaBancariaProvProveedoresCuentasPagar.strCuenta;
							    objCeldaClabe.setAttribute('class', 'movil b2');
								objCeldaClabe.innerHTML = objCuentaBancariaProvProveedoresCuentasPagar.strClabe;
								objCeldaMoneda.setAttribute('class', 'movil b3');
								objCeldaMoneda.innerHTML = objCuentaBancariaProvProveedoresCuentasPagar.strMoneda;
								objCeldaBanco.setAttribute('class', 'movil b4');
								objCeldaBanco.innerHTML = objCuentaBancariaProvProveedoresCuentasPagar.strBanco;
								objCeldaAcciones.setAttribute('class', 'td-center movil b5');
								objCeldaAcciones.innerHTML = strAccionesTabla;

				            }

				            //Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
							var intFilas = $("#dg_cuentas_bancarias_proveedores_cuentas_pagar tr").length - 1;
							$('#numElementos_cuentas_bancarias_proveedores_cuentas_pagar').html(intFilas);

			            	//Abrir modal
				            objProveedoresCuentasPagar = $('#ProveedoresCuentasPagarBox').bPopup({
														  appendTo: '#ProveedoresCuentasPagarContent', 
							                              contentContainer: 'ProveedoresCuentasPagarM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtRazonSocial_proveedores_cuentas_pagar').focus();
			       	    }
			       },
			       'json');
		}

		/*******************************************************************************************************************
		Funciones del Tab - Datos Crediticios
		*********************************************************************************************************************/
		/*******************************************************************************************************************
		Funciones del modal Cuentas Bancarias
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cuenta_bancaria_proveedores_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmCuentaBancariaProveedoresCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cuenta_bancaria_proveedores_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmCuentaBancariaProveedoresCuentasPagar').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_cuenta_bancaria_proveedores_cuentas_pagar').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_cuenta_bancaria_proveedores_cuentas_pagar').removeClass("estatus-VALIDACION");
			$('#divEncabezadoModal_cuenta_bancaria_proveedores_cuentas_pagar').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_cuenta_bancaria_proveedores_cuentas_pagar').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmCuentaBancariaProveedoresCuentasPagar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar el botón Guardar
		    $('#btnGuardar_cuenta_bancaria_proveedores_cuentas_pagar').show();
		}

		//Función que se utiliza para abrir el modal
		function abrir_cuenta_bancaria_proveedores_cuentas_pagar()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cuenta_bancaria_proveedores_cuentas_pagar();

		    //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_cuenta_bancaria_proveedores_cuentas_pagar').addClass("estatus-NUEVO");
			
			//Abrir modal
			objCuentaBancariaProveedoresCuentasPagar = $('#CuentasBancariasProveedoresCuentasPagarBox').bPopup({
														   appendTo: '#ProveedoresCuentasPagarContent', 
								                           contentContainer: 'ProveedoresCuentasPagarM', 
								                           zIndex: 2, 
								                           modalClose: false, 
								                           modal: true, 
								                           follow: [true,false], 
								                           followEasing : "linear", 
								                           easing: "linear", 
								                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#txtCuenta_cuenta_bancaria_proveedores_cuentas_pagar').focus();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cuenta_bancaria_proveedores_cuentas_pagar()
		{
			try {
				//Cerrar modal
				objCuentaBancariaProveedoresCuentasPagar.close();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cuenta_bancaria_proveedores_cuentas_pagar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cuenta_bancaria_proveedores_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmCuentaBancariaProveedoresCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									    strCuenta_cuenta_bancaria_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba una cuenta bancaria'}
											}
										},
										strClabe_cuenta_bancaria_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba una clabe'}
											}
										},
										intMonedaID_cuenta_bancaria_proveedores_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										strBanco_cuenta_bancaria_proveedores_cuentas_pagar: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                	//Verificar que exista id del banco
					                                    if($('#txtBancoID_cuenta_bancaria_proveedores_cuentas_pagar').val() === '')
					                                    {
				                                      		return {
					                                        	valid: false,
					                                            message: 'Escriba un banco existente'
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
			var bootstrapValidator_cuenta_bancaria_proveedores_cuentas_pagar = $('#frmCuentaBancariaProveedoresCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_cuenta_bancaria_proveedores_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cuenta_bancaria_proveedores_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_cuenta_bancaria_proveedores_cuentas_pagar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cuenta_bancaria_proveedores_cuentas_pagar()
		{
			try
			{
				$('#frmCuentaBancariaProveedoresCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar la cuenta bancaria
		function guardar_cuenta_bancaria_proveedores_cuentas_pagar()
		{
			//Asignar el renglón de la cuenta bancaria seleccionado
			var intRenglon = $('#txtRenglon_cuenta_bancaria_proveedores_cuentas_pagar').val();

			//Crear instancia del objeto Cuenta bancaria del proveedor
			objCuentaBancariaProvProveedoresCuentasPagar = new CuentaBancariaProvProveedoresCuentasPagar('', '', '', '', '');
		
			//Asignar valores 
			objCuentaBancariaProvProveedoresCuentasPagar.intBancoID = $('#txtBancoID_cuenta_bancaria_proveedores_cuentas_pagar').val();
		    objCuentaBancariaProvProveedoresCuentasPagar.strBanco = $('#txtBanco_cuenta_bancaria_proveedores_cuentas_pagar').val();
		    objCuentaBancariaProvProveedoresCuentasPagar.strCuenta = $('#txtCuenta_cuenta_bancaria_proveedores_cuentas_pagar').val();
		    objCuentaBancariaProvProveedoresCuentasPagar.strClabe = $('#txtClabe_cuenta_bancaria_proveedores_cuentas_pagar').val();
		    objCuentaBancariaProvProveedoresCuentasPagar.intMonedaID = $('#cmbMonedaID_cuenta_bancaria_proveedores_cuentas_pagar').val();
		    objCuentaBancariaProvProveedoresCuentasPagar.strMoneda =  $('select[name="intMonedaID_cuenta_bancaria_proveedores_cuentas_pagar"] option:selected').text();

			//Revisamos si existe el renglón, si es así, editamos los datos de la cuenta bancaria
			if (intRenglon)
			{
			    //Modificar los datos de la cuenta bancaria corespondiente al indice
        		objCuentasBancariasProveedoresCuentasPagar.modificarCuentaBancaria(intRenglon, objCuentaBancariaProvProveedoresCuentasPagar);

        		//Incrementar renglón para obtener la posición de la cuenta bancaria en la tabla
				intRenglon++;
				//Seleccionar el renglón de la tabla para actualizar los datos de la cuenta bancaria
				var selectedRow = document.getElementById("dg_cuentas_bancarias_proveedores_cuentas_pagar").rows[intRenglon].cells;
				selectedRow[0].innerHTML = objCuentaBancariaProvProveedoresCuentasPagar.strCuenta;
				selectedRow[1].innerHTML = objCuentaBancariaProvProveedoresCuentasPagar.strClabe;
				selectedRow[2].innerHTML = objCuentaBancariaProvProveedoresCuentasPagar.strMoneda;
				selectedRow[3].innerHTML = objCuentaBancariaProvProveedoresCuentasPagar.strBanco;
			}
			else
			{
				//Agregar datos de la cuenta bancaria del proveedor
           		objCuentasBancariasProveedoresCuentasPagar.setCuentaBancaria(objCuentaBancariaProvProveedoresCuentasPagar);

				//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_cuentas_bancarias_proveedores_cuentas_pagar').getElementsByTagName('tbody')[0];
           		
				//Variable que se utiliza para asignar el id del detalle
				var strCuenta =  objCuentaBancariaProvProveedoresCuentasPagar.strCuenta;

				//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
			    if (!objTabla.rows.namedItem(strCuenta))
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCuenta = objRenglon.insertCell(0);
					var objCeldaClabe = objRenglon.insertCell(1);
					var objCeldaMoneda = objRenglon.insertCell(2);
					var objCeldaBanco = objRenglon.insertCell(3);
					var objCeldaAcciones = objRenglon.insertCell(4);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strCuenta);
					objCeldaCuenta.setAttribute('class', 'movil b1');
					objCeldaCuenta.innerHTML = strCuenta;
				    objCeldaClabe.setAttribute('class', 'movil b2');
					objCeldaClabe.innerHTML = objCuentaBancariaProvProveedoresCuentasPagar.strClabe;
					objCeldaMoneda.setAttribute('class', 'movil b3');
					objCeldaMoneda.innerHTML = objCuentaBancariaProvProveedoresCuentasPagar.strMoneda;
					objCeldaBanco.setAttribute('class', 'movil b4');
					objCeldaBanco.innerHTML = objCuentaBancariaProvProveedoresCuentasPagar.strBanco;
					objCeldaAcciones.setAttribute('class', 'td-center movil b5');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_cuenta_bancaria_proveedores_cuentas_pagar(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_cuenta_bancaria_proveedores_cuentas_pagar(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				}
				
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_cuentas_bancarias_proveedores_cuentas_pagar tr").length - 1;
			$('#numElementos_cuentas_bancarias_proveedores_cuentas_pagar').html(intFilas);

            //Hacer un llamado a la función para cerrar modal
			cerrar_cuenta_bancaria_proveedores_cuentas_pagar();
		}

		//Función para editar un renglón de la tabla
		function editar_renglon_cuenta_bancaria_proveedores_cuentas_pagar(objRenglon)
		{
		    //Decrementar indice para obtener la posición de la cuenta bancaria en el arreglo
		    var intRenglon = objRenglon.parentNode.parentNode.rowIndex - 1;
			//Hacer un llamado a la función para regresar los datos de la cuenta bancaria que le corresponde al indice 
			//(dentro del objeto Cuentas bancarias)
			get_datos_cuenta_bancaria_proveedores_cuentas_pagar(intRenglon);

			//Abrir modal
			objCuentaBancariaProveedoresCuentasPagar = $('#CuentasBancariasProveedoresCuentasPagarBox').bPopup({
														   appendTo: '#ProveedoresCuentasPagarContent', 
								                           contentContainer: 'ProveedoresCuentasPagarM', 
								                           zIndex: 2, 
								                           modalClose: false, 
								                           modal: true, 
								                           follow: [true,false], 
								                           followEasing : "linear", 
								                           easing: "linear", 
								                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#txtCuenta_cuenta_bancaria_proveedores_cuentas_pagar').focus();
			
		}

		//Función para regresar obtener los datos de la cuenta bancaria corespondiente al indice (dentro del objeto Cuentas bancarias)
		function get_datos_cuenta_bancaria_proveedores_cuentas_pagar(intRenglon)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cuenta_bancaria_proveedores_cuentas_pagar();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_proveedores_cuentas_pagar').val();
			
			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_cuenta_bancaria_proveedores_cuentas_pagar').addClass("estatus-"+strEstatus);

			//Crear instancia del objeto Cuenta bancaria del proveedor
        	objCuentaBancariaProvProveedoresCuentasPagar = new CuentaBancariaProvProveedoresCuentasPagar();
        	//Asignar datos de la cuenta bancaria corespondiente al indice
        	objCuentaBancariaProvProveedoresCuentasPagar = objCuentasBancariasProveedoresCuentasPagar.getCuentaBancaria(intRenglon);
			
        	//Asignar los valores a las cajas de texto
			$('#txtRenglon_cuenta_bancaria_proveedores_cuentas_pagar').val(intRenglon);
			$('#txtCuenta_cuenta_bancaria_proveedores_cuentas_pagar').val(objCuentaBancariaProvProveedoresCuentasPagar.strCuenta);
		    $('#txtClabe_cuenta_bancaria_proveedores_cuentas_pagar').val(objCuentaBancariaProvProveedoresCuentasPagar.strClabe);
		    $('#txtBancoID_cuenta_bancaria_proveedores_cuentas_pagar').val(objCuentaBancariaProvProveedoresCuentasPagar.intBancoID);
		    $('#txtBanco_cuenta_bancaria_proveedores_cuentas_pagar').val(objCuentaBancariaProvProveedoresCuentasPagar.strBanco);
		    $('#cmbMonedaID_cuenta_bancaria_proveedores_cuentas_pagar').val(objCuentaBancariaProvProveedoresCuentasPagar.intMonedaID);

		     //Si el estatus del registro es INACTIVO
		    if(strEstatus == 'INACTIVO')
		    {
		    	//Ocultar los siguientes botones
		    	$('#btnGuardar_cuenta_bancaria_proveedores_cuentas_pagar').hide();
		    	//Deshabilitar todos los elementos del formulario
				$('#frmCuentaBancariaPagosCaja').find('input, textarea, select').attr('disabled','disabled');

		    }
		}
		//Función para eliminar un renglón de la tabla
		function eliminar_renglon_cuenta_bancaria_proveedores_cuentas_pagar(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			//Eliminar del objeto el detalle seleccionado
			objCuentasBancariasProveedoresCuentasPagar.eliminarCuentaBancaria(intRenglon - 1);
			//Eliminar el renglón indicado
			document.getElementById("dg_cuentas_bancarias_proveedores_cuentas_pagar").deleteRow(intRenglon);
			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_cuentas_bancarias_proveedores_cuentas_pagar tr").length - 1;
			$('#numElementos_cuentas_bancarias_proveedores_cuentas_pagar').html(intFilas);
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{

			/*******************************************************************************************************************
			Controles correspondientes al modal Proveedores
			*********************************************************************************************************************/
			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Información General
        	*********************************************************************************************************************/
			//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtTelefonoPrincipal_proveedores_cuentas_pagar').numeric({decimal: false, negative: false});
        	$('#txtTelefonoSecundario_proveedores_cuentas_pagar').numeric({decimal: false, negative: false});
        	$('#txtCodigoPostal_proveedores_cuentas_pagar').numeric({decimal: false, negative: false});
        	$('#txtContactoTelefono_proveedores_cuentas_pagar').numeric({decimal: false, negative: false});
        	$('#txtContactoExtension_proveedores_cuentas_pagar').numeric({decimal: false, negative: false});
        	$('#txtContactoCelular_proveedores_cuentas_pagar').numeric({decimal: false, negative: false});
        	$('#txtDiasCredito_proveedores_cuentas_pagar').numeric({decimal: false, negative: false});
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtLimiteCredito_proveedores_cuentas_pagar').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_proveedores_cuentas_pagar').blur(function(){
				$('.moneda_proveedores_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 2 });
			});


			//Autocomplete para recuperar los datos de un régimen fiscal 
	        $('#txtRegimenFiscal_proveedores_cuentas_pagar').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtRegimenFiscalID_proveedores_cuentas_pagar').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_regimen_fiscal/autocomplete",
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
	               $('#txtRegimenFiscalID_proveedores_cuentas_pagar').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id del régimen fiscal cuando pierda el enfoque la caja de texto
	        $('#txtRegimenFiscal_proveedores_cuentas_pagar').focusout(function(e){
	            //Si no existe id del régimen fiscal 
	            if($('#txtRegimenFiscalID_proveedores_cuentas_pagar').val() == '' || 
	               $('#txtRegimenFiscal_proveedores_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de la caja de texto
	               $('#txtRegimenFiscalID_proveedores_cuentas_pagar').val('');
	               $('#txtRegimenFiscal_proveedores_cuentas_pagar').val('');
	            }
	            
	        });

        	//Autocomplete para recuperar los datos de un código postal 
	        $('#txtCodigoPostal_proveedores_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCodigoPostalID_proveedores_cuentas_pagar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_codigos_postales/autocomplete",
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
	             $('#txtCodigoPostalID_proveedores_cuentas_pagar').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('contabilidad/sat_codigos_postales/get_datos',
	                  { 
	                  	strBusqueda:$("#txtCodigoPostalID_proveedores_cuentas_pagar").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){	                       	                       
	                       $("#txtMunicipioID_proveedores_cuentas_pagar").val(data.row.municipio_id);
	                       $("#txtMunicipio_proveedores_cuentas_pagar").val(data.row.municipio);
	                       $("#txtEstado_proveedores_cuentas_pagar").val(data.row.estado);
	                       $("#txtPais_proveedores_cuentas_pagar").val(data.row.pais);
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
	        
	        //Verificar que exista id del código postal cuando pierda el enfoque la caja de texto
	        $('#txtCodigoPostal_proveedores_cuentas_pagar').focusout(function(e){
	            //Si no existe id del código postal
	            if($('#txtCodigoPostalID_proveedores_cuentas_pagar').val() == '' ||
	               $('#txtCodigoPostal_proveedores_cuentas_pagar').val() == '' )
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtCodigoPostalID_proveedores_cuentas_pagar').val('');
	               $('#txtCodigoPostal_proveedores_cuentas_pagar').val('');	               
	               $('#txtLocalidad_proveedores_cuentas_pagar').val('');
	               $('#txtMunicipioID_proveedores_cuentas_pagar').val('');
	               $('#txtMunicipio_proveedores_cuentas_pagar').val('');
	               $('#txtEstado_proveedores_cuentas_pagar').val('');
	               $('#txtPais_proveedores_cuentas_pagar').val('');
	            }

	        });

			//Autocomplete para recuperar los datos de una localidad 
	        $('#txtMunicipio_proveedores_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtMunicipioID_proveedores_cuentas_pagar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/municipios/autocomplete",
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
	             $('#txtMunicipioID_proveedores_cuentas_pagar').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/municipios/get_datos',
	                  { 
	                  	strBusqueda:$("#txtMunicipioID_proveedores_cuentas_pagar").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtMunicipio_proveedores_cuentas_pagar").val(data.row.municipio);	
	                       $("#txtEstado_proveedores_cuentas_pagar").val(data.row.estado);
	                       $("#txtPais_proveedores_cuentas_pagar").val(data.row.pais);
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
	        
	        //Verificar que exista id de la localidad cuando pierda el enfoque la caja de texto
	        $('#txtMunicipio_proveedores_cuentas_pagar').focusout(function(e){
	            //Si no existe id de la localidad
	            if($('#txtMunicipioID_proveedores_cuentas_pagar').val() == '' ||
	               $('#txtMunicipio_proveedores_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto	  
	               $('#txtMunicipioID_proveedores_cuentas_pagar').val('');             
	               $('#txtMunicipio_proveedores_cuentas_pagar').val('');	               
	               $('#txtEstado_proveedores_cuentas_pagar').val('');
	               $('#txtPais_proveedores_cuentas_pagar').val('');
	            }

	        });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_cuentas_bancarias_proveedores_cuentas_pagar').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Verifica que no sea el último elemento del grid
	            	if( row.next().index() != -1 )
	            	{ 
	            		objCuentasBancariasProveedoresCuentasPagar.swap(row.index(), row.next().index() );
	            	}	

	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Verifica que no sea el primer elemento del grid
	            	if( row.prev().index() != -1 )
	            	{ 
	            		objCuentasBancariasProveedoresCuentasPagar.swap(row.prev().index(), row.index() );
	            	}
	            	//Pasar al renglón de arriba
	            	row.prev().before(row);
	            }
				
	        });


	        /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Datos Crediticios
        	*********************************************************************************************************************/
	        /*******************************************************************************************************************
			Controles correspondientes al modal Cuentas Bancarias
			*********************************************************************************************************************/
			$('#txtCuenta_cuenta_bancaria_proveedores_cuentas_pagar').numeric({decimal: false, negative: false});
        	$('#txtClabe_cuenta_bancaria_proveedores_cuentas_pagar').numeric({decimal: false, negative: false});

        	//Comprobar la existencia de la cuenta bancaria en la tabla cuando pierda el enfoque la caja de texto
			$('#txtCuenta_cuenta_bancaria_proveedores_cuentas_pagar').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtRenglon_cuenta_bancaria_proveedores_cuentas_pagar').val() == '' && $('#txtCuenta_cuenta_bancaria_proveedores_cuentas_pagar').val() != '')
				{
					//Variable que se utiliza para asignar la cuenta
					var strCuenta =  $('#txtCuenta_cuenta_bancaria_proveedores_cuentas_pagar').val();
					//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_cuentas_bancarias_proveedores_cuentas_pagar').getElementsByTagName('tbody')[0];
					//Revisamos si existe la cuenta, si es así, mostramos los datos
				    if (objTabla.rows.namedItem(strCuenta))
					{
						//Decrementar indice para obtener la posición de la cuenta bancaria en el arreglo
						intRenglon = objTabla.rows.namedItem(strCuenta).rowIndex - 1;
						//Hacer un llamado a la función para regresar los datos de la cuenta bancaria que le corresponde al indice 
						//(dentro del objeto Cuentas bancarias)
						get_datos_cuenta_bancaria_proveedores_cuentas_pagar(intRenglon);
					}
				}
			});

        	//Autocomplete para recuperar los datos de un banco
	        $('#txtBanco_cuenta_bancaria_proveedores_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtBancoID_cuenta_bancaria_proveedores_cuentas_pagar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_bancos/autocomplete",
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
	             $('#txtBancoID_cuenta_bancaria_proveedores_cuentas_pagar').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del banco cuando pierda el enfoque la caja de texto
	        $('#txtBanco_cuenta_bancaria_proveedores_cuentas_pagar').focusout(function(e){
	            //Si no existe id del banco
	            if($('#txtBancoID_cuenta_bancaria_proveedores_cuentas_pagar').val() == '' ||
	               $('#txtBanco_cuenta_bancaria_proveedores_cuentas_pagar').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtBancoID_cuenta_bancaria_proveedores_cuentas_pagar').val('');
	                $('#txtBanco_cuenta_bancaria_proveedores_cuentas_pagar').val('');
	            }
	            
	        });

	        //Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_proveedores_cuentas_pagar').on('click','a',function(event){
				event.preventDefault();
				intPaginaProveedoresCuentasPagar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_proveedores_cuentas_pagar();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_proveedores_cuentas_pagar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_proveedores_cuentas_pagar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_proveedores_cuentas_pagar').addClass("estatus-NUEVO");
				//Abrir modal
				 objProveedoresCuentasPagar = $('#ProveedoresCuentasPagarBox').bPopup({
											   appendTo: '#ProveedoresCuentasPagarContent', 
				                               contentContainer: 'ProveedoresCuentasPagarM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtRazonSocial_proveedores_cuentas_pagar').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_proveedores_cuentas_pagar').focus();

			
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_proveedores_cuentas_pagar();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_cuenta_bancaria_proveedores_cuentas_pagar();
		});
	</script>