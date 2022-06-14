	<div id="EquiposTiposServicioContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_equipos_tipos_servicio" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_equipos_tipos_servicio" 
								   name="strBusqueda_equipos_tipos_servicio"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_equipos_tipos_servicio"
										onclick="paginacion_equipos_tipos_servicio();" 
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
							<button class="btn btn-info" id="btnNuevo_equipos_tipos_servicio" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_equipos_tipos_servicio"
									onclick="reporte_equipos_tipos_servicio('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_equipos_tipos_servicio"
									onclick="reporte_equipos_tipos_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla tipos de equipos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Tipo"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Estatus"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}

			    /*
				Definir columnas de la tabla detalles
				*/
				td.movil.b1:nth-of-type(1):before {content: "Tipo"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Precio"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_equipos_tipos_servicio">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Tipo</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_equipos_tipos_servicio" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{descripcion}}</td>
							<td class="movil a2">{{estatus}}</td>
							<td class="td-center movil a3"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_equipos_tipos_servicio({{equipo_tipo_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_equipos_tipos_servicio({{equipo_tipo_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_equipos_tipos_servicio({{equipo_tipo_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_equipos_tipos_servicio({{equipo_tipo_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_equipos_tipos_servicio"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_equipos_tipos_servicio">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="EquiposTiposServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_equipos_tipos_servicio"  class="ModalBodyTitle">
			<h1>Tipos de Equipos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEquiposTiposServicio" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmEquiposTiposServicio"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Descripción-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtEquipoTipoID_equipos_tipos_servicio" 
										   name="intEquipoTipoID_equipos_tipos_servicio" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción-->
									<input id="txtDescripcionAnterior_equipos_tipos_servicio" 
										   name="strDescripcionAnterior_equipos_tipos_servicio" type="hidden" value="">
									</input>
									<label for="txtDescripcion_equipos_tipos_servicio">Tipo de equipo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_equipos_tipos_servicio" 
											name="strDescripcion_equipos_tipos_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese tipo de equipo" maxlength="50">
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
											<h4 class="panel-title">Precios capturados</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Autocomplete que contiene los tipos de servicios activos-->
													<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta que se utiliza para recuperar el id del tipo de servicio seleccionado-->
																<input id="txtServicioTipoID_detalles_equipos_tipos_servicio" 
																	   name="intServicioTipoID_equipos_tipos_servicio"  type="hidden" 
																	   value="">
																</input>
																<label for="txtServicioTipo_detalles_equipos_tipos_servicio">
																	Tipo de servicio
																</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control" id="txtServicioTipo_detalles_equipos_tipos_servicio" 
																		name="strServicioTipo_detalles_equipos_tipos_servicio" type="text" value="" 
																		tabindex="1" placeholder="Ingrese tipo de servicio" maxlength="250">
																</input>
															</div>
														</div>
													</div>
													<!--Precio-->
													<div class="col-sm-3 col-md-3 col-lg-3 col-xs-10">
														<div class="form-group">
															<div class="col-md-12">
																<label for="txtPrecio_detalles_equipos_tipos_servicio">Precio</label>
															</div>
															<div class="col-md-12">
																<input  class="form-control moneda_equipos_tipos_servicio" 
																		id="txtPrecio_detalles_equipos_tipos_servicio" 
																		name="intPrecio_detalles_equipos_tipos_servicio" 
																		type="text" value="" tabindex="1"
																		placeholder="Ingrese precio" maxlength="11">
																</input>
															</div>
														</div>
													</div>
													<!--Botón agregar-->
					                              	<div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
					                                	<button class="btn btn-primary btn-toolBtns pull-right" 
					                                			id="btnAgregar_equipos_tipos_servicio"
					                                			onclick="agregar_renglon_detalles_equipos_tipos_servicio();" 
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
													<table class="table-hover movil" id="dg_detalles_equipos_tipos_servicio">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Tipo</th>
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
																<strong id="numElementos_detalles_equipos_tipos_servicio">0</strong> encontrados
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
							<button class="btn btn-success" id="btnGuardar_equipos_tipos_servicio"  
									onclick="validar_equipos_tipos_servicio();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_equipos_tipos_servicio"  
									onclick="cambiar_estatus_equipos_tipos_servicio('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_equipos_tipos_servicio"  
									onclick="cambiar_estatus_equipos_tipos_servicio('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button> 
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_equipos_tipos_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_equipos_tipos_servicio();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#EquiposTiposServicioContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaEquiposTiposServicio = 0;
		var strUltimaBusquedaEquiposTiposServicio = "";
		//Variable que se utiliza para asignar objeto del modal
		var objEquiposTiposServicio = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_equipos_tipos_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/equipos_tipos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_equipos_tipos_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosEquiposTiposServicio = data.row;
					//Separar la cadena 
					var arrPermisosEquiposTiposServicio = strPermisosEquiposTiposServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosEquiposTiposServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosEquiposTiposServicio[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_equipos_tipos_servicio').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosEquiposTiposServicio[i]=='GUARDAR') || (arrPermisosEquiposTiposServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_equipos_tipos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosEquiposTiposServicio[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_equipos_tipos_servicio').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_equipos_tipos_servicio();
						}
						else if(arrPermisosEquiposTiposServicio[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_equipos_tipos_servicio').removeAttr('disabled');
							$('#btnRestaurar_equipos_tipos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosEquiposTiposServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_equipos_tipos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosEquiposTiposServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_equipos_tipos_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_equipos_tipos_servicio() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_equipos_tipos_servicio').val() != strUltimaBusquedaEquiposTiposServicio)
			{
				intPaginaEquiposTiposServicio = 0;
				strUltimaBusquedaEquiposTiposServicio = $('#txtBusqueda_equipos_tipos_servicio').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/equipos_tipos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_equipos_tipos_servicio').val(),
						intPagina:intPaginaEquiposTiposServicio,
						strPermisosAcceso: $('#txtAcciones_equipos_tipos_servicio').val()
					},
					function(data){
						$('#dg_equipos_tipos_servicio tbody').empty();
						var tmpEquiposTiposServicio = Mustache.render($('#plantilla_equipos_tipos_servicio').html(),data);
						$('#dg_equipos_tipos_servicio tbody').html(tmpEquiposTiposServicio);
						$('#pagLinks_equipos_tipos_servicio').html(data.paginacion);
						$('#numElementos_equipos_tipos_servicio').html(data.total_rows);
						intPaginaEquiposTiposServicio = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_equipos_tipos_servicio(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/equipos_tipos/';

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
										'strBusqueda': $('#txtBusqueda_equipos_tipos_servicio').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}
		

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_equipos_tipos_servicio()
		{
			//Incializar formulario
			$('#frmEquiposTiposServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_equipos_tipos_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmEquiposTiposServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_equipos_tipos_servicio');
			//Eliminar los datos de la tabla detalles del tipo de equipo
		    $('#dg_detalles_equipos_tipos_servicio tbody').empty();
			$('#numElementos_detalles_equipos_tipos_servicio').html(0);
			//Habilitar todos los elementos del formulario
			$('#frmEquiposTiposServicio').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_equipos_tipos_servicio").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_equipos_tipos_servicio").hide();
			$("#btnRestaurar_equipos_tipos_servicio").hide();
			//Habilitar botón Agregar precios de los equipos
			$('#btnAgregar_equipos_tipos_servicio').removeAttr('disabled');
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_equipos_tipos_servicio()
		{
			try {
				//Cerrar modal
				objEquiposTiposServicio.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_equipos_tipos_servicio').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_equipos_tipos_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_equipos_tipos_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmEquiposTiposServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_equipos_tipos_servicio: {
											validators: {
												notEmpty: {message: 'Escriba un tipo de equipo'}
											}
										},
										strServicioTipo_detalles_equipos_tipos_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										},
										intPrecio_detalles_equipos_tipos_servicio: {
											excluded: true  // Ignorar (no valida el campo)
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_equipos_tipos_servicio = $('#frmEquiposTiposServicio').data('bootstrapValidator');
			bootstrapValidator_equipos_tipos_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_equipos_tipos_servicio.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_equipos_tipos_servicio();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_equipos_tipos_servicio()
		{
			try
			{
				$('#frmEquiposTiposServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_equipos_tipos_servicio()
		{
			//Obtenemos el objeto de la tabla detalles
			var objTabla = document.getElementById('dg_detalles_equipos_tipos_servicio').getElementsByTagName('tbody')[0];

			//Inicializamos las variables que obtendrán los datos de la tabla
			var arrServicioTipoID = [];
			var arrPrecios = [];

			//Recorrer los renglones de la tabla para obtener los valores
			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
			{
				//Hacer un llamado a la función para reemplazar ',' por cadena vacia
				var intPrecio = $.reemplazar(objRen.cells[1].innerHTML, ",", "");
				//Asignar valores a los arrays
				arrServicioTipoID.push(objRen.getAttribute('id'));
				arrPrecios.push(intPrecio);
			}

			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('servicio/equipos_tipos/guardar',
					{ 
						//Datos del tipo de equipo
						intEquipoTipoID: $('#txtEquipoTipoID_equipos_tipos_servicio').val(),
						strDescripcion: $('#txtDescripcion_equipos_tipos_servicio').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_equipos_tipos_servicio').val(),
						//Datos de los detalles
						strServicioTipoID: arrServicioTipoID.join('|'),
						strPrecios: arrPrecios.join('|')
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_equipos_tipos_servicio();
							//Hacer un llamado a la función para cerrar modal
							cerrar_equipos_tipos_servicio();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_equipos_tipos_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_equipos_tipos_servicio(tipoMensaje, mensaje)
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
		function cambiar_estatus_equipos_tipos_servicio(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtEquipoTipoID_equipos_tipos_servicio').val();

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
						              'title':    'Tipos de Equipos',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              	//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_equipos_tipos_servicio(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_equipos_tipos_servicio(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_equipos_tipos_servicio(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('servicio/equipos_tipos/set_estatus',
			      {intEquipoTipoID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_equipos_tipos_servicio();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_equipos_tipos_servicio();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_equipos_tipos_servicio(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_equipos_tipos_servicio(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/equipos_tipos/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_equipos_tipos_servicio();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				             //Variable que se utiliza para asignar las acciones del grid view
				            var strAccionesTabla = '';
				            
				          	//Recuperar valores
				            $('#txtEquipoTipoID_equipos_tipos_servicio').val(data.row.equipo_tipo_id);
				            $('#txtDescripcion_equipos_tipos_servicio').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_equipos_tipos_servicio').val(data.row.descripcion);
				            //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_equipos_tipos_servicio').addClass("estatus-"+strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_equipos_tipos_servicio").show();

				            	strAccionesTabla = "<button class='btn btn-default btn-xs' title='Editar'" +
												 			 "   onclick='editar_renglon_detalles_equipos_tipos_servicio(this)'>" + 
															 "<span class='glyphicon glyphicon-edit'></span></button> " + 
															 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 			 "  onclick='eliminar_renglon_detalles_equipos_tipos_servicio(this)'>" + 
												 			"<span class='glyphicon glyphicon-trash'></span></button>";
							    
								

							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmEquiposTiposServicio').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_equipos_tipos_servicio").hide(); 
				           		//Deshabilitar botón Agregar precios de los equipos
			            		$('#btnAgregar_equipos_tipos_servicio').attr("disabled", "disabled");
								//Mostrar botón Restaurar
								$("#btnRestaurar_equipos_tipos_servicio").show();
							}

							//Mostramos los detalles del registro
				            for (var intCon in data.detalles) 
				            {
				            	//Obtenemos el objeto de la tabla
								var objTabla = document.getElementById('dg_detalles_equipos_tipos_servicio').getElementsByTagName('tbody')[0];
								//Insertamos el renglón con sus celdas en el objeto de la tabla
								var objRenglon = objTabla.insertRow();
								var objCeldaServicioTipo = objRenglon.insertCell(0);
								var objCeldaPrecio = objRenglon.insertCell(1);
								var objCeldaAcciones = objRenglon.insertCell(2);

								objRenglon.setAttribute('class', 'movil');
								objRenglon.setAttribute('id', data.detalles[intCon].servicio_tipo_id);
								objCeldaServicioTipo.setAttribute('class', 'movil b1');
								objCeldaServicioTipo.innerHTML = data.detalles[intCon].servicio_tipo;
								objCeldaPrecio.setAttribute('class', 'movil b2');
								objCeldaPrecio.innerHTML = formatMoney(data.detalles[intCon].precio, 2, '');
								objCeldaAcciones.setAttribute('class', 'td-center movil b3');
								objCeldaAcciones.innerHTML = strAccionesTabla;
							}

							//Asignar el número de filas de la tabla cultivos (se quita la primer fila por que corresponde al encabezado de la tabla)
							var intFilas = $("#dg_detalles_equipos_tipos_servicio tr").length - 1;
							$('#numElementos_detalles_equipos_tipos_servicio').html(intFilas);     

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objEquiposTiposServicio = $('#EquiposTiposServicioBox').bPopup({
															  appendTo: '#EquiposTiposServicioContent', 
								                              contentContainer: 'EquiposTiposServicioM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtDescripcion_equipos_tipos_servicio').focus();
					        }
			       	    }
			       },
			       'json');
		}


		/*******************************************************************************************************************
		Funciones de la tabla detalles
		*********************************************************************************************************************/
		//Función para agregar renglón a la tabla
		function agregar_renglon_detalles_equipos_tipos_servicio()
		{
			//Obtenemos los datos de las cajas de texto
			var intServicioTipoID = $('#txtServicioTipoID_detalles_equipos_tipos_servicio').val();
			var strServicioTipo = $('#txtServicioTipo_detalles_equipos_tipos_servicio').val();
			var intPrecio = $('#txtPrecio_detalles_equipos_tipos_servicio').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dg_detalles_equipos_tipos_servicio').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (intServicioTipoID == '' || strServicioTipo == '')
			{
				//Enfocar caja de texto
				$('#txtServicioTipo_detalles_equipos_tipos_servicio').focus();
			}
			else if (intPrecio == '')
			{
				//Enfocar caja de texto
				$('#txtPrecio_detalles_equipos_tipos_servicio').focus();
			}
			else
			{
				//Limpiamos las cajas de texto
				$('#txtServicioTipoID_detalles_equipos_tipos_servicio').val('');
				$('#txtServicioTipo_detalles_equipos_tipos_servicio').val('');
				$('#txtPrecio_detalles_equipos_tipos_servicio').val('');

				//Convertir cadena de texto a número decimal
				intPrecio = parseFloat($.reemplazar(intPrecio, ",", ""));

				//Revisamos si existe el ID proporcionado, si es así, editamos el precio
				if (objTabla.rows.namedItem(intServicioTipoID))
				{
					objTabla.rows.namedItem(intServicioTipoID).cells[1].innerHTML = formatMoney(intPrecio, 2, '');;
				}
				else
				{
					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaServicioTipo = objRenglon.insertCell(0);
					var objCeldaPrecio = objRenglon.insertCell(1);
					var objCeldaAcciones = objRenglon.insertCell(2);

					//Asignar valores
					objRenglon.setAttribute('class', 'movil');
					objRenglon.setAttribute('id', intServicioTipoID);
					objCeldaServicioTipo.setAttribute('class', 'movil b1');
					objCeldaServicioTipo.innerHTML = strServicioTipo;
					objCeldaPrecio.setAttribute('class', 'movil b2');
					objCeldaPrecio.innerHTML = formatMoney(intPrecio, 2, '');
					objCeldaAcciones.setAttribute('class', 'td-center movil b3');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 " onclick='editar_renglon_detalles_equipos_tipos_servicio(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button> " + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 " onclick='eliminar_renglon_detalles_equipos_tipos_servicio(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>";
				}
				//Enfocar caja de texto
				$('#txtServicioTipo_detalles_equipos_tipos_servicio').focus();
			}

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_detalles_equipos_tipos_servicio tr").length - 1;
			$('#numElementos_detalles_equipos_tipos_servicio').html(intFilas);
		}

		//Función para regresar los datos (al formulario) del renglón seleccionado
		function editar_renglon_detalles_equipos_tipos_servicio(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtServicioTipoID_detalles_equipos_tipos_servicio').val(objRenglon.parentNode.parentNode.getAttribute("id"));
			$('#txtServicioTipo_detalles_equipos_tipos_servicio').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			$('#txtPrecio_detalles_equipos_tipos_servicio').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);

			//Enfocar caja de texto
			$('#txtServicioTipo_detalles_equipos_tipos_servicio').focus();
		}

		//Función para quitar renglón de la tabla
		function eliminar_renglon_detalles_equipos_tipos_servicio(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dg_detalles_equipos_tipos_servicio").deleteRow(intRenglon);

			//Asignar el número de filas de la tabla (se quita la primer fila por que corresponde al encabezado de la tabla)
			var intFilas = $("#dg_detalles_equipos_tipos_servicio tr").length - 1;
			$('#numElementos_detalles_equipos_tipos_servicio').html(intFilas);

			//Enfocar caja de texto
			$('#txtServicioTipo_detalles_equipos_tipos_servicio').focus();
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos decimales (no hay necesidad de poner '.')
        	$('#txtPrecio_detalles_equipos_tipos_servicio').numeric();
			/*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
        	 * por ejemplo: 1800 será 1,800.00*/
        	$('.moneda_equipos_tipos_servicio').blur(function(){
				$('.moneda_equipos_tipos_servicio').formatCurrency({ roundToDecimalPlace: 2 });
			});

			//Comprobar la existencia de la descripción en la BD cuando pierda el enfoque la caja de texto
			$('#txtDescripcion_equipos_tipos_servicio').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtEquipoTipoID_equipos_tipos_servicio').val() == '' && $('#txtDescripcion_equipos_tipos_servicio').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_equipos_tipos_servicio($('#txtDescripcion_equipos_tipos_servicio').val(), 'descripcion', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de un tipo de servicio
	        $('#txtServicioTipo_detalles_equipos_tipos_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtServicioTipoID_detalles_equipos_tipos_servicio').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "servicio/servicios_tipos/autocomplete",
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
	             $('#txtServicioTipoID_detalles_equipos_tipos_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del tipo de servicio cuando pierda el enfoque la caja de texto
	        $('#txtServicioTipo_detalles_equipos_tipos_servicio').focusout(function(e){
	            //Si no existe id del tipo de servicio
	            if($('#txtServicioTipoID_detalles_equipos_tipos_servicio').val() == '' ||
	               $('#txtServicioTipo_detalles_equipos_tipos_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtServicioTipoID_detalles_equipos_tipos_servicio').val('');
	               $('#txtServicioTipo_detalles_equipos_tipos_servicio').val('');
	            }

	        });

	        //Validar que exista tipo de servicio cuando se pulse la tecla enter 
			$('#txtServicioTipo_detalles_equipos_tipos_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe tipo de servicio
		            if($('#txtServicioTipoID_detalles_equipos_tipos_servicio').val() == '' || $('#txtServicioTipo_detalles_equipos_tipos_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtServicioTipo_detalles_equipos_tipos_servicio').focus();
			   	    }
		        }
		    });

		    //Validar que exista precio cuando se pulse la tecla enter 
			$('#txtPrecio_detalles_equipos_tipos_servicio').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		         	//Si no existe precio
		            if($('#txtPrecio_detalles_equipos_tipos_servicio').val() == '')
			   	    {
			   	   		//Enfocar caja de texto
					    $('#txtPrecio_detalles_equipos_tipos_servicio').focus();
			   	    }
			   	    else
			   	    {
			   	    	//Hacer un llamado a la función para agregar renglón a la tabla
			   	    	agregar_renglon_detalles_equipos_tipos_servicio();
			   	    }
		        }
		    });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_equipos_tipos_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaEquiposTiposServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_equipos_tipos_servicio();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_equipos_tipos_servicio').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_equipos_tipos_servicio();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_equipos_tipos_servicio').addClass("estatus-NUEVO");
				//Abrir modal
				 objEquiposTiposServicio = $('#EquiposTiposServicioBox').bPopup({
											   appendTo: '#EquiposTiposServicioContent', 
				                               contentContainer: 'EquiposTiposServicioM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_equipos_tipos_servicio').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_equipos_tipos_servicio').focus(); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_equipos_tipos_servicio();
		});
	</script>