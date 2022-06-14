	<div id="CotizacionesMaquinariaMaquinariaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_cotizaciones_maquinaria_maquinaria" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_cotizaciones_maquinaria_maquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_cotizaciones_maquinaria_maquinaria">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_cotizaciones_maquinaria_maquinaria'>
				                    <input class="form-control" id="txtFechaInicialBusq_cotizaciones_maquinaria_maquinaria"
				                    		name= "strFechaInicialBusq_cotizaciones_maquinaria_maquinaria" 
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
								<label for="txtFechaFinalBusq_cotizaciones_maquinaria_maquinaria">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_cotizaciones_maquinaria_maquinaria'>
				                    <input class="form-control" id="txtFechaFinalBusq_cotizaciones_maquinaria_maquinaria"
				                    		name= "strFechaFinalBusq_cotizaciones_maquinaria_maquinaria" 
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
								<input id="txtProspectoIDBusq_cotizaciones_maquinaria_maquinaria" 
									   name="intProspectoIDBusq_cotizaciones_maquinaria_maquinaria"  type="hidden" 
									   value="">
								</input>
								<label for="txtProspectoBusq_cotizaciones_maquinaria_maquinaria">Prospecto / Cliente</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProspectoBusq_cotizaciones_maquinaria_maquinaria" 
										name="strProspectoBusq_cotizaciones_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese prospecto o cliente" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_cotizaciones_maquinaria_maquinaria">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_cotizaciones_maquinaria_maquinaria" 
								 		name="strEstatusBusq_cotizaciones_maquinaria_maquinaria" tabindex="1">
								    <option value="TODOS">TODOS</option>
	                  				<option value="ACTIVO">ACTIVO</option>
	                  				<option value="PEDIDO">PEDIDO</option>
	                  				<option value="FACTURADO">FACTURADO</option>
	                  				<option value="RECHAZADO">RECHAZADO</option>
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
								<label for="txtBusqueda_cotizaciones_maquinaria_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_cotizaciones_maquinaria_maquinaria" 
										name="strBusqueda_cotizaciones_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_cotizaciones_maquinaria_maquinaria" 
									   name="strImprimirDetalles_cotizaciones_maquinaria_maquinaria" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_cotizaciones_maquinaria_maquinaria"
									onclick="paginacion_cotizaciones_maquinaria_maquinaria();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_cotizaciones_maquinaria_maquinaria" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_cotizaciones_maquinaria_maquinaria"
									onclick="reporte_cotizaciones_maquinaria_maquinaria('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_cotizaciones_maquinaria_maquinaria"
									onclick="reporte_cotizaciones_maquinaria_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button>
						</div>
					</div>
			    </div>
			   <div class="row">

				</div>
			</form><!--Cierre del formulario-->
		</div><!--Cierre de barra de herramientas-->
		<!--Estilo que se utiliza para mostrar los nombres de las columnas de la tabla en el dispositivo móvil -->
		<style>
			@media (max-width: 480px) 
			{
			    /*
				Definir columnas
				*/
				td.movil:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Prospecto / Cliente"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_cotizaciones_maquinaria_maquinaria">
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
					<script id="plantilla_cotizaciones_maquinaria_maquinaria" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{folio}}</td>
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{prospecto}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_cotizaciones_maquinaria_maquinaria({{cotizacion_maquinaria_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_cotizaciones_maquinaria_maquinaria({{cotizacion_maquinaria_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
							    <!--- Generar pedido o rechazar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionAutorizar}}"  
										onclick="abrir_pedido_cotizaciones_maquinaria_maquinaria({{cotizacion_maquinaria_id}},'{{folio}}', 'Pedido');"  title="Generar pedido">
									<span class="glyphicon glyphicon-file"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_prospecto_cotizaciones_maquinaria_maquinaria({{cotizacion_maquinaria_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="abrir_impresion_cotizaciones_maquinaria_maquinaria({{cotizacion_maquinaria_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_cotizaciones_maquinaria_maquinaria({{cotizacion_maquinaria_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_cotizaciones_maquinaria_maquinaria({{cotizacion_maquinaria_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_cotizaciones_maquinaria_maquinaria"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_cotizaciones_maquinaria_maquinaria">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Generar Pedido de la Cotización-->
		<div id="PedidoCotizacionesMaquinariaMaquinariaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_pedido_cotizaciones_maquinaria_maquinaria" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Generar Pedido</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmPedidoCotizacionesMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmPedidoCotizacionesMaquinariaMaquinaria"  onsubmit="return(false)" autocomplete="off">
			    	<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReferenciaID_pedido_cotizaciones_maquinaria_maquinaria" 
										   name="intReferenciaID_pedido_cotizaciones_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Cotizaciones-->
									<input id="txtModalCotizacionesMaquinaria_pedido_cotizaciones_maquinaria_maquinaria" 
										   name="strModalCotizacionesMaquinaria_pedido_cotizaciones_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para asignar a los usuarios que se les enviará 
									     el mensaje--> 
									<input type="hidden" id="txtUsuarios_pedido_cotizaciones_maquinaria_maquinaria" 
										   name="strUsuarios_pedido_cotizaciones_maquinaria_maquinaria" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Enviar notificación a:</h4>
										</div>
										<div class="panel-body">
											<div id="treeUsuarios_pedido_cotizaciones_maquinaria_maquinaria" class="md-list-item-text"></div>
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
									<label for="txtMensaje_pedido_cotizaciones_maquinaria_maquinaria">Mensaje</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtMensaje_pedido_cotizaciones_maquinaria_maquinaria" 
											   name="strMensaje_pedido_cotizaciones_maquinaria_maquinaria" rows="5" value="" tabindex="1" placeholder="Ingrese mensaje" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Generar pedido o rechazar registro-->
							<button class="btn btn-success" id="btnGuardar_pedido_cotizaciones_maquinaria_maquinaria"  
									onclick="validar_pedido_cotizaciones_maquinaria_maquinaria();"  title="Enviar" tabindex="1">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_pedido_cotizaciones_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_pedido_cotizaciones_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Generar Pedido de la Cotización-->

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarCotizacionesMaquinariaMaquinariaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_prospecto_cotizaciones_maquinaria_maquinaria" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarCotizacionesMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarCotizacionesMaquinariaMaquinaria"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Prospecto / Cliente-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtCotizacionMaquinariaID_prospecto_cotizaciones_maquinaria_maquinaria" 
										   name="intCotizacionMaquinariaID_prospecto_cotizaciones_maquinaria_maquinaria" 
										   type="hidden" value="" />
									<label for="txtProspecto_prospecto_cotizaciones_maquinaria_maquinaria">Prospecto / Cliente</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProspecto_prospecto_cotizaciones_maquinaria_maquinaria" 
											name="strProspecto_prospecto_cotizaciones_maquinaria_maquinaria" type="text" value="" 
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
									<label for="txtCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria" 
											name="strCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria" 
											name="strCopiaCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_prospecto_cotizaciones_maquinaria_maquinaria" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_prospecto_cotizaciones_maquinaria_maquinaria"  
									onclick="validar_prospecto_cotizaciones_maquinaria_maquinaria();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_prospecto_cotizaciones_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_prospecto_cotizaciones_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal crear Formato de la Cotización en PDF-->
		<div id="ImpresionCotizacionesMaquinariaMaquinariaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_impresion_cotizaciones_maquinaria_maquinaria" class="ModalBodyTitle confirmacion-modal-title"">
				<h1>Impresión de Formato</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmImpresionCotizacionesMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmImpresionCotizacionesMaquinariaMaquinaria"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
						<input id="txtCotizacionMaquinariaID_impresion_cotizaciones_maquinaria_maquinaria" 
							   name="intCotizacionMaquinariaID_impresion_cotizaciones_maquinaria_maquinaria" 
							   type="hidden" 
							   value="" />
			 			<!--Tipo de reporte-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<label>Seleccione el tipo de impresión:</label>
							<div class="custom-control custom-radio">
								<input 
										id="bgOpcion1_impresion_cotizaciones_maquinaria_maquinaria"
										type="radio" 
								  	   	class="custom-control-input" 
								  	   	name="strRadios_impresion_cotizaciones_maquinaria_maquinaria" 
								  	   	value="ConMembrete"  checked />
								<label class="custom-control-label" for="bgOpcion1_impresion_cotizaciones_maquinaria_maquinaria">Con membrete</label>
							</div>
							<div class="custom-control custom-radio">
								<input 
										id="bgOpcion2_impresion_cotizaciones_maquinaria_maquinaria"	
										type="radio" 
									  	class="custom-control-input"  
								  	    name="strRadios_impresion_cotizaciones_maquinaria_maquinaria"  
								  	    value="SinMembrete"  />
								<label class="custom-control-label" for="bgOpcion2_impresion_cotizaciones_maquinaria_maquinaria">Sin membrete</label>
							</div>
						</div>
			 		</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Imprimir cotización en PDF-->
							<button class="btn btn-success" 
									id="btnImprimir_impresion_cotizaciones_maquinaria_maquinaria"  
									onclick="reporte_registro_cotizaciones_maquinaria_maquinaria();"  
									title="Imprimir cotización" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  
									id="btnCerrarImprimirCotizacion_impresion_cotizaciones_maquinaria_maquinaria"
									type="reset" aria-hidden="true" 
									onclick="cerrar_impresion_cotizaciones_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Formato de la Cotización en PDF-->

		<!-- Diseño del modal Cotizaciones-->
		<div id="CotizacionesMaquinariaMaquinariaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_cotizaciones_maquinaria_maquinaria"  class="ModalBodyTitle">
			<h1>Cotizaciones</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCotizacionesMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmCotizacionesMaquinariaMaquinaria"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtCotizacionMaquinariaID_cotizaciones_maquinaria_maquinaria" 
										   name="intCotizacionMaquinariaID_cotizaciones_maquinaria_maquinaria" type="hidden" value="">
									</input>
									<label for="txtFolio_cotizaciones_maquinaria_maquinaria">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_cotizaciones_maquinaria_maquinaria" 
											name="strFolio_cotizaciones_maquinaria_maquinaria" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_cotizaciones_maquinaria_maquinaria">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_cotizaciones_maquinaria_maquinaria'>
					                    <input class="form-control" id="txtFecha_cotizaciones_maquinaria_maquinaria"
					                    		name= "strFecha_cotizaciones_maquinaria_maquinaria" 
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
									<label for="cmbMonedaID_cotizaciones_maquinaria_maquinaria">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_cotizaciones_maquinaria_maquinaria" 
									 		name="intMonedaID_cotizaciones_maquinaria_maquinaria" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_cotizaciones_maquinaria_maquinaria">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_cotizaciones_maquinaria_maquinaria" id="txtTipoCambio_cotizaciones_maquinaria_maquinaria" 
											name="intTipoCambio_cotizaciones_maquinaria_maquinaria" type="text" value="" 
											tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene los prospectos y clientes activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id del prospecto/cliente seleccionado-->
									<input id="txtProspectoID_cotizaciones_maquinaria_maquinaria" 
										   name="intProspectoID_cotizaciones_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<label for="txtProspecto_cotizaciones_maquinaria_maquinaria">
										Prospecto / Cliente
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProspecto_cotizaciones_maquinaria_maquinaria" 
											name="strProspecto_cotizaciones_maquinaria_maquinaria" type="text" value=""  tabindex="1"  placeholder="Ingrese prospecto o cliente" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los vendedores activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id del vendedor seleccionado-->
									<input id="txtVendedorID_cotizaciones_maquinaria_maquinaria" 
										   name="intVendedorID_cotizaciones_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<label for="txtVendedor_cotizaciones_maquinaria_maquinaria">
										Vendedor
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtVendedor_cotizaciones_maquinaria_maquinaria" 
											name="strVendedor_cotizaciones_maquinaria_maquinaria" type="text" value=""   tabindex="1" placeholder="Ingrese vendedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						
					</div>
					<div class="row">
						<!--Madurez-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbMadurez_cotizaciones_maquinaria_maquinaria">Madurez</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMadurez_cotizaciones_maquinaria_maquinaria" 
									 		name="strMadurez_cotizaciones_maquinaria_maquinaria" tabindex="1">
									 	<option value="">Seleccione una opción</option>
                          				<option value="1">1</option>
                          				<option value="2">2</option>
                          				<option value="3">3</option>
                          				<option value="4">4</option>
                     				</select>
								</div>
							</div>
                  		</div>
						<!--Autocomplete que contiene las estrategias activas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id de la estrategia seleccionada-->
									<input id="txtEstrategiaID_cotizaciones_maquinaria_maquinaria" 
										   name="intEstrategiaID_cotizaciones_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<label for="txtEstrategia_cotizaciones_maquinaria_maquinaria">
										Estrategia
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEstrategia_cotizaciones_maquinaria_maquinaria" 
											name="strEstrategia_cotizaciones_maquinaria_maquinaria" type="text" value=""   tabindex="1" placeholder="Ingrese estrategia" maxlength="250">
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
									<label for="txtObservaciones_cotizaciones_maquinaria_maquinaria">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_cotizaciones_maquinaria_maquinaria" 
											name="strObservaciones_cotizaciones_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    	<!--Notas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtNotas_cotizaciones_maquinaria_maquinaria">Notas</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtNotas_cotizaciones_maquinaria_maquinaria" 
											name="strNotas_cotizaciones_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese notas" maxlength="250">
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
											<h4 class="panel-title">Detalles de la cotización</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene las descripciones de maquinaria activas-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id de la descripción de maquinaria seleccionada-->
																<input id="txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria" 
																	   name="intMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria"  
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta que se utiliza para recuperar la descripción del registro seleccionado-->
																<input id="txtDescripcion_cotizaciones_maquinaria_maquinaria" 
																	   name="strDescripcion_cotizaciones_maquinaria_maquinaria"  
																	   type="hidden" value="">
																</input>
																<label for="txtCodigo_cotizaciones_maquinaria_maquinaria">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtCodigo_cotizaciones_maquinaria_maquinaria" 
																		name="strCodigo_cotizaciones_maquinaria_maquinaria" 
																		type="text" value="" tabindex="1" 
																		placeholder="Ingrese código" maxlength="250" />
															</div>
														</div>
													</div>
													<!--Autocomplete que contiene las descripciones de maquinaria activas-->
													<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDescripcionCorta_cotizaciones_maquinaria_maquinaria">Descripción corta</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtDescripcionCorta_cotizaciones_maquinaria_maquinaria" 
																		name="strDescripcionCorta_cotizaciones_maquinaria_maquinaria" type="text"  value="" tabindex="1" 
																		placeholder="Ingrese descripción" maxlength="250" />
																</input>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Precio-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPrecio_cotizaciones_maquinaria_maquinaria">Precio</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_cotizaciones_maquinaria_maquinaria" id="txtPrecio_cotizaciones_maquinaria_maquinaria" 
																		name="intPrecio_cotizaciones_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese precio" maxlength="23">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para asignar el descuento-->
																<input id="txtDescuento_cotizaciones_maquinaria_maquinaria" 
																	   name="intDescuento_cotizaciones_maquinaria_maquinaria"  
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeDescuento_cotizaciones_maquinaria_maquinaria">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_cotizaciones_maquinaria_maquinaria" id="txtPorcentajeDescuento_cotizaciones_maquinaria_maquinaria" 
																		name="intPorcentajeDescuento_cotizaciones_maquinaria_maquinaria" type="text" value="" 
																		tabindex="1" placeholder="Ingrese descuento" maxlength="7">
																</input>
															</div>
														</div>
													</div>
													<!--Subtotal-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtSubtotal_cotizaciones_maquinaria_maquinaria">Subtotal</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtSubtotal_cotizaciones_maquinaria_maquinaria" 
																		name="intSubtotal_cotizaciones_maquinaria_maquinaria" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para asignar el importe del IVA-->
																<input id="txtIva_cotizaciones_maquinaria_maquinaria" 
																	   name="intIva_cotizaciones_maquinaria_maquinaria" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
																<input id="txtTasaCuotaIva_cotizaciones_maquinaria_maquinaria" 
																	   name="intTasaCuotaIva_cotizaciones_maquinaria_maquinaria" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIva_cotizaciones_maquinaria_maquinaria">IVA %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIva_cotizaciones_maquinaria_maquinaria" 
																		name="intPorcentajeIva_cotizaciones_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese IVA" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para asignar el importe del IEPS-->
																<input id="txtIeps_cotizaciones_maquinaria_maquinaria" 
																	   name="intIeps_cotizaciones_maquinaria_maquinaria" 
																	   type="hidden" value="" />
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
																<input id="txtTasaCuotaIeps_cotizaciones_maquinaria_maquinaria" 
																	   name="intTasaCuotaIeps_cotizaciones_maquinaria_maquinaria" 
																	   type="hidden" value="" />
																<label for="txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria">IEPS %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria" 
																		name="intPorcentajeIeps_cotizaciones_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese IEPS" maxlength="250" />
															</div>
														</div>
													</div>
													<!--Total-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtTotal_cotizaciones_maquinaria_maquinaria">Total</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtTotal_cotizaciones_maquinaria_maquinaria" 
																		name="intTotal_cotizaciones_maquinaria_maquinaria" type="text" value="" disabled>
																</input>
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
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_cotizaciones_maquinaria_maquinaria"  
									onclick="validar_cotizaciones_maquinaria_maquinaria();"  title="Guardar" 
									tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--- Generar pedido o rechazar registro-->
							<button class="btn btn-default" id="btnAutorizar_cotizaciones_maquinaria_maquinaria"  
									onclick="abrir_pedido_cotizaciones_maquinaria_maquinaria('','','Pedido');"  title="Generar pedido" tabindex="3" disabled>
								<span class="glyphicon glyphicon-file"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_cotizaciones_maquinaria_maquinaria"  
									onclick="abrir_prospecto_cotizaciones_maquinaria_maquinaria('');"  
									title="Enviar correo electrónico" tabindex="4" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_cotizaciones_maquinaria_maquinaria"  
									onclick="abrir_impresion_cotizaciones_maquinaria_maquinaria('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_cotizaciones_maquinaria_maquinaria"  
									onclick="cambiar_estatus_cotizaciones_maquinaria_maquinaria('','ACTIVO');"  title="Desactivar" tabindex="6" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_cotizaciones_maquinaria_maquinaria"  
									onclick="cambiar_estatus_cotizaciones_maquinaria_maquinaria('','INACTIVO');"  title="Restaurar" tabindex="7" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_cotizaciones_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_cotizaciones_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="8">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Cotizaciones-->
	</div><!--#CotizacionesMaquinariaMaquinariaContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_cotizaciones_maquinaria_maquinaria" type="text/template">
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
		var intPaginaCotizacionesMaquinariaMaquinaria = 0;
		var strUltimaBusquedaCotizacionesMaquinariaMaquinaria = "";
		//Variable que se utiliza para asignar el id del módulo de maquinaria
		var intModuloIDCotizacionesMaquinariaMaquinaria = <?php echo MODULO_MAQUINARIA ?>;
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDCotizacionesMaquinariaMaquinaria = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseCotizacionesMaquinariaMaquinaria = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoCotizacionesMaquinariaMaquinaria = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar objeto del modal Generar Pedido de la Cotización
		var objPedidoCotizacionesMaquinariaMaquinaria = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarCotizacionesMaquinariaMaquinaria = null;
		//Variable que se utiliza para asignar objeto del modal
		var objCotizacionesMaquinariaMaquinaria = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_cotizaciones_maquinaria_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/cotizaciones_maquinaria/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_cotizaciones_maquinaria_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCotizacionesMaquinariaMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosCotizacionesMaquinariaMaquinaria = strPermisosCotizacionesMaquinariaMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCotizacionesMaquinariaMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCotizacionesMaquinariaMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_cotizaciones_maquinaria_maquinaria').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosCotizacionesMaquinariaMaquinaria[i]=='GUARDAR') || (arrPermisosCotizacionesMaquinariaMaquinaria[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_cotizaciones_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosCotizacionesMaquinariaMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_cotizaciones_maquinaria_maquinaria').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_cotizaciones_maquinaria_maquinaria();
						}
						else if(arrPermisosCotizacionesMaquinariaMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_cotizaciones_maquinaria_maquinaria').removeAttr('disabled');
							$('#btnRestaurar_cotizaciones_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosCotizacionesMaquinariaMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_cotizaciones_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosCotizacionesMaquinariaMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_cotizaciones_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosCotizacionesMaquinariaMaquinaria[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_cotizaciones_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosCotizacionesMaquinariaMaquinaria[i]=='AUTORIZAR')//Si el indice es AUTORIZAR
						{
							//Habilitar el control (botón autorizar)
							$('#btnAutorizar_cotizaciones_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosCotizacionesMaquinariaMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_cotizaciones_maquinaria_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_cotizaciones_maquinaria_maquinaria() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaCotizacionesMaquinariaMaquinaria =($('#txtFechaInicialBusq_cotizaciones_maquinaria_maquinaria').val()+$('#txtFechaFinalBusq_cotizaciones_maquinaria_maquinaria').val()+$('#txtProspectoIDBusq_cotizaciones_maquinaria_maquinaria').val()+$('#cmbEstatusBusq_cotizaciones_maquinaria_maquinaria').val()+$('#txtBusqueda_cotizaciones_maquinaria_maquinaria').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaCotizacionesMaquinariaMaquinaria != strUltimaBusquedaCotizacionesMaquinariaMaquinaria)
			{
				intPaginaCotizacionesMaquinariaMaquinaria = 0;
				strUltimaBusquedaCotizacionesMaquinariaMaquinaria = strNuevaBusquedaCotizacionesMaquinariaMaquinaria;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('maquinaria/cotizaciones_maquinaria/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_cotizaciones_maquinaria_maquinaria').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_cotizaciones_maquinaria_maquinaria').val()),
					 intProspectoID: $('#txtProspectoIDBusq_cotizaciones_maquinaria_maquinaria').val(),
					 strEstatus:     $('#cmbEstatusBusq_cotizaciones_maquinaria_maquinaria').val(),
	    			strBusqueda:    $('#txtBusqueda_cotizaciones_maquinaria_maquinaria').val(),
					 intPagina: intPaginaCotizacionesMaquinariaMaquinaria,
					 strPermisosAcceso: $('#txtAcciones_cotizaciones_maquinaria_maquinaria').val()
					},
					function(data){
						$('#dg_cotizaciones_maquinaria_maquinaria tbody').empty();
						var tmpCotizacionesMaquinariaMaquinaria = Mustache.render($('#plantilla_cotizaciones_maquinaria_maquinaria').html(),data);
						$('#dg_cotizaciones_maquinaria_maquinaria tbody').html(tmpCotizacionesMaquinariaMaquinaria);
						$('#pagLinks_cotizaciones_maquinaria_maquinaria').html(data.paginacion);
						$('#numElementos_cotizaciones_maquinaria_maquinaria').html(data.total_rows);
						intPaginaCotizacionesMaquinariaMaquinaria = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_cotizaciones_maquinaria_maquinaria(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/cotizaciones_maquinaria/';

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
			if ($('#chbImprimirDetalles_cotizaciones_maquinaria_maquinaria').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_cotizaciones_maquinaria_maquinaria').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_cotizaciones_maquinaria_maquinaria').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_cotizaciones_maquinaria_maquinaria').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_cotizaciones_maquinaria_maquinaria').val()),
										'intProspectoID': $('#txtProspectoIDBusq_cotizaciones_maquinaria_maquinaria').val(),
										'strEstatus': $('#cmbEstatusBusq_cotizaciones_maquinaria_maquinaria').val(), 
										'strBusqueda': $('#txtBusqueda_cotizaciones_maquinaria_maquinaria').val(),
										'strDetalles': $('#chbImprimirDetalles_cotizaciones_maquinaria_maquinaria').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}
		

		
		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_cotizaciones_maquinaria_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_cotizaciones_maquinaria_maquinaria').empty();
					var temp = Mustache.render($('#monedas_cotizaciones_maquinaria_maquinaria').html(), data);
					$('#cmbMonedaID_cotizaciones_maquinaria_maquinaria').html(temp);
				},
				'json');
		}

		/*******************************************************************************************************************
		Funciones del modal Generar Pedido de la Cotización
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_pedido_cotizaciones_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmPedidoCotizacionesMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_pedido_cotizaciones_maquinaria_maquinaria();
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
		    $('#divEncabezadoModal_pedido_cotizaciones_maquinaria_maquinaria').addClass("estatus-ACTIVO");
		}

		//Función que se utiliza para abrir el modal
		function abrir_pedido_cotizaciones_maquinaria_maquinaria(id, folio, tipoAccion)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_pedido_cotizaciones_maquinaria_maquinaria();
			
			//Variables que se utilizan para asignar los datos del registro
			var intReferenciaID = 0;
			var strFolio = '';

			//Si no existe id, significa que se aplicará autorización (o rechazo) desde el modal
			if(id == '')
			{
				intReferenciaID = $('#txtCotizacionMaquinariaID_cotizaciones_maquinaria_maquinaria').val();
				strFolio =  $('#txtFolio_cotizaciones_maquinaria_maquinaria').val();
				$('#txtModalCotizacionesMaquinaria_pedido_cotizaciones_maquinaria_maquinaria').val('SI');
			}
			else
			{
				intReferenciaID = id;
				strFolio = folio;
				$('#txtModalCotizacionesMaquinaria_pedido_cotizaciones_maquinaria_maquinaria').val('NO');
			}

			//Asignar datos del registro seleccionado
			$('#txtReferenciaID_pedido_cotizaciones_maquinaria_maquinaria').val(intReferenciaID);
			$('#txtMensaje_pedido_cotizaciones_maquinaria_maquinaria').val('Favor de generar pedido de la cotización '+ strFolio);
			//Cargar el treeview
			get_treeview_usuarios_pedido_cotizaciones_maquinaria_maquinaria('');

			//Abrir modal
			objPedidoCotizacionesMaquinariaMaquinaria = $('#PedidoCotizacionesMaquinariaMaquinariaBox').bPopup({
													   appendTo: '#CotizacionesMaquinariaMaquinariaContent', 
							                           contentContainer: 'CotizacionesMaquinariaMaquinariaM', 
							                           zIndex: 2, 
							                           modalClose: false, 
							                           modal: true, 
							                           follow: [true,false], 
							                           followEasing : "linear", 
							                           easing: "linear", 
							                           modalColor: ('#F0F0F0')});
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_pedido_cotizaciones_maquinaria_maquinaria()
		{
			try {
				//Cerrar modal
				objPedidoCotizacionesMaquinariaMaquinaria.close();
				//Eliminar datos del treeview
				$("#treeUsuarios_pedido_cotizaciones_maquinaria_maquinaria").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_cotizaciones_maquinaria_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_pedido_cotizaciones_maquinaria_maquinaria()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosPedidoCotizacionesMaquinariaMaquinaria = [];

			//Recorremos el treeview
			$("#treeUsuarios_pedido_cotizaciones_maquinaria_maquinaria").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosPedidoCotizacionesMaquinariaMaquinaria.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtUsuarios_pedido_cotizaciones_maquinaria_maquinaria").val(arrSeleccionadosPedidoCotizacionesMaquinariaMaquinaria.join('|'));
			
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_pedido_cotizaciones_maquinaria_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmPedidoCotizacionesMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_pedido_cotizaciones_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba un mensaje'}
											}
										},
										strUsuarios_pedido_cotizaciones_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un usuario para este mensaje.'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_pedido_cotizaciones_maquinaria_maquinaria = $('#frmPedidoCotizacionesMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_pedido_cotizaciones_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_pedido_cotizaciones_maquinaria_maquinaria.isValid())
			{
				//Hacer un llamado a la función para guardar la solicitud de autorización
				guardar_pedido_cotizaciones_maquinaria_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_pedido_cotizaciones_maquinaria_maquinaria()
		{
			try
			{
				$('#frmPedidoCotizacionesMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar a pedido los datos de un registro
		function guardar_pedido_cotizaciones_maquinaria_maquinaria()
		{
			//Hacer un llamado al método del controlador para guardar el pedido de un registro 
			$.post('maquinaria/cotizaciones_maquinaria/set_enviar_pedido',
		     {
		     	intCotizacionMaquinariaID: $('#txtReferenciaID_pedido_cotizaciones_maquinaria_maquinaria').val(),
		      	strUsuarios: $('#txtUsuarios_pedido_cotizaciones_maquinaria_maquinaria').val(), 
		      	strMensaje:  $('#txtMensaje_pedido_cotizaciones_maquinaria_maquinaria').val()
		     },
		     function(data) {
		        if(data.resultado)
		        {
		          	//Hacer llamado a la función  para cargar  los registros en el grid
		          	paginacion_cotizaciones_maquinaria_maquinaria();
		          	//Hacer un llamado a la función para cerrar modal
				  	cerrar_pedido_cotizaciones_maquinaria_maquinaria();

				  	//Si el id de la referencia (para generar el pedido) se recuperó del modal Cotizaciones 
				  	if($('#txtModalCotizacionesMaquinaria_pedido_cotizaciones_maquinaria_maquinaria').val() == 'SI')
				  	{
				  		//Hacer un llamado a la función para cerrar modal Cotizaciones
				 	 	cerrar_cotizaciones_maquinaria_maquinaria();
				  	}   
		        }
		        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		        mensaje_cotizaciones_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
		     },
		    'json');
		}

		/*Función que se utiliza para definir tree view de usuarios con acceso a la función Autorizar del proceso
		 *Cotizaciones (módulo Maquinaria)*/
		function get_treeview_usuarios_pedido_cotizaciones_maquinaria_maquinaria(id)
		{
			$('#treeUsuarios_pedido_cotizaciones_maquinaria_maquinaria').fancytree({
				source: {
					url: "seguridad/usuarios/get_treeview/AUTORIZAR_COTIZACIONES_MAQUINARIA/COTIZACIONES DE MAQUINARIA/"+id,
					cache: false
				},
				checkbox: true,
				selectMode: 3
			});
		}

		/*******************************************************************************************************************
		Funciones del modal Enviar Correo Electrónico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_prospecto_cotizaciones_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmEnviarCotizacionesMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_prospecto_cotizaciones_maquinaria_maquinaria();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_prospecto_cotizaciones_maquinaria_maquinaria');
		}


		//Función que se utiliza para abrir el modal
		function abrir_prospecto_cotizaciones_maquinaria_maquinaria(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_prospecto_cotizaciones_maquinaria_maquinaria();
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtCotizacionMaquinariaID_cotizaciones_maquinaria_maquinaria').val();	
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/cotizaciones_maquinaria/get_datos',
		       {
		       		intCotizacionMaquinariaID:intID
		       },
		       function(data) {
		        	//Si hay datos del registro
		            if(data.row)
		            {
		            	//Asignar datos del registro seleccionado
						$('#txtCotizacionMaquinariaID_prospecto_cotizaciones_maquinaria_maquinaria').val(data.row.cotizacion_maquinaria_id);
						$('#txtProspecto_prospecto_cotizaciones_maquinaria_maquinaria').val(data.row.prospecto);
						$('#txtCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria').val(data.row.correo_electronico);
						$('#txtCopiaCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria').val(data.row.contacto_correo_electronico);
						//Dependiendo del estatus cambiar el color del encabezado 
					    $('#divEncabezadoModal_prospecto_cotizaciones_maquinaria_maquinaria').addClass("estatus-"+data.row.estatus);

					    //Abrir modal
						objEnviarCotizacionesMaquinariaMaquinaria = $('#EnviarCotizacionesMaquinariaMaquinariaBox').bPopup({
																	   appendTo: '#CotizacionesMaquinariaMaquinariaContent', 
											                           contentContainer: 'CotizacionesMaquinariaMaquinariaM', 
											                           zIndex: 2, 
											                           modalClose: false, 
											                           modal: true, 
											                           follow: [true,false], 
											                           followEasing : "linear", 
											                           easing: "linear", 
											                           modalColor: ('#F0F0F0')});
						//Enfocar caja de texto
						$('#txtCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria').focus();
		            }
		         },
		       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_prospecto_cotizaciones_maquinaria_maquinaria()
		{
			try {
				//Cerrar modal
				objEnviarCotizacionesMaquinariaMaquinaria.close();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_prospecto_cotizaciones_maquinaria_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_prospecto_cotizaciones_maquinaria_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarCotizacionesMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria: {
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
			var bootstrapValidator_prospecto_cotizaciones_maquinaria_maquinaria = $('#frmEnviarCotizacionesMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_prospecto_cotizaciones_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_prospecto_cotizaciones_maquinaria_maquinaria.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_prospecto_cotizaciones_maquinaria_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_prospecto_cotizaciones_maquinaria_maquinaria()
		{
			try
			{
				$('#frmEnviarCotizacionesMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al prospecto
		function enviar_correo_prospecto_cotizaciones_maquinaria_maquinaria()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_prospecto_cotizaciones_maquinaria_maquinaria();
			//Hacer un llamado al método del controlador para enviar correo electrónico al prospecto
			$.post('maquinaria/cotizaciones_maquinaria/enviar_correo_electronico_prospecto',
					{ 
						intCotizacionMaquinariaID: $('#txtCotizacionMaquinariaID_prospecto_cotizaciones_maquinaria_maquinaria').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_prospecto_cotizaciones_maquinaria_maquinaria').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_prospecto_cotizaciones_maquinaria_maquinaria();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_prospecto_cotizaciones_maquinaria_maquinaria();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cotizaciones_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_prospecto_cotizaciones_maquinaria_maquinaria()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_prospecto_cotizaciones_maquinaria_maquinaria").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_prospecto_cotizaciones_maquinaria_maquinaria()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_prospecto_cotizaciones_maquinaria_maquinaria").addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones del modal Impresión de Cotizaciones seleccionando un formato especifico
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_impresion_cotizaciones_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmImpresionCotizacionesMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_impresion_cotizaciones_maquinaria_maquinaria();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_impresion_cotizaciones_maquinaria_maquinaria');
		   
		}

		//Función que se utiliza para abrir el modal
		function abrir_impresion_cotizaciones_maquinaria_maquinaria(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_impresion_cotizaciones_maquinaria_maquinaria();
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtCotizacionMaquinariaID_cotizaciones_maquinaria_maquinaria').val();	
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/cotizaciones_maquinaria/get_datos',
		       {
		       		intCotizacionMaquinariaID:intID
		       },
		       function(data) {
		        	//Si hay datos del registro
		            if(data.row)
		            {
		            	//Asignar datos del registro seleccionado
						$('#txtCotizacionMaquinariaID_impresion_cotizaciones_maquinaria_maquinaria').val(data.row.cotizacion_maquinaria_id);

						//Dependiendo del estatus cambiar el color del encabezado 
					    $('#divEncabezadoModal_impresion_cotizaciones_maquinaria_maquinaria').addClass("estatus-"+data.row.estatus);

					    //Abrir modal
						objImpresionCotizacionesMaquinariaMaquinaria = $('#ImpresionCotizacionesMaquinariaMaquinariaBox').bPopup({
																	   appendTo: '#CotizacionesMaquinariaMaquinariaContent', 
											                           contentContainer: 'CotizacionesMaquinariaMaquinariaM', 
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
		function cerrar_impresion_cotizaciones_maquinaria_maquinaria()
		{
			try {
				//Cerrar modal
				objImpresionCotizacionesMaquinariaMaquinaria.close();	
			}
			catch(err) {}
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_impresion_cotizaciones_maquinaria_maquinaria()
		{
			try
			{
				$('#frmImpresionCotizacionesMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_cotizaciones_maquinaria_maquinaria() 
		{
			//Variable que se utiliza para asignar el id del registro
			var strTipoReporte = $("input:radio[name='strRadios_impresion_cotizaciones_maquinaria_maquinaria']:checked").val();	
			var intID = $('#txtCotizacionMaquinariaID_impresion_cotizaciones_maquinaria_maquinaria').val();

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'maquinaria/cotizaciones_maquinaria/get_reporte_registro',
							'data' : {
										'intCotizacionMaquinariaID': intID, 
										'strTipoReporte': strTipoReporte

									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal Cotizaciones
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_cotizaciones_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmCotizacionesMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cotizaciones_maquinaria_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmCotizacionesMaquinariaMaquinaria').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_cotizaciones_maquinaria_maquinaria');
			
			//Asignar NO para indicar que no se ha abierto el modal Generar Pedido de la Cotización
			$('#txtModalCotizacionesMaquinaria_pedido_cotizaciones_maquinaria_maquinaria').val('NO');
			//Habilitar todos los elementos del formulario
			$('#frmCotizacionesMaquinariaMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_cotizaciones_maquinaria_maquinaria').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_cotizaciones_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtSubtotal_cotizaciones_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtTotal_cotizaciones_maquinaria_maquinaria').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_cotizaciones_maquinaria_maquinaria").show();
			//Ocultar los siguientes botones
			$("#btnAutorizar_cotizaciones_maquinaria_maquinaria").hide();
			$("#btnEnviarCorreo_cotizaciones_maquinaria_maquinaria").hide();
			$("#btnImprimirRegistro_cotizaciones_maquinaria_maquinaria").hide();
			$("#btnDesactivar_cotizaciones_maquinaria_maquinaria").hide();
			$("#btnRestaurar_cotizaciones_maquinaria_maquinaria").hide();
		}


		//Función para inicializar elementos de la descripción de maquinaria
		function inicializar_descripcion_maquinaria_cotizaciones_maquinaria_maquinaria()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtDescripcionCorta_cotizaciones_maquinaria_maquinaria').val('');
	        $('#txtDescripcion_cotizaciones_maquinaria_maquinaria').val('');
		}

		
		//Función que se utiliza para cerrar el modal
		function cerrar_cotizaciones_maquinaria_maquinaria()
		{
			try {
				//Cerrar modal
				objCotizacionesMaquinariaMaquinaria.close();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
			    cerrar_prospecto_cotizaciones_maquinaria_maquinaria();
				//Si el id de la referencia (para generar el pedido) se recuperó del modal Cotizaciones 
				if($('#txtModalCotizacionesMaquinaria_pedido_cotizaciones_maquinaria_maquinaria').val() == 'SI')
				{
					//Hacer un llamado a la función para cerrar modal Generar Pedido de la Cotización
					cerrar_pedido_cotizaciones_maquinaria_maquinaria();
				}
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_cotizaciones_maquinaria_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_cotizaciones_maquinaria_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_cotizaciones_maquinaria_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmCotizacionesMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_cotizaciones_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intMonedaID_cotizaciones_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_cotizaciones_maquinaria_maquinaria: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_cotizaciones_maquinaria_maquinaria').val()) !== intMonedaBaseIDCotizacionesMaquinariaMaquinaria)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoCotizacionesMaquinariaMaquinaria)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoCotizacionesMaquinariaMaquinaria
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strProspecto_cotizaciones_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del prospecto/cliente
					                                    if($('#txtProspectoID_cotizaciones_maquinaria_maquinaria').val() === '')
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
										strVendedor_cotizaciones_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vendedor
					                                    if($('#txtVendedorID_cotizaciones_maquinaria_maquinaria').val() === '')
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
										strMadurez_cotizaciones_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una madurez'}
											}
										},
										strEstrategia_cotizaciones_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la estrategia
					                                    if($('#txtEstrategiaID_cotizaciones_maquinaria_maquinaria').val() === '')
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
										strCodigo_cotizaciones_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la descripción de maquinaria
					                                    if($('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val() === '')
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
										strDescripcionCorta_cotizaciones_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la descripción de maquinaria
					                                    if($('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val() === '')
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
										intPrecio_cotizaciones_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba el precio'}
											}
										},
										intPorcentajeDescuento_cotizaciones_maquinaria_maquinaria: {
											validators: {
												stringLength: {
													max: 6,
													message: 'El porcentaje no debe exceder de 6 caracteres de longitud'
												},
												callback: {
					                                  callback: function(value, validator, $field) {
			                                     		//Remplazar ',' por cadena vacia
			                                     		value = value.replace(',', '');
		                                      			//Verificar que el porcentaje no sea mayor que 100
					                                    if(parseFloat(value) > 100)
					                                    {
					                                    	//Asignar valor de cero
					                                    	$('#txtPorcentajeDescuento_cotizaciones_maquinaria_maquinaria').val('0.00');
				                                      		return {
					                                            valid: false,
					                                            message: 'El porcentaje no debe ser mayor que 100'
					                                        };
					                                    }
					                                    return true;
					                                  }
					                            }
											}
										},
										intPorcentajeIva_cotizaciones_maquinaria_maquinaria: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IVA
					                                    if($('#txtTasaCuotaIva_cotizaciones_maquinaria_maquinaria').val() === '')
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
										intPorcentajeIeps_cotizaciones_maquinaria_maquinaria: {
											validators: {
												callback: {
					                                  callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la tasa o cuota del impuesto de IEPS
					                                    if(value != '' && $('#txtTasaCuotaIeps_cotizaciones_maquinaria_maquinaria').val() === '')
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
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_cotizaciones_maquinaria_maquinaria = $('#frmCotizacionesMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_cotizaciones_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_cotizaciones_maquinaria_maquinaria.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_cotizaciones_maquinaria_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_cotizaciones_maquinaria_maquinaria()
		{
			try
			{
				$('#frmCotizacionesMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_cotizaciones_maquinaria_maquinaria()
		{
			//Variables que se utilizan para asignar valores del detalle
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioCotizacion = parseFloat($('#txtTipoCambio_cotizaciones_maquinaria_maquinaria').val());
			//Hacer un llamado a la función para reemplazar ',' por cadena vacia
			var intPrecioUnitario = $.reemplazar($('#txtPrecio_cotizaciones_maquinaria_maquinaria').val(), ",", "");
			var intImporteDescuento =  $('#txtDescuento_cotizaciones_maquinaria_maquinaria').val();
			var intImporteIva = $('#txtIva_cotizaciones_maquinaria_maquinaria').val();
			var intImporteIeps = $('#txtIeps_cotizaciones_maquinaria_maquinaria').val();
			
			//Convertir importes a peso mexicano
			intPrecioUnitario = intPrecioUnitario * intTipoCambioCotizacion;
			intImporteDescuento = intImporteDescuento * intTipoCambioCotizacion;
			intImporteIva = intImporteIva * intTipoCambioCotizacion;
			intImporteIeps = intImporteIeps * intTipoCambioCotizacion;

			//Si existe importe del descuento
			if(intImporteDescuento > 0)
			{	
				//Restar descuento al precio 
				intPrecioUnitario = intPrecioUnitario - intImporteDescuento;
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('maquinaria/cotizaciones_maquinaria/guardar',
					{ 
						intCotizacionMaquinariaID: $('#txtCotizacionMaquinariaID_cotizaciones_maquinaria_maquinaria').val(),
						strFolioConsecutivo: $('#txtFolio_cotizaciones_maquinaria_maquinaria').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_cotizaciones_maquinaria_maquinaria').val()),
						intMonedaID: $('#cmbMonedaID_cotizaciones_maquinaria_maquinaria').val(),
						intTipoCambio: intTipoCambioCotizacion,
						intProspectoID: $('#txtProspectoID_cotizaciones_maquinaria_maquinaria').val(),
						intVendedorID: $('#txtVendedorID_cotizaciones_maquinaria_maquinaria').val(),
						strMadurez: $('#cmbMadurez_cotizaciones_maquinaria_maquinaria').val(),
						intEstrategiaID: $('#txtEstrategiaID_cotizaciones_maquinaria_maquinaria').val(),
						strObservaciones: $('#txtObservaciones_cotizaciones_maquinaria_maquinaria').val(),
						strNotas: $('#txtNotas_cotizaciones_maquinaria_maquinaria').val(),
						intMaquinariaDescripcionID: $('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val(),
						strCodigo: $('#txtCodigo_cotizaciones_maquinaria_maquinaria').val(),
						strDescripcionCorta: $('#txtDescripcionCorta_cotizaciones_maquinaria_maquinaria').val(),
						strDescripcion: $('#txtDescripcion_cotizaciones_maquinaria_maquinaria').val(),
						intPrecio: intPrecioUnitario,
						intDescuento: intImporteDescuento,
						intTasaCuotaIva: $('#txtTasaCuotaIva_cotizaciones_maquinaria_maquinaria').val(),
						intIva: intImporteIva,
						intTasaCuotaIeps: $('#txtTasaCuotaIeps_cotizaciones_maquinaria_maquinaria').val(),
						intIeps: intImporteIeps,
						intProcesoMenuID: $('#txtProcesoMenuID_cotizaciones_maquinaria_maquinaria').val()
					},
					function(data) {
						if (data.resultado)
						{
         					//Hacer un llamado a la función para cerrar modal
	                    	cerrar_cotizaciones_maquinaria_maquinaria();
							//Hacer llamado a la función  para cargar  los registros en el grid
	               			paginacion_cotizaciones_maquinaria_maquinaria(); 
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_cotizaciones_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_cotizaciones_maquinaria_maquinaria(tipoMensaje, mensaje)
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
		function cambiar_estatus_cotizaciones_maquinaria_maquinaria(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtCotizacionMaquinariaID_cotizaciones_maquinaria_maquinaria').val();

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
						              'title':    'Cotizaciones',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              	//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_cotizaciones_maquinaria_maquinaria(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_cotizaciones_maquinaria_maquinaria(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_cotizaciones_maquinaria_maquinaria(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('maquinaria/cotizaciones_maquinaria/set_estatus',
			      {intCotizacionMaquinariaID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_cotizaciones_maquinaria_maquinaria();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_cotizaciones_maquinaria_maquinaria();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_cotizaciones_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}



		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_cotizaciones_maquinaria_maquinaria(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/cotizaciones_maquinaria/get_datos',
			       {intCotizacionMaquinariaID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_cotizaciones_maquinaria_maquinaria();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
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
				            $('#txtCotizacionMaquinariaID_cotizaciones_maquinaria_maquinaria').val(data.row.cotizacion_maquinaria_id);
				            $('#txtFolio_cotizaciones_maquinaria_maquinaria').val(data.row.folio);
				            $('#txtFecha_cotizaciones_maquinaria_maquinaria').val(data.row.fecha);
				            $('#cmbMonedaID_cotizaciones_maquinaria_maquinaria').val(data.row.moneda_id);
				            $('#txtTipoCambio_cotizaciones_maquinaria_maquinaria').val(data.row.tipo_cambio);
				            $('#txtProspectoID_cotizaciones_maquinaria_maquinaria').val(data.row.prospecto_id);
						    $('#txtProspecto_cotizaciones_maquinaria_maquinaria').val(data.row.prospecto);
						    $('#txtVendedorID_cotizaciones_maquinaria_maquinaria').val(data.row.vendedor_id);
						    $('#txtVendedor_cotizaciones_maquinaria_maquinaria').val(data.row.vendedor);
						    $('#cmbMadurez_cotizaciones_maquinaria_maquinaria').val(data.row.madurez);
						    $('#txtEstrategiaID_cotizaciones_maquinaria_maquinaria').val(data.row.estrategia_id);
						    $('#txtEstrategia_cotizaciones_maquinaria_maquinaria').val(data.row.estrategia);
						    $('#txtObservaciones_cotizaciones_maquinaria_maquinaria').val(data.row.observaciones);
						    $('#txtNotas_cotizaciones_maquinaria_maquinaria').val(data.row.notas);
						    $('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val(data.row.maquinaria_descripcion_id);
						    $('#txtCodigo_cotizaciones_maquinaria_maquinaria').val(data.row.codigo);
						    $('#txtDescripcionCorta_cotizaciones_maquinaria_maquinaria').val(data.row.descripcion_corta);
						    $('#txtDescripcion_cotizaciones_maquinaria_maquinaria').val(data.row.descripcion);
							$('#txtPrecio_cotizaciones_maquinaria_maquinaria').val(intPrecio);
							$('#txtPorcentajeDescuento_cotizaciones_maquinaria_maquinaria').val(intPorcentajeDescuento);
							$('#txtTasaCuotaIva_cotizaciones_maquinaria_maquinaria').val(data.row.tasa_cuota_iva);
							$('#txtPorcentajeIva_cotizaciones_maquinaria_maquinaria').val(data.row.porcentaje_iva);
						    $('#txtTasaCuotaIeps_cotizaciones_maquinaria_maquinaria').val(data.row.tasa_cuota_ieps);
						    $('#txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria').val(data.row.porcentaje_ieps);
						    //Hacer un llamado a la función para calcular el importe total de la cotización
							calcular_total_cotizaciones_maquinaria_maquinaria();
							//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtPrecio_cotizaciones_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
							//Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_cotizaciones_maquinaria_maquinaria').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_cotizaciones_maquinaria_maquinaria").show();

							//Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmCotizacionesMaquinariaMaquinaria').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_cotizaciones_maquinaria_maquinaria").hide();

					            //Si el estatus del registro es INACTIVO
				            	if(strEstatus == 'INACTIVO')
				            	{
				            		//Mostrar botón Restaurar
				            		$("#btnRestaurar_cotizaciones_maquinaria_maquinaria").show();
				            	}
				            	else //Si el estatus del registro es FACTURADO
				            	{
				            		//Mostrar botón Enviar correo  
				            		$("#btnEnviarCorreo_cotizaciones_maquinaria_maquinaria").show();
				            	}

				            }
				            else
				            {
				            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDCotizacionesMaquinariaMaquinaria)
							    {
									//Habilitar caja de texto
									$("#txtTipoCambio_cotizaciones_maquinaria_maquinaria").removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar las siguientes cajas de texto
									$("#txtTipoCambio_cotizaciones_maquinaria_maquinaria").attr('disabled','disabled');
							    }

				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
					            {
					            	//Mostrar los siguientes botones  
					            	$("#btnDesactivar_cotizaciones_maquinaria_maquinaria").show();
					            	$("#btnEnviarCorreo_cotizaciones_maquinaria_maquinaria").show();
					            	$("#btnAutorizar_cotizaciones_maquinaria_maquinaria").show();
					            }
				            }

			            	//Abrir modal
				            objCotizacionesMaquinariaMaquinaria = $('#CotizacionesMaquinariaMaquinariaBox').bPopup({
														  appendTo: '#CotizacionesMaquinariaMaquinariaContent', 
							                              contentContainer: 'CotizacionesMaquinariaMaquinariaM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#cmbMonedaID_cotizaciones_maquinaria_maquinaria').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_cotizaciones_maquinaria_maquinaria()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_cotizaciones_maquinaria_maquinaria').val()) !== intMonedaBaseIDCotizacionesMaquinariaMaquinaria)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_cotizaciones_maquinaria_maquinaria").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_cotizaciones_maquinaria_maquinaria').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_cotizaciones_maquinaria_maquinaria').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_cotizaciones_maquinaria_maquinaria").val(data.row.tipo_cambio_venta);
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}


		//Función para regresar y obtener los datos de una descripción de maquinaria
		function get_datos_descripcion_maquinaria_cotizaciones_maquinaria_maquinaria()
		{
		 	//Hacer un llamado al método del controlador para regresar los datos de la descripción de maquinaria
         	$.post('maquinaria/maquinaria_descripciones/get_datos',
              { 
              	strBusqueda:$("#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria").val(),
	       		strTipo: 'id'
              },
              function(data) {
                if(data.row){
                   $("#txtCodigo_cotizaciones_maquinaria_maquinaria").val(data.row.codigo);
                   $("#txtDescripcionCorta_cotizaciones_maquinaria_maquinaria").val(data.row.descripcion_corta);
                   $("#txtDescripcion_cotizaciones_maquinaria_maquinaria").val(data.row.descripcion);
                   //Enfocar caja de texto
                   $("#txtPrecio_cotizaciones_maquinaria_maquinaria").focus();

                }
              }
             ,
            'json');

		}

		//Función que se utiliza para calcular el importe total de la cotización
		function calcular_total_cotizaciones_maquinaria_maquinaria()
		{
			//Variable que se utiliza para asignar el precio
			var intPrecio = 0;
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
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_cotizaciones_maquinaria_maquinaria').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_cotizaciones_maquinaria_maquinaria').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria').val();

         	//Verificar que exista importe de subtotal
			if($('#txtPrecio_cotizaciones_maquinaria_maquinaria').val() != '')
			{ 
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intPrecio = parseFloat($.reemplazar($("#txtPrecio_cotizaciones_maquinaria_maquinaria").val(), ",", ""));
				intSubtotal = parseFloat($.reemplazar($("#txtPrecio_cotizaciones_maquinaria_maquinaria").val(), ",", ""));
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
			intPrecio =  formatMoney(intPrecio, 2, '');
			intTotal = formatMoney(intTotal, 2, '');
			intSubtotal = formatMoney(intSubtotal, 2, '');
			intPorcentajeDescuento = formatMoney(intPorcentajeDescuento, 2, ''); 

			//Asignar importe total 
			$('#txtTotal_cotizaciones_maquinaria_maquinaria').val(intPrecio);
			$('#txtDescuento_cotizaciones_maquinaria_maquinaria').val(intImporteDescuento);
			$('#txtPorcentajeDescuento_cotizaciones_maquinaria_maquinaria').val(intPorcentajeDescuento);
			$('#txtSubtotal_cotizaciones_maquinaria_maquinaria').val(intSubtotal);
			$('#txtIva_cotizaciones_maquinaria_maquinaria').val(intImporteIva);
			$('#txtIeps_cotizaciones_maquinaria_maquinaria').val(intImporteIeps);
			$('#txtTotal_cotizaciones_maquinaria_maquinaria').val(intTotal);
			
			
			
			
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Cotizaciones
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_cotizaciones_maquinaria_maquinaria').numeric();
			$('#txtPrecio_cotizaciones_maquinaria_maquinaria').numeric();
        	$('#txtPorcentajeDescuento_cotizaciones_maquinaria_maquinaria').numeric();
        	$('#txtPorcentajeIva_cotizaciones_maquinaria_maquinaria').numeric();
        	$('#txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_cotizaciones_maquinaria_maquinaria').blur(function(){
                $('.tipo-cambio_cotizaciones_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_cotizaciones_maquinaria_maquinaria').blur(function(){
				$('.moneda_cotizaciones_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
			});

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_cotizaciones_maquinaria_maquinaria').blur(function(){
                $('.cantidad_cotizaciones_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_cotizaciones_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});

			//Regresar el tipo de cambio de la moneda cuando cambie la fecha
			$('#dteFecha_cotizaciones_maquinaria_maquinaria').on('dp.change', function (e) {
				//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_cotizaciones_maquinaria_maquinaria();
			});

			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_cotizaciones_maquinaria_maquinaria').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_cotizaciones_maquinaria_maquinaria').val()) === intMonedaBaseIDCotizacionesMaquinariaMaquinaria)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_cotizaciones_maquinaria_maquinaria").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_cotizaciones_maquinaria_maquinaria').val(intTipoCambioMonedaBaseCotizacionesMaquinariaMaquinaria);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_cotizaciones_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 4 }); 
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_cotizaciones_maquinaria_maquinaria").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_cotizaciones_maquinaria_maquinaria').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_cotizaciones_maquinaria_maquinaria();
             	}
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_cotizaciones_maquinaria_maquinaria').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_cotizaciones_maquinaria_maquinaria').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoCotizacionesMaquinariaMaquinaria)
	        	{
	        		$('#txtTipoCambio_cotizaciones_maquinaria_maquinaria').val(intTipoCambioMaximoCotizacionesMaquinariaMaquinaria);
	        	}

		    });

			//Autocomplete para recuperar los datos de un prospecto o cliente
	        $('#txtProspecto_cotizaciones_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoID_cotizaciones_maquinaria_maquinaria').val('');
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
	             $('#txtProspectoID_cotizaciones_maquinaria_maquinaria').val(ui.item.data);

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
	        $('#txtProspecto_cotizaciones_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoID_cotizaciones_maquinaria_maquinaria').val() == '' ||
	               $('#txtProspecto_cotizaciones_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_cotizaciones_maquinaria_maquinaria').val('');
	               $('#txtProspecto_cotizaciones_maquinaria_maquinaria').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_cotizaciones_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVendedorID_cotizaciones_maquinaria_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: intModuloIDCotizacionesMaquinariaMaquinaria
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorID_cotizaciones_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtVendedor_cotizaciones_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_cotizaciones_maquinaria_maquinaria').val() == '' ||
	               $('#txtVendedor_cotizaciones_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_cotizaciones_maquinaria_maquinaria').val('');
	               $('#txtVendedor_cotizaciones_maquinaria_maquinaria').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una estrategia
	        $('#txtEstrategia_cotizaciones_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEstrategiaID_cotizaciones_maquinaria_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/estrategias/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: intModuloIDCotizacionesMaquinariaMaquinaria
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtEstrategiaID_cotizaciones_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtEstrategia_cotizaciones_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id de la estrategia
	            if($('#txtEstrategiaID_cotizaciones_maquinaria_maquinaria').val() == '' ||
	               $('#txtEstrategia_cotizaciones_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEstrategiaID_cotizaciones_maquinaria_maquinaria').val('');
	               $('#txtEstrategia_cotizaciones_maquinaria_maquinaria').val('');
	            }
	            
	        });
	        
	        //Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });


	        //Autocomplete para recuperar los datos de una descripción de maquinaria
			$('#txtCodigo_cotizaciones_maquinaria_maquinaria').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val('');
					//Hacer un llamado a la función para inicializar elementos de la descripción de maquinaria
					inicializar_descripcion_maquinaria_cotizaciones_maquinaria_maquinaria();
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "maquinaria/maquinaria_descripciones/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term,
							strTipo: 'codigo',
							strMovimientoRefaccionesInternas: ''
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val(ui.item.data);
					//Hacer un llamado a la función para regresar los datos de la descripción de maquinaria
					get_datos_descripcion_maquinaria_cotizaciones_maquinaria_maquinaria();
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
	        $('#txtCodigo_cotizaciones_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id de la descripción de maquinaria
	            if($('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val() == '' ||
	               $('#txtCodigo_cotizaciones_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val('');
	               $('#txtCodigo_cotizaciones_maquinaria_maquinaria').val('');
	               //Hacer un llamado a la función para inicializar elementos de la descripción de maquinaria
	               inicializar_descripcion_maquinaria_cotizaciones_maquinaria_maquinaria();
	            }
	        });

	        //Autocomplete para recuperar los datos de una descripción de maquinaria
			$('#txtDescripcionCorta_cotizaciones_maquinaria_maquinaria').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val('');
					//Hacer un llamado a la función para inicializar elementos de la descripción de maquinaria
					inicializar_descripcion_maquinaria_cotizaciones_maquinaria_maquinaria();
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "maquinaria/maquinaria_descripciones/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term,
							strTipo: 'codigo',
							strMovimientoRefaccionesInternas: ''
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val(ui.item.data);
					//Hacer un llamado a la función para regresar los datos de la descripción de maquinaria
					get_datos_descripcion_maquinaria_cotizaciones_maquinaria_maquinaria();
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
	        $('#txtDescripcionCorta_cotizaciones_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id de la descripción de maquinaria
	            if($('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val() == '' ||
	               $('#txtDescripcionCorta_cotizaciones_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val('');
	               $('#txtCodigo_cotizaciones_maquinaria_maquinaria').val('');
	               //Hacer un llamado a la función para inicializar elementos de la descripción de maquinaria
	               inicializar_descripcion_maquinaria_cotizaciones_maquinaria_maquinaria();
	            }
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_cotizaciones_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_cotizaciones_maquinaria_maquinaria').val('');
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
	             $('#txtTasaCuotaIva_cotizaciones_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtPorcentajeIva_cotizaciones_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_cotizaciones_maquinaria_maquinaria').val() == '' ||
	               $('#txtPorcentajeIva_cotizaciones_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_cotizaciones_maquinaria_maquinaria').val('');
	               $('#txtPorcentajeIva_cotizaciones_maquinaria_maquinaria').val('');
	            }

	            //Hacer un llamado a la función para calcular el importe total de la cotización
				calcular_total_cotizaciones_maquinaria_maquinaria();
	            
	        });


	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_cotizaciones_maquinaria_maquinaria').val('');
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
	             $('#txtTasaCuotaIeps_cotizaciones_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_cotizaciones_maquinaria_maquinaria').val() == '' ||
	               $('#txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_cotizaciones_maquinaria_maquinaria').val('');
	               $('#txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria').val('');
	            }

	            //Hacer un llamado a la función para calcular el importe total de la cotización
				calcular_total_cotizaciones_maquinaria_maquinaria();
	            
	        });


	       //Calcular el importe total de la cotización cuando pierda el enfoque la caja de texto
			$('#txtPrecio_cotizaciones_maquinaria_maquinaria').focusout(function(e){
				//Hacer un llamado a la función para calcular el importe total de la cotización
				calcular_total_cotizaciones_maquinaria_maquinaria();
			});

			//Calcular el importe total de la cotización cuando pierda el enfoque la caja de texto
			$('#txtPorcentajeDescuento_cotizaciones_maquinaria_maquinaria').focusout(function(e){
				//Hacer un llamado a la función para calcular el importe total de la cotización
				calcular_total_cotizaciones_maquinaria_maquinaria();
			});

			//Validar que exista código cuando se pulse la tecla enter 
			$('#txtCodigo_cotizaciones_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13)
		        {
		        	//Si no existe descripción de maquinaria
		            if($('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val() == '' || $('#txtCodigo_cotizaciones_maquinaria_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCodigo_cotizaciones_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtDescripcionCorta_cotizaciones_maquinaria_maquinaria').focus();
			   	    }
		        }
		    });

		    //Validar que exista descripción corta cuando se pulse la tecla enter 
			$('#txtDescripcionCorta_cotizaciones_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13)
		        {
		        	//Si no existe descripción de maquinaria
		            if($('#txtMaquinariaDescripcionID_cotizaciones_maquinaria_maquinaria').val() == '' || $('#txtDescripcionCorta_cotizaciones_maquinaria_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtDescripcionCorta_cotizaciones_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtPrecio_cotizaciones_maquinaria_maquinaria').focus();
			   	    }
		        }
		    });

			//Validar que exista precio  cuando se pulse la tecla enter 
			$('#txtPrecio_cotizaciones_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13)
		        {
		        	//Si no existe precio
		            if( $('#txtPrecio_cotizaciones_maquinaria_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecio_cotizaciones_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para calcular el importe total de la cotización
						calcular_total_cotizaciones_maquinaria_maquinaria();
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_cotizaciones_maquinaria_maquinaria').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_cotizaciones_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13)
		        {
		        	//Si no existe procentaje del descuento
		            if( $('#txtPorcentajeDescuento_cotizaciones_maquinaria_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeDescuento_cotizaciones_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para calcular el importe total de la cotización
						calcular_total_cotizaciones_maquinaria_maquinaria();
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIva_cotizaciones_maquinaria_maquinaria').focus();
			   	    }
		         	
		        }
		    });

			//Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_cotizaciones_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13)
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IVA
		         	if($('#txtTasaCuotaIva_cotizaciones_maquinaria_maquinaria').val() == '' && 
		         	   $('#txtPorcentajeIva_cotizaciones_maquinaria_maquinaria').val() != '')
			   	    {
			   	    	//Limpiar caja de texto
			   	    	$('#txtPorcentajeIva_cotizaciones_maquinaria_maquinaria').val('');
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_cotizaciones_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para calcular el importe total de la cotización
						calcular_total_cotizaciones_maquinaria_maquinaria();
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria').focus();
			   	    }
		         	
		        }
		    });

			//Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13)
		        {

			   	    //Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtTasaCuotaIeps_cotizaciones_maquinaria_maquinaria').val() == '' && 
		         	   $('#txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria').val() != '')
			   	    {
			   	    	//Limpiar caja de texto
			   	    	$('#txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria').val('');
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_cotizaciones_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para calcular el importe total de la cotización
						calcular_total_cotizaciones_maquinaria_maquinaria();
			   	    }
		         
		        }
		    });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_cotizaciones_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_cotizaciones_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_cotizaciones_maquinaria_maquinaria').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_cotizaciones_maquinaria_maquinaria').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_cotizaciones_maquinaria_maquinaria').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_cotizaciones_maquinaria_maquinaria').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un prospecto o cliente
	        $('#txtProspectoBusq_cotizaciones_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProspectoIDBusq_cotizaciones_maquinaria_maquinaria').val('');
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
	             $('#txtProspectoIDBusq_cotizaciones_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtProspectoBusq_cotizaciones_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoIDBusq_cotizaciones_maquinaria_maquinaria').val() == '' ||
	               $('#txtProspectoBusq_cotizaciones_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_cotizaciones_maquinaria_maquinaria').val('');
	               $('#txtProspectoBusq_cotizaciones_maquinaria_maquinaria').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_cotizaciones_maquinaria_maquinaria').on('click','a',function(event){
				event.preventDefault();
				intPaginaCotizacionesMaquinariaMaquinaria = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_cotizaciones_maquinaria_maquinaria();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_cotizaciones_maquinaria_maquinaria').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_cotizaciones_maquinaria_maquinaria();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_cotizaciones_maquinaria_maquinaria').addClass("estatus-NUEVO");
				//Abrir modal
				 objCotizacionesMaquinariaMaquinaria = $('#CotizacionesMaquinariaMaquinariaBox').bPopup({
												   appendTo: '#CotizacionesMaquinariaMaquinariaContent', 
					                               contentContainer: 'CotizacionesMaquinariaMaquinariaM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_cotizaciones_maquinaria_maquinaria').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_cotizaciones_maquinaria_maquinaria').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_cotizaciones_maquinaria_maquinaria();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_cotizaciones_maquinaria_maquinaria();
		});
	</script>