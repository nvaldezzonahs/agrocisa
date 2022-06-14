	<div id="PagosCajaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_pagos_caja" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_pagos_caja" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_pagos_caja">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_pagos_caja'>
				                    <input class="form-control" id="txtFechaInicialBusq_pagos_caja"
				                    		name= "strFechaInicialBusq_pagos_caja" 
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
								<label for="txtFechaFinalBusq_pagos_caja">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_pagos_caja'>
				                    <input class="form-control" id="txtFechaFinalBusq_pagos_caja"
				                    		name= "strFechaFinalBusq_pagos_caja" 
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
								<input id="txtProspectoIDBusq_pagos_caja" 
									   name="intProspectoIDBusq_pagos_caja"  
									   type="hidden" 
									   value="" />
								<label for="txtRazonSocialBusq_pagos_caja">Razón social</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRazonSocialBusq_pagos_caja" 
										name="strRazonSocialBusq_pagos_caja" type="text" value="" tabindex="1" placeholder="Ingrese razón social" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_pagos_caja">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_pagos_caja" 
								 		name="strEstatusBusq_pagos_caja" tabindex="1">
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
					<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_pagos_caja">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_pagos_caja" 
										name="strBusqueda_pagos_caja" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_pagos_caja"
									onclick="paginacion_pagos_caja();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_pagos_caja" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_pagos_caja"
									onclick="reporte_pagos_caja('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_pagos_caja"
									onclick="reporte_pagos_caja('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla pagos
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

				/*
				Definir columnas de la tabla detalles del pago
				*/
				td.movil.d1:nth-of-type(1):before {content: "Fecha y hora"; font-weight: bold;}
				td.movil.d2:nth-of-type(2):before {content: "Forma de pago"; font-weight: bold;}
				td.movil.d3:nth-of-type(3):before {content: "Moneda"; font-weight: bold;}
				td.movil.d4:nth-of-type(4):before {content: "Tipo de cambio"; font-weight: bold;}
				td.movil.d5:nth-of-type(5):before {content: "Monto"; font-weight: bold;}
				td.movil.d6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles relacionados (facturas) del pago
				*/
				td.movil.e1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.e2:nth-of-type(2):before {content: "UUID"; font-weight: bold;}
				td.movil.e3:nth-of-type(3):before {content: "Moneda"; font-weight: bold;}
				td.movil.e4:nth-of-type(4):before {content: "T.C."; font-weight: bold;}
				td.movil.e5:nth-of-type(5):before {content: "M.P."; font-weight: bold;}
				td.movil.e6:nth-of-type(6):before {content: "Saldo"; font-weight: bold;}
				td.movil.e7:nth-of-type(7):before {content: "Pago"; font-weight: bold;}
				td.movil.e8:nth-of-type(8):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles relacionados (facturas) del pago
				*/
				td.movil.et1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.et2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.et3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.et4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.et5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.et6:nth-of-type(6):before {content: ""; font-weight: bold;}
				td.movil.et7:nth-of-type(7):before {content: "Pago"; font-weight: bold;}

			    /*
				Definir columnas de la tabla facturas a relacionar
				*/
				td.movil.f1:nth-of-type(1):before {content: "Referencia"; font-weight: bold;}
				td.movil.f2:nth-of-type(2):before {content: "UUID"; font-weight: bold;}
				td.movil.f3:nth-of-type(3):before {content: "Parcialidades"; font-weight: bold;}
				td.movil.f4:nth-of-type(4):before {content: "T.C."; font-weight: bold;}
				td.movil.f5:nth-of-type(5):before {content: "Método pago ID"; font-weight: bold;}
				td.movil.f6:nth-of-type(6):before {content: "Método pago"; font-weight: bold;}
				td.movil.f7:nth-of-type(7):before {content: "Moneda ID"; font-weight: bold;}
				td.movil.f8:nth-of-type(8):before {content: "Folio"; font-weight: bold;}
				td.movil.f9:nth-of-type(9):before {content: "Moneda"; font-weight: bold;}
				td.movil.f10:nth-of-type(10):before {content: "Fecha"; font-weight: bold;}
				td.movil.f11:nth-of-type(11):before {content: "Fecha Venc."; font-weight: bold;}
				td.movil.f12:nth-of-type(12):before {content: "Modulo"; font-weight: bold;}
				td.movil.f13:nth-of-type(13):before {content: "Importe"; font-weight: bold;}
				td.movil.f14:nth-of-type(14):before {content: "Saldo"; font-weight: bold;}
				td.movil.f15:nth-of-type(15):before {content: "Vencido"; font-weight: bold;}
				td.movil.f16:nth-of-type(16):before {content: "Seleccionar"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla facturas a relacionar
				*/
				td.movil.ft1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.ft2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.ft3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.ft4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.ft5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.ft6:nth-of-type(6):before {content: ""; font-weight: bold;}
				td.movil.ft7:nth-of-type(7):before {content: "Saldo"; font-weight: bold;}
				td.movil.ft8:nth-of-type(8):before {content: "Vencido"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_pagos_caja">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Razón social</th>
							<th class="movil">RFC</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:15em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_pagos_caja" type="text/template"> 
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
										onclick="editar_pagos_caja({{pago_id}},'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_pagos_caja({{pago_id}},'Ver', {{cancelacion_id}});" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
                            	<!--Ver motivo de cancelación-->
								<button class="btn btn-default btn-xs {{mostrarAccionMotivoCancelacion}}"  
										onclick="ver_cancelacion_pagos_caja({{cancelacion_id}})"  title="Ver motivo de cancelación">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
								</button>
                            	<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_cliente_pagos_caja({{pago_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_pagos_caja({{pago_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Generar póliza-->
								<button class="btn btn-default btn-xs {{mostrarAccionGenerarPoliza}}"  
										onclick="generar_poliza_pagos_caja({{pago_id}}, {{anticiposAplicar}}, 'principal')"  title="Generar póliza">
									<span class="glyphicon glyphicon-tags"></span>
								</button>
								<!--Timbrar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionTimbrar}}"  
										onclick="timbrar_pagos_caja({{pago_id}},'', 'principal', {{regimen_fiscal_id}})"  title="Timbrar">
									<span class="fa fa-certificate"></span>
								</button>
								<!--Descargar archivos-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_pagos_caja({{pago_id}}, '{{folio}}');" title="Descargar archivos">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_pagos_caja({{pago_id}},'{{folio}}',{{poliza_id}}, '{{folio_poliza}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="5"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_pagos_caja"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_pagos_caja">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!--Circulo de progreso-->
		<div id="divCirculoBarProgresoPrincipal_pagos_caja" class="load-container load5 circulo_bar no-mostrar">
			<div class="loader">Loading...</div>
			<br><br>
			<div align=center><b>Espere un momento por favor.</b></div>
		</div> 

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarPagosCajaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cliente_pagos_caja" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarPagosCaja" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarPagosCaja"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Razón social-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtPagoID_cliente_pagos_caja" 
										   name="intPagoID_cliente_pagos_caja" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el folio del registro seleccionado-->
									<input id="txtFolio_cliente_pagos_caja" 
										   name="strFolio_cliente_pagos_caja" 
										   type="hidden" value="">
									</input>
									<label for="txtRazonSocial_cliente_pagos_caja">Razón social</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtRazonSocial_cliente_pagos_caja" 
											name="strRazonSocial_cliente_pagos_caja" type="text" value="" 
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
									<label for="txtCorreoElectronico_cliente_pagos_caja">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_cliente_pagos_caja" 
											name="strCorreoElectronico_cliente_pagos_caja" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_cliente_pagos_caja">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_cliente_pagos_caja" 
											name="strCopiaCorreoElectronico_cliente_pagos_caja" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cliente_pagos_caja" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_cliente_pagos_caja"  
									onclick="validar_cliente_pagos_caja();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cliente_pagos_caja"
									type="reset" aria-hidden="true" onclick="cerrar_cliente_pagos_caja();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal Relacionar CFDI-->
		<div id="RelacionarCfdiPagosCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_cfdi_pagos_caja" class="ModalBodyTitle">
			<h1>Relacionar CFDI</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarCfdiPagosCaja" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarCfdiPagosCaja"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Fecha inicial-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicialBusq_relacionar_cfdi_pagos_caja">Fecha inicial</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaInicialBusq_relacionar_cfdi_pagos_caja'>
					                    <input class="form-control" id="txtFechaInicialBusq_relacionar_cfdi_pagos_caja"
					                    		name= "strFechaInicialBusq_relacionar_cfdi_pagos_caja" 
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
									<label for="txtFechaFinalBusq_relacionar_cfdi_pagos_caja">Fecha final</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaFinalBusq_relacionar_cfdi_pagos_caja'>
					                    <input class="form-control" id="txtFechaFinalBusq_relacionar_cfdi_pagos_caja"
					                    		name= "strFechaFinalBusq_relacionar_cfdi_pagos_caja" 
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
									<input id="txtProspectoIDBusq_relacionar_cfdi_pagos_caja" 
										   name="intProspectoIDBusq_relacionar_cfdi_pagos_caja"  type="hidden" 
										   value="">
									</input>
									<label for="txtRazonSocialBusq_relacionar_cfdi_pagos_caja">Razón social</label>
								</div>
								<div class="col-md-12">
									<div class="input-group">
										<input class="form-control" id="txtRazonSocialBusq_relacionar_cfdi_pagos_caja" 
											   name="strRazonSocialBusq_relacionar_cfdi_pagos_caja"  type="text" value="" 
											   tabindex="1" placeholder="Ingrese razón social" maxlength="250" >
										</input>
										<span class="input-group-btn">
											<button class="btn btn-primary" id="btnBuscar_relacionar_cfdi_pagos_caja"
													onclick="lista_facturas_relacionar_cfdi_pagos_caja();" title="Buscar coincidencias" tabindex="1">
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
							<input id="txtNumCfdi_relacionar_cfdi_pagos_caja" 
								   name="intNumCfdi_relacionar_cfdi_pagos_caja" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_cfdi_pagos_caja">
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
								<script id="plantilla_relacionar_cfdi_pagos_caja" type="text/template"> 
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
							    		id="chbAgregar_relacionar_cfdi_pagos_caja" />
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
										<strong id="numElementos_relacionar_cfdi_pagos_caja">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar CFDI´s-->
							<button class="btn btn-success" id="btnAgregar_relacionar_cfdi_pagos_caja"  
									onclick="validar_relacionar_cfdi_pagos_caja();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_cfdi_pagos_caja"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_cfdi_pagos_caja();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar CFDI-->

		<!-- Diseño del modal Cancelación del timbrado-->
		<div id="CancelacionPagosCajaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cancelacion_pagos_caja" class="ModalBodyTitle confirmacion-modal-title">
			<h1>Cancelación</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCancelacionPagosCaja" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmCancelacionPagosCaja"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Combobox que contiene los motivos de cancelación activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCancelacionMotivoID_cancelacion_pagos_caja">Motivo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbCancelacionMotivoID_cancelacion_pagos_caja" 
									 		name="intCancelacionMotivoID_pagos_caja" 
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
									<input id="txtReferenciaCfdiID_cancelacion_pagos_caja" 
										   name="intReferenciaCfdiID_cancelacion_pagos_caja" 
										   type="hidden" value="" />	

									<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
									<input id="txtPolizaID_cancelacion_pagos_caja" 
										   name="intPolizaID_cancelacion_pagos_caja" type="hidden" value="" />

									<label for="txtFolio_cancelacion_pagos_caja">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_cancelacion_pagos_caja" 
											name="strFolio_cancelacion_pagos_caja" type="text" value="" 
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
									<input id="txtSustitucionID_cancelacion_pagos_caja" 
										   name="intSustitucionID_cancelacion_pagos_caja" 
										   type="hidden" value="" />	
									<!-- Caja de texto oculta que se utiliza para recuperar el UUID de la factura que sustituye-->
									<input id="txtUuidSustitucion_cancelacion_pagos_caja" 
										   name="strUuidSustitucion_cancelacion_pagos_caja" 
										   type="hidden" value="" />	   
									<label for="txtFolioSustitucion_cancelacion_pagos_caja">Sustitución</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolioSustitucion_cancelacion_pagos_caja" 
											name="strFolioSustitucion_cancelacion_pagos_caja" type="text" value="" 
											tabindex="1" placeholder="Ingrese anticipos" maxlength="250" >
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Div que contiene los campos del usuario y fecha del registro -->
			 		<div  id="divDatosCreacion_cancelacion_pagos_caja" class="row no-mostrar">
			 			<!--Usuario que realizó la cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtUsuarioCreacion_cancelacion_pagos_caja">Usuario de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtUsuarioCreacion_cancelacion_pagos_caja" 
											name="strUsuarioCreacion_cancelacion_pagos_caja" type="text" value="" 
											 disabled >
									</input>
								</div>
							</div>
						</div>
						<!--Fecha de cancelación-->
			 			<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaCreacion_cancelacion_pagos_caja">Fecha de cancelación</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFechaCreacion_cancelacion_pagos_caja" 
											name="strFechaCreacion_cancelacion_pagos_caja" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cancelacion_pagos_caja" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 		 						
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar cancelación del CFDI-->
							<button class="btn btn-success" id="btnGuardar_cancelacion_pagos_caja"  
									onclick="validar_cancelacion_pagos_caja();"  title="Cancelar CFDI" tabindex="1">
								<span class="fa fa-chain-broken"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cancelacion_pagos_caja"
									type="reset" aria-hidden="true" onclick="cerrar_cancelacion_pagos_caja();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cancelación del timbrado-->

		<!-- Diseño del modal Pagos-->
		<div id="PagosCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_pagos_caja"  class="ModalBodyTitle">
			<h1>Pagos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_pagos_caja" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_pagos_caja" class="active">
									<a data-toggle="tab" href="#informacion_general_pagos_caja">Información General</a>
								</li>
								<!--Tab que contiene la información de los CFDI relacionados-->
								<li id="tabCfdiRelacionados_pagos_caja">
									<a data-toggle="tab" href="#cfdi_relacionados_pagos_caja">CFDI Relacionados</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmPagosCaja" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmPagosCaja"  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_pagos_caja" class="tab-pane fade in active">
							<div class="row">
								<!--Folio-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtPagoID_pagos_caja" 
												   name="intPagoID_pagos_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el número de detalles con forma de pago: Aplicación de anticipos sin anticipo-->
											<input id="txtAnticiposAplicar_pagos_caja" 
												   name="intAnticiposAplicar_pagos_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
											<input id="txtEstatus_pagos_caja" 
												   name="strEstatus_pagos_caja" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el id e la póliza del registro seleccionado-->
											<input id="txtPolizaID_pagos_caja" 
												   name="intPolizaID_pagos_caja" type="hidden" value="" />
											 <!-- Caja de texto oculta que se utiliza para recuperar el folio de la póliza-->
											<input id="txtFolioPoliza_pagos_caja" 
												   name="strFolioPoliza_pagos_caja" type="hidden" value="" />
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la cancelación del registro seleccionado-->
											<input id="txtCancelacionID_pagos_caja" 
												   name="intCancelacionID_pagos_caja" type="hidden" value="" />
											<label for="txtFolio_pagos_caja">Folio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFolio_pagos_caja" 
													name="strFolio_pagos_caja" type="text" 
													value="" placeholder="Autogenerado" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Fecha-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_pagos_caja">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_pagos_caja'>
							                    <input class="form-control" id="txtFecha_pagos_caja"
							                    		name= "strFecha_pagos_caja" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
						    	<!--Autocomplete que contiene los clientes activos-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
											<input id="txtProspectoID_pagos_caja" name="intProspectoID_pagos_caja"  type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el id del régimen fiscal del cliente seleccionado-->
											<input id="txtRegimenFiscalID_pagos_caja" 
												   name="intRegimenFiscalID_pagos_caja" 
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta para recuperar la calle del cliente seleccionado-->
											<input id="txtCalle_pagos_caja" name="strCalle_pagos_caja" type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el número exterior del cliente seleccionado-->
											<input id="txtNumeroExterior_pagos_caja" name="strNumeroExterior_pagos_caja" type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el número interior del cliente seleccionado-->
											<input id="txtNumeroInterior_pagos_caja" name="strNumeroInterior_pagos_caja" type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el código postal del cliente seleccionado-->
											<input id="txtCodigoPostal_pagos_caja" name="strCodigoPostal_pagos_caja" type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar la colonia del cliente seleccionado-->
											<input id="txtColonia_pagos_caja" name="strColonia_pagos_caja" type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar la localidad del cliente seleccionado-->
											<input id="txtLocalidad_pagos_caja" name="strLocalidad_pagos_caja" type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el municipio del cliente seleccionado-->
											<input id="txtMunicipio_pagos_caja" name="strMunicipio_pagos_caja" type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el estado del cliente seleccionado-->
											<input id="txtEstado_pagos_caja" name="strEstado_pagos_caja" type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el país del cliente seleccionado-->
											<input id="txtPais_pagos_caja" name="strPais_pagos_caja" type="hidden" value="" />
											<label for="txtRazonSocial_pagos_caja">Razón social</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtRazonSocial_pagos_caja" 
													name="strRazonSocial_pagos_caja" 
													type="text" 
													value="" 
													tabindex="1" 
													placeholder="Ingrese razón social" 
													maxlength="250" />
										</div>
									</div>
								</div>
								<!--Razón social-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRfc_pagos_caja">RFC</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRfc_pagos_caja"
												   name="strRfc_pagos_caja" 
												   type="text" value="" disabled />
										</div>
									</div>
								</div>
							</div>
						    <div class="row">
						    	
							</div>
							<div class="row">
								<!--Autocomplete que contiene los usos de cfdi activos-->
								<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del uso de cfdi seleccionado-->
											<input id="txtUsoCfdiID_pagos_caja" 
												   name="intUsoCfdiID_pagos_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtUsoCfdi_pagos_caja">
												Uso del CFDI
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtUsoCfdi_pagos_caja" 
													name="strUsoCfdi_pagos_caja" type="text" value=""  
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
											<input id="txtTipoRelacionID_pagos_caja" 
												   name="intTipoRelacionID_pagos_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtTipoRelacion_pagos_caja">
												Tipo de relación
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTipoRelacion_pagos_caja" 
													name="strTipoRelacion_pagos_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese tipo de relación" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene los objetos de impuesto-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObjetoImpuesto_pagos_caja">Objeto de impuesto SAT</label>
										</div>
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el código del objeto de impuesto seleccionado-->
											<input id="txtObjetoImpuestoSat_pagos_caja" 
												   name="strObjetoImpuestoSat_pagos_caja"  
												   type="hidden" value="">
										    </input>
											<input  class="form-control" id="txtObjetoImpuesto_pagos_caja" 
													name="strObjetoImpuesto_pagos_caja" type="text" 
													value="" tabindex="1" placeholder="Ingrese objeto de impuesto SAT" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Combobox que contiene la exportación activa-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbExportacionID_pagos_caja">Exportación</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" id="cmbExportacionID_pagos_caja"
											        name="intExportacionID_pagos_caja" tabindex="1">
		                     				</select>
										</div>
									</div>
								</div>
							</div>
						    <div class="row">
						    	<!--Observaciones-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObservaciones_pagos_caja">Observaciones</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtObservaciones_pagos_caja" 
													name="strObservaciones_pagos_caja" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
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
											<input id="txtNumDetalles_pagos_caja" 
												   name="intNumDetalles_pagos_caja" type="hidden" value="">
											</input>
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">Detalles del pago</h4>
												</div>
												<div class="panel-body">
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!--Botón agregar-->
							                              	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							                                	<button class="btn btn-primary pull-right" 
							                                			id="btnAgregar_pagos_caja"
							                                			onclick="abrir_detalle_pagos_caja();" 
							                                	     	title="Agregar" tabindex="1"> 
							                                		<span class="glyphicon glyphicon-plus"></span>
							                                	</button>
							                             	</div>
														</div>
														<br>
													</div>
													<!--Div que contiene la tabla con los detalles encontrados-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row ">
															<!-- Diseño de la tabla-->
															<table class="table-hover movil" id="dg_detalles_pagos_caja">
																<thead class="movil">
																	<tr class="movil">
																		<th class="movil">Fecha y hora</th>
																		<th class="movil">Forma de pago</th>
																		<th class="movil">Moneda</th>
																		<th class="movil">Tipo de cambio</th>
																		<th class="movil">Monto</th>
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
																		<strong id="numElementos_detalles_pagos_caja">0</strong> encontrados
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
						</div><!--Cierre del contenido del tab - Información General-->
						<!--Tab - CFDI relacionados-->
						<div id="cfdi_relacionados_pagos_caja" class="tab-pane fade">
							<div class="row">
								<!--Botones-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="btn-group pull-right">
										<!--Buscar CFDI a relacionar para agregarlos en la tabla-->
										<button class="btn btn-primary" 
		                                			id="btnBuscarCFDI_pagos_caja" 
		                                			onclick="abrir_relacionar_cfdi_pagos_caja();" 
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
									<input id="txtNumCfdiRelacionados_pagos_caja" 
										   name="intNumCfdiRelacionados_pagos_caja" type="hidden" value="">
									</input>
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_cfdi_relacionados_pagos_caja">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Razó social</th>
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
												<strong id="numElementos_cfdi_relacionados_pagos_caja">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - CFDI relacionados-->
				    </div><!--Cierre del contenedor de tabs-->			
                  	<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_pagos_caja" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
                  	<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_pagos_caja"  
									onclick="validar_pagos_caja();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_pagos_caja"  
									onclick="abrir_cliente_pagos_caja('');"  
									title="Enviar correo electrónico" tabindex="3" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Ver motivo de cancelación del registro-->
							<button class="btn btn-default" id="btnVerMotivoCancelacion_pagos_caja"  
									onclick="ver_cancelacion_pagos_caja('');"  title="Ver motivo de cancelación" tabindex="4">
								<i class="fa fa-info-circle" aria-hidden="true"></i>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_pagos_caja"  
									onclick="reporte_registro_pagos_caja('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivos-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_pagos_caja"  
									onclick="descargar_archivos_pagos_caja('','');"  title="Descargar archivos" tabindex="6" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_pagos_caja"  
									onclick="cambiar_estatus_pagos_caja('', '', '', '');"  title="Desactivar" tabindex="7" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_pagos_caja"
									type="reset" aria-hidden="true" onclick="cerrar_pagos_caja();" 
									title="Cerrar"  tabindex="8">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Pagos-->

		<!-- Diseño del modal Detalle del Pago-->
		<div id="DetallePagosCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_detalle_pagos_caja" class="ModalBodyTitle">
			<h1>Pagos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_detalle_pagos_caja" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_detalle_pagos_caja" class="active">
									<a data-toggle="tab" href="#informacion_general_detalle_pagos_caja">Información General</a>
								</li>
								<!--Tab que contiene la información de los documentos relacionados-->
								<li id="tabDocRelacionados_detalle_pagos_caja">
									<a data-toggle="tab" href="#doc_relacionados_detalle_pagos_caja">Documentos Relacionados</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmDetallePagosCaja" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmDetallePagosCaja"  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_detalle_pagos_caja" class="tab-pane fade in active">
						    <div class="row">
			           			<!--Fecha-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el renglón del registro seleccionado-->
											<input class="form-control" id="txtRenglon_detalle_pagos_caja"
												   name="intRenglon_detalle_pagos_caja" type="hidden">
										    </input>
											<label for="txtFecha_detalle_pagos_caja">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_detalle_pagos_caja'>
							                    <input class="form-control" id="txtFecha_detalle_pagos_caja"
							                    		name= "strFecha_detalle_pagos_caja" 
							                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
										</div>
									</div>
								</div>
								<!--Hora-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtHora_detalle_pagos_caja">Hora</label>
										</div>
										<div class="col-md-12">
											<div class="input-group bootstrap-timepicker timepicker" id="dteHora_detalle_pagos_caja">
		            							<input class="form-control input-small" id="txtHora_detalle_pagos_caja" 
		            								   name= "strHora_detalle_pagos_caja" type="text"  value="" tabindex="1"/>
		        							</div>
										</div>
									</div>
								</div>
								<!--Combobox que contiene las monedas activas-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbMonedaID_detalle_pagos_caja">Moneda</label>
										</div>
										<div id="divCmbMsjValidacion" class="col-md-12">
											<select class="form-control" 
													id="cmbMonedaID_detalle_pagos_caja" 
											 		name="intMonedaID_detalle_pagos_caja" 
											 		tabindex="1">
		                     				</select>
										</div>
									</div>
								</div>
								<!--Tipo de cambio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTipoCambio_detalle_pagos_caja">Tipo de cambio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control tipo-cambio_pagos_caja" 
													id="txtTipoCambio_detalle_pagos_caja" 
													name="intTipoCambio_detalle_pagos_caja" 
													type="text" value="" tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11"/>
										</div>
									</div>
								</div>
			                </div>
			                <div class="row">
								<!--Monto-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMonto_detalle_pagos_caja">Monto</label>
										</div>
										<div class="col-md-12">
											<div class='input-group'>
												<span class="input-group-addon">$</span>
												<input  class="form-control moneda_pagos_caja" id="txtMonto_detalle_pagos_caja" 
														name="intMonto_detalle_pagos_caja" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="14">
												</input>
											</div>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene las formas de pago activas-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la forma de pago seleccionada-->
											<input id="txtFormaPagoID_detalle_pagos_caja" 
												   name="intFormaPagoID_detalle_pagos_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtFormaPago_detalle_pagos_caja">
												Forma de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFormaPago_detalle_pagos_caja" 
													name="strFormaPago_detalle_pagos_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese forma de pago" maxlength="250">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los anticipos activos-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del anticipo seleccionado-->
											<input id="txtAnticipoID_detalle_pagos_caja" 
												   name="intAnticipoID_detalle_pagos_caja"  
												   type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el saldo por aplicar-->
											<input  class="form-control" id="txtSaldoAnticipo_detalle_pagos_caja" 
														name="intSaldoAnticipo_detalle_pagos_caja" type="hidden" value="">
											</input>
											<label for="txtAnticipo_detalle_pagos_caja">Anticipo</label>
										</div>	
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtAnticipo_detalle_pagos_caja" 
													name="strAnticipo_detalle_pagos_caja" 
													type="text" value="" tabindex="1" placeholder="Ingrese anticipo" maxlength="250" />
										</div>
									</div>
								</div>	
							</div>
							<div class="row">
								<!--Número de operación-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNumOperacion_detalle_pagos_caja">
												Número de operación
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNumOperacion_detalle_pagos_caja" 
													name="strNumOperacion_detalle_pagos_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese número de operación" maxlength="100">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene las cuentas bancarias activas (del cliente)-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCtaOrdenante_detalle_pagos_caja">
												Cuenta ordenante 
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCtaOrdenante_detalle_pagos_caja" 
													name="strCtaOrdenante_detalle_pagos_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese cuenta ordenante" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los RFC bancarios activos-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del banco seleccionado-->
											<input id="txtBancoIDEmisorCtaOrd_detalle_pagos_caja" 
												   name="intBancoIDEmisorCtaOrd_detalle_pagos_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtRfcEmisorCtaOrd_detalle_pagos_caja">
												RFC cuenta ordenante 
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRfcEmisorCtaOrd_detalle_pagos_caja" 
													name="strRfcEmisorCtaOrd_detalle_pagos_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese RFC" maxlength="13">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Banco ordenante-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNomBancoOrdExt_detalle_pagos_caja">
												Banco ordenante 
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNomBancoOrdExt_detalle_pagos_caja" 
													name="strNomBancoOrdExt_detalle_pagos_caja" type="text" value=""  
													disabled>
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene las cuentas bancarias activas-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id de la cuenta bancaria seleccionada-->
											<input id="txtCuentaBancariaID_detalle_pagos_caja" 
												   name="intCuentaBancariaID_detalle_pagos_caja" 
												   type="hidden" value="">
										    </input>
											<!-- Caja de texto oculta que se utiliza para recuperar la cuenta bancaria seleccionada-->
											<input id="txtCtaBeneficiario_detalle_pagos_caja" 
												   name="strCtaBeneficiario_detalle_pagos_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtCtaBeneficiario_detalle_pagos_caja">
												Cuenta beneficiario 
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCuentaBancaria_detalle_pagos_caja" 
													name="strCuentaBancaria_detalle_pagos_caja" type="text" value="" 
													tabindex="1" placeholder="Ingrese cuenta beneficiario" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Autocomplete que contiene los RFC bancarios activos-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id del banco seleccionado-->
											<input id="txtBancoIDEmisorCtaBen_detalle_pagos_caja" 
												   name="intBancoIDEmisorCtaBen_detalle_pagos_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtRfcEmisorCtaBen_detalle_pagos_caja">
												RFC cuenta beneficiario 
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtRfcEmisorCtaBen_detalle_pagos_caja" 
													name="strRfcEmisorCtaBen_detalle_pagos_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese RFC" maxlength="13">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Autocomplete que contiene las cadenas de pago activas-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para recuperar el id de la cadena de pago seleccionada-->
											<input id="txtCadenaPagoID_detalle_pagos_caja" 
												   name="intCadenaPagoID_detalle_pagos_caja" 
												   type="hidden" value="">
											</input>
											<label for="txtCadenaPago_detalle_pagos_caja">
												Tipo de cadena de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCadenaPago_detalle_pagos_caja" 
													name="strCadenaPago_detalle_pagos_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese tipo de cadena de pago" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Certificado de pago-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCerPago_detalle_pagos_caja">
												Certificado de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCerPago_detalle_pagos_caja" 
													name="strCerPago_detalle_pagos_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese certificado de pago">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Cadena de pago-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCadPago_detalle_pagos_caja">
												Cadena de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCadPago_detalle_pagos_caja" 
													name="strCadPago_detalle_pagos_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese cadena de pago">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Sello de pago-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtSelloPago_detalle_pagos_caja">
												Sello de pago
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtSelloPago_detalle_pagos_caja" 
													name="strSelloPago_detalle_pagos_caja" type="text" value=""  
													tabindex="1" placeholder="Ingrese sello de pago">
											</input>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Información General-->
						<!--Tab - Documentos relacionados-->
						<div id="doc_relacionados_detalle_pagos_caja" class="tab-pane fade">
							<div class="row">
								<!--Botones-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="btn-group pull-right">
										<!--Buscar documentos a relacionar para agregarlos en la tabla-->
										<button class="btn btn-primary" 
		                                			id="btnBuscarDoc_detalle_pagos_caja" 
		                                			onclick="abrir_relacionar_fras_detalle_pagos_caja();" 
		                                	     	title="Buscar documento" tabindex="1"> 
		                                		<span class="glyphicon glyphicon-search"></span>
		                                		 Relacionar documento
		                                </button>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<!--Folio-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFolio_fra_relacionada_detalle_pagos_caja">
												<!-- Caja de texto oculta que se utiliza para recuperar el id de la referencia seleccionada-->
												<input id="txtReferenciaID_fra_relacionada_detalle_pagos_caja" 
													   name="intReferenciaID_fra_relacionada_detalle_pagos_caja"  
													   type="hidden" value="">
											    </input>
											    <!-- Caja de texto oculta que se utiliza para recuperar el tipo de la referencia seleccionada-->
												<input id="txtTipoReferencia_fra_relacionada_detalle_pagos_caja" 
													   name="strTipoReferencia_fra_relacionada_detalle_pagos_caja"  
													   type="hidden" value="">
											    </input>
											     <!-- Caja de texto oculta que se utiliza para recuperar el id de la moneda de la referencia seleccionada-->
												<input id="txtMonedaID_fra_relacionada_detalle_pagos_caja" 
													   name="intMonedaID_fra_relacionada_detalle_pagos_caja"  
													   type="hidden" value="">
											    </input>
												Folio
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFolio_fra_relacionada_detalle_pagos_caja" 
													name="strFolio_fra_relacionada_detalle_pagos_caja" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--UUID-->
								<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtUuid_fra_relacionada_detalle_pagos_caja">
												UUID
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtUuid_fra_relacionada_detalle_pagos_caja" 
													name="strUuid_fra_relacionada_detalle_pagos_caja" type="text" value="" 
													disabled>
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
											<label for="txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja">Objeto de impuesto SAT</label>
										</div>
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el código del objeto de impuesto seleccionado-->
											<input id="txtObjetoImpuestoSat_fra_relacionada_detalle_pagos_caja" 
												   name="strObjetoImpuestoSat_fra_relacionada_detalle_pagos_caja"  
												   type="hidden" value="">
										    </input>
											<input  class="form-control" id="txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja" 
													name="strObjetoImpuesto_fra_relacionada_detalle_pagos_caja" type="text" 
													value="" tabindex="1" placeholder="Ingrese objeto de impuesto SAT" maxlength="250">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Moneda-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMonedaTipo_fra_relacionada_detalle_pagos_caja">
												Moneda
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMonedaTipo_fra_relacionada_detalle_pagos_caja" 
													name="strMonedaTipo_fra_relacionada_detalle_pagos_caja" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Tipo de cambio-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTipoCambio_fra_relacionada_detalle_pagos_caja">Tipo de cambio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtTipoCambio_fra_relacionada_detalle_pagos_caja" 
													name="strTipoCambio_fra_relacionada_detalle_pagos_caja" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Método de pago-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtMetodoPago_fra_relacionada_detalle_pagos_caja">Método de pago</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtMetodoPago_fra_relacionada_detalle_pagos_caja" 
													name="strMetodoPago_fra_relacionada_detalle_pagos_caja" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Saldo-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtImpSaldoAnt_fra_relacionada_detalle_pagos_caja">Saldo</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtImpSaldoAnt_fra_relacionada_detalle_pagos_caja" 
													name="intImpSaldoAnt_fra_relacionada_detalle_pagos_caja" type="text" disabled>
											</input>
										</div>
									</div>
								</div>
	                         	<!--Importe pagado-->
	                         	<div class="col-sm-3 col-md-3 col-lg-3 col-xs-10">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el importe auxiliar de la referencia seleccionada-->
											<input id="txtImpPagadoAux_fra_relacionada_detalle_pagos_caja" 
												   name="intImpPagadoAux_fra_relacionada_detalle_pagos_caja"  
												    type="hidden" value="">
										    </input>
											<label for="txtImpPagado_fra_relacionada_detalle_pagos_caja">Pago</label>
										</div>
										<div class="col-md-12">
											<div class='input-group'>
												<input  class="form-control moneda_pagos_caja" id="txtImpPagado_fra_relacionada_detalle_pagos_caja" 
														name="intImpPagado_fra_relacionada_detalle_pagos_caja" type="text" value="" tabindex="1" placeholder="Ingrese pago" maxlength="14">
												</input>
												<span id="spnMonedaDetallePago_fra_relacionada_detalle_pagos_caja" class="input-group-addon"></span>
											</div>
										</div>
									</div>
								</div>
								<!--Botón agregar-->
	                          	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
	                            	<button class="btn btn-primary btn-toolBtns pull-right" 
	                            			id="btnAgregar_fras_detalle_pagos_caja"
	                            			onclick="agregar_renglon_fras_relacionadas_detalle_pagos_caja();" 
	                            	     	title="Agregar" tabindex="1"> 
	                            		<span class="glyphicon glyphicon-plus"></span>
	                            	</button>
	                         	</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para asignar el número de registros de la tabla facturas relacionadas--> 
											<input id="txtNumFrasRelacionadas_detalle_pagos_caja" 
												   name="intNumFrasRelacionadas_detalle_pagos_caja" type="hidden" value="">
											</input>
											<!--Div que contiene la tabla con las facturas relacionadas-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row ">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_fras_relacionadas_detalle_pagos_caja">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Folio</th>
																<th class="movil">UUID</th>
																<th class="movil">Moneda</th>
																<th class="movil">T.C.</th>
																<th class="movil">M.P.</th>
																<th class="movil">Saldo</th>
																<th class="movil">Pago</th>
																<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
														<tfoot class="movil">
															<tr class="movil">
																<td class="movil et1">
																	<strong>Total</strong>
																</td>
																<td class="movil et2"></td>
																<td class="movil et3"></td>
																<td class="movil et4"></td>
																<td class="movil et5"></td>
																<td class="movil et6">
																	<strong id="acumSaldo_detalles_pagos_caja">$0.00</strong>
																</td>
																<td  class="movil et7">
																	<strong id="acumPago_detalles_pagos_caja">$0.00</strong>
																	<strong id="monedaDetallePago_detalles_pagos_caja"></strong>
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
																<strong id="numElementos_fras_relacionadas_detalle_pagos_caja">0</strong> encontrados
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Documentos relacionados-->
					</div><!--Cierre del contenedor de tabs-->
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_detalle_pagos_caja"  
									onclick="validar_detalle_pagos_caja();"  title="Guardar" tabindex="1">
								<span class="fa fa-floppy-o"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_detalle_pagos_caja"
									type="reset" aria-hidden="true" onclick="cerrar_detalle_pagos_caja();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Detalle del Pago-->

		<!-- Diseño del modal Relacionar Documentos (facturas) del Detalle-->
		<div id="RelacionarFrasDetallePagosCajaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_fras_detalle_pagos_caja" class="ModalBodyTitle">
			<h1>Facturas que Adeuda el Cliente</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarFrasDetallePagosCaja" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarFrasDetallePagosCaja"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Razón social-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del cliente seleccionado-->
									<input id="txtProspectoIDBusq_relacionar_fras_detalle_pagos_caja" 
										   name="intProspectoIDBusq_relacionar_fras_detalle_pagos_caja"  type="hidden" 
										   value="">
									</input>
									<label for="txtRazonSocialBusq_relacionar_fras_detalle_pagos_caja">Razón social</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtRazonSocialBusq_relacionar_fras_detalle_pagos_caja" 
										   name="strRazonSocialBusq_relacionar_fras_detalle_pagos_caja"  type="text" value="">
									</input>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group row">
						<!--Div que contiene la tabla con las facturas encontradas-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<!-- Caja de texto oculta para asignar el número de registros de la tabla facturas a relacionar--> 
							<input id="txtNumFras_relacionar_fras_detalle_pagos_caja" 
								   name="intNumFras_relacionar_fras_detalle_pagos_caja" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_fras_detalle_pagos_caja">
								<thead class="movil">
									<tr class="movil">
										<th class="movil">Folio</th>
										<th class="movil">Moneda</th>
										<th class="movil">Fecha</th>
										<th class="movil">Fecha Venc.</th>
										<th class="movil">Modulo</th>
										<th class="movil">Importe</th>
										<th class="movil">Saldo</th>
										<th class="movil">Vencido</th>
										<th class="movil" id="th-acciones" style="width:8em;">Seleccionar</th>
									</tr>
								</thead>
								<tbody class="movil"></tbody>
								<script id="plantilla_relacionar_fras_detalle_pagos_caja" type="text/template"> 
								{{#rows}}
									<tr class="movil">  
										<td class="movil-no-mostrar no-mostrar f1">{{referencia_id}}</td>
										<td class="movil-no-mostrar no-mostrar f2">{{uuid}}</td>
										<td class="movil-no-mostrar no-mostrar f3">{{parcialidades}}</td>
										<td class="movil-no-mostrar no-mostrar f4">{{tipo_cambio}}</td>
										<td class="movil-no-mostrar no-mostrar f5">{{metodo_pago_id}}</td>
										<td class="movil-no-mostrar no-mostrar f6">{{metodo_pago}}</td>
										<td class="movil-no-mostrar no-mostrar f7">{{moneda_id}}</td>
										<td class="movil f8">{{folio}}</td>
										<td class="movil f9">{{moneda_tipo}}</td>
										<td class="movil f10">{{fecha}}</td>
										<td class="movil f11">{{vencimiento}}</td>
										<td class="movil f12">{{tipo_referencia}}</td>
										<td class="movil f13">{{importe}}</td>
										<td class="movil f14">{{saldo}}</td>
										<td class="movil f15">{{saldo_vencido}}</td>
										<td class="td-center movil f16"> 
											 <input 	type="checkbox" 
							    		class="form-check-input btn-xs" 
							    		id="chbAgregar_relacionar_fras_detalle_pagos_caja" />
										</td>
									</tr>
									{{/rows}}
									{{^rows}}
									<tr class="movil"> 
										<td class="movil" colspan="9"> No se encontraron resultados.</td>
									</tr> 
									{{/rows}}
								</script>
								<tfoot class="movil">
									<tr class="movil">
										<td class="movil ft1">
											<strong>Total</strong>
										</td>
										<td  class="movil ft2"></td>
										<td class="movil ft3"></td>
										<td class="movil ft4"></td>
										<td class="movil ft5"></td>
										<td class="movil ft6"></td>
										<td class="movil ft7">
											<strong id="acumSaldo_relacionar_fras_detalle_pagos_caja">$0.00</strong>
										</td>
										<td class="movil ft8">
											<strong  id="acumSaldoVencido_relacionar_fras_detalle_pagos_caja">$0.00</strong>
										</td>
										<td class="movil"></td>
									</tr>
									<tr class="movil">
										<td class="movil ft1">
											<strong>Anticipo</strong>
										</td>
										<td  class="movil ft2"></td>
										<td class="movil ft3"></td>
										<td class="movil ft4"></td>
										<td class="movil ft5"></td>
										<td class="movil ft6"></td>
										<td class="movil ft7">
											<strong id="acumAntSaldo_relacionar_fras_detalle_pagos_caja">$0.00</strong>
										</td>
										<td class="movil ft8">
											<strong  id="acumAntSaldoVencido_relacionar_fras_detalle_pagos_caja">$0.00</strong>
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
										<strong id="numElementos_relacionar_fras_detalle_pagos_caja">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar facturas-->
							<button class="btn btn-success" id="btnAgregar_relacionar_fras_detalle_pagos_caja"  
									onclick="validar_relacionar_fras_detalle_pagos_caja();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_fras_detalle_pagos_caja"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_fras_detalle_pagos_caja();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Relacionar Documentos (facturas) del Detalle-->
	</div><!--#PagosCajaContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_detalle_pagos_caja" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>

	<!-- /.Plantilla para cargar los motivo de cancelación en el combobox-->  
	<script id="cancelacion_motivos_pagos_caja" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#motivos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/motivos}} 
	</script>

	<!-- /.Plantilla para cargar la exportación en el combobox-->  
	<script id="exportacion_pagos_caja" type="text/template">
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
		var intPaginaPagosCaja = 0;
		var strUltimaBusquedaPagosCaja = "";
		/*Variable que se utiliza para asignar el tipo de referencia del proceso (a considerar en el timbrado y cfdi's relacionados)*/
		var strTipoReferenciaPagosCaja = "PAGO";
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDPagosCaja = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el id de la exportación base
		var intExportacionBaseIDPagosCaja = <?php echo EXPORTACION_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBasePagosCaja = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoPagosCaja = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar el id del uso del CFDI para pagos
		var intUsoCfdiBaseIDPagosCaja = <?php echo USO_CFDI_PAGO ?>;
		//Variable que se utiliza para asignar el id del objeto de impuesto para pagos
		var intObjetoImpuestoPagoIDPagosCaja = <?php echo OBJETOIMP_PAGO ?>;
		//Variable que se utiliza para asignar el id del objeto de impuesto base
		var intObjetoImpuestoBaseIDFrasRelPagosCaja = <?php echo OBJETOIMP_BASE ?>;
		//Variable que se utiliza para asignar el id de la forma de pago: efectivo
		var intFormaPagoEfectivoIDPagosCaja = <?php echo FORMA_PAGO_EFECTIVO ?>;
		//Variable que se utiliza para asignar el id de la forma de pago: cheque nominativo
		var intFormaPagoChequeIDPagosCaja = <?php echo FORMA_PAGO_CHEQUE ?>;
		//Variable que se utiliza para asignar el id de la forma de pago: transferencia electrónica
		var intFormaPagoTransferenciaIDPagosCaja = <?php echo FORMA_PAGO_TRANSFERENCIA ?>;
			//Variable que se utiliza para asignar el id de la forma de pago: aplicación de anticipos
		var intFormaPagoApliAnticiposIDPagosCaja = <?php echo FORMA_PAGO_APLICACION_ANTICIPO ?>;
		//Variable que se utiliza para asignar el id del motivo de cancelación: Comprobante emitido con errores con relación.
		var intCancelacionIDRelacionCfdiPagosCaja = <?php echo MOTIVO_CANCELACION_RELACIONCFDI ?>;
		//Variable que se utiliza para asignar el mensaje de régimen fiscal faltante.
		var strMsjRegimenFiscalCtePagosCaja = "<?php echo MSJ_ERROR_REGIMEN_FISCAL ?>";

		//Variable que se utiliza para asignar el código de la moneda seleccionada (del detalle de pago)
		var strMonedaDetallePagosCaja = "";

		//Variables que se utilizan para asignar el código y la descripción del objeto de impuesto base para las facturas a relacionar
		var strObjetoImpuestoSatFraRelPagosCaja = "";
		var strObjetoImpuestoFraRelPagosCaja = "";


		//Variable que se utiliza para asignar objeto del modal Cancelación del timbrado
		var objCancelacionPagosCaja = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarPagosCaja = null;
		//Variable que se utiliza para asignar objeto del modal Relacionar CFDI
		var objRelacionarCfdiPagosCaja = null;
		//Variable que se utiliza para asignar objeto del modal Pagos
		var objPagosCaja = null;
		//Variable que se utiliza para asignar objeto del modal Detalles del Pago
		var objDetallePagosCaja = null;
		//Variable que se utiliza para asignar objeto del modal Relacionar Documentos (facturas) del Detalle
		var objRelacionarFrasDetallePagosCaja = null;

		/*******************************************************************************************************************
		Funciones del objeto CFDI's  relacionados (facturas seleccionadas)
		*********************************************************************************************************************/
		// Constructor del objeto CFDI's relacionados (facturas seleccionadas)
		var objCfdisRelacionadosPagosCaja;
		function CfdisRelacionadosPagosCaja(cfdis)
		{
			this.arrCfdis = cfdis;
		}

		//Función para obtener todos los cfdi´s seleccionados
		CfdisRelacionadosPagosCaja.prototype.getCfdis = function() {
		    return this.arrCfdis;
		}

		//Función para agregar un cfdi al objeto 
		CfdisRelacionadosPagosCaja.prototype.setCfdi = function (cfdi){
			this.arrCfdis.push(cfdi);
		}

		//Función para obtener un cfdi del objeto 
		CfdisRelacionadosPagosCaja.prototype.getCfdi = function(index) {
		    return this.arrCfdis[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto CFDI a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto CFDI a relacionar
		var objCfdiRelacionarPagosCaja;
		
		function CfdiRelacionarPagosCaja(referenciaID, cliente, folio, fecha, tipoReferencia, uuid, importe)
		{
		    this.intReferenciaID = referenciaID;
		    this.strCliente = cliente;
		    this.strFolio = folio;
		    this.dteFecha = fecha;
		    this.strTipoReferencia = tipoReferencia;
		    this.strUuid = uuid;
		    this.intImporte = importe;
		}


		/*******************************************************************************************************************
		Funciones del objeto facturas relacionadas (seleccionadas) del detalle de pago
		*********************************************************************************************************************/
		// Constructor del objeto facturas relacionadas (seleccionadas) del detalle de pago
		var objFrasRelacionadasDetallePagosCaja;
		function FrasRelacionadasDetallePagosCaja(fras)
		{
			this.arrFras = fras;
		}

		//Función para obtener todas las facturas seleccionadas del detalle de pago
		FrasRelacionadasDetallePagosCaja.prototype.getFras = function() {
		    return this.arrFras;
		}

		//Función para agregar una factura al objeto 
		FrasRelacionadasDetallePagosCaja.prototype.setFra = function (fra){
			this.arrFras.push(fra);
		}

		//Función para obtener una factura del objeto 
		FrasRelacionadasDetallePagosCaja.prototype.getFra = function(index) {
		    return this.arrFras[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto factura a relacionar del detalle de pago
		*********************************************************************************************************************/
		// Constructor del objeto factura a relacionar
		var objFraRelacionarDetallePagosCaja;
		
		function FraRelacionarDetallePagosCaja(referenciaID, tipoReferencia, folio, uuid, monedaID, monedaTipo, 
											   tipoCambio, metodoPagoID, metodoPago, numParcialidades, impSaldoAnt, 
											   impPagado, impSaldoInsoluto, saldoFactura)
		{
		    this.intReferenciaID = referenciaID;
		    this.strTipoReferencia = tipoReferencia;
		    this.strFolio = folio;
		    this.strUuid = uuid;
		    this.intMonedaID = monedaID;
		    this.strMonedaTipo = monedaTipo;
		    this.intTipoCambio = tipoCambio;
		    this.intMetodoPagoID = metodoPagoID;
		    this.strMetodoPago = metodoPago;
		    this.intNumParcialidades = numParcialidades;
		    this.intImpSaldoAnt = impSaldoAnt;
		    this.intImpPagado = impPagado;
		    this.intImpSaldoInsoluto = impSaldoInsoluto;
		    this.intSaldoFactura = saldoFactura;
		}
		

		/*******************************************************************************************************************
		Funciones del objeto Detalles del pago
		*********************************************************************************************************************/
		// Constructor del objeto detalles
		var objDetallesPagoPagosCaja;
		function DetallesPagoPagosCaja(detalles)
		{
			this.arrDetalles = detalles;
		}

		//Función para obtener todos los detalles del pago
		DetallesPagoPagosCaja.prototype.getDetalles = function() {
		    return this.arrDetalles;
		}

		//Función para agregar una detalle al objeto 
		DetallesPagoPagosCaja.prototype.setDetalle = function (detalle){
			this.arrDetalles.push(detalle);
		}

		//Función para obtener un detalle del objeto
		DetallesPagoPagosCaja.prototype.getDetalle = function(index) {
		    return this.arrDetalles[index];
		}

		//Función para modificar un detalle del objeto
		DetallesPagoPagosCaja.prototype.modificarDetalle = function (index, detalle){
			this.arrDetalles[index] = detalle;
		}

		//Función para eliminar un detalle del objeto
		DetallesPagoPagosCaja.prototype.eliminarDetalle = function (index){
			if(index != -1) 
			{
				this.arrDetalles.splice(index, 1);
			}
		}

		//Función para cambiar las posiciones de los detalles en el objeto
		DetallesPagoPagosCaja.prototype.swap = function(index_A, index_B) {
		    var input = this.arrDetalles;
		 
		    var temp = input[index_A];
		    input[index_A] = input[index_B];
		    input[index_B] = temp;
		}

		/*******************************************************************************************************************
		Funciones del objeto Detalle del pago
		*********************************************************************************************************************/
		//Constructor del objeto detalle
		var objDetallePagoPagosCaja;
		function DetallePagoPagosCaja(fecha, hora, fechaPago, formaPagoID, formaPago, monedaID, moneda, tipoCambio, monto,
									 anticipoID, anticipo, saldoAnticipo, numOperacion, rfcEmisorCtaOrd, nomBancoOrdExt, ctaOrdenante,
									  cuentaBancariaID, rfcEmisorCtaBen, ctaBeneficiario, cuentaBancaria, cadenaPagoID, cadenaPago, 
								      cerPago, cadPago, selloPago, detallesRelacionados)
		{
		    this.dteFecha = fecha;
		    this.strHora= hora;
		    this.dteFechaPago = fechaPago;
		    this.intFormaPagoID = formaPagoID;
		    this.strFormaPago = formaPago;
		    this.intMonedaID = monedaID;
		    this.strMoneda = moneda;
		    this.intTipoCambio = tipoCambio;
		    this.intMonto = monto;
		    this.intAnticipoID = anticipoID;
		    this.strAnticipo = anticipo;
		    this.intSaldoAnticipo = saldoAnticipo;
		    this.strNumOperacion = numOperacion;
		    this.strRfcEmisorCtaOrd = rfcEmisorCtaOrd;
		    this.strNomBancoOrdExt = nomBancoOrdExt;
		    this.strCtaOrdenante = ctaOrdenante;
		    this.intCuentaBancariaID = cuentaBancariaID;
		    this.strRfcEmisorCtaBen = rfcEmisorCtaBen;
		    this.strCtaBeneficiario = ctaBeneficiario;
		    this.strCuentaBancaria = cuentaBancaria;
		    this.intCadenaPagoID = cadenaPagoID;
		    this.strCadenaPago = cadenaPago;
		    this.strCerPago = cerPago;
		    this.strCadPago = cadPago;
		    this.strSelloPago = selloPago;
		    this.arrDetallesRelacionados = detallesRelacionados;
		}

		//Función para agregar todos los detalles relacionados (facturas) del detalle
		DetallePagoPagosCaja.prototype.setDetallesRelacionados = function(fras) {
	    	
	    	this.arrDetallesRelacionados = fras;
		}

		//Función para eliminar todos los detalles relacionados (facturas) del detalle
		DetallePagoPagosCaja.prototype.eliminarDetallesRelacionados = function() {
			
			this.arrDetallesRelacionados = 0;
		}

		//Función para obtener un detalle relacionado (factura) del objeto 
		DetallePagoPagosCaja.prototype.getDetalleRelacionado = function(index) {
		    return this.arrDetallesRelacionados[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto Detalle relacionado (factura)  del detalle
		*********************************************************************************************************************/
		// Constructor del objeto detalle relacionado
		var objDetalleRelacionadoPagosCaja;
		function DetalleRelacionadoPagosCaja(referenciaID, tipoReferencia, folio, uuid, objetoImpuestoSat, objetoImpuesto, 
											 monedaID, monedaTipo, tipoCambio, metodoPagoID, metodoPago, numParcialidades, impSaldoAnt, 
											   impPagado, impSaldoInsoluto, saldoFactura, numPagosMayorParcialidad, impPagadoAux)
		{
		    this.intReferenciaID = referenciaID;
		    this.strTipoReferencia = tipoReferencia;
		    this.strFolio = folio;
		    this.strUuid = uuid;
		    this.strObjetoImpuestoSat = objetoImpuestoSat;
		    this.strObjetoImpuesto = objetoImpuesto;
		    this.intMonedaID = monedaID;
		    this.strMonedaTipo = monedaTipo;
		    this.intTipoCambio = tipoCambio;
		    this.intMetodoPagoID = metodoPagoID;
		    this.strMetodoPago = metodoPago;
		    this.intNumParcialidades = numParcialidades;
		    this.intImpSaldoAnt = impSaldoAnt;
		    this.intImpPagado = impPagado;
		    this.intImpSaldoInsoluto = impSaldoInsoluto;
		    this.intSaldoFactura = saldoFactura;
		    this.intNumPagosMayorParcialidad = numPagosMayorParcialidad;
		    this.intImpPagadoAux = impPagadoAux;
		}


		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_pagos_caja()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('caja/pagos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_pagos_caja').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosPagosCaja = data.row;
					//Separar la cadena 
					var arrPermisosPagosCaja = strPermisosPagosCaja.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosPagosCaja.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosPagosCaja[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_pagos_caja').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosPagosCaja[i]=='GUARDAR') || (arrPermisosPagosCaja[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_pagos_caja').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosPagosCaja[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_pagos_caja').removeAttr('disabled');
						}
						else if(arrPermisosPagosCaja[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_pagos_caja').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_pagos_caja();
						}
						else if(arrPermisosPagosCaja[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_pagos_caja').removeAttr('disabled');
						}
						else if(arrPermisosPagosCaja[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_pagos_caja').removeAttr('disabled');
						}
						else if(arrPermisosPagosCaja[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_pagos_caja').removeAttr('disabled');
						}
						else if(arrPermisosPagosCaja[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_pagos_caja').removeAttr('disabled');
						}
						else if(arrPermisosPagosCaja[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_pagos_caja').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_pagos_caja() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaPagosCaja = ($('#txtFechaInicialBusq_pagos_caja').val()+$('#txtFechaFinalBusq_pagos_caja').val()+$('#txtProspectoIDBusq_pagos_caja').val()+$('#cmbEstatusBusq_pagos_caja').val()+$('#txtBusqueda_pagos_caja').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaPagosCaja != strUltimaBusquedaPagosCaja)
			{
				intPaginaPagosCaja = 0;
				strUltimaBusquedaPagosCaja = strNuevaBusquedaPagosCaja;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/pagos/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_pagos_caja').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_pagos_caja').val()),
						intProspectoID: $('#txtProspectoIDBusq_pagos_caja').val(),
						strEstatus: $('#cmbEstatusBusq_pagos_caja').val(),
						strBusqueda: $('#txtBusqueda_pagos_caja').val(),
						intPagina:intPaginaPagosCaja,
						strPermisosAcceso: $('#txtAcciones_pagos_caja').val()
					},
					function(data){
						$('#dg_pagos_caja tbody').empty();
						var tmpPagosCaja = Mustache.render($('#plantilla_pagos_caja').html(),data);
						$('#dg_pagos_caja tbody').html(tmpPagosCaja);
						$('#pagLinks_pagos_caja').html(data.paginacion);
						$('#numElementos_pagos_caja').html(data.total_rows);
						intPaginaPagosCaja = data.pagina;
					},
			'json');
		}

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_pagos_caja(anticipoAplicacionID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(anticipoAplicacionID == '')
			{
				intID = $('#txtPagoID_pagos_caja').val();
				strFolio = $('#txtFolio_pagos_caja').val();
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
										'strTipoReferencia': strTipoReferenciaPagosCaja,
										'strFolio': strFolio		
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_detalle_pagos_caja()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_detalle_pagos_caja').empty();
					var temp = Mustache.render($('#monedas_detalle_pagos_caja').html(), data);
					$('#cmbMonedaID_detalle_pagos_caja').html(temp);
				},
				'json');
		}

		//Regresar el uso de CFDI base
		function cargar_uso_cfdi_base_pagos_caja()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.ajax({
			        url: 'contabilidad/sat_uso_cfdi/get_datos',
			        method:'post',
			        dataType: 'json',
			        async: false,
			        data: {
			        	strBusqueda:intUsoCfdiBaseIDPagosCaja,
			       		strTipo: 'id'
			        },
			        success: function (data) {
			          	//Si no se encuentra código 
			        	if(data.row)
			        	{
			        		//Recuperar valores
				            $('#txtUsoCfdiID_pagos_caja').val(data.row.uso_cfdi_id);
				            $('#txtUsoCfdi_pagos_caja').val(data.row.codigo+' - '+data.row.descripcion);

			        	}
			        }
			    });
		}

		//Regresar el impuesto de objeto base (PAGOS)
		function cargar_objeto_impuesto_base_pagos_caja(campoID, campoDescripcion)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.ajax({
			        url: 'contabilidad/sat_objeto_impuesto/get_datos',
			        method:'post',
			        dataType: 'json',
			        async: false,
			        data: {
			        	strBusqueda:intObjetoImpuestoPagoIDPagosCaja,
			       		strTipo: 'id'
			        },
			        success: function (data) {
			          	//Si no se encuentra código 
			        	if(data.row)
			        	{
			        		//Variables que se utilizan para asignar datos del objeto de impuesto base
			        		var strCodigo = data.row.codigo;
			        		var strDescripcion = data.row.codigo+' - '+data.row.descripcion;

			        		//Si se cumpla la sentencia, significa que se asignará por default el objeto de impuestos base (pagos)
			        		if(campoID == '' && campoDescripcion == '')
			        		{
			        			//Recuperar valores
			        			strObjetoImpuestoSatFraRelPagosCaja = strCodigo;
			        			strObjetoImpuestoFraRelPagosCaja = strDescripcion;
			        		}
			        		else
			        		{
			        			//Recuperar valores
					            $('#'+campoID).val(strCodigo);
					            $('#'+campoDescripcion).val(strDescripcion);
			        		}
		        			
			        		

			        	}
			        }
			    });
		}



		//Regresar exportación activa para cargarlas en el combobox
		function cargar_exportacion_pagos_caja()
		{
			//Hacer un llamado al método del controlador para regresar la exportación que se encuentra activa
			$.post('contabilidad/sat_exportacion/get_combo_box', {},
				function(data)
				{
					$('#cmbExportacionID_pagos_caja').empty();
					var temp = Mustache.render($('#exportacion_pagos_caja').html(), data);
					$('#cmbExportacionID_pagos_caja').html(temp);
				},
				'json');
		}


		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_pagos_caja(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'caja/pagos/';

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
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_pagos_caja').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_pagos_caja').val()),
										'intProspectoID': $('#txtProspectoIDBusq_pagos_caja').val(),
										'strEstatus': $('#cmbEstatusBusq_pagos_caja').val(), 
										'strBusqueda': $('#txtBusqueda_pagos_caja').val()		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_pagos_caja(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtPagoID_pagos_caja').val();
			}
			else
			{
				intID = id;
			}

		
			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url':  'contabilidad/timbradoV4/get_pdf',
							'data' : {
										'intReferenciaID':intID,
										'strTipoReferencia':strTipoReferenciaPagosCaja,
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
		function nuevo_cancelacion_pagos_caja()
		{
			//Incializar formulario
			$('#frmCancelacionPagosCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_pagos_caja();
			//Limpiar cajas de texto ocultas
			$('#frmCancelacionPagosCaja').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cancelacion_pagos_caja');
			//Habilitar todos los elementos del formulario
			$('#frmCancelacionPagosCaja').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_cancelacion_pagos_caja').attr('disabled','disabled');
			//Mostrar botón de Guardar
		    $("#btnGuardar_cancelacion_pagos_caja").show();
		    //Agregar clase para ocultar div que contiene los datos de creación del registro
			$("#divDatosCreacion_cancelacion_pagos_caja").addClass('no-mostrar');
		}

		//Función que se utiliza para abrir el modal
		function abrir_cancelacion_pagos_caja(id, folio, polizaID)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cancelacion_pagos_caja();

			//Asignar datos del registro seleccionado
			$('#txtReferenciaCfdiID_cancelacion_pagos_caja').val(id);
			$('#txtFolio_cancelacion_pagos_caja').val(folio);
			$('#txtPolizaID_cancelacion_pagos_caja').val(polizaID);
			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_cancelacion_pagos_caja').addClass("estatus-ACTIVO");

		    //Abrir modal
			objCancelacionPagosCaja = $('#CancelacionPagosCajaBox').bPopup({
												   appendTo: '#PagosCajaContent', 
						                           contentContainer: 'PagosCajaM', 
						                           zIndex: 2, 
						                           modalClose: false, 
						                           modal: true, 
						                           follow: [true,false], 
						                           followEasing : "linear", 
						                           easing: "linear", 
						                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#cmbCancelacionMotivoID_cancelacion_pagos_caja').focus();
		}

		//Función para regresar los datos (al formulario) del registro seleccionados
		function ver_cancelacion_pagos_caja(id)
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCancelacionID_pagos_caja').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/cancelaciones/get_datos',
	        {
	       		intCancelacionID:intID,
	       		strTipoReferencia:strTipoReferenciaPagosCaja
	        },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			               //Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cancelacion_pagos_caja();
							//Recuperar valores
							$('#cmbCancelacionMotivoID_cancelacion_pagos_caja').val(data.row.cancelacion_motivo_id);
							$('#txtFolio_cancelacion_pagos_caja').val(data.row.folio_referencia);
							$('#txtFolioSustitucion_cancelacion_pagos_caja').val(data.row.folio_sustitucion);
							$('#txtUsuarioCreacion_cancelacion_pagos_caja').val(data.row.usuario_creacion);
							$('#txtFechaCreacion_cancelacion_pagos_caja').val(data.row.fecha_creacion);

							//Dependiendo del estatus cambiar el color del encabezado 
		   					$('#divEncabezadoModal_cancelacion_pagos_caja').addClass("estatus-INACTIVO");

		   				    //Deshabilitar todos los elementos del formulario
				            $('#frmCancelacionPagosCaja').find('input, textarea, select').attr('disabled','disabled');
		   					//Ocultar botón de Guardar
				            $("#btnGuardar_cancelacion_pagos_caja").hide();
				            //Remover clase para mostrar div que contiene los datos de creación del registro
							$("#divDatosCreacion_cancelacion_pagos_caja").removeClass('no-mostrar');

							//Abrir modal
							objCancelacionPagosCaja = $('#CancelacionPagosCajaBox').bPopup({
												   appendTo: '#PagosCajaContent', 
						                           contentContainer: 'PagosCajaM', 
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
		function cerrar_cancelacion_pagos_caja()
		{
			try {
				//Cerrar modal
				objCancelacionPagosCaja.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cancelacion_pagos_caja();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cancelacion_pagos_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cancelacion_pagos_caja();
			//Validación del formulario de campos obligatorios
			$('#frmCancelacionPagosCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	intCancelacionMotivoID_pagos_caja: {
											validators: {
												notEmpty: {message: 'Seleccione un motivo'}
											}
										},
										strFolioSustitucion_cancelacion_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if(value == '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_pagos_caja').val()) === intCancelacionIDRelacionCfdiPagosCaja) 
					                                    	
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un anticipo existente'
					                                        };
					                                    }
					                                    else if(value !== '' && parseInt($('#cmbCancelacionMotivoID_cancelacion_pagos_caja').val()) !== intCancelacionIDRelacionCfdiPagosCaja)
					                                    {

					                                    	//Hacer un llamado a la función para inicializar elementos de la sustitución
					                                    	inicializar_sustitucion_pagos_caja();
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cancelacion_pagos_caja = $('#frmCancelacionPagosCaja').data('bootstrapValidator');
			bootstrapValidator_cancelacion_pagos_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cancelacion_pagos_caja.isValid())
			{
				//Hacer un llamado a la función para cancelar el timbrado de un registro
				cancelar_timbrado_pagos_caja();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cancelacion_pagos_caja()
		{
			try
			{
				$('#frmCancelacionPagosCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		
		//Función para inicializar elementos de la sustitución de CFDI
		function inicializar_sustitucion_pagos_caja()
		{
			
			//Limpiar contenido de las siguientes cajas de texto
           $('#txtSustitucionID_cancelacion_pagos_caja').val('');
           $('#txtUuidSustitucion_cancelacion_pagos_caja').val('');
           $('#txtFolioSustitucion_cancelacion_pagos_caja').val('');
		}


		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function mostrar_circulo_carga_cancelacion_pagos_caja()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_pagos_caja").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de cancelar el timbrado
		function ocultar_circulo_carga_cancelacion_pagos_caja()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cancelacion_pagos_caja").addClass('no-mostrar');
		}

		//Regresar motivos de cancelación activos para cargarlos en el combobox
		function cargar_motivos_cancelacion_pagos_caja()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_cancelacion_motivos/get_combo_box', {},
				function(data)
				{
					$('#cmbCancelacionMotivoID_cancelacion_pagos_caja').empty();
					var temp = Mustache.render($('#cancelacion_motivos_pagos_caja').html(), data);
					$('#cmbCancelacionMotivoID_cancelacion_pagos_caja').html(temp);
				},
				'json');
		}



		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cliente_pagos_caja()
		{
			//Incializar formulario
			$('#frmEnviarPagosCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_pagos_caja();
		    //Quitar clases del div para poder tomar el color correspondiente al estatus del registro
		    $('#divEncabezadoModal_cliente_pagos_caja').removeClass("estatus-ACTIVO");
		}


		//Función que se utiliza para abrir el modal
		function abrir_cliente_pagos_caja(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cliente_pagos_caja();
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtPagoID_pagos_caja').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('caja/pagos/get_datos',
			       {intPagoID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtPagoID_cliente_pagos_caja').val(data.row.pago_id);
							$('#txtFolio_cliente_pagos_caja').val(data.row.folio);
							$('#txtRazonSocial_cliente_pagos_caja').val(data.row.razon_social);
							$('#txtCorreoElectronico_cliente_pagos_caja').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_cliente_pagos_caja').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_cliente_pagos_caja').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarPagosCaja = $('#EnviarPagosCajaBox').bPopup({
																		   appendTo: '#PagosCajaContent', 
												                           contentContainer: 'PagosCajaM', 
												                           zIndex: 2, 
												                           modalClose: false, 
												                           modal: true, 
												                           follow: [true,false], 
												                           followEasing : "linear", 
												                           easing: "linear", 
												                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_cliente_pagos_caja').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cliente_pagos_caja()
		{
			try {
				//Cerrar modal
				objEnviarPagosCaja.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_cliente_pagos_caja();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cliente_pagos_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_pagos_caja();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarPagosCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_cliente_pagos_caja: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_cliente_pagos_caja: {
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
			var bootstrapValidator_cliente_pagos_caja = $('#frmEnviarPagosCaja').data('bootstrapValidator');
			bootstrapValidator_cliente_pagos_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cliente_pagos_caja.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_cliente_pagos_caja();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cliente_pagos_caja()
		{
			try
			{
				$('#frmEnviarPagosCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al cliente
		function enviar_correo_cliente_pagos_caja()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cliente_pagos_caja();
			//Hacer un llamado al método del controlador para enviar correo electrónico al cliente
			$.post('contabilidad/timbradoV4/enviar_correo_electronico_cliente',
					{ 
						intReferenciaID: $('#txtPagoID_cliente_pagos_caja').val(),
						strTipoReferencia: strTipoReferenciaPagosCaja,
						strFolio: $('#txtFolio_cliente_pagos_caja').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_cliente_pagos_caja').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_cliente_pagos_caja').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cliente_pagos_caja();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_cliente_pagos_caja();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_pagos_caja(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_cliente_pagos_caja()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_pagos_caja").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_cliente_pagos_caja()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_pagos_caja").addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones del modal Relacionar CFDI
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_cfdi_pagos_caja()
		{
			//Incializar formulario
			$('#frmRelacionarCfdiPagosCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_pagos_caja();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarCfdiPagosCaja').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_relacionar_cfdi_pagos_caja');
			//Eliminar los datos de la tabla CFDI a relacionar
		    $('#dg_relacionar_cfdi_pagos_caja tbody').empty();
		    $('#numElementos_relacionar_cfdi_pagos_caja').html(0);
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_cfdi_pagos_caja()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_cfdi_pagos_caja();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_pagos_caja').val();
			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_cfdi_pagos_caja').addClass("estatus-"+strEstatus);
			//Abrir modal
			objRelacionarCfdiPagosCaja = $('#RelacionarCfdiPagosCajaBox').bPopup({
											  appendTo: '#PagosCajaContent', 
			                              	  contentContainer: 'PagosCajaM', 
			                              	  zIndex: 2, 
			                              	  modalClose: false, 
			                              	  modal: true, 
			                              	  follow: [true,false], 
			                              	  followEasing : "linear", 
			                              	  easing: "linear", 
			                             	  modalColor: ('#F0F0F0')});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_relacionar_cfdi_pagos_caja').focus();
			//Hacer un llamado a la función  para cargar los CFDI´s en el grid
			lista_facturas_relacionar_cfdi_pagos_caja();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_cfdi_pagos_caja()
		{
			try {
				//Cerrar modal
				objRelacionarCfdiPagosCaja.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_cfdi_pagos_caja()
		{

			//Hacer un llamado a la función para agregar las facturas (CFDI) seleccionadas al  objeto CFDI's  relacionados
			agregar_facturas_relacionar_cfdi_pagos_caja();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_cfdi_pagos_caja();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarCfdiPagosCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumCfdi_relacionar_cfdi_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccionar al menos un CFDI para este pago.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFechaInicialBusq_relacionar_cfdi_pagos_caja: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaFinalBusq_relacionar_cfdi_pagos_caja: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strRazonSocialBusq_relacionar_cfdi_pagos_caja: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_relacionar_cfdi_pagos_caja = $('#frmRelacionarCfdiPagosCaja').data('bootstrapValidator');
			bootstrapValidator_relacionar_cfdi_pagos_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_cfdi_pagos_caja.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_cfdi_pagos_caja();
				//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
		  		agregar_cfdi_relacionados_pagos_caja('Nuevo', '');
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_cfdi_pagos_caja()
		{
			try
			{
				$('#frmRelacionarCfdiPagosCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar CFDI's
		*********************************************************************************************************************/
		//Función para la búsqueda de CFDI's 
		function lista_facturas_relacionar_cfdi_pagos_caja() 
		{
			//Variables que se utilizan para asignar los criterios de búsqueda
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaInicialBusq =  $.formatFechaMysql($('#txtFechaInicialBusq_relacionar_cfdi_pagos_caja').val());
			var dteFechaFinalBusq =  $.formatFechaMysql($('#txtFechaFinalBusq_relacionar_cfdi_pagos_caja').val());
			var intProspectoIDBusq =  $('#txtProspectoIDBusq_relacionar_cfdi_pagos_caja').val();

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
						$('#dg_relacionar_cfdi_pagos_caja tbody').empty();
						var tmpRelacionarCfdiPagosCaja = Mustache.render($('#plantilla_relacionar_cfdi_pagos_caja').html(),data);
						$('#numElementos_relacionar_cfdi_pagos_caja').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_cfdi_pagos_caja').html(data.rows.length);	
						}
						$('#dg_relacionar_cfdi_pagos_caja tbody').html(tmpRelacionarCfdiPagosCaja);
						
					},
			'json');

			
		}

		//Función para agregar las facturas (CFDI) seleccionadas al objeto CFDI's  relacionados
		function agregar_facturas_relacionar_cfdi_pagos_caja()
		{
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
             
            //Crear instancia del objeto CFDI´s relacionados (facturas seleccionadas)
			objCfdisRelacionadosPagosCaja = new CfdisRelacionadosPagosCaja([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_cfdi_pagos_caja tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
                	//Crear instancia del objeto CFDI a relacionar
					objCfdiRelacionarPagosCaja = new CfdiRelacionarPagosCaja(null, '', '', '', '', '', '');

                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objCfdiRelacionarPagosCaja.intReferenciaID = strValor;
							        break;
							    case 1:
							        objCfdiRelacionarPagosCaja.strCliente = strValor;
							        break;
							    case 2:
							        objCfdiRelacionarPagosCaja.strFolio = strValor;
							        break;
							    case 3:
							        objCfdiRelacionarPagosCaja.dteFecha = strValor;
							        break;
							    case 4:
							        objCfdiRelacionarPagosCaja.strTipoReferencia = strValor;
							        break;
							    case 5:
							       	objCfdiRelacionarPagosCaja.strUuid = strValor;
							        break;
							    case 6:
							       	objCfdiRelacionarPagosCaja.intImporte = strValor;
							       	break;
							}

					      	intCol++;
					    });

                	//Agregar datos del cfdi a relacionar
                	objCfdisRelacionadosPagosCaja.setCfdi(objCfdiRelacionarPagosCaja);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumCfdi_relacionar_cfdi_pagos_caja').val(intContador);

		}

		/*******************************************************************************************************************
		Funciones del modal Pagos
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_pagos_caja()
		{
			//Incializar formulario
			$('#frmPagosCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_pagos_caja();
			//Limpiar cajas de texto ocultas
			$('#frmPagosCaja').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_pagos_caja');
			//Seleccionar tab que contiene la información general
		  	$('a[href="#informacion_general_pagos_caja"]').click();
			//Asignar la fecha actual
			$('#txtFecha_pagos_caja').val(fechaActual());
			//Eliminar los datos de la tabla CFDI relacionados
		    $('#dg_cfdi_relacionados_pagos_caja tbody').empty();
			$('#numElementos_cfdi_relacionados_pagos_caja').html(0);
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_pagos_caja();
			//Habilitar todos los elementos del formulario
			$('#frmPagosCaja').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_pagos_caja').attr("disabled", "disabled");
			$('#txtRfc_pagos_caja').attr("disabled", "disabled");
			//Mostrar por Default 01- No aplica
			$('#cmbExportacionID_pagos_caja').val(intExportacionBaseIDPagosCaja);
			//Mostrar los siguientes botones
			$("#btnGuardar_pagos_caja").show();
			$("#btnAgregar_pagos_caja").show(); 
			$("#btnBuscarCFDI_pagos_caja").show(); 
			//Ocultar los siguientes botones
			$("#btnEnviarCorreo_pagos_caja").hide();
			$("#btnImprimirRegistro_pagos_caja").hide();
			$("#btnDescargarArchivo_pagos_caja").hide();
			$("#btnDesactivar_pagos_caja").hide();
			$('#btnVerMotivoCancelacion_pagos_caja').hide();
			//Deshabilitar botón Agregar detalle
			$('#btnAgregar_pagos_caja').attr('disabled','-1'); 
		}
		

		//Función para inicializar elementos del cliente
		function inicializar_cliente_pagos_caja()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#txtRfc_pagos_caja").val('');
            $("#txtRegimenFiscalID_pagos_caja").val('');
            $("#txtCalle_pagos_caja").val('');
            $("#txtNumeroExterior_pagos_caja").val('');
            $("#txtNumeroInterior_pagos_caja").val('');
            $("#txtCodigoPostal_pagos_caja").val('');
            $("#txtColonia_pagos_caja").val('');
            $("#txtLocalidad_pagos_caja").val('');
            $("#txtMunicipio_pagos_caja").val('');
            $("#txtEstado_pagos_caja").val('');
            $("#txtPais_pagos_caja").val('');
            //Deshabilitar botón Agregar detalle
            $('#btnAgregar_pagos_caja').attr('disabled','-1');

             //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		     inicializar_detalles_pagos_caja();
		}


		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_pagos_caja() 
		{
			//Eliminar los datos de la tabla detalles del pago
		    $('#dg_detalles_pagos_caja tbody').empty();
			$('#numElementos_detalles_pagos_caja').html(0);
			//Crear instancia del objeto Detalles del pago
			objDetallesPagoPagosCaja = new DetallesPagoPagosCaja([]);
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_pagos_caja()
		{
			try {
                
                //Hacer un llamado a la función para cerrar modal Cancelación del timbrado
				cerrar_cancelacion_pagos_caja();
                //Hacer un llamado a la función para cerrar modal Relacionar CFDI
				cerrar_relacionar_cfdi_pagos_caja();
				//Hacer un llamado a la función para cerrar modal Relacionar Documentos (facturas) del Detalle
				cerrar_relacionar_fras_detalle_pagos_caja();
				//Hacer un llamado a la función para cerrar modal Detalle del Pago
				cerrar_detalle_pagos_caja();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
	       		ocultar_circulo_carga_pagos_caja('');
				//Cerrar modal
				objPagosCaja.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_pagos_caja').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_pagos_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_pagos_caja();

			//Validación del formulario de campos obligatorios
			$('#frmPagosCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_pagos_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strRazonSocial_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del cliente
					                                    if($('#txtProspectoID_pagos_caja').val() === '')
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
										strUsoCfdi_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del uso de CFDI
					                                    if($('#txtUsoCfdiID_pagos_caja').val() === '')
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
										strTipoRelacion_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de relación
					                                    if((value !== '' && $('#txtTipoRelacionID_pagos_caja').val() === '') 
					                                    	|| ($('#txtTipoRelacionID_pagos_caja').val() === '' && parseInt($('#txtNumCfdiRelacionados_pagos_caja').val()) > 0))
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
										intExportacionID_pagos_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una exportación'}
											}
										},
										intNumCfdiRelacionados_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan CFDI relacionados
					                                    if(parseInt($('#txtTipoRelacionID_pagos_caja').val()) > 0 &&
					                                    	(parseInt(value) === 0 || value === ''))
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un CFDI para este pago.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intNumDetalles_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para este pago.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_pagos_caja = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_pagos_caja = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_pagos_caja.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_pagos_caja.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_pagos_caja = $('#frmPagosCaja').data('bootstrapValidator');
			bootstrapValidator_pagos_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_pagos_caja.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_pagos_caja();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_pagos_caja()
		{
			try
			{
				$('#frmPagosCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_pagos_caja()
		{
			//Obtenemos el objeto de la tabla CFDI relacionados
			var objTabla = document.getElementById('dg_cfdi_relacionados_pagos_caja').getElementsByTagName('tbody')[0];

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
			
			//Hacer un llamado a la función JSON para guardar los detalles del pago
			var jsonDetalles = JSON.stringify(objDetallesPagoPagosCaja); 

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('caja/pagos/guardar',
					{ 
						//Datos del pago
						intPagoID: $('#txtPagoID_pagos_caja').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_pagos_caja').val()),
						intProspectoID: $('#txtProspectoID_pagos_caja').val(),
						strRazonSocial: $('#txtRazonSocial_pagos_caja').val(),
						strRfc: $('#txtRfc_pagos_caja').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_pagos_caja').val(),
						strCalle: $('#txtCalle_pagos_caja').val(),
						strNumeroExterior: $('#txtNumeroExterior_pagos_caja').val(),
						strNumeroInterior: $('#txtNumeroInterior_pagos_caja').val(),
						strCodigoPostal: $('#txtCodigoPostal_pagos_caja').val(),
						strColonia: $('#txtColonia_pagos_caja').val(),
						strLocalidad: $('#txtLocalidad_pagos_caja').val(),
						strMunicipio: $('#txtMunicipio_pagos_caja').val(),
						strEstado: $('#txtEstado_pagos_caja').val(),
						strPais: $('#txtPais_pagos_caja').val(),
						intUsoCfdiID: $('#txtUsoCfdiID_pagos_caja').val(),
						intTipoRelacionID: $('#txtTipoRelacionID_pagos_caja').val(),
						intExportacionID: $('#cmbExportacionID_pagos_caja').val(),
						strObjetoImpuestoSat: $('#txtObjetoImpuestoSat_pagos_caja').val(),
						strObservaciones: $('#txtObservaciones_pagos_caja').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_pagos_caja').val(),
						//Datos de los CFDI relacionados
						strCfdiRelacionado: arrCfdiRelacionado.join('|'),
						strTiposRelacion: arrTiposRelacion.join('|'),
						//Datos de los detalles
						arrDetalles: jsonDetalles
					},
					function(data) {
						if (data.resultado)
						{

							//Si no existe id del pago, significa que es un nuevo registro   
							if($('#txtPagoID_pagos_caja').val() == '')
							{
							  	//Asignar el id del pago registrada en la base de datos
                     			$('#txtPagoID_pagos_caja').val(data.pago_id);
                 			}

                 			//Hacer llamado a la función para cargar  los registros en el grid
							paginacion_pagos_caja();
						    
							//Hacer un llamado a la función para timbrar los datos del registro
							timbrar_pagos_caja($('#txtPagoID_pagos_caja').val(), 'modal', '', $('#txtRegimenFiscalID_pagos_caja').val());

							//Si no existe id de la póliza (o se trata de un nuevo registro)
							if(parseInt($('#txtPolizaID_pagos_caja').val()) == 0 || 
								$('#txtEstatus_pagos_caja').val() == '')
							{
								//Hacer un llamado a la función para generar póliza con los datos del registro
								 generar_poliza_pagos_caja('', '', '');
							}
								               
						}

						//Si existe mensaje de error
						if(data.tipo_mensaje == 'error')
						{
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_pagos_caja(data.tipo_mensaje, data.mensaje);
						}
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_pagos_caja(tipoMensaje, mensaje, campoID)
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
				new $.Zebra_Dialog(strMsjRegimenFiscalCtePagosCaja, 
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
		function cambiar_estatus_pagos_caja(id, folio, polizaID, folioPoliza)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para asignar el folio del registro
			var strFolio = '';
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Variable que se utiliza para asignar el id de la póliza
			var intPolizaID = 0;
			 //Variable que se utiliza para asignar el folio de la póliza
			var strFolioPoliza = '';
			 //Variable que se utiliza para asignar mensaje informativo
		    var strMensaje = '¿Está seguro que desea cancelar el registro ';

			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtPagoID_pagos_caja').val();
				strFolio = $('#txtFolio_pagos_caja').val();
				intPolizaID = $('#txtPolizaID_pagos_caja').val();
				strFolioPoliza = $('#txtFolioPoliza_pagos_caja').val();
			}
			else
			{
				intID = id;
				strFolio = folio;
				intPolizaID = polizaID;
				strFolioPoliza = folioPoliza;
				strTipo = 'gridview';
			}

			//Si existe el id de la póliza
			if(intPolizaID > 0)
			{
				strMensaje += '; también se cancelara la póliza con folio: '+strFolioPoliza;
			}

			strMensaje += '?';


			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>'+strMensaje+'</strong>',
			             {'type':     'question',
			              'title':    'Pagos',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
	                            if(caption == 'Aceptar')
	                            {
                                    //Hacer un llamado a la función para abrir el modal Cancelación del timbrado (cambiar estatus y cancelar timbrado del registro)
					                 abrir_cancelacion_pagos_caja(intID, strFolio, intPolizaID);

	                            }
			            }
			}); 

		}

		//Función para cancelar el timbrado de un registro. Cambia el estatus a INACTIVO
		function cancelar_timbrado_pagos_caja()
		{

			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cancelacion_pagos_caja();

			 //Hacer un llamado al método del controlador para cancelar un CFDI y posteriormente cambiar el estatus a INACTIVO
	         //----- CÓDIGO PARA PRODUCCIÓN
	          $.post('contabilidad/timbrado_cancelar/set_cancelar',
	          {
	          		//Datos para cancelar el timbrado (CFDI)
	         		intMovimientoID: $('#txtReferenciaCfdiID_cancelacion_pagos_caja').val(),
					strTipoReferencia: strTipoReferenciaPagosCaja, 
					strUuidSustitucion: $('#txtUuidSustitucion_cancelacion_pagos_caja').val(),
					strMotivo: $('select[name="intCancelacionMotivoID_pagos_caja"] option:selected').text(),
					//Datos para cambiar (administrativamente) el estatus del registro
					intCancelacionMotivoID: $('#cmbCancelacionMotivoID_cancelacion_pagos_caja').val(), 
					intSustitucionID:  $('#txtSustitucionID_cancelacion_pagos_caja').val(),
					intPolizaID: $('#txtPolizaID_cancelacion_pagos_caja').val()

	          },
	                 function(data) {

	                    if(data.resultado)
	                    {
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_pagos_caja();	

							//Hacer un llamado a la función para cerrar modal Cancelación del timbrado
							cerrar_cancelacion_pagos_caja();  

							//Si el id del registro se obtuvo del modal
							if($('#txtPagoID_pagos_caja').val() != '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_pagos_caja();     
							}		
	                    }

	                    //Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
				        ocultar_circulo_carga_cancelacion_pagos_caja();
					    //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_pagos_caja(data.tipo_mensaje, data.mensaje);


	                 },
	                'json');

		}

		

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_pagos_caja(id, tipoAccion, cancelacionID)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('caja/pagos/get_datos',
			       {intPagoID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_pagos_caja();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar el id de la póliza
				            var intPolizaID = parseInt(data.row.poliza_id); 

				          	//Recuperar valores
				          	$('#txtPagoID_pagos_caja').val(data.row.pago_id);
				          	$('#txtFolio_pagos_caja').val(data.row.folio);
				          	$('#txtFecha_pagos_caja').val(data.row.fecha_format);
				          	$('#cmbMonedaID_pagos_caja').val(data.row.moneda_id);
				          	$('#txtTipoCambio_pagos_caja').val(data.row.tipo_cambio);
						    $('#txtProspectoID_pagos_caja').val(data.row.prospecto_id);
						    $('#txtRazonSocial_pagos_caja').val(data.row.razon_social);
						    $('#txtRfc_pagos_caja').val(data.row.rfc);
						    $('#txtRegimenFiscalID_pagos_caja').val(data.row.regimen_fiscal_id);
						    $('#txtCalle_pagos_caja').val(data.row.calle);
						    $('#txtNumeroExterior_pagos_caja').val(data.row.numero_exterior);
						    $('#txtNumeroInterior_pagos_caja').val(data.row.numero_interior);
						    $('#txtCodigoPostal_pagos_caja').val(data.row.codigo_postal);
						    $('#txtColonia_pagos_caja').val(data.row.colonia);
						    $('#txtLocalidad_pagos_caja').val(data.row.localidad);
						    $('#txtMunicipio_pagos_caja').val(data.row.municipio);
						    $('#txtEstado_pagos_caja').val(data.row.estado);
						    $('#txtPais_pagos_caja').val(data.row.pais);
						    $('#txtUsoCfdiID_pagos_caja').val(data.row.uso_cfdi_id);
						    $('#txtUsoCfdi_pagos_caja').val(data.row.uso_cfdi);
						    $('#txtTipoRelacionID_pagos_caja').val(data.row.tipo_relacion_id);
						    $('#txtTipoRelacion_pagos_caja').val(data.row.tipo_relacion);
						    $('#cmbExportacionID_pagos_caja').val(data.row.exportacion_id);
						    $('#txtObjetoImpuestoSat_pagos_caja').val(data.row.objeto_impuesto_sat);
				            $('#txtObjetoImpuesto_pagos_caja').val(data.row.objeto_impuesto);
					        $('#txtObservaciones_pagos_caja').val(data.row.observaciones);
					        $('#txtPolizaID_pagos_caja').val(intPolizaID);
						    $('#txtFolioPoliza_pagos_caja').val(data.row.folio_poliza);
						    $('#txtAnticiposAplicar_pagos_caja').val(data.row.anticiposAplicar);
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_pagos_caja').addClass("estatus-"+strEstatus);
				            $('#txtEstatus_pagos_caja').val(strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_pagos_caja").show();
				            //Deshabilitar caja de texto
				            $("#txtRazonSocial_pagos_caja").attr('disabled','disabled');

				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';

				            //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar botón Descargar Archivo
				            	$("#btnDescargarArchivo_pagos_caja").show();
				           	}
				           	


				            //Si el estatus del registro es TIMBRAR
				            if(strEstatus == 'TIMBRAR')
							{

								//Si existe id de la póliza
				            	if(intPolizaID > 0)
				            	{
				            		//Hacer un llamado a la función para habilitar campos de timbrado
				            		habilitar_controles_timbrado_pagos_caja();

				            	}
				            	else
				            	{
				            		//Habilitar botón Agregar detalle
									$('#btnAgregar_pagos_caja').removeAttr('disabled');

									strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
														 " onclick='editar_renglon_detalle_pagos_caja(this)'>" + 
														 "<span class='glyphicon glyphicon-edit'></span></button>" + 
														 "<button class='btn btn-default btn-xs' title='Eliminar'" +
														 " onclick='eliminar_renglon_detalle_pagos_caja(this)'>" + 
														 "<span class='glyphicon glyphicon-trash'></span></button>" + 
														 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
														 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
														 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
														 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	}
				            	
				            	
							}
							else 
							{
								strAccionesTabla = "<button class='btn btn-default btn-xs' title='Ver'" +
													 " onclick='editar_renglon_detalle_pagos_caja(this)'>" + 
													 "<span class='glyphicon glyphicon-eye-open'></span></button>";

								//Si el estatus del registro es ACTIVO
								if(strEstatus == 'ACTIVO')
								{
									//Mostrar bóton Enviar correo 
									$("#btnEnviarCorreo_pagos_caja").show();

									//Si se cumple la sentencia
									if(intPolizaID > 0)
									{
										//Mostrar bóton Desactivar
										$('#btnDesactivar_pagos_caja').show();
									}
									
								}

								//Deshabilitar todos los elementos del formulario
				            	$('#frmPagosCaja').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_pagos_caja").hide(); 
					            $("#btnAgregar_pagos_caja").hide(); 
					            $("#btnBuscarCFDI_pagos_caja").hide(); 

					            //Si existe id de la cancelación del CFDI
								if(cancelacionID > 0)
								{	
									//Asignar el id de la cancelación
									$("#txtCancelacionID_pagos_caja").val(cancelacionID); 
									//Mostrar botón Motivo de cancelación
									$("#btnVerMotivoCancelacion_pagos_caja").show(); 
								}
							}

							//Hacer un llamado a la función para agregar los CFDI´s en la tabla CFDI relacionados
							agregar_cfdi_relacionados_pagos_caja('Editar', strEstatus);	

				            //Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Crear instancia del objeto Detalle del pago
								objDetallePagoPagosCaja = new DetallePagoPagosCaja('', '', '', '', '', '', '', '', '', '', 
													                               '', '', '', '', '', '', '', '', '', '', 
													   							   '', '', '', '', []);

								//Variable que se utiliza para asignar la moneda del pago
								var intMonedaIDDetallePago = parseInt(data.detalles[intCon].moneda_id);
								//Variable que se utiliza para asignar el tipo de cambio del pago
				            	var intTipoCambioDet = parseFloat(data.detalles[intCon].tipo_cambio);
				            	//Variable que se utiliza para asignar el monto
				            	var intMontoDet = parseFloat(data.detalles[intCon].monto);

				            	//Convertir peso mexicano a tipo de cambio
							    var intMontoAux = intMontoDet / intTipoCambioDet;

							    //Variable que se utiliza para asignar el saldo del anticipo por aplicar
							     var intSaldoAnticipo = parseFloat(data.detalles[intCon].total_aplicar);


							     //Convertir peso mexicano a tipo de cambio
				            	 intSaldoAnticipo = intSaldoAnticipo / intTipoCambioDet;

								//Asignar valores
								objDetallePagoPagosCaja.dteFecha = data.detalles[intCon].fecha;
							    objDetallePagoPagosCaja.strHora = data.detalles[intCon].hora;
							    objDetallePagoPagosCaja.dteFechaPago = data.detalles[intCon].fecha_pago;
							    objDetallePagoPagosCaja.intFormaPagoID = data.detalles[intCon].forma_pago_id;
							    objDetallePagoPagosCaja.strFormaPago = data.detalles[intCon].forma_pago;
							    objDetallePagoPagosCaja.intMonedaID = data.detalles[intCon].moneda_id;
							    objDetallePagoPagosCaja.strMoneda = data.detalles[intCon].moneda;
							    objDetallePagoPagosCaja.intTipoCambio = data.detalles[intCon].tipo_cambio;
							    objDetallePagoPagosCaja.intMonto = data.detalles[intCon].monto;
							    objDetallePagoPagosCaja.intAnticipoID = data.detalles[intCon].anticipo_id;
							    objDetallePagoPagosCaja.strAnticipo = data.detalles[intCon].folio_anticipo;
							    objDetallePagoPagosCaja.intSaldoAnticipo = formatMoney(intSaldoAnticipo, 2, '');
							    objDetallePagoPagosCaja.strNumOperacion = data.detalles[intCon].num_operacion;
							    objDetallePagoPagosCaja.strRfcEmisorCtaOrd = data.detalles[intCon].rfc_emisor_cta_ord;
							    objDetallePagoPagosCaja.strNomBancoOrdExt = data.detalles[intCon].nom_banco_ord_ext;
							    objDetallePagoPagosCaja.strCtaOrdenante = data.detalles[intCon].cta_ordenante;
							    objDetallePagoPagosCaja.intCuentaBancariaID = data.detalles[intCon].cuenta_bancaria_id;
							    objDetallePagoPagosCaja.strRfcEmisorCtaBen = data.detalles[intCon].rfc_emisor_cta_ben;
							    objDetallePagoPagosCaja.strCtaBeneficiario = data.detalles[intCon].cta_beneficiario;
							    objDetallePagoPagosCaja.strCuentaBancaria = data.detalles[intCon].cuenta_bancaria;
							    objDetallePagoPagosCaja.intCadenaPagoID = data.detalles[intCon].cadena_pago_id;
							    objDetallePagoPagosCaja.strCadenaPago = data.detalles[intCon].cadena_pago;
							    objDetallePagoPagosCaja.strCerPago = data.detalles[intCon].cer_pago;
							    objDetallePagoPagosCaja.strCadPago = data.detalles[intCon].cad_pago;
							    objDetallePagoPagosCaja.strSelloPago = data.detalles[intCon].sello_pago;

							    //Array que se utiliza para agregar los detalles relacionados del registro
								var arrDetallesRelacionadosReg = [];

								
					            //Mostramos los detalles relacionados del registro
					            for (var intConDR in  data.detalles[intCon].arrDetallesRelacionados) 
					            {
					            	
					            	//Variable que se utiliza para asignar el tipo de cambio del pago (evitar perder el valor)
									var intTipoCambioDetallePago = intTipoCambioDet;

									//Variables que se utilizan para asignar los valores del detalle relacionado
									var intTipoCambio = parseFloat(data.detalles[intCon].arrDetallesRelacionados[intConDR].tipo_cambio);
									var intMonedaID = parseInt(data.detalles[intCon].arrDetallesRelacionados[intConDR].moneda_id);
									var intImpPagadoAux = parseFloat(data.detalles[intCon].arrDetallesRelacionados[intConDR].imp_pagado);

									//Si la moneda del pago es diferente a la moneda de la factura
									if(intMonedaIDDetallePago !== intMonedaID)
									{
									    //Asignar el tipo de cambio de la factura
										intTipoCambioDetallePago = intTipoCambio;
									}

									//Convertir peso mexicano a tipo de cambio del pago
									intImpPagadoAux = intImpPagadoAux / intTipoCambioDetallePago;

					            	//Crear instancia del objeto Detalle relacionado
									objDetalleRelacionadoPagosCaja = new DetalleRelacionadoPagosCaja(null, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '','', '');

									//Asignar valores 
									objDetalleRelacionadoPagosCaja.intReferenciaID = data.detalles[intCon].arrDetallesRelacionados[intConDR].referencia_id;
									objDetalleRelacionadoPagosCaja.strTipoReferencia = data.detalles[intCon].arrDetallesRelacionados[intConDR].tipo_referencia;
									objDetalleRelacionadoPagosCaja.strFolio = data.detalles[intCon].arrDetallesRelacionados[intConDR].folio;
									objDetalleRelacionadoPagosCaja.strUuid = data.detalles[intCon].arrDetallesRelacionados[intConDR].uuid;

									objDetalleRelacionadoPagosCaja.strObjetoImpuestoSat = data.detalles[intCon].arrDetallesRelacionados[intConDR].objeto_impuesto_sat;
									objDetalleRelacionadoPagosCaja.strObjetoImpuesto = data.detalles[intCon].arrDetallesRelacionados[intConDR].objeto_impuesto;
									objDetalleRelacionadoPagosCaja.intMonedaID = data.detalles[intCon].arrDetallesRelacionados[intConDR].moneda_id;
									objDetalleRelacionadoPagosCaja.strMonedaTipo = data.detalles[intCon].arrDetallesRelacionados[intConDR].moneda_tipo;
									objDetalleRelacionadoPagosCaja.intTipoCambio = data.detalles[intCon].arrDetallesRelacionados[intConDR].tipo_cambio;
									objDetalleRelacionadoPagosCaja.intMetodoPagoID = data.detalles[intCon].arrDetallesRelacionados[intConDR].metodo_pago_id;
									objDetalleRelacionadoPagosCaja.strMetodoPago = data.detalles[intCon].arrDetallesRelacionados[intConDR].metodo_pago;
									objDetalleRelacionadoPagosCaja.intNumParcialidades = data.detalles[intCon].arrDetallesRelacionados[intConDR].num_parcialidad;
									objDetalleRelacionadoPagosCaja.intImpSaldoAnt = data.detalles[intCon].arrDetallesRelacionados[intConDR].imp_saldo_ant;
									objDetalleRelacionadoPagosCaja.intImpPagado = data.detalles[intCon].arrDetallesRelacionados[intConDR].imp_pagado;
									objDetalleRelacionadoPagosCaja.intImpSaldoInsoluto = data.detalles[intCon].arrDetallesRelacionados[intConDR].imp_saldo_insoluto;
									objDetalleRelacionadoPagosCaja.intSaldoFactura = data.detalles[intCon].arrDetallesRelacionados[intConDR].saldo_factura;
									objDetalleRelacionadoPagosCaja.intNumPagosMayorParcialidad = data.detalles[intCon].arrDetallesRelacionados[intConDR].num_pagos_mayor_parcialidad;
									objDetalleRelacionadoPagosCaja.intImpPagadoAux = intImpPagadoAux;
									//Agregar objeto en el array
									arrDetallesRelacionadosReg.push(objDetalleRelacionadoPagosCaja);

					            }

					            //Agregar array con los detalles relacionados del pago
            					objDetallePagoPagosCaja.setDetallesRelacionados(arrDetallesRelacionadosReg);
            					//Agregar datos del detalle del pago
           						objDetallesPagoPagosCaja.setDetalle(objDetallePagoPagosCaja);

           						//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_pagos_caja').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaFechaHora = objRenglon.insertCell(0);
								var objCeldaFormaPago = objRenglon.insertCell(1);
								var objCeldaMoneda = objRenglon.insertCell(2);
								var objCeldaTipoCambio = objRenglon.insertCell(3);
								var objCeldaMonto = objRenglon.insertCell(4);
								var objCeldaAcciones = objRenglon.insertCell(5);

								//Concatenar los datos de la fecha y hora
		    					var strFechaHora = objDetallePagoPagosCaja.dteFecha+' '+objDetallePagoPagosCaja.strHora;

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', intCon);
								objCeldaFechaHora.setAttribute('class', 'movil d1');
								objCeldaFechaHora.innerHTML = strFechaHora;
							    objCeldaFormaPago.setAttribute('class', 'movil d2');
								objCeldaFormaPago.innerHTML = objDetallePagoPagosCaja.strFormaPago;
								objCeldaMoneda.setAttribute('class', 'movil d3');
								objCeldaMoneda.innerHTML = objDetallePagoPagosCaja.strMoneda;
								objCeldaTipoCambio.setAttribute('class', 'movil d4');
								objCeldaTipoCambio.innerHTML = objDetallePagoPagosCaja.intTipoCambio;
								objCeldaMonto.setAttribute('class', 'movil d5');
								objCeldaMonto.innerHTML = '$'+formatMoney(intMontoAux, 2, '');
								objCeldaAcciones.setAttribute('class', 'td-center movil d6');
								objCeldaAcciones.innerHTML = strAccionesTabla; 

				            }

				            //Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
							var intFilas = $("#dg_detalles_pagos_caja tr").length - 1;
							$('#numElementos_detalles_pagos_caja').html(intFilas);
							$('#txtNumDetalles_pagos_caja').val(intFilas);

							//Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objPagosCaja = $('#PagosCajaBox').bPopup({
													  appendTo: '#PagosCajaContent', 
						                              contentContainer: 'PagosCajaM', 
						                              zIndex: 2, 
						                              modalClose: false, 
						                              modal: true, 
						                              follow: [true,false], 
						                              followEasing : "linear", 
						                              easing: "linear", 
						                              modalColor: ('#F0F0F0')});
					        }

				             //Enfocar caja de texto
							$('#txtRazonSocial_pagos_caja').focus();
			       	    }
			       },
			       'json');
		}

		//Función para habilitar controles del formulario correspondientes al timbrado
		function habilitar_controles_timbrado_pagos_caja()
		{
			//Deshabilitar todos los elementos del formulario
        	$('#frmPagosCaja').find('input, textarea, select').attr('disabled','disabled');
        	//Habilitar las siguientes cajas de texto
        	$('#txtFormaPago_pagos_caja').removeAttr('disabled');
        	$('#txtUsoCfdi_pagos_caja').removeAttr('disabled');
        	$('#txtTipoRelacion_pagos_caja').removeAttr('disabled');
        	$('#cmbExportacionID_pagos_caja').removeAttr('disabled');
        	$('#txtObjetoImpuesto_pagos_caja').removeAttr('disabled');
        	$('#txtObservaciones_pagos_caja').removeAttr('disabled');
		}


		//Función para regresar obtener los datos de un cliente
		function get_datos_cliente_pagos_caja()
		{
			//Hacer un llamado al método del controlador para regresar los datos del cliente
            $.post('cuentas_cobrar/clientes/get_datos',
                  { 
                  	intProspectoID:$("#txtProspectoID_pagos_caja").val()
                  },
                  function(data) {
                    if(data.row){
                       
                        //Asignar datos del registro seleccionado
                       $("#txtRazonSocial_pagos_caja").val(data.row.razon_social);
                       $("#txtRfc_pagos_caja").val(data.row.rfc);
                       $('#txtRegimenFiscalID_pagos_caja').val(data.row.regimen_fiscal_id);
                       $("#txtCalle_pagos_caja").val(data.row.calle);
                       $("#txtNumeroExterior_pagos_caja").val(data.row.numero_exterior);
                       $("#txtNumeroInterior_pagos_caja").val(data.row.numero_interior);
                       $("#txtCodigoPostal_pagos_caja").val(data.row.codigo_postal);
                       $("#txtColonia_pagos_caja").val(data.row.colonia);
                       $("#txtLocalidad_pagos_caja").val(data.row.localidad);
                       $("#txtMunicipio_pagos_caja").val(data.row.municipio);
                       $("#txtEstado_pagos_caja").val(data.row.estado_rep);
                       $("#txtPais_pagos_caja").val(data.row.pais_rep);
                       //Habilitar botón Agregar detalle
              		   $('#btnAgregar_pagos_caja').removeAttr('disabled');
                    }
                  }
                 ,
                'json');
		}


	    //Función para timbrar los datos de un registro
		function timbrar_pagos_caja(id, tipo, formulario, regimenFiscalID)
		{
			//Si existe id del régimen fiscal
			if(regimenFiscalID > 0)
			{
				//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
				mostrar_circulo_carga_pagos_caja(formulario);
				//Hacer un llamado al método del controlador para timbrar los datos del registro
				$.post('contabilidad/timbradoV4/set_timbrar',
			     {
			     	intReferenciaID: id,
			      	strTipoReferencia: strTipoReferenciaPagosCaja
			     },
			     function(data) {

					//Si el id del registro se obtuvo del modal
					if(tipo == 'modal')
					{
						//Si existe resultado (los datos se timbraron correctamente)
						if (data.resultado)
						{

							//Hacer un llamado a la función para cerrar modal
							cerrar_pagos_caja();  
						}
						else
						{

							//Hacer un llamado a la función para limpiar los mensajes de error 
							limpiar_mensajes_pagos_caja();
							//Hacer un llamado a la función para cargar datos del registro (habilitar campos de timbrado)
							editar_pagos_caja(id,'Nuevo');

						}
					}


					//Hacer llamado a la función para cargar  los registros en el grid
				    paginacion_pagos_caja();
					//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		            ocultar_circulo_carga_pagos_caja(formulario);
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_pagos_caja(data.tipo_mensaje, data.mensaje);
			     },
			     'json');
			}
			else
			{
				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				 mensaje_pagos_caja('error_regimen_fiscal');
			}
			
		}


		//Función para generar póliza con los datos de un registro
		function generar_poliza_pagos_caja(id, anticiposAplicar, formulario)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para asignar el número de anticipos por aplicar
			var intAnticiposAplicar = 0;

			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtPagoID_pagos_caja').val();
				intAnticiposAplicar = $('#txtAnticiposAplicar_pagos_caja').val();
			}
			else
			{
				intID = id;
				intAnticiposAplicar = anticiposAplicar;
			}


			//Si existen detalles sin anticipo (pólizas de aplicación)
			if(intAnticiposAplicar > 0)
			{
				//Variable que se utiliza para asignar el mensaje de error
				var strMensaje = "No es posible generar póliza, favor de ingresar el anticipo (detalles del pago).";

				//Hacer un llamado a la función para mostrar mensaje de información
				mensaje_pagos_caja('error', strMensaje);
			}
			else
			{
				//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
				mostrar_circulo_carga_pagos_caja(formulario);
				//Hacer un llamado al método del controlador para timbrar los datos del registro
				$.post('contabilidad/generar_polizas/generar_poliza',
			     {
			     	intReferenciaID: intID,
			      	strTipoReferencia: strTipoReferenciaPagosCaja, 
			      	intProcesoMenuID: $('#txtProcesoMenuID_pagos_caja').val()
			     },
			     function(data) {

			     	//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
				    ocultar_circulo_carga_pagos_caja(formulario);
				    //Si existe resultado
					if (data.resultado)
					{
						//Asignar el id de la póliza (generada) y evitar duplicidad de datos en caso de que no sea posible timbrar el registro
                   		 $('#txtPolizaID_pagos_caja').val(data.poliza_id);
						//Hacer llamado a la función para cargar  los registros en el grid
						paginacion_pagos_caja();
						
					}

					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_pagos_caja(data.tipo_mensaje, data.mensaje);

			     },
			     'json');
			}
			
		}

		
		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function mostrar_circulo_carga_pagos_caja(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_pagos_caja';

			//Si el Div a mostrar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_pagos_caja';
			}

			//Remover clase para mostrar div que contiene la barra de carga
			$("#"+strCampoID).removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de timbrar un registro
		function ocultar_circulo_carga_pagos_caja(formulario)
		{
			//Variable que se utiliza para asignar el id del Div que contiene el bar cícrculo
			var strCampoID = 'divCirculoBarProgreso_pagos_caja';

			//Si el Div a ocultar se encuentra en el formulario principal
			if(formulario == 'principal')
			{
				strCampoID = 'divCirculoBarProgresoPrincipal_pagos_caja';
			}

			//Agregar clase para ocultar div que contiene la barra de carga
			$("#"+strCampoID).addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones de la tabla CFDI relacionados
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_cfdi_relacionados_pagos_caja(tipoAccion, estatus)
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Si se cumple la sentencia
			if(estatus == '' || estatus == 'TIMBRAR')
			{
				strAccionesTabla = "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_cfdi_relacionados_pagos_caja(this)'>" + 
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
							intReferenciaID: $('#txtPagoID_pagos_caja').val(),
							strTipoReferencia: strTipoReferenciaPagosCaja
						},
						function(data){

							//Mostramos los CFDI´s relacionados (facturas seleccionadas)
				           	for (var intCon in data.rows) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_cfdi_relacionados_pagos_caja').getElementsByTagName('tbody')[0];

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
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
								objCeldaReferenciaID.innerHTML =  data.rows[intCon].referencia_id;

				            }

				            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
							var intFilas = $("#dg_cfdi_relacionados_pagos_caja tr").length - 1;
							$('#numElementos_cfdi_relacionados_pagos_caja').html(intFilas);
							$('#txtNumCfdiRelacionados_pagos_caja').val(intFilas);
						},
				'json');
			}
			else
			{
				//Mostramos los CFDI´s relacionados (facturas seleccionadas)
				for (var intCon in objCfdisRelacionadosPagosCaja.getCfdis()) 
	            {
	            	//Crear instancia del objeto CFDI a relacionar 
	            	objCfdiRelacionarPagosCaja = new CfdiRelacionarPagosCaja();
	            	//Asignar datos del CFDI corespondiente al indice
	            	objCfdiRelacionarPagosCaja = objCfdisRelacionadosPagosCaja.getCfdi(intCon);
	            	
	            	//Obtenemos el objeto de la tabla
					var objTabla = document.getElementById('dg_cfdi_relacionados_pagos_caja').getElementsByTagName('tbody')[0];

				    //Variable que se utiliza para asignar el id del detalle
					var strDetalleID =  objCfdiRelacionarPagosCaja.intReferenciaID+'_'+objCfdiRelacionarPagosCaja.strTipoReferencia;

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
						objCeldaCliente.innerHTML = objCfdiRelacionarPagosCaja.strCliente;
						objCeldaFolio.setAttribute('class', 'movil c2');
						objCeldaFolio.innerHTML = objCfdiRelacionarPagosCaja.strFolio;
						objCeldaFecha.setAttribute('class', 'movil c3');
						objCeldaFecha.innerHTML = objCfdiRelacionarPagosCaja.dteFecha;
						objCeldaModulo.setAttribute('class', 'movil c4');
						objCeldaModulo.innerHTML = objCfdiRelacionarPagosCaja.strTipoReferencia;
						objCeldaUuid.setAttribute('class', 'movil c5');
						objCeldaUuid.innerHTML =  objCfdiRelacionarPagosCaja.strUuid;
						objCeldaImporte.setAttribute('class', 'movil c6');
						objCeldaImporte.innerHTML = objCfdiRelacionarPagosCaja.intImporte;
						objCeldaAcciones.setAttribute('class', 'td-center movil c7');
						objCeldaAcciones.innerHTML = strAccionesTabla;
						objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
						objCeldaReferenciaID.innerHTML = objCfdiRelacionarPagosCaja.intReferenciaID;
					}
	            }

	            //Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
				var intFilas = $("#dg_cfdi_relacionados_pagos_caja tr").length - 1;
				$('#numElementos_cfdi_relacionados_pagos_caja').html(intFilas);
				$('#txtNumCfdiRelacionados_pagos_caja').val(intFilas);
			}
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_cfdi_relacionados_pagos_caja(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_cfdi_relacionados_pagos_caja").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quitan la primera que corresponden al encabezado de la tabla)
			var intFilas = $("#dg_cfdi_relacionados_pagos_caja tr").length - 1;
			$('#numElementos_cfdi_relacionados_pagos_caja').html(intFilas);
			$('#txtNumCfdiRelacionados_pagos_caja').val(intFilas);
		}

		/*******************************************************************************************************************
		Funciones del modal Detalle del Pago
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_detalle_pagos_caja()
		{
			//Incializar formulario
			$('#frmDetallePagosCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_detalle_pagos_caja();
			//Limpiar cajas de texto ocultas
			$('#frmDetallePagosCaja').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_detalle_pagos_caja');
			//Seleccionar tab que contiene la información general
		  	$('a[href="#informacion_general_detalle_pagos_caja"]').click();
		  	//Agregar clase disabled disabledTab para deshabilitar el siguiente tab
		    $('#tabDocRelacionados_detalle_pagos_caja').addClass("disabled disabledTab");
			//Eliminar los datos de la tabla facturas relacionadas
		    $('#dg_fras_relacionadas_detalle_pagos_caja tbody').empty();
			$('#numElementos_fras_relacionadas_detalle_pagos_caja').html(0);
			$('#acumSaldo_detalles_pagos_caja').html('$0.00');
			$('#acumPago_detalles_pagos_caja').html('$0.00');
			$('#monedaDetallePago_detalles_pagos_caja').html(''); 
			//Habilitar todos los elementos del formulario
			$('#frmDetallePagosCaja').find('input, textarea, select').removeAttr('disabled','disabled');


			//Deshabilitar las siguientes cajas de texto
			$('#txtNumOperacion_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtRfcEmisorCtaOrd_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtNomBancoOrdExt_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtCtaOrdenante_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtRfcEmisorCtaBen_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtCuentaBancaria_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtCadenaPago_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtCerPago_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtCadPago_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtSelloPago_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtAnticipo_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtFolio_fra_relacionada_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtUuid_fra_relacionada_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtMonedaTipo_fra_relacionada_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtTipoCambio_fra_relacionada_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtMetodoPago_fra_relacionada_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtImpSaldoAnt_fra_relacionada_detalle_pagos_caja').attr("disabled", "disabled");


			//Habilitar las siguientes cajas de texto
			$("#cmbMonedaID_detalle_pagos_caja").removeAttr('disabled');
			$("#txtTipoCambio_detalle_pagos_caja").removeAttr('disabled');

			//Mostrar los siguientes botones
		    $('#btnGuardar_detalle_pagos_caja').show();
		    $('#btnBuscarDoc_detalle_pagos_caja').show();
		}

		//Función que se utiliza para abrir el modal
		function abrir_detalle_pagos_caja()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_detalle_pagos_caja();

		    //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_detalle_pagos_caja').addClass("estatus-NUEVO");
			
			//Abrir modal
			objDetallePagosCaja = $('#DetallePagosCajaBox').bPopup({
								   appendTo: '#PagosCajaContent', 
		                           contentContainer: 'PagosCajaM', 
		                           zIndex: 2, 
		                           modalClose: false, 
		                           modal: true, 
		                           follow: [true,false], 
		                           followEasing : "linear", 
		                           easing: "linear", 
		                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#txtFecha_detalle_pagos_caja').focus();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_detalle_pagos_caja()
		{
			try {
				//Cerrar modal
				objDetallePagosCaja.close();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_detalle_pagos_caja()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_detalle_pagos_caja();
			//Validación del formulario de campos obligatorios
			$('#frmDetallePagosCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_detalle_pagos_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
					                    strHora_detalle_pagos_caja: {
				                        	validators: {
												notEmpty: {message: 'Escriba la hora'}
											}
					                    },
					                    intMonedaID_detalle_pagos_caja: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_detalle_pagos_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_detalle_pagos_caja').val()) !== intMonedaBaseIDPagosCaja)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoPagosCaja)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoPagosCaja
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										intMonto_detalle_pagos_caja: {
											validators: {
												notEmpty: {message: 'Escriba un importe'}
											}
										},
										strFormaPago_detalle_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la forma de pago
					                                    if($('#txtFormaPagoID_detalle_pagos_caja').val() === '')
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
										strAnticipo_detalle_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                	//Asignar el id de la forma de pago
					                                	var intFormaPagoID = parseInt($('#txtFormaPagoID_detalle_pagos_caja').val());
					                                	var intAnticipoID = $('#txtAnticipoID_detalle_pagos_caja').val();

						                                 //Verificar que exista el id del anticicpo cuando la forma de pago
						                                //sea aplicación de anticipos
					                                     if(intAnticipoID === '' && (intFormaPagoID === intFormaPagoApliAnticiposIDPagosCaja))
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
										strNumOperacion_detalle_pagos_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                	//Asignar el id de la forma de pago
					                                	var intFormaPagoID = parseInt($('#txtFormaPagoID_detalle_pagos_caja').val());
					                                    //Verificar que exista el número de operación cuando la forma de pago
						                                //sea cheque nominativo o transferencia electrónica
					                                     if(value === '' && (intFormaPagoID === intFormaPagoChequeIDPagosCaja || intFormaPagoID === intFormaPagoTransferenciaIDPagosCaja))
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba el número de operación'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strRfcEmisorCtaOrd_detalle_pagos_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Asignar el id de la forma de pago
					                                	var intFormaPagoID = parseInt($('#txtFormaPagoID_detalle_pagos_caja').val());
					                                    //Verificar que exista el RFC cuando la forma de pago
						                                //sea cheque nominativo o transferencia electrónica
					                                    if(value === '' && (intFormaPagoID === intFormaPagoChequeIDPagosCaja || 
					                                       intFormaPagoID === intFormaPagoTransferenciaIDPagosCaja))
					                                    {

				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un RFC existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCtaOrdenante_detalle_pagos_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                   //Asignar el id de la forma de pago
					                                	var intFormaPagoID = parseInt($('#txtFormaPagoID_detalle_pagos_caja').val());
					                                    //Verificar que exista la cuenta bancaria del cliente cuando la forma de pago
						                                //sea cheque nominativo o transferencia electrónica
					                                   if(value === '' && (intFormaPagoID === intFormaPagoChequeIDPagosCaja || 
					                                        intFormaPagoID === intFormaPagoTransferenciaIDPagosCaja))
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una cuenta'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strRfcEmisorCtaBen_detalle_pagos_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Asignar el id de la forma de pago
					                                	var intFormaPagoID = parseInt($('#txtFormaPagoID_detalle_pagos_caja').val());
					                                    //Verificar que exista el RFC cuando la forma de pago
						                                //sea cheque nominativo o transferencia electrónica
					                                    if(value === '' && (intFormaPagoID === intFormaPagoChequeIDPagosCaja || 
					                                        intFormaPagoID === intFormaPagoTransferenciaIDPagosCaja))
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un RFC existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCuentaBancaria_detalle_pagos_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Asignar el id de la forma de pago
					                                	var intFormaPagoID = parseInt($('#txtFormaPagoID_detalle_pagos_caja').val());
					                                    //Verificar que exista el id de la cuenta bancaria cuando la forma de pago
						                                //sea cheque nominativo o transferencia electrónica
					                                    if($('#txtCuentaBancariaID_detalle_pagos_caja').val() === '' && (intFormaPagoID === intFormaPagoChequeIDPagosCaja || 
					                                        intFormaPagoID === intFormaPagoTransferenciaIDPagosCaja))
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
										strCadenaPago_detalle_pagos_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                	//Asignar el id de la forma de pago
					                                	var intFormaPagoID = parseInt($('#txtFormaPagoID_detalle_pagos_caja').val());
					                                    //Verificar que exista el id de la cadena de pago  cuando la forma de pago
						                                //sea transferencia electrónica
					                                   if(value !== '' && $('#txtCadenaPagoID_detalle_pagos_caja').val() === ''
					                                   	  && intFormaPagoID === intFormaPagoTransferenciaIDPagosCaja)

					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un tipo de cadena de pago existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCerPago_detalle_pagos_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                	//Asignar el id del tipo de cadena de pago
					                                	var intCadenaPagoID = parseInt($('#txtCadenaPagoID_detalle_pagos_caja').val());
					                                    //Verificar que exista el certificado de pago 
					                                    if(intCadenaPagoID > 0 && value === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba el certificado de pago'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strCadPago_detalle_pagos_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                	//Asignar el id del tipo de cadena de pago
					                                	var intCadenaPagoID = parseInt($('#txtCadenaPagoID_detalle_pagos_caja').val());
					                                    //Verificar que exista la cadena de pago 
					                                    if(intCadenaPagoID > 0 && value === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba la cadena de pago'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strSelloPago_detalle_pagos_caja: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Asignar el id del tipo de cadena de pago
					                                	var intCadenaPagoID = parseInt($('#txtCadenaPagoID_detalle_pagos_caja').val());
					                                    //Verificar que exista el sello de pago 
					                                    if(intCadenaPagoID > 0 && value === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba el sello de pago'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intNumFrasRelacionadas_detalle_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan facturas relacionadas
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos una factura para este detalle.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intImpPagado_fra_relacionada_detalle_pagos_caja: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_detalle_pagos_caja = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_detalle_pagos_caja = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_detalle_pagos_caja.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_detalle_pagos_caja.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_detalle_pagos_caja = $('#frmDetallePagosCaja').data('bootstrapValidator');
			bootstrapValidator_detalle_pagos_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_detalle_pagos_caja.isValid())
			{
				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumPagoDetallesPagosCaja = $.reemplazar($('#acumPago_detalles_pagos_caja').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumPagoDetallesPagosCaja = $.reemplazar(intAcumPagoDetallesPagosCaja, ",", "");

				var intMontoDetallesPagosCaja = $.reemplazar($('#txtMonto_detalle_pagos_caja').val(), ",", "");

				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intSaldoAnticipo = parseFloat($.reemplazar($('#txtSaldoAnticipo_detalle_pagos_caja').val(), ",", ""));


				//Verificar que el importe pagado sea igual al monto
				if(intAcumPagoDetallesPagosCaja != intMontoDetallesPagosCaja)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_pagos_caja('error', 'El monto no coincide con los detalles, favor de verificar.');
				}
				else if($('#txtAnticipoID_detalle_pagos_caja').val() != '' && intMontoDetallesPagosCaja > intSaldoAnticipo)
				{
					//Cambiar cantidad a formato moneda
					intSaldoAnticipo = formatMoney(intSaldoAnticipo, 2, '');

					/*Mensaje que se utiliza para informar al usuario que el total de la aplicación no debe ser mayor que el saldo del anticipo que hace falta aplicar*/
					var strMensaje = 'El monto sobrepasa el saldo del anticipo.';
						strMensaje += '<br>Saldo restante: <b>'+intSaldoAnticipo+'</b>';

					//Hacer un llamado a la función para mostrar mensaje de información
				    mensaje_pagos_caja('error', strMensaje);

				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_detalle_pagos_caja();
				}
				
			}
			else 
				return;

		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_detalle_pagos_caja()
		{
			try
			{
				$('#frmDetallePagosCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar el detalle del pago
		function guardar_detalle_pagos_caja()
		{
			//Asignar el renglón del detalle seleccionado
			var intRenglon = $('#txtRenglon_detalle_pagos_caja').val();

			//Crear instancia del objeto Detalle del pago
			objDetallePagoPagosCaja = new DetallePagoPagosCaja('', '',  '', '', '', '', '', '', '', '',
								                               '', '', '', '', '', '', '', '', '', '', 
								   							   '', '', '', '', []);
			
			//Asignar datos de la fecha y hora
			var dteFecha = $('#txtFecha_detalle_pagos_caja').val();
			var strHora = $('#txtHora_detalle_pagos_caja').val();

			//Concatenar los datos de la fecha y hora
			//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
			var dteFechaPago = $.formatFechaMysql(dteFecha)+' '+strHora;

			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioDet = parseFloat($('#txtTipoCambio_detalle_pagos_caja').val());
			//Variable que se utiliza para asignar el monto
			var intMontoDet = parseFloat($.reemplazar($('#txtMonto_detalle_pagos_caja').val(), ",", ""));

			//Convertir monto a peso mexicano
			var intMontoAux = intMontoDet * intTipoCambioDet;

			//Asignar valores al objeto
			objDetallePagoPagosCaja.dteFecha = dteFecha;
		    objDetallePagoPagosCaja.strHora = strHora
		    objDetallePagoPagosCaja.dteFechaPago = dteFechaPago
		    objDetallePagoPagosCaja.intFormaPagoID = $('#txtFormaPagoID_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strFormaPago = $('#txtFormaPago_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.intMonedaID = $('#cmbMonedaID_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strMoneda =  $('select[name="intMonedaID_detalle_pagos_caja"] option:selected').text();
		    objDetallePagoPagosCaja.intTipoCambio = $('#txtTipoCambio_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.intMonto = intMontoAux;
		    objDetallePagoPagosCaja.intAnticipoID =  $('#txtAnticipoID_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strAnticipo =  $('#txtAnticipo_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.intSaldoAnticipo = $('#txtSaldoAnticipo_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strNumOperacion = $('#txtNumOperacion_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strRfcEmisorCtaOrd = $('#txtRfcEmisorCtaOrd_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strNomBancoOrdExt = $('#txtNomBancoOrdExt_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strCtaOrdenante = $('#txtCtaOrdenante_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.intCuentaBancariaID = $('#txtCuentaBancariaID_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strRfcEmisorCtaBen = $('#txtRfcEmisorCtaBen_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strCtaBeneficiario = $('#txtCtaBeneficiario_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strCuentaBancaria = $('#txtCuentaBancaria_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.intCadenaPagoID = $('#txtCadenaPagoID_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strCadenaPago = $('#txtCadenaPago_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strCerPago = $('#txtCerPago_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strCadPago = $('#txtCadPago_detalle_pagos_caja').val();
		    objDetallePagoPagosCaja.strSelloPago = $('#txtSelloPago_detalle_pagos_caja').val();

		    //Eliminar los detalles relacionados del pago
			objDetallePagoPagosCaja.eliminarDetallesRelacionados(intRenglon);

			//Obtenemos el objeto de la tabla
			var objTablaFras = document.getElementById('dg_fras_relacionadas_detalle_pagos_caja').getElementsByTagName('tbody')[0];

			//Array que se utiliza para agregar los detalles relacionados del registro
			var arrDetallesRelacionadosReg = [];

			//Variable que se utiliza para asignar la moneda del pago
			var intMonedaIDDetallePago = parseInt($("#cmbMonedaID_detalle_pagos_caja").val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRenFra = 0, objRenFra; objRenFra = objTablaFras.rows[intRenFra]; intRenFra++) 
			{
				//Crear instancia del objeto Detalle relacionado
				objDetalleRelacionadoPagosCaja = new DetalleRelacionadoPagosCaja(null, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '','', '');

				//Variable que se utiliza para asignar el tipo de cambio del pago
				var intTipoCambioDetallePago = parseFloat($("#txtTipoCambio_detalle_pagos_caja").val());

				//Variables que se utilizan para asignar los valores del detalle relacionado
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intMonedaID = parseInt(objRenFra.cells[13].innerHTML);
				var intTipoCambio = parseFloat(objRenFra.cells[3].innerHTML);
				var intImpPagado = $.reemplazar(objRenFra.cells[6].innerHTML, ",", "");
				var intImpSaldoAnt = $.reemplazar(objRenFra.cells[5].innerHTML, ",", "");
				var intSaldoFactura = $.reemplazar(objRenFra.cells[14].innerHTML, ",", "");
				var intImpPagadoAux = parseFloat(objRenFra.cells[15].innerHTML);
				var intTipoCambio = parseFloat(objRenFra.cells[3].innerHTML);
				var intImpSaldoInsoluto = 0;

				//Si la moneda del pago es diferente a la moneda de la factura
				if(intMonedaID  !== intMonedaIDDetallePago)
				{
					//Asignar el tipo de cambio de la factura
					intTipoCambioDetallePago = intTipoCambio;
				}


				//Convertir importes a peso mexicano
				intImpPagado = intImpPagadoAux * intTipoCambioDetallePago;
				intImpSaldoAnt = intImpSaldoAnt * intTipoCambioDetallePago;

			    //Calcular saldo insoluto
				intImpSaldoInsoluto = intImpSaldoAnt - intImpPagado;

				//Asignar valores 
				objDetalleRelacionadoPagosCaja.intReferenciaID = objRenFra.cells[8].innerHTML;
				objDetalleRelacionadoPagosCaja.strTipoReferencia = objRenFra.cells[9].innerHTML;
				objDetalleRelacionadoPagosCaja.strFolio = objRenFra.cells[0].innerHTML;
				objDetalleRelacionadoPagosCaja.strUuid = objRenFra.cells[1].innerHTML;
				objDetalleRelacionadoPagosCaja.strObjetoImpuestoSat = objRenFra.cells[16].innerHTML;
				objDetalleRelacionadoPagosCaja.strObjetoImpuesto = objRenFra.cells[17].innerHTML;
				objDetalleRelacionadoPagosCaja.intMonedaID = objRenFra.cells[13].innerHTML;
				objDetalleRelacionadoPagosCaja.strMonedaTipo = objRenFra.cells[2].innerHTML;
				objDetalleRelacionadoPagosCaja.intTipoCambio = objRenFra.cells[3].innerHTML;
				objDetalleRelacionadoPagosCaja.intMetodoPagoID = objRenFra.cells[10].innerHTML;
				objDetalleRelacionadoPagosCaja.strMetodoPago = objRenFra.cells[4].innerHTML;
				objDetalleRelacionadoPagosCaja.intNumParcialidades = objRenFra.cells[11].innerHTML;
				objDetalleRelacionadoPagosCaja.intImpSaldoAnt = intImpSaldoAnt;
				objDetalleRelacionadoPagosCaja.intImpPagado = intImpPagado;
				objDetalleRelacionadoPagosCaja.intImpSaldoInsoluto = intImpSaldoInsoluto;
				objDetalleRelacionadoPagosCaja.intSaldoFactura = intSaldoFactura;
				objDetalleRelacionadoPagosCaja.intImpPagadoAux = intImpPagadoAux;
				//Agregar objeto en el array
				arrDetallesRelacionadosReg.push(objDetalleRelacionadoPagosCaja);
			}

			//Agregar array con los detalles relacionados del pago
            objDetallePagoPagosCaja.setDetallesRelacionados(arrDetallesRelacionadosReg);

		    //Concatenar los datos de la fecha y hora
		    var strFechaHora = objDetallePagoPagosCaja.dteFecha+' '+objDetallePagoPagosCaja.strHora;

		    //Convertir cantidad a formato moneda
			intMontoDet = '$'+formatMoney(intMontoDet, 2, '');

			//Revisamos si existe el renglón, si es así, editamos los datos del detalle
			if (intRenglon)
			{
			    //Modificar los datos del detalle corespondiente al indice
        		objDetallesPagoPagosCaja.modificarDetalle(intRenglon, objDetallePagoPagosCaja);

        		//Incrementar renglón para obtener la posición del detalle en la tabla
				intRenglon++;
				//Seleccionar el renglón de la tabla para actualizar los datos del detalle
				var selectedRow = document.getElementById("dg_detalles_pagos_caja").rows[intRenglon].cells;
				selectedRow[0].innerHTML = strFechaHora;
				selectedRow[1].innerHTML = objDetallePagoPagosCaja.strFormaPago;
				selectedRow[2].innerHTML = objDetallePagoPagosCaja.strMoneda;
				selectedRow[3].innerHTML = objDetallePagoPagosCaja.intTipoCambio;
				selectedRow[4].innerHTML = intMontoDet;
			}
			else
			{
				//Agregar datos del detalle del pago
           		objDetallesPagoPagosCaja.setDetalle(objDetallePagoPagosCaja);

				//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_detalles_pagos_caja').getElementsByTagName('tbody')[0];
           		//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaFechaHora = objRenglon.insertCell(0);
				var objCeldaFormaPago = objRenglon.insertCell(1);
				var objCeldaMoneda = objRenglon.insertCell(2);
				var objCeldaTipoCambio = objRenglon.insertCell(3);
				var objCeldaMonto = objRenglon.insertCell(4);
				var objCeldaAcciones = objRenglon.insertCell(5);

				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', intRenglon);
				objCeldaFechaHora.setAttribute('class', 'movil d1');
				objCeldaFechaHora.innerHTML = strFechaHora;
			    objCeldaFormaPago.setAttribute('class', 'movil d2');
				objCeldaFormaPago.innerHTML = objDetallePagoPagosCaja.strFormaPago;
				objCeldaMoneda.setAttribute('class', 'movil d3');
				objCeldaMoneda.innerHTML = objDetallePagoPagosCaja.strMoneda;
				objCeldaTipoCambio.setAttribute('class', 'movil d4');
				objCeldaTipoCambio.innerHTML = objDetallePagoPagosCaja.intTipoCambio;
				objCeldaMonto.setAttribute('class', 'movil d5');
				objCeldaMonto.innerHTML = intMontoDet;
				objCeldaAcciones.setAttribute('class', 'td-center movil d6');
				objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_detalle_pagos_caja(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
											 " onclick='eliminar_renglon_detalle_pagos_caja(this)'>" + 
											 "<span class='glyphicon glyphicon-trash'></span></button>" + 
											 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
											 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_detalles_pagos_caja tr").length - 1;
			$('#numElementos_detalles_pagos_caja').html(intFilas);
			$('#txtNumDetalles_pagos_caja').val(intFilas);

            //Hacer un llamado a la función para cerrar modal
			cerrar_detalle_pagos_caja();
		}

		//Función para editar un renglón de la tabla
		function editar_renglon_detalle_pagos_caja(objRenglon)
		{
			
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_detalle_pagos_caja();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_pagos_caja').val();

			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_detalle_pagos_caja').addClass("estatus-"+strEstatus);
		    //Quitar clase disabled disabledTab para habilitar el siguiente tab
		    $('#tabDocRelacionados_detalle_pagos_caja').removeClass("disabled disabledTab");

		    //Decrementar indice para obtener la posición del detalle en el arreglo
		    var intRenglon = objRenglon.parentNode.parentNode.rowIndex - 1;
			//Crear instancia del objeto Detalle del pago
        	objDetallePagoPagosCaja = new DetallePagoPagosCaja();
        	//Asignar datos del detalle corespondiente al indice
        	objDetallePagoPagosCaja = objDetallesPagoPagosCaja.getDetalle(intRenglon);

        	//Variable que se utiliza para asignar la moneda del pago
			var intMonedaIDDetallePago = parseInt(objDetallePagoPagosCaja.intMonedaID);
        	//Variable que se utiliza para asignar el tipo de cambio del pago
			var intTipoCambioDet = parseFloat(objDetallePagoPagosCaja.intTipoCambio);

			var intFormaPagoIDDetallePago = parseInt(objDetallePagoPagosCaja.intFormaPagoID);

			//Variable que se utiliza para asignar el monto
			var intMontoDet = parseFloat(objDetallePagoPagosCaja.intMonto);

			//Convertir peso mexicano a tipo de cambio
			intMontoDet = intMontoDet / intTipoCambioDet;
      	
        	//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalle_pagos_caja').val(intRenglon);
			$('#txtFecha_detalle_pagos_caja').val(objDetallePagoPagosCaja.dteFecha);
		    $('#txtHora_detalle_pagos_caja').val(objDetallePagoPagosCaja.strHora);
		    $('#txtFormaPagoID_detalle_pagos_caja').val(objDetallePagoPagosCaja.intFormaPagoID);
		    $('#txtFormaPago_detalle_pagos_caja').val(objDetallePagoPagosCaja.strFormaPago);
		    $('#cmbMonedaID_detalle_pagos_caja').val(objDetallePagoPagosCaja.intMonedaID);
		    $('#txtTipoCambio_detalle_pagos_caja').val(objDetallePagoPagosCaja.intTipoCambio);
		    $('#txtMonto_detalle_pagos_caja').val(intMontoDet);
		    $('#txtAnticipoID_detalle_pagos_caja').val(objDetallePagoPagosCaja.intAnticipoID);
		    $('#txtAnticipo_detalle_pagos_caja').val(objDetallePagoPagosCaja.strAnticipo);
		    $('#txtSaldoAnticipo_detalle_pagos_caja').val(objDetallePagoPagosCaja.intSaldoAnticipo);
		    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
		    $('#txtMonto_detalle_pagos_caja').formatCurrency({ roundToDecimalPlace: 2 });
		    $('#txtNumOperacion_detalle_pagos_caja').val(objDetallePagoPagosCaja.strNumOperacion);
		    $('#txtBancoIDEmisorCtaOrd_detalle_pagos_caja').val(objDetallePagoPagosCaja.strRfcEmisorCtaOrd);
		    $('#txtRfcEmisorCtaOrd_detalle_pagos_caja').val(objDetallePagoPagosCaja.strRfcEmisorCtaOrd);
		    $('#txtNomBancoOrdExt_detalle_pagos_caja').val(objDetallePagoPagosCaja.strNomBancoOrdExt);
		    $('#txtCtaOrdenante_detalle_pagos_caja').val(objDetallePagoPagosCaja.strCtaOrdenante);
		    $('#txtCuentaBancariaID_detalle_pagos_caja').val(objDetallePagoPagosCaja.intCuentaBancariaID);
		    $('#txtBancoIDEmisorCtaBen_detalle_pagos_caja').val(objDetallePagoPagosCaja.strRfcEmisorCtaBen);
		    $('#txtRfcEmisorCtaBen_detalle_pagos_caja').val(objDetallePagoPagosCaja.strRfcEmisorCtaBen);
		    $('#txtCtaBeneficiario_detalle_pagos_caja').val(objDetallePagoPagosCaja.strCtaBeneficiario);
		    $('#txtCuentaBancaria_detalle_pagos_caja').val(objDetallePagoPagosCaja.strCuentaBancaria);
		    $('#txtCadenaPagoID_detalle_pagos_caja').val(objDetallePagoPagosCaja.intCadenaPagoID);
		    $('#txtCadenaPago_detalle_pagos_caja').val(objDetallePagoPagosCaja.strCadenaPago);
		    $('#txtCerPago_detalle_pagos_caja').val(objDetallePagoPagosCaja.strCerPago);
		    $('#txtCadPago_detalle_pagos_caja').val(objDetallePagoPagosCaja.strCadPago);
		    $('#txtSelloPago_detalle_pagos_caja').val(objDetallePagoPagosCaja.strSelloPago);

		    //Hacer un llamado a la función para habilitar o deshabilitar campos del formulario 
	        habilitar_controles_carga_detalle_pagos_caja();

		    //Si el estatus del registro es ACTIVO o INACTIVO
		    if(strEstatus == 'ACTIVO' || strEstatus == 'INACTIVO')
		    {
		    	//Ocultar los siguientes botones
		    	$('#btnGuardar_detalle_pagos_caja').hide();
		    	$('#btnBuscarDoc_detalle_pagos_caja').hide();
		    	//Deshabilitar todos los elementos del formulario
				$('#frmDetallePagosCaja').find('input, textarea, select').attr('disabled','disabled');

		    }
		    else
		    {
		    	//Si la forma de pago no corresponde a Aplicación de anticipos
		    	if(intFormaPagoIDDetallePago != intFormaPagoApliAnticiposIDPagosCaja)
		    	{

		    		//Si el id de la moneda no corresponde al peso mexicano
				    if(parseInt(objDetallePagoPagosCaja.intMonedaID) !== intMonedaBaseIDPagosCaja)
				    {
						//Habilitar caja de texto
						$("#txtTipoCambio_detalle_pagos_caja").removeAttr('disabled');
				    }
				    else
				    {
				    	//Deshabilitar caja de texto
						$("#txtTipoCambio_detalle_pagos_caja").attr('disabled','disabled');
				    }
		    	}
		    	
		    }

		    //Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Hacer recorrido para obtener los detalles relacionados del pago
		    for(var intCon=0; intCon < objDetallePagoPagosCaja.arrDetallesRelacionados.length; intCon++)
		    {
		    	//Crear instancia del objeto Detalle relacionado
            	objDetalleRelacionadoPagosCaja = new DetalleRelacionadoPagosCaja();
            	//Asignar datos del detalle relacionado corespondiente al indice
            	objDetalleRelacionadoPagosCaja = objDetallePagoPagosCaja.getDetalleRelacionado(intCon);

                //Variable que se utiliza para asignar el tipo de cambio del pago (evitar perder el valor)
				var intTipoCambioDetallePago = intTipoCambioDet;

            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_fras_relacionadas_detalle_pagos_caja').getElementsByTagName('tbody')[0];

				//Variable que se utiliza para asignar el id del detalle
				var strDetalleID =  objDetalleRelacionadoPagosCaja.intReferenciaID+'_'+objDetalleRelacionadoPagosCaja.strTipoReferencia;

				//Insertamos el renglón con sus celdas en el objeto de la tabla
				var objRenglon = objTabla.insertRow();
				var objCeldaFolio = objRenglon.insertCell(0);
				var objCeldaUuid = objRenglon.insertCell(1);
				var objCeldaMonedaTipo = objRenglon.insertCell(2);
				var objCeldaTipoCambio = objRenglon.insertCell(3);
				var objCeldaMetodoPago = objRenglon.insertCell(4);
				var objCeldaImpSaldoAnt = objRenglon.insertCell(5);
				var objCeldaImpPagado = objRenglon.insertCell(6);
				var objCeldaAcciones = objRenglon.insertCell(7);
				//Columnas ocultas
				var objCeldaReferenciaID = objRenglon.insertCell(8);
				var objCeldaTipoReferencia = objRenglon.insertCell(9);
				var objCeldaMetodoPagoID = objRenglon.insertCell(10);
				var objCeldaNumParcialidades = objRenglon.insertCell(11);
				var objCeldaImpSaldoInsoluto = objRenglon.insertCell(12);
				var objCeldaMonedaID = objRenglon.insertCell(13);
				var objCeldaSaldoFactura = objRenglon.insertCell(14);
				var objCeldaImpPagadoAux = objRenglon.insertCell(15);
				var objCeldaObjetoImpuestoSat = objRenglon.insertCell(16);
				var objCeldaObjetoImpuesto = objRenglon.insertCell(17);

				//Variables que se utilizan para asignar valores del detalle
				var intMonedaID = parseInt(objDetalleRelacionadoPagosCaja.intMonedaID);
				var intTipoCambio = parseFloat(objDetalleRelacionadoPagosCaja.intTipoCambio);
				var intImpSaldoAnt = parseFloat(objDetalleRelacionadoPagosCaja.intImpSaldoAnt);
				var intImpPagado = parseFloat(objDetalleRelacionadoPagosCaja.intImpPagado);
				var intImpSaldoInsoluto = 0;


				//Si la moneda del pago es diferente a la moneda de la factura
				if(intMonedaIDDetallePago !== intMonedaID)
				{
				    //Asignar el tipo de cambio de la factura
					intTipoCambioDetallePago = intTipoCambio;
				}

				//Convertir peso mexicano a tipo de cambio del pago
				intImpSaldoAnt = intImpSaldoAnt / intTipoCambioDetallePago;
				intImpPagado = intImpPagado / intTipoCambioDetallePago;
				
				//Calcular saldo insoluto
				intImpSaldoInsoluto = intImpSaldoAnt - intImpPagado;

				//Si se cumple la sentencia
				if(strEstatus == 'NUEVO' || strEstatus == 'TIMBRAR')
				{
					//Variable que se utiliza para asignar el número de pagos con mayor parcialidad
					var intNumPagosMayorParcialidad = parseInt(objDetalleRelacionadoPagosCaja.intNumPagosMayorParcialidad);
					//Variable que se utiliza para asignar el saldo actual de la factura
					var intSaldoFactura = parseFloat(objDetalleRelacionadoPagosCaja.intSaldoFactura);

					//Si existen pagos con mayor parcialidad o la factura cuenta con nuevos abonos (pólizas de abono, notas de crédito, etc.)
					if(intNumPagosMayorParcialidad > 0 || intImpSaldoInsoluto > intSaldoFactura)
					{	

						 strAccionesTabla = "<button class='btn btn-default btn-xs up' title='Subir'>" + 
										    "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
										    "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
										    "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					}
					else
					{
						 strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
									   " onclick='editar_renglon_fras_relacionadas_detalle_pagos_caja(this)'>" + 
									   "<span class='glyphicon glyphicon-edit'></span></button>" + 
									   "<button class='btn btn-default btn-xs' title='Eliminar'" +
									   " onclick='eliminar_renglon_fras_relacionadas_detalle_pagos_caja(this)'>" + 
									   "<span class='glyphicon glyphicon-trash'></span></button>" + 
									   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
									   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
									   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
									   "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					}
				   
				}

				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', strDetalleID);
				objCeldaFolio.setAttribute('class', 'movil e1');
				objCeldaFolio.innerHTML = objDetalleRelacionadoPagosCaja.strFolio;
				objCeldaUuid.setAttribute('class', 'movil e2');
				objCeldaUuid.innerHTML = objDetalleRelacionadoPagosCaja.strUuid;
				objCeldaMonedaTipo.setAttribute('class', 'movil e3');
				objCeldaMonedaTipo.innerHTML = objDetalleRelacionadoPagosCaja.strMonedaTipo;
				objCeldaTipoCambio.setAttribute('class', 'movil e4');
				objCeldaTipoCambio.innerHTML = objDetalleRelacionadoPagosCaja.intTipoCambio;
				objCeldaMetodoPago.setAttribute('class', 'movil e5');
				objCeldaMetodoPago.innerHTML = objDetalleRelacionadoPagosCaja.strMetodoPago;
				objCeldaImpSaldoAnt.setAttribute('class', 'movil e6');
				objCeldaImpSaldoAnt.innerHTML = formatMoney(intImpSaldoAnt, 2, '');
				objCeldaImpPagado.setAttribute('class', 'movil e7');
				objCeldaImpPagado.innerHTML =  formatMoney(intImpPagado, 2, ''); 
				objCeldaAcciones.setAttribute('class', 'td-center movil e8');
				objCeldaAcciones.innerHTML = strAccionesTabla;
				objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
				objCeldaReferenciaID.innerHTML =  objDetalleRelacionadoPagosCaja.intReferenciaID;
				objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
				objCeldaTipoReferencia.innerHTML =  objDetalleRelacionadoPagosCaja.strTipoReferencia;
				objCeldaMetodoPagoID.setAttribute('class', 'no-mostrar');
				objCeldaMetodoPagoID.innerHTML =  objDetalleRelacionadoPagosCaja.intMetodoPagoID;
				objCeldaNumParcialidades.setAttribute('class', 'no-mostrar');
				objCeldaNumParcialidades.innerHTML =  objDetalleRelacionadoPagosCaja.intNumParcialidades;
				objCeldaImpSaldoInsoluto.setAttribute('class', 'no-mostrar');
				objCeldaImpSaldoInsoluto.innerHTML = intImpSaldoInsoluto;
				objCeldaMonedaID.setAttribute('class', 'no-mostrar');
				objCeldaMonedaID.innerHTML = objDetalleRelacionadoPagosCaja.intMonedaID;
				objCeldaSaldoFactura.setAttribute('class', 'no-mostrar');
				objCeldaSaldoFactura.innerHTML = objDetalleRelacionadoPagosCaja.intSaldoFactura;
				objCeldaImpPagadoAux.setAttribute('class', 'no-mostrar');
				objCeldaImpPagadoAux.innerHTML =  objDetalleRelacionadoPagosCaja.intImpPagadoAux;
				objCeldaObjetoImpuestoSat.setAttribute('class', 'no-mostrar');
				objCeldaObjetoImpuestoSat.innerHTML =  objDetalleRelacionadoPagosCaja.strObjetoImpuestoSat;
				objCeldaObjetoImpuesto.setAttribute('class', 'no-mostrar');
				objCeldaObjetoImpuesto.innerHTML =  objDetalleRelacionadoPagosCaja.strObjetoImpuesto;


		    }

	     	//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_fras_relacionadas_detalle_pagos_caja tr").length - 2;
			$('#numElementos_fras_relacionadas_detalle_pagos_caja').html(intFilas);
			$('#txtNumFrasRelacionadas_detalle_pagos_caja').val(intFilas);
		
			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_fras_relacionadas_detalle_pagos_caja();

			//Abrir modal
			objDetallePagosCaja = $('#DetallePagosCajaBox').bPopup({
								   appendTo: '#PagosCajaContent', 
		                           contentContainer: 'PagosCajaM', 
		                           zIndex: 2, 
		                           modalClose: false, 
		                           modal: true, 
		                           follow: [true,false], 
		                           followEasing : "linear", 
		                           easing: "linear", 
		                           modalColor: ('#F0F0F0')});
			//Enfocar caja de texto
			$('#txtFecha_detalle_pagos_caja').focus();
			
		}

		//Función para eliminar un renglón de la tabla
		function eliminar_renglon_detalle_pagos_caja(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			//Eliminar del objeto el detalle seleccionado
			objDetallesPagoPagosCaja.eliminarDetalle(intRenglon - 1);
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_pagos_caja").deleteRow(intRenglon);
			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_detalles_pagos_caja tr").length - 1;
			$('#numElementos_detalles_pagos_caja').html(intFilas);
			$('#txtNumDetalles_pagos_caja').val(intFilas);
		}

		//Función para regresar y obtener los datos de un anticipo
		function get_datos_anticipo_detalle_pagos_caja()
		{
		 	//Hacer un llamado al método del controlador para regresar los datos del anticipo
            $.post('caja/anticipos/get_datos',
                  { 
                  	intAnticipoID:$("#txtAnticipoID_detalle_pagos_caja").val(), 
                  	strFormulario: 'polizas_aplicacion'
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
						   	 $("#cmbMonedaID_detalle_pagos_caja").val(data.row.moneda_id);
	                      	 $("#txtTipoCambio_detalle_pagos_caja").val(data.row.tipo_cambio);
						     $("#txtSaldoAnticipo_detalle_pagos_caja").val(intTotalAnticipoAplicar);

						     //Quitar clase disabled disabledTab para habilitar el siguiente tab
		   					 $('#tabDocRelacionados_detalle_pagos_caja').removeClass("disabled disabledTab");
					 	}
					 	else
					 	{
					 		//Asignar folio del anticipo que se desea aplicar
					 		var strFolioAnticipo = $('#txtAnticipo_detalle_pagos_caja').val();
					 		/*Mensaje que se utiliza para informar al usuario que el subtotal no se puede aplicar el anticipo*/
							var strMensaje = 'El anticipo: '+strFolioAnticipo+' ya ha sido aplicado.';

							//Limpiar contenido de las siguientes cajas de texto
							$('#txtAnticipoID_detalle_pagos_caja').val('');
							$('#txtAnticipo_detalle_pagos_caja').val('');

							//Hacer un llamado a la función para mostrar mensaje de información
							mensaje_pagos_caja('informacion', strMensaje, 'txtAnticipo_detalle_pagos_caja');
					 	}
                      
                    }
                  }
                 ,
                'json');

		}

		//Función para inicializar elementos del anticipo
		function inicializar_anticipo_detalle_pagos_caja()
		{
		    //Limpiar contenido de las siguientes cajas de texto
		    $("#txtSaldoAnticipo_detalle_pagos_caja").val('');
		    $("#cmbMonedaID_detalle_pagos_caja").val('');
		    $("#txtTipoCambio_detalle_pagos_caja").val('');
		    //Agregar clase disabled disabledTab para deshabilitar el siguiente tab
		    $('#tabDocRelacionados_detalle_pagos_caja').addClass("disabled disabledTab");
		}



		//Función para habilitar o deshabilitar controles del formulario dependiendo de la forma de pago
		function habilitar_controles_carga_detalle_pagos_caja()
		{
		    //Asignar el id de la forma de pago
			var intFormaPagoID = parseInt($('#txtFormaPagoID_detalle_pagos_caja').val()); 
			//Asignar el id del tipo de cadena de pago
			var intCadenaPagoID = parseInt($('#txtCadenaPagoID_detalle_pagos_caja').val());

			//Asignar el id del anticipo
			var intAnticipoID = $('#txtAnticipoID_detalle_pagos_caja').val();

			//Deshabilitar las siguientes cajas de texto
			$('#txtNumOperacion_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtRfcEmisorCtaOrd_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtNomBancoOrdExt_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtCtaOrdenante_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtRfcEmisorCtaBen_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtCuentaBancaria_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtCadenaPago_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtCerPago_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtCadPago_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtSelloPago_detalle_pagos_caja').attr("disabled", "disabled");
			$('#txtAnticipo_detalle_pagos_caja').attr("disabled", "disabled");

			

			//Habilitar las siguientes cajas de texto
			$("#cmbMonedaID_detalle_pagos_caja").removeAttr('disabled');

			//Si existe id de la forma de pago
        	if(intFormaPagoID > 0)
        	{
				//Dependiendo del id de la forma de pago habilitar y limpiar elementos del formulario
				if(intFormaPagoID == intFormaPagoEfectivoIDPagosCaja)
	        	{
	        		//Limpiar las siguientes cajas de texto
					$('#txtNumOperacion_detalle_pagos_caja').val('');
					$('#txtBancoIDEmisorCtaOrd_detalle_pagos_caja').val('');
					$('#txtRfcEmisorCtaOrd_detalle_pagos_caja').val('');
					$('#txtNomBancoOrdExt_detalle_pagos_caja').val('');
					$('#txtCtaOrdenante_detalle_pagos_caja').val('');
					$('#txtBancoIDEmisorCtaBen_detalle_pagos_caja').val('');
					$('#txtRfcEmisorCtaBen_detalle_pagos_caja').val('');
					$('#txtCuentaBancariaID_detalle_pagos_caja').val('');
					$('#txtCtaBeneficiario_detalle_pagos_caja').val('');
					$('#txtCuentaBancaria_detalle_pagos_caja').val('');
					$('#txtCadenaPagoID_detalle_pagos_caja').val('');
					$('#txtCadenaPago_detalle_pagos_caja').val('');
					$('#txtCerPago_detalle_pagos_caja').val('');
					$('#txtCadPago_detalle_pagos_caja').val('');
					$('#txtSelloPago_detalle_pagos_caja').val('');
					$('#txtAnticipo_detalle_pagos_caja').val('');
					$('#txtAnticipoID_detalle_pagos_caja').val('');
	        	}
	        	else if(intFormaPagoID == intFormaPagoChequeIDPagosCaja)
	        	{
	        		//Habilitar las siguientes cajas de texto
	        		$('#txtNumOperacion_detalle_pagos_caja').removeAttr('disabled');
					$('#txtRfcEmisorCtaOrd_detalle_pagos_caja').removeAttr('disabled');
					$('#txtCtaOrdenante_detalle_pagos_caja').removeAttr('disabled');
					$('#txtRfcEmisorCtaBen_detalle_pagos_caja').removeAttr('disabled');
					$('#txtCuentaBancaria_detalle_pagos_caja').removeAttr('disabled');
					//Limpiar las siguientes cajas de texto
					$('#txtCadenaPagoID_detalle_pagos_caja').val('');
					$('#txtCadenaPago_detalle_pagos_caja').val('');
					$('#txtCerPago_detalle_pagos_caja').val('');
					$('#txtCadPago_detalle_pagos_caja').val('');
					$('#txtSelloPago_detalle_pagos_caja').val('');
					$('#txtAnticipo_detalle_pagos_caja').val('');
					$('#txtAnticipoID_detalle_pagos_caja').val('');

	        	}
	        	else if(intFormaPagoID == intFormaPagoApliAnticiposIDPagosCaja)
	        	{
	        		//Habilitar las siguientes cajas de texto
	        		$('#txtAnticipo_detalle_pagos_caja').removeAttr('disabled');
	        		//Deshabilitar las siguientes cajas de texto
	        		$('#cmbMonedaID_detalle_pagos_caja').attr("disabled", "disabled");
	        		$('#txtTipoCambio_detalle_pagos_caja').attr("disabled", "disabled");

	        		//Si no existe el id del anticipo
	        		if(intAnticipoID == '')
	        		{
	        			//Limpiar las siguientes cajas de texto
		        		$('#cmbMonedaID_detalle_pagos_caja').val('');
						$('#txtTipoCambio_detalle_pagos_caja').val('');
	        		}
	        		
	        	}
	        	else 
	        	{
	        		//Habilitar las siguientes cajas de texto
	        		$('#txtNumOperacion_detalle_pagos_caja').removeAttr('disabled');
					$('#txtRfcEmisorCtaOrd_detalle_pagos_caja').removeAttr('disabled');
					$('#txtCtaOrdenante_detalle_pagos_caja').removeAttr('disabled');
					$('#txtRfcEmisorCtaBen_detalle_pagos_caja').removeAttr('disabled');
					$('#txtCuentaBancaria_detalle_pagos_caja').removeAttr('disabled');
					$('#txtCadenaPago_detalle_pagos_caja').removeAttr('disabled');
					//Limpiar las siguientes cajas de texto
					$('#txtAnticipo_detalle_pagos_caja').val('');
					$('#txtAnticipoID_detalle_pagos_caja').val('');
					
					
	        	}

	        	//Si la forma de pago no corresponde a Aplicación 
	        	 if(intFormaPagoID != intFormaPagoApliAnticiposIDPagosCaja && $('#txtTipoCambio_detalle_pagos_caja').val() != '')
	        	 {
	        	 	 //Quitar clase disabled disabledTab para habilitar el siguiente tab
		   			 $('#tabDocRelacionados_detalle_pagos_caja').removeClass("disabled disabledTab");
	        	 }

	        }
	        else
	        {
	        	//Limpiar las siguientes cajas de texto
	        	$('#txtAnticipo_detalle_pagos_caja').val('');
				$('#txtAnticipoID_detalle_pagos_caja').val('');
				//Agregar clase disabled disabledTab para deshabilitar el siguiente tab
		    	$('#tabDocRelacionados_detalle_pagos_caja').addClass("disabled disabledTab");
	        }

        	//Si existe id del tipo de cadena de pago
        	if(intCadenaPagoID > 0)
        	{
        		//Habilitar las siguientes cajas de texto
        		$('#txtCerPago_detalle_pagos_caja').removeAttr('disabled');
        		$('#txtCadPago_detalle_pagos_caja').removeAttr('disabled');
        		$('#txtSelloPago_detalle_pagos_caja').removeAttr('disabled');
        	}

		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_detalle_pagos_caja()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_detalle_pagos_caja').val()) !== intMonedaBaseIDPagosCaja && parseInt($('#txtFormaPagoID_detalle_pagos_caja').val()) != intFormaPagoApliAnticiposIDPagosCaja)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_detalle_pagos_caja").val('');
         		//Agregar clase disabled disabledTab para deshabilitar el siguiente tab
				$('#tabDocRelacionados_detalle_pagos_caja').addClass("disabled disabledTab");

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_detalle_pagos_caja').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_detalle_pagos_caja').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_detalle_pagos_caja").val(data.row.tipo_cambio_sat);

	                       //Si existe id de la forma de pago
	                       if($("#txtFormaPagoID_detalle_pagos_caja").val() != '')
	                       {
	                       	 //Quitar clase disabled disabledTab para habilitar el siguiente tab
				    	   	 $('#tabDocRelacionados_detalle_pagos_caja').removeClass("disabled disabledTab");
	                       }
	                      
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}


		/*******************************************************************************************************************
		Funciones de la tabla facturas relacionadas
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_fras_relacionadas_detalle_pagos_caja(tipoAccion, estatus)
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';
		    //Inicializar variables
		    strObjetoImpuestoSatFraRelPagosCaja = "";
		    strObjetoImpuestoFraRelPagosCaja = "";

		    //Si se cumple la sentencia
			if(estatus == '' || estatus == 'TIMBRAR')
			{
				strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
									" onclick='editar_renglon_fras_relacionadas_detalle_pagos_caja(this)'>" + 
									 "<span class='glyphicon glyphicon-edit'></span></button>" + 
									 "<button class='btn btn-default btn-xs' title='Eliminar'" +
									 " onclick='eliminar_renglon_fras_relacionadas_detalle_pagos_caja(this)'>" + 
									 "<span class='glyphicon glyphicon-trash'></span></button>" + 
									 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
									 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
									 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
									 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
			}


			//Hacer un llamado a la función para cargar el uso de objeto de impuesto base
			cargar_objeto_impuesto_base_pagos_caja('', '');
		
			//Mostramos las facturas relacionadas (seleccionadas)
			for (var intCon in objFrasRelacionadasDetallePagosCaja.getFras()) 
            {
            	//Crear instancia del objeto Factura a relacionar 
            	objFraRelacionarDetallePagosCaja = new FraRelacionarDetallePagosCaja();
            	//Asignar datos de la factura corespondiente al indice
            	objFraRelacionarDetallePagosCaja = objFrasRelacionadasDetallePagosCaja.getFra(intCon);
            	
            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_fras_relacionadas_detalle_pagos_caja').getElementsByTagName('tbody')[0];

			    //Variable que se utiliza para asignar el id del detalle
				var strDetalleID =  objFraRelacionarDetallePagosCaja.intReferenciaID+'_'+objFraRelacionarDetallePagosCaja.strTipoReferencia;

				//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
				if (!objTabla.rows.namedItem(strDetalleID))
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaFolio = objRenglon.insertCell(0);
					var objCeldaUuid = objRenglon.insertCell(1);
					var objCeldaMonedaTipo = objRenglon.insertCell(2);
					var objCeldaTipoCambio = objRenglon.insertCell(3);
					var objCeldaMetodoPago = objRenglon.insertCell(4);
					var objCeldaImpSaldoAnt = objRenglon.insertCell(5);
					var objCeldaImpPagado = objRenglon.insertCell(6);
					var objCeldaAcciones = objRenglon.insertCell(7);
					//Columnas ocultas
					var objCeldaReferenciaID = objRenglon.insertCell(8);
					var objCeldaTipoReferencia = objRenglon.insertCell(9);
					var objCeldaMetodoPagoID = objRenglon.insertCell(10);
					var objCeldaNumParcialidades = objRenglon.insertCell(11);
					var objCeldaImpSaldoInsoluto = objRenglon.insertCell(12);
					var objCeldaMonedaID = objRenglon.insertCell(13);
					var objCeldaSaldoFactura = objRenglon.insertCell(14);
					var objCeldaImpPagadoAux = objRenglon.insertCell(15);
					var objCeldaObjetoImpuestoSat = objRenglon.insertCell(16);
					var objCeldaObjetoImpuesto = objRenglon.insertCell(17);

					//Hacer un llamado a la función para reemplazar ',' por cadena vacia
					var intImpPagadoAux = $.reemplazar(objFraRelacionarDetallePagosCaja.intImpPagado, ",", "");
	             	
					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strDetalleID);
					objCeldaFolio.setAttribute('class', 'movil e1');
					objCeldaFolio.innerHTML = objFraRelacionarDetallePagosCaja.strFolio;
					objCeldaUuid.setAttribute('class', 'movil e2');
					objCeldaUuid.innerHTML = objFraRelacionarDetallePagosCaja.strUuid;
					objCeldaMonedaTipo.setAttribute('class', 'movil e3');
					objCeldaMonedaTipo.innerHTML = objFraRelacionarDetallePagosCaja.strMonedaTipo;
					objCeldaTipoCambio.setAttribute('class', 'movil e4');
					objCeldaTipoCambio.innerHTML = objFraRelacionarDetallePagosCaja.intTipoCambio;
					objCeldaMetodoPago.setAttribute('class', 'movil e5');
					objCeldaMetodoPago.innerHTML = objFraRelacionarDetallePagosCaja.strMetodoPago;
					objCeldaImpSaldoAnt.setAttribute('class', 'movil e6');
					objCeldaImpSaldoAnt.innerHTML = objFraRelacionarDetallePagosCaja.intImpSaldoAnt;
					objCeldaImpPagado.setAttribute('class', 'movil e7');
					objCeldaImpPagado.innerHTML = objFraRelacionarDetallePagosCaja.intImpPagado;
					objCeldaAcciones.setAttribute('class', 'td-center movil e8');
					objCeldaAcciones.innerHTML = strAccionesTabla;
					objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
					objCeldaReferenciaID.innerHTML =  objFraRelacionarDetallePagosCaja.intReferenciaID;
					objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
					objCeldaTipoReferencia.innerHTML =  objFraRelacionarDetallePagosCaja.strTipoReferencia;
					objCeldaMetodoPagoID.setAttribute('class', 'no-mostrar');
					objCeldaMetodoPagoID.innerHTML =  objFraRelacionarDetallePagosCaja.intMetodoPagoID;
					objCeldaNumParcialidades.setAttribute('class', 'no-mostrar');
					objCeldaNumParcialidades.innerHTML =  objFraRelacionarDetallePagosCaja.intNumParcialidades;
					objCeldaImpSaldoInsoluto.setAttribute('class', 'no-mostrar');
					objCeldaImpSaldoInsoluto.innerHTML = objFraRelacionarDetallePagosCaja.intImpSaldoInsoluto;
					objCeldaMonedaID.setAttribute('class', 'no-mostrar');
					objCeldaMonedaID.innerHTML = objFraRelacionarDetallePagosCaja.intMonedaID;
					objCeldaSaldoFactura.setAttribute('class', 'no-mostrar');
					objCeldaSaldoFactura.innerHTML = objFraRelacionarDetallePagosCaja.intSaldoFactura;
					objCeldaImpPagadoAux.setAttribute('class', 'no-mostrar');
					objCeldaImpPagadoAux.innerHTML = intImpPagadoAux;
					objCeldaObjetoImpuestoSat.setAttribute('class', 'no-mostrar');
					objCeldaObjetoImpuestoSat.innerHTML = strObjetoImpuestoSatFraRelPagosCaja;
					objCeldaObjetoImpuesto.setAttribute('class', 'no-mostrar');
					objCeldaObjetoImpuesto.innerHTML = strObjetoImpuestoFraRelPagosCaja;

				}
            }
           
            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_fras_relacionadas_detalle_pagos_caja tr").length - 2;
			$('#numElementos_fras_relacionadas_detalle_pagos_caja').html(intFilas);
			$('#txtNumFrasRelacionadas_detalle_pagos_caja').val(intFilas);
		
			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_fras_relacionadas_detalle_pagos_caja();
		}



	   


		//Función para agregar renglón a la tabla
		function agregar_renglon_fras_relacionadas_detalle_pagos_caja()
		{
			//Variable que se utiliza para asignar el mensaje informativo
			var strMensaje = '';
			//Variable que se utiliza para asignar la moneda del pago
			var intMonedaIDDetallePago =  parseInt($("#cmbMonedaID_detalle_pagos_caja").val());
			//Variable que se utiliza para asignar el tipo de cambio del pago
			var intTipoCambioDetallePago =  parseFloat($("#txtTipoCambio_detalle_pagos_caja").val());

			//Obtenemos los datos de las cajas de texto
			var intReferenciaID = $('#txtReferenciaID_fra_relacionada_detalle_pagos_caja').val();
			var strTipoReferencia = $('#txtTipoReferencia_fra_relacionada_detalle_pagos_caja').val();
			var intMonedaID = parseInt($('#txtMonedaID_fra_relacionada_detalle_pagos_caja').val());
			var intTipoCambio = parseFloat($('#txtTipoCambio_fra_relacionada_detalle_pagos_caja').val());
			var intImpSaldoAnt = $('#txtImpSaldoAnt_fra_relacionada_detalle_pagos_caja').val();
			var intImpPagado = $('#txtImpPagado_fra_relacionada_detalle_pagos_caja').val();
			var intImpPagadoAux = $('#txtImpPagadoAux_fra_relacionada_detalle_pagos_caja').val();
			var strObjetoImpuestoSat = $('#txtObjetoImpuestoSat_fra_relacionada_detalle_pagos_caja').val();
			var strObjetoImpuesto = $('#txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja').val();


			//Variable que se utiliza para asignar el importe del detalle convertido al tipo de cambio del pago
			var intImpPagadoConv = 0;

			//Variable que se utiliza para asignar el id del detalle
			var strDetalleID = intReferenciaID+'_'+strTipoReferencia;

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_fras_relacionadas_detalle_pagos_caja').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intImpPagado == '')
			{
				//Enfocar caja de texto
				$('#txtImpPagado_fra_relacionada_detalle_pagos_caja').focus();
			}
			else if (strObjetoImpuestoSat == '')
			{
				//Enfocar caja de texto
				$('#txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja').focus();
			}
			else
			{
				//Convertir cadena de texto a número decimal
				intImpSaldoAnt =  parseFloat($.reemplazar(intImpSaldoAnt, ",", ""));
				intImpPagado =  parseFloat($.reemplazar(intImpPagado, ",", ""));
				//Asignar el saldo de la factura convertido al tipo de cambio
				var intSaldoFacturaConv = intImpSaldoAnt;

				//Si el tipo de moneda del pago corresponde a peso mexicano
				if(intMonedaIDDetallePago === intMonedaBaseIDPagosCaja)
				{
					//Asignar el importe pagado
					intImpPagadoConv = intImpPagado;

					//Si el tipo de moneda de la factura es diferente a la moneda del pago
					if(intMonedaID !== intMonedaIDDetallePago)
					{
						//Convertir importe pagado a peso mexicano
						intImpPagado = intImpPagado / intTipoCambio;
						intSaldoFacturaConv = intSaldoFacturaConv * intTipoCambio;
					}
				}
				else
				{
					//Si el tipo de moneda de la factura corresponde a peso mexicano
					if(intMonedaID === intMonedaBaseIDPagosCaja)
					{
						//Convertir importe pagado auxiliar a tipo de cambio
						var intConvImpAux = parseFloat(intImpPagadoAux) / intTipoCambioDetallePago;
						//Redondear cantidad a dos decimales
						var intRedConvImpAux = intConvImpAux.toFixed(2);
						//Si el importe pagado es igual a la conversión del importe auxiliar
						if(intImpPagado == intRedConvImpAux)
						{
							//Asignar el importe auxiliar convertido
							intImpPagado = intConvImpAux;
						}

						//Asignar el importe pagado
						intImpPagadoConv = intImpPagado;

						//Convertir importe pagado a tipo de cambio
						intImpPagado = intImpPagado * intTipoCambioDetallePago;
						intSaldoFacturaConv = intSaldoFacturaConv / intTipoCambioDetallePago;

					}
					else
					{
						//Asignar el importe pagado
						intImpPagadoConv = intImpPagado;
					}
				}
				
				//Redondear cantidad a dos decimales
				intSaldoFacturaConv = intSaldoFacturaConv.toFixed(2);
				intSaldoFacturaConv = parseFloat(intSaldoFacturaConv);
				intImpPagadoConv = intImpPagadoConv.toFixed(2);
				intImpPagadoConv = parseFloat(intImpPagadoConv);

				//Verificar que el importe pagado sea menor o igual que el saldo de la factura
				if(intImpPagadoConv <= intSaldoFacturaConv)
				{
	            	//Limpiamos las cajas de texto
					$('#txtReferenciaID_fra_relacionada_detalle_pagos_caja').val('');
					$('#txtTipoReferencia_fra_relacionada_detalle_pagos_caja').val('');
					$('#txtMonedaID_fra_relacionada_detalle_pagos_caja').val('');
				    $('#txtFolio_fra_relacionada_detalle_pagos_caja').val('');
					$('#txtUuid_fra_relacionada_detalle_pagos_caja').val('');
					$('#txtMonedaTipo_fra_relacionada_detalle_pagos_caja').val('');
					$('#txtTipoCambio_fra_relacionada_detalle_pagos_caja').val('');
					$('#txtMetodoPago_fra_relacionada_detalle_pagos_caja').val('');
					$('#txtImpSaldoAnt_fra_relacionada_detalle_pagos_caja').val('');
					$('#txtImpPagadoAux_fra_relacionada_detalle_pagos_caja').val('');
					$('#txtImpPagado_fra_relacionada_detalle_pagos_caja').val('');
					$('#txtObjetoImpuestoSat_fra_relacionada_detalle_pagos_caja').val('');
				    $('#txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja').val('');

					//Si el saldo de la factura es igual al importe pagado auxiliar
					if(intSaldoFacturaConv == intImpPagadoConv)
					{
						//Asignar saldo anterior de la factura (para evitar saldos pendientes)
						intImpPagado = intImpSaldoAnt;
					}

					//Revisamos si existe el ID proporcionado, si es así, editamos los datos
					if (objTabla.rows.namedItem(strDetalleID))
					{
						objTabla.rows.namedItem(strDetalleID).cells[5].innerHTML = formatMoney(intImpSaldoAnt, 2, '');
						objTabla.rows.namedItem(strDetalleID).cells[6].innerHTML = formatMoney(intImpPagado, 2, '');
						objTabla.rows.namedItem(strDetalleID).cells[15].innerHTML = intImpPagado;
						objTabla.rows.namedItem(strDetalleID).cells[16].innerHTML = strObjetoImpuestoSat;
						objTabla.rows.namedItem(strDetalleID).cells[17].innerHTML = strObjetoImpuesto;
					}

					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_fras_relacionadas_detalle_pagos_caja();

					//Enfocar caja de texto
					$('#txtImpPagado_fra_relacionada_detalle_pagos_caja').focus();

				}
				else
				{
					//Cambiar cantidad a formato moneda
			    	intSaldoFacturaConv = formatMoney(intSaldoFacturaConv, 2, '');

					//Asignar saldo de la factura
					$('#txtImpPagado_fra_relacionada_detalle_pagos_caja').val(intSaldoFacturaConv);

					/*Mensaje que se utiliza para informar al usuario que el pago no debe ser mayor que el saldo de la factura*/
					strMensaje = 'El pago aplicado sobrepasa el saldo de la factura.';
					strMensaje += '<br>Saldo restante: <b>'+intSaldoFacturaConv+'</b>';


					//Hacer un llamado a la función para mostrar mensaje de información
				    mensaje_pagos_caja('informacion', strMensaje, 'txtImpPagado_fra_relacionada_detalle_pagos_caja');

				}
					
				
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_fras_relacionadas_detalle_pagos_caja tr").length - 2;
			$('#numElementos_fras_relacionadas_detalle_pagos_caja').html(intFilas);
			$('#txtNumFrasRelacionadas_detalle_pagos_caja').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_fras_relacionadas_detalle_pagos_caja(objRenglon)
		{
			//Variable que se utiliza para asignar la moneda del pago
			var intMonedaIDDetallePago =  parseInt($("#cmbMonedaID_detalle_pagos_caja").val());
			//Variable que se utiliza para asignar el tipo de cambio del pago
			var intTipoCambioDetallePago =  parseFloat($("#txtTipoCambio_detalle_pagos_caja").val());

			//Asignar valores del detalle
		    var intTipoCambio = parseFloat(objRenglon.parentNode.parentNode.cells[3].innerHTML);
		    var intMonedaID = parseInt(objRenglon.parentNode.parentNode.cells[13].innerHTML);
		    var intImpPagadoAux = parseFloat(objRenglon.parentNode.parentNode.cells[15].innerHTML);
		    var intImpPagado = intImpPagadoAux;

		    //Si el tipo de moneda de la factura es diferente a la moneda del pago
			if(intMonedaID !== intMonedaIDDetallePago )
			{
				//Si el tipo de moneda de la factura corresponde a peso mexicano
			    if(intMonedaID == intMonedaBaseIDPagosCaja)
				{
					//Convertir peso mexicano a tipo de cambio
					intImpPagado = intImpPagado / intTipoCambioDetallePago;
				}
				else
				{
					//Convertir importe a peso mexicano
					intImpPagado = intImpPagado * intTipoCambio;
				}
			}

			//Convertir cantidad a formato moneda
			intImpPagado = formatMoney(intImpPagado, 2, '');

			//Asignar los valores a las cajas de texto
			$('#txtReferenciaID_fra_relacionada_detalle_pagos_caja').val(objRenglon.parentNode.parentNode.cells[8].innerHTML);
			$('#txtTipoReferencia_fra_relacionada_detalle_pagos_caja').val(objRenglon.parentNode.parentNode.cells[9].innerHTML);
			$('#txtMonedaID_fra_relacionada_detalle_pagos_caja').val(intMonedaID);
			$('#txtFolio_fra_relacionada_detalle_pagos_caja').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtUuid_fra_relacionada_detalle_pagos_caja').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtMonedaTipo_fra_relacionada_detalle_pagos_caja').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtTipoCambio_fra_relacionada_detalle_pagos_caja').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtMetodoPago_fra_relacionada_detalle_pagos_caja').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
			$('#txtImpSaldoAnt_fra_relacionada_detalle_pagos_caja').val(objRenglon.parentNode.parentNode.cells[5].innerHTML);
			$('#txtImpPagadoAux_fra_relacionada_detalle_pagos_caja').val(intImpPagadoAux);
			$('#txtImpPagado_fra_relacionada_detalle_pagos_caja').val(intImpPagado);
			$('#txtObjetoImpuestoSat_fra_relacionada_detalle_pagos_caja').val(objRenglon.parentNode.parentNode.cells[16].innerHTML);
			$('#txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja').val(objRenglon.parentNode.parentNode.cells[17].innerHTML);

			//Si no existe código del objeto de impuesto
			if($('#txtObjetoImpuestoSat_fra_relacionada_detalle_pagos_caja').val() == '')
			{
				//Hacer un llamado a la función para cargar el uso de objeto de impuesto base
				cargar_objeto_impuesto_base_pagos_caja('txtObjetoImpuestoSat_fra_relacionada_detalle_pagos_caja', 'txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja');
				
			}


			//Enfocar caja de texto
			$('#txtImpPagado_fra_relacionada_detalle_pagos_caja').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_fras_relacionadas_detalle_pagos_caja(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_fras_relacionadas_detalle_pagos_caja").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_fras_relacionadas_detalle_pagos_caja();

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_fras_relacionadas_detalle_pagos_caja tr").length - 2;
			$('#numElementos_fras_relacionadas_detalle_pagos_caja').html(intFilas);
			$('#txtNumFrasRelacionadas_detalle_pagos_caja').val(intFilas);
		}

		//Función para calcular totales de la tabla
		function calcular_totales_fras_relacionadas_detalle_pagos_caja()
		{
			//Variable que se utiliza para asignar la moneda del pago
			var intMonedaIDDetallePago =  parseInt($("#cmbMonedaID_detalle_pagos_caja").val());
			//Variable que se utiliza para asignar el tipo de cambio del pago
			var intTipoCambioDetallePago =  parseFloat($("#txtTipoCambio_detalle_pagos_caja").val());

			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_fras_relacionadas_detalle_pagos_caja').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumSaldo = 0;
			var intAcumPago = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar los datos de la factura
				var intTipoCambio = parseFloat(objRen.cells[3].innerHTML);
				var intMonedaID = parseInt(objRen.cells[13].innerHTML);
				
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intSaldo = $.reemplazar(objRen.cells[5].innerHTML, ",", "");
				var intImpPagado = $.reemplazar(objRen.cells[15].innerHTML, ",", "");

				//Si el tipo de moneda de la factura es diferente a la moneda del pago
				if(intMonedaID !== intMonedaIDDetallePago )
				{
					//Convertir importe a peso mexicano
					intSaldo = intSaldo * intTipoCambio;
					intImpPagado = intImpPagado * intTipoCambio;

					//Si el tipo de moneda de la factura corresponde a peso mexicano
				    if(intMonedaID == intMonedaBaseIDPagosCaja)
					{
						//Convertir peso mexicano a tipo de cambio
						intSaldo = intSaldo / intTipoCambioDetallePago;
						intImpPagado = intImpPagado / intTipoCambioDetallePago;
					}
					
				}

				//Incrementar acumulado
				intAcumSaldo += parseFloat(intSaldo);
    			intAcumPago += parseFloat(intImpPagado);
			}

			//Convertir cantidad a formato moneda
			intAcumSaldo =  '$'+formatMoney(intAcumSaldo, 2, '');
			intAcumPago =  '$'+formatMoney(intAcumPago, 2, '');

			//Asignar los valores
			$('#acumSaldo_detalles_pagos_caja').html(intAcumSaldo);
			$('#acumPago_detalles_pagos_caja').html(intAcumPago);
			$('#monedaDetallePago_detalles_pagos_caja').html(strMonedaDetallePagosCaja);
		}


		/*******************************************************************************************************************
		Funciones del modal Relacionar Documentos (facturas) del Detalle
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_fras_detalle_pagos_caja()
		{
			//Incializar formulario
			$('#frmRelacionarFrasDetallePagosCaja')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_fras_detalle_pagos_caja();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarFrasDetallePagosCaja').find('input[type=hidden]').val('');
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_relacionar_fras_detalle_pagos_caja').addClass("estatus-NUEVO");
			//Eliminar los datos de la tabla documentos (facturas) a relacionar
		    $('#dg_relacionar_fras_detalle_pagos_caja tbody').empty();
		    $('#numElementos_relacionar_fras_detalle_pagos_caja').html(0);
		    $('#acumSaldo_relacionar_fras_detalle_pagos_caja').html('$0.00');
		    $('#acumSaldoVencido_relacionar_fras_detalle_pagos_caja').html('$0.00');
		    $('#acumAntSaldo_relacionar_fras_detalle_pagos_caja').html('$0.00');
		    $('#acumAntSaldoVencido_relacionar_fras_detalle_pagos_caja').html('$0.00');
		    //Deshabilitar la siguiente caja de texto
			$('#txtRazonSocialBusq_relacionar_fras_detalle_pagos_caja').attr("disabled", "disabled");
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_fras_detalle_pagos_caja()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_fras_detalle_pagos_caja();
			//Variables que se utilizan para asignar los datos del registro
			var strRazonSocial =  $('#txtRazonSocial_pagos_caja').val();
			var intProspectoID =  $('#txtProspectoID_pagos_caja').val();
		    //Asignar los datos del cliente
		    $('#txtProspectoIDBusq_relacionar_fras_detalle_pagos_caja').val(intProspectoID);
		    $('#txtRazonSocialBusq_relacionar_fras_detalle_pagos_caja').val(strRazonSocial);

			//Abrir modal
			objRelacionarFrasDetallePagosCaja = $('#RelacionarFrasDetallePagosCajaBox').bPopup({
												  appendTo: '#PagosCajaContent', 
				                              	  contentContainer: 'PagosCajaM', 
				                              	  zIndex: 2, 
				                              	  modalClose: false, 
				                              	  modal: true, 
				                              	  follow: [true,false], 
				                              	  followEasing : "linear", 
				                              	  easing: "linear", 
				                             	  modalColor: ('#F0F0F0')});

			//Hacer un llamado a la función  para cargar las facturas con adeudos en el grid
			lista_facturas_relacionar_fras_detalle_pagos_caja();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_fras_detalle_pagos_caja()
		{
			try {
				//Cerrar modal
				objRelacionarFrasDetallePagosCaja.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_fras_detalle_pagos_caja()
		{

			//Hacer un llamado a la función para agregar las facturas seleccionadas al  objeto Facturas relacionadas
			agregar_facturas_relacionar_fras_detalle_pagos_caja();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_fras_detalle_pagos_caja();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarFrasDetallePagosCaja')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumFras_relacionar_fras_detalle_pagos_caja: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccionar al menos una factura para este detalle.'
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
			var bootstrapValidator_relacionar_fras_detalle_pagos_caja = $('#frmRelacionarFrasDetallePagosCaja').data('bootstrapValidator');
			bootstrapValidator_relacionar_fras_detalle_pagos_caja.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_fras_detalle_pagos_caja.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_fras_detalle_pagos_caja();
				//Hacer un llamado a la función para agregar las facturas en la tabla facturas relacionadas
		  		agregar_fras_relacionadas_detalle_pagos_caja('Nuevo', '');
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_fras_detalle_pagos_caja()
		{
			try
			{
				$('#frmRelacionarFrasDetallePagosCaja').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar facturas
		*********************************************************************************************************************/
		//Función para la búsqueda de facturas
		function lista_facturas_relacionar_fras_detalle_pagos_caja() 
		{
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('caja/pagos/get_facturas_adeudos',
					{	
						intProspectoID: $('#txtProspectoIDBusq_relacionar_fras_detalle_pagos_caja').val(), 
						intMonedaIDPago: $('#cmbMonedaID_detalle_pagos_caja').val(),
						intTipoCambioPago: $('#txtTipoCambio_detalle_pagos_caja').val(), 
						strTipo: strTipoReferenciaPagosCaja
					},
					function(data){
						$('#dg_relacionar_fras_detalle_pagos_caja tbody').empty();
						var tmpRelacionarFrasPagosCaja = Mustache.render($('#plantilla_relacionar_fras_detalle_pagos_caja').html(),data);
						$('#numElementos_relacionar_fras_detalle_pagos_caja').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_fras_detalle_pagos_caja').html(data.rows.length);	
						}
						$('#acumSaldo_relacionar_fras_detalle_pagos_caja').html(data.acumulado_saldo);
						$('#acumSaldoVencido_relacionar_fras_detalle_pagos_caja').html(data.acumulado_saldo_vencido+' '+strMonedaDetallePagosCaja);
						$('#acumAntSaldo_relacionar_fras_detalle_pagos_caja').html(data.acumulado_anticipos);
						$('#acumAntSaldoVencido_relacionar_fras_detalle_pagos_caja').html(data.acumulado_anticipos+' '+strMonedaDetallePagosCaja);
						$('#dg_relacionar_fras_detalle_pagos_caja tbody').html(tmpRelacionarFrasPagosCaja);
					
						
					},
			'json');

			
		}

		//Función para agregar las facturas seleccionadas al objeto Facturas relacionadas
		function agregar_facturas_relacionar_fras_detalle_pagos_caja()
		{
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
		    //Variable que se utiliza para asignar el tipo de cambio del pago
		    var intTipoCambio  = parseFloat($('#txtTipoCambio_detalle_pagos_caja').val());
             
            //Crear instancia del objeto Facturas relacionadas (seleccionadas)
			objFrasRelacionadasDetallePagosCaja = new FrasRelacionadasDetallePagosCaja([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_fras_detalle_pagos_caja tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
                	//Crear instancia del objeto Factura a relacionar
					objFraRelacionarDetallePagosCaja = new FraRelacionarDetallePagosCaja(null, '', '', '', '', '', '', '', '', '', '', '', '','');

                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objFraRelacionarDetallePagosCaja.intReferenciaID = strValor;
							        break;
							    case 1:
							        objFraRelacionarDetallePagosCaja.strUuid = strValor;
							        break;
							    case 2:
							        objFraRelacionarDetallePagosCaja.intNumParcialidades = strValor;
							        break;
							    case 3:
							        objFraRelacionarDetallePagosCaja.intTipoCambio = strValor;
							        break;
							    case 4:
							        objFraRelacionarDetallePagosCaja.intMetodoPagoID = strValor;
							        break;
							    case 5:
							        objFraRelacionarDetallePagosCaja.strMetodoPago = strValor;
							        break;
							    case 6:
							        objFraRelacionarDetallePagosCaja.intMonedaID = strValor;
							        break;
							    case 7:
							       	objFraRelacionarDetallePagosCaja.strFolio = strValor;
							        break;
							    case 8:
							       	objFraRelacionarDetallePagosCaja.strMonedaTipo = strValor;
							       	break;
							    case 11:
							       	objFraRelacionarDetallePagosCaja.strTipoReferencia = strValor;
							       	break;
							     case 13:
							       	objFraRelacionarDetallePagosCaja.intImpSaldoAnt = strValor;
							       	objFraRelacionarDetallePagosCaja.intImpPagado = strValor;
									objFraRelacionarDetallePagosCaja.intImpSaldoInsoluto = 0;
									//Hacer un llamado a la función para reemplazar ',' por cadena vacia
									objFraRelacionarDetallePagosCaja.intSaldoFactura = $.reemplazar(strValor, ",", "");
							       	break;
							}
							
					      	intCol++;
					    });

                	//Agregar datos de la factura a relacionar
                	objFrasRelacionadasDetallePagosCaja.setFra(objFraRelacionarDetallePagosCaja);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumFras_relacionar_fras_detalle_pagos_caja').val(intContador);

		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			
			/*******************************************************************************************************************
			Controles correspondientes al modal Pagos
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_pagos_caja').datetimepicker({format: 'DD/MM/YYYY'});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_pagos_caja').blur(function(){
				$('.moneda_pagos_caja').formatCurrency({ roundToDecimalPlace: 2 });
			});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_pagos_caja').blur(function(){
                $('.tipo-cambio_pagos_caja').formatCurrency({ roundToDecimalPlace: 4 });
            });

        	//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocial_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_pagos_caja').val('');
	               //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_pagos_caja();
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
		             $('#txtProspectoID_pagos_caja').val(ui.item.data);
		              //Hacer un llamado a la función para regresar los datos del cliente
		              get_datos_cliente_pagos_caja();	
	             }
	             else
	             {
	             	 //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				     mensaje_pagos_caja('error_regimen_fiscal','','txtRazonSocial_pagos_caja');
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
	        $('#txtRazonSocial_pagos_caja').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_pagos_caja').val() == '' ||
	               $('#txtRazonSocial_pagos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_pagos_caja').val('');
	               $('#txtRazonSocial_pagos_caja').val('');
	              //Hacer un llamado a la función para inicializar elementos del cliente
	               inicializar_cliente_pagos_caja();
                   
	            }
	        });

	        //Autocomplete para recuperar los datos de un uso del CFDI
	        $('#txtUsoCfdi_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtUsoCfdiID_pagos_caja').val('');
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
	             $('#txtUsoCfdiID_pagos_caja').val(ui.item.data);
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
	        $('#txtUsoCfdi_pagos_caja').focusout(function(e){
	            //Si no existe id del uso de CFDI
	            if($('#txtUsoCfdiID_pagos_caja').val() == '' ||
	               $('#txtUsoCfdi_pagos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtUsoCfdiID_pagos_caja').val('');
	               $('#txtUsoCfdi_pagos_caja').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un tipo de relación
	        $('#txtTipoRelacion_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTipoRelacionID_pagos_caja').val('');
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
	             $('#txtTipoRelacionID_pagos_caja').val(ui.item.data);
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
	        $('#txtTipoRelacion_pagos_caja').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtTipoRelacionID_pagos_caja').val() == '' ||
	               $('#txtTipoRelacion_pagos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTipoRelacionID_pagos_caja').val('');
	               $('#txtTipoRelacion_pagos_caja').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un objeto de impuesto
	        $('#txtObjetoImpuesto_pagos_caja').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al código del registro 
	                 $('#txtObjetoImpuestoSat_pagos_caja').val('');
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
	               $('#txtObjetoImpuestoSat_pagos_caja').val(strCodigo);

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
	        $('#txtObjetoImpuesto_pagos_caja').focusout(function(e){
	            //Si no existe código del objeto de impuesto
	            if($('#txtObjetoImpuestoSat_pagos_caja').val() == '' ||
	               $('#txtObjetoImpuesto_pagos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtObjetoImpuestoSat_pagos_caja').val('');
	               $('#txtObjetoImpuesto_pagos_caja').val('');
	            }
	            
	        });

			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_cfdi_relacionados_pagos_caja').on('click','button.btn',function(){
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


	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_pagos_caja').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Verifica que no sea el último elemento del grid
	            	if( row.next().index() != -1 )
	            	{ 
	            		objDetallesPagoPagosCaja.swap(row.index(), row.next().index() );
	            	}	

	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Verifica que no sea el primer elemento del grid
	            	if( row.prev().index() != -1 )
	            	{ 
	            		objDetallesPagoPagosCaja.swap(row.prev().index(), row.index() );
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
		    

	        /*******************************************************************************************************************
        	Controles correspondientes al modal Detalle del Pago
        	*********************************************************************************************************************/
        	//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtTipoCambio_detalle_pagos_caja').numeric();
        	$('#txtMonto_detalle_pagos_caja').numeric();
        	$('#txtImpPagado_fra_relacionada_detalle_pagos_caja').numeric();
        	//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtNumOperacion_detalle_pagos_caja').numeric({decimal: false, negative: false});
        	$('#txtCtaOrdenante_detalle_pagos_caja').numeric({decimal: false, negative: false});
        	

        	//Agregar datepicker para seleccionar fecha
			$('#dteFecha_detalle_pagos_caja').datetimepicker({format: 'DD/MM/YYYY'});

        	//Agregar timepicker para seleccionar una hora
			 $('#txtHora_detalle_pagos_caja').timepicker({
                minuteStep: 1,
                template: 'modal',
                appendWidgetTo: 'body',
                showSeconds: true,
                showMeridian: false,
                defaultTime: false
            });

			 //Regresar el tipo de cambio de la moneda cuando cambie la fecha
			$('#dteFecha_detalle_pagos_caja').on('dp.change', function (e) {
				//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_detalle_pagos_caja();
			});


			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_detalle_pagos_caja').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_detalle_pagos_caja').val()) === intMonedaBaseIDPagosCaja)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_detalle_pagos_caja").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_detalle_pagos_caja').val(intTipoCambioMonedaBasePagosCaja); 
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_detalle_pagos_caja').formatCurrency({ roundToDecimalPlace: 4 });

					//Si existe id de la forma de pago
                    if($("#txtFormaPagoID_detalle_pagos_caja").val() != '')
                    {
						//Quitar clase disabled disabledTab para habilitar el siguiente tab
				    	$('#tabDocRelacionados_detalle_pagos_caja').removeClass("disabled disabledTab");
					}
					
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_detalle_pagos_caja").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_detalle_pagos_caja').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_detalle_pagos_caja();
             	}

             	//Limpiar contenido de las siguientes cajas de texto
             	$('#txtCuentaBancariaID_detalle_pagos_caja').val('');
	            $('#txtCtaBeneficiario_detalle_pagos_caja').val('');
	            $('#txtCuentaBancaria_detalle_pagos_caja').val('');
	        });

		    //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_detalle_pagos_caja').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_detalle_pagos_caja').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoPagosCaja)
	        	{
	        		$('#txtTipoCambio_detalle_pagos_caja').val(intTipoCambioMaximoPagosCaja);
	        	}

	        	//Si no existe tipo de cambio
	        	if($('#txtTipoCambio_detalle_pagos_caja').val() == '')
	        	{
	        		//Agregar clase disabled disabledTab para deshabilitar el siguiente tab
					$('#tabDocRelacionados_detalle_pagos_caja').addClass("disabled disabledTab");
	        	}
	        	else
	        	{
	        		//Quitar clase disabled disabledTab para habilitar el siguiente tab
 					$('#tabDocRelacionados_detalle_pagos_caja').removeClass("disabled disabledTab");
	        	}

	        	//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_fras_relacionadas_detalle_pagos_caja();
		    });


	        //Validar que exista código del objeto de impuesto SAT cuando se pulse la tecla enter 
			$('#txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe código del objeto de impuesto SAT  
		           if($('#txtObjetoImpuestoSat_fra_relacionada_detalle_pagos_caja').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtImpPagado_fra_relacionada_detalle_pagos_caja').focus();
			   	    }
		        }
		    });


		    //Validar que exista importe del pago cuando se pulse la tecla enter 
			$('#txtImpPagado_fra_relacionada_detalle_pagos_caja').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
	         		//Hacer un llamado a la función para agregar renglón a la tabla
	   	    		agregar_renglon_fras_relacionadas_detalle_pagos_caja();
		        }
		    });


		    /*Asignar el código de la moneda del pago a la variable global strMonedaDetallePagosCaja*/
			$(document).on('shown.bs.tab', 'a[href="#doc_relacionados_detalle_pagos_caja"]', function (){
				//Asignar el texto del combobox moneda
				var strMoneda = $('select[name="intMonedaID_detalle_pagos_caja"] option:selected').text();
				//Separar cadena para obtener el código de la moneda del pago
				strMoneda = strMoneda.substr(0,3);

				//Asignar el código de la moneda del pago
				$('#spnMonedaDetallePago_fra_relacionada_detalle_pagos_caja').text(strMoneda);
				strMonedaDetallePagosCaja = strMoneda;

				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_fras_relacionadas_detalle_pagos_caja();
			});
		    
			//Autocomplete para recuperar los datos de una forma de pago
	        $('#txtFormaPago_detalle_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtFormaPagoID_detalle_pagos_caja').val('');
	                //Hacer un llamado a la función para habilitar o deshabilitar campos del formulario 
	            	habilitar_controles_carga_detalle_pagos_caja();
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
	             $('#txtFormaPagoID_detalle_pagos_caja').val(ui.item.data);
	              //Hacer un llamado a la función para habilitar o deshabilitar campos del formulario 
	              habilitar_controles_carga_detalle_pagos_caja();
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
	        $('#txtFormaPago_detalle_pagos_caja').focusout(function(e){
	            //Si no existe id de la forma de pago
	            if($('#txtFormaPagoID_detalle_pagos_caja').val() == '' ||
	               $('#txtFormaPago_detalle_pagos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtFormaPagoID_detalle_pagos_caja').val('');
	               $('#txtFormaPago_detalle_pagos_caja').val('');
	            }
	            
	            //Hacer un llamado a la función para habilitar o deshabilitar campos del formulario 
	            habilitar_controles_carga_detalle_pagos_caja();
	            
	        });



		    //Autocomplete para recuperar los datos de un anticipo
	        $('#txtAnticipo_detalle_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtAnticipoID_detalle_pagos_caja').val('');
	               //Hacer un llamado a la función para inicializar elementos del anticipo
	               inicializar_anticipo_detalle_pagos_caja();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "caja/anticipos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strFormulario: 'polizas_aplicacion'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	              //Asignar id del registro seleccionado
	              $('#txtAnticipoID_detalle_pagos_caja').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos del anticipo
	              get_datos_anticipo_detalle_pagos_caja();

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
	        $('#txtAnticipo_detalle_pagos_caja').focusout(function(e){
	            //Si no existe id del anticipo
	            if($('#txtAnticipoID_detalle_pagos_caja').val() == '' ||
	               $('#txtAnticipo_detalle_pagos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtAnticipoID_detalle_pagos_caja').val('');
	               $('#txtAnticipo_detalle_pagos_caja').val('');
	               //Hacer un llamado a la función para inicializar elementos del anticipo
	               inicializar_anticipo_detalle_pagos_caja();
	            }

	        });


	      	//Autocomplete para recuperar los datos de una cuenta bancaria del cliente 
	        $('#txtCtaOrdenante_detalle_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/clientes/autocomplete_cuentas_bancarias",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   intProspectoID: $('#txtProspectoID_pagos_caja').val(),
	                   strDescripcion: request.term
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar valores del registro seleccionado
	             $('#txtRfcEmisorCtaOrd_detalle_pagos_caja').val(ui.item.rfc_banco); 
	             $('#txtBancoIDEmisorCtaOrd_detalle_pagos_caja').val(ui.item.rfc_banco);
	             $('#txtNomBancoOrdExt_detalle_pagos_caja').val(ui.item.razon_social_banco);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Autocomplete para recuperar los datos de un rfc bancario
	        $('#txtRfcEmisorCtaOrd_detalle_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtBancoIDEmisorCtaOrd_detalle_pagos_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_bancos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'rfc'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar valores del registro seleccionado
	             $('#txtBancoIDEmisorCtaOrd_detalle_pagos_caja').val(ui.item.data);
	             $('#txtNomBancoOrdExt_detalle_pagos_caja').val(ui.item.razon_social);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del banco (rfc bancario) cuando pierda el enfoque la caja de texto
	        $('#txtRfcEmisorCtaOrd_detalle_pagos_caja').focusout(function(e){
	            //Si no existe id del banco
	            if($('#txtBancoIDEmisorCtaOrd_detalle_pagos_caja').val() == '' ||
	               $('#txtRfcEmisorCtaOrd_detalle_pagos_caja').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtBancoIDEmisorCtaOrd_detalle_pagos_caja').val('');
	                $('#txtRfcEmisorCtaOrd_detalle_pagos_caja').val('');
	                $('#txtNomBancoOrdExt_detalle_pagos_caja').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una cuenta bancaria 
	        $('#txtCuentaBancaria_detalle_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCuentaBancariaID_detalle_pagos_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/cuentas_bancarias/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intMonedaID: $('#cmbMonedaID_detalle_pagos_caja').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar valores del registro seleccionado
	             $('#txtCuentaBancariaID_detalle_pagos_caja').val(ui.item.data);
	             $('#txtRfcEmisorCtaBen_detalle_pagos_caja').val(ui.item.rfc_banco);
	             $('#txtBancoIDEmisorCtaBen_detalle_pagos_caja').val(ui.item.rfc_banco);
	             $('#txtCtaBeneficiario_detalle_pagos_caja').val(ui.item.clabe);
	             
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
	        $('#txtCuentaBancaria_detalle_pagos_caja').focusout(function(e){
	            //Si no existe id de la cuenta bancaria
	            if($('#txtCuentaBancariaID_detalle_pagos_caja').val() == '' ||
	               $('#txtCuentaBancaria_detalle_pagos_caja').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtCuentaBancariaID_detalle_pagos_caja').val('');
	                $('#txtCuentaBancaria_detalle_pagos_caja').val('');
	                $('#txtCtaBeneficiario_detalle_pagos_caja').val('');
	                $('#txtRfcEmisorCtaBen_detalle_pagos_caja').val('');
	                $('#txtBancoIDEmisorCtaBen_detalle_pagos_caja').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de un rfc bancario
	        $('#txtRfcEmisorCtaBen_detalle_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtBancoIDEmisorCtaBen_detalle_pagos_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_bancos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strTipo: 'rfc'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar los datos del registro seleccionado
	             $('#txtBancoIDEmisorCtaBen_detalle_pagos_caja').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del banco (rfc bancario) cuando pierda el enfoque la caja de texto
	        $('#txtRfcEmisorCtaBen_detalle_pagos_caja').focusout(function(e){
	            //Si no existe id del banco
	            if($('#txtBancoIDEmisorCtaBen_detalle_pagos_caja').val() == '' ||
	               $('#txtRfcEmisorCtaBen_detalle_pagos_caja').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtBancoIDEmisorCtaBen_detalle_pagos_caja').val('');
	                $('#txtRfcEmisorCtaBen_detalle_pagos_caja').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una cadena de pago
	        $('#txtCadenaPago_detalle_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCadenaPagoID_detalle_pagos_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_cadenas_pago/autocomplete",
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
	             $('#txtCadenaPagoID_detalle_pagos_caja').val(ui.item.data);
	             //Habilitar las siguientes cajas de texto
	             $('#txtCerPago_detalle_pagos_caja').removeAttr('disabled');
				 $('#txtCadPago_detalle_pagos_caja').removeAttr('disabled');
				 $('#txtSelloPago_detalle_pagos_caja').removeAttr('disabled');
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la cadena de pago cuando pierda el enfoque la caja de texto
	        $('#txtCadenaPago_detalle_pagos_caja').focusout(function(e){
	            //Si no existe id de la cadena de pago
	            if($('#txtCadenaPagoID_detalle_pagos_caja').val() == '' ||
	               $('#txtCadenaPago_detalle_pagos_caja').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtCadenaPagoID_detalle_pagos_caja').val('');
	                $('#txtCadenaPago_detalle_pagos_caja').val('');
	                $('#txtCerPago_detalle_pagos_caja').val('');
	                $('#txtCadPago_detalle_pagos_caja').val('');
	                $('#txtSelloPago_detalle_pagos_caja').val('');
	                //Deshabilitar las siguientes cajas de texto
		            $('#txtCerPago_detalle_pagos_caja').attr("disabled", "disabled");
				    $('#txtCadPago_detalle_pagos_caja').attr("disabled", "disabled");
					$('#txtSelloPago_detalle_pagos_caja').attr("disabled", "disabled");
	            }
	            
	        });


	         //Autocomplete para recuperar los datos de un objeto de impuesto
	        $('#txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al código del registro 
	                 $('#txtObjetoImpuestoSat_fra_relacionada_detalle_pagos_caja').val('');
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
	               $('#txtObjetoImpuestoSat_fra_relacionada_detalle_pagos_caja').val(strCodigo);

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
	        $('#txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja').focusout(function(e){
	            //Si no existe código del objeto de impuesto
	            if($('#txtObjetoImpuestoSat_fra_relacionada_detalle_pagos_caja').val() == '' ||
	               $('#txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtObjetoImpuestoSat_fra_relacionada_detalle_pagos_caja').val('');
	               $('#txtObjetoImpuesto_fra_relacionada_detalle_pagos_caja').val('');
	            }
	            
	        });


	       	
	       	//Función para mover renglones arriba y abajo en la tabla
			$('#dg_fras_relacionadas_detalle_pagos_caja').on('click','button.btn',function(){
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


			/*******************************************************************************************************************
			Controles correspondientes al modal Relacionar CFDI
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_relacionar_cfdi_pagos_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_relacionar_cfdi_pagos_caja').datetimepicker({format: 'DD/MM/YYYY'});
			
			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_relacionar_cfdi_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_relacionar_cfdi_pagos_caja').val('');
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
	             $('#txtProspectoIDBusq_relacionar_cfdi_pagos_caja').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_relacionar_cfdi_pagos_caja').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_relacionar_cfdi_pagos_caja').val() == '' ||
	            	$('#txtRazonSocialBusq_relacionar_cfdi_pagos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_relacionar_cfdi_pagos_caja').val('');
	               $('#txtRazonSocialBusq_relacionar_cfdi_pagos_caja').val('');
	            }
	            
	        });



	        /*******************************************************************************************************************
			Controles correspondientes al modal Cancelación del timbrado
			**************************************	*******************************************************************************/
			 //Autocomplete para recuperar los datos de una sustitución (factura, pago, etc.)
	        $('#txtFolioSustitucion_cancelacion_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSustitucionID_cancelacion_pagos_caja').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "caja/pagos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intReferenciaID: $('#txtReferenciaCfdiID_cancelacion_pagos_caja').val(),
	                   strFormulario: 'cancelacion'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtSustitucionID_cancelacion_pagos_caja').val(ui.item.data);
	             $('#txtUuidSustitucion_cancelacion_pagos_caja').val(ui.item.uuid);
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
	        $('#txtFolioSustitucion_cancelacion_pagos_caja').focusout(function(e){
	            //Si no existe id del tipo de relación
	            if($('#txtSustitucionID_cancelacion_pagos_caja').val() == '' ||
	               $('#txtFolioSustitucion_cancelacion_pagos_caja').val() == '')
	            { 
	               //Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_pagos_caja();
	            }
	            
	        });

	        //Verificar motivo de cancelación cuando cambie la opción del combobox
	        $('#cmbCancelacionMotivoID_cancelacion_pagos_caja').change(function(e){   
	            //Si el motivo de cancelación no corresponde a 01 - Comprobante emitido con errores con relación.
              	if(parseInt($('#cmbCancelacionMotivoID_cancelacion_pagos_caja').val()) !== intCancelacionIDRelacionCfdiPagosCaja)
             	{
             		//Hacer un llamado a la función para inicializar elementos de la sustitución
					inicializar_sustitucion_pagos_caja();
					
             	}
	        });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_pagos_caja').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_pagos_caja').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_pagos_caja').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_pagos_caja').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_pagos_caja').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_pagos_caja').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtRazonSocialBusq_pagos_caja').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_pagos_caja').val('');
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
	             $('#txtProspectoIDBusq_pagos_caja').val(ui.item.data);
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
	        $('#txtRazonSocialBusq_pagos_caja').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_pagos_caja').val() == '' ||
	            	$('#txtRazonSocialBusq_pagos_caja').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_pagos_caja').val('');
	               $('#txtRazonSocialBusq_pagos_caja').val('');
	            }
	            
	        });

			//Paginación de registros
			$('#pagLinks_pagos_caja').on('click','a',function(event){
				event.preventDefault();
				intPaginaPagosCaja = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_pagos_caja();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_pagos_caja').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_pagos_caja();
				//Hacer un llamado a la función para cargar el uso de CFDI base
           		cargar_uso_cfdi_base_pagos_caja();
           		//Hacer un llamado a la función para cargar el uso de objeto de impuesto base
				cargar_objeto_impuesto_base_pagos_caja('txtObjetoImpuestoSat_pagos_caja', 'txtObjetoImpuesto_pagos_caja');
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_pagos_caja').addClass("estatus-NUEVO");
				//Abrir modal
				objPagosCaja = $('#PagosCajaBox').bPopup({
									   appendTo: '#PagosCajaContent', 
		                               contentContainer: 'PagosCajaM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtRazonSocial_pagos_caja').focus();
				
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_pagos_caja').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_pagos_caja();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_detalle_pagos_caja();
             //Hacer un llamado a la función para cargar los motivos de cancelación en el combobox del modal
            cargar_motivos_cancelacion_pagos_caja();
             //Hacer un llamado a la función para cargar exportación en el combobox del modal
            cargar_exportacion_pagos_caja();
		});
	</script>