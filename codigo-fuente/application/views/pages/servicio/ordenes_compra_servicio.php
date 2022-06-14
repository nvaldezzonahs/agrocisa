	<div id="OrdenesCompraServicioServicioContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_ordenes_compra_servicio_servicio" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_ordenes_compra_servicio_servicio" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_ordenes_compra_servicio_servicio">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_ordenes_compra_servicio_servicio'>
				                    <input class="form-control" id="txtFechaInicialBusq_ordenes_compra_servicio_servicio"
				                    		name= "strFechaInicialBusq_ordenes_compra_servicio_servicio" 
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
								<label for="txtFechaFinalBusq_ordenes_compra_servicio_servicio">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_ordenes_compra_servicio_servicio'>
				                    <input class="form-control" id="txtFechaFinalBusq_ordenes_compra_servicio_servicio"
				                    		name= "strFechaFinalBusq_ordenes_compra_servicio_servicio" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los proveedores activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
								<input id="txtProveedorIDBusq_ordenes_compra_servicio_servicio" 
									   name="intProveedorIDBusq_ordenes_compra_servicio_servicio"  type="hidden" 
									   value="">
								</input>
								<label for="txtProveedorBusq_ordenes_compra_servicio_servicio">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProveedorBusq_ordenes_compra_servicio_servicio" 
										name="strProveedorBusq_ordenes_compra_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_ordenes_compra_servicio_servicio">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_ordenes_compra_servicio_servicio" 
								 		name="strEstatusBusq_ordenes_compra_servicio_servicio" tabindex="1">
								    <option value="TODOS">TODOS</option>
	                  				<option value="ACTIVO">ACTIVO</option>
	                  				<option value="AUTORIZADO">AUTORIZADO</option>
	                  				<option value="PARCIAL">PARCIAL</option>
	                  				<option value="SURTIDO">SURTIDO</option>
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
								<label for="txtBusqueda_ordenes_compra_servicio_servicio">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_ordenes_compra_servicio_servicio" 
										name="strBusqueda_ordenes_compra_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_ordenes_compra_servicio_servicio" 
									   name="strImprimirDetalles_ordenes_compra_servicio_servicio" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_ordenes_compra_servicio_servicio"
									onclick="paginacion_ordenes_compra_servicio_servicio();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_ordenes_compra_servicio_servicio" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_ordenes_compra_servicio_servicio"
									onclick="reporte_ordenes_compra_servicio_servicio('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_ordenes_compra_servicio_servicio"
									onclick="reporte_ordenes_compra_servicio_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil.a3:nth-of-type(3):before {content: "Proveedor"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "No. de orden"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles de la orden de compra
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
				Definir columnas de los totales (acumulados) de la tabla detalles de la orden de compra
				*/
				/*Totales*/
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
				<table class="table-hover movil" id="dg_ordenes_compra_servicio_servicio">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Proveedor</th>
							<th class="movil">No. de orden</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:20em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_ordenes_compra_servicio_servicio" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{proveedor}}</td>
							<td class="movil a4">{{folio_orden_reparacion}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="td-center movil a6"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_ordenes_compra_servicio_servicio({{orden_compra_servicio_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_ordenes_compra_servicio_servicio({{orden_compra_servicio_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!---Autorizar o rechazar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionAutorizar}}"  
										onclick="abrir_autorizar_ordenes_compra_servicio_servicio({{orden_compra_servicio_id}},'{{folio}}', 'Autorizar');"  title="Autorizar o Rechazar">
									<span class="fa fa-check-square-o"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_proveedor_ordenes_compra_servicio_servicio({{orden_compra_servicio_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_ordenes_compra_servicio_servicio({{orden_compra_servicio_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
							    <!--Subir varios archivos-->
								<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
									<span class="btn  btn-default btn-xs fileinput-button ">
								    	<span class="fa fa-upload"></span>
										<input name="archivo_varios_ordenes_compra_servicio_servicio{{orden_compra_servicio_id}}[]" id="archivo_varios_ordenes_compra_servicio_servicio{{orden_compra_servicio_id}}"  type="file" multiple accept="text/xml,application/pdf" 
											   onchange="subir_archivos_grid_ordenes_compra_servicio_servicio({{orden_compra_servicio_id}});">
								  		</input>
								    </span>
								</span>
                            	<!--Descargar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_ordenes_compra_servicio_servicio({{orden_compra_servicio_id}}, '{{folio}}');" title="Descargar archivo">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
                            	<!--Eliminar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}" 
                            			 onmousedown="eliminar_archivos_ordenes_compra_servicio_servicio({{orden_compra_servicio_id}});" title="Eliminar archivo">
                            		<span class="glyphicon glyphicon-export"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_ordenes_compra_servicio_servicio({{orden_compra_servicio_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_ordenes_compra_servicio_servicio({{orden_compra_servicio_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ordenes_compra_servicio_servicio"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_ordenes_compra_servicio_servicio">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Autorizar Orden de Compra-->
		<div id="AutorizarOrdenesCompraServicioServicioBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_autorizar_ordenes_compra_servicio_servicio" class="ModalBodyTitle confirmacion-modal-title"">
			<h1 id="tituloModal_autorizar_ordenes_compra_servicio_servicio"></h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAutorizarOrdenesCompraServicioServicio" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmAutorizarOrdenesCompraServicioServicio"  onsubmit="return(false)" autocomplete="off">
			    	<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReferenciaID_autorizar_ordenes_compra_servicio_servicio" 
										   name="intReferenciaID_autorizar_ordenes_compra_servicio_servicio" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el tipo de acción (guardar o autorizar) a realizar --> 
									<input type="hidden" id="txtTipoAccion_autorizar_ordenes_compra_servicio_servicio" 
										   name="strTipoAccion_autorizar_ordenes_compra_servicio_servicio" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el folio del registro seleccionado--> 
									<input type="hidden" id="txtFolio_autorizar_ordenes_compra_servicio_servicio" 
										   name="strFolio_autorizar_ordenes_compra_servicio_servicio" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Ordenes de Compra-->
									<input id="txtModalOrdenesCompraServicio_autorizar_ordenes_compra_servicio_servicio" 
										   name="strModalOrdenesCompraServicio_autorizar_ordenes_compra_servicio_servicio" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para asignar a los usuarios que se les enviará 
									     el mensaje--> 
									<input type="hidden" id="txtUsuarios_autorizar_ordenes_compra_servicio_servicio" 
										   name="strUsuarios_autorizar_ordenes_compra_servicio_servicio" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Enviar notificación a:</h4>
										</div>
										<div class="panel-body">
											<div id="treeUsuarios_autorizar_ordenes_compra_servicio_servicio" class="md-list-item-text"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="divEstatus_autorizar_ordenes_compra_servicio_servicio" class="row no-mostrar">
						<!--Estatus-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbEstatus_autorizar_ordenes_compra_servicio_servicio">Estatus</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbEstatus_autorizar_ordenes_compra_servicio_servicio" 
									 		name="strEstatus_autorizar_ordenes_compra_servicio_servicio" tabindex="1">
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
									<label for="txtMensaje_autorizar_ordenes_compra_servicio_servicio">Mensaje</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtMensaje_autorizar_ordenes_compra_servicio_servicio" 
											   name="strMensaje_autorizar_ordenes_compra_servicio_servicio" rows="5" value="" tabindex="1" placeholder="Ingrese mensaje" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Autorizar o rechazar registro-->
							<button class="btn btn-success" id="btnGuardar_autorizar_ordenes_compra_servicio_servicio"  
									onclick="validar_autorizar_ordenes_compra_servicio_servicio();"  title="Enviar" tabindex="1">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_autorizar_ordenes_compra_servicio_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_autorizar_ordenes_compra_servicio_servicio();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Autorizar Orden de Compra-->

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarOrdenesCompraServicioServicioBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_proveedor_ordenes_compra_servicio_servicio" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarOrdenesCompraServicioServicio" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarOrdenesCompraServicioServicio"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Proveedor-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtOrdencCompraServicioID_proveedor_ordenes_compra_servicio_servicio" 
										   name="intOrdenCompraServicioID_proveedor_ordenes_compra_servicio_servicio" 
										   type="hidden" value="">
									</input>
									<label for="txtProveedor_proveedor_ordenes_compra_servicio_servicio">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_proveedor_ordenes_compra_servicio_servicio" 
											name="strProveedor_proveedor_ordenes_compra_servicio_servicio" type="text" value="" 
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
									<label for="txtCorreoElectronico_proveedor_ordenes_compra_servicio_servicio">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_proveedor_ordenes_compra_servicio_servicio" 
											name="strCorreoElectronico_proveedor_ordenes_compra_servicio_servicio" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_proveedor_ordenes_compra_servicio_servicio">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_proveedor_ordenes_compra_servicio_servicio" 
											name="strCopiaCorreoElectronico_proveedor_ordenes_compra_servicio_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_proveedor_ordenes_compra_servicio_servicio" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_proveedor_ordenes_compra_servicio_servicio"  
									onclick="validar_proveedor_ordenes_compra_servicio_servicio();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_proveedor_ordenes_compra_servicio_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_proveedor_ordenes_compra_servicio_servicio();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal Ordenes de Compra-->
		<div id="OrdenesCompraServicioServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_ordenes_compra_servicio_servicio"  class="ModalBodyTitle">
			<h1>Ordenes de Compra</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmOrdenesCompraServicioServicio" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmOrdenesCompraServicioServicio"  onsubmit="return(false)" 
					  autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtOrdencCompraServicioID_ordenes_compra_servicio_servicio" 
										   name="intOrdenCompraServicioID_ordenes_compra_servicio_servicio" type="hidden" value="">
									</input>
									<label for="txtFolio_ordenes_compra_servicio_servicio">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_ordenes_compra_servicio_servicio" 
											name="strFolio_ordenes_compra_servicio_servicio" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_ordenes_compra_servicio_servicio">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_ordenes_compra_servicio_servicio'>
					                    <input class="form-control" id="txtFecha_ordenes_compra_servicio_servicio"
					                    		name= "strFecha_ordenes_compra_servicio_servicio" 
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
									<label for="cmbMonedaID_ordenes_compra_servicio_servicio">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_ordenes_compra_servicio_servicio" 
									 		name="intMonedaID_ordenes_compra_servicio_servicio" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_ordenes_compra_servicio_servicio">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_ordenes_compra_servicio_servicio" id="txtTipoCambio_ordenes_compra_servicio_servicio" 
											name="intTipoCambio_ordenes_compra_servicio_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene las ordenes de reparación activas-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la orden de reparación seleccionada-->
									<input id="txtOrdenReparacionID_ordenes_compra_servicio_servicio" 
										   name="intOrdenReparacionID_ordenes_compra_servicio_servicio"  type="hidden" 
										   value="">
									</input>
									<label for="txtOrdenReparacion_ordenes_compra_servicio_servicio">No. de orden</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtOrdenReparacion_ordenes_compra_servicio_servicio" 
											name="strOrdenReparacion_ordenes_compra_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese orden" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Cliente-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtProspecto_ordenes_compra_servicio_servicio">Cliente</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProspecto_ordenes_compra_servicio_servicio" 
											name="strProspecto_ordenes_compra_servicio_servicio" type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
					</div>	
				    <div class="row">
				    	<!--Autocomplete que contiene los proveedores activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
									<input id="txtProveedorID_ordenes_compra_servicio_servicio" 
										   name="intProveedorID_ordenes_compra_servicio_servicio"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del régimen fiscal-->
									<input id="txtRegimenFiscalID_ordenes_compra_servicio_servicio" 
										   name="intRegimenFiscalID_ordenes_compra_servicio_servicio"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar los días de crédito del proveedor seleccionado-->
									<input id="txtDiasCredito_ordenes_compra_servicio_servicio" 
										   name="intDiasCredito_ordenes_compra_servicio_servicio"  type="hidden" 
										   value="">
									</input>
									<label for="txtProveedor_ordenes_compra_servicio_servicio">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_ordenes_compra_servicio_servicio" 
											name="strProveedor_ordenes_compra_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    	<!--Condiciones de pago-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCondicionesPago_ordenes_compra_servicio_servicio">Condiciones de pago</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbCondicionesPago_ordenes_compra_servicio_servicio" 
									 		name="strCondicionesPago_ordenes_compra_servicio_servicio" tabindex="1">
                          				<option value="">Seleccione una opción</option>
                          				<option value="CONTADO">CONTADO</option>
                          				<option value="CREDITO">CREDITO</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Fecha de vencimiento-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaVencimiento_ordenes_compra_servicio_servicio">Fecha de vencimiento</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaVencimiento_ordenes_compra_servicio_servicio'>
					                    <input class="form-control" id="txtFechaVencimiento_ordenes_compra_servicio_servicio"
					                    		name= "strFechaVencimiento_ordenes_compra_servicio_servicio" 
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
				    	<!--Fecha de entrega-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaEntrega_ordenes_compra_servicio_servicio">Fecha de entrega</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaEntrega_ordenes_compra_servicio_servicio'>
					                    <input class="form-control" id="txtFechaEntrega_ordenes_compra_servicio_servicio"
					                    		name= "strFechaEntrega_ordenes_compra_servicio_servicio" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Factura-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFactura_ordenes_compra_servicio_servicio">Factura</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFactura_ordenes_compra_servicio_servicio" 
											name="strFactura_ordenes_compra_servicio_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese factura" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Total de unidades-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTotalUnidades_ordenes_compra_servicio_servicio">Total de unidades</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control cantidad_ordenes_compra_servicio_servicio" id="txtTotalUnidades_ordenes_compra_servicio_servicio" 
											name="intTotalUnidades_ordenes_compra_servicio_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese total de unidades" maxlength="21">
									</input>
								</div>
							</div>
						</div>
						<!--Total-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteTotal_ordenes_compra_servicio_servicio">Importe total</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_ordenes_compra_servicio_servicio" id="txtImporteTotal_ordenes_compra_servicio_servicio" 
												name="intImporteTotal_ordenes_compra_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23">
										</input>
										
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Autocomplete que contiene los empleados activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
									<input id="txtSolicitaID_ordenes_compra_servicio_servicio" 
										   name="intSolicitaID_ordenes_compra_servicio_servicio"  type="hidden" 
										   value="">
									</input>
									<label for="txtSolicita_ordenes_compra_servicio_servicio">Solicita</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSolicita_ordenes_compra_servicio_servicio" 
											name="strSolicita_ordenes_compra_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese quien lo solicita" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
				    <div class="row">
				    	<!--Observaciones-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_ordenes_compra_servicio_servicio">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_ordenes_compra_servicio_servicio" 
											name="strObservaciones_ordenes_compra_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
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
									<input id="txtNumDetalles_ordenes_compra_servicio_servicio" 
										   name="intNumDetalles_ordenes_compra_servicio_servicio" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la orden de compra</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Concepto-->
													<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
																<input id="txtRenglon_detalles_ordenes_compra_servicio_servicio" 
																	   name="intRenglon_detalles_ordenes_compra_servicio_servicio" type="hidden" value="">
																</input>
																<label for="txtConcepto_detalles_ordenes_compra_servicio_servicio">
																	Concepto
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtConcepto_detalles_ordenes_compra_servicio_servicio" 
																		name="strConcepto_detalles_ordenes_compra_servicio_servicio" type="text" value="" 
																		tabindex="1" placeholder="Ingrese concepto" maxlength="250">
																</input>
															</div>
														</div>
													</div>
												    <!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_ordenes_compra_servicio_servicio">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_ordenes_compra_servicio_servicio" 
																		id="txtCantidad_detalles_ordenes_compra_servicio_servicio" 
																		name="intCantidad_detalles_ordenes_compra_servicio_servicio" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="21">
																</input>
															</div>
														</div>
													</div>
													<!--Precio unitario-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio">Precio unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control precio_unitario_ordenes_compra_servicio_servicio" id="txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio" 
																		name="intPrecioUnitario_detalles_ordenes_compra_servicio_servicio" type="text" value="" tabindex="1" placeholder="Ingrese precio unitario" maxlength="21">
																</input>
															</div>
														</div>
													</div>
													
												</div>
												<div class="row">
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control descuento_ordenes_compra_servicio_servicio" id="txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio" 
																		name="intPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio" type="text" value="0.00" 
																		tabindex="1" placeholder="Ingrese descuento" maxlength="15">
																</input>
															</div>
														</div>
													</div>
													<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IVA -->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
																<input id="txtTasaCuotaIva_detalles_ordenes_compra_servicio_servicio" 
																	   name="intTasaCuotaIva_detalles_ordenes_compra_servicio_servicio" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio">IVA %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio" 
																		name="intPorcentajeIva_detalles_ordenes_compra_servicio_servicio" type="text" value="" 
																		tabindex="1" placeholder="Ingrese IVA" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--IVA unitario -->
													<div  class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtIvaUnitario_detalles_ordenes_compra_servicio_servicio">IVA unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_ordenes_compra_servicio_servicio" id="txtIvaUnitario_detalles_ordenes_compra_servicio_servicio" 
																		name="intIvaUnitario_detalles_ordenes_compra_servicio_servicio" type="text" value="" 
																		tabindex="1" placeholder="Ingrese importe" maxlength="19">
																</input>
															</div>
														</div>
													</div>
													<!--Autocomplete que contiene las tasas o cuotas activas del impuesto de IEPS -->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
																<input id="txtTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio" 
																	   name="intTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el tipo de la tasa o cuota del impuesto de IEPS-->
																<input id="txtTipoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio" 
																	   name="strTipoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el factor de la tasa o cuota del impuesto de IEPS-->
																<input id="txtFactorTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio" 
																	   name="strFactorTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el valor mínimo de la tasa o cuota del impuesto de IEPS-->
																<input id="txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio" 
																	   name="intValorMinimoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio">IEPS %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio" 
																		name="intPorcentajeIeps_detalles_ordenes_compra_servicio_servicio" type="text" value="" 
																		tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--IEPS unitario -->
													<div id="divIepsUnitario_detalles_ordenes_compra_servicio_servicio"  class="col-sm-2 col-md-2 col-lg-2 col-xs-12 no-mostrar">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtIepsUnitario_detalles_ordenes_compra_servicio_servicio">IEPS unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_ordenes_compra_servicio_servicio" id="txtIepsUnitario_detalles_ordenes_compra_servicio_servicio" 
																		name="intIepsUnitario_detalles_ordenes_compra_servicio_servicio" type="text" value="" 
																		tabindex="1" placeholder="Ingrese importe" maxlength="19">
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_detalles_ordenes_compra_servicio_servicio"
					                                			onclick="agregar_renglon_detalles_ordenes_compra_servicio_servicio();" 
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
													<table class="table-hover movil" id="dg_detalles_ordenes_compra_servicio_servicio">
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
															<!--Totales-->
															<tr class="movil">
																<td class="movil t1">
																	<strong>Total</strong>
																</td>
																<td  class="movil t2">
																	<strong id="acumCantidad_detalles_ordenes_compra_servicio_servicio"></strong>
																</td>
																<td class="movil t3"></td>
																<td class="movil t4">
																	<strong id="acumDescuento_detalles_ordenes_compra_servicio_servicio"></strong>
																</td>
																<td class="movil t5">
																	<strong id="acumSubtotal_detalles_ordenes_compra_servicio_servicio"></strong>
																</td>
																<td class="movil t6">
																	<strong id="acumIva_detalles_ordenes_compra_servicio_servicio"></strong>
																</td>
																<td class="movil t7">
																	<strong  id="acumIeps_detalles_ordenes_compra_servicio_servicio"></strong>
																</td>
																<td class="movil t8">
																	<strong id="acumTotal_detalles_ordenes_compra_servicio_servicio"></strong>
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
																<strong id="numElementos_detalles_ordenes_compra_servicio_servicio">0</strong> encontrados
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--Retención de ISR (proveedor)-->
							<div id="divRetencionIsr_ordenes_compra_servicio_servicio"  class="col-sm-6 col-md-6 col-lg-6 col-xs-12 pull-right no-mostrar">
									<div class="form-group">
											<!--Porcentaje de ISR-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<input id="txtPorcentajeRetencionID_ordenes_compra_servicio_servicio" name="intPorcentajeRetencionID_ordenes_compra_servicio_servicio" type="hidden" value="">
														</input>
														<label for="txtPorcentajeIsr_ordenes_compra_servicio_servicio">Retención de ISR %</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control" id="txtPorcentajeIsr_ordenes_compra_servicio_servicio" 
																name="intPorcentajeIsr_ordenes_compra_servicio_servicio" type="text" value="" 
																tabindex="1" placeholder="Ingrese retención de ISR" maxlength="250">
														</input>
													</div>
												</div>
											</div>
											<!--Importe retenido-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<label for="txtImporteRetenido_ordenes_compra_servicio_servicio">Importe de ISR</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control moneda_ordenes_compra_servicio_servicio" id="txtImporteRetenido_ordenes_compra_servicio_servicio" 
																name="intImporteRetenido_ordenes_compra_servicio_servicio" type="text" value="" 
																tabindex="1"  placeholder="Ingrese importe" maxlength="18">
														</input>
													</div>
											</div>
										</div>
									</div>
								</div><!--Fin del div Retención de ISR (proveedor)--->

						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_ordenes_compra_servicio_servicio"  
									onclick="validar_ordenes_compra_servicio_servicio();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!---Autorizar o rechazar registro-->
							<button class="btn btn-default" id="btnAutorizar_ordenes_compra_servicio_servicio"  
									onclick="abrir_autorizar_ordenes_compra_servicio_servicio('','','Autorizar');"  title="Autorizar o Rechazar" tabindex="3" disabled>
								<span class="fa fa-check-square-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_ordenes_compra_servicio_servicio"  
									onclick="abrir_proveedor_ordenes_compra_servicio_servicio('');"  
									title="Enviar correo electrónico" tabindex="4" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_ordenes_compra_servicio_servicio"  
									onclick="reporte_registro_ordenes_compra_servicio_servicio('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
		                    <!--Subir varios archivos-->
		                    <span  class="fileupload-buttonbar" tabindex="6">
		                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_ordenes_compra_servicio_servicio" disabled>
		                        	<span class="fa fa-upload"></span>
		                        	<input id="archivo_varios_ordenes_compra_servicio_servicio" 
		                        		   name="archivo_varios_ordenes_compra_servicio_servicio[]" type="file" multiple 
		                        		   accept="text/xml,application/pdf" onchange="subir_archivos_modal_ordenes_compra_servicio_servicio('Editar');">
		                        	</input>
		                        </span>
		                    </span>
		                    <!--Descargar archivo-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_ordenes_compra_servicio_servicio"  
									onclick="descargar_archivos_ordenes_compra_servicio_servicio('','');"  title="Descargar archivo" tabindex="7" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Eliminar archivo-->
							<button class="btn btn-default" id="btnEliminarArchivo_ordenes_compra_servicio_servicio"  
									onclick="eliminar_archivos_ordenes_compra_servicio_servicio('')"  title="Eliminar archivo" tabindex="8" disabled>
								<span class="glyphicon glyphicon-export"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_ordenes_compra_servicio_servicio"  
									onclick="cambiar_estatus_ordenes_compra_servicio_servicio('','ACTIVO');"  title="Desactivar" tabindex="9" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_ordenes_compra_servicio_servicio"  
									onclick="cambiar_estatus_ordenes_compra_servicio_servicio('','INACTIVO');"  title="Restaurar" tabindex="10" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_ordenes_compra_servicio_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_ordenes_compra_servicio_servicio();" 
									title="Cerrar"  tabindex="11">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Ordenes de Compra-->
	</div><!--#OrdenesCompraServicioServicioContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_ordenes_compra_servicio_servicio" type="text/template">
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
		var intPaginaOrdenesCompraServicioServicio = 0;
		var strUltimaBusquedaOrdenesCompraServicioServicio = "";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
		var intNumDecimalesMostrarOrdenesCompraServicioServicio = <?php echo NUM_DECIMALES_MOSTRAR_SERVICIO ?>;
		//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
		var intNumDecimalesCantidadBDOrdenesCompraServicioServicio = <?php echo NUM_DECIMALES_CANTIDAD_OC_SERVICIO ?>;
		var intNumDecimalesPrecioUnitBDOrdenesCompraServicioServicio = <?php echo NUM_DECIMALES_PRECIO_UNIT_OC_SERVICIO ?>;
		var intNumDecimalesDescUnitBDOrdenesCompraServicioServicio = <?php echo NUM_DECIMALES_DESCUENTO_UNIT_OC_SERVICIO ?>;
		var intNumDecimalesIvaUnitBDOrdenesCompraServicioServicio = <?php echo NUM_DECIMALES_IVA_UNIT_OC_SERVICIO ?>;
		var intNumDecimalesIepsUnitBDOrdenesCompraServicioServicio = <?php echo NUM_DECIMALES_IEPS_UNIT_OC_SERVICIO ?>;

		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDOrdenesCompraServicioServicio = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseOrdenesCompraServicioServicio = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoOrdenesCompraServicioServicio = <?php echo TIPO_CAMBIO_MAXIMO ?>;

		//Variable que se utiliza para asignar el id del porcentaje de retención ISR base
		var intPorcentajeRetencionBaseIDOrdenesCompraServicioServicio = <?php echo PORCENTAJE_ISR_BASE ?>;
		//Variable que se utiliza para asignar el id del régimen fiscal: Régimen Simplificado de Confianza
		var intRegimenFiscalIDResicoOrdenesCompraServicioServicio = <?php echo REGIMEN_FISCAL_RESICO ?>;

		
		//Variable que se utiliza para asignar objeto del modal Autorizar Orden de Compra
		var objAutorizarOrdenesCompraServicioServicio = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarOrdenesCompraServicioServicio = null;
		//Variable que se utiliza para asignar objeto del modal Ordenes de Compra
		var objOrdenesCompraServicioServicio = null;

		//Array que contiene los id´s de las cajas de texto que se utilizan para calcular la fecha de vencimiento
		var arrFechaVencimientoOrdenesCompraServicioServicio  = {fecha: '#txtFecha_ordenes_compra_servicio_servicio',
															 condicionesPago: '#cmbCondicionesPago_ordenes_compra_servicio_servicio',
															 diasCredito: '#txtDiasCredito_ordenes_compra_servicio_servicio',
															 fechaVencimiento: '#txtFechaVencimiento_ordenes_compra_servicio_servicio'
															};


		/*******************************************************************************************************************
		Funciones del objeto Detalles de la orden de compra
		*********************************************************************************************************************/
		// Constructor del objeto detalles
		var objDetallesOrdenOrdenesCompraServicioServicio;
		function DetallesOrdenOrdenesCompraServicioServicio(detalles)
		{
			this.arrDetalles = detalles;
		}

		//Función para obtener todos los detalles de la orden de compra
		DetallesOrdenOrdenesCompraServicioServicio.prototype.getDetalles = function() {
		    return this.arrDetalles;
		}

		//Función para agregar una detalle al objeto 
		DetallesOrdenOrdenesCompraServicioServicio.prototype.setDetalle = function (detalle){
			this.arrDetalles.push(detalle);
		}

		//Función para obtener un detalle del objeto
		DetallesOrdenOrdenesCompraServicioServicio.prototype.getDetalle = function(index) {
		    return this.arrDetalles[index];
		}

		//Función para modificar un detalle del objeto
		DetallesOrdenOrdenesCompraServicioServicio.prototype.modificarDetalle = function (index, detalle){
			this.arrDetalles[index] = detalle;
		}

		//Función para eliminar un detalle del objeto
		DetallesOrdenOrdenesCompraServicioServicio.prototype.eliminarDetalle = function (index){
			if(index != -1) 
			{
				this.arrDetalles.splice(index, 1);
			}
		}

		//Función para cambiar las posiciones de los detalles en el objeto
		DetallesOrdenOrdenesCompraServicioServicio.prototype.swap = function(index_A, index_B) {
		    var input = this.arrDetalles;
		 
		    var temp = input[index_A];
		    input[index_A] = input[index_B];
		    input[index_B] = temp;
		}

		/*******************************************************************************************************************
		Funciones del objeto Detalle de la orden de compra
		*********************************************************************************************************************/
		//Constructor del objeto detalle
		var objDetalleOrdenOrdenesCompraServicioServicio;
		function DetalleOrdenOrdenesCompraServicioServicio(concepto, cantidad,  precioUnitario, 
														   porcentajeDescuento, descuentoUnitario, 
										                   tasaCuotaIva, importeIva, porcentajeIva, ivaUnitario, 
										               	   tasaCuotaIeps, importeIeps, porcentajeIeps, 
										               	   iepsUnitario, tipoTasaCuotaIeps, 
										               	   factorTasaCuotaIeps, valorMinimoTasaCuotaIeps)
		{
		   
		    this.strConcepto = concepto;
		    this.intCantidad = cantidad;
		    this.intPrecioUnitario = precioUnitario;
		    this.intPorcentajeDescuento = porcentajeDescuento;
		    this.intDescuentoUnitario = descuentoUnitario;
		    this.intTasaCuotaIva = tasaCuotaIva;
		    this.intImporteIva = importeIva;
		    this.intPorcentajeIva = porcentajeIva;
		    this.intIvaUnitario = ivaUnitario;
		    this.intTasaCuotaIeps = tasaCuotaIeps;
		    this.intImporteIeps = importeIeps;
		    this.intPorcentajeIeps = porcentajeIeps;
		    this.intIepsUnitario = iepsUnitario;
		    this.strTipoTasaCuotaIeps = tipoTasaCuotaIeps;
		    this.strFactorTasaCuotaIeps = factorTasaCuotaIeps;
		    this.intValorMinimoTasaCuotaIeps = valorMinimoTasaCuotaIeps;
		}


		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_ordenes_compra_servicio_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/ordenes_compra_servicio/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_ordenes_compra_servicio_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosOrdenesCompraServicioServicio = data.row;
					//Separar la cadena 
					var arrPermisosOrdenesCompraServicioServicio = strPermisosOrdenesCompraServicioServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosOrdenesCompraServicioServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosOrdenesCompraServicioServicio[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_ordenes_compra_servicio_servicio').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosOrdenesCompraServicioServicio[i]=='GUARDAR') || (arrPermisosOrdenesCompraServicioServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_ordenes_compra_servicio_servicio').removeAttr('disabled');
						}
						//Si el indice es ADJUNTAR
						else if(arrPermisosOrdenesCompraServicioServicio[i]=='ADJUNTAR')
						{
							//Habilitar el control (botón Adjuntar)
							$('#btnAdjuntar_ordenes_compra_servicio_servicio').removeAttr('disabled');
							//Habilitar el control (botón eliminar archivo)
							$('#btnEliminarArchivo_ordenes_compra_servicio_servicio').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosOrdenesCompraServicioServicio[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_ordenes_compra_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraServicioServicio[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_ordenes_compra_servicio_servicio').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_ordenes_compra_servicio_servicio();
						}
						else if(arrPermisosOrdenesCompraServicioServicio[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_ordenes_compra_servicio_servicio').removeAttr('disabled');
							$('#btnRestaurar_ordenes_compra_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraServicioServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_ordenes_compra_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraServicioServicio[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_ordenes_compra_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraServicioServicio[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_ordenes_compra_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraServicioServicio[i]=='AUTORIZAR')//Si el indice es AUTORIZAR
						{
							//Habilitar el control (botón autorizar)
							$('#btnAutorizar_ordenes_compra_servicio_servicio').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraServicioServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_ordenes_compra_servicio_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_ordenes_compra_servicio_servicio() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaOrdenesCompraServicioServicio =($('#txtFechaInicialBusq_ordenes_compra_servicio_servicio').val()+$('#txtFechaFinalBusq_ordenes_compra_servicio_servicio').val()+$('#txtProveedorIDBusq_ordenes_compra_servicio_servicio').val()+$('#cmbEstatusBusq_ordenes_compra_servicio_servicio').val()+$('#txtBusqueda_ordenes_compra_servicio_servicio').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaOrdenesCompraServicioServicio != strUltimaBusquedaOrdenesCompraServicioServicio)
			{
				intPaginaOrdenesCompraServicioServicio = 0;
				strUltimaBusquedaOrdenesCompraServicioServicio = strNuevaBusquedaOrdenesCompraServicioServicio;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/ordenes_compra_servicio/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_compra_servicio_servicio').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_compra_servicio_servicio').val()),
					 intProveedorID: $('#txtProveedorIDBusq_ordenes_compra_servicio_servicio').val(),
					 strEstatus: $('#cmbEstatusBusq_ordenes_compra_servicio_servicio').val(),
					 strBusqueda: $('#txtBusqueda_ordenes_compra_servicio_servicio').val(),
					 intPagina: intPaginaOrdenesCompraServicioServicio,
					 strPermisosAcceso: $('#txtAcciones_ordenes_compra_servicio_servicio').val()
					},
					function(data){
						$('#dg_ordenes_compra_servicio_servicio tbody').empty();
						var tmpOrdenesCompraServicioServicio = Mustache.render($('#plantilla_ordenes_compra_servicio_servicio').html(),data);
						$('#dg_ordenes_compra_servicio_servicio tbody').html(tmpOrdenesCompraServicioServicio);
						$('#pagLinks_ordenes_compra_servicio_servicio').html(data.paginacion);
						$('#numElementos_ordenes_compra_servicio_servicio').html(data.total_rows);
						intPaginaOrdenesCompraServicioServicio = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_ordenes_compra_servicio_servicio(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/ordenes_compra_servicio/';

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
			if ($('#chbImprimirDetalles_ordenes_compra_servicio_servicio').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_ordenes_compra_servicio_servicio').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_ordenes_compra_servicio_servicio').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_compra_servicio_servicio').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_compra_servicio_servicio').val()),
										'intProveedorID': $('#txtProveedorIDBusq_ordenes_compra_servicio_servicio').val(),
										'strEstatus': $('#cmbEstatusBusq_ordenes_compra_servicio_servicio').val(), 
										'strBusqueda': $('#txtBusqueda_ordenes_compra_servicio_servicio').val(),
										'strDetalles': $('#chbImprimirDetalles_ordenes_compra_servicio_servicio').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_ordenes_compra_servicio_servicio(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'servicio/ordenes_compra_servicio/get_reporte_registro',
							'data' : {
										'intOrdenCompraServicioID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}


		//Función para subir archivos de un registro desde el grid view
		function subir_archivos_grid_ordenes_compra_servicio_servicio(ordenCompraServicioID)
		{
			//Crear instancia al objeto del formulario
	        var formData = new FormData($("#frmOrdenesCompraServicioServicio")[0]);
			//Agregar campos al objeto del formulario
			formData.append("intOrdenCompraServicioID_ordenes_compra_servicio_servicio", ordenCompraServicioID);
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDGridOrdenesCompraServicioServicio  = "archivo_varios_ordenes_compra_servicio_servicio"+ordenCompraServicioID;
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDGridOrdenesCompraServicioServicio);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDGridOrdenesCompraServicioServicio)[0].files;
			//Variable que se utiliza para asignar la extensión del primer archivo seleccionado
			var strExtensionAnterior = '';
			//Variable que se utiliza para asignar el mensaje de error
			var strMensajeError = '';
            //Si el el número de archivos seleccionados es mayor que dos
	        if(parseInt(fileUpload.get(0).files.length) > 2)
	        {
	           //Mensaje que se utiliza para informar al usuario que solo es posible subir dos archivos
	           strMensajeError = 'Solamente puede subir dos archivos: un XML y un PDF.';
	        }
	        else
	        {
	        	//Hacer recorrido para verificar que la extensión de los  archivos seleccionados sea diferente
	        	for (var intCont = 0; intCont < parseInt(fileUpload.get(0).files.length); intCont++)
				{
				    //Obtenemos el nombre del archivo
					var fileName = files[intCont].name;
					//Obtenemos la extensión del archivo
					var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);

					//Si existe un archivo anterior
					if(strExtensionAnterior !== '')
					{
						//Verificar si la extensión del archivo es la misma
						if(strExtensionAnterior == fileExtension)
						{
							//Mensaje que se utiliza para informar al usuario que los archivos son de la misma extensión
							strMensajeError = 'No es posible subir los archivos con la misma extensión,  favor de seleccionar un XML y un PDF.';
						}

					}

					//Asignar extensión del primer archivo
					strExtensionAnterior = fileExtension;

					//Agregar campo tipo file al objeto del formulario
					formData.append("archivo_varios_ordenes_compra_servicio_servicio[]", document.getElementById(strBotonArchivoIDGridOrdenesCompraServicioServicio).files[intCont]);
				 	
				}
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Limpia ruta del archivo cargado
		        $('#'+strBotonArchivoIDGridOrdenesCompraServicioServicio).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_ordenes_compra_servicio_servicio('error', strMensajeError);
	        }
	        else
	        {
	        	//Hacer un llamado al método del controlador para subir archivos del registro
	            $.ajax({
	                url: 'servicio/ordenes_compra_servicio/subir_archivos',
	                type: "POST",
	                data: formData,
	                contentType: false,
	                processData: false,
	                success: function(data)
	                {
	                    //Limpia ruta del archivo cargado
		         		$('#'+strBotonArchivoIDGridOrdenesCompraServicioServicio).val('');
						//Subida finalizada.
						if (data.resultado)
						{
		         		   //Hacer llamado a la función  para cargar  los registros en el grid
			           	   paginacion_ordenes_compra_servicio_servicio();  
						}
                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    		mensaje_ordenes_compra_servicio_servicio(data.tipo_mensaje, data.mensaje);
	                }
            	});

	        }

		}

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_ordenes_compra_servicio_servicio(ordenCompraServicioID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intOrdenCompraServicioID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(ordenCompraServicioID == '')
			{
				intOrdenCompraServicioID = $('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val();
				strFolio = $('#txtFolio_ordenes_compra_servicio_servicio').val();
			}
			else
			{
				intOrdenCompraServicioID = ordenCompraServicioID;
				strFolio = folio;
			}

			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'servicio/ordenes_compra_servicio/descargar_archivos',
							'data' : {
										'intOrdenCompraServicioID': intOrdenCompraServicioID,
										'strFolio': strFolio				
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

		}

		//Función que se utiliza para eliminar los archivos del registro seleccionado
		function eliminar_archivos_ordenes_compra_servicio_servicio(id)
		{

			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;

			//Si no existe id, significa que se eliminara el archivo desde el modal
			if(id == '')
			{
				intID = $('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para eliminar carpeta que contiene los archivos del registro
			$.post('servicio/ordenes_compra_servicio/eliminar_carpeta_registro',
			     {intOrdenCompraServicioID: intID
			     },
			     function(data) {
			       
			        if(data.resultado)
			        {
			         	//Hacer llamado a la función  para cargar  los registros en el grid
		          	    paginacion_ordenes_compra_servicio_servicio();
		          	    //Si el id del registro se obtuvo del modal
						if(id == '')
						{
							//Ocultar los siguientes botones
							$('#btnDescargarArchivo_ordenes_compra_servicio_servicio').hide();
							$('#btnEliminarArchivo_ordenes_compra_servicio_servicio').hide();    
						}
			        }
		        	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		       		mensaje_ordenes_compra_servicio_servicio(data.tipo_mensaje, data.mensaje);
			       
			     },
			    'json');
		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_ordenes_compra_servicio_servicio()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_ordenes_compra_servicio_servicio').empty();
					var temp = Mustache.render($('#monedas_ordenes_compra_servicio_servicio').html(), data);
					$('#cmbMonedaID_ordenes_compra_servicio_servicio').html(temp);
				},
				'json');
		}


		//Regresar el porcentaje de retención ISR base
		function cargar_porcentaje_isr_base_ordenes_compra_servicio_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/porcentaje_retencion_isr/get_datos',
			       {
			       		strBusqueda:intPorcentajeRetencionBaseIDOrdenesCompraServicioServicio,
			       		strTipo: 'id'
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				            $('#txtPorcentajeRetencionID_ordenes_compra_servicio_servicio').val(data.row.porcentaje_retencion_id);
				            $('#txtPorcentajeIsr_ordenes_compra_servicio_servicio').val(data.row.porcentaje);
			       	    }
			       },
			       'json');
		}

		
		/*******************************************************************************************************************
		Funciones del modal Autorizar Orden de Compra
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_autorizar_ordenes_compra_servicio_servicio()
		{
			//Incializar formulario
			$('#frmAutorizarOrdenesCompraServicioServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_ordenes_compra_servicio_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmAutorizarOrdenesCompraServicioServicio').find('input[type=hidden]').val('');
			//Agregar clase no-mostrar para ocultar div que contiene el estatus
			$('#divEstatus_autorizar_ordenes_compra_servicio_servicio').addClass("no-mostrar");
		    $('#divEncabezadoModal_autorizar_ordenes_compra_servicio_servicio').addClass("estatus-ACTIVO");
		}

		//Función que se utiliza para abrir el modal
		function abrir_autorizar_ordenes_compra_servicio_servicio(id, folio, tipoAccion)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_autorizar_ordenes_compra_servicio_servicio();
			
			//Variables que se utilizan para asignar los datos del registro
			var intReferenciaID = 0;
			var strFolio = '';

			//Si no existe id, significa que se aplicará autorización (o rechazo) desde el modal
			if(id == '')
			{
				intReferenciaID = $('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val();
				strFolio =  $('#txtFolio_ordenes_compra_servicio_servicio').val();
				$('#txtModalOrdenesCompraServicio_autorizar_ordenes_compra_servicio_servicio').val('SI');
			}
			else
			{
				intReferenciaID = id;
				strFolio = folio;
				$('#txtModalOrdenesCompraServicio_autorizar_ordenes_compra_servicio_servicio').val('NO');
			}

			//Asignar datos del registro seleccionado
			$('#txtReferenciaID_autorizar_ordenes_compra_servicio_servicio').val(intReferenciaID);
			$('#txtTipoAccion_autorizar_ordenes_compra_servicio_servicio').val(tipoAccion);
			$('#txtFolio_autorizar_ordenes_compra_servicio_servicio').val(strFolio);

			//Si el tipo de acción corresponde a Guardar
			if(tipoAccion == 'Guardar')
			{
				//Cambiar título del modal
				$('#tituloModal_autorizar_ordenes_compra_servicio_servicio').text('Notificar Orden de Compra');
				$('#txtMensaje_autorizar_ordenes_compra_servicio_servicio').val('Favor de autorizar la orden de compra servicio '+ strFolio);
				//Cargar el treeview
				get_treeview_usuarios_autorizar_ordenes_compra_servicio_servicio('');
			}
			else
			{
				//Quitar clase no-mostrar para mostrar div que contiene el estatus
				$('#divEstatus_autorizar_ordenes_compra_servicio_servicio').removeClass("no-mostrar");
				//Cambiar título del modal
				$('#tituloModal_autorizar_ordenes_compra_servicio_servicio').text('Autorizar Orden de Compra');
				//Cargar el treeview
				get_treeview_usuarios_autorizar_ordenes_compra_servicio_servicio(intReferenciaID);
			}

			//Abrir modal
			objAutorizarOrdenesCompraServicioServicio = $('#AutorizarOrdenesCompraServicioServicioBox').bPopup({
													   appendTo: '#OrdenesCompraServicioServicioContent', 
							                           contentContainer: 'OrdenesCompraServicioServicioM', 
							                           zIndex: 2, 
							                           modalClose: false, 
							                           modal: true, 
							                           follow: [true,false], 
							                           followEasing : "linear", 
							                           easing: "linear", 
							                           modalColor: ('#F0F0F0')});
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_autorizar_ordenes_compra_servicio_servicio()
		{
			try {
				//Cerrar modal
				objAutorizarOrdenesCompraServicioServicio.close();
				//Eliminar datos del treeview
				$("#treeUsuarios_autorizar_ordenes_compra_servicio_servicio").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_compra_servicio_servicio').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_autorizar_ordenes_compra_servicio_servicio()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosAutorizarOrdenesCompraServicioServicio = [];

			//Recorremos el treeview
			$("#treeUsuarios_autorizar_ordenes_compra_servicio_servicio").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosAutorizarOrdenesCompraServicioServicio.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtUsuarios_autorizar_ordenes_compra_servicio_servicio").val(arrSeleccionadosAutorizarOrdenesCompraServicioServicio.join('|'));
			
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_ordenes_compra_servicio_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmAutorizarOrdenesCompraServicioServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_autorizar_ordenes_compra_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Escriba un mensaje'}
											}
										},
										strUsuarios_autorizar_ordenes_compra_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un usuario para este mensaje.'}
											}
										}, 
										strEstatus_autorizar_ordenes_compra_servicio_servicio: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista estatus seleccionado cuando el tipo de acción sea Autorizar
					                                    if($('#txtTipoAccion_autorizar_ordenes_compra_servicio_servicio').val() === 'Autorizar' && $('#cmbEstatus_autorizar_ordenes_compra_servicio_servicio').val() == '')
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
			var bootstrapValidator_autorizar_ordenes_compra_servicio_servicio = $('#frmAutorizarOrdenesCompraServicioServicio').data('bootstrapValidator');
			bootstrapValidator_autorizar_ordenes_compra_servicio_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_autorizar_ordenes_compra_servicio_servicio.isValid())
			{
				//Hacer un llamado a la función para guardar la solicitud de autorización
				guardar_autorizar_ordenes_compra_servicio_servicio();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_autorizar_ordenes_compra_servicio_servicio()
		{
			try
			{
				$('#frmAutorizarOrdenesCompraServicioServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar la autorización (o el rechazo) de un registro
		function guardar_autorizar_ordenes_compra_servicio_servicio()
		{
			//Hacer un llamado al método del controlador para enviar la autorización (o el rechazo) de un registro 
			$.post('servicio/ordenes_compra_servicio/set_enviar_autorizacion',
			     {intOrdenCompraServicioID: $('#txtReferenciaID_autorizar_ordenes_compra_servicio_servicio').val(),
			      strUsuarios: $('#txtUsuarios_autorizar_ordenes_compra_servicio_servicio').val(), 
			      strMensaje:  $('#txtMensaje_autorizar_ordenes_compra_servicio_servicio').val(),
			      strEstatus:  $('#cmbEstatus_autorizar_ordenes_compra_servicio_servicio').val(),
			      strTipoAccion:  $('#txtTipoAccion_autorizar_ordenes_compra_servicio_servicio').val()
			     },
			     function(data) {
			        if(data.resultado)
			        {
			          	//Hacer llamado a la función  para cargar  los registros en el grid
			          	paginacion_ordenes_compra_servicio_servicio();
			          	//Hacer un llamado a la función para cerrar modal
					  	cerrar_autorizar_ordenes_compra_servicio_servicio();

					  	//Si el id de la referencia (para la autorización) se recuperó del modal Ordenes de Compra 
					  	if($('#txtModalOrdenesCompraServicio_autorizar_ordenes_compra_servicio_servicio').val() == 'SI')
					  	{
					  		//Hacer un llamado a la función para cerrar modal Ordenes de Compra 
					 	 	cerrar_ordenes_compra_servicio_servicio();
					  	}   
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_ordenes_compra_servicio_servicio(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		/*Función que se utiliza para definir tree view de usuarios con acceso a la función Autorizar del proceso
		 *Ordenes de Compra (módulo Servicio)*/
		function get_treeview_usuarios_autorizar_ordenes_compra_servicio_servicio(id)
		{
			$('#treeUsuarios_autorizar_ordenes_compra_servicio_servicio').fancytree({
				source: {
					url: "seguridad/usuarios/get_treeview/AUTORIZAR_ORDENES_COMPRA_SERVICIO/ORDENES DE COMPRA SERVICIO/"+id,
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
		function nuevo_proveedor_ordenes_compra_servicio_servicio()
		{
			//Incializar formulario
			$('#frmEnviarOrdenesCompraServicioServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedor_ordenes_compra_servicio_servicio();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_proveedor_ordenes_compra_servicio_servicio');
		}

		//Función que se utiliza para abrir el modal
		function abrir_proveedor_ordenes_compra_servicio_servicio(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_proveedor_ordenes_compra_servicio_servicio();
			//Variables que se utilizan para asignar los datos del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/ordenes_compra_servicio/get_datos',
			       {intOrdenCompraServicioID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtOrdencCompraServicioID_proveedor_ordenes_compra_servicio_servicio').val(data.row.orden_compra_servicio_id);
							$('#txtProveedor_proveedor_ordenes_compra_servicio_servicio').val(data.row.proveedor);
							$('#txtCorreoElectronico_proveedor_ordenes_compra_servicio_servicio').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_proveedor_ordenes_compra_servicio_servicio').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_proveedor_ordenes_compra_servicio_servicio').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarOrdenesCompraServicioServicio = $('#EnviarOrdenesCompraServicioServicioBox').bPopup({
																   appendTo: '#OrdenesCompraServicioServicioContent', 
										                           contentContainer: 'OrdenesCompraServicioServicioM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_proveedor_ordenes_compra_servicio_servicio').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_proveedor_ordenes_compra_servicio_servicio()
		{
			try {
				//Cerrar modal
				objEnviarOrdenesCompraServicioServicio.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_proveedor_ordenes_compra_servicio_servicio();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_proveedor_ordenes_compra_servicio_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedor_ordenes_compra_servicio_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarOrdenesCompraServicioServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_proveedor_ordenes_compra_servicio_servicio: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_proveedor_ordenes_compra_servicio_servicio: {
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
			var bootstrapValidator_proveedor_ordenes_compra_servicio_servicio = $('#frmEnviarOrdenesCompraServicioServicio').data('bootstrapValidator');
			bootstrapValidator_proveedor_ordenes_compra_servicio_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_proveedor_ordenes_compra_servicio_servicio.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_proveedor_ordenes_compra_servicio_servicio();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_proveedor_ordenes_compra_servicio_servicio()
		{
			try
			{
				$('#frmEnviarOrdenesCompraServicioServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al proveedor
		function enviar_correo_proveedor_ordenes_compra_servicio_servicio()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_proveedor_ordenes_compra_servicio_servicio();
			//Hacer un llamado al método del controlador para enviar correo electrónico al proveedor
			$.post('servicio/ordenes_compra_servicio/enviar_correo_electronico_proveedor',
					{ 
						intOrdenCompraServicioID: $('#txtOrdencCompraServicioID_proveedor_ordenes_compra_servicio_servicio').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_proveedor_ordenes_compra_servicio_servicio').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_proveedor_ordenes_compra_servicio_servicio').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_proveedor_ordenes_compra_servicio_servicio();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_proveedor_ordenes_compra_servicio_servicio();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_compra_servicio_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_proveedor_ordenes_compra_servicio_servicio()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_proveedor_ordenes_compra_servicio_servicio").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_proveedor_ordenes_compra_servicio_servicio()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_proveedor_ordenes_compra_servicio_servicio").addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones del modal Ordenes de Compra
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_ordenes_compra_servicio_servicio()
		{
			//Incializar formulario
			$('#frmOrdenesCompraServicioServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_compra_servicio_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmOrdenesCompraServicioServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_ordenes_compra_servicio_servicio');
		    //Eliminar los datos de la tabla detalles de la orden de compra
		    $('#dg_detalles_ordenes_compra_servicio_servicio tbody').empty();
		    $('#acumCantidad_detalles_ordenes_compra_servicio_servicio').html('');
		    $('#acumDescuento_detalles_ordenes_compra_servicio_servicio').html('');
		    $('#acumSubtotal_detalles_ordenes_compra_servicio_servicio').html('');
		    $('#acumIva_detalles_ordenes_compra_servicio_servicio').html('');
		    $('#acumIeps_detalles_ordenes_compra_servicio_servicio').html('');
		    $('#acumTotal_detalles_ordenes_compra_servicio_servicio').html('');
			$('#numElementos_detalles_ordenes_compra_servicio_servicio').html(0);
	        //Hacer un llamado a la función para inicializar elementos del porcentaje de IEPS
	        inicializar_porcentaje_ieps_detalles_ordenes_compra_servicio_servicio();
	        //Crear instancia del objeto Detalles de la orden de compra
			objDetallesOrdenOrdenesCompraServicioServicio = new DetallesOrdenOrdenesCompraServicioServicio([]);
			//Asignar NO para indicar que no se ha abierto el modal Autorizar Orden de Compra
			$('#txtModalOrdenesCompraServicio_autorizar_ordenes_compra_servicio_servicio').val('NO');
			//Habilitar todos los elementos del formulario
			$('#frmOrdenesCompraServicioServicio').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_ordenes_compra_servicio_servicio').val(fechaActual()); 
			$('#txtFechaVencimiento_ordenes_compra_servicio_servicio').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_ordenes_compra_servicio_servicio').attr("disabled", "disabled");
			$('#txtProspecto_ordenes_compra_servicio_servicio').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_ordenes_compra_servicio_servicio").show();
			$("#btnAdjuntar_ordenes_compra_servicio_servicio").show();
			//Habilitar botón Agregar
			$('#btnAgregar_detalles_ordenes_compra_servicio_servicio').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnAutorizar_ordenes_compra_servicio_servicio").hide();
			$("#btnEnviarCorreo_ordenes_compra_servicio_servicio").hide();
			$("#btnImprimirRegistro_ordenes_compra_servicio_servicio").hide();
			$("#btnDescargarArchivo_ordenes_compra_servicio_servicio").hide();
			$("#btnEliminarArchivo_ordenes_compra_servicio_servicio").hide();
			$("#btnDesactivar_ordenes_compra_servicio_servicio").hide();
			$("#btnRestaurar_ordenes_compra_servicio_servicio").hide();

			//Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_ordenes_compra_servicio_servicio();
		}


		//Función para inicializar elementos del proveedor
		function inicializar_proveedor_ordenes_compra_servicio_servicio()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtDiasCredito_ordenes_compra_servicio_servicio').val('');
            $('#txtRegimenFiscalID_ordenes_compra_servicio_servicio').val('');
            $('#txtPorcentajeRetencionID_ordenes_compra_servicio_servicio').val('');
            $('#txtPorcentajeIsr_ordenes_compra_servicio_servicio').val('');
            $('#txtImporteRetenido_ordenes_compra_servicio_servicio').val('');

            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
	        mostrar_retencion_isr_ordenes_compra_servicio_servicio();
            
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_ordenes_compra_servicio_servicio()
		{
			try {
				//Cerrar modal
				objOrdenesCompraServicioServicio.close();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
			    cerrar_proveedor_ordenes_compra_servicio_servicio();
				//Si el id de la referencia (para la autorización) se recuperó del modal Ordenes de Compra 
				if($('#txtModalOrdenesCompraServicio_autorizar_ordenes_compra_servicio_servicio').val() == 'SI')
				{
					//Hacer un llamado a la función para cerrar modal Autorizar Orden de Compra
					cerrar_autorizar_ordenes_compra_servicio_servicio();
				}
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_compra_servicio_servicio').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_ordenes_compra_servicio_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_compra_servicio_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmOrdenesCompraServicioServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_ordenes_compra_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaEntrega_ordenes_compra_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaVencimiento_ordenes_compra_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strCondicionesPago_ordenes_compra_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una condición de pago'}
											}
										},
										intMonedaID_ordenes_compra_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_ordenes_compra_servicio_servicio: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_ordenes_compra_servicio_servicio').val()) !== intMonedaBaseIDOrdenesCompraServicioServicio)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoOrdenesCompraServicioServicio)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoOrdenesCompraServicioServicio
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strProveedor_ordenes_compra_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtProveedorID_ordenes_compra_servicio_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un proveedor existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intPorcentajeIsr_ordenes_compra_servicio_servicio: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el id del porcentaje de retención ISR
						                                    if(parseInt($('#txtRegimenFiscalID_ordenes_compra_servicio_servicio').val()) === intRegimenFiscalIDResicoOrdenesCompraServicioServicio)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba una retención de ISR existente'
						                                        	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										intImporteRetenido_ordenes_compra_servicio_servicio: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el id del porcentaje de retención ISR
						                                    if(parseInt($('#txtRegimenFiscalID_ordenes_compra_servicio_servicio').val()) === intRegimenFiscalIDResicoOrdenesCompraServicioServicio)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba un importe'
						                                        	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strSolicita_ordenes_compra_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtSolicitaID_ordenes_compra_servicio_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un empleado existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strOrdenReparacion_ordenes_compra_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la orden de reparación
					                                    if($('#txtOrdenReparacionID_ordenes_compra_servicio_servicio').val() === '')
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
										intTotalUnidades_ordenes_compra_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Escriba el total de unidades'}
											}
										},
										intImporteTotal_ordenes_compra_servicio_servicio: {
											validators: {
												notEmpty: {message: 'Escriba el importe total'}
											}
										},
										intNumDetalles_ordenes_compra_servicio_servicio: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta orden de compra.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strConcepto_detalles_ordenes_compra_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_detalles_ordenes_compra_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_detalles_ordenes_compra_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_detalles_ordenes_compra_servicio_servicio: {
											excluded: true  //Ignorar (no valida el campo)
										},
										intIvaUnitario_detalles_ordenes_compra_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIeps_detalles_ordenes_compra_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intIepsUnitario_detalles_ordenes_compra_servicio_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_ordenes_compra_servicio_servicio = $('#frmOrdenesCompraServicioServicio').data('bootstrapValidator');
			bootstrapValidator_ordenes_compra_servicio_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_ordenes_compra_servicio_servicio.isValid())
			{
				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesOrdenesCompraServicioServicio = $.reemplazar($('#acumTotal_detalles_ordenes_compra_servicio_servicio').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesOrdenesCompraServicioServicio = $.reemplazar(intAcumTotalDetallesOrdenesCompraServicioServicio, ",", "");

				var intImporteTotalOrdenesCompraServicioServicio = $.reemplazar($('#txtImporteTotal_ordenes_compra_servicio_servicio').val(), ",", "");
 
				//Verificar que el total de unidades sea igual a la cantidad de detalles
				if($('#acumCantidad_detalles_ordenes_compra_servicio_servicio').html() != $('#txtTotalUnidades_ordenes_compra_servicio_servicio').val())
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_ordenes_compra_servicio_servicio('error', 'El total de unidades no coincide con los detalles, favor de verificar.');
					
				}
				//Verificar que el importe total sea igual al total de detalles
				else if(intAcumTotalDetallesOrdenesCompraServicioServicio != intImporteTotalOrdenesCompraServicioServicio)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_ordenes_compra_servicio_servicio('error', 'El importe total no coincide con los detalles, favor de verificar.');
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_ordenes_compra_servicio_servicio();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_ordenes_compra_servicio_servicio()
		{
			try
			{
				$('#frmOrdenesCompraServicioServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_ordenes_compra_servicio_servicio()
		{
			//Obtenemos un array con los datos del archivo
    		var arrArchivoOrdenesCompraServicioServicio = $("#archivo_varios_ordenes_compra_servicio_servicio");

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_servicio_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrConceptos = [];
			var arrCantidades = [];
			var arrPreciosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrTasaCuotaIva = [];
			var arrIvasUnitarios = [];
			var arrTasaCuotaIeps = [];
			var arrIepsUnitarios = [];

			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioOrden = parseFloat($('#txtTipoCambio_ordenes_compra_servicio_servicio').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
			    //Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad = $.reemplazar(objRen.cells[1].innerHTML, ",", "");
				var intPrecioUnitario = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[5].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[6].innerHTML, ",", "");

				//Calcular iva unitario
				intIvaUnitario =  intIvaUnitario / intCantidad;
				//Calcular ieps unitario
				intIepsUnitario = intIepsUnitario / intCantidad;

				//Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioOrden;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioOrden;
				intIvaUnitario = intIvaUnitario * intTipoCambioOrden;
				intIepsUnitario = intIepsUnitario * intTipoCambioOrden;

				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{	
					//Restar descuento al precio unitario
					intPrecioUnitario = intPrecioUnitario - intDescuentoUnitario;
				}

				//Redondear cantidad a x decimales
			    intPrecioUnitario = intPrecioUnitario.toFixed(intNumDecimalesPrecioUnitBDOrdenesCompraServicioServicio);
			    intPrecioUnitario = parseFloat(intPrecioUnitario);

				intIvaUnitario = intIvaUnitario.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraServicioServicio);
				intIvaUnitario = parseFloat(intIvaUnitario);

				intIepsUnitario = intIepsUnitario.toFixed(intNumDecimalesIepsUnitBDOrdenesCompraServicioServicio);
				intIepsUnitario = parseFloat(intIepsUnitario);

				//Asignar valores a los arrays
				arrConceptos.push(objRen.cells[0].innerHTML);
				arrCantidades.push(intCantidad);
				arrPreciosUnitarios.push(intPrecioUnitario);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrTasaCuotaIva.push(objRen.cells[12].innerHTML);
				arrIvasUnitarios.push(intIvaUnitario);
				arrTasaCuotaIeps.push(objRen.cells[13].innerHTML);
				arrIepsUnitarios.push(intIepsUnitario );
			}


			//Variable que se utiliza para asignar el importe retenido de ISR (proveedor)
			var intRetencionIsrProv =  parseFloat($.reemplazar($('#txtImporteRetenido_ordenes_compra_servicio_servicio').val(), ",", ""));

			//Si existe retención de ISR (proveedor)
			if(intRetencionIsrProv > 0)
			{
				//Convertir importes a peso mexicano
				intRetencionIsrProv = intRetencionIsrProv * intTipoCambioOrden;
				//Redondear cantidad a decimales
				intRetencionIsrProv = intRetencionIsrProv.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraServicioServicio);
				intRetencionIsrProv = parseFloat(intRetencionIsrProv);
			}



			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('servicio/ordenes_compra_servicio/guardar',
					{ 
						//Datos de la orden de compra
						intOrdenCompraServicioID: $('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val(),
						strFolioConsecutivo: $('#txtFolio_ordenes_compra_servicio_servicio').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_ordenes_compra_servicio_servicio').val()),
						dteFechaEntrega: $.formatFechaMysql($('#txtFechaEntrega_ordenes_compra_servicio_servicio').val()),
						dteFechaVencimiento: $.formatFechaMysql($('#txtFechaVencimiento_ordenes_compra_servicio_servicio').val()),
						strCondicionesPago: $('#cmbCondicionesPago_ordenes_compra_servicio_servicio').val(),
						intMonedaID: $('#cmbMonedaID_ordenes_compra_servicio_servicio').val(),
						intTipoCambio: intTipoCambioOrden,
						strFactura: $('#txtFactura_ordenes_compra_servicio_servicio').val(),
						intProveedorID: $('#txtProveedorID_ordenes_compra_servicio_servicio').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_ordenes_compra_servicio_servicio').val(),
						intPorcentajeRetencionID: $('#txtPorcentajeRetencionID_ordenes_compra_servicio_servicio').val(),
						intImporteRetenido: intRetencionIsrProv,
						intSolicitaID: $('#txtSolicitaID_ordenes_compra_servicio_servicio').val(),
						intOrdenReparacionID: $('#txtOrdenReparacionID_ordenes_compra_servicio_servicio').val(),
						strObservaciones: $('#txtObservaciones_ordenes_compra_servicio_servicio').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_ordenes_compra_servicio_servicio').val(),
						//Datos de los detalles
						strConceptos: arrConceptos.join('|'),
						strCantidades: arrCantidades.join('|'),
						strPreciosUnitarios: arrPreciosUnitarios.join('|'),
						strDescuentosUnitarios: arrDescuentosUnitarios.join('|'),
						strTasaCuotaIva: arrTasaCuotaIva.join('|'),
						strIvasUnitarios: arrIvasUnitarios.join('|'),
						strTasaCuotaIeps: arrTasaCuotaIeps.join('|'),
						strIepsUnitarios: arrIepsUnitarios.join('|')
						
					},
					function(data) {
						if (data.resultado)
						{

							//Si no existe id de la orden de compra, significa que es un nuevo registro   
							if($('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val() == '')
							{
							  	//Asignar el id de la orden de compra registrada en la base de datos
                     			$('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val(data.orden_compra_servicio_id);
                     			//Asignar folio consecutivo
                 				$('#txtFolio_ordenes_compra_servicio_servicio').val(data.folio);
                 			}

             				//Si existen archivos seleccionados
             				if(arrArchivoOrdenesCompraServicioServicio != undefined )
             				{
             					//Hacer un llamado a la función para subir el archivo
	                    		subir_archivos_modal_ordenes_compra_servicio_servicio('Nuevo');
             				}
             				else
             				{
             					//Hacer un llamado a la función para cerrar modal
		                    	cerrar_ordenes_compra_servicio_servicio();
		                    	//Hacer un llamado a la función para abrir modal de autorización
								abrir_autorizar_ordenes_compra_servicio_servicio($('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val(), $('#txtFolio_ordenes_compra_servicio_servicio').val(), 'Guardar');

								//Hacer llamado a la función  para cargar  los registros en el grid
		               			paginacion_ordenes_compra_servicio_servicio();  
             				}

						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_compra_servicio_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_ordenes_compra_servicio_servicio(tipoMensaje, mensaje)
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
                new $.Zebra_Dialog(mensaje, 
                				   {'type': 'information',
                                    'title': 'Información',
                                    'buttons': [{caption: 'Aceptar',
                                             callback: function () {
                                                //Enfocar caja de texto
                                                $('#txtIepsUnitario_detalles_ordenes_compra_servicio_servicio').focus();
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
		function cambiar_estatus_ordenes_compra_servicio_servicio(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val();

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
						              'title':    'Ordenes de Compra',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado a la función para modificar el estatus del registro
													  set_estatus_ordenes_compra_servicio_servicio(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_ordenes_compra_servicio_servicio(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_ordenes_compra_servicio_servicio(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('servicio/ordenes_compra_servicio/set_estatus',
			      {intOrdenCompraServicioID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_ordenes_compra_servicio_servicio();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_ordenes_compra_servicio_servicio();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_ordenes_compra_servicio_servicio(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ordenes_compra_servicio_servicio(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/ordenes_compra_servicio/get_datos',
			       {
			       		intOrdenCompraServicioID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ordenes_compra_servicio_servicio();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
						    //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				            //Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);

				            //Variable que se utiliza para asignar el importe retenido de ISR (proveedor)
				            var intRetencionIsrProv = parseFloat(data.row.importe_retenido);

				           //Si existe retención de ISR (proveedor)
				           if(intRetencionIsrProv > 0)
				           {
				           		//Convertir peso mexicano a tipo de cambio
								intRetencionIsrProv = intRetencionIsrProv / intTipoCambio;

				           }


				          	//Recuperar valores
				            $('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val(data.row.orden_compra_servicio_id);
				            $('#txtFolio_ordenes_compra_servicio_servicio').val(data.row.folio);
				            $('#txtFecha_ordenes_compra_servicio_servicio').val(data.row.fecha);
				            $('#txtFechaEntrega_ordenes_compra_servicio_servicio').val(data.row.fecha_entrega);
				            $('#txtFechaVencimiento_ordenes_compra_servicio_servicio').val(data.row.fecha_vencimiento);
				            $('#cmbCondicionesPago_ordenes_compra_servicio_servicio').val(data.row.condiciones_pago);
				            $('#cmbMonedaID_ordenes_compra_servicio_servicio').val(data.row.moneda_id);
				            $('#txtTipoCambio_ordenes_compra_servicio_servicio').val(data.row.tipo_cambio);
				            $('#txtFactura_ordenes_compra_servicio_servicio').val(data.row.factura);
				            $('#txtProveedorID_ordenes_compra_servicio_servicio').val(data.row.proveedor_id);
						    $('#txtProveedor_ordenes_compra_servicio_servicio').val(data.row.proveedor);
						    $('#txtRegimenFiscalID_ordenes_compra_servicio_servicio').val(data.row.regimen_fiscal_id);
						    $('#txtPorcentajeRetencionID_ordenes_compra_servicio_servicio').val(data.row.porcentaje_retencion_id);
						    $('#txtPorcentajeIsr_ordenes_compra_servicio_servicio').val(data.row.porcentaje_isr);
						    $('#txtImporteRetenido_ordenes_compra_servicio_servicio').val(intRetencionIsrProv);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporteRetenido_ordenes_compra_servicio_servicio').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarOrdenesCompraServicioServicio });

						    $('#txtDiasCredito_ordenes_compra_servicio_servicio').val(data.row.dias_credito);
						    $('#txtSolicitaID_ordenes_compra_servicio_servicio').val(data.row.solicita_id);
						    $('#txtSolicita_ordenes_compra_servicio_servicio').val(data.row.solicita);
						    $('#txtOrdenReparacionID_ordenes_compra_servicio_servicio').val(data.row.orden_reparacion_id);
						    $('#txtOrdenReparacion_ordenes_compra_servicio_servicio').val(data.row.folio_orden_reparacion);
						    $('#txtProspecto_ordenes_compra_servicio_servicio').val(data.row.prospecto);
						   
						    $('#txtObservaciones_ordenes_compra_servicio_servicio').val(data.row.observaciones);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_ordenes_compra_servicio_servicio').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_ordenes_compra_servicio_servicio").show();
				            //Ocultar botón Adjuntar archivo
				            $("#btnAdjuntar_ordenes_compra_servicio_servicio").hide();

				            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	    				 mostrar_retencion_isr_ordenes_compra_servicio_servicio();



				            //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar los siguientes botones
				            	$("#btnDescargarArchivo_ordenes_compra_servicio_servicio").show();
				            	//Si el estatus del registro es ACTIVO
				            	if(strEstatus == 'ACTIVO')
				            	{
				            		$('#btnEliminarArchivo_ordenes_compra_servicio_servicio').show();
				            	}
				           	}

							//Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmOrdenesCompraServicioServicio').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					            $("#btnGuardar_ordenes_compra_servicio_servicio").hide();
					            //Deshabilitar botón Agregar
								$('#btnAgregar_detalles_ordenes_compra_servicio_servicio').prop('disabled', true);
					           
					            //Si el estatus del registro es INACTIVO
				            	if(strEstatus == 'INACTIVO')
				            	{
				            		//Mostrar botón Restaurar
				            		$("#btnRestaurar_ordenes_compra_servicio_servicio").show();
				            	}
				            	else //Si el estatus del registro es AUTORIZADO
				            	{
				            		//Mostrar botón Enviar correo  
				            		$("#btnEnviarCorreo_ordenes_compra_servicio_servicio").show();
				            	}

				            }
				            else //ACTIVO O RECHAZADO
				            {
				            	 strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_detalles_ordenes_compra_servicio_servicio(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_detalles_ordenes_compra_servicio_servicio(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDOrdenesCompraServicioServicio)
							    {
									//Habilitar caja de texto
									$("#txtTipoCambio_ordenes_compra_servicio_servicio").removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar las siguientes cajas de texto
									$("#txtTipoCambio_ordenes_compra_servicio_servicio").attr('disabled','disabled');
							    }

				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
					            {
					            	//Mostrar los siguientes botones  
					            	$("#btnDesactivar_ordenes_compra_servicio_servicio").show();
					            	$("#btnEnviarCorreo_ordenes_compra_servicio_servicio").show();
					            	$("#btnAutorizar_ordenes_compra_servicio_servicio").show();
					            	$("#btnAdjuntar_ordenes_compra_servicio_servicio").show();
					            }
				            }


				          

				           	//Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {

				            	//Variable que se utiliza para asignar el renglón del detalle
								var intRenglon = data.detalles[intCon].renglon;

								//Crear instancia del objeto Detalle de la orden de compra
								objDetalleOrdenOrdenesCompraServicioServicio = 
								new DetalleOrdenOrdenesCompraServicioServicio('', '','',  '', '', '', '', '', 
															               	  '', '', '', '', 
															                  '', '', '', '');


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
								intCantidad =  formatMoney(intCantidad, intNumDecimalesCantidadBDOrdenesCompraServicioServicio, '');
								intPrecioUnitario =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDOrdenesCompraServicioServicio, '');
								
								intDescuentoUnitario =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDOrdenesCompraServicioServicio, '');
								
								intSubtotal  =  formatMoney(intSubtotal, intNumDecimalesMostrarOrdenesCompraServicioServicio, '');
								
								intImporteIva  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDOrdenesCompraServicioServicio, '');
								
								intImporteIeps  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDOrdenesCompraServicioServicio, '');
								
								intTotal  =  formatMoney(intTotal, intNumDecimalesMostrarOrdenesCompraServicioServicio, '');
								
								intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, 
									intNumDecimalesDescUnitBDOrdenesCompraServicioServicio, '');

								intIepsUnitario =  formatMoney(intIepsUnitario, intNumDecimalesIepsUnitBDOrdenesCompraServicioServicio, '');

								intIvaUnitario =  formatMoney(intIvaUnitario, intNumDecimalesIvaUnitBDOrdenesCompraServicioServicio, '');

								
								//Asignar valores al objeto
								objDetalleOrdenOrdenesCompraServicioServicio.strConcepto =  data.detalles[intCon].concepto;
								objDetalleOrdenOrdenesCompraServicioServicio.intCantidad = intCantidad;
								objDetalleOrdenOrdenesCompraServicioServicio.intPrecioUnitario = intPrecioUnitario;
								objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeDescuento = intPorcentajeDescuento;
								objDetalleOrdenOrdenesCompraServicioServicio.intDescuentoUnitario = intDescuentoUnitario;
								objDetalleOrdenOrdenesCompraServicioServicio.intTasaCuotaIva = data.detalles[intCon].tasa_cuota_iva;
								objDetalleOrdenOrdenesCompraServicioServicio.intImporteIva = intImporteIva;
								objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeIva = data.detalles[intCon].porcentaje_iva;;
								objDetalleOrdenOrdenesCompraServicioServicio.intIvaUnitario = intIvaUnitario;
								objDetalleOrdenOrdenesCompraServicioServicio.intTasaCuotaIeps = data.detalles[intCon].tasa_cuota_ieps;
								objDetalleOrdenOrdenesCompraServicioServicio.intImporteIeps = intImporteIeps;
								objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeIeps = intPorcentajeIeps;
								objDetalleOrdenOrdenesCompraServicioServicio.intIepsUnitario = intIepsUnitario;
								objDetalleOrdenOrdenesCompraServicioServicio.strTipoTasaCuotaIeps = data.detalles[intCon].tipo_ieps;
								objDetalleOrdenOrdenesCompraServicioServicio.strFactorTasaCuotaIeps = data.detalles[intCon].factor_ieps;
								objDetalleOrdenOrdenesCompraServicioServicio.intValorMinimoTasaCuotaIeps = data.detalles[intCon].valor_minimo_ieps;
								

								//Agregar datos del detalle de la orden de compra
							     objDetallesOrdenOrdenesCompraServicioServicio.setDetalle(objDetalleOrdenOrdenesCompraServicioServicio);

				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_ordenes_compra_servicio_servicio').getElementsByTagName('tbody')[0];

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
								var objCeldaIepsUnitario = objRenglon.insertCell(14);
								var objCeldaTipoTasaCuotaIeps = objRenglon.insertCell(15);
								var objCeldaFactorTasaCuotaIeps = objRenglon.insertCell(16);
								var objCeldaValorMinimoTasaCuotaIeps = objRenglon.insertCell(17);
								var objCeldaIvaUnitario = objRenglon.insertCell(18);

							
								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', intRenglon);
								objCeldaConcepto.setAttribute('class', 'movil b1');
								objCeldaConcepto.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.strConcepto;
								objCeldaCantidad.setAttribute('class', 'movil b2');
								objCeldaCantidad.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intCantidad;
								objCeldaPrecioUnitario.setAttribute('class', 'movil b3');
								objCeldaPrecioUnitario.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intPrecioUnitario;
								objCeldaDescuentoUnitario.setAttribute('class', 'movil b4');
								objCeldaDescuentoUnitario.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intDescuentoUnitario;
								objCeldaSubtotal.setAttribute('class', 'movil b5');
								objCeldaSubtotal.innerHTML = intSubtotal;
								objCeldaIva.setAttribute('class', 'movil b6');
								objCeldaIva.innerHTML = intImporteIva;
								objCeldaIeps.setAttribute('class', 'movil b7');
								objCeldaIeps.innerHTML = intImporteIeps;
								objCeldaTotal.setAttribute('class', 'movil b8');
								objCeldaTotal.innerHTML = intTotal;
								objCeldaAcciones.setAttribute('class', 'td-center movil b9');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeDescuento.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeDescuento; 
								objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIva.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeIva; 
								objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIeps.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeIeps;
								objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIva.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intTasaCuotaIva;
								objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIeps.innerHTML =  objDetalleOrdenOrdenesCompraServicioServicio.intTasaCuotaIeps;
								objCeldaIepsUnitario.setAttribute('class', 'no-mostrar');
								objCeldaIepsUnitario.innerHTML =  objDetalleOrdenOrdenesCompraServicioServicio.intIepsUnitario;
								objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTipoTasaCuotaIeps.innerHTML =  objDetalleOrdenOrdenesCompraServicioServicio.strTipoTasaCuotaIeps;
								objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaFactorTasaCuotaIeps.innerHTML =  objDetalleOrdenOrdenesCompraServicioServicio.strFactorTasaCuotaIeps;
								objCeldaValorMinimoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaValorMinimoTasaCuotaIeps.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intValorMinimoTasaCuotaIeps;
								objCeldaIvaUnitario.setAttribute('class', 'no-mostrar');
								objCeldaIvaUnitario.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intIvaUnitario;

				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_ordenes_compra_servicio_servicio();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_ordenes_compra_servicio_servicio tr").length - 2;
							$('#numElementos_detalles_ordenes_compra_servicio_servicio').html(intFilas);
							$('#txtNumDetalles_ordenes_compra_servicio_servicio').val(intFilas);
							
							
			            	//Abrir modal
				            objOrdenesCompraServicioServicio = $('#OrdenesCompraServicioServicioBox').bPopup({
														  appendTo: '#OrdenesCompraServicioServicioContent', 
							                              contentContainer: 'OrdenesCompraServicioServicioM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#cmbMonedaID_ordenes_compra_servicio_servicio').focus();
			       	    }
			       },
			       'json');
		}


		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_ordenes_compra_servicio_servicio()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_ordenes_compra_servicio_servicio').val()) !== intMonedaBaseIDOrdenesCompraServicioServicio)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_ordenes_compra_servicio_servicio").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_ordenes_compra_servicio_servicio').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_ordenes_compra_servicio_servicio').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_ordenes_compra_servicio_servicio").val(data.row.tipo_cambio_sat);
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}

		//Función para subir los archivos de un registro desde el modal
		function subir_archivos_modal_ordenes_compra_servicio_servicio(tipoAccion)
		{
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDOrdenesCompraServicioServicio  = "archivo_varios_ordenes_compra_servicio_servicio";
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDOrdenesCompraServicioServicio);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDOrdenesCompraServicioServicio)[0].files;
			//Variable que se utiliza para asignar la extensión del primer archivo seleccionado
			var strExtensionAnterior = '';
			//Variable que se utiliza para asignar el mensaje de error
			var strMensajeError = '';

            //Si el el número de archivos seleccionados es mayor que dos
	        if(parseInt(fileUpload.get(0).files.length) > 2)
	        {
	           //Mensaje que se utiliza para informar al usuario que solo es posible subir dos archivos
	           strMensajeError = 'Solamente puede subir dos archivos: un XML y un PDF.';
	        }
	        else
	        {
	        	//Hacer recorrido para verificar que la extensión de los  archivos seleccionados sea diferente
	        	for (var intCont = 0; intCont < parseInt(fileUpload.get(0).files.length); intCont++)
				{
				    //Obtenemos el nombre del archivo
					var fileName = files[intCont].name;
					//Obtenemos la extensión del archivo
					var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);

					//Si existe un archivo anterior
					if(strExtensionAnterior !== '')
					{
						//Verificar si la extensión del archivo es la misma
						if(strExtensionAnterior == fileExtension)
						{
							//Mensaje que se utiliza para informar al usuario que los archivos son de la misma extensión
							strMensajeError = 'No es posible subir los archivos con la misma extensión,  favor de seleccionar un XML y un PDF.';
						}
						
					}

					//Asignar extensión del primer archivo
					strExtensionAnterior = fileExtension;
				 	
				}
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Limpia ruta del archivo cargado
			    $('#'+strBotonArchivoIDOrdenesCompraServicioServicio).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_ordenes_compra_servicio_servicio('error', strMensajeError);
	        }
	        else
	        {
	        	//Si existe id del registro subir los archivos
	        	if($('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val() != '')
	        	{
		        	//Crear instancia al objeto del formulario
		        	var formData = new FormData($("#frmOrdenesCompraServicioServicio")[0]);
		        	//Hacer un llamado al método del controlador para subir archivos del registro
		            $.ajax({
		                url: 'servicio/ordenes_compra_servicio/subir_archivos',
		                type: "POST",
		                data: formData,
		                contentType: false,
		                processData: false,
		                success: function(data)
		                {
		                    //Limpia ruta del archivo cargado
			         		$('#'+strBotonArchivoIDOrdenesCompraServicioServicio).val('');
							//Subida finalizada.
							if (data.resultado)
							{
							   //Mostrar los siguientes botones
		                       $('#btnDescargarArchivo_ordenes_compra_servicio_servicio').show();
		                       $("#btnEliminarArchivo_ordenes_compra_servicio_servicio").show();
			         		   //Hacer llamado a la función  para cargar  los registros en el grid
				           	   paginacion_ordenes_compra_servicio_servicio();  
							}

							//Si la acción corresponde a un nuevo registro
		                    if(tipoAccion == 'Nuevo')
		                    {
		                    	//Si el tipo de mensaje es un éxito
				                if(data.tipo_mensaje == 'éxito')
				                {
					                //Hacer un llamado a la función para cerrar modal
					                cerrar_ordenes_compra_servicio_servicio();
					                //Hacer un llamado a la función para abrir modal de autorización
									abrir_autorizar_ordenes_compra_servicio_servicio($('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val(), $('#txtFolio_ordenes_compra_servicio_servicio').val(), 'Guardar');
				                }
				                else
				                {
				                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    			mensaje_ordenes_compra_servicio_servicio(data.tipo_mensaje, data.mensaje);
				                }
		                    }
		                    else
		                    {

		                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    		mensaje_ordenes_compra_servicio_servicio(data.tipo_mensaje, data.mensaje);
		                    }
		                }
	            	});
	            }
	        }
			
		}

		//Función para asignar los datos de un proveedor
		function get_datos_proveedor_ordenes_compra_servicio_servicio(ui)
		{
		 	//Asignar valores del registro seleccionado
             $('#txtProveedorID_ordenes_compra_servicio_servicio').val(ui.item.data);
             $('#txtDiasCredito_ordenes_compra_servicio_servicio').val(ui.item.dias_credito);
             $('#txtRegimenFiscalID_ordenes_compra_servicio_servicio').val(ui.item.regimen_fiscal_id);
             //Hacer un llamado a la función para calcular fecha de vencimiento
	       	  $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraServicioServicio);

       	     //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt(ui.item.regimen_fiscal_id) == intRegimenFiscalIDResicoOrdenesCompraServicioServicio)
       	     {
       	     	//Hacer un llamado a la función para cargar el porcentaje de retención ISR base
       			cargar_porcentaje_isr_base_ordenes_compra_servicio_servicio();
       	     }

       	     //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_ordenes_compra_servicio_servicio();

		}

		//Función para mostrar u ocultar div que contiene el campo de retención de ISR (proveedor)
		function mostrar_retencion_isr_ordenes_compra_servicio_servicio()
		{
			//Si el gasto tiene retención de ISR
            if(parseInt($('#txtRegimenFiscalID_ordenes_compra_servicio_servicio').val()) == intRegimenFiscalIDResicoOrdenesCompraServicioServicio)
            {
            	//Quitar clase no-mostrar para mostrar div que contiene la retención de ISR (proveedor)
			  	$('#divRetencionIsr_ordenes_compra_servicio_servicio').removeClass("no-mostrar");
            }
            else
            {
            	//Agregar clase no-mostrar para ocultar div que contiene la retención de ISR (proveedor)
			    $('#divRetencionIsr_ordenes_compra_servicio_servicio').addClass("no-mostrar");
            }

		}
		


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos del porcentaje de IEPS
		function inicializar_porcentaje_ieps_detalles_ordenes_compra_servicio_servicio()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val('');
	        $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val('');
	        $('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val('');
	        $('#txtIepsUnitario_detalles_ordenes_compra_servicio_servicio').val('');
	        //Hacer un llamado a la función para mostrar u ocultar IEPS unitario
	        mostrar_ieps_unitario_detalles_ordenes_compra_servicio_servicio();
		}

		//Función para inicializar elementos del detalle
		function inicializar_detalle_ordenes_compra_servicio_servicio()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_detalles_ordenes_compra_servicio_servicio').val('');
			$('#txtConcepto_detalles_ordenes_compra_servicio_servicio').val('');
			$('#txtCantidad_detalles_ordenes_compra_servicio_servicio').val('');
		    $('#txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio').val('');
		    $('#txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio').val('0.00');
		    $('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').val('');
		    $('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').val('');
		    $('#txtTasaCuotaIva_detalles_ordenes_compra_servicio_servicio').val('');
		    $('#txtTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val('');
		    $('#txtIvaUnitario_detalles_ordenes_compra_servicio_servicio').val('');	

      		//Hacer un llamado a la función para inicializar elementos del porcentaje de IEPS
		    inicializar_porcentaje_ieps_detalles_ordenes_compra_servicio_servicio();
		}


		//Función para mostrar u ocultar div que contiene el campo de IEPS unitario
		function mostrar_ieps_unitario_detalles_ordenes_compra_servicio_servicio()
		{
			//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
            if($('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val() == 'RANGO' && 
               $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val() == 'Cuota')
            {
             	 //Quitar clase no-mostrar para mostrar div que contiene el IEPS unitario
			  	 $('#divIepsUnitario_detalles_ordenes_compra_servicio_servicio').removeClass("no-mostrar");

			  	 //Enfocar caja de texto
			  	 $('#txtIepsUnitario_detalles_ordenes_compra_servicio_servicio').focus();
            }
            else
            {
                //Agregar clase no-mostrar para ocultar div que contiene el IEPS unitario
			    $('#divIepsUnitario_detalles_ordenes_compra_servicio_servicio').addClass("no-mostrar");
            }
		}

		


		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_ordenes_compra_servicio_servicio()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla ordenes_compra_detalles)
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
			var strAgregar = 'SI';

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_detalles_ordenes_compra_servicio_servicio').val();
			//Asignar el texto del combobox
			var strConcepto = $('#txtConcepto_detalles_ordenes_compra_servicio_servicio').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio').val();
			var intCantidad = $('#txtCantidad_detalles_ordenes_compra_servicio_servicio').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_ordenes_compra_servicio_servicio').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').val();
			var strTipoTasaCuotaIeps = $('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val();
		    var strFactorTasaCuotaIeps = $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val();
			var intValorMinimoTasaCuotaIeps = $('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val();
			var intIepsUnitario = $('#txtIepsUnitario_detalles_ordenes_compra_servicio_servicio').val();
			var intIvaUnitario = $('#txtIvaUnitario_detalles_ordenes_compra_servicio_servicio').val();
			

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_servicio_servicio').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (strConcepto == '')
			{
				//Enfocar caja de texto
				$('#txtConcepto_detalles_ordenes_compra_servicio_servicio').focus();
			}
			else if (intCantidad == '')
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_ordenes_compra_servicio_servicio').focus();
			}
			else if (intPrecioUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio').focus();
			}
			else if (intPorcentajeIva == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').focus();
			}
			else if (intIvaUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtIvaUnitario_detalles_ordenes_compra_servicio_servicio').focus();
			}
			else if(intTasaCuotaIeps == '' && intPorcentajeIeps != '')
			{
				//Limpiar caja de texto
				$('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').focus();
			}
			else if(intPorcentajeIeps != '' && strTipoTasaCuotaIeps == 'RANGO' && 
				   strFactorTasaCuotaIeps == 'Cuota' && intIepsUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtIepsUnitario_detalles_ordenes_compra_servicio_servicio').focus();
			}
			else
			{

				//Crear instancia del objeto Detalle de la orden de compra
				objDetalleOrdenOrdenesCompraServicioServicio = 
								new DetalleOrdenOrdenesCompraServicioServicio('', '','',  '', '', '', '', '', 
															               	  '', '', '', '', 
															                  '', '', '', '');


				//Utilizar toUpperCase() para cambiar texto a mayúsculas
				strConcepto = strConcepto.toUpperCase();

				//Convertir cadena de texto a número decimal
				intPrecioUnitario = parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
				intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
				intSubtotal = intPrecioUnitario;
				intIvaUnitario = parseFloat($.reemplazar(intIvaUnitario, ",", ""));

				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					//Calcular descuento unitario
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;

					//Redondear cantidad a decimales
					intDescuentoUnitario = intDescuentoUnitario.toFixed(intNumDecimalesDescUnitBDOrdenesCompraServicioServicio);

					//Decrementar descuento unitario
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}

				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;
				//Redondear cantidad a decimales
				intSubtotal = intSubtotal.toFixed(intNumDecimalesPrecioUnitBDOrdenesCompraServicioServicio);
				intSubtotal = parseFloat(intSubtotal);

				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps != '')
				{	
					//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
					if(strTipoTasaCuotaIeps == 'RANGO' && strFactorTasaCuotaIeps == 'Cuota')
					{
						//Asignar NO para  evitar agregar el detalle
						strAgregar = 'NO';
						//Asignar importe de IEPS unitario
					    intIepsUnitario = parseFloat($.reemplazar(intIepsUnitario, ",", ""));

						//Verificar que el importe de IEPS se encuetre dentro del rango
                		if(intIepsUnitario >= intValorMinimoTasaCuotaIeps && intIepsUnitario <= intPorcentajeIeps)
                		{
                			//Asignar SI para agregar el detalle
							strAgregar = 'SI';
							//Calcular importe de IEPS
							intImporteIeps = parseFloat(intCantidad * intIepsUnitario);
                		}

					}
					else
					{
						//Calcular importe de IEPS
						intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
					}
					
					//Redondear cantidad a decimales
			   	 	intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDOrdenesCompraServicioServicio);
			   	 	intImporteIeps = parseFloat(intImporteIeps);
				}

				//Si se cumplen las reglas de validación
				if(strAgregar == 'SI')
				{
					//Hacer un llamado a la función para inicializar elementos del detalle
					inicializar_detalle_ordenes_compra_servicio_servicio();

					//Calcular importe de IVA
					intImporteIva = parseFloat(intCantidad * intIvaUnitario);

					//Redondear cantidad a  decimales
				    intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraServicioServicio);
				    intImporteIva = parseFloat(intImporteIva);

					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;
					

					//Cambiar cantidad a  formato moneda (a visualizar)
					intCantidad =  formatMoney(intCantidad, intNumDecimalesCantidadBDOrdenesCompraServicioServicio, '');
					intPrecioUnitario =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDOrdenesCompraServicioServicio, '');
					
					intDescuentoUnitario =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDOrdenesCompraServicioServicio, '');
					
					intSubtotal  =  formatMoney(intSubtotal, intNumDecimalesMostrarOrdenesCompraServicioServicio, '');
					
					intImporteIva  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDOrdenesCompraServicioServicio, '');
					
					intImporteIeps  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDOrdenesCompraServicioServicio, '');
					
					intTotal  =  formatMoney(intTotal, intNumDecimalesMostrarOrdenesCompraServicioServicio, '');
					
					intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, 
						intNumDecimalesDescUnitBDOrdenesCompraServicioServicio, '');

					intIepsUnitario =  formatMoney(intIepsUnitario, intNumDecimalesIepsUnitBDOrdenesCompraServicioServicio, '');

					intIvaUnitario =  formatMoney(intIvaUnitario, intNumDecimalesIvaUnitBDOrdenesCompraServicioServicio, '');

					//Asignar valores al objeto
					objDetalleOrdenOrdenesCompraServicioServicio.strConcepto = strConcepto;
					objDetalleOrdenOrdenesCompraServicioServicio.intCantidad = intCantidad;
					objDetalleOrdenOrdenesCompraServicioServicio.intPrecioUnitario = intPrecioUnitario;
					objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeDescuento = intPorcentajeDescuento;
					objDetalleOrdenOrdenesCompraServicioServicio.intDescuentoUnitario = intDescuentoUnitario;
					objDetalleOrdenOrdenesCompraServicioServicio.intTasaCuotaIva = intTasaCuotaIva;
					objDetalleOrdenOrdenesCompraServicioServicio.intImporteIva = intImporteIva;
					objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeIva = intPorcentajeIva;
					objDetalleOrdenOrdenesCompraServicioServicio.intIvaUnitario = intIvaUnitario;
					objDetalleOrdenOrdenesCompraServicioServicio.intTasaCuotaIeps = intTasaCuotaIeps;
					objDetalleOrdenOrdenesCompraServicioServicio.intImporteIeps = intImporteIeps;
					objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeIeps = intPorcentajeIeps;
					objDetalleOrdenOrdenesCompraServicioServicio.intIepsUnitario = intIepsUnitario;
					objDetalleOrdenOrdenesCompraServicioServicio.strTipoTasaCuotaIeps = strTipoTasaCuotaIeps;
					objDetalleOrdenOrdenesCompraServicioServicio.strFactorTasaCuotaIeps = strFactorTasaCuotaIeps;
					objDetalleOrdenOrdenesCompraServicioServicio.intValorMinimoTasaCuotaIeps = intValorMinimoTasaCuotaIeps;

					//Revisamos si existe el renglón, si es así, editamos los datos del detalle
					if (intRenglon)
					{
						///Modificar los datos del detalle corespondiente al indice
	        			objDetallesOrdenOrdenesCompraServicioServicio.modificarDetalle(intRenglon, objDetalleOrdenOrdenesCompraServicioServicio);

	        			//Incrementar renglón para obtener la posición del detalle en la tabla
						intRenglon++;

						//Seleccionar el renglón de la tabla para actualizar los datos del detalle
						var selectedRow = document.getElementById("dg_detalles_ordenes_compra_servicio_servicio").rows[intRenglon].cells;

						selectedRow[0].innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.strConcepto;
						selectedRow[1].innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intCantidad;
						selectedRow[2].innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intPrecioUnitario;
						selectedRow[3].innerHTML =  objDetalleOrdenOrdenesCompraServicioServicio.intDescuentoUnitario;
						selectedRow[4].innerHTML =  intSubtotal;
						selectedRow[5].innerHTML = intImporteIva;
						selectedRow[6].innerHTML = intImporteIeps;
						selectedRow[7].innerHTML = intTotal;
						selectedRow[9].innerHTML =  objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeDescuento;
						selectedRow[10].innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeIva;
						selectedRow[11].innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeIeps;
						selectedRow[12].innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intTasaCuotaIva;
						selectedRow[13].innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intTasaCuotaIeps;
						selectedRow[14].innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intIepsUnitario;
						selectedRow[15].innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.strTipoTasaCuotaIeps;
						selectedRow[16].innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.strFactorTasaCuotaIeps;
						selectedRow[17].innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intValorMinimoTasaCuotaIeps;
						selectedRow[18].innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intIvaUnitario;

					}
					else
					{
						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						intRenglon = $("#dg_detalles_ordenes_compra_servicio_servicio tr").length - 4;
						//Incrementar 1 para el siguiente renglón
						intRenglon++;

					    //Agregar datos del detalle de la orden de compra
           				objDetallesOrdenOrdenesCompraServicioServicio.setDetalle(objDetalleOrdenOrdenesCompraServicioServicio);

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
						var objCeldaIepsUnitario = objRenglon.insertCell(14);
						var objCeldaTipoTasaCuotaIeps = objRenglon.insertCell(15);
						var objCeldaFactorTasaCuotaIeps = objRenglon.insertCell(16);
						var objCeldaValorMinimoTasaCuotaIeps = objRenglon.insertCell(17);
						var objCeldaIvaUnitario = objRenglon.insertCell(18);
						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', intRenglon);
						objCeldaConcepto.setAttribute('class', 'movil b1');
						objCeldaConcepto.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.strConcepto;
						objCeldaCantidad.setAttribute('class', 'movil b2');
						objCeldaCantidad.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intCantidad;
						objCeldaPrecioUnitario.setAttribute('class', 'movil b3');
						objCeldaPrecioUnitario.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intPrecioUnitario;
						objCeldaDescuentoUnitario.setAttribute('class', 'movil b4');
						objCeldaDescuentoUnitario.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intDescuentoUnitario;
						objCeldaSubtotal.setAttribute('class', 'movil b5');
						objCeldaSubtotal.innerHTML = intSubtotal;
						objCeldaIva.setAttribute('class', 'movil b6');
						objCeldaIva.innerHTML = intImporteIva;
						objCeldaIeps.setAttribute('class', 'movil b7');
						objCeldaIeps.innerHTML = intImporteIeps;
						objCeldaTotal.setAttribute('class', 'movil b8');
						objCeldaTotal.innerHTML = intTotal;
						objCeldaAcciones.setAttribute('class', 'td-center movil b9');
						objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalles_ordenes_compra_servicio_servicio(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_detalles_ordenes_compra_servicio_servicio(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
						objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeDescuento.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeDescuento; 
						objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeIva.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeIva; 
						objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeIeps.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeIeps;
						objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
						objCeldaTasaCuotaIva.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intTasaCuotaIva;
						objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
						objCeldaTasaCuotaIeps.innerHTML =  objDetalleOrdenOrdenesCompraServicioServicio.intTasaCuotaIeps;
						objCeldaIepsUnitario.setAttribute('class', 'no-mostrar');
						objCeldaIepsUnitario.innerHTML =  objDetalleOrdenOrdenesCompraServicioServicio.intIepsUnitario;
						objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
						objCeldaTipoTasaCuotaIeps.innerHTML =  objDetalleOrdenOrdenesCompraServicioServicio.strTipoTasaCuotaIeps;
						objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
						objCeldaFactorTasaCuotaIeps.innerHTML =  objDetalleOrdenOrdenesCompraServicioServicio.strFactorTasaCuotaIeps;
						objCeldaValorMinimoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
						objCeldaValorMinimoTasaCuotaIeps.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intValorMinimoTasaCuotaIeps;
						objCeldaIvaUnitario.setAttribute('class', 'no-mostrar');
						objCeldaIvaUnitario.innerHTML = objDetalleOrdenOrdenesCompraServicioServicio.intIvaUnitario;
						

					}

					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_detalles_ordenes_compra_servicio_servicio();

					//Enfocar caja de texto
					$('#txtConcepto_detalles_ordenes_compra_servicio_servicio').focus();
				}
				else
				{

					//Limpiar contenido de la caja de texto
                    $('#txtIepsUnitario_detalles_ordenes_compra_servicio_servicio').val('');
                    //Hacer un llamado a la función para mostrar mensaje de información
                    mensaje_ordenes_compra_servicio_servicio('informacion', 'El IEPS unitario no se encuentra dentro del rango: ' + intValorMinimoTasaCuotaIeps+ ' - '+intPorcentajeIeps);
				}
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_ordenes_compra_servicio_servicio tr").length - 2;
			$('#numElementos_detalles_ordenes_compra_servicio_servicio').html(intFilas);
			$('#txtNumDetalles_ordenes_compra_servicio_servicio').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_ordenes_compra_servicio_servicio(objRenglon)
		{
			 //Decrementar indice para obtener la posición del detalle en el arreglo
		    var intRenglon =  parseInt(objRenglon.parentNode.parentNode.rowIndex) - 1;

		    //Crear instancia del objeto Detalle de la orden de compra
        	objDetalleOrdenOrdenesCompraServicioServicio = new DetalleOrdenOrdenesCompraServicioServicio();

        	//Asignar datos del detalle corespondiente al indice
        	objDetalleOrdenOrdenesCompraServicioServicio = objDetallesOrdenOrdenesCompraServicioServicio.getDetalle(intRenglon);


			//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalles_ordenes_compra_servicio_servicio').val(intRenglon);
			$('#txtConcepto_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.strConcepto);
			$('#txtCantidad_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.intCantidad);
			$('#txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.intPrecioUnitario);
			$('#txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeDescuento);
			$('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeIva);
			$('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.intPorcentajeIeps);
			$('#txtTasaCuotaIva_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.intTasaCuotaIva);
			$('#txtTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.intTasaCuotaIeps);
			$('#txtIepsUnitario_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.intIepsUnitario);
			$('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.strTipoTasaCuotaIeps);
			$('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.strFactorTasaCuotaIeps);
			$('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.intValorMinimoTasaCuotaIeps);
			$('#txtIvaUnitario_detalles_ordenes_compra_servicio_servicio').val(objDetalleOrdenOrdenesCompraServicioServicio.intIvaUnitario);
			//Hacer un llamado a la función para mostrar u ocultar IEPS unitario
	        mostrar_ieps_unitario_detalles_ordenes_compra_servicio_servicio();
			//Enfocar caja de texto
			$('#txtConcepto_detalles_ordenes_compra_servicio_servicio').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_ordenes_compra_servicio_servicio(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;

			//Eliminar del objeto el detalle seleccionado
			objDetallesOrdenOrdenesCompraServicioServicio.eliminarDetalle(intRenglon - 1);
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_ordenes_compra_servicio_servicio").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_ordenes_compra_servicio_servicio();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_ordenes_compra_servicio_servicio tr").length - 2;
			$('#numElementos_detalles_ordenes_compra_servicio_servicio').html(intFilas);
			$('#txtNumDetalles_ordenes_compra_servicio_servicio').val(intFilas);

			//Enfocar caja de texto
			$('#txtConcepto_detalles_ordenes_compra_servicio_servicio').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_ordenes_compra_servicio_servicio()
		{
		
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_servicio_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Variable que se utiliza para asignar el acumulado anterior del subtotal (en caso de que existan cambios calcular retención de ISR (proveedor) de lo contrario conservar el importe de retención (puede darse el caso de que el usuario modifique dicho importe))
			var intAcumSubtotalAnterior = $('#acumSubtotal_detalles_ordenes_compra_servicio_servicio').html();

			//Variable que se utiliza para contar el número de registros
			var intContReg = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));

				//Incrementar contador por cada registro recorridp
				intContReg++;

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, intNumDecimalesCantidadBDOrdenesCompraServicioServicio, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, intNumDecimalesDescUnitBDOrdenesCompraServicioServicio, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarOrdenesCompraServicioServicio, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, intNumDecimalesMostrarOrdenesCompraServicioServicio, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, intNumDecimalesMostrarOrdenesCompraServicioServicio, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, intNumDecimalesMostrarOrdenesCompraServicioServicio, '');

			//Asignar los valores
			$('#acumCantidad_detalles_ordenes_compra_servicio_servicio').html(intAcumUnidades);
			$('#acumDescuento_detalles_ordenes_compra_servicio_servicio').html(intAcumDescuento);
			$('#acumSubtotal_detalles_ordenes_compra_servicio_servicio').html(intAcumSubtotal);
			$('#acumIva_detalles_ordenes_compra_servicio_servicio').html(intAcumIva);
			$('#acumIeps_detalles_ordenes_compra_servicio_servicio').html(intAcumIeps);
			$('#acumTotal_detalles_ordenes_compra_servicio_servicio').html(intAcumTotal);


			//Si no existe id de la orden de compra, significa que es un nuevo registro
			if($('#txtOrdencCompraServicioID_ordenes_compra_servicio_servicio').val() == '' && intContReg == 1)
			{
				//Asignar el contador para calcular el isr del único detalle
				intAcumSubtotalAnterior = intContReg;
			}


			//Si hubo cambios en el acumulado del subtotal
			if(intAcumSubtotalAnterior != intAcumSubtotal && intAcumSubtotalAnterior != '')
			{
				//Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_ordenes_compra_servicio_servicio();
			}
		}


		//Función que se utiliza para calcular la retención de ISR (proveedor)
		function calcular_isr_ordenes_compra_servicio_servicio()
		{
			 //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt($('#txtRegimenFiscalID_ordenes_compra_servicio_servicio').val()) == intRegimenFiscalIDResicoOrdenesCompraServicioServicio)
       	     {
       	     	//Variable que se utiliza para asignar el importe retenido
       	     	var intImporteRetenido = 0;
       	     	//Variable que se utiliza para asignar el acumulado del subtotal
				var intAcumSubtotal = 0;

       	     	//Hacer un llamado a la función para reemplazar '$' y  ','  por cadena vacia
				intAcumSubtotal =  $.reemplazar($('#acumSubtotal_detalles_ordenes_compra_servicio_servicio').html(), "$", "");
				intAcumSubtotal =  $.reemplazar(intAcumSubtotal, ",", "");

				//Si existe porcentaje de ISR (proveedor)
				if($('#txtPorcentajeIsr_ordenes_compra_servicio_servicio').val() != '' && intAcumSubtotal > 0 )
				{
					//Variable que se utiliza para asignar el porcentaje de retención ISR
					var intPorcentajeRetencionIsr = parseFloat($('#txtPorcentajeIsr_ordenes_compra_servicio_servicio').val());

					//Calcular retención de ISR 
					intImporteRetenido = parseFloat(intAcumSubtotal * intPorcentajeRetencionIsr);
					//Redondear cantidad a decimales
					intImporteRetenido = intImporteRetenido.toFixed(intNumDecimalesMostrarOrdenesCompraServicioServicio);
					intImporteRetenido = parseFloat(intImporteRetenido);
				}

				//Convertir cantidad a formato moneda
				intImporteRetenido = formatMoney(intImporteRetenido, intNumDecimalesMostrarOrdenesCompraServicioServicio, '');

				//Asignar importe retenido 
				$('#txtImporteRetenido_ordenes_compra_servicio_servicio').val(intImporteRetenido);

       	     }
		}


		//Función que se utiliza para calcular el IVA unitario
		function calcular_iva_unitario_detalles_ordenes_compra_servicio_servicio()
		{
			//Variable que se utiliza para asignar el precio unitario
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio').val();
			//Variable que se utiliza para asignar el porcentaje de IVA
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').val();
			//Variable que se utiliza para asignar el importe de IVA unitario
			var intIvaUnitario = 0;

			//Verificar que exista precio unitario
			if(intPrecioUnitario != '' && intPorcentajeIva != '')
			{
				//Convertir cadena de texto a número decimal
				intPrecioUnitario = parseFloat($.reemplazar(intPrecioUnitario, ",", ""));

				//Calcular importe de IVA unitario
				intIvaUnitario = parseFloat(intPrecioUnitario * intPorcentajeIva);

				//Redondear cantidad a dos decimales
			    intIvaUnitario = intIvaUnitario.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraServicioServicio);
				intIvaUnitario = parseFloat(intIvaUnitario);

				//Convertir cantidad a formato moneda
				intIvaUnitario =  formatMoney(intIvaUnitario, intNumDecimalesMostrarOrdenesCompraServicioServicio, '');

				//Asignar importe de IVA unitario 
				$('#txtIvaUnitario_detalles_ordenes_compra_servicio_servicio').val(intIvaUnitario);
			}
					
		}



		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Autorizar Orden de Compra
			*********************************************************************************************************************/
			//Modificar el mensaje cuando cambie la opción del combobox
	        $('#cmbEstatus_autorizar_ordenes_compra_servicio_servicio').change(function(e){   
	        	//Variables que se utilizan para el mensaje informativo
	        	var strEstatus = $('#cmbEstatus_autorizar_ordenes_compra_servicio_servicio').val();
	        	var strMensaje = '';
	        	var strFolio = $('#txtFolio_autorizar_ordenes_compra_servicio_servicio').val();
	        	
	        	//Si existe estatus seleccionado
	        	if(strEstatus != '')
	        	{
	        		strMensaje += 'Se ';
	        		
	        		//Dependiendo del estatus modificar mensaje
	              	if($('#cmbEstatus_autorizar_ordenes_compra_servicio_servicio').val() === 'AUTORIZADO')
	             	{
	             		strMensaje += 'autorizó ';
	             	}
	             	else
	             	{
	             		strMensaje += 'rechazó ';
	             	}

	             	//Agregar folio en el mensaje
	             	strMensaje += ' la orden de compra servicio '+strFolio;
	        	}
	           

             	//Asignar mensaje informativo
             	$('#txtMensaje_autorizar_ordenes_compra_servicio_servicio').val(strMensaje);
				
	        });

			/*******************************************************************************************************************
			Controles correspondientes al modal Ordenes de Compra
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_ordenes_compra_servicio_servicio').numeric();
			$('#txtTotalUnidades_ordenes_compra_servicio_servicio').numeric();
			$('#txtImporteTotal_ordenes_compra_servicio_servicio').numeric();
			$('#txtCantidad_detalles_ordenes_compra_servicio_servicio').numeric();
			$('#txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio').numeric();
			$('#txtIvaUnitario_detalles_ordenes_compra_servicio_servicio').numeric();
        	$('#txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio').numeric();
        	$('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').numeric();
        	$('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').numeric();
        	$('#txtIepsUnitario_detalles_ordenes_compra_servicio_servicio').numeric();
        	$('#txtPorcentajeIsr_ordenes_compra_servicio_servicio').numeric();
        	$('#txtImporteRetenido_ordenes_compra_servicio_servicio').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_ordenes_compra_servicio_servicio').blur(function(){
				$('.moneda_ordenes_compra_servicio_servicio').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarOrdenesCompraServicioServicio });
			});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_ordenes_compra_servicio_servicio').blur(function(){
                $('.tipo-cambio_ordenes_compra_servicio_servicio').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_ordenes_compra_servicio_servicio').blur(function(){
                $('.cantidad_ordenes_compra_servicio_servicio').formatCurrency({ roundToDecimalPlace: intNumDecimalesCantidadBDOrdenesCompraServicioServicio });
            });

             /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.precio_unitario_ordenes_compra_servicio_servicio').blur(function(){
                $('.precio_unitario_ordenes_compra_servicio_servicio').formatCurrency({ roundToDecimalPlace: intNumDecimalesPrecioUnitBDOrdenesCompraServicioServicio });
            });

             /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.descuento_ordenes_compra_servicio_servicio').blur(function(){
                $('.descuento_ordenes_compra_servicio_servicio').formatCurrency({ roundToDecimalPlace: intNumDecimalesDescUnitBDOrdenesCompraServicioServicio });
            });


			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_ordenes_compra_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaEntrega_ordenes_compra_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaVencimiento_ordenes_compra_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});

			//Calcular fecha de vencimiento cuando cambie la fecha
			$('#dteFecha_ordenes_compra_servicio_servicio').on('dp.change', function (e) {
             	//Hacer un llamado a la función para calcular fecha de vencimiento
	       	    $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraServicioServicio);
             	//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_ordenes_compra_servicio_servicio();
			});


			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_ordenes_compra_servicio_servicio').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_ordenes_compra_servicio_servicio').val()) === intMonedaBaseIDOrdenesCompraServicioServicio)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_servicio_servicio").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_ordenes_compra_servicio_servicio').val(intTipoCambioMonedaBaseOrdenesCompraServicioServicio);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_ordenes_compra_servicio_servicio').formatCurrency({ roundToDecimalPlace: 4 });
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_servicio_servicio").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_ordenes_compra_servicio_servicio').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_ordenes_compra_servicio_servicio();
             	}
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_ordenes_compra_servicio_servicio').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_ordenes_compra_servicio_servicio').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoOrdenesCompraServicioServicio)
	        	{
	        		$('#txtTipoCambio_ordenes_compra_servicio_servicio').val(intTipoCambioMaximoOrdenesCompraServicioServicio);
	        	}

		    });


	        //Calcular fecha de vencimiento cuando cambie la opción del combobox
	        $('#cmbCondicionesPago_ordenes_compra_servicio_servicio').change(function(e){   
	             //Hacer un llamado a la función para calcular fecha de vencimiento
	       	     $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraServicioServicio);
	        });


	        //Autocomplete para recuperar los datos de una orden de reparación interna 
	        $('#txtOrdenReparacion_ordenes_compra_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtOrdenReparacionID_ordenes_compra_servicio_servicio').val('');
	               $('#txtProspecto_ordenes_compra_servicio_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/ordenes_reparacion/autocomplete",
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
	              //Asignar valores del registro seleccionado
	              $('#txtOrdenReparacionID_ordenes_compra_servicio_servicio').val(ui.item.data);
	              $('#txtProspecto_ordenes_compra_servicio_servicio').val(ui.item.prospecto);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la orden de reparación interna cuando pierda el enfoque la caja de texto
	        $('#txtOrdenReparacion_ordenes_compra_servicio_servicio').focusout(function(e){
	            //Si no existe id de la orden de reparación interna
	            if($('#txtOrdenReparacionID_ordenes_compra_servicio_servicio').val() == '' ||
	               $('#txtOrdenReparacion_ordenes_compra_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtOrdenReparacionID_ordenes_compra_servicio_servicio').val('');
	               $('#txtOrdenReparacion_ordenes_compra_servicio_servicio').val('');
	               $('#txtProspecto_ordenes_compra_servicio_servicio').val('');
	            }

	        });


			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedor_ordenes_compra_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorID_ordenes_compra_servicio_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_ordenes_compra_servicio_servicio();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/proveedores/autocomplete",
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
	             //Hacer un llamado a la función para asignar los datos del proveedor 
	       	     get_datos_proveedor_ordenes_compra_servicio_servicio(ui);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del proveedor cuando pierda el enfoque la caja de texto
	        $('#txtProveedor_ordenes_compra_servicio_servicio').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_ordenes_compra_servicio_servicio').val() == '' ||
	               $('#txtProveedor_ordenes_compra_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorID_ordenes_compra_servicio_servicio').val('');
	               $('#txtProveedor_ordenes_compra_servicio_servicio').val('');
	              //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_ordenes_compra_servicio_servicio();
	            }

	        });


	          //Autocomplete para recuperar los datos de un porcentaje de retención ISR 
	        $('#txtPorcentajeIsr_ordenes_compra_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtPorcentajeRetencionID_ordenes_compra_servicio_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/porcentaje_retencion_isr/autocomplete",
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
	             $('#txtPorcentajeRetencionID_ordenes_compra_servicio_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del porcentaje de retención ISR cuando pierda el enfoque la caja de texto
	        $('#txtPorcentajeIsr_ordenes_compra_servicio_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtPorcentajeRetencionID_ordenes_compra_servicio_servicio').val() == '' ||
	               $('#txtPorcentajeIsr_ordenes_compra_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtPorcentajeRetencionID_ordenes_compra_servicio_servicio').val('');
	               $('#txtPorcentajeIsr_ordenes_compra_servicio_servicio').val('');
	            }

	           //Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_ordenes_compra_servicio_servicio();
	            
	        });

	        //Autocomplete para recuperar los datos de un empleado 
	        $('#txtSolicita_ordenes_compra_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSolicitaID_ordenes_compra_servicio_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/empleados/autocomplete",
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
	             $('#txtSolicitaID_ordenes_compra_servicio_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del empleado cuando pierda el enfoque la caja de texto
	        $('#txtSolicita_ordenes_compra_servicio_servicio').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtSolicitaID_ordenes_compra_servicio_servicio').val() == '' ||
	               $('#txtSolicita_ordenes_compra_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSolicitaID_ordenes_compra_servicio_servicio').val('');
	               $('#txtSolicita_ordenes_compra_servicio_servicio').val('');
	            }

	        });


	        //Deshabilitar tecla enter en formularios (para evitar abrir un modal cuando se pulse la tecla enter )
	        $("form").keypress(function(e) {
		        if (e.which == 13) {
		            return false;
		        }
		    });


	        //Función para mover renglones arriba y abajo en la tabla
	        $('#dg_detalles_ordenes_compra_servicio_servicio').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Verifica que no sea el último elemento del grid
	            	if( row.next().index() != -1 )
	            	{ 
	            		objDetallesOrdenOrdenesCompraServicioServicio.swap(row.index(), row.next().index() );
	            	}	

	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Verifica que no sea el primer elemento del grid
	            	if( row.prev().index() != -1 )
	            	{ 
	            		objDetallesOrdenOrdenesCompraServicioServicio.swap(row.prev().index(), row.index() );
	            	}
	            	//Pasar al renglón de arriba
	            	row.prev().before(row);
	            }
				
	        });


	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_detalles_ordenes_compra_servicio_servicio').val('');
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
	             $('#txtTasaCuotaIva_detalles_ordenes_compra_servicio_servicio').val(ui.item.data);
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
	        $('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_detalles_ordenes_compra_servicio_servicio').val() == '' ||
	               $('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_detalles_ordenes_compra_servicio_servicio').val('');
	               $('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').val('');
	            }

	            //Hacer un llamado a la función para calcular el importe de IVA unitario
				calcular_iva_unitario_detalles_ordenes_compra_servicio_servicio();
	            
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val('');
	               //Hacer un llamado a la función para inicializar elementos del porcentaje de IEPS
	               inicializar_porcentaje_ieps_detalles_ordenes_compra_servicio_servicio();
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
	             $('#txtTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val(ui.item.data);
	             $('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val(ui.item.tipo);
	             $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val(ui.item.factor);
	             $('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val(ui.item.valor_minimo);
	             //Hacer un llamado a la función para mostrar u ocultar IEPS unitario
	              mostrar_ieps_unitario_detalles_ordenes_compra_servicio_servicio();

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
	        $('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val() == '' ||
	               $('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val('');
	               $('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').val('');
	              //Hacer un llamado a la función para inicializar elementos del porcentaje de IEPS
	               inicializar_porcentaje_ieps_detalles_ordenes_compra_servicio_servicio();
	            }
	            
	        });


	        //Calcular el importe de IVA unitario  cuando pierda el enfoque la caja de texto
	        $('#txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio').focusout(function(e){

	            //Hacer un llamado a la función para calcular el importe de IVA unitario
				calcular_iva_unitario_detalles_ordenes_compra_servicio_servicio();
	        });

	        //Validar que exista concepto cuando se pulse la tecla enter 
			$('#txtConcepto_detalles_ordenes_compra_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe concepto
		           if($('#txtConcepto_detalles_ordenes_compra_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtConcepto_detalles_ordenes_compra_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_ordenes_compra_servicio_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_ordenes_compra_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_ordenes_compra_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_ordenes_compra_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio').focus();
			   	    }
		        }
		    });


			//Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPrecioUnitario_detalles_ordenes_compra_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_ordenes_compra_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje de IVA
		            if( $('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_ordenes_compra_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtIvaUnitario_detalles_ordenes_compra_servicio_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista IVA unitario cuando se pulse la tecla enter 
			$('#txtIvaUnitario_detalles_ordenes_compra_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe IVA unitario 
		            if( $('#txtIvaUnitario_detalles_ordenes_compra_servicio_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtIvaUnitario_detalles_ordenes_compra_servicio_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val() == '' && 
		         	   $('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').val() != '')
		         	{
		         	
		         		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_detalles_ordenes_compra_servicio_servicio').focus();
		         	}
		         	else
		         	{
		         		 //Si la tasa de cuota es de tipo RANGO y su factor es Cuota
			            if($('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val() == 'RANGO' && 
			               $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_servicio_servicio').val() == 'Cuota')
			            {
			            	//Enfocar caja de texto
					    	$('#txtIepsUnitario_detalles_ordenes_compra_servicio_servicio').focus();
		   	    		}
		   	    		else
		   	    		{
		   	    			//Hacer un llamado a la función para agregar renglón a la tabla
		   	    			agregar_renglon_detalles_ordenes_compra_servicio_servicio();	
		   	    			
		   	    			
		   	    		}

		         	}
		        }
		    });

		    //Validar que exista IEPS unitario cuando se pulse la tecla enter 
			$('#txtIepsUnitario_detalles_ordenes_compra_servicio_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtIepsUnitario_detalles_ordenes_compra_servicio_servicio').val() == '')
		         	{
		         		//Enfocar caja de texto
					    $('#txtIepsUnitario_detalles_ordenes_compra_servicio_servicio').focus();
		         	}
		         	else
		         	{
		         		
		         		//Hacer un llamado a la función para agregar renglón a la tabla
		   	    		agregar_renglon_detalles_ordenes_compra_servicio_servicio();
		         	
		         	}
		        }
		    });

		

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_ordenes_compra_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_ordenes_compra_servicio_servicio').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_ordenes_compra_servicio_servicio').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_ordenes_compra_servicio_servicio').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_ordenes_compra_servicio_servicio').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_ordenes_compra_servicio_servicio').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedorBusq_ordenes_compra_servicio_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorIDBusq_ordenes_compra_servicio_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "cuentas_pagar/proveedores/autocomplete",
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
	             $('#txtProveedorIDBusq_ordenes_compra_servicio_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del proveedor cuando pierda el enfoque la caja de texto
	        $('#txtProveedorBusq_ordenes_compra_servicio_servicio').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorIDBusq_ordenes_compra_servicio_servicio').val() == '' ||
	               $('#txtProveedorBusq_ordenes_compra_servicio_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorIDBusq_ordenes_compra_servicio_servicio').val('');
	               $('#txtProveedorBusq_ordenes_compra_servicio_servicio').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_ordenes_compra_servicio_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaOrdenesCompraServicioServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_ordenes_compra_servicio_servicio();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_ordenes_compra_servicio_servicio').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_ordenes_compra_servicio_servicio();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_ordenes_compra_servicio_servicio').addClass("estatus-NUEVO");
				//Abrir modal
				 objOrdenesCompraServicioServicio = $('#OrdenesCompraServicioServicioBox').bPopup({
												   appendTo: '#OrdenesCompraServicioServicioContent', 
					                               contentContainer: 'OrdenesCompraServicioServicioM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_ordenes_compra_servicio_servicio').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_ordenes_compra_servicio_servicio').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_ordenes_compra_servicio_servicio();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_ordenes_compra_servicio_servicio();

		});
	</script>