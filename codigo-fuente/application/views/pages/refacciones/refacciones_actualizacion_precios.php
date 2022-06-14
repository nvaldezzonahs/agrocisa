	<div id="RefaccionesActualizacionPreciosRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_refacciones_actualizacion_precios_refacciones" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_refacciones_actualizacion_precios_refacciones" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_refacciones_actualizacion_precios_refacciones">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_refacciones_actualizacion_precios_refacciones'>
				                    <input class="form-control" id="txtFechaInicialBusq_refacciones_actualizacion_precios_refacciones"
				                    		name= "strFechaInicialBusq_refacciones_actualizacion_precios_refacciones" 
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
								<label for="txtFechaFinalBusq_refacciones_actualizacion_precios_refacciones">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_refacciones_actualizacion_precios_refacciones'>
				                    <input class="form-control" id="txtFechaFinalBusq_refacciones_actualizacion_precios_refacciones"
				                    		name= "strFechaFinalBusq_refacciones_actualizacion_precios_refacciones" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					 <!--Autocomplete que contiene las listas de precios de refacciones activas-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta para recuperar el id de la lista de precios de refacciones seleccionada-->
								<input id="txtRefaccionesListaPrecioIDBusq_refacciones_actualizacion_precios" 
									   name="intRefaccionesListaPrecioIDBusq_refacciones_actualizacion_precios"  type="hidden" 
									   value="">
								</input>
								<label for="txtRefaccionesListaPrecioBusq_refacciones_actualizacion_precios">Lista de precios</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtRefaccionesListaPrecioBusq_refacciones_actualizacion_precios" 
										name="strRefaccionesListaPrecioBusq_refacciones_actualizacion_precios" type="text" value="" tabindex="1" placeholder="Ingrese lista de precios" maxlength="250">
								</input>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Descripción-->
					<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtBusqueda_entradas_refacciones_actualizacion_precios_refacciones">Descripción</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtBusqueda_entradas_refacciones_actualizacion_precios_refacciones" 
										name="strBusqueda_entradas_refacciones_actualizacion_precios_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_refacciones_actualizacion_precios_refacciones"
									onclick="paginacion_refacciones_actualizacion_precios_refacciones();" 
									title="Buscar coincidencias" tabindex="1"> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_refacciones_actualizacion_precios_refacciones" 
									title="Nuevo registro" tabindex="1"> 
								<span class="glyphicon glyphicon-list-alt"></span>
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
				Definir columnas de la tabla actualizaciones de precios
				*/
				td.movil.a1:nth-of-type(1):before {content: "Fecha"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Lista de precios actualizada"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Base"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Porcentaje"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles de la actualización de precios
				*/
				td.movil.b1:nth-of-type(1):before {content: "Línea"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_refacciones_actualizacion_precios_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Fecha</th>
							<th class="movil">Lista de precios actualizada</th>
							<th class="movil">Base</th>
							<th class="movil">Porcentaje</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_refacciones_actualizacion_precios_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{fecha}}</td>
							<td class="movil a2">{{refacciones_lista_precio}}</td>
							<td class="movil a3">{{base}}</td>
							<td class="movil a4">{{porcentaje}}</td>
							<td class="td-center movil a5"> 
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										 onclick="ver_refacciones_actualizacion_precios_refacciones({{refaccion_actualizacion_precio_id}});"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_refacciones_actualizacion_precios_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_refacciones_actualizacion_precios_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal -->
		<div id="RefaccionesActualizacionPreciosRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_refacciones_actualizacion_precios_refacciones"  class="ModalBodyTitle">
			<h1>Actualización de Precios</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRefaccionesActualizacionPreciosRefacciones" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmRefaccionesActualizacionPreciosRefacciones"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
						<!--Fecha de creación-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_refacciones_actualizacion_precios_refacciones">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_refacciones_actualizacion_precios_refacciones'>
					                    <input class="form-control" id="txtFecha_refacciones_actualizacion_precios_refacciones"
					                    		name= "strFecha_refacciones_actualizacion_precios_refacciones" 
					                    		type="text" value="" disabled />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las listas de precios de refacciones activas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id de la lista de precios de refacciones seleccionada-->
									<input id="txtRefaccionesListaPrecioID_refacciones_actualizacion_precios_refacciones" 
										   name="intRefaccionesListaPrecioID_refacciones_actualizacion_precios_refacciones" 
										   type="hidden" value="">
									</input>
									<label for="txtRefaccionesListaPrecio_refacciones_actualizacion_precios_refacciones">
										Lista de precios por actualizar
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtRefaccionesListaPrecio_refacciones_actualizacion_precios_refacciones" 
											name="strRefaccionesListaPrecio_refacciones_actualizacion_precios_refacciones" 
											type="text" value="" tabindex="1"
											placeholder="Ingrese lista de precios" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Porcentaje-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtPorcentaje_refacciones_actualizacion_precios_refacciones">Porcentaje</label>
								</div>
								<div class="col-md-12">
									<div class='input-group'>
										<input  class="form-control porcentaje_refacciones_actualizacion_precios_refacciones" id="txtPorcentaje_refacciones_actualizacion_precios_refacciones" 
												name="intPorcentaje_refacciones_actualizacion_precios_refacciones" type="text" value="" 
												tabindex="1" placeholder="Ingrese porcentaje" maxlength="8">
										</input>
										<span class="input-group-addon">%</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Base-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbBase_refacciones_actualizacion_precios_refacciones">Base para actualización</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" id="cmbBase_refacciones_actualizacion_precios_refacciones" 
									 		name="strBase_refacciones_actualizacion_precios_refacciones" tabindex="1">
									 	<option value="">Seleccione una opción</option>
                          				<option value="COSTO PROMEDIO">COSTO PROMEDIO</option>
                          				<option value="COSTO PLANTA">COSTO PLANTA</option>
                          				<option value="LISTA DE PRECIOS">LISTA DE PRECIOS</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las listas de precios de refacciones activas-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta para recuperar el id de la lista de precios de refacciones seleccionada-->
									<input id="txtReferenciaID_refacciones_actualizacion_precios_refacciones" 
										   name="intReferenciaID_refacciones_actualizacion_precios_refacciones" 
										   type="hidden" value="">
									</input>
									<label for="txtReferencia_refacciones_actualizacion_precios_refacciones">
										Lista de precios
									</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtReferencia_refacciones_actualizacion_precios_refacciones" 
											name="strReferencia_refacciones_actualizacion_precios_refacciones" 
											type="text" value="" tabindex="1"
											placeholder="Ingrese lista de precios" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Tipo de cambio-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTipoCambio_refacciones_actualizacion_precios_refacciones">Tipo de cambio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control tipo-cambio_refacciones_actualizacion_precios_refacciones" id="txtTipoCambio_refacciones_actualizacion_precios_refacciones" 
											name="intTipoCambio_refacciones_actualizacion_precios_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese tipo de cambio" maxlength="11">
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
											<h4 class="panel-title">Líneas de refacciones por actualizar</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene las líneas de refacciones activas-->
													<div class="col-sm-11 col-md-11 col-lg-11 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id de la línea de refacciones seleccionada-->
																<input id="txtRefaccionesLineaID_detalles_refacciones_actualizacion_precios_refacciones" 
																	   name="intRefaccionesLineaID_detalles_refacciones_actualizacion_precios_refacciones"  
																	   type="hidden" value="">
															    </input>
																<label for="txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones">Línea</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones" 
																		name="strRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones" type="text" 
																		value="" tabindex="1" placeholder="Ingrese línea" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
													<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
														<button class="btn btn-primary btn-toolBtns pull-right" 
																id="btnAgregar_refacciones_actualizacion_precios_refacciones"
																onclick="agregar_renglon_detalles_refacciones_actualizacion_precios_refacciones();" 
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
													<table class="table-hover movil" id="dg_detalles_refacciones_actualizacion_precios_refacciones">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Línea</th>
																<th class="movil" id="th-acciones" style="width:6;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
													</table>
													<br>
													<div class="row">
														<!--Número de registros encontrados-->
														<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
															<button class="btn btn-default btn-sm disabled pull-right">
																<strong id="numElementos_detalles_refacciones_actualizacion_precios_refacciones">0</strong> encontrados
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
							<button class="btn btn-success" id="btnGuardar_refacciones_actualizacion_precios_refacciones"  
									onclick="validar_refacciones_actualizacion_precios_refacciones();"  title="Guardar" tabindex="2">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_refacciones_actualizacion_precios_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_refacciones_actualizacion_precios_refacciones();" 
									title="Cerrar"  tabindex="3">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#RefaccionesActualizacionPreciosRefaccionesContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaRefaccionesActualizacionPreciosRefacciones = 0;
		var strUltimaBusquedaRefaccionesActualizacionPreciosRefacciones = "";
		//Variable que se utiliza para asignar el valor máximo del tipo de cambio
		var intTipoCambioMaximoActualizacionPreciosRefacciones = <?php echo TIPO_CAMBIO_MAXIMO ?>;
		//Variable que se utiliza para asignar objeto del modal
		var objRefaccionesActualizacionPreciosRefacciones = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_refacciones_actualizacion_precios_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/refacciones_actualizacion_precios/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_refacciones_actualizacion_precios_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRefaccionesActualizacionPreciosRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosRefaccionesActualizacionPreciosRefacciones = strPermisosRefaccionesActualizacionPreciosRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRefaccionesActualizacionPreciosRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRefaccionesActualizacionPreciosRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_refacciones_actualizacion_precios_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR
						else if(arrPermisosRefaccionesActualizacionPreciosRefacciones[i]=='GUARDAR')
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_refacciones_actualizacion_precios_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesActualizacionPreciosRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_refacciones_actualizacion_precios_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_refacciones_actualizacion_precios_refacciones();
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_refacciones_actualizacion_precios_refacciones() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaRefaccionesActualizacionPreciosRefacciones =($('#txtFechaInicialBusq_refacciones_actualizacion_precios_refacciones').val()+$('#txtFechaFinalBusq_refacciones_actualizacion_precios_refacciones').val()+$('#txtRefaccionesListaPrecioIDBusq_refacciones_actualizacion_precios_refacciones').val());
			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaRefaccionesActualizacionPreciosRefacciones != strUltimaBusquedaRefaccionesActualizacionPreciosRefacciones)
			{
				intPaginaRefaccionesActualizacionPreciosRefacciones = 0;
				strUltimaBusquedaRefaccionesActualizacionPreciosRefacciones = strNuevaBusquedaRefaccionesActualizacionPreciosRefacciones;
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/refacciones_actualizacion_precios/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					    dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_refacciones_actualizacion_precios_refacciones').val()),
					    dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_refacciones_actualizacion_precios_refacciones').val()),
					    intRefaccionesListaPrecioID: $('#txtRefaccionesListaPrecioIDBusq_refacciones_actualizacion_precios_refacciones').val(),
					    strBusqueda:    $('#txtBusqueda_entradas_refacciones_actualizacion_precios_refacciones').val(),
						intPagina:intPaginaRefaccionesActualizacionPreciosRefacciones,
						strPermisosAcceso: $('#txtAcciones_refacciones_actualizacion_precios_refacciones').val()
					},
					function(data){
						$('#dg_refacciones_actualizacion_precios_refacciones tbody').empty();
						var tmpRefaccionesActualizacionPreciosRefacciones = Mustache.render($('#plantilla_refacciones_actualizacion_precios_refacciones').html(),data);
						$('#dg_refacciones_actualizacion_precios_refacciones tbody').html(tmpRefaccionesActualizacionPreciosRefacciones);
						$('#pagLinks_refacciones_actualizacion_precios_refacciones').html(data.paginacion);
						$('#numElementos_refacciones_actualizacion_precios_refacciones').html(data.total_rows);
						intPaginaRefaccionesActualizacionPreciosRefacciones = data.pagina;
					},
			'json');
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_refacciones_actualizacion_precios_refacciones()
		{
			//Incializar formulario
			$('#frmRefaccionesActualizacionPreciosRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_actualizacion_precios_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmRefaccionesActualizacionPreciosRefacciones').find('input[type=hidden]').val('');
			//Asignar la fecha actual
			$('#txtFecha_refacciones_actualizacion_precios_refacciones').val(fechaActual()); 
			//Eliminar los datos de la tabla detalles de la actualización de precios
			$('#dg_detalles_refacciones_actualizacion_precios_refacciones tbody').empty();
			$('#numElementos_detalles_refacciones_actualizacion_precios_refacciones').html(0);
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_refacciones_actualizacion_precios_refacciones').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_refacciones_actualizacion_precios_refacciones').removeClass("estatus-ACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmRefaccionesActualizacionPreciosRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar las siguientes cajas de texto
			$("#txtFecha_refacciones_actualizacion_precios_refacciones").attr('disabled','disabled');
			$("#txtReferencia_refacciones_actualizacion_precios_refacciones").attr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_refacciones_actualizacion_precios_refacciones").show();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_refacciones_actualizacion_precios_refacciones()
		{
			try {
				//Cerrar modal
				objRefaccionesActualizacionPreciosRefacciones.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_refacciones_actualizacion_precios_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_refacciones_actualizacion_precios_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_actualizacion_precios_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmRefaccionesActualizacionPreciosRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
										valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strRefaccionesListaPrecio_refacciones_actualizacion_precios_refacciones: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la lista de precios
					                                    if($('#txtRefaccionesListaPrecioID_refacciones_actualizacion_precios_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una lista de precios existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intPorcentaje_refacciones_actualizacion_precios_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba un porcentaje'},
												callback: {
					                                  callback: function(value, validator, $field) {
					                                      //Verificar que el porcentaje no sea mayor que 100
					                                      if(parseFloat($.reemplazar(value, ",", "")) > 100)
					                                      {
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
										intTipoCambio_refacciones_actualizacion_precios_refacciones: {
											excluded: false,  // No ignorar (permite validar campo deshabilitado)
											validators: {
												notEmpty: {message: 'Escriba el tipo de cambio'},
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    	//Verificar que el tipo de cambio no sea mayor que su valor máximo
					                                      	if(parseFloat($.reemplazar(value, ",", "")) > intTipoCambioMaximoActualizacionPreciosRefacciones)
					                                    	{
					                                    		return {
					                                              valid: false,
					                                              message: 'El tipo de cambio no debe ser mayor que '+intTipoCambioMaximoActualizacionPreciosRefacciones
					                                          	};
					                                    	}
					                                   		return true;
					                                    }
					                                }
					                            }
										},
										strRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones: 
										{
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_refacciones_actualizacion_precios_refacciones = $('#frmRefaccionesActualizacionPreciosRefacciones').data('bootstrapValidator');
			bootstrapValidator_refacciones_actualizacion_precios_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_refacciones_actualizacion_precios_refacciones.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_refacciones_actualizacion_precios_refacciones();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_refacciones_actualizacion_precios_refacciones()
		{
			try
			{
				$('#frmRefaccionesActualizacionPreciosRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_refacciones_actualizacion_precios_refacciones()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_refacciones_actualizacion_precios_refacciones').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRefaccionesLineaID = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Asignar valores a los arrays
				arrRefaccionesLineaID.push(objRen.getAttribute('id'));
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/refacciones_actualizacion_precios/guardar',
					{ 
						//Datos de la actualización de precios
						intRefaccionesListaPrecioID: $('#txtRefaccionesListaPrecioID_refacciones_actualizacion_precios_refacciones').val(),
						strBase: $('#cmbBase_refacciones_actualizacion_precios_refacciones').val(),
						intReferenciaID: $('#txtReferenciaID_refacciones_actualizacion_precios_refacciones').val(),
						intPorcentaje: $('#txtPorcentaje_refacciones_actualizacion_precios_refacciones').val(),
						intTipoCambio: $('#txtTipoCambio_refacciones_actualizacion_precios_refacciones').val(),
						//Datos de los detalles
						strRefaccionesLineaID: arrRefaccionesLineaID.join('|')
					},
					function(data) {
						if (data.resultado)
						{
							if(data.impacto == 0)
							{
								data.tipo_mensaje = 'informacion';
								data.mensaje = 'No hay precios por actualizar.';

							}
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_refacciones_actualizacion_precios_refacciones();
							//Hacer un llamado a la función para cerrar modal
							cerrar_refacciones_actualizacion_precios_refacciones();  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_refacciones_actualizacion_precios_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_refacciones_actualizacion_precios_refacciones(tipoMensaje, mensaje)
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
								   'title': 'Información'
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

		//Función para regresar los datos (al formulario) del registro seleccionado
		function ver_refacciones_actualizacion_precios_refacciones(id)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/refacciones_actualizacion_precios/get_datos',
				   {intRefaccionActualizacionPrecioID:id
				   },
				   function(data) {
						//Si hay datos del registro
						if(data.row)
						{
							//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_refacciones_actualizacion_precios_refacciones();
							//Recuperar valores
							$('#txtFecha_refacciones_actualizacion_precios_refacciones').val(data.row.fecha);
							$('#txtRefaccionesListaPrecioID_refacciones_actualizacion_precios_refacciones').val(data.row.refacciones_lista_precio_id);
							$('#txtRefaccionesListaPrecio_refacciones_actualizacion_precios_refacciones').val(data.row.refacciones_lista_precio);
							$('#cmbBase_refacciones_actualizacion_precios_refacciones').val(data.row.base);
							$('#txtReferenciaID_refacciones_actualizacion_precios_refacciones').val(data.row.referencia_id);
							$('#txtReferencia_refacciones_actualizacion_precios_refacciones').val(data.row.referencia);
							$('#txtPorcentaje_refacciones_actualizacion_precios_refacciones').val(data.row.porcentaje);
							$('#txtTipoCambio_refacciones_actualizacion_precios_refacciones').val(data.row.tipo_cambio);

							//Mostramos los detalles del registro
							for (var intCon in data.detalles) 
							{
								//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_refacciones_actualizacion_precios_refacciones').getElementsByTagName('tbody')[0];

							   //Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaRefaccionesLinea = objRenglon.insertCell(0);
								var objCeldaAcciones = objRenglon.insertCell(1);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].refacciones_linea_id);
								objCeldaRefaccionesLinea.setAttribute('class', 'movil b1');
								objCeldaRefaccionesLinea.innerHTML = data.detalles[intCon].refacciones_linea;
								objCeldaAcciones.setAttribute('class', 'td-center movil b2');
								objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " onclick='eliminar_renglon_detalles_refacciones_actualizacion_precios_refacciones(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
							}

							//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
							var intFilas = $("#dg_detalles_refacciones_actualizacion_precios_refacciones tr").length - 1;
							$('#numElementos_detalles_refacciones_actualizacion_precios_refacciones').html(intFilas);
							
							
							//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
							$('#divEncabezadoModal_refacciones_actualizacion_precios_refacciones').addClass("estatus-ACTIVO");
							//Deshabilitar todos los elementos del formulario
		            		$('#frmRefaccionesActualizacionPreciosRefacciones').find('input, textarea, select').attr('disabled','disabled');
		            		//Ocultar botón Guardar
			           		$("#btnGuardar_refacciones_actualizacion_precios_refacciones").hide(); 

							//Abrir modal
							objRefaccionesActualizacionPreciosRefacciones = $('#RefaccionesActualizacionPreciosRefaccionesBox').bPopup({
														  appendTo: '#RefaccionesActualizacionPreciosRefaccionesContent', 
														  contentContainer: 'RefaccionesActualizacionPreciosRefaccionesM', 
														  zIndex: 2, 
														  modalClose: false, 
														  modal: true, 
														  follow: [true,false], 
														  followEasing : "linear", 
														  easing: "linear", 
														  modalColor: ('#F0F0F0')});

							//Enfocar caja de texto
							$('#txtRefaccionesListaPrecio_refacciones_actualizacion_precios_refacciones').focus();
						}
				   },
				   'json');
		}

		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_refacciones_actualizacion_precios_refacciones()
		{
			//Obtenemos los datos de las cajas de texto
			var intRefaccionesLineaID = $('#txtRefaccionesLineaID_detalles_refacciones_actualizacion_precios_refacciones').val();
			var strRefaccionesLinea = $('#txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_refacciones_actualizacion_precios_refacciones').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intRefaccionesLineaID == '' || strRefaccionesLinea == '')
			{
				//Enfocar caja de texto
				$('#txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtRefaccionesLineaID_detalles_refacciones_actualizacion_precios_refacciones').val('');
				$('#txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones').val('');

				//Revisamos que no exista el ID proporcionado, si es así, agregamos los datos
				if (!objTabla.rows.namedItem(intRefaccionesLineaID))
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaRefaccionesLinea = objRenglon.insertCell(0);
					var objCeldaAcciones = objRenglon.insertCell(1);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intRefaccionesLineaID);
					objCeldaRefaccionesLinea.setAttribute('class', 'movil b1');
					objCeldaRefaccionesLinea.innerHTML = strRefaccionesLinea;
					objCeldaAcciones.setAttribute('class', 'td-center movil b2');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_refacciones_actualizacion_precios_refacciones(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				}

				//Enfocar caja de texto
				$('#txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_detalles_refacciones_actualizacion_precios_refacciones tr").length - 1;
			$('#numElementos_detalles_refacciones_actualizacion_precios_refacciones').html(intFilas);
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_refacciones_actualizacion_precios_refacciones(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_refacciones_actualizacion_precios_refacciones").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_detalles_refacciones_actualizacion_precios_refacciones tr").length - 1;
			$('#numElementos_detalles_refacciones_actualizacion_precios_refacciones').html(intFilas);

			//Enfocar caja de texto
			$('#txtReferencia_detalles_refacciones_actualizacion_precios_refacciones').focus();
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
			$('#txtPorcentaje_refacciones_actualizacion_precios_refacciones').numeric();
			$('#txtTipoCambio_refacciones_actualizacion_precios_refacciones').numeric();
			
			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
			 * por ejemplo: 10 será 10.00*/
			$('.porcentaje_refacciones_actualizacion_precios_refacciones').blur(function(){
				$('.porcentaje_refacciones_actualizacion_precios_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
			});

			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 18.90 será 18.9000*/
            $('.tipo-cambio_refacciones_actualizacion_precios_refacciones').blur(function(){
                $('.tipo-cambio_refacciones_actualizacion_precios_refacciones').formatCurrency({ roundToDecimalPlace: 4 });
            });

            //Autocomplete para recuperar los datos de una lista de precios 
			$('#txtRefaccionesListaPrecio_refacciones_actualizacion_precios_refacciones').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtRefaccionesListaPrecioID_refacciones_actualizacion_precios_refacciones').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "refacciones/refacciones_listas_precios/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar datos del registro seleccionado
					$('#txtRefaccionesListaPrecioID_refacciones_actualizacion_precios_refacciones').val(ui.item.data);
					$('#txtPorcentaje_refacciones_actualizacion_precios_refacciones').val(ui.item.utilidad);
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

			//Verificar que exista id de la lista de precios cuando pierda el enfoque la caja de texto
			$('#txtRefaccionesListaPrecio_refacciones_actualizacion_precios_refacciones').focusout(function(e){
				//Si no existe id de la lista de precios de refacciones
				if($('#txtRefaccionesListaPrecioID_refacciones_actualizacion_precios_refacciones').val() == '' ||
					$('#txtRefaccionesListaPrecio_refacciones_actualizacion_precios_refacciones').val() == '')
				{ 
					//Limpiar contenido de las siguientes cajas de texto
					$('#txtRefaccionesListaPrecioID_refacciones_actualizacion_precios_refacciones').val('');
					$('#txtRefaccionesListaPrecio_refacciones_actualizacion_precios_refacciones').val('');
					$('#txtPorcentaje_refacciones_actualizacion_precios_refacciones').val('');
				}
				
			});

			//Habilitar o deshabilitar referencia cuando cambie la opción del combobox
	        $('#cmbBase_refacciones_actualizacion_precios_refacciones').change(function(e){   
	            //Dependiendo de la base habilitar o deshabilitar referencia
              	if($('#cmbBase_refacciones_actualizacion_precios_refacciones').val() === 'LISTA DE PRECIOS')
             	{
             		//Habilitar caja de texto
					$("#txtReferencia_refacciones_actualizacion_precios_refacciones").removeAttr('disabled');
             	
             	}
             	else
             	{
             		//Deshabilitar caja de texto
					$("#txtReferencia_refacciones_actualizacion_precios_refacciones").attr('disabled','disabled');
					//Limpiar contenido de las siguientes cajas de texto
					$('#txtReferenciaID_refacciones_actualizacion_precios_refacciones').val('');
					$('#txtReferencia_refacciones_actualizacion_precios_refacciones').val('');  
             	}
	        });

	        //Verificar importe cuando pierda el enfoque la caja de texto
	        $('#txtTipoCambio_refacciones_actualizacion_precios_refacciones').focusout(function(e){

	        	//Variable que se utiliza para asignar el tipo de cambio
				var intTipoCambio = parseFloat($.reemplazar($('#txtTipoCambio_refacciones_actualizacion_precios_refacciones').val(), ",", ""));

				//Si el tipo de cambio es mayor que el valor máximo permitido
	        	if(intTipoCambio > intTipoCambioMaximoActualizacionPreciosRefacciones)
	        	{
	        		$('#txtTipoCambio_refacciones_actualizacion_precios_refacciones').val(intTipoCambioMaximoActualizacionPreciosRefacciones);
	        	}

		    });

			//Autocomplete para recuperar los datos de una lista de precios (referencia)
			$('#txtReferencia_refacciones_actualizacion_precios_refacciones').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtReferenciaID_refacciones_actualizacion_precios_refacciones').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "refacciones/refacciones_listas_precios/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtReferenciaID_refacciones_actualizacion_precios_refacciones').val(ui.item.data);
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

			//Verificar que exista id de la lista de precios cuando pierda el enfoque la caja de texto
			$('#txtReferencia_refacciones_actualizacion_precios_refacciones').focusout(function(e){
				//Si no existe id de la lista de precios de refacciones
				if($('#txtReferenciaID_refacciones_actualizacion_precios_refacciones').val() == '' ||
					$('#txtReferencia_refacciones_actualizacion_precios_refacciones').val() == '')
				{ 
					//Limpiar contenido de las siguientes cajas de texto
					$('#txtReferenciaID_refacciones_actualizacion_precios_refacciones').val('');
					$('#txtReferencia_refacciones_actualizacion_precios_refacciones').val('');
				}
				
			});

			//Autocomplete para recuperar los datos de una línea de refacciones 
	        $('#txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtRefaccionesLineaID_detalles_refacciones_actualizacion_precios_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "refacciones/refacciones_lineas/autocomplete",
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
	             $('#txtRefaccionesLineaID_detalles_refacciones_actualizacion_precios_refacciones').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la línea de refacciones cuando pierda el enfoque la caja de texto
	        $('#txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones').focusout(function(e){
	            //Si no existe id de la línea de refacciones
	            if($('#txtRefaccionesLineaID_detalles_refacciones_actualizacion_precios_refacciones').val() == '' ||
	               $('#txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtRefaccionesLineaID_detalles_refacciones_actualizacion_precios_refacciones').val('');
	               $('#txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones').val('');
	            }
	            
	        });

			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_refacciones_actualizacion_precios_refacciones').on('click','button.btn',function(){
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

			//Validar que exista línea cuando se pulse la tecla enter 
			$('#txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe refacción
		            if($('#txtRefaccionesLineaID_detalles_refacciones_actualizacion_precios_refacciones').val() == '' || $('#txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtRefaccionesLinea_detalles_refacciones_actualizacion_precios_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
		    			agregar_renglon_detalles_refacciones_actualizacion_precios_refacciones();
			   	    }
		        }
		    });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_refacciones_actualizacion_precios_refacciones').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_refacciones_actualizacion_precios_refacciones').datetimepicker({format: 'DD/MM/YYYY',
			 																	 useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_refacciones_actualizacion_precios_refacciones').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_refacciones_actualizacion_precios_refacciones').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_refacciones_actualizacion_precios_refacciones').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_refacciones_actualizacion_precios_refacciones').data('DateTimePicker').maxDate(e.date);
			});

			//Autocomplete para recuperar los datos de una lista de precios
			$('#txtRefaccionesListaPrecioBusq_refacciones_actualizacion_precios').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtRefaccionesListaPrecioIDBusq_refacciones_actualizacion_precios').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "refacciones/refacciones_listas_precios/autocomplete",
						type: "post",
						dataType: "json",
						data: {
							strDescripcion: request.term
						},
						success: function( data ) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					//Asignar id del registro seleccionado
					$('#txtRefaccionesListaPrecioIDBusq_refacciones_actualizacion_precios').val(ui.item.data);
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

			//Verificar que exista id de la lista de precios cuando pierda el enfoque la caja de texto
			$('#txtRefaccionesListaPrecioBusq_refacciones_actualizacion_precios').focusout(function(e){
				//Si no existe id de la lista de precios de refacciones
				if($('#txtRefaccionesListaPrecioIDBusq_refacciones_actualizacion_precios').val() == '' ||
					$('#txtRefaccionesListaPrecioBusq_refacciones_actualizacion_precios').val() == '')
				{ 
					//Limpiar contenido de las siguientes cajas de texto
					$('#txtRefaccionesListaPrecioIDBusq_refacciones_actualizacion_precios').val('');
					$('#txtRefaccionesListaPrecioBusq_refacciones_actualizacion_precios').val('');
				}
				
			});

			//Paginación de registros
			$('#pagLinks_refacciones_actualizacion_precios_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaRefaccionesActualizacionPreciosRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_refacciones_actualizacion_precios_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_refacciones_actualizacion_precios_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_refacciones_actualizacion_precios_refacciones();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_refacciones_actualizacion_precios_refacciones').addClass("estatus-NUEVO");
				//Abrir modal
				 objRefaccionesActualizacionPreciosRefacciones = $('#RefaccionesActualizacionPreciosRefaccionesBox').bPopup({
												   appendTo: '#RefaccionesActualizacionPreciosRefaccionesContent', 
												   contentContainer: 'RefaccionesActualizacionPreciosRefaccionesM', 
												   zIndex: 2, 
												   modalClose: false, 
												   modal: true, 
												   follow: [true,false], 
												   followEasing : "linear", 
												   easing: "linear", 
												   modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtRefaccionesListaPrecio_refacciones_actualizacion_precios_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_refacciones_actualizacion_precios_refacciones').focus();

			//Deshabilitar los siguientes botones (funciones de permisos de acceso)
			$('#btnNuevo_refacciones_actualizacion_precios_refacciones').attr('disabled','-1');  
			$('#btnBuscar_refacciones_actualizacion_precios_refacciones').attr('disabled','-1');
			$('#btnGuardar_refacciones_actualizacion_precios_refacciones').attr('disabled','-1'); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_refacciones_actualizacion_precios_refacciones();
		});
	</script>