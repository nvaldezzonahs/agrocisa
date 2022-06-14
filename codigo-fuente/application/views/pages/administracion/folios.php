	<div id="FoliosAdministracionContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_folios_administracion" action="#" method="post" tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_folios_administracion" name="strBusqueda_folios_administracion"  
								   type="text" value="" tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_folios_administracion"
										onclick="paginacion_folios_administracion();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_folios_administracion" title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_folios_administracion"
									onclick="reporte_folios_administracion('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_folios_administracion"
									onclick="reporte_folios_administracion('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Descripción"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Serie"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Consecutivo"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Estatus"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_folios_administracion">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Descripción</th>
							<th class="movil">Serie</th>
							<th class="movil">Consecutivo</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_folios_administracion" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil">{{descripcion}}</td>
							<td class="movil">{{serie}}</td>
							<td class="movil">{{consecutivo}}</td>
							<td class="movil">{{estatus}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_folios_administracion({{folio_id}},'id','Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_folios_administracion({{folio_id}},'id','Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_folios_administracion({{folio_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_folios_administracion({{folio_id}},'{{estatus}}')"  title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td class="movil" colspan="3">No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_folios_administracion"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_folios_administracion">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Folios-->
		<div id="FoliosAdministracionBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_folios_administracion"  class="ModalBodyTitle">
			<h1>Folios</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmFoliosAdministracion" method="post" action="#" class="form-horizontal" role="form" name="frmFoliosAdministracion" 
					  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					    <!--Descripción-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtFolioID_folios_administracion" name="intFolioID_folios_administracion"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar la descripción anterior y así evitar duplicidad en caso de que exista otro registro con la misma descripción-->
									<input id="txtDescripcionAnterior_folios_administracion" name="strDescripcionAnterior_folios_administracion" 
										   type="hidden" value="">
									</input>
									<label for="txtDescripcion_folios_administracion">Descripción</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_folios_administracion" name="strDescripcion_folios_administracion" 
											type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Serie-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSerie_folios_administracion">Serie</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSerie_folios_administracion" name="strSerie_folios_administracion" 
											type="text" value="" tabindex="1" placeholder="Ingrese serie" maxlength="5">
									</input>
								</div>
							</div>
						</div>
						<!--Consecutivo-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtConsecutivo_folios_administracion">Consecutivo</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtConsecutivo_folios_administracion" name="intConsecutivo_folios_administracion" 
										   type="text" value="" tabindex="1" placeholder="Ingrese consecutivo" maxlength="10">
									</input>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_folios_administracion"  
									onclick="validar_folios_administracion();" title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_folios_administracion"  
									onclick="cambiar_estatus_folios_administracion('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_folios_administracion"  
									onclick="cambiar_estatus_folios_administracion('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar" id="btnCerrar_folios_administracion" type="reset" aria-hidden="true" 
									onclick="cerrar_folios_administracion();" title="Cerrar" tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Folios-->
	</div><!--#FoliosAdministracionContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaFoliosAdministracion = 0;
		var strUltimaBusquedaFoliosAdministracion = "";
		//Variable que se utiliza para asignar objeto del modal
		var objFoliosAdministracion = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_folios_administracion()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('administracion/folios/get_permisos_acceso',
			{
				strPermisosAcceso: $('#txtAcciones_folios_administracion').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosFoliosAdministracion = data.row;
					//Separar la cadena 
					var arrPermisosFoliosAdministracion = strPermisosFoliosAdministracion.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosFoliosAdministracion.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosFoliosAdministracion[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_folios_administracion').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosFoliosAdministracion[i]=='GUARDAR') || (arrPermisosFoliosAdministracion[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_folios_administracion').removeAttr('disabled');
						}
						else if(arrPermisosFoliosAdministracion[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_folios_administracion').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_folios_administracion();
						}
						else if(arrPermisosFoliosAdministracion[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_folios_administracion').removeAttr('disabled');
							$('#btnRestaurar_folios_administracion').removeAttr('disabled');
						}
						else if(arrPermisosFoliosAdministracion[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_folios_administracion').removeAttr('disabled');
						}
						else if(arrPermisosFoliosAdministracion[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_folios_administracion').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_folios_administracion() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_folios_administracion').val() != strUltimaBusquedaFoliosAdministracion)
			{
				intPaginaFoliosAdministracion = 0;
				strUltimaBusquedaFoliosAdministracion = $('#txtBusqueda_folios_administracion').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('administracion/folios/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_folios_administracion').val(),
						intPagina:intPaginaFoliosAdministracion,
						strPermisosAcceso: $('#txtAcciones_folios_administracion').val()
					},
					function(data){
						$('#dg_folios_administracion tbody').empty();
						var tmpFoliosAdministracion = Mustache.render($('#plantilla_folios_administracion').html(),data);
						$('#dg_folios_administracion tbody').html(tmpFoliosAdministracion);
						$('#pagLinks_folios_administracion').html(data.paginacion);
						$('#numElementos_folios_administracion').html(data.total_rows);
						intPaginaFoliosAdministracion = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_folios_administracion(strTipo)
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'administracion/folios/';

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
										'strBusqueda': $('#txtBusqueda_folios_administracion').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);

		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_folios_administracion()
		{
			//Incializar formulario
			$('#frmFoliosAdministracion')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_folios_administracion();
			//Limpiar cajas de texto ocultas
			$('#frmFoliosAdministracion').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_folios_administracion');
			//Habilitar todos los elementos del formulario
			$('#frmFoliosAdministracion').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_folios_administracion").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_folios_administracion").hide();
			$("#btnRestaurar_folios_administracion").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_folios_administracion()
		{
			try {
				//Cerrar modal
				objFoliosAdministracion.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_folios_administracion').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_folios_administracion()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_folios_administracion();
			//Validación del formulario de campos obligatorios
			$('#frmFoliosAdministracion')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {  
										strDescripcion_folios_administracion: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										intConsecutivo_folios_administracion: {
											validators: {
												notEmpty: {message: 'Escriba el consecutivo para este folio'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_folios_administracion = $('#frmFoliosAdministracion').data('bootstrapValidator');
			bootstrapValidator_folios_administracion.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_folios_administracion.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_folios_administracion();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_folios_administracion()
		{
			try
			{
				$('#frmFoliosAdministracion').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para registrar (o actualizar) los datos de un folio
		function guardar_folios_administracion()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('administracion/folios/guardar',
					{ 
						intFolioID: $('#txtFolioID_folios_administracion').val(),
						strDescripcion: $('#txtDescripcion_folios_administracion').val(),
						strDescripcionAnterior: $('#txtDescripcionAnterior_folios_administracion').val(),
						strSerie: $('#txtSerie_folios_administracion').val(),
						intConsecutivo: $('#txtConsecutivo_folios_administracion').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_folios_administracion();
							//Hacer un llamado a la función para cerrar modal
							cerrar_folios_administracion();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_folios_administracion(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_folios_administracion(tipoMensaje, mensaje)
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
		function cambiar_estatus_folios_administracion(id,estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtFolioID_folios_administracion').val();

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
				              'title':    'Folios',
				              'buttons':  ['Aceptar', 'Cancelar'],
				              'onClose':  function(caption) {
				                            if(caption == 'Aceptar')
				                            {
				                            	//Hacer un llamado a la función para modificar el estatus del registro
												set_estatus_folios_administracion(intID, strTipo, 'INACTIVO');
				                            }
				                          }
				              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_folios_administracion(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_folios_administracion(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('administracion/folios/set_estatus',
			      {intFolioID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_folios_administracion();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_folios_administracion();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_folios_administracion(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_folios_administracion(busqueda, tipoBusqueda, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('administracion/folios/get_datos',
			       {strBusqueda:busqueda,
			       	strTipo: tipoBusqueda
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_folios_administracion();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				          	//Recuperar valores
				            $('#txtFolioID_folios_administracion').val(data.row.folio_id);
				            $('#txtDescripcion_folios_administracion').val(data.row.descripcion);
				            $('#txtDescripcionAnterior_folios_administracion').val(data.row.descripcion);
				            $('#txtSerie_folios_administracion').val(data.row.serie);
				            $('#txtConsecutivo_folios_administracion').val(data.row.consecutivo);
				            //Dependiendo del estatus cambiar el color del encabezado 
				            $('#divEncabezadoModal_folios_administracion').addClass("estatus-"+strEstatus);
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_folios_administracion").show();
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
			            		$('#frmFoliosAdministracion').find('input, textarea, select').attr('disabled','disabled');
			            		//Ocultar botón Guardar
				           		$("#btnGuardar_folios_administracion").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_folios_administracion").show();
							}

				            //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objFoliosAdministracion = $('#FoliosAdministracionBox').bPopup({
															appendTo: '#FoliosAdministracionContent', 
							                           		contentContainer: 'FoliosAdministracionM', 
							                            	zIndex: 2, 
							                            	modalClose: false, 
							                            	modal: true, 
							                            	follow: [true,false], 
							                            	followEasing : "linear", 
							                            	easing: "linear", 
							                            	modalColor: ('#F0F0F0')});
						        //Enfocar caja de texto
								$('#txtDescripcion_folios_administracion').focus();
							}
			       	    }
			       },
			       'json');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Folios
			*********************************************************************************************************************/
			//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtConsecutivo_folios_administracion').numeric({decimal: false, negative: false});
			//Validar campo para introducir solamente letras
			$('#txtSerie_folios_administracion').letras();

			//Comprobar la existencia de la descripción en la BD cuando pierda el enfoque la caja de texto
			$('#txtDescripcion_folios_administracion').focusout(function(e){
				//Si no existe id, verificar la existencia de la descripción
				if ($('#txtFolioID_folios_administracion').val() == '' && $('#txtDescripcion_folios_administracion').val() != '')
				{
					//Hacer un llamado a la función para recuperar los datos del registro que coincide con la descripción 
					editar_folios_administracion($('#txtDescripcion_folios_administracion').val(), 'descripcion', 'Nuevo');
				}
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_folios_administracion').on('click','a',function(event){
				event.preventDefault();
				intPaginaFoliosAdministracion = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_folios_administracion();
			});

			//Abrir modal Folios cuando se de clic en el botón
			$('#btnNuevo_folios_administracion').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_folios_administracion();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_folios_administracion').addClass("estatus-NUEVO");
				//Abrir modal
				objFoliosAdministracion = $('#FoliosAdministracionBox').bPopup({
											appendTo: '#FoliosAdministracionContent', 
							               	contentContainer: 'FoliosAdministracionM', 
							                zIndex: 2, 
							                modalClose: false, 
							                modal: true, 
							                follow: [true,false], 
							                followEasing : "linear", 
							                easing: "linear", 
							                modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_folios_administracion').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_folios_administracion').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_folios_administracion();
		});
	</script>