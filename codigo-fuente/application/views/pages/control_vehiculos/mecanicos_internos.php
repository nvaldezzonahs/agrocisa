	<div id="MecanicosInternosControlVehiculosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_mecanicos_internos_control_vehiculos" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_mecanicos_internos_control_vehiculos" 
								   name="strBusqueda_mecanicos_internos_control_vehiculos"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_mecanicos_internos_control_vehiculos"
										onclick="paginacion_mecanicos_internos_control_vehiculos();" 
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
							<button class="btn btn-info" id="btnNuevo_mecanicos_internos_control_vehiculos" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_mecanicos_internos_control_vehiculos"
									onclick="reporte_mecanicos_internos_control_vehiculos();" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_mecanicos_internos_control_vehiculos"
									onclick="descargar_xls_mecanicos_internos_control_vehiculos();" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(2):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_mecanicos_internos_control_vehiculos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Nombre</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_mecanicos_internos_control_vehiculos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil">{{empleado}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_mecanicos_internos_control_vehiculos({{mecanico_interno_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_mecanicos_internos_control_vehiculos({{mecanico_interno_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_mecanicos_internos_control_vehiculos({{mecanico_interno_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_mecanicos_internos_control_vehiculos({{mecanico_interno_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_mecanicos_internos_control_vehiculos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_mecanicos_internos_control_vehiculos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="MecanicosInternosControlVehiculosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_mecanicos_internos_control_vehiculos"  class="ModalBodyTitle">
			<h1>Mecánicos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmMecanicosInternosControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmMecanicosInternosControlVehiculos"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Autocomplete que contiene los empleados activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtMecanicoInternoID_mecanicos_internos_control_vehiculos" 
										   name="intMecanicoInternoID_mecanicos_internos_control_vehiculos" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
									<input id="txtEmpleadoID_mecanicos_internos_control_vehiculos" 
										   name="intEmpleadoID_mecanicos_internos_control_vehiculos"  type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el empleado anterior y así evitar duplicidad en caso de que exista otro registro con el mismo empleado-->
									<input id="txtEmpleadoIDAnterior_mecanicos_internos_control_vehiculos" 
											name="strEmpleadoIDAnterior_mecanicos_internos_control_vehiculos" type="hidden" value="">
									</input>
									<label for="txtEmpleado_mecanicos_internos_control_vehiculos">Empleado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEmpleado_mecanicos_internos_control_vehiculos" 
											name="strEmpleado_mecanicos_internos_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250" />
								</div>
							</div>
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_mecanicos_internos_control_vehiculos"  
									onclick="validar_mecanicos_internos_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_mecanicos_internos_control_vehiculos"  
									onclick="cambiar_estatus_mecanicos_internos_control_vehiculos('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_mecanicos_internos_control_vehiculos"  
									onclick="cambiar_estatus_mecanicos_internos_control_vehiculos('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_mecanicos_internos_control_vehiculos"
									type="reset" aria-hidden="true" onclick="cerrar_mecanicos_internos_control_vehiculos();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#MecanicosInternosControlVehiculosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaMecanicosInternosControlVehiculos = 0;
		var strUltimaBusquedaMecanicosInternosControlVehiculos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objMecanicosInternosControlVehiculos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_mecanicos_internos_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('control_vehiculos/mecanicos_internos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_mecanicos_internos_control_vehiculos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosMecanicosInternosControlVehiculos = data.row;
					//Separar la cadena 
					var arrPermisosMecanicosInternosControlVehiculos = strPermisosMecanicosInternosControlVehiculos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosMecanicosInternosControlVehiculos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosMecanicosInternosControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_mecanicos_internos_control_vehiculos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosMecanicosInternosControlVehiculos[i]=='GUARDAR') || (arrPermisosMecanicosInternosControlVehiculos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_mecanicos_internos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMecanicosInternosControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_mecanicos_internos_control_vehiculos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_mecanicos_internos_control_vehiculos();
						}
						else if(arrPermisosMecanicosInternosControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_mecanicos_internos_control_vehiculos').removeAttr('disabled');
							$('#btnRestaurar_mecanicos_internos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMecanicosInternosControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_mecanicos_internos_control_vehiculos').removeAttr('disabled');
						}
						else if(arrPermisosMecanicosInternosControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_mecanicos_internos_control_vehiculos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_mecanicos_internos_control_vehiculos() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_mecanicos_internos_control_vehiculos').val() != strUltimaBusquedaMecanicosInternosControlVehiculos)
			{
				intPaginaMecanicosInternosControlVehiculos = 0;
				strUltimaBusquedaMecanicosInternosControlVehiculos = $('#txtBusqueda_mecanicos_internos_control_vehiculos').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('control_vehiculos/mecanicos_internos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_mecanicos_internos_control_vehiculos').val(),
						intPagina:intPaginaMecanicosInternosControlVehiculos,
						strPermisosAcceso: $('#txtAcciones_mecanicos_internos_control_vehiculos').val()
					},
					function(data){
						$('#dg_mecanicos_internos_control_vehiculos tbody').empty();
						var tmpMecanicosInternosControlVehiculos = Mustache.render($('#plantilla_mecanicos_internos_control_vehiculos').html(),data);
						$('#dg_mecanicos_internos_control_vehiculos tbody').html(tmpMecanicosInternosControlVehiculos);
						$('#pagLinks_mecanicos_internos_control_vehiculos').html(data.paginacion);
						$('#numElementos_mecanicos_internos_control_vehiculos').html(data.total_rows);
						intPaginaMecanicosInternosControlVehiculos = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_mecanicos_internos_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("control_vehiculos/mecanicos_internos/get_reporte/"+$('#txtBusqueda_mecanicos_internos_control_vehiculos').val());
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_mecanicos_internos_control_vehiculos() 
		{
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("control_vehiculos/mecanicos_internos/get_xls/"+$('#txtBusqueda_mecanicos_internos_control_vehiculos').val());
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_mecanicos_internos_control_vehiculos()
		{
			//Incializar formulario
			$('#frmMecanicosInternosControlVehiculos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_mecanicos_internos_control_vehiculos();
			//Limpiar cajas de texto ocultas
			$('#frmMecanicosInternosControlVehiculos').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_mecanicos_internos_control_vehiculos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_mecanicos_internos_control_vehiculos').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_mecanicos_internos_control_vehiculos').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmMecanicosInternosControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_mecanicos_internos_control_vehiculos").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_mecanicos_internos_control_vehiculos").hide();
			$("#btnRestaurar_mecanicos_internos_control_vehiculos").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_mecanicos_internos_control_vehiculos()
		{
			try {
				//Cerrar modal
				objMecanicosInternosControlVehiculos.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_mecanicos_internos_control_vehiculos').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_mecanicos_internos_control_vehiculos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_mecanicos_internos_control_vehiculos();
			//Validación del formulario de campos obligatorios
			$('#frmMecanicosInternosControlVehiculos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strEmpleado_mecanicos_internos_control_vehiculos: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtEmpleadoID_mecanicos_internos_control_vehiculos').val() === '')
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
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_mecanicos_internos_control_vehiculos = $('#frmMecanicosInternosControlVehiculos').data('bootstrapValidator');
			bootstrapValidator_mecanicos_internos_control_vehiculos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_mecanicos_internos_control_vehiculos.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_mecanicos_internos_control_vehiculos();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_mecanicos_internos_control_vehiculos()
		{
			try
			{
				$('#frmMecanicosInternosControlVehiculos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_mecanicos_internos_control_vehiculos()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('control_vehiculos/mecanicos_internos/guardar',
					{ 
						intMecanicoInternoID: $('#txtMecanicoInternoID_mecanicos_internos_control_vehiculos').val(),
						intEmpleadoID: $('#txtEmpleadoID_mecanicos_internos_control_vehiculos').val(),
						intEmpleadoIDAnterior: $('#txtEmpleadoIDAnterior_mecanicos_internos_control_vehiculos').val()
						
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_mecanicos_internos_control_vehiculos();
							//Hacer un llamado a la función para cerrar modal
							cerrar_mecanicos_internos_control_vehiculos();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_mecanicos_internos_control_vehiculos(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_mecanicos_internos_control_vehiculos(tipoMensaje, mensaje)
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
		function cambiar_estatus_mecanicos_internos_control_vehiculos(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtMecanicoInternoID_mecanicos_internos_control_vehiculos').val();

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
				              'title':    'Mecánicos',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
				                              $.post('control_vehiculos/mecanicos_internos/set_estatus',
				                                     {
				                                     	intMecanicoInternoID: intID,
				                                      	strEstatus: estatus
				                                     },
				                                     function(data) {
				                                        if(data.resultado)
				                                        {
				                                          	//Hacer llamado a la función  para cargar  los registros en el grid
				                                          	paginacion_mecanicos_internos_control_vehiculos();

				                                          	//Si el id del registro se obtuvo del modal
															if(id == '')
															{
																//Hacer un llamado a la función para cerrar modal
																cerrar_mecanicos_internos_control_vehiculos();     
															}
				                                        }
				                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				                                        mensaje_mecanicos_internos_control_vehiculos(data.tipo_mensaje, data.mensaje);
				                                     },
				                                    'json');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('control_vehiculos/mecanicos_internos/set_estatus',
				     {
				     	intMecanicoInternoID: intID,
				      	strEstatus: estatus
				     },
				     function(data) {
				     	 if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_mecanicos_internos_control_vehiculos();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_mecanicos_internos_control_vehiculos();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_mecanicos_internos_control_vehiculos(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_mecanicos_internos_control_vehiculos(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('control_vehiculos/mecanicos_internos/get_datos',
			       {
			       		strBusqueda:busqueda,
			       		strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_mecanicos_internos_control_vehiculos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtMecanicoInternoID_mecanicos_internos_control_vehiculos').val(data.row.mecanico_interno_id);
				            $('#txtEmpleadoID_mecanicos_internos_control_vehiculos').val(data.row.empleado_id);
				            $('#txtEmpleadoIDAnterior_mecanicos_internos_control_vehiculos').val(data.row.empleado_id);
				            $('#txtEmpleado_mecanicos_internos_control_vehiculos').val(data.row.empleado);
				            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
				            $('#divEncabezadoModal_mecanicos_internos_control_vehiculos').addClass("estatus-"+strEstatus);
				            
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_mecanicos_internos_control_vehiculos").show();
							}
							else 
							{	
								//Si el tipo de acción corresponde a Ver
								if(tipoAccion == 'Ver')
								{
									//Deshabilitar todos los elementos del formulario
				            		$('#frmMecanicosInternosControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
				            		//Ocultar botón Guardar
					           		$("#btnGuardar_mecanicos_internos_control_vehiculos").hide(); 
								}
								
								//Mostrar botón Restaurar
								$("#btnRestaurar_mecanicos_internos_control_vehiculos").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objMecanicosInternosControlVehiculos = $('#MecanicosInternosControlVehiculosBox').bPopup({
															  appendTo: '#MecanicosInternosControlVehiculosContent', 
								                              contentContainer: 'MecanicosInternosControlVehiculosM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtEmpleado_mecanicos_internos_control_vehiculos').focus();
					        }
			       	    }
			       },
			       'json');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Comprobar la existencia del empleado en la BD cuando pierda el enfoque la caja de texto
			$('#txtEmpleado_mecanicos_internos_control_vehiculos').focusout(function(e){
				//Si no existe id, verificar la existencia del empleado
				if ($('#txtMecanicoInternoID_mecanicos_internos_control_vehiculos').val() == '' && $('#txtEmpleadoID_mecanicos_internos_control_vehiculos').val() != '')
				{
					
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el empleado 
					editar_mecanicos_internos_control_vehiculos($('#txtEmpleadoID_mecanicos_internos_control_vehiculos').val(), 'empleado', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleado_mecanicos_internos_control_vehiculos').autocomplete({
	            source: function( request, response ) {
            	   //Limpiar caja de texto que hace referencia al id del registro 
                   $('#txtEmpleadoID_mecanicos_internos_control_vehiculos').val('');
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
	             $('#txtEmpleadoID_mecanicos_internos_control_vehiculos').val(ui.item.data);
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
	        $('#txtEmpleado_mecanicos_internos_control_vehiculos').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoID_mecanicos_internos_control_vehiculos').val() == '' ||
	               $('#txtEmpleado_mecanicos_internos_control_vehiculos').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEmpleadoID_mecanicos_internos_control_vehiculos').val('');
	               $('#txtEmpleado_mecanicos_internos_control_vehiculos').val('');
	            }

	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_mecanicos_internos_control_vehiculos').on('click','a',function(event){
				event.preventDefault();
				intPaginaMecanicosInternosControlVehiculos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_mecanicos_internos_control_vehiculos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_mecanicos_internos_control_vehiculos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_mecanicos_internos_control_vehiculos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_mecanicos_internos_control_vehiculos').addClass("estatus-NUEVO");
				//Abrir modal
				 objMecanicosInternosControlVehiculos = $('#MecanicosInternosControlVehiculosBox').bPopup({
											   appendTo: '#MecanicosInternosControlVehiculosContent', 
				                               contentContainer: 'MecanicosInternosControlVehiculosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtEmpleado_mecanicos_internos_control_vehiculos').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_mecanicos_internos_control_vehiculos').focus(); 
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_mecanicos_internos_control_vehiculos();
		});
	</script>