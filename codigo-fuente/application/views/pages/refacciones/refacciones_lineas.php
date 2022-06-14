	<div id="RefaccionesLineasRefaccionesContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_refacciones_lineas_refacciones" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_refacciones_lineas_refacciones" 
								   name="strBusqueda_refacciones_lineas_refacciones"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_refacciones_lineas_refacciones"
										onclick="paginacion_refacciones_lineas_refacciones();" 
										title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_refacciones_lineas_refacciones" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_refacciones_lineas_refacciones"
									onclick="reporte_refacciones_lineas_refacciones('PDF');" title="Imprimir reporte general en PDF"
									tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_refacciones_lineas_refacciones"
									onclick="reporte_refacciones_lineas_refacciones('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla líneas de refacciones
				*/
				td.movil.a1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Línea"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Módulo"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles de la línea de refacciones
				*/
				td.movil.b1:nth-of-type(1):before {content: "Lista de precios"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Porcentaje"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_refacciones_lineas_refacciones">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Línea</th>
							<th class="movil">Módulo</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_refacciones_lineas_refacciones" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil a1">{{codigo}}</td>
							<td class="movil a2">{{descripcion}}</td>
							<td class="movil a3">{{modulo}}</td>
							<td class="movil a4">{{estatus}}</td>
							<td class="td-center movil a5"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_refacciones_lineas_refacciones({{refacciones_linea_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_refacciones_lineas_refacciones({{refacciones_linea_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_refacciones_lineas_refacciones({{refacciones_linea_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_refacciones_lineas_refacciones({{refacciones_linea_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_refacciones_lineas_refacciones"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_refacciones_lineas_refacciones">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="RefaccionesLineasRefaccionesBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_refacciones_lineas_refacciones"  class="ModalBodyTitle">
			<h1>Líneas de Refacciones</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRefaccionesLineasRefacciones" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmRefaccionesLineasRefacciones"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Código-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtRefaccionesLineaID_refacciones_lineas_refacciones" 
										   name="intRefaccionesLineaID_refacciones_lineas_refacciones" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el código anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código-->
									<input id="txtCodigoAnterior_refacciones_lineas_refacciones" 
										   name="strCodigoAnterior_refacciones_lineas_refacciones" type="hidden" value="">
									</input>
									<label for="txtCodigo_refacciones_lineas_refacciones">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_refacciones_lineas_refacciones" 
											name="strCodigo_refacciones_lineas_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese código" maxlength="2">
									</input>
								</div>
							</div>
						</div>
					    <!--Descripción-->
						<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcion_refacciones_lineas_refacciones">Línea</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_refacciones_lineas_refacciones" 
									        name="strDescripcion_refacciones_lineas_refacciones" type="text" value="" 
											tabindex="1" placeholder="Ingrese línea" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los módulos activos (donde la factura sea: REFACCIONES)-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
									<input id="txtModuloID_refacciones_lineas_refacciones" 
										   name="intModuloID_refacciones_lineas_refacciones"  type="hidden" value="">
									</input>
									<label for="txtModulo_refacciones_lineas_refacciones">Módulo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtModulo_refacciones_lineas_refacciones" 
											name="strModulo_refacciones_lineas_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese módulo" maxlength="250">
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
											<h4 class="panel-title">Detalles de la línea de refacciones</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
												    <!--Autocomplete que contiene las listas de precios de refacciones activas-->
													<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id de la lista de precios de refacciones seleccionada-->
																<input id="txtRefaccionesListaPrecioID_detalles_refacciones_lineas_refacciones" 
																	   name="intRefaccionesListaPrecioID_detalles_refacciones_lineas_refacciones" 
																	   type="hidden" value="">
																</input>
																<label for="txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones">
																	Lista de precios
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" 
																		id="txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones" 
																		name="strRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese lista de precios" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Porcentaje de utilidad-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones">Porcentaje</label>
															</div>
															<div class="col-md-12">
																<div class='input-group'>
																	<input  class="form-control porcentaje_refacciones_lineas_refacciones" id="txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones" 
																			name="intPorcentajeUtilidad_detalles_refacciones_lineas_refacciones" type="text" value="" tabindex="1" placeholder="Ingrese porcentaje" maxlength="8">
																	</input>
																	<span class="input-group-addon">%</span>
																</div>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
													<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
														<button class="btn btn-primary btn-toolBtns" 
																id="btnAgregar_detalles_refacciones_lineas_refacciones" 
																onclick="agregar_renglon_detalles_refacciones_lineas_refacciones();" 
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
													<table class="table-hover movil" id="dg_detalles_refacciones_lineas_refacciones">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Lista de precios</th>
																<th class="movil">Porcentaje</th>
																<th class="movil" id="th-acciones" style="width:6em;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
													</table>
													<br>
													<div class="row">
														<!--Número de registros encontrados-->
														<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
															<button class="btn btn-default btn-sm disabled pull-right">
																<strong id="numElementos_detalles_refacciones_lineas_refacciones">0</strong> encontrados
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
							<button class="btn btn-success" id="btnGuardar_refacciones_lineas_refacciones"  
									onclick="validar_refacciones_lineas_refacciones();"  title="Guardar" 
									tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_refacciones_lineas_refacciones"  
									onclick="cambiar_estatus_refacciones_lineas_refacciones('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_refacciones_lineas_refacciones"  
									onclick="cambiar_estatus_refacciones_lineas_refacciones('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_refacciones_lineas_refacciones"
									type="reset" aria-hidden="true" onclick="cerrar_refacciones_lineas_refacciones();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#RefaccionesLineasRefaccionesContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaRefaccionesLineasRefacciones = 0;
		var strUltimaBusquedaRefaccionesLineasRefacciones = "";
		//Variable que se utiliza para asignar el módulo del tipo de factura
		var strFacturaModuloRefaccionesLineasRefacciones = "REFACCIONES";
		//Variable que se utiliza para asignar objeto del modal
		var objRefaccionesLineasRefacciones = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_refacciones_lineas_refacciones()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('refacciones/refacciones_lineas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_refacciones_lineas_refacciones').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosRefaccionesLineasRefacciones = data.row;
					//Separar la cadena 
					var arrPermisosRefaccionesLineasRefacciones = strPermisosRefaccionesLineasRefacciones.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosRefaccionesLineasRefacciones.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosRefaccionesLineasRefacciones[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_refacciones_lineas_refacciones').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosRefaccionesLineasRefacciones[i]=='GUARDAR') || (arrPermisosRefaccionesLineasRefacciones[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_refacciones_lineas_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesLineasRefacciones[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_refacciones_lineas_refacciones').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_refacciones_lineas_refacciones();
						}
						else if(arrPermisosRefaccionesLineasRefacciones[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_refacciones_lineas_refacciones').removeAttr('disabled');
							$('#btnRestaurar_refacciones_lineas_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesLineasRefacciones[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_refacciones_lineas_refacciones').removeAttr('disabled');
						}
						else if(arrPermisosRefaccionesLineasRefacciones[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_refacciones_lineas_refacciones').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_refacciones_lineas_refacciones() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_refacciones_lineas_refacciones').val() != strUltimaBusquedaRefaccionesLineasRefacciones)
			{
				intPaginaRefaccionesLineasRefacciones = 0;
				strUltimaBusquedaRefaccionesLineasRefacciones = $('#txtBusqueda_refacciones_lineas_refacciones').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('refacciones/refacciones_lineas/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_refacciones_lineas_refacciones').val(),
						intPagina:intPaginaRefaccionesLineasRefacciones,
						strPermisosAcceso: $('#txtAcciones_refacciones_lineas_refacciones').val()
					},
					function(data){
						$('#dg_refacciones_lineas_refacciones tbody').empty();
						var tmpRefaccionesLineasRefacciones = Mustache.render($('#plantilla_refacciones_lineas_refacciones').html(),data);
						$('#dg_refacciones_lineas_refacciones tbody').html(tmpRefaccionesLineasRefacciones);
						$('#pagLinks_refacciones_lineas_refacciones').html(data.paginacion);
						$('#numElementos_refacciones_lineas_refacciones').html(data.total_rows);
						intPaginaRefaccionesLineasRefacciones = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_refacciones_lineas_refacciones(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'refacciones/refacciones_lineas/';

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

			//Definir encapsulamiento de datos que son necesarios para generar el reporte
			objReporte = {'url': strUrl,
							'data' : {
										'strBusqueda': $('#txtBusqueda_refacciones_lineas_refacciones').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_refacciones_lineas_refacciones()
		{
			//Incializar formulario
			$('#frmRefaccionesLineasRefacciones')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_lineas_refacciones();
			//Limpiar cajas de texto ocultas
			$('#frmRefaccionesLineasRefacciones').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_refacciones_lineas_refacciones');
			//Eliminar los datos de la tabla precios
			$('#dg_detalles_refacciones_lineas_refacciones tbody').empty();
			$('#numElementos_detalles_refacciones_lineas_refacciones').html(0);
			//Habilitar todos los elementos del formulario
			$('#frmRefaccionesLineasRefacciones').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_refacciones_lineas_refacciones").show();
			//Habilitar botón Agregar
			$('#btnAgregar_detalles_refacciones_lineas_refacciones').prop('disabled', false);
			//Ocultar los siguientes botones
			$("#btnDesactivar_refacciones_lineas_refacciones").hide();
			$("#btnRestaurar_refacciones_lineas_refacciones").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_refacciones_lineas_refacciones()
		{
			try {
				//Cerrar modal
				objRefaccionesLineasRefacciones.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_refacciones_lineas_refacciones').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_refacciones_lineas_refacciones()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_refacciones_lineas_refacciones();
			//Validación del formulario de campos obligatorios
			$('#frmRefaccionesLineasRefacciones')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo_refacciones_lineas_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba el código para esta línea'}
											}
										},
										strDescripcion_refacciones_lineas_refacciones: {
											validators: {
												notEmpty: {message: 'Escriba una línea'}
											}
										},
										strModulo_refacciones_lineas_refacciones: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del módulo
					                                    if($('#txtModuloID_refacciones_lineas_refacciones').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un módulo existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										}, 
										strRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPorcentajeUtilidad_detalles_refacciones_lineas_refacciones: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_refacciones_lineas_refacciones = $('#frmRefaccionesLineasRefacciones').data('bootstrapValidator');
			bootstrapValidator_refacciones_lineas_refacciones.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_refacciones_lineas_refacciones.isValid())
			{
				//Hacer un llamado a la función para validar que los detalles cuenten con porcentaje de utilidad  (mayor a cero)
				validar_detalles_refacciones_lineas_refacciones();
			}
			else 
				return;
		}

		//Función que se utiliza para validar que los detalles cuenten con porcentaje de utilidad (mayor a cero)
		function validar_detalles_refacciones_lineas_refacciones()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_refacciones_lineas_refacciones').getElementsByTagName('tbody')[0];
			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrRefaccionesListaPrecioID = [];
			var arrPorcentajesUtilidad = [];

			//Array que se utiliza para agregar las listas de precios incorrectas
			var arrDetallesIncorrectos = [];
			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Variables que se utilizan para asignar valores del detalle
				var strRefaccionesListaPrecio = objRen.cells[0].innerHTML;
				var intPorcentajeUtilidad = parseFloat(objRen.cells[1].innerHTML);
			    //Si existe porcentaje de utilidad
				if(intPorcentajeUtilidad > 0)
				{
					//Asignar valores a los arrays
					arrRefaccionesListaPrecioID.push(objRen.getAttribute('id'));
					arrPorcentajesUtilidad.push(intPorcentajeUtilidad);
				}
				else
				{
					//Agregar refacción en el array, de esta manera, el usuario identificara las listas de precios incorrectas
					arrDetallesIncorrectos.push(strRefaccionesListaPrecio);
				}
			}

			//Si existen listas de precios incorrectas
			if(arrDetallesIncorrectos.length > 0)
			{
				//Mensaje que se utiliza para informar al usuario la lista de precios incorrectas
				var strMensaje = 'La línea de refacciones no puede guardarse. Las siguientes <b>listas de precios</b> no tienen porcentaje de utilidad (0.00):<br>';

				//Hacer recorrido para obtener listas de precios incorrectas
				for(var intCont = 0; intCont < arrDetallesIncorrectos.length; intCont++)
				{
					//Agregar refacción en el mensaje
            		strMensaje = strMensaje + arrDetallesIncorrectos[intCont] + '<br/>';
				}

				//Hacer un llamado a la función para mostrar mensaje de error
				mensaje_refacciones_lineas_refacciones('error', strMensaje);
			}
			else
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_refacciones_lineas_refacciones(arrRefaccionesListaPrecioID, arrPorcentajesUtilidad);
			}

		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_refacciones_lineas_refacciones()
		{
			try
			{
				$('#frmRefaccionesLineasRefacciones').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_refacciones_lineas_refacciones(arrRefaccionesListaPrecioID, arrPorcentajesUtilidad)
		{
			
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('refacciones/refacciones_lineas/guardar',
					{ 
						//Datos de la línea de refacción
						intRefaccionesLineaID: $('#txtRefaccionesLineaID_refacciones_lineas_refacciones').val(),
						strCodigo: $('#txtCodigo_refacciones_lineas_refacciones').val(),
						strCodigoAnterior: $('#txtCodigoAnterior_refacciones_lineas_refacciones').val(),
						strDescripcion: $('#txtDescripcion_refacciones_lineas_refacciones').val(),
						intModuloID: $('#txtModuloID_refacciones_lineas_refacciones').val(), 
						//Datos de los detalles
						strRefaccionesListaPrecioID: arrRefaccionesListaPrecioID.join('|'),
						strPorcentajesUtilidad: arrPorcentajesUtilidad.join('|')
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_refacciones_lineas_refacciones();
							//Hacer un llamado a la función para cerrar modal
							cerrar_refacciones_lineas_refacciones();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_refacciones_lineas_refacciones(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_refacciones_lineas_refacciones(tipoMensaje, mensaje)
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
		function cambiar_estatus_refacciones_lineas_refacciones(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtRefaccionesLineaID_refacciones_lineas_refacciones').val();

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
						              'title':    'Líneas de Refacciones',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado a la función para modificar el estatus del registro
													  set_estatus_refacciones_lineas_refacciones(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_refacciones_lineas_refacciones(intID, strTipo, 'ACTIVO');
		    }
		}


		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_refacciones_lineas_refacciones(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('refacciones/refacciones_lineas/set_estatus',
			      {intRefaccionesLineaID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_refacciones_lineas_refacciones();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_refacciones_lineas_refacciones();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_refacciones_lineas_refacciones(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_refacciones_lineas_refacciones(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/refacciones_lineas/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_refacciones_lineas_refacciones();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtRefaccionesLineaID_refacciones_lineas_refacciones').val(data.row.refacciones_linea_id);
				            $('#txtCodigo_refacciones_lineas_refacciones').val(data.row.codigo);
				            $('#txtCodigoAnterior_refacciones_lineas_refacciones').val(data.row.codigo);
				            $('#txtDescripcion_refacciones_lineas_refacciones').val(data.row.descripcion);
				            $('#txtModuloID_refacciones_lineas_refacciones').val(data.row.modulo_id);
				            $('#txtModulo_refacciones_lineas_refacciones').val(data.row.modulo);
				            //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_refacciones_lineas_refacciones').addClass("estatus-"+strEstatus);
				            //Hacer llamado a la función  para cargar las listas de precios activas en el grid
				            listas_precios_refacciones_lineas_refacciones(strEstatus);
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_refacciones_lineas_refacciones").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmRefaccionesLineasRefacciones').find('input, textarea, select').attr('disabled','disabled');
			            		//Deshabilitar botón Agregar
								$('#btnAgregar_detalles_refacciones_lineas_refacciones').prop('disabled', true);
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_refacciones_lineas_refacciones").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_refacciones_lineas_refacciones").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objRefaccionesLineasRefacciones = $('#RefaccionesLineasRefaccionesBox').bPopup({
															  appendTo: '#RefaccionesLineasRefaccionesContent', 
								                              contentContainer: 'RefaccionesLineasRefaccionesM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCodigo_refacciones_lineas_refacciones').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Función para la búsqueda de listas de precios activas
		function listas_precios_refacciones_lineas_refacciones(estatus) 
		{
			//Variable que se utiliza para asignar las acciones del grid view
		    var strAccionesTabla = '';

		    //Si se cumple la sentencia
			if(estatus == '' || estatus == 'ACTIVO')
			{
				strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
									"	onclick='editar_renglon_detalles_refacciones_lineas_refacciones(this)'>" + 
								    "<span class='glyphicon glyphicon-edit'></span></button>";
			}

			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('refacciones/refacciones_lineas/get_datos_detalles',
			       {intRefaccionesLineaID: $('#txtRefaccionesLineaID_refacciones_lineas_refacciones').val()
			       },
			       function(data) {
			            //Mostramos los detalles del registro
			            for (var intCon in data.detalles) 
			            {
			            	//Obtenemos el objeto de la tabla
							var objTabla = document.getElementById('dg_detalles_refacciones_lineas_refacciones').getElementsByTagName('tbody')[0];
							//Insertamos el renglón con sus celdas en el objeto de la tabla
							var objRenglon = objTabla.insertRow();
							var objCeldaDescripcion = objRenglon.insertCell(0);
							var objCeldaPorcentajeUtilidad = objRenglon.insertCell(1);
							var objCeldaAcciones = objRenglon.insertCell(2);

							//Asignar valores
							objRenglon.setAttribute('class', 'movil');
							objRenglon.setAttribute('id', data.detalles[intCon].refacciones_lista_precio_id);
							objCeldaDescripcion.setAttribute('class', 'movil b1');
							objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
							objCeldaPorcentajeUtilidad.setAttribute('class', 'movil b2');
							objCeldaPorcentajeUtilidad.innerHTML = formatMoney(data.detalles[intCon].porcentaje_utilidad, 2, '');
							objCeldaAcciones.setAttribute('class', 'td-center movil b3');
							objCeldaAcciones.innerHTML = strAccionesTabla;
			            }

			            //Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
						var intFilas = $("#dg_detalles_refacciones_lineas_refacciones tr").length - 1;
						$('#numElementos_detalles_refacciones_lineas_refacciones').html(intFilas);
			       },
			       'json');

		}


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_refacciones_lineas_refacciones()
		{
			//Obtenemos los datos de las cajas de texto
			var intRefaccionesListaPrecioID = $('#txtRefaccionesListaPrecioID_detalles_refacciones_lineas_refacciones').val();
			var strRefaccionesListaPrecio = $('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').val();
			var intPorcentajeUtilidad = $('#txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_refacciones_lineas_refacciones').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intRefaccionesListaPrecioID == '' || strRefaccionesListaPrecio == '')
			{
				//Enfocar caja de texto
				$('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').focus();
			}
			else if (intPorcentajeUtilidad == '' || 
					 parseFloat($.reemplazar(intPorcentajeUtilidad, ",", "")) == 0 || 
					 parseFloat($.reemplazar(intPorcentajeUtilidad, ",", "")) > 100)
			{
				//Limpiar caja de texto
				$('#txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones').val('');
				//Enfocar caja de texto
				$('#txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtRefaccionesListaPrecioID_detalles_refacciones_lineas_refacciones').val('');
				$('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').val('');
				$('#txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones').val('');

				//Convertir cadena de texto a número decimal
				intPorcentajeUtilidad = parseFloat($.reemplazar(intPorcentajeUtilidad, ",", ""));

				//Editar el porcentaje de utilidad del detalle
				objTabla.rows.namedItem(intRefaccionesListaPrecioID).cells[1].innerHTML = formatMoney(intPorcentajeUtilidad, 2, '');
				
				//Enfocar caja de texto
				$('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_detalles_refacciones_lineas_refacciones tr").length - 1;
			$('#numElementos_detalles_refacciones_lineas_refacciones').html(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_refacciones_lineas_refacciones(objRenglon)
		{
			//Variable que se utiliza para asignar el porcentaje de utilidad
			var intPorcentajeUtilidad = parseFloat(objRenglon.parentNode.parentNode.cells[1].innerHTML); 
			//Si existe porcentaje de utilidad
			if(intPorcentajeUtilidad > 0)
			{
				//Convertir cantidad a formato moneda
				intPorcentajeUtilidad = formatMoney(intPorcentajeUtilidad, 2, '');
			}
			else
			{
				//Asignar cadena vacia para obligar al usuario a capturar un porcentaje mayor 
                intPorcentajeUtilidad = '';
			}

			//Asignar los valores a las cajas de texto
			$('#txtRefaccionesListaPrecioID_detalles_refacciones_lineas_refacciones').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones').val(intPorcentajeUtilidad);
			//Enfocar caja de texto
			$('#txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_refacciones_lineas_refacciones(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_refacciones_lineas_refacciones").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde a la cabecera de la tabla)
			var intFilas = $("#dg_detalles_refacciones_lineas_refacciones tr").length - 1;
			$('#numElementos_detalles_refacciones_lineas_refacciones').html(intFilas);

			//Enfocar caja de texto
			$('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').focus();
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campo para introducir solamente letras
			$('#txtCodigo_refacciones_lineas_refacciones').letras();
			//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones').numeric();

        	/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
			* por ejemplo: 10 será 10.00*/
			$('.porcentaje_refacciones_lineas_refacciones').blur(function(){
				$('.porcentaje_refacciones_lineas_refacciones').formatCurrency({ roundToDecimalPlace: 2 });
			});

        	
			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo_refacciones_lineas_refacciones').focusout(function(e){
				//Si no existe id, verificar la existencia del código
				if ($('#txtRefaccionesLineaID_refacciones_lineas_refacciones').val() == '' && $('#txtCodigo_refacciones_lineas_refacciones').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código 
					editar_refacciones_lineas_refacciones($('#txtCodigo_refacciones_lineas_refacciones').val(), 'codigo', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de un módulo (donde la factura sea: REFACCIONES)
	        $('#txtModulo_refacciones_lineas_refacciones').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloID_refacciones_lineas_refacciones').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/modulos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   strFactura: strFacturaModuloRefaccionesLineasRefacciones
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
		            //Asignar id del registro seleccionado
		            $('#txtModuloID_refacciones_lineas_refacciones').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del módulo cuando pierda el enfoque la caja de texto
	        $('#txtModulo_refacciones_lineas_refacciones').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloID_refacciones_lineas_refacciones').val() == '' ||
	               $('#txtModulo_refacciones_lineas_refacciones').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtModuloID_refacciones_lineas_refacciones').val('');
	               $('#txtModulo_refacciones_lineas_refacciones').val('');
	            }
	            
	        });

	        //Autocomplete para recuperar los datos de una lista de precios 
			$('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').autocomplete({
				source: function(request, response) {
					//Limpiar caja de texto que hace referencia al id del registro 
					$('#txtRefaccionesListaPrecioID_detalles_refacciones_lineas_refacciones').val('');
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
					$('#txtRefaccionesListaPrecioID_detalles_refacciones_lineas_refacciones').val(ui.item.data);
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
			$('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').focusout(function(e){
				//Si no existe id de la lista de precios de refacciones
				if($('#txtRefaccionesListaPrecioID_detalles_refacciones_lineas_refacciones').val() == '' ||
					$('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').val() == '')
				{ 
					//Limpiar contenido de las siguientes cajas de texto
					$('#txtRefaccionesListaPrecioID_detalles_refacciones_lineas_refacciones').val('');
					$('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').val('');
				}
				
			});

			//Validar que exista lista de precios cuando se pulse la tecla enter 
			$('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe lista de precios
		            if($('#txtRefaccionesListaPrecioID_detalles_refacciones_lineas_refacciones').val() == '' || $('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtRefaccionesListaPrecio_detalles_refacciones_lineas_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Enfocar caja de texto
					    $('#txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones').focus();
			   	    }
		        }
		    });

		    //Validar que exista procentaje de utilidad cuando se pulse la tecla enter 
			$('#txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe porcentaje de utilidad
		            if($('#txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPorcentajeUtilidad_detalles_refacciones_lineas_refacciones').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
		    			agregar_renglon_detalles_refacciones_lineas_refacciones();
			   	    }
		        }
		    });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_refacciones_lineas_refacciones').on('click','a',function(event){
				event.preventDefault();
				intPaginaRefaccionesLineasRefacciones = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_refacciones_lineas_refacciones();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_refacciones_lineas_refacciones').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_refacciones_lineas_refacciones();
				//Hacer llamado a la función  para cargar las listas de precios activas en el grid
				listas_precios_refacciones_lineas_refacciones('');
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_refacciones_lineas_refacciones').addClass("estatus-NUEVO");
				//Abrir modal
				 objRefaccionesLineasRefacciones = $('#RefaccionesLineasRefaccionesBox').bPopup({
											   appendTo: '#RefaccionesLineasRefaccionesContent', 
				                               contentContainer: 'RefaccionesLineasRefaccionesM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_refacciones_lineas_refacciones').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_refacciones_lineas_refacciones').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_refacciones_lineas_refacciones();
		});
	</script>