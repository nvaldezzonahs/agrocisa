	<div id="ProspectosCRMContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_prospectos_crm" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_prospectos_crm" 
								   name="strBusqueda_prospectos_crm"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_prospectos_crm"
										onclick="paginacion_prospectos_crm();" 
										title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_prospectos_crm" 
									   name="strImprimirDetalles_prospectos_crm" type="checkbox"
									   value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_prospectos_crm" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_prospectos_crm"
									onclick="reporte_prospectos_crm('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print" disabled></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_prospectos_crm"
									onclick="reporte_prospectos_crm('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla prospectos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Nombre"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Contacto"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Localidad"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla inventario
				*/
				td.movil.b1:nth-of-type(1):before {content: "Descripción"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Marca"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Modelo"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Año"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla actividades
				*/
				td.movil.c1:nth-of-type(1):before {content: "Actividad"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla cultivos
				*/
				td.movil.d1:nth-of-type(1):before {content: "Cultivo"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "No. Hectáreas"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}


				/*
				Definir columnas de la tabla visitas
				*/
				td.movil.e1:nth-of-type(1):before {content: "Fecha"; font-weight: bold;}
				td.movil.e2:nth-of-type(2):before {content: "Próxima"; font-weight: bold;}
				td.movil.e3:nth-of-type(3):before {content: "Módulo"; font-weight: bold;}
				td.movil.e5:nth-of-type(4):before {content: "Comentario"; font-weight: bold;}
				td.movil.e6:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla documentos
				*/
				td.movil.f1:nth-of-type(1):before {content: "Documento"; font-weight: bold;}
				td.movil.f2:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}

			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_prospectos_crm">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Nombre</th>
							<th class="movil">Contacto</th>
							<th class="movil">Localidad</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_prospectos_crm" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil a1">{{codigo}}</td>
							<td class="movil a2">{{nombre_comercial}}</td>
							<td class="movil a3">{{contacto_nombre}}</td>
							<td class="movil a4">{{localidad}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="td-center movil a6"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_prospectos_crm({{prospecto_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_prospectos_crm({{prospecto_id}},'Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Enviar a validación-->
								<button class="btn btn-default btn-xs {{mostrarAccionValidacion}}"  
										onclick="enviar_validacion_prospectos_crm({{prospecto_id}}, '{{cliente_estatus}}', '{{codigo}}', '{{nombre_comercial}}');"  title="Enviar a validación">
									<span class="glyphicon glyphicon-share-alt"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_prospectos_crm({{prospecto_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_prospectos_crm({{prospecto_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_prospectos_crm"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_prospectos_crm">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Enviar a Validación-->
		<div id="ValidacionProspectosCRMBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_validacion_prospectos_crm" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar a Validación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmValidacionProspectosCRM" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmValidacionProspectosCRM"  onsubmit="return(false)" autocomplete="off">
			    	<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReferenciaID_validacion_prospectos_crm" 
										   name="intReferenciaID_validacion_prospectos_crm" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Prospectos-->
									<input id="txtModalProspectos_validacion_prospectos_crm" 
										   name="strModalProspectos_validacion_prospectos_crm" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus del cliente 
										 del registro seleccionado-->
									<input id="txtEstatusCliente_validacion_prospectos_crm" 
										   name="strEstatusCliente_validacion_prospectos_crm" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para asignar a los usuarios que se les enviará 
									     el mensaje--> 
									<input type="hidden" id="txtUsuarios_validacion_prospectos_crm" 
										   name="strUsuarios_validacion_prospectos_crm" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Enviar notificación a:</h4>
										</div>
										<div class="panel-body">
											<div id="treeUsuarios_validacion_prospectos_crm" class="md-list-item-text"></div>
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
									<label for="txtMensaje_validacion_prospectos_crm">Mensaje</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtMensaje_validacion_prospectos_crm" 
											   name="strMensaje_validacion_prospectos_crm" rows="5" value="" tabindex="1" placeholder="Ingrese mensaje" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar a validación-->
							<button class="btn btn-success" id="btnGuardar_validacion_prospectos_crm"  
									onclick="validar_validacion_prospectos_crm();"  title="Enviar" tabindex="2">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_validacion_prospectos_crm"
									type="reset" aria-hidden="true" onclick="cerrar_validacion_prospectos_crm();" 
									title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar a Validación-->

		<!-- Diseño del modal Prospectos-->
		<div id="ProspectosCRMBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_prospectos_crm" class="ModalBodyTitle">
				<h1>Prospectos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_prospectos_crm" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_prospectos_crm" class="active">
									<a data-toggle="tab" href="#informacion_general_prospectos_crm">Información General</a>
								</li>
								<!--Tab que contiene la información del inventario-->
								<li id="tabInventario_prospectos_crm">
									<a data-toggle="tab" href="#inventario_prospectos_crm">Inventario</a>
								</li>
								<!--Tab que contiene la información de las hectáreas, actividades y cultivos-->
								<li id="tabOtros_prospectos_crm">
									<a data-toggle="tab" href="#otros_prospectos_crm">Otros</a>
								</li>
								<!--Tab que contiene la información del expediente-->
								<li id="tabExpediente_prospectos_crm" class="disabled disabledTab">
									<a data-toggle="tab" href="#expediente_prospectos_crm">Expediente</a>
								</li>
								<!--Tab que contiene la información de las visitas-->
								<li id="tabVisitas_prospectos_crm" class="disabled disabledTab">
									<a data-toggle="tab" href="#visitas_prospectos_crm">Visitas</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmProspectosCRM" method="post" action="#" class="form-horizontal" role="form" name="frmProspectosCRM" 
					  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_prospectos_crm" class="tab-pane fade in active">
							<div class="row">
								<!--Código-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtProspectoID_prospectos_crm" 
												   name="intProspectoID_prospectos_crm" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
											<input id="txtEstatus_prospectos_crm" 
												   name="strEstatus_prospectos_crm" 
												   type="hidden" value="">
											</input>
											<!--Caja de texto oculta que se utiliza para recuperar el estatus del cliente (en caso de que el prospecto se encuentre en la tabla clientes)-->
											<input id="txtEstatusCliente_prospectos_crm" 
												   name="strEstatusCliente_prospectos_crm" 
												   type="hidden" value="">
											</input>
											<label for="txtCodigo_prospectos_crm">Código</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigo_prospectos_crm" 
													name="strCodigo_prospectos_crm" type="text" value="" 
													placeholder="Autogenerado" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Nombre comercial-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNombreComercial_prospectos_crm">Nombre comercial</label>
										</div>
										<div class="col-md-12">
											<input 	class="form-control" 
													id="txtNombreComercial_prospectos_crm"
												   	name="strNombreComercial_prospectos_crm" 
												   	type="text" value="" tabindex="1" 
												   	placeholder="Ingrese nombre comercial" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Teléfonos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                          			<!--Div que contiene los campos de los teléfonos-->
		                            <div class="form-group row">
		                                <!--Etiqueta del encabezado-->
		                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		                                    <label for="txtTelefonoPrincipal_prospectos_crm">Teléfonos</label>
		                                </div>
		                                <!--Teléfono principal-->
		                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		                                    <input  class="form-control" id="txtTelefonoPrincipal_prospectos_crm" 
		                                     		name="strTelefonoPrincipal_prospectos_crm" 
		                                     		type="text" value="" tabindex="1" placeholder="Principal" maxlength="10">
		                                    </input>
		                                </div>
		                                <!--Teléfono secundario-->
		                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		                                    <input  class="form-control" id="txtTelefonoSecundario_prospectos_crm" 
		                                      		name="strTelefonoSecundario_prospectos_crm" 
		                                      		type="text" value="" tabindex="1" placeholder="Secundario" maxlength="10">
		                                	</input>
		                                </div>
		                            </div>
                          		</div>
							</div>
							<div class="row">
								<!--Correo electrónico-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCorreoElectronico_prospectos_crm">Correo electrónico</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtCorreoElectronico_prospectos_crm"
												   name="strCorreoElectronico_prospectos_crm" 
												   type="text" value="" tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Página Web-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPaginaWeb_prospectos_crm">Página Web</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtPaginaWeb_prospectos_crm"
												   name="strPaginaWeb_prospectos_crm" 
												   type="text" value="" tabindex="1" placeholder="Ingrese página Web" maxlength="50">
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
											<label for="txtCalle_prospectos_crm">Calle</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCalle_prospectos_crm" 
													name="strCalle_prospectos_crm" type="text" value="" 
													tabindex="1" placeholder="Ingrese calle" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Número exterior-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNumeroExterior_prospectos_crm">Número exterior</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNumeroExterior_prospectos_crm" 
													name="strNumeroExterior_prospectos_crm" type="text" value="" 
													tabindex="1" placeholder="Ingrese número" maxlength="10">
											</input>
										</div>
									</div>
								</div>
								<!--Número interior-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNumeroInterior_prospectos_crm">Número interior</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNumeroInterior_prospectos_crm" 
													name="strNumeroInterior_prospectos_crm" type="text" value="" 
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
											<input id="txtCodigoPostalID_prospectos_crm" 
											       name="intCodigoPostalID_prospectos_crm" type="hidden" value="">
											</input>
											<label for="txtCodigoPostal_prospectos_crm">Código postal</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCodigoPostal_prospectos_crm" 
													name="strCodigoPostal_prospectos_crm" type="text" value="" 
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
											<label for="txtColonia_prospectos_crm">Colonia</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtColonia_prospectos_crm" 
													name="strColonia_prospectos_crm" type="text" value="" 
													tabindex="1" placeholder="Ingrese colonia" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las localidades activas-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la localidad seleccionada-->
											<input id="txtLocalidadID_prospectos_crm" 
											       name="intLocalidadID_prospectos_crm" type="hidden" value="">
											</input>
											<label for="txtLocalidad_prospectos_crm">Localidad</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtLocalidad_prospectos_crm" 
													name="strLocalidad_prospectos_crm" type="text" value="" 
													tabindex="1" placeholder="Ingrese localidad" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Referencia-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtReferencia_prospectos_crm">Referencia</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtReferencia_prospectos_crm" 
													name="strReferencia_prospectos_crm" type="text" value="" 
													tabindex="1" placeholder="Ingrese referencia" maxlength="50">
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
											<input id="txtMunicipioID_prospectos_crm" 
												   name="intMunicipioID_prospectos_crm" type="hidden" value="">
											</input>
											<label for="txtMunicipio_prospectos_crm">Municipio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMunicipio_prospectos_crm" 
													name="strMunicipio_prospectos_crm" type="text" 
													value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Estado-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtEstado_prospectos_crm">Estado</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtEstado_prospectos_crm" 
													name="strEstado_prospectos_crm" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--País-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPais_prospectos_crm">País</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPais_prospectos_crm" 
													name="strPais_prospectos_crm" type="text" value="" disabled>
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
		                            <button class="btn btn-copy pull-right" type="button" id="btnCopiar_prospectos_crm" onclick="copiar_prospectos_crm();" title="Copiar datos del prospecto"><span class="fa fa-files-o"></span></button> 
		                        </div>
		                    </div>
		                    <div class="row">
                       			<!--Nombre-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoNombre_prospectos_crm">Nombre</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtContactoNombre_prospectos_crm" 
													name="strContactoNombre_prospectos_crm" type="text" value="" 
													tabindex="1" placeholder="Ingrese nombre" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Fecha de nacimiento-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoFechaNacimiento_prospectos_crm">Fecha de nacimiento</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteContactoFechaNacimiento_prospectos_crm'>
							                    <input class="form-control" id="txtContactoFechaNacimiento_prospectos_crm"
							                    		name= "strContactoFechaNacimiento_prospectos_crm" 
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
	                       		<!--Teléfonos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
	                      			<!--Div que contiene los campos de los teléfonos-->
		                            <div class="form-group row">
		                                <!--Etiqueta del encabezado-->
		                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		                                    <label for="txtContactoTelefono_prospectos_crm">Teléfonos</label>
		                                </div>
		                                <!--Teléfono de oficina-->
		                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		                                    <input  class="form-control" id="txtContactoTelefono_prospectos_crm" 
		                                     		name="strContactoTelefono_prospectos_crm" 
		                                     		type="text" value="" tabindex="1" placeholder="Oficina" maxlength="10">
		                                    </input>
		                                </div>
		                                <!--Celular-->
		                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		                                    <input  class="form-control" id="txtContactoCelular_prospectos_crm" 
		                                      		name="strContactoCelular_prospectos_crm" 
		                                      		type="text" value="" tabindex="1" placeholder="Celular" maxlength="10">
		                                	</input>
		                                </div>
		                            </div>
	                      		</div>
	                      		<!--Extensión-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoExtension_prospectos_crm">Extensión</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtContactoExtension_prospectos_crm" 
													name="strContactoExtension_prospectos_crm" type="text" value="" 
													tabindex="1" placeholder="Ingrese extensión" maxlength="5">
											</input>
										</div>
									</div>
								</div>
								<!--Correo electrónico-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoCorreoElectronico_prospectos_crm">Correo electrónico</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtContactoCorreoElectronico_prospectos_crm"
												   name="strContactoCorreoElectronico_prospectos_crm" 
												   type="text" value="" tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtContactoHobbies_prospectos_crm">Hobbies</label>
										</div>
										<div class="col-sm-12">
											<textarea  class="form-control" id="txtContactoHobbies_prospectos_crm" 
											 name="strContactoHobbies_prospectos_crm" rows="3"  value=""  tabindex="1" placeholder="Ingrese hobbies" maxlength="250"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Información General-->
						<!--Tab - Inventario-->
						<div id="inventario_prospectos_crm" class="tab-pane fade">
							<div class="row">
								<!--Botón para mostrar datos del inventario-->
                              	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                	<button class="btn btn-show  pull-right" 
                                			id="btnMostrar_inventario_prospectos_crm" 
                                			onclick="mostrar_campos_inventario_prospectos_crm();" 
                                	     	title="Mostrar datos del inventario" tabindex="1"> 
                                		<span class="glyphicon glyphicon-eye-open"></span>
                                	</button>
                             	</div>
                             	<!--Botón para ocultar datos del inventario-->
                              	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                	<button class="btn btn-show pull-right no-mostrar" 
                                			id="btnOcultar_inventario_prospectos_crm" 
                                			onclick="ocultar_campos_inventario_prospectos_crm();" 
                                	     	title="Ocultar datos del inventario" tabindex="1"> 
                                		<span class="glyphicon glyphicon-eye-close"></span>
                                	</button>
                             	</div>
							</div>
							<br>
							<!--Div que contiene los datos del inventario-->
							<div id="divDatos_inventario_prospectos_crm" class="no-mostrar">
								<div class="row">
									<!--Descripción-->
									<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="txtDescripcion_inventario_prospectos_crm">Descripción</label>
											</div>
											<div class="col-md-12">
												<input class="form-control" id="txtDescripcion_inventario_prospectos_crm"
													   name="strDescripcion_inventario_prospectos_crm" 
													   type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="50">
												</input>
											</div>
										</div>
									</div>
									<!--Año-->
									<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="txtAnio_inventario_prospectos_crm">Año</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" id="txtAnio_inventario_prospectos_crm" 
														name="strAnio_inventario_prospectos_crm" type="number" value=""
														tabindex="1" placeholder="Ingrese año" maxlength="4">
												</input>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<!--Serie-->
									<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="txtSerie_inventario_prospectos_crm">Serie</label>
											</div>
											<div class="col-md-12">
												<input class="form-control" id="txtSerie_inventario_prospectos_crm"
													   name="strSerie_inventario_prospectos_crm" 
													   type="text" value="" tabindex="1" placeholder="Ingrese serie" maxlength="30">
												</input>
											</div>
										</div>
									</div>
									<!--Marca-->
									<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<!-- Caja de texto oculta que se utiliza para recuperar el id de la marca de maquinaria seleccionada-->
												<input id="txtMaquinariaMarcaID_inventario_prospectos_crm" 
													   name="intMaquinariaMarcaID_inventario_prospectos_crm"  
													   type="hidden" value="">
											    </input>
												<label for="txtMaquinariaMarca_inventario_prospectos_crm">Marca</label>
											</div>
											<div class="col-md-12">
												<input class="form-control" id="txtMaquinariaMarca_inventario_prospectos_crm"
													   name="strMaquinariaMarca_inventario_prospectos_crm" 
													   type="text" value="" tabindex="1" placeholder="Ingrese marca" maxlength="250">
												</input>
											</div>
										</div>
									</div>
									<!--Modelo-->
									<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<!-- Caja de texto oculta que se utiliza para recuperar el id del modelo de maquinaria seleccionado-->
												<input id="txtMaquinariaModeloID_inventario_prospectos_crm" 
													   name="intMaquinariaModeloID_inventario_prospectos_crm"  
													   type="hidden" value="">
											    </input>
												<label for="txtMaquinariaModelo_inventario_prospectos_crm">Modelo</label>
											</div>
											<div class="col-md-12">
												<input class="form-control" id="txtMaquinariaModelo_inventario_prospectos_crm"
													   name="strMaquinariaModelo_inventario_prospectos_crm" 
													   type="text" value="" tabindex="1" placeholder="Ingrese modelo" maxlength="250">
												</input>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<!--Horas-->
									<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="txtHoras_inventario_prospectos_crm">Horas</label>
											</div>
											<div class="col-md-12">
												<input class="form-control moneda_prospectos_crm" id="txtHoras_inventario_prospectos_crm"
													   name="intHoras_inventario_prospectos_crm" 
													   type="text" value="" tabindex="1" placeholder="Ingrese horas" maxlength="11">
												</input>
											</div>
										</div>
									</div>
									<!--Caballos-->
									<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="txtCaballos_inventario_prospectos_crm">Caballos</label>
											</div>
											<div class="col-md-12">
												<input class="form-control" id="txtCaballos_inventario_prospectos_crm"
													   name="intCaballos_inventario_prospectos_crm" 
													   type="text" value="" tabindex="1" placeholder="Ingrese caballos de fuerza" maxlength="4">
												</input>
											</div>
										</div>
									</div>
									<!--Tracción-->
									<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="txtTraccion_inventario_prospectos_crm">Tracción</label>
											</div>
											<div class="col-md-12">
												<input class="form-control" id="txtTraccion_inventario_prospectos_crm"
													   name="strTraccion_inventario_prospectos_crm" 
													   type="text" value="" tabindex="1" placeholder="Ingrese tracción" maxlength="10">
												</input>
											</div>
										</div>
									</div>
									<!--Recambio-->
									<div class="col-sm-3 col-md-3 col-lg-3 col-xs-10">
										<div class="form-group">
											<div class="col-md-12">
												<label for="cmbRecambio_inventario_prospectos_crm">Recambio</label>
											</div>
											<div class="col-md-12">
												<select class="form-control" id="cmbRecambio_inventario_prospectos_crm" 
												 		name="strRecambio_inventario_prospectos_crm" tabindex="1">
			                          				<option value="LARGO PLAZO">LARGO PLAZO</option>
			                          				<option value="MEDIANO PLAZO">MEDIANO PLAZO</option>
			                          				<option value="CORTO PLAZO">CORTO PLAZO</option>
			                     				</select>
											</div>
										</div>
									</div>
									<!--Botón agregar-->
	                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
	                                	<button class="btn btn-primary btn-toolBtns pull-right" 
	                                			id="btnAgregar_inventario_prospectos_crm" 
	                                			onclick="agregar_renglon_inventario_prospectos_crm();" 
	                                	     	title="Agregar" tabindex="1"> 
	                                		<span class="glyphicon glyphicon-plus"></span>
	                                	</button>
	                             	</div>
								</div>
							</div>
							<div class="form-group row">
								<!--Div que contiene la tabla con los inventarios encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_inventario_prospectos_crm">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Descripción</th>
												<th class="movil">Marca</th>
												<th class="movil">Modelo</th>
												<th class="movil">Año</th>
												<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
									</table>
									<br>
									<div class="row">
										<!--Número de registros encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_inventario_prospectos_crm">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Inventario-->
						<!--Tab - Otros-->
						<div id="otros_prospectos_crm" class="tab-pane fade">
							<div class="row">
								<!-- Caja de texto oculta que se utiliza para almacenar módulos seleccionados-->
								<input id="txtModulosSeleccionadosID_prospectos_crm" 
									   name="intMaquinariaModeloID_prospectos_crm"  
									   type="hidden" value="" />
								<!--Cliente importante-->
								<h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Cliente importante para:</h4>
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									 <div class="form-group row">
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<div class="checkbox" id="chkModulos_prospectos_crm"></div>
										</div>
									</div>
								</div>
							</div>
			    			<div class="row">
				    			<!--Número de hectáreas-->
                       			<h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Número de hectáreas</h4>
                       			<!--Temporal-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtHectareasTemporal_prospectos_crm">Temporal</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtHectareasTemporal_prospectos_crm"
												   name="intHectareasTemporal_prospectos_crm" 
												   type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="11">
											</input>
										</div>
									</div>
								</div>
								<!--Riego-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtHectareasRiego_prospectos_crm">Riego</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtHectareasRiego_prospectos_crm"
												   name="intHectareasRiego_prospectos_crm" 
												   type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="11">
											</input>
										</div>
									</div>
								</div>
								<!--Otras-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtHectareasOtras_prospectos_crm">Otras</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtHectareasOtras_prospectos_crm"
												   name="intHectareasOtras_prospectos_crm" 
												   type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="11">
											</input>
										</div>
									</div>
								</div>
                       		</div>
			    			<div class="row">
				    			<!--Hectáreas por tipo de terreno-->
                       			<h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Hectáreas por tipo de terreno</h4>
                       			<!--Arenoso-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTerrenoArenoso_prospectos_crm">Arenoso</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtTerrenoArenoso_prospectos_crm"
												   name="intTerrenoArenoso_prospectos_crm" 
												   type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="11">
											</input>
										</div>
									</div>
								</div>
								<!--Arcilloso-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTerrenoArcilloso_prospectos_crm">Arcilloso</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtTerrenoArcilloso_prospectos_crm"
												   name="intTerrenoArcilloso_prospectos_crm" 
												   type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="11">
											</input>
										</div>
									</div>
								</div>
								<!--Compacto-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTerrenoCompacto_prospectos_crm">Compacto</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtTerrenoCompacto_prospectos_crm"
												   name="intTerrenoCompacto_prospectos_crm" 
												   type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="11">
											</input>
										</div>
									</div>
								</div>
								<!--Pedregoso-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTerrenoPedregoso_prospectos_crm">Pedregoso</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtTerrenoPedregoso_prospectos_crm"
												   name="intTerrenoPedregoso_prospectos_crm" 
												   type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="11">
											</input>
										</div>
									</div>
								</div>
								<!--Otros-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTerrenoOtros_prospectos_crm">Otros</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtTerrenoOtros_prospectos_crm"
												   name="intTerrenoOtros_prospectos_crm" 
												   type="text" value="" tabindex="1" placeholder="Ingrese cantidad" maxlength="11">
											</input>
										</div>
									</div>
								</div>
		                    </div>
                     		<div class="row">
                     		 	<!--Div con el contenido de las actividades-->
                     		 	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                     		 		<div class="row">
                     		 			<!--Actividades-->
		                       			<h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Actividades</h4>
										<!--Autocomplete que contiene las actividadaes activas-->
										<div class="col-sm-10 col-md-10 col-lg-10 col-xs-10">
											<div class="form-group">
												<div class="col-md-12">
													<!-- Caja de texto oculta para recuperar el id del registro seleccionado-->
													<input id="txtActividadID_actividades_prospectos_crm" 
														   name="intActividadID_actividades_prospectos_crm" 
														   type="hidden" value="">
													</input>
													<label for="txtActividad_actividades_prospectos_crm">Actividad</label>
												</div>
												<div class="col-md-12">
													<input class="form-control" id="txtActividad_actividades_prospectos_crm"
														   name="strActividad_actividades_prospectos_crm" 
														   type="text" value="" tabindex="1" placeholder="Ingrese actividad" maxlength="250">
													</input>
												</div>
											</div>
										</div>
										<!--Botón agregar-->
		                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
		                                	<button class="btn btn-primary btn-toolBtns pull-right" 
		                                			id="btnAgregar_actividades_prospectos_crm" 
		                                			onclick="agregar_renglon_actividades_prospectos_crm();" 
		                                	     	title="Agregar" tabindex="1"> 
		                                		<span class="glyphicon glyphicon-plus"></span>
		                                	</button>
		                             	</div>
									</div>
                     		 		<div class="form-group row">
		                       			<!--Div que contiene la tabla con las actividades encontradas-->
		                       			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<!-- Diseño de la tabla-->
											<table class="table-hover movil" id="dg_actividades_prospectos_crm">
												<thead class="movil">
													<tr class="movil">
														<th class="movil">Actividad</th>
														<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
													</tr>
												</thead>
												<tbody class="movil"></tbody>
											</table>
											<br>
											<div class="row">
												<!--Número de registros encontrados-->
												<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
													<button class="btn btn-default btn-sm disabled pull-right">
														<strong id="numElementos_actividades_prospectos_crm">0</strong> encontrados
													</button>
												</div>
											</div>
										</div>
		                       		</div>
                     		 	</div>
                     		 	<!--Div con el contenido de los cultivos -->
                     		 	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                     		 		<div class="row">
                     		 			<!--Cultivos-->
		                       			<h4 class="col-sm-12 col-md-12 col-lg-12 col-xs-12">Cultivos</h4>
										<!--Autocomplete que contiene los cultivos activos-->
										<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
											<div class="form-group">
												<div class="col-md-12">
													<!-- Caja de texto oculta para recuperar el id del registro seleccionado-->
													<input id="txtCultivoID_cultivos_prospectos_crm" 
														   name="intCultivoID_cultivos_prospectos_crm" 
														   type="hidden" value="">
													</input>
													<label for="txtCultivo_cultivos_prospectos_crm">Cultivo</label>
												</div>
												<div class="col-md-12">
													<input class="form-control" id="txtCultivo_cultivos_prospectos_crm"
														   name="strCultivo_cultivos_prospectos_crm" 
														   type="text" value="" tabindex="1" placeholder="Ingrese cultivo" maxlength="250">
													</input>
												</div>
											</div>
										</div>
										<!--Hectáreas-->
										<div class="col-sm-4 col-md-4 col-lg-4 col-xs-10">
											<div class="form-group">
												<div class="col-md-12">
													<label for="txtHectareas_cultivos_prospectos_crm">Hectáreas</label>
												</div>
												<div class="col-md-12">
													<input class="form-control moneda_prospectos_crm" id="txtHectareas_cultivos_prospectos_crm"
														   name="intHectareas_cultivos_prospectos_crm" 
														   type="text" value="" tabindex="1" placeholder="Ingrese número de hectáreas" maxlength="11">
													</input>
												</div>
											</div>
										</div>
										<!--Botón agregar-->
		                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
		                                	<button class="btn btn-primary btn-toolBtns pull-right" 
		                                			id="btnAgregar_cultivos_prospectos_crm" 
		                                			onclick="agregar_renglon_cultivos_prospectos_crm();" 
		                                	     	title="Agregar" tabindex="1"> 
		                                		<span class="glyphicon glyphicon-plus"></span>
		                                	</button>
		                             	</div>
								    </div>
                     		 		<div class="form-group row">
		                       			<!--Div que contiene la tabla con los cultivos encontrados-->
		                       			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<!-- Diseño de la tabla-->
											<table class="table-hover movil" id="dg_cultivos_prospectos_crm">
												<thead class="movil">
													<tr class="movil">
														<th class="movil">Cultivo</th>
														<th class="movil">No. Hectáreas</th>
														<th class="movil" id="th-acciones" style="width:6em;">Acciones</th>
													</tr>
												</thead>
												<tbody class="movil"></tbody>
											</table>
											<br>
											<div class="row">
												<!--Número de registros encontrados-->
												<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
													<button class="btn btn-default btn-sm disabled pull-right">
														<strong id="numElementos_cultivos_prospectos_crm">0</strong> encontrados
													</button>
												</div>
											</div>
										</div>
		                       		</div>
                     		 	</div>
                     		</div>
						</div><!--Cierre del contenido del tab - Otros-->
						<!--Tab - Expediente-->
						<div id="expediente_prospectos_crm" class="tab-pane fade">
							<div class="form-group row">
								<!--Tabla con el listado de documentos-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_expediente_prospectos_crm">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Documento</th>
												<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_expediente_prospectos_crm" type="text/template"> 
											{{#rows}}
												<tr class="movil">
													<td class="movil f1">{{descripcion}}</td>
													<td class="td-center movil f2"> 
														<!--Subir archivo-->
														<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
															<span class="btn  btn-default btn-xs fileinput-button ">
														    	<span class="fa fa-upload"></span>
																<input type="file" name="archivo_expediente_prospectos_crm{{documento_cliente_id}}" id="archivo_expediente_prospectos_crm{{documento_cliente_id}}"  
																	   onchange="subir_archivo_expediente_prospectos_crm({{documento_cliente_id}})">
														  		</input>
														    </span>
														</span>
						                            	<!--Descargar archivo-->
						                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
						                            			 onmousedown="descargar_archivo_expediente_prospectos_crm({{documento_cliente_id}})" title="Descargar archivo">
						                            		<span class="glyphicon glyphicon-download-alt"></span>
						                            	</button>
						                            	<!--Eliminar archivo-->
														<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}"  
																onclick="eliminar_archivo_expediente_prospectos_crm({{documento_cliente_id}})"  title="Eliminar archivo">
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
												<strong id="numElementos_expediente_prospectos_crm">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Expediente-->
						<!--Tab - Visitas-->
						<div id="visitas_prospectos_crm" class="tab-pane fade">
							<div class="row">
								<!--Fecha inicial-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFechaInicialBusq_visitas_prospectos_crm">Fecha inicial</label>
										</div>
										<div class="col-md-12">
											<div class='input-group date' id='dteFechaInicialBusq_visitas_prospectos_crm'>
							                    <input class="form-control" id="txtFechaInicialBusq_visitas_prospectos_crm"
							                    		name= "strFechaInicialBusq_visitas_prospectos_crm" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Hora inicial-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtHoraInicialBusq_visitas_prospectos_crm">Hora</label>
										</div>
										<div class="col-md-12">
											<div class="input-group bootstrap-timepicker timepicker" id="dteHoraInicialBusq_visitas_prospectos_crm">
									            <input 	id="txtHoraInicialBusq_visitas_prospectos_crm"
									            		name= "strHoraInicialBusq_visitas_prospectos_crm" 
									            		type="text" value="" tabindex="1" placeholder="Ingrese hora" class="form-control input-small" />
									            <span class="input-group-addon">
									            	<i class="glyphicon glyphicon-time"></i>
									            </span>
									        </div>
										</div>
									</div>
								</div>
								<!--Fecha final-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFechaFinalBusq_visitas_prospectos_crm">Fecha final</label>
										</div>
										<div class="col-md-12">
											<div class='input-group date' id='dteFechaFinalBusq_visitas_prospectos_crm'>
							                    <input class="form-control" id="txtFechaFinalBusq_visitas_prospectos_crm"
							                    		name= "strFechaFinalBusq_visitas_prospectos_crm" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Hora final-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtHoraFinalBusq_visitas_prospectos_crm">Hora</label>
										</div>
										<div class="col-md-12">
											<div class="input-group bootstrap-timepicker timepicker" id="dteHoraFinalBusq_visitas_prospectos_crm">
									            <input 	id="txtHoraFinalBusq_visitas_prospectos_crm"
									            		name= "strHoraFinalBusq_visitas_prospectos_crm" 
									            		type="text" value="" tabindex="1" placeholder="Ingrese hora" class="form-control input-small" />
									            <span class="input-group-addon">
									            	<i class="glyphicon glyphicon-time"></i>
									            </span>
									        </div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene los módulos activos-->
								<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
											<input id="txtModuloIDBusq_visitas_prospectos_crm" 
												   name="intModuloIDBusq_visitas_prospectos_crm"  type="hidden" 
												   value="" />
											<label for="txtModuloBusq_visitas_prospectos_crm">Módulo</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtModuloBusq_visitas_prospectos_crm" 
													name="strModuloBusq_visitas_prospectos_crm" type="text" value="" tabindex="1" placeholder="Ingrese módulo" maxlength="250" />
										</div>
									</div>
								</div>
						    	<!--Botones-->
						    	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div id="ToolBtns" class="btn-group btn-toolBtns">
										<!--Buscar registros-->
										<button class="btn btn-primary" id="btnBuscar_visitas_prospectos_crm"
												onclick="validar_paginacion_visitas_prospectos_crm();" title="Buscar coincidencias" tabindex="1" disabled> 
											<span class="glyphicon glyphicon-search"></span>
										</button>
										<!--Dar de alta un nuevo registro-->
										<button class="btn btn-info" id="btnNuevo_visitas_prospectos_crm" title="Nuevo registro" tabindex="1" disabled> 
											<span class="glyphicon glyphicon-list-alt"></span>
										</button>   
										<!--Generar PDF con los datos del registro-->
										<button class="btn btn-default"  id="btnImprimir_visitas_prospectos_crm"
												onclick="reporte_visitas_prospectos_crm();" title="Imprimir reporte general en PDF" tabindex="1" disabled>
											<span class="glyphicon glyphicon-print"></span>
										</button>
									</div>
								</div>
						    </div>
							<div class="form-group row">
								<!--Div que contiene la tabla con las visitas encontradas-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_visitas_prospectos_crm">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Fecha</th>
												<th class="movil">Próxima</th>
												<th class="movil">Módulo</th>
												<th class="movil">Comentario</th>
												<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_visitas_prospectos_crm" type="text/template"> 
										{{#rows}}
											<tr class="movil">   
												<td class="movil e1">{{fecha}}</td>
												<td class="movil e2">{{proxima_visita}}</td>
												<td class="movil e3">{{modulo}}</td>
												<td class="movil e4">{{comentario}}</td>
												<td class="td-center movil e5"> 
													<!--Editar registro-->
													<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
															onclick="editar_visitas_prospectos_crm({{prospecto_visita_id}}, 'Editar')"  
															title="Editar">
														<span class="glyphicon glyphicon-edit"></span>
													</button>
													<!--Ver registro-->
													<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
															onclick="editar_visitas_prospectos_crm({{prospecto_visita_id}}, 'Ver')"  
															title="Ver">
														<span class="glyphicon glyphicon-eye-open"></span>
													</button>
													<!--Seguimiento del registro-->
													<button class="btn btn-default btn-xs {{mostrarAccionSeguimiento}}"  
															onclick="seguimiento_visitas_prospectos_crm({{prospecto_visita_id}})"  
															title="Seguimiento">
														<span class="glyphicon glyphicon-share"></span>
													</button>
													<!--Generar PDF con los datos del registro-->
													<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
															onclick="reporte_registro_visitas_prospectos_crm({{prospecto_visita_id}});"  title="Imprimir registro en PDF">
														<span class="glyphicon glyphicon-print"></span>
													</button>
													<!--Reprogramación del registro-->
													<button class="btn btn-default btn-xs {{mostrarAccionCancelar}}" 
															onclick="abrir_reprogramacion_visitas_prospectos_crm({{prospecto_visita_id}})" 
															title="Reprogramar">
														<span class="glyphicon glyphicon-time"></span>
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
										<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_visitas_prospectos_crm"></div>
										<!--Número de registros encontrados-->
										<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_visitas_prospectos_crm">0</strong> encontrados
											</button>
										</div>
									</div> <!--Cierre del diseño de la paginación-->
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Visitas-->
					</div><!--Cierre del contenedor de tabs-->
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_prospectos_crm"  
									onclick="validar_prospectos_crm();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Enviar a validación-->
							<button class="btn btn-default" id="btnEnviarValidacion_prospectos_crm"  
									onclick="enviar_validacion_prospectos_crm('','','','');"  title="Enviar a validación" tabindex="3" disabled>
								<span class="glyphicon glyphicon-share-alt"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_prospectos_crm"  
									onclick="cambiar_estatus_prospectos_crm('','ACTIVO');"  title="Desactivar" tabindex="4" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_prospectos_crm"  
									onclick="cambiar_estatus_prospectos_crm('','INACTIVO');"  title="Restaurar" tabindex="5" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_prospectos_crm"
									type="reset" aria-hidden="true" onclick="cerrar_prospectos_crm();" title="Cerrar"  tabindex="6">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Prospectos-->

		<!-- Diseño del modal Visitas-->
		<div id="VisitasProspectosCRMBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_visitas_prospectos_crm"  class="ModalBodyTitle">
			<h1>Visitas al Prospecto</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmVisitasProspectosCRM" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmVisitasProspectosCRM"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtProspectoVisitaID_visitas_prospectos_crm" 
										   name="intProspectoVisitaID_visitas_prospectos_crm" 
										   type="hidden" 
										   value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la visita de referencia-->
									<input id="txtProspectoVisitaReferencia_visitas_prospectos_crm" 
										   name="intProspectoVisitaReferencia_visitas_prospectos_crm" 
										   type="hidden" 
										   value="" />
									<label for="txtFecha_visitas_prospectos_crm">Fecha de la visita</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_visitas_prospectos_crm'>
					                    <input class="form-control" id="txtFecha_visitas_prospectos_crm"
					                    		name= "strFecha_visitas_prospectos_crm" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Hora de la visita-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHora_visitas_prospectos_crm">Hora</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class="input-group bootstrap-timepicker timepicker" id="dteHora_visitas_prospectos_crm">
							            <input 	id="txtHora_visitas_prospectos_crm"
							            		name= "strHora_visitas_prospectos_crm" 
							            		type="text"
							            		value=""
							            		tabindex="1"
							            		placeholder="Ingrese hora" 
							            		class="form-control input-small" />
							            <span class="input-group-addon">
							            	<i class="glyphicon glyphicon-time"></i>
							            </span>
							        </div>
								</div>
							</div>
						</div>
						<!--Fecha de la próxima visita-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaProximaVisita_visitas_prospectos_crm">Próxima visita</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaProximaVisita_visitas_prospectos_crm'>
					                    <input class="form-control" id="txtFechaProximaVisita_visitas_prospectos_crm"
					                    		name= "strFechaProximaVisita_visitas_prospectos_crm" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Hora de la próxima visita-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHoraProximaVisita_visitas_prospectos_crm">Hora</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class="input-group bootstrap-timepicker timepicker" id="dteHoraProximaVisita_visitas_prospectos_crm">
							            <input 	id="txtHoraProximaVisita_visitas_prospectos_crm"
							            		name= "strHoraProximaVisita_visitas_prospectos_crm" 
							            		type="text"
							            		value=""
							            		tabindex="1"
							            		placeholder="Ingrese hora" 
							            		class="form-control input-small" />
							            <span class="input-group-addon">
							            	<i class="glyphicon glyphicon-time"></i>
							            </span>
							        </div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Fecha de creación-->
						<div id="divFechaCreacion_visitas_prospectos_crm" class="col-sm-3 col-md-3 col-lg-3 col-xs-12 no-mostrar">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaCreacion_visitas_prospectos_crm">
										Fecha de captura
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFechaCreacion_visitas_prospectos_crm" 
											name="strFechaCreacion_visitas_prospectos_crm" type="text" value="">
									</input>
								</div>
							</div>
						</div>
				    	<!--Autocomplete que contiene los módulos activos-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
									<input id="txtModuloID_visitas_prospectos_crm" 
										   name="intModuloID_visitas_prospectos_crm"  type="hidden" 
										   value="" />
									<label for="txtModulo_visitas_prospectos_crm">Módulo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtModulo_visitas_prospectos_crm" 
											name="strModulo_visitas_prospectos_crm" type="text" value="" tabindex="1" placeholder="Ingrese módulo" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las estrategias activas-->
						<div id="divEstrategia_visitas_prospectos_crm" class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id de la estrategia seleccionada-->
									<input id="txtEstrategiaID_visitas_prospectos_crm" 
										   name="intEstrategiaID_visitas_prospectos_crm" 
										   type="hidden" value="">
									</input>
									<label for="txtEstrategia_visitas_prospectos_crm">
										Estrategia
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEstrategia_visitas_prospectos_crm" 
											name="strEstrategia_visitas_prospectos_crm" type="text" value=""   tabindex="1" placeholder="Ingrese estrategia" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Autocomplete que contiene los motivos de visitas activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del motivo de visita seleccionado-->
									<input id="txtMotivoVisitaID_visitas_prospectos_crm" 
									       name="intMotivoVisitaID_visitas_prospectos_crm" type="hidden" value="" />
									<label for="txtMotivoVisita_visitas_prospectos_crm">Motivo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMotivoVisita_visitas_prospectos_crm" 
												name="strMotivoVisita_visitas_prospectos_crm" type="text" value="" 
												tabindex="1" placeholder="Ingrese motivo" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las descripciones de maquinaria activas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la descripción de maquinaria seleccionada-->
									<input id="txtMaquinariaDescripcionID_visitas_prospectos_crm" 
										   name="intMaquinariaDescripcionID_visitas_prospectos_crm"  
										   type="hidden" value="">
									</input>
									<label for="txtMaquinariaDescripcion_visitas_prospectos_crm">Descripción de maquinaria</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMaquinariaDescripcion_visitas_prospectos_crm" 
											name="strMaquinariaDescripcion_visitas_prospectos_crm" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Madurez-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbMadurez_visitas_prospectos_crm">Madurez</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMadurez_visitas_prospectos_crm" 
									 		name="strMadurez_visitas_prospectos_crm" tabindex="1">
									 	<option value="">Seleccione una opción</option>
                          				<option value="1">1</option>
                          				<option value="2">2</option>
                          				<option value="3">3</option>
                          				<option value="4">4</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Probabilidad de compra-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaProbabilidadCompra_visitas_prospectos_crm">Probabilidad de compra</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaProbabilidadCompra_visitas_prospectos_crm'>
					                    <input class="form-control" id="txtFechaProbabilidadCompra_visitas_prospectos_crm"
					                    		name= "strFechaProbabilidadCompra_visitas_prospectos_crm" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Condiciones de pago-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCondicionesPago_visitas_prospectos_crm">Condiciones de pago</label>
								</div>
								<div id="divCmbMsjValidacion"  class="col-md-12">
									<select class="form-control" id="cmbCondicionesPago_visitas_prospectos_crm" 
									 		name="strCondicionesPago_visitas_prospectos_crm" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="CONTADO">CONTADO</option>
                          				<option value="CREDITO">CREDITO</option>
                     				</select>
								</div>
							</div>
						</div>
				    	<!--Plazo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbPlazo_visitas_prospectos_crm">Plazo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbPlazo_visitas_prospectos_crm" 
									 		name="strPlazo_visitas_prospectos_crm" tabindex="1">
									 	<option value="">Seleccione una opción</option>
                          				<option value="0-30 DIAS">0-30 DIAS</option>
                          				<option value="31-60 DIAS">31-60 DIAS</option>
                          				<option value="61-90 DIAS">61-90 DIAS</option>
                          				<option value="91-180 DIAS">91-180 DIAS</option>
                          				<option value="181-360 DIAS">181-360 DIAS</option>
                          				<option value="2 AÑOS">2 AÑOS</option>
                          				<option value="3 AÑOS">3 AÑOS</option>
                          				<option value="4 AÑOS">4 AÑOS</option>
                          				<option value="5 AÑOS">5 AÑOS</option>
                     				</select>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Comentarios-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtComentario_visitas_prospectos_crm">Comentarios</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtComentario_visitas_prospectos_crm" 
											   name="strComentario_visitas_prospectos_crm" rows="3" value="" tabindex="1" placeholder="Ingrese comentarios" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_visitas_prospectos_crm"  
									onclick="validar_visitas_prospectos_crm();"  title="Guardar" tabindex="1" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Seguimiento del registro-->
							<button class="btn btn-default" id="btnSeguimiento_visitas_prospectos_crm"  
									onclick="seguimiento_visitas_prospectos_crm('');"  title="Seguimiento" tabindex="1">
								<span class="glyphicon glyphicon-share"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_visitas_prospectos_crm"  
									onclick="reporte_registro_visitas_prospectos_crm('');"  title="Imprimir registro en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Reprogramación del registro-->
							<button class="btn btn-default" id="btnReprogramacion_visitas_prospectos_crm"  
									onclick="abrir_reprogramacion_visitas_prospectos_crm('');"  title="Reprogramar" tabindex="1" disabled>
								<span class="glyphicon glyphicon-time"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_visitas_prospectos_crm"
									type="reset" aria-hidden="true" onclick="cerrar_visitas_prospectos_crm();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Visitas-->

		<!-- Diseño del modal Reprogramación de Visita-->
		<div id="ReprogramacionVisitasProspectosCRMBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_reprogramacion_visitas_prospectos_crm" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Reprogramación de Visita</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmReprogramacionVisitasProspectosCRM" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmReprogramacionVisitasProspectosCRM"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Fecha original (próxima visita)-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtProspectoVisitaID_reprogramacion_visitas_prospectos_crm" 
										   name="intProspectoVisitaID_reprogramacion_visitas_prospectos_crm" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Visitas-->
									<input id="txtModalVisitas_reprogramacion_visitas_prospectos_crm" 
										   name="strModalVisitas_reprogramacion_visitas_prospectos_crm" 
										   type="hidden" value="" />
									<label for="txtFechaOriginal_reprogramacion_visitas_prospectos_crm">Próxima visita</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaOriginal_reprogramacion_visitas_prospectos_crm'>
					                    <input class="form-control" id="txtFechaOriginal_reprogramacion_visitas_prospectos_crm"
					                    		name= "strFechaOriginal_reprogramacion_visitas_prospectos_crm" 
					                    		type="text" value="" disabled/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Hora original (próxima visita)-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHoraOriginal_reprogramacion_visitas_prospectos_crm">Hora</label>
								</div>
								<div class="col-md-12">
									<div class="input-group bootstrap-timepicker timepicker" id="dteHoraOriginal_reprogramacion_visitas_prospectos_crm">
							            <input 	id="txtHoraOriginal_reprogramacion_visitas_prospectos_crm"
							            		name= "strHoraOriginal_reprogramacion_visitas_prospectos_crm" 
							            		type="text" 
							            		class="form-control input-small" 
							            		disabled />
							            <span class="input-group-addon">
							            	<i class="glyphicon glyphicon-time"></i>
							            </span>
							        </div>
								</div>
							</div>
						</div>
			 		</div>
			 		<div class="row">	
						<!--Fecha reprogramada-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaReprogramada_reprogramacion_visitas_prospectos_crm">Fecha de reprogramación</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaReprogramada_reprogramacion_visitas_prospectos_crm'>
					                    <input class="form-control" id="txtFechaReprogramada_reprogramacion_visitas_prospectos_crm"
					                    		name= "strFechaReprogramada_reprogramacion_visitas_prospectos_crm" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Hora reprogramada-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtHoraReprogramada_reprogramacion_visitas_prospectos_crm">Hora</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class="input-group bootstrap-timepicker timepicker" id="dteHoraReprogramada_reprogramacion_visitas_prospectos_crm">
							            <input 	id="txtHoraReprogramada_reprogramacion_visitas_prospectos_crm"
							            		name= "strHoraReprogramada_reprogramacion_visitas_prospectos_crm" 
							            		type="text" value="" tabindex="1" placeholder="Ingrese hora" class="form-control input-small" />
							            <span class="input-group-addon">
							            	<i class="glyphicon glyphicon-time"></i>
							            </span>
							        </div>
								</div>
							</div>
						</div>
					</div>
			 		<div class="row">
			 			<!--Motivo-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMotivoVisita_reprogramacion_visitas_prospectos_crm">Motivo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMotivoVisita_reprogramacion_visitas_prospectos_crm" 
											name="strMotivoVisita_reprogramacion_visitas_prospectos_crm" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<div class="row">
				    	<!--Comentarios-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtComentario_reprogramacion_visitas_prospectos_crm">Comentarios</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtComentario_reprogramacion_visitas_prospectos_crm" 
											   name="strComentario_reprogramacion_visitas_prospectos_crm" rows="4" value="" 
											   tabindex="1" placeholder="Ingrese comentarios" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_reprogramacion_visitas_prospectos_crm"  
									onclick="validar_reprogramacion_visitas_prospectos_crm();"  title="Guardar" tabindex="1">
								<span class="fa fa-floppy-o"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_reprogramacion_visitas_prospectos_crm"
									type="reset" aria-hidden="true" onclick="cerrar_reprogramacion_visitas_prospectos_crm();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Reprogramación de Visita-->
	</div><!--#ProspectosCRMContent -->

	<!-- /.Plantilla para cargar los módulos-->  
	<script id="modulos_prospectos_crm" type="text/template">
		{{#row}}
			<label>
		      <input class="form-check-input" type="checkbox" id="chkModulo{{modulo_id}}_prospectos_crm"  name="chkModulos_prospectos_crm[]" value="{{modulo_id}}">
		      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
		      {{descripcion}}
		    </label>
		{{/row}} 
	</script>

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros de prospectos
		var intPaginaProspectosCRM = 0;
		var strUltimaBusquedaProspectosCRM = "";
		//Variables que se utilizan para la paginación de registros de visitas
		var intPaginaVisitasProspectosCRM = 0;
		var strUltimaBusquedaVisitasProspectosCRM = "";
		//Variable que se utiliza para asignar objeto del modal Enviar a Validación
		var objValidacionProspectosCRM = null;
		//Variable que se utiliza para asignar objeto del modal Prospectos
		var objProspectosCRM = null;
		//Variable que se utiliza para asignar objeto del modal Visitas
		var objVisitasProspectosCRM = null;
		//Variable que se utiliza para asignar objeto del modal Reprogramación de Visita
		var objReprogramacionVisitasProspectosCRM = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_prospectos_crm()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('crm/prospectos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_prospectos_crm').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosProspectosCRM = data.row;
					//Separar la cadena 
					var arrPermisosProspectosCRM = strPermisosProspectosCRM.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosProspectosCRM.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosProspectosCRM[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_prospectos_crm').removeAttr('disabled');
							$('#btnNuevo_visitas_prospectos_crm').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosProspectosCRM[i]=='GUARDAR') || (arrPermisosProspectosCRM[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_prospectos_crm').removeAttr('disabled');
							$('#btnGuardar_visitas_prospectos_crm').removeAttr('disabled');
						}
						else if(arrPermisosProspectosCRM[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_prospectos_crm').removeAttr('disabled');
							$('#btnBuscar_visitas_prospectos_crm').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_prospectos_crm();
						}
						else if(arrPermisosProspectosCRM[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_prospectos_crm').removeAttr('disabled');
							$('#btnRestaurar_prospectos_crm').removeAttr('disabled');
						}
						else if(arrPermisosProspectosCRM[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_prospectos_crm').removeAttr('disabled');
							$('#btnImprimir_visitas_prospectos_crm').removeAttr('disabled');
						}
						else if(arrPermisosProspectosCRM[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_visitas_prospectos_crm').removeAttr('disabled');
						}
						else if(arrPermisosProspectosCRM[i]=='VALIDAR')//Si el indice es VALIDAR
						{
							//Habilitar el control (botón enviar a validación)
							$('#btnEnviarValidacion_prospectos_crm').removeAttr('disabled');

						}
						else if(arrPermisosProspectosCRM[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_prospectos_crm').removeAttr('disabled');
						}
						else if(arrPermisosProspectosCRM[i]=='CANCELAR')
						{
							//Habilitar el control (botón reprogramación)
							$('#btnReprogramacion_visitas_prospectos_crm').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_prospectos_crm() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_prospectos_crm').val() != strUltimaBusquedaProspectosCRM)
			{
				intPaginaProspectosCRM = 0;
				strUltimaBusquedaProspectosCRM = $('#txtBusqueda_prospectos_crm').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('crm/prospectos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_prospectos_crm').val(),
						intPagina:intPaginaProspectosCRM,
						strPermisosAcceso: $('#txtAcciones_prospectos_crm').val()
					},
					function(data){
						$('#dg_prospectos_crm tbody').empty();
						var tmpProspectosCRM = Mustache.render($('#plantilla_prospectos_crm').html(),data);
						$('#dg_prospectos_crm tbody').html(tmpProspectosCRM);
						$('#pagLinks_prospectos_crm').html(data.paginacion);
						$('#numElementos_prospectos_crm').html(data.total_rows);
						intPaginaProspectosCRM = data.pagina;
					},
			'json');
		}

		//Función para cargar los módulos que pueden ser importantes para un Prospecto
		function cargar_modulos_prospectos_crm()
		{
			//Hacer un llamado al método del controlador para regresar los módulos que se encuentran activos 
			$.post('crm/modulos/get_datos', {
			       	strTipo: 'checkboxes'
				},
				function(data)
				{
					$('#chkModulos_prospectos_crm').empty();
					var temp = Mustache.render($('#modulos_prospectos_crm').html(), data)
					$('#chkModulos_prospectos_crm').html(temp);
				},
				'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_prospectos_crm(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'crm/prospectos/';

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
			if ($('#chbImprimirDetalles_prospectos_crm').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_prospectos_crm').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_prospectos_crm').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'strBusqueda': $('#txtBusqueda_prospectos_crm').val(),
										'strDetalles': $('#chbImprimirDetalles_prospectos_crm').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		/*******************************************************************************************************************
		Funciones del modal Enviar a Validación
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_validacion_prospectos_crm()
		{
			//Incializar formulario
			$('#frmValidacionProspectosCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_validacion_prospectos_crm();
			//Limpiar cajas de texto ocultas
			$('#frmValidacionProspectosCRM').find('input[type=hidden]').val('');
			//Cambiar el color del encabezado 
		    $('#divEncabezadoModal_validacion_prospectos_crm').addClass("estatus-ACTIVO");
		}

		//Función que se utiliza para abrir el modal
		function enviar_validacion_prospectos_crm(id, estatusCliente, codigo, nombreComercial)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_validacion_prospectos_crm();
			//Variables que se utilizan para asignar los datos del registro
			var intProspectoID = 0;
			var strEstatusCliente = '';
			var strCodigo = '';
			var strNombreComercial = '';


			//Si no existe id, significa que se enviará a validación desde el modal 
			if(id == '')
			{
				intProspectoID = $('#txtProspectoID_prospectos_crm').val();
				strEstatusCliente =  $('#txtEstatusCliente_prospectos_crm').val(); 
				strCodigo =  $('#txtCodigo_prospectos_crm').val(); 
				strNombreComercial =  $('#txtNombreComercial_prospectos_crm').val();
				$('#txtModalProspectos_validacion_prospectos_crm').val('SI');
			}
			else
			{
				intProspectoID = id;
				strEstatusCliente = estatusCliente; 
				strCodigo = codigo; 
				strNombreComercial = nombreComercial;
				$('#txtModalProspectos_validacion_prospectos_crm').val('NO');
			}

			//Asignar datos del registro seleccionado
			$('#txtReferenciaID_validacion_prospectos_crm').val(intProspectoID);
			$('#txtEstatusCliente_validacion_prospectos_crm').val(strEstatusCliente);
			$('#txtMensaje_validacion_prospectos_crm').val('Favor de validar prospecto '+ strCodigo+' - '+strNombreComercial);
			//Cargar el treeview
			get_treeview_usuarios_validacion_prospectos_crm();
			//Abrir modal
			objValidacionProspectosCRM = $('#ValidacionProspectosCRMBox').bPopup({
											appendTo: '#ProspectosCRMContent', 
				                            contentContainer: 'ProspectosCRMM', 
				                            zIndex: 2, 
				                            modalClose: false, 
				                            modal: true, 
				                            follow: [true,false], 
				                            followEasing : "linear", 
				                            easing: "linear", 
				                            modalColor: ('#F0F0F0')});
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_validacion_prospectos_crm()
		{
			try {
				//Cerrar modal
				objValidacionProspectosCRM.close();
				//Eliminar datos del treeview
				$("#treeUsuarios_validacion_prospectos_crm").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtBusqueda_prospectos_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_validacion_prospectos_crm()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosValidacionProspectosCRM = [];

			//Recorremos el treeview
			$("#treeUsuarios_validacion_prospectos_crm").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosValidacionProspectosCRM.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtUsuarios_validacion_prospectos_crm").val(arrSeleccionadosValidacionProspectosCRM.join('|'));
			
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_validacion_prospectos_crm();
			//Validación del formulario de campos obligatorios
			$('#frmValidacionProspectosCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_validacion_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Escriba un mensaje'}
											}
										},
										strUsuarios_validacion_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un usuario para este mensaje.'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_validacion_prospectos_crm = $('#frmValidacionProspectosCRM').data('bootstrapValidator');
			bootstrapValidator_validacion_prospectos_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_validacion_prospectos_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos de validación del prospecto
				guardar_validacion_prospectos_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_validacion_prospectos_crm()
		{
			try
			{
				$('#frmValidacionProspectosCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar a validación los datos de un registro
		function guardar_validacion_prospectos_crm()
		{
			//Hacer un llamado al método del controlador para validar los datos del registro
			$.post('crm/prospectos/set_validacion',
			{
				intProspectoID: $('#txtReferenciaID_validacion_prospectos_crm').val(),
			    strEstatusCliente: $('#txtEstatusCliente_validacion_prospectos_crm').val(), 
			    strUsuarios: $('#txtUsuarios_validacion_prospectos_crm').val(), 
			    strMensaje:  $('#txtMensaje_validacion_prospectos_crm').val()
		     },
		     function(data) {
		        if(data.resultado)
		        {
		          	//Hacer llamado a la función  para cargar  los registros en el grid
		          	paginacion_prospectos_crm();
		          	//Hacer un llamado a la función para cerrar modal
				  	cerrar_validacion_prospectos_crm();
				  	
				  	//Si el id de la referencia (para la validación) se recuperó del modal Prospectos 
				  	if($('#txtModalProspectos_validacion_prospectos_crm').val() == 'SI')
				  	{
				  		//Hacer un llamado a la función para cerrar modal Prospectos
				 	 	cerrar_prospectos_crm();
				  	}  
		        }
		        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		        mensaje_prospectos_crm(data.tipo_mensaje, data.mensaje);
		     },
		    'json');
		}

		/*Función que se utiliza para definir tree view de usuarios con acceso a la función Editar del proceso
		 *validación de prospectos*/
		function get_treeview_usuarios_validacion_prospectos_crm()
		{
			$('#treeUsuarios_validacion_prospectos_crm').fancytree({
				source: {
					url: "seguridad/usuarios/get_treeview/VALIDACION_PROSPECTOS",
					cache: false
				},
				checkbox: true,
				selectMode: 3
			});
		}

		/*******************************************************************************************************************
		Funciones del modal Prospectos
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_prospectos_crm()
		{
			//Incializar formulario
			$('#frmProspectosCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_prospectos_crm();
			//Limpiar cajas de texto ocultas
			$('#frmProspectosCRM').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_prospectos_crm');
			  //Eliminar los datos de la tabla inventario
			$('#dg_inventario_prospectos_crm tbody').empty();
			$('#numElementos_inventario_prospectos_crm').html(0);
			//Eliminar los datos de la tabla actividades
			$('#dg_actividades_prospectos_crm tbody').empty();
			$('#numElementos_actividades_prospectos_crm').html(0);
			//Eliminar los datos de la tabla cultivos
			$('#dg_cultivos_prospectos_crm tbody').empty();
			$('#numElementos_cultivos_prospectos_crm').html(0);
		    //Agregar clase disabled disabledTab para deshabilitar los siguientes tabs
		    $('#tabExpediente_prospectos_crm').addClass("disabled disabledTab");
		    $('#tabVisitas_prospectos_crm').addClass("disabled disabledTab");
			//Asignar NO para indicar que no se ha abierto el modal Enviar a Validación
			$('#txtModalProspectos_validacion_prospectos_crm').val('NO');
			//Hacer un llamado a la función para ocultar los campos de captura del inventario
			ocultar_campos_inventario_prospectos_crm();
			//Habilitar todos los elementos del formulario
			$('#frmProspectosCRM').find('input, textarea, select').removeAttr('disabled','disabled');
			//Inicializar datetimepicker
			$('#dteFechaInicialBusq_visitas_prospectos_crm').data("DateTimePicker").date(fechaActual());
			$('#txtFechaInicialBusq_visitas_prospectos_crm').val('');
			$('#dteFechaFinalBusq_visitas_prospectos_crm').data("DateTimePicker").date(fechaActual());
			$('#txtFechaFinalBusq_visitas_prospectos_crm').val('');
			//Deshabilitar las siguientes cajas de texto
			$('#txtCodigo_prospectos_crm').attr("disabled", "disabled");
			$('#txtMunicipio_prospectos_crm').attr("disabled", "disabled");
			$('#txtEstado_prospectos_crm').attr("disabled", "disabled");
			$('#txtPais_prospectos_crm').attr("disabled", "disabled");
			//Mostrar los siguiente botones
			$("#btnGuardar_prospectos_crm").show();
			$("#btnNuevo_visitas_prospectos_crm").show();
			//Ocultar los siguientes botones
			$("#btnEnviarValidacion_prospectos_crm").hide();
			$("#btnDesactivar_prospectos_crm").hide();
			$("#btnRestaurar_prospectos_crm").hide();
			//Hacer un llamado a la función para cargar los módulos
			cargar_modulos_prospectos_crm();
		}

		//Función para inicializar elementos del código postal
		function inicializar_codigo_postal_prospectos_crm()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtLocalidadID_prospectos_crm').val('');
            $('#txtLocalidad_prospectos_crm').val('');
            $('#txtMunicipioID_prospectos_crm').val('');
            $('#txtMunicipio_prospectos_crm').val('');
            $('#txtEstado_prospectos_crm').val('');
            $('#txtPais_prospectos_crm').val('');
		}

		//Función para inicializar elementos de la localidad
		function inicializar_localidad_prospectos_crm()
		{
			//Si no existe id del código postal
			if($('#txtCodigoPostalID_prospectos_crm').val() == '')
			{
				//Limpiar contenido de las siguientes cajas de texto
				$('#txtMunicipioID_prospectos_crm').val('');
				$('#txtMunicipio_prospectos_crm').val('');
		        $('#txtEstado_prospectos_crm').val('');
		        $('#txtPais_prospectos_crm').val('');
			}
			
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_prospectos_crm()
		{
			try {

				//Hacer un llamado a la función para cerrar modal Visitas
				cerrar_visitas_prospectos_crm();
				//Hacer un llamado a la función para cerrar modal Reprogramación de Visita
				cerrar_reprogramacion_visitas_prospectos_crm();
				//Cerrar modal
				objProspectosCRM.close();
				//Si el id de la referencia (para la validación) se recuperó del modal Prospectos 
				if($('#txtModalProspectos_validacion_prospectos_crm').val() == 'SI')
				{
					//Hacer un llamado a la función para cerrar modal Enviar a Validación
					cerrar_validacion_prospectos_crm();
				}
				//Enfocar caja de texto 
				$('#txtBusqueda_prospectos_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_prospectos_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_prospectos_crm();
			//Validación del formulario de campos obligatorios
			$('#frmProspectosCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strNombreComercial_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Escriba un nombre comercial'}
											}
										},
										strTelefonoPrincipal_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Escriba un número telefónico'},
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strTelefonoSecundario_prospectos_crm: {
											validators: {
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strCalle_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Escriba una calle'}
											}
										},
										strNumeroExterior_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Escriba un número exterior'}
											}
										},
										strLocalidad_prospectos_crm: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la localidad
					                                    if($('#txtLocalidadID_prospectos_crm').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una localidad existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCodigoPostal_prospectos_crm: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
					                                    if(value !== '' && $('#txtCodigoPostalID_prospectos_crm').val() === '')
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
										strCorreoElectronico_prospectos_crm: {
				                        	validators: {
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strContactoTelefono_prospectos_crm: {
											validators: {
												stringLength: {
													min: 10,
													message: 'El número telefónico debe tener 10 caracteres de longitud'
												}
											}
										},
										strContactoCelular_prospectos_crm: {
											validators: {
												stringLength: {
													min: 10,
													message: 'El número de celular debe tener 10 caracteres de longitud'
												}
											}
										},
										strContactoCorreoElectronico_prospectos_crm: {
				                        	validators: {
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strDescripcion_inventario_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strAnio_inventario_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strSerie_inventario_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strMaquinariaMarca_inventario_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strMaquinariaModelo_inventario_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intHoras_inventario_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCaballos_inventario_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strTraccion_inventario_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strActividad_actividades_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strCultivo_cultivos_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intHectareas_cultivos_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaInicialBusq_visitas_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaFinalBusq_visitas_prospectos_crm: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_prospectos_crm = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_prospectos_crm = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_prospectos_crm.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_prospectos_crm.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_prospectos_crm = $('#frmProspectosCRM').data('bootstrapValidator');
			bootstrapValidator_prospectos_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_prospectos_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_prospectos_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_prospectos_crm()
		{
			try
			{
				$('#frmProspectosCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_prospectos_crm()
		{
			//Array que se utiliza para agregar módulos
			var arrModulos = '';
			//Arreglo para obtener módulos seleccionados
			var chkModulosArray = [];
			chkModulosArray = modulos_seleccionados_prospectos_crm();
			//Verificamos que al menos se encuentre un módulo seleccionado
			if(chkModulosArray.length > 0)
			{
				arrModulos = chkModulosArray.join('|');
			}

			//Obtenemos el objeto de la tabla inventario
			var objTabla = document.getElementById('dg_inventario_prospectos_crm').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrDescripciones = [];
			var arrMaquinariaMarcaID = [];
			var arrMaquinariaModeloID = [];
			var arrAnios = [];
			var arrSeries = [];
			var arrHoras = [];
			var arrCaballos = [];
			var arrTracciones = [];
			var arrRecambios = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intHoras = $.reemplazar(objRen.cells[8].innerHTML, ",", "");
				
				//Asignar valores a los arrays
				arrDescripciones.push(objRen.cells[0].innerHTML);
				arrMaquinariaMarcaID.push(objRen.cells[5].innerHTML);
				arrMaquinariaModeloID.push(objRen.cells[6].innerHTML);
				arrAnios.push(objRen.cells[3].innerHTML);
				arrSeries.push(objRen.cells[7].innerHTML);
				arrHoras.push(intHoras);
				arrCaballos.push(objRen.cells[9].innerHTML);
				arrTracciones.push(objRen.cells[10].innerHTML);
				arrRecambios.push(objRen.cells[11].innerHTML);
			}

			//Obtenemos el objeto de la tabla actividades
			var objTabla = document.getElementById('dg_actividades_prospectos_crm').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrActividadID = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Asignar valores al array
				arrActividadID.push(objRen.getAttribute('id'));
			}

			//Obtenemos el objeto de la tabla cultivos
			var objTabla = document.getElementById('dg_cultivos_prospectos_crm').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrCultivoID = [];
			var arrHectareas = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intHectareas = $.reemplazar(objRen.cells[1].innerHTML, ",", "");
				//Asignar valores a los arrays
				arrCultivoID.push(objRen.getAttribute('id'));
				arrHectareas.push(intHectareas);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/prospectos/guardar',
					{ 
						//Datos del prospecto
						intProspectoID: $('#txtProspectoID_prospectos_crm').val(),
						strNombreComercial: $('#txtNombreComercial_prospectos_crm').val(),
						strTelefonoPrincipal: $('#txtTelefonoPrincipal_prospectos_crm').val(),
						strTelefonoSecundario: $('#txtTelefonoSecundario_prospectos_crm').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_prospectos_crm').val(),
						strPaginaWeb: $('#txtPaginaWeb_prospectos_crm').val(),
						strCalle: $('#txtCalle_prospectos_crm').val(),
						strNumeroExterior: $('#txtNumeroExterior_prospectos_crm').val(),
						strNumeroInterior: $('#txtNumeroInterior_prospectos_crm').val(),
						strColonia: $('#txtColonia_prospectos_crm').val(),
						strReferencia: $('#txtReferencia_prospectos_crm').val(),
						intCodigoPostalID: $('#txtCodigoPostalID_prospectos_crm').val(),
						intLocalidadID: $('#txtLocalidadID_prospectos_crm').val(),
						strContactoNombre: $('#txtContactoNombre_prospectos_crm').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteContactoFechaNacimiento: $.formatFechaMysql($('#txtContactoFechaNacimiento_prospectos_crm').val()),
						strContactoTelefono: $('#txtContactoTelefono_prospectos_crm').val(),
						strContactoExtension: $('#txtContactoExtension_prospectos_crm').val(),
						strContactoCelular: $('#txtContactoCelular_prospectos_crm').val(),
						strContactoCorreoElectronico: $('#txtContactoCorreoElectronico_prospectos_crm').val(),
						strContactoHobbies: $('#txtContactoHobbies_prospectos_crm').val(),
						strImportante: arrModulos,
						intHectareasTemporal: $('#txtHectareasTemporal_prospectos_crm').val(),
						intHectareasRiego: $('#txtHectareasRiego_prospectos_crm').val(),
						intHectareasOtras: $('#txtHectareasOtras_prospectos_crm').val(),
						intTerrenoArenoso: $('#txtTerrenoArenoso_prospectos_crm').val(),
						intTerrenoArcilloso: $('#txtTerrenoArcilloso_prospectos_crm').val(),
						intTerrenoCompacto: $('#txtTerrenoCompacto_prospectos_crm').val(),
						intTerrenoPedregoso: $('#txtTerrenoPedregoso_prospectos_crm').val(),
						intTerrenoOtros: $('#txtTerrenoOtros_prospectos_crm').val(),
						//Datos del inventario
						strSeries: arrSeries.join('|'),
						strMaquinariaMarcaID: arrMaquinariaMarcaID.join('|'),
						strMaquinariaModeloID: arrMaquinariaModeloID.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strAnios: arrAnios.join('|'),
						strHoras: arrHoras.join('|'),
						strCaballos: arrCaballos.join('|'),
						strTracciones: arrTracciones.join('|'),
						strRecambios: arrRecambios.join('|'),
						//Datos de las actividades
						strActividadID: arrActividadID.join('|'),
						//Datos de los cultivos
						strCultivoID: arrCultivoID.join('|'),
						strHectareas: arrHectareas.join('|')
					},
					function(data) {
						if (data.resultado)
						{
                     		//Si no existe id del prospecto, significa que es un nuevo registro
							if($('#txtProspectoID_prospectos_crm').val() == '')
							{
								//Hacer un llamado a la función para recuperar los datos del prospecto registrado en la base de datos
								editar_prospectos_crm(data.prospecto_id, 'Nuevo');
								//Seleccionar tab que contiene la información del expediente
								$('a[href="#expediente_prospectos_crm"]').click();
							}
							else
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_prospectos_crm();   
							}       

							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_prospectos_crm();        
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_prospectos_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');

		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_prospectos_crm(tipoMensaje, mensaje)
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
		function cambiar_estatus_prospectos_crm(id, estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtProspectoID_prospectos_crm').val();

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
				              'title':    'Prospectos',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {

				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_prospectos_crm(intID, strTipo, 'INACTIVO');

				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_prospectos_crm(intID, strTipo, 'ACTIVO');

		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_prospectos_crm(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('crm/prospectos/set_estatus',
			      {intProspectoID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_prospectos_crm();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_prospectos_crm();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_prospectos_crm(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_prospectos_crm(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/prospectos/get_datos',
	       {
	       		intProspectoID: id
	       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_prospectos_crm();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtProspectoID_prospectos_crm').val(data.row.prospecto_id);
				            $('#txtCodigo_prospectos_crm').val(data.row.codigo);
						    $('#txtNombreComercial_prospectos_crm').val(data.row.nombre_comercial);
						    $('#txtTelefonoPrincipal_prospectos_crm').val(data.row.telefono_principal);
						    $('#txtTelefonoSecundario_prospectos_crm').val(data.row.telefono_secundario);
						    $('#txtCorreoElectronico_prospectos_crm').val(data.row.correo_electronico);
						    $('#txtPaginaWeb_prospectos_crm').val(data.row.pagina_web);
						    $('#txtCalle_prospectos_crm').val(data.row.calle);
						    $('#txtNumeroExterior_prospectos_crm').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_prospectos_crm').val(data.row.numero_interior);
						    $('#txtColonia_prospectos_crm').val(data.row.colonia);
						    $('#txtReferencia_prospectos_crm').val(data.row.referencia);
						    $('#txtCodigoPostalID_prospectos_crm').val(data.row.codigo_postal_id);
						    $('#txtCodigoPostal_prospectos_crm').val(data.row.codigo_postal);
						    $('#txtLocalidadID_prospectos_crm').val(data.row.localidad_id);
						    $('#txtLocalidad_prospectos_crm').val(data.row.localidad);
						    $('#txtMunicipioID_prospectos_crm').val(data.row.municipio_id);
						    $('#txtMunicipio_prospectos_crm').val(data.row.municipio);
						    $('#txtEstado_prospectos_crm').val(data.row.estado);
						    $('#txtPais_prospectos_crm').val(data.row.pais);
						    $('#txtContactoNombre_prospectos_crm').val(data.row.contacto_nombre);
						    $('#txtContactoFechaNacimiento_prospectos_crm').val(data.row.fecha_nacimiento);
						    $('#txtContactoTelefono_prospectos_crm').val(data.row.contacto_telefono);
						    $('#txtContactoExtension_prospectos_crm').val(data.row.contacto_extension);
						    $('#txtContactoCelular_prospectos_crm').val(data.row.contacto_celular);
						    $('#txtContactoCorreoElectronico_prospectos_crm').val(data.row.contacto_correo_electronico);
						    $('#txtContactoHobbies_prospectos_crm').val(data.row.contacto_hobbies);
							//Módulos seleccionados para este Prospecto (en caso de que aplique)
							$('#txtModulosSeleccionadosID_prospectos_crm').val(data.row.importante);
						    $('#txtHectareasTemporal_prospectos_crm').val(data.row.hectareas_temporal);
						    $('#txtHectareasRiego_prospectos_crm').val(data.row.hectareas_riego);
						    $('#txtHectareasOtras_prospectos_crm').val(data.row.hectareas_otras);
						    $('#txtTerrenoArenoso_prospectos_crm').val(data.row.terreno_arenoso);
						    $('#txtTerrenoArcilloso_prospectos_crm').val(data.row.terreno_arcilloso);
						    $('#txtTerrenoCompacto_prospectos_crm').val(data.row.terreno_compacto);
						    $('#txtTerrenoPedregoso_prospectos_crm').val(data.row.terreno_pedregoso);
						    $('#txtTerrenoOtros_prospectos_crm').val(data.row.terreno_otros);
						    $('#txtEstatusCliente_prospectos_crm').val(data.row.cliente_estatus);
						    $('#txtEstatus_prospectos_crm').val(strEstatus);
						    //Quitar clase disabled disabledTab para habilitar los siguientes tabs
						    $('#tabExpediente_prospectos_crm').removeClass("disabled disabledTab");
				            $('#tabVisitas_prospectos_crm').removeClass("disabled disabledTab");
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_prospectos_crm').addClass("estatus-"+strEstatus);
				            //Hacer llamado a la función  para cargar las visitas en el grid
				            paginacion_visitas_prospectos_crm();
				            //Hacer llamado a la función  para cargar los documentos activos en el grid
				            documentos_expediente_prospectos_crm();
				            //Mostramos el inventario del registro
				            for (var intCon in data.inventario) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_inventario_prospectos_crm').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaDescripcion = objRenglon.insertCell(0);
								var objCeldaMaquinariaMarca = objRenglon.insertCell(1);
								var objCeldaMaquinariaModelo = objRenglon.insertCell(2);
								var objCeldaAnio = objRenglon.insertCell(3);
								var objCeldaAcciones = objRenglon.insertCell(4);
								//Columnas ocultas
								var objCeldaMaquinariaMarcaID = objRenglon.insertCell(5);
								var objCeldaMaquinariaModeloID = objRenglon.insertCell(6);
								var objCeldaSerie = objRenglon.insertCell(7);
								var objCeldaHoras = objRenglon.insertCell(8);
								var objCeldaCaballos = objRenglon.insertCell(9);
								var objCeldaTraccion = objRenglon.insertCell(10);
								var objCeldaRecambio = objRenglon.insertCell(11);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.inventario[intCon].serie);
								objCeldaDescripcion.setAttribute('class', 'movil b1');
								objCeldaDescripcion.innerHTML = data.inventario[intCon].descripcion;
								objCeldaMaquinariaMarca.setAttribute('class', 'movil b2');
								objCeldaMaquinariaMarca.innerHTML = data.inventario[intCon].maquinaria_marca;
								objCeldaMaquinariaModelo.setAttribute('class', 'movil b3');
								objCeldaMaquinariaModelo.innerHTML = data.inventario[intCon].maquinaria_modelo;
								objCeldaAnio.setAttribute('class', 'movil b4');
								objCeldaAnio.innerHTML = data.inventario[intCon].anio;
								objCeldaAcciones.setAttribute('class', 'td-center movil b5');
								objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 			 "   onclick='editar_renglon_inventario_prospectos_crm(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button> " + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 			 "  onclick='eliminar_renglon_inventario_prospectos_crm(this)'>" + 
												 			"<span class='glyphicon glyphicon-trash'></span></button>";
								objCeldaMaquinariaMarcaID.setAttribute('class', 'no-mostrar');
								objCeldaMaquinariaMarcaID.innerHTML = data.inventario[intCon].maquinaria_marca_id;
								objCeldaMaquinariaModeloID.setAttribute('class', 'no-mostrar');
								objCeldaMaquinariaModeloID.innerHTML = data.inventario[intCon].maquinaria_modelo_id;
								objCeldaSerie.setAttribute('class', 'no-mostrar');
								objCeldaSerie.innerHTML = data.inventario[intCon].serie;
								objCeldaHoras.setAttribute('class', 'no-mostrar');
								objCeldaHoras.innerHTML = formatMoney(data.inventario[intCon].horas, 2, '');
								objCeldaCaballos.setAttribute('class', 'no-mostrar');
								objCeldaCaballos.innerHTML = data.inventario[intCon].caballos;
								objCeldaTraccion.setAttribute('class', 'no-mostrar');
								objCeldaTraccion.innerHTML =  data.inventario[intCon].traccion;
								objCeldaRecambio.setAttribute('class', 'no-mostrar');
								objCeldaRecambio.innerHTML =  data.inventario[intCon].recambio;
							
							}

							//Asignar el número de filas de la tabla inventario (se quita la primer fila por que corresponde al encabezado de la tabla)
							var intFilas = $("#dg_inventario_prospectos_crm tr").length - 1;
							$('#numElementos_inventario_prospectos_crm').html(intFilas);

							//Mostramos las actividades del registro
				            for (var intCon in data.actividades) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_actividades_prospectos_crm').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaActividad = objRenglon.insertCell(0);
								var objCeldaAcciones = objRenglon.insertCell(1);
					
								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.actividades[intCon].actividad_id);
								objCeldaActividad.setAttribute('class', 'movil c1');
								objCeldaActividad.innerHTML = data.actividades[intCon].actividad;
								objCeldaAcciones.setAttribute('class', 'td-center movil c2');
								objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 			 "  onclick='eliminar_renglon_actividades_prospectos_crm(this)'>" + 
												 			"<span class='glyphicon glyphicon-trash'></span></button>";
							}

							//Asignar el número de filas de la tabla actividades (se quita la primer fila por que corresponde al encabezado de la tabla)
							var intFilas = $("#dg_actividades_prospectos_crm tr").length - 1;
							$('#numElementos_actividades_prospectos_crm').html(intFilas);

							//Mostramos los cultivos del registro
				            for (var intCon in data.cultivos) {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_cultivos_prospectos_crm').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaCultivo = objRenglon.insertCell(0);
								var objCeldaHectareas = objRenglon.insertCell(1);
								var objCeldaAcciones = objRenglon.insertCell(2);

								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.cultivos[intCon].cultivo_id);
								objCeldaCultivo.setAttribute('class', 'movil d1');
								objCeldaCultivo.innerHTML = data.cultivos[intCon].cultivo;
								objCeldaHectareas.setAttribute('class', 'movil d2');
								objCeldaHectareas.innerHTML = formatMoney(data.cultivos[intCon].hectareas, 2, '');
								objCeldaAcciones.setAttribute('class', 'td-center movil d3');
								objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 			 "   onclick='editar_renglon_cultivos_prospectos_crm(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button> " + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 			 "  onclick='eliminar_renglon_cultivos_prospectos_crm(this)'>" + 
												 			"<span class='glyphicon glyphicon-trash'></span></button>";
							}

							//Asignar el número de filas de la tabla cultivos (se quita la primer fila por que corresponde al encabezado de la tabla)
							var intFilas = $("#dg_cultivos_prospectos_crm tr").length - 1;
							$('#numElementos_cultivos_prospectos_crm').html(intFilas);

				           //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_prospectos_crm").show();

				            	/*Si el prospecto no se encuentra en la tabla clientes
				 				  o el cliente (prospecto) se encuentra rechazado*/
				            	if(data.row.cliente == null || data.row.cliente_estatus == 'RECHAZADO')
				            	{
				            		//Mostrar botón Enviar a validación
				            		$("#btnEnviarValidacion_prospectos_crm").show();
				            	}
							}
							else 
							{	
							
								//Deshabilitar todos los elementos del formulario
			            		$('#frmProspectosCRM').find('input, textarea, select').attr('disabled','disabled');
			            		//Habilitar las siguientes cajas de texto
								$('#txtFechaInicialBusq_visitas_prospectos_crm').removeAttr("disabled", "disabled");
								$('#txtFechaFinalBusq_visitas_prospectos_crm').removeAttr("disabled", "disabled");
								$('#txtHoraInicialBusq_visitas_prospectos_crm').removeAttr("disabled", "disabled");
								$('#txtHoraFinalBusq_visitas_prospectos_crm').removeAttr("disabled", "disabled");
								$('#txtModuloBusq_visitas_prospectos_crm').removeAttr("disabled", "disabled");
			            		//Ocultar los siguientes botones
				           		$("#btnGuardar_prospectos_crm").hide(); 
				           		$("#btnNuevo_visitas_prospectos_crm").hide();
								
								//Mostrar botón Restaurar
								$("#btnRestaurar_prospectos_crm").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Seleccionar tab que contiene la información general
		  						$('a[href="#informacion_general_prospectos_crm"]').click();
				            	//Abrir modal
					            objProspectosCRM = $('#ProspectosCRMBox').bPopup({
															  appendTo: '#ProspectosCRMContent', 
								                              contentContainer: 'ProspectosCRMM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtNombreComercial_prospectos_crm').focus();
					        }
			       	    }
			       },
			       'json');

		}

		//Función que se utiliza para copiar los datos del prospecto
		function copiar_prospectos_crm()
		{	
			//Asignar valores del prospecto a los datos del contacto
			$('#txtContactoNombre_prospectos_crm').val(document.getElementById("txtNombreComercial_prospectos_crm").value);
	        $('#txtContactoTelefono_prospectos_crm').val(document.getElementById("txtTelefonoPrincipal_prospectos_crm").value);
	        $('#txtContactoCelular_prospectos_crm').val(document.getElementById("txtTelefonoSecundario_prospectos_crm").value);
	        $('#txtContactoCorreoElectronico_prospectos_crm').val(document.getElementById("txtCorreoElectronico_prospectos_crm").value);
		}


		//Función para regresar y obtener los datos de un código postal
		function get_datos_codigo_postal_prospectos_crm()
		{
			//Hacer un llamado al método del controlador para regresar los datos del código postal
          	$.post('contabilidad/sat_codigos_postales/get_datos',
                  { 
                  	strBusqueda:$("#txtCodigoPostalID_prospectos_crm").val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                       $('#txtLocalidadID_prospectos_crm').val('');
                       $('#txtLocalidad_prospectos_crm').val('');
                       $("#txtMunicipioID_prospectos_crm").val(data.row.municipio_id);
                       $("#txtMunicipio_prospectos_crm").val(data.row.municipio);
                       $("#txtEstado_prospectos_crm").val(data.row.estado);
                       $("#txtPais_prospectos_crm").val(data.row.pais);
                    }
                  }
                 ,
                'json');
		}


		//Función para regresar y obtener los datos de una localidad
		function get_datos_localidad_prospectos_crm()
		{
			//Hacer un llamado al método del controlador para regresar los datos de la localidad
          	$.post('crm/localidades/get_datos',
	                  { 
	                  	strBusqueda:$("#txtLocalidadID_prospectos_crm").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtLocalidad_prospectos_crm").val(data.row.localidad);
	                       $("#txtMunicipio_prospectos_crm").val(data.row.municipio);
	                       $("#txtEstado_prospectos_crm").val(data.row.estado);
	                       $("#txtPais_prospectos_crm").val(data.row.pais);
	                    }
	                  }
	                 ,
	                'json');
		}


		/*******************************************************************************************************************
		Funciones del Tab - Inventario
		*********************************************************************************************************************/
		//Función para mostrar los campos de captura 
		function mostrar_campos_inventario_prospectos_crm()
		{
			//Quitar clase no-mostrar para mostrar los siguientes controles
	   		$('#divDatos_inventario_prospectos_crm').removeClass("no-mostrar");
	   		$('#btnOcultar_inventario_prospectos_crm').removeClass("no-mostrar");
	   		//Agregar clase no-mostrar para ocultar botón
	   		$('#btnMostrar_inventario_prospectos_crm').addClass("no-mostrar");
		}

		//Función para ocultar los campos de captura 
		function ocultar_campos_inventario_prospectos_crm()
		{
			//Agregar clase no-mostrar para ocultar los siguientes controles
	   		$('#divDatos_inventario_prospectos_crm').addClass("no-mostrar");
	   		$('#btnOcultar_inventario_prospectos_crm').addClass("no-mostrar");
	   		//Quitar clase no-mostrar para mostrar botón
	   		$('#btnMostrar_inventario_prospectos_crm').removeClass("no-mostrar");
		}

		/*******************************************************************************************************************
		Funciones de la tabla inventario
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_inventario_prospectos_crm()
		{
			//Obtenemos los datos de las cajas de texto
			var strDescripcion = $('#txtDescripcion_inventario_prospectos_crm').val();
			var strAnio = $('#txtAnio_inventario_prospectos_crm').val();
			var strSerie = $('#txtSerie_inventario_prospectos_crm').val();
			var intMaquinariaMarcaID = $('#txtMaquinariaMarcaID_inventario_prospectos_crm').val();
			var strMaquinariaMarca = $('#txtMaquinariaMarca_inventario_prospectos_crm').val();
			var intMaquinariaModeloID = $('#txtMaquinariaModeloID_inventario_prospectos_crm').val();
			var strMaquinariaModelo = $('#txtMaquinariaModelo_inventario_prospectos_crm').val();
			var intHoras = $('#txtHoras_inventario_prospectos_crm').val();
			var strCaballos = $('#txtCaballos_inventario_prospectos_crm').val();
			var strTraccion = $('#txtTraccion_inventario_prospectos_crm').val();
			var strRecambio = $('#cmbRecambio_inventario_prospectos_crm').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_inventario_prospectos_crm').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (strDescripcion == '')
			{
				//Enfocar caja de texto
				$('#txtDescripcion_inventario_prospectos_crm').focus();
			}
			else if (strAnio == '' || strAnio.length != 4)
			{
				//Enfocar caja de texto
				$('#txtAnio_inventario_prospectos_crm').focus();
			}
			else if (intMaquinariaMarcaID == '' || strMaquinariaMarca == '')
			{
				//Enfocar caja de texto
				$('#txtMaquinariaMarca_inventario_prospectos_crm').focus();
			}
			else if (intMaquinariaModeloID == '' || strMaquinariaModelo == '')
			{
				//Enfocar caja de texto
				$('#txtMaquinariaModelo_inventario_prospectos_crm').focus();
			}
			else if (intHoras == '')
			{
				//Enfocar caja de texto
				$('#txtHoras_inventario_prospectos_crm').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtDescripcion_inventario_prospectos_crm').val('');
				$('#txtAnio_inventario_prospectos_crm').val('');
			    $('#txtSerie_inventario_prospectos_crm').val('');
			    $('#txtMaquinariaMarcaID_inventario_prospectos_crm').val('');
			    $('#txtMaquinariaMarca_inventario_prospectos_crm').val('');
			    $('#txtMaquinariaModeloID_inventario_prospectos_crm').val('');
			    $('#txtMaquinariaModelo_inventario_prospectos_crm').val('');
			    $('#txtHoras_inventario_prospectos_crm').val('');
			    $('#txtCaballos_inventario_prospectos_crm').val('');
			    $('#txtTraccion_inventario_prospectos_crm').val('');
			    $('#cmbRecambio_inventario_prospectos_crm').val('LARGO PLAZO');

				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strDescripcion = strDescripcion.toUpperCase();
				strSerie = strSerie.toUpperCase();
				strTraccion = strTraccion.toUpperCase();

				//Revisamos si existe la descripción proporcionada, si es así, editamos los datos
				if (objTabla.rows.namedItem(strSerie))
				{
					objTabla.rows.namedItem(strSerie).cells[0].innerHTML = strDescripcion
					objTabla.rows.namedItem(strSerie).cells[1].innerHTML = strMaquinariaMarca;
					objTabla.rows.namedItem(strSerie).cells[2].innerHTML = strMaquinariaModelo;
					objTabla.rows.namedItem(strSerie).cells[3].innerHTML = strAnio;
					objTabla.rows.namedItem(strSerie).cells[5].innerHTML = intMaquinariaMarcaID;
					objTabla.rows.namedItem(strSerie).cells[6].innerHTML = intMaquinariaModeloID;
					objTabla.rows.namedItem(strSerie).cells[7].innerHTML = strSerie;
					objTabla.rows.namedItem(strSerie).cells[8].innerHTML = intHoras;
					objTabla.rows.namedItem(strSerie).cells[9].innerHTML = strCaballos;
					objTabla.rows.namedItem(strSerie).cells[10].innerHTML = strTraccion;
					objTabla.rows.namedItem(strSerie).cells[11].innerHTML = strRecambio;

				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaDescripcion = objRenglon.insertCell(0);
					var objCeldaMaquinariaMarca = objRenglon.insertCell(1);
					var objCeldaMaquinariaModelo = objRenglon.insertCell(2);
					var objCeldaAnio = objRenglon.insertCell(3);
					var objCeldaAcciones = objRenglon.insertCell(4);
					//Columnas ocultas
					var objCeldaMaquinariaMarcaID = objRenglon.insertCell(5);
					var objCeldaMaquinariaModeloID = objRenglon.insertCell(6);
					var objCeldaSerie = objRenglon.insertCell(7);
					var objCeldaHoras = objRenglon.insertCell(8);
					var objCeldaCaballos = objRenglon.insertCell(9);
					var objCeldaTraccion = objRenglon.insertCell(10);
					var objCeldaRecambio = objRenglon.insertCell(11);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strSerie);
					objCeldaDescripcion.setAttribute('class', 'movil b1');
					objCeldaDescripcion.innerHTML = strDescripcion;
					objCeldaMaquinariaMarca.setAttribute('class', 'movil b2');
					objCeldaMaquinariaMarca.innerHTML = strMaquinariaMarca;
					objCeldaMaquinariaModelo.setAttribute('class', 'movil b3');
					objCeldaMaquinariaModelo.innerHTML = strMaquinariaModelo;
					objCeldaAnio.setAttribute('class', 'movil b4');
					objCeldaAnio.innerHTML = strAnio;
					objCeldaAcciones.setAttribute('class', 'td-center movil b5');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_inventario_prospectos_crm(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button> " + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_inventario_prospectos_crm(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>";
					objCeldaMaquinariaMarcaID.setAttribute('class', 'no-mostrar');
					objCeldaMaquinariaMarcaID.innerHTML = intMaquinariaMarcaID;
					objCeldaMaquinariaModeloID.setAttribute('class', 'no-mostrar');
					objCeldaMaquinariaModeloID.innerHTML = intMaquinariaModeloID;
					objCeldaSerie.setAttribute('class', 'no-mostrar');
					objCeldaSerie.innerHTML = strSerie;
					objCeldaHoras.setAttribute('class', 'no-mostrar');
					objCeldaHoras.innerHTML = intHoras;
					objCeldaCaballos.setAttribute('class', 'no-mostrar');
					objCeldaCaballos.innerHTML = strCaballos;
					objCeldaTraccion.setAttribute('class', 'no-mostrar');
					objCeldaTraccion.innerHTML = strTraccion;
					objCeldaRecambio.setAttribute('class', 'no-mostrar');
					objCeldaRecambio.innerHTML = strRecambio;

				}
				//Enfocar caja de texto
				$('#txtDescripcion_inventario_prospectos_crm').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_inventario_prospectos_crm tr").length - 1;
			$('#numElementos_inventario_prospectos_crm').html(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_inventario_prospectos_crm(objRenglon)
		{
			//Hacer un llamado a la función para mostrar los campos de captura del inventario
			mostrar_campos_inventario_prospectos_crm();
			//Asignar los valores a las cajas de texto
			$('#txtDescripcion_inventario_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtMaquinariaMarca_inventario_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtMaquinariaModelo_inventario_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtAnio_inventario_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtMaquinariaMarcaID_inventario_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[5].innerHTML);
			$('#txtMaquinariaModeloID_inventario_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[6].innerHTML);
			$('#txtSerie_inventario_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[7].innerHTML);
			$('#txtHoras_inventario_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[8].innerHTML);
			$('#txtCaballos_inventario_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[9].innerHTML);
			$('#txtTraccion_inventario_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#cmbRecambio_inventario_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			
			//Enfocar caja de texto
			$('#txtDescripcion_inventario_prospectos_crm').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_inventario_prospectos_crm(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_inventario_prospectos_crm").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_inventario_prospectos_crm tr").length - 1;
			$('#numElementos_inventario_prospectos_crm').html(intFilas);

			//Enfocar caja de texto
			$('#txtDescripcion_inventario_prospectos_crm').focus();
		}

		/*******************************************************************************************************************
		Funciones del Tab - Otros
		*********************************************************************************************************************/
		/*******************************************************************************************************************
		Funciones de la tabla actividades
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_actividades_prospectos_crm()
		{
			//Obtenemos los datos de las cajas de texto
			var intActividadID = $('#txtActividadID_actividades_prospectos_crm').val();
			var strActividad = $('#txtActividad_actividades_prospectos_crm').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_actividades_prospectos_crm').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intActividadID == '' || strActividad == '')
			{
				//Enfocar caja de texto
				$('#txtActividad_actividades_prospectos_crm').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtActividadID_actividades_prospectos_crm').val('');
				$('#txtActividad_actividades_prospectos_crm').val('');

				//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
				if (!objTabla.rows.namedItem(intActividadID))
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaActividad = objRenglon.insertCell(0);
					var objCeldaAcciones = objRenglon.insertCell(1);

					objRenglon.setAttribute('id', intActividadID);
					objCeldaActividad.setAttribute('class', 'movil c1');
					objCeldaActividad.innerHTML = strActividad;
					objCeldaAcciones.setAttribute('class', 'td-center movil c2');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_actividades_prospectos_crm(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>";
				
				}
				//Enfocar caja de texto
				$('#txtActividad_actividades_prospectos_crm').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_actividades_prospectos_crm tr").length - 1;
			$('#numElementos_actividades_prospectos_crm').html(intFilas);
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_actividades_prospectos_crm(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_actividades_prospectos_crm").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_actividades_prospectos_crm tr").length - 1;
			$('#numElementos_actividades_prospectos_crm').html(intFilas);

			//Enfocar caja de texto
			$('#txtActividad_actividades_prospectos_crm').focus();
		}

		/*******************************************************************************************************************
		Funciones de la tabla cultivos
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_cultivos_prospectos_crm()
		{
			//Obtenemos los datos de las cajas de texto
			var intCultivoID = $('#txtCultivoID_cultivos_prospectos_crm').val();
			var strCultivo = $('#txtCultivo_cultivos_prospectos_crm').val();
			var intHectareas = $('#txtHectareas_cultivos_prospectos_crm').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_cultivos_prospectos_crm').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intCultivoID == '' || strCultivo == '')
			{
				//Enfocar caja de texto
				$('#txtCultivo_cultivos_prospectos_crm').focus();
			}
			else if (intHectareas == '')
			{
				//Enfocar caja de texto
				$('#txtHectareas_cultivos_prospectos_crm').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtCultivoID_cultivos_prospectos_crm').val('');
				$('#txtCultivo_cultivos_prospectos_crm').val('');
			    $('#txtHectareas_cultivos_prospectos_crm').val('');


			    //Convertir cadena de texto a número decimal
				intHectareas = parseFloat($.reemplazar(intHectareas, ",", ""));

				//Cambiar cantidad a  formato moneda (a visualizar)
			    intHectareas = formatMoney(intHectareas, 2, '');

				//Revisamos si existe el ID proporcionado, si es así, editamos el número de hectáreas
				if (objTabla.rows.namedItem(intCultivoID))
				{
					objTabla.rows.namedItem(intCultivoID).cells[1].innerHTML = intHectareas;
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCultivo = objRenglon.insertCell(0);
					var objCeldaHectareas = objRenglon.insertCell(1);
					var objCeldaAcciones = objRenglon.insertCell(2);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intCultivoID);
					objCeldaCultivo.setAttribute('class', 'movil d1');
					objCeldaCultivo.innerHTML = strCultivo;
					objCeldaHectareas.setAttribute('class', 'movil d2');
					objCeldaHectareas.innerHTML = intHectareas;
					objCeldaAcciones.setAttribute('class', 'td-center movil d3');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_cultivos_prospectos_crm(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button> " + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_cultivos_prospectos_crm(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>";
				}
				//Enfocar caja de texto
				$('#txtCultivo_cultivos_prospectos_crm').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_cultivos_prospectos_crm tr").length - 1;
			$('#numElementos_cultivos_prospectos_crm').html(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_cultivos_prospectos_crm(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtCultivoID_cultivos_prospectos_crm').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtCultivo_cultivos_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtHectareas_cultivos_prospectos_crm').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);

			//Enfocar caja de texto
			$('#txtCultivo_cultivos_prospectos_crm').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_cultivos_prospectos_crm(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_cultivos_prospectos_crm").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_cultivos_prospectos_crm tr").length - 1;
			$('#numElementos_cultivos_prospectos_crm').html(intFilas);

			//Enfocar caja de texto
			$('#txtCultivo_cultivos_prospectos_crm').focus();
		}

		/*******************************************************************************************************************
		Funciones del Tab - Expediente
		*********************************************************************************************************************/
		//Función para la búsqueda de documentos activos
		function documentos_expediente_prospectos_crm() 
		{
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/documentos_clientes/get_activos',
					{	strTipo: 'Cliente',
						intID: $('#txtProspectoID_prospectos_crm').val(),
						strEstatus: $('#txtEstatus_prospectos_crm').val(),
						strPermisosAcceso: $('#txtAcciones_prospectos_crm').val()
					},
					function(data){
						$('#dg_expediente_prospectos_crm tbody').empty();
						var tmpExpedienteProspectosCRM = Mustache.render($('#plantilla_expediente_prospectos_crm').html(),data);
						$('#dg_expediente_prospectos_crm tbody').html(tmpExpedienteProspectosCRM);
						$('#numElementos_expediente_prospectos_crm').html(data.total_rows);
					},
			'json');
		}

		//Función para subir archivo (o imagen) de un registro desde el grid view
		function subir_archivo_expediente_prospectos_crm(documentoID)
		{
			//Variable que se utiliza para asignar archivo
			var strBotonArchivoIDExpedienteProspectosCRM="archivo_expediente_prospectos_crm"+documentoID;
			//Obtenemos un array con los datos del archivo
	        var file = $("#"+strBotonArchivoIDExpedienteProspectosCRM)[0].files[0];
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
			  				$('#'+strBotonArchivoIDExpedienteProspectosCRM).val('');
						   	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_prospectos_crm('error', data.mensaje);
						}
						else
						{	
							//Hacer un llamado al método del controlador para subir archivo del registro
							$('#'+strBotonArchivoIDExpedienteProspectosCRM).upload('cuentas_cobrar/clientes/subir_archivo',
									{ intDocumentoID:documentoID,
						      		  intProspectoID:$('#txtProspectoID_prospectos_crm').val(),
						      		  strBotonArchivoID: strBotonArchivoIDExpedienteProspectosCRM
									},
									function(data) {
										//Limpia ruta del archivo cargado
						         		$('#'+strBotonArchivoIDExpedienteProspectosCRM).val('');
										//Subida finalizada.
										if (data.resultado)
										{
						         			//Hacer llamado a la función  para cargar  los registros de los documentos (expediente) en el grid
						          	        documentos_expediente_prospectos_crm();
										}
										//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
										mensaje_prospectos_crm(data.tipo_mensaje, data.mensaje);
									});
						}
				     },
				     'json');
		}

		//Función que se utiliza para descargar el archivo (o imagen) del registro seleccionado
		function descargar_archivo_expediente_prospectos_crm(documentoID)
		{
			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'cuentas_cobrar/clientes/descargar_archivo',
							'data' : {
										'intProspectoID': $('#txtProspectoID_prospectos_crm').val(),
										'intDocumentoID': documentoID				
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);
		}


		//Función que se utiliza para eliminar el archivo (o imagen) del registro seleccionado
		function eliminar_archivo_expediente_prospectos_crm(documentoID)
		{
			//Hacer un llamado al método del controlador para eliminar el archivo del registro
			$.post('cuentas_cobrar/clientes/eliminar_archivo',
			     {intProspectoID: $('#txtProspectoID_prospectos_crm').val(),
			      intDocumentoID: documentoID
			     },
			     function(data) {
			        if(data.resultado)
			        {
			         	//Hacer llamado a la función  para cargar  los registros de los documentos (expediente) en el grid
		          	    documentos_expediente_prospectos_crm();
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_prospectos_crm(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		/*******************************************************************************************************************
		Funciones del Tab - Visitas
		*********************************************************************************************************************/
		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_paginacion_visitas_prospectos_crm()
		{
			/*Mensaje que se utiliza para informar al usuario que es necesario proporcionar fechas y horas*/
			var strMensajeError = '';

			//Definir reglas de validación
			//Verificar que exista fecha inicial cuando se proporcione la hora inicial
			if($('#txtHoraInicialBusq_visitas_prospectos_crm').val() !== '' && 
			   $('#txtFechaInicialBusq_visitas_prospectos_crm').val() == '')
			{
				strMensajeError += 'fecha inicial <br>';

			}
			
			//Verificar que exista hora inicial cuando se proporcione la fecha inicial
			if($('#txtFechaInicialBusq_visitas_prospectos_crm').val() !== '' && 
					$('	#txtHoraInicialBusq_visitas_prospectos_crm').val() == '')
			{
				strMensajeError += 'hora inicial <br>';
			}
			
			//Verificar que exista fecha final cuando se proporcione la hora final
			if($('#txtHoraFinalBusq_visitas_prospectos_crm').val() !== '' && 
					$('	#txtFechaFinalBusq_visitas_prospectos_crm').val() == '')
			{
				strMensajeError += 'fecha final <br>';
			}
			
			//Verificar que exista hora final cuando se proporcione la fecha final
			if($('#txtFechaFinalBusq_visitas_prospectos_crm').val() !== '' && 
					$('	#txtHoraFinalBusq_visitas_prospectos_crm').val() == '')
			{
				strMensajeError += 'hora final <br>';
			}
			
			//Si existe mensaje de error
			if(strMensajeError != '')
			{

				strMensajeError = 'Favor de proporcionar la siguiente información: <br> '+strMensajeError;
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_prospectos_crm('error', strMensajeError);
			}
			else
			{
				//Hacer llamado a la función  para cargar los registros en el grid
				paginacion_visitas_prospectos_crm();
			}
		}

		//Función para la búsqueda de registros
		function paginacion_visitas_prospectos_crm() 
		{

   			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaVisitasProspectosCRM =($('#txtFechaInicialBusq_visitas_prospectos_crm').val()+
   												       $('#txtHoraInicialBusq_visitas_prospectos_crm').val()+
   													   $('#txtFechaFinalBusq_visitas_prospectos_crm').val()+
   													   $('#txtHoraFinalBusq_visitas_prospectos_crm').val()+
   													   $('#txtModuloIDBusq_visitas_prospectos_crm').val()+
   													   $('#txtProspectoID_prospectos_crm').val());


			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaVisitasProspectosCRM != strUltimaBusquedaVisitasProspectosCRM)
			{
				intPaginaVisitasProspectosCRM = 0;
				strUltimaBusquedaVisitasProspectosCRM = strNuevaBusquedaVisitasProspectosCRM;
			}


			//Asignar valores para la búsqueda de registros
			var dteFechaInicialBusq = $.formatFechaMysql($('#txtFechaInicialBusq_visitas_prospectos_crm').val());
			var dteFechaFinalBusq =$.formatFechaMysql($('#txtFechaFinalBusq_visitas_prospectos_crm').val());

			//Hacer un llamado a la función para convertir hora a formato 24
			var strHoraInicialBusq = convertirHora12a24($('#txtHoraInicialBusq_visitas_prospectos_crm').val());
			var strHoraFinalBusq = convertirHora12a24($('#txtHoraFinalBusq_visitas_prospectos_crm').val());


			//Si existe fecha y hora inicial
			if(dteFechaInicialBusq != '' && strHoraInicialBusq != '')
			{
				//Concatenar los datos de la fecha y hora
				dteFechaInicialBusq += ' '+strHoraInicialBusq;
			}

			//Si existe fecha y hora final
			if(dteFechaFinalBusq != '' && strHoraFinalBusq != '')
			{
				//Concatenar los datos de la fecha y hora
				dteFechaFinalBusq += ' '+strHoraFinalBusq;
				
			}


			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('crm/prospectos_visitas/get_paginacion',
					{	
						intProspectoID:$('#txtProspectoID_prospectos_crm').val(),
					 	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: dteFechaInicialBusq,
						dteFechaFinal: dteFechaFinalBusq,
						intModuloID:$('#txtModuloIDBusq_visitas_prospectos_crm').val(),
						strEstatusProspecto:$('#txtEstatus_prospectos_crm').val(),
						intPagina:intPaginaVisitasProspectosCRM,
						strPermisosAcceso: $('#txtAcciones_prospectos_crm').val()
					},
					function(data){
						$('#dg_visitas_prospectos_crm tbody').empty();
						var tmpVisitasProspectosCRM= Mustache.render($('#plantilla_visitas_prospectos_crm').html(),data);
						$('#dg_visitas_prospectos_crm tbody').html(tmpVisitasProspectosCRM);
						$('#pagLinks_visitas_prospectos_crm').html(data.paginacion);
						$('#numElementos_visitas_prospectos_crm').html(data.total_rows);
						intPaginaVisitasProspectosCRM = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte genderal en PDF
		function reporte_visitas_prospectos_crm() 
		{
			//Asignar valores para la búsqueda de registros
			var dteFechaInicialBusq = $.formatFechaMysql($('#txtFechaInicialBusq_visitas_prospectos_crm').val());
			var dteFechaFinalBusq =$.formatFechaMysql($('#txtFechaFinalBusq_visitas_prospectos_crm').val());

			//Hacer un llamado a la función para convertir hora a formato 24
			var strHoraInicialBusq = convertirHora12a24($('#txtHoraInicialBusq_visitas_prospectos_crm').val());
			var strHoraFinalBusq = convertirHora12a24($('#txtHoraFinalBusq_visitas_prospectos_crm').val());


			//Si existe fecha y hora inicial
			if(dteFechaInicialBusq != '' && strHoraInicialBusq != '')
			{
				//Concatenar los datos de la fecha y hora
				dteFechaInicialBusq += ' '+strHoraInicialBusq;
			}

			//Si existe fecha y hora final
			if(dteFechaFinalBusq != '' && strHoraFinalBusq != '')
			{
				//Concatenar los datos de la fecha y hora
				dteFechaFinalBusq += ' '+strHoraFinalBusq;
				
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'crm/prospectos_visitas/get_reporte',
							'data' : {
										'intProspectoID': $('#txtProspectoID_prospectos_crm').val(),
										'dteFechaInicial': dteFechaInicialBusq,
										'strHoraInicial': $('#txtHoraInicialBusq_visitas_prospectos_crm').val(),
										'dteFechaFinal': dteFechaFinalBusq,
										'strHoraFinal': $('#txtHoraFinalBusq_visitas_prospectos_crm').val(),
										'intModuloID': $('#txtModuloIDBusq_visitas_prospectos_crm').val()
									 }
						   };


			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);

		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_visitas_prospectos_crm(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtProspectoVisitaID_visitas_prospectos_crm').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'crm/prospectos_visitas/get_reporte_registro',
							'data' : {
										'intProspectoVisitaID': intID,
										'intProspectoID': $('#txtProspectoID_prospectos_crm').val()
									 }
						   };


			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);

		}


		/*******************************************************************************************************************
		Funciones del modal Visitas
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_visitas_prospectos_crm(tipoAccion)
		{
			//Incializar formulario
			$('#frmVisitasProspectosCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_visitas_prospectos_crm();
			//Limpiar cajas de texto ocultas
			$('#frmVisitasProspectosCRM').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_visitas_prospectos_crm');
			//Habilitar todos los elementos del formulario
			$('#frmVisitasProspectosCRM').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_visitas_prospectos_crm').val(fechaActual());
			//Inicializar datetimepicker
			$('#dteFechaProbabilidadCompra_visitas_prospectos_crm').data("DateTimePicker").date(fechaActual());
			$('#txtFechaProbabilidadCompra_visitas_prospectos_crm').val('');
			$('#dteFechaProximaVisita_visitas_prospectos_crm').data("DateTimePicker").date(fechaActual());
			$('#txtFechaProximaVisita_visitas_prospectos_crm').val('');

			//Asignar la hora actual
			$('#txtHora_visitas_prospectos_crm').val(horaActualSinSegundos()); 
			//Inicializar timepicker
			$('#txtHoraProximaVisita_visitas_prospectos_crm').timepicker('setTime', '12:00 PM');
			$('#txtHoraProximaVisita_visitas_prospectos_crm').val('');
			//Asignar NO para indicar que no se ha abierto el modal Reprogramación de Visita
			$('#txtModalVisitas_reprogramacion_visitas_prospectos_crm').val('NO');
			//Mostrar botón Guardar
			$("#btnGuardar_visitas_prospectos_crm").show();
			//Ocultar los siguientes botones
			$("#btnSeguimiento_visitas_prospectos_crm").hide();
			$("#btnImprimirRegistro_visitas_prospectos_crm").hide();
			$("#btnReprogramacion_visitas_prospectos_crm").hide();
			//Deshabilitar las siguientes cajas de texto
			//$('#txtFecha_visitas_prospectos_crm').prop('disabled', true);
			$('#txtFechaCreacion_visitas_prospectos_crm').prop('disabled', true);

			//Hacer un llamado a la función para cambiar el tamaño del campo estrategia
			cambiar_tamano_campos_visitas_prospectos_crm(tipoAccion);
		}


		//Función para cambiar el tamaño del campo estrategia
		function cambiar_tamano_campos_visitas_prospectos_crm(tipoAccion)
		{
			//Variable que se utiliza para cambiar el tamaño del campo a 9 posiciones
			var strClassMD9 = "col-sm-9 col-md-9 col-lg-9 col-xs-12";
			//Variable que se utiliza para cambiar el tamaño del campo a 6 posiciones
			var strClassMD6 = "col-sm-6 col-md-6 col-lg-6 col-xs-12";

			//Si el tipo de acción corresponde a Nuevo
			if(tipoAccion == 'Nuevo')
			{
				//Quitar clase para cambiar el tamaño del campo a 6 posiciones
				$('#divEstrategia_visitas_prospectos_crm').removeClass(strClassMD6);
				//Agregar clase para cambiar el tamaño del campo a 9 posiciones
			    $('#divEstrategia_visitas_prospectos_crm').addClass(strClassMD9);
			    //Agregar clase para ocultar div fecha de captura (creación)
				$('#divFechaCreacion_visitas_prospectos_crm').addClass('no-mostrar');
			}
			else
			{
				//Quitar clase para cambiar el tamaño del campo a 9 posiciones
				$('#divEstrategia_visitas_prospectos_crm').removeClass(strClassMD9);
				//Agregar clase para cambiar el tamaño del campo a 6 posiciones
			    $('#divEstrategia_visitas_prospectos_crm').addClass(strClassMD6);
			    //Quitar clase para mostrar div fecha de captura (creación)
			    $('#divFechaCreacion_visitas_prospectos_crm').removeClass('no-mostrar');
			}
		}



		//Función para inicializar elementos del módulo
		function inicializar_modulo_prospectos_crm()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtEstrategiaID_visitas_prospectos_crm').val('');
			$('#txtEstrategia_visitas_prospectos_crm').val('');
		}


		//Función que se utiliza para abrir el modal
		function abrir_visitas_prospectos_crm()
		{
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_visitas_prospectos_crm').addClass("estatus-NUEVO");
			//Abrir modal
            objVisitasProspectosCRM = $('#VisitasProspectosCRMBox').bPopup({
										  appendTo: '#ProspectosCRMContent', 
			                              contentContainer: 'ProspectosCRMM', 
			                              zIndex: 2, 
			                              modalClose: false, 
			                              modal: true, 
			                              follow: [true,false], 
			                              followEasing : "linear", 
			                              easing: "linear", 
			                              modalColor: ('#F0F0F0')});
            //Enfocar caja de texto
			$('#txtModulo_visitas_prospectos_crm').focus();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_visitas_prospectos_crm()
		{
			try {
				//Cerrar modal
				objVisitasProspectosCRM.close();
				//Si el id de la referencia (para la reprogramación) se recuperó del modal Visitas 
				if($('#txtModalVisitas_reprogramacion_visitas_prospectos_crm').val() == 'SI')
				{
					//Hacer un llamado a la función para cerrar modal Reprogramación de Visita
					cerrar_reprogramacion_visitas_prospectos_crm();
				}
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_visitas_prospectos_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_visitas_prospectos_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_visitas_prospectos_crm();
			//Validación del formulario de campos obligatorios
			$('#frmVisitasProspectosCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strModulo_visitas_prospectos_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del módulo
					                                    if($('#txtModuloID_visitas_prospectos_crm').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un módulo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strEstrategia_visitas_prospectos_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la estrategia
					                                    if($('#txtEstrategiaID_visitas_prospectos_crm').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una estrategia existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strMaquinariaDescripcion_visitas_prospectos_crm: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la descripción de maquinaria
					                                    if(value !== '' && $('#txtMaquinariaDescripcionID_visitas_prospectos_crm').val() === '') 
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una descripción existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFecha_visitas_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strHora_visitas_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una hora'}
											}
										},
										strComentario_visitas_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Escriba un comentario'}
											}
										},
										strMotivoVisita_visitas_prospectos_crm: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del motivo de la visita
					                                    if($('#txtMotivoVisitaID_visitas_prospectos_crm').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un motivo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCondicionesPago_visitas_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una condición de pago'}
											}
										},
										strMadurez_visitas_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una madurez'}
											}
										},
										strPlazo_visitas_prospectos_crm: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                  	//Verificar si la condición de pago es crédito
				                                      	if($('#cmbCondicionesPago_visitas_prospectos_crm').val() === 'CREDITO')
				                                     	{
			                                      			//Si no existe plazo
						                                    if(value == '')
						                                    {
					                                      		return {
						                                            valid: false,
						                                            message: 'Seleccione un plazo'
						                                        };
						                                    }
					                                    } 
					                                    return true;
					                                  }
					                            }
											}
										},
										strFechaProximaVisita_visitas_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strHoraProximaVisita_visitas_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una hora'}
											}
										}
										
									 }
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_visitas_prospectos_crm = $('#frmVisitasProspectosCRM').data('bootstrapValidator');
			bootstrapValidator_visitas_prospectos_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_visitas_prospectos_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_visitas_prospectos_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_visitas_prospectos_crm()
		{
			try
			{
				$('#frmVisitasProspectosCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_visitas_prospectos_crm()
		{

			//Asignar datos de la fecha y hora
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaVisita = $.formatFechaMysql($('#txtFecha_visitas_prospectos_crm').val());
			var dteFechaProximaVisita = $.formatFechaMysql($('#txtFechaProximaVisita_visitas_prospectos_crm').val());
			var dteFechaProbabilidadCompra = $.formatFechaMysql($('#txtFechaProbabilidadCompra_visitas_prospectos_crm').val());

			//Hacer un llamado a la función para convertir hora a formato 24
			var strHoraVisita = convertirHora12a24($('#txtHora_visitas_prospectos_crm').val());
			var strHoraProximaVisita = convertirHora12a24($('#txtHoraProximaVisita_visitas_prospectos_crm').val());

			//Concatenar los datos de la fecha y hora
			dteFechaVisita += ' '+strHoraVisita;
			dteFechaProximaVisita += ' '+strHoraProximaVisita;

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/prospectos_visitas/guardar',
					{ 
						intProspectoVisitaID: $('#txtProspectoVisitaID_visitas_prospectos_crm').val(),
						intProspectoVisitaReferencia: $('#txtProspectoVisitaReferencia_visitas_prospectos_crm').val(),
						intProspectoID: $('#txtProspectoID_prospectos_crm').val(),
						intModuloID: $('#txtModuloID_visitas_prospectos_crm').val(),
						intEstrategiaID: $('#txtEstrategiaID_visitas_prospectos_crm').val(),
						intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_visitas_prospectos_crm').val(),
						dteFecha:dteFechaVisita,
						strComentario: $('#txtComentario_visitas_prospectos_crm').val(),
						intMotivoVisitaID: $('#txtMotivoVisitaID_visitas_prospectos_crm').val(),
						strMadurez: $('#cmbMadurez_visitas_prospectos_crm').val(),
						dteProbabilidadCompra: dteFechaProbabilidadCompra,
						strCondicionesPago: $('#cmbCondicionesPago_visitas_prospectos_crm').val(),
						strPlazo: $('#cmbPlazo_visitas_prospectos_crm').val(),
						dteProximaVisita:dteFechaProximaVisita
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_visitas_prospectos_crm();
							//Hacer un llamado a la función para cerrar modal
							cerrar_visitas_prospectos_crm();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_prospectos_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_visitas_prospectos_crm(id, tipoAccion)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/prospectos_visitas/get_datos',
			       {intProspectoVisitaID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_visitas_prospectos_crm('Editar');
				          	//Recuperar valores
				            $('#txtProspectoVisitaID_visitas_prospectos_crm').val(data.row.prospecto_visita_id);
				            $('#txtProspectoVisitaReferencia_visitas_prospectos_crm').val(data.row.prospecto_visita_referencia);
				            //Hacer un llamado a la función para asignar los datos de la visita
				            get_datos_visita_prospectos_crm(data);

				            $('#txtFechaProximaVisita_visitas_prospectos_crm').val(data.row.fecha_proxima_visita);
				            $('#txtHoraProximaVisita_visitas_prospectos_crm').timepicker('setTime', data.row.hora_proxima_visita);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_visitas_prospectos_crm').addClass("estatus-ACTIVO");

				            //Si el tipo de acción es Editar
				            if(tipoAccion == 'Editar')
				            {
								//Mostrar los siguientes botones
					            $("#btnImprimirRegistro_visitas_prospectos_crm").show();
				            	$("#btnSeguimiento_visitas_prospectos_crm").show();
				            	$("#btnReprogramacion_visitas_prospectos_crm").show();
				            }
				            else
				            {
				            	//Deshabilitar todos los elementos del formulario
			            		$('#frmVisitasProspectosCRM').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
				           		$("#btnGuardar_visitas_prospectos_crm").hide(); 
				            }

					        //Abrir modal
				            objVisitasProspectosCRM = $('#VisitasProspectosCRMBox').bPopup({
														  appendTo: '#ProspectosCRMContent', 
							                              contentContainer: 'ProspectosCRMM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtModulo_visitas_prospectos_crm').focus();
			       	    }
			       },
			       'json');
			
		}

		//Función para dar seguimiento a la visita seleccionada
		function seguimiento_visitas_prospectos_crm(id)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará el seguimiento de la visita desde el modal
			if(id == '')
			{
				intID = $('#txtProspectoVisitaID_visitas_prospectos_crm').val();

			}
			else
			{
				intID = id;
			}
			
		    	
		    //Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/prospectos_visitas/get_datos',
			       {intProspectoVisitaID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_visitas_prospectos_crm();
				          	//Recuperar valores
				            $('#txtProspectoVisitaReferencia_visitas_prospectos_crm').val(intID);
				            //Hacer un llamado a la función para asignar los datos de la visita
				            get_datos_visita_prospectos_crm(data);
				           	//Hacer un llamado a la función para abrir el modal de visitas
				           	abrir_visitas_prospectos_crm();
				           	//Enfocar caja de texto
						    $('#txtFechaProximaVisita_visitas_prospectos_crm').focus();

			       	    }
			       },
			       'json');
		}


		//Función para asignar los datos de una visita
		function get_datos_visita_prospectos_crm(data)
		{

			//Asignar datos del registro seleccionado
            $('#txtModuloID_visitas_prospectos_crm').val(data.row.modulo_id);
            $('#txtModulo_visitas_prospectos_crm').val(data.row.modulo);
            $('#txtEstrategiaID_visitas_prospectos_crm').val(data.row.estrategia_id);
            $('#txtEstrategia_visitas_prospectos_crm').val(data.row.estrategia);
            $('#txtMaquinariaDescripcionID_visitas_prospectos_crm').val(data.row.maquinaria_descripcion_id);
            $('#txtMaquinariaDescripcion_visitas_prospectos_crm').val(data.row.maquinaria_descripcion);
            $('#txtFechaCreacion_visitas_prospectos_crm').val(data.row.fecha_creacion);
            $('#txtFecha_visitas_prospectos_crm').val(data.row.fecha_visita);
            $('#txtHora_visitas_prospectos_crm').timepicker('setTime', data.row.hora_visita);
            $('#txtComentario_visitas_prospectos_crm').val(data.row.comentario);
            $('#txtMotivoVisitaID_visitas_prospectos_crm').val(data.row.motivo_visita_id);
            $('#txtMotivoVisita_visitas_prospectos_crm').val(data.row.motivo_visita);
            $('#cmbMadurez_visitas_prospectos_crm').val(data.row.madurez);
            $('#txtFechaProbabilidadCompra_visitas_prospectos_crm').val(data.row.probabilidad_compra);
            $('#cmbCondicionesPago_visitas_prospectos_crm').val(data.row.condiciones_pago);
            $('#cmbPlazo_visitas_prospectos_crm').val(data.row.plazo);
		} 


		/*******************************************************************************************************************
		Funciones del modal Reprogramación de Visita
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_reprogramacion_visitas_prospectos_crm()
		{
			//Incializar formulario
			$('#frmReprogramacionVisitasProspectosCRM')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_reprogramacion_visitas_prospectos_crm();
			//Limpiar cajas de texto ocultas
			$('#frmReprogramacionVisitasProspectosCRM').find('input[type=hidden]').val('');
			//Dependiendo del estatus cambiar el color del encabezado 
	        $('#divEncabezadoModal_reprogramacion_visitas_prospectos_crm').addClass("estatus-ACTIVO");
	        //Inicializar datetimepicker
	        $('#dteFechaReprogramada_reprogramacion_visitas_prospectos_crm').data("DateTimePicker").date(fechaActual());
			$('#txtFechaReprogramada_reprogramacion_visitas_prospectos_crm').val('');

	        //Inicializar timepicker
			$('#txtHoraReprogramada_reprogramacion_visitas_prospectos_crm').timepicker('setTime', '12:00 PM');
			$('#txtHoraReprogramada_reprogramacion_visitas_prospectos_crm').val('');

		}

		//Función que se utiliza para abrir el modal
		function abrir_reprogramacion_visitas_prospectos_crm(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
		    nuevo_reprogramacion_visitas_prospectos_crm();

			//Variable que se utiliza para asignar id de la visita
			var intID = 0;
			//Si no existe id, significa que se reprogramara la visita desde el modal
			if(id == '')
			{
				intID = $('#txtProspectoVisitaID_visitas_prospectos_crm').val();
				$('#txtModalVisitas_reprogramacion_visitas_prospectos_crm').val('SI');
			}
			else
			{
				intID = id;
				$('#txtModalVisitas_reprogramacion_visitas_prospectos_crm').val('NO');
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('crm/prospectos_visitas/get_datos',
		       {
		       		intProspectoVisitaID:intID
		       },
		       function(data) {
		        	//Si hay datos del registro
		            if(data.row)
		            {
		            	
			          	//Recuperar valores
			            $('#txtProspectoVisitaID_reprogramacion_visitas_prospectos_crm').val(data.row.prospecto_visita_id);
			            $('#txtFechaOriginal_reprogramacion_visitas_prospectos_crm').val(data.row.fecha_proxima_visita);
			            $('#txtHoraOriginal_reprogramacion_visitas_prospectos_crm').val(data.row.hora_proxima_visita);

			            $('#txtMotivoVisita_reprogramacion_visitas_prospectos_crm').val(data.row.motivo_visita);
			            
				        //Abrir modal
			            objReprogramacionVisitasProspectosCRM = $('#ReprogramacionVisitasProspectosCRMBox').bPopup({
																  appendTo: '#ProspectosCRMContent', 
									                              contentContainer: 'ProspectosCRMM', 
									                              zIndex: 2, 
									                              modalClose: false, 
									                              modal: true, 
									                              follow: [true,false], 
									                              followEasing : "linear", 
									                              easing: "linear", 
									                              modalColor: ('#F0F0F0')});

			            //Enfocar caja de texto
						$('#txtFechaReprogramada_reprogramacion_visitas_prospectos_crm').focus();
		       	    }
		       },
		       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_reprogramacion_visitas_prospectos_crm()
		{
			try {
				//Cerrar modal
				objReprogramacionVisitasProspectosCRM.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_visitas_prospectos_crm').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_reprogramacion_visitas_prospectos_crm()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_reprogramacion_visitas_prospectos_crm();
			//Validación del formulario de campos obligatorios
			$('#frmReprogramacionVisitasProspectosCRM')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFechaReprogramada_reprogramacion_visitas_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strHoraReprogramada_reprogramacion_visitas_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Seleccione una hora'}
											}
										},
										strComentario_reprogramacion_visitas_prospectos_crm: {
											validators: {
												notEmpty: {message: 'Escriba un comentario'}
											}
										}
									 }
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_reprogramacion_visitas_prospectos_crm = $('#frmReprogramacionVisitasProspectosCRM').data('bootstrapValidator');
			bootstrapValidator_reprogramacion_visitas_prospectos_crm.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_reprogramacion_visitas_prospectos_crm.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_reprogramacion_visitas_prospectos_crm();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_reprogramacion_visitas_prospectos_crm()
		{
			try
			{
				$('#frmReprogramacionVisitasProspectosCRM').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar los datos de un registro
		function guardar_reprogramacion_visitas_prospectos_crm()
		{

			//Asignar datos de la fecha y hora
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaOriginalVisita = $.formatFechaMysql($('#txtFechaOriginal_reprogramacion_visitas_prospectos_crm').val());
			var dteFechaReprogramadaVisita = $.formatFechaMysql($('#txtFechaReprogramada_reprogramacion_visitas_prospectos_crm').val());
			
			//Hacer un llamado a la función para convertir hora a formato 24
			var strHoraOriginal = convertirHora12a24($('#txtHoraOriginal_reprogramacion_visitas_prospectos_crm').val());
			var strHoraReprogramada = convertirHora12a24($('#txtHoraReprogramada_reprogramacion_visitas_prospectos_crm').val());

			//Concatenar los datos de la fecha y hora
			dteFechaOriginalVisita += ' '+strHoraOriginal;
			dteFechaReprogramadaVisita += ' '+strHoraReprogramada;

	
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('crm/prospectos_visitas/guardar_reprogramacion_visitas',
					{ 
						intProspectoVisitaID: $('#txtProspectoVisitaID_reprogramacion_visitas_prospectos_crm').val(),
						dteFechaOriginal:dteFechaOriginalVisita,
						dteFechaReprogramada:dteFechaReprogramadaVisita,
						strComentario: $('#txtComentario_reprogramacion_visitas_prospectos_crm').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid 
							paginacion_visitas_prospectos_crm();
							//Hacer un llamado a la función para cerrar modal
							cerrar_reprogramacion_visitas_prospectos_crm();

							//Si el id de la referencia (para la reprogramación) se recuperó del modal Visitas 
						  	if($('#txtModalVisitas_reprogramacion_visitas_prospectos_crm').val() == 'SI')
						  	{
						  		//Hacer un llamado a la función para cerrar modal Visitas
						 	 	cerrar_visitas_prospectos_crm();
						  	}               
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_prospectos_crm(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para obtener los módulos seleccionados
		function modulos_seleccionados_prospectos_crm(){

			//Declaramos el arreglo que contendrá los módulos seleccionados
			var chkModulosArray = [];
			
			//Buscamos todos los checkboxes seleccionados
			$('[name="chkModulos_prospectos_crm[]"]:checked').each(function() {
				chkModulosArray.push($(this).val());
			});
			
			//Unimos los valores seleccionados con un '|'
			chkModulosArray.join('|');

			//Regresar array con los módulos seleccionados
			return chkModulosArray;
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Prospectos
			*********************************************************************************************************************/
			//Manejados de evento Click para el Tab del modal principal
			$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			  	var target = $(e.target).attr("href") // activated tab
			  	//Si el usuario ha seleccionado el TAB-OTROS
			  	if(target == '#otros_prospectos_crm'){

			  		var chkModulosArray = [];
			  		var modulos = $('#txtModulosSeleccionadosID_prospectos_crm').val();
					chkModulosArray = modulos.split("|");
					//Verificamos que al menos un checkbox de la sección Cliente importante haya sido seleccionado
					if(chkModulosArray.length > 0){
						chkModulosArray.forEach(function (element, index){
						  	$('#chkModulo'+element+'_prospectos_crm').prop("checked", true);
						});
					}

			  	}
			});

			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Información General
        	*********************************************************************************************************************/
        	//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtCodigoPostal_prospectos_crm').numeric({decimal: false, negative: false});
        	$('#txtTelefonoPrincipal_prospectos_crm').numeric({decimal: false, negative: false});
        	$('#txtTelefonoSecundario_prospectos_crm').numeric({decimal: false, negative: false});
        	$('#txtContactoTelefono_prospectos_crm').numeric({decimal: false, negative: false});
        	$('#txtContactoCelular_prospectos_crm').numeric({decimal: false, negative: false});
        	$('#txtContactoExtension_prospectos_crm').numeric({decimal: false, negative: false});
        	//Agregar datepicker para seleccionar fecha
			$('#dteContactoFechaNacimiento_prospectos_crm').datetimepicker({format: 'DD/MM/YYYY'});

			//Autocomplete para recuperar los datos de un código postal 
	        $('#txtCodigoPostal_prospectos_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCodigoPostalID_prospectos_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del código postal
	               inicializar_codigo_postal_prospectos_crm();
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
	             $('#txtCodigoPostalID_prospectos_crm').val(ui.item.data);
	             //Hacer un llamado a la función para regresar los datos del código postal
	             get_datos_codigo_postal_prospectos_crm();
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
	        $('#txtCodigoPostal_prospectos_crm').focusout(function(e){
	            //Si no existe id del código postal
	            if($('#txtCodigoPostalID_prospectos_crm').val() == '' ||
	            	$('#txtCodigoPostal_prospectos_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtCodigoPostalID_prospectos_crm').val('');
	               $('#txtCodigoPostal_prospectos_crm').val('');
	                //Hacer un llamado a la función para inicializar elementos del código postal
	               inicializar_codigo_postal_prospectos_crm();
	            }

	        });

			//Autocomplete para recuperar los datos de una localidad 
	        $('#txtLocalidad_prospectos_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtLocalidadID_prospectos_crm').val('');
	                //Hacer un llamado a la función para inicializar elementos de la localidad
	               inicializar_localidad_prospectos_crm();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/localidades/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intMunicipioID: $('#txtMunicipioID_prospectos_crm').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtLocalidadID_prospectos_crm').val(ui.item.data);
	             //Hacer un llamado a la función para regresar los datos de la localidad
	             get_datos_localidad_prospectos_crm();
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
	        $('#txtLocalidad_prospectos_crm').focusout(function(e){
	            //Si no existe id de la localidad
	            if($('#txtLocalidadID_prospectos_crm').val() == '' ||
	               $('#txtLocalidad_prospectos_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtLocalidadID_prospectos_crm').val('');
	               $('#txtLocalidad_prospectos_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos de la localidad
	               inicializar_localidad_prospectos_crm();
	            }

	        });

	        //Autocomplete para recuperar los datos de un prospecto 
	        $('#txtNombreComercial_prospectos_crm').autocomplete({
	            source: function( request, response ) {
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/prospectos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strEstatus: 'ACTIVO'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Hacer un llamado a la función para recuperar los datos del registro que coincide con el nombre comercial
				 editar_prospectos_crm(ui.item.data, 'Nuevo');
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        

	        //Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });


	        /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Inventario
        	*********************************************************************************************************************/
        	//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtAnio_inventario_prospectos_crm').numeric({decimal: false, negative: false});
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtHoras_inventario_prospectos_crm').numeric();
        	$('#txtCaballos_inventario_prospectos_crm').numeric();

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.moneda_prospectos_crm').blur(function(){
                $('.moneda_prospectos_crm').formatCurrency({ roundToDecimalPlace: 2 });
            });


			/*Ocultar los campos de captura del inventario al dar clic en la pestaña: Información General,
			  Otros, Expediente o Visitas*/
			$(document).on('shown.bs.tab', 'a[href="#informacion_general_prospectos_crm"], a[href="#otros_prospectos_crm"], a[href="#expediente_prospectos_crm"], a[href="#visitas_prospectos_crm"]', function (){
				//Hacer un llamado a la función para ocultar los campos de captura del inventario
				ocultar_campos_inventario_prospectos_crm();
			});
			
			  //Autocomplete para recuperar los datos de una marca de maquinaria
	        $('#txtMaquinariaMarca_inventario_prospectos_crm').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtMaquinariaMarcaID_inventario_prospectos_crm').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "maquinaria/maquinaria_marcas/autocomplete",
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
	               $('#txtMaquinariaMarcaID_inventario_prospectos_crm').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la marca de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMaquinariaMarca_inventario_prospectos_crm').focusout(function(e){
	            //Si no existe id de la marca de maquinaria
	            if($('#txtMaquinariaMarcaID_inventario_prospectos_crm').val() == '' ||
	               $('#txtMaquinariaMarca_inventario_prospectos_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaMarcaID_inventario_prospectos_crm').val('');
	               $('#txtMaquinariaMarca_inventario_prospectos_crm').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un modelo de maquinaria
	        $('#txtMaquinariaModelo_inventario_prospectos_crm').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro  
	                 $('#txtMaquinariaModeloID_inventario_prospectos_crm').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "maquinaria/maquinaria_modelos/autocomplete",
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
	               $('#txtMaquinariaModeloID_inventario_prospectos_crm').val(ui.item.data);
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id del modelo de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMaquinariaModelo_inventario_prospectos_crm').focusout(function(e){
	            //Si no existe id  del modelo de maquinaria
	            if($('#txtMaquinariaModeloID_inventario_prospectos_crm').val() == '' ||
	               $('#txtMaquinariaModelo_inventario_prospectos_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaModeloID_inventario_prospectos_crm').val('');
	               $('#txtMaquinariaModelo_inventario_prospectos_crm').val('');
	            }

	        });

	        //Validar que exista descripción cuando se pulse la tecla enter 
			$('#txtDescripcion_inventario_prospectos_crm').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe descripción
		            if($('#txtDescripcion_inventario_prospectos_crm').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtDescripcion_inventario_prospectos_crm').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtAnio_inventario_prospectos_crm').focus();
			   	    }
		        }
		    });

			//Validar que exista año cuando se pulse la tecla enter 
			$('#txtAnio_inventario_prospectos_crm').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Asignar valor a la variable
				    var strAnio = $('#txtAnio_inventario_prospectos_crm').val();
		         	//Si no existe año
		            if(strAnio == '' || strAnio.length != 4)
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtAnio_inventario_prospectos_crm').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtSerie_inventario_prospectos_crm').focus();
			   	    }
		        }
		    });

		    //Validar que exista serie cuando se pulse la tecla enter 
			$('#txtSerie_inventario_prospectos_crm').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
			   	    //Enfocar caja de texto
					$('#txtMaquinariaMarca_inventario_prospectos_crm').focus();
		        }
		    });

		    //Validar que exista marca de maquinaria cuando se pulse la tecla enter 
			$('#txtMaquinariaMarca_inventario_prospectos_crm').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe marca de maquinaria 
		            if($('#txtMaquinariaMarcaID_inventario_prospectos_crm').val() == '' || $('#txtMaquinariaMarca_inventario_prospectos_crm').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtMaquinariaMarca_inventario_prospectos_crm').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtMaquinariaModelo_inventario_prospectos_crm').focus();
			   	    }
		        }
		    });

		    //Validar que exista modelo de maquinaria cuando se pulse la tecla enter 
			$('#txtMaquinariaModelo_inventario_prospectos_crm').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe modelo de maquinaria 
		            if($('#txtMaquinariaModeloID_inventario_prospectos_crm').val() == '' || $('#txtMaquinariaModelo_inventario_prospectos_crm').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtMaquinariaModelo_inventario_prospectos_crm').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtHoras_inventario_prospectos_crm').focus();
			   	    }
		        }
		    });

		    //Validar que existan horas cuando se pulse la tecla enter 
			$('#txtHoras_inventario_prospectos_crm').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existen horas
		            if($('#txtHoras_inventario_prospectos_crm').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtHoras_inventario_prospectos_crm').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtCaballos_inventario_prospectos_crm').focus();
			   	    }
		        }
		    });

		    //Validar que existan caballos de fuerza cuando se pulse la tecla enter 
			$('#txtCaballos_inventario_prospectos_crm').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existen caballos de fuerza
		            if($('#txtCaballos_inventario_prospectos_crm').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCaballos_inventario_prospectos_crm').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtTraccion_inventario_prospectos_crm').focus();
			   	    }
		        }
		    });

		    //Validar que exista tracción cuando se pulse la tecla enter 
			$('#txtTraccion_inventario_prospectos_crm').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe tracción
		            if($('#txtTraccion_inventario_prospectos_crm').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtTraccion_inventario_prospectos_crm').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbRecambio_inventario_prospectos_crm').focus();
			   	    }
		        }
		    });

		    //Agregar renglón a la tabla cuando se pulse la tecla enter 
			$("#cmbRecambio_inventario_prospectos_crm").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
	          		//Hacer un llamado a la función para agregar renglón a la tabla
		    		agregar_renglon_inventario_prospectos_crm();
		        }  
		    });

	        /*******************************************************************************************************************
        	Controles correspondientes al  Tab - Otros
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtHectareasTemporal_prospectos_crm').numeric();
        	$('#txtHectareasRiego_prospectos_crm').numeric();
        	$('#txtHectareasOtras_prospectos_crm').numeric();
        	$('#txtTerrenoArenoso_prospectos_crm').numeric();
        	$('#txtTerrenoArcilloso_prospectos_crm').numeric();
        	$('#txtTerrenoCompacto_prospectos_crm').numeric();
        	$('#txtTerrenoPedregoso_prospectos_crm').numeric();
        	$('#txtTerrenoOtros_prospectos_crm').numeric();
        	$('#txtHectareas_cultivos_prospectos_crm').numeric();

        	//Autocomplete para recuperar los datos de una actividad
			$('#txtActividad_actividades_prospectos_crm').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtActividadID_actividades_prospectos_crm').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "crm/actividades/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtActividadID_actividades_prospectos_crm').val(ui.item.data);
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

			//Verificar que exista id de la actividad cuando pierda el enfoque la caja de texto
			$('#txtActividad_actividades_prospectos_crm').focusout(function(e){
				//Si no existe id de la actividad
				if($('#txtActividadID_actividades_prospectos_crm').val() == '' ||
				   $('#txtActividad_actividades_prospectos_crm').val() == '')
				{ 
					//Limpiar contenido de las siguientes cajas de texto
					$('#txtActividadID_actividades_prospectos_crm').val('');
					$('#txtActividad_actividades_prospectos_crm').val('');
				}

			});

			//Autocomplete para recuperar los datos de un cultivo
			$('#txtCultivo_cultivos_prospectos_crm').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtCultivoID_cultivos_prospectos_crm').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "crm/cultivos/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtCultivoID_cultivos_prospectos_crm').val(ui.item.data);
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

			//Verificar que exista id del cultivo cuando pierda el enfoque la caja de texto
			$('#txtCultivo_cultivos_prospectos_crm').focusout(function(e){
				//Si no existe id del cultivo
				if($('#txtCultivoID_cultivos_prospectos_crm').val() == '' ||
				   $('#txtCultivo_cultivos_prospectos_crm').val() == '')
				{ 
					//Limpiar contenido de las siguientes cajas de texto
					$('#txtCultivoID_cultivos_prospectos_crm').val('');
					$('#txtCultivo_cultivos_prospectos_crm').val('');
				}
				
			});

			//Validar que exista actividad cuando se pulse la tecla enter 
			$('#txtActividad_actividades_prospectos_crm').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe actividad
		            if($('#txtActividadID_actividades_prospectos_crm').val() == '' || $('#txtActividad_actividades_prospectos_crm').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtActividad_actividades_prospectos_crm').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
		    			agregar_renglon_actividades_prospectos_crm();
			   	    }
		        }
		    });

			//Validar que exista cultivo cuando se pulse la tecla enter 
			$('#txtCultivo_cultivos_prospectos_crm').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe cultivo
		            if($('#txtCultivoID_cultivos_prospectos_crm').val() == '' || $('#txtCultivo_cultivos_prospectos_crm').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCultivo_cultivos_prospectos_crm').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtHectareas_cultivos_prospectos_crm').focus();
			   	    }
		        }
		    });

		    //Validar que existan hectáreas cuando se pulse la tecla enter 
			$('#txtHectareas_cultivos_prospectos_crm').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existen hectáreas
		            if($('#txtHectareas_cultivos_prospectos_crm').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtHectareas_cultivos_prospectos_crm').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
		    			agregar_renglon_cultivos_prospectos_crm();
			   	    }
		        }
		    });


			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Visitas
        	*********************************************************************************************************************/
        	//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_visitas_prospectos_crm').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_visitas_prospectos_crm').datetimepicker({format: 'DD/MM/YYYY'});

			//Comparar el rango de fechas cuando cambie la fecha
			$('#dteFechaInicialBusq_visitas_prospectos_crm').on('dp.change', function (e) {
				//Hacer un llamado a la función para comparar dos fechas
				$('#txtFechaFinalBusq_visitas_prospectos_crm').val($.compararFechas('txtFechaInicialBusq_visitas_prospectos_crm', 'txtFechaFinalBusq_visitas_prospectos_crm'));
			});

			
			//Comparar el rango de fechas cuando cambie la fecha
			$('#dteFechaFinalBusq_visitas_prospectos_crm').on('dp.change', function (e) {
				//Hacer un llamado a la función para comparar dos fechas
				$('#txtFechaFinalBusq_visitas_prospectos_crm').val($.compararFechas('txtFechaInicialBusq_visitas_prospectos_crm', 'txtFechaFinalBusq_visitas_prospectos_crm'));
			});


			
			//Agregar timepicker para seleccionar una hora
			$('#txtHoraInicialBusq_visitas_prospectos_crm').timepicker({minuteStep: 1});
			$('#txtHoraInicialBusq_visitas_prospectos_crm').timepicker('setTime', '');

			$('#txtHoraFinalBusq_visitas_prospectos_crm').timepicker({minuteStep: 1});
			$('#txtHoraFinalBusq_visitas_prospectos_crm').timepicker('setTime', '');

			
			//Autocomplete para recuperar los datos de un módulo 
	        $('#txtModuloBusq_visitas_prospectos_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloIDBusq_visitas_prospectos_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/modulos/autocomplete",
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
	             $('#txtModuloIDBusq_visitas_prospectos_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del módulo cuando pierda el enfoque la caja de texto
	        $('#txtModuloBusq_visitas_prospectos_crm').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloIDBusq_visitas_prospectos_crm').val() == '' ||
	               $('#txtModuloBusq_visitas_prospectos_crm').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtModuloIDBusq_visitas_prospectos_crm').val('');
	                $('#txtModuloBusq_visitas_prospectos_crm').val('');
	            }
	            
	        });

			//Paginación de registros
			$('#pagLinks_visitas_prospectos_crm').on('click','a',function(event){
				event.preventDefault();
				intPaginaVisitasProspectosCRM = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_visitas_prospectos_crm();
			});

        	//Abrir modal Visitas cuando se de clic en el botón
			$('#btnNuevo_visitas_prospectos_crm').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_visitas_prospectos_crm('Nuevo');
				//Hacer un llamado a la función para abrir el modal de visitas
				abrir_visitas_prospectos_crm();
			});
        	
        	/*******************************************************************************************************************
			Controles correspondientes al modal Visitas
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_visitas_prospectos_crm').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaProximaVisita_visitas_prospectos_crm').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaProbabilidadCompra_visitas_prospectos_crm').datetimepicker({format: 'DD/MM/YYYY'});


			//Comparar las fechas de la visita cuando cambie la fecha
			$('#dteFecha_visitas_prospectos_crm').on('dp.change', function (e) {
				
				//Hacer un llamado a la función para comparar dos fechas
				$('#txtFechaProximaVisita_visitas_prospectos_crm').val($.compararFechas('txtFecha_visitas_prospectos_crm', 'txtFechaProximaVisita_visitas_prospectos_crm'));
			});

			//Comparar las fechas de la visita cuando cambie la fecha
			$('#dteFechaProximaVisita_visitas_prospectos_crm').on('dp.change', function (e) {
				//Hacer un llamado a la función para comparar dos fechas
				$('#txtFechaProximaVisita_visitas_prospectos_crm').val($.compararFechas('txtFecha_visitas_prospectos_crm', 'txtFechaProximaVisita_visitas_prospectos_crm'));
			});


			//Agregar timepicker para seleccionar una hora
			$('#txtHora_visitas_prospectos_crm').timepicker({minuteStep: 1});
			$('#txtHora_visitas_prospectos_crm').timepicker('setTime', '12:00 PM');

			//Agregar timepicker para seleccionar una hora para la próxima visita
			$('#txtHoraProximaVisita_visitas_prospectos_crm').timepicker({minuteStep: 1});
			$('#txtHoraProximaVisita_visitas_prospectos_crm').timepicker('setTime', '12:00 PM');
			

			//Autocomplete para recuperar los datos de un módulo 
	        $('#txtModulo_visitas_prospectos_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloID_visitas_prospectos_crm').val('');
	               //Hacer un llamado a la función para inicializar elementos del módulo
	               inicializar_modulo_prospectos_crm();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/modulos/autocomplete",
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
	             $('#txtModuloID_visitas_prospectos_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del módulo cuando pierda el enfoque la caja de texto
	        $('#txtModulo_visitas_prospectos_crm').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloID_visitas_prospectos_crm').val() == '' ||
	               $('#txtModulo_visitas_prospectos_crm').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtModuloID_visitas_prospectos_crm').val('');
	                $('#txtModulo_visitas_prospectos_crm').val('');
	                //Hacer un llamado a la función para inicializar elementos del módulo
	                inicializar_modulo_prospectos_crm();
	            }
	            
	        });

	         //Autocomplete para recuperar los datos de una estrategia
	        $('#txtEstrategia_visitas_prospectos_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEstrategiaID_visitas_prospectos_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/estrategias/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: $('#txtModuloID_visitas_prospectos_crm').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtEstrategiaID_visitas_prospectos_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la estrategia cuando pierda el enfoque la caja de texto
	        $('#txtEstrategia_visitas_prospectos_crm').focusout(function(e){
	            //Si no existe id de la estrategia
	            if($('#txtEstrategiaID_visitas_prospectos_crm').val() == '' ||
	               $('#txtEstrategia_visitas_prospectos_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEstrategiaID_visitas_prospectos_crm').val('');
	               $('#txtEstrategia_visitas_prospectos_crm').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un motivo de visita 
	        $('#txtMotivoVisita_visitas_prospectos_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMotivoVisitaID_visitas_prospectos_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/motivos_visitas/autocomplete",
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
	             $('#txtMotivoVisitaID_visitas_prospectos_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del motivo de visita cuando pierda el enfoque la caja de texto
	        $('#txtMotivoVisita_visitas_prospectos_crm').focusout(function(e){
	            //Si no existe id del motivo de visita
	            if($('#txtMotivoVisitaID_visitas_prospectos_crm').val() == '' ||
	               $('#txtMotivoVisita_visitas_prospectos_crm').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtMotivoVisitaID_visitas_prospectos_crm').val('');
	                $('#txtMotivoVisita_visitas_prospectos_crm').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una descripción de maquinaria 
	        $('#txtMaquinariaDescripcion_visitas_prospectos_crm').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMaquinariaDescripcionID_visitas_prospectos_crm').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "maquinaria/maquinaria_descripciones/autocomplete",
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
	             $('#txtMaquinariaDescripcionID_visitas_prospectos_crm').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la descripción de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMaquinariaDescripcion_visitas_prospectos_crm').focusout(function(e){
	        	//Si no existe id de la descripción de maquinaria
	            if($('#txtMaquinariaDescripcionID_visitas_prospectos_crm').val() == '' ||
	               $('#txtMaquinariaDescripcion_visitas_prospectos_crm').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaDescripcionID_visitas_prospectos_crm').val('');
	               $('#txtMaquinariaDescripcion_visitas_prospectos_crm').val('');
	            }

	        });


			/*******************************************************************************************************************
			Controles correspondientes al modal Reprogramación de Visita
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFechaReprogramada_reprogramacion_visitas_prospectos_crm').datetimepicker({format: 'DD/MM/YYYY'});

			//Agregar timepicker para seleccionar una hora para la próxima visita
			$('#txtHoraReprogramada_reprogramacion_visitas_prospectos_crm').timepicker({minuteStep: 1});
			$('#txtHoraReprogramada_reprogramacion_visitas_prospectos_crm').timepicker('setTime', '12:00 PM');


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_prospectos_crm').on('click','a',function(event){
				event.preventDefault();
				intPaginaProspectosCRM = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_prospectos_crm();
			});

			//Abrir modal Prospectos cuando se de clic en el botón
			$('#btnNuevo_prospectos_crm').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_prospectos_crm();
				//Seleccionar tab que contiene la información general
		    	$('a[href="#informacion_general_prospectos_crm"]').click();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_prospectos_crm').addClass("estatus-NUEVO");
				//Abrir modal
				 objProspectosCRM = $('#ProspectosCRMBox').bPopup({
											   appendTo: '#ProspectosCRMContent', 
				                               contentContainer: 'ProspectosCRMM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtNombreComercial_prospectos_crm').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_prospectos_crm').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_prospectos_crm();
		});
	</script>