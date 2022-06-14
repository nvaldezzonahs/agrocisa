	<div id="OrdenesCompraMaquinariaMaquinariaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_ordenes_compra_maquinaria_maquinaria" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_ordenes_compra_maquinaria_maquinaria" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_ordenes_compra_maquinaria_maquinaria">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_ordenes_compra_maquinaria_maquinaria'>
				                    <input class="form-control" id="txtFechaInicialBusq_ordenes_compra_maquinaria_maquinaria"
				                    		name= "strFechaInicialBusq_ordenes_compra_maquinaria_maquinaria" 
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
								<label for="txtFechaFinalBusq_ordenes_compra_maquinaria_maquinaria">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_ordenes_compra_maquinaria_maquinaria'>
				                    <input class="form-control" id="txtFechaFinalBusq_ordenes_compra_maquinaria_maquinaria"
				                    		name= "strFechaFinalBusq_ordenes_compra_maquinaria_maquinaria" 
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
								<input id="txtProveedorIDBusq_ordenes_compra_maquinaria_maquinaria" 
									   name="intProveedorIDBusq_ordenes_compra_maquinaria_maquinaria"  type="hidden" 
									   value="">
								</input>
								<label for="txtProveedorBusq_ordenes_compra_maquinaria_maquinaria">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProveedorBusq_ordenes_compra_maquinaria_maquinaria" 
										name="strProveedorBusq_ordenes_compra_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_ordenes_compra_maquinaria_maquinaria">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_ordenes_compra_maquinaria_maquinaria" 
								 		name="strEstatusBusq_ordenes_compra_maquinaria_maquinaria" tabindex="1">
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
								<label for="txtBusqueda_ordenes_compra_maquinaria_maquinaria">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_ordenes_compra_maquinaria_maquinaria" 
										name="strBusqueda_ordenes_compra_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_ordenes_compra_maquinaria_maquinaria" 
									   name="strImprimirDetalles_ordenes_compra_maquinaria_maquinaria" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_ordenes_compra_maquinaria_maquinaria"
									onclick="paginacion_ordenes_compra_maquinaria_maquinaria();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_ordenes_compra_maquinaria_maquinaria" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_ordenes_compra_maquinaria_maquinaria"
									onclick="reporte_ordenes_compra_maquinaria_maquinaria('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_ordenes_compra_maquinaria_maquinaria"
									onclick="reporte_ordenes_compra_maquinaria_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				<table class="table-hover movil" id="dg_ordenes_compra_maquinaria_maquinaria">
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
					<script id="plantilla_ordenes_compra_maquinaria_maquinaria" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{proveedor}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_ordenes_compra_maquinaria_maquinaria({{orden_compra_maquinaria_id}},'Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="editar_ordenes_compra_maquinaria_maquinaria({{orden_compra_maquinaria_id}},'Ver')"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!---Autorizar o rechazar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionAutorizar}}"  
										onclick="abrir_autorizar_ordenes_compra_maquinaria_maquinaria({{orden_compra_maquinaria_id}},'{{folio}}', 'Autorizar');"  title="Autorizar o Rechazar">
									<span class="fa fa-check-square-o"></span>
								</button>
								<!--Enviar correo electrónico-->
								<button class="btn btn-default btn-xs {{mostrarAccionEnviarCorreo}}"  
										onclick="abrir_proveedor_ordenes_compra_maquinaria_maquinaria({{orden_compra_maquinaria_id}})"  title="Enviar correo electrónico">
									<span class="glyphicon glyphicon-envelope"></span>
								</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_ordenes_compra_maquinaria_maquinaria({{orden_compra_maquinaria_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
							    <!--Subir archivos-->
								<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
									<span class="btn  btn-default btn-xs fileinput-button ">
								    	<span class="fa fa-upload"></span>
										<input name="archivo_varios{{orden_compra_maquinaria_id}}[]" id="archivo_varios{{orden_compra_maquinaria_id}}"  type="file" multiple accept="text/xml,application/pdf" 
											   onchange="subir_archivos_grid_ordenes_compra_maquinaria_maquinaria({{orden_compra_maquinaria_id}});">
								  		</input>
								    </span>
								</span>
                            	<!--Descargar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_ordenes_compra_maquinaria_maquinaria({{orden_compra_maquinaria_id}}, '{{folio}}');" title="Descargar archivo">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
                            	<!--Eliminar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}" 
                            			 onmousedown="eliminar_archivos_ordenes_compra_maquinaria_maquinaria({{orden_compra_maquinaria_id}});" title="Eliminar archivo">
                            		<span class="glyphicon glyphicon-export"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_ordenes_compra_maquinaria_maquinaria({{orden_compra_maquinaria_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_ordenes_compra_maquinaria_maquinaria({{orden_compra_maquinaria_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ordenes_compra_maquinaria_maquinaria"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_ordenes_compra_maquinaria_maquinaria">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Autorizar Orden de Compra-->
		<div id="AutorizarOrdenesCompraMaquinariaMaquinariaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_autorizar_ordenes_compra_maquinaria_maquinaria" class="ModalBodyTitle confirmacion-modal-title"">
			<h1 id="tituloModal_autorizar_ordenes_compra_maquinaria_maquinaria"></h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAutorizarOrdenesCompraMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmAutorizarOrdenesCompraMaquinariaMaquinaria"  onsubmit="return(false)" autocomplete="off">
			    	<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReferenciaID_autorizar_ordenes_compra_maquinaria_maquinaria" 
										   name="intReferenciaID_autorizar_ordenes_compra_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el tipo de acción (guardar o autorizar) a realizar --> 
									<input type="hidden" id="txtTipoAccion_autorizar_ordenes_compra_maquinaria_maquinaria" 
										   name="strTipoAccion_autorizar_ordenes_compra_maquinaria_maquinaria" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el folio del registro seleccionado--> 
									<input type="hidden" id="txtFolio_autorizar_ordenes_compra_maquinaria_maquinaria" 
										   name="strFolio_autorizar_ordenes_compra_maquinaria_maquinaria" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Ordenes de Compra-->
									<input id="txtModalOrdenesCompra_autorizar_ordenes_compra_maquinaria_maquinaria" 
										   name="strModalOrdenesCompra_autorizar_ordenes_compra_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para asignar a los usuarios que se les enviará 
									     el mensaje--> 
									<input type="hidden" id="txtUsuarios_autorizar_ordenes_compra_maquinaria_maquinaria" 
										   name="strUsuarios_autorizar_ordenes_compra_maquinaria_maquinaria" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Enviar notificación a:</h4>
										</div>
										<div class="panel-body">
											<div id="treeUsuarios_autorizar_ordenes_compra_maquinaria_maquinaria" class="md-list-item-text"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="divEstatus_autorizar_ordenes_compra_maquinaria_maquinaria" class="row no-mostrar">
						<!--Estatus-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbEstatus_autorizar_ordenes_compra_maquinaria_maquinaria">Estatus</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbEstatus_autorizar_ordenes_compra_maquinaria_maquinaria" 
									 		name="strEstatus_autorizar_ordenes_compra_maquinaria_maquinaria" tabindex="1">
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
									<label for="txtMensaje_autorizar_ordenes_compra_maquinaria_maquinaria">Mensaje</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtMensaje_autorizar_ordenes_compra_maquinaria_maquinaria" 
											   name="strMensaje_autorizar_ordenes_compra_maquinaria_maquinaria" rows="5" value="" tabindex="1" placeholder="Ingrese mensaje" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Autorizar o rechazar registro-->
							<button class="btn btn-success" id="btnGuardar_autorizar_ordenes_compra_maquinaria_maquinaria"  
									onclick="validar_autorizar_ordenes_compra_maquinaria_maquinaria();"  title="Enviar" tabindex="1">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_autorizar_ordenes_compra_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_autorizar_ordenes_compra_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Autorizar Orden de Compra-->

		<!-- Diseño del modal Enviar Correo Electrónico-->
		<div id="EnviarOrdenesCompraMaquinariaMaquinariaBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_proveedor_ordenes_compra_maquinaria_maquinaria" class="ModalBodyTitle confirmacion-modal-title"">
			<h1>Enviar Correo Electrónico</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEnviarOrdenesCompraMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmEnviarOrdenesCompraMaquinariaMaquinaria"  onsubmit="return(false)" autocomplete="off">
			 		<div class="row">
			 			<!--Proveedor-->
			 			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtOrdenCompraMaquinariaID_proveedor_ordenes_compra_maquinaria_maquinaria" 
										   name="intOrdenCompraMaquinariaID_proveedor_ordenes_compra_maquinaria_maquinaria" 
										   type="hidden" value="">
									</input>
									<label for="txtProveedor_proveedor_ordenes_compra_maquinaria_maquinaria">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_proveedor_ordenes_compra_maquinaria_maquinaria" 
											name="strProveedor_proveedor_ordenes_compra_maquinaria_maquinaria" type="text" value="" 
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
									<label for="txtCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria">Correo electrónico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria" 
											name="strCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria" type="text" value="" 
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
									<label for="txtCopiaCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria">Copia</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCopiaCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria" 
											name="strCopiaCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria" type="text" value="" 
											tabindex="1" placeholder="Ingrese correo electrónico" maxlength="50">
									</input>
								</div>
							</div>
						</div>
			 		</div>
			 		<!--Circulo de progreso-->
					<div id="divCirculoBarProgreso_proveedor_ordenes_compra_maquinaria_maquinaria" class="load-container load5 circulo_bar no-mostrar">
						<div class="loader">Loading...</div>
						<br><br>
						<div align=center><b>Espere un momento por favor.</b></div>
					</div> 
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_proveedor_ordenes_compra_maquinaria_maquinaria"  
									onclick="validar_proveedor_ordenes_compra_maquinaria_maquinaria();"  title="Enviar correo electrónico" tabindex="1">
								<span class="glyphicon glyphicon-envelope"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_proveedor_ordenes_compra_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_proveedor_ordenes_compra_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Enviar Correo Electrónico-->

		<!-- Diseño del modal Ordenes de Compra-->
		<div id="OrdenesCompraMaquinariaMaquinariaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_ordenes_compra_maquinaria_maquinaria"  class="ModalBodyTitle">
			<h1>Ordenes de Compra</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmOrdenesCompraMaquinariaMaquinaria" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmOrdenesCompraMaquinariaMaquinaria"  onsubmit="return(false)" 
					  autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria" 
										   name="intOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria" type="hidden" value="">
									</input>
									<label for="txtFolio_ordenes_compra_maquinaria_maquinaria">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_ordenes_compra_maquinaria_maquinaria" 
											name="strFolio_ordenes_compra_maquinaria_maquinaria" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_ordenes_compra_maquinaria_maquinaria">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_ordenes_compra_maquinaria_maquinaria'>
					                    <input class="form-control" id="txtFecha_ordenes_compra_maquinaria_maquinaria"
					                    		name= "strFecha_ordenes_compra_maquinaria_maquinaria" 
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
									<label for="cmbMonedaID_ordenes_compra_maquinaria_maquinaria">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_ordenes_compra_maquinaria_maquinaria" 
									 		name="intMonedaID_ordenes_compra_maquinaria_maquinaria" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_ordenes_compra_maquinaria_maquinaria">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_ordenes_compra_maquinaria_maquinaria" id="txtTipoCambio_ordenes_compra_maquinaria_maquinaria" 
											name="intTipoCambio_ordenes_compra_maquinaria_maquinaria" type="text" value="" 
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
									<input id="txtProveedorID_ordenes_compra_maquinaria_maquinaria" 
										   name="intProveedorID_ordenes_compra_maquinaria_maquinaria"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del régimen fiscal-->
									<input id="txtRegimenFiscalID_ordenes_compra_maquinaria_maquinaria" 
										   name="intRegimenFiscalID_ordenes_compra_maquinaria_maquinaria"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar los días de crédito del proveedor seleccionado-->
									<input id="txtDiasCredito_ordenes_compra_maquinaria_maquinaria" 
										   name="intDiasCredito_ordenes_compra_maquinaria_maquinaria"  type="hidden" 
										   value="">
									</input>
									<label for="txtProveedor_ordenes_compra_maquinaria_maquinaria">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_ordenes_compra_maquinaria_maquinaria" 
											name="strProveedor_ordenes_compra_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Condiciones de pago-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCondicionesPago_ordenes_compra_maquinaria_maquinaria">Condiciones de pago</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbCondicionesPago_ordenes_compra_maquinaria_maquinaria" 
									 		name="strCondicionesPago_ordenes_compra_maquinaria_maquinaria" tabindex="1">
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
									<label for="txtFechaVencimiento_ordenes_compra_maquinaria_maquinaria">Fecha de vencimiento</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaVencimiento_ordenes_compra_maquinaria_maquinaria'>
					                    <input class="form-control" id="txtFechaVencimiento_ordenes_compra_maquinaria_maquinaria"
					                    		name= "strFechaVencimiento_ordenes_compra_maquinaria_maquinaria" 
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
									<label for="txtFechaEntrega_ordenes_compra_maquinaria_maquinaria">Fecha de entrega</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaEntrega_ordenes_compra_maquinaria_maquinaria'>
					                    <input class="form-control" id="txtFechaEntrega_ordenes_compra_maquinaria_maquinaria"
					                    		name= "strFechaEntrega_ordenes_compra_maquinaria_maquinaria" 
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
									<label for="txtFactura_ordenes_compra_maquinaria_maquinaria">Factura</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFactura_ordenes_compra_maquinaria_maquinaria" 
											name="strFactura_ordenes_compra_maquinaria_maquinaria" type="text" value="" 
											tabindex="1" placeholder="Ingrese factura" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Total de unidades-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTotalUnidades_ordenes_compra_maquinaria_maquinaria">Total de unidades</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control cantidad_ordenes_compra_maquinaria_maquinaria" id="txtTotalUnidades_ordenes_compra_maquinaria_maquinaria" 
											name="intTotalUnidades_ordenes_compra_maquinaria_maquinaria" type="text" value="" 
											tabindex="1" placeholder="Ingrese total de unidades" maxlength="14">
									</input>
								</div>
							</div>
						</div>
						<!--Total-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteTotal_ordenes_compra_maquinaria_maquinaria">Importe total</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_ordenes_compra_maquinaria_maquinaria" id="txtImporteTotal_ordenes_compra_maquinaria_maquinaria" 
												name="intImporteTotal_ordenes_compra_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23">
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
									<label for="txtObservaciones_ordenes_compra_maquinaria_maquinaria">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_ordenes_compra_maquinaria_maquinaria" 
											name="strObservaciones_ordenes_compra_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
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
									<input id="txtNumDetalles_ordenes_compra_maquinaria_maquinaria" 
										   name="intNumDetalles_ordenes_compra_maquinaria_maquinaria" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la orden de compra</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Concepto / Descripción de maquinaria -->
													<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id del concepto seleccionado-->
																<input id="txtMaquinariaDescripcionID_detalles_ordenes_compra_maquinaria_maquinaria" 
																	   name="intConceptoID_detalles_ordenes_compra_maquinaria_maquinaria"  
																	   type="hidden" 
																	   value="">
																</input>
																<label for="txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria">
																	Descripción de maquinaria
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria" 
																		name="strConcepto_detalles_ordenes_compra_maquinaria_maquinaria" type="text" value="" 
																		tabindex="1" placeholder="Ingrese descripción de maquinaria" maxlength="250">
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
																<label for="txtCantidad_detalles_ordenes_compra_maquinaria_maquinaria">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control cantidad_ordenes_compra_maquinaria_maquinaria" 
																		id="txtCantidad_detalles_ordenes_compra_maquinaria_maquinaria" 
																		name="intCantidad_detalles_ordenes_compra_maquinaria_maquinaria" 
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
																<label for="txtPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria">Precio unitario</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_ordenes_compra_maquinaria_maquinaria" id="txtPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria" 
																		name="intPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese precio unitario" maxlength="23">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_ordenes_compra_maquinaria_maquinaria" id="txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria" 
																		name="intPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria" type="text" value="0.00" 
																		tabindex="1" placeholder="Ingrese descuento" maxlength="15">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IVA-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
																<input id="txtTasaCuotaIva_detalles_ordenes_compra_maquinaria_maquinaria" 
																	   name="intTasaCuotaIva_detalles_ordenes_compra_maquinaria_maquinaria" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIva_detalles_ordenes_compra_maquinaria_maquinaria">IVA %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIva_detalles_ordenes_compra_maquinaria_maquinaria" 
																		name="intPorcentajeIva_detalles_ordenes_compra_maquinaria_maquinaria" type="text" value="" 
																		tabindex="1" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IEPS-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la tasa o cuota seleccionada-->
																<input id="txtTasaCuotaIeps_detalles_ordenes_compra_maquinaria_maquinaria" 
																	   name="intTasaCuotaIeps_detalles_ordenes_compra_maquinaria_maquinaria" 
																	   type="hidden" value="">
																</input>
																<label for="txtPorcentajeIeps_detalles_ordenes_compra_maquinaria_maquinaria">IEPS %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIeps_detalles_ordenes_compra_maquinaria_maquinaria" 
																		name="intPorcentajeIeps_detalles_ordenes_compra_maquinaria_maquinaria" type="text" value="" 
																		tabindex="1"  disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_detalles_ordenes_compra_maquinaria_maquinaria"
					                                			onclick="agregar_renglon_detalles_ordenes_compra_maquinaria_maquinaria();" 
					                                	     	title="Agregar" tabindex="1"> 
					                                		<span class="glyphicon glyphicon-plus"></span>
					                                	</button>
					                             	</div>
												</div>
											</div>
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_ordenes_compra_maquinaria_maquinaria">
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
															<tr class="movil">
																<td class="movil t1">
																	<strong>Total</strong>
																</td>
																<td  class="movil t2">
																	<strong id="acumCantidad_detalles_ordenes_compra_maquinaria_maquinaria"></strong>
																</td>
																<td class="movil t3" colspan="1"></td>
																<td class="movil t4">
																	<strong id="acumDescuento_detalles_ordenes_compra_maquinaria_maquinaria"></strong>
																</td>
																<td class="movil t5">
																	<strong id="acumSubtotal_detalles_ordenes_compra_maquinaria_maquinaria"></strong>
																</td>
																<td class="movil t6">
																	<strong id="acumIva_detalles_ordenes_compra_maquinaria_maquinaria"></strong>
																</td>
																<td class="movil t7">
																	<strong  id="acumIeps_detalles_ordenes_compra_maquinaria_maquinaria"></strong>
																</td>
																<td class="movil t8">
																	<strong id="acumTotal_detalles_ordenes_compra_maquinaria_maquinaria"></strong>
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
																<strong id="numElementos_detalles_ordenes_compra_maquinaria_maquinaria">0</strong> encontrados
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
							<div id="divRetencionIsr_ordenes_compra_maquinaria_maquinaria"  class="col-sm-6 col-md-6 col-lg-6 col-xs-12 pull-right no-mostrar">
									<div class="form-group">
											<!--Porcentaje de ISR-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<input id="txtPorcentajeRetencionID_ordenes_compra_maquinaria_maquinaria" name="intPorcentajeRetencionID_ordenes_compra_maquinaria_maquinaria" type="hidden" value="">
														</input>
														<label for="txtPorcentajeIsr_ordenes_compra_maquinaria_maquinaria">Retención de ISR %</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control" id="txtPorcentajeIsr_ordenes_compra_maquinaria_maquinaria" 
																name="intPorcentajeIsr_ordenes_compra_maquinaria_maquinaria" type="text" value="" 
																tabindex="1" placeholder="Ingrese retención de ISR" maxlength="250">
														</input>
													</div>
												</div>
											</div>
											<!--Importe retenido-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<label for="txtImporteRetenido_ordenes_compra_maquinaria_maquinaria">Importe de ISR</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control moneda_ordenes_compra_maquinaria_maquinaria" id="txtImporteRetenido_ordenes_compra_maquinaria_maquinaria" 
																name="intImporteRetenido_ordenes_compra_maquinaria_maquinaria" type="text" value="" 
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
							<button class="btn btn-success" id="btnGuardar_ordenes_compra_maquinaria_maquinaria"  
									onclick="validar_ordenes_compra_maquinaria_maquinaria();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!---Autorizar o rechazar registro-->
							<button class="btn btn-default" id="btnAutorizar_ordenes_compra_maquinaria_maquinaria"  
									onclick="abrir_autorizar_ordenes_compra_maquinaria_maquinaria('','','Autorizar');"  title="Autorizar o Rechazar" tabindex="3" disabled>
								<span class="fa fa-check-square-o"></span>
							</button>
							<!--Enviar correo electrónico-->
							<button class="btn btn-default" id="btnEnviarCorreo_ordenes_compra_maquinaria_maquinaria"  
									onclick="abrir_proveedor_ordenes_compra_maquinaria_maquinaria('');"  
									title="Enviar correo electrónico" tabindex="4" disabled>
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_ordenes_compra_maquinaria_maquinaria"  
									onclick="reporte_registro_ordenes_compra_maquinaria_maquinaria('');"  title="Imprimir registro en PDF" tabindex="5" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
		                    <!--Subir varios archivos-->
		                    <span  class="fileupload-buttonbar" tabindex="6" disabled>
		                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_ordenes_compra_maquinaria_maquinaria">
		                        	<span class="fa fa-upload"></span>
		                        	<input id="archivo_varios_ordenes_compra_maquinaria_maquinaria" 
		                        		   name="archivo_varios_ordenes_compra_maquinaria_maquinaria[]" type="file" multiple 
		                        		   accept="text/xml,application/pdf" onchange="subir_archivos_modal_ordenes_compra_maquinaria_maquinaria('Editar');">
		                        	</input>
		                        </span>
		                    </span>
		                     <!--Descargar archivo-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_ordenes_compra_maquinaria_maquinaria"  
									onclick="descargar_archivos_ordenes_compra_maquinaria_maquinaria('','');"  title="Descargar archivo" tabindex="7" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Eliminar archivo-->
							<button class="btn btn-default" id="btnEliminarArchivo_ordenes_compra_maquinaria_maquinaria"  
									onclick="eliminar_archivos_ordenes_compra_maquinaria_maquinaria('')"  title="Eliminar archivo" tabindex="8" disabled>
								<span class="glyphicon glyphicon-export"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_ordenes_compra_maquinaria_maquinaria"  
									onclick="cambiar_estatus_ordenes_compra_maquinaria_maquinaria('','ACTIVO');"  title="Desactivar" tabindex="9" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_ordenes_compra_maquinaria_maquinaria"  
									onclick="cambiar_estatus_ordenes_compra_maquinaria_maquinaria('','INACTIVO');"  title="Restaurar" tabindex="10" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_ordenes_compra_maquinaria_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_ordenes_compra_maquinaria_maquinaria();" 
									title="Cerrar"  tabindex="11">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Ordenes de Compra-->
	</div><!--#OrdenesCompraMaquinariaMaquinariaContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_ordenes_compra_maquinaria_maquinaria" type="text/template">
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
		var intPaginaOrdenesCompraMaquinariaMaquinaria = 0;
		var strUltimaBusquedaOrdenesCompraMaquinariaMaquinaria = "";
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDOrdenesCompraMaquinariaMaquinaria = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseOrdenesCompraMaquinariaMaquinaria = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoOrdenesCompraMaquinariaMaquinaria = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar el id del porcentaje de retención ISR base
		var intPorcentajeRetencionBaseIDOrdenesCompraMaquinariaMaquinaria = <?php echo PORCENTAJE_ISR_BASE ?>;
		//Variable que se utiliza para asignar el id del régimen fiscal: Régimen Simplificado de Confianza
		var intRegimenFiscalIDResicoOrdenesCompraMaquinariaMaquinaria = <?php echo REGIMEN_FISCAL_RESICO ?>;
		//Variable que se utiliza para asignar objeto del modal Autorizar Orden de Compra
		var objAutorizarOrdenesCompraMaquinariaMaquinaria = null;
		//Variable que se utiliza para asignar objeto del modal Enviar Correo Electrónico
		var objEnviarOrdenesCompraMaquinariaMaquinaria = null;
		//Variable que se utiliza para asignar objeto del modal
		var objOrdenesCompraMaquinariaMaquinaria = null;

		//Array que contiene los id´s de las cajas de texto que se utilizan para calcular la fecha de vencimiento
		var arrFechaVencimientoOrdenesCompraMaquinariaMaquinaria  = {fecha: '#txtFecha_ordenes_compra_maquinaria_maquinaria',
														   condicionesPago: '#cmbCondicionesPago_ordenes_compra_maquinaria_maquinaria',
														   diasCredito: '#txtDiasCredito_ordenes_compra_maquinaria_maquinaria',
														   fechaVencimiento: '#txtFechaVencimiento_ordenes_compra_maquinaria_maquinaria'
															};

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_ordenes_compra_maquinaria_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/ordenes_compra_maquinaria/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_ordenes_compra_maquinaria_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosOrdenesCompraMaquinariaMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosOrdenesCompraMaquinariaMaquinaria = strPermisosOrdenesCompraMaquinariaMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosOrdenesCompraMaquinariaMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosOrdenesCompraMaquinariaMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosOrdenesCompraMaquinariaMaquinaria[i]=='GUARDAR') || (arrPermisosOrdenesCompraMaquinariaMaquinaria[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
						}
						//Si el indice es ADJUNTAR
						else if(arrPermisosOrdenesCompraMaquinariaMaquinaria[i]=='ADJUNTAR')
						{
							//Habilitar el control (botón Adjuntar)
							$('#btnAdjuntar_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
							//Habilitar el control (botón eliminar archivo)
							$('#btnEliminarArchivo_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosOrdenesCompraMaquinariaMaquinaria[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
						}
						//Si el indice es ENVIAR CORREO
						else if(arrPermisosOrdenesCompraMaquinariaMaquinaria[i]=='ENVIAR CORREO')
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraMaquinariaMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_ordenes_compra_maquinaria_maquinaria();
						}
						else if(arrPermisosOrdenesCompraMaquinariaMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
							$('#btnRestaurar_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraMaquinariaMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraMaquinariaMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraMaquinariaMaquinaria[i]=='AUTORIZAR')//Si el indice es AUTORIZAR
						{
							//Habilitar el control (botón autorizar)
							$('#btnAutorizar_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraMaquinariaMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_ordenes_compra_maquinaria_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_ordenes_compra_maquinaria_maquinaria() 
		{
   			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaOrdenesCompraMaquinariaMaquinaria =($('#txtFechaInicialBusq_ordenes_compra_maquinaria_maquinaria').val()+$('#txtFechaFinalBusq_ordenes_compra_maquinaria_maquinaria').val()+$('#txtProveedorIDBusq_ordenes_compra_maquinaria_maquinaria').val()+$('#cmbEstatusBusq_ordenes_compra_maquinaria_maquinaria').val()+$('#txtBusqueda_ordenes_compra_maquinaria_maquinaria').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaOrdenesCompraMaquinariaMaquinaria != strUltimaBusquedaOrdenesCompraMaquinariaMaquinaria)
			{
				intPaginaOrdenesCompraMaquinariaMaquinaria = 0;
				strUltimaBusquedaOrdenesCompraMaquinariaMaquinaria = strNuevaBusquedaOrdenesCompraMaquinariaMaquinaria;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('maquinaria/ordenes_compra_maquinaria/get_paginacion',
					{//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_compra_maquinaria_maquinaria').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_compra_maquinaria_maquinaria').val()),
					 intProveedorID: $('#txtProveedorIDBusq_ordenes_compra_maquinaria_maquinaria').val(),
					 strEstatus: $('#cmbEstatusBusq_ordenes_compra_maquinaria_maquinaria').val(),
					 strBusqueda: $('#txtBusqueda_ordenes_compra_maquinaria_maquinaria').val(),
					 intPagina: intPaginaOrdenesCompraMaquinariaMaquinaria,
					 strPermisosAcceso: $('#txtAcciones_ordenes_compra_maquinaria_maquinaria').val()
					},
					function(data){
						$('#dg_ordenes_compra_maquinaria_maquinaria tbody').empty();
						var tmpOrdenesCompraMaquinariaMaquinaria = Mustache.render($('#plantilla_ordenes_compra_maquinaria_maquinaria').html(),data);
						$('#dg_ordenes_compra_maquinaria_maquinaria tbody').html(tmpOrdenesCompraMaquinariaMaquinaria);
						$('#pagLinks_ordenes_compra_maquinaria_maquinaria').html(data.paginacion);
						$('#numElementos_ordenes_compra_maquinaria_maquinaria').html(data.total_rows);
						intPaginaOrdenesCompraMaquinariaMaquinaria = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_ordenes_compra_maquinaria_maquinaria(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/ordenes_compra_maquinaria/';

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
			if ($('#chbImprimirDetalles_ordenes_compra_maquinaria_maquinaria').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_ordenes_compra_maquinaria_maquinaria').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_ordenes_compra_maquinaria_maquinaria').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_compra_maquinaria_maquinaria').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_compra_maquinaria_maquinaria').val()),
										'intProveedorID': $('#txtProveedorIDBusq_ordenes_compra_maquinaria_maquinaria').val(),
										'strEstatus': $('#cmbEstatusBusq_ordenes_compra_maquinaria_maquinaria').val(), 
										'strBusqueda': $('#txtBusqueda_ordenes_compra_maquinaria_maquinaria').val(),
										'strDetalles': $('#chbImprimirDetalles_ordenes_compra_maquinaria_maquinaria').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
			
		}

		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_ordenes_compra_maquinaria_maquinaria(id) 
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'maquinaria/ordenes_compra_maquinaria/get_reporte_registro',
							'data' : {
										'intOrdenCompraMaquinariaID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		

		//Función para subir archivos de un registro desde el grid view
		function subir_archivos_grid_ordenes_compra_maquinaria_maquinaria(ordenCompraMaquinariaID)
		{
			//Crear instancia al objeto del formulario
	        var formData = new FormData($("#frmOrdenesCompraMaquinariaMaquinaria")[0]);
			//Agregar campos al objeto del formulario
			formData.append("intOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria", ordenCompraMaquinariaID);
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDGridOrdenesCompraMaquinariaMaquinaria  = "archivo_varios"+ordenCompraMaquinariaID;
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDGridOrdenesCompraMaquinariaMaquinaria);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDGridOrdenesCompraMaquinariaMaquinaria)[0].files;
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
					formData.append("archivo_varios_ordenes_compra_maquinaria_maquinaria[]", document.getElementById("archivo_varios"+ordenCompraMaquinariaID).files[intCont]);
				 	
				}
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Limpia ruta del archivo cargado
		        $('#'+strBotonArchivoIDGridOrdenesCompraMaquinariaMaquinaria).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_ordenes_compra_maquinaria_maquinaria('error', strMensajeError);
	        }
	        else
	        {
	        	//Hacer un llamado al método del controlador para subir archivos del registro
	            $.ajax({
	                url: 'maquinaria/ordenes_compra_maquinaria/subir_archivos',
	                type: "POST",
	                data: formData,
	                contentType: false,
	                processData: false,
	                success: function(data)
	                {
	                    //Limpia ruta del archivo cargado
		         		$('#'+strBotonArchivoIDGridOrdenesCompraMaquinariaMaquinaria).val('');
						//Subida finalizada.
						if (data.resultado)
						{
		         		   //Hacer llamado a la función  para cargar  los registros en el grid
			           	   paginacion_ordenes_compra_maquinaria_maquinaria();  
						}
                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    		mensaje_ordenes_compra_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
	                }
            	});

	        }

		}

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_ordenes_compra_maquinaria_maquinaria(ordenCompraMaquinariaID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intOrdenCompraMaquinariaID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(ordenCompraMaquinariaID == '')
			{
				intOrdenCompraMaquinariaID = $('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val();
				strFolio = $('#txtFolio_ordenes_compra_maquinaria_maquinaria').val();
			}
			else
			{
				intOrdenCompraMaquinariaID = ordenCompraMaquinariaID;
				strFolio = folio;
			}

			//Definir encapsulamiento de datos que son necesarios para descargar el archivo
			objArchivo = {'url': 'maquinaria/ordenes_compra_maquinaria/descargar_archivos',
							'data' : {
										'intOrdenCompraMaquinariaID': intOrdenCompraMaquinariaID,
										'strFolio': strFolio				
									 }
						   };


			//Hacer un llamado a la función para descarga del archivo
			$.imprimirReporte(objArchivo);

		}

		//Función que se utiliza para eliminar los archivos del registro seleccionado
		function eliminar_archivos_ordenes_compra_maquinaria_maquinaria(id)
		{

			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;

			//Si no existe id, significa que se eliminara el archivo desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para eliminar carpeta que contiene los archivos del registro
			$.post('maquinaria/ordenes_compra_maquinaria/eliminar_carpeta_registro',
			     {intOrdenCompraMaquinariaID: intID
			     },
			     function(data) {
			       
			        if(data.resultado)
			        {
			         	//Hacer llamado a la función  para cargar  los registros en el grid
		          	    paginacion_ordenes_compra_maquinaria_maquinaria();
		          	    //Si el id del registro se obtuvo del modal
						if(id == '')
						{
							//Ocultar los siguientes botones
							$('#btnDescargarArchivo_ordenes_compra_maquinaria_maquinaria').hide();
							$('#btnEliminarArchivo_ordenes_compra_maquinaria_maquinaria').hide();    
						}
			        }
		        	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		       		mensaje_ordenes_compra_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
			       
			     },
			    'json');
		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_ordenes_compra_maquinaria_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_ordenes_compra_maquinaria_maquinaria').empty();
					var temp = Mustache.render($('#monedas_ordenes_compra_maquinaria_maquinaria').html(), data);
					$('#cmbMonedaID_ordenes_compra_maquinaria_maquinaria').html(temp);
				},
				'json');
		}


		//Regresar el porcentaje de retención ISR base
		function cargar_porcentaje_isr_base_ordenes_compra_maquinaria_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/porcentaje_retencion_isr/get_datos',
			       {
			       		strBusqueda:intPorcentajeRetencionBaseIDOrdenesCompraMaquinariaMaquinaria,
			       		strTipo: 'id'
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				            $('#txtPorcentajeRetencionID_ordenes_compra_maquinaria_maquinaria').val(data.row.porcentaje_retencion_id);
				            $('#txtPorcentajeIsr_ordenes_compra_maquinaria_maquinaria').val(data.row.porcentaje);
			       	    }
			       },
			       'json');
		}


		/*******************************************************************************************************************
		Funciones del modal Autorizar Orden de Compra
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_autorizar_ordenes_compra_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmAutorizarOrdenesCompraMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_ordenes_compra_maquinaria_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmAutorizarOrdenesCompraMaquinariaMaquinaria').find('input[type=hidden]').val('');
			//Agregar clase no-mostrar para ocultar div que contiene el estatus
			$('#divEstatus_autorizar_ordenes_compra_maquinaria_maquinaria').addClass("no-mostrar");
		    $('#divEncabezadoModal_autorizar_ordenes_compra_maquinaria_maquinaria').addClass("estatus-ACTIVO");
		}

		//Función que se utiliza para abrir el modal
		function abrir_autorizar_ordenes_compra_maquinaria_maquinaria(id, folio, tipoAccion)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_autorizar_ordenes_compra_maquinaria_maquinaria();
			
			//Variables que se utilizan para asignar los datos del registro
			var intReferenciaID = 0;
			var strFolio = '';

			//Si no existe id, significa que se aplicará autorización (o rechazo) desde el modal
			if(id == '')
			{
				intReferenciaID = $('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val();
				strFolio =  $('#txtFolio_ordenes_compra_maquinaria_maquinaria').val();
				$('#txtModalOrdenesCompra_autorizar_ordenes_compra_maquinaria_maquinaria').val('SI');
			}
			else
			{
				intReferenciaID = id;
				strFolio = folio;
				$('#txtModalOrdenesCompra_autorizar_ordenes_compra_maquinaria_maquinaria').val('NO');
			}

			//Asignar datos del registro seleccionado
			$('#txtReferenciaID_autorizar_ordenes_compra_maquinaria_maquinaria').val(intReferenciaID);
			$('#txtTipoAccion_autorizar_ordenes_compra_maquinaria_maquinaria').val(tipoAccion);
			$('#txtFolio_autorizar_ordenes_compra_maquinaria_maquinaria').val(strFolio);

			//Si el tipo de acción corresponde a Guardar
			if(tipoAccion == 'Guardar')
			{
				//Cambiar título del modal
				$('#tituloModal_autorizar_ordenes_compra_maquinaria_maquinaria').text('Notificar Orden de Compra');
				$('#txtMensaje_autorizar_ordenes_compra_maquinaria_maquinaria').val('Favor de autorizar la orden de compra maquinaria '+ strFolio);
				//Cargar el treeview
				get_treeview_usuarios_autorizar_ordenes_compra_maquinaria_maquinaria('');
			}
			else
			{
				//Quitar clase no-mostrar para mostrar div que contiene el estatus
				$('#divEstatus_autorizar_ordenes_compra_maquinaria_maquinaria').removeClass("no-mostrar");
				//Cambiar título del modal
				$('#tituloModal_autorizar_ordenes_compra_maquinaria_maquinaria').text('Autorizar Orden de Compra');
				//Cargar el treeview
				get_treeview_usuarios_autorizar_ordenes_compra_maquinaria_maquinaria(intReferenciaID);
			}

			//Abrir modal
			objAutorizarOrdenesCompraMaquinariaMaquinaria = $('#AutorizarOrdenesCompraMaquinariaMaquinariaBox').bPopup({
													   appendTo: '#OrdenesCompraMaquinariaMaquinariaContent', 
							                           contentContainer: 'OrdenesCompraMaquinariaMaquinariaM', 
							                           zIndex: 2, 
							                           modalClose: false, 
							                           modal: true, 
							                           follow: [true,false], 
							                           followEasing : "linear", 
							                           easing: "linear", 
							                           modalColor: ('#F0F0F0')});
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_autorizar_ordenes_compra_maquinaria_maquinaria()
		{
			try {
				//Cerrar modal
				objAutorizarOrdenesCompraMaquinariaMaquinaria.close();
				//Eliminar datos del treeview
				$("#treeUsuarios_autorizar_ordenes_compra_maquinaria_maquinaria").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_compra_maquinaria_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_autorizar_ordenes_compra_maquinaria_maquinaria()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosAutorizarOrdenesCompraMaquinariaMaquinaria = [];

			//Recorremos el treeview
			$("#treeUsuarios_autorizar_ordenes_compra_maquinaria_maquinaria").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosAutorizarOrdenesCompraMaquinariaMaquinaria.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtUsuarios_autorizar_ordenes_compra_maquinaria_maquinaria").val(arrSeleccionadosAutorizarOrdenesCompraMaquinariaMaquinaria.join('|'));
			
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_ordenes_compra_maquinaria_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmAutorizarOrdenesCompraMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_autorizar_ordenes_compra_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba un mensaje'}
											}
										},
										strUsuarios_autorizar_ordenes_compra_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un usuario para este mensaje.'}
											}
										}, 
										strEstatus_autorizar_ordenes_compra_maquinaria_maquinaria: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista estatus seleccionado cuando el tipo de acción sea Autorizar
					                                    if($('#txtTipoAccion_autorizar_ordenes_compra_maquinaria_maquinaria').val() === 'Autorizar' && $('#cmbEstatus_autorizar_ordenes_compra_maquinaria_maquinaria').val() == '')
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
			var bootstrapValidator_autorizar_ordenes_compra_maquinaria_maquinaria = $('#frmAutorizarOrdenesCompraMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_autorizar_ordenes_compra_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_autorizar_ordenes_compra_maquinaria_maquinaria.isValid())
			{
				//Hacer un llamado a la función para guardar la solicitud de devolución
				guardar_autorizar_ordenes_compra_maquinaria_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_autorizar_ordenes_compra_maquinaria_maquinaria()
		{
			try
			{
				$('#frmAutorizarOrdenesCompraMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar la autorización (o el rechazo) de un registro
		function guardar_autorizar_ordenes_compra_maquinaria_maquinaria()
		{
			//Hacer un llamado al método del controlador para enviar la autorización (o el rechazo) de un registro 
			$.post('maquinaria/ordenes_compra_maquinaria/set_enviar_autorizacion',
			     {intOrdenCompraMaquinariaID: $('#txtReferenciaID_autorizar_ordenes_compra_maquinaria_maquinaria').val(),
			      strUsuarios: $('#txtUsuarios_autorizar_ordenes_compra_maquinaria_maquinaria').val(), 
			      strMensaje:  $('#txtMensaje_autorizar_ordenes_compra_maquinaria_maquinaria').val(),
			      strEstatus:  $('#cmbEstatus_autorizar_ordenes_compra_maquinaria_maquinaria').val(),
			      strTipoAccion:  $('#txtTipoAccion_autorizar_ordenes_compra_maquinaria_maquinaria').val()
			     },
			     function(data) {
			        if(data.resultado)
			        {
			          	//Hacer llamado a la función  para cargar  los registros en el grid
			          	paginacion_ordenes_compra_maquinaria_maquinaria();
			          	//Hacer un llamado a la función para cerrar modal
					  	cerrar_autorizar_ordenes_compra_maquinaria_maquinaria();

					  	//Si el id de la referencia (para la validación) se recuperó del modal Ordenes de Compra 
					  	if($('#txtModalOrdenesCompra_autorizar_ordenes_compra_maquinaria_maquinaria').val() == 'SI')
					  	{
					  		//Hacer un llamado a la función para cerrar modal Ordenes de Compra 
					 	 	cerrar_ordenes_compra_maquinaria_maquinaria();
					  	}   
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_ordenes_compra_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		/*Función que se utiliza para definir tree view de usuarios con acceso a la función Autorizar del proceso
		 *Ordenes de Compra (módulo Maquinaria)*/
		function get_treeview_usuarios_autorizar_ordenes_compra_maquinaria_maquinaria(id)
		{
			$('#treeUsuarios_autorizar_ordenes_compra_maquinaria_maquinaria').fancytree({
				source: {
					url: "seguridad/usuarios/get_treeview/AUTORIZAR_ORDENES_COMPRA_MAQUINARIA/ORDENES DE COMPRA MAQUINARIA/"+id,
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
		function nuevo_proveedor_ordenes_compra_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmEnviarOrdenesCompraMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedor_ordenes_compra_maquinaria_maquinaria();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_proveedor_ordenes_compra_maquinaria_maquinaria');
		}

		//Función que se utiliza para abrir el modal
		function abrir_proveedor_ordenes_compra_maquinaria_maquinaria(id)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_proveedor_ordenes_compra_maquinaria_maquinaria();
			//Variables que se utilizan para asignar los datos del registro
			var intID = 0;

			//Si no existe id, significa que se enviará correo electrónico desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val();
				
			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/ordenes_compra_maquinaria/get_datos',
			       {intOrdenCompraMaquinariaID:intID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Asignar datos del registro seleccionado
							$('#txtOrdenCompraMaquinariaID_proveedor_ordenes_compra_maquinaria_maquinaria').val(data.row.orden_compra_maquinaria_id);
							$('#txtProveedor_proveedor_ordenes_compra_maquinaria_maquinaria').val(data.row.proveedor);
							$('#txtCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria').val(data.row.correo_electronico);
							$('#txtCopiaCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria').val(data.row.contacto_correo_electronico);
							//Dependiendo del estatus cambiar el color del encabezado 
						    $('#divEncabezadoModal_proveedor_ordenes_compra_maquinaria_maquinaria').addClass("estatus-"+data.row.estatus);

						    //Abrir modal
							objEnviarOrdenesCompraMaquinariaMaquinaria = $('#EnviarOrdenesCompraMaquinariaMaquinariaBox').bPopup({
																   appendTo: '#OrdenesCompraMaquinariaMaquinariaContent', 
										                           contentContainer: 'OrdenesCompraMaquinariaMaquinariaM', 
										                           zIndex: 2, 
										                           modalClose: false, 
										                           modal: true, 
										                           follow: [true,false], 
										                           followEasing : "linear", 
										                           easing: "linear", 
										                           modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria').focus();
			            }
			         },
			       'json');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_proveedor_ordenes_compra_maquinaria_maquinaria()
		{
			try {
				//Cerrar modal
				objEnviarOrdenesCompraMaquinariaMaquinaria.close();
				//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		        ocultar_circulo_carga_proveedor_ordenes_compra_maquinaria_maquinaria();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_proveedor_ordenes_compra_maquinaria_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedor_ordenes_compra_maquinaria_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmEnviarOrdenesCompraMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria: {
				                        	validators: {
				                        		notEmpty: {message: 'Escriba un correo electrónico'},
				                                regexp: {
				                                  	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
				                                    message: 'Escriba una dirección de correo electrónico que sea válida'
				                                }
				                          	}
					                    },
					                    strCopiaCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria: {
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
			var bootstrapValidator_proveedor_ordenes_compra_maquinaria_maquinaria = $('#frmEnviarOrdenesCompraMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_proveedor_ordenes_compra_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_proveedor_ordenes_compra_maquinaria_maquinaria.isValid())
			{
				//Hacer un llamado a la función para enviar correo electrónico
				enviar_correo_proveedor_ordenes_compra_maquinaria_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_proveedor_ordenes_compra_maquinaria_maquinaria()
		{
			try
			{
				$('#frmEnviarOrdenesCompraMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar correo electrónico al proveedor
		function enviar_correo_proveedor_ordenes_compra_maquinaria_maquinaria()
		{
			//Hacer un llamado a la función para mostrar el div que contiene la barra de circulo de carga
			mostrar_circulo_carga_proveedor_ordenes_compra_maquinaria_maquinaria();
			//Hacer un llamado al método del controlador para enviar correo electrónico al proveedor
			$.post('maquinaria/ordenes_compra_maquinaria/enviar_correo_electronico_proveedor',
					{ 
						intOrdenCompraMaquinariaID: $('#txtOrdenCompraMaquinariaID_proveedor_ordenes_compra_maquinaria_maquinaria').val(),
						strCorreoElectronico: $('#txtCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria').val(),
						strCopiaCorreoElectronico: $('#txtCopiaCorreoElectronico_proveedor_ordenes_compra_maquinaria_maquinaria').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_proveedor_ordenes_compra_maquinaria_maquinaria();
						}

						//Hacer un llamado a la función para ocultar el div que contiene la barra de circulo de carga
		           	 	ocultar_circulo_carga_proveedor_ordenes_compra_maquinaria_maquinaria();
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_compra_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

			//Función que se utiliza para mostrar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function mostrar_circulo_carga_proveedor_ordenes_compra_maquinaria_maquinaria()
		{
			//Remover clase para mostrar div que contiene la barra de carga
			$("#divCirculoBarProgreso_proveedor_ordenes_compra_maquinaria_maquinaria").removeClass('no-mostrar');
		}

		//Función que se utiliza para ocultar el div que contiene el  bar de círculo carga
		//al momento de enviar correo electrónico
		function ocultar_circulo_carga_proveedor_ordenes_compra_maquinaria_maquinaria()
		{
			//Agregar clase para ocultar div que contiene la barra de carga
			$("#divCirculoBarProgreso_proveedor_ordenes_compra_maquinaria_maquinaria").addClass('no-mostrar');
		}

		/*******************************************************************************************************************
		Funciones del modal Ordenes de Compra
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_ordenes_compra_maquinaria_maquinaria()
		{
			//Incializar formulario
			$('#frmOrdenesCompraMaquinariaMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_compra_maquinaria_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmOrdenesCompraMaquinariaMaquinaria').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_ordenes_compra_maquinaria_maquinaria');
			
		    //Eliminar los datos de la tabla detalles de la orden de compra
		    $('#dg_detalles_ordenes_compra_maquinaria_maquinaria tbody').empty();
		    $('#acumCantidad_detalles_ordenes_compra_maquinaria_maquinaria').html('');
		    $('#acumDescuento_detalles_ordenes_compra_maquinaria_maquinaria').html('');
		    $('#acumSubtotal_detalles_ordenes_compra_maquinaria_maquinaria').html('');
		    $('#acumIva_detalles_ordenes_compra_maquinaria_maquinaria').html('');
		    $('#acumIeps_detalles_ordenes_compra_maquinaria_maquinaria').html('');
		    $('#acumTotal_detalles_ordenes_compra_maquinaria_maquinaria').html('');
			$('#numElementos_detalles_ordenes_compra_maquinaria_maquinaria').html(0);

			//Asignar NO para indicar que no se ha abierto el modal Autorizar Orden de Compra
			$('#txtModalOrdenesCompra_autorizar_ordenes_compra_maquinaria_maquinaria').val('NO');
			//Limpiar el componente archivo(s) seleccionado(s)
			$('#archivo_varios_ordenes_compra_maquinaria_maquinaria').val('');
			
			//Habilitar todos los elementos del formulario
			$('#frmOrdenesCompraMaquinariaMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');
			//Asignar la fecha actual
			$('#txtFecha_ordenes_compra_maquinaria_maquinaria').val(fechaActual()); 
			$('#txtFechaVencimiento_ordenes_compra_maquinaria_maquinaria').val(fechaActual()); 
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_ordenes_compra_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtPorcentajeIva_detalles_ordenes_compra_maquinaria_maquinaria').attr("disabled", "disabled");
			$('#txtPorcentajeIeps_detalles_ordenes_compra_maquinaria_maquinaria').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_ordenes_compra_maquinaria_maquinaria").show();
			$("#btnAdjuntar_ordenes_compra_maquinaria_maquinaria").show();
			//Habilitar botón Agregar
			$('#btnAgregar_detalles_ordenes_compra_maquinaria_maquinaria').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnAutorizar_ordenes_compra_maquinaria_maquinaria").hide();
			$("#btnEnviarCorreo_ordenes_compra_maquinaria_maquinaria").hide();
			$("#btnImprimirRegistro_ordenes_compra_maquinaria_maquinaria").hide();
			$("#btnDescargarArchivo_ordenes_compra_maquinaria_maquinaria").hide();
			$("#btnEliminarArchivo_ordenes_compra_maquinaria_maquinaria").hide();
			$("#btnDesactivar_ordenes_compra_maquinaria_maquinaria").hide();
			$("#btnRestaurar_ordenes_compra_maquinaria_maquinaria").hide();

			//Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_ordenes_compra_maquinaria_maquinaria();
		}
		
		//Función para inicializar elementos del proveedor
		function inicializar_proveedor_ordenes_compra_maquinaria_maquinaria()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtDiasCredito_ordenes_compra_maquinaria_maquinaria').val('');
            $('#txtRegimenFiscalID_ordenes_compra_maquinaria_maquinaria').val('');
            $('#txtPorcentajeRetencionID_ordenes_compra_maquinaria_maquinaria').val('');
            $('#txtPorcentajeIsr_ordenes_compra_maquinaria_maquinaria').val('');
            $('#txtImporteRetenido_ordenes_compra_maquinaria_maquinaria').val('');

            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
	        mostrar_retencion_isr_ordenes_compra_maquinaria_maquinaria();
            
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_ordenes_compra_maquinaria_maquinaria()
		{
			try {
				//Cerrar modal
				objOrdenesCompraMaquinariaMaquinaria.close();
				//Hacer un llamado a la función para cerrar modal Enviar Correo Electrónico
			    cerrar_proveedor_ordenes_compra_maquinaria_maquinaria();
				//Si el id de la referencia (para la devolución) se recuperó del modal Ordenes de Compra 
				if($('#txtModalOrdenesCompra_autorizar_ordenes_compra_maquinaria_maquinaria').val() == 'SI')
				{
					//Hacer un llamado a la función para cerrar modal Autorizar Orden de Compra
					cerrar_autorizar_ordenes_compra_maquinaria_maquinaria();
				}
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_compra_maquinaria_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_ordenes_compra_maquinaria_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_compra_maquinaria_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmOrdenesCompraMaquinariaMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_ordenes_compra_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaEntrega_ordenes_compra_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaVencimiento_ordenes_compra_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strCondicionesPago_ordenes_compra_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una condición de pago'}
											}
										},
										intMonedaID_ordenes_compra_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_ordenes_compra_maquinaria_maquinaria: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_ordenes_compra_maquinaria_maquinaria').val()) !== intMonedaBaseIDOrdenesCompraMaquinariaMaquinaria)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoOrdenesCompraMaquinariaMaquinaria)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoOrdenesCompraMaquinariaMaquinaria
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strProveedor_ordenes_compra_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtProveedorID_ordenes_compra_maquinaria_maquinaria').val() === '')
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
										intPorcentajeIsr_ordenes_compra_maquinaria_maquinaria: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el id del porcentaje de retención ISR
						                                    if(parseInt($('#txtRegimenFiscalID_ordenes_compra_maquinaria_maquinaria').val()) === intRegimenFiscalIDResicoOrdenesCompraMaquinariaMaquinaria)
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
										intImporteRetenido_ordenes_compra_maquinaria_maquinaria: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el id del porcentaje de retención ISR
						                                    if(parseInt($('#txtRegimenFiscalID_ordenes_compra_maquinaria_maquinaria').val()) === intRegimenFiscalIDResicoOrdenesCompraMaquinariaMaquinaria)
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
										strDepartamento_ordenes_compra_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del departamento
					                                    if($('#txtDepartamentoID_ordenes_compra_maquinaria_maquinaria').val() === '')
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
										strSucursal_ordenes_compra_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la sucursal
					                                    if($('#txtSucursalID_ordenes_compra_maquinaria_maquinaria').val() === '')
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
										intTotalUnidades_ordenes_compra_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba el total de unidades'}
											}
										},
										intImporteTotal_ordenes_compra_maquinaria_maquinaria: {
											validators: {
												notEmpty: {message: 'Escriba el importe total'}
											}
										},
										intNumDetalles_ordenes_compra_maquinaria_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del código postal
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
										strConcepto_detalles_ordenes_compra_maquinaria_maquinaria: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_detalles_ordenes_compra_maquinaria_maquinaria: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeIva_detalles_ordenes_compra_maquinaria_maquinaria: {
											excluded: true  //Ignorar (no valida el campo)
										},
										intPorcentajeIeps_detalles_ordenes_compra_maquinaria_maquinaria: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_ordenes_compra_maquinaria_maquinaria = $('#frmOrdenesCompraMaquinariaMaquinaria').data('bootstrapValidator');
			bootstrapValidator_ordenes_compra_maquinaria_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_ordenes_compra_maquinaria_maquinaria.isValid())
			{
				//Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesOrdenesCompraMaquinariaMaquinaria = $.reemplazar($('#acumTotal_detalles_ordenes_compra_maquinaria_maquinaria').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesOrdenesCompraMaquinariaMaquinaria = $.reemplazar(intAcumTotalDetallesOrdenesCompraMaquinariaMaquinaria, ",", "");

				var intImporteTotalOrdenesCompraMaquinariaMaquinaria = $.reemplazar($('#txtImporteTotal_ordenes_compra_maquinaria_maquinaria').val(), ",", "");
 
				//Verificar que el total de unidades sea igual a la cantidad de detalles
				if($('#acumCantidad_detalles_ordenes_compra_maquinaria_maquinaria').html() != $('#txtTotalUnidades_ordenes_compra_maquinaria_maquinaria').val())
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_ordenes_compra_maquinaria_maquinaria('error', 'El total de unidades no coincide con los detalles, favor de verificar.');
					
				}
				//Verificar que el importe total sea igual al total de detalles
				else if(intAcumTotalDetallesOrdenesCompraMaquinariaMaquinaria != intImporteTotalOrdenesCompraMaquinariaMaquinaria)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_ordenes_compra_maquinaria_maquinaria('error', 'El importe total no coincide con los detalles, favor de verificar.');
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_ordenes_compra_maquinaria_maquinaria();
				}
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_ordenes_compra_maquinaria_maquinaria()
		{
			try
			{
				$('#frmOrdenesCompraMaquinariaMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_ordenes_compra_maquinaria_maquinaria()
		{
			//Obtenemos un array con los datos del archivo
    		var arrArchivoOrdenesCompraMaquinariaMaquinaria = $("#archivo_varios_ordenes_compra_maquinaria_maquinaria");

			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_maquinaria_maquinaria').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrMaquinariaID = [];
			var arrCodigos = [];
			var arrDescripciones = [];
			var arrCantidades = [];
			var arrPreciosUnitarios = [];
			var arrDescuentosUnitarios = [];
			var arrTasaCuotaIva = [];
			var arrIvasUnitarios = [];
			var arrTasaCuotaIeps = [];
			var arrIepsUnitarios = [];
			//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioOrden = parseFloat($('#txtTipoCambio_ordenes_compra_maquinaria_maquinaria').val());

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Obtener códigos y descripciones cortas de cada concepto de maquinaria
				var arr_aux = objRen.cells[0].innerHTML.split(" - ");
				var strCodigo = arr_aux[0];
				var strDescripcion = arr_aux[1];
				//Variables que se utilizan para asignar valores del detalle
				var intCantidad = $.reemplazar(objRen.cells[1].innerHTML, ",", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intPrecioUnitario = $.reemplazar(objRen.cells[2].innerHTML, ",", "");
				var intDescuentoUnitario = $.reemplazar(objRen.cells[3].innerHTML, ",", "");
				var intIvaUnitario = $.reemplazar(objRen.cells[5].innerHTML, ",", "");
				var intIepsUnitario = $.reemplazar(objRen.cells[6].innerHTML, ",", "");
				intIvaUnitario =  intIvaUnitario / intCantidad;
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

				//Asignar valores a los arrays
				arrMaquinariaID.push(objRen.getAttribute('id'));
				arrCodigos.push(strCodigo);
				arrDescripciones.push(strDescripcion);
				arrCantidades.push(intCantidad);
				arrPreciosUnitarios.push(intPrecioUnitario);
				arrDescuentosUnitarios.push(intDescuentoUnitario);
				arrTasaCuotaIva.push(objRen.cells[12].innerHTML);
				arrIvasUnitarios.push(intIvaUnitario);
				arrTasaCuotaIeps.push(objRen.cells[13].innerHTML);
				arrIepsUnitarios.push(intIepsUnitario );
			}


			//Variable que se utiliza para asignar el importe retenido de ISR (proveedor)
			var intRetencionIsrProv =  parseFloat($.reemplazar($('#txtImporteRetenido_ordenes_compra_maquinaria_maquinaria').val(), ",", ""));

			//Si existe retención de ISR (proveedor)
			if(intRetencionIsrProv > 0)
			{
				//Convertir importes a peso mexicano
				intRetencionIsrProv = intRetencionIsrProv * intTipoCambioOrden;
				//Redondear cantidad a decimales
				intRetencionIsrProv = intRetencionIsrProv.toFixed(2);
				intRetencionIsrProv = parseFloat(intRetencionIsrProv);
			}


			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('maquinaria/ordenes_compra_maquinaria/guardar',
					{ 
						//Datos de la orden de compra
						intOrdenCompraMaquinariaID: $('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val(),
						strFolioConsecutivo: $('#txtFolio_ordenes_compra_maquinaria_maquinaria').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_ordenes_compra_maquinaria_maquinaria').val()),
						dteFechaEntrega: $.formatFechaMysql($('#txtFechaEntrega_ordenes_compra_maquinaria_maquinaria').val()),
						dteFechaVencimiento: $.formatFechaMysql($('#txtFechaVencimiento_ordenes_compra_maquinaria_maquinaria').val()),
						strCondicionesPago: $('#cmbCondicionesPago_ordenes_compra_maquinaria_maquinaria').val(),
						intMonedaID: $('#cmbMonedaID_ordenes_compra_maquinaria_maquinaria').val(),
						intTipoCambio: intTipoCambioOrden,
						strFactura: $('#txtFactura_ordenes_compra_maquinaria_maquinaria').val(),
						intProveedorID: $('#txtProveedorID_ordenes_compra_maquinaria_maquinaria').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_ordenes_compra_maquinaria_maquinaria').val(),
						intPorcentajeRetencionID: $('#txtPorcentajeRetencionID_ordenes_compra_maquinaria_maquinaria').val(),
						intImporteRetenido: intRetencionIsrProv,
						intSucursalID: $('#txtSucursalID_ordenes_compra_maquinaria_maquinaria').val(),
						intDepartamentoID: $('#txtDepartamentoID_ordenes_compra_maquinaria_maquinaria').val(),
						strObservaciones: $('#txtObservaciones_ordenes_compra_maquinaria_maquinaria').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_ordenes_compra_maquinaria_maquinaria').val(),
						//Datos de los detalles
						strMaquinariaID: arrMaquinariaID.join('|'),
						strCodigos: arrCodigos.join('|'),
						strDescripciones: arrDescripciones.join('|'),
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
							if($('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val() == '')
							{
							  	//Asignar el id de la orden de compra registrada en la base de datos
                     			$('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val(data.orden_compra_maquinaria_id);
                     			//Asignar folio consecutivo
                 				$('#txtFolio_ordenes_compra_maquinaria_maquinaria').val(data.folio);
                 			}

             				//Si existen archivos seleccionados
             				if(arrArchivoOrdenesCompraMaquinariaMaquinaria != undefined)
             				{
             					//Hacer un llamado a la función para subir el archivo
	                    		subir_archivos_modal_ordenes_compra_maquinaria_maquinaria('Nuevo');
             				}
             				else
             				{
             					//Hacer un llamado a la función para cerrar modal
		                    	cerrar_ordenes_compra_maquinaria_maquinaria();
		                    	//Hacer un llamado a la función para abrir modal de autorización
								abrir_autorizar_ordenes_compra_maquinaria_maquinaria($('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val(), $('#txtFolio_ordenes_compra_maquinaria_maquinaria').val(), 'Guardar');
								//Hacer llamado a la función  para cargar  los registros en el grid
		               			paginacion_ordenes_compra_maquinaria_maquinaria();  
             				}

						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_compra_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
					},
			'json');
			
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_ordenes_compra_maquinaria_maquinaria(tipoMensaje, mensaje)
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
		function cambiar_estatus_ordenes_compra_maquinaria_maquinaria(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val();

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
						              'title':    'Ordenes de Compra Maquinaria',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                             
						                             	//Hacer un llamado a la función para modificar el estatus del registro
													    set_estatus_ordenes_compra_maquinaria_maquinaria(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_ordenes_compra_maquinaria_maquinaria(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_ordenes_compra_maquinaria_maquinaria(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('maquinaria/ordenes_compra_maquinaria/set_estatus',
			      {intOrdenCompraMaquinariaID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_ordenes_compra_maquinaria_maquinaria();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_ordenes_compra_maquinaria_maquinaria();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_ordenes_compra_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ordenes_compra_maquinaria_maquinaria(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/ordenes_compra_maquinaria/get_datos',
			       {intOrdenCompraMaquinariaID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ordenes_compra_maquinaria_maquinaria();
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
				            $('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val(data.row.orden_compra_maquinaria_id);
				            $('#txtFolio_ordenes_compra_maquinaria_maquinaria').val(data.row.folio);
				            $('#txtFecha_ordenes_compra_maquinaria_maquinaria').val(data.row.fecha);
				            $('#txtFechaEntrega_ordenes_compra_maquinaria_maquinaria').val(data.row.fecha_entrega);
				            $('#txtFechaVencimiento_ordenes_compra_maquinaria_maquinaria').val(data.row.fecha_vencimiento);
				            $('#cmbCondicionesPago_ordenes_compra_maquinaria_maquinaria').val(data.row.condiciones_pago);
				            $('#cmbMonedaID_ordenes_compra_maquinaria_maquinaria').val(data.row.moneda_id);
				            $('#txtTipoCambio_ordenes_compra_maquinaria_maquinaria').val(data.row.tipo_cambio);
				            $('#txtFactura_ordenes_compra_maquinaria_maquinaria').val(data.row.factura);
				            $('#txtProveedorID_ordenes_compra_maquinaria_maquinaria').val(data.row.proveedor_id);
						    $('#txtProveedor_ordenes_compra_maquinaria_maquinaria').val(data.row.proveedor);
						    $('#txtRegimenFiscalID_ordenes_compra_maquinaria_maquinaria').val(data.row.regimen_fiscal_id);
						    $('#txtPorcentajeRetencionID_ordenes_compra_maquinaria_maquinaria').val(data.row.porcentaje_retencion_id);
						    $('#txtPorcentajeIsr_ordenes_compra_maquinaria_maquinaria').val(data.row.porcentaje_isr);
						    $('#txtImporteRetenido_ordenes_compra_maquinaria_maquinaria').val(intRetencionIsrProv);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporteRetenido_ordenes_compra_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });

						    $('#txtDiasCredito_ordenes_compra_maquinaria_maquinaria').val(data.row.dias_credito);
						    $('#txtObservaciones_ordenes_compra_maquinaria_maquinaria').val(data.row.observaciones);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_ordenes_compra_maquinaria_maquinaria').addClass("estatus-"+strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_ordenes_compra_maquinaria_maquinaria").show();
				            //Ocultar botón Adjuntar archivo
				            $("#btnAdjuntar_ordenes_compra_maquinaria_maquinaria").hide();

				            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	    				 mostrar_retencion_isr_ordenes_compra_maquinaria_maquinaria();

				            //Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar los siguientes botones
				            	$("#btnDescargarArchivo_ordenes_compra_maquinaria_maquinaria").show();
				            	//Si el estatus del registro es ACTIVO
				            	if(strEstatus == 'ACTIVO')
					            {
					            	$('#btnEliminarArchivo_ordenes_compra_maquinaria_maquinaria').show();
					            }
				           	}
				           	
							//Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmOrdenesCompraMaquinariaMaquinaria').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					            $("#btnGuardar_ordenes_compra_maquinaria_maquinaria").hide();
					             //Deshabilitar botón Agregar
								$('#btnAgregar_detalles_ordenes_compra_maquinaria_maquinaria').prop('disabled', true);
					            //Si el estatus del registro es INACTIVO
				            	if(strEstatus == 'INACTIVO')
				            	{
				            		//Mostrar botón Restaurar
				            		$("#btnRestaurar_ordenes_compra_maquinaria_maquinaria").show();
				            	}
				            	else //Si el estatus del registro es AUTORIZADO
				            	{
				            		//Mostrar botón Enviar correo  
				            		$("#btnEnviarCorreo_ordenes_compra_maquinaria_maquinaria").show();
				            	}

				            }
				            else  //ACTIVO O RECHAZADO
				            {
				            	strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
													 " onclick='editar_renglon_detalles_ordenes_compra_maquinaria_maquinaria(this)'>" + 
													 "<span class='glyphicon glyphicon-edit'></span></button>" + 
													 "<button class='btn btn-default btn-xs' title='Eliminar'" +
													 " onclick='eliminar_renglon_detalles_ordenes_compra_maquinaria_maquinaria(this)'>" + 
													 "<span class='glyphicon glyphicon-trash'></span></button>" + 
													 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
													 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDOrdenesCompraMaquinariaMaquinaria)
							    {
									//Habilitar caja de texto
									$("#txtTipoCambio_ordenes_compra_maquinaria_maquinaria").removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar las siguientes cajas de texto
									$("#txtTipoCambio_ordenes_compra_maquinaria_maquinaria").attr('disabled','disabled');
							    }

				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
					            {
					            	//Mostrar los siguientes botones  
					            	$("#btnDesactivar_ordenes_compra_maquinaria_maquinaria").show();
					            	$("#btnEnviarCorreo_ordenes_compra_maquinaria_maquinaria").show();
					            	$("#btnAutorizar_ordenes_compra_maquinaria_maquinaria").show();
					            	$("#btnAdjuntar_ordenes_compra_maquinaria_maquinaria").show();
					            }

				            }

				            //Variable que se utiliza para asignar el tipo de cambio
				            var intTipoCambio = parseFloat(data.row.tipo_cambio);

				           	//Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_ordenes_compra_maquinaria_maquinaria').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaConcepto = objRenglon.insertCell(0);
								var objCeldaCantidad = objRenglon.insertCell(1);
								var objCeldaPrecioUnitario = objRenglon.insertCell(2);
								var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
								var objCeldaSubtotal = objRenglon.insertCell(4);
								var objCeldaIvaUnitario = objRenglon.insertCell(5);
								var objCeldaIepsUnitario = objRenglon.insertCell(6);
								var objCeldaTotal = objRenglon.insertCell(7);
								var objCeldaAcciones = objRenglon.insertCell(8);
								//Columnas ocultas
								var objCeldaPorcentajeDescuento = objRenglon.insertCell(9);
								var objCeldaPorcentajeIva = objRenglon.insertCell(10);
								var objCeldaPorcentajeIeps = objRenglon.insertCell(11);
							    var objCeldaTasaCuotaIva = objRenglon.insertCell(12);
								var objCeldaTasaCuotaIeps = objRenglon.insertCell(13);

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

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].maquinaria_descripcion_id);
								objCeldaConcepto.setAttribute('class', 'movil b1');
								objCeldaConcepto.innerHTML = data.detalles[intCon].codigo + ' - ' + data.detalles[intCon].descripcion_corta;
								objCeldaCantidad.setAttribute('class', 'movil b2');
								objCeldaCantidad.innerHTML = formatMoney(intCantidad, 2, '');
								objCeldaPrecioUnitario.setAttribute('class', 'movil b3');
								objCeldaPrecioUnitario.innerHTML = formatMoney(intPrecioUnitario, 2, '');
								objCeldaDescuentoUnitario.setAttribute('class', 'movil b4');
								objCeldaDescuentoUnitario.innerHTML = formatMoney(intDescuentoUnitario, 2, '');
								objCeldaSubtotal.setAttribute('class', 'movil b5');
								objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 2, '');
								objCeldaIvaUnitario.setAttribute('class', 'movil b6');
								objCeldaIvaUnitario.innerHTML = formatMoney(intImporteIva, 4, '');
								objCeldaIepsUnitario.setAttribute('class', 'movil b7');
								objCeldaIepsUnitario.innerHTML = formatMoney(intImporteIeps, 4, '');
								objCeldaTotal.setAttribute('class', 'movil b8');
								objCeldaTotal.innerHTML = formatMoney(intTotal, 2, '');
								objCeldaAcciones.setAttribute('class', 'td-center movil b9');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeDescuento.innerHTML = formatMoney(intPorcentajeDescuento, 2, '');
								objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIva.innerHTML =  data.detalles[intCon].porcentaje_iva;
								objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIeps.innerHTML = intPorcentajeIeps;
								objCeldaTasaCuotaIva.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIva.innerHTML = data.detalles[intCon].tasa_cuota_iva;
								objCeldaTasaCuotaIeps.setAttribute('class', 'no-mostrar');
								objCeldaTasaCuotaIeps.innerHTML = data.detalles[intCon].tasa_cuota_ieps;

				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_ordenes_compra_maquinaria_maquinaria();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_ordenes_compra_maquinaria_maquinaria tr").length - 2;
							$('#numElementos_detalles_ordenes_compra_maquinaria_maquinaria').html(intFilas);
							$('#txtNumDetalles_ordenes_compra_maquinaria_maquinaria').val(intFilas);
							
			            	//Abrir modal
				            objOrdenesCompraMaquinariaMaquinaria = $('#OrdenesCompraMaquinariaMaquinariaBox').bPopup({
														  appendTo: '#OrdenesCompraMaquinariaMaquinariaContent', 
							                              contentContainer: 'OrdenesCompraMaquinariaMaquinariaM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#cmbMonedaID_ordenes_compra_maquinaria_maquinaria').focus();
			       	    }
			       },
			       'json');
		}

		//Función para subir los archivos de un registro desde el modal
		function subir_archivos_modal_ordenes_compra_maquinaria_maquinaria(tipoAccion)
		{
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDOrdenesCompraMaquinariaMaquinaria  = "archivo_varios_ordenes_compra_maquinaria_maquinaria";
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDOrdenesCompraMaquinariaMaquinaria);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDOrdenesCompraMaquinariaMaquinaria)[0].files;
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
			    $('#'+strBotonArchivoIDOrdenesCompraMaquinariaMaquinaria).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_ordenes_compra_maquinaria_maquinaria('error', strMensajeError);
	        }
	        else
	        {
	        	//Si existe id del registro subir los archivos
	        	if($('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val() != '')
	        	{
		        	//Crear instancia al objeto del formulario
		        	var formData = new FormData($("#frmOrdenesCompraMaquinariaMaquinaria")[0]);
		        	//Hacer un llamado al método del controlador para subir archivos del registro
		            $.ajax({
		                url: 'maquinaria/ordenes_compra_maquinaria/subir_archivos',
		                type: "POST",
		                data: formData,
		                contentType: false,
		                processData: false,
		                success: function(data)
		                {
		                    //Limpia ruta del archivo cargado
			         		$('#'+strBotonArchivoIDOrdenesCompraMaquinariaMaquinaria).val('');
							//Subida finalizada.
							if (data.resultado)
							{
							   //Mostrar botón Descargar Archivo
		                       $('#btnDescargarArchivo_ordenes_compra_maquinaria_maquinaria').show();
		                       $("#btnEliminarArchivo_ordenes_compra_maquinaria_maquinaria").show();
			         		   //Hacer llamado a la función  para cargar  los registros en el grid
				           	   paginacion_ordenes_compra_maquinaria_maquinaria();  
							}

							//Si la acción corresponde a un nuevo registro
		                    if(tipoAccion == 'Nuevo')
		                    {
		                    	//Si el tipo de mensaje es un éxito
				                if(data.tipo_mensaje == 'éxito')
				                {
					                //Hacer un llamado a la función para cerrar modal
					                cerrar_ordenes_compra_maquinaria_maquinaria();
					                //Hacer un llamado a la función para abrir modal de autorización
									abrir_autorizar_ordenes_compra_maquinaria_maquinaria($('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val(), $('#txtFolio_ordenes_compra_maquinaria_maquinaria').val(), 'Guardar');
				                }
				                else
				                {
				                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    			mensaje_ordenes_compra_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
				                }
		                    }
		                    else
		                    {
		                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    		mensaje_ordenes_compra_maquinaria_maquinaria(data.tipo_mensaje, data.mensaje);
		                    }
		                }
	            	});
	            }
	        }
			
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_ordenes_compra_maquinaria_maquinaria()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_ordenes_compra_maquinaria_maquinaria').val()) !== intMonedaBaseIDOrdenesCompraMaquinariaMaquinaria)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_ordenes_compra_maquinaria_maquinaria").val('');

				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_ordenes_compra_maquinaria_maquinaria').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_ordenes_compra_maquinaria_maquinaria').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_ordenes_compra_maquinaria_maquinaria").val(data.row.tipo_cambio_sat);
	                    }
	                  }
	                 ,
	                'json');
			}
			
		}


		 //Función para asignar los datos de un proveedor
		function get_datos_proveedor_ordenes_compra_maquinaria_maquinaria(ui)
		{
		 	//Asignar valores del registro seleccionado
             $('#txtProveedorID_ordenes_compra_maquinaria_maquinaria').val(ui.item.data);
             $('#txtDiasCredito_ordenes_compra_maquinaria_maquinaria').val(ui.item.dias_credito);
             $('#txtRegimenFiscalID_ordenes_compra_maquinaria_maquinaria').val(ui.item.regimen_fiscal_id);
             //Hacer un llamado a la función para calcular fecha de vencimiento
       	     $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraMaquinariaMaquinaria);

       	     //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt(ui.item.regimen_fiscal_id) == intRegimenFiscalIDResicoOrdenesCompraMaquinariaMaquinaria)
       	     {
       	     	//Hacer un llamado a la función para cargar el porcentaje de retención ISR base
       			cargar_porcentaje_isr_base_ordenes_compra_maquinaria_maquinaria();
       	     }

       	     //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_ordenes_compra_maquinaria_maquinaria();

		}

		//Función para mostrar u ocultar div que contiene el campo de retención de ISR (proveedor)
		function mostrar_retencion_isr_ordenes_compra_maquinaria_maquinaria()
		{
			//Si el gasto tiene retención de ISR
            if(parseInt($('#txtRegimenFiscalID_ordenes_compra_maquinaria_maquinaria').val()) == intRegimenFiscalIDResicoOrdenesCompraMaquinariaMaquinaria)
            {
            	//Quitar clase no-mostrar para mostrar div que contiene la retención de ISR (proveedor)
			  	$('#divRetencionIsr_ordenes_compra_maquinaria_maquinaria').removeClass("no-mostrar");
            }
            else
            {
            	//Agregar clase no-mostrar para ocultar div que contiene la retención de ISR (proveedor)
			    $('#divRetencionIsr_ordenes_compra_maquinaria_maquinaria').addClass("no-mostrar");
            }

		}



		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la descripción de maquinaria
		function inicializar_descripcion_detalles_ordenes_compra_maquinaria_maquinaria()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtMaquinariaDescripcionID_detalles_ordenes_compra_maquinaria_maquinaria').val('');
            $('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').val('');
            $('#txtTasaCuotaIva_detalles_ordenes_compra_maquinaria_maquinaria').val('');
            $('#txtPorcentajeIva_detalles_ordenes_compra_maquinaria_maquinaria').val('');
            $('#txtTasaCuotaIeps_detalles_ordenes_compra_maquinaria_maquinaria').val('');
            $('#txtPorcentajeIeps_detalles_ordenes_compra_maquinaria_maquinaria').val('');
		}



		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_ordenes_compra_maquinaria_maquinaria()
		{
			//Variable que se utiliza para asignar el subtotal (precio unitario en la tabla ordenes_compra_detalles)
			var intSubtotal = 0;
			//Variable que se utiliza para asigna el descuento unitario
			var intDescuentoUnitario = 0;
			//Variable que se utiliza para asignar el importe de iva
			var intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			var intImporteIeps = 0;
			//Variable que se utiliza para asignar el importe total
			var intTotal = 0;

			//Obtenemos los datos de las cajas de texto
			var intMaquinariaDescripcionID = $('#txtMaquinariaDescripcionID_detalles_ordenes_compra_maquinaria_maquinaria').val();
			var strConcepto = $('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').val();
			var intCantidad = $('#txtCantidad_detalles_ordenes_compra_maquinaria_maquinaria').val();
			var intPrecioUnitario = $('#txtPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria').val();
			var intTasaCuotaIva = $('#txtTasaCuotaIva_detalles_ordenes_compra_maquinaria_maquinaria').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_ordenes_compra_maquinaria_maquinaria').val();
			var intTasaCuotaIeps = $('#txtTasaCuotaIeps_detalles_ordenes_compra_maquinaria_maquinaria').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_ordenes_compra_maquinaria_maquinaria').val();


			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_maquinaria_maquinaria').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intMaquinariaDescripcionID == '' || strConcepto == '')
			{
				//Enfocar caja de texto
				$('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			}
			else if (intCantidad == '' || intCantidad <= 0)
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_ordenes_compra_maquinaria_maquinaria').val('');
				$('#txtCantidad_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			}
			else if (intPrecioUnitario == '' || intPrecioUnitario <= 0)
			{
				//Enfocar caja de texto
				$('#txtPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtCantidad_detalles_ordenes_compra_maquinaria_maquinaria').val('');
			    $('#txtPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria').val('');
			    $('#txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria').val('0.00');
			    //Hacer un llamado a la función para inicializar elementos de la descripción de maquinaria
				inicializar_descripcion_detalles_ordenes_compra_maquinaria_maquinaria();


				//Convertir cadena de texto a número decimal
				intPrecioUnitario = parseFloat($.reemplazar(intPrecioUnitario, ",", ""));
				intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
				intSubtotal =  parseFloat($.reemplazar(intPrecioUnitario, ",", ""));

				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;

					//Redondear cantidad a decimales
					intDescuentoUnitario = intDescuentoUnitario.toFixed(2);

					//Decrementar descuento unitario
					intSubtotal = intSubtotal - intDescuentoUnitario;
					//Redondear cantidad a decimales
					intSubtotal = intSubtotal.toFixed(2);
					intSubtotal = parseFloat(intSubtotal);
				}

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



				//Revisamos si existe la descripción proporcionada, si es así, editamos los datos
				if (objTabla.rows.namedItem(intMaquinariaDescripcionID))
				{
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[1].innerHTML = intCantidad;
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[2].innerHTML = intPrecioUnitario;
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[3].innerHTML =  intDescuentoUnitario;
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[4].innerHTML =  intSubtotal;
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[5].innerHTML = intImporteIva;
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[6].innerHTML = intImporteIeps;
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[7].innerHTML = intTotal;
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[9].innerHTML = intPorcentajeDescuento;
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[10].innerHTML = intPorcentajeIva;
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[11].innerHTML = intPorcentajeIeps;
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[12].innerHTML = intTasaCuotaIva;
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[13].innerHTML = intTasaCuotaIeps;
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaConcepto = objRenglon.insertCell(0);
					var objCeldaCantidad = objRenglon.insertCell(1);
					var objCeldaPrecioUnitario = objRenglon.insertCell(2);
					var objCeldaDescuentoUnitario = objRenglon.insertCell(3);
					var objCeldaSubtotal = objRenglon.insertCell(4);
					var objCeldaIvaUnitario = objRenglon.insertCell(5);
					var objCeldaIepsUnitario = objRenglon.insertCell(6);
					var objCeldaTotal = objRenglon.insertCell(7);
					var objCeldaAcciones = objRenglon.insertCell(8);
					//Columnas ocultas
					var objCeldaPorcentajeDescuento = objRenglon.insertCell(9);
					var objCeldaPorcentajeIva = objRenglon.insertCell(10);
					var objCeldaPorcentajeIeps = objRenglon.insertCell(11);
					var objCeldaTasaCuotaIva = objRenglon.insertCell(12);
					var objCeldaTasaCuotaIeps = objRenglon.insertCell(13);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intMaquinariaDescripcionID);
					objCeldaConcepto.setAttribute('class', 'movil b1');
					objCeldaConcepto.innerHTML = strConcepto;
					objCeldaCantidad.setAttribute('class', 'movil b2');
					objCeldaCantidad.innerHTML = intCantidad;
					objCeldaPrecioUnitario.setAttribute('class', 'movil b3');
					objCeldaPrecioUnitario.innerHTML = intPrecioUnitario;
					objCeldaDescuentoUnitario.setAttribute('class', 'movil b4');
					objCeldaDescuentoUnitario.innerHTML = intDescuentoUnitario;
					objCeldaSubtotal.setAttribute('class', 'movil b5');
					objCeldaSubtotal.innerHTML = intSubtotal;
					objCeldaIvaUnitario.setAttribute('class', 'movil b6');
					objCeldaIvaUnitario.innerHTML = intImporteIva;
					objCeldaIepsUnitario.setAttribute('class', 'movil b7');
					objCeldaIepsUnitario.innerHTML = intImporteIeps;
					objCeldaTotal.setAttribute('class', 'movil b8');
					objCeldaTotal.innerHTML = intTotal;
					objCeldaAcciones.setAttribute('class', 'td-center movil b9');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_ordenes_compra_maquinaria_maquinaria(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_ordenes_compra_maquinaria_maquinaria(this)'>" + 
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

				}

				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_ordenes_compra_maquinaria_maquinaria();
				
				//Enfocar caja de texto
				$('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_ordenes_compra_maquinaria_maquinaria tr").length - 2;
			$('#numElementos_detalles_ordenes_compra_maquinaria_maquinaria').html(intFilas);
			$('#txtNumDetalles_ordenes_compra_maquinaria_maquinaria').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_ordenes_compra_maquinaria_maquinaria(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtMaquinariaDescripcionID_detalles_ordenes_compra_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtCantidad_detalles_ordenes_compra_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[9].innerHTML);
			$('#txtPorcentajeIva_detalles_ordenes_compra_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIeps_detalles_ordenes_compra_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtTasaCuotaIva_detalles_ordenes_compra_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtTasaCuotaIeps_detalles_ordenes_compra_maquinaria_maquinaria').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);

			//Enfocar caja de texto
			$('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_ordenes_compra_maquinaria_maquinaria(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_ordenes_compra_maquinaria_maquinaria").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_ordenes_compra_maquinaria_maquinaria();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_ordenes_compra_maquinaria_maquinaria tr").length - 2;
			$('#numElementos_detalles_ordenes_compra_maquinaria_maquinaria').html(intFilas);
			$('#txtNumDetalles_ordenes_compra_maquinaria_maquinaria').val(intFilas);

			//Enfocar caja de texto
			$('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_ordenes_compra_maquinaria_maquinaria()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_maquinaria_maquinaria').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumUnidades = 0;
			var intAcumDescuento = 0;
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumIeps = 0;
			var intAcumTotal = 0;

			//Variable que se utiliza para asignar el acumulado anterior del subtotal (en caso de que existan cambios calcular retención de ISR (proveedor) de lo contrario conservar el importe de retención (puede darse el caso de que el usuario modifique dicho importe))
			var intAcumSubtotalAnterior = $('#acumSubtotal_detalles_ordenes_compra_maquinaria_maquinaria').html();
			//Variable que se utiliza para contar el número de registros
			var intContReg = 0;

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Incrementar acumulados
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));

				//Incrementar contador por cada registro recorridp
				intContReg++;

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
			$('#acumCantidad_detalles_ordenes_compra_maquinaria_maquinaria').html(intAcumUnidades);
			$('#acumDescuento_detalles_ordenes_compra_maquinaria_maquinaria').html(intAcumDescuento);
			$('#acumSubtotal_detalles_ordenes_compra_maquinaria_maquinaria').html(intAcumSubtotal);
			$('#acumIva_detalles_ordenes_compra_maquinaria_maquinaria').html(intAcumIva);
			$('#acumIeps_detalles_ordenes_compra_maquinaria_maquinaria').html(intAcumIeps);
			$('#acumTotal_detalles_ordenes_compra_maquinaria_maquinaria').html(intAcumTotal);


			//Si no existe id de la orden de compra, significa que es un nuevo registro
			if($('#txtOrdenCompraMaquinariaID_ordenes_compra_maquinaria_maquinaria').val() == '' && intContReg == 1)
			{
				//Asignar el contador para calcular el isr del único detalle
				intAcumSubtotalAnterior = intContReg;
			}

			//Si hubo cambios en el acumulado del subtotal
			if(intAcumSubtotalAnterior != intAcumSubtotal && intAcumSubtotalAnterior != '')
			{
				//Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_ordenes_compra_maquinaria_maquinaria();
			}
		}


		//Función que se utiliza para calcular la retención de ISR (proveedor)
		function calcular_isr_ordenes_compra_maquinaria_maquinaria()
		{
			 //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt($('#txtRegimenFiscalID_ordenes_compra_maquinaria_maquinaria').val()) == intRegimenFiscalIDResicoOrdenesCompraMaquinariaMaquinaria)
       	     {
       	     	//Variable que se utiliza para asignar el importe retenido
       	     	var intImporteRetenido = 0;
       	     	//Variable que se utiliza para asignar el acumulado del subtotal
				var intAcumSubtotal = 0;

       	     	//Hacer un llamado a la función para reemplazar '$' y  ','  por cadena vacia
				intAcumSubtotal =  $.reemplazar($('#acumSubtotal_detalles_ordenes_compra_maquinaria_maquinaria').html(), "$", "");
				intAcumSubtotal =  $.reemplazar(intAcumSubtotal, ",", "");

				//Si existe porcentaje de ISR (proveedor)
				if($('#txtPorcentajeIsr_ordenes_compra_maquinaria_maquinaria').val() != '' && intAcumSubtotal > 0 )
				{
					//Variable que se utiliza para asignar el porcentaje de retención ISR
					var intPorcentajeRetencionIsr = parseFloat($('#txtPorcentajeIsr_ordenes_compra_maquinaria_maquinaria').val());

					//Calcular retención de ISR 
					intImporteRetenido = parseFloat(intAcumSubtotal * intPorcentajeRetencionIsr);
					//Redondear cantidad a decimales
					intImporteRetenido = intImporteRetenido.toFixed(2);
					intImporteRetenido = parseFloat(intImporteRetenido);
				}

				//Convertir cantidad a formato moneda
				intImporteRetenido = formatMoney(intImporteRetenido, 2, '');

				//Asignar importe retenido 
				$('#txtImporteRetenido_ordenes_compra_maquinaria_maquinaria').val(intImporteRetenido);

       	     }
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Autorizar Orden de Compra
			*********************************************************************************************************************/
			//Modificar el mensaje cuando cambie la opción del combobox
	        $('#cmbEstatus_autorizar_ordenes_compra_maquinaria_maquinaria').change(function(e){   
	        	//Variables que se utilizan para el mensaje informativo
	        	var strEstatus = $('#cmbEstatus_autorizar_ordenes_compra_maquinaria_maquinaria').val();
	        	var strMensaje = '';
	        	var strFolio = $('#txtFolio_autorizar_ordenes_compra_maquinaria_maquinaria').val();
	        	
	        	//Si existe estatus seleccionado
	        	if(strEstatus != '')
	        	{
	        		strMensaje += 'Se ';
	        		
	        		//Dependiendo del estatus modificar mensaje
	              	if($('#cmbEstatus_autorizar_ordenes_compra_maquinaria_maquinaria').val() === 'AUTORIZADO')
	             	{
	             		strMensaje += 'autorizó ';
	             	}
	             	else
	             	{
	             		strMensaje += 'rechazó ';
	             	}

	             	//Agregar folio en el mensaje
	             	strMensaje += ' la orden de compra maquinaria '+strFolio;
	        	}
	           

             	//Asignar mensaje informativo
             	$('#txtMensaje_autorizar_ordenes_compra_maquinaria_maquinaria').val(strMensaje);
				
	        });


			/*******************************************************************************************************************
			Controles correspondientes al modal Ordenes de Compra
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_ordenes_compra_maquinaria_maquinaria').numeric();
			$('#txtTotalUnidades_ordenes_compra_maquinaria_maquinaria').numeric();
			$('#txtImporteTotal_ordenes_compra_maquinaria_maquinaria').numeric();
			$('#txtCantidad_detalles_ordenes_compra_maquinaria_maquinaria').numeric();
			$('#txtPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria').numeric();
        	$('#txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria').numeric();
        	$('#txtPorcentajeIva_detalles_ordenes_compra_maquinaria_maquinaria').numeric();
        	$('#txtPorcentajeIeps_detalles_ordenes_compra_maquinaria_maquinaria').numeric();
        	$('#txtPorcentajeIsr_ordenes_compra_maquinaria_maquinaria').numeric();
        	$('#txtImporteRetenido_ordenes_compra_maquinaria_maquinaria').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_ordenes_compra_maquinaria_maquinaria').blur(function(){
				$('.moneda_ordenes_compra_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
			});

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_ordenes_compra_maquinaria_maquinaria').blur(function(){
                $('.tipo-cambio_ordenes_compra_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 4 });
            });

            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_ordenes_compra_maquinaria_maquinaria').blur(function(){
                $('.cantidad_ordenes_compra_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
            });

			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_ordenes_compra_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaEntrega_ordenes_compra_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaVencimiento_ordenes_compra_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});

			//Calcular fecha de vencimiento cuando cambie la fecha
			$('#dteFecha_ordenes_compra_maquinaria_maquinaria').on('dp.change', function (e) {
				//Hacer un llamado a la función para calcular fecha de vencimiento
	       	    $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraMaquinariaMaquinaria);
             	//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_ordenes_compra_maquinaria_maquinaria();

			});


			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_ordenes_compra_maquinaria_maquinaria').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_ordenes_compra_maquinaria_maquinaria').val()) === intMonedaBaseIDOrdenesCompraMaquinariaMaquinaria)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_maquinaria_maquinaria").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_ordenes_compra_maquinaria_maquinaria').val(intTipoCambioMonedaBaseOrdenesCompraMaquinariaMaquinaria);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_ordenes_compra_maquinaria_maquinaria').formatCurrency({ roundToDecimalPlace: 4 });
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_maquinaria_maquinaria").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_ordenes_compra_maquinaria_maquinaria').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_ordenes_compra_maquinaria_maquinaria();
             	}
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_ordenes_compra_maquinaria_maquinaria').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_ordenes_compra_maquinaria_maquinaria').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoOrdenesCompraMaquinariaMaquinaria)
	        	{
	        		$('#txtTipoCambio_ordenes_compra_maquinaria_maquinaria').val(intTipoCambioMaximoOrdenesCompraMaquinariaMaquinaria);
	        	}

		    });

		    //Calcular fecha de vencimiento cuando cambie la opción del combobox
	        $('#cmbCondicionesPago_ordenes_compra_maquinaria_maquinaria').change(function(e){   
	            //Hacer un llamado a la función para calcular fecha de vencimiento
	       	    $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraMaquinariaMaquinaria);
	        });


			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedor_ordenes_compra_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorID_ordenes_compra_maquinaria_maquinaria').val('');
	                //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_ordenes_compra_maquinaria_maquinaria();
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
	       	     get_datos_proveedor_ordenes_compra_maquinaria_maquinaria(ui);

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
	        $('#txtProveedor_ordenes_compra_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_ordenes_compra_maquinaria_maquinaria').val() == '' ||
	               $('#txtProveedor_ordenes_compra_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorID_ordenes_compra_maquinaria_maquinaria').val('');
	               $('#txtProveedor_ordenes_compra_maquinaria_maquinaria').val('');
	                //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_ordenes_compra_maquinaria_maquinaria();
	            }

	        });  


	         //Autocomplete para recuperar los datos de un porcentaje de retención ISR 
	        $('#txtPorcentajeIsr_ordenes_compra_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtPorcentajeRetencionID_ordenes_compra_maquinaria_maquinaria').val('');
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
	             $('#txtPorcentajeRetencionID_ordenes_compra_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtPorcentajeIsr_ordenes_compra_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtPorcentajeRetencionID_ordenes_compra_maquinaria_maquinaria').val() == '' ||
	               $('#txtPorcentajeIsr_ordenes_compra_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtPorcentajeRetencionID_ordenes_compra_maquinaria_maquinaria').val('');
	               $('#txtPorcentajeIsr_ordenes_compra_maquinaria_maquinaria').val('');
	            }

	           //Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_ordenes_compra_maquinaria_maquinaria();
	            
	        });

	        //Autocomplete para recuperar los datos de una descripción de maquinaria 
	        $('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMaquinariaDescripcionID_detalles_ordenes_compra_maquinaria_maquinaria').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "maquinaria/maquinaria_descripciones/autocomplete",
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
	             $('#txtMaquinariaDescripcionID_detalles_ordenes_compra_maquinaria_maquinaria').val(ui.item.data);
	             $('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').val(ui.item.descripcion);
	             //Impuestos asignados previamente a la Maquinaria
	             $('#txtTasaCuotaIva_detalles_ordenes_compra_maquinaria_maquinaria').val(ui.item.tasa_cuota_id);
	             $('#txtPorcentajeIva_detalles_ordenes_compra_maquinaria_maquinaria').val(ui.item.porcentaje_iva);
	             $('#txtTasaCuotaIeps_detalles_ordenes_compra_maquinaria_maquinaria').val(ui.item.tasa_cuota_ieps);
	             $('#txtPorcentajeIeps_detalles_ordenes_compra_maquinaria_maquinaria').val(ui.item.porcentaje_ieps);

	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	         //Verificar que exista id de la maquinaria cuando pierda el enfoque la caja de texto
	        $('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id de la descripción de maquinaria
	            if($('#txtMaquinariaDescripcionID_detalles_ordenes_compra_maquinaria_maquinaria').val() == '' ||
	               $('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').val() == '')
	            { 
	            	//Hacer un llamado a la función para inicializar elementos de la descripción de maquinaria
	               inicializar_descripcion_detalles_ordenes_compra_maquinaria_maquinaria();
	            }
	            
	        });

	        //Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_ordenes_compra_maquinaria_maquinaria').on('click','button.btn',function(){
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

			

	        //Validar que exista concepto cuando se pulse la tecla enter 
			$('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe concepto
		            if($('#txtMaquinariaDescripcionID_detalles_ordenes_compra_maquinaria_maquinaria').val() == '' || $('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtConcepto_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_ordenes_compra_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		            //Si no existe cantidad
		            if($('#txtCantidad_detalles_ordenes_compra_maquinaria_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtCantidad_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			   	    }
		        }
		    });

			//Validar que exista precio unitario cuando se pulse la tecla enter 
			$('#txtPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio unitario
		            if($('#txtPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPrecioUnitario_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	   	   //Enfocar caja de texto
					   $('#txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			   	    }
		        }
		    });

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe procentaje del descuento
		            if($('#txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_ordenes_compra_maquinaria_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	   		//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_detalles_ordenes_compra_maquinaria_maquinaria();
			   	    }
		        }
		    });

			

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_ordenes_compra_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_ordenes_compra_maquinaria_maquinaria').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_ordenes_compra_maquinaria_maquinaria').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_ordenes_compra_maquinaria_maquinaria').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_ordenes_compra_maquinaria_maquinaria').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_ordenes_compra_maquinaria_maquinaria').data('DateTimePicker').maxDate(e.date);
			});

            //Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedorBusq_ordenes_compra_maquinaria_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorIDBusq_ordenes_compra_maquinaria_maquinaria').val('');
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
	             $('#txtProveedorIDBusq_ordenes_compra_maquinaria_maquinaria').val(ui.item.data);
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
	        $('#txtProveedorBusq_ordenes_compra_maquinaria_maquinaria').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorIDBusq_ordenes_compra_maquinaria_maquinaria').val() == '' ||
	               $('#txtProveedorBusq_ordenes_compra_maquinaria_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorIDBusq_ordenes_compra_maquinaria_maquinaria').val('');
	               $('#txtProveedorBusq_ordenes_compra_maquinaria_maquinaria').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_ordenes_compra_maquinaria_maquinaria').on('click','a',function(event){
				event.preventDefault();
				intPaginaOrdenesCompraMaquinariaMaquinaria = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_ordenes_compra_maquinaria_maquinaria();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_ordenes_compra_maquinaria_maquinaria').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_ordenes_compra_maquinaria_maquinaria();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_ordenes_compra_maquinaria_maquinaria').addClass("estatus-NUEVO");
				//Abrir modal
				 objOrdenesCompraMaquinariaMaquinaria = $('#OrdenesCompraMaquinariaMaquinariaBox').bPopup({
												   appendTo: '#OrdenesCompraMaquinariaMaquinariaContent', 
					                               contentContainer: 'OrdenesCompraMaquinariaMaquinariaM', 
					                               zIndex: 2, 
					                               modalClose: false, 
					                               modal: true, 
					                               follow: [true,false], 
					                               followEasing : "linear", 
					                               easing: "linear", 
					                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_ordenes_compra_maquinaria_maquinaria').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_ordenes_compra_maquinaria_maquinaria').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_ordenes_compra_maquinaria_maquinaria();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_ordenes_compra_maquinaria_maquinaria();
		});
	</script>