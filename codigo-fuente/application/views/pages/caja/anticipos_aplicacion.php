	<div id="AnticiposAplicacionCajaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_anticipos_aplicacion_caja" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_anticipos_aplicacion_caja" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_anticipos_aplicacion_caja">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_anticipos_aplicacion_caja'>
				                    <input class="form-control" id="txtFechaInicialBusq_anticipos_aplicacion_caja"
				                    		name= "strFechaInicialBusq_anticipos_aplicacion_caja" 
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
								<label for="txtFechaFinalBusq_anticipos_aplicacion_caja">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_anticipos_aplicacion_caja'>
				                    <input class="form-control" id="txtFechaFinalBusq_anticipos_aplicacion_caja"
				                    		name= "strFechaFinalBusq_anticipos_aplicacion_caja" 
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
								<input id="txtProspectoIDBusq_anticipos_aplicacion_caja" 
									   name="intProspectoIDBusq_anticipos_aplicacion_caja"  type="hidden" 
									   value="">
								</input>
								<label for="txtRazonSocialBusq_anticipos_aplicacion_caja">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocialBusq_anticipos_aplicacion_caja" 
										name="strRazonSocialBusq_anticipos_aplicacion_caja" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_anticipos_aplicacion_caja">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_anticipos_aplicacion_caja" 
								 		name="strEstatusBusq_anticipos_aplicacion_caja" tabindex="1">
								    <option value="TODOS">TODOS</option>
	                  				<option value="ACTIVO">ACTIVO</option>
	                  				<option value="TIMBRAR">TIMBRAR</option>
	                  				<option value="INACTIVO">INACTIVO</option>
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
								<label for="txtBusqueda_anticipos_aplicacion_caja">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_anticipos_aplicacion_caja" 
										name="strBusqueda_anticipos_aplicacion_caja" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_anticipos_aplicacion_caja"
									onclick="paginacion_anticipos_aplicacion_caja();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_anticipos_aplicacion_caja" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_anticipos_aplicacion_caja"
									onclick="reporte_anticipos_aplicacion_caja('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_anticipos_aplicacion_caja"
									onclick="reporte_anticipos_aplicacion_caja('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla aplicación de anticipos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Razón social"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "RFC"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Concepto"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Importe"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Estatus"; font-weight: bold;}
				td.movil.a8:nth-of-type(8):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla CFDI a relacionar
				*/
				td.movil.b1:nth-of-type(1):before {content: "Referencia"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Razón social"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Folio"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Fecha"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Modulo"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "UUID"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "Importe"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "Seleccionar"; font-weight: bold;}

				/*
				Definir columnas de la tabla CFDI relacionados
				*/
				td.movil.c1:nth-of-type(1):before {content: "Razón social"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Folio"; font-weight: bold;}
				td.movil.c3:nth-of-type(3):before {content: "Fecha"; font-weight: bold;}
				td.movil.c4:nth-of-type(4):before {content: "Modulo"; font-weight: bold;}
				td.movil.c5:nth-of-type(5):before {content: "UUID"; font-weight: bold;}
				td.movil.c6:nth-of-type(6):before {content: "Importe"; font-weight: bold;}
				td.movil.c7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_anticipos_aplicacion_caja">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Razón social</th>
							<th class="movil">RFC</th>
							<th class="movil">Concepto</th>
							<th class="movil">Importe</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:15em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_anticipos_aplicacion_caja" type="text/template"> 
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
										onclick="editar_anticipos_aplicacion_caja({{anticipo_aplicacion_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_anticipos_aplicacion_caja({{anticipo_aplicacion_id}},'Ver', {{cancelacion_id}});" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
                            	<!--Ver motivo de cancelación-->
								<button class="btn btn-default btn-xs {{mostrarAccionMotivoCancelacion}}"  
										onclick="ver_cancelacion_anticipos_aplicacion_caja({{cancelacion_id}})"  title="Ver motivo de cancelación">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
								</button>
                            	<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_cliente_anticipos_aplicacion_caja({{anticipo_aplicacion_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_anticipos_aplicacion_caja({{anticipo_aplicacion_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Timbrar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionTimbrar}}"  
										onclick="timbrar_anticipos_aplicacion_caja({{anticipo_aplicacion_id}},'','principal', {{regimen_fiscal_id}})"  title="Timbrar">
									<span class="fa fa-certificate"></span>
								</button>
								<!--Descargar archivos-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_anticipos_aplicacion_caja({{anticipo_aplicacion_id}}, '{{folio}}');" title="Descargar archivos">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_anticipos_aplicacion_caja({{anticipo_aplicacion_id}}, '{{folio}}')" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_anticipos_aplicacion_caja"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_anticipos_aplicacion_caja">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_anticipos_aplicacion_caja" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarAnticiposAplicacionCajaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cliente_anticipos_aplicacion_caja" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarAnticiposAplicacionCaja" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarAnticiposAplicacionCaja"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Razón social-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtAnticipoAplicacionID_cliente_anticipos_aplicacion_caja" 
										   name="intAnticipoAplicacionID_cliente_anticipos_aplicacion_caja" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el folio del registro seleccionado-->
									<input id="txtFolio_cliente_anticipos_aplicacion_caja" 
										   name="strFolio_cliente_anticipos_aplicacion_caja" 
										   type="hidden" value="">
									</input>
									<label for="txtRazonSocial_cliente_anticipos_aplicacion_caja">Razón social</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_cliente_anticipos_aplicacion_caja" 
											name="strRazonSocial_cliente_anticipos_aplicacion_caja" type="text" value="" 
											disabled>
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
									<label for="txtCorreoElectronico_cliente_anticipos_aplicacion_caja">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_cliente_anticipos_aplicacion_caja" 
											name="strCorreoElectronico_cliente_anticipos_aplicacion_caja" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<div class="row">
			 			<!--Copia-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCopiaCorreoElectronico_cliente_anticipos_aplicacion_caja">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_cliente_anticipos_aplicacion_caja" 
											name="strCopiaCorreoElectronico_cliente_anticipos_aplicacion_caja" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cliente_anticipos_aplicacion_caja" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_cliente_anticipos_aplicacion_caja"  
									onclick="validar_cliente_anticipos_aplicacion_caja();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cliente_anticipos_aplicacion_caja"
									type="reset" aria-hidden="true" onclick="cerrar_cliente_anticipos_aplicacion_caja();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal Relacionar CFDI-->
		<div id="RelacionarCfdiAnticiposAplicacionCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_cfdi_anticipos_aplicacion_caja" class="ModalBodyTitle">
			<h1>Relacionar CFDI</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarCfdiAnticiposAplicacionCaja" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarCfdiAnticiposAplicacionCaja"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha inicial-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicialBusq_relacionar_cfdi_anticipos_aplicacion_caja">Fecha inicial</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaInicialBusq_relacionar_cfdi_anticipos_aplicacion_caja'>
					                    <input class="form-control" id="txtFechaInicialBusq_relacionar_cfdi_anticipos_aplicacion_caja"
					                    		name= "strFechaInicialBusq_relacionar_cfdi_anticipos_aplicacion_caja" 
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
									<label for="txtFechaFinalBusq_relacionar_cfdi_anticipos_aplicacion_caja">Fecha final</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaFinalBusq_relacionar_cfdi_anticipos_aplicacion_caja'>
					                    <input class="form-control" id="txtFechaFinalBusq_relacionar_cfdi_anticipos_aplicacion_caja"
					                    		name= "strFechaFinalBusq_relacionar_cfdi_anticipos_aplicacion_caja" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los clientes activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
									<input id="txtProspectoIDBusq_relacionar_cfdi_anticipos_aplicacion_caja" 
										   name="intProspectoIDBusq_relacionar_cfdi_anticipos_aplicacion_caja"  type="hidden" 
										   value="">
									</input>
									<label for="txtRazonSocialBusq_relacionar_cfdi_anticipos_aplicacion_caja">Razón social</label>
								</div>
								<div class="col-md-12">
									<div class="input-group">
										<input class="form-control" id="txtRazonSocialBusq_relacionar_cfdi_anticipos_aplicacion_caja" 
											   name="strRazonSocialBusq_relacionar_cfdi_anticipos_aplicacion_caja"  type="text" value="" 
											   tabindex="1" placeholder="Ingrese razón social" maxlength="250" >
										</input>
										<span class="input-group-btn">
											<button class="btn btn-primary" id="btnBuscar_relacionar_cfdi_anticipos_aplicacion_caja"
													onclick="lista_facturas_relacionar_cfdi_anticipos_aplicacion_caja();" title="Buscar coincidencias" tabindex="1">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group row">
						<!--Div que contiene la tabla con los CFDI encontrados-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<!-- Caja de texto oculta para asignar el número de registros de la tabla CFDI a relacionar--> 
							<input id="txtNumCfdi_relacionar_cfdi_anticipos_aplicacion_caja" 
								   name="intNumCfdi_relacionar_cfdi_anticipos_aplicacion_caja" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_cfdi_anticipos_aplicacion_caja">
								<thead class="movil">
									<tr class="movil">
										<th class="movil">Razón social</th>
										<th class="movil">Folio</th>
										<th class="movil">Fecha</th>
										<th class="movil">Modulo</th>
										<th class="movil">UUID</th>
										<th class="movil">Importe</th>
										<th class="movil" id="th-acciones" style="width:8em;">Seleccionar</th>
									</tr>
								</thead>
								<tbody class="movil"></tbody>
								<script id="plantilla_relacionar_cfdi_anticipos_aplicacion_caja" type="text/template"> 
								{{#rows}}
									<tr class="movil">  
										<td class="movil-no-mostrar no-mostrar b1">{{referencia_id}}</td>
										<td class="movil b2">{{cliente}}</td>
										<td class="movil b3">{{folio}}</td>
										<td class="movil b4">{{fecha}}</td>
										<td class="movil b5">{{tipo_referencia}}</td>
										<td class="movil b6">{{uuid}}</td>
										<td class="movil b7">{{importe}}</td>
										<td class="td-center movil b8"> 
											 <input 	type="checkbox" 
							    		class="form-check-input btn-xs" 
							    		id="chbAgregar_relacionar_cfdi_anticipos_aplicacion_caja" />
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
							<div class="row">
								<!--Número de registros encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<button class="btn btn-default btn-sm disabled pull-right">
										<strong id="numElementos_relacionar_cfdi_anticipos_aplicacion_caja">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar CFDI´s-->
							<button class="btn btn-success" id="btnAgregar_relacionar_cfdi_anticipos_aplicacion_caja"  
									onclick="validar_relacionar_cfdi_anticipos_aplicacion_caja();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_cfdi_anticipos_aplicacion_caja"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_cfdi_anticipos_aplicacion_caja();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar CFDI-->

			<!-- Diseño del modal Cancelación del timbrado-->
		<div id="CancelacionAnticiposAplicacionCajaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cancelacion_anticipos_aplicacion_caja" class="ModalBodyTitle confirmacion-modal-title">
			<h1>Cancelación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCancelacionAnticiposAplicacionCaja" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmCancelacionAnticiposAplicacionCaja"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Combobox que contiene los motivos de cancelación activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCancelacionMotivoID_cancelacion_anticipos_aplicacion_caja">Motivo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbCancelacionMotivoID_cancelacion_anticipos_aplicacion_caja" 
									 		name="intCancelacionMotivoID_anticipos_aplicacion_caja" 
									 		tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
			 		</div>
			 		<div class="row">
			 			<!--Folio-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la factura-->
									<input id="txtReferenciaCfdiID_cancelacion_anticipos_aplicacion_caja" 
										   name="intReferenciaCfdiID_cancelacion_anticipos_aplicacion_caja" 
										   type="hidden" value="" />	

									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_cancelacion_anticipos_aplicacion_caja" 
										   name="intPolizaID_cancelacion_anticipos_aplicacion_caja" type="hidden" value="" />

									<label for="txtFolio_cancelacion_anticipos_aplicacion_caja">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_cancelacion_anticipos_aplicacion_caja" 
											name="strFolio_cancelacion_anticipos_aplicacion_caja" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 			<!--Autocomplete que contiene las facturas de refacciones activas (para su sustitución)-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtSustitucionID_cancelacion_anticipos_aplicacion_caja" 
										   name="intSustitucionID_cancelacion_anticipos_aplicacion_caja" 
										   type="hidden" value="" />	
									<!-- Caja de texto oculta que se utiliza para recuperar el UUID de la factura que sustituye-->
									<input id="txtUuidSustitucion_cancelacion_anticipos_aplicacion_caja" 
										   name="strUuidSustitucion_cancelacion_anticipos_aplicacion_caja" 
										   type="hidden" value="" />	   
									<label for="txtFolioSustitucion_cancelacion_anticipos_aplicacion_caja">Sustitución</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolioSustitucion_cancelacion_anticipos_aplicacion_caja" 
											name="strFolioSustitucion_cancelacion_anticipos_aplicacion_caja" type="text" value="" 
											tabindex="1" placeholder="Ingrese anticipo" maxlength="250" >
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Div que contiene los campos del usuario y fecha del registro -->
			 		<div  id="divDatosCreacion_cancelacion_anticipos_aplicacion_caja" class="row no-mostrar">
			 			<!--Usuario que realizó la cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuarioCreacion_cancelacion_anticipos_aplicacion_caja">Usuario de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuarioCreacion_cancelacion_anticipos_aplicacion_caja" 
											name="strUsuarioCreacion_cancelacion_anticipos_aplicacion_caja" type="text" value="" 
											 disabled >
									</input>
								</div>
							</div>
						</div>
						<!--Fecha de cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaCreacion_cancelacion_anticipos_aplicacion_caja">Fecha de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFechaCreacion_cancelacion_anticipos_aplicacion_caja" 
											name="strFechaCreacion_cancelacion_anticipos_aplicacion_caja" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cancelacion_anticipos_aplicacion_caja" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 						
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar cancelación del CFDI-->
							<button class="btn btn-success" id="btnGuardar_cancelacion_anticipos_aplicacion_caja"  
									onclick="validar_cancelacion_anticipos_aplicacion_caja();"  title="Cancelar CFDI" tabindex="1">
								<span class="fa fa-chain-broken"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cancelacion_anticipos_aplicacion_caja"
									type="reset" aria-hidden="true" onclick="cerrar_cancelacion_anticipos_aplicacion_caja();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cancelación del timbrado-->


		<!-- Diseño del modal Aplicación de Anticipos-->
		<div id="AnticiposAplicacionCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_anticipos_aplicacion_caja"  class="ModalBodyTitle">
			<h1>Aplicación de Anticipos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_anticipos_aplicacion_caja" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_anticipos_aplicacion_caja" class="active">
									<a data-toggle="tab" href="#informacion_general_anticipos_aplicacion_caja">Información General</a>
								</li>
								<!--Tab que contiene la información de los CFDI relacionados-->
								<li id="tabCfdiRelacionados_anticipos_aplicacion_caja">
									<a data-toggle="tab" href="#cfdi_relacionados_anticipos_aplicacion_caja">CFDI Relacionados</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmAnticiposAplicacionCaja" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmAnticiposAplicacionCaja"  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_anticipos_aplicacion_caja" class="tab-pane fade in active">
							<div class="row">
								<!--Folio-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtAnticipoAplicacionID_anticipos_aplicacion_caja" 
												   name="intAnticipoAplicacionID_anticipos_aplicacion_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
											<input id="txtEstatus_anticipos_aplicacion_caja" 
												   name="strEstatus_anticipos_aplicacion_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la cancelación del registro seleccionado-->
											<input id="txtCancelacionID_anticipos_aplicacion_caja" 
												   name="intCancelacionID_anticipos_aplicacion_caja" type="hidden" value="" />
											<label for="txtFolio_anticipos_aplicacion_caja">Folio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFolio_anticipos_aplicacion_caja" 
													name="strFolio_anticipos_aplicacion_caja" type="text" 
													value="" placeholder="Autogenerado" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Fecha-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_anticipos_aplicacion_caja">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_anticipos_aplicacion_caja'>
							                    <input class="form-control" id="txtFecha_anticipos_aplicacion_caja"
							                    		name= "strFecha_anticipos_aplicacion_caja" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Moneda-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la moneda-->
											<input id="txtMonedaID_anticipos_aplicacion_caja" 
												   name="intMonedaID_anticipos_aplicacion_caja"  
												   type="hidden"  value="">
											</input>
											<label for="txtMoneda_anticipos_aplicacion_caja">Moneda</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMoneda_anticipos_aplicacion_caja" 
													name="strMoneda_anticipos_aplicacion_caja" 
													type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Tipo de cambio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTipoCambio_anticipos_aplicacion_caja">Tipo de cambio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTipoCambio_anticipos_aplicacion_caja" 
													name="intTipoCambio_anticipos_aplicacion_caja" 
													type="text" value="" disabled/>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
								<!--Autocomplete que contiene los anticipos activos-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del anticipo seleccionado-->
											<input id="txtAnticipoID_anticipos_aplicacion_caja" 
												   name="intAnticipoID_anticipos_aplicacion_caja"  
												   type="hidden" value="">
											</input>
											<label for="txtAnticipo_anticipos_aplicacion_caja">Anticipo</label>
										</div>	
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtAnticipo_anticipos_aplicacion_caja" 
													name="strAnticipo_anticipos_aplicacion_caja" 
													type="text" value="" tabindex="1" placeholder="Ingrese anticipo" maxlength="250" />
										</div>
									</div>
								</div>	
						    	<!--Autocomplete que contiene los clientes activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
											<input id="txtProspectoID_anticipos_aplicacion_caja" 
												   name="intProspectoID_anticipos_aplicacion_caja"  type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el id del régimen fiscal del cliente seleccionado-->
											<input id="txtRegimenFiscalID_anticipos_aplicacion_caja" 
												   name="intRegimenFiscalID_anticipos_aplicacion_caja" 
												   type="hidden" value="">
											</input>	
											<!-- Caja de texto oculta para recuperar el id del régimen fiscal anterior (validar si es necesario modificar el régimen fiscal del registro  usado como referencia)-->
											<input id="txtRegimenFiscalIDAnterior_anticipos_aplicacion_caja" 
												   name="intRegimenFiscalIDAnterior_anticipos_aplicacion_caja" 
												   type="hidden" value="">
											</input>					
											<!-- Caja de texto oculta para recuperar la calle del cliente seleccionado-->
											<input id="txtCalle_anticipos_aplicacion_caja" 
												   name="strCalle_anticipos_aplicacion_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el número exterior del cliente seleccionado-->
											<input id="txtNumeroExterior_anticipos_aplicacion_caja" 
												   name="strNumeroExterior_anticipos_aplicacion_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el número interior del cliente seleccionado-->
											<input id="txtNumeroInterior_anticipos_aplicacion_caja" 
												   name="strNumeroInterior_anticipos_aplicacion_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el código postal del cliente seleccionado-->
											<input id="txtCodigoPostal_anticipos_aplicacion_caja" 
												   name="strCodigoPostal_anticipos_aplicacion_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar la colonia del cliente seleccionado-->
											<input id="txtColonia_anticipos_aplicacion_caja" 
												   name="strColonia_anticipos_aplicacion_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar la localidad del cliente seleccionado-->
											<input id="txtLocalidad_anticipos_aplicacion_caja" 
												   name="strLocalidad_anticipos_aplicacion_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el municipio del cliente seleccionado-->
											<input id="txtMunicipio_anticipos_aplicacion_caja" 
												   name="strMunicipio_anticipos_aplicacion_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el estado del cliente seleccionado-->
											<input id="txtEstado_anticipos_aplicacion_caja" 
												   name="strEstado_anticipos_aplicacion_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el país del cliente seleccionado-->
											<input id="txtPais_anticipos_aplicacion_caja" 
												   name="strPais_anticipos_aplicacion_caja" type="hidden" value="">
											</input>
											<label for="txtRazonSocial_anticipos_aplicacion_caja">Razón social</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRazonSocial_anticipos_aplicacion_caja" 
													name="strRazonSocial_anticipos_aplicacion_caja" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--RFC-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRfc_anticipos_aplicacion_caja">RFC</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRfc_anticipos_aplicacion_caja"
												   name="strRfc_anticipos_aplicacion_caja" 
												   type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Saldo (total del anticipo que hace falta aplicar)-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtSaldoAnticipo_anticipos_aplicacion_caja">Saldo por aplicar</label>
										</div>
										<div class="col-md-12">
											<div class='input-group'>
												<span class="input-group-addon">$</span>
												<input  class="form-control" id="txtSaldoAnticipo_anticipos_aplicacion_caja" 
														name="intSaldoAnticipo_anticipos_aplicacion_caja" type="text" value="" disabled>
												</input>
											</div>
										</div>
									</div>
								</div>
							</div>
						    <div class="row">
								<!--Autocomplete que contiene las formas de pago activas-->
								<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la forma de pago seleccionada-->
											<input id="txtFormaPagoID_anticipos_aplicacion_caja" 
												   name="intFormaPagoID_anticipos_aplicacion_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtFormaPago_anticipos_aplicacion_caja">
												Forma de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFormaPago_anticipos_aplicacion_caja" 
													name="strFormaPago_anticipos_aplicacion_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese forma de pago" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los métodos de pago activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del método de pago seleccionado-->
											<input id="txtMetodoPagoID_anticipos_aplicacion_caja" 
												   name="intMetodoPagoID_anticipos_aplicacion_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtMetodoPago_anticipos_aplicacion_caja">
												Método de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMetodoPago_anticipos_aplicacion_caja" 
													name="strMetodoPago_anticipos_aplicacion_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese método de pago" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Combobox que contiene la exportación activa-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbExportacionID_anticipos_aplicacion_caja">Exportación</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbExportacionID_anticipos_aplicacion_caja"
											        name="intExportacionID_anticipos_aplicacion_caja" tabindex="1">
		                     				</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene los usos de cfdi activos-->
								<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del uso de cfdi seleccionado-->
											<input id="txtUsoCfdiID_anticipos_aplicacion_caja" 
												   name="intUsoCfdiID_anticipos_aplicacion_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtUsoCfdi_anticipos_aplicacion_caja">
												Uso del CFDI
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtUsoCfdi_anticipos_aplicacion_caja" 
													name="strUsoCfdi_anticipos_aplicacion_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese uso del CFDI" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los tipos de relación activos-->
								<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del tipo de relación seleccionado-->
											<input id="txtTipoRelacionID_anticipos_aplicacion_caja" 
												   name="intTipoRelacionID_anticipos_aplicacion_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtTipoRelacion_anticipos_aplicacion_caja">
												Tipo de relación
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTipoRelacion_anticipos_aplicacion_caja" 
													name="strTipoRelacion_anticipos_aplicacion_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese tipo de relación" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
						    <div class="row">
						    	<!--Concepto-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtConcepto_anticipos_aplicacion_caja">Concepto</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtConcepto_anticipos_aplicacion_caja" 
													name="strConcepto_anticipos_aplicacion_caja" type="text" value="" tabindex="1" 
													placeholder="Ingrese concepto" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene los objetos de impuesto-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObjetoImpuesto_anticipos_aplicacion_caja">Objeto de impuesto SAT</label>
										</div>
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el código del objeto de impuesto seleccionado-->
											<input id="txtObjetoImpuestoSat_anticipos_aplicacion_caja" 
												   name="strObjetoImpuestoSat_anticipos_aplicacion_caja"  
												   type="hidden" value="">
										    </input>
											<input  class="form-control" id="txtObjetoImpuesto_anticipos_aplicacion_caja" 
													name="strObjetoImpuesto_anticipos_aplicacion_caja" type="text" 
													value="" tabindex="1" placeholder="Ingrese objeto de impuesto SAT" maxlength="250">
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
											<label for="txtSubtotal_anticipos_aplicacion_caja">Subtotal</label>
										</div>
										<div class="col-md-12">
											<div class='input-group'>
												<span class="input-group-addon">$</span>
												<input  class="form-control moneda_anticipos_aplicacion_caja" id="txtSubtotal_anticipos_aplicacion_caja" 
														name="intSubtotal_anticipos_aplicacion_caja" type="text" value="" tabindex="1" placeholder="Ingrese subtotal" maxlength="14">
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
											<input id="txtIva_anticipos_aplicacion_caja" 
												   name="intIva_anticipos_aplicacion_caja" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIva_anticipos_aplicacion_caja" 
												   name="intTasaCuotaIva_anticipos_aplicacion_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIva_anticipos_aplicacion_caja">IVA %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIva_anticipos_aplicacion_caja" 
													name="intPorcentajeIva_anticipos_aplicacion_caja" type="text" value="" tabindex="1" placeholder="Ingrese IVA" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para asignar el importe del IEPS-->
											<input id="txtIeps_anticipos_aplicacion_caja" 
												   name="intIeps_anticipos_aplicacion_caja" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
											<input id="txtTasaCuotaIeps_anticipos_aplicacion_caja" 
												   name="intTasaCuotaIeps_anticipos_aplicacion_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtPorcentajeIeps_anticipos_aplicacion_caja">IEPS %</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPorcentajeIeps_anticipos_aplicacion_caja" 
													name="intPorcentajeIeps_anticipos_aplicacion_caja" type="text" value="" tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Total-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTotal_anticipos_aplicacion_caja">Total</label>
										</div>
										<div class="col-md-12">
											<div class='input-group'>
												<span class="input-group-addon">$</span>
												<input  class="form-control" id="txtTotal_anticipos_aplicacion_caja" 
														name="intTotal_anticipos_aplicacion_caja" type="text" value="" disabled>
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
											<label for="txtObservaciones_anticipos_aplicacion_caja">Observaciones</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtObservaciones_anticipos_aplicacion_caja" 
													name="strObservaciones_anticipos_aplicacion_caja" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    </div>
						</div><!--Cierre del contenido del tab - Información General-->
						<!--Tab - CFDI relacionados-->
						<div id="cfdi_relacionados_anticipos_aplicacion_caja" class="tab-pane fade">
							<div class="row">
								<!--Botones-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="btn-group pull-right">
										<!--Buscar CFDI a relacionar para agregarlos en la tabla-->
										<button class="btn btn-primary" 
		                                			id="btnBuscarCFDI_anticipos_aplicacion_caja" 
		                                			onclick="abrir_relacionar_cfdi_anticipos_aplicacion_caja();" 
		                                	     	title="Buscar CFDI" tabindex="1"> 
		                                		<span class="glyphicon glyphicon-search"></span>
		                                		 Relacionar CFDI
		                                </button>
									</div>
								</div>
							</div>
							<br>
							<div class="form-group row">
								<!--Div que contiene la tabla con los detalles encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta para asignar el número de registros de la tabla CFDI  a relacionar--> 
									<input id="txtNumCfdiRelacionados_anticipos_aplicacion_caja" 
										   name="intNumCfdiRelacionados_anticipos_aplicacion_caja" type="hidden" value="">
									</input>
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_cfdi_relacionados_anticipos_aplicacion_caja">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Razón social</th>
												<th class="movil">Folio</th>
												<th class="movil">Fecha</th>
												<th class="movil">Modulo</th>
												<th class="movil">UUID</th>
												<th class="movil">Importe</th>
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
												<strong id="numElementos_cfdi_relacionados_anticipos_aplicacion_caja">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - CFDI relacionados-->
				    </div><!--Cierre del contenedor de tabs-->				
                  	<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_anticipos_aplicacion_caja" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
                  	<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_anticipos_aplicacion_caja"  
									onclick="validar_anticipos_aplicacion_caja();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_anticipos_aplicacion_caja"  
									onclick="abrir_cliente_anticipos_aplicacion_caja('');"  
									title="Enviar correo electrónico" tabindex="3" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Ver motivo de cancelación del registro-->
							<button class="btn btn-default" id="btnVerMotivoCancelacion_anticipos_aplicacion_caja"  
									onclick="ver_cancelacion_anticipos_aplicacion_caja('');"  title="Ver motivo de cancelación" tabindex="4">
								<i class="fa fa-info-circle" aria-hidden="true"></i>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_anticipos_aplicacion_caja"  
									onclick="reporte_registro_anticipos_aplicacion_caja('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivos-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_anticipos_aplicacion_caja"  
									onclick="descargar_archivos_anticipos_aplicacion_caja('','');"  title="Descargar archivos" tabindex="6" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_anticipos_aplicacion_caja"  
									onclick="cambiar_estatus_anticipos_aplicacion_caja('', '');"  title="Desactivar" tabindex="7" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_anticipos_aplicacion_caja"
									type="reset" aria-hidden="true" onclick="cerrar_anticipos_aplicacion_caja();" 
									title="Cerrar"  tabindex="8">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Aplicación de Anticipos-->
	</div><!--#AnticiposAplicacionCajaContent -->


	<!-- /.Plantilla para cargar los motivo de cancelación en el combobox-->  
	<script id="cancelacion_motivos_anticipos_aplicacion_caja" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#motivos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/motivos}} 
	</script>


	<!-- /.Plantilla para cargar la exportación en el combobox-->  
	<script id="exportacion_anticipos_aplicacion_caja" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#exportacion}}
		<option value="{{value}}">{{nombre}}</option>
		{{/exportacion}} 
	</script>


	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaAnticiposAplicacionCaja = 0;
		var strUltimaBusquedaAnticiposAplicacionCaja = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar en el timbrado y cfdi's relacionados)*/
		var strTipoReferenciaAnticiposAplicacionCaja = "APLICACION ANTICIPO";
		//Variable que se utiliza para asignar el id de la forma de pago base
		var intFormaPagoAplicacionAntIDAnticiposAplicacionCaja = <?php echo FORMA_PAGO_APLICACION_ANTICIPO ?>;
		//Variable que se utiliza para asignar el id de la exportación base
		var intExportacionBaseIDAnticiposAplicacionCaja = <?php echo EXPORTACION_BASE ?>;
		//Variable que se utiliza para asignar el id del objeto de impuesto base
		var intObjetoImpuestoBaseIDAnticiposAplicacionCaja = <?php echo OBJETOIMP_BASE ?>;
		//Variable que se utiliza para asignar el id del método de pago base
		var intMetodoPagoBaseIDAnticiposAplicacionCaja = <?php echo METODO_PAGO_BASE ?>;
	    //Variable que se utiliza para asignar el id del tipo de relación base
		var intTipoRelacionBaseIDAnticiposAplicacionCaja = <?php echo TIPO_RELACION_BASE ?>;
		//Variable que se utiliza para asignar el id del motivo de cancelación: Comprobante emitido con errores con relación.
		var intCancelacionIDRelacionCfdiAnticiposAplicacionCaja = <?php echo MOTIVO_CANCELACION_RELACIONCFDI ?>;
		//Variable que se utiliza para asignar el mensaje de régimen fiscal faltante.
		var strMsjRegimenFiscalCteAnticiposAplicacionCaja = "<?php echo MSJ_ERROR_REGIMEN_FISCAL ?>";

		//Variable que se utiliza para asignar objeto del modal Cancelación del timbrado
		var objCancelacionAnticiposAplicacionCaja = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarAnticiposAplicacionCaja = null;
		//Variable que se utiliza para asignar objeto del modal Relacionar CFDI
		var objRelacionarCfdiAnticiposAplicacionCaja = null;
		//Variable que se utiliza para asignar objeto del modal Aplicación de Anticipos
		var objAnticiposAplicacionCaja = null;

		/*******************************************************************************************************************
		Funciones del objeto CFDI's  relacionados (facturas seleccionadas)
		*********************************************************************************************************************/
		// Constructor del objeto CFDI's relacionados (facturas seleccionadas)
		var objCfdisRelacionadosAnticiposAplicacionCaja;
		function CfdisRelacionadosAnticiposAplicacionCaja(cfdis)
		{
			this.arrCfdis = cfdis;
		}

		//Función para obtener todos los cfdi´s seleccionados
		CfdisRelacionadosAnticiposAplicacionCaja.prototype.getCfdis = function() {
		    return this.arrCfdis;
		}

		//Función para agregar un cfdi al objeto 
		CfdisRelacionadosAnticiposAplicacionCaja.prototype.setCfdi = function (cfdi){
			this.arrCfdis.push(cfdi);
		}

		//Función para obtener un cfdi del objeto 
		CfdisRelacionadosAnticiposAplicacionCaja.prototype.getCfdi = function(index) {
		    return this.arrCfdis[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto CFDI a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto CFDI a relacionar
		var objCfdiRelacionarAnticiposAplicacionCaja;
		
		function CfdiRelacionarAnticiposAplicacionCaja(referenciaID, cliente, folio, fecha, tipoReferencia, uuid, importe)
		{
		    this.intReferenciaID = referenciaID;
		    this.strCliente = cliente;
		    this.strFolio = folio;
		    this.dteFecha = fecha;
		    this.strTipoReferencia = tipoReferencia;
		    this.strUuid = uuid;
		    this.intImporte = importe;
		}

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_anticipos_aplicacion_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/anticipos_aplicacion/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_anticipos_aplicacion_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosAnticiposAplicacionCaja = data.row;
					//Separar la cadena 
					var arrPermisosAnticiposAplicacionCaja = strPermisosAnticiposAplicacionCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosAnticiposAplicacionCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosAnticiposAplicacionCaja[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_anticipos_aplicacion_caja').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosAnticiposAplicacionCaja[i]=='GUARDAR') || (arrPermisosAnticiposAplicacionCaja[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_anticipos_aplicacion_caja').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosAnticiposAplicacionCaja[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_anticipos_aplicacion_caja').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposAplicacionCaja[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_anticipos_aplicacion_caja').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_anticipos_aplicacion_caja();
						}
						else if(arrPermisosAnticiposAplicacionCaja[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_anticipos_aplicacion_caja').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposAplicacionCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_anticipos_aplicacion_caja').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposAplicacionCaja[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_anticipos_aplicacion_caja').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposAplicacionCaja[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_anticipos_aplicacion_caja').removeAttr('disabled');
						}
						else if(arrPermisosAnticiposAplicacionCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_anticipos_aplicacion_caja').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_anticipos_aplicacion_caja() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaAnticiposAplicacionCaja = ($('#txtFechaInicialBusq_anticipos_aplicacion_caja').val()+$('#txtFechaFinalBusq_anticipos_aplicacion_caja').val()+$('#txtProspectoIDBusq_anticipos_aplicacion_caja').val()+$('#cmbEstatusBusq_anticipos_aplicacion_caja').val()+$('#txtBusqueda_anticipos_aplicacion_caja').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaAnticiposAplicacionCaja != strUltimaBusquedaAnticiposAplicacionCaja)
			{
				intPaginaAnticiposAplicacionCaja = 0;
				strUltimaBusquedaAnticiposAplicacionCaja = strNuevaBusquedaAnticiposAplicacionCaja;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/anticipos_aplicacion/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_anticipos_aplicacion_caja').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_anticipos_aplicacion_caja').val()),
						intProspectoID: $('#txtProspectoIDBusq_anticipos_aplicacion_caja').val(),
						strEstatus: $('#cmbEstatusBusq_anticipos_aplicacion_caja').val(),
						strBusqueda: $('#txtBusqueda_anticipos_aplicacion_caja').val(),
						intPagina:intPaginaAnticiposAplicacionCaja,
						strPermisosAcceso: $('#txtAcciones_anticipos_aplicacion_caja').val()
					},
					function(data){
						$('#dg_anticipos_aplicacion_caja tbody').empty();
						var tmpAnticiposAplicacionCaja = Mustache.render($('#plantilla_anticipos_aplicacion_caja').html(),data);
						$('#dg_anticipos_aplicacion_caja tbody').html(tmpAnticiposAplicacionCaja);
						$('#pagLinks_anticipos_aplicacion_caja').html(data.paginacion);
						$('#numElementos_anticipos_aplicacion_caja').html(data.total_rows);
						intPaginaAnticiposAplicacionCaja = data.pagina;
					},
			'json');
		}

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_anticipos_aplicacion_caja(anticipoAplicacionID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(anticipoAplicacionID == '')
			{
				intID = $('#txtAnticipoAplicacionID_anticipos_aplicacion_caja').val();
				strFolio = $('#txtFolio_anticipos_aplicacion_caja').val();
			}
			else
			{
				intID = anticipoAplicacionID;
				strFolio = folio;
			}


			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'contabilidad/timbradoV4/descargar_archivos',
							'data' : {
										'intReferenciaID': intID,
										'strTipoReferencia': strTipoReferenciaAnticiposAplicacionCaja,
										'strFolio': strFolio		
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

		}

		//Regresar el forma de pago base
		function cargar_forma_pago_base_anticipos_aplicacion_caja()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/sat_forma_pago/get_datos',
			       {strBusqueda:intFormaPagoAplicacionAntIDAnticiposAplicacionCaja,
			       	strTipo: 'id'
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				            $('#txtFormaPagoID_anticipos_aplicacion_caja').val(data.row.forma_pago_id);
				            $('#txtFormaPago_anticipos_aplicacion_caja').val(data.row.codigo+' - '+data.row.descripcion);
			       	    }
			       },
			       'json');
		}

		//Regresar el impuesto de objeto base
		function cargar_objeto_impuesto_base_anticipos_aplicacion_caja()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.ajax({
			        url: 'contabilidad/sat_objeto_impuesto/get_datos',
			        method:'post',
			        dataType: 'json',
			        async: false,
			        data: {
			        	strBusqueda:intObjetoImpuestoBaseIDAnticiposAplicacionCaja,
			       		strTipo: 'id'
			        },
			        success: function (data) {
			          	//Si no se encuentra código 
			        	if(data.row)
			        	{
			        		//Recuperar valores
				            $('#txtObjetoImpuestoSat_anticipos_aplicacion_caja').val(data.row.codigo);
				            $('#txtObjetoImpuesto_anticipos_aplicacion_caja').val(data.row.codigo+' - '+data.row.descripcion);

			        	}
			        }
			    });
		}


		//Regresar el método de pago base
		function cargar_metodo_pago_base_anticipos_aplicacion_caja()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/sat_metodos_pago/get_datos',
			       {strBusqueda:intMetodoPagoBaseIDAnticiposAplicacionCaja,
			       	strTipo: 'id'
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				            $('#txtMetodoPagoID_anticipos_aplicacion_caja').val(data.row.metodo_pago_id);
				            $('#txtMetodoPago_anticipos_aplicacion_caja').val(data.row.codigo+' - '+data.row.descripcion);
			       	    }
			       },
			       'json');
		}

		//Regresar el tipo de relación base
		function cargar_tipo_relacion_base_anticipos_aplicacion_caja()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/sat_tipos_relacion/get_datos',
			       {strBusqueda:intTipoRelacionBaseIDAnticiposAplicacionCaja,
			       	strTipo: 'id'
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				            $('#txtTipoRelacionID_anticipos_aplicacion_caja').val(data.row.tipo_relacion_id);
				            $('#txtTipoRelacion_anticipos_aplicacion_caja').val(data.row.codigo+' - '+data.row.descripcion);
			       	    }
			       },
			       'json');
		}

		//Regresar exportación activa para cargarlas en el combobox
		function cargar_exportacion_anticipos_aplicacion_caja()
		{
			//Hacer un llamado al método del controlador para regresar la exportación que se encuentra activa
			$.post('contabilidad/sat_exportacion/get_combo_box', {},
				function(data)
				{
					$('#cmbExportacionID_anticipos_aplicacion_caja').empty();
					var temp = Mustache.render($('#exportacion_anticipos_aplicacion_caja').html(), data);
					$('#cmbExportacionID_anticipos_aplicacion_caja').html(temp);
				},
				'json');
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_anticipos_aplicacion_caja(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'caja/anticipos_aplicacion/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_anticipos_aplicacion_caja').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_anticipos_aplicacion_caja').val()),
										'intProspectoID': $('#txtProspectoIDBusq_anticipos_aplicacion_caja').val(),
										'strEstatus': $('#cmbEstatusBusq_anticipos_aplicacion_caja').val(), 
										'strBusqueda': $('#txtBusqueda_anticipos_aplicacion_caja').val()		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_anticipos_aplicacion_caja(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtAnticipoAplicacionID_anticipos_aplicacion_caja').val();
			}
			else
			{
				intID = id;
			}



			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url':  'contabilidad/timbradoV4/get_pdf',
							'data' : {
										'intReferenciaID':intID,
										'strTipoReferencia':strTipoReferenciaAnticiposAplicacionCaja,
										'strTimbrar': 'NO'		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

	 /*******************************************************************************************************************
		Funciones del modal Cancelación del timbrado
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cancelacion_anticipos_aplicacion_caja()
		{
			//Incializar formulario
			$('#frmCancelacionAnticiposAplicacionCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_anticipos_aplicacion_caja();
			//Limpiar cajas de texto ocultas
			$('#frmCancelacionAnticiposAplicacionCaja').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cancelacion_anticipos_aplicacion_caja');
			//Habilitar todos los elementos del formulario
			$('#frmCancelacionAnticiposAplicacionCaja').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_cancelacion_anticipos_aplicacion_caja').attr('disabled','disabled');
			//Mostrar botón de Guardar
		    $("#btnGuardar_cancelacion_anticipos_aplicacion_caja").show();
		    //Agregar clase para ocultar div que contiene los datos de creación del registro
			$("#divDatosCreacion_cancelacion_anticipos_aplicacion_caja").addClass('no-mostrar');
		}

		//Función que se utiliza para abrir el modal
		function abrir_cancelacion_anticipos_aplicacion_caja(id, folio)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cancelacion_anticipos_aplicacion_caja();

			//Asignar datos del registro seleccionado
			$('#txtReferenciaCfdiID_cancelacion_anticipos_aplicacion_caja').val(id);
			$('#txtFolio_cancelacion_anticipos_aplicacion_caja').val(folio);
			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_cancelacion_anticipos_aplicacion_caja').addClass("estatus-ACTIVO");

		    //Abrir modal
			objCancelacionAnticiposAplicacionCaja = $('#CancelacionAnticiposAplicacionCajaBox').bPopup({
												   appendTo: '#AnticiposAplicacionCajaContent', 
						                           contentContainer: 'AnticiposAplicacionCajaM', 
						                           zIndex: 2, 
						                           modalClose: false, 
						                           modal: true, 
						                           follow: [true,false], 
						                           followEasing : "linear", 
						                           easing: "linear", 
						                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#cmbCancelacionMotivoID_cancelacion_anticipos_aplicacion_caja').focus();
		}

		//Función para regresar los datos (al formulario) del registro seleccionados
		function ver_cancelacion_anticipos_aplicacion_caja(id)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCancelacionID_anticipos_aplicacion_caja').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/cancelaciones/get_datos',
	        {
	       		intCancelacionID:intID,
	       		strTipoReferencia:strTipoReferenciaAnticiposAplicacionCaja
	        },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			               //Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cancelacion_anticipos_aplicacion_caja();
							//Recuperar valores
							$('#cmbCancelacionMotivoID_cancelacion_anticipos_aplicacion_caja').val(data.row.cancelacion_motivo_id);
							$('#txtFolio_cancelacion_anticipos_aplicacion_caja').val(data.row.folio_referencia);
							$('#txtFolioSustitucion_cancelacion_anticipos_aplicacion_caja').val(data.row.folio_sustitucion);
							$('#txtUsuarioCreacion_cancelacion_anticipos_aplicacion_caja').val(data.row.usuario_creacion);
							$('#txtFechaCreacion_cancelacion_anticipos_aplicacion_caja').val(data.row.fecha_creacion);

							//Dependiendo del estatus cambiar el color del encabezado 
		   					$('#divEncabezadoModal_cancelacion_anticipos_aplicacion_caja').addClass("estatus-INACTIVO");

		   				    //Deshabilitar todos los elementos del formulario
				            $('#frmCancelacionAnticiposAplicacionCaja').find('input, textarea, select').attr('disabled','disabled');
		   					//Ocultar botón de Guardar
				            $("#btnGuardar_cancelacion_anticipos_aplicacion_caja").hide();
				            //Remover clase para mostrar div que contiene los datos de creación del registro
							$("#divDatosCreacion_cancelacion_anticipos_aplicacion_caja").removeClass('no-mostrar');

							//Abrir modal
							objCancelacionAnticiposAplicacionCaja = $('#CancelacionAnticiposAplicacionCajaBox').bPopup({
												   appendTo: '#AnticiposAplicacionCajaContent', 
						                           contentContainer: 'AnticiposAplicacionCajaM', 
						                           zIndex: 2, 
						                           modalClose: false, 
						                           modal: true, 
						                           follow: [true,false], 
						                           followEasing : "linear", 
						                           easing: "linear", 
						                           modalColor: ('#F0F0F0')});
			       	    }
			       },
			       'json');

			
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cancelacion_anticipos_aplicacion_caja()
		{
			try {
				//Cerrar modal
				objCancelacionAnticiposAplicacionCaja.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cancelacion_anticipos_aplicacion_caja();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cancelacion_anticipos_aplicacion_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_anticipos_aplicacion_caja();
			//Validación del formulario de campos obligatorios
			$('#frmCancelacionAnticiposAplicacionCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	intCancelacionMotivoID_anticipos_aplicacion_caja: {
											validators: {
												notEmpty: {message: 'Seleccione un motivo'}
											}
										},
										strFolioSustitucion_cancelacion_anticipos_aplicacion_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if(value == '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_anticipos_aplicacion_caja').val()) === intCancelacionIDRelacionCfdiAnticiposAplicacionCaja) 
					                                    	
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un anticipo existente'
					                                        };
					                                    }
					                                    else if(value !== '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_anticipos_aplicacion_caja').val()) !== intCancelacionIDRelacionCfdiAnticiposAplicacionCaja)
					                                    {

					                                    	//Hacer un llamado a la función para inicializar elementos de la sustitución
					                                    	inicializar_sustitucion_anticipos_aplicacion_caja();
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cancelacion_anticipos_aplicacion_caja = $('#frmCancelacionAnticiposAplicacionCaja').data('bootstrapValidator');
			bootstrapValidator_cancelacion_anticipos_aplicacion_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cancelacion_anticipos_aplicacion_caja.isValid())
			{
				//Hacer un llamado a la función para cancelar el timbrado de un registro
				cancelar_timbrado_anticipos_aplicacion_caja();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cancelacion_anticipos_aplicacion_caja()
		{
			try
			{
				$('#frmCancelacionAnticiposAplicacionCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		
		//Función para inicializar elementos de la sustitución de CFDI
		function inicializar_sustitucion_anticipos_aplicacion_caja()
		{
			
			//Limpiar contenido de las siguientes cajas de texto
           $('#txtSustitucionID_cancelacion_anticipos_aplicacion_caja').val('');
           $('#txtUuidSustitucion_cancelacion_anticipos_aplicacion_caja').val('');
           $('#txtFolioSustitucion_cancelacion_anticipos_aplicacion_caja').val('');
		}


		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function mostrar_circulo_carga_cancelacion_anticipos_aplicacion_caja()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_anticipos_aplicacion_caja").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function ocultar_circulo_carga_cancelacion_anticipos_aplicacion_caja()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_anticipos_aplicacion_caja").addClass('no-mostrar');
		}

		//Regresar motivos de cancelación activos para cargarlos en el combobox
		function cargar_motivos_cancelacion_anticipos_aplicacion_caja()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_cancelacion_motivos/get_combo_box', {},
				function(data)
				{
					$('#cmbCancelacionMotivoID_cancelacion_anticipos_aplicacion_caja').empty();
					var temp = Mustache.render($('#cancelacion_motivos_anticipos_aplicacion_caja').html(), data);
					$('#cmbCancelacionMotivoID_cancelacion_anticipos_aplicacion_caja').html(temp);
				},
				'json');
		}


		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cliente_anticipos_aplicacion_caja()
		{
			//Incializar formulario
			$('#frmEnviarAnticiposAplicacionCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_anticipos_aplicacion_caja();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cliente_anticipos_aplicacion_caja');
		}


		//Función que se utiliza para abrir el modal
		function abrir_cliente_anticipos_aplicacion_caja(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cliente_anticipos_aplicacion_caja();
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtAnticipoAplicacionID_anticipos_aplicacion_caja').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('caja/anticipos_aplicacion/get_datos',
			       {intAnticipoAplicacionID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtAnticipoAplicacionID_cliente_anticipos_aplicacion_caja').val(data.row.anticipo_aplicacion_id);
							$('#txtFolio_cliente_anticipos_aplicacion_caja').val(data.row.folio);
							$('#txtRazonSocial_cliente_anticipos_aplicacion_caja').val(data.row.razon_social);
							$('#txtCorreoElectronico_cliente_anticipos_aplicacion_caja').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_cliente_anticipos_aplicacion_caja').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_cliente_anticipos_aplicacion_caja').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarAnticiposAplicacionCaja = $('#EnviarAnticiposAplicacionCajaBox').bPopup({
																		   appendTo: '#AnticiposAplicacionCajaContent', 
												                           contentContainer: 'AnticiposAplicacionCajaM', 
												                           zIndex: 2, 
												                           modalClose: false, 
												                           modal: true, 
												                           follow: [true,false], 
												                           followEasing : "linear", 
												                           easing: "linear", 
												                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_cliente_anticipos_aplicacion_caja').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cliente_anticipos_aplicacion_caja()
		{
			try {
				//Cerrar modal
				objEnviarAnticiposAplicacionCaja.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cliente_anticipos_aplicacion_caja();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cliente_anticipos_aplicacion_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_anticipos_aplicacion_caja();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarAnticiposAplicacionCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_cliente_anticipos_aplicacion_caja: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_cliente_anticipos_aplicacion_caja: {
				                        	validators: {
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    }
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cliente_anticipos_aplicacion_caja = $('#frmEnviarAnticiposAplicacionCaja').data('bootstrapValidator');
			bootstrapValidator_cliente_anticipos_aplicacion_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cliente_anticipos_aplicacion_caja.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_cliente_anticipos_aplicacion_caja();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cliente_anticipos_aplicacion_caja()
		{
			try
			{
				$('#frmEnviarAnticiposAplicacionCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al cliente
		function enviar_correo_cliente_anticipos_aplicacion_caja()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cliente_anticipos_aplicacion_caja();
			//Hacer un llamado al método del controlador para enviar correo electrónico al cliente
			$.post('contabilidad/timbradoV4/enviar_correo_electronico_cliente',
					{ 
						intReferenciaID: $('#txtAnticipoAplicacionID_cliente_anticipos_aplicacion_caja').val(),
						strTipoReferencia: strTipoReferenciaAnticiposAplicacionCaja,
						strFolio: $('#txtFolio_cliente_anticipos_aplicacion_caja').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_cliente_anticipos_aplicacion_caja').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_cliente_anticipos_aplicacion_caja').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cliente_anticipos_aplicacion_caja();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_cliente_anticipos_aplicacion_caja();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_anticipos_aplicacion_caja(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_cliente_anticipos_aplicacion_caja()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_anticipos_aplicacion_caja").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_cliente_anticipos_aplicacion_caja()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_anticipos_aplicacion_caja").addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones del modal Relacionar CFDI
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_cfdi_anticipos_aplicacion_caja()
		{
			//Incializar formulario
			$('#frmRelacionarCfdiAnticiposAplicacionCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_anticipos_aplicacion_caja();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarCfdiAnticiposAplicacionCaja').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_cfdi_anticipos_aplicacion_caja');
			//Eliminar los datos de la tabla CFDI a relacionar
		    $('#dg_relacionar_cfdi_anticipos_aplicacion_caja tbody').empty();
		    $('#numElementos_relacionar_cfdi_anticipos_aplicacion_caja').html(0);
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_cfdi_anticipos_aplicacion_caja()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_cfdi_anticipos_aplicacion_caja();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_anticipos_aplicacion_caja').val();
			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_cfdi_anticipos_aplicacion_caja').addClass("estatus-"+strEstatus);
			//Abrir modal
			objRelacionarCfdiAnticiposAplicacionCaja = $('#RelacionarCfdiAnticiposAplicacionCajaBox').bPopup({
											  appendTo: '#AnticiposAplicacionCajaContent', 
			                              	  contentContainer: 'AnticiposAplicacionCajaM', 
			                              	  zIndex: 2, 
			                              	  modalClose: false, 
			                              	  modal: true, 
			                              	  follow: [true,false], 
			                              	  followEasing : "linear", 
			                              	  easing: "linear", 
			                             	  modalColor: ('#F0F0F0')});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_relacionar_cfdi_anticipos_aplicacion_caja').focus();
			//Hacer un llamado a la función  para cargar los CFDI´s en el grid
			lista_facturas_relacionar_cfdi_anticipos_aplicacion_caja();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_cfdi_anticipos_aplicacion_caja()
		{
			try {
				//Cerrar modal
				objRelacionarCfdiAnticiposAplicacionCaja.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_cfdi_anticipos_aplicacion_caja()
		{

			//Hacer un llamado a la función para agregar las facturas (CFDI) seleccionadas al  objeto CFDI's  relacionados
			agregar_facturas_relacionar_cfdi_anticipos_aplicacion_caja();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_anticipos_aplicacion_caja();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarCfdiAnticiposAplicacionCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumCfdi_relacionar_cfdi_anticipos_aplicacion_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccionar al menos un CFDI para esta aplicación de anticipo.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFechaInicialBusq_relacionar_cfdi_anticipos_aplicacion_caja: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaFinalBusq_relacionar_cfdi_anticipos_aplicacion_caja: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strRazonSocialBusq_relacionar_cfdi_anticipos_aplicacion_caja: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_relacionar_cfdi_anticipos_aplicacion_caja = $('#frmRelacionarCfdiAnticiposAplicacionCaja').data('bootstrapValidator');
			bootstrapValidator_relacionar_cfdi_anticipos_aplicacion_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_cfdi_anticipos_aplicacion_caja.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_cfdi_anticipos_aplicacion_caja();
				//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
		  		agregar_cfdi_relacionados_anticipos_aplicacion_caja('Nuevo', '');
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_cfdi_anticipos_aplicacion_caja()
		{
			try
			{
				$('#frmRelacionarCfdiAnticiposAplicacionCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar CFDI's
		*********************************************************************************************************************/
		//Función para la búsqueda de CFDI's 
		function lista_facturas_relacionar_cfdi_anticipos_aplicacion_caja() 
		{
			//Variables que se utilizan para asignar los criterios de búsqueda
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaInicialBusq =  $.formatFechaMysql($('#txtFechaInicialBusq_relacionar_cfdi_anticipos_aplicacion_caja').val());
			var dteFechaFinalBusq =  $.formatFechaMysql($('#txtFechaFinalBusq_relacionar_cfdi_anticipos_aplicacion_caja').val());
			var intProspectoIDBusq =  $('#txtProspectoIDBusq_relacionar_cfdi_anticipos_aplicacion_caja').val();

			//Si no existen datos para realizar la búsqueda de coincidencias
			if(intProspectoIDBusq == '' && dteFechaInicialBusq == '' && dteFechaFinalBusq == '')
			{
				intProspectoIDBusq = 0;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/cfdi_relacionados/get_datos',
					{	dteFechaInicial:  dteFechaInicialBusq,
						dteFechaFinal:  dteFechaFinalBusq,
						intProspectoID: intProspectoIDBusq
					},
					function(data){
						$('#dg_relacionar_cfdi_anticipos_aplicacion_caja tbody').empty();
						var tmpRelacionarCfdiAnticiposAplicacionCaja = Mustache.render($('#plantilla_relacionar_cfdi_anticipos_aplicacion_caja').html(),data);
						$('#numElementos_relacionar_cfdi_anticipos_aplicacion_caja').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_cfdi_anticipos_aplicacion_caja').html(data.rows.length);	
						}
						$('#dg_relacionar_cfdi_anticipos_aplicacion_caja tbody').html(tmpRelacionarCfdiAnticiposAplicacionCaja);
						
					},
			'json');

			
		}

		//Función para agregar las facturas (CFDI) seleccionadas al objeto CFDI's  relacionados
		function agregar_facturas_relacionar_cfdi_anticipos_aplicacion_caja()
		{
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
             
            //Crear instancia del objeto CFDI´s relacionados (facturas seleccionadas)
			objCfdisRelacionadosAnticiposAplicacionCaja = new CfdisRelacionadosAnticiposAplicacionCaja([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_cfdi_anticipos_aplicacion_caja tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
                	//Crear instancia del objeto CFDI a relacionar
					objCfdiRelacionarAnticiposAplicacionCaja = new CfdiRelacionarAnticiposAplicacionCaja(null, '', '', '', '', '', '');

                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objCfdiRelacionarAnticiposAplicacionCaja.intReferenciaID = strValor;
							        break;
							    case 1:
							        objCfdiRelacionarAnticiposAplicacionCaja.strCliente = strValor;
							        break;
							    case 2:
							        objCfdiRelacionarAnticiposAplicacionCaja.strFolio = strValor;
							        break;
							    case 3:
							        objCfdiRelacionarAnticiposAplicacionCaja.dteFecha = strValor;
							        break;
							    case 4:
							        objCfdiRelacionarAnticiposAplicacionCaja.strTipoReferencia = strValor;
							        break;
							    case 5:
							       	objCfdiRelacionarAnticiposAplicacionCaja.strUuid = strValor;
							        break;
							    case 6:
							       	objCfdiRelacionarAnticiposAplicacionCaja.intImporte = strValor;
							       	break;
							}

					      	intCol++;
					    });

                	//Agregar datos del cfdi a relacionar
                	objCfdisRelacionadosAnticiposAplicacionCaja.setCfdi(objCfdiRelacionarAnticiposAplicacionCaja);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumCfdi_relacionar_cfdi_anticipos_aplicacion_caja').val(intContador);

		}

		/*******************************************************************************************************************
		Funciones del modal Aplicación de Anticipos
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_anticipos_aplicacion_caja()
		{
			//Incializar formulario
			$('#frmAnticiposAplicacionCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_anticipos_aplicacion_caja();
			//Limpiar cajas de texto ocultas
			$('#frmAnticiposAplicacionCaja').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_anticipos_aplicacion_caja');
			//Hacer un llamado a la función para inicializar elementos de la tabla CFDI relacionados
			inicializar_cfdi_relacionados_anticipos_aplicacion_caja();
			//Habilitar todos los elementos del formulario
			$('#frmAnticiposAplicacionCaja').find('input, textarea, select').removeAttr('disabled','disabled');
			//Seleccionar tab que contiene la información general
		  	$('a[href="#informacion_general_anticipos_aplicacion_caja"]').click();
			//Asignar la fecha actual
			$('#txtFecha_anticipos_aplicacion_caja').val(fechaActual());
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_anticipos_aplicacion_caja').attr("disabled", "disabled");
			$('#txtMoneda_anticipos_aplicacion_caja').attr("disabled", "disabled");
			$('#txtTipoCambio_anticipos_aplicacion_caja').attr("disabled", "disabled");
			$('#txtRfc_anticipos_aplicacion_caja').attr("disabled", "disabled");
			$('#txtTotal_anticipos_aplicacion_caja').attr("disabled", "disabled");
			$('#txtSaldoAnticipo_anticipos_aplicacion_caja').attr("disabled", "disabled");

			//Mostrar por Default 01- No aplica
			$('#cmbExportacionID_anticipos_aplicacion_caja').val(intExportacionBaseIDAnticiposAplicacionCaja);

			//Mostrar los siguientes botones
			$("#btnGuardar_anticipos_aplicacion_caja").show();
			$("#btnBuscarCFDI_anticipos_aplicacion_caja").show(); 
			//Ocultar los siguientes botones
			$("#btnEnviarCorreo_anticipos_aplicacion_caja").hide();
			$("#btnImprimirRegistro_anticipos_aplicacion_caja").hide();
			$("#btnDescargarArchivo_anticipos_aplicacion_caja").hide();
			$("#btnDesactivar_anticipos_aplicacion_caja").hide();
			$('#btnVerMotivoCancelacion_anticipos_aplicacion_caja').hide();
		}

		//Función para inicializar elementos del cliente
		function inicializar_cliente_anticipos_aplicacion_caja()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#txtRfc_anticipos_aplicacion_caja").val('');
            $("#txtRegimenFiscalID_anticipos_aplicacion_caja").val('');
            $("#txtCalle_anticipos_aplicacion_caja").val('');
            $("#txtNumeroExterior_anticipos_aplicacion_caja").val('');
            $("#txtNumeroInterior_anticipos_aplicacion_caja").val('');
            $("#txtCodigoPostal_anticipos_aplicacion_caja").val('');
            $("#txtColonia_anticipos_aplicacion_caja").val('');
            $("#txtLocalidad_anticipos_aplicacion_caja").val('');
            $("#txtMunicipio_anticipos_aplicacion_caja").val('');
            $("#txtEstado_anticipos_aplicacion_caja").val('');
            $("#txtPais_anticipos_aplicacion_caja").val('');
           
		}

		//Función para inicializar elementos del anticipo
		function inicializar_anticipo_anticipos_aplicacion_caja()
		{
		    //Limpiar contenido de las siguientes cajas de texto
		    $("#txtProspectoID_anticipos_aplicacion_caja").val('');
		    $("#txtRazonSocial_anticipos_aplicacion_caja").val('');
		    $("#txtMonedaID_anticipos_aplicacion_caja").val('');
		    $("#txtMoneda_anticipos_aplicacion_caja").val('');
		    $("#txtTipoCambio_anticipos_aplicacion_caja").val('');
		    $("#txtConcepto_anticipos_aplicacion_caja").val('');
		    $("#txtSubtotal_anticipos_aplicacion_caja").val('');
		    $("#txtSaldoAnticipo_anticipos_aplicacion_caja").val('');
		    $("#txtTasaCuotaIva_anticipos_aplicacion_caja").val('');
		    $("#txtPorcentajeIva_anticipos_aplicacion_caja").val('');
		    $("#txtIva_anticipos_aplicacion_caja").val('');
		    $("#txtTasaCuotaIeps_anticipos_aplicacion_caja").val('');
		    $("#txtPorcentajeIeps_anticipos_aplicacion_caja").val('');
		    $("#txtIeps_anticipos_aplicacion_caja").val('');
		    $("#txtTotal_anticipos_aplicacion_caja").val('');
		    $("#txtObservaciones_anticipos_aplicacion_caja").val('');
		   
		    //Hacer un llamado a la función para inicializar elementos del cliente
		    inicializar_cliente_anticipos_aplicacion_caja();
		    //Hacer un llamado a la función para inicializar elementos de la tabla CFDI relacionados
		    inicializar_cfdi_relacionados_anticipos_aplicacion_caja();
		}

		//Función para inicializar elementos de la tabla CFDI relacionados
		function inicializar_cfdi_relacionados_anticipos_aplicacion_caja()
		{
			//Eliminar los datos de la tabla CFDI relacionados
		    $('#dg_cfdi_relacionados_anticipos_aplicacion_caja tbody').empty();
			$('#numElementos_cfdi_relacionados_anticipos_aplicacion_caja').html(0);
			$('#txtNumCfdiRelacionados_anticipos_aplicacion_caja').val('');
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_anticipos_aplicacion_caja()
		{
			try {

				//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
				cerrar_cancelacion_anticipos_aplicacion_caja();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
				cerrar_cliente_anticipos_aplicacion_caja();
				//Hacer un llamado a la función para cerrar modal Relacionar CFDI
				cerrar_relacionar_cfdi_anticipos_aplicacion_caja();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_anticipos_aplicacion_caja('');
				//Cerrar modal Aplicación de Anticipos
				objAnticiposAplicacionCaja.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_anticipos_aplicacion_caja').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_anticipos_aplicacion_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_anticipos_aplicacion_caja();

			//Validación del formulario de campos obligatorios
			$('#frmAnticiposAplicacionCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_anticipos_aplicacion_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strAnticipo_anticipos_aplicacion_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del anticipo
					                                    if($('#txtAnticipoID_anticipos_aplicacion_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un anticipo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCliente_anticipos_aplicacion_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del cliente
					                                    if($('#txtProspectoID_anticipos_aplicacion_caja').val() === '')
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
										strFormaPago_anticipos_aplicacion_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la forma de pago
					                                    if($('#txtFormaPagoID_anticipos_aplicacion_caja').val() === '')
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
										strMetodoPago_anticipos_aplicacion_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del método de pago
					                                    if($('#txtMetodoPagoID_anticipos_aplicacion_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un método de pago existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intExportacionID_anticipos_aplicacion_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una exportación'}
											}
										},
										strUsoCfdi_anticipos_aplicacion_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del uso de CFDI
					                                    if($('#txtUsoCfdiID_anticipos_aplicacion_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un uso de CFDI existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strTipoRelacion_anticipos_aplicacion_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if($('#txtTipoRelacionID_anticipos_aplicacion_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un tipo de relación existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strConcepto_anticipos_aplicacion_caja: {
											validators: {
												notEmpty: {message: 'Escriba un concepto'}
											}
										},
										strObjetoImpuesto_anticipos_aplicacion_caja: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista código del objeto de impuesto
					                                    if($('#txtObjetoImpuestoSat_anticipos_aplicacion_caja').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un objeto de impuesto SAT existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intSubtotal_anticipos_aplicacion_caja: {
											validators: {
												notEmpty: {message: 'Escriba un importe'}
											}
										},
										intPorcentajeIva_anticipos_aplicacion_caja: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IVA
					                                    if($('#txtTasaCuotaIva_anticipos_aplicacion_caja').val() === '')
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
										intPorcentajeIeps_anticipos_aplicacion_caja: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IEPS
					                                    if(value != '' && $('#txtTasaCuotaIeps_anticipos_aplicacion_caja').val() === '')
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
										},
										intNumCfdiRelacionados_anticipos_aplicacion_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan CFDI relacionados
					                                    if(parseInt($('#txtTipoRelacionID_anticipos_aplicacion_caja').val()) > 0 &&
					                                    	(parseInt(value) === 0 || value === ''))
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un CFDI para esta aplicación de anticipo.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_anticipos_aplicacion_caja = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_anticipos_aplicacion_caja = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_anticipos_aplicacion_caja.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_anticipos_aplicacion_caja.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_anticipos_aplicacion_caja = $('#frmAnticiposAplicacionCaja').data('bootstrapValidator');
			bootstrapValidator_anticipos_aplicacion_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_anticipos_aplicacion_caja.isValid())
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intTotal =  parseFloat($.reemplazar($('#txtTotal_anticipos_aplicacion_caja').val(), ",", ""));
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intSaldoAnticipo = parseFloat($.reemplazar($('#txtSaldoAnticipo_anticipos_aplicacion_caja').val(), ",", ""));

				//Verificar que el total sea menor al saldo del anticipo
				if(intTotal > intSaldoAnticipo)
				{
					//Cambiar cantidad a formato moneda
					intSaldoAnticipo = formatMoney(intSaldoAnticipo, 2, '');

					/*Mensaje que se utiliza para informar al usuario que el total de la aplicación no debe ser mayor que el saldo del anticipo que hace falta aplicar*/
					var strMensaje = 'La aplicación sobrepasa el saldo del anticipo.';
						strMensaje += '<br>Saldo restante: <b>'+intSaldoAnticipo+'</b>';

					//Hacer un llamado a la función para mostrar mensaje de información
				    mensaje_anticipos_aplicacion_caja('error', strMensaje);
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_anticipos_aplicacion_caja();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_anticipos_aplicacion_caja()
		{
			try
			{
				$('#frmAnticiposAplicacionCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_anticipos_aplicacion_caja()
		{
		   	//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioAplicacion = parseFloat($('#txtTipoCambio_anticipos_aplicacion_caja').val());
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			var intSubtotalAplicacion = $.reemplazar($('#txtSubtotal_anticipos_aplicacion_caja').val(), ",", "");
			var intImporteIva = $('#txtIva_anticipos_aplicacion_caja').val();
			var intImporteIeps = $('#txtIeps_anticipos_aplicacion_caja').val();
			
			//Convertir importes a peso mexicano
			intSubtotalAplicacion = intSubtotalAplicacion * intTipoCambioAplicacion;
			intImporteIva = intImporteIva * intTipoCambioAplicacion;
			intImporteIeps = intImporteIeps * intTipoCambioAplicacion;

			//Obtenemos el objeto de la tabla CFDI relacionados
			var objTabla = document.getElementById('dg_cfdi_relacionados_anticipos_aplicacion_caja').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrCfdiRelacionado = [];
			var arrTiposRelacion = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Asignar valores a los arrays
				arrCfdiRelacionado.push(objRen.cells[7].innerHTML);
				arrTiposRelacion.push(objRen.cells[3].innerHTML);
			}

		
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('caja/anticipos_aplicacion/guardar',
					{ 
						//Datos de la aplicación de anticipo
						intAnticipoAplicacionID: $('#txtAnticipoAplicacionID_anticipos_aplicacion_caja').val(),
						intAnticipoID: $('#txtAnticipoID_anticipos_aplicacion_caja').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_anticipos_aplicacion_caja').val()),
						intMonedaID: $('#txtMonedaID_anticipos_aplicacion_caja').val(),
						intTipoCambio: intTipoCambioAplicacion,
						intProspectoID: $('#txtProspectoID_anticipos_aplicacion_caja').val(),
						strRazonSocial: $('#txtRazonSocial_anticipos_aplicacion_caja').val(),
						strRfc: $('#txtRfc_anticipos_aplicacion_caja').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_anticipos_aplicacion_caja').val(),
						intRegimenFiscalIDAnterior: $('#txtRegimenFiscalIDAnterior_anticipos_aplicacion_caja').val(),
						strCalle: $('#txtCalle_anticipos_aplicacion_caja').val(),
						strNumeroExterior: $('#txtNumeroExterior_anticipos_aplicacion_caja').val(),
						strNumeroInterior: $('#txtNumeroInterior_anticipos_aplicacion_caja').val(),
						strCodigoPostal: $('#txtCodigoPostal_anticipos_aplicacion_caja').val(),
						strColonia: $('#txtColonia_anticipos_aplicacion_caja').val(),
						strLocalidad: $('#txtLocalidad_anticipos_aplicacion_caja').val(),
						strMunicipio: $('#txtMunicipio_anticipos_aplicacion_caja').val(),
						strEstado: $('#txtEstado_anticipos_aplicacion_caja').val(),
						strPais: $('#txtPais_anticipos_aplicacion_caja').val(),
						strConcepto: $('#txtConcepto_anticipos_aplicacion_caja').val(),
						intSubtotal: intSubtotalAplicacion,
						intTasaCuotaIva: $('#txtTasaCuotaIva_anticipos_aplicacion_caja').val(),
						intIva: intImporteIva,
						intTasaCuotaIeps: $('#txtTasaCuotaIeps_anticipos_aplicacion_caja').val(),
						intIeps: intImporteIeps,
						intFormaPagoID: $('#txtFormaPagoID_anticipos_aplicacion_caja').val(),
						intMetodoPagoID: $('#txtMetodoPagoID_anticipos_aplicacion_caja').val(),
						intUsoCfdiID: $('#txtUsoCfdiID_anticipos_aplicacion_caja').val(),
						intTipoRelacionID: $('#txtTipoRelacionID_anticipos_aplicacion_caja').val(),
						intExportacionID: $('#cmbExportacionID_anticipos_aplicacion_caja').val(),
						strObjetoImpuestoSat: $('#txtObjetoImpuestoSat_anticipos_aplicacion_caja').val(),
						strObservaciones: $('#txtObservaciones_anticipos_aplicacion_caja').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_anticipos_aplicacion_caja').val(),
						//Datos de los CFDI relacionados
						strCfdiRelacionado: arrCfdiRelacionado.join('|'),
						strTiposRelacion: arrTiposRelacion.join('|')
					},
					function(data) {
						if (data.resultado)
						{
							//Si no existe id de la aplicación de anticipo, significa que es un nuevo registro   
							if($('#txtAnticipoAplicacionID_anticipos_aplicacion_caja').val() == '')
							{
							  	//Asignar el id de la aplicación de anticipo registrada en la base de datos
                     			$('#txtAnticipoAplicacionID_anticipos_aplicacion_caja').val(data.anticipo_aplicacion_id);
                 			}

                 			//Hacer llamado a la función para cargar  los registros en el grid
							paginacion_anticipos_aplicacion_caja();
							
                 			//Hacer un llamado a la función para timbrar los datos del registro
							timbrar_anticipos_aplicacion_caja($('#txtAnticipoAplicacionID_anticipos_aplicacion_caja').val(), 'modal', '', $('#txtRegimenFiscalID_anticipos_aplicacion_caja').val());	
			                           
						}

						//Si existe mensaje de error
						if(data.tipo_mensaje == 'error')
						{
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_anticipos_aplicacion_caja(data.tipo_mensaje, data.mensaje);
						}
						
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_anticipos_aplicacion_caja(tipoMensaje, mensaje, campoID)
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
			else if(tipoMensaje == 'error_timbrado')
			{ 
				//Indicar al usuario el mensaje de error
				new $.Zebra_Dialog(mensaje, 
							  {'type': 'error',
							   'title': 'Error',
							   'width': 650
				    		  });
			}
			else if(tipoMensaje == 'error_regimen_fiscal')
			{ 
				//Indicar al usuario el mensaje de error
				new $.Zebra_Dialog(strMsjRegimenFiscalCteAnticiposAplicacionCaja, 
								  {'type': 'error',
								   'title': 'Error',
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

		//Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_anticipos_aplicacion_caja(id, folio)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para asignar el folio del registro
			var strFolio = 0;

			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtAnticipoAplicacionID_anticipos_aplicacion_caja').val();
				strFolio = $('#txtFolio_anticipos_aplicacion_caja').val();

			}
			else
			{
				intID = id;
				strFolio = folio;
			}

		   
			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea cancelar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Aplicación de Anticipos',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              
			                              	//Hacer un llamado a la función para abrir el modal Cancelación del timbrado (cambiar estatus y cancelar timbrado del registro)
					                        abrir_cancelacion_anticipos_aplicacion_caja(intID, strFolio);
			                            }
			                          }
			              });
		}

	
		//Función para cancelar el timbrado de un registro. Cambia el estatus a INACTIVO
		function cancelar_timbrado_anticipos_aplicacion_caja()
		{

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cancelacion_anticipos_aplicacion_caja();
			 //Hacer un llamado al método del controlador para cancelar un CFDI y posteriormente cambiar el estatus a INACTIVO
	         //----- CÓDIGO PARA PRODUCCIÓN
	          $.post('contabilidad/timbrado_cancelar/set_cancelar',
	          {
	          		//Datos para cancelar el timbrado (CFDI)
	         		intMovimientoID: $('#txtReferenciaCfdiID_cancelacion_anticipos_aplicacion_caja').val(),
					strTipoReferencia: strTipoReferenciaAnticiposAplicacionCaja, 
					strUuidSustitucion: $('#txtUuidSustitucion_cancelacion_anticipos_aplicacion_caja').val(),
					strMotivo: $('select[name="intCancelacionMotivoID_anticipos_aplicacion_caja"] option:selected').text(),
					//Datos para cambiar (administrativamente) el estatus del registro
					intCancelacionMotivoID: $('#cmbCancelacionMotivoID_cancelacion_anticipos_aplicacion_caja').val(), 
					intSustitucionID:  $('#txtSustitucionID_cancelacion_anticipos_aplicacion_caja').val(),
	          },
	                 function(data) {

	                    if(data.resultado)
	                    {
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_anticipos_aplicacion_caja();	

							//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
							cerrar_cancelacion_anticipos_aplicacion_caja();  

							//Si el id del registro se obtuvo del modal
							if($('#txtAnticipoAplicacionID_anticipos_aplicacion_caja').val() != '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_anticipos_aplicacion_caja();     
							}		
	                    }

	                    //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
				        ocultar_circulo_carga_cancelacion_anticipos_aplicacion_caja();
					    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_anticipos_aplicacion_caja(data.tipo_mensaje, data.mensaje);


	                 },
	                'json');

		}



		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_anticipos_aplicacion_caja(id, tipoAccion, cancelacionID)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('caja/anticipos_aplicacion/get_datos',
			       {intAnticipoAplicacionID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_anticipos_aplicacion_caja();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;

						    //Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);
				            var intSubtotal  = parseFloat(data.row.subtotal);
				            var intSaldoAnticipo = parseFloat(data.total_aplicar);

				            //Convertir peso mexicano a tipo de cambio
							intSubtotal = intSubtotal / intTipoCambio;
							intSaldoAnticipo = intSaldoAnticipo / intTipoCambio;
						
				          	//Recuperar valores
				          	$('#txtAnticipoAplicacionID_anticipos_aplicacion_caja').val(data.row.anticipo_aplicacion_id);
				          	$('#txtAnticipoID_anticipos_aplicacion_caja').val(data.row.anticipo_id);
				          	$('#txtAnticipo_anticipos_aplicacion_caja').val(data.row.folio_anticipo);
				          	$('#txtFolio_anticipos_aplicacion_caja').val(data.row.folio);
				          	$('#txtFecha_anticipos_aplicacion_caja').val(data.row.fecha_format);
				          	$('#txtMonedaID_anticipos_aplicacion_caja').val(data.row.moneda_id);
				          	$('#txtMoneda_anticipos_aplicacion_caja').val(data.row.moneda);
				          	$('#txtTipoCambio_anticipos_aplicacion_caja').val(data.row.tipo_cambio);
						    $('#txtProspectoID_anticipos_aplicacion_caja').val(data.row.prospecto_id);
						    $('#txtRazonSocial_anticipos_aplicacion_caja').val(data.row.razon_social);
						    $('#txtRfc_anticipos_aplicacion_caja').val(data.row.rfc);
						    $('#txtRegimenFiscalID_anticipos_aplicacion_caja').val(data.row.regimen_fiscal_id);
						    $('#txtRegimenFiscalIDAnterior_anticipos_aplicacion_caja').val(data.row.regimenFiscalAnterior);
						    $('#txtCalle_anticipos_aplicacion_caja').val(data.row.calle);
						    $('#txtNumeroExterior_anticipos_aplicacion_caja').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_anticipos_aplicacion_caja').val(data.row.numero_interior);
						    $('#txtCodigoPostal_anticipos_aplicacion_caja').val(data.row.codigo_postal);
						    $('#txtColonia_anticipos_aplicacion_caja').val(data.row.colonia);
						    $('#txtLocalidad_anticipos_aplicacion_caja').val(data.row.localidad);
						    $('#txtMunicipio_anticipos_aplicacion_caja').val(data.row.municipio);
						    $('#txtEstado_anticipos_aplicacion_caja').val(data.row.estado);
						    $('#txtPais_anticipos_aplicacion_caja').val(data.row.pais);
						    $('#txtConcepto_anticipos_aplicacion_caja').val(data.row.concepto);
						    $('#txtSubtotal_anticipos_aplicacion_caja').val(intSubtotal);
						    $('#txtSaldoAnticipo_anticipos_aplicacion_caja').val(intSaldoAnticipo);
						    $('#txtTasaCuotaIva_anticipos_aplicacion_caja').val(data.row.tasa_cuota_iva);
						    $('#txtPorcentajeIva_anticipos_aplicacion_caja').val(data.row.porcentaje_iva);
						    $('#txtTasaCuotaIeps_anticipos_aplicacion_caja').val(data.row.tasa_cuota_ieps);
						    $('#txtPorcentajeIeps_anticipos_aplicacion_caja').val(data.row.porcentaje_ieps);
						    //Hacer un llamado a la función para calcular el importe total del anticipo
							calcular_total_anticipos_aplicacion_caja();
							//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtSubtotal_anticipos_aplicacion_caja').formatCurrency({ roundToDecimalPlace: 2 });
					        $('#txtSaldoAnticipo_anticipos_aplicacion_caja').formatCurrency({ roundToDecimalPlace: 2 });
						    $('#txtFormaPagoID_anticipos_aplicacion_caja').val(data.row.forma_pago_id);
						    $('#txtFormaPago_anticipos_aplicacion_caja').val(data.row.forma_pago);
						    $('#txtMetodoPagoID_anticipos_aplicacion_caja').val(data.row.metodo_pago_id);
						    $('#txtMetodoPago_anticipos_aplicacion_caja').val(data.row.metodo_pago);
						    $('#txtUsoCfdiID_anticipos_aplicacion_caja').val(data.row.uso_cfdi_id);
						    $('#txtUsoCfdi_anticipos_aplicacion_caja').val(data.row.uso_cfdi);
						    $('#txtTipoRelacionID_anticipos_aplicacion_caja').val(data.row.tipo_relacion_id);
						    $('#txtTipoRelacion_anticipos_aplicacion_caja').val(data.row.tipo_relacion);
						    $('#cmbExportacionID_anticipos_aplicacion_caja').val(data.row.exportacion_id);
						    $('#txtObjetoImpuestoSat_anticipos_aplicacion_caja').val(data.row.objeto_impuesto_sat);
				            $('#txtObjetoImpuesto_anticipos_aplicacion_caja').val(data.row.objeto_impuesto);
					        $('#txtObservaciones_anticipos_aplicacion_caja').val(data.row.observaciones);
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_anticipos_aplicacion_caja').addClass("estatus-"+strEstatus);
				            $('#txtEstatus_anticipos_aplicacion_caja').val(strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_anticipos_aplicacion_caja").show();

				            //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar botón Descargar Archivo
				            	$("#btnDescargarArchivo_anticipos_aplicacion_caja").show();
				           	}
				           	
				           	//Si el estatus del registro es diferente de TIMBRAR
				            if(strEstatus != 'TIMBRAR')
							{
								//Deshabilitar todos los elementos del formulario
				            	$('#frmAnticiposAplicacionCaja').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_anticipos_aplicacion_caja").hide();
								$("#btnBuscarCFDI_anticipos_aplicacion_caja").hide(); 

								//Si el estatus del registro es ACTIVO
								if(strEstatus == 'ACTIVO')
								{
									//Mostrar los siguientes botones
				            		$("#btnEnviarCorreo_anticipos_aplicacion_caja").show();
				            		$('#btnDesactivar_anticipos_aplicacion_caja').show();
								}

								//Si existe id de la cancelación del CFDI
								if(cancelacionID > 0)
								{	
									//Asignar el id de la cancelación
									$("#txtCancelacionID_anticipos_aplicacion_caja").val(cancelacionID); 
									//Mostrar botón Motivo de cancelación
									$("#btnVerMotivoCancelacion_anticipos_aplicacion_caja").show(); 
								}

							}

							//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
							agregar_cfdi_relacionados_anticipos_aplicacion_caja('Editar', strEstatus);	

							//Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objAnticiposAplicacionCaja = $('#AnticiposAplicacionCajaBox').bPopup({
													  appendTo: '#AnticiposAplicacionCajaContent', 
						                              contentContainer: 'AnticiposAplicacionCajaM', 
						                              zIndex: 2, 
						                              modalClose: false, 
						                              modal: true, 
						                              follow: [true,false], 
						                              followEasing : "linear", 
						                              easing: "linear", 
						                              modalColor: ('#F0F0F0')});
				            }
				            //Enfocar caja de texto
							$('#txtAnticipo_anticipos_aplicacion_caja').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar y obtener los datos de un cliente
		function get_datos_cliente_anticipos_aplicacion_caja()
		{
		 	//Hacer un llamado al método del controlador para regresar los datos del cliente
            $.post('cuentas_cobrar/clientes/get_datos',
                  { 
                  	intProspectoID:$("#txtProspectoID_anticipos_aplicacion_caja").val()
                  },
                  function(data) {	                  	
                    if(data.row){
                       //Asignar datos del registro seleccionado
                       $("#txtRfc_anticipos_aplicacion_caja").val(data.row.rfc);
                       $('#txtRegimenFiscalID_anticipos_aplicacion_caja').val(data.row.regimen_fiscal_id);
                       $("#txtCalle_anticipos_aplicacion_caja").val(data.row.calle);
                       $("#txtNumeroExterior_anticipos_aplicacion_caja").val(data.row.numero_exterior);
                       $("#txtNumeroInterior_anticipos_aplicacion_caja").val(data.row.numero_interior);
                       $("#txtCodigoPostal_anticipos_aplicacion_caja").val(data.row.codigo_postal);
                       $("#txtColonia_anticipos_aplicacion_caja").val(data.row.colonia);
                       $("#txtLocalidad_anticipos_aplicacion_caja").val(data.row.localidad);
                       $("#txtMunicipio_anticipos_aplicacion_caja").val(data.row.municipio);
                       $("#txtEstado_anticipos_aplicacion_caja").val(data.row.estado_rep);
                       $("#txtPais_anticipos_aplicacion_caja").val(data.row.pais_rep);
                    }
                  }
                 ,
                'json');

		}

		//Función para regresar y obtener los datos de un anticipo
		function get_datos_anticipo_anticipos_aplicacion_caja()
		{
		 	//Hacer un llamado al método del controlador para regresar los datos del anticipo
            $.post('caja/anticipos/get_datos',
                  { 
                  	intAnticipoID:$("#txtAnticipoID_anticipos_aplicacion_caja").val()
                  },
                  function(data) {	                  	
                    if(data.row){

                    	//Variable que se utiliza para asignar el tipo de cambio
		            	var intTipoCambio = parseFloat(data.row.tipo_cambio);
		            	//Variable que se utiliza para asignar el total del anticipo que hace falta aplicar
		            	var intTotalAnticipoAplicar = parseFloat(data.total_aplicar);

		            	//Convertir peso mexicano a tipo de cambio
					 	intTotalAnticipoAplicar = intTotalAnticipoAplicar / intTipoCambio;

					 	//Si existe saldo del anticipo por aplicar
					 	if(intTotalAnticipoAplicar > 0)
					 	{
						   //Asignar datos del registro seleccionado
	                       $("#txtMonedaID_anticipos_aplicacion_caja").val(data.row.moneda_id);
	                       $("#txtMoneda_anticipos_aplicacion_caja").val(data.row.moneda);
	                       $("#txtTipoCambio_anticipos_aplicacion_caja").val(data.row.tipo_cambio);
	                       $("#txtProspectoID_anticipos_aplicacion_caja").val(data.row.prospecto_id);
	                       $("#txtRazonSocial_anticipos_aplicacion_caja").val(data.row.razon_social);
	                       $("#txtRfc_anticipos_aplicacion_caja").val(data.row.rfc);
	                       $("#txtRegimenFiscalID_anticipos_aplicacion_caja").val(data.row.regimen_fiscal_id);
	                       $("#txtRegimenFiscalIDAnterior_anticipos_aplicacion_caja").val(data.row.regimenFiscalAnterior);
	                       $("#txtCalle_anticipos_aplicacion_caja").val(data.row.calle);
	                       $("#txtNumeroExterior_anticipos_aplicacion_caja").val(data.row.numero_exterior);
	                       $("#txtNumeroInterior_anticipos_aplicacion_caja").val(data.row.numero_interior);
	                       $("#txtCodigoPostal_anticipos_aplicacion_caja").val(data.row.codigo_postal);
	                       $("#txtColonia_anticipos_aplicacion_caja").val(data.row.colonia);
	                       $("#txtLocalidad_anticipos_aplicacion_caja").val(data.row.localidad);
	                       $("#txtMunicipio_anticipos_aplicacion_caja").val(data.row.municipio);
	                       $("#txtEstado_anticipos_aplicacion_caja").val(data.row.estado);
	                       $("#txtPais_anticipos_aplicacion_caja").val(data.row.pais);
						   $("#txtSaldoAnticipo_anticipos_aplicacion_caja").val(intTotalAnticipoAplicar);
						   //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					       $('#txtSaldoAnticipo_anticipos_aplicacion_caja').formatCurrency({ roundToDecimalPlace: 2 });
					
					 	}
					 	else
					 	{
					 		//Asignar folio del anticipo que se desea aplicar
					 		var strFolioAnticipo = $('#txtAnticipo_anticipos_aplicacion_caja').val();
					 		/*Mensaje que se utiliza para informar al usuario que el subtotal no se puede aplicar el anticipo*/
							var strMensaje = 'El anticipo: '+strFolioAnticipo+' ya ha sido aplicado.';

							//Limpiar contenido de las siguientes cajas de texto
							$('#txtAnticipoID_anticipos_aplicacion_caja').val('');
							$('#txtAnticipo_anticipos_aplicacion_caja').val('');

							//Hacer un llamado a la función para mostrar mensaje de información
							mensaje_anticipos_aplicacion_caja('informacion', strMensaje, 'txtAnticipo_anticipos_aplicacion_caja');
					 	}
                      
                    }
                  }
                 ,
                'json');

		}


		//Función para timbrar los datos de un registro
		function timbrar_anticipos_aplicacion_caja(id, tipo, formulario, regimenFiscalID)
		{

			//Si existe id del régimen fiscal
			if(regimenFiscalID > 0)
			{
				
				//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
				mostrar_circulo_carga_anticipos_aplicacion_caja(formulario);
				//Hacer un llamado al método del controlador para timbrar los datos del registro
				$.post('contabilidad/timbradoV4/set_timbrar',
				     {intReferenciaID: id,
				      strTipoReferencia: strTipoReferenciaAnticiposAplicacionCaja
				     },
				     function(data) {


				     	//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Si existe resultado (los datos se timbraron correctamente)
							if (data.resultado)
							{

								//Hacer un llamado a la función para cerrar modal
								cerrar_anticipos_aplicacion_caja();  
							}
							else
							{

								//Hacer un llamado a la función para limpiar los mensajes de error 
								limpiar_mensajes_anticipos_aplicacion_caja();
								//Hacer un llamado a la función para cargar datos del registro (habilitar campos de timbrado)
								editar_anticipos_aplicacion_caja(id,'Nuevo');

							}
						}

						//Hacer llamado a la función para cargar  los registros en el grid
				   	    paginacion_anticipos_aplicacion_caja();
						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			            ocultar_circulo_carga_anticipos_aplicacion_caja(formulario);
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_anticipos_aplicacion_caja(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
			}
			else
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				 mensaje_anticipos_aplicacion_caja('error_regimen_fiscal');
			}
		}

		//Función que se utiliza para calcular el importe total de la aplicación de anticipo
		function calcular_total_anticipos_aplicacion_caja()
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
			var intPorcentajeIva = $('#txtPorcentajeIva_anticipos_aplicacion_caja').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_anticipos_aplicacion_caja').val();

         	//Verificar que exista importe de subtotal
			if($('#txtSubtotal_anticipos_aplicacion_caja').val() != '')
			{ 
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intSubtotal = $.reemplazar($("#txtSubtotal_anticipos_aplicacion_caja").val(), ",", "");
				intSubtotal = parseFloat(intSubtotal);

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
			$('#txtTotal_anticipos_aplicacion_caja').val(intTotal);
		    $('#txtIva_anticipos_aplicacion_caja').val(intImporteIva);
			$('#txtIeps_anticipos_aplicacion_caja').val(intImporteIeps);
			
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function mostrar_circulo_carga_anticipos_aplicacion_caja(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_anticipos_aplicacion_caja';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_anticipos_aplicacion_caja';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function ocultar_circulo_carga_anticipos_aplicacion_caja(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_anticipos_aplicacion_caja';

			//Si el Div a ocultar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_anticipos_aplicacion_caja';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones de la tabla CFDI relacionados
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_cfdi_relacionados_anticipos_aplicacion_caja(tipoAccion, estatus)
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Si se cumple la sentencia
			if(estatus == '' || estatus == 'TIMBRAR')
			{
				strAccionesTabla = "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_cfdi_relacionados_anticipos_aplicacion_caja(this)'>" + 
									   "<span class='glyphicon glyphicon-trash'></span></button>" + 
									   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
									   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
									   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
									   "<span class='glyphicon glyphicon-arrow-down'></span></button>";
			}

			//Si el tipo de acción corresponde a Editar						   
			if(tipoAccion == 'Editar')
			{
				//Hacer un llamado al método del controlador para regresar listado de registros
				$.post('caja/cfdi_relacionados/get_datos',
						{	
							intReferenciaID: $('#txtAnticipoAplicacionID_anticipos_aplicacion_caja').val(),
							strTipoReferencia: strTipoReferenciaAnticiposAplicacionCaja
						},
						function(data){

							//Mostramos los CFDI´s relacionados (facturas seleccionadas)
				           	for (var intCon in data.rows) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_cfdi_relacionados_anticipos_aplicacion_caja').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaCliente = objRenglon.insertCell(0);
								var objCeldaFolio = objRenglon.insertCell(1);
								var objCeldaFecha = objRenglon.insertCell(2);
								var objCeldaModulo = objRenglon.insertCell(3);
								var objCeldaUuid = objRenglon.insertCell(4);
								var objCeldaImporte = objRenglon.insertCell(5);
								var objCeldaAcciones = objRenglon.insertCell(6);
								//Columnas ocultas
								var objCeldaReferenciaID = objRenglon.insertCell(7);

								//Variable que se utiliza para asignar el id del detalle
								var strDetalleID =  data.rows[intCon].referencia_id+'_'+data.rows[intCon].tipo_referencia;

								//Variable que se utiliza para asignar las acciones del grid view (en caso de que el folio del CFDI relacionado sea diferente al folio del anticipo)
		    					var strAccionesRenglon = strAccionesTabla;

								//Si el folio del CFDI relacionado es igual al folio del anticipo
								if(data.rows[intCon].folio ==  $('#txtAnticipo_anticipos_aplicacion_caja').val())
								{
									//No mostrar acciones
									strAccionesRenglon = '';
								}

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id',strDetalleID);
								objCeldaCliente.setAttribute('class', 'movil c1');
								objCeldaCliente.innerHTML = data.rows[intCon].cliente;
								objCeldaFolio.setAttribute('class', 'movil c2');
								objCeldaFolio.innerHTML =  data.rows[intCon].folio;
								objCeldaFecha.setAttribute('class', 'movil c3');
								objCeldaFecha.innerHTML = data.rows[intCon].fecha;
								objCeldaModulo.setAttribute('class', 'movil c4');
								objCeldaModulo.innerHTML =  data.rows[intCon].tipo_referencia;
								objCeldaUuid.setAttribute('class', 'movil c5');
								objCeldaUuid.innerHTML =  data.rows[intCon].uuid;
								objCeldaImporte.setAttribute('class', 'movil c6');
								objCeldaImporte.innerHTML = data.rows[intCon].importe;
								objCeldaAcciones.setAttribute('class', 'td-center movil c7');
								objCeldaAcciones.innerHTML = strAccionesRenglon;
								objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
								objCeldaReferenciaID.innerHTML =  data.rows[intCon].referencia_id;

				            }

				            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
							var intFilas = $("#dg_cfdi_relacionados_anticipos_aplicacion_caja tr").length - 1;
							$('#numElementos_cfdi_relacionados_anticipos_aplicacion_caja').html(intFilas);
							$('#txtNumCfdiRelacionados_anticipos_aplicacion_caja').val(intFilas);
						},
				'json');
			}
			else
			{
				//Mostramos los CFDI´s relacionados (facturas seleccionadas)
				for (var intCon in objCfdisRelacionadosAnticiposAplicacionCaja.getCfdis()) 
	            {
	            	//Crear instancia del objeto CFDI a relacionar 
	            	objCfdiRelacionarAnticiposAplicacionCaja = new CfdiRelacionarAnticiposAplicacionCaja();
	            	//Asignar datos del CFDI corespondiente al indice
	            	objCfdiRelacionarAnticiposAplicacionCaja = objCfdisRelacionadosAnticiposAplicacionCaja.getCfdi(intCon);
	            	
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_cfdi_relacionados_anticipos_aplicacion_caja').getElementsByTagName('tbody')[0];

						//Variable que se utiliza para asignar el id del detalle
					var strDetalleID =  objCfdiRelacionarAnticiposAplicacionCaja.intReferenciaID+'_'+objCfdiRelacionarAnticiposAplicacionCaja.strTipoReferencia;

					//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
					if (!objTabla.rows.namedItem(strDetalleID))
					{
						//Insertamos el renglón con sus celdas en el objeto de la tabla
						var objRenglon = objTabla.insertRow();
						var objCeldaCliente = objRenglon.insertCell(0);
						var objCeldaFolio = objRenglon.insertCell(1);
						var objCeldaFecha = objRenglon.insertCell(2);
						var objCeldaModulo = objRenglon.insertCell(3);
						var objCeldaUuid = objRenglon.insertCell(4);
						var objCeldaImporte = objRenglon.insertCell(5);
						var objCeldaAcciones = objRenglon.insertCell(6);
						//Columnas ocultas
					    var objCeldaReferenciaID = objRenglon.insertCell(7);

						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', strDetalleID);
						objCeldaCliente.setAttribute('class', 'movil c1');
						objCeldaCliente.innerHTML = objCfdiRelacionarAnticiposAplicacionCaja.strCliente;
						objCeldaFolio.setAttribute('class', 'movil c2');
						objCeldaFolio.innerHTML = objCfdiRelacionarAnticiposAplicacionCaja.strFolio;
						objCeldaFecha.setAttribute('class', 'movil c3');
						objCeldaFecha.innerHTML = objCfdiRelacionarAnticiposAplicacionCaja.dteFecha;
						objCeldaModulo.setAttribute('class', 'movil c4');
						objCeldaModulo.innerHTML = objCfdiRelacionarAnticiposAplicacionCaja.strTipoReferencia;
						objCeldaUuid.setAttribute('class', 'movil c5');
						objCeldaUuid.innerHTML =  objCfdiRelacionarAnticiposAplicacionCaja.strUuid;
						objCeldaImporte.setAttribute('class', 'movil c6');
						objCeldaImporte.innerHTML = objCfdiRelacionarAnticiposAplicacionCaja.intImporte;
						objCeldaAcciones.setAttribute('class', 'td-center movil c7');
						objCeldaAcciones.innerHTML = strAccionesTabla;
						objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
						objCeldaReferenciaID.innerHTML = objCfdiRelacionarAnticiposAplicacionCaja.intReferenciaID;
					}
	            }

	            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
				var intFilas = $("#dg_cfdi_relacionados_anticipos_aplicacion_caja tr").length - 1;
				$('#numElementos_cfdi_relacionados_anticipos_aplicacion_caja').html(intFilas);
				$('#txtNumCfdiRelacionados_anticipos_aplicacion_caja').val(intFilas);
			}
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_cfdi_relacionados_anticipos_aplicacion_caja(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_cfdi_relacionados_anticipos_aplicacion_caja").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
			var intFilas = $("#dg_cfdi_relacionados_anticipos_aplicacion_caja tr").length - 1;
			$('#numElementos_cfdi_relacionados_anticipos_aplicacion_caja').html(intFilas);
			$('#txtNumCfdiRelacionados_anticipos_aplicacion_caja').val(intFilas);
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Aplicación de Anticipos
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_anticipos_aplicacion_caja').datetimepicker({format: 'DD/MM/YYYY'});
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtPorcentajeIva_anticipos_aplicacion_caja').numeric();
        	$('#txtPorcentajeIeps_anticipos_aplicacion_caja').numeric();
        	$('#txtSubtotal_anticipos_aplicacion_caja').numeric();
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_anticipos_aplicacion_caja').blur(function(){
				$('.moneda_anticipos_aplicacion_caja').formatCurrency({ roundToDecimalPlace: 2 });
			});

		    //Autocomplete para recuperar los datos de un anticipo
	        $('#txtAnticipo_anticipos_aplicacion_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtAnticipoID_anticipos_aplicacion_caja').val('');
	               //Hacer un llamado a la función para inicializar elementos del anticipo
	               inicializar_anticipo_anticipos_aplicacion_caja();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "caja/anticipos/autocomplete",
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
	           	  //Si existe id del regimen fiscal
	              if(ui.item.regimen_fiscal_id > 0)
	           	  {
	           	  	 //Asignar id del registro seleccionado
		              $('#txtAnticipoID_anticipos_aplicacion_caja').val(ui.item.data);
		              //Hacer un llamado a la función para regresar los datos del anticipo
		              get_datos_anticipo_anticipos_aplicacion_caja();
	           	  }
	           	  else
	           	  {
 						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				     mensaje_anticipos_aplicacion_caja('error_regimen_fiscal','','txtAnticipo_anticipos_aplicacion_caja');
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
	        
			//Verificar que exista id del anticipo cuando pierda el enfoque la caja de texto
	        $('#txtAnticipo_anticipos_aplicacion_caja').focusout(function(e){
	            //Si no existe id del anticipo
	            if($('#txtAnticipoID_anticipos_aplicacion_caja').val() == '' ||
	               $('#txtAnticipo_anticipos_aplicacion_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtAnticipoID_anticipos_aplicacion_caja').val('');
	               $('#txtAnticipo_anticipos_aplicacion_caja').val('');
	               //Hacer un llamado a la función para inicializar elementos del anticipo
	               inicializar_anticipo_anticipos_aplicacion_caja();
	            }

	        });

        	//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_anticipos_aplicacion_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_anticipos_aplicacion_caja').val('');
	               //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_anticipos_aplicacion_caja();
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
	           	//Si existe id del regimen fiscal
	             if(ui.item.regimen_fiscal_id > 0)
	             {
		             //Asignar id del registro seleccionado
		             $('#txtProspectoID_anticipos_aplicacion_caja').val(ui.item.data);
		             //Hacer un llamado a la función para regresar los datos del cliente
		           	 get_datos_cliente_anticipos_aplicacion_caja();
	           	 }
	             else
	             {
	             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				     mensaje_anticipos_aplicacion_caja('error_regimen_fiscal','','txtRazonSocial_anticipos_aplicacion_caja');
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
	        
	        //Verificar que exista id del cliente cuando pierda el enfoque la caja de texto
	        $('#txtRazonSocial_anticipos_aplicacion_caja').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_anticipos_aplicacion_caja').val() == '' ||
	               $('#txtRazonSocial_anticipos_aplicacion_caja').val() == '')
	            { 
	            	//Limpiar contenido de las siguientes cajas de texto
	            	$('#txtProspectoID_anticipos_aplicacion_caja').val('');
	            	$('#txtRazonSocial_anticipos_aplicacion_caja').val('');
	                //Hacer un llamado a la función para inicializar elementos del cliente
	                inicializar_cliente_anticipos_aplicacion_caja();
	            }
	        });

	        //Autocomplete para recuperar los datos de una forma de pago
	        $('#txtFormaPago_anticipos_aplicacion_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtFormaPagoID_anticipos_aplicacion_caja').val('');
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
	             $('#txtFormaPagoID_anticipos_aplicacion_caja').val(ui.item.data);
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
	        $('#txtFormaPago_anticipos_aplicacion_caja').focusout(function(e){
	            //Si no existe id de la forma de pago
	            if($('#txtFormaPagoID_anticipos_aplicacion_caja').val() == '' ||
	               $('#txtFormaPago_anticipos_aplicacion_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtFormaPagoID_anticipos_aplicacion_caja').val('');
	               $('#txtFormaPago_anticipos_aplicacion_caja').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un método de pago
	        $('#txtMetodoPago_anticipos_aplicacion_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMetodoPagoID_anticipos_aplicacion_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_metodos_pago/autocomplete",
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
	             $('#txtMetodoPagoID_anticipos_aplicacion_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del método de pago cuando pierda el enfoque la caja de texto
	        $('#txtMetodoPago_anticipos_aplicacion_caja').focusout(function(e){
	            //Si no existe id del método de pago
	            if($('#txtMetodoPagoID_anticipos_aplicacion_caja').val() == '' ||
	               $('#txtMetodoPago_anticipos_aplicacion_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMetodoPagoID_anticipos_aplicacion_caja').val('');
	               $('#txtMetodoPago_anticipos_aplicacion_caja').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un uso del CFDI
	        $('#txtUsoCfdi_anticipos_aplicacion_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtUsoCfdiID_anticipos_aplicacion_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_uso_cfdi/autocomplete",
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
	             $('#txtUsoCfdiID_anticipos_aplicacion_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del uso de CFDI cuando pierda el enfoque la caja de texto
	        $('#txtUsoCfdi_anticipos_aplicacion_caja').focusout(function(e){
	            //Si no existe id del uso de CFDI
	            if($('#txtUsoCfdiID_anticipos_aplicacion_caja').val() == '' ||
	               $('#txtUsoCfdi_anticipos_aplicacion_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUsoCfdiID_anticipos_aplicacion_caja').val('');
	               $('#txtUsoCfdi_anticipos_aplicacion_caja').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un tipo de relación
	        $('#txtTipoRelacion_anticipos_aplicacion_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTipoRelacionID_anticipos_aplicacion_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_tipos_relacion/autocomplete",
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
	             $('#txtTipoRelacionID_anticipos_aplicacion_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del tipo de relación cuando pierda el enfoque la caja de texto
	        $('#txtTipoRelacion_anticipos_aplicacion_caja').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtTipoRelacionID_anticipos_aplicacion_caja').val() == '' ||
	               $('#txtTipoRelacion_anticipos_aplicacion_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTipoRelacionID_anticipos_aplicacion_caja').val('');
	               $('#txtTipoRelacion_anticipos_aplicacion_caja').val('');
	            }
	            
	        });


	        //Autocomplete para recuperar los datos de un objeto de impuesto
	        $('#txtObjetoImpuesto_anticipos_aplicacion_caja').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al código del registro 
	                 $('#txtObjetoImpuestoSat_anticipos_aplicacion_caja').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_objeto_impuesto/autocomplete",
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
	               //Elegir código desde el valor devuelto en el autocomplete
					var strCodigo = ui.item.value.split(" - ")[0];
	               //Asignar el código del registro seleccionado
	               $('#txtObjetoImpuestoSat_anticipos_aplicacion_caja').val(strCodigo);

	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista código del objeto de impuesto cuando pierda el enfoque la caja de texto
	        $('#txtObjetoImpuesto_anticipos_aplicacion_caja').focusout(function(e){
	            //Si no existe código del objeto de impuesto
	            if($('#txtObjetoImpuestoSat_anticipos_aplicacion_caja').val() == '' ||
	               $('#txtObjetoImpuesto_anticipos_aplicacion_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtObjetoImpuestoSat_anticipos_aplicacion_caja').val('');
	               $('#txtObjetoImpuesto_anticipos_aplicacion_caja').val('');
	            }
	            
	        });
	        
	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_anticipos_aplicacion_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_anticipos_aplicacion_caja').val('');
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
	             $('#txtTasaCuotaIva_anticipos_aplicacion_caja').val(ui.item.data);
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
	        $('#txtPorcentajeIva_anticipos_aplicacion_caja').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_anticipos_aplicacion_caja').val() == '' ||
	               $('#txtPorcentajeIva_anticipos_aplicacion_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_anticipos_aplicacion_caja').val('');
	               $('#txtPorcentajeIva_anticipos_aplicacion_caja').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_anticipos_aplicacion_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_anticipos_aplicacion_caja').val('');
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
	             $('#txtTasaCuotaIeps_anticipos_aplicacion_caja').val(ui.item.data);
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
	        $('#txtPorcentajeIeps_anticipos_aplicacion_caja').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_anticipos_aplicacion_caja').val() == '' ||
	               $('#txtPorcentajeIeps_anticipos_aplicacion_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_anticipos_aplicacion_caja').val('');
	               $('#txtPorcentajeIeps_anticipos_aplicacion_caja').val('');
	            }
	            
	        });

	        //Calcular el importe total del anticipo cuando pierda el enfoque la caja de texto
			$('#txtSubtotal_anticipos_aplicacion_caja').focusout(function(e){
				
				//Hacer un llamado a la función para calcular el importe total de la aplicación de anticipo
				calcular_total_anticipos_aplicacion_caja();

			});

			//Calcular el importe total del anticipo cuando pierda el enfoque la caja de texto
			$('#txtPorcentajeIva_anticipos_aplicacion_caja').focusout(function(e){
				//Hacer un llamado a la función para calcular el importe total de la aplicación de anticipo
				calcular_total_anticipos_aplicacion_caja();
			});

			//Calcular el importe total del anticipo cuando pierda el enfoque la caja de texto
			$('#txtPorcentajeIeps_anticipos_aplicacion_caja').focusout(function(e){
				//Hacer un llamado a la función para calcular el importe total de la aplicación de anticipo
				calcular_total_anticipos_aplicacion_caja();
			});

			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_cfdi_relacionados_anticipos_aplicacion_caja').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
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


			/*******************************************************************************************************************
			Controles correspondientes al modal Relacionar CFDI
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_relacionar_cfdi_anticipos_aplicacion_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_relacionar_cfdi_anticipos_aplicacion_caja').datetimepicker({format: 'DD/MM/YYYY'});
			
			
			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_relacionar_cfdi_anticipos_aplicacion_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_relacionar_cfdi_anticipos_aplicacion_caja').val('');
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
	             $('#txtProspectoIDBusq_relacionar_cfdi_anticipos_aplicacion_caja').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_relacionar_cfdi_anticipos_aplicacion_caja').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_relacionar_cfdi_anticipos_aplicacion_caja').val() == '' ||
	            	$('#txtRazonSocialBusq_relacionar_cfdi_anticipos_aplicacion_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_relacionar_cfdi_anticipos_aplicacion_caja').val('');
	               $('#txtRazonSocialBusq_relacionar_cfdi_anticipos_aplicacion_caja').val('');
	            }
	            
	        });
		    
		    
		    /*******************************************************************************************************************
			Controles correspondientes al modal Cancelación del timbrado
			**************************************	*******************************************************************************/
			 //Autocomplete para recuperar los datos de una sustitución (factura, pago, etc.)
	        $('#txtFolioSustitucion_cancelacion_anticipos_aplicacion_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSustitucionID_cancelacion_anticipos_aplicacion_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "caja/anticipos_aplicacion/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intReferenciaID: $('#txtReferenciaCfdiID_cancelacion_anticipos_aplicacion_caja').val(),
	                   strFormulario: 'cancelacion'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtSustitucionID_cancelacion_anticipos_aplicacion_caja').val(ui.item.data);
	             $('#txtUuidSustitucion_cancelacion_anticipos_aplicacion_caja').val(ui.item.uuid);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del folio de sustitución cuando pierda el enfoque la caja de texto
	        $('#txtFolioSustitucion_cancelacion_anticipos_aplicacion_caja').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtSustitucionID_cancelacion_anticipos_aplicacion_caja').val() == '' ||
	               $('#txtFolioSustitucion_cancelacion_anticipos_aplicacion_caja').val() == '')
	            { 
	               //Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_anticipos_aplicacion_caja();
	            }
	            
	        });

	        //Verificar motivo de cancelación cuando cambie la opción del combobox
	        $('#cmbCancelacionMotivoID_cancelacion_anticipos_aplicacion_caja').change(function(e){   
	            //Si el motivo de cancelación no corresponde a 01 - Comprobante emitido con errores con relación.
              	if(parseInt($('#cmbCancelacionMotivoID_cancelacion_anticipos_aplicacion_caja').val()) !== intCancelacionIDRelacionCfdiAnticiposAplicacionCaja)
             	{
             		//Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_anticipos_aplicacion_caja();
					
             	}
	        });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_anticipos_aplicacion_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_anticipos_aplicacion_caja').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_anticipos_aplicacion_caja').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_anticipos_aplicacion_caja').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_anticipos_aplicacion_caja').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_anticipos_aplicacion_caja').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_anticipos_aplicacion_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_anticipos_aplicacion_caja').val('');
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
	             $('#txtProspectoIDBusq_anticipos_aplicacion_caja').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_anticipos_aplicacion_caja').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_anticipos_aplicacion_caja').val() == '' ||
	            	$('#txtRazonSocialBusq_anticipos_aplicacion_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_anticipos_aplicacion_caja').val('');
	               $('#txtRazonSocialBusq_anticipos_aplicacion_caja').val('');
	            }
	            
	        });

			//Paginación de registros
			$('#pagLinks_anticipos_aplicacion_caja').on('click','a',function(event){
				event.preventDefault();
				intPaginaAnticiposAplicacionCaja = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_anticipos_aplicacion_caja();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_anticipos_aplicacion_caja').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_anticipos_aplicacion_caja();
				//Hacer un llamado a la función para cargar la forma de pago base
            	cargar_forma_pago_base_anticipos_aplicacion_caja();
				//Hacer un llamado a la función para cargar el método de pago base
            	cargar_metodo_pago_base_anticipos_aplicacion_caja();
	            //Hacer un llamado a la función para cargar el tipo de relación base
	            cargar_tipo_relacion_base_anticipos_aplicacion_caja();
	            //Hacer un llamado a la función para cargar el uso de objeto de impuesto base
				cargar_objeto_impuesto_base_anticipos_aplicacion_caja();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_anticipos_aplicacion_caja').addClass("estatus-NUEVO");
				//Abrir modal
				objAnticiposAplicacionCaja = $('#AnticiposAplicacionCajaBox').bPopup({
									   appendTo: '#AnticiposAplicacionCajaContent', 
		                               contentContainer: 'AnticiposAplicacionCajaM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtAnticipo_anticipos_aplicacion_caja').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_anticipos_aplicacion_caja').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_anticipos_aplicacion_caja();
			 //Hacer un llamado a la función para cargar los motivos de cancelación en el combobox del modal
            cargar_motivos_cancelacion_anticipos_aplicacion_caja();
             //Hacer un llamado a la función para cargar exportación en el combobox del modal
            cargar_exportacion_anticipos_aplicacion_caja();
		});
	</script>