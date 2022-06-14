	<div id="PedidosMaquinariaMaquinariaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_pedidos_maquinaria_maquinaria" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_pedidos_maquinaria_maquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_pedidos_maquinaria_maquinaria">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_pedidos_maquinaria_maquinaria'>
				                    <input class="form-control" id="txtFechaInicialBusq_pedidos_maquinaria_maquinaria"
				                    		name= "strFechaInicialBusq_pedidos_maquinaria_maquinaria" 
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
								<label for="txtFechaFinalBusq_pedidos_maquinaria_maquinaria">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_pedidos_maquinaria_maquinaria'>
				                    <input class="form-control" id="txtFechaFinalBusq_pedidos_maquinaria_maquinaria"
				                    		name= "strFechaFinalBusq_pedidos_maquinaria_maquinaria" 
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
								<input id="txtProspectoIDBusq_pedidos_maquinaria_maquinaria" 
									   name="intProspectoIDBusq_pedidos_maquinaria_maquinaria"  type="hidden" 
									   value="">
								</input>
								<label for="txtProspectoBusq_pedidos_maquinaria_maquinaria">Prospecto / Cliente</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProspectoBusq_pedidos_maquinaria_maquinaria" 
										name="strProspectoBusq_pedidos_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese prospecto o cliente" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_pedidos_maquinaria_maquinaria">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_pedidos_maquinaria_maquinaria" 
								 		name="strEstatusBusq_pedidos_maquinaria_maquinaria" tabindex="1">
								    <option value="TODOS">TODOS</option>
                      				<option value="ACTIVO">ACTIVO</option>
                      				
                      				<option value="AUTORIZADO">AUTORIZADO</option>
                      				<option value="RECHAZADO">RECHAZADO</option>
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
								<label for="txtBusqueda_pedidos_maquinaria_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_pedidos_maquinaria_maquinaria" 
										name="strBusqueda_pedidos_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_pedidos_maquinaria_maquinaria" 
									   name="strImprimirDetalles_pedidos_maquinaria_maquinaria" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_pedidos_maquinaria_maquinaria"
									onclick="paginacion_pedidos_maquinaria_maquinaria();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>  
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_pedidos_maquinaria_maquinaria"
									onclick="reporte_pedidos_maquinaria_maquinaria('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_pedidos_maquinaria_maquinaria"
									onclick="reporte_pedidos_maquinaria_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}


				/*
				Definir columnas de la tabla componentes
				*/
				td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}


				/*
				Definir columnas de la tabla formas de pago
				*/
				td.movil.c1:nth-of-type(1):before {content: "Tipo de pago"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Importe"; font-weight: bold;}
				td.movil.c3:nth-of-type(3):before {content: "Vencimiento"; font-weight: bold;}
				td.movil.c4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla formas de pago
				*/
				td.movil.tc1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.tc2:nth-of-type(2):before {content: "Importe"; font-weight: bold;}

				/*
				Definir columnas de la tabla documentos
				*/
				td.movil.e1:nth-of-type(1):before {content: "Documento"; font-weight: bold;}
				td.movil.e2:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}

			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_pedidos_maquinaria_maquinaria">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Prospecto / Cliente</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:13em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_pedidos_maquinaria_maquinaria" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{prospecto}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_pedidos_maquinaria_maquinaria({{pedido_maquinaria_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_pedidos_maquinaria_maquinaria({{pedido_maquinaria_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
							    <!--- Autorizar o rechazar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionAutorizar}}"  
										onclick="abrir_autorizar_pedidos_maquinaria_maquinaria({{pedido_maquinaria_id}},'Autorizar');"  title="Autorizar o Rechazar">
									<span class="fa fa-check-square-o"></span>
								</button>
								<!--- Autorizar o rechazar crédito del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionAutorizar}}"  
										onclick="abrir_autorizar_credito_pedidos_maquinaria_maquinaria({{pedido_maquinaria_id}},'Autorizar');"  title="Autorizar o Rechazar Crédito">
									<span class="fa fa-credit-card"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_pedidos_maquinaria_maquinaria({{pedido_maquinaria_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>								
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_pedidos_maquinaria_maquinaria({{pedido_maquinaria_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_pedidos_maquinaria_maquinaria({{pedido_maquinaria_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_pedidos_maquinaria_maquinaria"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_pedidos_maquinaria_maquinaria">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Autorizar Pedido-->
		<div id="AutorizarPedidosMaquinariaMaquinariaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_autorizar_pedidos_maquinaria_maquinaria" class="ModalBodyTitle confirmacion-modal-title"">
			<h1 id="tituloModal_autorizar_pedidos_maquinaria_maquinaria"></h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAutorizarPedidosMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmAutorizarPedidosMaquinariaMaquinaria"  onsubmit="return(false)" autocomplete="off">
			    	<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReferenciaID_autorizar_pedidos_maquinaria_maquinaria" 
										   name="intReferenciaID_autorizar_pedidos_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la cotización-->
									<input id="txtCotizacionMaquinariaID_autorizar_pedidos_maquinaria_maquinaria" 
										   name="intCotizacionMaquinariaID_autorizar_pedidos_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
								    <!--Caja de texto oculta que se utiliza para recuperar la serie-->
									<input id="txtSerie_autorizar_pedidos_maquinaria_maquinaria" 
										   name="strSerie_autorizar_pedidos_maquinaria_maquinaria" 
												   type="hidden" value="">
									<!--Caja de texto oculta que se utiliza para recuperar el estatus del cliente (en caso de que el prospecto se encuentre en la tabla clientes)-->
									<input id="txtEstatusCliente_autorizar_pedidos_maquinaria_maquinaria" 
										   name="strEstatusCliente_autorizar_pedidos_maquinaria_maquinaria" 
												   type="hidden" value="">
									<!-- Caja de texto oculta que se utiliza para asignar el tipo de acción (guardar o autorizar) a realizar --> 
									<input type="hidden" id="txtTipoAccion_autorizar_pedidos_maquinaria_maquinaria" 
										   name="strTipoAccion_autorizar_pedidos_maquinaria_maquinaria" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el folio del registro seleccionado--> 
									<input type="hidden" id="txtFolio_autorizar_pedidos_maquinaria_maquinaria" 
										   name="strFolio_autorizar_pedidos_maquinaria_maquinaria" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Pedidos-->
									<input id="txtModalPedidosMaquinaria_autorizar_pedidos_maquinaria_maquinaria" 
										   name="strModalPedidosMaquinaria_autorizar_pedidos_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para asignar a los usuarios que se les enviará 
									     el mensaje--> 
									<input type="hidden" id="txtUsuarios_autorizar_pedidos_maquinaria_maquinaria" 
										   name="strUsuarios_autorizar_pedidos_maquinaria_maquinaria" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Enviar notificación a:</h4>
										</div>
										<div class="panel-body">
											<div id="treeUsuarios_autorizar_pedidos_maquinaria_maquinaria" class="md-list-item-text"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="divEstatus_autorizar_pedidos_maquinaria_maquinaria" class="row no-mostrar">
						<!--Estatus-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbEstatus_autorizar_pedidos_maquinaria_maquinaria">Estatus</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbEstatus_autorizar_pedidos_maquinaria_maquinaria" 
									 		name="strEstatus_autorizar_pedidos_maquinaria_maquinaria" tabindex="1">
									    <option value="">Seleccione una opción</option>
									    <option value="AUTORIZADO">AUTORIZADO</option>
		                                <option value="RECHAZADO">RECHAZADO</option>
                     				</select>
								</div>
							</div>
						</div>
					</div>
			    	<div class="row">
				    	<!--Mensaje-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMensaje_autorizar_pedidos_maquinaria_maquinaria">Mensaje</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtMensaje_autorizar_pedidos_maquinaria_maquinaria" 
											   name="strMensaje_autorizar_pedidos_maquinaria_maquinaria" rows="5" value="" tabindex="1" placeholder="Ingrese mensaje" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Autorizar o rechazar registro-->
							<button class="btn btn-success" id="btnGuardar_autorizar_pedidos_maquinaria_maquinaria"  
									onclick="validar_autorizar_pedidos_maquinaria_maquinaria();"  title="Enviar" tabindex="1">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_autorizar_pedidos_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_autorizar_pedidos_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Autorizar Pedido-->


		<!-- Diseño del modal Autorizar Crédito Pedido-->
		<div id="AutorizarCreditoPedidosMaquinariaMaquinariaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_autorizar_credito_pedidos_maquinaria_maquinaria" class="ModalBodyTitle confirmacion-modal-title"">
			<h1 id="tituloModal_autorizar_credito_pedidos_maquinaria_maquinaria"></h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAutorizarCreditoPedidosMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmAutorizarCreditoPedidosMaquinariaMaquinaria"  onsubmit="return(false)" autocomplete="off">
			    	<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReferenciaID_autorizar_credito_pedidos_maquinaria_maquinaria" 
										   name="intReferenciaID_autorizar_credito_pedidos_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la cotización-->
									<input id="txtCotizacionMaquinariaID_autorizar_credito_pedidos_maquinaria_maquinaria" 
										   name="intCotizacionMaquinariaID_autorizar_credito_pedidos_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<!--Caja de texto oculta que se utiliza para recuperar el estatus del cliente (en caso de que el prospecto se encuentre en la tabla clientes)-->
									<input id="txtEstatusCliente_autorizar_credito_pedidos_maquinaria_maquinaria" 
										   name="strEstatusCliente_autorizar_credito_pedidos_maquinaria_maquinaria" 
										   type="hidden" value="">
									<!-- Caja de texto oculta que se utiliza para asignar el tipo de acción (guardar o autorizar) a realizar --> 
									<input id="txtTipoAccion_autorizar_credito_pedidos_maquinaria_maquinaria"   
										   name="strTipoAccion_autorizar_credito_pedidos_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el folio del registro seleccionado--> 
									<input id="txtFolio_autorizar_credito_pedidos_maquinaria_maquinaria"   
										   name="strFolio_autorizar_credito_pedidos_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Pedidos-->
									<input id="txtModalPedidosMaquinaria_autorizar_credito_pedidos_maquinaria_maquinaria" 
										   name="strModalPedidosMaquinaria_autorizar_credito_pedidos_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para asignar a los usuarios que se les enviará 
									     el mensaje--> 
									<input id="txtUsuarios_autorizar_credito_pedidos_maquinaria_maquinaria"  
										   name="strUsuarios_autorizar_credito_pedidos_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Enviar notificación a:</h4>
										</div>
										<div class="panel-body">
											<div id="treeUsuarios_autorizar_credito_pedidos_maquinaria_maquinaria" class="md-list-item-text"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="divEstatus_autorizar_credito_pedidos_maquinaria_maquinaria" class="row no-mostrar">
						<!--Estatus-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbEstatus_autorizar_credito_pedidos_maquinaria_maquinaria">Estatus</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" 
											id="cmbEstatus_autorizar_credito_pedidos_maquinaria_maquinaria" 
									 		name="strEstatus_autorizar_credito_pedidos_maquinaria_maquinaria" tabindex="1">
									    <option value="">Seleccione una opción</option>
									    <option value="AUTORIZADO">AUTORIZADO</option>
		                                <option value="RECHAZADO">RECHAZADO</option>
                     				</select>
								</div>
							</div>
						</div>
					</div>
			    	<div class="row">
				    	<!--Mensaje-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtMensaje_autorizar_credito_pedidos_maquinaria_maquinaria">Mensaje</label>
								</div>
								<div class="col-md-12">
									<textarea  	class="form-control" 
												id="txtMensaje_autorizar_credito_pedidos_maquinaria_maquinaria" 
											   	name="strMensaje_autorizar_credito_pedidos_maquinaria_maquinaria" 
											   	rows="5" value="" tabindex="1" placeholder="Ingrese mensaje" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Autorizar o rechazar crédito del registro-->
							<button class="btn btn-success" id="btnGuardar_autorizar_credito_pedidos_maquinaria_maquinaria"  
									onclick="validar_autorizar_credito_pedidos_maquinaria_maquinaria();"  title="Enviar" tabindex="1">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_autorizar_credito_pedidos_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_autorizar_credito_pedidos_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Autorizar Crédito del Pedido-->

		<!-- Diseño del modal Pedidos-->
		<div id="PedidosMaquinariaMaquinariaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_pedidos_maquinaria_maquinaria"  class="ModalBodyTitle">
			<h1>Pedidos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_pedidos_maquinaria_maquinaria" role="tablist">
								<!--Tab que contiene la información general-->
								<li id="tabInformacionGeneral_pedidos_maquinaria_maquinaria" class="active">
									<a data-toggle="tab" href="#informacion_general_pedidos_maquinaria_maquinaria">Información General</a>
								</li>
								<!--Tab que contiene los componentes-->
								<li id="tabComponentes_pedidos_maquinaria_maquinaria">
									<a data-toggle="tab" href="#componentes_pedidos_maquinaria_maquinaria">Componentes</a>
								</li>
								<!--Tab que contiene la información de las formas de pago-->
								<li id="tabFormasPago_pedidos_maquinaria_maquinaria">
									<a data-toggle="tab" href="#formas_pago_pedidos_maquinaria_maquinaria">Formas de Pago</a>
								</li>
								<!--Tab que contiene la información del expediente-->
								<li id="tabExpediente_pedidos_maquinaria_maquinaria">
									<a data-toggle="tab" href="#expediente_pedidos_maquinaria_maquinaria">Expediente</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmPedidosMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmPedidosMaquinariaMaquinaria"  onsubmit="return(false)" 
					  autocomplete="off">
					 <!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					 <div class="tab-content">
						<!--Tab - Información General-->
						<div id="informacion_general_pedidos_maquinaria_maquinaria" class="tab-pane fade in active">
							<div class="row">
								<!--Folio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
											<input id="txtPedidoMaquinariaID_pedidos_maquinaria_maquinaria" 
												   name="intPedidoMaquinariaID_pedidos_maquinaria_maquinaria" type="hidden" value="">
											</input>
											<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
											<input id="txtEstatus_pedidos_maquinaria_maquinaria" 
												   name="strEstatus_pedidos_maquinaria_maquinaria" 
												   type="hidden" value="">
											</input>
											<label for="txtFolio_pedidos_maquinaria_maquinaria">Folio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtFolio_pedidos_maquinaria_maquinaria" 
													name="strFolio_pedidos_maquinaria_maquinaria" type="text" 
													value="" placeholder="Autogenerado" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Fecha-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFecha_pedidos_maquinaria_maquinaria">Fecha</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div class='input-group date' id='dteFecha_pedidos_maquinaria_maquinaria'>
							                    <input class="form-control" id="txtFecha_pedidos_maquinaria_maquinaria"
							                    		name= "strFecha_pedidos_maquinaria_maquinaria" 
							                    		type="text" value="" disabled />
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
											<label for="txtMoneda_pedidos_maquinaria_maquinaria">Moneda</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control tipo-cambio" id="txtMoneda_pedidos_maquinaria_maquinaria" 
													name="strMoneda_pedidos_maquinaria_maquinaria" type="text" value="" 
													disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Tipo de cambio-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtTipoCambio_pedidos_maquinaria_maquinaria">Tipo de cambio</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control tipo-cambio" id="txtTipoCambio_pedidos_maquinaria_maquinaria" 
													name="intTipoCambio_pedidos_maquinaria_maquinaria" type="text" value="" 
													disabled>
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Cotización-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtCotizacionMaquinaria_pedidos_maquinaria_maquinaria">
												Cotización
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtCotizacionMaquinaria_pedidos_maquinaria_maquinaria" 
													name="strCotizacionMaquinaria_pedidos_maquinaria_maquinaria" type="text" value="" disabled>
											</input>
										</div>
									</div>
								</div>
								<!--Prospecto / Cliente-->
								<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del prospecto-->
											<input id="txtProspectoID_pedidos_maquinaria_maquinaria" 
												   name="intProspectoID_pedidos_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<label for="txtProspecto_pedidos_maquinaria_maquinaria">
												Prospecto / Cliente
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtProspecto_pedidos_maquinaria_maquinaria" 
													name="strProspecto_pedidos_maquinaria_maquinaria" 
													type="text" value=""  disabled />
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
											<input id="txtVendedorID_pedidos_maquinaria_maquinaria" 
												   name="intVendedorID_pedidos_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<label for="txtVendedor_pedidos_maquinaria_maquinaria">
												Vendedor
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtVendedor_pedidos_maquinaria_maquinaria" 
													name="strVendedor_pedidos_maquinaria_maquinaria" 
													type="text" value=""  tabindex="1" 
													placeholder="Ingrese vendedor" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Folio pedido físico / Folio legal-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFolioLegal_pedidos_maquinaria_maquinaria">
												Folio pedido físico
											</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" 
													id="txtFolioLegal_pedidos_maquinaria_maquinaria" 
													name="strFolioLegal_pedidos_maquinaria_maquinaria" 
													type="text" value=""  tabindex="1" 
													placeholder="Ingrese folio pedido físico" maxlength="10" />
										</div>
									</div>
								</div>
							</div>
						    <div class="row">
						    	<!--Observaciones-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObservaciones_pedidos_maquinaria_maquinaria">Observaciones</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtObservaciones_pedidos_maquinaria_maquinaria" 
													name="strObservaciones_pedidos_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
											</input>
										</div>
									</div>
								</div>
						    	<!--Notas-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtNotas_pedidos_maquinaria_maquinaria">Notas</label>
										</div>
										<div class="col-md-12">
											<input  class="form-control" id="txtNotas_pedidos_maquinaria_maquinaria" 
													name="strNotas_pedidos_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese notas" maxlength="250">
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
													<h4 class="panel-title">Detalles del pedido</h4>
												</div>
												<div class="panel-body">
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!--Código-->
															<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<!-- Caja de texto oculta que se utiliza para recuperar el id de la descripción de maquinaria-->
																		<input id="txtMaquinariaDescripcionID_pedidos_maquinaria_maquinaria" 
																			   name="intMaquinariaDescripcionID_pedidos_maquinaria_maquinaria"  
																			   type="hidden" value="" />
																		<label for="txtCodigo_pedidos_maquinaria_maquinaria">
																			Código
																		</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" 
																				id="txtCodigo_pedidos_maquinaria_maquinaria" 
																				name="strCodigo_pedidos_maquinaria_maquinaria" 
																				type="text" value="" disabled />
																	</div>
																</div>
															</div>
															<!--Descripción corta-->
															<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtDescripcionCorta_pedidos_maquinaria_maquinaria">Descripción corta</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" 
																				id="txtDescripcionCorta_pedidos_maquinaria_maquinaria" 
																				name="strDescripcionCorta_pedidos_maquinaria_maquinaria" 
																				type="text"  value="" disabled />
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<!--Precio-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtPrecio_pedidos_maquinaria_maquinaria">Precio</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control moneda_pedidos_maquinaria_maquinaria" 
																				id="txtPrecio_pedidos_maquinaria_maquinaria" 
																				name="intPrecio_pedidos_maquinaria_maquinaria" 
																				type="text" value="" disabled />
																	</div>
																</div>
															</div>
															<!--Porcentaje del descuento-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtPorcentajeDescuento_pedidos_maquinaria_maquinaria">Descuento %</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control cantidad" 
																				id="txtPorcentajeDescuento_pedidos_maquinaria_maquinaria" 
																				name="intPorcentajeDescuento_pedidos_maquinaria_maquinaria" 
																				type="text" value="" disabled />
																	</div>
																</div>
															</div>
															<!--Subtotal-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtSubtotal_pedidos_maquinaria_maquinaria">Subtotal</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control moneda_pedidos_maquinaria_maquinaria" 
																				id="txtSubtotal_pedidos_maquinaria_maquinaria" 
																				name="intSubtotal_pedidos_maquinaria_maquinaria" 
																				type="text" value="" disabled />
																	</div>
																</div>
															</div>
															<!--Porcentaje del IVA-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtPorcentajeIva_pedidos_maquinaria_maquinaria">IVA %</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control cantidad" 
																				id="txtPorcentajeIva_pedidos_maquinaria_maquinaria" 
																				name="intPorcentajeIva_pedidos_maquinaria_maquinaria" 
																				type="text" value="" disabled />

																	</div>
																</div>
															</div>
															<!--Porcentaje del IEPS-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtPorcentajeIeps_pedidos_maquinaria_maquinaria">IEPS %</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control cantidad" id="txtPorcentajeIeps_pedidos_maquinaria_maquinaria" 
																				name="intPorcentajeIeps_pedidos_maquinaria_maquinaria" type="text" value="" disabled />
																	</div>
																</div>
															</div>
															<!--Total-->
															<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
																<div class="form-group">
																	<div class="col-md-12">
																		<label for="txtTotal_pedidos_maquinaria_maquinaria">Total</label>
																	</div>
																	<div class="col-md-12">
																		<input  class="form-control" id="txtTotal_pedidos_maquinaria_maquinaria" 
																				name="intTotal_pedidos_maquinaria_maquinaria" type="text" value="" disabled />
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
						<!--Tab - Componentes-->
						<div id="componentes_pedidos_maquinaria_maquinaria" class="tab-pane fade">
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								    <div class="row">
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<div class="form-group">
												<div class="col-md-12">
													
													<!--Div que contiene la tabla con los componentes agregados-->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="row">
															<!-- Diseño de la tabla-->
															<table class="table-hover movil" id="dg_componentes_pedidos_maquinaria_maquinaria">
																<thead class="movil">
																	<tr class="movil">
																		<th class="movil">Código</th>
																		<th class="movil">Descripción</th>
																	</tr>
																</thead>
																<tbody class="movil"></tbody>
															</table>
															<br>
															<div class="row">
																<!--Número de registros encontrados-->
																<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
																	<button class="btn btn-default btn-sm disabled pull-right">
																		<strong id="numElementos_componentes_pedidos_maquinaria_maquinaria">0</strong> encontrados
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
						</div><!--Cierre del contenido del tab - Componentes-->		
						<!--Tab -  Formas de Pago-->
						<div id="formas_pago_pedidos_maquinaria_maquinaria" class="tab-pane fade">
							<div class="row">
								<!--Tipo de pago-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta para ocultar el renglón seleccionado que será modificado-->
											<input id="txtRenglon_formas_pago_pedidos_maquinaria_maquinaria" 
												   name="intRenglon_formas_pago_pedidos_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<!-- Caja de texto oculta para recuperar el id del tipo de pago seleccionado-->
											<input id="txtDescripcionID_formas_pago_pedidos_maquinaria_maquinaria" 
												   name="intDescripcionID_formas_pago_pedidos_maquinaria_maquinaria" 
												   type="hidden" value="" />
											<label for="txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria">Tipo de pago</label>
										</div>
										<div class="col-md-12">
											<input 	class="form-control" 
													id="txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria"
												   	name="strDescripcion_formas_pago_pedidos_maquinaria_maquinaria" 
												   	type="text" value="" tabindex="1" 
												   	placeholder="Ingrese tipo de pago" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Importe-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtImporte_formas_pago_pedidos_maquinaria_maquinaria">Importe</label>
										</div>
										<div class="col-md-12">
											<input class="form-control moneda_pedidos_maquinaria_maquinaria" id="txtImporte_formas_pago_pedidos_maquinaria_maquinaria"
												   name="intImporte_formas_pago_pedidos_maquinaria_maquinaria" 
												   type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23" />
										</div>
									</div>
								</div>
								<!--Fecha de vencimiento-->
								<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria">Fecha de vencimiento</label>
										</div>
										<div id="divFechaMsjValidacion" class="col-md-12">
											<div  class='input-group date' id='dteFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria'>
							                    <input class="form-control" id="txtFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria"
							                    		name= "strFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria" 
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
								<!--Observaciones-->
								<div class="col-sm-11 col-md-11 col-lg-11 col-xs-10">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtObservaciones_formas_pago_pedidos_maquinaria_maquinaria">Observaciones</label>
										</div>
										<div class="col-md-12">
											<input 	class="form-control" 
													id="txtObservaciones_formas_pago_pedidos_maquinaria_maquinaria"
												   	name="strObservaciones_formas_pago_pedidos_maquinaria_maquinaria" 
												   	type="text" value="" tabindex="1" 
												   	placeholder="Ingrese observaciones" maxlength="250" />
										</div>
									</div>
								</div>
								<!--Botón agregar-->
                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                                	<button class="btn btn-primary btn-toolBtns pull-right" 
                                			id="btnAgregar_formas_pago_pedidos_maquinaria_maquinaria" 
                                			onclick="agregar_renglon_formas_pago_pedidos_maquinaria_maquinaria();" 
                                	     	title="Agregar" tabindex="1"> 
                                		<span class="glyphicon glyphicon-plus"></span>
                                	</button>
                             	</div>
							</div>
							<div class="form-group row">
								<!--Div que contiene la tabla con las formas de pago encontradas-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_formas_pago_pedidos_maquinaria_maquinaria">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Tipo de pago</th>
												<th class="movil">Importe</th>
												<th class="movil">Vencimiento</th>
												<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<tfoot class="movil">
											<tr class="movil">
												<td class="movil tc1">
													<strong>Total</strong>
												</td>
												<td  class="movil tc2">
													<strong id="acumImporte_formas_pago_pedidos_maquinaria_maquinaria"></strong>
												</td>
												<td class="movil"></td>
												<td class="movil"></td>
											</tr>
										</tfoot>
									</table>
									<br>
									<div class="row">
										<!--Número de registros encontrados-->
										<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
											<button class="btn btn-default btn-sm disabled pull-right">
												<strong id="numElementos_formas_pago_pedidos_maquinaria_maquinaria">0</strong> encontrados
											</button>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Formas de Pago-->
						<!--Tab - Expediente-->
						<div id="expediente_pedidos_maquinaria_maquinaria" class="tab-pane fade">
							<div class="form-group row">
								<!--Tabla con el listado de documentos-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_expediente_pedidos_maquinaria_maquinaria">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Documento</th>
												<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_expediente_pedidos_maquinaria_maquinaria" type="text/template"> 
											{{#rows}}
												<tr class="movil">
													<td class="movil e1">{{descripcion}}</td>
													<td class="td-center movil e2"> 
														<!--Subir archivo-->
														<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
															<span class="btn  btn-default btn-xs fileinput-button ">
														    	<span class="fa fa-upload"></span>
																<input type="file" name="archivo_pedidos_maquinaria_maquinaria{{documento_cliente_id}}" id="archivo_pedidos_maquinaria_maquinaria{{documento_cliente_id}}"  
																	   onchange="subir_archivo_expediente_pedidos_maquinaria_maquinaria({{documento_cliente_id}})" />
														    </span>
														</span>
						                            	<!--Descargar archivo-->
						                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
						                            			 onmousedown="descargar_archivo_expediente_pedidos_maquinaria_maquinaria({{documento_cliente_id}})" title="Descargar archivo">
						                            		<span class="glyphicon glyphicon-download-alt"></span>
						                            	</button>
						                            	<!--Eliminar archivo-->
														<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}"  
																onclick="eliminar_archivo_expediente_pedidos_maquinaria_maquinaria({{documento_cliente_id}})"  title="Eliminar archivo">
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
												<strong id="numElementos_expediente_pedidos_maquinaria_maquinaria">0</strong> encontrados
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
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_pedidos_maquinaria_maquinaria"  
									onclick="validar_pedidos_maquinaria_maquinaria();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--- Autorizar o rechazar registro-->
							<button class="btn btn-default" id="btnAutorizar_pedidos_maquinaria_maquinaria"  
									onclick="abrir_autorizar_pedidos_maquinaria_maquinaria('', 'Autorizar');"  title="Autorizar o Rechazar" tabindex="3" disabled>
								<span class="fa fa-check-square-o"></span>
							</button>
							<!--- Autorizar crédito del registro-->
							<button class="btn btn-default" id="btnAutorizarCredito_pedidos_maquinaria_maquinaria"  
									onclick="abrir_autorizar_credito_pedidos_maquinaria_maquinaria('', 'Autorizar');"  title="Autorizar crédito" tabindex="4" disabled>
								<span class="fa fa-credit-card"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_pedidos_maquinaria_maquinaria"  
									onclick="reporte_registro_pedidos_maquinaria_maquinaria('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_pedidos_maquinaria_maquinaria"  
									onclick="cambiar_estatus_pedidos_maquinaria_maquinaria('','ACTIVO');"  title="Desactivar" tabindex="6" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_pedidos_maquinaria_maquinaria"  
									onclick="cambiar_estatus_pedidos_maquinaria_maquinaria('','INACTIVO');"  title="Restaurar" tabindex="7" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_pedidos_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_pedidos_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="7">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Pedidos-->
	</div><!--#PedidosMaquinariaMaquinariaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaPedidosMaquinariaMaquinaria = 0;
		var strUltimaBusquedaPedidosMaquinariaMaquinaria = "";
		//Variable que se utiliza para asignar el id del módulo de maquinaria
		var intModuloIDPedidosMaquinariaMaquinaria = <?php echo MODULO_MAQUINARIA ?>;
		//Variable que se utiliza para asignar objeto del modal Autorizar Pedido
		var objAutorizarPedidosMaquinariaMaquinaria = null;
		//Variable que se utiliza para asignar objeto del modal
		var objPedidosMaquinariaMaquinaria = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_pedidos_maquinaria_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/pedidos_maquinaria/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_pedidos_maquinaria_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosPedidosMaquinariaMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosPedidosMaquinariaMaquinaria = strPermisosPedidosMaquinariaMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosPedidosMaquinariaMaquinaria.length; i++)
					{
						//Si el indice es EDITAR (modificar)
						if(arrPermisosPedidosMaquinariaMaquinaria[i]=='EDITAR')
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_pedidos_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosPedidosMaquinariaMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_pedidos_maquinaria_maquinaria').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_pedidos_maquinaria_maquinaria();
						}
						else if(arrPermisosPedidosMaquinariaMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_pedidos_maquinaria_maquinaria').removeAttr('disabled');
							$('#btnRestaurar_pedidos_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosPedidosMaquinariaMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_pedidos_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosPedidosMaquinariaMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_pedidos_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosPedidosMaquinariaMaquinaria[i]=='AUTORIZAR')//Si el indice es AUTORIZAR
						{
							//Ambos botones se ven afectados por el mismo permiso de usuario
							//Habilitar el control (botón autorizar)
							$('#btnAutorizar_pedidos_maquinaria_maquinaria').removeAttr('disabled');
							//Habilitar el control (botón autorizar crédito)
							$('#btnAutorizarCredito_pedidos_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosPedidosMaquinariaMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_pedidos_maquinaria_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_pedidos_maquinaria_maquinaria() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaPedidosMaquinariaMaquinaria =($('#txtFechaInicialBusq_pedidos_maquinaria_maquinaria').val()+$('#txtFechaFinalBusq_pedidos_maquinaria_maquinaria').val()+$('#txtProspectoIDBusq_pedidos_maquinaria_maquinaria').val()+$('#cmbEstatusBusq_pedidos_maquinaria_maquinaria').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaPedidosMaquinariaMaquinaria != strUltimaBusquedaPedidosMaquinariaMaquinaria)
			{
				intPaginaPedidosMaquinariaMaquinaria = 0;
				strUltimaBusquedaPedidosMaquinariaMaquinaria = strNuevaBusquedaPedidosMaquinariaMaquinaria;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('maquinaria/pedidos_maquinaria/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_pedidos_maquinaria_maquinaria').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_pedidos_maquinaria_maquinaria').val()),
					 intProspectoID: $('#txtProspectoIDBusq_pedidos_maquinaria_maquinaria').val(),
					 strEstatus: $('#cmbEstatusBusq_pedidos_maquinaria_maquinaria').val(),
					 strBusqueda:    $('#txtBusqueda_pedidos_maquinaria_maquinaria').val(),
					 intPagina: intPaginaPedidosMaquinariaMaquinaria,
					 strPermisosAcceso: $('#txtAcciones_pedidos_maquinaria_maquinaria').val()
					},
					function(data){
						$('#dg_pedidos_maquinaria_maquinaria tbody').empty();
						var tmpPedidosMaquinariaMaquinaria = Mustache.render($('#plantilla_pedidos_maquinaria_maquinaria').html(),data);
						$('#dg_pedidos_maquinaria_maquinaria tbody').html(tmpPedidosMaquinariaMaquinaria);
						$('#pagLinks_pedidos_maquinaria_maquinaria').html(data.paginacion);
						$('#numElementos_pedidos_maquinaria_maquinaria').html(data.total_rows);
						intPaginaPedidosMaquinariaMaquinaria = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_pedidos_maquinaria_maquinaria(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/pedidos_maquinaria/';

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
			if ($('#chbImprimirDetalles_pedidos_maquinaria_maquinaria').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_pedidos_maquinaria_maquinaria').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_pedidos_maquinaria_maquinaria').val('NO');
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_pedidos_maquinaria_maquinaria').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_pedidos_maquinaria_maquinaria').val()),
										'intProspectoID':$('#txtProspectoIDBusq_pedidos_maquinaria_maquinaria').val(),
										'strEstatus': $('#cmbEstatusBusq_pedidos_maquinaria_maquinaria').val(), 
										'strBusqueda': $('#txtBusqueda_pedidos_maquinaria_maquinaria').val(),
										'strDetalles': $('#chbImprimirDetalles_pedidos_maquinaria_maquinaria').val()								
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_pedidos_maquinaria_maquinaria(id) 
		{

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtPedidoMaquinariaID_pedidos_maquinaria_maquinaria').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'maquinaria/pedidos_maquinaria/get_reporte_registro',
							'data' : {
										'intPedidoMaquinariaID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		

		/*******************************************************************************************************************
		Funciones del modal Autorizar Pedido
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_autorizar_pedidos_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmAutorizarPedidosMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_pedidos_maquinaria_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmAutorizarPedidosMaquinariaMaquinaria').find('input[type=hidden]').val('');
			//Agregar clase no-mostrar para ocultar div que contiene el estatus
			$('#divEstatus_autorizar_pedidos_maquinaria_maquinaria').addClass("no-mostrar");
		    $('#divEncabezadoModal_autorizar_pedidos_maquinaria_maquinaria').addClass("estatus-ACTIVO");
		}

		//Función que se utiliza para abrir el modal
		function abrir_autorizar_pedidos_maquinaria_maquinaria(id, tipoAccion)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_autorizar_pedidos_maquinaria_maquinaria();
		    //Variable que se utiliza para asignar el id del registro
			var intReferenciaID = 0;

			//Si no existe id, significa que se aplicará autorización (o rechazo) desde el modal
			if(id == '')
			{
				intReferenciaID = $('#txtPedidoMaquinariaID_pedidos_maquinaria_maquinaria').val();
				$('#txtModalPedidosMaquinaria_autorizar_pedidos_maquinaria_maquinaria').val('SI');
			}
			else
			{
				intReferenciaID = id;
				$('#txtModalPedidosMaquinaria_autorizar_pedidos_maquinaria_maquinaria').val('NO');
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/pedidos_maquinaria/get_datos',
	        {
	       		intPedidoMaquinariaID:intReferenciaID
	        },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Variables que se utilizan para asignar los datos del registro
							var strFolio  = data.row.folio;
			            	//Asignar datos del registro seleccionado
							$('#txtReferenciaID_autorizar_pedidos_maquinaria_maquinaria').val(data.row.pedido_maquinaria_id);
							$('#txtCotizacionMaquinariaID_autorizar_pedidos_maquinaria_maquinaria').val(data.row.cotizacion_maquinaria_id);
							$('#txtTipoAccion_autorizar_pedidos_maquinaria_maquinaria').val(tipoAccion);
							$('#txtFolio_autorizar_pedidos_maquinaria_maquinaria').val(data.row.folio);

							$('#txtSerie_autorizar_pedidos_maquinaria_maquinaria').val(data.row.serie);
							$('#txtEstatusCliente_autorizar_pedidos_maquinaria_maquinaria').val(data.row.cliente_estatus);


							//Si el tipo de acción corresponde a Guardar
							if(tipoAccion == 'Guardar')
							{
								//Cambiar título del modal
								$('#tituloModal_autorizar_pedidos_maquinaria_maquinaria').text('Notificar Pedido');
								$('#txtMensaje_autorizar_pedidos_maquinaria_maquinaria').val('Favor de autorizar el pedido '+ strFolio);
								//Cargar el treeview
								get_treeview_usuarios_autorizar_pedidos_maquinaria_maquinaria('');
							}
							else
							{
								//Quitar clase no-mostrar para mostrar div que contiene el estatus
								$('#divEstatus_autorizar_pedidos_maquinaria_maquinaria').removeClass("no-mostrar");
								//Cambiar título del modal
								$('#tituloModal_autorizar_pedidos_maquinaria_maquinaria').text('Autorizar Pedido');
								//Cargar el treeview
								get_treeview_usuarios_autorizar_pedidos_maquinaria_maquinaria(intReferenciaID);
							}

						   	//Abrir modal
							objAutorizarPedidosMaquinariaMaquinaria = $('#AutorizarPedidosMaquinariaMaquinariaBox').bPopup({
																	   appendTo: '#PedidosMaquinariaMaquinariaContent', 
											                           contentContainer: 'PedidosMaquinariaMaquinariaM', 
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
		function cerrar_autorizar_pedidos_maquinaria_maquinaria()
		{
			try {
				//Cerrar modal
				objAutorizarPedidosMaquinariaMaquinaria.close();
				//Eliminar datos del treeview
				$("#treeUsuarios_autorizar_pedidos_maquinaria_maquinaria").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_pedidos_maquinaria_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_autorizar_pedidos_maquinaria_maquinaria()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosAutorizarPedidosMaquinariaMaquinaria = [];

			//Recorremos el treeview
			$("#treeUsuarios_autorizar_pedidos_maquinaria_maquinaria").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosAutorizarPedidosMaquinariaMaquinaria.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtUsuarios_autorizar_pedidos_maquinaria_maquinaria").val(arrSeleccionadosAutorizarPedidosMaquinariaMaquinaria.join('|'));

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_pedidos_maquinaria_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmAutorizarPedidosMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_autorizar_pedidos_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba un mensaje'}
											}
										},
										strUsuarios_autorizar_pedidos_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un usuario para este mensaje.'}
											}
										},
										strEstatus_autorizar_pedidos_maquinaria_maquinaria: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista estatus seleccionado cuando el tipo de acción sea Autorizar
					                                    if($('#txtTipoAccion_autorizar_pedidos_maquinaria_maquinaria').val() === 'Autorizar' && $('#cmbEstatus_autorizar_pedidos_maquinaria_maquinaria').val() == '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Seleccione un estatus'
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
			var bootstrapValidator_autorizar_pedidos_maquinaria_maquinaria = $('#frmAutorizarPedidosMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_autorizar_pedidos_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_autorizar_pedidos_maquinaria_maquinaria.isValid())
			{

				//Si el tipo de acción corresponde a  AUTORIZADO
				if($('#cmbEstatus_autorizar_pedidos_maquinaria_maquinaria').val() == 'AUTORIZADO')
				{
					//Si el prospecto es un cliente activo  y existe serie de la descripción de maquinaria
		        	if($('#txtEstatusCliente_autorizar_pedidos_maquinaria_maquinaria').val() != 'ACTIVO')
		        	{
		        		//Hacer un llamado a la función para mostrar mensaje de error
						mensaje_pedidos_maquinaria_maquinaria('error', 'No es posible autorizar por que el prospecto aún no es un cliente.');
		        	}
		        	else
	        		{
						//Hacer un llamado a la función para guardar la solicitud de autorización
					 	guardar_autorizar_pedidos_maquinaria_maquinaria();
					}
				}
				else
				{
					//Hacer un llamado a la función para guardar la solicitud de autorización
					guardar_autorizar_pedidos_maquinaria_maquinaria();
				}	
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_autorizar_pedidos_maquinaria_maquinaria()
		{
			try
			{
				$('#frmAutorizarPedidosMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar la autorización (o el rechazo) de un registro
		function guardar_autorizar_pedidos_maquinaria_maquinaria()
		{
    		//Hacer un llamado al método del controlador para enviar la autorización (o el rechazo) de un registro 
			$.post('maquinaria/pedidos_maquinaria/set_enviar_autorizacion',
			     {
			     	intPedidoMaquinariaID: $('#txtReferenciaID_autorizar_pedidos_maquinaria_maquinaria').val(),
			      	intCotizacionMaquinariaID: $('#txtCotizacionMaquinariaID_autorizar_pedidos_maquinaria_maquinaria').val(),
			      	strUsuarios: $('#txtUsuarios_autorizar_pedidos_maquinaria_maquinaria').val(), 
			      	strMensaje:  $('#txtMensaje_autorizar_pedidos_maquinaria_maquinaria').val(),
			      	strEstatus:  $('#cmbEstatus_autorizar_pedidos_maquinaria_maquinaria').val(),
			      	strTipoAccion:  $('#txtTipoAccion_autorizar_pedidos_maquinaria_maquinaria').val()
			     },
			     function(data) {
			        if(data.resultado)
			        {
			          	//Hacer llamado a la función  para cargar  los registros en el grid
			          	paginacion_pedidos_maquinaria_maquinaria();
			          	//Hacer un llamado a la función para cerrar modal
					  	cerrar_autorizar_pedidos_maquinaria_maquinaria();

					  	//Si el id de la referencia (para generar el pedido) se recuperó del modal Pedidos 
					  	if($('#txtModalPedidosMaquinaria_autorizar_pedidos_maquinaria_maquinaria').val() == 'SI')
					  	{
					  		//Hacer un llamado a la función para cerrar modal Pedidos
					 	 	cerrar_pedidos_maquinaria_maquinaria();
					  	}   
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_pedidos_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		/*Función que se utiliza para definir tree view de usuarios con acceso a la función Autorizar del proceso
		 *Pedidos (módulo Maquinaria)*/
		function get_treeview_usuarios_autorizar_pedidos_maquinaria_maquinaria(id)
		{
			$('#treeUsuarios_autorizar_pedidos_maquinaria_maquinaria').fancytree({
				source: {
					url: "seguridad/usuarios/get_treeview/AUTORIZAR_PEDIDOS_MAQUINARIA/PEDIDOS DE MAQUINARIA/"+id,
					cache: false
				},
				checkbox: true,
				selectMode: 3
			});
		}


		/*******************************************************************************************************************
		Funciones del modal Autorizar Crédito Pedido
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_autorizar_credito_pedidos_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmAutorizarCreditoPedidosMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_credito_pedidos_maquinaria_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmAutorizarCreditoPedidosMaquinariaMaquinaria').find('input[type=hidden]').val('');
			//Agregar clase no-mostrar para ocultar div que contiene el estatus
			$('#divEstatus_autorizar_credito_pedidos_maquinaria_maquinaria').addClass("no-mostrar");
		    $('#divEncabezadoModal_autorizar_credito_pedidos_maquinaria_maquinaria').addClass("estatus-ACTIVO");
		}

		//Función que se utiliza para abrir el modal
		function abrir_autorizar_credito_pedidos_maquinaria_maquinaria(id, tipoAccion)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_autorizar_credito_pedidos_maquinaria_maquinaria();
		    //Variable que se utiliza para asignar el id del registro
			var intReferenciaID = 0;

			//Si no existe id, significa que se aplicará autorización (o rechazo) desde el modal
			if(id == '')
			{
				intReferenciaID = $('#txtPedidoMaquinariaID_pedidos_maquinaria_maquinaria').val();
				$('#txtModalPedidosMaquinaria_autorizar_credito_pedidos_maquinaria_maquinaria').val('SI');
			}
			else
			{
				intReferenciaID = id;
				$('#txtModalPedidosMaquinaria_autorizar_credito_pedidos_maquinaria_maquinaria').val('NO');
			}



			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/pedidos_maquinaria/get_datos',
	        {
	       		intPedidoMaquinariaID:intReferenciaID
	        },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {

			            	//Variables que se utilizan para asignar los datos del registro
							var strFolio  = data.row.folio;
						
			            	//Asignar datos del registro seleccionado
							$('#txtReferenciaID_autorizar_credito_pedidos_maquinaria_maquinaria').val(data.row.pedido_maquinaria_id);
							$('#txtCotizacionMaquinariaID_autorizar_credito_pedidos_maquinaria_maquinaria').val(data.row.cotizacion_maquinaria_id);
							$('#txtTipoAccion_autorizar_credito_pedidos_maquinaria_maquinaria').val(tipoAccion);
							$('#txtFolio_autorizar_credito_pedidos_maquinaria_maquinaria').val(data.row.folio);
							$('#txtEstatusCliente_autorizar_credito_pedidos_maquinaria_maquinaria').val(data.row.cliente_estatus);

							//Variable para calcular el total del pedido
							var precio = parseFloat(data.row.precio)/parseFloat(data.row.tipo_cambio);
							var iva = parseFloat(data.row.iva)/parseFloat(data.row.tipo_cambio);
							var ieps = parseFloat(data.row.ieps);
							var totalPedido = precio + iva + ieps;
							$('#txtTotal_pedidos_maquinaria_maquinaria').val( formatMoney(totalPedido, 2, '') );

							//Verificamos que el pedido tenga formas de pago agregadas previamente
							var importeFormasPago = 0;
							//Si existen formas de pago
							if(data.formas_pago)
							{
								//Hacer recorrido para incrementar acumulado
								for (intFP = 0; intFP < data.formas_pago.length; intFP++) 
								{ 
									//Incrementar acumulado
								  	importeFormasPago += parseFloat(data.formas_pago[intFP]['importe']);
								}

							}
							
							//Convertir cantidad a formato moneda
							intAcumImporte = '$'+formatMoney(importeFormasPago, 2, '');
							//Asignar los valores
							$('#acumImporte_formas_pago_pedidos_maquinaria_maquinaria').html(intAcumImporte);

							//Si el tipo de acción corresponde a Guardar
							if(tipoAccion == 'Guardar')
							{
								//Cambiar título del modal
								$('#tituloModal_autorizar_credito_pedidos_maquinaria_maquinaria').text('Notificar Pedido');
								$('#txtMensaje_autorizar_credito_pedidos_maquinaria_maquinaria').val('Favor de autorizar el pedido '+ strFolio);
								//Cargar el treeview
								get_treeview_usuarios_autorizar_credito_pedidos_maquinaria_maquinaria('');
							}
							else
							{
								//Quitar clase no-mostrar para mostrar div que contiene el estatus
								$('#divEstatus_autorizar_credito_pedidos_maquinaria_maquinaria').removeClass("no-mostrar");
								//Cambiar título del modal
								$('#tituloModal_autorizar_credito_pedidos_maquinaria_maquinaria').text('Autorizar crédito Pedido');
								//Cargar el treeview
								get_treeview_usuarios_autorizar_credito_pedidos_maquinaria_maquinaria(intReferenciaID);
							}

						   	//Abrir modal
							objAutorizarCreditoPedidosMaquinariaMaquinaria = $('#AutorizarCreditoPedidosMaquinariaMaquinariaBox').bPopup({
																	   appendTo: '#PedidosMaquinariaMaquinariaContent', 
											                           contentContainer: 'PedidosMaquinariaMaquinariaM', 
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
		function cerrar_autorizar_credito_pedidos_maquinaria_maquinaria()
		{
			try {
				//Cerrar modal
				objAutorizarCreditoPedidosMaquinariaMaquinaria.close();
				//Eliminar datos del treeview
				$("#treeUsuarios_autorizar_credito_pedidos_maquinaria_maquinaria").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_pedidos_maquinaria_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_autorizar_credito_pedidos_maquinaria_maquinaria()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosAutorizarCreditoPedidosMaquinariaMaquinaria = [];

			//Recorremos el treeview
			$("#treeUsuarios_autorizar_credito_pedidos_maquinaria_maquinaria").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosAutorizarCreditoPedidosMaquinariaMaquinaria.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtUsuarios_autorizar_credito_pedidos_maquinaria_maquinaria").val(arrSeleccionadosAutorizarCreditoPedidosMaquinariaMaquinaria.join('|'));

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_credito_pedidos_maquinaria_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmAutorizarCreditoPedidosMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_autorizar_credito_pedidos_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba un mensaje'}
											}
										},
										strUsuarios_autorizar_credito_pedidos_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un usuario para este mensaje.'}
											}
										},
										strEstatus_autorizar_credito_pedidos_maquinaria_maquinaria: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista estatus seleccionado cuando el tipo de acción sea Autorizar
					                                    if($('#txtTipoAccion_autorizar_credito_pedidos_maquinaria_maquinaria').val() === 'Autorizar' && $('#cmbEstatus_autorizar_credito_pedidos_maquinaria_maquinaria').val() == '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Seleccione un estatus'
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
			var bootstrapValidator_autorizar_credito_pedidos_maquinaria_maquinaria = $('#frmAutorizarCreditoPedidosMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_autorizar_credito_pedidos_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_autorizar_credito_pedidos_maquinaria_maquinaria.isValid())
			{
				//Variables para Validación de Total del Pedido y Total de Documentos
				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesFormasPagoPedidosMaquinariaMaquinaria = $.reemplazar($('#acumImporte_formas_pago_pedidos_maquinaria_maquinaria').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesFormasPagoPedidosMaquinariaMaquinaria = $.reemplazar(intAcumTotalDetallesFormasPagoPedidosMaquinariaMaquinaria, ",", "");
				var intImporteTotalPedidosMaquinariaMaquinaria = $.reemplazar($('#txtTotal_pedidos_maquinaria_maquinaria').val(), ",", "");

				//Si el tipo de acción corresponde a  AUTORIZADO
				if($('#cmbEstatus_autorizar_credito_pedidos_maquinaria_maquinaria').val() == 'AUTORIZADO')
				{
					//Si el prospecto es un cliente activo  y existe serie de la descripción de maquinaria
		        	if($('#txtEstatusCliente_autorizar_credito_pedidos_maquinaria_maquinaria').val() != 'ACTIVO')
		        	{
		        		//Hacer un llamado a la función para mostrar mensaje de error
						mensaje_pedidos_maquinaria_maquinaria('error', 'No es posible autorizar por que el prospecto aún no es un cliente.');
		        	}
					//Verificar que el importe total sea igual al total de detalles de formas de pago
					else if(intAcumTotalDetallesFormasPagoPedidosMaquinariaMaquinaria != intImporteTotalPedidosMaquinariaMaquinaria)
					{
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_pedidos_maquinaria_maquinaria('error', 'El importe total del pedido no coincide con el total de formas de pago, favor de verificar.');
					}
		        	else
	        		{
						//Hacer un llamado a la función para guardar la solicitud de autorización
					 	guardar_autorizar_credito_pedidos_maquinaria_maquinaria();
					}
				}
				else
				{
					//Hacer un llamado a la función para guardar la solicitud de autorización
					guardar_autorizar_credito_pedidos_maquinaria_maquinaria();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_autorizar_credito_pedidos_maquinaria_maquinaria()
		{
			try
			{
				$('#frmAutorizarCreditoPedidosMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar la autorización (o el rechazo) de un registro
		function guardar_autorizar_credito_pedidos_maquinaria_maquinaria()
		{
    		//Hacer un llamado al método del controlador para enviar la autorización (o el rechazo) de un registro 
			$.post('maquinaria/pedidos_maquinaria/set_enviar_autorizacion_credito',
			     {
			     	intPedidoMaquinariaID: $('#txtReferenciaID_autorizar_credito_pedidos_maquinaria_maquinaria').val(),
			      	intCotizacionMaquinariaID: $('#txtCotizacionMaquinariaID_autorizar_credito_pedidos_maquinaria_maquinaria').val(),
			      	strUsuarios: $('#txtUsuarios_autorizar_credito_pedidos_maquinaria_maquinaria').val(), 
			      	strMensaje:  $('#txtMensaje_autorizar_credito_pedidos_maquinaria_maquinaria').val(),
			      	strEstatus:  $('#cmbEstatus_autorizar_credito_pedidos_maquinaria_maquinaria').val(),
			      	strTipoAccion:  $('#txtTipoAccion_autorizar_credito_pedidos_maquinaria_maquinaria').val()
			     },
			     function(data) {
			        if(data.resultado)
			        {
			          	//Hacer llamado a la función  para cargar  los registros en el grid
			          	paginacion_pedidos_maquinaria_maquinaria();
			          	//Hacer un llamado a la función para cerrar modal
					  	cerrar_autorizar_credito_pedidos_maquinaria_maquinaria();

					  	//Si el id de la referencia (para generar el pedido) se recuperó del modal Pedidos 
					  	if($('#txtModalPedidosMaquinaria_autorizar_credito_pedidos_maquinaria_maquinaria').val() == 'SI')
					  	{
					  		//Hacer un llamado a la función para cerrar modal Pedidos
					 	 	cerrar_pedidos_maquinaria_maquinaria();
					  	}   
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_pedidos_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		/*Función que se utiliza para definir tree view de usuarios con acceso a la función Autorizar Crédito del proceso
		 *Pedidos (módulo Maquinaria)*/
		function get_treeview_usuarios_autorizar_credito_pedidos_maquinaria_maquinaria(id)
		{
			$('#treeUsuarios_autorizar_credito_pedidos_maquinaria_maquinaria').fancytree({
				source: {
					url: "seguridad/usuarios/get_treeview/AUTORIZAR_PEDIDOS_MAQUINARIA/PEDIDOS DE MAQUINARIA/"+id,
					cache: false
				},
				checkbox: true,
				selectMode: 3
			});
		}
		

		/*******************************************************************************************************************
		Funciones del modal Pedidos
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_pedidos_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmPedidosMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_pedidos_maquinaria_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmPedidosMaquinariaMaquinaria').find('input[type=hidden]').val('');
		    //Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_pedidos_maquinaria_maquinaria');
	  		//Eliminar los datos de la tabla
			$('#dg_componentes_pedidos_maquinaria_maquinaria tbody').empty();
			$('#numElementos_componentes_pedidos_maquinaria_maquinaria').html(0);
		    //Eliminar los datos de la tabla formas de pago
		    $('#dg_formas_pago_pedidos_maquinaria_maquinaria tbody').empty();  
		    $('#acumImporte_formas_pago_pedidos_maquinaria_maquinaria').html('');
		    $('#numElementos_formas_pago_pedidos_maquinaria_maquinaria').html(0);
			//Asignar NO para indicar que no se ha abierto el modal Autorizar Pedido
			$('#txtModalPedidosMaquinaria_autorizar_pedidos_maquinaria_maquinaria').val('NO');
			//Habilitar todos los elementos del formulario
			$('#frmPedidosMaquinariaMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');
			//Seleccionar tab que contiene la información general
	  		$('a[href="#informacion_general_pedidos_maquinaria_maquinaria"]').click();
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_pedidos_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtFecha_pedidos_maquinaria_maquinaria').attr("disabled", "disabled");
			$("#txtMoneda_pedidos_maquinaria_maquinaria").attr('disabled','disabled');
			$("#txtTipoCambio_pedidos_maquinaria_maquinaria").attr('disabled','disabled');
			$("#txtCotizacionMaquinaria_pedidos_maquinaria_maquinaria").attr('disabled','disabled');
			$("#txtProspecto_pedidos_maquinaria_maquinaria").attr('disabled','disabled');
			$("#txtCodigo_pedidos_maquinaria_maquinaria").attr('disabled','disabled');
			$("#txtDescripcionCorta_pedidos_maquinaria_maquinaria").attr('disabled','disabled');
			$("#txtPrecio_pedidos_maquinaria_maquinaria").attr('disabled','disabled');
			$("#txtPorcentajeDescuento_pedidos_maquinaria_maquinaria").attr('disabled','disabled');
			$("#txtPorcentajeIva_pedidos_maquinaria_maquinaria").attr('disabled','disabled');
			$("#txtPorcentajeIeps_pedidos_maquinaria_maquinaria").attr('disabled','disabled');
			$('#txtSubtotal_pedidos_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtTotal_pedidos_maquinaria_maquinaria').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_pedidos_maquinaria_maquinaria").show();
			//Habilitar botón Agregar
			$('#btnAgregar_formas_pago_pedidos_maquinaria_maquinaria').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnAutorizar_pedidos_maquinaria_maquinaria").hide();
			$("#btnAutorizarCredito_pedidos_maquinaria_maquinaria").hide();
			$("#btnImprimirRegistro_pedidos_maquinaria_maquinaria").hide();
			$("#btnDesactivar_pedidos_maquinaria_maquinaria").hide();
			$("#btnRestaurar_pedidos_maquinaria_maquinaria").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_pedidos_maquinaria_maquinaria()
		{
			try {
				

				//Si el id de la referencia (para generar el pedido) se recuperó del modal Pedidos 
				if($('#txtModalPedidosMaquinaria_autorizar_pedidos_maquinaria_maquinaria').val() == 'SI')
				{
					
					//Hacer un llamado a la función para cerrar modal Autorizar Pedido
					cerrar_autorizar_pedidos_maquinaria_maquinaria();
				}

				//Si el id de la referencia (para generar el pedido) se recuperó del modal Pedidos 
				if($('#txtModalPedidosMaquinaria_autorizar_credito_pedidos_maquinaria_maquinaria').val() == 'SI')
				{
					
					//Hacer un llamado a la función para cerrar modal Autorizar Crédito Pedido
					cerrar_autorizar_credito_pedidos_maquinaria_maquinaria();
				}


				//Cerrar modal
				objPedidosMaquinariaMaquinaria.close();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
			    cerrar_prospecto_pedidos_maquinaria_maquinaria();

				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_pedidos_maquinaria_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_pedidos_maquinaria_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_pedidos_maquinaria_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmPedidosMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strVendedor_pedidos_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vendedor
					                                    if($('#txtVendedorID_pedidos_maquinaria_maquinaria').val() === '')
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
										strFolioLegal_pedidos_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista un folio legal
					                                    if($('#txtFolioLegal_pedidos_maquinaria_maquinaria').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un folio pedido físico'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}
									}
				}).on('status.field.bv', function(e, data) {/*Nota: se agrega este fragmento de código para que se validen (al mismo tiempo) los campos obligatorios de todos los tabs*/
		            var $form_pedidos_maquinaria_maquinaria = $(e.target),
										                   validator = data.bv,
										                   $tabPane  = data.element.parents('.tab-pane'),
										                   tabId     = $tabPane.attr('id');
		            if (tabId) 
		            {
		            	var $icon_pedidos_maquinaria_maquinaria = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
		                //Agregar una clase personalizada a la pestaña que contiene el campo
		                if (data.status == validator.STATUS_INVALID) {
		                    $icon_pedidos_maquinaria_maquinaria.removeClass('fa-check').addClass('fa-times');
		                } else if (data.status == validator.STATUS_VALID) {
		                    var isValidTab = validator.isValidContainer($tabPane);
		                    $icon_pedidos_maquinaria_maquinaria.removeClass('fa-check fa-times')
		                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
		                }
		            }
		        });
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_pedidos_maquinaria_maquinaria = $('#frmPedidosMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_pedidos_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_pedidos_maquinaria_maquinaria.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_pedidos_maquinaria_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_pedidos_maquinaria_maquinaria()
		{
			try
			{
				$('#frmPedidosMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_pedidos_maquinaria_maquinaria()
		{
			//Obtenemos el objeto de la tabla formas de pago
			var objTabla = document.getElementById('dg_formas_pago_pedidos_maquinaria_maquinaria').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrTiposPagoIDMaquinariaPago = [];
			var arrImportesMaquinariaPago = [];
			var arrVencimientosMaquinariaPago = [];
			var arrObservacionesMaquinariaPago = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intImporte = $.reemplazar(objRen.cells[1].innerHTML, ",", "");
				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFechaVencimiento = $.formatFechaMysql(objRen.cells[2].innerHTML);
				
				//Asignar valores a los arrays
				arrTiposPagoIDMaquinariaPago.push(objRen.cells[5].innerHTML);
				arrObservacionesMaquinariaPago.push(objRen.cells[4].innerHTML);
				arrImportesMaquinariaPago.push(intImporte);
				arrVencimientosMaquinariaPago.push(dteFechaVencimiento);
			}

			//Obtenemos el objeto de la tabla componentes
			var objTabla = document.getElementById('dg_componentes_pedidos_maquinaria_maquinaria').getElementsByTagName('tbody')[0];
			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrMaquinariasDescripcionesID = [];
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Obtener valores desde la tabla
				var intMaquinariaDescripcionID = objRen.cells[2].innerHTML;
				//Asignar valores a los arrays
				arrMaquinariasDescripcionesID.push(intMaquinariaDescripcionID);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('maquinaria/pedidos_maquinaria/guardar',
			{ 
				//Datos del pedido
				intPedidoMaquinariaID: $('#txtPedidoMaquinariaID_pedidos_maquinaria_maquinaria').val(),
				intVendedorID: $('#txtVendedorID_pedidos_maquinaria_maquinaria').val(),
				strFolioLegal: $('#txtFolioLegal_pedidos_maquinaria_maquinaria').val(),
				strObservaciones: $('#txtObservaciones_pedidos_maquinaria_maquinaria').val(),
				strNotas: $('#txtNotas_pedidos_maquinaria_maquinaria').val(),
				//Datos de las formas de pago
				strTiposPagoIDMaquinariaPago: arrTiposPagoIDMaquinariaPago.join('|'),
				strObservacionesMaquinariaPago: arrObservacionesMaquinariaPago.join('|'),
				strImportesMaquinariaPago: arrImportesMaquinariaPago.join('|'),
				strVencimientosMaquinariaPago: arrVencimientosMaquinariaPago.join('|'),
				//Datos correspondientes a los componentes
				strMaquinariasDescripcionesID: arrMaquinariasDescripcionesID.join('|')
			},
			function(data) {
				if (data.resultado)
				{
 					//Hacer un llamado a la función para cerrar modal
                	cerrar_pedidos_maquinaria_maquinaria();

                	//Hacer un llamado a la función para abrir modal de autorización
					abrir_autorizar_pedidos_maquinaria_maquinaria('', 'Guardar');

					//Hacer llamado a la función  para cargar  los registros en el grid
           			paginacion_pedidos_maquinaria_maquinaria(); 
				}

				//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				mensaje_pedidos_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
			},
			'json');

			

		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_pedidos_maquinaria_maquinaria(tipoMensaje, mensaje)
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
		function cambiar_estatus_pedidos_maquinaria_maquinaria(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtPedidoMaquinariaID_pedidos_maquinaria_maquinaria').val();

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
						              'title':    'Pedidos',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                                //Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_pedidos_maquinaria_maquinaria(intID, strTipo, 'INACTIVO');

						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_pedidos_maquinaria_maquinaria(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_pedidos_maquinaria_maquinaria(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('maquinaria/pedidos_maquinaria/set_estatus',
			      {intPedidoMaquinariaID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_pedidos_maquinaria_maquinaria();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_pedidos_maquinaria_maquinaria();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_pedidos_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_pedidos_maquinaria_maquinaria(id, tipoAccion)
		{	
		   //Hacer un llamado al método del controlador para regresar los datos del registro
		   $.post('maquinaria/pedidos_maquinaria/get_datos',
	       {
	       		intPedidoMaquinariaID:id
	       },
	       function(data) {
	        	//Si hay datos del registro
	            if(data.row)
	            {

	            	//Hacer un llamado a la función para limpiar los campos del formulario
					nuevo_pedidos_maquinaria_maquinaria();
					//Asignar estatus del registro
				    var strEstatus = data.row.estatus;
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
		            $('#txtPedidoMaquinariaID_pedidos_maquinaria_maquinaria').val(data.row.pedido_maquinaria_id);
		            $('#txtFolio_pedidos_maquinaria_maquinaria').val(data.row.folio);
		            $('#txtFecha_pedidos_maquinaria_maquinaria').val(data.row.fecha);
		            $('#txtMoneda_pedidos_maquinaria_maquinaria').val(data.row.moneda_descripcion);
		            $('#txtTipoCambio_pedidos_maquinaria_maquinaria').val(data.row.tipo_cambio);
		            $('#txtCotizacionMaquinaria_pedidos_maquinaria_maquinaria').val(data.row.folio_cotizacion);
		            $('#txtProspectoID_pedidos_maquinaria_maquinaria').val(data.row.prospecto_id);
				    $('#txtProspecto_pedidos_maquinaria_maquinaria').val(data.row.prospecto);
				    $('#txtVendedorID_pedidos_maquinaria_maquinaria').val(data.row.vendedor_id);
				    $('#txtVendedor_pedidos_maquinaria_maquinaria').val(data.row.vendedor);
				    $('#txtFolioLegal_pedidos_maquinaria_maquinaria').val(data.row.folio_legal);
				    $('#txtObservaciones_pedidos_maquinaria_maquinaria').val(data.row.observaciones);
				    $('#txtNotas_pedidos_maquinaria_maquinaria').val(data.row.notas);
				    $('#txtMaquinariaDescripcionID_pedidos_maquinaria_maquinaria').val(data.row.maquinaria_descripcion_id);
				    $('#txtInventarioMaquinariaDescripcionID_pedidos_maquinaria_maquinaria').val(data.row.serie);
				    $('#txtCodigo_pedidos_maquinaria_maquinaria').val(data.row.codigo);
				    $('#txtDescripcionCorta_pedidos_maquinaria_maquinaria').val(data.row.descripcion_corta);
					$('#txtPrecio_pedidos_maquinaria_maquinaria').val(intPrecio);
					$('#txtPrecio_pedidos_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
					$('#txtPorcentajeDescuento_pedidos_maquinaria_maquinaria').val(intPorcentajeDescuento);
					$('#txtPorcentajeIva_pedidos_maquinaria_maquinaria').val(data.row.porcentaje_iva);
				    $('#txtPorcentajeIeps_pedidos_maquinaria_maquinaria').val(data.row.porcentaje_ieps);
			      	//Hacer un llamado a la función para calcular el importe total del pedido
					calcular_total_pedidos_maquinaria_maquinaria();
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
				    $('#txtPrecio_pedidos_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
				    $('#txtEstatus_pedidos_maquinaria_maquinaria').val(strEstatus);
					//Dependiendo del estatus cambiar el color del encabezado 
		            $('#divEncabezadoModal_pedidos_maquinaria_maquinaria').addClass("estatus-"+strEstatus);
		            //Mostrar botón Imprimir  
		            $("#btnImprimirRegistro_pedidos_maquinaria_maquinaria").show();

		            //Hacer llamado a la función  para cargar los documentos activos en el grid
		            documentos_expediente_pedidos_maquinaria_maquinaria();


					//Si el tipo de acción corresponde a Ver
		            if(tipoAccion == 'Ver')
		            {
		            	//Deshabilitar todos los elementos del formulario
		            	$('#frmPedidosMaquinariaMaquinaria').find('input, textarea, select').attr('disabled','disabled');
		            	//Ocultar los siguientes botones
			            $("#btnGuardar_pedidos_maquinaria_maquinaria").hide();
			            //Deshabilitar botón Agregar
						$('#btnAgregar_formas_pago_pedidos_maquinaria_maquinaria').prop('disabled', true);

			            //Si el estatus del registro es INACTIVO
		            	if(strEstatus == 'INACTIVO')
		            	{
		            		//Mostrar botón Restaurar
		            		$("#btnRestaurar_pedidos_maquinaria_maquinaria").show();
		            	}

		            }
		            else
		            {

		            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
										   " onclick='editar_renglon_formas_pago_pedidos_maquinaria_maquinaria(this)'>" + 
										   "<span class='glyphicon glyphicon-edit'></span></button>" + 
										   "<button class='btn btn-default btn-xs' title='Eliminar'" +
										   " onclick='eliminar_renglon_formas_pago_pedidos_maquinaria_maquinaria(this)'>" + 
										   "<span class='glyphicon glyphicon-trash'></span></button>" + 
										   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
										   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
										   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
										   "<span class='glyphicon glyphicon-arrow-down'></span></button>";

		            	//Mostrar los siguientes botones
		            	$("#btnDesactivar_pedidos_maquinaria_maquinaria").show();
		            	$("#btnAutorizar_pedidos_maquinaria_maquinaria").show();
		            	$("#btnAutorizarCredito_pedidos_maquinaria_maquinaria").show();
		            }


		            //Mostramos las formas de pago del registro
		            for (var intCon in data.formas_pago) 
		            {
		            	//Obtenemos el objeto de la tabla
						var objTabla = document.getElementById('dg_formas_pago_pedidos_maquinaria_maquinaria').getElementsByTagName('tbody')[0];
						
						//Insertamos el renglón con sus celdas en el objeto de la tabla
						var objRenglon = objTabla.insertRow();
						var objCeldaDescripcion = objRenglon.insertCell(0);
						var objCeldaImporte = objRenglon.insertCell(1);
						var objCeldaFechaVencimiento = objRenglon.insertCell(2);
						var objCeldaAcciones = objRenglon.insertCell(3);
						var objCeldaObservaciones = objRenglon.insertCell(4);
						var objCeldaTipoPagoID = objRenglon.insertCell(5);

						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', data.formas_pago[intCon].renglon);
						objCeldaDescripcion.setAttribute('class', 'movil c1');
						objCeldaDescripcion.innerHTML = data.formas_pago[intCon].documento_pago;
						objCeldaImporte.setAttribute('class', 'movil c2');
						objCeldaImporte.innerHTML = formatMoney(data.formas_pago[intCon].importe, 2, '') 
						objCeldaFechaVencimiento.setAttribute('class', 'movil c3');
						objCeldaFechaVencimiento.innerHTML = data.formas_pago[intCon].vencimiento;
						objCeldaAcciones.setAttribute('class', 'td-center movil c4');
						objCeldaAcciones.innerHTML = strAccionesTabla;
						objCeldaObservaciones.setAttribute('class', 'no-mostrar');
						objCeldaObservaciones.innerHTML = data.formas_pago[intCon].observaciones;
						objCeldaTipoPagoID.setAttribute('class', 'no-mostrar');
						objCeldaTipoPagoID.innerHTML = data.formas_pago[intCon].documento_pago_id;
					}

					//Mostramos los componentes que componen la maquinaria(En caso de que aplique)
					for (var intCon in data.componentes_maquinaria) 
		            {	
		            	//Obtenemos el objeto de la tabla
						var objTabla = document.getElementById('dg_componentes_pedidos_maquinaria_maquinaria').getElementsByTagName('tbody')[0];
						
						//Insertamos el renglón con sus celdas en el objeto de la tabla
						var objRenglon = objTabla.insertRow();
						var objCeldaCodigo = objRenglon.insertCell(0);
						var objCeldaDescripcionCorta = objRenglon.insertCell(1);
						var objCeldaMaquinariaDescripcionID = objRenglon.insertCell(2);

						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', data.componentes_maquinaria[intCon].codigo); 
						objCeldaCodigo.setAttribute('class', 'movil b1');
						objCeldaCodigo.innerHTML = data.componentes_maquinaria[intCon].codigo;
						objCeldaDescripcionCorta.setAttribute('class', 'movil b2');
						objCeldaDescripcionCorta.innerHTML = data.componentes_maquinaria[intCon].descripcion_corta;
						objCeldaMaquinariaDescripcionID.setAttribute('class', 'no-mostrar');
						objCeldaMaquinariaDescripcionID.innerHTML = data.componentes_maquinaria[intCon].maquinaria_descripcion_componente_id;

						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						var intFilas = $("#dg_componentes_pedidos_maquinaria_maquinaria tr").length - 1;
						$('#numElementos_componentes_pedidos_maquinaria_maquinaria').html(intFilas);
		            }

					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_formas_pago_pedidos_maquinaria_maquinaria();
					//Asignar el número de filas de la tabla formas de pago (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
					var intFilas = $("#dg_formas_pago_pedidos_maquinaria_maquinaria tr").length - 2;
					$('#numElementos_formas_pago_pedidos_maquinaria_maquinaria').html(intFilas);

	            	//Abrir modal
		            objPedidosMaquinariaMaquinaria = $('#PedidosMaquinariaMaquinariaBox').bPopup({
												  appendTo: '#PedidosMaquinariaMaquinariaContent', 
					                              contentContainer: 'PedidosMaquinariaMaquinariaM', 
					                              zIndex: 2, 
					                              modalClose: false, 
					                              modal: true, 
					                              follow: [true,false], 
					                              followEasing : "linear", 
					                              easing: "linear", 
					                              modalColor: ('#F0F0F0')});

		            //Enfocar caja de texto
					$('#txtVendedor_pedidos_maquinaria_maquinaria').focus();
	       	    }
	       	    
	       	 
	       },
	       'json');

		}

		//Función que se utiliza para calcular el importe total del pedido
		function calcular_total_pedidos_maquinaria_maquinaria()
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
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_pedidos_maquinaria_maquinaria').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_pedidos_maquinaria_maquinaria').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_pedidos_maquinaria_maquinaria').val();

         	 
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			intSubtotal = parseFloat($.reemplazar($("#txtPrecio_pedidos_maquinaria_maquinaria").val(), ",", ""));
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
				//Calcular importe del descuento
				intImporteDescuento =  (intSubtotal * intPorcentajeDescuento) / 100;
				//Restar descuento del subtotal
				intSubtotal = intSubtotal - intImporteDescuento;
			}

			//Si existe porcentaje de IVA
			if(intPorcentajeIva > 0)
			{
				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
			}

			//Si existe porcentaje de IEPS
			if(intPorcentajeIeps > 0)
			{
				//Calcular importe de IEPS
				intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
			}

			//Calcular importe total
			intTotal = (intSubtotal + intImporteIva + intImporteIeps);

			//Cambiar cantidad a formato moneda
			intTotal = formatMoney(intTotal, 2, '');
			intSubtotal = formatMoney(intSubtotal, 2, '');
			intPorcentajeDescuento = formatMoney(intPorcentajeDescuento, 2, ''); 

			//Asignar importe total 
			$('#txtTotal_pedidos_maquinaria_maquinaria').val(intTotal);
			$('#txtSubtotal_pedidos_maquinaria_maquinaria').val(intSubtotal);
			$('#txtPorcentajeDescuento_pedidos_maquinaria_maquinaria').val(intPorcentajeDescuento);
		}

		/*******************************************************************************************************************
		Funciones del Tab - Componentes
		*********************************************************************************************************************/
		

		/*******************************************************************************************************************
		Funciones del Tab - Formas de Pago
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_formas_pago_pedidos_maquinaria_maquinaria()
		{			
			//Obtenemos los datos de las cajas de texto
			var renglon =  parseInt( $('#txtRenglon_formas_pago_pedidos_maquinaria_maquinaria').val() );
			var intTipoPagoID = $('#txtDescripcionID_formas_pago_pedidos_maquinaria_maquinaria').val();
			var strDescripcion = $('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').val();
			var intImporte = $('#txtImporte_formas_pago_pedidos_maquinaria_maquinaria').val();
			var dteFechaVencimiento = $('#txtFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria').val();
			var strObservaciones = $('#txtObservaciones_formas_pago_pedidos_maquinaria_maquinaria').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_formas_pago_pedidos_maquinaria_maquinaria').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intTipoPagoID == '' || strDescripcion == '')
			{
				//Enfocar caja de texto
				$('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').focus();
			}
			else if (intImporte == '')
			{
				//Enfocar caja de texto
				$('#txtImporte_formas_pago_pedidos_maquinaria_maquinaria').focus();
			}
			else if (dteFechaVencimiento == '')
			{
				//Enfocar caja de texto
				$('#txtFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria').focus();
			}
			else if(dteFechaVencimiento != '' && dteFechaVencimiento.length != 10)
			{
				//Limpiar caja de texto
				$('#txtFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria').val('');
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtRenglon_formas_pago_pedidos_maquinaria_maquinaria').val('');
				$('#txtDescripcionID_formas_pago_pedidos_maquinaria_maquinaria').val('');
				$('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').val('');
				$('#txtImporte_formas_pago_pedidos_maquinaria_maquinaria').val('');
				$('#txtFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria').val('');
				$('#txtObservaciones_formas_pago_pedidos_maquinaria_maquinaria').val('');

				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strDescripcion = strDescripcion.toUpperCase();
				//Convertir cadena de texto a número decimal
				intImporte = parseFloat($.reemplazar(intImporte, ",", ""));

				//Cambiar cantidad a  formato moneda (a visualizar)
				intImporte =  formatMoney(intImporte, 2, '');

				//Revisamos si existe la descripción proporcionada, si es así, editamos los datos
				if (objTabla.rows.namedItem(renglon))
				{
					objTabla.rows.namedItem(renglon).cells[0].innerHTML = strDescripcion;
					objTabla.rows.namedItem(renglon).cells[1].innerHTML = intImporte; 
					objTabla.rows.namedItem(renglon).cells[2].innerHTML = dteFechaVencimiento;
					objTabla.rows.namedItem(renglon).cells[4].innerHTML = strObservaciones;
					objTabla.rows.namedItem(renglon).cells[5].innerHTML = intTipoPagoID;	
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaDescripcion = objRenglon.insertCell(0);
					var objCeldaImporte = objRenglon.insertCell(1);
					var objCeldaFechaVencimiento = objRenglon.insertCell(2);
					var objCeldaAcciones = objRenglon.insertCell(3);
					var objCeldaObservaciones = objRenglon.insertCell(4);
					var objCeldaTipoPagoID = objRenglon.insertCell(5);

					//Siguiente renglón
					var renglonSiguiente = $("#dg_formas_pago_pedidos_maquinaria_maquinaria tr").length - 2;

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', renglonSiguiente);
					objCeldaDescripcion.setAttribute('class', 'movil c1');
					objCeldaDescripcion.innerHTML = strDescripcion;
					objCeldaImporte.setAttribute('class', 'movil c2');
					objCeldaImporte.innerHTML = intImporte; 
					objCeldaFechaVencimiento.setAttribute('class', 'movil c3');
					objCeldaFechaVencimiento.innerHTML = dteFechaVencimiento;
					objCeldaAcciones.setAttribute('class', 'td-center movil c4');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_formas_pago_pedidos_maquinaria_maquinaria(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_formas_pago_pedidos_maquinaria_maquinaria(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaObservaciones.setAttribute('class', 'no-mostrar');
					objCeldaObservaciones.innerHTML = strObservaciones;
					objCeldaTipoPagoID.setAttribute('class', 'no-mostrar');
					objCeldaTipoPagoID.innerHTML = intTipoPagoID;
				}

			    //Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_formas_pago_pedidos_maquinaria_maquinaria();

				//Enfocar caja de texto
				$('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').focus();
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_formas_pago_pedidos_maquinaria_maquinaria tr").length - 2;
			$('#numElementos_formas_pago_pedidos_maquinaria_maquinaria').html(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_formas_pago_pedidos_maquinaria_maquinaria(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRenglon_formas_pago_pedidos_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.rowIndex);
			$('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtImporte_formas_pago_pedidos_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtObservaciones_formas_pago_pedidos_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
			$('#txtDescripcionID_formas_pago_pedidos_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[5].innerHTML);
			//Enfocar caja de texto
			$('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_formas_pago_pedidos_maquinaria_maquinaria(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_formas_pago_pedidos_maquinaria_maquinaria").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_formas_pago_pedidos_maquinaria_maquinaria();

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_formas_pago_pedidos_maquinaria_maquinaria tr").length - 2;
			$('#numElementos_formas_pago_pedidos_maquinaria_maquinaria').html(intFilas);

			//Limpiamos las cajas de texto
			$('#txtRenglon_formas_pago_pedidos_maquinaria_maquinaria').val('');
			$('#txtDescripcionID_formas_pago_pedidos_maquinaria_maquinaria').val('');
			$('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').val('');
			$('#txtImporte_formas_pago_pedidos_maquinaria_maquinaria').val('');
			$('#txtFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria').val('');
			$('#txtObservaciones_formas_pago_pedidos_maquinaria_maquinaria').val('');
			//Enfocar caja de texto
			$('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_formas_pago_pedidos_maquinaria_maquinaria()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_formas_pago_pedidos_maquinaria_maquinaria').getElementsByTagName('tbody')[0];
			//Inicializamos la variable que se utiliza para el acumulado de importes
			var intAcumImporte = 0;
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulado
				intAcumImporte +=  parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
			}

			//Convertir cantidad a formato moneda
			intAcumImporte = '$'+formatMoney(intAcumImporte, 2, '');
			//Asignar los valores
			$('#acumImporte_formas_pago_pedidos_maquinaria_maquinaria').html(intAcumImporte);
		}


		/*******************************************************************************************************************
		Funciones del Tab - Expediente
		*********************************************************************************************************************/
		//Función para la búsqueda de documentos activos
		function documentos_expediente_pedidos_maquinaria_maquinaria() 
		{
			//Variable que se utiliza para asignar el estatus del pedido
			var strEstatusPedido = $('#txtEstatus_pedidos_maquinaria_maquinaria').val();

			//Si el estatus del pedido corresponde a RECHAZADO
			if(strEstatusPedido == 'RECHAZADO')
			{
				//Cambiar estatus para evitar mostrar las acciones en el grid view
				strEstatusPedido = 'INACTIVO';
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_cobrar/documentos_clientes/get_activos',
					{	strTipo: 'Cliente',
						intID: $('#txtProspectoID_pedidos_maquinaria_maquinaria').val(),
						strEstatus: strEstatusPedido,
						strPermisosAcceso: $('#txtAcciones_pedidos_maquinaria_maquinaria').val()
					},
					function(data){
						$('#dg_expediente_pedidos_maquinaria_maquinaria tbody').empty();
						var tmpExpedientePedidosMaquinariaMaquinariar = Mustache.render($('#plantilla_expediente_pedidos_maquinaria_maquinaria').html(),data);
						$('#dg_expediente_pedidos_maquinaria_maquinaria tbody').html(tmpExpedientePedidosMaquinariaMaquinariar);
						$('#numElementos_expediente_pedidos_maquinaria_maquinaria').html(data.total_rows);
					},
			'json');
		}

		//Función para subir archivo (o imagen) de un registro desde el grid view
		function subir_archivo_expediente_pedidos_maquinaria_maquinaria(documentoID)
		{
	
			//Variable que se utiliza para asignar archivo
			var strBotonArchivoIDExpedientePedidosMaquinariaMaquinariar="archivo_pedidos_maquinaria_maquinaria"+documentoID;
			//Obtenemos un array con los datos del archivo
	        var file = $("#"+strBotonArchivoIDExpedientePedidosMaquinariaMaquinariar)[0].files[0];
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
			  				$('#'+strBotonArchivoIDExpedientePedidosMaquinariaMaquinariar).val('');
						   	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_pedidos_maquinaria_maquinaria('error', data.mensaje);
						}
						else
						{	
							//Hacer un llamado al método del controlador para subir archivo del registro
							$('#'+strBotonArchivoIDExpedientePedidosMaquinariaMaquinariar).upload('cuentas_cobrar/clientes/subir_archivo',
									{ intDocumentoID:documentoID,
						      		  intProspectoID:$('#txtProspectoID_pedidos_maquinaria_maquinaria').val(),
						      		  strBotonArchivoID: strBotonArchivoIDExpedientePedidosMaquinariaMaquinariar
									},
									function(data) {
										//Limpia ruta del archivo cargado
						         		$('#'+strBotonArchivoIDExpedientePedidosMaquinariaMaquinariar).val('');
										//Subida finalizada.
										if (data.resultado)
										{
						         			//Hacer llamado a la función  para cargar  los registros de los documentos (expediente) en el grid
						          	        documentos_expediente_pedidos_maquinaria_maquinaria();
										}
										//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
										mensaje_pedidos_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
									});
						}
				     },
				     'json');
		}

		//Función que se utiliza para descargar el archivo (o imagen) del registro seleccionado
		function descargar_archivo_expediente_pedidos_maquinaria_maquinaria(documentoID)
		{
			
			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'cuentas_cobrar/clientes/descargar_archivo',
							'data' : {
										'intProspectoID': $('#txtProspectoID_pedidos_maquinaria_maquinaria').val(),
										'intDocumentoID': documentoID				
									 }
						   };

			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);
		}


		//Función que se utiliza para eliminar el archivo (o imagen) del registro seleccionado
		function eliminar_archivo_expediente_pedidos_maquinaria_maquinaria(documentoID)
		{
			 //Hacer un llamado al método del controlador para eliminar el archivo del registro
			 $.post('cuentas_cobrar/clientes/eliminar_archivo',
		     {
		     	intProspectoID: $('#txtProspectoID_pedidos_maquinaria_maquinaria').val(),
		      	intDocumentoID: documentoID
		     },
		     function(data) {
		        if(data.resultado)
		        {
		         	//Hacer llamado a la función  para cargar  los registros de los documentos (expediente) en el grid
	          	    documentos_expediente_pedidos_maquinaria_maquinaria();
		        }
		        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		        mensaje_pedidos_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
		     },
		    'json');
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Autorizar Pedido
			*********************************************************************************************************************/
			//Modificar el mensaje cuando cambie la opción del combobox
	        $('#cmbEstatus_autorizar_pedidos_maquinaria_maquinaria').change(function(e){   
	        	//Variables que se utilizan para el mensaje informativo
	        	var strEstatus = $('#cmbEstatus_autorizar_pedidos_maquinaria_maquinaria').val();
	        	var strMensaje = '';
	        	var strFolio = $('#txtFolio_autorizar_pedidos_maquinaria_maquinaria').val();
	        	
	        	//Si existe estatus seleccionado
	        	if(strEstatus != '')
	        	{
	        		strMensaje += 'Se ';
	        		
	        		//Dependiendo del estatus modificar mensaje
	              	if($('#cmbEstatus_autorizar_pedidos_maquinaria_maquinaria').val() === 'AUTORIZADO')
	             	{
	             		strMensaje += 'autorizó ';
	             	}
	             	else
	             	{
	             		strMensaje += 'rechazó ';
	             	}

	             	//Agregar folio en el mensaje
	             	strMensaje += ' el pedido '+strFolio;
	        	}
	           

             	//Asignar mensaje informativo
             	$('#txtMensaje_autorizar_pedidos_maquinaria_maquinaria').val(strMensaje);
				
	        });

	        /*******************************************************************************************************************
			Controles correspondientes al modal Autorizar Crédito del Pedido
			*********************************************************************************************************************/
			//Modificar el mensaje cuando cambie la opción del combobox
	        $('#cmbEstatus_autorizar_credito_pedidos_maquinaria_maquinaria').change(function(e){   
	        	//Variables que se utilizan para el mensaje informativo
	        	var strEstatus = $('#cmbEstatus_autorizar_credito_pedidos_maquinaria_maquinaria').val();
	        	var strMensaje = '';
	        	var strFolio = $('#txtFolio_autorizar_credito_pedidos_maquinaria_maquinaria').val();
	        	
	        	//Si existe estatus seleccionado
	        	if(strEstatus != '')
	        	{
	        		strMensaje += 'Se ';
	        		
	        		//Dependiendo del estatus modificar mensaje
	              	if($('#cmbEstatus_autorizar_credito_pedidos_maquinaria_maquinaria').val() === 'AUTORIZADO')
	             	{
	             		strMensaje += 'autorizó el crédito';
	             	}
	             	else
	             	{
	             		strMensaje += 'rechazó el crédito';
	             	}

	             	//Agregar folio en el mensaje
	             	strMensaje += ' el pedido '+strFolio;
	        	}
	           

             	//Asignar mensaje informativo
             	$('#txtMensaje_autorizar_credito_pedidos_maquinaria_maquinaria').val(strMensaje);
				
	        });


			/*******************************************************************************************************************
			Controles correspondientes al modal Pedidos
			*********************************************************************************************************************/
			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Información General
        	*********************************************************************************************************************/
	        //Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_pedidos_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorID_pedidos_maquinaria_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: intModuloIDPedidosMaquinariaMaquinaria
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorID_pedidos_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtVendedor_pedidos_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_pedidos_maquinaria_maquinaria').val() == '' ||
	               $('#txtVendedor_pedidos_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_pedidos_maquinaria_maquinaria').val('');
	               $('#txtVendedor_pedidos_maquinaria_maquinaria').val('');
	            }
	            
	        });


			/*******************************************************************************************************************
        	Controles correspondientes al  Tab - Formas de Pago
        	*********************************************************************************************************************/
        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
            $('.moneda_pedidos_maquinaria_maquinaria').blur(function(){
                $('.moneda_pedidos_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
            });

            //Validar campos decimales (no hay necesidad de poner '.')
			$('#txtImporte_formas_pago_pedidos_maquinaria_maquinaria').numeric();

			//Agregar datepicker para seleccionar fecha
			$('#dteFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});


        	//Autocomplete para recuperar los datos de una forma de pago 
	        $('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtDescripcionID_formas_pago_pedidos_maquinaria_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_cobrar/documentos_pagos/autocomplete",
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
	             $('#txtDescripcionID_formas_pago_pedidos_maquinaria_maquinaria').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de una forma de pago cuando pierda el enfoque la caja de texto
	        $('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id de la forma de pago
	            if($('#txtDescripcionID_formas_pago_pedidos_maquinaria_maquinaria').val() == '' ||
	               $('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtDescripcionID_formas_pago_pedidos_maquinaria_maquinaria').val('');
	               $('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').val('');
	               $('#txtRenglon_formas_pago_pedidos_maquinaria_maquinaria').val('');
	            }
	            
	        });


			//Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });


			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_formas_pago_pedidos_maquinaria_maquinaria').on('click','button.btn',function(){
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

			//Validar que exista descripción cuando se pulse la tecla enter 
			$('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe descripción
		           if($('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtDescripcion_formas_pago_pedidos_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtImporte_formas_pago_pedidos_maquinaria_maquinaria').focus();
			   	    }
		        }
		    });

		    //Validar que exista importe cuando se pulse la tecla enter 
			$('#txtImporte_formas_pago_pedidos_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe importe
		            if($('#txtImporte_formas_pago_pedidos_maquinaria_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtImporte_formas_pago_pedidos_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	    	$('#txtFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria').focus();
			   	    }
		        }
		    });

		    //Agregar renglón a la tabla cuando pierda el enfoque la caja de texto
			$('#txtFechaVencimiento_formas_pago_pedidos_maquinaria_maquinaria').focusout(function(e) {
				//Enfocar caja de texto
				$('#txtObservaciones_formas_pago_pedidos_maquinaria_maquinaria').focus();
			});



			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_pedidos_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_pedidos_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_pedidos_maquinaria_maquinaria').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_pedidos_maquinaria_maquinaria').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_pedidos_maquinaria_maquinaria').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_pedidos_maquinaria_maquinaria').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un prospecto o cliente
	        $('#txtProspectoBusq_pedidos_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_pedidos_maquinaria_maquinaria').val('');
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
	             $('#txtProspectoIDBusq_pedidos_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtProspectoBusq_pedidos_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoIDBusq_pedidos_maquinaria_maquinaria').val() == '' ||
	               $('#txtProspectoBusq_pedidos_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_pedidos_maquinaria_maquinaria').val('');
	               $('#txtProspectoBusq_pedidos_maquinaria_maquinaria').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_pedidos_maquinaria_maquinaria').on('click','a',function(event){
				event.preventDefault();
				intPaginaPedidosMaquinariaMaquinaria = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_pedidos_maquinaria_maquinaria();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_pedidos_maquinaria_maquinaria').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_pedidos_maquinaria_maquinaria();
		});
	</script>