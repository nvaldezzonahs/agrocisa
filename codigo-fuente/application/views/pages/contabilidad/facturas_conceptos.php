	<div id="FacturasConceptosContabilidadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_facturas_conceptos_contabilidad" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_facturas_conceptos_contabilidad" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_facturas_conceptos_contabilidad">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_facturas_conceptos_contabilidad'>
				                    <input class="form-control" id="txtFechaInicialBusq_facturas_conceptos_contabilidad"
				                    		name= "strFechaInicialBusq_facturas_conceptos_contabilidad" 
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
								<label for="txtFechaFinalBusq_facturas_conceptos_contabilidad">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_facturas_conceptos_contabilidad'>
				                    <input class="form-control" id="txtFechaFinalBusq_facturas_conceptos_contabilidad"
				                    		name= "strFechaFinalBusq_facturas_conceptos_contabilidad" 
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
								<input id="txtProspectoIDBusq_facturas_conceptos_contabilidad" 
									   name="intProspectoIDBusq_facturas_conceptos_contabilidad"  type="hidden" 
									   value="">
								</input>
								<label for="txtRazonSocialBusq_facturas_conceptos_contabilidad">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocialBusq_facturas_conceptos_contabilidad" 
										name="strRazonSocialBusq_facturas_conceptos_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_facturas_conceptos_contabilidad">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_facturas_conceptos_contabilidad" 
								 		name="strEstatusBusq_facturas_conceptos_contabilidad" tabindex="1">
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
								<label for="txtBusqueda_facturas_conceptos_contabilidad">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_facturas_conceptos_contabilidad" 
										name="strBusqueda_facturas_conceptos_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_facturas_conceptos_contabilidad" 
									   name="strImprimirDetalles_facturas_conceptos_contabilidad" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_facturas_conceptos_contabilidad"
									onclick="paginacion_facturas_conceptos_contabilidad();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_facturas_conceptos_contabilidad" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_facturas_conceptos_contabilidad"
									onclick="reporte_facturas_conceptos_contabilidad('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_facturas_conceptos_contabilidad"
									onclick="reporte_facturas_conceptos_contabilidad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil.d1:nth-of-type(1):before {content: "Concepto"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.d5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.d6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.d7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.d8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.d9:nth-of-type(9):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles de la factura
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.t6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.t7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.t8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_facturas_conceptos_contabilidad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Razón social</th>
							<th class="movil">RFC</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:16em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_facturas_conceptos_contabilidad" type="text/template"> 
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
										onclick="editar_facturas_conceptos_contabilidad({{factura_concepto_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>	 
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_facturas_conceptos_contabilidad({{factura_concepto_id}},'Ver', {{cancelacion_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Ver motivo de cancelación-->
								<button class="btn btn-default btn-xs {{mostrarAccionMotivoCancelacion}}"  
										onclick="ver_cancelacion_facturas_conceptos_contabilidad({{cancelacion_id}})"  title="Ver motivo de cancelación">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_cliente_facturas_conceptos_contabilidad({{factura_concepto_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_facturas_conceptos_contabilidad({{factura_concepto_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_facturas_conceptos_contabilidad({{factura_concepto_id}}, '{{estatus}}', 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Timbrar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionTimbrar}}"  
										onclick="timbrar_facturas_conceptos_contabilidad({{factura_concepto_id}}, '', 'principal', {{regimen_fiscal_id}})"  title="Timbrar">
									<span class="fa fa-certificate"></span>
								</button>
								<!--Descargar archivos-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_facturas_conceptos_contabilidad({{factura_concepto_id}}, '{{folio}}');" title="Descargar archivos">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_facturas_conceptos_contabilidad({{factura_concepto_id}}, '{{folio}}',{{poliza_id}}, '{{folio_poliza}}')" title="Cancelar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_facturas_conceptos_contabilidad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_facturas_conceptos_contabilidad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_facturas_conceptos_contabilidad" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 	
		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarFacturasConceptosContabilidadBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cliente_facturas_conceptos_contabilidad" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarFacturasConceptosContabilidad" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarFacturasConceptosContabilidad"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Prospecto / Cliente-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtFacturaConceptoID_cliente_facturas_conceptos_contabilidad" 
										   name="intFacturaConceptoID_cliente_facturas_conceptos_contabilidad" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el folio del registro seleccionado-->
									<input id="txtFolio_cliente_facturas_conceptos_contabilidad" 
										   name="strFolio_cliente_facturas_conceptos_contabilidad" 
										   type="hidden" value="" />	   
									<label for="txtRazonSocial_cliente_facturas_conceptos_contabilidad">Razón social</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_cliente_facturas_conceptos_contabilidad" 
											name="strRazonSocial_cliente_facturas_conceptos_contabilidad" type="text" value="" 
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
									<label for="txtCorreoElectronico_cliente_facturas_conceptos_contabilidad">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_cliente_facturas_conceptos_contabilidad" 
											name="strCorreoElectronico_cliente_facturas_conceptos_contabilidad" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_cliente_facturas_conceptos_contabilidad">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_cliente_facturas_conceptos_contabilidad" 
											name="strCopiaCorreoElectronico_cliente_facturas_conceptos_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cliente_facturas_conceptos_contabilidad" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 						
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_cliente_facturas_conceptos_contabilidad"  
									onclick="validar_cliente_facturas_conceptos_contabilidad();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cliente_facturas_conceptos_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_cliente_facturas_conceptos_contabilidad();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->
		<!-- Diseño del modal Relacionar CFDI-->
		<div id="RelacionarCfdiFacturasConceptosContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_cfdi_facturas_conceptos_contabilidad" class="ModalBodyTitle">
				<h1>Relacionar CFDI</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarCfdiFacturasConceptosContabilidad" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarCfdiFacturasConceptosContabilidad"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha inicial-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicialBusq_relacionar_cfdi_facturas_conceptos_contabilidad">Fecha inicial</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaInicialBusq_relacionar_cfdi_facturas_conceptos_contabilidad'>
					                    <input class="form-control" id="txtFechaInicialBusq_relacionar_cfdi_facturas_conceptos_contabilidad"
					                    		name= "strFechaInicialBusq_relacionar_cfdi_facturas_conceptos_contabilidad" 
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
									<label for="txtFechaFinalBusq_relacionar_cfdi_facturas_conceptos_contabilidad">Fecha final</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaFinalBusq_relacionar_cfdi_facturas_conceptos_contabilidad'>
					                    <input class="form-control" id="txtFechaFinalBusq_relacionar_cfdi_facturas_conceptos_contabilidad"
					                    		name= "strFechaFinalBusq_relacionar_cfdi_facturas_conceptos_contabilidad" 
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
									<input id="txtProspectoIDBusq_relacionar_cfdi_facturas_conceptos_contabilidad" 
										   name="intProspectoIDBusq_relacionar_cfdi_facturas_conceptos_contabilidad"  type="hidden" 
										   value="">
									</input>
									<label for="txtRazonSocialBusq_relacionar_cfdi_facturas_conceptos_contabilidad">Razón social</label>
								</div>
								<div class="col-md-12">
									<div class="input-group">
										<input class="form-control" id="txtRazonSocialBusq_relacionar_cfdi_facturas_conceptos_contabilidad" 
											   name="strRazonSocialBusq_relacionar_cfdi_facturas_conceptos_contabilidad"  type="text" value="" 
											   tabindex="1" placeholder="Ingrese razón social" maxlength="250" >
										</input>
										<span class="input-group-btn">
											<button class="btn btn-primary" id="btnBuscar_relacionar_cfdi_facturas_conceptos_contabilidad"
													onclick="lista_facturas_relacionar_cfdi_facturas_conceptos_contabilidad();" title="Buscar coincidencias" tabindex="1">
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
							<input id="txtNumCfdi_relacionar_cfdi_facturas_conceptos_contabilidad" 
								   name="intNumCfdi_relacionar_cfdi_facturas_conceptos_contabilidad" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_cfdi_facturas_conceptos_contabilidad">
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
								<script id="plantilla_relacionar_cfdi_facturas_conceptos_contabilidad" type="text/template"> 
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
							    		id="chbAgregar_relacionar_cfdi_facturas_conceptos_contabilidad" />
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
										<strong id="numElementos_relacionar_cfdi_facturas_conceptos_contabilidad">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>							 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar CFDI-->
							<button class="btn btn-success" id="btnAgregar_relacionar_cfdi_facturas_conceptos_contabilidad"  
									onclick="validar_relacionar_cfdi_facturas_conceptos_contabilidad();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_cfdi_facturas_conceptos_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_cfdi_facturas_conceptos_contabilidad();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar CFDI-->

		<!-- Diseño del modal Cancelación del timbrado-->
		<div id="CancelacionFacturasConceptosContabilidadBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cancelacion_facturas_conceptos_contabilidad" class="ModalBodyTitle confirmacion-modal-title">
			<h1>Cancelación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCancelacionFacturasConceptosContabilidad" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmCancelacionFacturasConceptosContabilidad"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Combobox que contiene los motivos de cancelación activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCancelacionMotivoID_cancelacion_facturas_conceptos_contabilidad">Motivo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbCancelacionMotivoID_cancelacion_facturas_conceptos_contabilidad" 
									 		name="intCancelacionMotivoID_facturas_conceptos_contabilidad" 
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
									<input id="txtReferenciaCfdiID_cancelacion_facturas_conceptos_contabilidad" 
										   name="intReferenciaCfdiID_cancelacion_facturas_conceptos_contabilidad" 
										   type="hidden" value="" />	

									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_cancelacion_facturas_conceptos_contabilidad" 
										   name="intPolizaID_cancelacion_facturas_conceptos_contabilidad" type="hidden" value="" />

									<label for="txtFolio_cancelacion_facturas_conceptos_contabilidad">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_cancelacion_facturas_conceptos_contabilidad" 
											name="strFolio_cancelacion_facturas_conceptos_contabilidad" type="text" value="" 
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
									<input id="txtSustitucionID_cancelacion_facturas_conceptos_contabilidad" 
										   name="intSustitucionID_cancelacion_facturas_conceptos_contabilidad" 
										   type="hidden" value="" />	
									<!-- Caja de texto oculta que se utiliza para recuperar el UUID de la factura que sustituye-->
									<input id="txtUuidSustitucion_cancelacion_facturas_conceptos_contabilidad" 
										   name="strUuidSustitucion_cancelacion_facturas_conceptos_contabilidad" 
										   type="hidden" value="" />	   
									<label for="txtFolioSustitucion_cancelacion_facturas_conceptos_contabilidad">Sustitución</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolioSustitucion_cancelacion_facturas_conceptos_contabilidad" 
											name="strFolioSustitucion_cancelacion_facturas_conceptos_contabilidad" type="text" value="" 
											tabindex="1" placeholder="Ingrese anticipos" maxlength="250" >
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Div que contiene los campos del usuario y fecha del registro -->
			 		<div  id="divDatosCreacion_cancelacion_facturas_conceptos_contabilidad" class="row no-mostrar">
			 			<!--Usuario que realizó la cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuarioCreacion_cancelacion_facturas_conceptos_contabilidad">Usuario de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuarioCreacion_cancelacion_facturas_conceptos_contabilidad" 
											name="strUsuarioCreacion_cancelacion_facturas_conceptos_contabilidad" type="text" value="" 
											 disabled >
									</input>
								</div>
							</div>
						</div>
						<!--Fecha de cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaCreacion_cancelacion_facturas_conceptos_contabilidad">Fecha de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFechaCreacion_cancelacion_facturas_conceptos_contabilidad" 
											name="strFechaCreacion_cancelacion_facturas_conceptos_contabilidad" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cancelacion_facturas_conceptos_contabilidad" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 						
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar cancelación del CFDI-->
							<button class="btn btn-success" id="btnGuardar_cancelacion_facturas_conceptos_contabilidad"  
									onclick="validar_cancelacion_facturas_conceptos_contabilidad();"  title="Cancelar CFDI" tabindex="1">
								<span class="fa fa-chain-broken"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cancelacion_facturas_conceptos_contabilidad"
									type="reset" aria-hidden="true" onclick="cerrar_cancelacion_facturas_conceptos_contabilidad();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cancelación del timbrado-->

		<!-- Diseño del modal Facturas-->
		<div id="FacturasConceptosContabilidadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_facturas_conceptos_contabilidad"  class="ModalBodyTitle">
			<h1>Facturación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_cliente_facturas_conceptos_contabilidad" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_facturas_conceptos_contabilidad" class="active">
									<a data-toggle="tab" href="#informacion_general_facturas_conceptos_contabilidad">Información General</a>
								</li>
								<!--Tab que contiene la información de los CFDI relacionados-->
								<li id="tabCfdiRelacionados_facturas_conceptos_contabilidad">
									<a data-toggle="tab" href="#cfdi_relacionados_facturas_conceptos_contabilidad">CFDI Relacionados</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmFacturasConceptosContabilidad" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmFacturasConceptosContabilidad"  onsubmit="return(false)" 
					  autocomplete="off">
					  <div class="tab-content">
					  	<!--Tab - Información General-->
						<div id="informacion_general_facturas_conceptos_contabilidad" class="tab-pane fade in active">
							<div class="row">
								<!--Folio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtFacturaConceptoID_facturas_conceptos_contabilidad" 
												   name="intFacturaConceptoID_facturas_conceptos_contabilidad" type="hidden" value="" />
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
											<input id="txtEstatus_facturas_conceptos_contabilidad" 
												   name="strEstatus_facturas_conceptos_contabilidad" type="hidden" value="" />
											<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
											<input id="txtPolizaID_facturas_conceptos_contabilidad" 
												   name="intPolizaID_facturas_conceptos_contabilidad" type="hidden" value="" />
											 <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
											<input id="txtFolioPoliza_facturas_conceptos_contabilidad" 
												   name="strFolioPoliza_facturas_conceptos_contabilidad" type="hidden" value="" />
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la cancelación del registro seleccionado-->
											<input id="txtCancelacionID_facturas_conceptos_contabilidad" 
												   name="intCancelacionID_facturas_conceptos_contabilidad" type="hidden" value="" />
											<label for="txtFolio_facturas_conceptos_contabilidad">Folio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFolio_facturas_conceptos_contabilidad" 
													name="strFolio_facturas_conceptos_contabilidad" type="text" 
													value="" placeholder="Autogenerado" disabled />
										</div>
									</div>
								</div>
								<!--Fecha-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_facturas_conceptos_contabilidad">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_facturas_conceptos_contabilidad'>
							                    <input class="form-control" id="txtFecha_facturas_conceptos_contabilidad"
							                    		name= "strFecha_facturas_conceptos_contabilidad" 
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
											<label for="cmbMonedaID_facturas_conceptos_contabilidad">Moneda</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbMonedaID_facturas_conceptos_contabilidad" 
											 		name="intMonedaID_facturas_conceptos_contabilidad" tabindex="1">
		                     				</select>
										</div>
									</div>
								</div>
								<!--Tipo de cambio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTipoCambio_facturas_conceptos_contabilidad">Tipo de cambio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control tipo-cambio_facturas_conceptos_contabilidad" id="txtTipoCambio_facturas_conceptos_contabilidad" 
													name="intTipoCambio_facturas_conceptos_contabilidad" type="text" value="" 
													tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11" />
										</div>
									</div>
								</div>
							</div>
						    <div class="row">
								<!--Autocomplete que contiene los clientes activos-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del cliente seleccionado-->
											<input id="txtProspectoID_facturas_conceptos_contabilidad" 
												   name="intProspectoID_facturas_conceptos_contabilidad" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el id del régimen fiscal del cliente seleccionado-->
											<input id="txtRegimenFiscalID_facturas_conceptos_contabilidad" 
												   name="intRegimenFiscalID_facturas_conceptos_contabilidad" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la lista de precios correspondiente al cliente seleccionado-->
											<input id="txtRefaccionesListaPrecioID_facturas_conceptos_contabilidad" 
												   name="intRefaccionesListaPrecioID_facturas_conceptos_contabilidad"  type="hidden" 
												   value="">
											</input>
											<!-- Caja de texto oculta para recuperar la calle del cliente seleccionado-->
											<input id="txtCalle_facturas_conceptos_contabilidad" 
												   name="strCalle_facturas_conceptos_contabilidad" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el número exterior del cliente seleccionado-->
											<input id="txtNumeroExterior_facturas_conceptos_contabilidad" 
												   name="strNumeroExterior_facturas_conceptos_contabilidad" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el número interior del cliente seleccionado-->
											<input id="txtNumeroInterior_facturas_conceptos_contabilidad" 
												   name="strNumeroInterior_facturas_conceptos_contabilidad" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el código postal del cliente seleccionado-->
											<input id="txtCodigoPostal_facturas_conceptos_contabilidad" 
												   name="strCodigoPostal_facturas_conceptos_contabilidad" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar la colonia del cliente seleccionado-->
											<input id="txtColonia_facturas_conceptos_contabilidad" 
												   name="strColonia_facturas_conceptos_contabilidad" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar la localidad del cliente seleccionado-->
											<input id="txtLocalidad_facturas_conceptos_contabilidad" 
												   name="strLocalidad_facturas_conceptos_contabilidad" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el municipio del cliente seleccionado-->
											<input id="txtMunicipio_facturas_conceptos_contabilidad" 
												   name="strMunicipio_facturas_conceptos_contabilidad" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el estado del cliente seleccionado-->
											<input id="txtEstado_facturas_conceptos_contabilidad" 
												   name="strEstado_facturas_conceptos_contabilidad" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el país del cliente seleccionado-->
											<input id="txtPais_facturas_conceptos_contabilidad" 
												   name="strPais_facturas_conceptos_contabilidad" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar los días de crédito del cliente seleccionado-->
											<input id="txtMaquinariaCreditoDias_facturas_conceptos_contabilidad" 
												   name="intMaquinariaCreditoDias_facturas_conceptos_contabilidad" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para asignar la fecha de vencimiento-->
											<input id="txtFechaVencimiento_facturas_conceptos_contabilidad" 
												   name="strFechaVencimiento_facturas_conceptos_contabilidad" 
												   type="hidden" value="" />
											<label for="txtRazonSocial_facturas_conceptos_contabilidad">
												Razón social
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRazonSocial_facturas_conceptos_contabilidad" 
													name="strRazonSocial_facturas_conceptos_contabilidad" type="text" value=""   
													tabindex="1" placeholder="Ingrese razón social" maxlength="250" />
										</div>
									</div>
								</div>
								<!--RFC-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRfc_facturas_conceptos_contabilidad">RFC</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRfc_facturas_conceptos_contabilidad"
												   name="strRfc_facturas_conceptos_contabilidad" 
												   type="text" value="" disabled />
										</div>
									</div>
								</div>
								<!--Condiciones de pago-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbCondicionesPago_facturas_conceptos_contabilidad">Tipo de venta</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbCondicionesPago_facturas_conceptos_contabilidad" 
											 		name="strCondicionesPago_facturas_conceptos_contabilidad" tabindex="1">
											    <option value="">Seleccione una opción</option>
											    <option value="CREDITO">CREDITO</option>
			                      				<option value="CONTADO">CONTADO</option>
			                 				</select>
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
											<input id="txtFormaPagoID_facturas_conceptos_contabilidad" 
												   name="intFormaPagoID_facturas_conceptos_contabilidad" 
												   type="hidden" value="" />
											<label for="txtFormaPago_facturas_conceptos_contabilidad">
												Forma de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFormaPago_facturas_conceptos_contabilidad" 
													name="strFormaPago_facturas_conceptos_contabilidad" type="text" value=""  
													tabindex="1" placeholder="Ingrese forma de pago" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los métodos de pago activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del método de pago seleccionado-->
											<input id="txtMetodoPagoID_facturas_conceptos_contabilidad" 
												   name="intMetodoPagoID_facturas_conceptos_contabilidad" 
												   type="hidden" value="" />
											<label for="txtMetodoPago_facturas_conceptos_contabilidad">
												Método de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMetodoPago_facturas_conceptos_contabilidad" 
													name="strMetodoPago_facturas_conceptos_contabilidad" type="text" value=""  
													tabindex="1" placeholder="Ingrese método de pago" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Combobox que contiene la exportación activa-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbExportacionID_facturas_conceptos_contabilidad">Exportación</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbExportacionID_facturas_conceptos_contabilidad"
											        name="intExportacionID_facturas_conceptos_contabilidad" tabindex="1">
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
											<input id="txtUsoCfdiID_facturas_conceptos_contabilidad" 
												   name="intUsoCfdiID_facturas_conceptos_contabilidad" 
												   type="hidden" value="" />
											<label for="txtUsoCfdi_facturas_conceptos_contabilidad">
												Uso del CFDI
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtUsoCfdi_facturas_conceptos_contabilidad" 
													name="strUsoCfdi_facturas_conceptos_contabilidad" type="text" value=""  
													tabindex="1" placeholder="Ingrese uso del CFDI" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los tipos de relación activos-->
								<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del tipo de relación seleccionado-->
											<input id="txtTipoRelacionID_facturas_conceptos_contabilidad" 
												   name="intTipoRelacionID_facturas_conceptos_contabilidad" 
												   type="hidden" value="" />
											<label for="txtTipoRelacion_facturas_conceptos_contabilidad">
												Tipo de relación
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTipoRelacion_facturas_conceptos_contabilidad" 
													name="strTipoRelacion_facturas_conceptos_contabilidad" type="text" value=""  
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
											<label for="txtObservaciones_facturas_conceptos_contabilidad">Observaciones</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtObservaciones_facturas_conceptos_contabilidad" 
													name="strObservaciones_facturas_conceptos_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Notas-->
								<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNotas_facturas_conceptos_contabilidad">Notas</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNotas_facturas_conceptos_contabilidad" 
													name="strNotas_facturas_conceptos_contabilidad" type="text" value="" tabindex="1" placeholder="Ingrese notas" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    </div>
						    <div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
											<input id="txtNumDetalles_facturas_conceptos_contabilidad" 
												   name="intNumDetalles_facturas_conceptos_contabilidad" type="hidden" value="">
											</input>
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">Detalles de la factura</h4>
												</div>
												<div class="panel-body">
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!--Concepto-->
															<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtConcepto_detalles_facturas_conceptos_contabilidad">
																			Concepto
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtConcepto_detalles_facturas_conceptos_contabilidad" 
																				name="strConcepto_detalles_facturas_conceptos_contabilidad" type="text" value="" 
																				tabindex="1" placeholder="Ingrese concepto" maxlength="250" />
																	</div>
																</div>
															</div>
															<!--Autocomplete que contiene los tipos de conceptos activos-->
															<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<!-- Caja de texto oculta que se utiliza para recuperar el id del tipo de concepto seleccionado-->
																		<input id="txtConceptoTipoID_detalles_facturas_conceptos_contabilidad" 
																			   name="intConceptoTipoID_detalles_facturas_conceptos_contabilidad"  type="hidden" 
																			   value="">
																		</input>
																		<label for="txtConceptoTipo_detalles_facturas_conceptos_contabilidad">
																			Tipo
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtConceptoTipo_detalles_facturas_conceptos_contabilidad" 
																				name="strConceptoTipo_detalles_facturas_conceptos_contabilidad" type="text" value="" 
																				tabindex="1" placeholder="Ingrese tipo" maxlength="250" />
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
													    	<!--Autocomplete que contiene los productos y servicios activos-->
															<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<!-- Caja de texto oculta que se utiliza para recuperar el código del producto/servicio seleccionado-->
																		<input id="txtCodigoSat_detalles_facturas_conceptos_contabilidad" 
																			   name="strCodigoSat_detalles_facturas_conceptos_contabilidad"  
																			   type="hidden" value="">
																	    </input>
																		<label for="txtProductoServicio_detalles_facturas_conceptos_contabilidad">Código SAT</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtProductoServicio_detalles_facturas_conceptos_contabilidad" 
																				name="strProductoServicio_detalles_facturas_conceptos_contabilidad" type="text" 
																				value="" tabindex="1" placeholder="Ingrese código SAT" maxlength="250">
																		</input>
																	</div>
																</div>
															</div>
															<!--Autocomplete que contiene las unidades activas-->
															<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<!-- Caja de texto oculta que se utiliza para recuperar el código de la unidad seleccionada-->
																		<input id="txtUnidadSat_detalles_facturas_conceptos_contabilidad" 
																			   name="strUnidadSat_detalles_facturas_conceptos_contabilidad"  
																			   type="hidden" value="">
																	    </input>
																		<label for="txtUnidad_detalles_facturas_conceptos_contabilidad">Unidad SAT</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtUnidad_detalles_facturas_conceptos_contabilidad" 
																				name="strUnidad_detalles_facturas_conceptos_contabilidad" type="text" 
																				value="" tabindex="1" placeholder="Ingrese unidad SAT" maxlength="250">
																		</input>
																	</div>
																</div>
															</div>
															<!--Autocomplete que contiene los objetos de impuesto-->
															<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad">Objeto de impuesto SAT</label>
																	</div>
																	<div class="col-md-12">
																		<!-- Caja de texto oculta que se utiliza para recuperar el código del objeto de impuesto seleccionado-->
																		<input id="txtObjetoImpuestoSat_detalles_facturas_conceptos_contabilidad" 
																			   name="strObjetoImpuestoSat_detalles_facturas_conceptos_contabilidad"  
																			   type="hidden" value="">
																	    </input>
																		<input  class="form-control" id="txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad" 
																				name="strObjetoImpuesto_detalles_facturas_conceptos_contabilidad" type="text" 
																				value="" tabindex="1" placeholder="Ingrese objeto de impuesto SAT" maxlength="250">
																		</input>
																	</div>
																</div>
															</div>
													    </div>
														<div class="row">
															<!--Cantidad-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtCantidad_detalles_facturas_conceptos_contabilidad">
																			Cantidad
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control cantidad_facturas_conceptos_contabilidad" 
																				id="txtCantidad_detalles_facturas_conceptos_contabilidad" 
																				name="intCantidad_detalles_facturas_conceptos_contabilidad" 
																				type="text" value="" tabindex="1"
																				placeholder="Ingrese cantidad" maxlength="14" disabled>
																		</input>
																	</div>
																</div>
															</div>
															<!--Precio unitario-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtPrecioUnitario_detalles_facturas_conceptos_contabilidad">Precio unitario</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control moneda_facturas_conceptos_contabilidad" 
																				id="txtPrecioUnitario_detalles_facturas_conceptos_contabilidad" 
																				name="intPrecioUnitario_detalles_facturas_conceptos_contabilidad" 
																				type="text" value="" tabindex="1" placeholder="Ingrese precio" maxlength="15"/>
																	</div>
																</div>
															</div>
															<!--Porcentaje del descuento-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad">Descuento %</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control cantidad_facturas_conceptos_contabilidad" id="txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad" 
																				name="intPorcentajeDescuento_detalles_facturas_conceptos_contabilidad" type="text" value="" 
																				tabindex="1" placeholder="Ingrese descuento" maxlength="8" />
																	</div>
																</div>
															</div>
															<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
																		<input id="txtTasaCuotaIva_detalles_facturas_conceptos_contabilidad" 
																			   name="intTasaCuotaIva_detalles_facturas_conceptos_contabilidad" 
																			   type="hidden" value="">
																		</input>
																		<label for="txtPorcentajeIva_detalles_facturas_conceptos_contabilidad">IVA %</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtPorcentajeIva_detalles_facturas_conceptos_contabilidad" 
																				name="intPorcentajeIva_detalles_facturas_conceptos_contabilidad" type="text" value="" 
																				tabindex="1" placeholder="Ingrese IVA" maxlength="250">
																		</input>
																	</div>
																</div>
															</div>
															<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
																<div class="form-group">
																	<div class="col-md-12">
																		<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
																		<input id="txtTasaCuotaIeps_detalles_facturas_conceptos_contabilidad" 
																			   name="intTasaCuotaIeps_detalles_facturas_conceptos_contabilidad" 
																			   type="hidden" value="">
																		</input>
																		<label for="txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad">IEPS %</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad" 
																				name="intPorcentajeIeps_detalles_facturas_conceptos_contabilidad" type="text" value="" 
																				tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
																		</input>
																	</div>
																</div>
															</div>
															<!--Botón agregar-->
							                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
							                                	<button class="btn btn-primary btn-toolBtns pull-right" 
							                                			id="btnAgregar_facturas_conceptos_contabilidad"
							                                			onclick="agregar_renglon_detalles_facturas_conceptos_contabilidad();" 
							                                	     	title="Agregar" tabindex="1"> 
							                                		<span class="glyphicon glyphicon-plus"></span>
							                                	</button>
							                             	</div>
														</div>
													</div>
													<!--Div que contiene la tabla con los detalles encontrados-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row ">
															<!-- Diseño de la tabla-->
															<table class="table-hover movil" id="dg_detalles_facturas_conceptos_contabilidad">
																<thead class="movil">
																	<tr class="movil">
																		<th class="movil">Concepto</th>
																		<th class="movil">Cantidad</th>
																		<th class="movil">Precio Unit.</th>
																		<th class="movil">Desc.</th>
																		<th class="movil">Subtotal</th>
																		<th class="movil">IVA</th>
																		<th class="movil">IEPS</th>
																		<th class="movil">Total</th>
																		<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
																	</tr>
																</thead>
																<tbody class="movil"></tbody>
																<tfoot class="movil">
																	<tr class="movil">
																		<td class="movil t1">
																			<strong>Total</strong>
																		</td>
																		<td  class="movil t2">
																			<strong id="acumCantidad_detalles_facturas_conceptos_contabilidad"></strong>
																		</td>
																		<td class="movil t3"></td>
																		<td class="movil t4">
																			<strong id="acumDescuento_detalles_facturas_conceptos_contabilidad"></strong>
																		</td>
																		<td class="movil t5">
																			<strong id="acumSubtotal_detalles_facturas_conceptos_contabilidad"></strong>
																		</td>
																		<td class="movil t6">
																			<strong id="acumIva_detalles_facturas_conceptos_contabilidad"></strong>
																		</td>
																		<td class="movil t7">
																			<strong  id="acumIeps_detalles_facturas_conceptos_contabilidad"></strong>
																		</td>
																		<td class="movil t8">
																			<strong id="acumTotal_detalles_facturas_conceptos_contabilidad"></strong>
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
																		<strong id="numElementos_detalles_facturas_conceptos_contabilidad">0</strong> encontrados
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
						</div><!--Cierre del informacion_general_-->
						<!--Tab - CFDI relacionados-->
						<div id="cfdi_relacionados_facturas_conceptos_contabilidad" class="tab-pane fade">
							<div class="row">
								<!--Botones-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="btn-group pull-right">
										<!--Buscar CFDI a relacionar para agregarlos en la tabla-->
										<button class="btn btn-primary" 
		                                			id="btnBuscarCFDI_facturas_conceptos_contabilidad" 
		                                			onclick="abrir_relacionar_cfdi_facturas_conceptos_contabilidad();" 
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
									<input id="txtNumCfdiRelacionados_facturas_conceptos_contabilidad" 
										   name="intNumCfdiRelacionados_facturas_conceptos_contabilidad" type="hidden" value="">
									</input>
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_cfdi_relacionados_facturas_conceptos_contabilidad">
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
												<strong id="numElementos_cfdi_relacionados_facturas_conceptos_contabilidad">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - CFDI relacionados-->
					  </div><!--Cierre del tab-content-->
	              		<!--Circulo de progreso-->
						<div id="divCirculoBarProgreso_facturas_conceptos_contabilidad" class="load-container load5 circulo_bar no-mostrar">
							<div class="loader">Loading...</div>
							<br><br>
							<div align=center><b>Espere un momento por favor.</b></div>
						</div> 
              			<!--Botones de acción (barra de tareas)-->
						<div class="btn-group row footerModal">
							<div class="col-md-12">
								<!--Nuevo registro-->
								<button class="btn btn-info" id="btnReiniciar_facturas_conceptos_contabilidad"  
										onclick="nuevo_facturas_conceptos_contabilidad('Nuevo');"  title="Nuevo registro" tabindex="2">
									<span class="glyphicon glyphicon-list-alt"></span>
								</button>
								<!--Guardar registro-->
								<button class="btn btn-success" id="btnGuardar_facturas_conceptos_contabilidad"  
										onclick="validar_facturas_conceptos_contabilidad();"  title="Guardar" tabindex="3" disabled>
									<span class="fa fa-floppy-o"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default" id="btnEnviarCorreo_facturas_conceptos_contabilidad"  
										onclick="abrir_cliente_facturas_conceptos_contabilidad('');"  
										title="Enviar correo electrónico" tabindex="4" disabled>
									<span class="glyphicon glyphicon-envelope"></span>
								</button> 
								<!--Ver motivo de cancelación del registro-->
								<button class="btn btn-default" id="btnVerMotivoCancelacion_facturas_conceptos_contabilidad"  
										onclick="ver_cancelacion_facturas_conceptos_contabilidad('');"  title="Ver motivo de cancelación" tabindex="5">
									<i class="fa fa-info-circle" aria-hidden="true"></i>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default" id="btnImprimirRegistro_facturas_conceptos_contabilidad"  
										onclick="reporte_registro_facturas_conceptos_contabilidad('');"  title="Imprimir registro en PDF" tabindex="6" disabled>
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Descargar archivos-->
			                    <button class="btn btn-default" id="btnDescargarArchivo_facturas_conceptos_contabilidad"  
										onclick="descargar_archivos_facturas_conceptos_contabilidad('', '');"  title="Descargar archivos" tabindex="7" disabled>
									<span class="glyphicon glyphicon-download-alt"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default" id="btnDesactivar_facturas_conceptos_contabilidad"  
										onclick="cambiar_estatus_facturas_conceptos_contabilidad('', '', '', '');"  title="Cancelar" tabindex="8" disabled>
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Cerrar modal-->
								<button class="btn  btn-cerrar"  id="btnCerrar_facturas_conceptos_contabilidad"
										type="reset" aria-hidden="true" onclick="cerrar_facturas_conceptos_contabilidad();" 
										title="Cerrar"  tabindex="9">
									<span class="fa fa-times"></span>
								</button>
							</div>
						</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Facturas-->
	</div><!--#FacturasConceptosContabilidadContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_facturas_conceptos_contabilidad" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>

	<!-- /.Plantilla para cargar los motivo de cancelación en el combobox-->  
	<script id="cancelacion_motivos_facturas_conceptos_contabilidad" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#motivos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/motivos}} 
	</script>

	<!-- /.Plantilla para cargar la exportación en el combobox-->  
	<script id="exportacion_facturas_conceptos_contabilidad" type="text/template">
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
		var intPaginaFacturasConceptosContabilidad = 0;
		var strUltimaBusquedaFacturasConceptosContabilidad = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar en el timbrado y cfdi's relacionados)*/
		var strTipoReferenciaFacturasConceptosContabilidad = "FACTURA CONCEPTOS";
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDFacturasConceptosContabilidad = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el id de la exportación base
		var intExportacionBaseIDFacturasConceptosContabilidad = <?php echo EXPORTACION_BASE ?>;
		//Variable que se utiliza para asignar el id del objeto de impuesto base
		var intObjetoImpuestoBaseIDFacturasConceptosContabilidad = <?php echo OBJETOIMP_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseFacturasConceptosContabilidad = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoFacturasConceptosContabilidad = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar el id del motivo de cancelación: Comprobante emitido con errores con relación.
		var intCancelacionIDRelacionCfdiFacturasConceptosContabilidad = <?php echo MOTIVO_CANCELACION_RELACIONCFDI ?>;
		//Variable que se utiliza para asignar el mensaje de régimen fiscal faltante.
		var strMsjRegimenFiscalCteFacturasConceptosContabilidad = "<?php echo MSJ_ERROR_REGIMEN_FISCAL ?>";

		//Variable que se utiliza para asignar objeto del modal Cancelación del timbrado
		var objCancelacionFacturasConceptosContabilidad = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarFacturasConceptosContabilidad = null;
		//Variable que se utiliza para asignar objeto del modal Facturas
		var objFacturasConceptosContabilidad = null;

		//Array que contiene los id´s de las cajas de texto que se utilizan para calcular la fecha de vencimiento
		var arrFechaVencimientoFacturasConceptosContabilidad  = {fecha: '#txtFecha_facturas_conceptos_contabilidad',
																 condicionesPago:  '#cmbCondicionesPago_facturas_conceptos_contabilidad',
																 diasCredito: 	'#txtMaquinariaCreditoDias_facturas_conceptos_contabilidad',
																 fechaVencimiento: 	'#txtFechaVencimiento_facturas_conceptos_contabilidad'
																};


		/*******************************************************************************************************************
		Funciones del objeto CFDI's  relacionados (facturas seleccionadas)
		*********************************************************************************************************************/
		// Constructor del objeto CFDI's relacionados (facturas seleccionadas)
		var objCfdisRelacionadosFacturasConceptosContabilidad;
		function CfdisRelacionadosFacturasConceptosContabilidad(cfdis)
		{
			this.arrCfdis = cfdis;
		}

		//Función para obtener todos los cfdi´s seleccionados
		CfdisRelacionadosFacturasConceptosContabilidad.prototype.getCfdis = function() {
		    return this.arrCfdis;
		}

		//Función para agregar un cfdi al objeto 
		CfdisRelacionadosFacturasConceptosContabilidad.prototype.setCfdi = function (cfdi){
			this.arrCfdis.push(cfdi);
		}

		//Función para obtener un cfdi del objeto 
		CfdisRelacionadosFacturasConceptosContabilidad.prototype.getCfdi = function(index) {
		    return this.arrCfdis[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto CFDI a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto CFDI a relacionar
		var objCfdiRelacionarFacturasConceptosContabilidad;
		
		function CfdiRelacionarFacturasConceptosContabilidad(referenciaID, cliente, folio, fecha, tipoReferencia, uuid, importe)
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
		function permisos_facturas_conceptos_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('contabilidad/facturas_conceptos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_facturas_conceptos_contabilidad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosFacturasConceptosContabilidad = data.row;
					//Separar la cadena 
					var arrPermisosFacturasConceptosContabilidad = strPermisosFacturasConceptosContabilidad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosFacturasConceptosContabilidad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosFacturasConceptosContabilidad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_facturas_conceptos_contabilidad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosFacturasConceptosContabilidad[i]=='GUARDAR') || (arrPermisosFacturasConceptosContabilidad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_facturas_conceptos_contabilidad').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosFacturasConceptosContabilidad[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_facturas_conceptos_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosFacturasConceptosContabilidad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_facturas_conceptos_contabilidad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_facturas_conceptos_contabilidad();
						}
						else if(arrPermisosFacturasConceptosContabilidad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_facturas_conceptos_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosFacturasConceptosContabilidad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_facturas_conceptos_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosFacturasConceptosContabilidad[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_facturas_conceptos_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosFacturasConceptosContabilidad[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_facturas_conceptos_contabilidad').removeAttr('disabled');
						}
						else if(arrPermisosFacturasConceptosContabilidad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_facturas_conceptos_contabilidad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_facturas_conceptos_contabilidad() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaFacturasConceptosContabilidad =($('#txtFechaInicialBusq_facturas_conceptos_contabilidad').val()+$('#txtFechaFinalBusq_facturas_conceptos_contabilidad').val()+$('#txtProspectoIDBusq_facturas_conceptos_contabilidad').val()+$('#cmbEstatusBusq_facturas_conceptos_contabilidad').val()+$('#txtBusqueda_facturas_conceptos_contabilidad').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaFacturasConceptosContabilidad != strUltimaBusquedaFacturasConceptosContabilidad)
			{
				intPaginaFacturasConceptosContabilidad = 0;
				strUltimaBusquedaFacturasConceptosContabilidad = strNuevaBusquedaFacturasConceptosContabilidad;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('contabilidad/facturas_conceptos/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_facturas_conceptos_contabilidad').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_facturas_conceptos_contabilidad').val()),
					 intProspectoID: $('#txtProspectoIDBusq_facturas_conceptos_contabilidad').val(),
					 strEstatus: $('#cmbEstatusBusq_facturas_conceptos_contabilidad').val(),
					 strBusqueda: $('#txtBusqueda_facturas_conceptos_contabilidad').val(),
					 intPagina: intPaginaFacturasConceptosContabilidad,
					 strPermisosAcceso: $('#txtAcciones_facturas_conceptos_contabilidad').val()
					},
					function(data){
						$('#dg_facturas_conceptos_contabilidad tbody').empty();
						var tmpFacturasConceptosContabilidad = Mustache.render($('#plantilla_facturas_conceptos_contabilidad').html(),data);
						$('#dg_facturas_conceptos_contabilidad tbody').html(tmpFacturasConceptosContabilidad);
						$('#pagLinks_facturas_conceptos_contabilidad').html(data.paginacion);
						$('#numElementos_facturas_conceptos_contabilidad').html(data.total_rows);
						intPaginaFacturasConceptosContabilidad = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_facturas_conceptos_contabilidad(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'contabilidad/facturas_conceptos/';

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
			if ($('#chbImprimirDetalles_facturas_conceptos_contabilidad').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_facturas_conceptos_contabilidad').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_facturas_conceptos_contabilidad').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_facturas_conceptos_contabilidad').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_facturas_conceptos_contabilidad').val()),
										'intProspectoID': $('#txtProspectoIDBusq_facturas_conceptos_contabilidad').val(),
										'strEstatus': $('#cmbEstatusBusq_facturas_conceptos_contabilidad').val(), 
										'strBusqueda': $('#txtBusqueda_facturas_conceptos_contabilidad').val(),
										'strDetalles': $('#chbImprimirDetalles_facturas_conceptos_contabilidad').val()		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_facturas_conceptos_contabilidad(id) 
		{
			
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaConceptoID_facturas_conceptos_contabilidad').val();
			}
			else
			{
				intID = id;
			}

			
			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url':  'contabilidad/timbradoV4/get_pdf_facturas',
							'data' : {
										'intReferenciaID':intID,
										'strTipoReferencia':strTipoReferenciaFacturasConceptosContabilidad,
										'strTimbrar': 'NO'		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);	


		}

		


		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_facturas_conceptos_contabilidad(facturaRefaccionID, folio)
		{
			
			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;
			var strFolio = '';

			//Si no existe id, significa que se descargara el archivo desde el modal
			if(facturaRefaccionID == '')
			{
				intID = $('#txtFacturaConceptoID_facturas_conceptos_contabilidad').val();
				strFolio = $('#txtFolio_facturas_conceptos_contabilidad').val();
			}
			else
			{
				intID = facturaRefaccionID;
				strFolio = folio;
			}

			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'contabilidad/timbradoV4/descargar_archivos',
							'data' : {
										'intReferenciaID': intID,
										'strTipoReferencia': strTipoReferenciaFacturasConceptosContabilidad,
										'strFolio': strFolio		
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_facturas_conceptos_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_facturas_conceptos_contabilidad').empty();
					var temp = Mustache.render($('#monedas_facturas_conceptos_contabilidad').html(), data);
					$('#cmbMonedaID_facturas_conceptos_contabilidad').html(temp);
				},
				'json');
		}


		//Regresar el impuesto de objeto base
		function cargar_objeto_impuesto_base_facturas_conceptos_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.ajax({
			        url: 'contabilidad/sat_objeto_impuesto/get_datos',
			        method:'post',
			        dataType: 'json',
			        async: false,
			        data: {
			        	strBusqueda:intObjetoImpuestoBaseIDFacturasConceptosContabilidad,
			       		strTipo: 'id'
			        },
			        success: function (data) {
			          	//Si no se encuentra código 
			        	if(data.row)
			        	{
			        		//Recuperar valores
				            $('#txtObjetoImpuestoSat_detalles_facturas_conceptos_contabilidad').val(data.row.codigo);
				            $('#txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad').val(data.row.codigo+' - '+data.row.descripcion);

			        	}
			        }
			    });
		}


		//Regresar exportación activa para cargarlas en el combobox
		function cargar_exportacion_facturas_conceptos_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar la exportación que se encuentra activa
			$.post('contabilidad/sat_exportacion/get_combo_box', {},
				function(data)
				{
					$('#cmbExportacionID_facturas_conceptos_contabilidad').empty();
					var temp = Mustache.render($('#exportacion_facturas_conceptos_contabilidad').html(), data);
					$('#cmbExportacionID_facturas_conceptos_contabilidad').html(temp);
				},
				'json');
		}
		

		/*******************************************************************************************************************
		Funciones del modal Cancelación del timbrado
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cancelacion_facturas_conceptos_contabilidad()
		{
			//Incializar formulario
			$('#frmCancelacionFacturasConceptosContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_facturas_conceptos_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmCancelacionFacturasConceptosContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cancelacion_facturas_conceptos_contabilidad');
			//Habilitar todos los elementos del formulario
			$('#frmCancelacionFacturasConceptosContabilidad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_cancelacion_facturas_conceptos_contabilidad').attr('disabled','disabled');
			//Mostrar botón de Guardar
		    $("#btnGuardar_cancelacion_facturas_conceptos_contabilidad").show();
		    //Agregar clase para ocultar div que contiene los datos de creación del registro
			$("#divDatosCreacion_cancelacion_facturas_conceptos_contabilidad").addClass('no-mostrar');
		}

		//Función que se utiliza para abrir el modal
		function abrir_cancelacion_facturas_conceptos_contabilidad(id, folio, polizaID)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cancelacion_facturas_conceptos_contabilidad();

			//Asignar datos del registro seleccionado
			$('#txtReferenciaCfdiID_cancelacion_facturas_conceptos_contabilidad').val(id);
			$('#txtFolio_cancelacion_facturas_conceptos_contabilidad').val(folio);
			$('#txtPolizaID_cancelacion_facturas_conceptos_contabilidad').val(polizaID);
			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_cancelacion_facturas_conceptos_contabilidad').addClass("estatus-ACTIVO");

		    //Abrir modal
			objCancelacionFacturasConceptosContabilidad = $('#CancelacionFacturasConceptosContabilidadBox').bPopup({
												   appendTo: '#FacturasConceptosContabilidadContent', 
						                           contentContainer: 'FacturasConceptosContabilidadM', 
						                           zIndex: 2, 
						                           modalClose: false, 
						                           modal: true, 
						                           follow: [true,false], 
						                           followEasing : "linear", 
						                           easing: "linear", 
						                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#cmbCancelacionMotivoID_cancelacion_facturas_conceptos_contabilidad').focus();
		}

		//Función para regresar los datos (al formulario) del registro seleccionados
		function ver_cancelacion_facturas_conceptos_contabilidad(id)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCancelacionID_facturas_conceptos_contabilidad').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/cancelaciones/get_datos',
	        {
	       		intCancelacionID:intID,
	       		strTipoReferencia:strTipoReferenciaFacturasConceptosContabilidad
	        },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			               //Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cancelacion_facturas_conceptos_contabilidad();
							//Recuperar valores
							$('#cmbCancelacionMotivoID_cancelacion_facturas_conceptos_contabilidad').val(data.row.cancelacion_motivo_id);
							$('#txtFolio_cancelacion_facturas_conceptos_contabilidad').val(data.row.folio_referencia);
							$('#txtFolioSustitucion_cancelacion_facturas_conceptos_contabilidad').val(data.row.folio_sustitucion);
							$('#txtUsuarioCreacion_cancelacion_facturas_conceptos_contabilidad').val(data.row.usuario_creacion);
							$('#txtFechaCreacion_cancelacion_facturas_conceptos_contabilidad').val(data.row.fecha_creacion);

							//Dependiendo del estatus cambiar el color del encabezado 
		   					$('#divEncabezadoModal_cancelacion_facturas_conceptos_contabilidad').addClass("estatus-INACTIVO");

		   				    //Deshabilitar todos los elementos del formulario
				            $('#frmCancelacionFacturasConceptosContabilidad').find('input, textarea, select').attr('disabled','disabled');
		   					//Ocultar botón de Guardar
				            $("#btnGuardar_cancelacion_facturas_conceptos_contabilidad").hide();
				            //Remover clase para mostrar div que contiene los datos de creación del registro
							$("#divDatosCreacion_cancelacion_facturas_conceptos_contabilidad").removeClass('no-mostrar');

							//Abrir modal
							objCancelacionFacturasConceptosContabilidad = $('#CancelacionFacturasConceptosContabilidadBox').bPopup({
												   appendTo: '#FacturasConceptosContabilidadContent', 
						                           contentContainer: 'FacturasConceptosContabilidadM', 
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
		function cerrar_cancelacion_facturas_conceptos_contabilidad()
		{
			try {
				//Cerrar modal
				objCancelacionFacturasConceptosContabilidad.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cancelacion_facturas_conceptos_contabilidad();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cancelacion_facturas_conceptos_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_facturas_conceptos_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmCancelacionFacturasConceptosContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	intCancelacionMotivoID_facturas_conceptos_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione un motivo'}
											}
										},
										strFolioSustitucion_cancelacion_facturas_conceptos_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if(value == '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_facturas_conceptos_contabilidad').val()) === intCancelacionIDRelacionCfdiFacturasConceptosContabilidad) 
					                                    	
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un anticipo existente'
					                                        };
					                                    }
					                                    else if(value !== '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_facturas_conceptos_contabilidad').val()) !== intCancelacionIDRelacionCfdiFacturasConceptosContabilidad)
					                                    {

					                                    	//Hacer un llamado a la función para inicializar elementos de la sustitución
					                                    	inicializar_sustitucion_facturas_conceptos_contabilidad();
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cancelacion_facturas_conceptos_contabilidad = $('#frmCancelacionFacturasConceptosContabilidad').data('bootstrapValidator');
			bootstrapValidator_cancelacion_facturas_conceptos_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cancelacion_facturas_conceptos_contabilidad.isValid())
			{
				//Hacer un llamado a la función para cancelar el timbrado de un registro
				cancelar_timbrado_facturas_conceptos_contabilidad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cancelacion_facturas_conceptos_contabilidad()
		{
			try
			{
				$('#frmCancelacionFacturasConceptosContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		
		//Función para inicializar elementos de la sustitución de CFDI
		function inicializar_sustitucion_facturas_conceptos_contabilidad()
		{
			
			//Limpiar contenido de las siguientes cajas de texto
           $('#txtSustitucionID_cancelacion_facturas_conceptos_contabilidad').val('');
           $('#txtUuidSustitucion_cancelacion_facturas_conceptos_contabilidad').val('');
           $('#txtFolioSustitucion_cancelacion_facturas_conceptos_contabilidad').val('');
		}


		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function mostrar_circulo_carga_cancelacion_facturas_conceptos_contabilidad()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_facturas_conceptos_contabilidad").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function ocultar_circulo_carga_cancelacion_facturas_conceptos_contabilidad()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_facturas_conceptos_contabilidad").addClass('no-mostrar');
		}

		//Regresar motivos de cancelación activos para cargarlos en el combobox
		function cargar_motivos_cancelacion_facturas_conceptos_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_cancelacion_motivos/get_combo_box', {},
				function(data)
				{
					$('#cmbCancelacionMotivoID_cancelacion_facturas_conceptos_contabilidad').empty();
					var temp = Mustache.render($('#cancelacion_motivos_facturas_conceptos_contabilidad').html(), data);
					$('#cmbCancelacionMotivoID_cancelacion_facturas_conceptos_contabilidad').html(temp);
				},
				'json');
		}


		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cliente_facturas_conceptos_contabilidad()
		{
			//Incializar formulario
			$('#frmEnviarFacturasConceptosContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_facturas_conceptos_contabilidad();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cliente_facturas_conceptos_contabilidad');
		}

		//Función que se utiliza para abrir el modal
		function abrir_cliente_facturas_conceptos_contabilidad(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cliente_facturas_conceptos_contabilidad();
			//Variables que se utilizan para asignar los datos del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaConceptoID_facturas_conceptos_contabilidad').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/facturas_conceptos/get_datos',
	       {
	       		intFacturaConceptoID:intID
	       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtFacturaConceptoID_cliente_facturas_conceptos_contabilidad').val(data.row.factura_concepto_id);
							$('#txtFolio_cliente_facturas_conceptos_contabilidad').val(data.row.folio);
							$('#txtRazonSocial_cliente_facturas_conceptos_contabilidad').val(data.row.razon_social);
							$('#txtCorreoElectronico_cliente_facturas_conceptos_contabilidad').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_cliente_facturas_conceptos_contabilidad').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_cliente_facturas_conceptos_contabilidad').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarFacturasConceptosContabilidad = $('#EnviarFacturasConceptosContabilidadBox').bPopup({
																   appendTo: '#FacturasConceptosContabilidadContent', 
										                           contentContainer: 'FacturasConceptosContabilidadM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_cliente_facturas_conceptos_contabilidad').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cliente_facturas_conceptos_contabilidad()
		{
			try {
				//Cerrar modal
				objEnviarFacturasConceptosContabilidad.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cliente_facturas_conceptos_contabilidad();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cliente_facturas_conceptos_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_facturas_conceptos_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarFacturasConceptosContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_cliente_facturas_conceptos_contabilidad: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_cliente_facturas_conceptos_contabilidad: {
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
			var bootstrapValidator_cliente_facturas_conceptos_contabilidad = $('#frmEnviarFacturasConceptosContabilidad').data('bootstrapValidator');
			bootstrapValidator_cliente_facturas_conceptos_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cliente_facturas_conceptos_contabilidad.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_cliente_facturas_conceptos_contabilidad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cliente_facturas_conceptos_contabilidad()
		{
			try
			{
				$('#frmEnviarFacturasConceptosContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al cliente
		function enviar_correo_cliente_facturas_conceptos_contabilidad()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cliente_facturas_conceptos_contabilidad();
			//Hacer un llamado al método del controlador para enviar correo electrónico al cliente
			$.post('contabilidad/timbradoV4/enviar_correo_electronico_cliente',
					{ 
						intReferenciaID: $('#txtFacturaConceptoID_cliente_facturas_conceptos_contabilidad').val(),
						strTipoReferencia: strTipoReferenciaFacturasConceptosContabilidad,
						strFolio: $('#txtFolio_cliente_facturas_conceptos_contabilidad').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_cliente_facturas_conceptos_contabilidad').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_cliente_facturas_conceptos_contabilidad').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cliente_facturas_conceptos_contabilidad();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_cliente_facturas_conceptos_contabilidad();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_facturas_conceptos_contabilidad(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_cliente_facturas_conceptos_contabilidad()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_facturas_conceptos_contabilidad").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_cliente_facturas_conceptos_contabilidad()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_facturas_conceptos_contabilidad").addClass('no-mostrar');
		}

		/*******************************************************************************************************************
		Funciones del modal Relacionar CFDI
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_cfdi_facturas_conceptos_contabilidad()
		{
			//Incializar formulario
			$('#frmRelacionarCfdiFacturasConceptosContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_facturas_conceptos_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarCfdiFacturasConceptosContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_cfdi_facturas_conceptos_contabilidad');
			//Eliminar los datos de la tabla CFDI a relacionar
		    $('#dg_relacionar_cfdi_facturas_conceptos_contabilidad tbody').empty();
		    $('#numElementos_relacionar_cfdi_facturas_conceptos_contabilidad').html(0);
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_cfdi_facturas_conceptos_contabilidad()
		{		
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_cfdi_facturas_conceptos_contabilidad();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_facturas_conceptos_contabilidad').val();
			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_cfdi_facturas_conceptos_contabilidad').addClass("estatus-"+strEstatus);
			//Abrir modal
			objRelacionarCfdiFacturasConceptosContabilidad = $('#RelacionarCfdiFacturasConceptosContabilidadBox').bPopup({
											  appendTo: '#FacturasConceptosContabilidadContent', 
			                              	  contentContainer: 'FacturasConceptosContabilidadM', 
			                              	  zIndex: 2, 
			                              	  modalClose: false, 
			                              	  modal: true, 
			                              	  follow: [true,false], 
			                              	  followEasing : "linear", 
			                              	  easing: "linear", 
			                             	  modalColor: ('#F0F0F0')});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_relacionar_cfdi_facturas_conceptos_contabilidad').focus();
			//Hacer un llamado a la función  para cargar los CFDI en el grid
			lista_facturas_relacionar_cfdi_facturas_conceptos_contabilidad();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_cfdi_facturas_conceptos_contabilidad()
		{
			try {
				//Cerrar modal
				objRelacionarCfdiFacturasConceptosContabilidad.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_cfdi_facturas_conceptos_contabilidad()
		{			
			//Hacer un llamado a la función para agregar las facturas (CFDI) seleccionadas al  objeto CFDI's  relacionados
			agregar_facturas_relacionar_cfdi_facturas_conceptos_contabilidad();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_facturas_conceptos_contabilidad();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarCfdiFacturasConceptosContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumCfdi_relacionar_cfdi_facturas_conceptos_contabilidad: {
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
										strFechaInicialBusq_relacionar_cfdi_facturas_conceptos_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaFinalBusq_relacionar_cfdi_facturas_conceptos_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strRazonSocialBusq_relacionar_cfdi_facturas_conceptos_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_relacionar_cfdi_facturas_conceptos_contabilidad = $('#frmRelacionarCfdiFacturasConceptosContabilidad').data('bootstrapValidator');
			bootstrapValidator_relacionar_cfdi_facturas_conceptos_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_cfdi_facturas_conceptos_contabilidad.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_cfdi_facturas_conceptos_contabilidad();
				//Hacer un llamado a la función para agregar los CFDI en la tabla CFDI relacionados
		  		agregar_cfdi_relacionados_cliente_facturas_conceptos_contabilidad('Nuevo', '');
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_cfdi_facturas_conceptos_contabilidad()
		{
			try
			{
				$('#frmRelacionarCfdiFacturasConceptosContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar CFDI's
		*********************************************************************************************************************/
		//Función para la búsqueda de CFDI's 
		function lista_facturas_relacionar_cfdi_facturas_conceptos_contabilidad() 
		{
			//Variables que se utilizan para asignar los criterios de búsqueda
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaInicialBusq =  $.formatFechaMysql($('#txtFechaInicialBusq_relacionar_cfdi_facturas_conceptos_contabilidad').val());
			var dteFechaFinalBusq =  $.formatFechaMysql($('#txtFechaFinalBusq_relacionar_cfdi_facturas_conceptos_contabilidad').val());
			var intProspectoIDBusq =  $('#txtProspectoIDBusq_relacionar_cfdi_facturas_conceptos_contabilidad').val();

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
						$('#dg_relacionar_cfdi_facturas_conceptos_contabilidad tbody').empty();
						var tmpRelacionarCfdiAnticiposCaja = Mustache.render($('#plantilla_relacionar_cfdi_facturas_conceptos_contabilidad').html(),data);
						$('#numElementos_relacionar_cfdi_facturas_conceptos_contabilidad').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_cfdi_facturas_conceptos_contabilidad').html(data.rows.length);	
						}
						$('#dg_relacionar_cfdi_facturas_conceptos_contabilidad tbody').html(tmpRelacionarCfdiAnticiposCaja);
						
					},
			'json');

			
		}

		//Función para agregar las facturas (CFDI) seleccionadas al objeto CFDI's  relacionados
		function agregar_facturas_relacionar_cfdi_facturas_conceptos_contabilidad()
		{
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
             
            //Crear instancia del objeto CFDI relacionados (facturas seleccionadas)
			objCfdisRelacionadosFacturasConceptosContabilidad = new CfdisRelacionadosFacturasConceptosContabilidad([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_cfdi_facturas_conceptos_contabilidad tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
                	//Crear instancia del objeto CFDI a relacionar
					objCfdiRelacionarFacturasConceptosContabilidad = new CfdiRelacionarFacturasConceptosContabilidad(null, '', '', '', '', '', '');

                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objCfdiRelacionarFacturasConceptosContabilidad.intReferenciaID = strValor;
							        break;
							    case 1:
							        objCfdiRelacionarFacturasConceptosContabilidad.strCliente = strValor;
							        break;
							    case 2:
							        objCfdiRelacionarFacturasConceptosContabilidad.strFolio = strValor;
							        break;
							    case 3:
							        objCfdiRelacionarFacturasConceptosContabilidad.dteFecha = strValor;
							        break;
							    case 4:
							        objCfdiRelacionarFacturasConceptosContabilidad.strTipoReferencia = strValor;
							        break;
							    case 5:
							       	objCfdiRelacionarFacturasConceptosContabilidad.strUuid = strValor;
							        break;
							    case 6:
							       	objCfdiRelacionarFacturasConceptosContabilidad.intImporte = strValor;
							       	break;
							}

					      	intCol++;
					    });

                	//Agregar datos del cfdi a relacionar
                	objCfdisRelacionadosFacturasConceptosContabilidad.setCfdi(objCfdiRelacionarFacturasConceptosContabilidad);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumCfdi_relacionar_cfdi_facturas_conceptos_contabilidad').val(intContador);

		}


		/*******************************************************************************************************************
		Funciones del modal Facturas
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_facturas_conceptos_contabilidad(tipoAccion)
		{
			//Incializar formulario
			$('#frmFacturasConceptosContabilidad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_facturas_conceptos_contabilidad();
			//Limpiar cajas de texto ocultas
			$('#frmFacturasConceptosContabilidad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_facturas_conceptos_contabilidad');
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_facturas_conceptos_contabilidad();
			//Eliminar los datos de la tabla CFDI relacionados
		    $('#dg_cfdi_relacionados_facturas_conceptos_contabilidad tbody').empty();
			$('#numElementos_cfdi_relacionados_facturas_conceptos_contabilidad').html(0);
			//Habilitar todos los elementos del formulario
			$('#frmFacturasConceptosContabilidad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Seleccionar tab que contiene la información general
		  	$('a[href="#informacion_general_facturas_conceptos_contabilidad"]').click();
			//Asignar la fecha actual
			$('#txtFecha_facturas_conceptos_contabilidad').val(fechaActual());

			//Si el tipo de acción corresponde a Nuevo
			if(tipoAccion == 'Nuevo')
			{
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_facturas_conceptos_contabilidad').addClass("estatus-NUEVO");
				//Hacer un llamado a la función para cargar el uso de objeto de impuesto base
				cargar_objeto_impuesto_base_facturas_conceptos_contabilidad();
			}

			
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_facturas_conceptos_contabilidad').attr("disabled", "disabled");
			$('#txtRfc_facturas_conceptos_contabilidad').attr("disabled", "disabled");

			//Mostrar por Default 01- No aplica
			$('#cmbExportacionID_facturas_conceptos_contabilidad').val(intExportacionBaseIDFacturasConceptosContabilidad);

			//Mostrar los siguientes botones
			$('#btnGuardar_facturas_conceptos_contabilidad').show();
			$("#btnBuscarCFDI_facturas_conceptos_contabilidad").show(); 
			$('#btnReiniciar_facturas_conceptos_contabilidad').show();
			//Habilitar botón Agregar
			$('#btnAgregar_facturas_conceptos_contabilidad').prop('disabled', false);
			//Ocultar los siguientes botones
			$('#btnEnviarCorreo_facturas_conceptos_contabilidad').hide();
			$("#btnDescargarArchivo_facturas_conceptos_contabilidad").hide();
			$('#btnImprimirRegistro_facturas_conceptos_contabilidad').hide();
			$('#btnDesactivar_facturas_conceptos_contabilidad').hide();
			$('#btnVerMotivoCancelacion_facturas_conceptos_contabilidad').hide();

		}
		
		//Función para inicializar elementos del cliente
		function inicializar_cliente_facturas_conceptos_contabilidad()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#txtRfc_facturas_conceptos_contabilidad").val('');
            $("#txtRegimenFiscalID_facturas_conceptos_contabilidad").val('');
            $("#txtCalle_facturas_conceptos_contabilidad").val('');
            $("#txtNumeroExterior_facturas_conceptos_contabilidad").val('');
            $("#txtNumeroInterior_facturas_conceptos_contabilidad").val('');
            $("#txtCodigoPostal_facturas_conceptos_contabilidad").val('');
            $("#txtColonia_facturas_conceptos_contabilidad").val('');
            $("#txtLocalidad_facturas_conceptos_contabilidad").val('');
            $("#txtMunicipio_facturas_conceptos_contabilidad").val('');
            $("#txtEstado_facturas_conceptos_contabilidad").val('');
            $("#txtPais_facturas_conceptos_contabilidad").val('');
            $("#txtMaquinariaCreditoDias_facturas_conceptos_contabilidad").val('');
		}

		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_facturas_conceptos_contabilidad()
		{
			//Eliminar los datos de la tabla detalles del pedido
		    $('#dg_detalles_facturas_conceptos_contabilidad tbody').empty();
		    $('#acumCantidad_detalles_facturas_conceptos_contabilidad').html('');
		    $('#acumDescuento_detalles_facturas_conceptos_contabilidad').html('');
		    $('#acumSubtotal_detalles_facturas_conceptos_contabilidad').html('');
		    $('#acumIva_detalles_facturas_conceptos_contabilidad').html('');
		    $('#acumIeps_detalles_facturas_conceptos_contabilidad').html('');
		    $('#acumTotal_detalles_facturas_conceptos_contabilidad').html('');
			$('#numElementos_detalles_facturas_conceptos_contabilidad').html(0);
			$('#txtNumDetalles_facturas_conceptos_contabilidad').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_facturas_conceptos_contabilidad()
		{
			try {

				 //Hacer un llamado a la función para cerrar modal Cancelación del timbrado
				cerrar_cancelacion_facturas_conceptos_contabilidad();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
				cerrar_cliente_facturas_conceptos_contabilidad();
				//Hacer un llamado a la función para cerrar modal Relacionar CFDI
				cerrar_relacionar_cfdi_facturas_conceptos_contabilidad();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_facturas_conceptos_contabilidad('');
				//Cerrar modal
				objFacturasConceptosContabilidad.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_facturas_conceptos_contabilidad').focus();
				
			}
			catch(err) {}
		}


		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_facturas_conceptos_contabilidad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_facturas_conceptos_contabilidad();
			//Validación del formulario de campos obligatorios
			$('#frmFacturasConceptosContabilidad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_facturas_conceptos_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strCondicionesPago_facturas_conceptos_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una condición de pago'}
											}
										},
										intMonedaID_facturas_conceptos_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_facturas_conceptos_contabilidad: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_facturas_conceptos_contabilidad').val()) !== intMonedaBaseIDFacturasConceptosContabilidad)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoFacturasConceptosContabilidad)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoFacturasConceptosContabilidad
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strRazonSocial_facturas_conceptos_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del cliente
					                                    if($('#txtProspectoID_facturas_conceptos_contabilidad').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una razón social existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFormaPago_facturas_conceptos_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la forma de pago
					                                    if($('#txtFormaPagoID_facturas_conceptos_contabilidad').val() === '')
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
										strMetodoPago_facturas_conceptos_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del método de pago
					                                    if($('#txtMetodoPagoID_facturas_conceptos_contabilidad').val() === '')
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
										intExportacionID_facturas_conceptos_contabilidad: {
											validators: {
												notEmpty: {message: 'Seleccione una exportación'}
											}
										},
										strUsoCfdi_facturas_conceptos_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del uso de CFDI
					                                    if($('#txtUsoCfdiID_facturas_conceptos_contabilidad').val() === '')
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
										strTipoRelacion_facturas_conceptos_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if((value !== '' && $('#txtTipoRelacionID_facturas_conceptos_contabilidad').val() === '') 
					                                    	|| ($('#txtTipoRelacionID_facturas_conceptos_contabilidad').val() === '' && parseInt($('#txtNumCfdiRelacionados_facturas_conceptos_contabilidad').val()) > 0))
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
										intNumCfdiRelacionados_facturas_conceptos_contabilidad: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan CFDI relacionados
					                                    if(parseInt($('#txtTipoRelacionID_facturas_conceptos_contabilidad').val()) > 0 &&
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
										intNumDetalles_facturas_conceptos_contabilidad: {
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
										strConcepto_detalles_facturas_conceptos_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strConceptoTipo_detalles_facturas_conceptos_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strProductoServicio_detalles_facturas_conceptos_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strUnidad_detalles_facturas_conceptos_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_detalles_facturas_conceptos_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_detalles_facturas_conceptos_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_detalles_facturas_conceptos_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_detalles_facturas_conceptos_contabilidad: {
											excluded: true  //Ignorar (no valida el campo)
										},
										intPorcentajeIeps_detalles_facturas_conceptos_contabilidad: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_facturas_conceptos_contabilidad = $('#frmFacturasConceptosContabilidad').data('bootstrapValidator');
			bootstrapValidator_facturas_conceptos_contabilidad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_facturas_conceptos_contabilidad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_facturas_conceptos_contabilidad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_facturas_conceptos_contabilidad()
		{
			try
			{
				$('#frmFacturasConceptosContabilidad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_facturas_conceptos_contabilidad()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_facturas_conceptos_contabilidad').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrConceptoTipoID = [];
			var arrConceptos = [];
			var arrCantidades = [];
			var arrPreciosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrTasaCuotaIva = [];
			var arrIvasUnitarios = [];
			var arrTasaCuotaIeps = [];
			var arrIepsUnitarios = [];
			var arrCodigosSat = [];
			var arrUnidadesSat = [];
			var arrObjetoImpuestoSat = [];

			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioFactura = parseFloat($('#txtTipoCambio_facturas_conceptos_contabilidad').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var intCantidad = $.reemplazar(objRen.cells[1].innerHTML, ",", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intPrecioUnitario = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[5].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[6].innerHTML, ",", "");
				
				//Calcular iva unitario
				intIvaUnitario =  intIvaUnitario / intCantidad;
				//Calcular ieps unitario
				intIepsUnitario = intIepsUnitario / intCantidad;

				//Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioFactura;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioFactura;
				intIvaUnitario = intIvaUnitario * intTipoCambioFactura;
				intIepsUnitario = intIepsUnitario * intTipoCambioFactura;

				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{	
					//Restar descuento al precio unitario
					intPrecioUnitario = intPrecioUnitario - intDescuentoUnitario;
				}

				//Redondear cantidad a decimales
				intIvaUnitario = intIvaUnitario.toFixed(4);
				intIvaUnitario = parseFloat(intIvaUnitario);

				
				//Redondear cantidad a decimales
				intIepsUnitario = intIepsUnitario.toFixed(4);
				intIepsUnitario = parseFloat(intIepsUnitario);


				//Asignar valores a los arrays
				arrConceptoTipoID.push(objRen.cells[18].innerHTML);
				arrConceptos.push(objRen.getAttribute('id'));
				arrCantidades.push(intCantidad);
				arrPreciosUnitarios.push(intPrecioUnitario);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrTasaCuotaIva.push(objRen.cells[12].innerHTML);
				arrIvasUnitarios.push(intIvaUnitario);
				arrTasaCuotaIeps.push(objRen.cells[13].innerHTML);
				arrIepsUnitarios.push(intIepsUnitario);
				arrCodigosSat.push(objRen.cells[14].innerHTML);
				arrUnidadesSat.push(objRen.cells[16].innerHTML);
				arrObjetoImpuestoSat.push(objRen.cells[20].innerHTML);
				
			}

			//Obtenemos el objeto de la tabla CFDI relacionados
			var objTabla = document.getElementById('dg_cfdi_relacionados_facturas_conceptos_contabilidad').getElementsByTagName('tbody')[0];

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

			//Hacer un llamado a la función para calcular fecha de vencimiento
	       	$.calcularFechaVencimiento(arrFechaVencimientoFacturasConceptosContabilidad);

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('contabilidad/facturas_conceptos/guardar',
					{ 
						//Datos de la factura
						intFacturaConceptoID: $('#txtFacturaConceptoID_facturas_conceptos_contabilidad').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_facturas_conceptos_contabilidad').val()),
						strCondicionesPago: $('#cmbCondicionesPago_facturas_conceptos_contabilidad').val(),
						dteVencimiento: $.formatFechaMysql($('#txtFechaVencimiento_facturas_conceptos_contabilidad').val()),
						intMonedaID: $('#cmbMonedaID_facturas_conceptos_contabilidad').val(),
						intTipoCambio: intTipoCambioFactura,
						intProspectoID: $('#txtProspectoID_facturas_conceptos_contabilidad').val(),
						strRazonSocial: $('#txtRazonSocial_facturas_conceptos_contabilidad').val(),
						strRfc: $('#txtRfc_facturas_conceptos_contabilidad').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_facturas_conceptos_contabilidad').val(),
						strCalle: $('#txtCalle_facturas_conceptos_contabilidad').val(),
						strNumeroExterior: $('#txtNumeroExterior_facturas_conceptos_contabilidad').val(),
						strNumeroInterior: $('#txtNumeroInterior_facturas_conceptos_contabilidad').val(),
						strCodigoPostal: $('#txtCodigoPostal_facturas_conceptos_contabilidad').val(),
						strColonia: $('#txtColonia_facturas_conceptos_contabilidad').val(),
						strLocalidad: $('#txtLocalidad_facturas_conceptos_contabilidad').val(),
						strMunicipio: $('#txtMunicipio_facturas_conceptos_contabilidad').val(),
						strEstado: $('#txtEstado_facturas_conceptos_contabilidad').val(),
						strPais: $('#txtPais_facturas_conceptos_contabilidad').val(),
						intFormaPagoID: $('#txtFormaPagoID_facturas_conceptos_contabilidad').val(),
						intMetodoPagoID: $('#txtMetodoPagoID_facturas_conceptos_contabilidad').val(),
						intUsoCfdiID: $('#txtUsoCfdiID_facturas_conceptos_contabilidad').val(),
						intTipoRelacionID: $('#txtTipoRelacionID_facturas_conceptos_contabilidad').val(),
						intExportacionID: $('#cmbExportacionID_facturas_conceptos_contabilidad').val(),
						strObservaciones: $('#txtObservaciones_facturas_conceptos_contabilidad').val(),
						strNotas: $('#txtNotas_facturas_conceptos_contabilidad').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_facturas_conceptos_contabilidad').val(),
						//Datos de los detalles
						strConceptoTipoID: arrConceptoTipoID.join('|'),
						strConceptos: arrConceptos.join('|'),
						strCodigosSat: arrCodigosSat.join('|'),
						strUnidadesSat: arrUnidadesSat.join('|'),
						strObjetoImpuestoSat: arrObjetoImpuestoSat.join('|'),
						strCantidades: arrCantidades.join('|'),
						strPreciosUnitarios: arrPreciosUnitarios.join('|'),
						strDescuentosUnitarios: arrDescuentosUnitarios.join('|'),
						strTasaCuotaIva: arrTasaCuotaIva.join('|'),
						strIvasUnitarios: arrIvasUnitarios.join('|'),
						strTasaCuotaIeps: arrTasaCuotaIeps.join('|'),
						strIepsUnitarios: arrIepsUnitarios.join('|'),
						//Datos de los CFDI relacionados
						strCfdiRelacionado: arrCfdiRelacionado.join('|'),
						strTiposRelacion: arrTiposRelacion.join('|')
					},
					function(data) {
	
						if(data.resultado)
						{
							//Si no existe id de la factura de conceptos, significa que es un nuevo registro   
							if($('#txtFacturaConceptoID_facturas_conceptos_contabilidad').val() == '')
							{
							  	//Asignar el id de la factura registrada en la base de datos
                     			$('#txtFacturaConceptoID_facturas_conceptos_contabilidad').val(data.factura_concepto_id);
                 			}

                 			//Hacer llamado a la función para cargar  los registros en el grid
							paginacion_facturas_conceptos_contabilidad();
							
							//Hacer un llamado a la función para timbrar los datos del registro
							timbrar_facturas_conceptos_contabilidad($('#txtFacturaConceptoID_facturas_conceptos_contabilidad').val(), 'modal', '', $('#txtRegimenFiscalID_facturas_conceptos_contabilidad').val());

							
							//Si no existe id de la póliza (o se trata de un nuevo registro)
							if(parseInt($('#txtPolizaID_facturas_conceptos_contabilidad').val()) == 0 || 
								$('#txtEstatus_facturas_conceptos_contabilidad').val() == '')
							{
								//Hacer un llamado a la función para generar póliza con los datos del registro
								generar_poliza_facturas_conceptos_contabilidad('', '', '');
							}
							              
						}

						//Si existe mensaje de error
						if(data.tipo_mensaje == 'error')
						{
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_facturas_conceptos_contabilidad(data.tipo_mensaje, data.mensaje);
						}
						
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_facturas_conceptos_contabilidad(tipoMensaje, mensaje, campoID)
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
				new $.Zebra_Dialog(strMsjRegimenFiscalCteFacturasConceptosContabilidad, 
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

		// Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_facturas_conceptos_contabilidad(id, folio, polizaID, folioPoliza)
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
				intID = $('#txtFacturaConceptoID_facturas_conceptos_contabilidad').val();
				strFolio = $('#txtFolio_facturas_conceptos_contabilidad').val();
				intPolizaID = $('#txtPolizaID_facturas_conceptos_contabilidad').val();
				strFolioPoliza = $('#txtFolioPoliza_facturas_conceptos_contabilidad').val();
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
					             {'type':     'question',
					              'title':    'Facturación',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              
					                              //Hacer un llamado a la función para abrir el modal Cancelación del timbrado (cambiar estatus y cancelar timbrado del registro)
					                 			 abrir_cancelacion_facturas_conceptos_contabilidad(intID, strFolio, intPolizaID);

					                        }
					                            
					                    }
					              });  
		}

		


		//Función para cancelar el timbrado de un registro. Cambia el estatus a INACTIVO
		function cancelar_timbrado_facturas_conceptos_contabilidad()
		{

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cancelacion_facturas_conceptos_contabilidad();

			 //Hacer un llamado al método del controlador para cancelar un CFDI y posteriormente cambiar el estatus a INACTIVO
	         //----- CÓDIGO PARA PRODUCCIÓN
	          $.post('contabilidad/timbrado_cancelar/set_cancelar',
	          {
	          		//Datos para cancelar el timbrado (CFDI)
	         		intMovimientoID: $('#txtReferenciaCfdiID_cancelacion_facturas_conceptos_contabilidad').val(),
					strTipoReferencia: strTipoReferenciaFacturasConceptosContabilidad, 
					strUuidSustitucion: $('#txtUuidSustitucion_cancelacion_facturas_conceptos_contabilidad').val(),
					strMotivo: $('select[name="intCancelacionMotivoID_facturas_conceptos_contabilidad"] option:selected').text(),
					//Datos para cambiar (administrativamente) el estatus del registro
					intCancelacionMotivoID: $('#cmbCancelacionMotivoID_cancelacion_facturas_conceptos_contabilidad').val(), 
					intSustitucionID:  $('#txtSustitucionID_cancelacion_facturas_conceptos_contabilidad').val(),
					intPolizaID: $('#txtPolizaID_cancelacion_facturas_conceptos_contabilidad').val()

	          },
	                 function(data) {

	                    if(data.resultado)
	                    {
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_facturas_conceptos_contabilidad();	

							//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
							cerrar_cancelacion_facturas_conceptos_contabilidad();  

							//Si el id del registro se obtuvo del modal
							if($('#txtFacturaConceptoID_facturas_conceptos_contabilidad').val() != '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_facturas_conceptos_contabilidad();     
							}		
	                    }

	                    //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
				        ocultar_circulo_carga_cancelacion_facturas_conceptos_contabilidad();
					    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_facturas_conceptos_contabilidad(data.tipo_mensaje, data.mensaje);


	                 },
	                'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_facturas_conceptos_contabilidad(id, tipoAccion, cancelacionID)
		{	
				//Hacer un llamado al método del controlador para regresar los datos del registro
				$.post('contabilidad/facturas_conceptos/get_datos',
		        {
		       		intFacturaConceptoID:id
		        },
				    function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_facturas_conceptos_contabilidad('');
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar el id de la póliza
				            var intPolizaID = parseInt(data.row.poliza_id); 
				             //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';

				          	//Recuperar valores
				          	$('#txtFacturaConceptoID_facturas_conceptos_contabilidad').val(data.row.factura_concepto_id);
				          	$('#txtFolio_facturas_conceptos_contabilidad').val(data.row.folio);
				            $('#txtFecha_facturas_conceptos_contabilidad').val(data.row.fecha_format);
				            $('#cmbCondicionesPago_facturas_conceptos_contabilidad').val(data.row.condiciones_pago);
				            $('#txtFechaVencimiento_facturas_conceptos_contabilidad').val(data.row.vencimiento);
				            $('#cmbMonedaID_facturas_conceptos_contabilidad').val(data.row.moneda_id);
				            $('#txtTipoCambio_facturas_conceptos_contabilidad').val(data.row.tipo_cambio);
				            $('#txtProspectoID_facturas_conceptos_contabilidad').val(data.row.prospecto_id);
						    $('#txtRazonSocial_facturas_conceptos_contabilidad').val(data.row.razon_social);
						    $('#txtRfc_facturas_conceptos_contabilidad').val(data.row.rfc);
						    $('#txtRegimenFiscalID_facturas_conceptos_contabilidad').val(data.row.regimen_fiscal_id);
						    $('#txtCalle_facturas_conceptos_contabilidad').val(data.row.calle);
						    $('#txtNumeroExterior_facturas_conceptos_contabilidad').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_facturas_conceptos_contabilidad').val(data.row.numero_interior);
						    $('#txtCodigoPostal_facturas_conceptos_contabilidad').val(data.row.codigo_postal);
						    $('#txtColonia_facturas_conceptos_contabilidad').val(data.row.colonia);
						    $('#txtLocalidad_facturas_conceptos_contabilidad').val(data.row.localidad);
						    $('#txtMunicipio_facturas_conceptos_contabilidad').val(data.row.municipio);
						    $('#txtEstado_facturas_conceptos_contabilidad').val(data.row.estado);
						    $('#txtPais_facturas_conceptos_contabilidad').val(data.row.pais);
						    $('#txtMaquinariaCreditoDias_facturas_conceptos_contabilidad').val(data.row.maquinaria_credito_dias);
						    $('#txtFormaPagoID_facturas_conceptos_contabilidad').val(data.row.forma_pago_id);
						    $('#txtFormaPago_facturas_conceptos_contabilidad').val(data.row.forma_pago);
						    $('#txtMetodoPagoID_facturas_conceptos_contabilidad').val(data.row.metodo_pago_id);
						    $('#txtMetodoPago_facturas_conceptos_contabilidad').val(data.row.metodo_pago);
						    $('#txtUsoCfdiID_facturas_conceptos_contabilidad').val(data.row.uso_cfdi_id);
						    $('#txtUsoCfdi_facturas_conceptos_contabilidad').val(data.row.uso_cfdi);
						    $('#txtTipoRelacionID_facturas_conceptos_contabilidad').val(data.row.tipo_relacion_id);
						    $('#txtTipoRelacion_facturas_conceptos_contabilidad').val(data.row.tipo_relacion);
						    $('#cmbExportacionID_facturas_conceptos_contabilidad').val(data.row.exportacion_id);
						    $('#txtObservaciones_facturas_conceptos_contabilidad').val(data.row.observaciones);
						    $('#txtNotas_facturas_conceptos_contabilidad').val(data.row.notas);
						    $('#txtPolizaID_facturas_conceptos_contabilidad').val(intPolizaID);
						    $('#txtFolioPoliza_facturas_conceptos_contabilidad').val(data.row.folio_poliza);
						    $('#txtEstatus_facturas_conceptos_contabilidad').val(strEstatus);

						    //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_facturas_conceptos_contabilidad').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $('#btnImprimirRegistro_facturas_conceptos_contabilidad').show();
				            
						  	//Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar botón Descargar Archivo
				            	$("#btnDescargarArchivo_facturas_conceptos_contabilidad").show();
				           	}	
						  	

							//Si el estatus del registro es TIMBRAR
				            if(strEstatus == 'TIMBRAR' && intPolizaID == 0)
				            {
				            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_facturas_conceptos_contabilidad(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_facturas_conceptos_contabilidad(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

								//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDFacturasConceptosContabilidad)
							    {
									//Habilitar caja de texto
									$('#txtTipoCambio_facturas_conceptos_contabilidad').removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar las siguientes cajas de texto
									$("#txtTipoCambio_facturas_conceptos_contabilidad").attr('disabled','disabled');
							    }				   

				            }
				            else if (strEstatus == 'TIMBRAR' && intPolizaID > 0)
				            {
				            	//Hacer un llamado a la función para habilitar campos de timbrado
				            	habilitar_controles_timbrado_facturas_conceptos_contabilidad();

				            }
				            else
				            {
				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
					            {
					            	//Mostrar los siguientes botones
					            	$('#btnEnviarCorreo_facturas_conceptos_contabilidad').show();

					            	//Si existe el id de la póliza
					            	if(intPolizaID > 0)
					            	{
					            		$('#btnDesactivar_facturas_conceptos_contabilidad').show();
					            	}
					            	
					            }

					            
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmFacturasConceptosContabilidad').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnReiniciar_facturas_conceptos_contabilidad").hide();
								$("#btnGuardar_facturas_conceptos_contabilidad").hide();
								$("#btnBuscarCFDI_facturas_conceptos_contabilidad").hide();
								//Deshabilitar botón Agregar
								$('#btnAgregar_facturas_conceptos_contabilidad').prop('disabled', true); 

								//Si existe id de la cancelación del CFDI
								if(cancelacionID > 0)
								{	
									//Asignar el id de la cancelación
									$("#txtCancelacionID_facturas_conceptos_contabilidad").val(cancelacionID); 
									//Mostrar botón Motivo de cancelación
									$("#btnVerMotivoCancelacion_facturas_conceptos_contabilidad").show(); 
								}
				            }
			            	

				             //Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);

				            //Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_facturas_conceptos_contabilidad').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaConcepto = objRenglon.insertCell(0);
								var objCeldaCantidad = objRenglon.insertCell(1);
								var objCeldaPrecioUnitario = objRenglon.insertCell(2);
								var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
								var objCeldaSubtotal = objRenglon.insertCell(4);
								var objCeldaIva = objRenglon.insertCell(5);
								var objCeldaIeps = objRenglon.insertCell(6);
								var objCeldaTotal = objRenglon.insertCell(7);
								var objCeldaAcciones = objRenglon.insertCell(8);
								//Columnas ocultas
								var objCeldaPorcentajeDescuento = objRenglon.insertCell(9);
								var objCeldaPorcentajeIva = objRenglon.insertCell(10);
								var objCeldaPorcentajeIeps = objRenglon.insertCell(11);
								var objCeldaTasaCuotaIva = objRenglon.insertCell(12);
								var objCeldaTasaCuotaIeps = objRenglon.insertCell(13);
								var objCeldaCodigoSat = objRenglon.insertCell(14);
								var objCeldaProductoServicio = objRenglon.insertCell(15);
								var objCeldaUnidadSat = objRenglon.insertCell(16);
								var objCeldaUnidad = objRenglon.insertCell(17);
								var objCeldaConceptoTipoID = objRenglon.insertCell(18);
								var objCeldaConceptoTipo = objRenglon.insertCell(19);
								var objCeldaObjetoImpuestoSat = objRenglon.insertCell(20);
								var objCeldaObjetoImpuesto = objRenglon.insertCell(21);

							    //Variables que se utilizan para asignar valores del detalle
								var intSubtotal = parseFloat(data.detalles[intCon].precio_unitario);
								var intCantidad =  parseFloat(data.detalles[intCon].cantidad);
								var intPrecioUnitario = parseFloat(data.detalles[intCon].precio_unitario);
								var intDescuentoUnitario = parseFloat(data.detalles[intCon].descuento_unitario);
								var intIvaUnitario = parseFloat(data.detalles[intCon].iva_unitario);
								var intIepsUnitario = parseFloat(data.detalles[intCon].ieps_unitario);
								var intImporteIva = 0;
								var intImporteIeps = 0;
								var intPorcentajeDescuento = 0;
								var intPorcentajeIeps = '';
								var intTotal = 0;

								//Convertir peso mexicano a tipo de cambio
								intSubtotal = intSubtotal / intTipoCambio;
								intPrecioUnitario = intPrecioUnitario / intTipoCambio;
								intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
								intIvaUnitario = intIvaUnitario / intTipoCambio;
								intIepsUnitario = intIepsUnitario / intTipoCambio;

								//Si existe importe del descuento
								if(intDescuentoUnitario > 0)
								{
									//Calcular precio unitario
									intPrecioUnitario = intPrecioUnitario + intDescuentoUnitario;
									//Calcular porcentaje del descuento
									intPorcentajeDescuento = (intDescuentoUnitario / intPrecioUnitario) * 100;
								}
								
								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;

								
								//Calcular importe de IVA
								intImporteIva =  intIvaUnitario * intCantidad;
								

								//Si existe importe de IEPS unitario
								if(intIepsUnitario > 0)
								{
									//Calcular importe de IEPS
									intImporteIeps =  intIepsUnitario * intCantidad;
									intPorcentajeIeps = data.detalles[intCon].porcentaje_ieps;
								}

								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;

								//Cambiar cantidad a  formato moneda (a visualizar)
								intCantidad =  formatMoney(intCantidad, 2, '');
							    intPrecioUnitario =  formatMoney(intPrecioUnitario, 2, '');
							    intDescuentoUnitario =  formatMoney(intDescuentoUnitario, 2, '');
							    intImporteIva  =  formatMoney(intImporteIva, 4, '');
							    intImporteIeps  =  formatMoney(intImporteIeps, 4, '');
							    intSubtotal  =  formatMoney(intSubtotal, 2, '');
							    intTotal  =  formatMoney(intTotal, 2, '');


						        //Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].concepto);
								objCeldaConcepto.setAttribute('class', 'movil d1');
								objCeldaConcepto.innerHTML = data.detalles[intCon].concepto;
								objCeldaCantidad.setAttribute('class', 'movil d2');
								objCeldaCantidad.innerHTML = intCantidad;
								objCeldaPrecioUnitario.setAttribute('class', 'movil d3');
								objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
								objCeldaDescuentoUnitario.setAttribute('class', 'movil d4');
								objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
								objCeldaSubtotal.setAttribute('class', 'movil d5');
								objCeldaSubtotal.innerHTML = intSubtotal;
								objCeldaIva.setAttribute('class', 'movil d6');
								objCeldaIva.innerHTML = intImporteIva;
								objCeldaIeps.setAttribute('class', 'movil d7');
								objCeldaIeps.innerHTML = intImporteIeps;
								objCeldaTotal.setAttribute('class', 'movil d8');
								objCeldaTotal.innerHTML = intTotal;
								objCeldaAcciones.setAttribute('class', 'td-center movil d9');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento; 
								objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIva.innerHTML = data.detalles[intCon].porcentaje_iva;
								objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
								objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIva.innerHTML =  data.detalles[intCon].tasa_cuota_iva;
								objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIeps.innerHTML =  data.detalles[intCon].tasa_cuota_ieps;
								objCeldaCodigoSat.setAttribute('class', 'no-mostrar');
								objCeldaCodigoSat.innerHTML = data.detalles[intCon].codigo_sat; 
								objCeldaProductoServicio.setAttribute('class', 'no-mostrar');
								objCeldaProductoServicio.innerHTML =  data.detalles[intCon].producto_servicio;
								objCeldaUnidadSat.setAttribute('class', 'no-mostrar');
								objCeldaUnidadSat.innerHTML = data.detalles[intCon].unidad_sat; 
								objCeldaUnidad.setAttribute('class', 'no-mostrar');
								objCeldaUnidad.innerHTML =  data.detalles[intCon].unidad; 
								objCeldaConceptoTipoID.setAttribute('class', 'no-mostrar');
								objCeldaConceptoTipoID.innerHTML =  data.detalles[intCon].concepto_tipo_id; 
								objCeldaConceptoTipo.setAttribute('class', 'no-mostrar');
								objCeldaConceptoTipo.innerHTML =  data.detalles[intCon].concepto_tipo; 
								objCeldaObjetoImpuestoSat.setAttribute('class', 'no-mostrar');
								objCeldaObjetoImpuestoSat.innerHTML = data.detalles[intCon].objeto_impuesto_sat; 
								objCeldaObjetoImpuesto.setAttribute('class', 'no-mostrar');
								objCeldaObjetoImpuesto.innerHTML =  data.detalles[intCon].objeto_impuesto; 


				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_facturas_conceptos_contabilidad();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_facturas_conceptos_contabilidad tr").length - 2;
							$('#numElementos_detalles_facturas_conceptos_contabilidad').html(intFilas);
							$('#txtNumDetalles_facturas_conceptos_contabilidad').val(intFilas);
				      		
				            //Hacer un llamado a la función para agregar los CFDI en la tabla CFDI relacionados
							agregar_cfdi_relacionados_cliente_facturas_conceptos_contabilidad('Editar', strEstatus);		
			            	
			            	//Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objFacturasConceptosContabilidad = $('#FacturasConceptosContabilidadBox').bPopup({
															  appendTo: '#FacturasConceptosContabilidadContent', 
								                              contentContainer: 'FacturasConceptosContabilidadM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});
					        }

				            //Enfocar caja de texto
							$('#cmbMonedaID_facturas_conceptos_contabilidad').focus();
			       	    }
		        },
		       'json');
		}


		//Función para habilitar controles del formulario correspondientes al timbrado
		function habilitar_controles_timbrado_facturas_conceptos_contabilidad()
		{
			//Deshabilitar todos los elementos del formulario
        	$('#frmFacturasConceptosContabilidad').find('input, textarea, select').attr('disabled','disabled');
        	//Habilitar las siguientes cajas de texto
        	$('#txtFormaPago_facturas_conceptos_contabilidad').removeAttr('disabled');
        	$('#txtMetodoPago_facturas_conceptos_contabilidad').removeAttr('disabled');
        	$('#txtUsoCfdi_facturas_conceptos_contabilidad').removeAttr('disabled');
        	$('#txtTipoRelacion_facturas_conceptos_contabilidad').removeAttr('disabled');
        	$('#cmbExportacionID_facturas_conceptos_contabilidad').removeAttr('disabled');
        	$('#txtObservaciones_facturas_conceptos_contabilidad').removeAttr('disabled');
        	$('#txtNotas_facturas_conceptos_contabilidad').removeAttr('disabled');
		}

		//Función para regresar obtener los datos de un cliente
		function get_datos_cliente_facturas_conceptos_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar los datos del cliente
            $.post('cuentas_cobrar/clientes/get_datos',
                  { 
                  	intProspectoID:$("#txtProspectoID_facturas_conceptos_contabilidad").val()
                  },
                  function(data) {
                    if(data.row){
                       
                       //Asignar datos del registro seleccionado
                       $("#txtRazonSocial_facturas_conceptos_contabilidad").val(data.row.razon_social);
                       $("#txtRfc_facturas_conceptos_contabilidad").val(data.row.rfc);
                       $('#txtRegimenFiscalID_facturas_conceptos_contabilidad').val(data.row.regimen_fiscal_id);
                       $("#txtCalle_facturas_conceptos_contabilidad").val(data.row.calle);
                       $("#txtNumeroExterior_facturas_conceptos_contabilidad").val(data.row.numero_exterior);
                       $("#txtNumeroInterior_facturas_conceptos_contabilidad").val(data.row.numero_interior);
                       $("#txtCodigoPostal_facturas_conceptos_contabilidad").val(data.row.codigo_postal);
                       $("#txtColonia_facturas_conceptos_contabilidad").val(data.row.colonia);
                       $("#txtLocalidad_facturas_conceptos_contabilidad").val(data.row.localidad);
                       $("#txtMunicipio_facturas_conceptos_contabilidad").val(data.row.municipio);
                       $("#txtEstado_facturas_conceptos_contabilidad").val(data.row.estado_rep);
                       $("#txtPais_facturas_conceptos_contabilidad").val(data.row.pais_rep);
                       $("#txtMaquinariaCreditoDias_facturas_conceptos_contabilidad").val(data.row.maquinaria_credito_dias);
                    }
                  }
                 ,
                'json');
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_facturas_conceptos_contabilidad()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_facturas_conceptos_contabilidad').val()) !== intMonedaBaseIDFacturasConceptosContabilidad)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_facturas_conceptos_contabilidad").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_facturas_conceptos_contabilidad').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_facturas_conceptos_contabilidad').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_facturas_conceptos_contabilidad").val(data.row.tipo_cambio_venta);
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}


		//Función para generar póliza con los datos de un registro
		function generar_poliza_facturas_conceptos_contabilidad(id, estatus, formulario)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaConceptoID_facturas_conceptos_contabilidad').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_facturas_conceptos_contabilidad(formulario);
			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaFacturasConceptosContabilidad, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_facturas_conceptos_contabilidad').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_facturas_conceptos_contabilidad(formulario);
			    //Si existe resultado
				if (data.resultado)
				{

					//Asignar el id de la póliza (generada) y evitar duplicidad de datos en caso de que no sea posible timbrar el registro
                    $('#txtPolizaID_facturas_conceptos_contabilidad').val(data.poliza_id);
				   //Hacer llamado a la función para cargar  los registros en el grid
					paginacion_facturas_conceptos_contabilidad();
				}

				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_facturas_conceptos_contabilidad(data.tipo_mensaje, data.mensaje);
				
		     },
		     'json');

		}

		//Función para timbrar los datos de un registro
		function timbrar_facturas_conceptos_contabilidad(id, tipo, formulario, regimenFiscalID)
		{	
			
			//Si existe id del régimen fiscal
			if(regimenFiscalID > 0)
			{
				//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
				mostrar_circulo_carga_facturas_conceptos_contabilidad(formulario);
				//Hacer un llamado al método del controlador para timbrar los datos del registro
				$.post('contabilidad/timbradoV4/set_timbrar',
			     {
			     	intReferenciaID: id,
			      	strTipoReferencia: strTipoReferenciaFacturasConceptosContabilidad
			     },
			     function(data) {
		
					//Si el id del registro se obtuvo del modal
					if(tipo == 'modal')
					{
						//Si existe resultado (los datos se timbraron correctamente)
						if (data.resultado)
						{
							
							//Hacer un llamado a la función para cerrar modal
							cerrar_facturas_conceptos_contabilidad(); 
						}
						else
						{

							//Hacer un llamado a la función para limpiar los mensajes de error 
							limpiar_mensajes_facturas_conceptos_contabilidad();
							//Hacer un llamado a la función para cargar datos del registro (habilitar campos de timbrado)
							editar_facturas_conceptos_contabilidad(id,'Nuevo');

						}
					}
					
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_facturas_conceptos_contabilidad();
					//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		            ocultar_circulo_carga_facturas_conceptos_contabilidad(formulario);
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_facturas_conceptos_contabilidad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
			}
			else
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				 mensaje_facturas_conceptos_contabilidad('error_regimen_fiscal');
			}
			
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function mostrar_circulo_carga_facturas_conceptos_contabilidad(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_facturas_conceptos_contabilidad';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_facturas_conceptos_contabilidad';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function ocultar_circulo_carga_facturas_conceptos_contabilidad(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_facturas_conceptos_contabilidad';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_facturas_conceptos_contabilidad';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}
	

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos del detalle
		function inicializar_detalle_facturas_conceptos_contabilidad()
		{
			//Limpiamos las cajas de texto
			$('#txtConceptoTipoID_detalles_facturas_conceptos_contabilidad ').val('');
		    $('#txtConceptoTipo_detalles_facturas_conceptos_contabilidad ').val('');
			$('#txtConcepto_detalles_facturas_conceptos_contabilidad ').val('');
			$('#txtCodigoSat_detalles_facturas_conceptos_contabilidad ').val('');
			$('#txtProductoServicio_detalles_facturas_conceptos_contabilidad ').val('');
			$('#txtUnidadSat_detalles_facturas_conceptos_contabilidad ').val('');
			$('#txtUnidad_detalles_facturas_conceptos_contabilidad ').val('');
			$('#txtObjetoImpuestoSat_detalles_facturas_conceptos_contabilidad ').val('');
			$('#txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad ').val('');
			$('#txtCantidad_detalles_facturas_conceptos_contabilidad ').val('');
		    $('#txtPrecioUnitario_detalles_facturas_conceptos_contabilidad ').val('');
		    $('#txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad ').val('');
		    $('#txtTasaCuotaIva_detalles_facturas_conceptos_contabilidad').val('');
		    $('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad ').val('');
		    $('#txtTasaCuotaIeps_detalles_facturas_conceptos_contabilidad').val('');
		    $('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad ').val('');
		}


		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_facturas_conceptos_contabilidad()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla facturas_conceptos_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asignar el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

			//Obtenemos los datos de las cajas de texto
			var strConcepto = $('#txtConcepto_detalles_facturas_conceptos_contabilidad').val();
			var strCodigoSat = $('#txtCodigoSat_detalles_facturas_conceptos_contabilidad').val();
			var strProductoServicio = $('#txtProductoServicio_detalles_facturas_conceptos_contabilidad').val();
			var strUnidadSat = $('#txtUnidadSat_detalles_facturas_conceptos_contabilidad').val();
			var strUnidad = $('#txtUnidad_detalles_facturas_conceptos_contabilidad').val();
			var strObjetoImpuestoSat = $('#txtObjetoImpuestoSat_detalles_facturas_conceptos_contabilidad').val();
			var strObjetoImpuesto = $('#txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad').val();
			var intCantidad = $('#txtCantidad_detalles_facturas_conceptos_contabilidad').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_facturas_conceptos_contabilidad').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_facturas_conceptos_contabilidad').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_facturas_conceptos_contabilidad').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').val();
			var intConceptoTipoID = $('#txtConceptoTipoID_detalles_facturas_conceptos_contabilidad').val();
			var strConceptoTipo = $('#txtConceptoTipo_detalles_facturas_conceptos_contabilidad').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_facturas_conceptos_contabilidad').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (strConcepto == '')
			{
				//Enfocar caja de texto
				$('#txtConcepto_detalles_facturas_conceptos_contabilidad').focus();
			}
			else if (intConceptoTipoID == '')
			{
				//Enfocar caja de texto
				$('#txtConceptoTipo_detalles_facturas_conceptos_contabilidad').focus();
			}
			else if (strCodigoSat == '')
			{
				//Enfocar caja de texto
				$('#txtProductoServicio_detalles_facturas_conceptos_contabilidad').focus();
			}
			else if (strUnidadSat == '')
			{
				//Enfocar caja de texto
				$('#txtUnidad_detalles_facturas_conceptos_contabilidad').focus();
			}
			else if (strObjetoImpuestoSat == '')
			{
				//Enfocar caja de texto
				$('#txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad').focus();
			}
			else if (intCantidad == '')
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_facturas_conceptos_contabilidad').focus();
			}
			else if (intPrecioUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_detalles_facturas_conceptos_contabilidad').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad').focus();
			}
			else if (intPorcentajeIva == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad').focus();
			}
			else if(intTasaCuotaIeps == '' && intPorcentajeIeps != '')
			{
				//Limpiar caja de texto
				$('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').focus();
			}
			else
			{

				//Hacer un llamado a la función para inicializar elementos del detalle
				inicializar_detalle_facturas_conceptos_contabilidad();

				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strConcepto = strConcepto.toUpperCase();

				//Convertir cadena de texto a número decimal
				intPrecioUnitario = parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
				intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
				intSubtotal = intPrecioUnitario;

				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					//Calcular descuento unitario
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;

					//Redondear cantidad a decimales
					intDescuentoUnitario = intDescuentoUnitario.toFixed(2);

					//Decrementar descuento unitario
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}

				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;
				//Redondear cantidad a decimales
				intSubtotal = intSubtotal.toFixed(2);
				intSubtotal = parseFloat(intSubtotal);

				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);

				//Redondear cantidad a dos decimales
			    intImporteIva = intImporteIva.toFixed(4);
			    intImporteIva = parseFloat(intImporteIva);

				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps != '')
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
					//Redondear cantidad a dos decimales
			   	 	intImporteIeps = intImporteIeps.toFixed(4);
			   	 	intImporteIeps = parseFloat(intImporteIeps);
				}


				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

				//Cambiar cantidad a  formato moneda (a visualizar)
				intCantidad =  formatMoney(intCantidad, 2, '');
			    intPrecioUnitario =  formatMoney(intPrecioUnitario, 2, '');
			    intDescuentoUnitario =  formatMoney(intDescuentoUnitario, 2, '');
			    intImporteIva  =  formatMoney(intImporteIva, 4, '');
			    intImporteIeps  =  formatMoney(intImporteIeps, 4, '');
			    intSubtotal  =  formatMoney(intSubtotal, 2, '');
			    intTotal  =  formatMoney(intTotal, 2, '');

			    //Revisamos si existe la descripción proporcionada, si es así, editamos los datos
				if (objTabla.rows.namedItem(strConcepto))
				{
					objTabla.rows.namedItem(strConcepto).cells[1].innerHTML = intCantidad;
					objTabla.rows.namedItem(strConcepto).cells[2].innerHTML = intPrecioUnitario;
					objTabla.rows.namedItem(strConcepto).cells[3].innerHTML =  intDescuentoUnitario;
					objTabla.rows.namedItem(strConcepto).cells[4].innerHTML =  intSubtotal;
					objTabla.rows.namedItem(strConcepto).cells[5].innerHTML = intImporteIva;
					objTabla.rows.namedItem(strConcepto).cells[6].innerHTML = intImporteIeps;
					objTabla.rows.namedItem(strConcepto).cells[7].innerHTML = intTotal;
					objTabla.rows.namedItem(strConcepto).cells[9].innerHTML = intPorcentajeDescuento;
					objTabla.rows.namedItem(strConcepto).cells[10].innerHTML = intPorcentajeIva;
					objTabla.rows.namedItem(strConcepto).cells[11].innerHTML = intPorcentajeIeps;
					objTabla.rows.namedItem(strConcepto).cells[12].innerHTML = intTasaCuotaIva;
					objTabla.rows.namedItem(strConcepto).cells[13].innerHTML = intTasaCuotaIeps;
					objTabla.rows.namedItem(strConcepto).cells[14].innerHTML =  strCodigoSat;
					objTabla.rows.namedItem(strConcepto).cells[15].innerHTML =  strProductoServicio;
					objTabla.rows.namedItem(strConcepto).cells[16].innerHTML = strUnidadSat;
					objTabla.rows.namedItem(strConcepto).cells[17].innerHTML = strUnidad;
					objTabla.rows.namedItem(strConcepto).cells[18].innerHTML = intConceptoTipoID;
					objTabla.rows.namedItem(strConcepto).cells[19].innerHTML = strConceptoTipo;
					objTabla.rows.namedItem(strConcepto).cells[20].innerHTML = strObjetoImpuestoSat;
					objTabla.rows.namedItem(strConcepto).cells[21].innerHTML = strObjetoImpuesto;
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaConcepto = objRenglon.insertCell(0);
					var objCeldaCantidad = objRenglon.insertCell(1);
					var objCeldaPrecioUnitario = objRenglon.insertCell(2);
					var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
					var objCeldaSubtotal = objRenglon.insertCell(4);
					var objCeldaIva = objRenglon.insertCell(5);
					var objCeldaIeps = objRenglon.insertCell(6);
					var objCeldaTotal = objRenglon.insertCell(7);
					var objCeldaAcciones = objRenglon.insertCell(8);
					//Columnas ocultas
					var objCeldaPorcentajeDescuento = objRenglon.insertCell(9);
					var objCeldaPorcentajeIva = objRenglon.insertCell(10);
					var objCeldaPorcentajeIeps = objRenglon.insertCell(11);
					var objCeldaTasaCuotaIva = objRenglon.insertCell(12);
					var objCeldaTasaCuotaIeps = objRenglon.insertCell(13);
					var objCeldaCodigoSat = objRenglon.insertCell(14);
					var objCeldaProductoServicio = objRenglon.insertCell(15);
					var objCeldaUnidadSat = objRenglon.insertCell(16);
					var objCeldaUnidad = objRenglon.insertCell(17);
					var objCeldaConceptoTipoID = objRenglon.insertCell(18);
					var objCeldaConceptoTipo = objRenglon.insertCell(19);
					var objCeldaObjetoImpuestoSat = objRenglon.insertCell(20);
					var objCeldaObjetoImpuesto = objRenglon.insertCell(21);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strConcepto);
					objCeldaConcepto.setAttribute('class', 'movil d1');
					objCeldaConcepto.innerHTML = strConcepto;
					objCeldaCantidad.setAttribute('class', 'movil d2');
					objCeldaCantidad.innerHTML = intCantidad;
					objCeldaPrecioUnitario.setAttribute('class', 'movil d3');
					objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
					objCeldaDescuentoUnitario.setAttribute('class', 'movil d4');
					objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
					objCeldaSubtotal.setAttribute('class', 'movil d5');
					objCeldaSubtotal.innerHTML = intSubtotal;
					objCeldaIva.setAttribute('class', 'movil d6');
					objCeldaIva.innerHTML = intImporteIva;
					objCeldaIeps.setAttribute('class', 'movil d7');
					objCeldaIeps.innerHTML = intImporteIeps;
					objCeldaTotal.setAttribute('class', 'movil d8');
					objCeldaTotal.innerHTML = intTotal;
					objCeldaAcciones.setAttribute('class', 'td-center movil d9');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_facturas_conceptos_contabilidad(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_facturas_conceptos_contabilidad(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento; 
					objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIva.innerHTML = intPorcentajeIva; 
					objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
					objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIva.innerHTML = intTasaCuotaIva;
					objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
					objCeldaTasaCuotaIeps.innerHTML =  intTasaCuotaIeps;
					objCeldaCodigoSat.setAttribute('class', 'no-mostrar');
					objCeldaCodigoSat.innerHTML = strCodigoSat; 
					objCeldaProductoServicio.setAttribute('class', 'no-mostrar');
					objCeldaProductoServicio.innerHTML = strProductoServicio;
					objCeldaUnidadSat.setAttribute('class', 'no-mostrar');
					objCeldaUnidadSat.innerHTML = strUnidadSat; 
					objCeldaUnidad.setAttribute('class', 'no-mostrar');
					objCeldaUnidad.innerHTML = strUnidad; 
					objCeldaConceptoTipoID.setAttribute('class', 'no-mostrar');
					objCeldaConceptoTipoID.innerHTML = intConceptoTipoID; 
					objCeldaConceptoTipo.setAttribute('class', 'no-mostrar');
					objCeldaConceptoTipo.innerHTML = strConceptoTipo; 
					objCeldaObjetoImpuestoSat.setAttribute('class', 'no-mostrar');
					objCeldaObjetoImpuestoSat.innerHTML = strObjetoImpuestoSat; 
					objCeldaObjetoImpuesto.setAttribute('class', 'no-mostrar');
					objCeldaObjetoImpuesto.innerHTML = strObjetoImpuesto; 
				}

				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_facturas_conceptos_contabilidad();
				//Hacer un llamado a la función para cargar el uso de objeto de impuesto base
				cargar_objeto_impuesto_base_facturas_conceptos_contabilidad();
				
				//Enfocar caja de texto
				$('#txtConcepto_detalles_facturas_conceptos_contabilidad').focus();
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_facturas_conceptos_contabilidad tr").length - 2;
			$('#numElementos_detalles_facturas_conceptos_contabilidad').html(intFilas);
			$('#txtNumDetalles_facturas_conceptos_contabilidad').val(intFilas);
		}


		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_facturas_conceptos_contabilidad(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtConcepto_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtCantidad_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtPrecioUnitario_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[9].innerHTML);
			$('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtTasaCuotaIva_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtTasaCuotaIeps_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtCodigoSat_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);
			$('#txtProductoServicio_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[15].innerHTML);
			$('#txtUnidadSat_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[16].innerHTML);
			$('#txtUnidad_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[17].innerHTML);
			$('#txtConceptoTipoID_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[18].innerHTML);
			$('#txtConceptoTipo_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[19].innerHTML);
			$('#txtObjetoImpuestoSat_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[20].innerHTML);
			$('#txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad').val(objRenglon.parentNode.parentNode.cells[21].innerHTML);

			//Enfocar caja de texto
			$('#txtConcepto_detalles_facturas_conceptos_contabilidad').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_facturas_conceptos_contabilidad(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_facturas_conceptos_contabilidad").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_facturas_conceptos_contabilidad();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $('#dg_detalles_facturas_conceptos_contabilidad tr').length - 2;
			$('#numElementos_detalles_facturas_conceptos_contabilidad').html(intFilas);
			$('#txtNumDetalles_facturas_conceptos_contabilidad').val(intFilas);

			//Enfocar caja de texto
			$('#txtConcepto_detalles_facturas_conceptos_contabilidad').focus();
		}


		//Función para calcular totales de la tabla
		function calcular_totales_detalles_facturas_conceptos_contabilidad()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_facturas_conceptos_contabilidad').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, 2, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 2, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, 4, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, 4, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, 2, '');

			//Asignar los valores
			$('#acumCantidad_detalles_facturas_conceptos_contabilidad').html(intAcumUnidades);
			$('#acumDescuento_detalles_facturas_conceptos_contabilidad').html(intAcumDescuento);
			$('#acumSubtotal_detalles_facturas_conceptos_contabilidad').html(intAcumSubtotal);
			$('#acumIva_detalles_facturas_conceptos_contabilidad').html(intAcumIva);
			$('#acumIeps_detalles_facturas_conceptos_contabilidad').html(intAcumIeps);
			$('#acumTotal_detalles_facturas_conceptos_contabilidad').html(intAcumTotal);
		}

		


		/*******************************************************************************************************************
		Funciones de la tabla CFDI relacionados
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_cfdi_relacionados_cliente_facturas_conceptos_contabilidad(tipoAccion, estatus)
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Si se cumple la sentencia
			if(estatus == '' || estatus == 'TIMBRAR')
			{
				strAccionesTabla = "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_cfdi_relacionados_facturas_conceptos_contabilidad(this)'>" + 
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
							intReferenciaID: $('#txtFacturaConceptoID_facturas_conceptos_contabilidad').val(),
							strTipoReferencia: strTipoReferenciaFacturasConceptosContabilidad
						},
						function(data){

							//Mostramos los CFDI relacionados (facturas seleccionadas)
				           	for (var intCon in data.rows) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_cfdi_relacionados_facturas_conceptos_contabilidad').getElementsByTagName('tbody')[0];

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
							var intFilas = $("#dg_cfdi_relacionados_facturas_conceptos_contabilidad tr").length - 1;
							$('#numElementos_cfdi_relacionados_facturas_conceptos_contabilidad').html(intFilas);
							$('#txtNumCfdiRelacionados_facturas_conceptos_contabilidad').val(intFilas);
						},
				'json');
			}
			else
			{				
				//Mostramos los CFDI relacionados (facturas seleccionadas)
				for (var intCon in objCfdisRelacionadosFacturasConceptosContabilidad.getCfdis()) 
	            {
	            	//Crear instancia del objeto CFDI a relacionar 
	            	objCfdiRelacionarFacturasConceptosContabilidad = new CfdiRelacionarFacturasConceptosContabilidad();
	            	//Asignar datos del CFDI corespondiente al indice
	            	objCfdiRelacionarFacturasConceptosContabilidad = objCfdisRelacionadosFacturasConceptosContabilidad.getCfdi(intCon);
	            	
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_cfdi_relacionados_facturas_conceptos_contabilidad').getElementsByTagName('tbody')[0];

					//Variable que se utiliza para asignar el id del detalle
					var strDetalleID =  objCfdiRelacionarFacturasConceptosContabilidad.intReferenciaID+'_'+objCfdiRelacionarFacturasConceptosContabilidad.strTipoReferencia;

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
						objCeldaCliente.innerHTML = objCfdiRelacionarFacturasConceptosContabilidad.strCliente;
						objCeldaFolio.setAttribute('class', 'movil c2');
						objCeldaFolio.innerHTML = objCfdiRelacionarFacturasConceptosContabilidad.strFolio;
						objCeldaFecha.setAttribute('class', 'movil c3');
						objCeldaFecha.innerHTML = objCfdiRelacionarFacturasConceptosContabilidad.dteFecha;
						objCeldaModulo.setAttribute('class', 'movil c4');
						objCeldaModulo.innerHTML = objCfdiRelacionarFacturasConceptosContabilidad.strTipoReferencia;
						objCeldaUuid.setAttribute('class', 'movil c5');
						objCeldaUuid.innerHTML =  objCfdiRelacionarFacturasConceptosContabilidad.strUuid;
						objCeldaImporte.setAttribute('class', 'movil c6');
						objCeldaImporte.innerHTML = objCfdiRelacionarFacturasConceptosContabilidad.intImporte;
						objCeldaAcciones.setAttribute('class', 'td-center movil c7');
						objCeldaAcciones.innerHTML = strAccionesTabla;
						objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
						objCeldaReferenciaID.innerHTML = objCfdiRelacionarFacturasConceptosContabilidad.intReferenciaID;
					}
	            }

	            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
				var intFilas = $("#dg_cfdi_relacionados_facturas_conceptos_contabilidad tr").length - 1;
				$('#numElementos_cfdi_relacionados_facturas_conceptos_contabilidad').html(intFilas);
				$('#txtNumCfdiRelacionados_facturas_conceptos_contabilidad').val(intFilas);
			}
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_cfdi_relacionados_facturas_conceptos_contabilidad(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_cfdi_relacionados_facturas_conceptos_contabilidad").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
			var intFilas = $("#dg_cfdi_relacionados_facturas_conceptos_contabilidad tr").length - 1;
			$('#numElementos_cfdi_relacionados_facturas_conceptos_contabilidad').html(intFilas);
			$('#txtNumCfdiRelacionados_facturas_conceptos_contabilidad').val(intFilas);
		}

		

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Facturas
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_facturas_conceptos_contabilidad').numeric();
			$('#txtCantidad_detalles_facturas_conceptos_contabilidad').numeric();
			$('#txtPrecioUnitario_detalles_facturas_conceptos_contabilidad').numeric();
        	$('#txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad').numeric();
        	$('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad').numeric();
        	$('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_facturas_conceptos_contabilidad').blur(function(){
				$('.moneda_facturas_conceptos_contabilidad').formatCurrency({ roundToDecimalPlace: 2 });
			});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_facturas_conceptos_contabilidad').blur(function(){
                $('.tipo-cambio_facturas_conceptos_contabilidad').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_facturas_conceptos_contabilidad').blur(function(){
                $('.cantidad_facturas_conceptos_contabilidad').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_facturas_conceptos_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});

			//Calcular fecha de vencimiento cuando cambie la fecha
			$('#dteFecha_facturas_conceptos_contabilidad').on('dp.change', function (e) {
             	//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_facturas_conceptos_contabilidad();
			});

			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_facturas_conceptos_contabilidad').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_facturas_conceptos_contabilidad').val()) === intMonedaBaseIDFacturasConceptosContabilidad)
             	{
             		//Deshabilitar caja de texto
					$('#txtTipoCambio_facturas_conceptos_contabilidad').attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_facturas_conceptos_contabilidad').val(intTipoCambioMonedaBaseFacturasConceptosContabilidad);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_facturas_conceptos_contabilidad').formatCurrency({ roundToDecimalPlace: 4 });
					
             	}
             	else
             	{
             		//Habilitar caja de texto
					$('#txtTipoCambio_facturas_conceptos_contabilidad').removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_facturas_conceptos_contabilidad').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_facturas_conceptos_contabilidad();
             	}
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_facturas_conceptos_contabilidad').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_facturas_conceptos_contabilidad').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoFacturasConceptosContabilidad)
	        	{
	        		$('#txtTipoCambio_facturas_conceptos_contabilidad').val(intTipoCambioMaximoFacturasConceptosContabilidad);
	        	}

		    });

	       
			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_facturas_conceptos_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_facturas_conceptos_contabilidad').val('');
	               //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_facturas_conceptos_contabilidad();
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
		             $('#txtProspectoID_facturas_conceptos_contabilidad').val(ui.item.data);
		              //Hacer un llamado a la función para regresar los datos del cliente
		              get_datos_cliente_facturas_conceptos_contabilidad();	
	             }
	             else
	             {
	             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				     mensaje_facturas_conceptos_contabilidad('error_regimen_fiscal','','txtRazonSocial_facturas_conceptos_contabilidad');
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
	        $('#txtRazonSocial_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtRazonSocial_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_facturas_conceptos_contabilidad').val('');
	               $('#txtRazonSocial_facturas_conceptos_contabilidad').val('');
                   //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_facturas_conceptos_contabilidad();
	            }
	        });

	        //Autocomplete para recuperar los datos de una forma de pago
	        $('#txtFormaPago_facturas_conceptos_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtFormaPagoID_facturas_conceptos_contabilidad').val('');
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
	             $('#txtFormaPagoID_facturas_conceptos_contabilidad').val(ui.item.data);
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
	        $('#txtFormaPago_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe id de la forma de pago
	            if($('#txtFormaPagoID_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtFormaPago_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtFormaPagoID_facturas_conceptos_contabilidad').val('');
	               $('#txtFormaPago_facturas_conceptos_contabilidad').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un método de pago
	        $('#txtMetodoPago_facturas_conceptos_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMetodoPagoID_facturas_conceptos_contabilidad').val('');
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
	             $('#txtMetodoPagoID_facturas_conceptos_contabilidad').val(ui.item.data);
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
	        $('#txtMetodoPago_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe id del método de pago
	            if($('#txtMetodoPagoID_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtMetodoPago_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMetodoPagoID_facturas_conceptos_contabilidad').val('');
	               $('#txtMetodoPago_facturas_conceptos_contabilidad').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un uso del CFDI
	        $('#txtUsoCfdi_facturas_conceptos_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtUsoCfdiID_facturas_conceptos_contabilidad').val('');
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
	             $('#txtUsoCfdiID_facturas_conceptos_contabilidad').val(ui.item.data);
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
	        $('#txtUsoCfdi_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe id del uso de CFDI
	            if($('#txtUsoCfdiID_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtUsoCfdi_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUsoCfdiID_facturas_conceptos_contabilidad').val('');
	               $('#txtUsoCfdi_facturas_conceptos_contabilidad').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un tipo de relación
	        $('#txtTipoRelacion_facturas_conceptos_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTipoRelacionID_facturas_conceptos_contabilidad').val('');
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
	             $('#txtTipoRelacionID_facturas_conceptos_contabilidad').val(ui.item.data);
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
	        $('#txtTipoRelacion_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtTipoRelacionID_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtTipoRelacion_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTipoRelacionID_facturas_conceptos_contabilidad').val('');
	               $('#txtTipoRelacion_facturas_conceptos_contabilidad').val('');
	            }
	            
	        });


	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_cfdi_relacionados_facturas_conceptos_contabilidad').on('click','button.btn',function(){
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


	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_facturas_conceptos_contabilidad').on('click','button.btn',function(){
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

			//Autocomplete para recuperar los datos de un tipo de concepto
	        $('#txtConceptoTipo_detalles_facturas_conceptos_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtConceptoTipoID_detalles_facturas_conceptos_contabilidad').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/conceptos_tipos/autocomplete",
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
	             $('#txtConceptoTipoID_detalles_facturas_conceptos_contabilidad').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del tipo de concepto cuando pierda el enfoque la caja de texto
	        $('#txtConceptoTipo_detalles_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe id del tipo de concepto
	            if($('#txtConceptoTipoID_detalles_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtConceptoTipo_detalles_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtConceptoTipoID_detalles_facturas_conceptos_contabilidad').val('');
	               $('#txtConceptoTipo_detalles_facturas_conceptos_contabilidad').val('');
	            }
	            
	        });

			//Autocomplete para recuperar los datos de un producto o servicio
	        $('#txtProductoServicio_detalles_facturas_conceptos_contabilidad').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al código del registro 
	                 $('#txtCodigoSat_detalles_facturas_conceptos_contabilidad').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_productos_servicios/autocomplete",
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
	               $('#txtCodigoSat_detalles_facturas_conceptos_contabilidad').val(strCodigo);

	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista código del producto cuando pierda el enfoque la caja de texto
	        $('#txtProductoServicio_detalles_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe código del producto
	            if($('#txtCodigoSat_detalles_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtProductoServicio_detalles_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtCodigoSat_detalles_facturas_conceptos_contabilidad').val('');
	               $('#txtProductoServicio_detalles_facturas_conceptos_contabilidad').val('');
	            }
	        });


			//Autocomplete para recuperar los datos de una unidad
	        $('#txtUnidad_detalles_facturas_conceptos_contabilidad').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al código del registro 
	                 $('#txtUnidadSat_detalles_facturas_conceptos_contabilidad').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "contabilidad/sat_unidades/autocomplete",
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
	               $('#txtUnidadSat_detalles_facturas_conceptos_contabilidad').val(strCodigo);

	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista código de la unidad cuando pierda el enfoque la caja de texto
	        $('#txtUnidad_detalles_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe código de la unidad
	            if($('#txtUnidadSat_detalles_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtUnidad_detalles_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUnidadSat_detalles_facturas_conceptos_contabilidad').val('');
	               $('#txtUnidad_detalles_facturas_conceptos_contabilidad').val('');
	            }
	            
	        });


	        //Autocomplete para recuperar los datos de un objeto de impuesto
	        $('#txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al código del registro 
	                 $('#txtObjetoImpuestoSat_detalles_facturas_conceptos_contabilidad').val('');
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
	               $('#txtObjetoImpuestoSat_detalles_facturas_conceptos_contabilidad').val(strCodigo);

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
	        $('#txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe código del objeto de impuesto
	            if($('#txtObjetoImpuestoSat_detalles_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtObjetoImpuestoSat_detalles_facturas_conceptos_contabilidad').val('');
	               $('#txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad').val('');
	            }
	            
	        });



	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_detalles_facturas_conceptos_contabilidad').val('');
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
	             $('#txtTasaCuotaIva_detalles_facturas_conceptos_contabilidad').val(ui.item.data);
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
	        $('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_detalles_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_detalles_facturas_conceptos_contabilidad').val('');
	               $('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad').val('');
	            }
	            
	        });

	        
	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_detalles_facturas_conceptos_contabilidad').val('');
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
	             //Asignar valores del registro seleccionado
	             $('#txtTasaCuotaIeps_detalles_facturas_conceptos_contabilidad').val(ui.item.data);
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
	        $('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_detalles_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_detalles_facturas_conceptos_contabilidad').val('');
	               $('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').val('');
	            }
	            
	        });

	        //Validar que exista concepto cuando se pulse la tecla enter 
			$('#txtConcepto_detalles_facturas_conceptos_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe concepto
		            if($('#txtConcepto_detalles_facturas_conceptos_contabilidad').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtConcepto_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtConceptoTipo_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
		        }
		    });

		     //Validar que exista tipo de concepto cuando se pulse la tecla enter 
			$('#txtConceptoTipo_detalles_facturas_conceptos_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe id del tipo de concepto
		            if($('#txtConceptoTipoID_detalles_facturas_conceptos_contabilidad').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtConceptoTipo_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtProductoServicio_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
		        }
		    });

		    //Validar que exista código del producto/servicio SAT cuando se pulse la tecla enter 
			$('#txtProductoServicio_detalles_facturas_conceptos_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe código del producto/servicio SAT
		            if($('#txtCodigoSat_detalles_facturas_conceptos_contabilidad').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtProductoServicio_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtUnidad_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
		        }
		    });

		    //Validar que exista código de la unidad SAT cuando se pulse la tecla enter 
			$('#txtUnidad_detalles_facturas_conceptos_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe código de la unidad SAT
		            if($('#txtUnidadSat_detalles_facturas_conceptos_contabilidad').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtUnidad_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
		        }
		    });


		     //Validar que exista código del objeto de impuesto SAT cuando se pulse la tecla enter 
			$('#txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe código del objeto de impuesto SAT
		            if($('#txtObjetoImpuestoSat_detalles_facturas_conceptos_contabilidad').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtObjetoImpuesto_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtCantidad_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_facturas_conceptos_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_facturas_conceptos_contabilidad').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
			   	    	$('#txtPrecioUnitario_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
		        }
		    });

		    //Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_detalles_facturas_conceptos_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtPrecioUnitario_detalles_facturas_conceptos_contabilidad').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de agregar
					    $('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad').focus();
			   	    	
			   	    }
		        }
		    });

			//Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje de IVA
		            if( $('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtTasaCuotaIeps_detalles_facturas_conceptos_contabilidad').val() == '' && 
		         	   $('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').val() != '')
		         	{
		         	
		         		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_detalles_facturas_conceptos_contabilidad').focus();
		         	}
		         	else
		         	{
		   	    		//Hacer un llamado a la función para agregar renglón a la tabla
		   	    		agregar_renglon_detalles_facturas_conceptos_contabilidad();

		         	}
		        }
		    });
		    
			
			/*******************************************************************************************************************
			Controles correspondientes al modal Relacionar CFDI
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_relacionar_cfdi_facturas_conceptos_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_relacionar_cfdi_facturas_conceptos_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});
			

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_relacionar_cfdi_facturas_conceptos_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_relacionar_cfdi_facturas_conceptos_contabilidad').val('');
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
	             $('#txtProspectoIDBusq_relacionar_cfdi_facturas_conceptos_contabilidad').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_relacionar_cfdi_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_relacionar_cfdi_facturas_conceptos_contabilidad').val() == '' ||
	            	$('#txtRazonSocialBusq_relacionar_cfdi_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_relacionar_cfdi_facturas_conceptos_contabilidad').val('');
	               $('#txtRazonSocialBusq_relacionar_cfdi_facturas_conceptos_contabilidad').val('');
	            }
	            
	        });


	        /*******************************************************************************************************************
			Controles correspondientes al modal Cancelación del timbrado
			**************************************	*******************************************************************************/
			 //Autocomplete para recuperar los datos de una sustitución (factura, pago, etc.)
	        $('#txtFolioSustitucion_cancelacion_facturas_conceptos_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSustitucionID_cancelacion_facturas_conceptos_contabilidad').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/facturas_conceptos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intReferenciaID: $('#txtReferenciaCfdiID_cancelacion_facturas_conceptos_contabilidad').val(),
	                   strFormulario: 'cancelacion'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtSustitucionID_cancelacion_facturas_conceptos_contabilidad').val(ui.item.data);
	             $('#txtUuidSustitucion_cancelacion_facturas_conceptos_contabilidad').val(ui.item.uuid);
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
	        $('#txtFolioSustitucion_cancelacion_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtSustitucionID_cancelacion_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtFolioSustitucion_cancelacion_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_facturas_conceptos_contabilidad();
	            }
	            
	        });

	        //Verificar motivo de cancelación cuando cambie la opción del combobox
	        $('#cmbCancelacionMotivoID_cancelacion_facturas_conceptos_contabilidad').change(function(e){   
	            //Si el motivo de cancelación no corresponde a 01 - Comprobante emitido con errores con relación.
              	if(parseInt($('#cmbCancelacionMotivoID_cancelacion_facturas_conceptos_contabilidad').val()) !== intCancelacionIDRelacionCfdiFacturasConceptosContabilidad)
             	{
             		//Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_facturas_conceptos_contabilidad();
					
             	}
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_facturas_conceptos_contabilidad').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_facturas_conceptos_contabilidad').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_facturas_conceptos_contabilidad').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_facturas_conceptos_contabilidad').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_facturas_conceptos_contabilidad').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_facturas_conceptos_contabilidad').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un cliente
	        $('#txtRazonSocialBusq_facturas_conceptos_contabilidad').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_facturas_conceptos_contabilidad').val('');
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
	             $('#txtProspectoIDBusq_facturas_conceptos_contabilidad').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_facturas_conceptos_contabilidad').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_facturas_conceptos_contabilidad').val() == '' ||
	               $('#txtRazonSocialBusq_facturas_conceptos_contabilidad').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_facturas_conceptos_contabilidad').val('');
	               $('#txtRazonSocialBusq_facturas_conceptos_contabilidad').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_facturas_conceptos_contabilidad').on('click','a',function(event){
				event.preventDefault();
				intPaginaFacturasConceptosContabilidad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_facturas_conceptos_contabilidad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_facturas_conceptos_contabilidad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_facturas_conceptos_contabilidad('Nuevo');
				//Abrir modal
				 objFacturasConceptosContabilidad = $('#FacturasConceptosContabilidadBox').bPopup({
												   appendTo: '#FacturasConceptosContabilidadContent', 
					                               contentContainer: 'FacturasConceptosContabilidadM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_facturas_conceptos_contabilidad').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_facturas_conceptos_contabilidad').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_facturas_conceptos_contabilidad();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_facturas_conceptos_contabilidad();
             //Hacer un llamado a la función para cargar los motivos de cancelación en el combobox del modal
            cargar_motivos_cancelacion_facturas_conceptos_contabilidad();
            //Hacer un llamado a la función para cargar exportación en el combobox del modal
            cargar_exportacion_facturas_conceptos_contabilidad();
		});
	</script>