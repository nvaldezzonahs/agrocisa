	<div id="EncuestasMercadotecniaContent">
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario de Búsquedas-->
			<form class="form" id="frmBusqueda_encuestas_mercadotecnia" action="#" method="post" onsubmit="return(false)">
				<div class="row">
					<!--Buscar registros-->
					<div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
						<div class="input-group">
							<input class="form-control" id="txtBusqueda_encuestas_mercadotecnia" 
								   name="strBusqueda_encuestas_mercadotecnia"  type="text" value="" 
								   tabindex="1" placeholder="Ingrese descripción" >
							</input>
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnBuscar_encuestas_mercadotecnia"
										onclick="paginacion_encuestas_mercadotecnia();"
										title="Buscar coincidencias" tabindex="2" disabled> 
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
						<div id="ToolBtns" class="btn-group">
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_encuestas_mercadotecnia"
									title="Nuevo registro" tabindex="3" disabled> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_encuestas_mercadotecnia"
									onclick="reporte_encuestas_mercadotecnia();" 
									title="Imprimir reporte general en PDF" tabindex="4" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_encuestas_mercadotecnia"
									onclick="descargar_xls_encuestas_mercadotecnia();" title="Descargar reporte general en XLS" tabindex="5" disabled>
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
				Definir columnas de la tabla maestro
				*/
				td.movil.a1:nth-of-type(1):before {content: "Descripción"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Módulo"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}
				/*
				Definir columnas de la tabla preguntas
				*/
				td.movil.p1:nth-of-type(1):before {content: "Pregunta"; font-weight: bold;}
				td.movil.p2:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}
				/*
				Definir columnas de la tabla respuestas
				*/
				td.movil.r1:nth-of-type(1):before {content: "Respuesta"; font-weight: bold;}
				td.movil.r2:nth-of-type(2):before {content: "Acciones"; font-weight: bold;}
			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_encuestas_mercadotecnia">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Descripción</th>
							<th class="movil">Módulo</th>
							<th class="movil">Estatus</th>
							<th id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_encuestas_mercadotecnia" type="text/template"> 
					{{#rows}}
						<tr class="movil" {{estiloRegistro}}>    
							<td class="movil a1">{{descripcion}}</td>
							<td class="movil a2">{{modulo}}</td>
							<td class="movil a3">{{estatus}}</td>
							<td class="movil a4 td-center"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_encuestas_mercadotecnia({{encuesta_id}})" title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_encuestas_mercadotecnia({{encuesta_id}});" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_encuestas_mercadotecnia({{encuesta_id}})" title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Descargar archivo XLS con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionXLS}}"  
										onclick="descargar_xls_registro_encuestas_mercadotecnia({{encuesta_id}})" 
										title="Descargar registro en XLS">
									<span class="fa fa-file-excel-o"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_encuestas_mercadotecnia({{encuesta_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_encuestas_mercadotecnia({{encuesta_id}},'{{estatus}}')"  title="Restaurar">
									<span class="fa fa-exchange"></span>
								</button>
							</td>
						</tr>
						{{/rows}}
						{{^rows}}
						<tr class="movil"> 
							<td colspan="3"> No se encontraron resultados.</td>
						</tr> 
						{{/rows}}
					</script>
				</table>
				<br>
				<!--Diseño de la paginación-->
				<div class="row">
					<!--Páginas-->
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_encuestas_mercadotecnia"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_encuestas_mercadotecnia">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal-->
		<div id="EncuestasMercadotecniaBox" class="ModalBody" tabindex="-1">
			<!--Título-->
			<div id="divEncabezadoModal_encuestas_mercadotecnia" class="ModalBodyTitle">
				<h1>Lista de Encuestas</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEncuestasMercadotecnia" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmEncuestasMercadotecnia" onsubmit="return(false)" autocomplete="off">
					<div class="row">
						<!--Descripción-->
						<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtEncuestaID_encuestas_mercadotecnia" 
										   name="intEncuestaID_encuestas_mercadotecnia" 
										   type="hidden" value="">
									</input>	
									<label for="txtDescripcion_encuestas_mercadotecnia">Encuesta</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtDescripcion_encuestas_mercadotecnia" 
											name="strDescripcion_encuestas_mercadotecnia" type="text" value="" 
											placeholder="Ingrese nombre de encuesta">
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los módulos activos-->
					    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
									<input id="txtModuloID_encuestas_mercadotecnia" 
										   name="intModuloID_encuestas_mercadotecnia"  type="hidden" value="">
									</input>
									<label for="txtModulo_encuestas_mercadotecnia">Módulo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtModulo_encuestas_mercadotecnia" 
											name="strModulo_encuestas_mercadotecnia" type="text" value=""  placeholder="Ingrese módulo" maxlength="250">
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
											<h4 class="panel-title">Preguntas de la encuesta</h4>
										</div>
										<div class="panel-body">
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!--Pregunta-->
													<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
														<div class="form-group">
															<div class="col-md-12">
																<!-- Caja de texto oculta para recuperar el id del registro seleccionado-->
																<input class="form-control"
																	   id="txtPreguntaRenglon_encuestas_mercadotecnia"
																	   name="intPreguntaRenglon_encuestas_mercadotecnia" 
																	   type="hidden">
																<label for="txtPregunta_encuestas_mercadotecnia">
																	Pregunta
																</label>
																<input  class="form-control" 
																		id="txtPregunta_encuestas_mercadotecnia" 
																		name="strPregunta_encuestas_mercadotecnia" 
																		type="text" value="" 
																		placeholder="Ingrese la pregunta">
																</input>
															</div>
														</div>	
													</div>
													<!--Botones Ver Respuestas y Agregar Pregunta-->
													<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
														<div class="pull-right">
															<button class="btn btn-info btn-toolBtns" 
																	id="btnVerRespuestas_encuestas_mercadotecnia" 
																	onclick="respuestas_pregunta_encuestas_mercadotecnia();" 
																	title="Respuestas">
																<span class="glyphicon glyphicon-question-sign"></span>
															</button>
															<button class="btn btn-primary btn-toolBtns" 
																	id="btnAgregar_encuestas_mercadotecnia" 
																	onclick="agregar_renglon_pregunta_encuestas_mercadotecnia();" 
																	title="Agregar pregunta">
																<span class="glyphicon glyphicon-plus"></span>
															</button>
														</div>	
													</div>	
												</div>
											</div>
											<!--Div que contiene la tabla con las preguntas encontradas para una encuesta -->
											<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
												<div class="row">
													<!-- Diseño de la tabla-->
													<table class="table-hover" id="dgPreguntas_encuestas_mercadotecnia">
														<thead class="movil">
															<tr class="movil">
																<th class="movil">Pregunta</th>
																<th style="width:12em; text-align: center;">Acciones</th>
															</tr>
														</thead>
														<tbody class="movil"></tbody>
													</table>
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
							<button class="btn btn-success" id="btnGuardar_encuestas_mercadotecnia"  
									onclick="validar_encuestas_mercadotecnia();"  title="Guardar" disabled>
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default"  id="btnImprimirRegistro_encuestas_mercadotecnia"
									onclick="reporte_registro_encuestas_mercadotecnia('');" 
									title="Imprimir registro en PDF" disabled>
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con los datos del registro-->
							<button class="btn btn-default"  id="btnDescargarXLSRegistro_encuestas_mercadotecnia"
									onclick="descargar_xls_registro_encuestas_mercadotecnia('');" title="Descargar registro en XLS" disabled>
								<span class="fa fa-file-excel-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_encuestas_mercadotecnia"  
									onclick="cambiar_estatus_encuestas_mercadotecnia('','ACTIVO');"  title="Desactivar" disabled>
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_encuestas_mercadotecnia"  
									onclick="cambiar_estatus_encuestas_mercadotecnia('','INACTIVO');"  title="Restaurar" disabled>
								<span class="fa fa-exchange"></span>
							</button> 
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_encuestas_mercadotecnia"
									type="reset" aria-hidden="true" onclick="cerrar_encuestas_mercadotecnia();" title="Cerrar">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal-->

		<!--Diseño del modal secundario-->
		<div id="RespuestasMercadotecniaBox" class="ModalBody" tabindex="-1">
			<!--Título-->
			<div id="divEncabezadoModalSecundario_encuestas_mercadotecnia" class="ModalBodyTitle">
				<h1>Lista de respuestas</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmPreguntasMercadotecnia" method="post" action="#" class="form-horizontal" role="form" 
					  name="frmPreguntasMercadotecnia" onsubmit="return(false)" autocomplete="off">
					<div class="row">
					  	<!--Respuestas-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">	
									<label for="txtPreguntaRespuestas_encuestas_mercadotecnia">Pregunta</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtPreguntaRespuestas_encuestas_mercadotecnia" 
											name="strPreguntaRespuestas_encuestas_mercadotecnia" 
											type="text" 
											disabled>
									</input>
								</div>
							</div>
						</div>
					</div>
					<!--Cierre row-->
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">Respuestas de la pregunta</h4>
								</div>
								<div class="panel-body">
									<div class="row">
										<!--Pregunta-->
										<div class="col-sm-11 col-md-11 col-lg-11 col-xs-12">
											<div class="form-group">
												<!-- Caja de texto oculta para recuperar el id del registro seleccionado-->
												<input id="txtRespuestaID_encuestas_mercadotecnia"
													   name="strRespuestaID_encuestas_mercadotecnia" 
													   type="hidden" value="">
												<label for="txtRespuesta_encuestas_mercadotecnia">
													Respuesta
												</label>
												<input  class="form-control" 
														id="txtRespuesta_encuestas_mercadotecnia" 
														name="strRespuesta_encuestas_mercadotecnia" 
														type="text" value="" 
														placeholder="Ingrese la respuesta">
												</input>
											</div>
										</div>
										<!--Botón para Agregar Pregunta-->
										<div class="col-sm-1 col-md-1 col-lg-1 col-xs-12">
											<div class="pull-right">
												<button class="btn btn-primary btn-toolBtns" 
														id="btnAgregarRespuesta_encuestas_mercadotecnia" 
														onclick="agregar_renglon_respuesta_encuestas_mercadotecnia();" 
														title="Agregar respuesta">
													<span class="glyphicon glyphicon-plus"></span>
												</button>
											</div>	
										</div>
									</div>
									<div class="row">
										<!-- Diseño de la tabla-->
										<table class="table-hover" id="dgRespuestas_encuestas_mercadotecnia">
											<thead class="movil">
												<tr class="movil">
													<th class="movil">Respuesta</th>
													<th style="width:10em; text-align: center;">Acciones</th>
												</tr>
											</thead>
											<tbody class="movil"></tbody>
										</table>
									</div>		
								</div>
							</div>		
						</div>
					</div>
					<!--Cierre row-->		
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_respuestas_encuestas_mercadotecnia"  
									onclick="guardar_respuestas_encuesta_mercadotecnia();"  title="Guardar">
								<span class="fa fa-floppy-o"></span>
							</button>  
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_respuestas_encuestas_mercadotecnia"
									type="reset" aria-hidden="true" onclick="cerrar_respuestas_encuestas_mercadotecnia();" title="Cerrar">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
					<!--Cierre Botones de acción (barra de tareas)-->	
				</form>
				<!--Cierre del formulario-->	  
			</div>
			<!--Cierre del Contenido-->
		</div>
		<!--Cierre del modal secundario-->
	</div><!--#EncuestasMercadotecniaContent -->	

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaEncuestasMercadotecnia = 0;
		var strUltimaBusquedaEncuestasMercadotecnia = "";
		//Variable que se utiliza para asignar objeto del modal
		var objEncuestasMercadotecnia = null;
		//Variable que se utilia para asignar objeto del modal secundario
		var objRespuestasMercadotecnia = null;
		
		/*******************************************************************************************************************
		Funciones del objeto Encuesta
		*********************************************************************************************************************/
		// Constructor de Encuesta
		var objEncuesta;
		function Encuesta(id, descripcion, moduloID, preguntas)
		{
		    this.intEncuestaID = id;
		    this.strDescripcion = descripcion;
		    this.intModuloID = moduloID;
		    this.arrPreguntas = preguntas;
		}
		// --------------------- MÉTODOS PARA EL OBJETO ENCUESTA ------------------------------------------------------------
		Encuesta.prototype.setID = function(id) {
		    this.intEncuestaID = id;
		}
		Encuesta.prototype.getID = function() {
		    return this.intEncuestaID;
		}
		Encuesta.prototype.setDescripcion = function(descripcion) {
		    this.strDescripcion = descripcion;
		}
		Encuesta.prototype.getDescripcion = function() {
		    return this.strDescripcion;
		}
		Encuesta.prototype.setModuloID = function(moduloID) {
		    this.intModuloID = moduloID;
		}
		Encuesta.prototype.getModuloID = function() {
		    return this.intModuloID;
		}
		// -------------------- FUNCIONES ASOCIADAS AL ATRIBUTO PREGUNTAS ---------------------------------------------------
		//Función para agregar todas las preguntas al objeto Encuesta
		Encuesta.prototype.setPreguntas = function(preguntas) {
		    this.arrPreguntas = preguntas;
		}
		//Función para obtener todas las preguntas del objeto Encuesta
		Encuesta.prototype.getPreguntas = function() {
		    return this.arrPreguntas;
		}
		//Función para agregar una pregunta al objeto Encuesta
		Encuesta.prototype.setPregunta = function (pregunta){
			this.arrPreguntas.push(pregunta);
		}
		//Función para obtener una pregunta del objeto Encuesta
		Encuesta.prototype.getPregunta = function(index) {
		    return this.arrPreguntas[index];
		}
		//Función para modificar el nombre de una pregunta al objeto Encuesta
		Encuesta.prototype.updatePregunta = function (index, pregunta){
			this.arrPreguntas[index][0] = pregunta;
		}
		//Función para eliminar una pregunta al objeto Encuesta
		Encuesta.prototype.deletePregunta = function (index){
			if(index != -1) {
				this.arrPreguntas.splice(index, 1);
			}
		}
		//Función para cambiar las posiciones de las preguntas en el Objeto Encuesta
		Encuesta.prototype.swap = function(index_A, index_B) {
		    var input = this.arrPreguntas;
		 
		    var temp = input[index_A];
		    input[index_A] = input[index_B];
		    input[index_B] = temp;
		}

		// -------------------- FUNCIONES ASOCIADAS AL ATRIBUTO PREGUNTAS->RESPUESTAS ----------------------------------------
		Encuesta.prototype.setRespuestas = function(index, respuestas) {
	    	this.arrPreguntas[index][1] = respuestas;
		}
		Encuesta.prototype.getRespuestas = function(index) {
		    return this.arrPreguntas[index][2];
		}
		Encuesta.prototype.deleteRespuestas = function(index) {
	    	this.arrPreguntas[index][1] = 0;
		}
		

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_encuestas_mercadotecnia()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('mercadotecnia/encuestas/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_encuestas_mercadotecnia').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosEncuestasMercadotecnia = data.row;
					//Separar la cadena 
					var arrPermisosEncuestasMercadotecnia = strPermisosEncuestasMercadotecnia.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosEncuestasMercadotecnia.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosEncuestasMercadotecnia[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_encuestas_mercadotecnia').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosEncuestasMercadotecnia[i]=='GUARDAR') || (arrPermisosEncuestasMercadotecnia[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_encuestas_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEncuestasMercadotecnia[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_encuestas_mercadotecnia').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_encuestas_mercadotecnia();
						}
						else if(arrPermisosEncuestasMercadotecnia[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_encuestas_mercadotecnia').removeAttr('disabled');
							$('#btnRestaurar_encuestas_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEncuestasMercadotecnia[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_encuestas_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEncuestasMercadotecnia[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_encuestas_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEncuestasMercadotecnia[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_encuestas_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEncuestasMercadotecnia[i]=='DESCARGAR XLS REGISTRO')//Si el indice es DESCARGAR XLS REGISTRO
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLSRegistro_encuestas_mercadotecnia').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_encuestas_mercadotecnia() 
		{
			//Verificar si hubo cambios en la búsqueda
			if($('#txtBusqueda_encuestas_mercadotecnia').val() != strUltimaBusquedaEncuestasMercadotecnia)
			{
				intPaginaEncuestasMercadotecnia = 0;
				strUltimaBusquedaEncuestasMercadotecnia = $('#txtBusqueda_encuestas_mercadotecnia').val();
			}
			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('mercadotecnia/encuestas/get_paginacion',
					{	strBusqueda:$('#txtBusqueda_encuestas_mercadotecnia').val(),
						intPagina:intPaginaEncuestasMercadotecnia,
						strPermisosAcceso: $('#txtAcciones_encuestas_mercadotecnia').val()
					},
					function(data){
						$('#dg_encuestas_mercadotecnia tbody').empty();
						var tmpEncuestasMercadotecnia = Mustache.render($('#plantilla_encuestas_mercadotecnia').html(),data);
						$('#dg_encuestas_mercadotecnia tbody').html(tmpEncuestasMercadotecnia);
						$('#pagLinks_encuestas_mercadotecnia').html(data.paginacion);
						$('#numElementos_encuestas_mercadotecnia').html(data.total_rows);
						intPaginaEncuestasMercadotecnia = data.pagina;
					},
			'json');
		}

		//Función para cargar el reporte general en PDF
		function reporte_encuestas_mercadotecnia() 
		{
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("mercadotecnia/encuestas/get_reporte/"+$('#txtBusqueda_encuestas_mercadotecnia').val());
		}
		
		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_encuestas_mercadotecnia(id)
		{	
			//Variable que se utiliza para asignar id de la encuesta
			var intEncuestaID = 0;
			
			//Dependiendo del tipo de formulario asignar id
			if(id == '')
				intEncuestaID = $('#txtEncuestaID_encuestas_mercadotecnia').val();
			else
				intEncuestaID = id;

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("mercadotecnia/encuestas/get_reporte_registro/"+intEncuestaID);
		}

		//Función para descargar el reporte general en XLS
		function descargar_xls_encuestas_mercadotecnia() 
		{
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
         	window.open("mercadotecnia/encuestas/get_xls/"+$('#txtBusqueda_encuestas_mercadotecnia').val());
		
		}

		//Función para descargar el reporte de un registro en XLS
		function descargar_xls_registro_encuestas_mercadotecnia(id) 
		{
			//Variable que se utiliza para asignar id de la encuesta
			var intEncuestaID = 0;
			
			//Dependiendo del tipo de formulario asignar id
			if(id == '')
				intEncuestaID = $('#txtEncuestaID_encuestas_mercadotecnia').val();
			else
				intEncuestaID = id;

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
			window.open("mercadotecnia/encuestas/get_xls_registro/"+intEncuestaID);
		
		}

		/*******************************************************************************************************************
		Funciones del modal Encuestas
		*********************************************************************************************************************/
		// Función para limpiar los campos del formulario
		function nuevo_encuestas_mercadotecnia()
		{
			//Incializar formulario
			$('#frmEncuestasMercadotecnia')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_encuestas_mercadotecnia();
			//Limpiar cajas de texto ocultas
			$('#frmEncuestasMercadotecnia').find('input[type=hidden]').val('');
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_encuestas_mercadotecnia').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_encuestas_mercadotecnia').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_encuestas_mercadotecnia').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmEncuestasMercadotecnia').find('input, textarea, select').removeAttr('disabled','disabled');
			//Mostrar botón Guardar
			$("#btnGuardar_encuestas_mercadotecnia").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_encuestas_mercadotecnia").hide();
			$("#btnDescargarXLSRegistro_encuestas_mercadotecnia").hide();
			$("#btnDesactivar_encuestas_mercadotecnia").hide();
			$("#btnRestaurar_encuestas_mercadotecnia").hide();
		}

		//Función para crear un nuevo objeto de tipo Encuesta
		function nuevo_objeto_encuesta(){

			// Crear un Objeto de tipo Encuesta
			objEncuesta = new Encuesta( null, '', '', [] );

		}


		//Función para editar un objeto encuesta
		function editar_objeto_encuesta(intEncuestaID, strDescripcion, intModuloID, strModulo, strEstatus, arrPreguntas){

			//Limpiar el formulario
			nuevo_encuestas_mercadotecnia()
			
			//Recuperar valores
            $('#txtEncuestaID_encuestas_mercadotecnia').val(intEncuestaID);
            $('#txtDescripcion_encuestas_mercadotecnia').val(strDescripcion);
            $('#txtModuloID_encuestas_mercadotecnia').val(intModuloID);
            $('#txtModulo_encuestas_mercadotecnia').val(strModulo);
            //Dependiendo del estatus cambiar el color del encabezado 
            $('#divEncabezadoModal_encuestas_mercadotecnia').addClass("estatus-" + strEstatus);

			// Crear un Objeto de tipo Encuesta con los datos correspondientes
			objEncuesta = new Encuesta( intEncuestaID, strDescripcion, intModuloID, arrPreguntas);

			//Preguntamos si la encuesta seleccionada ya contiene preguntas guardadas
			if(arrPreguntas.length > 0){
				
				//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dgPreguntas_encuestas_mercadotecnia').getElementsByTagName('tbody')[0];

				for(var i=0; i<arrPreguntas.length; i++){

					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaPregunta = objRenglon.insertCell(0);
					var objCeldaAcciones = objRenglon.insertCell(1);

					objCeldaPregunta.setAttribute('class', 'movil p1');
					objCeldaPregunta.innerHTML = arrPreguntas[i][0];
					objCeldaAcciones.setAttribute('class', 'movil p2');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 "        onclick='editar_renglon_pregunta_encuestas_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" +
												 "<button class='btn btn-default btn-xs' title='Respuestas'" +
												 "        onclick='respuestas_renglon_pregunta_encuestas_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-question-sign'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 "        onclick='eliminar_renglon_pregunta_encuestas_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				}

			}
		
		}

		//Función para agregar una nueva Pregunta en el objeto Encuesta
		function nueva_pregunta_objeto_encuesta(){
			
			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dgPreguntas_encuestas_mercadotecnia').getElementsByTagName('tbody')[0];

			var r = objTabla.rows.length; //Número del nuevo renglón
			var objRen =  objTabla.rows[r - 1]; //Obtener los valores del objeto renglón recien creado
			var pregunta = [objRen.cells[0].innerHTML, [] ]; //Crear una nueva pregunta sin respuestas

			objEncuesta.setPregunta(pregunta);

		}

		//Función para actualizar una Pregunta en el objeto Encuesta
		function actualizar_pregunta_objeto_encuesta(index, strPregunta){

			objEncuesta.updatePregunta(index, strPregunta);

		}

		// Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_encuestas_mercadotecnia(id, estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = $('#txtEncuestaID_encuestas_mercadotecnia').val();

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
						              'title':    'Lista de Encuestas',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
						                              $.post('mercadotecnia/encuestas/set_estatus',
						                                     {intEncuestaID: intID,
						                                      strEstatus: estatus
						                                     },
						                                     function(data) {
						                                        if(data.resultado)
						                                        {
						                                          	//Hacer llamado a la función  para cargar  los registros en el grid
						                                         	paginacion_encuestas_mercadotecnia();
						                                          	
						                                          	//Si el id del registro se obtuvo del modal
																	if(id == '')
																	{
																		//Hacer un llamado a la función para cerrar modal e inicializar objeto bootstrapValidator
																		cerrar_encuestas_mercadotecnia();     
																	}
						                                        }
						                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						                                        mensaje_encuestas_mercadotecnia(data.tipo_mensaje, data.mensaje);
						                                     },
						                                    'json');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('mercadotecnia/encuestas/set_estatus',
				     {intEncuestaID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				        	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_encuestas_mercadotecnia();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal e inicializar objeto bootstrapValidator
								cerrar_encuestas_mercadotecnia();     
							}
				      	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_encuestas_mercadotecnia(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para regresar los datos (al formulario) del registro seleccionado
		function editar_encuestas_mercadotecnia(id)
		{	
			//Eliminar los datos de la tabla
			$('#dgPreguntas_encuestas_mercadotecnia tbody').empty();
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('mercadotecnia/encuestas/get_datos',
			       {
			       	intEncuestaID:id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	//Crear un objeto de tipo Encuesta con base en la busqueda  
				            editar_objeto_encuesta(data.row.encuesta_id, data.row.descripcion, data.row.modulo_id, data.row.modulo, data.row.estatus, data.preguntas);

				            //Mostrar los siguientes botones
							$("#btnImprimirRegistro_encuestas_mercadotecnia").show();
							$("#btnDescargarXLSRegistro_encuestas_mercadotecnia").show();

				            //Si el estatus del registro es ACTIVO
				            if(data.row.estatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_encuestas_mercadotecnia").show();
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
				            	$('#frmEncuestasMercadotecnia').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					           	$("#btnGuardar_encuestas_mercadotecnia").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_encuestas_mercadotecnia").show();
							}

			            	//Abrir modal
							objEncuestasMercadotecnia = $('#EncuestasMercadotecniaBox').bPopup({
																	appendTo: '#EncuestasMercadotecniaContent', 
																	contentContainer: 'EncuestasMercadotecniaM', 
																	zIndex: 2, 
																	modalClose: false, 
																	modal: true, 
																	follow: [true,false], 
																	followEasing : "linear", 
																	easing: "linear", 
																	modalColor: ('#F0F0F0')});
							//Enfocar caja de texto
							$('#txtDescripcion_encuestas_mercadotecnia').focus();
							
						}
						
					},
				'json');
		}
		
		//Función para mostrar mensaje de éxito o error
		function mensaje_encuestas_mercadotecnia(tipoMensaje, mensaje)
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

		
		/*******************************************************************************************************************
		Funciones del modal: ENCUESTA->PREGUNTAS
		*********************************************************************************************************************/
		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_encuestas_mercadotecnia()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_encuestas_mercadotecnia();
			//Validación del formulario de campos obligatorios
			$('#frmEncuestasMercadotecnia')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
										strDescripcion_encuestas_mercadotecnia: {
											validators: {
												notEmpty: {message: 'Escriba un nombre de encuesta'}
											}
										},
										strModulo_encuestas_mercadotecnia: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del módulo
					                                    if($('#txtModuloID_encuestas_mercadotecnia').val() === '')
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
										}
									}
				});
			//Variable que se utiliza para asignar el objeto bootstrapValidator
			var bootstrapValidator_encuestas_mercadotecnia = $('#frmEncuestasMercadotecnia').data('bootstrapValidator');
			bootstrapValidator_encuestas_mercadotecnia.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_encuestas_mercadotecnia.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_encuestas_mercadotecnia();
			}
			else 
				return;
		}

		
		//Función para guardar o modificar los datos de un registro
		function guardar_encuestas_mercadotecnia()
		{
			//Inicializamos el objeto Encuesta
			objEncuesta.intEncuestaID = $('#txtEncuestaID_encuestas_mercadotecnia').val();
			objEncuesta.strDescripcion = $('#txtDescripcion_encuestas_mercadotecnia').val();
			objEncuesta.intModuloID = $('#txtModuloID_encuestas_mercadotecnia').val();
			
			//Hacer un llamado al método del controlador para guardar los datos del registro
			var jsonEncuesta = JSON.stringify(objEncuesta); 

			$.post('mercadotecnia/encuestas/guardar',
					{ 
						encuesta: jsonEncuesta
					},
					function(data) {
						
						if (data.resultado)
						{
							//Hacer llamado a la función  para cargar los registros en el grid
							paginacion_encuestas_mercadotecnia();
							//Hacer un llamado a la función para cerrar modal e inicializar objeto bootstrapValidator
							cerrar_encuestas_mercadotecnia();                  
						}
						
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_encuestas_mercadotecnia(data.tipo_mensaje, data.mensaje);
						
					},
			'json');
			
				
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_encuestas_mercadotecnia()
		{
			try {
				//Cerrar modal
				objEncuestasMercadotecnia.close();
				//Enfocar caja de texto 
				$('#txtBusqueda_encuestas_mercadotecnia').focus();
				//Eliminar los datos de la tabla
				$('#dgPreguntas_encuestas_mercadotecnia tbody').empty();
			}
			catch(err) {}
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_encuestas_mercadotecnia()
		{
			try
			{
				$('#frmEncuestasMercadotecnia').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para agregar un renglón al dg de Preguntas
		function agregar_renglon_pregunta_encuestas_mercadotecnia()
		{
			//Obtenemos los datos de las cajas de texto
			var intPreguntaID = $('#txtPreguntaRenglon_encuestas_mercadotecnia').val();
			var strPregunta = $('#txtPregunta_encuestas_mercadotecnia').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dgPreguntas_encuestas_mercadotecnia').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (strPregunta == ''){
				//Enfocar caja de texto
				$('#txtPregunta_encuestas_mercadotecnia').focus();
			}
			else{
				//Limpiamos las cajas de texto
				$('#txtPreguntaRenglon_encuestas_mercadotecnia').val('');
				$('#txtPregunta_encuestas_mercadotecnia').val('');
				
				//Revisamos si existe el ID proporcionado, si es así, editamos la descripción de la pregunta
				if (intPreguntaID){
					var selectedRow = document.getElementById("dgPreguntas_encuestas_mercadotecnia").rows[intPreguntaID].cells;
					selectedRow[0].innerHTML = strPregunta;
					actualizar_pregunta_objeto_encuesta(intPreguntaID - 1, strPregunta);
				}
				else{

					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaPregunta = objRenglon.insertCell(0);
					var objCeldaAcciones = objRenglon.insertCell(1);

					objCeldaPregunta.setAttribute('class', 'p1');
					objCeldaPregunta.innerHTML = strPregunta;
					objCeldaAcciones.setAttribute('class', 'p2');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 "        onclick='editar_renglon_pregunta_encuestas_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" +
												 "<button class='btn btn-default btn-xs' title='Respuestas'" +
												 "        onclick='respuestas_renglon_pregunta_encuestas_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-question-sign'></span></button>" + 
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 "        onclick='eliminar_renglon_pregunta_encuestas_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				
				    nueva_pregunta_objeto_encuesta();
				}

				//Enfocar caja de texto
				$('#txtPregunta_encuestas_mercadotecnia').focus();
			}

			

		}

		//Función para editar un renglón del dg Preguntas
		function editar_renglon_pregunta_encuestas_mercadotecnia(objRenglon)
		{
			
			//Asignar los valores a las cajas de texto
			$('#txtPreguntaRenglon_encuestas_mercadotecnia').val(objRenglon.parentNode.parentNode.rowIndex - 1);
			$('#txtPregunta_encuestas_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			//Enfocar caja de texto
			$('#txtPregunta_encuestas_mercadotecnia').focus();
			
		}

		//Función para eliminar un renglón del dg Preguntas
		function eliminar_renglon_pregunta_encuestas_mercadotecnia(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;

			//Eliminar del objeto encuesta->preguntas. La pregunta seleccionada
			objEncuesta.deletePregunta(intRenglon - 1);
			//Eliminar el renglón indicado
			document.getElementById("dgPreguntas_encuestas_mercadotecnia").deleteRow(intRenglon);

			//Enfocar caja de texto
			$('#txtPregunta_encuestas_mercadotecnia').focus();

		}

		//Función para ver las respuestas de un renglón (Pregunta) seleccionado del dg Preguntas
		function respuestas_renglon_pregunta_encuestas_mercadotecnia(objRenglon)
		{
			
			//Obtenemos el regnlón pertenciente a la pregunta seleccionada
			var intRenglonPregunta = objRenglon.parentNode.parentNode.rowIndex;
			if(intRenglonPregunta == '')
				mensaje_encuestas_mercadotecnia('error', 'Debe seleccionar una pregunta para ver sus respuestas');
			
			else
				mostrar_respuestas_encuestas_mercadotecnia(intRenglonPregunta - 1);

		}

		//Función para ver las respuestas de un renglón (Pregunta) seleccionado del dg Preguntas pero usando el botón "Ver Respuestas"
		function respuestas_pregunta_encuestas_mercadotecnia()
		{
			//Obtenemos los datos de las cajas de texto
			var intRenglonPregunta = $('#txtPreguntaRenglon_encuestas_mercadotecnia').val();
			var strPregunta = $('#txtPregunta_encuestas_mercadotecnia').val();

			if(intRenglonPregunta == '')
				mensaje_encuestas_mercadotecnia('error', 'Debe seleccionar una pregunta para ver sus respuestas');
			
			else
				mostrar_respuestas_encuestas_mercadotecnia(intRenglonPregunta, strPregunta);

		}

		//Función para abrir el modal secundario y visualizar las respuestas correspondientes a una pregunta
		function mostrar_respuestas_encuestas_mercadotecnia(intRenglonPregunta){
			
			//Obtenemos la información de la pregunta seleccionada		
			var pregunta = objEncuesta.getPregunta(intRenglonPregunta);
			var strPregunta = pregunta[0];
			var arrRespuestas = pregunta[1];
	
			//Limpiamos el dg de Respuestas para vovlerlo a cargar con la información correspondiente a la pregunta seleccionada
			$('#dgRespuestas_encuestas_mercadotecnia tbody').empty();
				
			//Preguntamos si la pregunta tiene al menos una respuesta
			if(arrRespuestas.length > 0){

				var objTabla = document.getElementById('dgRespuestas_encuestas_mercadotecnia').getElementsByTagName('tbody')[0];
				
				for(var i=0; i<arrRespuestas.length; i++){

					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaRespuesta = objRenglon.insertCell(0);
					var objCeldaAcciones = objRenglon.insertCell(1);

					objCeldaRespuesta.setAttribute('class', 'movil r1');
					objCeldaRespuesta.innerHTML = arrRespuestas[i];
					objCeldaAcciones.setAttribute('class', 'movil r2');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 "        onclick='editar_renglon_respuesta_encuestas_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" +
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 "        onclick='eliminar_renglon_respuesta_encuestas_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				}
			}	

			//Abrir modal cuando se de clic en el botón
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModalSecundario_encuestas_mercadotecnia').addClass("estatus-NUEVO");
			//Abrir modal
			objRespuestasMercadotecnia = $('#RespuestasMercadotecniaBox').bPopup({
														appendTo: '#EncuestasMercadotecniaBox', 
														contentContainer: 'RespuestasMercadotecniaM', 
														zIndex: 3, 
														modalClose: false, 
														modal: true, 
														follow: [true,false], 
														followEasing : "linear", 
														easing: "linear", 
														modalColor: ('#F0F0F0')});
			
			//Enviar valor del nombre de la pregunta al Modal Pregunta-Respuestas
			$('#txtPreguntaRenglon_encuestas_mercadotecnia').val(intRenglonPregunta);
			$('#txtPreguntaRespuestas_encuestas_mercadotecnia').val(strPregunta);

			//Enfocar caja de texto
			$('#txtRespuesta_encuestas_mercadotecnia').focus();
		}

		/*******************************************************************************************************************
		Funciones del modal secundario: ENCUESTA->PREGUNTA->RESPUESTAS
		*********************************************************************************************************************/
		//Función para agregar una respuesta al dg Respuestas
		function agregar_renglon_respuesta_encuestas_mercadotecnia(){
			//Obtenemos los datos de las cajas de texto
			var intRespuestaID = $('#txtRespuestaID_encuestas_mercadotecnia').val();
			var strRespuesta = $('#txtRespuesta_encuestas_mercadotecnia').val();

			//Obtenemos el objeto de la tabla
			var objTabla = document.getElementById('dgRespuestas_encuestas_mercadotecnia').getElementsByTagName('tbody')[0];

			//Validamos que se capturaron datos
			if (strRespuesta == ''){
				//Enfocar caja de texto
				$('#txtRespuesta_encuestas_mercadotecnia').focus();
			}
			else{
				//Limpiamos las cajas de texto
				$('#txtRespuestaID_encuestas_mercadotecnia').val('');
				$('#txtRespuesta_encuestas_mercadotecnia').val('');
				
				//Revisamos si existe el ID proporcionado, si es así, editamos la descripción de la respuesta en el renglón correspondiente
				if (intRespuestaID){
					var selectedRow = document.getElementById("dgRespuestas_encuestas_mercadotecnia").rows[intRespuestaID].cells;
					selectedRow[0].innerHTML = strRespuesta;
				}
				else{

					//Insertamos el renglón con sus celdas en el objeto de la tabla
					var objRenglon = objTabla.insertRow();
					var objCeldaRespuesta = objRenglon.insertCell(0);
					var objCeldaAcciones = objRenglon.insertCell(1);

					objCeldaRespuesta.setAttribute('class', 'r1');
					objCeldaRespuesta.innerHTML = strRespuesta;
					objCeldaAcciones.setAttribute('class', 'r2');
					objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
												 "        onclick='editar_renglon_respuesta_encuestas_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-edit'></span></button>" +
												 "<button class='btn btn-default btn-xs' title='Eliminar'" +
												 "        onclick='eliminar_renglon_respuesta_encuestas_mercadotecnia(this)'>" + 
												 "<span class='glyphicon glyphicon-trash'></span></button>" + 
												 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
												 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
												 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
												 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
				}

				//Enfocar caja de texto agregar Respuesta
				$('#txtRespuesta_encuestas_mercadotecnia').focus();
			}
		}

		//Función para actualizar Respuesta de un objeto Pregunta en la Encuesta
		function guardar_respuestas_encuesta_mercadotecnia(){
		
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_respuestas_encuestas_mercadotecnia();

			//Obtenemos el renglon de la pregunta que modificaremos en el campo respuestas
			var intPreguntaRenglon = $('#txtPreguntaRenglon_encuestas_mercadotecnia').val();

			//Limpiamos el campo Respuestas de la pregunta para volver a insertar las respuestas
			objEncuesta.deleteRespuestas(intPreguntaRenglon);

			//Obtenemos el objeto de la tabla respuestas
			var objTabla = document.getElementById('dgRespuestas_encuestas_mercadotecnia').getElementsByTagName('tbody')[0];
			
			//Recorrer los renglones de la tabla para obtener los valores
			var respuestas = [];

			for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) {			
				var respuesta = objRen.cells[0].innerHTML; 
				respuestas.push(respuesta);
			}

			objEncuesta.setRespuestas(intPreguntaRenglon, respuestas);

			cerrar_respuestas_encuestas_mercadotecnia();

		}


		//Función que se utiliza para cerrar el modal secundario
		function cerrar_respuestas_encuestas_mercadotecnia()
		{
			try {
				//Cerrar modal
				objRespuestasMercadotecnia.close();
				$('#txtPreguntaRenglon_encuestas_mercadotecnia').val(''); 
				$('#txtPregunta_encuestas_mercadotecnia').val('');
				//Enfocar caja de texto
				$('#txtPregunta_encuestas_mercadotecnia').focus();
				//Hacer un llamado a la función para limpiar los mensajes de error 
				limpiar_mensajes_respuestas_encuestas_mercadotecnia();
				//Eliminar los datos de la tabla
			}
			catch(err) {}

		}


		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_respuestas_encuestas_mercadotecnia()
		{
			try
			{
				$('#frmPreguntasMercadotecnia').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para editar un renglón del dg Respuestas
		function editar_renglon_respuesta_encuestas_mercadotecnia(objRenglon)
		{
			//Asignar los valores a las cajas de texto
			$('#txtRespuestaID_encuestas_mercadotecnia').val(objRenglon.parentNode.parentNode.rowIndex);
			$('#txtRespuesta_encuestas_mercadotecnia').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
			
			//Enfocar caja de texto
			$('#txtRespuesta_encuestas_mercadotecnia').focus();
		}

		//Función para eliminar un renglón del dg Respuestas
		function eliminar_renglon_respuesta_encuestas_mercadotecnia(objRenglon)
		{
			//Obtener el indice del objeto renglón que se envía
			var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
			
			//Eliminar el renglón indicado
			document.getElementById("dgRespuestas_encuestas_mercadotecnia").deleteRow(intRenglon);

			//Enfocar caja de texto
			$('#txtRespuesta_encuestas_mercadotecnia').focus();
		}

		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal
			*********************************************************************************************************************/
			//Autocomplete para recuperar los datos de un módulo 
	        $('#txtModulo_encuestas_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloID_encuestas_mercadotecnia').val('');
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
		            $('#txtModuloID_encuestas_mercadotecnia').val(ui.item.data);
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
	        $('#txtModulo_encuestas_mercadotecnia').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloID_encuestas_mercadotecnia').val() == '' ||
	               $('#txtModulo_encuestas_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtModuloID_encuestas_mercadotecnia').val('');
	               $('#txtModulo_encuestas_mercadotecnia').val('');
	            }
	            
	        });

			//Función para mover renglones arriba y abajo en la tabla Preguntas
			$('#dgPreguntas_encuestas_mercadotecnia').on('click','button.btn',function(){
	            
	            var row = $(this).closest('tr');
	            if ($(this).hasClass('btn-default btn-xs down')){

	            	if( row.next().index() != -1 ){ //Verifica que no sea el último elemento del grid
	            		objEncuesta.swap( row.index(), row.next().index() );
	            	}	
	            	row.next().after(row);

	            }
	            else if($(this).hasClass('btn-default btn-xs up')){
	            	
	            	if( row.prev().index() != -1 ){ //Verifica que no sea el primer elemento del grid
	            		objEncuesta.swap( row.prev().index(), row.index() );
	            	}
	            	row.prev().before(row);

	            }
				
	        });

	        /*******************************************************************************************************************
			Controles correspondientes al modal secundario
			*********************************************************************************************************************/
			//Función para mover renglones arriba y abajo en la tabla Preguntas
			$('#dgRespuestas_encuestas_mercadotecnia').on('click','button.btn',function(){
	            
	            var row = $(this).closest('tr');
	            if ($(this).hasClass('btn-default btn-xs down')){
	            	row.next().after(row);
	            }
	            else if($(this).hasClass('btn-default btn-xs up')){
	            	row.prev().before(row);
	            }
				
	        });

	        /*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Paginación de registros
			$('#pagLinks_encuestas_mercadotecnia').on('click','a',function(event){
				event.preventDefault();
				intPaginaEncuestasMercadotecnia = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_encuestas_mercadotecnia();
			});

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_encuestas_mercadotecnia').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_encuestas_mercadotecnia();
				nuevo_objeto_encuesta();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_encuestas_mercadotecnia').addClass("estatus-NUEVO");
				//Abrir modal
				 objEncuestasMercadotecnia = $('#EncuestasMercadotecniaBox').bPopup({
														appendTo: '#EncuestasMercadotecniaContent', 
														contentContainer: 'EncuestasMercadotecniaM', 
														zIndex: 2, 
														modalClose: false, 
														modal: true, 
														follow: [true,false], 
														followEasing : "linear", 
														easing: "linear", 
														modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtDescripcion_encuestas_mercadotecnia').focus();
			});

			//Enfocar caja de texto
			$('#txtBusqueda_encuestas_mercadotecnia').focus();
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_encuestas_mercadotecnia();
			
		});
	</script>