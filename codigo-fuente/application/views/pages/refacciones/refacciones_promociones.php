	<div id="RefaccionesPromocionesRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_refacciones_promociones_refacciones" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_refacciones_promociones_refacciones" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_refacciones_promociones_refacciones">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_refacciones_promociones_refacciones'>
				                    <input class="form-control" id="txtFechaInicialBusq_refacciones_promociones_refacciones"
				                    		name= "strFechaInicialBusq_refacciones_promociones_refacciones" 
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
								<label for="txtFechaFinalBusq_refacciones_promociones_refacciones">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_refacciones_promociones_refacciones'>
				                    <input class="form-control" id="txtFechaFinalBusq_refacciones_promociones_refacciones"
				                    		name= "strFechaFinalBusq_refacciones_promociones_refacciones" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Combobox que contiene las sucursales activas-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="cmbSucursalIDBusq_refacciones_promociones_refacciones">Sucursal</label>
							</div>
							<div class="col-md-12">
								<select class="form-control" id="cmbSucursalIDBusq_refacciones_promociones_refacciones" 
								 		name="intSucursalIDBusq_refacciones_promociones_refacciones" tabindex="1">
                 				</select>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_refacciones_promociones_refacciones"
									onclick="paginacion_refacciones_promociones_refacciones();" 
									title="Buscar coincidencias" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_refacciones_promociones_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_refacciones_promociones_refacciones"
									onclick="reporte_refacciones_promociones_refacciones('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_refacciones_promociones_refacciones"
									onclick="reporte_refacciones_promociones_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button>
						</div>
					</div>
			    </div>
			   <div class="row">
					<!--Mostrar detalles de los registros en el reporte PDF--> 
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="checkbox">
	                    	<label id="label-checkbox">
	                        	<input class="form-control" id="chbImprimirDetalles_refacciones_promociones_refacciones" 
									   name="strImprimirDetalles_refacciones_promociones_refacciones" type="checkbox"
									   value="" tabindex="1">
								</input>
								<span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Imprimir detalles
	                    	</label>
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
				Definir columnas de la tabla promociones
				*/
				td.movil.a1:nth-of-type(1):before {content: "Fecha inicial"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha final"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Sucursal"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles de la promoción
				*/
				td.movil.b1:nth-of-type(1):before {content: "Referencia"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Descuento"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_refacciones_promociones_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Fecha inicial</th>
							<th class="movil">Fecha final</th>
							<th class="movil">Sucursal</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_refacciones_promociones_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{fecha_inicio}}</td>
							<td class="movil a2">{{fecha_final}}</td>
							<td class="movil a3">{{sucursal}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_refacciones_promociones_refacciones({{refaccion_promocion_id}});"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										 onclick="editar_refacciones_promociones_refacciones({{refaccion_promocion_id}});"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_refacciones_promociones_refacciones({{refaccion_promocion_id}},'{{estatus}}');" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_refacciones_promociones_refacciones({{refaccion_promocion_id}},'{{estatus}}');"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_refacciones_promociones_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_refacciones_promociones_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal -->
		<div id="RefaccionesPromocionesRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_refacciones_promociones_refacciones"  class="ModalBodyTitle">
			<h1>Promociones</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRefaccionesPromocionesRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmRefaccionesPromocionesRefacciones"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
						<!--Fecha inicial-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtRefaccionPromocionID_refacciones_promociones_refacciones" 
										   name="intRefaccionPromocionID_refacciones_promociones_refacciones" type="hidden" value="">
									</input>
									<label for="txtFechaInicio_refacciones_promociones_refacciones">Fecha inicial</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaInicio_refacciones_promociones_refacciones'>
					                    <input class="form-control" id="txtFechaInicio_refacciones_promociones_refacciones"
					                    		name= "strFechaInicio_refacciones_promociones_refacciones" 
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
									<label for="txtFechaFinal_refacciones_promociones_refacciones">Fecha final</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFechaFinal_refacciones_promociones_refacciones'>
					                    <input class="form-control" id="txtFechaFinal_refacciones_promociones_refacciones"
					                    		name= "strFechaFinal_refacciones_promociones_refacciones" 
					                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Combobox que contiene las sucursales activas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbSucursalID_refacciones_promociones_refacciones">Sucursal</label>
								</div>
								<div  class="col-md-12">
									<select class="form-control" id="cmbSucursalID_refacciones_promociones_refacciones" 
									 		name="intSucursalID_refacciones_promociones_refacciones" tabindex="1">
	                 				</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
									<input id="txtNumDetalles_refacciones_promociones_refacciones" 
										   name="intNumDetalles_refacciones_promociones_refacciones" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Refacciones en promoción</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene las referencias activas-->
													<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id de la referencia seleccionada-->
																<input id="txtReferenciaID_detalles_refacciones_promociones_refacciones" 
																	   name="intReferenciaID_detalles_refacciones_promociones_refacciones"  
																	   type="hidden" value="">
															    </input>
															    <!-- Caja de texto oculta que se utiliza para recuperar el tipo de la referencia seleccionada-->
																<input id="txtTipoReferencia_detalles_refacciones_promociones_refacciones" 
																	   name="strTipoReferencia_detalles_refacciones_promociones_refacciones"  
																	   type="hidden" value="">
															    </input>
																<label for="txtReferencia_detalles_refacciones_promociones_refacciones">
																	Referencia
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtReferencia_detalles_refacciones_promociones_refacciones" 
																		name="strReferencia_detalles_refacciones_promociones_refacciones" type="text" value="" 
																		tabindex="1" placeholder="Ingrese referencia" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje del descuento-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones">Descuento %</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_refacciones_promociones_refacciones" id="txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones" 
																		name="intPorcentajeDescuento_detalles_refacciones_promociones_refacciones" type="text" value="" 
																		tabindex="1" placeholder="Ingrese descuento" maxlength="8">
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
														<button class="btn btn-primary btn-toolBtns" 
																id="btnAgregar_refacciones_promociones_refacciones"
																onclick="agregar_renglon_detalles_refacciones_promociones_refacciones();" 
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
													<table class="table-hover movil" id="dg_detalles_refacciones_promociones_refacciones">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Referencia</th>
																<th class="movil">Descuento</th>
																<th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
													</table>
													<br>
													<div class="row">
														<!--Número de registros encontrados-->
														<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
															<button class="btn btn-default btn-sm disabled pull-right">
																<strong id="numElementos_detalles_refacciones_promociones_refacciones">0</strong> encontrados
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
							<button class="btn btn-success" id="btnGuardar_refacciones_promociones_refacciones"  
									onclick="validar_refacciones_promociones_refacciones();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_refacciones_promociones_refacciones"  
									onclick="cambiar_estatus_refacciones_promociones_refacciones('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_refacciones_promociones_refacciones"  
									onclick="cambiar_estatus_refacciones_promociones_refacciones('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_refacciones_promociones_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_refacciones_promociones_refacciones();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#RefaccionesPromocionesRefaccionesContent -->

	<!-- /.Plantilla para cargar las sucursales en el combobox-->  
	<script id="sucursales_refacciones_promociones_refacciones" type="text/template">
		<option value="">TODAS</option>
		{{#sucursales}}
		<option value="{{value}}">{{nombre}}</option>
		{{/sucursales}} 
	</script>
	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaRefaccionesPromocionesRefacciones = 0;
		var strUltimaBusquedaRefaccionesPromocionesRefacciones = "";
		//Variable que se utiliza para asignar objeto del modal
		var objRefaccionesPromocionesRefacciones = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_refacciones_promociones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/refacciones_promociones/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_refacciones_promociones_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRefaccionesPromocionesRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosRefaccionesPromocionesRefacciones = strPermisosRefaccionesPromocionesRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRefaccionesPromocionesRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRefaccionesPromocionesRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_refacciones_promociones_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosRefaccionesPromocionesRefacciones[i]=='GUARDAR') || (arrPermisosRefaccionesPromocionesRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_refacciones_promociones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesPromocionesRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_refacciones_promociones_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_refacciones_promociones_refacciones();
						}
						else if(arrPermisosRefaccionesPromocionesRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_refacciones_promociones_refacciones').removeAttr('disabled');
							$('#btnRestaurar_refacciones_promociones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesPromocionesRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_refacciones_promociones_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesPromocionesRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_refacciones_promociones_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_refacciones_promociones_refacciones() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaRefaccionesPromocionesRefacciones =($('#txtFechaInicialBusq_refacciones_promociones_refacciones').val()+$('#txtFechaFinalBusq_refacciones_promociones_refacciones').val()+$('#cmbSucursalIDBusq_refacciones_promociones_refacciones').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaRefaccionesPromocionesRefacciones != strUltimaBusquedaRefaccionesPromocionesRefacciones)
			{
				intPaginaRefaccionesPromocionesRefacciones = 0;
				strUltimaBusquedaRefaccionesPromocionesRefacciones = strNuevaBusquedaRefaccionesPromocionesRefacciones;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/refacciones_promociones/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					    dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_refacciones_promociones_refacciones').val()),
					    dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_refacciones_promociones_refacciones').val()),
					    intSucursalID: $('#cmbSucursalIDBusq_refacciones_promociones_refacciones').val(),
						intPagina:intPaginaRefaccionesPromocionesRefacciones,
						strPermisosAcceso: $('#txtAcciones_refacciones_promociones_refacciones').val()
					},
					function(data){
						$('#dg_refacciones_promociones_refacciones tbody').empty();
						var tmpRefaccionesPromocionesRefacciones = Mustache.render($('#plantilla_refacciones_promociones_refacciones').html(),data);
						$('#dg_refacciones_promociones_refacciones tbody').html(tmpRefaccionesPromocionesRefacciones);
						$('#pagLinks_refacciones_promociones_refacciones').html(data.paginacion);
						$('#numElementos_refacciones_promociones_refacciones').html(data.total_rows);
						intPaginaRefaccionesPromocionesRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_refacciones_promociones_refacciones(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/refacciones_promociones/';

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
			if ($('#chbImprimirDetalles_refacciones_promociones_refacciones').is(':checked')) {
			    //Asignar SI para incluir detalles en el reporte
			    $('#chbImprimirDetalles_refacciones_promociones_refacciones').val('SI');
			}
			else
			{ 
			   //Asignar NO para  no incluir detalles en el reporte
			   $('#chbImprimirDetalles_refacciones_promociones_refacciones').val('NO');
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'dteFechaInicial': $.formatFechaMysql($('#txtFechaInicialBusq_refacciones_promociones_refacciones').val()),
										'dteFechaFinal': $.formatFechaMysql($('#txtFechaFinalBusq_refacciones_promociones_refacciones').val()),
										'intSucursalID': $('#cmbSucursalIDBusq_refacciones_promociones_refacciones').val(), 
										'strDetalles': $('#chbImprimirDetalles_refacciones_promociones_refacciones').val()
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}

		

		//Regresar monedas activas para cargarlas en el combobox del formulario de búsqueda
		function cargar_sucursales_busqueda_refacciones_promociones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box', {},
				function(data)
				{
					$('#cmbSucursalIDBusq_refacciones_promociones_refacciones').empty();
					var temp = Mustache.render($('#sucursales_refacciones_promociones_refacciones').html(), data);
					$('#cmbSucursalIDBusq_refacciones_promociones_refacciones').html(temp);
				},
				'json');
		}

		//Regresar monedas activas para cargarlas en el combobox del modal
		function cargar_sucursales_refacciones_promociones_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box', {},
				function(data)
				{
					$('#cmbSucursalID_refacciones_promociones_refacciones').empty();
					var temp = Mustache.render($('#sucursales_refacciones_promociones_refacciones').html(), data);
					$('#cmbSucursalID_refacciones_promociones_refacciones').html(temp);
				},
				'json');
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_refacciones_promociones_refacciones()
		{
			//Incializar formulario
			$('#frmRefaccionesPromocionesRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_promociones_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmRefaccionesPromocionesRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_refacciones_promociones_refacciones');
			//Eliminar los datos de la tabla detalles de la promoción
			$('#dg_detalles_refacciones_promociones_refacciones tbody').empty();
			$('#numElementos_detalles_refacciones_promociones_refacciones').html(0);
			//Habilitar todos los elementos del formulario
			$('#frmRefaccionesPromocionesRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar los siguientes botones
			$("#btnGuardar_refacciones_promociones_refacciones").show();
			//Habilitar botón Agregar
			$('#btnAgregar_refacciones_promociones_refacciones').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnDesactivar_refacciones_promociones_refacciones").hide();
			$("#btnRestaurar_refacciones_promociones_refacciones").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_refacciones_promociones_refacciones()
		{
			try {
				//Cerrar modal
				objRefaccionesPromocionesRefacciones.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_refacciones_promociones_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_refacciones_promociones_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_promociones_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmRefaccionesPromocionesRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
										valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFechaInicio_refacciones_promociones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strFechaFinal_refacciones_promociones_refacciones: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										intNumDetalles_refacciones_promociones_refacciones: {
											validators: {
												callback: {
													callback: function(value, validator, $field) {
														//Verificar que existan detalles
														if(parseInt(value) === 0 || value === '')
														{
															return {
																valid: false,
																message: 'Agregar al menos una referencia para esta promoción.'
															};
														}
														return true;
													}
												}
											}
										},
										strReferencia_detalles_refacciones_promociones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeDescuento_detalles_refacciones_promociones_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_refacciones_promociones_refacciones = $('#frmRefaccionesPromocionesRefacciones').data('bootstrapValidator');
			bootstrapValidator_refacciones_promociones_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_refacciones_promociones_refacciones.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_refacciones_promociones_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_refacciones_promociones_refacciones()
		{
			try
			{
				$('#frmRefaccionesPromocionesRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_refacciones_promociones_refacciones()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_refacciones_promociones_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrTipos = [];
			var arrReferenciaID = [];
			var arrDescuentos = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intDescuento = $.reemplazar(objRen.cells[1].innerHTML, "%", "");
				
				//Asignar valores a los arrays
				arrTipos.push(objRen.cells[3].innerHTML);
				arrReferenciaID.push(objRen.cells[4].innerHTML);
				arrDescuentos.push(intDescuento);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/refacciones_promociones/guardar',
					{ 
						//Datos de la promoción
						intRefaccionPromocionID: $('#txtRefaccionPromocionID_refacciones_promociones_refacciones').val(),
						//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicio: $.formatFechaMysql($('#txtFechaInicio_refacciones_promociones_refacciones').val()),
						dteFechaFinal:  $.formatFechaMysql($('#txtFechaFinal_refacciones_promociones_refacciones').val()),
						intSucursalID: $('#cmbSucursalID_refacciones_promociones_refacciones').val(),
						//Datos de los detalles
						strTipos: arrTipos.join('|'),
						strReferenciaID: arrReferenciaID.join('|'),
						strDescuentos: arrDescuentos.join('|')
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_refacciones_promociones_refacciones();
							//Hacer un llamado a la función para cerrar modal
							cerrar_refacciones_promociones_refacciones();  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_refacciones_promociones_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_refacciones_promociones_refacciones(tipoMensaje, mensaje)
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
		function cambiar_estatus_refacciones_promociones_refacciones(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtRefaccionPromocionID_refacciones_promociones_refacciones').val();

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
									  'title':    'Promociones',
									  'buttons':  ['Aceptar', 'Cancelar'],
									  'onClose':  function(caption) {
													if(caption == 'Aceptar')
													{
													  //Hacer un llamado a la función para modificar el estatus del registro
													  set_estatus_refacciones_promociones_refacciones(intID, strTipo, 'INACTIVO');
													}
												  }
									  });
			}
			else//Si el estatus del registro es INACTIVO
			{
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_refacciones_promociones_refacciones(intID, strTipo, 'ACTIVO');
			}
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_refacciones_promociones_refacciones(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('refacciones/refacciones_promociones/set_estatus',
			      {intRefaccionPromocionID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_refacciones_promociones_refacciones();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_refacciones_promociones_refacciones();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_refacciones_promociones_refacciones(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_refacciones_promociones_refacciones(id)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/refacciones_promociones/get_datos',
				   {intRefaccionPromocionID:id
				   },
				   function(data) {
						//Si hay datos del registro
						if(data.row)
						{
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_refacciones_promociones_refacciones();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				            
							//Recuperar valores
							$('#txtRefaccionPromocionID_refacciones_promociones_refacciones').val(data.row.refaccion_promocion_id);
							$('#txtFechaInicio_refacciones_promociones_refacciones').val(data.row.fecha_inicio);
							$('#txtFechaFinal_refacciones_promociones_refacciones').val(data.row.fecha_final);
							$('#cmbSucursalID_refacciones_promociones_refacciones').val(data.row.sucursal_id);
							//Dependiendo del estatus cambiar el color del encabezado 
							$('#divEncabezadoModal_refacciones_promociones_refacciones').addClass("estatus-"+strEstatus);

							//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
												   " onclick='editar_renglon_detalles_refacciones_promociones_refacciones(this)'>" + 
												   "<span class='glyphicon glyphicon-edit'></span></button>" + 
												   "<button class='btn btn-default btn-xs' title='Eliminar'" +
												   " onclick='eliminar_renglon_detalles_refacciones_promociones_refacciones(this)'>" + 
												   "<span class='glyphicon glyphicon-trash'></span></button>" + 
												   "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												   "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												   "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												   "<span class='glyphicon glyphicon-arrow-down'></span></button>";

								//Mostrar botón Desactivar
				            	$("#btnDesactivar_refacciones_promociones_refacciones").show();
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
			            		$('#frmRefaccionesPromocionesRefacciones').find('input, textarea, select').attr('disabled','disabled');
			            		//Deshabilitar botón Agregar
								$('#btnAgregar_refacciones_promociones_refacciones').prop('disabled', true);
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_refacciones_promociones_refacciones").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_refacciones_promociones_refacciones").show();
							}


							//Mostramos los detalles del registro
							for (var intCon in data.detalles) 
							{
								//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_refacciones_promociones_refacciones').getElementsByTagName('tbody')[0];

								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaReferencia = objRenglon.insertCell(0);
								var objCeldaPorcentajeDescuento = objRenglon.insertCell(1);
								var objCeldaAcciones = objRenglon.insertCell(2);
								//Columnas ocultas
								var objCeldaTipoReferencia = objRenglon.insertCell(3);
								var objCeldaReferenciaID = objRenglon.insertCell(4);

								//Variable que se utiliza para asignar el id del detalle
							    var strDetalleID = data.detalles[intCon].referencia_id+'_'+data.detalles[intCon].tipo;


								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', strDetalleID);
								objCeldaReferencia.setAttribute('class', 'movil b1');
								objCeldaReferencia.innerHTML = data.detalles[intCon].referencia;
								objCeldaPorcentajeDescuento.setAttribute('class', 'movil b2');
								objCeldaPorcentajeDescuento.innerHTML = formatMoney(data.detalles[intCon].descuento, 2, '')+'%';
								objCeldaAcciones.setAttribute('class', 'td-center movil b3');
								objCeldaAcciones.innerHTML =  strAccionesTabla;
								objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
								objCeldaTipoReferencia.innerHTML = data.detalles[intCon].tipo;
								objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
								objCeldaReferenciaID.innerHTML = data.detalles[intCon].referencia_id;
							}

							//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
							var intFilas = $("#dg_detalles_refacciones_promociones_refacciones tr").length - 1;
							$('#numElementos_detalles_refacciones_promociones_refacciones').html(intFilas);
							$('#txtNumDetalles_refacciones_promociones_refacciones').val(intFilas);
							

							//Abrir modal
							objRefaccionesPromocionesRefacciones = $('#RefaccionesPromocionesRefaccionesBox').bPopup({
														  appendTo: '#RefaccionesPromocionesRefaccionesContent', 
														  contentContainer: 'RefaccionesPromocionesRefaccionesM', 
														  zIndex: 2, 
														  modalClose: false, 
														  modal: true, 
														  follow: [true,false], 
														  followEasing : "linear", 
														  easing: "linear", 
														  modalColor: ('#F0F0F0')});

							//Enfocar caja de texto
							$('#txtFechaInicio_refacciones_promociones_refacciones').focus();
						}
				   },
				   'json');
		}

		

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_refacciones_promociones_refacciones()
		{
			//Obtenemos los datos de las cajas de texto
			var intReferenciaID = $('#txtReferenciaID_detalles_refacciones_promociones_refacciones').val();
			var strReferencia = $('#txtReferencia_detalles_refacciones_promociones_refacciones').val();
			var strTipoReferencia = $('#txtTipoReferencia_detalles_refacciones_promociones_refacciones').val();
			var intPorcentajeDescuento = $('#txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones').val();
			//Variable que se utiliza para asignar el id del detalle
			var strDetalleID = intReferenciaID+'_'+strTipoReferencia;

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_refacciones_promociones_refacciones').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intReferenciaID == '' || strReferencia == '')
			{
				//Enfocar caja de texto
				$('#txtReferencia_detalles_refacciones_promociones_refacciones').focus();
			}
			else if (intPorcentajeDescuento == '')
			{
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones').focus();
			}
			else if (parseFloat($.reemplazar(intPorcentajeDescuento, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtReferenciaID_detalles_refacciones_promociones_refacciones').val('');
				$('#txtReferencia_detalles_refacciones_promociones_refacciones').val('');
				$('#txtTipoReferencia_detalles_refacciones_promociones_refacciones').val('');
				$('#txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones').val('');

				//Cambiar cantidad a  formato moneda (a visualizar)
				intPorcentajeDescuento = formatMoney(intPorcentajeDescuento, 2, '')+'%';

				//Revisamos si existe el ID proporcionado, si es así, editamos los datos
				if (objTabla.rows.namedItem(strDetalleID))
				{
					objTabla.rows.namedItem(strDetalleID).cells[1].innerHTML = intPorcentajeDescuento;
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaReferencia = objRenglon.insertCell(0);
					var objCeldaPorcentajeDescuento = objRenglon.insertCell(1);
					var objCeldaAcciones = objRenglon.insertCell(2);
					//Columnas ocultas
					var objCeldaTipoReferencia = objRenglon.insertCell(3);
					var objCeldaReferenciaID = objRenglon.insertCell(4);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', strDetalleID);
					objCeldaReferencia.setAttribute('class', 'movil b1');
					objCeldaReferencia.innerHTML = strReferencia;
					objCeldaPorcentajeDescuento.setAttribute('class', 'movil b2');
					objCeldaPorcentajeDescuento.innerHTML = intPorcentajeDescuento;
					objCeldaAcciones.setAttribute('class', 'td-center movil b3');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_refacciones_promociones_refacciones(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_refacciones_promociones_refacciones(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
					objCeldaTipoReferencia.setAttribute('class', 'no-mostrar');
					objCeldaTipoReferencia.innerHTML = strTipoReferencia; 
					objCeldaReferenciaID.setAttribute('class', 'no-mostrar');
					objCeldaReferenciaID.innerHTML = intReferenciaID; 
					
				}

				//Enfocar caja de texto
				$('#txtReferencia_detalles_refacciones_promociones_refacciones').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_detalles_refacciones_promociones_refacciones tr").length - 1;
			$('#numElementos_detalles_refacciones_promociones_refacciones').html(intFilas);
			$('#txtNumDetalles_refacciones_promociones_refacciones').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_refacciones_promociones_refacciones(objRenglon)
		{
			//Variable que se utiliza para asignar el porcentaje del descuento
			var intPorcentajeDescuento = $.reemplazar(objRenglon.parentNode.parentNode.cells[1].innerHTML, "%", "");
			
			//Asignar los valores a las cajas de texto
			$('#txtReferenciaID_detalles_refacciones_promociones_refacciones').val(objRenglon.parentNode.parentNode.cells[4].innerHTML);
			$('#txtReferencia_detalles_refacciones_promociones_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones').val(intPorcentajeDescuento);
			$('#txtTipoReferencia_detalles_refacciones_promociones_refacciones').val(objRenglon.parentNode.parentNode.cells[3].innerHTML);
			
			//Enfocar caja de texto
			$('#txtReferencia_detalles_refacciones_promociones_refacciones').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_refacciones_promociones_refacciones(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_refacciones_promociones_refacciones").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_detalles_refacciones_promociones_refacciones tr").length - 1;
			$('#numElementos_detalles_refacciones_promociones_refacciones').html(intFilas);
			$('#txtNumDetalles_refacciones_promociones_refacciones').val(intFilas);

			//Enfocar caja de texto
			$('#txtReferencia_detalles_refacciones_promociones_refacciones').focus();
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones').numeric();
			
			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
			 * por ejemplo: 10 será 10.00*/
			$('.moneda_refacciones_promociones_refacciones').blur(function(){
				$('.moneda_refacciones_promociones_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
			});

			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicio_refacciones_promociones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinal_refacciones_promociones_refacciones').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicio_refacciones_promociones_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinal_refacciones_promociones_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinal_refacciones_promociones_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicio_refacciones_promociones_refacciones').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de una refacción, kit, línea o marca
	        $('#txtReferencia_detalles_refacciones_promociones_refacciones').autocomplete({
	              source: function( request, response ) {
	              	 //Limpiar caja de texto que hace referencia al id del registro 
	                 $('#txtReferenciaID_detalles_refacciones_promociones_refacciones').val('');
	                 $('#txtTipoReferencia_detalles_refacciones_promociones_refacciones').val('');
	                 $.ajax({
	                   //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                   url: "refacciones/refacciones_promociones/autocomplete",
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
	                $('#txtReferenciaID_detalles_refacciones_promociones_refacciones').val(ui.item.data);
	                $('#txtTipoReferencia_detalles_refacciones_promociones_refacciones').val(ui.item.tipo_referencia);
	              
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
	        $('#txtReferencia_detalles_refacciones_promociones_refacciones').focusout(function(e){
	            //Si no existe id de la referencia
	            if($('#txtReferenciaID_detalles_refacciones_promociones_refacciones').val() == '' ||
	               $('#txtReferencia_detalles_refacciones_promociones_refacciones').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtReferenciaID_detalles_refacciones_promociones_refacciones').val('');
	                $('#txtReferencia_detalles_refacciones_promociones_refacciones').val('');
	                $('#txtTipoReferencia_detalles_refacciones_promociones_refacciones').val('');
	            }

	        });

			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_refacciones_promociones_refacciones').on('click','button.btn',function(){
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
			$('#txtReferencia_detalles_refacciones_promociones_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe refacción
		            if($('#txtReferenciaID_detalles_refacciones_promociones_refacciones').val() == '' || $('#txtReferencia_detalles_refacciones_promociones_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtReferencia_detalles_refacciones_promociones_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones').focus();
			   	    }
		        }
		    });


			//Validar que exista procentaje del descuento cuando se pulse la tecla enter 
			$('#txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones').on('keypress', function (e) {
				if(e.which === 13 )
				{
					//Si no existe procentaje del descuento
					if($('#txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones').val() == '')
					{
						//Enfocar caja de texto
						$('#txtPorcentajeDescuento_detalles_refacciones_promociones_refacciones').focus();
					}
					else
					{
						//Hacer un llamado a la función para agregar renglón a la tabla
						agregar_renglon_detalles_refacciones_promociones_refacciones();
					}
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_refacciones_promociones_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_refacciones_promociones_refacciones').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_refacciones_promociones_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_refacciones_promociones_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_refacciones_promociones_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_refacciones_promociones_refacciones').data('DateTimePicker').maxDate(e.date);
			});

			//Paginación de registros
			$('#pagLinks_refacciones_promociones_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaRefaccionesPromocionesRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_refacciones_promociones_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_refacciones_promociones_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_refacciones_promociones_refacciones();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_refacciones_promociones_refacciones').addClass("estatus-NUEVO");
				//Abrir modal
				 objRefaccionesPromocionesRefacciones = $('#RefaccionesPromocionesRefaccionesBox').bPopup({
												   appendTo: '#RefaccionesPromocionesRefaccionesContent', 
												   contentContainer: 'RefaccionesPromocionesRefaccionesM', 
												   zIndex: 2, 
												   modalClose: false, 
												   modal: true, 
												   follow: [true,false], 
												   followEasing : "linear", 
												   easing: "linear", 
												   modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtFechaInicio_refacciones_promociones_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_refacciones_promociones_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_refacciones_promociones_refacciones();
			//Hacer un llamado a la función para cargar sucursales en el combobox del formulario de búsqueda
			cargar_sucursales_busqueda_refacciones_promociones_refacciones();
			//Hacer un llamado a la función para cargar sucursales en el combobox del modal
			cargar_sucursales_refacciones_promociones_refacciones();
		});
	</script>