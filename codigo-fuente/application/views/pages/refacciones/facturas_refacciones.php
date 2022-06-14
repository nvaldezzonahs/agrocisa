	<div id="FacturasRefaccionesRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_facturas_refacciones_refacciones" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_facturas_refacciones_refacciones" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_facturas_refacciones_refacciones">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_facturas_refacciones_refacciones'>
				                    <input class="form-control" id="txtFechaInicialBusq_facturas_refacciones_refacciones"
				                    		name= "strFechaInicialBusq_facturas_refacciones_refacciones" 
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
								<label for="txtFechaFinalBusq_facturas_refacciones_refacciones">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_facturas_refacciones_refacciones'>
				                    <input class="form-control" id="txtFechaFinalBusq_facturas_refacciones_refacciones"
				                    		name= "strFechaFinalBusq_facturas_refacciones_refacciones" 
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
								<input id="txtProspectoIDBusq_facturas_refacciones_refacciones" 
									   name="intProspectoIDBusq_facturas_refacciones_refacciones"  type="hidden" 
									   value="">
								</input>
								<label for="txtRazonSocialBusq_facturas_refacciones_refacciones">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocialBusq_facturas_refacciones_refacciones" 
										name="strRazonSocialBusq_facturas_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_facturas_refacciones_refacciones">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_facturas_refacciones_refacciones" 
								 		name="strEstatusBusq_facturas_refacciones_refacciones" tabindex="1">
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
								<label for="txtBusqueda_facturas_refacciones_refacciones">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_facturas_refacciones_refacciones" 
										name="strBusqueda_facturas_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_facturas_refacciones_refacciones" 
									   name="strImprimirDetalles_facturas_refacciones_refacciones" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_facturas_refacciones_refacciones"
									onclick="paginacion_facturas_refacciones_refacciones();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_facturas_refacciones_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_facturas_refacciones_refacciones"
									onclick="reporte_facturas_refacciones_refacciones('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_facturas_refacciones_refacciones"
									onclick="reporte_facturas_refacciones_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil.a5:nth-of-type(5):before {content: "Referencia"; font-weight: bold;}
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
				Definir columnas de la tabla detalles de la factura
				*/
				td.movil.d1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.d5:nth-of-type(5):before {content: "Desc."; font-weight: bold;}
				td.movil.d6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.d7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.d8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.d9:nth-of-type(9):before {content: "Total"; font-weight: bold;}
				td.movil.d10:nth-of-type(10):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles de la factura
				*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "Desc."; font-weight: bold;}
				td.movil.t6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.t7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.t8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.t9:nth-of-type(9):before {content: "Total"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_facturas_refacciones_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Razón social</th>
							<th class="movil">RFC</th>
							<th class="movil">Referencia</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:16em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_facturas_refacciones_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{razon_social}}</td>
							<td class="movil a4">{{rfc}}</td>
							<td class="movil a5">{{folio_referencia}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_facturas_refacciones_refacciones({{factura_refacciones_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_facturas_refacciones_refacciones({{factura_refacciones_id}},'Ver', {{cancelacion_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Ver motivo de cancelación-->
								<button class="btn btn-default btn-xs {{mostrarAccionMotivoCancelacion}}"  
										onclick="ver_cancelacion_facturas_refacciones_refacciones({{cancelacion_id}})"  title="Ver motivo de cancelación">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_cliente_facturas_refacciones_refacciones({{factura_refacciones_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_facturas_refacciones_refacciones({{factura_refacciones_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_facturas_refacciones_refacciones({{factura_refacciones_id}}, '{{estatus}}', 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Timbrar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionTimbrar}}"  
										onclick="timbrar_facturas_refacciones_refacciones({{factura_refacciones_id}},'', 'principal',  {{regimen_fiscal_id}})"  title="Timbrar">
									<span class="fa fa-certificate"></span>
								</button>
								<!--Descargar archivos-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_facturas_refacciones_refacciones({{factura_refacciones_id}}, '{{folio}}');" title="Descargar archivos">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_facturas_refacciones_refacciones({{factura_refacciones_id}}, '{{folio}}', {{poliza_id}}, '{{folio_poliza}}', '{{tipo_referencia}}', {{referencia_id}})" title="Cancelar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_facturas_refacciones_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_facturas_refacciones_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_facturas_refacciones_refacciones" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 	


		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarFacturasRefaccionesRefaccionesBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cliente_facturas_refacciones_refacciones" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarFacturasRefaccionesRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarFacturasRefaccionesRefacciones"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Prospecto / Cliente-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtFacturaRefaccionesID_cliente_facturas_refacciones_refacciones" 
										   name="intFacturaRefaccionesID_cliente_facturas_refacciones_refacciones" 
										   type="hidden" value="" />
									<!-- Caja de texto oculta que se utiliza para recuperar el folio del registro seleccionado-->
									<input id="txtFolio_cliente_facturas_refacciones_refacciones" 
										   name="strFolio_cliente_facturas_refacciones_refacciones" 
										   type="hidden" value="" />	   
									<label for="txtRazonSocial_cliente_facturas_refacciones_refacciones">Razón social</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_cliente_facturas_refacciones_refacciones" 
											name="strRazonSocial_cliente_facturas_refacciones_refacciones" type="text" value="" 
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
									<label for="txtCorreoElectronico_cliente_facturas_refacciones_refacciones">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_cliente_facturas_refacciones_refacciones" 
											name="strCorreoElectronico_cliente_facturas_refacciones_refacciones" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_cliente_facturas_refacciones_refacciones">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_cliente_facturas_refacciones_refacciones" 
											name="strCopiaCorreoElectronico_cliente_facturas_refacciones_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cliente_facturas_refacciones_refacciones" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 						
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_cliente_facturas_refacciones_refacciones"  
									onclick="validar_cliente_facturas_refacciones_refacciones();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cliente_facturas_refacciones_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_cliente_facturas_refacciones_refacciones();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->


		<!-- Diseño del modal Relacionar CFDI-->
		<div id="RelacionarCfdiFacturasRefaccionesRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_cfdi_facturas_refacciones_refacciones" class="ModalBodyTitle">
				<h1>Relacionar CFDI</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarCfdiFacturasRefaccionesRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarCfdiFacturasRefaccionesRefacciones"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha inicial-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicialBusq_relacionar_cfdi_facturas_refacciones_refacciones">Fecha inicial</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaInicialBusq_relacionar_cfdi_facturas_refacciones_refacciones'>
					                    <input class="form-control" id="txtFechaInicialBusq_relacionar_cfdi_facturas_refacciones_refacciones"
					                    		name= "strFechaInicialBusq_relacionar_cfdi_facturas_refacciones_refacciones" 
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
									<label for="txtFechaFinalBusq_relacionar_cfdi_facturas_refacciones_refacciones">Fecha final</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaFinalBusq_relacionar_cfdi_facturas_refacciones_refacciones'>
					                    <input class="form-control" id="txtFechaFinalBusq_relacionar_cfdi_facturas_refacciones_refacciones"
					                    		name= "strFechaFinalBusq_relacionar_cfdi_facturas_refacciones_refacciones" 
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
									<input id="txtProspectoIDBusq_relacionar_cfdi_facturas_refacciones_refacciones" 
										   name="intProspectoIDBusq_relacionar_cfdi_facturas_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<label for="txtRazonSocialBusq_relacionar_cfdi_facturas_refacciones_refacciones">Razón social</label>
								</div>
								<div class="col-md-12">
									<div class="input-group">
										<input class="form-control" id="txtRazonSocialBusq_relacionar_cfdi_facturas_refacciones_refacciones" 
											   name="strRazonSocialBusq_relacionar_cfdi_facturas_refacciones_refacciones"  type="text" value="" 
											   tabindex="1" placeholder="Ingrese razón social" maxlength="250" >
										</input>
										<span class="input-group-btn">
											<button class="btn btn-primary" id="btnBuscar_relacionar_cfdi_facturas_refacciones_refacciones"
													onclick="lista_facturas_relacionar_cfdi_facturas_refacciones_refacciones();" title="Buscar coincidencias" tabindex="1">
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
							<input id="txtNumCfdi_relacionar_cfdi_facturas_refacciones_refacciones" 
								   name="intNumCfdi_relacionar_cfdi_facturas_refacciones_refacciones" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_cfdi_facturas_refacciones_refacciones">
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
								<script id="plantilla_relacionar_cfdi_facturas_refacciones_refacciones" type="text/template"> 
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
							    		id="chbAgregar_relacionar_cfdi_facturas_refacciones_refacciones" />
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
										<strong id="numElementos_relacionar_cfdi_facturas_refacciones_refacciones">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>							 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar CFDI-->
							<button class="btn btn-success" id="btnAgregar_relacionar_cfdi_facturas_refacciones_refacciones"  
									onclick="validar_relacionar_cfdi_facturas_refacciones_refacciones();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_cfdi_facturas_refacciones_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_cfdi_facturas_refacciones_refacciones();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar CFDI-->

		<!-- Diseño del modal Cancelación del timbrado-->
		<div id="CancelacionFacturasRefaccionesRefaccionesBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cancelacion_facturas_refacciones_refacciones" class="ModalBodyTitle confirmacion-modal-title">
			<h1>Cancelación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCancelacionFacturasRefaccionesRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmCancelacionFacturasRefaccionesRefacciones"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Combobox que contiene los motivos de cancelación activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCancelacionMotivoID_cancelacion_facturas_refacciones_refacciones">Motivo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbCancelacionMotivoID_cancelacion_facturas_refacciones_refacciones" 
									 		name="intCancelacionMotivoID_facturas_refacciones_refacciones" 
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
									<input id="txtReferenciaCfdiID_cancelacion_facturas_refacciones_refacciones" 
										   name="intReferenciaCfdiID_cancelacion_facturas_refacciones_refacciones" 
										   type="hidden" value="" />	

									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_cancelacion_facturas_refacciones_refacciones" 
										   name="intPolizaID_cancelacion_facturas_refacciones_refacciones" type="hidden" value="" />
												   
									<!-- Caja de texto oculta para recuperar el id de la referencia (cotización/pedido/remisión) seleccionada-->
											<input id="txtReferenciaID_cancelacion_facturas_refacciones_refacciones" 
												   name="intReferenciaID_cancelacion_facturas_refacciones_refacciones"  type="hidden" 
												   value="" />
									<!-- Caja de texto oculta para recuperar el tipo de referencia (cotización/pedido/remisión) seleccionada-->
									<input id="txtTipoReferencia_cancelacion_facturas_refacciones_refacciones" 
												   name="strTipoReferencia_cancelacion_facturas_refacciones_refacciones"  type="hidden" 
												   value="" />   
									<label for="txtFolio_cancelacion_facturas_refacciones_refacciones">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_cancelacion_facturas_refacciones_refacciones" 
											name="strFolio_cancelacion_facturas_refacciones_refacciones" type="text" value="" 
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
									<input id="txtSustitucionID_cancelacion_facturas_refacciones_refacciones" 
										   name="intSustitucionID_cancelacion_facturas_refacciones_refacciones" 
										   type="hidden" value="" />	
									<!-- Caja de texto oculta que se utiliza para recuperar el UUID de la factura que sustituye-->
									<input id="txtUuidSustitucion_cancelacion_facturas_refacciones_refacciones" 
										   name="strUuidSustitucion_cancelacion_facturas_refacciones_refacciones" 
										   type="hidden" value="" />	   
									<label for="txtFolioSustitucion_cancelacion_facturas_refacciones_refacciones">Sustitución</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolioSustitucion_cancelacion_facturas_refacciones_refacciones" 
											name="strFolioSustitucion_cancelacion_facturas_refacciones_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese factura" maxlength="250" >
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Div que contiene los campos del usuario y fecha del registro -->
			 		<div  id="divDatosCreacion_cancelacion_facturas_refacciones_refacciones" class="row no-mostrar">
			 			<!--Usuario que realizó la cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuarioCreacion_cancelacion_facturas_refacciones_refacciones">Usuario de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuarioCreacion_cancelacion_facturas_refacciones_refacciones" 
											name="strUsuarioCreacion_cancelacion_facturas_refacciones_refacciones" type="text" value="" 
											 disabled >
									</input>
								</div>
							</div>
						</div>
						<!--Fecha de cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaCreacion_cancelacion_facturas_refacciones_refacciones">Fecha de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFechaCreacion_cancelacion_facturas_refacciones_refacciones" 
											name="strFechaCreacion_cancelacion_facturas_refacciones_refacciones" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cancelacion_facturas_refacciones_refacciones" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 						
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar cancelación del CFDI-->
							<button class="btn btn-success" id="btnGuardar_cancelacion_facturas_refacciones_refacciones"  
									onclick="validar_cancelacion_facturas_refacciones_refacciones();"  title="Cancelar CFDI" tabindex="1">
								<span class="fa fa-chain-broken"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cancelacion_facturas_refacciones_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_cancelacion_facturas_refacciones_refacciones();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cancelación del timbrado-->


		<!-- Diseño del modal Facturas-->
		<div id="FacturasRefaccionesRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_facturas_refacciones_refacciones"  class="ModalBodyTitle">
			<h1>Facturación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_cliente_facturas_refacciones_refacciones" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_facturas_refacciones_refacciones" class="active">
									<a data-toggle="tab" href="#informacion_general_facturas_refacciones_refacciones">Información General</a>
								</li>
								<!--Tab que contiene la información de los CFDI relacionados-->
								<li id="tabCfdiRelacionados_facturas_refacciones_refacciones">
									<a data-toggle="tab" href="#cfdi_relacionados_facturas_refacciones_refacciones">CFDI Relacionados</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmFacturasRefaccionesRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmFacturasRefaccionesRefacciones"  onsubmit="return(false)" 
					  autocomplete="off">
					  <div class="tab-content">
					  	<!--Tab - Información General-->
						<div id="informacion_general_facturas_refacciones_refacciones" class="tab-pane fade in active">
							<div class="row">
								<!--Folio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtFacturaRefaccionesID_facturas_refacciones_refacciones" 
												   name="intFacturaRefaccionesID_facturas_refacciones_refacciones" type="hidden" value="" />
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->	   
											<input id="txtEstatus_facturas_refacciones_refacciones" 
												   name="strEstatus_facturas_refacciones_refacciones" type="hidden" value="" />
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la póliza del registro seleccionado-->
											<input id="txtPolizaID_facturas_refacciones_refacciones" 
												   name="intPolizaID_facturas_refacciones_refacciones" type="hidden" value="" />
											 <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
											<input id="txtFolioPoliza_facturas_refacciones_refacciones" 
												   name="strFolioPoliza_facturas_refacciones_refacciones" type="hidden" value="" />
										    <!-- Caja de texto oculta que se utiliza para recuperar el id de la clave de autorización del registro seleccionado-->
											<input id="txtClaveAutorizacionID_facturas_refacciones_refacciones" 
												   name="intClaveAutorizacionID_facturas_refacciones_refacciones" type="hidden" value="" />
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la cancelación del registro seleccionado-->
											<input id="txtCancelacionID_facturas_refacciones_refacciones" 
												   name="intCancelacionID_facturas_refacciones_refacciones" type="hidden" value="" />
											<label for="txtFolio_facturas_refacciones_refacciones">Folio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFolio_facturas_refacciones_refacciones" 
													name="strFolio_facturas_refacciones_refacciones" type="text" 
													value="" placeholder="Autogenerado" disabled />
										</div>
									</div>
								</div>
								<!--Fecha-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_facturas_refacciones_refacciones">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_facturas_refacciones_refacciones'>
							                    <input class="form-control" id="txtFecha_facturas_refacciones_refacciones"
							                    		name= "strFecha_facturas_refacciones_refacciones" 
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
											<label for="cmbMonedaID_facturas_refacciones_refacciones">Moneda</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbMonedaID_facturas_refacciones_refacciones" 
											 		name="intMonedaID_facturas_refacciones_refacciones" tabindex="1">
		                     				</select>
										</div>
									</div>
								</div>
								<!--Tipo de cambio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTipoCambio_facturas_refacciones_refacciones">Tipo de cambio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control tipo-cambio_facturas_refacciones_refacciones" id="txtTipoCambio_facturas_refacciones_refacciones" 
													name="intTipoCambio_facturas_refacciones_refacciones" type="text" value="" 
													tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
						    	<!--Autocomplete que contiene las cotizaciones activas-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la referencia (cotización/pedido/remisión) seleccionada-->
											<input id="txtReferenciaID_facturas_refacciones_refacciones" 
												   name="intReferenciaID_facturas_refacciones_refacciones"  type="hidden" 
												   value="" />
											<!-- Caja de texto oculta para recuperar el tipo de referencia (cotización/pedido/remisión) seleccionada-->
											<input id="txtTipoReferencia_facturas_refacciones_refacciones" 
												   name="strTipoReferencia_facturas_refacciones_refacciones"  type="hidden" 
												   value="" />
											<label for="txtCotizacionRefacciones_facturas_refacciones_refacciones">Cotización</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtCotizacionRefacciones_facturas_refacciones_refacciones" 
													name="strCotizacionRefacciones_facturas_refacciones_refacciones" 
													type="text" value="" tabindex="1" 
													placeholder="Ingrese cotización" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los pedidos activos-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtPedidoRefacciones_facturas_refacciones_refacciones">Pedido</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtPedidoRefacciones_facturas_refacciones_refacciones" 
													name="strPedidoRefacciones_facturas_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese pedido" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las remisiones activas-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRemisionRefacciones_facturas_refacciones_refacciones">Remisión</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRemisionRefacciones_facturas_refacciones_refacciones" 
													name="strRemisionRefacciones_facturas_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese remisión" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Tipo-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbTipo_facturas_refacciones_refacciones">Tipo</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbTipo_facturas_refacciones_refacciones" 
											 		name="strTipo_facturas_refacciones_refacciones" tabindex="1">
											    <option value="">Seleccione una opción</option>
											    <option value="MOSTRADOR">MOSTRADOR</option>
	                      						<option value="REFACCIONARIO">REFACCIONARIO</option>
	                      						<option value="CAMPO">CAMPO</option>
			                 				</select>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las estrategias activas-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la estrategia seleccionada-->
											<input id="txtEstrategiaID_facturas_refacciones_refacciones" 
												   name="intEstrategiaID_facturas_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<label for="txtEstrategia_facturas_refacciones_refacciones">
												Estrategia
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtEstrategia_facturas_refacciones_refacciones" 
													name="strEstrategia_facturas_refacciones_refacciones" type="text" value="" tabindex="1"  placeholder="Ingrese estrategia" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene los vendedores activos-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del vendedor seleccionado-->
											<input id="txtVendedorID_facturas_refacciones_refacciones" 
												   name="intVendedorID_facturas_refacciones_refacciones"  type="hidden" 
												   value="">
											</input>
											<label for="txtVendedor_facturas_refacciones_refacciones">Vendedor</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtVendedor_facturas_refacciones_refacciones" 
													name="strVendedor_facturas_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese vendedor" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Condiciones de pago-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbCondicionesPago_facturas_refacciones_refacciones">Tipo de venta</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbCondicionesPago_facturas_refacciones_refacciones" 
											 		name="strCondicionesPago_facturas_refacciones_refacciones" tabindex="1">
											    <option value="">Seleccione una opción</option>
											    <option value="CREDITO">CREDITO</option>
			                      				<option value="CONTADO">CONTADO</option>
			                 				</select>
										</div>
									</div>
								</div>
								<!--Gastos de paqueteria-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<!--Gastos de paquetería-->
		                  			<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el IVA desglosado con base al importe capturado-->
											<input id="txtGastosPaqueteriaSubtotal_facturas_refacciones_refacciones" 
												   name="intGastosPaqueteriaSubtotal_facturas_refacciones_refacciones" 
												   type="hidden" value="" />
										    <!-- Caja de texto oculta para recuperar el IVA desglosado con base al importe capturado-->
											<input id="txtGastosPaqueteriaIva_facturas_refacciones_refacciones" 
												   name="intGastosPaqueteriaIva_facturas_refacciones_refacciones" 
												   type="hidden" value="" />	   
											<label for="txtGastosPaqueteria_facturas_refacciones_refacciones">Gastos de paquetería</label>
										</div>
										<div class="col-md-12">
											<div class='input-group'>
												<span class="input-group-addon">$</span>
												<input  class="form-control cantidad_facturas_refacciones_refacciones" 
														id="txtGastosPaqueteria_facturas_refacciones_refacciones" 
														name="intGastosPaqueteria_facturas_refacciones_refacciones" 
														type="text"  tabindex="1" placeholder="Ingrese importe" maxlength="12" />	
											</div>
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
											<input id="txtProspectoID_facturas_refacciones_refacciones" 
												   name="intProspectoID_facturas_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el id del régimen fiscal del cliente seleccionado-->
											<input id="txtRegimenFiscalID_facturas_refacciones_refacciones" 
												   name="intRegimenFiscalID_facturas_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la lista de precios correspondiente al cliente seleccionado-->
											<input id="txtRefaccionesListaPrecioID_facturas_refacciones_refacciones" 
												   name="intRefaccionesListaPrecioID_facturas_refacciones_refacciones"  type="hidden" 
												   value="">
											</input>
											<!-- Caja de texto oculta para recuperar la calle del cliente seleccionado-->
											<input id="txtCalle_facturas_refacciones_refacciones" 
												   name="strCalle_facturas_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el número exterior del cliente seleccionado-->
											<input id="txtNumeroExterior_facturas_refacciones_refacciones" 
												   name="strNumeroExterior_facturas_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el número interior del cliente seleccionado-->
											<input id="txtNumeroInterior_facturas_refacciones_refacciones" 
												   name="strNumeroInterior_facturas_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el código postal del cliente seleccionado-->
											<input id="txtCodigoPostal_facturas_refacciones_refacciones" 
												   name="strCodigoPostal_facturas_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar la colonia del cliente seleccionado-->
											<input id="txtColonia_facturas_refacciones_refacciones" 
												   name="strColonia_facturas_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar la localidad del cliente seleccionado-->
											<input id="txtLocalidad_facturas_refacciones_refacciones" 
												   name="strLocalidad_facturas_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el municipio del cliente seleccionado-->
											<input id="txtMunicipio_facturas_refacciones_refacciones" 
												   name="strMunicipio_facturas_refacciones_refacciones" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar el estado del cliente seleccionado-->
											<input id="txtEstado_facturas_refacciones_refacciones" 
												   name="strEstado_facturas_refacciones_refacciones" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el país del cliente seleccionado-->
											<input id="txtPais_facturas_refacciones_refacciones" 
												   name="strPais_facturas_refacciones_refacciones" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar los días de crédito del cliente seleccionado-->
											<input id="txtRefaccionesCreditoDias_facturas_refacciones_refacciones" 
												   name="intRefaccionesCreditoDias_facturas_refacciones_refacciones" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para asignar la fecha de vencimiento-->
											<input id="txtFechaVencimiento_facturas_refacciones_refacciones" 
												   name="strFechaVencimiento_facturas_refacciones_refacciones" 
												   type="hidden" value="" />
											<label for="txtRazonSocial_facturas_refacciones_refacciones">
												Razón social
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRazonSocial_facturas_refacciones_refacciones" 
													name="strRazonSocial_facturas_refacciones_refacciones" type="text" value=""   
													tabindex="1" placeholder="Ingrese razón social" maxlength="250" />
										</div>
									</div>
								</div>
								<!--RFC-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRfc_facturas_refacciones_refacciones">RFC</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRfc_facturas_refacciones_refacciones"
												   name="strRfc_facturas_refacciones_refacciones" 
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
											<input id="txtFormaPagoID_facturas_refacciones_refacciones" 
												   name="intFormaPagoID_facturas_refacciones_refacciones" 
												   type="hidden" value="" />
											<label for="txtFormaPago_facturas_refacciones_refacciones">
												Forma de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFormaPago_facturas_refacciones_refacciones" 
													name="strFormaPago_facturas_refacciones_refacciones" type="text" value=""  
													tabindex="1" placeholder="Ingrese forma de pago" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los métodos de pago activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del método de pago seleccionado-->
											<input id="txtMetodoPagoID_facturas_refacciones_refacciones" 
												   name="intMetodoPagoID_facturas_refacciones_refacciones" 
												   type="hidden" value="" />
											<label for="txtMetodoPago_facturas_refacciones_refacciones">
												Método de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMetodoPago_facturas_refacciones_refacciones" 
													name="strMetodoPago_facturas_refacciones_refacciones" type="text" value=""  
													tabindex="1" placeholder="Ingrese método de pago" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Combobox que contiene la exportación activa-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbExportacionID_facturas_refacciones_refacciones">Exportación</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbExportacionID_facturas_refacciones_refacciones"
											        name="intExportacionID_facturas_refacciones_refacciones" tabindex="1">
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
											<input id="txtUsoCfdiID_facturas_refacciones_refacciones" 
												   name="intUsoCfdiID_facturas_refacciones_refacciones" 
												   type="hidden" value="" />
											<label for="txtUsoCfdi_facturas_refacciones_refacciones">
												Uso del CFDI
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtUsoCfdi_facturas_refacciones_refacciones" 
													name="strUsoCfdi_facturas_refacciones_refacciones" type="text" value=""  
													tabindex="1" placeholder="Ingrese uso del CFDI" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los tipos de relación activos-->
								<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del tipo de relación seleccionado-->
											<input id="txtTipoRelacionID_facturas_refacciones_refacciones" 
												   name="intTipoRelacionID_facturas_refacciones_refacciones" 
												   type="hidden" value="" />
											<label for="txtTipoRelacion_facturas_refacciones_refacciones">
												Tipo de relación
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTipoRelacion_facturas_refacciones_refacciones" 
													name="strTipoRelacion_facturas_refacciones_refacciones" type="text" value=""  
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
											<label for="txtObservaciones_facturas_refacciones_refacciones">Observaciones</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtObservaciones_facturas_refacciones_refacciones" 
													name="strObservaciones_facturas_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Notas-->
								<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNotas_facturas_refacciones_refacciones">Notas</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNotas_facturas_refacciones_refacciones" 
													name="strNotas_facturas_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese notas" maxlength="250">
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
											<input id="txtNumDetalles_facturas_refacciones_refacciones" 
												   name="intNumDetalles_facturas_refacciones_refacciones" type="hidden" value="">
											</input>
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">Detalles de la factura</h4>
												</div>
												<div class="panel-body">
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!--Autocomplete que contiene las refacciones y kits de refacciones activas-->
															<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<!-- Caja de texto oculta para recuperar el id de la referencia seleccionada-->
																		<input id="txtReferenciaID_detalles_facturas_refacciones_refacciones" 
																			   name="intReferenciaID_detalles_facturas_refacciones_refacciones" 
																			   type="hidden" value="" />
																		<!-- Caja de texto oculta para recuperar el id del tipo de referencia seleccionada-->
																		<input id="txtTipoReferencia_detalles_facturas_refacciones_refacciones" 
																			   name="strTipoReferencia_detalles_facturas_refacciones_refacciones" 
																			   type="hidden" value="" />
																		<!-- Caja de texto oculta para recuperar el código de la refacción seleccionada-->
																		<input id="txtCodigo_detalles_facturas_refacciones_refacciones" 
																			   name="strCodigo_detalles_facturas_refacciones_refacciones" 
																			   type="hidden" value="" />
																		<!-- Caja de texto oculta para recuperar el código de línea de la refacción seleccionada-->
																		<input id="txtCodigoLinea_detalles_facturas_refacciones_refacciones" 
																			   name="strCodigoLinea_detalles_facturas_refacciones_refacciones" 
																			   type="hidden" value="" />	   
																		<!-- Caja de texto oculta para recuperar la descripción de la refacción seleccionada-->
																		<input id="txtDescripcion_detalles_facturas_refacciones_refacciones" 
																			   name="strDescripcion_detalles_facturas_refacciones_refacciones" 
																			   type="hidden" value="" />
																		<!-- Caja de texto oculta que se utiliza para recuperar el código SAT de la refacción seleccionada-->
																		<input id="txtCodigoSat_detalles_facturas_refacciones_refacciones" 
																				name="strCodigoSat_detalles_facturas_refacciones_refacciones"  
																			    type="hidden" value="" />
																		<!-- Caja de texto oculta que se utiliza para recuperar la unidad SAT de la refacción seleccionada-->
																		<input id="txtUnidadSat_detalles_facturas_refacciones_refacciones" 
																			   name="strUnidadSat_detalles_facturas_refacciones_refacciones"  
																			   type="hidden" value="" />
																		<!-- Caja de texto oculta que se utiliza para recuperar el objeto de impuesto SAT de la refacción seleccionada-->
																		<input id="txtObjetoImpuestoSat_detalles_facturas_refacciones_refacciones" 
																			   name="strObjetoImpuestoSat_detalles_facturas_refacciones_refacciones"  
																			   type="hidden" value="" />
																		<!-- Caja de texto oculta que se utiliza para recuperar el precio de la refacción seleccionada-->
																		<input id="txtPrecioRefaccion_detalles_facturas_refacciones_refacciones" 
																			   name="intPrecioRefaccion_detalles_facturas_refacciones_refacciones"  
																			   type="hidden" value="" />
																	    <!-- Caja de texto oculta que se utiliza para recuperar el tipo de cambio de la refacción seleccionada-->
																		<input id="txtTipoCambio_detalles_facturas_refacciones_refacciones" 
																			   name="intTipoCambio_detalles_facturas_refacciones_refacciones"  
																			   type="hidden" value="" />
																	    <!-- Caja de texto oculta para recuperar la existencia disponible  de la refacción (en el inventario)  seleccionada-->
		                                                                <input id="txtDisponibleExistencia_detalles_facturas_refacciones_refacciones" 
		                                                                       name="intDisponibleExistencia_detalles_facturas_refacciones_refacciones" 
		                                                                       type="hidden" value="" />
		                                                                 <!-- Caja de texto oculta para recuperar el costo actual de la refacción (en el inventario)  seleccionada-->
																		<input id="txtActualCosto_detalles_facturas_refacciones_refacciones" 
																			   name="intActualCosto_detalles_facturas_refacciones_refacciones" 
																			   type="hidden" value="" />
																		<label for="txtReferencia_detalles_facturas_refacciones_refacciones">
																			Refacción
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtReferencia_detalles_facturas_refacciones_refacciones" 
																				name="strReferencia_detalles_facturas_refacciones_refacciones" type="text" value="" 
																				tabindex="1" placeholder="Ingrese refacción" maxlength="250" disabled="disabled" />
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<!--Cantidad-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtCantidad_detalles_facturas_refacciones_refacciones">
																			Cantidad
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control cantidad_facturas_refacciones_refacciones" 
																				id="txtCantidad_detalles_facturas_refacciones_refacciones" 
																				name="intCantidad_detalles_facturas_refacciones_refacciones" 
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
																		<label for="txtPrecioUnitario_detalles_facturas_refacciones_refacciones">Precio unitario</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control moneda_facturas_refacciones_refacciones" 
																				id="txtPrecioUnitario_detalles_facturas_refacciones_refacciones" 
																				name="intPrecioUnitario_detalles_facturas_refacciones_refacciones" 
																				type="text" value=""  tabindex="1" placeholder="" 
																				maxlength="15"/>
																	</div>
																</div>
															</div>
															<!--Porcentaje del descuento-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones">Descuento %</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control cantidad_facturas_refacciones_refacciones" id="txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones" 
																				name="intPorcentajeDescuento_detalles_facturas_refacciones_refacciones" type="text" value="" 
																				tabindex="1" placeholder="Ingrese descuento" maxlength="8" />
																	</div>
																</div>
															</div>
															<!--Porcentaje del IVA-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<input id="txtTasaCuotaIva_detalles_facturas_refacciones_refacciones" name="intTasaCuotaIva_detalles_facturas_refacciones_refacciones" type="hidden" value="">
																		</input>
																		<label for="txtPorcentajeIva_detalles_facturas_refacciones_refacciones">IVA %</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtPorcentajeIva_detalles_facturas_refacciones_refacciones" 
																				name="intPorcentajeIva_detalles_facturas_refacciones_refacciones" type="text" value="" 
																				tabindex="1"  maxlength="8">
																		</input>
																	</div>
																</div>
															</div>
															<!--Porcentaje del IEPS-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
																<div class="form-group">
																	<div class="col-md-12">
																		<input id="txtTasaCuotaIeps_detalles_facturas_refacciones_refacciones" name="intTasaCuotaIeps_detalles_facturas_refacciones_refacciones" type="hidden" value="">
																		</input>
																		<label for="txtPorcentajeIeps_detalles_facturas_refacciones_refacciones">IEPS %</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtPorcentajeIeps_detalles_facturas_refacciones_refacciones" 
																				name="intPorcentajeIeps_detalles_facturas_refacciones_refacciones" type="text" value="" 
																				tabindex="1" maxlength="8">
																		</input>
																	</div>
																</div>
															</div>
															<!--Botón agregar-->
							                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
							                                	<button class="btn btn-primary btn-toolBtns pull-right" 
							                                			id="btnAgregar_facturas_refacciones_refacciones"
							                                			onclick="agregar_renglon_detalles_facturas_refacciones_refacciones();" 
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
															<table class="table-hover movil" id="dg_detalles_facturas_refacciones_refacciones">
																<thead class="movil">
																	<tr class="movil">
																		<th class="movil">Código</th>
																		<th class="movil">Descripción</th>
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
																		<td  class="movil t2"></td>
																		<td  class="movil t3">
																			<strong id="acumCantidad_detalles_facturas_refacciones_refacciones">0.00</strong>
																		</td>
																		<td class="movil t4"></td>
																		<td class="movil t5">
																			<strong id="acumDescuento_detalles_facturas_refacciones_refacciones">$0.00</strong>
																		</td>
																		<td class="movil t6">
																			<strong id="acumSubtotal_detalles_facturas_refacciones_refacciones">$0.00</strong>
																		</td>
																		<td class="movil t7">
																			<strong id="acumIva_detalles_facturas_refacciones_refacciones">$0.00</strong>
																		</td>
																		<td class="movil t8">
																			<strong  id="acumIeps_detalles_facturas_refacciones_refacciones">$0.00</strong>
																		</td>
																		<td class="movil t9">
																			<strong id="acumTotal_detalles_facturas_refacciones_refacciones">$0.00</strong>
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
																		<strong id="numElementos_detalles_facturas_refacciones_refacciones">0</strong> encontrados
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
						<div id="cfdi_relacionados_facturas_refacciones_refacciones" class="tab-pane fade">
							<div class="row">
								<!--Botones-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="btn-group pull-right">
										<!--Buscar CFDI a relacionar para agregarlos en la tabla-->
										<button class="btn btn-primary" 
		                                			id="btnBuscarCFDI_facturas_refacciones_refacciones" 
		                                			onclick="abrir_relacionar_cfdi_facturas_refacciones_refacciones();" 
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
									<input id="txtNumCfdiRelacionados_facturas_refacciones_refacciones" 
										   name="intNumCfdiRelacionados_facturas_refacciones_refacciones" type="hidden" value="">
									</input>
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_cfdi_relacionados_facturas_refacciones_refacciones">
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
												<strong id="numElementos_cfdi_relacionados_facturas_refacciones_refacciones">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - CFDI relacionados-->
					  </div><!--Cierre del tab-content-->
	              		<!--Circulo de progreso-->
						<div id="divCirculoBarProgreso_facturas_refacciones_refacciones" class="load-container load5 circulo_bar no-mostrar">
							<div class="loader">Loading...</div>
							<br><br>
							<div align=center><b>Espere un momento por favor.</b></div>
						</div> 
              			<!--Botones de acción (barra de tareas)-->
						<div class="btn-group row footerModal">
							<div class="col-md-12">
								<!--Nuevo registro-->
								<button class="btn btn-info" id="btnReiniciar_facturas_refacciones_refacciones"  
										onclick="nuevo_facturas_refacciones_refacciones('Nuevo');"  title="Nuevo registro" tabindex="2">
									<span class="glyphicon glyphicon-list-alt"></span>
								</button>
								<!--Guardar registro-->
								<button class="btn btn-success" id="btnGuardar_facturas_refacciones_refacciones"  
										onclick="validar_facturas_refacciones_refacciones();"  title="Guardar" tabindex="3" disabled>
									<span class="fa fa-floppy-o"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default" id="btnEnviarCorreo_facturas_refacciones_refacciones"  
										onclick="abrir_cliente_facturas_refacciones_refacciones('');"  
										title="Enviar correo electrónico" tabindex="4" disabled>
									<span class="glyphicon glyphicon-envelope"></span>
								</button> 
								<!--Ver motivo de cancelación del registro-->
								<button class="btn btn-default" id="btnVerMotivoCancelacion_facturas_refacciones_refacciones"  
										onclick="ver_cancelacion_facturas_refacciones_refacciones('');"  title="Ver motivo de cancelación" tabindex="5">
									<i class="fa fa-info-circle" aria-hidden="true"></i>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default" id="btnImprimirRegistro_facturas_refacciones_refacciones"  
										onclick="reporte_registro_facturas_refacciones_refacciones('');"  title="Imprimir registro en PDF" tabindex="6" disabled>
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Descargar archivos-->
			                    <button class="btn btn-default" id="btnDescargarArchivo_facturas_refacciones_refacciones"  
										onclick="descargar_archivos_facturas_refacciones_refacciones('', '');"  title="Descargar archivos" tabindex="7" disabled>
									<span class="glyphicon glyphicon-download-alt"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default" id="btnDesactivar_facturas_refacciones_refacciones"  
										onclick="cambiar_estatus_facturas_refacciones_refacciones('', '', '', '', '', '');"  title="Cancelar" tabindex="8" disabled>
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Cerrar modal-->
								<button class="btn  btn-cerrar"  id="btnCerrar_facturas_refacciones_refacciones"
										type="reset" aria-hidden="true" onclick="cerrar_facturas_refacciones_refacciones();" 
										title="Cerrar"  tabindex="9">
									<span class="fa fa-times"></span>
								</button>
							</div>
						</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Facturas-->
	</div><!--#FacturasRefaccionesRefaccionesContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_facturas_refacciones_refacciones" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>

	<!-- /.Plantilla para cargar los motivo de cancelación en el combobox-->  
	<script id="cancelacion_motivos_facturas_refacciones_refacciones" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#motivos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/motivos}} 
	</script>

	<!-- /.Plantilla para cargar la exportación en el combobox-->  
	<script id="exportacion_facturas_refacciones_refacciones" type="text/template">
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
		var intPaginaFacturasRefaccionesRefacciones = 0;
		var strUltimaBusquedaFacturasRefaccionesRefacciones = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar en el timbrado y cfdi's relacionados)*/
		var strTipoReferenciaFacturasRefaccionesRefacciones = "FACTURA REFACCIONES";
		//Variable que se utiliza para asignar el id del módulo de refacciones
		var intModuloIDFacturasRefaccionesRefacciones = <?php echo MODULO_REFACCIONES ?>;
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDFacturasRefaccionesRefacciones = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el id de la exportación base
		var intExportacionBaseIDFacturasRefaccionesRefacciones = <?php echo EXPORTACION_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseFacturasRefaccionesRefacciones = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoFacturasRefaccionesRefacciones = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar el valor del impuesto IVA
		var intIvaFacturasRefaccionesRefacciones = <?php echo IVA ?>;
		//Variable que se utiliza para asignar el valor del porcentaje de IVA
		var intPorcentajeIvaFacturasRefaccionesRefacciones = <?php echo PORCENTAJE_IVA ?>;
		//Variable que se utiliza para asignar el id de la sucursal: EXPO CNH
		var intSucursalIDEXPOCNHFacturasRefaccionesRefacciones = <?php echo SUCURSAL_EXPOCNH ?>;
		//Variable que se utiliza para asignar el id de la sucursal: EXPO AGROCISA
		var intSucursalIDEXPOAgrocisaFacturasRefaccionesRefacciones = <?php echo SUCURSAL_EXPOAGROCISA ?>;
		//Variable que se utiliza para asignar el id de la sucursal que se encuentra seleccionada
		var intSucursalIDLogeadaFacturasRefaccionesRefacciones = <?php echo $this->session->userdata('sucursal_id') ?>;
		//Variable que se utiliza para asignar el id del motivo de cancelación: Comprobante emitido con errores con relación.
		var intCancelacionIDRelacionCfdiFacturasRefaccionesRefacciones = <?php echo MOTIVO_CANCELACION_RELACIONCFDI ?>;
		//Variable que se utiliza para asignar el mensaje de régimen fiscal faltante.
		var strMsjRegimenFiscalCteFacturasRefaccionesRefacciones = "<?php echo MSJ_ERROR_REGIMEN_FISCAL ?>";

		//Variable que se utiliza para asignar objeto del modal Cancelación del timbrado
		var objCancelacionFacturasRefaccionesRefacciones = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarFacturasRefaccionesRefacciones = null;
		//Variable que se utiliza para asignar objeto del modal Facturas
		var objFacturasRefaccionesRefacciones = null;
		//Array que contiene los id´s de las cajas de texto que se utilizan para calcular la fecha de vencimiento
		var arrFechaVencimientoFacturasRefaccionesRefacciones  = {fecha: '#txtFecha_facturas_refacciones_refacciones',
																 condicionesPago:  '#cmbCondicionesPago_facturas_refacciones_refacciones',
																 diasCredito: 	'#txtRefaccionesCreditoDias_facturas_refacciones_refacciones',
																 fechaVencimiento: 	'#txtFechaVencimiento_facturas_refacciones_refacciones'
																};

	    //Array que contiene los id´s de las cajas de texto que se utilizan para desglosar el IVA del gasto de paquetería
		var arrDesglosarIvaGastoFacturasRefaccionesRefacciones  = {gasto: '#txtGastosPaqueteria_facturas_refacciones_refacciones',
															 porcentajeIva: intPorcentajeIvaFacturasRefaccionesRefacciones,
															 iva: intIvaFacturasRefaccionesRefacciones,
															 gastoSubtotal: '#txtGastosPaqueteriaSubtotal_facturas_refacciones_refacciones',
															 gastoIva: '#txtGastosPaqueteriaIva_facturas_refacciones_refacciones'
															};


		/*******************************************************************************************************************
		Funciones del objeto CFDI's  relacionados (facturas seleccionadas)
		*********************************************************************************************************************/
		// Constructor del objeto CFDI's relacionados (facturas seleccionadas)
		var objCfdisRelacionadosFacturasRefaccionesRefacciones;
		function CfdisRelacionadosFacturasRefaccionesRefacciones(cfdis)
		{
			this.arrCfdis = cfdis;
		}

		//Función para obtener todos los cfdi´s seleccionados
		CfdisRelacionadosFacturasRefaccionesRefacciones.prototype.getCfdis = function() {
		    return this.arrCfdis;
		}

		//Función para agregar un cfdi al objeto 
		CfdisRelacionadosFacturasRefaccionesRefacciones.prototype.setCfdi = function (cfdi){
			this.arrCfdis.push(cfdi);
		}

		//Función para obtener un cfdi del objeto 
		CfdisRelacionadosFacturasRefaccionesRefacciones.prototype.getCfdi = function(index) {
		    return this.arrCfdis[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto CFDI a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto CFDI a relacionar
		var objCfdiRelacionarFacturasRefaccionesRefacciones;
		
		function CfdiRelacionarFacturasRefaccionesRefacciones(referenciaID, cliente, folio, fecha, tipoReferencia, uuid, importe)
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
		function permisos_facturas_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/facturas_refacciones/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_facturas_refacciones_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosFacturasRefaccionesRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosFacturasRefaccionesRefacciones = strPermisosFacturasRefaccionesRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosFacturasRefaccionesRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosFacturasRefaccionesRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_facturas_refacciones_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosFacturasRefaccionesRefacciones[i]=='GUARDAR') || (arrPermisosFacturasRefaccionesRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_facturas_refacciones_refacciones').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosFacturasRefaccionesRefacciones[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_facturas_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosFacturasRefaccionesRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_facturas_refacciones_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_facturas_refacciones_refacciones();
						}
						else if(arrPermisosFacturasRefaccionesRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_facturas_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosFacturasRefaccionesRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_facturas_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosFacturasRefaccionesRefacciones[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_facturas_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosFacturasRefaccionesRefacciones[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_facturas_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosFacturasRefaccionesRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_facturas_refacciones_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_facturas_refacciones_refacciones() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaFacturasRefaccionesRefacciones =($('#txtFechaInicialBusq_facturas_refacciones_refacciones').val()+$('#txtFechaFinalBusq_facturas_refacciones_refacciones').val()+$('#txtProspectoIDBusq_facturas_refacciones_refacciones').val()+$('#cmbEstatusBusq_facturas_refacciones_refacciones').val()+$('#txtBusqueda_facturas_refacciones_refacciones').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaFacturasRefaccionesRefacciones != strUltimaBusquedaFacturasRefaccionesRefacciones)
			{
				intPaginaFacturasRefaccionesRefacciones = 0;
				strUltimaBusquedaFacturasRefaccionesRefacciones = strNuevaBusquedaFacturasRefaccionesRefacciones;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/facturas_refacciones/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_facturas_refacciones_refacciones').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_facturas_refacciones_refacciones').val()),
					 intProspectoID: $('#txtProspectoIDBusq_facturas_refacciones_refacciones').val(),
					 strEstatus: $('#cmbEstatusBusq_facturas_refacciones_refacciones').val(),
					 strBusqueda: $('#txtBusqueda_facturas_refacciones_refacciones').val(),
					 intPagina: intPaginaFacturasRefaccionesRefacciones,
					 strPermisosAcceso: $('#txtAcciones_facturas_refacciones_refacciones').val()
					},
					function(data){
						$('#dg_facturas_refacciones_refacciones tbody').empty();
						var tmpFacturasRefaccionesRefacciones = Mustache.render($('#plantilla_facturas_refacciones_refacciones').html(),data);
						$('#dg_facturas_refacciones_refacciones tbody').html(tmpFacturasRefaccionesRefacciones);
						$('#pagLinks_facturas_refacciones_refacciones').html(data.paginacion);
						$('#numElementos_facturas_refacciones_refacciones').html(data.total_rows);
						intPaginaFacturasRefaccionesRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_facturas_refacciones_refacciones(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/facturas_refacciones/';

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
			if ($('#chbImprimirDetalles_facturas_refacciones_refacciones').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_facturas_refacciones_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_facturas_refacciones_refacciones').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_facturas_refacciones_refacciones').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_facturas_refacciones_refacciones').val()),
										'intProspectoID': $('#txtProspectoIDBusq_facturas_refacciones_refacciones').val(),
										'strEstatus': $('#cmbEstatusBusq_facturas_refacciones_refacciones').val(), 
										'strBusqueda': $('#txtBusqueda_facturas_refacciones_refacciones').val(),
										'strDetalles': $('#chbImprimirDetalles_facturas_refacciones_refacciones').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_facturas_refacciones_refacciones(id) 
		{
			
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url':  'contabilidad/timbradoV4/get_pdf_facturas',
							'data' : {
										'intReferenciaID':intID,
										'strTipoReferencia':strTipoReferenciaFacturasRefaccionesRefacciones,
										'strTimbrar': 'NO'		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);	

		}
		

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_facturas_refacciones_refacciones(facturaRefaccionID, folio)
		{
			
			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;
			var strFolio = '';

			//Si no existe id, significa que se descargara el archivo desde el modal
			if(facturaRefaccionID == '')
			{
				intID = $('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val();
				strFolio = $('#txtFolio_facturas_refacciones_refacciones').val();
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
										'strTipoReferencia': strTipoReferenciaFacturasRefaccionesRefacciones,
										'strFolio':strFolio		
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_facturas_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_facturas_refacciones_refacciones').empty();
					var temp = Mustache.render($('#monedas_facturas_refacciones_refacciones').html(), data);
					$('#cmbMonedaID_facturas_refacciones_refacciones').html(temp);
				},
				'json');
		}



		//Regresar exportación activa para cargarlas en el combobox
		function cargar_exportacion_facturas_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar la exportación que se encuentra activa
			$.post('contabilidad/sat_exportacion/get_combo_box', {},
				function(data)
				{
					$('#cmbExportacionID_facturas_refacciones_refacciones').empty();
					var temp = Mustache.render($('#exportacion_facturas_refacciones_refacciones').html(), data);
					$('#cmbExportacionID_facturas_refacciones_refacciones').html(temp);
				},
				'json');
		}


		/*******************************************************************************************************************
		Funciones del modal Cancelación del timbrado
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cancelacion_facturas_refacciones_refacciones()
		{
			//Incializar formulario
			$('#frmCancelacionFacturasRefaccionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_facturas_refacciones_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmCancelacionFacturasRefaccionesRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cancelacion_facturas_refacciones_refacciones');
			//Habilitar todos los elementos del formulario
			$('#frmCancelacionFacturasRefaccionesRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_cancelacion_facturas_refacciones_refacciones').attr('disabled','disabled');
			//Mostrar botón de Guardar
		    $("#btnGuardar_cancelacion_facturas_refacciones_refacciones").show();
		    //Agregar clase para ocultar div que contiene los datos de creación del registro
			$("#divDatosCreacion_cancelacion_facturas_refacciones_refacciones").addClass('no-mostrar');
		}

		//Función que se utiliza para abrir el modal
		function abrir_cancelacion_facturas_refacciones_refacciones(id, folio, polizaID, tipoReferencia, referenciaID)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cancelacion_facturas_refacciones_refacciones();

			//Asignar datos del registro seleccionado
			$('#txtReferenciaCfdiID_cancelacion_facturas_refacciones_refacciones').val(id);
			$('#txtFolio_cancelacion_facturas_refacciones_refacciones').val(folio);
			$('#txtPolizaID_cancelacion_facturas_refacciones_refacciones').val(polizaID);
			$('#txtReferenciaID_cancelacion_facturas_refacciones_refacciones').val(referenciaID);
			$('#txtTipoReferencia_cancelacion_facturas_refacciones_refacciones').val(tipoReferencia);
			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_cancelacion_facturas_refacciones_refacciones').addClass("estatus-ACTIVO");

		    //Abrir modal
			objCancelacionFacturasRefaccionesRefacciones = $('#CancelacionFacturasRefaccionesRefaccionesBox').bPopup({
												   appendTo: '#FacturasRefaccionesRefaccionesContent', 
						                           contentContainer: 'FacturasRefaccionesRefaccionesM', 
						                           zIndex: 2, 
						                           modalClose: false, 
						                           modal: true, 
						                           follow: [true,false], 
						                           followEasing : "linear", 
						                           easing: "linear", 
						                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#cmbCancelacionMotivoID_cancelacion_facturas_refacciones_refacciones').focus();
		}

		//Función para regresar los datos (al formulario) del registro seleccionados
		function ver_cancelacion_facturas_refacciones_refacciones(id)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCancelacionID_facturas_refacciones_refacciones').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/cancelaciones/get_datos',
	        {
	       		intCancelacionID:intID,
	       		strTipoReferencia:strTipoReferenciaFacturasRefaccionesRefacciones
	        },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			               //Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cancelacion_facturas_refacciones_refacciones();
							//Recuperar valores
							$('#cmbCancelacionMotivoID_cancelacion_facturas_refacciones_refacciones').val(data.row.cancelacion_motivo_id);
							$('#txtFolio_cancelacion_facturas_refacciones_refacciones').val(data.row.folio_referencia);
							$('#txtFolioSustitucion_cancelacion_facturas_refacciones_refacciones').val(data.row.folio_sustitucion);
							$('#txtUsuarioCreacion_cancelacion_facturas_refacciones_refacciones').val(data.row.usuario_creacion);
							$('#txtFechaCreacion_cancelacion_facturas_refacciones_refacciones').val(data.row.fecha_creacion);

							//Dependiendo del estatus cambiar el color del encabezado 
		   					$('#divEncabezadoModal_cancelacion_facturas_refacciones_refacciones').addClass("estatus-INACTIVO");

		   				    //Deshabilitar todos los elementos del formulario
				            $('#frmCancelacionFacturasRefaccionesRefacciones').find('input, textarea, select').attr('disabled','disabled');
		   					//Ocultar botón de Guardar
				            $("#btnGuardar_cancelacion_facturas_refacciones_refacciones").hide();
				            //Remover clase para mostrar div que contiene los datos de creación del registro
							$("#divDatosCreacion_cancelacion_facturas_refacciones_refacciones").removeClass('no-mostrar');

							//Abrir modal
							objCancelacionFacturasRefaccionesRefacciones = $('#CancelacionFacturasRefaccionesRefaccionesBox').bPopup({
												   appendTo: '#FacturasRefaccionesRefaccionesContent', 
						                           contentContainer: 'FacturasRefaccionesRefaccionesM', 
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
		function cerrar_cancelacion_facturas_refacciones_refacciones()
		{
			try {
				//Cerrar modal
				objCancelacionFacturasRefaccionesRefacciones.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cancelacion_facturas_refacciones_refacciones();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cancelacion_facturas_refacciones_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_facturas_refacciones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmCancelacionFacturasRefaccionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	intCancelacionMotivoID_facturas_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione un motivo'}
											}
										},
										strFolioSustitucion_cancelacion_facturas_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if(value == '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_facturas_refacciones_refacciones').val()) === intCancelacionIDRelacionCfdiFacturasRefaccionesRefacciones) 
					                                    	
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una factura existente'
					                                        };
					                                    }
					                                    else if(value !== '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_facturas_refacciones_refacciones').val()) !== intCancelacionIDRelacionCfdiFacturasRefaccionesRefacciones)
					                                    {

					                                    	//Hacer un llamado a la función para inicializar elementos de la sustitución
					                                    	inicializar_sustitucion_facturas_refacciones_refacciones();
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cancelacion_facturas_refacciones_refacciones = $('#frmCancelacionFacturasRefaccionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_cancelacion_facturas_refacciones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cancelacion_facturas_refacciones_refacciones.isValid())
			{
				//Hacer un llamado a la función para cancelar el timbrado de un registro
				cancelar_timbrado_facturas_refacciones_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cancelacion_facturas_refacciones_refacciones()
		{
			try
			{
				$('#frmCancelacionFacturasRefaccionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para inicializar elementos de la sustitución de CFDI
		function inicializar_sustitucion_facturas_refacciones_refacciones()
		{
			
			//Limpiar contenido de las siguientes cajas de texto
           $('#txtSustitucionID_cancelacion_facturas_refacciones_refacciones').val('');
           $('#txtUuidSustitucion_cancelacion_facturas_refacciones_refacciones').val('');
           $('#txtFolioSustitucion_cancelacion_facturas_refacciones_refacciones').val('');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function mostrar_circulo_carga_cancelacion_facturas_refacciones_refacciones()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_facturas_refacciones_refacciones").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function ocultar_circulo_carga_cancelacion_facturas_refacciones_refacciones()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_facturas_refacciones_refacciones").addClass('no-mostrar');
		}

		//Regresar motivos de cancelación activos para cargarlos en el combobox
		function cargar_motivos_cancelacion_facturas_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_cancelacion_motivos/get_combo_box', {},
				function(data)
				{
					$('#cmbCancelacionMotivoID_cancelacion_facturas_refacciones_refacciones').empty();
					var temp = Mustache.render($('#cancelacion_motivos_facturas_refacciones_refacciones').html(), data);
					$('#cmbCancelacionMotivoID_cancelacion_facturas_refacciones_refacciones').html(temp);
				},
				'json');
		}

		
		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cliente_facturas_refacciones_refacciones()
		{
			//Incializar formulario
			$('#frmEnviarFacturasRefaccionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_facturas_refacciones_refacciones();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cliente_facturas_refacciones_refacciones');
		}

		//Función que se utiliza para abrir el modal
		function abrir_cliente_facturas_refacciones_refacciones(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cliente_facturas_refacciones_refacciones();
			//Variables que se utilizan para asignar los datos del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/facturas_refacciones/get_datos',
	       {
	       		intFacturaRefaccionesID:intID
	       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtFacturaRefaccionesID_cliente_facturas_refacciones_refacciones').val(data.row.factura_refacciones_id);
							$('#txtFolio_cliente_facturas_refacciones_refacciones').val(data.row.folio);
							$('#txtRazonSocial_cliente_facturas_refacciones_refacciones').val(data.row.razon_social);
							$('#txtCorreoElectronico_cliente_facturas_refacciones_refacciones').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_cliente_facturas_refacciones_refacciones').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_cliente_facturas_refacciones_refacciones').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarFacturasRefaccionesRefacciones = $('#EnviarFacturasRefaccionesRefaccionesBox').bPopup({
																   appendTo: '#FacturasRefaccionesRefaccionesContent', 
										                           contentContainer: 'FacturasRefaccionesRefaccionesM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_cliente_facturas_refacciones_refacciones').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cliente_facturas_refacciones_refacciones()
		{
			try {
				//Cerrar modal
				objEnviarFacturasRefaccionesRefacciones.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cliente_facturas_refacciones_refacciones();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cliente_facturas_refacciones_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_facturas_refacciones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarFacturasRefaccionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_cliente_facturas_refacciones_refacciones: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_cliente_facturas_refacciones_refacciones: {
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
			var bootstrapValidator_cliente_facturas_refacciones_refacciones = $('#frmEnviarFacturasRefaccionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_cliente_facturas_refacciones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cliente_facturas_refacciones_refacciones.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_cliente_facturas_refacciones_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cliente_facturas_refacciones_refacciones()
		{
			try
			{
				$('#frmEnviarFacturasRefaccionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al cliente
		function enviar_correo_cliente_facturas_refacciones_refacciones()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cliente_facturas_refacciones_refacciones();
			//Hacer un llamado al método del controlador para enviar correo electrónico al cliente
			$.post('contabilidad/timbradoV4/enviar_correo_electronico_cliente',
					{ 
						intReferenciaID: $('#txtFacturaRefaccionesID_cliente_facturas_refacciones_refacciones').val(),
						strTipoReferencia: strTipoReferenciaFacturasRefaccionesRefacciones,
						strFolio: $('#txtFolio_cliente_facturas_refacciones_refacciones').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_cliente_facturas_refacciones_refacciones').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_cliente_facturas_refacciones_refacciones').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cliente_facturas_refacciones_refacciones();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_cliente_facturas_refacciones_refacciones();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_facturas_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_cliente_facturas_refacciones_refacciones()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_facturas_refacciones_refacciones").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_cliente_facturas_refacciones_refacciones()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_facturas_refacciones_refacciones").addClass('no-mostrar');
		}


		
		
		/*******************************************************************************************************************
		Funciones del modal Relacionar CFDI
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_cfdi_facturas_refacciones_refacciones()
		{
			//Incializar formulario
			$('#frmRelacionarCfdiFacturasRefaccionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_facturas_refacciones_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarCfdiFacturasRefaccionesRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_cfdi_facturas_refacciones_refacciones');
			//Eliminar los datos de la tabla CFDI a relacionar
		    $('#dg_relacionar_cfdi_facturas_refacciones_refacciones tbody').empty();
		    $('#numElementos_relacionar_cfdi_facturas_refacciones_refacciones').html(0);
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_cfdi_facturas_refacciones_refacciones()
		{		
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_cfdi_facturas_refacciones_refacciones();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_facturas_refacciones_refacciones').val();
			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_cfdi_facturas_refacciones_refacciones').addClass("estatus-"+strEstatus);
			//Abrir modal
			objRelacionarCfdiFacturasRefaccionesRefacciones = $('#RelacionarCfdiFacturasRefaccionesRefaccionesBox').bPopup({
											  appendTo: '#FacturasRefaccionesRefaccionesContent', 
			                              	  contentContainer: 'FacturasRefaccionesRefaccionesM', 
			                              	  zIndex: 2, 
			                              	  modalClose: false, 
			                              	  modal: true, 
			                              	  follow: [true,false], 
			                              	  followEasing : "linear", 
			                              	  easing: "linear", 
			                             	  modalColor: ('#F0F0F0')});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_relacionar_cfdi_facturas_refacciones_refacciones').focus();
			//Hacer un llamado a la función  para cargar los CFDI en el grid
			lista_facturas_relacionar_cfdi_facturas_refacciones_refacciones();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_cfdi_facturas_refacciones_refacciones()
		{
			try {
				//Cerrar modal
				objRelacionarCfdiFacturasRefaccionesRefacciones.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_cfdi_facturas_refacciones_refacciones()
		{			
			//Hacer un llamado a la función para agregar las facturas (CFDI) seleccionadas al  objeto CFDI's  relacionados
			agregar_facturas_relacionar_cfdi_facturas_refacciones_refacciones();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_facturas_refacciones_refacciones();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarCfdiFacturasRefaccionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumCfdi_relacionar_cfdi_facturas_refacciones_refacciones: {
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
										strFechaInicialBusq_relacionar_cfdi_facturas_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaFinalBusq_relacionar_cfdi_facturas_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strRazonSocialBusq_relacionar_cfdi_facturas_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_relacionar_cfdi_facturas_refacciones_refacciones = $('#frmRelacionarCfdiFacturasRefaccionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_relacionar_cfdi_facturas_refacciones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_cfdi_facturas_refacciones_refacciones.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_cfdi_facturas_refacciones_refacciones();
				//Hacer un llamado a la función para agregar los CFDI en la tabla CFDI relacionados
		  		agregar_cfdi_relacionados_cliente_facturas_refacciones_refacciones('Nuevo', '');
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_cfdi_facturas_refacciones_refacciones()
		{
			try
			{
				$('#frmRelacionarCfdiFacturasRefaccionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar CFDI's
		*********************************************************************************************************************/
		//Función para la búsqueda de CFDI's 
		function lista_facturas_relacionar_cfdi_facturas_refacciones_refacciones() 
		{
			//Variables que se utilizan para asignar los criterios de búsqueda
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaInicialBusq =  $.formatFechaMysql($('#txtFechaInicialBusq_relacionar_cfdi_facturas_refacciones_refacciones').val());
			var dteFechaFinalBusq =  $.formatFechaMysql($('#txtFechaFinalBusq_relacionar_cfdi_facturas_refacciones_refacciones').val());
			var intProspectoIDBusq =  $('#txtProspectoIDBusq_relacionar_cfdi_facturas_refacciones_refacciones').val();

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
						$('#dg_relacionar_cfdi_facturas_refacciones_refacciones tbody').empty();
						var tmpRelacionarCfdiAnticiposCaja = Mustache.render($('#plantilla_relacionar_cfdi_facturas_refacciones_refacciones').html(),data);
						$('#numElementos_relacionar_cfdi_facturas_refacciones_refacciones').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_cfdi_facturas_refacciones_refacciones').html(data.rows.length);	
						}
						$('#dg_relacionar_cfdi_facturas_refacciones_refacciones tbody').html(tmpRelacionarCfdiAnticiposCaja);
						
					},
			'json');

			
		}

		//Función para agregar las facturas (CFDI) seleccionadas al objeto CFDI's  relacionados
		function agregar_facturas_relacionar_cfdi_facturas_refacciones_refacciones()
		{
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
             
            //Crear instancia del objeto CFDI relacionados (facturas seleccionadas)
			objCfdisRelacionadosFacturasRefaccionesRefacciones = new CfdisRelacionadosFacturasRefaccionesRefacciones([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_cfdi_facturas_refacciones_refacciones tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
                	//Crear instancia del objeto CFDI a relacionar
					objCfdiRelacionarFacturasRefaccionesRefacciones = new CfdiRelacionarFacturasRefaccionesRefacciones(null, '', '', '', '', '', '');

                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objCfdiRelacionarFacturasRefaccionesRefacciones.intReferenciaID = strValor;
							        break;
							    case 1:
							        objCfdiRelacionarFacturasRefaccionesRefacciones.strCliente = strValor;
							        break;
							    case 2:
							        objCfdiRelacionarFacturasRefaccionesRefacciones.strFolio = strValor;
							        break;
							    case 3:
							        objCfdiRelacionarFacturasRefaccionesRefacciones.dteFecha = strValor;
							        break;
							    case 4:
							        objCfdiRelacionarFacturasRefaccionesRefacciones.strTipoReferencia = strValor;
							        break;
							    case 5:
							       	objCfdiRelacionarFacturasRefaccionesRefacciones.strUuid = strValor;
							        break;
							    case 6:
							       	objCfdiRelacionarFacturasRefaccionesRefacciones.intImporte = strValor;
							       	break;
							}

					      	intCol++;
					    });

                	//Agregar datos del cfdi a relacionar
                	objCfdisRelacionadosFacturasRefaccionesRefacciones.setCfdi(objCfdiRelacionarFacturasRefaccionesRefacciones);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumCfdi_relacionar_cfdi_facturas_refacciones_refacciones').val(intContador);

		}


		/*******************************************************************************************************************
		Funciones del modal Facturas
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_facturas_refacciones_refacciones(tipoAccion)
		{
			//Incializar formulario
			$('#frmFacturasRefaccionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_facturas_refacciones_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmFacturasRefaccionesRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_facturas_refacciones_refacciones');
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_facturas_refacciones_refacciones();
			//Eliminar los datos de la tabla CFDI relacionados
		    $('#dg_cfdi_relacionados_facturas_refacciones_refacciones tbody').empty();
			$('#numElementos_cfdi_relacionados_facturas_refacciones_refacciones').html(0);
			
			//Si el tipo de acción corresponde a Nuevo
			if(tipoAccion == 'Nuevo')
			{
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_facturas_refacciones_refacciones').addClass("estatus-NUEVO");
			}
			//Habilitar todos los elementos del formulario
			$('#frmFacturasRefaccionesRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Seleccionar tab que contiene la información general
		  	$('a[href="#informacion_general_facturas_refacciones_refacciones"]').click();
			//Asignar la fecha actual
			$('#txtFecha_facturas_refacciones_refacciones').val(fechaActual());

			//Deshabilitar las siguientes cajas de texto			
			data  = {
						//Son los id de los input que quiero deshabilitar
						rows: [						
							'#txtFolio_facturas_refacciones_refacciones',
							'#txtRfc_facturas_refacciones_refacciones',							
							'#txtReferencia_detalles_facturas_refacciones_refacciones',
							'#txtCantidad_detalles_facturas_refacciones_refacciones',
							'#txtPrecioUnitario_detalles_facturas_refacciones_refacciones',
							'#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones',
							'#txtPorcentajeIva_detalles_facturas_refacciones_refacciones',
							'#txtPorcentajeIeps_detalles_facturas_refacciones_refacciones'
						],
						//Es asignar un attributo disbaled|checked
						attribute: 'disabled',
						//Bool es para deshabilitar
						bool: true
					};
			//La function para disable el input porque les estamos mando un true		
			$.habilitar_deshabilitar_campos(data);

			//Mostrar por Default 01- No aplica
			$('#cmbExportacionID_facturas_refacciones_refacciones').val(intExportacionBaseIDFacturasRefaccionesRefacciones);

		
			//Mostrar los siguientes botones
			$('#btnGuardar_facturas_refacciones_refacciones').show();
			$("#btnBuscarCFDI_facturas_refacciones_refacciones").show(); 
			$('#btnReiniciar_facturas_refacciones_refacciones').show();
			//Habilitar botón Agregar
			$('#btnAgregar_facturas_refacciones_refacciones').prop('disabled', false);
			//Ocultar los siguientes botones
			$('#btnEnviarCorreo_facturas_refacciones_refacciones').hide();
			$("#btnDescargarArchivo_facturas_refacciones_refacciones").hide();
			$('#btnImprimirRegistro_facturas_refacciones_refacciones').hide();
			$('#btnDesactivar_facturas_refacciones_refacciones').hide();
			$('#btnVerMotivoCancelacion_facturas_refacciones_refacciones').hide();

		}

		//Función para inicializar elementos del cliente
		function inicializar_cliente_facturas_refacciones_refacciones()
		{
		  //Limpiar contenido de las siguientes cajas de texto
           $('#txtRfc_facturas_refacciones_refacciones').val('');
           $('#txtRegimenFiscalID_facturas_refacciones_refacciones').val('');
           $('#txtCalle_facturas_refacciones_refacciones').val('');
           $('#txtNumeroExterior_facturas_refacciones_refacciones').val('');
           $('#txtNumeroInterior_facturas_refacciones_refacciones').val('');
           $('#txtCodigoPostal_facturas_refacciones_refacciones').val('');
           $('#txtColonia_facturas_refacciones_refacciones').val('');
           $('#txtLocalidad_facturas_refacciones_refacciones').val('');
           $('#txtMunicipio_facturas_refacciones_refacciones').val('');
           $('#txtEstado_facturas_refacciones_refacciones').val('');
           $('#txtPais_facturas_refacciones_refacciones').val('');
           $('#txtRefaccionesListaPrecioID_facturas_refacciones_refacciones').val('');
           $('#txtRefaccionesCreditoDias_facturas_refacciones_refacciones').val('');

           //Hacer un llamado a la función para inicializar elementos de las tablas detalles
		   inicializar_detalles_facturas_refacciones_refacciones();

           //Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
			habilitar_elementos_tipo_cambio_detalles_facturas_refacciones_refacciones('#txtProspectoID_facturas_refacciones_refacciones');

			
		}
		
		//Función para deshabilitar controles del formulario y así evitar modificar datos correspondientes a la referencia
		function deshabilitar_controles_facturas_refacciones_refacciones()
		{			
			//Deshabilitar los siguientes controles
			$('#cmbMonedaID_facturas_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtRazonSocial_facturas_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtVendedor_facturas_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtGastosPaqueteria_facturas_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtEstrategia_facturas_refacciones_refacciones').attr('disabled','disabled');
		    $('#cmbTipo_facturas_refacciones_refacciones').attr('disabled','disabled');
		    $('#cmbMonedaID_facturas_refacciones_refacciones').attr('disabled','disabled');
		    //Deshabilitar botón Agregar
		    $('#btnAgregar_facturas_refacciones_refacciones').prop('disabled', true); 
		    $('#txtReferencia_detalles_facturas_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtCantidad_detalles_facturas_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtPorcentajeIva_detalles_facturas_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtPorcentajeIeps_detalles_facturas_refacciones_refacciones').attr('disabled','disabled');
		}

		//Función para inicializar elementos de la referencia (cotización/pedido/remision)
		function inicializar_referencia_facturas_refacciones_refacciones(tipoReferencia)
		{			

			//Dependiendo del tipo de referencia limpiar el contenido de la caja de texto
			if(tipoReferencia == 'COTIZACION')
			{
				//Limpiar contenido de las cajas de texto
				$('#txtPedidoRefacciones_facturas_refacciones_refacciones').val('');
				$('#txtRemisionRefacciones_facturas_refacciones_refacciones').val('');
			}
			else if(tipoReferencia == 'PEDIDO')
			{
				//Limpiar contenido de las cajas de texto
				$('#txtCotizacionRefacciones_facturas_refacciones_refacciones').val('');
				$('#txtRemisionRefacciones_facturas_refacciones_refacciones').val('');
			}
			else if(tipoReferencia == 'REMISION')
			{
				//Limpiar contenido de las cajas de texto
				$('#txtPedidoRefacciones_facturas_refacciones_refacciones').val('');
				$('#txtCotizacionRefacciones_facturas_refacciones_refacciones').val('');
			}


			//Asignar la moneda peso mexicano
			$('#cmbMonedaID_facturas_refacciones_refacciones').val(intMonedaBaseIDFacturasRefaccionesRefacciones);
            //Asignar el tipo de cambio correspondiente a la moneda peso mexicano
			$('#txtTipoCambio_facturas_refacciones_refacciones').val(intTipoCambioMonedaBaseFacturasRefaccionesRefacciones);
		
		   
			//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
			$('#txtTipoCambio_facturas_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
			//Deshabilitar caja de texto
	   	    $('#txtTipoCambio_facturas_refacciones_refacciones').attr('disabled','disabled');

	   	    //Limpiar contenido de las siguientes cajas de texto
	   	    $('#txtReferenciaID_facturas_refacciones_refacciones').val('');
	        $('#txtTipoReferencia_facturas_refacciones_refacciones').val('');
            $('#txtProspectoID_facturas_refacciones_refacciones').val('');
            $('#txtRazonSocial_facturas_refacciones_refacciones').val('');
            $('#txtRfc_facturas_refacciones_refacciones').val('');
            $('#txtRegimenFiscalID_facturas_refacciones_refacciones').val('');
            $('#txtCalle_facturas_refacciones_refacciones').val('');
            $('#txtNumeroExterior_facturas_refacciones_refacciones').val('');
            $('#txtNumeroInterior_facturas_refacciones_refacciones').val('');
            $('#txtCodigoPostal_facturas_refacciones_refacciones').val('');
            $('#txtColonia_facturas_refacciones_refacciones').val('');
            $('#txtLocalidad_facturas_refacciones_refacciones').val('');
            $('#txtMunicipio_facturas_refacciones_refacciones').val('');
            $('#txtEstado_facturas_refacciones_refacciones').val('');
            $('#txtPais_facturas_refacciones_refacciones').val('');
            $('#txtRefaccionesListaPrecioID_facturas_refacciones_refacciones').val('');
            $('#txtRefaccionesCreditoDias_facturas_refacciones_refacciones').val('');
			$('#txtObservaciones_facturas_refacciones_refacciones').val('');
			$('#txtNotas_facturas_refacciones_refacciones').val('');
            $('#txtVendedorID_facturas_refacciones_refacciones').val('');
            $('#txtVendedor_facturas_refacciones_refacciones').val('');
            $('#txtEstrategiaID_facturas_refacciones_refacciones').val('');
            $('#txtEstrategia_facturas_refacciones_refacciones').val('');
            $('#cmbTipo_facturas_refacciones_refacciones').val('');
            $('#txtGastosPaqueteria_facturas_refacciones_refacciones').val('');
            $('#txtGastosPaqueteriaSubtotal_facturas_refacciones_refacciones').val('');
            $('#txtGastosPaqueteriaIva_facturas_refacciones_refacciones').val('');
           
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_facturas_refacciones_refacciones();

		    //Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
			habilitar_elementos_tipo_cambio_detalles_facturas_refacciones_refacciones('#txtProspectoID_facturas_refacciones_refacciones');
		  
		    //Habilitar botón Agregar
			$('#btnAgregar_facturas_refacciones_refacciones').prop('disabled', false);		    
            //Habilitar los siguientes controles
		    $('#cmbMonedaID_facturas_refacciones_refacciones').removeAttr('disabled');
		    $('#txtRazonSocial_facturas_refacciones_refacciones').removeAttr('disabled');
		    $('#txtVendedor_facturas_refacciones_refacciones').removeAttr('disabled');
		    $('#txtEstrategia_facturas_refacciones_refacciones').removeAttr('disabled');
		    $('#cmbTipo_facturas_refacciones_refacciones').removeAttr('disabled');
		    $('#txtGastosPaqueteria_facturas_refacciones_refacciones').removeAttr('disabled');
			
		}

		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_facturas_refacciones_refacciones()
		{

			//Hacer un llamado a la función para inicializar elementos de la refacción (detalle)
		    inicializar_detalle_facturas_refacciones_refacciones();
		    
			//Eliminar los datos de la tabla detalles del pedido
		    $('#dg_detalles_facturas_refacciones_refacciones tbody').empty();
		    $('#acumCantidad_detalles_facturas_refacciones_refacciones').html('');
		    $('#acumDescuento_detalles_facturas_refacciones_refacciones').html('');
		    $('#acumSubtotal_detalles_facturas_refacciones_refacciones').html('');
		    $('#acumIva_detalles_facturas_refacciones_refacciones').html('');
		    $('#acumIeps_detalles_facturas_refacciones_refacciones').html('');
		    $('#acumTotal_detalles_facturas_refacciones_refacciones').html('');
			$('#numElementos_detalles_facturas_refacciones_refacciones').html(0);
			$('#txtNumDetalles_facturas_refacciones_refacciones').val('');
		}


		//Función que se utiliza para cerrar el modal
		function cerrar_facturas_refacciones_refacciones()
		{
			try {

				//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
				cerrar_cancelacion_facturas_refacciones_refacciones();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
				cerrar_cliente_facturas_refacciones_refacciones();
				//Hacer un llamado a la función para cerrar modal Relacionar CFDI
				cerrar_relacionar_cfdi_facturas_refacciones_refacciones();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_facturas_refacciones_refacciones('');
				//Cerrar modal
				objFacturasRefaccionesRefacciones.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_facturas_refacciones_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_facturas_refacciones_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_facturas_refacciones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmFacturasRefaccionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_facturas_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intMonedaID_facturas_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_facturas_refacciones_refacciones: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_facturas_refacciones_refacciones').val()) !== intMonedaBaseIDFacturasRefaccionesRefacciones)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoFacturasRefaccionesRefacciones)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoFacturasRefaccionesRefacciones
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strCotizacionRefacciones_facturas_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cotización
					                                    if(value !== '' && $('#txtReferenciaID_facturas_refacciones_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una cotización existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strPedidoRefacciones_facturas_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del pedido
					                                    if(value !== '' && $('#txtReferenciaID_facturas_refacciones_refacciones').val() === '')
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
										strRemisionRefacciones_facturas_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del remisión
					                                    if(value !== '' && $('#txtReferenciaID_facturas_refacciones_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una remisión existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strTipo_facturas_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										},
										strRazonSocial_facturas_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del cliente
					                                    if($('#txtProspectoID_facturas_refacciones_refacciones').val() === '')
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
										strVendedor_facturas_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vendedor
					                                    if($('#txtVendedorID_facturas_refacciones_refacciones').val() === '')
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
										strCondicionesPago_facturas_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una condición de pago'}
											}
										},
										strEstrategia_facturas_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la estrategia
					                                    if($('#txtEstrategiaID_facturas_refacciones_refacciones').val() === '')
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
										strFormaPago_facturas_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la forma de pago
					                                    if($('#txtFormaPagoID_facturas_refacciones_refacciones').val() === '')
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
										strMetodoPago_facturas_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del método de pago
					                                    if($('#txtMetodoPagoID_facturas_refacciones_refacciones').val() === '')
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
										intExportacionID_facturas_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una exportación'}
											}
										},
										strUsoCfdi_facturas_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del uso de CFDI
					                                    if($('#txtUsoCfdiID_facturas_refacciones_refacciones').val() === '')
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
										strTipoRelacion_facturas_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if((value !== '' && $('#txtTipoRelacionID_facturas_refacciones_refacciones').val() === '') 
					                                    	|| ($('#txtTipoRelacionID_facturas_refacciones_refacciones').val() === '' && parseInt($('#txtNumCfdiRelacionados_facturas_refacciones_refacciones').val()) > 0))
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
										intNumCfdiRelacionados_facturas_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan CFDI relacionados
					                                    if(parseInt($('#txtTipoRelacionID_facturas_refacciones_refacciones').val()) > 0 &&
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
										intNumDetalles_facturas_refacciones_refacciones: {
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
										strReferencia_detalles_facturas_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_detalles_facturas_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_detalles_facturas_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_detalles_facturas_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_detalles_facturas_refacciones_refacciones: {
											excluded: true  //Ignorar (no valida el campo)
										},
										intPorcentajeIeps_detalles_facturas_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_facturas_refacciones_refacciones = $('#frmFacturasRefaccionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_facturas_refacciones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_facturas_refacciones_refacciones.isValid())
			{
				//Hacer un llamado a la función para validar que los detalles cuenten con precio unitario y la cantidad no exceda la existencia disponible
				validar_detalles_facturas_refacciones_refacciones();	

			}
			else 
				return;
		}

		//Función que se utiliza para validar que los detalles cuenten con precio unitario y la cantidad no sea mayor que la existencia disponible
		function validar_detalles_facturas_refacciones_refacciones()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_facturas_refacciones_refacciones').getElementsByTagName('tbody')[0];

			//Array que se utiliza para agregar las refacciones incorrectas
			var arrDetallesIncorrectos = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var strCodigo = objRen.cells[0].innerHTML;
				var strDescripcion = objRen.cells[1].innerHTML;
				var intCantidad = parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				var intPrecioUnitario = parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				var intDisponibleExistencia = parseFloat(objRen.cells[17].innerHTML);
				//Concatenar los datos de la referencia
				var strReferencia = strCodigo+' - '+strDescripcion;

				//Si la cantidad es mayor que la existencia disponible o el precio unitario es igual a cero
				if((intCantidad == 0) || (intCantidad > intDisponibleExistencia) || (intPrecioUnitario == 0))
				{
					//Agregar refacción en el array, de esta manera, el usuario identificara las refacciones incorrectas
					arrDetallesIncorrectos.push(strReferencia);
				}
			}

			//Si existen refacciones incorrectas
			if(arrDetallesIncorrectos.length > 0)
			{
				//Mensaje que se utiliza para informar al usuario la lista de refacciones incorrectas
				var strMensaje = 'La factura no puede guardarse. Las siguientes <b>refacciones</b> no tienen precio unitario (0.00) o no tienen cantidad (0.00) o  la cantidad es mayor que la cantidad del inventario:<br>';

				//Hacer recorrido para obtener refacciones incorrectas
				for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
				{
					//Agregar refacción en el mensaje
            		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
				}

				//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_facturas_refacciones_refacciones('error', strMensaje);
			}
			else
			{
				//Si tipo de venta es de crédito y no existe clave de autorización
				if($('#cmbCondicionesPago_facturas_refacciones_refacciones').val() == 'CREDITO'
					&& ($('#txtClaveAutorizacionID_facturas_refacciones_refacciones').val() == '' ||
						$('#txtClaveAutorizacionID_facturas_refacciones_refacciones').val() == '0'))
				{

					//Hacer un llamado a la función para validar el crédito disponible del cliente (límite de crédito/saldo vencido)
					validar_credito_cliente_facturas_refacciones_refacciones();
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_facturas_refacciones_refacciones();
				}
			}

		}

		//Función que se utiliza para validar el crédito disponible del cliente (límite de crédito/saldo vencido)
		function validar_credito_cliente_facturas_refacciones_refacciones()
		{
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioFactura = parseFloat($('#txtTipoCambio_facturas_refacciones_refacciones').val());
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

			//Asignar el acumulado del importe total de refacciones (detalles)(Hacer un llamado a la función para reemplazar '$' por cadena vacia)
			var intAcumTotalDet = $.reemplazar($('#acumTotal_detalles_facturas_refacciones_refacciones').html(), "$", "");
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intAcumTotalDet = $.reemplazar(intAcumTotalDet, ",", "");
			//Convertir cadena de texto a número decimal
			intAcumTotalDet = parseFloat(intAcumTotalDet);

			//Si existe gasto de paqutería
			if($('#txtGastosPaqueteria_facturas_refacciones_refacciones').val() != '')
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intGastosPaqueteriaFra = parseFloat($.reemplazar($('#txtGastosPaqueteria_facturas_refacciones_refacciones').val(), ",", ""));
				
			}
			
			
			//Calcular el importe de la factura
			intImporteFra = intAcumTotalDet + intGastosPaqueteriaFra;

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
				        	intProspectoID: $("#txtProspectoID_facturas_refacciones_refacciones").val(), 
				        	intReferenciaID: $('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val(),
				        	strReferencia: 'REFACCIONES'
				    		},
				        success: function (data) {
				          	if(data.row)
				          	{	
				          		//Recuperar valores del cliente
				          		intCreditoLimite =  parseFloat($.reemplazar(data.row.refacciones_credito_limite, ",", ""));
				          		intSaldo =  parseFloat($.reemplazar(data.saldo_refacciones, ",", ""));
				          		intSaldoVencido =  parseFloat($.reemplazar(data.saldo_vencido_refacciones, ",", ""));
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
													        	intProspectoID: $("#txtProspectoID_facturas_refacciones_refacciones").val(), 
													        	strClave: prompt
													    		},
													        success: function (data) {

													        		//Si existe clave de autorización
													        		if(data.clave_autorizacion_id > 0)
													        		{
													        			//Asignar el id de la clave de autorización
													        			$("#txtClaveAutorizacionID_facturas_refacciones_refacciones").val(data.clave_autorizacion_id);

													        			//Hacer un llamado a la función para guardar los datos del registro
													        			guardar_facturas_refacciones_refacciones();
													        		}
													        		else
													        		{

															          	//Hacer un llamado a la función para mostrar mensaje de error
																		mensaje_facturas_refacciones_refacciones('error', data.mensaje);
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
				guardar_facturas_refacciones_refacciones();
            }

		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_facturas_refacciones_refacciones()
		{
			try
			{
				$('#frmFacturasRefaccionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_facturas_refacciones_refacciones()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_facturas_refacciones_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRefaccionID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCodigosLineas = [];			
			var arrCodigosSat = [];
			var arrUnidadesSat = [];
			var arrObjetoImpuestoSat = [];
			var arrCantidades = [];
			var arrPreciosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrTasaCuotaIva = [];
			var arrIvasUnitarios = [];
			var arrTasaCuotaIeps = [];
			var arrIepsUnitarios = [];
			var arrCostosUnitarios = [];
			
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioFactura = parseFloat($('#txtTipoCambio_facturas_refacciones_refacciones').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var intCantidad = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intPrecioUnitario = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[4].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[6].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[7].innerHTML, ",", "");
				
				//Calcular iva e ieps unitario
				intIvaUnitario =  intIvaUnitario / intCantidad;
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

				//Asignar valores a los arrays
				arrRefaccionID.push(objRen.getAttribute('id'));
				arrCodigos.push(objRen.cells[0].innerHTML);
			    arrDescripciones.push(objRen.cells[1].innerHTML);
			    arrCodigosLineas.push(objRen.cells[22].innerHTML);
			    arrCodigosSat.push(objRen.cells[18].innerHTML);
			    arrUnidadesSat.push(objRen.cells[19].innerHTML);
				arrCantidades.push(intCantidad);
				arrPreciosUnitarios.push(intPrecioUnitario);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrTasaCuotaIva.push(objRen.cells[20].innerHTML);
				arrIvasUnitarios.push(intIvaUnitario);
				arrTasaCuotaIeps.push(objRen.cells[21].innerHTML);
				arrIepsUnitarios.push(intIepsUnitario );
				arrCostosUnitarios.push(objRen.cells[16].innerHTML);
				arrObjetoImpuestoSat.push(objRen.cells[23].innerHTML);
				
			}

			//Obtenemos el objeto de la tabla CFDI relacionados
			var objTabla = document.getElementById('dg_cfdi_relacionados_facturas_refacciones_refacciones').getElementsByTagName('tbody')[0];

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
			 $.calcularFechaVencimiento(arrFechaVencimientoFacturasRefaccionesRefacciones);

			 //Asignar valores del gasto de paquetería
			var intGastosPaqueteriaSubtotalFra = parseFloat($('#txtGastosPaqueteriaSubtotal_facturas_refacciones_refacciones').val());
			var intGastosPaqueteriaIvaFra = parseFloat($('#txtGastosPaqueteriaIva_facturas_refacciones_refacciones').val());

			//Convertir importes a peso mexicano
			intGastosPaqueteriaSubtotalFra = intGastosPaqueteriaSubtotalFra * intTipoCambioFactura;
			intGastosPaqueteriaIvaFra = intGastosPaqueteriaIvaFra * intTipoCambioFactura;


			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/facturas_refacciones/guardar',
					{ 
						//Datos de la factura
						intFacturaRefaccionesID: $('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_facturas_refacciones_refacciones').val()),
						strCondicionesPago: $('#cmbCondicionesPago_facturas_refacciones_refacciones').val(),
						dteVencimiento: $.formatFechaMysql($('#txtFechaVencimiento_facturas_refacciones_refacciones').val()),
						intMonedaID: $('#cmbMonedaID_facturas_refacciones_refacciones').val(),
						intTipoCambio: intTipoCambioFactura,
						strTipoReferencia: $('#txtTipoReferencia_facturas_refacciones_refacciones').val(),
						intReferenciaID: $('#txtReferenciaID_facturas_refacciones_refacciones').val(),
						intVendedorID: $('#txtVendedorID_facturas_refacciones_refacciones').val(),
						intEstrategiaID: $('#txtEstrategiaID_facturas_refacciones_refacciones').val(),
						strTipo: $('#cmbTipo_facturas_refacciones_refacciones').val(),
						intProspectoID: $('#txtProspectoID_facturas_refacciones_refacciones').val(),
						strRazonSocial: $('#txtRazonSocial_facturas_refacciones_refacciones').val(),
						strRfc: $('#txtRfc_facturas_refacciones_refacciones').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_facturas_refacciones_refacciones').val(),
						strCalle: $('#txtCalle_facturas_refacciones_refacciones').val(),
						strNumeroExterior: $('#txtNumeroExterior_facturas_refacciones_refacciones').val(),
						strNumeroInterior: $('#txtNumeroInterior_facturas_refacciones_refacciones').val(),
						strCodigoPostal: $('#txtCodigoPostal_facturas_refacciones_refacciones').val(),
						strColonia: $('#txtColonia_facturas_refacciones_refacciones').val(),
						strLocalidad: $('#txtLocalidad_facturas_refacciones_refacciones').val(),
						strMunicipio: $('#txtMunicipio_facturas_refacciones_refacciones').val(),
						strEstado: $('#txtEstado_facturas_refacciones_refacciones').val(),
						strPais: $('#txtPais_facturas_refacciones_refacciones').val(),
						intGastosPaqueteria: intGastosPaqueteriaSubtotalFra,
						intGastosPaqueteriaIva: intGastosPaqueteriaIvaFra,
						intFormaPagoID: $('#txtFormaPagoID_facturas_refacciones_refacciones').val(),
						intMetodoPagoID: $('#txtMetodoPagoID_facturas_refacciones_refacciones').val(),
						intUsoCfdiID: $('#txtUsoCfdiID_facturas_refacciones_refacciones').val(),
						intTipoRelacionID: $('#txtTipoRelacionID_facturas_refacciones_refacciones').val(),
						intExportacionID: $('#cmbExportacionID_facturas_refacciones_refacciones').val(),
						strObservaciones: $('#txtObservaciones_facturas_refacciones_refacciones').val(),
						strNotas: $('#txtNotas_facturas_refacciones_refacciones').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_facturas_refacciones_refacciones').val(),
						//Datos de los detalles
						strRefaccionID: arrRefaccionID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strCodigosLineas: arrCodigosLineas.join('|'),
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
						strCostosUnitarios: arrCostosUnitarios.join('|'),
						//Datos de los CFDI relacionados
						strCfdiRelacionado: arrCfdiRelacionado.join('|'),
						strTiposRelacion: arrTiposRelacion.join('|'),
						//Datos de la clave de autorización (clave generada cuando se excede el límite de crédito/saldo vencido)
						intClaveAutorizacionID:  $('#txtClaveAutorizacionID_facturas_refacciones_refacciones').val()
					},
					function(data) {
	
						if(data.resultado)
						{
							//Si no existe id de la factura de refacciones, significa que es un nuevo registro   
							if($('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val() == '')
							{
							  	//Asignar el id del anticipo registrado en la base de datos
                     			$('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val(data.factura_refacciones_id);
                 			}

                 			//Hacer llamado a la función para cargar  los registros en el grid
							paginacion_facturas_refacciones_refacciones();

							//Hacer un llamado a la función para timbrar los datos del registro
							timbrar_facturas_refacciones_refacciones($('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val(), 'modal', '', $('#txtRegimenFiscalID_facturas_refacciones_refacciones').val());

							//Si no existe id de la póliza (o se trata de un nuevo registro)
							if(parseInt($('#txtPolizaID_facturas_refacciones_refacciones').val()) == 0 || 
								$('#txtEstatus_facturas_refacciones_refacciones').val() == '')
							{

								//Hacer un llamado a la función para generar póliza con los datos del registro
								 generar_poliza_facturas_refacciones_refacciones('', '', '');
							}

						}

						//Si existe mensaje de error
						if(data.tipo_mensaje == 'error')
						{
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_facturas_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
						}
						
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_facturas_refacciones_refacciones(tipoMensaje, mensaje, campoID)
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
				new $.Zebra_Dialog(strMsjRegimenFiscalCteFacturasRefaccionesRefacciones, 
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
		function cambiar_estatus_facturas_refacciones_refacciones(id, folio, polizaID, folioPoliza, tipoReferencia, referenciaID)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para asignar el folio del registro
			var strFolio = '';
			//Variable que se utiliza para asignar el id de la póliza
			var intPolizaID = 0;
		    //Variable que se utiliza para asignar el folio de la póliza
			var strFolioPoliza = '';
			//Variable que se utiliza para asignar el tipo de referencia (cotización/pedido/remisión)
	        var strTipoReferencia = ''; 
	        //Asignar el id de la referencia
		    var intReferenciaID = 0;


			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val();
				strFolio = $('#txtFolio_facturas_refacciones_refacciones').val();
				intPolizaID = $('#txtPolizaID_facturas_refacciones_refacciones').val();
				strFolioPoliza = $('#txtFolioPoliza_facturas_refacciones_refacciones').val();
				strTipoReferencia = $('#txtTipoReferencia_facturas_refacciones_refacciones').val();
				intReferenciaID = $('#txtReferenciaID_facturas_refacciones_refacciones').val();
			}
			else
			{
				intID = id;
				strFolio = folio;
				intPolizaID = polizaID;
				strFolioPoliza = folioPoliza;
				strTipoReferencia = tipoReferencia;
				intReferenciaID = referenciaID;

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
					                              abrir_cancelacion_facturas_refacciones_refacciones(intID, strFolio, intPolizaID, strTipoReferencia,intReferenciaID);

					                        }
					                            
					                    }
					              });  
		}


		
		//Función para cancelar el timbrado de un registro. Cambia el estatus a INACTIVO
		function cancelar_timbrado_facturas_refacciones_refacciones()
		{

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cancelacion_facturas_refacciones_refacciones();
			 //Hacer un llamado al método del controlador para cancelar un CFDI y posteriormente cambiar el estatus a INACTIVO
	         //----- CÓDIGO PARA PRODUCCIÓN
	          $.post('contabilidad/timbrado_cancelar/set_cancelar',
	          {
	          		//Datos para cancelar el timbrado (CFDI)
	         		intMovimientoID: $('#txtReferenciaCfdiID_cancelacion_facturas_refacciones_refacciones').val(),
					strTipoReferencia: strTipoReferenciaFacturasRefaccionesRefacciones, 
					strUuidSustitucion: $('#txtUuidSustitucion_cancelacion_facturas_refacciones_refacciones').val(),
					strMotivo: $('select[name="intCancelacionMotivoID_facturas_refacciones_refacciones"] option:selected').text(),
					//Datos para cambiar (administrativamente) el estatus del registro
					intCancelacionMotivoID: $('#cmbCancelacionMotivoID_cancelacion_facturas_refacciones_refacciones').val(), 
					intSustitucionID:  $('#txtSustitucionID_cancelacion_facturas_refacciones_refacciones').val(),
					intPolizaID: $('#txtPolizaID_cancelacion_facturas_refacciones_refacciones').val(), 
			     	strTipoReferenciaReg: $('#txtTipoReferencia_cancelacion_facturas_refacciones_refacciones').val(), 
			     	intReferenciaIDReg:  $('#txtReferenciaID_cancelacion_facturas_refacciones_refacciones').val()
	          },
	                 function(data) {

	                    if(data.resultado)
	                    {
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_facturas_refacciones_refacciones();	

							//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
							cerrar_cancelacion_facturas_refacciones_refacciones();  

							//Si el id del registro se obtuvo del modal
							if($('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val() != '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_facturas_refacciones_refacciones();     
							}		
	                    }

	                    //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
				        ocultar_circulo_carga_cancelacion_facturas_refacciones_refacciones();
					    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_facturas_refacciones_refacciones(data.tipo_mensaje, data.mensaje);


	                 },
	                'json');

		}

	

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_facturas_refacciones_refacciones(id, tipoAccion, cancelacionID)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/facturas_refacciones/get_datos',
	        {
	       		intFacturaRefaccionesID:id
	        },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_facturas_refacciones_refacciones('');
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar el id de la póliza
				            var intPolizaID = parseInt(data.row.poliza_id); 
				            //Asignar el id de la clave de autorización
				            var intClaveAutorizacionID = parseInt(data.row.clave_autorizacion_id); 
				            //Variable que se utiliza para asignar el tipo de referencia (cotización/pedido/remisión)
				            var strTipoReferencia = data.row.tipo_referencia; 
				            //Asignar el id de la referencia
				            var intReferenciaID = parseInt(data.row.referencia_id);
				             //Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);
				            //Variable que se utiliza para recuperar los detalles del registro
						    var strTipoDetalles = 'factura';

						    //Si existe id de la referencia
						    if(intReferenciaID > 0)
						    {
						    	//Cambiar el tipo de detalles para identificar que los detalles corresponde a una referencia (cotización/pedido/remisión) y así evitar realizar modificaciones
						    	strTipoDetalles = 'referencia';
						    	//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes a la referencia
								deshabilitar_controles_facturas_refacciones_refacciones();

								
								//Deshabilitar los folios de las referencias
	   							$('#txtCotizacionRefacciones_facturas_refacciones_refacciones').attr('disabled','disabled');
	   							$('#txtPedidoRefacciones_facturas_refacciones_refacciones').attr('disabled','disabled');
	   							$('#txtRemisionRefacciones_facturas_refacciones_refacciones').attr('disabled','disabled');

						    }
						    else
						    {
						    	//Asignar cadena vacia para poder buscar el tipo de cambio que le corresponde al dolar en caso de que la fecha se modifique
						    	intReferenciaID = '';
						    }

						    //Variables que se utilizan para asignar valores del gasto de paqueteríaa
							var intGastosPaqueteriaSubtotal = parseFloat(data.row.gastos_paqueteria/intTipoCambio);
							var intGastosPaqueteriaIva = parseFloat(data.row.gastos_paqueteria_iva/intTipoCambio);
							//Calcular el importe total del gasto de paquetería
						    var intGastosPaqueteriaTotal = intGastosPaqueteriaSubtotal + intGastosPaqueteriaIva;

				          	//Recuperar valores
				          	$('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val(data.row.factura_refacciones_id);
				          	$('#txtFolio_facturas_refacciones_refacciones').val(data.row.folio);
				            $('#txtFecha_facturas_refacciones_refacciones').val(data.row.fecha_format);
				            $('#cmbCondicionesPago_facturas_refacciones_refacciones').val(data.row.condiciones_pago);
				            $('#txtFechaVencimiento_facturas_refacciones_refacciones').val(data.row.vencimiento);
				            $('#cmbMonedaID_facturas_refacciones_refacciones').val(data.row.moneda_id);
				            $('#txtTipoCambio_facturas_refacciones_refacciones').val(data.row.tipo_cambio);
				            $('#txtTipoReferencia_facturas_refacciones_refacciones').val(strTipoReferencia);
				            $('#txtReferenciaID_facturas_refacciones_refacciones').val(intReferenciaID);
				            $('#txtCotizacionRefacciones_facturas_refacciones_refacciones').val(data.row.folio_cotizacion);
				            $('#txtPedidoRefacciones_facturas_refacciones_refacciones').val(data.row.folio_pedido);
				            $('#txtRemisionRefacciones_facturas_refacciones_refacciones').val(data.row.folio_remision);
				            $('#txtVendedorID_facturas_refacciones_refacciones').val(data.row.vendedor_id);
						    $('#txtVendedor_facturas_refacciones_refacciones').val(data.row.vendedor);
						    $('#txtEstrategiaID_facturas_refacciones_refacciones').val(data.row.estrategia_id);
						    $('#txtEstrategia_facturas_refacciones_refacciones').val(data.row.estrategia);
						    $('#cmbTipo_facturas_refacciones_refacciones').val(data.row.tipo);
				            $('#txtProspectoID_facturas_refacciones_refacciones').val(data.row.prospecto_id);
						    $('#txtRazonSocial_facturas_refacciones_refacciones').val(data.row.razon_social);
						    $('#txtRfc_facturas_refacciones_refacciones').val(data.row.rfc);
						    $('#txtRegimenFiscalID_facturas_refacciones_refacciones').val(data.row.regimen_fiscal_id);
						    $('#txtCalle_facturas_refacciones_refacciones').val(data.row.calle);
						    $('#txtNumeroExterior_facturas_refacciones_refacciones').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_facturas_refacciones_refacciones').val(data.row.numero_interior);
						    $('#txtCodigoPostal_facturas_refacciones_refacciones').val(data.row.codigo_postal);
						    $('#txtColonia_facturas_refacciones_refacciones').val(data.row.colonia);
						    $('#txtLocalidad_facturas_refacciones_refacciones').val(data.row.localidad);
						    $('#txtMunicipio_facturas_refacciones_refacciones').val(data.row.municipio);
						    $('#txtEstado_facturas_refacciones_refacciones').val(data.row.estado);
						    $('#txtPais_facturas_refacciones_refacciones').val(data.row.pais);
						    $('#txtGastosPaqueteriaIva_facturas_refacciones_refacciones').val(intGastosPaqueteriaIva);
						    $('#txtGastosPaqueteriaSubtotal_facturas_refacciones_refacciones').val(intGastosPaqueteriaSubtotal);
						    $('#txtGastosPaqueteria_facturas_refacciones_refacciones').val(intGastosPaqueteriaTotal);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtGastosPaqueteria_facturas_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
						    $('#txtRefaccionesListaPrecioID_facturas_refacciones_refacciones').val(data.row.refacciones_lista_precio_id);
						    $('#txtRefaccionesCreditoDias_facturas_refacciones_refacciones').val(data.row.refacciones_credito_dias);
						    $('#txtFormaPagoID_facturas_refacciones_refacciones').val(data.row.forma_pago_id);
						    $('#txtFormaPago_facturas_refacciones_refacciones').val(data.row.forma_pago);
						    $('#txtMetodoPagoID_facturas_refacciones_refacciones').val(data.row.metodo_pago_id);
						    $('#txtMetodoPago_facturas_refacciones_refacciones').val(data.row.metodo_pago);
						    $('#txtUsoCfdiID_facturas_refacciones_refacciones').val(data.row.uso_cfdi_id);
						    $('#txtUsoCfdi_facturas_refacciones_refacciones').val(data.row.uso_cfdi);
						    $('#txtTipoRelacionID_facturas_refacciones_refacciones').val(data.row.tipo_relacion_id);
						    $('#txtTipoRelacion_facturas_refacciones_refacciones').val(data.row.tipo_relacion);
						    $('#cmbExportacionID_facturas_refacciones_refacciones').val(data.row.exportacion_id);
						    $('#txtObservaciones_facturas_refacciones_refacciones').val(data.row.observaciones);
						    $('#txtNotas_facturas_refacciones_refacciones').val(data.row.notas);
						    $('#txtPolizaID_facturas_refacciones_refacciones').val(intPolizaID);
						    $('#txtFolioPoliza_facturas_refacciones_refacciones').val(data.row.folio_poliza);
						    $('#txtClaveAutorizacionID_facturas_refacciones_refacciones').val(intClaveAutorizacionID);
						    $('#txtEstatus_facturas_refacciones_refacciones').val(strEstatus);
						    
						    //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_facturas_refacciones_refacciones').addClass("estatus-"+strEstatus);
				           
				            //Mostrar botón Imprimir  
				            $('#btnImprimirRegistro_facturas_refacciones_refacciones').show();
						  	
						  	//Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar botón Descargar Archivo
				            	$("#btnDescargarArchivo_facturas_refacciones_refacciones").show();
				           	}	

						    
						    //Si el estatus del registro es TIMBRAR
				            if(strEstatus == 'TIMBRAR')
				            {

				            	//Si existe id de la póliza
				            	if(intPolizaID > 0)
				            	{
				            		//Hacer un llamado a la función para habilitar campos de timbrado
				            		habilitar_controles_timbrado_facturas_refacciones_refacciones();
				            	}
				            	else
				            	{
				            		//Si no existe id de la referencia (COTIZACION/REMISION/PEDIDO)
								    if(intReferenciaID == '')
								    {

								    	//Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
										habilitar_elementos_tipo_cambio_detalles_facturas_refacciones_refacciones('#txtProspectoID_facturas_refacciones_refacciones');

										//Si el id de la moneda no corresponde al peso mexicano
									    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDFacturasRefaccionesRefacciones)
									    {
											//Habilitar caja de texto
											$('#txtTipoCambio_facturas_refacciones_refacciones').removeAttr('disabled');
									    }
									    else
									    {
									    	//Deshabilitar las siguientes cajas de texto
											$("#txtTipoCambio_facturas_refacciones_refacciones").attr('disabled','disabled');
									    }
								    }
								    else
								    {
								    	//Deshabilitar las siguientes cajas de texto
										$("#txtTipoCambio_facturas_refacciones_refacciones").attr('disabled','disabled');
								    }
				            	}
				            }
				            else
				            {
				            
				            	//Si el estatus del registro es ACTIVO
								if(strEstatus == 'ACTIVO')
								{
									//Mostrar los siguientes botones
				            		$("#btnEnviarCorreo_facturas_refacciones_refacciones").show();
				            		
				            		//Si existe el id de la póliza
					            	if(intPolizaID > 0)
					            	{
					            		$('#btnDesactivar_facturas_refacciones_refacciones').show();
					            	}
								}

					           	
					           	//Deshabilitar todos los elementos del formulario
				            	$('#frmFacturasRefaccionesRefacciones').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnReiniciar_facturas_refacciones_refacciones").hide();
								$("#btnGuardar_facturas_refacciones_refacciones").hide();
								$("#btnBuscarCFDI_facturas_refacciones_refacciones").hide(); 

								//Si existe id de la cancelación del CFDI
								if(cancelacionID > 0)
								{	
									//Asignar el id de la cancelación
									$("#txtCancelacionID_facturas_refacciones_refacciones").val(cancelacionID); 
									//Mostrar botón Motivo de cancelación
									$("#btnVerMotivoCancelacion_facturas_refacciones_refacciones").show(); 
								}
								
								//Deshabilitar botón Agregar
								$('#btnAgregar_facturas_refacciones_refacciones').prop('disabled', true);
				            }

				      		

				            //Hacer un llamado a la función para agregar los CFDI en la tabla CFDI relacionados
							agregar_cfdi_relacionados_cliente_facturas_refacciones_refacciones('Editar', strEstatus);	

							//Si la factura (sin timbrar) tiene pagos (abonos) / tiene clave de autorización
							if(strEstatus == 'TIMBRAR' && (data.abonos > 0 || intClaveAutorizacionID > 0))
							{	
								//Cambiar el estatus para no mostrar las acciones de la tabla detalles
								strEstatus = 'Ver';
								//Variable que se utiliza para asignar el mensaje informativo
								var strMensaje = '';

								//Deshabilitar las siguientes cajas de texto
								$('#txtGastosPaqueteria_facturas_refacciones_refacciones').attr('disabled','disabled');
								$('#txtRazonSocial_facturas_refacciones_refacciones').attr('disabled','disabled');
								$('#txtMetodoPago_facturas_refacciones_refacciones').attr('disabled','disabled');
								$('#cmbCondicionesPago_facturas_refacciones_refacciones').attr('disabled','disabled');
								//Deshabilitar los folios de las referencias
	   							$('#txtCotizacionRefacciones_facturas_refacciones_refacciones').attr('disabled','disabled');
	   							$('#txtPedidoRefacciones_facturas_refacciones_refacciones').attr('disabled','disabled');
	   							$('#txtRemisionRefacciones_facturas_refacciones_refacciones').attr('disabled','disabled');

	   							//Deshabilitar botón Agregar
								$('#btnAgregar_facturas_refacciones_refacciones').prop('disabled', true);

   								//Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
								habilitar_elementos_tipo_cambio_detalles_facturas_refacciones_refacciones('');

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
								mensaje_facturas_refacciones_refacciones('error', strMensaje);
							}

							//Hacer un llamado a la función para cargar los detalles del registro en la tabla
				            cargar_detalles_tabla_facturas_refacciones_refacciones(data.row.tipo_cambio, data.detalles, strTipoDetalles, 'Editar', strEstatus, intPolizaID);

							//Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objFacturasRefaccionesRefacciones = $('#FacturasRefaccionesRefaccionesBox').bPopup({
															  appendTo: '#FacturasRefaccionesRefaccionesContent', 
								                              contentContainer: 'FacturasRefaccionesRefaccionesM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});
					        }

				            //Enfocar caja de texto
							$('#cmbMonedaID_facturas_refacciones_refacciones').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar y obtener los datos de una cotización 
		function get_datos_cotizacion_facturas_refacciones_refacciones()
		{
		    //Hacer un llamado al método del controlador para regresar los datos de la cotización
            $.post('refacciones/cotizaciones_refacciones/get_datos',
                  { 
                  	intCotizacionRefaccionesID: $('#txtReferenciaID_facturas_refacciones_refacciones').val()
                  },
                  function(data) {
                    if(data.row){

                    	//Hacer un llamado a la función para cargar datos de la cotización
                    	get_datos_referencia_facturas_refacciones_refacciones(data, 'COTIZACION');
                    }
                }
                 ,
                'json');
		}


		//Función para regresar y obtener los datos de un pedido 
		function get_datos_pedido_facturas_refacciones_refacciones()
		{
		    //Hacer un llamado al método del controlador para regresar los datos del pedido
            $.post('refacciones/pedidos_refacciones/get_datos',
                  { 
                  	intPedidoRefaccionesID: $('#txtReferenciaID_facturas_refacciones_refacciones').val()
                  },
                  function(data) {
                    if(data.row){

                    	//Hacer un llamado a la función para cargar datos del pedido
                    	get_datos_referencia_facturas_refacciones_refacciones(data, 'PEDIDO');
                    }
                }
                 ,
                'json');
		}



		//Función para regresar y obtener los datos de una remisión 
		function get_datos_remision_facturas_refacciones_refacciones()
		{
		    //Hacer un llamado al método del controlador para regresar los datos de la remisión
            $.post('refacciones/remisiones_refacciones/get_datos',
                  { 
                  	intRemisionRefaccionesID: $('#txtReferenciaID_facturas_refacciones_refacciones').val()
                  },
                  function(data) {
                    if(data.row){

                    	//Hacer un llamado a la función para cargar datos de la remisión
                    	get_datos_referencia_facturas_refacciones_refacciones(data, 'REMISION');
                    }
                }
                 ,
                'json');
		}



		//Función para asignar datos del tipo de referencia seleccionada (COTIZACION/PEDIDO/REMISION)
		function get_datos_referencia_facturas_refacciones_refacciones(data, tipoReferencia)
		{
			//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes a la referencia
			deshabilitar_controles_facturas_refacciones_refacciones();
        	//Recuperar valores
        	$('#txtTipoReferencia_facturas_refacciones_refacciones').val(tipoReferencia);
 			$('#cmbMonedaID_facturas_refacciones_refacciones').val(data.row.moneda_id);
            $('#txtTipoCambio_facturas_refacciones_refacciones').val(data.row.tipo_cambio);
            $('#txtProspectoID_facturas_refacciones_refacciones').val(data.row.prospecto_id);
 		    $('#txtRazonSocial_facturas_refacciones_refacciones').val(data.row.razon_social);
            $('#txtRfc_facturas_refacciones_refacciones').val(data.row.rfc);
            $('#txtRegimenFiscalID_facturas_refacciones_refacciones').val(data.row.regimen_fiscal_id);
            $('#txtCalle_facturas_refacciones_refacciones').val(data.row.cliente_calle);
            $('#txtNumeroExterior_facturas_refacciones_refacciones').val(data.row.cliente_numero_exterior);
            $('#txtNumeroInterior_facturas_refacciones_refacciones').val(data.row.cliente_numero_interior);
            $('#txtCodigoPostal_facturas_refacciones_refacciones').val(data.row.cliente_codigo_postal);
            $('#txtColonia_facturas_refacciones_refacciones').val(data.row.cliente_colonia);
            $('#txtLocalidad_facturas_refacciones_refacciones').val(data.row.cliente_localidad);
            $('#txtMunicipio_facturas_refacciones_refacciones').val(data.row.cliente_municipio);
            $('#txtEstado_facturas_refacciones_refacciones').val(data.row.cliente_estado);
            $('#txtPais_facturas_refacciones_refacciones').val(data.row.cliente_pais);
 		    $('#txtRefaccionesListaPrecioID_facturas_refacciones_refacciones').val(data.row.refacciones_lista_precio_id);
 		    $('#txtRefaccionesCreditoDias_facturas_refacciones_refacciones').val(data.row.refacciones_credito_dias);
 		    $('#txtVendedorID_facturas_refacciones_refacciones').val(data.row.vendedor_id);
 		    $('#txtVendedor_facturas_refacciones_refacciones').val(data.row.vendedor);
 		    $('#txtEstrategiaID_facturas_refacciones_refacciones').val(data.row.estrategia_id);
 		    $('#txtEstrategia_facturas_refacciones_refacciones').val(data.row.estrategia);
 		    $('#cmbTipo_facturas_refacciones_refacciones').val(data.row.tipo);
 		    //Deshabilitar las siguientes cajas de texto
		    $("#txtTipoCambio_facturas_refacciones_refacciones").attr('disabled','disabled');


 		    //Variable que se utiliza para asignar el tipo de cambio
	        var intTipoCambio = parseFloat(data.row.tipo_cambio);

 		    //Variables que se utilizan para asignar valores del gasto de paqueteríaa
			var intGastosPaqueteriaSubtotal = parseFloat(data.row.gastos_paqueteria/intTipoCambio);
			var intGastosPaqueteriaIva = parseFloat(data.row.gastos_paqueteria_iva/intTipoCambio);
			//Calcular el importe total del gasto de paquetería
		    var intGastosPaqueteriaTotal = intGastosPaqueteriaSubtotal + intGastosPaqueteriaIva;

 		    
 		    $('#txtGastosPaqueteriaIva_facturas_refacciones_refacciones').val(intGastosPaqueteriaIva);
		    $('#txtGastosPaqueteriaSubtotal_facturas_refacciones_refacciones').val(intGastosPaqueteriaSubtotal);
		    $('#txtGastosPaqueteria_facturas_refacciones_refacciones').val(intGastosPaqueteriaTotal);
		    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
	        $('#txtGastosPaqueteria_facturas_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });

 		    $('#txtObservaciones_facturas_refacciones_refacciones').val(data.row.observaciones);
			$('#txtNotas_facturas_refacciones_refacciones').val(data.row.notas);
			
 		    //Hacer un llamado a la función para cargar los detalles del registro en la tabla
            cargar_detalles_tabla_facturas_refacciones_refacciones(data.row.tipo_cambio, data.detalles, 'referencia', '', '', '');

		}

		//Función para regresar y obtener los datos de un cliente
		function get_datos_cliente_facturas_refacciones_refacciones()
		{
			 //Hacer un llamado al método del controlador para regresar los datos del cliente
             $.post('cuentas_cobrar/clientes/get_datos',
                  { 
                  	intProspectoID:$('#txtProspectoID_facturas_refacciones_refacciones').val()
                  },
                  function(data) {
                    if(data.row){
                       //Asignar datos del registro seleccionado
                       $('#txtRfc_facturas_refacciones_refacciones').val(data.row.rfc);
                       $('#txtRegimenFiscalID_facturas_refacciones_refacciones').val(data.row.regimen_fiscal_id);
                       $('#txtCalle_facturas_refacciones_refacciones').val(data.row.calle);
                       $('#txtNumeroExterior_facturas_refacciones_refacciones').val(data.row.numero_exterior);
                       $('#txtNumeroInterior_facturas_refacciones_refacciones').val(data.row.numero_interior);
                       $('#txtCodigoPostal_facturas_refacciones_refacciones').val(data.row.codigo_postal);
                       $('#txtColonia_facturas_refacciones_refacciones').val(data.row.colonia);
                       $('#txtLocalidad_facturas_refacciones_refacciones').val(data.row.localidad);
                       $('#txtMunicipio_facturas_refacciones_refacciones').val(data.row.municipio);
                       $('#txtEstado_facturas_refacciones_refacciones').val(data.row.estado_rep);
                       $('#txtPais_facturas_refacciones_refacciones').val(data.row.pais_rep);
                       $('#txtRefaccionesListaPrecioID_facturas_refacciones_refacciones').val(data.row.refacciones_lista_precio_id);
                       $('#txtRefaccionesCreditoDias_facturas_refacciones_refacciones').val(data.row.refacciones_credito_dias);


                        //Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
				 	    habilitar_elementos_tipo_cambio_detalles_facturas_refacciones_refacciones('#txtProspectoID_facturas_refacciones_refacciones');
                      
                    }
                  }
                 ,
                'json');
		} 


		//Función para habilitar controles del formulario correspondientes al timbrado
		function habilitar_controles_timbrado_facturas_refacciones_refacciones()
		{
			//Deshabilitar todos los elementos del formulario
        	$('#frmFacturasRefaccionesRefacciones').find('input, textarea, select').attr('disabled','disabled');
        	//Habilitar las siguientes cajas de texto
        	$('#txtFormaPago_facturas_refacciones_refacciones').removeAttr('disabled');
        	$('#txtMetodoPago_facturas_refacciones_refacciones').removeAttr('disabled');
        	$('#txtUsoCfdi_facturas_refacciones_refacciones').removeAttr('disabled');
        	$('#txtTipoRelacion_facturas_refacciones_refacciones').removeAttr('disabled');
        	$('#cmbExportacionID_facturas_refacciones_refacciones').removeAttr('disabled');
        	$('#txtObservaciones_facturas_refacciones_refacciones').removeAttr('disabled');
        	$('#txtNotas_facturas_refacciones_refacciones').removeAttr('disabled');
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_facturas_refacciones_refacciones()
		{	
			//Si la moneda no corresponde a peso mexicano y no existe id de la referencia COTIZACION/PEDIDO/REMISION
			if((parseInt($('#cmbMonedaID_facturas_refacciones_refacciones').val()) !== intMonedaBaseIDFacturasRefaccionesRefacciones) && $("#txtReferenciaID_facturas_refacciones_refacciones").val() == '') 
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_facturas_refacciones_refacciones").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_facturas_refacciones_refacciones').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_facturas_refacciones_refacciones').val();
	        
				//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.ajax({
					        url: 'caja/tipos_cambio/get_datos',
					        method:'post',
					        dataType: 'json',
					        async: false,
					        data: {
					        	strBusqueda:  strCriteriosBusq,
			       				strTipo: 'fecha'
					        },
					        success: function (data) {
					          	if(data.row){
			                       $("#txtTipoCambio_facturas_refacciones_refacciones").val(data.row.tipo_cambio_venta);
					  			  
			                    }

					        }
					    });

	            //Hacer un llamado a la función para recalcular los importes y habilitar/deshabilitar campos
	             recalcular_precio_unitario_facturas_refacciones_refacciones('#txtTipoCambio_facturas_refacciones_refacciones');
	            
			}
			
		}


		//Función para generar póliza con los datos de un registro
		function generar_poliza_facturas_refacciones_refacciones(id, estatus, formulario)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_facturas_refacciones_refacciones(formulario);
			//Hacer un llamado al método del controlador para timbrar los datos del registro
			$.post('contabilidad/generar_polizas/generar_poliza',
		     {
		     	intReferenciaID: intID,
		      	strTipoReferencia: strTipoReferenciaFacturasRefaccionesRefacciones, 
		      	intProcesoMenuID: $('#txtProcesoMenuID_facturas_refacciones_refacciones').val()
		     },
		     function(data) {

		     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
			    ocultar_circulo_carga_facturas_refacciones_refacciones(formulario);
			    //Si existe resultado
				if (data.resultado)
				{

					//Asignar el id de la póliza (generada) y evitar duplicidad de datos en caso de que no sea posible timbrar el registro
                    $('#txtPolizaID_facturas_refacciones_refacciones').val(data.poliza_id);
					//Hacer llamado a la función para cargar  los registros en el grid
					paginacion_facturas_refacciones_refacciones();
					
				}

				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_facturas_refacciones_refacciones(data.tipo_mensaje, data.mensaje);

		     },
		     'json');
		}


		//Función para timbrar los datos de un registro
		function timbrar_facturas_refacciones_refacciones(id, tipo, formulario, regimenFiscalID)
		{
			//Si existe id del régimen fiscal
			if(regimenFiscalID > 0)
			{
				//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
				mostrar_circulo_carga_facturas_refacciones_refacciones(formulario);

				//Hacer un llamado al método del controlador para timbrar los datos del registro
				$.post('contabilidad/timbradoV4/set_timbrar',
			     {
			     	intReferenciaID: id,
			      	strTipoReferencia: strTipoReferenciaFacturasRefaccionesRefacciones
			     },
			     function(data) {
					//Si el id del registro se obtuvo del modal
					if(tipo == 'modal')
					{
						//Si existe resultado (los datos se timbraron correctamente)
						if (data.resultado)
						{

							//Hacer un llamado a la función para cerrar modal
							cerrar_facturas_refacciones_refacciones();  
						}
						else
						{
							//Hacer un llamado a la función para limpiar los mensajes de error 
							limpiar_mensajes_facturas_refacciones_refacciones();
							//Hacer un llamado a la función para cargar datos del registro (habilitar campos de timbrado)
							editar_facturas_refacciones_refacciones(id,'Nuevo');

						}
					}

					//Hacer llamado a la función para cargar  los registros en el grid
				    paginacion_facturas_refacciones_refacciones();
					//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		            ocultar_circulo_carga_facturas_refacciones_refacciones(formulario);
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_facturas_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
			}
			else
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				 mensaje_facturas_refacciones_refacciones('error_regimen_fiscal');
			}
			
			
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function mostrar_circulo_carga_facturas_refacciones_refacciones(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_facturas_refacciones_refacciones';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_facturas_refacciones_refacciones';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function ocultar_circulo_carga_facturas_refacciones_refacciones(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_facturas_refacciones_refacciones';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_facturas_refacciones_refacciones';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_facturas_refacciones_refacciones(tipoReferencia)
		{
	   		//Si el tipo de referencia corresponde a una refacción
			/*if(tipoReferencia == 'REFACCION')
			{			
	   			//Habilitar las siguientes cajas de texto
		    	//$('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').removeAttr('disabled');
		    	$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').removeAttr('disabled');
			}*/

			//Habilitar las siguientes cajas de texto
			$('#txtReferencia_detalles_facturas_refacciones_refacciones').removeAttr('disabled');
		    $('#txtCantidad_detalles_facturas_refacciones_refacciones').removeAttr('disabled');

		    //Limpiar las siguientes cajas de texto
		    $('#txtTipoReferencia_detalles_facturas_refacciones_refacciones').val('');
            $('#txtCodigo_detalles_facturas_refacciones_refacciones').val('');
            $('#txtDescripcion_detalles_facturas_refacciones_refacciones').val('');
            $('#txtCodigoSat_detalles_facturas_refacciones_refacciones').val('');
            $('#txtUnidadSat_detalles_facturas_refacciones_refacciones').val('');
            $('#txtObjetoImpuestoSat_detalles_facturas_refacciones_refacciones').val('');
            $('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').val('');
            $('#txtPrecioRefaccion_detalles_facturas_refacciones_refacciones').val('');
            $('#txtTipoCambioRefaccion_detalles_facturas_refacciones_refacciones').val('');
            $('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').val('0.00');
            $('#txtPorcentajeIva_detalles_facturas_refacciones_refacciones').val('');
            $('#txtPorcentajeIeps_detalles_facturas_refacciones_refacciones').val('');
            $('#txtActualCosto_detalles_facturas_refacciones_refacciones').val('');
            $('#txtDisponibleExistencia_detalles_facturas_refacciones_refacciones').val('');
            $('#txtTasaCuotaIva_detalles_facturas_refacciones_refacciones').val('');
			$('#txtTasaCuotaIeps_detalles_facturas_refacciones_refacciones').val('');
            $('#txtCantidad_detalles_facturas_refacciones_refacciones').val('');
		}


		//Función para regresar obtener los datos de una refacción
		function get_datos_refaccion_detalles_facturas_refacciones_refacciones(porcentajePromocion)
		{

			//Hacer un llamado al método del controlador para regresar los datos de la refacción
           	$.post('refacciones/refacciones/get_datos',
                  { 
                  	strBusqueda: $('#txtReferenciaID_detalles_facturas_refacciones_refacciones').val(),
		       		strTipo: 'id',
		       		intRefaccionesListaPrecioID: $('#txtRefaccionesListaPrecioID_facturas_refacciones_refacciones').val(),
		       		//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día 
	    			dteFechaTipoCambio: $.formatFechaMysql($('#txtFecha_facturas_refacciones_refacciones').val()),
	    			//Regresar el precio que le corresponde al cliente
			       	strListaPrecioCte: 'SI'
                  },
                  function(data) {
                    if(data.row){

                       	$('#txtCodigo_detalles_facturas_refacciones_refacciones').val(data.row.codigo_01);
                       	$('#txtCodigoLinea_detalles_facturas_refacciones_refacciones').val(data.row.codigo_linea);
                       	$('#txtDescripcion_detalles_facturas_refacciones_refacciones').val(data.row.descripcion);
                       	$('#txtCodigoSat_detalles_facturas_refacciones_refacciones').val(data.row.codigo_sat);
                       	$('#txtUnidadSat_detalles_facturas_refacciones_refacciones').val(data.row.unidad_sat);
                       	$('#txtObjetoImpuestoSat_detalles_facturas_refacciones_refacciones').val(data.row.objeto_impuesto_sat);
                       	$('#txtPrecioRefaccion_detalles_facturas_refacciones_refacciones').val(data.row.precio);
                      	
                      	$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').val(porcentajePromocion);
        				//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
		    			$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });

		    			$('#txtTasaCuotaIva_detalles_facturas_refacciones_refacciones').val(data.row.tasa_cuota_iva);
                       	$('#txtPorcentajeIva_detalles_facturas_refacciones_refacciones').val(data.row.porcentaje_iva);
                       	$('#txtTasaCuotaIeps_detalles_facturas_refacciones_refacciones').val(data.row.tasa_cuota_ieps);
                       	$('#txtPorcentajeIeps_detalles_facturas_refacciones_refacciones').val(data.row.porcentaje_ieps);
                       
                       	$('#txtTipoCambio_detalles_facturas_refacciones_refacciones').val(data.row.tipo_cambio_venta);
                       	$('#txtActualCosto_detalles_facturas_refacciones_refacciones').val(data.row.actual_costo);
                       	$('#txtDisponibleExistencia_detalles_facturas_refacciones_refacciones').val(data.row.disponible_existencia);
                       	//Hacer un llamado a la función para calcular el precio unitario
				  	   	calcular_precio_unitario_detalles_facturas_refacciones_refacciones();
                       	//Enfocar caja de texto
                  	   	$('#txtCantidad_detalles_facturas_refacciones_refacciones').focus();
                    }
                  }
                 ,
                'json');
		}

		//Función para cargar los detalles de la cotización o del pedido en la tabla 
		function cargar_detalles_tabla_facturas_refacciones_refacciones(tipoCambio, arrDetalles, tipoRegistro, tipoAccion, strEstatus, polizaID)
		{

			//Variable que se utiliza para asignar las acciones del grid view
			var strAccionesTablaDetalles = '';
			//Variable que se utiliza para asignar el tipo de cambio
            var intTipoCambio = parseFloat(tipoCambio);
            //Asignar el id de la póliza
			var intPolizaID = parseInt(polizaID);
			 //Array que se utiliza para agregar las refacciones incorrectas
			var arrDetallesIncorrectos = [];

			//Si se cumple la sentencia
            if(strEstatus == '' || (strEstatus == 'TIMBRAR' && intPolizaID == 0))
            {
            	//Asignar las acciones del grid view
            	strAccionesTablaDetalles = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_detalles_facturas_refacciones_refacciones(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
											 " onclick='eliminar_renglon_detalles_facturas_refacciones_refacciones(this)'>" + 
											 "<span class='glyphicon glyphicon-trash'></span></button>" + 
											 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
											 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
            }

            

            //Si los detalles corresponden a una referencia (cotización/pedido/remisión)
            if(tipoRegistro == 'referencia')
            {
            	//Limpiar acciones del grid view
				strAccionesTablaDetalles = '';
            }

           	//Mostramos los detalles del registro
           	for (var intCon in arrDetalles) 
            {
            	
				//Variables que se utilizan para asignar valores del detalle
				var strCodigo = arrDetalles[intCon].codigo;
				var strDescripcion = arrDetalles[intCon].descripcion;
				var intSubtotal = parseFloat(arrDetalles[intCon].precio_unitario);
				var intCantidad =  parseFloat(arrDetalles[intCon].cantidad);
				var intPrecioUnitario = parseFloat(arrDetalles[intCon].precio_unitario);
				var intDescuentoUnitario = parseFloat(arrDetalles[intCon].descuento_unitario);
				var intIvaUnitario = parseFloat(arrDetalles[intCon].iva_unitario);
				var intIepsUnitario = parseFloat(arrDetalles[intCon].ieps_unitario);
				var intDisponibleExistencia = parseFloat(arrDetalles[intCon].disponible_existencia);
				var intActualCosto = arrDetalles[intCon].actual_costo;
				var intPrecioRefaccion = 0;
				//Concatenar los datos de la referencia
			    var strReferencia = strCodigo+' - '+strDescripcion;
			    //Asignar el costo actual de la refacción convertido al tipo de cambio
				var intActualCostoConv = parseFloat(intActualCosto); 
				var intImporteIva = 0;
				var intImporteIeps = 0;
				var intPorcentajeDescuento = 0;
				var intPorcentajeIeps = '';
				var intTotal = 0;
				//Variable que se utiliza para asignar  el color de fondo del registro
				var strEstiloRegistro = '';
				//Variable que se utiliza para agregar detalle en la tabla (nuevo registro)
				var strAgregar = 'SI';

				//Si el tipo de acción es Editar
				if(tipoAccion == 'Editar')
				{
					//Incrementar la existencia disponible 
                	intDisponibleExistencia += intCantidad;
				}
				else
				{
					//Si la cantidad es mayor que la existencia disponible
					if(intCantidad > intDisponibleExistencia)
					{
						//Asignar clase para cambiar el color de fondo
						strEstiloRegistro = 'registro-INACTIVO';
					}
				}

				//Convertir peso mexicano a tipo de cambio
				intSubtotal = intSubtotal / intTipoCambio;
				intPrecioUnitario = intPrecioUnitario / intTipoCambio;
				intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
				intIvaUnitario = intIvaUnitario / intTipoCambio;
				intIepsUnitario = intIepsUnitario / intTipoCambio;
				intActualCostoConv = intActualCostoConv / intTipoCambio;

				//Si no existe id de la factura validar el costo actual de la refacción
				if($('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val() == '')
				{
					//Redondear cantidad a x decimales
				    intActualCostoConv = intActualCostoConv.toFixed(4);
					intActualCostoConv = parseFloat(intActualCostoConv);
					intSubtotal = intSubtotal.toFixed(2);
					intSubtotal = parseFloat(intSubtotal);

					//Si se cumple la sentencia
					if(intSubtotal < intActualCostoConv)
					{	
				     	//Asignar NO para evitar agregar el detalle
						strAgregar = 'NO';
						//Agregar refacción en el array, de esta manera, el usuario identificara las refacciones incorrectas
					    arrDetallesIncorrectos.push(strReferencia);
					}

				}//Cierre de verificación del nuevo registro

				//Si se cumplen las reglas de validación
				if(strAgregar == 'SI')
				{
					//Si existe importe del descuento
					if(intDescuentoUnitario > 0)
					{
						intPrecioUnitario = intPrecioUnitario + intDescuentoUnitario;
						//Calcular porcentaje del descuento
						intPorcentajeDescuento = (intDescuentoUnitario / intPrecioUnitario) * 100;
					}

					//Asignar el precio de la refacción 
					intPrecioRefaccion = intPrecioUnitario;
					//Redondear cantidad a decimales
			   	 	intPrecioRefaccion = intPrecioRefaccion.toFixed(2);
			   	 	intPrecioRefaccion = parseFloat(intPrecioRefaccion);
					
					//Calcular subtotal
					intSubtotal = intCantidad * intSubtotal;
					
					//Calcular importe de IVA
					intImporteIva =  intIvaUnitario * intCantidad;
					

					//Si existe importe de IEPS unitario
					if(intIepsUnitario > 0)
					{
						//Calcular importe de IEPS
						intImporteIeps =  intIepsUnitario * intCantidad;
						//Asignar porcentaje de IEPS
						intPorcentajeIeps = arrDetalles[intCon].porcentaje_ieps;
					}


					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;

					//Cambiar cantidad a  formato moneda (a visualizar)
					intCantidad =  formatMoney(intCantidad, 2, '');
					intPrecioUnitario = formatMoney(intPrecioUnitario, 2, '');
					intDescuentoUnitario = formatMoney(intDescuentoUnitario, 2, '');
					intSubtotal = formatMoney(intSubtotal, 2, '');
					intImporteIva = formatMoney(intImporteIva, 4, '');
					intImporteIeps = formatMoney(intImporteIeps, 4, '');
					intTotal = formatMoney(intTotal, 2, '');
					intPorcentajeDescuento = formatMoney(intPorcentajeDescuento, 2, ''); 

					//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_detalles_facturas_refacciones_refacciones').getElementsByTagName('tbody')[0];

					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaCodigo = objRenglon.insertCell(0);
					var objCeldaDescripcion = objRenglon.insertCell(1);
					var objCeldaCantidad = objRenglon.insertCell(2);
					var objCeldaPrecioUnitario = objRenglon.insertCell(3);
					var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
					var objCeldaSubtotal = objRenglon.insertCell(5);
					var objCeldaIvaUnitario = objRenglon.insertCell(6);
					var objCeldaIepsUnitario = objRenglon.insertCell(7);
					var objCeldaTotal = objRenglon.insertCell(8);
					var objCeldaAcciones = objRenglon.insertCell(9);
					//Columnas ocultas
					var objCeldaPorcentajeDescuento = objRenglon.insertCell(10);
					var objCeldaPorcentajeIva = objRenglon.insertCell(11);
					var objCeldaPorcentajeIeps = objRenglon.insertCell(12);
					var objCeldaTipoReferencia = objRenglon.insertCell(13);
					var objCeldaTipoCambio = objRenglon.insertCell(14);
					var objCeldaPrecioRefaccion = objRenglon.insertCell(15);
					var objCeldaCostoActual = objRenglon.insertCell(16);
					var objCeldaDisponibleExistencia = objRenglon.insertCell(17);
					var objCeldaCodigoSat = objRenglon.insertCell(18);
					var objCeldaUnidadSat = objRenglon.insertCell(19);
					var objCeldaTasaCuotaIva = objRenglon.insertCell(20);
					var objCeldaTasaCuotaIeps = objRenglon.insertCell(21);
					var objCeldaCodigoLinea = objRenglon.insertCell(22);
					var objCeldaObjetoImpuestoSat = objRenglon.insertCell(23);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', arrDetalles[intCon].refaccion_id);
					objCeldaCodigo.setAttribute('class', 'movil d1 '+strEstiloRegistro);
					objCeldaCodigo.innerHTML = arrDetalles[intCon].codigo;
					objCeldaDescripcion.setAttribute('class', 'movil d2 '+strEstiloRegistro);
					objCeldaDescripcion.innerHTML = arrDetalles[intCon].descripcion;
					objCeldaCantidad.setAttribute('class', 'movil d3 '+strEstiloRegistro);
					objCeldaCantidad.innerHTML = intCantidad;
					objCeldaPrecioUnitario.setAttribute('class', 'movil d4 '+strEstiloRegistro);
					objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
					objCeldaDescuentoUnitario.setAttribute('class', 'movil d5 '+strEstiloRegistro);
					objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
					objCeldaSubtotal.setAttribute('class', 'movil d6 '+strEstiloRegistro);
					objCeldaSubtotal.innerHTML = intSubtotal;
					objCeldaIvaUnitario.setAttribute('class', 'movil d7 '+strEstiloRegistro);
					objCeldaIvaUnitario.innerHTML = intImporteIva;
					objCeldaIepsUnitario.setAttribute('class', 'movil d8 '+strEstiloRegistro);
					objCeldaIepsUnitario.innerHTML = intImporteIeps;
					objCeldaTotal.setAttribute('class', 'movil d9 '+strEstiloRegistro);
					objCeldaTotal.innerHTML = intTotal;
					objCeldaAcciones.setAttribute('class', 'td-center movil d10 '+strEstiloRegistro);
					objCeldaAcciones.innerHTML =strAccionesTablaDetalles;
					objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento;
					objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIva.innerHTML = arrDetalles[intCon].porcentaje_iva;
					objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
					objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
					objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
					objCeldaTipoReferencia.innerHTML = 'REFACCION';
					objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
					objCeldaTipoCambio.innerHTML = intTipoCambio;
					objCeldaPrecioRefaccion.setAttribute('class', 'no-mostrar');
					objCeldaPrecioRefaccion.innerHTML = intPrecioRefaccion;
					objCeldaCostoActual.setAttribute('class', 'no-mostrar');
					objCeldaCostoActual.innerHTML = intActualCosto;
					objCeldaDisponibleExistencia.setAttribute('class', 'no-mostrar');
	                objCeldaDisponibleExistencia.innerHTML = intDisponibleExistencia;
	                objCeldaCodigoSat.setAttribute('class', 'no-mostrar');
	                objCeldaCodigoSat.innerHTML = arrDetalles[intCon].codigo_sat;
	                objCeldaUnidadSat.setAttribute('class', 'no-mostrar');
	                objCeldaUnidadSat.innerHTML = arrDetalles[intCon].unidad_sat;
	                objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
	                objCeldaTasaCuotaIva.innerHTML = arrDetalles[intCon].tasa_cuota_iva;
	                objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
	                objCeldaTasaCuotaIeps.innerHTML = arrDetalles[intCon].tasa_cuota_ieps;
	                objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
					objCeldaCodigoLinea.innerHTML = arrDetalles[intCon].codigo_linea;
					objCeldaObjetoImpuestoSat.setAttribute('class', 'no-mostrar');
	                objCeldaObjetoImpuestoSat.innerHTML = arrDetalles[intCon].objeto_impuesto_sat;

				}//Cierre de verificación para agregar detalle

            }//Cierre de foreach


            //Si existen refacciones incorrectas
			if(arrDetallesIncorrectos.length > 0)
			{
				//Mensaje que se utiliza para informar al usuario la lista de refacciones incorrectas
				var strMensaje = 'No es posible agregar las siguientes <b>refacciones</b> porque el precio unitario (menos el descuento) no puede ser menor al costo actual:<br>';

				//Hacer recorrido para obtener refacciones incorrectas
				for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
				{
					//Agregar refacción en el mensaje
            		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
				}

				//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_facturas_refacciones_refacciones('error', strMensaje);

			}

            //Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_facturas_refacciones_refacciones();
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $('#dg_detalles_facturas_refacciones_refacciones tr').length - 2;
			$('#numElementos_detalles_facturas_refacciones_refacciones').html(intFilas);
			$('#txtNumDetalles_facturas_refacciones_refacciones').val(intFilas);
		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_facturas_refacciones_refacciones()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla cotizaciones_refacciones_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asignar el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;
			//Variable que se utiliza para agregar detalle en la tabla
			var strAgregar = 'NO';
			//Obtenemos los datos de las cajas de texto
			var intReferenciaID = $('#txtReferenciaID_detalles_facturas_refacciones_refacciones').val();
			var strReferencia = $('#txtReferencia_detalles_facturas_refacciones_refacciones').val();
			var strTipoReferencia = $('#txtTipoReferencia_detalles_facturas_refacciones_refacciones').val();
			var strCodigo = $('#txtCodigo_detalles_facturas_refacciones_refacciones').val();
			var strCodigoLinea = $('#txtCodigoLinea_detalles_facturas_refacciones_refacciones').val();
			var strDescripcion = $('#txtDescripcion_detalles_facturas_refacciones_refacciones').val();
			var intCantidad = $('#txtCantidad_detalles_facturas_refacciones_refacciones').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').val();			
			var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_facturas_refacciones_refacciones').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_facturas_refacciones_refacciones').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_facturas_refacciones_refacciones').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_facturas_refacciones_refacciones').val();
			var intTipoCambio = $('#txtTipoCambio_detalles_facturas_refacciones_refacciones').val();
			var intPrecioRefaccion = $('#txtPrecioRefaccion_detalles_facturas_refacciones_refacciones').val();
			var intActualCosto = $('#txtActualCosto_detalles_facturas_refacciones_refacciones').val();
			var intDisponibleExistencia = $('#txtDisponibleExistencia_detalles_facturas_refacciones_refacciones').val();
			var strCodigoSat = $('#txtCodigoSat_detalles_facturas_refacciones_refacciones').val();
			var strUnidadSat = $('#txtUnidadSat_detalles_facturas_refacciones_refacciones').val();
			var strObjetoImpuestoSat = $('#txtObjetoImpuestoSat_detalles_facturas_refacciones_refacciones').val();
			//Variable que se utiliza para asignar el tipo de cambio de la requisición
			var intTipoCambioFactura = parseFloat($('#txtTipoCambio_facturas_refacciones_refacciones').val());
			//Variable que se utiliza para asignar el tipo de cambio de la refacción
			var intMonedaIDFactura =  parseFloat($('#cmbMonedaID_facturas_refacciones_refacciones').val());

			//Variable que se utiliza para asignar el mensaje informativo
		    var strMensaje = 'No es posible agregar la refacción porque '; 

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_facturas_refacciones_refacciones').getElementsByTagName('tbody')[0];
			//Dependiendo del tipo de referencia validar los campos obligatorios
			if($('#txtTipoReferencia_detalles_facturas_refacciones_refacciones').val() == 'REFACCION')
			{
    			
				//Validamos que se capturaron datos
				if (intReferenciaID == '' || strReferencia == '')
				{
					//Enfocar caja de texto
					$('#txtReferencia_detalles_facturas_refacciones_refacciones').focus();
				}
				else if (intCantidad == '' || intCantidad <= 0)
				{
					//Enfocar caja de texto
					$('#txtCantidad_detalles_facturas_refacciones_refacciones').val('');
					$('#txtCantidad_detalles_facturas_refacciones_refacciones').focus();
				}
				else if (intPrecioUnitario == '' || intPrecioUnitario <= 0)
				{
					//Concatenar mensaje de validación
					strMensaje += ' no tiene un precio establecido.';

					//Hacer un llamado a la función para mostrar mensaje de información
                	mensaje_facturas_refacciones_refacciones('informacion', strMensaje,'txtPrecioUnitario_detalles_facturas_refacciones_refacciones');
				}
				else if (intPorcentajeDescuento == '')
				{

					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').focus();
				}
				else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
				{
					//Limpiar caja de texto
					$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').val('');
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').focus();
				}		
				else
				{	
					//Asignar SI para agregar el detalle
					strAgregar = 'SI';
				}
			}
			else
			{
				//Validamos que se capturaron datos
				if (intReferenciaID == '' || strReferencia == '')
				{
					//Enfocar caja de texto
					$('#txtReferencia_detalles_facturas_refacciones_refacciones').focus();
				}
				else if (intPorcentajeDescuento == '')
				{
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').focus();
				}
				else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
				{
					//Limpiar caja de texto
					$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').val('');
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').focus();
				}
				else
				{
					//Asignar SI para agregar el detalle
					strAgregar = 'SI';
				}


			}

			//Si se cumplen las reglas de validación
			if(strAgregar == 'SI')
			{
				//Convertir cadena de texto a número decimal
				intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
				intPrecioUnitario = parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
				intSubtotal =  intPrecioUnitario;
				intDisponibleExistencia = parseFloat(intDisponibleExistencia);
				//Asignar el costo actual de la refacción convertido al tipo de cambio
				var intActualCostoConv = parseFloat(intActualCosto);

			    //Si el tipo de referencia no corresponde a una refacción
				if(strTipoReferencia != 'REFACCION')
				{

					//Hacer un llamado a la función para inicializar elementos del detalle
					inicializar_detalle_facturas_refacciones_refacciones();

					//Hacer un llamado a la función para obtener las refacciones de la referencia
					lista_refacciones_referencia_detalles_facturas_refacciones_refacciones (intPorcentajeDescuento, intReferenciaID, strTipoReferencia, intCantidad);
				}
				else
				{


					//Si la moneda de la requisición no corresponde a peso mexicano
			        if(intMonedaIDFactura !== intMonedaBaseIDFacturasRefaccionesRefacciones )
			        {
			       		//Convertir peso mexicano a tipo de cambio
			       		intActualCostoConv = intActualCostoConv / intTipoCambioFactura;
			       		//Redondear cantidad a decimales
						intActualCostoConv = intActualCostoConv.toFixed(4);
						intActualCostoConv = parseFloat(intActualCostoConv);
			        }


			        //Si existe porcentaje de descuento
					if(intPorcentajeDescuento > 0)
					{
						//Calcular descuento unitario
						intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;
						
						//Redondear cantidad a decimales
					    intDescuentoUnitario = intDescuentoUnitario.toFixed(2);

					   //Decrementar descuento unitario
						intSubtotal = intSubtotal - intDescuentoUnitario;
						//Redondear cantidad a decimales
						intSubtotal = intSubtotal.toFixed(2);
						intSubtotal = parseFloat(intSubtotal);
					}

					//Si el precio es mayor al costo actual
					if((intSubtotal >= intActualCostoConv) && (intSubtotal > 0)
					   && (intCantidad <= intDisponibleExistencia))
					{

						//Hacer un llamado a la función para inicializar elementos del detalle
						inicializar_detalle_facturas_refacciones_refacciones();

						//Calcular subtotal
						intSubtotal = intCantidad * intSubtotal;
						//Redondear cantidad a decimales
						intSubtotal = intSubtotal.toFixed(2);
						intSubtotal = parseFloat(intSubtotal);

						//Calcular importe de IVA
						intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
						//Redondear cantidad a  decimales
					    intImporteIva = intImporteIva.toFixed(4);
					    intImporteIva = parseFloat(intImporteIva);
						

						//Si existe porcentaje de IEPS
						if(intPorcentajeIeps != '')
						{
							//Calcular importe de IEPS
							intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
							//Redondear cantidad a decimales
					   	 	intImporteIeps = intImporteIeps.toFixed(4);
					   	 	intImporteIeps = parseFloat(intImporteIeps);
						}
						

						//Calcular importe total
						intTotal = intSubtotal + intImporteIva + intImporteIeps;

						//Cambiar cantidad a  formato moneda (a visualizar)
						intCantidad =  formatMoney(intCantidad, 2, '');
						intPrecioUnitario = formatMoney(intPrecioUnitario, 2, '');
						intDescuentoUnitario = formatMoney(intDescuentoUnitario, 2, '');
						intSubtotal = formatMoney(intSubtotal, 2, '');
						intImporteIva = formatMoney(intImporteIva, 4, '');
						intImporteIeps = formatMoney(intImporteIeps, 4, '');
						intTotal = formatMoney(intTotal, 2, '');
						intPorcentajeDescuento = formatMoney(intPorcentajeDescuento, 2, '');


						//Revisamos si existe el ID proporcionado, si es así, editamos los datos
						if (objTabla.rows.namedItem(intReferenciaID))
						{
							
							objTabla.rows.namedItem(intReferenciaID).cells[2].innerHTML = intCantidad;
							objTabla.rows.namedItem(intReferenciaID).cells[3].innerHTML = intPrecioUnitario;
							objTabla.rows.namedItem(intReferenciaID).cells[4].innerHTML =  intDescuentoUnitario;
							objTabla.rows.namedItem(intReferenciaID).cells[5].innerHTML =  intSubtotal;
							objTabla.rows.namedItem(intReferenciaID).cells[6].innerHTML = intImporteIva;
							objTabla.rows.namedItem(intReferenciaID).cells[7].innerHTML = intImporteIeps;
							objTabla.rows.namedItem(intReferenciaID).cells[8].innerHTML = intTotal;
							objTabla.rows.namedItem(intReferenciaID).cells[10].innerHTML = intPorcentajeDescuento;
							objTabla.rows.namedItem(intReferenciaID).cells[11].innerHTML = intPorcentajeIva;
							objTabla.rows.namedItem(intReferenciaID).cells[12].innerHTML = intPorcentajeIeps;
							objTabla.rows.namedItem(intReferenciaID).cells[15].innerHTML = intPrecioRefaccion;
							objTabla.rows.namedItem(intReferenciaID).cells[16].innerHTML = intActualCosto;
							objTabla.rows.namedItem(intReferenciaID).cells[17].innerHTML = intDisponibleExistencia;
							objTabla.rows.namedItem(intReferenciaID).cells[18].innerHTML = strCodigoSat;
							objTabla.rows.namedItem(intReferenciaID).cells[19].innerHTML = strUnidadSat;
							objTabla.rows.namedItem(intReferenciaID).cells[20].innerHTML = intTasaCuotaIva;
							objTabla.rows.namedItem(intReferenciaID).cells[21].innerHTML = intTasaCuotaIeps;
							objTabla.rows.namedItem(intReferenciaID).cells[22].innerHTML = strCodigoLinea;
							objTabla.rows.namedItem(intReferenciaID).cells[23].innerHTML = strObjetoImpuestoSat;
							
						}
						else
						{
							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaCodigo = objRenglon.insertCell(0);
							var objCeldaDescripcion = objRenglon.insertCell(1);
							var objCeldaCantidad = objRenglon.insertCell(2);
							var objCeldaPrecioUnitario = objRenglon.insertCell(3);
							var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
							var objCeldaSubtotal = objRenglon.insertCell(5);
							var objCeldaIvaUnitario = objRenglon.insertCell(6);
							var objCeldaIepsUnitario = objRenglon.insertCell(7);
							var objCeldaTotal = objRenglon.insertCell(8);
							var objCeldaAcciones = objRenglon.insertCell(9);
							//Columnas ocultas
							var objCeldaPorcentajeDescuento = objRenglon.insertCell(10);
							var objCeldaPorcentajeIva = objRenglon.insertCell(11);
							var objCeldaPorcentajeIeps = objRenglon.insertCell(12);
							var objCeldaTipoReferencia = objRenglon.insertCell(13);
							var objCeldaTipoCambio = objRenglon.insertCell(14);
							var objCeldaPrecioRefaccion = objRenglon.insertCell(15);
							var objCeldaCostoActual = objRenglon.insertCell(16);
							var objCeldaDisponibleExistencia = objRenglon.insertCell(17);
							var objCeldaCodigoSat = objRenglon.insertCell(18);
							var objCeldaUnidadSat = objRenglon.insertCell(19);
							var objCeldaTasaCuotaIva = objRenglon.insertCell(20);
							var objCeldaTasaCuotaIeps = objRenglon.insertCell(21);
							var objCeldaCodigoLinea = objRenglon.insertCell(22);
							var objCeldaObjetoImpuestoSat = objRenglon.insertCell(23);

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', intReferenciaID);
							objCeldaCodigo.setAttribute('class', 'movil d1');
							objCeldaCodigo.innerHTML = strCodigo;
							objCeldaDescripcion.setAttribute('class', 'movil d2');
							objCeldaDescripcion.innerHTML = strDescripcion;
							objCeldaCantidad.setAttribute('class', 'movil d3');
							objCeldaCantidad.innerHTML = intCantidad;
							objCeldaPrecioUnitario.setAttribute('class', 'movil d4');
							objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
							objCeldaDescuentoUnitario.setAttribute('class', 'movil d5');
							objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
							objCeldaSubtotal.setAttribute('class', 'movil d6');
							objCeldaSubtotal.innerHTML = intSubtotal;
							objCeldaIvaUnitario.setAttribute('class', 'movil d7');
							objCeldaIvaUnitario.innerHTML = intImporteIva;
							objCeldaIepsUnitario.setAttribute('class', 'movil d8');
							objCeldaIepsUnitario.innerHTML = intImporteIeps;
							objCeldaTotal.setAttribute('class', 'movil d9');
							objCeldaTotal.innerHTML = intTotal;
							objCeldaAcciones.setAttribute('class', 'td-center movil d10');
							objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
														 " onclick='editar_renglon_detalles_facturas_refacciones_refacciones(this)'>" + 
														 "<span class='glyphicon glyphicon-edit'></span></button>" + 
														 "<button class='btn btn-default btn-xs' title='Eliminar'" +
														 " onclick='eliminar_renglon_detalles_facturas_refacciones_refacciones(this)'>" + 
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
							objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
							objCeldaTipoReferencia.innerHTML = strTipoReferencia;
							objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
							objCeldaTipoCambio.innerHTML = intTipoCambio;
							objCeldaPrecioRefaccion.setAttribute('class', 'no-mostrar');
							objCeldaPrecioRefaccion.innerHTML = intPrecioRefaccion;
							objCeldaCostoActual.setAttribute('class', 'no-mostrar');
							objCeldaCostoActual.innerHTML = intActualCosto;
							objCeldaDisponibleExistencia.setAttribute('class', 'no-mostrar');
	                        objCeldaDisponibleExistencia.innerHTML = intDisponibleExistencia;
	                        objCeldaCodigoSat.setAttribute('class', 'no-mostrar');
	                        objCeldaCodigoSat.innerHTML = strCodigoSat;
	                        objCeldaUnidadSat.setAttribute('class', 'no-mostrar');
	                        objCeldaUnidadSat.innerHTML = strUnidadSat;
	                        objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
							objCeldaTasaCuotaIva.innerHTML = intTasaCuotaIva;
							objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
							objCeldaTasaCuotaIeps.innerHTML =  intTasaCuotaIeps;
							objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
							objCeldaCodigoLinea.innerHTML =  strCodigoLinea;
							objCeldaObjetoImpuestoSat.setAttribute('class', 'no-mostrar');
							objCeldaObjetoImpuestoSat.innerHTML =  strObjetoImpuestoSat;

						}

						//Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_facturas_refacciones_refacciones();
						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $('#dg_detalles_facturas_refacciones_refacciones tr').length - 2;
						$('#numElementos_detalles_facturas_refacciones_refacciones').html(intFilas);
						$('#txtNumDetalles_facturas_refacciones_refacciones').val(intFilas);
						//Enfocar caja de texto
					    $('#txtReferencia_detalles_facturas_refacciones_refacciones').focus();
					}
					else
					{
					    //Si la cantidad es mayor que la existencia disponible 
	               	    if(intCantidad > intDisponibleExistencia)
	               	    {
		               	   	 //Cambiar cantidad a formato moneda
		                    intDisponibleExistencia = formatMoney(intDisponibleExistencia, 2, '');

		                    //Asignar existencia disponible 
		                    $('#txtCantidad_detalles_facturas_refacciones_refacciones').val(intDisponibleExistencia);

		                    //Hacer un llamado a la función para mostrar mensaje de información
		                    mensaje_facturas_refacciones_refacciones('informacion', 'La cantidad no debe exceder de ' + intDisponibleExistencia, 'txtCantidad_detalles_facturas_refacciones_refacciones');
	               	    }

	               	    //Si el precio unitario es menor al costo actual
	               	    if((intSubtotal < intActualCostoConv ) || (intSubtotal <= 0))
	               	    {

			                //Si el precio es menor o igual a cero
			                if(intSubtotal <= 0)
			                {
			                	//Concatenar mensaje de validación
					    		strMensaje +=' el precio unitario (menos el descuento) no puede ser 0.00';


			                	//Hacer un llamado a la función para mostrar mensaje de información
			                	mensaje_facturas_refacciones_refacciones('informacion', strMensaje, 'txtPrecioUnitario_detalles_facturas_refacciones_refacciones');
			                }
			                else
			                {
			                	//Cambiar cantidad a formato moneda
				                intActualCostoConv = formatMoney(intActualCostoConv, 2, '');

				                //Concatenar mensaje de validación
				                strMensaje += 'el precio unitario (menos el descuento) no puede ser menor al costo actual: ';
				                strMensaje += intActualCostoConv;

			                	//Hacer un llamado a la función para mostrar mensaje de información
		                   		 mensaje_facturas_refacciones_refacciones('informacion', strMensaje, 'txtPrecioUnitario_detalles_facturas_refacciones_refacciones');		
			                }
	               	    }

					}
				}
			}
		
		}

		//Función para inicializar elementos del detalle
		function inicializar_detalle_facturas_refacciones_refacciones() 
		{

			//Limpiar las siguientes cajas de texto
			$('#txtReferenciaID_detalles_facturas_refacciones_refacciones').val('');
			$('#txtReferencia_detalles_facturas_refacciones_refacciones').val('');
			$('#txtTipoReferencia_detalles_facturas_refacciones_refacciones').val('');
			$('#txtCodigo_detalles_facturas_refacciones_refacciones').val('');
			$('#txtCodigoLinea_detalles_facturas_refacciones_refacciones').val('');
			$('#txtDescripcion_detalles_facturas_refacciones_refacciones').val('');
			$('#txtCantidad_detalles_facturas_refacciones_refacciones').val('');
		    $('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').val('');
		    $('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').val('0.00');
		    $('#txtPorcentajeIva_detalles_facturas_refacciones_refacciones').val('');
		    $('#txtPorcentajeIeps_detalles_facturas_refacciones_refacciones').val('');
		    $('#txtTasaCuotaIva_detalles_facturas_refacciones_refacciones').val('');
		    $('#txtTasaCuotaIeps_detalles_facturas_refacciones_refacciones').val('');
		    $('#txtTipoCambio_detalles_facturas_refacciones_refacciones').val('');
		    $('#txtPrecioRefaccion_detalles_facturas_refacciones_refacciones').val('');
		    $('#txtActualCosto_detalles_facturas_refacciones_refacciones').val('');
		    $('#txtDisponibleExistencia_detalles_facturas_refacciones_refacciones').val('');
		    $('#txtCodigoSat_detalles_facturas_refacciones_refacciones').val('');
		    $('#txtUnidadSat_detalles_facturas_refacciones_refacciones').val('');
		    $('#txtObjetoImpuestoSat_detalles_facturas_refacciones_refacciones').val('');
		    //Habilitar las siguientes cajas de texto
		    $("#txtCantidad_detalles_facturas_refacciones_refacciones").removeAttr('disabled');
		   	//$("#txtPrecioUnitario_detalles_facturas_refacciones_refacciones").removeAttr('disabled');
		   	//Hacer un llamado a la función para habilitar precio unitario (dependiendo de la sucursal logeada)
		   	habilitar_precio_unitario_detalles_facturas_refacciones_refacciones(false);

		}


		//Función para la búsqueda de refacciones de la referencia
		function lista_refacciones_referencia_detalles_facturas_refacciones_refacciones(porcentajeDescuentoProm, referenciaID, tipoReferencia, cantidad) 
		{
			//Variable que se utiliza para asignar el tipo de cambio de la requisición
			var intTipoCambioFactura = parseFloat($('#txtTipoCambio_facturas_refacciones_refacciones').val());
			//Variable que se utiliza para asignar el tipo de cambio de la refacción
			var intMonedaIDFactura =  parseFloat($('#cmbMonedaID_facturas_refacciones_refacciones').val());
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_facturas_refacciones_refacciones').getElementsByTagName('tbody')[0];
		
			//Array que se utiliza para agregar las refacciones incorrectas
			var arrDetallesIncorrectos = [];

			//Variable que se utiliza para asignar las acciones del grid view
            var strAccionesTablaDetalles = '';

			//Si el tipo de referencia no corresponde a un Kit de refacciones
            if(tipoReferencia != 'KIT')
            {
            	//Agregar acción de Editar
				strAccionesTablaDetalles = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_detalles_facturas_refacciones_refacciones(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>";					 
            }

            //Variable que se utiliza para asignar las acciones del grid view
            strAccionesTablaDetalles +=  "<button class='btn btn-default btn-xs' title='Eliminar'" +
									     " onclick='eliminar_renglon_detalles_facturas_refacciones_refacciones(this)'>" + 
										 "<span class='glyphicon glyphicon-trash'></span></button>" + 
										 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
										 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
										 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
										 "<span class='glyphicon glyphicon-arrow-down'></span></button>";								 

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/refacciones/get_datos',
			       {intReferenciaID: referenciaID,
			       	strTipoReferencia: tipoReferencia, 
			       	strTipo: 'referencias',
			       	intRefaccionesListaPrecioID: $('#txtRefaccionesListaPrecioID_facturas_refacciones_refacciones').val(), 
			       	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día 
				    dteFechaTipoCambio: $.formatFechaMysql($('#txtFecha_facturas_refacciones_refacciones').val()),
				    //Regresar el precio que le corresponde al cliente
			       	strListaPrecioCte: 'SI'
			       },
			       function(data) {

			       	 	//Mostramos las refacciones del registro
			            for (var intCon in data.row) 
			            {
				       		//Variables que se utilizan para asignar valores del detalle
							var intSubtotal = 0;
							var intPrecioUnitario = 0;
							var intCantidad = 0;
							//Variable que se utiliza para asignar el tipo de referencia del detalle y poder modificar cantidad
							var strTipoReferenciaDet = tipoReferencia;
							var intRefaccionID =  data.row[intCon].refaccion_id;
							var strCodigo = data.row[intCon].codigo;
							var strDescripcion = data.row[intCon].descripcion;
							var intPrecioRefaccion = parseFloat(data.row[intCon].precio);
							var intDisponibleExistencia = parseFloat(data.row[intCon].disponible_existencia);
							var intPorcentajeIva = parseFloat(data.row[intCon].porcentaje_iva);
							var intPorcentajeIeps = data.row[intCon].porcentaje_ieps;
							var intTasaCuotaIva = data.row[intCon].tasa_cuota_iva;
							var intTasaCuotaIeps =  data.row[intCon].tasa_cuota_ieps;
							var intTipoCambioRefaccion = parseFloat(data.row[intCon].tipo_cambio_venta);
							var intActualCosto = data.row[intCon].actual_costo;
							var intPorcentajeDescuento = 0;
							var strCodigoSat = data.row[intCon].codigo_sat;
							var strUnidadSat = data.row[intCon].unidad_sat;
							var strObjetoImpuestoSat = data.row[intCon].objeto_impuesto_sat;
							var strCodigoLinea = data.row[intCon].codigo_linea;
							//Concatenar los datos de la referencia
						    var strReferencia = strCodigo+' - '+strDescripcion;
							//Asignar el costo actual de la refacción convertido al tipo de cambio
							var intActualCostoConv = parseFloat(intActualCosto); 
							//Variable que se utiliza para asignar el descuento unitario
							var intDescuentoUnitario = 0;
							//Variable que se utiliza para asignar el importe de iva
							var intImporteIva = 0;
							//Variable que se utiliza para asignar el importe de ieps
							var intImporteIeps = 0;
							//Variable que se utiliza para asignar el importe total
							var intTotal = 0;

							//Si el tipo de referencia corresponde a un KIT
							if(tipoReferencia == 'KIT')
							{
								//Asignar la cantidad de la refacción del KIT
								intCantidad = data.row[intCon].cantidad;
							}
							else
							{
								//Asignar la cantidad del detalle
								intCantidad = cantidad;
								//Cambiar el tipo de referencia del detalle para poder modificar la cantidad en caso de ser LINEA/MARCA
								strTipoReferenciaDet = 'REFACCION';
							}

							//Verificar que la cantidad sea menor o igual que la existencia disponible 
							if(intCantidad > intDisponibleExistencia)
							{
								//Asignar la existencia dispoble
								intCantidad = intDisponibleExistencia;
							}

							//Si existe descuento de la promoción
							if(porcentajeDescuentoProm > 0)
							{
								intPorcentajeDescuento = porcentajeDescuentoProm;
							}
							else
							{
								intPorcentajeDescuento = parseFloat(data.row[intCon].porcentaje_descuento);
							}

							//Si existe precio de la refacción
						    if(intPrecioRefaccion > 0 && intTipoCambioRefaccion > 0)
						    {
					   	  	    //Convertir importe a peso mexicano
						      	intPrecioUnitario = intPrecioRefaccion * intTipoCambioRefaccion;

						       	//Si la moneda de la refacción no corresponde a peso mexicano
						        if(intMonedaIDFactura !== intMonedaBaseIDFacturasRefaccionesRefacciones )
						        {
						       		//Convertir peso mexicano a tipo de cambio
						       		intPrecioUnitario = intPrecioUnitario / intTipoCambioFactura;
						       		intActualCostoConv = intActualCostoConv / intTipoCambioFactura;

						       		//Redondear cantidad a x decimales
						    		intActualCostoConv = intActualCostoConv.toFixed(4);
						    		intActualCostoConv = parseFloat(intActualCostoConv);

						    		intPrecioUnitario = intPrecioUnitario.toFixed(2);
						    		intPrecioUnitario = parseFloat(intPrecioUnitario);

						        }
						    }

						  

						    //Asignar el precio unitario
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

								//Redondear cantidad a decimales
								intSubtotal = intSubtotal.toFixed(2);
								intSubtotal = parseFloat(intSubtotal);
							}


							//Si el precio es mayor al costo actual
							if((intSubtotal >= intActualCostoConv) && (intSubtotal > 0))
							{
								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;
								//Redondear cantidad a decimales
								intSubtotal = intSubtotal.toFixed(2);
								intSubtotal = parseFloat(intSubtotal);

								//Calcular importe de IVA
								intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
								//Redondear cantidad a  decimales
							    intImporteIva = intImporteIva.toFixed(4);
							    intImporteIva = parseFloat(intImporteIva);
								
								
								//Si existe porcentaje de IEPS
								if(intPorcentajeIeps != '')
								{
									//Calcular importe de IEPS
									intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
									//Redondear cantidad a decimales
							   	 	intImporteIeps = intImporteIeps.toFixed(4);
							   	 	intImporteIeps = parseFloat(intImporteIeps);
								}
								
								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;

								//Cambiar cantidad a  formato moneda (a visualizar)
								intCantidad =  formatMoney(intCantidad, 2, '');
								intPrecioUnitario = formatMoney(intPrecioUnitario, 2, '');
								intDescuentoUnitario = formatMoney(intDescuentoUnitario, 2, '');
								intSubtotal = formatMoney(intSubtotal, 2, '');
								intImporteIva = formatMoney(intImporteIva, 4, '');
								intImporteIeps = formatMoney(intImporteIeps, 4, '');
								intTotal = formatMoney(intTotal, 2, '');
								intPorcentajeDescuento = formatMoney(intPorcentajeDescuento, 2, ''); 


								//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
								if (!objTabla.rows.namedItem(intRefaccionID))
								{
									//Insertamos el renglón con sus celdas en el objeto de la tabla
									var objRenglon = objTabla.insertRow();
									var objCeldaCodigo = objRenglon.insertCell(0);
									var objCeldaDescripcion = objRenglon.insertCell(1);
									var objCeldaCantidad = objRenglon.insertCell(2);
									var objCeldaPrecioUnitario = objRenglon.insertCell(3);
									var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
									var objCeldaSubtotal = objRenglon.insertCell(5);
									var objCeldaIvaUnitario = objRenglon.insertCell(6);
									var objCeldaIepsUnitario = objRenglon.insertCell(7);
									var objCeldaTotal = objRenglon.insertCell(8);
									var objCeldaAcciones = objRenglon.insertCell(9);
									//Columnas ocultas
									var objCeldaPorcentajeDescuento = objRenglon.insertCell(10);
									var objCeldaPorcentajeIva = objRenglon.insertCell(11);
									var objCeldaPorcentajeIeps = objRenglon.insertCell(12);
									var objCeldaTipoReferencia = objRenglon.insertCell(13);
									var objCeldaTipoCambio = objRenglon.insertCell(14);
									var objCeldaPrecioRefaccion = objRenglon.insertCell(15);
									var objCeldaCostoActual = objRenglon.insertCell(16);
									var objCeldaDisponibleExistencia = objRenglon.insertCell(17);
									var objCeldaCodigoSat = objRenglon.insertCell(18);
									var objCeldaUnidadSat = objRenglon.insertCell(19);
									var objCeldaTasaCuotaIva = objRenglon.insertCell(20);
									var objCeldaTasaCuotaIeps = objRenglon.insertCell(21);
									var objCeldaCodigoLinea = objRenglon.insertCell(22);
									var objCeldaObjetoImpuestoSat = objRenglon.insertCell(23);

									//Asignar valores
									objRenglon.setAttribute('class', 'movil');
									objRenglon.setAttribute('id', intRefaccionID);
									objCeldaCodigo.setAttribute('class', 'movil d1');
									objCeldaCodigo.innerHTML = strCodigo
									objCeldaDescripcion.setAttribute('class', 'movil d2');
									objCeldaDescripcion.innerHTML = strDescripcion;
									objCeldaCantidad.setAttribute('class', 'movil d3');
									objCeldaCantidad.innerHTML = intCantidad;
									objCeldaPrecioUnitario.setAttribute('class', 'movil d4');
									objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
									objCeldaDescuentoUnitario.setAttribute('class', 'movil d5');
									objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
									objCeldaSubtotal.setAttribute('class', 'movil d6');
									objCeldaSubtotal.innerHTML = intSubtotal;
									objCeldaIvaUnitario.setAttribute('class', 'movil d7');
									objCeldaIvaUnitario.innerHTML = intImporteIva;
									objCeldaIepsUnitario.setAttribute('class', 'movil d8');
									objCeldaIepsUnitario.innerHTML = intImporteIeps;
									objCeldaTotal.setAttribute('class', 'movil d9');
									objCeldaTotal.innerHTML = intTotal;
									objCeldaAcciones.setAttribute('class', 'td-center movil d10');
									objCeldaAcciones.innerHTML = strAccionesTablaDetalles;
									objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
									objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento; 
									objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
									objCeldaPorcentajeIva.innerHTML = data.row[intCon].porcentaje_iva; 
									objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
									objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
									objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
									objCeldaTipoReferencia.innerHTML = strTipoReferenciaDet;
									objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
									objCeldaTipoCambio.innerHTML = intTipoCambioRefaccion;
									objCeldaPrecioRefaccion.setAttribute('class', 'no-mostrar');
									objCeldaPrecioRefaccion.innerHTML = intPrecioRefaccion;
									objCeldaCostoActual.setAttribute('class', 'no-mostrar');
									objCeldaCostoActual.innerHTML = intActualCosto;
									objCeldaDisponibleExistencia.setAttribute('class', 'no-mostrar');
									objCeldaDisponibleExistencia.innerHTML = intDisponibleExistencia;
									objCeldaCodigoSat.setAttribute('class', 'no-mostrar');
									objCeldaCodigoSat.innerHTML = strCodigoSat;
									objCeldaUnidadSat.setAttribute('class', 'no-mostrar');
									objCeldaUnidadSat.innerHTML = strUnidadSat;
									objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
									objCeldaTasaCuotaIva.innerHTML = intTasaCuotaIva;
									objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
									objCeldaTasaCuotaIeps.innerHTML = intTasaCuotaIeps;
									objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
									objCeldaCodigoLinea.innerHTML = strCodigoLinea;
									objCeldaObjetoImpuestoSat.setAttribute('class', 'no-mostrar');
	                				objCeldaObjetoImpuestoSat.innerHTML = strObjetoImpuestoSat;
								}
								else
								{

									objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = intCantidad;
									objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML = intPrecioUnitario;
									objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML =  intDescuentoUnitario;
									objTabla.rows.namedItem(intRefaccionID).cells[5].innerHTML =  intSubtotal;
									objTabla.rows.namedItem(intRefaccionID).cells[6].innerHTML = intImporteIva;
									objTabla.rows.namedItem(intRefaccionID).cells[7].innerHTML = intImporteIeps;
									objTabla.rows.namedItem(intRefaccionID).cells[8].innerHTML = intTotal;
									objTabla.rows.namedItem(intRefaccionID).cells[9].innerHTML = strAccionesTablaDetalles;
									objTabla.rows.namedItem(intRefaccionID).cells[10].innerHTML = intPorcentajeDescuento;
									objTabla.rows.namedItem(intRefaccionID).cells[11].innerHTML = intPorcentajeIva;
									objTabla.rows.namedItem(intRefaccionID).cells[12].innerHTML = intPorcentajeIeps;
									objTabla.rows.namedItem(intRefaccionID).cells[13].innerHTML = strTipoReferenciaDet;
									objTabla.rows.namedItem(intRefaccionID).cells[15].innerHTML = intPrecioRefaccion;
									objTabla.rows.namedItem(intRefaccionID).cells[16].innerHTML = intActualCosto;
									objTabla.rows.namedItem(intRefaccionID).cells[17].innerHTML = intDisponibleExistencia;
									objTabla.rows.namedItem(intRefaccionID).cells[18].innerHTML = strCodigoSat;
									objTabla.rows.namedItem(intRefaccionID).cells[19].innerHTML = strUnidadSat;
									objTabla.rows.namedItem(intRefaccionID).cells[20].innerHTML = intTasaCuotaIva;
									objTabla.rows.namedItem(intRefaccionID).cells[21].innerHTML = intTasaCuotaIeps;
									objTabla.rows.namedItem(intRefaccionID).cells[22].innerHTML = strCodigoLinea;
									objTabla.rows.namedItem(intRefaccionID).cells[23].innerHTML = strObjetoImpuestoSat;

								}

							}
							else
							{

								//Si se cumple la sentencia
								if((intSubtotal < intActualCostoConv) || (intSubtotal <= 0))
								{
									//Agregar refacción en el array, de esta manera, el usuario identificara las refacciones incorrectas
									arrDetallesIncorrectos.push(strReferencia);
								}
								
							}

						}//Cierre de foreach	


						//Si existen refacciones incorrectas
						if(arrDetallesIncorrectos.length > 0)
						{
							//Mensaje que se utiliza para informar al usuario la lista de refacciones incorrectas
							var strMensaje = 'No es posible agregar las siguientes <b>refacciones</b> porque no tienen precio unitario (0.00) o el precio unitario (menos el descuento) no puede ser menor al costo actual:<br>';

							//Hacer recorrido para obtener refacciones incorrectas
							for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
							{
								//Agregar refacción en el mensaje
			            		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
							}

							//Hacer un llamado a la función para mostrar mensaje de error
							mensaje_facturas_refacciones_refacciones('error', strMensaje);

						}
			       		
			       		//Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_facturas_refacciones_refacciones();
						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $('#dg_detalles_facturas_refacciones_refacciones tr').length - 2;
						$('#numElementos_detalles_facturas_refacciones_refacciones').html(intFilas);
						$('#txtNumDetalles_facturas_refacciones_refacciones').val(intFilas);

			       	 },
			       'json');
		}


		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_facturas_refacciones_refacciones(objRenglon)
		{
			//Variables que se utilizan para concatenar los datos de la referencia
			var strCodigo = objRenglon.parentNode.parentNode.cells[0].innerHTML;
			var strDescripcion = objRenglon.parentNode.parentNode.cells[1].innerHTML;
			var strReferencia = strCodigo+' - '+strDescripcion;
			var strTipoReferencia = objRenglon.parentNode.parentNode.cells[13].innerHTML;

			//Hacer un llamado a la función para inicializar elementos de la referencia (KIT/REFACCION/LINEA/MARCA)
	        inicializar_refaccion_detalles_facturas_refacciones_refacciones(strTipoReferencia);

			//Asignar los valores a las cajas de texto
			$('#txtReferenciaID_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtReferencia_detalles_facturas_refacciones_refacciones').val(strReferencia);
			$('#txtCodigo_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidad_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIva_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtPorcentajeIeps_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtTipoReferencia_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtTipoCambio_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);
			$('#txtPrecioRefaccion_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[15].innerHTML);
			$('#txtActualCosto_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[16].innerHTML);
			$('#txtDisponibleExistencia_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[17].innerHTML);
			$('#txtCodigoSat_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[18].innerHTML);
			$('#txtUnidadSat_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[19].innerHTML);
			$('#txtTasaCuotaIva_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[20].innerHTML);
			$('#txtTasaCuotaIeps_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[21].innerHTML);
			$('#txtCodigoLinea_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[22].innerHTML);
			$('#txtObjetoImpuestoSat_detalles_facturas_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[23].innerHTML);

			//Enfocar caja de texto
			$('#txtReferencia_detalles_facturas_refacciones_refacciones').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_facturas_refacciones_refacciones(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_facturas_refacciones_refacciones").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_facturas_refacciones_refacciones();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $('#dg_detalles_facturas_refacciones_refacciones tr').length - 2;
			$('#numElementos_detalles_facturas_refacciones_refacciones').html(intFilas);
			$('#txtNumDetalles_facturas_refacciones_refacciones').val(intFilas);

			//Enfocar caja de texto
			$('#txtReferencia_detalles_facturas_refacciones_refacciones').focus();
		}

		//Función para recalcular los importes de los detalles de la tabla 
		function recalcular_importes_detalles_facturas_refacciones_refacciones()
		{
			//Variable que se utiliza para asignar el tipo de cambio de la requisición
			var intTipoCambioFactura = parseFloat($('#txtTipoCambio_facturas_refacciones_refacciones').val());
			//Variable que se utiliza para asignar el tipo de cambio de la refacción
			var intMonedaIDFactura =  parseFloat($('#cmbMonedaID_facturas_refacciones_refacciones').val());

			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_facturas_refacciones_refacciones').getElementsByTagName('tbody')[0];

			//Verificamos que al menos exista un detalle agregado en el GRID de detalles
			if(objTabla.rows.length > 0){

				//Recorrer los renglones de la tabla para obtener los valores
				for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
				{
					//Variables que se utilizan para asignar valores del detalle
					var intSubtotal = 0;
					var intPrecioUnitario = 0;
					var intRefaccionID =  objRen.getAttribute('id');
					var intCantidad =  parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
					var intPorcentajeDescuento = parseFloat(objRen.cells[10].innerHTML);
					var intPorcentajeIva = parseFloat(objRen.cells[11].innerHTML);
					var intPorcentajeIeps = parseFloat(objRen.cells[12].innerHTML);
					var intTipoCambioRefaccion = parseFloat(objRen.cells[14].innerHTML);
					var intPrecioRefaccion = parseFloat(objRen.cells[15].innerHTML);
					//Variable que se utiliza para asignar el descuento unitario
					var intDescuentoUnitario = 0;
					//Variable que se utiliza para asignar el importe de iva
					var intImporteIva = 0;
					//Variable que se utiliza para asignar el importe de ieps
					var intImporteIeps = 0;
					//Variable que se utiliza para asignar el importe total
					var intTotal = 0;
							

					//Si existe precio de la refacción
				    if(intPrecioRefaccion > 0 && intTipoCambioRefaccion > 0)
				    {
			   	  	    //Convertir importe a peso mexicano
				      	intPrecioUnitario = intPrecioRefaccion * intTipoCambioRefaccion;

				       	//Si la moneda de la refacción no corresponde a peso mexicano
				        if(intMonedaIDFactura !== intMonedaBaseIDFacturasRefaccionesRefacciones )
				        {
				       		//Convertir peso mexicano a tipo de cambio
				       		intPrecioUnitario = intPrecioUnitario / intTipoCambioFactura;
				       		//Redondear cantidad a x decimales
				    		intPrecioUnitario = intPrecioUnitario.toFixed(2);
				    		intPrecioUnitario = parseFloat(intPrecioUnitario);
				        }
				    }

				    //Asignar el precio unitario
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

					//Si existe porcentaje de IVA
					if(intPorcentajeIva > 0)
					{
						//Calcular importe de IVA
						intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
						//Redondear cantidad a  decimales
					    intImporteIva = intImporteIva.toFixed(4);
					    intImporteIva = parseFloat(intImporteIva);
					}
					
					//Si existe porcentaje de IEPS
					if(intPorcentajeIeps > 0)
					{
						//Calcular importe de IEPS
						intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
						//Redondear cantidad a decimales
				   	 	intImporteIeps = intImporteIeps.toFixed(4);
				   	 	intImporteIeps = parseFloat(intImporteIeps);
					}
					
					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;


					//Cambiar cantidad a  formato moneda (a visualizar)
					intCantidad =  formatMoney(intCantidad, 2, '');
					intPrecioUnitario = formatMoney(intPrecioUnitario, 2, '');
					intDescuentoUnitario = formatMoney(intDescuentoUnitario, 2, '');
					intSubtotal = formatMoney(intSubtotal, 2, '');
					intImporteIva = formatMoney(intImporteIva, 4, '');
					intImporteIeps = formatMoney(intImporteIeps, 4, '');
					intTotal = formatMoney(intTotal, 2, '');

					//Revisamos si existe el ID proporcionado, si es así, editamos los datos
					objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = intCantidad;
					objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML =  intPrecioUnitario;
					objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML =  intDescuentoUnitario;
					objTabla.rows.namedItem(intRefaccionID).cells[5].innerHTML =  intSubtotal;
					objTabla.rows.namedItem(intRefaccionID).cells[6].innerHTML = intImporteIva;
					objTabla.rows.namedItem(intRefaccionID).cells[7].innerHTML = intImporteIeps;
					objTabla.rows.namedItem(intRefaccionID).cells[8].innerHTML = intTotal;
				}

				//Hacer un llamado a la función para calcular totales de la tabla
			    calcular_totales_detalles_facturas_refacciones_refacciones();
			}
	
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_facturas_refacciones_refacciones()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_facturas_refacciones_refacciones').getElementsByTagName('tbody')[0];

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
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[8].innerHTML, ",", ""));

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
			$('#acumCantidad_detalles_facturas_refacciones_refacciones').html(intAcumUnidades);
			$('#acumDescuento_detalles_facturas_refacciones_refacciones').html(intAcumDescuento);
			$('#acumSubtotal_detalles_facturas_refacciones_refacciones').html(intAcumSubtotal);
			$('#acumIva_detalles_facturas_refacciones_refacciones').html(intAcumIva);
			$('#acumIeps_detalles_facturas_refacciones_refacciones').html(intAcumIeps);
			$('#acumTotal_detalles_facturas_refacciones_refacciones').html(intAcumTotal);
		}

		//Función para calcular el precio unitario del detalle
		function calcular_precio_unitario_detalles_facturas_refacciones_refacciones()
		{
		   //Variable que se utiliza para asignar el tipo de cambio de la requisición
		   var intTipoCambioFactura = parseFloat($('#txtTipoCambio_facturas_refacciones_refacciones').val());
		   //Variable que se utiliza para asignar el tipo de cambio de la refacción
		   var intMonedaIDFactura =  parseFloat($('#cmbMonedaID_facturas_refacciones_refacciones').val());
		   //Variable que se utiliza para asignar el tipo de cambio de la refacción
		   var intTipoCambioRefaccion = parseFloat($.reemplazar($('#txtTipoCambio_detalles_facturas_refacciones_refacciones').val(), ",", ""));
		   //Variable que se utiliza para asignar el precio de la refacción
		   var intPrecioRefaccion = parseFloat($.reemplazar($('#txtPrecioRefaccion_detalles_facturas_refacciones_refacciones').val(), ",", ""));
		   //Variable que se utiliza para asignar el precio unitario
		   var intPrecioUnitario = 0;

		   //Si existe precio de la refacción
		   if(intPrecioRefaccion > 0 && intTipoCambioRefaccion > 0)
		   {
	   	  	    //Convertir importe a peso mexicano
		      	intPrecioUnitario = intPrecioRefaccion * intTipoCambioRefaccion;

		       	//Si la moneda de la refacción no corresponde a peso mexicano
		        if(intMonedaIDFactura !== intMonedaBaseIDFacturasRefaccionesRefacciones )
		        {
		        	//Si existe tipo de cambio de la factura
		        	if(intTipoCambioFactura > 0)
		        	{

			       		//Convertir peso mexicano a tipo de cambio
			       		intPrecioUnitario = intPrecioUnitario / intTipoCambioFactura;
			       	}
			       	else
			       	{
			       		intPrecioUnitario = 0;
			       	}
		        }

		        //Cambiar el precio unitario del detalle
		   		$('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').val(intPrecioUnitario);
       	    	//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
           		$('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
		   } 	
		   
		}

		//Función para recalcular el precio unitario del detalle
		function recalcular_precio_unitario_facturas_refacciones_refacciones(strCampoID)
		{
			//Si existe id del prospecto
            if($("#txtProspectoID_facturas_refacciones_refacciones").val() !== '')
            {
	        	//Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
				habilitar_elementos_tipo_cambio_detalles_facturas_refacciones_refacciones(strCampoID);
			}

        	//Hacer un llamado a la función para calcular el precio unitario
		  	calcular_precio_unitario_detalles_facturas_refacciones_refacciones();
        	//Hacer un llamado a la función para recalcular los importes
		  	recalcular_importes_detalles_facturas_refacciones_refacciones();
		}


		//Función para habilitar y deshabilitar los campos del detalle cuando cambia el tipo de cambio
		function habilitar_elementos_tipo_cambio_detalles_facturas_refacciones_refacciones(campo){
			//Deshabilitar o habilitar las siguientes cajas de texto			
			data  = {
						//Son los id de los input que quiere deshabilitar o habilitar
						rows:[
							'#txtReferencia_detalles_facturas_refacciones_refacciones',
							'#txtCantidad_detalles_facturas_refacciones_refacciones',
							//'#txtPrecioUnitario_detalles_facturas_refacciones_refacciones',
							//'#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones'								
						],
						//Es asignar un attributo disbaled|checked
						attribute: 'disabled',									
					};						
			($(campo).val() && $('#txtTipoCambio_facturas_refacciones_refacciones').val())? data.bool = false: data.bool= true;								
			//La function para deshabilitar o abilitar el input porque les estamos mando un true		
			$.habilitar_deshabilitar_campos(data);

		    //Hacer un llamado a la función para habilitar precio unitario (dependiendo de la sucursal logeada)
		   	habilitar_precio_unitario_detalles_facturas_refacciones_refacciones(data.bool);
		}


		//Función habilitar y/o deshabilitar el campo precio unitario del detalle dependiendo de la sucursal seleccionada (logeada)
		function habilitar_precio_unitario_detalles_facturas_refacciones_refacciones(boolDesHabilitar)
		{

			//NOTA: usar esta sentencia para desbloquear precio unitario para todas las sucursales
			/*if(intSucursalIDLogeadaFacturasRefaccionesRefacciones == intSucursalIDEXPOCNHFacturasRefaccionesRefacciones ||
				intSucursalIDLogeadaFacturasRefaccionesRefacciones !=intSucursalIDEXPOCNHFacturasRefaccionesRefacciones)*/

			//Si la sucursal logeada (seleccionada) corresponde a sucursales de EXPO
			if((intSucursalIDLogeadaFacturasRefaccionesRefacciones == intSucursalIDEXPOCNHFacturasRefaccionesRefacciones) || 
				(intSucursalIDLogeadaFacturasRefaccionesRefacciones == intSucursalIDEXPOAgrocisaFacturasRefaccionesRefacciones))
			{
				//Si se cumple la sentencia
				if(boolDesHabilitar == false)
				{
					//Habilitar caja de texto (precio unitario)
					$("#txtPrecioUnitario_detalles_facturas_refacciones_refacciones").removeAttr('disabled');
				}
				else
				{
					//Deshabilitar caja de texto (precio unitario)
					$("#txtPrecioUnitario_detalles_facturas_refacciones_refacciones").attr('disabled','disabled');
				}
				
			}
		}



		/*******************************************************************************************************************
		Funciones de la tabla CFDI relacionados
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_cfdi_relacionados_cliente_facturas_refacciones_refacciones(tipoAccion, estatus)
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Si se cumple la sentencia
			if(estatus == '' || estatus == 'TIMBRAR')
			{
				strAccionesTabla = "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_cfdi_relacionados_facturas_refacciones_refacciones(this)'>" + 
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
							intReferenciaID: $('#txtFacturaRefaccionesID_facturas_refacciones_refacciones').val(),
							strTipoReferencia: strTipoReferenciaFacturasRefaccionesRefacciones
						},
						function(data){

							//Mostramos los CFDI relacionados (facturas seleccionadas)
				           	for (var intCon in data.rows) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_cfdi_relacionados_facturas_refacciones_refacciones').getElementsByTagName('tbody')[0];

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
							var intFilas = $("#dg_cfdi_relacionados_facturas_refacciones_refacciones tr").length - 1;
							$('#numElementos_cfdi_relacionados_facturas_refacciones_refacciones').html(intFilas);
							$('#txtNumCfdiRelacionados_facturas_refacciones_refacciones').val(intFilas);
						},
				'json');
			}
			else
			{				
				//Mostramos los CFDI relacionados (facturas seleccionadas)
				for (var intCon in objCfdisRelacionadosFacturasRefaccionesRefacciones.getCfdis()) 
	            {
	            	//Crear instancia del objeto CFDI a relacionar 
	            	objCfdiRelacionarFacturasRefaccionesRefacciones = new CfdiRelacionarFacturasRefaccionesRefacciones();
	            	//Asignar datos del CFDI corespondiente al indice
	            	objCfdiRelacionarFacturasRefaccionesRefacciones = objCfdisRelacionadosFacturasRefaccionesRefacciones.getCfdi(intCon);
	            	
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_cfdi_relacionados_facturas_refacciones_refacciones').getElementsByTagName('tbody')[0];

					//Variable que se utiliza para asignar el id del detalle
					var strDetalleID =  objCfdiRelacionarFacturasRefaccionesRefacciones.intReferenciaID+'_'+objCfdiRelacionarFacturasRefaccionesRefacciones.strTipoReferencia;

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
						objCeldaCliente.innerHTML = objCfdiRelacionarFacturasRefaccionesRefacciones.strCliente;
						objCeldaFolio.setAttribute('class', 'movil c2');
						objCeldaFolio.innerHTML = objCfdiRelacionarFacturasRefaccionesRefacciones.strFolio;
						objCeldaFecha.setAttribute('class', 'movil c3');
						objCeldaFecha.innerHTML = objCfdiRelacionarFacturasRefaccionesRefacciones.dteFecha;
						objCeldaModulo.setAttribute('class', 'movil c4');
						objCeldaModulo.innerHTML = objCfdiRelacionarFacturasRefaccionesRefacciones.strTipoReferencia;
						objCeldaUuid.setAttribute('class', 'movil c5');
						objCeldaUuid.innerHTML =  objCfdiRelacionarFacturasRefaccionesRefacciones.strUuid;
						objCeldaImporte.setAttribute('class', 'movil c6');
						objCeldaImporte.innerHTML = objCfdiRelacionarFacturasRefaccionesRefacciones.intImporte;
						objCeldaAcciones.setAttribute('class', 'td-center movil c7');
						objCeldaAcciones.innerHTML = strAccionesTabla;
						objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
						objCeldaReferenciaID.innerHTML = objCfdiRelacionarFacturasRefaccionesRefacciones.intReferenciaID;
					}
	            }

	            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
				var intFilas = $("#dg_cfdi_relacionados_facturas_refacciones_refacciones tr").length - 1;
				$('#numElementos_cfdi_relacionados_facturas_refacciones_refacciones').html(intFilas);
				$('#txtNumCfdiRelacionados_facturas_refacciones_refacciones').val(intFilas);
			}
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_cfdi_relacionados_facturas_refacciones_refacciones(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_cfdi_relacionados_facturas_refacciones_refacciones").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
			var intFilas = $("#dg_cfdi_relacionados_facturas_refacciones_refacciones tr").length - 1;
			$('#numElementos_cfdi_relacionados_facturas_refacciones_refacciones').html(intFilas);
			$('#txtNumCfdiRelacionados_facturas_refacciones_refacciones').val(intFilas);
		}

		
		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Facturas
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_facturas_refacciones_refacciones').numeric();
			$('#txtGastosPaqueteria_facturas_refacciones_refacciones').numeric();
			$('#txtCantidad_detalles_facturas_refacciones_refacciones').numeric();
			$('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').numeric();
        	$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').numeric();
        	$('#txtPorcentajeIva_detalles_facturas_refacciones_refacciones').numeric();
        	$('#txtPorcentajeIeps_detalles_facturas_refacciones_refacciones').numeric();


        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_facturas_refacciones_refacciones').blur(function(){
				$('.moneda_facturas_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
			});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_facturas_refacciones_refacciones').blur(function(){
                $('.tipo-cambio_facturas_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_facturas_refacciones_refacciones').blur(function(){
                $('.cantidad_facturas_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_facturas_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});

			//Calcular fecha de vencimiento cuando cambie la fecha
			$('#dteFecha_facturas_refacciones_refacciones').on('dp.change', function (e) {
         		
             	//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_facturas_refacciones_refacciones();
			});

			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_facturas_refacciones_refacciones').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_facturas_refacciones_refacciones').val()) === intMonedaBaseIDFacturasRefaccionesRefacciones)
             	{
             		//Deshabilitar caja de texto
					$('#txtTipoCambio_facturas_refacciones_refacciones').attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_facturas_refacciones_refacciones').val(intTipoCambioMonedaBaseFacturasRefaccionesRefacciones);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_facturas_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
					//Hacer un llamado a la función para recalcular los importes y habilitar/deshabilitar campos
	                recalcular_precio_unitario_facturas_refacciones_refacciones('#cmbMonedaID_facturas_refacciones_refacciones');
             	}
             	else
             	{
             		//Habilitar caja de texto
					$('#txtTipoCambio_facturas_refacciones_refacciones').removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_facturas_refacciones_refacciones').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_facturas_refacciones_refacciones();
             	}
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_facturas_refacciones_refacciones').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_facturas_refacciones_refacciones').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoFacturasRefaccionesRefacciones)
	        	{
	        		$('#txtTipoCambio_facturas_refacciones_refacciones').val(intTipoCambioMaximoFacturasRefaccionesRefacciones);
	        	}

	        	//Hacer un llamado a la función para recalcular los importes y habilitar/deshabilitar campos
	            recalcular_precio_unitario_facturas_refacciones_refacciones('#txtTipoCambio_facturas_refacciones_refacciones');

		    });

	        //Autocomplete para recuperar los datos de una cotización de refacciones
	        $('#txtCotizacionRefacciones_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtReferenciaID_facturas_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la referencia (cotización/pedido/remision)
	               inicializar_referencia_facturas_refacciones_refacciones('COTIZACION');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/cotizaciones_refacciones/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'cliente'
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
		              $('#txtReferenciaID_facturas_refacciones_refacciones').val(ui.item.data);
		              //Hacer un llamado a la función para regresar los datos de la cotización
		           	  get_datos_cotizacion_facturas_refacciones_refacciones();
	           	  }
	              else
	              {
	             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				     mensaje_facturas_refacciones_refacciones('error_regimen_fiscal','','txtCotizacionRefacciones_facturas_refacciones_refacciones');
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
	        
			//Verificar que exista id de la cotización cuando pierda el enfoque la caja de texto
	        $('#txtCotizacionRefacciones_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la cotización
	            if($('#txtReferenciaID_facturas_refacciones_refacciones').val() == '' ||
	                $('#txtCotizacionRefacciones_facturas_refacciones_refacciones').val() == '')
	            	
	            { 
		            //Limpiar contenido de la caja de texto
		            $('#txtCotizacionRefacciones_facturas_refacciones_refacciones').val('');
		             
		           
	            }

	        });

	        //Autocomplete para recuperar los datos de un pedido de refacciones
	        $('#txtPedidoRefacciones_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtReferenciaID_facturas_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la referencia (cotización/pedido/remision)
	               inicializar_referencia_facturas_refacciones_refacciones('PEDIDO');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/pedidos_refacciones/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strTipo: 'cliente'
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
			              $('#txtReferenciaID_facturas_refacciones_refacciones').val(ui.item.data);
			               //Hacer un llamado a la función para regresar los datos del pedido
			           	   get_datos_pedido_facturas_refacciones_refacciones();
		           	 }
		             else
		             {
		             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					     mensaje_facturas_refacciones_refacciones('error_regimen_fiscal','', 'txtPedidoRefacciones_facturas_refacciones_refacciones');
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
	        $('#txtPedidoRefacciones_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del pedido
	            if($('#txtReferenciaID_facturas_refacciones_refacciones').val() == '' ||
	               $('#txtPedidoRefacciones_facturas_refacciones_refacciones').val() == '')
	            	
	            { 
	               //Limpiar contenido de la caja de texto
	               $('#txtPedidoRefacciones_facturas_refacciones_refacciones').val('');
	              


	            }
	        });

	        //Autocomplete para recuperar los datos de una remisión de refacciones
	        $('#txtRemisionRefacciones_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtReferenciaID_facturas_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la referencia (cotización/pedido/remision)
	               inicializar_referencia_facturas_refacciones_refacciones('REMISION');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/remisiones_refacciones/autocomplete",
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
		              $('#txtReferenciaID_facturas_refacciones_refacciones').val(ui.item.data);
		               //Hacer un llamado a la función para regresar los datos de la remisión
		           	   get_datos_remision_facturas_refacciones_refacciones();
	           	 }
	             else
	             {
	             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				     mensaje_facturas_refacciones_refacciones('error_regimen_fiscal','', 'txtRemisionRefacciones_facturas_refacciones_refacciones');
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
	        
			//Verificar que exista id de la remisión cuando pierda el enfoque la caja de texto
	        $('#txtRemisionRefacciones_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la remisión
	            if($('#txtReferenciaID_facturas_refacciones_refacciones').val() == '' ||
	               $('#txtRemisionRefacciones_facturas_refacciones_refacciones').val() == '')
	            { 
	                //Limpiar contenido de la caja de texto
	                $('#txtRemisionRefacciones_facturas_refacciones_refacciones').val('');
	                
	            }
	        });

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_facturas_refacciones_refacciones').val('');
	                //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_facturas_refacciones_refacciones();
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
	           		  $('#txtProspectoID_facturas_refacciones_refacciones').val(ui.item.data);
	             	  //Hacer un llamado a la función para regresar los datos del cliente
	           	 	  get_datos_cliente_facturas_refacciones_refacciones();
	             }
	             else
	             {
	             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				     mensaje_facturas_refacciones_refacciones('error_regimen_fiscal','','txtRazonSocial_facturas_refacciones_refacciones');
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
	        $('#txtRazonSocial_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_facturas_refacciones_refacciones').val() == '' ||
	               $('#txtRazonSocial_facturas_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_facturas_refacciones_refacciones').val('');
	               $('#txtRazonSocial_facturas_refacciones_refacciones').val('');
                   //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_facturas_refacciones_refacciones();
	            }
	        });


	        //Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorID_facturas_refacciones_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: intModuloIDFacturasRefaccionesRefacciones
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorID_facturas_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtVendedor_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_facturas_refacciones_refacciones').val() == '' ||
	               $('#txtVendedor_facturas_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_facturas_refacciones_refacciones').val('');
	               $('#txtVendedor_facturas_refacciones_refacciones').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una estrategia
	        $('#txtEstrategia_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEstrategiaID_facturas_refacciones_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/estrategias/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: intModuloIDFacturasRefaccionesRefacciones
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtEstrategiaID_facturas_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtEstrategia_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la estrategia
	            if($('#txtEstrategiaID_facturas_refacciones_refacciones').val() == '' ||
	               $('#txtEstrategia_facturas_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEstrategiaID_facturas_refacciones_refacciones').val('');
	               $('#txtEstrategia_facturas_refacciones_refacciones').val('');
	            }
	            
	        });

	        //Calcular el IVA desglosado despues de capturar Gastos de paqueteria
	        $('#txtGastosPaqueteria_facturas_refacciones_refacciones').focusout(function(e){

	           	//Hacer un llamado a la función para desglosar el IVA del gasto de paquetería
	       	   $.desglosarIvaGasto(arrDesglosarIvaGastoFacturasRefaccionesRefacciones);

	        });

	        //Autocomplete para recuperar los datos de una forma de pago
	        $('#txtFormaPago_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtFormaPagoID_facturas_refacciones_refacciones').val('');
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
	             $('#txtFormaPagoID_facturas_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtFormaPago_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la forma de pago
	            if($('#txtFormaPagoID_facturas_refacciones_refacciones').val() == '' ||
	               $('#txtFormaPago_facturas_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtFormaPagoID_facturas_refacciones_refacciones').val('');
	               $('#txtFormaPago_facturas_refacciones_refacciones').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un método de pago
	        $('#txtMetodoPago_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMetodoPagoID_facturas_refacciones_refacciones').val('');
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
	             $('#txtMetodoPagoID_facturas_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtMetodoPago_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del método de pago
	            if($('#txtMetodoPagoID_facturas_refacciones_refacciones').val() == '' ||
	               $('#txtMetodoPago_facturas_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMetodoPagoID_facturas_refacciones_refacciones').val('');
	               $('#txtMetodoPago_facturas_refacciones_refacciones').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un uso del CFDI
	        $('#txtUsoCfdi_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtUsoCfdiID_facturas_refacciones_refacciones').val('');
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
	             $('#txtUsoCfdiID_facturas_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtUsoCfdi_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del uso de CFDI
	            if($('#txtUsoCfdiID_facturas_refacciones_refacciones').val() == '' ||
	               $('#txtUsoCfdi_facturas_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUsoCfdiID_facturas_refacciones_refacciones').val('');
	               $('#txtUsoCfdi_facturas_refacciones_refacciones').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un tipo de relación
	        $('#txtTipoRelacion_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTipoRelacionID_facturas_refacciones_refacciones').val('');
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
	             $('#txtTipoRelacionID_facturas_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtTipoRelacion_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtTipoRelacionID_facturas_refacciones_refacciones').val() == '' ||
	               $('#txtTipoRelacion_facturas_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTipoRelacionID_facturas_refacciones_refacciones').val('');
	               $('#txtTipoRelacion_facturas_refacciones_refacciones').val('');
	            }
	            
	        });



	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_cfdi_relacionados_facturas_refacciones_refacciones').on('click','button.btn',function(){
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


	        //Autocomplete para recuperar los datos de una refacción, kit, línea o marca
	        $('#txtReferencia_detalles_facturas_refacciones_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtReferenciaID_detalles_facturas_refacciones_refacciones').val('');
	                  //Hacer un llamado a la función para inicializar elementos de la referencia (KIT/REFACCION/LINEA/MARCA)
	               	 inicializar_refaccion_detalles_facturas_refacciones_refacciones ('REFACCION');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones_promociones/autocomplete",
	                   type: "post",
	                   dataType: "json",
	                   data: {
	                     strDescripcion: request.term,
	                     strTipo: 'referencias',
	                     //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						 dteFecha: $.formatFechaMysql($('#txtFecha_facturas_refacciones_refacciones').val()), 
						  intRefaccionesListaPrecioID: $('#txtRefaccionesListaPrecioID_facturas_refacciones_refacciones').val(),
						  strListaPrecioCte: 'SI'
	                   },
	                   success: function( data ) {
	                     response( data );
	                   }
	                 });
	             },
	             select: function( event, ui ) {		             	
	                //Asignar id del registro seleccionado
	                $('#txtReferenciaID_detalles_facturas_refacciones_refacciones').val(ui.item.data);
	                var intPorcentajeDescuento = parseFloat(ui.item.descuento_promocion);
	                var intPorcentajeDescLinea = parseFloat(ui.item.descuento_linea);
	                var strTipoReferencia = ui.item.tipo_referencia;
	                 $('#txtTipoReferencia_detalles_facturas_refacciones_refacciones').val(strTipoReferencia);

	                //Si existe la referencia tiene descuento de promoción
	                if(intPorcentajeDescuento > 0 || intPorcentajeDescLinea > 0)
	                {
	                	//Si existe promoción del día
	                	if(intPorcentajeDescuento > 0)
	                	{
	                		//Asignar porcentaje de promoción
	                		$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').val(intPorcentajeDescuento);
	                	}
	                	else
	                	{
	                		//Asignar porcentaje de la línea de refacciones
	                		$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').val(intPorcentajeDescLinea);
	                	}

	                	
	                	//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					    $('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
	                }
	                //Si el tipo de referencia corresponde a una refacción
	                if(strTipoReferencia == 'REFACCION')
	                {

	                	//Hacer un llamado a la función para regresar los datos de la refacción
	                	get_datos_refaccion_detalles_facturas_refacciones_refacciones(intPorcentajeDescuento);
	                	
	                }
	                else
	                {
	                	//Deshabilitar las siguientes cajas de texto
				   		$('#txtCantidad_detalles_facturas_refacciones_refacciones').attr('disabled','disabled');
				   		$('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').attr('disabled','disabled');
				   		
				   		//Enfocar caja de texto
		                //$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').focus();

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

	        //Verificar que exista id de la referencia cuando pierda el enfoque la caja de texto
	        $('#txtReferencia_detalles_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la referencia
	            if($('#txtReferenciaID_detalles_facturas_refacciones_refacciones').val() == '' ||
	               $('#txtReferencia_detalles_facturas_refacciones_refacciones').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtReferenciaID_detalles_facturas_refacciones_refacciones').val('');
	                $('#txtReferencia_detalles_facturas_refacciones_refacciones').val('');
	                //Hacer un llamado a la función para inicializar elementos de la referencia (KIT/REFACCION/LINEA/MARCA)
	               	inicializar_refaccion_detalles_facturas_refacciones_refacciones ('REFACCION');
	            }

	        });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_facturas_refacciones_refacciones').on('click','button.btn',function(){
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

	         //Validar que exista referencia cuando se pulse la tecla enter 
			$('#txtReferencia_detalles_facturas_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe referencia
		            if($('#txtReferenciaID_detalles_facturas_refacciones_refacciones').val() == '' || $('#txtReferencia_detalles_facturas_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtReferencia_detalles_facturas_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Si el tipo de referencia corresponde a una refacción 
			   	    	if($('#txtTipoReferencia_detalles_facturas_refacciones_refacciones').val() == 'REFACCION')
			   	    	{
			   	    		//Enfocar caja de texto
					    	$('#txtCantidad_detalles_facturas_refacciones_refacciones').focus();
						}
						else
						{
							//Hacer un llamado a la función para agregar renglón a la tabla
			   	    		agregar_renglon_detalles_facturas_refacciones_refacciones();
						}
			   	    }
		        }
		    });


			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_facturas_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_facturas_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_facturas_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Si el tipo de referencia corresponde a una refacción 
			   	    	/*if($('#txtTipoReferencia_detalles_facturas_refacciones_refacciones').val() == 'REFACCION')
			   	    	{
			   	    		//Enfocar caja de texto
					    	$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').focus();
			   	    	}
			   	   		else
			   	   		{*/
			   	   			//Hacer un llamado a la función para agregar renglón a la tabla
			   	    		agregar_renglon_detalles_facturas_refacciones_refacciones();
			   	   		//}
			   	    }
		        }
		    });

		    //Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_detalles_facturas_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Si el tipo de referencia corresponde a una refacción 
			   	    	/*if($('#txtTipoReferencia_detalles_facturas_refacciones_refacciones').val() == 'REFACCION')
			   	    	{
			   	    		//Enfocar caja de texto
					    	$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').focus();
			   	    	}
			   	   		else
			   	   		{*/
			   	   			//Hacer un llamado a la función para agregar renglón a la tabla
			   	    		agregar_renglon_detalles_facturas_refacciones_refacciones();
			   	   		//}
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_facturas_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	 //Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_detalles_facturas_refacciones_refacciones();
			   	    	
			   	    }
		        }
		    });

			
			/*******************************************************************************************************************
			Controles correspondientes al modal Relacionar CFDI
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_relacionar_cfdi_facturas_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_relacionar_cfdi_facturas_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_relacionar_cfdi_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_relacionar_cfdi_facturas_refacciones_refacciones').val('');
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
	             $('#txtProspectoIDBusq_relacionar_cfdi_facturas_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_relacionar_cfdi_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_relacionar_cfdi_facturas_refacciones_refacciones').val() == '' ||
	            	$('#txtRazonSocialBusq_relacionar_cfdi_facturas_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_relacionar_cfdi_facturas_refacciones_refacciones').val('');
	               $('#txtRazonSocialBusq_relacionar_cfdi_facturas_refacciones_refacciones').val('');
	            }
	            
	        });


	        /*******************************************************************************************************************
			Controles correspondientes al modal Cancelación del timbrado
			**************************************	*******************************************************************************/
			 //Autocomplete para recuperar los datos de una sustitución (factura, pago, etc.)
	        $('#txtFolioSustitucion_cancelacion_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSustitucionID_cancelacion_facturas_refacciones_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/facturas_refacciones/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intReferenciaID: $('#txtReferenciaCfdiID_cancelacion_facturas_refacciones_refacciones').val(),
	                   strFormulario: 'cancelacion'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtSustitucionID_cancelacion_facturas_refacciones_refacciones').val(ui.item.data);
	             $('#txtUuidSustitucion_cancelacion_facturas_refacciones_refacciones').val(ui.item.uuid);
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
	        $('#txtFolioSustitucion_cancelacion_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtSustitucionID_cancelacion_facturas_refacciones_refacciones').val() == '' ||
	               $('#txtFolioSustitucion_cancelacion_facturas_refacciones_refacciones').val() == '')
	            { 
	               //Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_facturas_refacciones_refacciones();
	            }
	            
	        });


	        //Verificar motivo de cancelación cuando cambie la opción del combobox
	        $('#cmbCancelacionMotivoID_cancelacion_facturas_refacciones_refacciones').change(function(e){   
	            //Si el motivo de cancelación no corresponde a 01 - Comprobante emitido con errores con relación.
              	if(parseInt($('#cmbCancelacionMotivoID_cancelacion_facturas_refacciones_refacciones').val()) !== intCancelacionIDRelacionCfdiFacturasRefaccionesRefacciones)
             	{
             		//Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_facturas_refacciones_refacciones();
					
             	}
	        });



			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_facturas_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_facturas_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_facturas_refacciones_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_facturas_refacciones_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_facturas_refacciones_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_facturas_refacciones_refacciones').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un cliente
	        $('#txtRazonSocialBusq_facturas_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_facturas_refacciones_refacciones').val('');
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
	             $('#txtProspectoIDBusq_facturas_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_facturas_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_facturas_refacciones_refacciones').val() == '' ||
	               $('#txtRazonSocialBusq_facturas_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_facturas_refacciones_refacciones').val('');
	               $('#txtRazonSocialBusq_facturas_refacciones_refacciones').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_facturas_refacciones_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaFacturasRefaccionesRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_facturas_refacciones_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_facturas_refacciones_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_facturas_refacciones_refacciones('Nuevo');
				//Abrir modal
				 objFacturasRefaccionesRefacciones = $('#FacturasRefaccionesRefaccionesBox').bPopup({
												   appendTo: '#FacturasRefaccionesRefaccionesContent', 
					                               contentContainer: 'FacturasRefaccionesRefaccionesM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_facturas_refacciones_refacciones').focus();
			});



			//Enfocar caja de texto
			$('#txtFechaInicialBusq_facturas_refacciones_refacciones').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_facturas_refacciones_refacciones();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_facturas_refacciones_refacciones();
            //Hacer un llamado a la función para cargar los motivos de cancelación en el combobox del modal
            cargar_motivos_cancelacion_facturas_refacciones_refacciones();
            //Hacer un llamado a la función para cargar exportación en el combobox del modal
            cargar_exportacion_facturas_refacciones_refacciones();
		});
	</script>