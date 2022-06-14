	<div id="RemisionesRefaccionesRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_remisiones_refacciones_refacciones" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_remisiones_refacciones_refacciones" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_remisiones_refacciones_refacciones">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_remisiones_refacciones_refacciones'>
				                    <input class="form-control" id="txtFechaInicialBusq_remisiones_refacciones_refacciones"
				                    		name= "strFechaInicialBusq_remisiones_refacciones_refacciones" 
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
								<label for="txtFechaFinalBusq_remisiones_refacciones_refacciones">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_remisiones_refacciones_refacciones'>
				                    <input class="form-control" id="txtFechaFinalBusq_remisiones_refacciones_refacciones"
				                    		name= "strFechaFinalBusq_remisiones_refacciones_refacciones" 
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
								<input id="txtProspectoIDBusq_remisiones_refacciones_refacciones" 
									   name="intProspectoIDBusq_remisiones_refacciones_refacciones"  type="hidden" 
									   value="">
								</input>
								<label for="txtProspectoBusq_remisiones_refacciones_refacciones">Cliente</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProspectoBusq_remisiones_refacciones_refacciones" 
										name="strProspectoBusq_remisiones_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese cliente" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_remisiones_refacciones_refacciones">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_remisiones_refacciones_refacciones" 
								 		name="strEstatusBusq_remisiones_refacciones_refacciones" tabindex="1">
								    <option value="TODOS">TODOS</option>
                      				<option value="ACTIVO">ACTIVO</option>
                      				<option value="INACTIVO">INACTIVO</option>
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
								<label for="txtBusqueda_remisiones_refacciones_refacciones">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_remisiones_refacciones_refacciones" 
										name="strBusqueda_remisiones_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_remisiones_refacciones_refacciones" 
									   name="strImprimirDetalles_remisiones_refacciones_refacciones" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_remisiones_refacciones_refacciones"
									onclick="paginacion_remisiones_refacciones_refacciones();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_remisiones_refacciones_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_remisiones_refacciones_refacciones"
									onclick="reporte_remisiones_refacciones_refacciones();" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_remisiones_refacciones_refacciones"
									onclick="descargar_xls_remisiones_refacciones_refacciones();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla ordenes de compra
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Cliente"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles de la cotización
				*/
				td.movil.b1:nth-of-type(1):before {content: "Concepto"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles de la cotización
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
				<table class="table-hover movil" id="dg_remisiones_refacciones_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Cliente</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_remisiones_refacciones_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{cliente}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_remisiones_refacciones_refacciones({{remision_refacciones_id}});"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_remisiones_refacciones_refacciones({{remision_refacciones_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_cliente_remisiones_refacciones_refacciones({{remision_refacciones_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_remisiones_refacciones_refacciones({{remision_refacciones_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_remisiones_refacciones_refacciones({{remision_refacciones_id}});" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_remisiones_refacciones_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_remisiones_refacciones_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarRemisionesRefaccionesRefaccionesBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_cliente_remisiones_refacciones_refacciones" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarRemisionesRefaccionesRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarRemisionesRefaccionesRefacciones"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Cliente-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtRemisionRefaccionesID_cliente_remisiones_refacciones_refacciones" 
										   name="intRemisionRefaccionesID_cliente_remisiones_refacciones_refacciones" 
										   type="hidden" value="">
									</input>
									<label for="txtCliente_cliente_remisiones_refacciones_refacciones">Cliente</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCliente_cliente_remisiones_refacciones_refacciones" 
											name="strProspecto_cliente_remisiones_refacciones_refacciones" type="text" value="" 
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
									<label for="txtCorreoElectronico_cliente_remisiones_refacciones_refacciones">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_cliente_remisiones_refacciones_refacciones" 
											name="strCorreoElectronico_cliente_remisiones_refacciones_refacciones" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_cliente_remisiones_refacciones_refacciones">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_cliente_remisiones_refacciones_refacciones" 
											name="strCopiaCorreoElectronico_cliente_remisiones_refacciones_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_cliente_remisiones_refacciones_refacciones" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_cliente_remisiones_refacciones_refacciones"  
									onclick="validar_cliente_remisiones_refacciones_refacciones();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cliente_remisiones_refacciones_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_cliente_remisiones_refacciones_refacciones();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal Remisiones-->
		<div id="RemisionesRefaccionesRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_remisiones_refacciones_refacciones"  class="ModalBodyTitle">
			<h1>Remisiones</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRemisionesRefaccionesRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmRemisionesRefaccionesRefacciones"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtRemisionRefaccionesID_remisiones_refacciones_refacciones" 
										   name="intRemisionRefaccionesID_remisiones_refacciones_refacciones" type="hidden" value="">
									</input>
									<label for="txtFolio_remisiones_refacciones_refacciones">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_remisiones_refacciones_refacciones" 
											name="strFolio_remisiones_refacciones_refacciones" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_remisiones_refacciones_refacciones">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_remisiones_refacciones_refacciones'>
					                    <input class="form-control" id="txtFecha_remisiones_refacciones_refacciones"
					                    		name= "strFecha_remisiones_refacciones_refacciones" 
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
									<label for="cmbMonedaID_remisiones_refacciones_refacciones">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_remisiones_refacciones_refacciones" 
									 		name="intMonedaID_remisiones_refacciones_refacciones" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_remisiones_refacciones_refacciones">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_remisiones_refacciones_refacciones" id="txtTipoCambio_remisiones_refacciones_refacciones" 
											name="intTipoCambio_remisiones_refacciones_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
				    	<!--Autocomplete que contiene las cotizaciones activas-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id de la referencia (cotización/pedido) seleccionada-->
									<input id="txtReferenciaID_remisiones_refacciones_refacciones" 
										   name="intReferenciaID_remisiones_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta para recuperar el tipo de referencia (cotización/pedido) seleccionada-->
									<input id="txtTipoReferencia_remisiones_refacciones_refacciones" 
										   name="strTipoReferencia_remisiones_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<label for="txtCotizacionRefacciones_remisiones_refacciones_refacciones">Cotización</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCotizacionRefacciones_remisiones_refacciones_refacciones" 
											name="strCotizacionRefacciones_remisiones_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese cotización" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los pedidos activos-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPedidoRefacciones_remisiones_refacciones_refacciones">Pedido</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtPedidoRefacciones_remisiones_refacciones_refacciones" 
											name="strPedidoRefacciones_remisiones_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese pedido" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    	<!--Tipo-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipo_remisiones_refacciones_refacciones">Tipo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTipo_remisiones_refacciones_refacciones" 
									 		name="strTipo_remisiones_refacciones_refacciones" tabindex="1">
									    <option value="">Seleccione una opción</option>
									    <option value="MENUDEO">MENUDEO</option>
	                      				<option value="MAYOREO">MAYOREO</option>
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
									<input id="txtEstrategiaID_remisiones_refacciones_refacciones" 
										   name="intEstrategiaID_remisiones_refacciones_refacciones" 
										   type="hidden" value="">
									</input>
									<label for="txtEstrategia_remisiones_refacciones_refacciones">
										Estrategia
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEstrategia_remisiones_refacciones_refacciones" 
											name="strEstrategia_remisiones_refacciones_refacciones" type="text" value=""  placeholder="Ingrese estrategia" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Anticipo-->
					    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtAnticipo_remisiones_refacciones_refacciones">Anticipo</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control cantidad_remisiones_refacciones_refacciones" id="txtAnticipo_remisiones_refacciones_refacciones" 
												name="intAnticipo_remisiones_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese anticipo" maxlength="12">
										</input>
										
									</div>
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
									<input id="txtProspectoID_remisiones_refacciones_refacciones" 
										   name="intProspectoID_remisiones_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la lista de precios correspondiente al cliente seleccionado-->
									<input id="txtRefaccionesListaPrecioID_remisiones_refacciones_refacciones" 
										   name="intRefaccionesListaPrecioID_remisiones_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<label for="txtCliente_remisiones_refacciones_refacciones">Cliente</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCliente_remisiones_refacciones_refacciones" 
											name="strCliente_remisiones_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese cliente" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los vendedores activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id del vendedor seleccionado-->
									<input id="txtVendedorID_remisiones_refacciones_refacciones" 
										   name="intVendedorID_remisiones_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<label for="txtVendedor_remisiones_refacciones_refacciones">Vendedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtVendedor_remisiones_refacciones_refacciones" 
											name="strVendedor_remisiones_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese vendedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>

				    </div>
				    <div class="row">
				    	<!--Observaciones-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_remisiones_refacciones_refacciones">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_remisiones_refacciones_refacciones" 
											name="strObservaciones_remisiones_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Notas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtNotas_remisiones_refacciones_refacciones">Notas</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtNotas_remisiones_refacciones_refacciones" 
											name="strNotas_remisiones_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese notas" maxlength="250">
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
									<input id="txtNumDetalles_remisiones_refacciones_refacciones" 
										   name="intNumDetalles_remisiones_refacciones_refacciones" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la remisión</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene las refacciones y kits de refacciones activas-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la referencia seleccionada-->
																<input id="txtReferenciaID_detalles_remisiones_refacciones_refacciones" 
																	   name="intReferenciaID_detalles_remisiones_refacciones_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el id del tipo de referencia seleccionada-->
																<input id="txtTipoReferencia_detalles_remisiones_refacciones_refacciones" 
																	   name="strTipoReferencia_detalles_remisiones_refacciones_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el código de la refacción seleccionada-->
																<input id="txtCodigo_detalles_remisiones_refacciones_refacciones" 
																	   name="strCodigo_detalles_remisiones_refacciones_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar la descripción de la refacción seleccionada-->
																<input id="txtDescripcion_detalles_remisiones_refacciones_refacciones" 
																	   name="strDescripcion_detalles_remisiones_refacciones_refacciones" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar el precio de la refacción seleccionada-->
																<input id="txtPrecioRefaccion_detalles_remisiones_refacciones_refacciones" 
																	   name="intPrecioRefaccion_detalles_remisiones_refacciones_refacciones"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta que se utiliza para recuperar el tipo de cambio de la refacción seleccionada-->
																<input id="txtTipoCambio_detalles_remisiones_refacciones_refacciones" 
																	   name="intTipoCambio_detalles_remisiones_refacciones_refacciones"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta para recuperar la existencia disponible  de la refacción (en el inventario)  seleccionada-->
                                                                <input id="txtDisponibleExistencia_detalles_remisiones_refacciones_refacciones" 
                                                                       name="intDisponibleExistencia_detalles_remisiones_refacciones_refacciones" 
                                                                       type="hidden" value="">
                                                                </input>
                                                                 <!-- Caja de texto oculta para recuperar el costo actual de la refacción (en el inventario)  seleccionada-->
																<input id="txtActualCosto_detalles_remisiones_refacciones_refacciones" 
																	   name="intActualCosto_detalles_remisiones_refacciones_refacciones" 
																	   type="hidden" value="">
																</input>
																<label for="txtReferencia_detalles_remisiones_refacciones_refacciones">
																	Referencia
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtReferencia_detalles_remisiones_refacciones_refacciones" 
																		name="strReferencia_detalles_remisiones_refacciones_refacciones" type="text" value="" 
																		tabindex="1" placeholder="Ingrese referencia" maxlength="250">
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
																<label for="txtCantidad_detalles_remisiones_refacciones_refacciones">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_remisiones_refacciones_refacciones" 
																		id="txtCantidad_detalles_remisiones_refacciones_refacciones" 
																		name="intCantidad_detalles_remisiones_refacciones_refacciones" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="14">
																</input>
															</div>
														</div>
													</div>
													<!--Precio unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPrecioUnitario_detalles_remisiones_refacciones_refacciones">Precio unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_remisiones_refacciones_refacciones" id="txtPrecioUnitario_detalles_remisiones_refacciones_refacciones" 
																		name="intPrecioUnitario_detalles_remisiones_refacciones_refacciones" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_remisiones_refacciones_refacciones" id="txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones" 
																		name="intPorcentajeDescuento_detalles_remisiones_refacciones_refacciones" type="text" value="" 
																		tabindex="1" placeholder="Ingrese descuento" maxlength="8">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IVA-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeIva_detalles_remisiones_refacciones_refacciones">IVA %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_remisiones_refacciones_refacciones" id="txtPorcentajeIva_detalles_remisiones_refacciones_refacciones" 
																		name="intPorcentajeIva_detalles_remisiones_refacciones_refacciones" type="text" value="" 
																		tabindex="1" placeholder="Ingrese IVA" maxlength="8">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IEPS-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones">IEPS %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_remisiones_refacciones_refacciones" id="txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones" 
																		name="intPorcentajeIeps_detalles_remisiones_refacciones_refacciones" type="text" value="" 
																		tabindex="1" placeholder="Ingrese IEPS" maxlength="8">
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_remisiones_refacciones_refacciones"
					                                			onclick="agregar_renglon_detalles_remisiones_refacciones_refacciones();" 
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
													<table class="table-hover movil" id="dg_detalles_remisiones_refacciones_refacciones">
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
																	<strong id="acumCantidad_detalles_remisiones_refacciones_refacciones">0.00</strong>
																</td>
																<td class="movil t4"></td>
																<td class="movil t5">
																	<strong id="acumDescuento_detalles_remisiones_refacciones_refacciones">$0.00</strong>
																</td>
																<td class="movil t6">
																	<strong id="acumSubtotal_detalles_remisiones_refacciones_refacciones">$0.00</strong>
																</td>
																<td class="movil t7">
																	<strong id="acumIva_detalles_remisiones_refacciones_refacciones">$0.000000</strong>
																</td>
																<td class="movil t8">
																	<strong  id="acumIeps_detalles_remisiones_refacciones_refacciones">$0.000000</strong>
																</td>
																<td class="movil t9">
																	<strong id="acumTotal_detalles_remisiones_refacciones_refacciones">$0.000000</strong>
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
																<strong id="numElementos_detalles_remisiones_refacciones_refacciones">0</strong> encontrados
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
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Nuevo registro-->
							<button class="btn btn-info" id="btnReiniciar_remisiones_refacciones_refacciones"  
									onclick="nuevo_remisiones_refacciones_refacciones('Nuevo');"  title="Nuevo registro" tabindex="2">
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_remisiones_refacciones_refacciones"  
									onclick="validar_remisiones_refacciones_refacciones();"  title="Guardar" tabindex="3" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_remisiones_refacciones_refacciones"  
									onclick="abrir_cliente_remisiones_refacciones_refacciones('');"  
									title="Enviar correo electrónico" tabindex="4" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_remisiones_refacciones_refacciones"  
									onclick="reporte_registro_remisiones_refacciones_refacciones('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_remisiones_refacciones_refacciones"  
									onclick="cambiar_estatus_remisiones_refacciones_refacciones('');"  title="Desactivar" tabindex="6" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_remisiones_refacciones_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_remisiones_refacciones_refacciones();" 
									title="Cerrar"  tabindex="7">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Remisiones-->
	</div><!--#RemisionesRefaccionesRefaccionesContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_remisiones_refacciones_refacciones" type="text/template">
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
		var intPaginaRemisionesRefaccionesRefacciones = 0;
		var strUltimaBusquedaRemisionesRefaccionesRefacciones = "";
		//Variable que se utiliza para asignar el id del módulo de refacciones
		var intModuloIDRemisionesRefaccionesRefacciones = <?php echo MODULO_REFACCIONES ?>;
		//Variable que se utiliza para asignar el módulo de la estrategia
		var strModuloRemisionesRefaccionesRefacciones = "REFACCIONES";
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDRemisionesRefaccionesRefacciones = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseRemisionesRefaccionesRefacciones = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoRemisionesRefaccionesRefacciones = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variables que se utilizan para la búsqueda de registros
		var intProspectoIDRemisionesRefaccionesRefacciones = "";
		var dteFechaInicialRemisionesRefaccionesRefacciones = "";
		var dteFechaFinalRemisionesRefaccionesRefacciones = "";
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarRemisionesRefaccionesRefacciones = null;
		//Variable que se utiliza para asignar objeto del modal Remisiones
		var objRemisionesRefaccionesRefacciones = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_remisiones_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/remisiones_refacciones/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_remisiones_refacciones_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRemisionesRefaccionesRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosRemisionesRefaccionesRefacciones = strPermisosRemisionesRefaccionesRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRemisionesRefaccionesRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRemisionesRefaccionesRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_remisiones_refacciones_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosRemisionesRefaccionesRefacciones[i]=='GUARDAR') || (arrPermisosRemisionesRefaccionesRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_remisiones_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRemisionesRefaccionesRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_remisiones_refacciones_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_remisiones_refacciones_refacciones();
						}
						else if(arrPermisosRemisionesRefaccionesRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_remisiones_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRemisionesRefaccionesRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_remisiones_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRemisionesRefaccionesRefacciones[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_remisiones_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRemisionesRefaccionesRefacciones[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_remisiones_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRemisionesRefaccionesRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_remisiones_refacciones_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_remisiones_refacciones_refacciones() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaRemisionesRefaccionesRefacciones =($('#txtFechaInicialBusq_remisiones_refacciones_refacciones').val()+$('#txtFechaFinalBusq_remisiones_refacciones_refacciones').val()+$('#txtProspectoIDBusq_remisiones_refacciones_refacciones').val()+$('#cmbEstatusBusq_remisiones_refacciones_refacciones').val()+$('#txtBusqueda_remisiones_refacciones_refacciones').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaRemisionesRefaccionesRefacciones != strUltimaBusquedaRemisionesRefaccionesRefacciones)
			{
				intPaginaRemisionesRefaccionesRefacciones = 0;
				strUltimaBusquedaRemisionesRefaccionesRefacciones = strNuevaBusquedaRemisionesRefaccionesRefacciones;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/remisiones_refacciones/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_remisiones_refacciones_refacciones').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_remisiones_refacciones_refacciones').val()),
					 intProspectoID: $('#txtProspectoIDBusq_remisiones_refacciones_refacciones').val(),
					 strEstatus: $('#cmbEstatusBusq_remisiones_refacciones_refacciones').val(),
					 strBusqueda:    $('#txtBusqueda_remisiones_refacciones_refacciones').val(),
					 intPagina: intPaginaRemisionesRefaccionesRefacciones,
					 strPermisosAcceso: $('#txtAcciones_remisiones_refacciones_refacciones').val()
					},
					function(data){
						$('#dg_remisiones_refacciones_refacciones tbody').empty();
						var tmpRemisionesRefaccionesRefacciones = Mustache.render($('#plantilla_remisiones_refacciones_refacciones').html(),data);
						$('#dg_remisiones_refacciones_refacciones tbody').html(tmpRemisionesRefaccionesRefacciones);
						$('#pagLinks_remisiones_refacciones_refacciones').html(data.paginacion);
						$('#numElementos_remisiones_refacciones_refacciones').html(data.total_rows);
						intPaginaRemisionesRefaccionesRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_remisiones_refacciones_refacciones() 
		{
			//Asignar valores para la búsqueda de registros
			intProspectoIDRemisionesRefaccionesRefacciones =  $('#txtProspectoIDBusq_remisiones_refacciones_refacciones').val();
			dteFechaInicialRemisionesRefaccionesRefacciones =  $.formatFechaMysql($('#txtFechaInicialBusq_remisiones_refacciones_refacciones').val());
			dteFechaFinalRemisionesRefaccionesRefacciones =  $.formatFechaMysql($('#txtFechaFinalBusq_remisiones_refacciones_refacciones').val());

			//Si no existe fecha inicial
			if(dteFechaInicialRemisionesRefaccionesRefacciones == '')
			{
				dteFechaInicialRemisionesRefaccionesRefacciones = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalRemisionesRefaccionesRefacciones == '')
			{
				dteFechaFinalRemisionesRefaccionesRefacciones =  '0000-00-00';
			}
			
			//Si no existe id del prospecto
			if(intProspectoIDRemisionesRefaccionesRefacciones == '')
			{
				intProspectoIDRemisionesRefaccionesRefacciones = 0;
			}

			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_remisiones_refacciones_refacciones').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_remisiones_refacciones_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_remisiones_refacciones_refacciones').val('NO');
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("refacciones/remisiones_refacciones/get_reporte/"+dteFechaInicialRemisionesRefaccionesRefacciones+"/"+dteFechaFinalRemisionesRefaccionesRefacciones+"/"+intProspectoIDRemisionesRefaccionesRefacciones+"/"+
				$('#cmbEstatusBusq_remisiones_refacciones_refacciones').val()+"/"+
				$('#chbImprimirDetalles_remisiones_refacciones_refacciones').val()+"/"+
				$('#txtBusqueda_remisiones_refacciones_refacciones').val());
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_remisiones_refacciones_refacciones(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtRemisionRefaccionesID_remisiones_refacciones_refacciones').val();
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("refacciones/remisiones_refacciones/get_reporte_registro/"+intID);
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_remisiones_refacciones_refacciones() 
		{
			//Asignar valores para la búsqueda de registros
			intProspectoIDRemisionesRefaccionesRefacciones =  $('#txtProspectoIDBusq_remisiones_refacciones_refacciones').val();
			dteFechaInicialRemisionesRefaccionesRefacciones =  $.formatFechaMysql($('#txtFechaInicialBusq_remisiones_refacciones_refacciones').val());
			dteFechaFinalRemisionesRefaccionesRefacciones =  $.formatFechaMysql($('#txtFechaFinalBusq_remisiones_refacciones_refacciones').val());

			//Si no existe fecha inicial
			if(dteFechaInicialRemisionesRefaccionesRefacciones == '')
			{
				dteFechaInicialRemisionesRefaccionesRefacciones = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalRemisionesRefaccionesRefacciones == '')
			{
				dteFechaFinalRemisionesRefaccionesRefacciones =  '0000-00-00';
			}
			
			//Si no existe id del prospecto
			if(intProspectoIDRemisionesRefaccionesRefacciones == '')
			{
				intProspectoIDRemisionesRefaccionesRefacciones = 0;
			}

			//Si el checkbox incluir detalles se encuentra seleccionado (marcado)
			if ($('#chbImprimirDetalles_remisiones_refacciones_refacciones').is(':checked')) {
			    //Asignar SI para incluir detalles en el archivo
			    $('#chbImprimirDetalles_remisiones_refacciones_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el archivo
			   $('#chbImprimirDetalles_remisiones_refacciones_refacciones').val('NO');
			}

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("refacciones/remisiones_refacciones/get_xls/"+dteFechaInicialRemisionesRefaccionesRefacciones+"/"+dteFechaFinalRemisionesRefaccionesRefacciones+"/"+intProspectoIDRemisionesRefaccionesRefacciones+"/"+
				$('#cmbEstatusBusq_remisiones_refacciones_refacciones').val()+"/"+
				$('#chbImprimirDetalles_remisiones_refacciones_refacciones').val()+"/"+
				$('#txtBusqueda_remisiones_refacciones_refacciones').val());
		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_remisiones_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_remisiones_refacciones_refacciones').empty();
					var temp = Mustache.render($('#monedas_remisiones_refacciones_refacciones').html(), data);
					$('#cmbMonedaID_remisiones_refacciones_refacciones').html(temp);
				},
				'json');
		}

		
		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_cliente_remisiones_refacciones_refacciones()
		{
			//Incializar formulario
			$('#frmEnviarRemisionesRefaccionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_remisiones_refacciones_refacciones();
		    //Quitar clases del div para poder tomar el color correspondiente al estatus del registro
		    $('#divEncabezadoModal_cliente_remisiones_refacciones_refacciones').removeClass("estatus-ACTIVO");
		}

		//Función que se utiliza para abrir el modal
		function abrir_cliente_remisiones_refacciones_refacciones(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_cliente_remisiones_refacciones_refacciones();
			//Variables que se utilizan para asignar los datos del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtRemisionRefaccionesID_remisiones_refacciones_refacciones').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/remisiones_refacciones/get_datos',
			       {intRemisionRefaccionesID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtRemisionRefaccionesID_cliente_remisiones_refacciones_refacciones').val(data.row.remision_refacciones_id);
							$('#txtCliente_cliente_remisiones_refacciones_refacciones').val(data.row.cliente);
							$('#txtCorreoElectronico_cliente_remisiones_refacciones_refacciones').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_cliente_remisiones_refacciones_refacciones').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_cliente_remisiones_refacciones_refacciones').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarRemisionesRefaccionesRefacciones = $('#EnviarRemisionesRefaccionesRefaccionesBox').bPopup({
																   appendTo: '#RemisionesRefaccionesRefaccionesContent', 
										                           contentContainer: 'RemisionesRefaccionesRefaccionesM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_cliente_remisiones_refacciones_refacciones').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_cliente_remisiones_refacciones_refacciones()
		{
			try {
				//Cerrar modal
				objEnviarRemisionesRefaccionesRefacciones.close();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cliente_remisiones_refacciones_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cliente_remisiones_refacciones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarRemisionesRefaccionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_cliente_remisiones_refacciones_refacciones: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_cliente_remisiones_refacciones_refacciones: {
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
			var bootstrapValidator_cliente_remisiones_refacciones_refacciones = $('#frmEnviarRemisionesRefaccionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_cliente_remisiones_refacciones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cliente_remisiones_refacciones_refacciones.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_cliente_remisiones_refacciones_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cliente_remisiones_refacciones_refacciones()
		{
			try
			{
				$('#frmEnviarRemisionesRefaccionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al cliente
		function enviar_correo_cliente_remisiones_refacciones_refacciones()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_cliente_remisiones_refacciones_refacciones();
			//Hacer un llamado al método del controlador para enviar correo electrónico al cliente
			$.post('refacciones/remisiones_refacciones/enviar_correo_electronico_cliente',
					{ 
						intRemisionRefaccionesID: $('#txtRemisionRefaccionesID_cliente_remisiones_refacciones_refacciones').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_cliente_remisiones_refacciones_refacciones').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_cliente_remisiones_refacciones_refacciones').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cliente_remisiones_refacciones_refacciones();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_cliente_remisiones_refacciones_refacciones();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_remisiones_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_cliente_remisiones_refacciones_refacciones()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_remisiones_refacciones_refacciones").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_cliente_remisiones_refacciones_refacciones()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_cliente_remisiones_refacciones_refacciones").addClass('no-mostrar');
		}

		/*******************************************************************************************************************
		Funciones del modal Remisiones
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_remisiones_refacciones_refacciones(tipoAccion)
		{
			//Incializar formulario
			$('#frmRemisionesRefaccionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_remisiones_refacciones_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmRemisionesRefaccionesRefacciones').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_remisiones_refacciones_refacciones').val(fechaActual());
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_remisiones_refacciones_refacciones();
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_remisiones_refacciones_refacciones').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_remisiones_refacciones_refacciones').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_remisiones_refacciones_refacciones').removeClass("estatus-INACTIVO");
			//Si el tipo de acción corresponde a Nuevo
			if(tipoAccion == 'Nuevo')
			{
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_remisiones_refacciones_refacciones').addClass("estatus-NUEVO");
			}
			//Habilitar todos los elementos del formulario
			$('#frmRemisionesRefaccionesRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_remisiones_refacciones_refacciones').attr("disabled", "disabled");
			$('#txtPrecioUnitario_detalles_remisiones_refacciones_refacciones').attr('disabled','disabled');
			//Mostrar los siguientes botones
			$('#btnGuardar_remisiones_refacciones_refacciones').show();
			$('#btnReiniciar_remisiones_refacciones_refacciones').show();
			//Habilitar botón Agregar
			$('#btnAgregar_remisiones_refacciones_refacciones ').removeAttr('disabled');
			//Ocultar los siguientes botones
			$('#btnEnviarCorreo_remisiones_refacciones_refacciones').hide();
			$('#btnImprimirRegistro_remisiones_refacciones_refacciones').hide();
			$('#btnDesactivar_remisiones_refacciones_refacciones').hide();
		}
		
		//Función para deshabilitar controles del formulario y así evitar modificar datos correspondientes a la referencia
		function deshabilitar_controles_remisiones_refacciones_refacciones()
		{
			//Deshabilitar los siguientes controles
			$('#cmbMonedaID_remisiones_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtCliente_remisiones_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtVendedor_remisiones_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtEstrategia_remisiones_refacciones_refacciones').attr('disabled','disabled');
		    $('#cmbTipo_remisiones_refacciones_refacciones').attr('disabled','disabled');
		    $('#btnAgregar_remisiones_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtReferencia_detalles_remisiones_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtCantidad_detalles_remisiones_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').attr('disabled','disabled');
		}

		//Función para inicializar elementos de la referencia (cotización/pedido)
		function inicializar_referencia_remisiones_refacciones_refacciones(tipoAccion)
		{
			//Dependiendo del tipo de referencia limpiar el contenido de la caja de texto
			if(tipoAccion == 'cotizacion')
			{
				//Limpiar contenido de la caja de texto
				$('#txtPedidoRefacciones_remisiones_refacciones_refacciones').val('');
			}
			else
			{
				//Limpiar contenido de la caja de texto
				$('#txtCotizacionRefacciones_remisiones_refacciones_refacciones').val('');
			}
			
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtReferenciaID_remisiones_refacciones_refacciones').val('');
	        $('#txtTipoReferencia_remisiones_refacciones_refacciones').val('');
            $('#txtProspectoID_remisiones_refacciones_refacciones').val('');
            $('#txtCliente_remisiones_refacciones_refacciones').val('');
            $('#txtRefaccionesListaPrecioID_remisiones_refacciones_refacciones').val('');
            $('#txtVendedorID_remisiones_refacciones_refacciones').val('');
            $('#txtVendedor_remisiones_refacciones_refacciones').val('');            
            $('#txtEstrategiaID_remisiones_refacciones_refacciones').val('');
            $('#txtEstrategia_remisiones_refacciones_refacciones').val('');
            $('#cmbTipo_remisiones_refacciones_refacciones').val('MENUDEO');
            $('#cmbMonedaID_remisiones_refacciones_refacciones').val('');
			$('#txtTipoCambio_remisiones_refacciones_refacciones').val('');
			$('#txtObservaciones_remisiones_refacciones_refacciones').val('');
			$('#txtNotas_remisiones_refacciones_refacciones').val('');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_remisiones_refacciones_refacciones();
            //Habilitar los siguientes controles
		    $('#cmbMonedaID_remisiones_refacciones_refacciones').removeAttr('disabled');
		    $('#txtCliente_remisiones_refacciones_refacciones').removeAttr('disabled');
		    $('#txtVendedor_remisiones_refacciones_refacciones').removeAttr('disabled');
		    $('#txtEstrategia_remisiones_refacciones_refacciones').removeAttr('disabled');
		    $('#cmbTipo_remisiones_refacciones_refacciones').removeAttr('disabled');
		    $('#btnAgregar_remisiones_refacciones_refacciones').removeAttr('disabled');
		    $('#txtReferencia_detalles_remisiones_refacciones_refacciones').removeAttr('disabled');
		    $('#txtCantidad_detalles_remisiones_refacciones_refacciones').removeAttr('disabled');
		    $('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').removeAttr('disabled');
		    $('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').removeAttr('disabled');
		    $('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').removeAttr('disabled');
		}

		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_remisiones_refacciones_refacciones()
		{
			//Eliminar los datos de la tabla detalles del pedido
		    $('#dg_detalles_remisiones_refacciones_refacciones tbody').empty();
		    $('#acumCantidad_detalles_remisiones_refacciones_refacciones').html('0.00');
		    $('#acumDescuento_detalles_remisiones_refacciones_refacciones').html('$0.00');
		    $('#acumSubtotal_detalles_remisiones_refacciones_refacciones').html('$0.00');
		    $('#acumIva_detalles_remisiones_refacciones_refacciones').html('$0.000000');
		    $('#acumIeps_detalles_remisiones_refacciones_refacciones').html('$0.000000');
		    $('#acumTotal_detalles_remisiones_refacciones_refacciones').html('$0.000000');
			$('#numElementos_detalles_remisiones_refacciones_refacciones').html(0);
			$('#txtNumDetalles_remisiones_refacciones_refacciones').val('');
		}


		//Función que se utiliza para cerrar el modal
		function cerrar_remisiones_refacciones_refacciones()
		{
			try {
				//Cerrar modal
				objRemisionesRefaccionesRefacciones.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_remisiones_refacciones_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_remisiones_refacciones_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_remisiones_refacciones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmRemisionesRefaccionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_remisiones_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intMonedaID_remisiones_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_remisiones_refacciones_refacciones: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_remisiones_refacciones_refacciones').val()) !== intMonedaBaseIDRemisionesRefaccionesRefacciones)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoRemisionesRefaccionesRefacciones)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoRemisionesRefaccionesRefacciones
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strCotizacionRefacciones_remisiones_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cotización
					                                    if(value !== '' && $('#txtReferenciaID_remisiones_refacciones_refacciones').val() === '')
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
										strPedidoRefacciones_remisiones_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del pedido
					                                    if(value !== '' && $('#txtReferenciaID_remisiones_refacciones_refacciones').val() === '')
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
									    strTipo_remisiones_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										},
										strCliente_remisiones_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del cliente
					                                    if($('#txtProspectoID_remisiones_refacciones_refacciones').val() === '')
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
										strVendedor_remisiones_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vendedor
					                                    if($('#txtVendedorID_remisiones_refacciones_refacciones').val() === '')
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
										strEstrategia_remisiones_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la estrategia
					                                    if($('#txtEstrategiaID_remisiones_refacciones_refacciones').val() === '')
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
										intNumDetalles_remisiones_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta remisión.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strReferencia_detalles_remisiones_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_detalles_remisiones_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_detalles_remisiones_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_detalles_remisiones_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_detalles_remisiones_refacciones_refacciones: {
											excluded: true  //Ignorar (no valida el campo)
										},
										intPorcentajeIeps_detalles_remisiones_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_remisiones_refacciones_refacciones = $('#frmRemisionesRefaccionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_remisiones_refacciones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_remisiones_refacciones_refacciones.isValid())
			{
				//Hacer un llamado a la función para validar que los detalles cuenten con precio unitario y la cantidad no exceda la existencia disponible
				validar_detalles_remisiones_refacciones_refacciones();
			}
			else 
				return;
		}

		//Función que se utiliza para validar que los detalles cuenten con precio unitario y la cantidad no sea mayor que la existencia disponible
		function validar_detalles_remisiones_refacciones_refacciones()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_remisiones_refacciones_refacciones').getElementsByTagName('tbody')[0];

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
				if(intCantidad > intDisponibleExistencia || intPrecioUnitario == 0)
				{
					//Agregar refacción en el array, de esta manera, el usuario identificara las refacciones incorrectas
					arrDetallesIncorrectos.push(strReferencia);
				}
			}

			//Si existen refacciones incorrectas
			if(arrDetallesIncorrectos.length > 0)
			{
				//Mensaje que se utiliza para informar al usuario la lista de refacciones incorrectas
				var strMensaje = 'La remisión no puede guardarse. Las siguientes <b>refacciones</b> no tienen precio unitario (0.00) o  la cantidad es mayor que la cantidad del inventario:<br>';

				//Hacer recorrido para obtener refacciones incorrectas
				for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
				{
					//Agregar refacción en el mensaje
            		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
				}

				//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_remisiones_refacciones_refacciones('error', strMensaje);
			}
			else
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_remisiones_refacciones_refacciones();
			}

		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_remisiones_refacciones_refacciones()
		{
			try
			{
				$('#frmRemisionesRefaccionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_remisiones_refacciones_refacciones()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_remisiones_refacciones_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRefaccionID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCantidades = [];
			var arrCostosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrIvasUnitarios = [];
			var arrIepsUnitarios = [];
			var arrPreciosUnitarios = [];
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioRemision = parseFloat($('#txtTipoCambio_remisiones_refacciones_refacciones').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intPrecioUnitario = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[4].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[6].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[7].innerHTML, ",", "");
				intIvaUnitario =  intIvaUnitario / intCantidad;
				intIepsUnitario = intIepsUnitario / intCantidad;

				//Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioRemision;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioRemision;
				intIvaUnitario = intIvaUnitario * intTipoCambioRemision;
				intIepsUnitario = intIepsUnitario * intTipoCambioRemision;

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
				arrCantidades.push(intCantidad);
				arrCostosUnitarios.push(objRen.cells[16].innerHTML);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrIvasUnitarios.push(intIvaUnitario);
				arrIepsUnitarios.push(intIepsUnitario );
				arrPreciosUnitarios.push(intPrecioUnitario);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/remisiones_refacciones/guardar',
					{ 
						//Datos de la remisión
						intRemisionRefaccionesID: $('#txtRemisionRefaccionesID_remisiones_refacciones_refacciones').val(),
						strTipoReferencia: $('#txtTipoReferencia_remisiones_refacciones_refacciones').val(),
						intReferenciaID: $('#txtReferenciaID_remisiones_refacciones_refacciones').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_remisiones_refacciones_refacciones').val()),
						intMonedaID: $('#cmbMonedaID_remisiones_refacciones_refacciones').val(),
						intTipoCambio: intTipoCambioRemision,
						intProspectoID: $('#txtProspectoID_remisiones_refacciones_refacciones').val(),
						intVendedorID: $('#txtVendedorID_remisiones_refacciones_refacciones').val(),						
						intEstrategiaID: $('#txtEstrategiaID_remisiones_refacciones_refacciones').val(),
						strTipo: $('#cmbTipo_remisiones_refacciones_refacciones').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
					    intAnticipo: $.reemplazar($('#txtAnticipo_remisiones_refacciones_refacciones').val(), ",", ""),
						strObservaciones: $('#txtObservaciones_remisiones_refacciones_refacciones').val(),
						strNotas: $('#txtNotas_remisiones_refacciones_refacciones').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_remisiones_refacciones_refacciones').val(),
						//Datos de los detalles
						strRefaccionID: arrRefaccionID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strCantidades: arrCantidades.join('|'),
						strCostosUnitarios: arrCostosUnitarios.join('|'),
						strDescuentosUnitarios: arrDescuentosUnitarios.join('|'),
						strIvasUnitarios: arrIvasUnitarios.join('|'),
						strIepsUnitarios: arrIepsUnitarios.join('|'),
						strPreciosUnitarios: arrPreciosUnitarios.join('|')
					},
					function(data) {
						if (data.resultado)
						{
         					//Hacer un llamado a la función para cerrar modal
	                    	cerrar_remisiones_refacciones_refacciones();

							//Hacer llamado a la función  para cargar  los registros en el grid
	               			paginacion_remisiones_refacciones_refacciones(); 
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_remisiones_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_remisiones_refacciones_refacciones(tipoMensaje, mensaje)
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
	                                                $('#txtCantidad_detalles_remisiones_refacciones_refacciones').focus();
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
		function cambiar_estatus_remisiones_refacciones_refacciones(id)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtRemisionRefaccionesID_remisiones_refacciones_refacciones').val();

			}
			else
			{
				intID = id;
			}

			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
					             {'type':     'question',
					              'title':    'Remisiones',
					              'buttons':  ['Aceptar', 'Cancelar'],
					              'onClose':  function(caption) {
					                            if(caption == 'Aceptar')
					                            {
					                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
					                              $.post('refacciones/remisiones_refacciones/set_estatus',
					                                     {intRemisionRefaccionesID: intID
					                                     },
					                                     function(data) {
					                                        if(data.resultado)
					                                        {
					                                          	//Hacer llamado a la función  para cargar  los registros en el grid
					                                          	paginacion_remisiones_refacciones_refacciones();

					                                          	//Si el id del registro se obtuvo del modal
																if(id == '')
																{
																	//Hacer un llamado a la función para cerrar modal
																	cerrar_remisiones_refacciones_refacciones();     
																}
					                                        }
					                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					                                        mensaje_remisiones_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
					                                     },
					                                    'json');
					                            }
					                          }
					              });
		    
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_remisiones_refacciones_refacciones(id)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/remisiones_refacciones/get_datos',
			       {intRemisionRefaccionesID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_remisiones_refacciones_refacciones('');
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				             //Variable que se utiliza para recuperar los detalles del registro
						    var strTipoDetalles = 'remision';

				          	//Recuperar valores
				          	$('#txtRemisionRefaccionesID_remisiones_refacciones_refacciones').val(data.row.remision_refacciones_id);
				            $('#txtTipoReferencia_remisiones_refacciones_refacciones').val(data.row.tipo_referencia);
				            $('#txtReferenciaID_remisiones_refacciones_refacciones').val(data.row.referencia_id);
				            $('#txtCotizacionRefacciones_remisiones_refacciones_refacciones').val(data.row.folio_cotizacion);
				            $('#txtPedidoRefacciones_remisiones_refacciones_refacciones').val(data.row.folio_pedido);
				            $('#txtFolio_remisiones_refacciones_refacciones').val(data.row.folio);
				            $('#txtFecha_remisiones_refacciones_refacciones').val(data.row.fecha);
				            $('#cmbMonedaID_remisiones_refacciones_refacciones').val(data.row.moneda_id);
				            $('#txtTipoCambio_remisiones_refacciones_refacciones').val(data.row.tipo_cambio);
				            $('#txtProspectoID_remisiones_refacciones_refacciones').val(data.row.prospecto_id);
						    $('#txtCliente_remisiones_refacciones_refacciones').val(data.row.cliente);
						    $('#txtRefaccionesListaPrecioID_remisiones_refacciones_refacciones').val(data.row.refacciones_lista_precio_id);
						    $('#txtVendedorID_remisiones_refacciones_refacciones').val(data.row.vendedor_id);
						    $('#txtVendedor_remisiones_refacciones_refacciones').val(data.row.vendedor);						    
						    $('#txtEstrategiaID_remisiones_refacciones_refacciones').val(data.row.estrategia_id);
						    $('#txtEstrategia_remisiones_refacciones_refacciones').val(data.row.estrategia);
						    $('#cmbTipo_remisiones_refacciones_refacciones').val(data.row.tipo);
						    $('#txtAnticipo_remisiones_refacciones_refacciones').val(data.row.anticipo);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtAnticipo_remisiones_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
						    $('#txtObservaciones_remisiones_refacciones_refacciones').val(data.row.observaciones);
						    $('#txtNotas_remisiones_refacciones_refacciones').val(data.row.notas);

						    //Si existe id de la referencia
						    if(data.row.referencia_id > 0)
						    {
						    	//Cambiar el tipo de detalles para identificar que los detalles corresponde a una referencia (cotización/pedido) y así evitar realizar modificaciones
						    	strTipoDetalles = 'referencia';
						    	//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes a la referencia
								deshabilitar_controles_remisiones_refacciones_refacciones();
						    }

						    //Hacer un llamado a la función para cargar los detalles del registro en la tabla
				            cargar_detalles_tabla_remisiones_refacciones_refacciones(data.row.tipo_cambio, data.detalles, strTipoDetalles, 'Editar');

							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_remisiones_refacciones_refacciones').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $('#btnImprimirRegistro_remisiones_refacciones_refacciones').show();
				      
				            //Si el estatus del registro es INACTIVO
				            if(strEstatus == 'INACTIVO')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmRemisionesRefaccionesRefacciones').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $('#btnGuardar_remisiones_refacciones_refacciones').hide();
					            $('#btnReiniciar_remisiones_refacciones_refacciones').hide();
				            	
				            }
				            else
				            {
				            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDRemisionesRefaccionesRefacciones)
							    {
									//Habilitar caja de texto
									$('#txtTipoCambio_remisiones_refacciones_refacciones').removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar las siguientes cajas de texto
									$("#txtTipoCambio_remisiones_refacciones_refacciones").attr('disabled','disabled');
							    }

				            	//Mostrar los siguientes botones  
				            	$('#btnDesactivar_remisiones_refacciones_refacciones').show();
				            	$('#btnEnviarCorreo_remisiones_refacciones_refacciones').show();
				            }

			            	//Abrir modal
				            objRemisionesRefaccionesRefacciones = $('#RemisionesRefaccionesRefaccionesBox').bPopup({
														  appendTo: '#RemisionesRefaccionesRefaccionesContent', 
							                              contentContainer: 'RemisionesRefaccionesRefaccionesM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#cmbMonedaID_remisiones_refacciones_refacciones').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_remisiones_refacciones_refacciones()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_remisiones_refacciones_refacciones').val()) !== intMonedaBaseIDRemisionesRefaccionesRefacciones)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_remisiones_refacciones_refacciones").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_remisiones_refacciones_refacciones').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_remisiones_refacciones_refacciones').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_remisiones_refacciones_refacciones").val(data.row.tipo_cambio_sat);
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_detalles_remisiones_refacciones_refacciones()
		{
			//Limpiamos las cajas de texto
			$('#txtReferenciaID_detalles_remisiones_refacciones_refacciones ').val('');
			$('#txtReferencia_detalles_remisiones_refacciones_refacciones ').val('');
			$('#txtTipoReferencia_detalles_remisiones_refacciones_refacciones ').val('');
			$('#txtCodigo_detalles_remisiones_refacciones_refacciones ').val('');
			$('#txtDescripcion_detalles_remisiones_refacciones_refacciones ').val('');
			$('#txtCantidad_detalles_remisiones_refacciones_refacciones ').val('');
		    $('#txtPrecioUnitario_detalles_remisiones_refacciones_refacciones ').val('');
		    $('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones ').val('');
		    $('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones ').val('');
		    $('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones ').val('');
		    $('#txtTipoCambio_detalles_remisiones_refacciones_refacciones ').val('');
		    $('#txtPrecioRefaccion_detalles_remisiones_refacciones_refacciones ').val('');
		}

		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_remisiones_refacciones_refacciones (tipoReferencia)
		{
	   		//Si el tipo de referencia corresponde a una refacción
			if(tipoReferencia == 'REFACCION')
			{
	   			$('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').removeAttr('disabled');
	   			$('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').removeAttr('disabled');
	   			
			}
			else
			{
				$('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').attr('disabled','disabled');
				$('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').attr('disabled','disabled');
			}

			//Habilitar las siguientes cajas de texto
		    $('#txtCantidad_detalles_remisiones_refacciones_refacciones').removeAttr('disabled');
		    //Limpiar las siguientes cajas de texto
		    $('#txtTipoReferencia_detalles_remisiones_refacciones_refacciones').val('');
            $('#txtCodigo_detalles_remisiones_refacciones_refacciones').val('');
            $('#txtDescripcion_detalles_remisiones_refacciones_refacciones').val('');
            $('#txtPrecioUnitario_detalles_remisiones_refacciones_refacciones').val('');
            $('#txtPrecioRefaccion_detalles_remisiones_refacciones_refacciones').val('');
            $('#txtTipoCambioRefaccion_detalles_remisiones_refacciones_refacciones').val('');
            $('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').val('');
            $('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').val('');
            $('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').val('');
            $('#txtActualCosto_detalles_remisiones_refacciones_refacciones').val('');
            $('#txtDisponibleExistencia_detalles_remisiones_refacciones_refacciones').val('');
	        $('#txtCantidad_detalles_remisiones_refacciones_refacciones').val('');
		}


		//Función para cargar los detalles de la cotización o del pedido en la tabla 
		function cargar_detalles_tabla_remisiones_refacciones_refacciones(tipoCambio, arrDetalles, tipoRegistro, tipoAccion)
		{
			//Variable que se utiliza para asignar el tipo de cambio
            var intTipoCambio = parseFloat(tipoCambio);

            //Variable que se utiliza para asignar las acciones del grid view
            var strAccionesTablaDetalles = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_detalles_remisiones_refacciones_refacciones(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>" + 
											 "<button class='btn btn-default btn-xs' title='Eliminar'" +
											 " onclick='eliminar_renglon_detalles_remisiones_refacciones_refacciones(this)'>" + 
											 "<span class='glyphicon glyphicon-trash'></span></button>" + 
											 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
											 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
											 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
											 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

			


            //Si los detalles corresponden a una referencia (cotización/pedido)
            if(tipoRegistro == 'referencia')
            {
            	//Limpiar acciones del grid view
				strAccionesTablaDetalles = '';
            }

           	//Mostramos los detalles del registro
           	for (var intCon in arrDetalles) 
            {
            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_detalles_remisiones_refacciones_refacciones').getElementsByTagName('tbody')[0];

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

				//Variables que se utilizan para asignar valores del detalle
				var intSubtotal = parseFloat(arrDetalles[intCon].precio_unitario);
				var intCantidad =  parseFloat(arrDetalles[intCon].cantidad);
				var intPrecioUnitario = parseFloat(arrDetalles[intCon].precio_unitario);
				var intDescuentoUnitario = parseFloat(arrDetalles[intCon].descuento_unitario);
				var intIvaUnitario = parseFloat(arrDetalles[intCon].iva_unitario);
				var intIepsUnitario = parseFloat(arrDetalles[intCon].ieps_unitario);
				var intDisponibleExistencia = parseFloat(arrDetalles[intCon].disponible_existencia);
				var intImporteIva = 0;
				var intImporteIeps = 0;
				var intPorcentajeDescuento = 0;
				var intPorcentajeIva = 0;
				var intPorcentajeIeps = 0;
				var intTotal = 0;
				//Variable que se utiliza para asignar  el color de fondo del registro
				var strEstiloRegistro = '';

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

				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{
					intPrecioUnitario = intPrecioUnitario + intDescuentoUnitario;
					//Calcular porcentaje del descuento
					intPorcentajeDescuento = (intDescuentoUnitario / intPrecioUnitario) * 100;
				}
				
				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;

				//Si existe importe de IVA unitario
				if(intIvaUnitario > 0)
				{
					//Calcular importe de IVA
					intImporteIva =  intIvaUnitario * intCantidad;
					//Calcular porcentaje del IVA
					intPorcentajeIva = (intImporteIva / intSubtotal) * 100;
				}

				//Si existe importe de IEPS unitario
				if(intIepsUnitario > 0)
				{
					//Calcular importe de IEPS
					intImporteIeps =  intIepsUnitario * intCantidad;
					//Calcular porcentaje del IEPS
					intPorcentajeIeps = (intImporteIeps / intSubtotal) * 100;
				}


				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', arrDetalles[intCon].refaccion_id);
				objCeldaCodigo.setAttribute('class', 'movil b1 '+strEstiloRegistro);
				objCeldaCodigo.innerHTML = arrDetalles[intCon].codigo;
				objCeldaDescripcion.setAttribute('class', 'movil b2 '+strEstiloRegistro);
				objCeldaDescripcion.innerHTML = arrDetalles[intCon].descripcion;
				objCeldaCantidad.setAttribute('class', 'movil b3 '+strEstiloRegistro);
				objCeldaCantidad.innerHTML = formatMoney(intCantidad, 2, '');
				objCeldaPrecioUnitario.setAttribute('class', 'movil b4 '+strEstiloRegistro);
				objCeldaPrecioUnitario.innerHTML = formatMoney(intPrecioUnitario, 2, '');
				objCeldaDescuentoUnitario.setAttribute('class', 'movil b5 '+strEstiloRegistro);
				objCeldaDescuentoUnitario.innerHTML = formatMoney(intDescuentoUnitario, 2, '');
				objCeldaSubtotal.setAttribute('class', 'movil b6 '+strEstiloRegistro);
				objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 2, '');
				objCeldaIvaUnitario.setAttribute('class', 'movil b7 '+strEstiloRegistro);
				objCeldaIvaUnitario.innerHTML = formatMoney(intImporteIva, 6, '');
				objCeldaIepsUnitario.setAttribute('class', 'movil b8 '+strEstiloRegistro);
				objCeldaIepsUnitario.innerHTML = formatMoney(intImporteIeps, 6, '');
				objCeldaTotal.setAttribute('class', 'movil b9 '+strEstiloRegistro);
				objCeldaTotal.innerHTML = formatMoney(intTotal, 6, '');
				objCeldaAcciones.setAttribute('class', 'td-center movil b10 '+strEstiloRegistro);
				objCeldaAcciones.innerHTML =strAccionesTablaDetalles;
				objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
				objCeldaPorcentajeDescuento.innerHTML = formatMoney(intPorcentajeDescuento, 2, '');
				objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
				objCeldaPorcentajeIva.innerHTML = formatMoney(intPorcentajeIva, 2, '');
				objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
				objCeldaPorcentajeIeps.innerHTML = formatMoney(intPorcentajeIeps, 2, '');
				objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
				objCeldaTipoReferencia.innerHTML = 'REFACCION';
				objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
				objCeldaTipoCambio.innerHTML = intTipoCambio;
				objCeldaPrecioRefaccion.setAttribute('class', 'no-mostrar');
				objCeldaPrecioRefaccion.innerHTML = intPrecioUnitario;
                objCeldaCostoActual.setAttribute('class', 'no-mostrar');
				objCeldaCostoActual.innerHTML = arrDetalles[intCon].actual_costo;
				objCeldaDisponibleExistencia.setAttribute('class', 'no-mostrar');
                objCeldaDisponibleExistencia.innerHTML = intDisponibleExistencia;
            }

            //Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_remisiones_refacciones_refacciones();
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $('#dg_detalles_remisiones_refacciones_refacciones tr').length - 2;
			$('#numElementos_detalles_remisiones_refacciones_refacciones').html(intFilas);
			$('#txtNumDetalles_remisiones_refacciones_refacciones').val(intFilas);
		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_remisiones_refacciones_refacciones()
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
			var intReferenciaID = $('#txtReferenciaID_detalles_remisiones_refacciones_refacciones').val();
			var strReferencia = $('#txtReferencia_detalles_remisiones_refacciones_refacciones').val();
			var strTipoReferencia = $('#txtTipoReferencia_detalles_remisiones_refacciones_refacciones').val();
			var strCodigo = $('#txtCodigo_detalles_remisiones_refacciones_refacciones').val();
			var strDescripcion = $('#txtDescripcion_detalles_remisiones_refacciones_refacciones').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_remisiones_refacciones_refacciones').val();
			var intCantidad = $('#txtCantidad_detalles_remisiones_refacciones_refacciones').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').val();
			var intTipoCambio = $('#txtTipoCambio_detalles_remisiones_refacciones_refacciones').val();
			var intPrecioRefaccion = $('#txtPrecioRefaccion_detalles_remisiones_refacciones_refacciones').val();
			var intActualCosto = $('#txtActualCosto_detalles_remisiones_refacciones_refacciones').val();
			var intDisponibleExistencia = $('#txtDisponibleExistencia_detalles_remisiones_refacciones_refacciones').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_remisiones_refacciones_refacciones').getElementsByTagName('tbody')[0];

			//Dependiendo del tipo de referencia validar los campos obligatorios
			if($('#txtTipoReferencia_detalles_remisiones_refacciones_refacciones').val() == 'REFACCION')
			{
				//Validamos que se capturaron datos
				if (intReferenciaID == '' || strReferencia == '')
				{
					//Enfocar caja de texto
					$('#txtReferencia_detalles_remisiones_refacciones_refacciones').focus();
				}
				else if (intCantidad == '')
				{
					//Enfocar caja de texto
					$('#txtCantidad_detalles_remisiones_refacciones_refacciones').focus();
				}
				else if (intPorcentajeDescuento == '')
				{
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').focus();
				}
				else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
				{
					//Limpiar caja de texto
					$('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').val('');
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').focus();
				}
				else if (intPorcentajeIva == '')
				{
					//Enfocar caja de texto
					$('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').focus();
				}
				else if (parseFloat($.reemplazar(intPorcentajeIva, ",", "")) > 100)
				{
					//Limpiar caja de texto
					$('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').val('');
					//Enfocar caja de texto
					$('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').focus();
				}
				else if (intPorcentajeIeps == '')
				{
					//Enfocar caja de texto
					$('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').focus();
				}
				else if (parseFloat($.reemplazar(intPorcentajeIeps, ",", "")) > 100)
				{
					//Limpiar caja de texto
					$('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').val('');
					//Enfocar caja de texto
					$('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').focus();
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
					$('#txtReferencia_detalles_remisiones_refacciones_refacciones').focus();
				}
				else if (intPorcentajeDescuento == '')
				{
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').focus();
				}
				else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
				{
					//Limpiar caja de texto
					$('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').val('');
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').focus();
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
				
			    //Si el tipo de referencia no corresponde a una refacción
				if(strTipoReferencia != 'REFACCION')
				{
					//Hacer un llamado a la función para limpiar los campos del formulario
					nuevo_detalles_remisiones_refacciones_refacciones();
					//Hacer un llamado a la función para obtener las refacciones de la referencia
					lista_refacciones_referencia_detalles_remisiones_refacciones_refacciones (intPorcentajeDescuento, intReferenciaID, strTipoReferencia, intCantidad);
				}
				else
				{
					//Convertir cadena de texto a número decimal
					intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
					intSubtotal =  parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
					intDisponibleExistencia = parseFloat(intDisponibleExistencia);

					//Verificar que la cantidad sea menor o igual que la existencia disponible 
	                if(intCantidad <= intDisponibleExistencia)
	                {
	                	//Hacer un llamado a la función para limpiar los campos del formulario
						nuevo_detalles_remisiones_refacciones_refacciones();

						//Si existe porcentaje de descuento
						if(intPorcentajeDescuento > 0)
						{
							intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;
							intSubtotal = intSubtotal - intDescuentoUnitario;
						}
						
						//Calcular subtotal
						intSubtotal = intCantidad * intSubtotal;

						//Si existe porcentaje de IVA
						if(intPorcentajeIva > 0)
						{
							//Calcular importe de IVA
							intImporteIva = parseFloat(intSubtotal * intPorcentajeIva) / 100;
						}
						

						//Si existe porcentaje de IEPS
						if(intPorcentajeIeps > 0)
						{
							//Calcular importe de IEPS
							intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps) / 100;
						}
						

						//Calcular importe total
						intTotal = intSubtotal + intImporteIva + intImporteIeps;

						//Revisamos si existe el ID proporcionado, si es así, editamos los datos
						if (objTabla.rows.namedItem(intReferenciaID))
						{
							objTabla.rows.namedItem(intReferenciaID).cells[2].innerHTML = formatMoney(intCantidad, 2, '');
							objTabla.rows.namedItem(intReferenciaID).cells[3].innerHTML = intPrecioUnitario;
							objTabla.rows.namedItem(intReferenciaID).cells[4].innerHTML =  formatMoney(intDescuentoUnitario, 2, '');
							objTabla.rows.namedItem(intReferenciaID).cells[5].innerHTML =  formatMoney(intSubtotal, 2, '');
							objTabla.rows.namedItem(intReferenciaID).cells[6].innerHTML = formatMoney(intImporteIva, 6, '');
							objTabla.rows.namedItem(intReferenciaID).cells[7].innerHTML = formatMoney(intImporteIeps, 6, '');
							objTabla.rows.namedItem(intReferenciaID).cells[8].innerHTML = formatMoney(intTotal, 6, '');
							objTabla.rows.namedItem(intReferenciaID).cells[10].innerHTML = formatMoney(intPorcentajeDescuento, 2, '');
							objTabla.rows.namedItem(intReferenciaID).cells[11].innerHTML = formatMoney(intPorcentajeIva, 2, '');
							objTabla.rows.namedItem(intReferenciaID).cells[12].innerHTML = formatMoney(intPorcentajeIeps, 2, '');
							objTabla.rows.namedItem(intReferenciaID).cells[15].innerHTML = intPrecioRefaccion;
							objTabla.rows.namedItem(intReferenciaID).cells[16].innerHTML = intActualCosto;
							objTabla.rows.namedItem(intReferenciaID).cells[17].innerHTML = intDisponibleExistencia;
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

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', intReferenciaID);
							objCeldaCodigo.setAttribute('class', 'movil b1');
							objCeldaCodigo.innerHTML = strCodigo;
							objCeldaDescripcion.setAttribute('class', 'movil b2');
							objCeldaDescripcion.innerHTML = strDescripcion;
							objCeldaCantidad.setAttribute('class', 'movil b3');
							objCeldaCantidad.innerHTML = formatMoney(intCantidad, 2, '');
							objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
							objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
							objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
							objCeldaDescuentoUnitario.innerHTML = formatMoney(intDescuentoUnitario, 2, '');
							objCeldaSubtotal.setAttribute('class', 'movil b6');
							objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 2, '');
							objCeldaIvaUnitario.setAttribute('class', 'movil b7');
							objCeldaIvaUnitario.innerHTML = formatMoney(intImporteIva, 6, '');
							objCeldaIepsUnitario.setAttribute('class', 'movil b8');
							objCeldaIepsUnitario.innerHTML = formatMoney(intImporteIeps, 6, '');
							objCeldaTotal.setAttribute('class', 'movil b9');
							objCeldaTotal.innerHTML = formatMoney(intTotal, 6, '');
							objCeldaAcciones.setAttribute('class', 'td-center movil b10');
							objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
														 " onclick='editar_renglon_detalles_remisiones_refacciones_refacciones(this)'>" + 
														 "<span class='glyphicon glyphicon-edit'></span></button>" + 
														 "<button class='btn btn-default btn-xs' title='Eliminar'" +
														 " onclick='eliminar_renglon_detalles_remisiones_refacciones_refacciones(this)'>" + 
														 "<span class='glyphicon glyphicon-trash'></span></button>" + 
														 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
														 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
														 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
														 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
							objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
							objCeldaPorcentajeDescuento.innerHTML = formatMoney(intPorcentajeDescuento, 2, ''); 
							objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
							objCeldaPorcentajeIva.innerHTML = formatMoney(intPorcentajeIva, 2, ''); 
							objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
							objCeldaPorcentajeIeps.innerHTML = formatMoney(intPorcentajeIeps, 2, '');
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

						}
				    }
				    else
	                {
	                    //Cambiar cantidad a formato moneda
	                    intDisponibleExistencia = formatMoney(intDisponibleExistencia, 2, '');

	                    //Asignar existencia disponible 
	                    $('#txtCantidad_detalles_remisiones_refacciones_refacciones').val(intDisponibleExistencia);

	                    //Hacer un llamado a la función para mostrar mensaje de información
	                    mensaje_remisiones_refacciones_refacciones('informacion', 'La cantidad no debe exceder de ' + intDisponibleExistencia);
	                }
				}
				
				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_remisiones_refacciones_refacciones();
				//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
				var intFilas = $('#dg_detalles_remisiones_refacciones_refacciones tr').length - 2;
				$('#numElementos_detalles_remisiones_refacciones_refacciones').html(intFilas);
				$('#txtNumDetalles_remisiones_refacciones_refacciones').val(intFilas);
				
				//Enfocar caja de texto
				$('#txtReferencia_detalles_remisiones_refacciones_refacciones').focus();
			}

		
		}

		//Función para la búsqueda de refacciones de la referencia
		function lista_refacciones_referencia_detalles_remisiones_refacciones_refacciones(porcentajeDescuentoProm, referenciaID, tipoReferencia, cantidad) 
		{
			//Variable que se utiliza para asignar el tipo de cambio de la requisición
			var intTipoCambioRemision = parseFloat($('#txtTipoCambio_remisiones_refacciones_refacciones').val());
			//Variable que se utiliza para asignar el tipo de cambio de la refacción
			var intMonedaIDCotizacion =  parseFloat($('#cmbMonedaID_remisiones_refacciones_refacciones').val());
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_remisiones_refacciones_refacciones').getElementsByTagName('tbody')[0];
		
			//Variable que se utiliza para asignar las acciones del grid view
            var strAccionesTablaDetalles = '';

			//Si el tipo de referencia no corresponde a un Kit de refacciones
            if(tipoReferencia != 'KIT')
            {
            	//Agregar acción de Editar
				strAccionesTablaDetalles = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_detalles_remisiones_refacciones_refacciones(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>";					 
            }

            //Variable que se utiliza para asignar las acciones del grid view
            strAccionesTablaDetalles +=  "<button class='btn btn-default btn-xs' title='Eliminar'" +
									     " onclick='eliminar_renglon_detalles_remisiones_refacciones_refacciones(this)'>" + 
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
			       	intRefaccionesListaPrecioID: $('#txtRefaccionesListaPrecioID_remisiones_refacciones_refacciones').val(),
			       	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día 
				   	dteFechaTipoCambio: $.formatFechaMysql($('#txtFecha_remisiones_refacciones_refacciones').val())
			       },
			       function(data) {

			       	 	//Mostramos las refacciones del registro
			            for (var intCon in data.row) 
			            {
				       		//Variables que se utilizan para asignar valores del detalle
							var intSubtotal = 0;
							var intPrecioUnitario = 0;
							var intCantidad = 0;
							var intRefaccionID =  data.row[intCon].refaccion_id;
							var intPrecioRefaccion = parseFloat(data.row[intCon].precio);
							var intDisponibleExistencia = parseFloat(data.row[intCon].disponible_existencia);
							var intPorcentajeIva = parseFloat(data.row[intCon].iva);
							var intPorcentajeIeps = parseFloat(data.row[intCon].ieps);
							var intTipoCambioRefaccion = parseFloat(data.row[intCon].tipo_cambio_venta);
							var intActualCosto = data.row[intCon].actual_costo;
							var intPorcentajeDescuento = 0;
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
						        if(intMonedaIDCotizacion !== intMonedaBaseIDRemisionesRefaccionesRefacciones )
						        {
						       		//Convertir peso mexicano a tipo de cambio
						       		intPrecioUnitario = intPrecioUnitario / intTipoCambioRemision;
						        }
						    }

						    //Asignar el precio unitario
						    intSubtotal = intPrecioUnitario;

							//Si existe porcentaje de descuento
							if(intPorcentajeDescuento > 0)
							{
								intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;
								intSubtotal = intSubtotal - intDescuentoUnitario;
							}
							

							//Calcular subtotal
							intSubtotal = intCantidad * intSubtotal;

							//Si existe porcentaje de IVA
							if(intPorcentajeIva > 0)
							{
								//Calcular importe de IVA
								intImporteIva = parseFloat(intSubtotal * intPorcentajeIva) / 100;
							}
							
							//Si existe porcentaje de IEPS
							if(intPorcentajeIeps > 0)
							{
								//Calcular importe de IEPS
								intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps) / 100;
							}
							
							//Calcular importe total
							intTotal = intSubtotal + intImporteIva + intImporteIeps;


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

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', intRefaccionID);
								objCeldaCodigo.setAttribute('class', 'movil b1');
								objCeldaCodigo.innerHTML = data.row[intCon].codigo;
								objCeldaDescripcion.setAttribute('class', 'movil b2');
								objCeldaDescripcion.innerHTML = data.row[intCon].descripcion;
								objCeldaCantidad.setAttribute('class', 'movil b3');
								objCeldaCantidad.innerHTML = formatMoney(intCantidad, 2, '');
								objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
								objCeldaPrecioUnitario.innerHTML = formatMoney(intPrecioUnitario, 2, '');
								objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
								objCeldaDescuentoUnitario.innerHTML = formatMoney(intDescuentoUnitario, 2, '');
								objCeldaSubtotal.setAttribute('class', 'movil b6');
								objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 2, '');
								objCeldaIvaUnitario.setAttribute('class', 'movil b7');
								objCeldaIvaUnitario.innerHTML = formatMoney(intImporteIva, 6, '');
								objCeldaIepsUnitario.setAttribute('class', 'movil b8');
								objCeldaIepsUnitario.innerHTML = formatMoney(intImporteIeps, 6, '');
								objCeldaTotal.setAttribute('class', 'movil b9');
								objCeldaTotal.innerHTML = formatMoney(intTotal, 6, '');
								objCeldaAcciones.setAttribute('class', 'td-center movil b10');
								objCeldaAcciones.innerHTML = strAccionesTablaDetalles;
								objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeDescuento.innerHTML = formatMoney(intPorcentajeDescuento, 2, ''); 
								objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIva.innerHTML = formatMoney(intPorcentajeIva, 2, ''); 
								objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIeps.innerHTML = formatMoney(intPorcentajeIeps, 2, '');
								objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
								objCeldaTipoReferencia.innerHTML = tipoReferencia;
								objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
								objCeldaTipoCambio.innerHTML = intTipoCambioRefaccion;
								objCeldaPrecioRefaccion.setAttribute('class', 'no-mostrar');
								objCeldaPrecioRefaccion.innerHTML = intPrecioRefaccion;
								objCeldaCostoActual.setAttribute('class', 'no-mostrar');
								objCeldaCostoActual.innerHTML = intActualCosto;
								objCeldaDisponibleExistencia.setAttribute('class', 'no-mostrar');
								objCeldaDisponibleExistencia.innerHTML = intDisponibleExistencia;
							}
							else
							{

								objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = formatMoney(intCantidad, 2, '');
								objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML = formatMoney(intPrecioUnitario, 2, '');
								objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML =  formatMoney(intDescuentoUnitario, 2, '');
								objTabla.rows.namedItem(intRefaccionID).cells[5].innerHTML =  formatMoney(intSubtotal, 2, '');
								objTabla.rows.namedItem(intRefaccionID).cells[6].innerHTML = formatMoney(intImporteIva, 6, '');
								objTabla.rows.namedItem(intRefaccionID).cells[7].innerHTML = formatMoney(intImporteIeps, 6, '');
								objTabla.rows.namedItem(intRefaccionID).cells[8].innerHTML = formatMoney(intTotal, 6, '');
								objTabla.rows.namedItem(intRefaccionID).cells[9].innerHTML = strAccionesTablaDetalles;
								objTabla.rows.namedItem(intRefaccionID).cells[10].innerHTML = formatMoney(intPorcentajeDescuento, 2, '');
								objTabla.rows.namedItem(intRefaccionID).cells[11].innerHTML = formatMoney(intPorcentajeIva, 2, '');
								objTabla.rows.namedItem(intRefaccionID).cells[12].innerHTML = formatMoney(intPorcentajeIeps, 2, '');
								objTabla.rows.namedItem(intRefaccionID).cells[13].innerHTML = tipoReferencia;
								objTabla.rows.namedItem(intRefaccionID).cells[16].innerHTML = intActualCosto;
								objTabla.rows.namedItem(intRefaccionID).cells[17].innerHTML = intDisponibleExistencia;
							}
						}	
			       		
			       		//Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_remisiones_refacciones_refacciones();
						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $('#dg_detalles_remisiones_refacciones_refacciones tr').length - 2;
						$('#numElementos_detalles_remisiones_refacciones_refacciones').html(intFilas);
						$('#txtNumDetalles_remisiones_refacciones_refacciones').val(intFilas);

			       	 },
			       'json');
		}


		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_remisiones_refacciones_refacciones(objRenglon)
		{
			//Variables que se utilizan para concatenar los datos de la referencia
			var strCodigo = objRenglon.parentNode.parentNode.cells[0].innerHTML;
			var strDescripcion = objRenglon.parentNode.parentNode.cells[1].innerHTML;
			var strReferencia = strCodigo+' - '+strDescripcion;
			var strTipoReferencia = objRenglon.parentNode.parentNode.cells[13].innerHTML;

			//Hacer un llamado a la función para inicializar elementos de la referencia (KIT/REFACCION/LINEA/MARCA)
	        inicializar_refaccion_detalles_remisiones_refacciones_refacciones(strTipoReferencia);

			//Asignar los valores a las cajas de texto
			$('#txtReferenciaID_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtReferencia_detalles_remisiones_refacciones_refacciones').val(strReferencia);
			$('#txtCodigo_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidad_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPrecioUnitario_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtTipoReferencia_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtTipoCambio_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);
			$('#txtPrecioRefaccion_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[15].innerHTML);
			$('#txtActualCosto_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[16].innerHTML);
			$('#txtDisponibleExistencia_detalles_remisiones_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[17].innerHTML);
			//Enfocar caja de texto
			$('#txtReferencia_detalles_remisiones_refacciones_refacciones').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_remisiones_refacciones_refacciones(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_remisiones_refacciones_refacciones").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_remisiones_refacciones_refacciones();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $('#dg_detalles_remisiones_refacciones_refacciones tr').length - 2;
			$('#numElementos_detalles_remisiones_refacciones_refacciones').html(intFilas);
			$('#txtNumDetalles_remisiones_refacciones_refacciones').val(intFilas);

			//Enfocar caja de texto
			$('#txtReferencia_detalles_remisiones_refacciones_refacciones').focus();
		}

		//Función para recalcular los importes de los detalles de la tabla 
		function recalcular_importes_detalles_remisiones_refacciones_refacciones()
		{
			//Variable que se utiliza para asignar el tipo de cambio de la requisición
			var intTipoCambioRemision = parseFloat($('#txtTipoCambio_remisiones_refacciones_refacciones').val());
			//Variable que se utiliza para asignar el tipo de cambio de la refacción
			var intMonedaIDCotizacion =  parseFloat($('#cmbMonedaID_remisiones_refacciones_refacciones').val());

			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_remisiones_refacciones_refacciones').getElementsByTagName('tbody')[0];

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
			        if(intMonedaIDCotizacion !== intMonedaBaseIDRemisionesRefaccionesRefacciones )
			        {
			       		//Convertir peso mexicano a tipo de cambio
			       		intPrecioUnitario = intPrecioUnitario / intTipoCambioRemision;
			        }
			    }

			    //Asignar el precio unitario
			    intSubtotal = intPrecioUnitario;

				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}
				

				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;

				//Si existe porcentaje de IVA
				if(intPorcentajeIva > 0)
				{
					//Calcular importe de IVA
					intImporteIva = parseFloat(intSubtotal * intPorcentajeIva) / 100;
				}
				
				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps > 0)
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps) / 100;
				}
				
				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

				//Revisamos si existe el ID proporcionado, si es así, editamos los datos
				objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = formatMoney(intCantidad, 2, '');
				objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML =  formatMoney(intPrecioUnitario, 2, '');
				objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML =  formatMoney(intDescuentoUnitario, 2, '');
				objTabla.rows.namedItem(intRefaccionID).cells[5].innerHTML =  formatMoney(intSubtotal, 2, '');
				objTabla.rows.namedItem(intRefaccionID).cells[6].innerHTML = formatMoney(intImporteIva, 6, '');
				objTabla.rows.namedItem(intRefaccionID).cells[7].innerHTML = formatMoney(intImporteIeps, 6, '');
				objTabla.rows.namedItem(intRefaccionID).cells[8].innerHTML = formatMoney(intTotal, 6, '');
			}

			//Hacer un llamado a la función para calcular totales de la tabla
		    calcular_totales_detalles_remisiones_refacciones_refacciones();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_remisiones_refacciones_refacciones()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_remisiones_refacciones_refacciones').getElementsByTagName('tbody')[0];

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
			intAcumIva =  '$'+formatMoney(intAcumIva, 6, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, 6, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, 6, '');

			//Asignar los valores
			$('#acumCantidad_detalles_remisiones_refacciones_refacciones').html(intAcumUnidades);
			$('#acumDescuento_detalles_remisiones_refacciones_refacciones').html(intAcumDescuento);
			$('#acumSubtotal_detalles_remisiones_refacciones_refacciones').html(intAcumSubtotal);
			$('#acumIva_detalles_remisiones_refacciones_refacciones').html(intAcumIva);
			$('#acumIeps_detalles_remisiones_refacciones_refacciones').html(intAcumIeps);
			$('#acumTotal_detalles_remisiones_refacciones_refacciones').html(intAcumTotal);
		}

		//Función para calcular el precio unitario del detalle
		function calcular_precio_unitario_detalles_remisiones_refacciones_refacciones()
		{
		   //Variable que se utiliza para asignar el tipo de cambio de la requisición
		   var intTipoCambioRemision = parseFloat($('#txtTipoCambio_remisiones_refacciones_refacciones').val());
		   //Variable que se utiliza para asignar el tipo de cambio de la refacción
		   var intMonedaIDCotizacion =  parseFloat($('#cmbMonedaID_remisiones_refacciones_refacciones').val());
		   //Variable que se utiliza para asignar el tipo de cambio de la refacción
		   var intTipoCambioRefaccion = parseFloat($.reemplazar($('#txtTipoCambio_detalles_remisiones_refacciones_refacciones').val(), ",", ""));
		   //Variable que se utiliza para asignar el precio de la refacción
		   var intPrecioRefaccion = parseFloat($.reemplazar($('#txtPrecioRefaccion_detalles_remisiones_refacciones_refacciones').val(), ",", ""));
		   //Variable que se utiliza para asignar el precio unitario
		   var intPrecioUnitario = 0;

		   //Si existe precio de la refacción
		   if(intPrecioRefaccion > 0 && intTipoCambioRefaccion > 0)
		   {
	   	  	    //Convertir importe a peso mexicano
		      	intPrecioUnitario = intPrecioRefaccion * intTipoCambioRefaccion;

		       	//Si la moneda de la refacción no corresponde a peso mexicano
		        if(intMonedaIDCotizacion !== intMonedaBaseIDRemisionesRefaccionesRefacciones )
		        {
		       		//Convertir peso mexicano a tipo de cambio
		       		intPrecioUnitario = intPrecioUnitario / intTipoCambioRemision;
		        }
		   }
		 	
		   //Cambiar el precio unitario del detalle
		   $('#txtPrecioUnitario_detalles_remisiones_refacciones_refacciones').val(intPrecioUnitario);
       	    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
           $('#txtPrecioUnitario_detalles_remisiones_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Remisiones
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_remisiones_refacciones_refacciones').numeric();
			$('#txtAnticipo_remisiones_refacciones_refacciones').numeric();
			$('#txtCantidad_detalles_remisiones_refacciones_refacciones').numeric();
        	$('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').numeric();
        	$('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').numeric();
        	$('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_remisiones_refacciones_refacciones').blur(function(){
				$('.moneda_remisiones_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 6 });
			});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_remisiones_refacciones_refacciones').blur(function(){
                $('.tipo-cambio_remisiones_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_remisiones_refacciones_refacciones').blur(function(){
                $('.cantidad_remisiones_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_remisiones_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});

			//Regresar el tipo de cambio de la moneda cuando cambie la fecha
			$('#dteFecha_remisiones_refacciones_refacciones').on('dp.change', function (e) {
				//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_remisiones_refacciones_refacciones();
			});

			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_remisiones_refacciones_refacciones').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_remisiones_refacciones_refacciones').val()) === intMonedaBaseIDRemisionesRefaccionesRefacciones)
             	{
             		//Deshabilitar caja de texto
					$('#txtTipoCambio_remisiones_refacciones_refacciones').attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_remisiones_refacciones_refacciones').val(intTipoCambioMonedaBaseRemisionesRefaccionesRefacciones);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_remisiones_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
					//Hacer un llamado a la función para recalcular los importes
			  		recalcular_importes_detalles_remisiones_refacciones_refacciones();
			  		//Hacer un llamado a la función para calcular el precio unitario
			  		calcular_precio_unitario_detalles_remisiones_refacciones_refacciones();
             	}
             	else
             	{
             		//Habilitar caja de texto
					$('#txtTipoCambio_remisiones_refacciones_refacciones').removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_remisiones_refacciones_refacciones').val('');
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_remisiones_refacciones_refacciones(); 
             	}
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_remisiones_refacciones_refacciones').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_remisiones_refacciones_refacciones').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoRemisionesRefaccionesRefacciones)
	        	{
	        		$('#txtTipoCambio_remisiones_refacciones_refacciones').val(intTipoCambioMaximoRemisionesRefaccionesRefacciones);
	        	}

		    });

	        //Autocomplete para recuperar los datos de una cotización de refacciones
	        $('#txtCotizacionRefacciones_remisiones_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtReferenciaID_remisiones_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la referencia (cotización/pedido)
	               inicializar_referencia_remisiones_refacciones_refacciones('cotizacion');
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
	              //Asignar id del registro seleccionado
	              $('#txtReferenciaID_remisiones_refacciones_refacciones').val(ui.item.data);
	              //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	              $.post('refacciones/cotizaciones_refacciones/get_datos',
	                  { 
	                  	intCotizacionRefaccionesID: $('#txtReferenciaID_remisiones_refacciones_refacciones').val()
	                  },
	                  function(data) {
	                    if(data.row){
	                    	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
							inicializar_detalles_remisiones_refacciones_refacciones();
							//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes a la referencia
							deshabilitar_controles_remisiones_refacciones_refacciones();
	                    	//Recuperar valores
	                    	$('#txtTipoReferencia_remisiones_refacciones_refacciones').val('COTIZACION');
	             			$('#txtCotizacionRefacciones_remisiones_refacciones_refacciones').val(data.row.folio);
	             			$('#cmbMonedaID_remisiones_refacciones_refacciones').val(data.row.moneda_id);
				            $('#txtTipoCambio_remisiones_refacciones_refacciones').val(data.row.tipo_cambio);
				            $('#txtProspectoID_remisiones_refacciones_refacciones').val(data.row.prospecto_id);
	             		    $('#txtCliente_remisiones_refacciones_refacciones').val(data.row.prospecto);
	             		    $('#txtRefaccionesListaPrecioID_remisiones_refacciones_refacciones').val(data.row.refacciones_lista_precio_id);
	             		    $('#txtVendedorID_remisiones_refacciones_refacciones').val(data.row.vendedor_id);
	             		    $('#txtVendedor_remisiones_refacciones_refacciones').val(data.row.vendedor);	             		  
	             		    $('#txtEstrategiaID_remisiones_refacciones_refacciones').val(data.row.estrategia_id);
	             		    $('#txtEstrategia_remisiones_refacciones_refacciones').val(data.row.estrategia);
	             		    $('#cmbTipo_remisiones_refacciones_refacciones').val(data.row.tipo);
	             		    $('#txtObservaciones_remisiones_refacciones_refacciones').val(data.row.observaciones);
	             		    $('#txtNotas_remisiones_refacciones_refacciones').val(data.row.notas);
	             		    //Hacer un llamado a la función para cargar los detalles del registro en la tabla
				            cargar_detalles_tabla_remisiones_refacciones_refacciones(data.row.tipo_cambio, data.detalles, 'referencia', 'Nuevo');
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
	        
			//Verificar que exista id de la cotización cuando pierda el enfoque la caja de texto
	        $('#txtCotizacionRefacciones_remisiones_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la cotización
	            if($('#txtReferenciaID_remisiones_refacciones_refacciones').val() == '' ||
	               $('#txtCotizacionRefacciones_remisiones_refacciones_refacciones').val() == '')
	            { 
	             	//Limpiar contenido de la caja de texto
	                $('#txtCotizacionRefacciones_remisiones_refacciones_refacciones').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de un pedido de refacciones
	        $('#txtPedidoRefacciones_remisiones_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtReferenciaID_remisiones_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la referencia (cotización/pedido)
	               inicializar_referencia_remisiones_refacciones_refacciones('pedido');
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
	              //Asignar id del registro seleccionado
	              $('#txtReferenciaID_remisiones_refacciones_refacciones').val(ui.item.data);
	              //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	              $.post('refacciones/pedidos_refacciones/get_datos',
	                  { 
	                  	intPedidoRefaccionesID: $('#txtReferenciaID_remisiones_refacciones_refacciones').val()
	                  },
	                  function(data) {
	                    if(data.row){
	                    	//Hacer un llamado a la función para inicializar elementos de la tabla detalles
							inicializar_detalles_remisiones_refacciones_refacciones();
							//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes a la referencia
							deshabilitar_controles_remisiones_refacciones_refacciones();
	                    	//Recuperar valores
	                    	$('#txtTipoReferencia_remisiones_refacciones_refacciones').val('PEDIDO');
	             			$('#txtPedidoRefacciones_remisiones_refacciones_refacciones').val(data.row.folio);
	             			$('#cmbMonedaID_remisiones_refacciones_refacciones').val(data.row.moneda_id);
				            $('#txtTipoCambio_remisiones_refacciones_refacciones').val(data.row.tipo_cambio);
				            $('#txtProspectoID_remisiones_refacciones_refacciones').val(data.row.prospecto_id);
	             		    $('#txtCliente_remisiones_refacciones_refacciones').val(data.row.prospecto);
	             		    $('#txtRefaccionesListaPrecioID_remisiones_refacciones_refacciones').val(data.row.refacciones_lista_precio_id);
	             		    $('#txtVendedorID_remisiones_refacciones_refacciones').val(data.row.vendedor_id);
	             		    $('#txtVendedor_remisiones_refacciones_refacciones').val(data.row.vendedor);	             		    
	             		    $('#txtEstrategiaID_remisiones_refacciones_refacciones').val(data.row.estrategia_id);
	             		    $('#txtEstrategia_remisiones_refacciones_refacciones').val(data.row.estrategia);
	             		    $('#cmbTipo_remisiones_refacciones_refacciones').val(data.row.tipo);
	             		    $('#txtObservaciones_remisiones_refacciones_refacciones').val(data.row.observaciones);
	             		    $('#txtNotas_remisiones_refacciones_refacciones').val(data.row.notas);
	             		    //Hacer un llamado a la función para cargar los detalles del registro en la tabla
				            cargar_detalles_tabla_remisiones_refacciones_refacciones(data.row.tipo_cambio, data.detalles, 'referencia','Nuevo');
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
	        
			//Verificar que exista id del pedido cuando pierda el enfoque la caja de texto
	        $('#txtPedidoRefacciones_remisiones_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del pedido
	            if($('#txtReferenciaID_remisiones_refacciones_refacciones').val() == '' ||
	               $('#txtPedidoRefacciones_remisiones_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de la caja de texto
	               $('#txtPedidoRefacciones_remisiones_refacciones_refacciones').val('');
	            }
	        });


			//Autocomplete para recuperar los datos de un cliente 
	        $('#txtCliente_remisiones_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_remisiones_refacciones_refacciones').val('');
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
	             //Asignar valores del registro seleccionado
	             $('#txtProspectoID_remisiones_refacciones_refacciones').val(ui.item.data);
	             $('#txtRefaccionesListaPrecioID_remisiones_refacciones_refacciones').val(ui.item.refacciones_lista_precio_id);
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
	        $('#txtCliente_remisiones_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoID_remisiones_refacciones_refacciones').val() == '' ||
	               $('#txtCliente_remisiones_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_remisiones_refacciones_refacciones').val('');
	               $('#txtCliente_remisiones_refacciones_refacciones').val('');
	               $('#txtRefaccionesListaPrecioID_remisiones_refacciones_refacciones').val('');
	            }

	        });

	         //Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_remisiones_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorID_remisiones_refacciones_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: intModuloIDRemisionesRefaccionesRefacciones
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorID_remisiones_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtVendedor_remisiones_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_remisiones_refacciones_refacciones').val() == '' ||
	               $('#txtVendedor_remisiones_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_remisiones_refacciones_refacciones').val('');
	               $('#txtVendedor_remisiones_refacciones_refacciones').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una estrategia
	        $('#txtEstrategia_remisiones_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEstrategiaID_remisiones_refacciones_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/estrategias/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strModulo: strModuloRemisionesRefaccionesRefacciones
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtEstrategiaID_remisiones_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtEstrategia_remisiones_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la estrategia
	            if($('#txtEstrategiaID_remisiones_refacciones_refacciones').val() == '' ||
	               $('#txtEstrategia_remisiones_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEstrategiaID_remisiones_refacciones_refacciones').val('');
	               $('#txtEstrategia_remisiones_refacciones_refacciones').val('');
	            }
	            
	        });

	        //Calcular el precio unitario cuando cambie el contenido de la caja de texto
	        $('#txtTipoCambio_remisiones_refacciones_refacciones').change(function() {
			  	 //Hacer un llamado a la función para recalcular los importes
			  	 recalcular_importes_detalles_remisiones_refacciones_refacciones();
			  	 //Hacer un llamado a la función para calcular el precio unitario
			  	 calcular_precio_unitario_detalles_remisiones_refacciones_refacciones();
			});

	        //Autocomplete para recuperar los datos de una refacción, kit, línea o marca
	        $('#txtReferencia_detalles_remisiones_refacciones_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtReferenciaID_detalles_remisiones_refacciones_refacciones').val('');
	                  //Hacer un llamado a la función para inicializar elementos de la referencia (KIT/REFACCION/LINEA/MARCA)
	               	 inicializar_refaccion_detalles_remisiones_refacciones_refacciones ('REFACCION');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones_promociones/autocomplete",
	                   type: "post",
	                   dataType: "json",
	                   data: {
	                     strDescripcion: request.term,
	                     strTipo: 'referencias',
	                     //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						 dteFecha: $.formatFechaMysql($('#txtFecha_remisiones_refacciones_refacciones').val())
	                   },
	                   success: function( data ) {
	                     response( data );
	                   }
	                 });
	             },
	             select: function( event, ui ) {
	                //Asignar id del registro seleccionado
	                $('#txtReferenciaID_detalles_remisiones_refacciones_refacciones').val(ui.item.data);
	                var intPorcentajeDescuento = parseFloat(ui.item.descuento_promocion);
	                var strTipoReferencia = ui.item.tipo_referencia;
	                 $('#txtTipoReferencia_detalles_remisiones_refacciones_refacciones').val(strTipoReferencia);

	                //Si existe la referencia tiene descuento de promoción
	                if(intPorcentajeDescuento > 0)
	                {
	                	$('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').val(intPorcentajeDescuento);
	                	//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					    $('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
	                }

	                //Si el tipo de referencia corresponde a una refacción
	                if(strTipoReferencia == 'REFACCION')
	                {
	                	//Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
			           	$.post('refacciones/refacciones/get_datos',
			                  { 
			                  	strBusqueda: $('#txtReferenciaID_detalles_remisiones_refacciones_refacciones').val(),
					       		strTipo: 'id',
					       		intRefaccionesListaPrecioID: $('#txtRefaccionesListaPrecioID_remisiones_refacciones_refacciones').val(), 
					       		//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día 
				   				dteFechaTipoCambio: $.formatFechaMysql($('#txtFecha_remisiones_refacciones_refacciones').val())
			                  },
			                  function(data) {
			                    if(data.row){
			                       $('#txtCodigo_detalles_remisiones_refacciones_refacciones').val(data.row.codigo_01);
			                       $('#txtDescripcion_detalles_remisiones_refacciones_refacciones').val(data.row.descripcion);
			                       $('#txtPrecioRefaccion_detalles_remisiones_refacciones_refacciones').val(data.row.precio);
			                       $('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').val(data.row.iva);
			                       $('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').val(data.row.ieps);
			                       $('#txtTipoCambio_detalles_remisiones_refacciones_refacciones').val(data.row.tipo_cambio_venta);
			                       $('#txtActualCosto_detalles_remisiones_refacciones_refacciones').val(data.row.actual_costo);
			                       $('#txtDisponibleExistencia_detalles_remisiones_refacciones_refacciones').val(data.row.disponible_existencia);
                              	   $('#txtCantidad_detalles_remisiones_refacciones_refacciones').val(data.row.disponible_existencia);
			                       //Hacer un llamado a la función para calcular el precio unitario
							  	   calcular_precio_unitario_detalles_remisiones_refacciones_refacciones();
			                       //Enfocar caja de texto
		                      	   $('#txtCantidad_detalles_remisiones_refacciones_refacciones').focus();
			                    }
			                  }
			                 ,
			                'json');
	                }
	                else
	                {
	                	//Deshabilitar las siguientes cajas de texto
				   		$('#txtCantidad_detalles_remisiones_refacciones_refacciones').attr('disabled','disabled');
				   		$('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').attr('disabled','disabled');
				   		$('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').attr('disabled','disabled');
				   		//Enfocar caja de texto
		                $('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').focus();
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
	        $('#txtReferencia_detalles_remisiones_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la referencia
	            if($('#txtReferenciaID_detalles_remisiones_refacciones_refacciones').val() == '' ||
	               $('#txtReferencia_detalles_remisiones_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtReferenciaID_detalles_remisiones_refacciones_refacciones').val('');
	               $('#txtReferencia_detalles_remisiones_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la referencia (KIT/REFACCION/LINEA/MARCA)
	               	inicializar_refaccion_detalles_remisiones_refacciones_refacciones ('REFACCION');
	                
	            }

	        });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_remisiones_refacciones_refacciones').on('click','button.btn',function(){
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
			$('#txtReferencia_detalles_remisiones_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe referencia
		            if($('#txtReferenciaID_detalles_remisiones_refacciones_refacciones').val() == '' || $('#txtReferencia_detalles_remisiones_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtReferencia_detalles_remisiones_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtCantidad_detalles_remisiones_refacciones_refacciones').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_remisiones_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_remisiones_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_remisiones_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Si el tipo de referencia corresponde a una refacción 
			   	    	if($('#txtTipoReferencia_detalles_remisiones_refacciones_refacciones').val() == 'REFACCION')
			   	    	{
			   	    		//Enfocar caja de texto
					    	$('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').focus();
			   	    	}
			   	   		else
			   	   		{
			   	   			//Enfocar caja de agregar
					    	$('#btnAgregar_remisiones_refacciones_refacciones').focus();
			   	   		}
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_remisiones_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Si el tipo de referencia corresponde a una refacción 
			   	    	if($('#txtTipoReferencia_detalles_remisiones_refacciones_refacciones').val() == 'REFACCION')
			   	    	{
			   	    		//Enfocar caja de texto
					   		 $('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').focus();
			   	    	}
			   	    	else
			   	    	{
			   	    		//Hacer un llamado a la función para agregar renglón a la tabla
			   	    		agregar_renglon_detalles_remisiones_refacciones_refacciones();
			   	    	}
			   	    }
		        }
		    });

			//Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {

		         	//Si no existe procentaje de IVA
		            if( $('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_remisiones_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
					    //Si el tipo de referencia corresponde a una refacción 
			   	    	if($('#txtTipoReferencia_detalles_remisiones_refacciones_refacciones').val() == 'REFACCION')
			   	    	{
			   	    		//Enfocar caja de texto
					   		 $('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').focus();
			   	    	}
			   	    	else
			   	    	{
			   	    		//Enfocar caja de agregar
					    	$('#btnAgregar_remisiones_refacciones_refacciones').focus();
			   	    	}
			   	    }
		        }
		    });

			//Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje de IEPS
		            if($('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_detalles_remisiones_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_detalles_remisiones_refacciones_refacciones();
			   	    }
		        }
		    });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_remisiones_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_remisiones_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_remisiones_refacciones_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_remisiones_refacciones_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_remisiones_refacciones_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_remisiones_refacciones_refacciones').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un cliente
	        $('#txtProspectoBusq_remisiones_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_remisiones_refacciones_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/clientes/autocomplete",
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
	             //Asignar id del registro seleccionado
	             $('#txtProspectoIDBusq_remisiones_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtProspectoBusq_remisiones_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del cliente
	            if($('#txtProspectoIDBusq_remisiones_refacciones_refacciones').val() == '' ||
	               $('#txtProspectoBusq_remisiones_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_remisiones_refacciones_refacciones').val('');
	               $('#txtProspectoBusq_remisiones_refacciones_refacciones').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_remisiones_refacciones_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaRemisionesRefaccionesRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_remisiones_refacciones_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_remisiones_refacciones_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_remisiones_refacciones_refacciones('Nuevo');
				//Abrir modal
				 objRemisionesRefaccionesRefacciones = $('#RemisionesRefaccionesRefaccionesBox').bPopup({
												   appendTo: '#RemisionesRefaccionesRefaccionesContent', 
					                               contentContainer: 'RemisionesRefaccionesRefaccionesM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_remisiones_refacciones_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_remisiones_refacciones_refacciones').focus();


			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_remisiones_refacciones_refacciones();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_remisiones_refacciones_refacciones();
		});
	</script>