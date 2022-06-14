	<div id="OrdenesCompraRefaccionesRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_ordenes_compra_refacciones_refacciones" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_ordenes_compra_refacciones_refacciones" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_ordenes_compra_refacciones_refacciones">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_ordenes_compra_refacciones_refacciones'>
				                    <input class="form-control" id="txtFechaInicialBusq_ordenes_compra_refacciones_refacciones"
				                    		name= "strFechaInicialBusq_ordenes_compra_refacciones_refacciones" 
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
								<label for="txtFechaFinalBusq_ordenes_compra_refacciones_refacciones">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_ordenes_compra_refacciones_refacciones'>
				                    <input class="form-control" id="txtFechaFinalBusq_ordenes_compra_refacciones_refacciones"
				                    		name= "strFechaFinalBusq_ordenes_compra_refacciones_refacciones" 
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
								<input id="txtProveedorIDBusq_ordenes_compra_refacciones_refacciones" 
									   name="intProveedorIDBusq_ordenes_compra_refacciones_refacciones"  type="hidden" 
									   value="">
								</input>
								<label for="txtProveedorBusq_ordenes_compra_refacciones_refacciones">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProveedorBusq_ordenes_compra_refacciones_refacciones" 
										name="strProveedorBusq_ordenes_compra_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_ordenes_compra_refacciones_refacciones">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_ordenes_compra_refacciones_refacciones" 
								 		name="strEstatusBusq_ordenes_compra_refacciones_refacciones" tabindex="1">
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
								<label for="txtBusqueda_ordenes_compra_refacciones_refacciones">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_ordenes_compra_refacciones_refacciones" 
										name="strBusqueda_ordenes_compra_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_ordenes_compra_refacciones_refacciones" 
									   name="strImprimirDetalles_ordenes_compra_refacciones_refacciones" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_ordenes_compra_refacciones_refacciones"
									onclick="paginacion_ordenes_compra_refacciones_refacciones();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_ordenes_compra_refacciones_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_ordenes_compra_refacciones_refacciones"
									onclick="reporte_ordenes_compra_refacciones_refacciones('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_ordenes_compra_refacciones_refacciones"
									onclick="reporte_ordenes_compra_refacciones_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles de la orden de compra
				*/
				td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Desc."; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Total"; font-weight: bold;}
				td.movil.b10:nth-of-type(10):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles de la orden de compra
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
				<table class="table-hover movil" id="dg_ordenes_compra_refacciones_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Proveedor</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:20em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_ordenes_compra_refacciones_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{proveedor}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_ordenes_compra_refacciones_refacciones({{orden_compra_refacciones_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_ordenes_compra_refacciones_refacciones({{orden_compra_refacciones_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!---Autorizar o rechazar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionAutorizar}}"  
										onclick="abrir_autorizar_ordenes_compra_refacciones_refacciones({{orden_compra_refacciones_id}},'{{folio}}', 'Autorizar');"  title="Autorizar o Rechazar">
									<span class="fa fa-check-square-o"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_proveedor_ordenes_compra_refacciones_refacciones({{orden_compra_refacciones_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_ordenes_compra_refacciones_refacciones({{orden_compra_refacciones_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
							    <!--Subir archivos-->
								<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
									<span class="btn  btn-default btn-xs fileinput-button ">
								    	<span class="fa fa-upload"></span>
										<input name="archivo_varios_ordenes_compra_refacciones_refacciones{{orden_compra_refacciones_id}}[]" id="archivo_varios_ordenes_compra_refacciones_refacciones{{orden_compra_refacciones_id}}"  type="file" multiple accept="text/xml,application/pdf" 
											   onchange="subir_archivos_grid_ordenes_compra_refacciones_refacciones({{orden_compra_refacciones_id}});">
								  		</input>
								    </span>
								</span>
                            	<!--Descargar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_ordenes_compra_refacciones_refacciones({{orden_compra_refacciones_id}}, '{{folio}}');" title="Descargar archivo">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
                            	<!--Eliminar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}" 
                            			 onmousedown="eliminar_archivos_ordenes_compra_refacciones_refacciones({{orden_compra_refacciones_id}});" title="Eliminar archivo">
                            		<span class="glyphicon glyphicon-export"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_ordenes_compra_refacciones_refacciones({{orden_compra_refacciones_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_ordenes_compra_refacciones_refacciones({{orden_compra_refacciones_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ordenes_compra_refacciones_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_ordenes_compra_refacciones_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Autorizar Orden de Compra-->
		<div id="AutorizarOrdenesCompraRefaccionesRefaccionesBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_autorizar_ordenes_compra_refacciones_refacciones" class="ModalBodyTitle confirmacion-modal-title"">
			<h1 id="tituloModal_autorizar_ordenes_compra_refacciones_refacciones"></h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAutorizarOrdenesCompraRefaccionesRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmAutorizarOrdenesCompraRefaccionesRefacciones"  onsubmit="return(false)" autocomplete="off">
			    	<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReferenciaID_autorizar_ordenes_compra_refacciones_refacciones" 
										   name="intReferenciaID_autorizar_ordenes_compra_refacciones_refacciones" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el tipo de acción (guardar o autorizar) a realizar --> 
									<input type="hidden" id="txtTipoAccion_autorizar_ordenes_compra_refacciones_refacciones" 
										   name="strTipoAccion_autorizar_ordenes_compra_refacciones_refacciones" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el folio del registro seleccionado--> 
									<input type="hidden" id="txtFolio_autorizar_ordenes_compra_refacciones_refacciones" 
										   name="strFolio_autorizar_ordenes_compra_refacciones_refacciones" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Ordenes de Compra-->
									<input id="txtModalOrdenesCompraRefacciones_autorizar_ordenes_compra_refacciones_refacciones" 
										   name="strModalOrdenesCompraRefacciones_autorizar_ordenes_compra_refacciones_refacciones" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para asignar a los usuarios que se les enviará 
									     el mensaje--> 
									<input type="hidden" id="txtUsuarios_autorizar_ordenes_compra_refacciones_refacciones" 
										   name="strUsuarios_autorizar_ordenes_compra_refacciones_refacciones" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Enviar notificación a:</h4>
										</div>
										<div class="panel-body">
											<div id="treeUsuarios_autorizar_ordenes_compra_refacciones_refacciones" class="md-list-item-text"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="divEstatus_autorizar_ordenes_compra_refacciones_refacciones" class="row no-mostrar">
						<!--Estatus-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbEstatus_autorizar_ordenes_compra_refacciones_refacciones">Estatus</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbEstatus_autorizar_ordenes_compra_refacciones_refacciones" 
									 		name="strEstatus_autorizar_ordenes_compra_refacciones_refacciones" tabindex="1">
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
									<label for="txtMensaje_autorizar_ordenes_compra_refacciones_refacciones">Mensaje</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtMensaje_autorizar_ordenes_compra_refacciones_refacciones" 
											   name="strMensaje_autorizar_ordenes_compra_refacciones_refacciones" rows="5" value="" tabindex="1" placeholder="Ingrese mensaje" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Autorizar o rechazar registro-->
							<button class="btn btn-success" id="btnGuardar_autorizar_ordenes_compra_refacciones_refacciones"  
									onclick="validar_autorizar_ordenes_compra_refacciones_refacciones();"  title="Enviar" tabindex="1">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_autorizar_ordenes_compra_refacciones_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_autorizar_ordenes_compra_refacciones_refacciones();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Autorizar Orden de Compra-->

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarOrdenesCompraRefaccionesRefaccionesBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_proveedor_ordenes_compra_refacciones_refacciones" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarOrdenesCompraRefaccionesRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarOrdenesCompraRefaccionesRefacciones"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Proveedor-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtOrdenCompraRefaccionesID_proveedor_ordenes_compra_refacciones_refacciones" 
										   name="intOrdenCompraRefaccionesID_proveedor_ordenes_compra_refacciones_refacciones" 
										   type="hidden" value="">
									</input>
									<label for="txtProveedor_proveedor_ordenes_compra_refacciones_refacciones">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_proveedor_ordenes_compra_refacciones_refacciones" 
											name="strProveedor_proveedor_ordenes_compra_refacciones_refacciones" type="text" value="" 
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
									<label for="txtCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones" 
											name="strCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones" 
											name="strCopiaCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_proveedor_ordenes_compra_refacciones_refacciones" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_proveedor_ordenes_compra_refacciones_refacciones"  
									onclick="validar_proveedor_ordenes_compra_refacciones_refacciones();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_proveedor_ordenes_compra_refacciones_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_proveedor_ordenes_compra_refacciones_refacciones();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal Ordenes de Compra-->
		<div id="OrdenesCompraRefaccionesRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_ordenes_compra_refacciones_refacciones"  class="ModalBodyTitle">
			<h1>Ordenes de Compra</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmOrdenesCompraRefaccionesRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmOrdenesCompraRefaccionesRefacciones"  onsubmit="return(false)" 
					  autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones" 
										   name="intOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones" type="hidden" value="">
									</input>
									<label for="txtFolio_ordenes_compra_refacciones_refacciones">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_ordenes_compra_refacciones_refacciones" 
											name="strFolio_ordenes_compra_refacciones_refacciones" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_ordenes_compra_refacciones_refacciones">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_ordenes_compra_refacciones_refacciones'>
					                    <input class="form-control" id="txtFecha_ordenes_compra_refacciones_refacciones"
					                    		name= "strFecha_ordenes_compra_refacciones_refacciones" 
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
									<label for="cmbMonedaID_ordenes_compra_refacciones_refacciones">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_ordenes_compra_refacciones_refacciones" 
									 		name="intMonedaID_ordenes_compra_refacciones_refacciones" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_ordenes_compra_refacciones_refacciones">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_ordenes_compra_refacciones_refacciones" id="txtTipoCambio_ordenes_compra_refacciones_refacciones" 
											name="intTipoCambio_ordenes_compra_refacciones_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11">
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
									<input id="txtProveedorID_ordenes_compra_refacciones_refacciones" 
										   name="intProveedorID_ordenes_compra_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del régimen fiscal-->
									<input id="txtRegimenFiscalID_ordenes_compra_refacciones_refacciones" 
										   name="intRegimenFiscalID_ordenes_compra_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar los días de crédito del proveedor seleccionado-->
									<input id="txtDiasCredito_ordenes_compra_refacciones_refacciones" 
										   name="intDiasCredito_ordenes_compra_refacciones_refacciones"  type="hidden" 
										   value="">
									</input>
									<label for="txtProveedor_ordenes_compra_refacciones_refacciones">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_ordenes_compra_refacciones_refacciones" 
											name="strProveedor_ordenes_compra_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    	<!--Condiciones de pago-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCondicionesPago_ordenes_compra_refacciones_refacciones">Condiciones de pago</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbCondicionesPago_ordenes_compra_refacciones_refacciones" 
									 		name="strCondicionesPago_ordenes_compra_refacciones_refacciones" tabindex="1">
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
									<label for="txtFechaVencimiento_ordenes_compra_refacciones_refacciones">Fecha de vencimiento</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaVencimiento_ordenes_compra_refacciones_refacciones'>
					                    <input class="form-control" id="txtFechaVencimiento_ordenes_compra_refacciones_refacciones"
					                    		name= "strFechaVencimiento_ordenes_compra_refacciones_refacciones" 
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
									<label for="txtFechaEntrega_ordenes_compra_refacciones_refacciones">Fecha de entrega</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaEntrega_ordenes_compra_refacciones_refacciones'>
					                    <input class="form-control" id="txtFechaEntrega_ordenes_compra_refacciones_refacciones"
					                    		name= "strFechaEntrega_ordenes_compra_refacciones_refacciones" 
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
									<label for="txtFactura_ordenes_compra_refacciones_refacciones">Factura</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFactura_ordenes_compra_refacciones_refacciones" 
											name="strFactura_ordenes_compra_refacciones_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese factura" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Total de unidades-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTotalUnidades_ordenes_compra_refacciones_refacciones">Total de unidades</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control cantidad_ordenes_compra_refacciones_refacciones" id="txtTotalUnidades_ordenes_compra_refacciones_refacciones" 
											name="intTotalUnidades_ordenes_compra_refacciones_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese total de unidades" maxlength="14">
									</input>
								</div>
							</div>
						</div>
						<!--Total-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteTotal_ordenes_compra_refacciones_refacciones">Importe total</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_ordenes_compra_refacciones_refacciones" id="txtImporteTotal_ordenes_compra_refacciones_refacciones" 
												name="intImporteTotal_ordenes_compra_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23">
										</input>
										
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Observaciones-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_ordenes_compra_refacciones_refacciones">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_ordenes_compra_refacciones_refacciones" 
											name="strObservaciones_ordenes_compra_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
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
									<input id="txtNumDetalles_ordenes_compra_refacciones_refacciones" 
										   name="intNumDetalles_ordenes_compra_refacciones_refacciones" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la orden de compra</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene las refacciones activas-->
													<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id de la refacción seleccionada-->
																<input id="txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones" 
																	   name="intRefaccionID_detalles_ordenes_compra_refacciones_refacciones"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta que se utiliza para recuperar el código de la línea de la refacción seleccionada-->
																<input id="txtCodigoLinea_detalles_ordenes_compra_refacciones_refacciones" 
																	   name="strCodigoLinea_detalles_ordenes_compra_refacciones_refacciones"  
																	   type="hidden" value="">
															    </input>
																<label for="txtCodigo_detalles_ordenes_compra_refacciones_refacciones">
																	Código
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtCodigo_detalles_ordenes_compra_refacciones_refacciones" 
																		name="strCodigo_detalles_ordenes_compra_refacciones_refacciones" type="text" value="" 
																		tabindex="1" placeholder="Ingrese código" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Autocomplete que contiene las refacciones activas-->
													<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtDescripcion_detalles_ordenes_compra_refacciones_refacciones">
																	Descripción
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtDescripcion_detalles_ordenes_compra_refacciones_refacciones" 
																		name="strDescripcion_detalles_ordenes_compra_refacciones_refacciones" 
																		type="text" value="" tabindex="1" 
																		placeholder="Ingrese descripción" maxlength="250" />
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_ordenes_compra_refacciones_refacciones">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_ordenes_compra_refacciones_refacciones" 
																		id="txtCantidad_detalles_ordenes_compra_refacciones_refacciones" 
																		name="intCantidad_detalles_ordenes_compra_refacciones_refacciones" 
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
																<label for="txtPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones">Precio unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_ordenes_compra_refacciones_refacciones" id="txtPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones" 
																		name="intPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese precio unitario" maxlength="23">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_ordenes_compra_refacciones_refacciones" id="txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones" 
																		name="intPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones" type="text" value="0.00" 
																		tabindex="1" placeholder="Ingrese descuento" maxlength="15">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IVA-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota de la refacción seleccionada-->
																<input id="txtTasaCuotaIva_detalles_ordenes_compra_refacciones_refacciones" 
																	   name="intTasaCuotaIva_detalles_ordenes_compra_refacciones_refacciones" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIva_detalles_ordenes_compra_refacciones_refacciones">IVA %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIva_detalles_ordenes_compra_refacciones_refacciones" 
																		name="intPorcentajeIva_detalles_ordenes_compra_refacciones_refacciones" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IEPS-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota de la refacción seleccionada-->
																<input id="txtTasaCuotaIeps_detalles_ordenes_compra_refacciones_refacciones" 
																	   name="intTasaCuotaIeps_detalles_ordenes_compra_refacciones_refacciones" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIeps_detalles_ordenes_compra_refacciones_refacciones">IEPS %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIeps_detalles_ordenes_compra_refacciones_refacciones" 
																		name="intPorcentajeIeps_detalles_ordenes_compra_refacciones_refacciones" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_detalles_ordenes_compra_refacciones_refacciones"
					                                			onclick="agregar_renglon_detalles_ordenes_compra_refacciones_refacciones();" 
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
													<table class="table-hover movil" id="dg_detalles_ordenes_compra_refacciones_refacciones">
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
																<td class="movil t2">
																<td  class="movil t3">
																	<strong id="acumCantidad_detalles_ordenes_compra_refacciones_refacciones"></strong>
																</td>
																<td class="movil t4"></td>
																<td class="movil t5">
																	<strong id="acumDescuento_detalles_ordenes_compra_refacciones_refacciones"></strong>
																</td>
																<td class="movil t6">
																	<strong id="acumSubtotal_detalles_ordenes_compra_refacciones_refacciones"></strong>
																</td>
																<td class="movil t7">
																	<strong id="acumIva_detalles_ordenes_compra_refacciones_refacciones"></strong>
																</td>
																<td class="movil t8">
																	<strong  id="acumIeps_detalles_ordenes_compra_refacciones_refacciones"></strong>
																</td>
																<td class="movil t9">
																	<strong id="acumTotal_detalles_ordenes_compra_refacciones_refacciones"></strong>
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
																<strong id="numElementos_detalles_ordenes_compra_refacciones_refacciones">0</strong> encontrados
															</button>
														</div>
													</div>
												</div>
											</div><!--Fin de la tabla detalles--->
										</div>
									</div>
								</div>
							</div>
							<!--Retención de ISR (proveedor)-->
							<div id="divRetencionIsr_ordenes_compra_refacciones_refacciones"  class="col-sm-6 col-md-6 col-lg-6 col-xs-12 pull-right no-mostrar">
									<div class="form-group">
											<!--Porcentaje de ISR-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<input id="txtPorcentajeRetencionID_ordenes_compra_refacciones_refacciones" name="intPorcentajeRetencionID_ordenes_compra_refacciones_refacciones" type="hidden" value="">
														</input>
														<label for="txtPorcentajeIsr_ordenes_compra_refacciones_refacciones">Retención de ISR %</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control" id="txtPorcentajeIsr_ordenes_compra_refacciones_refacciones" 
																name="intPorcentajeIsr_ordenes_compra_refacciones_refacciones" type="text" value="" 
																tabindex="1" placeholder="Ingrese retención de ISR" maxlength="250">
														</input>
													</div>
												</div>
											</div>
											<!--Importe retenido-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<label for="txtImporteRetenido_ordenes_compra_refacciones_refacciones">Importe de ISR</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control moneda_ordenes_compra_refacciones_refacciones" id="txtImporteRetenido_ordenes_compra_refacciones_refacciones" 
																name="intImporteRetenido_ordenes_compra_refacciones_refacciones" type="text" value="" 
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
							<button class="btn btn-success" id="btnGuardar_ordenes_compra_refacciones_refacciones"  
									onclick="validar_ordenes_compra_refacciones_refacciones();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!---Autorizar o rechazar registro-->
							<button class="btn btn-default" id="btnAutorizar_ordenes_compra_refacciones_refacciones"  
									onclick="abrir_autorizar_ordenes_compra_refacciones_refacciones('','','Autorizar');"  title="Autorizar o Rechazar" tabindex="3" disabled>
								<span class="fa fa-check-square-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_ordenes_compra_refacciones_refacciones"  
									onclick="abrir_proveedor_ordenes_compra_refacciones_refacciones('');"  
									title="Enviar correo electrónico" tabindex="4" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_ordenes_compra_refacciones_refacciones"  
									onclick="reporte_registro_ordenes_compra_refacciones_refacciones('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
		                    <!--Subir varios archivos-->
		                    <span  class="fileupload-buttonbar" tabindex="6">
		                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_ordenes_compra_refacciones_refacciones" disabled>
		                        	<span class="fa fa-upload"></span>
		                        	<input id="archivo_varios_ordenes_compra_refacciones_refacciones" 
		                        		   name="archivo_varios_ordenes_compra_refacciones_refacciones[]" type="file" multiple 
		                        		   accept="text/xml,application/pdf" onchange="subir_archivos_modal_ordenes_compra_refacciones_refacciones('Editar');">
		                        	</input>
		                        </span>
		                    </span>
		                     <!--Descargar archivo-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_ordenes_compra_refacciones_refacciones"  
									onclick="descargar_archivos_ordenes_compra_refacciones_refacciones('','');"  title="Descargar archivo" tabindex="7" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Eliminar archivo-->
							<button class="btn btn-default" id="btnEliminarArchivo_ordenes_compra_refacciones_refacciones"  
									onclick="eliminar_archivos_ordenes_compra_refacciones_refacciones('')"  title="Eliminar archivo" tabindex="8" disabled>
								<span class="glyphicon glyphicon-export"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_ordenes_compra_refacciones_refacciones"  
									onclick="cambiar_estatus_ordenes_compra_refacciones_refacciones('','ACTIVO');"  title="Desactivar" tabindex="9" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_ordenes_compra_refacciones_refacciones"  
									onclick="cambiar_estatus_ordenes_compra_refacciones_refacciones('','INACTIVO');"  title="Restaurar" tabindex="10" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_ordenes_compra_refacciones_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_ordenes_compra_refacciones_refacciones();" 
									title="Cerrar"  tabindex="11">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Ordenes de Compra-->
	</div><!--#OrdenesCompraRefaccionesRefaccionesContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_ordenes_compra_refacciones_refacciones" type="text/template">
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
		var intPaginaOrdenesCompraRefaccionesRefacciones = 0;
		var strUltimaBusquedaOrdenesCompraRefaccionesRefacciones = "";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
		var intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones = <?php echo NUM_DECIMALES_MOSTRAR_REFACCIONES ?>;
		//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
		var intNumDecimalesPrecioUnitBDOrdenesCompraRefaccionesRefacciones = <?php echo NUM_DECIMALES_PRECIO_UNIT_OC_REFACCIONES ?>;
		var intNumDecimalesDescUnitBDOrdenesCompraRefaccionesRefacciones = <?php echo NUM_DECIMALES_DESCUENTO_UNIT_OC_REFACCIONES ?>;
		var intNumDecimalesIvaUnitBDOrdenesCompraRefaccionesRefacciones = <?php echo NUM_DECIMALES_IVA_UNIT_OC_REFACCIONES ?>;
		var intNumDecimalesIepsUnitBDOrdenesCompraRefaccionesRefacciones = <?php echo NUM_DECIMALES_IEPS_UNIT_OC_REFACCIONES ?>;

		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDOrdenesCompraRefaccionesRefacciones = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseOrdenesCompraRefaccionesRefacciones = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoOrdenesCompraRefaccionesRefacciones = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar el id del porcentaje de retención ISR base
		var intPorcentajeRetencionBaseIDOrdenesCompraRefaccionesRefacciones = <?php echo PORCENTAJE_ISR_BASE ?>;
		//Variable que se utiliza para asignar el id del régimen fiscal: Régimen Simplificado de Confianza
		var intRegimenFiscalIDResicoOrdenesCompraRefaccionesRefacciones = <?php echo REGIMEN_FISCAL_RESICO ?>;

		//Variable que se utiliza para asignar objeto del modal Autorizar Orden de Compra
		var objAutorizarOrdenesCompraRefaccionesRefacciones = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarOrdenesCompraRefaccionesRefacciones = null;
		//Variable que se utiliza para asignar objeto del modal
		var objOrdenesCompraRefaccionesRefacciones = null;

		//Array que contiene los id´s de las cajas de texto que se utilizan para calcular la fecha de vencimiento
		var arrFechaVencimientoOrdenesCompraRefaccionesRefacciones  = {fecha: '#txtFecha_ordenes_compra_refacciones_refacciones',
																	   condicionesPago: '#cmbCondicionesPago_ordenes_compra_refacciones_refacciones',
																	   diasCredito: '#txtDiasCredito_ordenes_compra_refacciones_refacciones',
																	   fechaVencimiento: '#txtFechaVencimiento_ordenes_compra_refacciones_refacciones'
																	  };

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_ordenes_compra_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/ordenes_compra_refacciones/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_ordenes_compra_refacciones_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosOrdenesCompraRefaccionesRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosOrdenesCompraRefaccionesRefacciones = strPermisosOrdenesCompraRefaccionesRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosOrdenesCompraRefaccionesRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosOrdenesCompraRefaccionesRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosOrdenesCompraRefaccionesRefacciones[i]=='GUARDAR') || (arrPermisosOrdenesCompraRefaccionesRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
						}
						//Si el indice es ADJUNTAR
						else if(arrPermisosOrdenesCompraRefaccionesRefacciones[i]=='ADJUNTAR')
						{
							//Habilitar el control (botón Adjuntar)
							$('#btnAdjuntar_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
							//Habilitar el control (botón eliminar archivo)
							$('#btnEliminarArchivo_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosOrdenesCompraRefaccionesRefacciones[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraRefaccionesRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_ordenes_compra_refacciones_refacciones();
						}
						else if(arrPermisosOrdenesCompraRefaccionesRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
							$('#btnRestaurar_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraRefaccionesRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraRefaccionesRefacciones[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraRefaccionesRefacciones[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraRefaccionesRefacciones[i]=='AUTORIZAR')//Si el indice es AUTORIZAR
						{
							//Habilitar el control (botón autorizar)
							$('#btnAutorizar_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraRefaccionesRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_ordenes_compra_refacciones_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_ordenes_compra_refacciones_refacciones() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaOrdenesCompraRefaccionesRefacciones =($('#txtFechaInicialBusq_ordenes_compra_refacciones_refacciones').val()+$('#txtFechaFinalBusq_ordenes_compra_refacciones_refacciones').val()+$('#txtProveedorIDBusq_ordenes_compra_refacciones_refacciones').val()+$('#cmbEstatusBusq_ordenes_compra_refacciones_refacciones').val()+$('#txtBusqueda_ordenes_compra_refacciones_refacciones').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaOrdenesCompraRefaccionesRefacciones != strUltimaBusquedaOrdenesCompraRefaccionesRefacciones)
			{
				intPaginaOrdenesCompraRefaccionesRefacciones = 0;
				strUltimaBusquedaOrdenesCompraRefaccionesRefacciones = strNuevaBusquedaOrdenesCompraRefaccionesRefacciones;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/ordenes_compra_refacciones/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_compra_refacciones_refacciones').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_compra_refacciones_refacciones').val()),
					 intProveedorID: $('#txtProveedorIDBusq_ordenes_compra_refacciones_refacciones').val(),
					 strEstatus: $('#cmbEstatusBusq_ordenes_compra_refacciones_refacciones').val(),
					 strBusqueda: $('#txtBusqueda_ordenes_compra_refacciones_refacciones').val(),
					 intPagina: intPaginaOrdenesCompraRefaccionesRefacciones,
					 strPermisosAcceso: $('#txtAcciones_ordenes_compra_refacciones_refacciones').val()
					},
					function(data){
						$('#dg_ordenes_compra_refacciones_refacciones tbody').empty();
						var tmpOrdenesCompraRefaccionesRefacciones = Mustache.render($('#plantilla_ordenes_compra_refacciones_refacciones').html(),data);
						$('#dg_ordenes_compra_refacciones_refacciones tbody').html(tmpOrdenesCompraRefaccionesRefacciones);
						$('#pagLinks_ordenes_compra_refacciones_refacciones').html(data.paginacion);
						$('#numElementos_ordenes_compra_refacciones_refacciones').html(data.total_rows);
						intPaginaOrdenesCompraRefaccionesRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_ordenes_compra_refacciones_refacciones(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/ordenes_compra_refacciones/';

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
			if ($('#chbImprimirDetalles_ordenes_compra_refacciones_refacciones').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_ordenes_compra_refacciones_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_ordenes_compra_refacciones_refacciones').val('NO');
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_compra_refacciones_refacciones').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_compra_refacciones_refacciones').val()),
										'intProveedorID': $('#txtProveedorIDBusq_ordenes_compra_refacciones_refacciones').val(),
										'strEstatus': $('#cmbEstatusBusq_ordenes_compra_refacciones_refacciones').val(), 
										'strBusqueda': $('#txtBusqueda_ordenes_compra_refacciones_refacciones').val(),
										'strDetalles': $('#chbImprimirDetalles_ordenes_compra_refacciones_refacciones').val()		
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_ordenes_compra_refacciones_refacciones(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'refacciones/ordenes_compra_refacciones/get_reporte_registro',
							'data' : {
										'intOrdenCompraRefaccionesID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		

		//Función para subir archivos de un registro desde el grid view
		function subir_archivos_grid_ordenes_compra_refacciones_refacciones(ordenCompraRefaccionesID)
		{
			//Crear instancia al objeto del formulario
	        var formData = new FormData($("#frmOrdenesCompraRefaccionesRefacciones")[0]);
			//Agregar campos al objeto del formulario
			formData.append("intOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones", ordenCompraRefaccionesID);
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDGridOrdenesCompraRefaccionesRefacciones  = "archivo_varios_ordenes_compra_refacciones_refacciones"+ordenCompraRefaccionesID;
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDGridOrdenesCompraRefaccionesRefacciones);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDGridOrdenesCompraRefaccionesRefacciones)[0].files;
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
					formData.append("archivo_varios_ordenes_compra_refacciones_refacciones[]", document.getElementById(strBotonArchivoIDGridOrdenesCompraRefaccionesRefacciones).files[intCont]);
				 	
				}
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Limpia ruta del archivo cargado
		        $('#'+strBotonArchivoIDGridOrdenesCompraRefaccionesRefacciones).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_ordenes_compra_refacciones_refacciones('error', strMensajeError);
	        }
	        else
	        {
	        	//Hacer un llamado al método del controlador para subir archivos del registro
	            $.ajax({
	                url: 'refacciones/ordenes_compra_refacciones/subir_archivos',
	                type: "POST",
	                data: formData,
	                contentType: false,
	                processData: false,
	                success: function(data)
	                {
	                    //Limpia ruta del archivo cargado
		         		$('#'+strBotonArchivoIDGridOrdenesCompraRefaccionesRefacciones).val('');
						//Subida finalizada.
						if (data.resultado)
						{
		         		   //Hacer llamado a la función  para cargar  los registros en el grid
			           	   paginacion_ordenes_compra_refacciones_refacciones();  
						}
                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    		mensaje_ordenes_compra_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
	                }
            	});

	        }

		}

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_ordenes_compra_refacciones_refacciones(ordenCompraRefaccionesID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intOrdenCompraRefaccionesID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(ordenCompraRefaccionesID == '')
			{
				intOrdenCompraRefaccionesID = $('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val();
				strFolio = $('#txtFolio_ordenes_compra_refacciones_refacciones').val();
			}
			else
			{
				intOrdenCompraRefaccionesID = ordenCompraRefaccionesID;
				strFolio = folio;
			}

			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'refacciones/ordenes_compra_refacciones/descargar_archivos',
							'data' : {
										'intOrdenCompraRefaccionesID': intOrdenCompraRefaccionesID,
										'strFolio': strFolio				
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);
		}

		//Función que se utiliza para eliminar los archivos del registro seleccionado
		function eliminar_archivos_ordenes_compra_refacciones_refacciones(id)
		{

			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;

			//Si no existe id, significa que se eliminara el archivo desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para eliminar carpeta que contiene los archivos del registro
			$.post('refacciones/ordenes_compra_refacciones/eliminar_carpeta_registro',
			     {intOrdenCompraRefaccionesID: intID
			     },
			     function(data) {
			       
			        if(data.resultado)
			        {
			         	//Hacer llamado a la función  para cargar  los registros en el grid
		          	    paginacion_ordenes_compra_refacciones_refacciones();
		          	    //Si el id del registro se obtuvo del modal
						if(id == '')
						{
							//Ocultar los siguientes botones
							$('#btnDescargarArchivo_ordenes_compra_refacciones_refacciones').hide();
							$('#btnEliminarArchivo_ordenes_compra_refacciones_refacciones').hide();    
						}
			        }
		        	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		       		mensaje_ordenes_compra_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
			       
			     },
			    'json');
		}


		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_ordenes_compra_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_ordenes_compra_refacciones_refacciones').empty();
					var temp = Mustache.render($('#monedas_ordenes_compra_refacciones_refacciones').html(), data);
					$('#cmbMonedaID_ordenes_compra_refacciones_refacciones').html(temp);
				},
				'json');
		}

		//Regresar el porcentaje de retención ISR base
		function cargar_porcentaje_isr_base_ordenes_compra_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/porcentaje_retencion_isr/get_datos',
			       {
			       		strBusqueda:intPorcentajeRetencionBaseIDOrdenesCompraRefaccionesRefacciones,
			       		strTipo: 'id'
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				            $('#txtPorcentajeRetencionID_ordenes_compra_refacciones_refacciones').val(data.row.porcentaje_retencion_id);
				            $('#txtPorcentajeIsr_ordenes_compra_refacciones_refacciones').val(data.row.porcentaje);
			       	    }
			       },
			       'json');
		}

		/*******************************************************************************************************************
		Funciones del modal Autorizar Orden de Compra
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_autorizar_ordenes_compra_refacciones_refacciones()
		{
			//Incializar formulario
			$('#frmAutorizarOrdenesCompraRefaccionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_ordenes_compra_refacciones_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmAutorizarOrdenesCompraRefaccionesRefacciones').find('input[type=hidden]').val('');
			//Agregar clase no-mostrar para ocultar div que contiene el estatus
			$('#divEstatus_autorizar_ordenes_compra_refacciones_refacciones').addClass("no-mostrar");
		    $('#divEncabezadoModal_autorizar_ordenes_compra_refacciones_refacciones').addClass("estatus-ACTIVO");
		}

		//Función que se utiliza para abrir el modal
		function abrir_autorizar_ordenes_compra_refacciones_refacciones(id, folio, tipoAccion)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_autorizar_ordenes_compra_refacciones_refacciones();
			
			//Variables que se utilizan para asignar los datos del registro
			var intReferenciaID = 0;
			var strFolio = '';

			//Si no existe id, significa que se aplicará autorización (o rechazo) desde el modal
			if(id == '')
			{
				intReferenciaID = $('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val();
				strFolio =  $('#txtFolio_ordenes_compra_refacciones_refacciones').val();
				$('#txtModalOrdenesCompraRefacciones_autorizar_ordenes_compra_refacciones_refacciones').val('SI');
			}
			else
			{
				intReferenciaID = id;
				strFolio = folio;
				$('#txtModalOrdenesCompraRefacciones_autorizar_ordenes_compra_refacciones_refacciones').val('NO');
			}

			//Asignar datos del registro seleccionado
			$('#txtReferenciaID_autorizar_ordenes_compra_refacciones_refacciones').val(intReferenciaID);
			$('#txtTipoAccion_autorizar_ordenes_compra_refacciones_refacciones').val(tipoAccion);
			$('#txtFolio_autorizar_ordenes_compra_refacciones_refacciones').val(strFolio);

			//Si el tipo de acción corresponde a Guardar
			if(tipoAccion == 'Guardar')
			{
				//Cambiar título del modal
				$('#tituloModal_autorizar_ordenes_compra_refacciones_refacciones').text('Notificar Orden de Compra');
				$('#txtMensaje_autorizar_ordenes_compra_refacciones_refacciones').val('Favor de autorizar la orden de compra refacciones '+ strFolio);
				//Cargar el treeview
				get_treeview_usuarios_autorizar_ordenes_compra_refacciones_refacciones('');
			}
			else
			{
				//Quitar clase no-mostrar para mostrar div que contiene el estatus
				$('#divEstatus_autorizar_ordenes_compra_refacciones_refacciones').removeClass("no-mostrar");
				//Cambiar título del modal
				$('#tituloModal_autorizar_ordenes_compra_refacciones_refacciones').text('Autorizar Orden de Compra');
				//Cargar el treeview
				get_treeview_usuarios_autorizar_ordenes_compra_refacciones_refacciones(intReferenciaID);
			}

			//Abrir modal
			objAutorizarOrdenesCompraRefaccionesRefacciones = $('#AutorizarOrdenesCompraRefaccionesRefaccionesBox').bPopup({
													   appendTo: '#OrdenesCompraRefaccionesRefaccionesContent', 
							                           contentContainer: 'OrdenesCompraRefaccionesRefaccionesM', 
							                           zIndex: 2, 
							                           modalClose: false, 
							                           modal: true, 
							                           follow: [true,false], 
							                           followEasing : "linear", 
							                           easing: "linear", 
							                           modalColor: ('#F0F0F0')});
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_autorizar_ordenes_compra_refacciones_refacciones()
		{
			try {
				//Cerrar modal
				objAutorizarOrdenesCompraRefaccionesRefacciones.close();
				//Eliminar datos del treeview
				$("#treeUsuarios_autorizar_ordenes_compra_refacciones_refacciones").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_compra_refacciones_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_autorizar_ordenes_compra_refacciones_refacciones()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosAutorizarOrdenesCompraRefaccionesRefacciones = [];

			//Recorremos el treeview
			$("#treeUsuarios_autorizar_ordenes_compra_refacciones_refacciones").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosAutorizarOrdenesCompraRefaccionesRefacciones.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtUsuarios_autorizar_ordenes_compra_refacciones_refacciones").val(arrSeleccionadosAutorizarOrdenesCompraRefaccionesRefacciones.join('|'));
			
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_ordenes_compra_refacciones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmAutorizarOrdenesCompraRefaccionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_autorizar_ordenes_compra_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba un mensaje'}
											}
										},
										strUsuarios_autorizar_ordenes_compra_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un usuario para este mensaje.'}
											}
										},
										strEstatus_autorizar_ordenes_compra_refacciones_refacciones: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista estatus seleccionado cuando el tipo de acción sea Autorizar
					                                    if($('#txtTipoAccion_autorizar_ordenes_compra_refacciones_refacciones').val() === 'Autorizar' && $('#cmbEstatus_autorizar_ordenes_compra_refacciones_refacciones').val() == '')
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
			var bootstrapValidator_autorizar_ordenes_compra_refacciones_refacciones = $('#frmAutorizarOrdenesCompraRefaccionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_autorizar_ordenes_compra_refacciones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_autorizar_ordenes_compra_refacciones_refacciones.isValid())
			{
				//Hacer un llamado a la función para guardar la solicitud de autorización
				guardar_autorizar_ordenes_compra_refacciones_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_autorizar_ordenes_compra_refacciones_refacciones()
		{
			try
			{
				$('#frmAutorizarOrdenesCompraRefaccionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar la autorización (o el rechazo) de un registro
		function guardar_autorizar_ordenes_compra_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para enviar la autorización (o el rechazo) de un registro 
			$.post('refacciones/ordenes_compra_refacciones/set_enviar_autorizacion',
			     {intOrdenCompraRefaccionesID: $('#txtReferenciaID_autorizar_ordenes_compra_refacciones_refacciones').val(),
			      strUsuarios: $('#txtUsuarios_autorizar_ordenes_compra_refacciones_refacciones').val(), 
			      strMensaje:  $('#txtMensaje_autorizar_ordenes_compra_refacciones_refacciones').val(),
			      strEstatus:  $('#cmbEstatus_autorizar_ordenes_compra_refacciones_refacciones').val(),
			      strTipoAccion:  $('#txtTipoAccion_autorizar_ordenes_compra_refacciones_refacciones').val()
			     },
			     function(data) {
			        if(data.resultado)
			        {
			          	//Hacer llamado a la función  para cargar  los registros en el grid
			          	paginacion_ordenes_compra_refacciones_refacciones();
			          	//Hacer un llamado a la función para cerrar modal
					  	cerrar_autorizar_ordenes_compra_refacciones_refacciones();

					  	//Si el id de la referencia (para la autorización) se recuperó del modal Ordenes de Compra 
					  	if($('#txtModalOrdenesCompraRefacciones_autorizar_ordenes_compra_refacciones_refacciones').val() == 'SI')
					  	{
					  		//Hacer un llamado a la función para cerrar modal Ordenes de Compra 
					 	 	cerrar_ordenes_compra_refacciones_refacciones();
					  	}   
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_ordenes_compra_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		/*Función que se utiliza para definir tree view de usuarios con acceso a la función Autorizar del proceso
		 *Ordenes de Compra (módulo Refacciones)*/
		function get_treeview_usuarios_autorizar_ordenes_compra_refacciones_refacciones(id)
		{
			$('#treeUsuarios_autorizar_ordenes_compra_refacciones_refacciones').fancytree({
				source: {
					url: "seguridad/usuarios/get_treeview/AUTORIZAR_ORDENES_COMPRA_REFACCIONES/ORDENES DE COMPRA REFACCIONES/"+id,
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
		function nuevo_proveedor_ordenes_compra_refacciones_refacciones()
		{
			//Incializar formulario
			$('#frmEnviarOrdenesCompraRefaccionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedor_ordenes_compra_refacciones_refacciones();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_proveedor_ordenes_compra_refacciones_refacciones');
		}

		//Función que se utiliza para abrir el modal
		function abrir_proveedor_ordenes_compra_refacciones_refacciones(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_proveedor_ordenes_compra_refacciones_refacciones();
			//Variables que se utilizan para asignar los datos del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/ordenes_compra_refacciones/get_datos',
			       {intOrdenCompraRefaccionesID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtOrdenCompraRefaccionesID_proveedor_ordenes_compra_refacciones_refacciones').val(data.row.orden_compra_refacciones_id);
							$('#txtProveedor_proveedor_ordenes_compra_refacciones_refacciones').val(data.row.proveedor);
							$('#txtCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_proveedor_ordenes_compra_refacciones_refacciones').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarOrdenesCompraRefaccionesRefacciones = $('#EnviarOrdenesCompraRefaccionesRefaccionesBox').bPopup({
																   appendTo: '#OrdenesCompraRefaccionesRefaccionesContent', 
										                           contentContainer: 'OrdenesCompraRefaccionesRefaccionesM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_proveedor_ordenes_compra_refacciones_refacciones()
		{
			try {
				//Cerrar modal
				objEnviarOrdenesCompraRefaccionesRefacciones.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		    	ocultar_circulo_carga_proveedor_ordenes_compra_refacciones_refacciones();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_proveedor_ordenes_compra_refacciones_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedor_ordenes_compra_refacciones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarOrdenesCompraRefaccionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones: {
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
			var bootstrapValidator_proveedor_ordenes_compra_refacciones_refacciones = $('#frmEnviarOrdenesCompraRefaccionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_proveedor_ordenes_compra_refacciones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_proveedor_ordenes_compra_refacciones_refacciones.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_proveedor_ordenes_compra_refacciones_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_proveedor_ordenes_compra_refacciones_refacciones()
		{
			try
			{
				$('#frmEnviarOrdenesCompraRefaccionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al proveedor
		function enviar_correo_proveedor_ordenes_compra_refacciones_refacciones()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_proveedor_ordenes_compra_refacciones_refacciones();
			//Hacer un llamado al método del controlador para enviar correo electrónico al proveedor
			$.post('refacciones/ordenes_compra_refacciones/enviar_correo_electronico_proveedor',
					{ 
						intOrdenCompraRefaccionesID: $('#txtOrdenCompraRefaccionesID_proveedor_ordenes_compra_refacciones_refacciones').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_proveedor_ordenes_compra_refacciones_refacciones').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_proveedor_ordenes_compra_refacciones_refacciones();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_proveedor_ordenes_compra_refacciones_refacciones();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_compra_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_proveedor_ordenes_compra_refacciones_refacciones()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_proveedor_ordenes_compra_refacciones_refacciones").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_proveedor_ordenes_compra_refacciones_refacciones()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_proveedor_ordenes_compra_refacciones_refacciones").addClass('no-mostrar');
		}

		/*******************************************************************************************************************
		Funciones del modal Ordenes de Compra
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_ordenes_compra_refacciones_refacciones()
		{
			//Incializar formulario
			$('#frmOrdenesCompraRefaccionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_compra_refacciones_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmOrdenesCompraRefaccionesRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_ordenes_compra_refacciones_refacciones');
			//Eliminar los datos de la tabla detalles de la orden de compra
		    $('#dg_detalles_ordenes_compra_refacciones_refacciones tbody').empty();
		    $('#acumCantidad_detalles_ordenes_compra_refacciones_refacciones').html('');
		    $('#acumDescuento_detalles_ordenes_compra_refacciones_refacciones').html('');
		    $('#acumSubtotal_detalles_ordenes_compra_refacciones_refacciones').html('');
		    $('#acumIva_detalles_ordenes_compra_refacciones_refacciones').html('');
		    $('#acumIeps_detalles_ordenes_compra_refacciones_refacciones').html('');
		    $('#acumTotal_detalles_ordenes_compra_refacciones_refacciones').html('');
			$('#numElementos_detalles_ordenes_compra_refacciones_refacciones').html(0);
			//Asignar NO para indicar que no se ha abierto el modal Autorizar Orden de Compra
			$('#txtModalOrdenesCompraRefacciones_autorizar_ordenes_compra_refacciones_refacciones').val('NO');

			//Habilitar todos los elementos del formulario
			$('#frmOrdenesCompraRefaccionesRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_ordenes_compra_refacciones_refacciones').val(fechaActual()); 
			$('#txtFechaVencimiento_ordenes_compra_refacciones_refacciones').val(fechaActual()); 
		    
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_ordenes_compra_refacciones_refacciones').attr("disabled", "disabled");
			$('#txtPorcentajeIva_detalles_ordenes_compra_refacciones_refacciones').attr("disabled", "disabled");
			$('#txtPorcentajeIeps_detalles_ordenes_compra_refacciones_refacciones').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_ordenes_compra_refacciones_refacciones").show();
			$("#btnAdjuntar_ordenes_compra_refacciones_refacciones").show();
			//Ocultar los siguientes botones
			$("#btnAutorizar_ordenes_compra_refacciones_refacciones").hide();
			$("#btnEnviarCorreo_ordenes_compra_refacciones_refacciones").hide();
			$("#btnImprimirRegistro_ordenes_compra_refacciones_refacciones").hide();
			$("#btnDescargarArchivo_ordenes_compra_refacciones_refacciones").hide();
			$("#btnEliminarArchivo_ordenes_compra_refacciones_refacciones").hide();
			$("#btnDesactivar_ordenes_compra_refacciones_refacciones").hide();
			$("#btnRestaurar_ordenes_compra_refacciones_refacciones").hide();

			//Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_ordenes_compra_refacciones_refacciones();
		}


		//Función para inicializar elementos del proveedor
		function inicializar_proveedor_ordenes_compra_refacciones_refacciones()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtDiasCredito_ordenes_compra_refacciones_refacciones').val('');
            $('#txtRegimenFiscalID_ordenes_compra_refacciones_refacciones').val('');
            $('#txtPorcentajeRetencionID_ordenes_compra_refacciones_refacciones').val('');
            $('#txtPorcentajeIsr_ordenes_compra_refacciones_refacciones').val('');
            $('#txtImporteRetenido_ordenes_compra_refacciones_refacciones').val('');

            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
	        mostrar_retencion_isr_ordenes_compra_refacciones_refacciones();
            
		}

		
		//Función que se utiliza para cerrar el modal
		function cerrar_ordenes_compra_refacciones_refacciones()
		{
			try {
				//Cerrar modal
				objOrdenesCompraRefaccionesRefacciones.close();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
			    cerrar_proveedor_ordenes_compra_refacciones_refacciones();
				//Si el id de la referencia (para la autorización) se recuperó del modal Ordenes de Compra 
				if($('#txtModalOrdenesCompraRefacciones_autorizar_ordenes_compra_refacciones_refacciones').val() == 'SI')
				{
					//Hacer un llamado a la función para cerrar modal Autorizar Orden de Compra
					cerrar_autorizar_ordenes_compra_refacciones_refacciones();
				}
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_compra_refacciones_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_ordenes_compra_refacciones_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_compra_refacciones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmOrdenesCompraRefaccionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_ordenes_compra_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaEntrega_ordenes_compra_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaVencimiento_ordenes_compra_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strCondicionesPago_ordenes_compra_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una condición de pago'}
											}
										},
										intMonedaID_ordenes_compra_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_ordenes_compra_refacciones_refacciones: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_ordenes_compra_refacciones_refacciones').val()) !== intMonedaBaseIDOrdenesCompraRefaccionesRefacciones)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoOrdenesCompraRefaccionesRefacciones)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoOrdenesCompraRefaccionesRefacciones
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strProveedor_ordenes_compra_refacciones_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtProveedorID_ordenes_compra_refacciones_refacciones').val() === '')
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
										intPorcentajeIsr_ordenes_compra_refacciones_refacciones: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el id del porcentaje de retención ISR
						                                    if(parseInt($('#txtRegimenFiscalID_ordenes_compra_refacciones_refacciones').val()) === intRegimenFiscalIDResicoOrdenesCompraRefaccionesRefacciones)
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
										intImporteRetenido_ordenes_compra_refacciones_refacciones: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el id del porcentaje de retención ISR
						                                    if(parseInt($('#txtRegimenFiscalID_ordenes_compra_refacciones_refacciones').val()) === intRegimenFiscalIDResicoOrdenesCompraRefaccionesRefacciones)
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
										intTotalUnidades_ordenes_compra_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba el total de unidades'}
											}
										},
										intImporteTotal_ordenes_compra_refacciones_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba el importe total'}
											}
										},
										intNumDetalles_ordenes_compra_refacciones_refacciones: {
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
										strCodigo_detalles_ordenes_compra_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strDescripcion_detalles_ordenes_compra_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_detalles_ordenes_compra_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_detalles_ordenes_compra_refacciones_refacciones: {
											excluded: true  //Ignorar (no valida el campo)
										},
										intPorcentajeIeps_detalles_ordenes_compra_refacciones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_ordenes_compra_refacciones_refacciones = $('#frmOrdenesCompraRefaccionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_ordenes_compra_refacciones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_ordenes_compra_refacciones_refacciones.isValid())
			{
				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesOrdenesCompraRefaccionesRefacciones = $.reemplazar($('#acumTotal_detalles_ordenes_compra_refacciones_refacciones').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesOrdenesCompraRefaccionesRefacciones = $.reemplazar(intAcumTotalDetallesOrdenesCompraRefaccionesRefacciones, ",", "");

				var intImporteTotalOrdenesCompraRefaccionesRefacciones = $.reemplazar($('#txtImporteTotal_ordenes_compra_refacciones_refacciones').val(), ",", "");
 
				//Verificar que el total de unidades sea igual a la cantidad de detalles
				if($('#acumCantidad_detalles_ordenes_compra_refacciones_refacciones').html() != $('#txtTotalUnidades_ordenes_compra_refacciones_refacciones').val())
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_ordenes_compra_refacciones_refacciones('error', 'El total de unidades no coincide con los detalles, favor de verificar.');
					
				}
				//Verificar que el importe total sea igual al total de detalles
				else if(intAcumTotalDetallesOrdenesCompraRefaccionesRefacciones != intImporteTotalOrdenesCompraRefaccionesRefacciones)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_ordenes_compra_refacciones_refacciones('error', 'El importe total no coincide con los detalles, favor de verificar.');
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_ordenes_compra_refacciones_refacciones();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_ordenes_compra_refacciones_refacciones()
		{
			try
			{
				$('#frmOrdenesCompraRefaccionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_ordenes_compra_refacciones_refacciones()
		{
			//Obtenemos un array con los datos del archivo
    		var arrArchivoOrdenesCompraRefaccionesRefacciones = $("#archivo_varios_ordenes_compra_refacciones_refacciones");

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_refacciones_refacciones').getElementsByTagName('tbody')[0];

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
			var intTipoCambioOrden = parseFloat($('#txtTipoCambio_ordenes_compra_refacciones_refacciones').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var intCantidad = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intPrecioUnitario = $.reemplazar(objRen.cells[16].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[17].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[18].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[19].innerHTML, ",", "");

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

				//Redondear cantidad a decimales
				intIvaUnitario = intIvaUnitario.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraRefaccionesRefacciones);
				intIvaUnitario = parseFloat(intIvaUnitario);
				
				//Redondear cantidad a decimales
				intIepsUnitario = intIepsUnitario.toFixed(intNumDecimalesIepsUnitBDOrdenesCompraRefaccionesRefacciones);
				intIepsUnitario = parseFloat(intIepsUnitario);


				//Asignar valores a los arrays
				arrRefaccionID.push(objRen.getAttribute('id'));
				arrCodigos.push(objRen.cells[0].innerHTML);
				arrDescripciones.push(objRen.cells[1].innerHTML);
				arrCantidades.push(intCantidad);
				arrPreciosUnitarios.push(intPrecioUnitario);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrTasaCuotaIva.push(objRen.cells[13].innerHTML);
				arrIvasUnitarios.push(intIvaUnitario);
				arrTasaCuotaIeps.push(objRen.cells[14].innerHTML);
				arrIepsUnitarios.push(intIepsUnitario );
				arrCodigosLineas.push(objRen.cells[15].innerHTML);
			}

			//Variable que se utiliza para asignar el importe retenido de ISR (proveedor)
			var intRetencionIsrProv =  parseFloat($.reemplazar($('#txtImporteRetenido_ordenes_compra_refacciones_refacciones').val(), ",", ""));

			//Si existe retención de ISR (proveedor)
			if(intRetencionIsrProv > 0)
			{
				//Convertir importes a peso mexicano
				intRetencionIsrProv = intRetencionIsrProv * intTipoCambioOrden;
				//Redondear cantidad a decimales
				intRetencionIsrProv = intRetencionIsrProv.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraRefaccionesRefacciones);
				intRetencionIsrProv = parseFloat(intRetencionIsrProv);
			}



			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/ordenes_compra_refacciones/guardar',
					{ 
						//Datos de la orden de compra
						intOrdenCompraRefaccionesID: $('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val(),
						strFolioConsecutivo: $('#txtFolio_ordenes_compra_refacciones_refacciones').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_ordenes_compra_refacciones_refacciones').val()),
						dteFechaEntrega: $.formatFechaMysql($('#txtFechaEntrega_ordenes_compra_refacciones_refacciones').val()),
						dteFechaVencimiento: $.formatFechaMysql($('#txtFechaVencimiento_ordenes_compra_refacciones_refacciones').val()),
						strCondicionesPago: $('#cmbCondicionesPago_ordenes_compra_refacciones_refacciones').val(),
						intMonedaID: $('#cmbMonedaID_ordenes_compra_refacciones_refacciones').val(),
						intTipoCambio: intTipoCambioOrden,
						strFactura: $('#txtFactura_ordenes_compra_refacciones_refacciones').val(),
						intProveedorID: $('#txtProveedorID_ordenes_compra_refacciones_refacciones').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_ordenes_compra_refacciones_refacciones').val(),
						intPorcentajeRetencionID: $('#txtPorcentajeRetencionID_ordenes_compra_refacciones_refacciones').val(),
						intImporteRetenido: intRetencionIsrProv,
						strObservaciones: $('#txtObservaciones_ordenes_compra_refacciones_refacciones').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_ordenes_compra_refacciones_refacciones').val(),
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
						strTasaCuotaIeps: arrTasaCuotaIeps.join('|'),
						strIepsUnitarios: arrIepsUnitarios.join('|')
					},
					function(data) {
						if (data.resultado)
						{
							//Si no existe id de la orden de compra, significa que es un nuevo registro   
							if($('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val() == '')
							{
							  	//Asignar el id de la orden de compra registrada en la base de datos
                     			$('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val(data.orden_compra_refacciones_id);
                     			//Asignar folio consecutivo
                 				$('#txtFolio_ordenes_compra_refacciones_refacciones').val(data.folio);
                 			}

             				//Si existe archivo seleccionado
             				if(arrArchivoOrdenesCompraRefaccionesRefacciones != undefined )
             				{
             					//Hacer un llamado a la función para subir el archivo
	                    		subir_archivos_modal_ordenes_compra_refacciones_refacciones('Nuevo');
             				}
             				else
             				{
             					//Hacer un llamado a la función para cerrar modal
		                    	cerrar_ordenes_compra_refacciones_refacciones();
		                    	//Hacer un llamado a la función para abrir modal de autorización
								abrir_autorizar_ordenes_compra_refacciones_refacciones($('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val(), $('#txtFolio_ordenes_compra_refacciones_refacciones').val(), 'Guardar');

								//Hacer llamado a la función  para cargar  los registros en el grid
		               			paginacion_ordenes_compra_refacciones_refacciones();  
             				}

						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_compra_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_ordenes_compra_refacciones_refacciones(tipoMensaje, mensaje)
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
		function cambiar_estatus_ordenes_compra_refacciones_refacciones(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val();

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
														set_estatus_ordenes_compra_refacciones_refacciones(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_ordenes_compra_refacciones_refacciones(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_ordenes_compra_refacciones_refacciones(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('refacciones/ordenes_compra_refacciones/set_estatus',
			      {intOrdenCompraRefaccionesID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_ordenes_compra_refacciones_refacciones();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_ordenes_compra_refacciones_refacciones();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_ordenes_compra_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ordenes_compra_refacciones_refacciones(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/ordenes_compra_refacciones/get_datos',
			       {intOrdenCompraRefaccionesID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ordenes_compra_refacciones_refacciones();
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
				            $('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val(data.row.orden_compra_refacciones_id);
				            $('#txtFolio_ordenes_compra_refacciones_refacciones').val(data.row.folio);
				            $('#txtFecha_ordenes_compra_refacciones_refacciones').val(data.row.fecha);
				            $('#txtFechaEntrega_ordenes_compra_refacciones_refacciones').val(data.row.fecha_entrega);
				            $('#txtFechaVencimiento_ordenes_compra_refacciones_refacciones').val(data.row.fecha_vencimiento);
				            $('#cmbCondicionesPago_ordenes_compra_refacciones_refacciones').val(data.row.condiciones_pago);
				            $('#cmbMonedaID_ordenes_compra_refacciones_refacciones').val(data.row.moneda_id);
				            $('#txtTipoCambio_ordenes_compra_refacciones_refacciones').val(data.row.tipo_cambio);
				            $('#txtFactura_ordenes_compra_refacciones_refacciones').val(data.row.factura);
				            $('#txtProveedorID_ordenes_compra_refacciones_refacciones').val(data.row.proveedor_id);
						    $('#txtProveedor_ordenes_compra_refacciones_refacciones').val(data.row.proveedor);
						    $('#txtRegimenFiscalID_ordenes_compra_refacciones_refacciones').val(data.row.regimen_fiscal_id);
						    $('#txtPorcentajeRetencionID_ordenes_compra_refacciones_refacciones').val(data.row.porcentaje_retencion_id);
						    $('#txtPorcentajeIsr_ordenes_compra_refacciones_refacciones').val(data.row.porcentaje_isr);
						    $('#txtImporteRetenido_ordenes_compra_refacciones_refacciones').val(intRetencionIsrProv);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporteRetenido_ordenes_compra_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones });
						    $('#txtDiasCredito_ordenes_compra_refacciones_refacciones').val(data.row.dias_credito);
						    $('#txtObservaciones_ordenes_compra_refacciones_refacciones').val(data.row.observaciones);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_ordenes_compra_refacciones_refacciones').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_ordenes_compra_refacciones_refacciones").show();
				            //Ocultar botón Adjuntar archivo
				            $("#btnAdjuntar_ordenes_compra_refacciones_refacciones").hide();

				             //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	    				 mostrar_retencion_isr_ordenes_compra_refacciones_refacciones();

				            //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar los siguientes botones
				            	$("#btnDescargarArchivo_ordenes_compra_refacciones_refacciones").show();
				            	//Si el estatus del registro es ACTIVO
				            	if(strEstatus == 'ACTIVO')
				            	{
				            		$('#btnEliminarArchivo_ordenes_compra_refacciones_refacciones').show();
				            	}
				           	}
				           	
							//Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmOrdenesCompraRefaccionesRefacciones').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					            $("#btnGuardar_ordenes_compra_refacciones_refacciones").hide();

					            //Si el estatus del registro es INACTIVO
				            	if(strEstatus == 'INACTIVO')
				            	{
				            		//Mostrar botón Restaurar
				            		$("#btnRestaurar_ordenes_compra_refacciones_refacciones").show();
				            	}
				            	else //Si el estatus del registro es AUTORIZADO
				            	{
				            		//Mostrar botón Enviar correo  
				            		$("#btnEnviarCorreo_ordenes_compra_refacciones_refacciones").show();
				            	}

				            }
				            else  //ACTIVO O RECHAZADO
				            {
				            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
												   " onclick='editar_renglon_detalles_ordenes_compra_refacciones_refacciones(this)'>" + 
												   "<span class='glyphicon glyphicon-edit'></span></button>" + 
												   "<button class='btn btn-default btn-xs' title='Eliminar'" +
												   " onclick='eliminar_renglon_detalles_ordenes_compra_refacciones_refacciones(this)'>" + 
												   "<span class='glyphicon glyphicon-trash'></span></button>" + 
												   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												   "<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDOrdenesCompraRefaccionesRefacciones)
							    {
									//Habilitar caja de texto
									$("#txtTipoCambio_ordenes_compra_refacciones_refacciones").removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar las siguientes cajas de texto
									$("#txtTipoCambio_ordenes_compra_refacciones_refacciones").attr('disabled','disabled');
							    }

				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
					            {
					            	//Mostrar los siguientes botones  
					            	$("#btnDesactivar_ordenes_compra_refacciones_refacciones").show();
					            	$("#btnEnviarCorreo_ordenes_compra_refacciones_refacciones").show();
					            	$("#btnAutorizar_ordenes_compra_refacciones_refacciones").show();
					            	$("#btnAdjuntar_ordenes_compra_refacciones_refacciones").show();
					            }
				            }


				            

				           	//Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_ordenes_compra_refacciones_refacciones').getElementsByTagName('tbody')[0];

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
								var objCeldaTasaCuotaIva = objRenglon.insertCell(13);
								var objCeldaTasaCuotaIeps = objRenglon.insertCell(14);
								var objCeldaCodigoLinea = objRenglon.insertCell(15);
								var objCeldaPrecioUnitarioBD = objRenglon.insertCell(16);
								var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(17);
								var objCeldaIvaUnitarioBD = objRenglon.insertCell(18);
								var objCeldaIepsUnitarioBD = objRenglon.insertCell(19);

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
								intCantidad =  formatMoney(intCantidad, 2, '');
								var intPrecioUnitarioMostrar =  formatMoney(intPrecioUnitario, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
								
								var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDOrdenesCompraRefaccionesRefacciones, '');
								
								var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
								
								var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
								
								var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
								
								var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
								
								intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDOrdenesCompraRefaccionesRefacciones, '');

								//Cambiar cantidad a  formato moneda (a guardar en la  BD)
								var intPrecioUnitarioBD =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDOrdenesCompraRefaccionesRefacciones, '');
								
								var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDOrdenesCompraRefaccionesRefacciones, '');
								
								var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDOrdenesCompraRefaccionesRefacciones, '');
								
								var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDOrdenesCompraRefaccionesRefacciones, '');


								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].refaccion_id);
								objCeldaCodigo.setAttribute('class', 'movil b1');
								objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
								objCeldaDescripcion.setAttribute('class', 'movil b2');
								objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
								objCeldaCantidad.setAttribute('class', 'movil b3');
								objCeldaCantidad.innerHTML = intCantidad;
								objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
								objCeldaPrecioUnitario.innerHTML = intPrecioUnitarioMostrar;
								objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
								objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitarioMostrar;
								objCeldaSubtotal.setAttribute('class', 'movil b6');
								objCeldaSubtotal.innerHTML = intSubtotalMostrar;
								objCeldaIvaUnitario.setAttribute('class', 'movil b7');
								objCeldaIvaUnitario.innerHTML = intImporteIvaMostrar;
								objCeldaIepsUnitario.setAttribute('class', 'movil b8');
								objCeldaIepsUnitario.innerHTML = intImporteIepsMostrar;
								objCeldaTotal.setAttribute('class', 'movil b9');
								objCeldaTotal.innerHTML = intTotalMostrar;
								objCeldaAcciones.setAttribute('class', 'td-center movil b10');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento;
								objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIva.innerHTML =  data.detalles[intCon].porcentaje_iva;
								objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
								//Columnas ocultas que se utilizan para guardar información en la BD
								objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIva.innerHTML = data.detalles[intCon].tasa_cuota_iva;
								objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIeps.innerHTML = data.detalles[intCon].tasa_cuota_ieps;
								objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
								objCeldaCodigoLinea.innerHTML = data.detalles[intCon].codigo_linea;
								objCeldaPrecioUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaPrecioUnitarioBD.innerHTML =  intPrecioUnitarioBD;
								objCeldaDescuentoUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaDescuentoUnitarioBD.innerHTML =  intDescuentoUnitarioBD;
								objCeldaIvaUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaIvaUnitarioBD.innerHTML =  intImporteIvaBD;
								objCeldaIepsUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaIepsUnitarioBD.innerHTML =  intImporteIepsBD;
				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_ordenes_compra_refacciones_refacciones();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_ordenes_compra_refacciones_refacciones tr").length - 2;
							$('#numElementos_detalles_ordenes_compra_refacciones_refacciones').html(intFilas);
							$('#txtNumDetalles_ordenes_compra_refacciones_refacciones').val(intFilas);
							
							
			            	//Abrir modal
				            objOrdenesCompraRefaccionesRefacciones = $('#OrdenesCompraRefaccionesRefaccionesBox').bPopup({
														  appendTo: '#OrdenesCompraRefaccionesRefaccionesContent', 
							                              contentContainer: 'OrdenesCompraRefaccionesRefaccionesM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#cmbMonedaID_ordenes_compra_refacciones_refacciones').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_ordenes_compra_refacciones_refacciones()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_ordenes_compra_refacciones_refacciones').val()) !== intMonedaBaseIDOrdenesCompraRefaccionesRefacciones)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_ordenes_compra_refacciones_refacciones").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_ordenes_compra_refacciones_refacciones').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_ordenes_compra_refacciones_refacciones').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_ordenes_compra_refacciones_refacciones").val(data.row.tipo_cambio_sat);
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}

		//Función para subir los archivos de un registro desde el modal
		function subir_archivos_modal_ordenes_compra_refacciones_refacciones(tipoAccion)
		{
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDOrdenesCompraRefaccionesRefacciones  = "archivo_varios_ordenes_compra_refacciones_refacciones";
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDOrdenesCompraRefaccionesRefacciones);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDOrdenesCompraRefaccionesRefacciones)[0].files;
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
			    $('#'+strBotonArchivoIDOrdenesCompraRefaccionesRefacciones).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_ordenes_compra_refacciones_refacciones('error', strMensajeError);
	        }
	        else
	        {
	        	//Si existe id del registro subir los archivos
	        	if($('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val() != '')
	        	{
		        	//Crear instancia al objeto del formulario
		        	var formData = new FormData($("#frmOrdenesCompraRefaccionesRefacciones")[0]);
		        	//Hacer un llamado al método del controlador para subir archivos del registro
		            $.ajax({
		                url: 'refacciones/ordenes_compra_refacciones/subir_archivos',
		                type: "POST",
		                data: formData,
		                contentType: false,
		                processData: false,
		                success: function(data)
		                {
		                    //Limpia ruta del archivo cargado
			         		$('#'+strBotonArchivoIDOrdenesCompraRefaccionesRefacciones).val('');
							//Subida finalizada.
							if (data.resultado)
							{
							   //Mostrar los siguientes botones
		                       $('#btnDescargarArchivo_ordenes_compra_refacciones_refacciones').show();
		                       $("#btnEliminarArchivo_ordenes_compra_refacciones_refacciones").show();
			         		   //Hacer llamado a la función  para cargar  los registros en el grid
				           	   paginacion_ordenes_compra_refacciones_refacciones();  
							}

							//Si la acción corresponde a un nuevo registro
		                    if(tipoAccion == 'Nuevo')
		                    {
		                    	//Si el tipo de mensaje es un éxito
				                if(data.tipo_mensaje == 'éxito')
				                {
					                //Hacer un llamado a la función para cerrar modal
					                cerrar_ordenes_compra_refacciones_refacciones();
					                //Hacer un llamado a la función para abrir modal de autorización
									abrir_autorizar_ordenes_compra_refacciones_refacciones($('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val(), $('#txtFolio_ordenes_compra_refacciones_refacciones').val(), 'Guardar');
				                }
				                else
				                {
				                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    			mensaje_ordenes_compra_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
				                }
		                    }
		                    else
		                    {

		                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    		mensaje_ordenes_compra_refacciones_refacciones(data.tipo_mensaje, data.mensaje);
		                    }
		                }
	            	});
	            }
	        }
			
		}

		//Función para asignar los datos de un proveedor
		function get_datos_proveedor_ordenes_compra_refacciones_refacciones(ui)
		{
		 	//Asignar valores del registro seleccionado
             $('#txtProveedorID_ordenes_compra_refacciones_refacciones').val(ui.item.data);
             $('#txtDiasCredito_ordenes_compra_refacciones_refacciones').val(ui.item.dias_credito);
             $('#txtRegimenFiscalID_ordenes_compra_refacciones_refacciones').val(ui.item.regimen_fiscal_id);
             //Hacer un llamado a la función para calcular fecha de vencimiento
	       	  $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraRefaccionesRefacciones);

       	     //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt(ui.item.regimen_fiscal_id) == intRegimenFiscalIDResicoOrdenesCompraRefaccionesRefacciones)
       	     {
       	     	//Hacer un llamado a la función para cargar el porcentaje de retención ISR base
       			cargar_porcentaje_isr_base_ordenes_compra_refacciones_refacciones();
       	     }

       	     //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_ordenes_compra_refacciones_refacciones();

		}

		//Función para mostrar u ocultar div que contiene el campo de retención de ISR (proveedor)
		function mostrar_retencion_isr_ordenes_compra_refacciones_refacciones()
		{
			//Si el gasto tiene retención de ISR
            if(parseInt($('#txtRegimenFiscalID_ordenes_compra_refacciones_refacciones').val()) == intRegimenFiscalIDResicoOrdenesCompraRefaccionesRefacciones)
            {
            	//Quitar clase no-mostrar para mostrar div que contiene la retención de ISR (proveedor)
			  	$('#divRetencionIsr_ordenes_compra_refacciones_refacciones').removeClass("no-mostrar");
            }
            else
            {
            	//Agregar clase no-mostrar para ocultar div que contiene la retención de ISR (proveedor)
			    $('#divRetencionIsr_ordenes_compra_refacciones_refacciones').addClass("no-mostrar");
            }

		}


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
		function inicializar_refaccion_detalles_ordenes_compra_refacciones_refacciones()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones').val('');
            $('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').val('');
            $('#txtDescripcion_detalles_ordenes_compra_refacciones_refacciones').val('');
            $('#txtCodigoLinea_detalles_ordenes_compra_refacciones_refacciones').val('');
            $("#txtTasaCuotaIva_detalles_ordenes_compra_refacciones_refacciones").val('');
            $("#txtPorcentajeIva_detalles_ordenes_compra_refacciones_refacciones").val('');
            $("#txtTasaCuotaIeps_detalles_ordenes_compra_refacciones_refacciones").val('');
            $("#txtPorcentajeIeps_detalles_ordenes_compra_refacciones_refacciones").val('');
		}

		//Función para regresar obtener los datos de una refacción
		function get_datos_refaccion_detalles_ordenes_compra_refacciones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los datos de la refacción
            $.post('refacciones/refacciones/get_datos',
                  { 
                  	strBusqueda:$("#txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones").val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                   	   $("#txtDescripcion_detalles_ordenes_compra_refacciones_refacciones").val(data.row.descripcion);
                   	   $("#txtCodigoLinea_detalles_ordenes_compra_refacciones_refacciones").val(data.row.codigo_linea);
                   	   $("#txtTasaCuotaIva_detalles_ordenes_compra_refacciones_refacciones").val(data.row.tasa_cuota_iva);
                       $("#txtPorcentajeIva_detalles_ordenes_compra_refacciones_refacciones").val(data.row.porcentaje_iva);
                       $("#txtTasaCuotaIeps_detalles_ordenes_compra_refacciones_refacciones").val(data.row.tasa_cuota_ieps);
                       $("#txtPorcentajeIeps_detalles_ordenes_compra_refacciones_refacciones").val(data.row.porcentaje_ieps);
                       //Enfocar caja de texto
                  	   $("#txtCantidad_detalles_ordenes_compra_refacciones_refacciones").focus();
                    }
                  }
                 ,
                'json');
		}

		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_ordenes_compra_refacciones_refacciones()
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

			//Obtenemos los datos de las cajas de texto
			var intRefaccionID = $('#txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones').val();
			var strCodigo = $('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').val();
			var strDescripcion = $('#txtDescripcion_detalles_ordenes_compra_refacciones_refacciones').val();
			var strCodigoLinea = $('#txtCodigoLinea_detalles_ordenes_compra_refacciones_refacciones').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones').val();
			var intCantidad = $('#txtCantidad_detalles_ordenes_compra_refacciones_refacciones').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_ordenes_compra_refacciones_refacciones').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_ordenes_compra_refacciones_refacciones').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_ordenes_compra_refacciones_refacciones').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_ordenes_compra_refacciones_refacciones').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_refacciones_refacciones').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intRefaccionID == '' || strCodigo == '')
			{
				//Enfocar caja de texto
				$('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').focus();
			}
			else if (intRefaccionID == '' || strDescripcion == '')
			{
				//Enfocar caja de texto
				$('#txtDescripcion_detalles_ordenes_compra_refacciones_refacciones').focus();
			}
			else if (intCantidad == '' || intCantidad <= 0)
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_ordenes_compra_refacciones_refacciones').focus();
			}
			else if (intPrecioUnitario == '' || intPrecioUnitario <= 0)
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtCantidad_detalles_ordenes_compra_refacciones_refacciones').val('');
				$('#txtPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones').val('');
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones').val('0.00');
				//Hacer un llamado a la función para inicializar elementos de la refacción
				inicializar_refaccion_detalles_ordenes_compra_refacciones_refacciones();

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
					intDescuentoUnitario = intDescuentoUnitario.toFixed(intNumDecimalesDescUnitBDOrdenesCompraRefaccionesRefacciones);

					//Decrementar descuento unitario
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}
			
				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;
				
				//Redondear cantidad a decimales
				intSubtotal = intSubtotal.toFixed(intNumDecimalesPrecioUnitBDOrdenesCompraRefaccionesRefacciones);
				intSubtotal = parseFloat(intSubtotal);


				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);
				
				//Redondear cantidad a dos decimales
			    intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraRefaccionesRefacciones);
			    intImporteIva = parseFloat(intImporteIva);

			
				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps != '')
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
					//Redondear cantidad a dos decimales
			   	 	intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDOrdenesCompraRefaccionesRefacciones);
			   	 	intImporteIeps = parseFloat(intImporteIeps);
					
				}
				

				//Calcular importe total
				intTotal = parseFloat(intSubtotal + intImporteIva + intImporteIeps);

				//Cambiar cantidad a  formato moneda (a visualizar)
				intCantidad =  formatMoney(intCantidad, 2, '');
				var intPrecioUnitarioMostrar =  formatMoney(intPrecioUnitario, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
				
				var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDOrdenesCompraRefaccionesRefacciones, '');
				
				var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
				
				var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
				
				var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
				
				var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
				
				intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDOrdenesCompraRefaccionesRefacciones, '');

				//Cambiar cantidad a  formato moneda (a guardar en la  BD)
				var intPrecioUnitarioBD =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDOrdenesCompraRefaccionesRefacciones, '');
				
				var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDOrdenesCompraRefaccionesRefacciones, '');
				
				var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDOrdenesCompraRefaccionesRefacciones, '');
				
				var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDOrdenesCompraRefaccionesRefacciones, '');
			
				//Revisamos si existe el ID proporcionado, si es así, editamos los datos
				if (objTabla.rows.namedItem(intRefaccionID))
				{
					objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = intCantidad;
					objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML = intPrecioUnitarioMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML =  intDescuentoUnitarioMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[5].innerHTML =  intSubtotalMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[6].innerHTML = intImporteIvaMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[7].innerHTML = intImporteIepsMostrar;
					objTabla.rows.namedItem(intRefaccionID).cells[8].innerHTML = intTotalMostrar
					objTabla.rows.namedItem(intRefaccionID).cells[10].innerHTML = intPorcentajeDescuento;
					objTabla.rows.namedItem(intRefaccionID).cells[11].innerHTML = intPorcentajeIva;
					objTabla.rows.namedItem(intRefaccionID).cells[12].innerHTML = intPorcentajeIeps;
					objTabla.rows.namedItem(intRefaccionID).cells[13].innerHTML = intTasaCuotaIva;
					objTabla.rows.namedItem(intRefaccionID).cells[14].innerHTML = intTasaCuotaIeps;
					objTabla.rows.namedItem(intRefaccionID).cells[15].innerHTML = strCodigoLinea;
					objTabla.rows.namedItem(intRefaccionID).cells[16].innerHTML = intPrecioUnitarioBD;
					objTabla.rows.namedItem(intRefaccionID).cells[17].innerHTML = intDescuentoUnitarioBD;
					objTabla.rows.namedItem(intRefaccionID).cells[18].innerHTML = intImporteIvaBD;
					objTabla.rows.namedItem(intRefaccionID).cells[19].innerHTML = intImporteIepsBD;

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
					var objCeldaTasaCuotaIva = objRenglon.insertCell(13);
					var objCeldaTasaCuotaIeps = objRenglon.insertCell(14);
					var objCeldaCodigoLinea = objRenglon.insertCell(15);
					var objCeldaPrecioUnitarioBD = objRenglon.insertCell(16);
					var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(17);
					var objCeldaIvaUnitarioBD = objRenglon.insertCell(18);
					var objCeldaIepsUnitarioBD = objRenglon.insertCell(19);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRefaccionID);
					objCeldaCodigo.setAttribute('class', 'movil b1');
					objCeldaCodigo.innerHTML = strCodigo;
					objCeldaDescripcion.setAttribute('class', 'movil b2');
					objCeldaDescripcion.innerHTML = strDescripcion;
					objCeldaCantidad.setAttribute('class', 'movil b3');
					objCeldaCantidad.innerHTML = intCantidad;
					objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
					objCeldaPrecioUnitario.innerHTML = intPrecioUnitarioMostrar;
					objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
					objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitarioMostrar;
					objCeldaSubtotal.setAttribute('class', 'movil b6');
					objCeldaSubtotal.innerHTML = intSubtotalMostrar;
					objCeldaIvaUnitario.setAttribute('class', 'movil b7');
					objCeldaIvaUnitario.innerHTML = intImporteIvaMostrar;
					objCeldaIepsUnitario.setAttribute('class', 'movil b8');
					objCeldaIepsUnitario.innerHTML = intImporteIepsMostrar;
					objCeldaTotal.setAttribute('class', 'movil b9');
					objCeldaTotal.innerHTML = intTotalMostrar;
					objCeldaAcciones.setAttribute('class', 'td-center movil b10');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_ordenes_compra_refacciones_refacciones(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_ordenes_compra_refacciones_refacciones(this)'>" + 
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
					objCeldaCodigoLinea.setAttribute('class', 'no-mostrar');
					objCeldaCodigoLinea.innerHTML =  strCodigoLinea;
					objCeldaPrecioUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaPrecioUnitarioBD.innerHTML =  intPrecioUnitarioBD;
					objCeldaDescuentoUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaDescuentoUnitarioBD.innerHTML =  intDescuentoUnitarioBD;
					objCeldaIvaUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaIvaUnitarioBD.innerHTML =  intImporteIvaBD;
					objCeldaIepsUnitarioBD.setAttribute('class', 'no-mostrar');
					objCeldaIepsUnitarioBD.innerHTML =  intImporteIepsBD;
				}

				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_ordenes_compra_refacciones_refacciones();
				
				//Enfocar caja de texto
				$('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').focus();
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_ordenes_compra_refacciones_refacciones tr").length - 2;
			$('#numElementos_detalles_ordenes_compra_refacciones_refacciones').html(intFilas);
			$('#txtNumDetalles_ordenes_compra_refacciones_refacciones').val(intFilas);
		}


		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_ordenes_compra_refacciones_refacciones(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtDescripcion_detalles_ordenes_compra_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtCantidad_detalles_ordenes_compra_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIva_detalles_ordenes_compra_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtPorcentajeIeps_detalles_ordenes_compra_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtTasaCuotaIva_detalles_ordenes_compra_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtTasaCuotaIeps_detalles_ordenes_compra_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);
			$('#txtCodigoLinea_detalles_ordenes_compra_refacciones_refacciones').val(objRenglon.parentNode.parentNode.cells[15].innerHTML);

			//Enfocar caja de texto
			$('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_ordenes_compra_refacciones_refacciones(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_ordenes_compra_refacciones_refacciones").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_ordenes_compra_refacciones_refacciones();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_ordenes_compra_refacciones_refacciones tr").length - 2;
			$('#numElementos_detalles_ordenes_compra_refacciones_refacciones').html(intFilas);
			$('#txtNumDetalles_ordenes_compra_refacciones_refacciones').val(intFilas);

			//Enfocar caja de texto
			$('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_ordenes_compra_refacciones_refacciones()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_refacciones_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Variable que se utiliza para asignar el acumulado anterior del subtotal (en caso de que existan cambios calcular retención de ISR (proveedor) de lo contrario conservar el importe de retención (puede darse el caso de que el usuario modifique dicho importe))
			var intAcumSubtotalAnterior = $('#acumSubtotal_detalles_ordenes_compra_refacciones_refacciones').html();

			//Variable que se utiliza para contar el número de registros
			var intContReg = 0;

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

				//Incrementar contador por cada registro recorridp
				intContReg++;

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, intNumDecimalesDescUnitBDOrdenesCompraRefaccionesRefacciones, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');

			//Asignar los valores
			$('#acumCantidad_detalles_ordenes_compra_refacciones_refacciones').html(intAcumUnidades);
			$('#acumDescuento_detalles_ordenes_compra_refacciones_refacciones').html(intAcumDescuento);
			$('#acumSubtotal_detalles_ordenes_compra_refacciones_refacciones').html(intAcumSubtotal);
			$('#acumIva_detalles_ordenes_compra_refacciones_refacciones').html(intAcumIva);
			$('#acumIeps_detalles_ordenes_compra_refacciones_refacciones').html(intAcumIeps);
			$('#acumTotal_detalles_ordenes_compra_refacciones_refacciones').html(intAcumTotal);


			//Si no existe id de la orden de compra, significa que es un nuevo registro
			if($('#txtOrdenCompraRefaccionesID_ordenes_compra_refacciones_refacciones').val() == '' && intContReg == 1)
			{
				//Asignar el contador para calcular el isr del único detalle
				intAcumSubtotalAnterior = intContReg;
			}


			//Si hubo cambios en el acumulado del subtotal
			if(intAcumSubtotalAnterior != intAcumSubtotal && intAcumSubtotalAnterior != '')
			{
				//Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_ordenes_compra_refacciones_refacciones();
			}
		}


		//Función que se utiliza para calcular la retención de ISR (proveedor)
		function calcular_isr_ordenes_compra_refacciones_refacciones()
		{
			 //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt($('#txtRegimenFiscalID_ordenes_compra_refacciones_refacciones').val()) == intRegimenFiscalIDResicoOrdenesCompraRefaccionesRefacciones)
       	     {
       	     	//Variable que se utiliza para asignar el importe retenido
       	     	var intImporteRetenido = 0;
       	     	//Variable que se utiliza para asignar el acumulado del subtotal
				var intAcumSubtotal = 0;

       	     	//Hacer un llamado a la función para reemplazar '$' y  ','  por cadena vacia
				intAcumSubtotal =  $.reemplazar($('#acumSubtotal_detalles_ordenes_compra_refacciones_refacciones').html(), "$", "");
				intAcumSubtotal =  $.reemplazar(intAcumSubtotal, ",", "");

				//Si existe porcentaje de ISR (proveedor)
				if($('#txtPorcentajeIsr_ordenes_compra_refacciones_refacciones').val() != '' && intAcumSubtotal > 0 )
				{
					//Variable que se utiliza para asignar el porcentaje de retención ISR
					var intPorcentajeRetencionIsr = parseFloat($('#txtPorcentajeIsr_ordenes_compra_refacciones_refacciones').val());

					//Calcular retención de ISR 
					intImporteRetenido = parseFloat(intAcumSubtotal * intPorcentajeRetencionIsr);
					//Redondear cantidad a decimales
					intImporteRetenido = intImporteRetenido.toFixed(intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones);
					intImporteRetenido = parseFloat(intImporteRetenido);
				}

				//Convertir cantidad a formato moneda
				intImporteRetenido = formatMoney(intImporteRetenido, intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones, '');

				//Asignar importe retenido 
				$('#txtImporteRetenido_ordenes_compra_refacciones_refacciones').val(intImporteRetenido);

       	     }
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Autorizar Orden de Compra
			*********************************************************************************************************************/
			//Modificar el mensaje cuando cambie la opción del combobox
	        $('#cmbEstatus_autorizar_ordenes_compra_refacciones_refacciones').change(function(e){   
	        	//Variables que se utilizan para el mensaje informativo
	        	var strEstatus = $('#cmbEstatus_autorizar_ordenes_compra_refacciones_refacciones').val();
	        	var strMensaje = '';
	        	var strFolio = $('#txtFolio_autorizar_ordenes_compra_refacciones_refacciones').val();
	        	
	        	//Si existe estatus seleccionado
	        	if(strEstatus != '')
	        	{
	        		strMensaje += 'Se ';
	        		
	        		//Dependiendo del estatus modificar mensaje
	              	if($('#cmbEstatus_autorizar_ordenes_compra_refacciones_refacciones').val() === 'AUTORIZADO')
	             	{
	             		strMensaje += 'autorizó ';
	             	}
	             	else
	             	{
	             		strMensaje += 'rechazó ';
	             	}

	             	//Agregar folio en el mensaje
	             	strMensaje += ' la orden de compra refacciones '+strFolio;
	        	}
	           

             	//Asignar mensaje informativo
             	$('#txtMensaje_autorizar_ordenes_compra_refacciones_refacciones').val(strMensaje);
				
	        });

			/*******************************************************************************************************************
			Controles correspondientes al modal Ordenes de Compra
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_ordenes_compra_refacciones_refacciones').numeric();
			$('#txtTotalUnidades_ordenes_compra_refacciones_refacciones').numeric();
			$('#txtImporteTotal_ordenes_compra_refacciones_refacciones').numeric();
			$('#txtCantidad_detalles_ordenes_compra_refacciones_refacciones').numeric();
			$('#txtPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones').numeric();
        	$('#txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones').numeric();
        	$('#txtPorcentajeIsr_ordenes_compra_refacciones_refacciones').numeric();
        	$('#txtImporteRetenido_ordenes_compra_refacciones_refacciones').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_ordenes_compra_refacciones_refacciones').blur(function(){
				$('.moneda_ordenes_compra_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarOrdenesCompraRefaccionesRefacciones });
			});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_ordenes_compra_refacciones_refacciones').blur(function(){
                $('.tipo-cambio_ordenes_compra_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_ordenes_compra_refacciones_refacciones').blur(function(){
                $('.cantidad_ordenes_compra_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_ordenes_compra_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaEntrega_ordenes_compra_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaVencimiento_ordenes_compra_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});

			//Calcular fecha de vencimiento cuando cambie la fecha
			$('#dteFecha_ordenes_compra_refacciones_refacciones').on('dp.change', function (e) {
	           	//Hacer un llamado a la función para calcular fecha de vencimiento
	       	    $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraRefaccionesRefacciones);
             	//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_ordenes_compra_refacciones_refacciones();
			});


			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_ordenes_compra_refacciones_refacciones').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_ordenes_compra_refacciones_refacciones').val()) === intMonedaBaseIDOrdenesCompraRefaccionesRefacciones)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_refacciones_refacciones").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_ordenes_compra_refacciones_refacciones').val(intTipoCambioMonedaBaseOrdenesCompraRefaccionesRefacciones);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_ordenes_compra_refacciones_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_refacciones_refacciones").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_ordenes_compra_refacciones_refacciones').val('');
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_ordenes_compra_refacciones_refacciones(); 
             	}
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_ordenes_compra_refacciones_refacciones').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_ordenes_compra_refacciones_refacciones').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoOrdenesCompraRefaccionesRefacciones)
	        	{
	        		$('#txtTipoCambio_ordenes_compra_refacciones_refacciones').val(intTipoCambioMaximoOrdenesCompraRefaccionesRefacciones);
	        	}

		    });


		    //Calcular fecha de vencimiento cuando cambie la opción del combobox
	        $('#cmbCondicionesPago_ordenes_compra_refacciones_refacciones').change(function(e){   
	             //Hacer un llamado a la función para calcular fecha de vencimiento
	       	     $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraRefaccionesRefacciones);
	        });

			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedor_ordenes_compra_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorID_ordenes_compra_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_ordenes_compra_refacciones_refacciones();
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
	       	     get_datos_proveedor_ordenes_compra_refacciones_refacciones(ui);

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
	        $('#txtProveedor_ordenes_compra_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_ordenes_compra_refacciones_refacciones').val() == '' ||
	               $('#txtProveedor_ordenes_compra_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorID_ordenes_compra_refacciones_refacciones').val('');
	               $('#txtProveedor_ordenes_compra_refacciones_refacciones').val('');
	               //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_ordenes_compra_refacciones_refacciones();
	            }

	        });


	        //Autocomplete para recuperar los datos de un porcentaje de retención ISR 
	        $('#txtPorcentajeIsr_ordenes_compra_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtPorcentajeRetencionID_ordenes_compra_refacciones_refacciones').val('');
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
	             $('#txtPorcentajeRetencionID_ordenes_compra_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtPorcentajeIsr_ordenes_compra_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtPorcentajeRetencionID_ordenes_compra_refacciones_refacciones').val() == '' ||
	               $('#txtPorcentajeIsr_ordenes_compra_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtPorcentajeRetencionID_ordenes_compra_refacciones_refacciones').val('');
	               $('#txtPorcentajeIsr_ordenes_compra_refacciones_refacciones').val('');
	            }

	           //Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_ordenes_compra_refacciones_refacciones();
	            
	        });


	        //Autocomplete para recuperar los datos de una refacción
	        $('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones/autocomplete",
	                   type: "post",
	                   dataType: "json",
	                   data: {
	                     strDescripcion: request.term,
	                     strTipo: 'codigo'
	                   },
	                   success: function( data ) {
	                     response( data );
	                   }
	                 });
	             },
	             select: function( event, ui ) {
	                //Asignar id del registro seleccionado
	                $('#txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones').val(ui.item.data);
	                //Hacer un llamado a la función para regresar los datos de la refacción
	               	get_datos_refaccion_detalles_ordenes_compra_refacciones_refacciones();
	                //Elegir código desde el valor devuelto en el autocomplete
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

	        //Verificar que exista id de la refacción cuando pierda el enfoque la caja de texto
	        $('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la refacción
	            if($('#txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones').val() == '' ||
	               $('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').val() == '')
	            { 
	            	//Hacer un llamado a la función para inicializar elementos de la refacción
	              	inicializar_refaccion_detalles_ordenes_compra_refacciones_refacciones();
	            }

	        });

	        //Autocomplete para recuperar los datos de una refacción
	        $('#txtDescripcion_detalles_ordenes_compra_refacciones_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones/autocomplete",
	                   type: "post",
	                   dataType: "json",
	                   data: {
	                     strDescripcion: request.term,
	                     strTipo: 'descripcion'
	                   },
	                   success: function( data ) {
	                     response( data );
	                   }
	                 });
	             },
	             select: function( event, ui ) {
	                //Asignar id del registro seleccionado
	                $('#txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones').val(ui.item.data);
	                //Elegir código desde el valor devuelto en el autocomplete
					var strCodigo = ui.item.value.split(" - ")[0];
					$('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').val(strCodigo);
	                //Hacer un llamado a la función para regresar los datos de la refacción
	               	get_datos_refaccion_detalles_ordenes_compra_refacciones_refacciones();
	             },
	             open: function() {
	                 $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	               },
	               close: function() {
	                 $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	               },
	             minLength: 1
	        });

	        //Verificar que exista id de la refacción cuando pierda el enfoque la caja de texto
	        $('#txtDescripcion_detalles_ordenes_compra_refacciones_refacciones').focusout(function(e){
	            //Si no existe id de la refacción
	            if($('#txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones').val() == '' ||
	               $('#txtDescripcion_detalles_ordenes_compra_refacciones_refacciones').val() == '')
	            { 
	             	//Hacer un llamado a la función para inicializar elementos de la refacción
	              	inicializar_refaccion_detalles_ordenes_compra_refacciones_refacciones();
	            }

	        });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_ordenes_compra_refacciones_refacciones').on('click','button.btn',function(){
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

	        //Validar que exista código de la refacción cuando se pulse la tecla enter 
			$('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
			   	    //Si no existe código de la refacción
		            if($('#txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones').val() == '' || $('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCodigo_detalles_ordenes_compra_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtCantidad_detalles_ordenes_compra_refacciones_refacciones').focus();
			   	    }
		        }
		    });

		    //Validar que exista descripción de la refacción cuando se pulse la tecla enter 
			$('#txtDescripcion_detalles_ordenes_compra_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe descripción de la refacción
		            if($('#txtRefaccionID_detalles_ordenes_compra_refacciones_refacciones').val() == '' || $('#txtDescripcion_detalles_ordenes_compra_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtDescripcion_detalles_ordenes_compra_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_ordenes_compra_refacciones_refacciones').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_ordenes_compra_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_ordenes_compra_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_ordenes_compra_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones').focus();
			   	    }
		        }
		    });

			//Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPrecioUnitario_detalles_ordenes_compra_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_ordenes_compra_refacciones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_detalles_ordenes_compra_refacciones_refacciones();
			   	    }
		        }
		    });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_ordenes_compra_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_ordenes_compra_refacciones_refacciones').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_ordenes_compra_refacciones_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_ordenes_compra_refacciones_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_ordenes_compra_refacciones_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_ordenes_compra_refacciones_refacciones').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedorBusq_ordenes_compra_refacciones_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorIDBusq_ordenes_compra_refacciones_refacciones').val('');
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
	             $('#txtProveedorIDBusq_ordenes_compra_refacciones_refacciones').val(ui.item.data);
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
	        $('#txtProveedorBusq_ordenes_compra_refacciones_refacciones').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorIDBusq_ordenes_compra_refacciones_refacciones').val() == '' ||
	               $('#txtProveedorBusq_ordenes_compra_refacciones_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorIDBusq_ordenes_compra_refacciones_refacciones').val('');
	               $('#txtProveedorBusq_ordenes_compra_refacciones_refacciones').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_ordenes_compra_refacciones_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaOrdenesCompraRefaccionesRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_ordenes_compra_refacciones_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_ordenes_compra_refacciones_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_ordenes_compra_refacciones_refacciones();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_ordenes_compra_refacciones_refacciones').addClass("estatus-NUEVO");
				//Abrir modal
				 objOrdenesCompraRefaccionesRefacciones = $('#OrdenesCompraRefaccionesRefaccionesBox').bPopup({
												   appendTo: '#OrdenesCompraRefaccionesRefaccionesContent', 
					                               contentContainer: 'OrdenesCompraRefaccionesRefaccionesM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_ordenes_compra_refacciones_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_ordenes_compra_refacciones_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_ordenes_compra_refacciones_refacciones();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_ordenes_compra_refacciones_refacciones();
		});
	</script>