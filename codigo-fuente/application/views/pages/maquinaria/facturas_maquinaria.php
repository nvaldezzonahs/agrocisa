	<div id="FacturasMaquinariaMaquinariaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_facturas_maquinaria_maquinaria" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_facturas_maquinaria_maquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_facturas_maquinaria_maquinaria">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_facturas_maquinaria_maquinaria'>
				                    <input class="form-control" id="txtFechaInicialBusq_facturas_maquinaria_maquinaria"
				                    		name= "strFechaInicialBusq_facturas_maquinaria_maquinaria" 
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
								<label for="txtFechaFinalBusq_facturas_maquinaria_maquinaria">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_facturas_maquinaria_maquinaria'>
				                    <input class="form-control" id="txtFechaFinalBusq_facturas_maquinaria_maquinaria"
				                    		name= "strFechaFinalBusq_facturas_maquinaria_maquinaria" 
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
								<input id="txtProspectoIDBusq_facturas_maquinaria_maquinaria" 
									   name="intProspectoIDBusq_facturas_maquinaria_maquinaria"  
									   type="hidden" 
									   value="" />
								<label for="txtRazonSocialBusq_facturas_maquinaria_maquinaria">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtRazonSocialBusq_facturas_maquinaria_maquinaria" 
										name="strRazonSocialBusq_facturas_maquinaria_maquinaria" 
										type="text" value="" tabindex="1" 
										placeholder="Ingrese razón social" maxlength="250" />
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_facturas_maquinaria_maquinaria">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_facturas_maquinaria_maquinaria" 
								 		name="strEstatusBusq_facturas_maquinaria_maquinaria" tabindex="1">
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
								<label for="txtBusqueda_facturas_maquinaria_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_facturas_maquinaria_maquinaria" 
										name="strBusqueda_facturas_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_facturas_maquinaria_maquinaria" 
									   name="strImprimirDetalles_facturas_maquinaria_maquinaria" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_facturas_maquinaria_maquinaria"
									onclick="paginacion_facturas_maquinaria_maquinaria();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_facturas_maquinaria_maquinaria" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_facturas_maquinaria_maquinaria"
									onclick="reporte_facturas_maquinaria_maquinaria('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_facturas_maquinaria_maquinaria"
									onclick="reporte_facturas_maquinaria_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil.a5:nth-of-type(5):before {content: "Pedido"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

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
				Definir columnas de la tabla componentes
				*/
				td.movil.d1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "Serie"; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Motor"; font-weight: bold;}
				td.movil.d5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}



			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_facturas_maquinaria_maquinaria">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Razón social</th>
							<th class="movil">RFC</th>
							<th class="movil">Pedido</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:15em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_facturas_maquinaria_maquinaria" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{razon_social}}</td>
							<td class="movil a4">{{rfc}}</td>
							<td class="movil a5">{{folio_pedido}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_facturas_maquinaria_maquinaria({{factura_maquinaria_id}});"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_facturas_maquinaria_maquinaria({{factura_maquinaria_id}}, {{cancelacion_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Ver motivo de cancelación-->
								<button class="btn btn-default btn-xs {{mostrarAccionMotivoCancelacion}}"  
										onclick="ver_cancelacion_facturas_maquinaria_maquinaria({{cancelacion_id}})"  title="Ver motivo de cancelación">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_cliente_facturas_maquinaria_maquinaria({{factura_maquinaria_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_facturas_maquinaria_maquinaria({{factura_maquinaria_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_facturas_maquinaria_maquinaria({{factura_maquinaria_id}}, '{{estatus}}', 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Timbrar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionTimbrar}}"  
										onclick="timbrar_facturas_maquinaria_maquinaria({{factura_maquinaria_id}},'', 'principal', {{regimen_fiscal_id}})"  title="Timbrar">
									<span class="fa fa-certificate"></span>
								</button>
								<!--Descargar archivos-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_facturas_maquinaria_maquinaria({{factura_maquinaria_id}}, '{{folio}}');" title="Descargar archivos">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>							
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="verificar_salida_compra_facturas_maquinaria_maquinaria({{factura_maquinaria_id}},'{{folio}}', {{poliza_id}}, '{{folio_poliza}}')" title="Cancelar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_facturas_maquinaria_maquinaria"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_facturas_maquinaria_maquinaria">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_facturas_maquinaria_maquinaria" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarFacturasMaquinariaMaquinariaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cliente_facturas_maquinaria_maquinaria" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarFacturasMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarFacturasMaquinariaMaquinaria"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Cliente-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtFacturaMaquinariaID_cliente_facturas_maquinaria_maquinaria" 
										   name="intFacturaMaquinariaID_cliente_facturas_maquinaria_maquinaria" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el folio del registro seleccionado-->
									<input id="txtFolio_cliente_facturas_maquinaria_maquinaria" 
										   name="strFolio_cliente_facturas_maquinaria_maquinaria" 
										   type="hidden" value="" />		   
									<label for="txtRazonSocial_cliente_facturas_maquinaria_maquinaria">Razón social</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_cliente_facturas_maquinaria_maquinaria" 
											name="strRazonSocial_cliente_facturas_maquinaria_maquinaria" 
											type="text" value="" disabled>
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
									<label for="txtCorreoElectronico_cliente_facturas_maquinaria_maquinaria">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_cliente_facturas_maquinaria_maquinaria" 
											name="strCorreoElectronico_cliente_facturas_maquinaria_maquinaria" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_cliente_facturas_maquinaria_maquinaria">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_cliente_facturas_maquinaria_maquinaria" 
											name="strCopiaCorreoElectronico_cliente_facturas_maquinaria_maquinaria" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cliente_facturas_maquinaria_maquinaria" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_cliente_facturas_maquinaria_maquinaria"  
									onclick="validar_cliente_facturas_maquinaria_maquinaria();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cliente_facturas_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_cliente_facturas_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal Relacionar CFDI-->
		<div id="RelacionarCfdiFacturasMaquinariaMaquinariaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_cfdi_facturas_maquinaria_maquinaria" class="ModalBodyTitle">
				<h1>Relacionar CFDI</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarCfdiFacturasMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarCfdiFacturasMaquinariaMaquinaria"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha inicial-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria">Fecha inicial</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaInicialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria'>
					                    <input class="form-control" id="txtFechaInicialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria"
					                    		name= "strFechaInicialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria" 
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
									<label for="txtFechaFinalBusq_relacionar_cfdi_facturas_maquinaria_maquinaria">Fecha final</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaFinalBusq_relacionar_cfdi_facturas_maquinaria_maquinaria'>
					                    <input class="form-control" id="txtFechaFinalBusq_relacionar_cfdi_facturas_maquinaria_maquinaria"
					                    		name= "strFechaFinalBusq_relacionar_cfdi_facturas_maquinaria_maquinaria" 
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
									<input id="txtProspectoIDBusq_relacionar_cfdi_facturas_maquinaria_maquinaria" 
										   name="intProspectoIDBusq_relacionar_cfdi_facturas_maquinaria_maquinaria"  type="hidden" 
										   value="">
									</input>
									<label for="txtRazonSocialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria">Razón social</label>
								</div>
								<div class="col-md-12">
									<div class="input-group">
										<input class="form-control" id="txtRazonSocialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria" 
											   name="strRazonSocialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria"  type="text" value="" 
											   tabindex="1" placeholder="Ingrese razón social" maxlength="250" >
										</input>
										<span class="input-group-btn">
											<button class="btn btn-primary" id="btnBuscar_relacionar_cfdi_facturas_maquinaria_maquinaria"
													onclick="lista_facturas_relacionar_cfdi_facturas_maquinaria_maquinaria();" title="Buscar coincidencias" tabindex="1">
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
							<input id="txtNumCfdi_relacionar_cfdi_facturas_maquinaria_maquinaria" 
								   name="intNumCfdi_relacionar_cfdi_facturas_maquinaria_maquinaria" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_cfdi_facturas_maquinaria_maquinaria">
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
								<script id="plantilla_relacionar_cfdi_facturas_maquinaria_maquinaria" type="text/template"> 
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
							    		id="chbAgregar_relacionar_cfdi_facturas_maquinaria_maquinaria" />
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
										<strong id="numElementos_relacionar_cfdi_facturas_maquinaria_maquinaria">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar CFDI´s-->
							<button class="btn btn-success" id="btnAgregar_relacionar_cfdi_facturas_maquinaria_maquinaria"  
									onclick="validar_relacionar_cfdi_facturas_maquinaria_maquinaria();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_cfdi_facturas_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_cfdi_facturas_maquinaria_maquinaria();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar CFDI-->

			<!-- Diseño del modal Cancelación del timbrado-->
		<div id="CancelacionFacturasMaquinariaMaquinariaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cancelacion_facturas_maquinaria_maquinaria" class="ModalBodyTitle confirmacion-modal-title">
			<h1>Cancelación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCancelacionFacturasMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmCancelacionFacturasMaquinariaMaquinaria"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Combobox que contiene los motivos de cancelación activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCancelacionMotivoID_cancelacion_facturas_maquinaria_maquinaria">Motivo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbCancelacionMotivoID_cancelacion_facturas_maquinaria_maquinaria" 
									 		name="intCancelacionMotivoID_facturas_maquinaria_maquinaria" 
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
									<input id="txtReferenciaCfdiID_cancelacion_facturas_maquinaria_maquinaria" 
										   name="intReferenciaCfdiID_cancelacion_facturas_maquinaria_maquinaria" 
										   type="hidden" value="" />	

									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_cancelacion_facturas_maquinaria_maquinaria" 
										   name="intPolizaID_cancelacion_facturas_maquinaria_maquinaria" type="hidden" value="" />
								
									<label for="txtFolio_cancelacion_facturas_maquinaria_maquinaria">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_cancelacion_facturas_maquinaria_maquinaria" 
											name="strFolio_cancelacion_facturas_maquinaria_maquinaria" type="text" value="" 
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
									<input id="txtSustitucionID_cancelacion_facturas_maquinaria_maquinaria" 
										   name="intSustitucionID_cancelacion_facturas_maquinaria_maquinaria" 
										   type="hidden" value="" />	
									<!-- Caja de texto oculta que se utiliza para recuperar el UUID de la factura que sustituye-->
									<input id="txtUuidSustitucion_cancelacion_facturas_maquinaria_maquinaria" 
										   name="strUuidSustitucion_cancelacion_facturas_maquinaria_maquinaria" 
										   type="hidden" value="" />	   
									<label for="txtFolioSustitucion_cancelacion_facturas_maquinaria_maquinaria">Sustitución</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolioSustitucion_cancelacion_facturas_maquinaria_maquinaria" 
											name="strFolioSustitucion_cancelacion_facturas_maquinaria_maquinaria" type="text" value="" 
											tabindex="1" placeholder="Ingrese factura" maxlength="250" >
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Div que contiene los campos del usuario y fecha del registro -->
			 		<div  id="divDatosCreacion_cancelacion_facturas_maquinaria_maquinaria" class="row no-mostrar">
			 			<!--Usuario que realizó la cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuarioCreacion_cancelacion_facturas_maquinaria_maquinaria">Usuario de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuarioCreacion_cancelacion_facturas_maquinaria_maquinaria" 
											name="strUsuarioCreacion_cancelacion_facturas_maquinaria_maquinaria" type="text" value="" 
											 disabled >
									</input>
								</div>
							</div>
						</div>
						<!--Fecha de cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaCreacion_cancelacion_facturas_maquinaria_maquinaria">Fecha de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFechaCreacion_cancelacion_facturas_maquinaria_maquinaria" 
											name="strFechaCreacion_cancelacion_facturas_maquinaria_maquinaria" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cancelacion_facturas_maquinaria_maquinaria" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 						
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar cancelación del CFDI-->
							<button class="btn btn-success" id="btnGuardar_cancelacion_facturas_maquinaria_maquinaria"  
									onclick="validar_cancelacion_facturas_maquinaria_maquinaria();"  title="Cancelar CFDI" tabindex="1">
								<span class="fa fa-chain-broken"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cancelacion_facturas_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_cancelacion_facturas_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cancelación del timbrado-->



		<!-- Diseño del modal Facturas-->
		<div id="FacturasMaquinariaMaquinariaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_facturas_maquinaria_maquinaria"  class="ModalBodyTitle">
			<h1>Facturación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_facturas_maquinaria_maquinaria" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_facturas_maquinaria_maquinaria" class="active">
									<a data-toggle="tab" href="#informacion_general_facturas_maquinaria_maquinaria">Información General</a>
								</li>
								<!--Tab que contiene la información de los CFDI relacionados-->
								<li id="tabCfdiRelacionados_facturas_maquinaria_maquinaria">
									<a data-toggle="tab" href="#cfdi_relacionados_facturas_maquinaria_maquinaria">CFDI Relacionados</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmFacturasMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmFacturasMaquinariaMaquinaria"  onsubmit="return(false)" 
					  autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_facturas_maquinaria_maquinaria" class="tab-pane fade in active">
							<div class="row">
								<!--Folio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtFacturaMaquinariaID_facturas_maquinaria_maquinaria" 
												   name="intFacturaMaquinariaID_facturas_maquinaria_maquinaria" type="hidden" value="" />
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
											<input id="txtEstatus_facturas_maquinaria_maquinaria" 
												   name="strEstatus_facturas_maquinaria_maquinaria" type="hidden" value="" />
											<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
											<input id="txtPolizaID_facturas_maquinaria_maquinaria" 
												   name="intPolizaID_facturas_maquinaria_maquinaria" type="hidden" value="" />
											 <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
											<input id="txtFolioPoliza_facturas_maquinaria_maquinaria" 
												   name="strFolioPoliza_facturas_maquinaria_maquinaria" type="hidden" value="" />
											  <!-- Caja de texto oculta que se utiliza para recuperar el id de la clave de autorización del registro seleccionado-->
											<input id="txtClaveAutorizacionID_facturas_maquinaria_maquinaria" 
												   name="intClaveAutorizacionID_facturas_maquinaria_maquinaria" type="hidden" value="" />
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la cancelación del registro seleccionado-->
											<input id="txtCancelacionID_facturas_maquinaria_maquinaria" 
												   name="intCancelacionID_facturas_maquinaria_maquinaria" type="hidden" value="" />
											<label for="txtFolio_facturas_maquinaria_maquinaria">Folio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFolio_facturas_maquinaria_maquinaria" 
													name="strFolio_facturas_maquinaria_maquinaria" type="text" 
													value="" placeholder="Autogenerado" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Fecha-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_facturas_maquinaria_maquinaria">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_facturas_maquinaria_maquinaria'>
							                    <input class="form-control" id="txtFecha_facturas_maquinaria_maquinaria"
							                    		name= "strFecha_facturas_maquinaria_maquinaria" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Moneda-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la moneda-->
											<input id="txtMonedaID_facturas_maquinaria_maquinaria" 
												   name="intMonedaID_facturas_maquinaria_maquinaria"  
												   type="hidden"  value="">
											</input>
											<label for="txtMoneda_facturas_maquinaria_maquinaria">Moneda</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMoneda_facturas_maquinaria_maquinaria" 
													name="strMoneda_facturas_maquinaria_maquinaria" 
													type="text" value="">
											</input>
										</div>
									</div>
								</div>
								<!--Tipo de cambio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTipoCambio_facturas_maquinaria_maquinaria">Tipo de cambio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control tipo-cambio_facturas_maquinaria_maquinaria" id="txtTipoCambio_facturas_maquinaria_maquinaria" 
													name="intTipoCambio_facturas_maquinaria_maquinaria" type="text" value="" tabindex="1" >
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Condiciones de pago-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbCondicionesPago_facturas_maquinaria_maquinaria">Tipo de venta</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbCondicionesPago_facturas_maquinaria_maquinaria" 
											 		name="strCondicionesPago_facturas_maquinaria_maquinaria" tabindex="1">
											 	<option value="">Seleccione una opción</option>
											    <option value="CREDITO">CREDITO</option>
			                      				<option value="CONTADO">CONTADO</option>
			                 				</select>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los pedidos autorizados-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del pedido seleccionado-->
											<input id="txtPedidoMaquinariaID_facturas_maquinaria_maquinaria" 
												   name="intPedidoMaquinariaID_facturas_maquinaria_maquinaria" 
												   type="hidden" value="">
											</input>
											<label for="txtPedidoMaquinaria_facturas_maquinaria_maquinaria">
												Pedido
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPedidoMaquinaria_facturas_maquinaria_maquinaria" 
													name="strPedidoMaquinaria_facturas_maquinaria_maquinaria" type="text" value=""  
													tabindex="1" placeholder="Ingrese pedido" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los vendedores activos-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group ">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del vendedor seleccionado-->
											<input id="txtVendedorID_facturas_maquinaria_maquinaria" 
												   name="intVendedorID_facturas_maquinaria_maquinaria" 
												   type="hidden" value="">
											</input>
											<label for="txtVendedor_facturas_maquinaria_maquinaria">
												Vendedor
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtVendedor_facturas_maquinaria_maquinaria" 
													name="strVendedor_facturas_maquinaria_maquinaria" type="text" value=""  
													tabindex="1" placeholder="Ingrese vendedor" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene los clientes activos-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del cliente seleccionado-->
											<input id="txtProspectoID_facturas_maquinaria_maquinaria" 
												   name="intProspectoID_facturas_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el id del régimen fiscal del cliente seleccionado-->
											<input id="txtRegimenFiscalID_facturas_maquinaria_maquinaria" 
												   name="intRegimenFiscalID_facturas_maquinaria_maquinaria" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar la calle del cliente seleccionado-->
											<input id="txtCalle_facturas_maquinaria_maquinaria" 
												   name="strCalle_facturas_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el número exterior del cliente seleccionado-->
											<input id="txtNumeroExterior_facturas_maquinaria_maquinaria" 
												   name="strNumeroExterior_facturas_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el número interior del cliente seleccionado-->
											<input id="txtNumeroInterior_facturas_maquinaria_maquinaria" 
												   name="strNumeroInterior_facturas_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el código postal del cliente seleccionado-->
											<input id="txtCodigoPostal_facturas_maquinaria_maquinaria" 
												   name="strCodigoPostal_facturas_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar la colonia del cliente seleccionado-->
											<input id="txtColonia_facturas_maquinaria_maquinaria" 
												   name="strColonia_facturas_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar la localidad del cliente seleccionado-->
											<input id="txtLocalidad_facturas_maquinaria_maquinaria" 
												   name="strLocalidad_facturas_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el municipio del cliente seleccionado-->
											<input id="txtMunicipio_facturas_maquinaria_maquinaria" 
												   name="strMunicipio_facturas_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el estado del cliente seleccionado-->
											<input id="txtEstado_facturas_maquinaria_maquinaria" 
												   name="strEstado_facturas_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el país del cliente seleccionado-->
											<input id="txtPais_facturas_maquinaria_maquinaria" 
												   name="strPais_facturas_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar los días de crédito del cliente seleccionado-->
											<input id="txtMaquinariaCreditoDias_facturas_maquinaria_maquinaria" 
												   name="intMaquinariaCreditoDias_facturas_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para asignar la fecha de vencimiento-->
											<input id="txtFechaVencimiento_facturas_maquinaria_maquinaria" 
												   name="strFechaVencimiento_facturas_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<label for="txtRazonSocial_facturas_maquinaria_maquinaria">
												Razón social
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRazonSocial_facturas_maquinaria_maquinaria" 
													name="strRazonSocial_facturas_maquinaria_maquinaria" 
													type="text" value="" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Razón social-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRfc_facturas_maquinaria_maquinaria">RFC</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRfc_facturas_maquinaria_maquinaria"
												   name="strRfc_facturas_maquinaria_maquinaria" 
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
											<input id="txtFormaPagoID_facturas_maquinaria_maquinaria" 
												   name="intFormaPagoID_facturas_maquinaria_maquinaria" 
												   type="hidden" value="">
											</input>
											<label for="txtFormaPago_facturas_maquinaria_maquinaria">
												Forma de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFormaPago_facturas_maquinaria_maquinaria" 
													name="strFormaPago_facturas_maquinaria_maquinaria" type="text" value=""  
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
											<input id="txtMetodoPagoID_facturas_maquinaria_maquinaria" 
												   name="intMetodoPagoID_facturas_maquinaria_maquinaria" 
												   type="hidden" value="">
											</input>
											<label for="txtMetodoPago_facturas_maquinaria_maquinaria">
												Método de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMetodoPago_facturas_maquinaria_maquinaria" 
													name="strMetodoPago_facturas_maquinaria_maquinaria" type="text" value=""  
													tabindex="1" placeholder="Ingrese método de pago" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Combobox que contiene la exportación activa-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbExportacionID_facturas_maquinaria_maquinaria">Exportación</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbExportacionID_facturas_maquinaria_maquinaria"
											        name="intExportacionID_facturas_maquinaria_maquinaria" tabindex="1">
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
											<input id="txtUsoCfdiID_facturas_maquinaria_maquinaria" 
												   name="intUsoCfdiID_facturas_maquinaria_maquinaria" 
												   type="hidden" value="">
											</input>
											<label for="txtUsoCfdi_facturas_maquinaria_maquinaria">
												Uso del CFDI
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtUsoCfdi_facturas_maquinaria_maquinaria" 
													name="strUsoCfdi_facturas_maquinaria_maquinaria" type="text" value=""  
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
											<input id="txtTipoRelacionID_facturas_maquinaria_maquinaria" 
												   name="intTipoRelacionID_facturas_maquinaria_maquinaria" 
												   type="hidden" value="">
											</input>
											<label for="txtTipoRelacion_facturas_maquinaria_maquinaria">
												Tipo de relación
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTipoRelacion_facturas_maquinaria_maquinaria" 
													name="strTipoRelacion_facturas_maquinaria_maquinaria" type="text" value=""  
													tabindex="1" placeholder="Ingrese tipo de relación" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
						    <div class="row">
						    	<!--Observaciones-->
								<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObservaciones_facturas_maquinaria_maquinaria">Observaciones</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtObservaciones_facturas_maquinaria_maquinaria" 
													name="strObservaciones_facturas_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    	<!--Notas-->
								<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNotas_facturas_maquinaria_maquinaria">Notas</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNotas_facturas_maquinaria_maquinaria" 
													name="strNotas_facturas_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese notas" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">Detalles de la factura</h4>
												</div>
												<div class="panel-body">
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<!--Tabs-->
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																<div class="form-group">
																	<ul class="nav nav-tabs  nav-justified" id="tabs_facturas_maquinaria_maquinaria" role="tablist">
																		<!--Tab que contiene la información general-->
																		<li id="tabInformacionGeneral_detalle_facturas_maquinaria_maquinaria" class="active">
																			<a data-toggle="tab" href="#informacion_general_detalle_facturas_maquinaria_maquinaria">Información General</a>
																		</li>
																		<!--Tab que contiene los componentes-->
																		<li id="tabComponentes_detalle_facturas_maquinaria_maquinaria">
																			<a data-toggle="tab" href="#componentes_facturas_maquinaria_maquinaria">Componentes</a>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
														<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
														<div class="tab-content">
															<!-- Caja de texto que oculta el tipo de Maquinaria proveniente del pedido (SIMPLE / COMPUESTA) -->
															<input id="txtMaquinariaTipo_facturas_maquinaria_maquinaria" 
																   name="strMaquinariaTipo_facturas_maquinaria_maquinaria"  
																   type="hidden" value="" />
															<!--Tab - Información General-->
															<div id="informacion_general_detalle_facturas_maquinaria_maquinaria" class="tab-pane fade in active">
																<div class="row">
																	<!--Autocomplete que contiene las series de la descripción de maquinaria-->
																	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
																		<div class="form-group">
																			<div class="col-md-12">
																				<!-- Caja de texto oculta que se utiliza para recuperar el id del inventario (correspondiente a la descripción de maquinaria) seleccionado-->
																				<input id="txtInventarioMaquinariaDescripcionID_facturas_maquinaria_maquinaria" 
																					   name="intInventarioMaquinariaDescripcionID_facturas_maquinaria_maquinaria"  
																					   type="hidden" value="" />
																			   <input id="txtConsignacion_facturas_maquinaria_maquinaria" 
																					   name="strConsignacion_facturas_maquinaria_maquinaria"  
																					   type="hidden" value="" />
																				<label for="txtSerie_facturas_maquinaria_maquinaria">
																					Serie
																				</label>
																			</div>
																			<div class="col-md-12">
																				<input  class="form-control" 
																						id="txtSerie_facturas_maquinaria_maquinaria" 
																						name="strSerie_facturas_maquinaria_maquinaria" 
																						type="text" value="" tabindex="1" 
																						placeholder="Ingrese serie" maxlength="50" />
																			</div>
																		</div>
																	</div>
																	<!--Autocomplete que contiene los motores de la descripción de maquinaria-->
																	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
																		<div class="form-group">
																			<div class="col-md-12">
																				<label for="txtMotor_facturas_maquinaria_maquinaria">
																					Motor
																				</label>
																			</div>
																			<div class="col-md-12">
																				<input  class="form-control" 
																						id="txtMotor_facturas_maquinaria_maquinaria" 
																						name="strMotor_facturas_maquinaria_maquinaria" 
																						type="text" value="" tabindex="1" 
																						placeholder="Ingrese motor" maxlength="50" />
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<!--Autocomplete que contiene las descripciones de maquinaria activas-->
																	<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
																		<div class="form-group">
																			<div class="col-md-12">
																				<!-- Caja de texto oculta que se utiliza para recuperar el id de la descripción de maquinaria seleccionada-->
																				<input id="txtMaquinariaDescripcionID_facturas_maquinaria_maquinaria" 
																					   name="intMaquinariaDescripcionID_facturas_maquinaria_maquinaria"  
																					   type="hidden" value="" />
																				<!-- Caja de texto oculta que se utiliza para recuperar la descripción de la maquinaria seleccionada-->
																				<input id="txtDescripcion_facturas_maquinaria_maquinaria" 
																					   name="strDescripcion_facturas_maquinaria_maquinaria"  
																					   type="hidden" value="" />
																				<!-- Caja de texto oculta que se utiliza para recuperar el código SAT de la maquinaria seleccionada-->
																				<input id="txtCodigoSat_facturas_maquinaria_maquinaria" 
																					   name="strCodigoSat_facturas_maquinaria_maquinaria"  
																					   type="hidden" value="" />
																				<!-- Caja de texto oculta que se utiliza para recuperar la unidad SAT de la maquinaria seleccionada-->
																				<input id="txtUnidadSat_facturas_maquinaria_maquinaria" 
																					   name="strUnidadSat_facturas_maquinaria_maquinaria"  
																					   type="hidden" value="" />

																				<!-- Caja de texto oculta que se utiliza para recuperar el objeto de impuesto SAT de la refacción seleccionada-->
																				<input id="txtObjetoImpuestoSat_facturas_maquinaria_maquinaria" 
																			   name="strObjetoImpuestoSat_facturas_maquinaria_maquinaria"  
																			   type="hidden" value="" />

																				<label for="txtCodigo_facturas_maquinaria_maquinaria">
																					Código
																				</label>
																			</div>
																			<div class="col-md-12">
																				<input  class="form-control" 
																						id="txtCodigo_facturas_maquinaria_maquinaria" 
																						name="strCodigo_facturas_maquinaria_maquinaria" 
																						type="text" value="" tabindex="1" 
																						maxlength="250" />
																			</div>
																		</div>
																	</div>
																	<!--Autocomplete que contiene las descripciones de maquinaria activas-->
																	<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
																		<div class="form-group">
																			<div class="col-md-12">
																				<label for="txtDescripcionCorta_facturas_maquinaria_maquinaria">Descripción corta</label>
																			</div>
																			<div class="col-md-12">
																				<input  class="form-control" 
																						id="txtDescripcionCorta_facturas_maquinaria_maquinaria" 
																						name="strDescripcionCorta_facturas_maquinaria_maquinaria" 
																						type="text"  value="" tabindex="1" maxlength="250" />
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<!--Precio-->
																	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																		<div class="form-group">
																			<div class="col-md-12">
																				<label for="txtPrecio_facturas_maquinaria_maquinaria">Precio</label>
																			</div>
																			<div class="col-md-12">
																				<input  class="form-control moneda_facturas_maquinaria_maquinaria" 
																						id="txtPrecio_facturas_maquinaria_maquinaria" 
																						name="intPrecio_facturas_maquinaria_maquinaria" 
																						type="text" value="" tabindex="1" maxlength="23" />
																			</div>
																		</div>
																	</div>
																	<!--Porcentaje del descuento-->
																	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																		<div class="form-group">
																			<div class="col-md-12">
																				<!-- Caja de texto oculta que se utiliza para asignar el descuento-->
																				<input id="txtDescuento_facturas_maquinaria_maquinaria" 
																					   name="intDescuento_facturas_maquinaria_maquinaria"  
																					   type="hidden" value="" />
																				<label for="txtPorcentajeDescuento_facturas_maquinaria_maquinaria">Descuento %</label>
																			</div>
																			<div class="col-md-12">
																				<input  class="form-control cantidad_facturas_maquinaria_maquinaria" 
																						id="txtPorcentajeDescuento_facturas_maquinaria_maquinaria" 
																						name="intPorcentajeDescuento_facturas_maquinaria_maquinaria" 
																						type="text" value="" tabindex="1" maxlength="7" />
																			</div>
																		</div>
																	</div>
																	<!--Subtotal-->
																	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																		<div class="form-group">
																			<div class="col-md-12">
																				<label for="txtSubtotal_facturas_maquinaria_maquinaria">Subtotal</label>
																			</div>
																			<div class="col-md-12">
																				<input  class="form-control" id="txtSubtotal_facturas_maquinaria_maquinaria" 
																						name="intSubtotal_facturas_maquinaria_maquinaria" type="text" value="" disabled />
																			</div>
																		</div>
																	</div>
																	<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
																	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																		<div class="form-group">
																			<div class="col-md-12">
																				<!-- Caja de texto oculta para asignar el importe del IVA-->
																				<input id="txtIva_facturas_maquinaria_maquinaria" 
																					   name="intIva_facturas_maquinaria_maquinaria" 
																					   type="hidden" value="" />
																				<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
																				<input id="txtTasaCuotaIva_facturas_maquinaria_maquinaria" 
																					   name="intTasaCuotaIva_facturas_maquinaria_maquinaria" 
																					   type="hidden" value="" />
																				<label for="txtPorcentajeIva_facturas_maquinaria_maquinaria">IVA %</label>
																			</div>
																			<div class="col-md-12">
																				<input  class="form-control" id="txtPorcentajeIva_facturas_maquinaria_maquinaria" 
																						name="intPorcentajeIva_facturas_maquinaria_maquinaria" 
																						type="text" value="" tabindex="1" maxlength="250" />
																			</div>
																		</div>
																	</div>
																	<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
																	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																		<div class="form-group">
																			<div class="col-md-12">
																				<!-- Caja de texto oculta para asignar el importe del IEPS-->
																				<input id="txtIeps_facturas_maquinaria_maquinaria" 
																					   name="intIeps_facturas_maquinaria_maquinaria" 
																					   type="hidden" value="" />
																				<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
																				<input id="txtTasaCuotaIeps_facturas_maquinaria_maquinaria" 
																					   name="intTasaCuotaIeps_facturas_maquinaria_maquinaria" 
																					   type="hidden" value="" />
																				<label for="txtPorcentajeIeps_facturas_maquinaria_maquinaria">IEPS %</label>
																			</div>
																			<div class="col-md-12">
																				<input  class="form-control" id="txtPorcentajeIeps_facturas_maquinaria_maquinaria" 
																						name="intPorcentajeIeps_facturas_maquinaria_maquinaria" 
																						type="text" value="" tabindex="1" maxlength="250" />
																			</div>
																		</div>
																	</div>
																	<!--Total-->
																	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																		<div class="form-group">
																			<div class="col-md-12">
																				<label for="txtTotal_facturas_maquinaria_maquinaria">Total</label>
																			</div>
																			<div class="col-md-12">
																				<input  class="form-control" 
																						id="txtTotal_facturas_maquinaria_maquinaria" 
																						name="intTotal_facturas_maquinaria_maquinaria" 
																						type="text" value="" disabled />
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<!--Tab - Componentes-->
															<div id="componentes_facturas_maquinaria_maquinaria" class="tab-pane fade">
																<div class="row">
																	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																		<div class="row">
																		    <!--Serie del componente-->
																			<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
																				<div class="form-group">
																					<div class="col-md-12">
																						<!-- Caja de texto oculta que se utiliza para recuperar el id de la descripción de maquinaria seleccionada (del inventario)-->
																						<input id="txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria" 
																							   name="intMaquinariaDescripcionIDComp_facturas_maquinaria_maquinaria"  
																							   type="hidden" value="" />
																						<!-- Caja de texto oculta que se utiliza para recuperar la consignación de la descripción de maquinaria seleccionada (del inventario)-->
																						<input id="txtConsignacion_componentes_facturas_maquinaria_maquinaria" 
																							   name="strConsignacion_componentes_facturas_maquinaria_maquinaria"  
																							   type="hidden" value="" />
																						<label for="txtSerie_componentes_facturas_maquinaria_maquinaria">Serie</label>
																					</div>
																					<div class="col-md-12">
																						<input  class="form-control" 
																								id="txtSerie_componentes_facturas_maquinaria_maquinaria" 
																								name="strSerie_componentes_facturas_maquinaria_maquinaria" 
																								type="text" 
																								value="" 
																								tabindex="1" 
																								placeholder="Ingrese serie" 
																								maxlength="30" />
																					</div>
																				</div>
																			</div>
																			<!--Motor del componente-->
																			<div class="col-sm-8 col-md-8 col-lg-8 col-xs-10">
																				<div class="form-group">
																					<div class="col-md-12">
																						<label for="txtMotor_componentes_facturas_maquinaria_maquinaria">Motor</label>
																					</div>
																					<div class="col-md-12">
																						<input  class="form-control" 
																								id="txtMotor_componentes_facturas_maquinaria_maquinaria" 
																								name="strMotor_componentes_facturas_maquinaria_maquinaria" 
																								type="text" 
																								value=""
																								tabindex="1" 
																								placeholder="Ingrese motor" 
																								maxlength="50" 
																								disabled />
																					</div>
																				</div>
																			</div>
																			<!--Botón agregar componentes-->
											                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
											                                	<button class="btn btn-primary btn-toolBtns pull-right" 
											                                			id="btnAgregar_componentes_facturas_maquinaria_maquinaria" 
											                                			onclick="agregar_renglon_componentes_facturas_maquinaria_maquinaria();" 
											                                	     	title="Agregar" tabindex="1"> 
											                                		<span class="glyphicon glyphicon-plus"></span>
											                                	</button>
											                             	</div>
																	    </div>
																	    <div class="row">
																		    <!--Código del componente-->
																			<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
																				<div class="form-group">
																					<div class="col-md-12">
																						<!-- Caja de texto oculta que se utiliza para recuperar el id del inventario (correspondiente a la descripción de maquinaria) seleccionado-->
																						<input id="txtInventarioMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria" 
																							   name="intInventarioMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria"  
																							   type="hidden" 
																							   value="" />
																						<label for="txtCodigo_componentes_facturas_maquinaria_maquinaria">Código</label>
																					</div>
																					<div class="col-md-12">
																						<input  class="form-control" 
																								id="txtCodigo_componentes_facturas_maquinaria_maquinaria" 
																								name="strCodigo_componentes_facturas_maquinaria_maquinaria" 
																								type="text" 
																								value="" />
																					</div>
																				</div>
																			</div>
																			<!--Descripción del componente-->
																			<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
																				<div class="form-group">
																					<div class="col-md-12">
																						<label for="txtDescripcion_componentes_facturas_maquinaria_maquinaria">Descripción corta</label>
																					</div>
																					<div class="col-md-12">
																						<input  class="form-control" 
																								id="txtDescripcion_componentes_facturas_maquinaria_maquinaria" 
																								name="strDescripcion_componentes_facturas_maquinaria_maquinaria" 
																								type="text" 
																								value="" />
																					</div>
																				</div>
																			</div>
																	    </div>
																	    <div class="row">
																			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																				<div class="form-group">
																					<div class="col-md-12">
																						<div class="panel panel-default">
																							<div class="panel-heading">
																								<h4 class="panel-title">Componentes</h4>
																							</div>
																							<div class="panel-body">
																								<!--Div que contiene la tabla con los componentes agregados-->
																								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																									<div class="row">
																										<!-- Diseño de la tabla-->
																										<table class="table-hover movil" id="dg_componentes_facturas_maquinaria_maquinaria">
																											<thead class="movil">
																												<tr class="movil">
																													<th class="movil">Código</th>
																													<th class="movil">Descripción</th>
																													<th class="movil">Serie</th>
																													<th class="movil">Motor</th>
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
																													<strong id="numElementos_componentes_facturas_maquinaria_maquinaria">0</strong> encontrados
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
						<div id="cfdi_relacionados_facturas_maquinaria_maquinaria" class="tab-pane fade">
							<div class="row">
								<!--Botones-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="btn-group pull-right">
										<!--Buscar CFDI a relacionar para agregarlos en la tabla-->
										<button class="btn btn-primary" 
		                                			id="btnBuscarCFDI_facturas_maquinaria_maquinaria" 
		                                			onclick="abrir_relacionar_cfdi_facturas_maquinaria_maquinaria();" 
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
									<input id="txtNumCfdiRelacionados_facturas_maquinaria_maquinaria" 
										   name="intNumCfdiRelacionados_facturas_maquinaria_maquinaria" type="hidden" value="">
									</input>
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_cfdi_relacionados_facturas_maquinaria_maquinaria">
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
												<strong id="numElementos_cfdi_relacionados_facturas_maquinaria_maquinaria">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - CFDI relacionados-->
					</div><!--Cierre del contenedor de tabs-->
                  	<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_facturas_maquinaria_maquinaria" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Nuevo registro-->
							<button class="btn btn-info" id="btnReiniciar_facturas_maquinaria_maquinaria"  
									onclick="nuevo_facturas_maquinaria_maquinaria('Nuevo');"  title="Nuevo registro" tabindex="2">
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_facturas_maquinaria_maquinaria"  
									onclick="validar_facturas_maquinaria_maquinaria();"  title="Guardar" tabindex="3" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_facturas_maquinaria_maquinaria"  
									onclick="abrir_cliente_facturas_maquinaria_maquinaria('');"  
									title="Enviar correo electrónico" tabindex="4" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Ver motivo de cancelación del registro-->
							<button class="btn btn-default" id="btnVerMotivoCancelacion_facturas_maquinaria_maquinaria"  
									onclick="ver_cancelacion_facturas_maquinaria_maquinaria('');"  title="Ver motivo de cancelación" tabindex="5">
								<i class="fa fa-info-circle" aria-hidden="true"></i>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_facturas_maquinaria_maquinaria"  
									onclick="reporte_registro_facturas_maquinaria_maquinaria('');"  title="Imprimir registro en PDF" tabindex="6" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivos-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_facturas_maquinaria_maquinaria"  
									onclick="descargar_archivos_facturas_maquinaria_maquinaria('','');"  title="Descargar archivos" tabindex="7" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_facturas_maquinaria_maquinaria"  
									onclick="verificar_salida_compra_facturas_maquinaria_maquinaria('', '', '',  '');"  title="Cancelar" tabindex="8" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_facturas_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_facturas_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="9">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Facturas-->
	</div><!--#FacturasMaquinariaMaquinariaContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_facturas_maquinaria_maquinaria" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>

	<!-- /.Plantilla para cargar los motivo de cancelación en el combobox-->  
	<script id="cancelacion_motivos_facturas_maquinaria_maquinaria" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#motivos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/motivos}} 
	</script>

		<!-- /.Plantilla para cargar la exportación en el combobox-->  
	<script id="exportacion_facturas_maquinaria_maquinaria" type="text/template">
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
		var intPaginaFacturasMaquinariaMaquinaria = 0;
		var strUltimaBusquedaFacturasMaquinariaMaquinaria = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar en el timbrado y cfdi's relacionados)*/
		var strTipoReferenciaFacturasMaquinariaMaquinaria = "FACTURA MAQUINARIA";
		//Variable que se utiliza para asignar el id del módulo de maquinaria
		var intModuloIDFacturasMaquinariaMaquinaria = <?php echo MODULO_MAQUINARIA ?>;
		//Variable que se utiliza para asignar el id de la exportación base
		var intExportacionBaseIDFacturasMaquinariaMaquinaria = <?php echo EXPORTACION_BASE ?>;
		//Variable que se utiliza para asignar el id del motivo de cancelación: Comprobante emitido con errores con relación.
		var intCancelacionIDRelacionCfdiFacturasMaquinariaMaquinaria = <?php echo MOTIVO_CANCELACION_RELACIONCFDI ?>;
		//Variable que se utiliza para asignar el mensaje de régimen fiscal faltante.
		var strMsjRegimenFiscalCteFacturasMaquinariaMaquinaria = "<?php echo MSJ_ERROR_REGIMEN_FISCAL ?>";

		//Variable que se utiliza para asignar objeto del modal Cancelación del timbrado
		var objCancelacionFacturasMaquinariaMaquinaria = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarFacturasMaquinariaMaquinaria = null;
		//Variable que se utiliza para asignar objeto del modal Relacionar CFDI
		var objRelacionarCfdiFacturasMaquinariaMaquinaria = null;
		//Variable que se utiliza para asignar objeto del modal Facturas
		var objFacturasMaquinariaMaquinaria = null;

		//Array que contiene los id´s de las cajas de texto que se utilizan para calcular la fecha de vencimiento
		var arrFechaVencimientoFacturasMaquinariaMaquinaria  = {fecha: '#txtFecha_facturas_maquinaria_maquinaria',
																condicionesPago:  '#cmbCondicionesPago_facturas_maquinaria_maquinaria',
																diasCredito: 	'#txtMaquinariaCreditoDias_facturas_maquinaria_maquinaria',
																fechaVencimiento: 	'#txtFechaVencimiento_facturas_maquinaria_maquinaria'
																};

		/*******************************************************************************************************************
		Funciones del objeto CFDI's  relacionados (facturas seleccionadas)
		*********************************************************************************************************************/
		// Constructor del objeto CFDI's relacionados (facturas seleccionadas)
		var objCfdisRelacionadosFacturasMaquinariaMaquinaria;
		function CfdisRelacionadosFacturasMaquinariaMaquinaria(cfdis)
		{
			this.arrCfdis = cfdis;
		}

		//Función para obtener todos los cfdi´s seleccionados
		CfdisRelacionadosFacturasMaquinariaMaquinaria.prototype.getCfdis = function() {
		    return this.arrCfdis;
		}

		//Función para agregar un cfdi al objeto 
		CfdisRelacionadosFacturasMaquinariaMaquinaria.prototype.setCfdi = function (cfdi){
			this.arrCfdis.push(cfdi);
		}

		//Función para obtener un cfdi del objeto 
		CfdisRelacionadosFacturasMaquinariaMaquinaria.prototype.getCfdi = function(index) {
		    return this.arrCfdis[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto CFDI a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto CFDI a relacionar
		var objCfdiRelacionarFacturasMaquinariaMaquinaria;
		
		function CfdiRelacionarFacturasMaquinariaMaquinaria(referenciaID, cliente, folio, fecha, tipoReferencia, uuid, importe)
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
		function permisos_facturas_maquinaria_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/facturas_maquinaria/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_facturas_maquinaria_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosFacturasMaquinariaMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosFacturasMaquinariaMaquinaria = strPermisosFacturasMaquinariaMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosFacturasMaquinariaMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosFacturasMaquinariaMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_facturas_maquinaria_maquinaria').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosFacturasMaquinariaMaquinaria[i]=='GUARDAR') || (arrPermisosFacturasMaquinariaMaquinaria[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_facturas_maquinaria_maquinaria').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosFacturasMaquinariaMaquinaria[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_facturas_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosFacturasMaquinariaMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_facturas_maquinaria_maquinaria').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_facturas_maquinaria_maquinaria();
						}
						else if(arrPermisosFacturasMaquinariaMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_facturas_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosFacturasMaquinariaMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_facturas_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosFacturasMaquinariaMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_facturas_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosFacturasMaquinariaMaquinaria[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_facturas_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosFacturasMaquinariaMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_facturas_maquinaria_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}



		//Función para la búsqueda de registros
		function paginacion_facturas_maquinaria_maquinaria() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaFacturasMaquinariaMaquinaria =($('#txtFechaInicialBusq_facturas_maquinaria_maquinaria').val()+$('#txtFechaFinalBusq_facturas_maquinaria_maquinaria').val()+$('#txtProspectoIDBusq_facturas_maquinaria_maquinaria').val()+$('#cmbEstatusBusq_facturas_maquinaria_maquinaria').val()+$('#txtBusqueda_facturas_maquinaria_maquinaria').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaFacturasMaquinariaMaquinaria != strUltimaBusquedaFacturasMaquinariaMaquinaria)
			{
				intPaginaFacturasMaquinariaMaquinaria = 0;
				strUltimaBusquedaFacturasMaquinariaMaquinaria = strNuevaBusquedaFacturasMaquinariaMaquinaria;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('maquinaria/facturas_maquinaria/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_facturas_maquinaria_maquinaria').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_facturas_maquinaria_maquinaria').val()),
					 intProspectoID: $('#txtProspectoIDBusq_facturas_maquinaria_maquinaria').val(),
					 strEstatus: $('#cmbEstatusBusq_facturas_maquinaria_maquinaria').val(),
					 strBusqueda: $('#txtBusqueda_facturas_maquinaria_maquinaria').val(),
					 intPagina: intPaginaFacturasMaquinariaMaquinaria,
					 strPermisosAcceso: $('#txtAcciones_facturas_maquinaria_maquinaria').val()
					},
					function(data){
						$('#dg_facturas_maquinaria_maquinaria tbody').empty();
						var tmpFacturasMaquinariaMaquinaria = Mustache.render($('#plantilla_facturas_maquinaria_maquinaria').html(),data);
						$('#dg_facturas_maquinaria_maquinaria tbody').html(tmpFacturasMaquinariaMaquinaria);
						$('#pagLinks_facturas_maquinaria_maquinaria').html(data.paginacion);
						$('#numElementos_facturas_maquinaria_maquinaria').html(data.total_rows);
						intPaginaFacturasMaquinariaMaquinaria = data.pagina;
					},
			'json');
		}


		//Regresar exportación activa para cargarlas en el combobox
		function cargar_exportacion_facturas_maquinaria_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar la exportación que se encuentra activa
			$.post('contabilidad/sat_exportacion/get_combo_box', {},
				function(data)
				{
					$('#cmbExportacionID_facturas_maquinaria_maquinaria').empty();
					var temp = Mustache.render($('#exportacion_facturas_maquinaria_maquinaria').html(), data);
					$('#cmbExportacionID_facturas_maquinaria_maquinaria').html(temp);
				},
				'json');
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_facturas_maquinaria_maquinaria(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/facturas_maquinaria/';

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
			if ($('#chbImprimirDetalles_facturas_maquinaria_maquinaria').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_facturas_maquinaria_maquinaria').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_facturas_maquinaria_maquinaria').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_facturas_maquinaria_maquinaria').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_facturas_maquinaria_maquinaria').val()),
										'intProspectoID': $('#txtProspectoIDBusq_facturas_maquinaria_maquinaria').val(),
										'strEstatus': $('#cmbEstatusBusq_facturas_maquinaria_maquinaria').val(), 
										'strBusqueda': $('#txtBusqueda_facturas_maquinaria_maquinaria').val(),
										'strDetalles': $('#chbImprimirDetalles_facturas_maquinaria_maquinaria').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_facturas_maquinaria_maquinaria(id) 
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url':  'contabilidad/timbradoV4/get_pdf_facturas',
							'data' : {
										'intReferenciaID':intID,
										'strTipoReferencia':strTipoReferenciaFacturasMaquinariaMaquinaria,
										'strTimbrar': 'NO'		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);	
		}

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_facturas_maquinaria_maquinaria(facturaMaquinariaID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(facturaMaquinariaID == '')
			{
				intID = $('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val();
				strFolio = $('#txtFolio_facturas_maquinaria_maquinaria').val();
			}
			else
			{
				intID = facturaMaquinariaID;
				strFolio = folio;
			}


			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'contabilidad/timbradoV4/descargar_archivos',
							'data' : {
										'intReferenciaID': intID,
										'strTipoReferencia': strTipoReferenciaFacturasMaquinariaMaquinaria,
										'strFolio':strFolio		
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);
		}

		

		/*******************************************************************************************************************
		Funciones del modal Cancelación del timbrado
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cancelacion_facturas_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmCancelacionFacturasMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_facturas_maquinaria_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmCancelacionFacturasMaquinariaMaquinaria').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cancelacion_facturas_maquinaria_maquinaria');
			//Habilitar todos los elementos del formulario
			$('#frmCancelacionFacturasMaquinariaMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_cancelacion_facturas_maquinaria_maquinaria').attr('disabled','disabled');
			//Mostrar botón de Guardar
		    $("#btnGuardar_cancelacion_facturas_maquinaria_maquinaria").show();
		    //Agregar clase para ocultar div que contiene los datos de creación del registro
			$("#divDatosCreacion_cancelacion_facturas_maquinaria_maquinaria").addClass('no-mostrar');
		}

		//Función que se utiliza para abrir el modal
		function abrir_cancelacion_facturas_maquinaria_maquinaria(id, folio, polizaID)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cancelacion_facturas_maquinaria_maquinaria();

			//Asignar datos del registro seleccionado
			$('#txtReferenciaCfdiID_cancelacion_facturas_maquinaria_maquinaria').val(id);
			$('#txtFolio_cancelacion_facturas_maquinaria_maquinaria').val(folio);
			$('#txtPolizaID_cancelacion_facturas_maquinaria_maquinaria').val(polizaID);
			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_cancelacion_facturas_maquinaria_maquinaria').addClass("estatus-ACTIVO");

		    //Abrir modal
			objCancelacionFacturasMaquinariaMaquinaria = $('#CancelacionFacturasMaquinariaMaquinariaBox').bPopup({
												   appendTo: '#FacturasMaquinariaMaquinariaContent', 
						                           contentContainer: 'FacturasMaquinariaMaquinariaM', 
						                           zIndex: 2, 
						                           modalClose: false, 
						                           modal: true, 
						                           follow: [true,false], 
						                           followEasing : "linear", 
						                           easing: "linear", 
						                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#cmbCancelacionMotivoID_cancelacion_facturas_maquinaria_maquinaria').focus();
		}

		//Función para regresar los datos (al formulario) del registro seleccionados
		function ver_cancelacion_facturas_maquinaria_maquinaria(id)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCancelacionID_facturas_maquinaria_maquinaria').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/cancelaciones/get_datos',
	        {
	       		intCancelacionID:intID,
	       		strTipoReferencia:strTipoReferenciaFacturasMaquinariaMaquinaria
	        },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			               //Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cancelacion_facturas_maquinaria_maquinaria();
							//Recuperar valores
							$('#cmbCancelacionMotivoID_cancelacion_facturas_maquinaria_maquinaria').val(data.row.cancelacion_motivo_id);
							$('#txtFolio_cancelacion_facturas_maquinaria_maquinaria').val(data.row.folio_referencia);
							$('#txtFolioSustitucion_cancelacion_facturas_maquinaria_maquinaria').val(data.row.folio_sustitucion);
							$('#txtUsuarioCreacion_cancelacion_facturas_maquinaria_maquinaria').val(data.row.usuario_creacion);
							$('#txtFechaCreacion_cancelacion_facturas_maquinaria_maquinaria').val(data.row.fecha_creacion);

							//Dependiendo del estatus cambiar el color del encabezado 
		   					$('#divEncabezadoModal_cancelacion_facturas_maquinaria_maquinaria').addClass("estatus-INACTIVO");

		   				    //Deshabilitar todos los elementos del formulario
				            $('#frmCancelacionFacturasMaquinariaMaquinaria').find('input, textarea, select').attr('disabled','disabled');
		   					//Ocultar botón de Guardar
				            $("#btnGuardar_cancelacion_facturas_maquinaria_maquinaria").hide();
				            //Remover clase para mostrar div que contiene los datos de creación del registro
							$("#divDatosCreacion_cancelacion_facturas_maquinaria_maquinaria").removeClass('no-mostrar');

							//Abrir modal
							objCancelacionFacturasMaquinariaMaquinaria = $('#CancelacionFacturasMaquinariaMaquinariaBox').bPopup({
												   appendTo: '#FacturasMaquinariaMaquinariaContent', 
						                           contentContainer: 'FacturasMaquinariaMaquinariaM', 
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
		function cerrar_cancelacion_facturas_maquinaria_maquinaria()
		{
			try {
				//Cerrar modal
				objCancelacionFacturasMaquinariaMaquinaria.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cancelacion_facturas_maquinaria_maquinaria();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cancelacion_facturas_maquinaria_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_facturas_maquinaria_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmCancelacionFacturasMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	intCancelacionMotivoID_facturas_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione un motivo'}
											}
										},
										strFolioSustitucion_cancelacion_facturas_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if(value == '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_facturas_maquinaria_maquinaria').val()) === intCancelacionIDRelacionCfdiFacturasMaquinariaMaquinaria) 
					                                    	
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una factura existente'
					                                        };
					                                    }
					                                    else if(value !== '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_facturas_maquinaria_maquinaria').val()) !== intCancelacionIDRelacionCfdiFacturasMaquinariaMaquinaria)
					                                    {

					                                    	//Hacer un llamado a la función para inicializar elementos de la sustitución
					                                    	inicializar_sustitucion_facturas_maquinaria_maquinaria();
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cancelacion_facturas_maquinaria_maquinaria = $('#frmCancelacionFacturasMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_cancelacion_facturas_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cancelacion_facturas_maquinaria_maquinaria.isValid())
			{
				//Hacer un llamado a la función para cancelar el timbrado de un registro
				cancelar_timbrado_facturas_maquinaria_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cancelacion_facturas_maquinaria_maquinaria()
		{
			try
			{
				$('#frmCancelacionFacturasMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para inicializar elementos de la sustitución de CFDI
		function inicializar_sustitucion_facturas_maquinaria_maquinaria()
		{
			
			//Limpiar contenido de las siguientes cajas de texto
           $('#txtSustitucionID_cancelacion_facturas_maquinaria_maquinaria').val('');
           $('#txtUuidSustitucion_cancelacion_facturas_maquinaria_maquinaria').val('');
           $('#txtFolioSustitucion_cancelacion_facturas_maquinaria_maquinaria').val('');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function mostrar_circulo_carga_cancelacion_facturas_maquinaria_maquinaria()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_facturas_maquinaria_maquinaria").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function ocultar_circulo_carga_cancelacion_facturas_maquinaria_maquinaria()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_facturas_maquinaria_maquinaria").addClass('no-mostrar');
		}

		//Regresar motivos de cancelación activos para cargarlos en el combobox
		function cargar_motivos_cancelacion_facturas_maquinaria_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_cancelacion_motivos/get_combo_box', {},
				function(data)
				{
					$('#cmbCancelacionMotivoID_cancelacion_facturas_maquinaria_maquinaria').empty();
					var temp = Mustache.render($('#cancelacion_motivos_facturas_maquinaria_maquinaria').html(), data);
					$('#cmbCancelacionMotivoID_cancelacion_facturas_maquinaria_maquinaria').html(temp);
				},
				'json');
		}

		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cliente_facturas_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmEnviarFacturasMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_facturas_maquinaria_maquinaria();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cliente_facturas_maquinaria_maquinaria');
		}


		//Función que se utiliza para abrir el modal
		function abrir_cliente_facturas_maquinaria_maquinaria(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cliente_facturas_maquinaria_maquinaria();
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/facturas_maquinaria/get_datos',
			       {
			       		intFacturaMaquinariaID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtFacturaMaquinariaID_cliente_facturas_maquinaria_maquinaria').val(data.row.factura_maquinaria_id);
							$('#txtFolio_cliente_facturas_maquinaria_maquinaria').val(data.row.folio);
							$('#txtRazonSocial_cliente_facturas_maquinaria_maquinaria').val(data.row.razon_social);
							$('#txtCorreoElectronico_cliente_facturas_maquinaria_maquinaria').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_cliente_facturas_maquinaria_maquinaria').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_cliente_facturas_maquinaria_maquinaria').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarFacturasMaquinariaMaquinaria = $('#EnviarFacturasMaquinariaMaquinariaBox').bPopup({
																		   appendTo: '#FacturasMaquinariaMaquinariaContent', 
												                           contentContainer: 'FacturasMaquinariaMaquinariaM', 
												                           zIndex: 2, 
												                           modalClose: false, 
												                           modal: true, 
												                           follow: [true,false], 
												                           followEasing : "linear", 
												                           easing: "linear", 
												                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_cliente_facturas_maquinaria_maquinaria').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cliente_facturas_maquinaria_maquinaria()
		{
			try {
				//Cerrar modal
				objEnviarFacturasMaquinariaMaquinaria.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cliente_facturas_maquinaria_maquinaria();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cliente_facturas_maquinaria_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_facturas_maquinaria_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarFacturasMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_cliente_facturas_maquinaria_maquinaria: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_cliente_facturas_maquinaria_maquinaria: {
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
			var bootstrapValidator_cliente_facturas_maquinaria_maquinaria = $('#frmEnviarFacturasMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_cliente_facturas_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cliente_facturas_maquinaria_maquinaria.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_cliente_facturas_maquinaria_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cliente_facturas_maquinaria_maquinaria()
		{
			try
			{
				$('#frmEnviarFacturasMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al cliente
		function enviar_correo_cliente_facturas_maquinaria_maquinaria()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cliente_facturas_maquinaria_maquinaria();
			//Hacer un llamado al método del controlador para enviar correo electrónico al cliente
			$.post('contabilidad/timbradoV4/enviar_correo_electronico_cliente',
					{ 
						intReferenciaID: $('#txtFacturaMaquinariaID_cliente_facturas_maquinaria_maquinaria').val(),
						strTipoReferencia: strTipoReferenciaFacturasMaquinariaMaquinaria,
						strFolio: $('#txtFolio_cliente_facturas_maquinaria_maquinaria').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_cliente_facturas_maquinaria_maquinaria').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_cliente_facturas_maquinaria_maquinaria').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cliente_facturas_maquinaria_maquinaria();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_cliente_facturas_maquinaria_maquinaria();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_facturas_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_cliente_facturas_maquinaria_maquinaria()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_facturas_maquinaria_maquinaria").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_cliente_facturas_maquinaria_maquinaria()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_facturas_maquinaria_maquinaria").addClass('no-mostrar');
		}

		/*******************************************************************************************************************
		Funciones del modal Relacionar CFDI
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_cfdi_facturas_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmRelacionarCfdiFacturasMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_facturas_maquinaria_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarCfdiFacturasMaquinariaMaquinaria').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_cfdi_facturas_maquinaria_maquinaria');
			//Eliminar los datos de la tabla CFDI a relacionar
		    $('#dg_relacionar_cfdi_facturas_maquinaria_maquinaria tbody').empty();
		    $('#numElementos_relacionar_cfdi_facturas_maquinaria_maquinaria').html(0);
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_cfdi_facturas_maquinaria_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_cfdi_facturas_maquinaria_maquinaria();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_facturas_maquinaria_maquinaria').val();
			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_cfdi_facturas_maquinaria_maquinaria').addClass("estatus-"+strEstatus);
			//Abrir modal
			objRelacionarCfdiFacturasMaquinariaMaquinaria = $('#RelacionarCfdiFacturasMaquinariaMaquinariaBox').bPopup({
											  appendTo: '#FacturasMaquinariaMaquinariaContent', 
			                              	  contentContainer: 'FacturasMaquinariaMaquinariaM', 
			                              	  zIndex: 2, 
			                              	  modalClose: false, 
			                              	  modal: true, 
			                              	  follow: [true,false], 
			                              	  followEasing : "linear", 
			                              	  easing: "linear", 
			                             	  modalColor: ('#F0F0F0')});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').focus();
			//Hacer un llamado a la función  para cargar los CFDI´s en el grid
			lista_facturas_relacionar_cfdi_facturas_maquinaria_maquinaria();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_cfdi_facturas_maquinaria_maquinaria()
		{
			try {
				//Cerrar modal
				objRelacionarCfdiFacturasMaquinariaMaquinaria.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_cfdi_facturas_maquinaria_maquinaria()
		{

			//Hacer un llamado a la función para agregar las facturas (CFDI) seleccionadas al  objeto CFDI's  relacionados
			agregar_facturas_relacionar_cfdi_facturas_maquinaria_maquinaria();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_facturas_maquinaria_maquinaria();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarCfdiFacturasMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumCfdi_relacionar_cfdi_facturas_maquinaria_maquinaria: {
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
										strFechaInicialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaFinalBusq_relacionar_cfdi_facturas_maquinaria_maquinaria: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strRazonSocialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_relacionar_cfdi_facturas_maquinaria_maquinaria = $('#frmRelacionarCfdiFacturasMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_relacionar_cfdi_facturas_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_cfdi_facturas_maquinaria_maquinaria.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_cfdi_facturas_maquinaria_maquinaria();
				//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
		  		agregar_cfdi_relacionados_facturas_maquinaria_maquinaria('Nuevo', '');
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_cfdi_facturas_maquinaria_maquinaria()
		{
			try
			{
				$('#frmRelacionarCfdiFacturasMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar CFDI's
		*********************************************************************************************************************/
		//Función para la búsqueda de CFDI's 
		function lista_facturas_relacionar_cfdi_facturas_maquinaria_maquinaria() 
		{
			//Variables que se utilizan para asignar los criterios de búsqueda
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaInicialBusq =  $.formatFechaMysql($('#txtFechaInicialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').val());
			var dteFechaFinalBusq =  $.formatFechaMysql($('#txtFechaFinalBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').val());
			var intProspectoIDBusq =  $('#txtProspectoIDBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').val();

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
						$('#dg_relacionar_cfdi_facturas_maquinaria_maquinaria tbody').empty();
						var tmpRelacionarCfdiFacturasMaquinariaMaquinaria = Mustache.render($('#plantilla_relacionar_cfdi_facturas_maquinaria_maquinaria').html(),data);
						$('#numElementos_relacionar_cfdi_facturas_maquinaria_maquinaria').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_cfdi_facturas_maquinaria_maquinaria').html(data.rows.length);	
						}
						$('#dg_relacionar_cfdi_facturas_maquinaria_maquinaria tbody').html(tmpRelacionarCfdiFacturasMaquinariaMaquinaria);
						
					},
			'json');

			
		}

		//Función para agregar las facturas (CFDI) seleccionadas al objeto CFDI's  relacionados
		function agregar_facturas_relacionar_cfdi_facturas_maquinaria_maquinaria()
		{
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
             
            //Crear instancia del objeto CFDI´s relacionados (facturas seleccionadas)
			objCfdisRelacionadosFacturasMaquinariaMaquinaria = new CfdisRelacionadosFacturasMaquinariaMaquinaria([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_cfdi_facturas_maquinaria_maquinaria tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
                	//Crear instancia del objeto CFDI a relacionar
					objCfdiRelacionarFacturasMaquinariaMaquinaria = new CfdiRelacionarFacturasMaquinariaMaquinaria(null, '', '', '', '', '', '');

                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objCfdiRelacionarFacturasMaquinariaMaquinaria.intReferenciaID = strValor;
							        break;
							    case 1:
							        objCfdiRelacionarFacturasMaquinariaMaquinaria.strCliente = strValor;
							        break;
							    case 2:
							        objCfdiRelacionarFacturasMaquinariaMaquinaria.strFolio = strValor;
							        break;
							    case 3:
							        objCfdiRelacionarFacturasMaquinariaMaquinaria.dteFecha = strValor;
							        break;
							    case 4:
							        objCfdiRelacionarFacturasMaquinariaMaquinaria.strTipoReferencia = strValor;
							        break;
							    case 5:
							       	objCfdiRelacionarFacturasMaquinariaMaquinaria.strUuid = strValor;
							        break;
							    case 6:
							       	objCfdiRelacionarFacturasMaquinariaMaquinaria.intImporte = strValor;
							       	break;
							}

					      	intCol++;
					    });

                	//Agregar datos del cfdi a relacionar
                	objCfdisRelacionadosFacturasMaquinariaMaquinaria.setCfdi(objCfdiRelacionarFacturasMaquinariaMaquinaria);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumCfdi_relacionar_cfdi_facturas_maquinaria_maquinaria').val(intContador);

		}

		/*******************************************************************************************************************
		Funciones del modal Facturas
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_facturas_maquinaria_maquinaria(tipoAccion)
		{
			//Incializar formulario
			$('#frmFacturasMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_facturas_maquinaria_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmFacturasMaquinariaMaquinaria').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_facturas_maquinaria_maquinaria');
			//Eliminar los datos de la tabla CFDI relacionados
		    $('#dg_cfdi_relacionados_facturas_maquinaria_maquinaria tbody').empty();
			$('#numElementos_cfdi_relacionados_facturas_maquinaria_maquinaria').html(0);
			//Hacer un llamado a la función para inicializar elementos de la tabla componentes
			inicializar_componentes_facturas_maquinaria_maquinaria();

			//Si el tipo de acción corresponde a Nuevo
			if(tipoAccion == 'Nuevo')
			{
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_facturas_maquinaria_maquinaria').addClass("estatus-NUEVO");
			}

			//Habilitar todos los elementos del formulario
			$('#frmFacturasMaquinariaMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');

			//Seleccionar tab que contiene la información general de la factura
			$('a[href="#informacion_general_facturas_maquinaria_maquinaria"]').click();
			//Seleccionar tab que contiene la información general del detalle de la factura
	  		$('a[href="#informacion_general_detalle_facturas_maquinaria_maquinaria"]').click();
	  			
	  		//Asignar la fecha actual
			$('#txtFecha_facturas_maquinaria_maquinaria').val(fechaActual()); 
			
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtMoneda_facturas_maquinaria_maquinaria').attr('disabled','disabled');
			$('#txtTipoCambio_facturas_maquinaria_maquinaria').attr('disabled','disabled');
			$('#txtRazonSocial_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtRfc_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			
			//Detalles de la Factura
			$('#txtSerie_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtMotor_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtCodigo_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtDescripcionCorta_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtPrecio_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtPorcentajeDescuento_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtSubtotal_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtPorcentajeIva_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtPorcentajeIeps_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtTotal_facturas_maquinaria_maquinaria').attr("disabled", "disabled");

			//Detalles de los componentes
			$('#txtSerie_componentes_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtMotor_componentes_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtCodigo_componentes_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtDescripcion_componentes_facturas_maquinaria_maquinaria').attr("disabled", "disabled");
			
			//Mostrar por Default 01- No aplica
			$('#cmbExportacionID_facturas_maquinaria_maquinaria').val(intExportacionBaseIDFacturasMaquinariaMaquinaria);

		
			//Mostrar los siguientes botones
			$("#btnGuardar_facturas_maquinaria_maquinaria").show();
			$("#btnBuscarCFDI_facturas_maquinaria_maquinaria").show(); 
			$("#btnReiniciar_facturas_maquinaria_maquinaria").show();
			//Habilitar botón Agregar
			$('#btnAgregar_componentes_facturas_maquinaria_maquinaria').prop('disabled', false);
			
			//Ocultar los siguientes botones
			$("#btnEnviarCorreo_facturas_maquinaria_maquinaria").hide();
			$("#btnDescargarArchivo_facturas_maquinaria_maquinaria").hide();
			$("#btnImprimirRegistro_facturas_maquinaria_maquinaria").hide();
			$("#btnDesactivar_facturas_maquinaria_maquinaria").hide();
			$('#btnVerMotivoCancelacion_facturas_maquinaria_maquinaria').hide();
		}

		//Función para deshabilitar controles del formulario en caso de que exista el id del pedido
		function deshabilitar_controles_facturas_maquinaria_maquinaria(tipoMaquinaria)
		{

			//Mover a el TAB de Información general la vista
	        //Seleccionar tab que contiene la información general de la factura
			$('a[href="#informacion_general_detalle_facturas_maquinaria_maquinaria"]').click();	

			//Se deshabilitaran los campos SERIE y MOTOR, en caso de que la maquinaria sea de tipo Compuesta
			if(tipoMaquinaria == 'COMPUESTA')
			{

				$('#txtMaquinariaTipo_facturas_maquinaria_maquinaria').val('COMPUESTA');
				//Deshabilitar componentes de agregar SERIE y MOTOR
				$('#txtSerie_facturas_maquinaria_maquinaria').attr('disabled','disabled');
				$('#txtMotor_facturas_maquinaria_maquinaria').attr('disabled','disabled');
				//Habilitar los inputs SERI y MOTOR del TAB - COMPONENTES
				$('#txtSerie_componentes_facturas_maquinaria_maquinaria').removeAttr('disabled', 'disabled');
				$('#txtMotor_componentes_facturas_maquinaria_maquinaria').removeAttr('disabled', 'disabled');
				//Habilitar el TAB - COMPONENTES
				$('#tabComponentes_detalle_facturas_maquinaria_maquinaria').removeClass("disabled disabledTab");
			}
			else
			{

				$('#txtMaquinariaTipo_facturas_maquinaria_maquinaria').val('SIMPLE');
				$('#txtSerie_facturas_maquinaria_maquinaria').removeAttr('disabled', 'disabled');
				$('#txtMotor_facturas_maquinaria_maquinaria').removeAttr('disabled', 'disabled');
				//Deshabilitar el TAB - COMPONENTES
				//Agregar clase disabled disabledTab para deshabilitar el siguiente tab
	  			$('#tabComponentes_detalle_facturas_maquinaria_maquinaria').addClass("disabled disabledTab");

			}

		}

		//Función para inicializar elementos del pedido
		function inicializar_pedido_facturas_maquinaria_maquinaria()
		{
			//Limpiar las siguientes cajas de texto
			//Datos del pedido
			$("#txtMonedaID_facturas_maquinaria_maquinaria").val('');
			$("#txtMoneda_facturas_maquinaria_maquinaria").val('');
			$("#txtTipoCambio_facturas_maquinaria_maquinaria").val('');
			$("#txtVendedorID_facturas_maquinaria_maquinaria").val('');
			$("#txtVendedor_facturas_maquinaria_maquinaria").val('');
			$("#txtProspectoID_facturas_maquinaria_maquinaria").val('');
			$("#txtRazonSocial_facturas_maquinaria_maquinaria").val('');
			$("#txtRfc_facturas_maquinaria_maquinaria").val('');
			$('#txtRegimenFiscalID_facturas_maquinaria_maquinaria').val('');
			$("#txtCalle_facturas_maquinaria_maquinaria").val('');
			$("#txtNumeroExterior_facturas_maquinaria_maquinaria").val('');
			$("#txtNumeroInterior_facturas_maquinaria_maquinaria").val('');
			$("#txtCodigoPostal_facturas_maquinaria_maquinaria").val('');
			$("#txtColonia_facturas_maquinaria_maquinaria").val('');
			$("#txtLocalidad_facturas_maquinaria_maquinaria").val('');
			$("#txtMunicipio_facturas_maquinaria_maquinaria").val('');
			$("#txtEstado_facturas_maquinaria_maquinaria").val('');
			$("#txtPais_facturas_maquinaria_maquinaria").val('');
			$("#txtMaquinariaCreditoDias_facturas_maquinaria_maquinaria").val('');
			$('#txtObservaciones_facturas_maquinaria_maquinaria').val('');
			$('#txtNotas_facturas_maquinaria_maquinaria').val('');
			$('#txtMaquinariaTipo_facturas_maquinaria_maquinaria').val('');
			//Seleccionar tab que contiene la información general del detalle de la factura
	  		$('a[href="#informacion_general_detalle_facturas_maquinaria_maquinaria"]').click();

			//Datos del detalle
			$('#txtMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val('');
			$('#txtInventarioMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val('');
			$('#txtConsignacion_facturas_maquinaria_maquinaria').val('');
			$("#txtSerie_facturas_maquinaria_maquinaria").val('');
			$("#txtMotor_facturas_maquinaria_maquinaria").val('');
			$('#txtCodigo_facturas_maquinaria_maquinaria').val('');
			$('#txtDescripcionCorta_facturas_maquinaria_maquinaria').val('');
			$('#txtDescripcion_facturas_maquinaria_maquinaria').val('');
			$('#txtCodigoSat_facturas_maquinaria_maquinaria').val('');
			$('#txtUnidadSat_facturas_maquinaria_maquinaria').val('');
			$('#txtObjetoImpuestoSat_facturas_maquinaria_maquinaria').val('');
			$('#txtPrecio_facturas_maquinaria_maquinaria').val('');
			$('#txtDescuento_facturas_maquinaria_maquinaria').val('');
			$('#txtSubtotal_facturas_maquinaria_maquinaria').val('');
			$('#txtIva_facturas_maquinaria_maquinaria').val('');
			$('#txtIeps_facturas_maquinaria_maquinaria').val('');
			$('#txtTotal_facturas_maquinaria_maquinaria').val('');
			$('#txtPorcentajeDescuento_facturas_maquinaria_maquinaria').val('');
			$('#txtPorcentajeIva_facturas_maquinaria_maquinaria').val('');
			$('#txtPorcentajeIeps_facturas_maquinaria_maquinaria').val('');

			//Datos de los componentes
			//Deshabilitar el TAB - COMPONENTES
			//Agregar clase disabled disabledTab para deshabilitar el siguiente tab
  			$('#tabComponentes_detalle_facturas_maquinaria_maquinaria').addClass("disabled disabledTab");
			//Hacer un llamado a la función para inicializar elementos de la tabla componentes
			inicializar_componentes_facturas_maquinaria_maquinaria();

			//Deshabilitar las siguientes cajas de texto
			$('#txtSerie_facturas_maquinaria_maquinaria').attr('disabled','disabled');
			$('#txtMotor_facturas_maquinaria_maquinaria').attr('disabled','disabled');
		}


		//Función para inicializar elementos de la tabla componentes
		function inicializar_componentes_facturas_maquinaria_maquinaria() 
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val('');
			$("#txtSerie_componentes_facturas_maquinaria_maquinaria").val('');
            $("#txtMotor_componentes_facturas_maquinaria_maquinaria").val('');
            $("#txtConsignacion_componentes_facturas_maquinaria_maquinaria").val('');
            $("#txtCodigo_componentes_facturas_maquinaria_maquinaria").val('');
            $("#txtDescripcion_componentes_facturas_maquinaria_maquinaria").val('');
			
			//Eliminar los datos de la tabla componentes 
			$('#dg_componentes_facturas_maquinaria_maquinaria tbody').empty();
			$('#numElementos_componentes_facturas_maquinaria_maquinaria').html(0);
		}

			
		//Función que se utiliza para cerrar el modal
		function cerrar_facturas_maquinaria_maquinaria()
		{
			try {
				
				//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
				cerrar_cancelacion_facturas_maquinaria_maquinaria();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
				cerrar_cliente_facturas_maquinaria_maquinaria();
				//Hacer un llamado a la función para cerrar modal Relacionar CFDI
				cerrar_relacionar_cfdi_facturas_maquinaria_maquinaria();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_facturas_maquinaria_maquinaria('');
				//Cerrar modal
				objFacturasMaquinariaMaquinaria.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_facturas_maquinaria_maquinaria').focus();
				
			}
			catch(err) {}
		}

		
		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_facturas_maquinaria_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_facturas_maquinaria_maquinaria();

			//Validación del formulario de campos obligatorios
			$('#frmFacturasMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_facturas_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strCondicionesPago_facturas_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una condición de pago'}
											}
										},
										strPedidoMaquinaria_facturas_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                	//Verificar que exista id del pedido
					                                    if($('#txtPedidoMaquinariaID_facturas_maquinaria_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un pedido existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strVendedor_facturas_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vendedor
					                                    if($('#txtVendedorID_facturas_maquinaria_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un vendedor existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFormaPago_facturas_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la forma de pago
					                                    if($('#txtFormaPagoID_facturas_maquinaria_maquinaria').val() === '')
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
										strMetodoPago_facturas_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del método de pago
					                                    if($('#txtMetodoPagoID_facturas_maquinaria_maquinaria').val() === '')
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
										intExportacionID_facturas_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una exportación'}
											}
										},
										strUsoCfdi_facturas_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del uso de CFDI
					                                    if($('#txtUsoCfdiID_facturas_maquinaria_maquinaria').val() === '')
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
										strTipoRelacion_facturas_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if((value !== '' && $('#txtTipoRelacionID_facturas_maquinaria_maquinaria').val() === '') 
					                                    	|| ($('#txtTipoRelacionID_facturas_maquinaria_maquinaria').val() === '' && parseInt($('#txtNumCfdiRelacionados_facturas_maquinaria_maquinaria').val()) > 0))
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
										strSerie_facturas_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista una Serie Existente para una Maquinaria SIMPLE
					                                    if($('#txtSerie_facturas_maquinaria_maquinaria').val() === '' && $('#txtMaquinariaTipo_facturas_maquinaria_maquinaria').val()  == 'SIMPLE')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una serie existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intNumCfdiRelacionados_facturas_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan CFDI relacionados
					                                    if(parseInt($('#txtTipoRelacionID_facturas_maquinaria_maquinaria').val()) > 0 &&
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
										strCodigo_facturas_maquinaria_maquinaria:{
											excluded: true, // Ignorar (no valida el campo)
										},
										strDescripcionCorta_facturas_maquinaria_maquinaria:{
											excluded: true, // Ignorar (no valida el campo)
										},
										intPrecio_facturas_maquinaria_maquinaria:{
											excluded: true, // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_facturas_maquinaria_maquinaria:{
											excluded: true, // Ignorar (no valida el campo)
										},
										intSubtotal_facturas_maquinaria_maquinaria:{
											excluded: true, // Ignorar (no valida el campo)
										},
										intPorcentajeIva_facturas_maquinaria_maquinaria:{
											excluded: true, // Ignorar (no valida el campo)
										},
										intPorcentajeIeps_facturas_maquinaria_maquinaria:{
											excluded: true, // Ignorar (no valida el campo)
										},
										intTotal_facturas_maquinaria_maquinaria:{
											excluded: true, // Ignorar (no valida el campo)
										},
										strSerie_componentes_facturas_maquinaria_maquinaria:{
											excluded: true, // Ignorar (no valida el campo)
										},
										strMotor_componentes_facturas_maquinaria_maquinaria:{
											excluded: true, // Ignorar (no valida el campo)
										},
										strCodigo_componentes_facturas_maquinaria_maquinaria:{
											excluded: true, // Ignorar (no valida el campo)
										},
										strDescripcion_componentes_facturas_maquinaria_maquinaria:{
											excluded: true, // Ignorar (no valida el campo)
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_facturas_maquinaria_maquinaria = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_facturas_maquinaria_maquinaria = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_facturas_maquinaria_maquinaria.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_facturas_maquinaria_maquinaria.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_facturas_maquinaria_maquinaria = $('#frmFacturasMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_facturas_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_facturas_maquinaria_maquinaria.isValid())
			{
				//Hacer un llamado a la función para validar que los componentes cuenten con serie
				validar_componentes_facturas_maquinaria_maquinaria();
			}
			else 
				return;
		}

		//Función que se utiliza para validar que los componentes cuenten con serie
		function validar_componentes_facturas_maquinaria_maquinaria()
		{
			//Obtenemos el objeto de la tabla componentes
			var objTabla = document.getElementById('dg_componentes_facturas_maquinaria_maquinaria').getElementsByTagName('tbody')[0];

			//Array que se utiliza para agregar los componentes incorrectos
			var arrDetallesIncorrectos = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var strCodigo = objRen.cells[0].innerHTML;
				var strDescripcion = objRen.cells[1].innerHTML;
				var strSerie = objRen.cells[2].innerHTML;;
				//Concatenar los datos del componente
				var strComponente = strCodigo+' - '+strDescripcion;

				//Si la serie es igual a cadena vacia
				if(strSerie == '')
				{
					//Agregar refacción en el array, de esta manera, el usuario identificara los componentes incorrectos
					arrDetallesIncorrectos.push(strComponente);
				}
			}

			//Si existen componentes incorrectos
			if(arrDetallesIncorrectos.length > 0)
			{
				//Mensaje que se utiliza para informar al usuario la lista de componentes incorrectos
				var strMensaje = 'La factura no puede guardarse. Los siguientes <b>componentes</b> no tienen serie:<br>';

				//Hacer recorrido para obtener componentes incorrectos
				for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
				{
					//Agregar refacción en el mensaje
            		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
				}

				//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_facturas_maquinaria_maquinaria('error', strMensaje);
			}
			else
			{
				
				//Si tipo de venta es de crédito y no existe clave de autorización
				if($('#cmbCondicionesPago_facturas_maquinaria_maquinaria').val() == 'CREDITO'
					&& ($('#txtClaveAutorizacionID_facturas_maquinaria_maquinaria').val() == '' ||
						$('#txtClaveAutorizacionID_facturas_maquinaria_maquinaria').val() == '0'))
				{

					//Hacer un llamado a la función para validar el crédito disponible del cliente (límite de crédito/saldo vencido)
					validar_credito_cliente_facturas_maquinaria_maquinaria();
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_facturas_maquinaria_maquinaria();
				}
			}

		}

		//Función que se utiliza para validar el crédito disponible del cliente (límite de crédito/saldo vencido)
		function validar_credito_cliente_facturas_maquinaria_maquinaria()
		{
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioFactura = parseFloat($('#txtTipoCambio_facturas_maquinaria_maquinaria').val());
			//Variable que se utiliza para asignar el importe de la factura
			var intImporteFra = parseFloat($.reemplazar($('#txtTotal_facturas_maquinaria_maquinaria').val(), ",", ""));

			//Variable que se utiliza para asignar el límite de crédito
			intCreditoLimite = 0;
			//Variable que se utiliza para asignar el saldo (facturas con adeudo)
			intSaldo = 0;
			//Variable que se utiliza para asignar el saldo vencido
			intSaldoVencido = 0;

		
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
				        	intProspectoID: $("#txtProspectoID_facturas_maquinaria_maquinaria").val(), 
				        	intReferenciaID: $('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val(),
				        	strReferencia: 'MAQUINARIA'
				    		},
				        success: function (data) {
				          	if(data.row)
				          	{	
				          		//Recuperar valores del cliente
				          		intCreditoLimite =  parseFloat($.reemplazar(data.row.maquinaria_credito_limite, ",", ""));
				          		intSaldo =  parseFloat($.reemplazar(data.saldo_maquinaria, ",", ""));
				          		intSaldoVencido =  parseFloat($.reemplazar(data.saldo_vencido_maquinaria, ",", ""));
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
													        	intProspectoID: $("#txtProspectoID_facturas_maquinaria_maquinaria").val(), 
													        	strClave: prompt
													    		},
													        success: function (data) {

													        		//Si existe clave de autorización
													        		if(data.clave_autorizacion_id > 0)
													        		{
													        			//Asignar el id de la clave de autorización
													        			$("#txtClaveAutorizacionID_facturas_maquinaria_maquinaria").val(data.clave_autorizacion_id);

													        			//Hacer un llamado a la función para guardar los datos del registro
													        			guardar_facturas_maquinaria_maquinaria();
													        		}
													        		else
													        		{

															          	//Hacer un llamado a la función para mostrar mensaje de error
																		mensaje_facturas_maquinaria_maquinaria('error', data.mensaje);
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
				guardar_facturas_maquinaria_maquinaria();
            }

		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_facturas_maquinaria_maquinaria()
		{
			try
			{
				$('#frmFacturasMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_facturas_maquinaria_maquinaria()
		{
			//Variables que se utilizan para asignar valores de la factura
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioFactura = parseFloat($('#txtTipoCambio_facturas_maquinaria_maquinaria').val());
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			var intPrecioUnitario = $.reemplazar($('#txtPrecio_facturas_maquinaria_maquinaria').val(), ",", "");
			var intImporteDescuento =  $('#txtDescuento_facturas_maquinaria_maquinaria').val();
			var intImporteIva = $('#txtIva_facturas_maquinaria_maquinaria').val();
			var intImporteIeps = $('#txtIeps_facturas_maquinaria_maquinaria').val();
			
			//Convertir importes a peso mexicano
			intPrecioUnitario = intPrecioUnitario * intTipoCambioFactura;
			intImporteDescuento = intImporteDescuento * intTipoCambioFactura;
			intImporteIva = intImporteIva * intTipoCambioFactura;
			intImporteIeps = intImporteIeps * intTipoCambioFactura;

			//Si existe importe del descuento
			if(intImporteDescuento > 0)
			{	
				//Restar descuento al precio 
				intPrecioUnitario = intPrecioUnitario - intImporteDescuento;
			}

			//Obtenemos el objeto de la tabla CFDI relacionados
			var objTabla = document.getElementById('dg_cfdi_relacionados_facturas_maquinaria_maquinaria').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla CFDI relacionados
			var arrCfdiRelacionado = [];
			var arrTiposRelacion = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Asignar valores a los arrays
				arrCfdiRelacionado.push(objRen.cells[7].innerHTML);
				arrTiposRelacion.push(objRen.cells[3].innerHTML);
			}

			//Obtenemos el objeto de la tabla componentes
			var objTabla = document.getElementById('dg_componentes_facturas_maquinaria_maquinaria').getElementsByTagName('tbody')[0];
			
			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRenglonID = [];
			var arrMaquinariaDescripcionID = [];
			var arrSeries = [];
			var arrMotores = [];
			var arrConsignacion = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{				
				//Asignar valores a los arrays
				arrRenglonID.push(objRen.cells[6].innerHTML);
				arrMaquinariaDescripcionID.push(objRen.cells[5].innerHTML);
				arrSeries.push(objRen.cells[2].innerHTML);
				arrMotores.push(objRen.cells[3].innerHTML);
				arrConsignacion.push(objRen.cells[7].innerHTML);
			}

			//Hacer un llamado a la función para calcular fecha de vencimiento
	       	$.calcularFechaVencimiento(arrFechaVencimientoFacturasMaquinariaMaquinaria);

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('maquinaria/facturas_maquinaria/guardar',
					{ 
						//Datos de la factura
						intFacturaMaquinariaID: $('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_facturas_maquinaria_maquinaria').val()),
						strCondicionesPago: $('#cmbCondicionesPago_facturas_maquinaria_maquinaria').val(),
						dteVencimiento:  $.formatFechaMysql($('#txtFechaVencimiento_facturas_maquinaria_maquinaria').val()),
						intMonedaID: $('#txtMonedaID_facturas_maquinaria_maquinaria').val(),
						intTipoCambio: intTipoCambioFactura,
						intPedidoMaquinariaID: $('#txtPedidoMaquinariaID_facturas_maquinaria_maquinaria').val(),
						intVendedorID: $('#txtVendedorID_facturas_maquinaria_maquinaria').val(),
						intProspectoID: $('#txtProspectoID_facturas_maquinaria_maquinaria').val(),
						strRazonSocial: $('#txtRazonSocial_facturas_maquinaria_maquinaria').val(),
						strRfc: $('#txtRfc_facturas_maquinaria_maquinaria').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_facturas_maquinaria_maquinaria').val(),
						strCalle: $('#txtCalle_facturas_maquinaria_maquinaria').val(),
						strNumeroExterior: $('#txtNumeroExterior_facturas_maquinaria_maquinaria').val(),
						strNumeroInterior: $('#txtNumeroInterior_facturas_maquinaria_maquinaria').val(),
						strCodigoPostal: $('#txtCodigoPostal_facturas_maquinaria_maquinaria').val(),
						strColonia: $('#txtColonia_facturas_maquinaria_maquinaria').val(),
						strLocalidad: $('#txtLocalidad_facturas_maquinaria_maquinaria').val(),
						strMunicipio: $('#txtMunicipio_facturas_maquinaria_maquinaria').val(),
						strEstado: $('#txtEstado_facturas_maquinaria_maquinaria').val(),
						strPais: $('#txtPais_facturas_maquinaria_maquinaria').val(),
						strObservaciones: $('#txtObservaciones_facturas_maquinaria_maquinaria').val(),
						strNotas: $('#txtNotas_facturas_maquinaria_maquinaria').val(),
						intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val(),
						strSerie: $('#txtSerie_facturas_maquinaria_maquinaria').val(),
						strMotor: $('#txtMotor_facturas_maquinaria_maquinaria').val(),
						strConsignacion: $('#txtConsignacion_facturas_maquinaria_maquinaria').val(),
						strCodigo: $('#txtCodigo_facturas_maquinaria_maquinaria').val(),
						strDescripcionCorta: $('#txtDescripcionCorta_facturas_maquinaria_maquinaria').val(),
						strDescripcion: $('#txtDescripcion_facturas_maquinaria_maquinaria').val(),
						strCodigoSat: $('#txtCodigoSat_facturas_maquinaria_maquinaria').val(),
						strUnidadSat: $('#txtUnidadSat_facturas_maquinaria_maquinaria').val(),
						strObjetoImpuestoSat: $('#txtObjetoImpuestoSat_facturas_maquinaria_maquinaria').val(),
						intPrecio: intPrecioUnitario,
						intDescuento: intImporteDescuento,
						intTasaCuotaIva: $('#txtTasaCuotaIva_facturas_maquinaria_maquinaria').val(),
						intIva: intImporteIva,
						intTasaCuotaIeps: $('#txtTasaCuotaIeps_facturas_maquinaria_maquinaria').val(),
						intIeps: intImporteIeps,
						intFormaPagoID: $('#txtFormaPagoID_facturas_maquinaria_maquinaria').val(),
						intMetodoPagoID: $('#txtMetodoPagoID_facturas_maquinaria_maquinaria').val(),
						intUsoCfdiID: $('#txtUsoCfdiID_facturas_maquinaria_maquinaria').val(),
						intTipoRelacionID: $('#txtTipoRelacionID_facturas_maquinaria_maquinaria').val(),
						intExportacionID: $('#cmbExportacionID_facturas_maquinaria_maquinaria').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_facturas_maquinaria_maquinaria').val(),
						//Datos correspondientes a los componentes
						strRenglonID: arrRenglonID.join('|'),
						strMaquinariaDescripcionID: arrMaquinariaDescripcionID.join('|'),
						strSeries: arrSeries.join('|'),
						strMotores: arrMotores.join('|'),
						strConsignacion: arrConsignacion.join('|'),
						//Datos de los CFDI relacionados
						strCfdiRelacionado: arrCfdiRelacionado.join('|'),
						strTiposRelacion: arrTiposRelacion.join('|'),
						//Datos de la clave de autorización (clave generada cuando se excede el límite de crédito/saldo vencido)
						intClaveAutorizacionID:  $('#txtClaveAutorizacionID_facturas_maquinaria_maquinaria').val()
					},
					function(data) {
						if (data.resultado)
						{

							//Si no existe id de la factura de maquinaria, significa que es un nuevo registro   
							if($('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val() == '')
							{
							  	//Asignar el id registrado en la base de datos
                     			$('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val(data.factura_maquinaria_id);
                 			}

                 			//Hacer llamado a la función para cargar  los registros en el grid
							paginacion_facturas_maquinaria_maquinaria();

							//Hacer un llamado a la función para timbrar los datos del registro
							timbrar_facturas_maquinaria_maquinaria($('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val(), 'modal', '', $('#txtRegimenFiscalID_facturas_maquinaria_maquinaria').val());	

							//Si no existe id de la póliza (o se trata de un nuevo registro)
							if(parseInt($('#txtPolizaID_facturas_maquinaria_maquinaria').val()) == 0 || 
								$('#txtEstatus_facturas_maquinaria_maquinaria').val() == '')
							{
								//Hacer un llamado a la función para generar póliza con los datos del registro
								 generar_poliza_facturas_maquinaria_maquinaria('', '', '');
							}
						}

						//Si existe mensaje de error
						if(data.tipo_mensaje == 'error')
						{
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_facturas_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
						}
						
					},
			'json');

		}

		
		//Función para mostrar mensaje de éxito o error
		function mensaje_facturas_maquinaria_maquinaria(tipoMensaje, mensaje, campoID)
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
				new $.Zebra_Dialog(strMsjRegimenFiscalCteFacturasMaquinariaMaquinaria, 
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
			else if(tipoMensaje == 'informacion')
            { 
                //Indicar al usuario el mensaje de información
                new $.Zebra_Dialog(mensaje, {
	                                'type': 'information',
	                                'title': 'Información',
	                                'buttons': [{caption: 'Aceptar',
	                                             callback: function () {
	                                                //Enfocar caja de texto
	                                                $('#txtPedidoMaquinaria_facturas_maquinaria_maquinaria').focus();
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

		//Función para verificar si la factura cuenta con una salida por venta ACTIVO
		function verificar_salida_compra_facturas_maquinaria_maquinaria(id, folio, polizaID, folioPoliza)
		{
		   
		   //Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para asignar el folio del registro
			var strFolio = '';
			//Variable que se utiliza para asignar el id de la póliza
			var intPolizaID = 0;
		    //Variable que se utiliza para asignar el folio de la póliza
			var strFolioPoliza = '';

			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val();
				strFolio = $('#txtFolio_facturas_maquinaria_maquinaria').val();
				intPolizaID = $('#txtPolizaID_facturas_maquinaria_maquinaria').val();
				strFolioPoliza = $('#txtFolioPoliza_facturas_maquinaria_maquinaria').val();
			}
			else
			{
				intID = id;
				strFolio = folio;
				intPolizaID = polizaID;
				strFolioPoliza = folioPoliza;
			}
		   	
		   //Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea cancelar el registro; también se cancelara la póliza con folio: '+strFolioPoliza+'?</strong>',
					             {
					             	'type':     'question',
					              	'title':    'Facturación',
					              	'buttons':  ['Aceptar', 'Cancelar'],
					              	'onClose':  function(caption) {

					                    if(caption == 'Aceptar')
					                    {
					                       //Hacer un llamado al método del controlador para regresar los datos del registro
										   $.post('maquinaria/salidas_maquinaria_venta/verificar_salida_compra',
									       {
									       		intReferenciaID:intID
									       },
									       function(data) {

									        	//Si hay datos del registro 
									            if(data.row)
									            {  
									            	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
												    mensaje_facturas_maquinaria_maquinaria('error', 'No es posible cancelar esta factura ya que presenta una salida por venta ACTIVA');
									            }
									            else
									            {

									            	//Hacer un llamado a la función para abrir el modal Cancelación del timbrado (cambiar estatus y cancelar timbrado del registro)
					                              	abrir_cancelacion_facturas_maquinaria_maquinaria(intID, strFolio, intPolizaID);
									            }
									            
									        },
									       'json');
					                    }

					                }
					                
					             });           

		}


		//Función para cancelar el timbrado de un registro. Cambia el estatus a INACTIVO
		function cancelar_timbrado_facturas_maquinaria_maquinaria()
		{

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cancelacion_facturas_maquinaria_maquinaria();
			 //Hacer un llamado al método del controlador para cancelar un CFDI y posteriormente cambiar el estatus a INACTIVO
	         //----- CÓDIGO PARA PRODUCCIÓN
	          $.post('contabilidad/timbrado_cancelar/set_cancelar',
	          {
	          		//Datos para cancelar el timbrado (CFDI)
	         		intMovimientoID: $('#txtReferenciaCfdiID_cancelacion_facturas_maquinaria_maquinaria').val(),
					strTipoReferencia: strTipoReferenciaFacturasMaquinariaMaquinaria, 
					strUuidSustitucion: $('#txtUuidSustitucion_cancelacion_facturas_maquinaria_maquinaria').val(),
					strMotivo: $('select[name="intCancelacionMotivoID_facturas_maquinaria_maquinaria"] option:selected').text(),
					//Datos para cambiar (administrativamente) el estatus del registro
					intCancelacionMotivoID: $('#cmbCancelacionMotivoID_cancelacion_facturas_maquinaria_maquinaria').val(), 
					intSustitucionID:  $('#txtSustitucionID_cancelacion_facturas_maquinaria_maquinaria').val(),
					intPolizaID: $('#txtPolizaID_cancelacion_facturas_maquinaria_maquinaria').val(), 
			     	strTipoReferenciaReg: $('#txtTipoReferencia_cancelacion_facturas_maquinaria_maquinaria').val(), 
			     	intReferenciaIDReg:  $('#txtReferenciaID_cancelacion_facturas_maquinaria_maquinaria').val()
	          },
	                 function(data) {

	                    if(data.resultado)
	                    {
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_facturas_maquinaria_maquinaria();	

							//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
							cerrar_cancelacion_facturas_maquinaria_maquinaria();  

							//Si el id del registro se obtuvo del modal
							if($('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val() != '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_facturas_maquinaria_maquinaria();     
							}		
	                    }

	                    //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
				        ocultar_circulo_carga_cancelacion_facturas_maquinaria_maquinaria();
					    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_facturas_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);


	                 },
	                'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_facturas_maquinaria_maquinaria(id, cancelacionID)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/facturas_maquinaria/get_datos',
			       {
			       		intFacturaMaquinariaID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_facturas_maquinaria_maquinaria('');
							//Asignar estatus del registro
				        	var strEstatus = data.row.estatus;
				        	//Asignar el id de la póliza
				            var intPolizaID = parseInt(data.row.poliza_id); 
				            //Asignar el id de la clave de autorización
				            var intClaveAutorizacionID = parseInt(data.row.clave_autorizacion_id); 
				        	//Variable que se utiliza para asignar la serie de maquinaria simple
				        	var strSerie = data.row.serie;
				        	//Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				        	//Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);
				            //Variables que se utilizan para asignar valores del detalle
							var intPrecio = parseFloat(data.row.precio);
							var intImporteDescuento = parseFloat(data.row.descuento);
							var intPorcentajeDescuento = 0;

							//Convertir peso mexicano a tipo de cambio
							intPrecio = intPrecio / intTipoCambio;
							intImporteDescuento = intImporteDescuento / intTipoCambio;
							//Si existe importe del descuento
							if(intImporteDescuento > 0)
							{
								intPrecio = intPrecio + intImporteDescuento;
								//Calcular porcentaje del descuento
								intPorcentajeDescuento = (intImporteDescuento / intPrecio) * 100;
							}

				          	//Recuperar valores
				            $('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val(data.row.factura_maquinaria_id);
				            $('#txtFolio_facturas_maquinaria_maquinaria').val(data.row.folio);
				            $('#txtFecha_facturas_maquinaria_maquinaria').val(data.row.fecha_format);
				            $('#cmbCondicionesPago_facturas_maquinaria_maquinaria').val(data.row.condiciones_pago);
				            $('#txtFechaVencimiento_facturas_maquinaria_maquinaria').val(data.row.vencimiento);
				            $('#txtMonedaID_facturas_maquinaria_maquinaria').val(data.row.moneda_id);
				            $('#txtMoneda_facturas_maquinaria_maquinaria').val(data.row.moneda);
				            $('#txtTipoCambio_facturas_maquinaria_maquinaria').val(data.row.tipo_cambio);
				            $('#txtPedidoMaquinariaID_facturas_maquinaria_maquinaria').val(data.row.pedido_maquinaria_id);
				            $('#txtPedidoMaquinaria_facturas_maquinaria_maquinaria').val(data.row.folio_pedido);
				           	$('#txtVendedorID_facturas_maquinaria_maquinaria').val(data.row.vendedor_id);
						    $('#txtVendedor_facturas_maquinaria_maquinaria').val(data.row.vendedor);
				            $('#txtProspectoID_facturas_maquinaria_maquinaria').val(data.row.prospecto_id);
						    $('#txtRazonSocial_facturas_maquinaria_maquinaria').val(data.row.razon_social);
						    $('#txtRfc_facturas_maquinaria_maquinaria').val(data.row.rfc);
						    $('#txtRegimenFiscalID_facturas_maquinaria_maquinaria').val(data.row.regimen_fiscal_id);
						    $('#txtCalle_facturas_maquinaria_maquinaria').val(data.row.calle);
						    $('#txtNumeroExterior_facturas_maquinaria_maquinaria').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_facturas_maquinaria_maquinaria').val(data.row.numero_interior);
						    $('#txtCodigoPostal_facturas_maquinaria_maquinaria').val(data.row.codigo_postal);
						    $('#txtColonia_facturas_maquinaria_maquinaria').val(data.row.colonia);
						    $('#txtLocalidad_facturas_maquinaria_maquinaria').val(data.row.localidad);
						    $('#txtMunicipio_facturas_maquinaria_maquinaria').val(data.row.municipio);
						    $('#txtEstado_facturas_maquinaria_maquinaria').val(data.row.estado);
						    $('#txtPais_facturas_maquinaria_maquinaria').val(data.row.pais);
						    $('#txtMaquinariaCreditoDias_facturas_maquinaria_maquinaria').val(data.row.maquinaria_credito_dias);
						    $('#txtMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val(data.row.maquinaria_descripcion_id);
						    $('#txtInventarioMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val(strSerie);
						    $('#txtSerie_facturas_maquinaria_maquinaria').val(strSerie);
						    $('#txtMotor_facturas_maquinaria_maquinaria').val(data.row.motor);
						    $('#txtCodigo_facturas_maquinaria_maquinaria').val(data.row.codigo);
						    $('#txtDescripcionCorta_facturas_maquinaria_maquinaria').val(data.row.descripcion_corta);
						    $('#txtDescripcion_facturas_maquinaria_maquinaria').val(data.row.descripcion);
						    $('#txtCodigoSat_facturas_maquinaria_maquinaria').val(data.row.codigo_sat);
						    $('#txtUnidadSat_facturas_maquinaria_maquinaria').val(data.row.unidad_sat);
						    $('#txtObjetoImpuestoSat_facturas_maquinaria_maquinaria').val(data.row.objeto_impuesto_sat);
						    $('#txtPrecio_facturas_maquinaria_maquinaria').val(intPrecio);
							$('#txtPorcentajeDescuento_facturas_maquinaria_maquinaria').val(intPorcentajeDescuento);
							$('#txtTasaCuotaIva_facturas_maquinaria_maquinaria').val(data.row.tasa_cuota_iva);
							$('#txtPorcentajeIva_facturas_maquinaria_maquinaria').val(data.row.porcentaje_iva);
						    $('#txtTasaCuotaIeps_facturas_maquinaria_maquinaria').val(data.row.tasa_cuota_ieps);
						    $('#txtPorcentajeIeps_facturas_maquinaria_maquinaria').val(data.row.porcentaje_ieps);
						    //Hacer un llamado a la función para calcular el importe total de la cotización
							calcular_total_facturas_maquinaria_maquinaria();
							//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtPrecio_facturas_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
						    $('#txtFormaPagoID_facturas_maquinaria_maquinaria').val(data.row.forma_pago_id);
						    $('#txtFormaPago_facturas_maquinaria_maquinaria').val(data.row.forma_pago);
						    $('#txtMetodoPagoID_facturas_maquinaria_maquinaria').val(data.row.metodo_pago_id);
						    $('#txtMetodoPago_facturas_maquinaria_maquinaria').val(data.row.metodo_pago);
						    $('#txtUsoCfdiID_facturas_maquinaria_maquinaria').val(data.row.uso_cfdi_id);
						    $('#txtUsoCfdi_facturas_maquinaria_maquinaria').val(data.row.uso_cfdi);
						    $('#txtTipoRelacionID_facturas_maquinaria_maquinaria').val(data.row.tipo_relacion_id);
						    $('#txtTipoRelacion_facturas_maquinaria_maquinaria').val(data.row.tipo_relacion);
						    $('#cmbExportacionID_facturas_maquinaria_maquinaria').val(data.row.exportacion_id);
						    $('#txtObservaciones_facturas_maquinaria_maquinaria').val(data.row.observaciones);
						    $('#txtNotas_facturas_maquinaria_maquinaria').val(data.row.notas);
						    $('#txtPolizaID_facturas_maquinaria_maquinaria').val(intPolizaID);
						    $('#txtFolioPoliza_facturas_maquinaria_maquinaria').val(data.row.folio_poliza);
						    $('#txtClaveAutorizacionID_facturas_maquinaria_maquinaria').val(intClaveAutorizacionID);
						    $('#txtEstatus_facturas_maquinaria_maquinaria').val(strEstatus);

							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_facturas_maquinaria_maquinaria').addClass("estatus-"+strEstatus);
				           
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_facturas_maquinaria_maquinaria").show();

				            //Deshabilitar folio del pedido
	   						$('#txtPedidoMaquinaria_facturas_maquinaria_maquinaria').attr('disabled','disabled');

				            //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar botón Descargar Archivo
				            	$("#btnDescargarArchivo_facturas_maquinaria_maquinaria").show();
				           	}


				           	//Si el estatus del registro es TIMBRAR
				            if(strEstatus == 'TIMBRAR')
							{

								//Si existe id de la póliza
								if(intPolizaID > 0)
								{
									//Hacer un llamado a la función para habilitar campos de timbrado
				            		habilitar_controles_timbrado_facturas_maquinaria_maquinaria();
								}
								else
								{
									strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
												   " onclick='editar_renglon_componentes_facturas_maquinaria_maquinaria(this)'>" +
												   "<span class='glyphicon glyphicon-edit'></span></button>"; 

									//Si no existe serie de la maquinaria simple
			  						if(strSerie == '')
			  						{
			  							//Habilitar las siguientes cajas de texto (para modificar datos de los componentes)
							            $('#txtSerie_componentes_facturas_maquinaria_maquinaria').removeAttr('disabled');
									    $('#txtMotor_componentes_facturas_maquinaria_maquinaria').removeAttr('disabled');
			  						}
			  						else
			  						{
			  							//Habilitar las siguientes cajas de texto
							            $('#txtSerie_facturas_maquinaria_maquinaria').removeAttr('disabled');
									    $('#txtMotor_facturas_maquinaria_maquinaria').removeAttr('disabled');
			  						}
								}

				            	
		  						

							}
							else
							{
								//Si el estatus del registro es ACTIVO
								if(strEstatus == 'ACTIVO')
								{
									//Mostrar los siguientes botones
					            	$('#btnEnviarCorreo_facturas_maquinaria_maquinaria').show();

					            	//Si existe el id de la póliza
					            	if(intPolizaID > 0)
						            {
						            	$('#btnDesactivar_facturas_maquinaria_maquinaria').show();
						            }
								}

								//Deshabilitar todos los elementos del formulario
				            	$('#frmFacturasMaquinariaMaquinaria').find('input, textarea, select').attr('disabled','disabled');
					            //Ocultar los siguientes botones
					            $("#btnReiniciar_facturas_maquinaria_maquinaria").hide();
								$("#btnGuardar_facturas_maquinaria_maquinaria").hide();
								$("#btnBuscarCFDI_facturas_maquinaria_maquinaria").hide(); 
								//Deshabilitar botón Agregar
								$('#btnAgregar_componentes_facturas_maquinaria_maquinaria').prop('disabled', true);

								//Si existe id de la cancelación del CFDI
								if(cancelacionID > 0)
								{	
									//Asignar el id de la cancelación
									$("#txtCancelacionID_facturas_maquinaria_maquinaria").val(cancelacionID); 
									//Mostrar botón Motivo de cancelación
									$("#btnVerMotivoCancelacion_facturas_maquinaria_maquinaria").show(); 
								}
								
							}

							//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
							agregar_cfdi_relacionados_facturas_maquinaria_maquinaria('Editar', strEstatus);	

							//Si la factura (sin timbrar) tiene pagos (abonos) / tiene clave de autorización
							if(strEstatus == 'TIMBRAR' && (data.abonos > 0 || intClaveAutorizacionID > 0))
							{
								//No mostrar acciones de la tabla
								strAccionesTabla = '';
								//Variable que se utiliza para asignar el mensaje informativo
								var strMensaje = '';

								//Deshabilitar las siguientes cajas de texto
								$('#txtRazonSocial_facturas_maquinaria_maquinaria').attr('disabled','disabled');
								$('#txtMetodoPago_facturas_maquinaria_maquinaria').attr('disabled','disabled');
								$('#cmbCondicionesPago_facturas_maquinaria_maquinaria').attr('disabled','disabled');
								$('#txtSerie_facturas_maquinaria_maquinaria').attr('disabled','disabled');
								$('#txtMotor_facturas_maquinaria_maquinaria').attr('disabled','disabled');
								$('#txtSerie_componentes_facturas_maquinaria_maquinaria').attr('disabled','disabled');
								$('#txtMotor_componentes_facturas_maquinaria_maquinaria').attr('disabled','disabled');

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
								mensaje_facturas_maquinaria_maquinaria('error', strMensaje);

							}
							

							//Si la maquinaria es de tipo Compuesta
				       	    if(data.detalles)
				       	    {
				       	    	//Deshabilitar inputs Serie y Motor para maquinaria simple
		                    	$('#txtSerie_facturas_maquinaria_maquinaria').attr('disabled','disabled');
		                    	$('#txtMotor_facturas_maquinaria_maquinaria').attr('disabled','disabled');
		                    	//Quitar clase disabled disabledTab para habilitar el tab - componentes
		  						$('#tabComponentes_detalle_facturas_maquinaria_maquinaria').removeClass("disabled disabledTab");

		                    	//Mostramos los componentes que componen la maquinaria(En caso de que aplique)
								for (var intCon in data.detalles) 
					            {	
					            	//Obtenemos el objeto de la tabla
									var objTabla = document.getElementById('dg_componentes_facturas_maquinaria_maquinaria').getElementsByTagName('tbody')[0];
									
									//Insertamos el renglón con sus celdas en el objeto de la tabla
									var objRenglon = objTabla.insertRow();
									var objCeldaCodigo = objRenglon.insertCell(0);
									var objCeldaDescripcionCorta = objRenglon.insertCell(1);
									var objCeldaSerie = objRenglon.insertCell(2);
									var objCeldaMotor = objRenglon.insertCell(3);
									var objCeldaAcciones = objRenglon.insertCell(4);
									//Columnas ocultas
									var objCeldaMaquinariaDescripcionID = objRenglon.insertCell(5);
									var objCeldaRenglonID = objRenglon.insertCell(6);
									var objCeldaConsignacion = objRenglon.insertCell(7);

									//Asignar valores
									objRenglon.setAttribute('class', 'movil');
									objRenglon.setAttribute('id', data.detalles[intCon].componente_codigo); 
									objCeldaCodigo.setAttribute('class', 'movil d1');
									objCeldaCodigo.innerHTML = data.detalles[intCon].componente_codigo;
									objCeldaDescripcionCorta.setAttribute('class', 'movil d2');
									objCeldaDescripcionCorta.innerHTML = data.detalles[intCon].componente_descripcion_corta;
									objCeldaSerie.setAttribute('class', 'movil d3');
									objCeldaSerie.innerHTML = data.detalles[intCon].componente_serie;
									objCeldaMotor.setAttribute('class', 'movil d4');
									objCeldaMotor.innerHTML = data.detalles[intCon].componente_motor;
									objCeldaAcciones.setAttribute('class', 'td-center movil d5');
									objCeldaAcciones.innerHTML = strAccionesTabla;
									objCeldaMaquinariaDescripcionID.setAttribute('class', 'no-mostrar');
									objCeldaMaquinariaDescripcionID.innerHTML = data.detalles[intCon].componente_maquinaria_descripcion_id;
									objCeldaRenglonID.setAttribute('class', 'no-mostrar');
									objCeldaRenglonID.innerHTML = data.detalles[intCon].renglon;
									objCeldaConsignacion.setAttribute('class', 'no-mostrar');
									objCeldaConsignacion.innerHTML = data.detalles[intCon].componente_consignacion;
					            }

					            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
								var intFilas = $("#dg_componentes_facturas_maquinaria_maquinaria tr").length - 1;
								$('#numElementos_componentes_facturas_maquinaria_maquinaria').html(intFilas);
				       	    }
				       	    else
				       	    {
				       	    	//Agregar clase disabled disabledTab para deshabilitar el tab - componentes
	  							$('#tabComponentes_detalle_facturas_maquinaria_maquinaria').addClass("disabled disabledTab");
				       	    }
							
			            	//Abrir modal
				            objFacturasMaquinariaMaquinaria = $('#FacturasMaquinariaMaquinariaBox').bPopup({
														  appendTo: '#FacturasMaquinariaMaquinariaContent', 
							                              contentContainer: 'FacturasMaquinariaMaquinariaM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#cmbCondicionesPago_facturas_maquinaria_maquinaria').focus();
			       	    }
			       },
			       'json');
		}


		//Función para regresar y obtener los datos de un pedido
		function get_datos_pedido_facturas_maquinaria_maquinaria()
		{
		 	//Hacer un llamado al método del controlador para regresar los datos del pedido
             $.post('maquinaria/pedidos_maquinaria/get_datos',
                  { 
                  	intPedidoMaquinariaID: $("#txtPedidoMaquinariaID_facturas_maquinaria_maquinaria").val()
                  },
                  function(data) {

                    if(data.row){

                       //Asignar datos del registro seleccionado
                       //Datos del pedido
                       $("#txtVendedorID_facturas_maquinaria_maquinaria").val(data.row.vendedor_id);
                       $("#txtVendedor_facturas_maquinaria_maquinaria").val(data.row.vendedor);
                       $("#txtMonedaID_facturas_maquinaria_maquinaria").val(data.row.moneda_id);
                       $("#txtMoneda_facturas_maquinaria_maquinaria").val(data.row.moneda);
                       $("#txtTipoCambio_facturas_maquinaria_maquinaria").val(data.row.tipo_cambio);
                       $("#txtProspectoID_facturas_maquinaria_maquinaria").val(data.row.prospecto_id);
                       $("#txtRazonSocial_facturas_maquinaria_maquinaria").val(data.row.razon_social);
                       $("#txtRfc_facturas_maquinaria_maquinaria").val(data.row.rfc);
                       $('#txtRegimenFiscalID_facturas_maquinaria_maquinaria').val(data.row.regimen_fiscal_id);
                       $("#txtCalle_facturas_maquinaria_maquinaria").val(data.row.cliente_calle);
                       $("#txtNumeroExterior_facturas_maquinaria_maquinaria").val(data.row.cliente_numero_exterior);
                       $("#txtNumeroInterior_facturas_maquinaria_maquinaria").val(data.row.cliente_numero_interior);
                       $("#txtCodigoPostal_facturas_maquinaria_maquinaria").val(data.row.cliente_codigo_postal);
                       $("#txtColonia_facturas_maquinaria_maquinaria").val(data.row.cliente_colonia);
                       $("#txtLocalidad_facturas_maquinaria_maquinaria").val(data.row.cliente_localidad);
                       $("#txtMunicipio_facturas_maquinaria_maquinaria").val(data.row.cliente_municipio);
                       $("#txtEstado_facturas_maquinaria_maquinaria").val(data.row.cliente_estado);
                       $("#txtPais_facturas_maquinaria_maquinaria").val(data.row.cliente_pais);
                       $("#txtMaquinariaCreditoDias_facturas_maquinaria_maquinaria").val(data.row.maquinaria_credito_dias);
                       $('#txtObservaciones_facturas_maquinaria_maquinaria').val(data.row.observaciones);
					   $('#txtNotas_facturas_maquinaria_maquinaria').val(data.row.notas);
                       //Datos del detalle
                       $('#txtMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val(data.row.maquinaria_descripcion_id);
                       $('#txtInventarioMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val(data.row.serie);
                       $('#txtCodigo_facturas_maquinaria_maquinaria').val(data.row.codigo);
					   $('#txtDescripcionCorta_facturas_maquinaria_maquinaria').val(data.row.descripcion_corta);
					   $('#txtDescripcion_facturas_maquinaria_maquinaria').val(data.row.descripcion);
					   $('#txtCodigoSat_facturas_maquinaria_maquinaria').val(data.row.codigo_sat);
					   $('#txtUnidadSat_facturas_maquinaria_maquinaria').val(data.row.unidad_sat);
					   $('#txtObjetoImpuestoSat_facturas_maquinaria_maquinaria').val(data.row.objeto_impuesto_sat);
					   $('#txtTasaCuotaIva_facturas_maquinaria_maquinaria').val(data.row.tasa_cuota_iva);
					   $('#txtTasaCuotaIeps_facturas_maquinaria_maquinaria').val(data.row.tasa_cuota_ieps);

					   //Variable que se utiliza para asignar el tipo de cambio
			            var intTipoCambio = parseFloat(data.row.tipo_cambio);

			            //Variables que se utilizan para asignar valores del detalle
						var intSubtotal = parseFloat(data.row.precio);
						var intPrecio = parseFloat(data.row.precio);
						var intImporteDescuento = parseFloat(data.row.descuento);
						var intImporteIva = parseFloat(data.row.iva);
						var intImporteIeps = parseFloat(data.row.ieps);
						var intPorcentajeDescuento = 0;
						var intPorcentajeIva = 0;
						var intPorcentajeIeps = 0;
						var intTotal = 0;

						//Convertir peso mexicano a tipo de cambio
						intSubtotal = intSubtotal / intTipoCambio;
						intPrecio = intPrecio / intTipoCambio;
						intImporteDescuento = intImporteDescuento / intTipoCambio;
						intImporteIva = intImporteIva / intTipoCambio;
						intImporteIeps = intImporteIeps / intTipoCambio;

						//Si existe importe del descuento
						if(intImporteDescuento > 0)
						{
							intPrecio = intPrecio + intImporteDescuento;
							//Calcular porcentaje del descuento
							intPorcentajeDescuento = (intImporteDescuento / intPrecio) * 100;
						}
						
						//Si existe importe de IVA
						if(intImporteIva > 0)
						{
							//Calcular porcentaje del IVA
							intPorcentajeIva = (intImporteIva / intSubtotal) * 100;
						}

						//Si existe importe de IEPS unitario
						if(intImporteIeps > 0)
						{
							//Calcular porcentaje del IEPS
							intPorcentajeIeps = (intImporteIeps / intSubtotal) * 100;
						}

						//Calcular importe total
						intTotal = intSubtotal + intImporteIva + intImporteIeps;

						//Convertir cantidad a formato moneda
						intPrecio = formatMoney(intPrecio, 2, '');
						intSubtotal = formatMoney(intSubtotal, 2, '');
						intTotal = formatMoney(intTotal, 2, '');
						intPorcentajeDescuento = formatMoney(intPorcentajeDescuento, 2, ''); 
						intPorcentajeIva = formatMoney(intPorcentajeIva, 2, ''); 
						intPorcentajeIeps = formatMoney(intPorcentajeIeps, 2, ''); 

						//Asignar datos a las siguientes cajas de texto
						$('#txtPrecio_facturas_maquinaria_maquinaria').val(intPrecio);
						$('#txtDescuento_facturas_maquinaria_maquinaria').val(intImporteDescuento);
						$('#txtSubtotal_facturas_maquinaria_maquinaria').val(intSubtotal);
						$('#txtIva_facturas_maquinaria_maquinaria').val(intImporteIva);
						$('#txtIeps_facturas_maquinaria_maquinaria').val(intImporteIeps);
						$('#txtTotal_facturas_maquinaria_maquinaria').val(intTotal);
						$('#txtPorcentajeDescuento_facturas_maquinaria_maquinaria').val(intPorcentajeDescuento);
						$('#txtPorcentajeIva_facturas_maquinaria_maquinaria').val(data.row.porcentaje_iva);
						$('#txtPorcentajeIeps_facturas_maquinaria_maquinaria').val(data.row.porcentaje_ieps);
						
						//Eliminar los datos de la tabla componentes
						$('#dg_componentes_facturas_maquinaria_maquinaria tbody').empty();
						$('#numElementos_componentes_facturas_maquinaria_maquinaria').html(0);

						//Si la MAQUINARIA del pedido no cuenta con componentes adjuntos
						if(data.componentes_maquinaria){
							//Hacer un llamado a la función para deshabilitar controles del formulario (dependiendo del tipo de maquinaria)
							deshabilitar_controles_facturas_maquinaria_maquinaria('COMPUESTA');
							//Mostramos los componentes que componen la maquinaria(En caso de que aplique)
							for (var intCon in data.componentes_maquinaria) 
				            {	
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_componentes_facturas_maquinaria_maquinaria').getElementsByTagName('tbody')[0];
								
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaCodigo = objRenglon.insertCell(0);
								var objCeldaDescripcionCorta = objRenglon.insertCell(1);
								var objCeldaSerie = objRenglon.insertCell(2);
								var objCeldaMotor = objRenglon.insertCell(3);
								var objCeldaAcciones = objRenglon.insertCell(4);
								//Columnas ocultas
								var objCeldaMaquinariaDescripcionID = objRenglon.insertCell(5);
								var objCeldaRenglonID = objRenglon.insertCell(6);
								var objCeldaConsignacion = objRenglon.insertCell(7);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.componentes_maquinaria[intCon].codigo); 
								objCeldaCodigo.setAttribute('class', 'movil b1');
								objCeldaCodigo.innerHTML = data.componentes_maquinaria[intCon].codigo;
								objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
								objCeldaDescripcionCorta.innerHTML = data.componentes_maquinaria[intCon].descripcion_corta;
								objCeldaSerie.setAttribute('class', 'movil b3');
								objCeldaSerie.innerHTML = '';
								objCeldaMotor.setAttribute('class', 'movil b2');
								objCeldaMotor.innerHTML = '';
								objCeldaAcciones.setAttribute('class', 'td-center movil b10');
								objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_componentes_facturas_maquinaria_maquinaria(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>";
								objCeldaMaquinariaDescripcionID.setAttribute('class', 'no-mostrar');
								objCeldaMaquinariaDescripcionID.innerHTML = data.componentes_maquinaria[intCon].maquinaria_descripcion_componente_id;
								objCeldaRenglonID.setAttribute('class', 'no-mostrar');
								objCeldaRenglonID.innerHTML = 0;//Asignar valor cero para indicar que se trata de un nuevo registro
								objCeldaConsignacion.setAttribute('class', 'no-mostrar');
								objCeldaConsignacion.innerHTML = '';

								//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
								var intFilas = $("#dg_componentes_facturas_maquinaria_maquinaria tr").length - 1;
								$('#numElementos_componentes_facturas_maquinaria_maquinaria').html(intFilas);
				            }

						}
						else
						{
							//Hacer un llamado a la función para deshabilitar controles del formulario (dependiendo del tipo de maquinaria)
							deshabilitar_controles_facturas_maquinaria_maquinaria('SIMPLE');
						}

                    }
                  }
                 ,
                'json');

		}


		//Función para habilitar controles del formulario correspondientes al timbrado
		function habilitar_controles_timbrado_facturas_maquinaria_maquinaria()
		{
			//Deshabilitar todos los elementos del formulario
        	$('#frmFacturasMaquinariaMaquinaria').find('input, textarea, select').attr('disabled','disabled');
        	//Habilitar las siguientes cajas de texto
        	$('#txtFormaPago_facturas_maquinaria_maquinaria').removeAttr('disabled');
        	$('#txtMetodoPago_facturas_maquinaria_maquinaria').removeAttr('disabled');
        	$('#txtUsoCfdi_facturas_maquinaria_maquinaria').removeAttr('disabled');
        	$('#txtTipoRelacion_facturas_maquinaria_maquinaria').removeAttr('disabled');
        	$('#cmbExportacionID_facturas_maquinaria_maquinaria').removeAttr('disabled');
        	$('#txtObservaciones_facturas_maquinaria_maquinaria').removeAttr('disabled');
        	$('#txtNotas_facturas_maquinaria_maquinaria').removeAttr('disabled');
        	//Deshabilitar botón Agregar
			$('#btnAgregar_componentes_facturas_maquinaria_maquinaria').prop('disabled', true);
		}

		
		//Función para generar póliza con los datos de un registro
		function generar_poliza_facturas_maquinaria_maquinaria(id, estatus, formulario)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_facturas_maquinaria_maquinaria(formulario);
			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaFacturasMaquinariaMaquinaria, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_facturas_maquinaria_maquinaria').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_facturas_maquinaria_maquinaria(formulario);
			    //Si existe resultado
				if (data.resultado)
				{
					//Asignar el id de la póliza (generada) y evitar duplicidad de datos en caso de que no sea posible timbrar el registro
                    $('#txtPolizaID_facturas_maquinaria_maquinaria').val(data.poliza_id);
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_facturas_maquinaria_maquinaria();
					
				}

				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_facturas_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);

		     },
		     'json');
		}



		//Función para timbrar los datos de un registro
		function timbrar_facturas_maquinaria_maquinaria(id, tipo, formulario, regimenFiscalID)
		{
			//Si existe id del régimen fiscal
			if(regimenFiscalID > 0)
			{
				//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
				mostrar_circulo_carga_facturas_maquinaria_maquinaria(formulario);

				//Hacer un llamado al método del controlador para timbrar los datos del registro
				$.post('contabilidad/timbradoV4/set_timbrar',
			     {
			     	intReferenciaID: id,
			      	strTipoReferencia: strTipoReferenciaFacturasMaquinariaMaquinaria
			     },
			     function(data) {
					//Si el id del registro se obtuvo del modal
					if(tipo == 'modal')
					{
						//Si existe resultado (los datos se timbraron correctamente)
						if (data.resultado)
						{

							//Hacer un llamado a la función para cerrar modal
							cerrar_facturas_maquinaria_maquinaria();  
						}
						else
						{
							//Hacer un llamado a la función para limpiar los mensajes de error 
							limpiar_mensajes_facturas_maquinaria_maquinaria();
							//Hacer un llamado a la función para cargar datos del registro (habilitar campos de timbrado)
							editar_facturas_maquinaria_maquinaria(id,'Nuevo');

						}
					}

					//Hacer llamado a la función para cargar  los registros en el grid
				    paginacion_facturas_maquinaria_maquinaria();
					//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		            ocultar_circulo_carga_facturas_maquinaria_maquinaria(formulario);
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_facturas_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
			}
			else
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				 mensaje_facturas_maquinaria_maquinaria('error_regimen_fiscal');
			}
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function mostrar_circulo_carga_facturas_maquinaria_maquinaria(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_facturas_maquinaria_maquinaria';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_facturas_maquinaria_maquinaria';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function ocultar_circulo_carga_facturas_maquinaria_maquinaria(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_facturas_maquinaria_maquinaria';

			//Si el Div a ocultar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_facturas_maquinaria_maquinaria';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}


	    //Función que se utiliza para calcular el importe total de la factura
		function calcular_total_facturas_maquinaria_maquinaria()
		{
			//Variable que se utiliza para asignar el subtotal
			var intSubtotal= 0;
			//Variable que se utiliza para asigna el importe del descuento
			var intImporteDescuento = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_facturas_maquinaria_maquinaria').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_facturas_maquinaria_maquinaria').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_facturas_maquinaria_maquinaria').val();

         	//Verificar que exista importe del precio
			if($('#txtPrecio_facturas_maquinaria_maquinaria').val() != '')
			{ 
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intSubtotal = parseFloat($.reemplazar($("#txtPrecio_facturas_maquinaria_maquinaria").val(), ",", ""));
				//Verificar que exista porcentaje del descuento
				if(intPorcentajeDescuento == '')
				{ 	
					//Asignar valor de cero
					intPorcentajeDescuento = 0;
				}
				else 
				{
					//Hacer un llamado a la función para reemplazar ',' por cadena vacia
					intPorcentajeDescuento = parseFloat($.reemplazar(intPorcentajeDescuento, ",", ""));
					//Verificar que el porcentaje no sea mayor que 100
					if(intPorcentajeDescuento > 100)
					{
						//Asignar valor de cero
						intPorcentajeDescuento = 0;
					}
					else
					{
						//Calcular importe del descuento
						intImporteDescuento =  (intSubtotal * intPorcentajeDescuento) / 100;
						//Restar descuento del subtotal
						intSubtotal = intSubtotal - intImporteDescuento;
					}
				}

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
			intSubtotal = formatMoney(intSubtotal, 2, '');
			intPorcentajeDescuento = formatMoney(intPorcentajeDescuento, 2, ''); 

			//Asignar importe total 
			$('#txtTotal_facturas_maquinaria_maquinaria').val(intTotal);
			$('#txtSubtotal_facturas_maquinaria_maquinaria').val(intSubtotal);
			$('#txtPorcentajeDescuento_facturas_maquinaria_maquinaria').val(intPorcentajeDescuento);
			$('#txtDescuento_facturas_maquinaria_maquinaria').val(intImporteDescuento);
			$('#txtIva_facturas_maquinaria_maquinaria').val(intImporteIva);
			$('#txtIeps_facturas_maquinaria_maquinaria').val(intImporteIeps);
		}
		
		
		
		/*******************************************************************************************************************
		Funciones de la tabla componentes
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_componentes_facturas_maquinaria_maquinaria()
		{
			//Obtenemos los datos de las cajas de texto
			var strCodigo = $('#txtCodigo_componentes_facturas_maquinaria_maquinaria').val();
			var strSerie = $('#txtSerie_componentes_facturas_maquinaria_maquinaria').val();
			var strMotor = $('#txtMotor_componentes_facturas_maquinaria_maquinaria').val();
			var strConsignacion = $('#txtConsignacion_componentes_facturas_maquinaria_maquinaria').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_componentes_facturas_maquinaria_maquinaria').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (strSerie == '')
			{
				//Enfocar caja de texto
				$('#txtSerie_componentes_facturas_maquinaria_maquinaria').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtInventarioMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val('');
				$('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val('');
				$('#txtCodigo_componentes_facturas_maquinaria_maquinaria').val('');
				$('#txtDescripcion_componentes_facturas_maquinaria_maquinaria').val('');
				$('#txtSerie_componentes_facturas_maquinaria_maquinaria').val('');
				$('#txtMotor_componentes_facturas_maquinaria_maquinaria').val('');
				$('#txtConsignacion_componentes_facturas_maquinaria_maquinaria').val('');
				
				//Revisamos si existe el código proporcionado, si es así, editamos los datos
				if (objTabla.rows.namedItem(strCodigo))
				{
					objTabla.rows.namedItem(strCodigo).cells[2].innerHTML = strSerie;
					objTabla.rows.namedItem(strCodigo).cells[3].innerHTML = strMotor; 
					objTabla.rows.namedItem(strCodigo).cells[7].innerHTML = strConsignacion; 
				}
				
				//Enfocar caja de texto
				$('#txtSerie_componentes_facturas_maquinaria_maquinaria').focus();
			}

		}


		 //Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_componentes_facturas_maquinaria_maquinaria(objRenglon)
		{

			$('#txtCodigo_componentes_facturas_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_componentes_facturas_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtSerie_componentes_facturas_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtMotor_componentes_facturas_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[5].innerHTML);
			$('#txtConsignacion_componentes_facturas_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[7].innerHTML);

			//Enfocar caja de texto
			$('#txtSerie_componentes_facturas_maquinaria_maquinaria').focus();

		}


		/*******************************************************************************************************************
		Funciones de la tabla CFDI relacionados
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_cfdi_relacionados_facturas_maquinaria_maquinaria(tipoAccion, estatus)
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Si se cumple la sentencia
			if(estatus == '' || estatus == 'TIMBRAR')
			{
				strAccionesTabla = "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_cfdi_relacionados_facturas_maquinaria_maquinaria(this)'>" + 
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
							intReferenciaID: $('#txtFacturaMaquinariaID_facturas_maquinaria_maquinaria').val(),
							strTipoReferencia: strTipoReferenciaFacturasMaquinariaMaquinaria
						},
						function(data){

							//Mostramos los CFDI´s relacionados (facturas seleccionadas)
				           	for (var intCon in data.rows) 
				            {

				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_cfdi_relacionados_facturas_maquinaria_maquinaria').getElementsByTagName('tbody')[0];

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
							var intFilas = $("#dg_cfdi_relacionados_facturas_maquinaria_maquinaria tr").length - 1;
							$('#numElementos_cfdi_relacionados_facturas_maquinaria_maquinaria').html(intFilas);
							$('#txtNumCfdiRelacionados_facturas_maquinaria_maquinaria').val(intFilas);
						},
				'json');
			}
			else
			{
				//Mostramos los CFDI´s relacionados (facturas seleccionadas)
				for (var intCon in objCfdisRelacionadosFacturasMaquinariaMaquinaria.getCfdis()) 
	            {
	            	//Crear instancia del objeto CFDI a relacionar 
	            	objCfdiRelacionarFacturasMaquinariaMaquinaria = new CfdiRelacionarFacturasMaquinariaMaquinaria();
	            	//Asignar datos del CFDI corespondiente al indice
	            	objCfdiRelacionarFacturasMaquinariaMaquinaria = objCfdisRelacionadosFacturasMaquinariaMaquinaria.getCfdi(intCon);
	            	
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_cfdi_relacionados_facturas_maquinaria_maquinaria').getElementsByTagName('tbody')[0];

					//Variable que se utiliza para asignar el id del detalle
					var strDetalleID =  objCfdiRelacionarFacturasMaquinariaMaquinaria.intReferenciaID+'_'+objCfdiRelacionarFacturasMaquinariaMaquinaria.strTipoReferencia;

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
						objCeldaCliente.innerHTML = objCfdiRelacionarFacturasMaquinariaMaquinaria.strCliente;
						objCeldaFolio.setAttribute('class', 'movil c2');
						objCeldaFolio.innerHTML = objCfdiRelacionarFacturasMaquinariaMaquinaria.strFolio;
						objCeldaFecha.setAttribute('class', 'movil c3');
						objCeldaFecha.innerHTML = objCfdiRelacionarFacturasMaquinariaMaquinaria.dteFecha;
						objCeldaModulo.setAttribute('class', 'movil c4');
						objCeldaModulo.innerHTML = objCfdiRelacionarFacturasMaquinariaMaquinaria.strTipoReferencia;
						objCeldaUuid.setAttribute('class', 'movil c5');
						objCeldaUuid.innerHTML =  objCfdiRelacionarFacturasMaquinariaMaquinaria.strUuid;
						objCeldaImporte.setAttribute('class', 'movil c6');
						objCeldaImporte.innerHTML = objCfdiRelacionarFacturasMaquinariaMaquinaria.intImporte;
						objCeldaAcciones.setAttribute('class', 'td-center movil c7');
						objCeldaAcciones.innerHTML = strAccionesTabla;
						objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
						objCeldaReferenciaID.innerHTML = objCfdiRelacionarFacturasMaquinariaMaquinaria.intReferenciaID;
					}
	            }

	            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
				var intFilas = $("#dg_cfdi_relacionados_facturas_maquinaria_maquinaria tr").length - 1;
				$('#numElementos_cfdi_relacionados_facturas_maquinaria_maquinaria').html(intFilas);
				$('#txtNumCfdiRelacionados_facturas_maquinaria_maquinaria').val(intFilas);
			}
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_cfdi_relacionados_facturas_maquinaria_maquinaria(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_cfdi_relacionados_facturas_maquinaria_maquinaria").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
			var intFilas = $("#dg_cfdi_relacionados_facturas_maquinaria_maquinaria tr").length - 1;
			$('#numElementos_cfdi_relacionados_facturas_maquinaria_maquinaria').html(intFilas);
			$('#txtNumCfdiRelacionados_facturas_maquinaria_maquinaria').val(intFilas);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Facturas
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_facturas_maquinaria_maquinaria').numeric();
			$('#txtPrecio_facturas_maquinaria_maquinaria').numeric();
        	$('#txtPorcentajeDescuento_facturas_maquinaria_maquinaria').numeric();
        	$('#txtPorcentajeIva_facturas_maquinaria_maquinaria').numeric();
        	$('#txtPorcentajeIeps_facturas_maquinaria_maquinaria').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_facturas_maquinaria_maquinaria').blur(function(){
                $('.tipo-cambio_facturas_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_facturas_maquinaria_maquinaria').blur(function(){
				$('.moneda_facturas_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
			});

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_facturas_maquinaria_maquinaria').blur(function(){
                $('.cantidad_facturas_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_facturas_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});


	        //Autocomplete para recuperar los datos de un pedido 
	        $('#txtPedidoMaquinaria_facturas_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtPedidoMaquinariaID_facturas_maquinaria_maquinaria').val('');
	               //Hacer un llamado a la función para inicializar elementos del pedido
	               inicializar_pedido_facturas_maquinaria_maquinaria();

	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "maquinaria/pedidos_maquinaria/autocomplete",
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
		             $('#txtPedidoMaquinariaID_facturas_maquinaria_maquinaria').val(ui.item.data);
		              //Hacer un llamado a la función para regresar los datos del pedido
		           	 get_datos_pedido_facturas_maquinaria_maquinaria();
	           	 }
	           	 else
	             {
	             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				     mensaje_facturas_maquinaria_maquinaria('error_regimen_fiscal','','txtPedidoMaquinaria_facturas_maquinaria_maquinaria');
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
	        
	        //Verificar que exista id del pedido cuando pierda el enfoque la caja de texto
	        $('#txtPedidoMaquinaria_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del pedido
	            if($('#txtPedidoMaquinariaID_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtPedidoMaquinaria_facturas_maquinaria_maquinaria').val() == '')
	            { 
	              
	               $('#txtPedidoMaquinariaID_facturas_maquinaria_maquinaria').val('');
          		   $('#txtPedidoMaquinaria_facturas_maquinaria_maquinaria').val('');
	               //Hacer un llamado a la función para inicializar elementos del pedido
	               inicializar_pedido_facturas_maquinaria_maquinaria();

	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_facturas_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorID_facturas_maquinaria_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: intModuloIDFacturasMaquinariaMaquinaria
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorID_facturas_maquinaria_maquinaria').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del vendedor cuando pierda el enfoque la caja de texto
	        $('#txtVendedor_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtVendedor_facturas_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_facturas_maquinaria_maquinaria').val('');
	               $('#txtVendedor_facturas_maquinaria_maquinaria').val('');
	            }
	            
	        });

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_facturas_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_facturas_maquinaria_maquinaria').val('');
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
	             $('#txtProspectoID_facturas_maquinaria_maquinaria').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('cuentas_cobrar/clientes/get_datos',
	                  { 
	                  	intProspectoID:$("#txtProspectoID_facturas_maquinaria_maquinaria").val()
	                  },
	                  function(data) {
	                    if(data.row){
	                       //Asignar datos del registro seleccionado
	                       $("#txtRazonSocial_facturas_maquinaria_maquinaria").val(data.row.razon_social);
	                       $("#txtRfc_facturas_maquinaria_maquinaria").val(data.row.rfc);
	                       $("#txtCalle_facturas_maquinaria_maquinaria").val(data.row.calle);
	                       $("#txtNumeroExterior_facturas_maquinaria_maquinaria").val(data.row.numero_exterior);
	                       $("#txtNumeroInterior_facturas_maquinaria_maquinaria").val(data.row.numero_interior);
	                       $("#txtCodigoPostal_facturas_maquinaria_maquinaria").val(data.row.codigo_postal);
	                       $("#txtColonia_facturas_maquinaria_maquinaria").val(data.row.colonia);
	                       $("#txtLocalidad_facturas_maquinaria_maquinaria").val(data.row.localidad);
	                       $("#txtMunicipio_facturas_maquinaria_maquinaria").val(data.row.municipio);
	                       $("#txtEstado_facturas_maquinaria_maquinaria").val(data.row.estado_rep);
	                       $("#txtPais_facturas_maquinaria_maquinaria").val(data.row.pais_rep);
	                       $("#txtMaquinariaCreditoDias_facturas_maquinaria_maquinaria").val(data.row.maquinaria_credito_dias);
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
	        
	        //Verificar que exista id del cliente cuando pierda el enfoque la caja de texto
	        $('#txtRazonSocial_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtRazonSocial_facturas_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_facturas_maquinaria_maquinaria').val('');
	               $('#txtRazonSocial_facturas_maquinaria_maquinaria').val('');
	               $("#txtRazonSocial_facturas_maquinaria_maquinaria").val('');
                   $("#txtRfc_facturas_maquinaria_maquinaria").val('');
                   $("#txtCalle_facturas_maquinaria_maquinaria").val('');
                   $("#txtNumeroExterior_facturas_maquinaria_maquinaria").val('');
                   $("#txtNumeroInterior_facturas_maquinaria_maquinaria").val('');
                   $("#txtCodigoPostal_facturas_maquinaria_maquinaria").val('');
                   $("#txtColonia_facturas_maquinaria_maquinaria").val('');
                   $("#txtLocalidad_facturas_maquinaria_maquinaria").val('');
                   $("#txtMunicipio_facturas_maquinaria_maquinaria").val('');
                   $("#txtEstado_facturas_maquinaria_maquinaria").val('');
                   $("#txtPais_facturas_maquinaria_maquinaria").val('');
                   $("#txtMaquinariaCreditoDias_facturas_maquinaria_maquinaria").val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una forma de pago
	        $('#txtFormaPago_facturas_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtFormaPagoID_facturas_maquinaria_maquinaria').val('');
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
	             $('#txtFormaPagoID_facturas_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtFormaPago_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id de la forma de pago
	            if($('#txtFormaPagoID_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtFormaPago_facturas_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtFormaPagoID_facturas_maquinaria_maquinaria').val('');
	               $('#txtFormaPago_facturas_maquinaria_maquinaria').val('');
	            }
	            
	        });
	        
	        //Autocomplete para recuperar los datos de un método de pago
	        $('#txtMetodoPago_facturas_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMetodoPagoID_facturas_maquinaria_maquinaria').val('');
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
	             $('#txtMetodoPagoID_facturas_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtMetodoPago_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del método de pago
	            if($('#txtMetodoPagoID_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtMetodoPago_facturas_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMetodoPagoID_facturas_maquinaria_maquinaria').val('');
	               $('#txtMetodoPago_facturas_maquinaria_maquinaria').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un uso del CFDI
	        $('#txtUsoCfdi_facturas_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtUsoCfdiID_facturas_maquinaria_maquinaria').val('');
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
	             $('#txtUsoCfdiID_facturas_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtUsoCfdi_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del uso de CFDI
	            if($('#txtUsoCfdiID_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtUsoCfdi_facturas_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUsoCfdiID_facturas_maquinaria_maquinaria').val('');
	               $('#txtUsoCfdi_facturas_maquinaria_maquinaria').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un tipo de relación
	        $('#txtTipoRelacion_facturas_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTipoRelacionID_facturas_maquinaria_maquinaria').val('');
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
	             $('#txtTipoRelacionID_facturas_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtTipoRelacion_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtTipoRelacionID_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtTipoRelacion_facturas_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTipoRelacionID_facturas_maquinaria_maquinaria').val('');
	               $('#txtTipoRelacion_facturas_maquinaria_maquinaria').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de inventario de la descripción de maquinaria
			$('#txtSerie_facturas_maquinaria_maquinaria').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtInventarioMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "maquinaria/maquinaria_inventario/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val(),
							strDescripcion: request.term, 
							strTipo: 'serie'
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar datos del registro seleccionado
					$('#txtInventarioMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val(ui.item.serie);
					$('#txtMotor_facturas_maquinaria_maquinaria').val(ui.item.motor);
					$('#txtConsignacion_facturas_maquinaria_maquinaria').val(ui.item.consignacion);
					//Elegir serie desde el valor devuelto en el autocomplete
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

		    //Verificar que exista id del inventario de la descripción de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtSerie_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del inventario de la descripción de maquinaria
	            if($('#txtInventarioMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtSerie_facturas_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtInventarioMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val('');
	               $('#txtSerie_facturas_maquinaria_maquinaria').val('');
	               $('#txtMotor_facturas_maquinaria_maquinaria').val('');
	               $('#txtConsignacion_facturas_maquinaria_maquinaria').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de inventario de la descripción de maquinaria
			$('#txtMotor_facturas_maquinaria_maquinaria').autocomplete({
				source: function(request, response) {
					
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "maquinaria/maquinaria_inventario/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val(),
							strDescripcion: request.term,
							strTipo: 'motor'
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar datos del registro seleccionado
					$('#txtInventarioMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val(ui.item.serie);
					$('#txtSerie_facturas_maquinaria_maquinaria').val(ui.item.serie);
					$('#txtConsignacion_facturas_maquinaria_maquinaria').val(ui.item.consignacion);
					//Elegir motor desde el valor devuelto en el autocomplete
					ui.item.value = ui.item.value.split(" - ")[1];
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});


			//Verificar que exista id del inventario de la descripción de maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtMotor_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del inventario de la descripción de maquinaria
	            if($('#txtInventarioMaquinariaDescripcionID_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtMotor_facturas_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMotor_facturas_maquinaria_maquinaria').val('');
	               $('#txtConsignacion_facturas_maquinaria_maquinaria').val('');
	            }
	        });

	        
	        /*******************************************************************************************************************
			Controles correspondientes al tab Componentes
			*********************************************************************************************************************/
		    //Autocomplete para recuperar los datos de inventario de la descripción de maquinaria
			$('#txtSerie_componentes_facturas_maquinaria_maquinaria').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "maquinaria/maquinaria_inventario/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							intMaquinariaDescripcionID: $('#txtInventarioMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val(),
							strDescripcion: request.term, 
							strTipo: 'serie'
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar datos del registro seleccionado
					$('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val(ui.item.serie);
					$('#txtMotor_componentes_facturas_maquinaria_maquinaria').val(ui.item.motor);
					$('#txtConsignacion_componentes_facturas_maquinaria_maquinaria').val(ui.item.consignacion);
					//Elegir serie desde el valor devuelto en el autocomplete
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

			//Verificar que exista id de la descripción de maquinaria (del inventario) cuando pierda el enfoque la caja de texto
	        $('#txtSerie_componentes_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id de la descripción de maquinaria
	            if($('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtSerie_componentes_facturas_maquinaria_maquinaria').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val('');
	                $('#txtSerie_componentes_facturas_maquinaria_maquinaria').val('');
	                $('#txtMotor_componentes_facturas_maquinaria_maquinaria').val('');
	                $('#txtConsignacion_componentes_facturas_maquinaria_maquinaria').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de inventario de la descripción de maquinaria
			$('#txtMotor_componentes_facturas_maquinaria_maquinaria').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "maquinaria/maquinaria_inventario/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							intMaquinariaDescripcionID: $('#txtInventarioMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val(),
							strDescripcion: request.term,
							strTipo: 'motor'
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar datos del registro seleccionado
					$('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val(ui.item.serie);
					$('#txtSerie_componentes_facturas_maquinaria_maquinaria').val(ui.item.serie);
					$('#txtConsignacion_componentes_facturas_maquinaria_maquinaria').val(ui.item.consignacion);
					//Elegir motor desde el valor devuelto en el autocomplete
					ui.item.value = ui.item.value.split(" - ")[1];
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

			//Verificar que exista id de la descripción de maquinaria (del inventario) cuando pierda el enfoque la caja de texto
	        $('#txtMotor_componentes_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id de la descripción de maquinaria
	            if($('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtMotor_componentes_facturas_maquinaria_maquinaria').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val('');
	                $('#txtSerie_componentes_facturas_maquinaria_maquinaria').val('');
	                $('#txtMotor_componentes_facturas_maquinaria_maquinaria').val('');
	                $('#txtConsignacion_componentes_facturas_maquinaria_maquinaria').val('');
	            }
	        });

	        //Función para mover renglones arriba y abajo en la tabla componentes
			$('#dg_componentes_facturas_maquinaria_maquinaria').on('click','button.btn',function(){
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

			
			//Validar que exista serie del componente cuando se pulse la tecla enter 
			$('#txtSerie_componentes_facturas_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe id de la descripción de maquinaria (inventario)
		            if($('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val() == '' || $('#txtSerie_componentes_facturas_maquinaria_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtSerie_componentes_facturas_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtMotor_componentes_facturas_maquinaria_maquinaria').focus();
			   	    }
		        }
		    });

			
			//Validar que exista motor del componente cuando se pulse la tecla enter 
			$('#txtMotor_componentes_facturas_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		           //Si no existe id de la descripción de maquinaria (inventario)
		            if($('#txtMaquinariaDescripcionID_componentes_facturas_maquinaria_maquinaria').val() == '' || $('#txtMotor_componentes_facturas_maquinaria_maquinaria').val() == '')
			   	    {
			   	    
			   	   		//Enfocar caja de texto
					    $('#txtMotor_componentes_facturas_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
		    			agregar_renglon_componentes_facturas_maquinaria_maquinaria();
			   	    }
		        }
		    });

	        
			//Función para mover renglones arriba y abajo en la tabla CFDI relacionados
			$('#dg_cfdi_relacionados_facturas_maquinaria_maquinaria').on('click','button.btn',function(){
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
			$('#dteFechaInicialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
		

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').val('');
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
	             $('#txtProspectoIDBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').val() == '' ||
	            	$('#txtRazonSocialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').val('');
	               $('#txtRazonSocialBusq_relacionar_cfdi_facturas_maquinaria_maquinaria').val('');
	            }
	            
	        });

	         /*******************************************************************************************************************
			Controles correspondientes al modal Cancelación del timbrado
			**************************************	*******************************************************************************/
			 //Autocomplete para recuperar los datos de una sustitución (factura, pago, etc.)
	        $('#txtFolioSustitucion_cancelacion_facturas_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSustitucionID_cancelacion_facturas_maquinaria_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "maquinaria/facturas_maquinaria/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intReferenciaID: $('#txtReferenciaCfdiID_cancelacion_facturas_maquinaria_maquinaria').val(),
	                   strFormulario: 'cancelacion'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtSustitucionID_cancelacion_facturas_maquinaria_maquinaria').val(ui.item.data);
	             $('#txtUuidSustitucion_cancelacion_facturas_maquinaria_maquinaria').val(ui.item.uuid);
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
	        $('#txtFolioSustitucion_cancelacion_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtSustitucionID_cancelacion_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtFolioSustitucion_cancelacion_facturas_maquinaria_maquinaria').val() == '')
	            { 
	               //Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_facturas_maquinaria_maquinaria();
	            }
	            
	        });


	        //Verificar motivo de cancelación cuando cambie la opción del combobox
	        $('#cmbCancelacionMotivoID_cancelacion_facturas_maquinaria_maquinaria').change(function(e){   
	            //Si el motivo de cancelación no corresponde a 01 - Comprobante emitido con errores con relación.
              	if(parseInt($('#cmbCancelacionMotivoID_cancelacion_facturas_maquinaria_maquinaria').val()) !== intCancelacionIDRelacionCfdiFacturasMaquinariaMaquinaria)
             	{
             		//Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_facturas_maquinaria_maquinaria();
					
             	}
	        });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_facturas_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_facturas_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_facturas_maquinaria_maquinaria').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_facturas_maquinaria_maquinaria').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_facturas_maquinaria_maquinaria').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_facturas_maquinaria_maquinaria').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_facturas_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_facturas_maquinaria_maquinaria').val('');
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
	             $('#txtProspectoIDBusq_facturas_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_facturas_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_facturas_maquinaria_maquinaria').val() == '' ||
	               $('#txtRazonSocialBusq_facturas_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_facturas_maquinaria_maquinaria').val('');
	               $('#txtRazonSocialBusq_facturas_maquinaria_maquinaria').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_facturas_maquinaria_maquinaria').on('click','a',function(event){
				event.preventDefault();
				intPaginaFacturasMaquinariaMaquinaria = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_facturas_maquinaria_maquinaria();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_facturas_maquinaria_maquinaria').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_facturas_maquinaria_maquinaria('Nuevo');
				//Abrir modal
				 objFacturasMaquinariaMaquinaria = $('#FacturasMaquinariaMaquinariaBox').bPopup({
												   appendTo: '#FacturasMaquinariaMaquinariaContent', 
					                               contentContainer: 'FacturasMaquinariaMaquinariaM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbCondicionesPago_facturas_maquinaria_maquinaria').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_facturas_maquinaria_maquinaria').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_facturas_maquinaria_maquinaria();
			 //Hacer un llamado a la función para cargar los motivos de cancelación en el combobox del modal
            cargar_motivos_cancelacion_facturas_maquinaria_maquinaria();
            //Hacer un llamado a la función para cargar exportación en el combobox del modal
            cargar_exportacion_facturas_maquinaria_maquinaria();
		});
	</script>