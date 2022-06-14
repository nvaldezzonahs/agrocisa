	<div id="ProveedoresPreciosMaquinariaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_proveedores_precios_maquinaria" action="#" method="post" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_proveedores_precios_maquinaria" 
								   name="strBusqueda_proveedores_precios_maquinaria"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_proveedores_precios_maquinaria"
										onclick="paginacion_proveedores_precios_maquinaria();"
										title="Buscar coincidencias" tabindex="2" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_proveedores_precios_maquinaria"
									title="Nuevo registro" tabindex="3" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_proveedores_precios_maquinaria"
									onclick="reporte_proveedores_precios_maquinaria('PDF');" 
									title="Imprimir reporte general en PDF" tabindex="4" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_proveedores_precios_maquinaria"
									onclick="reporte_proveedores_precios_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="5" disabled>
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
				Definir columnas de la tabla maestro
				*/
				td.a1:nth-of-type(1):before {content: "Nombre"; font-weight: bold;}
				td.a2:nth-of-type(2):before {content: "Porcentaje"; font-weight: bold;}
				td.a3:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.a4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
				/*
				Definir columnas de la tabla detalles
				*/
				td.b1:nth-of-type(1):before {content: "Maquinaria"; font-weight: bold;}
				td.b2:nth-of-type(2):before {content: "Precio"; font-weight: bold;}
				td.b3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_proveedores_precios_maquinaria">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Proveedor</th>
							<th class="movil">Moneda</th>
							<th class="movil">Estatus</th>
							<th  class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_proveedores_precios_maquinaria" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil a1">{{proveedor}}</td>
							<td class="movil a2">{{moneda}}</td>
							<td class="movil a3">{{estatus}}</td>
							<td class="td-center movil a4"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_proveedores_precios_maquinaria({{proveedor_precio_id}},'id', 'Editar')" title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_proveedores_precios_maquinaria({{proveedor_precio_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_proveedores_precios_maquinaria({{proveedor_precio_id}}, 'PDF')" title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Descargar archivo XLS con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionXLS}}"  
										onclick="reporte_registro_proveedores_precios_maquinaria({{proveedor_precio_id}}, 'XLS')" 
										title="Descargar registro en XLS">
									<span class="fa fa-file-excel-o"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_proveedores_precios_maquinaria({{proveedor_precio_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_proveedores_precios_maquinaria({{proveedor_precio_id}},'{{estatus}}')"  title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr> 
							<td colspan="4"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_proveedores_precios_maquinaria"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_proveedores_precios_maquinaria">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->
		<!-- Diseño del modal-->
		<div id="ProveedoresPreciosMaquinariaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_proveedores_precios_maquinaria" class="ModalBodyTitle">
				<h1>Lista de Precios de Compra</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmProveedoresPreciosMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmProveedoresPreciosMaquinaria" onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Autocomplete que contiene los proveedores activos-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtProveedorPrecioID_proveedores_precios_maquinaria" 
										   name="intProveedorPrecioID_proveedores_precios_maquinaria" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del proveedor seleccionado-->
									<input id="txtProveedorID_proveedores_precios_maquinaria" 
										   name="intProveedorID_proveedores_precios_maquinaria" 
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el proveedor anterior y así evitar duplicidad en caso de que exista otro registro con la misma moneda en el proveedor-->
									<input id="txtProveedorIDAnterior_proveedores_precios_maquinaria" 
										   name="txtProveedorIDAnterior_proveedores_precios_maquinaria" type="hidden" value="">
									</input>
									<label for="txtProveedor_proveedores_precios_maquinaria">Proveedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtProveedor_proveedores_precios_maquinaria" 
											name="strProveedor_proveedores_precios_maquinaria" type="text" value="" 
											tabindex="1" placeholder="Ingrese proveedor" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Moneda-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar la moneda anterior y así evitar duplicidad en caso de que exista otro registro con la misma moneda en el proveedor-->
									<input id="txtMonedaIDAnterior_proveedores_precios_maquinaria" 
										   name="intMonedaIDAnterior_proveedores_precios_maquinaria" type="hidden" value="">
									</input>
									<label for="cmbMonedaID_proveedores_precios_maquinaria">Moneda</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbMonedaID_proveedores_precios_maquinaria" 
											name="intMonedaID_proveedores_precios_maquinaria" tabindex="1">
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
									<input id="txtNumDetalles_proveedores_precios_maquinaria" 
										   name="intNumDetalles_proveedores_precios_maquinaria" type="hidden" value="">
									</input>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Precios capturados</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
												    <!--Autocomplete que contiene las descripciones de maquinaria activas-->
													<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la descripción de maquinaria seleccionada-->
																<input id="txtMaquinariaDescripcionID_detalles_proveedores_precios_maquinaria" 
																	   name="intMaquinariaDescripcionID_detalles_proveedores_precios_maquinaria" 
																	   type="hidden" value="">
																</input>
																<label for="txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria">
																	Descripción de maquinaria
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria" 
																		name="strMaquinariaDescripcion_detalles_proveedores_precios_maquinaria" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese descripción de maquinaria" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Precio-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPrecio_detalles_proveedores_precios_maquinaria">Precio</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_proveedores_precios_maquinaria" 
																		id="txtPrecio_detalles_proveedores_precios_maquinaria" 
																		name="intPrecio_detalles_proveedores_precios_maquinaria" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese precio" maxlength="22">
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
													<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
														<button class="btn btn-primary btn-toolBtns" 
																id="btnAgregar_proveedores_precios_maquinaria" 
																onclick="agregar_renglon_detalles_proveedores_precios_maquinaria();" 
																title="Agregar" tabindex="1">
															<span class="glyphicon glyphicon-plus"></span>
														</button>
													</div>
												</div>
											</div>
											<!--Div que contiene la tabla con los precios del proveedor encontrados-->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover movil" id="dg_detalles_proveedores_precios_maquinaria">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Maquinaria</th>
																<th class="movil">Precio</th>
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
																<strong id="numElementos_detalles_proveedores_precios_maquinaria">0</strong> encontrados
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
							<button class="btn btn-success" id="btnGuardar_proveedores_precios_maquinaria"  
									onclick="validar_proveedores_precios_maquinaria();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default"  id="btnImprimirRegistro_proveedores_precios_maquinaria"
									onclick="reporte_registro_proveedores_precios_maquinaria('', 'PDF');" 
									title="Imprimir registro en PDF" tabindex="3" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con los datos del registro-->
							<button class="btn btn-default"  id="btnDescargarXLSRegistro_proveedores_precios_maquinaria"
									onclick="reporte_registro_proveedores_precios_maquinaria('', 'XLS');" title="Descargar registro en XLS" tabindex="4" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_proveedores_precios_maquinaria"  
									onclick="cambiar_estatus_proveedores_precios_maquinaria('','ACTIVO');"  title="Desactivar" tabindex="5" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_proveedores_precios_maquinaria"  
									onclick="cambiar_estatus_proveedores_precios_maquinaria('','INACTIVO');"  title="Restaurar" tabindex="6" disabled>
								<span class="fa fa-exchange"></span>
							</button> 
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_proveedores_precios_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_proveedores_precios_maquinaria();" title="Cerrar" tabindex="7">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ProveedoresPreciosMaquinariaContent -->

	<!--Plantilla para cargar las monedas en el combobox-->
	<script id="monedas_proveedores_precios_maquinaria" type="text/template">
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
		var intPaginaProveedoresPreciosMaquinaria = 0;
		var strUltimaBusquedaProveedoresPreciosMaquinaria = "";
		//Variable que se utiliza para asignar objeto del modal
		var objProveedoresPreciosMaquinaria = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_proveedores_precios_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/proveedores_precios/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_proveedores_precios_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosProveedoresPreciosMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosProveedoresPreciosMaquinaria = strPermisosProveedoresPreciosMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosProveedoresPreciosMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosProveedoresPreciosMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_proveedores_precios_maquinaria').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosProveedoresPreciosMaquinaria[i]=='GUARDAR') || (arrPermisosProveedoresPreciosMaquinaria[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_proveedores_precios_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosProveedoresPreciosMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_proveedores_precios_maquinaria').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_proveedores_precios_maquinaria();
						}
						else if(arrPermisosProveedoresPreciosMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_proveedores_precios_maquinaria').removeAttr('disabled');
							$('#btnRestaurar_proveedores_precios_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosProveedoresPreciosMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_proveedores_precios_maquinaria').removeAttr('disabled');
							
						}
						else if(arrPermisosProveedoresPreciosMaquinaria[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Mostrar el control (botón imprimir)
							$('#btnImprimirRegistro_proveedores_precios_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosProveedoresPreciosMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_proveedores_precios_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosProveedoresPreciosMaquinaria[i]=='DESCARGAR XLS REGISTRO')//Si el indice es DESCARGAR XLS REGISTRO
						{
							//Mostrar el control (botón descargar XLS)
							$('#btnDescargarXLSRegistro_proveedores_precios_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_proveedores_precios_maquinaria() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_proveedores_precios_maquinaria').val() != strUltimaBusquedaProveedoresPreciosMaquinaria)
			{
				intPaginaProveedoresPreciosMaquinaria = 0;
				strUltimaBusquedaProveedoresPreciosMaquinaria = $('#txtBusqueda_proveedores_precios_maquinaria').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('maquinaria/proveedores_precios/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_proveedores_precios_maquinaria').val(),
						intPagina:intPaginaProveedoresPreciosMaquinaria,
						strPermisosAcceso: $('#txtAcciones_proveedores_precios_maquinaria').val()
					},
					function(data){
						$('#dg_proveedores_precios_maquinaria tbody').empty();
						var tmpProveedoresPreciosMaquinaria = Mustache.render($('#plantilla_proveedores_precios_maquinaria').html(),data);
						$('#dg_proveedores_precios_maquinaria tbody').html(tmpProveedoresPreciosMaquinaria);
						$('#pagLinks_proveedores_precios_maquinaria').html(data.paginacion);
						$('#numElementos_proveedores_precios_maquinaria').html(data.total_rows);
						intPaginaProveedoresPreciosMaquinaria = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_proveedores_precios_maquinaria(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/proveedores_precios/';

			//Si el tipo de reporte es PDF
			if(strTipo == 'PDF')
			{
				//Concatenar nombre de la función que genera el reporte PDF
				strUrl += 'get_reporte';
			}
			else
			{
				//Concatenar nombre de la función que genera el archivo XLS
				strUrl += "get_xls";
			}

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'strBusqueda': $('#txtBusqueda_proveedores_precios_maquinaria').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		//Función para cargar el reporte de un registro en  PDF/XLS
		function reporte_registro_proveedores_precios_maquinaria(id, strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/proveedores_precios/';

			//Variable que se utiliza para asignar el id del registro
			var intID = 0;

			//Si el tipo de reporte es PDF
			if(strTipo == 'PDF')
			{
				//Concatenar nombre de la función que genera el reporte PDF
				strUrl += 'get_reporte_registro';
			}
			else
			{
				//Concatenar nombre de la función que genera el archivo XLS
				strUrl += 'get_xls';
			}


			//Si no existe id, significa que se realizará la impresión desde el modal
			if(id == '')
			{
				intID = $('#txtProveedorPrecioID_proveedores_precios_maquinaria').val();
			}
			else
			{
				intID = id;
			}


			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'intProveedorPrecioID': intID
									 }
						   };

			//Hacer un llamado a la función para imprimir el reporte
			$.imprimirReporte(objReporte);

		}

		
		//Regresar monedas activas para cargarlas en el combobox
		function cargar_monedas_proveedores_precios_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales del usuario que se encuentran activas 
			$.post('contabilidad/sat_monedas/get_combo_box', {},
				function(data)
				{
					$('#cmbMonedaID_proveedores_precios_maquinaria').empty();
					var temp = Mustache.render($('#monedas_proveedores_precios_maquinaria').html(), data);
					$('#cmbMonedaID_proveedores_precios_maquinaria').html(temp);
				},
				'json');
		}
		
		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		//Función para limpiar los campos del formulario
		function nuevo_proveedores_precios_maquinaria()
		{
			//Incializar formulario
			$('#frmProveedoresPreciosMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedores_precios_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmProveedoresPreciosMaquinaria').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para inicializar elementos del formulario
			inicializar_proveedores_precios_maquinaria();
		}

		//Función para inicializar elementos del formulario
		function inicializar_proveedores_precios_maquinaria()
		{

			//Limpiar caja de texto que contiene el id del registro
			$("#txtProveedorPrecioID_proveedores_precios_maquinaria").val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_proveedores_precios_maquinaria');
			//Eliminar los datos de la tabla
			$('#dg_detalles_proveedores_precios_maquinaria tbody').empty();
			$('#numElementos_detalles_proveedores_precios_maquinaria').html(0);
			$('#txtNumDetalles_proveedores_precios_maquinaria').val(0);
			//Habilitar todos los elementos del formulario
			$('#frmProveedoresPreciosMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_proveedores_precios_maquinaria").show();
			//Habilitar botón Agregar
			$('#btnAgregar_proveedores_precios_maquinaria').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_proveedores_precios_maquinaria").hide();
			$("#btnDescargarXLSRegistro_proveedores_precios_maquinaria").hide();
			$("#btnDesactivar_proveedores_precios_maquinaria").hide();
			$("#btnRestaurar_proveedores_precios_maquinaria").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_proveedores_precios_maquinaria()
		{
			try {
				//Cerrar modal
				objProveedoresPreciosMaquinaria.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_proveedores_precios_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_proveedores_precios_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_proveedores_precios_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmProveedoresPreciosMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strProveedor_proveedores_precios_maquinaria: {
											validators: {
												callback: {
													callback: function(value, validator, $field) {
														//Verificar que exista id del proveedor
														if ($('#txtProveedorID_proveedores_precios_maquinaria').val() === '')
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
										intNumDetalles_proveedores_precios_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que existan detalles
					                                    if(parseInt(value) === 0 || value === '')
					                                    {
					                                    	return {
					                                            valid: false,
					                                            message: 'Agregar al menos un detalle para esta lista de precios.'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										intMonedaID_proveedores_precios_maquinaria: {
											validators: {
												notEmpty: {message: 'Seleccione una moneda'}
											}
										},
										strMaquinariaDescripcion_detalles_proveedores_precios_maquinaria: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecio_detalles_proveedores_precios_maquinaria: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_proveedores_precios_maquinaria = $('#frmProveedoresPreciosMaquinaria').data('bootstrapValidator');
			bootstrapValidator_proveedores_precios_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_proveedores_precios_maquinaria.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_proveedores_precios_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_proveedores_precios_maquinaria()
		{
			try
			{
				$('#frmProveedoresPreciosMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_proveedores_precios_maquinaria()
		{
			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_proveedores_precios_maquinaria').getElementsByTagName('tbody')[0];
			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrMaquinariaID = [];
			var arrPrecios = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intPrecio = $.reemplazar(objRen.cells[1].innerHTML, ",", "");
				//Asignar valores a los arrays
				arrMaquinariaID.push(objRen.getAttribute('id'));
				arrPrecios.push(intPrecio);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('maquinaria/proveedores_precios/guardar',
					{ 
						//Datos del proveedor
						intProveedorPrecioID: $('#txtProveedorPrecioID_proveedores_precios_maquinaria').val(),
						intProveedorID: $('#txtProveedorID_proveedores_precios_maquinaria').val(),
						intProveedorIDAnterior: $('#txtProveedorIDAnterior_proveedores_precios_maquinaria').val(),
						intMonedaID: $('#cmbMonedaID_proveedores_precios_maquinaria').val(),
						intMonedaIDAnterior: $('#txtMonedaIDAnterior_proveedores_precios_maquinaria').val(),
						//Datos de los detalles
						strMaquinariaID: arrMaquinariaID.join('|'),
						strPrecios: arrPrecios.join('|')
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_proveedores_precios_maquinaria();
							//Hacer un llamado a la función para cerrar modal
							cerrar_proveedores_precios_maquinaria();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_proveedores_precios_maquinaria(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_proveedores_precios_maquinaria(tipoMensaje, mensaje)
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
		function cambiar_estatus_proveedores_precios_maquinaria(id, estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtProveedorPrecioID_proveedores_precios_maquinaria').val();

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
						              'title':    'Lista de Precios de Compra',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                             	//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_proveedores_precios_maquinaria(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_proveedores_precios_maquinaria(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_proveedores_precios_maquinaria(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('maquinaria/proveedores_precios/set_estatus',
			      {intProveedorPrecioID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_proveedores_precios_maquinaria();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_proveedores_precios_maquinaria();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_proveedores_precios_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_proveedores_precios_maquinaria(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/proveedores_precios/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_proveedores_precios_maquinaria();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';

				          	//Recuperar valores
				            $('#txtProveedorPrecioID_proveedores_precios_maquinaria').val(data.row.proveedor_precio_id);
				            $('#txtProveedorID_proveedores_precios_maquinaria').val(data.row.proveedor_id);
				            $('#txtProveedorIDAnterior_proveedores_precios_maquinaria').val(data.row.proveedor_id);
				            $('#txtProveedor_proveedores_precios_maquinaria').val(data.row.proveedor);
				            $('#cmbMonedaID_proveedores_precios_maquinaria').val(data.row.moneda_id);
				            $('#txtMonedaIDAnterior_proveedores_precios_maquinaria').val(data.row.moneda_id);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_proveedores_precios_maquinaria').addClass("estatus-" + strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_proveedores_precios_maquinaria").show();

				            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
															 "	onclick='editar_renglon_proveedores_precios_maquinaria(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button>" + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
															 " 	onclick='eliminar_renglon_proveedores_precios_maquinaria(this)'>" + 
															 "<span class='glyphicon glyphicon-trash'></span></button>" + 
															 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
															 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
															 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
															 "<span class='glyphicon glyphicon-arrow-down'></span></button>"
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmProveedoresPreciosMaquinaria').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_proveedores_precios_maquinaria").hide(); 
								 //Deshabilitar botón Agregar
								$('#btnAgregar_proveedores_precios_maquinaria').prop('disabled',true);
								//Mostrar botón Restaurar
								$("#btnRestaurar_proveedores_precios_maquinaria").show();
							}
				            //Mostramos los detalles del registro
				            for (var intCon in data.detalles) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_proveedores_precios_maquinaria').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaDescripcion = objRenglon.insertCell(0);
								var objCeldaPrecio = objRenglon.insertCell(1);
								var objCeldaAcciones = objRenglon.insertCell(2);

								//Asignar valores
								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].maquinaria_descripcion_id);
								objCeldaDescripcion.setAttribute('class', 'movil b1');
								objCeldaDescripcion.innerHTML = data.detalles[intCon].maquinaria;
								objCeldaPrecio.setAttribute('class', 'movil b2');
								objCeldaPrecio.innerHTML = formatMoney(data.detalles[intCon].precio, 2, '');
								objCeldaAcciones.setAttribute('class', 'td-center movil b3');
								objCeldaAcciones.innerHTML = strAccionesTabla;
							}

							//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
							var intFilas = $("#dg_detalles_proveedores_precios_maquinaria tr").length - 1;
							$('#numElementos_detalles_proveedores_precios_maquinaria').html(intFilas);
							$('#txtNumDetalles_proveedores_precios_maquinaria').val(intFilas);

							//Mostrar los siguientes botones
							$("#btnImprimirRegistro_proveedores_precios_maquinaria").show();
							$("#btnDescargarXLSRegistro_proveedores_precios_maquinaria").show();

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {

				            	//Abrir modal
					            objProveedoresPreciosMaquinaria = $('#ProveedoresPreciosMaquinariaBox').bPopup({
															  appendTo: '#ProveedoresPreciosMaquinariaContent', 
								                              contentContainer: 'ProveedoresPreciosMaquinariaM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});
								//Enfocar caja de texto
								$('#txtProveedor_proveedores_precios_maquinaria').focus();
							}
						}
						else
						{
							//Hacer un llamado a la función para inicializar elementos del formulario
							inicializar_proveedores_precios_maquinaria();
							//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
							$('#divEncabezadoModal_proveedores_precios_maquinaria').addClass("estatus-NUEVO");
						}
						
					},
				'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_proveedores_precios_maquinaria()
		{
			//Verificar la existencia del registro
			if ($('#txtProveedorID_proveedores_precios_maquinaria').val() != '' && 
				$('#cmbMonedaID_proveedores_precios_maquinaria').val() != '')
			{
				//Concatenar criterios de búsqueda para poder verificar la existencia
				var strCriteriosBusqProveedoresPreciosMaquinaria = $('#txtProveedorID_proveedores_precios_maquinaria').val() + '|' + $('#cmbMonedaID_proveedores_precios_maquinaria').val();

				//Hacer un llamado a la función para recuperar los datos del registro que coincide con los id´s
				editar_proveedores_precios_maquinaria(strCriteriosBusqProveedoresPreciosMaquinaria, 'descripcion', 'Nuevo');
			}
		}


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_proveedores_precios_maquinaria()
		{
			//Obtenemos los datos de las cajas de texto
			var intMaquinariaDescripcionID = $('#txtMaquinariaDescripcionID_detalles_proveedores_precios_maquinaria').val();
			var strMaquinariaDescripcion = $('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').val();
			var intPrecio = $('#txtPrecio_detalles_proveedores_precios_maquinaria').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_proveedores_precios_maquinaria').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intMaquinariaDescripcionID == '' || strMaquinariaDescripcion == '')
			{
				//Enfocar caja de texto
				$('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').focus();
			}
			else if (intPrecio == '')
			{
				//Enfocar caja de texto
				$('#txtPrecio_detalles_proveedores_precios_maquinaria').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtMaquinariaDescripcionID_detalles_proveedores_precios_maquinaria').val('');
				$('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').val('');
				$('#txtPrecio_detalles_proveedores_precios_maquinaria').val('');

				//Convertir cadena de texto a número decimal
				intPrecio = parseFloat($.reemplazar(intPrecio, ",", ""));
				//Cambiar cantidad a  formato moneda (a visualizar)
				intPrecio =  formatMoney(intPrecio, 2, '');



				
				//Revisamos si existe el ID proporcionado, si es así, editamos el precio
				if (objTabla.rows.namedItem(intMaquinariaDescripcionID)){
					objTabla.rows.namedItem(intMaquinariaDescripcionID).cells[1].innerHTML = intPrecio;
				}
				else{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaDescripcion = objRenglon.insertCell(0);
					var objCeldaPrecio = objRenglon.insertCell(1);
					var objCeldaAcciones = objRenglon.insertCell(2);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intMaquinariaDescripcionID);
					objCeldaDescripcion.setAttribute('class', 'movil b1');
					objCeldaDescripcion.innerHTML = strMaquinariaDescripcion;
					objCeldaPrecio.setAttribute('class', 'movil b2');
					objCeldaPrecio.innerHTML = intPrecio;
					objCeldaAcciones.setAttribute('class', 'td-center movil b3');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_proveedores_precios_maquinaria(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_proveedores_precios_maquinaria(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				}
				//Enfocar caja de texto
				$('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_detalles_proveedores_precios_maquinaria tr").length - 1;
			$('#numElementos_detalles_proveedores_precios_maquinaria').html(intFilas);
			$('#txtNumDetalles_proveedores_precios_maquinaria').val(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_proveedores_precios_maquinaria(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtMaquinariaDescripcionID_detalles_proveedores_precios_maquinaria').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtPrecio_detalles_proveedores_precios_maquinaria').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);

			//Enfocar caja de texto
			$('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_proveedores_precios_maquinaria(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_proveedores_precios_maquinaria").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_detalles_proveedores_precios_maquinaria tr").length - 1;
			$('#numElementos_detalles_proveedores_precios_maquinaria').html(intFilas);
			$('#txtNumDetalles_proveedores_precios_maquinaria').val(intFilas);

			//Enfocar caja de texto
			$('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').focus();
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales
			$('#txtPrecio_detalles_proveedores_precios_maquinaria').numeric();
			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
			* por ejemplo: 1800 será 1,800.00*/
			$('.moneda_proveedores_precios_maquinaria').blur(function(){
				$('.moneda_proveedores_precios_maquinaria').formatCurrency({ roundToDecimalPlace: 2 });
			});

			//Autocomplete para recuperar los datos de un proveedor
			$('#txtProveedor_proveedores_precios_maquinaria').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtProveedorID_proveedores_precios_maquinaria').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "cuentas_pagar/proveedores/autocomplete",
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
					$('#txtProveedorID_proveedores_precios_maquinaria').val(ui.item.data);
					//Hacer un llamado a la función para verificar la existencia del registro
					verificar_existencia_proveedores_precios_maquinaria();
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
			$('#txtProveedor_proveedores_precios_maquinaria').focusout(function(e){
				//Si no existe id del producto
				if($('#txtProveedorID_proveedores_precios_maquinaria').val() == '' || 
					$('#txtProveedor_proveedores_precios_maquinaria').val() == '')
				{ 
					//Limpiar contenido de las siguientes cajas de texto
					$('#txtProveedorPrecioID_proveedores_precios_maquinaria').val('');
					$('#txtProveedorID_proveedores_precios_maquinaria').val('');
					$('#txtProveedor_proveedores_precios_maquinaria').val('');
					
				}

			});

			//Comprobar la existencia del proveedor en la BD cuando cambie la opción del combobox
			$('#cmbMonedaID_proveedores_precios_maquinaria').change(function(e){
				//Hacer un llamado a la función para verificar la existencia del registro
				verificar_existencia_proveedores_precios_maquinaria();
			});

			//Autocomplete para recuperar los datos de un código de maquinaria registrado
			$('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtMaquinariaDescripcionID_detalles_proveedores_precios_maquinaria').val('');
					$.ajax({
						//Hacer un llamado al método del controlador para regresar las coincidencias encontradas
						url: "maquinaria/maquinaria_descripciones/autocomplete",
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
					$('#txtMaquinariaDescripcionID_detalles_proveedores_precios_maquinaria').val(ui.item.data);
				},
				open: function() {
					$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				},
				minLength: 1
			});

			//Verificar que exista id de a maquinaria cuando pierda el enfoque la caja de texto
			$('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').focusout(function(e){
				//Si no existe id del producto
				if($('#txtMaquinariaDescripcionID_detalles_proveedores_precios_maquinaria').val() == '' ||
					$('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').val() == '')
				{ 
					//Limpiar contenido de las siguientes cajas de texto
					$('#txtMaquinariaDescripcionID_detalles_proveedores_precios_maquinaria').val('');
					$('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').val('');
				}
				
			});

			
			//Función para mover renglones arriba y abajo en la tabla
			$('#dg_detalles_proveedores_precios_maquinaria').on('click','button.btn',function(){
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


	        //Validar que exista descripción de maquinaria cuando se pulse la tecla enter 
			$('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe descripción de maquinaria
		            if($('#txtMaquinariaDescripcionID_detalles_proveedores_precios_maquinaria').val() == '' || $('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtMaquinariaDescripcion_detalles_proveedores_precios_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtPrecio_detalles_proveedores_precios_maquinaria').focus();
			   	    }
		        }
		    });

		    //Validar que exista precio cuando se pulse la tecla enter 
			$('#txtPrecio_detalles_proveedores_precios_maquinaria').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio
		            if($('#txtPrecio_detalles_proveedores_precios_maquinaria').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecio_detalles_proveedores_precios_maquinaria').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
		    			agregar_renglon_detalles_proveedores_precios_maquinaria();
			   	    }
		        }
		    });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_proveedores_precios_maquinaria').on('click','a',function(event){
				event.preventDefault();
				intPaginaProveedoresPreciosMaquinaria = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_proveedores_precios_maquinaria();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_proveedores_precios_maquinaria').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_proveedores_precios_maquinaria();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_proveedores_precios_maquinaria').addClass("estatus-NUEVO");
				//Abrir modal
				 objProveedoresPreciosMaquinaria = $('#ProveedoresPreciosMaquinariaBox').bPopup({
														appendTo: '#ProveedoresPreciosMaquinariaContent', 
														contentContainer: 'ProveedoresPreciosMaquinariaM', 
														zIndex: 2, 
														modalClose: false, 
														modal: true, 
														follow: [true,false], 
														followEasing : "linear", 
														easing: "linear", 
														modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtProveedor_proveedores_precios_maquinaria').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_proveedores_precios_maquinaria').focus();

			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_proveedores_precios_maquinaria();
			//Cargar monedas activas en el combobox del modal
			cargar_monedas_proveedores_precios_maquinaria();
		});
	</script>

