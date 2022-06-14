	<div id="MecanicosServicioContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_mecanicos_servicio" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_mecanicos_servicio" 
								   name="strBusqueda_mecanicos_servicio"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_mecanicos_servicio"
										onclick="paginacion_mecanicos_servicio();" 
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
							<button class="btn btn-info" id="btnNuevo_mecanicos_servicio" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_mecanicos_servicio"
									onclick="reporte_mecanicos_servicio('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_mecanicos_servicio"
									onclick="reporte_mecanicos_servicio('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas
				*/
				td.movil:nth-of-type(1):before {content: "Nombre"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Tipo"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_mecanicos_servicio">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Nombre</th>
							<th class="movil">Tipo</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_mecanicos_servicio" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{empleado}}</td>
							<td class="movil">{{mecanico_tipo}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_mecanicos_servicio({{mecanico_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_mecanicos_servicio({{mecanico_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_mecanicos_servicio({{mecanico_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_mecanicos_servicio({{mecanico_id}},'{{estatus}}')"  
										title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_mecanicos_servicio"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_mecanicos_servicio">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="MecanicosServicioBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_mecanicos_servicio"  class="ModalBodyTitle">
			<h1>Mecánicos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMecanicosServicio" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmMecanicosServicio"  onsubmit="return(false)" 
					  autocomplete="off">
				    <div class="row">
						<!--Autocomplete que contiene los empleados activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMecanicoID_mecanicos_servicio" 
										   name="intMecanicoID_mecanicos_servicio" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
									<input id="txtEmpleadoID_mecanicos_servicio" 
										   name="intEmpleadoID_mecanicos_servicio"  type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el empleado anterior y así evitar duplicidad en caso de que exista otro registro con el mismo empleado-->
									<input id="txtEmpleadoIDAnterior_mecanicos_servicio" 
											name="strEmpleadoIDAnterior_mecanicos_servicio" type="hidden" value="">
									</input>
									<label for="txtEmpleado_mecanicos_servicio">Empleado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEmpleado_mecanicos_servicio" 
											name="strEmpleado_mecanicos_servicio" type="text" value="" 
											tabindex="1" placeholder="Ingrese empleado" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
				    <div class="row">
				    	<!--Autocomplete que contiene los tipos de mecánicos activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del tipo de mecánico seleccionado-->
									<input id="txtMecanicoTipoID_mecanicos_servicio" 
										   name="intMecanicoTipoID_mecanicos_servicio" type="hidden" value="">
									</input>
									<label for="txtMecanicoTipo_mecanicos_servicio">Tipo de mecánico</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMecanicoTipo_mecanicos_servicio" 
											name="strMecanicoTipo_mecanicos_servicio" type="text" value="" tabindex="1" placeholder="Ingrese tipo de mecánico" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_mecanicos_servicio"  
									onclick="validar_mecanicos_servicio();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_mecanicos_servicio"  
									onclick="cambiar_estatus_mecanicos_servicio('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_mecanicos_servicio"  
									onclick="cambiar_estatus_mecanicos_servicio('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_mecanicos_servicio"
									type="reset" aria-hidden="true" onclick="cerrar_mecanicos_servicio();" title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MecanicosServicioContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMecanicosServicio = 0;
		var strUltimaBusquedaMecanicosServicio = "";
		//Variable que se utiliza para asignar objeto del modal
		var objMecanicosServicio = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_mecanicos_servicio()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('servicio/mecanicos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_mecanicos_servicio').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMecanicosServicio = data.row;
					//Separar la cadena 
					var arrPermisosMecanicosServicio = strPermisosMecanicosServicio.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMecanicosServicio.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMecanicosServicio[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_mecanicos_servicio').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMecanicosServicio[i]=='GUARDAR') || (arrPermisosMecanicosServicio[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_mecanicos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosMecanicosServicio[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_mecanicos_servicio').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_mecanicos_servicio();
						}
						else if(arrPermisosMecanicosServicio[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_mecanicos_servicio').removeAttr('disabled');
							$('#btnRestaurar_mecanicos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosMecanicosServicio[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_mecanicos_servicio').removeAttr('disabled');
						}
						else if(arrPermisosMecanicosServicio[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_mecanicos_servicio').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_mecanicos_servicio() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_mecanicos_servicio').val() != strUltimaBusquedaMecanicosServicio)
			{
				intPaginaMecanicosServicio = 0;
				strUltimaBusquedaMecanicosServicio = $('#txtBusqueda_mecanicos_servicio').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('servicio/mecanicos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_mecanicos_servicio').val(),
						intPagina:intPaginaMecanicosServicio,
						strPermisosAcceso: $('#txtAcciones_mecanicos_servicio').val()
					},
					function(data){
						$('#dg_mecanicos_servicio tbody').empty();
						var tmpMecanicosServicio = Mustache.render($('#plantilla_mecanicos_servicio').html(),data);
						$('#dg_mecanicos_servicio tbody').html(tmpMecanicosServicio);
						$('#pagLinks_mecanicos_servicio').html(data.paginacion);
						$('#numElementos_mecanicos_servicio').html(data.total_rows);
						intPaginaMecanicosServicio = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_mecanicos_servicio(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'servicio/mecanicos/';

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
										'strBusqueda': $('#txtBusqueda_mecanicos_servicio').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_mecanicos_servicio()
		{
			//Incializar formulario
			$('#frmMecanicosServicio')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_mecanicos_servicio();
			//Limpiar cajas de texto ocultas
			$('#frmMecanicosServicio').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_mecanicos_servicio');
			//Habilitar todos los elementos del formulario
			$('#frmMecanicosServicio').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_mecanicos_servicio").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_mecanicos_servicio").hide();
			$("#btnRestaurar_mecanicos_servicio").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_mecanicos_servicio()
		{
			try {
				//Cerrar modal
				objMecanicosServicio.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_mecanicos_servicio').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_mecanicos_servicio()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_mecanicos_servicio();
			//Validación del formulario de campos obligatorios
			$('#frmMecanicosServicio')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strEmpleado_mecanicos_servicio: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtEmpleadoID_mecanicos_servicio').val() === '')
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
										strMecanicoTipo_mecanicos_servicio: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del tipo de mecánico
					                                    if($('#txtMecanicoTipoID_mecanicos_servicio').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un tipo de mecánico existente'
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
			var bootstrapValidator_mecanicos_servicio = $('#frmMecanicosServicio').data('bootstrapValidator');
			bootstrapValidator_mecanicos_servicio.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_mecanicos_servicio.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_mecanicos_servicio();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_mecanicos_servicio()
		{
			try
			{
				$('#frmMecanicosServicio').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_mecanicos_servicio()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('servicio/mecanicos/guardar',
					{ 
						intMecanicoID: $('#txtMecanicoID_mecanicos_servicio').val(),
						intEmpleadoID: $('#txtEmpleadoID_mecanicos_servicio').val(),
						intEmpleadoIDAnterior: $('#txtEmpleadoIDAnterior_mecanicos_servicio').val(),
						intMecanicoTipoID: $('#txtMecanicoTipoID_mecanicos_servicio').val()
						
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_mecanicos_servicio();
							//Hacer un llamado a la función para cerrar modal
							cerrar_mecanicos_servicio();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_mecanicos_servicio(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_mecanicos_servicio(tipoMensaje, mensaje)
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
		function cambiar_estatus_mecanicos_servicio(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMecanicoID_mecanicos_servicio').val();

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
						              'title':    'Mecánicos',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {

						                            	//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_mecanicos_servicio(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_mecanicos_servicio(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_mecanicos_servicio(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('servicio/mecanicos/set_estatus',
			      {intMecanicoID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_mecanicos_servicio();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_mecanicos_servicio();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_mecanicos_servicio(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_mecanicos_servicio(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('servicio/mecanicos/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_mecanicos_servicio();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtMecanicoID_mecanicos_servicio').val(data.row.mecanico_id);
				            $('#txtEmpleadoID_mecanicos_servicio').val(data.row.empleado_id);
				            $('#txtEmpleadoIDAnterior_mecanicos_servicio').val(data.row.empleado_id);
				            $('#txtEmpleado_mecanicos_servicio').val(data.row.empleado);
				            $('#txtMecanicoTipoID_mecanicos_servicio').val(data.row.mecanico_tipo_id);
				            $('#txtMecanicoTipo_mecanicos_servicio').val(data.row.mecanico_tipo);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_mecanicos_servicio').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_mecanicos_servicio").show();
							}
							else 
							{	
							
								//Deshabilitar todos los elementos del formulario
			            		$('#frmMecanicosServicio').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_mecanicos_servicio").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_mecanicos_servicio").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objMecanicosServicio = $('#MecanicosServicioBox').bPopup({
															  appendTo: '#MecanicosServicioContent', 
								                              contentContainer: 'MecanicosServicioM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtEmpleado_mecanicos_servicio').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_mecanicos_servicio()
		{
			//Si no existe id, verificar la existencia del empleado
			if ($('#txtMecanicoID_mecanicos_servicio').val() == '' && $('#txtEmpleadoID_mecanicos_servicio').val() != '')
			{
				
				//Hacer un llamado a la función para recuperar los datos del registro que coincide con el empleado 
				editar_mecanicos_servicio($('#txtEmpleadoID_mecanicos_servicio').val(), 'empleado', 'Nuevo');
			}
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleado_mecanicos_servicio').autocomplete({
	            source: function( request, response ) {
            	   //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtEmpleadoID_mecanicos_servicio').val('');
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
	             $('#txtEmpleadoID_mecanicos_servicio').val(ui.item.data);
	             //Hacer un llamado a la función para verificar la existencia del registro
		         verificar_existencia_mecanicos_servicio();
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
	        $('#txtEmpleado_mecanicos_servicio').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoID_mecanicos_servicio').val() == '' ||
	               $('#txtEmpleado_mecanicos_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEmpleadoID_mecanicos_servicio').val('');
	               $('#txtEmpleado_mecanicos_servicio').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un tipo de mecánico 
	        $('#txtMecanicoTipo_mecanicos_servicio').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtMecanicoTipoID_mecanicos_servicio').val('');
		           $.ajax({
		             //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
		             url: "servicio/mecanicos_tipos/autocomplete",
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
	             $('#txtMecanicoTipoID_mecanicos_servicio').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del tipo de mecánico cuando pierda el enfoque la caja de texto
	        $('#txtMecanicoTipo_mecanicos_servicio').focusout(function(e){
	            //Si no existe id del tipo de mecánico
	            if($('#txtMecanicoTipoID_mecanicos_servicio').val() == '' ||
	               $('#txtMecanicoTipo_mecanicos_servicio').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMecanicoTipoID_mecanicos_servicio').val('');
	               $('#txtMecanicoTipo_mecanicos_servicio').val('');
	            }

	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_mecanicos_servicio').on('click','a',function(event){
				event.preventDefault();
				intPaginaMecanicosServicio = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_mecanicos_servicio();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_mecanicos_servicio').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_mecanicos_servicio();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_mecanicos_servicio').addClass("estatus-NUEVO");
				//Abrir modal
				 objMecanicosServicio = $('#MecanicosServicioBox').bPopup({
											   appendTo: '#MecanicosServicioContent', 
				                               contentContainer: 'MecanicosServicioM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtEmpleado_mecanicos_servicio').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_mecanicos_servicio').focus(); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_mecanicos_servicio();
		});
	</script>