	<div id="ValidacionProspectosCuentasCobrarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_validacion_prospectos_cuentas_cobrar" action="#" method="post" 
				  tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_validacion_prospectos_cuentas_cobrar" 
								   name="strBusqueda_validacion_prospectos_cuentas_cobrar"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_validacion_prospectos_cuentas_cobrar"
										onclick="paginacion_validacion_prospectos_cuentas_cobrar();" 
										title="Buscar coincidencias" tabindex="1"> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group"> 
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_validacion_prospectos_cuentas_cobrar"
									onclick="reporte_validacion_prospectos_cuentas_cobrar('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_validacion_prospectos_cuentas_cobrar"
									onclick="reporte_validacion_prospectos_cuentas_cobrar('XLS');" title="Descargar reporte general en XLS" tabindex="1">
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
				Definir columnas de la tabla clientes
				*/
				td.movil.a1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Nombre"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Contacto"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Domicilio"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla documentos
				*/
				td.movil.b1:nth-of-type(1):before {content: "Documento"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_validacion_prospectos_cuentas_cobrar">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Nombre</th>
							<th class="movil">Contacto</th>
							<th class="movil">Domicilio</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_validacion_prospectos_cuentas_cobrar" type="text/template"> 
					{{#rows}}
						<tr class="movil">    
							<td class="movil a1">{{codigo}}</td>
							<td class="movil a2">{{nombre_comercial}}</td>
							<td class="movil a3">{{contacto_nombre}}</td>
							<td class="movil a4">{{domicilio}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="movil a6 td-center"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_validacion_prospectos_cuentas_cobrar({{prospecto_id}});"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Rehazar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="enviar_rechazo_validacion_prospectos_cuentas_cobrar({{prospecto_id}});" title="Rechazar">
									<span class="glyphicon glyphicon-ban-circle"></span>
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_validacion_prospectos_cuentas_cobrar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_validacion_prospectos_cuentas_cobrar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Rechazo de Prospectos-->
		<div id="RechazoValidacionProspectosCuentasCobrarBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_rechazo_validacion_prospectos_cuentas_cobrar" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Rechazo de Prospectos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRechazoValidacionProspectosCuentasCobrar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRechazoValidacionProspectosCuentasCobrar"  onsubmit="return(false)" autocomplete="off">
			    	<div class="row">
				    	<!--Mensaje-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtProspectoID_rechazo_validacion_prospectos_cuentas_cobrar" 
										   name="intProspectoID_rechazo_validacion_prospectos_cuentas_cobrar" 
										   type="hidden" value="">
									</input>
									<label for="txtMensaje_rechazo_validacion_prospectos_cuentas_cobrar">Escriba el motivo del rechazo</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtMensaje_rechazo_validacion_prospectos_cuentas_cobrar" 
											   name="strMensaje_rechazo_validacion_prospectos_cuentas_cobrar" rows="5" value="" tabindex="1" placeholder="Ingrese motivo" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Rechazar registro-->
							<button class="btn btn-success" id="btnGuardar_rechazo_validacion_prospectos_cuentas_cobrar"  
									onclick="validar_rechazo_validacion_prospectos_cuentas_cobrar();"  title="Rechazar" tabindex="2">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_rechazo_validacion_prospectos_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_rechazo_validacion_prospectos_cuentas_cobrar();" 
									title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Rechazo de Prospectos-->

		<!-- Diseño del modal Validación de Prospectos-->
		<div id="ValidacionProspectosCuentasCobrarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_validacion_prospectos_cuentas_cobrar" class="ModalBodyTitle">
				<h1>Validación de Prospectos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_validacion_prospectos_cuentas_cobrar" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_validacion_prospectos_cuentas_cobrar" class="active">
									<a data-toggle="tab" href="#informacion_general_validacion_prospectos_cuentas_cobrar">Información General</a>
								</li>
								<!--Tab que contiene la información del expediente-->
								<li id="tabExpediente_validacion_prospectos_cuentas_cobrar">
									<a data-toggle="tab" href="#expediente_validacion_prospectos_cuentas_cobrar">Expediente</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmValidacionProspectosCuentasCobrar" method="post" action="#" class="form-horizontal" role="form" name="frmValidacionProspectosCuentasCobrar" 
					  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_validacion_prospectos_cuentas_cobrar" class="tab-pane fade in active">
							<div class="row">
								<!--Código-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtProspectoID_validacion_prospectos_cuentas_cobrar" 
												   name="intProspectoID_validacion_prospectos_cuentas_cobrar" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
											<input id="txtEstatus_validacion_prospectos_cuentas_cobrar" 
												   name="strEstatus_validacion_prospectos_cuentas_cobrar" 
												   type="hidden" value="">
											</input>
											<label for="txtCodigo_validacion_prospectos_cuentas_cobrar">Código</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigo_validacion_prospectos_cuentas_cobrar" 
													name="strCodigo_validacion_prospectos_cuentas_cobrar" type="text" value="" 
													placeholder="Autogenerado" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Razón social-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRazonSocial_validacion_prospectos_cuentas_cobrar">Razón social</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRazonSocial_validacion_prospectos_cuentas_cobrar"
												   name="strRazonSocial_validacion_prospectos_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--RFC-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRfc_validacion_prospectos_cuentas_cobrar">RFC</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRfc_validacion_prospectos_cuentas_cobrar"
												   name="strRfc_validacion_prospectos_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese RFC" maxlength="13">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<!--Select con Tipo de persona-->
									<div class="form-group">
											<div class="col-md-12">
												<label for="cmbTipoPersona_general_validacion_cuentas_cobrar">Tipo de persona</label>
											</div>
											<div class="col-md-12">
												<select class="form-control" id="cmbTipoPersona_general_validacion_cuentas_cobrar" 
												 		name="strTipoPersona_general_validacion_cuentas_cobrar" tabindex="1">
												 	<option value="0">Seleccione tipo de persona</option>
												    <option value="FISICA">FISICA</option>
				                      				<option value="MORAL">MORAL</option>
				                 				</select>
											</div>
										</div>
								</div>
								<!--Nombre comercial-->
								<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											
											<label for="txtNombreComercial_validacion_prospectos_cuentas_cobrar">Nombre comercial</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtNombreComercial_validacion_prospectos_cuentas_cobrar"
												   name="strNombreComercial_validacion_prospectos_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese nombre comercial" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Representante legal-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											
											<label for="txtRepresentanteLegal_validacion_prospectos_cuentas_cobrar">Representante legal</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRepresentanteLegal_validacion_prospectos_cuentas_cobrar"
												   name="strRepresentanteLegal_validacion_prospectos_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese representante legal" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Teléfonos-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                          			<!--Div que contiene los campos de los teléfonos-->
		                            <div class="form-group row">
		                                <!--Etiqueta del encabezado-->
		                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		                                    <label for="txtTelefonoPrincipal_validacion_prospectos_cuentas_cobrar">Teléfonos</label>
		                                </div>
		                                <!--Teléfono principal-->
		                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		                                    <input  class="form-control" id="txtTelefonoPrincipal_validacion_prospectos_cuentas_cobrar" 
		                                     		name="strTelefonoPrincipal_validacion_prospectos_cuentas_cobrar" 
		                                     		type="text" value="" tabindex="1" placeholder="Principal" maxlength="10">
		                                    </input>
		                                </div>
		                                <!--Teléfono secundario-->
		                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		                                    <input  class="form-control" id="txtTelefonoSecundario_validacion_prospectos_cuentas_cobrar" 
		                                      		name="strTelefonoSecundario_validacion_prospectos_cuentas_cobrar" 
		                                      		type="text" value="" tabindex="1" placeholder="Secundario" maxlength="10">
		                                	</input>
		                                </div>
		                            </div>
                          		</div>
								<!--Correo electrónico-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCorreoElectronico_validacion_prospectos_cuentas_cobrar">Correo electrónico</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtCorreoElectronico_validacion_prospectos_cuentas_cobrar"
												   name="strCorreoElectronico_validacion_prospectos_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
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
											<label for="txtCalle_validacion_prospectos_cuentas_cobrar">Calle</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCalle_validacion_prospectos_cuentas_cobrar" 
													name="strCalle_validacion_prospectos_cuentas_cobrar" type="text" value="" 
													tabindex="1" placeholder="Ingrese calle" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Número exterior-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNumeroExterior_validacion_prospectos_cuentas_cobrar">Número exterior</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNumeroExterior_validacion_prospectos_cuentas_cobrar" 
													name="strNumeroExterior_validacion_prospectos_cuentas_cobrar" type="text" value="" 
													tabindex="1" placeholder="Ingrese número" maxlength="10">
											</input>
										</div>
									</div>
								</div>
								<!--Número interior-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNumeroInterior_validacion_prospectos_cuentas_cobrar">Número interior</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNumeroInterior_validacion_prospectos_cuentas_cobrar" 
													name="strNumeroInterior_validacion_prospectos_cuentas_cobrar" type="text" value="" 
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
											<input id="txtCodigoPostalID_validacion_prospectos_cuentas_cobrar" 
											       name="intCodigoPostalID_validacion_prospectos_cuentas_cobrar" type="hidden" value="">
											</input>
											<label for="txtCodigoPostal_validacion_prospectos_cuentas_cobrar">Código postal</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigoPostal_validacion_prospectos_cuentas_cobrar" 
													name="strCodigoPostal_validacion_prospectos_cuentas_cobrar" type="text" value="" 
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
											<label for="txtColonia_validacion_prospectos_cuentas_cobrar">Colonia</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtColonia_validacion_prospectos_cuentas_cobrar" 
													name="strColonia_validacion_prospectos_cuentas_cobrar" type="text" value="" 
													tabindex="1" placeholder="Ingrese colonia" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--localidad-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtLocalidad_validacion_prospectos_cuentas_cobrar">Localidad</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtLocalidad_validacion_prospectos_cuentas_cobrar" 
													name="strLocalidad_validacion_prospectos_cuentas_cobrar" type="text" value="" 
													tabindex="1" placeholder="Ingrese localidad" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Referencia-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtReferencia_validacion_prospectos_cuentas_cobrar">Referencia</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtReferencia_validacion_prospectos_cuentas_cobrar" 
													name="strReferencia_validacion_prospectos_cuentas_cobrar" type="text" value="" 
													tabindex="1" placeholder="Ingrese referencia" maxlength="50">
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
								<!--Autocomplete que contiene los municipios activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del municipio seleccionado-->
											<input id="txtMunicipioID_validacion_prospectos_cuentas_cobrar" 
											       name="intMunicipioID_validacion_prospectos_cuentas_cobrar" type="hidden" value="">
											</input>
											<label for="txtMunicipio_validacion_prospectos_cuentas_cobrar">Municipio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMunicipio_validacion_prospectos_cuentas_cobrar" 
													name="strMunicipio_validacion_prospectos_cuentas_cobrar" type="text" 
													value="" placeholder="Ingrese municipio" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Estado-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtEstado_validacion_prospectos_cuentas_cobrar">Estado</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtEstado_validacion_prospectos_cuentas_cobrar" 
													name="strEstado_validacion_prospectos_cuentas_cobrar" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--País-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPais_validacion_prospectos_cuentas_cobrar">País</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPais_validacion_prospectos_cuentas_cobrar" 
													name="strPais_validacion_prospectos_cuentas_cobrar" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
                       		</div>
						    <div class="row">
				    			<!--Datos de contacto-->
                       			<h4 class="col-sm-10 col-md-10 col-lg-10 col-xs-10">Datos de contacto</h4>
                       			<!---Copiar datos del prospecto-->
		                        <div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
		                            <button class="btn btn-copy pull-right" type="button" id="btnCopiar_validacion_prospectos_cuentas_cobrar" onclick="copiar_validacion_prospectos_cuentas_cobrar();" title="Copiar datos del prospecto"><span class="fa fa-files-o"></span></button> 
		                        </div>
		                    </div>
		                    <div class="row">
                       			<!--Nombre-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoNombre_validacion_prospectos_cuentas_cobrar">Nombre</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtContactoNombre_validacion_prospectos_cuentas_cobrar" 
													name="strContactoNombre_validacion_prospectos_cuentas_cobrar" type="text" value="" 
													tabindex="1" placeholder="Ingrese nombre" maxlength="250">
											</input>
										</div>
									</div>
								</div>
                       		</div>
                       		<div class="row">
	                       		<!--Teléfonos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
	                      			<!--Div que contiene los campos de los teléfonos-->
		                            <div class="form-group row">
		                                <!--Etiqueta del encabezado-->
		                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		                                    <label for="txtContactoTelefono_validacion_prospectos_cuentas_cobrar">Teléfonos</label>
		                                </div>
		                                <!--Teléfono de oficina-->
		                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		                                    <input  class="form-control" id="txtContactoTelefono_validacion_prospectos_cuentas_cobrar" 
		                                     		name="strContactoTelefono_validacion_prospectos_cuentas_cobrar" 
		                                     		type="text" value="" tabindex="1" placeholder="Oficina" maxlength="10">
		                                    </input>
		                                </div>
		                                <!--Celular-->
		                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		                                    <input  class="form-control" id="txtContactoCelular_validacion_prospectos_cuentas_cobrar" 
		                                      		name="strContactoCelular_validacion_prospectos_cuentas_cobrar" 
		                                      		type="text" value="" tabindex="1" placeholder="Celular" maxlength="10">
		                                	</input>
		                                </div>
		                            </div>
	                      		</div>
	                      		<!--Extensión-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoExtension_validacion_prospectos_cuentas_cobrar">Extensión</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtContactoExtension_validacion_prospectos_cuentas_cobrar" 
													name="strContactoExtension_validacion_prospectos_cuentas_cobrar" type="text" value="" 
													tabindex="1" placeholder="Ingrese extensión" maxlength="5">
											</input>
										</div>
									</div>
								</div>
								<!--Correo electrónico-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoCorreoElectronico_validacion_prospectos_cuentas_cobrar">Correo electrónico</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtContactoCorreoElectronico_validacion_prospectos_cuentas_cobrar"
												   name="strContactoCorreoElectronico_validacion_prospectos_cuentas_cobrar" 
												   type="text" value="" tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
											</input>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Información General-->
						<!--Tab - Expediente-->
						<div id="expediente_validacion_prospectos_cuentas_cobrar" class="tab-pane fade">
							<div class="form-group row">
								<!--Tabla con el listado de documentos-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_expediente_validacion_prospectos_cuentas_cobrar">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Documento</th>
												<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_expediente_validacion_prospectos_cuentas_cobrar" type="text/template"> 
											{{#rows}}
												<tr class="movil">
													<td class="movil b1">{{descripcion}}</td>
													<td class="td-center movil b2"> 
														<!--Subir archivo-->
														<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
															<span class="btn  btn-default btn-xs fileinput-button ">
														    	<span class="fa fa-upload"></span>
																<input type="file" name="archivo_validacion_prospectos_cuentas_cobrar{{documento_cliente_id}}" id="archivo_validacion_prospectos_cuentas_cobrar{{documento_cliente_id}}"  
																	   onchange="subir_archivo_expediente_validacion_prospectos_cuentas_cobrar({{documento_cliente_id}})">
														  		</input>
														    </span>
														</span>
						                            	<!--Descargar archivo-->
						                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
						                            			 onmousedown="descargar_archivo_expediente_validacion_prospectos_cuentas_cobrar({{documento_cliente_id}})" title="Descargar archivo">
						                            		<span class="glyphicon glyphicon-download-alt"></span>
						                            	</button>
						                            	<!--Eliminar archivo-->
														<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}"  
																onclick="eliminar_archivo_expediente_validacion_prospectos_cuentas_cobrar({{documento_cliente_id}})"  title="Eliminar archivo">
															<span class="glyphicon glyphicon-export"></span>
														</button>
													</td>
												</tr>
											{{/rows}}
											{{^rows}}
												<tr class="movil"> 
													<td class="movil" colspan="2">No se encontraron resultados.</td>
												</tr> 
											{{/rows}}
										</script>
									</table>
									<br>
									<div class="row">
										<!--Número de registros encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_expediente_validacion_prospectos_cuentas_cobrar">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Expediente-->
					</div><!--Cierre del contenedor de tabs-->
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!-- Caja de texto oculta que se utiliza para asignar el tipo de acción (guardar o autorizar) a realizar y así validar campos obligatorios-->
							<input id="txtTipoAccion_validacion_prospectos_cuentas_cobrar" 
								   name="strTipoAccion_validacion_prospectos_cuentas_cobrar" 
								   type="hidden" value="">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_validacion_prospectos_cuentas_cobrar"  
									onclick="validar_validacion_prospectos_cuentas_cobrar('');"  title="Guardar" tabindex="2">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Autorizar registro-->
							<button class="btn btn-warning" id="btnAutorizar_validacion_prospectos_cuentas_cobrar"  
									onclick="validar_validacion_prospectos_cuentas_cobrar('Autorizar');"  title="Autorizar" tabindex="3">
								<span class="glyphicon glyphicon-saved"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_validacion_prospectos_cuentas_cobrar"
									type="reset" aria-hidden="true" onclick="cerrar_validacion_prospectos_cuentas_cobrar();" title="Cerrar"  tabindex="4">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Validación de Prospectos-->
	</div><!--#ValidacionProspectosCuentasCobrarContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaValidacionProspectosCuentasCobrar = 0;
		var strUltimaBusquedaValidacionProspectosCuentasCobrar = "";
		//Variable que se utiliza para asignar objeto del modal Rechazo de Prospectos
		var objRechazoValidacionProspectosCuentasCobrar = null;
		//Variable que se utiliza para asignar objeto del modal Validación de Prospectos
		var objValidacionProspectosCuentasCobrar = null;


		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_validacion_prospectos_cuentas_cobrar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_cobrar/validacion_prospectos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_validacion_prospectos_cuentas_cobrar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosValidacionProspectosCuentasCobrar = data.row;
					//Separar la cadena 
					var arrPermisosValidacionProspectosCuentasCobrar = strPermisosValidacionProspectosCuentasCobrar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosValidacionProspectosCuentasCobrar.length; i++)
					{
						//Si el indice es EDITAR
						if(arrPermisosValidacionProspectosCuentasCobrar[i]=='EDITAR')
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_validacion_prospectos_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosValidacionProspectosCuentasCobrar[i]=='AUTORIZAR')//Si el indice es AUTORIZAR
						{
							//Habilitar el control (botón autorizar)
							$('#btnAutorizar_validacion_prospectos_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosValidacionProspectosCuentasCobrar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_validacion_prospectos_cuentas_cobrar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_validacion_prospectos_cuentas_cobrar();
						}
						else if(arrPermisosValidacionProspectosCuentasCobrar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_validacion_prospectos_cuentas_cobrar').removeAttr('disabled');
						}
						else if(arrPermisosValidacionProspectosCuentasCobrar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_validacion_prospectos_cuentas_cobrar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_validacion_prospectos_cuentas_cobrar() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_validacion_prospectos_cuentas_cobrar').val() != strUltimaBusquedaValidacionProspectosCuentasCobrar)
			{
				intPaginaValidacionProspectosCuentasCobrar = 0;
				strUltimaBusquedaValidacionProspectosCuentasCobrar = $('#txtBusqueda_validacion_prospectos_cuentas_cobrar').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/validacion_prospectos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_validacion_prospectos_cuentas_cobrar').val(),
						intPagina:intPaginaValidacionProspectosCuentasCobrar,
						strPermisosAcceso: $('#txtAcciones_validacion_prospectos_cuentas_cobrar').val()
					},
					function(data){
						$('#dg_validacion_prospectos_cuentas_cobrar tbody').empty();
						var tmpValidacionProspectosCuentasCobrar = Mustache.render($('#plantilla_validacion_prospectos_cuentas_cobrar').html(),data);
						$('#dg_validacion_prospectos_cuentas_cobrar tbody').html(tmpValidacionProspectosCuentasCobrar);
						$('#pagLinks_validacion_prospectos_cuentas_cobrar').html(data.paginacion);
						$('#numElementos_validacion_prospectos_cuentas_cobrar').html(data.total_rows);
						intPaginaValidacionProspectosCuentasCobrar = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_validacion_prospectos_cuentas_cobrar(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_cobrar/validacion_prospectos/';

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
										'strBusqueda': $('#txtBusqueda_validacion_prospectos_cuentas_cobrar').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

		/*******************************************************************************************************************
		Funciones del modal Rechazo de Prospectos
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_rechazo_validacion_prospectos_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmRechazoValidacionProspectosCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rechazo_validacion_prospectos_cuentas_cobrar();
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro en validación)
		    $('#divEncabezadoModal_rechazo_validacion_prospectos_cuentas_cobrar').addClass("estatus-VALIDACION");
		}

		//Función que se utiliza para abrir el modal
		function enviar_rechazo_validacion_prospectos_cuentas_cobrar(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_rechazo_validacion_prospectos_cuentas_cobrar();
			//Asignar datos del registro seleccionado
			$('#txtProspectoID_rechazo_validacion_prospectos_cuentas_cobrar').val(id);
			//Abrir modal
			objRechazoValidacionProspectosCuentasCobrar = $('#RechazoValidacionProspectosCuentasCobrarBox').bPopup({
															appendTo: '#ValidacionProspectosCuentasCobrarContent', 
							                              	contentContainer: 'ValidacionProspectosCuentasCobrarM', 
							                              	zIndex: 2, 
							                              	modalClose: false, 
							                              	modal: true, 
							                              	follow: [true,false], 
							                              	followEasing : "linear", 
							                              	easing: "linear", 
							                             	modalColor: ('#F0F0F0')});
			//Enfocar caja de texto 
			$('#txtMensaje_rechazo_validacion_prospectos_cuentas_cobrar').focus();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_rechazo_validacion_prospectos_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objRechazoValidacionProspectosCuentasCobrar.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_validacion_prospectos_cuentas_cobrar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_rechazo_validacion_prospectos_cuentas_cobrar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_rechazo_validacion_prospectos_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmRechazoValidacionProspectosCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_rechazo_validacion_prospectos_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba un motivo'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_rechazo_validacion_prospectos_cuentas_cobrar = $('#frmRechazoValidacionProspectosCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_rechazo_validacion_prospectos_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_rechazo_validacion_prospectos_cuentas_cobrar.isValid())
			{
				//Hacer un llamado a la función para cambiar el estatus del registro 
				cambiar_estatus_rechazo_validacion_prospectos_cuentas_cobrar();
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_rechazo_validacion_prospectos_cuentas_cobrar()
		{
			try
			{
				$('#frmRechazoValidacionProspectosCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_rechazo_validacion_prospectos_cuentas_cobrar() 
		{
			//Hacer un llamado al método del controlador para cambiar el estatus a RECHAZADO
			$.post('cuentas_cobrar/validacion_prospectos/set_estatus',
					{ 
						intProspectoID: $('#txtProspectoID_rechazo_validacion_prospectos_cuentas_cobrar').val(),
						strMensaje: $('#txtMensaje_rechazo_validacion_prospectos_cuentas_cobrar').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_validacion_prospectos_cuentas_cobrar();
							//Hacer un llamado a la función para cerrar modal
							cerrar_rechazo_validacion_prospectos_cuentas_cobrar();   
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_validacion_prospectos_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		/*******************************************************************************************************************
		Funciones del modal Validación de Prospectos
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_validacion_prospectos_cuentas_cobrar()
		{
			//Incializar formulario
			$('#frmValidacionProspectosCuentasCobrar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_validacion_prospectos_cuentas_cobrar();
			//Limpiar cajas de texto ocultas
			$('#frmValidacionProspectosCuentasCobrar').find('input[type=hidden]').val('');
			//Seleccionar tab que contiene la información general
		    $('a[href="#informacion_general_validacion_prospectos_cuentas_cobrar"]').click();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_validacion_prospectos_cuentas_cobrar()
		{
			try {
				//Cerrar modal
				objValidacionProspectosCuentasCobrar.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_validacion_prospectos_cuentas_cobrar').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_validacion_prospectos_cuentas_cobrar(tipoAccion)
		{			
			//Asignar el tipo de acción para validar los campos obligatorios
			$('#txtTipoAccion_validacion_prospectos_cuentas_cobrar').val(tipoAccion);

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_validacion_prospectos_cuentas_cobrar();
			//Validación del formulario de campos obligatorios
			$('#frmValidacionProspectosCuentasCobrar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strRazonSocial_validacion_prospectos_cuentas_cobrar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista razón social cuando el tipo de acción sea autorizar	                                   
					                                    if(value === '' && $('#txtTipoAccion_validacion_prospectos_cuentas_cobrar').val() === 'Autorizar')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una razón social'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},									
										strTipoPersona_general_validacion_cuentas_cobrar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field){  
					                                    //Verificar si tiene selecionado un valor
					                                    if($('#cmbTipoPersona_general_validacion_cuentas_cobrar').val() == 0)
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Seleccione un tipo de persona'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strTelefonoPrincipal_validacion_prospectos_cuentas_cobrar: {
											validators: {
												notEmpty: {message: 'Escriba un número telefónico'},
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strTelefonoSecundario_validacion_prospectos_cuentas_cobrar: {
											validators: {
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strCalle_validacion_prospectos_cuentas_cobrar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista calle cuando el tipo de acción sea autorizar
					                                    if(value === '' && $('#txtTipoAccion_validacion_prospectos_cuentas_cobrar').val() === 'Autorizar')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una calle'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strNumeroExterior_validacion_prospectos_cuentas_cobrar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista número exterior cuando el tipo de acción sea autorizar
					                                    if(value === '' && $('#txtTipoAccion_validacion_prospectos_cuentas_cobrar').val() === 'Autorizar')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un número exterior'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCodigoPostal_validacion_prospectos_cuentas_cobrar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal cuando el tipo de acción sea autorizar
					                                    if($('#txtTipoAccion_validacion_prospectos_cuentas_cobrar').val() === 'Autorizar' && $('#txtCodigoPostalID_validacion_prospectos_cuentas_cobrar').val() === '')
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
										strColonia_validacion_prospectos_cuentas_cobrar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista colonia cuando el tipo de acción sea autorizar
					                                    if(value === '' && $('#txtTipoAccion_validacion_prospectos_cuentas_cobrar').val() === 'Autorizar')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una colonia'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strMunicipio_validacion_prospectos_cuentas_cobrar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id del municipio
					                                    if($('#txtTipoAccion_validacion_prospectos_cuentas_cobrar').val() === 'Autorizar' && $('#txtMunicipioID_validacion_prospectos_cuentas_cobrar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un municipio existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCorreoElectronico_validacion_prospectos_cuentas_cobrar: {
				                        	validators: {
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strContactoTelefono_validacion_prospectos_cuentas_cobrar: {
											validators: {
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strContactoCelular_validacion_prospectos_cuentas_cobrar: {
											validators: {
												stringLength: {
													min: 10,
													message: 'El número de celular debe tener 10 caracteres de longitud'
												}
											}
										},
										strContactoCorreoElectronico_validacion_prospectos_cuentas_cobrar: {
				                        	validators: {
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    }
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_validacion_prospectos_cuentas_cobrar = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_validacion_prospectos_cuentas_cobrar = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_validacion_prospectos_cuentas_cobrar.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_validacion_prospectos_cuentas_cobrar.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_validacion_prospectos_cuentas_cobrar = $('#frmValidacionProspectosCuentasCobrar').data('bootstrapValidator');
			bootstrapValidator_validacion_prospectos_cuentas_cobrar.validate();
			//Si se cumplen las reglas de validación		
			if(bootstrapValidator_validacion_prospectos_cuentas_cobrar.isValid())
			{
				
				//Hacer un llamado a la función para modificar los datos del registro
				modificar_validacion_prospectos_cuentas_cobrar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_validacion_prospectos_cuentas_cobrar()
		{
			try
			{
				$('#frmValidacionProspectosCuentasCobrar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para modificar los datos de un registro
		function modificar_validacion_prospectos_cuentas_cobrar()
		{
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatusValidacionProspectosCuentasCobrar = 'VALIDACION';			
			//Si el tipo de acción es Autorizar cambiar el estatus del registro
			if($('#txtTipoAccion_validacion_prospectos_cuentas_cobrar').val() == 'Autorizar')
			{
				strEstatusValidacionProspectosCuentasCobrar = 'ACTIVO';
			}

			//Hacer un llamado al método del controlador para modificar los datos del registro
			$.post('cuentas_cobrar/validacion_prospectos/modificar',
					{ 
						intProspectoID: $('#txtProspectoID_validacion_prospectos_cuentas_cobrar').val(),
						strRazonSocial: $('#txtRazonSocial_validacion_prospectos_cuentas_cobrar').val(),
						strRfc: $('#txtRfc_validacion_prospectos_cuentas_cobrar').val(),
						strTipoPersona: $('#cmbTipoPersona_general_validacion_cuentas_cobrar').val(),
						strNombreComercial: $('#txtNombreComercial_validacion_prospectos_cuentas_cobrar').val(),
						strRepresentanteLegal: $('#txtRepresentanteLegal_validacion_prospectos_cuentas_cobrar').val(),
						strTelefonoPrincipal: $('#txtTelefonoPrincipal_validacion_prospectos_cuentas_cobrar').val(),
						strTelefonoSecundario: $('#txtTelefonoSecundario_validacion_prospectos_cuentas_cobrar').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_validacion_prospectos_cuentas_cobrar').val(),
						strCalle: $('#txtCalle_validacion_prospectos_cuentas_cobrar').val(),
						strNumeroExterior: $('#txtNumeroExterior_validacion_prospectos_cuentas_cobrar').val(),
						strNumeroInterior: $('#txtNumeroInterior_validacion_prospectos_cuentas_cobrar').val(),
						intCodigoPostalID: $('#txtCodigoPostalID_validacion_prospectos_cuentas_cobrar').val(),
						strColonia: $('#txtColonia_validacion_prospectos_cuentas_cobrar').val(),
						strLocalidad: $('#txtLocalidad_validacion_prospectos_cuentas_cobrar').val(),
						strReferencia: $('#txtReferencia_validacion_prospectos_cuentas_cobrar').val(),
						intMunicipioID: $('#txtMunicipioID_validacion_prospectos_cuentas_cobrar').val(),
						strContactoNombre: $('#txtContactoNombre_validacion_prospectos_cuentas_cobrar').val(),
						strContactoTelefono: $('#txtContactoTelefono_validacion_prospectos_cuentas_cobrar').val(),
						strContactoExtension: $('#txtContactoExtension_validacion_prospectos_cuentas_cobrar').val(),
						strContactoCelular: $('#txtContactoCelular_validacion_prospectos_cuentas_cobrar').val(),
						strContactoCorreoElectronico: $('#txtContactoCorreoElectronico_validacion_prospectos_cuentas_cobrar').val(),
						strEstatus: strEstatusValidacionProspectosCuentasCobrar
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_validacion_prospectos_cuentas_cobrar();
							//Hacer un llamado a la función para cerrar modal
							cerrar_validacion_prospectos_cuentas_cobrar();   
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_validacion_prospectos_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_validacion_prospectos_cuentas_cobrar(tipoMensaje, mensaje)
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
		function editar_validacion_prospectos_cuentas_cobrar(id)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_cobrar/validacion_prospectos/get_datos',
			       {
			       	intProspectoID: id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_validacion_prospectos_cuentas_cobrar();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				          	//Recuperar valores
				            $('#txtProspectoID_validacion_prospectos_cuentas_cobrar').val(data.row.prospecto_id);
				            $('#txtCodigo_validacion_prospectos_cuentas_cobrar').val(data.row.codigo);
				            $('#txtRazonSocial_validacion_prospectos_cuentas_cobrar').val(data.row.razon_social);
				            $('#txtRfc_validacion_prospectos_cuentas_cobrar').val(data.row.rfc);
				            $('#cmbTipoPersona_general_validacion_cuentas_cobrar').val(data.row.tipo_persona);
						    $('#txtNombreComercial_validacion_prospectos_cuentas_cobrar').val(data.row.nombre_comercial);
						    $('#txtRepresentanteLegal_validacion_prospectos_cuentas_cobrar').val(data.row.representante_legal);
						    $('#txtTelefonoPrincipal_validacion_prospectos_cuentas_cobrar').val(data.row.telefono_principal);
						    $('#txtTelefonoSecundario_validacion_prospectos_cuentas_cobrar').val(data.row.telefono_secundario);
						    $('#txtCorreoElectronico_validacion_prospectos_cuentas_cobrar').val(data.row.correo_electronico);
						    $('#txtCalle_validacion_prospectos_cuentas_cobrar').val(data.row.calle);
						    $('#txtNumeroExterior_validacion_prospectos_cuentas_cobrar').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_validacion_prospectos_cuentas_cobrar').val(data.row.numero_interior);
						    $('#txtCodigoPostalID_validacion_prospectos_cuentas_cobrar').val(data.row.codigo_postal_id);
						    $('#txtCodigoPostal_validacion_prospectos_cuentas_cobrar').val(data.row.codigo_postal);
						    $('#txtColonia_validacion_prospectos_cuentas_cobrar').val(data.row.colonia);
						    $('#txtLocalidad_validacion_prospectos_cuentas_cobrar').val(data.row.localidad);
						    $('#txtMunicipioID_validacion_prospectos_cuentas_cobrar').val(data.row.municipio_id);
						    $('#txtMunicipio_validacion_prospectos_cuentas_cobrar').val(data.row.municipio);
						    $('#txtEstado_validacion_prospectos_cuentas_cobrar').val(data.row.estado);
						    $('#txtPais_validacion_prospectos_cuentas_cobrar').val(data.row.pais);
						    $('#txtReferencia_validacion_prospectos_cuentas_cobrar').val(data.row.referencia);
						    $('#txtContactoNombre_validacion_prospectos_cuentas_cobrar').val(data.row.contacto_nombre);
						    $('#txtContactoTelefono_validacion_prospectos_cuentas_cobrar').val(data.row.contacto_telefono);
						    $('#txtContactoExtension_validacion_prospectos_cuentas_cobrar').val(data.row.contacto_extension);
						    $('#txtContactoCelular_validacion_prospectos_cuentas_cobrar').val(data.row.contacto_celular);
						    $('#txtContactoCorreoElectronico_validacion_prospectos_cuentas_cobrar').val(data.row.contacto_correo_electronico);
						    $('#txtEstatus_validacion_prospectos_cuentas_cobrar').val(strEstatus);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_validacion_prospectos_cuentas_cobrar').addClass("estatus-"+strEstatus);

				            //Hacer llamado a la función  para cargar los documentos activos en el grid
				            documentos_expediente_validacion_prospectos_cuentas_cobrar();
			            	//Abrir modal
				            objValidacionProspectosCuentasCobrar = $('#ValidacionProspectosCuentasCobrarBox').bPopup({
														  appendTo: '#ValidacionProspectosCuentasCobrarContent', 
							                              contentContainer: 'ValidacionProspectosCuentasCobrarM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtRazonSocial_validacion_prospectos_cuentas_cobrar').focus();
					        
			       	    }
			       },
			       'json');
		}

		//Función que se utiliza para copiar los datos del prospecto
		function copiar_validacion_prospectos_cuentas_cobrar()
		{	
			//Asignar valores del prospecto a los datos del contacto
			$('#txtContactoNombre_validacion_prospectos_cuentas_cobrar').val(document.getElementById("txtNombreComercial_validacion_prospectos_cuentas_cobrar").value);
	        $('#txtContactoTelefono_validacion_prospectos_cuentas_cobrar').val(document.getElementById("txtTelefonoPrincipal_validacion_prospectos_cuentas_cobrar").value);
	        $('#txtContactoCelular_validacion_prospectos_cuentas_cobrar').val(document.getElementById("txtTelefonoSecundario_validacion_prospectos_cuentas_cobrar").value);
	        $('#txtContactoCorreoElectronico_validacion_prospectos_cuentas_cobrar').val(document.getElementById("txtCorreoElectronico_validacion_prospectos_cuentas_cobrar").value);
		}

		/*******************************************************************************************************************
		Funciones del Tab - Expediente
		*********************************************************************************************************************/
		//Función para la búsqueda de documentos activos
		function documentos_expediente_validacion_prospectos_cuentas_cobrar() 
		{
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/documentos_clientes/get_activos',
					{	strTipo: 'Cliente',
						intID: $('#txtProspectoID_validacion_prospectos_cuentas_cobrar').val(),
						strEstatus: $('#txtEstatus_validacion_prospectos_cuentas_cobrar').val(),
						strPermisosAcceso: $('#txtAcciones_validacion_prospectos_cuentas_cobrar').val()
					},
					function(data){
						$('#dg_expediente_validacion_prospectos_cuentas_cobrar tbody').empty();
						var tmpExpedienteClientesCuentasCobrar = Mustache.render($('#plantilla_expediente_validacion_prospectos_cuentas_cobrar').html(),data);
						$('#dg_expediente_validacion_prospectos_cuentas_cobrar tbody').html(tmpExpedienteClientesCuentasCobrar);
						$('#numElementos_expediente_validacion_prospectos_cuentas_cobrar').html(data.total_rows);
					},
			'json');
		}

		//Función para subir archivo (o imagen) de un registro desde el grid view
		function subir_archivo_expediente_validacion_prospectos_cuentas_cobrar(documentoID)
		{
			//Variable que se utiliza para asignar archivo
			var strBotonArchivoIDExpedienteClientesCuentasCobrar="archivo_validacion_prospectos_cuentas_cobrar"+documentoID;
			//Obtenemos un array con los datos del archivo
	        var file = $("#"+strBotonArchivoIDExpedienteClientesCuentasCobrar)[0].files[0];
	        //Variable que se utiliza para asignar la extensión del archivo seleccionado
   			var fileExtension = "";
	        //Obtenemos el nombre del archivo
	        var fileName = file.name;
	        //Obtenemos la extensión del archivo
	        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
	        //Obtenemos el tamaño del archivo
	        var fileSize = file.size;
	        //Obtenemos el tipo de archivo image/png ejemplo
	        var fileType = file.type;

	        //Comprobar extensión del archivo
	        $.post('cuentas_cobrar/clientes/comprobar_extension_archivo',
				     {strExtension: fileExtension
				     },
				     function(data) {
					    //Si el tipo de mensaje es un error
						if(data.tipo_mensaje == 'error')
						{
							//Limpia ruta del archivo cargado
			  				$('#'+strBotonArchivoIDExpedienteClientesCuentasCobrar).val('');
						   	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_validacion_prospectos_cuentas_cobrar('error', data.mensaje);
						}
						else
						{	
							//Hacer un llamado al método del controlador para subir archivo del registro
							$('#'+strBotonArchivoIDExpedienteClientesCuentasCobrar).upload('cuentas_cobrar/clientes/subir_archivo',
									{ intDocumentoID:documentoID,
						      		  intProspectoID:$('#txtProspectoID_validacion_prospectos_cuentas_cobrar').val(),
						      		  strBotonArchivoID: strBotonArchivoIDExpedienteClientesCuentasCobrar
									},
									function(data) {
										//Limpia ruta del archivo cargado
						         		$('#'+strBotonArchivoIDExpedienteClientesCuentasCobrar).val('');
										//Subida finalizada.
										if (data.resultado)
										{
						         			//Hacer llamado a la función  para cargar  los registros de los documentos (expediente) en el grid
						          	        documentos_expediente_validacion_prospectos_cuentas_cobrar();
										}
										//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
										mensaje_validacion_prospectos_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
									});
						}
				     },
				     'json');
		}

		//Función que se utiliza para descargar el archivo (o imagen) del registro seleccionado
		function descargar_archivo_expediente_validacion_prospectos_cuentas_cobrar(documentoID)
		{
			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'cuentas_cobrar/clientes/descargar_archivo',
							'data' : {
										'intProspectoID': $('#txtProspectoID_validacion_prospectos_cuentas_cobrar').val(),
										'intDocumentoID': documentoID				
									 }
						   };

			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

		}


		//Función que se utiliza para eliminar el archivo (o imagen) del registro seleccionado
		function eliminar_archivo_expediente_validacion_prospectos_cuentas_cobrar(documentoID)
		{
			//Hacer un llamado al método del controlador para eliminar el archivo del registro
			$.post('cuentas_cobrar/clientes/eliminar_archivo',
			     {intProspectoID: $('#txtProspectoID_validacion_prospectos_cuentas_cobrar').val(),
			      intDocumentoID: documentoID
			     },
			     function(data) {
			        if(data.resultado)
			        {
			         	//Hacer llamado a la función  para cargar  los registros de los documentos (expediente) en el grid
		          	    documentos_expediente_validacion_prospectos_cuentas_cobrar();
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_validacion_prospectos_cuentas_cobrar(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Validación de Prospectos
			*********************************************************************************************************************/
			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Información General
        	*********************************************************************************************************************/
        	//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtCodigoPostal_validacion_prospectos_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtTelefonoPrincipal_validacion_prospectos_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtTelefonoSecundario_validacion_prospectos_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtContactoTelefono_validacion_prospectos_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtContactoCelular_validacion_prospectos_cuentas_cobrar').numeric({decimal: false, negative: false});
        	$('#txtContactoExtension_validacion_prospectos_cuentas_cobrar').numeric({decimal: false, negative: false});
        	
			//Autocomplete para recuperar los datos de un código postal 
	        $('#txtCodigoPostal_validacion_prospectos_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCodigoPostalID_validacion_prospectos_cuentas_cobrar').val('');
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
	             $('#txtCodigoPostalID_validacion_prospectos_cuentas_cobrar').val(ui.item.data);
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
	        $('#txtCodigoPostal_validacion_prospectos_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del código postal
	            if($('#txtCodigoPostalID_validacion_prospectos_cuentas_cobrar').val() == '' ||
	               $('#txtCodigoPostal_validacion_prospectos_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtCodigoPostalID_validacion_prospectos_cuentas_cobrar').val('');
	               $('#txtCodigoPostal_validacion_prospectos_cuentas_cobrar').val('');
	            }
	            
	        });

			//Autocomplete para recuperar los datos de un municipio 
	        $('#txtMunicipio_validacion_prospectos_cuentas_cobrar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtMunicipioID_validacion_prospectos_cuentas_cobrar').val('');
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
	             $('#txtMunicipioID_validacion_prospectos_cuentas_cobrar').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/municipios/get_datos',
	                  { 
	                  	strBusqueda:$("#txtMunicipioID_validacion_prospectos_cuentas_cobrar").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtMunicipio_validacion_prospectos_cuentas_cobrar").val(data.row.municipio);
	                       $("#txtEstado_validacion_prospectos_cuentas_cobrar").val(data.row.estado);
	                       $("#txtPais_validacion_prospectos_cuentas_cobrar").val(data.row.pais);
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
	        
	         //Verificar que exista id del municipio cuando pierda el enfoque la caja de texto
	        $('#txtMunicipio_validacion_prospectos_cuentas_cobrar').focusout(function(e){
	            //Si no existe id del municipio
	            if($('#txtMunicipioID_validacion_prospectos_cuentas_cobrar').val() == '' || 
	            	$('#txtMunicipio_validacion_prospectos_cuentas_cobrar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMunicipioID_validacion_prospectos_cuentas_cobrar').val('');
	               $('#txtMunicipio_validacion_prospectos_cuentas_cobrar').val('');
	               $('#txtEstado_validacion_prospectos_cuentas_cobrar').val('');
	               $('#txtPais_validacion_prospectos_cuentas_cobrar').val('');
	            }
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_validacion_prospectos_cuentas_cobrar').on('click','a',function(event){
				event.preventDefault();
				intPaginaValidacionProspectosCuentasCobrar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_validacion_prospectos_cuentas_cobrar();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_validacion_prospectos_cuentas_cobrar').focus();

			//Deshabilitar los siguientes botones (funciones de permisos de acceso)
			$('#btnImprimir_validacion_prospectos_cuentas_cobrar').attr('disabled','-1');
			$('#btnDescargarXLS_validacion_prospectos_cuentas_cobrar').attr('disabled','-1');
			$('#btnBuscar_validacion_prospectos_cuentas_cobrar').attr('disabled','-1');
			$('#btnGuardar_validacion_prospectos_cuentas_cobrar').attr('disabled','-1'); 
			$('#btnAutorizar_validacion_prospectos_cuentas_cobrar').attr('disabled','-1');   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_validacion_prospectos_cuentas_cobrar();
		});
	</script>