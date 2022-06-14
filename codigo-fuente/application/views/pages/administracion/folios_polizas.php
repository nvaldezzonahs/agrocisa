	<div id="FoliosPolizasAdministracionContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_folios_polizas_administracion" action="#" method="post" tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_folios_polizas_administracion" name="strBusqueda_folios_polizas_administracion"  
								   type="text" value="" tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_folios_polizas_administracion"
										onclick="paginacion_folios_polizas_administracion();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_folios_polizas_administracion" title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_folios_polizas_administracion"
									onclick="reporte_folios_polizas_administracion('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_folios_polizas_administracion"
									onclick="reporte_folios_polizas_administracion('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Consecutivo"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Tipo"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_folios_polizas_administracion">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Consecutivo</th>
							<th class="movil">Tipo</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_folios_polizas_administracion" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil">{{folio}}</td>
							<td class="movil">{{consecutivo}}</td>
							<td class="movil">{{tipo}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_folios_polizas_administracion({{folio_id}}, '{{tipo}}', 'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Eliminar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEliminar}}"  
										onclick="eliminar_folios_polizas_administracion({{folio_id}}, '{{tipo}}')"  title="Eliminar">
									<span class="glyphicon glyphicon-trash"></span>
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_folios_polizas_administracion"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_folios_polizas_administracion">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="FoliosPolizasAdministracionBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_folios_polizas_administracion"  class="ModalBodyTitle">
			<h1>Folios por Póliza</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmFoliosPolizasAdministracion" method="post" action="#" class="form-horizontal" role="form" name="frmFoliosPolizasAdministracion" 
					  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					   <!--Autocomplete que contiene los folios activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del folio seleccionado-->
									<input id="txtFolioID_folios_polizas_administracion" name="intFolioID_folios_polizas_administracion"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del folio anterior y así evitar duplicidad en caso de que exista otro registro con el mismo folio-->
									<input id="txtFolioIDAnterior_folios_polizas_administracion" name="intFolioIDAnterior_folios_polizas_administracion"  
										   type="hidden" value="">
									</input>
									<label for="txtFolio_folios_polizas_administracion">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_folios_polizas_administracion" name="strFolio_folios_polizas_administracion" 
											type="text" value="" tabindex="1" placeholder="Ingrese folio" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Serie-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSerie_folios_polizas_administracion">Serie</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSerie_folios_polizas_administracion" name="strSerie_folios_polizas_administracion" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Consecutivo-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtConsecutivo_folios_polizas_administracion">Consecutivo</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtConsecutivo_folios_polizas_administracion" name="intConsecutivo_folios_polizas_administracion" 
										   type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Tipo-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el tipo anterior y así evitar duplicidad en caso de que exista otro registro con el mismo folio-->
									<input id="txtTipoAnterior_folios_polizas_administracion" name="strTipoAnterior_folios_polizas_administracion"  
										   type="hidden" value="">
									</input>
									<label for="cmbTipo_folios_polizas_administracion">Tipo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTipo_folios_polizas_administracion" 
									 		name="strTipo_folios_polizas_administracion" tabindex="1">
									 	<option value="">Seleccione una opción</option>
                          				<option value="DIARIO">DIARIO</option>
                          				<option value="INGRESO">INGRESO</option>
                          				<option value="EGRESO">EGRESO</option>
                     				</select>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_folios_polizas_administracion"  
									onclick="validar_folios_polizas_administracion();" title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Eliminar registro-->
							<button class="btn btn-default" id="btnEliminar_folios_polizas_administracion"  
									onclick="eliminar_folios_polizas_administracion('', '');"  title="Eliminar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-trash"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar" id="btnCerrar_folios_polizas_administracion" type="reset" aria-hidden="true" 
									onclick="cerrar_folios_polizas_administracion();" title="Cerrar" tabindex="4">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#FoliosPolizasAdministracionContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaFoliosPolizasAdministracion = 0;
		var strUltimaBusquedaFoliosPolizasAdministracion = "";
		//Variable que se utiliza para asignar objeto del modal
		var objFoliosPolizasAdministracion = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_folios_polizas_administracion()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('administracion/folios_polizas/get_permisos_acceso',
			{
				strPermisosAcceso: $('#txtAcciones_folios_polizas_administracion').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosFoliosPolizasAdministracion = data.row;
					//Separar la cadena 
					var arrPermisosFoliosPolizasAdministracion = strPermisosFoliosPolizasAdministracion.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosFoliosPolizasAdministracion.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosFoliosPolizasAdministracion[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_folios_polizas_administracion').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosFoliosPolizasAdministracion[i]=='GUARDAR') || (arrPermisosFoliosPolizasAdministracion[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_folios_polizas_administracion').removeAttr('disabled');
						}
						else if(arrPermisosFoliosPolizasAdministracion[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_folios_polizas_administracion').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_folios_polizas_administracion();
							
						}
						else if(arrPermisosFoliosPolizasAdministracion[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_folios_polizas_administracion').removeAttr('disabled');
						}
						else if(arrPermisosFoliosPolizasAdministracion[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_folios_polizas_administracion').removeAttr('disabled');
						}
						else if(arrPermisosFoliosPolizasAdministracion[i]=='ELIMINAR')//Si el indice es ELIMINAR
						{
							//Habilitar el control (botón eliminar)
							$('#btnEliminar_folios_polizas_administracion').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_folios_polizas_administracion() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_folios_polizas_administracion').val() != strUltimaBusquedaFoliosPolizasAdministracion)
			{
				intPaginaFoliosPolizasAdministracion = 0;
				strUltimaBusquedaFoliosPolizasAdministracion = $('#txtBusqueda_folios_polizas_administracion').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('administracion/folios_polizas/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_folios_polizas_administracion').val(),
						intPagina:intPaginaFoliosPolizasAdministracion,
						strPermisosAcceso: $('#txtAcciones_folios_polizas_administracion').val()
					},
					function(data){
						$('#dg_folios_polizas_administracion tbody').empty();
						var tmpFoliosPolizasAdministracion = Mustache.render($('#plantilla_folios_polizas_administracion').html(),data);
						$('#dg_folios_polizas_administracion tbody').html(tmpFoliosPolizasAdministracion);
						$('#pagLinks_folios_polizas_administracion').html(data.paginacion);
						$('#numElementos_folios_polizas_administracion').html(data.total_rows);
						intPaginaFoliosPolizasAdministracion = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_folios_polizas_administracion(strTipo)
		{
			
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'administracion/folios_polizas/';

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
										'strBusqueda': $('#txtBusqueda_folios_polizas_administracion').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_folios_polizas_administracion()
		{
			//Incializar formulario
			$('#frmFoliosPolizasAdministracion')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_folios_polizas_administracion();
			//Limpiar cajas de texto ocultas
			$('#frmFoliosPolizasAdministracion').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_folios_polizas_administracion');
			//Ocultar botón Eliminar
			$("#btnEliminar_folios_polizas_administracion").hide();
		}


		//Función para inicializar elementos del folio
		function inicializar_folios_polizas_administracion()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtSerie_folios_polizas_administracion').val('');
	        $('#txtConsecutivo_folios_polizas_administracion').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_folios_polizas_administracion()
		{
			try {
				//Cerrar modal
				objFoliosPolizasAdministracion.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_folios_polizas_administracion').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_folios_polizas_administracion()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_folios_polizas_administracion();
			//Validación del formulario de campos obligatorios
			$('#frmFoliosPolizasAdministracion')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {  
										strFolio_folios_polizas_administracion: {
											validators: {
												callback: {
				                                    callback: function(value, validator, $field) {
				                                    	//Verificar que exista id del folio
				                                    	if($('#txtFolioID_folios_polizas_administracion').val() === '')
				                                    	{
			                                      			return {
				                                            	valid: false,
				                                                message: 'Escriba un folio existente'
				                                            };
				                                    	}
				                                    	return true;
				                                    }
					                            }
											}
										}, 
										strTipo_folios_polizas_administracion: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_folios_polizas_administracion = $('#frmFoliosPolizasAdministracion').data('bootstrapValidator');
			bootstrapValidator_folios_polizas_administracion.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_folios_polizas_administracion.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_folios_polizas_administracion();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_folios_polizas_administracion()
		{
			try
			{
				$('#frmFoliosPolizasAdministracion').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para registrar (o actualizar) los datos de un folio
		function guardar_folios_polizas_administracion()
		{
			
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('administracion/folios_polizas/guardar',
					{ 
						intFolioID: $('#txtFolioID_folios_polizas_administracion').val(),
						intFolioIDAnterior: $('#txtFolioIDAnterior_folios_polizas_administracion').val(),
						strTipo: $('#cmbTipo_folios_polizas_administracion').val(),
						strTipoAnterior: $('#txtTipoAnterior_folios_polizas_administracion').val(),  
						
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_folios_polizas_administracion();
							//Hacer un llamado a la función para cerrar modal
							cerrar_folios_polizas_administracion();                  
						}
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_folios_polizas_administracion(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_folios_polizas_administracion(tipoMensaje, mensaje)
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

		//Función para eliminar los datos del registro seleccionado
		function eliminar_folios_polizas_administracion(folioID, tipo)
		{
			//Variables que se utilizan para asignar el id's del registro
			var intFolioID = 0;
			var strTipo = '';
			//Si no existen id's, significa que se realizará la modificación desde el modal
			if(folioID == '')
			{
				intFolioID = $('#txtFolioID_folios_polizas_administracion').val();
				strTipo = $('#cmbTipo_folios_polizas_administracion').val();
			}
			else
			{
				intFolioID = folioID;
				strTipo = tipo;
			}


			//Preguntar al usuario si desea eliminar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea eliminar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Folios por Póliza',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para eliminar los datos del registro
			                              $.post('administracion/folios_polizas/eliminar',
			                                     {intFolioID: intFolioID, 
			                                      strTipo: strTipo
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
				                                        //Hacer llamado a la función  para cargar  los registros en el grid
				                                        paginacion_folios_polizas_administracion();
			                                          	
			                                          	//Si el los id´s del registro pertenecen al modal
														if(folioID == '')
														{
															//Hacer un llamado a la función para cerrar modal
															cerrar_folios_polizas_administracion();     
														}
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_folios_polizas_administracion(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_folios_polizas_administracion(folioID, tipo, tipoAccion)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('administracion/folios_polizas/get_datos',
			       {intFolioID:folioID,
			       	strTipo: tipo
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_folios_polizas_administracion();
				          	//Recuperar valores
				            $('#txtFolioID_folios_polizas_administracion').val(data.row.folio_id);
				            $('#txtFolioIDAnterior_folios_polizas_administracion').val(data.row.folio_id);
				            $('#txtFolio_folios_polizas_administracion').val(data.row.folio);
				            $('#txtSerie_folios_polizas_administracion').val(data.row.serie);
				            $('#txtConsecutivo_folios_polizas_administracion').val(data.row.consecutivo);
				            $('#cmbTipo_folios_polizas_administracion').val(data.row.tipo);
				            $('#txtTipoAnterior_folios_polizas_administracion').val(data.row.tipo);

				            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
				            $('#divEncabezadoModal_folios_polizas_administracion').addClass("estatus-ACTIVO");
				            //Mostrar botón Eliminar
						    $("#btnEliminar_folios_polizas_administracion").show();

						    //Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Abrir modal
					            objFoliosPolizasAdministracion = $('#FoliosPolizasAdministracionBox').bPopup({
															appendTo: '#FoliosPolizasAdministracionContent', 
							                           		contentContainer: 'FoliosPolizasAdministracionM', 
							                            	zIndex: 2, 
							                            	modalClose: false, 
							                            	modal: true, 
							                            	follow: [true,false], 
							                            	followEasing : "linear", 
							                            	easing: "linear", 
							                            	modalColor: ('#F0F0F0')});
						        //Enfocar caja de texto
								$('#txtFolio_folios_polizas_administracion').focus();
							}
							
			       	    }
			       },
			       'json');
		}


		//Función para regresar y obtener los datos de un folio
		function get_datos_folios_polizas_administracion()
		{
			//Hacer un llamado al método del controlador para regresar los datos del folio
             $.post('administracion/folios/get_datos',
                  { 
                  	strBusqueda:$("#txtFolioID_folios_polizas_administracion").val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtFolio_folios_polizas_administracion").val(data.row.descripcion);
                       $("#txtSerie_folios_polizas_administracion").val(data.row.serie);
                       $("#txtConsecutivo_folios_polizas_administracion").val(data.row.consecutivo);
                    }
                  }
                 ,
                'json');

		}

		//Función para verificar la existencia de un registro
		function verificar_existencia_folios_polizas_administracion()
		{
			//Si no existe id, verificar la existencia de la tasa de IEPS
			if ($('#txtFolioIDAnterior_folios_polizas_administracion').val() == '' && $('#cmbTipo_folios_polizas_administracion').val() != '')
			{
				
				//Hacer un llamado a la función para recuperar los datos del registro que coincide con los id´s
				editar_folios_polizas_administracion($('#txtFolioID_folios_polizas_administracion').val(),
													 $('#cmbTipo_folios_polizas_administracion').val(), 'Nuevo');
			}
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Autocomplete para recuperar los datos de un folio 
	        $('#txtFolio_folios_polizas_administracion').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtFolioID_folios_polizas_administracion').val('');
	               //Hacer un llamado a la función para inicializar elementos del folio
	               inicializar_folios_polizas_administracion();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "administracion/folios/autocomplete",
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
	             $('#txtFolioID_folios_polizas_administracion').val(ui.item.data);
				 //Hacer un llamado a la función para regresar los datos del folio
	             get_datos_folios_polizas_administracion();
	             //Hacer un llamado a la función para verificar la existencia del registro
	             verificar_existencia_folios_polizas_administracion();
	             
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del folio cuando pierda el enfoque la caja de texto
	        $('#txtFolio_folios_polizas_administracion').focusout(function(e){
	            //Si no existe id del folio
	            if($('#txtFolioID_folios_polizas_administracion').val() == '' ||
	               $('#txtFolio_folios_polizas_administracion').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtFolioID_folios_polizas_administracion').val('');
	               $('#txtFolio_folios_polizas_administracion').val('');
	               //Hacer un llamado a la función para inicializar elementos del folio
	               inicializar_folios_polizas_administracion();
	            }
	            
	        });


	        //Verificar existencia del registro cuando cambie la opción del combobox
	        $('#cmbTipo_folios_polizas_administracion').change(function(){
	        
		        //Hacer un llamado a la función para verificar la existencia del registro
	            verificar_existencia_folios_polizas_administracion();

	        });   


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_folios_polizas_administracion').on('click','a',function(event){
				event.preventDefault();
				intPaginaFoliosPolizasAdministracion = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_folios_polizas_administracion();
			});

			//Abrir modal Folios cuando se de clic en el botón
			$('#btnNuevo_folios_polizas_administracion').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_folios_polizas_administracion();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_folios_polizas_administracion').addClass("estatus-NUEVO");
				//Abrir modal
				objFoliosPolizasAdministracion = $('#FoliosPolizasAdministracionBox').bPopup({
											appendTo: '#FoliosPolizasAdministracionContent', 
							               	contentContainer: 'FoliosPolizasAdministracionM', 
							                zIndex: 2, 
							                modalClose: false, 
							                modal: true, 
							                follow: [true,false], 
							                followEasing : "linear", 
							                easing: "linear", 
							                modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtFolio_folios_polizas_administracion').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_folios_polizas_administracion').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_folios_polizas_administracion();
		});
	</script>