	<div id="FoliosProcesosAdministracionContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_folios_procesos_administracion" action="#" method="post" tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_folios_procesos_administracion" name="strBusqueda_folios_procesos_administracion"  
								   type="text" value="" tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_folios_procesos_administracion"
										onclick="paginacion_folios_procesos_administracion();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_folios_procesos_administracion" title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_folios_procesos_administracion"
									onclick="reporte_folios_procesos_administracion('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button> 
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_folios_procesos_administracion"
									onclick="reporte_folios_procesos_administracion('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				td.movil:nth-of-type(4):before {content: "Proceso"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Proceso Padre"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_folios_procesos_administracion">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Consecutivo</th>
							<th class="movil">Tipo</th>
							<th class="movil">Proceso</th>
							<th class="movil">Proceso Padre</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_folios_procesos_administracion" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">  
							<td class="movil">{{folio}}</td>
							<td class="movil">{{consecutivo}}</td>
							<td class="movil">{{tipo}}</td>
							<td class="movil">{{proceso}}</td>
							<td class="movil">{{proceso_padre}}</td>
							<td class="td-center movil"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_folios_procesos_administracion({{folio_id}},{{proceso_id}})"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Eliminar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEliminar}}"  
										onclick="eliminar_folios_procesos_administracion({{folio_id}},{{proceso_id}})"  title="Eliminar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_folios_procesos_administracion"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_folios_procesos_administracion">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="FoliosProcesosAdministracionBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_folios_procesos_administracion"  class="ModalBodyTitle">
			<h1>Folios por Proceso</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmFoliosProcesosAdministracion" method="post" action="#" class="form-horizontal" role="form" name="frmFoliosProcesosAdministracion" 
					  onsubmit="return(false)" autocomplete="off">
					<div class="row">
					   <!--Autocomplete que contiene los folios activos-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del folio seleccionado-->
									<input id="txtFolioID_folios_procesos_administracion" name="intFolioID_folios_procesos_administracion"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del folio anterior y así evitar duplicidad en caso de que exista otro registro con el mismo folio-->
									<input id="txtFolioIDAnterior_folios_procesos_administracion" name="intFolioIDAnterior_folios_procesos_administracion"  
										   type="hidden" value="">
									</input>
									<label for="txtFolio_folios_procesos_administracion">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtFolio_folios_procesos_administracion" name="strFolio_folios_procesos_administracion" 
											type="text" value="" tabindex="1" placeholder="Ingrese folio" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Serie-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSerie_folios_procesos_administracion">Serie</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtSerie_folios_procesos_administracion" name="strSerie_folios_procesos_administracion" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Consecutivo-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtConsecutivo_folios_procesos_administracion">Consecutivo</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" id="txtConsecutivo_folios_procesos_administracion" name="intConsecutivo_folios_procesos_administracion" 
										   type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Tipo-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbTipo_folios_procesos_administracion">Tipo</label>
								</div>
								<div id="divCmbMsjValidacion" class="col-md-12">
									<select class="form-control" id="cmbTipo_folios_procesos_administracion" 
									 		name="strTipo_folios_procesos_administracion" tabindex="1">
									 	<option value="">Seleccione una opción</option>
                          				<option value="PROCESO">PROCESO</option>
                          				<option value="POLIZA">POLIZA</option>
                     				</select>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Nivel 1-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del proceso seleccionado-->
									<input id="txtProcesoID_folios_procesos_administracion" name="intProcesoID_folios_procesos_administracion"  
										   type="hidden" value="">
									</input>
									<!-- Caja de texto oculta que se utiliza para recuperar el id del proceso anterior y así evitar duplicidad en caso de que exista otro registro con el mismo proceso-->
									<input id="txtProcesoIDAnterior_folios_procesos_administracion" name="intProcesoIDAnterior_folios_procesos_administracion"  
										   type="hidden" value="">
									</input>
									<label for="cmbProcesoIDNivel1_folios_procesos_administracion">Menú Nivel 1</label>
								</div>
								<div class="col-md-12">
									<select id="cmbProcesoIDNivel1_folios_procesos_administracion" 
											name="intProcesoPadreIDNivel1_folios_procesos_administracion" 
											class="form-control" tabindex="1" >
									</select>
								</div>
							</div>
						</div>
						<!--Nivel 2-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbProcesoIDNivel2_folios_procesos_administracion">Menú Nivel 2</label>
								</div>
								<div class="col-md-12">
									<select id="cmbProcesoIDNivel2_folios_procesos_administracion" 
											name="intProcesoPadreIDNivel2_folios_procesos_administracion" 
											class="form-control" tabindex="1" >
									</select>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Nivel 3-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbProcesoIDNivel3_folios_procesos_administracion">Menú Nivel 3</label>
								</div>
								<div class="col-md-12">
									<select id="cmbProcesoIDNivel3_folios_procesos_administracion" 
											name="intProcesoPadreIDNivel3_folios_procesos_administracion" 
											class="form-control" tabindex="1" >
									</select>
								</div>
							</div>
						</div>
						<!--Nivel 4-->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbProcesoIDNivel4_folios_procesos_administracion">Menú Nivel 4</label>
								</div>
								<div class="col-md-12">
									<select id="cmbProcesoIDNivel4_folios_procesos_administracion" 
											name="intProcesoPadreIDNivel4_folios_procesos_administracion" 
											class="form-control" tabindex="1" >
									</select>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_folios_procesos_administracion"  
									onclick="validar_folios_procesos_administracion();" title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Eliminar registro-->
							<button class="btn btn-default" id="btnEliminar_folios_procesos_administracion"  
									onclick="eliminar_folios_procesos_administracion('','');"  title="Eliminar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-trash"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar" id="btnCerrar_folios_procesos_administracion" type="reset" aria-hidden="true" 
									onclick="cerrar_folios_procesos_administracion();" title="Cerrar" tabindex="4">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#FoliosProcesosAdministracionContent -->

	<!--Plantilla para cargar el combobox Nivel1-->  
	<script id="plantilla_procesos_nivel1_folios_procesos_administracion" type="text/template">
		<option value="">Seleccione un proceso</option>
		{{#procesos}}
			<option value="{{value}}">{{nombre}}</option>
		{{/procesos}} 
	</script>
	<!--Plantilla para cargar el combobox Nivel2-->  
	<script id="plantilla_procesos_nivel2_folios_procesos_administracion" type="text/template">
		<option value="">Seleccione un proceso</option>
		{{#procesos}}
			<option value="{{value}}">{{nombre}}</option>
		{{/procesos}} 
	</script>
	<!--Plantilla para cargar el combobox Nivel3-->  
	<script id="plantilla_procesos_nivel3_folios_procesos_administracion" type="text/template">
		<option value="">Seleccione un proceso</option>
		{{#procesos}}
			<option value="{{value}}">{{nombre}}</option>
		{{/procesos}} 
	</script>
	<!--Plantilla para cargar el combobox Nivel4-->  
	<script id="plantilla_procesos_nivel4_folios_procesos_administracion" type="text/template">
		<option value="">Seleccione un proceso</option>
		{{#procesos}}
			<option value="{{value}}">{{nombre}}</option>
		{{/procesos}} 
	</script>

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaFoliosProcesosAdministracion = 0;
		var strUltimaBusquedaFoliosProcesosAdministracion = "";
		//Variable que se utiliza para asignar objeto del modal
		var objFoliosProcesosAdministracion = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_folios_procesos_administracion()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('administracion/folios_procesos/get_permisos_acceso',
			{
				strPermisosAcceso: $('#txtAcciones_folios_procesos_administracion').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosFoliosProcesosAdministracion = data.row;
					//Separar la cadena 
					var arrPermisosFoliosProcesosAdministracion = strPermisosFoliosProcesosAdministracion.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosFoliosProcesosAdministracion.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosFoliosProcesosAdministracion[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_folios_procesos_administracion').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosFoliosProcesosAdministracion[i]=='GUARDAR') || (arrPermisosFoliosProcesosAdministracion[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_folios_procesos_administracion').removeAttr('disabled');
						}
						else if(arrPermisosFoliosProcesosAdministracion[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_folios_procesos_administracion').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_folios_procesos_administracion();
							//Hacer un llamado a la función para cargar procesos en el combobox
							cargar_combos_folios_procesos_administracion('NIVEL 1', 0, 0, 0, 0);
							
						}
						else if(arrPermisosFoliosProcesosAdministracion[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_folios_procesos_administracion').removeAttr('disabled');
						}
						else if(arrPermisosFoliosProcesosAdministracion[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_folios_procesos_administracion').removeAttr('disabled');
						}
						else if(arrPermisosFoliosProcesosAdministracion[i]=='ELIMINAR')//Si el indice es ELIMINAR
						{
							//Habilitar el control (botón eliminar)
							$('#btnEliminar_folios_procesos_administracion').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_folios_procesos_administracion() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_folios_procesos_administracion').val() != strUltimaBusquedaFoliosProcesosAdministracion)
			{
				intPaginaFoliosProcesosAdministracion = 0;
				strUltimaBusquedaFoliosProcesosAdministracion = $('#txtBusqueda_folios_procesos_administracion').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('administracion/folios_procesos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_folios_procesos_administracion').val(),
						intPagina:intPaginaFoliosProcesosAdministracion,
						strPermisosAcceso: $('#txtAcciones_folios_procesos_administracion').val()
					},
					function(data){
						$('#dg_folios_procesos_administracion tbody').empty();
						var tmpFoliosProcesosAdministracion = Mustache.render($('#plantilla_folios_procesos_administracion').html(),data);
						$('#dg_folios_procesos_administracion tbody').html(tmpFoliosProcesosAdministracion);
						$('#pagLinks_folios_procesos_administracion').html(data.paginacion);
						$('#numElementos_folios_procesos_administracion').html(data.total_rows);
						intPaginaFoliosProcesosAdministracion = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_folios_procesos_administracion(strTipo)
		{
			
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'administracion/folios_procesos/';

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
										'strBusqueda': $('#txtBusqueda_folios_procesos_administracion').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_folios_procesos_administracion()
		{
			//Incializar formulario
			$('#frmFoliosProcesosAdministracion')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_folios_procesos_administracion();
			//Limpiar cajas de texto ocultas
			$('#frmFoliosProcesosAdministracion').find('input[type=hidden]').val('');
			//Limpiar combobox
			$('#cmbProcesoIDNivel2_folios_procesos_administracion').empty();
			$('#cmbProcesoIDNivel3_folios_procesos_administracion').empty();
			$('#cmbProcesoIDNivel4_folios_procesos_administracion').empty();
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_folios_procesos_administracion');
			//Ocultar botón Eliminar
			$("#btnEliminar_folios_procesos_administracion").hide();
		}


		//Función para inicializar elementos del folio
		function inicializar_folio_folios_procesos_administracion()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtSerie_folios_procesos_administracion').val('');
	        $('#txtConsecutivo_folios_procesos_administracion').val('');
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_folios_procesos_administracion()
		{
			try {
				//Cerrar modal
				objFoliosProcesosAdministracion.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_folios_procesos_administracion').focus();
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_folios_procesos_administracion()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_folios_procesos_administracion();
			//Validación del formulario de campos obligatorios
			$('#frmFoliosProcesosAdministracion')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {  
										strFolio_folios_procesos_administracion: {
											validators: {
												callback: {
				                                    callback: function(value, validator, $field) {
				                                    	//Verificar que exista id del folio
				                                    	if($('#txtFolioID_folios_procesos_administracion').val() === '')
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
										strTipo_folios_procesos_administracion: {
											validators: {
												notEmpty: {message: 'Seleccione un tipo'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_folios_procesos_administracion = $('#frmFoliosProcesosAdministracion').data('bootstrapValidator');
			bootstrapValidator_folios_procesos_administracion.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_folios_procesos_administracion.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_folios_procesos_administracion();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_folios_procesos_administracion()
		{
			try
			{
				$('#frmFoliosProcesosAdministracion').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para registrar (o actualizar) los datos de un folio
		function guardar_folios_procesos_administracion()
		{
			//Variable que obtiene el ID del proceso seleccionado
			var intProcesoIDFoliosProcesosAdministracion = '';
			//Asignar id del proceso nivel 1
			var intProcesoIDNivel1FoliosProcesosAdministracion = $('#cmbProcesoIDNivel1_folios_procesos_administracion').val();
			//Asignar id del proceso nivel 2
			var intProcesoIDNivel2FoliosProcesosAdministracion = $('#cmbProcesoIDNivel2_folios_procesos_administracion').val();
			//Asignar id del proceso nivel 3
			var intProcesoIDNivel3FoliosProcesosAdministracion = $('#cmbProcesoIDNivel3_folios_procesos_administracion').val();
			//Asignar id del proceso nivel 4
			var intProcesoIDNivel4FoliosProcesosAdministracion = $('#cmbProcesoIDNivel4_folios_procesos_administracion').val();

			//Si existe id del proceso nivel 1
			if(intProcesoIDNivel1FoliosProcesosAdministracion != '' && intProcesoIDNivel1FoliosProcesosAdministracion != null)
			{

				intProcesoIDFoliosProcesosAdministracion = intProcesoIDNivel1FoliosProcesosAdministracion;
			}

			//Si existe id del proceso nivel 2
			if(intProcesoIDNivel2FoliosProcesosAdministracion != '' && intProcesoIDNivel2FoliosProcesosAdministracion != null)
			{

				intProcesoIDFoliosProcesosAdministracion = intProcesoIDNivel2FoliosProcesosAdministracion;
			}

			//Si existe id del proceso nivel 3
			if(intProcesoIDNivel3FoliosProcesosAdministracion != '' && intProcesoIDNivel3FoliosProcesosAdministracion != null)
			{

				intProcesoIDFoliosProcesosAdministracion = intProcesoIDNivel3FoliosProcesosAdministracion;
			}

			//Si existe id del proceso nivel 4
			if(intProcesoIDNivel4FoliosProcesosAdministracion != '' && intProcesoIDNivel4FoliosProcesosAdministracion != null)
			{

				intProcesoIDFoliosProcesosAdministracion = intProcesoIDNivel4FoliosProcesosAdministracion;
			}

			//Si no se ha seleccionado un proceso
			if (intProcesoIDFoliosProcesosAdministracion == '')
			{
				mensaje_folios_procesos_administracion('error', 'Seleccione un proceso.');
			}
			else
			{
				//Hacer un llamado al método del controlador para guardar los datos del registro
				$.post('administracion/folios_procesos/guardar',
						{ 
							intFolioID: $('#txtFolioID_folios_procesos_administracion').val(),
							intFolioIDAnterior: $('#txtFolioIDAnterior_folios_procesos_administracion').val(),
							intProcesoID: intProcesoIDFoliosProcesosAdministracion,
							intProcesoIDAnterior: $('#txtProcesoIDAnterior_folios_procesos_administracion').val(),
							strTipo: $('#cmbTipo_folios_procesos_administracion').val()
						},
						function(data) {
							if (data.resultado)
							{
								//Hacer llamado a la función  para cargar los registros en el grid
								paginacion_folios_procesos_administracion();
								//Hacer un llamado a la función para cerrar modal
								cerrar_folios_procesos_administracion();                  
							}
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_folios_procesos_administracion(data.tipo_mensaje, data.mensaje);
						},
				'json');
			}
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_folios_procesos_administracion(tipoMensaje, mensaje)
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
		function eliminar_folios_procesos_administracion(folioID, procesoID)
		{
			//Variables que se utilizan para asignar el id's del registro
			var intFolioID = 0;
			var intProcesoID = 0;
			//Si no existen id's, significa que se realizará la modificación desde el modal
			if(folioID == '')
			{
				intFolioID = $('#txtFolioID_folios_procesos_administracion').val();
				intProcesoID = $('#txtProcesoID_folios_procesos_administracion').val();

			}
			else
			{
				intFolioID = folioID;
				intProcesoID = procesoID;
			}


			//Preguntar al usuario si desea eliminar el registro
			new $.Zebra_Dialog('<strong>¿Está seguro que desea eliminar el registro?</strong>',
			             {'type':     'question',
			              'title':    'Folios por Proceso',
			              'buttons':  ['Aceptar', 'Cancelar'],
			              'onClose':  function(caption) {
			                            if(caption == 'Aceptar')
			                            {
			                              //Hacer un llamado al método del controlador para eliminar los datos del registro
			                              $.post('administracion/folios_procesos/eliminar',
			                                     {intFolioID: intFolioID,
			                                      intProcesoID: intProcesoID
			                                     },
			                                     function(data) {
			                                        if(data.resultado)
			                                        {
				                                        //Hacer llamado a la función  para cargar  los registros en el grid
				                                        paginacion_folios_procesos_administracion();
			                                          	
			                                          	//Si el los id´s del registro pertenecen al modal
														if(folioID == '')
														{
															//Hacer un llamado a la función para cerrar modal
															cerrar_folios_procesos_administracion();     
														}
			                                        }
			                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			                                        mensaje_folios_procesos_administracion(data.tipo_mensaje, data.mensaje);
			                                     },
			                                    'json');
			                            }
			                          }
			              });
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_folios_procesos_administracion(folioID, procesoID)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('administracion/folios_procesos/get_datos',
			       {intFolioID:folioID,
			       	intProcesoID:procesoID
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_folios_procesos_administracion();
				          	//Recuperar valores
				            $('#txtFolioID_folios_procesos_administracion').val(data.row.folio_id);
				            $('#txtFolioIDAnterior_folios_procesos_administracion').val(data.row.folio_id);
				            $('#txtProcesoID_folios_procesos_administracion').val(data.row.proceso_id);
				            $('#txtProcesoIDAnterior_folios_procesos_administracion').val(data.row.proceso_id);
				            $('#txtFolio_folios_procesos_administracion').val(data.row.folio);
				            $('#txtSerie_folios_procesos_administracion').val(data.row.serie);
				            $('#txtConsecutivo_folios_procesos_administracion').val(data.row.consecutivo);
				            $('#cmbTipo_folios_procesos_administracion').val(data.row.tipo);

				            //Si se cumple la sentencia
				            if(data.row.proceso_nivel3 === null && data.row.proceso_nivel2 === null && data.row.proceso_nivel1 === null)
				            {

				            	$('#cmbProcesoIDNivel1_folios_procesos_administracion').val(data.row.proceso_id);
				            }
				            else if (data.row.proceso_nivel3 !== null)
							{
								//Hacer un llamado a la función para cargar procesos en el combobox
								cargar_combos_folios_procesos_administracion('NIVEL 1', data.row.proceso_nivel3, data.row.proceso_nivel2, data.row.proceso_nivel1, data.row.proceso_id);
							}
							else if (data.row.proceso_nivel2 !== null)
							{
								//Hacer un llamado a la función para cargar procesos en el combobox
								cargar_combos_folios_procesos_administracion('NIVEL 1', data.row.proceso_nivel2, data.row.proceso_nivel1, data.row.proceso_id);
							}
							else if (data.row.proceso_nivel1 !== null)
							{
								//Hacer un llamado a la función para cargar procesos en el combobox
								cargar_combos_folios_procesos_administracion('NIVEL 1', data.row.proceso_nivel1, data.row.proceso_id);
							}
				            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
				            $('#divEncabezadoModal_folios_procesos_administracion').addClass("estatus-ACTIVO");
				            //Mostrar botón Eliminar
						    $("#btnEliminar_folios_procesos_administracion").show();


			            	//Abrir modal
				            objFoliosProcesosAdministracion = $('#FoliosProcesosAdministracionBox').bPopup({
														appendTo: '#FoliosProcesosAdministracionContent', 
						                           		contentContainer: 'FoliosProcesosAdministracionM', 
						                            	zIndex: 2, 
						                            	modalClose: false, 
						                            	modal: true, 
						                            	follow: [true,false], 
						                            	followEasing : "linear", 
						                            	easing: "linear", 
						                            	modalColor: ('#F0F0F0')});
					        //Enfocar caja de texto
							$('#txtFolio_folios_procesos_administracion').focus();
							
			       	    }
			       },
			       'json');
		}


		//Función para regresar y obtener los datos de un folio
		function get_datos_folio_folios_procesos_administracion()
		{
			//Hacer un llamado al método del controlador para regresar los datos del folio
             $.post('administracion/folios/get_datos',
                  { 
                  	strBusqueda:$("#txtFolioID_folios_procesos_administracion").val(),
		       		strTipo: 'id'
                  },
                  function(data) {
                    if(data.row){
                       $("#txtFolio_folios_procesos_administracion").val(data.row.descripcion);
                       $("#txtSerie_folios_procesos_administracion").val(data.row.serie);
                       $("#txtConsecutivo_folios_procesos_administracion").val(data.row.consecutivo);
                    }
                  }
                 ,
                'json');

		}

		//Cargar procesos en el combobox dependiendo del parámetro enviado
		function cargar_combos_folios_procesos_administracion(strCombo, intPP1 = 0, intPP2 = 0, intPP3 = 0, intPP4 = 0)
		{
			if (strCombo == 'NIVEL 1')
			{
				intProcesoPadreID = 0;
			}
			else if (strCombo == 'NIVEL 2')
			{
				if (intPP1 != 0)
				{
					intProcesoPadreID = intPP1;
				}
				else
				{
					intProcesoPadreID = $('#cmbProcesoIDNivel1_folios_procesos_administracion').val();
				}
			}
			else if (strCombo == 'NIVEL 3')
			{
				if (intPP2 != 0)
				{
					intProcesoPadreID = intPP2;
				}
				else
				{
					intProcesoPadreID = $('#cmbProcesoIDNivel2_folios_procesos_administracion').val();
				}
			}
			else//Nivel 4
			{
				if (intPP3 != 0)
				{
					intProcesoPadreID = intPP3;
				}
				else
				{
					intProcesoPadreID = $('#cmbProcesoIDNivel3_folios_procesos_administracion').val();
				}
			}
			//Hacer un llamado al método para consultar los procesos activos
			$.post('seguridad/procesos/get_combo_box',
				   {
						intProcesoPadreID: intProcesoPadreID
				   },
				   function(data) {
						if (strCombo == 'NIVEL 1')
						{
							$('#cmbProcesoIDNivel1_folios_procesos_administracion').empty();
							var temp = Mustache.render($('#plantilla_procesos_nivel1_folios_procesos_administracion').html(), data);
							$('#cmbProcesoIDNivel1_folios_procesos_administracion').html(temp);
							if (intPP1 != 0)
							{
								$('#cmbProcesoIDNivel1_folios_procesos_administracion').val(intPP1);
								cargar_combos_folios_procesos_administracion('NIVEL 2', intPP1, intPP2, intPP3, intPP4);
							}
						}
						else if (strCombo == 'NIVEL 2')
						{
							//Limpiar combobox
							$('#cmbProcesoIDNivel2_folios_procesos_administracion').empty();
							$('#cmbProcesoIDNivel3_folios_procesos_administracion').empty();
							$('#cmbProcesoIDNivel4_folios_procesos_administracion').empty();
							//Si existe id del proceso del nivel 1
							if($('#cmbProcesoIDNivel1_folios_procesos_administracion').val() != '')
							{
								var temp = Mustache.render($('#plantilla_procesos_nivel2_folios_procesos_administracion').html(), data);
								$('#cmbProcesoIDNivel2_folios_procesos_administracion').html(temp);
								if (intPP2 != 0)
								{
									$('#cmbProcesoIDNivel2_folios_procesos_administracion').val(intPP2);
									cargar_combos_folios_procesos_administracion('NIVEL 3', intPP1, intPP2, intPP3, intPP4);
								}
						    }
						}
						else if (strCombo == 'NIVEL 3')
						{
							//Limpiar combobox
							$('#cmbProcesoIDNivel3_folios_procesos_administracion').empty();
							//Si existe id del proceso del nivel 2
							if($('#cmbProcesoIDNivel2_folios_procesos_administracion').val() != '')
							{
								//Si hay procesos en el nivel 3
								if(data.procesos.length > 0)
								{
									var temp = Mustache.render($('#plantilla_procesos_nivel3_folios_procesos_administracion').html(), data);
									$('#cmbProcesoIDNivel3_folios_procesos_administracion').html(temp);
									if (intPP3 != 0)
									{
										$('#cmbProcesoIDNivel3_folios_procesos_administracion').val(intPP3);
										cargar_combos_folios_procesos_administracion('NIVEL 4', intPP1, intPP2, intPP3, intPP4);
									}
								}
							}
						}
						else //Nivel 4
						{
							//Limpiar combobox
							$('#cmbProcesoIDNivel4_folios_procesos_administracion').empty();
							//Si existe id del proceso del nivel 3
							if($('#cmbProcesoIDNivel3_folios_procesos_administracion').val() != '')
							{
								//Si hay procesos en el nivel 4
								if(data.procesos.length > 0)
								{
									var temp = Mustache.render($('#plantilla_procesos_nivel4_folios_procesos_administracion').html(), data);

									$('#cmbProcesoIDNivel4_folios_procesos_administracion').html(temp);
									if (intPP4 != 0)
									{
										$('#cmbProcesoIDNivel4_folios_procesos_administracion').val(intPP4);
									}
								}
								
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

			//Cargar procesos del nivel 2 cuando se modifique la selección del combo
			$('#cmbProcesoIDNivel1_folios_procesos_administracion').change(function(e){
				cargar_combos_folios_procesos_administracion('NIVEL 2', $('#cmbProcesoIDNivel1_folios_procesos_administracion').val());
			});

			//Cargar procesos del nivel 2 cuando se modifique la selección del combo
			$('#cmbProcesoIDNivel1_folios_procesos_administracion').change(function(e){
				cargar_combos_folios_procesos_administracion('NIVEL 2', $('#cmbProcesoIDNivel1_folios_procesos_administracion').val());
			});

			//Cargar procesos del nivel 3 cuando se modifique la selección del combo
			$('#cmbProcesoIDNivel2_folios_procesos_administracion').change(function(e){
				cargar_combos_folios_procesos_administracion('NIVEL 3', 0, $('#cmbProcesoIDNivel2_folios_procesos_administracion').val());
			});

			//Cargar procesos del nivel 4 cuando se modifique la selección del combo
			$('#cmbProcesoIDNivel3_folios_procesos_administracion').change(function(e){
				cargar_combos_folios_procesos_administracion('NIVEL 4', 0, 0, $('#cmbProcesoIDNivel3_folios_procesos_administracion').val());
			});

			//Autocomplete para recuperar los datos de un folio 
	        $('#txtFolio_folios_procesos_administracion').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtFolioID_folios_procesos_administracion').val('');
	               //Hacer un llamado a la función para inicializar elementos del folio
	               inicializar_folio_folios_procesos_administracion();
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
	             $('#txtFolioID_folios_procesos_administracion').val(ui.item.data);
				 //Hacer un llamado a la función para regresar los datos del folio
	             get_datos_folio_folios_procesos_administracion();
	             
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
	        $('#txtFolio_folios_procesos_administracion').focusout(function(e){
	            //Si no existe id del folio
	            if($('#txtFolioID_folios_procesos_administracion').val() == '' ||
	               $('#txtFolio_folios_procesos_administracion').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtFolioID_folios_procesos_administracion').val('');
	               $('#txtFolio_folios_procesos_administracion').val('');
	               //Hacer un llamado a la función para inicializar elementos del folio
	               inicializar_folio_folios_procesos_administracion();
	            }
	            
	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_folios_procesos_administracion').on('click','a',function(event){
				event.preventDefault();
				intPaginaFoliosProcesosAdministracion = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_folios_procesos_administracion();
			});

			//Abrir modal Folios cuando se de clic en el botón
			$('#btnNuevo_folios_procesos_administracion').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_folios_procesos_administracion();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_folios_procesos_administracion').addClass("estatus-NUEVO");
				//Abrir modal
				objFoliosProcesosAdministracion = $('#FoliosProcesosAdministracionBox').bPopup({
											appendTo: '#FoliosProcesosAdministracionContent', 
							               	contentContainer: 'FoliosProcesosAdministracionM', 
							                zIndex: 2, 
							                modalClose: false, 
							                modal: true, 
							                follow: [true,false], 
							                followEasing : "linear", 
							                easing: "linear", 
							                modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtFolio_folios_procesos_administracion').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_folios_procesos_administracion').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_folios_procesos_administracion();
		});
	</script>