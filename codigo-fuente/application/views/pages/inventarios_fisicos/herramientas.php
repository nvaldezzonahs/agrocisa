	<div id="HerramientasInventariosFisicosContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_herramientas_inventarios_fisicos" action="#" method="post" 		
				  tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_herramientas_inventarios_fisicos" 
								   name="strBusqueda_herramientas_inventarios_fisicos"  type="text" 
								   value="" tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_herramientas_inventarios_fisicos"
										onclick="paginacion_herramientas_inventarios_fisicos();" 
										title="Buscar coincidencias" tabindex="1"> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_herramientas_inventarios_fisicos" 
									title="Nuevo registro" tabindex="1"> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_herramientas_inventarios_fisicos"
									onclick="reporte_herramientas_inventarios_fisicos();" 
									title="Imprimir reporte general en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_herramientas_inventarios_fisicos"
									onclick="descargar_xls_herramientas_inventarios_fisicos();" title="Descargar reporte general en XLS" tabindex="1">
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
				td.movil:nth-of-type(1):before {content: "Código"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_herramientas_inventarios_fisicos">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Código</th>
							<th class="movil">Descripción</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_herramientas_inventarios_fisicos" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">    
							<td class="movil">{{codigo}}</td>
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_herramientas_inventarios_fisicos({{herramienta_id}},'id','Editar')"  
										title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_herramientas_inventarios_fisicos({{herramienta_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_herramientas_inventarios_fisicos({{herramienta_id}},'{{estatus}}')" 
										title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_herramientas_inventarios_fisicos({{herramienta_id}},'{{estatus}}')"  
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_herramientas_inventarios_fisicos"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_herramientas_inventarios_fisicos">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="HerramientasInventariosFisicosBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_herramientas_inventarios_fisicos"  class="ModalBodyTitle">
			<h1>Herramientas</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmHerramientasInventariosFisicos" method="post" action="#" class="form-horizontal" 
					  role="form" name="frmHerramientasInventariosFisicos"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
					    <!--Código-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtHerramientaID_herramientas_inventarios_fisicos" 
										   name="intHerramientaID_herramientas_inventarios_fisicos"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el código anterior y así evitar duplicidad en caso de que exista otro registro con el mismo código-->
									<input id="txtCodigoAnterior_herramientas_inventarios_fisicos" 
										   name="strCodigoAnterior_herramientas_inventarios_fisicos" 
										   type="hidden" value="">
									</input>
									<label for="txtCodigo_herramientas_inventarios_fisicos">Código</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtCodigo_herramientas_inventarios_fisicos" 
											name="strCodigo_herramientas_inventarios_fisicos" type="text" value="" tabindex="1" placeholder="Ingrese código" maxlength="5">
									</input>
								</div>
							</div>
						</div>
						<!--Descripción-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtDescripcion_herramientas_inventarios_fisicos">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_herramientas_inventarios_fisicos" 
											name="strDescripcion_herramientas_inventarios_fisicos" type="text" 
											value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_herramientas_inventarios_fisicos"  
									onclick="validar_herramientas_inventarios_fisicos();"  
									title="Guardar" tabindex="2">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_herramientas_inventarios_fisicos"  
									onclick="cambiar_estatus_herramientas_inventarios_fisicos('','ACTIVO');"  title="Desactivar" tabindex="3">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_herramientas_inventarios_fisicos"  
									onclick="cambiar_estatus_herramientas_inventarios_fisicos('','INACTIVO');"  title="Restaurar" tabindex="4">
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_herramientas_inventarios_fisicos"
									type="reset" aria-hidden="true" onclick="cerrar_herramientas_inventarios_fisicos();" 
									title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#HerramientasInventariosFisicosContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaHerramientasInventariosFisicos = 0;
		var strUltimaBusquedaHerramientasInventariosFisicos = "";
		//Variable que se utiliza para asignar objeto del modal
		var objHerramientasInventariosFisicos = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_herramientas_inventarios_fisicos()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('inventarios_fisicos/herramientas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_herramientas_inventarios_fisicos').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosHerramientasInventariosFisicos = data.row;
					//Separar la cadena 
					var arrPermisosHerramientasInventariosFisicos = strPermisosHerramientasInventariosFisicos.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosHerramientasInventariosFisicos.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosHerramientasInventariosFisicos[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_herramientas_inventarios_fisicos').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosHerramientasInventariosFisicos[i]=='GUARDAR') || (arrPermisosHerramientasInventariosFisicos[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_herramientas_inventarios_fisicos').removeAttr('disabled');
						}
						else if(arrPermisosHerramientasInventariosFisicos[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_herramientas_inventarios_fisicos').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_herramientas_inventarios_fisicos();
						}
						else if(arrPermisosHerramientasInventariosFisicos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_herramientas_inventarios_fisicos').removeAttr('disabled');
							$('#btnRestaurar_herramientas_inventarios_fisicos').removeAttr('disabled');
						}
						else if(arrPermisosHerramientasInventariosFisicos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_herramientas_inventarios_fisicos').removeAttr('disabled');
						}
						else if(arrPermisosHerramientasInventariosFisicos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_herramientas_inventarios_fisicos').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_herramientas_inventarios_fisicos() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_herramientas_inventarios_fisicos').val() != strUltimaBusquedaHerramientasInventariosFisicos)
			{
				intPaginaHerramientasInventariosFisicos = 0;
				strUltimaBusquedaHerramientasInventariosFisicos = $('#txtBusqueda_herramientas_inventarios_fisicos').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('inventarios_fisicos/herramientas/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_herramientas_inventarios_fisicos').val(),
						intPagina:intPaginaHerramientasInventariosFisicos,
						strPermisosAcceso: $('#txtAcciones_herramientas_inventarios_fisicos').val()
					},
					function(data){
						$('#dg_herramientas_inventarios_fisicos tbody').empty();
						var tmpHerramientasInventariosFisicos = Mustache.render($('#plantilla_herramientas_inventarios_fisicos').html(),data);
						$('#dg_herramientas_inventarios_fisicos tbody').html(tmpHerramientasInventariosFisicos);
						$('#pagLinks_herramientas_inventarios_fisicos').html(data.paginacion);
						$('#numElementos_herramientas_inventarios_fisicos').html(data.total_rows);
						intPaginaHerramientasInventariosFisicos = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_herramientas_inventarios_fisicos() 
		{
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("inventarios_fisicos/herramientas/get_reporte/"+$('#txtBusqueda_herramientas_inventarios_fisicos').val());
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_herramientas_inventarios_fisicos() 
		{
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("inventarios_fisicos/herramientas/get_xls/"+$('#txtBusqueda_herramientas_inventarios_fisicos').val());
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_herramientas_inventarios_fisicos()
		{
			//Incializar formulario
			$('#frmHerramientasInventariosFisicos')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_herramientas_inventarios_fisicos();
			//Limpiar cajas de texto ocultas
			$('#frmHerramientasInventariosFisicos').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_herramientas_inventarios_fisicos').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_herramientas_inventarios_fisicos').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_herramientas_inventarios_fisicos').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmHerramientasInventariosFisicos').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_herramientas_inventarios_fisicos").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_herramientas_inventarios_fisicos").hide();
			$("#btnRestaurar_herramientas_inventarios_fisicos").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_herramientas_inventarios_fisicos()
		{
			try {
				//Cerrar modal
				objHerramientasInventariosFisicos.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_herramientas_inventarios_fisicos').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_herramientas_inventarios_fisicos()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_herramientas_inventarios_fisicos();
			//Validación del formulario de campos obligatorios
			$('#frmHerramientasInventariosFisicos')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strCodigo_herramientas_inventarios_fisicos: {
											validators: {
												notEmpty: {message: 'Escriba el código para esta herramienta'}
											}
										},
										strDescripcion_herramientas_inventarios_fisicos: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_herramientas_inventarios_fisicos = $('#frmHerramientasInventariosFisicos').data('bootstrapValidator');
			bootstrapValidator_herramientas_inventarios_fisicos.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_herramientas_inventarios_fisicos.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_herramientas_inventarios_fisicos();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_herramientas_inventarios_fisicos()
		{
			try
			{
				$('#frmHerramientasInventariosFisicos').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_herramientas_inventarios_fisicos()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('inventarios_fisicos/herramientas/guardar',
					{ 
						intHerramientaID: $('#txtHerramientaID_herramientas_inventarios_fisicos').val(),
						strCodigo: $('#txtCodigo_herramientas_inventarios_fisicos').val(),
						strCodigoAnterior: $('#txtCodigoAnterior_herramientas_inventarios_fisicos').val(),
						strDescripcion: $('#txtDescripcion_herramientas_inventarios_fisicos').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_herramientas_inventarios_fisicos();
							//Hacer un llamado a la función para cerrar modal
							cerrar_herramientas_inventarios_fisicos();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_herramientas_inventarios_fisicos(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_herramientas_inventarios_fisicos(tipoMensaje, mensaje)
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
		function cambiar_estatus_herramientas_inventarios_fisicos(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtHerramientaID_herramientas_inventarios_fisicos').val();

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
						              'title':    'Herramientas',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
						                              $.post('inventarios_fisicos/herramientas/set_estatus',
						                                     {intHerramientaID: intID,
						                                      strEstatus: estatus
						                                     },
						                                     function(data) {
						                                        if(data.resultado)
						                                        {
						                                          	//Hacer llamado a la función  para cargar  los registros en el grid
						                                         	paginacion_herramientas_inventarios_fisicos();
						                                          	
						                                          	//Si el id del registro se obtuvo del modal
																	if(id == '')
																	{
																		//Hacer un llamado a la función para cerrar modal
																		cerrar_herramientas_inventarios_fisicos();     
																	}
						                                        }
						                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						                                        mensaje_herramientas_inventarios_fisicos(data.tipo_mensaje, data.mensaje);
						                                     },
						                                    'json');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('inventarios_fisicos/herramientas/set_estatus',
				     {intHerramientaID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_herramientas_inventarios_fisicos();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_herramientas_inventarios_fisicos();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_herramientas_inventarios_fisicos(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_herramientas_inventarios_fisicos(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('inventarios_fisicos/herramientas/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_herramientas_inventarios_fisicos();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
				          	//Recuperar valores
				            $('#txtHerramientaID_herramientas_inventarios_fisicos').val(data.row.herramienta_id);
				            $('#txtCodigo_herramientas_inventarios_fisicos').val(data.row.codigo);
				            $('#txtCodigoAnterior_herramientas_inventarios_fisicos').val(data.row.codigo);
				            $('#txtDescripcion_herramientas_inventarios_fisicos').val(data.row.descripcion);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_herramientas_inventarios_fisicos').addClass("estatus-"+strEstatus);

				           	//Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_herramientas_inventarios_fisicos").show();
							}
							else 
							{	
								//Si el tipo de acción corresponde a Ver
								if(tipoAccion == 'Ver')
								{
									//Deshabilitar todos los elementos del formulario
				            		$('#frmHerramientasInventariosFisicos').find('input, textarea, select').attr('disabled','disabled');
				            		//Ocultar botón Guardar
					           		$("#btnGuardar_herramientas_inventarios_fisicos").hide(); 
								}
								
								//Mostrar botón Restaurar
								$("#btnRestaurar_herramientas_inventarios_fisicos").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objHerramientasInventariosFisicos = $('#HerramientasInventariosFisicosBox').bPopup({
															  appendTo: '#HerramientasInventariosFisicosContent', 
								                              contentContainer: 'HerramientasInventariosFisicosM', 
								                              zIndex: 2, 
								                              modalClose: false, 
								                              modal: true, 
								                              follow: [true,false], 
								                              followEasing : "linear", 
								                              easing: "linear", 
								                              modalColor: ('#F0F0F0')});

					            //Enfocar caja de texto
								$('#txtCodigo_herramientas_inventarios_fisicos').focus();
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
			//Comprobar la existencia del código en la BD cuando pierda el enfoque la caja de texto
			$('#txtCodigo_herramientas_inventarios_fisicos').focusout(function(e){
				//Si no existe id, verificar la existencia del código
				if ($('#txtHerramientaID_herramientas_inventarios_fisicos').val() == '' && $('#txtCodigo_herramientas_inventarios_fisicos').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con el código 
					editar_herramientas_inventarios_fisicos($('#txtCodigo_herramientas_inventarios_fisicos').val(), 'codigo', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_herramientas_inventarios_fisicos').on('click','a',function(event){
				event.preventDefault();
				intPaginaHerramientasInventariosFisicos = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_herramientas_inventarios_fisicos();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_herramientas_inventarios_fisicos').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_herramientas_inventarios_fisicos();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_herramientas_inventarios_fisicos').addClass("estatus-NUEVO");
				//Abrir modal
				 objHerramientasInventariosFisicos = $('#HerramientasInventariosFisicosBox').bPopup({
											   appendTo: '#HerramientasInventariosFisicosContent', 
				                               contentContainer: 'HerramientasInventariosFisicosM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtCodigo_herramientas_inventarios_fisicos').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_herramientas_inventarios_fisicos').focus();

			//Deshabilitar los siguientes botones (funciones de permisos de acceso)
			$('#btnNuevo_herramientas_inventarios_fisicos').attr('disabled','-1');  
			$('#btnImprimir_herramientas_inventarios_fisicos').attr('disabled','-1');
			$('#btnDescargarXLS_herramientas_inventarios_fisicos').attr('disabled','-1');
			$('#btnBuscar_herramientas_inventarios_fisicos').attr('disabled','-1');
			$('#btnGuardar_herramientas_inventarios_fisicos').attr('disabled','-1');
			$('#btnDesactivar_herramientas_inventarios_fisicos').attr('disabled','-1');
			$('#btnRestaurar_herramientas_inventarios_fisicos').attr('disabled','-1');   
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_herramientas_inventarios_fisicos();
		});
	</script>