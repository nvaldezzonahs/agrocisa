<div id="OrdenesCompraCuentasPagarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_ordenes_compra_cuentas_pagar" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_ordenes_compra_cuentas_pagar" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_ordenes_compra_cuentas_pagar">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_ordenes_compra_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaInicialBusq_ordenes_compra_cuentas_pagar"
				                    		name= "strFechaInicialBusq_ordenes_compra_cuentas_pagar" 
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
								<label for="txtFechaFinalBusq_ordenes_compra_cuentas_pagar">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_ordenes_compra_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaFinalBusq_ordenes_compra_cuentas_pagar"
				                    		name= "strFechaFinalBusq_ordenes_compra_cuentas_pagar" 
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
								<input id="txtProveedorIDBusq_ordenes_compra_cuentas_pagar" 
									   name="intProveedorIDBusq_ordenes_compra_cuentas_pagar"  type="hidden" 
									   value="">
								</input>
								<label for="txtProveedorBusq_ordenes_compra_cuentas_pagar">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProveedorBusq_ordenes_compra_cuentas_pagar" 
										name="strProveedorBusq_ordenes_compra_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_ordenes_compra_cuentas_pagar">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_ordenes_compra_cuentas_pagar" 
								 		name="strEstatusBusq_ordenes_compra_cuentas_pagar" tabindex="1">
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
								<label for="txtBusqueda_ordenes_compra_cuentas_pagar">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_ordenes_compra_cuentas_pagar" 
										name="strBusqueda_ordenes_compra_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_ordenes_compra_cuentas_pagar" 
									   name="strImprimirDetalles_ordenes_compra_cuentas_pagar" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_ordenes_compra_cuentas_pagar"
									onclick="paginacion_ordenes_compra_cuentas_pagar();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_ordenes_compra_cuentas_pagar" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_ordenes_compra_cuentas_pagar"
									onclick="reporte_ordenes_compra_cuentas_pagar('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_ordenes_compra_cuentas_pagar"
									onclick="reporte_ordenes_compra_cuentas_pagar('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil.b1:nth-of-type(1):before {content: "Concepto"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Gasto"; font-weight: bold;}
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
				/*Totales*/
				td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.t3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
				td.movil.t4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.t5:nth-of-type(5):before {content: "Desc."; font-weight: bold;}
				td.movil.t6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.t7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.t8:nth-of-type(8):before {content: "IEPS"; font-weight: bold;}
				td.movil.t9:nth-of-type(9):before {content: "Total"; font-weight: bold;}
				/*Acumulado de las retenciones de ISR*/
				td.movil.tb1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.tb2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.tb3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.tb4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.tb5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.tb6:nth-of-type(6):before {content: ""; font-weight: bold;}
				td.movil.tb7:nth-of-type(7):before {content: ""; font-weight: bold;}
				td.movil.tb8:nth-of-type(8):before {content: ""; font-weight: bold;}
				td.movil.tb9:nth-of-type(9):before {content: "Retención de ISR"; font-weight: bold;}
				/*Acumulado  de las retenciones de IVA*/
				td.movil.tc1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.tc2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.tc3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.tc4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.tc5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.tc6:nth-of-type(6):before {content: ""; font-weight: bold;}
				td.movil.tc7:nth-of-type(7):before {content: ""; font-weight: bold;}
				td.movil.tc8:nth-of-type(8):before {content: ""; font-weight: bold;}
				td.movil.tc9:nth-of-type(9):before {content: "Retención de IVA"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_ordenes_compra_cuentas_pagar">
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
					<script id="plantilla_ordenes_compra_cuentas_pagar" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{proveedor}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_ordenes_compra_cuentas_pagar({{orden_compra_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_ordenes_compra_cuentas_pagar({{orden_compra_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!---Autorizar o rechazar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionAutorizar}}"  
										onclick="abrir_autorizar_ordenes_compra_cuentas_pagar({{orden_compra_id}},'{{folio}}', 'Autorizar');"  title="Autorizar o Rechazar">
									<span class="fa fa-check-square-o"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_proveedor_ordenes_compra_cuentas_pagar({{orden_compra_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_ordenes_compra_cuentas_pagar({{orden_compra_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
							    <!--Subir varios archivos-->
								<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
									<span class="btn  btn-default btn-xs fileinput-button ">
								    	<span class="fa fa-upload"></span>
										<input name="archivo_varios_ordenes_compra_cuentas_pagar{{orden_compra_id}}[]" id="archivo_varios_ordenes_compra_cuentas_pagar{{orden_compra_id}}"  type="file" multiple accept="text/xml,application/pdf" 
											   onchange="subir_archivos_grid_ordenes_compra_cuentas_pagar({{orden_compra_id}});">
								  		</input>
								    </span>
								</span>
                            	<!--Descargar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_ordenes_compra_cuentas_pagar({{orden_compra_id}}, '{{folio}}');" title="Descargar archivo">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
                            	<!--Eliminar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}" 
                            			 onmousedown="eliminar_archivos_ordenes_compra_cuentas_pagar({{orden_compra_id}});" title="Eliminar archivo">
                            		<span class="glyphicon glyphicon-export"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_ordenes_compra_cuentas_pagar({{orden_compra_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_ordenes_compra_cuentas_pagar({{orden_compra_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ordenes_compra_cuentas_pagar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_ordenes_compra_cuentas_pagar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Autorizar Orden de Compra-->
		<div id="AutorizarOrdenesCompraCuentasPagarBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_autorizar_ordenes_compra_cuentas_pagar" class="ModalBodyTitle confirmacion-modal-title"">
			<h1 id="tituloModal_autorizar_ordenes_compra_cuentas_pagar"></h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAutorizarOrdenesCompraCuentasPagar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmAutorizarOrdenesCompraCuentasPagar"  onsubmit="return(false)" autocomplete="off">
			    	<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReferenciaID_autorizar_ordenes_compra_cuentas_pagar" 
										   name="intReferenciaID_autorizar_ordenes_compra_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el tipo de acción (guardar o autorizar) a realizar --> 
									<input type="hidden" id="txtTipoAccion_autorizar_ordenes_compra_cuentas_pagar" 
										   name="strTipoAccion_autorizar_ordenes_compra_cuentas_pagar" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el folio del registro seleccionado--> 
									<input type="hidden" id="txtFolio_autorizar_ordenes_compra_cuentas_pagar" 
										   name="strFolio_autorizar_ordenes_compra_cuentas_pagar" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Ordenes de Compra-->
									<input id="txtModalOrdenesCompra_autorizar_ordenes_compra_cuentas_pagar" 
										   name="strModalOrdenesCompra_autorizar_ordenes_compra_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para asignar a los usuarios que se les enviará 
									     el mensaje--> 
									<input type="hidden" id="txtUsuarios_autorizar_ordenes_compra_cuentas_pagar" 
										   name="strUsuarios_autorizar_ordenes_compra_cuentas_pagar" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Enviar notificación a:</h4>
										</div>
										<div class="panel-body">
											<div id="treeUsuarios_autorizar_ordenes_compra_cuentas_pagar" class="md-list-item-text"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="divEstatus_autorizar_ordenes_compra_cuentas_pagar" class="row no-mostrar">
						<!--Estatus-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbEstatus_autorizar_ordenes_compra_cuentas_pagar">Estatus</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbEstatus_autorizar_ordenes_compra_cuentas_pagar" 
									 		name="strEstatus_autorizar_ordenes_compra_cuentas_pagar" tabindex="1">
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
									<label for="txtMensaje_autorizar_ordenes_compra_cuentas_pagar">Mensaje</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtMensaje_autorizar_ordenes_compra_cuentas_pagar" 
											   name="strMensaje_autorizar_ordenes_compra_cuentas_pagar" rows="5" value="" tabindex="1" placeholder="Ingrese mensaje" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Autorizar o rechazar registro-->
							<button class="btn btn-success" id="btnGuardar_autorizar_ordenes_compra_cuentas_pagar"  
									onclick="validar_autorizar_ordenes_compra_cuentas_pagar();"  title="Enviar" tabindex="1">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_autorizar_ordenes_compra_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_autorizar_ordenes_compra_cuentas_pagar();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Autorizar Orden de Compra-->

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarOrdenesCompraCuentasPagarBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_proveedor_ordenes_compra_cuentas_pagar" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarOrdenesCompraCuentasPagar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarOrdenesCompraCuentasPagar"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Proveedor-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtOrdenCompraID_proveedor_ordenes_compra_cuentas_pagar" 
										   name="intOrdenCompraID_proveedor_ordenes_compra_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<label for="txtProveedor_proveedor_ordenes_compra_cuentas_pagar">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_proveedor_ordenes_compra_cuentas_pagar" 
											name="strProveedor_proveedor_ordenes_compra_cuentas_pagar" type="text" value="" 
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
									<label for="txtCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar" 
											name="strCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar" 
											name="strCopiaCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_proveedor_ordenes_compra_cuentas_pagar" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_proveedor_ordenes_compra_cuentas_pagar"  
									onclick="validar_proveedor_ordenes_compra_cuentas_pagar();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_proveedor_ordenes_compra_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_proveedor_ordenes_compra_cuentas_pagar();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal Ordenes de Compra-->
		<div id="OrdenesCompraCuentasPagarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_ordenes_compra_cuentas_pagar"  class="ModalBodyTitle">
			<h1>Ordenes de Compra</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmOrdenesCompraCuentasPagar" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmOrdenesCompraCuentasPagar"  onsubmit="return(false)" 
					  autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtOrdenCompraID_ordenes_compra_cuentas_pagar" 
										   name="intOrdenCompraID_ordenes_compra_cuentas_pagar" type="hidden" value="">
									</input>
									<label for="txtFolio_ordenes_compra_cuentas_pagar">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_ordenes_compra_cuentas_pagar" 
											name="strFolio_ordenes_compra_cuentas_pagar" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_ordenes_compra_cuentas_pagar">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_ordenes_compra_cuentas_pagar'>
					                    <input class="form-control" id="txtFecha_ordenes_compra_cuentas_pagar"
					                    		name= "strFecha_ordenes_compra_cuentas_pagar" 
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
									<label for="cmbMonedaID_ordenes_compra_cuentas_pagar">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_ordenes_compra_cuentas_pagar" 
									 		name="intMonedaID_ordenes_compra_cuentas_pagar" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_ordenes_compra_cuentas_pagar">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_ordenes_compra_cuentas_pagar" id="txtTipoCambio_ordenes_compra_cuentas_pagar" 
											name="intTipoCambio_ordenes_compra_cuentas_pagar" type="text" value="" 
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
									<input id="txtProveedorID_ordenes_compra_cuentas_pagar" 
										   name="intProveedorID_ordenes_compra_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del régimen fiscal-->
									<input id="txtRegimenFiscalID_ordenes_compra_cuentas_pagar" 
										   name="intRegimenFiscalID_ordenes_compra_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar los días de crédito del proveedor seleccionado-->
									<input id="txtDiasCredito_ordenes_compra_cuentas_pagar" 
										   name="intDiasCredito_ordenes_compra_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
									<label for="txtProveedor_ordenes_compra_cuentas_pagar">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_ordenes_compra_cuentas_pagar" 
											name="strProveedor_ordenes_compra_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    	<!--Condiciones de pago-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCondicionesPago_ordenes_compra_cuentas_pagar">Condiciones de pago</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbCondicionesPago_ordenes_compra_cuentas_pagar" 
									 		name="strCondicionesPago_ordenes_compra_cuentas_pagar" tabindex="1">
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
									<label for="txtFechaVencimiento_ordenes_compra_cuentas_pagar">Fecha de vencimiento</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaVencimiento_ordenes_compra_cuentas_pagar'>
					                    <input class="form-control" id="txtFechaVencimiento_ordenes_compra_cuentas_pagar"
					                    		name= "strFechaVencimiento_ordenes_compra_cuentas_pagar" 
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
									<label for="txtFechaEntrega_ordenes_compra_cuentas_pagar">Fecha de entrega</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaEntrega_ordenes_compra_cuentas_pagar'>
					                    <input class="form-control" id="txtFechaEntrega_ordenes_compra_cuentas_pagar"
					                    		name= "strFechaEntrega_ordenes_compra_cuentas_pagar" 
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
									<label for="txtFactura_ordenes_compra_cuentas_pagar">Factura</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFactura_ordenes_compra_cuentas_pagar" 
											name="strFactura_ordenes_compra_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese factura" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Total de unidades-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTotalUnidades_ordenes_compra_cuentas_pagar">Total de unidades</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control cantidad_ordenes_compra_cuentas_pagar" id="txtTotalUnidades_ordenes_compra_cuentas_pagar" 
											name="intTotalUnidades_ordenes_compra_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese total de unidades" maxlength="21">
									</input>
								</div>
							</div>
						</div>
						<!--Total-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteTotal_ordenes_compra_cuentas_pagar">Importe total</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_ordenes_compra_cuentas_pagar" id="txtImporteTotal_ordenes_compra_cuentas_pagar" 
												name="intImporteTotal_ordenes_compra_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23">
										</input>
										
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
						<!--Autocomplete que contiene los empleados activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
									<input id="txtSolicitaID_ordenes_compra_cuentas_pagar" 
										   name="intSolicitaID_ordenes_compra_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
									<label for="txtSolicita_ordenes_compra_cuentas_pagar">Solicita</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSolicita_ordenes_compra_cuentas_pagar" 
											name="strSolicita_ordenes_compra_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese quien lo solicita" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Cargar a-->
                  		<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                  			<!--Div que contiene los campos de cargar a-->
                            <div class="form-group row">
                                <!--Etiqueta del encabezado-->
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                    <label for="txtDepartamento_ordenes_compra_cuentas_pagar">Cargar a</label>
                                </div>
                                <!--Autocomplete que contiene los departamentos activos-->
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                                	<!-- Caja de texto oculta que se utiliza para recuperar el id del departamento seleccionado-->
									<input id="txtDepartamentoID_ordenes_compra_cuentas_pagar" 
										   name="intDepartamentoID_ordenes_compra_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
                                    <input  class="form-control" id="txtDepartamento_ordenes_compra_cuentas_pagar" 
											name="strDepartamento_ordenes_compra_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese departamento" maxlength="250">
									</input>
                                </div>
                                <!--Autocomplete que contiene las sucursales activas-->
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                                	<!-- Caja de texto oculta que se utiliza para recuperar el id de la sucursal seleccionada-->
									<input id="txtSucursalID_ordenes_compra_cuentas_pagar" 
									       name="intSucursalID_ordenes_compra_cuentas_pagar" type="hidden" value="">
									</input>
                                    <input  class="form-control" id="txtSucursal_ordenes_compra_cuentas_pagar" 
											name="strSucursal_ordenes_compra_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese sucursal" maxlength="250">
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
									<label for="txtObservaciones_ordenes_compra_cuentas_pagar">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_ordenes_compra_cuentas_pagar" 
											name="strObservaciones_ordenes_compra_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
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
									<input id="txtNumDetalles_ordenes_compra_cuentas_pagar" 
										   name="intNumDetalles_ordenes_compra_cuentas_pagar" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la orden de compra</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Parque vehicular-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id del renglón seleccionado-->
																<input id="txtRenglon_detalles_ordenes_compra_cuentas_pagar" 
																	   name="intRenglon_detalles_ordenes_compra_cuentas_pagar" type="hidden" value="">
																</input>
																<label for="cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar">Parque vehicular</label>
															</div>
															<div id="divCmbMsjValidacion" class="col-md-12">
																<select class="form-control" id="cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar" 
																 		name="strParqueVehicular_detalles_ordenes_compra_cuentas_pagar" tabindex="1">
																	<option value="">Seleccione una opción</option>
																	<option value="SI">SI</option>
																	<option value="NO">NO</option>
							                     				</select>
															</div>
														</div>
													</div>
													<!--Autocomplete que contiene los vehículos activos-->
													<div id="divVehiculo_detalles_ordenes_compra_cuentas_pagar" class="col-sm-9 col-md-9 col-lg-9 col-xs-12 no-mostrar">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id del  vehículo seleccionado-->
																<input id="txtVehiculoID_detalles_ordenes_compra_cuentas_pagar" 
																	   name="intVehiculoID_detalles_ordenes_compra_cuentas_pagar"  type="hidden" value="">
																</input>
																<label for="txtVehiculo_detalles_ordenes_compra_cuentas_pagar">Vehículo</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtVehiculo_detalles_ordenes_compra_cuentas_pagar" 
																		name="strVehiculo_detalles_ordenes_compra_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese vehículo" maxlength="250">
																</input>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Tipo de gasto-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar">Tipo de gasto</label>
															</div>
															<div id="divCmbMsjValidacion" class="col-md-12">
																<select class="form-control" id="cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar" 
																 		name="strTipo_detalles_ordenes_compra_cuentas_pagar" tabindex="1">
																	<option value="">Seleccione una opción</option>
																	<option value="GASTOS DE VENTA">GASTOS DE VENTA</option>
																	<option value="GASTOS DE ADMINISTRACION">GASTOS DE ADMINISTRACION</option>
																	<option value="GASTOS CORPORATIVOS">GASTOS CORPORATIVOS</option>
																	<option value="GASTOS FINANCIEROS">GASTOS FINANCIEROS</option>
							                     				</select>
															</div>
														</div>
													</div>
													<!--Combobox que contiene las sucursales activas-->
													<div id="divCmbSucursalID_detalles_ordenes_compra_cuentas_pagar" class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbSucursalID_detalles_ordenes_compra_cuentas_pagar">Sucursal</label>
															</div>
															<div id="divCmbMsjValidacion" class="col-md-12">
																<select class="form-control" id="cmbSucursalID_detalles_ordenes_compra_cuentas_pagar" 
																 		name="intSucursalID_detalles_ordenes_compra_cuentas_pagar" tabindex="1">
							                     				</select>
															</div>
														</div>
													</div>
													<!--Combobox que contiene los módulos activos-->
													<div id="divCmbModuloID_detalles_ordenes_compra_cuentas_pagar" class="col-sm-3 col-md-3 col-lg-3 col-xs-12 no-mostrar">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbModuloID_detalles_ordenes_compra_cuentas_pagar">Departamento</label>
															</div>
															<div id="divCmbMsjValidacion" class="col-md-12">
																<select class="form-control" id="cmbModuloID_detalles_ordenes_compra_cuentas_pagar" 
																 		name="intModuloID_detalles_ordenes_compra_cuentas_pagar" tabindex="1">
							                     				</select>
															</div>
														</div>
													</div>
													<!--Combobox que contiene los tipos de gastos activos (correspondientes al tipo)-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar">Gasto</label>
															</div>
															<div id="divCmbMsjValidacion" class="col-md-12">
																<select class="form-control" id="cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar" 
																 		name="strGastoTipoID_detalles_ordenes_compra_cuentas_pagar" tabindex="1">
							                     				</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Concepto-->
													<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtConcepto_detalles_ordenes_compra_cuentas_pagar">
																	Concepto
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtConcepto_detalles_ordenes_compra_cuentas_pagar" 
																		name="strConcepto_detalles_ordenes_compra_cuentas_pagar" type="text" value="" 
																		tabindex="1" placeholder="Ingrese concepto" maxlength="250">
																</input>
															</div>
														</div>
													</div>
												    <!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_ordenes_compra_cuentas_pagar">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_ordenes_compra_cuentas_pagar" 
																		id="txtCantidad_detalles_ordenes_compra_cuentas_pagar" 
																		name="intCantidad_detalles_ordenes_compra_cuentas_pagar" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="21">
																</input>
															</div>
														</div>
													</div>
													
												</div>
												<div class="row">
													<!--Precio unitario-->
													<div id="divPrecioUnitario_detalles_ordenes_compra_cuentas_pagar" class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar">Precio unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control precio_unitario_ordenes_compra_cuentas_pagar" id="txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar" 
																		name="intPrecioUnitario_detalles_ordenes_compra_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese precio unitario" maxlength="21">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control descuento_ordenes_compra_cuentas_pagar" id="txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar" 
																		name="intPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar" type="text" value="0.00" 
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
																<input id="txtTasaCuotaIva_detalles_ordenes_compra_cuentas_pagar" 
																	   name="intTasaCuotaIva_detalles_ordenes_compra_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar">IVA %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar" 
																		name="intPorcentajeIva_detalles_ordenes_compra_cuentas_pagar" type="text" value="" 
																		tabindex="1" placeholder="Ingrese IVA" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--IVA unitario -->
													<div id="divIvaUnitario_detalles_ordenes_compra_cuentas_pagar" class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtIvaUnitario_detalles_ordenes_compra_cuentas_pagar">IVA unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_ordenes_compra_cuentas_pagar" id="txtIvaUnitario_detalles_ordenes_compra_cuentas_pagar" 
																		name="intIvaUnitario_detalles_ordenes_compra_cuentas_pagar" type="text" value="" 
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
																<input id="txtTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar" 
																	   name="intTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el tipo de la tasa o cuota del impuesto de IEPS-->
																<input id="txtTipoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar" 
																	   name="strTipoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el factor de la tasa o cuota del impuesto de IEPS-->
																<input id="txtFactorTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar" 
																	   name="strFactorTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el valor mínimo de la tasa o cuota del impuesto de IEPS-->
																<input id="txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar" 
																	   name="intValorMinimoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar">IEPS %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar" 
																		name="intPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar" type="text" value="" 
																		tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--IEPS unitario -->
													<div id="divIepsUnitario_detalles_ordenes_compra_cuentas_pagar"  class="col-sm-3 col-md-3 col-lg-3 col-xs-12 no-mostrar">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar">IEPS unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_ordenes_compra_cuentas_pagar" id="txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar" 
																		name="intIepsUnitario_detalles_ordenes_compra_cuentas_pagar" type="text" value="" 
																		tabindex="1" placeholder="Ingrese importe" maxlength="19">
																</input>
															</div>
														</div>
													</div>
													<!--Retención de ISR -->
													<div id="divRetencionIsr_detalles_ordenes_compra_cuentas_pagar"  class="col-sm-3 col-md-3 col-lg-3 col-xs-12 no-mostrar">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar la retención de ISR, de esta manera, se  mostrara u ocultara el div (en caso de que el tipo de gasto contenga retención de ISR  se pondrá como obligatorio el campo retención de ISR %)-->
																<input id="txtRetencionIsr_detalles_ordenes_compra_cuentas_pagar" 
																	   name="strRetencionIsr_detalles_ordenes_compra_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<label for="cmbPorcentajeRetencionIsr_detalles_ordenes_compra_cuentas_pagar">Retención de ISR %</label>
															</div>
															<div id="divCmbMsjValidacion" class="col-md-12">
																<select class="form-control" id="cmbPorcentajeRetencionIsr_detalles_ordenes_compra_cuentas_pagar" 
																		name="intPorcentajeRetencionIsr_detalles_ordenes_compra_cuentas_pagar" tabindex="1">
																	<option value="">Seleccione una opción</option>
																	<option value="0.100000">0.100000</option>
																</select>
															</div>
														</div>
													</div>
													<!--Retención de IVA -->
													<div id="divRetencionIva_detalles_ordenes_compra_cuentas_pagar"  class="col-sm-3 col-md-3 col-lg-3 col-xs-10 no-mostrar">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar la retención de IVA, de esta manera, se  mostrara u ocultara el div (en caso de que el tipo de gasto contenga retención de IVA  se pondrá como obligatorio el campo retención de IVA %)-->
																<input id="txtRetencionIva_detalles_ordenes_compra_cuentas_pagar" 
																	   name="strRetencionIva_detalles_ordenes_compra_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<label for="cmbPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar">Retención de IVA %</label>
															</div>
															<div id="divCmbMsjValidacion" class="col-md-12">
																<select class="form-control" id="cmbPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar" 
																		name="intPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar" tabindex="1">
																	
																	
																</select>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_detalles_ordenes_compra_cuentas_pagar"
					                                			onclick="agregar_renglon_detalles_ordenes_compra_cuentas_pagar();" 
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
													<table class="table-hover movil" id="dg_detalles_ordenes_compra_cuentas_pagar">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Concepto</th>
																<th class="movil">Gasto</th>
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
																<!--Acumulado de las retenciones de ISR-->
															<tr id="divAcumRetencionIsr_detalles_ordenes_compra_cuentas_pagar" class="movil no-mostrar">
																<td class="movil tb1">
																	<strong>Ret. ISR</strong>
																</td>
																<td class="movil tb2"></td>
																<td  class="movil tb3"></td>
																<td class="movil tb4"></td>
																<td class="movil tb5"></td>
																<td class="movil tb6"></td>
																<td class="movil tb7"></td>
																<td class="movil tb8"></td>
																<td class="movil tb9">
																	<strong id="acumRetencionIsr_detalles_ordenes_compra_cuentas_pagar"></strong>
																</td>
																<td class="movil"></td>
															</tr>
															<!--Acumulado de las retenciones de IVA-->
															<tr id="divAcumRetencionIva_detalles_ordenes_compra_cuentas_pagar" class="movil no-mostrar">
																<td class="movil tc1">
																	<strong>Ret. IVA</strong>
																</td>
																<td class="movil tc2"></td>
																<td  class="movil tc3"></td>
																<td class="movil tc4"></td>
																<td class="movil tc5"></td>
																<td class="movil tc7"></td>
																<td class="movil tc8"></td>
																<td class="movil tc9"></td>
																<td class="movil tc10">
																	<strong id="acumRetencionIva_detalles_ordenes_compra_cuentas_pagar"></strong>
																</td>
																<td class="movil"></td>
															</tr>
															<!--Totales-->
															<tr class="movil">
																<td class="movil t1">
																	<strong>Total</strong>
																</td>
																<td class="movil t2"></td>
																<td  class="movil t3">
																	<strong id="acumCantidad_detalles_ordenes_compra_cuentas_pagar"></strong>
																</td>
																<td class="movil t4"></td>
																<td class="movil t5">
																	<strong id="acumDescuento_detalles_ordenes_compra_cuentas_pagar"></strong>
																</td>
																<td class="movil t6">
																	<strong id="acumSubtotal_detalles_ordenes_compra_cuentas_pagar"></strong>
																</td>
																<td class="movil t7">
																	<strong id="acumIva_detalles_ordenes_compra_cuentas_pagar"></strong>
																</td>
																<td class="movil t8">
																	<strong  id="acumIeps_detalles_ordenes_compra_cuentas_pagar"></strong>
																</td>
																<td class="movil t9">
																	<strong id="acumTotal_detalles_ordenes_compra_cuentas_pagar"></strong>
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
																<strong id="numElementos_detalles_ordenes_compra_cuentas_pagar">0</strong> encontrados
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
							<div id="divRetencionIsr_ordenes_compra_cuentas_pagar"  class="col-sm-6 col-md-6 col-lg-6 col-xs-12 pull-right no-mostrar">
									<div class="form-group">
											<!--Porcentaje de ISR-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<input id="txtPorcentajeRetencionID_ordenes_compra_cuentas_pagar" name="intPorcentajeRetencionID_ordenes_compra_cuentas_pagar" type="hidden" value="">
														</input>
														<label for="txtPorcentajeIsr_ordenes_compra_cuentas_pagar">Retención de ISR %</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control" id="txtPorcentajeIsr_ordenes_compra_cuentas_pagar" 
																name="intPorcentajeIsr_ordenes_compra_cuentas_pagar" type="text" value="" 
																tabindex="1" placeholder="Ingrese retención de ISR" maxlength="250">
														</input>
													</div>
												</div>
											</div>
											<!--Importe retenido-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<label for="txtImporteRetenido_ordenes_compra_cuentas_pagar">Importe de ISR</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control moneda_ordenes_compra_cuentas_pagar" id="txtImporteRetenido_ordenes_compra_cuentas_pagar" 
																name="intImporteRetenido_ordenes_compra_cuentas_pagar" type="text" value="" 
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
							<button class="btn btn-success" id="btnGuardar_ordenes_compra_cuentas_pagar"  
									onclick="validar_ordenes_compra_cuentas_pagar();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!---Autorizar o rechazar registro-->
							<button class="btn btn-default" id="btnAutorizar_ordenes_compra_cuentas_pagar"  
									onclick="abrir_autorizar_ordenes_compra_cuentas_pagar('','','Autorizar');"  title="Autorizar o Rechazar" tabindex="3" disabled>
								<span class="fa fa-check-square-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_ordenes_compra_cuentas_pagar"  
									onclick="abrir_proveedor_ordenes_compra_cuentas_pagar('');"  
									title="Enviar correo electrónico" tabindex="4" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_ordenes_compra_cuentas_pagar"  
									onclick="reporte_registro_ordenes_compra_cuentas_pagar('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
		                    <!--Subir varios archivos-->
		                    <span  class="fileupload-buttonbar" tabindex="6">
		                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_ordenes_compra_cuentas_pagar" disabled>
		                        	<span class="fa fa-upload"></span>
		                        	<input id="archivo_varios_ordenes_compra_cuentas_pagar" 
		                        		   name="archivo_varios_ordenes_compra_cuentas_pagar[]" type="file" multiple 
		                        		   accept="text/xml,application/pdf" onchange="subir_archivos_modal_ordenes_compra_cuentas_pagar('Editar');">
		                        	</input>
		                        </span>
		                    </span>
		                    <!--Descargar archivo-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_ordenes_compra_cuentas_pagar"  
									onclick="descargar_archivos_ordenes_compra_cuentas_pagar('','');"  title="Descargar archivo" tabindex="7" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Eliminar archivo-->
							<button class="btn btn-default" id="btnEliminarArchivo_ordenes_compra_cuentas_pagar"  
									onclick="eliminar_archivos_ordenes_compra_cuentas_pagar('')"  title="Eliminar archivo" tabindex="8" disabled>
								<span class="glyphicon glyphicon-export"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_ordenes_compra_cuentas_pagar"  
									onclick="cambiar_estatus_ordenes_compra_cuentas_pagar('','ACTIVO');"  title="Desactivar" tabindex="9" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_ordenes_compra_cuentas_pagar"  
									onclick="cambiar_estatus_ordenes_compra_cuentas_pagar('','INACTIVO');"  title="Restaurar" tabindex="10" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_ordenes_compra_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_ordenes_compra_cuentas_pagar();" 
									title="Cerrar"  tabindex="11">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Ordenes de Compra-->
	</div><!--#OrdenesCompraCuentasPagarContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_ordenes_compra_cuentas_pagar" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>
	<!-- /.Plantilla para cargar las sucursales en el combobox-->  
	<script id="sucursales_detalles_ordenes_compra_cuentas_pagar" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#sucursales}}
		<option value="{{value}}">{{nombre}}</option>
		{{/sucursales}} 
	</script>
	<!-- /.Plantilla para cargar los módulos en el combobox-->  
	<script id="modulos_detalles_ordenes_compra_cuentas_pagar" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#modulos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/modulos}} 
	</script>
	<!-- /.Plantilla para cargar los tipos de gastos en el combobox-->  
	<script id="gastos_tipos_detalles_ordenes_compra_cuentas_pagar" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#gastos_tipos}}
		<option value="{{value}}">{{nombre}}</option>
		{{/gastos_tipos}} 
	</script>

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaOrdenesCompraCuentasPagar = 0;
		var strUltimaBusquedaOrdenesCompraCuentasPagar = "";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
		var intNumDecimalesMostrarOrdenesCompraCuentasPagar = <?php echo NUM_DECIMALES_MOSTRAR_CUENTAS_PAGAR ?>;
		//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
		var intNumDecimalesCantidadBDOrdenesCompraCuentasPagar = <?php echo NUM_DECIMALES_CANTIDAD_OC_CUENTAS_PAGAR ?>;
		var intNumDecimalesPrecioUnitBDOrdenesCompraCuentasPagar = <?php echo NUM_DECIMALES_PRECIO_UNIT_OC_CUENTAS_PAGAR ?>;
		var intNumDecimalesDescUnitBDOrdenesCompraCuentasPagar = <?php echo NUM_DECIMALES_DESCUENTO_UNIT_OC_CUENTAS_PAGAR ?>;
		var intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar = <?php echo NUM_DECIMALES_IVA_UNIT_OC_CUENTAS_PAGAR ?>;
		var intNumDecimalesIepsUnitBDOrdenesCompraCuentasPagar = <?php echo NUM_DECIMALES_IEPS_UNIT_OC_CUENTAS_PAGAR ?>;
		//Variable que se utiliza para asignar la descripción del tipo de gasto: Vigilancia Y Seguridad
		var strGastoTipoIDGAdminVigSegOrdenesCompraCuentasPagar = <?php echo GASTO_TIPO_GADMINVIGSEG ?>;
		//Variable que se utiliza para asignar la descripción del tipo de gasto: Fletes y Acarreos
		var strGastoTipoIDFletesAcarreosOrdenesCompraCuentasPagar = <?php echo GASTO_TIPO_FLETESACARREOS ?>;

		//Variable que se utiliza para asignar el id del porcentaje de retención ISR base
		var intPorcentajeRetencionBaseIDOrdenesCompraCuentasPagar = <?php echo PORCENTAJE_ISR_BASE ?>;

		//Variable que se utiliza para asignar el id del régimen fiscal: Régimen Simplificado de Confianza
		var intRegimenFiscalIDResicoOrdenesCompraCuentasPagar = <?php echo REGIMEN_FISCAL_RESICO ?>;

		//Variable que se utiliza para asignar la descripción de la cuenta 602
		var strCuenta602OrdenesCompraCuentasPagar = <?php echo DESCRIPCION_CUENTA_602 ?>;
		//Variable que se utiliza para asignar la descripción de la cuenta 603
		var strCuenta603OrdenesCompraCuentasPagar = <?php echo DESCRIPCION_CUENTA_603 ?>;

		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDOrdenesCompraCuentasPagar = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseOrdenesCompraCuentasPagar = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoOrdenesCompraCuentasPagar = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar objeto del modal Autorizar Orden de Compra
		var objAutorizarOrdenesCompraCuentasPagar = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarOrdenesCompraCuentasPagar = null;
		//Variable que se utiliza para asignar objeto del modal Ordenes de Compra
		var objOrdenesCompraCuentasPagar = null;

		//Array que contiene los id´s de las cajas de texto que se utilizan para calcular la fecha de vencimiento
		var arrFechaVencimientoOrdenesCompraCuentasPagar  = {fecha: '#txtFecha_ordenes_compra_cuentas_pagar',
															 condicionesPago: '#cmbCondicionesPago_ordenes_compra_cuentas_pagar',
															 diasCredito: '#txtDiasCredito_ordenes_compra_cuentas_pagar',
															 fechaVencimiento: '#txtFechaVencimiento_ordenes_compra_cuentas_pagar'
															};


		/*******************************************************************************************************************
		Funciones del objeto Detalles de la orden de compra
		*********************************************************************************************************************/
		// Constructor del objeto detalles
		var objDetallesOrdenOrdenesCompraCuentasPagar;
		function DetallesOrdenOrdenesCompraCuentasPagar(detalles)
		{
			this.arrDetalles = detalles;
		}

		//Función para obtener todos los detalles de la orden de compra
		DetallesOrdenOrdenesCompraCuentasPagar.prototype.getDetalles = function() {
		    return this.arrDetalles;
		}

		//Función para agregar una detalle al objeto 
		DetallesOrdenOrdenesCompraCuentasPagar.prototype.setDetalle = function (detalle){
			this.arrDetalles.push(detalle);
		}

		//Función para obtener un detalle del objeto
		DetallesOrdenOrdenesCompraCuentasPagar.prototype.getDetalle = function(index) {
		    return this.arrDetalles[index];
		}

		//Función para modificar un detalle del objeto
		DetallesOrdenOrdenesCompraCuentasPagar.prototype.modificarDetalle = function (index, detalle){
			this.arrDetalles[index] = detalle;
		}

		//Función para eliminar un detalle del objeto
		DetallesOrdenOrdenesCompraCuentasPagar.prototype.eliminarDetalle = function (index){
			if(index != -1) 
			{
				this.arrDetalles.splice(index, 1);
			}
		}

		//Función para cambiar las posiciones de los detalles en el objeto
		DetallesOrdenOrdenesCompraCuentasPagar.prototype.swap = function(index_A, index_B) {
		    var input = this.arrDetalles;
		 
		    var temp = input[index_A];
		    input[index_A] = input[index_B];
		    input[index_B] = temp;
		}

		/*******************************************************************************************************************
		Funciones del objeto Detalle de la orden de compra
		*********************************************************************************************************************/
		//Constructor del objeto detalle
		var objDetalleOrdenOrdenesCompraCuentasPagar;
		function DetalleOrdenOrdenesCompraCuentasPagar(sucursalID, moduloID, gastoTipoID, gastoTipo, 
										               tipoGasto, vehiculoID, vehiculo, parqueVehicular,
										               concepto, cantidad,  precioUnitario, 
										               porcentajeDescuento, descuentoUnitario, 
										               tasaCuotaIva, importeIva, porcentajeIva, ivaUnitario, 
										               tasaCuotaIeps, importeIeps, porcentajeIeps, iepsUnitario, 
										               tipoTasaCuotaIeps, factorTasaCuotaIeps, valorMinimoTasaCuotaIeps, 
										               retencionIsr, importeRetencionIsr, porcentajeRetencionIsr,
										               retencionIsrUnitario, retencionIva, importeRetencionIva,
										               porcentajeRetencionIva, retencionIvaUnitario)
		{
		    this.intSucursalID = sucursalID;
		    this.intModuloID = moduloID;
		    this.intGastoTipoID = gastoTipoID;
		    this.strGastoTipo = gastoTipo;
		    this.strTipoGasto = tipoGasto;
		    this.intVehiculoID = vehiculoID;
		    this.strVehiculo = vehiculo;
		    this.strParqueVehicular = parqueVehicular;
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
		    this.strRetencionIsr = retencionIsr;
		    this.intImporteRetencionIsr = importeRetencionIsr;
		    this.intPorcentajeRetencionIsr = porcentajeRetencionIsr;
		    this.intRetencionIsrUnitario = retencionIsrUnitario;
		    this.strRetencionIva = retencionIva;
		    this.intImporteRetencionIva = importeRetencionIva;
		    this.intPorcentajeRetencionIva = porcentajeRetencionIva;
		    this.intRetencionIvaUnitario = retencionIvaUnitario;
		}


		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_ordenes_compra_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_pagar/ordenes_compra/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_ordenes_compra_cuentas_pagar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosOrdenesCompraCuentasPagar = data.row;
					//Separar la cadena 
					var arrPermisosOrdenesCompraCuentasPagar = strPermisosOrdenesCompraCuentasPagar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosOrdenesCompraCuentasPagar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosOrdenesCompraCuentasPagar[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_ordenes_compra_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosOrdenesCompraCuentasPagar[i]=='GUARDAR') || (arrPermisosOrdenesCompraCuentasPagar[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_ordenes_compra_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es ADJUNTAR
						else if(arrPermisosOrdenesCompraCuentasPagar[i]=='ADJUNTAR')
						{
							//Habilitar el control (botón Adjuntar)
							$('#btnAdjuntar_ordenes_compra_cuentas_pagar').removeAttr('disabled');
							//Habilitar el control (botón eliminar archivo)
							$('#btnEliminarArchivo_ordenes_compra_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosOrdenesCompraCuentasPagar[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_ordenes_compra_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraCuentasPagar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_ordenes_compra_cuentas_pagar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_ordenes_compra_cuentas_pagar();
						}
						else if(arrPermisosOrdenesCompraCuentasPagar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_ordenes_compra_cuentas_pagar').removeAttr('disabled');
							$('#btnRestaurar_ordenes_compra_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_ordenes_compra_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraCuentasPagar[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_ordenes_compra_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraCuentasPagar[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_ordenes_compra_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraCuentasPagar[i]=='AUTORIZAR')//Si el indice es AUTORIZAR
						{
							//Habilitar el control (botón autorizar)
							$('#btnAutorizar_ordenes_compra_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_ordenes_compra_cuentas_pagar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_ordenes_compra_cuentas_pagar() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaOrdenesCompraCuentasPagar =($('#txtFechaInicialBusq_ordenes_compra_cuentas_pagar').val()+$('#txtFechaFinalBusq_ordenes_compra_cuentas_pagar').val()+$('#txtProveedorIDBusq_ordenes_compra_cuentas_pagar').val()+$('#cmbEstatusBusq_ordenes_compra_cuentas_pagar').val()+$('#txtBusqueda_ordenes_compra_cuentas_pagar').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaOrdenesCompraCuentasPagar != strUltimaBusquedaOrdenesCompraCuentasPagar)
			{
				intPaginaOrdenesCompraCuentasPagar = 0;
				strUltimaBusquedaOrdenesCompraCuentasPagar = strNuevaBusquedaOrdenesCompraCuentasPagar;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_pagar/ordenes_compra/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_compra_cuentas_pagar').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_compra_cuentas_pagar').val()),
					 intProveedorID: $('#txtProveedorIDBusq_ordenes_compra_cuentas_pagar').val(),
					 strEstatus: $('#cmbEstatusBusq_ordenes_compra_cuentas_pagar').val(),
					 strBusqueda: $('#txtBusqueda_ordenes_compra_cuentas_pagar').val(),
					 intPagina: intPaginaOrdenesCompraCuentasPagar,
					 strPermisosAcceso: $('#txtAcciones_ordenes_compra_cuentas_pagar').val()
					},
					function(data){
						$('#dg_ordenes_compra_cuentas_pagar tbody').empty();
						var tmpOrdenesCompraCuentasPagar = Mustache.render($('#plantilla_ordenes_compra_cuentas_pagar').html(),data);
						$('#dg_ordenes_compra_cuentas_pagar tbody').html(tmpOrdenesCompraCuentasPagar);
						$('#pagLinks_ordenes_compra_cuentas_pagar').html(data.paginacion);
						$('#numElementos_ordenes_compra_cuentas_pagar').html(data.total_rows);
						intPaginaOrdenesCompraCuentasPagar = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_ordenes_compra_cuentas_pagar(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_pagar/ordenes_compra/';

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
			if ($('#chbImprimirDetalles_ordenes_compra_cuentas_pagar').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_ordenes_compra_cuentas_pagar').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_ordenes_compra_cuentas_pagar').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_compra_cuentas_pagar').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_compra_cuentas_pagar').val()),
										'intProveedorID': $('#txtProveedorIDBusq_ordenes_compra_cuentas_pagar').val(),
										'strEstatus': $('#cmbEstatusBusq_ordenes_compra_cuentas_pagar').val(), 
										'strBusqueda': $('#txtBusqueda_ordenes_compra_cuentas_pagar').val(),
										'strDetalles': $('#chbImprimirDetalles_ordenes_compra_cuentas_pagar').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_ordenes_compra_cuentas_pagar(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'cuentas_pagar/ordenes_compra/get_reporte_registro',
							'data' : {
										'intOrdenCompraID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

	
		//Función para subir archivos de un registro desde el grid view
		function subir_archivos_grid_ordenes_compra_cuentas_pagar(ordenCompraID)
		{
			//Crear instancia al objeto del formulario
	        var formData = new FormData($("#frmOrdenesCompraCuentasPagar")[0]);
			//Agregar campos al objeto del formulario
			formData.append("intOrdenCompraID_ordenes_compra_cuentas_pagar", ordenCompraID);
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDGridOrdenesCompraCuentasPagar  = "archivo_varios_ordenes_compra_cuentas_pagar"+ordenCompraID;
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDGridOrdenesCompraCuentasPagar);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDGridOrdenesCompraCuentasPagar)[0].files;
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
					formData.append("archivo_varios_ordenes_compra_cuentas_pagar[]", document.getElementById(strBotonArchivoIDGridOrdenesCompraCuentasPagar).files[intCont]);
				 	
				}
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Limpia ruta del archivo cargado
		        $('#'+strBotonArchivoIDGridOrdenesCompraCuentasPagar).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_ordenes_compra_cuentas_pagar('error', strMensajeError);
	        }
	        else
	        {
	        	//Hacer un llamado al método del controlador para subir archivos del registro
	            $.ajax({
	                url: 'cuentas_pagar/ordenes_compra/subir_archivos',
	                type: "POST",
	                data: formData,
	                contentType: false,
	                processData: false,
	                success: function(data)
	                {
	                    //Limpia ruta del archivo cargado
		         		$('#'+strBotonArchivoIDGridOrdenesCompraCuentasPagar).val('');
						//Subida finalizada.
						if (data.resultado)
						{
		         		   //Hacer llamado a la función  para cargar  los registros en el grid
			           	   paginacion_ordenes_compra_cuentas_pagar();  
						}
                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    		mensaje_ordenes_compra_cuentas_pagar(data.tipo_mensaje, data.mensaje);
	                }
            	});

	        }

		}

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_ordenes_compra_cuentas_pagar(ordenCompraID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intOrdenCompraID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(ordenCompraID == '')
			{
				intOrdenCompraID = $('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val();
				strFolio = $('#txtFolio_ordenes_compra_cuentas_pagar').val();
			}
			else
			{
				intOrdenCompraID = ordenCompraID;
				strFolio = folio;
			}


			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'cuentas_pagar/ordenes_compra/descargar_archivos',
							'data' : {
										'intOrdenCompraID': intOrdenCompraID,
										'strFolio': strFolio				
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);
		}

		//Función que se utiliza para eliminar los archivos del registro seleccionado
		function eliminar_archivos_ordenes_compra_cuentas_pagar(id)
		{

			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;

			//Si no existe id, significa que se eliminara el archivo desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para eliminar carpeta que contiene los archivos del registro
			$.post('cuentas_pagar/ordenes_compra/eliminar_carpeta_registro',
			     {intOrdenCompraID: intID
			     },
			     function(data) {
			       
			        if(data.resultado)
			        {
			         	//Hacer llamado a la función  para cargar  los registros en el grid
		          	    paginacion_ordenes_compra_cuentas_pagar();
		          	    //Si el id del registro se obtuvo del modal
						if(id == '')
						{
							//Ocultar los siguientes botones
							$('#btnDescargarArchivo_ordenes_compra_cuentas_pagar').hide();
							$('#btnEliminarArchivo_ordenes_compra_cuentas_pagar').hide();    
						}
			        }
		        	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		       		mensaje_ordenes_compra_cuentas_pagar(data.tipo_mensaje, data.mensaje);
			       
			     },
			    'json');
		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_ordenes_compra_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_ordenes_compra_cuentas_pagar').empty();
					var temp = Mustache.render($('#monedas_ordenes_compra_cuentas_pagar').html(), data);
					$('#cmbMonedaID_ordenes_compra_cuentas_pagar').html(temp);
				},
				'json');
		}

		//Regresar el porcentaje de retención ISR base
		function cargar_porcentaje_isr_base_ordenes_compra_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/porcentaje_retencion_isr/get_datos',
			       {
			       		strBusqueda:intPorcentajeRetencionBaseIDOrdenesCompraCuentasPagar,
			       		strTipo: 'id'
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				            $('#txtPorcentajeRetencionID_ordenes_compra_cuentas_pagar').val(data.row.porcentaje_retencion_id);
				            $('#txtPorcentajeIsr_ordenes_compra_cuentas_pagar').val(data.row.porcentaje);
			       	    }
			       },
			       'json');
		}

		//Regresar sucursales activas para cargarlas en el combobox
		function cargar_sucursales_detalles_ordenes_compra_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box', {},
				function(data)
				{
					$('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').empty();
					var temp = Mustache.render($('#sucursales_detalles_ordenes_compra_cuentas_pagar').html(), data);
					$('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').html(temp);
				},
				'json');
		}


		//Regresar módulos activos para cargarlos en el combobox
		function cargar_modulos_detalles_ordenes_compra_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los módulos que se encuentran activos 
			$.post('crm/modulos/get_combo_box', {},
				function(data)
				{
					$('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').empty();
					var temp = Mustache.render($('#modulos_detalles_ordenes_compra_cuentas_pagar').html(), data);
					$('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').html(temp);
				},
				'json');
		}

		//Regresar gastos activos para cargarlos en el combobox
		function cargar_gastos_detalles_ordenes_compra_cuentas_pagar(intGastoTipoID = 0)
		{	
			//Asignar el tipo de gasto
			var strTipo = $('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').val();
			//Asignar el parque vehicular
			var strParqueVehicular = $('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').val();

			//Hacer un llamado al método del controlador para regresar los gastos que se encuentran activos 
			$.post('cuentas_pagar/gastos_tipos/get_combo_box/'+strTipo+'/'+strParqueVehicular+'/orden_compra', {},
				function(data)
				{
					$('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').empty();
					var temp = Mustache.render($('#gastos_tipos_detalles_ordenes_compra_cuentas_pagar').html(), data);
					$('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').html(temp);

					//Si existe id del tipo de gasto
					if(intGastoTipoID > 0)
					{
						//Asignar el id del tipo de gasto
						$('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').val(intGastoTipoID);
					}
				},
				'json');
		}


		
		/*******************************************************************************************************************
		Funciones del modal Autorizar Orden de Compra
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_autorizar_ordenes_compra_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmAutorizarOrdenesCompraCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_ordenes_compra_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmAutorizarOrdenesCompraCuentasPagar').find('input[type=hidden]').val('');
			//Agregar clase no-mostrar para ocultar div que contiene el estatus
			$('#divEstatus_autorizar_ordenes_compra_cuentas_pagar').addClass("no-mostrar");
		    $('#divEncabezadoModal_autorizar_ordenes_compra_cuentas_pagar').addClass("estatus-ACTIVO");
		}

		//Función que se utiliza para abrir el modal
		function abrir_autorizar_ordenes_compra_cuentas_pagar(id, folio, tipoAccion)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_autorizar_ordenes_compra_cuentas_pagar();
			
			//Variables que se utilizan para asignar los datos del registro
			var intReferenciaID = 0;
			var strFolio = '';

			//Si no existe id, significa que se aplicará autorización (o rechazo) desde el modal
			if(id == '')
			{
				intReferenciaID = $('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val();
				strFolio =  $('#txtFolio_ordenes_compra_cuentas_pagar').val();
				$('#txtModalOrdenesCompra_autorizar_ordenes_compra_cuentas_pagar').val('SI');
			}
			else
			{
				intReferenciaID = id;
				strFolio = folio;
				$('#txtModalOrdenesCompra_autorizar_ordenes_compra_cuentas_pagar').val('NO');
			}

			//Asignar datos del registro seleccionado
			$('#txtReferenciaID_autorizar_ordenes_compra_cuentas_pagar').val(intReferenciaID);
			$('#txtTipoAccion_autorizar_ordenes_compra_cuentas_pagar').val(tipoAccion);
			$('#txtFolio_autorizar_ordenes_compra_cuentas_pagar').val(strFolio);

			//Si el tipo de acción corresponde a Guardar
			if(tipoAccion == 'Guardar')
			{
				//Cambiar título del modal
				$('#tituloModal_autorizar_ordenes_compra_cuentas_pagar').text('Notificar Orden de Compra');
				$('#txtMensaje_autorizar_ordenes_compra_cuentas_pagar').val('Favor de autorizar la orden de compra general '+ strFolio);
				//Cargar el treeview
				get_treeview_usuarios_autorizar_ordenes_compra_cuentas_pagar('');
			}
			else
			{
				//Quitar clase no-mostrar para mostrar div que contiene el estatus
				$('#divEstatus_autorizar_ordenes_compra_cuentas_pagar').removeClass("no-mostrar");
				//Cambiar título del modal
				$('#tituloModal_autorizar_ordenes_compra_cuentas_pagar').text('Autorizar Orden de Compra');
				//Cargar el treeview
				get_treeview_usuarios_autorizar_ordenes_compra_cuentas_pagar(intReferenciaID);
			}

			//Abrir modal
			objAutorizarOrdenesCompraCuentasPagar = $('#AutorizarOrdenesCompraCuentasPagarBox').bPopup({
													   appendTo: '#OrdenesCompraCuentasPagarContent', 
							                           contentContainer: 'OrdenesCompraCuentasPagarM', 
							                           zIndex: 2, 
							                           modalClose: false, 
							                           modal: true, 
							                           follow: [true,false], 
							                           followEasing : "linear", 
							                           easing: "linear", 
							                           modalColor: ('#F0F0F0')});
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_autorizar_ordenes_compra_cuentas_pagar()
		{
			try {
				//Cerrar modal
				objAutorizarOrdenesCompraCuentasPagar.close();
				//Eliminar datos del treeview
				$("#treeUsuarios_autorizar_ordenes_compra_cuentas_pagar").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_compra_cuentas_pagar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_autorizar_ordenes_compra_cuentas_pagar()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosAutorizarOrdenesCompraCuentasPagar = [];

			//Recorremos el treeview
			$("#treeUsuarios_autorizar_ordenes_compra_cuentas_pagar").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosAutorizarOrdenesCompraCuentasPagar.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtUsuarios_autorizar_ordenes_compra_cuentas_pagar").val(arrSeleccionadosAutorizarOrdenesCompraCuentasPagar.join('|'));
			
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_ordenes_compra_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmAutorizarOrdenesCompraCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_autorizar_ordenes_compra_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un mensaje'}
											}
										},
										strUsuarios_autorizar_ordenes_compra_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un usuario para este mensaje.'}
											}
										}, 
										strEstatus_autorizar_ordenes_compra_cuentas_pagar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista estatus seleccionado cuando el tipo de acción sea Autorizar
					                                    if($('#txtTipoAccion_autorizar_ordenes_compra_cuentas_pagar').val() === 'Autorizar' && $('#cmbEstatus_autorizar_ordenes_compra_cuentas_pagar').val() == '')
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
			var bootstrapValidator_autorizar_ordenes_compra_cuentas_pagar = $('#frmAutorizarOrdenesCompraCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_autorizar_ordenes_compra_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_autorizar_ordenes_compra_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para guardar la solicitud de autorización
				guardar_autorizar_ordenes_compra_cuentas_pagar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_autorizar_ordenes_compra_cuentas_pagar()
		{
			try
			{
				$('#frmAutorizarOrdenesCompraCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar la autorización (o el rechazo) de un registro
		function guardar_autorizar_ordenes_compra_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para enviar la autorización (o el rechazo) de un registro 
			$.post('cuentas_pagar/ordenes_compra/set_enviar_autorizacion',
			     {intOrdenCompraID: $('#txtReferenciaID_autorizar_ordenes_compra_cuentas_pagar').val(),
			      strUsuarios: $('#txtUsuarios_autorizar_ordenes_compra_cuentas_pagar').val(), 
			      strMensaje:  $('#txtMensaje_autorizar_ordenes_compra_cuentas_pagar').val(),
			      strEstatus:  $('#cmbEstatus_autorizar_ordenes_compra_cuentas_pagar').val(),
			      strTipoAccion:  $('#txtTipoAccion_autorizar_ordenes_compra_cuentas_pagar').val()
			     },
			     function(data) {
			        if(data.resultado)
			        {
			          	//Hacer llamado a la función  para cargar  los registros en el grid
			          	paginacion_ordenes_compra_cuentas_pagar();
			          	//Hacer un llamado a la función para cerrar modal
					  	cerrar_autorizar_ordenes_compra_cuentas_pagar();

					  	//Si el id de la referencia (para la autorización) se recuperó del modal Ordenes de Compra 
					  	if($('#txtModalOrdenesCompra_autorizar_ordenes_compra_cuentas_pagar').val() == 'SI')
					  	{
					  		//Hacer un llamado a la función para cerrar modal Ordenes de Compra 
					 	 	cerrar_ordenes_compra_cuentas_pagar();
					  	}   
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_ordenes_compra_cuentas_pagar(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		/*Función que se utiliza para definir tree view de usuarios con acceso a la función Autorizar del proceso
		 *Ordenes de Compra (módulo Cuentas por Pagar)*/
		function get_treeview_usuarios_autorizar_ordenes_compra_cuentas_pagar(id)
		{
			$('#treeUsuarios_autorizar_ordenes_compra_cuentas_pagar').fancytree({
				source: {
					url: "seguridad/usuarios/get_treeview/AUTORIZAR_ORDENES_COMPRA_CUENTAS_PAGAR/ORDENES DE COMPRA/"+id,
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
		function nuevo_proveedor_ordenes_compra_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmEnviarOrdenesCompraCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedor_ordenes_compra_cuentas_pagar();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_proveedor_ordenes_compra_cuentas_pagar');
		}

		//Función que se utiliza para abrir el modal
		function abrir_proveedor_ordenes_compra_cuentas_pagar(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_proveedor_ordenes_compra_cuentas_pagar();
			//Variables que se utilizan para asignar los datos del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_pagar/ordenes_compra/get_datos',
			       {intOrdenCompraID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtOrdenCompraID_proveedor_ordenes_compra_cuentas_pagar').val(data.row.orden_compra_id);
							$('#txtProveedor_proveedor_ordenes_compra_cuentas_pagar').val(data.row.proveedor);
							$('#txtCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_proveedor_ordenes_compra_cuentas_pagar').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarOrdenesCompraCuentasPagar = $('#EnviarOrdenesCompraCuentasPagarBox').bPopup({
																   appendTo: '#OrdenesCompraCuentasPagarContent', 
										                           contentContainer: 'OrdenesCompraCuentasPagarM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_proveedor_ordenes_compra_cuentas_pagar()
		{
			try {
				//Cerrar modal
				objEnviarOrdenesCompraCuentasPagar.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_proveedor_ordenes_compra_cuentas_pagar();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_proveedor_ordenes_compra_cuentas_pagar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedor_ordenes_compra_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarOrdenesCompraCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar: {
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
			var bootstrapValidator_proveedor_ordenes_compra_cuentas_pagar = $('#frmEnviarOrdenesCompraCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_proveedor_ordenes_compra_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_proveedor_ordenes_compra_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_proveedor_ordenes_compra_cuentas_pagar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_proveedor_ordenes_compra_cuentas_pagar()
		{
			try
			{
				$('#frmEnviarOrdenesCompraCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al proveedor
		function enviar_correo_proveedor_ordenes_compra_cuentas_pagar()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_proveedor_ordenes_compra_cuentas_pagar();
			//Hacer un llamado al método del controlador para enviar correo electrónico al proveedor
			$.post('cuentas_pagar/ordenes_compra/enviar_correo_electronico_proveedor',
					{ 
						intOrdenCompraID: $('#txtOrdenCompraID_proveedor_ordenes_compra_cuentas_pagar').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_proveedor_ordenes_compra_cuentas_pagar').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_proveedor_ordenes_compra_cuentas_pagar();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_proveedor_ordenes_compra_cuentas_pagar();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_compra_cuentas_pagar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_proveedor_ordenes_compra_cuentas_pagar()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_proveedor_ordenes_compra_cuentas_pagar").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_proveedor_ordenes_compra_cuentas_pagar()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_proveedor_ordenes_compra_cuentas_pagar").addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones del modal Ordenes de Compra
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_ordenes_compra_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmOrdenesCompraCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_compra_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmOrdenesCompraCuentasPagar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_ordenes_compra_cuentas_pagar');
			
		    //Eliminar los datos de la tabla detalles de la orden de compra
		    $('#dg_detalles_ordenes_compra_cuentas_pagar tbody').empty();
		    $('#acumCantidad_detalles_ordenes_compra_cuentas_pagar').html('');
		    $('#acumDescuento_detalles_ordenes_compra_cuentas_pagar').html('');
		    $('#acumSubtotal_detalles_ordenes_compra_cuentas_pagar').html('');
		    $('#acumIva_detalles_ordenes_compra_cuentas_pagar').html('');
		    $('#acumIeps_detalles_ordenes_compra_cuentas_pagar').html('');
		    $('#acumTotal_detalles_ordenes_compra_cuentas_pagar').html('');
		    $('#acumRetencionIsr_detalles_ordenes_compra_cuentas_pagar').html('');
		    $('#acumRetencionIva_detalles_ordenes_compra_cuentas_pagar').html('');
			$('#numElementos_detalles_ordenes_compra_cuentas_pagar').html(0);
			//Limpiar contenido de los siguientes combobox
		    $('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').empty();
		    //Hacer un llamado a la función para mostrar u ocultar sucursal y/o módulo
	        mostrar_cmb_detalles_ordenes_compra_cuentas_pagar();
	        //Hacer un llamado a la función para mostrar u ocultar vehículo
	        mostrar_vehiculo_detalles_ordenes_compra_cuentas_pagar();
	        //Hacer un llamado a la función para inicializar elementos del tipo de gasto
	        inicializar_gasto_detalles_ordenes_compra_cuentas_pagar();
	        //Hacer un llamado a la función para inicializar elementos del porcentaje de IEPS
	        inicializar_porcentaje_ieps_detalles_ordenes_compra_cuentas_pagar();
	        //Crear instancia del objeto Detalles de la orden de compra
			objDetallesOrdenOrdenesCompraCuentasPagar = new DetallesOrdenOrdenesCompraCuentasPagar([]);
			//Asignar NO para indicar que no se ha abierto el modal Autorizar Orden de Compra
			$('#txtModalOrdenesCompra_autorizar_ordenes_compra_cuentas_pagar').val('NO');
			//Habilitar todos los elementos del formulario
			$('#frmOrdenesCompraCuentasPagar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_ordenes_compra_cuentas_pagar').val(fechaActual()); 
			$('#txtFechaVencimiento_ordenes_compra_cuentas_pagar').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_ordenes_compra_cuentas_pagar').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_ordenes_compra_cuentas_pagar").show();
			$("#btnAdjuntar_ordenes_compra_cuentas_pagar").show();
			//Habilitar botón Agregar
			$('#btnAgregar_detalles_ordenes_compra_cuentas_pagar').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnAutorizar_ordenes_compra_cuentas_pagar").hide();
			$("#btnEnviarCorreo_ordenes_compra_cuentas_pagar").hide();
			$("#btnImprimirRegistro_ordenes_compra_cuentas_pagar").hide();
			$("#btnDescargarArchivo_ordenes_compra_cuentas_pagar").hide();
			$("#btnEliminarArchivo_ordenes_compra_cuentas_pagar").hide();
			$("#btnDesactivar_ordenes_compra_cuentas_pagar").hide();
			$("#btnRestaurar_ordenes_compra_cuentas_pagar").hide();

			//Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_ordenes_compra_cuentas_pagar();

		}


		//Función para inicializar elementos del proveedor
		function inicializar_proveedor_ordenes_compra_cuentas_pagar()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtDiasCredito_ordenes_compra_cuentas_pagar').val('');
            $('#txtRegimenFiscalID_ordenes_compra_cuentas_pagar').val('');
            $('#txtPorcentajeRetencionID_ordenes_compra_cuentas_pagar').val('');
            $('#txtPorcentajeIsr_ordenes_compra_cuentas_pagar').val('');
            $('#txtImporteRetenido_ordenes_compra_cuentas_pagar').val('');

            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
	        mostrar_retencion_isr_ordenes_compra_cuentas_pagar();
            
		}

		
		
		//Función que se utiliza para cerrar el modal
		function cerrar_ordenes_compra_cuentas_pagar()
		{
			try {
				//Cerrar modal
				objOrdenesCompraCuentasPagar.close();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
			    cerrar_proveedor_ordenes_compra_cuentas_pagar();
				//Si el id de la referencia (para la autorización) se recuperó del modal Ordenes de Compra 
				if($('#txtModalOrdenesCompra_autorizar_ordenes_compra_cuentas_pagar').val() == 'SI')
				{
					//Hacer un llamado a la función para cerrar modal Autorizar Orden de Compra
					cerrar_autorizar_ordenes_compra_cuentas_pagar();
				}
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_compra_cuentas_pagar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_ordenes_compra_cuentas_pagar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_compra_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmOrdenesCompraCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_ordenes_compra_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaEntrega_ordenes_compra_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaVencimiento_ordenes_compra_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strCondicionesPago_ordenes_compra_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una condición de pago'}
											}
										},
										intMonedaID_ordenes_compra_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_ordenes_compra_cuentas_pagar: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_ordenes_compra_cuentas_pagar').val()) !== intMonedaBaseIDOrdenesCompraCuentasPagar)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoOrdenesCompraCuentasPagar)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoOrdenesCompraCuentasPagar
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strProveedor_ordenes_compra_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtProveedorID_ordenes_compra_cuentas_pagar').val() === '')
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
										intPorcentajeIsr_ordenes_compra_cuentas_pagar: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el id del porcentaje de retención ISR
						                                    if(parseInt($('#txtRegimenFiscalID_ordenes_compra_cuentas_pagar').val()) === intRegimenFiscalIDResicoOrdenesCompraCuentasPagar)
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
										intImporteRetenido_ordenes_compra_cuentas_pagar: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el id del porcentaje de retención ISR
						                                    if(parseInt($('#txtRegimenFiscalID_ordenes_compra_cuentas_pagar').val()) === intRegimenFiscalIDResicoOrdenesCompraCuentasPagar)
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
										strSolicita_ordenes_compra_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtSolicitaID_ordenes_compra_cuentas_pagar').val() === '')
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
										strDepartamento_ordenes_compra_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del departamento
					                                    if(value !== '' && $('#txtDepartamentoID_ordenes_compra_cuentas_pagar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un departamento existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strSucursal_ordenes_compra_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la sucursal
					                                    if(value !== '' &&  $('#txtSucursalID_ordenes_compra_cuentas_pagar').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una sucursal existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intTotalUnidades_ordenes_compra_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba el total de unidades'}
											}
										},
										intImporteTotal_ordenes_compra_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba el importe total'}
											}
										},
										intNumDetalles_ordenes_compra_cuentas_pagar: {
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
										strConcepto_detalles_ordenes_compra_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_detalles_ordenes_compra_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_detalles_ordenes_compra_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_detalles_ordenes_compra_cuentas_pagar: {
											excluded: true  //Ignorar (no valida el campo)
										},
										intIvaUnitario_detalles_ordenes_compra_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intIepsUnitario_detalles_ordenes_compra_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_ordenes_compra_cuentas_pagar = $('#frmOrdenesCompraCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_ordenes_compra_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_ordenes_compra_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesOrdenesCompraCuentasPagar = $.reemplazar($('#acumTotal_detalles_ordenes_compra_cuentas_pagar').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesOrdenesCompraCuentasPagar = $.reemplazar(intAcumTotalDetallesOrdenesCompraCuentasPagar, ",", "");

				var intImporteTotalOrdenesCompraCuentasPagar = $.reemplazar($('#txtImporteTotal_ordenes_compra_cuentas_pagar').val(), ",", "");
 
				//Verificar que el total de unidades sea igual a la cantidad de detalles
				if($('#acumCantidad_detalles_ordenes_compra_cuentas_pagar').html() != $('#txtTotalUnidades_ordenes_compra_cuentas_pagar').val())
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_ordenes_compra_cuentas_pagar('error', 'El total de unidades no coincide con los detalles, favor de verificar.');
					
				}
				//Verificar que el importe total sea igual al total de detalles
				else if(intAcumTotalDetallesOrdenesCompraCuentasPagar != intImporteTotalOrdenesCompraCuentasPagar)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_ordenes_compra_cuentas_pagar('error', 'El importe total no coincide con los detalles, favor de verificar.');
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_ordenes_compra_cuentas_pagar();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_ordenes_compra_cuentas_pagar()
		{
			try
			{
				$('#frmOrdenesCompraCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_ordenes_compra_cuentas_pagar()
		{
			//Obtenemos un array con los datos del archivo
    		var arrArchivoOrdenesCompraCuentasPagar = $("#archivo_varios_ordenes_compra_cuentas_pagar");

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_cuentas_pagar').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrSucursalID = [];
			var arrModuloID = [];
			var arrGastoTipoID = [];
			var arrVehiculoID = [];
			var arrConceptos = [];
			var arrCantidades = [];
			var arrPreciosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrTasaCuotaIva = [];
			var arrIvasUnitarios = [];
			var arrTasaCuotaIeps = [];
			var arrIepsUnitarios = [];
			var arrRetencionIsr = [];
			var arrRetencionesIsrUnitarios = [];
			var arrRetencionIva = [];
			var arrRetencionesIvaUnitarios = [];

			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioOrden = parseFloat($('#txtTipoCambio_ordenes_compra_cuentas_pagar').val());

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
				var intRetencionIsrUnitario = $.reemplazar(objRen.cells[30].innerHTML, ",", "");
				var intRetencionIvaUnitario = $.reemplazar(objRen.cells[34].innerHTML, ",", "");

				//Calcular iva unitario
				intIvaUnitario =  intIvaUnitario / intCantidad;
				//Calcular ieps unitario
				intIepsUnitario = intIepsUnitario / intCantidad;

				//Convertir importes a peso mexicano
				intPrecioUnitario = intPrecioUnitario * intTipoCambioOrden;
				intDescuentoUnitario = intDescuentoUnitario * intTipoCambioOrden;
				intIvaUnitario = intIvaUnitario * intTipoCambioOrden;
				intIepsUnitario = intIepsUnitario * intTipoCambioOrden;
				intRetencionIsrUnitario = intRetencionIsrUnitario * intTipoCambioOrden;
				intRetencionIvaUnitario = intRetencionIvaUnitario * intTipoCambioOrden;

				//Si existe importe del descuento
				if(intDescuentoUnitario > 0)
				{	
					//Restar descuento al precio unitario
					intPrecioUnitario = intPrecioUnitario - intDescuentoUnitario;
				}

				//Redondear cantidad a x decimales
			    intPrecioUnitario = intPrecioUnitario.toFixed(intNumDecimalesPrecioUnitBDOrdenesCompraCuentasPagar);
			    intPrecioUnitario = parseFloat(intPrecioUnitario);

				intIvaUnitario = intIvaUnitario.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar);
				intIvaUnitario = parseFloat(intIvaUnitario);

				intIepsUnitario = intIepsUnitario.toFixed(intNumDecimalesIepsUnitBDOrdenesCompraCuentasPagar);
				intIepsUnitario = parseFloat(intIepsUnitario);

				intRetencionIsrUnitario = intRetencionIsrUnitario.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar);
				intRetencionIsrUnitario = parseFloat(intRetencionIsrUnitario);

				intRetencionIvaUnitario = intRetencionIvaUnitario.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar);
				intRetencionIvaUnitario = parseFloat(intRetencionIvaUnitario);


				//Asignar valores a los arrays
				arrSucursalID.push(objRen.cells[20].innerHTML);
				arrModuloID.push(objRen.cells[21].innerHTML);
				arrGastoTipoID.push(objRen.cells[22].innerHTML);
				arrVehiculoID.push(objRen.cells[23].innerHTML);
				arrConceptos.push(objRen.cells[0].innerHTML);
				arrCantidades.push(intCantidad);
				arrPreciosUnitarios.push(intPrecioUnitario);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrTasaCuotaIva.push(objRen.cells[13].innerHTML);
				arrIvasUnitarios.push(intIvaUnitario);
				arrTasaCuotaIeps.push(objRen.cells[14].innerHTML);
				arrIepsUnitarios.push(intIepsUnitario );
				arrRetencionIsr.push(objRen.cells[29].innerHTML);
				arrRetencionesIsrUnitarios.push(intRetencionIsrUnitario);
				arrRetencionIva.push(objRen.cells[33].innerHTML);
				arrRetencionesIvaUnitarios.push(intRetencionIvaUnitario);
			}

			//Variable que se utiliza para asignar el importe retenido de ISR (proveedor)
			var intRetencionIsrProv =  parseFloat($.reemplazar($('#txtImporteRetenido_ordenes_compra_cuentas_pagar').val(), ",", ""));

			//Si existe retención de ISR (proveedor)
			if(intRetencionIsrProv > 0)
			{
				//Convertir importes a peso mexicano
				intRetencionIsrProv = intRetencionIsrProv * intTipoCambioOrden;
				//Redondear cantidad a decimales
				intRetencionIsrProv = intRetencionIsrProv.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar);
				intRetencionIsrProv = parseFloat(intRetencionIsrProv);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_pagar/ordenes_compra/guardar',
					{ 
						//Datos de la orden de compra
						intOrdenCompraID: $('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val(),
						strFolioConsecutivo: $('#txtFolio_ordenes_compra_cuentas_pagar').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_ordenes_compra_cuentas_pagar').val()),
						dteFechaEntrega: $.formatFechaMysql($('#txtFechaEntrega_ordenes_compra_cuentas_pagar').val()),
						dteFechaVencimiento: $.formatFechaMysql($('#txtFechaVencimiento_ordenes_compra_cuentas_pagar').val()),
						strCondicionesPago: $('#cmbCondicionesPago_ordenes_compra_cuentas_pagar').val(),
						intMonedaID: $('#cmbMonedaID_ordenes_compra_cuentas_pagar').val(),
						intTipoCambio: intTipoCambioOrden,
						strFactura: $('#txtFactura_ordenes_compra_cuentas_pagar').val(),
						intProveedorID: $('#txtProveedorID_ordenes_compra_cuentas_pagar').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_ordenes_compra_cuentas_pagar').val(),
						intSolicitaID: $('#txtSolicitaID_ordenes_compra_cuentas_pagar').val(),
						intSucursalID: $('#txtSucursalID_ordenes_compra_cuentas_pagar').val(),
						intDepartamentoID: $('#txtDepartamentoID_ordenes_compra_cuentas_pagar').val(),
						intPorcentajeRetencionID: $('#txtPorcentajeRetencionID_ordenes_compra_cuentas_pagar').val(),
						intImporteRetenido: intRetencionIsrProv,
						strObservaciones: $('#txtObservaciones_ordenes_compra_cuentas_pagar').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_ordenes_compra_cuentas_pagar').val(),
						//Datos de los detalles
						strSucursalID: arrSucursalID.join('|'),
						strModuloID: arrModuloID.join('|'),
						strGastoTipoID: arrGastoTipoID.join('|'),
						strVehiculoID: arrVehiculoID.join('|'),
						strConceptos: arrConceptos.join('|'),
						strCantidades: arrCantidades.join('|'),
						strPreciosUnitarios: arrPreciosUnitarios.join('|'),
						strDescuentosUnitarios: arrDescuentosUnitarios.join('|'),
						strTasaCuotaIva: arrTasaCuotaIva.join('|'),
						strIvasUnitarios: arrIvasUnitarios.join('|'),
						strTasaCuotaIeps: arrTasaCuotaIeps.join('|'),
						strIepsUnitarios: arrIepsUnitarios.join('|'),
						strRetencionIsr: arrRetencionIsr.join('|'),
						strRetencionesIsrUnitarios: arrRetencionesIsrUnitarios.join('|'),
						strRetencionIva: arrRetencionIva.join('|'),
						strRetencionesIvaUnitarios: arrRetencionesIvaUnitarios.join('|')
					},
					function(data) {
						if (data.resultado)
						{

							//Si no existe id de la orden de compra, significa que es un nuevo registro   
							if($('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val() == '')
							{
							  	//Asignar el id de la orden de compra registrada en la base de datos
                     			$('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val(data.orden_compra_id);
                     			//Asignar folio consecutivo
                 				$('#txtFolio_ordenes_compra_cuentas_pagar').val(data.folio);
                 			}

             				//Si existen archivos seleccionados
             				if(arrArchivoOrdenesCompraCuentasPagar != undefined )
             				{
             					//Hacer un llamado a la función para subir el archivo
	                    		subir_archivos_modal_ordenes_compra_cuentas_pagar('Nuevo');
             				}
             				else
             				{
             					//Hacer un llamado a la función para cerrar modal
		                    	cerrar_ordenes_compra_cuentas_pagar();
		                    	//Hacer un llamado a la función para abrir modal de autorización
								abrir_autorizar_ordenes_compra_cuentas_pagar($('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val(), $('#txtFolio_ordenes_compra_cuentas_pagar').val(), 'Guardar');

								//Hacer llamado a la función  para cargar  los registros en el grid
		               			paginacion_ordenes_compra_cuentas_pagar();  
             				}

						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_compra_cuentas_pagar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_ordenes_compra_cuentas_pagar(tipoMensaje, mensaje)
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
                                                $('#txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar').focus();
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
		function cambiar_estatus_ordenes_compra_cuentas_pagar(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val();

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
													    set_estatus_ordenes_compra_cuentas_pagar(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_ordenes_compra_cuentas_pagar(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_ordenes_compra_cuentas_pagar(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('cuentas_pagar/ordenes_compra/set_estatus',
			      {intOrdenCompraID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_ordenes_compra_cuentas_pagar();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_ordenes_compra_cuentas_pagar();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_ordenes_compra_cuentas_pagar(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ordenes_compra_cuentas_pagar(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_pagar/ordenes_compra/get_datos',
			       {
			       		intOrdenCompraID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ordenes_compra_cuentas_pagar();
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
				            $('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val(data.row.orden_compra_id);
				            $('#txtFolio_ordenes_compra_cuentas_pagar').val(data.row.folio);
				            $('#txtFecha_ordenes_compra_cuentas_pagar').val(data.row.fecha);
				            $('#txtFechaEntrega_ordenes_compra_cuentas_pagar').val(data.row.fecha_entrega);
				            $('#txtFechaVencimiento_ordenes_compra_cuentas_pagar').val(data.row.fecha_vencimiento);
				            $('#cmbCondicionesPago_ordenes_compra_cuentas_pagar').val(data.row.condiciones_pago);
				            $('#cmbMonedaID_ordenes_compra_cuentas_pagar').val(data.row.moneda_id);
				            $('#txtTipoCambio_ordenes_compra_cuentas_pagar').val(data.row.tipo_cambio);
				            $('#txtFactura_ordenes_compra_cuentas_pagar').val(data.row.factura);
				            $('#txtProveedorID_ordenes_compra_cuentas_pagar').val(data.row.proveedor_id);
						    $('#txtProveedor_ordenes_compra_cuentas_pagar').val(data.row.proveedor);
						    $('#txtRegimenFiscalID_ordenes_compra_cuentas_pagar').val(data.row.regimen_fiscal_id);
						    $('#txtDiasCredito_ordenes_compra_cuentas_pagar').val(data.row.dias_credito);
						    $('#txtSolicitaID_ordenes_compra_cuentas_pagar').val(data.row.solicita_id);
						    $('#txtSolicita_ordenes_compra_cuentas_pagar').val(data.row.solicita);
						    $('#txtSucursalID_ordenes_compra_cuentas_pagar').val(data.row.sucursal_id);
						    $('#txtSucursal_ordenes_compra_cuentas_pagar').val(data.row.sucursal);
						    $('#txtDepartamentoID_ordenes_compra_cuentas_pagar').val(data.row.departamento_id);
						    $('#txtDepartamento_ordenes_compra_cuentas_pagar').val(data.row.departamento);
						    $('#txtPorcentajeRetencionID_ordenes_compra_cuentas_pagar').val(data.row.porcentaje_retencion_id);
						    $('#txtPorcentajeIsr_ordenes_compra_cuentas_pagar').val(data.row.porcentaje_isr);
						    $('#txtImporteRetenido_ordenes_compra_cuentas_pagar').val(intRetencionIsrProv);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporteRetenido_ordenes_compra_cuentas_pagar').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarOrdenesCompraCuentasPagar });
						    $('#txtObservaciones_ordenes_compra_cuentas_pagar').val(data.row.observaciones);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_ordenes_compra_cuentas_pagar').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_ordenes_compra_cuentas_pagar").show();
				            //Ocultar botón Adjuntar archivo
				            $("#btnAdjuntar_ordenes_compra_cuentas_pagar").hide();

				            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	    				 mostrar_retencion_isr_ordenes_compra_cuentas_pagar();

				            //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar los siguientes botones
				            	$("#btnDescargarArchivo_ordenes_compra_cuentas_pagar").show();
				            	//Si el estatus del registro es ACTIVO
				            	if(strEstatus == 'ACTIVO')
				            	{
					            	$('#btnEliminarArchivo_ordenes_compra_cuentas_pagar').show();
					            }
				           	}

							//Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmOrdenesCompraCuentasPagar').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					            $("#btnGuardar_ordenes_compra_cuentas_pagar").hide();
					            //Deshabilitar botón Agregar
								$('#btnAgregar_detalles_ordenes_compra_cuentas_pagar').prop('disabled', true);
					           
					            //Si el estatus del registro es INACTIVO
				            	if(strEstatus == 'INACTIVO')
				            	{
				            		//Mostrar botón Restaurar
				            		$("#btnRestaurar_ordenes_compra_cuentas_pagar").show();
				            	}
				            	else //Si el estatus del registro es AUTORIZADO
				            	{
				            		//Mostrar botón Enviar correo  
				            		$("#btnEnviarCorreo_ordenes_compra_cuentas_pagar").show();
				            	}

				            }
				            else //ACTIVO O RECHAZADO
				            {
				            	 strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_detalles_ordenes_compra_cuentas_pagar(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_detalles_ordenes_compra_cuentas_pagar(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDOrdenesCompraCuentasPagar)
							    {
									//Habilitar caja de texto
									$("#txtTipoCambio_ordenes_compra_cuentas_pagar").removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar las siguientes cajas de texto
									$("#txtTipoCambio_ordenes_compra_cuentas_pagar").attr('disabled','disabled');
							    }

				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
					            {
					            	
					            	//Mostrar los siguientes botones  
					            	$("#btnDesactivar_ordenes_compra_cuentas_pagar").show();
					            	$("#btnEnviarCorreo_ordenes_compra_cuentas_pagar").show();
					            	$("#btnAutorizar_ordenes_compra_cuentas_pagar").show();
					            	$("#btnAdjuntar_ordenes_compra_cuentas_pagar").show();
					            }
				            }


				          

				           	//Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {

				            	//Variable que se utiliza para asignar el renglón del detalle
								var intRenglon = data.detalles[intCon].renglon;

								//Crear instancia del objeto Detalle de la orden de compra
								objDetalleOrdenOrdenesCompraCuentasPagar = new DetalleOrdenOrdenesCompraCuentasPagar(null, '', '', '', 
																										             '', '', '', '',
																										             '', '',  '',  '', 
																										             '', '', '', '', 
																										             '', '', '', '', 
																										             '', '', '', '', '', '',
																										             '', '', '', '', '','');


								//Variables que se utilizan para asignar valores del detalle
								var intSubtotal = parseFloat(data.detalles[intCon].precio_unitario);
								var intCantidad =  parseFloat(data.detalles[intCon].cantidad);
								var intPrecioUnitario = parseFloat(data.detalles[intCon].precio_unitario);
								var intDescuentoUnitario = parseFloat(data.detalles[intCon].descuento_unitario);
								var intIvaUnitario = parseFloat(data.detalles[intCon].iva_unitario);
								var intIepsUnitario = parseFloat(data.detalles[intCon].ieps_unitario);
								var intRetencionIsrUnitario = data.detalles[intCon].retencion_isr_unitario;
								var intRetencionIvaUnitario = data.detalles[intCon].retencion_iva_unitario;
								var intImporteIva = 0;
								var intImporteIeps = 0;
								var intImporteRetencionIsr = 0;
								var intImporteRetencionIva = 0;
								var intPorcentajeDescuento = 0;
								var intPorcentajeIeps = '';
								var intTotal = 0;

								//Convertir peso mexicano a tipo de cambio
								intSubtotal = intSubtotal / intTipoCambio;
								intPrecioUnitario = intPrecioUnitario / intTipoCambio;
								intDescuentoUnitario = intDescuentoUnitario / intTipoCambio;
								intIvaUnitario = intIvaUnitario / intTipoCambio;
								intIepsUnitario = intIepsUnitario / intTipoCambio;
								intRetencionIsrUnitario = intRetencionIsrUnitario / intTipoCambio;
								intRetencionIvaUnitario = intRetencionIvaUnitario / intTipoCambio;

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

								//Si existe porcentaje de la retención de ISR
								if(intRetencionIsrUnitario > 0)
								{
									//Calcular importe de la retención de ISR
									intImporteRetencionIsr =  intRetencionIsrUnitario * intCantidad;
								}

								//Si existe porcentaje de la retención de IVA
								if(intRetencionIvaUnitario > 0)
								{
									//Calcular importe de la retención de IVA
									intImporteRetencionIva =  intRetencionIvaUnitario * intCantidad;
								}
								


								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;

								//Decrementar importe de la retención de ISR
								intTotal -= intImporteRetencionIsr;
								//Decrementar importe de la retención de IVA
								intTotal -= intImporteRetencionIva;


								//Cambiar cantidad a  formato moneda (a visualizar)
								intCantidad =  formatMoney(intCantidad, intNumDecimalesCantidadBDOrdenesCompraCuentasPagar, '');
								intPrecioUnitario =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDOrdenesCompraCuentasPagar, '');
								
								intDescuentoUnitario =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDOrdenesCompraCuentasPagar, '');
								
								intSubtotal  =  formatMoney(intSubtotal, intNumDecimalesMostrarOrdenesCompraCuentasPagar, '');
								
								intImporteIva  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar, '');
								
								intImporteIeps  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDOrdenesCompraCuentasPagar, '');
								
								intTotal  =  formatMoney(intTotal, intNumDecimalesMostrarOrdenesCompraCuentasPagar, '');
								
								intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, 
									intNumDecimalesDescUnitBDOrdenesCompraCuentasPagar, '');

								intIepsUnitario =  formatMoney(intIepsUnitario, intNumDecimalesIepsUnitBDOrdenesCompraCuentasPagar, '');
								intIvaUnitario =  formatMoney(intIvaUnitario, intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar, '');


								//Asignar valores al objeto
								objDetalleOrdenOrdenesCompraCuentasPagar.intSucursalID = data.detalles[intCon].sucursal_id;
								objDetalleOrdenOrdenesCompraCuentasPagar.intModuloID = data.detalles[intCon].modulo_id;
								objDetalleOrdenOrdenesCompraCuentasPagar.intGastoTipoID = data.detalles[intCon].gasto_tipo_id;
								objDetalleOrdenOrdenesCompraCuentasPagar.strGastoTipo = data.detalles[intCon].gasto;
								objDetalleOrdenOrdenesCompraCuentasPagar.strTipoGasto = data.detalles[intCon].tipo_gasto;
								objDetalleOrdenOrdenesCompraCuentasPagar.intVehiculoID =  data.detalles[intCon].vehiculo_id;
								objDetalleOrdenOrdenesCompraCuentasPagar.strVehiculo = data.detalles[intCon].vehiculo;
								objDetalleOrdenOrdenesCompraCuentasPagar.strParqueVehicular = data.detalles[intCon].parque_vehicular;
								objDetalleOrdenOrdenesCompraCuentasPagar.strConcepto =  data.detalles[intCon].concepto;
								objDetalleOrdenOrdenesCompraCuentasPagar.intCantidad = intCantidad;
								objDetalleOrdenOrdenesCompraCuentasPagar.intPrecioUnitario = intPrecioUnitario;
								objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeDescuento = intPorcentajeDescuento;
								objDetalleOrdenOrdenesCompraCuentasPagar.intDescuentoUnitario = intDescuentoUnitario;
								objDetalleOrdenOrdenesCompraCuentasPagar.intTasaCuotaIva = data.detalles[intCon].tasa_cuota_iva;
								objDetalleOrdenOrdenesCompraCuentasPagar.intImporteIva = intImporteIva;
								objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeIva = data.detalles[intCon].porcentaje_iva;;
								objDetalleOrdenOrdenesCompraCuentasPagar.intIvaUnitario = intIvaUnitario;
								objDetalleOrdenOrdenesCompraCuentasPagar.intTasaCuotaIeps = data.detalles[intCon].tasa_cuota_ieps;
								objDetalleOrdenOrdenesCompraCuentasPagar.intImporteIeps = intImporteIeps;
								objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeIeps = intPorcentajeIeps;
								objDetalleOrdenOrdenesCompraCuentasPagar.intIepsUnitario = intIepsUnitario;
								objDetalleOrdenOrdenesCompraCuentasPagar.strTipoTasaCuotaIeps = data.detalles[intCon].tipo_ieps;
								objDetalleOrdenOrdenesCompraCuentasPagar.strFactorTasaCuotaIeps = data.detalles[intCon].factor_ieps;
								objDetalleOrdenOrdenesCompraCuentasPagar.intValorMinimoTasaCuotaIeps = data.detalles[intCon].valor_minimo_ieps;
								objDetalleOrdenOrdenesCompraCuentasPagar.strRetencionIsr = data.detalles[intCon].retencion_isr_gasto;
								objDetalleOrdenOrdenesCompraCuentasPagar.intImporteRetencionIsr = intImporteRetencionIsr;
								objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeRetencionIsr = data.detalles[intCon].retencion_isr;
								objDetalleOrdenOrdenesCompraCuentasPagar.intRetencionIsrUnitario =data.detalles[intCon].retencion_ieps_unitario;
								objDetalleOrdenOrdenesCompraCuentasPagar.strRetencionIva = data.detalles[intCon].retencion_iva_gasto;
								objDetalleOrdenOrdenesCompraCuentasPagar.intImporteRetencionIva = intImporteRetencionIva;
								objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeRetencionIva = data.detalles[intCon].retencion_iva;
								objDetalleOrdenOrdenesCompraCuentasPagar.intRetencionIvaUnitario = data.detalles[intCon].retencion_iva_unitario;

								//Agregar datos del detalle de la orden de compra
							     objDetallesOrdenOrdenesCompraCuentasPagar.setDetalle(objDetalleOrdenOrdenesCompraCuentasPagar);


						
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_ordenes_compra_cuentas_pagar').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaConcepto = objRenglon.insertCell(0);
								var objCeldaGastoTipo = objRenglon.insertCell(1);
								var objCeldaCantidad = objRenglon.insertCell(2);
								var objCeldaPrecioUnitario = objRenglon.insertCell(3);
								var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
								var objCeldaSubtotal = objRenglon.insertCell(5);
								var objCeldaIva = objRenglon.insertCell(6);
								var objCeldaIeps = objRenglon.insertCell(7);
								var objCeldaTotal = objRenglon.insertCell(8);
								var objCeldaAcciones = objRenglon.insertCell(9);
								//Columnas ocultas
								var objCeldaPorcentajeDescuento = objRenglon.insertCell(10);
								var objCeldaPorcentajeIva = objRenglon.insertCell(11);
								var objCeldaPorcentajeIeps = objRenglon.insertCell(12);
								var objCeldaTasaCuotaIva = objRenglon.insertCell(13);
								var objCeldaTasaCuotaIeps = objRenglon.insertCell(14);
								var objCeldaIepsUnitario = objRenglon.insertCell(15);
								var objCeldaTipoTasaCuotaIeps = objRenglon.insertCell(16);
								var objCeldaFactorTasaCuotaIeps = objRenglon.insertCell(17);
								var objCeldaValorMinimoTasaCuotaIeps = objRenglon.insertCell(18);
								var objCeldaTipoGasto = objRenglon.insertCell(19);
								var objCeldaSucursalID = objRenglon.insertCell(20);
								var objCeldaModuloID = objRenglon.insertCell(21);
								var objCeldaGastoTipoID = objRenglon.insertCell(22);
								var objCeldaVehiculoID = objRenglon.insertCell(23);
								var objCeldaVehiculo = objRenglon.insertCell(24);
								var objCeldaParqueVehicular = objRenglon.insertCell(25);
								var objCeldaIvaUnitario = objRenglon.insertCell(26);
								var objCeldaRetencionIsr = objRenglon.insertCell(27);
								var objCeldaImporteRetencionIsr = objRenglon.insertCell(28);
								var objCeldaPorcentajeRetencionIsr = objRenglon.insertCell(29);
								var objCeldaRetencionIsrUnitario  = objRenglon.insertCell(30);
								var objCeldaRetencionIva = objRenglon.insertCell(31);
								var objCeldaImporteRetencionIva = objRenglon.insertCell(32);
								var objCeldaPorcentajeRetencionIva = objRenglon.insertCell(33);
								var objCeldaRetencionIvaUnitario  = objRenglon.insertCell(34);

							
								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', intRenglon);
								objCeldaConcepto.setAttribute('class', 'movil b1');
								objCeldaConcepto.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strConcepto;
								objCeldaGastoTipo.setAttribute('class', 'movil b2');
								objCeldaGastoTipo.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strGastoTipo;
								objCeldaCantidad.setAttribute('class', 'movil b3');
								objCeldaCantidad.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intCantidad;
								objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
								objCeldaPrecioUnitario.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPrecioUnitario;
								objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
								objCeldaDescuentoUnitario.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intDescuentoUnitario;
								objCeldaSubtotal.setAttribute('class', 'movil b6');
								objCeldaSubtotal.innerHTML = intSubtotal;
								objCeldaIva.setAttribute('class', 'movil b7');
								objCeldaIva.innerHTML = intImporteIva;
								objCeldaIeps.setAttribute('class', 'movil b8');
								objCeldaIeps.innerHTML = intImporteIeps;
								objCeldaTotal.setAttribute('class', 'movil b9');
								objCeldaTotal.innerHTML = intTotal;
								objCeldaAcciones.setAttribute('class', 'td-center movil b10');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeDescuento.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeDescuento; 
								objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIva.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeIva; 
								objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIeps.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeIeps;
								objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIva.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intTasaCuotaIva;
								objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIeps.innerHTML =  objDetalleOrdenOrdenesCompraCuentasPagar.intTasaCuotaIeps;
								objCeldaIepsUnitario.setAttribute('class', 'no-mostrar');
								objCeldaIepsUnitario.innerHTML =  objDetalleOrdenOrdenesCompraCuentasPagar.intIepsUnitario;
								objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTipoTasaCuotaIeps.innerHTML =  objDetalleOrdenOrdenesCompraCuentasPagar.strTipoTasaCuotaIeps;
								objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaFactorTasaCuotaIeps.innerHTML =  objDetalleOrdenOrdenesCompraCuentasPagar.strFactorTasaCuotaIeps;
								objCeldaValorMinimoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaValorMinimoTasaCuotaIeps.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intValorMinimoTasaCuotaIeps;
								objCeldaTipoGasto.setAttribute('class', 'no-mostrar');
								objCeldaTipoGasto.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strTipoGasto;
								objCeldaSucursalID.setAttribute('class', 'no-mostrar');
								objCeldaSucursalID.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intSucursalID;
								objCeldaModuloID.setAttribute('class', 'no-mostrar');
								objCeldaModuloID.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intModuloID;
								objCeldaGastoTipoID.setAttribute('class', 'no-mostrar');
								objCeldaGastoTipoID.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intGastoTipoID;
								objCeldaVehiculoID.setAttribute('class', 'no-mostrar');
								objCeldaVehiculoID.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intVehiculoID;
								objCeldaVehiculo.setAttribute('class', 'no-mostrar');
								objCeldaVehiculo.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strVehiculo;
								objCeldaParqueVehicular.setAttribute('class', 'no-mostrar');
								objCeldaParqueVehicular.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strParqueVehicular;
								objCeldaIvaUnitario.setAttribute('class', 'no-mostrar');
								objCeldaIvaUnitario.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intIvaUnitario;
								objCeldaRetencionIsr.setAttribute('class', 'no-mostrar');
								objCeldaRetencionIsr.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strRetencionIsr;
								objCeldaImporteRetencionIsr.setAttribute('class', 'no-mostrar');
								objCeldaImporteRetencionIsr.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intImporteRetencionIsr;
								objCeldaPorcentajeRetencionIsr.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeRetencionIsr.innerHTML =  objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeRetencionIsr;
								objCeldaRetencionIsrUnitario.setAttribute('class', 'no-mostrar');
								objCeldaRetencionIsrUnitario.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intRetencionIsrUnitario;
								objCeldaRetencionIva.setAttribute('class', 'no-mostrar'); 
								objCeldaRetencionIva.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strRetencionIva;
								objCeldaImporteRetencionIva.setAttribute('class', 'no-mostrar');
								objCeldaImporteRetencionIva.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intImporteRetencionIva;
								objCeldaPorcentajeRetencionIva.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeRetencionIva.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeRetencionIva;
								objCeldaRetencionIvaUnitario.setAttribute('class', 'no-mostrar');
								objCeldaRetencionIvaUnitario.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intRetencionIvaUnitario;

				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_ordenes_compra_cuentas_pagar();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_ordenes_compra_cuentas_pagar tr").length - 4;
							$('#numElementos_detalles_ordenes_compra_cuentas_pagar').html(intFilas);
							$('#txtNumDetalles_ordenes_compra_cuentas_pagar').val(intFilas);
							
							
			            	//Abrir modal
				            objOrdenesCompraCuentasPagar = $('#OrdenesCompraCuentasPagarBox').bPopup({
														  appendTo: '#OrdenesCompraCuentasPagarContent', 
							                              contentContainer: 'OrdenesCompraCuentasPagarM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#cmbMonedaID_ordenes_compra_cuentas_pagar').focus();
			       	    }
			       },
			       'json');
		}



		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_ordenes_compra_cuentas_pagar()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_ordenes_compra_cuentas_pagar').val()) !== intMonedaBaseIDOrdenesCompraCuentasPagar)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_ordenes_compra_cuentas_pagar").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_ordenes_compra_cuentas_pagar').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_ordenes_compra_cuentas_pagar').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_ordenes_compra_cuentas_pagar").val(data.row.tipo_cambio_sat);
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}

		//Función para subir los archivos de un registro desde el modal
		function subir_archivos_modal_ordenes_compra_cuentas_pagar(tipoAccion)
		{
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDOrdenesCompraCuentasPagar  = "archivo_varios_ordenes_compra_cuentas_pagar";
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDOrdenesCompraCuentasPagar);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDOrdenesCompraCuentasPagar)[0].files;
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
			    $('#'+strBotonArchivoIDOrdenesCompraCuentasPagar).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_ordenes_compra_cuentas_pagar('error', strMensajeError);
	        }
	        else
	        {
	        	//Si existe id del registro subir los archivos
	        	if($('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val() != '')
	        	{
		        	//Crear instancia al objeto del formulario
		        	var formData = new FormData($("#frmOrdenesCompraCuentasPagar")[0]);
		        	//Hacer un llamado al método del controlador para subir archivos del registro
		            $.ajax({
		                url: 'cuentas_pagar/ordenes_compra/subir_archivos',
		                type: "POST",
		                data: formData,
		                contentType: false,
		                processData: false,
		                success: function(data)
		                {
		                    //Limpia ruta del archivo cargado
			         		$('#'+strBotonArchivoIDOrdenesCompraCuentasPagar).val('');
							//Subida finalizada.
							if (data.resultado)
							{
							   //Mostrar los siguientes botones
		                       $('#btnDescargarArchivo_ordenes_compra_cuentas_pagar').show();
		                       $("#btnEliminarArchivo_ordenes_compra_cuentas_pagar").show();
			         		   //Hacer llamado a la función  para cargar  los registros en el grid
				           	   paginacion_ordenes_compra_cuentas_pagar();  
							}

							//Si la acción corresponde a un nuevo registro
		                    if(tipoAccion == 'Nuevo')
		                    {
		                    	//Si el tipo de mensaje es un éxito
				                if(data.tipo_mensaje == 'éxito')
				                {
					                //Hacer un llamado a la función para cerrar modal
					                cerrar_ordenes_compra_cuentas_pagar();
					                //Hacer un llamado a la función para abrir modal de autorización
									abrir_autorizar_ordenes_compra_cuentas_pagar($('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val(), $('#txtFolio_ordenes_compra_cuentas_pagar').val(), 'Guardar');
				                }
				                else
				                {
				                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    			mensaje_ordenes_compra_cuentas_pagar(data.tipo_mensaje, data.mensaje);
				                }
		                    }
		                    else
		                    {

		                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    		mensaje_ordenes_compra_cuentas_pagar(data.tipo_mensaje, data.mensaje);
		                    }
		                }
	            	});
	            }
	        }
			
		}



	    //Función para asignar los datos de un proveedor
		function get_datos_proveedor_ordenes_compra_cuentas_pagar(ui)
		{
		 	//Asignar valores del registro seleccionado
             $('#txtProveedorID_ordenes_compra_cuentas_pagar').val(ui.item.data);
             $('#txtDiasCredito_ordenes_compra_cuentas_pagar').val(ui.item.dias_credito);
             $('#txtRegimenFiscalID_ordenes_compra_cuentas_pagar').val(ui.item.regimen_fiscal_id);
             //Hacer un llamado a la función para calcular fecha de vencimiento
       	     $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraCuentasPagar);

       	     //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt(ui.item.regimen_fiscal_id) == intRegimenFiscalIDResicoOrdenesCompraCuentasPagar)
       	     {
       	     	//Hacer un llamado a la función para cargar el porcentaje de retención ISR base
       			cargar_porcentaje_isr_base_ordenes_compra_cuentas_pagar();
       	     }

       	     //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_ordenes_compra_cuentas_pagar();

		}

		//Función para mostrar u ocultar div que contiene el campo de retención de ISR (proveedor)
		function mostrar_retencion_isr_ordenes_compra_cuentas_pagar()
		{
			//Si el gasto tiene retención de ISR
            if(parseInt($('#txtRegimenFiscalID_ordenes_compra_cuentas_pagar').val()) == intRegimenFiscalIDResicoOrdenesCompraCuentasPagar)
            {
            	//Quitar clase no-mostrar para mostrar div que contiene la retención de ISR (proveedor)
			  	$('#divRetencionIsr_ordenes_compra_cuentas_pagar').removeClass("no-mostrar");
            }
            else
            {
            	//Agregar clase no-mostrar para ocultar div que contiene la retención de ISR (proveedor)
			    $('#divRetencionIsr_ordenes_compra_cuentas_pagar').addClass("no-mostrar");
            }

		}


		


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para regresar y obtener los datos de un vehículo
		function get_datos_vehiculo_detalles_ordenes_compra_cuentas_pagar()
		{
		 	//Hacer un llamado al método del controlador para regresar los datos del vehículo
            $.post('control_vehiculos/vehiculos/get_datos',
                  { 
                  	strBusqueda: $("#txtVehiculoID_detalles_ordenes_compra_cuentas_pagar").val(),
	       			strTipo: 'id'
                  },
                  function(data) {	                  	
                    if(data.row){
                       
                        //Variable que se utiliza para asignar el id de la sucursal
						var intSucursalID = data.row.sucursal_id;
						//Variable que se utiliza para asignar el id del módulo
						var intModuloID = data.row.modulo_id;

                        //Si existe id de la sucursal
					    if(intSucursalID > 0)
					    {
					    	$("#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar").val(data.row.sucursal_id);
					    	$("#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar").val(strCuenta602OrdenesCompraCuentasPagar);
					    }
					    else //Corporativo
					    {
					    	$("#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar").val('GASTOS CORPORATIVOS');
					    	
					    }

					    //Hacer un llamado a la función para mostrar u ocultar sucursal y/o módulo
	          			mostrar_cmb_detalles_ordenes_compra_cuentas_pagar(intSucursalID, intModuloID);

					    //Hacer un llamado a la función para cargar gastos en el combobox
						cargar_gastos_detalles_ordenes_compra_cuentas_pagar();
                      
                    }
                  }
                 ,
                'json');

		}

		//Función para inicializar elementos del vehículo
		function inicializar_vehiculo_detalles_ordenes_compra_cuentas_pagar()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $("#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar").val('');
            $("#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar").val('');
            $("#cmbModuloID_detalles_ordenes_compra_cuentas_pagar").val('');
            $('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').empty();
		}



		//Función para regresar las opciones del combobox porcentajes de retención de IVA
		function get_opciones_cmb_retencionIVA_detalles_ordenes_compra_cuentas_pagar(strGastoTipoVigSeg) 
		{

			//Se vacia el select para que se puedan agregar los nuevos valores
			$('#cmbPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar').empty();

			//Se crea un objeto con la opción para el IVA del 0%
			var objIvaOPorc = {};
			//Se crea un objeto con la opción para el IVA del 6%
			var objIva6Porc = {};


			//Si el gasto corresponde a Vigilancia y Seguridad 
			if(strGastoTipoVigSeg == strGastoTipoIDGAdminVigSegOrdenesCompraCuentasPagar)
			{	
				//Agregar valores de los porcentajes de IVA
				objIvaOPorc = {"value": "0.000000","opcion": "0.000000"};
				objIva6Porc = {"value": "0.060000","opcion": "0.060000"};
			}

			//Si el gasto corresponde a Fletes y Acarreos
			if(strGastoTipoVigSeg == strGastoTipoIDFletesAcarreosOrdenesCompraCuentasPagar)
			{	
				//Agregar valores de los porcentajes de IVA
				objIvaOPorc = {"value": "0.000000","opcion": "0.000000"};
			}

			//Se crea un objeto con las opciones para el select
			var opciones = [
							{"value": "","opcion": "Seleccione una opción"},
							objIvaOPorc,
						    {"value": "0.040000","opcion": "0.040000"},
						    objIva6Porc,
						    {"value": "0.106667","opcion": "0.106667"},
						    {"value": "0.160000","opcion": "0.160000"}
						 ];


			//Hacer recorrido para agregar opciones en el combobox
			opciones.forEach(function(dato, index) {

				//Si existen valores
				if(dato.value !== undefined)
				{
					$('#cmbPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar').append('<option value="'+dato.value+'">'+dato.opcion+'</option>');
				}
			  
			});


		}

		//Función para regresar obtener los datos de un tipo de gasto
		function get_datos_gasto_detalles_ordenes_compra_cuentas_pagar()
		{

			//Hacer un llamado al método del controlador para regresar los datos del tipo de gasto
            $.post('cuentas_pagar/gastos_tipos/get_datos',
                  { 
                  	strBusqueda: $("#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar").val(),
	       			strTipo: 'id'
                  },
                  function(data) {	                  	
                    if(data.row){
                      
						//Recuperar valores
						$("#txtRetencionIsr_detalles_ordenes_compra_cuentas_pagar").val(data.row.retencion_isr);
						$("#txtRetencionIva_detalles_ordenes_compra_cuentas_pagar").val(data.row.retencion_iva);
						//Hacer un llamado a la función para mostrar u ocultar retención de ISR
				        mostrar_retencion_isr_detalles_ordenes_compra_cuentas_pagar();
				        //Hacer un llamado a la función para mostrar u ocultar retención de IVA
				        mostrar_retencion_iva_detalles_ordenes_compra_cuentas_pagar(data.row.descripcion);
                    }
                  }
                 ,
                'json');
		}


		//Función para inicializar elementos del tipo de gasto
		function inicializar_gasto_detalles_ordenes_compra_cuentas_pagar()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$("#txtRetencionIsr_detalles_ordenes_compra_cuentas_pagar").val('');
			$("#txtRetencionIva_detalles_ordenes_compra_cuentas_pagar").val('');
			//Limpiar contenido de las siguientes combobox
			$("#cmbPorcentajeRetencionIsr_detalles_ordenes_compra_cuentas_pagar").val('');
			$("#cmbPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar").val('');

			//Hacer un llamado a la función para mostrar u ocultar retención de ISR
	        mostrar_retencion_isr_detalles_ordenes_compra_cuentas_pagar();
	        //Hacer un llamado a la función para mostrar u ocultar retención de IVA
	        mostrar_retencion_iva_detalles_ordenes_compra_cuentas_pagar('');
		}

		//Función para mostrar u ocultar div que contiene el campo de retención de ISR
		function mostrar_retencion_isr_detalles_ordenes_compra_cuentas_pagar()
		{
			//Si el gasto tiene retención de ISR
            if($('#txtRetencionIsr_detalles_ordenes_compra_cuentas_pagar').val() == 'SI')
            {
            	//Quitar clase no-mostrar para mostrar div que contiene la retención de ISR
			  	$('#divRetencionIsr_detalles_ordenes_compra_cuentas_pagar').removeClass("no-mostrar");
            }
            else
            {
            	//Agregar clase no-mostrar para ocultar div que contiene la retención de ISR
			    $('#divRetencionIsr_detalles_ordenes_compra_cuentas_pagar').addClass("no-mostrar");
            }

            //Hacer un llamado a la función para cambiar el tamaño de los campos: precio unitario e IVA unitario
			cambiar_tamano_campos_detalles_ordenes_compra_cuentas_pagar();
		}


		//Función para mostrar u ocultar div que contiene el campo de retención de IVA
		function mostrar_retencion_iva_detalles_ordenes_compra_cuentas_pagar(strGastoTipoVigSeg)
		{
			//Si el gasto tiene retención de IVA
            if($('#txtRetencionIva_detalles_ordenes_compra_cuentas_pagar').val() == 'SI')
            {
            	//Quitar clase no-mostrar para mostrar div que contiene la retención de IVA
			  	$('#divRetencionIva_detalles_ordenes_compra_cuentas_pagar').removeClass("no-mostrar");

			  	//Hacer un llamado a la función para agregar las opciones del combobox porcentajes de retención de IVA
			    get_opciones_cmb_retencionIVA_detalles_ordenes_compra_cuentas_pagar(strGastoTipoVigSeg);
            }
            else
            {
            	//Agregar clase no-mostrar para ocultar div que contiene la retención de IVA
			    $('#divRetencionIva_detalles_ordenes_compra_cuentas_pagar').addClass("no-mostrar");

			    
            }

            //Hacer un llamado a la función para cambiar el tamaño de los campos: precio unitario e IVA unitario
			cambiar_tamano_campos_detalles_ordenes_compra_cuentas_pagar();
		}

		//Función para inicializar elementos del porcentaje de IEPS
		function inicializar_porcentaje_ieps_detalles_ordenes_compra_cuentas_pagar()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val('');
	        $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val('');
	        $('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val('');
	        $('#txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar').val('');
	        //Hacer un llamado a la función para mostrar u ocultar IEPS unitario
	        mostrar_ieps_unitario_detalles_ordenes_compra_cuentas_pagar();
		}


		//Función para inicializar elementos del detalle
		function inicializar_detalle_ordenes_compra_cuentas_pagar()
		{
			//Limpiamos las cajas de texto
			$('#txtRenglon_detalles_ordenes_compra_cuentas_pagar').val('');
			$('#txtConcepto_detalles_ordenes_compra_cuentas_pagar').val('');
			$('#txtCantidad_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar').val('0.00');
		    $('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#txtTasaCuotaIva_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#txtTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#txtIvaUnitario_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#txtVehiculoID_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').val('');				    
		    //Limpiar contenido de los siguientes combobox
		    $('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').val('');
		    $('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').empty();
		    //Hacer un llamado a la función para mostrar u ocultar sucursal y/ módulo
      		mostrar_cmb_detalles_ordenes_compra_cuentas_pagar();
      		//Hacer un llamado a la función para mostrar u ocultar vehículo
      		mostrar_vehiculo_detalles_ordenes_compra_cuentas_pagar();
      		//Hacer un llamado a la función para inicializar elementos del porcentaje de IEPS
		    inicializar_porcentaje_ieps_detalles_ordenes_compra_cuentas_pagar();
      		//Hacer un llamado a la función para inicializar elementos del tipo de gasto
    		inicializar_gasto_detalles_ordenes_compra_cuentas_pagar();
		}


		//Función para cambiar el tamaño de los campos: precio unitario e IVA unitario
		function cambiar_tamano_campos_detalles_ordenes_compra_cuentas_pagar()
		{
			//Variable que se utiliza para cambiar el tamaño del campo a 2 posiciones
			var strClassMD2 = "col-sm-2 col-md-2 col-lg-2 col-xs-12";
			//Variable que se utiliza para cambiar el tamaño del campo a 3 posiciones
			var strClassMD3 = "col-sm-3 col-md-3 col-lg-3 col-xs-12";

			//Si se cumple la sentencia
			if($('#txtRetencionIva_detalles_ordenes_compra_cuentas_pagar').val() == 'SI' ||
			   $('#txtRetencionIeps_detalles_ordenes_compra_cuentas_pagar').val() == 'SI' || 
			   ($('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val() == 'RANGO' && 
                $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val() == 'Cuota'))
			{

				//Quitar clase para cambiar el tamaño del campo a 3 posiciones
				$('#divPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').removeClass(strClassMD2);
				$('#divIvaUnitario_detalles_ordenes_compra_cuentas_pagar').removeClass(strClassMD2);

				//Agregar clase para cambiar el tamaño del campo a 3 posiciones
			    $('#divPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').addClass(strClassMD3);
			    $('#divIvaUnitario_detalles_ordenes_compra_cuentas_pagar').addClass(strClassMD3);

			}
			else
			{

				//Quitar clase para cambiar el tamaño del campo a 2 posiciones
			    $('#divPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').removeClass(strClassMD3);
			    $('#divIvaUnitario_detalles_ordenes_compra_cuentas_pagar').removeClass(strClassMD3);

				//Agregar clase para cambiar el tamaño del campo a 2 posiciones
				$('#divPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').addClass(strClassMD2);
				$('#divIvaUnitario_detalles_ordenes_compra_cuentas_pagar').addClass(strClassMD2);

			}
			

		}


		//Función para mostrar u ocultar div que contiene el campo de IEPS unitario
		function mostrar_ieps_unitario_detalles_ordenes_compra_cuentas_pagar()
		{
			//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
            if($('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val() == 'RANGO' && 
               $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val() == 'Cuota')
            {
             	 //Quitar clase no-mostrar para mostrar div que contiene el IEPS unitario
			  	 $('#divIepsUnitario_detalles_ordenes_compra_cuentas_pagar').removeClass("no-mostrar");

			  	 //Enfocar caja de texto
			  	 $('#txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar').focus();
            }
            else
            {
                //Agregar clase no-mostrar para ocultar div que contiene el IEPS unitario
			    $('#divIepsUnitario_detalles_ordenes_compra_cuentas_pagar').addClass("no-mostrar");
            }

            //Hacer un llamado a la función para cambiar el tamaño de los campos: precio unitario e IVA unitario
			cambiar_tamano_campos_detalles_ordenes_compra_cuentas_pagar();
		}

		//Función para mostrar u ocultar div que contiene el combobox de la sucursal (módulo)
		function mostrar_cmb_detalles_ordenes_compra_cuentas_pagar(intSucursalID = null, intModuloID = null)
		{
			//Asignar el texto del combobox
			var strTipo = $('select[name="strTipo_detalles_ordenes_compra_cuentas_pagar"] option:selected').text();

		
			//Dependiendo  del tipo de gasto mostar u ocultar div´s que contienen combobox
            if(strTipo == 'GASTOS CORPORATIVOS')
            {
            	//Agregar clase no-mostrar para ocultar div que contiene el combobox del módulo
			  	$('#divCmbModuloID_detalles_ordenes_compra_cuentas_pagar').addClass("no-mostrar");
			  	//Agregar clase no-mostrar para ocultar div que contiene el combobox de la sucursal
			  	$('#divCmbSucursalID_detalles_ordenes_compra_cuentas_pagar').addClass("no-mostrar");
            }
            else if(strTipo == strCuenta602OrdenesCompraCuentasPagar)//Cuenta 602
            {
                //Quitar clase no-mostrar para mostrar div que contiene el combobox del módulo
            	$('#divCmbModuloID_detalles_ordenes_compra_cuentas_pagar').removeClass("no-mostrar");
			  	//Quitar clase no-mostrar para mostrar div que contiene el combobox de la sucursal
			  	$('#divCmbSucursalID_detalles_ordenes_compra_cuentas_pagar').removeClass("no-mostrar");

            }
            else //Cuenta 603
            {
            	//Quitar clase no-mostrar para mostrar div que contiene el combobox de la sucursal
			  	$('#divCmbSucursalID_detalles_ordenes_compra_cuentas_pagar').removeClass("no-mostrar");
            	//Agregar clase no-mostrar para ocultar div que contiene el combobox del módulo
            	$('#divCmbModuloID_detalles_ordenes_compra_cuentas_pagar').addClass("no-mostrar");
            }

            //Asignar el id de la sucursal
		    $('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').val(intSucursalID);
		     //Asignar el id del módulo
		    $('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').val(intModuloID);

		}

		//Función para mostrar u ocultar div que contiene los campos del vehículo
		function mostrar_vehiculo_detalles_ordenes_compra_cuentas_pagar()
		{
			//Si el tipo de gasto cuenta con parque vehicular
			if($('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').val() == 'SI')
			{
				//Quitar clase no-mostrar para mostrar div que contiene los campos del vehículo
	   			$('#divVehiculo_detalles_ordenes_compra_cuentas_pagar').removeClass("no-mostrar");
	   			//Enfocar caja de texto
		   	    $('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').focus();
				
			}
			else
			{
				//Agregar clase no-mostrar para ocultar div que contiene los campos del vehículo
	   			$('#divVehiculo_detalles_ordenes_compra_cuentas_pagar').addClass("no-mostrar");
	   			//Enfocar combobox
		   	    $('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').focus();
		   	    //Limpiar contenido de las siguientes cajas de texto
		   	    $('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').val('');
		   	    $('#txtVehiculoID_detalles_ordenes_compra_cuentas_pagar').val('');

			}

		}


		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_ordenes_compra_cuentas_pagar()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla ordenes_compra_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asignar el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe de la retención de ISR
			var intImporteRetencionIsr = 0;
			//Variable que se utiliza para asignar el importe unitario de la retención de ISR
			var intRetencionIsrUnitario = 0;
			//Variable que se utiliza para asignar el importe de la de retención de IVA
			var intImporteRetencionIva = 0;
		    //Variable que se utiliza para asignar el importe unitario de la de retención de IVA
			var intRetencionIvaUnitario = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;
			//Variable que se utiliza para agregar detalle en la tabla
			var strAgregar = 'SI';

			//Obtenemos los datos de las cajas de texto
			var intRenglon = $('#txtRenglon_detalles_ordenes_compra_cuentas_pagar').val();
			//Asignar el texto del combobox
			var strGastoTipo = $('select[name="strGastoTipoID_detalles_ordenes_compra_cuentas_pagar"] option:selected').text();
			var strConcepto = $('#txtConcepto_detalles_ordenes_compra_cuentas_pagar').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').val();
			var intCantidad = $('#txtCantidad_detalles_ordenes_compra_cuentas_pagar').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_ordenes_compra_cuentas_pagar').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').val();
			var strTipoTasaCuotaIeps = $('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val();
		    var strFactorTasaCuotaIeps = $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val();
			var intValorMinimoTasaCuotaIeps = $('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val();
			var intIepsUnitario = $('#txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar').val();
			var intIvaUnitario = $('#txtIvaUnitario_detalles_ordenes_compra_cuentas_pagar').val();
			var strTipoGasto = $('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').val();
			var intSucursalID = $('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').val();
			var intModuloID = $('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').val();
			var intGastoTipoID = $('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').val();
			var strParqueVehicular = $('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').val();
			var intVehiculoID = $('#txtVehiculoID_detalles_ordenes_compra_cuentas_pagar').val();
			var strVehiculo = $('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').val();
			var strRetencionIsr = $('#txtRetencionIsr_detalles_ordenes_compra_cuentas_pagar').val();
			var intPorcentajeRetencionIsr = $('#cmbPorcentajeRetencionIsr_detalles_ordenes_compra_cuentas_pagar').val();
			var strRetencionIva = $('#txtRetencionIva_detalles_ordenes_compra_cuentas_pagar').val();
			var intPorcentajeRetencionIva = $('#cmbPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar').val();


			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_cuentas_pagar').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (strParqueVehicular == '')
			{
				//Enfocar combobox
				$('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if(strParqueVehicular == 'SI' && intVehiculoID == '')
			{
				//Enfocar caja de texto
				$('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').focus();

			}
			else if (strTipoGasto == '')
			{
				//Enfocar combobox
				$('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if (strTipoGasto == strCuenta602OrdenesCompraCuentasPagar && intSucursalID == '')
			{
				//Enfocar combobox
				$('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if (strTipoGasto == strCuenta602OrdenesCompraCuentasPagar && intModuloID == '')
			{
				//Enfocar combobox
				$('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if (strTipoGasto == strCuenta603OrdenesCompraCuentasPagar && intSucursalID == '')
			{
				//Enfocar combobox
				$('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if (intGastoTipoID == '')
			{
				//Enfocar caja de texto
				$('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if (strConcepto == '')
			{
				//Enfocar caja de texto
				$('#txtConcepto_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if (intCantidad == '' || intCantidad <= 0)
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if (intPrecioUnitario == '' || intPrecioUnitario <= 0)
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if (intPorcentajeIva == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if (intIvaUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtIvaUnitario_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if(intTasaCuotaIeps == '' && intPorcentajeIeps != '')
			{
				//Limpiar caja de texto
				$('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if(intPorcentajeIeps != '' && strTipoTasaCuotaIeps == 'RANGO' && 
				   strFactorTasaCuotaIeps == 'Cuota' && intIepsUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if(strRetencionIsr == 'SI' && intPorcentajeRetencionIsr == '')
			{
				//Enfocar combobox
				$('#cmbPorcentajeRetencionIsr_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else if(strRetencionIva == 'SI' && intPorcentajeRetencionIva == '')
			{
				//Enfocar combobox
				$('#cmbPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar').focus();
			}
			else
			{

				//Crear instancia del objeto Detalle de la orden de compra
				objDetalleOrdenOrdenesCompraCuentasPagar = new DetalleOrdenOrdenesCompraCuentasPagar(null, '', '', '', 
																						             '', '', '', '',
																						             '', '',  '',  '', 
																						             '', '', '', '', 
																						             '', '', '', '', 
																						             '', '', '', '', '', '',
																						             '', '', '', '', '','');


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
					intDescuentoUnitario = intDescuentoUnitario.toFixed(intNumDecimalesDescUnitBDOrdenesCompraCuentasPagar);

					//Decrementar descuento unitario
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}
				
				//Si el tipo de gasto cuenta con retención de ISR
				if(strRetencionIsr == 'SI')
				{
					//Calcular retención de ISR unitario
					intRetencionIsrUnitario = parseFloat(intSubtotal * intPorcentajeRetencionIsr);
					//Redondear cantidad a decimales
					intRetencionIsrUnitario = intRetencionIsrUnitario.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar);
					intRetencionIsrUnitario = parseFloat(intRetencionIsrUnitario);

					//Calcular importe de la retención de ISR
					intImporteRetencionIsr = intCantidad * intRetencionIsrUnitario;
					//Redondear cantidad a decimales
			   	 	intImporteRetencionIsr = intImporteRetencionIsr.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar);
			   	 	intImporteRetencionIsr = parseFloat(intImporteRetencionIsr);


				}

				//Si el tipo de gasto cuenta con retención de IVA
				if(strRetencionIva == 'SI')
				{
					//Calcular retención de IVA unitario
					intRetencionIvaUnitario = parseFloat(intSubtotal * intPorcentajeRetencionIva);
					//Redondear cantidad a decimales
					intRetencionIvaUnitario = intRetencionIvaUnitario.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar);
					intRetencionIvaUnitario = parseFloat(intRetencionIvaUnitario);

					//Calcular importe de la retención de IVA
					intImporteRetencionIva = intCantidad * intRetencionIvaUnitario;
					//Redondear cantidad a decimales
			   	 	intImporteRetencionIva = intImporteRetencionIva.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar);
			   	 	intImporteRetencionIva = parseFloat(intImporteRetencionIva);
				}


				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;
				//Redondear cantidad a decimales
				intSubtotal = intSubtotal.toFixed(intNumDecimalesPrecioUnitBDOrdenesCompraCuentasPagar);
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
			   	 	intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDOrdenesCompraCuentasPagar);
			   	 	intImporteIeps = parseFloat(intImporteIeps);
				}

				//Si se cumplen las reglas de validación
				if(strAgregar == 'SI')
				{
					
					//Hacer un llamado a la función para inicializar elementos del detalle
					inicializar_detalle_ordenes_compra_cuentas_pagar();

					//Calcular importe de IVA
					intImporteIva = parseFloat(intCantidad * intIvaUnitario);

					//Redondear cantidad a  decimales
				    intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar);
				    intImporteIva = parseFloat(intImporteIva);

					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;
					//Decrementar importe de la retención de ISR
					intTotal -= intImporteRetencionIsr;
					//Decrementar importe de la retención de IVA
					intTotal -= intImporteRetencionIva;


					//Cambiar cantidad a  formato moneda (a visualizar)
					intCantidad =  formatMoney(intCantidad, intNumDecimalesCantidadBDOrdenesCompraCuentasPagar, '');
					intPrecioUnitario =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDOrdenesCompraCuentasPagar, '');
					
					intDescuentoUnitario =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDOrdenesCompraCuentasPagar, '');
					
					intSubtotal  =  formatMoney(intSubtotal, intNumDecimalesMostrarOrdenesCompraCuentasPagar, '');
					
					intImporteIva  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar, '');
					
					intImporteIeps  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDOrdenesCompraCuentasPagar, '');
					
					intTotal  =  formatMoney(intTotal, intNumDecimalesMostrarOrdenesCompraCuentasPagar, '');
					
					intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, 
						intNumDecimalesDescUnitBDOrdenesCompraCuentasPagar, '');

					intIepsUnitario =  formatMoney(intIepsUnitario, intNumDecimalesIepsUnitBDOrdenesCompraCuentasPagar, '');
					intIvaUnitario =  formatMoney(intIvaUnitario, intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar, '');



					//Asignar valores al objeto
					objDetalleOrdenOrdenesCompraCuentasPagar.intSucursalID = intSucursalID;
					objDetalleOrdenOrdenesCompraCuentasPagar.intModuloID = intModuloID;
					objDetalleOrdenOrdenesCompraCuentasPagar.intGastoTipoID = intGastoTipoID;
					objDetalleOrdenOrdenesCompraCuentasPagar.strGastoTipo = strGastoTipo;
					objDetalleOrdenOrdenesCompraCuentasPagar.strTipoGasto = strTipoGasto;
					objDetalleOrdenOrdenesCompraCuentasPagar.intVehiculoID = intVehiculoID;
					objDetalleOrdenOrdenesCompraCuentasPagar.strVehiculo = strVehiculo;
					objDetalleOrdenOrdenesCompraCuentasPagar.strParqueVehicular = strParqueVehicular;
					objDetalleOrdenOrdenesCompraCuentasPagar.strConcepto = strConcepto;
					objDetalleOrdenOrdenesCompraCuentasPagar.intCantidad = intCantidad;
					objDetalleOrdenOrdenesCompraCuentasPagar.intPrecioUnitario = intPrecioUnitario;
					objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeDescuento = intPorcentajeDescuento;
					objDetalleOrdenOrdenesCompraCuentasPagar.intDescuentoUnitario = intDescuentoUnitario;
					objDetalleOrdenOrdenesCompraCuentasPagar.intTasaCuotaIva = intTasaCuotaIva;
					objDetalleOrdenOrdenesCompraCuentasPagar.intImporteIva = intImporteIva;
					objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeIva = intPorcentajeIva;
					objDetalleOrdenOrdenesCompraCuentasPagar.intIvaUnitario = intIvaUnitario;
					objDetalleOrdenOrdenesCompraCuentasPagar.intTasaCuotaIeps = intTasaCuotaIeps;
					objDetalleOrdenOrdenesCompraCuentasPagar.intImporteIeps = intImporteIeps;
					objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeIeps = intPorcentajeIeps;
					objDetalleOrdenOrdenesCompraCuentasPagar.intIepsUnitario = intIepsUnitario;
					objDetalleOrdenOrdenesCompraCuentasPagar.strTipoTasaCuotaIeps = strTipoTasaCuotaIeps;
					objDetalleOrdenOrdenesCompraCuentasPagar.strFactorTasaCuotaIeps = strFactorTasaCuotaIeps;
					objDetalleOrdenOrdenesCompraCuentasPagar.intValorMinimoTasaCuotaIeps = intValorMinimoTasaCuotaIeps;
					objDetalleOrdenOrdenesCompraCuentasPagar.strRetencionIsr = strRetencionIsr;
					objDetalleOrdenOrdenesCompraCuentasPagar.intImporteRetencionIsr = intImporteRetencionIsr;
					objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeRetencionIsr = intPorcentajeRetencionIsr;
					objDetalleOrdenOrdenesCompraCuentasPagar.intRetencionIsrUnitario = intRetencionIsrUnitario;
					objDetalleOrdenOrdenesCompraCuentasPagar.strRetencionIva = strRetencionIva;
					objDetalleOrdenOrdenesCompraCuentasPagar.intImporteRetencionIva = intImporteRetencionIva;
					objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeRetencionIva = intPorcentajeRetencionIva;
					objDetalleOrdenOrdenesCompraCuentasPagar.intRetencionIvaUnitario = intRetencionIvaUnitario;

					//Revisamos si existe el renglón, si es así, editamos los datos del detalle
					if (intRenglon)
					{
						///Modificar los datos del detalle corespondiente al indice
	        			objDetallesOrdenOrdenesCompraCuentasPagar.modificarDetalle(intRenglon, objDetalleOrdenOrdenesCompraCuentasPagar);

	        			//Incrementar renglón para obtener la posición del detalle en la tabla
						intRenglon++;

						//Seleccionar el renglón de la tabla para actualizar los datos del detalle
						var selectedRow = document.getElementById("dg_detalles_ordenes_compra_cuentas_pagar").rows[intRenglon].cells;

						selectedRow[0].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strConcepto;
						selectedRow[1].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strGastoTipo;
						selectedRow[2].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intCantidad;
						selectedRow[3].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPrecioUnitario;
						selectedRow[4].innerHTML =  objDetalleOrdenOrdenesCompraCuentasPagar.intDescuentoUnitario;
						selectedRow[5].innerHTML =  intSubtotal;
						selectedRow[6].innerHTML = intImporteIva;
						selectedRow[7].innerHTML = intImporteIeps;
						selectedRow[8].innerHTML = intTotal;
						selectedRow[10].innerHTML =  objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeDescuento;
						selectedRow[11].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeIva;
						selectedRow[12].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeIeps;
						selectedRow[13].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intTasaCuotaIva;
						selectedRow[14].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intTasaCuotaIeps;
						selectedRow[15].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intIepsUnitario;
						selectedRow[16].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strTipoTasaCuotaIeps;
						selectedRow[17].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strFactorTasaCuotaIeps;
						selectedRow[18].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intValorMinimoTasaCuotaIeps;
						selectedRow[19].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strTipoGasto;
						selectedRow[20].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intSucursalID;
						selectedRow[21].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intModuloID;
						selectedRow[22].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intGastoTipoID;
						selectedRow[23].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intVehiculoID;
						selectedRow[24].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strVehiculo;
						selectedRow[25].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strParqueVehicular;
						selectedRow[26].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intIvaUnitario;
						selectedRow[27].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strRetencionIsr;
						selectedRow[28].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intImporteRetencionIsr;
						selectedRow[29].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeRetencionIsr;
						selectedRow[30].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intRetencionIsrUnitario;
						selectedRow[31].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strRetencionIva;
						selectedRow[32].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intImporteRetencionIva;
						selectedRow[33].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeRetencionIva;
						selectedRow[34].innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intRetencionIvaUnitario;

					}
					else
					{
						//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
						intRenglon = $("#dg_detalles_ordenes_compra_cuentas_pagar tr").length - 4;
						//Incrementar 1 para el siguiente renglón
						intRenglon++;

					    //Agregar datos del detalle de la orden de compra
           				objDetallesOrdenOrdenesCompraCuentasPagar.setDetalle(objDetalleOrdenOrdenesCompraCuentasPagar);

						//Insertamos el renglón con sus celdas en el objeto de la tabla
						var objRenglon = objTabla.insertRow();
						var objCeldaConcepto = objRenglon.insertCell(0);
						var objCeldaGastoTipo = objRenglon.insertCell(1);
						var objCeldaCantidad = objRenglon.insertCell(2);
						var objCeldaPrecioUnitario = objRenglon.insertCell(3);
						var objCeldaDescuentoUnitario = objRenglon.insertCell(4);
						var objCeldaSubtotal = objRenglon.insertCell(5);
						var objCeldaIva = objRenglon.insertCell(6);
						var objCeldaIeps = objRenglon.insertCell(7);
						var objCeldaTotal = objRenglon.insertCell(8);
						var objCeldaAcciones = objRenglon.insertCell(9);
						//Columnas ocultas
						var objCeldaPorcentajeDescuento = objRenglon.insertCell(10);
						var objCeldaPorcentajeIva = objRenglon.insertCell(11);
						var objCeldaPorcentajeIeps = objRenglon.insertCell(12);
						var objCeldaTasaCuotaIva = objRenglon.insertCell(13);
						var objCeldaTasaCuotaIeps = objRenglon.insertCell(14);
						var objCeldaIepsUnitario = objRenglon.insertCell(15);
						var objCeldaTipoTasaCuotaIeps = objRenglon.insertCell(16);
						var objCeldaFactorTasaCuotaIeps = objRenglon.insertCell(17);
						var objCeldaValorMinimoTasaCuotaIeps = objRenglon.insertCell(18);
						var objCeldaTipoGasto = objRenglon.insertCell(19);
						var objCeldaSucursalID = objRenglon.insertCell(20);
						var objCeldaModuloID = objRenglon.insertCell(21);
						var objCeldaGastoTipoID = objRenglon.insertCell(22);
						var objCeldaVehiculoID = objRenglon.insertCell(23);
						var objCeldaVehiculo = objRenglon.insertCell(24);
						var objCeldaParqueVehicular = objRenglon.insertCell(25);
						var objCeldaIvaUnitario = objRenglon.insertCell(26);
						var objCeldaRetencionIsr = objRenglon.insertCell(27);
						var objCeldaImporteRetencionIsr = objRenglon.insertCell(28);
						var objCeldaPorcentajeRetencionIsr = objRenglon.insertCell(29);
						var objCeldaRetencionIsrUnitario  = objRenglon.insertCell(30);
						var objCeldaRetencionIva = objRenglon.insertCell(31);
						var objCeldaImporteRetencionIva = objRenglon.insertCell(32);
						var objCeldaPorcentajeRetencionIva = objRenglon.insertCell(33);
						var objCeldaRetencionIvaUnitario  = objRenglon.insertCell(34);

						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', intRenglon);
						objCeldaConcepto.setAttribute('class', 'movil b1');
						objCeldaConcepto.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strConcepto;
						objCeldaGastoTipo.setAttribute('class', 'movil b2');
						objCeldaGastoTipo.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strGastoTipo;
						objCeldaCantidad.setAttribute('class', 'movil b3');
						objCeldaCantidad.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intCantidad;
						objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
						objCeldaPrecioUnitario.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPrecioUnitario;
						objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
						objCeldaDescuentoUnitario.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intDescuentoUnitario;
						objCeldaSubtotal.setAttribute('class', 'movil b6');
						objCeldaSubtotal.innerHTML = intSubtotal;
						objCeldaIva.setAttribute('class', 'movil b7');
						objCeldaIva.innerHTML = intImporteIva;
						objCeldaIeps.setAttribute('class', 'movil b8');
						objCeldaIeps.innerHTML = intImporteIeps;
						objCeldaTotal.setAttribute('class', 'movil b9');
						objCeldaTotal.innerHTML = intTotal;
						objCeldaAcciones.setAttribute('class', 'td-center movil b10');
						objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalles_ordenes_compra_cuentas_pagar(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_detalles_ordenes_compra_cuentas_pagar(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
						objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeDescuento.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeDescuento; 
						objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeIva.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeIva; 
						objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeIeps.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeIeps;
						objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
						objCeldaTasaCuotaIva.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intTasaCuotaIva;
						objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
						objCeldaTasaCuotaIeps.innerHTML =  objDetalleOrdenOrdenesCompraCuentasPagar.intTasaCuotaIeps;
						objCeldaIepsUnitario.setAttribute('class', 'no-mostrar');
						objCeldaIepsUnitario.innerHTML =  objDetalleOrdenOrdenesCompraCuentasPagar.intIepsUnitario;
						objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
						objCeldaTipoTasaCuotaIeps.innerHTML =  objDetalleOrdenOrdenesCompraCuentasPagar.strTipoTasaCuotaIeps;
						objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
						objCeldaFactorTasaCuotaIeps.innerHTML =  objDetalleOrdenOrdenesCompraCuentasPagar.strFactorTasaCuotaIeps;
						objCeldaValorMinimoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
						objCeldaValorMinimoTasaCuotaIeps.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intValorMinimoTasaCuotaIeps;
						objCeldaTipoGasto.setAttribute('class', 'no-mostrar');
						objCeldaTipoGasto.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strTipoGasto;
						objCeldaSucursalID.setAttribute('class', 'no-mostrar');
						objCeldaSucursalID.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intSucursalID;
						objCeldaModuloID.setAttribute('class', 'no-mostrar');
						objCeldaModuloID.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intModuloID;
						objCeldaGastoTipoID.setAttribute('class', 'no-mostrar');
						objCeldaGastoTipoID.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intGastoTipoID;
						objCeldaVehiculoID.setAttribute('class', 'no-mostrar');
						objCeldaVehiculoID.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intVehiculoID;
						objCeldaVehiculo.setAttribute('class', 'no-mostrar');
						objCeldaVehiculo.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strVehiculo;
						objCeldaParqueVehicular.setAttribute('class', 'no-mostrar');
						objCeldaParqueVehicular.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strParqueVehicular;
						objCeldaIvaUnitario.setAttribute('class', 'no-mostrar');
						objCeldaIvaUnitario.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intIvaUnitario;
						objCeldaRetencionIsr.setAttribute('class', 'no-mostrar');
						objCeldaRetencionIsr.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strRetencionIsr;
						objCeldaImporteRetencionIsr.setAttribute('class', 'no-mostrar');
						objCeldaImporteRetencionIsr.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intImporteRetencionIsr;
						objCeldaPorcentajeRetencionIsr.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeRetencionIsr.innerHTML =  objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeRetencionIsr;
						objCeldaRetencionIsrUnitario.setAttribute('class', 'no-mostrar');
						objCeldaRetencionIsrUnitario.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intRetencionIsrUnitario;
						objCeldaRetencionIva.setAttribute('class', 'no-mostrar'); 
						objCeldaRetencionIva.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.strRetencionIva;
						objCeldaImporteRetencionIva.setAttribute('class', 'no-mostrar');
						objCeldaImporteRetencionIva.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intImporteRetencionIva;
						objCeldaPorcentajeRetencionIva.setAttribute('class', 'no-mostrar');
						objCeldaPorcentajeRetencionIva.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeRetencionIva;
						objCeldaRetencionIvaUnitario.setAttribute('class', 'no-mostrar');
						objCeldaRetencionIvaUnitario.innerHTML = objDetalleOrdenOrdenesCompraCuentasPagar.intRetencionIvaUnitario;

					}

					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_detalles_ordenes_compra_cuentas_pagar();

					//Enfocar combobox
					$('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').focus();
				}
				else
				{

					//Limpiar contenido de la caja de texto
                    $('#txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar').val('');
                    //Hacer un llamado a la función para mostrar mensaje de información
                    mensaje_ordenes_compra_cuentas_pagar('informacion', 'El IEPS unitario no se encuentra dentro del rango: ' + intValorMinimoTasaCuotaIeps+ ' - '+intPorcentajeIeps);
				}
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_ordenes_compra_cuentas_pagar tr").length - 4;
			$('#numElementos_detalles_ordenes_compra_cuentas_pagar').html(intFilas);
			$('#txtNumDetalles_ordenes_compra_cuentas_pagar').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_ordenes_compra_cuentas_pagar(objRenglon)
		{
			 //Decrementar indice para obtener la posición del detalle en el arreglo
		    var intRenglon =  parseInt(objRenglon.parentNode.parentNode.rowIndex) - 1;

		    //Crear instancia del objeto Detalle de la orden de compra
        	objDetalleOrdenOrdenesCompraCuentasPagar = new DetalleOrdenOrdenesCompraCuentasPagar();

        	//Asignar datos del detalle corespondiente al indice
        	objDetalleOrdenOrdenesCompraCuentasPagar = objDetallesOrdenOrdenesCompraCuentasPagar.getDetalle(intRenglon);

			//Variable que se utiliza para asignar el id de la sucursal
			var intSucursalID = objDetalleOrdenOrdenesCompraCuentasPagar.intSucursalID;
			//Variable que se utiliza para asignar el id del módulo
			var intModuloID = objDetalleOrdenOrdenesCompraCuentasPagar.intModuloID;
			//Variable que se utiliza para asignar el id del tipo de gasto
			var intGastoTipoID = objDetalleOrdenOrdenesCompraCuentasPagar.intGastoTipoID;
			//Variable que se utiliza para asignar la descripción del tipo de gasto
			var strGastoTipo = objDetalleOrdenOrdenesCompraCuentasPagar.strGastoTipo;

			//Asignar los valores a las cajas de texto
			$('#txtRenglon_detalles_ordenes_compra_cuentas_pagar').val(intRenglon);
			$('#txtConcepto_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.strConcepto);
			$('#txtCantidad_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intCantidad);
			$('#txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intPrecioUnitario);
			$('#txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeDescuento);
			$('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeIva);
			$('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeIeps);
			$('#txtTasaCuotaIva_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intTasaCuotaIva);
			$('#txtTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intTasaCuotaIeps);
			$('#txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intIepsUnitario);
			$('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.strTipoTasaCuotaIeps);
			$('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.strFactorTasaCuotaIeps);
			$('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intValorMinimoTasaCuotaIeps);
			$('#txtVehiculoID_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intVehiculoID);
			$('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.strVehiculo);
			$('#txtIvaUnitario_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intIvaUnitario);
		    $('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.strParqueVehicular);
		    $('#txtRetencionIsr_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.strRetencionIsr);
		    $('#cmbPorcentajeRetencionIsr_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeRetencionIsr);
		    $('#txtRetencionIva_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.strRetencionIva);
		   
			//Hacer un llamado a la función para mostrar u ocultar IEPS unitario
	        mostrar_ieps_unitario_detalles_ordenes_compra_cuentas_pagar();
	        //Hacer un llamado a la función para mostrar u ocultar retención de ISR
	        mostrar_retencion_isr_detalles_ordenes_compra_cuentas_pagar();

	        //Hacer un llamado a la función para mostrar u ocultar retención de IVA
	        mostrar_retencion_iva_detalles_ordenes_compra_cuentas_pagar(strGastoTipo);

			//Asignar el tipo de gasto
	        $('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.strTipoGasto);
	        //Hacer un llamado a la función para cargar gastos en el combobox
			cargar_gastos_detalles_ordenes_compra_cuentas_pagar(intGastoTipoID);

	        //Hacer un llamado a la función para mostrar u ocultar vehículo
	        mostrar_vehiculo_detalles_ordenes_compra_cuentas_pagar();
	        
	        //Hacer un llamado a la función para mostrar u ocultar módulo
	        mostrar_cmb_detalles_ordenes_compra_cuentas_pagar(intSucursalID, intModuloID);

	        //Asignar el porcentaje de la retención de IVA (se asigna al último porque en la función get_opciones_cmb_retencionIVA_detalles_ordenes_compra_cuentas_pagar se eliminan las opciones del combobox y se agregan dependiendo del tipo de gasto)
	        $('#cmbPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar').val(objDetalleOrdenOrdenesCompraCuentasPagar.intPorcentajeRetencionIva);
			

			//Enfocar combobox
			$('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_ordenes_compra_cuentas_pagar(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;

			//Eliminar del objeto el detalle seleccionado
			objDetallesOrdenOrdenesCompraCuentasPagar.eliminarDetalle(intRenglon - 1);
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_ordenes_compra_cuentas_pagar").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_ordenes_compra_cuentas_pagar();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_ordenes_compra_cuentas_pagar tr").length - 4;
			$('#numElementos_detalles_ordenes_compra_cuentas_pagar').html(intFilas);
			$('#txtNumDetalles_ordenes_compra_cuentas_pagar').val(intFilas);

			//Enfocar combobox
			$('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_ordenes_compra_cuentas_pagar()
		{
		
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_cuentas_pagar').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;
			var intAcumRetencionIsr = 0;
			var intAcumRetencionIva = 0;

			//Variable que se utiliza para asignar el acumulado anterior del subtotal (en caso de que existan cambios calcular retención de ISR (proveedor) de lo contrario conservar el importe de retención (puede darse el caso de que el usuario modifique dicho importe))
			var intAcumSubtotalAnterior = $('#acumSubtotal_detalles_ordenes_compra_cuentas_pagar').html();

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
				intAcumRetencionIsr += parseFloat(objRen.cells[28].innerHTML);
				intAcumRetencionIva += parseFloat(objRen.cells[32].innerHTML);

				//Incrementar contador por cada registro recorridp
				intContReg++;
			}

			//Si existen retenciones de ISR
			if(intAcumRetencionIsr > 0)
			{
				//Quitar clase no-mostrar para mostar div que contiene el acumulado de las retenciones de ISR
			    $('#divAcumRetencionIsr_detalles_ordenes_compra_cuentas_pagar').removeClass("no-mostrar");
			}
			else
			{
				//Agregar clase no-mostrar para ocultar div que contiene el acumulado de las retenciones de ISR
			    $('#divAcumRetencionIsr_detalles_ordenes_compra_cuentas_pagar').addClass("no-mostrar");
			}


			//Si existen retenciones de IVA
			if(intAcumRetencionIva > 0)
			{
				//Quitar clase no-mostrar para mostar div que contiene el acumulado de las retenciones de IVA
			    $('#divAcumRetencionIva_detalles_ordenes_compra_cuentas_pagar').removeClass("no-mostrar");
			}
			else
			{
				//Agregar clase no-mostrar para ocultar div que contiene el acumulado de las retenciones de IVA
			    $('#divAcumRetencionIva_detalles_ordenes_compra_cuentas_pagar').addClass("no-mostrar");
			}


			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, intNumDecimalesCantidadBDOrdenesCompraCuentasPagar, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, intNumDecimalesDescUnitBDOrdenesCompraCuentasPagar, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarOrdenesCompraCuentasPagar, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, intNumDecimalesMostrarOrdenesCompraCuentasPagar, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, intNumDecimalesMostrarOrdenesCompraCuentasPagar, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, intNumDecimalesMostrarOrdenesCompraCuentasPagar, '');
			intAcumRetencionIsr =  '$'+formatMoney(intAcumRetencionIsr, intNumDecimalesMostrarOrdenesCompraCuentasPagar, '');
			intAcumRetencionIva =  '$'+formatMoney(intAcumRetencionIva, intNumDecimalesMostrarOrdenesCompraCuentasPagar, '');

			//Asignar los valores
			$('#acumCantidad_detalles_ordenes_compra_cuentas_pagar').html(intAcumUnidades);
			$('#acumDescuento_detalles_ordenes_compra_cuentas_pagar').html(intAcumDescuento);
			$('#acumSubtotal_detalles_ordenes_compra_cuentas_pagar').html(intAcumSubtotal);
			$('#acumIva_detalles_ordenes_compra_cuentas_pagar').html(intAcumIva);
			$('#acumIeps_detalles_ordenes_compra_cuentas_pagar').html(intAcumIeps);
			$('#acumTotal_detalles_ordenes_compra_cuentas_pagar').html(intAcumTotal);
			$('#acumRetencionIsr_detalles_ordenes_compra_cuentas_pagar').html(intAcumRetencionIsr);
			$('#acumRetencionIva_detalles_ordenes_compra_cuentas_pagar').html(intAcumRetencionIva);

			//Si no existe id de la orden de compra, significa que es un nuevo registro
			if($('#txtOrdenCompraID_ordenes_compra_cuentas_pagar').val() == '' && intContReg == 1)
			{
				//Asignar el contador para calcular el isr del único detalle
				intAcumSubtotalAnterior = intContReg;
			}


			//Si hubo cambios en el acumulado del subtotal
			if(intAcumSubtotalAnterior != intAcumSubtotal && intAcumSubtotalAnterior != '')
			{
				//Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_ordenes_compra_cuentas_pagar();
			}
			
		}

		//Función que se utiliza para calcular la retención de ISR (proveedor)
		function calcular_isr_ordenes_compra_cuentas_pagar()
		{
			 //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt($('#txtRegimenFiscalID_ordenes_compra_cuentas_pagar').val()) == intRegimenFiscalIDResicoOrdenesCompraCuentasPagar)
       	     {
       	     	//Variable que se utiliza para asignar el importe retenido
       	     	var intImporteRetenido = 0;
       	     	//Variable que se utiliza para asignar el acumulado del subtotal
				var intAcumSubtotal = 0;

       	     	//Hacer un llamado a la función para reemplazar '$' y  ','  por cadena vacia
				intAcumSubtotal =  $.reemplazar($('#acumSubtotal_detalles_ordenes_compra_cuentas_pagar').html(), "$", "");
				intAcumSubtotal =  $.reemplazar(intAcumSubtotal, ",", "");

				//Si existe porcentaje de ISR (proveedor)
				if($('#txtPorcentajeIsr_ordenes_compra_cuentas_pagar').val() != '' && intAcumSubtotal > 0 )
				{
					//Variable que se utiliza para asignar el porcentaje de retención ISR
					var intPorcentajeRetencionIsr = parseFloat($('#txtPorcentajeIsr_ordenes_compra_cuentas_pagar').val());

					//Calcular retención de ISR 
					intImporteRetenido = parseFloat(intAcumSubtotal * intPorcentajeRetencionIsr);
					//Redondear cantidad a decimales
					intImporteRetenido = intImporteRetenido.toFixed(intNumDecimalesMostrarOrdenesCompraCuentasPagar);
					intImporteRetenido = parseFloat(intImporteRetenido);
				}

				//Convertir cantidad a formato moneda
				intImporteRetenido = formatMoney(intImporteRetenido, intNumDecimalesMostrarOrdenesCompraCuentasPagar, '');

				//Asignar importe retenido 
				$('#txtImporteRetenido_ordenes_compra_cuentas_pagar').val(intImporteRetenido);

       	     }
		}

		//Función que se utiliza para calcular el IVA unitario
		function calcular_iva_unitario_detalles_ordenes_compra_cuentas_pagar()
		{
			//Variable que se utiliza para asignar el precio unitario
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').val();
			//Variable que se utiliza para asignar el porcentaje de IVA
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').val();
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
			    intIvaUnitario = intIvaUnitario.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraCuentasPagar);
				intIvaUnitario = parseFloat(intIvaUnitario);

				//Convertir cantidad a formato moneda
				intIvaUnitario =  formatMoney(intIvaUnitario, intNumDecimalesMostrarOrdenesCompraCuentasPagar, '');

				//Asignar importe de IVA unitario 
				$('#txtIvaUnitario_detalles_ordenes_compra_cuentas_pagar').val(intIvaUnitario);
			}
					
		}



		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Autorizar Orden de Compra
			*********************************************************************************************************************/
			//Modificar el mensaje cuando cambie la opción del combobox
	        $('#cmbEstatus_autorizar_ordenes_compra_cuentas_pagar').change(function(e){   
	        	//Variables que se utilizan para el mensaje informativo
	        	var strEstatus = $('#cmbEstatus_autorizar_ordenes_compra_cuentas_pagar').val();
	        	var strMensaje = '';
	        	var strFolio = $('#txtFolio_autorizar_ordenes_compra_cuentas_pagar').val();
	        	
	        	//Si existe estatus seleccionado
	        	if(strEstatus != '')
	        	{
	        		strMensaje += 'Se ';
	        		
	        		//Dependiendo del estatus modificar mensaje
	              	if($('#cmbEstatus_autorizar_ordenes_compra_cuentas_pagar').val() === 'AUTORIZADO')
	             	{
	             		strMensaje += 'autorizó ';
	             	}
	             	else
	             	{
	             		strMensaje += 'rechazó ';
	             	}

	             	//Agregar folio en el mensaje
	             	strMensaje += ' la orden de compra general '+strFolio;
	        	}
	           

             	//Asignar mensaje informativo
             	$('#txtMensaje_autorizar_ordenes_compra_cuentas_pagar').val(strMensaje);
				
	        });

			/*******************************************************************************************************************
			Controles correspondientes al modal Ordenes de Compra
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_ordenes_compra_cuentas_pagar').numeric();
			$('#txtTotalUnidades_ordenes_compra_cuentas_pagar').numeric();
			$('#txtImporteTotal_ordenes_compra_cuentas_pagar').numeric();
			$('#txtCantidad_detalles_ordenes_compra_cuentas_pagar').numeric();
			$('#txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').numeric();
			$('#txtIvaUnitario_detalles_ordenes_compra_cuentas_pagar').numeric();
        	$('#txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar').numeric();
        	$('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').numeric();
        	$('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').numeric();
        	$('#txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar').numeric();
        	$('#txtPorcentajeIsr_ordenes_compra_cuentas_pagar').numeric();
        	$('#txtImporteRetenido_ordenes_compra_cuentas_pagar').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_ordenes_compra_cuentas_pagar').blur(function(){
				$('.moneda_ordenes_compra_cuentas_pagar').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarOrdenesCompraCuentasPagar });
			});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_ordenes_compra_cuentas_pagar').blur(function(){
                $('.tipo-cambio_ordenes_compra_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_ordenes_compra_cuentas_pagar').blur(function(){
                $('.cantidad_ordenes_compra_cuentas_pagar').formatCurrency({ roundToDecimalPlace: intNumDecimalesCantidadBDOrdenesCompraCuentasPagar });
            });

             /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.precio_unitario_ordenes_compra_cuentas_pagar').blur(function(){
                $('.precio_unitario_ordenes_compra_cuentas_pagar').formatCurrency({ roundToDecimalPlace: intNumDecimalesPrecioUnitBDOrdenesCompraCuentasPagar });
            });

             /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.descuento_ordenes_compra_cuentas_pagar').blur(function(){
                $('.descuento_ordenes_compra_cuentas_pagar').formatCurrency({ roundToDecimalPlace: intNumDecimalesDescUnitBDOrdenesCompraCuentasPagar });
            });


			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_ordenes_compra_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaEntrega_ordenes_compra_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaVencimiento_ordenes_compra_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});

			//Calcular fecha de vencimiento cuando cambie la fecha
			$('#dteFecha_ordenes_compra_cuentas_pagar').on('dp.change', function (e) {
             	//Hacer un llamado a la función para calcular fecha de vencimiento
	       	    $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraCuentasPagar);
             	//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_ordenes_compra_cuentas_pagar();
			});


			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_ordenes_compra_cuentas_pagar').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_ordenes_compra_cuentas_pagar').val()) === intMonedaBaseIDOrdenesCompraCuentasPagar)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_cuentas_pagar").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_ordenes_compra_cuentas_pagar').val(intTipoCambioMonedaBaseOrdenesCompraCuentasPagar);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_ordenes_compra_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 4 });
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_cuentas_pagar").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_ordenes_compra_cuentas_pagar').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_ordenes_compra_cuentas_pagar();
             	}
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_ordenes_compra_cuentas_pagar').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_ordenes_compra_cuentas_pagar').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoOrdenesCompraCuentasPagar)
	        	{
	        		$('#txtTipoCambio_ordenes_compra_cuentas_pagar').val(intTipoCambioMaximoOrdenesCompraCuentasPagar);
	        	}

		    });


	        //Calcular fecha de vencimiento cuando cambie la opción del combobox
	        $('#cmbCondicionesPago_ordenes_compra_cuentas_pagar').change(function(e){   
	             //Hacer un llamado a la función para calcular fecha de vencimiento
	       	     $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraCuentasPagar);
	        });

			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedor_ordenes_compra_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorID_ordenes_compra_cuentas_pagar').val('');
	               //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_ordenes_compra_cuentas_pagar();
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
	       	     get_datos_proveedor_ordenes_compra_cuentas_pagar(ui);
				  

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
	        $('#txtProveedor_ordenes_compra_cuentas_pagar').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_ordenes_compra_cuentas_pagar').val() == '' ||
	               $('#txtProveedor_ordenes_compra_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorID_ordenes_compra_cuentas_pagar').val('');
	               $('#txtProveedor_ordenes_compra_cuentas_pagar').val('');
	               //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_ordenes_compra_cuentas_pagar();
	            }

	        });

	        //Autocomplete para recuperar los datos de un empleado 
	        $('#txtSolicita_ordenes_compra_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSolicitaID_ordenes_compra_cuentas_pagar').val('');
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
	             $('#txtSolicitaID_ordenes_compra_cuentas_pagar').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('recursos_humanos/empleados/get_datos',
	                  { 
	                  	strBusqueda:$("#txtSolicitaID_ordenes_compra_cuentas_pagar").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtSucursalID_ordenes_compra_cuentas_pagar").val(data.row.sucursal_id);
	                       $("#txtSucursal_ordenes_compra_cuentas_pagar").val(data.row.sucursal);
	                       $("#txtDepartamentoID_ordenes_compra_cuentas_pagar").val(data.row.departamento_id);
	                       $("#txtDepartamento_ordenes_compra_cuentas_pagar").val(data.row.departamento);
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
	        
	        //Verificar que exista id del empleado cuando pierda el enfoque la caja de texto
	        $('#txtSolicita_ordenes_compra_cuentas_pagar').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtSolicitaID_ordenes_compra_cuentas_pagar').val() == '' ||
	               $('#txtSolicita_ordenes_compra_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSolicitaID_ordenes_compra_cuentas_pagar').val('');
	               $('#txtSolicita_ordenes_compra_cuentas_pagar').val('');
	               $('#txtSucursalID_ordenes_compra_cuentas_pagar').val('');
	               $('#txtSucursal_ordenes_compra_cuentas_pagar').val('');
	               $('#txtDepartamentoID_ordenes_compra_cuentas_pagar').val('');
	               $('#txtDepartamento_ordenes_compra_cuentas_pagar').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un departamento
	        $('#txtDepartamento_ordenes_compra_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtDepartamentoID_ordenes_compra_cuentas_pagar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "recursos_humanos/departamentos/autocomplete",
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
	             $('#txtDepartamentoID_ordenes_compra_cuentas_pagar').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del departamento cuando pierda el enfoque la caja de texto
	        $('#txtDepartamento_ordenes_compra_cuentas_pagar').focusout(function(e){
	            //Si no existe id del departamento
	            if($('#txtDepartamentoID_ordenes_compra_cuentas_pagar').val() == '' ||
	               $('#txtDepartamento_ordenes_compra_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtDepartamentoID_ordenes_compra_cuentas_pagar').val('');
	               $('#txtDepartamento_ordenes_compra_cuentas_pagar').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de una sucursal
	        $('#txtSucursal_ordenes_compra_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSucursalID_ordenes_compra_cuentas_pagar').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "administracion/sucursales/autocomplete",
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
	             $('#txtSucursalID_ordenes_compra_cuentas_pagar').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la sucursal cuando pierda el enfoque la caja de texto
	        $('#txtSucursal_ordenes_compra_cuentas_pagar').focusout(function(e){
	            //Si no existe id de la sucursal
	            if($('#txtSucursalID_ordenes_compra_cuentas_pagar').val() == '' ||
	               $('#txtSucursal_ordenes_compra_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSucursalID_ordenes_compra_cuentas_pagar').val('');
	               $('#txtSucursal_ordenes_compra_cuentas_pagar').val('');
	            }

	        });


	        //Autocomplete para recuperar los datos de un porcentaje de retención ISR 
	        $('#txtPorcentajeIsr_ordenes_compra_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtPorcentajeRetencionID_ordenes_compra_cuentas_pagar').val('');
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
	             $('#txtPorcentajeRetencionID_ordenes_compra_cuentas_pagar').val(ui.item.data);
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
	        $('#txtPorcentajeIsr_ordenes_compra_cuentas_pagar').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtPorcentajeRetencionID_ordenes_compra_cuentas_pagar').val() == '' ||
	               $('#txtPorcentajeIsr_ordenes_compra_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtPorcentajeRetencionID_ordenes_compra_cuentas_pagar').val('');
	               $('#txtPorcentajeIsr_ordenes_compra_cuentas_pagar').val('');
	            }

	           //Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_ordenes_compra_cuentas_pagar();
	            
	        });

	        //Función para mover renglones arriba y abajo en la tabla
	        $('#dg_detalles_ordenes_compra_cuentas_pagar').on('click','button.btn',function(){
				//Asignar renglón mas cercano
	            var row = $(this).closest('tr');
	            //Bajar renglón
	            if ($(this).hasClass('btn-default btn-xs down'))
	            {
	            	//Verifica que no sea el último elemento del grid
	            	if( row.next().index() != -1 )
	            	{ 
	            		objDetallesOrdenOrdenesCompraCuentasPagar.swap(row.index(), row.next().index() );
	            	}	

	            	//Pasar al siguiente renglón
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
	            {
	            	//Verifica que no sea el primer elemento del grid
	            	if( row.prev().index() != -1 )
	            	{ 
	            		objDetallesOrdenOrdenesCompraCuentasPagar.swap(row.prev().index(), row.index() );
	            	}
	            	//Pasar al renglón de arriba
	            	row.prev().before(row);
	            }
				
	        });


			//Mostrar u ocultar div que contiene los campos del vehículo cuando se modifique la selección del combo
			$('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').change(function(e){

				//Si no existe parque vehicular
				if($('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').val() == '')
				{
					//Limpiar contenido del combobox
					$('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').empty();
				}
				else
				{
					//Si existe tipo de gasto
					if($('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').val() != '')
					{

						//Hacer un llamado a la función para cargar gastos en el combobox
						cargar_gastos_detalles_ordenes_compra_cuentas_pagar();

					}

				}


				//Hacer un llamado a la función para mostrar u ocultar vehículo
	       	    mostrar_vehiculo_detalles_ordenes_compra_cuentas_pagar();

			});


	        //Cargar tipos de gastos cuando se modifique la selección del combo
			$('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').change(function(e){
				//Si no existe tipo de gasto
				if($('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').val() == '')
				{
					//Limpiar contenido de los siguientes combobox
					$('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').val('');
					$('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').val('');
					$('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').empty();
					//Hacer un llamado a la función para inicializar elementos del tipo de gasto
	               	inicializar_gasto_detalles_ordenes_compra_cuentas_pagar();

				}
				else
				{

					//Limpiar contenido de los siguientes combobox
					$('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').val('');
					$('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').val('');
					//Hacer un llamado a la función para cargar gastos en el combobox
					cargar_gastos_detalles_ordenes_compra_cuentas_pagar();

					//Enfocar comobox
					$('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').focus();
				}


		       //Hacer un llamado a la función para mostrar u ocultar sucursal y/o módulo
	           mostrar_cmb_detalles_ordenes_compra_cuentas_pagar();
				
				
			});

			//Enfocar módulo ó tipo de gasto cuando se modifique la selección del combo
			$('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').change(function(e){
				
				//Asignar el texto del combobox
				var strTipo = $('select[name="strTipo_detalles_ordenes_compra_cuentas_pagar"] option:selected').text();

				//Si el tipo de gasto  corresponde a la cuenta 602
	            if(strTipo == strCuenta602OrdenesCompraCuentasPagar)
		        {
					//Enfocar comobox
					$('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').focus();
				}
				else
				{
					//Enfocar comobox
					$('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').focus();

				}
				
			
			});

			//Enfocar tipo de gasto cuando se modifique la selección del combo
			$('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').change(function(e){
				
				//Enfocar comobox
				$('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').focus();
			});

			
			//Enfocar concepto cuando se modifique la selección del combo
			$('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').change(function(e){
				//Si no existe id del tipo de gasto
				if($('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').val() == '')
				{
					//Enfocar comobox
					$('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').focus();
					//Hacer un llamado a la función para inicializar elementos del tipo de gasto
	               	inicializar_gasto_detalles_ordenes_compra_cuentas_pagar();
				}
				else
				{
					//Hacer un llamado a la función para regresar los datos del tipo de gasto
					get_datos_gasto_detalles_ordenes_compra_cuentas_pagar();
					//Enfocar caja de texto
					$('#txtConcepto_detalles_ordenes_compra_cuentas_pagar').focus();

					//Asignar el texto del combobox
					var strGastoTipo = $('select[name="strGastoTipoID_detalles_ordenes_compra_cuentas_pagar"] option:selected').text();

					//Hacer un llamado a la función para agregar las opciones del combobox porcentajes de retención de IVA
			    	get_opciones_cmb_retencionIVA_detalles_ordenes_compra_cuentas_pagar(strGastoTipo);
				}

				

			});


			//Autocomplete para recuperar los datos de un vehículo 
	        $('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtVehiculoID_detalles_ordenes_compra_cuentas_pagar').val('');
	               //Hacer un llamado a la función para inicializar elementos del vehículo
	               inicializar_vehiculo_detalles_ordenes_compra_cuentas_pagar();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "control_vehiculos/vehiculos/autocomplete",
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
	              $('#txtVehiculoID_detalles_ordenes_compra_cuentas_pagar').val(ui.item.data);
	              //Hacer un llamado a la función para regresar los datos del vehículo
	           	  get_datos_vehiculo_detalles_ordenes_compra_cuentas_pagar();
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del vehículo cuando pierda el enfoque la caja de texto
	        $('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').focusout(function(e){
	            //Si no existe id del vehículo
	            if($('#txtVehiculoID_detalles_ordenes_compra_cuentas_pagar').val() == '' ||
	               $('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVehiculoID_detalles_ordenes_compra_cuentas_pagar').val('');
	               $('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').val('');
	               //Hacer un llamado a la función para inicializar elementos del vehículo
	               inicializar_vehiculo_detalles_ordenes_compra_cuentas_pagar();
	            }

	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_detalles_ordenes_compra_cuentas_pagar').val('');
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
	             $('#txtTasaCuotaIva_detalles_ordenes_compra_cuentas_pagar').val(ui.item.data);
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
	        $('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_detalles_ordenes_compra_cuentas_pagar').val() == '' ||
	               $('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_detalles_ordenes_compra_cuentas_pagar').val('');
	               $('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').val('');
	            }

	            //Hacer un llamado a la función para calcular el importe de IVA unitario
				calcular_iva_unitario_detalles_ordenes_compra_cuentas_pagar();
	            
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val('');
	               //Hacer un llamado a la función para inicializar elementos del porcentaje de IEPS
	               inicializar_porcentaje_ieps_detalles_ordenes_compra_cuentas_pagar();
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
	             $('#txtTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val(ui.item.data);
	             $('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val(ui.item.tipo);
	             $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val(ui.item.factor);
	             $('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val(ui.item.valor_minimo);
	             //Hacer un llamado a la función para mostrar u ocultar IEPS unitario
	              mostrar_ieps_unitario_detalles_ordenes_compra_cuentas_pagar();

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
	        $('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val() == '' ||
	               $('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val('');
	               $('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').val('');
	              //Hacer un llamado a la función para inicializar elementos del porcentaje de IEPS
	               inicializar_porcentaje_ieps_detalles_ordenes_compra_cuentas_pagar();
	            }
	            
	        });


	        //Calcular el importe de IVA unitario  cuando pierda el enfoque la caja de texto
	        $('#txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').focusout(function(e){

	            //Hacer un llamado a la función para calcular el importe de IVA unitario
				calcular_iva_unitario_detalles_ordenes_compra_cuentas_pagar();
	        });



	        //Validar que exista parque vehicular cuando se pulse la tecla enter 
			$("#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe parque vehicular
		            if($('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {	
			   	    	//Si tiene parque vehicular
			   	    	if($('#cmbParqueVehicular_detalles_ordenes_compra_cuentas_pagar').val() == 'SI')
			   	    	{
			   	    		//Enfocar caja de texto
					    	$('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    	}
			   	    	else
			   	    	{
			   	    		//Enfocar combobox
			   	    		$('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    	}
			   	    	
			   	    }
		        
		        }  
		    });

		    //Validar que exista vehículo cuando se pulse la tecla enter 
			$('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id del vehículo
		         	if($('#txtVehiculoID_detalles_ordenes_compra_cuentas_pagar').val() == '' && 
		         	   $('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').val() != '')
		         	{
		         	
		         		//Enfocar caja de texto
					    $('#txtVehiculo_detalles_ordenes_compra_cuentas_pagar').focus();
		         	}
		         	else
		         	{
		         		//Enfocar combobox
					    $('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').focus();

		         	}
		        }
		    });


	        //Validar que exista tipo de gasto cuando se pulse la tecla enter 
			$("#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe tipo de gasto
		            if($('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbTipoGasto_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
		        
		        }  
		    });


		    //Validar que exista sucursal cuando se pulse la tecla enter 
			$("#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe sucursal
		            if($('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbSucursalID_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
		        
		        }  
		    });


		    //Validar que exista módulo cuando se pulse la tecla enter 
			$("#cmbModuloID_detalles_ordenes_compra_cuentas_pagar").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe módulo
		            if($('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbModuloID_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
		        
		        }  
		    });


		    //Validar que exista gasto cuando se pulse la tecla enter 
			$("#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe id del tipo de gasto
		            if($('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbGastoTipoID_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtConcepto_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
		        
		        }  
		    });

		

	        //Validar que exista concepto cuando se pulse la tecla enter 
			$('#txtConcepto_detalles_ordenes_compra_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe concepto
		           if($('#txtConcepto_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtConcepto_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_ordenes_compra_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
		        }
		    });


			//Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPrecioUnitario_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje de IVA
		            if( $('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtIvaUnitario_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
		        }
		    });

		    //Validar que exista IVA unitario cuando se pulse la tecla enter 
			$('#txtIvaUnitario_detalles_ordenes_compra_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe IVA unitario 
		            if( $('#txtIvaUnitario_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtIvaUnitario_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val() == '' && 
		         	   $('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').val() != '')
		         	{
		         	
		         		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_detalles_ordenes_compra_cuentas_pagar').focus();
		         	}
		         	else
		         	{
		         		 //Si la tasa de cuota es de tipo RANGO y su factor es Cuota
			            if($('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val() == 'RANGO' && 
			               $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_cuentas_pagar').val() == 'Cuota')
			            {
			            	//Enfocar caja de texto
					    	$('#txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar').focus();
		   	    		}
		   	    		else
		   	    		{

		   	    			//Si el tipo de gasto tiene retención de ISR
		   	    			if($('#txtRetencionIsr_detalles_ordenes_compra_cuentas_pagar').val() == 'SI')
		   	    			{
		   	    				//Enfocar combobox
		         				$('#cmbPorcentajeRetencionIsr_detalles_ordenes_compra_cuentas_pagar').focus()
		   	    			}
		   	    			else
		   	    			{
		   	    				//Hacer un llamado a la función para agregar renglón a la tabla
		   	    				agregar_renglon_detalles_ordenes_compra_cuentas_pagar();	
		   	    			}
		   	    			
		   	    		}

		         	}
		        }
		    });

		    //Validar que exista IEPS unitario cuando se pulse la tecla enter 
			$('#txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar').val() == '')
		         	{
		         		//Enfocar caja de texto
					    $('#txtIepsUnitario_detalles_ordenes_compra_cuentas_pagar').focus();
		         	}
		         	else
		         	{
		         		//Si el tipo de gasto tiene retención de ISR
		         		if($('#txtRetencionIsr_detalles_ordenes_compra_cuentas_pagar').val() == 'SI')
		         		{
		         			//Enfocar combobox
		         			$('#cmbPorcentajeRetencionIsr_detalles_ordenes_compra_cuentas_pagar').focus()
		         		}
		         		else
		         		{
		         			//Hacer un llamado a la función para agregar renglón a la tabla
		   	    			agregar_renglon_detalles_ordenes_compra_cuentas_pagar();
		         		}
		         	
		         	}
		        }
		    });

			//Validar que exista porecentaje de la retención de ISR cuando se pulse la tecla enter 
			$("#cmbPorcentajeRetencionIsr_detalles_ordenes_compra_cuentas_pagar").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe porecentaje de la retención de ISR
		            if($('#txtRetencionIsr_detalles_ordenes_compra_cuentas_pagar').val() == 'SI' &&
		            	$('#cmbPorcentajeRetencionIsr_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbPorcentajeRetencionIsr_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Si el tipo de gasto tiene retención de IVA
		         		if($('#txtRetencionIva_detalles_ordenes_compra_cuentas_pagar').val() == 'SI')
		         		{
		         			//Enfocar combobox
		         			$('#cmbPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar').focus()

			   	    	}
			   	    	else
			   	    	{
			   	    		//Hacer un llamado a la función para agregar renglón a la tabla
		   	    			agregar_renglon_detalles_ordenes_compra_cuentas_pagar();
			   	    	}
			   	    	
			   	    }
		        
		        }  
		    });

		    //Validar que exista porecentaje de la retención de IVA cuando se pulse la tecla enter 
			$("#cmbPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existe porecentaje de la retención de IVA
		            if($('#txtRetencionIva_detalles_ordenes_compra_cuentas_pagar').val() == 'SI' &&
		            	$('#cmbPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbPorcentajeRetencionIva_detalles_ordenes_compra_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
		   	    		agregar_renglon_detalles_ordenes_compra_cuentas_pagar();
			   	    	
			   	    }
		        
		        }  
		    });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_ordenes_compra_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_ordenes_compra_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_ordenes_compra_cuentas_pagar').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_ordenes_compra_cuentas_pagar').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_ordenes_compra_cuentas_pagar').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_ordenes_compra_cuentas_pagar').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedorBusq_ordenes_compra_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorIDBusq_ordenes_compra_cuentas_pagar').val('');
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
	             $('#txtProveedorIDBusq_ordenes_compra_cuentas_pagar').val(ui.item.data);
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
	        $('#txtProveedorBusq_ordenes_compra_cuentas_pagar').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorIDBusq_ordenes_compra_cuentas_pagar').val() == '' ||
	               $('#txtProveedorBusq_ordenes_compra_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorIDBusq_ordenes_compra_cuentas_pagar').val('');
	               $('#txtProveedorBusq_ordenes_compra_cuentas_pagar').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_ordenes_compra_cuentas_pagar').on('click','a',function(event){
				event.preventDefault();
				intPaginaOrdenesCompraCuentasPagar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_ordenes_compra_cuentas_pagar();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_ordenes_compra_cuentas_pagar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_ordenes_compra_cuentas_pagar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_ordenes_compra_cuentas_pagar').addClass("estatus-NUEVO");
				//Abrir modal
				 objOrdenesCompraCuentasPagar = $('#OrdenesCompraCuentasPagarBox').bPopup({
												   appendTo: '#OrdenesCompraCuentasPagarContent', 
					                               contentContainer: 'OrdenesCompraCuentasPagarM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_ordenes_compra_cuentas_pagar').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_ordenes_compra_cuentas_pagar').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_ordenes_compra_cuentas_pagar();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_ordenes_compra_cuentas_pagar();
            //Hacer un llamado a la función para cargar sucursales en el combobox del modal
            cargar_sucursales_detalles_ordenes_compra_cuentas_pagar();
            //Hacer un llamado a la función para cargar módulos en el combobox del modal
            cargar_modulos_detalles_ordenes_compra_cuentas_pagar();
		});
	</script>