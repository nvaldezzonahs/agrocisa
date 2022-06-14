	<div id="PedidosRefaccionesRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_pedidos_refacciones_refacciones" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_pedidos_refacciones_refacciones" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_pedidos_refacciones_refacciones">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_pedidos_refacciones_refacciones'>
				                    <input class="form-control" id="txtFechaInicialBusq_pedidos_refacciones_refacciones"
				                    		name= "strFechaInicialBusq_pedidos_refacciones_refacciones" 
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
								<label for="txtFechaFinalBusq_pedidos_refacciones_refacciones">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_pedidos_refacciones_refacciones'>
				                    <input class="form-control" id="txtFechaFinalBusq_pedidos_refacciones_refacciones"
				                    		name= "strFechaFinalBusq_pedidos_refacciones_refacciones" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los prospectos y clientes activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del prospecto/cliente seleccionado-->
								<input id="txtProspectoIDBusq_pedidos_refacciones_refacciones" 
									   name="intProspectoIDBusq_pedidos_refacciones_refacciones"  type="hidden" 
									   value="">
								</input>
								<label for="txtProspectoBusq_pedidos_refacciones_refacciones">Prospecto / Cliente</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProspectoBusq_pedidos_refacciones_refacciones" 
										name="strProspectoBusq_pedidos_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese prospecto o cliente" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_pedidos_refacciones_refacciones">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_pedidos_refacciones_refacciones" 
								 		name="strEstatusBusq_pedidos_refacciones_refacciones" tabindex="1">
								    <option value="TODOS">TODOS</option>
                      				<option value="ACTIVO">ACTIVO</option>
                      				<option value="REMISION">REMISION</option>
					  				<option value="FACTURADO">FACTURADO</option>
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
								<label for="txtBusqueda_pedidos_refacciones_refacciones">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_pedidos_refacciones_refacciones" 
										name="strBusqueda_pedidos_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_pedidos_refacciones_refacciones" 
									   name="strImprimirDetalles_pedidos_refacciones_refacciones" type="checkbox"
									   value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-6">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_pedidos_refacciones_refacciones"
									onclick="paginacion_pedidos_refacciones_refacciones();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_pedidos_refacciones_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_pedidos_refacciones_refacciones"
									onclick="reporte_pedidos_refacciones_refacciones('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_pedidos_refacciones_refacciones"
									onclick="reporte_pedidos_refacciones_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla pedidos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Prospecto / Cliente"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Anticipo"; font-weight: bold;}
			    td.movil.a5:nth-of-type(5):before {content: "Cotización"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles del pedido
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
				Definir columnas de los totales (acumulados) de la tabla detalles del pedido
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
				<table class="table-hover movil" id="dg_pedidos_refacciones_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Prospecto / Cliente</th>
							<th class="movil">Anticipo</th>
							<th class="movil">Cotización</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_pedidos_refacciones_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{prospecto}}</td>
							<td class="movil a4">{{folio_anticipo}}</td>
							<td class="movil a5">{{folio_cotizacion}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_pedidos_refacciones_refacciones({{pedido_refacciones_id}}, 'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_pedidos_refacciones_refacciones({{pedido_refacciones_id}}, 'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_prospecto_pedidos_refacciones_refacciones({{pedido_refacciones_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_pedidos_refacciones_refacciones({{pedido_refacciones_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_pedidos_refacciones_refacciones({{pedido_refacciones_id}},'{{estatus}}', {{cotizacion_refacciones_id}});" title="Desactivar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_pedidos_refacciones_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_pedidos_refacciones_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarPedidosRefaccionesRefaccionesBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_prospecto_pedidos_refacciones_refacciones" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarPedidosRefaccionesRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarPedidosRefaccionesRefacciones"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Prospecto / Cliente-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtPedidoRefaccionesID_prospecto_pedidos_refacciones_refacciones" 
										   name="intPedidoRefaccionesID_prospecto_pedidos_refacciones_refacciones" 
										   type="hidden" value="">
									</input>
									<label for="txtProspecto_prospecto_pedidos_refacciones_refacciones">Prospecto / Cliente</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProspecto_prospecto_pedidos_refacciones_refacciones" 
											name="strProspecto_prospecto_pedidos_refacciones_refacciones" type="text" value="" 
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
									<label for="txtCorreoElectronico_prospecto_pedidos_refacciones_refacciones">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_prospecto_pedidos_refacciones_refacciones" 
											name="strCorreoElectronico_prospecto_pedidos_refacciones_refacciones" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_prospecto_pedidos_refacciones_refacciones">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_prospecto_pedidos_refacciones_refacciones" 
											name="strCopiaCorreoElectronico_prospecto_pedidos_refacciones_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_prospecto_pedidos_refacciones_refacciones" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_prospecto_pedidos_refacciones_refacciones"  
									onclick="validar_prospecto_pedidos_refacciones_refacciones();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_prospecto_pedidos_refacciones_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_prospecto_pedidos_refacciones_refacciones();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal Pedidos-->
		<div id="PedidosRefaccionesRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_pedidos_refacciones_refacciones"  class="ModalBodyTitle">
			<h1>Pedidos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmPedidosRefaccionesRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmPedidosRefaccionesRefacciones"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtPedidoRefaccionesID_pedidos_refacciones_refacciones" 
										   name="intPedidoRefaccionesID_pedidos_refacciones_refacciones" type="hidden" value="">
									</input>
									<label for="txtFolio_pedidos_refacciones_refacciones">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_pedidos_refacciones_refacciones" 
											name="strFolio_pedidos_refacciones_refacciones" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_pedidos_refacciones_refacciones">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_pedidos_refacciones_refacciones'>
					                    <input class="form-control" id="txtFecha_pedidos_refacciones_refacciones"
					                    		name= "strFecha_pedidos_refacciones_refacciones" 
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
									<label for="cmbMonedaID_pedidos_refacciones_refacciones">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_pedidos_refacciones_refacciones" 
									 		name="intMonedaID_pedidos_refacciones_refacciones" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_pedidos_refacciones_refacciones">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_pedidos_refacciones_refacciones" id="txtTipoCambio_pedidos_refacciones_refacciones" 
											name="intTipoCambio_pedidos_refacciones_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11">
									</input>
								</div>
							</div>
						</div>
					</div>
					 <div class="row">
				    	
						<!--Autocomplete que contiene los anticipos activos-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del anticipo seleccionado-->
									<input id="txtAnticipoID_pedidos_refacciones_refacciones" 
										   name="intAnticipoID_pedidos_refacciones_refacciones"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el saldo del anticipo-->
									<input id="txtSaldoAnticipo_pedidos_refacciones_refacciones" 
										   name="intSaldoAnticipo_pedidos_refacciones_refacciones"  
										   type="hidden" value="">
									</input>
									<label for="txtAnticipo_pedidos_refacciones_refacciones">Anticipo</label>
								</div>	
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtAnticipo_pedidos_refacciones_refacciones" 
											name="strAnticipo_pedidos_refacciones_refacciones" 
											type="text" value="" tabindex="1" placeholder="Ingrese anticipo" maxlength="250" />
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las cotizaciones activas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id de la cotización seleccionada-->
									<input id="txtCotizacionRefaccionesID_pedidos_refacciones_refacciones" 
										   name="intCotizacionRefaccionesID_pedidos_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta para recuperar el tipo de cambio de la cotización seleccionada-->
									<input id="txtTipoCambio_cotizacion_pedidos_refacciones_refacciones" 
										   name="intTipoCambio_cotizacion_pedidos_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<label for="txtCotizacionRefacciones_pedidos_refacciones_refacciones">Cotización</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCotizacionRefacciones_pedidos_refacciones_refacciones" 
											name="strCotizacionRefacciones_pedidos_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese cotización" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    	<!--Tipo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipo_pedidos_refacciones_refacciones">Tipo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTipo_pedidos_refacciones_refacciones" 
									 		name="strTipo_pedidos_refacciones_refacciones" tabindex="1">
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
									<input id="txtEstrategiaID_pedidos_refacciones_refacciones" 
										   name="intEstrategiaID_pedidos_refacciones_refacciones" 
										   type="hidden" value="">
									</input>
									<label for="txtEstrategia_pedidos_refacciones_refacciones">
										Estrategia
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEstrategia_pedidos_refacciones_refacciones" 
											name="strEstrategia_pedidos_refacciones_refacciones" type="text" value="" tabindex="1"  placeholder="Ingrese estrategia" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
				    <div class="row">
						<!--Autocomplete que contiene los prospectos y clientes activos-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id del prospecto/cliente seleccionado-->
									<input id="txtProspectoID_pedidos_refacciones_refacciones" 
										   name="intProspectoID_pedidos_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la lista de precios correspondiente al cliente seleccionado-->
									<input id="txtRefaccionesListaPrecioID_pedidos_refacciones_refacciones" 
										   name="intRefaccionesListaPrecioID_pedidos_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<label for="txtProspecto_pedidos_refacciones_refacciones">Prospecto / Cliente</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProspecto_pedidos_refacciones_refacciones" 
											name="strProspecto_pedidos_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese prospecto o cliente" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los vendedores activos-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id del vendedor seleccionado-->
									<input id="txtVendedorID_pedidos_refacciones_refacciones" 
										   name="intVendedorID_pedidos_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<label for="txtVendedor_pedidos_refacciones_refacciones">Vendedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtVendedor_pedidos_refacciones_refacciones" 
											name="strVendedor_pedidos_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese vendedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Gastos de paquetería-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                  			<div class="form-group">
								<div class="col-md-12">
										<!-- Caja de texto oculta para recuperar el IVA desglosado con base al importe capturado-->
										<input id="txtGastosPaqueteriaSubtotal_pedidos_refacciones_refacciones" 
											   name="intGastosPaqueteriaSubtotal_pedidos_refacciones_refacciones" 
											   type="hidden" value="" />
									    <!-- Caja de texto oculta para recuperar el IVA desglosado con base al importe capturado-->
										<input id="txtGastosPaqueteriaIva_pedidos_refacciones_refacciones" 
											   name="intGastosPaqueteriaIva_pedidos_refacciones_refacciones" 
											   type="hidden" value="" />	
									<label for="txtGastosPaqueteria_pedidos_refacciones_refacciones">Gastos de paquetería</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control cantidad_pedidos_refacciones_refacciones" 
												id="txtGastosPaqueteria_pedidos_refacciones_refacciones" 
												name="intGastosPaqueteria_pedidos_refacciones_refacciones" 
												type="text" value="" tabindex="1" 
												placeholder="Ingrese importe" maxlength="12" />	
									</div>
								</div>
							</div>
                  		</div>

				    </div>
				   <div class="row">
				    	<!--Observaciones-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_pedidos_refacciones_refacciones">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_pedidos_refacciones_refacciones" 
											name="strObservaciones_pedidos_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Notas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtNotas_pedidos_refacciones_refacciones">Notas</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtNotas_pedidos_refacciones_refacciones" 
											name="strNotas_pedidos_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese notas" maxlength="250">
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
									<input id="txtNumDetalles_pedidos_refacciones_refacciones" 
										   name="intNumDetalles_pedidos_refacciones_refacciones" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles del pedido</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene las refacciones y kits de refacciones activas-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la referencia seleccionada-->
																		<input id="txtReferenciaID_detalles_pedidos_refacciones_refacciones" 
																			   name="intReferenciaID_detalles_pedidos_refacciones_refacciones" 
																			   type="hidden" value="" />
																		<!-- Caja de texto oculta para recuperar el id del tipo de referencia seleccionada-->
																		<input id="txtTipoReferencia_detalles_pedidos_refacciones_refacciones" 
																			   name="strTipoReferencia_detalles_pedidos_refacciones_refacciones" 
																			   type="hidden" value="" />
																		<!-- Caja de texto oculta para recuperar el código de la refacción seleccionada-->
																		<input id="txtCodigo_detalles_pedidos_refacciones_refacciones" 
																			   name="strCodigo_detalles_pedidos_refacciones_refacciones" 
																			   type="hidden" value="" />
																		<!-- Caja de texto oculta para recuperar el código de línea de la refacción seleccionada-->
																		<input id="txtCodigoLinea_detalles_pedidos_refacciones_refacciones" 
																			   name="strCodigoLinea_detalles_pedidos_refacciones_refacciones" 
																			   type="hidden" value="" />	   
																		<!-- Caja de texto oculta para recuperar la descripción de la refacción seleccionada-->
																		<input id="txtDescripcion_detalles_pedidos_refacciones_refacciones" 
																			   name="strDescripcion_detalles_pedidos_refacciones_refacciones" 
																			   type="hidden" value="" />
																		<!-- Caja de texto oculta que se utiliza para recuperar el precio de la refacción seleccionada-->
																		<input id="txtPrecioRefaccion_detalles_pedidos_refacciones_refacciones" 
																			   name="intPrecioRefaccion_detalles_pedidos_refacciones_refacciones"  
																			   type="hidden" value="" />
																	    <!-- Caja de texto oculta que se utiliza para recuperar el tipo de cambio de la refacción seleccionada-->
																		<input id="txtTipoCambio_detalles_pedidos_refacciones_refacciones" 
																			   name="intTipoCambio_detalles_pedidos_refacciones_refacciones"  
																			   type="hidden" value="" />
																	   
																<label for="txtReferencia_detalles_pedidos_refacciones_refacciones">
																	Refacción
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtReferencia_detalles_pedidos_refacciones_refacciones" 
																		name="strReferencia_detalles_pedidos_refacciones_refacciones" type="text" value="" 
																		tabindex="1" placeholder="Ingrese refacción" maxlength="250">
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
																<label for="txtCantidad_detalles_pedidos_refacciones_refacciones">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_pedidos_refacciones_refacciones" 
																		id="txtCantidad_detalles_pedidos_refacciones_refacciones" 
																		name="intCantidad_detalles_pedidos_refacciones_refacciones" 
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
																<label for="txtPrecioUnitario_detalles_pedidos_refacciones_refacciones">Precio unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_pedidos_refacciones_refacciones" 
																		id="txtPrecioUnitario_detalles_pedidos_refacciones_refacciones" 
																		name="intPrecioUnitario_detalles_pedidos_refacciones_refacciones" 
																		type="text" value=""  tabindex="1" placeholder="" 
																		maxlength="15"/>
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_pedidos_refacciones_refacciones" id="txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones" 
																		name="intPorcentajeDescuento_detalles_pedidos_refacciones_refacciones" type="text" value="" 
																		tabindex="1" placeholder="Ingrese descuento" maxlength="8">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IVA-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<input id="txtTasaCuotaIva_detalles_pedidos_refacciones_refacciones" name="intTasaCuotaIva_detalles_pedidos_refacciones_refacciones" type="hidden" value="">
																		</input>
																		<label for="txtPorcentajeIva_detalles_pedidos_refacciones_refacciones">IVA %</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtPorcentajeIva_detalles_pedidos_refacciones_refacciones" 
																				name="intPorcentajeIva_detalles_pedidos_refacciones_refacciones" type="text" value="" 
																				tabindex="1"  maxlength="8">
																		</input>
																	</div>
																</div>
															</div>
															<!--Porcentaje del IEPS-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
																<div class="form-group">
																	<div class="col-md-12">
																		<input id="txtTasaCuotaIeps_detalles_pedidos_refacciones_refacciones" name="intTasaCuotaIeps_detalles_pedidos_refacciones_refacciones" type="hidden" value="">
																		</input>
																		<label for="txtPorcentajeIeps_detalles_pedidos_refacciones_refacciones">IEPS %</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtPorcentajeIeps_detalles_pedidos_refacciones_refacciones" 
																				name="intPorcentajeIeps_detalles_pedidos_refacciones_refacciones" type="text" value="" 
																				tabindex="1" maxlength="8">
																		</input>
																	</div>
																</div>
															</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_pedidos_refacciones_refacciones"
					                                			onclick="agregar_renglon_detalles_pedidos_refacciones_refacciones();" 
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
													<table class="table-hover movil" id="dg_detalles_pedidos_refacciones_refacciones">
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
																	<strong id="acumCantidad_detalles_pedidos_refacciones_refacciones">0.00</strong>
																</td>
																<td class="movil t4"></td>
																<td class="movil t5">
																	<strong id="acumDescuento_detalles_pedidos_refacciones_refacciones">$0.00</strong>
																</td>
																<td class="movil t6">
																	<strong id="acumSubtotal_detalles_pedidos_refacciones_refacciones">$0.00</strong>
																</td>
																<td class="movil t7">
																	<strong id="acumIva_detalles_pedidos_refacciones_refacciones">$0.00</strong>
																</td>
																<td class="movil t8">
																	<strong  id="acumIeps_detalles_pedidos_refacciones_refacciones">$0.00</strong>
																</td>
																<td class="movil t9">
																	<strong id="acumTotal_detalles_pedidos_refacciones_refacciones">$0.00</strong>
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
																<strong id="numElementos_detalles_pedidos_refacciones_refacciones">0</strong> encontrados
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
							<button class="btn btn-info" id="btnReiniciar_pedidos_refacciones_refacciones"  
									onclick="nuevo_pedidos_refacciones_refacciones('Nuevo');"  title="Nuevo registro" tabindex="2">
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_pedidos_refacciones_refacciones"  
									onclick="validar_pedidos_refacciones_refacciones();"  title="Guardar" tabindex="3" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_pedidos_refacciones_refacciones"  
									onclick="abrir_prospecto_pedidos_refacciones_refacciones('');"  
									title="Enviar correo electrónico" tabindex="4" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_pedidos_refacciones_refacciones"  
									onclick="reporte_registro_pedidos_refacciones_refacciones('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_pedidos_refacciones_refacciones"  
									onclick="cambiar_estatus_pedidos_refacciones_refacciones('','ACTIVO', '');"  title="Desactivar" tabindex="6" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_pedidos_refacciones_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_pedidos_refacciones_refacciones();" 
									title="Cerrar"  tabindex="8">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Pedidos-->
	</div><!--#PedidosRefaccionesRefaccionesContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_pedidos_refacciones_refacciones" type="text/template">
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
		var intPaginaPedidosRefaccionesRefacciones = 0;
		var strUltimaBusquedaPedidosRefaccionesRefacciones = "";
		//Variable que se utiliza para asignar el id del módulo de refacciones
		var intModuloIDPedidosRefaccionesRefacciones = <?php echo MODULO_REFACCIONES ?>;
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDPedidosRefaccionesRefacciones = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBasePedidosRefaccionesRefacciones = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoPedidosRefaccionesRefacciones = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar el valor del impuesto IVA
		var intIvaPedidosRefaccionesRefacciones = <?php echo IVA ?>;
		//Variable que se utiliza para asignar el valor del porcentaje de IVA
		var intPorcentajeIvaPedidosRefaccionesRefacciones = <?php echo PORCENTAJE_IVA ?>;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarPedidosRefaccionesRefacciones = null;
		//Variable que se utiliza para asignar objeto del modal Pedidos
		var objPedidosRefaccionesRefacciones = null;

		//Array que contiene los id´s de las cajas de texto que se utilizan para desglosar el IVA del gasto de paquetería
		var arrDesglosarIvaGastoPedidosRefaccionesRefacciones  = {gasto: '#txtGastosPaqueteria_pedidos_refacciones_refacciones',
															 porcentajeIva: intPorcentajeIvaPedidosRefaccionesRefacciones,
															 iva: intIvaPedidosRefaccionesRefacciones,
															 gastoSubtotal: '#txtGastosPaqueteriaSubtotal_pedidos_refacciones_refacciones',
															 gastoIva: '#txtGastosPaqueteriaIva_pedidos_refacciones_refacciones'
															};


		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_pedidos_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/pedidos_refacciones/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_pedidos_refacciones_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosPedidosRefaccionesRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosPedidosRefaccionesRefacciones = strPermisosPedidosRefaccionesRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosPedidosRefaccionesRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosPedidosRefaccionesRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_pedidos_refacciones_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosPedidosRefaccionesRefacciones[i]=='GUARDAR') || (arrPermisosPedidosRefaccionesRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_pedidos_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosPedidosRefaccionesRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_pedidos_refacciones_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_pedidos_refacciones_refacciones();
						}
						else if(arrPermisosPedidosRefaccionesRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_pedidos_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosPedidosRefaccionesRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_pedidos_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosPedidosRefaccionesRefacciones[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_pedidos_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosPedidosRefaccionesRefacciones[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_pedidos_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosPedidosRefaccionesRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_pedidos_refacciones_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_pedidos_refacciones_refacciones() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaPedidosRefaccionesRefacciones =($('#txtFechaInicialBusq_pedidos_refacciones_refacciones').val()+$('#txtFechaFinalBusq_pedidos_refacciones_refacciones').val()+$('#txtProspectoIDBusq_pedidos_refacciones_refacciones').val()+$('#cmbEstatusBusq_pedidos_refacciones_refacciones').val()+$('#txtBusqueda_pedidos_refacciones_refacciones').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaPedidosRefaccionesRefacciones != strUltimaBusquedaPedidosRefaccionesRefacciones)
			{
				intPaginaPedidosRefaccionesRefacciones = 0;
				strUltimaBusquedaPedidosRefaccionesRefacciones = strNuevaBusquedaPedidosRefaccionesRefacciones;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/pedidos_refacciones/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_pedidos_refacciones_refacciones').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_pedidos_refacciones_refacciones').val()),
					 intProspectoID: $('#txtProspectoIDBusq_pedidos_refacciones_refacciones').val(),
					 strEstatus: $('#cmbEstatusBusq_pedidos_refacciones_refacciones').val(),
					 strBusqueda:    $('#txtBusqueda_pedidos_refacciones_refacciones').val(),
					 intPagina: intPaginaPedidosRefaccionesRefacciones,
					 strPermisosAcceso: $('#txtAcciones_pedidos_refacciones_refacciones').val()
					},
					function(data){
						$('#dg_pedidos_refacciones_refacciones tbody').empty();
						var tmpPedidosRefaccionesRefacciones = Mustache.render($('#plantilla_pedidos_refacciones_refacciones').html(),data);
						$('#dg_pedidos_refacciones_refacciones tbody').html(tmpPedidosRefaccionesRefacciones);
						$('#pagLinks_pedidos_refacciones_refacciones').html(data.paginacion);
						$('#numElementos_pedidos_refacciones_refacciones').html(data.total_rows);
						intPaginaPedidosRefaccionesRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_pedidos_refacciones_refacciones(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/pedidos_refacciones/';

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
			if ($('#chbImprimirDetalles_pedidos_refacciones_refacciones').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_pedidos_refacciones_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_pedidos_refacciones_refacciones').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_pedidos_refacciones_refacciones').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_pedidos_refacciones_refacciones').val()),
										'intProspectoID': $('#txtProspectoIDBusq_pedidos_refacciones_refacciones').val(),
										'strEstatus': $('#cmbEstatusBusq_pedidos_refacciones_refacciones').val(), 
										'strBusqueda': $('#txtBusqueda_pedidos_refacciones_refacciones').val(),
										'strDetalles': $('#chbImprimirDetalles_pedidos_refacciones_refacciones').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_pedidos_refacciones_refacciones(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtPedidoRefaccionesID_pedidos_refacciones_refacciones').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'refacciones/pedidos_refacciones/get_reporte_registro',
							'data' : {
										'intPedidoRefaccionesID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_pedidos_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_pedidos_refacciones_refacciones').empty();
					var temp = Mustache.render($('#monedas_pedidos_refacciones_refacciones').html(), data);
					$('#cmbMonedaID_pedidos_refacciones_refacciones').html(temp);
				},
				'json');
		}

		
		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_prospecto_pedidos_refacciones_refacciones()
		{
			//Incializar formulario
			$('#frmEnviarPedidosRefaccionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_prospecto_pedidos_refacciones_refacciones();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_prospecto_pedidos_refacciones_refacciones');
		}

		//Función que se utiliza para abrir el modal
		function abrir_prospecto_pedidos_refacciones_refacciones(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_prospecto_pedidos_refacciones_refacciones();
			//Variables que se utilizan para asignar los datos del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtPedidoRefaccionesID_pedidos_refacciones_refacciones').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/pedidos_refacciones/get_datos',
			       {intPedidoRefaccionesID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtPedidoRefaccionesID_prospecto_pedidos_refacciones_refacciones').val(data.row.pedido_refacciones_id);
							$('#txtProspecto_prospecto_pedidos_refacciones_refacciones').val(data.row.prospecto);
							$('#txtCorreoElectronico_prospecto_pedidos_refacciones_refacciones').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_prospecto_pedidos_refacciones_refacciones').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_prospecto_pedidos_refacciones_refacciones').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarPedidosRefaccionesRefacciones = $('#EnviarPedidosRefaccionesRefaccionesBox').bPopup({
																   appendTo: '#PedidosRefaccionesRefaccionesContent', 
										                           contentContainer: 'PedidosRefaccionesRefaccionesM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_prospecto_pedidos_refacciones_refacciones').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_prospecto_pedidos_refacciones_refacciones()
		{
			try {
				//Cerrar modal
				objEnviarPedidosRefaccionesRefacciones.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
				ocultar_circulo_carga_prospecto_pedidos_refacciones_refacciones();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_prospecto_pedidos_refacciones_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_prospecto_pedidos_refacciones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarPedidosRefaccionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_prospecto_pedidos_refacciones_refacciones: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_prospecto_pedidos_refacciones_refacciones: {
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
			var bootstrapValidator_prospecto_pedidos_refacciones_refacciones = $('#frmEnviarPedidosRefaccionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_prospecto_pedidos_refacciones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_prospecto_pedidos_refacciones_refacciones.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_prospecto_pedidos_refacciones_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_prospecto_pedidos_refacciones_refacciones()
		{
			try
			{
				$('#frmEnviarPedidosRefaccionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al prospecto
		function enviar_correo_prospecto_pedidos_refacciones_refacciones()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_prospecto_pedidos_refacciones_refacciones();
			//Hacer un llamado al método del controlador para enviar correo electrónico al prospecto
			$.post('refacciones/pedidos_refacciones/enviar_correo_electronico_prospecto',
					{ 
						intPedidoRefaccionesID: $('#txtPedidoRefaccionesID_prospecto_pedidos_refacciones_refacciones').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_prospecto_pedidos_refacciones_refacciones').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_prospecto_pedidos_refacciones_refacciones').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_prospecto_pedidos_refacciones_refacciones();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_prospecto_pedidos_refacciones_refacciones();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_pedidos_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_prospecto_pedidos_refacciones_refacciones()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_prospecto_pedidos_refacciones_refacciones").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_prospecto_pedidos_refacciones_refacciones()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_prospecto_pedidos_refacciones_refacciones").addClass('no-mostrar');
		}

		/*******************************************************************************************************************
		Funciones del modal Pedidos
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_pedidos_refacciones_refacciones(tipoAccion)
		{
			//Incializar formulario
			$('#frmPedidosRefaccionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_pedidos_refacciones_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmPedidosRefaccionesRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_pedidos_refacciones_refacciones');
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
			inicializar_detalles_pedidos_refacciones_refacciones();
			//Si el tipo de acción corresponde a Nuevo
			if(tipoAccion == 'Nuevo')
			{
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_pedidos_refacciones_refacciones').addClass("estatus-NUEVO");
			}
			//Habilitar todos los elementos del formulario
			$('#frmPedidosRefaccionesRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_pedidos_refacciones_refacciones').val(fechaActual());
			
			//Deshabilitar las siguientes cajas de texto			
			data  = {
						//Son los id de los input que quiero deshabilitar
						rows: [						
							'#txtFolio_pedidos_refacciones_refacciones',					
							'#txtReferencia_detalles_pedidos_refacciones_refacciones',
							'#txtCantidad_detalles_pedidos_refacciones_refacciones',
							'#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones',
							'#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones',
							'#txtPorcentajeIva_detalles_pedidos_refacciones_refacciones',
							'#txtPorcentajeIeps_detalles_pedidos_refacciones_refacciones'
						],
						//Es asignar un attributo disbaled|checked
						attribute: 'disabled',
						//Bool es para deshabilitar
						bool: true
					};
			//La function para disable el input porque les estamos mando un true		
			$.habilitar_deshabilitar_campos(data);

			//Mostrar los siguientes botones
			$('#btnGuardar_pedidos_refacciones_refacciones').show();
			$('#btnReiniciar_pedidos_refacciones_refacciones').show();
			//Habilitar botón Agregar
			$('#btnAgregar_pedidos_refacciones_refacciones').prop('disabled', false);
			//Ocultar los siguientes botones
			$('#btnEnviarCorreo_pedidos_refacciones_refacciones').hide();
			$('#btnImprimirRegistro_pedidos_refacciones_refacciones').hide();
			$('#btnDesactivar_pedidos_refacciones_refacciones').hide();
		}
		

		//Función para deshabilitar controles del formulario y así evitar modificar datos correspondientes a la cotización
		function deshabilitar_controles_pedidos_refacciones_refacciones()
		{
			//Deshabilitar los siguientes controles
			$('#cmbMonedaID_pedidos_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtProspecto_pedidos_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtVendedor_pedidos_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtGastosPaqueteria_pedidos_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtEstrategia_pedidos_refacciones_refacciones').attr('disabled','disabled');
		    $('#cmbTipo_pedidos_refacciones_refacciones').attr('disabled','disabled');
		    //Deshabilitar botón Agregar
		    $('#btnAgregar_pedidos_refacciones_refacciones').prop('disabled', true); 
		    $('#txtReferencia_detalles_pedidos_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtCantidad_detalles_pedidos_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtPorcentajeIva_detalles_pedidos_refacciones_refacciones').attr('disabled','disabled');
		    $('#txtPorcentajeIeps_detalles_pedidos_refacciones_refacciones').attr('disabled','disabled');
		}


	    //Función para habilitar elementos de la moneda
		function habilitar_moneda_pedidos_refacciones_refacciones()
		{
			//Habilitar los siguientes controles del formulario
			$('#txtTipoCambio_pedidos_refacciones_refacciones').removeAttr('disabled');
		    $('#cmbMonedaID_pedidos_refacciones_refacciones').removeAttr('disabled');
		    $('#cmbMonedaID_pedidos_refacciones_refacciones').val(intMonedaBaseIDPedidosRefaccionesRefacciones);
            //Asignar el tipo de cambio correspondiente a la moneda peso mexicano
			$('#txtTipoCambio_pedidos_refacciones_refacciones').val(intTipoCambioMonedaBasePedidosRefaccionesRefacciones);
			//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
			$('#txtTipoCambio_pedidos_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
			//Deshabilitar caja de texto
	   	    $('#txtTipoCambio_pedidos_refacciones_refacciones').attr('disabled','disabled');
		}

		//Función para inicializar elementos del anticipo
		function inicializar_anticipo_pedidos_refacciones_refacciones()
		{	
		    //Limpiar contenido de las siguientes cajas de texto
		    $("#txtSaldoAnticipo_pedidos_refacciones_refacciones").val('');

		    //Si no existe id de la cotización
		    if($("#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones").val() == '')
		    {
		    	//Limpiar contenido de las siguientes cajas de texto
		    	$("#txtProspectoID_pedidos_refacciones_refacciones").val('');
		    	$("#txtProspecto_pedidos_refacciones_refacciones").val('');
		    	//Habilitar caja de texto
				$('#txtProspecto_pedidos_refacciones_refacciones').removeAttr('disabled');

				//Hacer un llamado a la función para inicializar elementos del prospecto
	            inicializar_prospecto_pedidos_refacciones_refacciones();

		    	//Hacer un llamado a la función para inicializar elementos de la moneda
				habilitar_moneda_pedidos_refacciones_refacciones();
		    }
		    else
		    {	
		    	//Hacer un llamado a la función para asignar el tipo de cambio de la cotización
		    	get_tipo_cambio_cotizacion_pedidos_refacciones_refacciones();
		    }
		    
		}

		//Función para regresar el tipo de cambio de la cotización
		function get_tipo_cambio_cotizacion_pedidos_refacciones_refacciones()
		{

			//Si existe id de la cotización
		    if($("#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones").val() != '')
		    {
				//Si la moneda no corresponde a peso mexicano
		    	if(parseInt($('#cmbMonedaID_pedidos_refacciones_refacciones').val()) !== intMonedaBaseIDPedidosRefaccionesRefacciones)
		    	{

		    		//Variables que se utilizan para asignar el tipo de cambio de la cotización
		    		$("#txtTipoCambio_pedidos_refacciones_refacciones").val(document.getElementById('txtTipoCambio_cotizacion_pedidos_refacciones_refacciones').value);
		    	}
		    }
		}


		//Función para inicializar elementos de la cotización
		function inicializar_cotizacion_pedidos_refacciones_refacciones()
		{

			//Si no existe id del anticipo
		    if($("#txtAnticipoID_pedidos_refacciones_refacciones").val() == '')
		    {
				//Limpiar contenido de las siguientes cajas de texto
				$('#txtProspectoID_pedidos_refacciones_refacciones').val('');
				$("#txtProspecto_pedidos_refacciones_refacciones").val('');
				//Habilitar caja de texto
				$('#txtProspecto_pedidos_refacciones_refacciones').removeAttr('disabled');
		    	//Hacer un llamado a la función para inicializar elementos del prospecto
	            inicializar_prospecto_pedidos_refacciones_refacciones();
	            //Hacer un llamado a la función para inicializar elementos de la moneda
				habilitar_moneda_pedidos_refacciones_refacciones();
		    }


		    //Limpiar contenido de las siguientes cajas de texto
		    $('#txtTipoCambio_cotizacion_pedidos_refacciones_refacciones').val('');
            $('#txtVendedorID_pedidos_refacciones_refacciones').val('');
            $('#txtVendedor_pedidos_refacciones_refacciones').val('');
            $('#txtEstrategiaID_pedidos_refacciones_refacciones').val('');
            $('#txtEstrategia_pedidos_refacciones_refacciones').val('');
            $('#cmbTipo_pedidos_refacciones_refacciones').val('');
            $('#txtGastosPaqueteria_pedidos_refacciones_refacciones').val('');
            $('#txtGastosPaqueteriaSubtotal_pedidos_refacciones_refacciones').val('');
            $('#txtGastosPaqueteriaIva_pedidos_refacciones_refacciones').val('');
            $('#txtObservaciones_pedidos_refacciones_refacciones').val('');
			$('#txtNotas_pedidos_refacciones_refacciones').val('');

            ///Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_pedidos_refacciones_refacciones();
		     //Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
			habilitar_elementos_tipo_cambio_detalles_pedidos_refacciones_refacciones('#txtProspectoID_pedidos_refacciones_refacciones');

		    //Habilitar botón Agregar
			$('#btnAgregar_pedidos_refacciones_refacciones').prop('disabled', false);	
            //Habilitar los siguientes controles
		    $('#txtVendedor_pedidos_refacciones_refacciones').removeAttr('disabled');
		    $('#txtEstrategia_pedidos_refacciones_refacciones').removeAttr('disabled');
		    $('#cmbTipo_pedidos_refacciones_refacciones').removeAttr('disabled');
		    $('#txtGastosPaqueteria_pedidos_refacciones_refacciones').removeAttr('disabled');
		}

		//Función para inicializar elementos del prospecto
		function inicializar_prospecto_pedidos_refacciones_refacciones()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$("#txtRefaccionesListaPrecioID_pedidos_refacciones_refacciones").val('');
			//Hacer un llamado a la función para inicializar elementos de las tablas detalles
		    inicializar_detalles_pedidos_refacciones_refacciones();
		    //Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
			habilitar_elementos_tipo_cambio_detalles_pedidos_refacciones_refacciones('#txtProspectoID_pedidos_refacciones_refacciones');
		
		}

		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_pedidos_refacciones_refacciones()
		{

			//Hacer un llamado a la función para inicializar elementos de la refacción (detalle)
		    inicializar_detalle_pedidos_refacciones_refacciones();

			//Eliminar los datos de la tabla detalles del pedido
		    $('#dg_detalles_pedidos_refacciones_refacciones tbody').empty();
		    $('#acumCantidad_detalles_pedidos_refacciones_refacciones').html('');
		    $('#acumDescuento_detalles_pedidos_refacciones_refacciones').html('');
		    $('#acumSubtotal_detalles_pedidos_refacciones_refacciones').html('');
		    $('#acumIva_detalles_pedidos_refacciones_refacciones').html('');
		    $('#acumIeps_detalles_pedidos_refacciones_refacciones').html('');
		    $('#acumTotal_detalles_pedidos_refacciones_refacciones').html('');
			$('#numElementos_detalles_pedidos_refacciones_refacciones').html(0);
			$('#txtNumDetalles_pedidos_refacciones_refacciones').val('');
		}


		//Función que se utiliza para cerrar el modal
		function cerrar_pedidos_refacciones_refacciones()
		{
			try {

				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
				cerrar_prospecto_pedidos_refacciones_refacciones();
				//Cerrar modal
				objPedidosRefaccionesRefacciones.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_pedidos_refacciones_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_pedidos_refacciones_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_pedidos_refacciones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmPedidosRefaccionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_pedidos_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intMonedaID_pedidos_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_pedidos_refacciones_refacciones: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_pedidos_refacciones_refacciones').val()) !== intMonedaBaseIDPedidosRefaccionesRefacciones)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoPedidosRefaccionesRefacciones)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoPedidosRefaccionesRefacciones
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strAnticipo_pedidos_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del anticipo
					                                    if(value !== '' && $('#txtAnticipoID_pedidos_refacciones_refacciones').val() === '')
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
										strCotizacionRefacciones_pedidos_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la cotización
					                                    if(value !== '' && $('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val() === '')
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
										strTipo_pedidos_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										},
										strProspecto_pedidos_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del prospecto/cliente
					                                    if($('#txtProspectoID_pedidos_refacciones_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un prospecto o cliente existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strVendedor_pedidos_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vendedor
					                                    if($('#txtVendedorID_pedidos_refacciones_refacciones').val() === '')
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
										strEstrategia_pedidos_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la estrategia
					                                    if($('#txtEstrategiaID_pedidos_refacciones_refacciones').val() === '')
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
										intNumDetalles_pedidos_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para este pedido.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strReferencia_detalles_pedidos_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_detalles_pedidos_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_detalles_pedidos_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_detalles_pedidos_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_detalles_pedidos_refacciones_refacciones: {
											excluded: true  //Ignorar (no valida el campo)
										},
										intPorcentajeIeps_detalles_pedidos_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_pedidos_refacciones_refacciones = $('#frmPedidosRefaccionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_pedidos_refacciones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_pedidos_refacciones_refacciones.isValid())
			{
			
				//Hacer un llamado a la función para validar que los detalles cuenten con cantidad y precio unitario
				validar_detalles_pedidos_refacciones_refacciones();
				
			}
			else 
				return;
		}

		//Función que se utiliza para validar que los detalles cuenten con cantidad y precio unitario
		function validar_detalles_pedidos_refacciones_refacciones()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_pedidos_refacciones_refacciones').getElementsByTagName('tbody')[0];

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
				//Concatenar los datos de la referencia
				var strReferencia = strCodigo+' - '+strDescripcion;

				//Si la cantidad es mayor que la existencia disponible o el precio unitario es igual a cero
				if((intCantidad == 0) || (intPrecioUnitario == 0))
				{
					//Agregar refacción en el array, de esta manera, el usuario identificara las refacciones incorrectas
					arrDetallesIncorrectos.push(strReferencia);
				}
			}

			//Variable que se utiliza para guardar datos del registro
			var strGuardar = 'SI';

			//Si existe id del anticipo
			if($('#txtAnticipoID_pedidos_refacciones_refacciones').val() != '')
			{
				//Variable que se utiliza para asignar el importe total del pedido
				var intTotalPedido = 0;
				//Variable que se utiliza para asignar los gastos de paquetería
				var intGastosPaqueteria = $('#txtGastosPaqueteria_pedidos_refacciones_refacciones').val();

				//Si existen gastos de paquetería
				if(intGastosPaqueteria != '')
				{

					//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				    intGastosPaqueteria =  parseFloat($.reemplazar($('#txtGastosPaqueteria_pedidos_refacciones_refacciones').val(), ",", ""));

				    //Incrementar importe total
				    intTotalPedido += intGastosPaqueteria;
				}
			
				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesPedidosRefaccionesRefacciones = $.reemplazar($('#acumTotal_detalles_pedidos_refacciones_refacciones').html(), "$", "");

				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesPedidosRefaccionesRefacciones = $.reemplazar(intAcumTotalDetallesPedidosRefaccionesRefacciones, ",", "");

				//Incrementar importe total
				intTotalPedido += parseFloat(intAcumTotalDetallesPedidosRefaccionesRefacciones);


				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intSaldoAnticipo = parseFloat($.reemplazar($('#txtSaldoAnticipo_pedidos_refacciones_refacciones').val(), ",", ""));

				//Verificar que el total sea menor al saldo del anticipo
				if(intTotalPedido > intSaldoAnticipo)
				{
					//Cambiar cantidad a formato moneda
					intSaldoAnticipo = formatMoney(intSaldoAnticipo, 2, '');

					/*Mensaje que se utiliza para informar al usuario que el total del pedido no debe ser mayor que el saldo del anticipo que hace falta aplicar*/
					var strMensaje = 'El pedido sobrepasa el saldo del anticipo.';
						strMensaje += '<br>Saldo restante: <b>'+intSaldoAnticipo+'</b>';

				    //Asignar NO para evitar guardar los datos del registro
					strGuardar = 'NO';
					
					//Hacer un llamado a la función para mostrar mensaje de información
				    mensaje_pedidos_refacciones_refacciones('error', strMensaje);
				}
			}


			//Si existen refacciones incorrectas
			if(arrDetallesIncorrectos.length > 0)
			{
				//Mensaje que se utiliza para informar al usuario la lista de refacciones incorrectas
				var strMensaje = 'El pedido no puede guardarse. Las siguientes <b>refacciones</b> no tienen precio unitario (0.00) o no tienen cantidad (0.00):<br>';

				//Hacer recorrido para obtener refacciones incorrectas
				for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
				{
					//Agregar refacción en el mensaje
            		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
				}


				//Asignar NO para evitar guardar los datos del registro
				strGuardar = 'NO';


				//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_pedidos_refacciones_refacciones('error', strMensaje);
			}

			//Si se cumplen las reglas de validación
			if(strGuardar == 'SI')
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_pedidos_refacciones_refacciones();
			}


		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_pedidos_refacciones_refacciones()
		{
			try
			{
				$('#frmPedidosRefaccionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_pedidos_refacciones_refacciones()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_pedidos_refacciones_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRefaccionID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCodigosLineas = [];	
			var arrCantidades = [];
			var arrPreciosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrTasaCuotaIva = [];
			var arrIvasUnitarios = [];
			var arrTasaCuotaIeps = [];
			var arrIepsUnitarios = [];
					
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioPedido = parseFloat($('#txtTipoCambio_pedidos_refacciones_refacciones').val());

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
				intPrecioUnitario = intPrecioUnitario * intTipoCambioPedido;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioPedido;
				intIvaUnitario = intIvaUnitario * intTipoCambioPedido;
				intIepsUnitario = intIepsUnitario * intTipoCambioPedido;

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
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrIvasUnitarios.push(intIvaUnitario);
				arrTasaCuotaIva.push(objRen.cells[16].innerHTML);
				arrIepsUnitarios.push(intIepsUnitario );
				arrTasaCuotaIeps.push(objRen.cells[17].innerHTML);
				arrCodigosLineas.push(objRen.cells[18].innerHTML);
				arrPreciosUnitarios.push(intPrecioUnitario);
				
			}

			//Asignar valores del gasto de paquetería
			var intGastosPaqueteriaSubtotalPed = parseFloat($('#txtGastosPaqueteriaSubtotal_pedidos_refacciones_refacciones').val());
			var intGastosPaqueteriaIvaPed = parseFloat($('#txtGastosPaqueteriaIva_pedidos_refacciones_refacciones').val());

			//Convertir importes a peso mexicano
			intGastosPaqueteriaSubtotalPed = intGastosPaqueteriaSubtotalPed * intTipoCambioPedido;
			intGastosPaqueteriaIvaPed = intGastosPaqueteriaIvaPed * intTipoCambioPedido;

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/pedidos_refacciones/guardar',
					{ 
						//Datos del pedido
						intPedidoRefaccionesID: $('#txtPedidoRefaccionesID_pedidos_refacciones_refacciones').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_pedidos_refacciones_refacciones').val()),
						intMonedaID: $('#cmbMonedaID_pedidos_refacciones_refacciones').val(),
						intTipoCambio: intTipoCambioPedido,
						intCotizacionRefaccionesID: $('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val(),
						intVendedorID: $('#txtVendedorID_pedidos_refacciones_refacciones').val(),	
						intEstrategiaID: $('#txtEstrategiaID_pedidos_refacciones_refacciones').val(),
						strTipo: $('#cmbTipo_pedidos_refacciones_refacciones').val(),
						intAnticipoID: $('#txtAnticipoID_pedidos_refacciones_refacciones').val(),
						intProspectoID: $('#txtProspectoID_pedidos_refacciones_refacciones').val(),
						intGastosPaqueteria: intGastosPaqueteriaSubtotalPed,
						intGastosPaqueteriaIva: intGastosPaqueteriaIvaPed,
						strObservaciones: $('#txtObservaciones_pedidos_refacciones_refacciones').val(),
						strNotas: $('#txtNotas_pedidos_refacciones_refacciones').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_pedidos_refacciones_refacciones').val(),
						//Datos de los detalles
						strRefaccionID: arrRefaccionID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
						strCodigosLineas: arrCodigosLineas.join('|'),
						strCantidades: arrCantidades.join('|'),
						strPreciosUnitarios: arrPreciosUnitarios.join('|'),
						strDescuentosUnitarios: arrDescuentosUnitarios.join('|'),
						strTasaCuotaIva: arrTasaCuotaIva.join('|'),
						strIvasUnitarios: arrIvasUnitarios.join('|'),
						strIepsUnitarios: arrIepsUnitarios.join('|'),
						strTasaCuotaIeps: arrTasaCuotaIeps.join('|')
						
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar  los registros en el grid
	               			paginacion_pedidos_refacciones_refacciones(); 
         					//Hacer un llamado a la función para cerrar modal
	                    	cerrar_pedidos_refacciones_refacciones();
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_pedidos_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_pedidos_refacciones_refacciones(tipoMensaje, mensaje, campoID, tipo, campoReferenciaID)
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

												//Si el tipo de campo es una referencia cotización/anticipo
												if(tipo == 'referencia')
												{
													//Limpiar contenido de las siguientes cajas de texto
													$('#'+campoID).val('');
													$('#'+campoReferenciaID).val('');
												}
												
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
		function cambiar_estatus_pedidos_refacciones_refacciones(id,estatus, cotizacionRefaccionesID)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
		    //Variable que se utiliza para asignar el id de la cotización
			var intCotizacionRefaccionesID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtPedidoRefaccionesID_pedidos_refacciones_refacciones').val();
				intCotizacionRefaccionesID = $('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val();

			}
			else
			{
				intID = id;
				intCotizacionRefaccionesID = cotizacionRefaccionesID;
				strTipo = 'gridview';
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
						             {'type':     'question',
						              'title':    'Pedidos',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                             	//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_pedidos_refacciones_refacciones(intID, strTipo, 'INACTIVO', intCotizacionRefaccionesID);
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_pedidos_refacciones_refacciones(intID, strTipo, 'ACTIVO', intCotizacionRefaccionesID);
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_pedidos_refacciones_refacciones(id, tipo, estatus, cotizacionRefaccionesID)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('refacciones/pedidos_refacciones/set_estatus',
			      {intPedidoRefaccionesID: id,
			       strEstatus: estatus, 
			       intCotizacionRefaccionesID: cotizacionRefaccionesID
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_pedidos_refacciones_refacciones();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_pedidos_refacciones_refacciones();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_pedidos_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_pedidos_refacciones_refacciones(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/pedidos_refacciones/get_datos',
			       {intPedidoRefaccionesID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_pedidos_refacciones_refacciones('');
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);
				             //Variable que se utiliza para recuperar los detalles del registro
						    var strTipoDetalles = 'pedido';
						    //Asignar el id de la cotización
				            var intCotizacionRefaccionesID = parseInt(data.row.cotizacion_refacciones_id);
				            //Asignar el saldo del anticipo
				            var intSaldoAnticipo = parseFloat(data.saldo_anticipo); 

				            //Convertir peso mexicano a tipo de cambio
				            intSaldoAnticipo = intSaldoAnticipo / intTipoCambio;

						    //Variables que se utilizan para asignar valores del gasto de paquetería
							var intGastosPaqueteriaSubtotal = parseFloat(data.row.gastos_paqueteria/intTipoCambio);
							var intGastosPaqueteriaIva = parseFloat(data.row.gastos_paqueteria_iva/intTipoCambio);
							//Calcular el importe total del gasto de paquetería
						    var intGastosPaqueteriaTotal = intGastosPaqueteriaSubtotal + intGastosPaqueteriaIva;

						    //Si existe id de la cotización
						    if(intCotizacionRefaccionesID > 0)
						    {
						    	//Cambiar el tipo de detalles para identificar que los detalles corresponde a una cotización y así evitar realizar modificaciones
						    	strTipoDetalles = 'cotizacion';
						    
						    	//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes a la referencia
								deshabilitar_controles_pedidos_refacciones_refacciones();

								//Deshabilitar folio de la cotización
		   						$('#txtCotizacionRefacciones_pedidos_refacciones_refacciones').attr('disabled','disabled');

						    }

				          	//Recuperar valores
				          	$('#txtPedidoRefaccionesID_pedidos_refacciones_refacciones').val(data.row.pedido_refacciones_id);
				          	$('#txtFolio_pedidos_refacciones_refacciones').val(data.row.folio);
				            $('#txtFecha_pedidos_refacciones_refacciones').val(data.row.fecha);
				            $('#cmbMonedaID_pedidos_refacciones_refacciones').val(data.row.moneda_id);
				            $('#txtTipoCambio_pedidos_refacciones_refacciones').val(data.row.tipo_cambio);
				            $('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val(data.row.cotizacion_refacciones_id);
				            $('#txtCotizacionRefacciones_pedidos_refacciones_refacciones').val(data.row.folio_cotizacion);
				            //Asignar el tipo de cambio de la cotización
						    $('#txtTipoCambio_cotizacion_pedidos_refacciones_refacciones').val(data.row.tipo_cambio_cotizacion);
				            $('#txtVendedorID_pedidos_refacciones_refacciones').val(data.row.vendedor_id);
						    $('#txtVendedor_pedidos_refacciones_refacciones').val(data.row.vendedor);
				            $('#txtEstrategiaID_pedidos_refacciones_refacciones').val(data.row.estrategia_id);
						    $('#txtEstrategia_pedidos_refacciones_refacciones').val(data.row.estrategia);
						    $('#cmbTipo_pedidos_refacciones_refacciones').val(data.row.tipo);
				            $('#txtAnticipoID_pedidos_refacciones_refacciones').val(data.row.anticipo_id);
				            $('#txtAnticipo_pedidos_refacciones_refacciones').val(data.row.folio_anticipo);
				            $('#txtSaldoAnticipo_pedidos_refacciones_refacciones').val(intSaldoAnticipo);
				            $('#txtSaldoAnticipo_pedidos_refacciones_refacciones').formatCurrency({roundToDecimalPlace: 2 });
				            $('#txtProspectoID_pedidos_refacciones_refacciones').val(data.row.prospecto_id);
						    $('#txtProspecto_pedidos_refacciones_refacciones').val(data.row.prospecto);
						    $('#txtRefaccionesListaPrecioID_pedidos_refacciones_refacciones').val(data.row.refacciones_lista_precio_id);
						    $('#txtGastosPaqueteriaIva_pedidos_refacciones_refacciones').val(intGastosPaqueteriaIva);
						    $('#txtGastosPaqueteriaSubtotal_pedidos_refacciones_refacciones').val(intGastosPaqueteriaSubtotal);
						    $('#txtGastosPaqueteria_pedidos_refacciones_refacciones').val(intGastosPaqueteriaTotal);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtGastosPaqueteria_pedidos_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
						   
						    $('#txtObservaciones_pedidos_refacciones_refacciones').val(data.row.observaciones);
						    $('#txtNotas_pedidos_refacciones_refacciones').val(data.row.notas);
						   

						    //Hacer un llamado a la función para cargar los detalles del registro en la tabla
				            cargar_detalles_tabla_pedidos_refacciones_refacciones(data.row.tipo_cambio, data.detalles, strTipoDetalles, tipoAccion);

							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_pedidos_refacciones_refacciones').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $('#btnImprimirRegistro_pedidos_refacciones_refacciones').show();
				      
				            //Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmPedidosRefaccionesRefacciones').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $('#btnGuardar_pedidos_refacciones_refacciones').hide();
					            $('#btnReiniciar_pedidos_refacciones_refacciones').hide();
					           
					           //Deshabilitar botón Agregar
								$('#btnAgregar_pedidos_refacciones_refacciones').prop('disabled', true);
				            	
				            }
				            else
				            {
				            	//Mostrar los siguientes botones  
					            $('#btnDesactivar_pedidos_refacciones_refacciones').show();
					            $('#btnEnviarCorreo_pedidos_refacciones_refacciones').show();

				            	//Si se cumple la sentencia
				            	if($('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val() == '' &&  
				            	    $('#txtAnticipoID_pedidos_refacciones_refacciones').val() == '')
				            	{

				            		//Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
									habilitar_elementos_tipo_cambio_detalles_pedidos_refacciones_refacciones('#txtProspectoID_pedidos_refacciones_refacciones');

				            		//Si el id de la moneda no corresponde al peso mexicano
								    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDPedidosRefaccionesRefacciones)
								    {
										//Habilitar caja de texto
										$('#txtTipoCambio_pedidos_refacciones_refacciones').removeAttr('disabled');
								    }
								    else
								    {
								    	//Deshabilitar las siguientes cajas de texto
										$("#txtTipoCambio_pedidos_refacciones_refacciones").attr('disabled','disabled');
								    }

				            	}
				            	else
				            	{
				            		
				            		//Si existe id del anticipo
				            		if($('#txtAnticipoID_pedidos_refacciones_refacciones').val() != '')
				            		{
				            			
				            			//Si no existe id de la cotización
				            			if($('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val() == '')
				            			{

				            				//Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
											habilitar_elementos_tipo_cambio_detalles_pedidos_refacciones_refacciones('#txtProspectoID_pedidos_refacciones_refacciones');
				            			}

				            			//Deshabilitar cajas de texto
				            			$("#cmbMonedaID_pedidos_refacciones_refacciones").attr('disabled','disabled');
				            			$("#txtProspecto_pedidos_refacciones_refacciones").attr('disabled','disabled');

				            		}	

							    	//Deshabilitar caja de texto
									$("#txtTipoCambio_pedidos_refacciones_refacciones").attr('disabled','disabled');
							    
				            	}
				            	
				            }

				           
			            	//Abrir modal
				            objPedidosRefaccionesRefacciones = $('#PedidosRefaccionesRefaccionesBox').bPopup({
														  appendTo: '#PedidosRefaccionesRefaccionesContent', 
							                              contentContainer: 'PedidosRefaccionesRefaccionesM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});
				            

				            //Enfocar caja de texto
							$('#cmbMonedaID_pedidos_refacciones_refacciones').focus();
			       	    }
			       },
			       'json');
		}


		

		//Función para regresar y obtener los datos de una cotización
		function get_datos_cotizacion_pedidos_refacciones_refacciones()
		{

			//Hacer un llamado al método del controlador para regresar los datos de la cotización
            $.post('refacciones/cotizaciones_refacciones/get_datos',
                  { 
                  	intCotizacionRefaccionesID: $('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val()
                  },
                  function(data) {
                    if(data.row)
                    {
                    	//Variable que se utiliza para asignar el tipo de cambio
                    	 var intTipoCambio = parseFloat(data.row.tipo_cambio);
                    	//Hacer un llamado a la función para deshabilitar campos del formulario y así evitar modificar datos correspondientes a la cotización
						deshabilitar_controles_pedidos_refacciones_refacciones();
						//Recuperar valores
						$('#txtCotizacionRefacciones_pedidos_refacciones_refacciones').val(data.row.folio);
						$('#txtTipoCambio_cotizacion_pedidos_refacciones_refacciones').val(data.row.tipo_cambio);
						$('#txtProspectoID_pedidos_refacciones_refacciones').val(data.row.prospecto_id);
 		   				$('#txtProspecto_pedidos_refacciones_refacciones').val(data.row.razon_social);
 		   				$('#txtRefaccionesListaPrecioID_pedidos_refacciones_refacciones').val(data.row.refacciones_lista_precio_id);
 		   				$('#txtVendedorID_pedidos_refacciones_refacciones').val(data.row.vendedor_id);
			 		    $('#txtVendedor_pedidos_refacciones_refacciones').val(data.row.vendedor);
			 		    $('#txtEstrategiaID_pedidos_refacciones_refacciones').val(data.row.estrategia_id);
			 		    $('#txtEstrategia_pedidos_refacciones_refacciones').val(data.row.estrategia);
			 		    $('#cmbTipo_pedidos_refacciones_refacciones').val(data.row.tipo);
			 		    
			 		    //Si no existe id del anticipo
			 		    if($('#txtAnticipoID_pedidos_refacciones_refacciones').val() == '')
			 		    {
	       					//Asignar moneda y tipo de cambio de la cotización
	       					$('#cmbMonedaID_pedidos_refacciones_refacciones').val(data.row.moneda_id);
           					$('#txtTipoCambio_pedidos_refacciones_refacciones').val(data.row.tipo_cambio);
			 		    }

			 		    //Variables que se utilizan para asignar valores del gasto de paqueteríaa
						var intGastosPaqueteriaSubtotal = parseFloat(data.row.gastos_paqueteria/intTipoCambio);
						var intGastosPaqueteriaIva = parseFloat(data.row.gastos_paqueteria_iva/intTipoCambio);
						//Calcular el importe total del gasto de paquetería
					    var intGastosPaqueteriaTotal = intGastosPaqueteriaSubtotal + intGastosPaqueteriaIva;

					    $('#txtGastosPaqueteriaIva_pedidos_refacciones_refacciones').val(intGastosPaqueteriaIva);
					    $('#txtGastosPaqueteriaSubtotal_pedidos_refacciones_refacciones').val(intGastosPaqueteriaSubtotal);
					    $('#txtGastosPaqueteria_pedidos_refacciones_refacciones').val(intGastosPaqueteriaTotal);
					    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
				        $('#txtGastosPaqueteria_pedidos_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });

				        $('#txtObservaciones_pedidos_refacciones_refacciones').val(data.row.observaciones);
						$('#txtNotas_pedidos_refacciones_refacciones').val(data.row.notas);

						//Hacer un llamado a la función para cargar los detalles del registro en la tabla
            			cargar_detalles_tabla_pedidos_refacciones_refacciones(data.row.tipo_cambio, data.detalles, 'cotizacion', '');

                    }
                }
                 ,
                'json');

		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_pedidos_refacciones_refacciones()
		{	

			//Si la moneda no corresponde a peso mexicano y no existe id del anticipo y/o cotización 
			if((parseInt($('#cmbMonedaID_pedidos_refacciones_refacciones').val()) !== intMonedaBaseIDPedidosRefaccionesRefacciones) && $("#txtAnticipoID_pedidos_refacciones_refacciones").val() == '' && $("#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones").val() == '') 
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_pedidos_refacciones_refacciones").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_pedidos_refacciones_refacciones').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_pedidos_refacciones_refacciones').val();
			

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
			                       $("#txtTipoCambio_pedidos_refacciones_refacciones").val(data.row.tipo_cambio_sat);
					  			  
			                    }

					        }
					    });

	              //Hacer un llamado a la función para recalcular los importes y habilitar/deshabilitar campos
	              recalcular_precio_unitario_pedidos_refacciones_refacciones('#txtTipoCambio_pedidos_refacciones_refacciones');
			}
			
		}

		//Función para regresar y obtener los datos de un anticipo
		function get_datos_anticipo_pedidos_refacciones_refacciones()
		{
		 	//Hacer un llamado al método del controlador para regresar los datos del anticipo
            $.post('caja/anticipos/get_datos',
                  { 
                  	intAnticipoID:$("#txtAnticipoID_pedidos_refacciones_refacciones").val()
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
					 		//Variable que se utiliza para mostrar los datos del registro
					 		var strMostrarDatos = 'SI';

					 		//Si existe id de la cotización
					 		if($("#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones").val() != '')
					 		{
					 			//Hacer un llamado a la función para reemplazar '$' por cadena vacia
								var intAcumTotalDetallesPedidosRefaccionesRefacciones = $.reemplazar($('#acumTotal_detalles_pedidos_refacciones_refacciones').html(), "$", "");

								//Hacer un llamado a la función para reemplazar ',' por cadena vacia
								intAcumTotalDetallesPedidosRefaccionesRefacciones = $.reemplazar(intAcumTotalDetallesPedidosRefaccionesRefacciones, ",", "");

								//Verificar que el total sea menor al saldo del anticipo
								if(intAcumTotalDetallesPedidosRefaccionesRefacciones > intTotalAnticipoAplicar)
								{
									//Cambiar cantidad a formato moneda
									var intTotalAnticipoAplicarMoneda = formatMoney(intTotalAnticipoAplicar, 2, '');

									/*Mensaje que se utiliza para informar al usuario que el total de la cotización no debe ser mayor que el saldo del anticipo que hace falta aplicar*/
									var strMensaje = 'La cotización sobrepasa el saldo del anticipo.';
										strMensaje += '<br>Saldo restante: <b>'+intTotalAnticipoAplicarMoneda+'</b>';

								    //Asignar NO para evitar mostrar los datos del registro
									strMostrarDatos = 'NO';
									
									//Hacer un llamado a la función para mostrar mensaje de información
								    mensaje_pedidos_refacciones_refacciones('informacion', strMensaje, 'txtAnticipo_pedidos_refacciones_refacciones', 'referencia', 'txtAnticipoID_pedidos_refacciones_refacciones');
								}


					 		}

					 		//Si se cumple la sentencia
					 		if(strMostrarDatos == 'SI')
					 		{
					 			//Asignar datos del registro seleccionado
		                       $("#txtProspectoID_pedidos_refacciones_refacciones").val(data.row.prospecto_id);
		                       $("#txtProspecto_pedidos_refacciones_refacciones").val(data.row.razon_social);
		                       $("#cmbMonedaID_pedidos_refacciones_refacciones").val(data.row.moneda_id);
		                       $("#txtTipoCambio_pedidos_refacciones_refacciones").val(data.row.tipo_cambio);
		                       $("#txtRefaccionesListaPrecioID_pedidos_refacciones_refacciones").val(data.row.refacciones_lista_precio_id);
		                       
							   $("#txtSaldoAnticipo_pedidos_refacciones_refacciones").val(intTotalAnticipoAplicar);
							   //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
						       $('#txtSaldoAnticipo_pedidos_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
								
							   //Deshabilitar los siguientes controles del formulario
						       $('#txtTipoCambio_pedidos_refacciones_refacciones').attr("disabled", "disabled");
						       $('#cmbMonedaID_pedidos_refacciones_refacciones').attr("disabled", "disabled");
						       $('#txtProspecto_pedidos_refacciones_refacciones').attr("disabled", "disabled");

						       //Si no existe id de la cotización 
						       if($('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val() == '')
						       {
						       		//Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
					 		   		habilitar_elementos_tipo_cambio_detalles_pedidos_refacciones_refacciones('#txtProspectoID_pedidos_refacciones_refacciones');
						       }
						      
					 		}

					 	}
					 	else
					 	{
					 		//Asignar folio del anticipo que se desea aplicar
					 		var strFolioAnticipo = $('#txtAnticipo_pedidos_refacciones_refacciones').val();
					 		/*Mensaje que se utiliza para informar al usuario que el subtotal no se puede aplicar el anticipo*/
							var strMensaje = 'El anticipo: '+strFolioAnticipo+' ya ha sido aplicado.';


							//Hacer un llamado a la función para mostrar mensaje de información
							mensaje_pedidos_refacciones_refacciones('informacion', strMensaje, 'txtAnticipo_pedidos_refacciones_refacciones', 'referencia', 'txtAnticipoID_pedidos_refacciones_refacciones');
					 	}
                      
                    }
                  }
                 ,
                'json');

		}


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_pedidos_refacciones_refacciones(tipoReferencia)
		{
	   		//Si el tipo de referencia corresponde a una refacción
			if(tipoReferencia == 'REFACCION')
			{			
	   			//Habilitar las siguientes cajas de texto
		    	//$('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').removeAttr('disabled');
		    	$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').removeAttr('disabled');
			}

			//Habilitar las siguientes cajas de texto
			$('#txtReferencia_detalles_pedidos_refacciones_refacciones').removeAttr('disabled');
		    $('#txtCantidad_detalles_pedidos_refacciones_refacciones').removeAttr('disabled');

		    //Limpiar las siguientes cajas de texto
		    $('#txtTipoReferencia_detalles_pedidos_refacciones_refacciones').val('');
            $('#txtCodigo_detalles_pedidos_refacciones_refacciones').val('');
            $('#txtDescripcion_detalles_pedidos_refacciones_refacciones').val('');
            $('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').val('');
            $('#txtPrecioRefaccion_detalles_pedidos_refacciones_refacciones').val('');
            $('#txtTipoCambioRefaccion_detalles_pedidos_refacciones_refacciones').val('');
            $('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').val('0.00');
            $('#txtPorcentajeIva_detalles_pedidos_refacciones_refacciones').val('');
            $('#txtPorcentajeIeps_detalles_pedidos_refacciones_refacciones').val('');
            $('#txtTasaCuotaIva_detalles_pedidos_refacciones_refacciones').val('');
			$('#txtTasaCuotaIeps_detalles_pedidos_refacciones_refacciones').val('');
            $('#txtCantidad_detalles_pedidos_refacciones_refacciones').val('');
		}


		//Función para regresar obtener los datos de una refacción
		function get_datos_refaccion_detalles_pedidos_refacciones_refacciones(porcentajePromocion)
		{

			//Hacer un llamado al método del controlador para regresar los datos de la refacción
           	$.post('refacciones/refacciones/get_datos',
                  { 
                  	strBusqueda: $('#txtReferenciaID_detalles_pedidos_refacciones_refacciones').val(),
		       		strTipo: 'id',
		       		intRefaccionesListaPrecioID: $('#txtRefaccionesListaPrecioID_pedidos_refacciones_refacciones').val(),
		       		//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día 
	    			dteFechaTipoCambio: $.formatFechaMysql($('#txtFecha_pedidos_refacciones_refacciones').val()), 
	    			//Regresar el precio que le corresponde al cliente
			       	strListaPrecioCte: 'SI'
                  },
                  function(data) {
                    if(data.row){

                       	$('#txtCodigo_detalles_pedidos_refacciones_refacciones').val(data.row.codigo_01);
                       	$('#txtCodigoLinea_detalles_pedidos_refacciones_refacciones').val(data.row.codigo_linea);
                       	$('#txtDescripcion_detalles_pedidos_refacciones_refacciones').val(data.row.descripcion);
                       	$('#txtPrecioRefaccion_detalles_pedidos_refacciones_refacciones').val(data.row.precio);
                      	$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').val(porcentajePromocion);
        				//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
		    			$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });

		    			$('#txtTasaCuotaIva_detalles_pedidos_refacciones_refacciones').val(data.row.tasa_cuota_iva);
                       	$('#txtPorcentajeIva_detalles_pedidos_refacciones_refacciones').val(data.row.porcentaje_iva);
                       	$('#txtTasaCuotaIeps_detalles_pedidos_refacciones_refacciones').val(data.row.tasa_cuota_ieps);
                       	$('#txtPorcentajeIeps_detalles_pedidos_refacciones_refacciones').val(data.row.porcentaje_ieps);
                       
                       	$('#txtTipoCambio_detalles_pedidos_refacciones_refacciones').val(data.row.tipo_cambio_venta);
                       	//Hacer un llamado a la función para calcular el precio unitario
				  	   	calcular_precio_unitario_detalles_pedidos_refacciones_refacciones();
                       	//Enfocar caja de texto
                  	   	$('#txtCantidad_detalles_pedidos_refacciones_refacciones').focus();
                    }
                  }
                 ,
                'json');
		}

		//Función para cargar los detalles de la cotización o del pedido en la tabla 
		function cargar_detalles_tabla_pedidos_refacciones_refacciones(tipoCambio, arrDetalles, tipoRegistro, tipoAccion)
		{
			//Variable que se utiliza para asignar las acciones del grid view
			var strAccionesTablaDetalles = '';
			//Variable que se utiliza para asignar el tipo de cambio
            var intTipoCambio = parseFloat(tipoCambio);

            //Si se cumple la sentencia
            if(tipoAccion == 'Editar')
            {
	            //Asignar las acciones del grid view
	            strAccionesTablaDetalles = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_pedidos_refacciones_refacciones(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_pedidos_refacciones_refacciones(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
			}

            //Si los detalles corresponden a una cotización
            if(tipoRegistro == 'cotizacion')
            {
            	//Limpiar acciones del grid view
				strAccionesTablaDetalles = '';
            }

           	//Mostramos los detalles del registro
           	for (var intCon in arrDetalles) 
            {
            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_detalles_pedidos_refacciones_refacciones').getElementsByTagName('tbody')[0];

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
				var objCeldaTasaCuotaIva = objRenglon.insertCell(16);
				var objCeldaTasaCuotaIeps = objRenglon.insertCell(17);
				var objCeldaCodigoLinea = objRenglon.insertCell(18);


				//Variables que se utilizan para asignar valores del detalle
				var intSubtotal = parseFloat(arrDetalles[intCon].precio_unitario);
				var intCantidad =  parseFloat(arrDetalles[intCon].cantidad);
				var intPrecioUnitario = parseFloat(arrDetalles[intCon].precio_unitario);
				var intDescuentoUnitario = parseFloat(arrDetalles[intCon].descuento_unitario);
				var intIvaUnitario = parseFloat(arrDetalles[intCon].iva_unitario);
				var intIepsUnitario = parseFloat(arrDetalles[intCon].ieps_unitario);
				var intPrecioRefaccion = 0;

				var intImporteIva = 0;
				var intImporteIeps = 0;
				var intPorcentajeDescuento = 0;
				var intPorcentajeIeps = '';
				var intTotal = 0;
				//Variable que se utiliza para asignar  el color de fondo del registro
				var strEstiloRegistro = '';

				
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

				//Asignar valores
				objRenglon.setAttribute('class', 'movil');
				objRenglon.setAttribute('id', arrDetalles[intCon].refaccion_id);
				objCeldaCodigo.setAttribute('class', 'movil b1 '+strEstiloRegistro);
				objCeldaCodigo.innerHTML = arrDetalles[intCon].codigo;
				objCeldaDescripcion.setAttribute('class', 'movil b2 '+strEstiloRegistro);
				objCeldaDescripcion.innerHTML = arrDetalles[intCon].descripcion;
				objCeldaCantidad.setAttribute('class', 'movil b3 '+strEstiloRegistro);
				objCeldaCantidad.innerHTML = intCantidad;
				objCeldaPrecioUnitario.setAttribute('class', 'movil b4 '+strEstiloRegistro);
				objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
				objCeldaDescuentoUnitario.setAttribute('class', 'movil b5 '+strEstiloRegistro);
				objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
				objCeldaSubtotal.setAttribute('class', 'movil b6 '+strEstiloRegistro);
				objCeldaSubtotal.innerHTML = intSubtotal;
				objCeldaIvaUnitario.setAttribute('class', 'movil b7 '+strEstiloRegistro);
				objCeldaIvaUnitario.innerHTML = intImporteIva;
				objCeldaIepsUnitario.setAttribute('class', 'movil b8 '+strEstiloRegistro);
				objCeldaIepsUnitario.innerHTML = intImporteIeps;
				objCeldaTotal.setAttribute('class', 'movil b9 '+strEstiloRegistro);
				objCeldaTotal.innerHTML = intTotal;
				objCeldaAcciones.setAttribute('class', 'td-center movil b10 '+strEstiloRegistro);
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
                objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
                objCeldaTasaCuotaIva.innerHTML = arrDetalles[intCon].tasa_cuota_iva;
                objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
                objCeldaTasaCuotaIeps.innerHTML = arrDetalles[intCon].tasa_cuota_ieps;
                objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
				objCeldaCodigoLinea.innerHTML = arrDetalles[intCon].codigo_linea;
            }

            //Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_pedidos_refacciones_refacciones();
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $('#dg_detalles_pedidos_refacciones_refacciones tr').length - 2;
			$('#numElementos_detalles_pedidos_refacciones_refacciones').html(intFilas);
			$('#txtNumDetalles_pedidos_refacciones_refacciones').val(intFilas);
		}


		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_pedidos_refacciones_refacciones()
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
			var intReferenciaID = $('#txtReferenciaID_detalles_pedidos_refacciones_refacciones').val();
			var strReferencia = $('#txtReferencia_detalles_pedidos_refacciones_refacciones').val();
			var strTipoReferencia = $('#txtTipoReferencia_detalles_pedidos_refacciones_refacciones').val();
			var strCodigo = $('#txtCodigo_detalles_pedidos_refacciones_refacciones').val();
			var strCodigoLinea = $('#txtCodigoLinea_detalles_pedidos_refacciones_refacciones').val();
			var strDescripcion = $('#txtDescripcion_detalles_pedidos_refacciones_refacciones').val();
			var intCantidad = $('#txtCantidad_detalles_pedidos_refacciones_refacciones').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').val();			
			var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_pedidos_refacciones_refacciones').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_pedidos_refacciones_refacciones').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_pedidos_refacciones_refacciones').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_pedidos_refacciones_refacciones').val();
			var intTipoCambio = $('#txtTipoCambio_detalles_pedidos_refacciones_refacciones').val();
			var intPrecioRefaccion = $('#txtPrecioRefaccion_detalles_pedidos_refacciones_refacciones').val();
			
			//Variable que se utiliza para asignar el tipo de cambio de la requisición
			var intTipoCambioPedido = parseFloat($('#txtTipoCambio_pedidos_refacciones_refacciones').val());
			//Variable que se utiliza para asignar el tipo de cambio de la refacción
			var intMonedaIDPedido =  parseFloat($('#cmbMonedaID_pedidos_refacciones_refacciones').val());

			//Variable que se utiliza para asignar el mensaje informativo
		    var strMensaje = 'No es posible agregar la refacción porque'; 

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_pedidos_refacciones_refacciones').getElementsByTagName('tbody')[0];

			
			//Dependiendo del tipo de referencia validar los campos obligatorios
			if($('#txtTipoReferencia_detalles_pedidos_refacciones_refacciones').val() == 'REFACCION')
			{
    	
				//Validamos que se capturaron datos
				if (intReferenciaID == '' || strReferencia == '')
				{
					//Enfocar caja de texto
					$('#txtReferencia_detalles_pedidos_refacciones_refacciones').focus();
				}
				else if (intCantidad == '' || intCantidad <= 0)
				{
					//Enfocar caja de texto
					$('#txtCantidad_detalles_pedidos_refacciones_refacciones').val('');
					$('#txtCantidad_detalles_pedidos_refacciones_refacciones').focus();
				}
				else if (intPrecioUnitario == '' || intPrecioUnitario <= 0)
				{
					//Concatenar mensaje de validación
					strMensaje += ' no tiene un precio establecido.';

					//Hacer un llamado a la función para mostrar mensaje de información
                	mensaje_cotizaciones_refacciones_refacciones('informacion', strMensaje,'txtPrecioUnitario_detalles_pedidos_refacciones_refacciones');

				}
				else if (intPorcentajeDescuento == '')
				{
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').focus();
				}
				else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
				{
					//Limpiar caja de texto
					$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').val('');
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').focus();
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
					$('#txtReferencia_detalles_pedidos_refacciones_refacciones').focus();
				}
				else if (intPorcentajeDescuento == '')
				{
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').focus();
				}
				else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
				{
					//Limpiar caja de texto
					$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').val('');
					//Enfocar caja de texto
					$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').focus();
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
				

			    //Si el tipo de referencia no corresponde a una refacción
				if(strTipoReferencia != 'REFACCION')
				{

					//Hacer un llamado a la función para inicializar elementos del detalle
					inicializar_detalle_pedidos_refacciones_refacciones();

					//Hacer un llamado a la función para obtener las refacciones de la referencia
					lista_refacciones_referencia_detalles_pedidos_refacciones_refacciones (intPorcentajeDescuento, intReferenciaID, strTipoReferencia, intCantidad);
				}
				else
				{

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

					//Si el precio es mayor que cero
					if(intSubtotal > 0)
					{

						//Hacer un llamado a la función para inicializar elementos del detalle
						inicializar_detalle_pedidos_refacciones_refacciones();

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
							objTabla.rows.namedItem(intReferenciaID).cells[16].innerHTML = intTasaCuotaIva;
							objTabla.rows.namedItem(intReferenciaID).cells[17].innerHTML = intTasaCuotaIeps;
							objTabla.rows.namedItem(intReferenciaID).cells[18].innerHTML = strCodigoLinea;
							
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
							var objCeldaTasaCuotaIva = objRenglon.insertCell(16);
							var objCeldaTasaCuotaIeps = objRenglon.insertCell(17);
							var objCeldaCodigoLinea = objRenglon.insertCell(18);

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', intReferenciaID);
							objCeldaCodigo.setAttribute('class', 'movil b1');
							objCeldaCodigo.innerHTML = strCodigo;
							objCeldaDescripcion.setAttribute('class', 'movil b2');
							objCeldaDescripcion.innerHTML = strDescripcion;
							objCeldaCantidad.setAttribute('class', 'movil b3');
							objCeldaCantidad.innerHTML = intCantidad;
							objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
							objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
							objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
							objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
							objCeldaSubtotal.setAttribute('class', 'movil b6');
							objCeldaSubtotal.innerHTML = intSubtotal;
							objCeldaIvaUnitario.setAttribute('class', 'movil b7');
							objCeldaIvaUnitario.innerHTML = intImporteIva;
							objCeldaIepsUnitario.setAttribute('class', 'movil b8');
							objCeldaIepsUnitario.innerHTML = intImporteIeps;
							objCeldaTotal.setAttribute('class', 'movil b9');
							objCeldaTotal.innerHTML = intTotal;
							objCeldaAcciones.setAttribute('class', 'td-center movil b10');
							objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
														 " onclick='editar_renglon_detalles_pedidos_refacciones_refacciones(this)'>" + 
														 "<span class='glyphicon glyphicon-edit'></span></button>" + 
														 "<button class='btn btn-default btn-xs' title='Eliminar'" +
														 " onclick='eliminar_renglon_detalles_pedidos_refacciones_refacciones(this)'>" + 
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
	                        objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
							objCeldaTasaCuotaIva.innerHTML = intTasaCuotaIva;
							objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
							objCeldaTasaCuotaIeps.innerHTML =  intTasaCuotaIeps;
							objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
							objCeldaCodigoLinea.innerHTML =  strCodigoLinea;

						}

						//Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_pedidos_refacciones_refacciones();
						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $('#dg_detalles_pedidos_refacciones_refacciones tr').length - 2;
						$('#numElementos_detalles_pedidos_refacciones_refacciones').html(intFilas);
						$('#txtNumDetalles_pedidos_refacciones_refacciones').val(intFilas);
						//Enfocar caja de texto
					    $('#txtReferencia_detalles_pedidos_refacciones_refacciones').focus();
					}
					else
					{
						//Concatenar mensaje de validación
					    strMensaje +=' el precio unitario (menos el descuento) no puede ser 0.00';

						//Hacer un llamado a la función para mostrar mensaje de información
	                	mensaje_cotizaciones_refacciones_refacciones('informacion', strMensaje,'txtPrecioUnitario_detalles_pedidos_refacciones_refacciones');
					}
					
				}
			}
		}

		//Función para inicializar elementos del detalle
		function inicializar_detalle_pedidos_refacciones_refacciones() 
		{

			//Limpiar las siguientes cajas de texto
			$('#txtReferenciaID_detalles_pedidos_refacciones_refacciones').val('');
			$('#txtReferencia_detalles_pedidos_refacciones_refacciones').val('');
			$('#txtTipoReferencia_detalles_pedidos_refacciones_refacciones').val('');
			$('#txtCodigo_detalles_pedidos_refacciones_refacciones').val('');
			$('#txtCodigoLinea_detalles_pedidos_refacciones_refacciones').val('');
			$('#txtDescripcion_detalles_pedidos_refacciones_refacciones').val('');
			$('#txtCantidad_detalles_pedidos_refacciones_refacciones').val('');
		    $('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').val('');
		    $('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').val('0.00');
		    $('#txtPorcentajeIva_detalles_pedidos_refacciones_refacciones').val('');
		    $('#txtPorcentajeIeps_detalles_pedidos_refacciones_refacciones').val('');
		    $('#txtTasaCuotaIva_detalles_pedidos_refacciones_refacciones').val('');
		    $('#txtTasaCuotaIeps_detalles_pedidos_refacciones_refacciones').val('');
		    $('#txtTipoCambio_detalles_pedidos_refacciones_refacciones').val('');
		    $('#txtPrecioRefaccion_detalles_pedidos_refacciones_refacciones').val('');
		    //Habilitar las siguientes cajas de texto
		    $("#txtCantidad_detalles_pedidos_refacciones_refacciones").removeAttr('disabled');
		   	//$("#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones").removeAttr('disabled');

		}


		//Función para la búsqueda de refacciones de la referencia
		function lista_refacciones_referencia_detalles_pedidos_refacciones_refacciones(porcentajeDescuentoProm, referenciaID, tipoReferencia, cantidad) 
		{
			//Variable que se utiliza para asignar el tipo de cambio de la requisición
			var intTipoCambioPedido = parseFloat($('#txtTipoCambio_pedidos_refacciones_refacciones').val());
			//Variable que se utiliza para asignar el tipo de cambio de la refacción
			var intMonedaIDPedido =  parseFloat($('#cmbMonedaID_pedidos_refacciones_refacciones').val());
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_pedidos_refacciones_refacciones').getElementsByTagName('tbody')[0];
		
			//Array que se utiliza para agregar las refacciones incorrectas
			var arrDetallesIncorrectos = [];

			//Variable que se utiliza para asignar las acciones del grid view
            var strAccionesTablaDetalles = '';

			//Si el tipo de referencia no corresponde a un Kit de refacciones
            if(tipoReferencia != 'KIT')
            {
            	//Agregar acción de Editar
				strAccionesTablaDetalles = "<button class='btn btn-default btn-xs' title='Editar'" +
											 " onclick='editar_renglon_detalles_pedidos_refacciones_refacciones(this)'>" + 
											 "<span class='glyphicon glyphicon-edit'></span></button>";					 
            }

            //Variable que se utiliza para asignar las acciones del grid view
            strAccionesTablaDetalles +=  "<button class='btn btn-default btn-xs' title='Eliminar'" +
									     " onclick='eliminar_renglon_detalles_pedidos_refacciones_refacciones(this)'>" + 
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
			       	intRefaccionesListaPrecioID: $('#txtRefaccionesListaPrecioID_pedidos_refacciones_refacciones').val(), 
			       	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día 
				    dteFechaTipoCambio: $.formatFechaMysql($('#txtFecha_pedidos_refacciones_refacciones').val()), 
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
							var intPorcentajeIva = parseFloat(data.row[intCon].porcentaje_iva);
							var intPorcentajeIeps = data.row[intCon].porcentaje_ieps;
							var intTasaCuotaIva = data.row[intCon].tasa_cuota_iva;
							var intTasaCuotaIeps =  data.row[intCon].tasa_cuota_ieps;
							var intTipoCambioRefaccion = parseFloat(data.row[intCon].tipo_cambio_venta);
							var intPorcentajeDescuento = 0;
							var strCodigoSat = data.row[intCon].codigo_sat;
							var strUnidadSat = data.row[intCon].unidad_sat;
							var strCodigoLinea = data.row[intCon].codigo_linea;
							//Concatenar los datos de la referencia
						    var strReferencia = strCodigo+' - '+strDescripcion;
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
						        if(intMonedaIDPedido !== intMonedaBaseIDPedidosRefaccionesRefacciones )
						        {
						       		//Convertir peso mexicano a tipo de cambio
						       		intPrecioUnitario = intPrecioUnitario / intTipoCambioPedido;

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

								//Redondear cantidad a decimales
								intSubtotal = intSubtotal.toFixed(2);
								intSubtotal = parseFloat(intSubtotal);
							}

							//Si el precio es mayor que cero
							if(intSubtotal > 0)
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
									var objCeldaTasaCuotaIva = objRenglon.insertCell(16);
									var objCeldaTasaCuotaIeps = objRenglon.insertCell(17);
									var objCeldaCodigoLinea = objRenglon.insertCell(18);


									//Asignar valores
									objRenglon.setAttribute('class', 'movil');
									objRenglon.setAttribute('id', intRefaccionID);
									objCeldaCodigo.setAttribute('class', 'movil b1');
									objCeldaCodigo.innerHTML = strCodigo
									objCeldaDescripcion.setAttribute('class', 'movil b2');
									objCeldaDescripcion.innerHTML = strDescripcion;
									objCeldaCantidad.setAttribute('class', 'movil b3');
									objCeldaCantidad.innerHTML = intCantidad;
									objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
									objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
									objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
									objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
									objCeldaSubtotal.setAttribute('class', 'movil b6');
									objCeldaSubtotal.innerHTML = intSubtotal;
									objCeldaIvaUnitario.setAttribute('class', 'movil b7');
									objCeldaIvaUnitario.innerHTML = intImporteIva;
									objCeldaIepsUnitario.setAttribute('class', 'movil b8');
									objCeldaIepsUnitario.innerHTML = intImporteIeps;
									objCeldaTotal.setAttribute('class', 'movil b9');
									objCeldaTotal.innerHTML = intTotal;
									objCeldaAcciones.setAttribute('class', 'td-center movil b10');
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
									objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
									objCeldaTasaCuotaIva.innerHTML = intTasaCuotaIva;
									objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
									objCeldaTasaCuotaIeps.innerHTML = intTasaCuotaIeps;
									objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
									objCeldaCodigoLinea.innerHTML = strCodigoLinea;
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
									objTabla.rows.namedItem(intRefaccionID).cells[16].innerHTML = intTasaCuotaIva;
									objTabla.rows.namedItem(intRefaccionID).cells[17].innerHTML = intTasaCuotaIeps;
									objTabla.rows.namedItem(intRefaccionID).cells[18].innerHTML = strCodigoLinea;

								}

							}
							else
							{

									//Agregar refacción en el array, de esta manera, el usuario identificara las refacciones incorrectas
									arrDetallesIncorrectos.push(strReferencia);
								
							}

						}//Cierre de foreach	


						//Si existen refacciones incorrectas
						if(arrDetallesIncorrectos.length > 0)
						{
							//Mensaje que se utiliza para informar al usuario la lista de refacciones incorrectas
							var strMensaje = 'No es posible agregar las siguientes <b>refacciones</b> porque no tienen precio unitario (0.00):<br>';

							//Hacer recorrido para obtener refacciones incorrectas
							for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
							{
								//Agregar refacción en el mensaje
			            		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
							}

							//Hacer un llamado a la función para mostrar mensaje de error
							mensaje_pedidos_refacciones_refacciones('error', strMensaje);

						}
			       		
			       		//Hacer un llamado a la función para calcular totales de la tabla
						calcular_totales_detalles_pedidos_refacciones_refacciones();
						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $('#dg_detalles_pedidos_refacciones_refacciones tr').length - 2;
						$('#numElementos_detalles_pedidos_refacciones_refacciones').html(intFilas);
						$('#txtNumDetalles_pedidos_refacciones_refacciones').val(intFilas);

			       	 },
			       'json');
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_pedidos_refacciones_refacciones(objRenglon)
		{
			//Variables que se utilizan para concatenar los datos de la referencia
			var strCodigo = objRenglon.parentNode.parentNode.cells[0].innerHTML;
			var strDescripcion = objRenglon.parentNode.parentNode.cells[1].innerHTML;
			var strReferencia = strCodigo+' - '+strDescripcion;
			var strTipoReferencia = objRenglon.parentNode.parentNode.cells[13].innerHTML;

			//Hacer un llamado a la función para inicializar elementos de la referencia (KIT/REFACCION/LINEA/MARCA)
	        inicializar_refaccion_detalles_pedidos_refacciones_refacciones(strTipoReferencia);

			//Asignar los valores a las cajas de texto
			$('#txtReferenciaID_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtReferencia_detalles_pedidos_refacciones_refacciones').val(strReferencia);
			$('#txtCodigo_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidad_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIva_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtPorcentajeIeps_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtTipoReferencia_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtTipoCambio_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);
			$('#txtPrecioRefaccion_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[15].innerHTML);
			$('#txtTasaCuotaIva_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[16].innerHTML);
			$('#txtTasaCuotaIeps_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[17].innerHTML);
			$('#txtCodigoLinea_detalles_pedidos_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[18].innerHTML);

			//Enfocar caja de texto
			$('#txtReferencia_detalles_pedidos_refacciones_refacciones').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_pedidos_refacciones_refacciones(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_pedidos_refacciones_refacciones").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_pedidos_refacciones_refacciones();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $('#dg_detalles_pedidos_refacciones_refacciones tr').length - 2;
			$('#numElementos_detalles_pedidos_refacciones_refacciones').html(intFilas);
			$('#txtNumDetalles_pedidos_refacciones_refacciones').val(intFilas);

			//Enfocar caja de texto
			$('#txtReferencia_detalles_pedidos_refacciones_refacciones').focus();
		}

		//Función para recalcular los importes de los detalles de la tabla 
		function recalcular_importes_detalles_pedidos_refacciones_refacciones()
		{
			//Variable que se utiliza para asignar el tipo de cambio de la requisición
			var intTipoCambioPedido = parseFloat($('#txtTipoCambio_pedidos_refacciones_refacciones').val());
			//Variable que se utiliza para asignar el tipo de cambio de la refacción
			var intMonedaIDPedido =  parseFloat($('#cmbMonedaID_pedidos_refacciones_refacciones').val());

			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_pedidos_refacciones_refacciones').getElementsByTagName('tbody')[0];

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
				        if(intMonedaIDPedido !== intMonedaBaseIDPedidosRefaccionesRefacciones )
				        {
				       		//Convertir peso mexicano a tipo de cambio
				       		intPrecioUnitario = intPrecioUnitario / intTipoCambioPedido;
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
			    calcular_totales_detalles_pedidos_refacciones_refacciones();
			}
	
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_pedidos_refacciones_refacciones()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_pedidos_refacciones_refacciones').getElementsByTagName('tbody')[0];

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
			$('#acumCantidad_detalles_pedidos_refacciones_refacciones').html(intAcumUnidades);
			$('#acumDescuento_detalles_pedidos_refacciones_refacciones').html(intAcumDescuento);
			$('#acumSubtotal_detalles_pedidos_refacciones_refacciones').html(intAcumSubtotal);
			$('#acumIva_detalles_pedidos_refacciones_refacciones').html(intAcumIva);
			$('#acumIeps_detalles_pedidos_refacciones_refacciones').html(intAcumIeps);
			$('#acumTotal_detalles_pedidos_refacciones_refacciones').html(intAcumTotal);
		}

		//Función para calcular el precio unitario del detalle
		function calcular_precio_unitario_detalles_pedidos_refacciones_refacciones()
		{
		   //Variable que se utiliza para asignar el tipo de cambio de la requisición
		   var intTipoCambioPedido = parseFloat($('#txtTipoCambio_pedidos_refacciones_refacciones').val());
		   //Variable que se utiliza para asignar el tipo de cambio de la refacción
		   var intMonedaIDPedido =  parseFloat($('#cmbMonedaID_pedidos_refacciones_refacciones').val());
		   //Variable que se utiliza para asignar el tipo de cambio de la refacción
		   var intTipoCambioRefaccion = parseFloat($.reemplazar($('#txtTipoCambio_detalles_pedidos_refacciones_refacciones').val(), ",", ""));
		   //Variable que se utiliza para asignar el precio de la refacción
		   var intPrecioRefaccion = parseFloat($.reemplazar($('#txtPrecioRefaccion_detalles_pedidos_refacciones_refacciones').val(), ",", ""));
		   //Variable que se utiliza para asignar el precio unitario
		   var intPrecioUnitario = 0;

		   //Si existe precio de la refacción
		   if(intPrecioRefaccion > 0 && intTipoCambioRefaccion > 0)
		   {
	   	  	    //Convertir importe a peso mexicano
		      	intPrecioUnitario = intPrecioRefaccion * intTipoCambioRefaccion;

		       	//Si la moneda de la refacción no corresponde a peso mexicano
		        if(intMonedaIDPedido !== intMonedaBaseIDPedidosRefaccionesRefacciones)
		        {
		        	//Si existe tipo de cambio de la factura
		        	if(intTipoCambioPedido > 0)
		        	{

			       		//Convertir peso mexicano a tipo de cambio
			       		intPrecioUnitario = intPrecioUnitario / intTipoCambioPedido;
			       	}
			       	else
			       	{
			       		intPrecioUnitario = 0;
			       	}
		        }

		        //Cambiar el precio unitario del detalle
		   		$('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').val(intPrecioUnitario);
       	    	//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
           		$('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
		   } 	
		   
		}

		//Función para recalcular el precio unitario del detalle
		function recalcular_precio_unitario_pedidos_refacciones_refacciones(strCampoID)
		{
			//Si existe id del prospecto
            if($("#txtProspectoID_pedidos_refacciones_refacciones").val() !== '')
            {
	        	//Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
				habilitar_elementos_tipo_cambio_detalles_pedidos_refacciones_refacciones(strCampoID);
			}

        	//Hacer un llamado a la función para calcular el precio unitario
		  	calcular_precio_unitario_detalles_pedidos_refacciones_refacciones();
        	//Hacer un llamado a la función para recalcular los importes
		  	recalcular_importes_detalles_pedidos_refacciones_refacciones();
		}


		//Función para habilitar y deshabilitar los campos del detalle cuando cambia el tipo de cambio
		function habilitar_elementos_tipo_cambio_detalles_pedidos_refacciones_refacciones(campo){
			//Deshabilitar o habilitar las siguientes cajas de texto			
			data  = {
						//Son los id de los input que quiere deshabilitar o habilitar
						rows:[
							'#txtReferencia_detalles_pedidos_refacciones_refacciones',
							'#txtCantidad_detalles_pedidos_refacciones_refacciones',
							// '#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones',
							'#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones'								
						],
						//Es asignar un attributo disbaled|checked
						attribute: 'disabled',									
					};						
			($(campo).val() && $('#txtTipoCambio_pedidos_refacciones_refacciones').val())? data.bool = false: data.bool= true;								
			//La function para deshabilitar o abilitar el input porque les estamos mando un true		
			$.habilitar_deshabilitar_campos(data);
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Pedidos
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_pedidos_refacciones_refacciones').numeric();
			$('#txtGastosPaqueteria_pedidos_refacciones_refacciones').numeric();			
			$('#txtCantidad_detalles_pedidos_refacciones_refacciones').numeric();
			$('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').numeric();
        	$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').numeric();
        	$('#txtPorcentajeIva_detalles_pedidos_refacciones_refacciones').numeric();
        	$('#txtPorcentajeIeps_detalles_pedidos_refacciones_refacciones').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_pedidos_refacciones_refacciones').blur(function(){
				$('.moneda_pedidos_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
			});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_pedidos_refacciones_refacciones').blur(function(){
                $('.tipo-cambio_pedidos_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_pedidos_refacciones_refacciones').blur(function(){
                $('.cantidad_pedidos_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_pedidos_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});

			//Regresar el tipo de cambio de la moneda cuando cambie la fecha
			$('#dteFecha_pedidos_refacciones_refacciones').on('dp.change', function (e) {
				//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_pedidos_refacciones_refacciones();
			});

			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_pedidos_refacciones_refacciones').change(function(e){   
             	//Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_pedidos_refacciones_refacciones').val()) === intMonedaBaseIDPedidosRefaccionesRefacciones)
             	{
             		//Deshabilitar caja de texto
					$('#txtTipoCambio_pedidos_refacciones_refacciones').attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_pedidos_refacciones_refacciones').val(intTipoCambioMonedaBasePedidosRefaccionesRefacciones);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_pedidos_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
					//Hacer un llamado a la función para recalcular los importes y habilitar/deshabilitar campos
	                recalcular_precio_unitario_pedidos_refacciones_refacciones('#cmbMonedaID_pedidos_refacciones_refacciones');
             	}
             	else
             	{
             		//Habilitar caja de texto
					$('#txtTipoCambio_pedidos_refacciones_refacciones').removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_pedidos_refacciones_refacciones').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_pedidos_refacciones_refacciones();
             	}

	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_pedidos_refacciones_refacciones').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_pedidos_refacciones_refacciones').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoPedidosRefaccionesRefacciones)
	        	{
	        		$('#txtTipoCambio_pedidos_refacciones_refacciones').val(intTipoCambioMaximoPedidosRefaccionesRefacciones);
	        	}

	        	//Hacer un llamado a la función para recalcular los importes y habilitar/deshabilitar campos
	            recalcular_precio_unitario_pedidos_refacciones_refacciones('#txtTipoCambio_pedidos_refacciones_refacciones');

		    });


	        //Autocomplete para recuperar los datos de un anticipo
	        $('#txtAnticipo_pedidos_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtAnticipoID_pedidos_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos del anticipo
	               inicializar_anticipo_pedidos_refacciones_refacciones();
	               //Variables que se utilizan para realizar la búsqueda de anticipos de un prospecto 
	               //en caso de que exista el id de la cotización 
	               var intProspectoIDAnt = '';
	               var intMonedaIDAnt = '';

	               //Si existe el id de la cotización 
	               if($('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val() != '')
	               {
	               	 //Asignar valores a las variables
	               	 intMonedaIDAnt = $('#cmbMonedaID_pedidos_refacciones_refacciones').val();
	               	 intProspectoIDAnt = $('#txtProspectoID_pedidos_refacciones_refacciones').val();

	               }

	               $.ajax({
		                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
		                 url: "caja/anticipos/autocomplete",
		                 type: "post",
		                 dataType: "json",
		                 data: {
		                   strDescripcion: request.term, 
		                   intMonedaID: intMonedaIDAnt,
		                   intProspectoID:  intProspectoIDAnt 
		                 },
		                 success: function( data ) {
		                   response( data );
		                 }
		               });
	               
	           },
	           select: function( event, ui ) {
	              //Asignar id del registro seleccionado
	              $('#txtAnticipoID_pedidos_refacciones_refacciones').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos del anticipo
	              get_datos_anticipo_pedidos_refacciones_refacciones();

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
	        $('#txtAnticipo_pedidos_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del anticipo
	            if($('#txtAnticipoID_pedidos_refacciones_refacciones').val() == '' ||
	               $('#txtAnticipo_pedidos_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtAnticipoID_pedidos_refacciones_refacciones').val('');
	               $('#txtAnticipo_pedidos_refacciones_refacciones').val('');
	               	//Hacer un llamado a la función para asignar el tipo de cambio de la cotización
		    		get_tipo_cambio_cotizacion_pedidos_refacciones_refacciones();
	              
	            }

	        });

	        //Autocomplete para recuperar los datos de una cotización de refacciones
	        $('#txtCotizacionRefacciones_pedidos_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos de la cotización de refacciones
	               inicializar_cotizacion_pedidos_refacciones_refacciones();

	               //Variables que se utilizan para realizar la búsqueda de cotizaciones de un prospecto 
	               //en caso de que exista el id del anticipo 
	               var intProspectoIDCot = '';
	               var intMonedaIDCot = '';

	               //Si existe el id del anticipo 
	               if($('#txtAnticipoID_pedidos_refacciones_refacciones').val() != '')
	               {
	               	 //Asignar valores a las variables
	               	 intMonedaIDCot = $('#cmbMonedaID_pedidos_refacciones_refacciones').val();
	               	 intProspectoIDCot = $('#txtProspectoID_pedidos_refacciones_refacciones').val();

	               }

	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/cotizaciones_refacciones/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intMonedaID:  intMonedaIDCot, 
	                   intProspectoID:  intProspectoIDCot
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	              //Asignar id del registro seleccionado
	              $('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val(ui.item.data);
				  //Variable que se utiliza para asignar el importe de la cotización
				  var intImporteCotizacion = parseFloat(ui.item.total); 

				  //Si existe id del anticipo
				  if($('#txtAnticipoID_pedidos_refacciones_refacciones').val() != '')
				  {
				  	  //Variable que se utiliza para asignar el saldo del anticipo
				  	  //Hacer un llamado a la función para reemplazar '$' por cadena vacia
					  var intSaldoAnticipo = $.reemplazar($('#txtSaldoAnticipo_pedidos_refacciones_refacciones').val(), "$", "");
					  //Hacer un llamado a la función para reemplazar ',' por cadena vacia
					  intSaldoAnticipo = parseFloat($.reemplazar(intSaldoAnticipo, ",", ""));


				  	  //Verificar que el total de la cotización sea menor al saldo del anticipo
				  	  if(intImporteCotizacion > intSaldoAnticipo)
				  	  {
				  	  		//Cambiar cantidad a formato moneda
						   intSaldoAnticipo = formatMoney(intSaldoAnticipo, 2, '');

						   //Mensaje que se utiliza para informar al usuario que el saldo del anticipo no puede ser menor al saldo del anticipo
				  	  	   var strMensaje = 'La cotización sobrepasa el saldo del anticipo. ';
				  	  	   strMensaje += '<br>Saldo restante: <b>'+intSaldoAnticipo+'</b>';

				   		 	//Hacer un llamado a la función para mostrar mensaje de información
		                	mensaje_pedidos_refacciones_refacciones('informacion', strMensaje,'txtCotizacionRefacciones_pedidos_refacciones_refacciones', 'referencia', 'txtCotizacionRefaccionesID_pedidos_refacciones_refacciones');

				  	  }
				  	  else
				  	  {
				  	  	//Hacer un llamado a la función para regresar los datos de la cotización
	           	 	 	get_datos_cotizacion_pedidos_refacciones_refacciones();
				  	  }
				  }
				  else
				  {
				  	 //Hacer un llamado a la función para regresar los datos de la cotización
	           	 	 get_datos_cotizacion_pedidos_refacciones_refacciones();
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
	        $('#txtCotizacionRefacciones_pedidos_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la cotización
	            if($('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val() == '' ||
	               $('#txtCotizacionRefacciones_pedidos_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtCotizacionRefaccionesID_pedidos_refacciones_refacciones').val('');
	               $('#txtCotizacionRefacciones_pedidos_refacciones_refacciones').val('');
	            }

	        });


			//Autocomplete para recuperar los datos de un prospecto o cliente
	        $('#txtProspecto_pedidos_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_pedidos_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos del prospecto
	               inicializar_prospecto_pedidos_refacciones_refacciones();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/prospectos/autocomplete",
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
	             //Asignar valores del registro seleccionado
	             $('#txtProspectoID_pedidos_refacciones_refacciones').val(ui.item.data);
	             $('#txtRefaccionesListaPrecioID_pedidos_refacciones_refacciones').val(ui.item.refacciones_lista_precio_id);
	              //Hacer un llamado a la función para habilitar o deshabilitar campos de formulario correspondientes al tipo de cambio
				  habilitar_elementos_tipo_cambio_detalles_pedidos_refacciones_refacciones('#txtProspectoID_pedidos_refacciones_refacciones');

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del prospecto  cuando pierda el enfoque la caja de texto
	        $('#txtProspecto_pedidos_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoID_pedidos_refacciones_refacciones').val() == '' ||
	               $('#txtProspecto_pedidos_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_pedidos_refacciones_refacciones').val('');
	               $('#txtProspecto_pedidos_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos del prospecto
	               inicializar_prospecto_pedidos_refacciones_refacciones();
	            }

	        });


	         //Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_pedidos_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorID_pedidos_refacciones_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: intModuloIDPedidosRefaccionesRefacciones
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorID_pedidos_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtVendedor_pedidos_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_pedidos_refacciones_refacciones').val() == '' ||
	               $('#txtVendedor_pedidos_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_pedidos_refacciones_refacciones').val('');
	               $('#txtVendedor_pedidos_refacciones_refacciones').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una estrategia
	        $('#txtEstrategia_pedidos_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEstrategiaID_pedidos_refacciones_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/estrategias/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: intModuloIDPedidosRefaccionesRefacciones
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtEstrategiaID_pedidos_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtEstrategia_pedidos_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la estrategia
	            if($('#txtEstrategiaID_pedidos_refacciones_refacciones').val() == '' ||
	               $('#txtEstrategia_pedidos_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEstrategiaID_pedidos_refacciones_refacciones').val('');
	               $('#txtEstrategia_pedidos_refacciones_refacciones').val('');
	            }
	            
	        });

	        //Calcular el IVA desglosado despues de capturar Gastos de paqueteria
	        $('#txtGastosPaqueteria_pedidos_refacciones_refacciones').focusout(function(e){

	           	//Hacer un llamado a la función para desglosar el IVA del gasto de paquetería
	       	   $.desglosarIvaGasto(arrDesglosarIvaGastoPedidosRefaccionesRefacciones);

	        });

	        //Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });


	        //Autocomplete para recuperar los datos de una refacción, kit, línea o marca
	        $('#txtReferencia_detalles_pedidos_refacciones_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtReferenciaID_detalles_pedidos_refacciones_refacciones').val('');
	                  //Hacer un llamado a la función para inicializar elementos de la referencia (KIT/REFACCION/LINEA/MARCA)
	               	 inicializar_refaccion_detalles_pedidos_refacciones_refacciones ('REFACCION');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones_promociones/autocomplete",
	                   type: "post",
	                   dataType: "json",
	                   data: {
	                     strDescripcion: request.term,
	                     strTipo: 'referencias',
	                     //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						 dteFecha: $.formatFechaMysql($('#txtFecha_pedidos_refacciones_refacciones').val()), 
						  intRefaccionesListaPrecioID: $('#txtRefaccionesListaPrecioID_pedidos_refacciones_refacciones').val(),
						  strListaPrecioCte: 'SI'
	                   },
	                   success: function( data ) {
	                     response( data );
	                   }
	                 });
	             },
	             select: function( event, ui ) {		             	
	                //Asignar id del registro seleccionado
	                $('#txtReferenciaID_detalles_pedidos_refacciones_refacciones').val(ui.item.data);
	                var intPorcentajeDescuento = parseFloat(ui.item.descuento_promocion);
	                var intPorcentajeDescLinea = parseFloat(ui.item.descuento_linea);
	                var strTipoReferencia = ui.item.tipo_referencia;
	                 $('#txtTipoReferencia_detalles_pedidos_refacciones_refacciones').val(strTipoReferencia);

	                //Si existe la referencia tiene descuento de promoción
	                if(intPorcentajeDescuento > 0 || intPorcentajeDescLinea > 0)
	                {
	                	//Si existe promoción del día
	                	if(intPorcentajeDescuento > 0)
	                	{
	                		//Asignar porcentaje de promoción
	                		$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').val(intPorcentajeDescuento);
	                	}
	                	else
	                	{
	                		//Asignar porcentaje de la línea de refacciones
	                		$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').val(intPorcentajeDescLinea);
	                	}

	                	
	                	//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					    $('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
	                }
	                //Si el tipo de referencia corresponde a una refacción
	                if(strTipoReferencia == 'REFACCION')
	                {

	                	//Hacer un llamado a la función para regresar los datos de la refacción
	                	get_datos_refaccion_detalles_pedidos_refacciones_refacciones(intPorcentajeDescuento);
	                	
	                }
	                else
	                {
	                	//Deshabilitar las siguientes cajas de texto
				   		$('#txtCantidad_detalles_pedidos_refacciones_refacciones').attr('disabled','disabled');
				   		$('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').attr('disabled','disabled');
				   		
				   		//Enfocar caja de texto
		                $('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').focus();
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
	        $('#txtReferencia_detalles_pedidos_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la referencia
	            if($('#txtReferenciaID_detalles_pedidos_refacciones_refacciones').val() == '' ||
	               $('#txtReferencia_detalles_pedidos_refacciones_refacciones').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtReferenciaID_detalles_pedidos_refacciones_refacciones').val('');
	                $('#txtReferencia_detalles_pedidos_refacciones_refacciones').val('');
	                //Hacer un llamado a la función para inicializar elementos de la referencia (KIT/REFACCION/LINEA/MARCA)
	               	inicializar_refaccion_detalles_pedidos_refacciones_refacciones ('REFACCION');
	            }

	        });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_pedidos_refacciones_refacciones').on('click','button.btn',function(){
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
			$('#txtReferencia_detalles_pedidos_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe referencia
		            if($('#txtReferenciaID_detalles_pedidos_refacciones_refacciones').val() == '' || $('#txtReferencia_detalles_pedidos_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtReferencia_detalles_pedidos_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtCantidad_detalles_pedidos_refacciones_refacciones').focus();
			   	    }
		        }
		    });


			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_pedidos_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_pedidos_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_pedidos_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Si el tipo de referencia corresponde a una refacción 
			   	    	if($('#txtTipoReferencia_detalles_pedidos_refacciones_refacciones').val() == 'REFACCION')
			   	    	{
			   	    		//Enfocar caja de texto
					    	$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').focus();
			   	    	}
			   	   		else
			   	   		{
			   	   			 //Hacer un llamado a la función para agregar renglón a la tabla
			   	    		agregar_renglon_detalles_pedidos_refacciones_refacciones();
			   	   		}
			   	    }
		        }
		    });

		    //Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_detalles_pedidos_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Si el tipo de referencia corresponde a una refacción 
			   	    	if($('#txtTipoReferencia_detalles_pedidos_refacciones_refacciones').val() == 'REFACCION')
			   	    	{
			   	    		//Enfocar caja de texto
					    	$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').focus();
			   	    	}
			   	   		else
			   	   		{
			   	   			 //Hacer un llamado a la función para agregar renglón a la tabla
			   	    		agregar_renglon_detalles_pedidos_refacciones_refacciones();
			   	   		}
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_pedidos_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	 //Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_detalles_pedidos_refacciones_refacciones();
			   	    	
			   	    }
		        }
		    });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_pedidos_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_pedidos_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_pedidos_refacciones_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_pedidos_refacciones_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_pedidos_refacciones_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_pedidos_refacciones_refacciones').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un prospecto  o cliente
	        $('#txtProspectoBusq_pedidos_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_pedidos_refacciones_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/prospectos/autocomplete",
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
	             $('#txtProspectoIDBusq_pedidos_refacciones_refacciones').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del prospecto cuando pierda el enfoque la caja de texto
	        $('#txtProspectoBusq_pedidos_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoIDBusq_pedidos_refacciones_refacciones').val() == '' ||
	               $('#txtProspectoBusq_pedidos_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_pedidos_refacciones_refacciones').val('');
	               $('#txtProspectoBusq_pedidos_refacciones_refacciones').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_pedidos_refacciones_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaPedidosRefaccionesRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_pedidos_refacciones_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_pedidos_refacciones_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_pedidos_refacciones_refacciones('Nuevo');
				//Abrir modal
				 objPedidosRefaccionesRefacciones = $('#PedidosRefaccionesRefaccionesBox').bPopup({
												   appendTo: '#PedidosRefaccionesRefaccionesContent', 
					                               contentContainer: 'PedidosRefaccionesRefaccionesM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_pedidos_refacciones_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_pedidos_refacciones_refacciones').focus();

 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_pedidos_refacciones_refacciones();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_pedidos_refacciones_refacciones();
		});
	</script>