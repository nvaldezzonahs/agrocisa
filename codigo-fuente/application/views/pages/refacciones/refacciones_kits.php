	<div id="RefaccionesKitsRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_refacciones_kits_refacciones" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-6 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_refacciones_kits_refacciones" 
								   name="strBusqueda_refacciones_kits_refacciones"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_refacciones_kits_refacciones"
										onclick="paginacion_refacciones_kits_refacciones();" 
										title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-3 col-md-2 col-lg-2 col-xs-12">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_refacciones_kits_refacciones" 
									   name="strImprimirDetalles_refacciones_kits_refacciones" type="checkbox"
									   value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
	                  	</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_refacciones_kits_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_refacciones_kits_refacciones"
									onclick="reporte_refacciones_kits_refacciones('PDF');" title="Imprimir reporte general en PDF"
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_refacciones_kits_refacciones"
									onclick="reporte_refacciones_kits_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla kits de refacciones
				*/
				td.movil.a1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles del kit de refacciones
				*/
				td.movil.b1:nth-of-type(1):before {content: "Refacción"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Cantidad"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Precio Unit."; font-weight: bold;}
				td.movil.b4:nth-of-type(4):before {content: "Desc."; font-weight: bold;}
				td.movil.b5:nth-of-type(5):before {content: "Subtotal"; font-weight: bold;}
				td.movil.b6:nth-of-type(6):before {content: "IVA"; font-weight: bold;}
				td.movil.b7:nth-of-type(7):before {content: "IEPS"; font-weight: bold;}
				td.movil.b8:nth-of-type(8):before {content: "Total"; font-weight: bold;}
				td.movil.b9:nth-of-type(9):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de los totales (acumulados) de la tabla detalles del kit de refacciones
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
				<table class="table-hover movil" id="dg_refacciones_kits_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Descripción</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_refacciones_kits_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{codigo}}</td>
							<td class="movil a2">{{descripcion}}</td>
							<td class="movil a3">{{estatus}}</td>
							<td class="td-center movil a4"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_refacciones_kits_refacciones({{refaccion_kit_id}},'id','Editar');"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										 onclick="editar_refacciones_kits_refacciones({{refaccion_kit_id}},'id','Ver');"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_refacciones_kits_refacciones({{refaccion_kit_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_refacciones_kits_refacciones({{refaccion_kit_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_refacciones_kits_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_refacciones_kits_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal -->
		<div id="RefaccionesKitsRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_refacciones_kits_refacciones"  class="ModalBodyTitle">
			<h1>Kits de Refacciones</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRefaccionesKitsRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmRefaccionesKitsRefacciones"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
						<!--Código-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtRefaccionKitID_refacciones_kits_refacciones" 
										   name="intRefaccionKitID_refacciones_kits_refacciones" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el código anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código-->
									<input id="txtCodigoAnterior_refacciones_kits_refacciones" 
										   name="strCodigoAnterior_refacciones_kits_refacciones" 
										   type="hidden" value="">
									<label for="txtCodigo_refacciones_kits_refacciones">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_refacciones_kits_refacciones" 
											name="strCodigo_refacciones_kits_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese código" maxlength="20">
									</input>
								</div>
							</div>
						</div>
						<!--Descripción-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcion_refacciones_kits_refacciones">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_refacciones_kits_refacciones" 
											name="strDescripcion_refacciones_kits_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese descripción" maxlength="50">
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
									<input id="txtNumDetalles_refacciones_kits_refacciones" 
										   name="intNumDetalles_refacciones_kits_refacciones" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Refacciones incluídas en el kit</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene las refacciones activas-->
													<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id de la refacción seleccionada-->
																<input id="txtRefaccionID_detalles_refacciones_kits_refacciones" 
																	   name="intRefaccionID_detalles_refacciones_kits_refacciones"  
																	   type="hidden" value="">
															    </input>
																<label for="txtRefaccion_detalles_refacciones_kits_refacciones">
																	Refacción
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtRefaccion_detalles_refacciones_kits_refacciones" 
																		name="strRefaccion_detalles_refacciones_kits_refacciones" type="text" value="" 
																		tabindex="1" placeholder="Ingrese refacción" maxlength="250">
																</input>
															</div>
														</div>
													</div>
												    <!--Cantidad-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtCantidad_detalles_refacciones_kits_refacciones">
																	Cantidad
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_refacciones_kits_refacciones" 
																		id="txtCantidad_detalles_refacciones_kits_refacciones" 
																		name="intCantidad_detalles_refacciones_kits_refacciones" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese cantidad" maxlength="14">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeDescuento_detalles_refacciones_kits_refacciones">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_refacciones_kits_refacciones" id="txtPorcentajeDescuento_detalles_refacciones_kits_refacciones" 
																		name="intPorcentajeDescuento_detalles_refacciones_kits_refacciones" type="text" value="" 
																		tabindex="1" placeholder="Ingrese descuento" maxlength="7">
																</input>
															</div>
														</div>
													</div>
													<!--Precio-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPrecio_detalles_refacciones_kits_refacciones">Precio</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPrecio_detalles_refacciones_kits_refacciones" 
																		name="intPrecio_detalles_refacciones_kits_refacciones" type="text" value=""  disabled>
																</input>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<!--Línea-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtRefaccionesLinea_detalles_refacciones_kits_refacciones">
																	Línea
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtRefaccionesLinea_detalles_refacciones_kits_refacciones" 
																		name="strRefaccionesLinea_detalles_refacciones_kits_refacciones" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Moneda-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtMoneda_detalles_refacciones_kits_refacciones">
																	Moneda
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtMoneda_detalles_refacciones_kits_refacciones" 
																		name="strMoneda_detalles_refacciones_kits_refacciones" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IVA-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeIva_detalles_refacciones_kits_refacciones">IVA %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIva_detalles_refacciones_kits_refacciones" 
																		name="intPorcentajeIva_detalles_refacciones_kits_refacciones" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del IEPS-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeIeps_detalles_refacciones_kits_refacciones">IEPS %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtPorcentajeIeps_detalles_refacciones_kits_refacciones" 
																		name="intPorcentajeIeps_detalles_refacciones_kits_refacciones" type="text" value="" disabled>
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
														<button class="btn btn-primary btn-toolBtns pull-right" 
																id="btnAgregar_detalles_refacciones_kits_refacciones"
																onclick="agregar_renglon_detalles_refacciones_kits_refacciones();" 
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
													<table class="table-hover movil" id="dg_detalles_refacciones_kits_refacciones">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Refacción</th>
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
																	<strong id="acumCantidad_detalles_refacciones_kits_refacciones"></strong>
																</td>
																<td class="movil t3"></td>
																<td class="movil t4">
																	<strong id="acumDescuento_detalles_refacciones_kits_refacciones"></strong>
																</td>
																<td class="movil t5">
																	<strong id="acumSubtotal_detalles_refacciones_kits_refacciones"></strong>
																</td>
																<td class="movil t6">
																	<strong id="acumIva_detalles_refacciones_kits_refacciones"></strong>
																</td>
																<td class="movil t7">
																	<strong  id="acumIeps_detalles_refacciones_kits_refacciones"></strong>
																</td>
																<td class="movil t8">
																	<strong id="acumTotal_detalles_refacciones_kits_refacciones"></strong>
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
																<strong id="numElementos_detalles_refacciones_kits_refacciones">0</strong> encontrados
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
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_refacciones_kits_refacciones"  
									onclick="validar_refacciones_kits_refacciones();"  title="Guardar" 
									tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_refacciones_kits_refacciones"  
									onclick="cambiar_estatus_refacciones_kits_refacciones('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_refacciones_kits_refacciones"  
									onclick="cambiar_estatus_refacciones_kits_refacciones('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_refacciones_kits_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_refacciones_kits_refacciones();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#RefaccionesKitsRefaccionesContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaRefaccionesKitsRefacciones = 0;
		var strUltimaBusquedaRefaccionesKitsRefacciones = "";
		//Variable que se utiliza para asignar objeto del modal
		var objRefaccionesKitsRefacciones = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_refacciones_kits_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/refacciones_kits/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_refacciones_kits_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRefaccionesKitsRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosRefaccionesKitsRefacciones = strPermisosRefaccionesKitsRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRefaccionesKitsRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRefaccionesKitsRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_refacciones_kits_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosRefaccionesKitsRefacciones[i]=='GUARDAR') || (arrPermisosRefaccionesKitsRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_refacciones_kits_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesKitsRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_refacciones_kits_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_refacciones_kits_refacciones();
						}
						else if(arrPermisosRefaccionesKitsRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_refacciones_kits_refacciones').removeAttr('disabled');
							$('#btnRestaurar_refacciones_kits_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesKitsRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_refacciones_kits_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesKitsRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_refacciones_kits_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_refacciones_kits_refacciones() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_refacciones_kits_refacciones').val() != strUltimaBusquedaRefaccionesKitsRefacciones)
			{
				intPaginaRefaccionesKitsRefacciones = 0;
				strUltimaBusquedaRefaccionesKitsRefacciones = $('#txtBusqueda_refacciones_kits_refacciones').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/refacciones_kits/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_refacciones_kits_refacciones').val(),
						intPagina:intPaginaRefaccionesKitsRefacciones,
						strPermisosAcceso: $('#txtAcciones_refacciones_kits_refacciones').val()
					},
					function(data){
						$('#dg_refacciones_kits_refacciones tbody').empty();
						var tmpRefaccionesKitsRefacciones = Mustache.render($('#plantilla_refacciones_kits_refacciones').html(),data);
						$('#dg_refacciones_kits_refacciones tbody').html(tmpRefaccionesKitsRefacciones);
						$('#pagLinks_refacciones_kits_refacciones').html(data.paginacion);
						$('#numElementos_refacciones_kits_refacciones').html(data.total_rows);
						intPaginaRefaccionesKitsRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_refacciones_kits_refacciones(strTipo) 
		{

			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/refacciones_kits/';

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
			if ($('#chbImprimirDetalles_refacciones_kits_refacciones').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_refacciones_kits_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_refacciones_kits_refacciones').val('NO');
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'strBusqueda': $('#txtBusqueda_refacciones_kits_refacciones').val(), 
										'strDetalles': $('#chbImprimirDetalles_refacciones_kits_refacciones').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}

		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_refacciones_kits_refacciones()
		{
			//Incializar formulario
			$('#frmRefaccionesKitsRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_kits_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmRefaccionesKitsRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_refacciones_kits_refacciones');
			//Eliminar los datos de la tabla detalles del kit de refacciones
			$('#dg_detalles_refacciones_kits_refacciones tbody').empty();
			$('#acumCantidad_detalles_refacciones_kits_refacciones').html('0.00');
			$('#acumDescuento_detalles_refacciones_kits_refacciones').html('$0.00');
			$('#acumSubtotal_detalles_refacciones_kits_refacciones').html('$0.00');
			$('#acumIva_detalles_refacciones_kits_refacciones').html('$0.00');
			$('#acumIeps_detalles_refacciones_kits_refacciones').html('$0.00');
			$('#acumTotal_detalles_refacciones_kits_refacciones').html('$0.00');
			$('#numElementos_detalles_refacciones_kits_refacciones').html(0);
			//Habilitar todos los elementos del formulario
			$('#frmRefaccionesKitsRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$("#txtPrecio_detalles_refacciones_kits_refacciones").attr('disabled','disabled');
			$('#txtRefaccionesLinea_detalles_refacciones_kits_refacciones').attr("disabled", "disabled");
			$('#txtMoneda_detalles_refacciones_kits_refacciones').attr("disabled", "disabled");
			$('#txtPorcentajeIva_detalles_refacciones_kits_refacciones').attr("disabled", "disabled");
			$('#txtPorcentajeIeps_detalles_refacciones_kits_refacciones').attr("disabled", "disabled");
			//Mostrar los siguientes botones
			$("#btnGuardar_refacciones_kits_refacciones").show();
			//Habilitar botón Agregar
			$('#btnAgregar_detalles_refacciones_kits_refacciones').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnDesactivar_refacciones_kits_refacciones").hide();
			$("#btnRestaurar_refacciones_kits_refacciones").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_refacciones_kits_refacciones()
		{
			try {
				//Cerrar modal
				objRefaccionesKitsRefacciones.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_refacciones_kits_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_refacciones_kits_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_kits_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmRefaccionesKitsRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
										valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo_refacciones_kits_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba un código'}
											}
										},
										strDescripcion_refacciones_kits_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										intNumDetalles_refacciones_kits_refacciones: {
											validators: {
												callback: {
													callback: function(value, validator, $field) {
														//Verificar que existan detalles
														if(parseInt(value) === 0 || value === '')
														{
															return {
																valid: false,
																message: 'Agregar al menos una refacción para este kit.'
															};
														}
														return true;
													}
												}
											}
										},
										strRefaccion_detalles_refacciones_kits_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intCantidad_detalles_refacciones_kits_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_detalles_refacciones_kits_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_refacciones_kits_refacciones = $('#frmRefaccionesKitsRefacciones').data('bootstrapValidator');
			bootstrapValidator_refacciones_kits_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_refacciones_kits_refacciones.isValid())
			{
					//Hacer un llamado a la función para guardar los datos del registro
					guardar_refacciones_kits_refacciones();
				
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_refacciones_kits_refacciones()
		{
			try
			{
				$('#frmRefaccionesKitsRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_refacciones_kits_refacciones()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_refacciones_kits_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRefaccionID = [];
			var arrCantidades = [];
			var arrPorcentajesDescuento = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intCantidad = $.reemplazar(objRen.cells[1].innerHTML, ",", "");
				
				//Asignar valores a los arrays
				arrRefaccionID.push(objRen.getAttribute('id'));
				arrCantidades.push(intCantidad);
				arrPorcentajesDescuento.push(objRen.cells[9].innerHTML);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/refacciones_kits/guardar',
					{ 
						//Datos del kit de refacciones
						intRefaccionKitID: $('#txtRefaccionKitID_refacciones_kits_refacciones').val(),
						strCodigo: $('#txtCodigo_refacciones_kits_refacciones').val(),
						strCodigoAnterior: $('#txtCodigoAnterior_refacciones_kits_refacciones').val(),
						strDescripcion: $('#txtDescripcion_refacciones_kits_refacciones').val(),
						//Datos de los detalles
						strRefaccionID: arrRefaccionID.join('|'),
						strCantidades: arrCantidades.join('|'),
						strDescuentos: arrPorcentajesDescuento.join('|')
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_refacciones_kits_refacciones();
							//Hacer un llamado a la función para cerrar modal
							cerrar_refacciones_kits_refacciones();  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_refacciones_kits_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_refacciones_kits_refacciones(tipoMensaje, mensaje)
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
												 	//Limpiar caja de texto
													$('#txtCodigo_refacciones_kits_refacciones').val('');
													//Enfocar caja de texto
													$('#txtCodigo_refacciones_kits_refacciones').focus();
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
		function cambiar_estatus_refacciones_kits_refacciones(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtRefaccionKitID_refacciones_kits_refacciones').val();

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
									  'title':    'Kits de Refacciones',
									  'buttons':  ['Aceptar', 'Cancelar'],
									  'onClose':  function(caption) {
													if(caption == 'Aceptar')
													{
												  		//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_refacciones_kits_refacciones(intID, strTipo, 'INACTIVO');
													}
												  }
									  });
			}
			else//Si el estatus del registro es INACTIVO
			{
				
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_refacciones_kits_refacciones(intID, strTipo, 'ACTIVO');
			}
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_refacciones_kits_refacciones(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('refacciones/refacciones_kits/set_estatus',
			      {intRefaccionKitID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_refacciones_kits_refacciones();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_refacciones_kits_refacciones();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_refacciones_kits_refacciones(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_refacciones_kits_refacciones(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/refacciones_kits/get_datos',
				   {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
				   },
				   function(data) {
						//Si hay datos del registro
						if(data.row)
						{
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_refacciones_kits_refacciones();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				            
							//Recuperar valores
							$('#txtRefaccionKitID_refacciones_kits_refacciones').val(data.row.refaccion_kit_id);
							$('#txtCodigo_refacciones_kits_refacciones').val(data.row.codigo);
							$('#txtCodigoAnterior_refacciones_kits_refacciones').val(data.row.codigo);
							$('#txtDescripcion_refacciones_kits_refacciones').val(data.row.descripcion);
							//Dependiendo del estatus cambiar el color del encabezado 
							$('#divEncabezadoModal_refacciones_kits_refacciones').addClass("estatus-"+strEstatus);
							
							//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
				            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
															 " onclick='editar_renglon_detalles_refacciones_kits_refacciones(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_detalles_refacciones_kits_refacciones(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";

								//Mostrar botón Desactivar
				            	$("#btnDesactivar_refacciones_kits_refacciones").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmRefaccionesKitsRefacciones').find('input, textarea, select').attr('disabled','disabled');
			            		//Deshabilitar botón Agregar
								$('#btnAgregar_detalles_refacciones_kits_refacciones').prop('disabled', true);
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_refacciones_kits_refacciones").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_refacciones_kits_refacciones").show();
							}


							//Mostramos los detalles del registro
							for (var intCon in data.detalles) 
							{
								//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_refacciones_kits_refacciones').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaRefaccion = objRenglon.insertCell(0);
								var objCeldaCantidad = objRenglon.insertCell(1);
								var objCeldaPrecio = objRenglon.insertCell(2);
								var objCeldaDescuento = objRenglon.insertCell(3);
								var objCeldaSubtotal = objRenglon.insertCell(4);
								var objCeldaIvaUnitario = objRenglon.insertCell(5);
								var objCeldaIepsUnitario = objRenglon.insertCell(6);
								var objCeldaTotal = objRenglon.insertCell(7);
								var objCeldaAcciones = objRenglon.insertCell(8);
								//Columnas ocultas
								var objCeldaPorcentajeDescuento = objRenglon.insertCell(9);
								var objCeldaPorcentajeIva = objRenglon.insertCell(10);
								var objCeldaPorcentajeIeps = objRenglon.insertCell(11);
								var objCeldaLinea = objRenglon.insertCell(12);
								var objCeldaMoneda = objRenglon.insertCell(13);

								//Variables que se utilizan para asignar valores del detalle
								var intSubtotal = parseFloat(data.detalles[intCon].precio);
								var intCantidad =  parseFloat(data.detalles[intCon].cantidad);
								var intPrecioUnitario = parseFloat(data.detalles[intCon].precio);
								var intPorcentajeDescuento = parseFloat(data.detalles[intCon].descuento);
								var intPorcentajeIva = parseFloat(data.detalles[intCon].porcentaje_iva);
								var intPorcentajeIeps = parseFloat(data.detalles[intCon].porcentaje_ieps);
								var intDescuentoUnitario = 0;
								var intImporteIva = 0;
								var intImporteIeps = 0;
								var intTotal = 0;

								//Si existe porcentaje de descuento
								if(intPorcentajeDescuento > 0)
								{
									//Calcular porcentaje del descuento
									intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;
									intSubtotal =  intSubtotal - intDescuentoUnitario;
								}

								//Calcular subtotal
								intSubtotal = intCantidad * intSubtotal;
								//Calcular importe de IVA
								intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);

								//Si existe porcentaje de IEPS
								if(intPorcentajeIeps > 0)
								{
									//Calcular importe de IEPS
									intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
								}

								//Calcular importe total
								intTotal = intSubtotal + intImporteIva + intImporteIeps;

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].refaccion_id);
								objCeldaRefaccion.setAttribute('class', 'movil b1');
								objCeldaRefaccion.innerHTML = data.detalles[intCon].refaccion;
								objCeldaCantidad.setAttribute('class', 'movil b2');
								objCeldaCantidad.innerHTML = formatMoney(intCantidad, 2, '');
								objCeldaPrecio.setAttribute('class', 'movil b3');
								objCeldaPrecio.innerHTML = formatMoney(intPrecioUnitario, 2, '');
								objCeldaDescuento.setAttribute('class', 'movil b4');
								objCeldaDescuento.innerHTML = formatMoney(intDescuentoUnitario, 2, '');
								objCeldaSubtotal.setAttribute('class', 'movil b5');
								objCeldaSubtotal.innerHTML = formatMoney(intSubtotal, 2, '');
								objCeldaIvaUnitario.setAttribute('class', 'movil b6');
								objCeldaIvaUnitario.innerHTML = formatMoney(intImporteIva, 2, '');
								objCeldaIepsUnitario.setAttribute('class', 'movil b7');
								objCeldaIepsUnitario.innerHTML = formatMoney(intImporteIeps, 2, '');
								objCeldaTotal.setAttribute('class', 'movil b8');
								objCeldaTotal.innerHTML = formatMoney(intTotal, 2, '');
								objCeldaAcciones.setAttribute('class', 'td-center movil b9');
								objCeldaAcciones.innerHTML = strAccionesTabla;
								objCeldaPorcentajeDescuento.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeDescuento.innerHTML = formatMoney(intPorcentajeDescuento, 2, '');
								objCeldaPorcentajeIva.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIva.innerHTML = data.detalles[intCon].porcentaje_iva;
								objCeldaPorcentajeIeps.setAttribute('class', 'no-mostrar');
								objCeldaPorcentajeIeps.innerHTML = data.detalles[intCon].porcentaje_ieps;
								objCeldaLinea.setAttribute('class', 'no-mostrar');
								objCeldaLinea.innerHTML = data.detalles[intCon].refacciones_linea;
								objCeldaMoneda.setAttribute('class', 'no-mostrar');
								objCeldaMoneda.innerHTML = data.detalles[intCon].moneda;
							}

							//Hacer un llamado a la función para calcular totales de la tabla
							calcular_totales_detalles_refacciones_kits_refacciones();
							//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
							var intFilas = $("#dg_detalles_refacciones_kits_refacciones tr").length - 2;
							$('#numElementos_detalles_refacciones_kits_refacciones').html(intFilas);
							$('#txtNumDetalles_refacciones_kits_refacciones').val(intFilas);
							
							//Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            
								//Abrir modal
								objRefaccionesKitsRefacciones = $('#RefaccionesKitsRefaccionesBox').bPopup({
															  appendTo: '#RefaccionesKitsRefaccionesContent', 
															  contentContainer: 'RefaccionesKitsRefaccionesM', 
															  zIndex: 2, 
															  modalClose: false, 
															  modal: true, 
															  follow: [true,false], 
															  followEasing : "linear", 
															  easing: "linear", 
															  modalColor: ('#F0F0F0')});

								//Enfocar caja de texto
								$('#txtCodigo_refacciones_kits_refacciones').focus();
						    }
						}
				   },
				   'json');
		}


		//Función para verificar la existencia de un registro
		function verificar_existencia_refacciones_kits_refacciones()
		{
			//Verificar la existencia del código en la tabla de refacciones
			if($('#txtCodigo_refacciones_kits_refacciones').val() != '')
			{
				
				//Hacer un llamado al método del controlador para regresar los datos del registro que coincide con el código
				$.ajax({url: 'refacciones/refacciones/get_datos',
						type: 'POST',
						data: {
							strBusqueda :$("#txtCodigo_refacciones_kits_refacciones").val(),
							strTipo: 'codigo'
						},
					     async: true, //blocks window close
						success: function(data) {
							if(data.row) 
		                  	{

		                        //Hacer un llamado a la función para mostrar mensaje de error
					            mensaje_refacciones_kits_refacciones('informacion', 'El código se encuentra agregado en el catálogo de refacciones, favor de verificar.');
		                    }
		                    else
		                    {


		                    	//Si no existe id, verificar la existencia del código en la tabla refacciones_kits
								if ($('#txtRefaccionKitID_refacciones_kits_refacciones').val() == '')
								{
									//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código
									editar_refacciones_kits_refacciones($('#txtCodigo_refacciones_kits_refacciones').val(), 'codigo', 'Nuevo');
								}
		                    }
						}
				});
			}
		}

		
		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para inicializar elementos de la refacción
        function inicializar_refaccion_detalles_refacciones_kits_refacciones()
        {
        	//Limpiar contenido de las siguientes cajas de texto
        	$('#txtPrecio_detalles_refacciones_kits_refacciones').val('');
        	$('#txtRefaccionesLinea_detalles_refacciones_kits_refacciones').val('');
        	$('#txtMoneda_detalles_refacciones_kits_refacciones').val('');
        	$('#txtPorcentajeIva_detalles_refacciones_kits_refacciones').val('');
        	$('#txtPorcentajeIeps_detalles_refacciones_kits_refacciones').val('');
        }


		//Función para regresar obtener los datos de una refacción
        function get_datos_refaccion_detalles_refacciones_kits_refacciones()
        {
        	//Hacer un llamado al método del controlador para regresar los datos de la refacción
            $.post('refacciones/refacciones/get_datos',
                  { 
                  	strBusqueda:$("#txtRefaccionID_detalles_refacciones_kits_refacciones").val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtPrecio_detalles_refacciones_kits_refacciones").val(data.row.precio);
                       //Asignar formatCurrency (formato Moneda) a la caja de texto para cambiar el formato de la cantidad
			           $('#txtPrecio_detalles_refacciones_kits_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
                       $("#txtRefaccionesLinea_detalles_refacciones_kits_refacciones").val(data.row.refacciones_linea);
                       $("#txtMoneda_detalles_refacciones_kits_refacciones").val(data.row.moneda);
                       $("#txtPorcentajeIva_detalles_refacciones_kits_refacciones").val(data.row.porcentaje_iva);
                       $("#txtPorcentajeIeps_detalles_refacciones_kits_refacciones").val(data.row.porcentaje_ieps);
                    }
                  }
                 ,
                'json');
        }


		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_refacciones_kits_refacciones()
		{
			//Variable que se utiliza para asignar el subtotal
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
			var intRefaccionID = $('#txtRefaccionID_detalles_refacciones_kits_refacciones').val();
			var strRefaccion = $('#txtRefaccion_detalles_refacciones_kits_refacciones').val();
			var intPrecioUnitario = $('#txtPrecio_detalles_refacciones_kits_refacciones').val();
			var intCantidad = $('#txtCantidad_detalles_refacciones_kits_refacciones').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_refacciones_kits_refacciones').val();
			var intPorcentajeIva = $('#txtPorcentajeIva_detalles_refacciones_kits_refacciones').val();
			var intPorcentajeIeps = $('#txtPorcentajeIeps_detalles_refacciones_kits_refacciones').val();
			var strLinea = $('#txtRefaccionesLinea_detalles_refacciones_kits_refacciones').val();
			var strMoneda = $('#txtMoneda_detalles_refacciones_kits_refacciones').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_refacciones_kits_refacciones').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intRefaccionID == '' || strRefaccion == '')
			{
				//Enfocar caja de texto
				$('#txtRefaccion_detalles_refacciones_kits_refacciones').focus();
			}
			else if (intCantidad == '')
			{
				//Enfocar caja de texto
				$('#txtCantidad_detalles_refacciones_kits_refacciones').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_refacciones_kits_refacciones').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_detalles_refacciones_kits_refacciones').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_refacciones_kits_refacciones').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtRefaccionID_detalles_refacciones_kits_refacciones').val('');
				$('#txtRefaccion_detalles_refacciones_kits_refacciones').val('');
				$('#txtCantidad_detalles_refacciones_kits_refacciones').val('');
				$('#txtPorcentajeDescuento_detalles_refacciones_kits_refacciones').val('');
				//Hacer un llamado a la función para inicializar elementos de la refacción
                inicializar_refaccion_detalles_refacciones_kits_refacciones();


				//Convertir cadena de texto a número decimal
				intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
				intSubtotal =  parseFloat($.reemplazar(intPrecioUnitario, ",", ""));

				//Si existe porcentaje de descuento
				if(intPorcentajeDescuento > 0)
				{
					intDescuentoUnitario = parseFloat(intSubtotal * intPorcentajeDescuento) / 100;
					intSubtotal = intSubtotal - intDescuentoUnitario;
				}

				//Calcular subtotal
				intSubtotal = intCantidad * intSubtotal;
				
				//Calcular importe de IVA
				intImporteIva = parseFloat(intSubtotal * intPorcentajeIva);

				//Si existe porcentaje de IEPS
				if(intPorcentajeIeps != '')
				{
					//Calcular importe de IEPS
					intImporteIeps = parseFloat(intSubtotal * intPorcentajeIeps);
				}
			
				//Calcular importe total
				intTotal = intSubtotal + intImporteIva + intImporteIeps;

				//Cambiar cantidad a  formato moneda (a visualizar)
				intCantidad =  formatMoney(intCantidad, 2, '');
				intDescuentoUnitario = formatMoney(intDescuentoUnitario, 2, '');
				intSubtotal = formatMoney(intSubtotal, 2, '');
				intImporteIva = formatMoney(intImporteIva, 2, '');	
				intImporteIeps = formatMoney(intImporteIeps, 2, '');
				intTotal = formatMoney(intTotal, 2, '');
				intPorcentajeDescuento = formatMoney(intPorcentajeDescuento, 2, '');

				//Revisamos si existe el ID proporcionado, si es así, editamos los datos
				if (objTabla.rows.namedItem(intRefaccionID))
				{
					objTabla.rows.namedItem(intRefaccionID).cells[1].innerHTML = intCantidad;
					objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML =  intPrecioUnitario;
					objTabla.rows.namedItem(intRefaccionID).cells[3].innerHTML =  intDescuentoUnitario;
					objTabla.rows.namedItem(intRefaccionID).cells[4].innerHTML =  intSubtotal;
					objTabla.rows.namedItem(intRefaccionID).cells[5].innerHTML = intImporteIva;
					objTabla.rows.namedItem(intRefaccionID).cells[6].innerHTML = intImporteIeps;
					objTabla.rows.namedItem(intRefaccionID).cells[7].innerHTML = intTotal;
					objTabla.rows.namedItem(intRefaccionID).cells[9].innerHTML = intPorcentajeDescuento;
					objTabla.rows.namedItem(intRefaccionID).cells[10].innerHTML = intPorcentajeIva;
					objTabla.rows.namedItem(intRefaccionID).cells[11].innerHTML = intPorcentajeIeps;
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaRefaccion = objRenglon.insertCell(0);
					var objCeldaCantidad = objRenglon.insertCell(1);
					var objCeldaPrecio = objRenglon.insertCell(2);
					var objCeldaDescuento = objRenglon.insertCell(3);
					var objCeldaSubtotal = objRenglon.insertCell(4);
					var objCeldaIvaUnitario = objRenglon.insertCell(5);
					var objCeldaIepsUnitario = objRenglon.insertCell(6);
					var objCeldaTotal = objRenglon.insertCell(7);
					var objCeldaAcciones = objRenglon.insertCell(8);
					//Columnas ocultas
					var objCeldaPorcentajeDescuento = objRenglon.insertCell(9);
					var objCeldaPorcentajeIva = objRenglon.insertCell(10);
					var objCeldaPorcentajeIeps = objRenglon.insertCell(11);
					var objCeldaLinea = objRenglon.insertCell(12);
					var objCeldaMoneda = objRenglon.insertCell(13);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRefaccionID);
					objCeldaRefaccion.setAttribute('class', 'movil b1');
					objCeldaRefaccion.innerHTML = strRefaccion;
					objCeldaCantidad.setAttribute('class', 'movil b2');
					objCeldaCantidad.innerHTML = intCantidad;
					objCeldaPrecio.setAttribute('class', 'movil b3');
					objCeldaPrecio.innerHTML = intPrecioUnitario;
					objCeldaDescuento.setAttribute('class', 'movil b4');
					objCeldaDescuento.innerHTML = intDescuentoUnitario;
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
												 " onclick='editar_renglon_detalles_refacciones_kits_refacciones(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_refacciones_kits_refacciones(this)'>" + 
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
					objCeldaLinea.setAttribute('class', 'no-mostrar');
					objCeldaLinea.innerHTML = strLinea;
					objCeldaMoneda.setAttribute('class', 'no-mostrar');
					objCeldaMoneda.innerHTML = strMoneda;

				}

				//Hacer un llamado a la función para calcular totales de la tabla
				calcular_totales_detalles_refacciones_kits_refacciones();
				
				//Enfocar caja de texto
				$('#txtRefaccion_detalles_refacciones_kits_refacciones').focus();
			}

			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_refacciones_kits_refacciones tr").length - 2;
			$('#numElementos_detalles_refacciones_kits_refacciones').html(intFilas);
			$('#txtNumDetalles_refacciones_kits_refacciones').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_refacciones_kits_refacciones(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRefaccionID_detalles_refacciones_kits_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtRefaccion_detalles_refacciones_kits_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtCantidad_detalles_refacciones_kits_refacciones').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
			$('#txtPrecio_detalles_refacciones_kits_refacciones').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
			$('#txtPorcentajeDescuento_detalles_refacciones_kits_refacciones').val(objRenglon.parentNode.parentNode.cells[9].innerHTML);
			$('#txtPorcentajeIva_detalles_refacciones_kits_refacciones').val(objRenglon.parentNode.parentNode.cells[10].innerHTML);
			$('#txtPorcentajeIeps_detalles_refacciones_kits_refacciones').val(objRenglon.parentNode.parentNode.cells[11].innerHTML);
			$('#txtRefaccionesLinea_detalles_refacciones_kits_refacciones').val(objRenglon.parentNode.parentNode.cells[12].innerHTML);
			$('#txtMoneda_detalles_refacciones_kits_refacciones').val(objRenglon.parentNode.parentNode.cells[13].innerHTML);

			//Enfocar caja de texto
			$('#txtRefaccion_detalles_refacciones_kits_refacciones').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_refacciones_kits_refacciones(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_refacciones_kits_refacciones").deleteRow(intRenglon);

			//Hacer un llamado a la función para calcular totales de la tabla
			calcular_totales_detalles_refacciones_kits_refacciones();
			
			//Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
			var intFilas = $("#dg_detalles_refacciones_kits_refacciones tr").length - 2;
			$('#numElementos_detalles_refacciones_kits_refacciones').html(intFilas);
			$('#txtNumDetalles_refacciones_kits_refacciones').val(intFilas);

			//Enfocar caja de texto
			$('#txtRefaccion_detalles_refacciones_kits_refacciones').focus();
		}

		//Función para calcular totales de la tabla
		function calcular_totales_detalles_refacciones_kits_refacciones()
		{
			//Obtenemos el objeto de la tabla 
			var objTabla = document.getElementById('dg_detalles_refacciones_kits_refacciones').getElementsByTagName('tbody')[0];

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
				intAcumUnidades += parseFloat($.reemplazar(objRen.cells[1].innerHTML, ",", ""));
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				intAcumDescuento += parseFloat($.reemplazar(objRen.cells[3].innerHTML, ",", ""));
				intAcumSubtotal += parseFloat($.reemplazar(objRen.cells[4].innerHTML, ",", ""));
				intAcumIva += parseFloat($.reemplazar(objRen.cells[5].innerHTML, ",", ""));
				intAcumIeps += parseFloat($.reemplazar(objRen.cells[6].innerHTML, ",", ""));
				intAcumTotal += parseFloat($.reemplazar(objRen.cells[7].innerHTML, ",", ""));

			}

			//Convertir total de unidades a 2 decimales
			intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

			//Convertir cantidad a formato moneda
			intAcumDescuento =  '$'+formatMoney(intAcumDescuento, 2, '');
			intAcumSubtotal =  '$'+formatMoney(intAcumSubtotal, 2, '');
			intAcumIva =  '$'+formatMoney(intAcumIva, 2, '');
			intAcumIeps =  '$'+formatMoney(intAcumIeps, 2, '');
			intAcumTotal =  '$'+formatMoney(intAcumTotal, 2, '');

			//Asignar los valores
			$('#acumCantidad_detalles_refacciones_kits_refacciones').html(intAcumUnidades);
			$('#acumDescuento_detalles_refacciones_kits_refacciones').html(intAcumDescuento);
			$('#acumSubtotal_detalles_refacciones_kits_refacciones').html(intAcumSubtotal);
			$('#acumIva_detalles_refacciones_kits_refacciones').html(intAcumIva);
			$('#acumIeps_detalles_refacciones_kits_refacciones').html(intAcumIeps);
			$('#acumTotal_detalles_refacciones_kits_refacciones').html(intAcumTotal);
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtCantidad_detalles_refacciones_kits_refacciones').numeric();
			$('#txtPorcentajeDescuento_detalles_refacciones_kits_refacciones').numeric();

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
			 * por ejemplo: 10 será 10.00*/
			$('.moneda_refacciones_kits_refacciones').blur(function(){
				$('.moneda_refacciones_kits_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
			});

			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo_refacciones_kits_refacciones').focusout(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_refacciones_kits_refacciones();
			});


			//Autocomplete para recuperar los datos de una refacción
	        $('#txtRefaccion_detalles_refacciones_kits_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtRefaccionID_detalles_refacciones_kits_refacciones').val('');
	                 //Hacer un llamado a la función para inicializar elementos de la refacción
                	 inicializar_refaccion_detalles_refacciones_kits_refacciones();
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones/autocomplete",
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
	                $('#txtRefaccionID_detalles_refacciones_kits_refacciones').val(ui.item.data);
	                //Hacer un llamado a la función para regresar los datos de la refacción
	               	get_datos_refaccion_detalles_refacciones_kits_refacciones();
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
	        $('#txtRefaccion_detalles_refacciones_kits_refacciones').focusout(function(e){
	            //Si no existe id de la refacción
	            if($('#txtRefaccionID_detalles_refacciones_kits_refacciones').val() == '' ||
	               $('#txtRefaccion_detalles_refacciones_kits_refacciones').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtRefaccionID_detalles_refacciones_kits_refacciones').val('');
	                $('#txtRefaccion_detalles_refacciones_kits_refacciones').val('');
	                //Hacer un llamado a la función para inicializar elementos de la refacción
                	inicializar_refaccion_detalles_refacciones_kits_refacciones();
	            }

	        });

			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_refacciones_kits_refacciones').on('click','button.btn',function(){
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

			//Validar que exista refacción cuando se pulse la tecla enter 
			$('#txtRefaccion_detalles_refacciones_kits_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe refacción
		            if($('#txtRefaccionID_detalles_refacciones_kits_refacciones').val() == '' || $('#txtRefaccion_detalles_refacciones_kits_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtRefaccion_detalles_refacciones_kits_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtCantidad_detalles_refacciones_kits_refacciones').focus();
			   	    }
		        }
		    });

			//Validar que exista cantidad cuando se pulse la tecla enter 
			$('#txtCantidad_detalles_refacciones_kits_refacciones').on('keypress', function (e) {
				if(e.which === 13 )
				{
					//Si no existe cantidad
					if($('#txtCantidad_detalles_refacciones_kits_refacciones').val() == '')
					{
						//Enfocar caja de texto
						$('#txtCantidad_detalles_refacciones_kits_refacciones').focus();
					}
					else
					{
						//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_refacciones_kits_refacciones').focus();
					}
				}
			});

			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_refacciones_kits_refacciones').on('keypress', function (e) {
				if(e.which === 13 )
				{
					//Si no existe procentaje del descuento
					if($('#txtPorcentajeDescuento_detalles_refacciones_kits_refacciones').val() == '')
					{
						//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_refacciones_kits_refacciones').focus();
					}
					else
					{
						//Hacer un llamado a la función para agregar renglón a la tabla
						agregar_renglon_detalles_refacciones_kits_refacciones();
					}
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_refacciones_kits_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaRefaccionesKitsRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_refacciones_kits_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_refacciones_kits_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_refacciones_kits_refacciones();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_refacciones_kits_refacciones').addClass("estatus-NUEVO");
				//Abrir modal
				 objRefaccionesKitsRefacciones = $('#RefaccionesKitsRefaccionesBox').bPopup({
												   appendTo: '#RefaccionesKitsRefaccionesContent', 
												   contentContainer: 'RefaccionesKitsRefaccionesM', 
												   zIndex: 2, 
												   modalClose: false, 
												   modal: true, 
												   follow: [true,false], 
												   followEasing : "linear", 
												   easing: "linear", 
												   modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_refacciones_kits_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_refacciones_kits_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_refacciones_kits_refacciones();
		});
	</script>