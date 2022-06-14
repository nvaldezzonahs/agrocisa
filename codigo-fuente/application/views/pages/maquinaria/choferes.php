	<div id="ChoferesMaquinariaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_choferes_maquinaria" action="#" method="post" tabindex="-5" 
				  onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_choferes_maquinaria" 
								   name="strBusqueda_choferes_maquinaria"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_choferes_maquinaria"
										onclick="paginacion_choferes_maquinaria();" 
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
							<button class="btn btn-info" id="btnNuevo_choferes_maquinaria" 
									title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_choferes_maquinaria"
									onclick="reporte_choferes_maquinaria('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_choferes_maquinaria"
									onclick="reporte_choferes_maquinaria('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				<table class="table-hover movil" id="dg_choferes_maquinaria">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Nombre</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_choferes_maquinaria" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil">{{empleado}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_choferes_maquinaria({{chofer_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_choferes_maquinaria({{chofer_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_choferes_maquinaria({{chofer_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_choferes_maquinaria({{chofer_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_choferes_maquinaria"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_choferes_maquinaria">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="ChoferesMaquinariaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_choferes_maquinaria"  class="ModalBodyTitle">
			<h1>Choferes</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmChoferesMaquinaria" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmChoferesMaquinaria"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Autocomplete que contiene los empleados activos-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtChoferID_choferes_maquinaria" 
										   name="intChoferID_choferes_maquinaria" type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del empleado seleccionado-->
									<input id="txtEmpleadoID_choferes_maquinaria" 
										   name="intEmpleadoID_choferes_maquinaria"  type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el empleado anterior y así evitar duplicidad en caso de que exista otro registro con el mismo empleado-->
									<input id="txtEmpleadoIDAnterior_choferes_maquinaria" 
											name="strEmpleadoIDAnterior_choferes_maquinaria" type="hidden" value="">
									</input>
									<label for="txtEmpleado_choferes_maquinaria">Empleado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEmpleado_choferes_maquinaria" 
											name="strEmpleado_choferes_maquinaria" type="text" value="" tabindex="1" placeholder="Ingrese empleado" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_choferes_maquinaria"  
									onclick="validar_choferes_maquinaria();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_choferes_maquinaria"  
									onclick="cambiar_estatus_choferes_maquinaria('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_choferes_maquinaria"  
									onclick="cambiar_estatus_choferes_maquinaria('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_choferes_maquinaria"
									type="reset" aria-hidden="true" onclick="cerrar_choferes_maquinaria();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ChoferesMaquinariaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaChoferesMaquinaria = 0;
		var strUltimaBusquedaChoferesMaquinaria = "";
		//Variable que se utiliza para asignar objeto del modal
		var objChoferesMaquinaria = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_choferes_maquinaria()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('maquinaria/choferes/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_choferes_maquinaria').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosChoferesMaquinaria = data.row;
					//Separar la cadena 
					var arrPermisosChoferesMaquinaria = strPermisosChoferesMaquinaria.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosChoferesMaquinaria.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosChoferesMaquinaria[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_choferes_maquinaria').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosChoferesMaquinaria[i]=='GUARDAR') || (arrPermisosChoferesMaquinaria[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_choferes_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosChoferesMaquinaria[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_choferes_maquinaria').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_choferes_maquinaria();
						}
						else if(arrPermisosChoferesMaquinaria[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_choferes_maquinaria').removeAttr('disabled');
							$('#btnRestaurar_choferes_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosChoferesMaquinaria[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_choferes_maquinaria').removeAttr('disabled');
						}
						else if(arrPermisosChoferesMaquinaria[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_choferes_maquinaria').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_choferes_maquinaria() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_choferes_maquinaria').val() != strUltimaBusquedaChoferesMaquinaria)
			{
				intPaginaChoferesMaquinaria = 0;
				strUltimaBusquedaChoferesMaquinaria = $('#txtBusqueda_choferes_maquinaria').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('maquinaria/choferes/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_choferes_maquinaria').val(),
						intPagina:intPaginaChoferesMaquinaria,
						strPermisosAcceso: $('#txtAcciones_choferes_maquinaria').val()
					},
					function(data){
						$('#dg_choferes_maquinaria tbody').empty();
						var tmpChoferesMaquinaria = Mustache.render($('#plantilla_choferes_maquinaria').html(),data);
						$('#dg_choferes_maquinaria tbody').html(tmpChoferesMaquinaria);
						$('#pagLinks_choferes_maquinaria').html(data.paginacion);
						$('#numElementos_choferes_maquinaria').html(data.total_rows);
						intPaginaChoferesMaquinaria = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_choferes_maquinaria(strTipo) 
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'maquinaria/choferes/';

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
										'strBusqueda': $('#txtBusqueda_choferes_maquinaria').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_choferes_maquinaria()
		{
			//Incializar formulario
			$('#frmChoferesMaquinaria')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_choferes_maquinaria();
			//Limpiar cajas de texto ocultas
			$('#frmChoferesMaquinaria').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_choferes_maquinaria');
			//Habilitar todos los elementos del formulario
			$('#frmChoferesMaquinaria').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_choferes_maquinaria").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_choferes_maquinaria").hide();
			$("#btnRestaurar_choferes_maquinaria").hide();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_choferes_maquinaria()
		{
			try {
				//Cerrar modal
				objChoferesMaquinaria.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_choferes_maquinaria').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_choferes_maquinaria()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_choferes_maquinaria();
			//Validación del formulario de campos obligatorios
			$('#frmChoferesMaquinaria')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strEmpleado_choferes_maquinaria: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del empleado
					                                    if($('#txtEmpleadoID_choferes_maquinaria').val() === '')
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
			var bootstrapValidator_choferes_maquinaria = $('#frmChoferesMaquinaria').data('bootstrapValidator');
			bootstrapValidator_choferes_maquinaria.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_choferes_maquinaria.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_choferes_maquinaria();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_choferes_maquinaria()
		{
			try
			{
				$('#frmChoferesMaquinaria').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_choferes_maquinaria()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('maquinaria/choferes/guardar',
					{ 
						intChoferID: $('#txtChoferID_choferes_maquinaria').val(),
						intEmpleadoID: $('#txtEmpleadoID_choferes_maquinaria').val(),
						intEmpleadoIDAnterior: $('#txtEmpleadoIDAnterior_choferes_maquinaria').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_choferes_maquinaria();
							//Hacer un llamado a la función para cerrar modal
							cerrar_choferes_maquinaria();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_choferes_maquinaria(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_choferes_maquinaria(tipoMensaje, mensaje)
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
		function cambiar_estatus_choferes_maquinaria(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtChoferID_choferes_maquinaria').val();

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
						              'title':    'Choferes',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado a la función para modificar el estatus del registro
													  set_estatus_choferes_maquinaria(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_choferes_maquinaria(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_choferes_maquinaria(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('maquinaria/choferes/set_estatus',
			      {intChoferID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_choferes_maquinaria();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_choferes_maquinaria();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_choferes_maquinaria(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}


		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_choferes_maquinaria(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('maquinaria/choferes/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_choferes_maquinaria();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
							
				          	//Recuperar valores
				            $('#txtChoferID_choferes_maquinaria').val(data.row.chofer_id);
				            $('#txtEmpleadoID_choferes_maquinaria').val(data.row.empleado_id);
				            $('#txtEmpleadoIDAnterior_choferes_maquinaria').val(data.row.empleado_id);
				            $('#txtEmpleado_choferes_maquinaria').val(data.row.empleado);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_choferes_maquinaria').addClass("estatus-"+strEstatus);

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_choferes_maquinaria").show();
							}
							else 
							{	
								
								//Deshabilitar todos los elementos del formulario
			            		$('#frmChoferesMaquinaria').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_choferes_maquinaria").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_choferes_maquinaria").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objChoferesMaquinaria = $('#ChoferesMaquinariaBox').bPopup({
															  appendTo: '#ChoferesMaquinariaContent', 
								                              contentContainer: 'ChoferesMaquinariaM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtEmpleado_choferes_maquinaria').focus();
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
			$('#txtEmpleado_choferes_maquinaria').focusout(function(e){
				//Si no existe id, verificar la existencia del empleado
				if ($('#txtChoferID_choferes_maquinaria').val() == '' && $('#txtEmpleadoID_choferes_maquinaria').val() != '')
				{
					
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el empleado 
					editar_choferes_maquinaria($('#txtEmpleadoID_choferes_maquinaria').val(), 'empleado', 'Nuevo');
				}
			});

			//Autocomplete para recuperar los datos de un empleado 
	        $('#txtEmpleado_choferes_maquinaria').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtEmpleadoID_choferes_maquinaria').val('');
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
	             $('#txtEmpleadoID_choferes_maquinaria').val(ui.item.data);
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
	        $('#txtEmpleado_choferes_maquinaria').focusout(function(e){
	            //Si no existe id del empleado
	            if($('#txtEmpleadoID_choferes_maquinaria').val() == '' ||
	               $('#txtEmpleado_choferes_maquinaria').val() == '')
	            { 
	               //Limpiar contenido de la caja de texto
	               $('#txtEmpleadoID_choferes_maquinaria').val('');
	               $('#txtEmpleado_choferes_maquinaria').val('');
	            }

	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_choferes_maquinaria').on('click','a',function(event){
				event.preventDefault();
				intPaginaChoferesMaquinaria = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_choferes_maquinaria();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_choferes_maquinaria').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_choferes_maquinaria();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_choferes_maquinaria').addClass("estatus-NUEVO");
				//Abrir modal
				 objChoferesMaquinaria = $('#ChoferesMaquinariaBox').bPopup({
											   appendTo: '#ChoferesMaquinariaContent', 
				                               contentContainer: 'ChoferesMaquinariaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtEmpleado_choferes_maquinaria').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_choferes_maquinaria').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_choferes_maquinaria();
		});
	</script>