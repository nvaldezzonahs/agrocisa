	<div id="ProcesosSeguridadContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_procesos_seguridad" action="#" method="post" tabindex="-5" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_procesos_seguridad" name="strBusqueda_procesos_seguridad"  type="text" value="" tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_procesos_seguridad"
										onclick="paginacion_procesos_seguridad();" title="Buscar coincidencias" tabindex="1" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_procesos_seguridad" title="Nuevo registro" tabindex="1" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_procesos_seguridad"
									onclick="reporte_procesos_seguridad('PDF');" title="Imprimir reporte general en PDF" tabindex="1" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_procesos_seguridad"
									onclick="reporte_procesos_seguridad('XLS');" title="Descargar reporte general en XLS" tabindex="1" disabled>
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
				Definir columnas de la tabla procesos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Proceso"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Proceso Padre"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Nivel"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Orden"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Estatus"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
				/*
				Definir columnas de la tabla subprocesos
				*/
				td.movil.b1:nth-of-type(1):before {content: "Función"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Acción"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_procesos_seguridad">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Proceso</th>
							<th class="movil">Proceso Padre</th>
							<th class="movil">Nivel</th>
							<th class="movil">Orden</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_procesos_seguridad" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{proceso}}</td>
							<td class="movil a2">{{proceso_padre}}</td>
							<td class="movil a3">{{menu_nivel}}</td>
							<td class="movil a4">{{orden}}</td>
							<td class="movil a5">{{estatus}}</td>
							<td class="movil a6 td-center"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_procesos_seguridad({{proceso_id}}, 'Editar')"  title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_procesos_seguridad({{proceso_id}},'Ver');" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_procesos_seguridad({{proceso_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_procesos_seguridad({{proceso_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_procesos_seguridad"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_procesos_seguridad">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal -->
		<div id="ProcesosSeguridadBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_procesos_seguridad" class="ModalBodyTitle">
				<h1>Procesos</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Tabs-->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
						<div class="form-group">
							<ul class="nav nav-tabs  nav-justified" id="tabs_procesos_seguridad" role="tablist">
								<!--Tab que contiene la información del proceso-->
								<li id="tabProceso_procesos_seguridad" class="active">
									<a data-toggle="tab" href="#proceso_procesos_seguridad">Proceso</a>
								</li>
								<!--Tab que contiene la información de los subprocesos-->
								<li id="tabSubprocesos_procesos_seguridad" class="disabled disabledTab">
									<a data-toggle="tab" href="#subprocesos_procesos_seguridad">Subprocesos</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!--Diseño del formulario-->
				<form id="frmProcesosSeguridad" method="post" action="#" class="form-horizontal" role="form" name="frmProcesosSeguridad" 
					  onsubmit="return(false)" autocomplete="off">
					<!--Mostrar contenido (template) correspondiente al Tab seleccionado-->
					<div class="tab-content">
						<!--Tab - Proceso-->
						<div id="proceso_procesos_seguridad" class="tab-pane fade in active">
							<div class="row">
								<!--Descripción-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<!-- Caja de texto oculta que se utiliza para recuperar el id del proceso seleccionado--> 
											<input id="txtProcesoID_procesos_seguridad" name="intProcesoID_procesos_seguridad" 
												   type="hidden" value="">
											</input>
											<label for="txtDescripcion_procesos_seguridad">Descripción</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtDescripcion_procesos_seguridad" name="strDescripcion_procesos_seguridad" 
												   type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="50">
											</input>
										</div>
									</div>
								</div>
								<!--Ruta de acceso-->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtRutaAcceso_procesos_seguridad">Ruta de acceso</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtRutaAcceso_procesos_seguridad" name="strRutaAcceso_procesos_seguridad" 
												   type="text" value="" tabindex="1" placeholder="Ingrese ruta de acceso">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Tipo de ventana-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbTipoVentana_procesos_seguridad">Tipo de ventana</label>
										</div>
										<div class="col-md-12">
											<select id="cmbTipoVentana_procesos_seguridad" name="strTipoVentana_procesos_seguridad" 
													class="form-control" tabindex="1" >
												<option value="PRINCIPAL">PRINCIPAL</option>
												<option value="REPORTES">REPORTES</option>
												<option value="CHICA">CHICA</option>
												<option value="MEDIANA">MEDIANA</option>
											</select>
										</div>
									</div>
								</div>
								<!--Nivel de menú-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbMenuNivel_procesos_seguridad">Nivel de menú</label>
										</div>
										<div class="col-md-12">
											<select id="cmbMenuNivel_procesos_seguridad" name="strMenuNivel_procesos_seguridad" 
													class="form-control" tabindex="1" >
												<option value="NIVEL 1">NIVEL 1</option>
												<option value="NIVEL 2">NIVEL 2</option>
												<option value="NIVEL 3">NIVEL 3</option>
												<option value="NIVEL 4">NIVEL 4</option>
											</select>
										</div>
									</div>
								</div>
								<!--Orden-->
								<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
									<div class="form-group">
										<div class="col-md-12">
											<label for="txtOrden_procesos_seguridad">Orden</label>
										</div>
										<div class="col-md-12">
											<input class="form-control" id="txtOrden_procesos_seguridad" name="intOrden_procesos_seguridad" 
												   type="text" value="" tabindex="1" placeholder="Ingrese orden" maxlength ="3">
											</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<!--Combobox que contiene los procesos correspondientes al nivel 1-->
								<div id="divProcesoPadreNivel1_procesos_seguridad" class="no-mostrar"">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbProcesoPadreIDNivel1_procesos_seguridad">Proceso padre del menú nivel 1</label>
										</div>
										<div class="col-md-12">
											<select id="cmbProcesoPadreIDNivel1_procesos_seguridad" name="intProcesoPadreIDNivel1_procesos_seguridad" 
													class="form-control" tabindex="1" >
											</select>
										</div>
									</div>
								</div>
								<!--Combobox que contiene los procesos correspondientes al nivel 2-->
								<div id="divProcesoPadreNivel2_procesos_seguridad" class="no-mostrar">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbProcesoPadreIDNivel2_procesos_seguridad">Proceso padre del menú nivel 2</label>
										</div>
										<div class="col-md-12">
											<select id="cmbProcesoPadreIDNivel2_procesos_seguridad" name="intProcesoPadreIDNivel2_procesos_seguridad" 
													class="form-control" tabindex="1" >
											</select>
										</div>
									</div>
								</div>
								<!--Combobox que contiene los procesos correspondientes al nivel 3-->
								<div id="divProcesoPadreNivel3_procesos_seguridad" class="no-mostrar">
									<div class="form-group">
										<div class="col-md-12">
											<label for="cmbProcesoPadreIDNivel3_procesos_seguridad">Proceso padre del menú nivel 3</label>
										</div>
										<div class="col-md-12">
											<select id="cmbProcesoPadreIDNivel3_procesos_seguridad" name="intProcesoPadreIDNivel3_procesos_seguridad" 
													class="form-control" tabindex="1" >
											</select>
										</div>
									</div>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Proceso-->
						<!--Tab - Subprocesos-->
						<div id="subprocesos_procesos_seguridad" class="tab-pane fade">
							<div class="form-group row">
								<!--Tabla con el listado de subprocesos-->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<!-- Diseño de la tabla-->
									<table class="table-hover movil" id="dg_subprocesos_procesos_seguridad">
										<thead class="movil">
											<tr class="movil">
												<th class="movil">Función</th>
												<th class="movil">Acción</th>
											</tr>
										</thead>
										<tbody class="movil"></tbody>
										<script id="plantilla_subprocesos_procesos_seguridad" type="text/template"> 
											{{#rows}}
												<tr class="movil">
													<td class="movil b1">{{funcion}}</td>
													<td class="movil b2">
														{{#subProcesoID}}
															<!--Quitar subproceso-->
															<button type="button" class="btn btn-danger btn-xs"  title="Quitar"
																	onclick="set_subproceso_procesos_seguridad({{subProcesoID}}, '{{funcion}}');">
																<span class="glyphicon glyphicon-minus"></span>
															</button>
														{{/subProcesoID}}
														{{^subProcesoID}}
															<!--Agregar subproceso-->
															<button type="button" class="btn btn-success btn-xs" title="Agregar"
																	onclick="set_subproceso_procesos_seguridad(null, '{{funcion}}');">
																<span class="glyphicon glyphicon-plus"></span>
															</button>
														{{/subProcesoID}}
													</td>
												</tr>
											{{/rows}}
											{{^rows}}
												<tr class="movil"> 
													<td class="movil" colspan="2">No se encontraron resultados.</td>
												</tr> 
											{{/rows}}
										</script>
									</table>
								</div>
							</div>
						</div><!--Cierre del contenido del tab - Subprocesos-->
					</div><!--Cierre del contenedor de tabs-->
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_procesos_seguridad"  
									onclick="validar_procesos_seguridad();"  title="Guardar" tabindex="2" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_procesos_seguridad"  
									onclick="cambiar_estatus_procesos_seguridad('','ACTIVO');"  title="Desactivar" tabindex="3" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_procesos_seguridad"  
									onclick="cambiar_estatus_procesos_seguridad('','INACTIVO');"  title="Restaurar" tabindex="4" disabled>
								<span class="fa fa-exchange"></span>
							</button>
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_procesos_seguridad"
									type="reset" aria-hidden="true" onclick="cerrar_procesos_seguridad();" title="Cerrar"  tabindex="5">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#ProcesosSeguridadContent -->

	<!--Plantilla para cargar el combobox Nivel1-->  
	<script id="plantilla_procesos_nivel1_procesos_seguridad" type="text/template"> 
		{{#procesos}}
			<option value="{{value}}">{{nombre}}</option>
		{{/procesos}} 
	</script>
	<!--Plantilla para cargar el combobox Nivel2-->  
	<script id="plantilla_procesos_nivel2_procesos_seguridad" type="text/template"> 
		{{#procesos}}
			<option value="{{value}}">{{nombre}}</option>
		{{/procesos}} 
	</script>
	<!--Plantilla para cargar el combobox Nivel3-->  
	<script id="plantilla_procesos_nivel3_procesos_seguridad" type="text/template"> 
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
		var intPaginaProcesosSeguridad = 0;
		var strUltimaBusquedaProcesosSeguridad = "";
		//Variable que se utiliza para asignar objeto del modal
		var objProcesosSeguridad = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_procesos_seguridad()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('seguridad/procesos/get_permisos_acceso',
			{
				strPermisosAcceso: $('#txtAcciones_procesos_seguridad').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosProcesosSeguridad = data.row;
					//Separar la cadena 
					var arrPermisosProcesosSeguridad = strPermisosProcesosSeguridad.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosProcesosSeguridad.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosProcesosSeguridad[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_procesos_seguridad').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosProcesosSeguridad[i]=='GUARDAR') || (arrPermisosProcesosSeguridad[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_procesos_seguridad').removeAttr('disabled');
						}
						else if(arrPermisosProcesosSeguridad[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_procesos_seguridad').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_procesos_seguridad();
						}
						else if(arrPermisosProcesosSeguridad[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_procesos_seguridad').removeAttr('disabled');
							$('#btnRestaurar_procesos_seguridad').removeAttr('disabled');
						}
						else if(arrPermisosProcesosSeguridad[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_procesos_seguridad').removeAttr('disabled');
						}
						else if(arrPermisosProcesosSeguridad[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_procesos_seguridad').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_procesos_seguridad() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_procesos_seguridad').val() != strUltimaBusquedaProcesosSeguridad)
			{
				intPaginaProcesosSeguridad = 0;
				strUltimaBusquedaProcesosSeguridad = $('#txtBusqueda_procesos_seguridad').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('seguridad/procesos/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_procesos_seguridad').val(),
						intPagina:intPaginaProcesosSeguridad,
						strPermisosAcceso: $('#txtAcciones_procesos_seguridad').val()
					},
					function(data){
						$('#dg_procesos_seguridad tbody').empty();
						var tmpProcesosSeguridad = Mustache.render($('#plantilla_procesos_seguridad').html(), data);
						$('#dg_procesos_seguridad tbody').html(tmpProcesosSeguridad);
						$('#pagLinks_procesos_seguridad').html(data.paginacion);
						$('#numElementos_procesos_seguridad').html(data.total_rows);
						intPaginaProcesosSeguridad = data.pagina;
					},
			'json');
		}

		//Función para cargar/descargar el reporte general en PDF/XLS
		function reporte_procesos_seguridad(strTipo)
		{
			//Variable que se utiliza para asignar URL (ruta del controlador)
			var strUrl = 'seguridad/procesos/';

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
										'strBusqueda': $('#txtBusqueda_procesos_seguridad').val()			
									 }
						   };


			//Hacer un llamado a la función para imprimir/descargar el reporte
			$.imprimirReporte(objReporte);
		}


		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_procesos_seguridad()
		{
			//Incializar formulario
			$('#frmProcesosSeguridad')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_procesos_seguridad();
			//Limpiar cajas de texto ocultas
			$('#frmProcesosSeguridad').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para quitar clases del encabezado (div) y poder tomar la clase (color) que le corresponde al estatus del registro
			$.removerClasesEncabezado('divEncabezadoModal_procesos_seguridad');
			//Eliminar los datos de la tabla subprocesos
		    $('#dg_subprocesos_procesos_seguridad tbody').empty();
			//Agregar clase no-mostrar para mostrar combobox con los procesos padres del nivel 1
			$('#divProcesoPadreNivel1_procesos_seguridad').addClass("no-mostrar");
			//Agregar clase no-mostrar para ocultar combobox con los procesos padres del nivel 2
			$('#divProcesoPadreNivel2_procesos_seguridad').addClass("no-mostrar");
			//Agregar clase no-mostrar para ocultar combobox con los procesos padres del nivel 3
			$('#divProcesoPadreNivel3_procesos_seguridad').addClass("no-mostrar");
			//Agregar clase disabled disabledTab para deshabilitar tab de subprocesos
			$('#tabSubprocesos_procesos_seguridad').addClass("disabled disabledTab");
			//Habilitar todos los elementos del formulario
			$('#frmProcesosSeguridad').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_procesos_seguridad").show();
			//Ocultar los siguientes botones
			$("#btnDesactivar_procesos_seguridad").hide();
			$("#btnRestaurar_procesos_seguridad").hide();
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_procesos_seguridad()
		{
			try {
				//Cerrar modal
				objProcesosSeguridad.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_procesos_seguridad').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_procesos_seguridad()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_procesos_seguridad();
			//Validación del formulario de campos obligatorios
			$('#frmProcesosSeguridad')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {  
										strDescripcion_procesos_seguridad: {
											validators: {
												notEmpty: {message: 'Escriba una descripción'}
											}
										},
										intOrden_procesos_seguridad: {
											validators: {
												notEmpty: {message: 'Ingrese el orden de este elemento'}
											}
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_procesos_seguridad = $('#frmProcesosSeguridad').data('bootstrapValidator');
			bootstrapValidator_procesos_seguridad.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_procesos_seguridad.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_procesos_seguridad();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_procesos_seguridad()
		{
			try
			{
				$('#frmProcesosSeguridad').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para registrar (o actualizar) los datos de un registro
		function guardar_procesos_seguridad()
		{
			//Variable que obtiene el ID del proceso padre seleccionado
			//Se inicializa en 0 para los procesos que no tienen padre
			var intProcesoPadreID_procesos_seguridad = 0;

			if ($('#cmbMenuNivel_procesos_seguridad').val() == 'NIVEL 2')
			{
				intProcesoPadreID_procesos_seguridad = $('#cmbProcesoPadreIDNivel1_procesos_seguridad').val();
			}
			else if ($('#cmbMenuNivel_procesos_seguridad').val() == 'NIVEL 3')
			{
				intProcesoPadreID_procesos_seguridad = $('#cmbProcesoPadreIDNivel2_procesos_seguridad').val();
			}
			else if ($('#cmbMenuNivel_procesos_seguridad').val() == 'NIVEL 4')
			{
				intProcesoPadreID_procesos_seguridad = $('#cmbProcesoPadreIDNivel3_procesos_seguridad').val();
			}
			//Si no se ha seleccionado un proceso padre
			if (intProcesoPadreID_procesos_seguridad === null)
			{
				mensaje_procesos_seguridad('error', 'Seleccione un proceso padre.');
			}
			else
			{
				//Hacer un llamado al método del controlador para guardar los datos del registro
				$.post('seguridad/procesos/guardar',
						{
							intProcesoID: $('#txtProcesoID_procesos_seguridad').val(),
							intProcesoPadreID:  intProcesoPadreID_procesos_seguridad,
							strMenuNivel: $('#cmbMenuNivel_procesos_seguridad').val(),
							strDescripcion: $('#txtDescripcion_procesos_seguridad').val(),
							intOrden: $('#txtOrden_procesos_seguridad').val(),
							strRutaAcceso:$('#txtRutaAcceso_procesos_seguridad').val(),
							strTipoVentana:$('#cmbTipoVentana_procesos_seguridad').val()
						},
						function(data) {
							if (data.resultado)
							{
								//Hacer llamado a la función  para cargar los registros en el grid
								paginacion_procesos_seguridad();
								//Si no existe id del proceso, significa que es un nuevo registro
								if($('#txtProcesoID_procesos_seguridad').val() == '')
								{
									//Hacer un llamado a la función para recuperar los datos del proceso registrado en la base de datos
									editar_procesos_seguridad(data.proceso_id, 'Nuevo');
									//Seleccionar tab que contiene la información de los subprocesos
									$('a[href="#subprocesos_procesos_seguridad"]').click();
								}
								else
								{
									//Hacer un llamado a la función para cerrar modal
									cerrar_procesos_seguridad();
								}
							}
							//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_procesos_seguridad(data.tipo_mensaje, data.mensaje);
						},
				'json');
			}
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_procesos_seguridad(tipoMensaje, mensaje)
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
		function cambiar_estatus_procesos_seguridad(id, estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Variable que se utiliza para saber si el id se obtuvo desde el modal
			var strTipo = 'modal';
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtProcesoID_procesos_seguridad').val();

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
						             {'type': 'question',
						              'title': 'Procesos',
						              'buttons': ['Aceptar', 'Cancelar'],
						              'onClose': function(caption) {
						                            if(caption == 'Aceptar')
						                            {

						                            	//Hacer un llamado a la función para modificar el estatus del registro
														set_estatus_procesos_seguridad(intID, strTipo, 'INACTIVO');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {

		    	//Hacer un llamado a la función para modificar el estatus del registro
				set_estatus_procesos_seguridad(intID, strTipo, 'ACTIVO');
		    }
		}

		//Función que se utiliza para cambiar administrativamente el estatus de un registro
		function set_estatus_procesos_seguridad(id, tipo, estatus)
		{
			//Hacer un llamado al método del controlador para cambiar el estatus del registro
			$.post('seguridad/procesos/set_estatus',
			      {intProcesoID: id,
			       strEstatus: estatus
			      },
			     function(data) {
			      	if (data.resultado)
			      	{
			        	//Hacer llamado a la función para cargar  los registros en el grid
			      		paginacion_procesos_seguridad();

			      		//Si el id del registro se obtuvo del modal
						if(tipo == 'modal')
						{
							//Hacer un llamado a la función para cerrar modal
							cerrar_procesos_seguridad();     
						}
			     	 }
			      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
			        mensaje_procesos_seguridad(data.tipo_mensaje, data.mensaje);
			     },
			     'json');

		}

		//Función para regresar los datos al modal del registro seleccionado
		function editar_procesos_seguridad(id, tipoAccion)
		{
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('seguridad/procesos/get_datos', 
					{
					  intProcesoID:id
					},
			        function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_procesos_seguridad();
							//Asignar estatus del registro
				            var strEstatus = data.row.estatus;
				            
							//Recuperar valores
							$('#txtProcesoID_procesos_seguridad').val(id);
							$('#txtDescripcion_procesos_seguridad').val(data.row.descripcion);
							$('#txtRutaAcceso_procesos_seguridad').val(data.row.ruta_acceso);
							$('#cmbTipoVentana_procesos_seguridad').val(data.row.tipo_ventana);
							$('#cmbMenuNivel_procesos_seguridad').val(data.row.menu_nivel);
							$('#txtOrden_procesos_seguridad').val(data.row.orden);
							if (data.row.proceso_padre_nivel3 !== null)
							{
								habilitar_combos(data.row.proceso_padre_nivel3, data.row.proceso_padre_nivel2, data.row.proceso_padre_nivel1);
							}
							else if (data.row.proceso_padre_nivel2 !== null)
							{
								habilitar_combos(data.row.proceso_padre_nivel2, data.row.proceso_padre_nivel1);
							}
							else if (data.row.proceso_padre_nivel1 !== null)
							{
								habilitar_combos(data.row.proceso_padre_nivel1);
							}

							//Quitar clase disabled disabledTab para habilitar tab de subprocesos
							$('#tabSubprocesos_procesos_seguridad').removeClass("disabled disabledTab");
							//Hacer un llamado a la función para cargar los subprocesos del proceso 
							get_subprocesos_procesos_seguridad();
				            //Dependiendo del estatus cambiar el color del encabezado
				            $('#divEncabezadoModal_procesos_seguridad').addClass("estatus-" + strEstatus);
				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_procesos_seguridad").show();
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
				            	$('#frmProcesosSeguridad').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					           	$("#btnGuardar_procesos_seguridad").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_procesos_seguridad").show();
							}

							//Si el tipo de acción es diferente de Nuevo
				            if(tipoAccion != 'Nuevo')
				            {
				            	//Seleccionar tab que contiene la información del proceso
								$('a[href="#proceso_procesos_seguridad"]').click();
				            	//Abrir modal
								objProcesosSeguridad = $('#ProcesosSeguridadBox').bPopup({appendTo: '#ProcesosSeguridadContent', 
																						  contentContainer: 'ProcesosSeguridadM', 
																						  zIndex: 2, 
																						  modalClose: false, 
																						  modal: true, 
																						  follow: [true,false], 
																						  followEasing : "linear", 
																						  easing: "linear", 
																						  modalColor: ('#F0F0F0')});
								//Enfocar caja de texto
								$('#txtDescripcion_procesos_seguridad').focus();
				            }
			       	    }
			       },
			       'json');
		}

		//Habilitar los combos según el nivel del menú
		function habilitar_combos(intPP1 = 0, intPP2 = 0, intPP3 = 0)
		{
			//Quitar clase que muestra los combos
			$('#divProcesoPadreNivel1_procesos_seguridad').removeClass('col-sm-4 col-md-4 col-lg-4 col-xs-12');
			$('#divProcesoPadreNivel2_procesos_seguridad').removeClass('col-sm-4 col-md-4 col-lg-4 col-xs-12');
			$('#divProcesoPadreNivel3_procesos_seguridad').removeClass('col-sm-4 col-md-4 col-lg-4 col-xs-12');
			//Agregar clase para ocultar los combos
			$('#divProcesoPadreNivel1_procesos_seguridad').addClass('no-mostrar');
			$('#divProcesoPadreNivel2_procesos_seguridad').addClass('no-mostrar');
			$('#divProcesoPadreNivel3_procesos_seguridad').addClass('no-mostrar');

			//Validar el nivel del menú seleccionado
			if($('#cmbMenuNivel_procesos_seguridad').val() == 'NIVEL 2')
			{
				//Agregar clase que muestra los combos
				$('#divProcesoPadreNivel1_procesos_seguridad').addClass('col-sm-4 col-md-4 col-lg-4 col-xs-12');
				//Quitar para ocultar los combos
				$('#divProcesoPadreNivel1_procesos_seguridad').removeClass("no-mostrar");

			}
			else if($('#cmbMenuNivel_procesos_seguridad').val() == 'NIVEL 3')
			{
				//Agregar clase que muestra los combos
				$('#divProcesoPadreNivel1_procesos_seguridad').addClass('col-sm-4 col-md-4 col-lg-4 col-xs-12');
				$('#divProcesoPadreNivel2_procesos_seguridad').addClass('col-sm-4 col-md-4 col-lg-4 col-xs-12');
				//Quitar para ocultar los combos
				$('#divProcesoPadreNivel1_procesos_seguridad').removeClass("no-mostrar");
				$('#divProcesoPadreNivel2_procesos_seguridad').removeClass("no-mostrar");
			}
			else if($('#cmbMenuNivel_procesos_seguridad').val() == 'NIVEL 4')
			{
				//Agregar clase que muestra los combos
				$('#divProcesoPadreNivel1_procesos_seguridad').addClass('col-sm-4 col-md-4 col-lg-4 col-xs-12');
				$('#divProcesoPadreNivel2_procesos_seguridad').addClass('col-sm-4 col-md-4 col-lg-4 col-xs-12');
				$('#divProcesoPadreNivel3_procesos_seguridad').addClass('col-sm-4 col-md-4 col-lg-4 col-xs-12');
				//Quitar para ocultar los combos
				$('#divProcesoPadreNivel1_procesos_seguridad').removeClass("no-mostrar");
				$('#divProcesoPadreNivel2_procesos_seguridad').removeClass("no-mostrar");
				$('#divProcesoPadreNivel3_procesos_seguridad').removeClass("no-mostrar");
			}
			cargar_combos_procesos_seguridad('NIVEL 1', intPP1, intPP2, intPP3);
		}

		//Cargar datos en el combobox enviado como parámetro
		function cargar_combos_procesos_seguridad(strCombo, intPP1 = 0, intPP2 = 0, intPP3 = 0)
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
					intProcesoPadreID = $('#cmbProcesoPadreIDNivel1_procesos_seguridad').val();
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
					intProcesoPadreID = $('#cmbProcesoPadreIDNivel2_procesos_seguridad').val();
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
							$('#cmbProcesoPadreIDNivel1_procesos_seguridad').empty();
							var temp = Mustache.render($('#plantilla_procesos_nivel1_procesos_seguridad').html(), data);
							$('#cmbProcesoPadreIDNivel1_procesos_seguridad').html(temp);
							if (intPP1 != 0)
							{
								$('#cmbProcesoPadreIDNivel1_procesos_seguridad').val(intPP1);
							}
							cargar_combos_procesos_seguridad('NIVEL 2', intPP1, intPP2, intPP3);
						}
						else if (strCombo == 'NIVEL 2')
						{
							$('#cmbProcesoPadreIDNivel2_procesos_seguridad').empty();
							var temp = Mustache.render($('#plantilla_procesos_nivel2_procesos_seguridad').html(), data);
							$('#cmbProcesoPadreIDNivel2_procesos_seguridad').html(temp);
							if (intPP2 != 0)
							{
								$('#cmbProcesoPadreIDNivel2_procesos_seguridad').val(intPP2);
							}
							cargar_combos_procesos_seguridad('NIVEL 3', intPP1, intPP2, intPP3);
						}
						else if (strCombo == 'NIVEL 3')
						{
							$('#cmbProcesoPadreIDNivel3_procesos_seguridad').empty();
							var temp = Mustache.render($('#plantilla_procesos_nivel3_procesos_seguridad').html(), data);
							$('#cmbProcesoPadreIDNivel3_procesos_seguridad').html(temp);
							if (intPP3 != 0)
							{
								$('#cmbProcesoPadreIDNivel3_procesos_seguridad').val(intPP3);
							}
						}
				   }, 
				   'json');
		}

		/*******************************************************************************************************************
		Funciones del Tab - Subprocesos
		*********************************************************************************************************************/
		//Función que se utiliza para buscar subprocesos del proceso seleccionado
		function get_subprocesos_procesos_seguridad()
		{
			//Hacer un llamado al método del controlador para regresar los subprocesos del proceso
			$.post('seguridad/procesos/get_subprocesos',
				{
					intProcesoID: $('#txtProcesoID_procesos_seguridad').val()
				},
				function(data)
				{
					$('#dg_subprocesos_procesos_seguridad tbody').empty();
					var temp = Mustache.render($('#plantilla_subprocesos_procesos_seguridad').html(), data);
					$('#dg_subprocesos_procesos_seguridad tbody').html(temp);
				},
				'json');
		}

		//Función que se utiliza para agregar/eliminar subprocesos del proceso seleccionado
		function set_subproceso_procesos_seguridad(intSubprocesoID, strFuncion)
		{
			//Hacer un llamado al método del controlador
			$.post('seguridad/procesos/set_subproceso',
				{
					intProcesoID: $('#txtProcesoID_procesos_seguridad').val(), 
					intSubProcesoID: intSubprocesoID, 
					strFuncion: strFuncion
				},
				function(data)
				{
					//Hacer un llamado a la función para cargar los subprocesos del proceso 
					get_subprocesos_procesos_seguridad();
					//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
					mensaje_procesos_seguridad(data.tipo_mensaje, data.mensaje);
				},
				'json');
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Validar campos númericos (solamente valores enteros y positivos)
        	$('#txtOrden_procesos_seguridad').numeric({decimal: false, negative: false});
			//Mostrar combobox con los procesos correspondientes al nivel seleccionado
			$('#cmbMenuNivel_procesos_seguridad').change(function(e){
				//Hacer un llamado a la función para mostrar combobox con los procesos padres del nivel seleccionado
				habilitar_combos();
			});
			//Cargar procesos del nivel 2 cuando se modifique la selección del combo
			$('#cmbProcesoPadreIDNivel1_procesos_seguridad').change(function(e){
				cargar_combos_procesos_seguridad('NIVEL 2', $('#cmbProcesoPadreIDNivel1_procesos_seguridad').val());
			});
			//Cargar procesos del nivel 3 cuando se modifique la selección del combo
			$('#cmbProcesoPadreIDNivel2_procesos_seguridad').change(function(e){
				cargar_combos_procesos_seguridad('NIVEL 3', 0, $('#cmbProcesoPadreIDNivel2_procesos_seguridad').val());
			});

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_procesos_seguridad').on('click','a',function(event){
				event.preventDefault();
				intPaginaProcesosSeguridad = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_procesos_seguridad();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_procesos_seguridad').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_procesos_seguridad();
				//Seleccionar tab que contiene la información del proceso
			    $('a[href="#proceso_procesos_seguridad"]').click();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_procesos_seguridad').addClass("estatus-NUEVO");
				//Abrir modal
				objProcesosSeguridad= $('#ProcesosSeguridadBox').bPopup({appendTo: '#ProcesosSeguridadContent', 
																		 contentContainer: 'ProcesosSeguridadM', 
																		 zIndex: 2, 
																		 modalClose: false, 
																		 modal: true, 
																		 follow: [true,false], 
																		 followEasing : "linear", 
																		 easing: "linear", 
																		 modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_procesos_seguridad').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_procesos_seguridad').focus();

			    
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_procesos_seguridad();
		});
	</script>