	<div id="CampanasPublicitariasMercadotecniaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_campanas_publicitarias_mercadotecnia" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_campanas_publicitarias_mercadotecnia" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_campanas_publicitarias_mercadotecnia">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_campanas_publicitarias_mercadotecnia'>
				                    <input class="form-control" id="txtFechaInicialBusq_campanas_publicitarias_mercadotecnia"
				                    		name= "strFechaInicialBusq_campanas_publicitarias_mercadotecnia" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Fecha final-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaFinalBusq_campanas_publicitarias_mercadotecnia">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_campanas_publicitarias_mercadotecnia'>
				                    <input class="form-control" id="txtFechaFinalBusq_campanas_publicitarias_mercadotecnia"
				                    		name= "strFechaFinalBusq_campanas_publicitarias_mercadotecnia" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los módulos activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
								<input id="txtModuloIDBusq_campanas_publicitarias_mercadotecnia" 
									   name="intModuloIDBusq_campanas_publicitarias_mercadotecnia"  type="hidden" 
									   value="">
								</input>
								<label for="txtModuloBusq_campanas_publicitarias_mercadotecnia">Módulo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtModuloBusq_campanas_publicitarias_mercadotecnia" 
										name="strModuloBusq_campanas_publicitarias_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese módulo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene las zonas activas-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la zona seleccionada-->
								<input id="txtZonaIDBusq_campanas_publicitarias_mercadotecnia" 
									   name="intZonaIDBusq_campanas_publicitarias_mercadotecnia"  type="hidden" 
									   value="">
								</input>
								<label for="txtZonaBusq_campanas_publicitarias_mercadotecnia">Zona</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtZonaBusq_campanas_publicitarias_mercadotecnia" 
										name="strZonaBusq_campanas_publicitarias_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese zona" maxlength="250">
								</input>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<!--Autocomplete que contiene las localidades activas-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la localidad seleccionada-->
								<input id="txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia" 
									   name="intLocalidadIDBusq_campanas_publicitarias_mercadotecnia"  type="hidden" 
									   value="">
								</input>
								<label for="txtLocalidadBusq_campanas_publicitarias_mercadotecnia">Localidad</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtLocalidadBusq_campanas_publicitarias_mercadotecnia" 
										name="strLocalidadBusq_campanas_publicitarias_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese localidad" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los municipios activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del municipio seleccionado-->
								<input id="txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia" 
									   name="intMunicipioIDBusq_campanas_publicitarias_mercadotecnia"  type="hidden" 
									   value="">
								</input>
								<label for="txtMunicipioBusq_campanas_publicitarias_mercadotecnia">Municipio</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtMunicipioBusq_campanas_publicitarias_mercadotecnia" 
										name="strMunicipioBusq_campanas_publicitarias_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese municipio" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los estados activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del estado seleccionado-->
								<input id="txtEstadoIDBusq_campanas_publicitarias_mercadotecnia" 
									   name="intEstadoIDBusq_campanas_publicitarias_mercadotecnia"  type="hidden" 
									   value="">
								</input>
								<label for="txtEstadoBusq_campanas_publicitarias_mercadotecnia">Estado</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtEstadoBusq_campanas_publicitarias_mercadotecnia" 
										name="strEstadoBusq_campanas_publicitarias_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese estado" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_campanas_publicitarias_mercadotecnia"
									onclick="paginacion_campanas_publicitarias_mercadotecnia();" 
									title="Buscar coincidencias" tabindex="1"> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_campanas_publicitarias_mercadotecnia" 
									title="Nuevo registro" tabindex="1"> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_campanas_publicitarias_mercadotecnia"
									onclick="reporte_campanas_publicitarias_mercadotecnia();" 
									title="Imprimir reporte general en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_campanas_publicitarias_mercadotecnia"
									onclick="descargar_xls_campanas_publicitarias_mercadotecnia();" title="Descargar reporte general en XLS" tabindex="1">
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
				td.movil:nth-of-type(1):before {content: "Fecha"; font-weight: bold;}
				td.movil:nth-of-type(2):before {content: "Tipo"; font-weight: bold;}
				td.movil:nth-of-type(3):before {content: "Módulo"; font-weight: bold;}
				td.movil:nth-of-type(4):before {content: "Alcance"; font-weight: bold;}
				td.movil:nth-of-type(5):before {content: "Enviado a"; font-weight: bold;}
				td.movil:nth-of-type(6):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_campanas_publicitarias_mercadotecnia">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Fecha</th>
							<th class="movil">Tipo</th>
							<th class="movil">Módulo</th>
							<th class="movil">Alcance</th>
							<th class="movil">Enviado a</th>
							<th class="movil" id="th-acciones" style="width:8em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_campanas_publicitarias_mercadotecnia" type="text/template"> 
					{{#rows}}
						<tr class="movil">   
							<td class="movil">{{fecha}}</td>
							<td class="movil">{{tipo}}</td>
							<td class="movil">{{modulo}}</td>
							<td class="movil">{{alcance}}</td>
							<td class="movil">{{referencia}}</td>
							<td class="td-center movil"> 
								<!--Ver registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
										onclick="ver_campanas_publicitarias_mercadotecnia({{campana_publicitaria_id}})"  title="Ver">
									<span class="glyphicon glyphicon-eye-open"></span>
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_campanas_publicitarias_mercadotecnia"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_campanas_publicitarias_mercadotecnia">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="CampanasPublicitariasMercadotecniaBox" class="ModalBody">
			<!--Título-->
			<div id="divEncabezadoModal_campanas_publicitarias_mercadotecnia"  class="ModalBodyTitle">
			<h1>Envío de Campañas Publicitarias</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmCampanasPublicitariasMercadotecnia" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmCampanasPublicitariasMercadotecnia"  onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Tipo-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el nombre del archivo temporal-->
									<input id="txtArchivo_campanas_publicitarias_mercadotecnia" 
										   name="strArchivo_campanas_publicitarias_mercadotecnia" 
										   type="hidden" value="">
									</input>
									<label for="cmbTipo_campanas_publicitarias_mercadotecnia">Tipo</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" id="cmbTipo_campanas_publicitarias_mercadotecnia" 
									 		name="strTipo_campanas_publicitarias_mercadotecnia" tabindex="1">
                          				<option value="CLIENTES">CLIENTES</option>
                          				<option value="PROSPECTOS">PROSPECTOS</option>
                     				</select>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los módulos activos-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
									<input id="txtModuloID_campanas_publicitarias_mercadotecnia" 
										   name="intModuloID_campanas_publicitarias_mercadotecnia"  type="hidden" value="">
									</input>
									<label for="txtModulo_campanas_publicitarias_mercadotecnia">Módulo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtModulo_campanas_publicitarias_mercadotecnia" 
											name="strModulo_campanas_publicitarias_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese módulo" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las zonas activas-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la zona seleccionada-->
									<input id="txtZonaID_campanas_publicitarias_mercadotecnia" 
									       name="intZonaID_campanas_publicitarias_mercadotecnia" type="hidden" value="">
									</input>
									<label for="txtZona_campanas_publicitarias_mercadotecnia">Zona</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtZona_campanas_publicitarias_mercadotecnia" 
											name="strZona_campanas_publicitarias_mercadotecnia" type="text" value="" 
											tabindex="1" placeholder="Ingrese zona" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Autocomplete que contiene las localidades activas-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la localidad seleccionada-->
									<input id="txtLocalidadID_campanas_publicitarias_mercadotecnia" 
									       name="intLocalidadID_campanas_publicitarias_mercadotecnia" type="hidden" value="">
									</input>
									<label for="txtLocalidad_campanas_publicitarias_mercadotecnia">Localidad</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtLocalidad_campanas_publicitarias_mercadotecnia" 
											name="strLocalidad_campanas_publicitarias_mercadotecnia" type="text" value="" 
											tabindex="1" placeholder="Ingrese localidad" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los municipios activos-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del municipio seleccionado-->
									<input id="txtMunicipioID_campanas_publicitarias_mercadotecnia" 
									       name="intMunicipioID_campanas_publicitarias_mercadotecnia" type="hidden" value="">
									</input>
									<label for="txtMunicipio_campanas_publicitarias_mercadotecnia">Municipio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtMunicipio_campanas_publicitarias_mercadotecnia" 
											name="strMunicipio_campanas_publicitarias_mercadotecnia" type="text" value="" 
											tabindex="1" placeholder="Ingrese municipio" maxlength="250">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los estados activos-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del estado seleccionado-->
									<input id="txtEstadoID_campanas_publicitarias_mercadotecnia" 
									       name="intEstadoID_campanas_publicitarias_mercadotecnia" type="hidden" value="">
									</input>
									<label for="txtEstado_campanas_publicitarias_mercadotecnia">Estado</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtEstado_campanas_publicitarias_mercadotecnia" 
											name="strEstado_campanas_publicitarias_mercadotecnia" type="text" value="" 
											tabindex="1" placeholder="Ingrese estado" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!--Título del mensaje-->
						<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTitulo_campanas_publicitarias_mercadotecnia">Título</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTitulo_campanas_publicitarias_mercadotecnia" 
											name="strTitulo_campanas_publicitarias_mercadotecnia" type="text" value="" 
											tabindex="1" placeholder="Ingrese título" maxlength="50">
									</input>
								</div>
							</div>
						</div>
						<!--Alcance-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtAlcance_campanas_publicitarias_mercadotecnia">Alcance</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtAlcance_campanas_publicitarias_mercadotecnia" 
											name="intAlcance_campanas_publicitarias_mercadotecnia" 
											type="text" value="" disabled>
									</input>
								</div>
							</div>
						</div>

					</div>
					<div class="row">
				    	<!--Comentarios-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtComentarios_campanas_publicitarias_mercadotecnia">Comentarios</label>
								</div>
								<div class="col-md-12">
									<textarea  class="form-control" id="txtComentarios_campanas_publicitarias_mercadotecnia" 
											   name="strComentario_campanas_publicitarias_mercadotecnia" rows="3" value="" tabindex="1" placeholder="Ingrese comentarios" maxlength="250"></textarea>
								</div>
							</div>
						</div>
				    </div>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Subir archivo-->
		                    <span  class="fileupload-buttonbar" tabindex="2">
		                    	<span class="btn  btn-default fileinput-button"  id="btnAdjuntar_campanas_publicitarias_mercadotecnia">
		                        	<span class="fa fa-upload"></span>
		                        	<input id="archivo_campanas_publicitarias_mercadotecnia" 
		                        		   name="archivo_campanas_publicitarias_mercadotecnia" type="file"  
		                        		   onchange="subir_archivo_campanas_publicitarias_mercadotecnia();">
		                        	</input>
		                        </span>
		                    </span>
							<!--Enviar correo electrónico-->
							<button class="btn btn-success" id="btnEnviarCorreo_campanas_publicitarias_mercadotecnia"  
									onclick="validar_campanas_publicitarias_mercadotecnia();"  
									title="Enviar correo electrónico" tabindex="3">
								<span class="glyphicon glyphicon-envelope"></span>
							</button> 
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_campanas_publicitarias_mercadotecnia"
									type="reset" aria-hidden="true" onclick="cerrar_campanas_publicitarias_mercadotecnia();" 
									title="Cerrar"  tabindex="4">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->
	</div><!--#CampanasPublicitariasMercadotecniaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaCampanasPublicitariasMercadotecnia = 0;
		var strUltimaBusquedaCampanasPublicitariasMercadotecnia = "";
		//Variables que se utilizan para la búsqueda de registros
		var intModuloIDCampanasPublicitariasMercadotecnia = "";
		var intZonaIDCampanasPublicitariasMercadotecnia = "";
		var intLocalidadIDCampanasPublicitariasMercadotecnia = "";
		var intMunicipioIDCampanasPublicitariasMercadotecnia = "";
		var intEstadoIDCampanasPublicitariasMercadotecnia = "";
		var dteFechaInicialCampanasPublicitariasMercadotecnia = "";
		var dteFechaFinalCampanasPublicitariasMercadotecnia = "";
		//Variable que se utiliza para asignar objeto del modal
		var objCampanasPublicitariasMercadotecnia = null;

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_campanas_publicitarias_mercadotecnia()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('mercadotecnia/campanas_publicitarias/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_campanas_publicitarias_mercadotecnia').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosCampanasPublicitariasMercadotecnia = data.row;
					//Separar la cadena 
					var arrPermisosCampanasPublicitariasMercadotecnia = strPermisosCampanasPublicitariasMercadotecnia.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosCampanasPublicitariasMercadotecnia.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosCampanasPublicitariasMercadotecnia[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_campanas_publicitarias_mercadotecnia').removeAttr('disabled');
						}
						//Si el indice es ADJUNTAR
						else if(arrPermisosCampanasPublicitariasMercadotecnia[i]=='ADJUNTAR')
						{
							//Habilitar el control (botón Adjuntar)
							$('#btnAdjuntar_campanas_publicitarias_mercadotecnia').removeAttr('disabled');
						}
						//Si el indice es ENVIAR CORREO
						else if(arrPermisosCampanasPublicitariasMercadotecnia[i]=='ENVIAR CORREO')
						{
							//Habilitar el control (botón enviar correo)
							$('#btnEnviarCorreo_campanas_publicitarias_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosCampanasPublicitariasMercadotecnia[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_campanas_publicitarias_mercadotecnia').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_campanas_publicitarias_mercadotecnia();
						}
						else if(arrPermisosCampanasPublicitariasMercadotecnia[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_campanas_publicitarias_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosCampanasPublicitariasMercadotecnia[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_campanas_publicitarias_mercadotecnia').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_campanas_publicitarias_mercadotecnia() 
		{
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaCampanasPublicitariasMercadotecnia =($('#txtFechaInicialBusq_campanas_publicitarias_mercadotecnia').val()+$('#txtFechaFinalBusq_campanas_publicitarias_mercadotecnia').val()+$('#txtModuloIDBusq_campanas_publicitarias_mercadotecnia').val()+$('#txtZonaIDBusq_campanas_publicitarias_mercadotecnia').val()+$('#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia').val()+$('#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia').val()+$('#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia').val());

			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaCampanasPublicitariasMercadotecnia != strUltimaBusquedaCampanasPublicitariasMercadotecnia)
			{
				intPaginaCampanasPublicitariasMercadotecnia = 0;
				strUltimaBusquedaCampanasPublicitariasMercadotecnia = strNuevaBusquedaCampanasPublicitariasMercadotecnia;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('mercadotecnia/campanas_publicitarias/get_paginacion',
					{	//Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
						dteFechaInicial:$.formatFechaMysql($('#txtFechaInicialBusq_campanas_publicitarias_mercadotecnia').val()),
						dteFechaFinal:$.formatFechaMysql($('#txtFechaFinalBusq_campanas_publicitarias_mercadotecnia').val()),
						intModuloID:$('#txtModuloIDBusq_campanas_publicitarias_mercadotecnia').val(),
						intZonaID:$('#txtZonaIDBusq_campanas_publicitarias_mercadotecnia').val(),
						intLocalidadID:$('#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia').val(),
						intMunicipioID:$('#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia').val(),
						intEstadoID:$('#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia').val(),
						intPagina:intPaginaCampanasPublicitariasMercadotecnia,
						strPermisosAcceso: $('#txtAcciones_campanas_publicitarias_mercadotecnia').val()
					},
					function(data){
						$('#dg_campanas_publicitarias_mercadotecnia tbody').empty();
						var tmpCampanasPublicitariasMercadotecnia = Mustache.render($('#plantilla_campanas_publicitarias_mercadotecnia').html(),data);
						$('#dg_campanas_publicitarias_mercadotecnia tbody').html(tmpCampanasPublicitariasMercadotecnia);
						$('#pagLinks_campanas_publicitarias_mercadotecnia').html(data.paginacion);
						$('#numElementos_campanas_publicitarias_mercadotecnia').html(data.total_rows);
						intPaginaCampanasPublicitariasMercadotecnia = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_campanas_publicitarias_mercadotecnia() 
		{
			//Asignar valores para la búsqueda de registros
			intModuloIDCampanasPublicitariasMercadotecnia = $('#txtModuloIDBusq_campanas_publicitarias_mercadotecnia').val();
			intZonaIDCampanasPublicitariasMercadotecnia = $('#txtZonaIDBusq_campanas_publicitarias_mercadotecnia').val();
			intLocalidadIDCampanasPublicitariasMercadotecnia = $('#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia').val();
			intMunicipioIDCampanasPublicitariasMercadotecnia = $('#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia').val();
			intEstadoIDCampanasPublicitariasMercadotecnia = $('#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia').val();
			dteFechaInicialCampanasPublicitariasMercadotecnia =$.formatFechaMysql($('#txtFechaInicialBusq_campanas_publicitarias_mercadotecnia').val());
			dteFechaFinalCampanasPublicitariasMercadotecnia = $.formatFechaMysql($('#txtFechaFinalBusq_campanas_publicitarias_mercadotecnia').val());

			//Si no existe fecha inicial
			if(dteFechaInicialCampanasPublicitariasMercadotecnia == '')
			{
				dteFechaInicialCampanasPublicitariasMercadotecnia = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalCampanasPublicitariasMercadotecnia == '')
			{
				dteFechaFinalCampanasPublicitariasMercadotecnia =  '0000-00-00';
			}

			//Si no existe id del módulo
			if(intModuloIDCampanasPublicitariasMercadotecnia == '')
			{
				intModuloIDCampanasPublicitariasMercadotecnia = 0;
			}

			//Si no existe id de la zona
			if(intZonaIDCampanasPublicitariasMercadotecnia == '')
			{
				intZonaIDCampanasPublicitariasMercadotecnia = 0;
			}

			//Si no existe id de la localidad
			if(intLocalidadIDCampanasPublicitariasMercadotecnia == '')
			{
				intLocalidadIDCampanasPublicitariasMercadotecnia = 0;
			}

			//Si no existe id del municipio
			if(intMunicipioIDCampanasPublicitariasMercadotecnia == '')
			{
				intMunicipioIDCampanasPublicitariasMercadotecnia = 0;
			}

			//Si no existe id del estado
			if(intEstadoIDCampanasPublicitariasMercadotecnia == '')
			{
				intEstadoIDCampanasPublicitariasMercadotecnia = 0;
			}

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("mercadotecnia/campanas_publicitarias/get_reporte/"+dteFechaInicialCampanasPublicitariasMercadotecnia+"/"+dteFechaFinalCampanasPublicitariasMercadotecnia+"/"+intModuloIDCampanasPublicitariasMercadotecnia+"/"+intZonaIDCampanasPublicitariasMercadotecnia+"/"+intLocalidadIDCampanasPublicitariasMercadotecnia+"/"+intMunicipioIDCampanasPublicitariasMercadotecnia+"/"+intEstadoIDCampanasPublicitariasMercadotecnia);
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_campanas_publicitarias_mercadotecnia() 
		{
			//Asignar valores para la búsqueda de registros
			intModuloIDCampanasPublicitariasMercadotecnia = $('#txtModuloIDBusq_campanas_publicitarias_mercadotecnia').val();
			intZonaIDCampanasPublicitariasMercadotecnia = $('#txtZonaIDBusq_campanas_publicitarias_mercadotecnia').val();
			intLocalidadIDCampanasPublicitariasMercadotecnia = $('#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia').val();
			intMunicipioIDCampanasPublicitariasMercadotecnia = $('#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia').val();
			intEstadoIDCampanasPublicitariasMercadotecnia = $('#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia').val();
			dteFechaInicialCampanasPublicitariasMercadotecnia =$.formatFechaMysql($('#txtFechaInicialBusq_campanas_publicitarias_mercadotecnia').val());
			dteFechaFinalCampanasPublicitariasMercadotecnia = $.formatFechaMysql($('#txtFechaFinalBusq_campanas_publicitarias_mercadotecnia').val());

			//Si no existe fecha inicial
			if(dteFechaInicialCampanasPublicitariasMercadotecnia == '')
			{
				dteFechaInicialCampanasPublicitariasMercadotecnia = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalCampanasPublicitariasMercadotecnia == '')
			{
				dteFechaFinalCampanasPublicitariasMercadotecnia =  '0000-00-00';
			}

			//Si no existe id del módulo
			if(intModuloIDCampanasPublicitariasMercadotecnia == '')
			{
				intModuloIDCampanasPublicitariasMercadotecnia = 0;
			}

			//Si no existe id de la zona
			if(intZonaIDCampanasPublicitariasMercadotecnia == '')
			{
				intZonaIDCampanasPublicitariasMercadotecnia = 0;
			}

			//Si no existe id de la localidad
			if(intLocalidadIDCampanasPublicitariasMercadotecnia == '')
			{
				intLocalidadIDCampanasPublicitariasMercadotecnia = 0;
			}

			//Si no existe id del municipio
			if(intMunicipioIDCampanasPublicitariasMercadotecnia == '')
			{
				intMunicipioIDCampanasPublicitariasMercadotecnia = 0;
			}

			//Si no existe id del estado
			if(intEstadoIDCampanasPublicitariasMercadotecnia == '')
			{
				intEstadoIDCampanasPublicitariasMercadotecnia = 0;
			}
			
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("mercadotecnia/campanas_publicitarias/get_xls/"+dteFechaInicialCampanasPublicitariasMercadotecnia+"/"+dteFechaFinalCampanasPublicitariasMercadotecnia+"/"+intModuloIDCampanasPublicitariasMercadotecnia+"/"+intZonaIDCampanasPublicitariasMercadotecnia+"/"+intLocalidadIDCampanasPublicitariasMercadotecnia+"/"+intMunicipioIDCampanasPublicitariasMercadotecnia+"/"+intEstadoIDCampanasPublicitariasMercadotecnia);
		}

		/*******************************************************************************************************************
		Funciones del modal
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_campanas_publicitarias_mercadotecnia()
		{
			//Incializar formulario
			$('#frmCampanasPublicitariasMercadotecnia')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_campanas_publicitarias_mercadotecnia();
			//Limpiar cajas de texto ocultas
			$('#frmCampanasPublicitariasMercadotecnia').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_campanas_publicitarias_mercadotecnia').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_campanas_publicitarias_mercadotecnia').removeClass("estatus-ACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmCampanasPublicitariasMercadotecnia').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar caja de texto
			$("#txtAlcance_campanas_publicitarias_mercadotecnia").attr('disabled','disabled');
			//Mostrar los siguientes botones 
			$("#btnEnviarCorreo_campanas_publicitarias_mercadotecnia").show();
			$("#btnAdjuntar_campanas_publicitarias_mercadotecnia").show();
		}
		
		//Función que se utiliza para cerrar el modal
		function cerrar_campanas_publicitarias_mercadotecnia()
		{
			try {
				//Si existe archivo temporal
				if($('#txtArchivo_campanas_publicitarias_mercadotecnia').val() != '')
				{
					//Hacer un llamado al método del controlador para eliminar la carpeta temporal que contiene el archivo, debido a que se cerro el modal antes de realizar el registro
					$.post('mercadotecnia/campanas_publicitarias/eliminar_archivo',
					     {
					     	strArchivo: $('#txtArchivo_campanas_publicitarias_mercadotecnia').val()
					     },
					     function(data) {
						    //Si el tipo de mensaje es un error
							if(data.tipo_mensaje == 'error')
							{
							   	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
								mensaje_campanas_publicitarias_mercadotecnia(data.tipo_mensaje, data.mensaje);
							}
							else
							{	
								//Cerrar modal
								objCampanasPublicitariasMercadotecnia.close();
								
							}
					     },
					     'json');
				}
				else
				{
					//Cerrar modal
					objCampanasPublicitariasMercadotecnia.close();
				}
				
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_campanas_publicitarias_mercadotecnia').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_campanas_publicitarias_mercadotecnia()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_campanas_publicitarias_mercadotecnia();
			//Validación del formulario de campos obligatorios
			$('#frmCampanasPublicitariasMercadotecnia')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strTitulo_campanas_publicitarias_mercadotecnia: {
											validators: {
												notEmpty: {message: 'Escriba un título'}
											}
										},
										strComentario_campanas_publicitarias_mercadotecnia: {
											validators: {
												notEmpty: {message: 'Escriba un comentario'}
											}
										},
										strModulo_campanas_publicitarias_mercadotecnia: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                      //Verificar que exista id del módulo
					                                    if(value !== '' && $('#txtModuloID_campanas_publicitarias_mercadotecnia').val() === '')
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
										strZona_campanas_publicitarias_mercadotecnia: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la zona
					                                    if(value !== '' && $('#txtZonaID_campanas_publicitarias_mercadotecnia').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una zona existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strLocalidad_campanas_publicitarias_mercadotecnia: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la localidad
					                                    if(value !== '' && $('#txtLocalidadID_campanas_publicitarias_mercadotecnia').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una localidad existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strMunicipio_campanas_publicitarias_mercadotecnia: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del municipio
					                                    if(value !== '' && $('#txtMunicipioID_campanas_publicitarias_mercadotecnia').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un municipio existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strEstado_campanas_publicitarias_mercadotecnia: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del estado
					                                    if(value !== '' && $('#txtEstadoID_campanas_publicitarias_mercadotecnia').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un estado existente'
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
			var bootstrapValidator_campanas_publicitarias_mercadotecnia = $('#frmCampanasPublicitariasMercadotecnia').data('bootstrapValidator');
			bootstrapValidator_campanas_publicitarias_mercadotecnia.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_campanas_publicitarias_mercadotecnia.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_campanas_publicitarias_mercadotecnia();
			}
			else 
				return;
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_campanas_publicitarias_mercadotecnia()
		{
			try
			{
				$('#frmCampanasPublicitariasMercadotecnia').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para guardar o modificar los datos de un registro
		function guardar_campanas_publicitarias_mercadotecnia()
		{
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('mercadotecnia/campanas_publicitarias/guardar',
					{ 
						strTipo: $('#cmbTipo_campanas_publicitarias_mercadotecnia').val(),
						intModuloID: $('#txtModuloID_campanas_publicitarias_mercadotecnia').val(),
						intZonaID: $('#txtZonaID_campanas_publicitarias_mercadotecnia').val(),
						intLocalidadID: $('#txtLocalidadID_campanas_publicitarias_mercadotecnia').val(),
						intMunicipioID: $('#txtMunicipioID_campanas_publicitarias_mercadotecnia').val(),
						intEstadoID: $('#txtEstadoID_campanas_publicitarias_mercadotecnia').val(),
						strTitulo: $('#txtTitulo_campanas_publicitarias_mercadotecnia').val(),
						strComentarios: $('#txtComentarios_campanas_publicitarias_mercadotecnia').val(),
						strArchivo: $('#txtArchivo_campanas_publicitarias_mercadotecnia').val()
					},
					function(data) {
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_campanas_publicitarias_mercadotecnia();
							//Hacer un llamado a la función para cerrar modal
							cerrar_campanas_publicitarias_mercadotecnia();                  
						}

						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_campanas_publicitarias_mercadotecnia(data.tipo_mensaje, data.mensaje);
					},
			'json');
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_campanas_publicitarias_mercadotecnia(tipoMensaje, mensaje)
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

		//Función para regresar los datos (al formulario) del registro seleccionado
		function ver_campanas_publicitarias_mercadotecnia(id)
		{	
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('mercadotecnia/campanas_publicitarias/get_datos',
			       {intCampanaPublicitariaID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_campanas_publicitarias_mercadotecnia();
				          	//Recuperar valores
				            $('#cmbTipo_campanas_publicitarias_mercadotecnia').val(data.row.tipo);
				            $('#txtModuloID_campanas_publicitarias_mercadotecnia').val(data.row.modulo_id);
				            $('#txtModulo_campanas_publicitarias_mercadotecnia').val(data.row.modulo);
				            $('#txtZonaID_campanas_publicitarias_mercadotecnia').val(data.row.zona_id);
				            $('#txtZona_campanas_publicitarias_mercadotecnia').val(data.row.zona);
				            $('#txtLocalidadID_campanas_publicitarias_mercadotecnia').val(data.row.localidad_id);
				            $('#txtLocalidad_campanas_publicitarias_mercadotecnia').val(data.row.localidad);
				            $('#txtMunicipioID_campanas_publicitarias_mercadotecnia').val(data.row.municipio_id);
				            $('#txtMunicipio_campanas_publicitarias_mercadotecnia').val(data.row.municipio);
				            $('#txtEstadoID_campanas_publicitarias_mercadotecnia').val(data.row.estado_id);
				            $('#txtEstado_campanas_publicitarias_mercadotecnia').val(data.row.estado);
				            $('#txtTitulo_campanas_publicitarias_mercadotecnia').val(data.row.titulo);
				            $('#txtComentarios_campanas_publicitarias_mercadotecnia').val(data.row.comentarios);
				            $('#txtAlcance_campanas_publicitarias_mercadotecnia').val(data.row.alcance);
				            //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un registro activo)
				            $('#divEncabezadoModal_campanas_publicitarias_mercadotecnia').addClass("estatus-ACTIVO");
				            //Deshabilitar todos los elementos del formulario
				            $('#frmCampanasPublicitariasMercadotecnia').find('input, textarea, select').attr('disabled','disabled');
				            //Ocultar los siguientes botones
							$("#btnEnviarCorreo_campanas_publicitarias_mercadotecnia").hide();
							$("#btnAdjuntar_campanas_publicitarias_mercadotecnia").hide();
							
			            	//Abrir modal
				            objCampanasPublicitariasMercadotecnia = $('#CampanasPublicitariasMercadotecniaBox').bPopup({
														  appendTo: '#CampanasPublicitariasMercadotecniaContent', 
							                              contentContainer: 'CampanasPublicitariasMercadotecniaM', 
							                              zIndex: 2, 
							                              modalClose: false, 
							                              modal: true, 
							                              follow: [true,false], 
							                              followEasing : "linear", 
							                              easing: "linear", 
							                              modalColor: ('#F0F0F0')});

				            //Enfocar caja de texto
							$('#txtModulo_campanas_publicitarias_mercadotecnia').focus();
			       	    }
			       },
			       'json');
		}

		//Función para subir archivo (o imagen) de un registro
		function subir_archivo_campanas_publicitarias_mercadotecnia()
		{
			//Variable que se utiliza para asignar archivo
			var strBotonArchivoIDCampanasPublicitariasMercadotecnia = "archivo_campanas_publicitarias_mercadotecnia";

			//Obtenemos un array con los datos del archivo
	        var file = $("#"+strBotonArchivoIDCampanasPublicitariasMercadotecnia)[0].files[0];
	        //Variable que se utiliza para asignar la extensión del archivo seleccionado
   			var fileExtension = "";
	        //Obtenemos el nombre del archivo
	        var fileName = file.name;
	        //Obtenemos la extensión del archivo
	        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
	        //Obtenemos el tamaño del archivo
	        var fileSize = file.size;
	        //Obtenemos el tipo de archivo image/png ejemplo
	        var fileType = file.type;

	        //Comprobar extensión del archivo
	        $.post('cuentas_cobrar/clientes/comprobar_extension_archivo',
				     {strExtension: fileExtension
				     },
				     function(data) {
					    //Si el tipo de mensaje es un error
						if(data.tipo_mensaje == 'error')
						{
							//Limpia ruta del archivo cargado
			  				$('#'+strBotonArchivoIDCampanasPublicitariasMercadotecnia).val('');
						   	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							mensaje_campanas_publicitarias_mercadotecnia('error', data.mensaje);
						}
						else
						{	
							//Hacer un llamado al método del controlador para subir archivo del registro
							$('#'+strBotonArchivoIDCampanasPublicitariasMercadotecnia).upload('mercadotecnia/campanas_publicitarias/subir_archivo',
									{ 
					                  strBotonArchivoID: strBotonArchivoIDCampanasPublicitariasMercadotecnia
									},
									function(data) {
										//Limpia ruta del archivo cargado
						         	    $('#'+strBotonArchivoIDCampanasPublicitariasMercadotecnia).val('');
										//Subida finalizada.
										if (data.resultado)
										{
						         			//Asignar nombre del archivo temporal
						         			$('#txtArchivo_campanas_publicitarias_mercadotecnia').val(data.archivo);
										}

				                    	//Si el tipo de mensaje es un error
						                if(data.tipo_mensaje == 'error')
						                {
							            	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
							    			mensaje_campanas_publicitarias_mercadotecnia(data.tipo_mensaje, data.mensaje);
						                }
							                
									});
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
	        //Autocomplete para recuperar los datos de un módulo 
	        $('#txtModulo_campanas_publicitarias_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloID_campanas_publicitarias_mercadotecnia').val('');
	                //Limpiar contenido de las siguientes cajas de texto
		            $('#txtZonaID_campanas_publicitarias_mercadotecnia').val('');
		          	$('#txtZona_campanas_publicitarias_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/modulos/autocomplete",
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
		            $('#txtModuloID_campanas_publicitarias_mercadotecnia').val(ui.item.data);
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
	        $('#txtModulo_campanas_publicitarias_mercadotecnia').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloID_campanas_publicitarias_mercadotecnia').val() == '' ||
	               $('#txtModulo_campanas_publicitarias_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtModuloID_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtModulo_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtZonaID_campanas_publicitarias_mercadotecnia').val('');
		           $('#txtZona_campanas_publicitarias_mercadotecnia').val('');
		          
	            }
	            
	        });

			//Autocomplete para recuperar los datos de una zona 
	        $('#txtZona_campanas_publicitarias_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtZonaID_campanas_publicitarias_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/zonas/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: $('#txtModuloID_campanas_publicitarias_mercadotecnia').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtZonaID_campanas_publicitarias_mercadotecnia').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la zona cuando pierda el enfoque la caja de texto
	        $('#txtZona_campanas_publicitarias_mercadotecnia').focusout(function(e){
	            //Si no existe id de la zona
	            if($('#txtZonaID_campanas_publicitarias_mercadotecnia').val() == '' ||
	               $('#txtZona_campanas_publicitarias_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtZonaID_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtZona_campanas_publicitarias_mercadotecnia').val('');
	            }

	        });

			//Autocomplete para recuperar los datos de una localidad 
	        $('#txtLocalidad_campanas_publicitarias_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtLocalidadID_campanas_publicitarias_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/localidades/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intMunicipioID: $("#txtMunicipioID_campanas_publicitarias_mercadotecnia").val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtLocalidadID_campanas_publicitarias_mercadotecnia').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/localidades/get_datos',
	                  { 
	                  	strBusqueda:$("#txtLocalidadID_campanas_publicitarias_mercadotecnia").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtLocalidad_campanas_publicitarias_mercadotecnia").val(data.row.localidad);
	                       $("#txtMunicipioID_campanas_publicitarias_mercadotecnia").val(data.row.municipio_id);
	                       $("#txtMunicipio_campanas_publicitarias_mercadotecnia").val(data.row.municipio);
	                       $("#txtEstadoID_campanas_publicitarias_mercadotecnia").val(data.row.estado_id);
	                       $("#txtEstado_campanas_publicitarias_mercadotecnia").val(data.row.estado);
	                       
	                    }
	                  }
	                 ,
	                'json');
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la localidad cuando pierda el enfoque la caja de texto
	        $('#txtLocalidad_campanas_publicitarias_mercadotecnia').focusout(function(e){
	            //Si no existe id de la localidad
	            if($('#txtLocalidadID_campanas_publicitarias_mercadotecnia').val() == '' ||
	               $('#txtLocalidad_campanas_publicitarias_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtLocalidadID_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtLocalidad_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtMunicipioID_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtMunicipio_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtEstadoID_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtEstado_campanas_publicitarias_mercadotecnia').val('');
	               
	            }

	        });

	        //Autocomplete para recuperar los datos de un municipio 
	        $('#txtMunicipio_campanas_publicitarias_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtMunicipioID_campanas_publicitarias_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/municipios/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intEstadoID: $('#txtEstadoID_campanas_publicitarias_mercadotecnia').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtMunicipioID_campanas_publicitarias_mercadotecnia').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/municipios/get_datos',
	                  { 
	                  	strBusqueda:$("#txtMunicipioID_campanas_publicitarias_mercadotecnia").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtMunicipio_campanas_publicitarias_mercadotecnia").val(data.row.municipio);
	                       $("#txtEstadoID_campanas_publicitarias_mercadotecnia").val(data.row.estado_id);
	                       $("#txtEstado_campanas_publicitarias_mercadotecnia").val(data.row.estado);
	                       $("#txtLocalidadID_campanas_publicitarias_mercadotecnia").val('');
	                       $("#txtLocalidad_campanas_publicitarias_mercadotecnia").val('');
	                    }
	                  }
	                 ,
	                'json');
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	         //Verificar que exista id del municipio cuando pierda el enfoque la caja de texto
	        $('#txtMunicipio_campanas_publicitarias_mercadotecnia').focusout(function(e){
	            //Si no existe id del municipio
	            if($('#txtMunicipioID_campanas_publicitarias_mercadotecnia').val() == '' || 
	               $('#txtMunicipio_campanas_publicitarias_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMunicipioID_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtMunicipio_campanas_publicitarias_mercadotecnia').val('');
	               $("#txtEstadoID_campanas_publicitarias_mercadotecnia").val('');
	               $('#txtEstado_campanas_publicitarias_mercadotecnia').val('');
	               $("#txtLocalidadID_campanas_publicitarias_mercadotecnia").val('');
	               $('#txtLocalidad_campanas_publicitarias_mercadotecnia').val('');
	            }

	        });
			
			//Autocomplete para recuperar los datos de un estado 
	        $('#txtEstado_campanas_publicitarias_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtEstadoID_campanas_publicitarias_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_estados/autocomplete",
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
	             $('#txtEstadoID_campanas_publicitarias_mercadotecnia').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('contabilidad/sat_estados/get_datos',
	                  { 
	                  	strBusqueda:$("#txtEstadoID_campanas_publicitarias_mercadotecnia").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtEstado_campanas_publicitarias_mercadotecnia").val(data.row.estado);
	                       $('#txtMunicipioID_campanas_publicitarias_mercadotecnia').val('');
	                       $('#txtMunicipio_campanas_publicitarias_mercadotecnia').val('');
	                       $('#txtLocalidadID_campanas_publicitarias_mercadotecnia').val('');
	                       $('#txtLocalidad_campanas_publicitarias_mercadotecnia').val('');
	                       
	                    }
	                  }
	                 ,
	                'json');
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del estado cuando pierda el enfoque la caja de texto
	        $('#txtEstado_campanas_publicitarias_mercadotecnia').focusout(function(e){
	            //Si no existe id del estado
	            if($('#txtEstadoID_campanas_publicitarias_mercadotecnia').val() == '' ||
	            	$('#txtEstado_campanas_publicitarias_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEstadoID_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtEstado_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtMunicipioID_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtMunicipio_campanas_publicitarias_mercadotecnia').val('');
                   $('#txtLocalidadID_campanas_publicitarias_mercadotecnia').val('');
                   $('#txtLocalidad_campanas_publicitarias_mercadotecnia').val('');
	            }

	        });

			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_campanas_publicitarias_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_campanas_publicitarias_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_campanas_publicitarias_mercadotecnia').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_campanas_publicitarias_mercadotecnia').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_campanas_publicitarias_mercadotecnia').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_campanas_publicitarias_mercadotecnia').data('DateTimePicker').maxDate(e.date);
			});

	       //Autocomplete para recuperar los datos de un módulo 
	        $('#txtModuloBusq_campanas_publicitarias_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloIDBusq_campanas_publicitarias_mercadotecnia').val('');
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtZonaIDBusq_campanas_publicitarias_mercadotecnia').val('');
	          	   $('#txtZonaBusq_campanas_publicitarias_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/modulos/autocomplete",
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
	              $('#txtModuloIDBusq_campanas_publicitarias_mercadotecnia').val(ui.item.data);
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
	        $('#txtModuloBusq_campanas_publicitarias_mercadotecnia').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloIDBusq_campanas_publicitarias_mercadotecnia').val() == '' ||
	               $('#txtModuloBusq_campanas_publicitarias_mercadotecnia').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtModuloIDBusq_campanas_publicitarias_mercadotecnia').val('');
	                $('#txtModuloBusq_campanas_publicitarias_mercadotecnia').val('');
	                $('#txtZonaIDBusq_campanas_publicitarias_mercadotecnia').val('');
	          	    $('#txtZonaBusq_campanas_publicitarias_mercadotecnia').val('');
	            }
	            
	        });

			//Autocomplete para recuperar los datos de una zona 
	        $('#txtZonaBusq_campanas_publicitarias_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtZonaIDBusq_campanas_publicitarias_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/zonas/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intModuloID: $('#txtModuloIDBusq_campanas_publicitarias_mercadotecnia').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtZonaIDBusq_campanas_publicitarias_mercadotecnia').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la zona cuando pierda el enfoque la caja de texto
	        $('#txtZonaBusq_campanas_publicitarias_mercadotecnia').focusout(function(e){
	            //Si no existe id de la zona
	            if($('#txtZonaIDBusq_campanas_publicitarias_mercadotecnia').val() == '' ||
	               $('#txtZonaBusq_campanas_publicitarias_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtZonaIDBusq_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtZonaBusq_campanas_publicitarias_mercadotecnia').val('');
	            }
	            
	        });

			//Autocomplete para recuperar los datos de una localidad 
	        $('#txtLocalidadBusq_campanas_publicitarias_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/localidades/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intMunicipioID: $("#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia").val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/localidades/get_datos',
	                  { 
	                  	strBusqueda:$("#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtLocalidadBusq_campanas_publicitarias_mercadotecnia").val(data.row.localidad);
	                       $("#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia").val(data.row.municipio_id);
	                       $("#txtMunicipioBusq_campanas_publicitarias_mercadotecnia").val(data.row.municipio);
	                       $("#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia").val(data.row.estado_id);
	                       $("#txtEstadoBusq_campanas_publicitarias_mercadotecnia").val(data.row.estado);
	                       
	                    }
	                  }
	                 ,
	                'json');
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id de la localidad cuando pierda el enfoque la caja de texto
	        $('#txtLocalidadBusq_campanas_publicitarias_mercadotecnia').focusout(function(e){
	            //Si no existe id de la localidad
	            if($('#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia').val() == '' ||
	               $('#txtLocalidadBusq_campanas_publicitarias_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtLocalidadBusq_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtMunicipioBusq_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtEstadoBusq_campanas_publicitarias_mercadotecnia').val('');
	               
	            }

	        });

	        //Autocomplete para recuperar los datos de un municipio 
	        $('#txtMunicipioBusq_campanas_publicitarias_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/municipios/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   intEstadoID:  $('#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia').val()

	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/municipios/get_datos',
	                  { 
	                  	strBusqueda:$("#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtMunicipioBusq_campanas_publicitarias_mercadotecnia").val(data.row.municipio);
	                       $("#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia").val(data.row.estado_id);
	                       $("#txtEstadoBusq_campanas_publicitarias_mercadotecnia").val(data.row.estado);
	                       $("#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia").val('');
	                       $("#txtLocalidadBusq_campanas_publicitarias_mercadotecnia").val('');
	                    }
	                  }
	                 ,
	                'json');
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	         //Verificar que exista id del municipio cuando pierda el enfoque la caja de texto
	        $('#txtMunicipioBusq_campanas_publicitarias_mercadotecnia').focusout(function(e){
	            //Si no existe id del municipio
	            if($('#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia').val() == '' || 
	               $('#txtMunicipioBusq_campanas_publicitarias_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtMunicipioBusq_campanas_publicitarias_mercadotecnia').val('');
	               $("#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia").val('');
	               $('#txtEstadoBusq_campanas_publicitarias_mercadotecnia').val('');
	               $("#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia").val('');
	               $('#txtLocalidadBusq_campanas_publicitarias_mercadotecnia').val('');
	            }
	            
	        });
			
			//Autocomplete para recuperar los datos de un estado 
	        $('#txtEstadoBusq_campanas_publicitarias_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "contabilidad/sat_estados/autocomplete",
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
	             $('#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('contabilidad/sat_estados/get_datos',
	                  { 
	                  	strBusqueda:$("#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia").val(),
			       		strTipo: 'id'
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtEstadoBusq_campanas_publicitarias_mercadotecnia").val(data.row.estado);
	                       $('#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia').val('');
	                       $('#txtMunicipioBusq_campanas_publicitarias_mercadotecnia').val('');
	                       $('#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia').val('');
	                       $('#txtLocalidadBusq_campanas_publicitarias_mercadotecnia').val('');
	                       
	                    }
	                  }
	                 ,
	                'json');
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });
	        
	        //Verificar que exista id del estado cuando pierda el enfoque la caja de texto
	        $('#txtEstadoBusq_campanas_publicitarias_mercadotecnia').focusout(function(e){
	            //Si no existe id del estado
	            if($('#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia').val() == '' ||
	               $('#txtEstadoBusq_campanas_publicitarias_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEstadoIDBusq_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtEstadoBusq_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtMunicipioIDBusq_campanas_publicitarias_mercadotecnia').val('');
	               $('#txtMunicipioBusq_campanas_publicitarias_mercadotecnia').val('');
                   $('#txtLocalidadIDBusq_campanas_publicitarias_mercadotecnia').val('');
                   $('#txtLocalidadBusq_campanas_publicitarias_mercadotecnia').val('');
	            }

	        });

			//Paginación de registros
			$('#pagLinks_campanas_publicitarias_mercadotecnia').on('click','a',function(event){
				event.preventDefault();
				intPaginaCampanasPublicitariasMercadotecnia = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_campanas_publicitarias_mercadotecnia();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_campanas_publicitarias_mercadotecnia').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_campanas_publicitarias_mercadotecnia();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_campanas_publicitarias_mercadotecnia').addClass("estatus-NUEVO");
				//Abrir modal
				 objCampanasPublicitariasMercadotecnia = $('#CampanasPublicitariasMercadotecniaBox').bPopup({
											   appendTo: '#CampanasPublicitariasMercadotecniaContent', 
				                               contentContainer: 'CampanasPublicitariasMercadotecniaM', 
				                               zIndex: 2, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtModulo_campanas_publicitarias_mercadotecnia').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_campanas_publicitarias_mercadotecnia').focus();

			//Deshabilitar los siguientes botones (funciones de permisos de acceso)
			$('#btnNuevo_campanas_publicitarias_mercadotecnia').attr('disabled','-1');  
			$('#btnImprimir_campanas_publicitarias_mercadotecnia').attr('disabled','-1');
			$('#btnDescargarXLS_campanas_publicitarias_mercadotecnia').attr('disabled','-1');
			$('#btnBuscar_campanas_publicitarias_mercadotecnia').attr('disabled','-1');
			$('#btnEnviarCorreo_campanas_publicitarias_mercadotecnia').attr('disabled','-1');
			$('#btnAdjuntar_campanas_publicitarias_mercadotecnia').attr('disabled','-1');      
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_campanas_publicitarias_mercadotecnia();
		});
	</script>