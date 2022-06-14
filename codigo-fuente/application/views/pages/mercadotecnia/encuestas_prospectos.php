	<div id="EncuestasProspectosMercadotecniaContent">  
		<!--Barra de herramientas-->
		<div class="panel-toolbar">
			<!--Diseño del formulario-->
			<form id="frmBusqueda_encuestas_prospectos_mercadotecnia" method="post" action="#" class="form-horizontal" 
				  role="form" name="frmBusqueda_encuestas_prospectos_mercadotecnia" onsubmit="return(false)" autocomplete="off">
				<div class="row">
					<!--Fecha inicial-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<label for="txtFechaInicialBusq_encuestas_prospectos_mercadotecnia">Fecha inicial</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaInicialBusq_encuestas_prospectos_mercadotecnia'>
				                    <input class="form-control" 
				                    		id="txtFechaInicialBusq_encuestas_prospectos_mercadotecnia"
				                    		name= "strFechaInicialBusq_encuestas_prospectos_mercadotecnia" 
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
								<label for="txtFechaFinalBusq_encuestas_prospectos_mercadotecnia">Fecha final</label>
							</div>
							<div class="col-md-12">
								<div class='input-group date' id='dteFechaFinalBusq_encuestas_prospectos_mercadotecnia'>
				                    <input class="form-control" 
				                    		id="txtFechaFinalBusq_encuestas_prospectos_mercadotecnia"
				                    		name= "strFechaFinalBusq_encuestas_prospectos_mercadotecnia" 
				                    		type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los prospectos activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del prospecto seleccionado-->
								<input  class="form-control" 
										id="txtProspectoIDBusq_encuestas_prospectos_mercadotecnia" 
										name="strProspectoBusqID_encuestas_prospectos_mercadotecnia" 
										type="hidden" value="">
								</input>
								<label for="txtProspectoBusq_encuestas_prospectos_mercadotecnia">Prospecto</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtProspectoBusq_encuestas_prospectos_mercadotecnia" 
										name="strProspectoBusq_encuestas_prospectos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese prospecto"  maxlength="250"/>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los vendedores activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del vendedor seleccionado-->
								<input  class="form-control" 
										id="txtVendedorIDBusq_encuestas_prospectos_mercadotecnia" 
										name="intVendedorBusqID_encuestas_prospectos_mercadotecnia" 
										type="hidden" value="">
								</input>
								<label for="txtVendedorBusq_encuestas_prospectos_mercadotecnia">Vendedor</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtVendedorBusq_encuestas_prospectos_mercadotecnia" 
										name="strVendedorBusq_encuestas_prospectos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese vendedor"  maxlength="250"/>
							</div>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	<!--Autocomplete que contiene las encuestas activas-->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id de la encuesta seleccionada-->
								<input  class="form-control" 
										id="txtEncuestaIDBusq_encuestas_prospectos_mercadotecnia" 
										name="strEncuestaBusqID_encuestas_prospectos_mercadotecnia" 
										type="hidden" value="">
								</input>
								<label for="txtEncuestaBusq_encuestas_prospectos_mercadotecnia">Encuesta</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" 
										id="txtEncuestaBusq_encuestas_prospectos_mercadotecnia" 
										name="strEncuestaBusq_encuestas_prospectos_mercadotecnia" 
										type="text" 
										value="" 
										tabindex="1" 
										placeholder="Ingrese nombre de la encuesta" maxlength="250"/>
								</input>
							</div>
						</div>
					</div>
					<!--Autocomplete que contiene los módulos activos-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div class="form-group">
							<div class="col-md-12">
								<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo seleccionado-->
								<input id="txtModuloIDBusq_encuestas_prospectos_mercadotecnia" 
									   name="intModuloIDBusq_encuestas_prospectos_mercadotecnia"  type="hidden" 
									   value="">
								</input>
								<label for="txtModuloBusq_encuestas_prospectos_mercadotecnia">Módulo</label>
							</div>
							<div class="col-md-12">
								<input  class="form-control" id="txtModuloBusq_encuestas_prospectos_mercadotecnia" 
										name="strModuloBusq_encuestas_prospectos_mercadotecnia" type="text" value="" tabindex="1" placeholder="Ingrese módulo" maxlength="250">
								</input>
							</div>
						</div>
					</div>
					<!--Botones-->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
						<div id="ToolBtns" class="btn-group btn-toolBtns">
							<!--Buscar registros-->
							<button class="btn btn-primary" id="btnBuscar_encuestas_prospectos_mercadotecnia"
									onclick="paginacion_encuestas_prospectos_mercadotecnia();" 
									title="Buscar coincidencias" tabindex="1"> 
								<span class="glyphicon glyphicon-search"></span>
						    </button>
							<!--Dar de alta un nuevo registro-->
							<button class="btn btn-info" id="btnNuevo_encuestas_prospectos_mercadotecnia" 
									title="Nuevo registro" tabindex="1"> 
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>   
							<!--Generar PDF con el listado de registros-->
							<button class="btn btn-default"  id="btnImprimir_encuestas_prospectos_mercadotecnia"
									onclick="reporte_encuestas_prospectos_mercadotecnia();" 
									title="Imprimir reporte general en PDF" tabindex="1">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con el listado de registros-->
							<button class="btn btn-success"  id="btnDescargarXLS_encuestas_prospectos_mercadotecnia"
									onclick="descargar_xls_encuestas_prospectos_mercadotecnia();" title="Descargar reporte general en XLS" tabindex="1">
								<span class="fa fa-file-excel-o"></span>
							</button>
						</div>
					</div>
			    </div>
			    <div class="row">
			    	
			    </div>
			    <!-- /.row -->
			</form><!--Cierre del formulario-->
		</div><!--Cierre de barra de herramientas-->
		<!--Estilo que se utiliza para mostrar los nombres de las columnas de la tabla en el dispositivo móvil -->
		<style>
			@media (max-width: 480px) 
			{
			    /*
				Definir columnas de la tabla encuestas_prospectos
				*/
				td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
				td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
				td.movil.a3:nth-of-type(3):before {content: "Prospecto"; font-weight: bold;}
				td.movil.a4:nth-of-type(4):before {content: "Encuesta"; font-weight: bold;}
				td.movil.a5:nth-of-type(5):before {content: "Módulo"; font-weight: bold;}
				td.movil.a6:nth-of-type(6):before {content: "Estatus"; font-weight: bold;}
				td.movil.a7:nth-of-type(7):before {content: "Acciones"; font-weight: bold;}

				/*
				Definir columnas de la tabla detalles_encuesta
				*/
				td.movil.b1:nth-of-type(1):before {content: "Pregunta"; font-weight: bold;}
				td.movil.b2:nth-of-type(2):before {content: "Respuesta"; font-weight: bold;}
				td.movil.b3:nth-of-type(3):before {content: "Acciones"; font-weight: bold;}

			}
		</style>
		<!--Panel que contiene la tabla con los registros encontrados-->
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table class="table-hover movil" id="dg_encuestas_prospectos_mercadotecnia">
					<thead class="movil">
						<tr class="movil">
							<th class="movil">Folio</th>
							<th class="movil">Fecha</th>
							<th class="movil">Prospecto</th>
							<th class="movil">Encuesta</th>
							<th class="movil">Módulo</th>
							<th class="movil">Estatus</th>
							<th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
						</tr>
					</thead>
					<tbody class="movil"></tbody>
					<script id="plantilla_encuestas_prospectos_mercadotecnia" type="text/template"> 
					{{#rows}}
						<tr class="movil {{estiloRegistro}}">   
							<td class="movil a1">{{folio}}</td>
							<td class="movil a2">{{fecha}}</td>
							<td class="movil a3">{{prospecto}}</td>
							<td class="movil a4">{{encuesta}}</td>
							<td class="movil a5">{{modulo}}</td>
							<td class="movil a6">{{estatus}}</td>
							<td class="td-center movil a7"> 
								<!--Editar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
										onclick="editar_encuestas_prospectos_mercadotecnia({{encuesta_prospecto_id}})" title="Editar">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
								<!--Ver registro-->
                            	<button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}" 
                            			 onclick="editar_encuestas_prospectos_mercadotecnia({{encuesta_prospecto_id}});" title="Ver">
                            		<span class="glyphicon glyphicon-eye-open"></span>
                            	</button>
								<!--Generar PDF con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
										onclick="reporte_registro_encuestas_prospectos_mercadotecnia({{encuesta_prospecto_id}})" title="Imprimir registro en PDF">
									<span class="glyphicon glyphicon-print"></span>
								</button>
								<!--Descargar archivo XLS con los datos del registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionXLS}}"  
										onclick="descargar_xls_registro_encuestas_prospectos_mercadotecnia({{encuesta_prospecto_id}})" 
										title="Descargar registro en XLS">
									<span class="fa fa-file-excel-o"></span>
								</button>
								<!--Desactivar registro-->
								<button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
										onclick="cambiar_estatus_encuestas_prospectos_mercadotecnia({{encuesta_prospecto_id}},'{{estatus}}')" title="Desactivar">
									<span class="glyphicon glyphicon-ban-circle"></span>
								</button>
								<!--Restaurar registro-->
								<button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
										onclick="cambiar_estatus_encuestas_prospectos_mercadotecnia({{encuesta_prospecto_id}},'{{estatus}}')"  title="Restaurar">
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
					<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_encuestas_prospectos_mercadotecnia"></div>
					<!--Número de registros encontrados-->
					<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<button class="btn btn-default btn-sm disabled pull-right">
							<strong id="numElementos_encuestas_prospectos_mercadotecnia">0</strong> encontrados
						</button>
					</div>
				</div> <!--Cierre del diseño de la paginación-->
			</div><!--#container-fluid-->
		</div><!--Cierre del contenedor de la tabla-->

		<!-- Diseño del modal Encuesta-Prospecto-->
		<div id="EncuestasProspectosMercadotecniaBox" class="ModalBody" tabindex="-1">
			<!--Título-->
			<div id="divEncabezadoModal_encuestas_prospectos_mercadotecnia"  class="ModalBodyTitle">
				<h1>Encuestas</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmEncuestasProspectosMercadotecnia" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmEncuestasProspectosMercadotecnia"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtEncuestaProspectoID_encuestas_prospectos_mercadotecnia" 
										   name="intEncuestaProspectoID_encuestas_prospectos_mercadotecnia" 
										   type="hidden" value="">
									</input>
									<label for="txtFolio_encuestas_prospectos_mercadotecnia">Folio</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtFolio_encuestas_prospectos_mercadotecnia" 
											name="strFolio_encuestas_prospectos_mercadotecnia" 
											type="text"
											disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene las encuestas activas-->
						<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id de la encuesta seleccionada-->
									<input id="txtEncuestaID_encuestas_prospectos_mercadotecnia" 
									       name="intEncuestaID_encuestas_prospectos_mercadotecnia" type="hidden" value="">
									</input>
									<label for="txtEncuesta_encuestas_prospectos_mercadotecnia">Encuesta</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtEncuesta_encuestas_prospectos_mercadotecnia" 
											name="strEncuesta_encuestas_prospectos_mercadotecnia"
											placeholder="Ingrese encuesta" 
											type="text">
									</input>
								</div>
							</div>
						</div>
						<!--Módulo-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del módulo de la encuesta-->
									<input id="txtModuloID_encuestas_prospectos_mercadotecnia" 
										   name="intModuloID_encuestas_prospectos_mercadotecnia"  type="hidden" 
										   value="">
									</input>
									<label for="txtModulo_encuestas_prospectos_mercadotecnia">Módulo</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtModulo_encuestas_prospectos_mercadotecnia" 
											name="strModulo_encuestas_prospectos_mercadotecnia" type="text" value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Fecha-->
						<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtFecha_encuestas_prospectos_mercadotecnia">Fecha</label>
								</div>
								<div id="divFechaMsjValidacion" class="col-md-12">
									<div class='input-group date' id='dteFecha_encuestas_prospectos_mercadotecnia'>
					                    <input class="form-control" id="txtFecha_encuestas_prospectos_mercadotecnia"
					                    		name= "strFecha_encuestas_prospectos_mercadotecnia" 
					                    		type="text" 
					                    		value="" 
					                    		placeholder="Ingrese fecha" 
					                    		maxlength="10"/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
								</div>
							</div>
						</div>
						
					</div>
					<!--/.row-->
				    <div class="row">
				   		<!--Autocomplete que contiene los prospectos activos-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del prospecto seleccionado-->
									<input id="txtProspectoID_encuestas_prospectos_mercadotecnia" 
									       name="intProspectoID_encuestas_prospectos_mercadotecnia" 
									       type="hidden" 
									       value="">
									</input>
									<label for="txtProspecto_encuestas_prospectos_mercadotecnia">Prospecto</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtProspecto_encuestas_prospectos_mercadotecnia" 
											name="strProspecto_encuestas_prospectos_mercadotecnia" 
											type="text" 
											placeholder="Ingrese prospecto" 
											maxlength="250" />
								</div>
							</div>
						</div>
						<!--Autocomplete que contiene los vendedores activos-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del vendedor seleccionado-->
									<input id="txtVendedorID_encuestas_prospectos_mercadotecnia" 
									       name="intVendedorID_encuestas_prospectos_mercadotecnia" 
									       type="hidden" value="">
									</input>
									<label for="txtVendedor_encuestas_prospectos_mercadotecnia">Vendedor</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtVendedor_encuestas_prospectos_mercadotecnia" 
											name="strVendedor_encuestas_prospectos_mercadotecnia" 
											type="text" 
											placeholder="Ingrese vendedor" 
											maxlength="250" />
								</div>
							</div>
						</div>
						<!--Télefono-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTelefonoProspecto_encuestas_prospectos_mercadotecnia">Télefono</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" id="txtTelefonoProspecto_encuestas_prospectos_mercadotecnia" 
											name="strTelefonoProspecto_encuestas_prospectos_mercadotecnia" type="text" 
											value="" disabled>
									</input>
								</div>
							</div>
						</div>
						<!--Celular-->
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtSecundarioProspecto_encuestas_prospectos_mercadotecnia">Secundario</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtSecundarioProspecto_encuestas_prospectos_mercadotecnia" 
											name="strSecundarioProspecto_encuestas_prospectos_mercadotecnia" 
											type="text" 
											value="" 
											disabled>
									</input>
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Nombre del contacto-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtNombreContacto_encuestas_prospectos_mercadotecnia">Nombre del contacto</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtNombreContacto_encuestas_prospectos_mercadotecnia" 
											name="strNombreContacto_encuestas_prospectos_mercadotecnia" 
											type="text" 
											value="" 
											disabled />
								</div>
							</div>
						</div>
						<!--Teléfono del contacto-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtTelefonoContacto_encuestas_prospectos_mercadotecnia">Teléfono del contacto</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtTelefonoContacto_encuestas_prospectos_mercadotecnia" 
											name="strTelefonoContacto_encuestas_prospectos_mercadotecnia" 
											type="text" 
											value="" 
											disabled />
								</div>
							</div>
						</div>
						<!--Celular del contacto-->
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtCelularContacto_encuestas_prospectos_mercadotecnia">Celular del contacto</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtCelularContacto_encuestas_prospectos_mercadotecnia" 
											name="strCelularContacto_encuestas_prospectos_mercadotecnia" 
											type="text" 
											value="" 
											disabled />
								</div>
							</div>
						</div>
				    </div>
				    <div class="row">
				    	<!--Observaciones-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtObservaciones_encuestas_prospectos_mercadotecnia">Observaciones</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtObservaciones_encuestas_prospectos_mercadotecnia" 
											name="strObservaciones_encuestas_prospectos_mercadotecnia" 
											type="text" 
											placeholder="Ingrese observaciones" maxlength="250">
									</input>
								</div>
							</div>
						</div>
				    </div>
				     <div class="row">
						<div class="col-md-12">
							<h4>Detalles de la encuesta</h4>
							<!-- Diseño de la tabla-->
							<table class="table-hover movil" id="dg_preguntas_encuestas_prospectos_mercadotecnia">
								<thead class="movil">
									<tr class="movil">
										<th class="movil">Pregunta</th>
										<th class="movil">Respuesta</th>
										<th class="movil" id="th-acciones" style="width:5em;">Acciones</th>
									</tr>
								</thead>
								<tbody class="movil"></tbody>
								<script id="plantilla_preguntas_encuestas_prospectos_mercadotecnia" type="text/template"> 
								{{#rows}}
									<tr class="movil {{estiloRegistro}}">   
										<td class="movil b1">{{pregunta}}</td>
										<td class="movil b2">{{respuesta}}</td>
										<td class="td-center movil b3"> 
											<!--Editar registro-->
											<button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
													onclick="respuesta_encuestas_prospectos_mercadotecnia({{renglon}});"  title="Asignar respuesta">
												<span class="glyphicon glyphicon-question-sign"></span>
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
								<div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" 
									id="pagLinks_preguntas_encuestas_prospectos_mercadotecnia">		
								</div>
								<!--Número de registros encontrados-->
								<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
									<button class="btn btn-default btn-sm disabled pull-right">
										<strong id="numElementos_preguntas_encuestas_prospectos_mercadotecnia">0</strong> encontrados
									</button>
								</div>
							</div> <!--Cierre del diseño de la paginación-->											
						</div>
					</div>
				    <br>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_encuestas_prospectos_mercadotecnia"  
									onclick="validar_encuestas_prospectos_mercadotecnia();"  title="Guardar">
								<span class="fa fa-floppy-o"></span>
							</button>
							<!--Generar PDF con los datos del registro-->
							<button class="btn btn-default"  id="btnImprimirRegistro_encuestas_prospectos_mercadotecnia"
									onclick="reporte_registro_encuestas_prospectos_mercadotecnia('');" 
									title="Imprimir registro en PDF">
								<span class="glyphicon glyphicon-print"></span>
							</button>
							<!--Descargar archivo XLS con los datos del registro-->
							<button class="btn btn-default"  id="btnDescargarXLSRegistro_encuestas_prospectos_mercadotecnia"
									onclick="descargar_xls_registro_encuestas_prospectos_mercadotecnia('');" title="Descargar registro en XLS">
								<span class="fa fa-file-excel-o"></span>
							</button>
							<!--Desactivar registro-->
							<button class="btn btn-default" id="btnDesactivar_encuestas_prospectos_mercadotecnia"  
									onclick="cambiar_estatus_encuestas_prospectos_mercadotecnia('','ACTIVO');"  title="Desactivar">
								<span class="glyphicon glyphicon-ban-circle"></span>
							</button>
							<!--Restaurar registro-->
							<button class="btn btn-default" id="btnRestaurar_encuestas_prospectos_mercadotecnia"  
									onclick="cambiar_estatus_encuestas_prospectos_mercadotecnia('','INACTIVO');"  title="Restaurar">
								<span class="fa fa-exchange"></span>
							</button> 
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_encuestas_prospectos_mercadotecnia"
									type="reset" aria-hidden="true" onclick="cerrar_encuestas_prospectos_mercadotecnia();" 
									title="Cerrar">
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form><!--Cierre del formulario-->
			</div><!--Cierre del contenido-->
		</div><!--Cierre del modal Encuestas Prospectos-->

		<!-- Diseño del modal Encuesta-Prospecto-Respuesta -->
		<div id="EncuestaRespuestasMercadotecniaBox" class="ModalBody" tabindex="-1">
			<!--Título-->
			<div id="divEncabezadoModal_respuestas_encuestas_prospectos_mercadotecnia"  class="ModalBodyTitle">
				<h1>Respuestas</h1>
			</div>
			<!--Contenido-->
			<div class="ModalBodyContent">
				<!--Diseño del formulario-->
				<form id="frmRespuestasEncuestasProspectosMercadotecnia" method="post" action="#" class="form-horizontal" 
					  role="form"  name="frmRespuestasEncuestasProspectosMercadotecnia"  onsubmit="return(false)" 
					  autocomplete="off">
					<div class="row">
						<!--Folio-->
						<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
									<!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
									<input id="txtRenglonPregunta_encuestas_prospectos_mercadotecnia" 
										   name="intRenglonPregunta_encuestas_prospectos_mercadotecnia" 
										   type="hidden" />
									<label for="txtPregunta_encuestas_prospectos_mercadotecnia">Pregunta</label>
								</div>
								<div class="col-md-12">
									<div class="col-md-10">
										<input  class="form-control" 
											id="txtPregunta_encuestas_prospectos_mercadotecnia" 
											name="strFolio_encuestas_prospectos_mercadotecnia" 
											type="text"
											disabled />
									</div>
									<div class="col-md-2">
										<button class="btn btn-default" 
												id="btnPreguntaAnterior_encuestas_prospectos_mercadotecnia"  
												onclick="anterior_pregunta_encuestas_prospectos_mercadotecnia()"  
												title="Pregunta anterior" >
											<span class="glyphicon glyphicon-arrow-left"></span>
										</button>
										<button class="btn btn-default" 
												id="btnPreguntaSiguiente_encuestas_prospectos_mercadotecnia"  
												onclick="siguiente_pregunta_encuestas_prospectos_mercadotecnia('boton')"  
												title="Pregunta siguiente" >
											<span class="glyphicon glyphicon-arrow-right"></span>
										</button>
									</div>		
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label for="cmbRespuestas_encuestas_prospectos_mercadotecnia">Respuesta</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" 
										id="cmbRespuestas_encuestas_prospectos_mercadotecnia" 
										name="intRespuestas_encuestas_prospectos_mercadotecnia">
									</select>	
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label for="txtComentarios_encuestas_prospectos_mercadotecnia">Comentarios</label>
								</div>
								<div class="col-md-12">
									<input  class="form-control" 
											id="txtComentarios_encuestas_prospectos_mercadotecnia" 
											name="strComentarios_encuestas_prospectos_mercadotecnia" 
											type="text" maxlength="250">
									</input>
								</div>
							</div>
						</div>
					</div>
					<br>
					<!--Botones de acción (barra de tareas)-->
					<div class="btn-group row footerModal">
						<div class="col-md-12">
							<!--Guardar registro-->
							<button class="btn btn-success" id="btnGuardar_respuestas_encuestas_prospectos_mercadotecnia"  
									onclick="validar_respuestas_encuestas_prospectos_mercadotecnia();"  title="Guardar" >
								<span class="fa fa-floppy-o"></span>
							</button> 
							<!--Cerrar modal-->
							<button class="btn  btn-cerrar"  id="btnCerrar_respuestas_encuestas_prospectos_mercadotecnia"
									type="reset" aria-hidden="true" onclick="cerrar_respuestas_encuestas_prospectos_mercadotecnia();" 
									title="Cerrar" >
								<span class="fa fa-times"></span>
							</button>
						</div>
					</div>
				</form>			
			</div>
		</div><!--Cierre del modal Encuesta-Prospecto-Respuesta -->


	</div><!--#EncuestasProspectosMercadotecniaContent -->

	<!--Javascript con las funciones del formulario-->
	<script type="text/javascript">
		/*******************************************************************************************************************
		Funciones del formulario principal
		*********************************************************************************************************************/
		//Variables que se utilizan para la paginación de registros
		var intPaginaEncuestasProspectosMercadotecnia = 0;
		var strUltimaBusquedaEncuestasProspectosMercadotecnia = "";
		//Variables que se utilizan para la búsqueda de registros
		var intProspectoIDEncuestasProspectosMercadotecnia = "";
		var intVendedorIDEncuestasProspectosMercadotecnia = "";
		var intEncuestaIDEncuestasProspectosMercadotecnia = "";
		var intModuloIDEncuestasProspectosMercadotecnia = "";
		var dteFechaInicialEncuestasProspectosMercadotecnia = "";
		var dteFechaFinalEncuestasProspectosMercadotecnia = "";
		//Variable que se utiliza para asignar objeto del modal Encuestas
		var objEncuestasProspectosMercadotecnia = null;
		//Variable que se utiliza para asignar objeto del modal Respuestas
		var objRespuestasEncuestasProspectosMercadotecnia = null;

		/*******************************************************************************************************************
		Funciones del objeto ProspectoEncuesta
		*********************************************************************************************************************/
		// Constructor de ProspectoEncuesta
		var objEncuestaProspecto;
		function ProspectoEncuesta(id, folio, fecha, encuesta_id, prospecto_id, vendedor_id, observaciones, preguntas_respuestas){
			this.intEncuestaProspectoID = id;
			this.intFolio = folio;
			this.strFecha = fecha;
			this.intEncuestaID = encuesta_id;
			this.intProspectoID = prospecto_id;
			this.intVendedorID = vendedor_id;
			this.strObservaciones = observaciones;
			this.arrPreguntasRespuestas = preguntas_respuestas;
		}
	    // --------------------- MÉTODOS PARA EL OBJETO PROSPECTO ENCUESTA -------------------------------------------------
	    ProspectoEncuesta.prototype.setID = function(id) { return this.intEncuestaProspectoID = id; }
	    ProspectoEncuesta.prototype.getID = function() { return this.intEncuestaProspectoID; }
	    ProspectoEncuesta.prototype.setFolio = function(folio) { return this.intFolio = folio; }
	    ProspectoEncuesta.prototype.getFolio = function() { return this.intFolio; }
	    ProspectoEncuesta.prototype.setFecha = function(fecha) { return this.strFecha = fecha; }
	    ProspectoEncuesta.prototype.getFecha = function() { return this.strFecha; }
	    ProspectoEncuesta.prototype.setEncuestaID = function(encuesta_id) { return this.intEncuestaID = encuesta_id; }
	    ProspectoEncuesta.prototype.getEncuestaID = function() { return this.intEncuestaID; }
	    ProspectoEncuesta.prototype.setProspectoID = function(prospecto_id) { return this.intProspectoID = prospecto_id; }
	    ProspectoEncuesta.prototype.getProspectoID = function() { return this.intProspectoID; }
	    ProspectoEncuesta.prototype.setVendedorID = function(vendedor_id) { return this.intVendedorID = vendedor_id; }
	    ProspectoEncuesta.prototype.getVendedorID = function() { return this.intVendedorID; }
	    ProspectoEncuesta.prototype.setObservaciones = function(observaciones) { return this.strObservaciones = observaciones; }
	    ProspectoEncuesta.prototype.getObservaciones = function() { return this.strObservaciones; }
	    ProspectoEncuesta.prototype.setPreguntasRespuestas = function(preguntas_respuestas) { 
	    	return this.arrPreguntasRespuestas = preguntas_respuestas; 
	    }
	    ProspectoEncuesta.prototype.getPreguntasRespuestas = function() { 
	    	return this.arrPreguntasRespuestas; 
	    }
	    //Función para agregar una pregunta al objeto Encuesta
		ProspectoEncuesta.prototype.setPreguntaRespuesta = function (index, respuesta, comentarios){
			this.arrPreguntasRespuestas[index][1] = respuesta; //Actualizamos la respuesta
			this.arrPreguntasRespuestas[index][2] = comentarios ; //Actualizamos la respuesta
		}
		//Función para obtener una pregunta del objeto Encuesta
		ProspectoEncuesta.prototype.getPreguntaRespuesta = function(index) {
		    return this.arrPreguntasRespuestas[index];
		}

		/*******************************************************************************************************************
		Funciones del objeto Encuesta
		*********************************************************************************************************************/
		// Constructor de Encuesta
		var objEncuesta;
		function Encuesta(id, preguntas)
		{
		    this.intEncuestaID = id;
		    this.arrPreguntas = preguntas;
		}
		// --------------------- MÉTODOS PARA EL OBJETO ENCUESTA ------------------------------------------------------------
		Encuesta.prototype.getID = function() { return this.intEncuestaID; }
		// -------------------- FUNCIONES ASOCIADAS AL ATRIBUTO PREGUNTAS ---------------------------------------------------
		//Función para obtener todas las preguntas del objeto Encuesta
		Encuesta.prototype.getPreguntas = function() { return this.arrPreguntas; }
		//Función para obtener una pregunta del objeto Encuesta
		Encuesta.prototype.getPregunta = function(index) { return this.arrPreguntas[index][0]; }
		Encuesta.prototype.getRespuestas = function(index) { return this.arrPreguntas[index][1]; }

		//Permisos  de acceso del usuario (Acciones Generales)
		function permisos_encuestas_prospectos_mercadotecnia()
		{
			//Hacer un llamado al método del controlador para regresar los permisos de acceso
			$.post('mercadotecnia/encuestas_prospectos/get_permisos_acceso',
			{ 
				strPermisosAcceso: $('#txtAcciones_encuestas_prospectos_mercadotecnia').val()
			},
			function(data){
				//Si existen permisos de acceso del usuario para este proceso
				if (data.row)
				{
					//Asignar a la variable la cadena concatenada con los permisos de acceso
					//del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
					var strPermisosEncuestasProspectosMercadotecnia = data.row;
					//Separar la cadena 
					var arrPermisosEncuestasProspectosMercadotecnia = strPermisosEncuestasProspectosMercadotecnia.split('|');

					//Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
					for (var i=0; i < arrPermisosEncuestasProspectosMercadotecnia.length; i++)
					{
						//Habilitar Acción si se cuenta con  permiso de acceso
						if(arrPermisosEncuestasProspectosMercadotecnia[i]=='NUEVO')//Si el indice es NUEVO
						{
							//Habilitar el control (botón nuevo)
							$('#btnNuevo_encuestas_prospectos_mercadotecnia').removeAttr('disabled');
						}
						//Si el indice es GUARDAR ó EDITAR (modificar)
						else if((arrPermisosEncuestasProspectosMercadotecnia[i]=='GUARDAR') || (arrPermisosEncuestasProspectosMercadotecnia[i]=='EDITAR'))
						{
							//Habilitar el control (botón guardar)
							$('#btnGuardar_encuestas_prospectos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEncuestasProspectosMercadotecnia[i]=='BUSCAR')//Si el indice es BUSCAR
						{
							//Habilitar el control (botón buscar)
							$('#btnBuscar_encuestas_prospectos_mercadotecnia').removeAttr('disabled');
							//Hacer llamado a la función  para cargar  los registros en el grid
							paginacion_encuestas_prospectos_mercadotecnia();
						}
						else if(arrPermisosEncuestasProspectosMercadotecnia[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
						{
							//Habilitar los siguientes controles
							$('#btnDesactivar_encuestas_prospectos_mercadotecnia').removeAttr('disabled');
							$('#btnRestaurar_encuestas_prospectos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEncuestasProspectosMercadotecnia[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimir_encuestas_prospectos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEncuestasProspectosMercadotecnia[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
						{
							//Habilitar el control (botón imprimir)
							$('#btnImprimirRegistro_encuestas_prospectos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEncuestasProspectosMercadotecnia[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLS_encuestas_prospectos_mercadotecnia').removeAttr('disabled');
						}
						else if(arrPermisosEncuestasProspectosMercadotecnia[i]=='DESCARGAR XLS REGISTRO')//Si el indice es DESCARGAR XLS REGISTRO
						{
							//Habilitar el control (botón descargar XLS)
							$('#btnDescargarXLSRegistro_encuestas_prospectos_mercadotecnia').removeAttr('disabled');
						}
					}//Cerrar for
				}
			},
			'json');
		}

		//Función para la búsqueda de registros
		function paginacion_encuestas_prospectos_mercadotecnia() 
		{
			
			//Concatenar datos para la nueva búsqueda
   			var strNuevaBusquedaEncuestasProspectosMercadotecnia =($('#txtFechaInicialBusq_encuestas_prospectos_mercadotecnia').val()+$('#txtFechaFinalBusq_encuestas_prospectos_mercadotecnia').val()+$('#txtProspectoIDBusq_encuestas_prospectos_mercadotecnia').val()+$('#txtVendedorIDBusq_encuestas_prospectos_mercadotecnia').val()+$('#txtEncuestaIDBusq_encuestas_prospectos_mercadotecnia').val()+$('#txtModuloIDBusq_encuestas_prospectos_mercadotecnia').val());

			//Verificar si hubo cambios en la búsqueda
			if(strNuevaBusquedaEncuestasProspectosMercadotecnia != strUltimaBusquedaEncuestasProspectosMercadotecnia)
			{
				intPaginaEncuestasProspectosMercadotecnia = 0;
				strUltimaBusquedaEncuestasProspectosMercadotecnia = strNuevaBusquedaEncuestasProspectosMercadotecnia;
			}

			//Hacer un llamado al método del controlador para regresar listado de registros
			$.post('mercadotecnia/encuestas_prospectos/get_paginacion',
					{
					 //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
					 dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_encuestas_prospectos_mercadotecnia').val()),
					 dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_encuestas_prospectos_mercadotecnia').val()),
					 intProspectoID: $('#txtProspectoIDBusq_encuestas_prospectos_mercadotecnia').val(),
					 intVendedorID: $('#txtVendedorIDBusq_encuestas_prospectos_mercadotecnia').val(),
					 intEncuestaID: $('#txtEncuestaIDBusq_encuestas_prospectos_mercadotecnia').val(),
					 intModuloID: $('#txtModuloIDBusq_encuestas_prospectos_mercadotecnia').val(),
					 intPagina: intPaginaEncuestasProspectosMercadotecnia,
					 strPermisosAcceso: $('#txtAcciones_encuestas_prospectos_mercadotecnia').val()
					},
					function(data){
						$('#dg_encuestas_prospectos_mercadotecnia tbody').empty();
						var tmpEncuestasProspectosMercadotecnia = Mustache.render($('#plantilla_encuestas_prospectos_mercadotecnia').html(),data);
						$('#dg_encuestas_prospectos_mercadotecnia tbody').html(tmpEncuestasProspectosMercadotecnia);
						$('#pagLinks_encuestas_prospectos_mercadotecnia').html(data.paginacion);
						$('#numElementos_encuestas_prospectos_mercadotecnia').html(data.total_rows);
						intPaginaEncuestasProspectosMercadotecnia = data.pagina;
					},
			'json');

		}

		//Función para cargar el reporte general en PDF
		function reporte_encuestas_prospectos_mercadotecnia() 
		{
			//Asignar valores para la búsqueda de registros
			intProspectoIDEncuestasProspectosMercadotecnia = $('#txtProspectoIDBusq_encuestas_prospectos_mercadotecnia').val();
			intVendedorIDEncuestasProspectosMercadotecnia = $('#txtVendedorIDBusq_encuestas_prospectos_mercadotecnia').val();
			intEncuestaIDEncuestasProspectosMercadotecnia = $('#txtEncuestaIDBusq_encuestas_prospectos_mercadotecnia').val();
			intModuloIDEncuestasProspectosMercadotecnia = $('#txtModuloIDBusq_encuestas_prospectos_mercadotecnia').val();
			dteFechaInicialEncuestasProspectosMercadotecnia =$.formatFechaMysql($('#txtFechaInicialBusq_encuestas_prospectos_mercadotecnia').val());
			dteFechaFinalEncuestasProspectosMercadotecnia = $.formatFechaMysql($('#txtFechaFinalBusq_encuestas_prospectos_mercadotecnia').val());

			//Si no existe fecha inicial
			if(dteFechaInicialEncuestasProspectosMercadotecnia == '')
			{
				dteFechaInicialEncuestasProspectosMercadotecnia = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalEncuestasProspectosMercadotecnia == '')
			{
				dteFechaFinalEncuestasProspectosMercadotecnia =  '0000-00-00';
			}

			//Si no existe id del prospecto
			if(intProspectoIDEncuestasProspectosMercadotecnia == '')
			{
				intProspectoIDEncuestasProspectosMercadotecnia = 0;
			}

			//Si no existe id del vendedor
			if(intVendedorIDEncuestasProspectosMercadotecnia == '')
			{
				intVendedorIDEncuestasProspectosMercadotecnia = 0;
			}

			//Si no existe id de la encuesta
			if(intEncuestaIDEncuestasProspectosMercadotecnia == '')
			{
				intEncuestaIDEncuestasProspectosMercadotecnia = 0;
			}

			//Si no existe id del módulo
			if(intModuloIDEncuestasProspectosMercadotecnia == '')
			{
				intModuloIDEncuestasProspectosMercadotecnia = 0;
			}
			
			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("mercadotecnia/encuestas_prospectos/get_reporte/"+dteFechaInicialEncuestasProspectosMercadotecnia+"/"+dteFechaFinalEncuestasProspectosMercadotecnia+"/"+intProspectoIDEncuestasProspectosMercadotecnia+"/"+intVendedorIDEncuestasProspectosMercadotecnia+"/"+intEncuestaIDEncuestasProspectosMercadotecnia+"/"+intModuloIDEncuestasProspectosMercadotecnia);
		}

		//Función para cargar el reporte de un registro en PDF
		function reporte_registro_encuestas_prospectos_mercadotecnia(id)
		{	
			//Variable que se utiliza para asignar id de la encuesta
			var intEncuestaProspectoID = 0;
			
			//Dependiendo del tipo de formulario asignar id
			if(id == '')
				intEncuestaProspectoID = objEncuestaProspecto.getID();
			else
				intEncuestaProspectoID = id;

			//Hacer un llamado al método del controlador para generar reporte PDF
			window.open("mercadotecnia/encuestas_prospectos/get_reporte_registro/" + intEncuestaProspectoID);
		}

		//Función para cargar el reporte general en XLS
		function descargar_xls_encuestas_prospectos_mercadotecnia(){

			//Asignar valores para la búsqueda de registros
			intProspectoIDEncuestasProspectosMercadotecnia = $('#txtProspectoIDBusq_encuestas_prospectos_mercadotecnia').val();
			intVendedorIDEncuestasProspectosMercadotecnia = $('#txtVendedorIDBusq_encuestas_prospectos_mercadotecnia').val();
			intEncuestaIDEncuestasProspectosMercadotecnia = $('#txtEncuestaIDBusq_encuestas_prospectos_mercadotecnia').val();
			intModuloIDEncuestasProspectosMercadotecnia = $('#txtModuloIDBusq_encuestas_prospectos_mercadotecnia').val();
			dteFechaInicialEncuestasProspectosMercadotecnia =$.formatFechaMysql($('#txtFechaInicialBusq_encuestas_prospectos_mercadotecnia').val());
			dteFechaFinalEncuestasProspectosMercadotecnia = $.formatFechaMysql($('#txtFechaFinalBusq_encuestas_prospectos_mercadotecnia').val());

			//Si no existe fecha inicial
			if(dteFechaInicialEncuestasProspectosMercadotecnia == '')
			{
				dteFechaInicialEncuestasProspectosMercadotecnia = '0000-00-00';
			}

			//Si no existe fecha final
			if(dteFechaFinalEncuestasProspectosMercadotecnia == '')
			{
				dteFechaFinalEncuestasProspectosMercadotecnia =  '0000-00-00';
			}

			//Si no existe id del prospecto
			if(intProspectoIDEncuestasProspectosMercadotecnia == '')
			{
				intProspectoIDEncuestasProspectosMercadotecnia = 0;
			}

			//Si no existe id del vendedor
			if(intVendedorIDEncuestasProspectosMercadotecnia == '')
			{
				intVendedorIDEncuestasProspectosMercadotecnia = 0;
			}

			//Si no existe id de la encuesta
			if(intEncuestaIDEncuestasProspectosMercadotecnia == '')
			{
				intEncuestaIDEncuestasProspectosMercadotecnia = 0;
			}

			//Si no existe id del módulo
			if(intModuloIDEncuestasProspectosMercadotecnia == '')
			{
				intModuloIDEncuestasProspectosMercadotecnia = 0;
			}
			
			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
			window.open("mercadotecnia/encuestas_prospectos/get_xls/"+dteFechaInicialEncuestasProspectosMercadotecnia+"/"+dteFechaFinalEncuestasProspectosMercadotecnia+"/"+intProspectoIDEncuestasProspectosMercadotecnia+"/"+intVendedorIDEncuestasProspectosMercadotecnia+"/"+intEncuestaIDEncuestasProspectosMercadotecnia+"/"+intModuloIDEncuestasProspectosMercadotecnia);
		}

		//Función para descargar el reporte de un registro en XLS
		function descargar_xls_registro_encuestas_prospectos_mercadotecnia(id) 
		{
			//Variable que se utiliza para asignar id de la encuesta
			var intEncuestaProspectoID = 0;
			
			//Dependiendo del tipo de formulario asignar id
			if(id == '')
				intEncuestaProspectoID = objEncuestaProspecto.getID();
			else
				intEncuestaProspectoID = id;

			//Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
			window.open("mercadotecnia/encuestas_prospectos/get_xls_registro/" + intEncuestaProspectoID);
		
		}

		// Función para cambiar el estatus del registro seleccionado
		function cambiar_estatus_encuestas_prospectos_mercadotecnia(id, estatus)
		{
			//Variable que se utiliza para asignar el id del registro
			var intID = 0;
			//Si no existe id, significa que se realizará la modificación desde el modal
			if(id == '')
			{
				intID = objEncuestaProspecto.getID();

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
						              'title':    'Encuestas',
						              'buttons':  ['Aceptar', 'Cancelar'],
						              'onClose':  function(caption) {
						                            if(caption == 'Aceptar')
						                            {
						                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
						                              $.post('mercadotecnia/encuestas_prospectos/set_estatus',
						                                     {intEncuestaProspectoID: intID,
						                                      strEstatus: estatus
						                                     },
						                                     function(data) {
						                                        if(data.resultado)
						                                        {
						                                          	//Hacer llamado a la función  para cargar  los registros en el grid
						                                          	paginacion_encuestas_prospectos_mercadotecnia();

						                                          	//Si el id del registro se obtuvo del modal
																	if(id == '')
																	{
																		//Hacer un llamado a la función para cerrar modal
																		cerrar_encuestas_prospectos_mercadotecnia();     
																	}
						                                        }
						                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						                                        mensaje_encuestas_prospectos_mercadotecnia(data.tipo_mensaje, data.mensaje);
						                                     },
						                                    'json');
						                            }
						                          }
						              });
		    }
		    else//Si el estatus del registro es INACTIVO
		    {
				//Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
				$.post('mercadotecnia/encuestas_prospectos/set_estatus',
				     {intEncuestaProspectoID: intID,
				      strEstatus: estatus
				     },
				     function(data) {
				      	if (data.resultado)
				      	{
				       	 	//Hacer llamado a la función para cargar  los registros en el grid
				      		paginacion_encuestas_prospectos_mercadotecnia();

				      		//Si el id del registro se obtuvo del modal
							if(id == '')
							{
								//Hacer un llamado a la función para cerrar modal
								cerrar_encuestas_prospectos_mercadotecnia();     
							}
				     	}
				      	//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
				        mensaje_encuestas_prospectos_mercadotecnia(data.tipo_mensaje, data.mensaje);
				     },
				     'json');
		    }
		}

		//Función para editar una encuesta aplicada
		function editar_encuestas_prospectos_mercadotecnia(encuesta_prospecto_id){
						
			//Hacer un llamado al método del controlador para regresar los datos del registro
			$.post('mercadotecnia/encuestas_prospectos/get_datos',
			       {
			       		intEncuestaProspectoID:encuesta_prospecto_id
			       },
			       function(data) {
			        	//Si hay datos del registro
			            if(data.row)
			            {
			            	var encuesta = data.row.encuesta; //Encuesta aplicada
			            	var preguntas_respuestas = data.row.preguntas_respuestas; //Preguntas y respuestas previamente aplicadas
			            	//Hacer un llamado a la función para limpiar los campos del formulario
							nuevo_encuestas_prospectos_mercadotecnia();
							//Asignar estatus del registro
				            var strEstatus = encuesta.estatus;
							//Cargar los datos del registro
							//Folio
							$('#txtFolio_encuestas_prospectos_mercadotecnia').val(encuesta.folio);
							//Encuesta
							$('#txtEncuestaID_encuestas_prospectos_mercadotecnia').val(encuesta.encuesta_id);
							$('#txtEncuesta_encuestas_prospectos_mercadotecnia').val(encuesta.encuesta);
							$('#txtModuloID_encuestas_prospectos_mercadotecnia').val(encuesta.modulo_id);
							$('#txtModulo_encuestas_prospectos_mercadotecnia').val(encuesta.modulo);
							//Fecha
							$('#txtFecha_encuestas_prospectos_mercadotecnia').val(encuesta.fecha);
							//Prospecto
							$('#txtProspectoID_encuestas_prospectos_mercadotecnia').val(encuesta.prospecto_id);
							$('#txtProspecto_encuestas_prospectos_mercadotecnia').val(encuesta.prospecto);
							$('#txtTelefonoProspecto_encuestas_prospectos_mercadotecnia').val(encuesta.telefono_principal);
							$('#txtSecundarioProspecto_encuestas_prospectos_mercadotecnia').val(encuesta.telefono_secundario);
							//Vendedor
							$('#txtVendedorID_encuestas_prospectos_mercadotecnia').val(encuesta.vendedor_id);
							$('#txtVendedor_encuestas_prospectos_mercadotecnia').val(encuesta.vendedor);
							//Información de contacto
							$('#txtNombreContacto_encuestas_prospectos_mercadotecnia').val(encuesta.contacto_nombre);
							$('#txtTelefonoContacto_encuestas_prospectos_mercadotecnia').val(encuesta.contacto_telefono);
							$('#txtCelularContacto_encuestas_prospectos_mercadotecnia').val(encuesta.contacto_celular);
							//Observaciones
							$('#txtObservaciones_encuestas_prospectos_mercadotecnia').val(encuesta.observaciones);

							//Deshabilitar inputs
							$("#txtEncuesta_encuestas_prospectos_mercadotecnia").prop('disabled', true);
							$("#txtFecha_encuestas_prospectos_mercadotecnia").prop('disabled', true);
							$("#txtProspecto_encuestas_prospectos_mercadotecnia").prop('disabled', true);
							$("#txtVendedor_encuestas_prospectos_mercadotecnia").prop('disabled', true);

							

							//Obtener preguntas de la Encuesta seleccionada
							$.post('mercadotecnia/encuestas/get_datos',
			                  { 
			                  	intEncuestaID:encuesta.encuesta_id
			                  },
			                  function(data) {
			                    if(data.preguntas){
			                       
			                       //Crear un objeto de tipo Encuesta y ProspectoEncuesta
			                       modificar_objeto_encuesta(encuesta, data.preguntas, preguntas_respuestas);
			                    
			                    }
			                  }
			                 ,
			                'json');	

			                //Dependiendo del estatus cambiar el color del encabezado 
							$('#divEncabezadoModal_encuestas_prospectos_mercadotecnia').addClass("estatus-" + strEstatus);

							//Mostrar los siguientes botones
							$("#btnImprimirRegistro_encuestas_prospectos_mercadotecnia").show();
							$("#btnDescargarXLSRegistro_encuestas_prospectos_mercadotecnia").show();

				            //Si el estatus del registro es ACTIVO
				            if(strEstatus == 'ACTIVO')
							{
								//Mostrar botón Desactivar
				            	$("#btnDesactivar_encuestas_prospectos_mercadotecnia").show();
							}
							else 
							{	
								//Deshabilitar todos los elementos del formulario
				            	$('#frmEncuestasProspectosMercadotecnia').find('input, textarea, select').attr('disabled','disabled');
				            	//Ocultar botón Guardar
					           	$("#btnGuardar_encuestas_prospectos_mercadotecnia").hide(); 
								//Mostrar botón Restaurar
								$("#btnRestaurar_encuestas_prospectos_mercadotecnia").show();
							}


							 //Abrir modal
							 objEncuestasProspectosMercadotecnia = $('#EncuestasProspectosMercadotecniaBox').bPopup({
														   appendTo: '#EncuestasProspectosMercadotecniaContent', 
							                               contentContainer: 'EncuestasProspectosMercadotecniaM', 
							                               zIndex: 1, 
							                               modalClose: false, 
							                               modal: true, 
							                               follow: [true,false], 
							                               followEasing : "linear", 
							                               easing: "linear", 
							                               modalColor: ('#F0F0F0')});

							//Enfocar caja de texto
							$('#txtObservaciones_encuestas_prospectos_mercadotecnia').focus();

			       	    }
			       },
			       'json');

		}	



		/*******************************************************************************************************************
		Funciones del modal Preguntas Encuestas
		*********************************************************************************************************************/

		//Función para crear un objeto de tipo encuesta en la vista
		function crear_objeto_encuesta(encuesta_id, preguntas){
			
			// Crear un Objeto de tipo Encuesta
			objEncuesta = new Encuesta(encuesta_id, preguntas);
			
			//Precargamos los renglones de preguntas
			var preguntas_respuestas = []; 
			for(var i=0; i<preguntas.length; i++)
				preguntas_respuestas.push([i+1, '', '']);
			
			//Crear un objeto de tipo ProspectoEncuesta
			objEncuestaProspecto = new ProspectoEncuesta();
			objEncuestaProspecto.setID('');
			objEncuestaProspecto.setEncuestaID(encuesta_id);
			objEncuestaProspecto.setPreguntasRespuestas(preguntas_respuestas);

			//Buscar preguntas correspondientes a esa Encuesta
			//Preguntar si al menos se encuentra una pregunta registrada para esa Encuesta		
			if(preguntas.length > 0){
				$.post('mercadotecnia/encuestas/get_preguntas',
						{	
							intEncuestaID:encuesta_id
						},
						function(data){

							$('#dg_preguntas_encuestas_prospectos_mercadotecnia tbody').empty();
							var tmpPreguntasEncuestasProspectosMercadotecnia = Mustache.render($('#plantilla_preguntas_encuestas_prospectos_mercadotecnia').html(),data);
							$('#dg_preguntas_encuestas_prospectos_mercadotecnia tbody').html(tmpPreguntasEncuestasProspectosMercadotecnia);
							$('#numElementos_preguntas_encuestas_prospectos_mercadotecnia').html(preguntas.length);
							
						},
				'json');
			}
			
		}

		function modificar_objeto_encuesta(encuesta, preguntas, respuestas){

			// Crear un Objeto de tipo Encuesta
			objEncuesta = new Encuesta(encuesta.encuesta_id, preguntas);
			//Crear un objeto de tipo ProspectoEncuesta
			var preguntas_respuestas = []; 
			objEncuestaProspecto = new ProspectoEncuesta();
			objEncuestaProspecto.setID(encuesta.encuesta_prospecto_id);
			objEncuestaProspecto.setEncuestaID(encuesta.encuesta_id);
			objEncuestaProspecto.setFolio(encuesta.folio);
            objEncuestaProspecto.setFecha(encuesta.fecha);
			objEncuestaProspecto.setProspectoID(encuesta.prospecto_id);
			objEncuestaProspecto.setVendedorID(encuesta.vendedor_id);
            objEncuestaProspecto.setObservaciones(encuesta.observaciones);			
			objEncuestaProspecto.setPreguntasRespuestas(preguntas_respuestas);   

			var resultado = { rows: [] };
			//Precargamos los renglones de preguntas si al menos existe una pregunta para esa encuesta
			if(preguntas.length > 0){

				for(var i=0; i<preguntas.length; i++){
					preguntas_respuestas.push([i+1, '', '']);
					resultado.rows.push({pregunta:preguntas[i][0], respuesta:'', renglon:i+1});
				}
				
				//Preguntamos si al menos fue contestada previamente una pregunta. Es decir, al menos existe una respuesta
				if(respuestas.length > 0){
	           		for(var i=0; i<respuestas.length; i++){
	           			for(var j=0; j<preguntas_respuestas.length; j++){
	           				if(respuestas[i].renglon_pregunta == preguntas_respuestas[j][0]){
	           					
	           					objEncuestaProspecto.setPreguntaRespuesta(j, respuestas[i].renglon, respuestas[i].comentarios);
	           					resultado.rows[j].respuesta = respuestas[i].respuesta;
	           				}
	           			}
	           		}
	            }
 
	            $('#dg_preguntas_encuestas_prospectos_mercadotecnia tbody').empty();
				var tmpPreguntasEncuestasProspectosMercadotecnia = Mustache.render($('#plantilla_preguntas_encuestas_prospectos_mercadotecnia').html(), resultado);
				$('#dg_preguntas_encuestas_prospectos_mercadotecnia tbody').html(tmpPreguntasEncuestasProspectosMercadotecnia);
				$('#numElementos_preguntas_encuestas_prospectos_mercadotecnia').html(preguntas.length);
				
			}	

		}

		//Función para agregar o modificar respuesta a una pregunta
		function respuesta_encuestas_prospectos_mercadotecnia(intRenglonPregunta){
			
			//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
			$('#divEncabezadoModal_respuestas_encuestas_prospectos_mercadotecnia').addClass("estatus-NUEVO");
			//Abrir modal
			 objRespuestasEncuestasProspectosMercadotecnia = $('#EncuestaRespuestasMercadotecniaBox').bPopup({
										   appendTo: '#EncuestasProspectosMercadotecniaContent', 
			                               contentContainer: 'EncuestasProspectosMercadotecniaM', 
			                               zIndex: 2, 
			                               modalClose: false, 
			                               modal: true, 
			                               follow: [true,false], 
			                               followEasing : "linear", 
			                               easing: "linear", 
			                               modalColor: ('#F0F0F0')});
			
			//Limpiar el formulario
			$('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val('');
			$('#txtPregunta_encuestas_prospectos_mercadotecnia').val('');
			$('#cmbRespuestas_encuestas_prospectos_mercadotecnia').empty();
			$('#txtComentarios_encuestas_prospectos_mercadotecnia').val('');

			//Cargar las respuestas correspondientes a esa pregunta
			var respuestas = objEncuesta.getRespuestas(intRenglonPregunta - 1);
			$('#cmbRespuestas_encuestas_prospectos_mercadotecnia').append($('<option value="" selected disabled hidden>Seleccione una respuesta</option>'
			     ));

			for (var i = 0; i < respuestas.length; i++) {
		        $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').append($('<option>',
			     { value: i + 1, text : respuestas[i] }));	
		    }


			//Pre cargar la información correspondiente
		    $('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val(intRenglonPregunta);
			$('#txtPregunta_encuestas_prospectos_mercadotecnia').val(objEncuesta.getPregunta(intRenglonPregunta - 1));
            
            var pregunta_respuesta = objEncuestaProspecto.getPreguntaRespuesta(intRenglonPregunta - 1);

            $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').val(pregunta_respuesta[1]);
			$('#txtComentarios_encuestas_prospectos_mercadotecnia').val(pregunta_respuesta[2]);

			//Enfocar caja de texto
			$('#txtPregunta_encuestas_prospectos_mercadotecnia').focus();

		}

		//Función para cargar la pregunta siguiente
		function siguiente_pregunta_encuestas_prospectos_mercadotecnia(tipo){

			//Preguntar por el tipo de acción desde la vista
			if(tipo == 'boton'){

				console.log('BUSQUEDA CON BOTON');
				var intRenglonPregunta = parseInt( $('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val() ) + 1;
				
				//Preguntar si el renglón de la pregunta es menor que el número máximo de preguntas
				if( intRenglonPregunta <= objEncuesta.getPreguntas().length ){

					//Obtener el inidice para acceder a las estructuras de tipo array
					var indexAnterior = intRenglonPregunta - 2;
					index = intRenglonPregunta - 1;
					//Guardarmos los datos de los compornentes en el objeto Encuesta antes de pasar a la siguiente Pregunta
					//Obtenemos la información de la respuesta seleccionada
					var respuesta = $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').val();
					var comentarios = $('#txtComentarios_encuestas_prospectos_mercadotecnia').val();
					console.log('INDICE: ' + indexAnterior + ' RESPUESTA: ' + respuesta + ' COMENTARIOS: ' + comentarios);
					objEncuestaProspecto.setPreguntaRespuesta(indexAnterior, respuesta, comentarios);

					//Limpiar los componentes
					$('#txtPregunta_encuestas_prospectos_mercadotecnia').val('');
					$('#cmbRespuestas_encuestas_prospectos_mercadotecnia').empty();
					$('#txtComentarios_encuestas_prospectos_mercadotecnia').val('');

					//PREGUNTA SIGUIENTE
					//Cargar el nombre de la pregunta
					$('#txtPregunta_encuestas_prospectos_mercadotecnia').val(objEncuesta.getPregunta(index));
					//Cargar las respuestas correspondientes a esa pregunta
					var respuestas = objEncuesta.getRespuestas(index);
					$('#cmbRespuestas_encuestas_prospectos_mercadotecnia').append($('<option value="" selected disabled hidden>Seleccione una respuesta</option>'
					     ));

					for (var i = 0; i < respuestas.length; i++) {
				        $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').append($('<option>',
					     { value: i + 1, text : respuestas[i] }));	
				    }

		            //Seleccionar respuesta seleccionada y comentarios para esa pregunta
		            var pregunta_respuesta = objEncuestaProspecto.getPreguntaRespuesta(index);
		            $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').val(pregunta_respuesta[1]);
					$('#txtComentarios_encuestas_prospectos_mercadotecnia').val(pregunta_respuesta[2]);
					
					//Incrementamos el renglón de la pregunta
					$('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val(intRenglonPregunta);
					//Enfocar caja de texto
					$('#txtPregunta_encuestas_prospectos_mercadotecnia').focus();	
				}

			}
			else{

				console.log('BUSQUEDA CON TECLADO');
				var intRenglonPregunta = parseInt( $('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val() );
				$('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val(intRenglonPregunta);
				//Preguntar si el renglón de la pregunta es menor que el número máximo de preguntas
				intRenglonPregunta++;
				if( intRenglonPregunta <= objEncuesta.getPreguntas().length ){

					//Obtener el inidice para acceder a las estructuras de tipo array
					var indexAnterior = intRenglonPregunta - 2;
					index = intRenglonPregunta - 1;
					//Guardarmos los datos de los compornentes en el objeto Encuesta antes de pasar a la siguiente Pregunta
					//Obtenemos la información de la respuesta seleccionada
					var respuesta = $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').val();
					var comentarios = $('#txtComentarios_encuestas_prospectos_mercadotecnia').val();
					console.log('INDICE: ' + indexAnterior + ' RESPUESTA: ' + respuesta + ' COMENTARIOS: ' + comentarios);
					objEncuestaProspecto.setPreguntaRespuesta(indexAnterior, respuesta, comentarios);

					//Limpiar los componentes
					$('#txtPregunta_encuestas_prospectos_mercadotecnia').val('');
					$('#cmbRespuestas_encuestas_prospectos_mercadotecnia').empty();
					$('#txtComentarios_encuestas_prospectos_mercadotecnia').val('');

					//PREGUNTA SIGUIENTE
					//Cargar el nombre de la pregunta
					$('#txtPregunta_encuestas_prospectos_mercadotecnia').val(objEncuesta.getPregunta(index));
					//Cargar las respuestas correspondientes a esa pregunta
					var respuestas = objEncuesta.getRespuestas(index);
					$('#cmbRespuestas_encuestas_prospectos_mercadotecnia').append($('<option value="" selected disabled hidden>Seleccione una respuesta</option>'
					     ));

					for (var i = 0; i < respuestas.length; i++) {
				        $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').append($('<option>',
					     { value: i + 1, text : respuestas[i] }));	
				    }

		            //Seleccionar respuesta seleccionada y comentarios para esa pregunta
		            var pregunta_respuesta = objEncuestaProspecto.getPreguntaRespuesta(index);
		            $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').val(pregunta_respuesta[1]);
					$('#txtComentarios_encuestas_prospectos_mercadotecnia').val(pregunta_respuesta[2]);
					
					//Incrementamos el renglón de la pregunta
					$('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val(intRenglonPregunta);
					//Enfocar caja de texto
					$('#txtPregunta_encuestas_prospectos_mercadotecnia').focus();	
				}

			}
	
		}

		//Función para cargar la pregunta anterior
		function anterior_pregunta_encuestas_prospectos_mercadotecnia(){
			
			//Preguntar si el renglón de la pregunta es menor que el número minimo de preguntas
			if(parseInt( $('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val() ) - 1 >= 1){

				//Pregunta actual antes de cambiar de pregunta
				var index = parseInt( $('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val() ) - 1;
				
				//Guardarmos los datos de los compornentes en el objeto Encuesta antes de pasar a la siguiente Pregunta
				//Obtenemos la información de la respuesta seleccionada
				var renglonRespuesta = $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').val();
				var strRespuesta = $("#cmbRespuestas_encuestas_prospectos_mercadotecnia option:selected").text();
				var comentarios = $('#txtComentarios_encuestas_prospectos_mercadotecnia').val();

				//Se actualiza la pregunta correspondiente
				objEncuestaProspecto.setPreguntaRespuesta(index, renglonRespuesta, comentarios);
				
				//Pasamos a la pregunta anterior
				var intRenglonPregunta = parseInt( $('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val() ) - 1;
				index = intRenglonPregunta - 1;

				//Limpiar los compoenentes
				$('#txtPregunta_encuestas_prospectos_mercadotecnia').val('');
				$('#cmbRespuestas_encuestas_prospectos_mercadotecnia').empty();
				$('#txtComentarios_encuestas_prospectos_mercadotecnia').val('');

				//Cargar las respuestas correspondientes a esa pregunta
				var respuestas = objEncuesta.getRespuestas(index);
				$('#cmbRespuestas_encuestas_prospectos_mercadotecnia').append($('<option value="" selected disabled hidden>Seleccione una respuesta</option>'
				     ));

				for (var i = 0; i < respuestas.length; i++) {
			        $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').append($('<option>',
				     { value: i + 1, text : respuestas[i] }));	
			    }

				//Pre cargar la información correspondiente
			    $('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val(index);
				$('#txtPregunta_encuestas_prospectos_mercadotecnia').val(objEncuesta.getPregunta(index));
	            
	            var pregunta_respuesta = objEncuestaProspecto.getPreguntaRespuesta(index);

	            $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').val(pregunta_respuesta[1]);
				$('#txtComentarios_encuestas_prospectos_mercadotecnia').val(pregunta_respuesta[2]);

				//Enfocar caja de texto
				$('#txtPregunta_encuestas_prospectos_mercadotecnia').focus();
				
				//Incrementamos el renglón de la pregunta
				$('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val(intRenglonPregunta);
			}
		}

		// Función para limpiar los campos del formulario
		function nuevo_encuestas_prospectos_mercadotecnia()
		{
			$('#frmEncuestasProspectosMercadotecnia')[0].reset();
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_encuestas_prospectos_mercadotecnia();
			//Limpiar cajas de texto ocultas
			$('#frmEncuestasProspectosMercadotecnia').find('input[type=hidden]').val('');
			$('#frmRespuestasEncuestasProspectosMercadotecnia').find('input[type=hidden]').val('');
			//Hacer un llamado a la función para inicializar elementos de la tabla preguntas
		    inicializar_preguntas_encuestas_prospectos_mercadotecnia();
			//Asignar la fecha actual
			$('#txtFecha_encuestas_prospectos_mercadotecnia').val(fechaActual()); 
			//Quitar clases del div para poder tomar el color correspondiente al estatus del registro
			$('#divEncabezadoModal_encuestas_prospectos_mercadotecnia').removeClass("estatus-NUEVO");
			$('#divEncabezadoModal_encuestas_prospectos_mercadotecnia').removeClass("estatus-ACTIVO");
			$('#divEncabezadoModal_encuestas_prospectos_mercadotecnia').removeClass("estatus-INACTIVO");
			//Habilitar todos los elementos del formulario
			$('#frmEncuestasProspectosMercadotecnia').find('input, textarea, select').removeAttr('disabled','disabled');
			//Deshabilitar caja de texto
			$('#txtFolio_encuestas_prospectos_mercadotecnia').attr("disabled", "disabled");
			$('#txtModulo_encuestas_prospectos_mercadotecnia').attr("disabled", "disabled");
			$('#txtTelefonoProspecto_encuestas_prospectos_mercadotecnia').attr("disabled", "disabled");
			$('#txtSecundarioProspecto_encuestas_prospectos_mercadotecnia').attr("disabled", "disabled");
			$('#txtNombreContacto_encuestas_prospectos_mercadotecnia').attr("disabled", "disabled");
			$('#txtTelefonoContacto_encuestas_prospectos_mercadotecnia').attr("disabled", "disabled");
			$('#txtCelularContacto_encuestas_prospectos_mercadotecnia').attr("disabled", "disabled");
		    //Mostrar botón Guardar
			$("#btnGuardar_encuestas_prospectos_mercadotecnia").show();
			//Ocultar los siguientes botones
			$("#btnImprimirRegistro_encuestas_prospectos_mercadotecnia").hide();
			$("#btnDescargarXLSRegistro_encuestas_prospectos_mercadotecnia").hide();
			$("#btnDesactivar_encuestas_prospectos_mercadotecnia").hide();
			$("#btnRestaurar_encuestas_prospectos_mercadotecnia").hide();

		}
		
		//Función para inicializar elementos de la encuesta
		function inicializar_encuesta_encuestas_prospectos_mercadotecnia()
		{
			//Limpiar contenido de las siguientes cajas de texto
			$('#txtVendedorID_encuestas_prospectos_mercadotecnia').val('');
            $('#txtVendedor_encuestas_prospectos_mercadotecnia').val('');
            $('#txtModuloID_encuestas_prospectos_mercadotecnia').val('');
            $('#txtModulo_encuestas_prospectos_mercadotecnia').val('');
            //Hacer un llamado a la función para inicializar elementos de la tabla preguntas
		    inicializar_preguntas_encuestas_prospectos_mercadotecnia();
		}

		//Función para inicializar elementos de la tabla preguntas
		function inicializar_preguntas_encuestas_prospectos_mercadotecnia()
		{
			//Eliminar los datos de la tabla preguntas de la encuesta
			$('#dg_preguntas_encuestas_prospectos_mercadotecnia tbody').empty();
			//Limpiar el número de elementos de la tabla preguntas respuestas
			$('#numElementos_preguntas_encuestas_prospectos_mercadotecnia').html(0);
		}

		//Función que se utiliza para cerrar el modal
		function cerrar_encuestas_prospectos_mercadotecnia()
		{
			try {
				//Cerrar modal
				objEncuestasProspectosMercadotecnia.close();
				//Enfocar caja de texto 
				$('#txtFechaInicialBusq_encuestas_prospectos_mercadotecnia').focus();
				
			}
			catch(err) {}
		}

		//Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
		function validar_encuestas_prospectos_mercadotecnia()
		{
			//Hacer un llamado a la función para limpiar los mensajes de error 
			limpiar_mensajes_encuestas_prospectos_mercadotecnia();
			
			//Validación del formulario de campos obligatorios
			$('#frmEncuestasProspectosMercadotecnia')
				.bootstrapValidator({excluded: [':disabled'],
									 container: 'popover',
									 feedbackIcons: {
									 	valid: 'glyphicon glyphicon-ok',
										invalid: 'glyphicon glyphicon-remove',
										validating: 'glyphicon glyphicon-refresh'
									  },
									  fields: {
									  	strFecha_encuestas_prospectos_mercadotecnia: {
											validators: {
												notEmpty: {message: 'Seleccione una fecha'}
											}
										},
										strEncuesta_encuestas_prospectos_mercadotecnia: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id de la encuesta
					                                    if($('#txtEncuestaID_encuestas_prospectos_mercadotecnia').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba una encuesta existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strProspecto_encuestas_prospectos_mercadotecnia: {
											validators: {
												callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del prospecto
					                                    if($('#txtProspectoID_encuestas_prospectos_mercadotecnia').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un prospecto existente'
					                                        };
					                                    }
					                                    return true;
					                                }
					                            }
											}
										},
										strVendedor_encuestas_prospectos_mercadotecnia: {
											validators: {
										    	callback: {
					                                callback: function(value, validator, $field) {
					                                    //Verificar que exista id del vendedor
					                                    if($('#txtVendedorID_encuestas_prospectos_mercadotecnia').val() === '')
					                                    {
				                                      		return {
					                                            valid: false,
					                                            message: 'Escriba un vendedor existente'
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
			var bootstrapValidator_encuestas_prospectos_mercadotecnia = $('#frmEncuestasProspectosMercadotecnia').data('bootstrapValidator');
			bootstrapValidator_encuestas_prospectos_mercadotecnia.validate();
			//Si se cumplen las reglas de validación
			if(bootstrapValidator_encuestas_prospectos_mercadotecnia.isValid())
			{
				//Hacer un llamado a la función para guardar los datos del registro
				guardar_encuestas_prospectos_mercadotecnia();
			}
			else 
				return;
		}	

		//Función para guardar o modificar los datos de un registro
		function guardar_encuestas_prospectos_mercadotecnia()
		{
			//Inicializamos el objeto Encuesta del prospecto
			objEncuestaProspecto.setProspectoID( $('#txtProspectoID_encuestas_prospectos_mercadotecnia').val() );
			objEncuestaProspecto.setVendedorID( $('#txtVendedorID_encuestas_prospectos_mercadotecnia').val() );
			objEncuestaProspecto.setObservaciones( $('#txtObservaciones_encuestas_prospectos_mercadotecnia').val() );
			objEncuestaProspecto.setFecha($.formatFechaMysql($('#txtFecha_encuestas_prospectos_mercadotecnia').val()) );

			//Convertir a formato JSON el objeto de tipo EncuestaProspecto
			var jsonEncuestaProspecto = JSON.stringify(objEncuestaProspecto); 
			//Hacer un llamado al método del controlador para guardar los datos del registro
			$.post('mercadotecnia/encuestas_prospectos/guardar',
					{ 
						objEncuestaProspecto: jsonEncuestaProspecto,
						intProcesoMenuID: $('#txtProcesoMenuID_encuestas_prospectos_mercadotecnia').val()
					},
					function(data) {
						if (data.resultado)
						{
						    //Hacer llamado a la función  para cargar los registros en el grid
							paginacion_encuestas_prospectos_mercadotecnia();
							
							//Hacer un llamado a la función para cerrar modal
							cerrar_encuestas_prospectos_mercadotecnia();   
						}
						
						//Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
						mensaje_encuestas_prospectos_mercadotecnia(data.tipo_mensaje, data.mensaje);
					},
			'json');
	
			
		}

		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_encuestas_prospectos_mercadotecnia()
		{
			try
			{
				$('#frmEncuestasProspectosMercadotecnia').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}

		//Función para mostrar mensaje de éxito o error
		function mensaje_encuestas_prospectos_mercadotecnia(tipoMensaje, mensaje)
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
		Funciones del modal Respuestas Preguntas Encuestas
		*********************************************************************************************************************/
		//Funcion para validar las respuestas 
		function validar_respuestas_encuestas_prospectos_mercadotecnia(){

			//Validar que se haya seleccionado una respuesta antes de guardar 
			if( $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').val() == null ){
				mensaje_encuestas_prospectos_mercadotecnia('error', 'Debe seleccionar una respuesta antes de guardar');
			}
			else{
				
				//Obtenemos la información de la respuesta seleccionada
				var renglonPregunta = $('#txtRenglonPregunta_encuestas_prospectos_mercadotecnia').val();
				var renglonRespuesta = $('#cmbRespuestas_encuestas_prospectos_mercadotecnia').val();
				var strRespuesta = $("#cmbRespuestas_encuestas_prospectos_mercadotecnia option:selected").text();
				var comentarios = $('#txtComentarios_encuestas_prospectos_mercadotecnia').val();

				//Se actualiza la pregunta correspondiente
				objEncuestaProspecto.setPreguntaRespuesta(renglonPregunta - 1, renglonRespuesta, comentarios);

				cerrar_respuestas_encuestas_prospectos_mercadotecnia();
			}

		}

		//Función para cerrar el modal de Respuestas
		function cerrar_respuestas_encuestas_prospectos_mercadotecnia(){

			try {
				
				//Cerrar modal
				objRespuestasEncuestasProspectosMercadotecnia.close();

				//Cargar el GRID con la respuesta correspondiente a cada pregunta
				//Obtenemos el objeto de la tabla
				var objTabla = document.getElementById('dg_preguntas_encuestas_prospectos_mercadotecnia').getElementsByTagName('tbody')[0];

				//Recorrer los renglones de la tabla para obtener los valores
				for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
				{		
					var arrPregunta_Respuestas = objEncuestaProspecto.getPreguntaRespuesta(intRen);
					var arrRespuestas = objEncuesta.getRespuestas(intRen);
					var strRespuesta = '';
				
					if(arrRespuestas != null){
						//Obtenemos la posicion correspodiente a la respuesta seleccionada
						var i = arrPregunta_Respuestas[1];
						//Buscamos el valor de la respuesta seleccionada 
						if(i == null){
							strRespuesta = '';
						}
						else if(i == ''){
							strRespuesta = '';
						}
						else{
							strRespuesta = arrRespuestas[i-1];
						}

					}

					//Asignamos la respuesta correspondiente a la celda
					objRen.cells[1].innerHTML = strRespuesta;
					
				}

				//Enfocar caja de texto 
				$('#txtEncuesta_encuestas_prospectos_mercadotecnia').focus();
				//Hacer un llamado a la función para limpiar los mensajes de error 
				limpiar_mensajes_respuestas_encuestas_prospectos_mercadotecnia();

			}
			catch(err) {}

		}
		
		//Función para limpiar mensajes de validación del formulario
		function limpiar_mensajes_respuestas_encuestas_prospectos_mercadotecnia()
		{
			try
			{
				$('#frmRespuestasEncuestasProspectosMercadotecnia').data('bootstrapValidator').resetForm();
			}
			catch(err) {}
		}


		//Controles o Eventos del Modal
		$(document).ready(function() 
		{
			/*******************************************************************************************************************
			Controles correspondientes al modal Preguntas Encuestas
			*********************************************************************************************************************/
			//Agregar datepicker para seleccionar fecha
			$('#dteFecha_encuestas_prospectos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});

			//Autocomplete para recuperar los datos de una encuesta 
	        $('#txtEncuesta_encuestas_prospectos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtEncuestaID_encuestas_prospectos_mercadotecnia').val('');
	               //Hacer un llamado a la función para inicializar elementos de la encuesta
	               inicializar_encuesta_encuestas_prospectos_mercadotecnia();
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "mercadotecnia/encuestas/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strEstatus: 'ACTIVO'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtEncuestaID_encuestas_prospectos_mercadotecnia').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('mercadotecnia/encuestas/get_datos',
	                  { 
	                  	intEncuestaID:$("#txtEncuestaID_encuestas_prospectos_mercadotecnia").val()
	                  },
	                  function(data) {
	                    if(data.row){
	                       
	                       $("#txtEncuesta_encuestas_prospectos_mercadotecnia").val(data.row.descripcion);
	                       $("#txtModuloID_encuestas_prospectos_mercadotecnia").val(data.row.modulo_id);
	                       $("#txtModulo_encuestas_prospectos_mercadotecnia").val(data.row.modulo);
	                       //Hacer un llamado a la función para crear el objeto de la encuesta
	                       crear_objeto_encuesta(data.row.encuesta_id, data.preguntas);
	                    
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
	        
	        //Verificar que exista id de la encuesta cuando pierda el enfoque la caja de texto
	        $('#txtEncuesta_encuestas_prospectos_mercadotecnia').focusout(function(e){
	            //Si no existe id de la encuesta
	            if($('#txtEncuestaID_encuestas_prospectos_mercadotecnia').val() == '' ||
	               $('#txtEncuesta_encuestas_prospectos_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEncuestaID_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtEncuesta_encuestas_prospectos_mercadotecnia').val('');
	                //Hacer un llamado a la función para inicializar elementos de la encuesta
	                inicializar_encuesta_encuestas_prospectos_mercadotecnia();
	            }

	        });

	        //Autocomplete para recuperar los datos de un prospecto 
	        $('#txtProspecto_encuestas_prospectos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtProspectoID_encuestas_prospectos_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/prospectos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strEstatus: 'ACTIVO'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtProspectoID_encuestas_prospectos_mercadotecnia').val(ui.item.data);
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('crm/prospectos/get_datos',
	                  { 
	                  	intProspectoID:$("#txtProspectoID_encuestas_prospectos_mercadotecnia").val()
	                  },
	                  function(data) {
	                    if(data.row){
	                       $("#txtTelefonoProspecto_encuestas_prospectos_mercadotecnia").val(data.row.telefono_principal);
	                       $("#txtSecundarioProspecto_encuestas_prospectos_mercadotecnia").val(data.row.telefono_secundario);
	                       $("#txtNombreContacto_encuestas_prospectos_mercadotecnia").val(data.row.contacto_nombre);
	                       $("#txtTelefonoContacto_encuestas_prospectos_mercadotecnia").val(data.row.contacto_telefono + " " + data.row.contacto_extension);
	                       $("#txtCelularContacto_encuestas_prospectos_mercadotecnia").val(data.row.contacto_celular);
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

	        //Verificar que exista id del prospecto cuando pierda el enfoque la caja de texto
	        $('#txtProspecto_encuestas_prospectos_mercadotecnia').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoID_encuestas_prospectos_mercadotecnia').val() == '' ||
	               $('#txtProspecto_encuestas_prospectos_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoID_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtProspecto_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtTelefonoProspecto_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtSecundarioProspecto_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtNombreContacto_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtTelefonoContacto_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtCelularContacto_encuestas_prospectos_mercadotecnia').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedor_encuestas_prospectos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtVendedorID_encuestas_prospectos_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intModuloID: $('#txtModuloID_encuestas_prospectos_mercadotecnia').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorID_encuestas_prospectos_mercadotecnia').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id del vendedor cuando pierda el enfoque la caja de texto
	        $('#txtVendedor_encuestas_prospectos_mercadotecnia').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorID_encuestas_prospectos_mercadotecnia').val() == '' ||
	               $('#txtVendedor_encuestas_prospectos_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorID_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtVendedor_encuestas_prospectos_mercadotecnia').val('');
	            }

	        });


	        /*******************************************************************************************************************
			Controles correspondientes al modal Respuestas Preguntas Encuesta
			*********************************************************************************************************************/
			//Pasar a la siguiente pregunta desde el input comentarios 
			$('#txtComentarios_encuestas_prospectos_mercadotecnia').on('keypress', function (e) {
		        if(e.which === 13 )
		        {
		        	siguiente_pregunta_encuestas_prospectos_mercadotecnia('teclado');
		        }
		    });


			/*******************************************************************************************************************
			Controles correspondientes al formulario principal
			*********************************************************************************************************************/
			//Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
			$('#dteFechaInicialBusq_encuestas_prospectos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY'});
			$('#dteFechaFinalBusq_encuestas_prospectos_mercadotecnia').datetimepicker({format: 'DD/MM/YYYY',
			 																		       useCurrent: false});
			//Deshabilitar los días posteriores a la fecha final
			$('#dteFechaInicialBusq_encuestas_prospectos_mercadotecnia').on('dp.change', function (e) {
				$('#dteFechaFinalBusq_encuestas_prospectos_mercadotecnia').data('DateTimePicker').minDate(e.date);
			});

			//Deshabilitar los días anteriores a la fecha inicial
			$('#dteFechaFinalBusq_encuestas_prospectos_mercadotecnia').on('dp.change', function (e) {
				$('#dteFechaInicialBusq_encuestas_prospectos_mercadotecnia').data('DateTimePicker').maxDate(e.date);
			});

			//Paginación de registros
			$('#pagLinks_encuestas_prospectos_mercadotecnia').on('click','a',function(event){
				event.preventDefault();
				intPaginaEncuestasProspectosMercadotecnia = $(this).attr('href').replace('/','');
				//Hacer llamado a la función  para cargar  los registros en el grid
				paginacion_encuestas_prospectos_mercadotecnia();
			});

			//Autocomplete para recuperar los datos de un prospecto 
	        $('#txtProspectoBusq_encuestas_prospectos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtProspectoIDBusq_encuestas_prospectos_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/prospectos/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strEstatus: 'ACTIVO'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtProspectoIDBusq_encuestas_prospectos_mercadotecnia').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id del prospecto cuando pierda el enfoque la caja de texto
	        $('#txtProspectoBusq_encuestas_prospectos_mercadotecnia').focusout(function(e){
	            //Si no existe id del prospecto
	            if($('#txtProspectoIDBusq_encuestas_prospectos_mercadotecnia').val() == '' ||
	               $('#txtProspectoBusq_encuestas_prospectos_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtProspectoIDBusq_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtProspectoBusq_encuestas_prospectos_mercadotecnia').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de un vendedor 
	        $('#txtVendedorBusq_encuestas_prospectos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtVendedorIDBusq_encuestas_prospectos_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "crm/vendedores/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term, 
	                   intModuloID: $('#txtModuloIDBusq_encuestas_prospectos_mercadotecnia').val()
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtVendedorIDBusq_encuestas_prospectos_mercadotecnia').val(ui.item.data);
	           },
	           open: function() {
	               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	             },
	             close: function() {
	               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	             },
	           minLength: 1
	        });

	        //Verificar que exista id del vendedor cuando pierda el enfoque la caja de texto
	        $('#txtVendedorBusq_encuestas_prospectos_mercadotecnia').focusout(function(e){
	            //Si no existe id del vendedor
	            if($('#txtVendedorIDBusq_encuestas_prospectos_mercadotecnia').val() == '' ||
	               $('#txtVendedorBusq_encuestas_prospectos_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorIDBusq_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtVendedorBusq_encuestas_prospectos_mercadotecnia').val('');
	            }
	        });

	        //Autocomplete para recuperar los datos de una encuesta 
	        $('#txtEncuestaBusq_encuestas_prospectos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro
	               $('#txtEncuestaIDBusq_encuestas_prospectos_mercadotecnia').val('');
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtVendedorIDBusq_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtVendedorBusq_encuestas_prospectos_mercadotecnia').val('');
	               $.ajax({
	                 //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
	                 url: "mercadotecnia/encuestas/autocomplete",
	                 type: "post",
	                 dataType: "json",
	                 data: {
	                   strDescripcion: request.term,
	                   strEstatus: 'ACTIVO'
	                 },
	                 success: function( data ) {
	                   response( data );
	                 }
	               });
	           },
	           select: function( event, ui ) {
	             //Asignar id del registro seleccionado
	             $('#txtEncuestaIDBusq_encuestas_prospectos_mercadotecnia').val(ui.item.data);
	            
	             //Hacer un llamado al método del controlador para regresar los datos del registro seleccionado
	             $.post('mercadotecnia/encuestas/get_datos',
	                  { 
	                  	intEncuestaID:$("#txtEncuestaIDBusq_encuestas_prospectos_mercadotecnia").val()
	                  },
	                  function(data) {
	                    if(data.row){
	                       
	                       $("#txtEncuestaBusq_encuestas_prospectos_mercadotecnia").val(data.row.descripcion); 
	                       $("#txtModuloIDBusq_encuestas_prospectos_mercadotecnia").val(data.row.modulo_id);
	                       $("#txtModuloBusq_encuestas_prospectos_mercadotecnia").val(data.row.modulo);
	                      
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

	         //Verificar que exista id de la encuesta cuando pierda el enfoque la caja de texto
	        $('#txtEncuestaBusq_encuestas_prospectos_mercadotecnia').focusout(function(e){
	            //Si no existe id de la encuesta
	            if($('#txtEncuestaIDBusq_encuestas_prospectos_mercadotecnia').val() == '' ||
	               $('#txtEncuestaBusq_encuestas_prospectos_mercadotecnia').val() == '')
	            { 
	               //Limpiar contenido de las siguientes cajas de texto
	               $('#txtEncuestaIDBusq_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtEncuestaBusq_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtModuloIDBusq_encuestas_prospectos_mercadotecnia').val('');
	               $('#txtModuloBusq_encuestas_prospectos_mercadotecnia').val('');
	            }

	        });

	        //Autocomplete para recuperar los datos de un módulo 
	        $('#txtModuloBusq_encuestas_prospectos_mercadotecnia').autocomplete({
	            source: function( request, response ) {
	               //Limpiar caja de texto que hace referencia al id del registro 
	               $('#txtModuloIDBusq_encuestas_prospectos_mercadotecnia').val('');
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtEncuestaIDBusq_encuestas_prospectos_mercadotecnia').val('');
	                $('#txtEncuestaBusq_encuestas_prospectos_mercadotecnia').val('');
	                $('#txtVendedorIDBusq_encuestas_prospectos_mercadotecnia').val('');
	                $('#txtVendedorBusq_encuestas_prospectos_mercadotecnia').val('');
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
	             $('#txtModuloIDBusq_encuestas_prospectos_mercadotecnia').val(ui.item.data);
	             
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
	        $('#txtModuloBusq_encuestas_prospectos_mercadotecnia').focusout(function(e){
	            //Si no existe id del módulo
	            if($('#txtModuloIDBusq_encuestas_prospectos_mercadotecnia').val() == '' ||
	               $('#txtModuloBusq_encuestas_prospectos_mercadotecnia').val() == '')
	            { 
	                //Limpiar contenido de las siguientes cajas de texto
	                $('#txtModuloIDBusq_encuestas_prospectos_mercadotecnia').val('');
	                $('#txtModuloBusq_encuestas_prospectos_mercadotecnia').val('');
	                $('#txtEncuestaIDBusq_encuestas_prospectos_mercadotecnia').val('');
	                $('#txtEncuestaBusq_encuestas_prospectos_mercadotecnia').val('');
	                $('#txtVendedorIDBusq_encuestas_prospectos_mercadotecnia').val('');
	                $('#txtVendedorBusq_encuestas_prospectos_mercadotecnia').val('');
	            }
	            
	        });

			//Abrir modal cuando se de clic en el botón
			$('#btnNuevo_encuestas_prospectos_mercadotecnia').bind('click', function(e) {
				e.preventDefault();
				//Hacer un llamado a la función para limpiar los campos del formulario
				nuevo_encuestas_prospectos_mercadotecnia();
				//Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
				$('#divEncabezadoModal_encuestas_prospectos_mercadotecnia').addClass("estatus-NUEVO");
				//Abrir modal
				 objEncuestasProspectosMercadotecnia = $('#EncuestasProspectosMercadotecniaBox').bPopup({
											   appendTo: '#EncuestasProspectosMercadotecniaContent', 
				                               contentContainer: 'EncuestasProspectosMercadotecniaM', 
				                               zIndex: 1, 
				                               modalClose: false, 
				                               modal: true, 
				                               follow: [true,false], 
				                               followEasing : "linear", 
				                               easing: "linear", 
				                               modalColor: ('#F0F0F0')});
				//Enfocar caja de texto
				$('#txtEncuesta_encuestas_prospectos_mercadotecnia').focus();
			});

			//Enfocar caja de texto
			$('#txtFechaInicialBusq_encuestas_prospectos_mercadotecnia').focus();

			//Deshabilitar los siguientes botones (funciones de permisos de acceso)
			$('#btnNuevo_encuestas_prospectos_mercadotecnia').attr('disabled','-1');  
			$('#btnImprimir_encuestas_prospectos_mercadotecnia').attr('disabled','-1');
			$('#btnDescargarXLS_encuestas_prospectos_mercadotecnia').attr('disabled','-1');
			$('#btnBuscar_encuestas_prospectos_mercadotecnia').attr('disabled','-1');
			$('#btnGuardar_encuestas_prospectos_mercadotecnia').attr('disabled','-1');
			$('#btnImprimirRegistro_encuestas_prospectos_mercadotecnia').attr('disabled','-1');
			$('#btnDescargarXLSRegistro_encuestas_prospectos_mercadotecnia').attr('disabled','-1');
			$('#btnDesactivar_encuestas_prospectos_mercadotecnia').attr('disabled','-1');
			$('#btnRestaurar_encuestas_prospectos_mercadotecnia').attr('disabled','-1');
			//Hacer un llamado a la función para obtener los permisos de acceso
			permisos_encuestas_prospectos_mercadotecnia();
		});
	</script>