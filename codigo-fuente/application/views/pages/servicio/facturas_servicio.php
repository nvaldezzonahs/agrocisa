	<div id="FacturasServicioServicioContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_facturas_servicio_servicio" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_facturas_servicio_servicio" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_facturas_servicio_servicio">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_facturas_servicio_servicio'>
				                    <input class="form-control" id="txtFechaInicialBusq_facturas_servicio_servicio"
				                    		name= "strFechaInicialBusq_facturas_servicio_servicio" 
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
								<label for="txtFechaFinalBusq_facturas_servicio_servicio">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_facturas_servicio_servicio'>
				                    <input class="form-control" id="txtFechaFinalBusq_facturas_servicio_servicio"
				                    		name= "strFechaFinalBusq_facturas_servicio_servicio" 
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
								<input id="txtProspectoIDBusq_facturas_servicio_servicio" 
									   name="intProspectoIDBusq_facturas_servicio_servicio"  type="hidden" 
									   value="">
								</input>
								<label for="txtRazonSocialBusq_facturas_servicio_servicio">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocialBusq_facturas_servicio_servicio" 
										name="strRazonSocialBusq_facturas_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_facturas_servicio_servicio">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_facturas_servicio_servicio" 
								 		name="strEstatusBusq_facturas_servicio_servicio" tabindex="1">
								    <option value="TODOS">TODOS</option>
                      				<option value="ACTIVO">ACTIVO</option>
                      				<option value="TIMBRAR">TIMBRAR</option>
                      				<option value="INACTIVO">INACTIVO</option>
                      				<option value="GENERAR POLIZA">GENERAR PÓLIZA</option>
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
								<label for="txtBusqueda_facturas_servicio_servicio">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_facturas_servicio_servicio" 
										name="strBusqueda_facturas_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_facturas_servicio_servicio" 
									   name="strImprimirDetalles_facturas_servicio_servicio" type="checkbox"
									   value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_facturas_servicio_servicio"
									onclick="paginacion_facturas_servicio_servicio();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_facturas_servicio_servicio" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_facturas_servicio_servicio"
									onclick="reporte_facturas_servicio_servicio('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_facturas_servicio_servicio"
									onclick="reporte_facturas_servicio_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla facturas
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Razón social"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "RFC"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla CFDI a relacionar
				*/
				td.movil.b1:nth-of-type(1):before {content: "Referencia"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Razón social"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Folio"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Fecha"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Módulo"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "UUID"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "Importe"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "Seleccionar"; font-weight: bold;}

				/*
				Definir columnas de la tabla CFDI relacionados
				*/
				td.movil.c1:nth-of-type(1):before {content: "Razón social"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Folio"; font-weight: bold;}
				td.movil.c3:nth-of-type(3):before {content: "Fecha"; font-weight: bold;}
				td.movil.c4:nth-of-type(4):before {content: "Módulo"; font-weight: bold;}
				td.movil.c5:nth-of-type(5):before {content: "UUID"; font-weight: bold;}
				td.movil.c6:nth-of-type(6):before {content: "Importe"; font-weight: bold;}
				td.movil.c7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles de la factura
				*/
				td.movil.d1:nth-of-type(1):before {content: "Descripción"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "Precio"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "Desc."; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Subtotal"; font-weight: bold;}
				td.movil.d5:nth-of-type(5):before {content: "IVA"; font-weight: bold;}
				td.movil.d6:nth-of-type(6):before {content: "IEPS"; font-weight: bold;}
				td.movil.d7:nth-of-type(7):before {content: "Total"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles de la factura
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Desc."; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: "Subtotal"; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "IVA"; font-weight: bold;}
				td.movil.t6:nth-of-type(6):before {content: "IEPS"; font-weight: bold;}
				td.movil.t7:nth-of-type(7):before {content: "Total"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_facturas_servicio_servicio">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Razón social</th>
							<th class="movil">RFC</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:13em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_facturas_servicio_servicio" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{razon_social}}</td>
							<td class="movil a4">{{rfc}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="td-center movil a6"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_facturas_servicio_servicio({{factura_servicio_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_facturas_servicio_servicio({{factura_servicio_id}},'Ver', {{cancelacion_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Ver motivo de cancelación-->
								<button class="btn btn-default btn-xs {{mostrarAccionMotivoCancelacion}}"  
										onclick="ver_cancelacion_facturas_servicio_servicio({{cancelacion_id}})"  title="Ver motivo de cancelación">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_cliente_facturas_servicio_servicio({{factura_servicio_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_facturas_servicio_servicio({{factura_servicio_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_facturas_servicio_servicio({{factura_servicio_id}}, '{{estatus}}', 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Timbrar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionTimbrar}}"  
										onclick="timbrar_facturas_servicio_servicio({{factura_servicio_id}},'','principal', {{regimen_fiscal_id}})"  title="Timbrar">
									<span class="fa fa-certificate"></span>
								</button>
								<!--Descargar archivos-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_facturas_servicio_servicio({{factura_servicio_id}}, '{{folio}}');" title="Descargar archivos">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>								
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_facturas_servicio_servicio({{factura_servicio_id}}, '{{folio}}', {{orden_reparacion_id}}, {{poliza_id}}, '{{folio_poliza}}');" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_facturas_servicio_servicio"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_facturas_servicio_servicio">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_facturas_servicio_servicio" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 


		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarFacturasServicioServicioBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cliente_facturas_servicio_servicio" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarFacturasServicioServicio" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarFacturasServicioServicio"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Cliente-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtFacturaServicioID_cliente_facturas_servicio_servicio" 
										   name="intFacturaServicioID_cliente_facturas_servicio_servicio" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el tipo de cambio del día-->
									<input id="txtTipoCambioVenta_facturas_servicio_servicio" 
										   name="intTipoCambioVenta_facturas_servicio_servicio" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el folio del registro seleccionado-->
									<input id="txtFolio_cliente_facturas_servicio_servicio" 
										   name="strFolio_cliente_facturas_servicio_servicio" 
										   type="hidden" value="">
									</input>	   
									<label for="txtRazonSocial_cliente_facturas_servicio_servicio">Razón social</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_cliente_facturas_servicio_servicio" 
											name="strRazonSocial_cliente_facturas_servicio_servicio" type="text" value="" 
											disabled />
								</div>
							</div>
						</div>
			 		</div>
			 		<div class="row">
			 			<!--Correo electrónico-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCorreoElectronico_cliente_facturas_servicio_servicio">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_cliente_facturas_servicio_servicio" 
											name="strCorreoElectronico_cliente_facturas_servicio_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50" />
								</div>
							</div>
						</div>
			 		</div>
			 		<div class="row">
			 			<!--Copia-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCopiaCorreoElectronico_cliente_facturas_servicio_servicio">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_cliente_facturas_servicio_servicio" 
											name="strCopiaCorreoElectronico_cliente_facturas_servicio_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50" />
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cliente_facturas_servicio_servicio" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_cliente_facturas_servicio_servicio"  
									onclick="validar_cliente_facturas_servicio_servicio();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cliente_facturas_servicio_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_cliente_facturas_servicio_servicio();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal Relacionar CFDI-->
		<div id="RelacionarCfdiFacturasServicioServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_cfdi_facturas_servicio_servicio" class="ModalBodyTitle">
				<h1>Relacionar CFDI</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarCfdiFacturasServicioServicio" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarCfdiFacturasServicioServicio"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha inicial-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicialBusq_relacionar_cfdi_facturas_servicio_servicio">Fecha inicial</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaInicialBusq_relacionar_cfdi_facturas_servicio_servicio'>
					                    <input class="form-control" id="txtFechaInicialBusq_relacionar_cfdi_facturas_servicio_servicio"
					                    		name= "strFechaInicialBusq_relacionar_cfdi_facturas_servicio_servicio" 
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
									<label for="txtFechaFinalBusq_relacionar_cfdi_facturas_servicio_servicio">Fecha final</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaFinalBusq_relacionar_cfdi_facturas_servicio_servicio'>
					                    <input class="form-control" id="txtFechaFinalBusq_relacionar_cfdi_facturas_servicio_servicio"
					                    		name= "strFechaFinalBusq_relacionar_cfdi_facturas_servicio_servicio" 
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
									<input id="txtProspectoIDBusq_relacionar_cfdi_facturas_servicio_servicio" 
										   name="intProspectoIDBusq_relacionar_cfdi_facturas_servicio_servicio"  type="hidden" 
										   value="">
									</input>
									<label for="txtRazonSocialBusq_relacionar_cfdi_facturas_servicio_servicio">Razón social</label>
								</div>
								<div class="col-md-12">
									<div class="input-group">
										<input class="form-control" id="txtRazonSocialBusq_relacionar_cfdi_facturas_servicio_servicio" 
											   name="strRazonSocialBusq_relacionar_cfdi_facturas_servicio_servicio"  type="text" value="" 
											   tabindex="1" placeholder="Ingrese razón social" maxlength="250" >
										</input>
										<span class="input-group-btn">
											<button class="btn btn-primary" id="btnBuscar_relacionar_cfdi_facturas_servicio_servicio"
													onclick="lista_facturas_relacionar_cfdi_facturas_servicio_servicio();" title="Buscar coincidencias" tabindex="1">
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
							<input id="txtNumCfdi_relacionar_cfdi_facturas_servicio_servicio" 
								   name="intNumCfdi_relacionar_cfdi_facturas_servicio_servicio" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_cfdi_facturas_servicio_servicio">
								<thead class="movil">
									<tr class="movil">
										<th class="movil">Razón social</th>
										<th class="movil">Folio</th>
										<th class="movil">Fecha</th>
										<th class="movil">Módulo</th>
										<th class="movil">UUID</th>
										<th class="movil">Importe</th>
										<th class="movil" id="th-acciones" style="width:8em;">Seleccionar</th>
									</tr>
								</thead>
								<tbody class="movil"></tbody>
								<script id="plantilla_relacionar_cfdi_facturas_servicio_servicio" type="text/template"> 
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
							    		id="chbAgregar_relacionar_cfdi_facturas_servicio_servicio" />
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
							<div class="row">
								<!--Número de registros encontrados-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<button class="btn btn-default btn-sm disabled pull-right">
										<strong id="numElementos_relacionar_cfdi_facturas_servicio_servicio">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar CFDI´s-->
							<button class="btn btn-success" id="btnAgregar_relacionar_cfdi_facturas_servicio_servicio"  
									onclick="validar_relacionar_cfdi_facturas_servicio_servicio();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_cfdi_facturas_servicio_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_cfdi_facturas_servicio_servicio();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar CFDI-->

		<!-- Diseño del modal Cancelación del timbrado-->
		<div id="CancelacionFacturasServicioServicioBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cancelacion_facturas_servicio_servicio" class="ModalBodyTitle confirmacion-modal-title">
			<h1>Cancelación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCancelacionFacturasServicioServicio" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmCancelacionFacturasServicioServicio"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Combobox que contiene los motivos de cancelación activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCancelacionMotivoID_cancelacion_facturas_servicio_servicio">Motivo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbCancelacionMotivoID_cancelacion_facturas_servicio_servicio" 
									 		name="intCancelacionMotivoID_facturas_servicio_servicio" 
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
									<input id="txtReferenciaCfdiID_cancelacion_facturas_servicio_servicio" 
										   name="intReferenciaCfdiID_cancelacion_facturas_servicio_servicio" 
										   type="hidden" value="" />	

									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_cancelacion_facturas_servicio_servicio" 
										   name="intPolizaID_cancelacion_facturas_servicio_servicio" type="hidden" value="" />
												   
									<!-- Caja de texto oculta para recuperar el id de la referencia (cotización/pedido/remisión) seleccionada-->
									<input id="txtReferenciaID_cancelacion_facturas_servicio_servicio" 
										   name="intReferenciaID_cancelacion_facturas_servicio_servicio"  type="hidden" 
										   value="" />

									<label for="txtFolio_cancelacion_facturas_servicio_servicio">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_cancelacion_facturas_servicio_servicio" 
											name="strFolio_cancelacion_facturas_servicio_servicio" type="text" value="" 
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
									<input id="txtSustitucionID_cancelacion_facturas_servicio_servicio" 
										   name="intSustitucionID_cancelacion_facturas_servicio_servicio" 
										   type="hidden" value="" />	
									<!-- Caja de texto oculta que se utiliza para recuperar el UUID de la factura que sustituye-->
									<input id="txtUuidSustitucion_cancelacion_facturas_servicio_servicio" 
										   name="strUuidSustitucion_cancelacion_facturas_servicio_servicio" 
										   type="hidden" value="" />	   
									<label for="txtFolioSustitucion_cancelacion_facturas_servicio_servicio">Sustitución</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolioSustitucion_cancelacion_facturas_servicio_servicio" 
											name="strFolioSustitucion_cancelacion_facturas_servicio_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese factura" maxlength="250" >
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Div que contiene los campos del usuario y fecha del registro -->
			 		<div  id="divDatosCreacion_cancelacion_facturas_servicio_servicio" class="row no-mostrar">
			 			<!--Usuario que realizó la cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuarioCreacion_cancelacion_facturas_servicio_servicio">Usuario de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuarioCreacion_cancelacion_facturas_servicio_servicio" 
											name="strUsuarioCreacion_cancelacion_facturas_servicio_servicio" type="text" value="" 
											 disabled >
									</input>
								</div>
							</div>
						</div>
						<!--Fecha de cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaCreacion_cancelacion_facturas_servicio_servicio">Fecha de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFechaCreacion_cancelacion_facturas_servicio_servicio" 
											name="strFechaCreacion_cancelacion_facturas_servicio_servicio" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cancelacion_facturas_servicio_servicio" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 						
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar cancelación del CFDI-->
							<button class="btn btn-success" id="btnGuardar_cancelacion_facturas_servicio_servicio"  
									onclick="validar_cancelacion_facturas_servicio_servicio();"  title="Cancelar CFDI" tabindex="1">
								<span class="fa fa-chain-broken"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cancelacion_facturas_servicio_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_cancelacion_facturas_servicio_servicio();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cancelación del timbrado-->

		<!-- Diseño del modal Facturas-->
		<div id="FacturasServicioServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_facturas_servicio_servicio"  class="ModalBodyTitle">
			<h1>Facturación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_facturas_servicio_servicio" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_facturas_servicio_servicio" class="active">
									<a data-toggle="tab" href="#informacion_general_facturas_servicio_servicio">Información General</a>
								</li>
								<!--Tab que contiene la información de los CFDI relacionados-->
								<li id="tabCfdiRelacionados_facturas_servicio_servicio">
									<a data-toggle="tab" href="#cfdi_relacionados_facturas_servicio_servicio">CFDI Relacionados</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmFacturasServicioServicio" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmFacturasServicioServicio"  onsubmit="return(false)" 
					  autocomplete="off">
					  	<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
						<div class="tab-content">
							<!--Tab - Información General-->
							<div id="informacion_general_facturas_servicio_servicio" class="tab-pane fade in active">
								<div class="row">
									<!--Folio-->
									<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
												<input id="txtFacturaServicioID_facturas_servicio_servicio" 
													   name="intFacturaServicioID_facturas_servicio_servicio" type="hidden" value="" />
												<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
												<input id="txtEstatus_facturas_servicio_servicio" 
													   name="strEstatus_facturas_servicio_servicio" type="hidden" value="" />
												<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
												<input id="txtPolizaID_facturas_servicio_servicio" 
													   name="intPolizaID_facturas_servicio_servicio" type="hidden" value="" />
												 <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
												<input id="txtFolioPoliza_facturas_servicio_servicio" 
													   name="strFolioPoliza_facturas_servicio_servicio" type="hidden" value="" />
												 <!-- Caja de texto oculta que se utiliza para recuperar el id de la clave de autorización del registro seleccionado-->
												<input id="txtClaveAutorizacionID_facturas_servicio_servicio" 
												   name="intClaveAutorizacionID_facturas_servicio_servicio" type="hidden" value="" />

												<!-- Caja de texto oculta que se utiliza para recuperar el id de la cancelación del registro seleccionado-->
												<input id="txtCancelacionID_facturas_servicio_servicio" 
												   name="intCancelacionID_facturas_servicio_servicio" type="hidden" value="" />	   
												<label for="txtFolio_facturas_servicio_servicio">Folio</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" id="txtFolio_facturas_servicio_servicio" 
														name="strFolio_facturas_servicio_servicio" type="text" 
														value="" placeholder="Autogenerado" disabled />
											</div>
										</div>
									</div>
									<!--Fecha-->
									<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="txtFecha_facturas_servicio_servicio">Fecha</label>
											</div>
											<div id="divFechaMsjValidacion" class="col-md-12">
												<div class='input-group date' id='dteFecha_facturas_servicio_servicio'>
								                    <input class="form-control" id="txtFecha_facturas_servicio_servicio"
								                    		name= "strFecha_facturas_servicio_servicio" 
								                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
								                    <span class="input-group-addon">
								                        <span class="glyphicon glyphicon-calendar"></span>
								                    </span>
								                </div>
											</div>
										</div>
									</div>
									<!--Combobox que contiene las monedas activas-->
									<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="cmbMonedaID_facturas_servicio_servicio">Moneda</label>
											</div>
											<div id="divCmbMsjValidacion" class="col-md-12">
												<select class="form-control" id="cmbMonedaID_facturas_servicio_servicio" 
												 		name="intMonedaID_facturas_servicio_servicio" tabindex="1">
			                     				</select>
											</div>
										</div>
									</div>
									<!--Tipo de cambio-->
									<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="txtTipoCambio_facturas_servicio_servicio">Tipo de cambio</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control tipo-cambio" id="txtTipoCambio_facturas_servicio_servicio" 
														name="intTipoCambio_facturas_servicio_servicio" type="text" value="" disabled />
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<!--Autocomplete que contiene las ordenes terminadas autorizados-->
									<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<!-- Caja de texto oculta para recuperar el id de la orden de reparación seleccionada-->
												<input id="txtOrdenReparacionID_facturas_servicio_servicio" 
													   name="intOrdenReparacionID_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<label for="txtOrdenReparacion_facturas_servicio_servicio">
													No. de orden
												</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" 
														id="txtOrdenReparacion_facturas_servicio_servicio" 
														name="strOrdenReparacion_facturas_servicio_servicio" 
														type="text" 
														value=""  
														tabindex="1" 
														placeholder="Ingrese orden" 
														maxlength="250" />
											</div>
										</div>
									</div>
									<!--Condiciones de pago-->
									<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="cmbCondicionesPago_facturas_servicio_servicio">Tipo de venta</label>
											</div>
											<div id="divCmbMsjValidacion" class="col-md-12">
												<select class="form-control" id="cmbCondicionesPago_facturas_servicio_servicio" 
												 		name="strCondicionesPago_facturas_servicio_servicio" tabindex="1">
												    <option value="">Seleccione una opción</option>
												    <option value="CREDITO">CREDITO</option>
				                      				<option value="CONTADO">CONTADO</option>
				                 				</select>
											</div>
										</div>
									</div>
									<!--Autocomplete que contiene las estrategias activas-->
									<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<!-- Caja de texto oculta para recuperar el id de la estrategia seleccionada-->
												<input id="txtEstrategiaID_facturas_servicio_servicio" 
													   name="intEstrategiaID_facturas_servicio_servicio" 
													   type="hidden" value="">
												</input>
												<label for="txtEstrategia_facturas_servicio_servicio">
													Estrategia
												</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" id="txtEstrategia_facturas_servicio_servicio" 
														name="strEstrategia_facturas_servicio_servicio" type="text" value=""  placeholder="Ingrese estrategia" maxlength="250">
												</input>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<!--Cliente-->
									<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<!-- Caja de texto oculta para asignar la fecha de vencimiento-->
												<input id="txtFechaVencimiento_facturas_servicio_servicio" 
													   name="strFechaVencimiento_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<!-- Caja de texto oculta para recuperar el id del cliente-->
												<input id="txtProspectoID_facturas_servicio_servicio" 
													   name="intProspectoID_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<!-- Caja de texto oculta para recuperar el id del régimen fiscal del cliente seleccionado-->
												<input id="txtRegimenFiscalID_facturas_servicio_servicio" 
													   name="intRegimenFiscalID_facturas_servicio_servicio" 
													   type="hidden" value="">
												</input>
												<!-- Caja de texto oculta para recuperar la calle del cliente-->
												<input id="txtCalle_facturas_servicio_servicio" 
													   name="strCalle_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<!-- Caja de texto oculta para recuperar el número exterior del cliente-->
												<input id="txtNumeroExterior_facturas_servicio_servicio" 
													   name="strNumeroExterior_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<!-- Caja de texto oculta para recuperar el número interior del cliente -->
												<input id="txtNumeroInterior_facturas_servicio_servicio" 
													   name="strNumeroInterior_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<!-- Caja de texto oculta para recuperar el código postal del cliente -->
												<input id="txtCodigoPostal_facturas_servicio_servicio" 
													   name="strCodigoPostal_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<!-- Caja de texto oculta para recuperar la colonia del cliente -->
												<input id="txtColonia_facturas_servicio_servicio" 
													   name="strColonia_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<!-- Caja de texto oculta para recuperar la localidad del cliente -->
												<input id="txtLocalidad_facturas_servicio_servicio" 
													   name="strLocalidad_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<!-- Caja de texto oculta para recuperar el municipio del cliente -->
												<input id="txtMunicipio_facturas_servicio_servicio" 
													   name="strMunicipio_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<!-- Caja de texto oculta para recuperar el estado del cliente -->
												<input id="txtEstado_facturas_servicio_servicio" 
													   name="strEstado_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<!-- Caja de texto oculta para recuperar el país del cliente-->
												<input id="txtPais_facturas_servicio_servicio" 
													   name="strPais_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<!-- Caja de texto oculta para recuperar el subtotal desglosado con base al importe capturado-->
												<input id="txtGastosServicio_facturas_servicio_servicio" 
													   name="intGastosServicio_facturas_servicio_servicio" 
													   type="hidden" value="">
												</input>
												<!-- Caja de texto oculta para recuperar el IVA desglosado con base al importe capturado-->
												<input id="txtGastosServicioIva_facturas_servicio_servicio" 
													   name="intGastosServicioIva_facturas_servicio_servicio" 
													   type="hidden" value="">
												</input>
												<!-- Caja de texto oculta para recuperar los días de crédito del cliente -->
												<input id="txtServicioCreditoDias_facturas_servicio_servicio" 
													   name="intServicioCreditoDias_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<label for="txtRazonSocial_facturas_servicio_servicio">
													Razón social
												</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" 
														id="txtRazonSocial_facturas_servicio_servicio" 
														name="strRazonSocial_facturas_servicio_servicio" 
														type="text" value="" disabled />
											</div>
										</div>
									</div>
									<!--RFC-->
									<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="txtRfc_facturas_servicio_servicio">RFC</label>
											</div>
											<div class="col-md-12">
												<input class="form-control" id="txtRfc_facturas_servicio_servicio"
													   name="strRfc_facturas_servicio_servicio" 
													   type="text" value="" disabled />
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
												<input id="txtFormaPagoID_facturas_servicio_servicio" 
													   name="intFormaPagoID_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<label for="txtFormaPago_facturas_servicio_servicio">
													Forma de pago
												</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" id="txtFormaPago_facturas_servicio_servicio" 
														name="strFormaPago_facturas_servicio_servicio" type="text" value=""  
														tabindex="1" placeholder="Ingrese forma de pago" maxlength="250" />
											</div>
										</div>
									</div>
									<!--Autocomplete que contiene los métodos de pago activos-->
									<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<!-- Caja de texto oculta para recuperar el id del método de pago seleccionado-->
												<input id="txtMetodoPagoID_facturas_servicio_servicio" 
													   name="intMetodoPagoID_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<label for="txtMetodoPago_facturas_servicio_servicio">
													Método de pago
												</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" id="txtMetodoPago_facturas_servicio_servicio" 
														name="strMetodoPago_facturas_servicio_servicio" type="text" value=""  
														tabindex="1" placeholder="Ingrese método de pago" maxlength="250" />
											</div>
										</div>
									</div>
									<!--Combobox que contiene la exportación activa-->
									<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="cmbExportacionID_facturas_servicio_servicio">Exportación</label>
											</div>
											<div id="divCmbMsjValidacion" class="col-md-12">
												<select class="form-control" id="cmbExportacionID_facturas_servicio_servicio"
												        name="intExportacionID_facturas_servicio_servicio" tabindex="1">
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
												<input id="txtUsoCfdiID_facturas_servicio_servicio" 
													   name="intUsoCfdiID_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<label for="txtUsoCfdi_facturas_servicio_servicio">
													Uso del CFDI
												</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" id="txtUsoCfdi_facturas_servicio_servicio" 
														name="strUsoCfdi_facturas_servicio_servicio" type="text" value=""  
														tabindex="1" placeholder="Ingrese uso del CFDI" maxlength="250" />
											</div>
										</div>
									</div>
									<!--Autocomplete que contiene los tipos de relación activos-->
									<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<!-- Caja de texto oculta para recuperar el id del tipo de relación seleccionado-->
												<input id="txtTipoRelacionID_facturas_servicio_servicio" 
													   name="intTipoRelacionID_facturas_servicio_servicio" 
													   type="hidden" value="" />
												<label for="txtTipoRelacion_facturas_servicio_servicio">
													Tipo de relación
												</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" id="txtTipoRelacion_facturas_servicio_servicio" 
														name="strTipoRelacion_facturas_servicio_servicio" type="text" value=""  
														tabindex="1" placeholder="Ingrese tipo de relación" maxlength="250" />
											</div>
										</div>
									</div>
								</div>
								<div class="row">
							    	<!--Observaciones-->
									<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="txtObservaciones_facturas_servicio_servicio">Observaciones</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" id="txtObservaciones_facturas_servicio_servicio" 
														name="strObservaciones_facturas_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250" />
											</div>
										</div>
									</div>
							    	<!--Notas-->
									<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<label for="txtNotas_facturas_servicio_servicio">Notas</label>
											</div>
											<div class="col-md-12">
												<input  class="form-control" id="txtNotas_facturas_servicio_servicio" 
														name="strNotas_facturas_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese notas" maxlength="250" />
											</div>
										</div>
									</div>
							    </div>
							    <div class="row">
									<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
										<div class="form-group">
											<div class="col-md-12">
												<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles-->
												<input id="txtNumDetalles_facturas_servicio_servicio" 
													   name="intNumDetalles_facturas_servicio_servicio" type="hidden" value="">
												</input>
												<div class="panel panel-default">
													<div class="panel-heading">
														<h4 class="panel-title">Detalles de la factura</h4>
													</div>
													<div class="panel-body">
														<div class="row">
															<!--Div que contiene la tabla con los detalles encontrados-->
															<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																<div class="row">
																	<!-- Diseño de la tabla-->
																	<table class="table-hover movil" id="dg_detalles_facturas_servicio_servicio">
																		<thead class="movil">
																			<tr class="movil">
																				<th class="movil">Descripción</th>
																				<th class="movil">Precio</th>
																				<th class="movil">Descuento</th>
																				<th class="movil">Subtotal</th>
																				<th class="movil">IVA</th>
																				<th class="movil">IEPS</th>
																				<th class="movil">Total</th>
																			</tr>
																		</thead>
																		<tbody class="movil"></tbody>
																		<tfoot class="movil">
																			<tr class="movil">
																				<td class="movil t1">
																					<strong>Total</strong>
																				</td>
																				<td class="movil t2"></td>
																				<td class="movil t3">
																					<strong id="acumDescuento_detalles_facturas_servicio_servicio"></strong>
																				</td>
																				<td class="movil t4">
																					<strong id="acumSubtotal_detalles_facturas_servicio_servicio"></strong>
																				</td>
																				<td class="movil t5">
																					<strong id="acumIva_detalles_facturas_servicio_servicio"></strong>
																				</td>
																				<td class="movil t6">
																					<strong  id="acumIeps_detalles_facturas_servicio_servicio"></strong>
																				</td>
																				<td class="movil t7">
																					<strong id="acumTotal_detalles_facturas_servicio_servicio"></strong>
																				</td>
																			</tr>
																		</tfoot>
																	</table>
																	<br>
																	<div class="row">
																		<!--Número de registros encontrados-->
																		<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																			<button class="btn btn-default btn-sm disabled pull-right">
																				<strong id="numElementos_detalles_facturas_servicio_servicio">0</strong> encontrados
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
								</div>
							</div><!--Cierre del contenido del tab - Información General-->
							<!--Tab - CFDI relacionados-->
							<div id="cfdi_relacionados_facturas_servicio_servicio" class="tab-pane fade">
								<div class="row">
									<!--Botones-->
									<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
										<div class="btn-group pull-right">
											<!--Buscar CFDI a relacionar para agregarlos en la tabla-->
											<button class="btn btn-primary" 
			                                			id="btnBuscarCFDI_facturas_servicio_servicio" 
			                                			onclick="abrir_relacionar_cfdi_facturas_servicio_servicio();" 
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
										<!-- Caja de texto oculta para asignar el número de registros de la tabla CFDI a relacionar--> 
										<input id="txtNumCfdiRelacionados_facturas_servicio_servicio" 
											   name="intNumCfdiRelacionados_facturas_servicio_servicio" type="hidden" value="" />
										<!-- Diseño de la tabla-->
										<table class="table-hover movil" id="dg_cfdi_relacionados_facturas_servicio_servicio">
											<thead class="movil">
												<tr class="movil">
													<th class="movil">Razón social</th>
													<th class="movil">Folio</th>
													<th class="movil">Fecha</th>
													<th class="movil">Módulo</th>
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
													<strong id="numElementos_cfdi_relacionados_facturas_servicio_servicio">0</strong> encontrados
												</button>
											</div>
										</div>
									</div>
								</div>
							</div><!--Cierre del contenido del tab - CFDI relacionados-->
						</div><!--Cierre del contenedor de tabs-->	
	                  	<!--Circulo de progreso-->
						<div id="divCirculoBarProgreso_facturas_servicio_servicio" class="load-container load5 circulo_bar no-mostrar">
							<div class="loader">Loading...</div>
							<br><br>
							<div align=center><b>Espere un momento por favor.</b></div>
						</div> 
						<!--Botones de acción (barra de tareas)-->
						<div class="btn-group row footerModal">
							<div class="col-md-12">
								<!--Nuevo registro-->
								<button class="btn btn-info" id="btnReiniciar_facturas_servicio_servicio"  
										onclick="nuevo_facturas_servicio_servicio('Nuevo');"  title="Nuevo registro" tabindex="2">
									<span class="glyphicon glyphicon-list-alt"></span>
								</button>
								<!--Guardar registro-->
								<button class="btn btn-success" id="btnGuardar_facturas_servicio_servicio"  
										onclick="validar_facturas_servicio_servicio();"  title="Guardar" tabindex="3" disabled>
									<span class="fa fa-floppy-o"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default" id="btnEnviarCorreo_facturas_servicio_servicio"  
										onclick="abrir_cliente_facturas_servicio_servicio('');"  
										title="Enviar correo electrónico" tabindex="4" disabled>
									<span class="glyphicon glyphicon-envelope"></span>
								</button> 
								<!--Ver motivo de cancelación del registro-->
								<button class="btn btn-default" id="btnVerMotivoCancelacion_facturas_servicio_servicio"  
										onclick="ver_cancelacion_facturas_servicio_servicio('');"  title="Ver motivo de cancelación" tabindex="5">
									<i class="fa fa-info-circle" aria-hidden="true"></i>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default" id="btnImprimirRegistro_facturas_servicio_servicio"  
										onclick="reporte_registro_facturas_servicio_servicio('');"  title="Imprimir registro en PDF" tabindex="6" disabled>
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Descargar archivos-->
			                    <button class="btn btn-default" id="btnDescargarArchivo_facturas_servicio_servicio"  
										onclick="descargar_archivos_facturas_servicio_servicio('','');"  title="Descargar archivos" tabindex="7" disabled>
									<span class="glyphicon glyphicon-download-alt"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default" id="btnDesactivar_facturas_servicio_servicio"  
										onclick="cambiar_estatus_facturas_servicio_servicio('','', '', '', '');"  title="Desactivar" tabindex="8" disabled>
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Cerrar modal-->
								<button class="btn  btn-cerrar"  id="btnCerrar_facturas_servicio_servicio"
										type="reset" aria-hidden="true" onclick="cerrar_facturas_servicio_servicio();" 
										title="Cerrar"  tabindex="9">
									<span class="fa fa-times"></span>
								</button>
							</div>
						</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Facturas-->
	</div><!--#FacturasServicioServicioContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_facturas_servicio_servicio" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>


	<!-- /.Plantilla para cargar los motivo de cancelación en el combobox-->  
	<script id="cancelacion_motivos_facturas_servicio_servicio" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#motivos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/motivos}} 
	</script>

	<!-- /.Plantilla para cargar la exportación en el combobox-->  
	<script id="exportacion_facturas_servicio_servicio" type="text/template">
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
		var intPaginaFacturasServicioServicio = 0;
		var strUltimaBusquedaFacturasServicioServicio = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar en el timbrado y cfdi's relacionados)*/
		var strTipoReferenciaFacturasServicioServicio = "FACTURA SERVICIO";
		//Variable que se utiliza para asignar el id del módulo de maquinaria
		var intModuloIDFacturasServicioServicio = <?php echo MODULO_SERVICIO ?>;
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDFacturasServicioServicio = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el id de la exportación base
		var intExportacionBaseIDFacturasServicioServicio = <?php echo EXPORTACION_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseFacturasServicioServicio = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el id del motivo de cancelación: Comprobante emitido con errores con relación.
		var intCancelacionIDRelacionCfdiFacturasServicioServicio = <?php echo MOTIVO_CANCELACION_RELACIONCFDI ?>;
		//Variable que se utiliza para asignar el mensaje de régimen fiscal faltante.
		var strMsjRegimenFiscalCteFacturasServicioServicio = "<?php echo MSJ_ERROR_REGIMEN_FISCAL ?>";

		//Variable que se utiliza para asignar objeto del modal Cancelación del timbrado
		var objCancelacionFacturasServicioServicio = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarFacturasServicioServicio = null;
		//Variable que se utiliza para asignar objeto del modal Relacionar CFDI
		var objRelacionarCfdiFacturasServicioServicio = null;
		//Variable que se utiliza para asignar objeto del modal Facturación
		var objFacturasServicioServicio = null;

		//Array que contiene los id´s de las cajas de texto que se utilizan para calcular la fecha de vencimiento
		var arrFechaVencimientoFacturasServicioServicio  = {fecha: '#txtFecha_facturas_servicio_servicio',
															 condicionesPago:  '#cmbCondicionesPago_facturas_servicio_servicio',
															 diasCredito: 	'#txtServicioCreditoDias_facturas_servicio_servicio',
															 fechaVencimiento: 	'#txtFechaVencimiento_facturas_servicio_servicio'
															};



		/*******************************************************************************************************************
		Funciones del objeto Detalles
		*********************************************************************************************************************/
		/*Constructor del objeto Detalles (contiene detalles de la orden de reparación o de la factura (mismos que se consultan una sola vez) como: servicios de mano de obra, refacciones, trabajos foráneos y otros servicios)*/
		var objDetallesFacturasServicioServicio;
		function DetallesFacturasServicioServicio(serviciosManoObra, refacciones, trabajosForaneos, otros)
		{
		    this.arrServiciosManoObra = serviciosManoObra;
		    this.arrRefacciones = refacciones;
		    this.arrTrabajosForaneos = trabajosForaneos;
		    this.arrOtros = otros;
		}

		//Función para agregar todos los servicios de mano de obra al objeto Detalles
		DetallesFacturasServicioServicio.prototype.setServicios = function(serviciosManoObra) {
		    this.arrServiciosManoObra = serviciosManoObra;
		}
		//Función para obtener todos los servicios de mano de obra del objeto Detalles
		DetallesFacturasServicioServicio.prototype.getServicios = function() {
		    return this.arrServiciosManoObra;
		}

		//Función para obtener un servicio del objeto 
		DetallesFacturasServicioServicio.prototype.getServicio = function(index) {
		    return this.arrServiciosManoObra[index];
		}


		//Función para agregar todas las refacciones al objeto Detalles
		DetallesFacturasServicioServicio.prototype.setRefacciones = function(refacciones) {
		    this.arrRefacciones = refacciones;
		}
		//Función para obtener todas las refacciones del objeto Detalles
		DetallesFacturasServicioServicio.prototype.getRefacciones = function() {
		    return this.arrRefacciones;
		}

		//Función para obtener una refacción del objeto 
		DetallesFacturasServicioServicio.prototype.getRefaccion = function(index) {
		    return this.arrRefacciones[index];
		}


		//Función para agregar todos los trabajos foráneos al objeto Detalles
		DetallesFacturasServicioServicio.prototype.setTrabajosForaneos = function(trabajosForaneos) {
		    this.arrTrabajosForaneos = trabajosForaneos;
		}
		//Función para obtener todos los trabajos foráneos del objeto Detalles
		DetallesFacturasServicioServicio.prototype.getTrabajosForaneos = function() {
		    return this.arrTrabajosForaneos;
		}

		//Función para obtener un trabajo foráneo del objeto 
		DetallesFacturasServicioServicio.prototype.getTrabajoForaneo = function(index) {
		    return this.arrTrabajosForaneos[index];
		}

		//Función para agregar otros servicios al objeto Detalles
		DetallesFacturasServicioServicio.prototype.setOtros = function(otros) {
		    this.arrOtros = otros;
		}
		//Función para obtener otros servicios del objeto Detalles
		DetallesFacturasServicioServicio.prototype.getOtros = function() {
		    return this.arrOtros;
		}

		//Función para obtener un servicio del objeto 
		DetallesFacturasServicioServicio.prototype.getOtro = function(index) {
		    return this.arrOtros[index];
		}



		/*******************************************************************************************************************
		Funciones del objeto servicios de mano de obra de la factura
		*********************************************************************************************************************/
		// Constructor del objeto servicios de mano de obra de la factura
		var objServiciosManoObraFacturasServicioServicio;
		function ServiciosManoObraFacturasServicioServicio(servicios)
		{
			this.arrServicios = servicios;
		}

		//Función para agregar un servicio al objeto 
		ServiciosManoObraFacturasServicioServicio.prototype.setServicio = function (servicio){
			this.arrServicios.push(servicio);
		}


		/*******************************************************************************************************************
		Funciones del objeto Servicio de mano de obra de la factura
		*********************************************************************************************************************/
		//Constructor del objeto servicio
		var objServicioManoObraFacturasServicioServicio;
		function ServicioManoObraFacturasServicioServicio(servicioID, codigo, descripcion, codigoSat, 
														  unidadSat, objetoImpuestoSat, precioUnitario, descuentoUnitario, 
														  tasaCuotaIva, ivaUnitario, tasaCuotaIeps, 
														  iepsUnitario)
		{
			this.intServicioID = servicioID;
			this.strCodigo = codigo;
			this.strDescripcion = descripcion;
			this.strCodigoSat = codigoSat;
			this.strUnidadSat = unidadSat;
			this.strObjetoImpuestoSat = objetoImpuestoSat;
			this.intPrecioUnitario = precioUnitario;
			this.intDescuentoUnitario = descuentoUnitario;
			this.intTasaCuotaIva = tasaCuotaIva;
			this.intIvaUnitario = ivaUnitario;
			this.intTasaCuotaIeps = tasaCuotaIeps;
			this.intIepsUnitario = iepsUnitario;
		}


		/*******************************************************************************************************************
		Funciones del objeto refacciones de la factura
		*********************************************************************************************************************/
		// Constructor del objeto refacciones de la factura
		var objRefaccionesFacturasServicioServicio;
		function RefaccionesFacturasServicioServicio(refacciones)
		{
			this.arrRefacciones = refacciones;
		}

	
		//Función para agregar una refacción al objeto 
		RefaccionesFacturasServicioServicio.prototype.setRefaccion = function (refaccion){
			this.arrRefacciones.push(refaccion);
		}

		

		/*******************************************************************************************************************
		Funciones del objeto Refacción de la factura
		*********************************************************************************************************************/
		//Constructor del objeto refacción
		var objRefaccionFacturasServicioServicio;
		function RefaccionFacturasServicioServicio(refaccionID, codigo, descripcion, codigoLinea, 
												   codigoSat, unidadSat, objetoImpuestoSat, cantidad, precioUnitario, descuentoUnitario, 
												   tasaCuotaIva, ivaUnitario, tasaCuotaIeps, iepsUnitario)
		{
			this.intRefaccionID = refaccionID;
			this.strCodigo = codigo;
			this.strDescripcion = descripcion;
			this.strCodigoLinea = codigoLinea;
			this.strCodigoSat = codigoSat;
			this.strUnidadSat = unidadSat;
			this.strObjetoImpuestoSat = objetoImpuestoSat;
			this.intCantidad = cantidad;
			this.intPrecioUnitario = precioUnitario;
			this.intDescuentoUnitario = descuentoUnitario;
			this.intTasaCuotaIva = tasaCuotaIva;
			this.intIvaUnitario = ivaUnitario;
			this.intTasaCuotaIeps = tasaCuotaIeps;
			this.intIepsUnitario = iepsUnitario;
		
		}


		/*******************************************************************************************************************
		Funciones del objeto Trabajos Foráneos de la factura
		*********************************************************************************************************************/
		// Constructor del objeto trabajos foráneos de la factura
		var objTrabajosForaneosFacturasServicioServicio;
		function TrabajosForaneosFacturasServicioServicio(trabajosForaneos)
		{
			this.arrTrabajosForaneos = trabajosForaneos;
		}

		//Función para agregar un trabajo foráneo al objeto 
		TrabajosForaneosFacturasServicioServicio.prototype.setTrabajoForaneo = function (trabajoForaneo){
			this.arrTrabajosForaneos.push(trabajoForaneo);
		}

		

		/*******************************************************************************************************************
		Funciones del objeto Trabajo foráneo de la factura
		*********************************************************************************************************************/
		//Constructor del objeto trabajo foráneo
		var objTrabajoForaneoFacturasServicioServicio;
		function TrabajoForaneoFacturasServicioServicio(concepto, codigoSat, unidadSat, objetoImpuestoSat, cantidad,
														precioUnitario, descuentoUnitario, tasaCuotaIva, 
														ivaUnitario, tasaCuotaIeps, iepsUnitario)
		{
			this.strConcepto = concepto;
			this.strCodigoSat = codigoSat;
			this.strUnidadSat = unidadSat;
			this.strObjetoImpuestoSat = objetoImpuestoSat;
			this.intPrecioUnitario = precioUnitario;
			this.intDescuentoUnitario = descuentoUnitario;
			this.intTasaCuotaIva = tasaCuotaIva;
			this.intIvaUnitario = ivaUnitario;
			this.intTasaCuotaIeps = tasaCuotaIeps;
			this.intIepsUnitario = iepsUnitario;
		}


		/*******************************************************************************************************************
		Funciones del objeto Otros servicios de la factura
		*********************************************************************************************************************/
		// Constructor del objeto otros servicios de la factura
		var objOtrosFacturasServicioServicio;
		function OtrosFacturasServicioServicio(otros)
		{
			this.arrOtros = otros;
		}

		//Función para agregar un trabajo foráneo al objeto 
		OtrosFacturasServicioServicio.prototype.setOtro = function (otro){
			this.arrOtros.push(otro);
		}

		

		/*******************************************************************************************************************
		Funciones del objeto Otro servicio de la factura
		*********************************************************************************************************************/
		//Constructor del objeto otro servicio
		var objOtroFacturasServicioServicio;
		function OtroFacturasServicioServicio(concepto, codigoSat, unidadSat, objetoImpuestoSat, cantidad,
										      precioUnitario, descuentoUnitario, tasaCuotaIva, 
											 ivaUnitario, tasaCuotaIeps, iepsUnitario)
		{
			this.strConcepto = concepto;
			this.strCodigoSat = codigoSat;
			this.strUnidadSat = unidadSat;
			this.strObjetoImpuestoSat = objetoImpuestoSat;
			this.intPrecioUnitario = precioUnitario;
			this.intDescuentoUnitario = descuentoUnitario;
			this.intTasaCuotaIva = tasaCuotaIva;
			this.intIvaUnitario = ivaUnitario;
			this.intTasaCuotaIeps = tasaCuotaIeps;
			this.intIepsUnitario = iepsUnitario;
		}


		/*******************************************************************************************************************
		Funciones del objeto CFDI's  relacionados (facturas seleccionadas)
		*********************************************************************************************************************/
		// Constructor del objeto CFDI's relacionados (facturas seleccionadas)
		var objCfdisRelacionadosFacturasServicioServicio;
		function CfdisRelacionadosFacturasServicioServicio(cfdis)
		{
			this.arrCfdis = cfdis;
		}

		//Función para obtener todos los cfdi´s seleccionados
		CfdisRelacionadosFacturasServicioServicio.prototype.getCfdis = function() {
		    return this.arrCfdis;
		}

		//Función para agregar un cfdi al objeto 
		CfdisRelacionadosFacturasServicioServicio.prototype.setCfdi = function (cfdi){
			this.arrCfdis.push(cfdi);
		}

		//Función para obtener un cfdi del objeto 
		CfdisRelacionadosFacturasServicioServicio.prototype.getCfdi = function(index) {
		    return this.arrCfdis[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto CFDI a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto CFDI a relacionar
		var objCfdiRelacionarFacturasServicioServicio;
		
		function CfdiRelacionarFacturasServicioServicio(referenciaID, cliente, folio, fecha, tipoReferencia, uuid, importe)
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
		function permisos_facturas_servicio_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/facturas_servicio/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_facturas_servicio_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosFacturasServicioServicio = data.row;
					//Separar la cadena 
					var arrPermisosFacturasServicioServicio = strPermisosFacturasServicioServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosFacturasServicioServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosFacturasServicioServicio[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_facturas_servicio_servicio').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosFacturasServicioServicio[i]=='GUARDAR') || (arrPermisosFacturasServicioServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_facturas_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosFacturasServicioServicio[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_facturas_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosFacturasServicioServicio[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_facturas_servicio_servicio').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_facturas_servicio_servicio();
						}
						else if(arrPermisosFacturasServicioServicio[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_facturas_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosFacturasServicioServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_facturas_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosFacturasServicioServicio[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_facturas_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosFacturasServicioServicio[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_facturas_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosFacturasServicioServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_facturas_servicio_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_facturas_servicio_servicio() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaFacturasServicioServicio =($('#txtFechaInicialBusq_facturas_servicio_servicio').val()+$('#txtFechaFinalBusq_facturas_servicio_servicio').val()+$('#txtProspectoIDBusq_facturas_servicio_servicio').val()+$('#cmbEstatusBusq_facturas_servicio_servicio').val()+$('#txtBusqueda_facturas_servicio_servicio').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaFacturasServicioServicio != strUltimaBusquedaFacturasServicioServicio)
			{
				intPaginaFacturasServicioServicio = 0;
				strUltimaBusquedaFacturasServicioServicio = strNuevaBusquedaFacturasServicioServicio;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/facturas_servicio/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_facturas_servicio_servicio').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_facturas_servicio_servicio').val()),
					 intProspectoID: $('#txtProspectoIDBusq_facturas_servicio_servicio').val(),
					 strEstatus: $('#cmbEstatusBusq_facturas_servicio_servicio').val(),
					 strBusqueda: $('#txtBusqueda_facturas_servicio_servicio').val(),
					 intPagina: intPaginaFacturasServicioServicio,
					 strPermisosAcceso: $('#txtAcciones_facturas_servicio_servicio').val()
					},
					function(data){
						$('#dg_facturas_servicio_servicio tbody').empty();
						var tmpFacturasServicioServicio = Mustache.render($('#plantilla_facturas_servicio_servicio').html(),data);
						$('#dg_facturas_servicio_servicio tbody').html(tmpFacturasServicioServicio);
						$('#pagLinks_facturas_servicio_servicio').html(data.paginacion);
						$('#numElementos_facturas_servicio_servicio').html(data.total_rows);
						intPaginaFacturasServicioServicio = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_facturas_servicio_servicio(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/facturas_servicio/';

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
			if ($('#chbImprimirDetalles_facturas_servicio_servicio').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_facturas_servicio_servicio').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_facturas_servicio_servicio').val('NO');
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_facturas_servicio_servicio').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_facturas_servicio_servicio').val()),
										'intProspectoID': $('#txtProspectoIDBusq_facturas_servicio_servicio').val(),
										'strEstatus': $('#cmbEstatusBusq_facturas_servicio_servicio').val(), 
										'strBusqueda': $('#txtBusqueda_facturas_servicio_servicio').val(),
										'strDetalles': $('#chbImprimirDetalles_facturas_servicio_servicio').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_facturas_servicio_servicio(id) 
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaServicioID_facturas_servicio_servicio').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url':  'contabilidad/timbradoV4/get_pdf_facturas',
							'data' : {
										'intReferenciaID':intID,
										'strTipoReferencia':strTipoReferenciaFacturasServicioServicio,
										'strTimbrar': 'NO'		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);	
		}

	
		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_facturas_servicio_servicio(facturaServicioID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(facturaServicioID == '')
			{
				intID = $('#txtFacturaServicioID_facturas_servicio_servicio').val();
				strFolio = $('#txtFolio_facturas_servicio_servicio').val();
			}
			else
			{
				intID = facturaServicioID;
				strFolio = folio;
			}


			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'contabilidad/timbradoV4/descargar_archivos',
							'data' : {
										'intReferenciaID': intID,
										'strTipoReferencia': strTipoReferenciaFacturasServicioServicio,
										'strFolio':strFolio		
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_facturas_servicio_servicio()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_facturas_servicio_servicio').empty();
					var temp = Mustache.render($('#monedas_facturas_servicio_servicio').html(), data);
					$('#cmbMonedaID_facturas_servicio_servicio').html(temp);
				},
				'json');
		}

		//Regresar exportación activa para cargarlas en el combobox
		function cargar_exportacion_facturas_servicio_servicio()
		{
			//Hacer un llamado al método del controlador para regresar la exportación que se encuentra activa
			$.post('contabilidad/sat_exportacion/get_combo_box', {},
				function(data)
				{
					$('#cmbExportacionID_facturas_servicio_servicio').empty();
					var temp = Mustache.render($('#exportacion_facturas_servicio_servicio').html(), data);
					$('#cmbExportacionID_facturas_servicio_servicio').html(temp);
				},
				'json');
		}



		/*******************************************************************************************************************
		Funciones del modal Cancelación del timbrado
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cancelacion_facturas_servicio_servicio()
		{
			//Incializar formulario
			$('#frmCancelacionFacturasServicioServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_facturas_servicio_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmCancelacionFacturasServicioServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cancelacion_facturas_servicio_servicio');
			//Habilitar todos los elementos del formulario
			$('#frmCancelacionFacturasServicioServicio').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_cancelacion_facturas_servicio_servicio').attr('disabled','disabled');
			//Mostrar botón de Guardar
		    $("#btnGuardar_cancelacion_facturas_servicio_servicio").show();
		    //Agregar clase para ocultar div que contiene los datos de creación del registro
			$("#divDatosCreacion_cancelacion_facturas_servicio_servicio").addClass('no-mostrar');
		}

		//Función que se utiliza para abrir el modal
		function abrir_cancelacion_facturas_servicio_servicio(id, folio, polizaID, referenciaID)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cancelacion_facturas_servicio_servicio();

			//Asignar datos del registro seleccionado
			$('#txtReferenciaCfdiID_cancelacion_facturas_servicio_servicio').val(id);
			$('#txtFolio_cancelacion_facturas_servicio_servicio').val(folio);
			$('#txtPolizaID_cancelacion_facturas_servicio_servicio').val(polizaID);
			$('#txtReferenciaID_cancelacion_facturas_servicio_servicio').val(referenciaID);
			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_cancelacion_facturas_servicio_servicio').addClass("estatus-ACTIVO");

		    //Abrir modal
			objCancelacionFacturasServicioServicio = $('#CancelacionFacturasServicioServicioBox').bPopup({
												   appendTo: '#FacturasServicioServicioContent', 
						                           contentContainer: 'FacturasServicioServicioM', 
						                           zIndex: 2, 
						                           modalClose: false, 
						                           modal: true, 
						                           follow: [true,false], 
						                           followEasing : "linear", 
						                           easing: "linear", 
						                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#cmbCancelacionMotivoID_cancelacion_facturas_servicio_servicio').focus();
		}

		//Función para regresar los datos (al formulario) del registro seleccionados
		function ver_cancelacion_facturas_servicio_servicio(id)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCancelacionID_facturas_servicio_servicio').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/cancelaciones/get_datos',
	        {
	       		intCancelacionID:intID,
	       		strTipoReferencia:strTipoReferenciaFacturasServicioServicio
	        },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			               //Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cancelacion_facturas_servicio_servicio();
							//Recuperar valores
							$('#cmbCancelacionMotivoID_cancelacion_facturas_servicio_servicio').val(data.row.cancelacion_motivo_id);
							$('#txtFolio_cancelacion_facturas_servicio_servicio').val(data.row.folio_referencia);
							$('#txtFolioSustitucion_cancelacion_facturas_servicio_servicio').val(data.row.folio_sustitucion);
							$('#txtUsuarioCreacion_cancelacion_facturas_servicio_servicio').val(data.row.usuario_creacion);
							$('#txtFechaCreacion_cancelacion_facturas_servicio_servicio').val(data.row.fecha_creacion);

							//Dependiendo del estatus cambiar el color del encabezado 
		   					$('#divEncabezadoModal_cancelacion_facturas_servicio_servicio').addClass("estatus-INACTIVO");

		   				    //Deshabilitar todos los elementos del formulario
				            $('#frmCancelacionFacturasServicioServicio').find('input, textarea, select').attr('disabled','disabled');
		   					//Ocultar botón de Guardar
				            $("#btnGuardar_cancelacion_facturas_servicio_servicio").hide();
				            //Remover clase para mostrar div que contiene los datos de creación del registro
							$("#divDatosCreacion_cancelacion_facturas_servicio_servicio").removeClass('no-mostrar');

							//Abrir modal
							objCancelacionFacturasServicioServicio = $('#CancelacionFacturasServicioServicioBox').bPopup({
												   appendTo: '#FacturasServicioServicioContent', 
						                           contentContainer: 'FacturasServicioServicioM', 
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
		function cerrar_cancelacion_facturas_servicio_servicio()
		{
			try {
				//Cerrar modal
				objCancelacionFacturasServicioServicio.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cancelacion_facturas_servicio_servicio();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cancelacion_facturas_servicio_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_facturas_servicio_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmCancelacionFacturasServicioServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	intCancelacionMotivoID_facturas_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione un motivo'}
											}
										},
										strFolioSustitucion_cancelacion_facturas_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if(value == '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_facturas_servicio_servicio').val()) === intCancelacionIDRelacionCfdiFacturasServicioServicio) 
					                                    	
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una factura existente'
					                                        };
					                                    }
					                                    else if(value !== '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_facturas_servicio_servicio').val()) !== intCancelacionIDRelacionCfdiFacturasServicioServicio)
					                                    {

					                                    	//Hacer un llamado a la función para inicializar elementos de la sustitución
					                                    	inicializar_sustitucion_facturas_servicio_servicio();
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cancelacion_facturas_servicio_servicio = $('#frmCancelacionFacturasServicioServicio').data('bootstrapValidator');
			bootstrapValidator_cancelacion_facturas_servicio_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cancelacion_facturas_servicio_servicio.isValid())
			{
				//Hacer un llamado a la función para cancelar el timbrado de un registro
				cancelar_timbrado_facturas_servicio_servicio();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cancelacion_facturas_servicio_servicio()
		{
			try
			{
				$('#frmCancelacionFacturasServicioServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para inicializar elementos de la sustitución de CFDI
		function inicializar_sustitucion_facturas_servicio_servicio()
		{
			
			//Limpiar contenido de las siguientes cajas de texto
           $('#txtSustitucionID_cancelacion_facturas_servicio_servicio').val('');
           $('#txtUuidSustitucion_cancelacion_facturas_servicio_servicio').val('');
           $('#txtFolioSustitucion_cancelacion_facturas_servicio_servicio').val('');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function mostrar_circulo_carga_cancelacion_facturas_servicio_servicio()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_facturas_servicio_servicio").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function ocultar_circulo_carga_cancelacion_facturas_servicio_servicio()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_facturas_servicio_servicio").addClass('no-mostrar');
		}

		//Regresar motivos de cancelación activos para cargarlos en el combobox
		function cargar_motivos_cancelacion_facturas_servicio_servicio()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_cancelacion_motivos/get_combo_box', {},
				function(data)
				{
					$('#cmbCancelacionMotivoID_cancelacion_facturas_servicio_servicio').empty();
					var temp = Mustache.render($('#cancelacion_motivos_facturas_servicio_servicio').html(), data);
					$('#cmbCancelacionMotivoID_cancelacion_facturas_servicio_servicio').html(temp);
				},
				'json');
		}


		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cliente_facturas_servicio_servicio()
		{
			//Incializar formulario
			$('#frmEnviarFacturasServicioServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_facturas_servicio_servicio();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cliente_facturas_servicio_servicio');
		}


		//Función que se utiliza para abrir el modal
		function abrir_cliente_facturas_servicio_servicio(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cliente_facturas_servicio_servicio();
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaServicioID_facturas_servicio_servicio').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/facturas_servicio/get_datos',
			       {
			       		intFacturaServicioID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtFacturaServicioID_cliente_facturas_servicio_servicio').val(data.row.factura_servicio_id);
							$('#txtFolio_cliente_facturas_servicio_servicio').val(data.row.folio);
							$('#txtRazonSocial_cliente_facturas_servicio_servicio').val(data.row.razon_social);
							$('#txtCorreoElectronico_cliente_facturas_servicio_servicio').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_cliente_facturas_servicio_servicio').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_cliente_facturas_servicio_servicio').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarFacturasServicioServicio = $('#EnviarFacturasServicioServicioBox').bPopup({
																		   appendTo: '#FacturasServicioServicioContent', 
												                           contentContainer: 'FacturasServicioServicioM', 
												                           zIndex: 2, 
												                           modalClose: false, 
												                           modal: true, 
												                           follow: [true,false], 
												                           followEasing : "linear", 
												                           easing: "linear", 
												                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_cliente_facturas_servicio_servicio').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cliente_facturas_servicio_servicio()
		{
			try {
				//Cerrar modal
				objEnviarFacturasServicioServicio.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cliente_facturas_servicio_servicio();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cliente_facturas_servicio_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_facturas_servicio_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarFacturasServicioServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_cliente_facturas_servicio_servicio: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_cliente_facturas_servicio_servicio: {
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
			var bootstrapValidator_cliente_facturas_servicio_servicio = $('#frmEnviarFacturasServicioServicio').data('bootstrapValidator');
			bootstrapValidator_cliente_facturas_servicio_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cliente_facturas_servicio_servicio.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_cliente_facturas_servicio_servicio();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cliente_facturas_servicio_servicio()
		{
			try
			{
				$('#frmEnviarFacturasServicioServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al cliente
		function enviar_correo_cliente_facturas_servicio_servicio()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cliente_facturas_servicio_servicio();
			//Hacer un llamado al método del controlador para enviar correo electrónico al cliente
			$.post('contabilidad/timbradoV4/enviar_correo_electronico_cliente',
					{ 
						intReferenciaID: $('#txtFacturaServicioID_cliente_facturas_servicio_servicio').val(),
						strTipoReferencia: strTipoReferenciaFacturasServicioServicio,
						strFolio: $('#txtFolio_cliente_facturas_servicio_servicio').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_cliente_facturas_servicio_servicio').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_cliente_facturas_servicio_servicio').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cliente_facturas_servicio_servicio();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_cliente_facturas_servicio_servicio();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_facturas_servicio_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_cliente_facturas_servicio_servicio()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_facturas_servicio_servicio").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_cliente_facturas_servicio_servicio()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_facturas_servicio_servicio").addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones del modal Relacionar CFDI
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_cfdi_facturas_servicio_servicio()
		{
			//Incializar formulario
			$('#frmRelacionarCfdiFacturasServicioServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_facturas_servicio_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarCfdiFacturasServicioServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_cfdi_facturas_servicio_servicio');
			//Eliminar los datos de la tabla CFDI a relacionar
		    $('#dg_relacionar_cfdi_facturas_servicio_servicio tbody').empty();
		    $('#numElementos_relacionar_cfdi_facturas_servicio_servicio').html(0);
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_cfdi_facturas_servicio_servicio()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_cfdi_facturas_servicio_servicio();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_facturas_servicio_servicio').val();
			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_cfdi_facturas_servicio_servicio').addClass("estatus-"+strEstatus);
			//Abrir modal
			objRelacionarCfdiFacturasServicioServicio = $('#RelacionarCfdiFacturasServicioServicioBox').bPopup({
											  appendTo: '#FacturasServicioServicioContent', 
			                              	  contentContainer: 'FacturasServicioServicioM', 
			                              	  zIndex: 2, 
			                              	  modalClose: false, 
			                              	  modal: true, 
			                              	  follow: [true,false], 
			                              	  followEasing : "linear", 
			                              	  easing: "linear", 
			                             	  modalColor: ('#F0F0F0')});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_relacionar_cfdi_facturas_servicio_servicio').focus();
			//Hacer un llamado a la función  para cargar los CFDI´s en el grid
			lista_facturas_relacionar_cfdi_facturas_servicio_servicio();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_cfdi_facturas_servicio_servicio()
		{
			try {
				//Cerrar modal
				objRelacionarCfdiFacturasServicioServicio.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_cfdi_facturas_servicio_servicio()
		{

			//Hacer un llamado a la función para agregar las facturas (CFDI) seleccionadas al  objeto CFDI's  relacionados
			agregar_facturas_relacionar_cfdi_facturas_servicio_servicio();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_facturas_servicio_servicio();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarCfdiFacturasServicioServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumCfdi_relacionar_cfdi_facturas_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccionar al menos un CFDI para esta factura.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFechaInicialBusq_relacionar_cfdi_facturas_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaFinalBusq_relacionar_cfdi_facturas_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strRazonSocialBusq_relacionar_cfdi_facturas_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_relacionar_cfdi_facturas_servicio_servicio = $('#frmRelacionarCfdiFacturasServicioServicio').data('bootstrapValidator');
			bootstrapValidator_relacionar_cfdi_facturas_servicio_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_cfdi_facturas_servicio_servicio.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_cfdi_facturas_servicio_servicio();
				//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
		  		agregar_cfdi_relacionados_facturas_servicio_servicio('Nuevo', '');
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_cfdi_facturas_servicio_servicio()
		{
			try
			{
				$('#frmRelacionarCfdiFacturasServicioServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar CFDI's
		*********************************************************************************************************************/
		//Función para la búsqueda de CFDI's 
		function lista_facturas_relacionar_cfdi_facturas_servicio_servicio() 
		{
			//Variables que se utilizan para asignar los criterios de búsqueda
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaInicialBusq =  $.formatFechaMysql($('#txtFechaInicialBusq_relacionar_cfdi_facturas_servicio_servicio').val());
			var dteFechaFinalBusq =  $.formatFechaMysql($('#txtFechaFinalBusq_relacionar_cfdi_facturas_servicio_servicio').val());
			var intProspectoIDBusq =  $('#txtProspectoIDBusq_relacionar_cfdi_facturas_servicio_servicio').val();

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
						$('#dg_relacionar_cfdi_facturas_servicio_servicio tbody').empty();
						var tmpRelacionarCfdiFacturasServicioServicio = Mustache.render($('#plantilla_relacionar_cfdi_facturas_servicio_servicio').html(),data);
						$('#numElementos_relacionar_cfdi_facturas_servicio_servicio').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_cfdi_facturas_servicio_servicio').html(data.rows.length);	
						}
						$('#dg_relacionar_cfdi_facturas_servicio_servicio tbody').html(tmpRelacionarCfdiFacturasServicioServicio);
						
					},
			'json');

			
		}

		//Función para agregar las facturas (CFDI) seleccionadas al objeto CFDI's  relacionados
		function agregar_facturas_relacionar_cfdi_facturas_servicio_servicio()
		{
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
             
            //Crear instancia del objeto CFDI´s relacionados (facturas seleccionadas)
			objCfdisRelacionadosFacturasServicioServicio = new CfdisRelacionadosFacturasServicioServicio([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_cfdi_facturas_servicio_servicio tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
                	//Crear instancia del objeto CFDI a relacionar
					objCfdiRelacionarFacturasServicioServicio = new CfdiRelacionarFacturasServicioServicio(null, '', '', '', '', '', '');

                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objCfdiRelacionarFacturasServicioServicio.intReferenciaID = strValor;
							        break;
							    case 1:
							        objCfdiRelacionarFacturasServicioServicio.strCliente = strValor;
							        break;
							    case 2:
							        objCfdiRelacionarFacturasServicioServicio.strFolio = strValor;
							        break;
							    case 3:
							        objCfdiRelacionarFacturasServicioServicio.dteFecha = strValor;
							        break;
							    case 4:
							        objCfdiRelacionarFacturasServicioServicio.strTipoReferencia = strValor;
							        break;
							    case 5:
							       	objCfdiRelacionarFacturasServicioServicio.strUuid = strValor;
							        break;
							    case 6:
							       	objCfdiRelacionarFacturasServicioServicio.intImporte = strValor;
							       	break;
							}

					      	intCol++;
					    });

                	//Agregar datos del cfdi a relacionar
                	objCfdisRelacionadosFacturasServicioServicio.setCfdi(objCfdiRelacionarFacturasServicioServicio);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumCfdi_relacionar_cfdi_facturas_servicio_servicio').val(intContador);

		}


		/*******************************************************************************************************************
		Funciones del modal Facturas
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_facturas_servicio_servicio(tipoAccion)
		{
			//Incializar formulario
			$('#frmFacturasServicioServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_facturas_servicio_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmFacturasServicioServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_facturas_servicio_servicio');
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_facturas_servicio_servicio();
			//Eliminar los datos de la tabla CFDI relacionados
		    $('#dg_cfdi_relacionados_facturas_servicio_servicio tbody').empty();
			$('#numElementos_cfdi_relacionados_facturas_servicio_servicio').html(0);
			
			//Crear instancia del objeto Detalles de la orden de reparación o de la factura
			objDetallesFacturasServicioServicio = new DetallesFacturasServicioServicio([], [], [], []);
			
			//Habilitar todos los elementos del formulario
			$('#frmFacturasServicioServicio').find('input, textarea, select').removeAttr('disabled','disabled');
			//Seleccionar tab que contiene la información general
	  		$('a[href="#informacion_general_facturas_servicio_servicio"]').click();
			//Asignar la fecha actual
			$('#txtFecha_facturas_servicio_servicio').val(fechaActual());
		
			//Si el tipo de acción corresponde a Nuevo
			if(tipoAccion == 'Nuevo')
			{
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_facturas_servicio_servicio').addClass("estatus-NUEVO");
			}
			
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_facturas_servicio_servicio').attr("disabled", "disabled");
			$('#txtRazonSocial_facturas_servicio_servicio').attr("disabled", "disabled");
			$('#txtRfc_facturas_servicio_servicio').attr("disabled", "disabled");
			$('#txtTipoCambio_facturas_servicio_servicio').attr("disabled", "disabled");

			//Mostrar por Default 01- No aplica
			$('#cmbExportacionID_facturas_servicio_servicio').val(intExportacionBaseIDFacturasServicioServicio);

			//Mostrar los siguientes botones
			$("#btnGuardar_facturas_servicio_servicio").show();
			$("#btnBuscarCFDI_facturas_servicio_servicio").show(); 
			$("#btnReiniciar_facturas_servicio_servicio").show();
			//Ocultar los siguientes botones
			$("#btnEnviarCorreo_facturas_servicio_servicio").hide();
			$("#btnImprimirRegistro_facturas_servicio_servicio").hide();
			$("#btnDescargarArchivo_facturas_servicio_servicio").hide();
			$("#btnDesactivar_facturas_servicio_servicio").hide();
			$('#btnVerMotivoCancelacion_facturas_servicio_servicio').hide();
		}
		
		//Función para inicializar elementos de la orden de reparación
		function inicializar_orden_reparacion_facturas_servicio_servicio()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#txtProspectoID_facturas_servicio_servicio").val('');
			$("#txtRazonSocial_facturas_servicio_servicio").val('');
			$("#txtRfc_facturas_servicio_servicio").val('');
			$("#txtRegimenFiscalID_facturas_servicio_servicio").val('');
			$("#txtCalle_facturas_servicio_servicio").val('');
			$("#txtNumeroExterior_facturas_servicio_servicio").val('');
			$("#txtNumeroInterior_facturas_servicio_servicio").val('');
			$("#txtCodigoPostal_facturas_servicio_servicio").val('');
			$("#txtColonia_facturas_servicio_servicio").val('');
			$("#txtLocalidad_facturas_servicio_servicio").val('');
			$("#txtMunicipio_facturas_servicio_servicio").val('');
			$("#txtEstado_facturas_servicio_servicio").val('');
			$("#txtPais_facturas_servicio_servicio").val('');
			$("#txtGastosServicio_facturas_servicio_servicio").val('');
			$("#txtGastosServicioIva_facturas_servicio_servicio").val('');
			$("#txtServicioCreditoDias_facturas_servicio_servicio").val('');

            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_facturas_servicio_servicio();
		}

		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_facturas_servicio_servicio()
		{
			//Eliminar los datos de la tabla detalles de la factura
			$('#dg_detalles_facturas_servicio_servicio tbody').empty();
			$('#acumDescuento_detalles_facturas_servicio_servicio').html('');
		    $('#acumSubtotal_detalles_facturas_servicio_servicio').html('');
		    $('#acumIva_detalles_facturas_servicio_servicio').html('');
		    $('#acumIeps_detalles_facturas_servicio_servicio').html('');
		    $('#acumTotal_detalles_facturas_servicio_servicio').html('');
			$('#numElementos_detalles_facturas_servicio_servicio').html(0);
			$('#txtNumDetalles_facturas_servicio_servicio').val('');
			//Crear instancia del objeto Servicios de mano de obra de la factura
			objServiciosManoObraFacturasServicioServicio = new ServiciosManoObraFacturasServicioServicio([]);
			//Crear instancia del objeto Refacciones de la factura
			objRefaccionesFacturasServicioServicio = new RefaccionesFacturasServicioServicio([]);
			//Crear instancia del objeto Trabajos Foráneos de la factura
			objTrabajosForaneosFacturasServicioServicio = new TrabajosForaneosFacturasServicioServicio([]);
			//Crear instancia del objeto Otros servicios de la factura
			objOtrosFacturasServicioServicio = new OtrosFacturasServicioServicio([]);
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_facturas_servicio_servicio()
		{
			try {

				//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
				cerrar_cancelacion_facturas_servicio_servicio();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
				cerrar_cliente_facturas_servicio_servicio();
				//Hacer un llamado a la función para cerrar modal Relacionar CFDI
				cerrar_relacionar_cfdi_facturas_servicio_servicio();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_facturas_servicio_servicio('');
				//Cerrar modal
				objFacturasServicioServicio.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_facturas_servicio_servicio').focus();
				
			}
			catch(err) {}
		}


		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_facturas_servicio_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_facturas_servicio_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmFacturasServicioServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {

									  	strFecha_facturas_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intMonedaID_facturas_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_facturas_servicio_servicio: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                	//Asignar el id de la moneda
					                                	var intMonedaID = parseInt($('#cmbMonedaID_facturas_servicio_servicio').val());
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(intMonedaID !== intMonedaBaseIDFacturasServicioServicio)
						                                    {
						                                    	if(value === '' && intMonedaID > 0)
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'No existe tipo de cambio del día, favor de ir al módulo Caja - Tipos de Cambio y registrarlo'
						                                        	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strOrdenReparacion_facturas_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                	//Verificar que exista id de la orden de reparación interna
					                                    if($('#txtOrdenReparacionID_facturas_servicio_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una orden de trabajo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCondicionesPago_facturas_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una condición de pago'}
											}
										},
										strEstrategia_facturas_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la estrategia
					                                    if($('#txtEstrategiaID_facturas_servicio_servicio').val() === '')
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
										strFormaPago_facturas_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la forma de pago
					                                    if($('#txtFormaPagoID_facturas_servicio_servicio').val() === '')
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
										strMetodoPago_facturas_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del método de pago
					                                    if($('#txtMetodoPagoID_facturas_servicio_servicio').val() === '')
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
										intExportacionID_facturas_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una exportación'}
											}
										},
										strUsoCfdi_facturas_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del uso de CFDI
					                                    if($('#txtUsoCfdiID_facturas_servicio_servicio').val() === '')
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
										strTipoRelacion_facturas_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if((value !== '' && $('#txtTipoRelacionID_facturas_servicio_servicio').val() === '') 
					                                    	|| ($('#txtTipoRelacionID_facturas_servicio_servicio').val() === '' && parseInt($('#txtNumCfdiRelacionados_facturas_servicio_servicio').val()) > 0))
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
										intNumCfdiRelacionados_facturas_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan CFDI relacionados
					                                    if(parseInt($('#txtTipoRelacionID_facturas_servicio_servicio').val()) > 0 &&
					                                    	(parseInt(value) === 0 || value === ''))
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un CFDI para esta factura.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intNumDetalles_facturas_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta factura.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_facturas_servicio_servicio = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_facturas_servicio_servicio = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_facturas_servicio_servicio.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_facturas_servicio_servicio.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_facturas_servicio_servicio = $('#frmFacturasServicioServicio').data('bootstrapValidator');
			bootstrapValidator_facturas_servicio_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_facturas_servicio_servicio.isValid())
			{
				//Si tipo de venta es de crédito y no existe clave de autorización
				if($('#cmbCondicionesPago_facturas_servicio_servicio').val() == 'CREDITO'
					&& ($('#txtClaveAutorizacionID_facturas_servicio_servicio').val() == '' ||
						$('#txtClaveAutorizacionID_facturas_servicio_servicio').val() == '0'))
				{

					//Hacer un llamado a la función para validar el crédito disponible del cliente (límite de crédito/saldo vencido)
					validar_credito_cliente_facturas_servicio_servicio();
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_facturas_servicio_servicio();
				}
			}
			else 
				return;
		}


		//Función que se utiliza para validar el crédito disponible del cliente (límite de crédito/saldo vencido)
		function validar_credito_cliente_facturas_servicio_servicio()
		{

			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioFactura = parseFloat($('#txtTipoCambio_facturas_servicio_servicio').val());
			//Variable que se utiliza para asignar el importe de la factura
			var intImporteFra = 0;
			 //Asignar valores del gasto de paquetería
			var intGastosPaqueteriaFra = 0;
			//Variable que se utiliza para asignar el límite de crédito
			intCreditoLimite = 0;
			//Variable que se utiliza para asignar el saldo (facturas con adeudo)
			intSaldo = 0;
			//Variable que se utiliza para asignar el saldo vencido
			intSaldoVencido = 0;

			//Asignar el acumulado del importe total (Hacer un llamado a la función para reemplazar '$' por cadena vacia)
			intImporteFra = $.reemplazar($('#acumTotal_detalles_facturas_servicio_servicio').html(), "$", "");
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intImporteFra = $.reemplazar(intImporteFra, ",", "");
			//Convertir cadena de texto a número decimal
			intImporteFra = parseFloat(intImporteFra);


			//Convertir importes a peso mexicano
			intImporteFra = intImporteFra * intTipoCambioFactura;

			//Redondear cantidad a decimales
			intImporteFra = intImporteFra.toFixed(2);
			intImporteFra = parseFloat(intImporteFra);


			//Hacer un llamado al método del controlador para regresar los datos del cliente
            $.ajax({ url: 'caja/pagos/get_saldos_cliente',
				        method:'post',
				        dataType: 'json',
				        async: false,
				        data: {
				        	intProspectoID: $("#txtProspectoID_facturas_servicio_servicio").val(), 
				        	intReferenciaID: $('#txtFacturaServicioID_facturas_servicio_servicio').val(),
				        	strReferencia: 'SERVICIO'
				    		},
				        success: function (data) {
				          	if(data.row)
				          	{	
				          		//Recuperar valores del cliente
				          		intCreditoLimite =  parseFloat($.reemplazar(data.row.servicio_credito_limite, ",", ""));
				          		intSaldo =  parseFloat($.reemplazar(data.saldo_servicio, ",", ""));
				          		intSaldoVencido =  parseFloat($.reemplazar(data.saldo_vencido_servicio, ",", ""));
		                    }

				        }
				    });


            //Incrementar saldo
            intSaldo += intImporteFra;

            //Si se cumple le sentencia, significa que el cliente excede el límite de crédito o tiene saldo vencido
            if(intSaldo > intCreditoLimite || intSaldoVencido > 0)
            {
            	//Mostrar mensaje informativo con caja de texto
            	new $.Zebra_Dialog("El cliente excede el límite de crédito o presenta un saldo vencido, favor de proporcionar un código de autorización para continuar.",
								    {
								        default_value: "",
								        title: "Clave de Autorización",
								        type: "prompt",
								        onClose: function(caption, prompt) {
								            if (undefined !== prompt && (caption === true || caption === "Aceptar"))
								            {		
								            	   //Si existe valor
								            	   if(prompt != "")
									 			   {
									 			   		//Hacer un llamado al método del controlador para regresar los datos de la clave de autorización
									 			   		 $.ajax({ url: 'cuentas_cobrar/claves_autorizacion/get_existencia',
													        method:'post',
													        dataType: 'json',
													        async: false,
													        data: {
													        	intProspectoID: $("#txtProspectoID_facturas_servicio_servicio").val(), 
													        	strClave: prompt
													    		},
													        success: function (data) {

													        		//Si existe clave de autorización
													        		if(data.clave_autorizacion_id > 0)
													        		{
													        			//Asignar el id de la clave de autorización
													        			$("#txtClaveAutorizacionID_facturas_servicio_servicio").val(data.clave_autorizacion_id);

													        			//Hacer un llamado a la función para guardar los datos del registro
													        			guardar_facturas_servicio_servicio();
													        		}
													        		else
													        		{

															          	//Hacer un llamado a la función para mostrar mensaje de error
																		mensaje_facturas_servicio_servicio('error', data.mensaje);
													        		}
													        }
													    });

									 			   }//Cierre de verificación de clave
								            }
								          
								        }
								    }
								);

            }
            else
            {
            	//Hacer un llamado a la función para guardar los datos del registro
				guardar_facturas_servicio_servicio();
            }

		}


		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_facturas_servicio_servicio()
		{
			try
			{
				$('#frmFacturasServicioServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_facturas_servicio_servicio()
		{

			//Obtenemos el objeto de la tabla CFDI relacionados
			var objTabla = document.getElementById('dg_cfdi_relacionados_facturas_servicio_servicio').getElementsByTagName('tbody')[0];

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

			//Hacer un llamado a la función JSON para guardar los servicios de mano de obra
			var jsonServiciosManoObra = JSON.stringify(objServiciosManoObraFacturasServicioServicio); 
			//Hacer un llamado a la función JSON para guardar las refacciones
			var jsonRefacciones = JSON.stringify(objRefaccionesFacturasServicioServicio); 
			//Hacer un llamado a la función JSON para guardar los trabajos foráneos
			var jsonTrabajosForaneos = JSON.stringify(objTrabajosForaneosFacturasServicioServicio); 
			//Hacer un llamado a la función JSON para guardar otros servicios
			var jsonOtros = JSON.stringify(objOtrosFacturasServicioServicio); 


			//Hacer un llamado a la función para calcular fecha de vencimiento
	       	$.calcularFechaVencimiento(arrFechaVencimientoFacturasServicioServicio);


			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('servicio/facturas_servicio/guardar',
					{ 
						intFacturaServicioID: $('#txtFacturaServicioID_facturas_servicio_servicio').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_facturas_servicio_servicio').val()),
						strCondicionesPago: $('#cmbCondicionesPago_facturas_servicio_servicio').val(),
						dteVencimiento:  $.formatFechaMysql($('#txtFechaVencimiento_facturas_servicio_servicio').val()),
						intMonedaID: $('#cmbMonedaID_facturas_servicio_servicio').val(),
						intTipoCambio: $('#txtTipoCambio_facturas_servicio_servicio').val(),
						intOrdenReparacionID: $('#txtOrdenReparacionID_facturas_servicio_servicio').val(),
						intEstrategiaID: $('#txtEstrategiaID_facturas_servicio_servicio').val(),
						intProspectoID: $('#txtProspectoID_facturas_servicio_servicio').val(),
						strRazonSocial: $('#txtRazonSocial_facturas_servicio_servicio').val(),
						strRfc: $('#txtRfc_facturas_servicio_servicio').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_facturas_servicio_servicio').val(),
						strCalle: $('#txtCalle_facturas_servicio_servicio').val(),
						strNumeroExterior: $('#txtNumeroExterior_facturas_servicio_servicio').val(),
						strNumeroInterior: $('#txtNumeroInterior_facturas_servicio_servicio').val(),
						strCodigoPostal: $('#txtCodigoPostal_facturas_servicio_servicio').val(),
						strColonia: $('#txtColonia_facturas_servicio_servicio').val(),
						strLocalidad: $('#txtLocalidad_facturas_servicio_servicio').val(),
						strMunicipio: $('#txtMunicipio_facturas_servicio_servicio').val(),
						strEstado: $('#txtEstado_facturas_servicio_servicio').val(),
						strPais: $('#txtPais_facturas_servicio_servicio').val(),
						intGastosServicio: $('#txtGastosServicio_facturas_servicio_servicio').val(),
						intGastosServicioIva: $('#txtGastosServicioIva_facturas_servicio_servicio').val(),
						intFormaPagoID: $('#txtFormaPagoID_facturas_servicio_servicio').val(),
						intMetodoPagoID: $('#txtMetodoPagoID_facturas_servicio_servicio').val(),
						intUsoCfdiID: $('#txtUsoCfdiID_facturas_servicio_servicio').val(),
						intTipoRelacionID: $('#txtTipoRelacionID_facturas_servicio_servicio').val(),
						intExportacionID: $('#cmbExportacionID_facturas_servicio_servicio').val(),
						strObservaciones: $('#txtObservaciones_facturas_servicio_servicio').val(),
						strNotas: $('#txtNotas_facturas_servicio_servicio').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_facturas_servicio_servicio').val(),
						//Datos de los CFDI relacionados
						strCfdiRelacionado: arrCfdiRelacionado.join('|'),
						strTiposRelacion: arrTiposRelacion.join('|'),
						//Datos de la clave de autorización (clave generada cuando se excede el límite de crédito/saldo vencido)
						intClaveAutorizacionID:  $('#txtClaveAutorizacionID_facturas_servicio_servicio').val(),
						//Datos de los servicios de mano de obra
						arrServiciosManoObra: jsonServiciosManoObra,
						//Datos de las refacciones
						arrRefacciones: jsonRefacciones,
						//Datos de los trabajos foráneos
						arrTrabajosForaneos: jsonTrabajosForaneos,
						//Datos de otros servicios
						arrOtros: jsonOtros
					},
					function(data) {
						if (data.resultado)
						{
							//Si no existe id de la factura por servicio, significa que es un nuevo registro   
							if($('#txtFacturaServicioID_facturas_servicio_servicio').val() == '')
							{
							  	//Asignar el id de la factura  registrada en la base de datos
                     			$('#txtFacturaServicioID_facturas_servicio_servicio').val(data.factura_servicio_id);
                 			}

                 			//Hacer llamado a la función para cargar  los registros en el grid
							paginacion_facturas_servicio_servicio();

							//Hacer un llamado a la función para timbrar los datos del registro
							timbrar_facturas_servicio_servicio($('#txtFacturaServicioID_facturas_servicio_servicio').val(), 'modal', '',$('#txtRegimenFiscalID_facturas_servicio_servicio').val());

							//Si no existe id de la póliza (o se trata de un nuevo registro)
							if(parseInt($('#txtPolizaID_facturas_servicio_servicio').val()) == 0 || 
								$('#txtEstatus_facturas_servicio_servicio').val() == '')
							{

								//Hacer un llamado a la función para generar póliza con los datos del registro
								generar_poliza_facturas_servicio_servicio('', '', '');
							}
							

							   
						}

						//Si existe mensaje de error
						if(data.tipo_mensaje == 'error')
						{
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_facturas_servicio_servicio(data.tipo_mensaje, data.mensaje);
						}
						
					},
			'json');

		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_facturas_servicio_servicio(tipoMensaje, mensaje, campoID)
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
				new $.Zebra_Dialog(strMsjRegimenFiscalCteFacturasServicioServicio, 
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
		function cambiar_estatus_facturas_servicio_servicio(facturaServicioID, folio, ordenReparacionID, 
														    polizaID, folioPoliza)
		{
			//Variable que se utiliza para asignar el id de la factura
			var intID = 0;
			//Variable que se utiliza para asignar el folio del registro
			var strFolio = '';
			//Variable que se utiliza para asignar el id de la orden de reparación
			var intOrdenReparacionID = 0;
			//Variable que se utiliza para asignar el id de la póliza
			var intPolizaID = 0;
		    //Variable que se utiliza para asignar el folio de la póliza
			var strFolioPoliza = '';

			//Si no existe id, significa que se realizará la modificación desde el modal
			if(facturaServicioID == '')
			{
				intID = $('#txtFacturaServicioID_facturas_servicio_servicio').val();
				strFolio = $('#txtFolio_facturas_servicio_servicio').val();
				intOrdenReparacionID = $('#txtOrdenReparacionID_facturas_servicio_servicio').val();
				intPolizaID = $('#txtPolizaID_facturas_servicio_servicio').val();
				strFolioPoliza = $('#txtFolioPoliza_facturas_servicio_servicio').val();
			}
			else
			{
				intID = facturaServicioID;
				strFolio = folio;
				intOrdenReparacionID = ordenReparacionID;
				intPolizaID = polizaID;
				strFolioPoliza = folioPoliza;
			}

		   
			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea cancelar el registro; también se cancelara la póliza con folio: '+strFolioPoliza+'?</strong>',
					             {'type':     'question',
					              'title':    'Facturación',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              	//Hacer un llamado a la función para abrir el modal Cancelación del timbrado (cambiar estatus y cancelar timbrado del registro)
					                              abrir_cancelacion_facturas_servicio_servicio(intID, strFolio, intPolizaID, intOrdenReparacionID);
					                            }
					                          }
					              });
		}


		//Función para cancelar el timbrado de un registro. Cambia el estatus a INACTIVO
		function cancelar_timbrado_facturas_servicio_servicio()
		{

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cancelacion_facturas_servicio_servicio();
			 //Hacer un llamado al método del controlador para cancelar un CFDI y posteriormente cambiar el estatus a INACTIVO
	         //----- CÓDIGO PARA PRODUCCIÓN
	          $.post('contabilidad/timbrado_cancelar/set_cancelar',
	          {
	          		//Datos para cancelar el timbrado (CFDI)
	         		intMovimientoID: $('#txtReferenciaCfdiID_cancelacion_facturas_servicio_servicio').val(),
					strTipoReferencia: strTipoReferenciaFacturasServicioServicio, 
					strUuidSustitucion: $('#txtUuidSustitucion_cancelacion_facturas_servicio_servicio').val(),
					strMotivo: $('select[name="intCancelacionMotivoID_facturas_servicio_servicio"] option:selected').text(),
					//Datos para cambiar (administrativamente) el estatus del registro
					intCancelacionMotivoID: $('#cmbCancelacionMotivoID_cancelacion_facturas_servicio_servicio').val(), 
					intSustitucionID:  $('#txtSustitucionID_cancelacion_facturas_servicio_servicio').val(),
					intPolizaID: $('#txtPolizaID_cancelacion_facturas_servicio_servicio').val(), 
			     	intReferenciaIDReg:  $('#txtReferenciaID_cancelacion_facturas_servicio_servicio').val()
	          },
	                 function(data) {

	                    if(data.resultado)
	                    {
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_facturas_servicio_servicio();	

							//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
							cerrar_cancelacion_facturas_servicio_servicio();  

							//Si el id del registro se obtuvo del modal
							if($('#txtFacturaServicioID_facturas_servicio_servicio').val() != '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_facturas_servicio_servicio();     
							}		
	                    }

	                    //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
				        ocultar_circulo_carga_cancelacion_facturas_servicio_servicio();
					    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_facturas_servicio_servicio(data.tipo_mensaje, data.mensaje);


	                 },
	                'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_facturas_servicio_servicio(id, tipoAccion, cancelacionID)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/facturas_servicio/get_datos',
			       {
			       		intFacturaServicioID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_facturas_servicio_servicio('');
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar el id de la póliza
				            var intPolizaID = parseInt(data.row.poliza_id); 
				            //Asignar el id de la clave de autorización
				            var intClaveAutorizacionID = parseInt(data.row.clave_autorizacion_id); 

				          	//Recuperar valores
				            $('#txtFacturaServicioID_facturas_servicio_servicio').val(data.row.factura_servicio_id);
				            $('#txtFolio_facturas_servicio_servicio').val(data.row.folio);
				            $('#txtFecha_facturas_servicio_servicio').val(data.row.fecha_format);
				            $('#cmbCondicionesPago_facturas_servicio_servicio').val(data.row.condiciones_pago);
				            $('#txtFechaVencimiento_facturas_servicio_servicio').val(data.row.vencimiento);
				            $('#cmbMonedaID_facturas_servicio_servicio').val(data.row.moneda_id);
				            $('#txtTipoCambio_facturas_servicio_servicio').val(data.row.tipo_cambio);
				            $('#txtOrdenReparacionID_facturas_servicio_servicio').val(data.row.orden_reparacion_id);
				            $('#txtOrdenReparacion_facturas_servicio_servicio').val(data.row.folio_orden_reparacion);
				            $('#txtEstrategiaID_facturas_servicio_servicio').val(data.row.estrategia_id);
				            $('#txtEstrategia_facturas_servicio_servicio').val(data.row.estrategia);
				            $('#txtProspectoID_facturas_servicio_servicio').val(data.row.prospecto_id);
						    $('#txtRazonSocial_facturas_servicio_servicio').val(data.row.razon_social);
						    $('#txtRfc_facturas_servicio_servicio').val(data.row.rfc);
						    $('#txtRegimenFiscalID_facturas_servicio_servicio').val(data.row.regimen_fiscal_id);
						    $('#txtCalle_facturas_servicio_servicio').val(data.row.calle);
						    $('#txtNumeroExterior_facturas_servicio_servicio').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_facturas_servicio_servicio').val(data.row.numero_interior);
						    $('#txtCodigoPostal_facturas_servicio_servicio').val(data.row.codigo_postal);
						    $('#txtColonia_facturas_servicio_servicio').val(data.row.colonia);
						    $('#txtLocalidad_facturas_servicio_servicio').val(data.row.localidad);
						    $('#txtMunicipio_facturas_servicio_servicio').val(data.row.municipio);
						    $('#txtEstado_facturas_servicio_servicio').val(data.row.estado);
						    $('#txtPais_facturas_servicio_servicio').val(data.row.pais);
						    $('#txtServicioCreditoDias_facturas_servicio_servicio').val(data.row.servicio_credito_dias);
						    $('#txtGastosServicio_facturas_servicio_servicio').val(data.row.gastos_servicio);
						    $('#txtGastosServicioIva_facturas_servicio_servicio').val(data.row.gastos_servicio_iva);
						    $('#txtFormaPagoID_facturas_servicio_servicio').val(data.row.forma_pago_id);
						    $('#txtFormaPago_facturas_servicio_servicio').val(data.row.forma_pago);
						    $('#txtMetodoPagoID_facturas_servicio_servicio').val(data.row.metodo_pago_id);
						    $('#txtMetodoPago_facturas_servicio_servicio').val(data.row.metodo_pago);
						    $('#txtUsoCfdiID_facturas_servicio_servicio').val(data.row.uso_cfdi_id);
						    $('#txtUsoCfdi_facturas_servicio_servicio').val(data.row.uso_cfdi);
						    $('#txtTipoRelacionID_facturas_servicio_servicio').val(data.row.tipo_relacion_id);
						    $('#txtTipoRelacion_facturas_servicio_servicio').val(data.row.tipo_relacion);
						    $('#cmbExportacionID_facturas_servicio_servicio').val(data.row.exportacion_id);
						    $('#txtObservaciones_facturas_servicio_servicio').val(data.row.observaciones);
						    $('#txtNotas_facturas_servicio_servicio').val(data.row.notas);
						    $('#txtPolizaID_facturas_servicio_servicio').val(intPolizaID);
						    $('#txtFolioPoliza_facturas_servicio_servicio').val(data.row.folio_poliza);
						    $('#txtClaveAutorizacionID_facturas_servicio_servicio').val(intClaveAutorizacionID);
						    $('#txtEstatus_facturas_servicio_servicio').val(strEstatus);

							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_facturas_servicio_servicio').addClass("estatus-" + strEstatus);
				           
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_facturas_servicio_servicio").show();
				            //Deshabilitar orden de reparación
							$('#txtOrdenReparacion_facturas_servicio_servicio').attr("disabled", "disabled");

				            //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar botón Descargar Archivo
				            	$("#btnDescargarArchivo_facturas_servicio_servicio").show();
				           	}

				           
				           	//Si el estatus del registro es diferente de TIMBRAR
				            if(strEstatus != 'TIMBRAR')
							{
								//Deshabilitar todos los elementos del formulario
				            	$('#frmFacturasServicioServicio').find('input, textarea, select').attr('disabled','disabled');

				            	//Si el estatus del registro es ACTIVO
								if(strEstatus == 'ACTIVO')
								{
									//Mostrar los siguientes botones
				            		$("#btnEnviarCorreo_facturas_servicio_servicio").show();
				            		//Si existe el id de la póliza
					            	if(intPolizaID > 0)
					            	{
					            		$('#btnDesactivar_facturas_servicio_servicio').show();
					            	}
								}

				            	//Ocultar los siguientes botones
					            $("#btnReiniciar_facturas_servicio_servicio").hide();
								$("#btnGuardar_facturas_servicio_servicio").hide();
								$("#btnBuscarCFDI_facturas_servicio_servicio").hide(); 

								//Si existe id de la cancelación del CFDI
								if(cancelacionID > 0)
								{	
									//Asignar el id de la cancelación
									$("#txtCancelacionID_facturas_servicio_servicio").val(cancelacionID); 
									//Mostrar botón Motivo de cancelación
									$("#btnVerMotivoCancelacion_facturas_servicio_servicio").show(); 
								}
								

							}
							else if (strEstatus == 'TIMBRAR' && intPolizaID > 0)
				            {
				            	//Hacer un llamado a la función para habilitar campos de timbrado
				            	habilitar_controles_timbrado_facturas_servicio_servicio();
				            }


							//Agregar datos a los array's del objeto Detalles
		              		objDetallesFacturasServicioServicio.setServicios(data.mano_obra);
		              		objDetallesFacturasServicioServicio.setRefacciones(data.refacciones);
		              		objDetallesFacturasServicioServicio.setTrabajosForaneos(data.trabajos_foraneos);
		              		objDetallesFacturasServicioServicio.setOtros(data.otros);
		              	    //Hacer llamado a la función  para cargar los acumulados del registro en el grid
				    		agregar_renglones_acumulados_orden_reparacion_facturas_servicio_servicio();

				    		//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
							agregar_cfdi_relacionados_facturas_servicio_servicio('Editar', strEstatus);	


							//Si la factura (sin timbrar) tiene pagos (abonos) / tiene clave de autorización
							if(strEstatus == 'TIMBRAR' && (data.abonos > 0 || intClaveAutorizacionID > 0))
							{
								//Variable que se utiliza para asignar el mensaje informativo
								var strMensaje = '';
								//Deshabilitar las siguientes cajas de texto
								$('#txtMetodoPago_facturas_servicio_servicio').attr('disabled','disabled');
								$('#cmbCondicionesPago_facturas_servicio_servicio').attr('disabled','disabled');

								//Si la factura cuenta con pagos (abonos)
								if(data.abonos > 0)
								{
									//Mensaje que se utiliza para informar al usuario que la factura cuenta con pagos (abonos) y no es posible modificar su importe
									strMensaje = 'La FACTURA tiene pagos (abonos) y no es posible realizar ajustes.';
								}


								//Si existe clave de atorización
								if(intClaveAutorizacionID > 0)
								{
									//Mensaje que se utiliza para informar al usuario que la factura cuenta con clave de autorización y no es posible modificar su importe
									strMensaje = 'La FACTURA tiene un código de autorización y no es posible realizar ajustes.';
								}
								

								//Hacer un llamado a la función para mostrar mensaje de error
								mensaje_facturas_servicio_servicio('error', strMensaje);
							}

							//Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objFacturasServicioServicio = $('#FacturasServicioServicioBox').bPopup({
															  appendTo: '#FacturasServicioServicioContent', 
								                              contentContainer: 'FacturasServicioServicioM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});
					        }

				            //Enfocar caja de texto
							$('#cmbMonedaID_facturas_servicio_servicio').focus();

			       	    }
			       	   
						
			       },
			       'json');
		}

		//Función para habilitar controles del formulario correspondientes al timbrado
		function habilitar_controles_timbrado_facturas_servicio_servicio()
		{
			//Deshabilitar todos los elementos del formulario
        	$('#frmFacturasServicioServicio').find('input, textarea, select').attr('disabled','disabled');
        	//Habilitar las siguientes cajas de texto
        	$('#txtFormaPago_facturas_servicio_servicio').removeAttr('disabled');
        	$('#txtMetodoPago_facturas_servicio_servicio').removeAttr('disabled');
        	$('#txtUsoCfdi_facturas_servicio_servicio').removeAttr('disabled');
        	$('#txtTipoRelacion_facturas_servicio_servicio').removeAttr('disabled');
        	$('#cmbExportacionID_facturas_servicio_servicio').removeAttr('disabled');
        	$('#txtObservaciones_facturas_servicio_servicio').removeAttr('disabled');
        	$('#txtNotas_facturas_servicio_servicio').removeAttr('disabled');
		}

		//Función para regresar obtener los datos de una orden de reparación
		function get_datos_orden_reparacion_facturas_servicio_servicio()
		{
		 	 //Hacer un llamado al método del controlador para regresar los datos de la orden de reparación
	         $.post('servicio/ordenes_reparacion/get_datos',
	          { 
	          		intOrdenReparacionID:$("#txtOrdenReparacionID_facturas_servicio_servicio").val()
	          },
	              function(data) {
	                if(data.row)
	                {
	                    //Recuperar valores
	                   	$("#txtProspectoID_facturas_servicio_servicio").val(data.row.prospecto_id);
						$("#txtRazonSocial_facturas_servicio_servicio").val(data.row.razon_social);
						$("#txtRfc_facturas_servicio_servicio").val(data.row.rfc);
						$('#txtRegimenFiscalID_facturas_servicio_servicio').val(data.row.regimen_fiscal_id);
						$("#txtCalle_facturas_servicio_servicio").val(data.row.cliente_calle);
						$("#txtNumeroExterior_facturas_servicio_servicio").val(data.row.cliente_numero_exterior);
						$("#txtNumeroInterior_facturas_servicio_servicio").val(data.row.cliente_numero_interior);
						$("#txtCodigoPostal_facturas_servicio_servicio").val(data.row.cliente_codigo_postal);
						$("#txtColonia_facturas_servicio_servicio").val(data.row.cliente_colonia);
						$("#txtLocalidad_facturas_servicio_servicio").val(data.row.cliente_localidad);
						$("#txtMunicipio_facturas_servicio_servicio").val(data.row.cliente_municipio);
						$("#txtEstado_facturas_servicio_servicio").val(data.row.cliente_estado);
						$("#txtPais_facturas_servicio_servicio").val(data.row.cliente_pais);
						$("#txtGastosServicio_facturas_servicio_servicio").val(data.row.gastos_servicio);
						$("#txtGastosServicioIva_facturas_servicio_servicio").val(data.row.gastos_servicio_iva);
						$("#txtServicioCreditoDias_facturas_servicio_servicio").val(data.row.servicio_credito_dias);
				
	                    //Función para obtener los detalles de: Mano de obra, Refacciones, Trabajos foráneos y Otros servicios.
						$.post('servicio/ordenes_reparacion/get_detalles_factura',
			              { 
			              	intOrdenReparacionID:$("#txtOrdenReparacionID_facturas_servicio_servicio").val()
			              },
			              function(data) 
			              {
			              		//Agregar datos a los array's del objeto Detalles
			              		objDetallesFacturasServicioServicio.setServicios(data.mano_obra);
			              		objDetallesFacturasServicioServicio.setRefacciones(data.refacciones);
			              		objDetallesFacturasServicioServicio.setTrabajosForaneos(data.trabajos_foraneos);
			              		objDetallesFacturasServicioServicio.setOtros(data.otros);

			              	    //Hacer llamado a la función  para cargar los acumulados del registro en el grid
					    		agregar_renglones_acumulados_orden_reparacion_facturas_servicio_servicio();
			              	
			              }
			            ,
			    		'json');
	                   
	                }
	              }
	             ,
	            'json');

		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_facturas_servicio_servicio()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_facturas_servicio_servicio').val()) !== intMonedaBaseIDFacturasServicioServicio)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_facturas_servicio_servicio").val('');
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_facturas_servicio_servicio').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_facturas_servicio_servicio').val();
				
	            //Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	             $.ajax('caja/tipos_cambio/get_datos',
	             		{
				        "type" : "post",
				        "data": {strBusqueda:  strCriteriosBusq,
			       				 strTipo: 'fecha'
				                 },
				        success: function(data){
				            //Si los datos se recuperaron correctamente
				             if(data.row){
			                       $("#txtTipoCambio_facturas_servicio_servicio").val(data.row.tipo_cambio_venta);
			                     
			                    }
				          },
				        "async": false,
				      });
			}

			//Hacer llamado a la función  para cargar los detalles del registro en el grid
			agregar_renglones_acumulados_orden_reparacion_facturas_servicio_servicio();
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda del detalle
		function get_tipo_cambio_detalle_facturas_servicio_servicio(intMonedaID)
		{
			//Limpiar contenido de la caja de texto
         	$("#txtTipoCambioVenta_facturas_servicio_servicio").val('');

         	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFecha = $.formatFechaMysql($('#txtFecha_facturas_servicio_servicio').val());

			//Concatenar criterios de búsqueda para regresar el tipo de cambio
			var strCriteriosBusq = dteFecha+'|'+intMonedaID;
			//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
             $.ajax('caja/tipos_cambio/get_datos',
             		{
			        "type" : "post",
			        "data": {strBusqueda:  strCriteriosBusq,
		       				 strTipo: 'fecha'
			                 },
			        success: function(data){
			            //Si los datos se recuperaron correctamente
			             if(data.row){
		                       $("#txtTipoCambioVenta_facturas_servicio_servicio").val(data.row.tipo_cambio_venta);
		                     
		                    }
			          },
			        "async": false,
			      });
		}


		//Función para generar póliza con los datos de un registro
		function generar_poliza_facturas_servicio_servicio(id, estatus, formulario)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaServicioID_facturas_servicio_servicio').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_facturas_servicio_servicio(formulario);
			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaFacturasServicioServicio, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_facturas_servicio_servicio').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_facturas_servicio_servicio(formulario);
			    //Si existe resultado
				if (data.resultado)
				{
					
					//Asignar el id de la póliza (generada) y evitar duplicidad de datos en caso de que no sea posible timbrar el registro
                    $('#txtPolizaID_facturas_servicio_servicio').val(data.poliza_id);
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_facturas_servicio_servicio();
				}

				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_facturas_servicio_servicio(data.tipo_mensaje, data.mensaje);
				
		     },
		     'json');
		}

		//Función para timbrar los datos de un registro
		function timbrar_facturas_servicio_servicio(id, tipo, formulario, regimenFiscalID)
		{
			//Si existe id del régimen fiscal
			if(regimenFiscalID > 0)
			{
				//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
				mostrar_circulo_carga_facturas_servicio_servicio(formulario);
				//Hacer un llamado al método del controlador para timbrar los datos del registro
				$.post('contabilidad/timbradoV4/set_timbrar',
			     {
			     	intReferenciaID: id,
			      	strTipoReferencia: strTipoReferenciaFacturasServicioServicio
			     },
			     function(data) {

			     	//Si el id del registro se obtuvo del modal
					if(tipo == 'modal')
					{
						//Si existe resultado (los datos se timbraron correctamente)
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_facturas_servicio_servicio();  
						}
						else
						{
							//Hacer un llamado a la función para limpiar los mensajes de error 
							limpiar_mensajes_facturas_servicio_servicio();
							//Hacer un llamado a la función para cargar datos del registro (habilitar campos de timbrado)
							editar_facturas_servicio_servicio(id,'Nuevo');
						}
					}

					//Hacer llamado a la función para cargar  los registros en el grid
				    paginacion_facturas_servicio_servicio();
					//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		            ocultar_circulo_carga_facturas_servicio_servicio(formulario);
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_facturas_servicio_servicio(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
			}
			else
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				 mensaje_facturas_servicio_servicio('error_regimen_fiscal');
			}
		}


		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function mostrar_circulo_carga_facturas_servicio_servicio(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_facturas_servicio_servicio';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_facturas_servicio_servicio';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function ocultar_circulo_carga_facturas_servicio_servicio(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_facturas_servicio_servicio';

			//Si el Div a ocultar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_facturas_servicio_servicio';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}

		
		

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglones de los detalles acumulados a la tabla
		function agregar_renglones_acumulados_orden_reparacion_facturas_servicio_servicio() 
		{
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_facturas_servicio_servicio();
			//Variable que se utiliza para asignar la moneda de la factura
			var intMonedaIDFactura =  parseInt($("#cmbMonedaID_facturas_servicio_servicio").val());
			//Variable que se utiliza para asignar el tipo de cambio de la factura
			var intTipoCambioFactura =  parseFloat($("#txtTipoCambio_facturas_servicio_servicio").val());

			//Si existe tipo de cambio
			if(intTipoCambioFactura > 0)
			{
				//Variables que se utilizan para asignar acumulados generales
				var strDescripcion = '';
				var intAcumPrecio = 0;
				var intAcumDescuento = 0;
				var intAcumSubtotal = 0;
				var intAcumIva = 0;
				var intAcumIeps = 0;
				var intAcumTotal = 0;

				//Variables que se utilizan para asignar acumulados de los servicios de mano de obra
				var intAcumPrecioMO = 0;
				var intAcumDescuentoMO = 0;
				var intAcumSubtotalMO = 0;
				var intAcumIvaMO = 0;
				var intAcumIepsMO = 0;
				var intAcumTotalMO = 0;

			    //Variables que se utilizan para asignar acumulados de las refacciones
				var intAcumPrecioRef = 0;
				var intAcumDescuentoRef = 0;
				var intAcumSubtotalRef = 0;
				var intAcumIvaRef = 0;
				var intAcumIepsRef = 0;
				var intAcumTotalRef = 0;

				//Variables que se utilizan para asignar acumulados de los trabajos foráneos
				var intAcumPrecioTF = 0;
				var intAcumDescuentoTF = 0;
				var intAcumSubtotalTF = 0;
				var intAcumIvaTF = 0;
				var intAcumIepsTF = 0;
				var intAcumTotalTF = 0;

				//Variables que se utilizan para asignar acumulados de otros servicios
				var intAcumPrecioOtros = 0;
				var intAcumDescuentoOtros = 0;
				var intAcumSubtotalOtros = 0;
				var intAcumIvaOtros = 0;
				var intAcumIepsOtros = 0;
				var intAcumTotalOtros = 0;

				//Variable que se utiliza para contar el número de registros sin tipo de cambio del día
				var intContadorErrores = 0;
				//Mensaje que se utiliza para informar al usuario que no existe tipo de cambio del día para la moneda del detalle
				var strMensaje = 'No existe tipo de cambio del día para la moneda: ';

				/*
				*****************************************************************************************************************
				* GASTOS DE SERVICIO
				*****************************************************************************************************************
				*/
				//Variables que se utilizan para asignar el gasto de servicio
				var intGastosServicioSubtotal = parseFloat($("#txtGastosServicio_facturas_servicio_servicio").val());
				var intGastosServicioIva = parseFloat($("#txtGastosServicioIva_facturas_servicio_servicio").val());
				var intGastosServicioTotal = 0;

				//Si el tipo de moneda de la factura no corresponde a peso mexicano
				if(intMonedaIDFactura !== intMonedaBaseIDFacturasServicioServicio)
				{
					//Convertir peso mexicano a tipo de cambio
					intGastosServicioSubtotal = intGastosServicioSubtotal / intTipoCambioFactura;
					intGastosServicioIva = intGastosServicioIva / intTipoCambioFactura;
					intGastosServicioTotal = intGastosServicioTotal / intTipoCambioFactura;

				    //Redondear cantidad a decimales
					intGastosServicioSubtotal = intGastosServicioSubtotal.toFixed(2);
					intGastosServicioSubtotal = parseFloat(intGastosServicioSubtotal);

					//Redondear cantidad a dos decimales
				    intGastosServicioIva = intGastosServicioIva.toFixed(4);
				    intGastosServicioIva = parseFloat(intGastosServicioIva);
				}

				//Calcular el total del gasto de servicio
				intGastosServicioTotal = intGastosServicioSubtotal + intGastosServicioIva;

				
	    		/*
				*****************************************************************************************************************
				* MANO DE OBRA
				*****************************************************************************************************************
				*/
				//Hacer recorrido para obtener los detalles de mano de obra
			    for (var intCon in objDetallesFacturasServicioServicio.getServicios()) 
			    {
			    	//Crear instancia temporal del objeto Detalles de la orden de reparación (o factura) consultada
					objServicioDetalleFacturasServicioServicio = new DetallesFacturasServicioServicio();
					//Asignar datos del detalle de mano de obra corespondiente al indice
	            	objServicioDetalleFacturasServicioServicio = objDetallesFacturasServicioServicio.getServicio(intCon);
			    	//Crear instancia del objeto Servicio de mano de obra de la factura (a guardar)
					objServicioManoObraFacturasServicioServicio = new ServicioManoObraFacturasServicioServicio('', '', '', '', 
																										   		'', '', '', '', '', 
																										   	    '', '', '');

			    	//Variables que se utilizan para asignar valores del detalle
			    	var intTasaCuotaIeps = objServicioDetalleFacturasServicioServicio.tasa_cuota_ieps;
		        	var intPorcentajeIva = objServicioDetalleFacturasServicioServicio.porcentaje_iva;
		        	var intPorcentajeIeps = objServicioDetalleFacturasServicioServicio.porcentaje_ieps;

		        	//Variable que se utiliza para asignar el importe de iva
					var intImporteIva = 0;
		        	//Variable que se utiliza para asignar el iva unitario
					var intIvaUnitario = 0;
					//Variable que se utiliza para asignar el importe de ieps
					var intImporteIeps = 0;
					//Variable que se utiliza para asignar el ieps unitario
					var intIepsUnitario = 0;
					//Variable que se utiliza para asignar el descuento unitario
				    var intDescuentoUnitario = 0;
		       		//Variable que se utiliza para asignar el precio unitario
		        	var intPrecioUnitario = 0;
		        	//Variable que se utiliza para asignar el subtotal 
					var intSubtotal = 0;

					//Si no existe id de la factura
		        	if($("#txtFacturaServicioID_facturas_servicio_servicio").val() == '')
					{
						//Variables que se utilizan para asignar valores del detalle
						var intHoras = parseFloat(objServicioDetalleFacturasServicioServicio.horas);
		        		var intPrecio = parseFloat(objServicioDetalleFacturasServicioServicio.precio);
		        		//Calcular precio unitario
		        		intPrecioUnitario = intHoras * intPrecio;
					}
					else
					{	//Asignar precio unitario
					    intPrecioUnitario = parseFloat(objServicioDetalleFacturasServicioServicio.precio_unitario);
					}

		        	//Redondear cantidad a decimales
					intPrecioUnitario = intPrecioUnitario.toFixed(2);
					intPrecioUnitario = parseFloat(intPrecioUnitario);
					//Asignar precio unitario
					intSubtotal = intPrecioUnitario;

					//Calcular importe de IVA
					intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);

					//Redondear cantidad a dos decimales
				    intImporteIva = intImporteIva.toFixed(4);
				    intImporteIva = parseFloat(intImporteIva);

					//Si existe id de la tasa de cuota del IEPS
					if(intTasaCuotaIeps > 0)
					{
						//Calcular importe de IEPS
						intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
						//Redondear cantidad a dos decimales
				   	 	intImporteIeps = intImporteIeps.toFixed(4);
				   	 	intImporteIeps = parseFloat(intImporteIeps);
					}

					//Si el tipo de moneda de la factura no corresponde a peso mexicano
					if(intMonedaIDFactura !== intMonedaBaseIDFacturasServicioServicio)
					{
						//Convertir peso mexicano a tipo de cambio
						intPrecioUnitario = intPrecioUnitario / intTipoCambioFactura;
						intSubtotal = intSubtotal / intTipoCambioFactura;
						intImporteIva = intImporteIva / intTipoCambioFactura;
						intImporteIeps = intImporteIeps / intTipoCambioFactura;

					    //Redondear cantidad a decimales
						intSubtotal = intSubtotal.toFixed(2);
						intSubtotal = parseFloat(intSubtotal);

						//Redondear cantidad a dos decimales
					    intImporteIva = intImporteIva.toFixed(4);
					    intImporteIva = parseFloat(intImporteIva);

					    //Redondear cantidad a dos decimales
				   	 	intImporteIeps = intImporteIeps.toFixed(4);
				   	 	intImporteIeps = parseFloat(intImporteIeps);
					}

					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;

					//Convertir importes a peso mexicano
					intPrecioUnitario = intPrecioUnitario * intTipoCambioFactura;
					intIvaUnitario = intImporteIva * intTipoCambioFactura;
					intIepsUnitario = intImporteIeps * intTipoCambioFactura;

					//Redondear cantidad a decimales
					intIvaUnitario = intIvaUnitario.toFixed(4);
					intIvaUnitario = parseFloat(intIvaUnitario);

					//Redondear cantidad a decimales
					intIepsUnitario = intIepsUnitario.toFixed(4);
					intIepsUnitario = parseFloat(intIepsUnitario);

					//Asignar valores al objeto Servicio de mano de obra de la factura
					objServicioManoObraFacturasServicioServicio.intServicioID = objServicioDetalleFacturasServicioServicio.servicio_id;
					objServicioManoObraFacturasServicioServicio.strCodigo = objServicioDetalleFacturasServicioServicio.codigo;
					objServicioManoObraFacturasServicioServicio.strDescripcion =objServicioDetalleFacturasServicioServicio.descripcion;
					objServicioManoObraFacturasServicioServicio.strCodigoSat = objServicioDetalleFacturasServicioServicio.codigo_sat;
					objServicioManoObraFacturasServicioServicio.strUnidadSat = objServicioDetalleFacturasServicioServicio.unidad_sat;
					objServicioManoObraFacturasServicioServicio.strObjetoImpuestoSat = objServicioDetalleFacturasServicioServicio.objeto_impuesto_sat;
					objServicioManoObraFacturasServicioServicio.intPrecioUnitario = intPrecioUnitario;
					objServicioManoObraFacturasServicioServicio.intDescuentoUnitario = intDescuentoUnitario;
					objServicioManoObraFacturasServicioServicio.intTasaCuotaIva = objServicioDetalleFacturasServicioServicio.tasa_cuota_iva;
					objServicioManoObraFacturasServicioServicio.intIvaUnitario = intIvaUnitario;
					objServicioManoObraFacturasServicioServicio.intTasaCuotaIeps = intTasaCuotaIeps;
					objServicioManoObraFacturasServicioServicio.intIepsUnitario = intIepsUnitario;

					//Agregar datos del servicio al objeto 
	       			objServiciosManoObraFacturasServicioServicio.setServicio(objServicioManoObraFacturasServicioServicio);

					//Incrementar acumulados
					intAcumPrecioMO += intSubtotal;
					intAcumSubtotalMO += intSubtotal;
					intAcumIvaMO += intImporteIva;
					intAcumIepsMO += intImporteIeps;
					intAcumTotalMO += intTotal;
			    }

			    /*
				*****************************************************************************************************************
				* REFACCIONES
				*****************************************************************************************************************
				*/
				//Hacer recorrido para obtener los detalles de las refacciones
				for (var intCon in objDetallesFacturasServicioServicio.getRefacciones()) 
			    {
			    	//Crear instancia temporal del objeto Detalles de la orden de reparación (o factura) consultada
					objRefaccionDetalleFacturasServicioServicio = new DetallesFacturasServicioServicio();
					//Asignar datos del detalle de refacciones corespondiente al indice
	            	objRefaccionDetalleFacturasServicioServicio = objDetallesFacturasServicioServicio.getRefaccion(intCon);
			    	//Crear instancia del objeto Refacciones de la factura (a guardar)
					objRefaccionFacturasServicioServicio = new RefaccionFacturasServicioServicio('', '', '', 
																										 '','', '', '', '',
																										 '', '', '', '', '', '');

			    	

			    	//Variables que se utilizan para asignar valores del detalle
		        	var intMonedaID =  intMonedaIDFactura;
		        	var strMoneda =   '';
		        	var intTipoCambio = intTipoCambioFactura;
		        	//Variable que se utiliza para asignar el tipo de cambio del día
		        	var intTipoCambioDia  = intTipoCambioFactura;
		        	var intCantidad = parseFloat(objRefaccionDetalleFacturasServicioServicio.cantidad);
		        	var intCantidadDevolucion = 0;
		        	

		        	//Si no existe id de la factura
		        	if($("#txtFacturaServicioID_facturas_servicio_servicio").val() == '')
		        	{
		        		//Asignar id de la moneda del detalle
		        		intMonedaID =  parseInt(objRefaccionDetalleFacturasServicioServicio.moneda_id);
		        		strMoneda =   objRefaccionDetalleFacturasServicioServicio.moneda;
		        		intTipoCambio =  parseFloat(objRefaccionDetalleFacturasServicioServicio.tipo_cambio);
		        		intCantidadDevolucion =  parseFloat(objRefaccionDetalleFacturasServicioServicio.cantidad_devolucion);
		        		//Decrementar cantidad de las entradas por devolución
		        		intCantidad = intCantidad - intCantidadDevolucion;

		        		//Si el tipo de moneda del detalle no corresponde a peso mexicano
						if(intMonedaID != intMonedaBaseIDFacturasServicioServicio)
						{
							//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
							get_tipo_cambio_detalle_facturas_servicio_servicio(intMonedaID);
							//Asignar tipo de cambio del día
							intTipoCambioDia  = $("#txtTipoCambioVenta_facturas_servicio_servicio").val();
						}

						//Si no existe tipo de cambio del día para la moneda del detalle
						if(intTipoCambioDia == '')
						{
							//Concatenar al mensaje la descripción de la moneda
							strMensaje += strMoneda;

							//Incrementar contador por cada registro
							intContadorErrores++;

							//Hacer un llamado a la función para mostrar mensaje de error
							mensaje_facturas_servicio_servicio('error', strMensaje);
						}
		        		
		        	}
			
					//Si no existen errores con respecto al tipo de cambio del día
					if(intContadorErrores == 0 && intCantidad > 0)
					{

						//Variables que se utilizan para asignar valores del detalle
						var intTasaCuotaIeps = objRefaccionDetalleFacturasServicioServicio.tasa_cuota_ieps;
			        	var intPorcentajeIva = objRefaccionDetalleFacturasServicioServicio.porcentaje_iva;
			        	var intPorcentajeIeps = objRefaccionDetalleFacturasServicioServicio.porcentaje_ieps;
			        	var intPrecioUnitario = parseFloat(objRefaccionDetalleFacturasServicioServicio.precio_unitario);
						
			        	//Variable que se utiliza para asignar el importe de iva
						var intImporteIva = 0;
			        	//Variable que se utiliza para asignar el iva unitario
						var intIvaUnitario = 0;
						//Variable que se utiliza para asignar el importe de ieps
						var intImporteIeps = 0;
						//Variable que se utiliza para asignar el ieps unitario
						var intIepsUnitario = 0;
						//Variable que se utiliza para asignar el descuento unitario
					    var intDescuentoUnitario = 0;
			        	//Variable que se utiliza para asignar el subtotal 
						var intSubtotal = 0;

					    //Convertir peso mexicano a tipo de cambio
						intPrecioUnitario = intPrecioUnitario / intTipoCambio;
						
						//Redondear cantidad a decimales
						intPrecioUnitario = intPrecioUnitario.toFixed(2);
						intPrecioUnitario = parseFloat(intPrecioUnitario);

						//Calcular subtotal
						intSubtotal = intCantidad * intPrecioUnitario;


						//Calcular importe de IVA
						intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
						//Redondear cantidad a dos decimales
					    intImporteIva = intImporteIva.toFixed(4);
					    intImporteIva = parseFloat(intImporteIva);

						//Si existe id de la tasa de cuota del IEPS
						if(intTasaCuotaIeps > 0)
						{
							//Calcular importe de IEPS
							intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
							//Redondear cantidad a dos decimales
					   	 	intImporteIeps = intImporteIeps.toFixed(4);
					   	 	intImporteIeps = parseFloat(intImporteIeps);
						}

						//Si el tipo de moneda de la factura corresponde a pesos mexicano
						if(intMonedaIDFactura == intMonedaBaseIDFacturasServicioServicio)
						{
							//Si el tipo de moneda del detalle es diferente a pesos mexicano
							if(intMonedaID !== intMonedaBaseIDFacturasServicioServicio)
							{
								//Convertir importes a tipo de cambio
								intPrecioUnitario = intPrecioUnitario * intTipoCambioDia;
								intSubtotal = intSubtotal * intTipoCambioDia;
								intImporteIva = intImporteIva * intTipoCambioDia;
								intImporteIeps = intImporteIeps * intTipoCambioDia;

							}

						}
						else
						{
							//Si el tipo de moneda del detalle corresponde a pesos mexicano
							if(intMonedaID === intMonedaBaseIDFacturasServicioServicio)
							{
								//Convertir importes a peso mexicano
								intPrecioUnitario = intPrecioUnitario / intTipoCambioDia;
								intSubtotal = intSubtotal / intTipoCambioDia;
								intImporteIva = intImporteIva / intTipoCambioDia;
								intImporteIeps = intImporteIeps / intTipoCambioDia;

							}
						}

						
						//Calcular importe total
						intTotal = intSubtotal + intImporteIva + intImporteIeps;

						//Calcular iva unitario
						intIvaUnitario =  intImporteIva / intCantidad;
						//Calcular ieps unitario
						intIepsUnitario = intImporteIeps / intCantidad;

						//Convertir importes a peso mexicano
						intPrecioUnitario = intPrecioUnitario * intTipoCambioFactura;
						intIvaUnitario = intIvaUnitario * intTipoCambioFactura;
						intIepsUnitario = intIepsUnitario * intTipoCambioFactura;

						//Redondear cantidad a decimales
						intIvaUnitario = intIvaUnitario.toFixed(4);
						intIvaUnitario = parseFloat(intIvaUnitario);

						
						//Redondear cantidad a decimales
						intIepsUnitario = intIepsUnitario.toFixed(4);
						intIepsUnitario = parseFloat(intIepsUnitario);


						//Asignar valores al objeto Refacciones de la factura
						objRefaccionFacturasServicioServicio.intRefaccionID = objRefaccionDetalleFacturasServicioServicio.refaccion_id;
						objRefaccionFacturasServicioServicio.strCodigo = objRefaccionDetalleFacturasServicioServicio.codigo;
						objRefaccionFacturasServicioServicio.strDescripcion = objRefaccionDetalleFacturasServicioServicio.descripcion;
						objRefaccionFacturasServicioServicio.strCodigoLinea = objRefaccionDetalleFacturasServicioServicio.codigo_linea;
						objRefaccionFacturasServicioServicio.strCodigoSat = objRefaccionDetalleFacturasServicioServicio.codigo_sat;
						objRefaccionFacturasServicioServicio.strUnidadSat = objRefaccionDetalleFacturasServicioServicio.unidad_sat;
						objRefaccionFacturasServicioServicio.strObjetoImpuestoSat = objRefaccionDetalleFacturasServicioServicio.objeto_impuesto_sat;
						objRefaccionFacturasServicioServicio.intCantidad = intCantidad;
						objRefaccionFacturasServicioServicio.intPrecioUnitario = intPrecioUnitario;
						objRefaccionFacturasServicioServicio.intDescuentoUnitario = intDescuentoUnitario;
						objRefaccionFacturasServicioServicio.intTasaCuotaIva = objRefaccionDetalleFacturasServicioServicio.tasa_cuota_iva;
						objRefaccionFacturasServicioServicio.intIvaUnitario = intIvaUnitario;
						objRefaccionFacturasServicioServicio.intTasaCuotaIeps = intTasaCuotaIeps;
						objRefaccionFacturasServicioServicio.intIepsUnitario = intIepsUnitario;

						//Agregar datos de la refacción al objeto 
		       			objRefaccionesFacturasServicioServicio.setRefaccion(objRefaccionFacturasServicioServicio);

						//Incrementar acumulados
						intAcumPrecioRef += intSubtotal;
						intAcumSubtotalRef += intSubtotal;
						intAcumIvaRef += intImporteIva;
						intAcumIepsRef += intImporteIeps;
						intAcumTotalRef += intTotal;

					}//Cierre de verificación de errores por inexistencia del tipo cambio del día

			     }//Cierre de for
				    
				
				
				/*
				*****************************************************************************************************************
				* TRABAJOS FORANEOS
				*****************************************************************************************************************
				*/

				//Hacer recorrido para obtener los detalles de los trabajos foráneos
			    for (var intCon in objDetallesFacturasServicioServicio.getTrabajosForaneos()) 
			    {
			    	//Crear instancia temporal del objeto Detalles de la orden de reparación (o factura) consultada
					objTrabajoForaneoDetalleFacturasServicioServicio = new DetallesFacturasServicioServicio();
					//Asignar datos del detalle del trabajo foráneo corespondiente al indice
	            	objTrabajoForaneoDetalleFacturasServicioServicio = objDetallesFacturasServicioServicio.getTrabajoForaneo(intCon);
			    	//Crear instancia del objeto Trabajo foráneo de la factura (a guardar)
					objTrabajoForaneoFacturasServicioServicio = new TrabajoForaneoFacturasServicioServicio('', '', '', 																				     '', '', '',                                                                                   '', '', '', 																				     '', '');

			    	//Variables que se utilizan para asignar valores del detalle
		        	var intMonedaID = intMonedaIDFactura;
		        	var strMoneda =   '';
		        	var intTipoCambio  = intTipoCambioFactura;
		        	//Variable que se utiliza para asignar el tipo de cambio del día
		        	var intTipoCambioDia  = intTipoCambioFactura;
		        	
		        	//Si no existe id de la factura
		        	if($("#txtFacturaServicioID_facturas_servicio_servicio").val() == '')
		        	{
		        		//Asignar id de la moneda del detalle
		        		intMonedaID =  parseInt(objTrabajoForaneoDetalleFacturasServicioServicio.moneda_id);
		        		strMoneda =   objTrabajoForaneoDetalleFacturasServicioServicio.moneda;
		        		intTipoCambio =  parseFloat(objTrabajoForaneoDetalleFacturasServicioServicio.tipo_cambio);

		        		//Si el tipo de moneda del detalle no corresponde a peso mexicano
						if(intMonedaID != intMonedaBaseIDFacturasServicioServicio)
						{
							//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
							get_tipo_cambio_detalle_facturas_servicio_servicio(intMonedaID);
							//Asignar tipo de cambio del día
							intTipoCambioDia  = $("#txtTipoCambioVenta_facturas_servicio_servicio").val();
						}

						//Si no existe tipo de cambio del día para la moneda del detalle
						if(intTipoCambioDia == '')
						{
							//Concatenar al mensaje la descripción de la moneda
							strMensaje += strMoneda;

							//Incrementar contador por cada registro
							intContadorErrores++;

							//Hacer un llamado a la función para mostrar mensaje de error
							mensaje_facturas_servicio_servicio('error', strMensaje);
						}
		        		
		        	}

				    //Si no existen errores con respecto al tipo de cambio del día
					if(intContadorErrores == 0)
					{
						//Variables que se utilizan para asignar valores del detalle
						var intCantidad = parseFloat(objTrabajoForaneoDetalleFacturasServicioServicio.cantidad);
						var intPrecioUnitario = parseFloat(objTrabajoForaneoDetalleFacturasServicioServicio.precio_unitario);
					    var intDescuentoUnitario = 0;
			        	var intPorcentajeIva = objTrabajoForaneoDetalleFacturasServicioServicio.porcentaje_iva;
			        	var intPorcentajeIeps = objTrabajoForaneoDetalleFacturasServicioServicio.porcentaje_ieps;
						var intTasaCuotaIeps = objTrabajoForaneoDetalleFacturasServicioServicio.tasa_cuota_ieps;
						var strTipoTasaCuotaIeps = objTrabajoForaneoDetalleFacturasServicioServicio.tipo_ieps;
						var strFactorTasaCuotaIeps = objTrabajoForaneoDetalleFacturasServicioServicio.factor_ieps;
						
			        	//Variable que se utiliza para asignar el importe de iva
						var intImporteIva = 0;
			        	//Variable que se utiliza para asignar el iva unitario
						var intIvaUnitario = 0;
						//Variable que se utiliza para asignar el importe de ieps
						var intImporteIeps = 0;
						//Variable que se utiliza para asignar el ieps unitario
						var intIepsUnitario = 0;
						
			        	//Variable que se utiliza para asignar el subtotal 
						var intSubtotal = 0;

					    //Convertir peso mexicano a tipo de cambio
						intPrecioUnitario = intPrecioUnitario / intTipoCambio;
						
						//Redondear cantidad a decimales
						intPrecioUnitario = intPrecioUnitario.toFixed(2);
						intPrecioUnitario = parseFloat(intPrecioUnitario);

						//Calcular subtotal
						intSubtotal = intCantidad * intPrecioUnitario;

						//Calcular importe de IVA
						intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
						//Redondear cantidad a dos decimales
					    intImporteIva = intImporteIva.toFixed(4);
					    intImporteIva = parseFloat(intImporteIva);

						//Si existe id de la tasa de cuota del IEPS
						if(intTasaCuotaIeps > 0)
						{
							//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
							if(strTipoTasaCuotaIeps === 'RANGO' && strFactorTasaCuotaIeps ==='Cuota')
							{
								//Limpiar contenido de las siguientes variables
								intTasaCuotaIeps =  '';
							}
							else
							{
								//Calcular importe de IEPS
								intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
								//Redondear cantidad a dos decimales
						   	 	intImporteIeps = intImporteIeps.toFixed(4);
						   	 	intImporteIeps = parseFloat(intImporteIeps);
							}
							
						}
						
						//Si el tipo de moneda de la factura corresponde a pesos mexicano
						if(intMonedaIDFactura == intMonedaBaseIDFacturasServicioServicio)
						{
							//Si el tipo de moneda del detalle es diferente a pesos mexicano
							if(intMonedaID !== intMonedaBaseIDFacturasServicioServicio)
							{
								//Convertir importes a tipo de cambio
								intPrecioUnitario = intPrecioUnitario * intTipoCambioDia;
								intSubtotal = intSubtotal * intTipoCambioDia;
								intImporteIva = intImporteIva * intTipoCambioDia;
								intImporteIeps = intImporteIeps * intTipoCambioDia;

							}

						}
						else
						{
							//Si el tipo de moneda del detalle corresponde a pesos mexicano
							if(intMonedaID === intMonedaBaseIDFacturasServicioServicio)
							{
								//Convertir importes a peso mexicano
								intPrecioUnitario = intPrecioUnitario / intTipoCambioDia;
								intSubtotal = intSubtotal / intTipoCambioDia;
								intImporteIva = intImporteIva / intTipoCambioDia;
								intImporteIeps = intImporteIeps / intTipoCambioDia;

							}
						}

						//Calcular importe total
						intTotal = intSubtotal + intImporteIva + intImporteIeps;

						//Calcular iva unitario
						intIvaUnitario =  intImporteIva / intCantidad;
						//Calcular ieps unitario
						intIepsUnitario = intImporteIeps / intCantidad;

						//Convertir importes a peso mexicano
						intPrecioUnitario = intPrecioUnitario * intTipoCambioFactura;
						intIvaUnitario = intIvaUnitario * intTipoCambioFactura;
						intIepsUnitario = intIepsUnitario * intTipoCambioFactura;

						//Redondear cantidad a decimales
						intIvaUnitario = intIvaUnitario.toFixed(4);
						intIvaUnitario = parseFloat(intIvaUnitario);

						//Redondear cantidad a decimales
						intIepsUnitario = intIepsUnitario.toFixed(4);
						intIepsUnitario = parseFloat(intIepsUnitario);

						//Asignar valores al objeto Trabajos foráneos de la factura
						objTrabajoForaneoFacturasServicioServicio.strConcepto = objTrabajoForaneoDetalleFacturasServicioServicio.concepto;
						objTrabajoForaneoFacturasServicioServicio.strCodigoSat = objTrabajoForaneoDetalleFacturasServicioServicio.codigo_sat;
						objTrabajoForaneoFacturasServicioServicio.strUnidadSat = objTrabajoForaneoDetalleFacturasServicioServicio.unidad_sat;
						objTrabajoForaneoFacturasServicioServicio.strObjetoImpuestoSat = objTrabajoForaneoDetalleFacturasServicioServicio.objeto_impuesto_sat;
						objTrabajoForaneoFacturasServicioServicio.intCantidad = intCantidad;
						objTrabajoForaneoFacturasServicioServicio.intPrecioUnitario = intPrecioUnitario;
						objTrabajoForaneoFacturasServicioServicio.intDescuentoUnitario = intDescuentoUnitario;
						objTrabajoForaneoFacturasServicioServicio.intTasaCuotaIva = objTrabajoForaneoDetalleFacturasServicioServicio.tasa_cuota_iva;
						objTrabajoForaneoFacturasServicioServicio.intIvaUnitario = intIvaUnitario;
						objTrabajoForaneoFacturasServicioServicio.intTasaCuotaIeps = intTasaCuotaIeps;
						objTrabajoForaneoFacturasServicioServicio.intIepsUnitario = intIepsUnitario;

						//Agregar datos del trabajo foráneo al objeto 
		       			objTrabajosForaneosFacturasServicioServicio.setTrabajoForaneo(objTrabajoForaneoFacturasServicioServicio);

						//Incrementar acumulados
						intAcumPrecioTF += intSubtotal;
						intAcumSubtotalTF += intSubtotal;
						intAcumIvaTF += intImporteIva;
						intAcumIepsTF += intImporteIeps;
						intAcumTotalTF += intTotal;

					}//Cierre de verificación de errores por inexistencia del tipo cambio del día

			    }//Cierre de for


			    /*
				*****************************************************************************************************************
				* OTROS
				*****************************************************************************************************************
				*/
				//Hacer recorrido para obtener los detalles de otros servicios
				for (var intCon in objDetallesFacturasServicioServicio.getOtros()) 
			    {
			    	//Crear instancia temporal del objeto Detalles de la orden de reparación (o factura) consultada
					objOtroDetalleFacturasServicioServicio = new DetallesFacturasServicioServicio();
					//Asignar datos del detalle de otro servicio corespondiente al indice
	            	objOtroDetalleFacturasServicioServicio = objDetallesFacturasServicioServicio.getOtro(intCon);
	            	//Crear instancia del objeto Otro servicio de la factura (a guardar)
					objOtroFacturasServicioServicio = new OtroFacturasServicioServicio('', '', '', 																				     '', '', '',                                                                     '', '', '', '', '');


					//Variables que se utilizan para asignar valores del detalle
		        	var intMonedaID = intMonedaIDFactura;
		        	var strMoneda =   '';
		        	var intTipoCambio  = intTipoCambioFactura;
		        	//Variable que se utiliza para asignar el tipo de cambio del día
		        	var intTipoCambioDia  = intTipoCambioFactura;


		        	//Variables que se utilizan para asignar valores del detalle
					var intCantidad = parseFloat(objOtroDetalleFacturasServicioServicio.cantidad);
					var intPrecioUnitario = parseFloat(objOtroDetalleFacturasServicioServicio.precio_unitario);
				    var intDescuentoUnitario = parseFloat(objOtroDetalleFacturasServicioServicio.descuento_unitario);
		        	var intPorcentajeIva = objOtroDetalleFacturasServicioServicio.porcentaje_iva;
		        	var intPorcentajeIeps = objOtroDetalleFacturasServicioServicio.porcentaje_ieps;
		        	var intTasaCuotaIeps  = objOtroDetalleFacturasServicioServicio.tasa_cuota_ieps;
				
		        	//Variable que se utiliza para asignar el importe de iva
					var intImporteIva = 0;
		        	//Variable que se utiliza para asignar el iva unitario
					var intIvaUnitario = 0;
					//Variable que se utiliza para asignar el importe de ieps
					var intImporteIeps = 0;
					//Variable que se utiliza para asignar el ieps unitario
					var intIepsUnitario = 0;
		        	//Variable que se utiliza para asignar el subtotal 
					var intSubtotal = 0;
					//Variable que se utiliza para asignar el precio 
					var intPrecio = 0;
					//Variable que se utiliza para asignar el descuento 
	       			var intDescuento = 0;

				    //Convertir peso mexicano a tipo de cambio
					intPrecioUnitario = intPrecioUnitario / intTipoCambio;
					intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
					
					//Redondear cantidad a x decimales
					intPrecioUnitario = intPrecioUnitario.toFixed(2);
					intPrecioUnitario = parseFloat(intPrecioUnitario);

					intDescuentoUnitario = intDescuentoUnitario.toFixed(2);
					intDescuentoUnitario = parseFloat(intDescuentoUnitario);

					//Calcular subtotal
					intSubtotal = intCantidad * intPrecioUnitario;


					//Calcular importe de IVA
					intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
					//Redondear cantidad a dos decimales
				    intImporteIva = intImporteIva.toFixed(4);
				    intImporteIva = parseFloat(intImporteIva);

					//Si existe id de la tasa de cuota del IEPS
					if(intTasaCuotaIeps > 0)
					{
						//Calcular importe de IEPS
						intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
						//Redondear cantidad a dos decimales
				   	 	intImporteIeps = intImporteIeps.toFixed(4);
				   	 	intImporteIeps = parseFloat(intImporteIeps);
					}

					//Si el tipo de moneda de la factura corresponde a pesos mexicano
					if(intMonedaIDFactura == intMonedaBaseIDFacturasServicioServicio)
					{
						//Si el tipo de moneda del detalle es diferente a pesos mexicano
						if(intMonedaID !== intMonedaBaseIDFacturasServicioServicio)
						{
							//Convertir importes a tipo de cambio
							intPrecioUnitario = intPrecioUnitario * intTipoCambioDia;
							intDescuentoUnitario = intDescuentoUnitario * intTipoCambioDia;
							intSubtotal = intSubtotal * intTipoCambioDia;
							intImporteIva = intImporteIva * intTipoCambioDia;
							intImporteIeps = intImporteIeps * intTipoCambioDia;

						}

					}
					else
					{
						//Si el tipo de moneda del detalle corresponde a pesos mexicano
						if(intMonedaID === intMonedaBaseIDFacturasServicioServicio)
						{
							//Convertir importes a peso mexicano
							intPrecioUnitario = intPrecioUnitario / intTipoCambioDia;
							intDescuentoUnitario = intDescuentoUnitario / intTipoCambioDia;
							intSubtotal = intSubtotal / intTipoCambioDia;
							intImporteIva = intImporteIva / intTipoCambioDia;
							intImporteIeps = intImporteIeps / intTipoCambioDia;

						}
					}

					
					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;

					//Asignar el importe del subtotal
	       			intPrecio = intSubtotal;

					//Si existe importe del descuento
					if(intDescuentoUnitario > 0)
					{
						//Incrementar precio unitario
						intPrecio = intPrecioUnitario + intDescuentoUnitario;
						//Calcular precio
						intPrecio = intPrecio * intCantidad;
						//Calcular descuento
						intDescuento = intDescuentoUnitario * intCantidad;
					}


					//Calcular iva unitario
					intIvaUnitario =  intImporteIva / intCantidad;
					//Calcular ieps unitario
					intIepsUnitario = intImporteIeps / intCantidad;

					//Convertir importes a peso mexicano
					intPrecioUnitario = intPrecioUnitario * intTipoCambioFactura;
					intDescuentoUnitario = intDescuentoUnitario * intTipoCambioFactura;
					intIvaUnitario = intIvaUnitario * intTipoCambioFactura;
					intIepsUnitario = intIepsUnitario * intTipoCambioFactura;

					//Redondear cantidad a x decimales
				    intPrecioUnitario = intPrecioUnitario.toFixed(2);
					intPrecioUnitario = parseFloat(intPrecioUnitario);

					intDescuentoUnitario = intDescuentoUnitario.toFixed(2);
					intDescuentoUnitario = parseFloat(intDescuentoUnitario);

					intIvaUnitario = intIvaUnitario.toFixed(4);
					intIvaUnitario = parseFloat(intIvaUnitario);

					intIepsUnitario = intIepsUnitario.toFixed(4);
					intIepsUnitario = parseFloat(intIepsUnitario);


					//Asignar valores al objeto Otros servicios de la factura
					objOtroFacturasServicioServicio.strConcepto = objOtroDetalleFacturasServicioServicio.concepto;
					objOtroFacturasServicioServicio.strCodigoSat = objOtroDetalleFacturasServicioServicio.codigo_sat;
					objOtroFacturasServicioServicio.strUnidadSat = objOtroDetalleFacturasServicioServicio.unidad_sat;
					objOtroFacturasServicioServicio.strObjetoImpuestoSat = objOtroDetalleFacturasServicioServicio.objeto_impuesto_sat;
					objOtroFacturasServicioServicio.intCantidad = intCantidad;
					objOtroFacturasServicioServicio.intPrecioUnitario = intPrecioUnitario;
					objOtroFacturasServicioServicio.intDescuentoUnitario = intDescuentoUnitario;
					objOtroFacturasServicioServicio.intTasaCuotaIva = objOtroDetalleFacturasServicioServicio.tasa_cuota_iva;
					objOtroFacturasServicioServicio.intIvaUnitario = intIvaUnitario;
					objOtroFacturasServicioServicio.intTasaCuotaIeps = intTasaCuotaIeps;
					objOtroFacturasServicioServicio.intIepsUnitario = intIepsUnitario;

					//Agregar datos del otro servicio al objeto 
	       			objOtrosFacturasServicioServicio.setOtro(objOtroFacturasServicioServicio);
	       			
					//Incrementar acumulados
					intAcumPrecioOtros += intPrecio;
					intAcumSubtotalOtros += intSubtotal;
					intAcumDescuentoOtros += intDescuento;
					intAcumIvaOtros += intImporteIva;
					intAcumIepsOtros += intImporteIeps;
					intAcumTotalOtros += intTotal;

			    }//Cierre de for


		        //Si no existen errores con respecto al tipo de cambio del día
		        if(intContadorErrores == 0 &&  (intAcumPrecioMO > 0 || intAcumPrecioRef > 0 || intAcumPrecioTF > 0 
		        	|| intAcumPrecioOtros > 0 || intGastosServicioTotal > 0))
		        {
		        	//Obtenemos el objeto de la tabla detalles
		        	var objTabla = document.getElementById('dg_detalles_facturas_servicio_servicio').getElementsByTagName('tbody')[0];

					/*
					*****************************************************************************************************************
					* MANO DE OBRA
					*****************************************************************************************************************
					*/
					//Asignar descripción de la referencia
				    strDescripcion = 'MANO DE OBRA';
				   
					//Si existen detalles de mano de obra
			        if(intAcumPrecioMO > 0)
			        {    
			        	//Recuperar acumulados de la mano de obra
			        	intAcumPrecio = intAcumPrecioMO;
						intAcumDescuento = intAcumDescuentoMO;
						intAcumSubtotal = intAcumSubtotalMO;
						intAcumIva = intAcumIvaMO;
						intAcumIeps = intAcumIepsMO;
						intAcumTotal = intAcumTotalMO;
			        }

			        //Cambiar cantidad a  formato moneda (a visualizar)
			        intAcumPrecio = formatMoney(intAcumPrecio, 2, '');
			        intAcumDescuento = formatMoney(intAcumDescuento, 2, '');
			        intAcumSubtotal = formatMoney(intAcumSubtotal, 2, '');
			        intAcumIva = formatMoney(intAcumIva, 4, '');
			        intAcumIeps = formatMoney(intAcumIeps, 4, '');
			        intAcumTotal = formatMoney(intAcumTotal, 4, '');

			        //Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaDescripcion = objRenglon.insertCell(0);
					var objCeldaAcumPrecio = objRenglon.insertCell(1);
					var objCeldaAcumDescuento = objRenglon.insertCell(2);
					var objCeldaAcumSubtotal = objRenglon.insertCell(3);
					var objCeldaAcumIva = objRenglon.insertCell(4);
					var objCeldaAcumIeps = objRenglon.insertCell(5);
					var objCeldaAcumTotal = objRenglon.insertCell(6);
			        //Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', 'mano_obra'); 
					objCeldaDescripcion.setAttribute('class', 'movil d1');
					objCeldaDescripcion.innerHTML = strDescripcion;
					objCeldaAcumPrecio.setAttribute('class', 'movil d2');
					objCeldaAcumPrecio.innerHTML =  intAcumPrecio;
					objCeldaAcumDescuento.setAttribute('class', 'movil d3');
					objCeldaAcumDescuento.innerHTML =  intAcumDescuento;
					objCeldaAcumSubtotal.setAttribute('class', 'movil d4');
					objCeldaAcumSubtotal.innerHTML =  intAcumSubtotal;
					objCeldaAcumIva.setAttribute('class', 'movil d5');
					objCeldaAcumIva.innerHTML = intAcumIva;
					objCeldaAcumIeps.setAttribute('class', 'movil d6');
					objCeldaAcumIeps.innerHTML =  intAcumIeps;
					objCeldaAcumTotal.setAttribute('class', 'movil d7');
					objCeldaAcumTotal.innerHTML =  intAcumTotal;

					/*
					*****************************************************************************************************************
					* REFACCIONES
					*****************************************************************************************************************
					*/
					//Inicializar variables
					intAcumPrecio = 0;
					intAcumDescuento = 0;
					intAcumSubtotal = 0;
					intAcumIva = 0;
					intAcumIeps = 0;
					intAcumTotal = 0;

					//Asignar descripción de la referencia
				    strDescripcion = 'REFACCIONES';

				    //Si existen detalles de refacciones
			        if(intAcumPrecioRef > 0)
			        {    
			        	//Recuperar acumulados de las refacciones
			        	intAcumPrecio = intAcumPrecioRef;
						intAcumDescuento = intAcumDescuentoRef;
						intAcumSubtotal = intAcumSubtotalRef;
						intAcumIva = intAcumIvaRef;
						intAcumIeps = intAcumIepsRef;
						intAcumTotal = intAcumTotalRef;
			        }

			        
			        //Cambiar cantidad a  formato moneda (a visualizar)
			        intAcumPrecio = formatMoney(intAcumPrecio, 2, '');
			        intAcumDescuento = formatMoney(intAcumDescuento, 2, '');
			        intAcumSubtotal = formatMoney(intAcumSubtotal, 2, '');
			        intAcumIva = formatMoney(intAcumIva, 4, '');
			        intAcumIeps = formatMoney(intAcumIeps, 4, '');
			        intAcumTotal = formatMoney(intAcumTotal, 4, '');


			        //Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaDescripcion = objRenglon.insertCell(0);
					var objCeldaAcumPrecio = objRenglon.insertCell(1);
					var objCeldaAcumDescuento = objRenglon.insertCell(2);
					var objCeldaAcumSubtotal = objRenglon.insertCell(3);
					var objCeldaAcumIva = objRenglon.insertCell(4);
					var objCeldaAcumIeps = objRenglon.insertCell(5);
					var objCeldaAcumTotal = objRenglon.insertCell(6);
			        //Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', 'refacciones'); 
					objCeldaDescripcion.setAttribute('class', 'movil d1');
					objCeldaDescripcion.innerHTML = strDescripcion;
					objCeldaAcumPrecio.setAttribute('class', 'movil d2');
					objCeldaAcumPrecio.innerHTML =  intAcumPrecio;
					objCeldaAcumDescuento.setAttribute('class', 'movil d3');
					objCeldaAcumDescuento.innerHTML =  intAcumDescuento;
					objCeldaAcumSubtotal.setAttribute('class', 'movil d4');
					objCeldaAcumSubtotal.innerHTML =  intAcumSubtotal;
					objCeldaAcumIva.setAttribute('class', 'movil d5');
					objCeldaAcumIva.innerHTML = intAcumIva;
					objCeldaAcumIeps.setAttribute('class', 'movil d6');
					objCeldaAcumIeps.innerHTML =  intAcumIeps;
					objCeldaAcumTotal.setAttribute('class', 'movil d7');
					objCeldaAcumTotal.innerHTML =  intAcumTotal;


					/*
					*****************************************************************************************************************
					* TRABAJOS FORANEOS
					*****************************************************************************************************************
					*/
					//Inicializar variables
					intAcumPrecio = 0;
					intAcumDescuento = 0;
					intAcumSubtotal = 0;
					intAcumIva = 0;
					intAcumIeps = 0;
					intAcumTotal = 0;

					//Asignar descripción de la referencia
				    strDescripcion = 'TRABAJOS FORÁNEOS';

				    //Si existen detalles de trabajos foráneos
			        if(intAcumPrecioTF != null)
			        {    
			        	//Recuperar acumulados de los trabajos foráneos
			        	intAcumPrecio = intAcumPrecioTF;
						intAcumDescuento = intAcumDescuentoTF;
						intAcumSubtotal = intAcumSubtotalTF;
						intAcumIva = intAcumIvaTF;
						intAcumIeps = intAcumIepsTF;
						intAcumTotal = intAcumTotalTF;
			        }

			        //Cambiar cantidad a  formato moneda (a visualizar)
			        intAcumPrecio = formatMoney(intAcumPrecio, 2, '');
			        intAcumDescuento = formatMoney(intAcumDescuento, 2, '');
			        intAcumSubtotal = formatMoney(intAcumSubtotal, 2, '');
			        intAcumIva = formatMoney(intAcumIva, 4, '');
			        intAcumIeps = formatMoney(intAcumIeps, 4, '');
			        intAcumTotal = formatMoney(intAcumTotal, 4, '');

			        //Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaDescripcion = objRenglon.insertCell(0);
					var objCeldaAcumPrecio = objRenglon.insertCell(1);
					var objCeldaAcumDescuento = objRenglon.insertCell(2);
					var objCeldaAcumSubtotal = objRenglon.insertCell(3);
					var objCeldaAcumIva = objRenglon.insertCell(4);
					var objCeldaAcumIeps = objRenglon.insertCell(5);
					var objCeldaAcumTotal = objRenglon.insertCell(6);
			        //Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', 'trabajos_foraneos'); 
					objCeldaDescripcion.setAttribute('class', 'movil d1');
					objCeldaDescripcion.innerHTML = strDescripcion;
					objCeldaAcumPrecio.setAttribute('class', 'movil d2');
					objCeldaAcumPrecio.innerHTML =  intAcumPrecio;
					objCeldaAcumDescuento.setAttribute('class', 'movil d3');
					objCeldaAcumDescuento.innerHTML =  intAcumDescuento;
					objCeldaAcumSubtotal.setAttribute('class', 'movil d4');
					objCeldaAcumSubtotal.innerHTML =  intAcumSubtotal;
					objCeldaAcumIva.setAttribute('class', 'movil d5');
					objCeldaAcumIva.innerHTML = intAcumIva;
					objCeldaAcumIeps.setAttribute('class', 'movil d6');
					objCeldaAcumIeps.innerHTML =  intAcumIeps;
					objCeldaAcumTotal.setAttribute('class', 'movil d7');
					objCeldaAcumTotal.innerHTML =  intAcumTotal;


					/*
					*****************************************************************************************************************
					* GASTOS DE SERVICIO
					*****************************************************************************************************************
					*/
					//Inicializar variables
					intAcumPrecio = 0;
					intAcumDescuento = 0;
					intAcumSubtotal = 0;
					intAcumIva = 0;
					intAcumIeps = 0;
					intAcumTotal = 0;

					//Asignar descripción de la referencia
				    strDescripcion = 'GASTOS DE SERVICIO';
				   
					//Si existen gastos de servicio
			        if(intGastosServicioTotal > 0)
			        {    
			        	//Recuperar acumulados del gasto de servicio
			        	intAcumPrecio = intGastosServicioSubtotal;
						intAcumDescuento = 0 ;
						intAcumSubtotal = intGastosServicioSubtotal;
						intAcumIva = intGastosServicioIva;
						intAcumIeps = 0;
						intAcumTotal = intGastosServicioTotal;
			        }

			        //Cambiar cantidad a  formato moneda (a visualizar)
			        intAcumPrecio = formatMoney(intAcumPrecio, 2, '');
			        intAcumDescuento = formatMoney(intAcumDescuento, 2, '');
			        intAcumSubtotal = formatMoney(intAcumSubtotal, 2, '');
			        intAcumIva = formatMoney(intAcumIva, 4, '');
			        intAcumIeps = formatMoney(intAcumIeps, 4, '');
			        intAcumTotal = formatMoney(intAcumTotal, 4, '');

			        //Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaDescripcion = objRenglon.insertCell(0);
					var objCeldaAcumPrecio = objRenglon.insertCell(1);
					var objCeldaAcumDescuento = objRenglon.insertCell(2);
					var objCeldaAcumSubtotal = objRenglon.insertCell(3);
					var objCeldaAcumIva = objRenglon.insertCell(4);
					var objCeldaAcumIeps = objRenglon.insertCell(5);
					var objCeldaAcumTotal = objRenglon.insertCell(6);
			        //Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', 'gastos_servicio'); 
					objCeldaDescripcion.setAttribute('class', 'movil d1');
					objCeldaDescripcion.innerHTML = strDescripcion;
					objCeldaAcumPrecio.setAttribute('class', 'movil d2');
					objCeldaAcumPrecio.innerHTML =  intAcumPrecio;
					objCeldaAcumDescuento.setAttribute('class', 'movil d3');
					objCeldaAcumDescuento.innerHTML =  intAcumDescuento;
					objCeldaAcumSubtotal.setAttribute('class', 'movil d4');
					objCeldaAcumSubtotal.innerHTML =  intAcumSubtotal;
					objCeldaAcumIva.setAttribute('class', 'movil d5');
					objCeldaAcumIva.innerHTML = intAcumIva;
					objCeldaAcumIeps.setAttribute('class', 'movil d6');
					objCeldaAcumIeps.innerHTML =  intAcumIeps;
					objCeldaAcumTotal.setAttribute('class', 'movil d7');
					objCeldaAcumTotal.innerHTML =  intAcumTotal;


					/*
					*****************************************************************************************************************
					* OTROS
					*****************************************************************************************************************
					*/
					//Inicializar variables
					intAcumPrecio = 0;
					intAcumDescuento = 0;
					intAcumSubtotal = 0;
					intAcumIva = 0;
					intAcumIeps = 0;
					intAcumTotal = 0;

					//Asignar descripción de la referencia
				    strDescripcion = 'OTROS';

				    //Si existen detalles de otros servicios
			        if(intAcumPrecioOtros > 0)
			        {    
			        	//Recuperar acumulados de otros servicios
			        	intAcumPrecio = intAcumPrecioOtros;
						intAcumDescuento = intAcumDescuentoOtros;
						intAcumSubtotal = intAcumSubtotalOtros;
						intAcumIva = intAcumIvaOtros;
						intAcumIeps = intAcumIepsOtros;
						intAcumTotal = intAcumTotalOtros;
			        }

			        
			        //Cambiar cantidad a  formato moneda (a visualizar)
			        intAcumPrecio = formatMoney(intAcumPrecio, 2, '');
			        intAcumDescuento = formatMoney(intAcumDescuento, 2, '');
			        intAcumSubtotal = formatMoney(intAcumSubtotal, 2, '');
			        intAcumIva = formatMoney(intAcumIva, 4, '');
			        intAcumIeps = formatMoney(intAcumIeps, 4, '');
			        intAcumTotal = formatMoney(intAcumTotal, 4, '');


			        //Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaDescripcion = objRenglon.insertCell(0);
					var objCeldaAcumPrecio = objRenglon.insertCell(1);
					var objCeldaAcumDescuento = objRenglon.insertCell(2);
					var objCeldaAcumSubtotal = objRenglon.insertCell(3);
					var objCeldaAcumIva = objRenglon.insertCell(4);
					var objCeldaAcumIeps = objRenglon.insertCell(5);
					var objCeldaAcumTotal = objRenglon.insertCell(6);
			        //Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', 'otros'); 
					objCeldaDescripcion.setAttribute('class', 'movil d1');
					objCeldaDescripcion.innerHTML = strDescripcion;
					objCeldaAcumPrecio.setAttribute('class', 'movil d2');
					objCeldaAcumPrecio.innerHTML =  intAcumPrecio;
					objCeldaAcumDescuento.setAttribute('class', 'movil d3');
					objCeldaAcumDescuento.innerHTML =  intAcumDescuento;
					objCeldaAcumSubtotal.setAttribute('class', 'movil d4');
					objCeldaAcumSubtotal.innerHTML =  intAcumSubtotal;
					objCeldaAcumIva.setAttribute('class', 'movil d5');
					objCeldaAcumIva.innerHTML = intAcumIva;
					objCeldaAcumIeps.setAttribute('class', 'movil d6');
					objCeldaAcumIeps.innerHTML =  intAcumIeps;
					objCeldaAcumTotal.setAttribute('class', 'movil d7');
					objCeldaAcumTotal.innerHTML =  intAcumTotal;


					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_detalles_facturas_servicio_servicio();
		            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
					var intFilas = $("#dg_detalles_facturas_servicio_servicio tr").length - 2;
					$('#numElementos_detalles_facturas_servicio_servicio').html(intFilas);
					$('#txtNumDetalles_facturas_servicio_servicio').val(intFilas);
		        }

			}//Cierre de verificación del tipo de cambio
			
		}


	    //Función para calcular totales de la tabla
		function calcular_totales_detalles_facturas_servicio_servicio()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_facturas_servicio_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));

			}

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, 2, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 2, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, 4, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, 4, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, 4, '');

			//Asignar los valores
			$('#acumDescuento_detalles_facturas_servicio_servicio').html(intAcumDescuento);
			$('#acumSubtotal_detalles_facturas_servicio_servicio').html(intAcumSubtotal);
			$('#acumIva_detalles_facturas_servicio_servicio').html(intAcumIva);
			$('#acumIeps_detalles_facturas_servicio_servicio').html(intAcumIeps);
			$('#acumTotal_detalles_facturas_servicio_servicio').html(intAcumTotal);
		}

		/*******************************************************************************************************************
		Funciones de la tabla CFDI relacionados
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_cfdi_relacionados_facturas_servicio_servicio(tipoAccion, estatus)
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Si se cumple la sentencia
			if(estatus == '' || estatus == 'TIMBRAR')
			{
				strAccionesTabla = "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_cfdi_relacionados_facturas_servicio_servicio(this)'>" + 
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
							intReferenciaID: $('#txtFacturaServicioID_facturas_servicio_servicio').val(),
							strTipoReferencia: strTipoReferenciaFacturasServicioServicio
						},
						function(data){

							//Mostramos los CFDI´s relacionados (facturas seleccionadas)
				           	for (var intCon in data.rows) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_cfdi_relacionados_facturas_servicio_servicio').getElementsByTagName('tbody')[0];

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

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', strDetalleID);
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
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
								objCeldaReferenciaID.innerHTML =  data.rows[intCon].referencia_id;

				            }

				            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
							var intFilas = $("#dg_cfdi_relacionados_facturas_servicio_servicio tr").length - 1;
							$('#numElementos_cfdi_relacionados_facturas_servicio_servicio').html(intFilas);
							$('#txtNumCfdiRelacionados_facturas_servicio_servicio').val(intFilas);
						},
				'json');
			}
			else
			{
				//Mostramos los CFDI´s relacionados (facturas seleccionadas)
				for (var intCon in objCfdisRelacionadosFacturasServicioServicio.getCfdis()) 
	            {
	            	//Crear instancia del objeto CFDI a relacionar 
	            	objCfdiRelacionarFacturasServicioServicio = new CfdiRelacionarFacturasServicioServicio();
	            	//Asignar datos del CFDI corespondiente al indice
	            	objCfdiRelacionarFacturasServicioServicio = objCfdisRelacionadosFacturasServicioServicio.getCfdi(intCon);
	            	
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_cfdi_relacionados_facturas_servicio_servicio').getElementsByTagName('tbody')[0];

					//Variable que se utiliza para asignar el id del detalle
					var strDetalleID =  objCfdiRelacionarFacturasServicioServicio.intReferenciaID+'_'+objCfdiRelacionarFacturasServicioServicio.strTipoReferencia;

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
						objCeldaCliente.innerHTML = objCfdiRelacionarFacturasServicioServicio.strCliente;
						objCeldaFolio.setAttribute('class', 'movil c2');
						objCeldaFolio.innerHTML = objCfdiRelacionarFacturasServicioServicio.strFolio;
						objCeldaFecha.setAttribute('class', 'movil c3');
						objCeldaFecha.innerHTML = objCfdiRelacionarFacturasServicioServicio.dteFecha;
						objCeldaModulo.setAttribute('class', 'movil c4');
						objCeldaModulo.innerHTML = objCfdiRelacionarFacturasServicioServicio.strTipoReferencia;
						objCeldaUuid.setAttribute('class', 'movil c5');
						objCeldaUuid.innerHTML =  objCfdiRelacionarFacturasServicioServicio.strUuid;
						objCeldaImporte.setAttribute('class', 'movil c6');
						objCeldaImporte.innerHTML = objCfdiRelacionarFacturasServicioServicio.intImporte;
						objCeldaAcciones.setAttribute('class', 'td-center movil c7');
						objCeldaAcciones.innerHTML = strAccionesTabla;
						objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
						objCeldaReferenciaID.innerHTML = objCfdiRelacionarFacturasServicioServicio.intReferenciaID;
					}
	            }

	            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
				var intFilas = $("#dg_cfdi_relacionados_facturas_servicio_servicio tr").length - 1;
				$('#numElementos_cfdi_relacionados_facturas_servicio_servicio').html(intFilas);
				$('#txtNumCfdiRelacionados_facturas_servicio_servicio').val(intFilas);
			}
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_cfdi_relacionados_facturas_servicio_servicio(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_cfdi_relacionados_facturas_servicio_servicio").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
			var intFilas = $("#dg_cfdi_relacionados_facturas_servicio_servicio tr").length - 1;
			$('#numElementos_cfdi_relacionados_facturas_servicio_servicio').html(intFilas);
			$('#txtNumCfdiRelacionados_facturas_servicio_servicio').val(intFilas);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Facturas
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_facturas_servicio_servicio').numeric();
			$('#txtPrecio_facturas_servicio_servicio').numeric();
        	$('#txtPorcentajeDescuento_facturas_servicio_servicio').numeric();
        	$('#txtPorcentajeIva_facturas_servicio_servicio').numeric();
        	$('#txtPorcentajeIeps_facturas_servicio_servicio').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_facturas_servicio_servicio').blur(function(){
                $('.tipo-cambio_facturas_servicio_servicio').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_facturas_servicio_servicio').blur(function(){
				$('.moneda_facturas_servicio_servicio').formatCurrency({ roundToDecimalPlace: 6 });
			});


			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_facturas_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});

			//Calcular fecha de vencimiento cuando cambie la fecha
			$('#dteFecha_facturas_servicio_servicio').on('dp.change', function (e) {
             	//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_facturas_servicio_servicio();
			});

			//Asignar tipo de cambio del día cuando cambie la opción del combobox
	        $('#cmbMonedaID_facturas_servicio_servicio').change(function(e){   
	            //Dependiendo del id de la moneda regresar tipo de cambio del día
              	if(parseInt($('#cmbMonedaID_facturas_servicio_servicio').val()) === intMonedaBaseIDFacturasServicioServicio)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_facturas_servicio_servicio").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_facturas_servicio_servicio').val(intTipoCambioMonedaBaseFacturasServicioServicio);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_facturas_servicio_servicio').formatCurrency({ roundToDecimalPlace: 4 });
					//Habilitar caja de texto
					$("#txtOrdenReparacion_facturas_servicio_servicio").removeAttr('disabled');
					//Hacer llamado a la función  para cargar los detalles del registro en el grid
	           	 	agregar_renglones_acumulados_orden_reparacion_facturas_servicio_servicio();
             	}
             	else
             	{
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_facturas_servicio_servicio();
             	}

             	
             	
	        });

		    //Autocomplete para recuperar los datos de una orden de reparación
	        $('#txtOrdenReparacion_facturas_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtOrdenReparacionID_facturas_servicio_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos de la orden de reparación
	               inicializar_orden_reparacion_facturas_servicio_servicio();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/ordenes_reparacion/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strEstatus: 'FINALIZADO'
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
		              $('#txtOrdenReparacionID_facturas_servicio_servicio').val(ui.item.data);
		              //Hacer un llamado a la función para regresar los datos de la orden de reparación
		              get_datos_orden_reparacion_facturas_servicio_servicio();
	          	 }
	             else
	             {
	             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				     mensaje_facturas_servicio_servicio('error_regimen_fiscal', '', 'txtOrdenReparacion_facturas_servicio_servicio');
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
	        
	      	 //Verificar que exista id de la orden de reparación cuando pierda el enfoque la caja de texto
	        $('#txtOrdenReparacion_facturas_servicio_servicio').focusout(function(e){
	            //Si no existe id de la orden de reparación
	            if($('#txtOrdenReparacionID_facturas_servicio_servicio').val() == '' ||
	               $('#txtOrdenReparacion_facturas_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtOrdenReparacionID_facturas_servicio_servicio').val('');
	               $('#txtOrdenReparacion_facturas_servicio_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos de la orden de reparación
	               inicializar_orden_reparacion_facturas_servicio_servicio();
	            }

	        });

		    //Autocomplete para recuperar los datos de una estrategia
	        $('#txtEstrategia_facturas_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEstrategiaID_facturas_servicio_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/estrategias/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: intModuloIDFacturasServicioServicio
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtEstrategiaID_facturas_servicio_servicio').val(ui.item.data);
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
	        $('#txtEstrategia_facturas_servicio_servicio').focusout(function(e){
	            //Si no existe id de la estrategia
	            if($('#txtEstrategiaID_facturas_servicio_servicio').val() == '' ||
	               $('#txtEstrategia_facturas_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEstrategiaID_facturas_servicio_servicio').val('');
	               $('#txtEstrategia_facturas_servicio_servicio').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una forma de pago
	        $('#txtFormaPago_facturas_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtFormaPagoID_facturas_servicio_servicio').val('');
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
	             $('#txtFormaPagoID_facturas_servicio_servicio').val(ui.item.data);
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
	        $('#txtFormaPago_facturas_servicio_servicio').focusout(function(e){
	            //Si no existe id de la forma de pago
	            if($('#txtFormaPagoID_facturas_servicio_servicio').val() == '' ||
	               $('#txtFormaPago_facturas_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtFormaPagoID_facturas_servicio_servicio').val('');
	               $('#txtFormaPago_facturas_servicio_servicio').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un método de pago
	        $('#txtMetodoPago_facturas_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMetodoPagoID_facturas_servicio_servicio').val('');
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
	             $('#txtMetodoPagoID_facturas_servicio_servicio').val(ui.item.data);
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
	        $('#txtMetodoPago_facturas_servicio_servicio').focusout(function(e){
	            //Si no existe id del método de pago
	            if($('#txtMetodoPagoID_facturas_servicio_servicio').val() == '' ||
	               $('#txtMetodoPago_facturas_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMetodoPagoID_facturas_servicio_servicio').val('');
	               $('#txtMetodoPago_facturas_servicio_servicio').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un uso del CFDI
	        $('#txtUsoCfdi_facturas_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtUsoCfdiID_facturas_servicio_servicio').val('');
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
	             $('#txtUsoCfdiID_facturas_servicio_servicio').val(ui.item.data);
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
	        $('#txtUsoCfdi_facturas_servicio_servicio').focusout(function(e){
	            //Si no existe id del uso de CFDI
	            if($('#txtUsoCfdiID_facturas_servicio_servicio').val() == '' ||
	               $('#txtUsoCfdi_facturas_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUsoCfdiID_facturas_servicio_servicio').val('');
	               $('#txtUsoCfdi_facturas_servicio_servicio').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un tipo de relación
	        $('#txtTipoRelacion_facturas_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTipoRelacionID_facturas_servicio_servicio').val('');
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
	             $('#txtTipoRelacionID_facturas_servicio_servicio').val(ui.item.data);
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
	        $('#txtTipoRelacion_facturas_servicio_servicio').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtTipoRelacionID_facturas_servicio_servicio').val() == '' ||
	               $('#txtTipoRelacion_facturas_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTipoRelacionID_facturas_servicio_servicio').val('');
	               $('#txtTipoRelacion_facturas_servicio_servicio').val('');
	            }
	            
	        });
	       

			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_cfdi_relacionados_facturas_servicio_servicio').on('click','button.btn',function(){
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
			$('#dteFechaInicialBusq_relacionar_cfdi_facturas_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_relacionar_cfdi_facturas_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_relacionar_cfdi_facturas_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_relacionar_cfdi_facturas_servicio_servicio').val('');
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
	             $('#txtProspectoIDBusq_relacionar_cfdi_facturas_servicio_servicio').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_relacionar_cfdi_facturas_servicio_servicio').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_relacionar_cfdi_facturas_servicio_servicio').val() == '' ||
	            	$('#txtRazonSocialBusq_relacionar_cfdi_facturas_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_relacionar_cfdi_facturas_servicio_servicio').val('');
	               $('#txtRazonSocialBusq_relacionar_cfdi_facturas_servicio_servicio').val('');
	            }
	            
	        });


	        /*******************************************************************************************************************
			Controles correspondientes al modal Cancelación del timbrado
			**************************************	*******************************************************************************/
			 //Autocomplete para recuperar los datos de una sustitución (factura, pago, etc.)
	        $('#txtFolioSustitucion_cancelacion_facturas_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSustitucionID_cancelacion_facturas_servicio_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/facturas_servicio/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intReferenciaID: $('#txtReferenciaCfdiID_cancelacion_facturas_servicio_servicio').val(),
	                   strFormulario: 'cancelacion'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtSustitucionID_cancelacion_facturas_servicio_servicio').val(ui.item.data);
	             $('#txtUuidSustitucion_cancelacion_facturas_servicio_servicio').val(ui.item.uuid);
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
	        $('#txtFolioSustitucion_cancelacion_facturas_servicio_servicio').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtSustitucionID_cancelacion_facturas_servicio_servicio').val() == '' ||
	               $('#txtFolioSustitucion_cancelacion_facturas_servicio_servicio').val() == '')
	            { 
	               //Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_facturas_servicio_servicio();
	            }
	            
	        });


	        //Verificar motivo de cancelación cuando cambie la opción del combobox
	        $('#cmbCancelacionMotivoID_cancelacion_facturas_servicio_servicio').change(function(e){   
	            //Si el motivo de cancelación no corresponde a 01 - Comprobante emitido con errores con relación.
              	if(parseInt($('#cmbCancelacionMotivoID_cancelacion_facturas_servicio_servicio').val()) !== intCancelacionIDRelacionCfdiFacturasServicioServicio)
             	{
             		//Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_facturas_servicio_servicio();
					
             	}
	        });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_facturas_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_facturas_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_facturas_servicio_servicio').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_facturas_servicio_servicio').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_facturas_servicio_servicio').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_facturas_servicio_servicio').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_facturas_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_facturas_servicio_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/clientes/autocomplete",
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
	             //Asignar id del registro seleccionado
	             $('#txtProspectoIDBusq_facturas_servicio_servicio').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_facturas_servicio_servicio').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_facturas_servicio_servicio').val() == '' ||
	               $('#txtRazonSocialBusq_facturas_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_facturas_servicio_servicio').val('');
	               $('#txtRazonSocialBusq_facturas_servicio_servicio').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_facturas_servicio_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaFacturasServicioServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_facturas_servicio_servicio();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_facturas_servicio_servicio').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_facturas_servicio_servicio('Nuevo');
				//Abrir modal
				 objFacturasServicioServicio = $('#FacturasServicioServicioBox').bPopup({
												   appendTo: '#FacturasServicioServicioContent', 
					                               contentContainer: 'FacturasServicioServicioM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_facturas_servicio_servicio').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_facturas_servicio_servicio').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_facturas_servicio_servicio();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
  			cargar_monedas_facturas_servicio_servicio();
  			//Hacer un llamado a la función para cargar los motivos de cancelación en el combobox del modal
            cargar_motivos_cancelacion_facturas_servicio_servicio();
              //Hacer un llamado a la función para cargar exportación en el combobox del modal
            cargar_exportacion_facturas_servicio_servicio();

		});
	</script>