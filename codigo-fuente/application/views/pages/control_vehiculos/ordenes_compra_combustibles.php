	<div id="OrdenesCompraCombustiblesControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_ordenes_compra_combustibles_control_vehiculos" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_ordenes_compra_combustibles_control_vehiculos" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos'>
				                    <input class="form-control" id="txtFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos"
				                    		name= "strFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos" 
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
								<label for="txtFechaFinalBusq_ordenes_compra_combustibles_control_vehiculos">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_ordenes_compra_combustibles_control_vehiculos'>
				                    <input class="form-control" id="txtFechaFinalBusq_ordenes_compra_combustibles_control_vehiculos"
				                    		name= "strFechaFinalBusq_ordenes_compra_combustibles_control_vehiculos" 
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
								<input id="txtProveedorIDBusq_ordenes_compra_combustibles_control_vehiculos" 
									   name="intProveedorIDBusq_ordenes_compra_combustibles_control_vehiculos"  type="hidden" 
									   value="">
								</input>
								<label for="txtProveedorBusq_ordenes_compra_combustibles_control_vehiculos">Proveedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtProveedorBusq_ordenes_compra_combustibles_control_vehiculos" 
										name="strProveedorBusq_ordenes_compra_combustibles_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Estatus-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbEstatusBusq_ordenes_compra_combustibles_control_vehiculos">Estatus</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbEstatusBusq_ordenes_compra_combustibles_control_vehiculos" 
								 		name="strEstatusBusq_ordenes_compra_combustibles_control_vehiculos" tabindex="1">
								    <option value="TODOS">TODOS</option>
	                  				<option value="ACTIVO">ACTIVO</option>
	                  				<option value="AUTORIZADO">AUTORIZADO</option>
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
								<label for="txtBusqueda_ordenes_compra_combustibles_control_vehiculos">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_ordenes_compra_combustibles_control_vehiculos" 
										name="strBusqueda_ordenes_compra_combustibles_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 btn-toolBtns">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_ordenes_compra_combustibles_control_vehiculos" 
									   name="strImprimirDetalles_ordenes_compra_combustibles_control_vehiculos" type="checkbox"
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
							<button class="btn btn-primary" id="btnBuscar_ordenes_compra_combustibles_control_vehiculos"
									onclick="paginacion_ordenes_compra_combustibles_control_vehiculos();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_ordenes_compra_combustibles_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_ordenes_compra_combustibles_control_vehiculos"
									onclick="reporte_ordenes_compra_combustibles_control_vehiculos('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_ordenes_compra_combustibles_control_vehiculos"
									onclick="reporte_ordenes_compra_combustibles_control_vehiculos('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla vales de gasolina a relacionar
				*/
				td.movil.b1:nth-of-type(1):before {content: "Vale Gasolina ID"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "T.C."; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Moneda ID"; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Folio"; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Fecha"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "Factura"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "Vehículo"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "Empleado"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b10:nth-of-type(10):before {content: "IVA"; font-weight: bold;}
				td.movil.b11:nth-of-type(11):before {content: "Total"; font-weight: bold;}
				td.movil.b12:nth-of-type(12):before {content: "Seleccionar"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla vales de gasolina a relacionar
				*/
				td.movil.bt1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.bt2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.bt3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.bt4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.bt5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.bt6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.bt7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.bt8:nth-of-type(8):before {content: "Total"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles
				*/
				td.movil.c1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.c2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.c3:nth-of-type(3):before {content: "Factura"; font-weight: bold;}
				td.movil.c4:nth-of-type(4):before {content: "Vehículo"; font-weight: bold;}
				td.movil.c5:nth-of-type(5):before {content: "Empleado"; font-weight: bold;}
				td.movil.c6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.c7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.c8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.c9:nth-of-type(9):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles
				*/
				td.movil.ct1:nth-of-type(1):before {content: ""; font-weight: bold;}
				td.movil.ct2:nth-of-type(2):before {content: ""; font-weight: bold;}
				td.movil.ct3:nth-of-type(3):before {content: ""; font-weight: bold;}
				td.movil.ct4:nth-of-type(4):before {content: ""; font-weight: bold;}
				td.movil.ct5:nth-of-type(5):before {content: ""; font-weight: bold;}
				td.movil.ct6:nth-of-type(6):before {content: "Subtotal"; font-weight: bold;}
				td.movil.ct7:nth-of-type(7):before {content: "IVA"; font-weight: bold;}
				td.movil.ct8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_ordenes_compra_combustibles_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Proveedor</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:18em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_ordenes_compra_combustibles_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{proveedor}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_ordenes_compra_combustibles_control_vehiculos({{orden_compra_combustible_id}},'Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_ordenes_compra_combustibles_control_vehiculos({{orden_compra_combustible_id}},'Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
                            	<!---Autorizar o rechazar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionAutorizar}}"  
										onclick="abrir_autorizar_ordenes_compra_combustibles_control_vehiculos({{orden_compra_combustible_id}},'{{folio}}', 'Autorizar');"  title="Autorizar o Rechazar">
									<span class="fa fa-check-square-o"></span>
								</button>
                            	<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_ordenes_compra_combustibles_control_vehiculos({{orden_compra_combustible_id}})"  title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								 <!--Subir varios archivos-->
								<span  class="fileupload-buttonbar  {{mostrarAccionAdjuntar}}">
									<span class="btn  btn-default btn-xs fileinput-button ">
								    	<span class="fa fa-upload"></span>
										<input name="archivo_varios_ordenes_compra_combustibles_control_vehiculos{{orden_compra_combustible_id}}[]" id="archivo_varios_ordenes_compra_combustibles_control_vehiculos{{orden_compra_combustible_id}}"  type="file" multiple accept="text/xml,application/pdf" 
											   onchange="subir_archivos_grid_ordenes_compra_combustibles_control_vehiculos({{orden_compra_combustible_id}});">
								  		</input>
								    </span>
								</span>
                            	<!--Descargar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerArchivoRegistro}}" 
                            			 onmousedown="descargar_archivos_ordenes_compra_combustibles_control_vehiculos({{orden_compra_combustible_id}}, '{{folio}}');" title="Descargar archivo">
                            		<span class="glyphicon glyphicon-download-alt"></span>
                            	</button>
                            	<!--Eliminar archivo-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionEliminarArchivoRegistro}}" 
                            			 onmousedown="eliminar_archivos_ordenes_compra_combustibles_control_vehiculos({{orden_compra_combustible_id}});" title="Eliminar archivo">
                            		<span class="glyphicon glyphicon-export"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_ordenes_compra_combustibles_control_vehiculos({{orden_compra_combustible_id}})" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="6"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_ordenes_compra_combustibles_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_ordenes_compra_combustibles_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Autorizar Orden de Compra-->
		<div id="AutorizarOrdenesCompraCombustiblesControlVehiculosBox" class="ModalBody  impresion-formato-modal-empleados">
			<!--Título-->
			<div id="divEncabezadoModal_autorizar_ordenes_compra_combustibles_control_vehiculos" class="ModalBodyTitle confirmacion-modal-title"">
			<h1 id="tituloModal_autorizar_ordenes_compra_combustibles_control_vehiculos"></h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmAutorizarOrdenesCompraCombustiblesControlVehiculos" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmAutorizarOrdenesCompraCombustiblesControlVehiculos"  onsubmit="return(false)" autocomplete="off">
			    	<!--TreeView-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtReferenciaID_autorizar_ordenes_compra_combustibles_control_vehiculos" 
										   name="intReferenciaID_autorizar_ordenes_compra_combustibles_control_vehiculos" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el tipo de acción (guardar o autorizar) a realizar --> 
									<input type="hidden" id="txtTipoAccion_autorizar_ordenes_compra_combustibles_control_vehiculos" 
										   name="strTipoAccion_autorizar_ordenes_compra_combustibles_control_vehiculos" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para asignar el folio del registro seleccionado--> 
									<input type="hidden" id="txtFolio_autorizar_ordenes_compra_combustibles_control_vehiculos" 
										   name="strFolio_autorizar_ordenes_compra_combustibles_control_vehiculos" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para saber si el id del registro se recupera del modal Ordenes de Compra-->
									<input id="txtModalOrdenesCompra_autorizar_ordenes_compra_combustibles_control_vehiculos" 
										   name="strModalOrdenesCompra_autorizar_ordenes_compra_combustibles_control_vehiculos" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta para asignar a los usuarios que se les enviará 
									     el mensaje--> 
									<input type="hidden" id="txtUsuarios_autorizar_ordenes_compra_combustibles_control_vehiculos" 
										   name="strUsuarios_autorizar_ordenes_compra_combustibles_control_vehiculos" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Enviar notificación a:</h4>
										</div>
										<div class="panel-body">
											<div id="treeUsuarios_autorizar_ordenes_compra_combustibles_control_vehiculos" class="md-list-item-text"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="divEstatus_autorizar_ordenes_compra_combustibles_control_vehiculos" class="row no-mostrar">
						<!--Estatus-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbEstatus_autorizar_ordenes_compra_combustibles_control_vehiculos">Estatus</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbEstatus_autorizar_ordenes_compra_combustibles_control_vehiculos" 
									 		name="strEstatus_autorizar_ordenes_compra_combustibles_control_vehiculos" tabindex="1">
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
									<label for="txtMensaje_autorizar_ordenes_compra_combustibles_control_vehiculos">Mensaje</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtMensaje_autorizar_ordenes_compra_combustibles_control_vehiculos" 
											   name="strMensaje_autorizar_ordenes_compra_combustibles_control_vehiculos" rows="5" value="" tabindex="1" placeholder="Ingrese mensaje" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Autorizar o rechazar registro-->
							<button class="btn btn-success" id="btnGuardar_autorizar_ordenes_compra_combustibles_control_vehiculos"  
									onclick="validar_autorizar_ordenes_compra_combustibles_control_vehiculos();"  title="Enviar" tabindex="1">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_autorizar_ordenes_compra_combustibles_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_autorizar_ordenes_compra_combustibles_control_vehiculos();" 
									title="Cerrar"  tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Autorizar Orden de Compra-->

		<!-- Diseño del modal  Vales de Gasolina-->
		<div id="RelacionarValesOrdenesCompraCombustiblesControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_relacionar_vales_ordenes_compra_combustibles_control_vehiculos" class="ModalBodyTitle">
			<h1>Vales de Gasolina</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRelacionarValesOrdenesCompraCombustiblesControlVehiculos" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmRelacionarValesOrdenesCompraCombustiblesControlVehiculos"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Proveedor-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
									<input id="txtProveedorIDBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos" 
										   name="intProveedorIDBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos"  type="hidden" 
										   value="">
									</input>
									<label for="txtProveedorBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtProveedorBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos" 
										   name="strProveedorBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos"  type="text" value="">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Fecha inicial-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFechaInicialBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos">Fecha inicial</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaInicialBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos'>
					                    <input class="form-control" id="txtFechaInicialBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos"
					                    		name= "strFechaInicialBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos" 
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
									<label for="txtFechaFinalBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos">Fecha final</label>
								</div>
								<div class="col-md-12">
									<div class='input-group date' id='dteFechaFinalBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos'>
					                    <input class="form-control" id="txtFechaFinalBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos"
					                    		name= "strFechaFinalBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Descripción-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcionBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos">Descripción</label>
								</div>
								<div class="col-md-12">
									<div class="input-group">
										<input class="form-control" id="txtDescripcionBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos" 
											   name="strDescripcionBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos"  type="text" value="" 
											   tabindex="1" placeholder="Ingrese descripción" maxlength="250" >
										</input>
										<span class="input-group-btn">
											<button class="btn btn-primary" id="btnBuscar_relacionar_vales_ordenes_compra_combustibles_control_vehiculos"
													onclick="lista_vales_ordenes_compra_combustibles_control_vehiculos();" title="Buscar coincidencias" tabindex="1">
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
						<!--Div que contiene la tabla con los vales de gasolina encontrados-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<!-- Caja de texto oculta para asignar el número de registros de la tabla vales de gasolina--> 
							<input id="txtNumValesGasolina_relacionar_vales_ordenes_compra_combustibles_control_vehiculos" 
								   name="intNumValesGasolina_relacionar_vales_ordenes_compra_combustibles_control_vehiculos" type="hidden" value="">
							</input>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_relacionar_vales_ordenes_compra_combustibles_control_vehiculos">
								<thead class="movil">
									<tr class="movil">
										<th class="movil">Folio</th>
										<th class="movil">Fecha</th>
										<th class="movil">Factura</th>
										<th class="movil">Vehículo</th>
										<th class="movil">Empleado</th>
										<th class="movil">Subtotal</th>
										<th class="movil">IVA</th>
										<th class="movil">Total</th>
										<th class="movil" id="th-acciones" style="width:8em;">Seleccionar</th>
									</tr>
								</thead>
								<tbody class="movil"></tbody>
								<script id="plantilla_relacionar_vales_ordenes_compra_combustibles_control_vehiculos" type="text/template"> 
								{{#rows}}
									<tr class="movil">  
										<td class="movil-no-mostrar no-mostrar b1">{{vale_gasolina_id}}</td>
										<td class="movil-no-mostrar no-mostrar b2">{{tipo_cambio}}</td>
										<td class="movil-no-mostrar no-mostrar b3">{{moneda_id}}</td>
										<td class="movil b4">{{folio}}</td>
										<td class="movil b5">{{fecha}}</td>
										<td class="movil b6">{{factura}}</td>
										<td class="movil b7">{{vehiculo}}</td>
										<td class="movil b8">{{empleado}}</td>
										<td class="movil b9">{{subtotal}}</td>
										<td class="movil b10">{{iva}}</td>
										<td class="movil b11">{{total}}</td>
										<td class="td-center movil b12"> 
											 <input 	type="checkbox" 
							    		class="form-check-input btn-xs" 
							    		id="chbAgregar_relacionar_vales_ordenes_compra_combustibles_control_vehiculos" />
										</td>
									</tr>
									{{/rows}}
									{{^rows}}
									<tr class="movil"> 
										<td class="movil" colspan="8"> No se encontraron resultados.</td>
									</tr> 
									{{/rows}}
								</script>
								<tfoot class="movil">
									<tr class="movil">
										<td class="movil bt1">
											<strong>Total</strong>
										</td>
										<td class="movil bt2"></td>
										<td class="movil bt3"></td>
										<td class="movil bt4"></td>
										<td class="movil bt5"></td>
										<td class="movil bt6">
											<strong id="acumSubtotal_relacionar_vales_ordenes_compra_combustibles_control_vehiculos"></strong>
										</td>
										<td class="movil bt7">
											<strong id="acumIva_relacionar_vales_ordenes_compra_combustibles_control_vehiculos"></strong>
										</td>
										<td class="movil bt8">
											<strong id="acumTotal_relacionar_vales_ordenes_compra_combustibles_control_vehiculos"></strong>
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
										<strong id="numElementos_relacionar_vales_ordenes_compra_combustibles_control_vehiculos">0</strong> encontrados
									</button>
								</div>
							</div>
						</div>
					</div>			  
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Agregar vales-->
							<button class="btn btn-success" id="btnAgregar_relacionar_vales_ordenes_compra_combustibles_control_vehiculos"  
									onclick="validar_relacionar_vales_ordenes_compra_combustibles_control_vehiculos();"  title="Agregar" tabindex="1">
								<span class="glyphicon glyphicon-plus"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_relacionar_vales_ordenes_compra_combustibles_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_relacionar_vales_ordenes_compra_combustibles_control_vehiculos();" 
									title="Cerrar" tabindex="1">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Vales de Gasolina-->

		<!-- Diseño del modal Ordenes de Compra-->
		<div id="OrdenesCompraCombustiblesControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_ordenes_compra_combustibles_control_vehiculos"  class="ModalBodyTitle">
			<h1>Ordenes de Compra</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmOrdenesCompraCombustiblesControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmOrdenesCompraCombustiblesControlVehiculos"  onsubmit="return(false)" autocomplete="off">


					  <div class="row">
						<!--Folio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos" 
										   name="intOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el estatus del registro seleccionado-->
									<input id="txtEstatus_ordenes_compra_combustibles_control_vehiculos" 
										   name="strEstatus_ordenes_compra_combustibles_control_vehiculos" type="hidden" value="">
									</input>
									<label for="txtFolio_ordenes_compra_combustibles_control_vehiculos">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_ordenes_compra_combustibles_control_vehiculos" 
											name="strFolio_ordenes_compra_combustibles_control_vehiculos" type="text" 
											value="" placeholder="Autogenerado" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_ordenes_compra_combustibles_control_vehiculos">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_ordenes_compra_combustibles_control_vehiculos'>
					                    <input class="form-control" id="txtFecha_ordenes_compra_combustibles_control_vehiculos"
					                    		name= "strFecha_ordenes_compra_combustibles_control_vehiculos" 
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
									<label for="cmbMonedaID_ordenes_compra_combustibles_control_vehiculos">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_ordenes_compra_combustibles_control_vehiculos" 
									 		name="intMonedaID_ordenes_compra_combustibles_control_vehiculos" tabindex="1">
                     				</select>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_ordenes_compra_combustibles_control_vehiculos">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_ordenes_compra_combustibles_control_vehiculos" id="txtTipoCambio_ordenes_compra_combustibles_control_vehiculos" 
											name="intTipoCambio_ordenes_compra_combustibles_control_vehiculos" type="text" value="" 
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
									<input id="txtProveedorID_ordenes_compra_combustibles_control_vehiculos" 
										   name="intProveedorID_ordenes_compra_combustibles_control_vehiculos"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del régimen fiscal-->
									<input id="txtRegimenFiscalID_ordenes_compra_combustibles_control_vehiculos" 
										   name="intRegimenFiscalID_ordenes_compra_combustibles_control_vehiculos"  type="hidden" 
										   value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar los días de crédito del proveedor seleccionado-->
									<input id="txtDiasCredito_ordenes_compra_combustibles_control_vehiculos" 
										   name="intDiasCredito_ordenes_compra_combustibles_control_vehiculos"  type="hidden" 
										   value="">
									</input>
									<label for="txtProveedor_ordenes_compra_combustibles_control_vehiculos">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_ordenes_compra_combustibles_control_vehiculos" 
											name="strProveedor_ordenes_compra_combustibles_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    	<!--Condiciones de pago-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbCondicionesPago_ordenes_compra_combustibles_control_vehiculos">Condiciones de pago</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbCondicionesPago_ordenes_compra_combustibles_control_vehiculos" 
									 		name="strCondicionesPago_ordenes_compra_combustibles_control_vehiculos" tabindex="1">
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
									<label for="txtFechaVencimiento_ordenes_compra_combustibles_control_vehiculos">Fecha de vencimiento</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaVencimiento_ordenes_compra_combustibles_control_vehiculos'>
					                    <input class="form-control" id="txtFechaVencimiento_ordenes_compra_combustibles_control_vehiculos"
					                    		name= "strFechaVencimiento_ordenes_compra_combustibles_control_vehiculos" 
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
						<!--Factura-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFactura_ordenes_compra_combustibles_control_vehiculos">Factura</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFactura_ordenes_compra_combustibles_control_vehiculos" 
											name="strFactura_ordenes_compra_combustibles_control_vehiculos" type="text" value="" 
											tabindex="1" placeholder="Ingrese factura" maxlength="10">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los empleados activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
									<input id="txtSolicitaID_ordenes_compra_combustibles_control_vehiculos" 
										   name="intSolicitaID_ordenes_compra_combustibles_control_vehiculos"  type="hidden" 
										   value="">
									</input>
									<label for="txtSolicita_ordenes_compra_combustibles_control_vehiculos">Solicita</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSolicita_ordenes_compra_combustibles_control_vehiculos" 
											name="strSolicita_ordenes_compra_combustibles_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese quien lo solicita" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Total-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtImporteTotal_ordenes_compra_combustibles_control_vehiculos">Importe total</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<span class="input-group-addon">$</span>
										<input  class="form-control moneda_ordenes_compra_combustibles_control_vehiculos" id="txtImporteTotal_ordenes_compra_combustibles_control_vehiculos" 
												name="intImporteTotal_ordenes_compra_combustibles_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese importe" maxlength="23">
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
									<label for="txtObservaciones_ordenes_compra_combustibles_control_vehiculos">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtObservaciones_ordenes_compra_combustibles_control_vehiculos" 
											name="strObservaciones_ordenes_compra_combustibles_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!--Div input-group no-mostrar que se utiliza para evitar que el mensaje de validación se muestre en el input-group -->
									<div class='input-group no-mostrar' >
										<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
										<input id="txtNumDetalles_ordenes_compra_combustibles_control_vehiculos" 
											   name="intNumDetalles_ordenes_compra_combustibles_control_vehiculos" type="hidden" value="">
										</input>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Detalles de la orden de compra</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Buscar vales de gasolina para agregarlos en la tabla-->
				                                	<button class="btn btn-primary pull-right" 
				                                			id="btnBuscarValesGasolina_ordenes_compra_combustibles_control_vehiculos"
				                                			onclick="abrir_relacionar_vales_ordenes_compra_combustibles_control_vehiculos();" 
				                                	     	title="Buscar vales de gasolina" tabindex="1"> 
				                                		<span class="glyphicon glyphicon-search"></span> 
				                                		Relacionar vales de gasolina
				                                	</button>
												</div>
												<br>
											</div>
											<!--Div que contiene la tabla con los detalles encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row ">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_ordenes_compra_combustibles_control_vehiculos">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Folio</th>
																<th class="movil">Fecha</th>
																<th class="movil">Factura</th>
																<th class="movil">Vehículo</th>
															    <th class="movil">Empleado</th>
															    <th class="movil">Subtotal</th>
															    <th class="movil">IVA</th>
																<th class="movil">Total</th>
																<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
														<tfoot class="movil">
															<tr class="movil">
																<td class="movil ct1">
																	<strong>Total</strong>
																</td>
																<td class="movil ct2"></td>
																<td class="movil ct3"></td>
																<td class="movil ct4"></td>
																<td class="movil ct5"></td>
																<td class="movil ct6">
																	<strong id="acumSubtotal_detalles_ordenes_compra_combustibles_control_vehiculos"></strong>
																</td>
																<td class="movil ct7">
																	<strong id="acumIva_detalles_ordenes_compra_combustibles_control_vehiculos"></strong>
																</td>
																<td  class="movil ct8">
																	<strong id="acumTotal_detalles_ordenes_compra_combustibles_control_vehiculos"></strong>
																	<strong id="monedaOrden_ordenes_compra_combustibles_control_vehiculos"></strong>
																	
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
																<strong id="numElementos_detalles_ordenes_compra_combustibles_control_vehiculos">0</strong> encontrados
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
							<div id="divRetencionIsr_ordenes_compra_combustibles_control_vehiculos"  class="col-sm-6 col-md-6 col-lg-6 col-xs-12 pull-right no-mostrar">
									<div class="form-group">
											<!--Porcentaje de ISR-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<input id="txtPorcentajeRetencionID_ordenes_compra_combustibles_control_vehiculos" name="intPorcentajeRetencionID_ordenes_compra_combustibles_control_vehiculos" type="hidden" value="">
														</input>
														<label for="txtPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos">Retención de ISR %</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control" id="txtPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos" 
																name="intPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos" type="text" value="" 
																tabindex="1" placeholder="Ingrese retención de ISR" maxlength="250">
														</input>
													</div>
												</div>
											</div>
											<!--Importe retenido-->
											<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
												<div class="form-group">
													<div class="col-md-12">
														<label for="txtImporteRetenido_ordenes_compra_combustibles_control_vehiculos">Importe de ISR</label>
													</div>
													<div class="col-md-12">
														<input  class="form-control moneda_ordenes_compra_combustibles_control_vehiculos" id="txtImporteRetenido_ordenes_compra_combustibles_control_vehiculos" 
																name="intImporteRetenido_ordenes_compra_combustibles_control_vehiculos" type="text" value="" 
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
							<button class="btn btn-success" id="btnGuardar_ordenes_compra_combustibles_control_vehiculos"  
									onclick="validar_ordenes_compra_combustibles_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!---Autorizar o rechazar registro-->
							<button class="btn btn-default" id="btnAutorizar_ordenes_compra_combustibles_control_vehiculos"  
									onclick="abrir_autorizar_ordenes_compra_combustibles_control_vehiculos('','','Autorizar');"  title="Autorizar o Rechazar" tabindex="3" disabled>
								<span class="fa fa-check-square-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default" id="btnImprimirRegistro_ordenes_compra_combustibles_control_vehiculos"  
									onclick="reporte_registro_ordenes_compra_combustibles_control_vehiculos('');"  title="Imprimir registro en PDF" tabindex="4" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Subir varios archivos-->
		                    <span  class="fileupload-buttonbar" tabindex="5">
		                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_ordenes_compra_combustibles_control_vehiculos" disabled>
		                        	<span class="fa fa-upload"></span>
		                        	<input id="archivo_varios_ordenes_compra_combustibles_control_vehiculos" 
		                        		   name="archivo_varios_ordenes_compra_combustibles_control_vehiculos[]" type="file" multiple 
		                        		   accept="text/xml,application/pdf" onchange="subir_archivos_modal_ordenes_compra_combustibles_control_vehiculos('Editar');">
		                        	</input>
		                        </span>
		                    </span>
		                    <!--Descargar archivo-->
		                    <button class="btn btn-default" id="btnDescargarArchivo_ordenes_compra_combustibles_control_vehiculos"  
									onclick="descargar_archivos_ordenes_compra_combustibles_control_vehiculos('','');"  title="Descargar archivo" tabindex="6" disabled>
								<span class="glyphicon glyphicon-download-alt"></span>
							</button>
							<!--Eliminar archivo-->
							<button class="btn btn-default" id="btnEliminarArchivo_ordenes_compra_combustibles_control_vehiculos"  
									onclick="eliminar_archivos_ordenes_compra_combustibles_control_vehiculos('')"  title="Eliminar archivo" tabindex="7" disabled>
								<span class="glyphicon glyphicon-export"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_ordenes_compra_combustibles_control_vehiculos"  
									onclick="cambiar_estatus_ordenes_compra_combustibles_control_vehiculos('');"  title="Desactivar" tabindex="8" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_ordenes_compra_combustibles_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_ordenes_compra_combustibles_control_vehiculos();" 
									title="Cerrar"  tabindex="9">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Ordenes de Compra-->
	</div><!--#OrdenesCompraCombustiblesControlVehiculosContent -->

	<!-- /.Plantilla para cargar las monedas en el combobox-->  
	<script id="monedas_ordenes_compra_combustibles_control_vehiculos" type="text/template">
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
		var intPaginaOrdenesCompraCombustiblesControlVehiculos = 0;
		var strUltimaBusquedaOrdenesCompraCombustiblesControlVehiculos = "";
		//Variable que se utiliza para asignar el id de la moneda base
		var intMonedaBaseIDOrdenesCompraCombustiblesControlVehiculos = <?php echo MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor del tipo de cambio de la moneda base
		var intTipoCambioMonedaBaseOrdenesCompraCombustiblesControlVehiculos = <?php echo TIPO_CAMBIO_MONEDA_BASE ?>;
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoOrdenesCompraCombustiblesControlVehiculos = <?php echo TIPO_CAMBIO_MAXIMO ?>;

		//Variable que se utiliza para asignar el id del porcentaje de retención ISR base
		var intPorcentajeRetencionBaseIDOrdenesCompraCombustiblesControlVehiculos = <?php echo PORCENTAJE_ISR_BASE ?>;

		//Variable que se utiliza para asignar el id del régimen fiscal: Régimen Simplificado de Confianza
		var intRegimenFiscalIDResicoOrdenesCompraCombustiblesControlVehiculos = <?php echo REGIMEN_FISCAL_RESICO ?>;

		 //Variable que se utiliza para asignar el código de la moneda seleccionada (del pago)
		var strMonedaOrdenesCompraCombustiblesControlVehiculos = "";
		//Variable que se utiliza para asignar objeto del modal Autorizar Orden de Compra
		var objAutorizarOrdenesCompraCombustiblesControlVehiculos = null;
		//Variable que se utiliza para asignar objeto del modal Vales de Gasolina
		var objRelacionarValesOrdenesCompraCombustiblesControlVehiculos = null;
		//Variable que se utiliza para asignar objeto del modal Ordenes de Compra
		var objOrdenesCompraCombustiblesControlVehiculos = null;

		//Array que contiene los id´s de las cajas de texto que se utilizan para calcular la fecha de vencimiento
		var arrFechaVencimientoOrdenesCompraCombustiblesControlVehiculos  = {fecha: '#txtFecha_ordenes_compra_combustibles_control_vehiculos',
															 condicionesPago: '#cmbCondicionesPago_ordenes_compra_combustibles_control_vehiculos',
															 diasCredito: '#txtDiasCredito_ordenes_compra_combustibles_control_vehiculos',
															 fechaVencimiento: '#txtFechaVencimiento_ordenes_compra_combustibles_control_vehiculos'
															};


		/*******************************************************************************************************************
		Funciones del objeto vales de gasolina relacionados (seleccionados)
		*********************************************************************************************************************/
		// Constructor del objeto Vales de gasolina relacionados
		var objValesRelacionadosOrdenesCompraCombustiblesControlVehiculos;
		function ValesRelacionadosOrdenesCompraCombustiblesControlVehiculos(vales)
		{
			this.arrVales = vales;
		}

		//Función para obtener todos los vales de gasolina seleccionados
		ValesRelacionadosOrdenesCompraCombustiblesControlVehiculos.prototype.getVales = function() {
		    return this.arrVales;
		}

		//Función para agregar un vale de gasolina al objeto 
		ValesRelacionadosOrdenesCompraCombustiblesControlVehiculos.prototype.setVale = function (ingreso){
			this.arrVales.push(ingreso);
		}

		//Función para obtener un vale de gasolina del objeto 
		ValesRelacionadosOrdenesCompraCombustiblesControlVehiculos.prototype.getVale = function(index) {
		    return this.arrVales[index];
		}


		/*******************************************************************************************************************
		Funciones del objeto Vales de gasolina a relacionar
		*********************************************************************************************************************/
		// Constructor del objeto Vales de gasolina a relacionar
		var objValeRelacionarOrdenesCompraCombustiblesControlVehiculos;
		
		function ValeRelacionarOrdenesCompraCombustiblesControlVehiculos(valeGasolinaID, tipoCambio, 
																		folio, fecha, factura, vehiculo, 
																		empleado, monedaID, 
																		subtotal, iva, total)
		{
		    this.intValeGasolinaID = valeGasolinaID;
		    this.strFolio = folio;
		    this.dteFecha = fecha;
		    this.strFactura = factura;
		    this.strVehiculo = vehiculo;
		    this.strEmpleado = empleado;
		    this.intMonedaID = monedaID;
		    this.intTipoCambio = tipoCambio;
		    this.intSubtotal = subtotal;
		    this.intIva = iva;
		    this.intTotal = total;
		}


		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_ordenes_compra_combustibles_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/ordenes_compra_combustibles/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_ordenes_compra_combustibles_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosOrdenesCompraCombustiblesControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosOrdenesCompraCombustiblesControlVehiculos = strPermisosOrdenesCompraCombustiblesControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosOrdenesCompraCombustiblesControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosOrdenesCompraCombustiblesControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosOrdenesCompraCombustiblesControlVehiculos[i]=='GUARDAR') || (arrPermisosOrdenesCompraCombustiblesControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es ADJUNTAR
						else if(arrPermisosOrdenesCompraCombustiblesControlVehiculos[i]=='ADJUNTAR')
						{
							//Habilitar el control (botón Adjuntar)
							$('#btnAdjuntar_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
							//Habilitar el control (botón eliminar archivo)
							$('#btnEliminarArchivo_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es VER REGISTRO
						else if(arrPermisosOrdenesCompraCombustiblesControlVehiculos[i]=='VER REGISTRO')
						{
							//Habilitar el control (botón descargar archivo)
							$('#btnDescargarArchivo_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraCombustiblesControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_ordenes_compra_combustibles_control_vehiculos();
						}
						else if(arrPermisosOrdenesCompraCombustiblesControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraCombustiblesControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraCombustiblesControlVehiculos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraCombustiblesControlVehiculos[i]=='AUTORIZAR')//Si el indice es AUTORIZAR
						{
							//Habilitar el control (botón autorizar)
							$('#btnAutorizar_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosOrdenesCompraCombustiblesControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_ordenes_compra_combustibles_control_vehiculos() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaOrdenesCompraCombustiblesControlVehiculos = ($('#txtFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos').val()+$('#txtFechaFinalBusq_ordenes_compra_combustibles_control_vehiculos').val()+$('#txtProveedorIDBusq_ordenes_compra_combustibles_control_vehiculos').val()+$('#cmbEstatusBusq_ordenes_compra_combustibles_control_vehiculos').val()+$('#txtBusqueda_ordenes_compra_combustibles_control_vehiculos').val());
   			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaOrdenesCompraCombustiblesControlVehiculos != strUltimaBusquedaOrdenesCompraCombustiblesControlVehiculos)
			{
				intPaginaOrdenesCompraCombustiblesControlVehiculos = 0;
				strUltimaBusquedaOrdenesCompraCombustiblesControlVehiculos = strNuevaBusquedaOrdenesCompraCombustiblesControlVehiculos;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/ordenes_compra_combustibles/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos').val()),
						dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_compra_combustibles_control_vehiculos').val()),
						intProveedorID: $('#txtProveedorIDBusq_ordenes_compra_combustibles_control_vehiculos').val(),
						strEstatus: $('#cmbEstatusBusq_ordenes_compra_combustibles_control_vehiculos').val(),
						strBusqueda: $('#txtBusqueda_ordenes_compra_combustibles_control_vehiculos').val(),
						intPagina:intPaginaOrdenesCompraCombustiblesControlVehiculos,
						strPermisosAcceso: $('#txtAcciones_ordenes_compra_combustibles_control_vehiculos').val()
					},
					function(data){
						$('#dg_ordenes_compra_combustibles_control_vehiculos tbody').empty();
						var tmpOrdenesCompraCombustiblesControlVehiculos = Mustache.render($('#plantilla_ordenes_compra_combustibles_control_vehiculos').html(),data);
						$('#dg_ordenes_compra_combustibles_control_vehiculos tbody').html(tmpOrdenesCompraCombustiblesControlVehiculos);
						$('#pagLinks_ordenes_compra_combustibles_control_vehiculos').html(data.paginacion);
						$('#numElementos_ordenes_compra_combustibles_control_vehiculos').html(data.total_rows);
						intPaginaOrdenesCompraCombustiblesControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_ordenes_compra_combustibles_control_vehiculos(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'control_vehiculos/ordenes_compra_combustibles/';

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
			if ($('#chbImprimirDetalles_ordenes_compra_combustibles_control_vehiculos').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_ordenes_compra_combustibles_control_vehiculos').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_ordenes_compra_combustibles_control_vehiculos').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_ordenes_compra_combustibles_control_vehiculos').val()),
										'intProveedorID': $('#txtProveedorIDBusq_ordenes_compra_combustibles_control_vehiculos').val(),
										'strEstatus': $('#cmbEstatusBusq_ordenes_compra_combustibles_control_vehiculos').val(), 
										'strBusqueda': $('#txtBusqueda_ordenes_compra_combustibles_control_vehiculos').val(),
										'strDetalles': $('#chbImprimirDetalles_ordenes_compra_combustibles_control_vehiculos').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_ordenes_compra_combustibles_control_vehiculos(id) 
		{
			
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val();
			}
			else
			{
				intID = id;
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': 'control_vehiculos/ordenes_compra_combustibles/get_reporte_registro',
							'data' : {
										'intOrdenCompraCombustibleID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);
		}

		
		//Función para subir archivos de un registro desde el grid view
		function subir_archivos_grid_ordenes_compra_combustibles_control_vehiculos(ordenCompraID)
		{
			//Crear instancia al objeto del formulario
	        var formData = new FormData($("#frmOrdenesCompraCombustiblesControlVehiculos")[0]);
			//Agregar campos al objeto del formulario
			formData.append("intOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos", ordenCompraID);
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDGridOrdenesCompraCombustiblesControlVehiculos  = "archivo_varios_ordenes_compra_combustibles_control_vehiculos"+ordenCompraID;
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDGridOrdenesCompraCombustiblesControlVehiculos);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDGridOrdenesCompraCombustiblesControlVehiculos)[0].files;
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
					formData.append("archivo_varios_ordenes_compra_combustibles_control_vehiculos[]", document.getElementById(strBotonArchivoIDGridOrdenesCompraCombustiblesControlVehiculos).files[intCont]);
				 	
				}
	        }

	        //Si existe mensaje de error
	        if(strMensajeError != '')
	        {
	        	//Limpia ruta del archivo cargado
		        $('#'+strBotonArchivoIDGridOrdenesCompraCombustiblesControlVehiculos).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_ordenes_compra_combustibles_control_vehiculos('error', strMensajeError);
	        }
	        else
	        {
	        	//Hacer un llamado al método del controlador para subir archivos del registro
	            $.ajax({
	                url: 'control_vehiculos/ordenes_compra_combustibles/subir_archivos',
	                type: "POST",
	                data: formData,
	                contentType: false,
	                processData: false,
	                success: function(data)
	                {
	                    //Limpia ruta del archivo cargado
		         		$('#'+strBotonArchivoIDGridOrdenesCompraCombustiblesControlVehiculos).val('');
						//Subida finalizada.
						if (data.resultado)
						{
		         		   //Hacer llamado a la función  para cargar  los registros en el grid
			           	   paginacion_ordenes_compra_combustibles_control_vehiculos();  
						}
                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			    		mensaje_ordenes_compra_combustibles_control_vehiculos(data.tipo_mensaje, data.mensaje);
	                }
            	});

	        }

		}

		//Función que se utiliza para descargar los archivos del registro seleccionado
		function descargar_archivos_ordenes_compra_combustibles_control_vehiculos(ordenCompraID, folio)
		{
			//Variables que se utilizan para asignar los valores del registro
			var intOrdenCompraCombustibleID = 0;
			var strFolio = '';
			//Si no existe id, significa que se descargara el archivo desde el modal
			if(ordenCompraID == '')
			{
				intOrdenCompraCombustibleID = $('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val();
				strFolio = $('#txtFolio_ordenes_compra_combustibles_control_vehiculos').val();
			}
			else
			{
				intOrdenCompraCombustibleID = ordenCompraID;
				strFolio = folio;
			}

			//Abrir pestaña para realizar descarga de los documentos
			window.open("control_vehiculos/ordenes_compra_combustibles/descargar_archivos/"+"/"+intOrdenCompraCombustibleID+"/"+strFolio);
		}

		//Función que se utiliza para eliminar los archivos del registro seleccionado
		function eliminar_archivos_ordenes_compra_combustibles_control_vehiculos(id)
		{

			//Variables que se utilizan para asignar los valores del registro
			var intID = 0;

			//Si no existe id, significa que se eliminara el archivo desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val();

			}
			else
			{
				intID = id;
			}

			//Hacer un llamado al método del controlador para eliminar carpeta que contiene los archivos del registro
			$.post('control_vehiculos/ordenes_compra_combustibles/eliminar_carpeta_registro',
			     {intOrdenCompraCombustibleID: intID
			     },
			     function(data) {
			       
			        if(data.resultado)
			        {
			         	//Hacer llamado a la función  para cargar  los registros en el grid
		          	    paginacion_ordenes_compra_combustibles_control_vehiculos();
		          	    //Si el id del registro se obtuvo del modal
						if(id == '')
						{
							//Ocultar los siguientes botones
							$('#btnDescargarArchivo_ordenes_compra_combustibles_control_vehiculos').hide();
							$('#btnEliminarArchivo_ordenes_compra_combustibles_control_vehiculos').hide();    
						}
			        }
		        	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
		       		mensaje_ordenes_compra_combustibles_control_vehiculos(data.tipo_mensaje, data.mensaje);
			       
			     },
			    'json');
		}

		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_ordenes_compra_combustibles_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar las monedas que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').empty();
					var temp = Mustache.render($('#monedas_ordenes_compra_combustibles_control_vehiculos').html(), data);
					$('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').html(temp);
				},
				'json');
		}

		//Regresar el porcentaje de retención ISR base
		function cargar_porcentaje_isr_base_ordenes_compra_combustibles_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('contabilidad/porcentaje_retencion_isr/get_datos',
			       {
			       		strBusqueda:intPorcentajeRetencionBaseIDOrdenesCompraCombustiblesControlVehiculos,
			       		strTipo: 'id'
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
				          	//Recuperar valores
				            $('#txtPorcentajeRetencionID_ordenes_compra_combustibles_control_vehiculos').val(data.row.porcentaje_retencion_id);
				            $('#txtPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos').val(data.row.porcentaje);
			       	    }
			       },
			       'json');
		}


		/*******************************************************************************************************************
		Funciones del modal Autorizar Orden de Compra
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_autorizar_ordenes_compra_combustibles_control_vehiculos()
		{
			//Incializar formulario
			$('#frmAutorizarOrdenesCompraCombustiblesControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_ordenes_compra_combustibles_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmAutorizarOrdenesCompraCombustiblesControlVehiculos').find('input[type=hidden]').val('');
			//Agregar clase no-mostrar para ocultar div que contiene el estatus
			$('#divEstatus_autorizar_ordenes_compra_combustibles_control_vehiculos').addClass("no-mostrar");
		    $('#divEncabezadoModal_autorizar_ordenes_compra_combustibles_control_vehiculos').addClass("estatus-ACTIVO");
		}

		//Función que se utiliza para abrir el modal
		function abrir_autorizar_ordenes_compra_combustibles_control_vehiculos(id, folio, tipoAccion)
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_autorizar_ordenes_compra_combustibles_control_vehiculos();
			
			//Variables que se utilizan para asignar los datos del registro
			var intReferenciaID = 0;
			var strFolio = '';

			//Si no existe id, significa que se aplicará autorización (o rechazo) desde el modal
			if(id == '')
			{
				intReferenciaID = $('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val();
				strFolio =  $('#txtFolio_ordenes_compra_combustibles_control_vehiculos').val();
				$('#txtModalOrdenesCompra_autorizar_ordenes_compra_combustibles_control_vehiculos').val('SI');
			}
			else
			{
				intReferenciaID = id;
				strFolio = folio;
				$('#txtModalOrdenesCompra_autorizar_ordenes_compra_combustibles_control_vehiculos').val('NO');
			}

			//Asignar datos del registro seleccionado
			$('#txtReferenciaID_autorizar_ordenes_compra_combustibles_control_vehiculos').val(intReferenciaID);
			$('#txtTipoAccion_autorizar_ordenes_compra_combustibles_control_vehiculos').val(tipoAccion);
			$('#txtFolio_autorizar_ordenes_compra_combustibles_control_vehiculos').val(strFolio);

			//Si el tipo de acción corresponde a Guardar
			if(tipoAccion == 'Guardar')
			{
				//Cambiar título del modal
				$('#tituloModal_autorizar_ordenes_compra_combustibles_control_vehiculos').text('Notificar Orden de Compra');
				$('#txtMensaje_autorizar_ordenes_compra_combustibles_control_vehiculos').val('Favor de autorizar la orden de compra combustibles '+ strFolio);
				//Cargar el treeview
				get_treeview_usuarios_autorizar_ordenes_compra_combustibles_control_vehiculos('');
			}
			else
			{
				//Quitar clase no-mostrar para mostrar div que contiene el estatus
				$('#divEstatus_autorizar_ordenes_compra_combustibles_control_vehiculos').removeClass("no-mostrar");
				//Cambiar título del modal
				$('#tituloModal_autorizar_ordenes_compra_combustibles_control_vehiculos').text('Autorizar Orden de Compra');
				//Cargar el treeview
				get_treeview_usuarios_autorizar_ordenes_compra_combustibles_control_vehiculos(intReferenciaID);
			}

			//Abrir modal
			objAutorizarOrdenesCompraCombustiblesControlVehiculos = $('#AutorizarOrdenesCompraCombustiblesControlVehiculosBox').bPopup({
													   appendTo: '#OrdenesCompraCombustiblesControlVehiculosContent', 
							                           contentContainer: 'OrdenesCompraCombustiblesControlVehiculosM', 
							                           zIndex: 2, 
							                           modalClose: false, 
							                           modal: true, 
							                           follow: [true,false], 
							                           followEasing : "linear", 
							                           easing: "linear", 
							                           modalColor: ('#F0F0F0')});
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_autorizar_ordenes_compra_combustibles_control_vehiculos()
		{
			try {
				//Cerrar modal
				objAutorizarOrdenesCompraCombustiblesControlVehiculos.close();
				//Eliminar datos del treeview
				$("#treeUsuarios_autorizar_ordenes_compra_combustibles_control_vehiculos").fancytree("destroy");
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_autorizar_ordenes_compra_combustibles_control_vehiculos()
		{
			//Inicializar arreglo con los nodos seleccionados
			var arrSeleccionadosAutorizarOrdenesCompraCombustiblesControlVehiculos = [];

			//Recorremos el treeview
			$("#treeUsuarios_autorizar_ordenes_compra_combustibles_control_vehiculos").fancytree("getTree").visit(function(node){
				//Si el nodo está seleccionado o parcialmente seleccionado y es un nodo que se tiene que agregar
				if ((node.partsel || node.selected) && (node.data.agregar))
					arrSeleccionadosAutorizarOrdenesCompraCombustiblesControlVehiculos.push(node.key);
			});
			//Asignar los valores seleccionados a la caja de texto unidos por el carácter |
			$("#txtUsuarios_autorizar_ordenes_compra_combustibles_control_vehiculos").val(arrSeleccionadosAutorizarOrdenesCompraCombustiblesControlVehiculos.join('|'));
			
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_autorizar_ordenes_compra_combustibles_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmAutorizarOrdenesCompraCombustiblesControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strMensaje_autorizar_ordenes_compra_combustibles_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba un mensaje'}
											}
										},
										strUsuarios_autorizar_ordenes_compra_combustibles_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione al menos un usuario para este mensaje.'}
											}
										}, 
										strEstatus_autorizar_ordenes_compra_combustibles_control_vehiculos: {
											validators: {
												callback: {
					                            	callback: function(value, validator, $field) {
					                                    //Verificar que exista estatus seleccionado cuando el tipo de acción sea Autorizar
					                                    if($('#txtTipoAccion_autorizar_ordenes_compra_combustibles_control_vehiculos').val() === 'Autorizar' && $('#cmbEstatus_autorizar_ordenes_compra_combustibles_control_vehiculos').val() == '')
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
			var bootstrapValidator_autorizar_ordenes_compra_combustibles_control_vehiculos = $('#frmAutorizarOrdenesCompraCombustiblesControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_autorizar_ordenes_compra_combustibles_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_autorizar_ordenes_compra_combustibles_control_vehiculos.isValid())
			{
				//Hacer un llamado a la función para guardar la solicitud de autorización
				guardar_autorizar_ordenes_compra_combustibles_control_vehiculos();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_autorizar_ordenes_compra_combustibles_control_vehiculos()
		{
			try
			{
				$('#frmAutorizarOrdenesCompraCombustiblesControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para enviar la autorización (o el rechazo) de un registro
		function guardar_autorizar_ordenes_compra_combustibles_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para enviar la autorización (o el rechazo) de un registro 
			$.post('control_vehiculos/ordenes_compra_combustibles/set_enviar_autorizacion',
			     {intOrdenCompraCombustibleID: $('#txtReferenciaID_autorizar_ordenes_compra_combustibles_control_vehiculos').val(),
			      strUsuarios: $('#txtUsuarios_autorizar_ordenes_compra_combustibles_control_vehiculos').val(), 
			      strMensaje:  $('#txtMensaje_autorizar_ordenes_compra_combustibles_control_vehiculos').val(),
			      strEstatus:  $('#cmbEstatus_autorizar_ordenes_compra_combustibles_control_vehiculos').val(),
			      strTipoAccion:  $('#txtTipoAccion_autorizar_ordenes_compra_combustibles_control_vehiculos').val()
			     },
			     function(data) {
			        if(data.resultado)
			        {
			          	//Hacer llamado a la función  para cargar  los registros en el grid
			          	paginacion_ordenes_compra_combustibles_control_vehiculos();
			          	//Hacer un llamado a la función para cerrar modal
					  	cerrar_autorizar_ordenes_compra_combustibles_control_vehiculos();

					  	//Si el id de la referencia (para la autorización) se recuperó del modal Ordenes de Compra 
					  	if($('#txtModalOrdenesCompra_autorizar_ordenes_compra_combustibles_control_vehiculos').val() == 'SI')
					  	{
					  		//Hacer un llamado a la función para cerrar modal Ordenes de Compra 
					 	 	cerrar_ordenes_compra_combustibles_control_vehiculos();
					  	}   
			        }
			        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_ordenes_compra_combustibles_control_vehiculos(data.tipo_mensaje, data.mensaje);
			     },
			    'json');
		}

		/*Función que se utiliza para definir tree view de usuarios con acceso a la función Autorizar del proceso
		 *Ordenes de Compra (módulo Control de Vehículos)*/
		function get_treeview_usuarios_autorizar_ordenes_compra_combustibles_control_vehiculos(id)
		{
			$('#treeUsuarios_autorizar_ordenes_compra_combustibles_control_vehiculos').fancytree({
				source: {
					url: "seguridad/usuarios/get_treeview/AUTORIZAR_ORDENES_COMPRA_CONTROL_VEHICULOS/ORDENES DE COMPRA COMBUSTIBLES/"+id,
					cache: false
				},
				checkbox: true,
				selectMode: 3
			});
		}

	
		/*******************************************************************************************************************
		Funciones del modal Vales de Gasolina
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_relacionar_vales_ordenes_compra_combustibles_control_vehiculos()
		{
			//Incializar formulario
			$('#frmRelacionarValesOrdenesCompraCombustiblesControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_vales_ordenes_compra_combustibles_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmRelacionarValesOrdenesCompraCombustiblesControlVehiculos').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').removeClass("estatus-ACTIVO");
			//Eliminar los datos de la tabla vales de gasolina
		    $('#dg_relacionar_vales_ordenes_compra_combustibles_control_vehiculos tbody').empty();
		    $('#numElementos_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').html(0);
		    $('#acumSubtotal_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').html('$0.00');
		    $('#acumIva_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').html('$0.00');
		    $('#acumTotal_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').html('$0.00');
		    //Deshabilitar la siguiente caja de texto
			$('#txtProveedorBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').attr("disabled", "disabled");
		}

		//Función que se utiliza para abrir el modal
		function abrir_relacionar_vales_ordenes_compra_combustibles_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los campos del formulario
			nuevo_relacionar_vales_ordenes_compra_combustibles_control_vehiculos();
			//Variable que se utiliza para asignar el estatus del registro
			var strEstatus =  $('#txtEstatus_ordenes_compra_combustibles_control_vehiculos').val();
			var strProveedor =  $('#txtProveedor_ordenes_compra_combustibles_control_vehiculos').val();
			var intProveedorID =  $('#txtProveedorID_ordenes_compra_combustibles_control_vehiculos').val();
			
			//Si no existe estatus, significa que es un nuevo registro
			if(strEstatus == '')
			{
				strEstatus = 'NUEVO';
			}

			//Dependiendo del estatus cambiar el color del encabezado 
		    $('#divEncabezadoModal_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').addClass("estatus-"+strEstatus);
		    //Asignar los datos del proveedor
		    $('#txtProveedorIDBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').val(intProveedorID);
		    $('#txtProveedorBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').val(strProveedor);

			//Abrir modal
			objRelacionarValesOrdenesCompraCombustiblesControlVehiculos = $('#RelacionarValesOrdenesCompraCombustiblesControlVehiculosBox').bPopup({
											  appendTo: '#OrdenesCompraCombustiblesControlVehiculosContent', 
			                              	  contentContainer: 'OrdenesCompraCombustiblesControlVehiculosM', 
			                              	  zIndex: 2, 
			                              	  modalClose: false, 
			                              	  modal: true, 
			                              	  follow: [true,false], 
			                              	  followEasing : "linear", 
			                              	  easing: "linear", 
			                             	  modalColor: ('#F0F0F0')});

			//Hacer un llamado a la función  para cargar los vales de gasolina en el grid
			lista_vales_ordenes_compra_combustibles_control_vehiculos();

		}

		//Función que se utiliza para cerrar el modal
		function cerrar_relacionar_vales_ordenes_compra_combustibles_control_vehiculos()
		{
			try {
				//Cerrar modal
				objRelacionarValesOrdenesCompraCombustiblesControlVehiculos.close();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_relacionar_vales_ordenes_compra_combustibles_control_vehiculos()
		{

			//Hacer un llamado a la función para agregar las facturas (ingreso) seleccionadas al  objeto ingreso's  relacionados
			agregar_vales_relacionar_vales_ordenes_compra_combustibles_control_vehiculos();

			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_relacionar_vales_ordenes_compra_combustibles_control_vehiculos();

			//Validación del formulario de campos obligatorios
			$('#frmRelacionarValesOrdenesCompraCombustiblesControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										intNumValesGasolina_relacionar_vales_ordenes_compra_combustibles_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Seleccionar al menos un vale de gasolina para esta orden de compra.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strFechaInicialBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strFechaFinalBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										},
										strDescripcionBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_relacionar_vales_ordenes_compra_combustibles_control_vehiculos = $('#frmRelacionarValesOrdenesCompraCombustiblesControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_relacionar_vales_ordenes_compra_combustibles_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_relacionar_vales_ordenes_compra_combustibles_control_vehiculos.isValid())
			{
				//Hacer un llamado a la función para cerrar el modal
				cerrar_relacionar_vales_ordenes_compra_combustibles_control_vehiculos();
				//Hacer un llamado a la función para agregar los vales en la tabla detalles
		  		agregar_vales_relacionados_ordenes_compra_combustibles_control_vehiculos();
			}
			else 
				return;
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_relacionar_vales_ordenes_compra_combustibles_control_vehiculos()
		{
			try
			{
				$('#frmRelacionarValesOrdenesCompraCombustiblesControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		/*******************************************************************************************************************
		Funciones de la tabla relacionar vales de gasolina
		*********************************************************************************************************************/
		//Función para la búsqueda de vales de gasolina 
		function lista_vales_ordenes_compra_combustibles_control_vehiculos() 
		{
			
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/ordenes_compra_combustibles/get_vales_gasolina',
					{	
						intProveedorID: $('#txtProveedorIDBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').val(), 
						intMonedaIDOrden: $('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').val(),
						intTipoCambioOrden: $('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').val(),
						 //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial:  $.formatFechaMysql($('#txtFechaInicialBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').val()),
						dteFechaFinal:  $.formatFechaMysql($('#txtFechaFinalBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').val()),
						strBusqueda: $('#txtDescripcionBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').val()

					},
					function(data){
						$('#dg_relacionar_vales_ordenes_compra_combustibles_control_vehiculos tbody').empty();
						var tmpRelacionarValesOrdenesCompraCombustiblesControlVehiculos = Mustache.render($('#plantilla_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').html(),data);
						$('#numElementos_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').html(0);
						if(data.rows)
						{
							$('#numElementos_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').html(data.rows.length);	
						}
						$('#acumSubtotal_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').html(data.acumulado_subtotal);
						$('#acumIva_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').html(data.acumulado_iva);
						$('#acumTotal_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').html(data.acumulado_total+' '+strMonedaOrdenesCompraCombustiblesControlVehiculos);
						$('#dg_relacionar_vales_ordenes_compra_combustibles_control_vehiculos tbody').html(tmpRelacionarValesOrdenesCompraCombustiblesControlVehiculos);
						
					},
			'json');

			
		}

		//Función para agregar las facturas (ingreso) seleccionadas al objeto vales  relacionados
		function agregar_vales_relacionar_vales_ordenes_compra_combustibles_control_vehiculos()
		{
		    //Variable que se utiliza para asignar el texto del td
		    var strValor = "";
		    //Variable que se utiliza para asignar el indice de la columna
		    var intCol = 0;
		    //Variable que se utiliza para contar el número de registros seleccionados (marcados)
		    var intContador = 0;
             
            //Crear instancia del objeto Vales de gasolina relacionados (seleccionados)
			objValesRelacionadosOrdenesCompraCombustiblesControlVehiculos = new ValesRelacionadosOrdenesCompraCombustiblesControlVehiculos([]);

		    //Hacer recorrido en la tabla para verificar que el checkbox seleccionados
		   	$('#dg_relacionar_vales_ordenes_compra_combustibles_control_vehiculos tr:has(td)').find('input[type="checkbox"]').each(function() {
               	//Si el checkbox se encuentra marcado (seleccionado)
                if ($(this).prop("checked") == true)
                {
                	//Inicializar variables
                	intCol = 0;
                	
                	//Crear instancia del objeto Vales de gasolina a relacionar
					objValeRelacionarOrdenesCompraCombustiblesControlVehiculos = new ValeRelacionarOrdenesCompraCombustiblesControlVehiculos(null, '', '', '', 
																				'', '', '', '', 
																				'', '', '');
														 
                	//Buscamos el td más cercano en el DOM hacia "arriba"
    				//luego encontramos los td adyacentes a este
                	$(this).closest('td').siblings().each(function(){

					      	//Obtenemos el texto del td 
					        strValor = $(this).text();

					        switch (intCol) {
							    case 0:
							        objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.intValeGasolinaID = strValor;
							        break;
							    case 1:
							        objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.intTipoCambio = strValor;
							        break;
							    case 2:
							        objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.intMonedaID = strValor;
							        break;
							    case 3:
							        objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.strFolio = strValor;
							        break;
							    case 4:
							        objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.dteFecha = strValor;
							        break;
							    case 5:
							        objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.strFactura = strValor;
							        break;
							    case 6:
							        objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.strVehiculo = strValor;
							        break;
							    case 7:
							        objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.strEmpleado = strValor;
							        break;
							    case 8:
							       		objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.intSubtotal = strValor;
							       	break;
							    case 9:
							       		objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.intIva = strValor;
							       	break;
							    case 10:
							       		objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.intTotal = strValor;
							       	break;
							}

					      	intCol++;
					    });

                	//Agregar datos del ingreso a relacionar
                	objValesRelacionadosOrdenesCompraCombustiblesControlVehiculos.setVale(objValeRelacionarOrdenesCompraCombustiblesControlVehiculos);
                	
                	//Incrementar el contador por cada registro
                	intContador++;
                }
            });

            //Asignar el número de registros seleccionados
            $('#txtNumValesGasolina_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').val(intContador);

		}

		/*******************************************************************************************************************
		Funciones del modal Ordenes de Compra
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_ordenes_compra_combustibles_control_vehiculos()
		{
			//Incializar formulario
			$('#frmOrdenesCompraCombustiblesControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_compra_combustibles_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmOrdenesCompraCombustiblesControlVehiculos').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_ordenes_compra_combustibles_control_vehiculos').val(fechaActual());
			$('#txtFechaVencimiento_ordenes_compra_combustibles_control_vehiculos').val(fechaActual()); 
			//Hacer un llamado a la función para inicializar elementos de la tabla detalles
		 	inicializar_detalles_ordenes_compra_combustibles_control_vehiculos();

			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_ordenes_compra_combustibles_control_vehiculos');

			//Asignar NO para indicar que no se ha abierto el modal Autorizar Orden de Compra
			$('#txtModalOrdenesCompra_autorizar_ordenes_compra_combustibles_control_vehiculos').val('NO');
			//Habilitar todos los elementos del formulario
			$('#frmOrdenesCompraCombustiblesControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$('#txtFolio_ordenes_compra_combustibles_control_vehiculos').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_ordenes_compra_combustibles_control_vehiculos").show();
			$("#btnAdjuntar_ordenes_compra_combustibles_control_vehiculos").show();
			$("#btnBuscarValesGasolina_ordenes_compra_combustibles_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnAutorizar_ordenes_compra_combustibles_control_vehiculos").hide();
			$("#btnImprimirRegistro_ordenes_compra_combustibles_control_vehiculos").hide();
			$("#btnDescargarArchivo_ordenes_compra_combustibles_control_vehiculos").hide();
			$("#btnEliminarArchivo_ordenes_compra_combustibles_control_vehiculos").hide();
			$("#btnDesactivar_ordenes_compra_combustibles_control_vehiculos").hide();
			//Deshabilitar botón Buscar vales de gasolina
			$('#btnBuscarValesGasolina_ordenes_compra_combustibles_control_vehiculos').attr('disabled','-1'); 
			//Eliminar tipo de moneda
			$('#monedaOrden_ordenes_compra_combustibles_control_vehiculos').html('');

			//Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_ordenes_compra_combustibles_control_vehiculos();
		}

		//Función para inicializar elementos del proveedor
		function inicializar_proveedor_ordenes_compra_combustibles_control_vehiculos()
		{
			//Limpiar contenido de las siguientes cajas de texto
            $('#txtDiasCredito_ordenes_compra_combustibles_control_vehiculos').val('');
            $('#txtRegimenFiscalID_ordenes_compra_combustibles_control_vehiculos').val('');
            $('#txtPorcentajeRetencionID_ordenes_compra_combustibles_control_vehiculos').val('');
            $('#txtPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos').val('');
            $('#txtImporteRetenido_ordenes_compra_combustibles_control_vehiculos').val('');

            //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
	        mostrar_retencion_isr_ordenes_compra_combustibles_control_vehiculos();
	        
	        //Deshabilitar botón Buscar vales
            $('#btnBuscarValesGasolina_ordenes_compra_combustibles_control_vehiculos').attr('disabled','-1');
            //Hacer un llamado a la función para inicializar elementos de la tabla detalles
		    inicializar_detalles_ordenes_compra_combustibles_control_vehiculos();

		}

		//Función para inicializar elementos de la tabla detalles
		function inicializar_detalles_ordenes_compra_combustibles_control_vehiculos()
		{
			//Eliminar los datos de la tabla detalles
			$('#dg_detalles_ordenes_compra_combustibles_control_vehiculos tbody').empty();
			$('#numElementos_detalles_ordenes_compra_combustibles_control_vehiculos').html(0);
			$('#acumSubtotal_detalles_ordenes_compra_combustibles_control_vehiculos').html('');
			$('#acumIva_detalles_ordenes_compra_combustibles_control_vehiculos').html('');
			$('#acumTotal_detalles_ordenes_compra_combustibles_control_vehiculos').html('');
			$('#txtNumDetalles_ordenes_compra_combustibles_control_vehiculos').val('');
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_ordenes_compra_combustibles_control_vehiculos()
		{
			try {
				//Hacer un llamado a la función para cerrar modal Vales de Gasolina
				cerrar_relacionar_vales_ordenes_compra_combustibles_control_vehiculos();
				//Cerrar modal
				objOrdenesCompraCombustiblesControlVehiculos.close();
				//Si el id de la referencia (para la autorización) se recuperó del modal Ordenes de Compra 
				if($('#txtModalOrdenesCompra_autorizar_ordenes_compra_combustibles_control_vehiculos').val() == 'SI')
				{
					//Hacer un llamado a la función para cerrar modal Autorizar Orden de Compra
					cerrar_autorizar_ordenes_compra_combustibles_control_vehiculos();
				}
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_ordenes_compra_combustibles_control_vehiculos()
		{			
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_ordenes_compra_combustibles_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmOrdenesCompraCombustiblesControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strFecha_ordenes_compra_combustibles_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaVencimiento_ordenes_compra_combustibles_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strCondicionesPago_ordenes_compra_combustibles_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione una condición de pago'}
											}
										},
										intMonedaID_ordenes_compra_combustibles_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										intTipoCambio_ordenes_compra_combustibles_control_vehiculos: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el tipo de cambio cuando la moneda
						                                    //sea diferente del peso mexicano
						                                    if(parseInt($('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').val()) !== intMonedaBaseIDOrdenesCompraCombustiblesControlVehiculos)
						                                    {
						                                    	if(value === '')
						                                    	{
						                                    		return {
						                                           	 valid: false,
						                                            	message: 'Escriba el tipo de cambio'
						                                        	};
						                                    	}
						                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
						                                      	else if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoOrdenesCompraCombustiblesControlVehiculos)
						                                    	{
						                                    		return {
						                                              valid: false,
						                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoOrdenesCompraCombustiblesControlVehiculos
						                                          	};
						                                    	}
							                                      		
						                                    }
					                                    	return true;
					                                    }
					                                }
					                            }
										},
										strProveedor_ordenes_compra_combustibles_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del proveedor
					                                    if($('#txtProveedorID_ordenes_compra_combustibles_control_vehiculos').val() === '')
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
										intPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el id del porcentaje de retención ISR
						                                    if(parseInt($('#txtRegimenFiscalID_ordenes_compra_combustibles_control_vehiculos').val()) === intRegimenFiscalIDResicoOrdenesCompraCombustiblesControlVehiculos)
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
										intImporteRetenido_ordenes_compra_combustibles_control_vehiculos: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
						                                    //Verificar que exista el id del porcentaje de retención ISR
						                                    if(parseInt($('#txtRegimenFiscalID_ordenes_compra_combustibles_control_vehiculos').val()) === intRegimenFiscalIDResicoOrdenesCompraCombustiblesControlVehiculos)
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
										strSolicita_ordenes_compra_combustibles_control_vehiculos: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtSolicitaID_ordenes_compra_combustibles_control_vehiculos').val() === '')
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
										intImporteTotal_ordenes_compra_combustibles_control_vehiculos: {
											validators: {
												notEmpty: {message: 'Escriba el importe total'}
											}
										},
										intNumDetalles_ordenes_compra_combustibles_control_vehiculos: {
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
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_ordenes_compra_combustibles_control_vehiculos = $('#frmOrdenesCompraCombustiblesControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_ordenes_compra_combustibles_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_ordenes_compra_combustibles_control_vehiculos.isValid())
			{
			   //Hacer un llamado a la función para reemplazar '$' por cadena vacia
				var intAcumTotalDetallesOrdenesCompraCombustiblesControlVehiculos = $.reemplazar($('#acumTotal_detalles_ordenes_compra_combustibles_control_vehiculos').html(), "$", "");
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumTotalDetallesOrdenesCompraCombustiblesControlVehiculos = $.reemplazar(intAcumTotalDetallesOrdenesCompraCombustiblesControlVehiculos, ",", "");

				var intImporteTotalOrdenesCompraCombustiblesControlVehiculos = $.reemplazar($('#txtImporteTotal_ordenes_compra_combustibles_control_vehiculos').val(), ",", "");
 
				//Verificar que el importe total sea igual al total de detalles
				if(intAcumTotalDetallesOrdenesCompraCombustiblesControlVehiculos != intImporteTotalOrdenesCompraCombustiblesControlVehiculos)
				{
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_ordenes_compra_combustibles_control_vehiculos('error', 'El importe total no coincide con los detalles, favor de verificar.');
				}
				else
				{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_ordenes_compra_combustibles_control_vehiculos();
				}
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_ordenes_compra_combustibles_control_vehiculos()
		{
			try
			{
				$('#frmOrdenesCompraCombustiblesControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_ordenes_compra_combustibles_control_vehiculos()
		{
			//Obtenemos un array con los datos del archivo
    		var arrArchivoOrdenesCompraCombustiblesControlVehiculos = $("#archivo_varios_ordenes_compra_combustibles_control_vehiculos");

    		//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_combustibles_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrValeGasolinaID = [];
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Asignar valores a los arrays
				arrValeGasolinaID.push(objRen.getAttribute('id'));
			}
          	//Variable que se utiliza para asignar el tipo de cambio
			var intTipoCambioOrden = parseFloat($('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').val());

			//Variable que se utiliza para asignar el importe retenido de ISR (proveedor)
			var intRetencionIsrProv =  parseFloat($.reemplazar($('#txtImporteRetenido_ordenes_compra_combustibles_control_vehiculos').val(), ",", ""));

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
			$.post('control_vehiculos/ordenes_compra_combustibles/guardar',
					{ 
						//Datos de la orden de compra
						intOrdenCompraCombustibleID: $('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val(),
						strFolioConsecutivo: $('#txtFolio_ordenes_compra_combustibles_control_vehiculos').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFecha: $.formatFechaMysql($('#txtFecha_ordenes_compra_combustibles_control_vehiculos').val()),
						dteFechaVencimiento: $.formatFechaMysql($('#txtFechaVencimiento_ordenes_compra_combustibles_control_vehiculos').val()),
						strCondicionesPago: $('#cmbCondicionesPago_ordenes_compra_combustibles_control_vehiculos').val(),
						intMonedaID: $('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').val(),
						intTipoCambio: intTipoCambioOrden,
						strFactura: $('#txtFactura_ordenes_compra_combustibles_control_vehiculos').val(),
						intProveedorID: $('#txtProveedorID_ordenes_compra_combustibles_control_vehiculos').val(),
						intRegimenFiscalID: $('#txtRegimenFiscalID_ordenes_compra_combustibles_control_vehiculos').val(),
						intPorcentajeRetencionID: $('#txtPorcentajeRetencionID_ordenes_compra_combustibles_control_vehiculos').val(),
						//Hacer un llamado a la función para reemplazar ',' por cadena vacia
						intImporteRetenido: intRetencionIsrProv,
						intSolicitaID: $('#txtSolicitaID_ordenes_compra_combustibles_control_vehiculos').val(),
						strObservaciones: $('#txtObservaciones_ordenes_compra_combustibles_control_vehiculos').val(),
						intProcesoMenuID: $('#txtProcesoMenuID_ordenes_compra_combustibles_control_vehiculos').val(),
						//Datos de los detalles
						strValeGasolinaID: arrValeGasolinaID.join('|'), 
					},
					function(data) {
						if (data.resultado)
						{
							//Si no existe id de la orden de compra, significa que es un nuevo registro   
							if($('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val() == '')
							{
							  	//Asignar el id de la orden de compra registrada en la base de datos
                     			$('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val(data.orden_compra_combustible_id);
                     			//Asignar folio consecutivo
                 				$('#txtFolio_ordenes_compra_combustibles_control_vehiculos').val(data.folio);
                 			}

							//Si existen archivos seleccionados
             				if(arrArchivoOrdenesCompraCombustiblesControlVehiculos != undefined )
             				{
             					//Hacer un llamado a la función para subir el archivo
	                    		subir_archivos_modal_ordenes_compra_combustibles_control_vehiculos('Nuevo');
             				}
             				else
             				{
             					//Hacer un llamado a la función para cerrar modal
		                    	cerrar_ordenes_compra_combustibles_control_vehiculos();
		                    	//Hacer un llamado a la función para abrir modal de autorización
								abrir_autorizar_ordenes_compra_combustibles_control_vehiculos($('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val(), $('#txtFolio_ordenes_compra_combustibles_control_vehiculos').val(), 'Guardar');

								//Hacer llamado a la función  para cargar  los registros en el grid
		               			paginacion_ordenes_compra_combustibles_control_vehiculos();  
             				}
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_ordenes_compra_combustibles_control_vehiculos(data.tipo_mensaje, data.mensaje);
						
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_ordenes_compra_combustibles_control_vehiculos(tipoMensaje, mensaje)
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


		//Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_ordenes_compra_combustibles_control_vehiculos(id)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val();

			}
			else
			{
				intID = id;
			}

		   
			//Preguntar al usuario si desea desactivar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Ordenes de Compra',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
			                              $.post('control_vehiculos/ordenes_compra_combustibles/set_estatus',
			                                     {intOrdenCompraCombustibleID: intID
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
			                                          	//Hacer llamado a la función  para cargar  los registros en el grid
			                                          	paginacion_ordenes_compra_combustibles_control_vehiculos();

			                                          	//Si el id del registro se obtuvo del modal
														if(id == '')
														{
															//Hacer un llamado a la función para cerrar modal
															cerrar_ordenes_compra_combustibles_control_vehiculos();     
														}
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_ordenes_compra_combustibles_control_vehiculos(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_ordenes_compra_combustibles_control_vehiculos(id, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/ordenes_compra_combustibles/get_datos',
			       {intOrdenCompraCombustibleID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_ordenes_compra_combustibles_control_vehiculos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Asignar el código de la moneda
	                        strMonedaOrdenesCompraCombustiblesControlVehiculos = data.row.codigo_moneda;
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
				          	$('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val(data.row.orden_compra_combustible_id);
				          	$('#txtFolio_ordenes_compra_combustibles_control_vehiculos').val(data.row.folio);
				          	$('#txtFecha_ordenes_compra_combustibles_control_vehiculos').val(data.row.fecha);
				          	$('#txtFechaVencimiento_ordenes_compra_combustibles_control_vehiculos').val(data.row.fecha_vencimiento);
				            $('#cmbCondicionesPago_ordenes_compra_combustibles_control_vehiculos').val(data.row.condiciones_pago);
				            $('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').val(data.row.moneda_id);
				            $('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').val(data.row.tipo_cambio);
				            $('#txtFactura_ordenes_compra_combustibles_control_vehiculos').val(data.row.factura);
				            $('#txtProveedorID_ordenes_compra_combustibles_control_vehiculos').val(data.row.proveedor_id);
						    $('#txtProveedor_ordenes_compra_combustibles_control_vehiculos').val(data.row.proveedor);
						    $('#txtRegimenFiscalID_ordenes_compra_combustibles_control_vehiculos').val(data.row.regimen_fiscal_id);
						    $('#txtPorcentajeRetencionID_ordenes_compra_combustibles_control_vehiculos').val(data.row.porcentaje_retencion_id);
						    $('#txtPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos').val(data.row.porcentaje_isr);
						    $('#txtImporteRetenido_ordenes_compra_combustibles_control_vehiculos').val(intRetencionIsrProv);
						    //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					        $('#txtImporteRetenido_ordenes_compra_combustibles_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2});
						    $('#txtDiasCredito_ordenes_compra_combustibles_control_vehiculos').val(data.row.dias_credito);
						    $('#txtSolicitaID_ordenes_compra_combustibles_control_vehiculos').val(data.row.solicita_id);
						    $('#txtSolicita_ordenes_compra_combustibles_control_vehiculos').val(data.row.solicita);
						    $('#txtObservaciones_ordenes_compra_combustibles_control_vehiculos').val(data.row.observaciones);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_ordenes_compra_combustibles_control_vehiculos').addClass("estatus-"+strEstatus);
				            $('#txtEstatus_ordenes_compra_combustibles_control_vehiculos').val(strEstatus);
				            //Mostrar botón Imprimir  
				            $("#btnImprimirRegistro_ordenes_compra_combustibles_control_vehiculos").show();
				            //Ocultar botón Adjuntar archivo
				            $("#btnAdjuntar_ordenes_compra_combustibles_control_vehiculos").hide();

				             //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	    				 mostrar_retencion_isr_ordenes_compra_combustibles_control_vehiculos();

							
							//Si existe archivo del registro
				           	if(data.archivo != '')
				           	{
				           		//Mostrar los siguientes botones
				            	$("#btnDescargarArchivo_ordenes_compra_combustibles_control_vehiculos").show();
				            	$('#btnEliminarArchivo_ordenes_compra_combustibles_control_vehiculos').show();
				           	}


				           	//Si el tipo de acción corresponde a Ver
				            if(tipoAccion == 'Ver')
				            {
				            	//Deshabilitar todos los elementos del formulario
				            	$('#frmOrdenesCompraCombustiblesControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar los siguientes botones
					            $("#btnGuardar_ordenes_compra_combustibles_control_vehiculos").hide();
					            $("#btnBuscarValesGasolina_ordenes_compra_combustibles_control_vehiculos").hide();

				            }
				            else //ACTIVO O RECHAZADO
				            {
				            	strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Eliminar'" +
													" onclick='eliminar_renglon_detalles_ordenes_compra_combustibles_control_vehiculos(this)'>" + 
													"<span class='glyphicon glyphicon-trash'></span></button>" + 
													"<button class='btn btn-default btn-xs up' title='Subir'>" + 
													"<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
													"<button class='btn btn-default btn-xs down' title='Bajar'>" + 
													"<span class='glyphicon glyphicon-arrow-down'></span></button>";

				            	//Si el id de la moneda no corresponde al peso mexicano
							    if(parseInt(data.row.moneda_id) !== intMonedaBaseIDOrdenesCompraCombustiblesControlVehiculos)
							    {
									//Habilitar caja de texto
									$("#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos").removeAttr('disabled');
							    }
							    else
							    {
							    	//Deshabilitar las siguientes cajas de texto
									$("#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos").attr('disabled','disabled');
							    }

				            	//Si el estatus del registro es ACTIVO
					            if(strEstatus == 'ACTIVO')
					            {
					            	
					            	//Mostrar los siguientes botones  
					            	$("#btnDesactivar_ordenes_compra_combustibles_control_vehiculos").show();
					            	$("#btnAutorizar_ordenes_compra_combustibles_control_vehiculos").show();
					            	$("#btnAdjuntar_ordenes_compra_combustibles_control_vehiculos").show();
					            	//Habilitar botón Buscar vales de gasolina
									 $('#btnBuscarValesGasolina_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');

					            }
				            }

				            //Mostramos los detalles del registro
				           	for (var intCon in data.detalles) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_ordenes_compra_combustibles_control_vehiculos').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaFolio = objRenglon.insertCell(0);
								var objCeldaFecha = objRenglon.insertCell(1);
								var objCeldaFactura = objRenglon.insertCell(2);
								var objCeldaVehiculo = objRenglon.insertCell(3);
								var objCeldaEmpleado = objRenglon.insertCell(4);
								var objCeldaSubtotal = objRenglon.insertCell(5);
								var objCeldaIva = objRenglon.insertCell(6);
								var objCeldaTotal = objRenglon.insertCell(7);
								var objCeldaAcciones = objRenglon.insertCell(8);
								//Columnas ocultas
								var objCeldaMonedaID = objRenglon.insertCell(9);
								var objCeldaTipoCambio = objRenglon.insertCell(10);


								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].vale_gasolina_id);
								objCeldaFolio.setAttribute('class', 'movil c1');
								objCeldaFolio.innerHTML = data.detalles[intCon].folio;
								objCeldaFecha.setAttribute('class', 'movil c2');
								objCeldaFecha.innerHTML = data.detalles[intCon].fecha;
								objCeldaFactura.setAttribute('class', 'movil c3');
								objCeldaFactura.innerHTML = data.detalles[intCon].factura;
								objCeldaVehiculo.setAttribute('class', 'movil c4');
								objCeldaVehiculo.innerHTML = data.detalles[intCon].vehiculo;
								objCeldaEmpleado.setAttribute('class', 'movil c5');
								objCeldaEmpleado.innerHTML = data.detalles[intCon].empleado;
								objCeldaSubtotal.setAttribute('class', 'movil c6');
								objCeldaSubtotal.innerHTML =  formatMoney(data.detalles[intCon].subtotal, 2, '');
								objCeldaIva.setAttribute('class', 'movil c7');
								objCeldaIva.innerHTML =  formatMoney(data.detalles[intCon].iva, 2, '');
								objCeldaTotal.setAttribute('class', 'movil c8');
								objCeldaTotal.innerHTML = formatMoney(data.detalles[intCon].total, 2, '');
								objCeldaAcciones.setAttribute('class', 'td-center movil c9');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaMonedaID.setAttribute('class', 'no-mostrar');
								objCeldaMonedaID.innerHTML = data.detalles[intCon].moneda_id;
								objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
								objCeldaTipoCambio.innerHTML = data.detalles[intCon].tipo_cambio;

				            }

				            //Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_ordenes_compra_combustibles_control_vehiculos();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_ordenes_compra_combustibles_control_vehiculos tr").length - 2;
							$('#numElementos_detalles_ordenes_compra_combustibles_control_vehiculos').html(intFilas);
							$('#txtNumDetalles_ordenes_compra_combustibles_control_vehiculos').val(intFilas);

			            	//Abrir modal
				            objOrdenesCompraCombustiblesControlVehiculos = $('#OrdenesCompraCombustiblesControlVehiculosBox').bPopup({
												  appendTo: '#OrdenesCompraCombustiblesControlVehiculosContent', 
					                              contentContainer: 'OrdenesCompraCombustiblesControlVehiculosM', 
					                              zIndex: 2, 
					                              modalClose: false, 
					                              modal: true, 
					                              follow: [true,false], 
					                              followEasing : "linear", 
					                              easing: "linear", 
					                              modalColor: ('#F0F0F0')});
				             //Enfocar caja de texto
							$('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').focus();
			       	    }
			       },
			       'json');
		}

		//Función para regresar el tipo de cambio que le corresponde a la moneda seleccionada
		function get_tipo_cambio_ordenes_compra_combustibles_control_vehiculos()
		{	
			//Si la moneda no corresponde a peso mexicano
			if(parseInt($('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').val()) !== intMonedaBaseIDOrdenesCompraCombustiblesControlVehiculos)
         	{
         		//Limpiar contenido de la caja de texto
         		$("#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos").val('');
         		//Inicializar valores de los acumulados
         		$('#acumTotal_detalles_ordenes_compra_combustibles_control_vehiculos').html('$0.00');

         		//Deshabilitar botón Buscar vales de gasolina
				$('#btnBuscarValesGasolina_ordenes_compra_combustibles_control_vehiculos').attr('disabled','-1'); 


				//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
				var dteFecha = $.formatFechaMysql($('#txtFecha_ordenes_compra_combustibles_control_vehiculos').val());

				//Concatenar criterios de búsqueda para regresar el tipo de cambio
				var strCriteriosBusq = dteFecha+'|'+$('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').val();
				
	        	//Hacer un llamado al método del controlador para regresar el tipo de cambio de la moneda
	            $.post('caja/tipos_cambio/get_datos',
	                  { 
	                  	strBusqueda:  strCriteriosBusq,
			       		strTipo: 'fecha'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos").val(data.row.tipo_cambio_sat);
	                       //Habilitar botón Buscar vales de gasolina
	                       $('#btnBuscarValesGasolina_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
	                    }
	                  }
	                 ,
	                'json');

	            //Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_ordenes_compra_combustibles_control_vehiculos();
			}
			
		}

		//Función para subir los archivos de un registro desde el modal
		function subir_archivos_modal_ordenes_compra_combustibles_control_vehiculos(tipoAccion)
		{
			//Variable que se utiliza para asignar archivos
			var strBotonArchivoIDOrdenesCompraCombustiblesControlVehiculos  = "archivo_varios_ordenes_compra_combustibles_control_vehiculos";
			//Asignar valor del objeto tipo file
			var fileUpload = $("#"+strBotonArchivoIDOrdenesCompraCombustiblesControlVehiculos);
			//Obtenemos un array con los datos de los archivos
			var files = $("#"+strBotonArchivoIDOrdenesCompraCombustiblesControlVehiculos)[0].files;
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
			    $('#'+strBotonArchivoIDOrdenesCompraCombustiblesControlVehiculos).val('');
	        	//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_ordenes_compra_combustibles_control_vehiculos('error', strMensajeError);
	        }
	        else
	        {
	        	//Si existe id del registro subir los archivos
	        	if($('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val() != '')
	        	{
		        	//Crear instancia al objeto del formulario
		        	var formData = new FormData($("#frmOrdenesCompraCombustiblesControlVehiculos")[0]);
		        	//Hacer un llamado al método del controlador para subir archivos del registro
		            $.ajax({
		                url: 'control_vehiculos/ordenes_compra_combustibles/subir_archivos',
		                type: "POST",
		                data: formData,
		                contentType: false,
		                processData: false,
		                success: function(data)
		                {
		                    //Limpia ruta del archivo cargado
			         		$('#'+strBotonArchivoIDOrdenesCompraCombustiblesControlVehiculos).val('');
							//Subida finalizada.
							if (data.resultado)
							{
							   //Mostrar los siguientes botones
		                       $('#btnDescargarArchivo_ordenes_compra_combustibles_control_vehiculos').show();
		                       $("#btnEliminarArchivo_ordenes_compra_combustibles_control_vehiculos").show();
			         		   //Hacer llamado a la función  para cargar  los registros en el grid
				           	   paginacion_ordenes_compra_combustibles_control_vehiculos();  
							}

							//Si la acción corresponde a un nuevo registro
		                    if(tipoAccion == 'Nuevo')
		                    {
		                    	//Si el tipo de mensaje es un éxito
				                if(data.tipo_mensaje == 'éxito')
				                {
					                //Hacer un llamado a la función para cerrar modal
					                cerrar_ordenes_compra_combustibles_control_vehiculos();
					                //Hacer un llamado a la función para abrir modal de autorización
									abrir_autorizar_ordenes_compra_combustibles_control_vehiculos($('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val(), $('#txtFolio_ordenes_compra_combustibles_control_vehiculos').val(), 'Guardar');
				                }
				                else
				                {
				                	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    			mensaje_ordenes_compra_combustibles_control_vehiculos(data.tipo_mensaje, data.mensaje);
				                }
		                    }
		                    else
		                    {

		                    	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					    		mensaje_ordenes_compra_combustibles_control_vehiculos(data.tipo_mensaje, data.mensaje);
		                    }
		                }
	            	});
	            }
	        }
			
		}

		//Función para asignar los datos de un proveedor
		function get_datos_proveedor_ordenes_compra_combustibles_control_vehiculos(ui)
		{
		 	
       	       //Asignar valores del registro seleccionado
             $('#txtProveedorID_ordenes_compra_combustibles_control_vehiculos').val(ui.item.data);
             $('#txtDiasCredito_ordenes_compra_combustibles_control_vehiculos').val(ui.item.dias_credito);
             $('#txtRegimenFiscalID_ordenes_compra_combustibles_control_vehiculos').val(ui.item.regimen_fiscal_id);
             //Si existe id de la moneda
             if($('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').val() !== '' && $('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').val() != '')
             {
            	//Habilitar botón Buscar vales de gasolina
			 	$('#btnBuscarValesGasolina_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
             }
          
             //Hacer un llamado a la función para calcular fecha de vencimiento
       	     $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraCombustiblesControlVehiculos);


       	      //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt(ui.item.regimen_fiscal_id) == intRegimenFiscalIDResicoOrdenesCompraCombustiblesControlVehiculos)
       	     {
       	     	//Hacer un llamado a la función para cargar el porcentaje de retención ISR base
       			cargar_porcentaje_isr_base_ordenes_compra_combustibles_control_vehiculos();
       	     }

       	     //Hacer un llamado a la función para mostrar u ocultar retención de ISR (proveedor)
       	     mostrar_retencion_isr_ordenes_compra_combustibles_control_vehiculos();



		}


		//Función para mostrar u ocultar div que contiene el campo de retención de ISR (proveedor)
		function mostrar_retencion_isr_ordenes_compra_combustibles_control_vehiculos()
		{
			//Si el gasto tiene retención de ISR
            if(parseInt($('#txtRegimenFiscalID_ordenes_compra_combustibles_control_vehiculos').val()) == intRegimenFiscalIDResicoOrdenesCompraCombustiblesControlVehiculos)
            {
            	//Quitar clase no-mostrar para mostrar div que contiene la retención de ISR (proveedor)
			  	$('#divRetencionIsr_ordenes_compra_combustibles_control_vehiculos').removeClass("no-mostrar");
            }
            else
            {
            	//Agregar clase no-mostrar para ocultar div que contiene la retención de ISR (proveedor)
			    $('#divRetencionIsr_ordenes_compra_combustibles_control_vehiculos').addClass("no-mostrar");
            }

		}

		
		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglones a la tabla 
		function agregar_vales_relacionados_ordenes_compra_combustibles_control_vehiculos()
		{	
			//Mostramos los vales de gasolina relacionados (seleccionados)
			for (var intCon in objValesRelacionadosOrdenesCompraCombustiblesControlVehiculos.getVales()) 
            {
            	//Crear instancia del objeto Vales de gasolina
            	objValeRelacionarOrdenesCompraCombustiblesControlVehiculos = new ValeRelacionarOrdenesCompraCombustiblesControlVehiculos();
            	//Asignar datos del ingreso corespondiente al indice
            	objValeRelacionarOrdenesCompraCombustiblesControlVehiculos = objValesRelacionadosOrdenesCompraCombustiblesControlVehiculos.getVale(intCon);
            	
            	//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_detalles_ordenes_compra_combustibles_control_vehiculos').getElementsByTagName('tbody')[0];					
				//Variable que se utiliza para asignar el id del detalle
				var intDetalleID =  objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.intValeGasolinaID;

				//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
				if (!objTabla.rows.namedItem(intDetalleID))
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaFolio = objRenglon.insertCell(0);
					var objCeldaFecha = objRenglon.insertCell(1);
					var objCeldaFactura = objRenglon.insertCell(2);
					var objCeldaVehiculo = objRenglon.insertCell(3);
					var objCeldaEmpleado = objRenglon.insertCell(4);
					var objCeldaSubtotal = objRenglon.insertCell(5);
					var objCeldaIva = objRenglon.insertCell(6);
					var objCeldaTotal = objRenglon.insertCell(7);
					var objCeldaAcciones = objRenglon.insertCell(8);
					//Columnas ocultas
					var objCeldaMonedaID = objRenglon.insertCell(9);
					var objCeldaTipoCambio = objRenglon.insertCell(10);
				
					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intDetalleID);
					objCeldaFolio.setAttribute('class', 'movil c1');
					objCeldaFolio.innerHTML = objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.strFolio;
					objCeldaFecha.setAttribute('class', 'movil c2');
					objCeldaFecha.innerHTML = objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.dteFecha;
					objCeldaFactura.setAttribute('class', 'movil c3');
					objCeldaFactura.innerHTML = objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.strFactura;
					objCeldaVehiculo.setAttribute('class', 'movil c4');
					objCeldaVehiculo.innerHTML = objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.strVehiculo;
					objCeldaEmpleado.setAttribute('class', 'movil c5');
					objCeldaEmpleado.innerHTML = objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.strEmpleado;
					objCeldaSubtotal.setAttribute('class', 'movil c6');
					objCeldaSubtotal.innerHTML = objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.intSubtotal;
					objCeldaIva.setAttribute('class', 'movil c7');
					objCeldaIva.innerHTML = objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.intIva;
					objCeldaTotal.setAttribute('class', 'movil c8');
					objCeldaTotal.innerHTML = objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.intTotal;
					objCeldaAcciones.setAttribute('class', 'td-center movil c9');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Eliminar'" +
								   " onclick='eliminar_renglon_detalles_ordenes_compra_combustibles_control_vehiculos(this)'>" + 
								   "<span class='glyphicon glyphicon-trash'></span></button>" + 
								   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
								   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
								   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
								   "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaMonedaID.setAttribute('class', 'no-mostrar');
					objCeldaMonedaID.innerHTML = objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.intMonedaID;
					objCeldaTipoCambio.setAttribute('class', 'no-mostrar');
					objCeldaTipoCambio.innerHTML =  objValeRelacionarOrdenesCompraCombustiblesControlVehiculos.intTipoCambio;
					
				}
		
            }

            //Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_ordenes_compra_combustibles_control_vehiculos();

            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_ordenes_compra_combustibles_control_vehiculos tr").length - 2;
			$('#numElementos_detalles_ordenes_compra_combustibles_control_vehiculos').html(intFilas);
			$('#txtNumDetalles_ordenes_compra_combustibles_control_vehiculos').val(intFilas);
		}

		
		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_ordenes_compra_combustibles_control_vehiculos(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_ordenes_compra_combustibles_control_vehiculos").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_ordenes_compra_combustibles_control_vehiculos();

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_ordenes_compra_combustibles_control_vehiculos tr").length - 2;
			$('#numElementos_detalles_ordenes_compra_combustibles_control_vehiculos').html(intFilas);
			$('#txtNumDetalles_ordenes_compra_combustibles_control_vehiculos').val(intFilas);
		}


		//Función para calcular totales de la tabla
		function calcular_totales_detalles_ordenes_compra_combustibles_control_vehiculos()
		{
			
			//Variable que se utiliza para asignar la moneda de la orden de compra
			var intMonedaIDOrden =  parseInt($("#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos").val());
			//Variable que se utiliza para asignar el tipo de cambio de la orden de compra
			var intTipoCambioOrden =  parseFloat($("#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos").val());

			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_ordenes_compra_combustibles_control_vehiculos').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que se utilizan para los acumulados
			var intAcumSubtotal = 0;
			var intAcumIva = 0;
			var intAcumTotal = 0;

			//Variable que se utiliza para asignar el acumulado anterior del subtotal (en caso de que existan cambios calcular retención de ISR (proveedor) de lo contrario conservar el importe de retención (puede darse el caso de que el usuario modifique dicho importe))
			var intAcumSubtotalAnterior = $('#acumSubtotal_detalles_ordenes_compra_combustibles_control_vehiculos').html();

			//Variable que se utiliza para contar el número de registros
			var intContReg = 0;


			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar los datos de la orden de compra
				var intMonedaID = parseInt(objRen.cells[9].innerHTML);
				var intTipoCambio = parseFloat(objRen.cells[10].innerHTML);
				
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intSubtotal = $.reemplazar(objRen.cells[5].innerHTML, ",", "");
				var intIva = $.reemplazar(objRen.cells[6].innerHTML, ",", "");
				var intTotal = $.reemplazar(objRen.cells[7].innerHTML, ",", "");
				
				//Si el tipo de moneda del vale de gasolina es diferente a la moneda de la orden de compra
				if(intMonedaID !== intMonedaIDOrden)
				{
					//Convertir importe a peso mexicano
					intSubtotal = intSubtotal * intTipoCambio;
					intIva = intIva * intTipoCambio;
					intTotal = intTotal * intTipoCambio;

					//Si el tipo de moneda del vale de gasolina corresponde a peso mexicano
				    if(intMonedaID == intMonedaBaseIDOrdenesCompraCombustiblesControlVehiculos)
					{
						//Convertir peso mexicano a tipo de cambio
						intSubtotal = intSubtotal / intTipoCambioOrden;
						intIva = intIva / intTipoCambioOrden;
						intTotal = intTotal / intTipoCambioOrden;
					}
					
				}

				//Incrementar acumulados
				intAcumSubtotal += parseFloat(intSubtotal);
				intAcumIva += parseFloat(intIva);
				intAcumTotal += parseFloat(intTotal);

				//Incrementar contador por cada registro recorridp
				intContReg++;
			}

			//Convertir cantidad a formato moneda
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 2, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, 2, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, 2, '');

			//Asignar los valores
			$('#acumSubtotal_detalles_ordenes_compra_combustibles_control_vehiculos').html(intAcumSubtotal);
			$('#acumIva_detalles_ordenes_compra_combustibles_control_vehiculos').html(intAcumIva);
			$('#acumTotal_detalles_ordenes_compra_combustibles_control_vehiculos').html(intAcumTotal);
			$('#monedaOrden_ordenes_compra_combustibles_control_vehiculos').html(strMonedaOrdenesCompraCombustiblesControlVehiculos);


			//Si no existe id de la orden de compra, significa que es un nuevo registro
			if($('#txtOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos').val() == '' && intContReg == 1)
			{
				//Asignar el contador para calcular el isr del único detalle
				intAcumSubtotalAnterior = intContReg;
			}


			//Si hubo cambios en el acumulado del subtotal
			if(intAcumSubtotalAnterior != intAcumSubtotal && intAcumSubtotalAnterior != '')
			{
				//Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_ordenes_compra_combustibles_control_vehiculos();
			}
			
		}


		//Función que se utiliza para calcular la retención de ISR (proveedor)
		function calcular_isr_ordenes_compra_combustibles_control_vehiculos()
		{
			 //Si el id del régimen fical corresponde a  Régimen Simplificado de Confianza (RESICO)
       	     if(parseInt($('#txtRegimenFiscalID_ordenes_compra_combustibles_control_vehiculos').val()) == intRegimenFiscalIDResicoOrdenesCompraCombustiblesControlVehiculos)
       	     {
       	     	//Variable que se utiliza para asignar el importe retenido
       	     	var intImporteRetenido = 0;
       	     	//Variable que se utiliza para asignar el acumulado del subtotal
				var intAcumSubtotal = 0;

       	     	//Hacer un llamado a la función para reemplazar '$' y  ','  por cadena vacia
				intAcumSubtotal =  $.reemplazar($('#acumSubtotal_detalles_ordenes_compra_combustibles_control_vehiculos').html(), "$", "");
				intAcumSubtotal =  $.reemplazar(intAcumSubtotal, ",", "");

				//Si existe porcentaje de ISR (proveedor)
				if($('#txtPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos').val() != '' && intAcumSubtotal > 0 )
				{
					//Variable que se utiliza para asignar el porcentaje de retención ISR
					var intPorcentajeRetencionIsr = parseFloat($('#txtPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos').val());

					//Calcular retención de ISR 
					intImporteRetenido = parseFloat(intAcumSubtotal * intPorcentajeRetencionIsr);
					//Redondear cantidad a decimales
					intImporteRetenido = intImporteRetenido.toFixed(2);
					intImporteRetenido = parseFloat(intImporteRetenido);
				}

				//Convertir cantidad a formato moneda
				intImporteRetenido = formatMoney(intImporteRetenido, 2, '');

				//Asignar importe retenido 
				$('#txtImporteRetenido_ordenes_compra_combustibles_control_vehiculos').val(intImporteRetenido);

       	     }
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{

				/*******************************************************************************************************************
			Controles correspondientes al modal Autorizar Orden de Compra
			*********************************************************************************************************************/
			//Modificar el mensaje cuando cambie la opción del combobox
	        $('#cmbEstatus_autorizar_ordenes_compra_combustibles_control_vehiculos').change(function(e){   
	        	//Variables que se utilizan para el mensaje informativo
	        	var strEstatus = $('#cmbEstatus_autorizar_ordenes_compra_combustibles_control_vehiculos').val();
	        	var strMensaje = '';
	        	var strFolio = $('#txtFolio_autorizar_ordenes_compra_combustibles_control_vehiculos').val();
	        	
	        	//Si existe estatus seleccionado
	        	if(strEstatus != '')
	        	{
	        		strMensaje += 'Se ';
	        		
	        		//Dependiendo del estatus modificar mensaje
	              	if($('#cmbEstatus_autorizar_ordenes_compra_combustibles_control_vehiculos').val() === 'AUTORIZADO')
	             	{
	             		strMensaje += 'autorizó ';
	             	}
	             	else
	             	{
	             		strMensaje += 'rechazó ';
	             	}

	             	//Agregar folio en el mensaje
	             	strMensaje += ' la orden de compra combustibles '+strFolio;
	        	}
	           

             	//Asignar mensaje informativo
             	$('#txtMensaje_autorizar_ordenes_compra_combustibles_control_vehiculos').val(strMensaje);
				
	        });
	        
			/*******************************************************************************************************************
			Controles correspondientes al modal Ordenes de Compra
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').numeric();
			$('#txtImporteTotal_ordenes_compra_combustibles_control_vehiculos').numeric();
			$('#txtPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos').numeric();
        	$('#txtImporteRetenido_ordenes_compra_combustibles_control_vehiculos').numeric();
			
			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_ordenes_compra_combustibles_control_vehiculos').blur(function(){
				$('.moneda_ordenes_compra_combustibles_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_ordenes_compra_combustibles_control_vehiculos').blur(function(){
                $('.tipo-cambio_ordenes_compra_combustibles_control_vehiculos').formatCurrency({ roundToDecimalPlace: 4 });
            });


			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_ordenes_compra_combustibles_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaVencimiento_ordenes_compra_combustibles_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});

			//Calcular fecha de vencimiento cuando cambie la fecha
			$('#dteFecha_ordenes_compra_combustibles_control_vehiculos').on('dp.change', function (e) {
             	//Hacer un llamado a la función para calcular fecha de vencimiento
	       	    $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraCombustiblesControlVehiculos);
             	//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
				get_tipo_cambio_ordenes_compra_combustibles_control_vehiculos();
			});


			//Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').change(function(e){   
	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').val()) === intMonedaBaseIDOrdenesCompraCombustiblesControlVehiculos)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').val(intTipoCambioMonedaBaseOrdenesCompraCombustiblesControlVehiculos);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').formatCurrency({ roundToDecimalPlace: 4 });
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_ordenes_compra_combustibles_control_vehiculos();
             	}
	        });


	        //Habilitar o deshabilitar tipo de cambio cuando cambie la opción del combobox
	        $('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').change(function(e){   
	           
	           	//Variable que se utiliza para asignar el texto del combobox moneda
				var strMoneda = '';
				//Si existe id de la moneda
             	if($('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').val() !== '')
             	{

             		//Asignar el texto del combobox moneda
				    strMoneda = $('select[name="intMonedaID_ordenes_compra_combustibles_control_vehiculos"] option:selected').text();
					//Separar cadena para obtener el código de la moneda del pago
					strMoneda = strMoneda.substr(0,3);

             	}
             	
				//Asignar el código de la moneda de la orden de compra
			     strMonedaOrdenesCompraCombustiblesControlVehiculos = strMoneda;


	            //Dependiendo del id de la moneda habilitar o deshabilitar tipo de cambio
              	if(parseInt($('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').val()) === intMonedaBaseIDOrdenesCompraCombustiblesControlVehiculos)
             	{
             		//Deshabilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos").attr('disabled','disabled');
					//Asignar el tipo de cambio correspondiente a la moneda peso mexicano
					$('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').val(intTipoCambioMonedaBaseOrdenesCompraCombustiblesControlVehiculos);
					//Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
					$('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').formatCurrency({ roundToDecimalPlace: 4 });
					//Si existe id del proveedor
	                if($("#txtProveedorID_ordenes_compra_combustibles_control_vehiculos").val() !== '')
	                {
	                	//Habilitar botón Buscar vales de gasolina
                  		$('#btnBuscarValesGasolina_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
	                }

	                //Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_detalles_ordenes_compra_combustibles_control_vehiculos();
             	}
             	else
             	{
             		//Habilitar caja de texto
					$("#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos").removeAttr('disabled');
					//Limpiar contenido de la caja de texto
					$('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').val(''); 
					//Hacer un llamado a la función para regresar el tipo de cambio que le corresponde a la moneda
					get_tipo_cambio_ordenes_compra_combustibles_control_vehiculos();
             	}

	        });


	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoOrdenesCompraCombustiblesControlVehiculos)
	        	{
	        		$('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').val(intTipoCambioMaximoOrdenesCompraCombustiblesControlVehiculos);
	        	}

	        	//Si no existe tipo de cambio 
	        	if($('#txtTipoCambio_ordenes_compra_combustibles_control_vehiculos').val() == '' || $('#txtProveedorID_ordenes_compra_combustibles_control_vehiculos').val() == '' )
	        	{
	        		//Deshabilitar botón  Buscar vales de gasolina
					$('#btnBuscarValesGasolina_ordenes_compra_combustibles_control_vehiculos').attr("disabled", "disabled"); 
					//Inicializar valores de los acumulados
	         		$('#acumTotal_detalles_ordenes_compra_combustibles_control_vehiculos').html('$0.00');
	        	}
	        	else
	        	{
	        		//Habilitar botón Buscar vales de gasolina
					$('#btnBuscarValesGasolina_ordenes_compra_combustibles_control_vehiculos').removeAttr('disabled');
					//Hacer un llamado a la función para calcular totales de la tabla
					calcular_totales_detalles_ordenes_compra_combustibles_control_vehiculos();
	        	}

		    });


	        //Calcular fecha de vencimiento cuando cambie la opción del combobox
	        $('#cmbCondicionesPago_ordenes_compra_combustibles_control_vehiculos').change(function(e){   
	             //Hacer un llamado a la función para calcular fecha de vencimiento
	       	     $.calcularFechaVencimiento(arrFechaVencimientoOrdenesCompraCombustiblesControlVehiculos);
	        });


		    //Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedor_ordenes_compra_combustibles_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorID_ordenes_compra_combustibles_control_vehiculos').val('');
	               //Hacer un llamado a la función para inicializar elementos del proveedor
	               inicializar_proveedor_ordenes_compra_combustibles_control_vehiculos();
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
	       	     get_datos_proveedor_ordenes_compra_combustibles_control_vehiculos(ui);
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
	        $('#txtProveedor_ordenes_compra_combustibles_control_vehiculos').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorID_ordenes_compra_combustibles_control_vehiculos').val() == '' ||
	               $('#txtProveedor_ordenes_compra_combustibles_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorID_ordenes_compra_combustibles_control_vehiculos').val('');
	               $('#txtProveedor_ordenes_compra_combustibles_control_vehiculos').val('');
	                //Hacer un llamado a la función para inicializar elementos del proveedor
	                inicializar_proveedor_ordenes_compra_combustibles_control_vehiculos();
	            }

	        });

	        //Autocomplete para recuperar los datos de un empleado 
	        $('#txtSolicita_ordenes_compra_combustibles_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtSolicitaID_ordenes_compra_combustibles_control_vehiculos').val('');
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
	             $('#txtSolicitaID_ordenes_compra_combustibles_control_vehiculos').val(ui.item.data);
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
	        $('#txtSolicita_ordenes_compra_combustibles_control_vehiculos').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtSolicitaID_ordenes_compra_combustibles_control_vehiculos').val() == '' ||
	               $('#txtSolicita_ordenes_compra_combustibles_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtSolicitaID_ordenes_compra_combustibles_control_vehiculos').val('');
	               $('#txtSolicita_ordenes_compra_combustibles_control_vehiculos').val('');
	            }

	        });


	        //Autocomplete para recuperar los datos de un porcentaje de retención ISR 
	        $('#txtPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtPorcentajeRetencionID_ordenes_compra_combustibles_control_vehiculos').val('');
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
	             $('#txtPorcentajeRetencionID_ordenes_compra_combustibles_control_vehiculos').val(ui.item.data);
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
	        $('#txtPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos').focusout(function(e){
	            //Si no existe id de la tasa o cuota
	            if($('#txtPorcentajeRetencionID_ordenes_compra_combustibles_control_vehiculos').val() == '' ||
	               $('#txtPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtPorcentajeRetencionID_ordenes_compra_combustibles_control_vehiculos').val('');
	               $('#txtPorcentajeIsr_ordenes_compra_combustibles_control_vehiculos').val('');
	            }

	           //Hacer un llamado a la función para calcular la retención de ISR (proveedor)
				calcular_isr_ordenes_compra_combustibles_control_vehiculos();
	            
	        });
       		
			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_ordenes_compra_combustibles_control_vehiculos').on('click','button.btn',function(){
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
		    
		    /*******************************************************************************************************************
			Controles correspondientes al modal Vales de Gasolina
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_relacionar_vales_ordenes_compra_combustibles_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_ordenes_compra_combustibles_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_ordenes_compra_combustibles_control_vehiculos').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_ordenes_compra_combustibles_control_vehiculos').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos').data('DateTimePicker').maxDate(e.date);
			});

			
			//Autocomplete para recuperar los datos de un proveedor 
	        $('#txtProveedorBusq_ordenes_compra_combustibles_control_vehiculos').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtProveedorIDBusq_ordenes_compra_combustibles_control_vehiculos').val('');
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
	             $('#txtProveedorIDBusq_ordenes_compra_combustibles_control_vehiculos').val(ui.item.data);
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
	        $('#txtProveedorBusq_ordenes_compra_combustibles_control_vehiculos').focusout(function(e){
	            //Si no existe id del proveedor
	            if($('#txtProveedorIDBusq_ordenes_compra_combustibles_control_vehiculos').val() == '' ||
	               $('#txtProveedorBusq_ordenes_compra_combustibles_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProveedorIDBusq_ordenes_compra_combustibles_control_vehiculos').val('');
	               $('#txtProveedorBusq_ordenes_compra_combustibles_control_vehiculos').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_ordenes_compra_combustibles_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaOrdenesCompraCombustiblesControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_ordenes_compra_combustibles_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_ordenes_compra_combustibles_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_ordenes_compra_combustibles_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_ordenes_compra_combustibles_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				objOrdenesCompraCombustiblesControlVehiculos = $('#OrdenesCompraCombustiblesControlVehiculosBox').bPopup({
									   appendTo: '#OrdenesCompraCombustiblesControlVehiculosContent', 
		                               contentContainer: 'OrdenesCompraCombustiblesControlVehiculosM', 
		                               zIndex: 2, 
		                               modalClose: false, 
		                               modal: true, 
		                               follow: [true,false], 
		                               followEasing : "linear", 
		                               easing: "linear", 
		                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#cmbMonedaID_ordenes_compra_combustibles_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_ordenes_compra_combustibles_control_vehiculos').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_ordenes_compra_combustibles_control_vehiculos();
			//Hacer un llamado a la función para cargar monedas en el combobox del modal
            cargar_monedas_ordenes_compra_combustibles_control_vehiculos();
		});
	</script>