	<div id="OrdenesCompraEspecialesCuentasPagarContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_ordenes_compra_especiales_cuentas_pagar" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_ordenes_compra_especiales_cuentas_pagar" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar"
				                    		name= "strFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar" 
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
								<label for="txtFechaFinalBusq_ordenes_compra_especiales_cuentas_pagar">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_ordenes_compra_especiales_cuentas_pagar'>
				                    <input class="form-control" id="txtFechaFinalBusq_ordenes_compra_especiales_cuentas_pagar"
				                    		name= "strFechaFinalBusq_ordenes_compra_especiales_cuentas_pagar" 
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
								<input id="txtProveedorIDBusq_ordenes_compra_especiales_cuentas_pagar" 
									   name="intProveedorIDBusq_ordenes_compra_especiales_cuentas_pagar"  type="hidden" 
									   value="">
								</input>
								<label for="txtProveedorBusq_ordenes_compra_especiales_cuentas_pagar">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProveedorBusq_ordenes_compra_especiales_cuentas_pagar" 
										name="strProveedorBusq_ordenes_compra_especiales_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_ordenes_compra_especiales_cuentas_pagar">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_ordenes_compra_especiales_cuentas_pagar" 
								 		name="strEstatusBusq_ordenes_compra_especiales_cuentas_pagar" tabindex="1">
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
								<label for="txtBusqueda_ordenes_compra_especiales_cuentas_pagar">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_ordenes_compra_especiales_cuentas_pagar" 
										name="strBusqueda_ordenes_compra_especiales_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_ordenes_compra_especiales_cuentas_pagar" 
									   name="strImprimirDetalles_ordenes_compra_especiales_cuentas_pagar" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_ordenes_compra_especiales_cuentas_pagar"
									onclick="paginacion_ordenes_compra_especiales_cuentas_pagar();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_ordenes_compra_especiales_cuentas_pagar" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_ordenes_compra_especiales_cuentas_pagar"
									onclick="reporte_ordenes_compra_especiales_cuentas_pagar('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_ordenes_compra_especiales_cuentas_pagar"
									onclick="reporte_ordenes_compra_especiales_cuentas_pagar('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				<table class="table-hover movil" id="dg_ordenes_compra_especiales_cuentas_pagar">
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
					<script id="plantilla_ordenes_compra_especiales_cuentas_pagar" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{proveedor}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_ordenes_compra_especiales_cuentas_pagar({{orden_compra_especial_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_ordenes_compra_especiales_cuentas_pagar({{orden_compra_especial_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!---Autorizar o rechazar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionAutorizar}}"  
										onclick="abrir_autorizar_ordenes_compra_especiales_cuentas_pagar({{orden_compra_especial_id}},'{{folio}}', 'Autorizar');"  title="Autorizar o Rechazar">
									<span class="fa fa-check-square-o"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_proveedor_ordenes_compra_especiales_cuentas_pagar({{orden_compra_especial_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_ordenes_compra_especiales_cuentas_pagar({{orden_compra_especial_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
							    <!--Subir varios archivos-->
								<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
									<span class="btn  btn-default btn-xs fileinput-button ">
								    	<span class="fa fa-upload"></span>
										<input name="archivo_varios_ordenes_compra_especiales_cuentas_pagar{{orden_compra_especial_id}}[]" id="archivo_varios_ordenes_compra_especiales_cuentas_pagar{{orden_compra_especial_id}}"  type="file" multiple accept="text/xml,application/pdf" 
											   onchange="subir_archivos_grid_ordenes_compra_especiales_cuentas_pagar({{orden_compra_especial_id}});">
								  		</input>
								    </span>
								</span>
                            	<!--Descargar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_ordenes_compra_especiales_cuentas_pagar({{orden_compra_especial_id}}, '{{folio}}');" title="Descargar archivo">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
                            	<!--Eliminar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}" 
                            			 onmousedown="eliminar_archivos_ordenes_compra_especiales_cuentas_pagar({{orden_compra_especial_id}});" title="Eliminar archivo">
                            		<span class="glyphicon glyphicon-export"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_ordenes_compra_especiales_cuentas_pagar({{orden_compra_especial_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_ordenes_compra_especiales_cuentas_pagar({{orden_compra_especial_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ordenes_compra_especiales_cuentas_pagar"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_ordenes_compra_especiales_cuentas_pagar">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Autorizar Orden de Compra-->
		<div id="AutorizarOrdenesCompraEspecialesCuentasPagarBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_autorizar_ordenes_compra_especiales_cuentas_pagar" class="ModalBodyTitle confirmacion-modal-title"">
			<h1 id="tituloModal_autorizar_ordenes_compra_especiales_cuentas_pagar"></h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAutorizarOrdenesCompraEspecialesCuentasPagar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmAutorizarOrdenesCompraEspecialesCuentasPagar"  onsubmit="return(false)" autocomplete="off">
			    	<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReferenciaID_autorizar_ordenes_compra_especiales_cuentas_pagar" 
										   name="intReferenciaID_autorizar_ordenes_compra_especiales_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el tipo de acción (guardar o autorizar) a realizar --> 
									<input type="hidden" id="txtTipoAccion_autorizar_ordenes_compra_especiales_cuentas_pagar" 
										   name="strTipoAccion_autorizar_ordenes_compra_especiales_cuentas_pagar" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el folio del registro seleccionado--> 
									<input type="hidden" id="txtFolio_autorizar_ordenes_compra_especiales_cuentas_pagar" 
										   name="strFolio_autorizar_ordenes_compra_especiales_cuentas_pagar" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Ordenes de Compra Especiales-->
									<input id="txtModalOrdenesCompraEspeciales_autorizar_ordenes_compra_especiales_cuentas_pagar" 
										   name="strModalOrdenesCompraEspeciales_autorizar_ordenes_compra_especiales_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para asignar a los usuarios que se les enviará 
									     el mensaje--> 
									<input type="hidden" id="txtUsuarios_autorizar_ordenes_compra_especiales_cuentas_pagar" 
										   name="strUsuarios_autorizar_ordenes_compra_especiales_cuentas_pagar" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Enviar notificación a:</h4>
										</div>
										<div class="panel-body">
											<div id="treeUsuarios_autorizar_ordenes_compra_especiales_cuentas_pagar" class="md-list-item-text"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="divEstatus_autorizar_ordenes_compra_especiales_cuentas_pagar" class="row no-mostrar">
						<!--Estatus-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbEstatus_autorizar_ordenes_compra_especiales_cuentas_pagar">Estatus</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbEstatus_autorizar_ordenes_compra_especiales_cuentas_pagar" 
									 		name="strEstatus_autorizar_ordenes_compra_especiales_cuentas_pagar" tabindex="1">
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
									<label for="txtMensaje_autorizar_ordenes_compra_especiales_cuentas_pagar">Mensaje</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtMensaje_autorizar_ordenes_compra_especiales_cuentas_pagar" 
											   name="strMensaje_autorizar_ordenes_compra_especiales_cuentas_pagar" rows="5" value="" tabindex="1" placeholder="Ingrese mensaje" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Autorizar o rechazar registro-->
							<button class="btn btn-success" id="btnGuardar_autorizar_ordenes_compra_especiales_cuentas_pagar"  
									onclick="validar_autorizar_ordenes_compra_especiales_cuentas_pagar();"  title="Enviar" tabindex="1">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_autorizar_ordenes_compra_especiales_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_autorizar_ordenes_compra_especiales_cuentas_pagar();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Autorizar Orden de Compra-->

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarOrdenesCompraEspecialesCuentasPagarBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_proveedor_ordenes_compra_especiales_cuentas_pagar" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarOrdenesCompraEspecialesCuentasPagar" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarOrdenesCompraEspecialesCuentasPagar"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Proveedor-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtOrdenCompraEspecialID_proveedor_ordenes_compra_especiales_cuentas_pagar" 
										   name="intOrdenCompraEspecialID_proveedor_ordenes_compra_especiales_cuentas_pagar" 
										   type="hidden" value="">
									</input>
									<label for="txtProveedor_proveedor_ordenes_compra_especiales_cuentas_pagar">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_proveedor_ordenes_compra_especiales_cuentas_pagar" 
											name="strProveedor_proveedor_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
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
									<label for="txtCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar" 
											name="strCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar" 
											name="strCopiaCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_proveedor_ordenes_compra_especiales_cuentas_pagar" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_proveedor_ordenes_compra_especiales_cuentas_pagar"  
									onclick="validar_proveedor_ordenes_compra_especiales_cuentas_pagar();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_proveedor_ordenes_compra_especiales_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_proveedor_ordenes_compra_especiales_cuentas_pagar();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal Ordenes de Compra Especiales-->
		<div id="OrdenesCompraEspecialesCuentasPagarBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_ordenes_compra_especiales_cuentas_pagar"  class="ModalBodyTitle">
			<h1>Ordenes de Compra Especiales</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmOrdenesCompraEspecialesCuentasPagar" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmOrdenesCompraEspecialesCuentasPagar"  onsubmit="return(false)" 
					  autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar" 
										   name="intOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar" type="hidden" value="">
									</input>
									<label for="txtFolio_ordenes_compra_especiales_cuentas_pagar">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_ordenes_compra_especiales_cuentas_pagar" 
											name="strFolio_ordenes_compra_especiales_cuentas_pagar" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_ordenes_compra_especiales_cuentas_pagar">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_ordenes_compra_especiales_cuentas_pagar'>
					                    <input class="form-control" id="txtFecha_ordenes_compra_especiales_cuentas_pagar"
					                    		name= "strFecha_ordenes_compra_especiales_cuentas_pagar" 
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
									<label for="cmbMonedaID_ordenes_compra_especiales_cuentas_pagar">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_ordenes_compra_especiales_cuentas_pagar" 
									 		name="intMonedaID_ordenes_compra_especiales_cuentas_pagar" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_ordenes_compra_especiales_cuentas_pagar">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_ordenes_compra_especiales_cuentas_pagar" id="txtTipoCambio_ordenes_compra_especiales_cuentas_pagar" 
											name="intTipoCambio_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
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
									<input id="txtProveedorID_ordenes_compra_especiales_cuentas_pagar" 
										   name="intProveedorID_ordenes_compra_especiales_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del régimen fiscal-->
									<input id="txtRegimenFiscalID_ordenes_compra_especiales_cuentas_pagar" 
										   name="intRegimenFiscalID_ordenes_compra_especiales_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar los días de crédito del proveedor seleccionado-->
									<input id="txtDiasCredito_ordenes_compra_especiales_cuentas_pagar" 
										   name="intDiasCredito_ordenes_compra_especiales_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
									<label for="txtProveedor_ordenes_compra_especiales_cuentas_pagar">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_ordenes_compra_especiales_cuentas_pagar" 
											name="strProveedor_ordenes_compra_especiales_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    	<!--Condiciones de pago-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCondicionesPago_ordenes_compra_especiales_cuentas_pagar">Condiciones de pago</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbCondicionesPago_ordenes_compra_especiales_cuentas_pagar" 
									 		name="strCondicionesPago_ordenes_compra_especiales_cuentas_pagar" tabindex="1">
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
									<label for="txtFechaVencimiento_ordenes_compra_especiales_cuentas_pagar">Fecha de vencimiento</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaVencimiento_ordenes_compra_especiales_cuentas_pagar'>
					                    <input class="form-control" id="txtFechaVencimiento_ordenes_compra_especiales_cuentas_pagar"
					                    		name= "strFechaVencimiento_ordenes_compra_especiales_cuentas_pagar" 
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
									<label for="txtFechaEntrega_ordenes_compra_especiales_cuentas_pagar">Fecha de entrega</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaEntrega_ordenes_compra_especiales_cuentas_pagar'>
					                    <input class="form-control" id="txtFechaEntrega_ordenes_compra_especiales_cuentas_pagar"
					                    		name= "strFechaEntrega_ordenes_compra_especiales_cuentas_pagar" 
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
									<label for="txtFactura_ordenes_compra_especiales_cuentas_pagar">Factura</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFactura_ordenes_compra_especiales_cuentas_pagar" 
											name="strFactura_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese factura" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Total de unidades-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTotalUnidades_ordenes_compra_especiales_cuentas_pagar">Total de unidades</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control cantidad_ordenes_compra_especiales_cuentas_pagar" id="txtTotalUnidades_ordenes_compra_especiales_cuentas_pagar" 
											name="intTotalUnidades_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
											tabindex="1" placeholder="Ingrese total de unidades" maxlength="21">
									</input>
								</div>
							</div>
						</div>
						<!--Total-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteTotal_ordenes_compra_especiales_cuentas_pagar">Importe total</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_ordenes_compra_especiales_cuentas_pagar" id="txtImporteTotal_ordenes_compra_especiales_cuentas_pagar" 
												name="intImporteTotal_ordenes_compra_especiales_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23">
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
									<input id="txtSolicitaID_ordenes_compra_especiales_cuentas_pagar" 
										   name="intSolicitaID_ordenes_compra_especiales_cuentas_pagar"  type="hidden" 
										   value="">
									</input>
									<label for="txtSolicita_ordenes_compra_especiales_cuentas_pagar">Solicita</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSolicita_ordenes_compra_especiales_cuentas_pagar" 
											name="strSolicita_ordenes_compra_especiales_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese quien lo solicita" maxlength="250">
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
									<label for="txtObservaciones_ordenes_compra_especiales_cuentas_pagar">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_ordenes_compra_especiales_cuentas_pagar" 
											name="strObservaciones_ordenes_compra_especiales_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
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
									<input id="txtNumDetalles_ordenes_compra_especiales_cuentas_pagar" 
										   name="intNumDetalles_ordenes_compra_especiales_cuentas_pagar" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la orden de compra</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Combobox que contiene las cuentas activas del primer nivel-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar">Tipo de gasto</label>
															</div>
															<div id="divCmbMsjValidacion" class="col-md-12">
																<select class="form-control" id="cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar" 
																 		name="strCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar" tabindex="1">
							                     				</select>
															</div>
														</div>
													</div>
													<!--Combobox que contiene las cuentas activas del segundo nivel (donde la cuenta padre sea la cuenta del primer nivel)-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar">Sucursal</label>
															</div>
															<div id="divCmbMsjValidacion" class="col-md-12">
																<select class="form-control" id="cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar" 
																 		name="strCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar" tabindex="1">
							                     				</select>
															</div>
														</div>
													</div>
													<!--Combobox que contiene las cuentas activas del tercer nivel (donde la cuenta padre sea la cuenta del segundo nivel)-->
													<div id="divCmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar" class="col-sm-3 col-md-3 col-lg-3 col-xs-12 no-mostrar">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar">Departamento</label>
															</div>
															<div id="divCmbMsjValidacion" class="col-md-12">
																<select class="form-control" id="cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar" 
																 		name="strCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar" tabindex="1">
							                     				</select>
															</div>
														</div>
													</div>
													<!--Combobox que contiene las cuentas activas del cuarto nivel (donde la cuenta padre sea la cuenta del tercer nivel)-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar">Gasto</label>
															</div>
															<div id="divCmbMsjValidacion" class="col-md-12">
																<select class="form-control" id="cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar" 
																 		name="strCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar" tabindex="1">
							                     				</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Concepto-->
													<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtConcepto_detalles_ordenes_compra_especiales_cuentas_pagar">
																	Concepto
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtConcepto_detalles_ordenes_compra_especiales_cuentas_pagar" 
																		name="strConcepto_detalles_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
																		tabindex="1" placeholder="Ingrese concepto" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_ordenes_compra_especiales_cuentas_pagar">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_ordenes_compra_especiales_cuentas_pagar" 
																		id="txtCantidad_detalles_ordenes_compra_especiales_cuentas_pagar" 
																		name="intCantidad_detalles_ordenes_compra_especiales_cuentas_pagar" 
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
																<label for="txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar">Precio unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control precio_unitario_ordenes_compra_especiales_cuentas_pagar" id="txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar" 
																		name="intPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar" type="text" value="" tabindex="1" placeholder="Ingrese precio unitario" maxlength="21">
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
																<label for="txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control descuento_ordenes_compra_especiales_cuentas_pagar" id="txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar" 
																		name="intPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar" type="text" value="0.00" 
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
																<input id="txtTasaCuotaIva_detalles_ordenes_compra_especiales_cuentas_pagar" 
																	   name="intTasaCuotaIva_detalles_ordenes_compra_especiales_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar">IVA %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar" 
																		name="intPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
																		tabindex="1" placeholder="Ingrese IVA" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--IVA unitario -->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar">IVA unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_ordenes_compra_especiales_cuentas_pagar" id="txtIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar" 
																		name="intIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
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
																<input id="txtTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar" 
																	   name="intTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el tipo de la tasa o cuota del impuesto de IEPS-->
																<input id="txtTipoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar" 
																	   name="strTipoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el factor de la tasa o cuota del impuesto de IEPS-->
																<input id="txtFactorTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar" 
																	   name="strFactorTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<!-- Caja de texto oculta para recuperar el valor mínimo de la tasa o cuota del impuesto de IEPS-->
																<input id="txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar" 
																	   name="intValorMinimoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar">IEPS %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar" 
																		name="intPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
																		tabindex="1" placeholder="Ingrese IEPS" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--IEPS unitario -->
													<div id="divIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar"  class="col-sm-2 col-md-2 col-lg-2 col-xs-10 no-mostrar">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar">IEPS unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_ordenes_compra_especiales_cuentas_pagar" id="txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar" 
																		name="intIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
																		tabindex="1" placeholder="Ingrese importe" maxlength="19">
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_detalles_ordenes_compra_especiales_cuentas_pagar"
					                                			onclick="agregar_renglon_detalles_ordenes_compra_especiales_cuentas_pagar();" 
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
													<table class="table-hover movil" id="dg_detalles_ordenes_compra_especiales_cuentas_pagar">
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
															<tr class="movil">
																<td class="movil t1">
																	<strong>Total</strong>
																</td>
																<td class="movil t2"></td>
																<td  class="movil t3">
																	<strong id="acumCantidad_detalles_ordenes_compra_especiales_cuentas_pagar"></strong>
																</td>
																<td class="movil t4"></td>
																<td class="movil t5">
																	<strong id="acumDescuento_detalles_ordenes_compra_especiales_cuentas_pagar"></strong>
																</td>
																<td class="movil t6">
																	<strong id="acumSubtotal_detalles_ordenes_compra_especiales_cuentas_pagar"></strong>
																</td>
																<td class="movil t7">
																	<strong id="acumIva_detalles_ordenes_compra_especiales_cuentas_pagar"></strong>
																</td>
																<td class="movil t8">
																	<strong  id="acumIeps_detalles_ordenes_compra_especiales_cuentas_pagar"></strong>
																</td>
																<td class="movil t9">
																	<strong id="acumTotal_detalles_ordenes_compra_especiales_cuentas_pagar"></strong>
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
																<strong id="numElementos_detalles_ordenes_compra_especiales_cuentas_pagar">0</strong> encontrados
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
							<div id="divRetencionIsr_ordenes_compra_especiales_cuentas_pagar"  class="col-sm-6 col-md-6 col-lg-6 col-xs-12 pull-right no-mostrar">
									<div class="form-group">
											<!--Porcentaje de ISR-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<input id="txtPorcentajeRetencionID_ordenes_compra_especiales_cuentas_pagar" name="intPorcentajeRetencionID_ordenes_compra_especiales_cuentas_pagar" type="hidden" value="">
														</input>
														<label for="txtPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar">Retención de ISR %</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control" id="txtPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar" 
																name="intPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
																tabindex="1" placeholder="Ingrese retención de ISR" maxlength="250">
														</input>
													</div>
												</div>
											</div>
											<!--Importe retenido-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<label for="txtImporteRetenido_ordenes_compra_especiales_cuentas_pagar">Importe de ISR</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control moneda_ordenes_compra_especiales_cuentas_pagar" id="txtImporteRetenido_ordenes_compra_especiales_cuentas_pagar" 
																name="intImporteRetenido_ordenes_compra_especiales_cuentas_pagar" type="text" value="" 
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
							<button class="btn btn-success" id="btnGuardar_ordenes_compra_especiales_cuentas_pagar"  
									onclick="validar_ordenes_compra_especiales_cuentas_pagar();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!---Autorizar o rechazar registro-->
							<button class="btn btn-default" id="btnAutorizar_ordenes_compra_especiales_cuentas_pagar"  
									onclick="abrir_autorizar_ordenes_compra_especiales_cuentas_pagar('','','Autorizar');"  title="Autorizar o Rechazar" tabindex="3" disabled>
								<span class="fa fa-check-square-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_ordenes_compra_especiales_cuentas_pagar"  
									onclick="abrir_proveedor_ordenes_compra_especiales_cuentas_pagar('');"  
									title="Enviar correo electrónico" tabindex="4" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_ordenes_compra_especiales_cuentas_pagar"  
									onclick="reporte_registro_ordenes_compra_especiales_cuentas_pagar('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
		                    <!--Subir varios archivos-->
		                    <span  class="fileupload-buttonbar" tabindex="6">
		                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_ordenes_compra_especiales_cuentas_pagar" disabled>
		                        	<span class="fa fa-upload"></span>
		                        	<input id="archivo_varios_ordenes_compra_especiales_cuentas_pagar" 
		                        		   name="archivo_varios_ordenes_compra_especiales_cuentas_pagar[]" type="file" multiple 
		                        		   accept="text/xml,application/pdf" onchange="subir_archivos_modal_ordenes_compra_especiales_cuentas_pagar('Editar');">
		                        	</input>
		                        </span>
		                    </span>
		                    <!--Descargar archivo-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_ordenes_compra_especiales_cuentas_pagar"  
									onclick="descargar_archivos_ordenes_compra_especiales_cuentas_pagar('','');"  title="Descargar archivo" tabindex="7" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Eliminar archivo-->
							<button class="btn btn-default" id="btnEliminarArchivo_ordenes_compra_especiales_cuentas_pagar"  
									onclick="eliminar_archivos_ordenes_compra_especiales_cuentas_pagar('')"  title="Eliminar archivo" tabindex="8" disabled>
								<span class="glyphicon glyphicon-export"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_ordenes_compra_especiales_cuentas_pagar"  
									onclick="cambiar_estatus_ordenes_compra_especiales_cuentas_pagar('','ACTIVO');"  title="Desactivar" tabindex="9" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_ordenes_compra_especiales_cuentas_pagar"  
									onclick="cambiar_estatus_ordenes_compra_especiales_cuentas_pagar('','INACTIVO');"  title="Restaurar" tabindex="10" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_ordenes_compra_especiales_cuentas_pagar"
									type="reset" aria-hidden="true" onclick="cerrar_ordenes_compra_especiales_cuentas_pagar();" 
									title="Cerrar"  tabindex="11">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Ordenes de Compra Especiales-->
	</div><!--#OrdenesCompraEspecialesCuentasPagarContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_ordenes_compra_especiales_cuentas_pagar" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#monedas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/monedas}} 
	</script>
	<!-- /.Plantilla para cargar las cuentas del primer nivel en el combobox-->  
	<script id="cuentas_nivel1_detalles_ordenes_compra_especiales_cuentas_pagar" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#cuentas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/cuentas}} 
	</script>
	<!-- /.Plantilla para cargar las cuentas del segundo nivel en el combobox-->  
	<script id="cuentas_nivel2_detalles_ordenes_compra_especiales_cuentas_pagar" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#cuentas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/cuentas}} 
	</script>
	<!-- /.Plantilla para cargar las cuentas del tercer nivel en el combobox-->  
	<script id="cuentas_nivel3_detalles_ordenes_compra_especiales_cuentas_pagar" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#cuentas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/cuentas}} 
	</script>
	<!-- /.Plantilla para cargar las cuentas del cuanto nivel en el combobox-->  
	<script id="cuentas_nivel4_detalles_ordenes_compra_especiales_cuentas_pagar" type="text/template">
		<option value="">Seleccione una opción</option>
		{{#cuentas}}
		<option value="{{value}}">{{nombre}}</option>
		{{/cuentas}} 
	</script>

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaOrdenesCompraEspecialesCuentasPagar = 0;
		var strUltimaBusquedaOrdenesCompraEspecialesCuentasPagar = "";
		//Variable que se utiliza para asignar el número de decimales a redondear (para visualizar)
		var intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar = <?php echo NUM_DECIMALES_MOSTRAR_CUENTAS_PAGAR ?>;
		//Variables que se utilizan para asignar el número de decimales a redondear (para guardar)
		var intNumDecimalesCantidadBDOrdenesCompraEspecialesCuentasPagar = <?php echo NUM_DECIMALES_CANTIDAD_OC_CUENTAS_PAGAR ?>;
		var intNumDecimalesPrecioUnitBDOrdenesCompraEspecialesCuentasPagar = <?php echo NUM_DECIMALES_PRECIO_UNIT_OC_CUENTAS_PAGAR ?>;
		var intNumDecimalesDescUnitBDOrdenesCompraEspecialesCuentasPagar = <?php echo NUM_DECIMALES_DESCUENTO_UNIT_OC_CUENTAS_PAGAR ?>;
		var intNumDecimalesIvaUnitBDOrdenesCompraEspecialesCuentasPagar = <?php echo NUM_DECIMALES_IVA_UNIT_OC_CUENTAS_PAGAR ?>;
		var intNumDecimalesIepsUnitBDOrdenesCompraEspecialesCuentasPagar = <?php echo NUM_DECIMALES_IEPS_UNIT_OC_CUENTAS_PAGAR ?>;
		//Variable que se utiliza para asignar la descripción de la cuenta 602
		var strCuenta602OrdenesCompraEspecialesCuentasPagar = <?php echo DESCRIPCION_CUENTA_602 ?>;
		//Variable que se utiliza para asignar la descripción de la cuenta 603
		var strCuenta603OrdenesCompraEspecialesCuentasPagar = <?php echo DESCRIPCION_CUENTA_603 ?>;
		//Variable que se utiliza para asignar la descripción de la cuenta 701
		var strCuenta701OrdenesCompraEspecialesCuentasPagar = <?php echo DESCRIPCION_CUENTA_701 ?>;

		//Variable que se utiliza para asignar el id del porcentaje de retención ISR base
		var intPorcentajeRetencionBaseIDOrdenesCompraEspecialesCuentasPagar = <?php echo PORCENTAJE_ISR_BASE ?>;

		//Variable que se utiliza para asignar el id del régimen fiscal: Régimen Simplificado de Confianza
		var intRegimenFiscalIDResicoOrdenesCompraEspecialesCuentasPagar = <?php echo REGIMEN_FISCAL_RESICO ?>;

		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDOrdenesCompraEspecialesCuentasPagar = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseOrdenesCompraEspecialesCuentasPagar = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoOrdenesCompraEspecialesCuentasPagar = <?php echo TIPO_CAMBIO_MAXIMO ?>;
	
		//Variable que se utiliza para asignar objeto del modal Autorizar Orden de Compra
		var objAutorizarOrdenesCompraEspecialesCuentasPagar = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarOrdenesCompraEspecialesCuentasPagar = null;
		//Variable que se utiliza para asignar objeto del modal Ordenes de Compra Especiales
		var objOrdenesCompraEspecialesCuentasPagar = null;

		//Array que contiene los id´s de las cajas de texto que se utilizan para calcular la fecha de vencimiento
		var arrFechaVencimientoOrdenesCompraEspecialesCuentasPagar  = {fecha: '#txtFecha_ordenes_compra_especiales_cuentas_pagar',
																	   condicionesPago: '#cmbCondicionesPago_ordenes_compra_especiales_cuentas_pagar',
																	   diasCredito: '#txtDiasCredito_ordenes_compra_especiales_cuentas_pagar',
																	   fechaVencimiento: '#txtFechaVencimiento_ordenes_compra_especiales_cuentas_pagar'
																	};



		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_ordenes_compra_especiales_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('cuentas_pagar/ordenes_compra_especiales/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_ordenes_compra_especiales_cuentas_pagar').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosOrdenesCompraEspecialesCuentasPagar = data.row;
					//Separar la cadena 
					var arrPermisosOrdenesCompraEspecialesCuentasPagar = strPermisosOrdenesCompraEspecialesCuentasPagar.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosOrdenesCompraEspecialesCuentasPagar.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosOrdenesCompraEspecialesCuentasPagar[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosOrdenesCompraEspecialesCuentasPagar[i]=='GUARDAR') || (arrPermisosOrdenesCompraEspecialesCuentasPagar[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es ADJUNTAR
						else if(arrPermisosOrdenesCompraEspecialesCuentasPagar[i]=='ADJUNTAR')
						{
							//Habilitar el control (botón Adjuntar)
							$('#btnAdjuntar_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
							//Habilitar el control (botón eliminar archivo)
							$('#btnEliminarArchivo_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosOrdenesCompraEspecialesCuentasPagar[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraEspecialesCuentasPagar[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_ordenes_compra_especiales_cuentas_pagar();
						}
						else if(arrPermisosOrdenesCompraEspecialesCuentasPagar[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
							$('#btnRestaurar_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraEspecialesCuentasPagar[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraEspecialesCuentasPagar[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraEspecialesCuentasPagar[i]=='ENVIAR CORREO')//Si el indice es ENVIAR CORREO
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraEspecialesCuentasPagar[i]=='AUTORIZAR')//Si el indice es AUTORIZAR
						{
							//Habilitar el control (botón autorizar)
							$('#btnAutorizar_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraEspecialesCuentasPagar[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_ordenes_compra_especiales_cuentas_pagar').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_ordenes_compra_especiales_cuentas_pagar() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaOrdenesCompraEspecialesCuentasPagar =($('#txtFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar').val()+$('#txtFechaFinalBusq_ordenes_compra_especiales_cuentas_pagar').val()+$('#txtProveedorIDBusq_ordenes_compra_especiales_cuentas_pagar').val()+$('#cmbEstatusBusq_ordenes_compra_especiales_cuentas_pagar').val()+$('#txtBusqueda_ordenes_compra_especiales_cuentas_pagar').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaOrdenesCompraEspecialesCuentasPagar != strUltimaBusquedaOrdenesCompraEspecialesCuentasPagar)
			{
				intPaginaOrdenesCompraEspecialesCuentasPagar = 0;
				strUltimaBusquedaOrdenesCompraEspecialesCuentasPagar = strNuevaBusquedaOrdenesCompraEspecialesCuentasPagar;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('cuentas_pagar/ordenes_compra_especiales/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_compra_especiales_cuentas_pagar').val()),
					 intProveedorID: $('#txtProveedorIDBusq_ordenes_compra_especiales_cuentas_pagar').val(),
					 strEstatus: $('#cmbEstatusBusq_ordenes_compra_especiales_cuentas_pagar').val(),
					 strBusqueda: $('#txtBusqueda_ordenes_compra_especiales_cuentas_pagar').val(),
					 intPagina: intPaginaOrdenesCompraEspecialesCuentasPagar,
					 strPermisosAcceso: $('#txtAcciones_ordenes_compra_especiales_cuentas_pagar').val()
					},
					function(data){
						$('#dg_ordenes_compra_especiales_cuentas_pagar tbody').empty();
						var tmpOrdenesCompraEspecialesCuentasPagar = Mustache.render($('#plantilla_ordenes_compra_especiales_cuentas_pagar').html(),data);
						$('#dg_ordenes_compra_especiales_cuentas_pagar tbody').html(tmpOrdenesCompraEspecialesCuentasPagar);
						$('#pagLinks_ordenes_compra_especiales_cuentas_pagar').html(data.paginacion);
						$('#numElementos_ordenes_compra_especiales_cuentas_pagar').html(data.total_rows);
						intPaginaOrdenesCompraEspecialesCuentasPagar = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_ordenes_compra_especiales_cuentas_pagar(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'cuentas_pagar/ordenes_compra_especiales/';

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
			if ($('#chbImprimirDetalles_ordenes_compra_especiales_cuentas_pagar').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_ordenes_compra_especiales_cuentas_pagar').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_ordenes_compra_especiales_cuentas_pagar').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_compra_especiales_cuentas_pagar').val()),
										'intProveedorID': $('#txtProveedorIDBusq_ordenes_compra_especiales_cuentas_pagar').val(),
										'strEstatus': $('#cmbEstatusBusq_ordenes_compra_especiales_cuentas_pagar').val(), 
										'strBusqueda': $('#txtBusqueda_ordenes_compra_especiales_cuentas_pagar').val(),
										'strDetalles': $('#chbImprimirDetalles_ordenes_compra_especiales_cuentas_pagar').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_ordenes_compra_especiales_cuentas_pagar(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'cuentas_pagar/ordenes_compra_especiales/get_reporte_registro',
							'data' : {
										'intOrdenCompraEspecialID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		

		//Función para subir archivos de un registro desde el grid view
		function subir_archivos_grid_ordenes_compra_especiales_cuentas_pagar(ordenCompraEspecialID)
		{
			//Crear instancia al objeto del formulario
	        var formData = new FormData($("#frmOrdenesCompraEspecialesCuentasPagar")[0]);
			//Agregar campos al objeto del formulario
			formData.append("intOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar", ordenCompraEspecialID);
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDGridOrdenesCompraEspecialesCuentasPagar  = "archivo_varios_ordenes_compra_especiales_cuentas_pagar"+ordenCompraEspecialID;
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDGridOrdenesCompraEspecialesCuentasPagar);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDGridOrdenesCompraEspecialesCuentasPagar)[0].files;
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
					formData.append("archivo_varios_ordenes_compra_especiales_cuentas_pagar[]", document.getElementById(strBotonArchivoIDGridOrdenesCompraEspecialesCuentasPagar).files[intCont]);
				 	
				}
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Limpia ruta del archivo cargado
		        $('#'+strBotonArchivoIDGridOrdenesCompraEspecialesCuentasPagar).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_ordenes_compra_especiales_cuentas_pagar('error', strMensajeError);
	        }
	        else
	        {
	        	//Hacer un llamado al método del controlador para subir archivos del registro
	            $.ajax({
	                url: 'cuentas_pagar/ordenes_compra_especiales/subir_archivos',
	                type: "POST",
	                data: formData,
	                contentType: false,
	                processData: false,
	                success: function(data)
	                {
	                    //Limpia ruta del archivo cargado
		         		$('#'+strBotonArchivoIDGridOrdenesCompraEspecialesCuentasPagar).val('');
						//Subida finalizada.
						if (data.resultado)
						{
		         		   //Hacer llamado a la función  para cargar  los registros en el grid
			           	   paginacion_ordenes_compra_especiales_cuentas_pagar();  
						}
                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    		mensaje_ordenes_compra_especiales_cuentas_pagar(data.tipo_mensaje, data.mensaje);
	                }
            	});

	        }

		}

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_ordenes_compra_especiales_cuentas_pagar(ordenCompraEspecialID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intOrdenCompraEspecialID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(ordenCompraEspecialID == '')
			{
				intOrdenCompraEspecialID = $('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val();
				strFolio = $('#txtFolio_ordenes_compra_especiales_cuentas_pagar').val();
			}
			else
			{
				intOrdenCompraEspecialID = ordenCompraEspecialID;
				strFolio = folio;
			}

			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'cuentas_pagar/ordenes_compra_especiales/descargar_archivos',
							'data' : {
										'intOrdenCompraEspecialID': intOrdenCompraEspecialID,
										'strFolio': strFolio				
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);
		}

		//Función que se utiliza para eliminar los archivos del registro seleccionado
		function eliminar_archivos_ordenes_compra_especiales_cuentas_pagar(id)
		{

			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;

			//Si no existe id, significa que se eliminara el archivo desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para eliminar carpeta que contiene los archivos del registro
			$.post('cuentas_pagar/ordenes_compra_especiales/eliminar_carpeta_registro',
			     {intOrdenCompraEspecialID: intID
			     },
			     function(data) {
			       
			        if(data.resultado)
			        {
			         	//Hacer llamado a la función  para cargar  los registros en el grid
		          	    paginacion_ordenes_compra_especiales_cuentas_pagar();
		          	    //Si el id del registro se obtuvo del modal
						if(id == '')
						{
							//Ocultar los siguientes botones
							$('#btnDescargarArchivo_ordenes_compra_especiales_cuentas_pagar').hide();
							$('#btnEliminarArchivo_ordenes_compra_especiales_cuentas_pagar').hide();    
						}
			        }
		        	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		       		mensaje_ordenes_compra_especiales_cuentas_pagar(data.tipo_mensaje, data.mensaje);
			       
			     },
			    'json');
		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_ordenes_compra_especiales_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_ordenes_compra_especiales_cuentas_pagar').empty();
					var temp = Mustache.render($('#monedas_ordenes_compra_especiales_cuentas_pagar').html(), data);
					$('#cmbMonedaID_ordenes_compra_especiales_cuentas_pagar').html(temp);
				},
				'json');
		}

		//Regresar el porcentaje de retención ISR base
		function cargar_porcentaje_isr_base_ordenes_compra_especiales_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/porcentaje_retencion_isr/get_datos',
			       {
			       		strBusqueda:intPorcentajeRetencionBaseIDOrdenesCompraEspecialesCuentasPagar,
			       		strTipo: 'id'
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				            $('#txtPorcentajeRetencionID_ordenes_compra_especiales_cuentas_pagar').val(data.row.porcentaje_retencion_id);
				            $('#txtPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar').val(data.row.porcentaje);
			       	    }
			       },
			       'json');
		}



		//Regresar cuentas activas para cargarlas en el combobox
		function cargar_cuentas_detalles_ordenes_compra_especiales_cuentas_pagar(strCombo, strCuentaIDNivelAnt, 
																	  strCuentaIDNivelAct = '')
		{

			//Hacer un llamado al método del controlador para regresar las cuentas que se encuentran activas 
			$.post('contabilidad/catalogo_cuentas/get_combo_box', 
				{
					strNivel: strCombo,
					strCuentaNivel: strCuentaIDNivelAnt
				},
				function(data)
				{
						//Dependiendo del nivel cargar datos en el combobox
						if (strCombo == 'NIVEL 1')
						{
							$('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
							var temp = Mustache.render($('#cuentas_nivel1_detalles_ordenes_compra_especiales_cuentas_pagar').html(), data);
							$('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').html(temp);
							
						}
						else if (strCombo == 'NIVEL 2')
						{
							$('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
							var temp = Mustache.render($('#cuentas_nivel2_detalles_ordenes_compra_especiales_cuentas_pagar').html(), data);
							$('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').html(temp);

							//Asignar el id de la cuenta del nivel 1
							$('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').val(strCuentaIDNivelAnt);

							//Si existe cuenta del nivel 2
							if(strCuentaIDNivelAct != '')
							{
								//Asignar el id de la cuenta del nivel 2
								$('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').val(strCuentaIDNivelAct);
							}

						}
						else if (strCombo == 'NIVEL 3')
						{

							$('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
							var temp = Mustache.render($('#cuentas_nivel3_detalles_ordenes_compra_especiales_cuentas_pagar').html(), data);
							$('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').html(temp);

							//Asignar el id de la cuenta del nivel 2
							$('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').val(strCuentaIDNivelAnt);

							//Si existe cuenta del nivel 3
							if(strCuentaIDNivelAct != '')
							{
								//Asignar el id de la cuenta del nivel 3
								$('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').val(strCuentaIDNivelAct);
							}

						}
						else if (strCombo == 'NIVEL 4')
						{
							$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
							var temp = Mustache.render($('#cuentas_nivel4_detalles_ordenes_compra_especiales_cuentas_pagar').html(), data);
							$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').html(temp);

							//Asignar el id de la cuenta del nivel 3
							$('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').val(strCuentaIDNivelAnt);

							//Si existe cuneta del nivel 4
							if(strCuentaIDNivelAct != '')
							{
								//Asignar el id de la cuenta del nivel 4
								$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').val(strCuentaIDNivelAct);
							}

						}
				},
				'json');
		}

		/*******************************************************************************************************************
		Funciones del modal Autorizar Orden de Compra
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_autorizar_ordenes_compra_especiales_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmAutorizarOrdenesCompraEspecialesCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_ordenes_compra_especiales_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmAutorizarOrdenesCompraEspecialesCuentasPagar').find('input[type=hidden]').val('');
			//Agregar clase no-mostrar para ocultar div que contiene el estatus
			$('#divEstatus_autorizar_ordenes_compra_especiales_cuentas_pagar').addClass("no-mostrar");
		    $('#divEncabezadoModal_autorizar_ordenes_compra_especiales_cuentas_pagar').addClass("estatus-ACTIVO");
		}

		//Función que se utiliza para abrir el modal
		function abrir_autorizar_ordenes_compra_especiales_cuentas_pagar(id, folio, tipoAccion)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_autorizar_ordenes_compra_especiales_cuentas_pagar();
			
			//Variables que se utilizan para asignar los datos del registro
			var intReferenciaID = 0;
			var strFolio = '';

			//Si no existe id, significa que se aplicará autorización (o rechazo) desde el modal
			if(id == '')
			{
				intReferenciaID = $('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val();
				strFolio =  $('#txtFolio_ordenes_compra_especiales_cuentas_pagar').val();
				$('#txtModalOrdenesCompraEspeciales_autorizar_ordenes_compra_especiales_cuentas_pagar').val('SI');
			}
			else
			{
				intReferenciaID = id;
				strFolio = folio;
				$('#txtModalOrdenesCompraEspeciales_autorizar_ordenes_compra_especiales_cuentas_pagar').val('NO');
			}

			//Asignar datos del registro seleccionado
			$('#txtReferenciaID_autorizar_ordenes_compra_especiales_cuentas_pagar').val(intReferenciaID);
			$('#txtTipoAccion_autorizar_ordenes_compra_especiales_cuentas_pagar').val(tipoAccion);
			$('#txtFolio_autorizar_ordenes_compra_especiales_cuentas_pagar').val(strFolio);

			//Si el tipo de acción corresponde a Guardar
			if(tipoAccion == 'Guardar')
			{
				//Cambiar título del modal
				$('#tituloModal_autorizar_ordenes_compra_especiales_cuentas_pagar').text('Notificar Orden de Compra');
				$('#txtMensaje_autorizar_ordenes_compra_especiales_cuentas_pagar').val('Favor de autorizar la orden de compra especial '+ strFolio);
				//Cargar el treeview
				get_treeview_usuarios_autorizar_ordenes_compra_especiales_cuentas_pagar('');
			}
			else
			{
				//Quitar clase no-mostrar para mostrar div que contiene el estatus
				$('#divEstatus_autorizar_ordenes_compra_especiales_cuentas_pagar').removeClass("no-mostrar");
				//Cambiar título del modal
				$('#tituloModal_autorizar_ordenes_compra_especiales_cuentas_pagar').text('Autorizar Orden de Compra');
				//Cargar el treeview
				get_treeview_usuarios_autorizar_ordenes_compra_especiales_cuentas_pagar(intReferenciaID);
			}

			//Abrir modal
			objAutorizarOrdenesCompraEspecialesCuentasPagar = $('#AutorizarOrdenesCompraEspecialesCuentasPagarBox').bPopup({
													   appendTo: '#OrdenesCompraEspecialesCuentasPagarContent', 
							                           contentContainer: 'OrdenesCompraEspecialesCuentasPagarM', 
							                           zIndex: 2, 
							                           modalClose: false, 
							                           modal: true, 
							                           follow: [true,false], 
							                           followEasing : "linear", 
							                           easing: "linear", 
							                           modalColor: ('#F0F0F0')});
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_autorizar_ordenes_compra_especiales_cuentas_pagar()
		{
			try {
				//Cerrar modal
				objAutorizarOrdenesCompraEspecialesCuentasPagar.close();
				//Eliminar datos del treeview
				$("#treeUsuarios_autorizar_ordenes_compra_especiales_cuentas_pagar").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_autorizar_ordenes_compra_especiales_cuentas_pagar()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosAutorizarOrdenesCompraEspecialesCuentasPagar = [];

			//Recorremos el treeview
			$("#treeUsuarios_autorizar_ordenes_compra_especiales_cuentas_pagar").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosAutorizarOrdenesCompraEspecialesCuentasPagar.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtUsuarios_autorizar_ordenes_compra_especiales_cuentas_pagar").val(arrSeleccionadosAutorizarOrdenesCompraEspecialesCuentasPagar.join('|'));
			
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_ordenes_compra_especiales_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmAutorizarOrdenesCompraEspecialesCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_autorizar_ordenes_compra_especiales_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba un mensaje'}
											}
										},
										strUsuarios_autorizar_ordenes_compra_especiales_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un usuario para este mensaje.'}
											}
										}, 
										strEstatus_autorizar_ordenes_compra_especiales_cuentas_pagar: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista estatus seleccionado cuando el tipo de acción sea Autorizar
					                                    if($('#txtTipoAccion_autorizar_ordenes_compra_especiales_cuentas_pagar').val() === 'Autorizar' && $('#cmbEstatus_autorizar_ordenes_compra_especiales_cuentas_pagar').val() == '')
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
			var bootstrapValidator_autorizar_ordenes_compra_especiales_cuentas_pagar = $('#frmAutorizarOrdenesCompraEspecialesCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_autorizar_ordenes_compra_especiales_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_autorizar_ordenes_compra_especiales_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para guardar la solicitud de autorización
				guardar_autorizar_ordenes_compra_especiales_cuentas_pagar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_autorizar_ordenes_compra_especiales_cuentas_pagar()
		{
			try
			{
				$('#frmAutorizarOrdenesCompraEspecialesCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar la autorización (o el rechazo) de un registro
		function guardar_autorizar_ordenes_compra_especiales_cuentas_pagar()
		{
			//Hacer un llamado al método del controlador para enviar la autorización (o el rechazo) de un registro 
			$.post('cuentas_pagar/ordenes_compra_especiales/set_enviar_autorizacion',
			     {intOrdenCompraEspecialID: $('#txtReferenciaID_autorizar_ordenes_compra_especiales_cuentas_pagar').val(),
			      strUsuarios: $('#txtUsuarios_autorizar_ordenes_compra_especiales_cuentas_pagar').val(), 
			      strMensaje:  $('#txtMensaje_autorizar_ordenes_compra_especiales_cuentas_pagar').val(),
			      strEstatus:  $('#cmbEstatus_autorizar_ordenes_compra_especiales_cuentas_pagar').val(),
			      strTipoAccion:  $('#txtTipoAccion_autorizar_ordenes_compra_especiales_cuentas_pagar').val()
			     },
			     function(data) {
			        if(data.resultado)
			        {
			          	//Hacer llamado a la función  para cargar  los registros en el grid
			          	paginacion_ordenes_compra_especiales_cuentas_pagar();
			          	//Hacer un llamado a la función para cerrar modal
					  	cerrar_autorizar_ordenes_compra_especiales_cuentas_pagar();

					  	//Si el id de la referencia (para la autorización) se recuperó del modal Ordenes de Compra Especiales 
					  	if($('#txtModalOrdenesCompraEspeciales_autorizar_ordenes_compra_especiales_cuentas_pagar').val() == 'SI')
					  	{
					  		//Hacer un llamado a la función para cerrar modal Ordenes de Compra Especiales 
					 	 	cerrar_ordenes_compra_especiales_cuentas_pagar();
					  	}   
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_ordenes_compra_especiales_cuentas_pagar(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		/*Función que se utiliza para definir tree view de usuarios con acceso a la función Autorizar del proceso
		 *Ordenes de Compra Especiales (módulo Cuentas por Pagar)*/
		function get_treeview_usuarios_autorizar_ordenes_compra_especiales_cuentas_pagar(id)
		{
			$('#treeUsuarios_autorizar_ordenes_compra_especiales_cuentas_pagar').fancytree({
				source: {
					url: "seguridad/usuarios/get_treeview/AUTORIZAR_ORDENES_COMPRA_ESPECIALES_CUENTAS_PAGAR/ORDENES DE COMPRA ESPECIALES/"+id,
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
		function nuevo_proveedor_ordenes_compra_especiales_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmEnviarOrdenesCompraEspecialesCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedor_ordenes_compra_especiales_cuentas_pagar();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_proveedor_ordenes_compra_especiales_cuentas_pagar');
		    
		}

		//Función que se utiliza para abrir el modal
		function abrir_proveedor_ordenes_compra_especiales_cuentas_pagar(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_proveedor_ordenes_compra_especiales_cuentas_pagar();
			//Variables que se utilizan para asignar los datos del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_pagar/ordenes_compra_especiales/get_datos',
			       {intOrdenCompraEspecialID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtOrdenCompraEspecialID_proveedor_ordenes_compra_especiales_cuentas_pagar').val(data.row.orden_compra_especial_id);
							$('#txtProveedor_proveedor_ordenes_compra_especiales_cuentas_pagar').val(data.row.proveedor);
							$('#txtCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_proveedor_ordenes_compra_especiales_cuentas_pagar').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarOrdenesCompraEspecialesCuentasPagar = $('#EnviarOrdenesCompraEspecialesCuentasPagarBox').bPopup({
																   appendTo: '#OrdenesCompraEspecialesCuentasPagarContent', 
										                           contentContainer: 'OrdenesCompraEspecialesCuentasPagarM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_proveedor_ordenes_compra_especiales_cuentas_pagar()
		{
			try {
				//Cerrar modal
				objEnviarOrdenesCompraEspecialesCuentasPagar.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_proveedor_ordenes_compra_especiales_cuentas_pagar();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_proveedor_ordenes_compra_especiales_cuentas_pagar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedor_ordenes_compra_especiales_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarOrdenesCompraEspecialesCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar: {
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
			var bootstrapValidator_proveedor_ordenes_compra_especiales_cuentas_pagar = $('#frmEnviarOrdenesCompraEspecialesCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_proveedor_ordenes_compra_especiales_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_proveedor_ordenes_compra_especiales_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_proveedor_ordenes_compra_especiales_cuentas_pagar();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_proveedor_ordenes_compra_especiales_cuentas_pagar()
		{
			try
			{
				$('#frmEnviarOrdenesCompraEspecialesCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al proveedor
		function enviar_correo_proveedor_ordenes_compra_especiales_cuentas_pagar()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_proveedor_ordenes_compra_especiales_cuentas_pagar();
			//Hacer un llamado al método del controlador para enviar correo electrónico al proveedor
			$.post('cuentas_pagar/ordenes_compra_especiales/enviar_correo_electronico_proveedor',
					{ 
						intOrdenCompraEspecialID: $('#txtOrdenCompraEspecialID_proveedor_ordenes_compra_especiales_cuentas_pagar').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_proveedor_ordenes_compra_especiales_cuentas_pagar').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_proveedor_ordenes_compra_especiales_cuentas_pagar();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_proveedor_ordenes_compra_especiales_cuentas_pagar();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_compra_especiales_cuentas_pagar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_proveedor_ordenes_compra_especiales_cuentas_pagar()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_proveedor_ordenes_compra_especiales_cuentas_pagar").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_proveedor_ordenes_compra_especiales_cuentas_pagar()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_proveedor_ordenes_compra_especiales_cuentas_pagar").addClass('no-mostrar');
		}


		/*******************************************************************************************************************
		Funciones del modal Ordenes de Compra Especiales
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_ordenes_compra_especiales_cuentas_pagar()
		{
			//Incializar formulario
			$('#frmOrdenesCompraEspecialesCuentasPagar')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_compra_especiales_cuentas_pagar();
			//Limpiar cajas de texto ocultas
			$('#frmOrdenesCompraEspecialesCuentasPagar').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_ordenes_compra_especiales_cuentas_pagar');
			
		    //Eliminar los datos de la tabla detalles de la orden de compra
		    $('#dg_detalles_ordenes_compra_especiales_cuentas_pagar tbody').empty();
		    $('#acumCantidad_detalles_ordenes_compra_especiales_cuentas_pagar').html('');
		    $('#acumDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').html('');
		    $('#acumSubtotal_detalles_ordenes_compra_especiales_cuentas_pagar').html('');
		    $('#acumIva_detalles_ordenes_compra_especiales_cuentas_pagar').html('');
		    $('#acumIeps_detalles_ordenes_compra_especiales_cuentas_pagar').html('');
		    $('#acumTotal_detalles_ordenes_compra_especiales_cuentas_pagar').html('');
			$('#numElementos_detalles_ordenes_compra_especiales_cuentas_pagar').html(0);
			//Limpiar contenido de los siguientes combobox
		    $('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
		    $('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
		    $('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
		    $('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
		    //Hacer un llamado a la función para mostrar u ocultar cuenta del nivel 3
	        mostrar_cuenta_nivel3_detalles_ordenes_compra_especiales_cuentas_pagar();
			
			//Asignar NO para indicar que no se ha abierto el modal Autorizar Orden de Compra
			$('#txtModalOrdenesCompraEspeciales_autorizar_ordenes_compra_especiales_cuentas_pagar').val('NO');
			//Habilitar todos los elementos del formulario
			$('#frmOrdenesCompraEspecialesCuentasPagar').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_ordenes_compra_especiales_cuentas_pagar').val(fechaActual()); 
			$('#txtFechaVencimiento_ordenes_compra_especiales_cuentas_pagar').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_ordenes_compra_especiales_cuentas_pagar').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_ordenes_compra_especiales_cuentas_pagar").show();
			$("#btnAdjuntar_ordenes_compra_especiales_cuentas_pagar").show();
			//Ocultar los siguientes botones
			$("#btnAutorizar_ordenes_compra_especiales_cuentas_pagar").hide();
			$("#btnEnviarCorreo_ordenes_compra_especiales_cuentas_pagar").hide();
			$("#btnImprimirRegistro_ordenes_compra_especiales_cuentas_pagar").hide();
			$("#btnDescargarArchivo_ordenes_compra_especiales_cuentas_pagar").hide();
			$("#btnEliminarArchivo_ordenes_compra_especiales_cuentas_pagar").hide();
			$("#btnDesactivar_ordenes_compra_especiales_cuentas_pagar").hide();
			$("#btnRestaurar_ordenes_compra_especiales_cuentas_pagar").hide();

			//Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_ordenes_compra_especiales_cuentas_pagar();

		}


		//Función para inicializar elementos del proveedor
		function inicializar_proveedor_ordenes_compra_especiales_cuentas_pagar()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtDiasCredito_ordenes_compra_especiales_cuentas_pagar').val('');
            $('#txtRegimenFiscalID_ordenes_compra_especiales_cuentas_pagar').val('');
            $('#txtPorcentajeRetencionID_ordenes_compra_especiales_cuentas_pagar').val('');
            $('#txtPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar').val('');
            $('#txtImporteRetenido_ordenes_compra_especiales_cuentas_pagar').val('');

            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
	        mostrar_retencion_isr_ordenes_compra_especiales_cuentas_pagar();
            
		}

		
		//Función que se utiliza para cerrar el modal
		function cerrar_ordenes_compra_especiales_cuentas_pagar()
		{
			try {
				//Cerrar modal
				objOrdenesCompraEspecialesCuentasPagar.close();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
			    cerrar_proveedor_ordenes_compra_especiales_cuentas_pagar();
				//Si el id de la referencia (para la autorización) se recuperó del modal Ordenes de Compra Especiales 
				if($('#txtModalOrdenesCompraEspeciales_autorizar_ordenes_compra_especiales_cuentas_pagar').val() == 'SI')
				{
					//Hacer un llamado a la función para cerrar modal Autorizar Orden de Compra
					cerrar_autorizar_ordenes_compra_especiales_cuentas_pagar();
				}
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_ordenes_compra_especiales_cuentas_pagar()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_compra_especiales_cuentas_pagar();
			//Validación del formulario de campos obligatorios
			$('#frmOrdenesCompraEspecialesCuentasPagar')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_ordenes_compra_especiales_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaEntrega_ordenes_compra_especiales_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaVencimiento_ordenes_compra_especiales_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strCondicionesPago_ordenes_compra_especiales_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una condición de pago'}
											}
										},
										intMonedaID_ordenes_compra_especiales_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_ordenes_compra_especiales_cuentas_pagar: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_ordenes_compra_especiales_cuentas_pagar').val()) !== intMonedaBaseIDOrdenesCompraEspecialesCuentasPagar)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoOrdenesCompraEspecialesCuentasPagar)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoOrdenesCompraEspecialesCuentasPagar
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strProveedor_ordenes_compra_especiales_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtProveedorID_ordenes_compra_especiales_cuentas_pagar').val() === '')
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
										intPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el id del porcentaje de retención ISR
						                                    if(parseInt($('#txtRegimenFiscalID_ordenes_compra_especiales_cuentas_pagar').val()) === intRegimenFiscalIDResicoOrdenesCompraEspecialesCuentasPagar)
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
										intImporteRetenido_ordenes_compra_especiales_cuentas_pagar: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el id del porcentaje de retención ISR
						                                    if(parseInt($('#txtRegimenFiscalID_ordenes_compra_especiales_cuentas_pagar').val()) === intRegimenFiscalIDResicoOrdenesCompraEspecialesCuentasPagar)
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
										strSolicita_ordenes_compra_especiales_cuentas_pagar: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtSolicitaID_ordenes_compra_especiales_cuentas_pagar').val() === '')
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
										intTotalUnidades_ordenes_compra_especiales_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba el total de unidades'}
											}
										},
										intImporteTotal_ordenes_compra_especiales_cuentas_pagar: {
											validators: {
												notEmpty: {message: 'Escriba el importe total'}
											}
										},
										intNumDetalles_ordenes_compra_especiales_cuentas_pagar: {
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
										strConcepto_detalles_ordenes_compra_especiales_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_detalles_ordenes_compra_especiales_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar: {
											excluded: true  //Ignorar (no valida el campo)
										},
										intIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_ordenes_compra_especiales_cuentas_pagar = $('#frmOrdenesCompraEspecialesCuentasPagar').data('bootstrapValidator');
			bootstrapValidator_ordenes_compra_especiales_cuentas_pagar.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_ordenes_compra_especiales_cuentas_pagar.isValid())
			{
				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesOrdenesCompraEspecialesCuentasPagar = $.reemplazar($('#acumTotal_detalles_ordenes_compra_especiales_cuentas_pagar').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesOrdenesCompraEspecialesCuentasPagar = $.reemplazar(intAcumTotalDetallesOrdenesCompraEspecialesCuentasPagar, ",", "");

				var intImporteTotalOrdenesCompraEspecialesCuentasPagar = $.reemplazar($('#txtImporteTotal_ordenes_compra_especiales_cuentas_pagar').val(), ",", "");
 
				//Verificar que el total de unidades sea igual a la cantidad de detalles
				if($('#acumCantidad_detalles_ordenes_compra_especiales_cuentas_pagar').html() != $('#txtTotalUnidades_ordenes_compra_especiales_cuentas_pagar').val())
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_ordenes_compra_especiales_cuentas_pagar('error', 'El total de unidades no coincide con los detalles, favor de verificar.');
					
				}
				//Verificar que el importe total sea igual al total de detalles
				else if(intAcumTotalDetallesOrdenesCompraEspecialesCuentasPagar != intImporteTotalOrdenesCompraEspecialesCuentasPagar)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_ordenes_compra_especiales_cuentas_pagar('error', 'El importe total no coincide con los detalles, favor de verificar.');
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_ordenes_compra_especiales_cuentas_pagar();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_ordenes_compra_especiales_cuentas_pagar()
		{
			try
			{
				$('#frmOrdenesCompraEspecialesCuentasPagar').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_ordenes_compra_especiales_cuentas_pagar()
		{
			//Obtenemos un array con los datos del archivo
    		var arrArchivoOrdenesCompraEspecialesCuentasPagar = $("#archivo_varios_ordenes_compra_especiales_cuentas_pagar");

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_especiales_cuentas_pagar').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrCuentaID = [];
			var arrConceptos = [];
			var arrCantidades = [];
			var arrPreciosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrTasaCuotaIva = [];
			var arrIvasUnitarios = [];
			var arrTasaCuotaIeps = [];
			var arrIepsUnitarios = [];
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioOrden = parseFloat($('#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var intCantidad = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intPrecioUnitario = $.reemplazar(objRen.cells[15].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[16].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[17].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[18].innerHTML, ",", "");

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
				intIvaUnitario = intIvaUnitario.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraEspecialesCuentasPagar);
				intIvaUnitario = parseFloat(intIvaUnitario);

				
				//Redondear cantidad a decimales
				intIepsUnitario = intIepsUnitario.toFixed(intNumDecimalesIepsUnitBDOrdenesCompraEspecialesCuentasPagar);
				intIepsUnitario = parseFloat(intIepsUnitario);


				//Asignar valores a los arrays
				arrConceptos.push(objRen.getAttribute('id'));
				arrCantidades.push(intCantidad);
				arrPreciosUnitarios.push(intPrecioUnitario);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrTasaCuotaIva.push(objRen.cells[13].innerHTML);
				arrIvasUnitarios.push(intIvaUnitario);
				arrTasaCuotaIeps.push(objRen.cells[14].innerHTML);
				arrIepsUnitarios.push(intIepsUnitario );
				arrCuentaID.push(objRen.cells[28].innerHTML);
			}


			//Variable que se utiliza para asignar el importe retenido de ISR (proveedor)
			var intRetencionIsrProv =  parseFloat($.reemplazar($('#txtImporteRetenido_ordenes_compra_especiales_cuentas_pagar').val(), ",", ""));

			//Si existe retención de ISR (proveedor)
			if(intRetencionIsrProv > 0)
			{
				//Convertir importes a peso mexicano
				intRetencionIsrProv = intRetencionIsrProv * intTipoCambioOrden;
				//Redondear cantidad a decimales
				intRetencionIsrProv = intRetencionIsrProv.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraEspecialesCuentasPagar);
				intRetencionIsrProv = parseFloat(intRetencionIsrProv);
			}


			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('cuentas_pagar/ordenes_compra_especiales/guardar',
					{ 
						//Datos de la orden de compra
						intOrdenCompraEspecialID: $('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val(),
						strFolioConsecutivo: $('#txtFolio_ordenes_compra_especiales_cuentas_pagar').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_ordenes_compra_especiales_cuentas_pagar').val()),
						dteFechaEntrega: $.formatFechaMysql($('#txtFechaEntrega_ordenes_compra_especiales_cuentas_pagar').val()),
						dteFechaVencimiento: $.formatFechaMysql($('#txtFechaVencimiento_ordenes_compra_especiales_cuentas_pagar').val()),
						strCondicionesPago: $('#cmbCondicionesPago_ordenes_compra_especiales_cuentas_pagar').val(),
						intMonedaID: $('#cmbMonedaID_ordenes_compra_especiales_cuentas_pagar').val(),
						intTipoCambio: intTipoCambioOrden,
						strFactura: $('#txtFactura_ordenes_compra_especiales_cuentas_pagar').val(),
						intProveedorID: $('#txtProveedorID_ordenes_compra_especiales_cuentas_pagar').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_ordenes_compra_especiales_cuentas_pagar').val(),
						intPorcentajeRetencionID: $('#txtPorcentajeRetencionID_ordenes_compra_especiales_cuentas_pagar').val(),
						intImporteRetenido: intRetencionIsrProv,
						intSolicitaID: $('#txtSolicitaID_ordenes_compra_especiales_cuentas_pagar').val(),
						strObservaciones: $('#txtObservaciones_ordenes_compra_especiales_cuentas_pagar').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_ordenes_compra_especiales_cuentas_pagar').val(),
						//Datos de los detalles
						strCuentaID: arrCuentaID.join('|'),
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
							if($('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val() == '')
							{
							  	//Asignar el id de la orden de compra registrada en la base de datos
                     			$('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val(data.orden_compra_especial_id);
                     			//Asignar folio consecutivo
                 				$('#txtFolio_ordenes_compra_especiales_cuentas_pagar').val(data.folio);
                 			}

             				//Si existen archivos seleccionados
             				if(arrArchivoOrdenesCompraEspecialesCuentasPagar != undefined )
             				{
             					//Hacer un llamado a la función para subir el archivo
	                    		subir_archivos_modal_ordenes_compra_especiales_cuentas_pagar('Nuevo');
             				}
             				else
             				{
             					//Hacer un llamado a la función para cerrar modal
		                    	cerrar_ordenes_compra_especiales_cuentas_pagar();
		                    	//Hacer un llamado a la función para abrir modal de autorización
								abrir_autorizar_ordenes_compra_especiales_cuentas_pagar($('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val(), $('#txtFolio_ordenes_compra_especiales_cuentas_pagar').val(), 'Guardar');

								//Hacer llamado a la función  para cargar  los registros en el grid
		               			paginacion_ordenes_compra_especiales_cuentas_pagar();  
             				}

						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_compra_especiales_cuentas_pagar(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_ordenes_compra_especiales_cuentas_pagar(tipoMensaje, mensaje)
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
                                                $('#txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
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
		function cambiar_estatus_ordenes_compra_especiales_cuentas_pagar(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val();

			}
			else
			{
				intID = id;
			}

		    //Si el estatus del registro es ACTIVO
		    if(estatus == 'ACTIVO')
		    {
				//Preguntar al usuario si desea desactivar el registro
				new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
						             {'type':     'question',
						              'title':    'Ordenes de Compra Especiales',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              	//Hacer un llamado a la función para modificar el estatus del registro
													    set_estatus_ordenes_compra_especiales_cuentas_pagar(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_ordenes_compra_especiales_cuentas_pagar(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_ordenes_compra_especiales_cuentas_pagar(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('cuentas_pagar/ordenes_compra_especiales/set_estatus',
			      {intOrdenCompraEspecialID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_ordenes_compra_especiales_cuentas_pagar();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_ordenes_compra_especiales_cuentas_pagar();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_ordenes_compra_especiales_cuentas_pagar(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ordenes_compra_especiales_cuentas_pagar(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('cuentas_pagar/ordenes_compra_especiales/get_datos',
			       {
			       		intOrdenCompraEspecialID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ordenes_compra_especiales_cuentas_pagar();
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
				            $('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val(data.row.orden_compra_especial_id);
				            $('#txtFolio_ordenes_compra_especiales_cuentas_pagar').val(data.row.folio);
				            $('#txtFecha_ordenes_compra_especiales_cuentas_pagar').val(data.row.fecha);
				            $('#txtFechaEntrega_ordenes_compra_especiales_cuentas_pagar').val(data.row.fecha_entrega);
				            $('#txtFechaVencimiento_ordenes_compra_especiales_cuentas_pagar').val(data.row.fecha_vencimiento);
				            $('#cmbCondicionesPago_ordenes_compra_especiales_cuentas_pagar').val(data.row.condiciones_pago);
				            $('#cmbMonedaID_ordenes_compra_especiales_cuentas_pagar').val(data.row.moneda_id);
				            $('#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar').val(data.row.tipo_cambio);
				            $('#txtFactura_ordenes_compra_especiales_cuentas_pagar').val(data.row.factura);
				            $('#txtProveedorID_ordenes_compra_especiales_cuentas_pagar').val(data.row.proveedor_id);
						    $('#txtProveedor_ordenes_compra_especiales_cuentas_pagar').val(data.row.proveedor);
						    $('#txtRegimenFiscalID_ordenes_compra_especiales_cuentas_pagar').val(data.row.regimen_fiscal_id);
						    $('#txtPorcentajeRetencionID_ordenes_compra_especiales_cuentas_pagar').val(data.row.porcentaje_retencion_id);
						    $('#txtPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar').val(data.row.porcentaje_isr);
						    $('#txtImporteRetenido_ordenes_compra_especiales_cuentas_pagar').val(intRetencionIsrProv);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporteRetenido_ordenes_compra_especiales_cuentas_pagar').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar });
						    $('#txtDiasCredito_ordenes_compra_especiales_cuentas_pagar').val(data.row.dias_credito);
						    $('#txtSolicitaID_ordenes_compra_especiales_cuentas_pagar').val(data.row.solicita_id);
						    $('#txtSolicita_ordenes_compra_especiales_cuentas_pagar').val(data.row.solicita);
						    $('#txtObservaciones_ordenes_compra_especiales_cuentas_pagar').val(data.row.observaciones);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_ordenes_compra_especiales_cuentas_pagar').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_ordenes_compra_especiales_cuentas_pagar").show();
				            //Ocultar botón Adjuntar archivo
				            $("#btnAdjuntar_ordenes_compra_especiales_cuentas_pagar").hide();

				            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	    				 mostrar_retencion_isr_ordenes_compra_especiales_cuentas_pagar();



				            //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar los siguientes botones
				            	$("#btnDescargarArchivo_ordenes_compra_especiales_cuentas_pagar").show();
				            	$('#btnEliminarArchivo_ordenes_compra_especiales_cuentas_pagar').show();
				           	}

							//Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmOrdenesCompraEspecialesCuentasPagar').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					            $("#btnGuardar_ordenes_compra_especiales_cuentas_pagar").hide();
					           
					            //Si el estatus del registro es INACTIVO
				            	if(strEstatus == 'INACTIVO')
				            	{
				            		//Mostrar botón Restaurar
				            		$("#btnRestaurar_ordenes_compra_especiales_cuentas_pagar").show();
				            	}
				            	else //Si el estatus del registro es AUTORIZADO
				            	{
				            		//Mostrar botón Enviar correo  
				            		$("#btnEnviarCorreo_ordenes_compra_especiales_cuentas_pagar").show();
				            	}

				            }
				            else //ACTIVO O RECHAZADO
				            {
				            	 strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_detalles_ordenes_compra_especiales_cuentas_pagar(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_detalles_ordenes_compra_especiales_cuentas_pagar(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDOrdenesCompraEspecialesCuentasPagar)
							    {
									//Habilitar caja de texto
									$("#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar").removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar las siguientes cajas de texto
									$("#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar").attr('disabled','disabled');
							    }

				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
					            {
					            	
					            	//Mostrar los siguientes botones  
					            	$("#btnDesactivar_ordenes_compra_especiales_cuentas_pagar").show();
					            	$("#btnEnviarCorreo_ordenes_compra_especiales_cuentas_pagar").show();
					            	$("#btnAutorizar_ordenes_compra_especiales_cuentas_pagar").show();
					            	$("#btnAdjuntar_ordenes_compra_especiales_cuentas_pagar").show();
					            }
				            }


				           

				           	//Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_ordenes_compra_especiales_cuentas_pagar').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaConcepto = objRenglon.insertCell(0);
								var objCeldaCuenta = objRenglon.insertCell(1);
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
								var objCeldaPrecioUnitarioBD = objRenglon.insertCell(15);
								var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(16);
								var objCeldaIvaBD = objRenglon.insertCell(17);
								var objCeldaIepsBD = objRenglon.insertCell(18);
								var objCeldaIepsUnitario = objRenglon.insertCell(19);
								var objCeldaTipoTasaCuotaIeps = objRenglon.insertCell(20);
								var objCeldaFactorTasaCuotaIeps = objRenglon.insertCell(21);
								var objCeldaValorMinimoTasaCuotaIeps = objRenglon.insertCell(22);
								var objCeldaCuentaIDNivel1 = objRenglon.insertCell(23);
								var objCeldaCuentaIDNivel2 = objRenglon.insertCell(24);
								var objCeldaCuentaIDNivel3 = objRenglon.insertCell(25);
								var objCeldaCuentaIDNivel4 = objRenglon.insertCell(26);
								var objCeldaIvaUnitario = objRenglon.insertCell(27);
								var objCeldaCuentaID = objRenglon.insertCell(28);

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
								intCantidad =  formatMoney(intCantidad, intNumDecimalesCantidadBDOrdenesCompraEspecialesCuentasPagar, '');
								var intPrecioUnitarioMostrar =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDOrdenesCompraEspecialesCuentasPagar, '');
								
								var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDOrdenesCompraEspecialesCuentasPagar, '');
								
								var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');
								
								var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');
								
								var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');
								
								var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');
								
								intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, intNumDecimalesDescUnitBDOrdenesCompraEspecialesCuentasPagar, '');

								intIepsUnitario = formatMoney(intIepsUnitario, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');

								intIvaUnitario = formatMoney(intIvaUnitario, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');

								//Cambiar cantidad a  formato moneda (a guardar en la  BD)
								var intPrecioUnitarioBD =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDOrdenesCompraEspecialesCuentasPagar, '');
								
								var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDOrdenesCompraEspecialesCuentasPagar, '');
								
								var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDOrdenesCompraEspecialesCuentasPagar, '');
								
								var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDOrdenesCompraEspecialesCuentasPagar, '');
						
								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].concepto);
								objCeldaConcepto.setAttribute('class', 'movil b1');
								objCeldaConcepto.innerHTML = data.detalles[intCon].concepto;
								objCeldaCuenta.setAttribute('class', 'movil b2');
								objCeldaCuenta.innerHTML = data.detalles[intCon].cuenta_nivel4;
								objCeldaCantidad.setAttribute('class', 'movil b3');
								objCeldaCantidad.innerHTML = intCantidad;
								objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
								objCeldaPrecioUnitario.innerHTML = intPrecioUnitarioMostrar;
								objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
								objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitarioMostrar;
								objCeldaSubtotal.setAttribute('class', 'movil b6');
								objCeldaSubtotal.innerHTML = intSubtotalMostrar;
								objCeldaIva.setAttribute('class', 'movil b7');
								objCeldaIva.innerHTML = intImporteIvaMostrar;
								objCeldaIeps.setAttribute('class', 'movil b8');
								objCeldaIeps.innerHTML = intImporteIepsMostrar;
								objCeldaTotal.setAttribute('class', 'movil b9');
								objCeldaTotal.innerHTML = intTotalMostrar;
								objCeldaAcciones.setAttribute('class', 'td-center movil b10');
								objCeldaAcciones.innerHTML =strAccionesTabla;
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
								objCeldaPrecioUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaPrecioUnitarioBD.innerHTML =  intPrecioUnitarioBD;
								objCeldaDescuentoUnitarioBD.setAttribute('class', 'no-mostrar');
								objCeldaDescuentoUnitarioBD.innerHTML =  intDescuentoUnitarioBD;
								objCeldaIvaBD.setAttribute('class', 'no-mostrar');
								objCeldaIvaBD.innerHTML =  intImporteIvaBD;
								objCeldaIepsBD.setAttribute('class', 'no-mostrar');
								objCeldaIepsBD.innerHTML =  intImporteIepsBD;
								objCeldaIepsUnitario.setAttribute('class', 'no-mostrar');
								objCeldaIepsUnitario.innerHTML =  intIepsUnitario;
								objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTipoTasaCuotaIeps.innerHTML =  data.detalles[intCon].tipo_ieps;
								objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaFactorTasaCuotaIeps.innerHTML = data.detalles[intCon].factor_ieps;
								objCeldaValorMinimoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaValorMinimoTasaCuotaIeps.innerHTML = data.detalles[intCon].valor_minimo_ieps;
								objCeldaCuentaIDNivel1.setAttribute('class', 'no-mostrar');
								objCeldaCuentaIDNivel1.innerHTML =  data.detalles[intCon].cuentaID_nivel1;
								objCeldaCuentaIDNivel2.setAttribute('class', 'no-mostrar');
								objCeldaCuentaIDNivel2.innerHTML =  data.detalles[intCon].cuentaID_nivel2;
								objCeldaCuentaIDNivel3.setAttribute('class', 'no-mostrar');
								objCeldaCuentaIDNivel3.innerHTML =  data.detalles[intCon].cuentaID_nivel3;
								objCeldaCuentaIDNivel4.setAttribute('class', 'no-mostrar');
								objCeldaCuentaIDNivel4.innerHTML =  data.detalles[intCon].cuentaID_nivel4;
								objCeldaIvaUnitario.setAttribute('class', 'no-mostrar');
								objCeldaIvaUnitario.innerHTML =  intIvaUnitario;
								objCeldaCuentaID.setAttribute('class', 'no-mostrar');
								objCeldaCuentaID.innerHTML = data.detalles[intCon].cuenta_id;

				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_ordenes_compra_especiales_cuentas_pagar();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_ordenes_compra_especiales_cuentas_pagar tr").length - 2;
							$('#numElementos_detalles_ordenes_compra_especiales_cuentas_pagar').html(intFilas);
							$('#txtNumDetalles_ordenes_compra_especiales_cuentas_pagar').val(intFilas);
							
							
			            	//Abrir modal
				            objOrdenesCompraEspecialesCuentasPagar = $('#OrdenesCompraEspecialesCuentasPagarBox').bPopup({
														  appendTo: '#OrdenesCompraEspecialesCuentasPagarContent', 
							                              contentContainer: 'OrdenesCompraEspecialesCuentasPagarM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#cmbMonedaID_ordenes_compra_especiales_cuentas_pagar').focus();
			       	    }
			       },
			       'json');
		}


		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_ordenes_compra_especiales_cuentas_pagar()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_ordenes_compra_especiales_cuentas_pagar').val()) !== intMonedaBaseIDOrdenesCompraEspecialesCuentasPagar)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_ordenes_compra_especiales_cuentas_pagar').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_ordenes_compra_especiales_cuentas_pagar').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar").val(data.row.tipo_cambio_sat);
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}

		//Función para subir los archivos de un registro desde el modal
		function subir_archivos_modal_ordenes_compra_especiales_cuentas_pagar(tipoAccion)
		{
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDOrdenesCompraEspecialesCuentasPagar  = "archivo_varios_ordenes_compra_especiales_cuentas_pagar";
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDOrdenesCompraEspecialesCuentasPagar);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDOrdenesCompraEspecialesCuentasPagar)[0].files;
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
			    $('#'+strBotonArchivoIDOrdenesCompraEspecialesCuentasPagar).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_ordenes_compra_especiales_cuentas_pagar('error', strMensajeError);
	        }
	        else
	        {
	        	//Si existe id del registro subir los archivos
	        	if($('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val() != '')
	        	{
		        	//Crear instancia al objeto del formulario
		        	var formData = new FormData($("#frmOrdenesCompraEspecialesCuentasPagar")[0]);
		        	//Hacer un llamado al método del controlador para subir archivos del registro
		            $.ajax({
		                url: 'cuentas_pagar/ordenes_compra_especiales/subir_archivos',
		                type: "POST",
		                data: formData,
		                contentType: false,
		                processData: false,
		                success: function(data)
		                {
		                    //Limpia ruta del archivo cargado
			         		$('#'+strBotonArchivoIDOrdenesCompraEspecialesCuentasPagar).val('');
							//Subida finalizada.
							if (data.resultado)
							{
							   //Mostrar los siguientes botones
		                       $('#btnDescargarArchivo_ordenes_compra_especiales_cuentas_pagar').show();
		                       $("#btnEliminarArchivo_ordenes_compra_especiales_cuentas_pagar").show();
			         		   //Hacer llamado a la función  para cargar  los registros en el grid
				           	   paginacion_ordenes_compra_especiales_cuentas_pagar();  
							}

							//Si la acción corresponde a un nuevo registro
		                    if(tipoAccion == 'Nuevo')
		                    {
		                    	//Si el tipo de mensaje es un éxito
				                if(data.tipo_mensaje == 'éxito')
				                {
					                //Hacer un llamado a la función para cerrar modal
					                cerrar_ordenes_compra_especiales_cuentas_pagar();
					                //Hacer un llamado a la función para abrir modal de autorización
									abrir_autorizar_ordenes_compra_especiales_cuentas_pagar($('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val(), $('#txtFolio_ordenes_compra_especiales_cuentas_pagar').val(), 'Guardar');
				                }
				                else
				                {
				                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    			mensaje_ordenes_compra_especiales_cuentas_pagar(data.tipo_mensaje, data.mensaje);
				                }
		                    }
		                    else
		                    {

		                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    		mensaje_ordenes_compra_especiales_cuentas_pagar(data.tipo_mensaje, data.mensaje);
		                    }
		                }
	            	});
	            }
	        }
			
		}

		
		 //Función para asignar los datos de un proveedor
		function get_datos_proveedor_ordenes_compra_especiales_cuentas_pagar(ui)
		{
		 	//Asignar valores del registro seleccionado
             $('#txtProveedorID_ordenes_compra_especiales_cuentas_pagar').val(ui.item.data);
             $('#txtDiasCredito_ordenes_compra_especiales_cuentas_pagar').val(ui.item.dias_credito);
             $('#txtRegimenFiscalID_ordenes_compra_especiales_cuentas_pagar').val(ui.item.regimen_fiscal_id);
             //Hacer un llamado a la función para calcular fecha de vencimiento
       	     $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraEspecialesCuentasPagar);

       	     //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt(ui.item.regimen_fiscal_id) == intRegimenFiscalIDResicoOrdenesCompraEspecialesCuentasPagar)
       	     {
       	     	//Hacer un llamado a la función para cargar el porcentaje de retención ISR base
       			cargar_porcentaje_isr_base_ordenes_compra_especiales_cuentas_pagar();
       	     }

       	     //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_ordenes_compra_especiales_cuentas_pagar();

		}

		//Función para mostrar u ocultar div que contiene el campo de retención de ISR (proveedor)
		function mostrar_retencion_isr_ordenes_compra_especiales_cuentas_pagar()
		{
			//Si el gasto tiene retención de ISR
            if(parseInt($('#txtRegimenFiscalID_ordenes_compra_especiales_cuentas_pagar').val()) == intRegimenFiscalIDResicoOrdenesCompraEspecialesCuentasPagar)
            {
            	//Quitar clase no-mostrar para mostrar div que contiene la retención de ISR (proveedor)
			  	$('#divRetencionIsr_ordenes_compra_especiales_cuentas_pagar').removeClass("no-mostrar");
            }
            else
            {
            	//Agregar clase no-mostrar para ocultar div que contiene la retención de ISR (proveedor)
			    $('#divRetencionIsr_ordenes_compra_especiales_cuentas_pagar').addClass("no-mostrar");
            }

		}


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/

		//Función para inicializar elementos del porcentaje de IEPS
		function inicializar_porcentaje_ieps_detalles_ordenes_compra_especiales_cuentas_pagar()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
	        $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
	        $('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
	        $('#txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
	        //Hacer un llamado a la función para mostrar u ocultar IEPS unitario
	        mostrar_ieps_unitario_detalles_ordenes_compra_especiales_cuentas_pagar();
		}


		//Función para mostrar u ocultar div que contiene el campo de IEPS unitario
		function mostrar_ieps_unitario_detalles_ordenes_compra_especiales_cuentas_pagar()
		{
			//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
            if($('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val() == 'RANGO' && 
               $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val() == 'Cuota')
            {
             	 //Quitar clase no-mostrar para mostrar div que contiene el IEPS unitario
			  	 $('#divIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').removeClass("no-mostrar");
			  	 //Enfocar caja de texto
			  	 $('#txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
            }
            else
            {
                //Agregar clase no-mostrar para ocultar div que contiene el IEPS unitario
			    $('#divIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').addClass("no-mostrar");
            }
		}

		//Función para mostrar u ocultar div que contiene el combobox de la cuenta nivel 3
		function mostrar_cuenta_nivel3_detalles_ordenes_compra_especiales_cuentas_pagar()
		{
			//Asignar el texto del combobox
			var strCuentaNivel1 = $('select[name="strCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar"] option:selected').text();

			//Si la cuenta del nivel 1 corresponde a la cuenta 602
            if(strCuentaNivel1 == strCuenta602OrdenesCompraEspecialesCuentasPagar)
            {
             	 //Quitar clase no-mostrar para mostrar div que contiene el combobox de la cuenta nivel 3
			  	 $('#divCmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').removeClass("no-mostrar");
			  	 
            }
            else
            {
                //Agregar clase no-mostrar para ocultar div que contiene el combobox de la cuenta nivel 3
			    $('#divCmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').addClass("no-mostrar");
            }

		}


		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_ordenes_compra_especiales_cuentas_pagar()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla ordenes_compra_especiales_detalles)
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
			//Asignar el texto del combobox
			var strCuenta = $('select[name="strCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar"] option:selected').text();
			var strConcepto = $('#txtConcepto_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var intCantidad = $('#txtCantidad_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var strTipoTasaCuotaIeps = $('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val();
		    var strFactorTasaCuotaIeps = $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var intValorMinimoTasaCuotaIeps = $('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var intIepsUnitario = $('#txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var strCuentaIDNivel1 = $('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var strCuentaNivel1 = $('select[name="strCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar"] option:selected').text();
			var strCuentaIDNivel2 = $('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var strCuentaIDNivel3 = $('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var strCuentaIDNivel4 = $('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			var intIvaUnitario = $('#txtIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val();


			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_especiales_cuentas_pagar').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (strCuentaIDNivel4 == '')
			{
				//Enfocar caja de texto
				$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			}
			else if (strConcepto == '')
			{
				//Enfocar caja de texto
				$('#txtConcepto_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			}
			else if (intCantidad == '' || intCantidad <= 0)
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			}
			else if (intPrecioUnitario == '' || intPrecioUnitario <= 0)
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			}
			else if (intPorcentajeIva == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			}
			else if (intIvaUnitario == '')
			{
				//Enfocar caja de texto
				$('#txtIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			}
			else if(intTasaCuotaIeps == '' && intPorcentajeIeps != '')
			{
				//Limpiar caja de texto
				$('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			}
			else
			{
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
					intDescuentoUnitario = intDescuentoUnitario.toFixed(intNumDecimalesDescUnitBDOrdenesCompraEspecialesCuentasPagar);

					//Decrementar descuento unitario
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}
				

				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;
				//Redondear cantidad a decimales
				intSubtotal = intSubtotal.toFixed(intNumDecimalesPrecioUnitBDOrdenesCompraEspecialesCuentasPagar);
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
					
					//Redondear cantidad a dos decimales
			   	 	intImporteIeps = intImporteIeps.toFixed(intNumDecimalesIepsUnitBDOrdenesCompraEspecialesCuentasPagar);
			   	 	intImporteIeps = parseFloat(intImporteIeps);
				}

				//Si la cuenta del nivel 1 corresponde a la cuenta 603
	            if(strCuentaNivel1 == strCuenta603OrdenesCompraEspecialesCuentasPagar)
	            {
	            	//Asignar el id de la cuenta del nivel 2
	            	strCuentaIDNivel3 = strCuentaIDNivel2;
	            }
				
				//Si se cumplen las reglas de validación
				if(strAgregar == 'SI')
				{
					//Limpiamos las cajas de texto
					$('#txtConcepto_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
					$('#txtCantidad_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				    $('#txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				    $('#txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').val('0.00');
				    $('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				    $('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				    $('#txtTasaCuotaIva_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				    $('#txtTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				    $('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				    $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				    $('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				    $('#txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				    $('#txtIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				    //Limpiar contenido de los siguientes combobox
				    $('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
				    $('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
				    $('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
				    $('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
				    //Hacer un llamado a la función para mostrar u ocultar cuenta del nivel 3
	          		mostrar_cuenta_nivel3_detalles_ordenes_compra_especiales_cuentas_pagar();

				    //Agregar clase no-mostrar para ocultar div que contiene el IEPS unitario
			    	$('#divIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').addClass("no-mostrar");
					//Calcular importe de IVA
					intImporteIva = parseFloat(intCantidad * intIvaUnitario);

					//Redondear cantidad a dos decimales
				    intImporteIva = intImporteIva.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraEspecialesCuentasPagar);
				    intImporteIva = parseFloat(intImporteIva);

					//Calcular importe total
					intTotal = intSubtotal + intImporteIva + intImporteIeps;

					//Cambiar cantidad a  formato moneda (a visualizar)
					intCantidad =  formatMoney(intCantidad, intNumDecimalesCantidadBDOrdenesCompraEspecialesCuentasPagar, '');
					var intPrecioUnitarioMostrar =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDOrdenesCompraEspecialesCuentasPagar, '');
					
					var intDescuentoUnitarioMostrar =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDOrdenesCompraEspecialesCuentasPagar, '');
					
					var intSubtotalMostrar  =  formatMoney(intSubtotal, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');
					
					var intImporteIvaMostrar  =  formatMoney(intImporteIva, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');
					
					var intImporteIepsMostrar  =  formatMoney(intImporteIeps, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');
					
					var intTotalMostrar  =  formatMoney(intTotal, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');
					
					intPorcentajeDescuento  = formatMoney(intPorcentajeDescuento, 
						intNumDecimalesDescUnitBDOrdenesCompraEspecialesCuentasPagar, '');

					intIepsUnitario =  formatMoney(intIepsUnitario, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');
					intIvaUnitario =  formatMoney(intIvaUnitario, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');

					//Cambiar cantidad a  formato moneda (a guardar en la  BD)
					var intPrecioUnitarioBD =  formatMoney(intPrecioUnitario, intNumDecimalesPrecioUnitBDOrdenesCompraEspecialesCuentasPagar, '');
					
					var intDescuentoUnitarioBD =  formatMoney(intDescuentoUnitario, intNumDecimalesDescUnitBDOrdenesCompraEspecialesCuentasPagar, '');
					
					var intImporteIvaBD  =  formatMoney(intImporteIva, intNumDecimalesIvaUnitBDOrdenesCompraEspecialesCuentasPagar, '');
					
					var intImporteIepsBD  =  formatMoney(intImporteIeps, intNumDecimalesIepsUnitBDOrdenesCompraEspecialesCuentasPagar, '');


					//Separar la cadena para obtener el id de la cuenta
					var arrCuentaID = strCuentaIDNivel4.split('|');
					//Asignar el id de la cuenta del nivel 4
					var intCuentaID = arrCuentaID[0];


					//Revisamos si existe la descripción proporcionada, si es así, editamos los datos
					if (objTabla.rows.namedItem(strConcepto))
					{
						objTabla.rows.namedItem(strConcepto).cells[1].innerHTML = strCuenta;
						objTabla.rows.namedItem(strConcepto).cells[2].innerHTML = intCantidad;
						objTabla.rows.namedItem(strConcepto).cells[3].innerHTML = intPrecioUnitarioMostrar;
						objTabla.rows.namedItem(strConcepto).cells[4].innerHTML =  intDescuentoUnitarioMostrar;
						objTabla.rows.namedItem(strConcepto).cells[5].innerHTML =  intSubtotalMostrar;
						objTabla.rows.namedItem(strConcepto).cells[6].innerHTML = intImporteIvaMostrar;
						objTabla.rows.namedItem(strConcepto).cells[7].innerHTML = intImporteIepsMostrar;
						objTabla.rows.namedItem(strConcepto).cells[8].innerHTML = intTotalMostrar;
						objTabla.rows.namedItem(strConcepto).cells[10].innerHTML =  intPorcentajeDescuento;
						objTabla.rows.namedItem(strConcepto).cells[11].innerHTML = intPorcentajeIva;
						objTabla.rows.namedItem(strConcepto).cells[12].innerHTML = intPorcentajeIeps;
						objTabla.rows.namedItem(strConcepto).cells[13].innerHTML = intTasaCuotaIva;
						objTabla.rows.namedItem(strConcepto).cells[14].innerHTML = intTasaCuotaIeps;
						objTabla.rows.namedItem(strConcepto).cells[15].innerHTML = intPrecioUnitarioBD;
						objTabla.rows.namedItem(strConcepto).cells[16].innerHTML = intDescuentoUnitarioBD;
						objTabla.rows.namedItem(strConcepto).cells[17].innerHTML = intImporteIvaBD;
						objTabla.rows.namedItem(strConcepto).cells[18].innerHTML = intImporteIepsBD;
						objTabla.rows.namedItem(strConcepto).cells[19].innerHTML = intIepsUnitario;
						objTabla.rows.namedItem(strConcepto).cells[20].innerHTML = strTipoTasaCuotaIeps;
						objTabla.rows.namedItem(strConcepto).cells[21].innerHTML = strFactorTasaCuotaIeps;
						objTabla.rows.namedItem(strConcepto).cells[22].innerHTML = intValorMinimoTasaCuotaIeps;
						objTabla.rows.namedItem(strConcepto).cells[23].innerHTML = strCuentaIDNivel1;
						objTabla.rows.namedItem(strConcepto).cells[24].innerHTML = strCuentaIDNivel2;
						objTabla.rows.namedItem(strConcepto).cells[25].innerHTML = strCuentaIDNivel3;
						objTabla.rows.namedItem(strConcepto).cells[26].innerHTML = strCuentaIDNivel4;
						objTabla.rows.namedItem(strConcepto).cells[27].innerHTML = intIvaUnitario;
						objTabla.rows.namedItem(strConcepto).cells[28].innerHTML = intCuentaID;

					}
					else
					{
						//Insertamos el renglón con sus celdas en el objeto de la tabla
						var objRenglon = objTabla.insertRow();
						var objCeldaConcepto = objRenglon.insertCell(0);
						var objCeldaCuenta = objRenglon.insertCell(1);
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
						var objCeldaPrecioUnitarioBD = objRenglon.insertCell(15);
						var objCeldaDescuentoUnitarioBD = objRenglon.insertCell(16);
						var objCeldaIvaBD = objRenglon.insertCell(17);
						var objCeldaIepsBD = objRenglon.insertCell(18);
						var objCeldaIepsUnitario = objRenglon.insertCell(19);
						var objCeldaTipoTasaCuotaIeps = objRenglon.insertCell(20);
						var objCeldaFactorTasaCuotaIeps = objRenglon.insertCell(21);
						var objCeldaValorMinimoTasaCuotaIeps = objRenglon.insertCell(22);
						var objCeldaCuentaIDNivel1 = objRenglon.insertCell(23);
						var objCeldaCuentaIDNivel2 = objRenglon.insertCell(24);
						var objCeldaCuentaIDNivel3 = objRenglon.insertCell(25);
						var objCeldaCuentaIDNivel4 = objRenglon.insertCell(26);
						var objCeldaIvaUnitario = objRenglon.insertCell(27);
						var objCeldaCuentaID = objRenglon.insertCell(28);

						//Asignar valores
						objRenglon.setAttribute('class', 'movil');
						objRenglon.setAttribute('id', strConcepto);
						objCeldaConcepto.setAttribute('class', 'movil b1');
						objCeldaConcepto.innerHTML = strConcepto;
						objCeldaCuenta.setAttribute('class', 'movil b2');
						objCeldaCuenta.innerHTML = strCuenta;
						objCeldaCantidad.setAttribute('class', 'movil b3');
						objCeldaCantidad.innerHTML = intCantidad;
						objCeldaPrecioUnitario.setAttribute('class', 'movil b4');
						objCeldaPrecioUnitario.innerHTML = intPrecioUnitarioMostrar;
						objCeldaDescuentoUnitario.setAttribute('class', 'movil b5');
						objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitarioMostrar;
						objCeldaSubtotal.setAttribute('class', 'movil b6');
						objCeldaSubtotal.innerHTML = intSubtotalMostrar;
						objCeldaIva.setAttribute('class', 'movil b7');
						objCeldaIva.innerHTML = intImporteIvaMostrar;
						objCeldaIeps.setAttribute('class', 'movil b8');
						objCeldaIeps.innerHTML = intImporteIepsMostrar;
						objCeldaTotal.setAttribute('class', 'movil b9');
						objCeldaTotal.innerHTML = intTotalMostrar;
						objCeldaAcciones.setAttribute('class', 'td-center movil b10');
						objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalles_ordenes_compra_especiales_cuentas_pagar(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_detalles_ordenes_compra_especiales_cuentas_pagar(this)'>" + 
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
						objCeldaPrecioUnitarioBD.setAttribute('class', 'no-mostrar');
						objCeldaPrecioUnitarioBD.innerHTML =  intPrecioUnitarioBD;
						objCeldaDescuentoUnitarioBD.setAttribute('class', 'no-mostrar');
						objCeldaDescuentoUnitarioBD.innerHTML =  intDescuentoUnitarioBD;
						objCeldaIvaBD.setAttribute('class', 'no-mostrar');
						objCeldaIvaBD.innerHTML =  intImporteIvaBD;
						objCeldaIepsBD.setAttribute('class', 'no-mostrar');
						objCeldaIepsBD.innerHTML =  intImporteIepsBD;
						objCeldaIepsUnitario.setAttribute('class', 'no-mostrar');
						objCeldaIepsUnitario.innerHTML =  intIepsUnitario;
						objCeldaTipoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
						objCeldaTipoTasaCuotaIeps.innerHTML =  strTipoTasaCuotaIeps;
						objCeldaFactorTasaCuotaIeps.setAttribute('class', 'no-mostrar');
						objCeldaFactorTasaCuotaIeps.innerHTML =  strFactorTasaCuotaIeps;
						objCeldaValorMinimoTasaCuotaIeps.setAttribute('class', 'no-mostrar');
						objCeldaValorMinimoTasaCuotaIeps.innerHTML = intValorMinimoTasaCuotaIeps;
						objCeldaCuentaIDNivel1.setAttribute('class', 'no-mostrar');
						objCeldaCuentaIDNivel1.innerHTML = strCuentaIDNivel1;
						objCeldaCuentaIDNivel2.setAttribute('class', 'no-mostrar');
						objCeldaCuentaIDNivel2.innerHTML = strCuentaIDNivel2;
						objCeldaCuentaIDNivel3.setAttribute('class', 'no-mostrar');
						objCeldaCuentaIDNivel3.innerHTML = strCuentaIDNivel3;
						objCeldaCuentaIDNivel4.setAttribute('class', 'no-mostrar');
						objCeldaCuentaIDNivel4.innerHTML = strCuentaIDNivel4;
						objCeldaIvaUnitario.setAttribute('class', 'no-mostrar');
						objCeldaIvaUnitario.innerHTML = intIvaUnitario;
						objCeldaCuentaID.setAttribute('class', 'no-mostrar');
						objCeldaCuentaID.innerHTML = intCuentaID;
					}

					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_detalles_ordenes_compra_especiales_cuentas_pagar();

					//Enfocar combobox
					$('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
				}
				else
				{

					//Limpiar contenido de la caja de texto
                    $('#txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
                    //Hacer un llamado a la función para mostrar mensaje de información
                    mensaje_ordenes_compra_especiales_cuentas_pagar('informacion', 'El IEPS unitario no se encuentra dentro del rango: ' + intValorMinimoTasaCuotaIeps+ ' - '+intPorcentajeIeps);
				}
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_ordenes_compra_especiales_cuentas_pagar tr").length - 2;
			$('#numElementos_detalles_ordenes_compra_especiales_cuentas_pagar').html(intFilas);
			$('#txtNumDetalles_ordenes_compra_especiales_cuentas_pagar').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_ordenes_compra_especiales_cuentas_pagar(objRenglon)
		{
			//Variables que se utilizan para asignar los id´s de las cuentas contables
			var strCuentaNivel1 = objRenglon.parentNode.parentNode.cells[23].innerHTML;
			var strCuentaNivel2 = objRenglon.parentNode.parentNode.cells[24].innerHTML;
			var strCuentaNivel3 = objRenglon.parentNode.parentNode.cells[25].innerHTML;
		    var strCuentaNivel4 = objRenglon.parentNode.parentNode.cells[26].innerHTML;


			//Asignar los valores a las cajas de texto
			$('#txtConcepto_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtCantidad_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			$('#txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtTasaCuotaIva_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);
			$('#txtTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[14].innerHTML);
			$('#txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[19].innerHTML);
			$('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[20].innerHTML);
			$('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[21].innerHTML);
			$('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[22].innerHTML);

			$('#txtIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val(objRenglon.parentNode.parentNode.cells[27].innerHTML);

			//Hacer un llamado a la función para mostrar u ocultar IEPS unitario
	        mostrar_ieps_unitario_detalles_ordenes_compra_especiales_cuentas_pagar();

	        //Asignar el id de la cuenta del nivel 1
	        $('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').val(strCuentaNivel1);

	       //Asignar el texto del combobox
			var strNombreCuentaNivel1 = $('select[name="strCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar"] option:selected').text();


	        //Hacer un llamado a la función para mostrar u ocultar cuenta del nivel 3
	        mostrar_cuenta_nivel3_detalles_ordenes_compra_especiales_cuentas_pagar();

			//Hacer un llamado a la función para cargar cuentas del segundo nivel en el combobox del modal
			cargar_cuentas_detalles_ordenes_compra_especiales_cuentas_pagar('NIVEL 2', strCuentaNivel1, strCuentaNivel2);

			//Hacer un llamado a la función para cargar cuentas del tercer nivel en el combobox del modal
			cargar_cuentas_detalles_ordenes_compra_especiales_cuentas_pagar('NIVEL 3', strCuentaNivel2, strCuentaNivel3);


			//Si la cuenta del nivel 1 corresponde a la cuenta 701
		    if(strNombreCuentaNivel1 == strCuenta701OrdenesCompraEspecialesCuentasPagar)
			{

				//Hacer un llamado a la función para cargar cuentas del cuarto nivel en el combobox del modal
				cargar_cuentas_detalles_ordenes_compra_especiales_cuentas_pagar('NIVEL 4', strCuentaNivel2, strCuentaNivel4);
			}
			else
			{
				//Hacer un llamado a la función para cargar cuentas del cuarto nivel en el combobox del modal
				cargar_cuentas_detalles_ordenes_compra_especiales_cuentas_pagar('NIVEL 4', strCuentaNivel3, strCuentaNivel4);
			}
		

			//Enfocar combobox
			$('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_ordenes_compra_especiales_cuentas_pagar(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_ordenes_compra_especiales_cuentas_pagar").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_ordenes_compra_especiales_cuentas_pagar();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_ordenes_compra_especiales_cuentas_pagar tr").length - 2;
			$('#numElementos_detalles_ordenes_compra_especiales_cuentas_pagar').html(intFilas);
			$('#txtNumDetalles_ordenes_compra_especiales_cuentas_pagar').val(intFilas);

			//Enfocar combobox
			$('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_ordenes_compra_especiales_cuentas_pagar()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_especiales_cuentas_pagar').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Variable que se utiliza para asignar el acumulado anterior del subtotal (en caso de que existan cambios calcular retención de ISR (proveedor) de lo contrario conservar el importe de retención (puede darse el caso de que el usuario modifique dicho importe))
			var intAcumSubtotalAnterior = $('#acumSubtotal_detalles_ordenes_compra_especiales_cuentas_pagar').html();

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
			intAcumUnidades = formatMoney(intAcumUnidades, intNumDecimalesCantidadBDOrdenesCompraEspecialesCuentasPagar, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, intNumDecimalesDescUnitBDOrdenesCompraEspecialesCuentasPagar, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');

			//Asignar los valores
			$('#acumCantidad_detalles_ordenes_compra_especiales_cuentas_pagar').html(intAcumUnidades);
			$('#acumDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').html(intAcumDescuento);
			$('#acumSubtotal_detalles_ordenes_compra_especiales_cuentas_pagar').html(intAcumSubtotal);
			$('#acumIva_detalles_ordenes_compra_especiales_cuentas_pagar').html(intAcumIva);
			$('#acumIeps_detalles_ordenes_compra_especiales_cuentas_pagar').html(intAcumIeps);
			$('#acumTotal_detalles_ordenes_compra_especiales_cuentas_pagar').html(intAcumTotal);

			//Si no existe id de la orden de compra, significa que es un nuevo registro
			if($('#txtOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar').val() == '' && intContReg == 1)
			{
				//Asignar el contador para calcular el isr del único detalle
				intAcumSubtotalAnterior = intContReg;
			}

			//Si hubo cambios en el acumulado del subtotal
			if(intAcumSubtotalAnterior != intAcumSubtotal && intAcumSubtotalAnterior != '')
			{
				//Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_ordenes_compra_especiales_cuentas_pagar();
			}
		}

		//Función que se utiliza para calcular la retención de ISR (proveedor)
		function calcular_isr_ordenes_compra_especiales_cuentas_pagar()
		{
			 //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt($('#txtRegimenFiscalID_ordenes_compra_especiales_cuentas_pagar').val()) == intRegimenFiscalIDResicoOrdenesCompraEspecialesCuentasPagar)
       	     {
       	     	//Variable que se utiliza para asignar el importe retenido
       	     	var intImporteRetenido = 0;
       	     	//Variable que se utiliza para asignar el acumulado del subtotal
				var intAcumSubtotal = 0;

       	     	//Hacer un llamado a la función para reemplazar '$' y  ','  por cadena vacia
				intAcumSubtotal =  $.reemplazar($('#acumSubtotal_detalles_ordenes_compra_especiales_cuentas_pagar').html(), "$", "");
				intAcumSubtotal =  $.reemplazar(intAcumSubtotal, ",", "");

				//Si existe porcentaje de ISR (proveedor)
				if($('#txtPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar').val() != '' && intAcumSubtotal > 0 )
				{
					//Variable que se utiliza para asignar el porcentaje de retención ISR
					var intPorcentajeRetencionIsr = parseFloat($('#txtPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar').val());

					//Calcular retención de ISR 
					intImporteRetenido = parseFloat(intAcumSubtotal * intPorcentajeRetencionIsr);
					//Redondear cantidad a decimales
					intImporteRetenido = intImporteRetenido.toFixed(intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar);
					intImporteRetenido = parseFloat(intImporteRetenido);
				}

				//Convertir cantidad a formato moneda
				intImporteRetenido = formatMoney(intImporteRetenido, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');

				//Asignar importe retenido 
				$('#txtImporteRetenido_ordenes_compra_especiales_cuentas_pagar').val(intImporteRetenido);

       	     }
		}


		//Función que se utiliza para calcular el IVA unitario
		function calcular_iva_unitario_detalles_ordenes_compra_especiales_cuentas_pagar()
		{
			//Variable que se utiliza para asignar el precio unitario
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val();
			//Variable que se utiliza para asignar el porcentaje de IVA
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').val();
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
			    intIvaUnitario = intIvaUnitario.toFixed(intNumDecimalesIvaUnitBDOrdenesCompraEspecialesCuentasPagar);
				intIvaUnitario = parseFloat(intIvaUnitario);

				//Convertir cantidad a formato moneda
				intIvaUnitario =  formatMoney(intIvaUnitario, intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar, '');

				//Asignar importe de IVA unitario 
				$('#txtIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val(intIvaUnitario);
			}
					
		}



		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Autorizar Orden de Compra
			*********************************************************************************************************************/
			//Modificar el mensaje cuando cambie la opción del combobox
	        $('#cmbEstatus_autorizar_ordenes_compra_especiales_cuentas_pagar').change(function(e){   
	        	//Variables que se utilizan para el mensaje informativo
	        	var strEstatus = $('#cmbEstatus_autorizar_ordenes_compra_especiales_cuentas_pagar').val();
	        	var strMensaje = '';
	        	var strFolio = $('#txtFolio_autorizar_ordenes_compra_especiales_cuentas_pagar').val();
	        	
	        	//Si existe estatus seleccionado
	        	if(strEstatus != '')
	        	{
	        		strMensaje += 'Se ';
	        		
	        		//Dependiendo del estatus modificar mensaje
	              	if($('#cmbEstatus_autorizar_ordenes_compra_especiales_cuentas_pagar').val() === 'AUTORIZADO')
	             	{
	             		strMensaje += 'autorizó ';
	             	}
	             	else
	             	{
	             		strMensaje += 'rechazó ';
	             	}

	             	//Agregar folio en el mensaje
	             	strMensaje += ' la orden de compra especial '+strFolio;
	        	}
	           

             	//Asignar mensaje informativo
             	$('#txtMensaje_autorizar_ordenes_compra_especiales_cuentas_pagar').val(strMensaje);
				
	        });

			/*******************************************************************************************************************
			Controles correspondientes al modal Ordenes de Compra Especiales
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar').numeric();
			$('#txtTotalUnidades_ordenes_compra_especiales_cuentas_pagar').numeric();
			$('#txtImporteTotal_ordenes_compra_especiales_cuentas_pagar').numeric();
			$('#txtCantidad_detalles_ordenes_compra_especiales_cuentas_pagar').numeric();
			$('#txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').numeric();
			$('#txtIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').numeric();
        	$('#txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').numeric();
        	$('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').numeric();
        	$('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').numeric();
        	$('#txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').numeric();
        	$('#txtPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar').numeric();
        	$('#txtImporteRetenido_ordenes_compra_especiales_cuentas_pagar').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_ordenes_compra_especiales_cuentas_pagar').blur(function(){
				$('.moneda_ordenes_compra_especiales_cuentas_pagar').formatCurrency({ roundToDecimalPlace: intNumDecimalesMostrarOrdenesCompraEspecialesCuentasPagar });
			});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_ordenes_compra_especiales_cuentas_pagar').blur(function(){
                $('.tipo-cambio_ordenes_compra_especiales_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_ordenes_compra_especiales_cuentas_pagar').blur(function(){
                $('.cantidad_ordenes_compra_especiales_cuentas_pagar').formatCurrency({ roundToDecimalPlace: intNumDecimalesCantidadBDOrdenesCompraEspecialesCuentasPagar });
            });

             /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.precio_unitario_ordenes_compra_especiales_cuentas_pagar').blur(function(){
                $('.precio_unitario_ordenes_compra_especiales_cuentas_pagar').formatCurrency({ roundToDecimalPlace: intNumDecimalesPrecioUnitBDOrdenesCompraEspecialesCuentasPagar });
            });

             /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.descuento_ordenes_compra_especiales_cuentas_pagar').blur(function(){
                $('.descuento_ordenes_compra_especiales_cuentas_pagar').formatCurrency({ roundToDecimalPlace: intNumDecimalesDescUnitBDOrdenesCompraEspecialesCuentasPagar });
            });


			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_ordenes_compra_especiales_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaEntrega_ordenes_compra_especiales_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaVencimiento_ordenes_compra_especiales_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});

			//Calcular fecha de vencimiento cuando cambie la fecha
			$('#dteFecha_ordenes_compra_especiales_cuentas_pagar').on('dp.change', function (e) {
             	//Hacer un llamado a la función para calcular fecha de vencimiento
	       	    $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraEspecialesCuentasPagar);
             	//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_ordenes_compra_especiales_cuentas_pagar();
			});


			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_ordenes_compra_especiales_cuentas_pagar').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_ordenes_compra_especiales_cuentas_pagar').val()) === intMonedaBaseIDOrdenesCompraEspecialesCuentasPagar)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar').val(intTipoCambioMonedaBaseOrdenesCompraEspecialesCuentasPagar);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar').formatCurrency({ roundToDecimalPlace: 4 });
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_ordenes_compra_especiales_cuentas_pagar();
             	}
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoOrdenesCompraEspecialesCuentasPagar)
	        	{
	        		$('#txtTipoCambio_ordenes_compra_especiales_cuentas_pagar').val(intTipoCambioMaximoOrdenesCompraEspecialesCuentasPagar);
	        	}

		    });

		    //Calcular fecha de vencimiento cuando cambie la opción del combobox
	        $('#cmbCondicionesPago_ordenes_compra_especiales_cuentas_pagar').change(function(e){   
	             //Hacer un llamado a la función para calcular fecha de vencimiento
	       	     $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraEspecialesCuentasPagar);
	        });

			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedor_ordenes_compra_especiales_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorID_ordenes_compra_especiales_cuentas_pagar').val('');
	                //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_ordenes_compra_especiales_cuentas_pagar();
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
	       	     get_datos_proveedor_ordenes_compra_especiales_cuentas_pagar(ui);
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
	        $('#txtProveedor_ordenes_compra_especiales_cuentas_pagar').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_ordenes_compra_especiales_cuentas_pagar').val() == '' ||
	               $('#txtProveedor_ordenes_compra_especiales_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorID_ordenes_compra_especiales_cuentas_pagar').val('');
	               $('#txtProveedor_ordenes_compra_especiales_cuentas_pagar').val('');
	                //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_ordenes_compra_especiales_cuentas_pagar();
	            }

	        });




	        //Autocomplete para recuperar los datos de un empleado 
	        $('#txtSolicita_ordenes_compra_especiales_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSolicitaID_ordenes_compra_especiales_cuentas_pagar').val('');
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
	             $('#txtSolicitaID_ordenes_compra_especiales_cuentas_pagar').val(ui.item.data);
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
	        $('#txtSolicita_ordenes_compra_especiales_cuentas_pagar').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtSolicitaID_ordenes_compra_especiales_cuentas_pagar').val() == '' ||
	               $('#txtSolicita_ordenes_compra_especiales_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSolicitaID_ordenes_compra_especiales_cuentas_pagar').val('');
	               $('#txtSolicita_ordenes_compra_especiales_cuentas_pagar').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un porcentaje de retención ISR 
	        $('#txtPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtPorcentajeRetencionID_ordenes_compra_especiales_cuentas_pagar').val('');
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
	             $('#txtPorcentajeRetencionID_ordenes_compra_especiales_cuentas_pagar').val(ui.item.data);
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
	        $('#txtPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtPorcentajeRetencionID_ordenes_compra_especiales_cuentas_pagar').val() == '' ||
	               $('#txtPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtPorcentajeRetencionID_ordenes_compra_especiales_cuentas_pagar').val('');
	               $('#txtPorcentajeIsr_ordenes_compra_especiales_cuentas_pagar').val('');
	            }

	           //Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_ordenes_compra_especiales_cuentas_pagar();
	            
	        });

	      
	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_ordenes_compra_especiales_cuentas_pagar').on('click','button.btn',function(){
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


	        //Cargar cuentas del nivel 2 cuando se modifique la selección del combo
			$('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').change(function(e){
				//Si no existe id de la cuenta padre del nivel 1
				if($('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
				{
					//Limpiar contenido de los siguientes combobox
					$('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
					$('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
					$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').empty();

				}
				else
				{

					//Limpiar contenido de los siguientes combobox
					$('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
					$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').empty();

					//Hacer un llamado a la función para cargar cuentas del segundo nivel en el combobox del modal
					cargar_cuentas_detalles_ordenes_compra_especiales_cuentas_pagar('NIVEL 2', $('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').val());
					//Enfocar comobox
					$('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
				}


		       //Hacer un llamado a la función para mostrar u ocultar cuenta del nivel 3
	           mostrar_cuenta_nivel3_detalles_ordenes_compra_especiales_cuentas_pagar();
				
				
			});

			//Cargar cuentas del nivel 3 cuando se modifique la selección del combo
			$('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').change(function(e){
				
				//Asignar el texto del combobox
				var strCuentaNivel1 = $('select[name="strCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar"] option:selected').text();

				//Si no existe id de la cuenta padre del nivel 2
				if($('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
				{
					//Limpiar contenido de los siguientes combobox
					$('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
					$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
				}
				else
				{

					//Limpiar contenido del siguiente combobox
					$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').empty();

					//Si la cuenta del nivel 1 corresponde a la cuenta 602
		            if(strCuentaNivel1 == strCuenta602OrdenesCompraEspecialesCuentasPagar)
			        {
						//Hacer un llamado a la función para cargar cuentas del tercer nivel en el combobox del modal
						cargar_cuentas_detalles_ordenes_compra_especiales_cuentas_pagar('NIVEL 3', $('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').val());

						//Enfocar comobox
						$('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
					}
					else
					{

						//Variable que se utiliza para asignar el id de la cuenta del nivel 2
						var strCuentaNivel2 = $('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').val();

						//Hacer un llamado a la función para cargar cuentas del cuarto nivel en el combobox del modal
						cargar_cuentas_detalles_ordenes_compra_especiales_cuentas_pagar('NIVEL 4', strCuentaNivel2);

						//Enfocar comobox
						$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').focus();

					}
				}
				
				
			});

			//Cargar cuentas del nivel 3 cuando se modifique la selección del combo
			$('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').change(function(e){
				

				//Si no existe id de la cuenta padre del nivel 3
				if($('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
				{
					//Limpiar contenido del siguiente combobox
					$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').empty();
				}
				else
				{
					//Hacer un llamado a la función para cargar cuentas del cuarto nivel en el combobox del modal
					cargar_cuentas_detalles_ordenes_compra_especiales_cuentas_pagar('NIVEL 4', $('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').val());

					//Enfocar comobox
					$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
				}
			});

			
			//Cargar cuentas del nivel 4 cuando se modifique la selección del combo
			$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').change(function(e){
				//Si no existe id de la cuenta padre del nivel 4
				if($('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
				{
					//Enfocar comobox
					$('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
				}
				else
				{
					//Enfocar caja de texto
				    $('#txtConcepto_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
				}
			});


	         //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IVA 
	        $('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIva_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
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
	             $('#txtTasaCuotaIva_detalles_ordenes_compra_especiales_cuentas_pagar').val(ui.item.data);
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
	        $('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIva_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '' ||
	               $('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIva_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
	               $('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
	            }

	            //Hacer un llamado a la función para calcular el importe de IVA unitario
				calcular_iva_unitario_detalles_ordenes_compra_especiales_cuentas_pagar();
	            
	        });

	        //Autocomplete para recuperar los datos de una tasa o cuota del impuesto de IEPS
	        $('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
	               //Hacer un llamado a la función para inicializar elementos del porcentaje de IEPS
	               inicializar_porcentaje_ieps_detalles_ordenes_compra_especiales_cuentas_pagar();
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
	             $('#txtTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val(ui.item.data);
	             $('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val(ui.item.tipo);
	             $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val(ui.item.factor);
	             $('#txtValorMinimoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val(ui.item.valor_minimo);
	             //Hacer un llamado a la función para mostrar u ocultar IEPS unitario
	              mostrar_ieps_unitario_detalles_ordenes_compra_especiales_cuentas_pagar();

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
	        $('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '' ||
	               $('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
	               $('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val('');
	              //Hacer un llamado a la función para inicializar elementos del porcentaje de IEPS
	               inicializar_porcentaje_ieps_detalles_ordenes_compra_especiales_cuentas_pagar();
	            }
	            
	        });


	        //Calcular el importe de IVA unitario  cuando pierda el enfoque la caja de texto
	        $('#txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').focusout(function(e){

	            //Hacer un llamado a la función para calcular el importe de IVA unitario
				calcular_iva_unitario_detalles_ordenes_compra_especiales_cuentas_pagar();
	        });


	        //Validar que exista cuenta del nivel 1 cuando se pulse la tecla enter 
			$("#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existecuenta del nivel 1
		            if($('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbCuentaIDNivel1_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
		        
		        }  
		    });


		    //Validar que exista cuenta del nivel 2 cuando se pulse la tecla enter 
			$("#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existecuenta del nivel 2
		            if($('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbCuentaIDNivel2_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
		        
		        }  
		    });


		    //Validar que exista cuenta del nivel 3 cuando se pulse la tecla enter 
			$("#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existecuenta del nivel 3
		            if($('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbCuentaIDNivel3_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
		        
		        }  
		    });


		    //Validar que exista cuenta del nivel 4 cuando se pulse la tecla enter 
			$("#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar").keydown(function(e){
		        var key = e.charCode || e.keyCode;
		        if (key == 13)
		        { 
		        	//Si no existecuenta del nivel 4
		            if($('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
			   	    {
			   	    	//Enfocar combobox
					    $('#cmbCuentaIDNivel4_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtConcepto_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
		        
		        }  
		    });

	        //Validar que exista concepto cuando se pulse la tecla enter 
			$('#txtConcepto_detalles_ordenes_compra_especiales_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe concepto
		           if($('#txtConcepto_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtConcepto_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_ordenes_compra_especiales_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
		        }
		    });


			//Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPrecioUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje de IVA cuando se pulse la tecla enter 
			$('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje de IVA
		            if( $('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeIva_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
		        }
		    });

		    //Validar que exista IVA unitario cuando se pulse la tecla enter 
			$('#txtIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe IVA unitario 
		            if( $('#txtIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtIvaUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje de IEPS cuando se pulse la tecla enter 
			$('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '' && 
		         	   $('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val() != '')
		         	{
		         	
		         		//Enfocar caja de texto
					    $('#txtPorcentajeIeps_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
		         	}
		         	else
		         	{
		         		 //Si la tasa de cuota es de tipo RANGO y su factor es Cuota
			            if($('#txtTipoTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val() == 'RANGO' && 
			               $('#txtFactorTasaCuotaIeps_detalles_ordenes_compra_especiales_cuentas_pagar').val() == 'Cuota')
			            {
			            	//Enfocar caja de texto
					    	$('#txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
		   	    		}
		   	    		else
		   	    		{
		   	    			//Hacer un llamado a la función para agregar renglón a la tabla
		   	    			agregar_renglon_detalles_ordenes_compra_especiales_cuentas_pagar();
		   	    		}

		         	}
		        }
		    });

		    //Validar que exista IEPS unitario cuando se pulse la tecla enter 
			$('#txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	//Verificar que exista id de la tasa o cuota del impuesto de IEPS
		         	if($('#txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').val() == '')
		         	{
		         		//Enfocar caja de texto
					    $('#txtIepsUnitario_detalles_ordenes_compra_especiales_cuentas_pagar').focus();
		         	}
		         	else
		         	{
		         		//Hacer un llamado a la función para agregar renglón a la tabla
		   	    		agregar_renglon_detalles_ordenes_compra_especiales_cuentas_pagar();
		         	}
		        }
		    });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_ordenes_compra_especiales_cuentas_pagar').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_ordenes_compra_especiales_cuentas_pagar').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_ordenes_compra_especiales_cuentas_pagar').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedorBusq_ordenes_compra_especiales_cuentas_pagar').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorIDBusq_ordenes_compra_especiales_cuentas_pagar').val('');
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
	             $('#txtProveedorIDBusq_ordenes_compra_especiales_cuentas_pagar').val(ui.item.data);
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
	        $('#txtProveedorBusq_ordenes_compra_especiales_cuentas_pagar').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorIDBusq_ordenes_compra_especiales_cuentas_pagar').val() == '' ||
	               $('#txtProveedorBusq_ordenes_compra_especiales_cuentas_pagar').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorIDBusq_ordenes_compra_especiales_cuentas_pagar').val('');
	               $('#txtProveedorBusq_ordenes_compra_especiales_cuentas_pagar').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_ordenes_compra_especiales_cuentas_pagar').on('click','a',function(event){
				event.preventDefault();
				intPaginaOrdenesCompraEspecialesCuentasPagar = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_ordenes_compra_especiales_cuentas_pagar();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_ordenes_compra_especiales_cuentas_pagar').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_ordenes_compra_especiales_cuentas_pagar();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_ordenes_compra_especiales_cuentas_pagar').addClass("estatus-NUEVO");
				//Abrir modal
				 objOrdenesCompraEspecialesCuentasPagar = $('#OrdenesCompraEspecialesCuentasPagarBox').bPopup({
												   appendTo: '#OrdenesCompraEspecialesCuentasPagarContent', 
					                               contentContainer: 'OrdenesCompraEspecialesCuentasPagarM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_ordenes_compra_especiales_cuentas_pagar').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_ordenes_compra_especiales_cuentas_pagar').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_ordenes_compra_especiales_cuentas_pagar();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_ordenes_compra_especiales_cuentas_pagar();
            //Hacer un llamado a la función para cargar cuentas del primer nivel en el combobox del modal
            cargar_cuentas_detalles_ordenes_compra_especiales_cuentas_pagar('NIVEL 1');
		});
	</script>